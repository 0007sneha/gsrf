<?php
// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';
// require_once 'helpers/DatabasePlugin.php';
// require_once '../config/send_email.php';
// require_once '../data/generalData.php'; 

// require_once '../admin_assets/includes/email_template.php';
// require_once '../admin_assets/api/schemeApplicationStatusApiData.php';
// include_once('includes/header.php');
$admin_type = '';
if (isset($_SESSION['admin_type'])) {
  $admin_type = $_SESSION['admin_type'];
} 

?>
<div class="pagetitle">
  <h1><?php echo $page_title  ?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo 'index.php?yearlydata='.$selectedYear; ?>">Home</a></li>
      <li class="breadcrumb-item active"><?php echo $site_map_title ?></li>
    </ol>
  </nav> 
</div><!-- End Page Title -->


<form method="GET" action="" class="row mb-3">
    <input type="hidden" class="form-control" name="yearlydata" value="<?php echo $selectedYear ?>" >
    <div class="col-md-2 mb-2">
        <select class="form-control" name="schemeBatch" onchange="submit()">
          <option value="">Select Scheme Batch No</option>
          <?php 
            foreach ($scheme_batch_data as $key2 => $value) {
              if ($value['id'] == $schemeBatchId) {
                $isSelected = "Selected";
              } else {
                $isSelected = "";
              }
              echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['batch_no'].'</option>';
            }
          ?>
        </select>
    </div>
    <div class="col-md-5 mb-2">
        <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="<?php echo $search_placeholder ?>">
    </div>
    <div class="col-md-2 mb-2">
        <select class="form-control" name="fb_app_status" onchange="submit()">
          <?php 
            foreach ($feedbackAppStatusArr as $key2 => $value) {
              if ($value['id'] == $queryFbAppStatus) {
                $isSelected = "Selected";
              } else {
                $isSelected = "";
              }
              echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['name'].'</option>';
            }
          ?>
        </select>
    </div>
    <input type="hidden" class="form-control" name="page" value="" >
    <div class="col-md-3 mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?yearlydata=<?php echo $selectedYear ?>&schemeBatch=&search=&fb_app_status=&page=" class="btn btn-secondary ml-2">Clear Search</a>
    </div>
</form>
<?php
// include('../admin_assets/includes/search_form.php');
include('./includes/flash_messages.php');
?>

<div class="card card_having_table mt-4">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <h5 class="card-title">Applications Received</h5>
      <?php if (count($records) > 0) { ?>
        <a class="btn btn-primary m-auto" style="margin-right: 0px !important;" href="../admin_assets/api/exportSchemeListingApi.php?<?php echo 'yearlydata='.$selectedYear.'&schemeBatch='.$schemeBatchId.'&search='.$query.'&fb_app_status='.$queryFbAppStatus.'&s='.$scheme_table.'&n='.$scheme_name ?>" title="Excel Sheet">
          <i class="ri-download-2-fill"></i> Download List
        </a>
      <?php } ?>
    </div>
    <table class="table text-center">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Candidate ID</th>
          <th scope="col">Name</th>
          <th scope="col">App Form</th>
          <th scope="col">Submitted On</th>
          <th scope="col">Review Status</th>
          <th scope="col">Rev Task</th>
          <th scope="col">App Status</th>
          <th scope="col">Assign</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $uidForTableRow = '';
          if (count($records) == 0) { 
            echo '<tr><td colspan="9">No Records Found</td></tr>';
          } else {
            $key = 0;
            foreach ($records as $record) :
              $key++;
              $candidate_name = $record["first_name"] .' '.$record["last_name"] ;
            
              $sr_no = $currentPage-1;
              $sr_no = $sr_no .''. $key;
              if ($key==10 ) {
                $sr_no = (int)$key * $currentPage;
              } else {
                $sr_no = (int)$sr_no;
              }
              $app_feedback_status = $record['ra_feedbackGiven'];
              $ra_status = $record['ra_status'];
              $uidForTableRow = $record['application_no'].$record['ra_id'];
              ?>
                <tr>
                  <td scope="row"><?php echo $sr_no ?></td>
                  <td><?php echo $record['application_no']; ?></td>
                  <td class="text-start"><?php echo $record['first_name'] . " " . $record['middle_name'] . " " . $record['last_name']; ?></td>
                  <td>
                    <?php 
                      $file_to_download = "../".$record['file_application_form'];
                      if ($record['file_application_form'] && file_exists($file_to_download)) {
                        echo '<a href="'.$file_to_download.'" download> <i class="ri-download-2-fill"> Download </i></a>';
                      } else {
                        echo '<a href="#" title="Error: File not found on server. The file might have been moved or deleted."> <i class="ri-file-excel-line"> File not found </i></a>';
                      }
                    ?>
                  </td>
                  <td><?php echo $record['submitted_date']; ?></td>
                  <td>
                    <?php 
                      if($app_feedback_status == "") {
                        echo '<span class="badge border-secondary border-1 text-secondary">Unassigned</span>';
                      } else if($app_feedback_status < 1 && ($ra_status == 0 || $ra_status == 2)) {
                        echo '<span class="badge border-secondary border-1 text-danger">Reviewer ('.$record['rev_name'].')</span>';
                      } else if ($app_feedback_status == 0 && $ra_status == 1 ) {
                        echo '<span class="badge border-primary border-1 text-primary">In Review ('.$record['rev_name'].')</span>
                              <br>
                              <span class="badge border-primary border-1 text-danger">Due Date on ('.date('d-m-Y',strtotime($record['ra_due_date'])).')</span>';
                      } else {
                        // if feedback given 1,2,3 and status is 0,1 show the view page
                        echo '<span class="badge border-success border-1 text-success">
                                Reviewed ('.$record['rev_name'].') 
                                <br>
                                <a class="mt-2" href="view_feedback.php?yearlydata='.$selectedYear.'&search='.$query.'&fb_app_status='.$queryFbAppStatus.'&page='.$currentPage.'&aid='.$record['application_no'].'&r='.$record['rev_id'].'" type="button" class="btn btn-primary btn-sm">View Review</a>
                              </span>';
                      }
                    ?>
                  </td>
                  <td>
                    <?php 
                      $btnIconForTask = $btnStatus = $btnIconForTaskColor = $appTaskStatus = $email_subject ="";
                      if ($ra_status == 1 && $app_feedback_status == 1) { 
                        $btnTitle = "Reviewed";
                        $btnIconForTask .= "check2";
                        $btnClassForReviewerTask = "light";
                        $modalTitle = "";
                        $btnStatus = "Disabled";
                        $btnIconForTaskColor = "text-primary";
                      } else if ($ra_status == 1 && $app_feedback_status > 1) { 
                        $btnTitle = "Reviewed";
                        $btnIconForTask .= "check2-all";
                        $btnClassForReviewerTask = "light";
                        $modalTitle = "";
                        $btnStatus = "Disabled";
                        $btnIconForTaskColor = "text-success";
                      } else if (($ra_status == 0 || $ra_status == 2)) { 
                        $btnTitle = "Re-assign Reviewer";
                        $btnIconForTask .= "arrow-counterclockwise";
                        $btnClassForReviewerTask = "warning";
                        $modalTitle = "Do you want to Re-assign the Task to the reviewer?";
                        $appTaskStatus = 1;
                        // $email_subject = "Reassignment of Application No. ".$record['application_no']." for Review";
                        $typeId = 11;
                      } else if ($ra_status == 1 ) { 
                        $btnTitle = "Remove Reviewer";
                        $btnIconForTask .= "trash";
                        $btnClassForReviewerTask = "danger";
                        $modalTitle = "Please confirm, Remove reviewer from the assigned Task?";
                        $appTaskStatus = 0;
                        // $email_subject = "Revoking Assigned Application No. ".$record['application_no'];
                        $typeId = 12;
                      }
                      $email = getEmailData($typeId);
                      $email_subject = $email['subject'];
                      $email_content = $email['content'];
                      
                      $btnIconForTask .= " ";
                      if (isset($ra_status)) { 
                        ?>
                        <button type="button" class="btn btn-<?php echo $btnClassForReviewerTask ?>" title="<?php echo $btnTitle ?>" data-bs-toggle="modal" data-bs-target="#reviewer-delete-<?php echo $uidForTableRow?>" <?php echo $btnStatus?>>
                          <i class="bi bi-<?php echo $btnIconForTask ?> <?php echo $btnIconForTaskColor ?>"></i>
                        </button>
                        <div class="modal fade" id="reviewer-delete-<?php echo $uidForTableRow ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Assigned Reviewer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="<?php echo $file_name ?>" method="POST">
                                <div class="modal-body text-start text-md-end">
                                  <h5 class="text-start">
                                    <strong>
                                      <?php echo $modalTitle; ?>
                                    </strong>
                                  </h5>
                                  <div class="row mt-4 mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Application No </label>
                                    <div class="col-sm-8 col-md-8">
                                      <input class="form-control" type="text" name="application_no" value="<?php echo $record["application_no"] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Reviewer </label>
                                    <div class="col-sm-8 col-md-8">
                                      <input class="form-control" type="text" name="rev_name" value="<?php echo $record['rev_name'] ?>" readonly>
                                      <input class="form-control" type="hidden" name="ra_id" value="<?php echo $record['ra_id'] ?>" readonly>
                                      <input class="form-control" type="hidden" name="rev_email" value="<?php echo $record['rev_email'] ?>" readonly>
                                      <input class="form-control" type="hidden" name="ra_status" value="<?php echo $appTaskStatus ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="email_subject" class="col-sm-4 col-md-4 col-form-label">Subject</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input class="form-control" type="text" name="email_subject" value="<?php echo $email_subject; ?>" >
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="email_content_ra_ta" class="col-sm-4 col-md-4 col-form-label">Email Content</label>
                                    <div class="col-sm-8 col-md-8">
                                      <textarea name="email_content" class="form-control tinymce-editor" cols="20" rows="5"> <?php echo $email_content; ?> </textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" name="update-reviewer-task-assignment" class="btn btn-<?php echo $btnClassForReviewerTask ?>"><?php echo $btnTitle ?></button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php 
                      }
                    ?>
                  </td>
                  <td>
                    <?php 
                      if ($app_feedback_status == "" && $scheme_table != "scheme_summer_school" ) {
                        echo '<span class="badge border-secondary border-1 text-secondary">Unassigned</span>';
                      } else if ($ra_status == 0 && $scheme_table != "scheme_summer_school" ) {
                        echo '<span class="badge border-secondary border-1 text-danger">Reviewer Task Deleted</span>';
                      } else if ($app_feedback_status == 0 && $ra_status == 1 && $scheme_table != "scheme_summer_school" ) {
                        echo '<span class="user_status pending">PENDING REVIEW</span>';
                      } else if ((($app_feedback_status == 1 && $ra_status == 1) || $scheme_table == "scheme_summer_school") && $admin_type=="admin") { 
                        ?>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update-application-status-<?php echo $uidForTableRow ?>">
                            Update Status
                          </button>
                          <div class="modal fade" id="update-application-status-<?php echo $uidForTableRow ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Update Application Status</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo $file_name ?>" method="POST">
                                  <div class="modal-body text-start text-md-end">
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Application No </label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="application_no" value="<?php echo $record["application_no"] ?>" readonly>
                                        <input type="hidden" name="rev_id" value="<?php echo $record["rev_id"] ?>" hidden>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Reviewer Name</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="rev_name" value="<?php echo $record["rev_name"] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label class="col-sm-4 col-md-4 col-form-label star">Select Status</label>
                                      <div class="col-sm-8 col-md-8">
                                        <select class="form-select" name="feedback_status" aria-label="Default select example" required>
                                          <option value="">Select Application Status</option>
                                          <option value="3">Accepted</option>
                                          <option value="2">Rejected</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="app_status_remarks" class="col-sm-4 col-md-4 col-form-label">Remarks</label>
                                      <div class="col-sm-8 col-md-8">
                                        <textarea name="app_status_remarks" class="form-control" placeholder="Remarks (if Any)" cols="20" rows="5"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="application-status-update" class="btn btn-primary">Update Status</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        <?php 
                      } else {
                        if($app_feedback_status == 3 && $ra_status == 1 ) {
                          $app_status_msg = 'ACCEPTED';
                        } else if($app_feedback_status == 2 && $ra_status == 1 ) {
                          $app_status_msg = 'REJECTED';
                        } else if($app_feedback_status == 1 && $ra_status == 1 ) {
                          $app_status_msg = 'REVIEWED'; // update app status -0 called already
                        } else if($app_feedback_status == 0 && $ra_status == 2 ) {
                          $app_status_msg = 'DECLINED';
                        } else {
                          $app_status_msg = 'PENDING';
                        }
                        ?>
                          <span class="user_status <?php echo $app_feedback_status== 3 ? '' : 'inactive' ; ?>">
                            <?php echo $app_status_msg ?>
                          </span>
                        <?php 
                      }
                    ?>
                  </td>
                  <td>
                    <?php 
                      if ($scheme_table == "scheme_summer_school" ) {
                        echo '-';
                      } else {
                        if ($app_feedback_status == 0 && $ra_status == 1) {
                          $email = getEmailData(9);
                          $email_subject = $email['subject'];
                          $email_content = $email['content'];
                          ?>
                          <button type="button" class="btn btn-warning" title="Update Due Date" data-bs-toggle="modal" data-bs-target="#extending-review-due-date-<?php echo $uidForTableRow ?>">
                            <i class="bi bi-calendar2-plus"></i><!-- update due date -->
                          </button>
                          <div class="modal fade" id="extending-review-due-date-<?php echo $uidForTableRow ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Extend Due Date for the Assigned Task</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo $file_name ?>" method="POST">
                                  <div class="modal-body text-start text-md-end">
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Application No</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input type="text" name="application_no" value="<?php echo $record['application_no'] ?>" class="form-control" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Reviewer Name</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input type="text" name="reviewer_id" value="<?php echo $record['rev_id'] ?>" class="form-control" hidden>
                                        <input type="text" value="<?php echo $record['rev_name'] ?>" class="form-control" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label star">Due Date</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input type="date" name="due_date" min="<?php echo date("Y-m-d"); ?>" value=" "  class="form-control" required>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="email_subject" class="col-sm-4 col-md-4 col-form-label">Subject</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="email_subject" value="<?php echo $email_subject ?>" >
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="email_content_ra" class="col-sm-4 col-md-4 col-form-label">Email Content</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input type="hidden" name="scm_title" value="<?php echo $record['scm_title'] ?>" readonly>
                                        <textarea name="email_content" class="form-control tinymce-editor" cols="20" rows="10"><?php echo $email_content ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="extending-review-due-date-submit" class="btn btn-primary">Re-assign Due Date</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <?php 
                        } else {
                          ?>
                          <button type="button" class="btn btn-light" title="Update Due Date" disabled>
                            <i class="bi bi-calendar2-plus"></i>
                          </button>
                          <?php 
                        }
                        $email = getEmailData(8);
                        $email_subject = $email['subject'];
                        $email_content = $email['content'];
                        ?>
                        <button type="button" class="btn btn-primary" title="Assign Reviewer" data-bs-toggle="modal" data-bs-target="#reviewer-assign-<?php echo $uidForTableRow ?>">
                          <i class="bi bi-person-plus"></i><!-- Assign Rev -->
                        </button>
                        <div class="modal fade" id="reviewer-assign-<?php echo $uidForTableRow ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Assign Reviewer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="<?php echo $file_name ?>" method="POST">
                                <div class="modal-body text-start text-md-end">
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Application No</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input type="text" name="application_no" value="<?php echo $record['application_no'] ?>" class="form-control" readonly>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Select Reviewer</label>
                                    <div class="col-sm-8 col-md-8">
                                      <!-- onchange="getReviewerName(this, '<?php echo $uidForTableRow; ?>');"  -->
                                      <select class="form-select" name="reviewer_id" aria-label="Default select example" required> 
                                        <option value="" disabled selected>Select Reviewer</option>
                                        <?php foreach ($reviewers as $reviewer) : ?>
                                          <option value="<?php echo $reviewer['id'] ?>"><?php echo $reviewer['name'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Due Date</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input type="date" name="due_date" min="<?php echo date("Y-m-d"); ?>" value=" "  class="form-control" required>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="email_subject" class="col-sm-4 col-md-4 col-form-label">Subject</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input class="form-control" type="text" name="email_subject" value="<?php echo $email_subject ?>" >
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="email_content_ra" class="col-sm-4 col-md-4 col-form-label">Email Content</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input type="hidden" name="scm_title" value="<?php echo $record['scm_title'] ?>" readonly>
                                      <textarea name="email_content" class="form-control tinymce-editor" cols="20" rows="10"><?php echo $email_content ?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" name="assign-reviewer-submit" class="btn btn-primary">Assign</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php 
                      } 
                    ?>
                  </td>
                  <td>  
                    <?php 
                      if(($app_feedback_status == "" || ($ra_status == 0 || $ra_status == 2)) && $scheme_table != "scheme_summer_school" ) { 
                        echo '-'; 
                      } else if ($app_feedback_status == 0 && $ra_status == 1 && $scheme_table != "scheme_summer_school" ) {
                          $email = getEmailData(10);
                          $email_subject = $email['subject'];
                          $email_content = $email['content'];
                          $due_date = date('d-m-Y',strtotime($record['ra_due_date']));
                          // set email variables to replace
                          $placeholders = array('$rev_name', '$application_no', '$due_date');
                          $values = array($record['rev_name'], $record['application_no'], $due_date);
                        ?>
                        <button type="button" class="btn btn-warning" title="Reviewer Reminder Mail" data-bs-toggle="modal" data-bs-target="#reviewer-reminder-<?php echo $uidForTableRow ?>">
                          <i class="bi bi-envelope-exclamation"></i><!-- Send email Reminder -->
                        </button>
                        <div class="modal fade" id="reviewer-reminder-<?php echo $uidForTableRow ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Reminder for Reviewer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="<?php echo $file_name ?>" method="POST">
                                <div class="modal-body text-start text-md-end">
                                  <p class="text-start"><strong>This is auto generated mail, you can alter the SUBJECT and add your MESSAGE, if required.  </strong></p>
                                  <input type="text" name="application_no" value="<?php echo $record['application_no'] ?>" hidden>
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Rev Name</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input class="form-control" type="text" name="reviewer_name_rem" value="<?php echo $record['rev_name'] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Mail To</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input class="form-control" type="text" name="mail_to_rem" value="<?php echo $record["rev_email"] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Subject</label>
                                    <div class="col-sm-8 col-md-8">
                                      <input class="form-control" type="text" name="email_subject" value="<?php echo $email_subject ?>">
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="email_content_rr" class="col-sm-4 col-md-4 col-form-label">Email Content</label>
                                    <div class="col-sm-8 col-md-8">
                                      <textarea name="email_content" class="form-control tinymce-editor" cols="20" rows="10"><?php echo str_replace($placeholders, $values, $email_content); ?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" name="email-reminder" class="btn btn-primary">Send Email</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php 
                      } else {
                        if ($record['rev_fb_app_status_response']==1 || $scheme_table == "scheme_summer_school") {
                            $email = getEmailData(15);
                            $email_subject = $email['subject'];
                            $email_content = $email['content'];
                            // set email variables to replace
                            $placeholders = array('$candidate_name', '$application_no', '$scheme_name');
                            $values = array($candidate_name, $record['application_no'], $scheme_name);
                          ?>
                          <button type="button" class="btn btn-info" title="Notify Candidate" data-bs-toggle="modal" data-bs-target="#user-notification-<?php echo $uidForTableRow ?>">
                            <i class="bi bi-envelope"></i><!-- Send Notification to Candidate -->
                          </button>
                          <div class="modal fade" id="user-notification-<?php echo $uidForTableRow ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Scheme Notification</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo $file_name ?>" method="POST">
                                  <div class="modal-body text-start text-md-end">
                                    <p class="text-start"><strong> Please enter SUBJECT and Body of the notification.</strong></p>
                                    <input type="text" name="scheme_name" value="<?php echo $scheme_name;?>" hidden>
                                    <div class="row mb-4">
                                      <label for="application_no" class="col-sm-4 col-md-4 col-form-label">Application No </label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="application_no" value="<?php echo $record["application_no"] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="candidate_name" class="col-sm-4 col-md-4 col-form-label">Candidate Name</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="candidate_name" value="<?php echo $candidate_name ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="candidate_mail" class="col-sm-4 col-md-4 col-form-label">Mail To</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="candidate_mail" value="<?php echo $record["email"] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="email_subject" class="col-sm-4 col-md-4 col-form-label">Subject</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="email_subject" value="<?php echo $email_subject ?>" required>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="email_content_sn" class="col-sm-4 col-md-4 col-form-label">Email Content</label>
                                      <div class="col-sm-8 col-md-8">
                                        <textarea name="email_content" class="form-control tinymce-editor" cols="20" rows="10"><?php echo str_replace($placeholders, $values, $email_content); ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="user-notification-email" class="btn btn-info">Send Email</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <?php 
                        } else {
                          if ($app_feedback_status == 3) {
                            $email_type = 13;
                          } else if ($app_feedback_status == 2) {
                            $email_type = 14;
                          }
                          $email = getEmailData($email_type);
                          $email_subject = $email['subject'];
                          $email_content = $email['content'];
                          // set email variables to replace
                          $placeholders = array('$candidate_name', '$application_no', '$scheme_name');
                          $values = array($candidate_name, $record['application_no'], $scheme_name);
                          ?>
                          <button type="button" class="btn btn-success" title="Candidate-Application Status" data-bs-toggle="modal" data-bs-target="#application-response-<?php echo $uidForTableRow ?>">
                            <i class="bi bi-envelope-check"></i><!-- Send app status updates to candidate -->
                          </button>
                          <div class="modal fade" id="application-response-<?php echo $uidForTableRow ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Update on Application Status</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo $file_name ?>" method="POST">
                                  <div class="modal-body text-start text-md-end">
                                    <p class="text-start"><strong>This is auto generated mail, you can alter the SUBJECT and add your MESSAGE, if required. </strong></p>
                                    <?php 
                                      $btn_access = ''; 
                                      if ($app_feedback_status<2 && $ra_status == 1 ) {
                                        $btn_access = 'DISABLED';
                                        ?>
                                        <div class="alert alert-danger alert-dismissable mt-4">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                          <strong>Oops! </strong>Please update Application Status! 
                                        </div>
                                        <?php 
                                      }
                                    ?>
                                    <input type="text" name="candidate_name" value="<?php echo $candidate_name ?>" hidden>
                                    <input type="text" name="scheme_name" value="<?php echo $scheme_name; ?>" hidden>
                                    <input type="text" name="app_feedback_status" value="<?php echo $app_feedback_status ?>" hidden>
                                    <input type="hidden" name="rev_id" value="<?php echo $record["rev_id"] ?>" hidden>
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Application No </label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="application_no" value="<?php echo $record["application_no"] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Mail To</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="candidate_mail" value="<?php echo $record["email"] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="inputNumber" class="col-sm-4 col-md-4 col-form-label">Subject</label>
                                      <div class="col-sm-8 col-md-8">
                                        <input class="form-control" type="text" name="email_subject" value="<?php echo $email_subject ?>">
                                      </div>
                                    </div>
                                    <div class="row mb-4">
                                      <label for="email_content_uas" class="col-sm-4 col-md-4 col-form-label">Email Content</label>
                                      <div class="col-sm-8 col-md-8">
                                        <textarea name="email_content" class="form-control tinymce-editor" cols="20" rows="10"><?php echo str_replace($placeholders, $values, $email_content); ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="application-status-response" class="btn btn-primary" $btn_access >Send Email</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <?php 
                        }
                      }
                    ?>
                  </td>
                </tr>
              <?php 
            endforeach; 
          }
        ?>
      </tbody>
    </table>
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <?php echo paginationLinks($currentPage, $db->totalPages, "") ?>
      </ul>
    </nav>
    <!-- End Default Table Example -->
  </div>
</div>


<script>
  // const modalId = "<?php echo $modalId; ?>";
  // $(document).ready(function() {
    // if (modalId !== "") {
    //   let fullModalId = "#reviewer-assign-" + modalId;
    //   $(fullModalId).modal("show");
    // }
  // });

  // function getReviewerName(dropdownEvent, uidForTableRow) {
  //   // Get the selected option
  //   const selectedOption = dropdownEvent.options[dropdownEvent.selectedIndex];
  //   // Get and display the text content of the selected option
  //   document.getElementById('assign-reviewer-name-'+uidForTableRow).innerText = 'selectedOption.innerHTML';
  
  // }
  
  // // onchange="getReviewerDueDate(this, '<?php echo $uidForTableRow; ?>');"
  // function getReviewerDueDate(e, uidForTableRow) {
  //   // Get and display the text content of the selected option
  //   document.getElementById('assign-reviewer-dueDate-'+uidForTableRow).innerText = e.value;
  // }
</script>

<?php include_once('includes/footer.php'); ?>