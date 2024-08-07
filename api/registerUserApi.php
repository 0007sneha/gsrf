<?php
    require '../config/be_function.php';
    include '../config/custom_functions.php';
    include '../config/send_email.php';
    include '../config/user_access.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        } else {
            $type = '';
        }

        if ($type=="dSJJDEVRls") {
            $server = $_GET['server'];
            $data = false;

            $logoUrl = '';
            $subject = "Goa State Research Foundation - Email Verification.";
            $verifyAPi = "https://gsrf.org.in/api/emailVerificationApi.php?verify=";

            if ($server == "live") {
                $name = $_GET['name'];
                $token = $_GET['token'];
                $email = $_GET['email'];
                
                $verifyAPi .= $token;
                $dataEmail = [
                    'name' => $name,
                    'logoUrl' => $logoUrl,
                    'verifyAPi' => $verifyAPi,
                ];
                $content = emailVerificationTemplate($dataEmail);
                $response = smtp_mailer_live($email, $subject, $content);

            } else if ($server == "localToLive") {
                $email = $_GET['email'];
                
                $query = "SELECT id,first_name,last_name,token FROM users2 WHERE email='".$email."' AND is_verified='0' ";
                $dataUser = fetchRows($query, false); 
                if($dataUser) {
                    $id = $dataUser['id'];
                    $name = $dataUser['first_name'] .' '.$dataUser['last_name'];
                    $token = $dataUser['token'];

                    $verifyAPi .= $token;
                    $dataEmail = [
                        'name' => $name,
                        'logoUrl' => $logoUrl,
                        'verifyAPi' => $verifyAPi,
                    ];
                    $content = emailVerificationTemplate($dataEmail);
                    $response = smtp_mailer_live($email, $subject, $content);
                }
            } else if ($server == "localToLiveAll") {
                $query = "SELECT id,first_name,last_name,email,token FROM users2 WHERE is_verified='0' ";
                $dataUser = fetchRows($query); 
                if($dataUser) {
                    foreach ($dataUser as $key => $value) {
                        $id = $value['id'];
                        $name = $value['first_name'] .' '.$value['last_name'];
                        $email = $value['email'];
                        $token = $value['token'];

                        $verifyAPi .= $token;
                        $dataEmail = [
                            'name' => $name,
                            'logoUrl' => $logoUrl,
                            'verifyAPi' => $verifyAPi,
                        ];
                        $content = emailVerificationTemplate($dataEmail);
                        $response = smtp_mailer_live($email, $subject, $content);
                    }
                } else {
                    echo json_encode(['status'=>'500', 'message'=>'No data found', 'data'=>'']); exit;
                }
            }

        } else {
            if ($type=="user") {
                $query = "SELECT * FROM users WHERE id='".$_GET['id']."' ";
                $isAllRecords = false;
            } else {
                $query = "SELECT * FROM users ORDER BY id ASC";
                $isAllRecords = true;
            }
            $data = fetchRows($query, $isAllRecords);
        }
        if($data){
            echo json_encode(['status'=>'200', 'message'=>'success', 'data'=>$data]);
        } else if ($type == "dSJJDEVRls"){
            echo json_encode(['status'=>'200', 'message'=>'success', 'data'=>'Mail Sent!']);
        } else {
            echo json_encode(['status'=>'500', 'message'=>'No data found', 'data'=>'']);
        }
    } 
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postData = json_decode(file_get_contents("php://input"), true);
        
        $type = $postData['type'] ?? '';
        $email = $postData['email'] ?? '';
        $token = $postData['token'] ?? '';

        if ($type=="registration") {
            $user_uid = generateUUID();
            $auth_token = generateToken().''.$user_uid;
            
            $first_name = $postData['first_name'] ?? '';
            $middle_name = $postData['middle_name'] ?? '';
            $last_name = $postData['last_name'] ?? '';
            $dob = $postData['dob'] ?? '';
            $country_code = $postData['country_code'] ?? '';
            $phone_no = $postData['phone_no'] ?? '';
            $gender = $postData['gender'] ?? '';
            $category = $postData['category'] ?? '';
            $file_category_certificate = $postData['file_category_certificate'] ?? '';
            $differently_abled = $postData['diff_abled'] ?? '';
            $identity_no = $postData['identity_no'] ?? '';
            $password = $postData['password'] ?? '';
            $is_sms_alert = (int)$postData['is_sms_alert'] ?? '';
            $is_terms_policy = (int)$postData['is_terms_policy'] ?? '';
            
            // validate unique fields
            $result = '';
            $query = "SELECT id,phone_no,identity_no,email FROM users WHERE email='".$email."' OR identity_no='".$identity_no."' OR phone_no='".$phone_no."' ";
            $data = fetchRows($query, false); 
            if($data) {
                if ($data['phone_no']==$phone_no) {
                    $msg = "Phone Number already exist, Please enter a different number.";
                    $data['focus_field']="phone_no";
                } else if ($data['identity_no']==$identity_no) {
                    $msg = "Identity Number already exist!!.";
                    $data['focus_field']="identity_no";
                } else if ($data['email']==$email) {
                    $msg = "Email id already Exist, Please use a different ID.";
                    $data['focus_field']="email";
                }
                echo json_encode(['flag'=>true, 'status'=>'401', 'message'=>$msg, 'data'=>$data ]);
                exit;
            } else {
                $query="INSERT INTO users (user_uid, first_name, middle_name, last_name, dob, country_code, phone_no, gender, category, file_category_certificate, differently_abled, identity_no, email, password, is_sms_alert, is_terms_policy, token) 
                        VALUES (:user_uid, :first_name, :middle_name, :last_name, :dob, :country_code, :phone_no, :gender, :category, :file_category_certificate, :differently_abled, :identity_no, :email, :password, :is_sms_alert, :is_terms_policy, :token)";
                $data = array(
                            ':user_uid' => $user_uid,
                            ':first_name' => $first_name,
                            ':middle_name' => $middle_name,
                            ':last_name' => $last_name,
                            ':dob' => $dob,
                            ':country_code' => $country_code,
                            ':phone_no' => $phone_no,
                            ':gender' => $gender,
                            ':category' => $category,
                            ':file_category_certificate' => $file_category_certificate,
                            ':differently_abled' => $differently_abled,
                            ':identity_no' => $identity_no,
                            ':email' => $email,
                            ':password' => $password,
                            ':is_sms_alert' => $is_sms_alert,
                            ':is_terms_policy' => $is_terms_policy,
                            ':token' => $auth_token
                        );
                $result = insertRow($query, $data);
            }
        } else {
            // if ($type=="reverification") {
            $query = "SELECT id,user_uid,first_name,last_name,token_count FROM users WHERE email='".$email."' ";
            $data = fetchRows($query, false); 
            if($data) {
                $id = $data['id'];
                $user_uid = $data['user_uid'];
                $first_name = $data['first_name'];
                $last_name = $data['last_name'];
                $token_count = (int)$data['token_count'];
                $token_count += 1;

                $auth_token = generateToken().''.$user_uid;
                // set new token
                $query2 = "UPDATE users SET token=:token,token_count=:token_count WHERE id=$id ";
                $data2 = array(
                    ':token' => $auth_token,
                    ':token_count' => $token_count
                );
                $result = insertRow($query2, $data2);
            } else {
                $result = '';
            }
        }

        if($result)
        {
            // Confirmation Mail
            $logoUrl = '';
            $verifyAPi = $hostUrl."api/emailVerificationApi.php?verify=".$auth_token;
            $subject = "Goa State Research Foundation - Email Verification.";
            $dataEmail = [
                'name' => $first_name.' '.$last_name,
                'logoUrl' => $logoUrl,
                'verifyAPi' => $verifyAPi,
            ];
            $content = emailVerificationTemplate($dataEmail);
            $response = smtp_mailer($email, $subject, $content);
            if ($response) {
                $msg = 'You will receive an Email Verification message, please verify to complete the process!! Please check the mail in SPAM folder if you don\'t find it in INBOX';
            } else {
                $msg = 'Something went wrong, Failed to send Email !';
            }
            $title = 'Candidate account created for '.$first_name.' '.$last_name;
            $query_log="INSERT INTO communication_log (log_type, sender_id, sent_by, application_no, title, receiver, sent_from, sent_to, subject, message) 
                            VALUES (:log_type, :sender_id, :sent_by, :application_no, :title, :receiver, :sent_from, :sent_to, :subject, :message)";
            $log_data = [
                ':log_type' => 'Account',
                ':sender_id' => 0,
                ':sent_by' => 'GSRF',
                ':application_no' => '',
                ':title' => $title,
                ':receiver' => 'Candidate',
                ':sent_from' => 'sent_from', // need to save response -------------------------------- 
                ':sent_to' => $email,
                ':subject' => $subject,
                ':message' => contentFromHtmlBody($content),
            ];
            $save_conversation = insertRow($query_log, $log_data);
            
            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>$msg ]);
            // header("location: ../account-verification.php");

        } else {
            echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to register. Please, try again !']);
        }
        // return true;
    }

    if ($_SERVER['REQUEST_METHOD']=='DELETE') {
        // http://localhost/gsrf/api/schemeMajorResearchProjectApi.php?id=18&token=cLeAn4MAJQrU5Y7In2ksd

        $id = $_GET['id'];
        $token = $_GET['token'];
        $result = true;

    }


    function emailVerificationTemplate($data) {
        $logoAlt = 'GSRF';
        return '
                <!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width,initial-scale=1">
                        <meta name="x-apple-disable-message-reformatting">
                        <title></title>
                        <!--[if mso]>
                        <noscript>
                        <xml>
                            <o:OfficeDocumentSettings>
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                            </o:OfficeDocumentSettings>
                        </xml>
                        </noscript>
                        <![endif]-->
                    </head>
                    <body>
                        <div class="container">
                            <p>Dear '.$data['name'].',</p>
                            <p>Thank you for registering with the <strong>GOA STATE RESEARCH FOUNDATION</strong>.</p>
                            <p>
                                To ensure the security of your account and complete the registration process, we kindly ask that you confirm your email address. Verifying your email address will help us make sure you know about important announcements, research opportunities, and new developments from the GOA STATE RESEARCH FOUNDATION.
                            </p>
                            <p>Please follow the below steps to complete the verification</p>
                            <ol type="1">
                                <li>Simply click on the following Button to Verify Your Email Address.</li>
                                <li>Your account will be successfully validated once you click on the verification Button.</li>
                            </ol>
                            <div align="center">
                                <a href="'.$data['verifyAPi'].'"
                                    style="display: inline-block;
                                        text-align: center;
                                        vertical-align: middle;
                                        text-decoration: none;
                                        font-family: Inter;
                                        font-style: normal;
                                        font-size: 1rem;
                                        font-weight: 500;
                                        line-height: 1.5;
                                        padding: 0.375rem 2.75rem;
                                        background-color: #0a6ebd;
                                        color: #FFF;
                                        cursor: pointer;
                                        user-select: none;
                                        border: 1px solid transparent;
                                        border-radius: 0.25rem;
                                        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;"
                                >
                                    Verify
                                </a>
                            </div>
                            <p>
                                You can explore our resources, work with other researchers, and advance knowledge and innovation in Goa by logging into your GOA STATE RESEARCH FOUNDATION account after you have verified your email address.
                            </p>
                            <p>
                                If you did not initiate this registration or believe this email was sent in error, please ignore it.
                                Your email address will not be used for any purpose without your consent.</p>
                            <br>
                            <p>Thank you for choosing GOA STATE RESEARCH FOUNDATION. We look forward to your active participation in our research community.</p>
                        </div>

                        <div>
                            <p>Best regards,</p>
                            <p><strong>The GOA STATE RESEARCH FOUNDATION Team</strong></p>
                            <div style="display: flex;">
                            </div>
                        </div>
                    </body>
                </html>
            ';
            // <img src="'.$logoUrl.'" alt="'.$logoAlt.'" style="width: 70px;">
    }
?>