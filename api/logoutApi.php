<?php
session_start();
require '../config/be_function.php';

$now = new DateTime();
$getDate = $now->format('Y-m-d H:i:s');    
$userId = '';

if(isset($_SESSION['userData'])){
    if(isset($_SESSION['userData']['userId'])){
        $userId = $_SESSION['userData']['userId'];
    }
}
$query = "UPDATE user_log SET end_time=:end_time WHERE user_id='".$userId."' ORDER BY id DESC LIMIT 1";
$data = array(
        ':end_time' => $getDate
    );
$result = insertRow($query, $data);
if ($result)
{
    // Kill Session
    if(isset($_SESSION['userUID'])){
        unset($_SESSION['userUID']);
        unset($_SESSION['userData']);
        session_destroy();  
    }
    if(isset($_COOKIE['userUID'])){
        setcookie('userUID',''); // 86400 = 1 day;
        setcookie('userData','');
    }
    header("location: ../");
}
?>
