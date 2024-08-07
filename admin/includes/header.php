<?php
  include '../config/user_access.php';
?>

<?php 

if($renderHeaders):
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="author" content="Mayur Naik">
  <title>GSRF Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo '../'.$logoIcoPath ?>" rel="icon">
  <link href="<?php echo '../'.$logoPath ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../admin_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../admin_assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../admin_assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../admin_assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../admin_assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../admin_assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../admin_assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../admin_assets/css/style.css?<?php echo time() ?>" rel="stylesheet">
  <script src="../assets/js/jquery_min.js"></script>
  <script src="../assets/js/sweet_alert.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <?php 
// Get the current script name without the file extension
$currentScript = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);
// Convert underscores and camel case to word-separated format
$currentPageName = ucwords(preg_replace('/([a-z])([A-Z])|_/', '$1 $2', $currentScript));
// Output the converted script name
// echo $convertedScript;
?>
</head>
<body>
  <!-- ======= Header ======= -->
  <?php 
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true): 
  ?>
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <img src="<?php echo '../'.$logoPath ?>" alt="">
          <span class="d-none d-lg-block">Admin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="../admin_assets/img/dummy-profile.png" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['name'] ?></span>
            </a><!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?php echo $_SESSION['name'] ?></h6>
                <span>Admin</span>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->
        </ul>
      </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link " href="index.php">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
          <a class="nav-link " href="analytics.php">
            <i class="bi bi-grid"></i>
            <span>Analytics</span>
          </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#applications-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Applications</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="applications-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="applications_list.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->  
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#assigned-task-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Assigned Task</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="assigned-task-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="list_reviewers_task.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Candidates</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="users_list.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#scheme-batch" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Scheme Batches</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="scheme-batch" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="add_batch.php">
                <i class="bi bi-circle"></i><span>Create New Batch</span>
              </a>
            </li>
            <li>
              <a href="list_batch.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#scheme-admin-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Scheme Admins</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="scheme-admin-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="create_scheme_admin.php">
                <i class="bi bi-circle"></i><span>Create Scheme Admin</span>
              </a>
            </li>
            <li>
              <a href="list_scheme_admin.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#reviewers-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Reviewers</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="reviewers-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="add_reviewer.php">
                <i class="bi bi-circle"></i><span>Add Reviewers</span>
              </a>
            </li>
            <li>
              <a href="list_reviewers.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#feedback-questions-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Review Question</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="feedback-questions-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="list_feedback_questions.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#events-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Emails</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="events-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="list_emails.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#activity-logs-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Activity Logs</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="activity-logs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="list_activity_logs.php">
                <i class="bi bi-circle"></i><span>Show All</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
      </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

  <?php endif; ?>

    <section class="section dashboard">

<?php endif; ?>