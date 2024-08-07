<?php
// require_once '../data/generalData.php'; 
// require_once '../admin_assets/includes/email_template.php';
// require_once '../admin_assets/api/schemeApplicationStatusApiData.php';

$admin_type = '';
if (isset($_SESSION['admin_type'])) {
	$admin_type = $_SESSION['admin_type'];
}

// DF, RSG, MIN, 
// $scheme_listing = $_GET['sl'] ?? '';
$today = new DateTime(); // Get the current date and time
$year = $today->format('Y'); // Get the current year

$selectedYear = isset($_SESSION['selectedYear']) ? $_SESSION['selectedYear'] : "";
$page = isset($_SESSION['page']) ? $_SESSION['page'] : "";
$query = isset($_SESSION['search']) ? $_SESSION['search'] : "";
$queryFbAppStatus = isset($_SESSION['fb_app_status']) ? $_SESSION['fb_app_status'] : "";
$schemeBatchId = isset($_SESSION['schemeBatch']) ? $_SESSION['schemeBatch'] : "";

$_SESSION["selectedYear"] = isset($_GET['yearlydata']) ? $_GET['yearlydata'] : $selectedYear; 
$_SESSION["page"] = isset($_GET['page']) ? $_GET['page'] : $page; 
$_SESSION["search"] = isset($_GET['search']) ? $_GET['search'] : $query;
$_SESSION["fb_app_status"] = isset($_GET['fb_app_status']) ? $_GET['fb_app_status'] : $queryFbAppStatus; 
$_SESSION["schemeBatch"] = isset($_GET['schemeBatch']) ? $_GET['schemeBatch'] : $schemeBatchId; 

$selectedYear = $_SESSION["selectedYear"] ?? $year;
$currentPage = $_SESSION["page"]==0 || $_SESSION["page"]=='' ? 1 : $_SESSION["page"];
$query = $_SESSION["search"];
$queryFbAppStatus = $_SESSION["fb_app_status"] ?? "";
$schemeBatchId = $_SESSION["schemeBatch"] ?? "";

// CDFA($_SESSION);

switch ($scheme_listing) {
    case 'GURODFUYRT':  $scheme_table = 'scheme_doctoral_fellowship';
                // $file_name = 'scheme_listing.php?sl=GURODFUYRT';
                $file_name = 'scheme_doctoral_fellowship.php';
                $site_map_title = 'Doctoral Fellowship Applications';
                $page_title = 'Doctoral Fellowship List';
                $scheme_name = 'GSRF Doctoral Fellowship Scheme';
                break;
    case 'GUROPDFUYRT':  $scheme_table = 'scheme_post_doctoral_fellowship';
                // $file_name = 'scheme_listing.php?sl=GUROPDFUYRT';
                $file_name = 'scheme_post_doctoral_fellowship.php';
                $site_map_title = 'Post-Doctoral Fellowship Applications';
                $page_title = 'Post-Doctoral Fellowship List';
                $scheme_name = 'GSRF Post-Doctoral Fellowship Scheme';
                break;
    case 'GURORSGUYRT': $scheme_table = 'scheme_research_startup_grant';
                // $file_name = 'scheme_listing.php?sl=GURORSGUYRT';
                $file_name = 'scheme_research_startup_grant.php';
                $site_map_title = 'Research Start-Up Grant Scheme';
                $page_title = 'Startup Grant List';
                $scheme_name = 'GSRF Research Start-Up Grant Scheme';
                break;
    case 'GUROMINUYRT': $scheme_table = 'scheme_minor_project_grant';
                // $file_name = 'scheme_listing.php?sl=GUROMINUYRT';
                $file_name = 'scheme_minor_project_grant.php';
                $site_map_title = 'Minor Research Grant Scheme';
                $page_title = 'Minor Project List';
                $scheme_name = 'GSRF Minor Research Grant Scheme';
                break;
    case 'GUROMAJUYRT': $scheme_table = 'scheme_major_project_grant';
                // $file_name = 'scheme_listing.php?sl=GUROMAJUYRT';
                $file_name = 'scheme_major_project_grant.php';
                $site_map_title = 'Major Research Grant Scheme';
                $page_title = 'Major Project List';
                $scheme_name = 'GSRF Major Research Grant Scheme';
                break;
    case 'GUROSSUYRT': $scheme_table = 'scheme_summer_school';
                // $file_name = 'scheme_listing.php?sl=GUROSSUYRT';
                $file_name = 'scheme_summer_school.php';
                $site_map_title = 'Summer/Winter School Scheme';
                $page_title = 'Summer Scheme List';
                $scheme_name = 'GSRF Summer/Winter School Scheme';
                break;
    default:  header('Location: index.php');
            break;
}

switch ($scheme_table) {
    case 'scheme_major_project_grant': $scheme_title = "s.proposal_title AS scm_title,"; break;
    case 'scheme_minor_project_grant': $scheme_title = "s.proposal_title AS scm_title,"; break;
    case 'scheme_research_startup_grant': $scheme_title = "s.thesis_title AS scm_title,"; break;
    case 'scheme_doctoral_fellowship': $scheme_title = "s.proposed_work AS scm_title,"; break;
    case 'scheme_summer_school': $scheme_title = "s.scheme_title AS scm_title,"; break;
    case 'scheme_post_doctoral_fellowship': $scheme_title = "s.phd_thesis AS scm_title,"; break;
    default: $scheme_title = ""; break;
}

function getEmailData($typeId) {
    if ($typeId) {
        $db = getDbInstance();
        $db->where("type", $typeId);
        $db->where("status", 1);
        $email = $db->getOne("emails", "subject, content");
    } else {
        $email = ["subject" => "No Data Found", "content" => "No Data Found"];
    }
    return $email;
}
$typeId = '';

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$modalId = "";
$log_data = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_to_store = filter_input_array(INPUT_POST);

    $email_subject = isset($data_to_store['email_subject']) ? $data_to_store['email_subject'] : null;
    unset($data_to_store['email_subject']);
    $email_content = isset($data_to_store['email_content']) ? $data_to_store['email_content'] : null;
    unset($data_to_store['email_content']);

    if (isset($data_to_store['application_no'])) {
        $application_no = $data_to_store['application_no'];
    }
    if (isset($data_to_store['rev_id'])) {
        $rev_id = $data_to_store['rev_id'];
    }
    
    if (isset($_POST["assign-reviewer-submit"])) {
        unset($data_to_store['assign-reviewer-submit']);
        
        $scm_title = $data_to_store['scm_title'] ? $data_to_store['scm_title'] : '';
        unset($data_to_store['scm_title']);
        
        //Check whether the user name already exists
        $db = getDbInstance();
        $check_ra_exist = $db
            ->where('application_no', $application_no)
            ->where('reviewer_id', $data_to_store['reviewer_id'])
            ->get('reviewers_assigned', null, 'id, application_no, reviewer_id, due_date, feedbackGiven, status');

        $db = getDbInstance();
        $check_ra = $db
            ->where('application_no', $application_no)
            ->where('status', 1)
            ->get('reviewers_assigned', null, 'reviewer_id');

        if (count($check_ra_exist)>=1) {
            $_SESSION['failure'] = "Application already assigned, Please select other reviewer";
        } else {
            if (count($check_ra)>=2) { 
                $_SESSION['info'] = "The application has achieved its maximum reviewer limit.";

            } else if (isset($check_ra[0]) && $check_ra[0]['reviewer_id'] == $data_to_store['reviewer_id']) {
                $_SESSION['failure'] = "Application already assigned, Please select other reviewer";
                $modalId = "reviewer-assign-" . $application_no;

            } else {
                $db = getDbInstance();
                $last_id = $db->insert('reviewers_assigned', $data_to_store);

                // get the selected reviewer data
                $db = getDbInstance();
                $reviewer = $db->where("id", $data_to_store['reviewer_id'])->getOne('reviewers');

                $db = getDbInstance();
                $reviewer_pass = $db->where('user_id', $data_to_store['reviewer_id'])
                    ->where('type', 'Reviewer')
                    ->getOne('users_to_user', 'name');

                if ($last_id) {
                    $due_date = date('d-m-Y',strtotime($data_to_store['due_date']));
                    // set email variables to replace
                    $placeholders = array('$scheme_name', '$scm_title', '$application_no', '$due_date', '$hostUrl', '$reviewer_email', '$reviewer_password');
                    $values = array($site_map_title, $scm_title, $application_no, $due_date, $hostUrl, $reviewer["email"], $reviewer_pass['name']);
                    
                    // $timestamp = strtotime($data_to_store['due_date']);
                    $subject = str_replace('$scheme_name', $site_map_title, $email_subject);
                    $content = $email_template_head_before_title;
                    $content .= "<title>".$subject."</title>";
                    $content .= $email_template_head_after_title;
                    // $email_content = '
                        //             <p>Dear Sir/Madam,</p>

                        //             <p>Thank you for agreeing to review the GSRF '.$site_map_title.' Proposal despite your busy schedule.</p>

                        //             <h2>We request you to review the following proposal:</h2>
                        //             <ul>';
                        //                 if ($scm_title) {
                        //                     $email_content .= '<li><strong>Title : </strong> '.$scm_title.'</li>';
                        //                 }
                        // $email_content .= '
                        //                 <li><strong>Application No : </strong> '.$application_no .'</li>
                        //                 <li><strong>Due Date : </strong> '.$due_date.'</li>
                        //             </ul>

                        //             <p>As the grant-providing process is time-bound, please review it as soon as possible but by the due date.</p>
                                    
                        //             <p>If the project is RECOMMENDED, we request that you go through the Budget details and provide your critical input for each item in the budget. Please suggest an appropriate budget for any or all of the headings under the budget. If the project is NOT RECOMMENDED, please provide the reasons for doing so.</p>
                                    
                        //             <p>Please follow the link and credentials given below to log in.</p>
                        //             <p>Link : <a href="'.$hostUrl.'/reviewer-admin/login.php" target="_blank">Reviewer Admin Dashboard</a> </p>';

                        // $email_content .= '
                        //             <h2>Credentials : </h2>
                        //             <ul>
                        //                 <li><strong>Login Id : </strong> '.$reviewer["email"].'</li>
                        //                 <li><strong>Password : </strong> '.$reviewer_pass['name'].'</li>
                        //             </ul>
                                    
                        //             <p>We are looking forward to your review of the proposal. Please note that once submitted, you cannot view the review.</p>

                        //             <p>Yours sincerely,</p>

                        //             <p>(Dr Manoj M. Ibrampurkar) <br> 
                        //             Nodal Officer(Schemes)</p>
                        //         ';
                    // $content .= $email_content;
                    $content .= str_replace($placeholders, $values, $email_content);
                    $content .= $email_template_footer;
                    $response = smtp_mailer($reviewer['email'], $subject, $content);
                    if ($response) {
                        $log_data = [
                            'log_type' => 'Message',
                            'sender_id' => cuid(),
                            'sent_by' => $admin_type,
                            'application_no' => $application_no,
                            'title' => 'Assigned task to the Reviewer, '.$reviewer['name'],
                            'receiver' => 'Reviewer',
                            'sent_from' => '',
                            'sent_to' => $reviewer['email'],
                            'subject' => $subject,
                            'message' => contentFromHtmlBody($content),
                        ];
                    }
                    $_SESSION['success'] = "Reviewer assigned Successfully!";
                }
            }
        }

    } else if (isset($_POST["extending-review-due-date-submit"])) {
        unset($data_to_store['extending-review-due-date-submit']);
        
        $scm_title = $data_to_store['scm_title'] ? $data_to_store['scm_title'] : '';
        unset($data_to_store['scm_title']);
        
        $db = getDbInstance();
        $db->where('application_no', $application_no);
        $db->where('reviewer_id', $data_to_store['reviewer_id']);
        $last_id = $db->update('reviewers_assigned', ['due_date' => $data_to_store['due_date']]);

        // get the selected reviewer data
        $db = getDbInstance();
        $reviewer = $db->where("id", $data_to_store['reviewer_id'])->getOne('reviewers');

        $db = getDbInstance();
        $reviewer_pass = $db->where('user_id', $data_to_store['reviewer_id'])
            ->where('type', 'Reviewer')
            ->getOne('users_to_user', 'name');

        if ($last_id) {
            $due_date = date('d-m-Y',strtotime($data_to_store['due_date']));
            // set email variables to replace
            $placeholders = array('$scm_title', '$application_no', '$due_date', '$hostUrl', '$reviewer_email', '$reviewer_password');
            $values = array($scm_title, $application_no, $due_date, $hostUrl, $reviewer["email"], $reviewer_pass['name']);

            // $timestamp = strtotime($data_to_store['due_date']);
            $subject = $email_subject;
            $content = $email_template_head_before_title;
            $content .= "<title>".$subject."</title>";
            $content .= $email_template_head_after_title;
            // $email_content = '
                //             <p>Dear Sir/Madam,</p>
                            
                //             <p>I hope this message finds you well. I am writing to formally inform you of a modification to the due date for the task assigned to you. The new deadline is now set for <strong>'.date('d-m-Y',strtotime($data_to_store['due_date'])).'</strong>.</p>

                //             <h2>We request you to review the following proposal:</h2>
                //             <ul>';
                //                 if ($scm_title) {
                //                     $email_content .= '<li><strong>Title : </strong> '.$scm_title.'</li>';
                //                 }
                // $email_content .= '
                //                 <li><strong>Application No : </strong> '.$application_no .'</li>
                //                 <li><strong>Due Date : </strong> '.date('d-m-Y',strtotime($data_to_store['due_date'])).'</li>
                //             </ul>

                //             <p>As the grant-providing process is time-bound, please review it as soon as possible but by the due date.</p>
                            
                //             <p>If the project is RECOMMENDED, we request that you go through the Budget details and provide your critical input for each item in the budget. Please suggest an appropriate budget for any or all of the headings under the budget. If the project is NOT RECOMMENDED, please provide the reasons for doing so.</p>
                            
                //             <p>Please follow the link and credentials given below to log in.</p>
                //             <p>Link : <a href="'.$hostUrl.'/reviewer-admin/login.php" target="_blank">Reviewer Admin Dashboard</a> </p>

                //             <h2>Credentials : </h2>
                //             <ul>
                //                 <li><strong>Login Id : </strong> '.$reviewer["email"].'</li>
                //                 <li><strong>Password : </strong> '.$reviewer_pass['name'].'</li>
                //             </ul>
                            
                //             <p>We are looking forward to your review of the proposal. Please note that once submitted, you cannot view the review.</p>

                //             <p>Yours sincerely,</p>

                //             <p>(Dr Manoj M. Ibrampurkar) <br> 
                //             Nodal Officer(Schemes)</p>
                //         ';
            // $content .= $email_content;
            $content .= str_replace($placeholders, $values, $email_content);
            $content .= $email_template_footer;
            $response = smtp_mailer($reviewer['email'], $subject, $content);
            if ($response) {
                $log_data = [
                    'log_type' => 'Message',
                    'sender_id' => cuid(),
                    'sent_by' => $admin_type,
                    'application_no' => $application_no,
                    'title' => 'Re-Assigned Due Date for the task allocated to the Reviewer, '.$reviewer['name'],
                    'receiver' => 'Reviewer',
                    'sent_from' => '',
                    'sent_to' => $reviewer['email'],
                    'subject' => $subject,
                    'message' => contentFromHtmlBody($content),
                ];
            }
            $_SESSION['success'] = "Reviewer Task Due-Date Updated Successfully!";
        }

    } else if (isset($_POST["update-reviewer-task-assignment"])) {
        unset($data_to_store['update-reviewer-task-assignment']);
        // delete task or undo the deleted task for reviewer
        $isUpdateRAStatus = false;
        $rev_status = $data_to_store['ra_status'];
        if ($rev_status==1) {
            $db = getDbInstance();
            $check_ra = $db
                ->where('application_no', $application_no)
                ->where('status', 1)
                ->get('reviewers_assigned', null, 'reviewer_id');

            if (count($check_ra)>=2) { 
                $_SESSION['failure'] = "The application has achieved its maximum reviewer limit. Please Delete previous Reviewer before assigning new.";
            } else {
                $isUpdateRAStatus = true;
                $msg_type = "success"; 
                $msg = "Reviewer ".$data_to_store['rev_name'].", has been re-assigned the Task.";
            }
        } else {
            $isUpdateRAStatus = true;
            $msg_type = "failure"; 
            $msg = "Reviewer ".$data_to_store['rev_name'].", has been removed from the assigned Task.";
        }

        if ($isUpdateRAStatus == true) {
            $data = ['status' => $rev_status];
            $db = getDbInstance();
            $db->where('id', $data_to_store['ra_id']);
            $result = $db->update('reviewers_assigned', $data);
            
            // set email variables to replace
            $placeholders = array('$rev_user_name', '$application_no');
            $values = array($data_to_store['rev_name'], $application_no);

            if ($result) {
                // $subject = $email_subject;
                $subject = str_replace('$application_no', $application_no, $email_subject);
                $content = $email_template_head_before_title;
                $content .= "<title>".$subject."</title>";
                $content .= $email_template_head_after_title;
                // $content .= $email_content;
                $content .= str_replace($placeholders, $values, $email_content);
                $content .= $email_template_footer;
                $response = smtp_mailer($data_to_store['rev_email'], $subject, $content);
                if ($response) {
                    $log_data = [
                        'log_type' => 'Message',
                        'sender_id' => cuid(),
                        'sent_by' => $admin_type,
                        'application_no' => $application_no,
                        'title' => $msg,
                        'receiver' => 'Reviewer',
                        'sent_from' => '',
                        'sent_to' => $data_to_store['rev_email'],
                        'subject' => $subject,
                        'message' => contentFromHtmlBody($content),
                    ];
                }
                $_SESSION[$msg_type] = $msg;
            } else {
                $_SESSION["failure"] = "Failed to update record, Please contact developer to resolve the issue.";
            }
        }

    } else if (isset($_POST["email-reminder"])) {
        unset($data_to_store['email-reminder']);

        $subject = $email_subject;
        $content = $email_template_head_before_title;
        $content .= '<title>' . $subject . '</title>';
        $content .= $email_template_head_after_title;
        $content .= $email_content;
        $content .= $email_template_footer;
        $response = smtp_mailer($data_to_store['mail_to_rem'], $subject, $content);
        if ($response) {
            $log_data = [
                'log_type' => 'Message',
                'sender_id' => cuid(),
                'sent_by' => $admin_type,
                'application_no' => $application_no,
                'title' => 'Application Review Task Reminder Sent to, '.$data_to_store['reviewer_name_rem'],
                'receiver' => 'Reviewer',
                'sent_from' => '',
                'sent_to' => $data_to_store['mail_to_rem'],
                'subject' => $subject,
                'message' => contentFromHtmlBody($content),
            ];
        }
        // $_SESSION['success'] = "Reminder Mail Sent Successfully!";

    } else if (isset($_POST["application-status-update"])) {
        unset($data_to_store['application-status-update']);

        $feedback_status = $data_to_store['feedback_status'];
        $app_status_remarks = $data_to_store['app_status_remarks'];

        if ($feedback_status==1) {
            $_SESSION['warning'] = "Please select Application Status!";
        } else {
            $data = array('feedbackGiven' => $feedback_status);
            $db = getDbInstance();
            $db->where('application_no', $application_no);
            $db->where('reviewer_id', $rev_id);
            $db->update('reviewers_assigned', $data);

            $data = array('remarks' => $app_status_remarks);
            $db = getDbInstance();
            $db->where('application_id', $application_no);
            $db->where('reviewer_id', $rev_id);
            $db->update('reviewers_feedback', $data);

            $_SESSION['success'] = "Saved response for Application Status!";
        }
    
    } else if (isset($_POST["application-status-response"])) {
        unset($data_to_store['application-status-response']);

        $app_feedback_status = $data_to_store['app_feedback_status'];

        $db = getDbInstance();
        $data = array('app_status_response' => 1);
        $db->where('application_id', $application_no);
        $db->where('reviewer_id', $rev_id);
        $db->update('reviewers_feedback', $data);

        $subject = $email_subject;
        $content = $email_template_head_before_title;
        $content .= "<title>".$subject."</title>";
        $content .= $email_template_head_after_title;
        $content .= $email_content;
        $content .= $email_template_footer;
        $response = smtp_mailer($data_to_store['candidate_mail'], $subject, $content);
        if ($response) {
            $log_data = [
                'log_type' => 'Message',
                'sender_id' => cuid(),
                'sent_by' => $admin_type,
                'application_no' => $application_no,
                'title' => 'Application Status has been Sent to Candidate, '. $data_to_store['candidate_name'],
                'receiver' => 'Candidate',
                'sent_from' => '',
                'sent_to' => $data_to_store['candidate_mail'],
                'subject' => $subject,
                'message' => contentFromHtmlBody($content),
            ];
        }
        $_SESSION['success'] = "Application Status has been Sent to Candidate !";

    } else if (isset($_POST["user-notification-email"])) {
        unset($data_to_store['user-notification-email']);

        $subject = $email_subject;
        $content = $email_template_head_before_title;
        $content .= "<title>".$subject."</title>";
        $content .= $email_template_head_after_title;
        $content .= $email_content;
        $content .= $email_template_footer;
        $response = smtp_mailer($data_to_store['candidate_mail'], $subject, $content);
        if ($response) {
            $log_data = [
                'log_type' => 'Message',
                'sender_id' => cuid(),
                'sent_by' => $admin_type,
                'application_no' => $application_no,
                'title' => 'Notification has been Sent to Candidate, '. $data_to_store['candidate_name'],
                'receiver' => 'Candidate',
                'sent_from' => '',
                'sent_to' => $data_to_store['candidate_mail'],
                'subject' => $subject,
                'message' => contentFromHtmlBody($content),
            ];
        }
        $_SESSION['success'] = "Notification has been Sent to Candidate.";
    }
    if ($log_data) {
        $db = getDbInstance();
        $save_conversation = $db->insert('communication_log', $log_data);
        $_SESSION['info'] = "Email sent Successfully!";
    }

    header("Refresh:2, ?yearlydata=$selectedYear&schemeBatch=$schemeBatchId&search=$query&fb_app_status=$queryFbAppStatus&page=$currentPage");
}

$db = getDbInstance();
$db->orderBy('name', 'ASC');
$reviewers = $db->get("reviewers");

$query = $query ? trim($query) : '';
if ($query!='') {
    $_SESSION['info'] = "Search result !";
}

// get scheme type
$db = getDbInstance();
$db->where("code", trimSchemeListingStringCode($scheme_listing));
$scheme_types_data = $db->get("scheme_types", null, "id");

// get scheme_batch
$db = getDbInstance();
$db->where("scheme_types_id", $scheme_types_data[0]['id']);
if ($GLOBALS['selectedYear']) {
    $db->where(
        "(YEAR(created_at) =". $GLOBALS['selectedYear']."
        OR SUBSTRING(batch_no, 1, 4) = ". $GLOBALS['selectedYear'] .")"
    );
}
$scheme_batch_data = $db->get("scheme_batch", null, "id, batch_no");


$db = getDbInstance();
// set page limit to 2 results per page. 20 by default
$db->pageLimit = 10;
$db->where("s.status", 1);
$db->where("s.form_status", 1);
if ($GLOBALS['selectedYear']) {
    $db->where('YEAR(s.created_at)', $GLOBALS['selectedYear']);
}
if ($schemeBatchId) {
    $db->where('scheme_batch_id', $schemeBatchId);
}
// Additional condition for reviewer assigned table status
// $db->where("(ra.id IS NULL OR (ra.status = 1 AND ra.id IS NOT NULL))");
$db->where(
    "(s.application_no LIKE '%" . $query . "%' 
    OR usr.first_name LIKE '%" . $query . "%' 
    OR usr.last_name LIKE '%" . $query . "%' 
    OR CONCAT(usr.first_name, ' ', usr.last_name) LIKE '%" . $query . "%'
    OR CONCAT(usr.first_name, ' ', COALESCE(usr.middle_name, ' '), ' ', usr.last_name) LIKE '%" . $query . "%'
    )"
);
if ($queryFbAppStatus || $queryFbAppStatus==0) {
    $db->where("ra.feedbackGiven", $queryFbAppStatus);
    $db->where("ra.status", 1);
}
$db->orderBy("s.application_no", "DESC");

$records = $db
->join('users usr', 's.user_id = usr.id', 'LEFT')
->join('reviewers_assigned ra', 's.application_no = ra.application_no', 'LEFT')
->join('reviewers_feedback rev_fb', 's.application_no = rev_fb.application_id AND ra.reviewer_id = rev_fb.reviewer_id', 'LEFT')
->join('reviewers rev', 'ra.reviewer_id = rev.id', 'LEFT')
->arraybuilder()
->paginate($scheme_table." s", $currentPage, 's.id AS s_id, s.application_no, s.file_application_form, s.updated_at AS submitted_date, '.$scheme_title.' 
                        usr.id AS usr_id, usr.user_uid, usr.first_name, usr.middle_name, usr.last_name, usr.email, usr.phone_no, 
                        ra.id AS ra_id, ra.due_date AS ra_due_date, ra.feedbackGiven AS ra_feedbackGiven, ra.reviewer_id AS ra_reviewer_id, ra.status AS ra_status, 
                        rev_fb.id AS rev_fb_id, rev_fb.app_status_response AS rev_fb_app_status_response,
                        rev.id AS rev_id, rev.name AS rev_name, rev.email AS rev_email
                    ');
// echo '<pre>';print_r($records);exit;

$search_placeholder = 'Search Candidate ID or Name';

?>