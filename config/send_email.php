<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('smtp/PHPMailerAutoload.php');   // add this library

function smtp_mailer($to, $subject, $msg){
	echo 'Email Paused'; return 'Sent'; //----------------------------------------------
	
	$toName = '';
	// $from = "gsrf.schemes@gmail.com";
	$from = 'schemes@gsrf.org.in';
	$setFromName = 'GSRF Schemes';
	$setReplyTo = 'noreply@gsrf.org.in';

	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';

	// $mail->SMTPDebug = 2; // 2 for more detailed debugging
	// $mail->Debugoutput = 'html';

	// output gmail
	$mail->Username = "gsrf.schemes@gmail.com";
	$mail->Password = "rbjkcajjvmocwhul";
	// output org.in
	$mail->Username = "schemes@gsrf.org.in";
	$mail->Password = "H+!^b*Ox_OLb";

	$mail->SetFrom($from, $setFromName);
	$mail->AddAddress($to, $toName); 
	$mail->AddReplyTo($setReplyTo, $setFromName);
	
	//Content
	$mail->Subject = $subject;
	$mail->Body = $msg;

	$mail->SMTPOptions=array(
		'ssl'=>array(
			'verify_peer'=>false,
			'verify_peer_name'=>false,
			'allow_self_signed'=>false
		)
	);
	if(!$mail->Send()){
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}else{
		return 'Message has been sent';
	}
}

?>