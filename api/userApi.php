<?php
    require '../config/be_function.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['userId'];
        $schemeBatchId = $_GET['schemeBatchId'];
        $type = $_GET['type'];
        $table = '';

        switch ($type) {
            case 'DF': $table = 'scheme_doctoral_fellowship'; break;
            case 'PDF': $table = 'scheme_post_doctoral_fellowship'; break;
            case 'MAJ': $table = 'scheme_major_project_grant'; break;
            case 'MIN': $table = 'scheme_minor_project_grant'; break;
            case 'SS': $table = 'scheme_summer_school'; break;
            case 'RSG': $table = 'scheme_research_startup_grant'; break;
            case 'IRIS': $table = 'scheme_iris'; break;
            default: 
                    echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found', 'data'=>'']);
                    exit();
                break;
        }
        $query = "SELECT id, user_id, application_no, file_application_form
                    FROM $table 
                    WHERE status = 1 AND form_status = 1 AND user_id=$id AND scheme_batch_id=$schemeBatchId 
                ";
        $data = fetchRows($query, false); 
        if($data){
            echo json_encode(['flag'=>true, 'status'=>'200', 'message'=>'Already submitted form!', 'data'=>$data]);
        } else {
            echo json_encode(['flag'=>false, 'status'=>'500', 'message'=>'No data found', 'data'=>'']);
        }
    } 
    
?>