<?php
require_once '../helpers/DatabasePlugin.php';

$response = array();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve input data from the POST request
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input data
    if (empty($name) || empty($email) || empty($password)) {
        $response['error'] = true;
        $response['message'] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['error'] = true;
        $response['message'] = "Invalid email format.";
    } else {
        // Hash the password for security (you should use a stronger hashing method)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create an instance of the DatabasePlugin class
        $db = new DatabasePlugin();

        // Define the table name
        $table = 'reviewers';

        // Prepare the data to be inserted into the database
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword);

        // Attempt to create a new reviewer record
        if ($db->createRecord($table, $data)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit; 
        } else {
            $response['error'] = true;
            $response['message'] = "Error creating reviewer. Please try again.";
        }

    }
} else {
    $response['error'] = true;
    $response['message'] = "Invalid request method. Use POST.";
}

// Convert the response array to JSON and send it as the API response
header('Content-Type: application/json');
echo json_encode($response);
?>