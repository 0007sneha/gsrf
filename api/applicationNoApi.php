<?php
function applicationNo($value)
{
    // include '../config/be_function.php';

    $today = new DateTime(); // Get the current date and time
    $year = $today->format('Y'); // Get the current year

    // PhD(year)and(application no. in 3 digits)     
    // eg. PhD 2023 009, 
    $app_no;
    $app_count = 1;
    $table = $value;

    switch ($table) {
        case 'scheme_doctoral_fellowship':
            $app_prefix = "PhD";
            break;
        case 'scheme_post_doctoral_fellowship':
            $app_prefix = "PDF";
            break;
        case 'scheme_major_project_grant':
            $app_prefix = "MAJ";
            break;
        case 'scheme_minor_project_grant':
            $app_prefix = "MIN";
            break;
        case 'scheme_research_startup_grant':
            $app_prefix = "SU";
            break;
        case 'scheme_summer_school':
            $app_prefix = "SS";
            break;
        case 'scheme_iris':
            $app_prefix = "IRIS";
            break;
        default:
            $app_prefix = "APSC";
            break;
    }

    // fetch application count 
    $query = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";
    $data = fetchRows($query, false);
    if ($data) {
        $app_count = (int) $data['id'] + 1;
    }

    // generate application number
    $app_no = sprintf("%03d", $app_count);
    // $app_no = str_pad($app_count, 4, '0', STR_PAD_LEFT); 

    $new_application_no = $app_prefix . '' . $year . '' . $app_no;

    return $new_application_no;
    // echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$new_application_no]);
}

?>