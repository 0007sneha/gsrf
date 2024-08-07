<?php 
require "layout/head.php"; 
if (isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
?>
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
                                <li>Forgot Password</li>
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
                <div class="col-md-10">
                    <div class="custom-horizontal-tabs">
                        <div class="tabs d-none">
                            <div class="tab active" id="tab_0">
                                <div class="tab-number">1</div>
                                <div class="tab-text"></div>
                            </div>
                            <div class="tab" id="tab_1">
                                <div class="tab-number">2</div>
                                <div class="tab-text"></div>
                            </div>
                            <div class="tab" id="tab_2">
                                <div class="tab-number">3</div>
                                <div class="tab-text"></div>
                            </div>
                        </div>
                        <form class="forms login_form">
                            <div id="form_0" class="tabcontent">
                                <h3 class="mb-4">Initiation</h3>
                                <div class="col-md-6 mb-4">
                                    <label for="username" class="form-label">Registered Email ID</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter your email id" value="" onkeyup="validateEmailField('username', 'Please enter registered email id!')" aria-describedby="username">
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="send_otp_btn" class="btn btn-primary" onclick="sendOTP();" disabled>Send OTP</button>
                                </div>
                            </div>

                            <div id="form_1" class="tabcontent">
                                <h3 class="mb-4">Verification</h3>
                                <p>
                                    To verify your identity, we have sent a verification code to the email address linked to your account. Please enter the code below to proceed.
                                </p>
                                <div class="col-md-6 mb-4">
                                    <label for="otp" class="form-label">Verification Code</label>
                                    <input type="number" class="form-control" id="otp" onkeyup="validateOtpField();" placeholder="0 0 0 0 0 0" aria-describedby="otp">
                                </div>
                                <p>OTP Timer: <span class="error-msg" id="timer"></span></p>
                                <span class="error-msg col-md-12" id="timer_error_msg"></span>

                                <div class="col-md-6">
                                    <button type="button" id="verify_otp_btn"  class="btn btn-primary" onclick="verifyOTP();" disabled>Verify OTP</button> 
                                    <button type="button" id="resend_otp_btn" class="btn btn-primary d-none" onclick="resendOTP();">Resend OTP</button>
                                </div>
                            </div>

                            <div id="form_2" class="tabcontent">
                                <h3 class="mb-4">Password Reset</h3>
                                <p>
                                    Strengthen the security of your account by selecting a new password.
                                </p>
                                <strong>
                                    Your password should meet the following criteria :
                                </strong>
                                <ol>
                                    <li>Be at least 8 characters long </li>
                                    <li>Include a mix of uppercase and lowercase letters</li>
                                    <li>Contain at least one number and one special character</li>
                                </ol>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="password" class="form-label star">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control col-md-8" id="password" name="password" value="" onchange="validateResetPassField();" placeholder="Enter new password" aria-label="password" aria-describedby="showPassword" autocomplete="new-password" required>
                                        <div class="input-group-append input_field_shadow">
                                            <span id="showPassword" class="btn btn-light col-md-4 input-group-text form-control form-control-user typePassword"><i class="bi bi-eye-slash-fill"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-msg"></span>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="confirm_password" class="form-label star">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" onchange="validateResetPassField();" placeholder="Re-enter the password " aria-describedby="confirm password" autocomplete="confirm-password" required>
                                    <span class="error-msg"></span>
                                </div>
                                
                                <div class="col-md-6">
                                    <button type="button" id="reset_password_btn" class="btn btn-primary" onclick="resetPassword();" disabled>Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
            
                </div>    
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
<?php 
require "layout/footer.php"; 
?>
 
<script src="assets/js/forms-tab.js?<?php echo time() ?>"></script>
<script type="text/javascript">
    var passwordField = document.getElementById("password");
    var showPasswordBtn = document.getElementById("showPassword");
    var showPasswordIcon = document.querySelector("#showPassword i");
    let email='';

    // Set the countdown duration in seconds (e.g., 10 minutes = 600 seconds)
    let countdownDuration = 600;
    let timerElement = document.getElementById("timer");
    let timerElementErrorMsg = document.getElementById("timer_error_msg");
    
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        let timerInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(timerInterval); // Stop the interval
                // Timer has expired, you can perform an action here
                popUpMsg("OTP has expired.");
                // You can also redirect the user or perform another action
                $("#verify_otp_btn").addClass("d-none");
                $("#resend_otp_btn").removeClass("d-none");
                showErrorField("timer", 'error');
                timerElementErrorMsg.textContent = "OTP has expired, Please Resend!";
                
            }
        }, 1000);
    }

    $(function(){
        $("#form_0").addClass('d-block');
        // console.log(userData);
    })

    showPasswordBtn.addEventListener('click', e => {
        e.preventDefault();
        showPasswordIcon.classList.toggle('bi-eye-fill');
        showPasswordIcon.classList.toggle('bi-eye-slash-fill');
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    });

    function validateEmailField(id, msg) {
        let res = validateEmailId(id, msg);
        if (res) {
            document.getElementById("send_otp_btn").disabled = false;
        } else {
            document.getElementById("send_otp_btn").disabled = true;
        }
    }
    function sendOTP() {
        email = $("#username").val();
        // send OTP to user id
        callApi({
            method: 'GET',
            url: 'api/sendOtpApi.php?type=request&email='+email,
            form_type: 'request_OTP',
        });
    }
    function resendOTP() {
        sendOTP();
        $("#verify_otp_btn").removeClass("d-none");
        $("#resend_otp_btn").addClass("d-none");
        timerElementErrorMsg.textContent = "";
    }

    function getApiResponse(res, type) {
        if (res.flag && res.status == '200') {
            if (type=='request_OTP') {
                openNextForm('', 1);
                startTimer(countdownDuration, timerElement);

            } else if (type=='verify_OTP') {
                openNextForm('',2);

            } else if (type=='reset_password') {
                popUpMsg(res.message);
                window.location.href = "response.php?s=hfnkdu7985et";
            }
        } else {
            popUpMsg(res.message);
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateOtpField() {
        let otp = $("#otp").val();
        if (otp.length==6) {
            document.getElementById("verify_otp_btn").disabled = false;
        } else {
            document.getElementById("verify_otp_btn").disabled = true;
        }
    }
    function verifyOTP(){
        let otp = $("#otp").val();
        // call api and check OTP 
        callApi({
            method: 'GET',
            url: 'api/sendOtpApi.php?type=verify&email='+email+'&otp='+otp,
            form_type: 'verify_OTP',
        });
    }
    
    function validateResetPassField() {
        if (validatePassword()) {
            document.getElementById("reset_password_btn").disabled = false;
        } else {
            document.getElementById("reset_password_btn").disabled = true;
        }
    }
    function resetPassword() {
        let res = validateNewPassword("password");
        if (res) {
            if (validatePassword()) {
                let getPassword = $("#password").val();
                // call api update password 
                callApi({
                    method: 'GET',
                    url: 'api/sendOtpApi.php?type=reset&email='+email+'&password='+getPassword,
                    form_type: 'reset_password',
                });
                // go to next form
            }
        }
    }

</script>
</body>
</html>