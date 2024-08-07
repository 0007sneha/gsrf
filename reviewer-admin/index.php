<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
$isStatusCount = false;
include('../admin_assets/api/schemeStatusCountApiData.php');
include_once('includes/header.php');
?>
    <!-- /.row -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <div class="row">

        <!-- <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reviews Completed</h5>
                    <h2 class="text-success"> <?php echo $completeCount ?> </h2>
                </div>
            </div>
        </div> -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reviews Given</h5>
                    <h2 class="text-info"> <?php echo $reviewedCount ?> </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reviews Pending</h5>
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h2 class="text-warning"> <?php echo $pendingCount ?> </h2>
                        </div>
                        <div class="">
                            <?php if($pendingCount > 0): ?>
                                <a href="application_review_list.php" class="btn btn-primary">View Application</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>    
<?php

include_once('includes/footer.php'); ?>
