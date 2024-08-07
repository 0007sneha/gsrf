<?php
    session_start();
    if(isset($_SESSION['userUID'])){
        // if session is ACTIVE and the users open login page then redirect him to Admin Panel 
        // echo "Session is active!";
        // header("location: admin/");
    } else if(!isset($_SESSION['userUID'])){
        // Restrict user from entering into the System if the Session is not active
        // echo "Session is not active.";
        // echo '<script>location.href = "../";</script>';
    } else {
        // do nothing if Valid User
    }
    // echo( $isAdmin);
    // print_r( $_SESSION);
    
    // Set Cache-Control header
    header("Cache-Control: max-age=2592000, public");
    // Set Expires header
    header("Expires: " . gmdate("D, d M Y H:i:s", time() + 2592000) . " GMT");
    // Set Last-Modified header
    header("Last-Modified: " . gmdate("D, d M Y H:i:s", filemtime(__FILE__)) . " GMT");

?>