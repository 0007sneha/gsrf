<?php
    require '../config/be_function.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require '../config/connect.php';
        
        if($conn){
            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'DB Connected Successfully!', 'data'=>$conn]);
        } else {
            echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed tp Connect DB.', 'data'=>$conn]);
        }
    } 
    
?>