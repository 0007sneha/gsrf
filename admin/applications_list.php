<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../data/generalData.php';
include('../admin_assets/includes/custom_functions.php');
require_once '../vendor/autoload.php';

require '../admin_assets/list_applications.php';