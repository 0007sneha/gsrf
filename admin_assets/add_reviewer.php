<?php
// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';
// require_once '../config/send_email.php';
// require_once '../config/be_function.php';
// require_once '../data/generalData.php'; 

// $cuid = CUID();
// $created_by = CUIDWithType(); // scheme admin
// $created_by = "SUPA" . $cuid; // super admin 

// line to add 
    // require_once '../admin_assets/includes/email_template.php';
    // require '../admin_assets/add_reviewer.php';

$admin_type = '';
if (isset($_SESSION['admin_type'])) {
	$admin_type = $_SESSION['admin_type'];
}

$db = getDbInstance();

$action = $_GET['action'] ?? 'create';
$id = $_GET['id'] ?? null;
$updateData = null;

function getData($key)
{
    global $updateData;
    return $updateData != null ? $updateData[$key] : null;
}

if ($action == "update" && $id != null) {
    $updateData = $db->where('id', $id)->getOne('reviewers');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_to_store = filter_input_array(INPUT_POST);
    $password = generatePassword();
    $updateId = $data_to_store['update-id'] ?? null; 
    $data_to_store['password'] = password_hash($password, PASSWORD_DEFAULT);

    unset($data_to_store['update-id']);
    unset($data_to_store['change_password']);

    if ($updateId == null) {
        $db->where('email', $data_to_store['email']);
        $db->get('reviewers');
        if ($db->count >= 1) {
            $_SESSION['failure'] = "Email already exists";
            header('location: add_reviewer.php');
            exit();
        }

        $data_to_store['createdBy'] = $created_by;

        //reset db instance
        $db = getDbInstance();
        $last_id = $db->insert('reviewers', $data_to_store);

        $db = getDbInstance();
        $data_to_users = [
            'user_id' => $last_id,
            'type' => 'Reviewer',
            'name' => $password,
            'description' => 'created',
        ];
        $db->insert('users_to_user', $data_to_users);

        $db = getDbInstance();
        $db->where("type", 6);
        $db->where("status", 1);
        $email = $db->getOne("emails", "subject, content");
        // set email variables to replace
        $placeholders = array('$prefix', '$user_name', '$user_email', '$password', '$hostUrl');
        $values = array($data_to_store['prefix'], $data_to_store['name'], $data_to_store['email'], $password, $hostUrl);

        $_SESSION['success'] = "Reviewer added successfully!";
        // $subject = "Welcome! Your Account has been Created as a Reviewer";
        $subject = $email['subject'];
        $content = $email_template_head_before_title;
        $content .= "<title>".$subject."</title>";
        $content .= $email_template_head_after_title;
        // $content .= '
            //             <h1>Welcome! Your Account has been Created as a Reviewer</h1>

            //             <p>Dear '.$data_to_store['prefix'].' '.$data_to_store['name'].',</p>

            //             <p>Thank you for accepting to serve as a reviewer. We are excited to welcome you to our team as a valued member and reviewer! Your account has been successfully created, and we\'re thrilled to have you on board.</p>

            //             <p>Please follow the link and credentials given below to log in.</p>
            //             <p>Link : <a href="'.$hostUrl.'/reviewer-admin/login.php" target="_blank">Reviewer Admin Dashboard</a> </p>

            //             <h2>Your Login Credentials:</h2>
            //             <ol>
            //                 <li><strong>User Id:</strong> '.$data_to_store['email'].'</li>
            //                 <li><strong>Password:</strong> '.$password.'</li>
            //             </ol>

            //             <h2>Your Role as a Reviewer:</h2>
            //             <p>As a reviewer, you will objectively assess the research project proposals from their title to the outcome through objectives, contemporariness, literature review, methods, expertise, time frame and outcome. For each of these components, you will be basically assigning a score out of 10. Finally, you will be either recommending the proposal or not. If you are recommending, you will be commenting on each component of the budget and, if required, suggesting an appropriate figure for each component. If the project is not recommended you will be giving reasons for the same.</p>

            //             <h2>What to Expect:</h2>
            //             <p>You will be getting an email or a couple of emails requesting you to review the assigned proposals. Usually, it will not exceed two and the link(s) to the login will be provided in the mail.  Your objective review will help us to fund high-quality research proposals. As it is a time-bound process, we count on your timely review by the due date, though we will be delighted to receive the online review</p>

            //             <h2>How to Get Started:</h2>
            //             <ol>
            //                 <li><strong>Check Your Email : </strong> Please check your email inbox for notifications about newly assigned tasks.</li>
            //                 <li><strong>Access the Review Platform:</strong> You will receive login credentials and instructions on accessing our review platform. Please log in and familiarise yourself with the interface.</li>
            //                 <li><strong>Review form : </strong> An online Review form will be available for each of the proposals. Please review them carefully before starting your work.</li>
            //                 <li><strong>Proposals : </strong> You can download and go through the proposal or you can view it online and fill out the form.</li>
            //                 <li><strong>Submit Feedback : </strong> After reviewing an application or project, use the provided platform to submit your feedback and comments.</li>
            //                 <li><strong>Stay Connected : </strong> Feel free to contact our team with any questions or need assistance. We are here to support you throughout your role as a reviewer.</li>
            //             </ol>

            //             <h2>Your Contribution Matters:</h2>
            //             <p>Your role as a reviewer is vital to our commitment to excellence. Your insights and feedback will help shape the future of our projects and ensure that we continue to fund high-quality project proposals.</p>
                        
            //             <p>Once again, welcome to our team! We are excited to have you on board and look forward to working together in promoting research.</p>
                        
            //             <p>If you have any questions or require further information, please don\'t hesitate to contact us on gsrf.schemes@gmail.com</p>
                        
            //             <p>Thank you for being a part of our team and for your dedication to helping us improve.</p>
            //             ';
        // $content .= $email_body_footer;
        $content .= str_replace($placeholders, $values, $email['content']);
        $content .= $email_template_footer;
        $response = smtp_mailer($data_to_store['email'], $subject, $content);
        if ($response) {
            $log_data = [
                'log_type' => 'Account',
                'sender_id' => $cuid,
                'sent_by' => $admin_type,
                'application_no' => '',
                'title' => 'Reviewer account created for '.$data_to_store['name'],
                'receiver' => 'Reviewer',
                'sent_from' => '',
                'sent_to' => $data_to_store['email'],
                'subject' => $subject,
                'message' => contentFromHtmlBody($content),
            ];
            $db = getDbInstance();
            $save_conversation = $db->insert('communication_log', $log_data);
            header('location: add_reviewer.php');
            exit();
        }
    } else {
        if(!$_POST['change_password']) {
            unset($data_to_store['password']);
        }
        $last_id = $db->where('id', $updateId)->update('reviewers', $data_to_store);

        $db = getDbInstance();
        $db->where('user_id', $updateId)
            ->where('type', 'Reviewer')
            ->update('users_to_user', ['name'=>$password, 'description' => 'updated']);
        
        if($_POST['change_password']){
            $db = getDbInstance();
            $db->where("type", 4);
            $db->where("status", 1);
            $email = $db->getOne("emails", "subject, content");
            // set email variables to replace
            $placeholders = array('$hostUrl', '$user_email', '$password');
            $values = array($hostUrl, $data_to_store['email'], $password);
            
            // $subject = "Password Update Confirmation";
            $subject = $email['subject'];
            $content = $email_template_head_before_title;
            $content .= "<title>".$subject."</title>";
            $content .= $email_template_head_after_title;
            // $content .= '
                //old message
                //             <p>Dear '.$data_to_store['prefix'].' '.$data_to_store['name'].',</p>

                //             <p>I hope this message finds you well. This is to confirm that your password has been successfully updated as per your recent request. Your account security is our top priority, and we appreciate your proactive approach to managing your login credentials.</p>

                            // <p>Please follow the link and credentials given below to log in.</p>
                            // <p>Link : <a href="'.$hostUrl.'/reviewer-admin/login.php" target="_blank">Reviewer Admin Dashboard</a> </p>

                //             <h2>Your Updated Login Credentials:</h2>
                //             <ol>
                //                 <li><strong>User Id:</strong> '.$data_to_store['email'].'</li>
                //                 <li><strong>Password:</strong> '.$password.'</li>
                //             </ol>

                //             <p>If you did not initiate this password change or if you have any concerns regarding the security of your account, please contact our support team immediately at office.gsrf@gmail.com. We are here to assist you and ensure the safety of your account.</p>

                //             <p>Thank you for your cooperation and commitment to maintaining a secure online environment.</p>
                //         '; //old message
            // $content .= '
                //             <p>Dear Sir/Madam,</p>

                //             <p>We trust this message finds you well. Please be informed that the password provided earlier encountered an encryption issue. Consequently, we have taken action to reset it. </p>
                            
                //             <p>Please follow the link and credentials given below to log in.</p>
                //             <p>Link : <a href="'.$hostUrl.'/reviewer-admin/login.php" target="_blank">Reviewer Admin Dashboard</a> </p>

                //             <h2>Your updated login credentials are as follows:</h2>
                //             <ol>
                //                 <li><strong>User Id:</strong> '.$data_to_store['email'].'</li>
                //                 <li><strong>Password:</strong> '.$password.'</li>
                //             </ol>

                //             <p>Your cooperation is greatly appreciated.</p>
                //         ';
            // $content .= $email_body_footer;
            $content .= str_replace($placeholders, $values, $email['content']);
            $content .= $email_template_footer;
            $response = smtp_mailer($data_to_store['email'], $subject, $content);
            if ($response) {
                $log_data = [
                    'log_type' => 'Account',
                    'sender_id' => $cuid,
                    'sent_by' => $admin_type,
                    'application_no' => '',
                    'title' => 'Account details updated for the Reviewer, '.$data_to_store['name'],
                    'receiver' => 'Reviewer',
                    'sent_from' => '',
                    'sent_to' => $data_to_store['email'],
                    'subject' => $subject,
                    'message' => contentFromHtmlBody($content),
                ];
                $db = getDbInstance();
                $save_conversation = $db->insert('communication_log', $log_data);
            }
        }
        $_SESSION['success'] = "Reviewer Updated successfully!";
        header('location: list_reviewers.php');
        exit();
    }
}
// exit();
include_once('includes/header.php');
?>

<div class="pagetitle">
    <h1>Reviewers Admin</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Reviewers Admin</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $action == "update" ? 'Update' : 'Create' ?> Reviewers Account</h5>
                <!-- General Form Elements -->
                <form action="add_reviewer.php" method="POST">
                <div class="row mb-3">
                    <label for="prefix" class="col-sm-2 col-form-label">Prefix</label>
                    <div class="col-sm-10">
                        <select name="prefix" id="prefix" class="form-control" placeholder="Select Prefix">
                            <?php 
                                foreach ($reviewerPrefixArr as $key => $value) {
                                    $selected = ''; 
                                    if (getData("prefix") == $value["id"]) {
                                        $selected = 'selected'; 
                                    }
                                    echo '<option value="'.$value["id"].'" '.$selected.'>'.$value["name"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" placeholder="Enter full name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="<?php echo getData("name") ?>" placeholder="Enter full name" required>
                        <input type="text" name="update-id" class="form-control" value="<?php echo getData("id") ?>" hidden>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" value="<?php echo getData("email") ?>" placeholder="Enter email" class="form-control" required>
                    </div>
                </div>

                <?php if ($action == 'update') : ?>
                    <div class="row mb-3">
                    <div class="col-sm-10">
                        <div class="form-check">
                        <input class="form-check-input" name="change_password" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">
                            Change Password
                        </label>
                        </div>
                    </div>
                    </div>
                <?php endif; 
                include('./includes/flash_messages.php');
                ?>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary px-5"><?php echo $action == "update" ? 'Update' : 'Save' ?></button>
                    <button onclick="location.href='list_reviewers.php'; return false;" class="btn btn-light px-5 mx-2" >Back</button>
                    </div>
                </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
</div>


<?php include_once('includes/footer.php'); ?>