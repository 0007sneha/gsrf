<?php 
require 'config/session.php'; 
include_once 'config/user_access.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="author" content="Mayur Naik">
    <title>GSRF</title>
    <meta content="Goa State research Foundation Website" name="description">
    <meta content="GSRF,Goa State Research Foundation,schemes,research,grants,doctorate,fellowship" name="keywords">
    <!-- Favicons -->
    <link href="<?php echo $logoIcoPath ?>" rel="icon">
    <link href="<?php echo $logoPath ?>" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link rel="preload" href="assets/css/google_fonts.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/css/google_fonts.css"></noscript>

    <!-- Vendor CSS Files -->
    <link rel="preload" href="assets/vendor/aos/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/vendor/aos/aos.css"></noscript>
    <link rel="preload" href="assets/vendor/animate.css/animate.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/vendor/animate.css/animate.min.css"></noscript>
    <link rel="preload" href="assets/vendor/bootstrap/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css"></noscript>
    <link rel="preload" href="assets/vendor/bootstrap-icons/bootstrap-icons.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css"></noscript>
    <link rel="preload" href="assets/vendor/glightbox/css/glightbox.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/vendor/glightbox/css/glightbox.min.css"></noscript>
    <link rel="preload" href="assets/vendor/boxicons/css/boxicons.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/vendor/boxicons/css/boxicons.min.css"></noscript>
    <link rel="preload" href="assets/vendor/swiper/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css"></noscript>

    <!-- Template Main CSS File -->
    <link rel="preload" href="assets/css/style.css?<?php echo time() ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/css/style.css?<?php echo time() ?>"></noscript>
    <!-- =======================================================
    * Template Name: Restaurantly - v3.7.0
    * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->    
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="assets/js/sweet_alert.js"></script>
    <style>
        /* Google Translate */
        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            z-index: -1;
        }
        /* #translation-container {
            display: none;
        } */

        .goog-te-gadget-simple {
            font-weight: 600;
            padding: 6px 6px;
            /* background-color: #ededed; */
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid var(--primaryColor);
        }
        body {
            top: 0px !important;
        }
    </style>
    
</head>