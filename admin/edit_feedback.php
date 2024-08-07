<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$admin_type = '';
if (isset($_SESSION['admin_type'])) {
	$admin_type = $_SESSION['admin_type'];
}

$aid = $_GET['aid'];
$rev_id = isset($_GET['r']) ? $_GET['r'] : "";
$go_to_file_path = '';
include('../admin_assets/api/viewFeedbackApiData.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_to_store = filter_input_array(INPUT_POST);
    // CDFA($data_to_store);

    //save review feedback
    $db = getDbInstance();
    $reviewers_feedback_input = array(
        "reviewer_id" => $rev_id,
        "application_id" => $aid,
        "recommendation" => $data_to_store['recommendation'],
        "comment_on_recommendation" => $data_to_store['comment_on_recommendation'],
        "overall_rating" => number_format($data_to_store['score'], 2),
        "is_updated_by" => 1,
        "updated_by" => $admin_type.'-'.$_SESSION['user_logged_in'],
    );  
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
            $result = $db->insert('reviewers_feedback_collected_data', $data);
        }
    }
    if ($result) {
        header("Refresh:0;"); // reload in 3 seconds
        $_SESSION['success'] = "Record has been Updated Successfully!";
    } else {
        $_SESSION['failure'] = "Failed to Update Record!";
    }
}

include_once('includes/header.php');
?>

<?php if ($renderHeaders) : ?>
    <div class="pagetitle">
        <h1 class="d-flex justify-content-between">
            View Review Form
            <a class="btn btn-primary" href="../admin_assets/api/exportFeedbackApi.php?aid=<?php echo $_GET['aid'] ?>&r=<?php echo $_GET['r'] ?>" title="Download" ><!-- download -->
                <i class="ri-download-2-fill"> Download Review</i>
            </a>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $nav_url ?>"><?php echo $nav_title ?> Applications</a></li>
                <li class="breadcrumb-item active">Review Form</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
<?php endif; ?>

<?php
include('./includes/flash_messages.php');
?>

<?php
if ($review != null) : ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header px-4" style="background-color: #E7ECEF;">
                <h5 class="card-title">
                    <span class="text-dark">Application No : </span><?php echo $aid  ?>
                    <p></p>
                    <?php if (in_array($application_type_key, $app_key_arr_for_slider_form)) {  ?>
                        <span class="text-dark">Name of the Principal Investigator : </span><?php echo $user_data['invst_name'] ?>
                        <?php 
                            if ($user_data['proposal_title'] ) { ?>
                                <p></p>
                                <span class="text-dark">Title of the proposed work : </span><?php echo $user_data['proposal_title'] ?>
                        <?php }
                            if ($user_data['broad_discipline'] ) { ?>
                                <p></p>
                                <span class="text-dark">Subject area of the project : </span><?php echo $user_data['broad_discipline'] ?>
                        <?php }  ?>
                    <?php } else { ?>
                        <span class="text-dark">Name of the Candidate : </span><?php echo $user_data['first_name'] . ' ' . $user_data['middle_name'] . ' ' . $user_data['last_name'] ?>
                    <?php } ?>
                </h5>
            </div>

            <div class="card-body">
                <form action="" method="POST" onsubmit="return validateForm()">
                    <input type="text" name="id" value="<?php echo $rev_id ?>" hidden>
                    <input type="text" id="scheme_type" value="<?php echo $application_type_key; ?>" hidden>
                    <?php 
                        $sr_no = 0;
                        foreach ($collectedData as $key => $question) :
                            $sr_no = $key + 1;
                            $questionMergedId = $question['id'];
        
                            if (in_array($application_type_key, $app_key_arr_for_slider_form)) {
                                $overallRatingAsterisk = "";
                                $isOverallRatingMendatery = "readonly";
                                ?>
                                <input type="hidden" name="<?php echo "question-" . $questionMergedId ?>" value="NULL">
                            
                                <h5 class="card-title mt-5 mb-0 star"><?php echo $sr_no . ". " . $question['title'] ?> </h5>
                                <!-- <label class="card-title p-0 mt-2 mb-3 star" >Rating : <?php echo $question['rating'] ?>  / 10 </label>  -->
                                <label class="card-title p-0 mt-2 mb-3 star" for="ratings-selection-<?php echo $sr_no ?>">Rating</label> <label class="card-title pt-0 mt-2"><span>Please slide for rating</span></label>
                                <div class="range-wrap col-lg-12 col-xl-6">
                                    <div class="row range_label count">
                                        <div class="col">0</div>
                                        <div class="col text-center">5</div>
                                        <div class="col text-end">10</div>
                                    </div>
                                    <div class="range-value" id="ratings-selection-value-<?php echo $sr_no ?>"></div>
                                    <input type="range" class="form-range" name="<?php echo "ratings-selection-" . $questionMergedId ?>" id="ratings-selection-<?php echo $sr_no ?>" min="0" max="10.0" step="0.1" value="<?php echo $question['rating']; ?>" onchange="ratingsOnQuestions(this)" />
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
                                    <h5 class="card-title mb-0"><?php echo (intval($key) + 1) . ". " . $question['title'] ?> </h5>
                                    <!-- <p> >> <?php echo $question['comments'] ?></p> -->
                                    <p class="m-0">Minimum <?php echo $question['minWords'] ?> words and maximum <?php echo $question['maxWords'] ?> words</p>
                                    <textarea class="form-control" style="height: 100px" name="<?php echo "question-" . $questionMergedId ?>" id="<?php echo "question-" . $questionMergedId ?>" oninput="validateInputField(this, <?php echo $question['minWords'], ', ', $question['maxWords'] ?> )" <?php echo $question['isMandatory'] == 1 ? "required" : "" ?>><?php echo $question['comments'] ?></textarea>
                                    <div id="<?php echo "question-".$questionMergedId ?>_error_msg" class="error-msg"></div>
                    
                                    <label class="card-title p-0 my-3 star" for="ratings-selection-<?php echo $questionMergedId ?>" class="mt-4">Rating</label>
                                    <div class="col-12 form-group mb-5" id="ratings-selection-<?php echo $questionMergedId ?>">
                                        <div class="d-flex mx-1">
                                            <?php foreach ($ratings as $key => $rating) :
                                                    $radioId = $questionMergedId . "-" . str_replace(' ', '', $rating);
                                                        if ($question['rating'] == $rating){
                                                            $checked = "checked";
                                                        } else {
                                                            $checked = "";
                                                        }
                                                ?>
                                                    <div class="form-check pe-5">
                                                        <input class="form-check-input" type="radio" value="<?php echo $rating ?>" name="ratings-selection-<?php echo $questionMergedId ?>" id="<?php echo $radioId ?>" <?php echo $checked ?> required>
                                                        <label class="form-check-label" for="<?php echo $radioId ?>">
                                                            <i class="bi bi-emoji-smile-fill" style="color: #ffc83d;"></i> <?php echo $rating ?>
                                                        </label>
                                                    </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php
                                        // foreach ($ratings as $key => $rating) :
                                        //     $radioId = $questionMergedId . "-" . str_replace(' ', '', $rating);

                                        //     if ($question['rating'] == $rating) : ?>
                                        <!-- //         <span class="card-title p-0 my-0" for="ratings-selection-<?php echo $questionMergedId ?>" class="mt-4">Rating : </span>
                                        //         <div class="form-check pe-5">
                                        //             <label class="form-check-label" for="<?php echo $radioId ?>">
                                        //                 <i class="bi bi-emoji-smile-fill" style="color: #ffc83d;"></i> <?php echo $rating ?>
                                        //             </label>
                                        //         </div> -->
                                                <?php
                                        //     endif;
                                        // endforeach;
                                        ?>
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
                            <h5 class="card-title star"><?php echo $sr_no++ .". " ?> Recommendations for funding : </h5>
                            <!-- <label class="card-title p-0 mt-0 mb-3"> 
                                <?php echo "  >> ";
                                    if ($review['recommendation'] == 1 ) {
                                        echo 'Recommended';
                                    } else {
                                        echo 'Not recommended';
                                    }
                                ?>
                            </label> --> 
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recommendation" id="recommendations_1" value="1" <?php echo $review['recommendation'] == 1 ? 'checked' : ''; ?> readonly>
                                        <label class="form-check-label" for="recommendations_1">Recommended</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="recommendation" id="recommendations_2" value="2" <?php echo $review['recommendation'] == 2 ? 'checked' : ''; ?> readonly>
                                        <label class="form-check-label" for="recommendations_2">Not recommended</label>
                                    </div>
                                </div>
                            </div>

                            <h5 class="card-title mb-0 d-none star" id="if_recommendation_yes"><?php echo $sr_no .". " ?> If recommended, comment on the budget : </h5>
                            <h5 class="card-title mb-0 d-none star" id="if_recommendation_no"><?php echo $sr_no++ .". " ?> If not recommended, reasons for not recommending : </h5>
                            <p class="m-0 if_recommendation">Minimum <?php echo $minWords ?> words and maximum <?php echo $maxWords ?> words</p>
                            <p class="m-0 d-none" id="if_recommendation_yes_msg">Please comment on each item of the budget for its appropriatness. You may also suggest for any or each of the items.</p>
                            <p class="m-0 d-none" id="if_recommendation_no_msg">Please provide reason for not recommending.</p>
                            <!--<p> >> <?php echo $review['comment_on_recommendation'] ?></p> -->
                            <textarea class="form-control mb-4 if_recommendation d-none" style="height: 100px" name="comment_on_recommendation" required ><?php echo $review['comment_on_recommendation']?> </textarea>
                            <hr>
                        <?php 
                        } else {
                        ?>
                            <input type="hidden" name="comment_on_recommendation" value="NULL">
                            <input type="hidden" name="recommendation" value="NULL">
                        <?php
                        }
                    ?>
                    
                    <h5 class="card-title <?php echo $overallRatingAsterisk ?>"><?php echo $sr_no++ .". " ?> Overall Score</h5>
                    <div class="row mb-2">
                        <div class="col-sm-2 text-center">
                            <input type="text" name="score" id="decimalInput" class="form-control" placeholder="0.0" step="0.1" value="<?php echo $review['overall_rating'] ?>" <?php echo $isOverallRatingMendatery ?> >
                        <!-- 
                            <button type="button" class="btn btn-primary mb-2">
                                    Score &nbsp;&nbsp; 
                                    <span class="badge bg-white text-primary" style="font-size: larger;" id="decimalInput"><?php echo $review['overall_rating'] ?></span>
                            </button> -->
                        </div>
                        <!-- 
                            <div class="col-sm-10">
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
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mt-4">Update Form Data</button>
                        </div>
                    </div>
                </form>
                <?php if (in_array($application_type_key, $app_key_arr_for_slider_form)) { ?>
                    <script>const questionsCount = "<?php echo COUNT($collectedData); ?>";</script>
                    <script src="../admin_assets/js/range_slider.js?<?php echo time(); ?>"></script>
                    <script>
                        $(function() {
                            let isRecommendation = "<?php echo $review['recommendation'] ?>" ?? "";
                            if (isRecommendation) {
                                showCommentBox(isRecommendation);
                            }
                        });
                    </script>
                <?php } ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include_once('includes/footer.php'); ?>
<script src="../admin_assets/js/validate_feedback.js?<?php echo time() ?>"></script>