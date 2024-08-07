<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
?>

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

    <section class="inner-page">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-10 forms p60">
                    <h3>Account Verification</h3>
                    <p class="mb-5 fw4">
                        Thank you for registering with the Goa State Research Foundation! Your dedication to fostering <br>
                        research and innovation is greatly appreciated. 
                    </p>

                    <div class="msg-note">
                        Before we can activate your account and provide you with access to our resources, we need to 
                        <strong>verify your email address.</strong>
                    </div>
                </div>    
            </div>
        </div>
    </section>
    
    <section class="inner-page">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-10 content">
                    <p class="mb-4">Here's what you can expect next:</p>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 mb-4 content-text">
                            <strong>1. Check Your Inbox:</strong> 
                            In a few moments, you should receive an email from us at the address you provided during registration. Please ensure to check your inbox, including your spam or junk folder, just in case our email accidentally ends up there.
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-4 content-text">
                            <strong>2. Open the Email:</strong> 
                            Look for an email with the subject line: "Goa State Research Foundation - Email Verification." Open this email to proceed with the verification process.
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-4 content-text">
                            <strong>3. Click the Verification Link:</strong> 
                            Within the email, you'll find a unique verification link. Click on this link, and it will direct you to a page confirming that your email address has been successfully verified.
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-4 content-text">
                            <strong>4. Access Your Account:</strong> 
                            Once your email address is verified, you'll be able to access your account on the Goa State Research Foundation website. You'll have the opportunity to explore our resources, engage with our community, and make the most of your registration.     
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
 
<script type="text/javascript">
    $( document ).ready(function() {

    });
    
    if (userUID) {
        location.href = "index.php";
    }
    setTimeout(() => {
        window.location.href="login.php";
    }, 600000);
</script>
</body>
</html>