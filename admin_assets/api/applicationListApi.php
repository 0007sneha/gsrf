<?php
// include('../admin_assets/api/applicationListApi.php');
// request GET only

require '../config/be_function.php';
include '../config/user_access.php';

$currentPage = $_GET['page'] ?? 1; // Default to page 1
// Number of records to display per page
$recordsPerPage = 10;
// Calculate the offset
$offset = ($currentPage - 1) * $recordsPerPage;

$today = new DateTime(); // Get the current date and time
$year = $today->format('Y'); // Get the current year
$selectedYear = isset($_GET['yearlydata']) ? $_GET['yearlydata'] : $year;
$schemeBatchId = $_GET['schemeBatch'] ?? "";
$query = $_GET['search'] ?? "";
$query = trim($query);

$data = [];  // initial array object


// get scheme_batch
$db = getDbInstance();
$db->where("scheme_types_id", $selected_scheme_type);
if ($selectedYear) {
    $db->where(
        "(YEAR(created_at) =". $selectedYear."
        OR SUBSTRING(batch_no, 1, 4) = ". $selectedYear .")"
    );
}
$scheme_batch_data = $db->get("scheme_batch", null, "id, batch_no");



$condition = '';
if ($selectedYear) {
    $condition .= 'YEAR(s.created_at) = '.$selectedYear.' AND ';
}
if ($schemeBatchId) {
    $condition .= 's.scheme_batch_id='.$schemeBatchId.' AND ';
}
if ($query) {
    $condition .= "(s.application_no LIKE '%$query%' OR 
        usr.first_name LIKE '%$query%' OR 
        usr.last_name LIKE '%$query%' OR 
        CONCAT(usr.first_name, ' ', usr.last_name) LIKE '%$query%' OR 
        CONCAT(usr.first_name, ' ', COALESCE(usr.middle_name, ' '), ' ', usr.last_name) LIKE '%$query%') AND 
        ";
}
$condition .= ' s.status = 1 AND s.form_status = 1 ';

$schemesCount = countRows("SELECT s.id, s.application_no FROM $scheme_table s LEFT JOIN users usr ON s.user_id = usr.id WHERE $condition");
$totalPagesCount = ceil($schemesCount / $recordsPerPage);
$schemes = fetchRows("SELECT s.id, s.application_no, s.user_id, s.file_application_form,
                            CONCAT(usr.first_name, ' ', COALESCE(usr.middle_name, ' '), ' ', usr.last_name) AS usr_full_name, 
                            usr.email, usr.dob, usr.country_code, usr.phone_no 
                        FROM $scheme_table s 
                        LEFT JOIN users usr ON s.user_id = usr.id
                        WHERE $condition 
                        LIMIT $offset, $recordsPerPage
                    "); 
if ($schemes) {
    foreach ($schemes as $key => $scheme) {
        $app_no = $scheme['application_no'];
        $user_id = $scheme['user_id'];
        
        // $scheme['user'] = fetchRows("SELECT id, CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) AS full_name, email, dob, country_code, phone_no
        //                     FROM users
        //                     WHERE id = '$user_id'
        //                 ", false);

        $rev_assigned = fetchRows("SELECT id, application_no, reviewer_id, due_date, feedbackGiven 
                        FROM reviewers_assigned
                        WHERE application_no = '$app_no'
                        AND status = 1
                    ");

        $data_rev_assigned = [];
        if ($rev_assigned) {
            foreach ($rev_assigned as $key2 => $rev_assign) {
                $reviewer_id = $rev_assign['reviewer_id'];
                
                $rev_assign['reviewer'] = fetchRows("SELECT id, name, email, isActive
                                        FROM reviewers
                                        WHERE id = '$reviewer_id'
                                    ", false);
                
                $rev_assign['rev_feedback'] = fetchRows("SELECT *
                                        FROM reviewers_feedback
                                        WHERE reviewer_id = '$reviewer_id'
                                        AND application_id = '$app_no'
                                    ", false);

                $data_rev_assigned[] = $rev_assign;
            }
        }
        $scheme['rev_assigned'] = $data_rev_assigned;
        
        // assign schemes in data object
        $data[] = $scheme;
    }
}

// echo '<pre>'; print_r($data); exit;
// echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=> $data ]); 

?>