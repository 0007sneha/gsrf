<?php
    require '../config/be_function.php';

    $verify = $_GET['verify'];

    $query = "SELECT id, is_verified FROM users WHERE token='$verify' ";
    $data = fetchRows($query, false);
    if($data){
        if ($data["is_verified"]==1) {
            // User has been verified already
            header('Location: ../verify-user.php');
            exit();
        } else {
            $query = "UPDATE users SET is_verified=:is_verified,status=:status WHERE id='".$data["id"]."' ";
            $data = array(
                    ':is_verified' => 1,
                    ':status' => 1
                );
            $result = insertRow($query, $data); 
            if ($result) {
                // echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'success', 'data'=>'User verification Completed.']);
                header('Location: ../verify-user.php?utoken=TKStXm780NvFMfcgzGtxSrZzjQlmsd00zfRJH');
                exit();
            } else {
                echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'failed', 'data'=>'Failed to verify, Email!']);
            }
        }
    }


?>