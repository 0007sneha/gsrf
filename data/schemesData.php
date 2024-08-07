<?php
// include "data/schemesData.php";    // call this api only at root level
require 'config/be_function.php';

$dfData = fetchRows("SELECT * FROM scheme_batch WHERE scheme_types_id='1' ORDER BY id DESC", false);
$pdfData = fetchRows("SELECT * FROM scheme_batch WHERE scheme_types_id='2' ORDER BY id DESC", false);
$rsgData = fetchRows("SELECT * FROM scheme_batch WHERE scheme_types_id='3' ORDER BY id DESC", false);
$minData = fetchRows("SELECT * FROM scheme_batch WHERE scheme_types_id='4' ORDER BY id DESC", false);
$majData = fetchRows("SELECT * FROM scheme_batch WHERE scheme_types_id='5' ORDER BY id DESC", false);
$ssData = fetchRows("SELECT * FROM scheme_batch WHERE scheme_types_id='6' ORDER BY id DESC", false);
// Test Template
$irData = fetchRows("SELECT * FROM scheme_batch WHERE scheme_types_id='7' ORDER BY id DESC", false);

$fileFormat1 = " PDF";
$fileFormat2 = " Doc";
$statusForceAll = 'pending';
$file_download_msg = "Thank you for applying. <br> You can download your application here.";

function validateSchemeObject($object)
{
    if (isset($object)) {
        return true;
    }
    return false;
}

// Test Template
$irisSchemeRequiredDocs = [
    'title' => 'Document formats',
    'name' => 'GSRF IRIS Scheme',
    'status' => validateSchemeObject($irData) ? $irData['status'] : $statusForceAll,
    'btn_title' => validateSchemeObject($irData) ? getApplyBtnTitle($irData['app_type']) : '',
    'app_type' => validateSchemeObject($irData) ? $irData['app_type'] : '',
    'message' => validateSchemeObject($irData) ? getMessageAsPerStatus($irData) : '',
    'note' => validateSchemeObject($irData) ? $irData['reminder_note'] : '',
    'message_bottom' => validateSchemeObject($irData) ? $irData['scheme_opening_msg_bottom'] : '',
    'approved_app_url' => validateSchemeObject($irData) ? $irData['file_approved_app_result'] : '',
    'scheme_batch_id' => validateSchemeObject($irData) ? $irData['id'] : '',
    'app_download_msg' => $file_download_msg,
    'file_format_1' => $fileFormat1,
    'file_format_2' => $fileFormat2,
    'data' => array(
        array(
            'name' => 'Application format for IRIS',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/doctoral-fellowship/Application-format-PhD-fellowship_modified.pdf',
            'url_type_2' => 'assets/documents/doctoral-fellowship/Application-format-PhD-fellowship_modified.docx',
        ),
    ),
];

$doctoralFellowshipRequiredDocs = [
    'title' => 'Document formats',
    'name' => 'GSRF Doctoral Research Fellowship Scheme',
    'status' => validateSchemeObject($dfData) ? $dfData['status'] : $statusForceAll,
    'btn_title' => validateSchemeObject($dfData) ? getApplyBtnTitle($dfData['app_type']) : '',
    'app_type' => validateSchemeObject($dfData) ? $dfData['app_type'] : '',
    'message' => validateSchemeObject($dfData) ? getMessageAsPerStatus($dfData) : '',
    'note' => validateSchemeObject($dfData) ? $dfData['reminder_note'] : '',
    'message_bottom' => validateSchemeObject($dfData) ? $dfData['scheme_opening_msg_bottom'] : '',
    'approved_app_url' => validateSchemeObject($dfData) ? $dfData['file_approved_app_result'] : '',
    'scheme_batch_id' => validateSchemeObject($dfData) ? $dfData['id'] : '',
    'app_download_msg' => $file_download_msg,
    'file_format_1' => $fileFormat1,
    'file_format_2' => $fileFormat2,
    'data' => array(
        array(
            'name' => 'Application format for Ph.D. fellowship',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/doctoral-fellowship/Application-format-PhD-fellowship_modified.pdf',
            'url_type_2' => 'assets/documents/doctoral-fellowship/Application-format-PhD-fellowship_modified.docx',
        ),
        array(
            'name' => 'Declaration of candidate',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/doctoral-fellowship/Declaration_candidate.pdf',
            'url_type_2' => 'assets/documents/doctoral-fellowship/Declaration_candidate.docx',
        ),
        array(
            'name' => 'Certificate from Research Guide',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/doctoral-fellowship/Certificate_Research_Guide.pdf',
            'url_type_2' => 'assets/documents/doctoral-fellowship/Certificate_Research_Guide.docx',
        ),
        array(
            'name' => 'Certificate from the Head of the Institution',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/doctoral-fellowship/Certificate_Head_Institution.pdf',
            'url_type_2' => 'assets/documents/doctoral-fellowship/Certificate_Head_Institution.docx',
        ),
    ),
];


$postDoctoralFellowshipRequiredDocs = [
    'title' => 'Document formats',
    'name' => 'GSRF Post-Doctoral Fellowship Scheme',
    'status' => validateSchemeObject($pdfData) ? $pdfData['status'] : $statusForceAll,
    'btn_title' => validateSchemeObject($pdfData) ? getApplyBtnTitle($pdfData['app_type']) : '',
    'app_type' => validateSchemeObject($pdfData) ? $pdfData['app_type'] : '',
    'message' => validateSchemeObject($pdfData) ? getMessageAsPerStatus($pdfData) : '',
    'note' => validateSchemeObject($pdfData) ? $pdfData['reminder_note'] : '',
    'message_bottom' => validateSchemeObject($pdfData) ? $pdfData['scheme_opening_msg_bottom'] : '',
    'approved_app_url' => validateSchemeObject($pdfData) ? $pdfData['file_approved_app_result'] : '',
    'scheme_batch_id' => validateSchemeObject($pdfData) ? $pdfData['id'] : '',
    'app_download_msg' => $file_download_msg,
    'file_format_1' => $fileFormat1,
    'file_format_2' => $fileFormat2,
    'data' => array(
        array(
            'name' => 'Application format for PDF scheme',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/post-doctoral-fellowship/GSRF-PDFApplication-format.pdf',
            'url_type_2' => '',
        ),
        array(
            'name' => 'Declaration of candidate',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/post-doctoral-fellowship/Declaration_candidate.pdf',
            'url_type_2' => 'assets/documents/post-doctoral-fellowship/Declaration_candidate.docx',
        ),
        array(
            'name' => 'Endorsement from the HoI',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/post-doctoral-fellowship/Endorsement_HoI.pdf',
            'url_type_2' => 'assets/documents/post-doctoral-fellowship/Endorsement_HoI.docx',
        ),
        array(
            'name' => 'Certificate mentor',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/post-doctoral-fellowship/Certificate_Mentor.pdf',
            'url_type_2' => 'assets/documents/post-doctoral-fellowship/Certificate_Mentor.docx',
        ),
    ),
];


$researchStartUpGrantsRequiredDocs = [
    'title' => 'Document formats',
    'name' => 'GSRF Research Start-Up Grant Scheme',
    'status' => validateSchemeObject($rsgData) ? $rsgData['status'] : $statusForceAll,
    'btn_title' => validateSchemeObject($rsgData) ? getApplyBtnTitle($rsgData['app_type']) : '',
    'app_type' => validateSchemeObject($rsgData) ? $rsgData['app_type'] : '',
    'message' => validateSchemeObject($rsgData) ? getMessageAsPerStatus($rsgData) : '$result_announcement_msg_df_min_sug',
    'note' => validateSchemeObject($rsgData) ? $rsgData['reminder_note'] : '',
    'message_bottom' => validateSchemeObject($rsgData) ? $rsgData['scheme_opening_msg_bottom'] : '',
    'approved_app_url' => validateSchemeObject($rsgData) ? $rsgData['file_approved_app_result'] : '',
    'scheme_batch_id' => validateSchemeObject($rsgData) ? $rsgData['id'] : '',
    'app_download_msg' => $file_download_msg,
    'file_format_1' => $fileFormat1,
    'file_format_2' => $fileFormat2,
    'data' => array(
        array(
            'name' => 'Application format for Research Start-up Grant scheme',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/start-up/GSRF-Research-Start-Up-Grant-Application_modified_format.pdf',
            'url_type_2' => 'assets/documents/start-up/GSRF-Research-Start-Up-Grant-Application_modified_format.docx',
        ),
        array(
            'name' => 'Declaration of candidate',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/start-up/Declaration.pdf',
            'url_type_2' => 'assets/documents/start-up/Declaration.docx',
        ),
        array(
            'name' => 'Endorsement from the Principal/HoI/Registrar',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/start-up/Endorsement.pdf',
            'url_type_2' => 'assets/documents/start-up/Endorsement.docx',
        ),
        array(
            'name' => 'Curriculum Vitae',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/minor-grants/Biodata_format.pdf',
            'url_type_2' => 'assets/documents/minor-grants/Biodata_format.docx',
        ),
    ),
];


$minorGrantsRequiredDocs = [
    'title' => 'Document formats',
    'name' => 'GSRF Minor Research Grant Scheme',
    'status' => validateSchemeObject($minData) ? $minData['status'] : $statusForceAll,
    'btn_title' => validateSchemeObject($minData) ? getApplyBtnTitle($minData['app_type']) : '',
    'app_type' => validateSchemeObject($minData) ? $minData['app_type'] : '',
    'message' => validateSchemeObject($minData) ? getMessageAsPerStatus($minData) : '$result_announcement_msg_df_min_sug',
    'note' => validateSchemeObject($minData) ? $minData['reminder_note'] : '',
    'message_bottom' => validateSchemeObject($minData) ? $minData['scheme_opening_msg_bottom'] : '',
    'approved_app_url' => validateSchemeObject($minData) ? $minData['file_approved_app_result'] : '',
    'scheme_batch_id' => validateSchemeObject($minData) ? $minData['id'] : '',
    'app_download_msg' => $file_download_msg,
    'file_format_1' => $fileFormat1,
    'file_format_2' => $fileFormat2,
    'data' => array(
        array(
            'name' => 'Application format for minor research scheme',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/minor-grants/GSRF-minor-Proposal-format_modified.pdf',
            'url_type_2' => 'assets/documents/minor-grants/GSRF-minor-Proposal-format_modified.docx',
        ),
        array(
            'name' => 'Declaration of candidate',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/minor-grants/Declaration.pdf',
            'url_type_2' => 'assets/documents/minor-grants/Declaration.docx',
        ),
        array(
            'name' => 'Endorsement from the Principal/HoI/Registrar',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/minor-grants/Endorsement.pdf',
            'url_type_2' => 'assets/documents/minor-grants/Endorsement.docx',
        ),
        array(
            'name' => 'Curriculum Vitae',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/minor-grants/Biodata_format.pdf',
            'url_type_2' => 'assets/documents/minor-grants/Biodata_format.docx',
        ),
    ),
];


$majorGrantsRequiredDocs = [
    'title' => 'Document formats',
    'name' => 'GSRF Major Research Grant Scheme',
    'status' => validateSchemeObject($majData) ? $majData['status'] : $statusForceAll,
    'btn_title' => validateSchemeObject($majData) ? getApplyBtnTitle($majData['app_type']) : '',
    'app_type' => validateSchemeObject($majData) ? $majData['app_type'] : '',
    'message' => validateSchemeObject($majData) ? getMessageAsPerStatus($majData) : '',
    'note' => validateSchemeObject($majData) ? $majData['reminder_note'] : '',
    'message_bottom' => validateSchemeObject($majData) ? $majData['scheme_opening_msg_bottom'] : '',
    'approved_app_url' => validateSchemeObject($majData) ? $majData['file_approved_app_result'] : '',  //assets/documents/approved-schemes/
    'scheme_batch_id' => validateSchemeObject($majData) ? $majData['id'] : '',
    'app_download_msg' => $file_download_msg,
    'file_format_1' => $fileFormat1,
    'file_format_2' => $fileFormat2,
    'data' => array(
        array(
            'name' => 'Application format for major research scheme',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/major-grants/GSRF-major_Proposal-format.pdf',
            'url_type_2' => '',
        ),
        array(
            'name' => 'Declaration of candidate',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/major-grants/Declaration.pdf',
            'url_type_2' => 'assets/documents/major-grants/Declaration.docx',
        ),
        array(
            'name' => 'Endorsement from the Principal/HoI/Registrar',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/major-grants/Endorsement.pdf',
            'url_type_2' => 'assets/documents/major-grants/Endorsement.docx',
        ),
        array(
            'name' => 'Curriculum Vitae',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/major-grants/Biodata_format.pdf',
            'url_type_2' => 'assets/documents/major-grants/Biodata_format.docx',
        ),
    ),
];


$summerSchoolRequiredDocs = [
    'title' => 'Document formats',
    'name' => 'GSRF Summer/Winter School Scheme',
    'status' => validateSchemeObject($ssData) ? $ssData['status'] : $statusForceAll,
    'btn_title' => validateSchemeObject($ssData) ? getApplyBtnTitle($ssData['app_type']) : '',
    'app_type' => validateSchemeObject($ssData) ? $ssData['app_type'] : '',
    'message' => validateSchemeObject($ssData) ? getMessageAsPerStatus($ssData) : '$closing_announcement_msg_ss',
    'note' => validateSchemeObject($ssData) ? $ssData['reminder_note'] : '',
    'message_bottom' => validateSchemeObject($ssData) ? $ssData['scheme_opening_msg_bottom'] : '',
    'approved_app_url' => validateSchemeObject($ssData) ? $ssData['file_approved_app_result'] : '',  //assets/documents/approved-schemes/
    'scheme_batch_id' => validateSchemeObject($ssData) ? $ssData['id'] : '',
    'app_download_msg' => $file_download_msg,
    'file_format_1' => $fileFormat1,
    'file_format_2' => $fileFormat2,
    'data' => array(
        array(
            'name' => 'Application format for Summer School scheme',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/summer-school/GSRF-SummerSchool_Application_format.pdf',
            'url_type_2' => 'assets/documents/summer-school/GSRF-SummerSchool_Application_format.docx',
        ),
        array(
            'name' => 'Declaration by the co-ordinator ',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/summer-school/Declaration.pdf',
            'url_type_2' => 'assets/documents/summer-school/Declaration.docx',
        ),
        array(
            'name' => 'Certificate from the Principal/HoI/Registrar',
            'fileName' => 'Download',
            'url_type_1' => 'assets/documents/summer-school/Certificate.pdf',
            'url_type_2' => 'assets/documents/summer-school/Certificate.docx',
        ),
    ),
];


// Apply-form and Preview-form
if (isset($isSchemeAvailableFor)) {
    if ($isSchemeAvailableFor == "DF") {
        if ($doctoralFellowshipRequiredDocs["status"] == "open") {
        } else {
            echo "<script>location.href = 'schemes-doctoral-fellowship.php';</script>";
        }
    } else if ($isSchemeAvailableFor == "MIN") {
        if ($minorGrantsRequiredDocs["status"] == "open") {
        } else {
            echo "<script>location.href = 'schemes-minor-grants.php';</script>";
        }
    } else if ($isSchemeAvailableFor == "RSG") {
        if ($researchStartUpGrantsRequiredDocs["status"] == "open") {
        } else {
            echo "<script>location.href = 'schemes-summer-school.php';</script>";
        }
    } else if ($isSchemeAvailableFor == "MAJ") {
        if ($majorGrantsRequiredDocs["status"] == "open") {
        } else {
            echo "<script>location.href = 'schemes-major-grants.php';</script>";
        }
    } else if ($isSchemeAvailableFor == "SS") {
        if ($summerSchoolRequiredDocs["status"] == "open") {
        } else {
            echo "<script>location.href = 'schemes-summer-school.php';</script>";
        }
    } else if ($isSchemeAvailableFor == "PDF") {
        if ($postDoctoralFellowshipRequiredDocs["status"] == "open") {
        } else {
            echo "<script>location.href = 'schemes-post-doctoral-fellowship.php';</script>";
        }
        //IRIS SCHEME
    }else if ($isSchemeAvailableFor == "PDF") {
        if ($irisSchemeRequiredDocs["status"] == "open") {
        } else {
            echo "<script>location.href = 'schemes-iris.php';</script>";
        }
    } else {
        // do nothing
    }
}

function getMessageAsPerStatus($object)
{
    $msg = '';
    if ($object) {
        switch ($object['status']) {
            case 'open':
                $msg = $object['scheme_opening_msg'];
                break;
            case 'pending':
                $msg = $object['scheme_pending_msg'];
                break;
            case 'close':
                $msg = $object['scheme_closing_msg'];
                break;
            case 'result':
                $msg = $object['scheme_result_msg'];
                break;
            default:
                $msg = '';
                break;
        }

        // General Messages for empty fields
        if ($msg == "" && $object['status'] == "close") {
            $msg = '<p class="scheme-status">“Thank you for your overwhelming response to the scheme.”</p>
                    <p>The received applications will undergo scrutiny and review process. The applicants will be informed of the status after completion of the process, which might take about two months. </p>
                    <p class="note">Those who could not make it to this cycle, please wait for the next cycle.</p>';
        } else if ($msg == "" && $object['status'] == "result") {
            $msg = "<p>Project Proposals approved for financial assistance</p>";
        }
    } else {
        $msg = "<p>“The Scheme opening date will be announced later”</p>";
    }
    return $msg;
}

function getApplyBtnTitle($app_type)
{
    switch ($app_type) {
        case 'form':
            $msg = 'APPLY NOW';
            break;     // for the form filling
        case 'doc':
            $msg = 'SUBMIT APPLICATION';
            break;    // for direct document upload
        default:
            $msg = '';
            break;
    }
    return $msg;
}

?>