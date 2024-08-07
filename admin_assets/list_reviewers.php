<?php
// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['delete'])) {
  $payload = filter_input_array(INPUT_POST);
  $input = array(
    "isDeleted" => 1
  );
  $db = getDbInstance();
  $db->where('id', $payload['id'])->update('reviewers', $input);
  $_SESSION['success'] = "Reviewer Deleted successfully!";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['toggle-status'])) {
  $payload = filter_input_array(INPUT_POST);

  $recordId = $payload['id'];

  // Fetch the current value of the isActive column
  $db = getDbInstance();
  $schemeAdmin = $db->where('id', $recordId)->getOne('reviewers');

  // Toggle the value (1 becomes 0, and 0 becomes 1)
  $newValue = $schemeAdmin['isActive'] == 1 ? 0 : 1;

  // Update the database with the new value
  $data = ['isActive' => $newValue];
  $db = getDbInstance();
  $db->where('id', $recordId);
  $db->update('reviewers', $data);
  $_SESSION['success'] = "Reviewer status updated successfully!";
}

$currentPage = $_GET["page"] ?? 1;
$query = $_GET['search'] ?? "";

$db = getDbInstance();
// set page limit to 2 results per page. 20 by default
$db->pageLimit = 10;

$db->where("( 
    name LIKE '%" . $query . "%' 
    OR email LIKE '%" . $query . "%' 
)");
$db->where("isDeleted", 0);
$db->orderBy("name", "ASC");
// $db->where("createdBy", CUIDWithType());
$admins = $db->arraybuilder()->paginate("reviewers", $currentPage);
$totalPages = $db->totalPages;

$search_placeholder = 'Search Name or Email';

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <h1>Reviewers</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Reviewers</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<?php
  include('../admin_assets/includes/search_form.php');
  include('./includes/flash_messages.php');
?>

<div class="row mt-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Reviewers</h5>
        <!-- Default Table -->
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Added By</th>
              <th scope="col">Status</th>
              <th scope="col" colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $key = 0;
            foreach ($admins as $admin) :
              $key++;
              $adminDataEncoded = json_encode($admin);

              $sr_no = $currentPage-1;
              $sr_no = $sr_no .''. $key;
              if ($key==10 ) {
                $sr_no = (int)$key * $currentPage;
              } else {
                $sr_no = (int)$sr_no;
              }

              $addedByKey = substr($admin['createdBy'], 0, 4);
              if ($addedByKey == "SUPA") {
                $table = 'admin_accounts';
              } else {
                $table = 'scheme_admin_accounts';
              }
              $db = getDbInstance();
              $userCreatedBy = $db->getOne($table);
              ?>
              <tr>
                <th scope="row"><?php echo $sr_no ?></th>
                <td><?php echo $admin['name'] ?></td>
                <td><?php echo $admin['email'] ?></td>
                <td><?php echo $userCreatedBy['name'] ?></td>
                <td class="text-center">
                  <form id="toggle_status_form" action="" method="post" onsubmit="return confirm('Are you sure?')">
                    <!-- Add a hidden input for the record ID -->
                    <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                    <!-- Button with an onClick event to submit the form -->
                    <button class="btn <?php echo $admin['isActive'] == 1 ? 'btn-danger' : 'btn-success'; ?> btn-sm" name="toggle-status" type="submit"><span> <?php echo $admin['isActive'] == 1 ? 'Block' : 'Activate'; ?></span></button>
                  </form>
                </td>
                <td class="text-center">
                  <a href="add_reviewer.php?id=<?php echo $admin['id']; ?>&action=update" class="btn btn-primary btn-sm"><span><i class="bi bi-pencil-square"></i></span></a>
                </td>
                <td class="text-center">
                  <form class="col" id="delete_form" action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                    <!-- Add a hidden input for the record ID -->
                    <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                    <!-- Button with an onClick event to submit the form -->
                    <button class="btn btn-danger btn-sm" name="delete" type="submit"><span><i class="bi bi-trash-fill"></i></span></button>
                  </form>
                </td>
              </tr>
            <?php
            endforeach;
            ?>
          </tbody>
        </table>
        <ul class="pagination justify-content-center">
          <?php echo paginationLinks($currentPage, $totalPages, "") ?>
        </ul>
        <!-- End Default Table Example -->
      </div>
    </div>
  </div>
</div>


<script>
  let editButtonElement = $("#edit_record");
  $("#uid").val("");

  function edit(data, id) {
    // console.log("Data received:", data); // Check the data in the console
    let decoded = decodeURIComponent(decodeURIComponent(data));
    var admin = JSON.parse(decoded);
    $("#uid").val(admin.id);
    $("#name").val(admin.name.replace(/\+/g, ' '));
    $("#email").val(admin.email);
    $("#password").val(admin.password);
  }

  // editButtonElement.on("click", function (){
  //   var sampleData = {
  //               name: "John Doe",
  //               email: "johndoe@example.com",
  //               password: "samplepassword",
  //               uid: "12345"
  //           };
  //           // Populate the form fields with data
  // })
</script>

<?php include_once('includes/footer.php'); ?>