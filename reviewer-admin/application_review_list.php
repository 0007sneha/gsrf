<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../config/send_email.php';

// $scheme_table = 'scheme_doctoral_fellowship';
$file_name = 'application_review_list.php';
$currentPage = $_GET["page"] ?? 1;

require_once '../admin_assets/includes/email_template.php';
include('../admin_assets/includes/custom_functions.php');

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$db->where("ra.reviewer_id", CUID())
    ->where("ra.status", 1);
$db->where("ra.feedbackGiven", 0); // show only pending reviews
// $db->where("(ra.feedbackGiven = 0 OR ra.feedbackGiven = 1)"); // else show Pending & Reviewed reviews
$application_type_key_arr = $db->get("reviewers_assigned ra", NULL, ['ra.application_no']);

// Group the applications by prefix and get the types of groups
$groupedData = groupByPrefix($application_type_key_arr);
// Print the types of groups and the grouped applications
// echo "Types of Groups: " . implode(', ', $groupedData['types']) . "\n";
$reviewer_tabs_arr = $groupedData['types'];
// CDFA($groupedData);

// DFA(getReviewersTaskAssigned('scheme_doctoral_fellowship'));
// DFA(getReviewersTaskAssigned('scheme_minor_project_grant'));
// DFA(getReviewersTaskAssigned('scheme_research_startup_grant'));

function getReviewersTaskAssigned($scheme_table) 
{
    $currentPage = $_GET["page"] ?? 1;
    $query = $_GET['search'] ?? "";
    $query = trim($query);

    
    // summer school scheme no review application required
    $is_scheme_maj = $is_scheme_min = false;
    if ($scheme_table=='scheme_major_project_grant' || $scheme_table=='scheme_minor_project_grant') {
      $is_scheme_maj = true;
      $is_scheme_min = true;
    }

    $db = getDbInstance();
    $db->pageLimit = 10;
    $db->where("s.application_no", '%' . $query . '%', 'like');
    // $db->orWhere("usr.first_name", '%' . $query . '%', 'like');
    // $db->orWhere("usr.last_name", '%' . $query . '%', 'like');
    // $db->orWhere("CONCAT(usr.first_name, ' ', usr.last_name)", '%' . $query . '%', 'like');
    $db->where("ra.reviewer_id", CUID())
        ->where("s.status", 1)
        ->where("s.form_status", 1)
        ->where("ra.status", 1)
        ->where("ra.feedbackGiven", 0) // show only pending reviews
        // ->where("(ra.feedbackGiven = 0 OR ra.feedbackGiven = 1)") // else show Pending & Reviewed reviews
        ->orderBy("ra.due_date", "ASC")
        ->join($scheme_table.' s', 'ra.application_no = s.application_no', 'LEFT')
        ->join('reviewers rev', 'rev.id = ra.reviewer_id', 'LEFT')
        ->join('users usr', 's.user_id = usr.id', 'LEFT');
    if ($is_scheme_maj) {
      $db->join('scheme_fellowship_investigator_details invst', 's.id = invst.scheme_major_project_grant_id AND invst.type = "principal_investigator"', 'LEFT');
    } else if ($is_scheme_min) {
      $db->join('scheme_fellowship_investigator_details invst', 's.id = invst.scheme_minor_project_grant_id AND invst.type = "principal_investigator"', 'LEFT');
    }
    if ($is_scheme_maj || $is_scheme_min) {
      $reviews = $db->paginate("reviewers_assigned ra", $currentPage, 'ra.id AS ra_id, ra.reviewer_id, ra.application_no, ra.feedbackGiven, ra.due_date,
                      s.file_application_form, s.status AS app_status, s.form_status AS app_form_status,
                      rev.id AS rev_id, rev.name AS rev_name, rev.email AS rev_email, 
                      CONCAT(IFNULL(invst.first_name, usr.first_name), " ", IFNULL(invst.middle_name, usr.middle_name), " ", IFNULL(invst.last_name, usr.last_name)) AS invst_name 
                  ');
    } else {
      $reviews = $db->paginate("reviewers_assigned ra", $currentPage, 'ra.id AS ra_id, ra.reviewer_id, ra.application_no, ra.feedbackGiven, ra.due_date,
                      s.file_application_form, s.status AS app_status, s.form_status AS app_form_status,
                      rev.id AS rev_id, rev.name AS rev_name, rev.email AS rev_email, 
                      CONCAT(IFNULL(s.first_name, usr.first_name), " ", IFNULL(s.middle_name, usr.middle_name), " ", IFNULL(s.last_name, usr.last_name)) AS invst_name 
                  ');
    }
    return ['data' => $reviews, 'db' => $db];
    // $db->getLastQuery();
}

function getTaskCount($type, $scheme_table) {
    $db = getDbInstance();
    $count = $db->where('reviewer_id', CUID())
    ->where('status', 1)
    ->where('feedbackGiven', 0)
    // ->where("(feedbackGiven = 0 OR feedbackGiven = 1)") // else show Pending & Reviewed reviews
    ->where('application_no', $type.'%', 'LIKE')
    ->getValue('reviewers_assigned', 'COUNT(*) ');
    return $count;
}

$db = getDbInstance();
$db->where('id', CUID());
$reviewer = $db->getOne('reviewers', null, 'id, name, email');

$db = getDbInstance();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_to_store = filter_input_array(INPUT_POST);

    $application_no = $data_to_store['application_no'];
    $rev_id = $data_to_store['rev_id'];

    if (isset($_POST["application-status-update"])) {
        unset($data_to_store['application-status-update']);

        $feedback_status = $data_to_store['feedback_status'];
        $app_status_remarks = $data_to_store['app_status_remarks'];

        if ($feedback_status==1) {
            $_SESSION['warning'] = "Please select Application Status!";
        } else {
            $data = array('feedbackGiven' => $feedback_status);
            $db->where('application_no', $application_no);
            $db->where('reviewer_id', $rev_id);
            $db->update('reviewers_assigned', $data);

            $data = array('remarks' => $app_status_remarks);
            $db = getDbInstance();
            $db->where('application_id', $application_no);
            $db->where('reviewer_id', $rev_id);
            $db->update('reviewers_feedback', $data);

            $_SESSION['success'] = "Saved response for Application Status!";
        }
    } else if (isset($_POST["application-task-decline"])) {
        unset($data_to_store['application-task-decline']);

        $data = ['status' => 2];
        $db = getDbInstance();
        $db->where('application_no', $application_no);
        $db->where('reviewer_id', $rev_id);
        $result = $db->update('reviewers_assigned', $data);

        if ($result) {
            $db = getDbInstance();
            $db->where("type", 16);
            $db->where("status", 1);
            $email = $db->getOne("emails", "subject, content");

            $msg = 'Reviewer '.$reviewer['name'].'Declined to Review the Task.';
            $subject = $email['subject'];
            $content = $email_template_head_before_title;
            $content .= "<title>".$subject."</title>";
            $content .= $email_template_head_after_title;
            $content .= $email['content'];
            $content .= $email_template_footer;

            $response = smtp_mailer($reviewer['email'], $subject, $content);
            if ($response) {
                $log_data = [
                    ':log_type' => 'Confirmation',
                    ':sender_id' => 0,
                    ':sent_by' => 'GSRF',
                    ':application_no' => $application_no,
                    ':title' => $msg,
                    ':receiver' => 'Reviewer',
                    ':sent_from' => '',
                    ':sent_to' => $reviewer['email'],
                    ':subject' => $subject,
                    ':message' => contentFromHtmlBody($content),
                ];
            }
            $_SESSION['info'] = "Your response has been recorded, Thank you for updating us.";
            header("Refresh:4");
        } else {
            $_SESSION["failure"] = "Failed to update record, Please contact developer to resolve the issue.";
        }
    }
}

$search_placeholder = 'Search Candidate ID or Name';

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <h1><?php echo $currentPageName ?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Applications List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<?php
include('./includes/flash_messages.php');
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title mb-4">Pending Reviews</h5>

    <!-- <?php include('../admin_assets/includes/search_form.php');  ?> -->

    <!-- Bordered Tabs Justified -->
    <ul class="nav nav-tabs nav-tabs-bordered d-flex mt-5" id="borderedTabJustified" role="tablist">
      <?php 
        foreach ($reviewer_tabs_arr as $key => $tab) {
          $active_tab  = '';
          if ($key==0) {
            $active_tab  = 'active';
          }
      ?>
          <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100 <?php echo $active_tab ?>" id="<?php echo $tab['prefix'] ?>-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-<?php echo $tab['prefix'] ?>" type="button" role="tab" aria-controls="<?php echo $tab['prefix'] ?>" aria-selected="true">
              <?php echo $tab['scheme_name'] ?>
              <span class="badge bg-danger text-white"><?php echo $tab['task_count'] ?></span>
            </button>
          </li>
      <?php 
        }
      ?>
    </ul>

    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
      <?php 
        foreach ($reviewer_tabs_arr as $key => $tab) {
          $active_tab_content  = '';
          if ($key==0) {
            $active_tab_content  = 'show active';
          }
      ?>
          <div class="tab-pane fade <?php echo $active_tab_content ?>" id="bordered-justified-<?php echo $tab['prefix'] ?>" role="tabpanel" aria-labelledby="<?php echo $tab['prefix'] ?>-tab">
            <table class="table text-center mt-4">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Candidate ID</th>
                  <th scope="col">Candidate Name <br>(Investigator)</th>
                  <th scope="col">App Form</th>
                  <th scope="col">Due Date</th>
                  <th scope="col">Review</th>
                  <!-- <th scope="col">Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                  $key=0;
                  $reviews = getReviewersTaskAssigned($tab['app_table'])['data'];
                  $db = getReviewersTaskAssigned($tab['app_table'])['db'];

                  foreach ($reviews as $review) :
                    $key++;  
                    $sr_no = $currentPage-1;
                    $sr_no = $sr_no .''. $key;
                    if ($key==10 ) {
                      $sr_no = (int)$key * $currentPage;
                    } else {
                      $sr_no = (int)$sr_no;
                    }
                ?>
                <!-- uploads/6688e8a9c4454-MAJ2024081-Mayur Naik.pdf -->
                    <tr>
                      <th scope="row"><?php echo $sr_no ?></th>
                      <td><?php echo $review['application_no'] ?></td>
                      <td class="text-start"><?php echo $review['invst_name'] ?></td>
                      <td>
                        <?php 
                          $file_to_download = "../".$review['file_application_form'];
                          if ($review['file_application_form'] && file_exists($file_to_download)) {
                            echo '<a href="'.$file_to_download.'" download> <i class="ri-download-2-fill"> Download </i></a>';
                          } else {
                            echo '<a href="#" title="Error: File not found on server. The file might have been moved or deleted."> <i class="ri-file-excel-line"> File not found </i></a>';
                          }
                        ?>
                      </td>
                      <td><?php echo date('d-m-Y',strtotime($review['due_date'])) ?></td>
                      <td>
                        <?php if ($review['feedbackGiven']==1) { ?> 
                            <span class="badge border-success border-1 text-success">Reviewed 
                              <br>
                              <a class="mt-2" href="view_feedback.php?aid=<?php echo $review['application_no'].'&r='.$review['rev_id'] ?>" type="button" class="btn btn-primary btn-sm">View Review</a>
                            </span>
                          <?php } else { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#review-form-<?php echo $review['application_no'] ?>" >
                              Review
                            </button>
                            <div class="modal fade" id="review-form-<?php echo $review['application_no'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Reviewer Declaration</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="<?php echo $file_name ?>" method="POST">
                                    <input type="text" name="app_scheme_table" value="<?php echo $tab['app_table'] ?>" hidden>
                                    <input type="text" name="rev_id" value="<?php echo $review['rev_id'] ?>" hidden>
                                    <input type="text" name="application_no" value="<?php echo $review["application_no"] ?>" hidden>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-12" style="text-align: justify;">
                                          <p>
                                            Before reviewing, kindly confirm that you have no conflict of interest in the matter. 
                                            This declaration is crucial to maintaining the integrity of the review process. 
                                            <br>
                                            Thank you for your honesty and cooperation in upholding our standards.
                                          </p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                      <button type="submit" name="application-task-decline" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i> Decline</button>
                                      <a href="review_application.php?id=<?php echo $review['ra_id'] ?>&scheme=<?php echo $tab['app_table'] ?>" class="btn btn-primary" style="padding: 1px 10px;" name="reviewer-declaration-form"><i class="bi bi-check-circle"></i> Proceed</a>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </td>
                        <?php }  ?> 
                      <!-- <td>
                        <?php 
                          if ($review['feedbackGiven']==1) { 
                            $disabled = '';
                          } else { 
                            $disabled = 'disabled';
                          }  
                        ?> 
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update-application-status-<?php echo $review['application_no'] ?>" <?php echo $disabled ?> >
                          ACCEPT / REJECT
                        </button>
                        <div class="modal fade" id="update-application-status-<?php echo $review['application_no'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Update Application Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="<?php echo $file_name ?>" method="POST">
                                <input type="text" name="app_scheme_table" value="<?php echo $tab['app_table'] ?>" hidden>
                                <input type="text" name="rev_id" value="<?php echo $review['rev_id'] ?>" hidden>

                                <div class="modal-body">
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-form-label">Application No </label>
                                    <div class="col-sm-8">
                                      <input class="form-control" type="text" name="application_no" value="<?php echo $review["application_no"] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label class="col-sm-4 col-form-label">Select Status</label>
                                    <div class="col-sm-8">
                                      <select class="form-select" name="feedback_status" aria-label="Default select example" required>
                                        <option value="">Select Application Status</option>
                                        <option value="3">Accepted</option>
                                        <option value="2">Rejected</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <label for="inputNumber" class="col-sm-4 col-form-label">Remarks</label>
                                    <div class="col-sm-8">
                                      <textarea class="form-control" name="app_status_remarks" cols="30" rows="5" placeholder="Remarks (if Any)"></textarea>
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
                      </td> -->
                    </tr>
                <?php
                  endforeach;
                ?>
              </tbody>
            </table>

            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php echo paginationLinks($currentPage, $db->totalPages, "") ?>
              </ul>
            </nav>
          </div>
      <?php 
        }
      ?>

    </div>
    <!-- End Bordered Tabs Justified -->

  </div>
</div>

<?php include_once('includes/footer.php'); ?>