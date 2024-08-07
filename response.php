<?php 
$status = isset($_GET["s"]) ? $_GET["s"] : '';
if ($status && $status=="hfnkdu7985et") {
    # code...
} else {
    echo '<script>location.href = "index.php";</script>';
}
require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
?>
<body class="t2">
<main id="main"> 
    <section class="breadcrumbs">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li><a href="index.php">Home</a></li>
                                <li>Reset Password</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="inner-page">
        <div class="container">
            <div class="row d-flex justify-content-md-center forms msg-note">
                <div class="col-md-10">
                    <h3 class="mb-4">Password Reset Successful</h3>
                    <p>Congratulations! Your password has been successfully reset. </p>
                    <p>You can now login using your new password.</p>
                    <button type="button" class="btn btn-primary px-5 mb-3" onclick="window.location.href='login.php';" >Login</button>
                    <p>You will be redirected back to login page in one minute</p>
                </div>    
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
<?php 
require "layout/footer.php"; 
?>
<script type="text/javascript">
    if (userUID) {
        location.href = "index.php";
    }
    setTimeout(() => {
        window.location.href="login.php";
    }, 60000);
</script>
</body>
</html>