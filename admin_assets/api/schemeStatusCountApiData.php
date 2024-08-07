<?php
// used for index(dashboard) of admin & scheme-admin
// include('../admin_assets/api/schemeStatusCountApiData.php');

include('../admin_assets/includes/custom_functions.php');

$today = new DateTime(); // Get the current date and time
$year = $today->format('Y'); // Get the current year
$selectedYear = isset($_GET['yearlydata']) ? $_GET['yearlydata'] : $year;

//Get DB instance. function is defined in config.php
$db = getDbInstance();
    
// -----------  admin start --------------------------------------------------------------------------------------------------------------
$schemes = $db->get("scheme_types");
// -----------  admin end ----------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------------------
// ----------- scheme & reviewer admin start --------------------------------------------------------------------------------------------------------------
//Get Dashboard information
$cuid = CUID();
// ----------- scheme & reviewer end --------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------------------
// ----------- scheme admin start --------------------------------------------------------------------------------------------------------------
$db->where('id',$cuid );
$currentUser = $db->getOne("scheme_admin_accounts");    

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

// ----------- scheme end --------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------------------
// ----------- reviewer admin start --------------------------------------------------------------------------------------------------------------
$pendingCount = 0;
$reviewedCount = 0;
$completeCount = 0;
$rejectedCount = 0;
$acceptedCount = 0;

$db = getDbInstance();
$db->where('reviewer_id', $cuid);
$db->where('status', 1);
$reviews = $db->get("reviewers_assigned");
foreach ($reviews as $key => $review) {
    if($review['feedbackGiven']=="" || $review['feedbackGiven']==0){
        $pendingCount++;
    } else if($review['feedbackGiven']==1) {
        $reviewedCount++;
    } else {
        $completeCount++;
        if($review['feedbackGiven']==2) {
            $rejectedCount = 0;
        } else if($review['feedbackGiven']==3) {
            $acceptedCount = 0;
        }
    }
}

// ----------- reviewer admin end--------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------------------

// Get application status count 
function getApplicationCount($application_type_key) {
    $app_table = getTableNameBasedOnSchemeApplicationCode($application_type_key);

    // get scheme row count for status = 1 
    // ex. status counts {status 1 = 3, status 2 = 5} 
    // $db = getDbInstance();
    // $db->groupBy('status');
    // $data = $db->get($app_table, null, 'status, COUNT(*) as status_count', function ($db) {
    //         $db->groupBy('status');
    //         $db->where('status', [1, 2, 3], 'IN');
    //     });

    // get application no's
    $db = getDbInstance();
    $db->where('status', 1);
    $db->where('form_status', 1);
    if ($GLOBALS['selectedYear']) {
        $db->where('YEAR(created_at)', $GLOBALS['selectedYear']);
    }
    $data = $db->get($app_table, null, 'id, application_no');

    // ex. app counts 
    $app_status_data = [
        "total" => count($data),
        "unassigned" => 0,
        "0" => 0, //"unassigned
        "1" => 0, //"reviewed
        "2" => 0, //"rejected
        "3" => 0, //"accepted
    ];

    foreach ($data as $key => $value) {
        $db = getDbInstance();
        $ra_data = $db
            ->where('application_no', $value['application_no'])
            ->get('reviewers_assigned', null, 'id, reviewer_id, application_no, feedbackGiven');

        if ($ra_data) {
            // Increment the count in $app_status_data based on feedbackGiven value
            foreach ($ra_data as $key1 => $value) {
                $feedbackGiven = $value['feedbackGiven'];
                $temp_fg = '';
                if (array_key_exists($feedbackGiven, $app_status_data)) {
                    $app_status_data[$feedbackGiven]++;
                }
            }
        } else {
            $app_status_data['unassigned']++;
        }
    }
    
    return $app_status_data;
}

if ($isStatusCount == true) {
    // get status count response
    $status_for_phd_applications = getApplicationCount("PhD");
    $status_for_pdf_applications = getApplicationCount("PDF");
    $status_for_min_applications = getApplicationCount("MIN");
    $status_for_sug_applications = getApplicationCount("SU");
    $status_for_maj_applications = getApplicationCount("MAJ");
    $status_for_ss_applications = getApplicationCount("SS");
}

function printDataIfArrayExist($data, $status) {
    // if (count($data)>0) {
    //     foreach ($data as $key => $value) {
    //         if ($value['status'] == $status) {
    //             return $value['status_count'];
    //         }
    //     }
    //     return '0';
    // } else {
    //     return '0';
    // }

    if (is_array($status)) {
        // $status is an array
        $count_status = 0;
        foreach ($status as $key => $value) {
            if (array_key_exists($value, $data)) {
                $count_status += $data[$value];
            }
        }
        return $count_status;
    } else {
        // $status is not an array
        $total = '';
        if ($status == 'unassigned') {
            $total = '/'.$data['total'];
        }

        if (array_key_exists($status, $data)) {
            return $data[$status] . $total;
        }
    }
    return '0';
}

    // CDFA($status_for_phd_applications);
    // CDFA($status_for_sug_applications);
    // CDFA($status_for_min_applications);