<?php
// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';

// $aid = $_GET['aid'];
// $rev_id = isset($_GET['r']) ? $_GET['r'] : "";
// $go_to_file_path = '';
// include('../admin_assets/api/viewFeedbackApiData.php');

include_once('includes/header.php');

$selectedYear = $_GET['yearlydata'] ?? "";
$query = $_GET['search'] ?? "";
$schemeBatchId = $_GET['schemeBatch'] ?? "";
$selected_scheme_type = $_GET['scheme_type'] ?? "";
$currentPage = $_GET["page"] ?? 1;
?>
<style>
input {
    pointer-events: none;
}
</style>
<!-- /.row -->

<?php if ($renderHeaders) : ?>
    <div class="pagetitle">
        <h1 class="d-flex justify-content-between">
            View Review Form
            <a class="btn btn-primary" href="../admin_assets/api/exportFeedbackApi.php?aid=<?php echo $_GET['aid'] ?>" title="Download" download>
                <i class="ri-download-2-fill"> Download Review</i>
            </a>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="applications_list.php?<?php echo 'yearlydata='.$selectedYear.'&schemeBatch='.$schemeBatchId.'&search='.$query.'&scheme_type='.$selected_scheme_type.'&page='.$currentPage ?>">Applications List</a></li>
                <li class="breadcrumb-item active">Review Form</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
<?php endif ?>


<?php 
if ($reviewersFeedback != null) : 
    $ratingsIdIndex = 0;
    foreach ($reviewersFeedback as $key2 => $fb) : 
        if (count($fb['feedback']) > 0) : 
            ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header px-4" style="background-color: #E7ECEF;">
                        <h5 class="card-title">
                            <span class="text-dark">Application No : </span><?php echo $aid  ?>
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
                            <p></p>
                            <!-- <span class="text-dark">Reviewed By : </span><?php echo $fb['name']  ?> -->
                        </h5>
                    </div>

                    <div class="card-body">
                        <?php 
                            $collectedData = $fb['feedback'];
                            $sr_no = 0;
                            foreach ($collectedData as $key => $question) :
                                $sr_no = $key + 1;
                                $ratingsIdIndex = $ratingsIdIndex + 1;

                                $questionMergedId = $question['id'];

                                if (in_array($application_type_key, $app_key_arr_for_slider_form)) {
                                ?>
                                    <h5 class="card-title mt-4 mb-0 star"><?php echo (intval($key) + 1) . ". " . $question['title'] ?> </h5>
                                    <!-- <label class="card-title p-0 mt-2 mb-3" >Rating : <?php echo $question['rating'] ?>  / 10 </label>  -->
                                    <label class="d-block card-title p-0 mt-0 mb-0" for="ratings-selection-<?php echo $ratingsIdIndex ?>">Rating</label> 
                                    <label class="d-block card-title pt-0 mt-0"><span>Please slide for rating</span></label>
                                    <div class="range-wrap col-lg-12 col-xl-6">
                                        <div class="row range_label count">
                                            <div class="col">0</div>
                                            <div class="col text-center">5</div>
                                            <div class="col text-end">10</div>
                                        </div>
                                        <div class="range-value" id="ratings-selection-value-<?php echo $ratingsIdIndex ?>"></div>
                                        <input type="range" class="form-range" name="<?php echo "ratings-selection-" . $questionMergedId ?>" id="ratings-selection-<?php echo $ratingsIdIndex ?>" min="0" max="10.0" step="0.1" value="<?php echo $question['rating']; ?>" onchange="ratingsOnQuestions(this)" />
                                        <div class="row range_label mb-4">
                                            <div class="col">Poor</div>
                                            <div class="col text-center">Average</div>
                                            <div class="col text-end">Excellent</div>
                                        </div>
                                    </div>
                                    <hr>
                                <?php 
                                } else {
                                ?>
                                    <h5 class="card-title mb-0"><?php echo (intval($key) + 1) . ". " . $question['title'] ?> </h5>
                                    <p> >> <?php echo $question['comments'] ?></p>
                                    <?php   $ratings = ["Excellent", "Very Good", "Good", "Satisfactory", "Not satisfactory "]; ?>
                                    <div class="form-group d-flex my-4" id="ratings-selection-<?php echo $questionMergedId ?>">
                                        <?php
                                        foreach ($ratings as $key3 => $rating) :
                                            $radioId = $questionMergedId . "-" . str_replace(' ', '', $rating);

                                            if ($question['rating'] == $rating) : ?>
                                                <span class="card-title p-0 my-0" for="ratings-selection-<?php echo $questionMergedId ?>" class="mt-4">Rating : </span>
                                                <div class="form-check pe-5">
                                                    <label class="form-check-label" for="<?php echo $radioId ?>">
                                                        <i class="bi bi-emoji-smile-fill" style="color: #ffc83d;"></i> <?php echo $rating ?>
                                                    </label>
                                                </div>
                                                <?php
                                            endif;
                                        endforeach;
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
                                <label class="card-title p-0 mt-0 mb-3"> <?php
                                    echo ">> ";
                                    if ($fb['recommendation'] == 1 ) {
                                        echo 'Recommended';
                                    } else {
                                        echo 'Not recommended';
                                    }
                                    ?>
                                </label>

                                <h5 class="card-title mb-0 star">
                                    <?php echo $sr_no++ .". "; 
                                        if ($fb['recommendation'] == 1 ) {
                                            echo 'If recommended, comment on the budget :';
                                        } else {
                                            echo 'If not recommended, reasons for not recommending : ';
                                        }
                                    ?>
                                </h5>
                                <label class="d-block card-title p-0 m-0"><span>
                                    <?php
                                        if ($fb['recommendation'] == 1 ) {
                                            echo 'Please comment on each item of the budget for its appropriatness. You may also suggest for any or each of the items.';
                                        } else {
                                            echo 'Please provide reason for not recommending.';
                                        }
                                    ?>
                                </span></label>
                                <label class="card-title p-0 m-0 if_recommendation"><span>Minimum <?php echo $minWords ?> words and maximum <?php echo $maxWords ?> words</span></label>
                                <p> <label class="card-title p-0 mt-0 mb-3"> >> </label> <?php echo $fb['comment_on_recommendation'] ?></p>
                                <hr>
                            <?php 
                            }
                        ?>

                        <h5 class="card-title"><?php echo $sr_no++ .". "; ?>Overall Score</h5>
                        <button type="button" class="btn btn-primary mb-2">
                            Score &nbsp;&nbsp; <span class="badge bg-white text-primary" style="font-size: larger;"><?php echo $fb['overall_rating'] ?></span>
                        </button>
                        <!-- <div class="row mb-2">
                            <div class="col-sm-2 text-center">
                            </div>
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
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        <?php 
        endif; 
    endforeach; 
endif;
?>

<script>const questionsCount = "<?php echo COUNT($reviewersFeedbackCount); ?>";</script>
<script src="../admin_assets/js/range_slider.js?<?php echo time() ?>"></script>
<script>
    // $(function() {
    //     let isRecommendation = "<?php echo $fb['recommendation'] ?>" ?? "";
    //     if (isRecommendation) {
    //         showCommentBox(isRecommendation);
    //     }
    // });
</script>

<?php include_once('includes/footer.php'); ?>