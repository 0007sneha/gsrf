<?php
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = filter_input(INPUT_POST, 'email');
	$passwd = filter_input(INPUT_POST, 'passwd');
	$remember = filter_input(INPUT_POST, 'remember');

	//echo password_verify('admin', '$2y$10$RnDwpen5c8.gtZLaxHEHDOKWY77t/20A4RRkWBsjlPuu7Wmy0HyBu'); exit;

	//Get DB instance.
	$db = getDbInstance();
	$db->where("email", $email);
	$schemeAdminData = $db->getOne('scheme_admin_accounts');
	// $db->where("isDeleted", 0);

	if ($db->count >= 1) {
		if ($schemeAdminData['isDeleted'] == 1) {
			$_SESSION['failure'] = "Unauthorized Access!";
			header('Location:login.php');
			exit;
		} else {
			$db_password = $schemeAdminData['password'];
			$user_id = $schemeAdminData['id'];

			// if($schemeAdminData['isActive'] == 0){
			// 	$_SESSION['failure'] = "Your account has been blocked. Please contact support for assistance.";
			// 	header('Location:login.php');
			// 	exit();
			// }
			
			if (password_verify($passwd, $db_password)) {
				$_SESSION['scheme_admin_logged_in'] = TRUE;
				$_SESSION['admin_type'] = $schemeAdminData['admin_type'];
				$_SESSION['name'] = $schemeAdminData['name'];
				setcookie('SCUID', $schemeAdminData['id'], $expires, "/");

				if ($remember) {
					$series_id = randomString(16);
					$remember_token = getSecureRandomToken(20);
					$encryted_remember_token = password_hash($remember_token,PASSWORD_DEFAULT);
					$expiry_time = date('Y-m-d H:i:s', strtotime(' + 30 days'));
					$expires = strtotime($expiry_time);

					setcookie('series_id', $series_id, $expires, "/");
					setcookie('remember_token', $remember_token, $expires, "/");

					$db = getDbInstance();
					$db->where ('id',$user_id);
					$update_remember = array(
						'series_id'=> $series_id,
						'remember_token' => $encryted_remember_token,
						'expires' =>$expiry_time
					);
					$db->update("scheme_admin_accounts", $update_remember);
				}
				//Authentication successful redirect user
				header('Location:index.php');
			} else {
				$_SESSION['failure'] = "Invalid user name or password";
				header('Location:login.php');
			}
			exit;
		}
	} else {
		$_SESSION['failure'] = "Invalid username or email. Please try again.";
		header('Location:login.php');
		exit;
	}
} else {
	die('Method Not allowed');
}