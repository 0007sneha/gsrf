<?php 
$status = isset($_GET["utoken"]) ?? '';
if ($status == "TKStXm780NvFMfcgzGtxSrZzjQlmsd00zfRJH") {
    $msg = '
            <h2 class="text-center">User verified successfully.</h2>
            <p class="text-center">Thank you for your patience</p>
        ';
} else {
    $msg = '
            <h2 class="text-center">User already verified !</h2>
            <p class="text-center">You can browse the site using your credentials</p>
        ';
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
                                <li>Account-verification</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="inner-page readableContent">
        <div class="container">
            <div class="row d-flex justify-content-md-center forms msg-note">
                <div class="col-md-6">
                    <?php echo $msg; ?>
                    <p>You will be redirected to the login page in <span id="countdown"></span> seconds.</p>
                </div>    
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
<script type="text/javascript">
    if (userUID) {
        location.href = "index.php";
    }
    
    var redirectDelay = 7;
    var redirectURL = 'login.php';

    function startCountdown() {
        var countdownElement = document.getElementById('countdown');
        countdownElement.textContent = redirectDelay;

        var interval = setInterval(function() {
            redirectDelay--;
            countdownElement.textContent = redirectDelay;

            if (redirectDelay <= 0) {
                clearInterval(interval);
                window.location.href = redirectURL;
            }
        }, 1000);
    }
    window.onload = startCountdown;

    // setTimeout(() => {
    //     window.location.href="login.php";
    // },  5000);
</script>
</body>
</html>