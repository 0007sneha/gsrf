<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$schemes = $db->get("scheme_types");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $payload = filter_input_array(INPUT_POST);
  $input = array(
    "isDeleted" => 1
  );
  $db = getDbInstance();
  $db->where('id', $payload['id'])->update('scheme_admin_accounts', $input);
  $_SESSION['success'] = "Scheme Admin Deleted successfully!";
}

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Scheme Admin</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<?php
$currentPage = $_GET["page"] ?? 1;
$query = $_GET['search'] ?? "";
$query = trim($query);
if ($query!='') {
    $_SESSION['info'] = "Search result !";
}
$db->pageLimit = 10;
// set page limit to 2 results per page. 20 by default
$db->where(
    "(name LIKE '%" . $query . "%' 
    OR email LIKE '%" . $query . "%')"
);
$db->where("isDeleted", 0);
$admins = $db->arraybuilder()->paginate("scheme_admin_accounts", $currentPage);

$search_placeholder = 'Search Name or user id';

?>
<style>
  .scheme_assigned {
    padding: 5px 8px;
    font-weight: 500;
    border-radius: 6px;
    margin-right: 8px;
    background-color: #b9b9ff9e;
  }
</style>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">All Scheme wise Admins</h5>
    <!-- Default Table -->
    <?php
    include('../admin_assets/includes/search_form.php');
    include('./includes/flash_messages.php');
    ?>
    <table class="table mt-4">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">USER ID</th>
          <th scope="col">Schemes Applicable</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $key = 0;
        foreach ($admins as $admin) :
          $key++;

          $sr_no = $currentPage-1;
          $sr_no = $sr_no .''. $key;
          if ($key==10 ) {
            $sr_no = (int)$key * $currentPage;
          } else {
            $sr_no = (int)$sr_no;
          }
          ?>
            <tr>
              <th scope="row"><?php echo $sr_no; ?></th>
              <td><?php echo $admin['name'] ?></td>
              <td><?php echo $admin['email'] ?></td>
              <td><?php
                  if ($admin['applicable_schemes'] == null) {
                    echo 'No Schemes Allocated';
                  } else {
                    foreach (json_decode($admin['applicable_schemes']) as $key1 => $value) {
                      foreach ($schemes as $key2 => $scheme) {
                        if ($scheme['code'] == $value) {
                          echo '<button type="button" style="margin-left:5px" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' . $scheme['name'] . '">
                              ' . $scheme['code'] . ' 
                            </button>';
                        }
                      }
                    } 
                  }
                  ?>
              </td>
              <td><a href="create_scheme_admin.php?id=<?php echo $admin['id']; ?>&action=update" class="btn btn-primary btn-sm"><span><i class="bi bi-pencil-square"></i></span></a></td>
              <td>

                <form id="delete_form" action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                  <!-- Add a hidden input for the record ID -->
                  <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                  <input type="hidden" name="confirmDelete" id="confirmDeleteInput" value="false">
                  <!-- Button with an onClick event to submit the form -->
                  <button class="btn btn-danger btn-sm" type="submit"><span><i class="bi bi-trash-fill"></i></span></button>
                </form>

              </td>
            </tr>
          <?php
        endforeach;
        ?>

      </tbody>
    </table>
    <ul class="pagination justify-content-center">
      <?php echo paginationLinks($currentPage, $db->totalPages, "") ?>
    </ul>

    <!-- End Default Table Example -->
  </div>
</div>


<script>

  function confirmDelete() {
    var userConfirmed = confirm("Are you sure you want to delete this record?");
    // Update the hidden input with the user's confirmation
    document.getElementById("confirmDeleteInput").value = userConfirmed ? "true" : "false";
    // If the user confirmed, submit the form
    if (userConfirmed) {
        document.getElementById("delete_form").submit();
    }
  }

</script>

<?php include_once('includes/footer.php'); ?>