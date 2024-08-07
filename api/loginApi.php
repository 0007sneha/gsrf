<?php
	session_start();
    require '../config/be_function.php';
	
	$postData = json_decode(file_get_contents("php://input"), true);

	$now = new DateTime();
	$getDate = $now->format('Y-m-d H:i:s');    
	

	// if($_SERVER['REQUEST_METHOD'] == "GET")
	// {
	// 	if (isset($_GET['type']) && $_GET['type'] == 'name') {
	// 		$query = "SELECT id,name FROM yards WHERE status=1 ORDER BY id ASC";
	// 	} else {
    //     	$query = "SELECT * FROM yards ORDER BY id,status DESC";
	// 	}
    //     $data = fetchRows($query);
    //     if($data){
    //         $response = json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>$data]);
    //     } else {
    //         $response = json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found', 'data'=>'']);
    //     }
    //     echo $response;
	// }

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$userData = [];
		$username = $postData['username'];
		$password = $postData['password'];

        $responseFlag = false;
		$responseCode = 500;
		$responseMsg = 'Invalid Password !';
        $rememberMe = false;

        $query = "SELECT user_uid, id, first_name, middle_name, last_name, dob, country_code, phone_no, gender, category, file_category_certificate, differently_abled, identity_no, email, password, is_verified 
									FROM users WHERE email = ?";
        $data = array($username);
        $user = fetchRowsWithColCheck($query, $data, false); 

		// fix encryption for password as for mysql version 8
		if ($user) {
			$userUID = $user['user_uid'];
			$userId = (int)$user['id'];
			$isUserVerified = $user['is_verified'];

			// Check if the password is correct
			if ($user && $password == $user['password']) {
                // if ($user && password_verify($password, $user['password'])) {
				
				if ( $isUserVerified == 0 ) {
					$responseFlag = true;
					$responseCode = 201;
					$responseMsg = 'Please click on the verification link for completing the registration process.';
				} else {
					$userData = array(
						'user_uid' => $user['user_uid'],
						'id' => $user['id'],
						'first_name' => $user['first_name'],
						'middle_name' => $user['middle_name'],
						'last_name' => $user['last_name'],
						'name' => $user['first_name'].' '.$user['last_name'],
						'dob' => $user['dob'],
						'country_code' => $user['country_code'],
						'phone_no' => $user['phone_no'],
						'gender' => $user['gender'],
						'category' => $user['category'],
						'file_category_certificate' => $user['file_category_certificate'],
						'differently_abled' => $user['differently_abled'],
						'identity_no' => $user['identity_no'],
						'email' => $user['email']
					);
					$_SESSION['userData'] = $userData; 
					$_SESSION['userUID'] = $userUID;

					// set cookie 
					if ($rememberMe == true) {
						setcookie('userUID',$userUID, time() + (86400 * 30), "/"); // 86400 = 1 day
						setcookie('userData',$userData, time() + (86400 * 30), "/"); // 86400 = 1 day
					}else{
						setcookie('userUID',''); // 86400 = 1 day
						setcookie('userData',''); // 86400 = 1 day
					}
					
					// create user log
					$ipAddress = $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : '';
					$query2="INSERT INTO user_log (user_id,ip_address,device,start_time) 
											VALUES (:user_id,:ip_address,:device,:start_time)";
					$data2 = array(
							':user_id' => $userId,
							':ip_address' => $ipAddress,
							':device' => 'windows',
							':start_time' => $getDate,
						);
					$result2 = insertRow($query2, $data2);
					
					$responseFlag = true;
					$responseCode = 200;
					$responseMsg = 'Success !!';
				}
			}
		} else {
			$responseMsg = 'Invalid Username !';
			$responseCode = 501;
		}
		echo json_encode(['flag'=>$responseFlag, 'status'=>$responseCode, 'message'=>$responseMsg ]);
	}


?>