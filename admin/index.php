<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
$isStatusCount = true;
include('../admin_assets/api/schemeStatusCountApiData.php');
include_once('includes/header.php');

require '../admin_assets/dashboard.php';

?>