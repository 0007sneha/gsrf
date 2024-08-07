<?php 
// exportApplicationListApi.php

$scheme_table = $_GET['s'];
$scheme_name = $_GET['n'];
$selectedYear = $_GET['yearlydata'];
$selected_scheme_type = $_GET['scheme_type']; // not required
$schemeBatchId = $_GET['schemeBatch'];
$query = $_GET['search'];

require '../../config/be_function.php';
include '../../config/user_access.php';

require '../../vendor/autoload.php'; // Make sure the path is correct

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$filename = $scheme_name.' List';
$data = [];  // initial array object

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

$schemes = fetchRows("SELECT
    s.*,
    usr.first_name AS usr_first_name,
    usr.middle_name AS usr_middle_name,
    usr.last_name AS usr_last_name,
    CONCAT(usr.first_name, ' ', COALESCE(usr.middle_name, ' '), ' ', usr.last_name) AS usr_full_name, 
    usr.email AS usr_email, 
    usr.dob AS usr_dob, 
    usr.phone_no AS usr_contact_no
    -- ra.id AS ra_id,
    -- ra.due_date AS ra_due_date,
    -- ra.feedbackGiven AS ra_feedbackGiven,
    -- ra.reviewer_id AS ra_reviewer_id,
    -- ra.status AS ra_status,
    -- rev_fb.id AS rev_fb_id,
    -- rev_fb.app_status_response AS rev_fb_app_status_response,
    -- rev.id AS rev_id,
    -- rev.name AS rev_name,
    -- rev.email AS rev_email
FROM
    $scheme_table s
    LEFT JOIN users usr ON s.user_id = usr.id
    -- LEFT JOIN reviewers_assigned ra ON s.application_no = ra.application_no
    -- LEFT JOIN reviewers_feedback rev_fb ON s.application_no = rev_fb.application_id AND ra.reviewer_id = rev_fb.reviewer_id
    -- LEFT JOIN reviewers rev ON ra.reviewer_id = rev.id
WHERE $condition
ORDER BY
    s.application_no DESC
");
foreach ($schemes as $key => $scheme) {
    $app_no = $scheme['application_no'];
    // $user_id = $scheme['user_id'];
    
    // $scheme['user'] = fetchRows("SELECT id, CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) AS full_name, email, dob, country_code, phone_no
    //                     FROM users
    //                     WHERE id = '$user_id'
    //                 ", false);

    $rev_assigned = fetchRows("SELECT id, application_no, reviewer_id, due_date, feedbackGiven 
                    FROM reviewers_assigned
                    WHERE application_no = '$app_no'
                ");

    $data_rev_assigned = [];
    if ($rev_assigned) {
        foreach ($rev_assigned as $key2 => $rev_assign) {
            $reviewer_id = $rev_assign['reviewer_id'];
            
            $rev_assign['reviewer'] = fetchRows("SELECT id, name, email, isActive
                                    FROM reviewers
                                    WHERE id = '$reviewer_id'
                                ", false);
            
            $rev_assign['rev_feedback'] = fetchRows("SELECT id, application_id, reviewer_id, overall_rating, remarks, app_status_response
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

$excel_data = [];
$excel_data[] = ['Sr No','Application No','Application File','Applicant Name','Rev 1 Name','Rev 1 Due Date','Rev 1 Recommendation','Rev 1 score','Rev 2 Name','Rev 2 Due Date','Rev 2 Recommendation','Rev 2 score','Status/Review Form']; 

$sr_no = 0;
if (isset($data)) {
    foreach ($data as $value) :
        $sr_no++;

        $rev_name_0 = $rev_remarks_0 = $rev_overall_rating_0 = $rev_feedback_given_0 = $rev_due_date_0 =
        $rev_name_1 = $rev_remarks_1 = $rev_overall_rating_1 = $rev_feedback_given_1 = $rev_due_date_1 = "-";
        if (isset($value['rev_assigned'])) {
            if ( isset($value['rev_assigned'][0]) ) {
                $rev_assigned = $value['rev_assigned'][0];
                $rev_name_0 =  $rev_assigned['reviewer']['name'] ?? "-" ;

                $rev_remarks_0 =  $rev_assigned['rev_feedback']['remarks'] ?? "-" ;
                $rev_overall_rating_0 =  $rev_assigned['rev_feedback']['score'] ?? "-" ;

                $rev_feedback_given_0 = $rev_assigned['feedbackGiven'];
                if ($rev_assigned['due_date']) {
                    $due_date = date('d-m-Y', strtotime($rev_assigned['due_date']));
                } else {
                    $due_date = '-';
                }
                $rev_due_date_0 = $due_date;
            }
            if ( isset($value['rev_assigned'][1]) ) {
                $rev_assigned = $value['rev_assigned'][1];
                $rev_name_1 =  $rev_assigned['reviewer']['name'] ?? "-" ;

                $rev_remarks_1 =  $rev_assigned['rev_feedback']['remarks'] ?? "-" ;
                $rev_overall_rating_1 =  $rev_assigned['rev_feedback']['score'] ?? "-" ;

                $rev_feedback_given_1 = $rev_assigned['feedbackGiven'];
                if ($rev_assigned['due_date']) {
                    $due_date = date('d-m-Y', strtotime($rev_assigned['due_date']));
                } else {
                    $due_date = '-';
                }
                $rev_due_date_1 = $due_date;
            }
        }
        
        if ($value['file_application_form']) {
            $app_file_url = $hostUrl.$value['file_application_form'];
        } else {
            $app_file_url = 'File not found';
        }

        if ($rev_feedback_given_0 > 0) {
            // Reviewed 
            $feedback_status = $hostUrl.'admin_assets/api/exportFeedbackApi.php?aid='.$value['application_no'];
        } else if ($rev_feedback_given_0 == 0) {
            $feedback_status = 'In Review';
        } else {
            $feedback_status = 'Unassigned';
        }

        $excel_data[] = [
                            $sr_no, 
                            $value['application_no'], 
                            $app_file_url,
                            $value['usr_full_name'],
                            $rev_name_0,
                            $rev_due_date_0,
                            $rev_remarks_0,
                            $rev_overall_rating_0,
                            $rev_name_1,
                            $rev_due_date_1,
                            $rev_remarks_1,
                            $rev_overall_rating_1,
                            $feedback_status
                        ]; 
    endforeach;
}
// DFA($excel_data);

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
// Get the active sheet
$sheet = $spreadsheet->getActiveSheet();
// Set cell values for the table headings
$headings = array_shift($excel_data);
$column = 'A';
foreach ($headings as $heading) {
    $sheet->setCellValue($column . '1', $heading);
    $column++;
}

// Set cell values for the table content, including hyperlinks
$row = 2;
foreach ($excel_data as $rowData) {
    $column = 'A';
    foreach ($rowData as $value) {
        if (strpos($value, 'http') === 0 || strpos($value, 'https') === 0) {
            // If the cell value is a URL, validate it before creating a hyperlink
            $replaceWhiteSpaceUrl = str_replace('  ', '', $value); // encode white space so it should not cause any issue
            $replaceWhiteSpaceUrl = str_replace(' ', '', $replaceWhiteSpaceUrl); // encode white space so it should not cause any issue
            if (filter_var($replaceWhiteSpaceUrl, FILTER_VALIDATE_URL)) {
                $sheet->setCellValue($column . $row, '=HYPERLINK("' . $value . '", "View & Download")');
                $hyperlink = $sheet->getCell($column . $row)->getHyperlink();
                $hyperlink->setUrl($value);
                $hyperlink->setTooltip($value);
            } else {
                // Handle broken or invalid URLs (e.g., log them or skip)
                // $error_value = "Invalid URL: $value\n";
                $error_value = "URL Not Found";
                // $error_value = $value;
                $sheet->setCellValue($column . $row, $error_value);
            }
        } else {
            // Otherwise, set the cell value as usual
            $sheet->setCellValue($column . $row, $value);
        }
        $column++;
    }
    $row++;
}

// Adjust column widths based on content
foreach (range('A', $sheet->getHighestColumn()) as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
// Create a writer and save the file to the output stream
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>

