<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../admin_assets/includes/custom_functions.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();

//Get Dashboard information
$cuid = CUID();
$id = $_GET['id'];            // ra_id
$table_name = $_GET['scheme'];

// summer school scheme no review application required
$is_scheme_maj = $is_scheme_min = false;
if ($table_name=='scheme_major_project_grant' || $table_name=='scheme_minor_project_grant') {
  $is_scheme_maj = true;
  $is_scheme_min = true;
}

//Create a rating record and get the ID
$query = $_GET['search'] ?? "";

$db->where("ra.reviewer_id", CUID())
  ->where("ra.id", $id)
  // ->where("s.status", "1")
  // ->where("s.form_status", "1")
  ->join($table_name.' s', 'ra.application_no = s.application_no', 'LEFT')
  ->join('users u', 's.user_id = u.id', 'LEFT');
if ($is_scheme_maj) {
  $db->join('scheme_fellowship_investigator_details invst', 's.id = invst.scheme_major_project_grant_id AND invst.type = "principal_investigator"', 'LEFT');
} else if ($is_scheme_min) {
  $db->join('scheme_fellowship_investigator_details invst', 's.id = invst.scheme_minor_project_grant_id AND invst.type = "principal_investigator"', 'LEFT');
}
if ($is_scheme_maj || $is_scheme_min) {
  $user_data = $db->getOne("reviewers_assigned ra", 'ra.application_no, 
                s.scheme_batch_id, s.proposal_title, s.broad_discipline, 
                CONCAT(IFNULL(invst.first_name, u.first_name), " ", IFNULL(invst.middle_name, u.middle_name), " ", IFNULL(invst.last_name, u.last_name)) AS invst_name 
              ');
} else {
  $user_data = $db->getOne("reviewers_assigned ra", 'ra.application_no, s.scheme_batch_id,
                CONCAT(IFNULL(s.first_name, u.first_name), " ", IFNULL(s.middle_name, u.middle_name), " ", IFNULL(s.last_name, u.last_name)) AS invst_name 
              ');
}


$scheme_batch_id = '';
if ($user_data) {
  $scheme_batch_id = $user_data['scheme_batch_id'];
}

$db = getDbInstance();
$selected_scheme_type = $db->where('scheme_table_name', $table_name)
    ->getOne('scheme_types');

$db = getDbInstance();
$collectedData = $db
    ->where("scheme_type", $selected_scheme_type['id'])
    ->where("FIND_IN_SET(?, scheme_batch_ids)", [$scheme_batch_id])
    ->get("feedback_questions");

$application_type_key = extractText($user_data['application_no']);

// add the key to show slider form for reviewer 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data_to_store = filter_input_array(INPUT_POST);

  $db->where('id', $id);
  $application = $db->getOne('reviewers_assigned', 'application_no');

  $reviewers_feedback_input = array(
    "reviewer_id" => $cuid,
    "application_id" => $application['application_no'],
  );  
  //save review feedback
  $db = getDbInstance();
  $reviewers_feedback_id = $db->insert('reviewers_feedback', $reviewers_feedback_input);
  
  // Iterate through the object properties
  //save review feedback ratings-selection data and ratings
  $data = [];
  foreach ($data_to_store as $key => $value) {
    // Check if the property is a ratings-selection or rating property
    if (strpos($key, 'ratings-selection-') === 0) {
      // Extract the ratings-selection number from the key
      $questionNumber = substr($key, strlen('ratings-selection-'));
      // Create an array with ratings-selection and rating properties
      $data = array(
        'reviewers_feedback_id' => $reviewers_feedback_id,
        'feedback_question_id' =>  $questionNumber,
        'comments' => $data_to_store['question-' . $questionNumber],
        'rating' => $data_to_store['ratings-selection-' . $questionNumber]
      );

      $db = getDbInstance();
      $db->insert('reviewers_feedback_collected_data', $data);
    }
  }

  //update overall rating
  $db = getDbInstance();
  $db->where('id', $reviewers_feedback_id);
  $result = $db->update('reviewers_feedback', array(
    "recommendation" => $data_to_store['recommendation'],
    "comment_on_recommendation" => $data_to_store['comment_on_recommendation'],
    "overall_rating" => number_format($data_to_store['score'], 2)
  ));

  $db = getDbInstance();
  $db->where('id', $id);
  $db->update('reviewers_assigned', array(
    "feedbackGiven" => 1
  ));

  header('Location:application_review_list.php');
  exit();
}

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <h1><?php echo $currentPageName ?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="application_review_list.php">Applications List</a></li>
      <li class="breadcrumb-item active">Review Application</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<div class="col-sm-10">
  <div class="card">
    <div class="card-header px-4" style="background-color: #E7ECEF;">
      <h5 class="card-title">
        <span class="text-dark">Application No  : </span><?php echo $user_data['application_no']  ?>
        <p></p>
        <?php if ($is_scheme_maj || $is_scheme_min) {  ?>
            <span class="text-dark">Name of the Principal Investigator : </span><?php echo $user_data['invst_name'] ?>
            <?php 
            if (isset($user_data['proposal_title']) && $user_data['proposal_title'] ) { ?>
                <p></p>
                <span class="text-dark">Title of the proposed work : </span><?php echo $user_data['proposal_title'] ?>
            <?php }
              if (isset($user_data['broad_discipline']) && $user_data['broad_discipline'] ) { ?>
                <p></p>
                <span class="text-dark">Subject area of the project : </span><?php echo $user_data['broad_discipline'] ?>
            <?php }  ?>
        <?php } else { ?>
          <span class="text-dark">Name of the Candidate : </span><?php echo $user_data['invst_name'] ?>
        <?php } ?>
      </h5>
    </div>
    <div class="card-body">
      <form action="" method="POST" onsubmit="return validateForm()">
        <input type="text" name="id" value="<?php echo $id ?>" hidden>
        <input type="text" id="scheme_type" value="<?php echo $application_type_key; ?>" hidden>
        <?php
          $sr_no = 0;
          foreach ($collectedData as $key => $question) :
            $sr_no = $sr_no + 1;
            $questionMergedId = $question['id'];

            if (in_array($application_type_key, $app_key_arr_for_slider_form)) {

              $overallRatingAsterisk = "";
              $isOverallRatingMendatery = "readonly";
              ?>
              <input type="hidden" name="<?php echo "question-" . $questionMergedId ?>" value="NULL">

              <h5 class="card-title mt-4 mb-0 star"><?php echo $sr_no . ". " . $question['title'] ?> </h5>
              <label class="d-block card-title p-0 mt-0 mb-0" for="ratings-selection-<?php echo $sr_no ?>">Rating</label> 
              <label class="d-block card-title pt-0 mt-0"><span>Please slide for rating</span></label>
              <div class="range-wrap col-lg-12 col-xl-6">
                <div class="row range_label count">
                  <div class="col">0</div>
                  <div class="col text-center">5</div>
                  <div class="col text-end">10</div>
                </div>
                <div class="range-value" id="ratings-selection-value-<?php echo $sr_no ?>"></div>
                <input type="range" class="form-range" name="<?php echo "ratings-selection-" . $questionMergedId ?>" id="ratings-selection-<?php echo $sr_no ?>" min="0" max="10.0" step="0.1" value="0" onchange="ratingsOnQuestions(this)" />
                <div class="row range_label">
                  <div class="col">Poor</div>
                  <div class="col text-center">Average</div>
                  <div class="col text-end">Excellent</div>
                </div>
              </div>
              <hr>
              
              <?php
            } else {
              // Other schemes Except MAJ
              $overallRatingAsterisk = "star";
              $isOverallRatingMendatery = "required";
              $ratings = ["Excellent", "Very Good", "Good", "Satisfactory", "Not satisfactory "];
              ?>
                <h5 class="card-title mt-4 mb-0 star"><?php echo $sr_no . ". " . $question['title'] ?> </h5>
                <label class="d-block card-title p-0 m-0"><span>Minimum <?php echo $question['minWords'] ?> words and maximum <?php echo $question['maxWords'] ?> words</span></label>
                <textarea class="form-control" style="height: 100px" name="<?php echo "question-" . $questionMergedId ?>" id="<?php echo "question-" . $questionMergedId ?>" oninput="validateInputField(this, <?php echo $question['minWords'], ', ', $question['maxWords'] ?> )" <?php echo $question['isMandatory'] == 1 ? "required" : "" ?>></textarea>
                <div id="<?php echo "question-".$questionMergedId ?>_error_msg" class="error-msg"></div>
                
                <label class="card-title p-0 my-3 star" for="ratings-selection-<?php echo $questionMergedId ?>" class="mt-4">Rating</label>
                <div class="col-12 form-group mb-5" id="ratings-selection-<?php echo $questionMergedId ?>">
                  <div class="d-flex mx-1">
                    <?php foreach ($ratings as $key => $rating) :
                            $radioId = $questionMergedId . "-" . str_replace(' ', '', $rating);
                        ?>
                            <div class="form-check pe-5">
                              <input class="form-check-input" type="radio" value="<?php echo $rating ?>" name="ratings-selection-<?php echo $questionMergedId ?>" id="<?php echo $radioId ?>" required>
                              <label class="form-check-label" for="<?php echo $radioId ?>">
                                <i class="bi bi-emoji-smile-fill" style="color: #ffc83d;"></i> <?php echo $rating ?>
                              </label>
                            </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                <hr>
              <?php
            }
          endforeach; 
          
          if (in_array($application_type_key, $app_key_arr_for_slider_form)) {
            $sr_no++;
            $minWords = 15;
            $maxWords = 200;
            ?>
              <h5 class="card-title star"><?php echo $sr_no++.". " ?> Recommendations for funding : </h5>
              <div class="row mb-2">
                <div class="col-sm-12">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="recommendation" id="recommendations_1" value="1" required>
                    <label class="form-check-label" for="recommendations_1">Recommended</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="recommendation" id="recommendations_2" value="2" required>
                    <label class="form-check-label" for="recommendations_2">Not recommended</label>
                  </div>
                </div>
              </div>
              <h5 class="card-title mb-0 d-none star" id="if_recommendation_yes"><?php echo $sr_no .". " ?> If recommended, comment on the budget : </h5>
              <h5 class="card-title mb-0 d-none star" id="if_recommendation_no"><?php echo $sr_no++ .". " ?> If not recommended, reasons for not recommending : </h5>
              <label class="card-title p-0 m-0 d-none" id="if_recommendation_yes_msg"><span>Please comment on each item of the budget for its appropriatness. You may also suggest for any or each of the items.</span></label>
              <label class="card-title p-0 m-0 d-none" id="if_recommendation_no_msg"><span>Please provide reason for not recommending</span></label>
              <label class="col-12 card-title p-0 m-0 if_recommendation d-none"><span>Minimum <?php echo $minWords ?> words and maximum <?php echo $maxWords ?> words</span></label>
              <textarea class="form-control if_recommendation d-none" style="height: 100px" name="comment_on_recommendation" id="comment_on_recommendation" oninput="validateInputField(this, <?php echo $minWords, ', ', $maxWords ?> )" ></textarea>
              <span id="comment_on_recommendation_error_msg" class="error-msg"></span>
              <div class="mb-4"></div>
              <hr>
            <?php 
          } else {
            ?>
              <input type="hidden" name="comment_on_recommendation" value="NULL">
              <input type="hidden" name="recommendation" value="NULL">
            <?php
          }
        ?>
        <h5 class="card-title <?php echo $overallRatingAsterisk ?>"><?php echo $sr_no++ .". " ?>  Overall Score</h5>
        <div class="row mb-2">
          <div class="col-sm-2">
            <input type="text" name="score" id="decimalInput" class="form-control" placeholder="0.0" step="0.1" value="" <?php echo $isOverallRatingMendatery ?> >
          </div>
          <!-- <div class="col-sm-10">
            <div class="d-flex">
              <div class="form-check text-center rounded">
                <strong>Excellent</strong><br>
                9.1-10.0
              </div>
              <div class="form-check text-center rounded">
                <strong>Very Good</strong><br>
                7.1-9.0
              </div>
              <div class="form-check text-center rounded">
                <strong>Good</strong><br>
                5.1-7.0
              </div>
              <div class="form-check text-center rounded">
                <strong>Satisfactory</strong><br>
                4.1-5.0
              </div>
              <div class="form-check text-center rounded">
                <strong>Not Satisfactory</strong><br>
                &lt;4.0
              </div>
            </div>
          </div> -->
        </div>

        <p class="mt-4"><strong>Note:</strong> Reviewer's identity would be kept confidential. </p>
        
        <button type="submit" class="btn btn-primary">Submit Form</button>
      </form>
      <?php if (in_array($application_type_key, $app_key_arr_for_slider_form)) { ?>
        <script>const questionsCount = "<?php echo COUNT($collectedData); ?>";</script>
        <script src="../admin_assets/js/range_slider.js?<?php echo time(); ?>"></script>
      <?php } ?>
    </div>
  </div>
</div>
<?php include_once('includes/footer.php'); ?>
<script src="../admin_assets/js/validate_feedback.js?<?php echo time() ?>"></script>
