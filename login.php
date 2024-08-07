<?php
require "layout/head.php";
if (isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
?>
<script src="assets/js/captcha.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

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
                                    <li>Login</li>
                                </ol>
                                <!-- <h2>
                                Login to Portal
                                <br>
                                <p>
                                    Login to your personalized account and unlock a world of opportunities tailored just for you
                                </p>
                            </h2> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-page">
            <div class="container">
                <div class="row d-flex justify-content-md-center">
                    <form class="col-md-10 forms login_form px-5 py-5">
                        <div class="row mb-0">
                            <div class="col-md-7">
                                <img class="img-fluid pt-5" src="assets/img/bg/image1.png" alt="">
                            </div>
                            <div class="col-md-5">
                                <!-- <h3 class="mb-4">Login Details</h3> -->
                                <div class="col-md-12 mb-4">
                                    <label for="login_id" class="form-label">Email ID</label>
                                    <input type="text" class="form-control" id="username"
                                        placeholder="Enter your email id" aria-describedby="login_id">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control col-md-8"
                                            placeholder="Enter new password" aria-label="password"
                                            aria-describedby="showPassword" autocomplete="new-password">
                                        <div class="input-group-append input_field_shadow">
                                            <span id="showPassword"
                                                class="btn btn-light col-md-4 input-group-text form-control form-control-user typePassword"><i
                                                    class="bi bi-eye-slash-fill"></i></span>
                                        </div>
                                    </div>
                                    <a href="forgot-password.php" class="btn btn-outline link_btn">Forgot Password?</a>
                                </div>
                                <!-- The g-recaptcha-response string displays in an alert message upon submit. -->
                                <!--  <div id="getRecaptcha" class="mb-4"></div>
                            <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
                             -->
                                <div class="row" style="justify-content: space-between;">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary submit_btn sign_in"
                                            onclick="loginUser();">Sign In</button>
                                        <p>
                                            Don't have an account?
                                            <button type="button" class="btn btn-outline link_btn"
                                                onclick="location.href='registration-form.php'">Register</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->
    <?php require "layout/footer.php"; ?>

    <script type="text/javascript">
        var password = document.getElementById("password");
        var showPasswordBtn = document.getElementById("showPassword");
        var showPasswordIcon = document.querySelector("#showPassword i");

        showPasswordBtn.addEventListener('click', e => {
            e.preventDefault();
            showPasswordIcon.classList.toggle('bi-eye-fill');
            showPasswordIcon.classList.toggle('bi-eye-slash-fill');
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        });

        function loginUser() {
            var data = {
                username: $("#username").val(),
                password: $("#password").val(),
            }
            if (!reCaptchaResponse) {
                callApi({
                    method: 'POST',
                    url: 'api/loginApi.php',
                    data: data,
                    form_type: 'login',
                });
            } else {
                popUpMsg("Please select ReCaptcha !!", "", "warning");
            }
        }

    </script>
</body>

</html>