<?php
// exportFeedbackApi.php
// session_start();
require_once '../../admin/config/config.php';
include '../../config/html_to_pdf_style.php';
// require_once '../../admin/includes/auth_validate.php';
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$disableHeaders = true;

$aid = $_GET['aid'];
//  if rev_id is not null then single feedback data
$rev_id = isset($_GET['r']) ? $_GET['r'] : "";
$go_to_file_path = '../';
include($go_to_file_path.'../admin_assets/api/viewFeedbackApiData.php');

$filename = $aid.'-'.$user_data['invst_name'];

$html = $pdf_head_start;
$html .= '<title>GSRF-View Review </title>';
$html .= $pdf_style;
$html .= $pdf_head_end;
$html .= '<body>';
$sr_no = 0;
if ($reviewersFeedback != null) {
    foreach ($reviewersFeedback as $keyRF => $fb) {
        // echo "<pre>"; print_r($fb); exit; 
        if (count($fb['feedback']) > 0) {
            $html .= '
            <div class="container">
                <div class="row">
                    <table class="table table-bordered">
                    <tbody>
                        <tr><td colspan="6" style="background-color: #E7ECEF; padding: 5px 0 0;"></td></tr>
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Application No : <strong>' . $aid . '</strong>
                            </td>
                        </tr>';
                
                if ($is_scheme_maj || $is_scheme_min) {
                    $html .= '
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Name of the Principal Investigator : <strong>' .$user_data['invst_name']. '</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Title of the proposed work : <strong>' .$user_data['proposal_title']. '</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Subject area of the project : <strong>' .$user_data['broad_discipline']. '</strong>
                            </td>
                        </tr>';
                } else {
                    $html .= '
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Name of the Candidate : <strong>' .$user_data['invst_name']. '</strong>
                            </td>
                        </tr>';
                }
                    // $html .= '
                    //     <tr>
                    //         <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                    //             Reviewed By : <strong>'. $fb['name'] . '</strong>
                    //         </td>
                    //     </tr>';
                // $filename .= ' Reviewer-'.$keyRF+1;
                $html .= '<tr><td colspan="6" style="background-color: #E7ECEF; padding: 5px 0 0;"></td></tr>';

            $collectedData = $fb['feedback'];
            foreach ($collectedData as $key => $question) {
                $sr_no = $key + 1;
                $questionMergedId = $question['id'];
                
                if (in_array($application_type_key, $app_key_arr_for_slider_form)) {
                    $html .= '
                        <tr>
                            <td colspan="6" class="p-d5">' . $sr_no++ . ". " . $question['title'] . ' </td>
                        </tr>
                        <tr>
                            <td colspan="6">Rating : ' . $question['rating'] . ' / 10</td>
                        </tr>';
                } else {
                    $html .= '
                        <tr>
                            <td colspan="6" class="p-d5">' . $sr_no++ . ". " . $question['title'] . '</td>
                        </tr>
                        <tr>
                            <td colspan="6"> >> ' . $question['comments'] . '</td>
                        </tr>
                        <tr>
                            <td colspan="6">Rating : ' . $question['rating'] . '</td>
                        </tr>';
                }
            }

            if (in_array($application_type_key, $app_key_arr_for_slider_form)) {
                $html .= '
                        <tr>
                            <td colspan="6" class="p-d5">' . $sr_no++ . '. Recommendations for funding ?</td>
                        </tr>
                        <tr>
                            <td colspan="6"> >> ' ;
                                if ($fb['recommendation'] == 1 ) {
                                    $html .= 'Recommended';
                                } else {
                                    $html .= 'Not recommended';
                                }

                $html .= '
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-d5">' .  $sr_no++   . '. ';
                                if ($fb['recommendation'] == 1 ) {
                                    $html .= 'If recommended, comment on the budget.';
                                } else {
                                    $html .= 'If not recommended, reasons for not recommending.';
                                }
                $html .= '  </td>
                        </tr>
                        <tr>
                            <td colspan="6">';
                                if ($fb['recommendation'] == 1 ) {
                                    $html .= 'Please comment on each item of the budget for its appropriateness. You may also suggest for any or each of the items.';
                                } else {
                                    $html .= 'Please provide reason for not recommending.';
                                }
                $html .= '
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"> >> '.$fb['comment_on_recommendation'].'</td>
                        </tr>';
            }
            $html .= '  <tr>
                            <td colspan="6" class="p-d5">' .  $sr_no++   . '. Overall Score</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="margin: 15px 10px;">
                                <div style="padding: 15px 10px; border: 1px solid #00000026;>
                                    <span style="font-size: larger;"> Score &nbsp;&nbsp;' . $fb['overall_rating'] . '</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <h5 style="margin: 20px 0px;"></h5>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>';
                        // <tr>
                        //     <td style=" margin: 15px 10px;">
                        //         <div style="padding: 15px 10px; border: 1px solid #00000026;>
                        //             <span style="font-size: larger;"> Score &nbsp;&nbsp;' . $fb['overall_rating'] . '</span>
                        //         </div>
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Excellent</strong><br>
                        //         9.1-10.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Very Good</strong><br>
                        //         7.1-9.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Good</strong><br>
                        //         5.1-7.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Satisfactory</strong><br>
                        //         4.1-5.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Not Satisfactory</strong><br>
                        //         &lt;4.0
                        //     </td>
                        // </tr>
        }
        $html .= '<div class="page-break_after"></div>';
    }
} else {
    $filename .= ' Reviewer-'.$revNo;

    $html .= '
        <div class="container">
            <div class="row">
                <table class="table table-bordered">
                    <tbody>
                        <tr><td colspan="6" style="background-color: #E7ECEF; padding: 5px 0 0;"></td></tr>
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Application No : <strong>' . $aid . '</strong>
                            </td>
                        </tr>';

                if ($is_scheme_maj || $is_scheme_min) {
                    $html .= '  
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Name of the Principal Investigator : <strong>' .$user_data['invst_name']. '</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Title of the proposed work : <strong>' .$user_data['proposal_title']. '</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Subject area of the project : <strong>' .$user_data['broad_discipline']. '</strong>
                            </td>
                        </tr>';
                } else {
                    $html .= '  
                        <tr>
                            <td colspan="6" class="" style="background-color: #E7ECEF; padding: 5px 10px;">
                                Name of the Candidate : <strong>' .$user_data['invst_name']. '</strong>
                            </td>
                        </tr>';
                }
            $html .= '<tr><td colspan="6" style="background-color: #E7ECEF; padding: 5px 0 0;"></td></tr>';

        foreach ($collectedData as $key => $question) :
            $questionMergedId = $question['id'];
            $sr_no = $key + 1;

            if (in_array($application_type_key, $app_key_arr_for_slider_form)) {
                $html .= '<tr>
                            <td colspan="6" class="p-d5">' . $sr_no++ . ". " . $question['title'] . '</td>
                        </tr>
                        <tr>
                            <td colspan="6">Rating : ' . $question['rating'] . ' / 10 </td>
                        </tr>';
            } else {
                $html .= '<tr>
                            <td colspan="6" class="p-d5">' . $sr_no++ . ". " . $question['title'] . '</td>
                        </tr>
                        <tr>
                            <td colspan="6"> >> ' . $question['comments'] . '</td>
                        </tr>
                        <tr>
                            <td colspan="6">Rating : ' . $question['rating'] . '</td>
                        </tr>';
            }
        endforeach;

        if (in_array($application_type_key, $app_key_arr_for_slider_form)) {
            $html .= '  <tr>
                            <td colspan="6" class="p-d5">' . $sr_no++ . '. Recommendations for funding ?</td>
                        </tr>
                        <tr>
                            <td colspan="6"> >> ';
                                if ($review['recommendation'] == 1 ) {
                                    $html .= 'Recommended';
                                } else {
                                    $html .= 'Not recommended';
                                }

            $html .= '      </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-d5">' .  $sr_no++   . '. ';
                                if ($review['recommendation'] == 1 ) {
                                    $html .= 'If recommended, comment on the budget.';
                                } else {
                                    $html .= 'If not recommended, reasons for not recommending.';
                                }
                        $html .= '
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">';
                                if ($review['recommendation'] == 1 ) {
                                    $html .= 'Please comment on each item of the budget for its appropriatness. You may also suggest for any or each of the items.';
                                } else {
                                    $html .= 'Please provide reason for not recommending.';
                                }
                $html .= '

                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"> >> '.$review['comment_on_recommendation'].'</td>
                        </tr>';
        }

    $html .= '          <tr>
                            <td colspan="6" class="p-d5">' .  $sr_no++   . '. Overall Score</td>
                        </tr>
                        <tr>
                            <td colspan="6" >
                                <div style="padding: 15px 10px; border: 1px solid #00000026;>
                                    <span style="font-size: larger;"> Score &nbsp;&nbsp;' . $review['overall_rating'] . '</span>
                                </div>
                            </td>
                        </tr>';
                        
                        // <tr>
                        //     <td style=" margin: 15px 10px;">
                        //         <div style="padding: 15px 10px; border: 1px solid #00000026;>
                        //             <span style="font-size: larger;"> Score &nbsp;&nbsp;' . $review['overall_rating'] . '</span>
                        //         </div>
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Excellent</strong><br>
                        //         9.1-10.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Very Good</strong><br>
                        //         7.1-9.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Good</strong><br>
                        //         5.1-7.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Satisfactory</strong><br>
                        //         4.1-5.0
                        //     </td>
                        //     <td style="padding: 15px 10px">
                        //         <strong>Not Satisfactory</strong><br>
                        //         &lt;4.0
                        //     </td>
                        // </tr>
}
$html.='</body>';    
$html .= $pdf_html_end;
// echo $html; exit;

// Create a Dompdf instance
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isRemoteEnabled', true); // Ensure remote images are enabled
$options->set('defaultFont', 'Inter');
$dompdf = new Dompdf($options);
// Load HTML content into Dompdf
$dompdf->loadHtml($html);
// Set paper size and orientation (optional)
$dompdf->setPaper('A4', 'portrait');
// Render the PDF
$dompdf->render();
// Output the PDF
$dompdf->stream(''.$filename.'.pdf', array("Attachment" => 1));


?>