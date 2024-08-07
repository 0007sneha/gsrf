<?php 
// exportSchemeListingApi.php

$scheme_table = $_GET['s'];
$scheme_name = $_GET['n'];
$selectedYear = $_GET['yearlydata'];
$query = $_GET['search'];
$schemeBatchId = $_GET['schemeBatch'];
$fb_app_status = $_GET['fb_app_status'];

require '../../config/be_function.php';
include '../../config/user_access.php';

require '../../vendor/autoload.php'; // Make sure the path is correct

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$filename = $scheme_name.' List';
$data = [];  // initial array object
$excel_data = [];

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
if ($fb_app_status || $fb_app_status==0) {
    $condition .= 'ra.feedbackGiven = '.$fb_app_status.' AND ';
    $condition .= 'ra.status = 1 AND ';
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
    LEFT JOIN reviewers_assigned ra ON s.application_no = ra.application_no
    -- LEFT JOIN reviewers_feedback rev_fb ON s.application_no = rev_fb.application_id AND ra.reviewer_id = rev_fb.reviewer_id
    -- LEFT JOIN reviewers rev ON ra.reviewer_id = rev.id
WHERE $condition
ORDER BY
    s.application_no DESC
");

    // DFA($schemes);
foreach ($schemes as $key => $scheme) {
    $app_no = $scheme['application_no'];
    // $user_id = $scheme['user_id'];
    $scheme_id = $scheme['id'];
    
    // $scheme['user'] = fetchRows("SELECT id, CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) AS full_name, email, dob, phone_no AS contact_no
    //                     FROM users
    //                     WHERE id = '$user_id'
    //                 ", false);

    if ($scheme_table=="scheme_summer_school") {
        $scheme['coordinator'] = fetchRows("SELECT id, CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) AS full_name, phone_no AS contact_no, email, designation, official_address 
                        FROM scheme_ss_people_details
                        WHERE scheme_summer_school_id = '$scheme_id'
                        AND type = 'coordinator'
                        -- AND type IN ('coordinator', 'deputy_coordinator')
                    ", false);
        $scheme['deputy_coordinator'] = fetchRows("SELECT id, CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) AS full_name, phone_no AS contact_no, email, designation, official_address 
                        FROM scheme_ss_people_details
                        WHERE scheme_summer_school_id = '$scheme_id'
                        AND type = 'deputy_coordinator'
                    ", false);
        $scheme['institution'] = fetchRows("SELECT id, name, address 
                        FROM scheme_institution_details
                        WHERE scheme_summer_school_id = '$scheme_id'
                    ", false);

    } else if ($scheme_table=="scheme_major_project_grant" || $scheme_table=="scheme_minor_project_grant") {
        $scheme['coordinator'] = fetchRows("SELECT id, CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) AS full_name, phone_no AS contact_no, email, designation, official_address 
                FROM scheme_fellowship_investigator_details
                WHERE scheme_major_project_grant_id = '$scheme_id'
                AND type = 'principal_investigator'
            ");
    }
    // assign schemes in data object
    $data[] = $scheme;
}
// DFA($data);

if ($scheme_table=="scheme_summer_school") {
    $excel_data[] = ['Sr No','Application No','Application File','Coordinator Name','Deputy Coordinator Name', 'Institution Name', 'TItle', 'Participants', 'No of Participants', 'No of Working Days', 'Start Date', 'End Date','Registration Date']; 
} else if ($scheme_table=="scheme_doctoral_fellowship") {
    $excel_data[] = ['Sr No','Application No','Application File','Applicant Name','Contact No','Email','Institution Name', 'PhD Subject Area','Proposed Work','Registered with GOA Uni.','Registration Date','Confirmation Date','Have you published any papers in the proposed area','Registration Date']; 
} else if ($scheme_table=="scheme_post_doctoral_fellowship") {
    $excel_data[] = ['Sr No','Application No','Application File','Applicant Name','Contact No','Email','Title of the Ph.D. thesis','University from which Ph.D. degree is obtained','Institution in which you worked for your Ph.D','The University / Institution in which you propose to carry out your Post-Doctoral work','Title of the proposed work','Have you published any papers in the proposed area of research?','Registration Date']; 
} else if ($scheme_table=="scheme_major_project_grant" || $scheme_table=="scheme_minor_project_grant") {
    $excel_data[] = ['Sr No','Application No','Application File','Principal Investigator Name','Contact No','Email','proposed_amount','proposal_title','broad_discipline','Registration Date']; 
    // ,'proposal_summary','objectives','expected_outcome','proposal_background','international_status','national_status','local_status','proposal_significance','proposal_objectives','project_location','methodology','file_methodology','file_time_schedule','action_plan','any_other_details','specific_expertise_of_pi','bibliography','budget_consolidated'
} else if ($scheme_table=="scheme_research_startup_grant") {
    $excel_data[] = ['Sr No','Application No','Application File','Applicant Name','Contact No','Email','Designation','Title of Ph.D. thesis','University from where Ph.D./M.D/M.S/M.D.S/M.V.Sc.is obtained','Specialisation','Registration Date']; 
}

$sr_no = 0;
if (isset($data)) {
    foreach ($data as $value) :
        $sr_no++;

        if ($value['file_application_form']) {
            $app_file_url = $hostUrl.$value['file_application_form'];
        } else {
            $app_file_url = 'File not found';
        }

        if ($scheme_table=="scheme_doctoral_fellowship" || $scheme_table=="scheme_post_doctoral_fellowship" || $scheme_table=="scheme_research_startup_grant") {
            if (isset($value['first_name']) && $value['first_name']) {
                $full_name = $value['first_name'].' '.$value['middle_name'].' '.$value['last_name'];
            } else if (isset($value['usr_full_name']) && $value['usr_full_name']) {
                $full_name = $value['usr_full_name'];
            } else {
                $full_name = '';
            }
            if (isset($value['contact_no']) && $value['contact_no']) {
                $contact_no = $value['contact_no'];;
            } else if (isset($value['usr_contact_no']) && $value['usr_contact_no']) {
                $contact_no = $value['usr_contact_no'];
            } else {
                $contact_no = '';
            }
            if (isset($value['email']) && $value['email']) {
                $email = $value['email'];
            } else if (isset($value['usr_email']) && $value['usr_email']) {
                $email = $value['usr_email'];
            } else {
                $email = '';
            }

            if (isset($value['is_registered_with_goa_uni']) && $value['is_registered_with_goa_uni']) {
                $is_registered_with_goa_uni = 'Yes';
            } else {
                $is_registered_with_goa_uni = 'No';
            }
            if (isset($value['is_published_any_papers']) && $value['is_published_any_papers']) {
                $is_published_any_papers = 'Yes';
            } else {
                $is_published_any_papers = 'No';
            }
        } else if ($scheme_table=="scheme_major_project_grant" || $scheme_table=="scheme_minor_project_grant") {
            if (isset($value['coordinator']) && isset($value['coordinator'][0])) {
                $full_name = $value['coordinator'][0]['full_name'];
                $contact_no = $value['coordinator'][0]['contact_no'];
                $email = $value['coordinator'][0]['email'];
            } else {
                $full_name = '';
                $contact_no = '';
                $email = '';
            }
        }

        if ($scheme_table=="scheme_summer_school") {
            $participants = '';
            if ($value['target_audience']) {
                $targetAudienceArray = unserialize($value['target_audience']);
                $checkedValues = array_filter($targetAudienceArray, function($item1) {
                    return $item1['checked'] == 1;
                });
                $checkedValueStrings = array_map(function($item) {
                    return $item['value'];
                }, $checkedValues);
                $participants = implode(', ', $checkedValueStrings);
            }
            
            $excel_data[] = [
                $sr_no, 
                $value['application_no'], 
                $app_file_url,
                $value['coordinator']['full_name'],
                $value['deputy_coordinator']['full_name'],
                $value['institution']['name'],
                $value['scheme_title'], 
                $participants, 
                $value['no_of_participants'], 
                $value['no_of_working_days'],
                dateFormat($value['starting_date']),
                dateFormat($value['ending_date']),
                dateFormat($value['created_at']),
            ]; 
        } else if ($scheme_table=="scheme_doctoral_fellowship") {
            $excel_data[] = [
                $sr_no, 
                $value['application_no'], 
                $app_file_url,
                $full_name,
                $contact_no, 
                $email, 
                $value['institutional_address'],
                $value['phd_subject_area'], 
                $value['proposed_work'], 
                $is_registered_with_goa_uni,
                dateFormat($value['registration_date']),
                dateFormat($value['confirmation_date']),
                $is_published_any_papers,
                dateFormat($value['created_at']),
            ]; 
        } else if ($scheme_table=="scheme_post_doctoral_fellowship") {
            $excel_data[] = [
                $sr_no, 
                $value['application_no'], 
                $app_file_url,
                $full_name,
                $contact_no, 
                $email, 
                $value['phd_thesis'],
                $value['phd_degree_obtained_university'],
                $value['phd_work_proposed_institution'],
                $value['phd_work_carried_out'],
                $value['proposed_work'],
                $is_published_any_papers,
                dateFormat($value['created_at']),
            ]; 
        } else if ($scheme_table=="scheme_major_project_grant" || $scheme_table=="scheme_minor_project_grant") {
            $excel_data[] = [
                $sr_no, 
                $value['application_no'], 
                $app_file_url,
                $full_name,
                $contact_no, 
                $email, 
                'Rs. '.$value['proposed_amount'],
                $value['proposal_title'],
                $value['broad_discipline'],
                // $value['proposal_summary'],
                // $value['objectives'],
                // $value['expected_outcome'],
                // $value['proposal_background'],
                // $value['international_status'],
                // $value['national_status'],
                // $value['local_status'],
                // $value['proposal_significance'],
                // $value['proposal_objectives'],
                // $value['project_location'],
                // $value['methodology'],
                // $value['file_methodology'],
                // $value['file_time_schedule'],
                // $value['action_plan'],
                // $value['any_other_details'],
                // $value['specific_expertise_of_pi'],
                // $value['bibliography'],
                // $value['budget_consolidated'],
                dateFormat($value['created_at']),
            ];
        } else if ($scheme_table=="scheme_research_startup_grant") {
            $excel_data[] = [
                $sr_no, 
                $value['application_no'], 
                $app_file_url,
                $full_name,
                $contact_no, 
                $email, 
                $value['designation'], 
                $value['thesis_title'], 
                $value['university_name'],
                $value['specialisation'],
                dateFormat($value['created_at']),
            ]; 
        }
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
                $error_value = "Invalid URL: $value\n";
                // $error_value = "URL Not Found";
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


function dateFormat($value) {
    if ($value) {
        return date('d-m-Y',strtotime($value));
    }
    return '-';
}
?>

