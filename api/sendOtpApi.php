<?php 
    require '../config/be_function.php';
    include '../config/custom_functions.php';
    include '../config/send_email.php';
    include '../config/user_access.php';
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $type = $_GET['type'];
        $email = $_GET['email'];

        $query = "SELECT id,first_name,last_name FROM users WHERE email='".$email."' ";
        $user_data = fetchRows($query, false);
            
        if ($type=='request') {
            // Generate and display the OTP
            $otp = generateOTP();
            
            if ($user_data) {
                $user_id = (int)$user_data["id"];
                $first_name = $user_data["first_name"];
                $last_name = $user_data["last_name"];
            
                $query1 = "INSERT INTO otp (user_id, otp) VALUES(:user_id, :otp)";
                $data1 = array(
                                ':user_id' => $user_id,
                                ':otp' => $otp
                            );
                $result = insertRow($query1, $data1);
            
                if ($result) {
                    // Confirmation Mail
                    $logoAlt = 'GSRF';
                    $logoUrl = '';
                    $name = $first_name.' '.$last_name;
                    $subject = "Password Reset OTP for Your GSRF Account";
                    $content = '
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
                                            <p>Hello '.$name.',</p>
                                            <p>
                                                You have requested to reset your password for GSRF account. To complete the password reset process, 
                                                please use the following One-Time Password (OTP):
                                            </p>
                                            <h2>OTP: '.$otp.' </h2>
                                            <p>This OTP is valid for a limited time and should not be shared with anyone. If you did not initiate this password reset, please ignore this message. </p>
                                            <p>If you have any questions or need further assistance, please don\'t hesitate to contact our support team at office.gsrf@gmail.com. </p>
                                        </div>
                                        <div>
                                            <p>Thank you</p>
                                            <p>Best regards,</p>
                                            <p><strong>The GOA STATE RESEARCH FOUNDATION Team</strong></p>
                                            <div style="display: flex;">
                                            </div>
                                        </div>
                                    </body>
                                </html>
                            ';
                    // <img src="'.$logoUrl.'" alt="'.$logoAlt.'" style="width: 70px;">
                    
                    $response = smtp_mailer($email, $subject, $content);
                    if ($response) {
                        $resMessage = 'success';
                    } else {
                        $resMessage = 'Failed to send OTP, Please try again after some time';
                    }
                    $query_log="INSERT INTO communication_log (log_type, sender_id, sent_by, application_no, title, receiver, sent_from, sent_to, subject, message) 
                                VALUES (:log_type, :sender_id, :sent_by, :application_no, :title, :receiver, :sent_from, :sent_to, :subject, :message)";
                    $log_data = [
                        ':log_type' => 'OTP',
                        ':sender_id' => 0,
                        ':sent_by' => 'GSRF',
                        ':application_no' => '',
                        ':title' => 'OTP for Password reset request by '.$name,
                        ':receiver' => 'Candidate',
                        ':sent_from' => $resMessage, // need to save response -------------------------------- 
                        ':sent_to' => $email,
                        ':subject' => $subject,
                        ':message' => contentFromHtmlBody($content),
                    ];
                    $save_conversation = insertRow($query_log, $log_data);
                    if ($response) {
                        echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>$resMessage, 'data' =>$otp ]);
                    } else {
                        echo json_encode(['flag'=>false, 'status'=>'402', 'message'=>$resMessage, 'data' =>'' ]);
                    }
                } else {
                    echo json_encode(['flag'=>false, 'status'=>'402', 'message'=>'Server Error, Please try again after some time!', 'data' =>'' ]);
                }
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Email not found! Please enter registered email id!', 'data' =>'' ]);
            }
            
        } else if ($type=='verify') {
            $user_id = (int)$user_data["id"];
            $otp = $_GET['otp'];
            
            $query = "SELECT id,otp FROM otp WHERE user_id='".$user_id."' ORDER BY id DESC LIMIT 1";
            $otp_data = fetchRows($query, false);
            $otp_id = (int)$otp_data["id"];

            if ($otp_data["otp"] == $otp) {
                $query1 = "UPDATE otp SET status=:status WHERE id='".$otp_id."' ";
                $data1 = array(
                        ':status' => 1
                    );
                $result = insertRow($query1, $data1); 
                
                if ($result) {
                    echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data' =>'' ]);
                }
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Invalid OTP! Please verify the OTP first!', 'data' =>$email ]);
            }
            
        } else if ($type=='reset') {
            $password = $_GET['password'];
            
            $query1 = "UPDATE users SET password=:password WHERE email='".$email."' ";
            $data1 = array(
                    ':password' => $password
                );
            $result = insertRow($query1, $data1); 

            if ($result) {
                echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Success, Updated new password.', 'data' =>'' ]);
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed to updated password', 'data' =>'' ]);
            }
        }


    }
    

?>