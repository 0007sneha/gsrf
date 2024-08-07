<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'helpers/DatabasePlugin.php';
require_once '../config/send_email.php';
require_once '../config/be_function.php';
require_once '../data/generalData.php'; 

$scheme_listing = 'GURORSGUYRT';
require_once '../admin_assets/includes/email_template.php';
require_once '../admin_assets/includes/custom_functions.php';
require_once '../admin_assets/api/schemeApplicationStatusApiData.php';
include_once('includes/header.php');

require '../admin_assets/scheme_listing.php';
?>
