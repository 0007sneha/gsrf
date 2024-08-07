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
            $data = fetchRows("SELECT * FROM scheme_research_startup_grant WHERE status = 1 AND user_id = $id AND scheme_batch_id = $schemeBatchId ORDER BY id DESC ", false);
            if ($data) {
                $getId = $data['id'];
                $data['project_details'] = fetchRows("SELECT * FROM scheme_project_details
                                            WHERE scheme_research_startup_grant_id = $getId
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
                                FROM scheme_research_startup_grant 
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
                    $query = "UPDATE scheme_research_startup_grant SET file_application_form=:file_application_form 
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
            
            $dateDob = date_create($data['dob']);
            $dateOfBirth = date_format($dateDob,"d-m-Y");
            $categories_data = findObjectById($categoriesArr, $data['category']);
            $dateJoin = date_create($data['joining_date']);
            $dateJoining = date_format($dateJoin,"d-m-Y");
            if ($data['is_differently_abled']==1) {
                $is_differently_abled = 'Yes';
            } else {
                $is_differently_abled = 'No';
            }
            if ($data['is_running_any_project']==1) {
                $is_running_any_project = 'Yes';
            } else {
                $is_running_any_project = 'No';
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
            $dateYearObtainingDegree = date_create($data["year_of_obtaining_degree"]);
            $dateYearObtainingDegree = date_format($dateYearObtainingDegree,"d-m-Y");

            // create PDF
                $html = $pdf_head_start;
                $html .= '<title>GSRF-Research Startup Grants </title>';
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
                                        Application for Research Start-Up Grant
                                    </h3>
                                </div>
                                <div class="mb-5">
                                    <h4>Application Details</h4>
                                    <table>
                                        <tbody>
                                            <tr><td>Application Number </td><td class="fs-12">'.$data["application_no"].' </td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-5">
                                    <h4>Personal Information</h4>
                                    <table>
                                        <tbody>
                                            <tr><td>Name </td><td>'.$data["first_name"].' '.$data["middle_name"].' '.$data["last_name"].' </td></tr>
                                            <tr><td>Date of Birth</td><td>'.$dateOfBirth.' </td></tr>
                                            <tr><td>Category</td><td>'.$categories_data["name"].' </td></tr>';
                                            if ($data['category']!=0 || $data['category']!=2) {
                                                $html .= '<tr><td colspan="2">Attach Category Certificate</td></tr>';
                                            }
                                $html .= '  <tr><td>Are you differently abled? </td><td>'.$is_differently_abled.' </td></tr>';
                                            if ($is_differently_abled=='Yes') {
                                                $html .= '<tr><td colspan="2">Attach a scanned certificate of Differently Abled</td></tr>';
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
                $html2 .= '<title>GSRF-Research Startup Grants </title>';
                $html2 .= $pdf_style;
                $html2 .= $pdf_head_end;
                $html2 .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <div class="mb-5">
                                    <h4>Employment Details</h4>
                                    <table>
                                        <tbody>
                                            <tr><td>Designation</td><td>'.$data["designation"].' </td></tr>
                                            <tr><td>Official Address(institution)</td><td>'.nl2br(htmlspecialchars($data["official_address"])).' </td></tr>
                                            <tr><td>Date of joining the present position </td><td>'.$dateJoining.' </td></tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h4>Ph.D Details</h4>
                                    <table>
                                        <tbody>
                                            <tr><td>Title of Ph.D. thesis</td><td>'.nl2br(htmlspecialchars($data["thesis_title"])).'</td></tr>
                                            <tr><td>University from where Ph.D./M.D/M.S/M.D.S/M.V.Sc.is obtained </td><td>'.nl2br(htmlspecialchars($data["university_name"])).' </td></tr>
                                            <tr><td>Year of obtaining Ph.D. degree </td><td>'.$dateYearObtainingDegree.' </td></tr>
                                            <tr><td>Broad Discipline  </td><td>'.nl2br(htmlspecialchars($data["broad_discipline"])).' </td></tr>
                                            <tr><td>Specialisation </td><td>'.nl2br(htmlspecialchars($data["specialisation"])).' </td></tr>
                                        ';
                                            // <tr><td>Title of the thesis/dissertation (Ph.D. /M.D/M.S/M.D.S/M.V.Sc) </td><td>'.nl2br(htmlspecialchars($data["dissertation_thesis_title"])).' </td></tr>
                                $html2 .= '
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="mb-5">
                                    <h4>Institution details where the seed grant will be utilized</h4>
                                    <table>
                                        <tbody>
                                            <tr><td>Institution Name </td><td>'.$data["institution_name"].'</td></tr>
                                            <tr><td>Institution Address </td><td>'.nl2br(htmlspecialchars($data["institution_address"])).' </td></tr>
                                            <tr><td>Are you running any project(s) right now? </td><td>'.$is_running_any_project.' </td></tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-5">';
                                    if ($data['is_running_any_project']==1) {
                                        $html2 .= '
                                            <h4>Project Details</h4>
                                            <table class="border">
                                                <thead>
                                                    <th class="th-width" style="width: 20px !important;">S.No</th>
                                                    <th class="th-width" style="width: 140px !important;">Title</th>
                                                    <th class="th-width" style="width: 90px !important;">Amount</th>
                                                    <th class="th-width" style="width: 70px !important;">Start Date</th>
                                                    <th class="th-width" style="width: 70px !important;">End Date</th>
                                                    <th class="th-width">Agency</th>
                                                </thead>
                                                <tbody>';
                                                    if ($data['project_details'] && $data['project_details']!=NULL) {
                                                        foreach ($data['project_details'] as $key => $value) 
                                                        {
                                                            $html2 .= '<tr>
                                                                <td>'.++$key.'</td>
                                                                <td>'.$value["title"].'</td>
                                                                <td>'.$value["cost_in_lakhs"].'</td>
                                                                <td>'.$value["start_date"].'</td>
                                                                <td>'.$value["end_date"].'</td>
                                                                <td>'.$value["agency"].'</td>
                                                            </tr>';
                                                        }
                                                    }
                                        $html2 .= '</tbody>
                                            </table>';
                                        }
                                    $html2 .= '
                                </div>

                                <div class="mb-5">
                                    <h4>Proposed Work Details</h4>
                                    <table>
                                        <tbody>
                                            <tr><td class="fw-5">
                                                Write up of your proposed work
                                                <p>Writeup shall contain Title, statement of the problem, objectives, materials and methods and expected outcome, in brief</p>
                                            </td></tr>
                                            ';$html2.=getHtmlContentFromString($data["proposed_work"]);$html2.='
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </body>';
                $html2 .= $pdf_html_end;
                
                $html3 = $pdf_head_start;
                $html3 .= '<title>GSRF-Research Startup Grants </title>';
                $html3 .= $pdf_style;
                $html3 .= $pdf_head_end;
                $html3 .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <div class="mb-5">
                                    <h4>Certificates Uploaded</h4>
                                    <table>
                                        <tbody>
                                            <tr><td>Aadhar Card</td><td></td></tr>
                                            <tr><td colspan="2">Declaration by the candidate</td></tr>
                                            <tr><td colspan="2">Endorsement from the Head of the institute</td></tr>
                                            <tr><td colspan="2">Curriculum vitae</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </body>';
                $html3 .= $pdf_html_end;
            // echo $html; exit;

            // Create a PDF using Dompdf
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isPhpEnabled', true); // Enable PHP in the HTML (optional)
                $options->set('isRemoteEnabled', true); // Ensure remote images are enabled
                // $options->set('defaultFont', 'Inter');
                $options->set('defaultFont', 'NotoSansDevanagari'); 
            
                // Create an instance of Dompdf
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
                if ($is_differently_abled=='Yes') {
                    array_push($file_to_merge, $base_path.$data['file_differently_abled_certificate']);
                }
                array_push($file_to_merge, $temp_app_file_path2);
                array_push($file_to_merge, $base_path.$data['file_published_papers']);

                array_push($file_to_merge, $temp_app_file_path3);
                array_push($file_to_merge, $base_path.$data['file_aadhar_card']);
                array_push($file_to_merge, $base_path.$data['file_declaration_certificate']);
                array_push($file_to_merge, $base_path.$data['file_institute_head_certificate']);
                array_push($file_to_merge, $base_path.$data['file_curriculum_vitae_certificate']);
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
                        $query = "UPDATE scheme_research_startup_grant SET file_application_form=:file_application_form WHERE user_id='".$id."' ";
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
        $application_no = applicationNo("scheme_research_startup_grant");
        $form_type = $postData['form_type'] ?? '';
        $form_no = $postData['form_no'] ?? '';
        $scheme_id = $postData['scheme_id'] ?? '';
        $get_last_record_id = (int)$scheme_id;

        if (isset($postData["formSubmissionType"]) && $postData["formSubmissionType"] == 'direct') {
            $file_application_form = $postData['file_application_form'] ?? '';
            
            $query="INSERT INTO scheme_research_startup_grant (user_id,application_no,scheme_batch_id,file_application_form,form_status)
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
                $category = $postData['category'] ?? '';
                $file_category_certificate = $postData['file_category_certificate'] ?? '';
                $is_differently_abled = $postData['is_differently_abled'] ?? '';
                $file_differently_abled_certificate = $postData['file_differently_abled_certificate'] ?? '';
                $file_profile_picture = $postData['file_profile_picture'] ?? '';
                
                $designation = $postData['designation'] ?? '';
                $official_address = $postData['official_address'] ?? '';
                $joining_date = $postData['joining_date'] ?? '';
                
                $thesis_title = $postData['thesis_title'] ?? '';
                $university_name = $postData['university_name'] ?? '';
                $year_of_obtaining_degree = $postData['year_of_obtaining_degree'] ?? '';
                $broad_discipline = $postData['broad_discipline'] ?? '';
                $specialisation = $postData['specialisation'] ?? '';
                $dissertation_thesis_title = $postData['dissertation_thesis_title'] ?? '';
                
                $institution_name = $postData['institution_name'] ?? '';
                $institution_address = $postData['institution_address'] ?? '';
                $is_running_any_project = $postData['is_running_any_project'] ?? '';
                $project_details = $postData['project_details'] ?? [];
                
                $proposed_work = $postData['proposed_work'] ?? '';
                $file_published_papers = $postData['file_published_papers'] ?? '';
                
                $file_aadhar_card = $postData['file_aadhar_card'] ?? '';
                $file_declaration_certificate = $postData['file_declaration_certificate'] ?? '';
                $file_institute_head_certificate = $postData['file_institute_head_certificate'] ?? '';
            $file_curriculum_vitae_certificate = $postData['file_curriculum_vitae_certificate'] ?? '';

            if ($get_last_record_id) {
                // update
                if ($form_no == 0) {
                    $query="UPDATE scheme_research_startup_grant 
                            SET first_name=:first_name,middle_name=:middle_name,last_name=:last_name,dob=:dob,category=:category,file_category_certificate=:file_category_certificate,
                                is_differently_abled=:is_differently_abled,file_differently_abled_certificate=:file_differently_abled_certificate,file_profile_picture=:file_profile_picture,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':first_name' => $first_name,
                            ':middle_name' => $middle_name,
                            ':last_name' => $last_name,
                            ':dob' => $dob,
                            ':category' => $category,
                            ':file_category_certificate' => $file_category_certificate,
                            ':is_differently_abled' => $is_differently_abled,
                            ':file_differently_abled_certificate' => $file_differently_abled_certificate,
                            ':file_profile_picture' => $file_profile_picture,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 1) {
                    $query="UPDATE scheme_research_startup_grant 
                            SET designation=:designation,official_address=:official_address,joining_date=:joining_date,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':designation' => $designation,
                            ':official_address' => $official_address,
                            ':joining_date' => $joining_date,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 2) {
                    $query="UPDATE scheme_research_startup_grant 
                            SET thesis_title=:thesis_title,university_name=:university_name,year_of_obtaining_degree=:year_of_obtaining_degree,
                                broad_discipline=:broad_discipline,specialisation=:specialisation,dissertation_thesis_title=:dissertation_thesis_title,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':thesis_title' => $thesis_title,
                            ':university_name' => $university_name,
                            ':year_of_obtaining_degree' => $year_of_obtaining_degree,
                            ':broad_discipline' => $broad_discipline,
                            ':specialisation' => $specialisation,
                            ':dissertation_thesis_title' => $dissertation_thesis_title,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 3) {
                    $query="UPDATE scheme_research_startup_grant 
                            SET institution_name=:institution_name,institution_address=:institution_address,is_running_any_project=:is_running_any_project,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':institution_name' => $institution_name,
                            ':institution_address' => $institution_address,
                            ':is_running_any_project' => $is_running_any_project,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                    if($result) {
                        if ($project_details) {
                            if (fetchRows("SELECT * FROM scheme_project_details WHERE scheme_research_startup_grant_id = $get_last_record_id")) {
                                deleteRow("DELETE FROM scheme_project_details WHERE scheme_research_startup_grant_id = $get_last_record_id");
                            }
                            $query_project="INSERT INTO scheme_project_details (scheme_research_startup_grant_id, project_status, type, title, cost_in_lakhs, start_date, end_date, agency) 
                                        VALUES (:scheme_research_startup_grant_id, :project_status, :type, :title, :cost_in_lakhs, :start_date, :end_date, :agency)";
                            foreach ($project_details as $key => $value) {
                                $data2 = array(
                                            ':scheme_research_startup_grant_id' => $get_last_record_id,
                                            ':project_status' => $value['project_status'],
                                            ':type' => $value['type'],
                                            ':title' => $value['title'],
                                            ':cost_in_lakhs' => $value['cost_in_lakhs'],
                                            ':start_date' => $value['start_date'],
                                            ':end_date' => $value['end_date'],
                                            ':agency' => $value['agency']
                                        );
                                $result2 = insertRow($query_project, $data2);
                            }
                        }
                    }
                } else if ($form_no == 4) {
                    $query="UPDATE scheme_research_startup_grant SET proposed_work=:proposed_work,file_published_papers=:file_published_papers,form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(
                            ':proposed_work' => $proposed_work,
                            ':file_published_papers' => $file_published_papers,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                } else if ($form_no == 5) {
                    $query="UPDATE scheme_research_startup_grant 
                            SET file_aadhar_card=:file_aadhar_card,file_declaration_certificate=:file_declaration_certificate,file_institute_head_certificate=:file_institute_head_certificate,file_curriculum_vitae_certificate=:file_curriculum_vitae_certificate,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                            ':file_aadhar_card' => $file_aadhar_card,
                            ':file_declaration_certificate' => $file_declaration_certificate,
                            ':file_institute_head_certificate' => $file_institute_head_certificate,
                            ':file_curriculum_vitae_certificate' => $file_curriculum_vitae_certificate,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                }
            } else {
                // create
                $query="INSERT INTO scheme_research_startup_grant (user_id,application_no,scheme_batch_id,first_name,middle_name,last_name,dob,category,
                                    file_category_certificate,is_differently_abled,file_differently_abled_certificate,file_profile_picture,form_no)
                        VALUES (:user_id,:application_no,:scheme_batch_id,:first_name,:middle_name,:last_name,:dob,:category,
                                :file_category_certificate,:is_differently_abled,:file_differently_abled_certificate,:file_profile_picture,:form_no)";
                $data = array(
                        ':user_id' => $user_id,
                        ':application_no' => $application_no,
                        ':scheme_batch_id' => $scheme_batch_id,
                        ':first_name' => $first_name,
                        ':middle_name' => $middle_name,
                        ':last_name' => $last_name,
                        ':dob' => $dob,
                        ':category' => $category,
                        ':file_category_certificate' => $file_category_certificate,
                        ':is_differently_abled' => $is_differently_abled,
                        ':file_differently_abled_certificate' => $file_differently_abled_certificate,
                        ':file_profile_picture' => $file_profile_picture,
                        ':form_no' => $form_no,
                    );
                $result = insertRow($query, $data);
                if($result)
                {
                    // get last id and fill the related table
                    $query = "SELECT id FROM scheme_research_startup_grant ORDER BY id DESC LIMIT 1";
                    $get_last_record_data = fetchRows($query, false);
                    $get_last_record_id = (int)$get_last_record_data["id"];

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
            $query="UPDATE scheme_research_startup_grant SET form_status=:form_status WHERE id=$get_last_record_id";
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
                $scheme_name = "GSRF Research Start-Up Grant Scheme";
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
                    ':title' => 'GSRF Research Start-Up Grant Scheme, application submitted by '.$name,
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