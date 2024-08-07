<?php 
// include '../config/custom_functions.php';
// generateUUID
// sendMail

function generateToken() {
    return bin2hex(random_bytes(16));
}
function generateUUID($length = 8)
{
    require 'connect.php';

    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $id = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $id .= $characters[$randomIndex];
    }

    $stmt = $conn->prepare("SELECT id FROM users ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if($stmt->rowCount()>0){
        $data = $stmt->fetch();
        $id = $id.''.$data["id"];
    }
    return $id;
}

function generateOTP() {
    // Define the length of the OTP (e.g., 6 digits)
    $otpLength = 6;
    
    // Initialize an empty string to store the OTP
    $otp = "";
    
    // Generate each digit of the OTP
    for ($i = 0; $i < $otpLength; $i++) {
        // Generate a random digit (between 0 and 9)
        $digit = rand(0, 9);
        
        // Append the digit to the OTP string
        $otp .= $digit;
    }
    
    return $otp;
}



?>