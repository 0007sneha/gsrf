<?php 
// include('../admin_assets/includes/custom_functions.php');

function CDFA($data) {
    echo '<pre>';
    print_r($data);
    exit;
}
function CDFS($data) {
    echo '<pre>';
    print_r($data);
}

function trimSchemeListingStringCode($input) {
    // Remove the first 3 characters
    $result = substr($input, 4);

    // Remove the last 4 characters from the resulting string
    $result = substr($result, 0, -4);

    return $result;
}

function extractText($inputString) {
    // Use a regular expression to match and extract non-digit characters
    $pattern = '/[^\D]+/'; // This pattern matches anything that is not a digit
    $textOnly = preg_replace($pattern, '', $inputString);
    return $textOnly;
}


// add the key to show slider form for reviewer form
$app_key_arr_for_slider_form = ['MAJ', 'MIN', 'DF', 'PhD'];


function groupByPrefix($array) {
    $result = array();
    $types = array();

    foreach ($array as $item) {
        $prefix = extractText($item['application_no']); // Extract only the characters (e.g., "PhD", "MIN", "SU", "MAJ", "PDF")

        if (!isset($result[$prefix])) {
            $result[$prefix] = array();
            // $types[] = $prefix;
            $app_table = getTableNameBasedOnSchemeApplicationCode($prefix);
            $types[] = [
                    'prefix' => $prefix,
                    'app_table' => $app_table,
                    'scheme_name' => getSchemeNameBasedOnSchemeApplicationCode($prefix),
                    'task_count' => getTaskCount($prefix, $app_table),
            ];
        }
        $result[$prefix][] = $item['application_no'];
    }

    return array('types' => $types, 'groups' => $result);
}

function getTableNameBasedOnSchemeApplicationCode($application_type_key) {
    $app_table = '';
    switch ($application_type_key) {
        case 'PhD': 
            $app_table = "scheme_doctoral_fellowship";
            break; 
        case 'DF': 
            $app_table = "scheme_doctoral_fellowship";
            break;
        case 'PDF': 
            $app_table = "scheme_post_doctoral_fellowship";
            break;
        case 'SU':  
            $app_table = "scheme_research_startup_grant";
            break;
        case 'RSG': 
            $app_table = "scheme_research_startup_grant";
            break;
        case 'MAJ': 
            $app_table = "scheme_major_project_grant";
            break;
        case 'MIN': 
            $app_table = "scheme_minor_project_grant";
            break;
        case 'SS': 
            $app_table = "scheme_summer_school";
            break;
    }
    return $app_table;
}

function getSchemeNameBasedOnSchemeApplicationCode($application_type_key) {
    $scheme_name = '';
    switch ($application_type_key) {
        case 'PhD': 
            $scheme_name = "Doctoral Fellowship";
            break;
        case 'DF': 
            $scheme_name = "Doctoral Fellowship";
            break;
        case 'PDF': 
            $scheme_name = "Post-Doctoral Fellowship";
            break;
        case 'SU': 
        case 'RSG': 
            $scheme_name = "Startup Grants";
            break;
        case 'MIN': 
            $scheme_name = "Minor Res. Project";
            break;
        case 'MAJ': 
            $scheme_name = "Major Res. Project";
            break;
        case 'SS': 
            $scheme_name = "Summer School";
            break;
    }
    return $scheme_name;
}

?>