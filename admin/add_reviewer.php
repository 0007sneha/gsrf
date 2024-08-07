<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../config/send_email.php';
require_once '../config/be_function.php';
require_once '../data/generalData.php'; 

$cuid = CUID();
$created_by = "SUPA" . $cuid;

require_once '../admin_assets/includes/email_template.php';
require '../admin_assets/add_reviewer.php';

?>