<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$aid = $_GET['aid'];
$rev_id = isset($_GET['r']) ? $_GET['r'] : "";
$go_to_file_path = '';
include('../admin_assets/api/viewFeedbackApiData.php');

require '../admin_assets/view_all_feedbacks.php';

?>