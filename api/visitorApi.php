<?php
    require '../config/be_function.php';
    // visitorApi.php

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $query = "SELECT id, count FROM visitors ORDER BY id DESC LIMIT 1";
        $data = fetchRows($query, false); 
        if($data['count']){
            $count = sprintf("%05d", $data['count']);

            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Total Count', 'data'=>$count]);
        } else {
            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'No Visitors Found', 'data'=>'00000']);
        }
    } 
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postData = json_decode(file_get_contents("php://input"), true);
        // $id = $postData['id'];
        $data = fetchRows("SELECT id, count FROM visitors ORDER BY id DESC LIMIT 1", false); 
        if($data['count']){
            $count = (int)$data['count'];
        } else {
            $count = 0;
        }
        $count = $count + 1;
        $count = sprintf("%05d", $count);

        // if(fetchRows("SELECT id FROM visitors", false)) {
        //     $query="UPDATE visitors SET count=:count WHERE id=1";
        // } else {
        // }
        $query="INSERT INTO visitors (count) VALUES (:count)";
        $data = array(':count' => $count);
        $result = insertRow($query, $data);
        if ($result) {
            $message = 'Success, Count Updated!';
        } else {
            $message = 'Failed!';
            // echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'Failed!', 'data'=>$count]);
        }
        echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>$message, 'data'=>$count]);
    }
?>