<?php 
require "layout/head.php"; 
if (!isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
$schemeUrl = "schemes-post-doctoral-fellowship.php";
?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/generalData.php";
$isSchemeAvailableFor = "PDF"; 
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
                                <li><a href="<?php echo $schemeUrl;?>">Post-Doctoral Fellowship</a></li>
                                <li>Apply Here</li>
                            </ol>
                            <h2>
                                Application for Post-Doctoral Fellowship
                                <br>
                                <p>
                                    Embark on an Extraordinary Research Voyage: Apply Now for the Post-Doctoral Fellowship Scheme 
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
                                <div class="tab-text">Mentor Details</div>
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
                                        <label for="first_name" class="form-label star">First Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="" oninput="validateInput(this)" placeholder="Enter your first name" aria-describedby="first name" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_first_name" onClick="displayInputField('first_name')"><i class="bi bi-pencil-fill"></i></button>
                                            <span class="error-msg col-md-12" id="first_name_error_msg"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <div class="input-group mb-3">        
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="" placeholder="Enter your middle name" aria-describedby="middle name" readonly>
                                            <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_middle_name" onClick="displayInputField('middle_name')"><i class="bi bi-pencil-fill"></i></button>
                                        </div>                                    
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="last_name" class="form-label star">Last Name</label>
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
                                        <small class="form-text text-muted">(Scanned PDF copy of max <strong>700KB </strong>)</small> <?php include "layout/tooltip-i.php"; ?> 
                                        <div class="form-check col-md-7" style="padding-left: 0;">
                                            <input type="file" id="file_category_certificate" name="file_category_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                            <?php showProgressBar('docs','file_category_certificate', ''); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="basic-url" class="form-label star">Are you a resident of Goa for 15 years or more?</label>
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
                                            <small class="form-text text-muted">(Scanned PDF copy of max <strong>700KB </strong>)</small> <?php include "layout/tooltip-i.php"; ?> 
                                            <div class="form-check col-md-7" style="padding-left: 0;">
                                                <input type="file" id="file_domicile_certificate" name="file_domicile_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_domicile_certificate', ''); ?>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4" id="file_profile_picture_field">
                                        <label for="file_profile_picture" class="form-label star">Upload User Picture</label>
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
                                            <a href="#" class="btn btn-outline remove_file text-center d-none" id="remove_file_profile_picture" onclick="removeUploadedFile('img', 'file_profile_picture', 'postdoctoralFellowshipData'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
                                        </div>
                                        <p>Please upload a 3.5cm x 4.5cm passport-size photo.</p>
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
                                                <th class="d-none">CGPA</th>
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
                                                    <td class="d-none">
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
                                                    <td class="d-none">
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
                                                    <td class="d-none">
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
                                                    <td class="d-none">
                                                        <input type="number" class="form-control" name="cgpa_4" id="cgpa_4" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_4_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="star">Ph.D</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="board_name_5" id="board_name_5" value="" oninput="validateInput(this)" placeholder="Enter Board/ University" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="board_name_5_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="college_name_5" id="college_name_5" value="" oninput="validateInput(this)" placeholder="Enter College/ Institution" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="college_name_5_error_msg"></span>
                                                    </td>
                                                    <td><select class="form-control input_field_shadow" name="year_of_passing_5" id="year_of_passing_5" onchange="getYearOfPassing(this.value, 5)"></select></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="marks_5" id="marks_5" value="" oninput="validateInput(this)" placeholder="%" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="marks_5_error_msg"></span>
                                                    </td>
                                                    <td class="d-none">
                                                        <input type="number" class="form-control" name="cgpa_5" id="cgpa_5" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_5_error_msg"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>ANY OTHER</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="board_name_6" id="board_name_6" value="" oninput="validateInput(this)" placeholder="Enter Board/ University" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="board_name_6_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="college_name_6" id="college_name_6" value="" oninput="validateInput(this)" placeholder="Enter School/ College" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="college_name_6_error_msg"></span>
                                                    </td>
                                                    <td><select class="form-control input_field_shadow" name="year_of_passing_6" id="year_of_passing_6" onchange="getYearOfPassing(this.value, 6)"></select></td>
                                                    <td>
                                                        <input type="number" class="form-control" name="marks_6" id="marks_6" value="" oninput="validateInput(this)" placeholder="%" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="marks_6_error_msg"></span>
                                                    </td>
                                                    <td class="d-none">
                                                        <input type="number" class="form-control" name="cgpa_6" id="cgpa_6" value="" oninput="validateInput(this)" placeholder="(0.0 to 10.0)" aria-describedby="">
                                                        <span class="error-msg col-md-12" id="cgpa_6_error_msg"></span>
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
                                        <label for="phd_thesis" class="form-label star">Title of the Ph.D. thesis</label>
                                        <input type="text" class="form-control" name="phd_thesis" id="phd_thesis" value="" oninput="validateInput(this)" placeholder="Enter thesis title" aria-describedby="">
                                        <span class="error-msg col-md-12" id="phd_thesis_error_msg"></span>
                                    </div>
                                    <div class="col-md-5 mb-4" id="file_phd_degree_field">
                                        <label for="file_phd_degree" class="form-label star">PhD degree/award communication</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" name="file_phd_degree" id="file_phd_degree" placeholder="" class="form-control input-md" accept="application/pdf">
                                            <?php showProgressBar('docs','file_phd_degree', ''); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label for="phd_research_guide_name" class="form-label star">Ph.D. Research Guide Name</label>
                                        <input type="text" class="form-control" name="phd_research_guide_name" id="phd_research_guide_name"  value="" oninput="validateInput(this)" placeholder="Enter guide name" aria-describedby="phd_research_guide_name">
                                        <span class="error-msg col-md-12" id="phd_research_guide_name_error_msg"></span>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="phd_research_guide_designation" class="form-label star">Ph.D. Research Guide Designation</label>
                                        <input type="text" class="form-control" name="phd_research_guide_designation" id="phd_research_guide_designation"  value="" oninput="validateInput(this)" placeholder="Enter guide designation" aria-describedby="phd_research_guide_designation">
                                        <span class="error-msg col-md-12" id="phd_research_guide_designation_error_msg"></span>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="phd_degree_obtained_university" class="form-label star">University from which Ph.D. degree is obtained</label>
                                        <input type="text" class="form-control" name="phd_degree_obtained_university" id="phd_degree_obtained_university" value="" oninput="validateInput(this)" placeholder="Enter University name " aria-describedby="">
                                        <span class="error-msg col-md-12" id="phd_degree_obtained_university_error_msg"></span>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="phd_work_carried_out" class="form-label star">Institution in which you worked for your Ph.D</label>
                                        <input type="text" class="form-control" name="phd_work_carried_out" id="phd_work_carried_out" value="" oninput="validateInput(this)" placeholder="Enter Institution name" aria-describedby="">
                                        <span class="error-msg col-md-12" id="phd_work_carried_out_error_msg"></span>
                                    </div>
                                    <div class="col-md-8 mb-4">
                                        <label for="phd_work_proposed_institution" class="form-label star">The University / Institution in which you propose to carry out your Post-Doctoral work </label>
                                        <br>
                                        <p>Please go through the guidelines for the eligibility of the host institute</p>
                                        <input type="text" class="form-control" name="phd_work_proposed_institution" id="phd_work_proposed_institution" value="" oninput="validateInput(this)" placeholder="Enter University Name" aria-describedby="">
                                        <span class="error-msg col-md-12" id="phd_work_proposed_institution_error_msg"></span>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,1,2,1,3); ?>
                            </div>
                            <div id="form_3" class="tabcontent">
                                <div class="row">
                                    <h3>Mentor Details</h3>
                                    <p class="mb-5">Please go through the scheme with regard to choosing your host institute</p>
                                    <div class="form-group col-md-4 mb-4">
                                        <label class="form-label star" for="guide_name_1">Name of the Mentor</label>  
                                        <input type="text" id="guide_name_1" name="guide_name[]" value="" oninput="validateInput(this)" placeholder="Enter name" class="form-control">
                                        <span class="error-msg col-md-12" id="guide_name_1_error_msg"></span>
                                    </div>
                                    <div class="form-group col-md-3 mb-4">
                                        <label class="form-label star" for="guide_designation_1">Designation</label>  
                                        <input type="text" id="guide_designation_1" name="guide_designation[]" value="" oninput="validateInput(this)" placeholder="Enter designation" class="form-control">
                                        <span class="error-msg col-md-12" id="guide_designation_1_error_msg"></span>
                                    </div>
                                    <div class="form-group col-md-5 mb-4">
                                        <label class="form-label star" for="guide_address_1">Institutional Address</label>
                                        <input type="text" id="guide_address_1" name="guide_address[]" value="" oninput="validateInput(this)" placeholder="Enter address" class="form-control">
                                        <span class="error-msg col-md-12" id="guide_address_1_error_msg"></span>
                                    </div>
                                    <!-- Show Added Days -->
                                    <!-- <div class="input_fields_wrap"></div>   
									<button type="button" class="btn link_btn add_field_button" style="text-align: inherit;">+ Add (if any)</button> -->
                                </div>
                                <?php showNavigationButton(0,2,3,1,4); ?>
                            </div>
                            <div id="form_4" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Work Details</h3>
                                    <div class="col-md-6 mb-4">
                                        <label for="proposed_work" class="form-label star">Title of the proposed work</label>
                                        <input type="text" class="form-control" name="proposed_work" id="proposed_work" oninput="validateInput(this)" value="" placeholder="Enter title of the proposed work" aria-describedby="">
                                        <span id="proposed_work_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="broad_discipline" class="form-label star">Broad discipline</label>
                                        <input type="text" class="form-control" name="broad_discipline" id="broad_discipline" oninput="validateInput(this)" value="" placeholder="Enter Broad discipline" aria-describedby="">
                                        <span id="broad_discipline_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="work_background" class="form-label star">Background of the work </label>
                                        <p>Not more than 200 words</p>
                                        <textarea class="form-control input" name="work_background" id="work_background" oninput="validateInput(this)" onkeyup="validateWordCount('work_background','200')" cols="80" rows="4"></textarea>
                                        Total word Count : <span id="work_background_display_count">0</span> / 200 words. <span id="work_background_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="hypothesis_proposed" class="form-label star">The hypothesis proposed / Gaps identified in existing knowledge</label>
                                        <p>Not more than 100 words</p>
                                        <textarea class="form-control" name="hypothesis_proposed" id="hypothesis_proposed" oninput="validateInput(this)" onkeyup="validateWordCount('hypothesis_proposed','100')" cols="80" rows="3"></textarea>
                                        Total word Count : <span id="hypothesis_proposed_display_count">0</span> / 100 words. <span id="hypothesis_proposed_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="objectives" class="form-label star">Objectives</label>
                                        <p>Not more than 100 words</p>
                                        <textarea class="form-control" name="objectives" id="objectives" oninput="validateInput(this)" onkeyup="validateWordCount('objectives','100')" cols="80" rows="3"></textarea>
                                        Total word Count : <span id="objectives_display_count">0</span> / 100 words. <span id="objectives_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="mat_and_methods_proposed" class="form-label star">Materials and Methods Proposed</label>
                                        <p>Not more than 200 words</p>
                                        <textarea class="form-control" name="mat_and_methods_proposed" id="mat_and_methods_proposed" oninput="validateInput(this)" onkeyup="validateWordCount('mat_and_methods_proposed','200')" cols="80" rows="4"></textarea>
                                        Total word Count : <span id="mat_and_methods_proposed_display_count">0</span> / 200 words. <span id="mat_and_methods_proposed_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="expected_outcome" class="form-label star">Expected outcome</label>
                                        <p>Not more than 200 words</p>
                                        <textarea class="form-control" name="expected_outcome" id="expected_outcome" oninput="validateInput(this)" onkeyup="validateWordCount('expected_outcome','200')" cols="80" rows="4"></textarea>
                                        Total word Count : <span id="expected_outcome_display_count">0</span> / 200 words. <span id="expected_outcome_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="imp_references" class="form-label star">References</label>
                                        <p>Give all the references cited in the proposal</p>
                                        <textarea class="form-control" name="imp_references" id="imp_references" oninput="validateInput(this)" rows="5"></textarea>
                                        <span id="imp_references_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="imp_of_proposed_work" class="form-label star">Importance of proposed work</label>
                                        <p>Not more than 100 words</p>
                                        <textarea class="form-control" name="imp_of_proposed_work" id="imp_of_proposed_work" oninput="validateInput(this)" onkeyup="validateWordCount('imp_of_proposed_work','100')" cols="80" rows="2"></textarea>
                                        Total word Count : <span id="imp_of_proposed_work_display_count">0</span> / 100 words. <span id="imp_of_proposed_work_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="expertise_of_mentor" class="form-label star">Expertise of the Mentor in the proposed area</label>
                                        <p>Not more than 100 words</p>
                                        <textarea class="form-control" name="expertise_of_mentor" id="expertise_of_mentor" oninput="validateInput(this)" onkeyup="validateWordCount('expertise_of_mentor','100')" cols="80" rows="2"></textarea>
                                        Total word Count : <span id="expertise_of_mentor_display_count">0</span> / 100 words. <span id="expertise_of_mentor_error_msg" class="error-msg"></span>
                                    </div>
                                    <div class="col-md-12 table-responsive mb-4">
                                        <label for="list_of_publications" class="form-label star">List of your publications</label>
                                        <p>All relevant ones</p>
                                        <!-- <textarea class="form-control" name="list_of_publications" id="list_of_publications" oninput="validateInput(this)" rows="5"></textarea>
                                        <span id="list_of_publications_error_msg" class="error-msg"></span> -->
                                        
                                        <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_list_of_publications">
                                            <thead class="table-light">
                                                <th>Sr. No.</th>
                                                <th>Publications</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr class="wrapper_row">
                                                    <td class="serial-number text-center">1</td>
                                                    <td>
                                                        <textarea class="form-control" name="list_of_publications[]" id="list_of_publications_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter publications"></textarea>
                                                        <span id="list_of_publications_1_error_msg" class="error-msg col-md-12"></span>
                                                    </td>
                                                    <td width="62px">
                                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Add more fields -->
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn link_btn add_field_button_list_of_publications" style="text-align: inherit;">+ Add Publication</button>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,3,4,1,5); ?>
                            </div>
                            <div id="form_5" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Proposed Work Details</h3>
                                    <div class="col-md-4 mb-4">
                                        <label for="is_published_any_papers" class="form-label star">Have you published any papers in the proposed area of research?</label>
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
                                    <div class="col-md-8 mb-4">
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
                                    <div class="col-md-6 mb-4" id="file_proposed_study_timeline_field">
                                        <label for="file_proposed_study_timeline" class="form-label star">Timeline (Quarterly) of the proposed study : </label>
                                        <p>Provide scanned copy of either Bar diagram/GANTT chart</p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_proposed_study_timeline" name="file_proposed_study_timeline" placeholder="" class="form-control input-md" accept="application/pdf">
                                            <?php showProgressBar('docs','file_proposed_study_timeline', ''); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,4,5,1,6); ?>
                            </div>
                            <div id="form_6" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Certificates</h3>
                                    <div class="col-md-6 mb-4">
                                        <label for="file_res_guide_certificate" class="form-label star">Certificate from the mentor that he approves the research proposal</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_res_guide_certificate" name="file_res_guide_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_res_guide_certificate_field">
                                        <?php showProgressBar('docs','file_res_guide_certificate', 'mt30'); ?>
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
                                        <label for="file_institute_head_certificate" class="form-label star">Endorsement from the Head of the institute</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_institute_head_certificate" name="file_institute_head_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_institute_head_certificate_field">
                                        <?php showProgressBar('docs','file_institute_head_certificate', 'mt30'); ?>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="file_candidate_cv" class="form-label star">CV of the candidate</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_candidate_cv" name="file_candidate_cv" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_candidate_cv_field">
                                        <?php showProgressBar('docs','file_candidate_cv', 'mt30'); ?>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label for="file_mentor_cv" class="form-label star">CV of the mentor</label>
                                        <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_mentor_cv" name="file_mentor_cv" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_mentor_cv_field">
                                        <?php showProgressBar('docs','file_mentor_cv', 'mt30'); ?>
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
    let schemeBatchId = "<?php echo $postDoctoralFellowshipRequiredDocs["scheme_batch_id"] ?>";
    let form_no_saved = 0;

    let first_name=middle_name=last_name=dob=res_address=country_code=phone_no=email=
        file_category_certificate=file_profile_picture=file_domicile_certificate
        ="";
    let course_1=board_name_1=college_name_1=year_of_passing_1=marks_1=cgpa_1=
        course_2=board_name_2=college_name_2=year_of_passing_2=marks_2=cgpa_2=
        course_3=board_name_3=college_name_3=year_of_passing_3=marks_3=cgpa_3=
        course_4=board_name_4=college_name_4=year_of_passing_4=marks_4=cgpa_4=
        course_5=board_name_5=college_name_5=year_of_passing_5=marks_5=cgpa_5=
        course_6=board_name_6=college_name_6=year_of_passing_6=marks_6=cgpa_6
        ="";
    let phd_thesis=phd_research_guide_name=phd_research_guide_designation=phd_work_proposed_institution=
        file_phd_degree=phd_degree_obtained_university=phd_work_carried_out
        =""; 
    let guide_names = document.getElementsByName("guide_name[]");
    let guide_designations = document.getElementsByName("guide_designation[]");
    let guide_addresses = document.getElementsByName("guide_address[]");
    let proposed_work = broad_discipline ="";
    var work_background=hypothesis_proposed=objectives=mat_and_methods_proposed=
        expected_outcome=imp_references=imp_of_proposed_work=expertise_of_mentor
        ="";
    let list_of_publicationsDetails = document.getElementsByName("list_of_publications[]");

    let gender="male";
    let category=is_domicile_certificate=is_published_any_papers=0;

    var file_published_papers=file_proposed_study_timeline="";
    let file_declaration_certificate=file_aadhar_card=file_res_guide_certificate=file_institute_head_certificate=file_candidate_cv=file_mentor_cv
        ="";
    
    const fileInputCategoryCertificate = document.getElementById('file_category_certificate');
    const fileInputProfilePicture = document.getElementById('file_profile_picture');
    const fileInputDomicileCertificate = document.getElementById('file_domicile_certificate');
    const fileInputPublishedPaper = document.getElementById('file_published_papers');
    const fileInputProposedStudyTimeline = document.getElementById('file_proposed_study_timeline');
    const fileInputFilePhdDegree = document.getElementById('file_phd_degree');
    const fileInputDeclarationCertificate = document.getElementById('file_declaration_certificate');
    const fileInputPIAadharCard = document.getElementById('file_aadhar_card');
    const fileInputResGuideCertificate = document.getElementById('file_res_guide_certificate');
    const fileInputInstituteHeadCertificate = document.getElementById('file_institute_head_certificate');
    const fileInputCandidateCv = document.getElementById('file_candidate_cv');
    const fileInputMentorCv = document.getElementById('file_mentor_cv');

    let isSavedForm_0 = isSavedForm_1 = isSavedForm_2 = isSavedForm_3 = isSavedForm_4 = isSavedForm_5 = isSavedForm_6 = true; 

    // custom requirement 
    let isFileUploaded = 0;
    isUserApplicableForScheme(scheme_code);

	// add more fields function
    let max_fields = 
        max_fields_list_of_publications = 
        20;
	let x = 
        x_list_of_publications = 
        1;
	var wrapper = $(".input_fields_wrap"); 		//Fields wrapper
	let add_button = $(".add_field_button"); 	//Add button ID
	var wrapper_list_of_publications = $(".input_fields_wrap_list_of_publications > tbody"); 		//Fields wrapper
	let add_button_list_of_publications = $(".add_field_button_list_of_publications"); 	//Add button ID

    $( document ).ready(function() {
        // display tab content
        setCurrentYearForYearOfPassing("PDFs");

        // set max date as Today 
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        document.getElementById('dob').max = today;

        // set saved data
        saveData = getSavedData = JSON.parse(localStorage.getItem("postdoctoralFellowshipData"));
        if (getSavedData && getSavedData['id']) {
            form_no_saved = getSavedData['form_no'];
            if (form_no_saved) {
                openNextForm(0, form_no_saved);
                // $("#form_"+form_no_saved).addClass('d-block');
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
            getSavedData["marks_1"] = getSavedData["marks_1"] ?? "";
            getSavedData["cgpa_1"] = getSavedData["cgpa_1"] ?? "";
            $("#marks_1").val(getSavedData["marks_1"]);
            $("#cgpa_1").val(getSavedData["cgpa_1"]);

            $("#course_2").val(getSavedData["course_2"]);
            $("#board_name_2").val(getSavedData["board_name_2"]);
            $("#college_name_2").val(getSavedData["college_name_2"]);
            $("#year_of_passing_2").val(getSavedData["year_of_passing_2"]);
            getSavedData["marks_2"] = getSavedData["marks_2"] ?? "";
            getSavedData["cgpa_2"] = getSavedData["cgpa_2"] ?? "";
            $("#marks_2").val(getSavedData["marks_2"]);
            $("#cgpa_2").val(getSavedData["cgpa_2"]);

            $("#course_3").val(getSavedData["course_3"]);
            $("#board_name_3").val(getSavedData["board_name_3"]);
            $("#college_name_3").val(getSavedData["college_name_3"]);
            $("#year_of_passing_3").val(getSavedData["year_of_passing_3"]);
            getSavedData["marks_3"] = getSavedData["marks_3"] ?? "";
            getSavedData["cgpa_3"] = getSavedData["cgpa_3"] ?? "";
            $("#marks_3").val(getSavedData["marks_3"]);
            $("#cgpa_3").val(getSavedData["cgpa_3"]);

            $("#course_4").val(getSavedData["course_4"]);
            $("#board_name_4").val(getSavedData["board_name_4"]);
            $("#college_name_4").val(getSavedData["college_name_4"]);
            $("#year_of_passing_4").val(getSavedData["year_of_passing_4"]);
            getSavedData["marks_4"] = getSavedData["marks_4"] ?? "";
            getSavedData["cgpa_4"] = getSavedData["cgpa_4"] ?? "";
            $("#marks_4").val(getSavedData["marks_4"]);
            $("#cgpa_4").val(getSavedData["cgpa_4"]);

            $("#course_5").val(getSavedData["course_5"]);
            $("#board_name_5").val(getSavedData["board_name_5"]);
            $("#college_name_5").val(getSavedData["college_name_5"]);
            $("#year_of_passing_5").val(getSavedData["year_of_passing_5"]);
            getSavedData["marks_5"] = getSavedData["marks_5"] ?? "";
            getSavedData["cgpa_5"] = getSavedData["cgpa_5"] ?? "";
            $("#marks_5").val(getSavedData["marks_5"]);
            $("#cgpa_5").val(getSavedData["cgpa_5"]);

            $("#course_6").val(getSavedData["course_6"]);
            $("#board_name_6").val(getSavedData["board_name_6"]);
            $("#college_name_6").val(getSavedData["college_name_6"]);
            $("#year_of_passing_6").val(getSavedData["year_of_passing_6"]);
            getSavedData["marks_6"] = getSavedData["marks_6"] ?? "";
            getSavedData["cgpa_6"] = getSavedData["cgpa_6"] ?? "";
            $("#marks_6").val(getSavedData["marks_6"]);
            $("#cgpa_6").val(getSavedData["cgpa_6"]);
            
            $("#phd_thesis").val(getSavedData["phd_thesis"]);
            if (getSavedData["file_phd_degree"]) {
                file_phd_degree = getSavedData["file_phd_degree"];
                displayUploadedFile('docs', 'file_phd_degree', file_phd_degree);
            }
            $("#phd_research_guide_name").val(getSavedData["phd_research_guide_name"]);
            $("#phd_research_guide_designation").val(getSavedData["phd_research_guide_designation"]);
            $("#phd_degree_obtained_university").val(getSavedData["phd_degree_obtained_university"]);
            $("#phd_work_proposed_institution").val(getSavedData["phd_work_proposed_institution"]);
            $("#phd_work_carried_out").val(getSavedData["phd_work_carried_out"]);

            let guideDetails = getSavedData["guide_details"];
            if ( !guideDetails || guideDetails == "null" ) {} else {
                x = 0;
                guideDetails.forEach(guideDetail => {
                    if(x < max_fields){ 					//max input box allowed
                        x++; 								//text box increment
                        if (x==1) {
                            $("#guide_name_1").val(guideDetail['guide_name']);
                            $("#guide_designation_1").val(guideDetail['guide_designation']);
                            $("#guide_address_1").val(guideDetail['guide_address']);
                        } else {
                            $(wrapper).append(`
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="form-group col-md-4 mb-4">
                                                <label class="form-label star" style="font-weight:600" for="guide_name_`+x+`">Name of the Co-Guide</label>  
                                                <input type="text" id="guide_name_`+x+`" name="guide_name[]" value="${guideDetail['guide_name']}" oninput="validateInput(this)" placeholder="Enter name" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="guide_name_`+x+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-3 mb-4">
                                                <label class="form-label star" style="font-weight:600" for="guide_designation_`+x+`">Designation</label>  
                                                <input type="text" id="guide_designation_`+x+`" name="guide_designation[]" value="${guideDetail['guide_designation']}" oninput="validateInput(this)" placeholder="Enter designation" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="guide_designation_`+x+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-5 mb-4">
                                                <label class="form-label star" style="font-weight:600" for="guide_address_`+x+`">Institutional Address</label>  
                                                <input type="text" id="guide_address_`+x+`" name="guide_address[]" value="${guideDetail['guide_address']}" oninput="validateInput(this)" placeholder="Enter address" class="form-control input-md">
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
                    }
                });
            }
            $("#proposed_work").val(getSavedData["proposed_work"]);
            $("#broad_discipline").val(getSavedData["broad_discipline"]);
            $("#work_background").val(getSavedData["work_background"]);
            $("#hypothesis_proposed").val(getSavedData["hypothesis_proposed"]);
            $("#objectives").val(getSavedData["objectives"]);
            $("#mat_and_methods_proposed").val(getSavedData["mat_and_methods_proposed"]);
            $("#expected_outcome").val(getSavedData["expected_outcome"]);
            $("#imp_references").val(getSavedData["imp_references"]);
            $("#imp_of_proposed_work").val(getSavedData["imp_of_proposed_work"]);
            $("#expertise_of_mentor").val(getSavedData["expertise_of_mentor"]);
            if ( !getSavedData["list_of_publications_details"] || getSavedData["list_of_publications_details"] == "null" ) {} else {
                x_list_of_publications = 0;
                getSavedData["list_of_publications_details"].forEach(listOfPublications => {
                    if(x_list_of_publications < max_fields_list_of_publications){ 					//max input box allowed
                        x_list_of_publications++; 								//text box increment
                        if (x_list_of_publications==1) {
                            $("#list_of_publications_1").val(listOfPublications['name']);
                        } else {
                            $(wrapper_list_of_publications).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_list_of_publications+`</td>
                                    <td>
                                        <textarea class="form-control" name="list_of_publications[]" id="list_of_publications_`+x_list_of_publications+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter publications">${listOfPublications['name']}</textarea>
                                        <span id="list_of_publications_`+x_list_of_publications+`_error_msg" class="error-msg col-md-12"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_list_of_publications == max_fields_list_of_publications) {
                                $(".add_field_button_list_of_publications").attr("disabled", true);
                            }
                        }
                    }
                });
            }
            if (getSavedData['is_published_any_papers']) {
                is_published_any_papers = getSavedData['is_published_any_papers'];
            }
            $("input:radio[name=is_published_any_papers]").val([is_published_any_papers]);
            showMoreOptions('papers_published', is_published_any_papers);
            if (getSavedData['file_published_papers']) {
                file_published_papers = getSavedData['file_published_papers'];
                displayUploadedFile('docs', 'file_published_papers', file_published_papers);
            }
            if (getSavedData["file_proposed_study_timeline"]) {
                file_proposed_study_timeline = getSavedData["file_proposed_study_timeline"];
                displayUploadedFile('docs', 'file_proposed_study_timeline', file_proposed_study_timeline);
            }
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
            if (getSavedData["file_candidate_cv"]) {
                file_candidate_cv = getSavedData["file_candidate_cv"];
                displayUploadedFile('docs', 'file_candidate_cv', file_candidate_cv);
            }
            if (getSavedData["file_mentor_cv"]) {
                file_mentor_cv = getSavedData["file_mentor_cv"];
                displayUploadedFile('docs', 'file_mentor_cv', file_mentor_cv);
            }
        } else {
            $("#form_0").addClass('d-block');
            callApi({
                method: 'GET',
                url: 'api/schemePostDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
                form_type: 'preview-data',
                is_loader: 'within_the_page',
            });
            AmagiLoader.show();
        }
        // if no data saved 
        getPresetUserData();

        $(add_button).click(function(e){ 			//on add input button click
			e.preventDefault();
            x = guide_names.length;
			if(x < max_fields){ 					//max input box allowed
				x++; 								//text box increment
				$(wrapper).append(`
					<div class="row">
						<div class="col-md-11">
							<div class="row">
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
    
        // Publications list
        $(add_button_list_of_publications).click(function(e){ 			    //on add input button click
            e.preventDefault();
            x_list_of_publications = list_of_publicationsDetails.length;
            if(x_list_of_publications < max_fields_list_of_publications){ 					//max input box allowed
                x_list_of_publications++;					                    //text box increment
                $(wrapper_list_of_publications).append(`
                    <tr class="wrapper_row">
                        <td class="serial-number text-center">`+x_list_of_publications+`</td>
                        <td>
                            <textarea class="form-control" name="list_of_publications[]" id="list_of_publications_`+x_list_of_publications+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter publications"></textarea>
                            <span id="list_of_publications_`+x_list_of_publications+`_error_msg" class="error-msg col-md-12"></span>
                        </td>
                        <td width="62px">
                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                        </td>
                    </tr>
                `); //add input box
                if (x_list_of_publications == max_fields_list_of_publications) {
                    $(".add_field_button_list_of_publications").attr("disabled", true);
                }
            }
        });
        $(wrapper_list_of_publications).on("click",".remove_field", function(e){
            e.preventDefault(); 
            $(this).closest('tr').remove();
            x_list_of_publications--;
            if (x_list_of_publications < max_fields_list_of_publications) {
                $(".add_field_button_list_of_publications").attr("disabled", false);
            }
            updateSerialNumbers(wrapper_list_of_publications);
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
    $('input:radio[name=is_published_any_papers]').on("change", function() {
        is_published_any_papers = this.value;
        showMoreOptions('papers_published', is_published_any_papers);
    });

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
                    'storage_key' : 'postdoctoralFellowshipData'
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
                    'file_type' : 'img', 
                    'response_id' : 'file_profile_picture', 
                    'file_id' : fileInputProfilePicture, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
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
                    'file_type' : 'docs', 
                    'response_id' : 'file_domicile_certificate', 
                    'file_id' : fileInputDomicileCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
                });
                isSavedForm_0 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputFilePhdDegree.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_phd_degree', 
                    'file_id' : fileInputFilePhdDegree, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
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
                    'file_type' : 'docs', 
                    'response_id' : 'file_published_papers', 
                    'file_id' : fileInputPublishedPaper, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData',
                    'max_file_upload_size': 2
                });
                isSavedForm_5 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputProposedStudyTimeline.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_proposed_study_timeline', 
                    'file_id' : fileInputProposedStudyTimeline, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
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
                    'file_type' : 'docs', 
                    'response_id' : 'file_declaration_certificate', 
                    'file_id' : fileInputDeclarationCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
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
                    'storage_key' : 'postdoctoralFellowshipData'
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
                    'file_type' : 'docs', 
                    'response_id' : 'file_res_guide_certificate', 
                    'file_id' : fileInputResGuideCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
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
                    'file_type' : 'docs', 
                    'response_id' : 'file_institute_head_certificate', 
                    'file_id' : fileInputInstituteHeadCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
                });
                isSavedForm_6 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputCandidateCv.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_candidate_cv', 
                    'file_id' : fileInputCandidateCv, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
                });
                isSavedForm_6 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputMentorCv.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_mentor_cv', 
                    'file_id' : fileInputMentorCv, 
                    'file_data' : fileData, 
                    'storage_key' : 'postdoctoralFellowshipData'
                });
                isSavedForm_6 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });

    function saveForm(formNo) {
        if (formNo==0) {
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
            saveData["course_5"] = "PhD";
            saveData["board_name_5"] = validateEmptyFields("board_name_5", "");
            saveData["college_name_5"] = validateEmptyFields("college_name_5", "");
            saveData["year_of_passing_5"] = validateEmptyFields("year_of_passing_5", "");
            saveData["marks_5"] = validateEmptyFields("marks_5", ""); 
            saveData["cgpa_5"] = validateEmptyFields("cgpa_5", ""); 
            saveData["course_6"] = "ANY OTHER";
            saveData["board_name_6"] = validateEmptyFields("board_name_6", "");
            saveData["college_name_6"] = validateEmptyFields("college_name_6", "");
            saveData["year_of_passing_6"] = validateEmptyFields("year_of_passing_6", "");
            saveData["marks_6"] = validateEmptyFields("marks_6", ""); 
            saveData["cgpa_6"] = validateEmptyFields("cgpa_6", ""); 
            isSavedForm_1 = true;

        } else if (formNo==2) {
            saveData["phd_thesis"] = validateEmptyFields("phd_thesis", "");
            file_phd_degree = saveData["file_phd_degree"];
            saveData["phd_research_guide_name"] = validateEmptyFields("phd_research_guide_name", "");
            saveData["phd_research_guide_designation"] = validateEmptyFields("phd_research_guide_designation", "");
            saveData["phd_work_proposed_institution"] = validateEmptyFields("phd_work_proposed_institution", "");
            saveData["phd_degree_obtained_university"] = validateEmptyFields("phd_degree_obtained_university", "");
            saveData["phd_work_carried_out"] = validateEmptyFields("phd_work_carried_out", "");
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
            saveData["broad_discipline"] = validateEmptyFields("broad_discipline", "");
            saveData["work_background"] = validateEmptyFields("work_background", "");
            saveData["hypothesis_proposed"] = validateEmptyFields("hypothesis_proposed", "");
            saveData["objectives"] = validateEmptyFields("objectives", "");
            saveData["mat_and_methods_proposed"] = validateEmptyFields("mat_and_methods_proposed", "");
            saveData["expected_outcome"] = validateEmptyFields("expected_outcome", "");
            saveData["imp_references"] = validateEmptyFields("imp_references", "");
            saveData["imp_of_proposed_work"] = validateEmptyFields("imp_of_proposed_work", "");
            saveData["expertise_of_mentor"] = validateEmptyFields("expertise_of_mentor", "");
            saveData["list_of_publications_details"] = [];
			if (list_of_publicationsDetails.length>0) {
				for(let j=0;j<list_of_publicationsDetails.length;j++)
				{
					if ( list_of_publicationsDetails[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["list_of_publications_details"].push({
							'name': list_of_publicationsDetails[j].value,
						});
					}
				}
			}
            isSavedForm_4 = true;

        } else if (formNo==5) {
            saveData["is_published_any_papers"] = is_published_any_papers;
            file_published_papers = saveData["file_published_papers"];
            file_proposed_study_timeline = saveData["file_proposed_study_timeline"];
            isSavedForm_5 = true;

        } else if (formNo==6) {
            file_declaration_certificate = saveData["file_declaration_certificate"];
            file_aadhar_card = saveData["file_aadhar_card"];
            file_res_guide_certificate = saveData["file_res_guide_certificate"];
            file_institute_head_certificate = saveData["file_institute_head_certificate"];
            file_candidate_cv = saveData["file_candidate_cv"];
            file_mentor_cv = saveData["file_mentor_cv"];
            isSavedForm_6 = true;
        }
        saveData["form_type"] = 'save-form';
        saveData["form_no"] = formNo;
        saveData["scheme_id"] = $("#scheme_id").val();
        popUpMsg("Saving your data.","","success");
        localStorage.setItem("postdoctoralFellowshipData", JSON.stringify(saveData));
        
        // save every response for saving user data
        callApi({
            method: 'POST',
            url: 'api/schemePostDoctoralFellowshipApi.php',
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
            email = validateEmailId("email", "Please enter your EMAIL ID!");
            phone_no = validatePhoneNumber("phone_no", "Phone Number cannot be empty!");
            country_code = validateEmptyFields("country_code", "Country code cannot be empty!");
            res_address = validateEmptyFields("res_address", "Please enter your residential address!");
            dob = validateEmptyFields("dob", "Please enter your Date of Birth!");
            last_name = validateEmptyFields("last_name", "Last name cannot be empty, Please enter Last name!");
            middle_name = validateEmptyFields("middle_name", "");
            first_name = validateEmptyFields("first_name", "First name cannot be empty, Please enter First name!");
            
            if (first_name && last_name && dob && res_address && country_code && phone_no && email && file_profile_picture && category!=0 ) {
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
            cgpa_6 = validateEmptyFields("cgpa_6", "");
            marks_6 = validateEmptyFields("marks_6", ""); 
            year_of_passing_6 = validateEmptyFields("year_of_passing_6", "");
            college_name_6 = validateEmptyFields("college_name_6", "");
            board_name_6 = validateEmptyFields("board_name_6", "");
            course_6 = "ANY OTHER";
            cgpa_5 = validateEmptyFields("cgpa_5", "");
            marks_5 = validateEmptyFields("marks_5", ""); //Please enter here your GRADES.
            year_of_passing_5 = validateEmptyFields("year_of_passing_5", "Please select passing year.");
            college_name_5 = validateEmptyFields("college_name_5", "Please enter your Institution name.");
            board_name_5 = validateEmptyFields("board_name_5", "Please enter the University you studied.");
            course_5 = "PhD";
            cgpa_4 = validateEmptyFields("cgpa_4", "");
            marks_4 = validateEmptyFields("marks_4", ""); //Please enter here your GRADES.
            year_of_passing_4 = validateEmptyFields("year_of_passing_4", "Please select passing year.");
            college_name_4 = validateEmptyFields("college_name_4", "Please enter your college name.");
            board_name_4 = validateEmptyFields("board_name_4", "Please enter the University you studied.");
            course_4 = "PG";
            cgpa_3 = validateEmptyFields("cgpa_3", "");
            marks_3 = validateEmptyFields("marks_3", ""); //Please enter here your GRADES.
            year_of_passing_3 = validateEmptyFields("year_of_passing_3", "Please select passing year.");
            college_name_3 = validateEmptyFields("college_name_3", "Please enter your college name.");
            board_name_3 = validateEmptyFields("board_name_3", "Please enter the University you studied.");
            course_3 = "UG";
            cgpa_2 = validateEmptyFields("cgpa_2", "");
            marks_2 = validateEmptyFields("marks_2", ""); //Please enter here your GRADES.
            year_of_passing_2 = validateEmptyFields("year_of_passing_2", "Please select passing year.");
            college_name_2 = validateEmptyFields("college_name_2", "Please enter your college name.");
            board_name_2 = validateEmptyFields("board_name_2", "Please enter the Board you studied.");
            course_2 = "HSSC";
            cgpa_1 = validateEmptyFields("cgpa_1", "");
            marks_1 = validateEmptyFields("marks_1", ""); //Please enter here your GRADES.
            year_of_passing_1 = validateEmptyFields("year_of_passing_1", "Please select passing year.");
            college_name_1 = validateEmptyFields("college_name_1", "Please enter your school name.");
            board_name_1 = validateEmptyFields("board_name_1", "Please enter the Board you studied.");
            course_1 = "SSC";
            if (course_1 && board_name_1 && college_name_1 && year_of_passing_1 &&  
                course_2 && board_name_2 && college_name_2 && year_of_passing_2 &&  
                course_3 && board_name_3 && college_name_3 && year_of_passing_3 &&  
                course_4 && board_name_4 && college_name_4 && year_of_passing_4 &&  
                course_5 && board_name_5 && college_name_5 && year_of_passing_5 ) {
                if (cgpa_1) { cgpa_1 = validateEmptyFields("cgpa_1", "Please enter valid CGPA!"); if (!cgpa_1) { return false; } }
                if (cgpa_2) { cgpa_2 = validateEmptyFields("cgpa_2", "Please enter valid CGPA!"); if (!cgpa_2) { return false; } }
                if (cgpa_3) { cgpa_3 = validateEmptyFields("cgpa_3", "Please enter valid CGPA!"); if (!cgpa_3) { return false; } }
                if (cgpa_4) { cgpa_4 = validateEmptyFields("cgpa_4", "Please enter valid CGPA!"); if (!cgpa_4) { return false; } }
                if (cgpa_5) { cgpa_5 = validateEmptyFields("cgpa_5", "Please enter valid CGPA!"); if (!cgpa_5) { return false; } }
                if (cgpa_6) { cgpa_6 = validateEmptyFields("cgpa_6", "Please enter valid CGPA!"); if (!cgpa_6) { return false; } }

                if (marks_1) { marks_1 = validateEmptyFields("marks_1", "Please enter valid CGPA!"); if (!marks_1) { return false; } }
                if (marks_2) { marks_2 = validateEmptyFields("marks_2", "Please enter valid CGPA!"); if (!marks_2) { return false; } }
                if (marks_3) { marks_3 = validateEmptyFields("marks_3", "Please enter valid CGPA!"); if (!marks_3) { return false; } }
                if (marks_4) { marks_4 = validateEmptyFields("marks_4", "Please enter valid CGPA!"); if (!marks_4) { return false; } }
                if (marks_5) { marks_5 = validateEmptyFields("marks_5", "Please enter valid CGPA!"); if (!marks_5) { return false; } }
                if (marks_6) {marks_6 = validateEmptyFields("marks_6", "Please enter here your GRADES."); if (!marks_6) { return false; } }

                if (year_of_passing_6) { year_of_passing_6 = validateEmptyFields("year_of_passing_6", "Please select passing year."); if (!year_of_passing_6) { return false; } }
                if (college_name_6) { college_name_6 = validateEmptyFields("college_name_6", "Please enter your college name."); if (!college_name_6) { return false; } }
                if (board_name_6) { board_name_6 = validateEmptyFields("board_name_6", "Please enter the Board you studied."); if (!board_name_6) { return false; } }
            } else { return false; }
            
        } else if (formNo==2) {
            phd_work_proposed_institution = validateEmptyFields("phd_work_proposed_institution", "Institution name is required!!");
            phd_work_carried_out = validateEmptyFields("phd_work_carried_out", "This field is required!!");
            phd_degree_obtained_university = validateEmptyFields("phd_degree_obtained_university", "University name is required!!");
            phd_research_guide_designation = validateEmptyFields("phd_research_guide_designation", "Please enter Designation name!!");
            phd_research_guide_name = validateEmptyFields("phd_research_guide_name", "Please enter guide name!!");
            if (saveData["file_phd_degree"]) {
                file_phd_degree = saveData["file_phd_degree"];
            }
            phd_thesis = validateEmptyFields("phd_thesis", "Please enter Thesis Title!!");
            if (phd_thesis && file_phd_degree && phd_research_guide_name && phd_research_guide_designation && phd_degree_obtained_university && phd_work_proposed_institution && phd_work_carried_out ) {
            } else {
                if (!file_phd_degree){ popUpMsg('Please upload the scanned copy of Ph.D degree/award.'); return false; }
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
            expertise_of_mentor = validateEmptyFields("expertise_of_mentor", "Please enter the required details! ");
            imp_of_proposed_work = validateEmptyFields("imp_of_proposed_work", "Please enter the required details! ");
            imp_references = validateEmptyFields("imp_references", "Please enter the required details! ");
            expected_outcome = validateEmptyFields("expected_outcome", "Please enter the required details! ");
            mat_and_methods_proposed = validateEmptyFields("mat_and_methods_proposed", "Please enter the required details! ");
            objectives = validateEmptyFields("objectives", "Please enter the required details! ");
            hypothesis_proposed = validateEmptyFields("hypothesis_proposed", "Please enter the required details! ");
            work_background = validateEmptyFields("work_background", "Please enter the required details! ");
            broad_discipline = validateEmptyFields("broad_discipline", "Please enter the required details! ");
            proposed_work = validateEmptyFields("proposed_work", "Please enter the required details! ");
            if ( proposed_work && broad_discipline && work_background && hypothesis_proposed && objectives && mat_and_methods_proposed && expected_outcome && imp_references && imp_of_proposed_work && expertise_of_mentor ) {
                if (list_of_publicationsDetails.length>0) {
                    for(let j=0;j<list_of_publicationsDetails.length;j++)
                    {
                        let tempIdKey = j+1;                
                        if ( validateEmptyFields("list_of_publications_"+tempIdKey, "Please enter required details!") ) {} else { return false; }
                    }
                }
            } else { return false; }
            
        } else if (formNo==5) {
            if (saveData['file_published_papers']) {
                file_published_papers = saveData['file_published_papers'];
            }
            if (saveData['file_proposed_study_timeline']) {
                file_proposed_study_timeline = saveData['file_proposed_study_timeline'];
            }
            if (is_published_any_papers==1) {
                if (!file_published_papers){ popUpMsg('Please upload scanned copy of Published Paper.'); return false; }
            }
            if (!file_proposed_study_timeline){ popUpMsg('Please upload scanned copy of Proposed study Timeline or chart.'); return false; }
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
            if (saveData['file_candidate_cv']) {
                file_candidate_cv = saveData["file_candidate_cv"];
            }
            if (saveData['file_mentor_cv']) {
                file_mentor_cv = saveData["file_mentor_cv"];
            }
            if ( file_declaration_certificate && file_aadhar_card && file_res_guide_certificate && file_institute_head_certificate && file_candidate_cv && file_mentor_cv ) {} else {
                if (!file_mentor_cv || file_mentor_cv==""){ popUpMsg('Please upload the scanned copy of Mentors CV.'); }
                if (!file_candidate_cv || file_candidate_cv==""){ popUpMsg('Please upload the scanned copy of the Candidate CV.'); }
                if (!file_institute_head_certificate || file_institute_head_certificate==""){ popUpMsg('Please upload the scanned copy of Certificate from Head of the Institute.'); }
                if (!file_aadhar_card || file_aadhar_card==""){ popUpMsg('Please upload the scanned Aadhar Card copy.'); }
                if (!file_declaration_certificate || file_declaration_certificate==""){ popUpMsg('Please upload the scanned copy of Self Declaration.'); }
                if (!file_res_guide_certificate || file_res_guide_certificate==""){ popUpMsg('Please upload the scanned copy Approval Certificate from the Mentor.'); }
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
                gender==getSavedData["gender"] && 
                is_domicile_certificate==getSavedData["is_domicile_certificate"] && category==getSavedData["category"] && 
                file_profile_picture==getSavedData["file_profile_picture"] &&
                isSavedForm_0 ) { } else { return false; } 

        } else if (formNo==1) {
            if (board_name_1==getSavedData["board_name_1"] && college_name_1==getSavedData["college_name_1"] && year_of_passing_1==getSavedData["year_of_passing_1"] && marks_1==getSavedData["marks_1"] && cgpa_1==getSavedData["cgpa_1"] && 
                board_name_2==getSavedData["board_name_2"] && college_name_2==getSavedData["college_name_2"] && year_of_passing_2==getSavedData["year_of_passing_2"] && marks_2==getSavedData["marks_2"] && cgpa_2==getSavedData["cgpa_2"] && 
                board_name_3==getSavedData["board_name_3"] && college_name_3==getSavedData["college_name_3"] && year_of_passing_3==getSavedData["year_of_passing_3"] && marks_3==getSavedData["marks_3"] && cgpa_3==getSavedData["cgpa_3"] && 
                board_name_4==getSavedData["board_name_4"] && college_name_4==getSavedData["college_name_4"] && year_of_passing_4==getSavedData["year_of_passing_4"] && marks_4==getSavedData["marks_4"] && cgpa_4==getSavedData["cgpa_4"] && 
                board_name_5==getSavedData["board_name_5"] && college_name_5==getSavedData["college_name_5"] && year_of_passing_5==getSavedData["year_of_passing_5"] && marks_5==getSavedData["marks_5"] && cgpa_5==getSavedData["cgpa_5"] &&
                board_name_6==getSavedData["board_name_6"] && college_name_6==getSavedData["college_name_6"] && year_of_passing_6==getSavedData["year_of_passing_6"] && marks_6==getSavedData["marks_6"] && cgpa_6==getSavedData["cgpa_6"] &&
                isSavedForm_1 ) { } else { return false; } 

        } else if (formNo==2) {
            if (phd_work_carried_out==getSavedData["phd_work_carried_out"] && phd_work_proposed_institution==getSavedData["phd_work_proposed_institution"] && phd_degree_obtained_university==getSavedData["phd_degree_obtained_university"] && 
                phd_research_guide_designation==getSavedData["phd_research_guide_designation"] && phd_research_guide_name==getSavedData["phd_research_guide_name"] && file_phd_degree==getSavedData["file_phd_degree"] && phd_thesis==getSavedData["phd_thesis"] && 
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
            if (getSavedData["list_of_publications_details"] && getSavedData["list_of_publications_details"].length>0) {
                if (list_of_publicationsDetails.length == getSavedData["list_of_publications_details"].length) {
                    if (list_of_publicationsDetails.length>0) {
                        for(let j=0;j<list_of_publicationsDetails.length;j++)
                        {
                            if (!getSavedData["list_of_publications_details"][j]) { return false; }
                            if ( list_of_publicationsDetails[j].value == getSavedData["list_of_publications_details"][j].name ) { } else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }
            if ( proposed_work==getSavedData["proposed_work"] && broad_discipline==getSavedData["broad_discipline"] && work_background==getSavedData["work_background"] && hypothesis_proposed==getSavedData["hypothesis_proposed"] && 
                objectives==getSavedData["objectives"] && mat_and_methods_proposed==getSavedData["mat_and_methods_proposed"] && expected_outcome==getSavedData["expected_outcome"] && 
                imp_references==getSavedData["imp_references"] && imp_of_proposed_work==getSavedData["imp_of_proposed_work"] && expertise_of_mentor==getSavedData["expertise_of_mentor"] && 
                isSavedForm_4 
            ) { } else { return false; } 

        } else if (formNo==5) {
            if ( file_proposed_study_timeline==getSavedData["file_proposed_study_timeline"] &&
                isSavedForm_5 ) { } else { return false; } 
                
        } else if (formNo==6) {
            if ( file_declaration_certificate==getSavedData["file_declaration_certificate"] && file_aadhar_card==getSavedData["file_aadhar_card"] && file_res_guide_certificate==getSavedData["file_res_guide_certificate"] && 
                file_institute_head_certificate==getSavedData["file_institute_head_certificate"] && file_candidate_cv==getSavedData["file_candidate_cv"] && file_mentor_cv==getSavedData["file_mentor_cv"] &&
                isSavedForm_6 ) { } else { return false; } 
        }
        return true;
    }
    function validateInputType(type, inputFieldId, inputFieldValue) {
        // return error message
        let trimInputFieldId = inputFieldId.slice(0, -2);
        let checkTextLength=checkTextValidate = checkText = checkTextArea = true;;
        let msg = '';
        let minCharLength = 2;
        let maxCharLength = 250;
        var allowCharsForID = ["proposed_work", "phd_thesis"];

        if (inputFieldValue == '' && inputFieldId=="board_name_6" || inputFieldId=="college_name_6" || inputFieldId=="marks_6") {
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
                // check null fields, length, validate special characters, else return empty msg
                if (inputFieldValue === '') {   
                    switch (inputFieldId) {
                        case 'first_name': msg = 'First name is required'; break;
                        case 'last_name': msg = 'Last name is required'; break;
                        case 'phd_thesis': msg = 'Ph.D. thesis title is required'; break;
                        case 'phd_research_guide_name': msg = 'Research Guide name is required'; break;
                        case 'phd_research_guide_designation': msg = 'Research Guide Designation is required'; break;
                        case 'phd_degree_obtained_university': msg = 'University name is required'; break;
                        case 'phd_work_proposed_institution': msg = 'Institution name is required'; break;
                        case 'phd_work_carried_out': msg = 'University/Institute name is required'; break;
                        case 'broad_discipline': msg = 'Broad discipline is required'; break;
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
                        // case 'phd_thesis': msg = 'Ph.D. thesis '+msg; break;
                        case 'phd_research_guide_name': msg = 'Research Guide '+msg; break;
                        case 'phd_research_guide_designation': msg = 'Research Guide '+msg; break;
                        case 'phd_degree_obtained_university': msg = 'University '+msg; break;
                        case 'phd_work_proposed_institution': msg = 'Institution '+msg; break;
                        case 'phd_work_carried_out': msg = 'University/Institute '+msg; break;
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
            // if (inputFieldId=="work_background" || inputFieldId=="hypothesis_proposed" || inputFieldId=="objectives" || inputFieldId=="mat_and_methods_proposed" || inputFieldId=="expected_outcome" || inputFieldId=="imp_references" || inputFieldId=="imp_of_proposed_work" || inputFieldId=="expertise_of_mentor" || inputFieldId=="list_of_publications" ) {
            //     checkTextLength = false;
            //     return msg;
            // }

            if (inputFieldValue === '') {
                msg = 'This field is required!';
                // if (checkTextLength) {
                //     msg = 'Address is required';
                // } else {
                //     if (checkTextValidate) {
                //         msg = 'This is required';
                //     }
                // }
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
                if (document.querySelector("#form_submission_note").checked) {
                    // alert
                    submitFormAlert();
                } else {
                    popUpMsg("Please agree to the Form submission to GSRF office!");
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
                url: 'api/schemePostDoctoralFellowshipApi.php',
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
                localStorage.setItem("postdoctoralFellowshipData", JSON.stringify(getSavedData));
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else if (type=='apply-scheme') {
                AmagiLoader.hide();
                popUpSchemeConfirmMsg({
                    localStorageKey : 'postdoctoralFellowshipData',
                    schemeUrl : '<?php echo $schemeUrl ?>',
                    scheme_code : scheme_code,
                    title : res.message, 
                    confirmButtonText : 'Confirm',
                    showCancelButton : false,
                });
                // generate pdf
                callApi({
                    method: 'GET',
                    url: 'api/schemePostDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
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