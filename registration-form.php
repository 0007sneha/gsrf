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
include "data/generalData.php";
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
                                <li>Register</li>
                            </ol>
                            <h2>
                                Registration
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <form class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms" id="register_form" name="register_form">
                    <div class="row">
                        <h3>Personal Information</h3>
                        <p class="mb-4">
                            We need you to help us with some basic information for your account creation.
                        </p>
                        <div class="col-md-4 mb-4">
                            <label for="first_name" class="form-label star">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="" placeholder="Enter your first name" aria-describedby="first name" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="" placeholder="Enter your middle name" aria-describedby="middle name">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="last_name" class="form-label star">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="" placeholder="Enter your last name" aria-describedby="last name" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="dob" class="form-label star">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="" placeholder="DD/MM/YYYY" aria-describedby="DOB" required>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <label for="phone_no" class="form-label star">Mobile No.</label>
                            <div class="input-group mb-3 input_field_shadow">
                                <select id="country_code" name="country_code" class="input-group-text merge_input_field">
                                    <?php
                                        foreach ($countryCodeArr as $key => $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                        }
                                    ?>
                                </select>
                                <input type="number" class="form-control" id="phone_no" name="phone_no" value="" aria-describedby="basic-addon3" pattern="[6789][0-9]{9}" title="Please enter valid phone number" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="basic-url" class="form-label star">Gender</label>
                            <br>
                            <div class="form-check d-inline-block pt-1 ">
                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" checked="true" required>
                                <label class="form-check-label" for="gender1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check d-inline-block pt-1 ">
                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="female" required>
                                <label class="form-check-label" for="gender2">
                                    Female
                                </label>
                            </div>
                            <div class="form-check d-inline-block pt-1 ">
                                <input class="form-check-input" type="radio" name="gender" id="gender3" value="transgender" required>
                                <label class="form-check-label" for="gender3">
                                    Other
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="category" class="form-label star">Category</label>
                            <select class="form-select input_field_shadow" id="category" aria-label="category" aria-label="Default select example" required>
                                <?php
                                    foreach ($categoriesArr as $key => $value) {
                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-4 d-none" id="file_category_certificate_field">
                            <label for="file_category_certificate" class="form-label star">Upload Certificate</label>
                            <p>(Attach a scanned PDF copy of max 200KB)</p>
                            <div class="form-check" style="padding-left: 0;">
                                <input type="file" id="file_category_certificate" name="file_category_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                <?php showProgressBar('docs','file_category_certificate', ''); ?>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="basic-url" class="form-label star">Differently Abled?</label>
                            <br>
                            <div class="form-check d-inline-block pt-1 ">
                                <input class="form-check-input" type="radio" name="diff_abled" id="diff_abled1" value="1" required>
                                <label class="form-check-label" for="diff_abled1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check d-inline-block pt-1 ">
                                <input class="form-check-input" type="radio" name="diff_abled" id="diff_abled2" value="0" checked="true" required>
                                <label class="form-check-label" for="diff_abled2">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row"> 
                        <h3>Identity Proof Details</h3>
                        <p>
                            As part of the registration process, we need to verify your identity. Please provide the 
                            <br> required identity proof details.
                        </p>
                        <div class="col-md-6 mb-4">
                            <label for="identity_no" class="form-label star">Aadhar No / PAN no / EPIC no</label>
                            <div class="input-group">
                                <input type="password" id="identity_no" name="identity_no" value="" class="form-control col-md-8" placeholder="" aria-label="identity_no" aria-describedby="showIdentityNo" autocomplete="user id proof" required>
                                <div class="input-group-append input_field_shadow">
                                    <span id="showIdentityNo" class="btn btn-light col-md-4 input-group-text form-control form-control-user typePassword"><i class="bi bi-eye-slash-fill"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row"> 
                        <h3>Signup Details</h3>
                        <p>
                            Please enter the Email ID and Password you wish to use for your account.
                        </p>                       
                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label star">Email ID</label>
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter your email id" aria-describedby="email" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="password" class="form-label star">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control col-md-8" id="password" name="password" value="" onchange="validatePassword();" placeholder="Enter new password" aria-label="password" aria-describedby="showPassword" autocomplete="new-password" required>
                                <div class="input-group-append input_field_shadow">
                                    <span id="showPassword" class="btn btn-light col-md-4 input-group-text form-control form-control-user typePassword"><i class="bi bi-eye-slash-fill"></i></span>
                                </div>
                            </div>
                            <span class="error-msg"></span>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="confirm_password" class="form-label star">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" onchange="validatePassword();" placeholder="Re-enter the password " aria-describedby="confirm password" autocomplete="confirm-password" required>
                            <span class="error-msg"></span>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4 d-none form-check">
                        <input type="checkbox" class="form-check-input" id="is_sms_alert" name="is_sms_alert" value="">
                        <label class="form-check-label" for="is_sms_alert">I want to receive SMS alerts</label>
                    </div>
                    
                    <div class="col-md-12 mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="is_terms_policy" name="is_terms_policy" value="" required>
                        <label class="form-check-label" for="is_terms_policy">I agree to the GSRF <a href="privacy-policy.php" target="_blank">privacy policy</a></label>
                    </div>
                    
                    <!-- The g-recaptcha-response string displays in an alert message upon submit. -->
                    <div id="getRecaptcha"></div>
                    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
                    
                    <div class="row mt-5 mb-0" style="justify-content: space-between;"> 
                        <button type="button" class="btn btn-outline reset_btn" onclick="resetData();">Reset</button>
                        <button type="submit" class="btn btn-primary submit_btn">Submit</button>
                    </div>
                </form>    
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
<?php 
function showProgressBar($fileType, $responseId, $margin) {
    if ($fileType=='docs') {
        echo '
            <a href="#" class="btn btn-outline '.$margin.' d-none" id="view_'.$responseId.'" target="_blank">View File(<span></span>)</a>
            <a href="#" class="btn btn-outline remove_file text-center '.$margin.' d-none" id="remove_'.$responseId.'" onclick="removeUploadedFile(\''.$fileType.'\', \''.$responseId.'\', \'registerUserData\'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
        ';
    } else {

    }
    echo '
        <span class="btn btn-outline text-center fw6 '.$margin.' d-none" id="upload_'.$responseId.'">Uploading your file</span>
        <div class="progress mx-3 p-0 progressBarContainer d-none" style="height:6px; max-width:340px;">
            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated progressBarWidth" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
    ';
}
?>
<?php require "layout/footer.php"; ?>
 
<script>
    let registerForm = document.getElementById("register_form")
    let passwordField = document.getElementById("password");
    let showPasswordBtn = document.getElementById("showPassword");
    let showPasswordIcon = document.querySelector("#showPassword i");
    let identityNo = document.getElementById("identity_no");
    let showIdentityNoBtn = document.getElementById("showIdentityNo");
    let showIdentityIcon = document.querySelector("#showIdentityNo i");
    let category = is_sms_alert = is_terms_policy = 0;
    let file_category_certificate = aadharNumber = epicNumber = panNumber = dob = '';
    
    const fileInputCategoryCertificate = document.getElementById('file_category_certificate');
    
    var saveData = getSavedData = object = {};
    var json, formData;

    $( document ).ready(function() {
        // set max date as Today 
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        document.getElementById('dob').max = today;
        // add here 
        saveData["file_category_certificate"] = '';
        localStorage.setItem("registerUserData", JSON.stringify(saveData));
    });

    
    $("#category").on("change", function() {
        category = this.value;
        showMoreOptions('category', category);
    });
    
    $("#dob").on("change", function() {
        dob = this.value;
    });

    fileInputCategoryCertificate.addEventListener('change', async (event) => {
		const file = event.target.files[0];
		if (file) {
            const encodedFile = await encodeFile(file);
            let fileData = {
                "file" : encodedFile,
                "file_name" : file.name,
            }
            uploadFile({
                'file_type' : 'docs', 
                'response_id' : 'file_category_certificate', 
                'file_id' : fileInputCategoryCertificate, 
                'file_data' : fileData, 
                'storage_key' : 'registerUserData'
            });
        } else {
            popUpMsg('Please select a File!');
		}
	});

    $("#is_sms_alert").on('change', function() {
        if ($(this).is(':checked')) {
            is_sms_alert = 1;
        } else {
            is_sms_alert = 0;
        }
    });
    $("#is_terms_policy").on('change', function() {
        if ($(this).is(':checked')) {
            is_terms_policy = 1;
        } else {
            is_terms_policy = 0;
        }
    });

    showIdentityNoBtn.addEventListener('click', e => {
        e.preventDefault();
        showIdentityIcon.classList.toggle('bi-eye-fill');
        showIdentityIcon.classList.toggle('bi-eye-slash-fill');
        
        if (identityNo.type === "password") {
            identityNo.type = "text";
        } else {
            identityNo.type = "password";
        }
    });
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

    function resetData() {
        $("#first_name").val("");
        $("#middle_name").val("");
        $("#last_name").val("");
        $("#dob").val("");
        $("#country_code").val("");
        $("#phone_no").val("");
        $('input:radio[name=gender]').val([]);
        $("#category").val("");
        $('input:radio[name=diff_abled]').val([]);
        $("#identity_no").val("");
        $("#email").val("");
        $("#password").val("");
        $("#confirm_password").val("");
    }

    // Register form
    registerForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if (localStorage.getItem("registerUserData")) {
            getSavedData = JSON.parse(localStorage.getItem("registerUserData"));
            file_category_certificate = getSavedData["file_category_certificate"];
        }
        formData = new FormData(registerForm);
        formData.append("is_terms_policy", is_terms_policy);
        formData.append("is_sms_alert", is_sms_alert);
        formData.append("category", category);
        formData.append("file_category_certificate", file_category_certificate);
        formData.append("type", "registration");
        formData.forEach((value, key) => object[key] = value);
        // console.log(object);
        
        // handle submit
        if (validateDOB("dob")) {
            if (validatePhoneNumber("phone_no", "Please enter valid mobile number!")) {
                if (category==0 || category==2) { 
                    if (category==0) {
                        popUpMsg('Please select category !.'); return false; 
                    }
                } else {
                    if (!file_category_certificate){ popUpMsg('Please upload the certificate.'); return false; }
                }
                if (verifyIdentification($("#identity_no").val())) {
                    if (validateEmailId("email", "Email address cannot be empty !")) {
                        if (validatePassword()) {
                            if (!reCaptchaResponse) {
                                // check duplicate value
                                AmagiLoader.show();
                                $.ajax({
                                    type: "POST",
                                    url: "api/registerUserApi.php",
                                    data: JSON.stringify(object),
                                    success: function(res)
                                    {
                                        // console.log(res);
                                        var responseData = JSON.parse(res);
                                        if (responseData.flag && responseData.status=='200') {
                                            popUpMsg(responseData.message, "", "success");
                                            window.location.href="account-verification.php";
                                            // window.location.reload();

                                        } else if (responseData.flag && responseData.status=='401') {
                                            popUpMsg(responseData.message, "", "warning");
                                            $("#"+responseData.data.focus_field).focus();

                                        } else if (!responseData.flag && responseData.status=='500') {
                                            popUpMsg(responseData.message, "", "error");
                                            window.scrollTo({ top: 0, behavior: 'smooth' });
                                        }
                                    
                                        AmagiLoader.hide();
                                    }
                                });
                            } else {
                                popUpMsg("Please select ReCaptcha!!", "", "warning");
                            }
                        } else {
                            console.log(' invalid password ');
                        }
                    }
                }
            }
        }
    });
</script>
</body>
</html>