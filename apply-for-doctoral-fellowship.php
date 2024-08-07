<?php 
require "layout/head.php"; 
if (!isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
$schemeUrl = "schemes-doctoral-fellowship.php";
?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/generalData.php";
$isSchemeAvailableFor = "DF"; 
include "data/schemesData.php";
include "layout/form-tab-nav-buttons.php";
?>
<script>
    let scheme_code = '<?php echo $isSchemeAvailableFor; ?>';
</script>
<main id="main"> 
    <section class="breadcrumbs">
        <div class="container">
            <div class="row d-flex justify-content-xl-center">
                <div class="col-md-12 col-lg-12 col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li><a href="index.php">Home</a></li>
                                <li>Schemes</li>
                                <li><a href="<?php echo $schemeUrl;?>">Doctoral Fellowship</a></li>
                                <li>Apply Here</li>
                            </ol>
                            <h2>
                                Application for Doctoral (Ph.D.) Fellowship
                                <br>
                                <p>
                                    Embark on an Extraordinary Research Voyage: Apply Now for the Doctoral (Ph.D.) Fellowship Scheme 
                                    <br>
                                    and open doors to unparalleled academic exploration and advancement.
                                </p>
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
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10">
                    <div class="custom-horizontal-tabs">
                        <div class="tabs">
                            <div class="tab active" id="tab_0">
                                <div class="tab-number">1</div>
                                <div class="tab-text">Personal Information</div>
                            </div>
                            <div class="tab" id="tab_1">
                                <div class="tab-number">2</div>
                                <div class="tab-text">Qualification</div>
                            </div>
                            <div class="tab" id="tab_2">
                                <div class="tab-number">3</div>
                                <div class="tab-text">Ph.D Details</div>
                            </div>
                            <div class="tab" id="tab_3">
                                <div class="tab-number">4</div>
                                <div class="tab-text">Guide Details</div>
                            </div>
                            <div class="tab" id="tab_4">
                                <div class="tab-number">5</div>
                                <div class="tab-text">Work Details</div>
                            </div>
                            <div class="tab" id="tab_5">
                                <div class="tab-number">6</div>
                                <div class="tab-text">Proposed Work Details</div>
                            </div>
                            <div class="tab" id="tab_6">
                                <div class="tab-number">7</div>
                                <div class="tab-text">Certificates</div>
                            </div>
                        </div>
                
                        <form class="forms">
                            <input type="hidden" id="scheme_id" name="scheme_id" value="" readonly>
                            <!-- Step One -->
                            <div id="form_0" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Personal Information</h3>
                                    <div class="col-md-4 mb-4">
                                        <label for="fname" class="form-label star">First Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="" oninput="validateInput(this)" placeholder="Enter your first name" aria-describedby="first name" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_first_name" onClick="displayInputField('first_name')"><i class="bi bi-pencil-fill"></i></button>
                                            <span class="error-msg col-md-12" id="first_name_error_msg"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="mname" class="form-label">Middle Name</label>
                                        <div class="input-group mb-3">        
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="" placeholder="Enter your middle name" aria-describedby="middle name" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_middle_name" onClick="displayInputField('middle_name')"><i class="bi bi-pencil-fill"></i></button>
                                        </div>                                    
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="lname" class="form-label star">Last Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="" oninput="validateInput(this)" placeholder="Enter your last name" aria-describedby="last name" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_last_name" onClick="displayInputField('last_name')"><i class="bi bi-pencil-fill"></i></button>
                                            <span class="error-msg col-md-12" id="last_name_error_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="dob" class="form-label star">Date of Birth</label>
                                        <div class="input-group mb-3">        
                                            <input type="date" class="form-control" id="dob" name="dob" value="" placeholder="DD/MM/YYYY" aria-describedby="DOB" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_dob" onClick="displayInputField('dob')"><i class="bi bi-pencil-fill"></i></button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-8 mb-4">
                                        <label for="res_address" class="form-label star">Residential Address</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="res_address" id="res_address" oninput="validateInput(this)" cols="80" rows="2" required></textarea>
                                            <span class="error-msg col-md-12" id="res_address_error_msg"></span>
                                        </div>
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
                                            <input type="number" class="form-control" id="phone_no" value="" aria-describedby="phone_no" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_phone_no" onClick="displayInputField('phone_no')"><i class="bi bi-pencil-fill"></i></button>
                                        </div>
                                    </div>                    
                                    <div class="col-md-4 mb-4">
                                        <label for="email" class="form-label star">Email ID</label>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" id="email" value="" placeholder="Enter your email id" aria-describedby="email" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_email" onClick="displayInputField('email')"><i class="bi bi-pencil-fill"></i></button>
                                            <span class="error-msg col-md-12" id="email_error_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="basic-url" class="form-label star">Gender</label>
                                        <br>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" checked="true">
                                            <label class="form-check-label" for="gender1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="female">
                                            <label class="form-check-label" for="gender2">
                                                Female
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="gender" id="gender3" value="other">
                                            <label class="form-check-label" for="gender3">
                                                other
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="institutional_address" class="form-label star">Institutional Address</label>
                                        <textarea class="form-control" name="institutional_address" id="institutional_address" oninput="validateInput(this)" cols="80" rows="2"></textarea>
                                        <span class="error-msg col-md-12" id="institutional_address_error_msg"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="category" class="form-label star">Category</label>
                                        <select class="form-select input_field_shadow" id="category" aria-label="category">
                                            <?php
                                                foreach ($categoriesArr as $key => $value) {
                                                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-8 mb-4 d-none" id="file_category_certificate_field">
                                        <label for="file_category_certificate" class="form-label star">Upload Certificate</label><br>
                                        <small class="form-text text-muted"><strong>Note: </strong>Please upload a valid Certificate</small>
                                        <small class="form-text text-muted">(Scanned PDF copy of max <strong>700KB</strong>)</small> <?php include "layout/tooltip-i.php"; ?> 
                                        <div class="form-check col-md-7" style="padding-left: 0;">
                                            <input type="file" id="file_category_certificate" name="file_category_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                            <?php showProgressBar('docs','file_category_certificate', ''); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="basic-url" class="form-label star">Do you have Residence certificate?</label>
                                        <br>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_domicile_certificate" id="is_domicile_certificate1" value="1">
                                            <label class="form-check-label" for="is_domicile_certificate1">
                                                yes
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_domicile_certificate" id="is_domicile_certificate2" value="0" checked="true">
                                            <label class="form-check-label" for="is_domicile_certificate2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mb-4">
                                        <span class="d-none" id="file_domicile_certificate_field">
                                            <label for="file_domicile_certificate" class="form-label star fw6">Upload Residence certificate(15 years)</label><br>
                                            <small class="form-text text-muted"><strong>Note: </strong>Please upload a valid Certificate</small>
                                            <small class="form-text text-muted">(Scanned PDF copy of max <strong>700KB</strong>)</small> <?php include "layout/tooltip-i.php"; ?> 
                                            <div class="form-check col-md-7" style="padding-left: 0;">
                                                <input type="file" id="file_domicile_certificate" name="file_domicile_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_domicile_certificate', ''); ?>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4" id="file_profile_picture_field">
                                        <label for="file_profile_picture" class="form-label star">User Picture</label>
                                        <p>Please upload a 3.5cm x 4.5cm passport-size photo.</p>
                                        <div class="form-check image_container">
                                            <input type="file" id="file_profile_picture" name="file_profile_picture" placeholder="" class="form-control input-md d-none" accept="image/png, image/jpeg, image/jpg" >
                                            <a href="javascript:void(0)" class="fill_image_container" onclick="$('#file_profile_picture').click()" title="Upload a new File">
                                                <div id="hide_center_container" class="center_container">
                                                    <i class='bi bi-cloud-arrow-up-fill' style='font-size:50px'></i><br>
                                                    <!-- Drag and drop your file here Or  -->
                                                    Browse your file
                                                </div>
                                                <img class="row d-none" id="img_file_profile_picture" src="" alt="profile picture" />
                                                <?php showProgressBar('img','file_profile_picture', 'mt45'); ?>
                                            </a>
                                            <a href="#" class="btn btn-outline remove_file text-center d-none" id="remove_file_profile_picture" onclick="removeUploadedFile('img', 'file_profile_picture', 'doctoralFellowshipData'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(3,'',0,1,1); ?>
                            </div>
                            <div id="form_1" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Qualification Details</h3>
                                    <div class="col-md-12 table-responsive mb-4">
                                        <label class="form-label star">Educational Qualifications</label>
                                        <table class="table table-stripped table-bordered border-light edu_details">
                                            <thead class="table-dark">
                                                <th>Degree</th>
                                                <th>Board/ University</th>
                                                <th>School/ College</th>
                                                <th>Year of Passing</th>
                                                <th>Percentage</th>
                                                <th>CGPA</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="star">SSC</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="board_name_1" id="board_name_1" value="" oninput="validateInput(this)" placeholder="Enter Board/ University" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="board_name_1_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="college_name_1" id="college_name_1" value="" oninput="validateInput(this)" placeholder="Enter School/ College" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="college_name_1_error_msg"></span>
                                                    </td>
                                                    <td><select class="form-control input_field_shadow" name="year_of_passing_1" id="year_of_passing_1" onchange="getYearOfPassing(this.value, 1)"></select></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="marks_1" id="marks_1" value="" oninput="validateInput(this)" placeholder="%" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="marks_1_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="cgpa_1" id="cgpa_1" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_1_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="star">HSSC</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="board_name_2" id="board_name_2" value="" oninput="validateInput(this)" placeholder="Enter Board/ University" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="board_name_2_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="college_name_2" id="college_name_2" value="" oninput="validateInput(this)" placeholder="Enter School/ College" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="college_name_2_error_msg"></span>
                                                    </td>
                                                    <td><select class="form-control input_field_shadow" name="year_of_passing_2" id="year_of_passing_2" onchange="getYearOfPassing(this.value, 2)"></select></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="marks_2" id="marks_2" value="" oninput="validateInput(this)" placeholder="%" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="marks_2_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="cgpa_2" id="cgpa_2" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_2_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="star">UG</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="board_name_3" id="board_name_3" value="" oninput="validateInput(this)" placeholder="Enter Board/ University" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="board_name_3_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="college_name_3" id="college_name_3" value="" oninput="validateInput(this)" placeholder="Enter School/ College" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="college_name_3_error_msg"></span>
                                                    </td>
                                                    <td><select class="form-control input_field_shadow" name="year_of_passing_3" id="year_of_passing_3" onchange="getYearOfPassing(this.value, 3)"></select></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="marks_3" id="marks_3" value="" oninput="validateInput(this)" placeholder="%" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="marks_3_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="cgpa_3" id="cgpa_3" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_3_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="star">PG</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="board_name_4" id="board_name_4" value="" oninput="validateInput(this)" placeholder="Enter Board/ University" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="board_name_4_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="college_name_4" id="college_name_4" value="" oninput="validateInput(this)" placeholder="Enter School/ College" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="college_name_4_error_msg"></span>
                                                    </td>
                                                    <td><select class="form-control input_field_shadow" name="year_of_passing_4" id="year_of_passing_4" onchange="getYearOfPassing(this.value, 4)"></select></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="marks_4" id="marks_4" value="" oninput="validateInput(this)" placeholder="%" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="marks_4_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="cgpa_4" id="cgpa_4" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_4_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>ANY OTHER</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="board_name_5" id="board_name_5" value="" oninput="validateInput(this)" placeholder="Enter Board/ University" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="board_name_5_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="college_name_5" id="college_name_5" value="" oninput="validateInput(this)" placeholder="Enter School/ College" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="college_name_5_error_msg"></span>
                                                    </td>
                                                    <td><select class="form-control input_field_shadow" name="year_of_passing_5" id="year_of_passing_5" onchange="getYearOfPassing(this.value, 5)"></select></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="marks_5" id="marks_5" value="" oninput="validateInput(this)" placeholder="%" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="marks_5_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="cgpa_5" id="cgpa_5" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_5_error_msg"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,0,1,1,2); ?>
                            </div>
                            <div id="form_2" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Ph.D Details</h3>
                                    <div class="col-md-7 mb-4">
                                        <label for="phd_work_carried_out" class="form-label star col-md-8">Institute/College wherein Ph.D. work is being carried out</label>
                                        <input type="text" class="form-control" name="phd_work_carried_out" id="phd_work_carried_out" value="" oninput="validateInput(this)" placeholder="Enter full address" aria-describedby="">
                                        <span class="error-msg col-md-12" id="phd_work_carried_out_error_msg"></span>
                                    </div>
                                    <div class="col-md-5 mb-4">
                                        <label for="is_registered_with_goa_uni" class="form-label star col-md-10">Are you registered with Goa University for Ph.D.</label>
                                        <br>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_registered_with_goa_uni" id="registered_with_goa_uni_1" value="1">
                                            <label class="form-check-label" for="registered_with_goa_uni_1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_registered_with_goa_uni" id="registered_with_goa_uni_0" value="0" checked="true">
                                            <label class="form-check-label" for="registered_with_goa_uni_0">
                                                No
                                            </label>
                                        </div>
                                        <br>
                                        <span class="error-msg col-md-12" id="is_registered_with_goa_uni_error_msg">You are not eligible !</span>
                                    </div>
                                    
                                    <div class="col-md-3 mb-4">
                                        <label for="registration_date" class="form-label star">Date of Registration</label>
                                        <input type="date" class="form-control" id="registration_date" onchange="validateDate(this,'reg_con_date', '');" placeholder="DD/MM/YYYY" aria-describedby="registration_date">
                                        <span class="error-msg col-md-12" id="registration_date_error_msg"></span>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="confirmation_date" class="form-label star">Date of confirmation of registration</label>
                                        <input type="date" class="form-control" id="confirmation_date" onchange="validateDate(this,'reg_con_date', '');" placeholder="DD/MM/YYYY" aria-describedby="confirmation_date">
                                        <span class="error-msg col-md-12" id="confirmation_date_error_msg"></span>
                                    </div>
                                    <div class="col-md-5 mb-4" id="file_confirmation_letter_field">
                                        <label for="file_confirmation_letter" class="form-label star">Attach copy of the confirmation letter</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" name="file_confirmation_letter" id="file_confirmation_letter" value="" placeholder="" class="form-control input-md" accept="application/pdf">
                                            <?php showProgressBar('docs','file_confirmation_letter', ''); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="phd_subject_area" class="form-label star">Subject area in which Ph.D. is registered</label>
                                        <input type="text" class="form-control" name="phd_subject_area" id="phd_subject_area" value="" oninput="validateInput(this)" placeholder="eg. Biotechnology, Economics, Commerce, etc" aria-describedby="">
                                        <span class="error-msg col-md-12" id="phd_subject_area_error_msg"></span>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,1,2,1,3); ?>
                            </div>
                            <div id="form_3" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Guide Details</h3>
                                    <div class="input_fields_wrap">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="row wrapper_row">
                                                    <div class="form-group col-md-4 mb-4">
                                                        <label class="form-label star" style="font-weight:600" for="guide_name_1">Name of the Guide</label>  
                                                        <input type="text" id="guide_name_1" name="guide_name[]" value="" oninput="validateInput(this)" placeholder="Enter name" class="form-control">
                                                        <span class="error-msg col-md-12" id="guide_name_1_error_msg"></span>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-4">
                                                        <label class="form-label star" style="font-weight:600" for="guide_designation_1">Designation</label>  
                                                        <input type="text" id="guide_designation_1" name="guide_designation[]" value="" oninput="validateInput(this)" placeholder="Enter designation" class="form-control">
                                                        <span class="error-msg col-md-12" id="guide_designation_1_error_msg"></span>
                                                    </div>
                                                    <div class="form-group col-md-5 mb-4">
                                                        <label class="form-label star" style="font-weight:600" for="guide_address_1">Institutional Address</label>  
                                                        <input type="text" id="guide_address_1" name="guide_address[]" value="" oninput="validateInput(this)" placeholder="Enter address" class="form-control">
                                                        <span class="error-msg col-md-12" id="guide_address_1_error_msg"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                        </div>
                                    </div>   <!-- Show Added Days -->
									<button type="button" class="btn link_btn add_field_button" style="text-align: inherit;">+ Add Co-Guide (if any)</button>
                                </div>
                                <?php showNavigationButton(0,2,3,1,4); ?>
                            </div>
                            <div id="form_4" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Work Details</h3>
                                    <div class="col-md-6 mb-4">
                                        <label for="proposed_work" class="form-label star">Title of the proposed work (thesis)</label>
                                        <input type="text" class="form-control" name="proposed_work" id="proposed_work" oninput="validateInput(this)" value="" placeholder="Enter title of the proposed work" aria-describedby="">
                                        <span id="proposed_work_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="work_background" class="form-label star">Background of the work </label>
                                        <p>Not more than 200 words</p>
                                        <textarea class="form-control input" name="work_background" id="work_background" oninput="validateInput(this)" onkeyup="validateWordCount('work_background','200')" cols="80" rows="4"></textarea>
                                        Total word Count : <span id="work_background_display_count">0</span> / 200 words. <span id="work_background_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="hypothesis_proposed" class="form-label star">The hypothesis proposed / Gaps identified in existing knowledge</label>
                                        <p>Not more than 60 words</p>
                                        <textarea class="form-control" name="hypothesis_proposed" id="hypothesis_proposed" oninput="validateInput(this)" onkeyup="validateWordCount('hypothesis_proposed','60')" cols="80" rows="2"></textarea>
                                        Total word Count : <span id="hypothesis_proposed_display_count">0</span> / 60 words. <span id="hypothesis_proposed_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="objectives" class="form-label star">Objectives</label>
                                        <p>Not more than 50 words</p>
                                        <textarea class="form-control" name="objectives" id="objectives" oninput="validateInput(this)" onkeyup="validateWordCount('objectives','50')" cols="80" rows="2"></textarea>
                                        Total word Count : <span id="objectives_display_count">0</span> / 50 words. <span id="objectives_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="mat_and_methods_proposed" class="form-label star">Materials and Methods Proposed</label>
                                        <p>Not more than 200 words</p>
                                        <textarea class="form-control" name="mat_and_methods_proposed" id="mat_and_methods_proposed" oninput="validateInput(this)" onkeyup="validateWordCount('mat_and_methods_proposed','200')" cols="80" rows="4"></textarea>
                                        Total word Count : <span id="mat_and_methods_proposed_display_count">0</span> / 200 words. <span id="mat_and_methods_proposed_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="expected_outcome" class="form-label star">Expected outcome</label>
                                        <p>Not more than 100 words</p>
                                        <textarea class="form-control" name="expected_outcome" id="expected_outcome" oninput="validateInput(this)" onkeyup="validateWordCount('expected_outcome','100')" cols="80" rows="2"></textarea>
                                        Total word Count : <span id="expected_outcome_display_count">0</span> / 100 words. <span id="expected_outcome_error_msg" class="error-msg"></span>
                                    </div>
                                    <!-- <div class="col-md-12 mb-4">
                                        <label for="imp_references" class="form-label star">References</label>
                                        <p>Important references only, maximum 20</p>
                                        <textarea class="form-control" name="imp_references" id="imp_references" oninput="validateInput(this)" rows="5"></textarea>
                                        <span id="imp_references_error_msg" class="error-msg"></span>
                                    </div> -->
                                    <div class="col-md-12 table-responsive mb-4">
                                        <label class="star">References</label>
                                        <p>Important references only, maximum 20 </p>
                                        <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_imp_references">
                                            <thead class="table-light">
                                                <th>Sr. No.</th>
                                                <th>References</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr class="wrapper_row">
                                                    <td class="serial-number text-center">1</td>
                                                    <td>
                                                        <textarea class="form-control" name="imp_references[]" id="imp_references_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter References"></textarea>
                                                        <span id="imp_references_1_error_msg" class="error-msg col-md-12"></span>
                                                    </td>
                                                    <td width="62px">
                                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Add more fields -->
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn link_btn add_field_button_imp_references" style="text-align: inherit;">+ Add Reference</button>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="imp_of_proposed_work" class="form-label star">Importance of proposed work</label>
                                        <p>Not more than 100 words</p>
                                        <textarea class="form-control" name="imp_of_proposed_work" id="imp_of_proposed_work" oninput="validateInput(this)" onkeyup="validateWordCount('imp_of_proposed_work','100')" cols="80" rows="2"></textarea>
                                        Total word Count : <span id="imp_of_proposed_work_display_count">0</span> / 100 words. <span id="imp_of_proposed_work_error_msg" class="error-msg"></span>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,3,4,1,5); ?>
                            </div>
                            <div id="form_5" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Proposed Work Details</h3>
                                    <div class="col-md-4 mb-4">
                                        <label for="is_published_any_papers" class="form-label star">Have you published any papers in the proposed area?</label>
                                        <br>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_published_any_papers" id="is_published_any_papers_1" value="1">
                                            <label class="form-check-label" for="is_published_any_papers_1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_published_any_papers" id="is_published_any_papers_0" value="0" checked="true">
                                            <label class="form-check-label" for="is_published_any_papers_0">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md mb-4">
                                        <span class="d-none" id="file_published_papers_field">
                                            <label for="file_published_papers" class="form-label star fw6">Upload file</label><br>
                                            <small class="form-text text-muted"><strong>Note: </strong>Incase of more publication/large publication size, only first page of publications/ page to be uploaded respectively.</small>
                                            <small class="form-text text-muted">(Max size for scanned PDF copy is <strong>2MB</strong>)</small> <?php include "layout/tooltip-i.php"; ?> 
                                            <div class="form-check col-md-8" style="padding-left: 0;">
                                                <input type="file" id="file_published_papers" name="file_published_papers" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_published_papers', ''); ?>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-md-12 table-responsive mb-4">
                                        <label for="fname" class="form-label star">Timeline (Quarterly) of the proposed study : </label>
                                        <p>For a maximum of three years from now</p>
                                        <table class="table table-stripped table-bordered work_details">
                                            <thead class="table-dark">
                                                <th style="width: 10%;" >Year</th>
                                                <th style="width: 10%;" >Quarter</th>
                                                <th>Proposed Work</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th rowspan="4">I</th>
                                                    <th>1</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_1_1" id="proposed_work_1_1" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_1_1_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>2</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_1_2" id="proposed_work_1_2" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_1_2_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>3</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_1_3" id="proposed_work_1_3" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_1_3_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_1_4" id="proposed_work_1_4" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_1_4_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_2 "><!-- d-none -->
                                                    <th rowspan="4">II</th>
                                                    <th>1</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_2_1" id="proposed_work_2_1" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_2_1_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_2 "><!-- d-none -->
                                                    <th>2</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_2_2" id="proposed_work_2_2" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_2_2_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_2 "><!-- d-none -->
                                                    <th>3</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_2_3" id="proposed_work_2_3" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_2_3_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_2 "><!-- d-none -->
                                                    <th>4</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_2_4" id="proposed_work_2_4" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_2_4_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_3 "><!-- d-none -->
                                                    <th rowspan="4">III</th>
                                                    <th>1</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_3_1" id="proposed_work_3_1" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_3_1_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_3 "><!-- d-none -->
                                                    <th>2</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_3_2" id="proposed_work_3_2" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_3_2_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_3 "><!-- d-none -->
                                                    <th>3</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_3_3" id="proposed_work_3_3" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_3_3_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr class="quarter_3 "><!-- d-none -->
                                                    <th>4</th>
                                                    <td>
                                                        <textarea class="form-control" name="proposed_work_3_4" id="proposed_work_3_4" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                                        <span class="error-msg col-md-12" id="proposed_work_3_4_error_msg"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- <button type="button" class="btn link_btn quarter_2" onclick="addProposedWork(2);">+ Add Year</button>
                                        <button type="button" class="btn link_btn quarter_2 d-none" id="quarter_3" onclick="addProposedWork(3, true);">+ Add Year</button> -->
                                        
                                    </div>
                                </div>
                                <?php showNavigationButton(0,4,5,1,6); ?>
                            </div>
                            <div id="form_6" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Certificates</h3>
                                    <div class="col-md-8 mb-4">
                                        <label for="any_other_info" class="form-label">Any other information</label>
                                        <textarea class="form-control" name="any_other_info" id="any_other_info" oninput="validateInput(this)" cols="30" rows="2"></textarea>
                                        <span class="error-msg col-md-12" id="any_other_info_error_msg"></span>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="file_declaration_certificate" class="form-label star">Declaration by the candidate</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_declaration_certificate" name="file_declaration_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_declaration_certificate_field">
                                        <?php showProgressBar('docs','file_declaration_certificate', 'mt30'); ?>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="file_aadhar_card" class="form-label star">Aadhar Card</label><span>(Self Attested)</span>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_aadhar_card" name="file_aadhar_card" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_aadhar_card_field">
                                        <?php showProgressBar('docs','file_aadhar_card', 'mt30'); ?>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="file_res_guide_certificate" class="form-label star">Certificate from the Research Guide</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_res_guide_certificate" name="file_res_guide_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_res_guide_certificate_field">
                                        <?php showProgressBar('docs','file_res_guide_certificate', 'mt30'); ?>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="file_institute_head_certificate" class="form-label star">Certificate from the Head of the institute</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_institute_head_certificate" name="file_institute_head_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_institute_head_certificate_field">
                                        <?php showProgressBar('docs','file_institute_head_certificate', 'mt30'); ?>
                                    </div>
                                    
                                    <?php include 'layout/note-before-file-submission.php'; ?>
                                </div>
                                <?php showNavigationButton(0,5,6,'',''); ?>
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
<script>
    var saveData = getSavedData = {};
    let schemeBatchId = "<?php echo $doctoralFellowshipRequiredDocs["scheme_batch_id"] ?>";
    let form_no_saved = 0;

    let first_name=middle_name=last_name=dob=res_address=country_code=phone_no=
        email=institutional_address=
        file_category_certificate=file_profile_picture=file_domicile_certificate
        ="";
    let course_1=board_name_1=college_name_1=year_of_passing_1=marks_1=cgpa_1=
        course_2=board_name_2=college_name_2=year_of_passing_2=marks_2=cgpa_2=
        course_3=board_name_3=college_name_3=year_of_passing_3=marks_3=cgpa_3=
        course_4=board_name_4=college_name_4=year_of_passing_4=marks_4=cgpa_4=
        course_5=board_name_5=college_name_5=year_of_passing_5=marks_5=cgpa_5
        ="";
    let phd_work_carried_out=registration_date=confirmation_date=
        file_confirmation_letter=phd_subject_area
        =""; 
    let guide_names = document.getElementsByName("guide_name[]");
    let guide_designations = document.getElementsByName("guide_designation[]");
    let guide_addresses = document.getElementsByName("guide_address[]");
    let proposed_work ="";
    var work_background=hypothesis_proposed=objectives=mat_and_methods_proposed=
        expected_outcome=imp_of_proposed_work
        ="";
    let imp_references = document.getElementsByName("imp_references[]");

    let gender="male";
    let category=is_domicile_certificate=is_registered_with_goa_uni=is_published_any_papers=0;

    var file_published_papers=
        proposed_work_1_1=proposed_work_1_2=proposed_work_1_3=proposed_work_1_4=
        proposed_work_2_1=proposed_work_2_2=proposed_work_2_3=proposed_work_2_4=
        proposed_work_3_1=proposed_work_3_2=proposed_work_3_3=proposed_work_3_4
        ="";
    var any_other_info="";
    let file_declaration_certificate=file_aadhar_card=file_res_guide_certificate=file_institute_head_certificate
        ="";
    
    const fileInputCategoryCertificate = document.getElementById('file_category_certificate');
    const fileInputProfilePicture = document.getElementById('file_profile_picture');
    const fileInputDomicileCertificate = document.getElementById('file_domicile_certificate');
    const fileInputPublishedPaper = document.getElementById('file_published_papers');
    const fileInputConfirmationLetter = document.getElementById('file_confirmation_letter');
    const fileInputDeclarationCertificate = document.getElementById('file_declaration_certificate');
    const fileInputPIAadharCard = document.getElementById('file_aadhar_card');
    const fileInputResGuideCertificate = document.getElementById('file_res_guide_certificate');
    const fileInputInstituteHeadCertificate = document.getElementById('file_institute_head_certificate');

    let isSavedForm_0 = isSavedForm_1 = isSavedForm_2 = isSavedForm_3 = isSavedForm_4 = isSavedForm_5 = isSavedForm_6 = true; 

    // custom requirement 
    let isFileUploaded = 0;
    isUserApplicableForScheme(scheme_code);

	// add more fields function
	let max_fields = 10,
        max_fields_impReferences = 
        20; 
    let x = 
        x_impReferences = 
        1;
	var wrapper = $(".input_fields_wrap"); 		//Fields wrapper
	let add_button = $(".add_field_button"); 	//Add button ID
	var wrapper_impReferences = $(".input_fields_wrap_imp_references > tbody"); 		//Fields wrapper
	let add_button_impReferences = $(".add_field_button_imp_references"); 	//Add button ID

    $( document ).ready(function() {
        // display tab content
        setCurrentYearForYearOfPassing();

        // set max date as Today 
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        document.getElementById('dob').max = today;
        document.getElementById('registration_date').max = today;
        document.getElementById('confirmation_date').max = today;

        // set saved data
        saveData = getSavedData = JSON.parse(localStorage.getItem("doctoralFellowshipData"));
        if (getSavedData && getSavedData['id']) {
            form_no_saved = getSavedData['form_no'];
            if (form_no_saved) {
                openNextForm(0, form_no_saved);
            } else {
                $("#form_0").addClass('d-block');
            }
            
            $("#scheme_id").val(getSavedData['id']);

            $("#first_name").val(getSavedData['first_name']);
            $("#middle_name").val(getSavedData['middle_name']);
            $("#last_name").val(getSavedData['last_name']);
            $("#dob").val(getSavedData['dob']);
            $("#res_address").val(getSavedData['res_address']);
            $("#country_code").val(getSavedData['country_code']);
            $("#phone_no").val(getSavedData['phone_no']);
            $("#email").val(getSavedData['email']);
            if (getSavedData['gender']) {
                gender = getSavedData['gender'];
            }
            $("input:radio[name=gender]").val([gender]);
            $("#institutional_address").val(getSavedData['institutional_address']);
            if (getSavedData['file_profile_picture']) {
                file_profile_picture = getSavedData['file_profile_picture'];
                displayUploadedFile('img', 'file_profile_picture', file_profile_picture);
            }
            if (getSavedData['is_domicile_certificate']) {
                is_domicile_certificate = getSavedData['is_domicile_certificate'];
            }
            $("input:radio[name=is_domicile_certificate]").val([is_domicile_certificate]);
            showMoreOptions('domicile', is_domicile_certificate);
            if (getSavedData['file_domicile_certificate']) {
                file_domicile_certificate = getSavedData['file_domicile_certificate'];
                displayUploadedFile('docs', 'file_domicile_certificate', file_domicile_certificate);
            }
            if (getSavedData['category']) {
                category = getSavedData['category'];
            }
            $("#category").val(category);
            showMoreOptions('category', category);
            if (getSavedData['file_category_certificate']) {   
                file_category_certificate = getSavedData['file_category_certificate'];
                displayUploadedFile('docs', 'file_category_certificate', file_category_certificate);
            }
            $("#course_1").val(getSavedData["course_1"]);
            $("#board_name_1").val(getSavedData["board_name_1"]);
            $("#college_name_1").val(getSavedData["college_name_1"]);
            $("#year_of_passing_1").val(getSavedData["year_of_passing_1"]);
            $("#marks_1").val(getSavedData["marks_1"]);
            $("#cgpa_1").val(getSavedData["cgpa_1"]);
            $("#course_2").val(getSavedData["course_2"]);
            $("#board_name_2").val(getSavedData["board_name_2"]);
            $("#college_name_2").val(getSavedData["college_name_2"]);
            $("#year_of_passing_2").val(getSavedData["year_of_passing_2"]);
            $("#marks_2").val(getSavedData["marks_2"]);
            $("#cgpa_2").val(getSavedData["cgpa_2"]);
            $("#course_3").val(getSavedData["course_3"]);
            $("#board_name_3").val(getSavedData["board_name_3"]);
            $("#college_name_3").val(getSavedData["college_name_3"]);
            $("#year_of_passing_3").val(getSavedData["year_of_passing_3"]);
            $("#marks_3").val(getSavedData["marks_3"]);
            $("#cgpa_3").val(getSavedData["cgpa_3"]);
            $("#course_4").val(getSavedData["course_4"]);
            $("#board_name_4").val(getSavedData["board_name_4"]);
            $("#college_name_4").val(getSavedData["college_name_4"]);
            $("#year_of_passing_4").val(getSavedData["year_of_passing_4"]);
            $("#marks_4").val(getSavedData["marks_4"]);
            $("#cgpa_4").val(getSavedData["cgpa_4"]);
            $("#course_5").val(getSavedData["course_5"]);
            $("#board_name_5").val(getSavedData["board_name_5"]);
            $("#college_name_5").val(getSavedData["college_name_5"]);
            $("#year_of_passing_5").val(getSavedData["year_of_passing_5"]);
            $("#marks_5").val(getSavedData["marks_5"]);
            $("#cgpa_5").val(getSavedData["cgpa_5"]);
            $("#phd_work_carried_out").val(getSavedData["phd_work_carried_out"]);
            if (getSavedData['is_registered_with_goa_uni']) {
                is_registered_with_goa_uni = getSavedData['is_registered_with_goa_uni'];
            }
            $("input:radio[name=is_registered_with_goa_uni]").val([is_registered_with_goa_uni]);
            $("#registration_date").val(getToday(getSavedData["registration_date"]));
            $("#confirmation_date").val(getToday(getSavedData["confirmation_date"]));
            if (getSavedData["file_confirmation_letter"]) {
                file_confirmation_letter = getSavedData["file_confirmation_letter"];
                displayUploadedFile('docs', 'file_confirmation_letter', file_confirmation_letter);
            }
            $("#phd_subject_area").val(getSavedData["phd_subject_area"]);

            let guideDetails = getSavedData["guide_details"];
            let y = 0;
            if ( !guideDetails || guideDetails == "null" ) {} else {
                guideDetails.forEach(guideDetail => {
                    if(y < max_fields){ 					//max input box allowed
                        y++; 								//text box increment
                        if (y==1) {
                            $("#guide_name_1").val(guideDetail['guide_name']);
                            $("#guide_designation_1").val(guideDetail['guide_designation']);
                            $("#guide_address_1").val(guideDetail['guide_address']);
                        } else {
                            $(wrapper).append(`
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="form-group col-md-4 mb-4">
                                                <label class="form-label star" style="font-weight:600" for="guide_name_`+y+`">Name of the Co-Guide</label>  
                                                <input type="text" id="guide_name_`+y+`" name="guide_name[]" value="${guideDetail['guide_name']}" oninput="validateInput(this)" placeholder="Enter name" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="guide_name_`+y+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-3 mb-4">
                                                <label class="form-label star" style="font-weight:600" for="guide_designation_`+y+`">Designation</label>  
                                                <input type="text" id="guide_designation_`+y+`" name="guide_designation[]" value="${guideDetail['guide_designation']}" oninput="validateInput(this)" placeholder="Enter designation" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="guide_designation_`+y+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-5 mb-4">
                                                <label class="form-label star" style="font-weight:600" for="guide_address_`+y+`">Institutional Address</label>  
                                                <input type="text" id="guide_address_`+y+`" name="guide_address[]" value="${guideDetail['guide_address']}" oninput="validateInput(this)" placeholder="Enter address" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="guide_address_`+y+`_error_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                </div>
                            `); //add input box
                            if (y == max_fields) {
                                $(".add_field_button_inst_add").attr("disabled", true);
                            }
                        }
                    }
                });
            }
        
            $("#proposed_work").val(getSavedData["proposed_work"]);
            $("#work_background").val(getSavedData["work_background"]);
            $("#hypothesis_proposed").val(getSavedData["hypothesis_proposed"]);
            $("#objectives").val(getSavedData["objectives"]);
            $("#mat_and_methods_proposed").val(getSavedData["mat_and_methods_proposed"]);
            $("#expected_outcome").val(getSavedData["expected_outcome"]);
            // $("#imp_references").val(getSavedData["imp_references"]);
            if ( !getSavedData["imp_references_details"] || getSavedData["imp_references_details"] == "null" ) {} else {
                x_impReferences = 0;
                getSavedData["imp_references_details"].forEach(impReferencesDetail => {
                    if(x_impReferences < max_fields_impReferences){ 					//max input box allowed
                        x_impReferences++; 								//text box increment
                        if (x_impReferences==1) {
                            $("#imp_references_1").val(impReferencesDetail['name']);
                        } else {
                            $(wrapper_impReferences).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_impReferences+`</td>
                                    <td>
                                        <textarea class="form-control" name="imp_references[]" id="imp_references_`+x_impReferences+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter References">${impReferencesDetail['name']}</textarea>
                                        <span id="imp_references_`+x_impReferences+`_error_msg" class="error-msg col-md-12"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_impReferences == max_fields_impReferences) {
                                $(".add_field_button_inst_add").attr("disabled", true);
                            }
                        }
                    }
                });
            }
            $("#imp_of_proposed_work").val(getSavedData["imp_of_proposed_work"]);
            if (getSavedData['is_published_any_papers']) {
                is_published_any_papers = getSavedData['is_published_any_papers'];
            }
            showMoreOptions('papers_published', is_published_any_papers);
            if (getSavedData['file_published_papers']) {
                file_published_papers = getSavedData['file_published_papers'];
                displayUploadedFile('docs', 'file_published_papers', file_published_papers);
            }

            $("input:radio[name=is_published_any_papers]").val([is_published_any_papers]);
            $("#proposed_work_1_1").val(getSavedData["proposed_work_1_1"]);
            $("#proposed_work_1_2").val(getSavedData["proposed_work_1_2"]);
            $("#proposed_work_1_3").val(getSavedData["proposed_work_1_3"]);
            $("#proposed_work_1_4").val(getSavedData["proposed_work_1_4"]);
            $("#proposed_work_2_1").val(getSavedData["proposed_work_2_1"]);
            $("#proposed_work_2_2").val(getSavedData["proposed_work_2_2"]);
            $("#proposed_work_2_3").val(getSavedData["proposed_work_2_3"]);
            $("#proposed_work_2_4").val(getSavedData["proposed_work_2_4"]);
            $("#proposed_work_3_1").val(getSavedData["proposed_work_3_1"]);
            $("#proposed_work_3_2").val(getSavedData["proposed_work_3_2"]);
            $("#proposed_work_3_3").val(getSavedData["proposed_work_3_3"]);
            $("#proposed_work_3_4").val(getSavedData["proposed_work_3_4"]);
            $("#any_other_info").val(getSavedData["any_other_info"]);
            if (getSavedData["file_declaration_certificate"]) {
                file_declaration_certificate = getSavedData["file_declaration_certificate"];
                displayUploadedFile('docs', 'file_declaration_certificate', file_declaration_certificate);
            }
            if (getSavedData["file_aadhar_card"]) {
                file_aadhar_card = getSavedData["file_aadhar_card"];
                displayUploadedFile('docs', 'file_aadhar_card', file_aadhar_card);
            }
            if (getSavedData["file_res_guide_certificate"]) {
                file_res_guide_certificate = getSavedData["file_res_guide_certificate"];
                displayUploadedFile('docs', 'file_res_guide_certificate', file_res_guide_certificate);
            }
            if (getSavedData["file_institute_head_certificate"]) {
                file_institute_head_certificate = getSavedData["file_institute_head_certificate"];
                displayUploadedFile('docs', 'file_institute_head_certificate', file_institute_head_certificate);
            }
        } else {
            $("#form_0").addClass('d-block');
            callApi({
                method: 'GET',
                url: 'api/schemeDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
                form_type: 'preview-data',
                is_loader: 'within_the_page',
            });
            AmagiLoader.show();
        }
        isRegisteredWithGoaUNI(is_registered_with_goa_uni);
        // if no data saved then
        getPresetUserData();

        // add multiple rows 
            $(add_button).click(function(e){ 			//on add input button click
                e.preventDefault();
                x = guide_names.length;
                if(x < max_fields){ 					//max input box allowed
                    x++; 								//text box increment
                    $(wrapper).append(`
                        <div class="row">
                            <div class="col-md-11">
                                <div class="row wrapper_row">
                                    <div class="form-group col-md-4 mb-4">
                                        <label class="form-label star" style="font-weight:600" for="guide_name_`+x+`">Name of the Co-Guide</label>  
                                        <input type="text" id="guide_name_`+x+`" name="guide_name[]" value="" oninput="validateInput(this)" placeholder="Enter name" class="form-control input-md">
                                        <span class="error-msg col-md-12" id="guide_name_`+x+`_error_msg"></span>
                                    </div>
                                    <div class="form-group col-md-3 mb-4">
                                        <label class="form-label star" style="font-weight:600" for="guide_designation_`+x+`">Designation</label>  
                                        <input type="text" id="guide_designation_`+x+`" name="guide_designation[]" value="" oninput="validateInput(this)" placeholder="Enter designation" class="form-control input-md">
                                        <span class="error-msg col-md-12" id="guide_designation_`+x+`_error_msg"></span>
                                    </div>
                                    <div class="form-group col-md-5 mb-4">
                                        <label class="form-label star" style="font-weight:600" for="guide_address_`+x+`">Institutional Address</label>  
                                        <input type="text" id="guide_address_`+x+`" name="guide_address[]" value="" oninput="validateInput(this)" placeholder="Enter address" class="form-control input-md">
                                        <span class="error-msg col-md-12" id="guide_address_`+x+`_error_msg"></span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                        </div>
                    `); //add input box
                    if (x == max_fields) {
                        $(".add_field_button").attr("disabled", true);
                    }
                }
            }); 
            // click on remove fields
            $(wrapper).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).parent('div').remove();
                x--;
                if (x < max_fields) {
                    $(".add_field_button").attr("disabled", false);
                }
                updateSerialNumbers(wrapper);
            });

            $(add_button_impReferences).click(function(e){ 			//on add input button click
                e.preventDefault();
                x_impReferences = imp_references.length;
                if(x_impReferences < max_fields_impReferences){ 					//max input box allowed
                    x_impReferences++;
                    $(wrapper_impReferences).append(`
                        <tr class="wrapper_row">
                            <td class="serial-number text-center">`+x_impReferences+`</td>
                            <td>
                                <textarea class="form-control" name="imp_references[]" id="imp_references_`+x_impReferences+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter References"></textarea>
                                <span id="imp_references_`+x_impReferences+`_error_msg" class="error-msg col-md-12"></span>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_impReferences == max_fields_impReferences) {
                        $(".add_field_button_imp_references").attr("disabled", true);
                    }
                }
            });
            $(wrapper_impReferences).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_impReferences--;
                if (x_impReferences < max_fields_impReferences) {
                    $(".add_field_button_imp_references").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_impReferences);
            }); // click on remove fields

        // add here ----------------------------------------------

    });
    
    $('input:radio[name=gender]').on("change", function() {
        gender = this.value;
    });
    $("#category").on("change", function() {
        category = this.value;
        showMoreOptions('category', category);
    });
    $('input:radio[name=is_domicile_certificate]').on("change", function() {
        is_domicile_certificate = this.value;
        showMoreOptions('domicile', is_domicile_certificate);
    });
    $('input:radio[name=is_registered_with_goa_uni]').on("change", function() {
        is_registered_with_goa_uni = this.value;
        isRegisteredWithGoaUNI(is_registered_with_goa_uni);
    });
    $('input:radio[name=is_published_any_papers]').on("change", function() {
        is_published_any_papers = this.value;
        showMoreOptions('papers_published', is_published_any_papers);
    });
    function isRegisteredWithGoaUNI(value) {
        if (value==1) {
            $("#is_registered_with_goa_uni_error_msg").addClass("d-none");
        } else {
            $("#is_registered_with_goa_uni_error_msg").removeClass("d-none");
        }
    }

    // upload images --------------------------------
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
                    'storage_key' : 'doctoralFellowshipData',
                });
                isSavedForm_0 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputProfilePicture.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type':'img', 
                    'response_id' : 'file_profile_picture', 
                    'file_id' : fileInputProfilePicture, 
                    'file_data' : fileData, 
                    'storage_key' : 'doctoralFellowshipData',
                });
                isSavedForm_0 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputDomicileCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type':'docs', 
                    'response_id' : 'file_domicile_certificate', 
                    'file_id' : fileInputDomicileCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'doctoralFellowshipData',
                });
                isSavedForm_0 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputConfirmationLetter.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type':'docs', 
                    'response_id' : 'file_confirmation_letter', 
                    'file_id' : fileInputConfirmationLetter, 
                    'file_data' : fileData, 
                    'storage_key' : 'doctoralFellowshipData',
                });
                isSavedForm_2 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputPublishedPaper.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type':'docs', 
                    'response_id' : 'file_published_papers', 
                    'file_id' : fileInputPublishedPaper, 
                    'file_data' : fileData, 
                    'storage_key' : 'doctoralFellowshipData',
                    'max_file_upload_size' : '2',
                });
                isSavedForm_5 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputDeclarationCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type':'docs', 
                    'response_id' : 'file_declaration_certificate', 
                    'file_id' : fileInputDeclarationCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'doctoralFellowshipData',
                });
                isSavedForm_6 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputPIAadharCard.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_aadhar_card', 
                    'file_id' : fileInputPIAadharCard, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_9 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputResGuideCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type':'docs', 
                    'response_id' : 'file_res_guide_certificate', 
                    'file_id' : fileInputResGuideCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'doctoralFellowshipData',
                });
                isSavedForm_6 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputInstituteHeadCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type':'docs', 
                    'response_id' : 'file_institute_head_certificate', 
                    'file_id' : fileInputInstituteHeadCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'doctoralFellowshipData',
                });
                isSavedForm_6 = false;
            } else {
                if (savedData['file_institute_head_certificate']=='') {
                    popUpMsg('Please select a File!');
                }
            }
        });

    function saveForm(formNo) {
        if (formNo==0) {
            $(".save_btn").attr('disabled', true);

            saveData["flag"] = true;
            saveData["user_id"] = userId;
            saveData["scheme_batch_id"] = schemeBatchId;
            
            saveData["first_name"] = validateEmptyFields("first_name", "");
            saveData["middle_name"] = validateEmptyFields("middle_name", "");
            saveData["last_name"] = validateEmptyFields("last_name", "");
            saveData["dob"] = validateEmptyFields("dob", "");
            saveData["res_address"] = validateEmptyFields("res_address", "");
            saveData["country_code"] = validateEmptyFields("country_code", "");
            saveData["phone_no"] = validateEmptyFields("phone_no", "");
            saveData["email"] = validateEmptyFields("email", "");
            saveData["gender"] = gender;
            saveData["institutional_address"] = validateEmptyFields("institutional_address", "");
            saveData["category"] = category;
            saveData["is_domicile_certificate"] = is_domicile_certificate; 
            file_category_certificate = saveData["file_category_certificate"];
            file_domicile_certificate = saveData["file_domicile_certificate"];
            file_profile_picture = saveData["file_profile_picture"];
            isSavedForm_0 = true;
            
        } else if (formNo==1) {
            saveData["course_1"] = "SSLC";
            saveData["board_name_1"] = validateEmptyFields("board_name_1", "");
            saveData["college_name_1"] = validateEmptyFields("college_name_1", "");
            saveData["year_of_passing_1"] = validateEmptyFields("year_of_passing_1", "");
            saveData["marks_1"] = validateEmptyFields("marks_1", "");
            saveData["cgpa_1"] = validateEmptyFields("cgpa_1", "");
            saveData["course_2"] = "HSC";
            saveData["board_name_2"] = validateEmptyFields("board_name_2", "");
            saveData["college_name_2"] = validateEmptyFields("college_name_2", "");
            saveData["year_of_passing_2"] = validateEmptyFields("year_of_passing_2", "");
            saveData["marks_2"] = validateEmptyFields("marks_2", "");
            saveData["cgpa_2"] = validateEmptyFields("cgpa_2", "");
            saveData["course_3"] = "UG";
            saveData["board_name_3"] = validateEmptyFields("board_name_3", "");
            saveData["college_name_3"] = validateEmptyFields("college_name_3", "");
            saveData["year_of_passing_3"] = validateEmptyFields("year_of_passing_3", "");
            saveData["marks_3"] = validateEmptyFields("marks_3", "");
            saveData["cgpa_3"] = validateEmptyFields("cgpa_3", "");
            saveData["course_4"] = "PG";
            saveData["board_name_4"] = validateEmptyFields("board_name_4", "");
            saveData["college_name_4"] = validateEmptyFields("college_name_4", "");
            saveData["year_of_passing_4"] = validateEmptyFields("year_of_passing_4", "");
            saveData["marks_4"] = validateEmptyFields("marks_4", "");
            saveData["cgpa_4"] = validateEmptyFields("cgpa_4", "");
            saveData["course_5"] = "ANY OTHER";
            saveData["board_name_5"] = validateEmptyFields("board_name_5", "");
            saveData["college_name_5"] = validateEmptyFields("college_name_5", "");
            saveData["year_of_passing_5"] = validateEmptyFields("year_of_passing_5", "");
            saveData["marks_5"] = validateEmptyFields("marks_5", ""); 
            saveData["cgpa_5"] = validateEmptyFields("cgpa_5", "");
            isSavedForm_1 = true;

        } else if (formNo==2) {
            saveData["phd_work_carried_out"] = validateEmptyFields("phd_work_carried_out", "");
            saveData["is_registered_with_goa_uni"] = is_registered_with_goa_uni;
            saveData["registration_date"] = validateEmptyFields("registration_date", "");
            saveData["confirmation_date"] = validateEmptyFields("confirmation_date", "");
            file_confirmation_letter = saveData["file_confirmation_letter"];
            saveData["phd_subject_area"] = validateEmptyFields("phd_subject_area", "");
            isSavedForm_2 = true;

        } else if (formNo==3) {
			saveData["guide_details"] = [];
			if (guide_names.length>0) {
				for(let j=0;j<guide_names.length;j++)
				{
					if ( guide_names[j].value == "" && guide_designations[j].value == "" && guide_addresses[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["guide_details"].push({
							'guide_name': guide_names[j].value,
							'guide_designation': guide_designations[j].value,
							'guide_address': guide_addresses[j].value,
						});
					}
				}
			}
            isSavedForm_3 = true;

        } else if (formNo==4) {
            saveData["proposed_work"] = validateEmptyFields("proposed_work", "");
            saveData["work_background"] = validateEmptyFields("work_background", "");
            saveData["hypothesis_proposed"] = validateEmptyFields("hypothesis_proposed", "");
            saveData["objectives"] = validateEmptyFields("objectives", "");
            saveData["mat_and_methods_proposed"] = validateEmptyFields("mat_and_methods_proposed", "");
            saveData["expected_outcome"] = validateEmptyFields("expected_outcome", "");
            // saveData["imp_references"] = validateEmptyFields("imp_references", "");
            saveData["imp_references_details"] = [];
			if (imp_references.length>0) {
				for(let j=0;j<imp_references.length;j++)
				{
					if ( imp_references[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["imp_references_details"].push({
							'name': imp_references[j].value,
						});
					}
				}
			}
            saveData["imp_of_proposed_work"] = validateEmptyFields("imp_of_proposed_work", "");
            isSavedForm_4 = true;

        } else if (formNo==5) {
            saveData["is_published_any_papers"] = is_published_any_papers;
            file_published_papers = saveData["file_published_papers"];
            saveData["proposed_work_1_1"] = validateEmptyFields("proposed_work_1_1", "");
            saveData["proposed_work_1_2"] = validateEmptyFields("proposed_work_1_2", "");
            saveData["proposed_work_1_3"] = validateEmptyFields("proposed_work_1_3", "");
            saveData["proposed_work_1_4"] = validateEmptyFields("proposed_work_1_4", "");
            saveData["proposed_work_2_1"] = validateEmptyFields("proposed_work_2_1", "");
            saveData["proposed_work_2_2"] = validateEmptyFields("proposed_work_2_2", "");
            saveData["proposed_work_2_3"] = validateEmptyFields("proposed_work_2_3", "");
            saveData["proposed_work_2_4"] = validateEmptyFields("proposed_work_2_4", "");
            saveData["proposed_work_3_1"] = validateEmptyFields("proposed_work_3_1", "");
            saveData["proposed_work_3_2"] = validateEmptyFields("proposed_work_3_2", "");
            saveData["proposed_work_3_3"] = validateEmptyFields("proposed_work_3_3", "");
            saveData["proposed_work_3_4"] = validateEmptyFields("proposed_work_3_4", "");
            isSavedForm_5 = true;

        } else if (formNo==6) {
            saveData["any_other_info"] = validateEmptyFields("any_other_info", "");
            file_declaration_certificate = saveData["file_declaration_certificate"];
            file_aadhar_card = saveData["file_aadhar_card"];
            file_res_guide_certificate = saveData["file_res_guide_certificate"];
            file_institute_head_certificate = saveData["file_institute_head_certificate"];
            isSavedForm_6 = true;
        }
        saveData["form_type"] = 'save-form';
        saveData["form_no"] = formNo;
        saveData["scheme_id"] = $("#scheme_id").val();
        popUpMsg("Saving your data.","","success");
        localStorage.setItem("doctoralFellowshipData", JSON.stringify(saveData));

        // save every response for saving user data
        callApi({
            method: 'POST',
            url: 'api/schemeDoctoralFellowshipApi.php',
            data: saveData,
            form_type: 'save-form',
            is_loader: 'within_the_page',
        });
    }
    function validateFormData(formNo) {
        if (formNo==0) {
            if (saveData['file_profile_picture']) {
                file_profile_picture = saveData['file_profile_picture'];
            }
            if (saveData['file_domicile_certificate']) {
                file_domicile_certificate = saveData['file_domicile_certificate'];
            }
            if (saveData['file_category_certificate']) {   
                file_category_certificate = saveData['file_category_certificate'];
            }
            institutional_address = validateEmptyFields("institutional_address", "Please enter your institutional address!");
            email = validateEmailId("email", "Please enter your EMAIL ID!");
            phone_no = validatePhoneNumber("phone_no", "Phone Number cannot be empty!");
            country_code = validateEmptyFields("country_code", "Country code cannot be empty!");
            res_address = validateEmptyFields("res_address", "Please enter your residential address!");
            dob = validateEmptyFields("dob", "Please enter your Date of Birth!");
            last_name = validateEmptyFields("last_name", "Last name cannot be empty, Please enter Last name!");
            middle_name = validateEmptyFields("middle_name", "");
            first_name = validateEmptyFields("first_name", "First name cannot be empty, Please enter First name!");
            
            if (first_name && last_name && dob && res_address && country_code && phone_no && email && institutional_address && file_profile_picture && category!=0 ) {
                if (is_domicile_certificate==1) {
                    if (!file_domicile_certificate){ popUpMsg('Please upload the residence certificate.'); return false; }
                }
                if (category==0 || category==2) { } else {
                    if (!file_category_certificate){ popUpMsg('Please upload the certificate.'); return false; }
                }
                if (!file_profile_picture){ popUpMsg('Please upload your profile picture.'); return false; }
            } else {
                if (!category){ popUpMsg('Please select the category, first.'); return false; }
                if (category==0 || category==2) { } else {
                    if (!file_category_certificate){ popUpMsg('Please upload the certificate.'); return false; }
                }
                if (!file_profile_picture){ popUpMsg('Please upload your profile picture.'); return false; }
                return false;
            }
            
        } else if (formNo==1) {
            cgpa_5 = validateEmptyFields("cgpa_5", "");
            marks_5 = validateEmptyFields("marks_5", ""); 
            year_of_passing_5 = validateEmptyFields("year_of_passing_5", "");
            college_name_5 = validateEmptyFields("college_name_5", "");
            board_name_5 = validateEmptyFields("board_name_5", "");
            course_5 = "ANY OTHER";
            cgpa_4 = validateEmptyFields("cgpa_4", "");
            marks_4 = validateEmptyFields("marks_4", "Please enter here your GRADES.");            
            year_of_passing_4 = validateEmptyFields("year_of_passing_4", "Please select passing year.");
            college_name_4 = validateEmptyFields("college_name_4", "Please enter your college name.");
            board_name_4 = validateEmptyFields("board_name_4", "Please enter the University you studied.");
            course_4 = "PG";
            cgpa_3 = validateEmptyFields("cgpa_3", "");
            marks_3 = validateEmptyFields("marks_3", "Please enter here your GRADES.");
            year_of_passing_3 = validateEmptyFields("year_of_passing_3", "Please select passing year.");
            college_name_3 = validateEmptyFields("college_name_3", "Please enter your college name.");
            board_name_3 = validateEmptyFields("board_name_3", "Please enter the University you studied.");
            course_3 = "UG";
            cgpa_2 = validateEmptyFields("cgpa_2", "");
            marks_2 = validateEmptyFields("marks_2", "Please enter here your GRADES.");
            year_of_passing_2 = validateEmptyFields("year_of_passing_2", "Please select passing year.");
            college_name_2 = validateEmptyFields("college_name_2", "Please enter your college name.");
            board_name_2 = validateEmptyFields("board_name_2", "Please enter the Board you studied.");
            course_2 = "HSSC";
            cgpa_1 = validateEmptyFields("cgpa_1", "");
            marks_1 = validateEmptyFields("marks_1", "Please enter here your GRADES.");
            year_of_passing_1 = validateEmptyFields("year_of_passing_1", "Please select passing year.");
            college_name_1 = validateEmptyFields("college_name_1", "Please enter your school name.");
            board_name_1 = validateEmptyFields("board_name_1", "Please enter the Board you studied.");
            course_1 = "SSC";
            if (course_1 && board_name_1 && college_name_1 && year_of_passing_1 && marks_1 && 
                course_2 && board_name_2 && college_name_2 && year_of_passing_2 && marks_2 && 
                course_3 && board_name_3 && college_name_3 && year_of_passing_3 && marks_3 && 
                course_4 && board_name_4 && college_name_4 && year_of_passing_4 && marks_4 ) {
                if (cgpa_1) { cgpa_1 = validateEmptyFields("cgpa_1", "Please enter valid CGPA!"); if (!cgpa_1) { return false; } }
                if (cgpa_2) { cgpa_2 = validateEmptyFields("cgpa_2", "Please enter valid CGPA!"); if (!cgpa_2) { return false; } }
                if (cgpa_3) { cgpa_3 = validateEmptyFields("cgpa_3", "Please enter valid CGPA!"); if (!cgpa_3) { return false; } }
                if (cgpa_4) { cgpa_4 = validateEmptyFields("cgpa_4", "Please enter valid CGPA!"); if (!cgpa_4) { return false; } }
                if (cgpa_5) { cgpa_5 = validateEmptyFields("cgpa_5", "Please enter valid CGPA!"); if (!cgpa_5) { return false; } }

                if (marks_5) { marks_5 = validateEmptyFields("marks_5", "Please enter here your GRADES."); if (!marks_5) { return false; } }
                if (year_of_passing_5) { year_of_passing_5 = validateEmptyFields("year_of_passing_5", "Please select passing year."); if (!year_of_passing_5) { return false; } }
                if (college_name_5) { college_name_5 = validateEmptyFields("college_name_5", "Please enter your college name."); if (!college_name_5) { return false; } }
                if (board_name_5) { board_name_5 = validateEmptyFields("board_name_5", "Please enter the Board you studied."); if (!board_name_5) { return false; } }
            } else { return false; }
        } else if (formNo==2) {
            if (saveData["file_confirmation_letter"]) {
                file_confirmation_letter = saveData["file_confirmation_letter"];
            }
            phd_subject_area = validateEmptyFields("phd_subject_area", "This field is required!!");
            confirmation_date = validateEmptyFields("confirmation_date", "This field is required!!");
            registration_date = validateEmptyFields("registration_date", "This field is required!!");
            phd_work_carried_out = validateEmptyFields("phd_work_carried_out", "This field is required!!");
            if (is_registered_with_goa_uni==1 && phd_work_carried_out && registration_date && confirmation_date && phd_subject_area && file_confirmation_letter ) {
            } else {
                if (!file_confirmation_letter){ popUpMsg('Please upload the scanned copy of confirmation letter.'); return false; }
                if (is_registered_with_goa_uni==0) { popUpMsg("You are not eligible for the scheme."); }
                return false;
            }

        } else if (formNo==3) {
            if (guide_names.length>0) {
                for(let j=0;j<guide_names.length;j++)
                {
                    let tempIdKey = j+1;
                    if ( validateEmptyFields("guide_name_"+tempIdKey, "Please enter Guide Name!") ) { } else { return false; }
                    if ( validateEmptyFields("guide_designation_"+tempIdKey, "Please enter guide designation!") ) { } else { return false; }
                    if ( validateEmptyFields("guide_address_"+tempIdKey, "Please enter the guide address!") ) { } else { return false; }
                }
            }

        } else if (formNo==4) {
            imp_of_proposed_work = validateEmptyFields("imp_of_proposed_work", "Please enter the required details! ");
            if (imp_references.length>0) {
                for(let j=0;j<imp_references.length;j++)
                {
                    let tempIdKey = j+1;
                    if ( validateEmptyFields("imp_references_"+tempIdKey, "Please enter the required details!") ) { } else { return false; }
                }
            } else { return false; }
            // imp_references = validateEmptyFields("imp_references", "Please enter the required details! ");
            expected_outcome = validateEmptyFields("expected_outcome", "Please enter the required details! ");
            mat_and_methods_proposed = validateEmptyFields("mat_and_methods_proposed", "Please enter the required details! ");
            objectives = validateEmptyFields("objectives", "Please enter the required details! ");
            hypothesis_proposed = validateEmptyFields("hypothesis_proposed", "Please enter the required details! ");
            work_background = validateEmptyFields("work_background", "Please enter the required details! ");
            proposed_work = validateEmptyFields("proposed_work", "Please enter the required details! ");
            if ( proposed_work && work_background && hypothesis_proposed && objectives && mat_and_methods_proposed && expected_outcome && imp_of_proposed_work ) {
            } else { return false; }

        } else if (formNo==5) {
            proposed_work_3_4 = validateEmptyFields("proposed_work_3_4", "");
            proposed_work_3_3 = validateEmptyFields("proposed_work_3_3", "");
            proposed_work_3_2 = validateEmptyFields("proposed_work_3_2", "");
            proposed_work_3_1 = validateEmptyFields("proposed_work_3_1", "");
            proposed_work_2_4 = validateEmptyFields("proposed_work_2_4", "");
            proposed_work_2_3 = validateEmptyFields("proposed_work_2_3", "");
            proposed_work_2_2 = validateEmptyFields("proposed_work_2_2", "");
            proposed_work_2_1 = validateEmptyFields("proposed_work_2_1", "");
            proposed_work_1_4 = validateEmptyFields("proposed_work_1_4", "");
            proposed_work_1_3 = validateEmptyFields("proposed_work_1_3", "");
            proposed_work_1_2 = validateEmptyFields("proposed_work_1_2", "");
            proposed_work_1_1 = validateEmptyFields("proposed_work_1_1", "");
            if (saveData['file_published_papers']) {
                file_published_papers = saveData['file_published_papers'];
            }
            if (is_published_any_papers==1) {
                if (!file_published_papers){ popUpMsg('Please upload scanned copy of Published Paper.'); return false; }
            }
            if (proposed_work_1_1) { proposed_work_1_1 = validateEmptyFields("proposed_work_1_1", "required"); if (!proposed_work_1_1) { return false; } }
            if (proposed_work_1_2) { proposed_work_1_2 = validateEmptyFields("proposed_work_1_2", "required"); if (!proposed_work_1_2) { return false; } }
            if (proposed_work_1_3) { proposed_work_1_3 = validateEmptyFields("proposed_work_1_3", "required"); if (!proposed_work_1_3) { return false; } }
            if (proposed_work_1_4) { proposed_work_1_4 = validateEmptyFields("proposed_work_1_4", "required"); if (!proposed_work_1_4) { return false; } }
            if (proposed_work_2_1) { proposed_work_2_1 = validateEmptyFields("proposed_work_2_1", "required"); if (!proposed_work_2_1) { return false; } }
            if (proposed_work_2_2) { proposed_work_2_2 = validateEmptyFields("proposed_work_2_2", "required"); if (!proposed_work_2_2) { return false; } }
            if (proposed_work_2_3) { proposed_work_2_3 = validateEmptyFields("proposed_work_2_3", "required"); if (!proposed_work_2_3) { return false; } }
            if (proposed_work_2_4) { proposed_work_2_4 = validateEmptyFields("proposed_work_2_4", "required"); if (!proposed_work_2_4) { return false; } }
            if (proposed_work_3_1) { proposed_work_3_1 = validateEmptyFields("proposed_work_3_1", "required"); if (!proposed_work_3_1) { return false; } }
            if (proposed_work_3_2) { proposed_work_3_2 = validateEmptyFields("proposed_work_3_2", "required"); if (!proposed_work_3_2) { return false; } }
            if (proposed_work_3_3) { proposed_work_3_3 = validateEmptyFields("proposed_work_3_3", "required"); if (!proposed_work_3_3) { return false; } }
            if (proposed_work_3_4) { proposed_work_3_4 = validateEmptyFields("proposed_work_3_4", "required"); if (!proposed_work_3_4) { return false; } }
        } else if (formNo==6) {
            if (saveData['file_declaration_certificate']) {
                file_declaration_certificate = saveData["file_declaration_certificate"];
            }
            if (saveData['file_aadhar_card']) {
                file_aadhar_card = saveData["file_aadhar_card"];
            }
            if (saveData['file_res_guide_certificate']) {
                file_res_guide_certificate = saveData["file_res_guide_certificate"];
            }
            if (saveData['file_institute_head_certificate']) {
                file_institute_head_certificate = saveData["file_institute_head_certificate"];
            }
            any_other_info = validateEmptyFields("any_other_info", "");
            if ( file_declaration_certificate && file_aadhar_card && file_res_guide_certificate && file_institute_head_certificate ) {
            } else {
                if (!file_institute_head_certificate || file_institute_head_certificate==""){ popUpMsg('Please upload the scanned copy of Certificate from Head of the Institute.'); }
                if (!file_res_guide_certificate || file_res_guide_certificate==""){ popUpMsg('Please upload the scanned copy Certificate from research guide.'); }
                if (!file_aadhar_card || file_aadhar_card==""){ popUpMsg('Please upload the scanned Aadhar Card copy.'); }
                if (!file_declaration_certificate || file_declaration_certificate==""){ popUpMsg('Please upload the scanned copy of Self Declaration.'); }
                return false;
            }
        }
        return true;
    }
    function validateSavedData(formNo) {
        if (formNo==0) {
            if ( first_name==getSavedData["first_name"] && middle_name==getSavedData["middle_name"] && 
                last_name==getSavedData["last_name"] && dob==getSavedData["dob"] && res_address==getSavedData["res_address"] && 
                country_code==getSavedData["country_code"] && phone_no==getSavedData["phone_no"] && email==getSavedData["email"] && 
                gender==getSavedData["gender"] && institutional_address==getSavedData["institutional_address"] && 
                is_domicile_certificate==getSavedData["is_domicile_certificate"] && category==getSavedData["category"] && 
                file_profile_picture==getSavedData["file_profile_picture"] &&
                isSavedForm_0 ) { } else { return false; } 

        } else if (formNo==1) {
            if (board_name_1==getSavedData["board_name_1"] && college_name_1==getSavedData["college_name_1"] && year_of_passing_1==getSavedData["year_of_passing_1"] && marks_1==getSavedData["marks_1"] && cgpa_1==getSavedData["cgpa_1"] && 
                board_name_2==getSavedData["board_name_2"] && college_name_2==getSavedData["college_name_2"] && year_of_passing_2==getSavedData["year_of_passing_2"] && marks_2==getSavedData["marks_2"] && cgpa_2==getSavedData["cgpa_2"] && 
                board_name_3==getSavedData["board_name_3"] && college_name_3==getSavedData["college_name_3"] && year_of_passing_3==getSavedData["year_of_passing_3"] && marks_3==getSavedData["marks_3"] && cgpa_3==getSavedData["cgpa_3"] && 
                board_name_4==getSavedData["board_name_4"] && college_name_4==getSavedData["college_name_4"] && year_of_passing_4==getSavedData["year_of_passing_4"] && marks_4==getSavedData["marks_4"] && cgpa_4==getSavedData["cgpa_4"] &&
                board_name_5==getSavedData["board_name_5"] && college_name_5==getSavedData["college_name_5"] && year_of_passing_5==getSavedData["year_of_passing_5"] && marks_5==getSavedData["marks_5"] && cgpa_5==getSavedData["cgpa_5"] &&
                isSavedForm_1 ) { } else { return false; } 

        } else if (formNo==2) {
            if (phd_work_carried_out==getSavedData["phd_work_carried_out"] && is_registered_with_goa_uni==getSavedData["is_registered_with_goa_uni"] && registration_date==getSavedData["registration_date"] && 
                confirmation_date==getSavedData["confirmation_date"] && phd_subject_area==getSavedData["phd_subject_area"] && file_confirmation_letter==getSavedData["file_confirmation_letter"] &&
                isSavedForm_2 ) { } else { return false; } 

        } else if (formNo==3) {
            if (getSavedData["guide_details"] && getSavedData["guide_details"].length>0 && isSavedForm_3 ) {
                if (guide_names.length == getSavedData["guide_details"].length) {
                    if (guide_names.length>0) {
                        for(let j=0;j<guide_names.length;j++)
                        {
                            if (!getSavedData["guide_details"][j]) { return false; }
                            if ( guide_names[j].value == getSavedData["guide_details"][j].guide_name ) {} else { return false; }
                            if ( guide_designations[j].value == getSavedData["guide_details"][j].guide_designation ) {} else  { return false; }
                            if ( guide_addresses[j].value == getSavedData["guide_details"][j].guide_address ) {} else  { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

        } else if (formNo==4) {
            if ( proposed_work==getSavedData["proposed_work"] && work_background==getSavedData["work_background"] && hypothesis_proposed==getSavedData["hypothesis_proposed"] && 
                objectives==getSavedData["objectives"] && mat_and_methods_proposed==getSavedData["mat_and_methods_proposed"] && expected_outcome==getSavedData["expected_outcome"] && 
                imp_of_proposed_work==getSavedData["imp_of_proposed_work"] &&
                isSavedForm_4 ) {
                    // imp_references==getSavedData["imp_references"] &&     
                    if (getSavedData["imp_references_details"] && getSavedData["imp_references_details"].length>0) {
                        if (imp_references.length == getSavedData["imp_references_details"].length) {
                            if (imp_references.length>0) {
                                for(let j=0;j<imp_references.length;j++)
                                {
                                    if (!getSavedData["imp_references_details"][j]) { return false; }
                                    if ( imp_references[j].value == getSavedData["imp_references_details"][j].name ) { } else { return false; }
                                }
                            }
                        } else { return false; }
                    } else { return false; }
                } else { return false; } 

        } else if (formNo==5) {
            if ( is_published_any_papers==getSavedData["is_published_any_papers"] && file_published_papers==getSavedData["file_published_papers"] &&
                proposed_work_1_1==getSavedData["proposed_work_1_1"] && proposed_work_1_2==getSavedData["proposed_work_1_2"] && proposed_work_1_3==getSavedData["proposed_work_1_3"] && proposed_work_1_4==getSavedData["proposed_work_1_4"] &&
                proposed_work_2_1==getSavedData["proposed_work_2_1"] && proposed_work_2_2==getSavedData["proposed_work_2_2"] && proposed_work_2_3==getSavedData["proposed_work_2_3"] && proposed_work_2_4==getSavedData["proposed_work_2_4"] && 
                proposed_work_3_1==getSavedData["proposed_work_3_1"] && proposed_work_3_2==getSavedData["proposed_work_3_2"] && proposed_work_3_3==getSavedData["proposed_work_3_3"] && proposed_work_3_4==getSavedData["proposed_work_3_4"] &&
                isSavedForm_5 ) { } else { return false; } 

        } else if (formNo==6) {
            if ( file_declaration_certificate==getSavedData["file_declaration_certificate"] && file_aadhar_card == getSavedData["file_aadhar_card"] && 
                file_res_guide_certificate==getSavedData["file_res_guide_certificate"] && 
                file_institute_head_certificate==getSavedData["file_institute_head_certificate"] &&
                isSavedForm_6 ) { } else { return false; } 
        }
        return true;
    }
    function validateInputType(type, inputFieldId, inputFieldValue) {
         // return error message
        let trimInputFieldId = inputFieldId.slice(0, -2);
        let checkTextLength=checkTextValidate = checkText = checkTextArea = true;
        let msg = '';
        let minCharLength = 2;
        let maxCharLength = 250;
        var allowCharsForID = ["proposed_work"];
        
        if (inputFieldValue == '' && inputFieldId=="board_name_5" || inputFieldId=="college_name_5" || inputFieldId=="marks_5") {
            checkTextValidate = false;
            checkTextLength = false;
        }
        if (allowCharsForID.includes(inputFieldId)) {
            checkText = false;
        }
        
        if (type=='text') {
            if (trimInputFieldId=="guide_name" || trimInputFieldId=="guide_designation" || trimInputFieldId=="guide_address" || 
                trimInputFieldId=="board_name" || trimInputFieldId=="college_name" 
                ) {
                if (checkTextValidate && inputFieldValue === '') {
                    switch (trimInputFieldId) {
                        case 'board_name': msg = 'Board name is required'; break;
                        case 'college_name': msg = 'College name is required'; break;
                        case 'guide_name': msg = 'Guide name is required'; break;
                        case 'guide_designation': msg = 'Designation is required'; break;
                        case 'guide_address': msg = 'Address is required'; break;
                        default: msg = ''; break;
                    }
                } else if (checkTextLength && inputFieldValue.length < minCharLength) {
                    msg = ' must be between '+minCharLength+' and '+maxCharLength+' characters';
                    switch (trimInputFieldId) {
                        case 'guide_address': msg = 'Address '+msg; break;
                        default: msg = 'Input field '+msg; break;
                    } 
                } else if (inputFieldValue.length > maxCharLength) {
                    msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
                } else if (/[<>]/.test(inputFieldValue)) {
                    msg = 'Invalid characters or content detected, not allowed <,>';
                } else if (!isValidEducationName(inputFieldValue) && trimInputFieldId!='guide_address' ) {
                    msg = 'Invalid Input !';
                } else {
                    msg = '';
                }
            } else {
                if (inputFieldValue === '') {   
                    switch (inputFieldId) {
                        case 'first_name': msg = 'First name is required'; break;
                        case 'last_name': msg = 'Last name is required'; break;
                        case 'phd_subject_area': msg = 'PhD Subject Area is required'; break;
                        case 'phd_work_carried_out': msg = 'Institute/Collage name is required'; break;
                        case 'proposed_work': msg = 'Proposed work is required'; break;
                        default: msg = ''; break;
                    }
                    
                } else if (checkText && !regexOnlyTextSupportChars.test(inputFieldValue)) {
                    msg = 'Invalid input !'; 
                // } else if (!/^[a-zA-Z\s.]+$/.test(inputFieldValue)) {
                //     msg = 'Special characters not allowed'; 
                
                } else if (allowCharsForID.includes(inputFieldId) && /[<>]/.test(inputFieldValue)) {
                    msg = 'Invalid characters or content detected, not allowed <,>';
                } else if (checkTextLength && inputFieldValue.length < minCharLength) {
                    msg = ' must be between '+minCharLength+' and '+maxCharLength+' characters';
                    switch (inputFieldId) {
                        case 'first_name': msg = 'First name '+msg; break;
                        case 'last_name': msg = 'Last name '+msg; break;
                        case 'phd_subject_area': msg = 'Subject Area '+msg; break;
                        case 'phd_work_carried_out': msg = 'Institute/Collage name '+msg; break;
                        default: msg = ''; break;
                    }
                } else if (inputFieldValue.length > maxCharLength) {
                    msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
                } else {
                    msg = '';
                }
            }

        } else if (type=='textarea') {
            maxCharLength = 4000;
            minCharLength = 10;
            // inputFieldId=="imp_references" || 
            if (inputFieldId=="work_background" || inputFieldId=="hypothesis_proposed" || inputFieldId=="objectives" || inputFieldId=="mat_and_methods_proposed" || inputFieldId=="expected_outcome" || inputFieldId=="imp_of_proposed_work"
            ) {
                checkTextLength = false;
            }
            if (inputFieldId=="any_other_info") {
                checkTextValidate = false;
                checkTextLength = false;
            }
            if (trimInputFieldId=="imp_references" || trimInputFieldId=="proposed_work_1" || trimInputFieldId=="proposed_work_2" || trimInputFieldId=="proposed_work_3") {
                if (inputFieldValue=="") {
                    switch (trimInputFieldId) {
                        case "proposed_work_1" : msg = 'Please provide quarterly proposed work details'; break;
                        case "imp_references" : msg = 'Please enter the required details!'; break;
                        default: msg = ''; break;
                    }
                } else if (/[<>]/.test(inputFieldValue)) {
                    msg = 'Invalid characters or content detected, not allowed <,>';
                } else if (inputFieldValue.length < minCharLength) {
                    msg = 'Please enter relevant information, min '+minCharLength+' characters';
                } else if (inputFieldValue.length > maxCharLength) {
                    msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
                } else {
                    msg = '';
                }
                return msg;
            }
                
            if (inputFieldValue === '') {
                // if (checkTextLength) {
                //     msg = 'Address is required';
                // } else {
                //     if (checkTextValidate) {
                //         msg = 'This is required';
                //     }
                // }
                switch (inputFieldId) {
                    case 'work_background': msg = 'Please enter work background'; break;
                    case 'hypothesis_proposed': msg = 'Please enter hypothesis proposed'; break;
                    case 'objectives': msg = 'Please enter objectives'; break;
                    case 'mat_and_methods_proposed': msg = 'Please enter proposed Materials and Methods'; break;
                    case 'expected_outcome': msg = 'Please enter expected outcome'; break;
                    case 'imp_references': msg = 'Please provide references used'; break;
                    case 'imp_of_proposed_work': msg = 'Please enter imp of proposed work'; break;
                    case 'proposed_work': msg = 'Please enter proposed_work'; break;
                    case 'institutional_address': msg = 'Please enter institution address'; break;
                    default: msg = 'Please provide quarterly proposed work details'; break;
                    // default for proposed_work_1....n
                }
            } else if (/[<>]/.test(inputFieldValue)) {
                msg = 'Invalid characters or content detected, not allowed <,>';
            } else if (inputFieldValue.length < minCharLength) {
                msg = 'Please enter relevant information, min '+minCharLength+' characters';
            } else if (inputFieldValue.length > maxCharLength) {
                msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
            } else {
                msg = '';
            }
        } else if (type=='date') {
            if (inputFieldValue === '') {   
                switch (inputFieldId) {
                    case 'confirmation_date': msg = 'Please provide confirmation date'; break;
                    case 'registration_date': msg = 'Please provide the registration date'; break;
                    default: msg = ''; break;
                }
            }
        } else if (type=='number') {
            const value = parseFloat(inputFieldValue);

            if (trimInputFieldId=="marks") {
                if (inputFieldValue === '') {
                    msg = 'Grade is required';  
                } else if (!isNaN(value) && value >= 0 && value <= 100) {
                    msg = '';
                } else {
                    msg = 'Please enter a valid percentage between 0 and 100.';
                }
            } else if (trimInputFieldId=="cgpa" ) {
                // Check if the value is a number and within the range 0.0 to 10.0
                if (inputFieldValue === '') {
                    msg = 'CGPA is required';  
                } else if (!isNaN(value) && value >= 0.0 && value <= 10.0) {
                    msg = '';
                } else {
                    msg = 'Please enter a valid CGPA score between 0.0 and 10.0'; 
                }
            }
            
            if (!/^[0-9\.]+$/.test(inputFieldValue)) {
                msg = 'Invalid Input!';
            }
            
        }
        return msg;
    }

    function submitForm() {
        if (validateFormData(0) && validateFormData(1) && validateFormData(2) && validateFormData(3) && validateFormData(4) && validateFormData(5) && validateFormData(6)) {
            // is data saved 
            if (validateSavedData(0) && validateSavedData(1) && validateSavedData(2) && validateSavedData(3) && validateSavedData(4) && validateSavedData(5) && validateSavedData(6)) {
                if (checkUploadedFiles()=='Success') {
                    if (document.querySelector("#form_submission_note").checked) {
                        // alert
                        submitFormAlert();
                    } else {
                        popUpMsg("Please agree to the Form submission to GSRF office!");
                    }
                } else {
                    console.log(checkUploadedFiles());
                }
            } else {
                popUpMsg("Please save the data first !!");
                console.log('info:10006');
            }
        } else {
            // popUpMsg("Required fields are empty");
        }
    }
    async function submitFormAlert() {
        const result = await popUpSchemeConfirmMsg({
            icon: 'warning',
            iconColor: '#e3da16',
            title: 'Form Submissions are Final', 
            confirmButtonText: 'Confirm',
            showCancelButton: true,
            type: 'alert',
        });

        if (result) {
            saveData["form_type"] = 'submit-form';
            saveData["scheme_id"] = $("#scheme_id").val();
            AmagiLoader.show();
            callApi({
                method: 'POST',
                url: 'api/schemeDoctoralFellowshipApi.php',
                data: saveData,
                form_type: 'apply-scheme',
                is_loader: 'within_the_page',
            });
        }
    }
    function getApiResponse(res, type) {
        if (res.flag && res.status=='200') {
            if (type=='save-form') {
                if (res.data['scheme_id']) {
                    $('#scheme_id').val(res.data['scheme_id']);
                }
                $(".save_btn").attr('disabled', false);
            } else if (type=='preview-data') {
                getSavedData = res.data;
                getSavedData['flag'] = true; 
                localStorage.setItem("doctoralFellowshipData", JSON.stringify(getSavedData));
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else if (type=='apply-scheme') {
                AmagiLoader.hide();
                popUpSchemeConfirmMsg({
                    localStorageKey : 'doctoralFellowshipData',
                    schemeUrl : '<?php echo $schemeUrl ?>',
                    scheme_code : scheme_code,
                    title : res.message, 
                    confirmButtonText : 'Confirm',
                    showCancelButton : false,
                });
                // generate pdf
                callApi({
                    method: 'GET',
                    url: 'api/schemeDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
                    form_type: 'generate-pdf',
                    is_loader: 'within_the_page',
                });
            } else if (type=='generate-pdf') {
                // do nothing
            }
        } else {
            // if not preview data then show error
            if (type=='preview-data') {
                AmagiLoader.hide();
            } else {
                popUpMsg(res.message, "", "error");
            }
        }
        // scroll effect
        if (type=='save-form') {} else {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
</script>
<script src="assets/js/forms-tab.js?<?php echo time() ?>"></script>
</body>
</html>