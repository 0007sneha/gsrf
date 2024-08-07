<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../data/generalData.php';

$query = $_GET['search'] ?? "";
$queryCategory = $_GET['category'] ?? "";
$queryGender = $_GET['gender'] ?? "";

$isListAll = false;
include('../admin_assets/api/usersListApi.php');

$search_placeholder = 'Search...';

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <h1>Candidates</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Candidate List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<form method="GET" action="" class="row mb-3">
    <div class="col-md-5 mb-2">
        <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="<?php echo $search_placeholder ?>">
    </div>
    <div class="col-md-2 mb-2">
        <select class="form-control" name="category" onchange="submit()">
          <?php 
            if ($queryCategory=="") {
              $isSelectedNull = "Selected";
            } else {
              $isSelectedNull = "";
            }
            echo '<option value="" '.$isSelectedNull.'>Select Category</option>';
            foreach ($categoriesArr as $key2 => $value) {
              if ($value['id'] != 0) {
                if ($value['id'] == $queryCategory) {
                  $isSelected = "Selected";
                } else {
                  $isSelected = "";
                }
                echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['name'].'</option>';
              }
            }
          ?>
        </select>
    </div>
    <div class="col-md-2 mb-2">
        <select class="form-control" name="gender" onchange="submit()">
          <?php 
            if ($queryGender=="") {
              $isSelectedNull = "Selected";
            } else {
              $isSelectedNull = "";
            }
            foreach ($genderArr as $key3 => $value) {
              if ($value['id'] == $queryGender) {
                $isSelected = "Selected";
              } else {
                $isSelected = "";
              }
              echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['name'].'</option>';
            }
          ?>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?" class="btn btn-secondary ml-2">Clear Search</a>
    </div>
</form>
<?php // include('../admin_assets/includes/search_form.php');  ?>

<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <h5 class="card-title">All Candidates</h5>
      <a class="btn btn-primary m-auto" style="margin-right: 0px !important;" href="../admin_assets/api/exportCandidateListApi.php?s=<?php echo $query ?>&c=<?php echo $queryCategory ?>&g=<?php echo $queryGender ?>" title="Excel Sheet">
        <i class="ri-download-2-fill"></i> Download List
      </a>
    </div>
    
    <!-- Default Table -->
    <table class="table mt-4">
      <thead>
        <tr>
          <th scope="col text-center">#</th>
          <th scope="col text-center">Name</th>
          <th scope="col text-center">Email</th>
          <th scope="col text-center">Phone</th>
          <th scope="col text-center">Registered On</th>
          <th scope="col text-center">Status</th>
          <th scope="col text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php
        $key = 0;
        foreach ($users as $user) :
          $key++;
          $sr_no = $currentPage-1;
          $sr_no = $sr_no .''. $key;
          if ($key==10 ) {
            $sr_no = (int)$key * $currentPage;
          } else {
            $sr_no = (int)$sr_no;
          }
          
          if ($user['status']==0) {
            $user_status = 'Pending';// Verification
            $isStatus = 'pending';
          } else if ($user['status']==1) {
            $user_status = 'Verified';
            $isStatus = 'verified';
          } else if ($user['status']==2) {
            $user_status = 'Account Deleted';
            $isStatus = 'inactive';
          }
        ?>
          <tr>
            <th class="text-center" scope="row"><?php echo $sr_no?></th>
            <td><?php echo $user['first_name']." ".$user['middle_name']." ".$user['last_name'] ?></td>
            <td><?php echo $user['email']?></td>
            <td class="text-center"><?php echo getCountryCodeById($user['country_code'], $countryCodeArr).' '.$user['phone_no']?></td>
            <td class="text-center"><?php echo getDateFormat($user['created_at'])?></td>
            <td class="text-center"><div class="user_status <?php echo $isStatus; ?>"><?php  echo $user_status;?></div></td>
            <td class="text-center">
              <button type="button" class="btn btn-primary" title="View User Details" data-bs-toggle="modal" data-bs-target="#view-user-detail-<?php echo $user['id'] ?>">
                <i class="bi bi-card-text"></i>
                <!-- View Detail -->
              </button>
            </td>
          </tr>


          <div class="modal fade" id="view-user-detail-<?php echo $user['id'] ?>" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">User Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="container mt-5">
                    <div class="row">
                      <div class="col-md-6">
                        <dl class="row">
                          <dt class="col-sm-4">First Name:</dt>
                          <dd class="col-sm-8"><?php echo $user['first_name']; ?></dd>

                          <dt class="col-sm-4">Middle Name:</dt>
                          <dd class="col-sm-8"><?php echo $user['middle_name'] ? $user['middle_name']  : '-'; ?></dd>

                          <dt class="col-sm-4">Last Name:</dt>
                          <dd class="col-sm-8"><?php echo $user['last_name']; ?></dd>

                          <dt class="col-sm-4">Date of Birth:</dt>
                          <dd class="col-sm-8"><?php echo getDateFormat($user['dob']); ?></dd>

                          <dt class="col-sm-4">Phone Number:</dt>
                          <dd class="col-sm-8"><?php echo getCountryCodeById($user['country_code'], $countryCodeArr).' '.$user['phone_no']; ?></dd>
                        </dl>
                      </div>

                      <div class="col-md-6">
                        <dl class="row">
                          <dt class="col-sm-4">Identity Number:</dt>
                          <dd class="col-sm-8"><?php echo $user['identity_no']; ?></dd>

                          <dt class="col-sm-4">Email:</dt>
                          <dd class="col-sm-8"><?php echo $user['email']; ?></dd>

                          <dt class="col-sm-4">Verified:</dt>
                          <dd class="col-sm-8"><?php echo $user['is_verified'] == 0 ? 'No' : 'Yes'; ?></dd>
                          
                          <dt class="col-sm-4">Gender:</dt>
                          <dd class="col-sm-8"><?php echo $user['gender']; ?></dd>

                          <dt class="col-sm-4">Category:</dt>
                          <dd class="col-sm-8"><?php echo getCategoryNameById($user['category'], $categoriesArr); ?></dd>

                          <dt class="col-sm-4">Differently Abled:</dt>
                          <dd class="col-sm-8"><?php echo $user['differently_abled'] == 0 ? 'No' : 'Yes'; ?></dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

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



<?php include_once('includes/footer.php'); ?>