<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include "../data/generalData.php";

$currentPage = $_GET["page"] ?? 1;
$query = $_GET['search'] ?? "";
$query = trim($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);

    $db = getDbInstance();

    if (isset($data_to_store['id']) && $data_to_store['id']) {
        $db->where('id', $data_to_store['id']);
        $status = $db->update('emails', $data_to_store);

        $request_type = 'Updated';
        $request_fail = 'Update';
    } else {
        $status = $db->insert('emails', $data_to_store);
        
        $request_type = 'Added';
        $request_fail = 'Add';
    }
    
    if ($status) {
        $_SESSION['success'] = "Email ".$request_type." Successfully!";
    } else {
        $_SESSION['failure'] = "Failed to ".$request_fail." email!";
    }
}


$db = getDbInstance();
$db->pageLimit = 15;
// set page limit to 15 results per page. 20 by default
if ($query!='') {
  $db->where("subject", '%'.$query.'%', 'like');
}
$data = $db->arraybuilder()->paginate("emails", $currentPage, 'id,type,subject,content,pages_in_use');
// echo '<pre>'; print_r($data); exit;

$search_placeholder = 'Search subject';

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <h1>Email</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Email List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<form method="GET" action="" class="row mb-4  ">
  <div class="col-md-4">
    <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="<?php echo $search_placeholder; ?>">
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary">Search</button>
    <a href="?search=&page=1" class="btn btn-secondary ml-2">Clear Search</a>
  </div>
</form>
<?php
// include('../admin_assets/includes/search_form.php');
include('./includes/flash_messages.php')
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <h5 class="card-title col-md">All Emails</h5>
          <div class="col-md" style="text-align: end; align-self: center;">
            <a href="#" class="btn btn-primary" onclick="add()"><i class="bi bi-plus"></i> Add New</a>
          </div>
        </div>
        <!-- Default Table -->
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Type</th>
              <th scope="col">Subject</th>
              <!-- <th scope="col">Content</th> -->
              <!-- <th scope="col">Pages in Use</th> -->
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $key=0;
              foreach ($data as $admin): 
                $adminDataEncoded = json_encode($admin);
                
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
                    <th class="text-center" scope="row"><?php echo $sr_no ?></th>
                    <td><?php 
                            foreach ($email_types as $email_type) :
                                if ($email_type["id"] == $admin['type']) {
                                    echo $email_type['name'];
                                }
                            endforeach;
                        ?></td>
                    <td><?php echo $admin['subject'] ?></td>
                    <!-- <td><?php echo $admin['content'] ?></td> -->
                    <!-- <td><?php echo $admin['pages_in_use'] ?></td> -->
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $sr_no ?>">
                          <i class="bi bi-pencil-square"></i>
                        </button>
                        <!-- Edit Modal -->
                        <div class="modal fade text-start" id="editModal-<?php echo $sr_no ?>" tabindex="-1" aria-labelledby="editModalLabel-<?php echo $sr_no ?>" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-<?php echo $sr_no ?>">Edit Email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="list_emails.php" method="POST" id="editForm">
                                            <input type="hidden" name="id" id="edit-id" value="<?php echo $admin['id'] ?>">
                                            <div class="col-sm-12">
                                                <label for="edit-type" class="col-sm-12 col-form-label">Select Email Type</label>
                                                <select class="form-select" id="edit-type" name="type" required>
                                                    <?php
                                                    foreach ($email_types as $email_type) :
                                                        $selected = '';
                                                        if ($email_type["id"] == $admin['type']) {
                                                            $selected = 'selected'; 
                                                        }
                                                        ?>
                                                        <option value="<?php echo $email_type['id'] ?>" <?php echo $selected ?>> <?php echo $email_type['name'] ?> </option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <label for="edit-pages_in_use" class="col-sm-12 col-form-label">Variables in Use</label>
                                                <input type="text" id="edit-pages_in_use" name="pages_in_use" value="<?php echo $admin['pages_in_use'] ?>" class="form-control" placeholder="Add Variable name for printing dynamic data" readonly required>
                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <label for="edit-subject" class="col-sm-12 col-form-label">Subject</label>
                                                <input type="text" id="edit-subject" name="subject" value="<?php echo $admin['subject'] ?>" class="form-control" placeholder="Email subject" required>
                                            </div>
                                            <div class="col-sm-12 mt-2 mb-4">
                                                <label for="edit-content" class="col-sm-12 col-form-label">Body</label>
                                                <span class="text-danger star">This Email Body can be modified as required, Provided you should not remove or change the variable name mentioned in the body, <br>VARIABLE name is defined with "$" sign. </span>
                                                <textarea required cols="30" rows="8" type="text" id="edit-content" name="content" class="form-control" placeholder="Email content" ><?php echo $admin['content'] ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                  </tr>
                <?php 
              endforeach; 
            ?>  
          </tbody>
        </table>
        <ul class="pagination justify-content-center">
            <?php  echo paginationLinks($currentPage, $db->totalPages, "")?>
        </ul>
        <!-- End Default Table Example -->
      </div>
    </div>
  </div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="list_emails.php" method="POST" id="create-fm">
                    <div class="col-sm-12">
                        <label for="type" class="col-sm-12 col-form-label">Select Email Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <?php
                            foreach ($email_types as $email_type) :
                                ?>
                                <option value="<?php echo $email_type['id'] ?>"> <?php echo $email_type['name'] ?> </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <label for="pages_in_use" class="col-sm-12 col-form-label">Variables in Use</label>
                        <input type="text" id="pages_in_use" name="pages_in_use" class="form-control" placeholder="Add Variable name for printing dynamic data" required>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <label for="subject" class="col-sm-12 col-form-label">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Email subject" required>
                    </div>
                    <div class="col-sm-12 mt-2 mb-4">
                        <label for="content" class="col-sm-12 col-form-label">Body</label>
                        <span class="text-danger star">This Email Body can be modified as required, Provided you should not remove or change the variable name mentioned in the body, <br>VARIABLE name is defined with "$" sign. </span>
                        <textarea required cols="30" rows="8" type="text" id="content" name="content" class="form-control" placeholder="Email content" ></textarea>
                    </div>

                    <?php
                        include('./includes/flash_messages.php')
                    ?>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function add() {
        $('#addModal').modal('show');
    }
</script>

<?php include_once('includes/footer.php'); ?>
