<?php
// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';

$currentPage = $_GET["page"] ?? 1;
$scheme_type = isset($_GET["scheme_type"]) ? $_GET["scheme_type"] : '1';
$query = $_GET['search'] ?? "";
$query = trim($query);

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$schemes = $db->get('scheme_types');

$db = getDbInstance();
if ($scheme_type) {
  $db->where('scheme_types_id', $scheme_type);
} else {
  $db->groupBy('scheme_types_id');
}
$scheme_batches = $db->get('scheme_batch', null, 'id, scheme_types_id, batch_no');
// echo '<pre>'; print_r($scheme_batches); exit;


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $data_to_store['scheme_batch_ids'] = implode(',', $data_to_store['scheme_batch_ids']);

    $db = getDbInstance();

    if (isset($data_to_store['id']) && $data_to_store['id']) {
      $db->where('id', $data_to_store['id']);
      $status = $db->update('feedback_questions', $data_to_store);

      $request_type = 'Updated';
      $request_fail = 'Update';
    } else {
      $status = $db->insert('feedback_questions', $data_to_store);
      
      $request_type = 'Added';
      $request_fail = 'Add';
    }
    
    if ($status) {
        $_SESSION['success'] = "Question ".$request_type." Successfully!";
    } else {
        $_SESSION['failure'] = "Failed to ".$request_fail." Question!";
    }
}

function isSchemeApplicable($scheme){
  $admin_type = '';
  if (isset($_SESSION['admin_type'])) {
    $admin_type = $_SESSION['admin_type'];
  }

  if ($admin_type == 'admin') {
    return true;
  } else {
    //Get DB instance. function is defined in config.php
    $db = getDbInstance();

    //Get Dashboard information
    $cuid = CUID();
    $db->where('id',$cuid );
    $currentUser = $db->getOne("scheme_admin_accounts");
    $applicableSchemes = json_decode($currentUser['applicable_schemes']);
    return in_array($scheme,  $applicableSchemes);
  }
}

$db = getDbInstance();
$db->pageLimit = 15;
// set page limit to 15 results per page. 20 by default
$db->where("title", '%'.$query.'%', 'like');
$db->where("scheme_type", $scheme_type);
$data = $db->arraybuilder()->paginate("feedback_questions fq", $currentPage, 'fq.id, fq.title, fq.scheme_type, fq.scheme_batch_ids, fq.minWords, fq.maxWords');

// echo '<pre>'; print_r($data); exit;

$search_placeholder = 'Search...';

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <h1>Scheme wise Review Questions</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Review Question List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<form method="GET" action="" class="row mb-4  ">
  <div class="col-md-4">
    <select class="form-select" id="scheme_type" name="scheme_type" onchange="this.form.submit()">
      <?php 
        foreach ($schemes as $scheme): 
          if(isSchemeApplicable($scheme['code'])): 
          ?>
            <option <?php if($scheme_type == $scheme['id']): ?> selected <?php endif?> value="<?php echo $scheme['id'] ?>"><?php echo $scheme['name'] ?></option>
          <?php 
          endif;
        endforeach; 
      ?>  
    </select>
  </div>
  <div class="col-md-4">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $search_placeholder; ?>">
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary">Search</button>
    <a href="?scheme_type=<?php echo $scheme_type ?>&search=&page=" class="btn btn-secondary ml-2">Clear Search</a>
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
          <h5 class="card-title col-md">All Questions</h5>
          <div class="col-md" style="text-align: end; align-self: center;">
            <a href="#" class="btn btn-primary" onclick="add()"><i class="bi bi-plus"></i> Add New</a>
          </div>
        </div>
        <!-- Default Table -->
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Batch</th>
              <th scope="col">Words <br> (Min-Max)</th>
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
                  $batch_ids = explode(',', $admin['scheme_batch_ids']);
                  if (!empty($batch_ids)) {
                      $db->where('id', $batch_ids, 'IN');
                      $batches = $db->get('scheme_batch', null, 'batch_no');
                      $admin['batch_numbers'] = implode(', ', array_column($batches, 'batch_no'));
                  } else {
                      $admin['batch_numbers'] = '';
                  }
                ?>
                  <tr>
                    <th class="text-center" scope="row"><?php echo $sr_no ?></th>
                    <td><?php echo $admin['title'] ?></td>
                    <td><?php echo $admin['batch_numbers'] ?></td>
                    <td class="text-center"><?php echo $admin['minWords'] .' - '. $admin['maxWords'].' Words' ?></td>
                    <td class="text-center"><a href="#" onclick="edit('<?php echo urlencode($adminDataEncoded) ?>')"><i class="bi bi-pencil-square"></i></a></td>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="list_feedback_questions.php" method="POST" id="create-fm">
                <input type="hidden" name="scheme_type" value="<?php echo $scheme_type; ?>">
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <label for="title" class="col-sm-12 col-form-label">Question Title</label>
                    <textarea required cols="30" rows="3" type="text" id="title" name="title" class="form-control" placeholder="Question Title" ></textarea>
                  </div>

                  <div class="col-sm-12">
                    <label for="scheme_batch_ids" class="col-sm-12 col-form-label">Scheme Batch</label>
                    <p>Hold down the Ctrl (windows) / Command (Mac) button to select applicable schemes:</p>
                    <select multiple class="form-select" id="scheme_batch_ids" name="scheme_batch_ids[]" required>
                      <?php
                      foreach ($scheme_batches as $scheme_batch) :
                        ?>
                        <option value="<?php echo $scheme_batch['id'] ?>"> <?php echo $scheme_batch['batch_no'] ?> </option>
                        <?php
                      endforeach;
                      ?>
                    </select>
                    <ul id="selected-options" class="mt-4">
                    </ul>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12 row">
                    <div class="col-sm-6"><label for="scheme_batch_ids" class="col-sm-12 col-form-label">Min Words</label><input type="number" value="20" name="minWords" class="form-control" placeholder="Min Words" required></div>
                    <div class="col-sm-6"><label for="scheme_batch_ids" class="col-sm-12 col-form-label">Max Words</label><input type="number" value="100" name="maxWords" class="form-control" placeholder="Max Words" required></div>
                  </div>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" name="id" id="edit-id">
                    <input type="hidden" name="scheme_type" id="edit-scheme_type">
                    
                    <div class="mb-3">
                        <label for="edit-title" class="form-label">Question Title</label>
                        <textarea required cols="30" rows="3" id="edit-title" name="title" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit-scheme_batch_ids" class="form-label">Scheme Batch</label>
                        <select multiple class="form-select" id="edit-scheme_batch_ids" name="scheme_batch_ids[]" required>
                            <?php
                            foreach ($scheme_batches as $scheme_batch) {
                                echo '<option value="'.$scheme_batch['id'].'">'.$scheme_batch['batch_no'].'</option>';
                            }
                            ?>
                        </select>
                        <p>Press CTRL(control) button to add/remove multiple options</p>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="edit-minWords" class="form-label">Min Words</label>
                                <input type="number" id="edit-minWords" name="minWords" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="edit-maxWords" class="form-label">Max Words</label>
                                <input type="number" id="edit-maxWords" name="maxWords" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
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

  function edit(adminDataEncoded) {
    var adminData = JSON.parse(decodeURIComponent(adminDataEncoded));

    $('#edit-id').val(adminData.id);
    $('#edit-scheme_type').val(adminData.scheme_type);
    $('#edit-title').val(decodeURIComponent(adminData.title.replace(/\+/g, ' ')));
    $('#edit-minWords').val(adminData.minWords);
    $('#edit-maxWords').val(adminData.maxWords);

    $('#edit-scheme_batch_ids').val(adminData.scheme_batch_ids.split(','));
  
    // Reset and populate the scheme_batch_ids select element
        $('#edit-scheme_batch_ids option').prop('selected', false); // Clear previous selections
        var selectedBatchIds = adminData.scheme_batch_ids.split(','); // Assuming the ids are comma-separated
        selectedBatchIds.forEach(function(id) {
            $('#edit-scheme_batch_ids option[value="' + id + '"]').prop('selected', true);
        });

    $('#editModal').modal('show');
}

$('#editForm').on('submit', function(event) {
    event.preventDefault();

    $.ajax({
        url: './list_feedback_questions.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            // Handle success, e.g., reload the page or update the table
            location.reload();
        },
        error: function(xhr, status, error) {
            // Handle error
            alert('Failed to update the question.');
        }
    });
});
</script>

<?php include_once('includes/footer.php'); ?>
