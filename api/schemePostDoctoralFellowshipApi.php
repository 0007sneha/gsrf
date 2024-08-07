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
            $data = fetchRows("SELECT * FROM scheme_post_doctoral_fellowship WHERE status = 1 AND user_id = $id AND scheme_batch_id = $schemeBatchId ORDER BY id DESC ", false);
            if ($data) {
                $getId = $data['id'];
                $data['guide_details'] = fetchRows("SELECT * FROM scheme_fellowship_guide_details
                                            WHERE post_doctoral_fellowship_id = $getId
                                        ");
                                        
                $data['list_of_publications_details'] = fetchRows("SELECT * FROM scheme_important_publications_details
                                            WHERE scheme_post_doctoral_fellowship_id = $getId
                                        ");
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found, Invalid user ID!']); exit;
            }
        }
        if (isset($type) && $type=="preview") {
            // also called for to show saved data before submitting res in apply_for_scheme page
            if($data){
                echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$data]);
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found', 'data'=>'']);
            }
        } else if (isset($type) && $type=="download-pdf") {
            $data = fetchRows("SELECT id, user_id, application_no, file_application_form, status 
                                FROM scheme_post_doctoral_fellowship 
                                WHERE status = 1 AND user_id = $id AND scheme_batch_id = $schemeBatchId 
                                ORDER BY id DESC ", false);
            if ($data) {
                echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$data]);
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to download file', 'data'=>'']);
            }
        } else if (isset($type) && $type=="generate-pdf") {
            $filename = $data["application_no"].'-'.$data["first_name"].' '.$data["last_name"];
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
                    $query = "UPDATE scheme_post_doctoral_fellowship SET file_application_form=:file_application_form 
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

            $countryCode_data = findObjectById($countryCodeArr, $data['country_code']);
            $categories_data = findObjectById($categoriesArr, $data['category']);
            $dateDob = date_create($data['dob']);
            $dateOfBirth = date_format($dateDob,"d-m-Y");
            
            if ($data['is_domicile_certificate']==1) {
                $is_domicile_certificate = 'Yes';
            } else {
                $is_domicile_certificate = 'No';
            }
            if ($data['is_published_any_papers']==1) {
                $is_published_any_papers = 'Yes';
            } else {
                $is_published_any_papers = 'No';
            }

            // profile picture
            if ($data["file_profile_picture"]) {
                $filePath = $hostUrl.$data["file_profile_picture"];
                if (filter_var($filePath, FILTER_VALIDATE_URL)) {
                    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                    $fileData = file_get_contents($filePath);
                    $fileUrlBase64 = 'data:image/' . $fileType . ';base64,' . base64_encode($fileData);
                    $fileAlt = "Profile Picture";
                } else {
                    $fileAlt = "Invalid Picture"; 
                    $fileUrlBase64 = "";
                }
            } else {
                $fileAlt .= 'No profile picture available';
            }

            // create PDF
                $html = $pdf_head_start;
                $html .= '<title>GSRF-Post-Doctoral Fellowship </title>';
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
                                        Application for Post-Doctoral Fellowship Scheme
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
                                    <h3>Personal Information</h3>
                                    <table>
                                        <tbody>
                                            <tr><td>Name </td><td>'.$data["first_name"].' '.$data["middle_name"].' '.$data["last_name"].' </td></tr>
                                            <tr><td>Date of Birth</td><td>'.$dateOfBirth.' </td></tr>
                                            <tr><td>Residential Address </td><td>'.nl2br(htmlspecialchars($data["res_address"])).' </td></tr>
                                            <tr><td>Mobile No. </td><td>'.$countryCode_data["name"].' </span>&nbsp;<span>'.$data["phone_no"].' </td></tr>
                                            <tr><td>Email ID</td><td>'.$data["email"].' </td></tr>
                                            <tr><td>Gender</td><td>'.$data["gender"].' </td></tr>
                                            <tr><td>Category</td><td>'.$categories_data["name"].' </td></tr>';
                                                if ($data['category']!=0 || $data['category']!=2) {
                                                    $html .= '<tr><td colspan="2">Attach Category Certificate</td></tr>';
                                                }
                                    $html .= '  <tr><td>Do you have Domicile certificate ? </td><td>'.$is_domicile_certificate.' </td></tr>';
                                                if ($is_domicile_certificate=='Yes') {
                                                    $html .= '  <tr><td colspan="2">Attach Domicile certificate(15 years)</td></tr>';
                                                }
                                    $html .= '  <tr><td>User Picture</td>
                                                <td>
                                                    <div class="image_container">';
                                                        if ($fileUrlBase64) {
                                                            $html .= '<img src="'.$fileUrlBase64.'" alt="'.$fileAlt.'" />';
                                                        } else {
                                                            $html .= $fileAlt;
                                                        }
                                $html .= '
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </body>';
                $html .= $pdf_html_end;

                $html2 = $pdf_head_start;
                $html2 .= '<title>GSRF-Doctoral Fellowship</title>';
                $html2 .= $pdf_style;
                $html2 .= $pdf_head_end;
                $html2 .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <div class="mb-5">
                                    <h3>Qualification Details</h3>
                                    <label>Educational Qualifications</label>
                                    <table class="border mt-3">
                                        <thead>
                                            <th class="th-width" style="width: 60px !important;">Degree</th>
                                            <th class="th-width" style="width: 150px !important;">Board/ University</th>
                                            <th class="th-width">School/ College</th>
                                            <th class="th-width" style="width: 80px !important;">Year of Passing</th>
                                            <th class="th-width" style="width: 80px !important;">Percentage</th>
                                            ';
                                            // <th class="th-width" style="width: 80px !important;">CGPA</th>
                                    $html2 .= '
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>SSC</th>
                                                <th>'.$data["board_name_1"].'</th>
                                                <td>'.$data["college_name_1"].'</td>
                                                <th>'.$data["year_of_passing_1"].'</th>
                                                <th>'.$data["marks_1"].'</th>
                                            ';
                                                // <th>'.$data["cgpa_1"].'</th>
                                    $html2 .= '
                                            </tr>
                                            <tr>
                                                <th>HSSC</th>
                                                <th>'.$data["board_name_2"].'</th>
                                                <td>'.$data["college_name_2"].'</td>
                                                <th>'.$data["year_of_passing_2"].'</th>
                                                <th>'.$data["marks_2"].'</th>
                                            ';
                                                // <th>'.$data["cgpa_2"].'</th>
                                    $html2 .= '
                                            </tr>
                                            <tr>
                                                <th>UG</th>
                                                <th>'.$data["board_name_3"].'</th>
                                                <td>'.$data["college_name_3"].'</td>
                                                <th>'.$data["year_of_passing_3"].'</th>
                                                <th>'.$data["marks_3"].'</th>
                                            ';
                                                // <th>'.$data["cgpa_3"].'</th>
                                    $html2 .= '
                                            </tr>
                                            <tr>
                                                <th>PG</th>
                                                <th>'.$data["board_name_4"].'</th>
                                                <td>'.$data["college_name_4"].'</td>
                                                <th>'.$data["year_of_passing_4"].'</th>
                                                <th>'.$data["marks_4"].'</th>
                                            ';
                                                // <th>'.$data["cgpa_4"].'</th>
                                    $html2 .= '
                                            </tr>
                                            <tr>
                                                <th>Ph.D</th>
                                                <th>'.$data["board_name_5"].'</th>
                                                <td>'.$data["college_name_5"].'</td>
                                                <th>'.$data["year_of_passing_5"].'</th>
                                                <th>'.$data["marks_5"].'</th>
                                            ';
                                                // <th>'.$data["cgpa_5"].'</th>
                                    $html2 .= '
                                            </tr>';

                                            if ($data["college_name_6"]) {
                                                $html2 .= '<tr>
                                                    <th>ANY OTHER</th>
                                                    <th>'.$data["board_name_6"].'</th>
                                                    <td>'.$data["college_name_6"].'</td>
                                                    <th>'.$data["year_of_passing_6"].'</th>
                                                    <th>'.$data["marks_6"].'</th>
                                            ';
                                                    // <th>'.$data["cgpa_6"].'</th>
                                    $html2 .= '
                                                </tr>';
                                            }
                                $html2 .= '</tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h3>Ph.D Details</h3>
                                    <table>
                                        <tbody>
                                            <tr><td>Title of the Ph.D. thesis </td><td>'.nl2br(htmlspecialchars($data["phd_thesis"])).'</td></tr>
                                            <tr><td>Ph.D. Research Guide Name </td><td>'.nl2br(htmlspecialchars($data['phd_research_guide_name'])).' </td></tr>
                                            <tr><td>Ph.D. Research Guide Designation </td><td>'.nl2br(htmlspecialchars($data['phd_research_guide_designation'])).' </td></tr>
                                            <tr><td>University from which Ph.D. degree is obtained </td><td>'.nl2br(htmlspecialchars($data["phd_degree_obtained_university"])).' </td></tr>
                                            <tr><td>Institution in which you worked for your Ph.D </td><td>'.nl2br(htmlspecialchars($data["phd_work_carried_out"])).' </td></tr>
                                            <tr><td>The University / Institution in which you propose to carry out your Post-Doctoral work </td><td>'.nl2br(htmlspecialchars($data["phd_work_proposed_institution"])).' </td></tr>
                                            <tr><td>PhD degree/award communication</td><td>(Attach a scanned PDF copy)</td> </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </body>';
                $html2 .= $pdf_html_end;

                $html3 = $pdf_head_start;
                $html3 .= '<title>GSRF-Doctoral Fellowship</title>';
                $html3 .= $pdf_style;
                $html3 .= $pdf_head_end;
                $html3 .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <div class="mb-5">
                                    <h3>Mentor Details</h3>
                                    <table class="border">
                                        <thead>
                                            <th class="th-width">Name of the Mentor</th>
                                            <th class="th-width" style="width: 140px !important;">Designation</th>
                                            <th class="th-width">Address</th>
                                        </thead>
                                        <tbody>';
                                            if ($data['guide_details']) {
                                                foreach ($data['guide_details'] as $key => $value) 
                                                {
                                                    $html3 .= '<tr>
                                                        <td>'.$value["guide_name"].'</td>
                                                        <td>'.$value["guide_designation"].'</td>
                                                        <td>'.nl2br(htmlspecialchars($value["guide_address"])).'</td>
                                                    </tr>';
                                                }
                                            }
                                $html3 .= '</tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h3>Work Details</h3>
                                    <table>
                                        <tbody>
                                            <tr><td class="fw-5">Title of the proposed work </td></tr>
                                            ';$html3.=getHtmlContentFromString($data["proposed_work"]); $html3.='
                                            <tr><td class="fw-5">Broad discipline</td></tr>
                                            ';$html3.=getHtmlContentFromString($data["broad_discipline"]); $html3.='
                                            <tr><td class="fw-5">Background of the work</td></tr>
                                            ';$html3.=getHtmlContentFromString($data["work_background"]); $html3.='
                                            <tr><td class="fw-5">The hypothesis proposed / Gaps identified in existing knowledge </td></tr>
                                            ';$html3.=getHtmlContentFromString($data["hypothesis_proposed"]); $html3.='
                                            <tr><td class="fw-5">Objectives</td></tr>
                                            ';$html3.=getHtmlContentFromString($data["objectives"]); $html3.='
                                            <tr><td class="fw-5">Materials and Methods Proposed</td></tr>
                                            ';$html3.=getHtmlContentFromString($data["mat_and_methods_proposed"]); $html3.='
                                            <tr><td class="fw-5">Expected outcome</td></tr>
                                            ';$html3.=getHtmlContentFromString($data["expected_outcome"]); $html3.='
                                            <tr><td class="fw-5">References</td></tr>
                                            ';$html3.=getHtmlContentFromString($data["imp_references"]); $html3.='
                                            <tr><td class="fw-5">Importance of proposed work </td></tr>
                                            ';$html3.=getHtmlContentFromString($data["imp_of_proposed_work"]); $html3.='
                                            <tr><td class="fw-5">Expertise of the Mentor in the proposed area </td></tr>
                                            ';$html3.=getHtmlContentFromString($data["expertise_of_mentor"]); $html3.='
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="mb-5">
                                    <label>List of your publications</label>
                                    <p>All relevant ones</p>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width">Publications</th>
                                        </thead>
                                        <tbody>';
                                            if ($data['list_of_publications_details']) {
                                                foreach ($data['list_of_publications_details'] as $key => $value) 
                                                {
                                                    $html3 .= '<tr>
                                                        <td>'.++$key.'</td>
                                                        <td>'.$value["name"].'</td>
                                                    </tr>';
                                                }
                                            }
                                $html3 .= '</tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h3>Proposed Work Details</h3>
                                    <table class="mb-5">
                                        <tbody>
                                            <tr><td>Have you published any papers in the proposed area of research? </td>
                                                <td>'.$is_published_any_papers.' </td>
                                            </tr>';
                                            if ($is_published_any_papers=='Yes') {
                                                $html3 .= '<tr><td colspan="2">Papers published in the proposed area of research</td></tr>';
                                            }
                                $html3 .= ' <tr><td colspan="2">Timeline (Quarterly) of the proposed study <br> Provide scanned copy of either Bar diagram/GANTT chart</td></tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </body>';
                $html3 .= $pdf_html_end;

                $html4 = $pdf_head_start;
                $html4 .= '<title>GSRF-Doctoral Fellowship</title>';
                $html4 .= $pdf_style;
                $html4 .= $pdf_head_end;
                $html4 .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <div class="mb-5">
                                    <h3>Certificates Uploaded</h3>
                                    <table>
                                        <tbody>
                                            <tr><td colspan="2">Certificate from the mentor that he approves the research proposal</td></tr>
                                            <tr><td colspan="2">Declaration by the candidate</td></tr>
                                            <tr><td colspan="2">Aadhar Card</td></tr>
                                            <tr><td colspan="2">Endorsement from the Head of the institute</td></tr>
                                            <tr><td colspan="2">CV of the candidate</td></tr>
                                            <tr><td colspan="2">CV of the mentor</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </body>';
                $html4 .= $pdf_html_end;

            // Create a PDF using Dompdf
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isPhpEnabled', true); // Enable PHP in the HTML (optional)
                $options->set('isRemoteEnabled', true); // Ensure remote images are enabled
                // $options->set('defaultFont', 'Inter');
                $options->set('defaultFont', 'NotoSansDevanagari'); 

                // Create a new instance of Dompdf
                $dompdf = new Dompdf();
                // Load your HTML content into Dompdf
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait'); 
                $dompdf->setOptions($options); 
                // Render the PDF (choose to save it to a file, display it, or return it as a string)
                $dompdf->render();
                // Generate a unique filename for the PDF
                $temp_pdf_filename = date('YmdHis') .'-temp-'. $filename .'.pdf';
                // Define the path where you want to save the PDF
                $temp_pdf_file_location = 'uploads/' . $temp_pdf_filename;
                $temp_app_file_path = $base_path.$temp_pdf_file_location;
                // Save the PDF on the server
                file_put_contents($temp_app_file_path, $dompdf->output());

                // Create a new instance of Dompdf
                $dompdf2 = new Dompdf();
                // Load your HTML content into Dompdf
                $dompdf2->loadHtml($html2);
                $dompdf2->setPaper('A4', 'portrait'); 
                $dompdf2->setOptions($options); 
                // Render the PDF (choose to save it to a file, display it, or return it as a string)
                $dompdf2->render();
                // Generate a unique filename for the PDF
                $temp_pdf_filename2 = date('YmdHis') .'-temp2-'. $filename .'.pdf';
                // Define the path where you want to save the PDF
                $temp_pdf_file_location2 = 'uploads/' . $temp_pdf_filename2;
                $temp_app_file_path2 = $base_path.$temp_pdf_file_location2;
                // Save the PDF on the server
                file_put_contents($temp_app_file_path2, $dompdf2->output());
                
                // Create a new instance of Dompdf
                $dompdf3 = new Dompdf();
                // Load your HTML content into Dompdf
                $dompdf3->loadHtml($html3);
                $dompdf3->setPaper('A4', 'portrait'); 
                $dompdf3->setOptions($options); 
                // Render the PDF (choose to save it to a file, display it, or return it as a string)
                $dompdf3->render();
                // Generate a unique filename for the PDF
                $temp_pdf_filename3 = date('YmdHis') .'-temp3-'. $filename .'.pdf';
                // Define the path where you want to save the PDF
                $temp_pdf_file_location3 = 'uploads/' . $temp_pdf_filename3;
                $temp_app_file_path3 = $base_path.$temp_pdf_file_location3;
                // Save the PDF on the server
                file_put_contents($temp_app_file_path3, $dompdf3->output());
                
                // Create a new instance of Dompdf
                $dompdf4 = new Dompdf();
                // Load your HTML content into Dompdf
                $dompdf4->loadHtml($html4);
                $dompdf4->setPaper('A4', 'portrait'); 
                $dompdf4->setOptions($options); 
                // Render the PDF (choose to save it to a file, display it, or return it as a string)
                $dompdf4->render();
                // Generate a unique filename for the PDF
                $temp_pdf_filename4 = date('YmdHis') .'-temp4-'. $filename .'.pdf';
                // Define the path where you want to save the PDF
                $temp_pdf_file_location4 = 'uploads/' . $temp_pdf_filename4;
                $temp_app_file_path4 = $base_path.$temp_pdf_file_location4;
                // Save the PDF on the server
                file_put_contents($temp_app_file_path4, $dompdf4->output());
            // Provide a link to download the generated PDF
            // echo "PDF generated and saved as <a href='$host$temp_pdf_file_location' download='$temp_pdf_filename'>$temp_pdf_filename</a>"; exit;
            // Output the PDF to the browser
            // $dompdf->stream(''.$filename.'.pdf', array("Attachment" => 1)); exit;
            
            // merge all the files to attach 
                $file_to_merge = [
                    $temp_app_file_path,
                ];  
                if ($data['category']==0 || $data['category']==2) { } else {
                    array_push($file_to_merge, $base_path.$data['file_category_certificate']);
                }
                if ($is_domicile_certificate=='Yes') {
                    array_push($file_to_merge, $base_path.$data['file_domicile_certificate']);
                }
                array_push($file_to_merge, $temp_app_file_path2);
                array_push($file_to_merge, $base_path.$data['file_phd_degree']);
                array_push($file_to_merge, $temp_app_file_path3);
                if ($is_published_any_papers=='Yes') {
                    array_push($file_to_merge, $base_path.$data['file_published_papers']);
                }
                array_push($file_to_merge, $base_path.$data['file_proposed_study_timeline']);
                array_push($file_to_merge, $temp_app_file_path4);
                array_push($file_to_merge, $base_path.$data['file_res_guide_certificate']);
                array_push($file_to_merge, $base_path.$data['file_declaration_certificate']);
                array_push($file_to_merge, $base_path.$data['file_aadhar_card']);
                array_push($file_to_merge, $base_path.$data['file_institute_head_certificate']);
                array_push($file_to_merge, $base_path.$data['file_candidate_cv']);
                array_push($file_to_merge, $base_path.$data['file_mentor_cv']);
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
                    // Loop through each PDF file and import its pages
                    foreach ($file_to_merge as $file) {
                        $pageCount = $pdf->setSourceFile($file);
                        for ($i = 1; $i <= $pageCount; $i++) {
                            // Add a new page for each imported page
                            $pdf->AddPage('P', 'A4'); // Set the A4 page size 'P' for portrait orientation, 'A4' for A4 size
                            $template = $pdf->importPage($i);
                            $templateSize = $pdf->getTemplateSize($template);
                            // Use the imported page in the new PDF
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
                        $query = "UPDATE scheme_post_doctoral_fellowship SET file_application_form=:file_application_form WHERE user_id='".$id."' ";
                        $data_update = array(
                                ':file_application_form' => $pdf_file_location,
                            );
                        $result = insertRow($query, $data_update);
                    }

                    if ($result) {
                        if ($temp_pdf_filename) {
                            if (unlink($temp_app_file_path)) {
                                // echo "File Deleted.";
                            }
                        }
                        if ($temp_pdf_filename2) {
                            if (unlink($temp_app_file_path2)) {
                                // echo "File Deleted.";
                            }
                        }
                        if ($temp_pdf_filename3) {
                            if (unlink($temp_app_file_path3)) {
                                // echo "File Deleted.";
                            }
                        }
                        if ($temp_pdf_filename4) {
                            if (unlink($temp_app_file_path4)) {
                                // echo "File Deleted.";
                            }
                        }
                        echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'PDF Generated Successfully!', 'data'=>['file_application_form'=>$pdf_file_location] ]); exit;
                        // echo "<br><a href='$host$pdf_file_location' download='$pdf_file_location'>$pdf_filename</a>";
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
        $application_no = applicationNo("scheme_post_doctoral_fellowship");
        $form_type = $postData['form_type'] ?? '';
        $form_no = $postData['form_no'] ?? '';
        $scheme_id = $postData['scheme_id'] ?? '';
        $get_last_record_id = (int)$scheme_id;
        
        if (isset($postData["formSubmissionType"]) && $postData["formSubmissionType"] == 'direct') {
            $file_application_form = $postData['file_application_form'] ?? '';
            
            $query="INSERT INTO scheme_post_doctoral_fellowship (user_id,application_no,scheme_batch_id,file_application_form,form_status)
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
            $first_name = $postData['first_name'] ?? '';
                $middle_name = $postData['middle_name'] ?? '';
                $last_name = $postData['last_name'] ?? '';
                $dob = $postData['dob'] ?? '';
                $res_address = $postData['res_address'] ?? '';
                $country_code = $postData['country_code'] ?? '';
                $phone_no = $postData['phone_no'] ?? '';
                $email = $postData['email'] ?? '';
                $gender = $postData['gender'] ?? '';
                $file_profile_picture = $postData['file_profile_picture'] ?? '';
                $is_domicile_certificate = $postData['is_domicile_certificate'] ?? '';
                $file_domicile_certificate = $postData['file_domicile_certificate'] ?? '';
                $category = $postData['category'] ?? '';
                $file_category_certificate = $postData['file_category_certificate'] ?? '';
                
                $course_1 = $postData['course_1'] ?? '';
                $board_name_1 = $postData['board_name_1'] ?? '';
                $college_name_1 = $postData['college_name_1'] ?? '';
                $year_of_passing_1 = $postData['year_of_passing_1'] ?? '';
                $marks_1 = $postData['marks_1'] ?? '';
                $cgpa_1 = $postData['cgpa_1'] ?? '';
                $course_2 = $postData['course_2'] ?? '';
                $board_name_2 = $postData['board_name_2'] ?? '';
                $college_name_2 = $postData['college_name_2'] ?? '';
                $year_of_passing_2 = $postData['year_of_passing_2'] ?? '';
                $marks_2 = $postData['marks_2'] ?? '';
                $cgpa_2 = $postData['cgpa_2'] ?? '';
                $course_3 = $postData['course_3'] ?? '';
                $board_name_3 = $postData['board_name_3'] ?? '';
                $college_name_3 = $postData['college_name_3'] ?? '';
                $year_of_passing_3 = $postData['year_of_passing_3'] ?? '';
                $marks_3 = $postData['marks_3'] ?? '';
                $cgpa_3 = $postData['cgpa_3'] ?? '';
                $course_4 = $postData['course_4'] ?? '';
                $board_name_4 = $postData['board_name_4'] ?? '';
                $college_name_4 = $postData['college_name_4'] ?? '';
                $year_of_passing_4 = $postData['year_of_passing_4'] ?? '';
                $marks_4 = $postData['marks_4'] ?? '';
                $cgpa_4 = $postData['cgpa_4'] ?? '';
                $course_5 = $postData['course_5'] ?? '';
                $board_name_5 = $postData['board_name_5'] ?? '';
                $college_name_5 = $postData['college_name_5'] ?? '';
                $year_of_passing_5 = $postData['year_of_passing_5'] ?? '';
                $marks_5 = $postData['marks_5'] ?? '';
                $cgpa_5 = $postData['cgpa_5'] ?? '';
                $course_6 = $postData['course_6'] ?? '';
                $board_name_6 = $postData['board_name_6'] ?? '';
                $college_name_6 = $postData['college_name_6'] ?? '';
                $year_of_passing_6 = $postData['year_of_passing_6'] ?? '';
                $marks_6 = $postData['marks_6'] ?? '';
                $cgpa_6 = $postData['cgpa_6'] ?? '';

                $phd_work_proposed_institution = $postData['phd_work_proposed_institution'] ?? '';
                $phd_work_carried_out = $postData['phd_work_carried_out'] ?? '';
                $phd_degree_obtained_university = $postData['phd_degree_obtained_university'] ?? '';
                $phd_research_guide_designation = $postData['phd_research_guide_designation'] ?? '';
                $phd_research_guide_name = $postData['phd_research_guide_name'] ?? '';
                $file_phd_degree = $postData['file_phd_degree'] ?? '';
                $phd_thesis = $postData['phd_thesis'] ?? '';

                $guide_details = $postData['guide_details'] ?? [];

                $proposed_work = $postData['proposed_work'] ?? '';
                $broad_discipline = $postData['broad_discipline'] ?? '';
                $work_background = $postData['work_background'] ?? '';
                $hypothesis_proposed = $postData['hypothesis_proposed'] ?? '';
                $objectives = $postData['objectives'] ?? '';
                $mat_and_methods_proposed = $postData['mat_and_methods_proposed'] ?? '';
                $expected_outcome = $postData['expected_outcome'] ?? '';
                $imp_references = $postData['imp_references'] ?? '';
                $imp_of_proposed_work = $postData['imp_of_proposed_work'] ?? '';
                $expertise_of_mentor = $postData['expertise_of_mentor'] ?? '';
                $list_of_publications_details = $postData['list_of_publications_details'] ?? [];
                
                $is_published_any_papers = $postData['is_published_any_papers'] ?? '';
                $file_published_papers = $postData['file_published_papers'] ?? '';
                $file_proposed_study_timeline = $postData['file_proposed_study_timeline'] ?? '';
                
                $file_declaration_certificate = $postData['file_declaration_certificate'] ?? '';
                $file_aadhar_card = $postData['file_aadhar_card'] ?? '';
                $file_res_guide_certificate = $postData['file_res_guide_certificate'] ?? '';
                $file_institute_head_certificate = $postData['file_institute_head_certificate'] ?? '';
                $file_candidate_cv = $postData['file_candidate_cv'] ?? '';
            $file_mentor_cv = $postData['file_mentor_cv'] ?? '';
            
            if ($get_last_record_id) {
                // update
                if ($form_no == 0) {
                    $query="UPDATE scheme_post_doctoral_fellowship SET first_name=:first_name,middle_name=:middle_name,last_name=:last_name,dob=:dob,res_address=:res_address,country_code=:country_code,phone_no=:phone_no,email=:email,
                                    gender=:gender,file_profile_picture=:file_profile_picture,is_domicile_certificate=:is_domicile_certificate,file_domicile_certificate=:file_domicile_certificate,category=:category,file_category_certificate=:file_category_certificate,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':first_name' => $first_name,
                            ':middle_name' => $middle_name,
                            ':last_name' => $last_name,
                            ':dob' => $dob,
                            ':res_address' => $res_address,
                            ':country_code' => $country_code,
                            ':phone_no' => $phone_no,
                            ':email' => $email,
                            ':gender' => $gender,
                            ':file_profile_picture' => $file_profile_picture,
                            ':is_domicile_certificate' => $is_domicile_certificate,
                            ':file_domicile_certificate' => $file_domicile_certificate,
                            ':category' => $category,
                            ':file_category_certificate' => $file_category_certificate,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 1) {
                    $query="UPDATE scheme_post_doctoral_fellowship 
                            SET course_1=:course_1,board_name_1=:board_name_1,college_name_1=:college_name_1,year_of_passing_1=:year_of_passing_1,marks_1=:marks_1,
                                course_2=:course_2,board_name_2=:board_name_2,college_name_2=:college_name_2,year_of_passing_2=:year_of_passing_2,marks_2=:marks_2,
                                course_3=:course_3,board_name_3=:board_name_3,college_name_3=:college_name_3,year_of_passing_3=:year_of_passing_3,marks_3=:marks_3,
                                course_4=:course_4,board_name_4=:board_name_4,college_name_4=:college_name_4,year_of_passing_4=:year_of_passing_4,marks_4=:marks_4,
                                course_5=:course_5,board_name_5=:board_name_5,college_name_5=:college_name_5,year_of_passing_5=:year_of_passing_5,marks_5=:marks_5,
                                course_6=:course_6,board_name_6=:board_name_6,college_name_6=:college_name_6,year_of_passing_6=:year_of_passing_6,marks_6=:marks_6,
                                form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':course_1' => $course_1,
                            ':board_name_1' => $board_name_1,
                            ':college_name_1' => $college_name_1,
                            ':year_of_passing_1' => $year_of_passing_1,
                            ':marks_1' => $marks_1,
                            ':course_2' => $course_2,
                            ':board_name_2' => $board_name_2,
                            ':college_name_2' => $college_name_2,
                            ':year_of_passing_2' => $year_of_passing_2,
                            ':marks_2' => $marks_2,
                            ':course_3' => $course_3,
                            ':board_name_3' => $board_name_3,
                            ':college_name_3' => $college_name_3,
                            ':year_of_passing_3' => $year_of_passing_3,
                            ':marks_3' => $marks_3,
                            ':course_4' => $course_4,
                            ':board_name_4' => $board_name_4,
                            ':college_name_4' => $college_name_4,
                            ':year_of_passing_4' => $year_of_passing_4,
                            ':marks_4' => $marks_4,
                            ':course_5' => $course_5,
                            ':board_name_5' => $board_name_5,
                            ':college_name_5' => $college_name_5,
                            ':year_of_passing_5' => $year_of_passing_5,
                            ':marks_5' => $marks_5,
                            ':course_6' => $course_6,
                            ':board_name_6' => $board_name_6,
                            ':college_name_6' => $college_name_6,
                            ':year_of_passing_6' => $year_of_passing_6,
                            ':marks_6' => $marks_6,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 2) {
                    $query="UPDATE scheme_post_doctoral_fellowship 
                            SET phd_work_proposed_institution=:phd_work_proposed_institution,phd_work_carried_out=:phd_work_carried_out,phd_degree_obtained_university=:phd_degree_obtained_university,phd_research_guide_designation=:phd_research_guide_designation,phd_research_guide_name=:phd_research_guide_name,file_phd_degree=:file_phd_degree,phd_thesis=:phd_thesis,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':phd_work_proposed_institution' => $phd_work_proposed_institution,
                        ':phd_work_carried_out' => $phd_work_carried_out,
                        ':phd_degree_obtained_university' => $phd_degree_obtained_university,
                        ':phd_research_guide_designation' => $phd_research_guide_designation,
                        ':phd_research_guide_name' => $phd_research_guide_name,
                        ':file_phd_degree' => $file_phd_degree,
                        ':phd_thesis' => $phd_thesis,
                        ':form_no' => $form_no,
                    );
                    $result = insertRow($query, $data);
                } else if ($form_no == 3) {
                    $query="UPDATE scheme_doctoral_fellowship SET form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(':form_no' => $form_no);
                    $result = insertRow($query, $data);

                    if ($guide_details) {
                        if (fetchRows("SELECT * FROM scheme_fellowship_guide_details WHERE post_doctoral_fellowship_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_fellowship_guide_details WHERE post_doctoral_fellowship_id = $get_last_record_id");
                        }
                        $query2="INSERT INTO scheme_fellowship_guide_details (post_doctoral_fellowship_id, guide_name, guide_designation, guide_address) 
                                    VALUES (:post_doctoral_fellowship_id, :guide_name, :guide_designation, :guide_address)";
                        foreach ($guide_details as $key => $value) {
                            $data2 = array(
                                        ':post_doctoral_fellowship_id' => $get_last_record_id,
                                        ':guide_name' => $value['guide_name'],
                                        ':guide_designation' => $value['guide_designation'],
                                        ':guide_address' => $value['guide_address'],
                                    );
                            $result2 = insertRow($query2, $data2);
                        }
                    }
                } else if ($form_no == 4) {
                    $query="UPDATE scheme_post_doctoral_fellowship 
                            SET proposed_work=:proposed_work,broad_discipline=:broad_discipline,work_background=:work_background,hypothesis_proposed=:hypothesis_proposed,objectives=:objectives,mat_and_methods_proposed=:mat_and_methods_proposed,expected_outcome=:expected_outcome,imp_references=:imp_references,imp_of_proposed_work=:imp_of_proposed_work,expertise_of_mentor=:expertise_of_mentor,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':proposed_work' => $proposed_work,
                            ':broad_discipline' => $broad_discipline,
                            ':work_background' => $work_background,
                            ':hypothesis_proposed' => $hypothesis_proposed,
                            ':objectives' => $objectives,
                            ':mat_and_methods_proposed' => $mat_and_methods_proposed,
                            ':expected_outcome' => $expected_outcome,
                            ':imp_references' => $imp_references,
                            ':imp_of_proposed_work' => $imp_of_proposed_work,
                            ':expertise_of_mentor' => $expertise_of_mentor,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                    if ($result) {
                         // get table if exist -- delete rows if exist -- create new
                        if (fetchRows("SELECT * FROM scheme_important_publications_details WHERE scheme_post_doctoral_fellowship_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_important_publications_details WHERE scheme_post_doctoral_fellowship_id = $get_last_record_id");
                        }
                        if ($list_of_publications_details) {
                            $query2="INSERT INTO scheme_important_publications_details (scheme_post_doctoral_fellowship_id, name) 
                                        VALUES (:scheme_post_doctoral_fellowship_id, :name)";
                            foreach ($list_of_publications_details as $key => $value) {
                                $data2 = array(
                                            ':scheme_post_doctoral_fellowship_id' => $get_last_record_id,
                                            ':name' => $value['name'],
                                        );
                                insertRow($query2, $data2);
                            }
                        }
                    }
                } else if ($form_no == 5) {
                    $query="UPDATE scheme_post_doctoral_fellowship 
                            SET is_published_any_papers=:is_published_any_papers,file_published_papers=:file_published_papers,file_proposed_study_timeline=:file_proposed_study_timeline,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':is_published_any_papers' => $is_published_any_papers,
                            ':file_published_papers' => $file_published_papers,
                            ':file_proposed_study_timeline' => $file_proposed_study_timeline,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 6) {
                    $query="UPDATE scheme_post_doctoral_fellowship 
                            SET file_declaration_certificate=:file_declaration_certificate,file_aadhar_card=:file_aadhar_card,file_res_guide_certificate=:file_res_guide_certificate,file_institute_head_certificate=:file_institute_head_certificate,file_candidate_cv=:file_candidate_cv,file_mentor_cv=:file_mentor_cv,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array( 
                            ':file_declaration_certificate' => $file_declaration_certificate,
                            ':file_aadhar_card' => $file_aadhar_card,
                            ':file_res_guide_certificate' => $file_res_guide_certificate,
                            ':file_institute_head_certificate' => $file_institute_head_certificate,
                            ':file_candidate_cv' => $file_candidate_cv,
                            ':file_mentor_cv' => $file_mentor_cv,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                }
            } else {
                // create
                $query="INSERT INTO scheme_post_doctoral_fellowship (user_id,application_no,scheme_batch_id,first_name,middle_name,last_name,dob,res_address,country_code,phone_no,email,
                            gender,file_profile_picture,is_domicile_certificate,file_domicile_certificate,category,file_category_certificate,form_no)
                        VALUES (:user_id,:application_no,:scheme_batch_id,:first_name,:middle_name,:last_name,:dob,:res_address,:country_code,:phone_no,:email,
                            :gender,:file_profile_picture,:is_domicile_certificate,:file_domicile_certificate,:category,:file_category_certificate,:form_no)";
                $data = array(
                            ':user_id' => $user_id,
                            ':application_no' => $application_no,
                            ':scheme_batch_id' => $scheme_batch_id,
                            ':first_name' => $first_name,
                            ':middle_name' => $middle_name,
                            ':last_name' => $last_name,
                            ':dob' => $dob,
                            ':res_address' => $res_address,
                            ':country_code' => $country_code,
                            ':phone_no' => $phone_no,
                            ':email' => $email,
                            ':gender' => $gender,
                            ':file_profile_picture' => $file_profile_picture,
                            ':is_domicile_certificate' => $is_domicile_certificate,
                            ':file_domicile_certificate' => $file_domicile_certificate,
                            ':category' => $category,
                            ':file_category_certificate' => $file_category_certificate,
                            ':form_no' => $form_no,
                        );
                $result = insertRow($query, $data);
                if($result)
                {
                    // get last id and fill the related table
                    $query = "SELECT id FROM scheme_post_doctoral_fellowship ORDER BY id DESC LIMIT 1";
                    $get_last_record_data = fetchRows($query, false);
                    $get_last_record_id = (int)$get_last_record_data["id"];

                    echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Record is been Created!', 'data'=>['scheme_id' => $get_last_record_id] ]); exit;
                } else {
                    echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to register. Please, try again !']); exit;
                }
            }
        }

        if ($form_type=='save-form') {
            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Record has been Updated!', 'data'=>'' ]); exit;
            // echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Record is been Saved!', 'data'=>['scheme_id' => $get_last_record_id] ]); exit;
            // if ($result) {
            // } else {
            //     echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to update. Please, try again !']); exit;
            // }
        } else {
            $query="UPDATE scheme_post_doctoral_fellowship SET form_status=:form_status WHERE id=$get_last_record_id";
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
                $scheme_name = "GSRF Post-Doctoral Fellowship Scheme";
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
                    ':title' => 'GSRF Post-Doctoral Fellowship Scheme, application submitted by '.$name,
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


?>