<?php
// include('../admin_assets/api/viewFeedbackApiData.php');

include ($go_to_file_path . '../admin_assets/includes/custom_functions.php');

// $aid = $_GET['aid'];
// $rev_id = isset($_GET['r']) ? $_GET['r'] : "";

$application_type_key = extractText($aid);
$nav_url = "scheme_listing.php?sl=";
switch ($application_type_key) {
    case 'PhD':
        $app_table = "scheme_doctoral_fellowship";
        $nav_url .= "GURODFUYRT";
        $nav_url = 'scheme_doctoral_fellowship.php';
        $nav_title = "Doctoral Fellowship";
        break;
    case 'PDF':
        $app_table = "scheme_post_doctoral_fellowship";
        $nav_url .= "GUROPDFUYRT";
        $nav_url = 'scheme_post_doctoral_fellowship.php';
        $nav_title = "Post Doctoral Fellowship";
        break;
    case 'MAJ':
        $app_table = "scheme_major_project_grant";
        $nav_url .= "GUROMAJUYRT";
        $nav_url = 'scheme_major_project_grant.php';
        $nav_title = "Major Project Grants";
        break;
    case 'MIN':
        $app_table = "scheme_minor_project_grant";
        $nav_url .= "GUROMINUYRT";
        $nav_url = 'scheme_minor_project_grant.php';
        $nav_title = "Minor Project Grants";
        break;
    case 'SU':
        $app_table = "scheme_research_startup_grant";
        $nav_url .= "GURORSGUYRT";
        $nav_url = 'scheme_research_startup_grant.php';
        $nav_title = "Research Startup Grants";
        break;
    case 'SS':
        $app_table = "scheme_summer_school";
        $nav_url .= "GUROSSUYRT";
        $nav_url = 'scheme_summer_school.php';
        $nav_title = "Summer School ";
        break;
    case 'IRIS':
        $app_table = "scheme_iris";
        $nav_url .= "GUROSSUYRT";
        $nav_url = 'scheme_iris_ld.php';
        $nav_title = "IRIS Scheme";
        break;
}

// CDFS($app_key_arr_for_slider_form);

// summer school scheme no review application required
$is_scheme_maj = $is_scheme_min = false;
if ($app_table == 'scheme_major_project_grant' || $app_table == 'scheme_minor_project_grant') {
    $is_scheme_maj = true;
    $is_scheme_min = true;
}

$db = getDbInstance();
$db->where("s.application_no", $aid)
    ->join('users u', 's.user_id = u.id', 'LEFT');
if ($is_scheme_maj) {
    $db->join('scheme_fellowship_investigator_details invst', 's.id = invst.scheme_major_project_grant_id AND invst.type = "principal_investigator"', 'LEFT');
} else if ($is_scheme_min) {
    $db->join('scheme_fellowship_investigator_details invst', 's.id = invst.scheme_minor_project_grant_id AND invst.type = "principal_investigator"', 'LEFT');
}
if ($is_scheme_maj || $is_scheme_min) {
    $user_data = $db->getOne($app_table . " s", 's.id, s.user_id, s.scheme_batch_id, s.proposal_title, s.broad_discipline, 
                CONCAT(IFNULL(invst.first_name, u.first_name), " ", IFNULL(invst.middle_name, u.middle_name), " ", IFNULL(invst.last_name, u.last_name)) AS invst_name 
            ');
} else {
    $user_data = $db->getOne($app_table . " s", 's.id, s.user_id, s.scheme_batch_id,
                CONCAT(IFNULL(s.first_name, u.first_name), " ", IFNULL(s.middle_name, u.middle_name), " ", IFNULL(s.last_name, u.last_name)) AS invst_name 
            ');
}


//Get DB instance. function is defined in config.php
$db = getDbInstance();
$users = $db->get("users");

$reviewersFeedbackCount = []; //get total feedback questions
$revNo = '';

if ($aid) {
    // view single review application
    if (!empty($rev_id)) {
        $db = getDbInstance();
        $reviewersCount = $db
            ->where('application_no', $aid)
            ->where('status', 1)
            ->get('reviewers_assigned');
        foreach ($reviewersCount as $keyCount => $value) {
            if ($value['reviewer_id'] == $rev_id) {
                $revNo = $keyCount + 1;
            }
        }

        $db = getDbInstance();
        $review = $db
            ->where('application_id', $aid)
            ->where('reviewer_id', $rev_id)
            ->orderBy('id', 'DESC')
            ->getOne("reviewers_feedback");

        $reviewerFbId = $review['id'];

        $db = getDbInstance();
        $collectedData = $db->where("reviewers_feedback_id", $reviewerFbId)
            ->join('feedback_questions fq', 'fq.id = cd.feedback_question_id', 'LEFT')
            ->get('reviewers_feedback_collected_data cd');

        $review['feedback'] = $collectedData;
        $reviewersFeedback = null;  // $review;
    } else {
        // view all the review applications
        $db = getDbInstance();
        // $review = $db
        //     ->where('application_id', $aid)
        //     ->getOne("reviewers_feedback");
        // $reviewerFbId = $review['id'];

        // $db = getDbInstance();
        // $collectedData = $db->where("reviewers_feedback_id", $reviewerFbId)
        //     ->join('feedback_questions fq', 'fq.id = cd.feedback_question_id', 'LEFT')
        //     ->get('reviewers_feedback_collected_data cd');

        $reviewersFeedback = $db
            ->where('application_id', $aid)
            ->where('ra.status', 1)
            ->orderBy('revF.id', 'DESC')
            ->join("reviewers rev", "rev.id = revF.reviewer_id", 'LEFT')
            ->join("reviewers_assigned ra", "revF.reviewer_id = ra.reviewer_id AND revF.application_id = ra.application_no", 'LEFT')
            ->get("reviewers_feedback revF", null, 'revF.*, rev.name');

        for ($i = 0; $i < count($reviewersFeedback); $i++) {
            $db = getDbInstance();
            $collectedData = $db->where("reviewers_feedback_id", $reviewersFeedback[$i]['id'])
                ->join('feedback_questions fq', 'fq.id = cd.feedback_question_id', 'LEFT')
                ->get('reviewers_feedback_collected_data cd');
            $reviewersFeedback[$i]['feedback'] = $collectedData;
        }
    }
    // CDFA($reviewersFeedback);

    //get total feedback questions
    if ($reviewersFeedback) {
        // for showing range slider in all reviews page
        $reviewersFeedbackCount = $reviewersFeedback[0]['feedback'];
        if (isset($reviewersFeedback[1]) && $reviewersFeedback[1]['feedback']) {
            foreach ($reviewersFeedback[1]['feedback'] as $key44 => $value) {
                array_push($reviewersFeedbackCount, $value);
            }
        }
        // CDFA($reviewersFeedbackCount);
    }


} else {
    $review = null;
    $reviewersFeedback = null;
}



?>