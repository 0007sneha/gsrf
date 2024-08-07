<?php 

    //  for developer 
    
    if (isset($_GET['p'])) {
        $password = $_GET['p'];
    } else {
        $password = 'admin1234';
    }

    $enc_pass = password_hash($password ,PASSWORD_DEFAULT);

    $data = array(
        'pass' => $password,
        'encrypted' => $enc_pass
    );
    

    echo '<pre>'; print_r($data); exit;
?>