<?php 
// admin_assets/api/exportCandidateListApi.php

require '../../config/connect.php';
require_once '../../data/generalData.php';

require '../../config/be_function.php';
include '../../config/user_access.php';

require '../../vendor/autoload.php'; // Make sure the path is correct

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$filename = 'Candidate List';

$query = $_GET['s'] ?? "";
$queryCategory = $_GET['c'] ?? "";
$queryGender = $_GET['g'] ?? "";

$isListAll = true;
include('./usersListApi.php');
$data = $users;

// DFA($data);

$excel_data = [];
$excel_data[] = ['Sr No','Name','Email','DOB','Phone','Gender','Category','Category File','Differently Abled','Identity No','Status','Registered On Portal']; 

$sr_no = 0;
if (isset($data)) {
    foreach ($data as $value) :
        $sr_no++;

        if ($value['file_category_certificate']) {
            $app_file_url = $hostUrl.$value['file_category_certificate'];
        } else {
            $app_file_url = 'File not found';
        }

        if ($value['status'] == 0) {
            // Reviewed 
            $status = 'Pending Verification';
        } else if ($value['status'] == 1) {
            $status = 'Verified';
        } else {
            $status = 'User Deleted';
        }

        $excel_data[] = [
                            $sr_no, 
                            $value['first_name'].' '.$value['middle_name'].' '.$value['last_name'], 
                            $value['email'],
                            getDateFormat($value['dob']),
                            getCountryCodeById($value['country_code'], $countryCodeArr).' '.$value['phone_no'],
                            $value['gender'],
                            getCategoryNameById($value['category'], $categoriesArr),
                            $app_file_url,
                            $value['differently_abled'],
                            $value['identity_no'],
                            $status,
                            getDateFormat($value['created_at']),
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
?>

