<?php
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = filter_input(INPUT_POST, 'username');
	$passwd = filter_input(INPUT_POST, 'passwd');
	$remember = filter_input(INPUT_POST, 'remember');

	//Get DB instance.
	$db = getDbInstance();
	$db->where("email", $email);
	$reviewerData = $db->getOne('reviewers');


// 	echo "<pre>";
// print_r($reviewerData);
// exit;

	if ($db->count >= 1) {
		if ($reviewerData['isDeleted'] == 1) {
			$_SESSION['failure'] = "Unauthorized Access!";
			header('Location:login.php');
			exit;
		} else {
			$db_password = $reviewerData['password'];
			$user_id = $reviewerData['id'];

			if($reviewerData['isActive'] == 0){
				$_SESSION['failure'] = "Your account has been blocked. Please contact support for assistance.";
				header('Location:login.php');
				exit();
			}

			if (password_verify($passwd, $db_password)) {
				$_SESSION['reviewer_admin_logged_in'] = TRUE;
				$_SESSION['admin_type'] = $reviewerData['admin_type'];
				$_SESSION['name'] = $reviewerData['name'];
				setcookie('RCUID', $reviewerData['id'], $expires, "/");
				
				//Authentication successful redirect user
				header('Location:index.php');
	
			} else {
				$_SESSION['failure'] = "Invalid user password. Please try again.";
				header('Location:login.php');
			}
			exit;
		}
	} else {
		$_SESSION['failure'] = "Invalid username or email. Please try again.";
		header('Location:login.php');
		exit;
	}
}
else {
	die('Method Not allowed');
}