<?php
    require '../config/be_function.php';
    include '../config/html_to_pdf_style.php';
    include '../admin_assets/includes/email_template.php';
    include '../config/send_email.php';
    include '../config/user_access.php';
    require 'applicationNoApi.php';     // Application number
    include '../data/generalData.php'; 
    include '../vendor/autoload.php';    
    use Dompdf\Dompdf;
    use Dompdf\Options;
    use setasign\Fpdi\Fpdi;

    $base_path = '../';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id']; // user_id   
        $type = $_GET['type'];
        $schemeBatchId = $_GET['schemeBatchId'];
        $dev = $_GET['dev'] ?? 'null';        


        if (isset($type) && $type!="download-pdf") {
            $data = fetchRows("SELECT * FROM scheme_summer_school WHERE status = 1 AND user_id = $id AND scheme_batch_id = $schemeBatchId ORDER BY id DESC ", false);
            if ($data) {
                $getId = $data['id'];
                if (isset($data['target_audience'])) {
                    $data['target_audience'] = unserialize($data['target_audience']);
                }
                $data['coordinator_details'] = fetchRows("SELECT * FROM scheme_ss_people_details
                                            WHERE scheme_summer_school_id = $getId
                                            AND type <> 'resource_person'
                                        ");
                                        
                $data['institution_details'] = fetchRows("SELECT * FROM scheme_institution_details
                                            WHERE scheme_summer_school_id = $getId
                                        ");
                                        
                $data['resource_person_details'] = fetchRows("SELECT * FROM scheme_ss_people_details
                                            WHERE scheme_summer_school_id = $getId
                                            AND type = 'resource_person'
                                        ");
                                        
                $data['session_wise_topic_details'] = fetchRows("SELECT * FROM scheme_ss_syllabus_details
                                            WHERE scheme_summer_school_id = $getId
                                        ");
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found, Invalid user ID!']); exit;
            }
        }

        if (isset($type) && $type=="preview") {
            // also called for to show saved data before submitting res in apply_for_scheme page
            if($data){
                echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$data]); exit;
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found', 'data'=>'']); exit;
            }

        } else if (isset($type) && $type=="download-pdf") {
            $data = fetchRows("SELECT id, user_id, application_no, file_application_form 
                                FROM scheme_summer_school 
                                WHERE user_id = $id AND scheme_batch_id = $schemeBatchId 
                                ORDER BY id DESC ", false);
            if ($data) {
                echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$data]);
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to download file', 'data'=>'']);
            }

        } else if (isset($type) && $type=="generate-pdf") {
            $coordinatorDetails = $data['coordinator_details'][0];
            $deputyCoordinatorDetails = $data['coordinator_details'][1];
            $filename = $data["application_no"].'-'.$coordinatorDetails["first_name"].' '.$coordinatorDetails["last_name"];
            // generate file name
            $pdf_filename = uniqid().'-'.$filename.'.pdf';
            $pdf_file_location = 'uploads/' . $pdf_filename;

            // fetch Filename and return response
            if ($dev == "filename" || $dev=="displayfile") {
                if ($data["file_application_form"]) {
                    $pdf_file_location =  $data["file_application_form"];
                    $filenameStatus = 'Record present in DB';
                } else {
                    // save generated pdf
                    $query = "UPDATE scheme_summer_school SET file_application_form=:file_application_form 
                                WHERE user_id = '".$id." ' AND scheme_batch_id = '".$schemeBatchId."' 
                                ORDER BY id DESC";
                    $data_update2 = array(
                            ':file_application_form' => $pdf_file_location,
                        );
                    insertRow($query, $data_update2);
                    $filenameStatus = 'New File name updated in DB !';
                }
                if ($filenameStatus) {
                    $fileData = array(
                        'id' => $data["id"],
                        'user_id' => $data["user_id"],
                        'application_no' => $data["application_no"], 
                        'file' => $pdf_file_location, 
                    );
                    if ($dev == "filename") {
                        echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>$filenameStatus, 'data'=>$fileData ]); exit;
                    }
                }
            }

            $countryCode_data0 = findObjectById($countryCodeArr, $coordinatorDetails['country_code']);
            $countryCode_data1 = findObjectById($countryCodeArr, $deputyCoordinatorDetails['country_code']);
            $startingDate = $data['starting_date'];
            $endingDate = $data['ending_date'];

            // create PDF
                $html = $pdf_head_start;
                $html .= '<title>GSRF-Summer School Scheme </title>';
                $html .= $pdf_style;
                $html .= $pdf_head_end;
                $html .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 40px !important;">
                                                <div style="max-width:fit-content;">
                                                    <img class="img-fluid" src="'.$logoUrlBase64.'" alt="GOA STATE RESEARCH FOUNDATION">
                                                </div>
                                            </td>
                                            <td style="width: 100% !important; padding-bottom: 20px;">
                                                <h2 class="logo me-auto me-lg-0 logo_title" style="padding-top: 20px; ">
                                                    GOA STATE RESEARCH FOUNDATION
                                                    <br>
                                                    <span style="font-size: 14px">(Established through Goa Act 8 of 2022)</span>
                                                </h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h3>
                                        Application for Summer School Scheme
                                    </h3>
                                </div>
                                <div class="mb-5">
                                    <h3>Application Details</h3>
                                    <table>
                                        <tbody>
                                            <tr><td>Application Number </td><td class="fs-12">'.$data["application_no"].' </td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-5">
                                    <h3>Coordinator Information</h3>
                                    <table>
                                        <tbody>
                                            <tr><td>Name </td><td>'.$coordinatorDetails["first_name"].' '.$coordinatorDetails["middle_name"].' '.$coordinatorDetails["last_name"].' </td></tr>
                                            <tr><td>Mobile No. </td><td>'.$countryCode_data0["name"].' </span>&nbsp;<span>'.$coordinatorDetails["phone_no"].' </td></tr>
                                            <tr><td>Email ID</td><td>'.$coordinatorDetails["email"].' </td></tr>
                                            <tr><td>Designation</td><td>'.$coordinatorDetails["designation"].' </td></tr>
                                            <tr><td>Official Address</td><td>'.nl2br(htmlspecialchars($coordinatorDetails["official_address"])).' </td></tr>
                                        </tbody>
                                    </table>';
                                    if ($deputyCoordinatorDetails) {
                                        $html .= '<h3>Deputy Coordinator Information</h3>
                                                <table>
                                                    <tbody>
                                                        <tr><td>Name </td><td>'.$deputyCoordinatorDetails["first_name"].' '.$deputyCoordinatorDetails["middle_name"].' '.$deputyCoordinatorDetails["last_name"].' </td></tr>
                                                        <tr><td>Mobile No. </td><td>'.$countryCode_data1["name"].' </span>&nbsp;<span>'.$deputyCoordinatorDetails["phone_no"].' </td></tr>
                                                        <tr><td>Email ID</td><td>'.$deputyCoordinatorDetails["email"].' </td></tr>
                                                        <tr><td>Designation</td><td>'.$deputyCoordinatorDetails["designation"].' </td></tr>
                                                        <tr><td>Address</td><td>'.nl2br(htmlspecialchars($deputyCoordinatorDetails["official_address"])).' </td></tr>
                                                    </tbody>
                                                </table>';
                                    }
                                    
                        $html .= '  <h3 class="mt-5">Institution Details</h3>
                                    <label>Name and complete address of the Institution</label>
                                    <table class="border">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width" style="width: 240px !important;">Name of the Institute</th>
                                            <th class="th-width">Institute Address</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['institution_details'] as $key => $value) 
                                            {
                                                $html .= '<tr>
                                                    <th class="text-center">'.++$key.'</th>
                                                    <td>'.$value["name"].'</td>
                                                    <td>'.nl2br(htmlspecialchars($value["address"])).'</td>
                                                </tr>';
                                            }
                                $html .= '</tbody>
                                    </table>
                                </div>
                                
                                <div class="page-break"></div>
                                
                                <div class="mb-5">
                                    <h3>Event Details </h3>
                                    <table>
                                        <tbody>
                                            <tr><td class="fw-5">A broad area of the workshop</td></tr>
                                            <tr><td class="pb-2">'.nl2br(htmlspecialchars($data["broad_area_of_workshop"])).' </td></tr>
                                            <tr><td class="fw-5">Title of the summer/winter school</td></tr>
                                            <tr><td class="pb-2">'.nl2br(htmlspecialchars($data["scheme_title"])).' </td></tr>
                                            <tr><td class="fw-5">Target audience </td></tr>
                                            <tr><td class="pb-2">
                                                    <table><tbody><tr>';
                                                    if (isset($data['target_audience'])) {
                                                        foreach ($data["target_audience"] as $key => $value) {
                                                            $aud_status = $value["checked"] == '1' ? 'checked' : '';
                                                            $html .= '
                                                                    <td class="">
                                                                        <input class="form-check-input pb-0" type="checkbox" name="target_audience" id="target_audience_'.$value["id"].'" value="'.$value["value"].'" '.$aud_status.' onclick="return false;"/>
                                                                        <label class="form-check-label" style="padding-top:0px: padding-bottom:10px" for="target_audience_'.$value["id"].'">'.$value["value"].'</label>
                                                                    </td>
                                                                ';
                                                        }
                                                    }
                                        $html .= '  </tr></tbody></table>
                                                </td>
                                            </tr>
                                            <tr><td class="fw-5">Proposed starting date</td></tr>
                                            <tr><td class="pb-2">'.$startingDate.' </td></tr>
                                            <tr><td class="fw-5">Proposed ending date</td></tr>
                                            <tr><td class="pb-2">'.$endingDate.' </td></tr>
                                            <tr><td class="fw-5">Total number of working days</td></tr>
                                            <tr><td class="pb-2">'.$data["no_of_working_days"].' </td></tr>
                                            <tr><td class="fw-5">No. of participants</td></tr>
                                            <tr><td class="pb-2">'.$data["no_of_participants"].' </td></tr>
                                        </tbody>
                                    </table>

                                    <h3>Resource Persons Details</h3>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width">Name</th>
                                            <th class="th-width" style="width: 100px !important;">Designation</th>
                                            <th class="th-width">Address</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['resource_person_details'] as $key => $value) 
                                            {
                                                $html .= '<tr>
                                                    <td class="text-center">'.++$key.'</td>
                                                    <td>'.$value["name"].'</td>
                                                    <td>'.$value["designation"].'</td>
                                                    <td>'.nl2br(htmlspecialchars($value["official_address"])).'</td>
                                                </tr>';
                                            }
                                $html .= '</tbody>
                                    </table>
                                </div>

                                <div class="page-break"></div>

                                <div class="mb-5">
                                    <h3>Topics (syllabus) to be covered </h3>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width" style="width: 90px !important;">Days</th>
                                            <th class="th-width">Session Wise Topics/Syllabus</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['session_wise_topic_details'] as $key => $value) 
                                            {
                                                $html .= '<tr>
                                                    <td class="text-center">'.++$key.'</td>
                                                    <td class="text-center">'.$value["day"].'</td>
                                                    <td>'.nl2br(htmlspecialchars($value["topic"])).'</td>
                                                </tr>';
                                            }
                                $html .= '</tbody>
                                    </table>
                                </div>

                                <div class="page-break"></div>

                                <div class="mb-5">
                                    <h3>Budget Details</h3>
                                    <table class="border mb-5">
                                        <thead class="table-dark">
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width">Item</th>
                                            <th class="th-width" style="width: 140px !important;">Amount</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="fw-5 text-center">1</th>
                                                <td>Consumables
                                                    <p>Including chemicals, essential glassware, etc.</p>
                                                </td>
                                                <td class="fw-5" style="text-align:right !important">'.$data["item_cost_consumables"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="fw-5 text-center">2</th>
                                                <td>Honorarium
                                                    <table>
                                                        <tbody>
                                                            <tr><td style="border:1px solid white !important;" colspan=2>A. Resource  Person Lecture rate, Rs.750 per session (1 hour each)</td></tr>
                                                            <tr><td style="border:1px solid white !important; padding-left:20px;">No. of Sessions :  </td>
                                                                <td style="border:1px solid white !important;" > '.$data["item_cost_honorarium_no_of_lecture_sessions"].'</td></tr>
                                                            
                                                            <tr><td style="border:1px solid white !important;" colspan=2>B. Resource  Person Practicals/Field rate, Rs.750 per session (2 hour each)</td></tr>
                                                            <tr><td style="border:1px solid white !important; padding-left:20px;">No. of Sessions : </td>
                                                                <td style="border:1px solid white !important;" > '.$data["item_cost_honorarium_no_of_practical_sessions"].'</td></tr>

                                                            <tr><td style="border:1px solid white !important;" colspan=2>C. Assistant(s) for eg. in laboratory etc., Rs.500 per day each person </td></tr>
                                                            <tr><td style="border:1px solid white !important; padding-left:20px;">No. of People : </td>
                                                                <td style="border:1px solid white !important;" >'.$data["item_cost_honorarium_no_of_assistants"].'</td></tr>
                                                            <tr><td style="border:1px solid white !important; padding-left:20px;">No. of Days : </td>
                                                                <td style="border:1px solid white !important;" >'.$data["item_cost_honorarium_no_of_days"].'</td></tr>
                                                        </tbody>
                                                    </table>
                                                    <p>As  the resource  persons  are  expected  to  be  from  the same institute no Travel budget is allowed</p>
                                                </td>
                                                <td class="fw-5" style="text-align:right !important">'.$data["item_cost_honorarium"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="fw-5 text-center">3</th>
                                                <td>Working lunch, tea, snacks
                                                    <table>
                                                        <tbody>
                                                            <tr><td style="border:1px solid white !important;" colspan=2>At the rate of Rs. '.$data["item_cost_working_lunch_rate_per_day"].' per day</td></tr>
                                                            <tr><td style="border:1px solid white !important; padding-left:20px;">No. of People : </td>
                                                                <td style="border:1px solid white !important;" >'.$data["item_cost_working_lunch_no_of_assistants"].'</td></tr>
                                                            <tr><td style="border:1px solid white !important; padding-left:20px;">No. of Days : </td>
                                                                <td style="border:1px solid white !important;" >'.$data["item_cost_working_lunch_no_of_days"].'</td></tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="fw-5" style="text-align:right !important">'.$data["item_cost_working"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="fw-5 text-center">4</th>
                                                <td>Contingency 
                                                    <p>For  stationery,  photocopying, certificate printing, etc.</p>
                                                </td>
                                                <td class="fw-5" style="text-align:right !important">'.$data["item_cost_contingency"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="fw-5 text-center">5</th>
                                                <td>Overhead (20% of the total (S.No. 1-4))</td>
                                                <td class="fw-5" style="text-align:right !important">'.$data["item_cost_overhead"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="fw-5"></th>
                                                <td>TOTAL
                                                    <p>
                                                        Important Notice: To ensure compliance with our financial policies, please note that the total amount should not exceed 2.5 Lakhs.
                                                        For lesser no. of days it shall be calculated proportionally.
                                                    </p>
                                                </td>
                                                <td class="fw-5" style="text-align:right !important">'.$data["item_cost_total"].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h3>Expected outcome</h3>
                                    <p>Not more than 100 words</p>
                                    <table>
                                        <tbody>
                                            ';$html.=getHtmlContentFromString($data["expected_outcome"]); $html.='
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h3>List of Uploaded Certificates</h3>
                                    <table>
                                        <tbody>
                                            <tr><td>Declaration by the coordinator</td><td></td></tr>
                                        ';
                                            // <tr><td>Aadhar Card (Self Attested)</td><td></td></tr>
                                        $html .='
                                            <tr><td>Certificate (from Principal/Registrar) on official letterhead</td><td></td></tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </body>';
                $html .= $pdf_html_end;
            // echo $html; exit;

            // Create a PDF using Dompdf
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isPhpEnabled', true); // Enable PHP in the HTML (optional)
                $options->set('isRemoteEnabled', true); // Ensure remote images are enabled
                // $options->set('defaultFont', 'Inter');
                $options->set('defaultFont', 'NotoSansDevanagari'); 

                // Create a new instance of Dompdf
                $dompdf = new Dompdf($options);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                // Generate a unique filename for the PDF
                $temp_pdf_filename = date('YmdHis') .'-temp-'. $filename .'.pdf';
                // Define the path where you want to save the PDF
                $temp_pdf_file_location = 'uploads/' . $temp_pdf_filename;
                $temp_app_file_path = $base_path.$temp_pdf_file_location;
                // Save the PDF on the server
                file_put_contents($temp_app_file_path, $dompdf->output());
            // Provide a link to download the generated PDF
            // echo "PDF generated and saved as <a href='$temp_app_file_path' download='$temp_pdf_filename'>$temp_pdf_filename</a>"; exit;
                
            // merge all the files to attach 
                $file_to_merge = [
                    $temp_app_file_path,
                    $base_path.$data['file_declaration_certificate'],
                    // $base_path.$data['file_aadhar_card'],
                    $base_path.$data['file_principal_registrar_certificate'],
                ];
            // echo '<pre>';print_r($file_to_merge); exit;

            // Create a new PDF instance
                if ($dev=="displayfile") {
                    // generate pdf if failed to create
                    $pdf = new TCPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                } else {
                    $pdf = new Fpdi();
                }
                // Set font
                $pdf->SetFont('times', 'BI', 12);
                $headerContent = '';
                try {
                    foreach ($file_to_merge as $key => $value) {
                        // Import the first PDF (e.g., file1.pdf)
                        $pageCount = $pdf->setSourceFile($value);
                        for ($i = 1; $i <= $pageCount; $i++) {
                            // Add a new page for each imported page
                            $pdf->AddPage('P', 'A4'); // Set the A4 page size 'P' for portrait orientation, 'A4' for A4 size
                            $template = $pdf->importPage($i);
                            $templateSize = $pdf->getTemplateSize($template);
                            if ($dev=="displayfile") {
                                // generate pdf if failed to create
                                $pdf->useTemplate($template, null, null, $templateSize['w'], $templateSize['h'], true);
                            } else {
                                $pdf->useTemplate($template, null, null, $templateSize['width'], $templateSize['height'], true);    // if ex 1
                            }
                            // Call the function to add the custom header
                            $pdf->SetY(0); // Adjust the Y-coordinate as needed
                            $pdf->Cell(0, 10, $headerContent, 0, false, 'C');
                        }
                    }
                    // File Location initialed at the top 
                    // Output the merged PDF to the browser or save it to a file
                    if ($dev=="displayfile") {
                        $pdf->Output($base_path.$pdf_file_location, 'I'); // 'I' option sends the PDF to the browser for display
                        $result = true;
                    } else {
                        $pdf->Output($base_path.$pdf_file_location, 'F'); // 'F' option saves the PDF to a file
                        // echo "<a href='$host$pdf_file_location' download='$pdf_file_location'>$pdf_filename</a>"; exit;
                        
                        // save generated pdf
                        $query = "UPDATE scheme_summer_school SET file_application_form=:file_application_form WHERE user_id='".$id."' ";
                        $data_update = array(
                                ':file_application_form' => $pdf_file_location,
                            );
                        $result = insertRow($query, $data_update);
                    }

                    if ($result) {
                        if (isset($temp_pdf_filename)) {
                            if (unlink($temp_app_file_path)) {
                                // echo "File Deleted.";
                            }
                        }
                        echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'PDF Generated Successfully!', 'data'=>['file_application_form'=>$pdf_file_location] ]); exit;
                        // echo "<a href='$host$pdf_file_location' download='$pdf_file_location'>$pdf_filename</a>";
                    } else {
                        echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to Download PDF, Please Contact Support Team!' ]); exit;
                    }
                } catch (setasign\Fpdi\PdfParser\PdfParserException $e) {
                    $error_msg = 'Error: ' . $e->getMessage();
                    echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to locate PDF File, Please Contact Support Team', 'data'=>$error_msg]);
                }

        } else if (isset($type) && $type=="verify-submission") {
            if($data){
                echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$data]);
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found', 'data'=>'']);
            }
        }
    } 
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postData = json_decode(file_get_contents("php://input"), true);

        $user_id = $postData['user_id'] ?? '';
        $scheme_batch_id = $postData['scheme_batch_id'] ?? '';
        $application_no = applicationNo("scheme_summer_school");
        $form_type = $postData['form_type'] ?? '';
        $form_no = $postData['form_no'] ?? '';
        $scheme_id = $postData['scheme_id'] ?? '';
        $get_last_record_id = (int)$scheme_id;

        if (isset($postData["formSubmissionType"]) && $postData["formSubmissionType"] == 'direct') {
            $file_application_form = $postData['file_application_form'] ?? '';
            
            $query="INSERT INTO scheme_summer_school (user_id,application_no,scheme_batch_id,file_application_form,form_status)
                                VALUES (:user_id,:application_no,:scheme_batch_id,:file_application_form,:form_status)";
            $data = array(
                    ':user_id' => $user_id,
                    ':application_no' => $application_no,
                    ':scheme_batch_id' => $scheme_batch_id,
                    ':file_application_form' => $file_application_form,
                    ':form_status' => 1,
                );
            $result = insertRow($query, $data);
            if(!$result) {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to upload file !']); exit;
            }
        } else if ($form_type=='save-form') {
            $coordinator_details = $postData['coordinator_details'] ?? [];
                $institution_details = $postData['institution_details'] ?? [];

                $broad_area_of_workshop = $postData['broad_area_of_workshop'] ?? '';
                $scheme_title = $postData['scheme_title'] ?? '';
                if (isset($postData['target_audience']) && $postData['target_audience']) {
                    $target_audience = serialize($postData['target_audience']);
                } else {
                    $target_audience = '';
                }
                $starting_date = $postData['starting_date'] ?? '';
                $ending_date = $postData['ending_date'] ?? '';
                $no_of_working_days = $postData['no_of_working_days'] ?? '';
                $no_of_participants = $postData['no_of_participants'] ?? '';

                $resource_person_details = $postData['resource_person_details'] ?? [];

                $session_wise_topic_details = $postData['session_wise_topic_details'] ?? [];

                $item_cost_consumables = $postData['item_cost_consumables'] ?? '';
                $item_cost_honorarium_no_of_lecture_sessions = $postData['item_cost_honorarium_no_of_lecture_sessions'] ?? '';
                $item_cost_honorarium_no_of_practical_sessions = $postData['item_cost_honorarium_no_of_practical_sessions'] ?? '';
                $item_cost_honorarium_no_of_assistants = $postData['item_cost_honorarium_no_of_assistants'] ?? '';
                $item_cost_honorarium_no_of_days = $postData['item_cost_honorarium_no_of_days'] ?? '';
                $item_cost_honorarium = $postData['item_cost_honorarium'] ?? '';
                $item_cost_working_lunch_rate_per_day = $postData['item_cost_working_lunch_rate_per_day'] ?? '';
                $item_cost_working_lunch_no_of_assistants = $postData['item_cost_working_lunch_no_of_assistants'] ?? '';
                $item_cost_working_lunch_no_of_days = $postData['item_cost_working_lunch_no_of_days'] ?? '';
                $item_cost_working = $postData['item_cost_working'] ?? '';
                $item_cost_contingency = $postData['item_cost_contingency'] ?? '';
                $item_cost_overhead = $postData['item_cost_overhead'] ?? '';
                $item_cost_total = $postData['item_cost_total'] ?? '';

                $expected_outcome = $postData['expected_outcome'] ?? '';

                $file_aadhar_card = $postData['file_aadhar_card'] ?? '';
                $file_declaration_certificate = $postData['file_declaration_certificate'] ?? '';
            $file_principal_registrar_certificate = $postData['file_principal_registrar_certificate'] ?? '';

            if ($get_last_record_id) {
                // update
                if ($form_no == 0) {
                    $query="UPDATE scheme_summer_school SET form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(':form_no' => $form_no );
                    $result = insertRow($query, $data);

                    if ($coordinator_details) {
                        if (fetchRows("SELECT * FROM scheme_ss_people_details WHERE type <> 'resource_person' AND scheme_summer_school_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_ss_people_details WHERE type <> 'resource_person' AND scheme_summer_school_id = $get_last_record_id");
                        }
                        $query2="INSERT INTO scheme_ss_people_details (scheme_summer_school_id, type, first_name, middle_name, last_name, country_code, phone_no, email, designation, official_address ) 
                                        VALUES (:scheme_summer_school_id, :type, :first_name, :middle_name, :last_name, :country_code, :phone_no, :email, :designation, :official_address )";
                        foreach ($coordinator_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_summer_school_id' => $get_last_record_id,
                                        ':type' => $value['type'],
                                        ':first_name' => $value['first_name'],
                                        ':middle_name' => $value['middle_name'],
                                        ':last_name' => $value['last_name'],
                                        ':country_code' => $value['country_code'],
                                        ':phone_no' => $value['phone_no'],
                                        ':email' => $value['email'],
                                        ':designation' => $value['designation'],
                                        ':official_address' => $value['official_address'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                    if ($institution_details) {
                        if (fetchRows("SELECT * FROM scheme_institution_details WHERE scheme_summer_school_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_institution_details WHERE scheme_summer_school_id = $get_last_record_id");
                        }
                        $query2="INSERT INTO scheme_institution_details (scheme_summer_school_id, name, address) 
                                    VALUES (:scheme_summer_school_id, :name, :address )";
                        foreach ($institution_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_summer_school_id' => $get_last_record_id,
                                        ':name' => $value['name'],
                                        ':address' => $value['address'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                } else if ($form_no == 1) {
                    $query="UPDATE scheme_summer_school 
                            SET broad_area_of_workshop=:broad_area_of_workshop, scheme_title=:scheme_title, target_audience=:target_audience, starting_date=:starting_date, ending_date=:ending_date, no_of_working_days=:no_of_working_days, no_of_participants=:no_of_participants,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':broad_area_of_workshop' => $broad_area_of_workshop,
                            ':scheme_title' => $scheme_title,
                            ':target_audience' => $target_audience,
                            ':starting_date' => $starting_date,
                            ':ending_date' => $ending_date,
                            ':no_of_working_days' => $no_of_working_days,
                            ':no_of_participants' => $no_of_participants,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 2) {
                    $result = true;
                    if ($resource_person_details) {
                        if (fetchRows("SELECT * FROM scheme_ss_people_details WHERE type = 'resource_person' AND scheme_summer_school_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_ss_people_details WHERE type = 'resource_person' AND scheme_summer_school_id = $get_last_record_id");
                        }
                        $query2="INSERT INTO scheme_ss_people_details (scheme_summer_school_id, type, name, designation, official_address ) 
                                        VALUES (:scheme_summer_school_id, :type, :name, :designation, :official_address )";
                        foreach ($resource_person_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_summer_school_id' => $get_last_record_id,
                                        ':type' => $value['type'],
                                        ':name' => $value['name'],
                                        ':designation' => $value['designation'],
                                        ':official_address' => $value['official_address'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                } else if ($form_no == 3) {
                    $query="UPDATE scheme_summer_school SET form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(':form_no' => $form_no );
                    $result = insertRow($query, $data);
                    
                    if ($session_wise_topic_details) {
                        if (fetchRows("SELECT * FROM scheme_ss_syllabus_details WHERE scheme_summer_school_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_ss_syllabus_details WHERE scheme_summer_school_id = $get_last_record_id");
                        }
                        $query2="INSERT INTO scheme_ss_syllabus_details (scheme_summer_school_id, day, topic) 
                                    VALUES (:scheme_summer_school_id, :day, :topic)";
                        foreach ($session_wise_topic_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_summer_school_id' => $get_last_record_id,
                                        ':day' => $value['day'],
                                        ':topic' => $value['topic'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                } else if ($form_no == 4) {
                    $query="UPDATE scheme_summer_school 
                            SET item_cost_consumables=:item_cost_consumables, item_cost_honorarium_no_of_lecture_sessions=:item_cost_honorarium_no_of_lecture_sessions, item_cost_honorarium_no_of_practical_sessions=:item_cost_honorarium_no_of_practical_sessions, item_cost_honorarium_no_of_assistants=:item_cost_honorarium_no_of_assistants, item_cost_honorarium_no_of_days=:item_cost_honorarium_no_of_days, item_cost_honorarium=:item_cost_honorarium,
                                item_cost_working_lunch_rate_per_day=:item_cost_working_lunch_rate_per_day, item_cost_working_lunch_no_of_assistants=:item_cost_working_lunch_no_of_assistants, item_cost_working_lunch_no_of_days=:item_cost_working_lunch_no_of_days, item_cost_working=:item_cost_working, 
                                item_cost_contingency=:item_cost_contingency, item_cost_overhead=:item_cost_overhead, item_cost_total=:item_cost_total,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':item_cost_consumables' => $item_cost_consumables,
                            ':item_cost_honorarium_no_of_lecture_sessions' => $item_cost_honorarium_no_of_lecture_sessions,
                            ':item_cost_honorarium_no_of_practical_sessions' => $item_cost_honorarium_no_of_practical_sessions,
                            ':item_cost_honorarium_no_of_assistants' => $item_cost_honorarium_no_of_assistants,
                            ':item_cost_honorarium_no_of_days' => $item_cost_honorarium_no_of_days,
                            ':item_cost_honorarium' => $item_cost_honorarium,
                            ':item_cost_working_lunch_rate_per_day' => $item_cost_working_lunch_rate_per_day,
                            ':item_cost_working_lunch_no_of_assistants' => $item_cost_working_lunch_no_of_assistants,
                            ':item_cost_working_lunch_no_of_days' => $item_cost_working_lunch_no_of_days,
                            ':item_cost_working' => $item_cost_working,
                            ':item_cost_contingency' => $item_cost_contingency,
                            ':item_cost_overhead' => $item_cost_overhead,
                            ':item_cost_total' => $item_cost_total,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 5) {
                    $query="UPDATE scheme_summer_school SET expected_outcome=:expected_outcome,form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(
                        ':expected_outcome' => $expected_outcome,
                        ':form_no' => $form_no,
                    );
                    $result = insertRow($query, $data);
                } else if ($form_no == 6) {
                    $query="UPDATE scheme_summer_school 
                            SET file_aadhar_card=:file_aadhar_card, file_declaration_certificate=:file_declaration_certificate, file_principal_registrar_certificate=:file_principal_registrar_certificate,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':file_aadhar_card' => $file_aadhar_card,
                        ':file_declaration_certificate' => $file_declaration_certificate,
                        ':file_principal_registrar_certificate' => $file_principal_registrar_certificate,
                        ':form_no' => $form_no,
                    );
                    $result = insertRow($query, $data);
                }
            } else {
                // create
                $query="INSERT INTO scheme_summer_school (user_id,application_no,scheme_batch_id,form_no) 
                        VALUES (:user_id,:application_no,:scheme_batch_id,:form_no)";
                $data = array(
                            ':user_id' => $user_id,
                            ':application_no' => $application_no,
                            ':scheme_batch_id' => $scheme_batch_id,
                            ':form_no' => $form_no,
                    );
                $result = insertRow($query, $data);
                if($result)
                {
                    // get last id and fill the related table
                    $query = "SELECT id FROM scheme_summer_school ORDER BY id DESC LIMIT 1";
                    $get_last_record_data = fetchRows($query, false);
                    $get_last_record_id = (int)$get_last_record_data["id"];

                    if ($coordinator_details) {
                        $query2="INSERT INTO scheme_ss_people_details (scheme_summer_school_id, type, first_name, middle_name, last_name, country_code, phone_no, email, designation, official_address ) 
                                        VALUES (:scheme_summer_school_id, :type, :first_name, :middle_name, :last_name, :country_code, :phone_no, :email, :designation, :official_address )";
                        foreach ($coordinator_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_summer_school_id' => $get_last_record_id,
                                        ':type' => $value['type'],
                                        ':first_name' => $value['first_name'],
                                        ':middle_name' => $value['middle_name'],
                                        ':last_name' => $value['last_name'],
                                        ':country_code' => $value['country_code'],
                                        ':phone_no' => $value['phone_no'],
                                        ':email' => $value['email'],
                                        ':designation' => $value['designation'],
                                        ':official_address' => $value['official_address'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                    if ($institution_details) {
                        $query2="INSERT INTO scheme_institution_details (scheme_summer_school_id, name, address) 
                                    VALUES (:scheme_summer_school_id, :name, :address )";
                        foreach ($institution_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_summer_school_id' => $get_last_record_id,
                                        ':name' => $value['name'],
                                        ':address' => $value['address'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                    echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Record is been Created!', 'data'=>['scheme_id' => $get_last_record_id] ]); exit;
                } else {
                    echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to register. Please, try again !']); exit;
                }
            }
        }

        if ($form_type=='save-form') {
            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Record is been Saved!', 'data'=>'' ]); exit;
            // echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Record is been Saved!', 'data'=>['scheme_id' => $get_last_record_id] ]); exit;
            // if ($result) {
            // } else {
            //     echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to update. Please, try again !']); exit;
            // }
        } else {
            $query="UPDATE scheme_summer_school SET form_status=:form_status WHERE id=$get_last_record_id";
            $data = array(':form_status' => 1);
            $result = insertRow($query, $data);
            // user details ---------------------
                $query = "SELECT first_name,last_name,email FROM users WHERE id='".$user_id."' ";
                $data = fetchRows($query, false); 
                if($data) {
                    $first_name = $data['first_name'];
                    $last_name = $data['last_name'];
                    $email = $data['email'];
                }
            // acknowledgement Mail
                $query = "SELECT subject, content FROM emails where status=1 AND type=17 ORDER BY id DESC LIMIT 1";
                $get_email_data = fetchRows($query, false);

                $logoAlt = 'GSRF';
                $logoUrl = '';
                $name = $first_name.' '.$last_name;
                $scheme_name = "GSRF Summer School Scheme";
                $placeholders = array('$name', '$scheme_name');
                $values = array($name, $scheme_name);

                $subject = $get_email_data['subject']; //"Thank you for Applying";
                $content = $email_template_head_before_title;
                $content .= "<title>".$subject."</title>";
                $content .= $email_template_head_after_title;
                $content .= str_replace($placeholders, $values, $get_email_data['content']);
                $content .= $email_template_footer;
            // send response
                $response = smtp_mailer($email, $subject, $content);
                if ($response) {
                    $resMessage = 'Thank you for submitting the form!';
                } else {
                    $resMessage = 'Something went wrong, could not send email!';
                }
            // save log
                $query_log="INSERT INTO communication_log (log_type, sender_id, sent_by, application_no, title, receiver, sent_from, sent_to, subject, message) 
                            VALUES (:log_type, :sender_id, :sent_by, :application_no, :title, :receiver, :sent_from, :sent_to, :subject, :message)";
                $log_data = [
                    ':log_type' => 'Confirmation',
                    ':sender_id' => 0,
                    ':sent_by' => 'GSRF',
                    ':application_no' => '',
                    ':title' => 'GSRF Summer School Scheme, application submitted by '.$name,
                    ':receiver' => 'Candidate',
                    ':sent_from' => $resMessage, // need to save response -------------------------------- 
                    ':sent_to' => $email,
                    ':subject' => $subject,
                    ':message' => contentFromHtmlBody($content),
                ];
                insertRow($query_log, $log_data);

            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>$resMessage]); exit;
            return true;
        }
    }

    if ($_SERVER['REQUEST_METHOD']=='DELETE') {
        // http://localhost/gsrf/api/schemeSummerSchoolApi.php?id=0&token=cLeAn4SSSQrU5Y7In2ksd
        $id = $_GET['id'];
        $token = $_GET['token'];
        $result = true;

        if ($token=="cLeAn4SSSQrU5Y7In2ksd") {
            $data = fetchRows("SELECT id, 
                                    file_application_form,
                                    file_declaration_certificate, 
                                    file_principal_registrar_certificate
                                FROM scheme_summer_school WHERE id = $id", false);
            if ($data) {
                if ($data['file_application_form']) {
                    if (unlink($base_path.$data['file_application_form'])) { } else { $result = false; }
                }
                if ($data['file_declaration_certificate']) {
                    if (unlink($base_path.$data['file_declaration_certificate'])) { } else { $result = false; }
                }
                if ($data['file_principal_registrar_certificate']) {
                    if (unlink($base_path.$data['file_principal_registrar_certificate'])) { } else { $result = false; }
                }
                if ($result) {
                    deleteRow("DELETE FROM scheme_summer_school WHERE id=$id");
                    deleteRow("DELETE FROM scheme_ss_people_details WHERE scheme_summer_school_id=$id");
                    deleteRow("DELETE FROM scheme_institution_details WHERE scheme_summer_school_id=$id");
                    deleteRow("DELETE FROM scheme_ss_syllabus_details WHERE scheme_summer_school_id=$id");
                    
                    echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Success!', 'data'=> $data]);   
                    exit;
                } else {
                    echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Error in deleting files!', 'data'=> $data]);
                    exit;
                }
            } else {
                echo json_encode(['flag'=>false, 'status'=>'401', 'message'=>'No data found.']);
                exit;
            }
        } else if ($token=="tRash4SSSQrU5Y7In2ksd") {
            # code...
        } else {
            echo json_encode(['flag'=>false, 'status'=>'501', 'message'=>'Invalid Token !']); exit;
        }
    }

?>
