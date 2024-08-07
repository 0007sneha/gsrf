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

    set_time_limit(0);
    ini_set('memory_limit', '1024M');

    $base_path = '../';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id']; // user_id   
        $type = $_GET['type'];
        $schemeBatchId = $_GET['schemeBatchId'];
        $dev = $_GET['dev'] ?? 'null';

        if (isset($type) && $type!="download-pdf") {
            $data = fetchRows("SELECT * FROM scheme_major_project_grant WHERE status = 1 AND user_id = $id AND scheme_batch_id = $schemeBatchId ORDER BY id DESC ", false);
            if ($data) {
                $getId = $data['id'];
                $data['investigator_details'] = fetchRows("SELECT * FROM scheme_fellowship_investigator_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                                        
                $data['institution_details'] = fetchRows("SELECT * FROM scheme_institution_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                                        
                $data['investigator_role_details'] = fetchRows("SELECT * FROM scheme_investigators_role_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                                        
                $data['investigator_publications_details'] = fetchRows("SELECT * FROM scheme_important_publications_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                                        
                $data['bibliography_details'] = fetchRows("SELECT * FROM scheme_important_reference_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                                        
                $data['scheme_submitted_project_details'] = fetchRows("SELECT * FROM scheme_project_details
                                            WHERE scheme_major_project_grant_id = $getId
                                            AND project_status='submitted'
                                        ");
                                        
                $data['scheme_ongoing_project_details'] = fetchRows("SELECT * FROM scheme_project_details
                                            WHERE scheme_major_project_grant_id = $getId
                                            AND project_status='ongoing'
                                        ");
                                        
                $data['scheme_completed_project_details'] = fetchRows("SELECT * FROM scheme_project_details
                                            WHERE scheme_major_project_grant_id = $getId
                                            AND project_status='completed'
                                        ");
                                        
                $data['infrastructural_facility_details'] = fetchRows("SELECT * FROM scheme_infrastructural_facility_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                                        
                $data['equipment_details'] = fetchRows("SELECT * FROM scheme_equipment_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                $data['budget_components_details'] = fetchRows("SELECT * FROM scheme_budget_components_details
                                            WHERE scheme_major_project_grant_id = $getId
                                        ");
                                        
                $data['outcome_interested_expert_details'] = fetchRows("SELECT * FROM scheme_project_outcome_interested_expert_details
                                        WHERE scheme_major_project_grant_id = $getId
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
            $data = fetchRows("SELECT id, user_id, application_no, file_application_form, status 
                                FROM scheme_major_project_grant 
                                WHERE status = 1 AND user_id = $id AND scheme_batch_id = $schemeBatchId 
                                ORDER BY id DESC ", false);
            if ($data) {
                echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$data]);
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to download file', 'data'=>'']);
            }
        } else if (isset($type) && $type=="generate-pdf") {
            $investigatorDetails = $data['investigator_details'];
            $filename = $data["application_no"].'-'.$investigatorDetails[0]["first_name"].' '.$investigatorDetails[0]["last_name"];
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
                    $query = "UPDATE scheme_major_project_grant SET file_application_form=:file_application_form 
                                WHERE user_id = '".$id."' AND scheme_batch_id = '".$schemeBatchId."' 
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

            $countryCode_data0=$countryCode_data1=$countryCode_data2 = '';
            if ($investigatorDetails[0]['phone_no']) {
                $countryCode_data0 = findObjectById($countryCodeArr, $investigatorDetails[0]['country_code'])["name"];
            }
            if ($investigatorDetails[1]['phone_no']) {
                $countryCode_data1 = findObjectById($countryCodeArr, $investigatorDetails[1]['country_code'])["name"];
            }
            if ($investigatorDetails[2]['phone_no']) {
                $countryCode_data2 = findObjectById($countryCodeArr, $investigatorDetails[2]['country_code'])["name"];
            }
            $dateOfBirth0 = date_format(date_create($investigatorDetails[0]['dob']),"d-m-Y");
            $dateOfBirth1 = $investigatorDetails[1]['dob']=='0000-00-00' || $investigatorDetails[1]['dob']=='' || $investigatorDetails[1]['dob']==' ' ? "" : date_format(date_create($investigatorDetails[1]['dob']),"d-m-Y");
            $dateOfBirth2 = $investigatorDetails[2]['dob']=='0000-00-00' || $investigatorDetails[2]['dob']=='' || $investigatorDetails[2]['dob']==' ' ? "" : date_format(date_create($investigatorDetails[2]['dob']),"d-m-Y");

            $gender0 = $investigatorDetails[0]["first_name"] ? $investigatorDetails[0]["gender"] : '';
            $gender1 = $investigatorDetails[1]["first_name"] ? $investigatorDetails[1]["gender"] : '';
            $gender2 = $investigatorDetails[2]["first_name"] ? $investigatorDetails[2]["gender"] : '';

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
                $html .= '<title>GSRF-Major Research Project </title>';
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
                                        Application for Major Research Project
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
                                    <h3>Principal Investigator Details</h3>
                                    <table>
                                        <tbody>
                                            <tr><td>Name </td><td>'.$investigatorDetails[0]["first_name"].' '.$investigatorDetails[0]["middle_name"].' '.$investigatorDetails[0]["last_name"].' </td></tr>
                                            <tr><td>Gender</td><td>'.$gender0.' </td></tr>
                                            <tr><td>Date of Birth</td><td>'.$dateOfBirth0.' </td></tr>
                                            <tr><td>Mobile No. </td><td>'.$countryCode_data0.' </span>&nbsp;<span>'.$investigatorDetails[0]["phone_no"].' </td></tr>
                                            <tr><td>Email ID</td><td>'.$investigatorDetails[0]["email"].' </td></tr>
                                            <tr><td>Designation</td><td>'.$investigatorDetails[0]["designation"].' </td></tr>
                                            <tr><td>Qualification (Highest)</td><td>'.$investigatorDetails[0]["qualification"].' </td></tr>
                                            <tr><td>Official Address</td><td>'.$investigatorDetails[0]["official_address"].' </td></tr>
                                            <tr><td>Department</td><td>'.$investigatorDetails[0]["department"].' </td></tr>
                                            <tr><td>Specialisation(If any) </td><td>'.nl2br(htmlspecialchars($investigatorDetails[0]["specialisation"])).' </td></tr>
                                            <tr><td>User Picture
                                                    <p>Please upload a 3.5cm x 4.5cm passport-size photo.</p>
                                                </td>
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
                                    </table>';
                                    if ($investigatorDetails[1]) {
                                        $html .= '<h3>Co-Investigator I Details</h3>
                                                <table>
                                                    <tbody>
                                                        <tr><td>Name </td><td>'.$investigatorDetails[1]["first_name"].' '.$investigatorDetails[1]["middle_name"].' '.$investigatorDetails[1]["last_name"].' </td></tr>
                                                        <tr><td>Gender</td><td>'.$gender1.' </td></tr>
                                                        <tr><td>Date of Birth</td><td>'.$dateOfBirth1.' </td></tr>
                                                        <tr><td>Mobile No. </td><td>'.$countryCode_data1.' </span>&nbsp;<span>'.$investigatorDetails[1]["phone_no"].' </td></tr>
                                                        <tr><td>Email ID</td><td>'.$investigatorDetails[1]["email"].' </td></tr>
                                                        <tr><td>Designation</td><td>'.$investigatorDetails[1]["designation"].' </td></tr>
                                                        <tr><td>Qualification (Highest)</td><td>'.$investigatorDetails[1]["qualification"].' </td></tr>
                                                        <tr><td>Official Address</td><td>'.$investigatorDetails[1]["official_address"].' </td></tr>
                                                        <tr><td>Department</td><td>'.$investigatorDetails[1]["department"].' </td></tr>
                                                        <tr><td>Specialisation(If any) </td><td>'.nl2br(htmlspecialchars($investigatorDetails[1]["specialisation"])).' </td></tr>
                                                    </tbody>
                                                </table>';
                                    }
                                    if ($investigatorDetails[2]) {
                                        $html .= '<h3 class="pt-2">Co-Investigator II Details</h3>
                                                <table>
                                                    <tbody>
                                                        <tr><td>Name </td><td>'.$investigatorDetails[2]["first_name"].' '.$investigatorDetails[2]["middle_name"].' '.$investigatorDetails[2]["last_name"].' </td></tr>
                                                        <tr><td>Gender</td><td>'.$gender2.' </td></tr>
                                                        <tr><td>Date of Birth</td><td>'.$dateOfBirth2.' </td></tr>
                                                        <tr><td>Mobile No. </td><td>'.$countryCode_data2.' </span>&nbsp;<span>'.$investigatorDetails[2]["phone_no"].' </td></tr>
                                                        <tr><td>Email ID</td><td>'.$investigatorDetails[2]["email"].' </td></tr>
                                                        <tr><td>Designation</td><td>'.$investigatorDetails[2]["designation"].' </td></tr>
                                                        <tr><td>Qualification (Highest)</td><td>'.$investigatorDetails[2]["qualification"].' </td></tr>
                                                        <tr><td>Official Address</td><td>'.$investigatorDetails[2]["official_address"].' </td></tr>
                                                        <tr><td>Department</td><td>'.$investigatorDetails[2]["department"].' </td></tr>
                                                        <tr><td>Specialisation(If any) </td><td>'.nl2br(htmlspecialchars($investigatorDetails[2]["specialisation"])).' </td></tr>
                                                    </tbody>
                                                </table>';
                                    }

                                    $html .= '<h3 class="mt-5">Institution Details</h3>
                                    <label>Name and complete address of the Institution where the project will be carried out</label>
                                    <table class="border">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width">Name of the Institute</th>
                                            <th class="th-width" style="min-width: 140px !important;">Institute Address</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['institution_details'] as $key => $value) 
                                            {
                                                $html .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["name"].'</td>
                                                    <td>'.nl2br(htmlspecialchars($value["address"])).'</td>
                                                </tr>';
                                            }
                                $html .= '</tbody>
                                    </table>
                                    
                                    <h3 class="mt-5">The amount proposed for the project</h3>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Proposed Amount : </td>
                                                <td>Rs.'.$data['proposed_amount'] .' </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="page-break"></div>
                                
                                <div class="mb-5">
                                    <h3>Basic details of the proposal </h3>
                                    <table>
                                        <tbody>
                                            <tr><td class="fw-5">Title of the proposal</td></tr>
                                            <tr><td class="pb-2">'.nl2br(htmlspecialchars($data["proposal_title"])).' </td></tr>
                                            <tr><td class="fw-5">Broad discipline</td></tr>
                                            <tr><td class="pb-2">'.nl2br(htmlspecialchars($data["broad_discipline"])).' </td></tr>
                                            <tr><td class="fw-5">Summary of the research proposal </td></tr>
                                            ';$html.=getHtmlContentFromString($data["proposal_summary"]);$html.='
                                            <tr><td class="fw-5">Objectives</td></tr>
                                            ';$html.=getHtmlContentFromString($data["objectives"]); $html.='
                                            <tr><td class="fw-5">Expected outcome</td></tr>
                                            ';$html.=getHtmlContentFromString($data["expected_outcome"]); $html.='
                                            <tr><td class="fw-5">Background Information</td></tr>
                                            ';$html.=getHtmlContentFromString($data["proposal_background"]); $html.='
                                        </tbody>
                                    </table>
                                </div>

                                <div class="page-break"></div>

                                <div class="mb-5">
                                    <h3>Review of literature in the proposed area </h3>
                                    <table>
                                        <tbody>
                                            <tr><td class="fw-5">International Status</td></tr>
                                            ';$html.=getHtmlContentFromString($data["international_status"]); $html.='
                                            <tr><td class="fw-5">National Status</td></tr>
                                            ';$html.=getHtmlContentFromString($data["national_status"]); $html.='
                                            <tr><td class="fw-5">Local status (if it is a locally relevant proposal)</td></tr>
                                            ';$html.=getHtmlContentFromString($data["local_status"]); $html.='
                                            <tr><td class="fw-5">Significance of the proposal, The gaps to be filled/ problem to be solved / or hypothesis proposed</td></tr>
                                            ';$html.=getHtmlContentFromString($data["proposal_significance"]); $html.='
                                            <tr><td class="fw-5">Objectives, To be given as bullet points/enumerated; objectives must be achievable in the given time frame</td></tr>
                                            ';$html.=getHtmlContentFromString($data["proposal_objectives"]); $html.='
                                            <tr><td class="fw-5">Is the project location specific? If yes, please highlight the reasons for choosing the location/site</td></tr>
                                            ';$html.=getHtmlContentFromString($data["project_location"]); $html.='
                                        </tbody>
                                    </table>
                                </div>

                                <div class="page-break"></div>

                                <h3>Work Plan</h3>
                                <table>
                                    <tbody>
                                        <tr><td class="fw-5">Methodology in detail</td></tr>
                                        <tr><td class="fw-5">
                                            It should explain the general methodology; for each objective, clearly define the methods, if more than one method is available, give reasons for choosing a particular method.
                                            If the work is focussing on a location, the locational details are also to be given
                                        </td></tr>
                                        ';$html.=getHtmlContentFromString($data["methodology"]); 
                                        if ($data["file_methodology"]) {
                                            $html.='<tr> <td class="fw-5">If there is any additional methodology information involving images can be uploaded here as a single pdf file.<br></td></tr>';
                                        } else {
                                            $html.='<tr>
                                                <td class="fw-5">
                                                    Provide a Time Schedule of activities<br>
                                                    <span> Give a bar diagram or GANTT chart on Quarterly basis </span>
                                                </td>
                                            </tr>';
                                        }
                            $html.='</tbody>
                                </table>
                            </div>
                        </div>
                    </body>';
                $html .= $pdf_html_end;

                $html3 = $pdf_head_start;
                $html3 .= '<title>GSRF-Major Research Project </title>';
                $html3 .= $pdf_style;
                $html3 .= $pdf_head_end;
                $html3 .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <div class="mb-5">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="fw-5">
                                                    Provide a Time Schedule of activities<br>
                                                    <span> Give a bar diagram or GANTT chart on Quarterly basis </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </body>';
                $html3 .= $pdf_html_end;

                $html2 = $pdf_head_start;
                $html2 .= '<title>GSRF-Major Research Project </title>';
                $html2 .= $pdf_style;
                $html2 .= $pdf_head_end;
                $html2 .= '
                    <body>
                        <div class="container">
                            <div class="row">
                                <div class="mb-5">
                                    <table>
                                        <tbody>
                                            <tr><td class="fw-5">Plan of action for utilising research outcome</td></tr>
                                            ';$html2.=getHtmlContentFromString($data["action_plan"]); $html2.='
                                            <tr><td class="fw-5">Any other details
                                                <p>Such as specific permissions for carrying out the project/safety measures that will be taken / ethical guidelines that will be followed / prior informed consent that will be obtained, should be highlighted</p>
                                            </td></tr>
                                            ';$html2.=getHtmlContentFromString($data["any_other_details"]); $html2.='
                                        </tbody>
                                    </table>
                                </div>

                                <div class="page-break"></div>

                                <div class="mb-5">
                                    <h3>Expertise </h3>
                                    <table>
                                        <tbody>
                                            <tr><td class="fw-5">Highlight the specific expertise available with the PI and Co-PIs for executing the project</td></tr>
                                            <tr><td class="pb-2 ">'.nl2br(htmlspecialchars($data["specific_expertise_of_pi"])).' </td></tr>
                                        </tbody>
                                    </table>

                                    <label>Role and responsibility of each of the Investigators</label>
                                    <p>People with specific expertise required for executing the project only shall be PI/Co-PIs </p>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width">Name of the Investigators</th>
                                            <th class="th-width" style="width: 140px !important;">Roles/Responsibilities</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['investigator_role_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["name"].'</td>
                                                    <td>'.$value["role"].'</td>
                                                </tr>';
                                            }
                                $html2 .= '</tbody>
                                    </table>

                                    <label>Important publications by the Investigator(s) related to the theme of the proposal during the last 5 years</label>
                                    <p>Give the list of relevant publications only </p>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width">Publications</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['investigator_publications_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["name"].'</td>
                                                </tr>';
                                            }
                                $html2 .= '</tbody>
                                    </table>

                                    <label>Bibliography</label>
                                    <p>Please provide all the references cited in the proposal</p>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width">Bibliography</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['bibliography_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["name"].'</td>
                                                </tr>';
                                            }
                                $html2 .= '</tbody>
                                    </table>
                                </div>
                                
                                <div class="page-break"></div>
                                
                                <div class="mb-5">
                                    <h3>List of Projects submitted/implemented by the Investigators </h3>
                                    <p class="mb-5">The list of Projects implemented by the Principal Investigator, followed by Co-PI1, Co-PI 2 etc. should be given sequentially</p>
                                    
                                    <label>Details of Projects Submitted to various funding agencies</label>
                                    <table class="border mb-5 ">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No.</th>
                                            <th class="th-width">Title</th>
                                            <th class="th-width">Cost in Lakhs</th>
                                            <th class="th-width">Month of submission</th>
                                            <th class="th-width">Role as PI/Co-PI</th>
                                            <th class="th-width">Agency</th>
                                            <th class="th-width">Status</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['scheme_submitted_project_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["title"].'</td>
                                                    <td>'.$value["cost_in_lakhs"].'</td>
                                                    <td>'.$value["submission_month"].'</td>
                                                    <td>'.$value["role"].'</td>
                                                    <td>'.$value["agency"].'</td>
                                                    <td>'.$value["status"].'</td>
                                                </tr>';
                                            }
                                    $html2 .= '</tbody>
                                    </table>

                                    <label>Details of Ongoing Projects</label>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No.</th>
                                            <th class="th-width">Title</th>
                                            <th class="th-width">Cost in Lakhs</th>
                                            <th class="th-width">Start Date</th>
                                            <th class="th-width">End Date</th>
                                            <th class="th-width">Role as PI/Co-PI</th>
                                            <th class="th-width">Agency</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['scheme_ongoing_project_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["title"].'</td>
                                                    <td>'.$value["cost_in_lakhs"].'</td>
                                                    <td>'.$value["start_date"].'</td>
                                                    <td>'.$value["end_date"].'</td>
                                                    <td>'.$value["role"].'</td>
                                                    <td>'.$value["agency"].'</td>
                                                </tr>';
                                            }
                                    $html2 .= '</tbody>
                                    </table>
                                    
                                    <label>Completed Projects</label>
                                    <p>Please provide full details of projects completed during the last 5 years</p>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No.</th>
                                            <th class="th-width">Title</th>
                                            <th class="th-width">Cost in Lakhs</th>
                                            <th class="th-width">Start Date</th>
                                            <th class="th-width">End Date</th>
                                            <th class="th-width">Role as PI/Co-PI</th>
                                            <th class="th-width">Agency</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['scheme_completed_project_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["title"].'</td>
                                                    <td>'.$value["cost_in_lakhs"].'</td>
                                                    <td>'.$value["start_date"].'</td>
                                                    <td>'.$value["end_date"].'</td>
                                                    <td>'.$value["role"].'</td>
                                                    <td>'.$value["agency"].'</td>
                                                </tr>';
                                            }
                                    $html2 .= '</tbody>
                                    </table>
                                </div>
                                    
                                <div class="page-break"></div>

                                <div class="mb-5">
                                    <h3>Facilities extended by parent institution(s) for the project implementation </h3>
                                    <label>Infrastructural Facilities, including administrative help</label>
                                    <table class="border mb-5">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No.</th>
                                            <th class="th-width">Facilities</th>
                                            <th class="th-width">Yes/No</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['infrastructural_facility_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["title"].'</td>
                                                    <td>'.$value["status"].'</td>
                                                </tr>';
                                            }
                                    $html2 .= '</tbody>
                                    </table>
                                    
                                    <label>Equipment available with the Institute/ Group/ Department/Other Institutes for the project</label>
                                    <p>Please provide full details of projects completed during the last 5 years</p>
                                    <table class="border">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No.</th>
                                            <th class="th-width">Equipment available with</th>
                                            <th class="th-width">Generic name of Equipment </th>
                                            <th class="th-width">Model, Make & year of purchase</th>
                                            <th class="th-width">Remarks including accessories available and current usage of</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['equipment_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["available_with"].'</td>
                                                    <td>'.$value["generic_name"].'</td>
                                                    <td>'.$value["purchase_details"].'</td>
                                                    <td>'.$value["remarks_on_accessories"].'</td>
                                                </tr>';
                                            }
                                    $html2 .= '</tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h3 class="mb-4">List of Experts/Institutions </h3>
                                    <h3>Name and address of Experts/Institutions interested in the subject/outcome of the project</h3>
                                    <p class="mb-5">Provide names of at least five experts and/or institutions</p>

                                    <table class="border">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No.</th>
                                            <th class="th-width">Name</th>
                                            <th class="th-width">Address</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['outcome_interested_expert_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["name"].'</td>
                                                    <td>'.$value["address"].'</td>
                                                </tr>';
                                            }
                                    $html2 .= '</tbody>
                                    </table>
                                </div>

                                <div class="page-break"></div>

                                <div class="mb-5">
                                    <h3>Budget </h3>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="fw-5">Consolidated (Grand Total): Rs</td> 
                                                <td>Rs. '.$data["budget_consolidated"].' </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <table class="border edu_details mt-4">
                                        <thead class="table-light">
                                            <th>Sr. No.</th>
                                            <th>Item</th>
                                            <th>Year 1 (Rs)</th>
                                            <th>Year 2 (Rs)</th>
                                            <th>Year 3 (Rs)</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>I</td>
                                                <td>Non-Recurring</td>
                                                <td>'.$data["year_1_1"].'</td>
                                                <td>'.$data["year_1_2"].'</td>
                                                <td>'.$data["year_1_3"].'</td>
                                                <td>'.$data["year_1_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Equipment</td>
                                                <td>'.$data["year_2_1"].'</td>
                                                <td>'.$data["year_2_2"].'</td>
                                                <td>'.$data["year_2_3"].'</td>
                                                <td>'.$data["year_2_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>(a)'.$data["equipment_a"].'</td>
                                                <td>'.$data["year_3_1"].'</td>
                                                <td>'.$data["year_3_2"].'</td>
                                                <td>'.$data["year_3_3"].'</td>
                                                <td>'.$data["year_3_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>(b)'.$data["equipment_b"].'</td>
                                                <td>'.$data["year_4_1"].'</td>
                                                <td>'.$data["year_4_2"].'</td>
                                                <td>'.$data["year_4_3"].'</td>
                                                <td>'.$data["year_4_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>(c)'.$data["equipment_c"].'</td>
                                                <td>'.$data["year_5_1"].'</td>
                                                <td>'.$data["year_5_2"].'</td>
                                                <td>'.$data["year_5_3"].'</td>
                                                <td>'.$data["year_5_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>(d)'.$data["equipment_d"].'</td>
                                                <td>'.$data["year_6_1"].'</td>
                                                <td>'.$data["year_6_2"].'</td>
                                                <td>'.$data["year_6_3"].'</td>
                                                <td>'.$data["year_6_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>(e)'.$data["equipment_e"].'</td>
                                                <td>'.$data["year_7_1"].'</td>
                                                <td>'.$data["year_7_2"].'</td>
                                                <td>'.$data["year_7_3"].'</td>
                                                <td>'.$data["year_7_total"].'</td>
                                            </tr>
                                            ';
                                            // code removed as of 06 july 2024 
                                                // <tr>
                                                //     <td>2</td>
                                                //     <td>Books and Journals</td>
                                                //     <td>'.$data["year_8_1"].'</td>
                                                //     <td>'.$data["year_8_2"].'</td>
                                                //     <td>'.$data["year_8_3"].'</td>
                                                //     <td>'.$data["year_8_total"].'</td>
                                                // </tr>
                                    $html2 .= '
                                            <tr>
                                                <td></td>
                                                <td>TOTAL</td>
                                                <td>'.$data["year_9_1"].'</td>
                                                <td>'.$data["year_9_2"].'</td>
                                                <td>'.$data["year_9_3"].'</td>
                                                <td>'.$data["year_9_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td>II</td>
                                                <td>Recurring</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Project Staff (Project Assistant)</td>
                                                <td>'.$data["year_10_1"].'</td>
                                                <td>'.$data["year_10_2"].'</td>
                                                <td>'.$data["year_10_3"].'</td>
                                                <td>'.$data["year_10_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Hiring services #</td>
                                                <td>'.$data["year_11_1"].'</td>
                                                <td>'.$data["year_11_2"].'</td>
                                                <td>'.$data["year_11_3"].'</td>
                                                <td>'.$data["year_11_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Contingency</td>
                                                <td>'.$data["year_12_1"].'</td>
                                                <td>'.$data["year_12_2"].'</td>
                                                <td>'.$data["year_12_3"].'</td>
                                                <td>'.$data["year_12_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Chemicals and consumables</td>
                                                <td>'.$data["year_13_1"].'</td>
                                                <td>'.$data["year_13_2"].'</td>
                                                <td>'.$data["year_13_3"].'</td>
                                                <td>'.$data["year_13_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Travel and/or Field Work</td>
                                                <td>'.$data["year_14_1"].'</td>
                                                <td>'.$data["year_14_2"].'</td>
                                                <td>'.$data["year_14_3"].'</td>
                                                <td>'.$data["year_14_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Special Needs (if any)</td>
                                                <td>'.$data["year_15_1"].'</td>
                                                <td>'.$data["year_15_2"].'</td>
                                                <td>'.$data["year_15_3"].'</td>
                                                <td>'.$data["year_15_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Total</td>
                                                <td>'.$data["year_16_1"].'</td>
                                                <td>'.$data["year_16_2"].'</td>
                                                <td>'.$data["year_16_3"].'</td>
                                                <td>'.$data["year_16_total"].'</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Grand Total</td>
                                                <td>'.$data["year_17_1"].'</td>
                                                <td>'.$data["year_17_2"].'</td>
                                                <td>'.$data["year_17_3"].'</td>
                                                <td>'.$data["year_17_total"].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>NOTE : Please consult the scheme for the details #</p>

                                    <h3 class="mt-5">Budget Components Details</h3>
                                    <label>Please justify each of the budget components by specifying the serial number given in the table </label>
                                    <p>If more than one institution is involved, please provide institution-wise budget details in addition to the above.</p>
                                    <table class="border">
                                        <thead>
                                            <th class="th-width" style="width: 20px !important;">S.No</th>
                                            <th class="th-width" style="width: 140px !important;">Item Name</th>
                                            <th class="th-width">Justification</th>
                                        </thead>
                                        <tbody>';
                                            foreach ($data['budget_components_details'] as $key => $value) 
                                            {
                                                $html2 .= '<tr>
                                                    <td>'.++$key.'</td>
                                                    <td>'.$value["name"].'</td>
                                                    <td>'.nl2br(htmlspecialchars($value["description"])).'</td>
                                                </tr>';
                                            }
                                $html2 .= '</tbody>
                                    </table>

                                    <table>    
                                        <tbody>
                                            <tr><td class="fw-5">If the project has social /local relevance, please highlight</td></tr>
                                            <tr><td class="pb-2 ">'.nl2br(htmlspecialchars($data["budget_project_relevance"])).' </td></tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-5">
                                    <h3>List of Uploaded Certificates</h3>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Do you (PI) belong to EWS/OBC/SC/ST category</td>
                                                <td>';
                                                    if ($data['is_pi_belong_to_category']==0 ) {
                                                        $html2 .= 'No (Certificate not required)';
                                                    } else {
                                                        $html2 .= 'Yes (Attach Category Certificate)';
                                                    }
                                        $html2 .= '</td>
                                            </tr>
                                            <tr>
                                                <td>Are you (PI/Co-PI) Differently Abled?</td>
                                                <td>';
                                                    if ($data['is_pi_differently_abled']==0 ) {
                                                        $html2 .= 'No (Certificate not required)';
                                                    } else {
                                                        $html2 .= 'Yes (Attach Differently Abled Certificate)';
                                                    }
                                        $html2 .= '</td>
                                            </tr>   
                                            <tr><td>Certification from PI</td><td></td></tr>
                                            <tr><td>Aadhar Card</td><td></td></tr>
                                            <tr><td>Endorsement from the Principal/Registrar/Head of the Institution</td><td></td></tr>
                                            <tr><td>PhD Certificate</td><td></td></tr>
                                            <tr><td>CV of the PI</td><td></td></tr>';
                                            if ($data['file_co_pi_cv']) {
                                                $html2 .= '<tr><td>CV of the Co-PIs</td><td></td></tr>';
                                            }
                                $html2 .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </body>';
                $html2 .= $pdf_html_end;
                // <tr><td>Endorsement from the Registrar of the Institution</td><td></td></tr>
            // echo $html; exit;

            // Create a PDF using Dompdf
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isPhpEnabled', true); // Enable PHP in the HTML (optional)
                $options->set('isRemoteEnabled', true); // Ensure remote images are enabled
                // $options->set('defaultFont', 'Inter'); 
                $options->set('defaultFont', 'NotoSansDevanagari'); 

                // PDF 1
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
                // echo "PDF generated and saved as <a href='$host$temp_pdf_file_location' download='$temp_pdf_filename'>$temp_pdf_filename</a>"; exit;
                
                // PDF 2
                if ($data["file_methodology"]) {
                    $dompdf3 = new Dompdf($options);
                    $dompdf3->loadHtml($html3);
                    $dompdf3->setPaper('A4', 'portrait');
                    $dompdf3->render();
                    // Generate a unique filename for the PDF
                    $temp_pdf_filename3 = date('YmdHis') .'-temp3-'. $filename .'.pdf';
                    // Define the path where you want to save the PDF
                    $temp_pdf_file_location3 = 'uploads/' . $temp_pdf_filename3;
                    $temp_app_file_path3 = $base_path.$temp_pdf_file_location3;
                    // Save the PDF on the server
                    file_put_contents($temp_app_file_path3, $dompdf3->output());
                    // echo "PDF generated and saved as <a href='$host$temp_pdf_file_location' download='$temp_pdf_filename'>$temp_pdf_filename</a> <br>";
                    // echo "PDF generated and saved as <a href='$host$temp_pdf_file_location3' download='$temp_pdf_filename3'>$temp_pdf_filename3</a>"; exit;
                } else {
                    $temp_pdf_filename3 = $temp_app_file_path3 = false;
                }

                // PDF 13
                $dompdf2 = new Dompdf($options);
                $dompdf2->loadHtml($html2);
                $dompdf2->setPaper('A4', 'portrait');
                $dompdf2->render();
                // Generate a unique filename for the PDF
                $temp_pdf_filename2 = date('YmdHis') .'-temp2-'. $filename .'.pdf';
                // Define the path where you want to save the PDF
                $temp_pdf_file_location2 = 'uploads/' . $temp_pdf_filename2;
                $temp_app_file_path2 = $base_path.$temp_pdf_file_location2;
                // Save the PDF on the server
                file_put_contents($temp_app_file_path2, $dompdf2->output());
            // echo "PDF generated and saved as <a href='$host$temp_pdf_file_location' download='$temp_pdf_filename'>$temp_pdf_filename</a> <br>";
            // echo "PDF generated and saved as <a href='$host$temp_pdf_file_location2' download='$temp_pdf_filename2'>$temp_pdf_filename2</a>"; exit;

            // removed
            // $base_path.$data['file_registrar_endorsement_certificate'],
            
            // merge all the files to attach 
                $file_to_merge = [
                    $temp_app_file_path,
                ];
                if ($data['file_methodology']) {
                    array_push($file_to_merge, $base_path.$data['file_methodology']);
                    array_push($file_to_merge, $temp_app_file_path3);
                }
                array_push($file_to_merge, $base_path.$data['file_time_schedule']);
                array_push($file_to_merge, $temp_app_file_path2);
                if ($data['is_pi_belong_to_category']==1) {
                    array_push($file_to_merge, $base_path.$data['file_category_certificate']);
                }
                if ($data['is_pi_differently_abled']==1) {
                    array_push($file_to_merge, $base_path.$data['file_pi_diff_abled_certificate']);
                }
                array_push($file_to_merge, $base_path.$data['file_pi_certification']);
                array_push($file_to_merge, $base_path.$data['file_aadhar_card']);
                array_push($file_to_merge, $base_path.$data['file_principal_endorsement_certificate']);
                array_push($file_to_merge, $base_path.$data['file_phd_certificate']);
                array_push($file_to_merge, $base_path.$data['file_pi_cv']);
                if ($data['file_co_pi_cv']) {
                    array_push($file_to_merge, $base_path.$data['file_co_pi_cv']);
                }
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
                        $query = "UPDATE scheme_major_project_grant SET file_application_form=:file_application_form WHERE user_id='".$id."' ";
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
        $application_no = applicationNo("scheme_major_project_grant");
        $form_type = $postData['form_type'] ?? '';
        $form_no = $postData['form_no'] ?? '';
        $scheme_id = $postData['scheme_id'] ?? '';
        $get_last_record_id = (int)$scheme_id;

        if (isset($postData["formSubmissionType"]) && $postData["formSubmissionType"] == 'direct') {
            $file_application_form = $postData['file_application_form'] ?? '';
            
            $query="INSERT INTO scheme_major_project_grant (user_id,application_no,scheme_batch_id,file_application_form,form_status)
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
            $investigator_details = $postData['investigator_details'] ?? []; // Principal / Co-Investigator I & II Details(if any)
                $institution_details = $postData['institution_details'] ?? [];
                $file_profile_picture = $postData['file_profile_picture'] ?? '';
                $proposed_amount = $postData['proposed_amount'] ?? '';

                $proposal_title = $postData['proposal_title'] ?? '';  
                $broad_discipline = $postData['broad_discipline'] ?? '';
                $proposal_summary = $postData['proposal_summary'] ?? '';
                $objectives = $postData['objectives'] ?? '';
                $expected_outcome = $postData['expected_outcome'] ?? '';
                
                $proposal_background = $postData['proposal_background'] ?? '';
                $international_status = $postData['international_status'] ?? '';
                $national_status = $postData['national_status'] ?? '';
                $local_status = $postData['local_status'] ?? '';
                $proposal_significance = $postData['proposal_significance'] ?? '';
                $proposal_objectives = $postData['proposal_objectives'] ?? '';
                $project_location = $postData['project_location'] ?? '';
                
                $methodology = $postData['methodology'] ?? '';
                $file_methodology = $postData['file_methodology'] ?? '';
                $file_time_schedule = $postData['file_time_schedule'] ?? '';
                $action_plan = $postData['action_plan'] ?? '';
                $any_other_details = $postData['any_other_details'] ?? '';
                
                $specific_expertise_of_pi = $postData['specific_expertise_of_pi'] ?? '';
                $investigator_role_details = $postData['investigator_role_details'] ?? [];
                $investigator_publications_details = $postData['investigator_publications_details'] ?? [];
                $bibliography_details = $postData['bibliography_details'] ?? [];
                
                $scheme_submitted_project_details = $postData['scheme_submitted_project_details'] ?? [];
                $scheme_ongoing_project_details = $postData['scheme_ongoing_project_details'] ?? [];
                $scheme_completed_project_details = $postData['scheme_completed_project_details'] ?? [];

                $infrastructural_facility_details = $postData['infrastructural_facility_details'] ?? [];
                $equipment_details = $postData['equipment_details'] ?? [];

                $outcome_interested_expert_details = $postData['outcome_interested_expert_details'] ?? [];

                $budget_consolidated = $postData['budget_consolidated'] ?? '';
                $equipment_a = $postData['equipment_a'] ?? '';
                $equipment_b = $postData['equipment_b'] ?? '';
                $equipment_c = $postData['equipment_c'] ?? '';
                $equipment_d = $postData['equipment_d'] ?? '';
                $equipment_e = $postData['equipment_e'] ?? '';
                    $year_1_1 = $postData['year_1_1'] ?? '';
                    $year_1_2 = $postData['year_1_2'] ?? '';
                    $year_1_3 = $postData['year_1_3'] ?? '';
                    $year_1_total = $postData['year_1_total'] ?? '';
                    $year_2_1 = $postData['year_2_1'] ?? '';
                    $year_2_2 = $postData['year_2_2'] ?? '';
                    $year_2_3 = $postData['year_2_3'] ?? '';
                    $year_2_total = $postData['year_2_total'] ?? '';
                    $year_3_1 = $postData['year_3_1'] ?? '';
                    $year_3_2 = $postData['year_3_2'] ?? '';
                    $year_3_3 = $postData['year_3_3'] ?? '';
                    $year_3_total = $postData['year_3_total'] ?? '';
                    $year_4_1 = $postData['year_4_1'] ?? '';
                    $year_4_2 = $postData['year_4_2'] ?? '';
                    $year_4_3 = $postData['year_4_3'] ?? '';
                    $year_4_total = $postData['year_4_total'] ?? '';
                    $year_5_1 = $postData['year_5_1'] ?? '';
                    $year_5_2 = $postData['year_5_2'] ?? '';
                    $year_5_3 = $postData['year_5_3'] ?? '';
                    $year_5_total = $postData['year_5_total'] ?? '';
                    $year_6_1 = $postData['year_6_1'] ?? '';
                    $year_6_2 = $postData['year_6_2'] ?? '';
                    $year_6_3 = $postData['year_6_3'] ?? '';
                    $year_6_total = $postData['year_6_total'] ?? '';
                    $year_7_1 = $postData['year_7_1'] ?? '';
                    $year_7_2 = $postData['year_7_2'] ?? '';
                    $year_7_3 = $postData['year_7_3'] ?? '';
                    $year_7_total = $postData['year_7_total'] ?? '';
                    $year_8_1 = $postData['year_8_1'] ?? '';
                    $year_8_2 = $postData['year_8_2'] ?? '';
                    $year_8_3 = $postData['year_8_3'] ?? '';
                    $year_8_total = $postData['year_8_total'] ?? '';
                    $year_9_1 = $postData['year_9_1'] ?? '';
                    $year_9_2 = $postData['year_9_2'] ?? '';
                    $year_9_3 = $postData['year_9_3'] ?? '';
                    $year_9_total = $postData['year_9_total'] ?? '';
                    $year_10_1 = $postData['year_10_1'] ?? '';
                    $year_10_2 = $postData['year_10_2'] ?? '';
                    $year_10_3 = $postData['year_10_3'] ?? '';
                    $year_10_total = $postData['year_10_total'] ?? '';
                    $year_11_1 = $postData['year_11_1'] ?? '';
                    $year_11_2 = $postData['year_11_2'] ?? '';
                    $year_11_3 = $postData['year_11_3'] ?? '';
                    $year_11_total = $postData['year_11_total'] ?? '';
                    $year_12_1 = $postData['year_12_1'] ?? '';
                    $year_12_2 = $postData['year_12_2'] ?? '';
                    $year_12_3 = $postData['year_12_3'] ?? '';
                    $year_12_total = $postData['year_12_total'] ?? '';
                    $year_13_1 = $postData['year_13_1'] ?? '';
                    $year_13_2 = $postData['year_13_2'] ?? '';
                    $year_13_3 = $postData['year_13_3'] ?? '';
                    $year_13_total = $postData['year_13_total'] ?? '';
                    $year_14_1 = $postData['year_14_1'] ?? '';
                    $year_14_2 = $postData['year_14_2'] ?? '';
                    $year_14_3 = $postData['year_14_3'] ?? '';
                    $year_14_total = $postData['year_14_total'] ?? '';
                    $year_15_1 = $postData['year_15_1'] ?? '';
                    $year_15_2 = $postData['year_15_2'] ?? '';
                    $year_15_3 = $postData['year_15_3'] ?? '';
                    $year_15_total = $postData['year_15_total'] ?? '';
                    $year_16_1 = $postData['year_16_1'] ?? '';
                    $year_16_2 = $postData['year_16_2'] ?? '';
                    $year_16_3 = $postData['year_16_3'] ?? '';
                    $year_16_total = $postData['year_16_total'] ?? '';
                    $year_17_1 = $postData['year_17_1'] ?? '';
                    $year_17_2 = $postData['year_17_2'] ?? '';
                    $year_17_3 = $postData['year_17_3'] ?? '';
                    $year_17_total = $postData['year_17_total'] ?? '';
                $budget_components_details = $postData['budget_components_details'] ?? [];
                $budget_project_relevance = $postData['budget_project_relevance'] ?? '';
                
                $is_pi_belong_to_category = $postData['is_pi_belong_to_category'] ?? '';
                $file_category_certificate = $postData['file_category_certificate'] ?? '';
                $is_pi_differently_abled = $postData['is_pi_differently_abled'] ?? '';
                $file_pi_diff_abled_certificate = $postData['file_pi_diff_abled_certificate'] ?? '';
                $file_pi_certification = $postData['file_pi_certification'] ?? '';
                $file_aadhar_card = $postData['file_aadhar_card'] ?? '';
                $file_principal_endorsement_certificate = $postData['file_principal_endorsement_certificate'] ?? '';
                $file_registrar_endorsement_certificate = $postData['file_registrar_endorsement_certificate'] ?? '';
                $file_phd_certificate = $postData['file_phd_certificate'] ?? '';
                $file_pi_cv = $postData['file_pi_cv'] ?? '';
            $file_co_pi_cv = $postData['file_co_pi_cv'] ?? '';
            
            if ($get_last_record_id) {
                // update
                if ($form_no == 0) {
                    $query="UPDATE scheme_major_project_grant SET file_profile_picture=:file_profile_picture,proposed_amount=:proposed_amount,form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(
                            ':file_profile_picture' => $file_profile_picture,
                            ':proposed_amount' => $proposed_amount,
                            ':form_no' => $form_no,
                        );
                    $result = insertRow($query, $data);
                    if($result) {
                        // get table if exist -- delete rows if exist -- create new
                        if ($investigator_details) {
                            if (fetchRows("SELECT * FROM scheme_fellowship_investigator_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                                deleteRow("DELETE FROM scheme_fellowship_investigator_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                            }
                            $query2="INSERT INTO scheme_fellowship_investigator_details (scheme_major_project_grant_id, type, first_name, middle_name, last_name, gender, dob, qualification, designation, official_address, department, specialisation, country_code, phone_no, email ) 
                                            VALUES (:scheme_major_project_grant_id, :type, :first_name, :middle_name, :last_name, :gender, :dob, :qualification, :designation, :official_address, :department, :specialisation, :country_code, :phone_no, :email )";
                            foreach ($investigator_details as $key2 => $value) {
                                $data2 = array(
                                            ':scheme_major_project_grant_id' => $get_last_record_id,
                                            ':type' => $value['type'],
                                            ':first_name' => $value['first_name'],
                                            ':middle_name' => $value['middle_name'],
                                            ':last_name' => $value['last_name'],
                                            ':gender' => $value['gender'],
                                            ':dob' => $value['dob'],
                                            ':qualification' => $value['qualification'],
                                            ':designation' => $value['designation'],
                                            ':official_address' => $value['official_address'],
                                            ':department' => $value['department'],
                                            ':specialisation' => $value['specialisation'],
                                            ':country_code' => $value['country_code'],
                                            ':phone_no' => $value['phone_no'],
                                            ':email' => $value['email']
                                        );
                                insertRow($query2, $data2);
                            }
                        }
                        if ($institution_details) {
                            if (fetchRows("SELECT * FROM scheme_institution_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                                deleteRow("DELETE FROM scheme_institution_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                            }
                            $query3="INSERT INTO scheme_institution_details (scheme_major_project_grant_id, name, address) 
                                        VALUES (:scheme_major_project_grant_id, :name, :address )";
                            foreach ($institution_details as $key3 => $value) {
                                $data3 = array(
                                            ':scheme_major_project_grant_id' => $get_last_record_id,
                                            ':name' => $value['name'],
                                            ':address' => $value['address'],
                                        );
                                insertRow($query3, $data3);
                            }
                        }
                    }
                } else if ($form_no == 1) {
                    $query="UPDATE scheme_major_project_grant 
                            SET proposal_title=:proposal_title, broad_discipline=:broad_discipline, proposal_summary=:proposal_summary, objectives=:objectives, expected_outcome=:expected_outcome,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':proposal_title' => $proposal_title,
                        ':broad_discipline' => $broad_discipline,
                        ':proposal_summary' => $proposal_summary,
                        ':objectives' => $objectives,
                        ':expected_outcome' => $expected_outcome,
                        ':form_no' => $form_no,
                    );
                    $result = insertRow($query, $data);
                } else if ($form_no == 2) {
                    $query="UPDATE scheme_major_project_grant 
                            SET proposal_background=:proposal_background, international_status=:international_status, national_status=:national_status, local_status=:local_status, proposal_significance=:proposal_significance, proposal_objectives=:proposal_objectives, project_location=:project_location,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':proposal_background' => $proposal_background,
                        ':international_status' => $international_status,
                        ':national_status' => $national_status,
                        ':local_status' => $local_status,
                        ':proposal_significance' => $proposal_significance,
                        ':proposal_objectives' => $proposal_objectives,
                        ':project_location' => $project_location,
                        ':form_no' => $form_no,
                    );
                    $result = insertRow($query, $data);
                } else if ($form_no == 3) {
                    $query="UPDATE scheme_major_project_grant 
                            SET methodology=:methodology, file_methodology=:file_methodology, file_time_schedule=:file_time_schedule, action_plan=:action_plan, any_other_details=:any_other_details,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':methodology' => $methodology,
                        ':file_methodology' => $file_methodology,
                        ':file_time_schedule' => $file_time_schedule,
                        ':action_plan' => $action_plan,
                        ':any_other_details' => $any_other_details,
                        ':form_no' => $form_no,
                    );
                    $result = insertRow($query, $data);
                } else if ($form_no == 4) {
                    $query="UPDATE scheme_major_project_grant 
                            SET specific_expertise_of_pi=:specific_expertise_of_pi,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':specific_expertise_of_pi' => $specific_expertise_of_pi,
                        ':form_no' => $form_no,
                    );
                    $result = insertRow($query, $data);
                    if($result) {
                        // get table if exist -- delete rows if exist -- create new
                        if (fetchRows("SELECT * FROM scheme_investigators_role_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_investigators_role_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                        }
                        if ($investigator_role_details) {
                            $query2="INSERT INTO scheme_investigators_role_details (scheme_major_project_grant_id, name, role) 
                                        VALUES (:scheme_major_project_grant_id, :name, :role)";
                            foreach ($investigator_role_details as $key => $value) {
                                $data2 = array(
                                            ':scheme_major_project_grant_id' => $get_last_record_id,
                                            ':name' => $value['name'],
                                            ':role' => $value['role'],
                                        );
                                insertRow($query2, $data2);
                            }
                        }
                        if (fetchRows("SELECT * FROM scheme_important_reference_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_important_reference_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                        }
                        if ($bibliography_details) {
                            $query3="INSERT INTO scheme_important_reference_details (scheme_major_project_grant_id, name) 
                                        VALUES (:scheme_major_project_grant_id, :name)";
                            foreach ($bibliography_details as $key => $value) {
                                $data3 = array(
                                            ':scheme_major_project_grant_id' => $get_last_record_id,
                                            ':name' => $value['name'],
                                        );
                                insertRow($query3, $data3);
                            }
                        }

                        if (fetchRows("SELECT * FROM scheme_important_publications_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                            deleteRow("DELETE FROM scheme_important_publications_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                        }
                        if ($investigator_publications_details) {
                            $query2="INSERT INTO scheme_important_publications_details (scheme_major_project_grant_id, name) 
                                        VALUES (:scheme_major_project_grant_id, :name)";
                            foreach ($investigator_publications_details as $key => $value) {
                                $data2 = array(
                                            ':scheme_major_project_grant_id' => $get_last_record_id,
                                            ':name' => $value['name'],
                                        );
                                insertRow($query2, $data2);
                            }
                        }
                    }
                } else if ($form_no == 5) {
                    $query="UPDATE scheme_major_project_grant SET form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(':form_no' => $form_no );
                    $result = insertRow($query, $data);

                    // get table if exist -- delete rows if exist -- create new
                    if (fetchRows("SELECT * FROM scheme_project_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                        deleteRow("DELETE FROM scheme_project_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                    }
                    $query_project_1="INSERT INTO scheme_project_details (scheme_major_project_grant_id, project_status, type, title, cost_in_lakhs, submission_month, role, agency, status) 
                                VALUES (:scheme_major_project_grant_id, :project_status, :type, :title, :cost_in_lakhs, :submission_month, :role, :agency, :status)";
                    if ($scheme_submitted_project_details) {
                        foreach ($scheme_submitted_project_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':project_status' => $value['project_status'],
                                        ':type' => $value['type'],
                                        ':title' => $value['title'],
                                        ':cost_in_lakhs' => $value['cost_in_lakhs'],
                                        ':submission_month' => $value['submission_month'],
                                        ':role' => $value['role'],
                                        ':agency' => $value['agency'],
                                        ':status' => $value['status']
                                    );
                            insertRow($query_project_1, $data2);
                        }
                    }
                    $query_project="INSERT INTO scheme_project_details (scheme_major_project_grant_id, project_status, type, title, cost_in_lakhs, start_date, end_date, role, agency) 
                                VALUES (:scheme_major_project_grant_id, :project_status, :type, :title, :cost_in_lakhs, :start_date, :end_date, :role, :agency)";
                    if ($scheme_ongoing_project_details) {
                        foreach ($scheme_ongoing_project_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':project_status' => $value['project_status'],
                                        ':type' => $value['type'],
                                        ':title' => $value['title'],
                                        ':cost_in_lakhs' => $value['cost_in_lakhs'],
                                        ':start_date' => $value['start_date'],
                                        ':end_date' => $value['end_date'],
                                        ':role' => $value['role'],
                                        ':agency' => $value['agency']
                                    );
                            insertRow($query_project, $data2);
                        }
                    }
                    if ($scheme_completed_project_details) {
                        foreach ($scheme_completed_project_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':project_status' => $value['project_status'],
                                        ':type' => $value['type'],
                                        ':title' => $value['title'],
                                        ':cost_in_lakhs' => $value['cost_in_lakhs'],
                                        ':start_date' => $value['start_date'],
                                        ':end_date' => $value['end_date'],
                                        ':role' => $value['role'],
                                        ':agency' => $value['agency']
                                    );
                            insertRow($query_project, $data2);
                        }
                    }
                } else if ($form_no == 6) {
                    $query="UPDATE scheme_major_project_grant SET form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(':form_no' => $form_no );
                    $result = insertRow($query, $data);
                    
                    // get table if exist -- delete rows if exist -- create new
                    if (fetchRows("SELECT * FROM scheme_infrastructural_facility_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                        deleteRow("DELETE FROM scheme_infrastructural_facility_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                    }
                    if ($infrastructural_facility_details) {
                        $query2="INSERT INTO scheme_infrastructural_facility_details (scheme_major_project_grant_id, title, status) 
                                    VALUES (:scheme_major_project_grant_id, :title, :status)";
                        foreach ($infrastructural_facility_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':title' => $value['title'],
                                        ':status' => $value['status'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                    
                    if (fetchRows("SELECT * FROM scheme_equipment_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                        deleteRow("DELETE FROM scheme_equipment_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                    }
                    if ($equipment_details) {
                        $query2="INSERT INTO scheme_equipment_details (scheme_major_project_grant_id, available_with, generic_name, purchase_details, remarks_on_accessories) 
                                    VALUES (:scheme_major_project_grant_id, :available_with, :generic_name, :purchase_details, :remarks_on_accessories)";
                        foreach ($equipment_details as $key => $value) {
                            $data2 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':available_with' => $value['available_with'],
                                        ':generic_name' => $value['generic_name'],
                                        ':purchase_details' => $value['purchase_details'],
                                        ':remarks_on_accessories' => $value['remarks_on_accessories']
                                    );
                            insertRow($query2, $data2);
                        }
                    }

                } else if ($form_no == 7) {
                    $query="UPDATE scheme_major_project_grant SET form_no=:form_no WHERE id=$get_last_record_id";
                    $data = array(':form_no' => $form_no );
                    $result = insertRow($query, $data);
                    
                    if (fetchRows("SELECT * FROM scheme_project_outcome_interested_expert_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                        deleteRow("DELETE FROM scheme_project_outcome_interested_expert_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                    }
                    if ($outcome_interested_expert_details) {
                        foreach ($outcome_interested_expert_details as $key => $value) {
                            $query2="INSERT INTO scheme_project_outcome_interested_expert_details (scheme_major_project_grant_id, name, address) 
                                        VALUES (:scheme_major_project_grant_id, :name, :address)";
                            $data2 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':name' => $value['name'],
                                        ':address' => $value['address'],
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                } else if ($form_no == 8) {
                    $query="UPDATE scheme_major_project_grant 
                            SET proposed_amount=:proposed_amount, budget_consolidated=:budget_consolidated, equipment_a=:equipment_a, equipment_b=:equipment_b, equipment_c=:equipment_c, equipment_d=:equipment_d, equipment_e=:equipment_e,
                                year_1_1=:year_1_1, year_1_2=:year_1_2, year_1_3=:year_1_3, year_1_total=:year_1_total, year_2_1=:year_2_1, year_2_2=:year_2_2, year_2_3=:year_2_3, year_2_total=:year_2_total, 
                                year_3_1=:year_3_1, year_3_2=:year_3_2, year_3_3=:year_3_3, year_3_total=:year_3_total, year_4_1=:year_4_1, year_4_2=:year_4_2, year_4_3=:year_4_3, year_4_total=:year_4_total, 
                                year_5_1=:year_5_1, year_5_2=:year_5_2, year_5_3=:year_5_3, year_5_total=:year_5_total, year_6_1=:year_6_1, year_6_2=:year_6_2, year_6_3=:year_6_3, year_6_total=:year_6_total, 
                                year_7_1=:year_7_1, year_7_2=:year_7_2, year_7_3=:year_7_3, year_7_total=:year_7_total, year_8_1=:year_8_1, year_8_2=:year_8_2, year_8_3=:year_8_3, year_8_total=:year_8_total, 
                                year_9_1=:year_9_1, year_9_2=:year_9_2, year_9_3=:year_9_3, year_9_total=:year_9_total, year_10_1=:year_10_1, year_10_2=:year_10_2, year_10_3=:year_10_3, year_10_total=:year_10_total, 
                                year_11_1=:year_11_1, year_11_2=:year_11_2, year_11_3=:year_11_3, year_11_total=:year_11_total, year_12_1=:year_12_1, year_12_2=:year_12_2, year_12_3=:year_12_3, year_12_total=:year_12_total, 
                                year_13_1=:year_13_1, year_13_2=:year_13_2, year_13_3=:year_13_3, year_13_total=:year_13_total, year_14_1=:year_14_1, year_14_2=:year_14_2, year_14_3=:year_14_3, year_14_total=:year_14_total, 
                                year_15_1=:year_15_1, year_15_2=:year_15_2, year_15_3=:year_15_3, year_15_total=:year_15_total, year_16_1=:year_16_1, year_16_2=:year_16_2, year_16_3=:year_16_3, year_16_total=:year_16_total, 
                                year_17_1=:year_17_1, year_17_2=:year_17_2, year_17_3=:year_17_3, year_17_total=:year_17_total, budget_project_relevance=:budget_project_relevance,form_no=:form_no
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':proposed_amount' => $budget_consolidated,
                        ':budget_consolidated' => $budget_consolidated,
                        ':equipment_a' => $equipment_a,
                        ':equipment_b' => $equipment_b,
                        ':equipment_c' => $equipment_c,
                        ':equipment_d' => $equipment_d,
                        ':equipment_e' => $equipment_e,
                        ':year_1_1' => $year_1_1,
                        ':year_1_2' => $year_1_2,
                        ':year_1_3' => $year_1_3,
                        ':year_1_total' => $year_1_total,
                        ':year_2_1' => $year_2_1,
                        ':year_2_2' => $year_2_2,
                        ':year_2_3' => $year_2_3,
                        ':year_2_total' => $year_2_total,
                        ':year_3_1' => $year_3_1,
                        ':year_3_2' => $year_3_2,
                        ':year_3_3' => $year_3_3,
                        ':year_3_total' => $year_3_total,
                        ':year_4_1' => $year_4_1,
                        ':year_4_2' => $year_4_2,
                        ':year_4_3' => $year_4_3,
                        ':year_4_total' => $year_4_total,
                        ':year_5_1' => $year_5_1,
                        ':year_5_2' => $year_5_2,
                        ':year_5_3' => $year_5_3,
                        ':year_5_total' => $year_5_total,
                        ':year_6_1' => $year_6_1,
                        ':year_6_2' => $year_6_2,
                        ':year_6_3' => $year_6_3,
                        ':year_6_total' => $year_6_total,
                        ':year_7_1' => $year_7_1,
                        ':year_7_2' => $year_7_2,
                        ':year_7_3' => $year_7_3,
                        ':year_7_total' => $year_7_total,
                        ':year_8_1' => $year_8_1,
                        ':year_8_2' => $year_8_2,
                        ':year_8_3' => $year_8_3,
                        ':year_8_total' => $year_8_total,
                        ':year_9_1' => $year_9_1,
                        ':year_9_2' => $year_9_2,
                        ':year_9_3' => $year_9_3,
                        ':year_9_total' => $year_9_total,
                        ':year_10_1' => $year_10_1,
                        ':year_10_2' => $year_10_2,
                        ':year_10_3' => $year_10_3,
                        ':year_10_total' => $year_10_total,
                        ':year_11_1' => $year_11_1,
                        ':year_11_2' => $year_11_2,
                        ':year_11_3' => $year_11_3,
                        ':year_11_total' => $year_11_total,
                        ':year_12_1' => $year_12_1,
                        ':year_12_2' => $year_12_2,
                        ':year_12_3' => $year_12_3,
                        ':year_12_total' => $year_12_total,
                        ':year_13_1' => $year_13_1,
                        ':year_13_2' => $year_13_2,
                        ':year_13_3' => $year_13_3,
                        ':year_13_total' => $year_13_total,
                        ':year_14_1' => $year_14_1,
                        ':year_14_2' => $year_14_2,
                        ':year_14_3' => $year_14_3,
                        ':year_14_total' => $year_14_total,
                        ':year_15_1' => $year_15_1,
                        ':year_15_2' => $year_15_2,
                        ':year_15_3' => $year_15_3,
                        ':year_15_total' => $year_15_total,
                        ':year_16_1' => $year_16_1,
                        ':year_16_2' => $year_16_2,
                        ':year_16_3' => $year_16_3,
                        ':year_16_total' => $year_16_total,
                        ':year_17_1' => $year_17_1,
                        ':year_17_2' => $year_17_2,
                        ':year_17_3' => $year_17_3,
                        ':year_17_total' => $year_17_total,
                        ':budget_project_relevance' => $budget_project_relevance,
                        ':form_no' => $form_no 
                    );
                    $result = insertRow($query, $data);
                    if ($result) {
                        if ($budget_components_details) {
                            if (fetchRows("SELECT * FROM scheme_budget_components_details WHERE scheme_major_project_grant_id = $get_last_record_id")) {
                                deleteRow("DELETE FROM scheme_budget_components_details WHERE scheme_major_project_grant_id = $get_last_record_id");
                            }
                            $query2="INSERT INTO scheme_budget_components_details (scheme_major_project_grant_id, name, description) 
                                        VALUES (:scheme_major_project_grant_id, :name, :description )";
                            foreach ($budget_components_details as $key => $value) {
                                $data2 = array(
                                            ':scheme_major_project_grant_id' => $get_last_record_id,
                                            ':name' => $value['name'],
                                            ':description' => $value['description'],
                                        );
                                insertRow($query2, $data2);
                            }
                        }
                    }
                } else if ($form_no == 9) {
                    $query="UPDATE scheme_major_project_grant 
                            SET is_pi_belong_to_category=:is_pi_belong_to_category, file_category_certificate=:file_category_certificate, is_pi_differently_abled=:is_pi_differently_abled, file_pi_diff_abled_certificate=:file_pi_diff_abled_certificate, 
                                file_pi_certification=:file_pi_certification, file_aadhar_card=:file_aadhar_card, file_principal_endorsement_certificate=:file_principal_endorsement_certificate, file_registrar_endorsement_certificate=:file_registrar_endorsement_certificate, 
                                file_phd_certificate=:file_phd_certificate, file_pi_cv=:file_pi_cv, file_co_pi_cv=:file_pi_cv, form_no=:form_no  
                            WHERE id=$get_last_record_id";
                    $data = array(
                        ':is_pi_belong_to_category' => $is_pi_belong_to_category,
                        ':file_category_certificate' => $file_category_certificate,
                        ':is_pi_differently_abled' => $is_pi_differently_abled,
                        ':file_pi_diff_abled_certificate' => $file_pi_diff_abled_certificate,
                        ':file_pi_certification' => $file_pi_certification,
                        ':file_aadhar_card' => $file_aadhar_card,
                        ':file_principal_endorsement_certificate' => $file_principal_endorsement_certificate,
                        ':file_registrar_endorsement_certificate' => $file_registrar_endorsement_certificate,
                        ':file_phd_certificate' => $file_phd_certificate,
                        ':file_pi_cv' => $file_pi_cv,
                        ':file_co_pi_cv' => $file_co_pi_cv,
                        ':form_no' => $form_no
                    );
                    $result = insertRow($query, $data);
                }
            } else {
                // create
                $query="INSERT INTO scheme_major_project_grant (user_id,application_no,scheme_batch_id,file_profile_picture,proposed_amount,form_no)
                        VALUES (:user_id,:application_no,:scheme_batch_id,:file_profile_picture,:proposed_amount,:form_no)";
                $data = array(
                        ':user_id' => $user_id,
                        ':application_no' => $application_no,
                        ':scheme_batch_id' => $scheme_batch_id,
                        ':file_profile_picture' => $file_profile_picture,
                        ':proposed_amount' => $proposed_amount,
                        ':form_no' => $form_no
                    );
                $result = insertRow($query, $data);
                if($result) {
                    // get last id and fill the related table
                    $query = "SELECT id FROM scheme_major_project_grant ORDER BY id DESC LIMIT 1";
                    $get_last_record_data = fetchRows($query, false);
                    $get_last_record_id = (int)$get_last_record_data["id"];
                    
                    if ($investigator_details) {
                        $query2="INSERT INTO scheme_fellowship_investigator_details (scheme_major_project_grant_id, type, first_name, middle_name, last_name, gender, dob, qualification, designation, official_address, department, specialisation, country_code, phone_no, email ) 
                                        VALUES (:scheme_major_project_grant_id, :type, :first_name, :middle_name, :last_name, :gender, :dob, :qualification, :designation, :official_address, :department, :specialisation, :country_code, :phone_no, :email )";
                        foreach ($investigator_details as $key2 => $value) {
                            $data2 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':type' => $value['type'],
                                        ':first_name' => $value['first_name'],
                                        ':middle_name' => $value['middle_name'],
                                        ':last_name' => $value['last_name'],
                                        ':gender' => $value['gender'],
                                        ':dob' => $value['dob'],
                                        ':qualification' => $value['qualification'],
                                        ':designation' => $value['designation'],
                                        ':official_address' => $value['official_address'],
                                        ':department' => $value['department'],
                                        ':specialisation' => $value['specialisation'],
                                        ':country_code' => $value['country_code'],
                                        ':phone_no' => $value['phone_no'],
                                        ':email' => $value['email']
                                    );
                            insertRow($query2, $data2);
                        }
                    }
                    if ($institution_details) {
                        $query3="INSERT INTO scheme_institution_details (scheme_major_project_grant_id, name, address) 
                                    VALUES (:scheme_major_project_grant_id, :name, :address )";
                        foreach ($institution_details as $key3 => $value) {
                            $data3 = array(
                                        ':scheme_major_project_grant_id' => $get_last_record_id,
                                        ':name' => $value['name'],
                                        ':address' => $value['address'],
                                    );
                            insertRow($query3, $data3);
                        }
                    }
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
            $query="UPDATE scheme_major_project_grant SET form_status=:form_status WHERE id=$get_last_record_id";
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
                $scheme_name = "GSRF Major Research Grant Scheme";
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
                    // $resMessage = 'The submission of your form was completed successfully!';
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
                    ':title' => 'GSRF Major Research Grant Scheme, application submitted by '.$name,
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
        // http://localhost/gsrf/api/schemeMajorResearchProjectApi.php?id=18&token=cLeAn4MAJQrU5Y7In2ksd

        $id = $_GET['id'];
        $token = $_GET['token'];
        $result = true;

        if ($token=="cLeAn4MAJQrU5Y7In2ksd") {
            $data = fetchRows("SELECT id, 
                                    file_application_form,
                                    file_methodology,
                                    file_time_schedule, 
                                    file_category_certificate, 
                                    file_pi_diff_abled_certificate, 
                                    file_pi_certification, 
                                    file_principal_endorsement_certificate, 
                                    file_pi_cv, 
                                    file_co_pi_cv 
                                FROM scheme_major_project_grant WHERE id = $id", false);
            if ($data) {
                if ($data['file_application_form']) {
                    if (unlink($base_path.$data['file_application_form'])) { } else { $result = false; }
                }
                if ($data['file_methodology']) {
                    if (unlink($base_path.$data['file_methodology'])) { } else { $result = false; }
                }
                if ($data['file_time_schedule']) {
                    if (unlink($base_path.$data['file_time_schedule'])) { } else { $result = false; }
                }
                if ($data['file_category_certificate']) {
                    if (unlink($base_path.$data['file_category_certificate'])) { } else { $result = false; }
                }
                if ($data['file_pi_diff_abled_certificate']) {
                    if (unlink($base_path.$data['file_pi_diff_abled_certificate'])) { } else { $result = false; }
                }
                if ($data['file_pi_certification']) {
                    if (unlink($base_path.$data['file_pi_certification'])) { } else { $result = false; }
                }
                if ($data['file_principal_endorsement_certificate']) {
                    if (unlink($base_path.$data['file_principal_endorsement_certificate'])) { } else { $result = false; }
                }
                if ($data['file_pi_cv']) {
                    if (unlink($base_path.$data['file_pi_cv'])) { } else { $result = false; }
                }
                if ($data['file_co_pi_cv']) {
                    if (unlink($base_path.$data['file_co_pi_cv'])) { } else { $result = false; }
                }

                if ($result) {
                    deleteRow("DELETE FROM scheme_major_project_grant WHERE id=$id");
                    deleteRow("DELETE FROM scheme_equipment_details WHERE scheme_major_project_grant_id=$id");
                    deleteRow("DELETE FROM scheme_fellowship_investigator_details WHERE scheme_major_project_grant_id=$id");
                    deleteRow("DELETE FROM scheme_important_publications_details WHERE scheme_major_project_grant_id=$id");
                    deleteRow("DELETE FROM scheme_institution_details WHERE scheme_major_project_grant_id=$id");
                    deleteRow("DELETE FROM scheme_investigators_role_details WHERE scheme_major_project_grant_id=$id");
                    deleteRow("DELETE FROM scheme_infrastructural_facility_details WHERE scheme_major_project_grant_id=$id");
                    deleteRow("DELETE FROM scheme_project_details WHERE scheme_major_project_grant_id=$id");
                    deleteRow("DELETE FROM scheme_project_outcome_interested_expert_details WHERE scheme_major_project_grant_id=$id");
                    
                    echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Success!', 'data'=> $data]); exit;
                } else {
                    echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Error in deleting files!', 'data'=> $data]); exit;
                }
            } else {
                echo json_encode(['flag'=>false, 'status'=>'401', 'message'=>'No data found.']); exit;
            }
        } else if ($token=="tRash4MAJQrU5Y7In2ksd") {
            # code...
        } else {
            echo json_encode(['flag'=>false, 'status'=>'501', 'message'=>'Invalid Token !']); exit;
        }
    }

?>