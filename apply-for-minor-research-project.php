<?php 
require "layout/head.php"; 
if (!isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
$schemeUrl = "schemes-minor-grants.php";
?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/generalData.php";
$isSchemeAvailableFor = "MIN"; 
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
                                <li><a href="<?php echo $schemeUrl;?>">Minor Research Scheme</a></li>
                                <li>Apply Here</li>
                            </ol>
                            <h2>
                                Application for Minor Research Project
                                <br>
                                <p>
                                    Embark on an Extraordinary Research Voyage: Apply Now for the Minor Research Project Scheme 
                                    <br>
                                    to get financial assistance to a Research Project.
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
                                <div class="tab-text">Section A</div>
                            </div>
                            <div class="tab" id="tab_1">
                                <div class="tab-number">2</div>
                                <div class="tab-text">Section B</div>
                            </div>
                            <div class="tab" id="tab_2">
                                <div class="tab-number">3</div>
                                <div class="tab-text">Section C 1</div>
                            </div>
                            <div class="tab" id="tab_3">
                                <div class="tab-number">4</div>
                                <div class="tab-text">C 2</div>
                            </div>
                            <div class="tab" id="tab_4">
                                <div class="tab-number">5</div>
                                <div class="tab-text">C 3</div>
                            </div>
                            <div class="tab" id="tab_5">
                                <div class="tab-number">6</div>
                                <div class="tab-text">C 4</div>
                            </div>
                            <div class="tab" id="tab_6">
                                <div class="tab-number">7</div>
                                <div class="tab-text">C 5</div>
                            </div>
                            <div class="tab" id="tab_7">
                                <div class="tab-number">8</div>
                                <div class="tab-text">C 6</div>
                            </div>
                            <div class="tab" id="tab_8">
                                <div class="tab-number">9</div>
                                <div class="tab-text">C 7</div>
                            </div>
                            <div class="tab" id="tab_9">
                                <div class="tab-number">10</div>
                                <div class="tab-text">Section D</div>
                            </div>
                        </div>
                
                        <form class="">
                            <input type="hidden" id="scheme_id" name="scheme_id" value="" readonly>
                            <!-- Step One -->
                            <div id="form_0" class="tabcontent inner-forms">
                                <div class="forms">
                                    <div class="row">
                                        <h3 class="mb-5">Principal Investigator Details (No Co-PI allowed)</h3>
                                        <div class="col-md-4 mb-4">
                                            <label for="first_name" class="form-label star">First Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="" oninput="validateInput(this)" placeholder="Enter first name" aria-describedby="first name" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_first_name" onClick="displayInputField('first_name')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="first_name_error_msg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="middle_name" class="form-label">Middle Name</label>
                                            <div class="input-group mb-3">        
                                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="" placeholder="Enter middle name" aria-describedby="middle name" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_middle_name" onClick="displayInputField('middle_name')"><i class="bi bi-pencil-fill"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="last_name" class="form-label star">Last Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="" oninput="validateInput(this)" placeholder="Enter last name" aria-describedby="last name" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_last_name" onClick="displayInputField('last_name')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="last_name_error_msg"></span>
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
                                        <div class="col-md-4 mb-4">
                                            <label for="dob" class="form-label star">Date of Birth</label>
                                            <div class="input-group mb-3">        
                                                <input type="date" class="form-control" id="dob" name="dob" value="" placeholder="DD/MM/YYYY" aria-describedby="DOB" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_dob" onClick="displayInputField('dob')"><i class="bi bi-pencil-fill"></i></button>
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
                                                <input type="number" class="form-control" id="phone_no" name="phone_no" value="" aria-describedby="phone_no" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_phone_no" onClick="displayInputField('phone_no')"><i class="bi bi-pencil-fill"></i></button>
                                            </div>
                                        </div>                    
                                        <div class="col-md-4 mb-4">
                                            <label for="email" class="form-label star">Email ID</label>
                                            <div class="input-group mb-3">
                                                <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter email id" aria-describedby="email" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_email" onClick="displayInputField('email')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="email_error_msg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="designation" class="form-label star">Designation</label>
                                            <input type="text" class="form-control" name="designation" id="designation" value="" oninput="validateInput(this)" placeholder="" aria-describedby="">
                                            <span class="error-msg col-md-12" id="designation_error_msg"></span>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="qualification" class="form-label star">Qualification (Highest)</label>
                                            <input type="text" class="form-control" name="qualification" id="qualification" value="" oninput="validateInput(this)" placeholder="" aria-describedby="">
                                            <span class="error-msg col-md-12" id="qualification_error_msg"></span>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <label for="official_address" class="form-label star">Official Address</label>
                                            <textarea class="form-control" name="official_address" id="official_address" oninput="validateInput(this)" cols="80" rows="1" placeholder=""></textarea>
                                            <span class="error-msg col-md-12" id="official_address_error_msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="specialisation" class="form-label">Specialisation(if any)</label>
                                            <textarea class="form-control" name="specialisation" id="specialisation" oninput="validateInput(this)" cols="80" rows="3" placeholder=""></textarea>
                                            <span class="error-msg col-md-12" id="specialisation_error_msg"></span>
                                        </div>
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
                                </div>
                                <div class="forms">
                                    <div class="row">
                                        <h3 class="mb-5">Institution Details</h3>
                                        <h3>Name and complete address of the Institution where the project will be carried out</h3>
                                        <!-- <p class="mb-4">if more than one institute is involved please provide institutes of co-PI(s) separately</p> -->
                                        <div class="col-md-4 mb-4">
                                            <label for="institute_name_1" class="form-label star">Name of the Institute</label>
                                            <input type="text" class="form-control" id="institute_name_1" name="institute_name[]" value="" oninput="validateInput(this)" placeholder="Enter the full name of the Institute" aria-describedby="name of the Institute">
                                            <span class="error-msg col-md-12" id="institute_name_1_error_msg"></span>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <label for="institute_address_1" class="form-label star">Institute Address</label>
                                            <div class="input-group mb-3">        
                                                <textarea class="form-control" name="institute_address[]" id="institute_address_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Institute Address"></textarea>
                                                <span class="error-msg col-md-12" id="institute_address_1_error_msg"></span>
                                            </div>
                                        </div>
                                        <!-- Add more fields -->
                                        <!-- <div class="input_fields_wrap_institute_details"></div>   
                                        <button type="button" class="btn link_btn add_field_button_inst_add" style="text-align: inherit;">+ Add more institutions (if any)</button> -->
                                    </div>
                                </div>
                                <div class="forms">
                                    <div class="row">
                                        <h3 class="mb-5">The amount proposed for the project</h3>
                                        <div class="col-md-4 mb-4">
                                            <label for="proposed_amount" class="form-label star">Proposed Amount</label>
                                            <input type="number" class="form-control" id="proposed_amount" name="proposed_amount" value="0" oninput="validateInput(this)" placeholder="₹ 0 0 0 0" aria-describedby="number" readonly>
                                            <span class="error-msg col-md-12" id="proposed_amount_error_msg"></span>
                                        </div>
                                        <p>NOTE : This will be automatically calculated once we receive the budget details provided in Section C</p>
                                    </div>
                                </div>
                                <?php showNavigationButton(3,'',0,1,1); ?>
                            </div>
                            <div id="form_1" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Basic details of the proposal</h3>
                                        <div class="col-md-12 mb-4">
                                            <label for="proposal_title" class="form-label star">Title of the proposal</label>
                                            <!-- <input type="text" class="form-control" name="proposal_title" id="proposal_title" oninput="validateInput(this)" value="" placeholder="Enter Proposal title" aria-describedby=""> -->
                                            <!-- onkeyup="validateWordCount('proposal_title','200')"  -->
                                            <textarea class="form-control input" name="proposal_title" id="proposal_title" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter Proposal title"></textarea>
                                            <span id="proposal_title_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="broad_discipline" class="form-label star">Broad discipline</label>
                                            <!-- <input type="text" class="form-control" name="broad_discipline" id="broad_discipline" oninput="validateInput(this)" value="" placeholder="Enter board discipline" aria-describedby=""> -->
                                            <!-- onkeyup="validateWordCount('broad_discipline','200')"  -->
                                            <textarea class="form-control input" name="broad_discipline" id="broad_discipline" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter board discipline"></textarea>
                                            <span id="broad_discipline_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="proposal_summary" class="form-label star">Summary of the research proposal </label>
                                            <p>Not more than 200 words</p>
                                            <textarea class="form-control input" name="proposal_summary" id="proposal_summary" oninput="validateInput(this)" onkeyup="validateWordCount('proposal_summary','200')" cols="80" rows="4" placeholder="Write a summary of your research proposal"></textarea>
                                            Total word Count : <span id="proposal_summary_display_count">0</span> / 200 words. <span id="proposal_summary_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="objectives" class="form-label star">Objectives</label>
                                            <p>Not more than 100 words, in Bullet points</p>
                                            <textarea class="form-control" name="objectives" id="objectives" oninput="validateInput(this)" onkeyup="validateWordCount('objectives','100')" cols="80" rows="3" placeholder="Write the objectives of your research proposal"></textarea>
                                            Total word Count : <span id="objectives_display_count">0</span> / 100 words. <span id="objectives_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="expected_outcome" class="form-label star">Expected outcome</label>
                                            <p>Not more than 100 words</p>
                                            <textarea class="form-control" name="expected_outcome" id="expected_outcome" oninput="validateInput(this)" onkeyup="validateWordCount('expected_outcome','100')" cols="80" rows="4" placeholder="Write the expected outcome of your research proposal"></textarea>
                                            Total word Count : <span id="expected_outcome_display_count">0</span> / 100 words. <span id="expected_outcome_error_msg" class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,0,1,1,2); ?>
                            </div>
                            <div id="form_2" class="tabcontent inner-forms">
                                <div class="forms">
                                    <div class="row">
                                        <h3 class="mb-5">Background Information</h3>
                                        <div class="col-md-12 mb-4">
                                            <label for="proposal_background" class="form-label star">Background and Rationale of the Proposal</label>
                                            <p>Please elaborate on the background and rationale for proposing this work</p>
                                            <textarea class="form-control" name="proposal_background" id="proposal_background" oninput="validateInput(this)" onkeyup="validateWordCount('proposal_background','300')" cols="80" rows="3" placeholder="Write a brief about the background and rationale of the proposal"></textarea>
                                            Total word Count : <span id="proposal_background_display_count">0</span> / 300 words. <span id="proposal_background_error_msg" class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="forms">
                                    <div class="row">
                                        <h3 class="mb-5">Review of literature in the proposed area</h3>
                                        <div class="col-md-12 mb-4">
                                            <label for="international_status" class="form-label star">International Status</label>
                                            <p>The relevant literature, including the latest and their contributions to be highlighted</p>
                                            <textarea class="form-control" name="international_status" id="international_status" oninput="validateInput(this)" onkeyup="validateWordCount('international_status','500')" cols="80" rows="4" placeholder="Write a brief about the international status"></textarea>
                                            Total word Count : <span id="international_status_display_count">0</span> / 500 words. <span id="international_status_error_msg" class="error-msg"></span>
                                        </div> 
                                        <div class="col-md-12 mb-4">
                                            <label for="national_status" class="form-label star">National Status</label>
                                            <p>The relevant literature from India and their contributions to be highlighted</p>
                                            <textarea class="form-control" name="national_status" id="national_status" oninput="validateInput(this)" rows="5" onkeyup="validateWordCount('national_status','500')" placeholder="Write a brief about national status"></textarea>
                                            Total word Count : <span id="national_status_display_count">0</span> / 500 words. <span id="national_status_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="local_status" class="form-label">Local status (if it is a locally relevant proposal)</label>
                                            <p>The relevant literature and their contributions to be highlighted</p>
                                            <textarea class="form-control" name="local_status" id="local_status" oninput="validateInput(this)" onkeyup="validateWordCount('local_status','300')" cols="80" rows="2" placeholder="Write a brief about the local status"></textarea>
                                            Total word Count : <span id="local_status_display_count">0</span> / 300 words. <span id="local_status_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="proposal_significance" class="form-label star">Significance of the proposal</label>
                                            <p>The gaps to be filled/ problem to be solved / or hypothesis proposed</p>
                                            <textarea class="form-control" name="proposal_significance" id="proposal_significance" oninput="validateInput(this)" onkeyup="validateWordCount('proposal_significance','200')" cols="80" rows="2" placeholder="Write about the significance of the proposal"></textarea>
                                            Total word Count : <span id="proposal_significance_display_count">0</span> / 200 words. <span id="proposal_significance_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="proposal_objectives" class="form-label star">Objectives</label>
                                            <p>To be given as bullet points/enumerated; objectives must be achievable in the given time frame; maximum 100 words</p>
                                            <textarea class="form-control" name="proposal_objectives" id="proposal_objectives" oninput="validateInput(this)" onkeyup="validateWordCount('proposal_objectives','100')" cols="80" rows="2" placeholder="Write about the objectives of the proposal"></textarea>
                                            Total word Count : <span id="proposal_objectives_display_count">0</span> / 100 words. <span id="proposal_objectives_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="project_location" class="form-label star">Is the project location specific?</label>
                                            <p>If yes, please highlight the reasons for choosing the location/site</p>
                                            <textarea class="form-control" name="project_location" id="project_location" oninput="validateInput(this)" onkeyup="validateWordCount('project_location','200')" cols="80" rows="2" placeholder="If Yes, Highlight the reasons for choosing the location/site"></textarea>
                                            Total word Count : <span id="project_location_display_count">0</span> / 200 words. <span id="project_location_error_msg" class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,1,2,1,3); ?>
                            </div>
                            <div id="form_3" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Work Plan</h3>
                                        <div class="col-md-12 mb-4">
                                            <label for="methodology" class="form-label star">Methodology in detail:</label>
                                            <p>It should explain the general methodology; for each objective, clearly define the methods, <br>
                                                if more than one method is available, give reasons for choosing a particular method. <br>
                                                If the work is focussing on a location, the locational details are also to be given <br>
                                            </p>
                                            <textarea class="form-control" name="methodology" id="methodology" oninput="validateInput(this)" onkeyup="validateWordCount('methodology','600')" cols="80" rows="6" placeholder="Write a brief about the Methodology"></textarea>
                                            Total word Count : <span id="methodology_display_count">0</span> / 600 words. <span id="methodology_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-4" id="file_methodology_field">
                                            <label for="file_methodology" class="form-label">If there is any additional methodology information involving images can be uploaded here as a single pdf file.</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check col-md-12 col-lg-6" style="padding-left: 0;">
                                                <input type="file" id="file_methodology" name="file_methodology" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_methodology', ''); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-4" id="file_time_schedule_field">
                                            <label for="file_time_schedule" class="form-label star">Provide a Time Schedule of activities</label>
                                            <p>Give a bar diagram or GANTT chart on Quarterly basis <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check col-md-10" style="padding-left: 0;">
                                                <input type="file" id="file_time_schedule" name="file_time_schedule" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_time_schedule', ''); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="action_plan" class="form-label star">Plan of action for utilising research outcome</label>
                                            <p>Maximum 100 words</p>
                                            <textarea class="form-control" name="action_plan" id="action_plan" oninput="validateInput(this)" onkeyup="validateWordCount('action_plan','100')" cols="80" rows="2" placeholder="Write a brief about the Plan of action for utilising research outcome"></textarea>
                                            Total word Count : <span id="action_plan_display_count">0</span> / 100 words. <span id="action_plan_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="any_other_details" class="form-label">Any other details ?</label>
                                            <p>Such as specific permissions for carrying out the project/safety measures that will be taken / ethical guidelines that will be followed / prior informed consent that will be obtained, should be highlighted</p>
                                            <textarea class="form-control" name="any_other_details" id="any_other_details" oninput="validateInput(this)" onkeyup="validateWordCount('any_other_details','200')" cols="80" rows="2" placeholder="Write in brief if any"></textarea>
                                            Total word Count : <span id="any_other_details_display_count">0</span> / 200 words. <span id="any_other_details_error_msg" class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,2,3,1,4); ?>
                            </div>
                            <div id="form_4" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Expertise</h3>
                                        <div class="col-md-12 mb-4">
                                            <label for="specific_expertise_of_pi" class="form-label star">Highlight the specific expertise available with the PI for executing the project</label>
                                            <p>This is an essential component; the expertise should match the proposal</p>
                                            <textarea class="form-control" name="specific_expertise_of_pi" id="specific_expertise_of_pi" oninput="validateInput(this)" onkeyup="validateWordCount('specific_expertise_of_pi','100')" cols="80" rows="2" placeholder="Highlight the specific expertise"></textarea>
                                            Total word Count : <span id="specific_expertise_of_pi_display_count">0</span> / 100 words. <span id="specific_expertise_of_pi_error_msg" class="error-msg"></span>
                                        </div>
                                        <div class="col-md-12 table-responsive mb-4">
                                            <label class="star">Important publications by the Investigator related to the theme of the proposal during the last 5 years</label>
                                            <p>Give the list of relevant publications only </p>
                                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_invest_publication">
                                                <thead class="table-light">
                                                    <th>Sr. No.</th>
                                                    <th>Publications</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="wrapper_row">
                                                        <td class="serial-number text-center">1</td>
                                                        <td>
                                                            <textarea class="form-control" name="investigator_publication[]" id="investigator_publication_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter publications"></textarea>
                                                            <span id="investigator_publication_1_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                        <td width="62px">
                                                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- Add more fields -->
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn link_btn add_field_button_invest_publication" style="text-align: inherit;">+ Add Publication</button>
                                        </div>
                                        <!-- <div class="col-md-12 mb-4">
                                            <label for="bibliography" class="form-label star">Bibliography</label>
                                            <p>Please provide all the references cited in the proposal</p>
                                            <textarea class="form-control" name="bibliography" id="bibliography" oninput="validateInput(this)" cols="80" rows="2" placeholder="Please provide the references"></textarea>
                                            <span id="bibliography_error_msg" class="error-msg"></span>
                                        </div> -->
                                        <div class="col-md-12 table-responsive">
                                            <label class="star">Bibliography</label>
                                            <p>Please provide all the references cited in the proposal</p>
                                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_bibliography">
                                                <thead class="table-light">
                                                    <th>Sr. No.</th>
                                                    <th>Bibliography</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="wrapper_row">
                                                        <td class="serial-number text-center">1</td>
                                                        <td>
                                                            <textarea class="form-control" name="bibliography[]" id="bibliography_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Please provide the references"></textarea>
                                                            <span id="bibliography_1_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                        <td width="62px">
                                                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- Add more fields -->
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn link_btn add_field_button_bibliography" style="text-align: inherit;">+ Add Bibliography</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php showNavigationButton(0,3,4,1,5); ?>
                            </div>
                            <div id="form_5" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3>List of Projects submitted/implemented by the Investigators</h3>
                                        <p class="mb-5">Note : Write NIL or NA in Title field if not applicable</p>
                                        <div class="col-md-12 table-responsive mb-5">
                                            <label class="star">Details of Project proposals Submitted to various funding agencies</label>
                                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_projectDetailsSubmitted">
                                                <thead class="table-light">
                                                    <th>Sr. No.</th>
                                                    <th>Title</th>
                                                    <th>Cost in Lakhs</th>
                                                    <th>Month of submission</th>
                                                    <th>Role as PI/Co-PI</th>
                                                    <th>Agency</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="wrapper_row">
                                                        <td class="serial-number text-center">1</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_project_title[]" id="investigators_project_title_1" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('1',this, 'investigators_project')" placeholder="" aria-describedby="Project title">
                                                            <span class="error-msg col-md-12" id="investigators_project_title_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="investigators_project_cost[]" id="investigators_project_cost_1" value="" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                                            <span class="error-msg col-md-12" id="investigators_project_cost_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="month" class="form-control" name="investigators_project_submission_month[]" id="investigators_project_submission_month_1" value="" oninput="validateInput(this)" placeholder="Month" aria-describedby="Submission month">
                                                            <span class="error-msg col-md-12" id="investigators_project_submission_month_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_project_role[]" id="investigators_project_role_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                                            <span class="error-msg col-md-12" id="investigators_project_role_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_project_agency[]" id="investigators_project_agency_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                                            <span class="error-msg col-md-12" id="investigators_project_agency_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_project_status[]" id="investigators_project_status_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project Status">
                                                            <span class="error-msg col-md-12" id="investigators_project_status_1_error_msg"></span>
                                                        </td>
                                                        <td width="62px">
                                                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- Add more fields -->
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn link_btn add_field_button_projectDetailsSubmitted" style="text-align: inherit;">+ Add project</button>
                                        </div>

                                        <div class="col-md-12 table-responsive mb-5">
                                            <label class="star">Details of Ongoing Projects</label>
                                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_projectDetailsOngoing">
                                                <thead class="table-light">
                                                    <th>Sr. No.</th>
                                                    <th>Title</th>
                                                    <th>Cost in Lakhs</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Role as PI/Co-PI</th>
                                                    <th>Agency</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="wrapper_row">
                                                        <td class="serial-number text-center">1</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_ongoing_project_title[]" id="investigators_ongoing_project_title_1" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('1',this,'investigators_ongoing_project')" placeholder="" aria-describedby="Project title">
                                                            <span class="error-msg col-md-12" id="investigators_ongoing_project_title_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="investigators_ongoing_project_cost[]" id="investigators_ongoing_project_cost_1" value="" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                                            <span class="error-msg col-md-12" id="investigators_ongoing_project_cost_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="date" class="form-control" name="investigators_ongoing_project_start_date[]" id="investigators_ongoing_project_start_date_1" value="" oninput="validateInput(this)" onchange="validateDate(this,1, 'investigators_ongoing_project_');" placeholder="" aria-describedby="start date">
                                                            <span class="error-msg col-md-12" id="investigators_ongoing_project_start_date_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="date" class="form-control" name="investigators_ongoing_project_end_date[]" id="investigators_ongoing_project_end_date_1" value="" oninput="validateInput(this)" onchange="validateDate(this,1, 'investigators_ongoing_project_');" placeholder="" aria-describedby="End Date">
                                                            <span class="error-msg col-md-12" id="investigators_ongoing_project_end_date_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_ongoing_project_role[]" id="investigators_ongoing_project_role_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                                            <span class="error-msg col-md-12" id="investigators_ongoing_project_role_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_ongoing_project_agency[]" id="investigators_ongoing_project_agency_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                                            <span class="error-msg col-md-12" id="investigators_ongoing_project_agency_1_error_msg"></span>
                                                        </td>
                                                        <td width="62px">
                                                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- Add more fields -->
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn link_btn add_field_button_projectDetailsOngoing" style="text-align: inherit;">+ Add project</button>
                                        </div>
                                        <div class="col-md-12 table-responsive">
                                            <label class="star">Completed Projects</label>
                                            <p>Please provide full details of projects completed during the last 5 years</p>
                                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_projectDetailsCompleted">
                                                <thead class="table-light">
                                                    <th>Sr. No.</th>
                                                    <th>Title</th>
                                                    <th>Cost in Lakhs</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Role as PI/Co-PI</th>
                                                    <th>Agency</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="wrapper_row">
                                                        <td class="serial-number text-center">1</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_completed_project_title[]" id="investigators_completed_project_title_1" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('1',this,'investigators_completed_project')" placeholder="" aria-describedby="Project title">
                                                            <span class="error-msg col-md-12" id="investigators_completed_project_title_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="investigators_completed_project_cost[]" id="investigators_completed_project_cost_1" value="" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                                            <span class="error-msg col-md-12" id="investigators_completed_project_cost_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="date" class="form-control" name="investigators_completed_project_start_date[]" id="investigators_completed_project_start_date_1" value="" oninput="validateInput(this)" onchange="validateDate(this,1, 'investigators_completed_project_');" placeholder="" aria-describedby="start date">
                                                            <span class="error-msg col-md-12" id="investigators_completed_project_start_date_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="date" class="form-control" name="investigators_completed_project_end_date[]" id="investigators_completed_project_end_date_1" value="" oninput="validateInput(this)" onchange="validateDate(this,1, 'investigators_completed_project_');" placeholder="" aria-describedby="End Date">
                                                            <span class="error-msg col-md-12" id="investigators_completed_project_end_date_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_completed_project_role[]" id="investigators_completed_project_role_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                                            <span class="error-msg col-md-12" id="investigators_completed_project_role_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="investigators_completed_project_agency[]" id="investigators_completed_project_agency_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                                            <span class="error-msg col-md-12" id="investigators_completed_project_agency_1_error_msg"></span>
                                                        </td>
                                                        <td width="62px">
                                                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- Add more fields -->
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn link_btn add_field_button_projectDetailsCompleted" style="text-align: inherit;">+ Add Project</button>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,4,5,1,6); ?>
                            </div>
                            
                            <div id="form_6" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3>Facilities are required for the project and extended by parent institution(s) for implementation.</h3>
                                        <p class="mb-5">Note : Write NIL or NA in Facilities/Generic name of Equipment field if not applicable</p>
                                        <div class="col-md-12 mb-4">
                                            <label class="star">Infrastructural Facilities, including administrative help</label>
                                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_facilityDetailsInfra">
                                                <thead class="table-light">
                                                    <th>Sr. No.</th>
                                                    <th>Facilities</th>
                                                    <th>Yes/No</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="wrapper_row">
                                                        <td class="serial-number text-center">1</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="projects_impl_infra_facility[]" id="projects_impl_infra_facility_1" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('1',this,'projects_impl_infra_facility')" placeholder="Facilities" aria-describedby="Facilities">
                                                            <span class="error-msg col-md-12" id="projects_impl_infra_facility_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control" name="is_projects_impl_infra_facility[]" id="is_projects_impl_infra_facility_1" placeholder="Yes / No(if not applicable)" aria-describedby="">
                                                                    <option value="">Select Facilities Status</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                                <span class="error-msg col-md-12" id="is_projects_impl_infra_facility_1_error_msg"></span>
                                                            </div>
                                                        </td>
                                                        <td width="62px">
                                                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- Add more fields -->
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn link_btn add_field_button_facilityDetailsInfra" style="text-align: inherit;">+ Add Facility</button>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label class="star">Equipment available with the Institute/ Group/ Department/Other Institutes for the project</label>
                                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_facilityDetailsEquipment">
                                                <thead class="table-light">
                                                    <th>Equipment available with</th>
                                                    <th>Generic name of Equipment </th>
                                                    <th>Model, Make & year of purchase</th>
                                                    <th>Remarks including accessories available and current usage of</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="wrapper_row">
                                                        <th>PI & his group
                                                            <input type="hidden" name="equipment_institute[]" id="equipment_institute_1" value="PI & his group" oninput="validateInput(this)" class="form-control">
                                                            <span class="error-msg col-md-12" id="equipment_institute_1_error_msg"></span>
                                                        </th>
                                                        <td>
                                                            <textarea class="form-control" name="equipment_name[]" id="equipment_name_1" oninput="validateInput(this)" onkeyup="checkInputToNull('1',this,'equipment_name')" cols="80" rows="2" placeholder=""></textarea>
                                                            <span class="error-msg col-md-12" id="equipment_name_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control" name="equipment_model[]" id="equipment_model_1" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                                            <span class="error-msg col-md-12" id="equipment_model_1_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control" name="equipment_remark[]" id="equipment_remark_1" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                                            <span class="error-msg col-md-12" id="equipment_remark_1_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr class="wrapper_row">
                                                        <th>PI's Department
                                                            <input type="hidden" name="equipment_institute[]" id="equipment_institute_2" value="PI's Department" oninput="validateInput(this)" class="form-control">
                                                            <span class="error-msg col-md-12" id="equipment_institute_2_error_msg"></span>
                                                        </th>
                                                        <td>
                                                            <textarea class="form-control" name="equipment_name[]" id="equipment_name_2" oninput="validateInput(this)" onkeyup="checkInputToNull('2',this,'equipment_name')" cols="80" rows="2" placeholder=""></textarea>
                                                            <span class="error-msg col-md-12" id="equipment_name_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control" name="equipment_model[]" id="equipment_model_2" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                                            <span class="error-msg col-md-12" id="equipment_model_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control" name="equipment_remark[]" id="equipment_remark_2" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                                            <span class="error-msg col-md-12" id="equipment_remark_2_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <!-- Add more fields -->
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn link_btn add_field_button_facilityDetailsEquipment" style="text-align: inherit;">+ Add Other Institute(s) in the region</button>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,5,6,1,7); ?>
                            </div>
                            <div id="form_7" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">List of Experts/Institutions </h3>
                                        <h3>Name and address of Experts/Institutions interested in the subject/outcome of the project</h3>
                                        <p>Provide names of at least five experts and/or institutions</p>
                                        
                                        <div class="input_fields_wrap_expertOrInstitution">
                                            <div class="row wrapper_row">
                                                <div class="col-md-1 serial-number text-center content-center text-center-vertical">
                                                    1
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-4">
                                                            <label class="form-label star" for="guide_name_1">Name</label>  
                                                            <input type="text" id="guide_name_1" name="guide_name[]" value="" oninput="validateInput(this)" placeholder="Enter full name" class="form-control">
                                                            <span class="error-msg col-md-12" id="guide_name_1_error_msg"></span>
                                                        </div>
                                                        <div class="form-group col-md-8 mb-4">
                                                            <label class="form-label star" for="guide_address_1">Address</label>  
                                                            <input type="text" id="guide_address_1" name="guide_address[]" value="" oninput="validateInput(this)" placeholder="Enter address" class="form-control">
                                                            <span class="error-msg col-md-12" id="guide_address_1_error_msg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                            </div>
                                        </div><!-- Add more fields -->
                                        <button type="button" class="btn link_btn add_field_button_expertOrInstitution" style="text-align: inherit;">+ Add (if any)</button>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,6,7,1,8); ?>
                            </div>

                            <div id="form_8" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Budget</h3>
                                        <div class="form-group col-md-6 mb-5">
                                            <label class="form-label star" for="budget_consolidated">Consolidated (Grand Total): Rs.</label>  
                                            <input type="number" id="budget_consolidated" name="budget_consolidated" value=""  oninput="validateInput(this)" placeholder="₹ 0" class="form-control" readonly>
                                            <span class="error-msg col-md-12" id="budget_consolidated_error_msg"></span>
                                        </div>
                                        
                                        <div class="col-md-12 mb-5">
                                            <label>Table of contents</label>
                                            <table class="table table-stripped table-bordered border-light edu_details budget_table">
                                                <thead class="table-light">
                                                    <th>Sr. No.</th>
                                                    <th>Item</th>
                                                    <th class="year_field_1">Year 1 (Rs)</th>
                                                    <th class="year_field_2">Year 2 (Rs)</th>
                                                    <th>Total</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>I</td>
                                                        <td>Non-Recurring</td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="hidden" id="year_1_1" name="year_1_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_1_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="hidden" id="year_1_2" name="year_1_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_1_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" id="year_1_total" name="year_1_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_1_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center budget_row_count">1</td>
                                                        <td>Equipment</td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_2_1" name="year_2_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_2_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_2_2" name="year_2_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_2_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_2_total" name="year_2_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_2_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="">
                                                            (a) &nbsp; 
                                                            <input type="text" id="equipment_a" name="equipment_a" value="" oninput="validateInput(this)" placeholder="" class="form-control">
                                                            <span class="error-msg col-md-12" id="equipment_a_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_3_1" name="year_3_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_3_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_3_2" name="year_3_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_3_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_3_total" name="year_3_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_3_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="">
                                                            (b) &nbsp; 
                                                            <input type="text" id="equipment_b" name="equipment_b" value="" oninput="validateInput(this)" placeholder="" class="form-control">
                                                            <span class="error-msg col-md-12" id="equipment_b_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_4_1" name="year_4_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_4_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_4_2" name="year_4_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_4_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_4_total" name="year_4_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_4_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="">
                                                            (c) &nbsp; 
                                                            <input type="text" id="equipment_c" name="equipment_c" value="" oninput="validateInput(this)" placeholder="" class="form-control">
                                                            <span class="error-msg col-md-12" id="equipment_c_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_5_1" name="year_5_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_5_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_5_2" name="year_5_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_5_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_5_total" name="year_5_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_5_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="">
                                                            (d) &nbsp; 
                                                            <input type="text" id="equipment_d" name="equipment_d" value="" oninput="validateInput(this)" placeholder="" class="form-control">
                                                            <span class="error-msg col-md-12" id="equipment_d_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_6_1" name="year_6_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_6_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_6_2" name="year_6_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_6_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_6_total" name="year_6_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_6_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="">
                                                            (e) &nbsp; 
                                                            <input type="text" id="equipment_e" name="equipment_e" value="" oninput="validateInput(this)" placeholder="" class="form-control">
                                                            <span class="error-msg col-md-12" id="equipment_e_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_7_1" name="year_7_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_7_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_7_2" name="year_7_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_7_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_7_total" name="year_7_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_7_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr class="books_journals_row">
                                                        <td class="text-center budget_row_count">2</td>
                                                        <td>Books and Journals</td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_8_1" name="year_8_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_8_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_8_2" name="year_8_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_8_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_8_total" name="year_8_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_8_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-light" style="border: inherit;">
                                                        <td></td>
                                                        <td>TOTAL</td>
                                                        <td class="year_field_1 non_recurring">
                                                            <input type="number" id="year_9_1" name="year_9_1" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_9_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2 non_recurring">
                                                            <input type="number" id="year_9_2" name="year_9_2" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_9_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_9_total" name="year_9_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_9_total_error_msg"></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>II</td>
                                                        <td>Recurring</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center budget_row_count">3</td>
                                                        <td>Hiring services # </td>
                                                        <td class="year_field_1">
                                                            <input type="number" id="year_10_1" name="year_10_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_10_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2">
                                                            <input type="number" id="year_10_2" name="year_10_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_10_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_10_total" name="year_10_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_10_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center budget_row_count">4</td>
                                                        <td>Contingency</td>
                                                        <td class="year_field_1">
                                                            <input type="number" id="year_11_1" name="year_11_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_11_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2">
                                                            <input type="number" id="year_11_2" name="year_11_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_11_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_11_total" name="year_11_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_11_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center budget_row_count">5</td>
                                                        <td>Chemicals and consumables</td>
                                                        <td class="year_field_1">
                                                            <input type="number" id="year_12_1" name="year_12_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_12_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2">
                                                            <input type="number" id="year_12_2" name="year_12_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_12_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_12_total" name="year_12_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_12_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center budget_row_count">6</td>
                                                        <td>Travel and/or Field Work</td>
                                                        <td class="year_field_1">
                                                            <input type="number" id="year_13_1" name="year_13_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_13_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2">
                                                            <input type="number" id="year_13_2" name="year_13_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_13_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_13_total" name="year_13_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_13_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center budget_row_count">7</td>
                                                        <td>Special Needs (if any) </td>
                                                        <td class="year_field_1">
                                                            <input type="number" id="year_14_1" name="year_14_1" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_14_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2">
                                                            <input type="number" id="year_14_2" name="year_14_2" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudgetForMinMaj(this)" placeholder="₹ 0" class="form-control text-end">
                                                            <span class="error-msg col-md-12" id="year_14_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_14_total" name="year_14_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_14_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-light" style="border: inherit;">
                                                        <td></td>
                                                        <td>TOTAL</td>
                                                        <td class="year_field_1">
                                                            <input type="number" id="year_15_1" name="year_15_1" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_15_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2">
                                                            <input type="number" id="year_15_2" name="year_15_2" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_15_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_15_total" name="year_15_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_15_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-light" style="border: inherit;">
                                                        <td></td>
                                                        <td>Grand TOTAL</td>
                                                        <td class="year_field_1">
                                                            <input type="number" id="year_16_1" name="year_16_1" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_16_1_error_msg"></span>
                                                        </td>
                                                        <td class="year_field_2">
                                                            <input type="number" id="year_16_2" name="year_16_2" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_16_2_error_msg"></span>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="year_16_total" name="year_16_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0" class="form-control text-end" readonly>
                                                            <span class="error-msg col-md-12" id="year_16_total_error_msg"></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="">NOTE : Please consult the scheme for the details #</p>
                                        </div>
                                        
                                        <div class="row mb-5">
                                            <h3 class="">Budget Components Details</h3>
                                            <label for="budget_components_details" class="form-label star">Please justify each of the budget components by specifying the serial number given in the table</label>
                                            <p>Budget without proper justification may lead to rejection of the application</p>
                                            <p class="d-none">If more than one institution is involved, please provide institution-wise budget details in addition to the above.</p>
                                            
                                            <div class="input_fields_wrap_budget_components_details">
                                                <div class="row wrapper_row">
                                                    <div class="col-md-1 serial-number text-center content-center text-center-vertical">1</div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="form-group col-md-5">
                                                                <label for="budget_components_item_1" class="form-label fw6 star">Item Name</label>
                                                                <input type="text" class="form-control" id="budget_components_item_1" name="budget_components_item[]" value="" oninput="validateInput(this)" placeholder="Enter Item name" aria-describedby="name of the Item">
                                                                <span class="error-msg col-md-12" id="budget_components_item_1_error_msg"></span>
                                                            </div>
                                                            <div class="form-group col-md-7">
                                                                <label for="budget_components_justification_1" class="form-label fw6 star">Justification</label>
                                                                <div class="input-group mb-3">        
                                                                    <textarea class="form-control" name="budget_components_justification[]" id="budget_components_justification_1" oninput="validateInput(this)" cols="80" rows="2" placeholder="Budget Description"></textarea>
                                                                    <span class="error-msg col-md-12" id="budget_components_justification_1_error_msg"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                </div>


                                            </div>   <!-- Add more fields -->
                                            <button type="button" class="btn link_btn add_field_button_budget_components_details" style="text-align: inherit;">+ Add more budget components (if any)</button>
                                            <!-- <textarea class="form-control" name="budget_components_details" id="budget_components_details" oninput="validateInput(this)" cols="80" rows="9" placeholder="Please provide the references"></textarea>
                                            <span id="budget_components_details_error_msg" class="error-msg"></span> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label for="budget_project_relevance" class="form-label star">If the project has social /local relevance, please highlight</label>
                                            <p>Not more than 100 words</p>
                                            <textarea class="form-control" name="budget_project_relevance" id="budget_project_relevance" oninput="validateInput(this)" onkeyup="validateWordCount('budget_project_relevance','100')" cols="80" rows="2" placeholder="Please highlight project relevance"></textarea>
                                            Total word Count : <span id="budget_project_relevance_display_count">0</span> / 100 words. <span id="budget_project_relevance_error_msg" class="error-msg"></span>
                                        </div>

                                    </div>
                                </div>
                                <?php showNavigationButton(0,7,8,1,9); ?>
                            </div>

                            <div id="form_9" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Certificates</h3>

                                        <div class="col-md-12 col-lg-6  mb-5">
                                            <label for="is_pi_belong_to_category" class="form-label">Do you (PI) belong to EWS/OBC/SC/ST category?</label>
                                            <br>
                                            <div class="form-check d-inline-block pt-1 ">
                                                <input class="form-check-input" type="radio" name="is_pi_belong_to_category" id="is_pi_belong_to_category_1" value="1">
                                                <label class="form-check-label" for="is_pi_belong_to_category_1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check d-inline-block pt-1 ">
                                                <input class="form-check-input" type="radio" name="is_pi_belong_to_category" id="is_pi_belong_to_category_0" value="0" checked="true">
                                                <label class="form-check-label" for="is_pi_belong_to_category_0">
                                                    No
                                                </label>
                                            </div>
                                            <span class="d-none" id="file_category_certificate_field">
                                                <label for="file_category_certificate" class="form-label fw6"></label>
                                                <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                                <div class="form-check" style="padding-left: 0;">
                                                    <input type="file" id="file_category_certificate" name="file_category_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                    <?php showProgressBar('docs','file_category_certificate', ''); ?>
                                                </div>
                                            </span>
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-5">
                                            <label for="is_pi_differently_abled" class="form-label">Are you (PI/Co-PI) Differently Abled?</label>
                                            <br>
                                            <div class="form-check d-inline-block pt-1 ">
                                                <input class="form-check-input" type="radio" name="is_pi_differently_abled" id="is_pi_differently_abled_1" value="1">
                                                <label class="form-check-label" for="is_pi_differently_abled_1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check d-inline-block pt-1 ">
                                                <input class="form-check-input" type="radio" name="is_pi_differently_abled" id="is_pi_differently_abled_0" value="0" checked="true">
                                                <label class="form-check-label" for="is_pi_differently_abled_0">
                                                    No
                                                </label>
                                            </div>
                                            <span class="d-none" id="file_pi_diff_abled_certificate_field">
                                                <label for="file_pi_diff_abled_certificate" class="form-label fw6"></label>
                                                <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                                <div class="form-check" style="padding-left: 0;">
                                                    <input type="file" id="file_pi_diff_abled_certificate" name="file_pi_diff_abled_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                    <?php showProgressBar('docs','file_pi_diff_abled_certificate', ''); ?>
                                                </div>
                                            </span>
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-5" id="file_pi_certification_field">
                                            <label for="file_pi_certification" class="form-label star">Certification from PI</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check" style="padding-left: 0;">
                                                <input type="file" id="file_pi_certification" name="file_pi_certification" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_pi_certification', ''); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-5" id="file_aadhar_card_field">
                                            <label for="file_aadhar_card" class="form-label star">Aadhar Card of the PI <span>(Self Attested)</span></label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check" style="padding-left: 0;">
                                                <input type="file" id="file_aadhar_card" name="file_aadhar_card" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_aadhar_card', ''); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-8 mb-5" id="file_principal_endorsement_certificate_field">
                                            <label for="file_principal_endorsement_certificate" class="form-label star">Endorsement from the Principal/Registrar/Head of the Institution</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check col-lg-9" style="padding-left: 0;">
                                                <input type="file" id="file_principal_endorsement_certificate" name="file_principal_endorsement_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_principal_endorsement_certificate', ''); ?>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="col-md-12 col-lg-6 mb-5" id="file_registrar_endorsement_certificate_field">
                                            <label for="file_registrar_endorsement_certificate" class="form-label star">Endorsement from the Registrar of the Institution</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check" style="padding-left: 0;">
                                                <input type="file" id="file_registrar_endorsement_certificate" name="file_registrar_endorsement_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_registrar_endorsement_certificate', ''); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-8 mb-5" id="file_head_inst_endorsement_certificate_field">
                                            <label for="file_head_inst_endorsement_certificate" class="form-label star">Endorsement from the Head of the Institution</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check col-lg-9" style="padding-left: 0;">
                                                <input type="file" id="file_head_inst_endorsement_certificate" name="file_head_inst_endorsement_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_head_inst_endorsement_certificate', ''); ?>
                                            </div>
                                        </div> -->
                                        
                                        <div class="col-md-12 col-lg-6 mb-5">
                                            <label for="is_pi_non_phd" class="form-label">Are you a non-Ph.D. but a registered PhD student?</label>
                                            <p>If yes, then please upload bona fide certificate</p>
                                            <div class="form-check d-inline-block pt-1 ">
                                                <input class="form-check-input" type="radio" name="is_pi_non_phd" id="is_pi_non_phd_1" value="1">
                                                <label class="form-check-label" for="is_pi_non_phd_1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check d-inline-block pt-1 ">
                                                <input class="form-check-input" type="radio" name="is_pi_non_phd" id="is_pi_non_phd_0" value="0" checked="true">
                                                <label class="form-check-label" for="is_pi_non_phd_0">
                                                    No
                                                </label>
                                            </div>
                                            <div class="d-none" id="file_pi_bona_fide_certificate_field">
                                                <label for="file_pi_bona_fide_certificate" class="form-label fw6">Bona fide certificate</label>
                                                <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                                <div class="form-check" style="padding-left: 0;">
                                                    <input type="file" id="file_pi_bona_fide_certificate" name="file_pi_bona_fide_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                    <?php showProgressBar('docs','file_pi_bona_fide_certificate', ''); ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 col-lg-6 mb-5" id="file_pi_cv_field">
                                            <label for="file_pi_cv" class="form-label star">Please upload CV </label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check" style="padding-left: 0;">
                                                <input type="file" id="file_pi_cv" name="file_pi_cv" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_pi_cv', ''); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php include 'layout/note-before-file-submission.php'; ?>
                                </div>
                                <?php showNavigationButton(0,8,9,'',''); ?>
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
    let schemeBatchId = "<?php echo $minorGrantsRequiredDocs["scheme_batch_id"] ?>";
    let form_no_saved = 0;

    let is_not_applicable = temp_empty_val = '', tempIdKey = 0;

    let first_name=middle_name=last_name=dob=country_code=phone_no=email=designation=qualification=official_address=
        specialisation=proposed_amount=file_profile_picture='';
    let gender=co_inv_i_gender=co_inv_ii_gender="male";
    let institute_names = document.getElementsByName("institute_name[]");
    let institute_address = document.getElementsByName("institute_address[]");
    
    let proposal_title=broad_discipline=proposal_summary=objectives=expected_outcome='';
    let proposal_background=international_status=national_status=local_status =proposal_significance =proposal_objectives=project_location="";
    let methodology=file_methodology=file_time_schedule= action_plan= any_other_details=""; 
    
    let specific_expertise_of_pi = '';
    let bibliographies = document.getElementsByName("bibliography[]");
    let investigator_publications = document.getElementsByName("investigator_publication[]");

    let investigators_project_titles = document.getElementsByName("investigators_project_title[]");
    let investigators_project_costs = document.getElementsByName("investigators_project_cost[]");
    let investigators_project_submission_months = document.getElementsByName("investigators_project_submission_month[]");
    let investigators_project_roles = document.getElementsByName("investigators_project_role[]");
    let investigators_project_agencies = document.getElementsByName("investigators_project_agency[]");
    let investigators_project_statuses = document.getElementsByName("investigators_project_status[]");

    let investigators_ongoing_project_titles = document.getElementsByName("investigators_ongoing_project_title[]");
    let investigators_ongoing_project_costs = document.getElementsByName("investigators_ongoing_project_cost[]");
    let investigators_ongoing_project_start_dates = document.getElementsByName("investigators_ongoing_project_start_date[]");
    let investigators_ongoing_project_end_dates = document.getElementsByName("investigators_ongoing_project_end_date[]");
    let investigators_ongoing_project_roles = document.getElementsByName("investigators_ongoing_project_role[]");
    let investigators_ongoing_project_agencies = document.getElementsByName("investigators_ongoing_project_agency[]");
    
    let investigators_completed_project_titles = document.getElementsByName("investigators_completed_project_title[]");
    let investigators_completed_project_costs = document.getElementsByName("investigators_completed_project_cost[]");
    let investigators_completed_project_start_dates = document.getElementsByName("investigators_completed_project_start_date[]");
    let investigators_completed_project_end_dates = document.getElementsByName("investigators_completed_project_end_date[]");
    let investigators_completed_project_roles = document.getElementsByName("investigators_completed_project_role[]");
    let investigators_completed_project_agencies = document.getElementsByName("investigators_completed_project_agency[]");

    let projects_impl_infra_facilities = document.getElementsByName("projects_impl_infra_facility[]");
    let is_projects_impl_infra_facilities = document.getElementsByName("is_projects_impl_infra_facility[]");
    let isInfrastructuralFacilityYes = isInfrastructuralFacilityNo = "";

    let equipment_institutes = document.getElementsByName("equipment_institute[]");
    let equipment_names = document.getElementsByName("equipment_name[]");
    let equipment_models = document.getElementsByName("equipment_model[]");
    let equipment_remarks = document.getElementsByName("equipment_remark[]");

    let expert_guide_names = document.getElementsByName("guide_name[]");
    let expert_guide_address = document.getElementsByName("guide_address[]");

    let budget_consolidated =budget_project_relevance=
        year_1_1 = year_1_2 = year_1_total = 
        year_2_1 = year_2_2 = year_2_total = 
        year_3_1 = year_3_2 = year_3_total = equipment_a = 
        year_4_1 = year_4_2 = year_4_total = equipment_b =  
        year_5_1 = year_5_2 = year_5_total = equipment_c =  
        year_6_1 = year_6_2 = year_6_total = equipment_d =  
        year_7_1 = year_7_2 = year_7_total = equipment_e =   
        year_8_1 = year_8_2 = year_8_total = 
        year_9_1 = year_9_2 = year_9_total = 
        year_10_1 = year_10_2 = year_10_total = 
        year_11_1 = year_11_2 = year_11_total = 
        year_12_1 = year_12_2 = year_12_total = 
        year_13_1 = year_13_2 = year_13_total = 
        year_14_1 = year_14_2 = year_14_total = 
        year_15_1 = year_15_2 = year_15_total = 
        year_16_1 = year_16_2 = year_16_total = '';
    let budget_components_items = document.getElementsByName("budget_components_item[]");
    let budget_components_justifications = document.getElementsByName("budget_components_justification[]");

    let is_pi_belong_to_category=is_pi_differently_abled=is_pi_non_phd=0;
    let file_category_certificate=
        file_pi_diff_abled_certificate=
        file_pi_certification=file_aadhar_card=
        file_principal_endorsement_certificate=
        // file_registrar_endorsement_certificate=
        // file_head_inst_endorsement_certificate=
        file_pi_cv=
        file_pi_bona_fide_certificate='';
    
    const fileInputProfilePicture = document.getElementById('file_profile_picture');
    const fileInputMethodology = document.getElementById('file_methodology');
    const fileInputTimeSchedule = document.getElementById('file_time_schedule');
    const fileInputPICategory = document.getElementById('file_category_certificate');
    const fileInputPIDiffAbledCertificate = document.getElementById('file_pi_diff_abled_certificate');
    const fileInputPICertification = document.getElementById('file_pi_certification');
    const fileInputPIAadharCard = document.getElementById('file_aadhar_card');
    const fileInputPrincipalEndorseCertificate = document.getElementById('file_principal_endorsement_certificate');
    // const fileInputRegistrarEndorseCertificate = document.getElementById('file_registrar_endorsement_certificate');
    // const fileInputHeadInstEndorseCertificate = document.getElementById('file_head_inst_endorsement_certificate');
    const fileInputBonaFideCertificate= document.getElementById('file_pi_bona_fide_certificate');
    const fileInputPICv = document.getElementById('file_pi_cv');

    let isSavedForm_0 = isSavedForm_1 = isSavedForm_2 = isSavedForm_3 = isSavedForm_4 = isSavedForm_5 = isSavedForm_6 = isSavedForm_7 = isSavedForm_8 = isSavedForm_9 = true; 

    // custom requirement 
    let isFileUploaded = 0;
    isUserApplicableForScheme(scheme_code);

	// add more fields function
	// let max_fields = 8;
	// var wrapper = $(".input_fields_wrap"); 		//Fields wrapper`
	// let add_button = $(".add_field_button"); 	//Add button ID
	// let x = 1;
	let max_fields_budgetComponentsDetails = 10,
        max_fields_bibliography = 
        max_fields_investPublication = 20,
        max_fields_instituteDetails = 
        max_fields_investExpertise = 
        max_fields_projectDetailsSubmitted = 
        max_fields_projectDetailsOngoing = 
        max_fields_projectDetailsCompleted = 
        max_fields_facilityDetailsInfra = 
        max_fields_facilityDetailsEquipment = 
        max_fields_expertOrInstitution = 
        20;
    let x_bibliography = 
        x_budgetComponentsDetails = 
        x_instituteDetails = 
        x_investPublication = 
        x_projectDetailsSubmitted = 
        x_projectDetailsOngoing = 
        x_projectDetailsCompleted = 
        x_facilityDetailsInfra = 
        x_expertOrInstitution = 
        1;
    let x_facilityDetailsEquipment = 2;
	var wrapper_instituteDetails = $(".input_fields_wrap_institute_details");     // Fields wrapper
	let add_button_instituteDetails = $(".add_field_button_inst_add"); 	// Add button ID
	var wrapper_bibliography = $(".input_fields_wrap_bibliography > tbody");     // Fields wrapper
	let add_button_bibliography = $(".add_field_button_bibliography"); 	// Add button ID
	var wrapper_investPublication = $(".input_fields_wrap_invest_publication > tbody");     // Fields wrapper
	let add_button_investPublication = $(".add_field_button_invest_publication"); 	// Add button ID
	var wrapper_projectDetailsSubmitted = $(".input_fields_wrap_projectDetailsSubmitted > tbody");     // Fields wrapper
	let add_button_projectDetailsSubmitted = $(".add_field_button_projectDetailsSubmitted"); 	// Add button ID
	var wrapper_projectDetailsOngoing = $(".input_fields_wrap_projectDetailsOngoing > tbody");     // Fields wrapper
	let add_button_projectDetailsOngoing = $(".add_field_button_projectDetailsOngoing"); 	// Add button ID
	var wrapper_projectDetailsCompleted = $(".input_fields_wrap_projectDetailsCompleted > tbody");     // Fields wrapper
	let add_button_projectDetailsCompleted = $(".add_field_button_projectDetailsCompleted"); 	// Add button ID
	var wrapper_facilityDetailsInfra = $(".input_fields_wrap_facilityDetailsInfra > tbody");     // Fields wrapper
	let add_button_facilityDetailsInfra = $(".add_field_button_facilityDetailsInfra"); 	// Add button ID
	var wrapper_facilityDetailsEquipment = $(".input_fields_wrap_facilityDetailsEquipment > tbody");     // Fields wrapper
	let add_button_facilityDetailsEquipment = $(".add_field_button_facilityDetailsEquipment"); 	// Add button ID
    var wrapper_expertOrInstitution = $(".input_fields_wrap_expertOrInstitution");     // Fields wrapper
	let add_button_expertOrInstitution = $(".add_field_button_expertOrInstitution"); 	// Add button ID
    var wrapper_budgetComponentsDetails = $(".input_fields_wrap_budget_components_details");     // Fields wrapper
	let add_button_budgetComponentsDetails = $(".add_field_button_budget_components_details"); 	// Add button ID

    $(document).ready(function() {
        // set max date as Today 
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        document.getElementById('dob').max = today;
        
        // Hide some fields updated on 08/06/2024
        // $(".year_field_2").hide(); 
        document.querySelectorAll('.year_field_2.non_recurring input').forEach(input => {
            input.disabled = true;
        });
        $(".books_journals_row").hide();
        let budget_row_count = 1; // initialize serial number
        let budget_rows = document.querySelectorAll('td.budget_row_count'); // get all cells with class xyz in the row
        if (budget_rows.length > 0) {
            budget_rows.forEach((cell) => {
                if (cell.parentNode.style.display!== 'none') {
                    cell.textContent = budget_row_count; // assign serial number to the cell
                    budget_row_count++; // increment serial number
                }
            });
        }
        // Hide some fields updated on 08/06/2024

        saveData = getSavedData = JSON.parse(localStorage.getItem("minorResearchProjectData"));
        if (getSavedData && getSavedData['id']) {
            form_no_saved = getSavedData['form_no'];
            if (form_no_saved) {
                openNextForm(0, form_no_saved);
            } else {
                $("#form_0").addClass('d-block');
            }
            
            $("#scheme_id").val(getSavedData['id']);

            $("#first_name").val(getSavedData["investigator_details"][0]['first_name']);
            $("#middle_name").val(getSavedData["investigator_details"][0]['middle_name']);
            $("#last_name").val(getSavedData["investigator_details"][0]['last_name']);
            if (getSavedData["investigator_details"][0]['gender']) {
                gender = getSavedData["investigator_details"][0]['gender'];
            }
            $("input:radio[name=gender]").val([gender]);
            $("#dob").val(getSavedData["investigator_details"][0]['dob']);
            $("#country_code").val(getSavedData["investigator_details"][0]['country_code']);
            $("#phone_no").val(getSavedData["investigator_details"][0]['phone_no']);
            $("#email").val(getSavedData["investigator_details"][0]['email']);
            $("#designation").val(getSavedData["investigator_details"][0]['designation']);
            $("#qualification").val(getSavedData["investigator_details"][0]['qualification']);
            $("#official_address").val(getSavedData["investigator_details"][0]['official_address']);
            $("#official_address").val(getSavedData["investigator_details"][0]['official_address']);
            $("#specialisation").val(getSavedData["specialisation"]);
            if (getSavedData['file_profile_picture']) {
                file_profile_picture = getSavedData['file_profile_picture'];
                displayUploadedFile('img', 'file_profile_picture', file_profile_picture);
            }

            $("#proposed_amount").val(getSavedData["proposed_amount"]);
            if ( !getSavedData["institution_details"] || getSavedData["institution_details"] == "null" ) {} else {
                x_instituteDetails = 0;
                getSavedData["institution_details"].forEach(institutionDetail => {
                    if(x_instituteDetails < max_fields_instituteDetails){ 					//max input box allowed
                        x_instituteDetails++; 								//text box increment
                        if (x_instituteDetails==1) {
                            $("#institute_name_1").val(institutionDetail['name']);
                            $("#institute_address_1").val(institutionDetail['address']);
                        } else {
                            $(wrapper_instituteDetails).append(`
                                <div class="row wrapper_row">
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="form-group col-md-5 mb-4">
                                                <label class="form-label fw6" for="institute_name_`+x_instituteDetails+`">Name of the Institute</label>  
                                                <input type="text" id="institute_name_`+x_instituteDetails+`" name="institute_name[]" value="${institutionDetail['name']}" placeholder="Enter name" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="institute_name_`+x_instituteDetails+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-7 mb-4">
                                                <label class="form-label fw6" for="institute_address_`+x_instituteDetails+`">Institute Address</label>  
                                                <textarea class="form-control" name="institute_address[]" id="institute_address_`+x_instituteDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Institute Address">${institutionDetail['address']}</textarea>
                                                <span class="error-msg col-md-12" id="institute_address_`+x_instituteDetails+`_error_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                </div>
                            `); //add input box
                            if (x_instituteDetails == max_fields_instituteDetails) {
                                $(".add_field_button_inst_add").attr("disabled", true);
                            }
                        }
                    }
                });
            }
            $("#proposal_title").val(getSavedData["proposal_title"]);
            $("#broad_discipline").val(getSavedData["broad_discipline"]);
            $("#proposal_summary").val(getSavedData["proposal_summary"]);
            $("#objectives").val(getSavedData["objectives"]);
            $("#expected_outcome").val(getSavedData["expected_outcome"]);
            
            $("#proposal_background").val(getSavedData["proposal_background"]);

            $("#international_status").val(getSavedData["international_status"]);
            $("#national_status").val(getSavedData["national_status"]);
            $("#local_status").val(getSavedData["local_status"]);
            $("#proposal_significance").val(getSavedData["proposal_significance"]);
            $("#proposal_objectives").val(getSavedData["proposal_objectives"]);
            $("#project_location").val(getSavedData["project_location"]);

            $("#methodology").val(getSavedData["methodology"]);
            if (getSavedData["file_methodology"]) {
                file_methodology = getSavedData["file_methodology"];
                displayUploadedFile('docs', 'file_methodology', file_methodology);
            }
            if (getSavedData["file_time_schedule"]) {
                file_time_schedule = getSavedData["file_time_schedule"];
                displayUploadedFile('docs', 'file_time_schedule', file_time_schedule);
            }
            $("#action_plan").val(getSavedData["action_plan"]);
            $("#any_other_details").val(getSavedData["any_other_details"]);

            $("#specific_expertise_of_pi").val(getSavedData["specific_expertise_of_pi"]);
            // $("#bibliography").val(getSavedData["bibliography"]);
            if ( !getSavedData["bibliography_details"] || getSavedData["bibliography_details"] == "null" ) {} else {
                x_bibliography = 0;
                getSavedData["bibliography_details"].forEach(bibliographyDetail => {
                    if(x_bibliography < max_fields_bibliography){ 					//max input box allowed
                        x_bibliography++; 								//text box increment
                        if (x_bibliography==1) {
                            $("#bibliography_1").val(bibliographyDetail['name']);
                        } else {
                            $(wrapper_bibliography).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_bibliography+`</td>
                                    <td>
                                        <textarea class="form-control" name="bibliography[]" id="bibliography_`+x_bibliography+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter bibliography">${bibliographyDetail['name']}</textarea>
                                        <span id="bibliography_`+x_bibliography+`_error_msg" class="error-msg col-md-12"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_bibliography == max_fields_bibliography) {
                                $(".add_field_button_bibliography").attr("disabled", true);
                            }
                        }
                    }
                });
            }
            if ( !getSavedData["investigator_publications_details"] || getSavedData["investigator_publications_details"] == "null" ) {} else {
                x_investPublication = 0;
                getSavedData["investigator_publications_details"].forEach(investigatorPublicationsDetail => {
                    if(x_investPublication < max_fields_investPublication){ 					//max input box allowed
                        x_investPublication++; 								//text box increment
                        if (x_investPublication==1) {
                            $("#investigator_publication_1").val(investigatorPublicationsDetail['name']);
                        } else {
                            $(wrapper_investPublication).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_investPublication+`</td>
                                    <td>
                                        <textarea class="form-control" name="investigator_publication[]" id="investigator_publication_`+x_investPublication+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter publications">${investigatorPublicationsDetail['name']}</textarea>
                                        <span id="investigator_publication_`+x_investPublication+`_error_msg" class="error-msg col-md-12"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_investPublication == max_fields_investPublication) {
                                $(".add_field_button_invest_publication").attr("disabled", true);
                            }
                        }
                    }
                });
            }
            
            if ( !getSavedData["scheme_submitted_project_details"] || getSavedData["scheme_submitted_project_details"] == "null" ) {} else {
                x_projectDetailsSubmitted = 0;
                getSavedData["scheme_submitted_project_details"].forEach(investigatorsSubmittedProject => {
                    if(x_projectDetailsSubmitted < max_fields_projectDetailsSubmitted){ 					//max input box allowed
                        x_projectDetailsSubmitted++; 								//text box increment
                        is_not_applicable = investigatorsSubmittedProject['title'] ? investigatorsSubmittedProject['title'].toUpperCase() : ''; 
                        
                        if (x_projectDetailsSubmitted==1) {
                            $("#investigators_project_title_1").val(investigatorsSubmittedProject['title']);
                            $("#investigators_project_cost_1").val(investigatorsSubmittedProject['cost_in_lakhs']);
                            $("#investigators_project_submission_month_1").val(investigatorsSubmittedProject['submission_month']);
                            $("#investigators_project_role_1").val(investigatorsSubmittedProject['role']);
                            $("#investigators_project_agency_1").val(investigatorsSubmittedProject['agency']);
                            $("#investigators_project_status_1").val(investigatorsSubmittedProject['status']);
                        } else {
                            $(wrapper_projectDetailsSubmitted).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_projectDetailsSubmitted+`</td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_project_title[]" id="investigators_project_title_`+x_projectDetailsSubmitted+`" value="${investigatorsSubmittedProject['title']}" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_projectDetailsSubmitted+`',this,'investigators_project')" placeholder="" aria-describedby="Project title">
                                        <span class="error-msg col-md-12" id="investigators_project_title_`+x_projectDetailsSubmitted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="investigators_project_cost[]" id="investigators_project_cost_`+x_projectDetailsSubmitted+`" value="${investigatorsSubmittedProject['cost_in_lakhs']}" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                        <span class="error-msg col-md-12" id="investigators_project_cost_`+x_projectDetailsSubmitted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="month" class="form-control" name="investigators_project_submission_month[]" id="investigators_project_submission_month_`+x_projectDetailsSubmitted+`" value="${investigatorsSubmittedProject['submission_month']}" oninput="validateInput(this)" placeholder="" aria-describedby="Submission month">
                                        <span class="error-msg col-md-12" id="investigators_project_submission_month_`+x_projectDetailsSubmitted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_project_role[]" id="investigators_project_role_`+x_projectDetailsSubmitted+`" value="${investigatorsSubmittedProject['role']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                        <span class="error-msg col-md-12" id="investigators_project_role_`+x_projectDetailsSubmitted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_project_agency[]" id="investigators_project_agency_`+x_projectDetailsSubmitted+`" value="${investigatorsSubmittedProject['agency']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                        <span class="error-msg col-md-12" id="investigators_project_agency_`+x_projectDetailsSubmitted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_project_status[]" id="investigators_project_status_`+x_projectDetailsSubmitted+`" value="${investigatorsSubmittedProject['status']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project Status">
                                        <span class="error-msg col-md-12" id="investigators_project_status_`+x_projectDetailsSubmitted+`_error_msg"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_projectDetailsSubmitted == max_fields_projectDetailsSubmitted) {
                                $(".add_field_button_projectDetailsSubmitted").attr("disabled", true);
                            }
                        }
                        if ( is_not_applicable==="NIL" || is_not_applicable==="NA" ) {
                            $("#investigators_project_cost_"+x_projectDetailsSubmitted).prop('readonly', true);
                            $("#investigators_project_submission_month_"+x_projectDetailsSubmitted).prop('readonly', true);
                            $("#investigators_project_role_"+x_projectDetailsSubmitted).prop('readonly', true);
                            $("#investigators_project_agency_"+x_projectDetailsSubmitted).prop('readonly', true);
                            $("#investigators_project_status_"+x_projectDetailsSubmitted).prop('readonly', true);
                        }
                    }
                });
            }
            
            if ( !getSavedData["scheme_ongoing_project_details"] || getSavedData["scheme_ongoing_project_details"] == "null" ) {} else {
                x_projectDetailsOngoing = 0;;
                getSavedData["scheme_ongoing_project_details"].forEach(investigatorsOngoingProject => {
                    if(x_projectDetailsOngoing < max_fields_projectDetailsOngoing){ 					//max input box allowed
                        x_projectDetailsOngoing++; 								//text box increment
                        is_not_applicable = investigatorsOngoingProject['title'] ? investigatorsOngoingProject['title'].toUpperCase() : ''; 

                        if (x_projectDetailsOngoing==1) {
                            $("#investigators_ongoing_project_title_1").val(investigatorsOngoingProject['title']);
                            $("#investigators_ongoing_project_cost_1").val(investigatorsOngoingProject['cost_in_lakhs']);
                            $("#investigators_ongoing_project_start_date_1").val(investigatorsOngoingProject['start_date']);
                            $("#investigators_ongoing_project_end_date_1").val(investigatorsOngoingProject['end_date']);
                            $("#investigators_ongoing_project_role_1").val(investigatorsOngoingProject['role']);
                            $("#investigators_ongoing_project_agency_1").val(investigatorsOngoingProject['agency']);
                        } else {
                            $(wrapper_projectDetailsOngoing).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_projectDetailsOngoing+`</td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_ongoing_project_title[]" id="investigators_ongoing_project_title_`+x_projectDetailsOngoing+`" value="${investigatorsOngoingProject['title']}" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_projectDetailsOngoing+`',this,'investigators_ongoing_project')" placeholder="" aria-describedby="Project title">
                                        <span class="error-msg col-md-12" id="investigators_ongoing_project_title_`+x_projectDetailsOngoing+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="investigators_ongoing_project_cost[]" id="investigators_ongoing_project_cost_`+x_projectDetailsOngoing+`" value="${investigatorsOngoingProject['cost_in_lakhs']}" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                        <span class="error-msg col-md-12" id="investigators_ongoing_project_cost_`+x_projectDetailsOngoing+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="investigators_ongoing_project_start_date[]" id="investigators_ongoing_project_start_date_`+x_projectDetailsOngoing+`"  value="${investigatorsOngoingProject['start_date']}" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsOngoing}, 'investigators_ongoing_project_');" placeholder="" aria-describedby="start date">
                                        <span class="error-msg col-md-12" id="investigators_ongoing_project_start_date_`+x_projectDetailsOngoing+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="investigators_ongoing_project_end_date[]" id="investigators_ongoing_project_end_date_`+x_projectDetailsOngoing+`" value="${investigatorsOngoingProject['end_date']}" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsOngoing}, 'investigators_ongoing_project_');" placeholder="" aria-describedby="End Date">
                                        <span class="error-msg col-md-12" id="investigators_ongoing_project_end_date_`+x_projectDetailsOngoing+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_ongoing_project_role[]" id="investigators_ongoing_project_role_`+x_projectDetailsOngoing+`" value="${investigatorsOngoingProject['role']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                        <span class="error-msg col-md-12" id="investigators_ongoing_project_role_`+x_projectDetailsOngoing+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_ongoing_project_agency[]" id="investigators_ongoing_project_agency_`+x_projectDetailsOngoing+`" value="${investigatorsOngoingProject['agency']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                        <span class="error-msg col-md-12" id="investigators_ongoing_project_agency_`+x_projectDetailsOngoing+`_error_msg"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_projectDetailsOngoing == max_fields_projectDetailsOngoing) {
                                $(".add_field_button_projectDetailsOngoing").attr("disabled", true);
                            }
                        }
                        
                        if ( is_not_applicable==="NIL" || is_not_applicable==="NA" ) {
                            $("#investigators_ongoing_project_cost_"+x_projectDetailsOngoing).prop('readonly', true);
                            $("#investigators_ongoing_project_start_date_"+x_projectDetailsOngoing).prop('readonly', true);
                            $("#investigators_ongoing_project_end_date_"+x_projectDetailsOngoing).prop('readonly', true);
                            $("#investigators_ongoing_project_role_"+x_projectDetailsOngoing).prop('readonly', true);
                            $("#investigators_ongoing_project_agency_"+x_projectDetailsOngoing).prop('readonly', true);
                        }
                    }
                });
            }
            
            if ( !getSavedData["scheme_completed_project_details"] || getSavedData["scheme_completed_project_details"] == "null" ) {} else {
                x_projectDetailsCompleted = 0;
                getSavedData["scheme_completed_project_details"].forEach(investigatorsCompletedProject => {
                    if(x_projectDetailsCompleted < max_fields_projectDetailsCompleted){ 					//max input box allowed
                        x_projectDetailsCompleted++; 								//text box increment
                        is_not_applicable = investigatorsCompletedProject['title'] ? investigatorsCompletedProject['title'].toUpperCase() : ''; 
                        
                        if (x_projectDetailsCompleted==1) {
                            $("#investigators_completed_project_title_1").val(investigatorsCompletedProject['title']);
                            $("#investigators_completed_project_cost_1").val(investigatorsCompletedProject['cost_in_lakhs']);
                            $("#investigators_completed_project_start_date_1").val(investigatorsCompletedProject['start_date']);
                            $("#investigators_completed_project_end_date_1").val(investigatorsCompletedProject['end_date']);
                            $("#investigators_completed_project_role_1").val(investigatorsCompletedProject['role']);
                            $("#investigators_completed_project_agency_1").val(investigatorsCompletedProject['agency']);
                        } else {
                            $(wrapper_projectDetailsCompleted).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_projectDetailsCompleted+`</td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_completed_project_title[]" id="investigators_completed_project_title_`+x_projectDetailsCompleted+`" value="${investigatorsCompletedProject['title']}" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_projectDetailsCompleted+`',this,'investigators_completed_project')" placeholder="" aria-describedby="Project title">
                                        <span class="error-msg col-md-12" id="investigators_completed_project_title_`+x_projectDetailsCompleted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="investigators_completed_project_cost[]" id="investigators_completed_project_cost_`+x_projectDetailsCompleted+`" value="${investigatorsCompletedProject['cost_in_lakhs']}" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                        <span class="error-msg col-md-12" id="investigators_completed_project_cost_`+x_projectDetailsCompleted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="investigators_completed_project_start_date[]" id="investigators_completed_project_start_date_`+x_projectDetailsCompleted+`" value="${investigatorsCompletedProject['start_date']}" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsCompleted}, 'investigators_completed_project_');" placeholder="" aria-describedby="start date">
                                        <span class="error-msg col-md-12" id="investigators_completed_project_start_date_`+x_projectDetailsCompleted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="investigators_completed_project_end_date[]" id="investigators_completed_project_end_date_`+x_projectDetailsCompleted+`" value="${investigatorsCompletedProject['end_date']}" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsCompleted}, 'investigators_completed_project_');" placeholder="" aria-describedby="End Date">
                                        <span class="error-msg col-md-12" id="investigators_completed_project_end_date_`+x_projectDetailsCompleted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_completed_project_role[]" id="investigators_completed_project_role_`+x_projectDetailsCompleted+`" value="${investigatorsCompletedProject['role']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                        <span class="error-msg col-md-12" id="investigators_completed_project_role_`+x_projectDetailsCompleted+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="investigators_completed_project_agency[]" id="investigators_completed_project_agency_`+x_projectDetailsCompleted+`" value="${investigatorsCompletedProject['agency']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                        <span class="error-msg col-md-12" id="investigators_completed_project_agency_`+x_projectDetailsCompleted+`_error_msg"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_projectDetailsCompleted == max_fields_projectDetailsCompleted) {
                                $(".add_field_button_projectDetailsCompleted").attr("disabled", true);
                            }
                        }

                        if ( is_not_applicable==="NIL" || is_not_applicable==="NA" ) {
                            $("#investigators_completed_project_cost_"+x_projectDetailsCompleted).prop('readonly', true);
                            $("#investigators_completed_project_start_date_"+x_projectDetailsCompleted).prop('readonly', true);
                            $("#investigators_completed_project_end_date_"+x_projectDetailsCompleted).prop('readonly', true);
                            $("#investigators_completed_project_role_"+x_projectDetailsCompleted).prop('readonly', true);
                            $("#investigators_completed_project_agency_"+x_projectDetailsCompleted).prop('readonly', true);
                        }
                    }
                });
            }

            let infrastructuralFacilityDetails = getSavedData["infrastructural_facility_details"];
            if ( !infrastructuralFacilityDetails || infrastructuralFacilityDetails == "null" ) {} else {
                x_facilityDetailsInfra = 0;
                infrastructuralFacilityDetails.forEach(infrastructuralFacilityDetail => {
                    if(x_facilityDetailsInfra < max_fields_facilityDetailsInfra){ 					//max input box allowed
                        x_facilityDetailsInfra++; 								//text box increment
                        isInfrastructuralFacilityYes = isInfrastructuralFacilityNo = "";
                        is_not_applicable = infrastructuralFacilityDetail['title'] ? infrastructuralFacilityDetail['title'].toUpperCase() : ''; 

                        if (x_facilityDetailsInfra==1) {
                            $("#projects_impl_infra_facility_1").val(infrastructuralFacilityDetail['title']);
                            $("#is_projects_impl_infra_facility_1").val(infrastructuralFacilityDetail['status']);
                        } else {
                            if (infrastructuralFacilityDetail['status']=='Yes') {
                                isInfrastructuralFacilityYes = "selected";
                            } else if (infrastructuralFacilityDetail['status']=='No') {
                                isInfrastructuralFacilityNo = "selected";
                            }
                            $(wrapper_facilityDetailsInfra).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_facilityDetailsInfra+`</td>
                                    <td>
                                        <input type="text" class="form-control" name="projects_impl_infra_facility[]" id="projects_impl_infra_facility_`+x_facilityDetailsInfra+`" value="${infrastructuralFacilityDetail['title']}" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_facilityDetailsInfra+`',this,'projects_impl_infra_facility')" placeholder="Facilities" aria-describedby="Facilities">
                                        <span class="error-msg col-md-12" id="projects_impl_infra_facility_`+x_facilityDetailsInfra+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" name="is_projects_impl_infra_facility[]" id="is_projects_impl_infra_facility_`+x_facilityDetailsInfra+`" placeholder="Yes / No(if not applicable)" aria-describedby="">
                                                <option value="">Select Facilities Status</option>
                                                <option value="Yes" ${isInfrastructuralFacilityYes}>Yes</option>
                                                <option value="No" ${isInfrastructuralFacilityNo}>No</option>
                                            </select>
                                            <span class="error-msg col-md-12" id="is_projects_impl_infra_facility_`+x_facilityDetailsInfra+`_error_msg"></span>
                                        </div>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_facilityDetailsInfra == max_fields_facilityDetailsInfra) {
                                $(".add_field_button_facilityDetailsInfra").attr("disabled", true);
                            }
                        }
                        
                        if ( is_not_applicable==="NIL" || is_not_applicable==="NA" ) {
                            // $("#projects_impl_infra_facility_"+x_facilityDetailsInfra).prop('readonly', true);
                            $("#is_projects_impl_infra_facility_"+x_facilityDetailsInfra).prop('readonly', true);
                        }
                    }
                });
            }

            let equipmentDetails = getSavedData["equipment_details"];
            if ( !equipmentDetails || equipmentDetails == "null" ) {} else {
                x_facilityDetailsEquipment = 0;
                equipmentDetails.forEach(equipmentDetails => {
                    if(x_facilityDetailsEquipment < max_fields_facilityDetailsEquipment){ 					//max input box allowed
                        x_facilityDetailsEquipment++; 								//text box increment
                        is_not_applicable = equipmentDetails['generic_name'] ? equipmentDetails['generic_name'].toUpperCase() : ''; 

                        if (x_facilityDetailsEquipment==1) {
                            $("#equipment_institute_1").val(equipmentDetails['available_with']);
                            $("#equipment_name_1").val(equipmentDetails['generic_name']);
                            $("#equipment_model_1").val(equipmentDetails['purchase_details']);
                            $("#equipment_remark_1").val(equipmentDetails['remarks_on_accessories']);
                        } else if (x_facilityDetailsEquipment==2) {
                            $("#equipment_institute_2").val(equipmentDetails['available_with']);
                            $("#equipment_name_2").val(equipmentDetails['generic_name']);
                            $("#equipment_model_2").val(equipmentDetails['purchase_details']);
                            $("#equipment_remark_2").val(equipmentDetails['remarks_on_accessories']);
                        } else {
                            $(wrapper_facilityDetailsEquipment).append(`
                                <tr class="wrapper_row">
                                    <td>
                                        <input type="text" name="equipment_institute[]" id="equipment_institute_`+x_facilityDetailsEquipment+`" value="${equipmentDetails['available_with']}" oninput="validateInput(this)" placeholder="Institute Name" class="form-control">
                                        <span class="error-msg col-md-12" id="equipment_institute_`+x_facilityDetailsEquipment+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="equipment_name[]" id="equipment_name_`+x_facilityDetailsEquipment+`" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_facilityDetailsEquipment+`',this,'equipment_name')" cols="80" rows="2" placeholder="">${equipmentDetails['generic_name']}</textarea>
                                        <span class="error-msg col-md-12" id="equipment_name_`+x_facilityDetailsEquipment+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="equipment_model[]" id="equipment_model_`+x_facilityDetailsEquipment+`" oninput="validateInput(this)" cols="80" rows="2" placeholder="">${equipmentDetails['purchase_details']}</textarea>
                                        <span class="error-msg col-md-12" id="equipment_model_`+x_facilityDetailsEquipment+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="equipment_remark[]" id="equipment_remark_`+x_facilityDetailsEquipment+`" oninput="validateInput(this)" cols="80" rows="2" placeholder="">${equipmentDetails['remarks_on_accessories']}</textarea>
                                        <span class="error-msg col-md-12" id="equipment_remark_`+x_facilityDetailsEquipment+`_error_msg"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_facilityDetailsEquipment == max_fields_facilityDetailsEquipment) {
                                $(".add_field_button_facilityDetailsEquipment").attr("disabled", true);
                            }
                        }
                        
                        if ( is_not_applicable==="NIL" || is_not_applicable==="NA" ) {
                            if (x_facilityDetailsEquipment>2) {
                                $("#equipment_institute_"+x_facilityDetailsEquipment).prop('readonly', true);
                            }
                            // $("#equipment_name_"+x_facilityDetailsEquipment).prop('readonly', true);
                            $("#equipment_model_"+x_facilityDetailsEquipment).prop('readonly', true);
                            $("#equipment_remark_"+x_facilityDetailsEquipment).prop('readonly', true);
                        }
                    }
                });
            }
            
            let outcomeInterestedExpertDetails = getSavedData["outcome_interested_expert_details"];
            if ( !outcomeInterestedExpertDetails || outcomeInterestedExpertDetails == "null" ) {} else {
                x_expertOrInstitution = 0;
                outcomeInterestedExpertDetails.forEach(outcomeInterestedExpertDetail => {
                    if(x_expertOrInstitution < max_fields_expertOrInstitution){ 					//max input box allowed
                        x_expertOrInstitution++; 								//text box increment
                        if (x_expertOrInstitution==1) {
                            $("#guide_name_1").val(outcomeInterestedExpertDetail['name']);
                            $("#guide_address_1").val(outcomeInterestedExpertDetail['address']);
                        } else {
                            $(wrapper_expertOrInstitution).append(`
                                <div class="row">
                                    <div class="col-md-1 serial-number text-center text-center-vertical">
                                        `+x_expertOrInstitution+`
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="form-group col-md-4 mb-4">
                                                <label class="form-label star" for="guide_name_`+x_expertOrInstitution+`">Name</label>  
                                                <input type="text" id="guide_name_`+x_expertOrInstitution+`" name="guide_name[]" value="${outcomeInterestedExpertDetail['name']}" oninput="validateInput(this)" placeholder="Enter full name" class="form-control">
                                                <span class="error-msg col-md-12" id="guide_name_`+x_expertOrInstitution+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-8 mb-4">
                                                <label class="form-label star" for="guide_address_`+x_expertOrInstitution+`">Address</label>  
                                                <input type="text" id="guide_address_`+x_expertOrInstitution+`" name="guide_address[]" value="${outcomeInterestedExpertDetail['address']}" oninput="validateInput(this)" placeholder="Enter address" class="form-control">
                                                <span class="error-msg col-md-12" id="guide_address_`+x_expertOrInstitution+`_error_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                </div>
                            `); //add input box
                            if (x_expertOrInstitution == max_fields_expertOrInstitution) {
                                $(".add_field_button_expertOrInstitution").attr("disabled", true);
                            }
                        }
                    }
                });
            }

            $("#budget_consolidated").val(getSavedData["budget_consolidated"]);
            $("#budget_project_relevance").val(getSavedData["budget_project_relevance"]);
            $("#equipment_a").val(getSavedData["equipment_a"]);
            $("#equipment_b").val(getSavedData["equipment_b"]);
            $("#equipment_c").val(getSavedData["equipment_c"]);
            $("#equipment_d").val(getSavedData["equipment_d"]);
            $("#equipment_e").val(getSavedData["equipment_e"]);
            for (let index = 1; index <= 17; index++) {
                $("#year_"+index+"_1").val(getSavedData["year_"+index+"_1"]);
                $("#year_"+index+"_2").val(getSavedData["year_"+index+"_2"]);
                $("#year_"+index+"_total").val(getSavedData["year_"+index+"_total"]);
            }
            // $("#budget_components_details").val(getSavedData["budget_components_details"]);
            if ( !getSavedData["budget_components_details"] || getSavedData["budget_components_details"] == "null" ) {} else {
                x_budgetComponentsDetails = 0;
                getSavedData["budget_components_details"].forEach(budgetComponentsDetail => {
                    if(x_budgetComponentsDetails < max_fields_budgetComponentsDetails){ 					//max input box allowed
                        x_budgetComponentsDetails++; 								//text box increment
                        if (x_budgetComponentsDetails==1) {
                            $("#budget_components_item_1").val(budgetComponentsDetail['name']);
                            $("#budget_components_justification_1").val(budgetComponentsDetail['description']);
                        } else {
                            $(wrapper_budgetComponentsDetails).append(`
                                <div class="row wrapper_row">
                                    <div class="col-md-1 serial-number text-center content-center text-center-vertical">`+x_budgetComponentsDetails+`</div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="form-group col-md-5 mb-4">
                                                <label class="form-label fw6 star" for="budget_components_item_`+x_budgetComponentsDetails+`">Item Name</label>  
                                                <input type="text" id="budget_components_item_`+x_budgetComponentsDetails+`" name="budget_components_item[]" value="${budgetComponentsDetail['name']}" oninput="validateInput(this)"  placeholder="Enter Item name" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="budget_components_item_`+x_budgetComponentsDetails+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-7 mb-4">
                                                <label class="form-label fw6 star" for="budget_components_justification_`+x_budgetComponentsDetails+`">Justification</label>  
                                                <textarea class="form-control" name="budget_components_justification[]" id="budget_components_justification_`+x_budgetComponentsDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Budget Description">${budgetComponentsDetail['description']}</textarea>
                                                <span class="error-msg col-md-12" id="budget_components_justification_`+x_budgetComponentsDetails+`_error_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                </div>
                            `); //add input box
                            if (x_budgetComponentsDetails == max_fields_budgetComponentsDetails) {
                                $(".add_field_button_budget_components_details").attr("disabled", true);
                            }
                        }
                    }
                });
            }

            if (getSavedData['is_pi_belong_to_category']==1) {
                is_pi_belong_to_category = getSavedData['is_pi_belong_to_category'];
            }
            $("input:radio[name=is_pi_belong_to_category]").val([is_pi_belong_to_category]);
            showMoreOptions('category', is_pi_belong_to_category);
            if (getSavedData['file_category_certificate']) {
                file_category_certificate = getSavedData['file_category_certificate'];
                displayUploadedFile('docs', 'file_category_certificate', file_category_certificate);
            }
        
            if (getSavedData['is_pi_differently_abled']==1) {
                is_pi_differently_abled = getSavedData['is_pi_differently_abled'];
            }
            $("input:radio[name=is_pi_differently_abled]").val([is_pi_differently_abled]);
            showMoreOptions('pi_diff_abled', is_pi_differently_abled);
            if (getSavedData['file_pi_diff_abled_certificate']) {
                file_pi_diff_abled_certificate = getSavedData['file_pi_diff_abled_certificate'];
                displayUploadedFile('docs', 'file_pi_diff_abled_certificate', file_pi_diff_abled_certificate);
            }

            if (getSavedData["file_pi_certification"]) {
                file_pi_certification = getSavedData["file_pi_certification"];
                displayUploadedFile('docs', 'file_pi_certification', file_pi_certification);
            }
            if (getSavedData["file_aadhar_card"]) {
                file_aadhar_card = getSavedData["file_aadhar_card"];
                displayUploadedFile('docs', 'file_aadhar_card', file_aadhar_card);
            }
            if (getSavedData["file_principal_endorsement_certificate"]) {
                file_principal_endorsement_certificate = getSavedData["file_principal_endorsement_certificate"];
                displayUploadedFile('docs', 'file_principal_endorsement_certificate', file_principal_endorsement_certificate);
            }
            // if (getSavedData["file_registrar_endorsement_certificate"]) {
            //     file_registrar_endorsement_certificate = getSavedData["file_registrar_endorsement_certificate"];
            //     displayUploadedFile('docs', 'file_registrar_endorsement_certificate', file_registrar_endorsement_certificate);
            // }
            // if (getSavedData["file_head_inst_endorsement_certificate"]) {
            //     file_head_inst_endorsement_certificate = getSavedData["file_head_inst_endorsement_certificate"];
            //     displayUploadedFile('docs', 'file_head_inst_endorsement_certificate', file_head_inst_endorsement_certificate);
            // }

            
            if (getSavedData['is_pi_non_phd']==1) {
                is_pi_non_phd = getSavedData['is_pi_non_phd'];
            }
            $("input:radio[name=is_pi_non_phd]").val([is_pi_non_phd]);
            showMoreOptions('non_phd', is_pi_non_phd);
            if (getSavedData["file_pi_bona_fide_certificate"]) {
                file_pi_bona_fide_certificate = getSavedData["file_pi_bona_fide_certificate"];
                displayUploadedFile('docs', 'file_pi_bona_fide_certificate', file_pi_bona_fide_certificate);
            }
            if (getSavedData["file_pi_cv"]) {
                file_pi_cv = getSavedData["file_pi_cv"];
                displayUploadedFile('docs', 'file_pi_cv', file_pi_cv);
            }
        } else {
            $("#form_0").addClass('d-block'); // display tab content
            callApi({
                method: 'GET',
                url: 'api/schemeMinorResearchProjectApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
                form_type: 'preview-data',
                is_loader: 'within_the_page',
            });
            AmagiLoader.show();
        }
        // if no data saved 
        getPresetUserData('MajMin');

        // add multiple rows 
            // Institution Details
            $(add_button_instituteDetails).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_instituteDetails = institute_names.length;
                if(x_instituteDetails < max_fields_instituteDetails){ 					//max input box allowed
                    x_instituteDetails++;					                    //text box increment
                    $(wrapper_instituteDetails).append(`
                        <div class="row">
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="form-group col-md-5 mb-4">
                                        <label class="form-label fw6" for="institute_name_`+x_instituteDetails+`">Name of the Institute</label>  
                                        <input type="text" id="institute_name_`+x_instituteDetails+`" name="institute_name[]" value="" placeholder="Enter name" class="form-control input-md">
                                        <span class="error-msg col-md-12" id="institute_name_`+x_instituteDetails+`_error_msg"></span>
                                    </div>
                                    <div class="form-group col-md-7 mb-4">
                                        <label class="form-label fw6" for="institute_address_`+x_instituteDetails+`">Institute Address</label>  
                                        <textarea class="form-control" name="institute_address[]" id="institute_address_`+x_instituteDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Institute Address"></textarea>
                                        <span class="error-msg col-md-12" id="institute_address_`+x_instituteDetails+`_error_msg"></span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                        </div>
                    `); //add input box
                    if (x_instituteDetails == max_fields_instituteDetails) {
                        $(".add_field_button_inst_add").attr("disabled", true);
                    }
                }
            });
            $(wrapper_instituteDetails).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).parent('div').remove();
                x_instituteDetails--;
                if (x_instituteDetails < max_fields_instituteDetails) {
                    $(".add_field_button_inst_add").attr("disabled", false);
                }
                // updateSerialNumbers(wrapper_instituteDetails);
            }); // click on remove fields
            
            // Expertise Investor Publications
            $(add_button_investPublication).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_investPublication = investigator_publications.length;
                if(x_investPublication < max_fields_investPublication){ 					//max input box allowed
                    x_investPublication++;					                    //text box increment
                    $(wrapper_investPublication).append(`
                        <tr class="wrapper_row">
                            <td class="serial-number text-center">`+x_investPublication+`</td>
                            <td>
                                <textarea class="form-control" name="investigator_publication[]" id="investigator_publication_`+x_investPublication+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter publications"></textarea>
                                <span id="investigator_publication_`+x_investPublication+`_error_msg" class="error-msg col-md-12"></span>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_investPublication == max_fields_investPublication) {
                        $(".add_field_button_invest_publication").attr("disabled", true);
                    }
                }
            });
            $(wrapper_investPublication).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_investPublication--;
                if (x_investPublication < max_fields_investPublication) {
                    $(".add_field_button_invest_publication").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_investPublication);
            }); // click on remove fields

            // Expertise Bibliography
            $(add_button_bibliography).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_bibliography = bibliographies.length;
                if(x_bibliography < max_fields_bibliography){ 					//max input box allowed
                    x_bibliography++;					                    //text box increment
                    $(wrapper_bibliography).append(`
                        <tr class="wrapper_row">
                            <td class="serial-number text-center">`+x_bibliography+`</td>
                            <td>
                                <textarea class="form-control" name="bibliography[]" id="bibliography_`+x_bibliography+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter references"></textarea>
                                <span id="bibliography_`+x_bibliography+`_error_msg" class="error-msg col-md-12"></span>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_bibliography == max_fields_bibliography) {
                        $(".add_field_button_bibliography").attr("disabled", true);
                    }
                }
            });
            $(wrapper_bibliography).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_bibliography--;
                if (x_bibliography < max_fields_bibliography) {
                    $(".add_field_button_bibliography").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_bibliography);
            }); // click on remove fields

            // Project details submitted
            $(add_button_projectDetailsSubmitted).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_projectDetailsSubmitted = investigators_project_titles.length;
                if(x_projectDetailsSubmitted < max_fields_projectDetailsSubmitted){ 					//max input box allowed
                    x_projectDetailsSubmitted++;					                    //text box increment
                    $(wrapper_projectDetailsSubmitted).append(`
                        <tr class="wrapper_row">
                            <td class="serial-number text-center">`+x_projectDetailsSubmitted+`</td>
                            <td>
                                <input type="text" class="form-control" name="investigators_project_title[]" id="investigators_project_title_`+x_projectDetailsSubmitted+`" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_projectDetailsSubmitted+`',this,'investigators_project')" placeholder="" aria-describedby="Project title">
                                <span class="error-msg col-md-12" id="investigators_project_title_`+x_projectDetailsSubmitted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="investigators_project_cost[]" id="investigators_project_cost_`+x_projectDetailsSubmitted+`" value="" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                <span class="error-msg col-md-12" id="investigators_project_cost_`+x_projectDetailsSubmitted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="month" class="form-control" name="investigators_project_submission_month[]" id="investigators_project_submission_month_`+x_projectDetailsSubmitted+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Submission month">
                                <span class="error-msg col-md-12" id="investigators_project_submission_month_`+x_projectDetailsSubmitted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="investigators_project_role[]" id="investigators_project_role_`+x_projectDetailsSubmitted+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                <span class="error-msg col-md-12" id="investigators_project_role_`+x_projectDetailsSubmitted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="investigators_project_agency[]" id="investigators_project_agency_`+x_projectDetailsSubmitted+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                <span class="error-msg col-md-12" id="investigators_project_agency_`+x_projectDetailsSubmitted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="investigators_project_status[]" id="investigators_project_status_`+x_projectDetailsSubmitted+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project Status">
                                <span class="error-msg col-md-12" id="investigators_project_status_`+x_projectDetailsSubmitted+`_error_msg"></span>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_projectDetailsSubmitted == max_fields_projectDetailsSubmitted) {
                        $(".add_field_button_projectDetailsSubmitted").attr("disabled", true);
                    }
                }
            });
            $(wrapper_projectDetailsSubmitted).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_projectDetailsSubmitted--;
                if (x_projectDetailsSubmitted < max_fields_projectDetailsSubmitted) {
                    $(".add_field_button_projectDetailsSubmitted").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_projectDetailsSubmitted);
            }); // click on remove fields

            // Project details ongoing
            $(add_button_projectDetailsOngoing).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_projectDetailsOngoing = investigators_ongoing_project_titles.length;
                if(x_projectDetailsOngoing < max_fields_projectDetailsOngoing){ 					//max input box allowed
                    x_projectDetailsOngoing++;					                    //text box increment
                    $(wrapper_projectDetailsOngoing).append(`
                        <tr class="wrapper_row">
                            <td class="serial-number text-center">`+x_projectDetailsOngoing+`</td>
                            <td>
                                <input type="text" class="form-control" name="investigators_ongoing_project_title[]" id="investigators_ongoing_project_title_`+x_projectDetailsOngoing+`" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_projectDetailsOngoing+`',this,'investigators_ongoing_project')" placeholder="" aria-describedby="Project title">
                                <span class="error-msg col-md-12" id="investigators_ongoing_project_title_`+x_projectDetailsOngoing+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="investigators_ongoing_project_cost[]" id="investigators_ongoing_project_cost_`+x_projectDetailsOngoing+`" value="" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                <span class="error-msg col-md-12" id="investigators_ongoing_project_cost_`+x_projectDetailsOngoing+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="investigators_ongoing_project_start_date[]" id="investigators_ongoing_project_start_date_`+x_projectDetailsOngoing+`" value="" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsOngoing}, 'investigators_ongoing_project_');" placeholder="" aria-describedby="start date">
                                <span class="error-msg col-md-12" id="investigators_ongoing_project_start_date_`+x_projectDetailsOngoing+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="investigators_ongoing_project_end_date[]" id="investigators_ongoing_project_end_date_`+x_projectDetailsOngoing+`" value="" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsOngoing}, 'investigators_ongoing_project_');" placeholder="" aria-describedby="End Date">
                                <span class="error-msg col-md-12" id="investigators_ongoing_project_end_date_`+x_projectDetailsOngoing+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="investigators_ongoing_project_role[]" id="investigators_ongoing_project_role_`+x_projectDetailsOngoing+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                <span class="error-msg col-md-12" id="investigators_ongoing_project_role_`+x_projectDetailsOngoing+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="investigators_ongoing_project_agency[]" id="investigators_ongoing_project_agency_`+x_projectDetailsOngoing+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                <span class="error-msg col-md-12" id="investigators_ongoing_project_agency_`+x_projectDetailsOngoing+`_error_msg"></span>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_projectDetailsOngoing == max_fields_projectDetailsOngoing) {
                        $(".add_field_button_projectDetailsOngoing").attr("disabled", true);
                    }
                }
            });
            $(wrapper_projectDetailsOngoing).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_projectDetailsOngoing--;
                if (x_projectDetailsOngoing < max_fields_projectDetailsOngoing) {
                    $(".add_field_button_projectDetailsOngoing").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_projectDetailsOngoing);
            }); // click on remove fields
            
            // Project details completed
            $(add_button_projectDetailsCompleted).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_projectDetailsCompleted = investigators_completed_project_titles.length;
                if(x_projectDetailsCompleted < max_fields_projectDetailsCompleted){ 					//max input box allowed
                    x_projectDetailsCompleted++;					                    //text box increment
                    $(wrapper_projectDetailsCompleted).append(`
                        <tr class="wrapper_row">
                            <td class="serial-number text-center">`+x_projectDetailsCompleted+`</td>
                            <td>
                                <input type="text" class="form-control" name="investigators_completed_project_title[]" id="investigators_completed_project_title_`+x_projectDetailsCompleted+`" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_projectDetailsCompleted+`',this,'investigators_completed_project')" placeholder="" aria-describedby="Project title">
                                <span class="error-msg col-md-12" id="investigators_completed_project_title_`+x_projectDetailsCompleted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="investigators_completed_project_cost[]" id="investigators_completed_project_cost_`+x_projectDetailsCompleted+`" value="" oninput="validateInput(this)" placeholder="₹" aria-describedby="0000">
                                <span class="error-msg col-md-12" id="investigators_completed_project_cost_`+x_projectDetailsCompleted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="investigators_completed_project_start_date[]" id="investigators_completed_project_start_date_`+x_projectDetailsCompleted+`" value="" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsCompleted}, 'investigators_completed_project_');" placeholder="" aria-describedby="start date">
                                <span class="error-msg col-md-12" id="investigators_completed_project_start_date_`+x_projectDetailsCompleted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="investigators_completed_project_end_date[]" id="investigators_completed_project_end_date_`+x_projectDetailsCompleted+`" value="" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetailsCompleted}, 'investigators_completed_project_');" placeholder="" aria-describedby="End Date">
                                <span class="error-msg col-md-12" id="investigators_completed_project_end_date_`+x_projectDetailsCompleted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="investigators_completed_project_role[]" id="investigators_completed_project_role_`+x_projectDetailsCompleted+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project role">
                                <span class="error-msg col-md-12" id="investigators_completed_project_role_`+x_projectDetailsCompleted+`_error_msg"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="investigators_completed_project_agency[]" id="investigators_completed_project_agency_`+x_projectDetailsCompleted+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                <span class="error-msg col-md-12" id="investigators_completed_project_agency_`+x_projectDetailsCompleted+`_error_msg"></span>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_projectDetailsCompleted == max_fields_projectDetailsCompleted) {
                        $(".add_field_button_projectDetailsCompleted").attr("disabled", true);
                    }
                }
            });
            $(wrapper_projectDetailsCompleted).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_projectDetailsCompleted--;
                if (x_projectDetailsCompleted < max_fields_projectDetailsCompleted) {
                    $(".add_field_button_projectDetailsCompleted").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_projectDetailsCompleted);
            }); // click on remove fields

            // Facility Details infrastructure
            $(add_button_facilityDetailsInfra).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_facilityDetailsInfra = projects_impl_infra_facilities.length;
                if(x_facilityDetailsInfra < max_fields_facilityDetailsInfra){ 					//max input box allowed
                    x_facilityDetailsInfra++;					                    //text box increment
                    $(wrapper_facilityDetailsInfra).append(`
                        <tr class="wrapper_row">
                            <td class="serial-number text-center">`+x_facilityDetailsInfra+`</td>
                            <td>
                                <input type="text" class="form-control" name="projects_impl_infra_facility[]" id="projects_impl_infra_facility_`+x_facilityDetailsInfra+`" value="" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_facilityDetailsInfra+`',this,'projects_impl_infra_facility')" placeholder="Facilities" aria-describedby="Facilities">
                                <span class="error-msg col-md-12" id="projects_impl_infra_facility_`+x_facilityDetailsInfra+`_error_msg"></span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="is_projects_impl_infra_facility[]" id="is_projects_impl_infra_facility_`+x_facilityDetailsInfra+`" placeholder="Yes / No(if not applicable)" aria-describedby="">
                                        <option value="">Select Facilities Status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <span class="error-msg col-md-12" id="is_projects_impl_infra_facility_`+x_facilityDetailsInfra+`_error_msg"></span>
                                </div>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_facilityDetailsInfra == max_fields_facilityDetailsInfra) {
                        $(".add_field_button_facilityDetailsInfra").attr("disabled", true);
                    }
                }
            });
            $(wrapper_facilityDetailsInfra).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_facilityDetailsInfra--;
                if (x_facilityDetailsInfra < max_fields_facilityDetailsInfra) {
                    $(".add_field_button_facilityDetailsInfra").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_facilityDetailsInfra);
            }); // click on remove fields

            // Facility Details equipment
            $(add_button_facilityDetailsEquipment).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_facilityDetailsEquipment = equipment_institutes.length;
                if(x_facilityDetailsEquipment < max_fields_facilityDetailsEquipment){ 					//max input box allowed
                    x_facilityDetailsEquipment++;					                    //text box increment
                    $(wrapper_facilityDetailsEquipment).append(`
                        <tr class="wrapper_row">
                            <td>
                                <input type="text" name="equipment_institute[]" id="equipment_institute_`+x_facilityDetailsEquipment+`" value="" oninput="validateInput(this)" placeholder="Institute Name" class="form-control">
                                <span class="error-msg col-md-12" id="equipment_institute_`+x_facilityDetailsEquipment+`_error_msg"></span>
                            </td>
                            <td>
                                <textarea class="form-control" name="equipment_name[]" id="equipment_name_`+x_facilityDetailsEquipment+`" oninput="validateInput(this)" onkeyup="checkInputToNull('`+x_facilityDetailsEquipment+`',this,'equipment_name')" cols="80" rows="2" placeholder=""></textarea>
                                <span class="error-msg col-md-12" id="equipment_name_`+x_facilityDetailsEquipment+`_error_msg"></span>
                            </td>
                            <td>
                                <textarea class="form-control" name="equipment_model[]" id="equipment_model_`+x_facilityDetailsEquipment+`" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                <span class="error-msg col-md-12" id="equipment_model_`+x_facilityDetailsEquipment+`_error_msg"></span>
                            </td>
                            <td>
                                <textarea class="form-control" name="equipment_remark[]" id="equipment_remark_`+x_facilityDetailsEquipment+`" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                <span class="error-msg col-md-12" id="equipment_remark_`+x_facilityDetailsEquipment+`_error_msg"></span>
                            </td>
                            <td width="62px">
                                <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                            </td>
                        </tr>
                    `); //add input box
                    if (x_facilityDetailsEquipment == max_fields_facilityDetailsEquipment) {
                        $(".add_field_button_facilityDetailsEquipment").attr("disabled", true);
                    }
                }
            });
            $(wrapper_facilityDetailsEquipment).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).closest('tr').remove();
                x_facilityDetailsEquipment--;
                if (x_facilityDetailsEquipment < max_fields_facilityDetailsEquipment) {
                    $(".add_field_button_facilityDetailsEquipment").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_facilityDetailsEquipment);
            }); // click on remove fields

            // List of Experts/Institutions
            $(add_button_expertOrInstitution).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_expertOrInstitution = expert_guide_names.length;
                if(x_expertOrInstitution < max_fields_expertOrInstitution){ 					//max input box allowed
                    x_expertOrInstitution++;					                    //text box increment
                    $(wrapper_expertOrInstitution).append(`
                        <div class="row wrapper_row">
                            <div class="col-md-1 serial-number text-center text-center-vertical">
                                `+x_expertOrInstitution+`
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="form-group col-md-4 mb-4">
                                        <label class="form-label star" for="guide_name_`+x_expertOrInstitution+`">Name</label>  
                                        <input type="text" id="guide_name_`+x_expertOrInstitution+`" name="guide_name[]" value="" oninput="validateInput(this)" placeholder="Enter full name" class="form-control">
                                        <span class="error-msg col-md-12" id="guide_name_`+x_expertOrInstitution+`_error_msg"></span>
                                    </div>
                                    <div class="form-group col-md-8 mb-4">
                                        <label class="form-label star" for="guide_address_`+x_expertOrInstitution+`">Address</label>  
                                        <input type="text" id="guide_address_`+x_expertOrInstitution+`" name="guide_address[]" value="" oninput="validateInput(this)" placeholder="Enter address" class="form-control">
                                        <span class="error-msg col-md-12" id="guide_address_`+x_expertOrInstitution+`_error_msg"></span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                        </div>
                    `); //add input box
                    if (x_expertOrInstitution == max_fields_expertOrInstitution) {
                        $(".add_field_button_expertOrInstitution").attr("disabled", true);
                    }
                }
            });
            $(wrapper_expertOrInstitution).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).parent('div').remove();
                x_expertOrInstitution--;
                if (x_expertOrInstitution < max_fields_expertOrInstitution) {
                    $(".add_field_button_expertOrInstitution").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_expertOrInstitution);
            }); // click on remove fields

            // List of budget components details
            $(add_button_budgetComponentsDetails).click(function(e){ 			    //on add input button click
                e.preventDefault();
                x_budgetComponentsDetails = budget_components_items.length;
                if(x_budgetComponentsDetails < max_fields_budgetComponentsDetails){ 					//max input box allowed
                    x_budgetComponentsDetails++;					                    //text box increment
                    $(wrapper_budgetComponentsDetails).append(`
                        <div class="row wrapper_row">
                            <div class="col-md-1 serial-number text-center content-center text-center-vertical">`+x_budgetComponentsDetails+`</div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="form-group col-md-5 mb-4">
                                        <label class="form-label fw6 star" for="budget_components_item_`+x_budgetComponentsDetails+`">Item Name</label>  
                                        <input type="text" id="budget_components_item_`+x_budgetComponentsDetails+`" name="budget_components_item[]" value="" oninput="validateInput(this)" placeholder="Enter Item name" class="form-control input-md">
                                        <span class="error-msg col-md-12" id="budget_components_item_`+x_budgetComponentsDetails+`_error_msg"></span>
                                    </div>
                                    <div class="form-group col-md-7 mb-4">
                                        <label class="form-label fw6 star" for="budget_components_justification_`+x_budgetComponentsDetails+`">Justification</label>  
                                        <textarea class="form-control" name="budget_components_justification[]" id="budget_components_justification_`+x_budgetComponentsDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Budget Description"></textarea>
                                        <span class="error-msg col-md-12" id="budget_components_justification_`+x_budgetComponentsDetails+`_error_msg"></span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                        </div>
                    `); //add input box
                    if (x_budgetComponentsDetails == max_fields_budgetComponentsDetails) {
                        $(".add_field_button_budget_components_details").attr("disabled", true);
                    }
                }
            });
            $(wrapper_budgetComponentsDetails).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).parent('div').remove();
                x_budgetComponentsDetails--;
                if (x_budgetComponentsDetails < max_fields_budgetComponentsDetails) {
                    $(".add_field_button_budget_components_details").attr("disabled", false);
                }
                updateSerialNumbers(wrapper_budgetComponentsDetails);
            }); // click on remove fields
            
        // add here ----------------------------------------------

    });
    
    $('input:radio[name=gender]').on("change", function() {
        gender = this.value;
    });
    $('input:radio[name=co_inv_i_gender]').on("change", function() {
        co_inv_i_gender = this.value;
    });
    $('input:radio[name=co_inv_ii_gender]').on("change", function() {
        co_inv_ii_gender = this.value;
    });
    $('input:radio[name=is_pi_belong_to_category]').on("change", function() {
        is_pi_belong_to_category = this.value;
        showMoreOptions('category', is_pi_belong_to_category);
    });
    $('input:radio[name=is_pi_differently_abled]').on("change", function() {
        is_pi_differently_abled = this.value;
        showMoreOptions('pi_diff_abled', is_pi_differently_abled);
    });
    $('input:radio[name=is_pi_non_phd]').on("change", function() {
        is_pi_non_phd = this.value;
        showMoreOptions('non_phd', is_pi_non_phd);
    });

    // upload images --------------------------------
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
                    'storage_key' : 'minorResearchProjectData',
                });
                isSavedForm_0 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputMethodology.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_methodology', 
                    'file_id' : fileInputMethodology, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData',
                });
                isSavedForm_3 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputTimeSchedule.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_time_schedule', 
                    'file_id' : fileInputTimeSchedule, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_3 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputPICategory.addEventListener('change', async (event) => {
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
                    'file_id' : fileInputPICategory, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_9 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputPIDiffAbledCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_pi_diff_abled_certificate', 
                    'file_id' : fileInputPIDiffAbledCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_9 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputPICertification.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_pi_certification', 
                    'file_id' : fileInputPICertification, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_9 = false;
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
        fileInputPrincipalEndorseCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_principal_endorsement_certificate', 
                    'file_id' : fileInputPrincipalEndorseCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_9 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        // fileInputRegistrarEndorseCertificate.addEventListener('change', async (event) => {
            // 	const file = event.target.files[0];
            // 	if (file) {
            //         const encodedFile = await encodeFile(file);
            //         let fileData = {
            //             "file" : encodedFile,
            //             "file_name" : file.name,
            //         }
            //         uploadFile({
            //             'file_type' : 'docs', 
            //             'response_id' : 'file_registrar_endorsement_certificate', 
            //             'file_id' : fileInputRegistrarEndorseCertificate, 
            //             'file_data' : fileData, 
            //             'storage_key' : 'minorResearchProjectData'
            //         });
            //         isSavedForm_9 = false;
            //     } else {
            // 		popUpMsg('Please select a File!');
            // 	}
            // });
            // fileInputHeadInstEndorseCertificate.addEventListener('change', async (event) => {
            // 	const file = event.target.files[0];
            // 	if (file) {
            //         const encodedFile = await encodeFile(file);
            //         let fileData = {
            //             "file" : encodedFile,
            //             "file_name" : file.name,
            //         }
            //         uploadFile({
            //             'file_type' : 'docs', 
            //             'response_id' : 'file_head_inst_endorsement_certificate', 
            //             'file_id' : fileInputHeadInstEndorseCertificate, 
            //             'file_data' : fileData, 
            //             'storage_key' : 'minorResearchProjectData'
            //         });
            //         isSavedForm_9 = false;
            //     } else {
            // 		popUpMsg('Please select a File!');
            // 	}
            // });
        fileInputPICv.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_pi_cv', 
                    'file_id' : fileInputPICv, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_9 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputBonaFideCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_pi_bona_fide_certificate', 
                    'file_id' : fileInputBonaFideCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'minorResearchProjectData'
                });
                isSavedForm_9 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });


    function saveForm(formNo) {
        if (formNo==0) {
            $(".save_btn").attr('disabled', true);

            saveData["flag"] = true;
            saveData["user_id"] = userId;
            saveData["scheme_batch_id"] = schemeBatchId;

            saveData["investigator_details"] = [];
            saveData["investigator_details"].push({
                        'type' : 'principal_investigator',
                        'first_name': validateEmptyFields("first_name", ""),
                        'middle_name' : validateEmptyFields("middle_name", ""),
                        'last_name' : validateEmptyFields("last_name", ""),
                        'gender' : gender,
                        'dob' : validateEmptyFields("dob", ""),
                        'country_code' : validateEmptyFields("country_code", ""),
                        'phone_no' : validateEmptyFields("phone_no", ""),
                        'email' : validateEmptyFields("email", ""),
                        'designation' : validateEmptyFields("designation", ""),
                        'qualification' : validateEmptyFields("qualification", ""),
                        'official_address' : validateEmptyFields("official_address", ""),
                    });
            saveData["specialisation"] = validateEmptyFields("specialisation", "");
            file_profile_picture = saveData["file_profile_picture"];
            saveData["proposed_amount"] = validateEmptyFields("proposed_amount", "");
            
            saveData["institution_details"] = [];
			if (institute_names.length>0) {
				for(let j=0;j<institute_names.length;j++)
				{
					if ( institute_names[j].value == "" && institute_address[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["institution_details"].push({
							'name': institute_names[j].value,
							'address': institute_address[j].value,
						});
					}
				}
			}
            isSavedForm_0 = true;

        } else if (formNo==1) {
            saveData["proposal_title"] = validateEmptyFields("proposal_title", "");
            saveData["broad_discipline"] = validateEmptyFields("broad_discipline", "");
            saveData["proposal_summary"] = validateEmptyFields("proposal_summary", "");
            saveData["objectives"] = validateEmptyFields("objectives", ""); 
            saveData["expected_outcome"] = validateEmptyFields("expected_outcome", ""); 
            isSavedForm_1 = true;

        } else if (formNo==2) {
            saveData["proposal_background"] = validateEmptyFields("proposal_background", "");
            saveData["international_status"] = validateEmptyFields("international_status", "");
            saveData["national_status"] = validateEmptyFields("national_status", "");
            saveData["local_status"] = validateEmptyFields("local_status", "");
            saveData["proposal_significance"] = validateEmptyFields("proposal_significance", "");
            saveData["proposal_objectives"] = validateEmptyFields("proposal_objectives", "");
            saveData["project_location"] = validateEmptyFields("project_location", "");
            isSavedForm_2 = true;

        } else if (formNo==3) {
            saveData["methodology"] = validateEmptyFields("methodology", "");
            file_methodology = saveData["file_methodology"];
            file_time_schedule = saveData["file_time_schedule"];
            saveData["action_plan"] = validateEmptyFields("action_plan", "");
            saveData["any_other_details"] = validateEmptyFields("any_other_details", "");
            isSavedForm_3 = true;

        } else if (formNo==4) {
            saveData["specific_expertise_of_pi"] = validateEmptyFields("specific_expertise_of_pi", "");
            // saveData["bibliography"] = validateEmptyFields("bibliography", "");
            saveData["bibliography_details"] = [];
			if (bibliographies.length>0) {
				for(let j=0;j<bibliographies.length;j++)
				{
					if ( bibliographies[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["bibliography_details"].push({
							'name': bibliographies[j].value,
						});
					}
				}
			}
            saveData["investigator_publications_details"] = [];
			if (investigator_publications.length>0) {
				for(let j=0;j<investigator_publications.length;j++)
				{
					if ( investigator_publications[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["investigator_publications_details"].push({
							'name': investigator_publications[j].value,
						});
					}
				}
			}
            isSavedForm_4 = true;

        } else if (formNo==5) {
            saveData["scheme_submitted_project_details"] = [];
			if (investigators_project_titles.length>0) {
				for(let j=0;j<investigators_project_titles.length;j++)
				{
					if ( investigators_project_titles[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["scheme_submitted_project_details"].push({
                            'project_status' : 'submitted',
                            'type' : 'Investigator',
                            'title' : investigators_project_titles[j].value,
                            'cost_in_lakhs' : investigators_project_costs[j].value,
                            'submission_month' : investigators_project_submission_months[j].value,
                            'role' : investigators_project_roles[j].value,
                            'agency' : investigators_project_agencies[j].value,
                            'status' : investigators_project_statuses[j].value,
						});
					}
				}
			}
            saveData["scheme_ongoing_project_details"] = [];
            if (investigators_ongoing_project_titles.length>0) {
				for(let j=0;j<investigators_ongoing_project_titles.length;j++)
				{
					if ( investigators_ongoing_project_titles[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["scheme_ongoing_project_details"].push({
                            'project_status' : 'ongoing',
                            'type' : 'Investigator',
                            'title' : investigators_ongoing_project_titles[j].value,
                            'cost_in_lakhs' : investigators_ongoing_project_costs[j].value,
                            'start_date' : investigators_ongoing_project_start_dates[j].value,
                            'end_date' : investigators_ongoing_project_end_dates[j].value,
                            'role' : investigators_ongoing_project_roles[j].value,
                            'agency' : investigators_ongoing_project_agencies[j].value,
						});
					}
				}
			}
            saveData["scheme_completed_project_details"] = [];
            if (investigators_completed_project_titles.length>0) {
				for(let j=0;j<investigators_completed_project_titles.length;j++)
				{
					if ( investigators_completed_project_titles[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["scheme_completed_project_details"].push({
                            'project_status' : 'completed',
                            'type' : 'Investigator',
                            'title' : investigators_completed_project_titles[j].value,
                            'cost_in_lakhs' : investigators_completed_project_costs[j].value,
                            'start_date' : investigators_completed_project_start_dates[j].value,
                            'end_date' : investigators_completed_project_end_dates[j].value,
                            'role' : investigators_completed_project_roles[j].value,
                            'agency' : investigators_completed_project_agencies[j].value,
						});
					}
				}
			}
            isSavedForm_5 = true;

        } else if (formNo==6) {
            saveData["infrastructural_facility_details"] = [];
			if (projects_impl_infra_facilities.length>0) {
				for(let j=0;j<projects_impl_infra_facilities.length;j++)
				{
					if ( projects_impl_infra_facilities[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["infrastructural_facility_details"].push({
							'title': projects_impl_infra_facilities[j].value,
							'status': is_projects_impl_infra_facilities[j].value,
						});
					}
				}
			}
            saveData["equipment_details"] = [];
			if (equipment_names.length>0) {
				for(let j=0;j<equipment_names.length;j++)
				{
					if ( equipment_names[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["equipment_details"].push({
                            'available_with' : equipment_institutes[j].value,
                            'generic_name' : equipment_names[j].value,
                            'purchase_details' : equipment_models[j].value,
                            'remarks_on_accessories' : equipment_remarks[j].value,
						});
					}
				}
			}
            isSavedForm_6 = true;

        } else if (formNo==7) {
            saveData["outcome_interested_expert_details"] = [];
			if (expert_guide_names.length>0) {
				for(let j=0;j<expert_guide_names.length;j++)
				{
					if ( expert_guide_names[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["outcome_interested_expert_details"].push({
							'name': expert_guide_names[j].value,
							'address': expert_guide_address[j].value,
						});
					}
				}
			}
            isSavedForm_7 = true;

        } else if (formNo==8) {
            saveData["budget_consolidated"] = validateEmptyFields("budget_consolidated", "");
            saveData["proposed_amount"] = validateEmptyFields("proposed_amount", "");
            // saveData["budget_components_details"] = validateEmptyFields("budget_components_details", "");
            saveData["budget_components_details"] = [];
			if (budget_components_items.length>0) {
				for(let j=0;j<budget_components_items.length;j++)
				{
					if ( budget_components_items[j].value == "" && budget_components_justifications[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["budget_components_details"].push({
							'name': budget_components_items[j].value,
							'description': budget_components_justifications[j].value,
						});
					}
				}
			}
            saveData["budget_project_relevance"] = validateEmptyFields("budget_project_relevance", "");
                saveData["equipment_a"] = validateEmptyFields("equipment_a", "");
                saveData["equipment_b"] = validateEmptyFields("equipment_b", "");
                saveData["equipment_c"] = validateEmptyFields("equipment_c", "");
                saveData["equipment_d"] = validateEmptyFields("equipment_d", "");
                saveData["equipment_e"] = validateEmptyFields("equipment_e", "");
                saveData["year_1_1"] = validateEmptyFields("year_1_1", "");
                saveData["year_1_2"] = validateEmptyFields("year_1_2", "");
                saveData["year_1_total"] = validateEmptyFields("year_1_total", "");
                saveData["year_2_1"] = validateEmptyFields("year_2_1", "");
                saveData["year_2_2"] = validateEmptyFields("year_2_2", "");
                saveData["year_2_total"] = validateEmptyFields("year_2_total", "");
                saveData["year_3_1"] = validateEmptyFields("year_3_1", "");
                saveData["year_3_2"] = validateEmptyFields("year_3_2", "");
                saveData["year_3_total"] = validateEmptyFields("year_3_total", "");
                saveData["year_4_1"] = validateEmptyFields("year_4_1", "");
                saveData["year_4_2"] = validateEmptyFields("year_4_2", "");
                saveData["year_4_total"] = validateEmptyFields("year_4_total", "");
                saveData["year_5_1"] = validateEmptyFields("year_5_1", "");
                saveData["year_5_2"] = validateEmptyFields("year_5_2", "");
                saveData["year_5_total"] = validateEmptyFields("year_5_total", "");
                saveData["year_6_1"] = validateEmptyFields("year_6_1", "");
                saveData["year_6_2"] = validateEmptyFields("year_6_2", "");
                saveData["year_6_total"] = validateEmptyFields("year_6_total", "");
                saveData["year_7_1"] = validateEmptyFields("year_7_1", "");
                saveData["year_7_2"] = validateEmptyFields("year_7_2", "");
                saveData["year_7_total"] = validateEmptyFields("year_7_total", "");
                saveData["year_8_1"] = validateEmptyFields("year_8_1", "");
                saveData["year_8_2"] = validateEmptyFields("year_8_2", "");
                saveData["year_8_total"] = validateEmptyFields("year_8_total", "");
                saveData["year_9_1"] = validateEmptyFields("year_9_1", "");
                saveData["year_9_2"] = validateEmptyFields("year_9_2", "");
                saveData["year_9_total"] = validateEmptyFields("year_9_total", "");
                saveData["year_10_1"] = validateEmptyFields("year_10_1", "");
                saveData["year_10_2"] = validateEmptyFields("year_10_2", "");
                saveData["year_10_total"] = validateEmptyFields("year_10_total", "");
                saveData["year_11_1"] = validateEmptyFields("year_11_1", "");
                saveData["year_11_2"] = validateEmptyFields("year_11_2", "");
                saveData["year_11_total"] = validateEmptyFields("year_11_total", "");
                saveData["year_12_1"] = validateEmptyFields("year_12_1", "");
                saveData["year_12_2"] = validateEmptyFields("year_12_2", "");
                saveData["year_12_total"] = validateEmptyFields("year_12_total", "");
                saveData["year_13_1"] = validateEmptyFields("year_13_1", "");
                saveData["year_13_2"] = validateEmptyFields("year_13_2", "");
                saveData["year_13_total"] = validateEmptyFields("year_13_total", "");
                saveData["year_14_1"] = validateEmptyFields("year_14_1", "");
                saveData["year_14_2"] = validateEmptyFields("year_14_2", "");
                saveData["year_14_total"] = validateEmptyFields("year_14_total", "");
                saveData["year_15_1"] = validateEmptyFields("year_15_1", "");
                saveData["year_15_2"] = validateEmptyFields("year_15_2", "");
                saveData["year_15_total"] = validateEmptyFields("year_15_total", "");
                saveData["year_16_1"] = validateEmptyFields("year_16_1", "");
                saveData["year_16_2"] = validateEmptyFields("year_16_2", "");
                saveData["year_16_total"] = validateEmptyFields("year_16_total", "");
            isSavedForm_8 = true;

        } else if (formNo==9) {
            const is_pi_belong_to_category_buttons = document.querySelectorAll('input[type="radio"][name="is_pi_belong_to_category"]');
            for (const radioButton of is_pi_belong_to_category_buttons) {
                if (radioButton.checked === true) {
                    is_pi_belong_to_category = radioButton.value;
                    break; // Exit the loop once the matching radio button is found
                }
            }
            saveData["is_pi_belong_to_category"] = is_pi_belong_to_category;
            file_category_certificate = saveData["file_category_certificate"];
            saveData["is_pi_differently_abled"] = is_pi_differently_abled;
            file_pi_diff_abled_certificate = saveData["file_pi_diff_abled_certificate"];
            
            file_pi_certification = saveData["file_pi_certification"];
            file_aadhar_card = saveData["file_aadhar_card"];
            file_principal_endorsement_certificate = saveData["file_principal_endorsement_certificate"];
            // file_registrar_endorsement_certificate = saveData["file_registrar_endorsement_certificate"];
            // file_head_inst_endorsement_certificate = saveData["file_head_inst_endorsement_certificate"];
            saveData["is_pi_non_phd"] = is_pi_non_phd;
            file_pi_bona_fide_certificate = saveData["file_pi_bona_fide_certificate"];
            file_pi_cv = saveData["file_pi_cv"];
            isSavedForm_9 = true;
        }
        saveData["form_type"] = 'save-form';
        saveData["form_no"] = formNo;
        saveData["scheme_id"] = $("#scheme_id").val();
        popUpMsg("Saving your data.","","success");
        localStorage.setItem("minorResearchProjectData", JSON.stringify(saveData));
        
        // save every response for saving user data
        callApi({
            method: 'POST',
            url: 'api/schemeMinorResearchProjectApi.php',
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
            proposed_amount = validateEmptyFields("proposed_amount", "Please enter proposed amount!");
            specialisation = validateEmptyFields("specialisation", "");
            official_address = validateEmptyFields("official_address", "Please enter Investigators official address");
            qualification = validateEmptyFields("qualification", "Please enter Investigators qualification!");
            designation = validateEmptyFields("designation", "Please enter Investigators designation");
            email = validateEmailId("email", "Please enter Investigators EMAIL ID!");
            phone_no = validatePhoneNumber("phone_no", "Investigators phone Number cannot be empty!");
            country_code = validateEmptyFields("country_code", "Country code cannot be empty!");
            dob = validateEmptyFields("dob", "Please enter Investigators Date of Birth!");
            last_name = validateEmptyFields("last_name", "Please enter Principal Investigators Last name!");
            middle_name = validateEmptyFields("middle_name", "");
            first_name = validateEmptyFields("first_name", "Please enter Principal Investigators First name!");
            if (proposed_amount && file_profile_picture &&
                official_address && qualification && designation && email && phone_no && country_code && dob && gender && last_name && first_name
            ) { 
                if (middle_name) { middle_name = validateEmptyFields("middle_name", "Please enter valid middle name!"); if (!middle_name) { return false; } }
                if (specialisation) { specialisation = validateEmptyFields("specialisation", "Please enter valid specialisation details!"); if (!specialisation) { return false; } }

                if (institute_names.length>0) {
                    for(let j=0;j<institute_names.length;j++)
                    {
                        tempIdKey = j+1;
                        if ( validateEmptyFields("institute_name_"+tempIdKey, "Please enter institution name!") ) {} else { return false; }
                        if ( validateEmptyFields("institute_address_"+tempIdKey, "Please enter institution address!") ) {} else { return false; }
                    }
                }
                
            } else { 
                if (!file_profile_picture){ popUpMsg('Please upload your profile picture.'); return false; }
                return false; 
            }
            
        } else if (formNo==1) {
            expected_outcome = validateEmptyFields("expected_outcome", "Please enter Expected outcome"); 
            objectives = validateEmptyFields("objectives", "Please enter Objectives"); 
            proposal_summary = validateEmptyFields("proposal_summary", "Please enter Summary of the research");
            broad_discipline = validateEmptyFields("broad_discipline", "Please enter Broad discipline");
            proposal_title = validateEmptyFields("proposal_title", "Please enter title of the proposal");
            if ( expected_outcome && objectives && proposal_summary && broad_discipline && proposal_title ) {
            } else { return false; }

        } else if (formNo==2) {
            project_location = validateEmptyFields("project_location", "This is required");
            proposal_objectives = validateEmptyFields("proposal_objectives", "This is required");
            proposal_significance = validateEmptyFields("proposal_significance", "This is required");
            local_status = validateEmptyFields("local_status", "");
            national_status = validateEmptyFields("national_status", "This is required");
            international_status = validateEmptyFields("international_status", "This is required");
            proposal_background = validateEmptyFields("proposal_background", "This is required");
            // && local_status 
            if ( project_location && proposal_objectives && proposal_significance && national_status && international_status && proposal_background ) {
            } else { return false; }

        } else if (formNo==3) {
            any_other_details = validateEmptyFields("any_other_details", "");
            action_plan = validateEmptyFields("action_plan", "This is required");
            if (saveData["file_time_schedule"]) {
                file_time_schedule = saveData["file_time_schedule"];
            }
            if (saveData["file_methodology"]) {
                file_methodology = saveData["file_methodology"];
            }
            methodology = validateEmptyFields("methodology", "This is required");
            if ( action_plan && methodology ) {
                if (!file_time_schedule) {
                    popUpMsg('Please upload the Time schedule of activities'); return false;
                }
            } else { return false; }

        } else if (formNo==4) {
            specific_expertise_of_pi = validateEmptyFields("specific_expertise_of_pi", "This is required");
            if ( specific_expertise_of_pi ) {
            } else { return false; }
            if (investigator_publications.length>0) {
				for(let j=0;j<investigator_publications.length;j++)
				{
                    tempIdKey = j+1;                
                    if ( validateEmptyFields("investigator_publication_"+tempIdKey, "Please enter investigators Publication!") ) {} else { return false; }
				}
			} else {
                popUpMsg('Please add at least one investigators Publication, before moving to next form!'); return false;
            }
            // bibliography = validateEmptyFields("bibliography", "This is required");
            if (bibliographies.length>0) {
				for(let j=0;j<bibliographies.length;j++)
				{
                    tempIdKey = j+1;
                    if ( validateEmptyFields("bibliography_"+tempIdKey, "Please enter reference!") ) {} else { return false; }
				}
			} else {
                popUpMsg('Please add at least one Reference, before moving to next form!'); return false;
            }

        } else if (formNo==5) {
            if (investigators_project_titles.length>0) {
                for(let j=0;j<investigators_project_titles.length;j++)
				{
                    tempIdKey = j+1;
                    temp_empty_val = $("#investigators_project_title_"+tempIdKey).val();
                    is_not_applicable = temp_empty_val ? temp_empty_val.toUpperCase() : ''; 
                    if (temp_empty_val==""
                        && $("#investigators_project_cost_"+tempIdKey).val()==""
                        && $("#investigators_project_submission_month_"+tempIdKey).val()==""
                        && $("#investigators_project_role_"+tempIdKey).val()==""
                        && $("#investigators_project_agency_"+tempIdKey).val()==""
                        && $("#investigators_project_status_"+tempIdKey).val()==""
                    ) {
                        $("#investigators_project_title_"+tempIdKey).val("NIL");

                        $("#investigators_project_cost_"+tempIdKey).prop('readonly', true);
                        $("#investigators_project_submission_month_"+tempIdKey).prop('readonly', true);
                        $("#investigators_project_role_"+tempIdKey).prop('readonly', true);
                        $("#investigators_project_agency_"+tempIdKey).prop('readonly', true);
                        $("#investigators_project_status_"+tempIdKey).prop('readonly', true);
                    } else if ( is_not_applicable==="NIL" || is_not_applicable==="NA" 
                        // && $("#investigators_project_cost_"+tempIdKey).val()==""
                        // && $("#investigators_project_submission_month_"+tempIdKey).val()==""
                        // && $("#investigators_project_role_"+tempIdKey).val()==""
                        // && $("#investigators_project_agency_"+tempIdKey).val()==""
                        // && $("#investigators_project_status_"+tempIdKey).val()==""
                    ) {
                        $("#investigators_project_title_"+tempIdKey).val(is_not_applicable);
                    } else {
                        if ( validateEmptyFields("investigators_project_title_"+tempIdKey, "Please Enter the submitted project Title!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_project_cost_"+tempIdKey, "Please Enter the submitted project Cost!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_project_submission_month_"+tempIdKey, "Please Enter the submitted project Submission month!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_project_role_"+tempIdKey, "Please Enter the role in submitted project!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_project_agency_"+tempIdKey, "Please Enter the submitted agency!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_project_status_"+tempIdKey, "Please Enter the submitted project status!") ) {} else { return false; }
				    }
				}
			} else {
                popUpMsg('Please add at least one row in investigators submitted project, before moving to next form!'); return false;
            }
            if (investigators_ongoing_project_titles.length>0) {
				for(let j=0;j<investigators_ongoing_project_titles.length;j++)
				{
                    tempIdKey = j+1;
                    temp_empty_val = $("#investigators_ongoing_project_title_"+tempIdKey).val();
                    is_not_applicable = temp_empty_val ? temp_empty_val.toUpperCase() : '';
                    if (temp_empty_val==""
                        && $("#investigators_ongoing_project_cost_"+tempIdKey).val()==""
                        && $("#investigators_ongoing_project_start_date_"+tempIdKey).val()==""
                        && $("#investigators_ongoing_project_end_date_"+tempIdKey).val()==""
                        && $("#investigators_ongoing_project_role_"+tempIdKey).val()==""
                        && $("#investigators_ongoing_project_agency_"+tempIdKey).val()==""
                    ) {
                        $("#investigators_ongoing_project_title_"+tempIdKey).val("NIL");
                        
                        $("#investigators_ongoing_project_cost_"+tempIdKey).prop('readonly', true);
                        $("#investigators_ongoing_project_start_date_"+tempIdKey).prop('readonly', true);
                        $("#investigators_ongoing_project_end_date_"+tempIdKey).prop('readonly', true);
                        $("#investigators_ongoing_project_role_"+tempIdKey).prop('readonly', true);
                        $("#investigators_ongoing_project_agency_"+tempIdKey).prop('readonly', true);
                    } else if ( is_not_applicable==="NIL" || is_not_applicable==="NA"
                        // && $("#investigators_ongoing_project_cost_"+tempIdKey).val()==""
                        // && $("#investigators_ongoing_project_start_date_"+tempIdKey).val()==""
                        // && $("#investigators_ongoing_project_end_date_"+tempIdKey).val()==""
                        // && $("#investigators_ongoing_project_role_"+tempIdKey).val()==""
                        // && $("#investigators_ongoing_project_agency_"+tempIdKey).val()==""
                    ) {
                        $("#investigators_ongoing_project_title_"+tempIdKey).val(is_not_applicable);

                    } else {
                        if ( validateEmptyFields("investigators_ongoing_project_title_"+tempIdKey, "Please Enter the ongoing project Title!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_ongoing_project_cost_"+tempIdKey, "Please Enter the ongoing project Cost!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_ongoing_project_start_date_"+tempIdKey, "Please Enter the ongoing project Start Date!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_ongoing_project_end_date_"+tempIdKey, "Please Enter the ongoing project End Date!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_ongoing_project_role_"+tempIdKey, "Please Enter the role in ongoing project!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_ongoing_project_agency_"+tempIdKey, "Please Enter the ongoing agency!") ) {} else { return false; }
				    }
				}
			} else {
                popUpMsg('Please add at least one row in investigators ongoing project, before moving to next form!'); return false;
            }
            if (investigators_completed_project_titles.length>0) {
				for(let j=0;j<investigators_completed_project_titles.length;j++)
				{
                    tempIdKey = j+1;
                    temp_empty_val = $("#investigators_completed_project_title_"+tempIdKey).val();
                    is_not_applicable = temp_empty_val ? temp_empty_val.toUpperCase() : ''; 
                    if (temp_empty_val==""
                        && $("#investigators_completed_project_cost_"+tempIdKey).val()==""
                        && $("#investigators_completed_project_start_date_"+tempIdKey).val()==""
                        && $("#investigators_completed_project_end_date_"+tempIdKey).val()==""
                        && $("#investigators_completed_project_role_"+tempIdKey).val()==""
                        && $("#investigators_completed_project_agency_"+tempIdKey).val()==""
                    ) {
                        $("#investigators_completed_project_title_"+tempIdKey).val("NIL");
                        
                        $("#investigators_completed_project_cost_"+tempIdKey).prop('readonly', true);
                        $("#investigators_completed_project_start_date_"+tempIdKey).prop('readonly', true);
                        $("#investigators_completed_project_end_date_"+tempIdKey).prop('readonly', true);
                        $("#investigators_completed_project_role_"+tempIdKey).prop('readonly', true);
                        $("#investigators_completed_project_agency_"+tempIdKey).prop('readonly', true);
                    } else if ( is_not_applicable==="NIL" || is_not_applicable==="NA" 
                        // && $("#investigators_completed_project_cost_"+tempIdKey).val()==""
                        // && $("#investigators_completed_project_start_date_"+tempIdKey).val()==""
                        // && $("#investigators_completed_project_end_date_"+tempIdKey).val()==""
                        // && $("#investigators_completed_project_role_"+tempIdKey).val()==""
                        // && $("#investigators_completed_project_agency_"+tempIdKey).val()==""
                    ) {
                        $("#investigators_completed_project_title_"+tempIdKey).val(is_not_applicable);
                    } else {
                        if ( validateEmptyFields("investigators_completed_project_title_"+tempIdKey, "Please Enter the completed project Title!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_completed_project_cost_"+tempIdKey, "Please Enter the completed project Cost!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_completed_project_start_date_"+tempIdKey, "Please Enter the completed project Start Date!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_completed_project_end_date_"+tempIdKey, "Please Enter the completed project End Date!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_completed_project_role_"+tempIdKey, "Please Enter the role in completed project!") ) {} else { return false; }
                        if ( validateEmptyFields("investigators_completed_project_agency_"+tempIdKey, "Please Enter the completed agency!") ) {} else { return false; }
                    }
				}
			} else {
                popUpMsg('Please add at least one row in investigators completed project, before moving to next form!'); return false;
            }
            
        } else if (formNo==6) {
            if (projects_impl_infra_facilities.length>0) {
				for(let j=0;j<projects_impl_infra_facilities.length;j++)
				{
                    tempIdKey = j+1;
                    temp_empty_val = $("#projects_impl_infra_facility_"+tempIdKey).val();
                    is_not_applicable = temp_empty_val ? temp_empty_val.toUpperCase() : ''; 
                    if (temp_empty_val=="") {
                        $("#projects_impl_infra_facility_"+tempIdKey).val("NIL");
                    } else if ( is_not_applicable==="NIL" || is_not_applicable==="NA" ) {
                        $("#projects_impl_infra_facility_"+tempIdKey).val(is_not_applicable);
                    } else {
                        if ( validateEmptyFields("projects_impl_infra_facility_"+tempIdKey, "Please provide the infrastructural facility!") ) {} else { return false; }
                        if ( validateEmptyFields("is_projects_impl_infra_facility_"+tempIdKey, "Please select facility status!") ) {} else { return false; }
                    } 
				}
			} else {
                popUpMsg('Please add at least one row, before moving to next form!'); return false;
            }
			if (equipment_names.length>0) {
				for(let j=0;j<equipment_names.length;j++)
				{
                    tempIdKey = j+1;
                    temp_empty_val = $("#equipment_name_"+tempIdKey).val();
                    is_not_applicable = temp_empty_val ? temp_empty_val.toUpperCase() : ''; 
                    if (temp_empty_val==""
                        && $("#equipment_model_" + tempIdKey).val()==""
                        && $("#equipment_remark_" + tempIdKey).val()==""
                        && (tempIdKey <= 2 || $("#equipment_institute_" + tempIdKey).val() == "")
                    ) {
                        $("#equipment_name_"+tempIdKey).val("NIL");

                        $("#equipment_institute_" + tempIdKey).prop('readonly', true);
                        $("#equipment_model_" + tempIdKey).prop('readonly', true);
                        $("#equipment_remark_" + tempIdKey).prop('readonly', true);
                    } else if ( is_not_applicable==="NIL" || is_not_applicable==="NA" ) {
                        $("#equipment_name_"+tempIdKey).val(is_not_applicable);
                    } else {
                        if ( validateEmptyFields("equipment_institute_"+tempIdKey, "Please enter institute name!") ) {} else { return false; }
                        if ( validateEmptyFields("equipment_name_"+tempIdKey, "Please enter equipment name!") ) {} else { return false; }
                        if ( validateEmptyFields("equipment_model_"+tempIdKey, "Please enter model, make, year of purchase!") ) {} else { return false; }
                        if ( validateEmptyFields("equipment_remark_"+tempIdKey, "Please enter accessories available and current usage!") ) {} else { return false; }
                    }
				}
			} else {
                popUpMsg('Please add at least one row, before moving to next form!'); return false;
            }

        } else if (formNo==7) {
            if (expert_guide_names.length>0) {
				for(let j=0;j<expert_guide_names.length;j++)
				{
                    tempIdKey = j+1;
                    if ( validateEmptyFields("guide_name_"+tempIdKey, "Please enter Experts/Institutions name!") ) {} else { return false; }
                    if ( validateEmptyFields("guide_address_"+tempIdKey, "Please enter address!") ) {} else { return false; }
                }
                if (expert_guide_names.length<5) {
                    popUpMsg('Provide names of at least 5 experts and/or institutions!'); return false;
                }
			}

        } else if (formNo==8) {
            budget_consolidated = validateEmptyFields("budget_consolidated", "Please enter consolidated Amount");
            // budget_components_details = validateEmptyFields("budget_components_details", "");
            if (budget_components_items.length>0) {
				for(let j=0;j<budget_components_items.length;j++)
				{
                    tempIdKey = j+1;
                    if ( validateEmptyFields("budget_components_item_"+tempIdKey, "Please enter Item name!") ) {} else { return false; }
                    if ( validateEmptyFields("budget_components_justification_"+tempIdKey, "Please enter Budget Description!") ) { } else { return false; }
				}
			}
            budget_project_relevance = validateEmptyFields("budget_project_relevance", "This is required!");
            equipment_a = validateEmptyFields("equipment_a", "");
            equipment_b = validateEmptyFields("equipment_b", "");
            equipment_c = validateEmptyFields("equipment_c", "");
            equipment_d = validateEmptyFields("equipment_d", "");
            equipment_e = validateEmptyFields("equipment_e", "");
                year_1_1 = validateEmptyFields("year_1_1", "");
                year_1_2 = validateEmptyFields("year_1_2", "");
                year_1_total = validateEmptyFields("year_1_total", "");
                year_2_1 = validateEmptyFields("year_2_1", "");
                year_2_2 = validateEmptyFields("year_2_2", "");
                year_2_total = validateEmptyFields("year_2_total", "");
                year_3_1 = validateEmptyFields("year_3_1", "");
                year_3_2 = validateEmptyFields("year_3_2", "");
                year_3_total = validateEmptyFields("year_3_total", "");
                year_4_1 = validateEmptyFields("year_4_1", "");
                year_4_2 = validateEmptyFields("year_4_2", "");
                year_4_total = validateEmptyFields("year_4_total", "");
                year_5_1 = validateEmptyFields("year_5_1", "");
                year_5_2 = validateEmptyFields("year_5_2", "");
                year_5_total = validateEmptyFields("year_5_total", "");
                year_6_1 = validateEmptyFields("year_6_1", "");
                year_6_2 = validateEmptyFields("year_6_2", "");
                year_6_total = validateEmptyFields("year_6_total", "");
                year_7_1 = validateEmptyFields("year_7_1", "");
                year_7_2 = validateEmptyFields("year_7_2", "");
                year_7_total = validateEmptyFields("year_7_total", "");
                year_8_1 = validateEmptyFields("year_8_1", "");
                year_8_2 = validateEmptyFields("year_8_2", "");
                year_8_total = validateEmptyFields("year_8_total", "");
                year_9_1 = validateEmptyFields("year_9_1", "");
                year_9_2 = validateEmptyFields("year_9_2", "");
                year_9_total = validateEmptyFields("year_9_total", "");
                year_10_1 = validateEmptyFields("year_10_1", "");
                year_10_2 = validateEmptyFields("year_10_2", "");
                year_10_total = validateEmptyFields("year_10_total", "");
                year_11_1 = validateEmptyFields("year_11_1", "");
                year_11_2 = validateEmptyFields("year_11_2", "");
                year_11_total = validateEmptyFields("year_11_total", "");
                year_12_1 = validateEmptyFields("year_12_1", "");
                year_12_2 = validateEmptyFields("year_12_2", "");
                year_12_total = validateEmptyFields("year_12_total", "");
                year_13_1 = validateEmptyFields("year_13_1", "");
                year_13_2 = validateEmptyFields("year_13_2", "");
                year_13_total = validateEmptyFields("year_13_total", "");
                year_14_1 = validateEmptyFields("year_14_1", "");
                year_14_2 = validateEmptyFields("year_14_2", "");
                year_14_total = validateEmptyFields("year_14_total", "");
                year_15_1 = validateEmptyFields("year_15_1", "");
                year_15_2 = validateEmptyFields("year_15_2", "");
                year_15_total = validateEmptyFields("year_15_total", "");
                year_16_1 = validateEmptyFields("year_16_1", "");
                year_16_2 = validateEmptyFields("year_16_2", "");
            year_16_total = validateEmptyFields("year_16_total", "");
            if ( budget_consolidated && budget_project_relevance ) {
                if (equipment_a) { equipment_a = validateEmptyFields("equipment_a", "Please enter valid Equipment A details!"); if (!equipment_a) { return false; } }
                if (equipment_b) { equipment_b = validateEmptyFields("equipment_b", "Please enter valid Equipment B details!"); if (!equipment_b) { return false; } }
                if (equipment_c) { equipment_c = validateEmptyFields("equipment_c", "Please enter valid Equipment C details!"); if (!equipment_c) { return false; } }
                if (equipment_d) { equipment_d = validateEmptyFields("equipment_d", "Please enter valid Equipment D details!"); if (!equipment_d) { return false; } }
                if (equipment_e) { equipment_e = validateEmptyFields("equipment_e", "Please enter valid Equipment E details!"); if (!equipment_e) { return false; } }
            } else { return false; }

        } else if (formNo==9) {
            if (saveData['file_pi_bona_fide_certificate']) {
                file_pi_bona_fide_certificate = saveData["file_pi_bona_fide_certificate"];
            }
            if (saveData['file_pi_cv']) {
                file_pi_cv = saveData["file_pi_cv"];
            }
            // if (saveData['file_head_inst_endorsement_certificate']) {
            //     file_head_inst_endorsement_certificate = saveData["file_head_inst_endorsement_certificate"];
            // }
            // if (saveData['file_registrar_endorsement_certificate']) {
            //     file_registrar_endorsement_certificate = saveData["file_registrar_endorsement_certificate"];
            // }
            if (saveData['file_principal_endorsement_certificate']) {
                file_principal_endorsement_certificate = saveData["file_principal_endorsement_certificate"];
            }
            if (saveData['file_aadhar_card']) {
                file_aadhar_card = saveData["file_aadhar_card"];
            }
            if (saveData['file_pi_certification']) {
                file_pi_certification = saveData["file_pi_certification"];
            }
            if (saveData['file_category_certificate']) {
                file_category_certificate = saveData["file_category_certificate"];
            }
            if (saveData['file_pi_diff_abled_certificate']) {
                file_pi_diff_abled_certificate = saveData["file_pi_diff_abled_certificate"];
            }
            // && file_registrar_endorsement_certificate && file_head_inst_endorsement_certificate 
            if ( file_pi_certification && file_aadhar_card && file_principal_endorsement_certificate && file_pi_cv ) {
                if (is_pi_non_phd==1 ) {
                    if (!file_pi_bona_fide_certificate) {
                        popUpMsg('Please upload the scanned copy of Bona fide certificate.');
                        return false;
                    }
                }
                if (is_pi_differently_abled==1) {
                    if (!file_pi_diff_abled_certificate) {
                        popUpMsg('Please upload the scanned copy stating differently abled .');
                        return false;
                    }
                }
                if (is_pi_belong_to_category==1 ) {
                    if (!file_category_certificate) {
                        popUpMsg('Please upload the scanned copy of respective category certificate.');
                        return false;
                    }
                }
            } else {
                if (!file_pi_cv || file_pi_cv==""){ popUpMsg('Please upload the scanned copy of PIs CV.'); }
                // if (!file_registrar_endorsement_certificate || file_registrar_endorsement_certificate==""){ popUpMsg('Please upload the scanned copy of endorsement certificate from registrar.'); }
                // if (!file_head_inst_endorsement_certificate || file_head_inst_endorsement_certificate==""){ popUpMsg('Please upload the scanned copy of Certificate from Head of the Institute.'); }
                if (!file_principal_endorsement_certificate || file_principal_endorsement_certificate==""){ popUpMsg('Please upload the scanned copy of endorsement certificate from principal.'); }
                if (!file_aadhar_card || file_aadhar_card==""){ popUpMsg('Please upload the scanned Aadhar Card copy of PI.'); }
                if (!file_pi_certification || file_pi_certification==""){ popUpMsg('Please upload the scanned copy certification from PI .'); }
                return false;
            }
        }
        // console.log('info:10003');
        return true;
    }
    function validateSavedData(formNo) {
        if (formNo==0) {
            if (getSavedData["institution_details"] && getSavedData["institution_details"].length>0 ) {
                if (institute_names.length == getSavedData["institution_details"].length) {
                    if (institute_names.length>0) {
                        for(let j=0;j<institute_names.length;j++)
                        {
                            if (!getSavedData["institution_details"][j]) { return false; }
                            if ( institute_address[j].value == getSavedData["institution_details"][j].address ) {} else  { return false; }
                            if ( institute_names[j].value == getSavedData["institution_details"][j].name ) {} else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

            if (proposed_amount==getSavedData["proposed_amount"] && 
                file_profile_picture==getSavedData["file_profile_picture"] &&
                specialisation==getSavedData["specialisation"] &&
                official_address==getSavedData["investigator_details"][0].official_address && 
                qualification==getSavedData["investigator_details"][0].qualification && 
                designation==getSavedData["investigator_details"][0].designation && 
                email==getSavedData["investigator_details"][0].email && 
                phone_no==getSavedData["investigator_details"][0].phone_no && 
                country_code==getSavedData["investigator_details"][0].country_code && 
                dob==getSavedData["investigator_details"][0].dob && 
                gender==getSavedData["investigator_details"][0].gender && 
                last_name==getSavedData["investigator_details"][0].last_name && 
                middle_name==getSavedData["investigator_details"][0].middle_name && 
                first_name==getSavedData["investigator_details"][0].first_name && 
                isSavedForm_0 
            ) { } else { return false; } 
        } else if (formNo==1) {
            if ( expected_outcome==getSavedData["expected_outcome"] && 
                objectives==getSavedData["objectives"] && 
                proposal_summary==getSavedData["proposal_summary"] && 
                broad_discipline==getSavedData["broad_discipline"] && 
                proposal_title==getSavedData["proposal_title"] && 
                isSavedForm_1 
            ) { } else { return false; }
        } else if (formNo==2) {
            if ( project_location==getSavedData["project_location"] && proposal_objectives==getSavedData["proposal_objectives"] && proposal_significance==getSavedData["proposal_significance"] && local_status==getSavedData["local_status"] && national_status==getSavedData["national_status"] && international_status==getSavedData["international_status"] && proposal_background==getSavedData["proposal_background"] && 
                isSavedForm_2 
            ) { } else { return false; }

        } else if (formNo==3) {
            if ( any_other_details==getSavedData["any_other_details"] && action_plan==getSavedData["action_plan"] && file_time_schedule==getSavedData["file_time_schedule"] && file_methodology==getSavedData["file_methodology"] && methodology==getSavedData["methodology"] && 
                isSavedForm_3 
            ) { } else { return false; }

        } else if (formNo==4) {
            if ( specific_expertise_of_pi==getSavedData["specific_expertise_of_pi"] && 
                isSavedForm_4 
            ) { } else { return false; }
            if (getSavedData["bibliography_details"] && getSavedData["bibliography_details"].length>0) {
                if (bibliographies.length == getSavedData["bibliography_details"].length) {
                    if (bibliographies.length>0) {
                        for(let j=0;j<bibliographies.length;j++)
                        {
                            if (!getSavedData["bibliography_details"][j]) { return false; }
                            if ( bibliographies[j].value == getSavedData["bibliography_details"][j].name ) { } else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }
            // bibliography==getSavedData["bibliography"] && 
            if (getSavedData["investigator_publications_details"] && getSavedData["investigator_publications_details"].length>0) {
                if (investigator_publications.length == getSavedData["investigator_publications_details"].length) {
                    if (investigator_publications.length>0) {
                        for(let j=0;j<investigator_publications.length;j++)
                        {
                            if (!getSavedData["investigator_publications_details"][j]) { return false; }
                            if ( investigator_publications[j].value == getSavedData["investigator_publications_details"][j].name ) { } else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }
        } else if (formNo==5) {
            if (getSavedData["scheme_submitted_project_details"] && getSavedData["scheme_submitted_project_details"].length>0 && isSavedForm_5 ) {
                let investigators_submitted_projects = getSavedData["scheme_submitted_project_details"];    
                if (investigators_project_titles.length == investigators_submitted_projects.length) {
                    if (investigators_project_titles.length>0) {
                        for(let j=0;j<investigators_project_titles.length;j++)
                        {
                            if (!getSavedData["scheme_submitted_project_details"][j]) { return false; }
                            if ( investigators_project_titles[j].value == investigators_submitted_projects[j].title ) { } else { return false; }
                            if ( investigators_project_costs[j].value == investigators_submitted_projects[j].cost_in_lakhs ) { } else { return false; }
                            if ( investigators_project_submission_months[j].value == investigators_submitted_projects[j].submission_month ) { } else { return false; }
                            if ( investigators_project_roles[j].value == investigators_submitted_projects[j].role ) { } else { return false; }
                            if ( investigators_project_agencies[j].value == investigators_submitted_projects[j].agency ) { } else { return false; }
                            if ( investigators_project_statuses[j].value == investigators_submitted_projects[j].status ) { } else { return false; }
                        } 
                    } 
                } else { return false; }
            } else { return false; }

            if (getSavedData["scheme_ongoing_project_details"] && getSavedData["scheme_ongoing_project_details"].length>0 && isSavedForm_5 ) {
                let investigators_ongoing_projects = getSavedData["scheme_ongoing_project_details"];
                if (investigators_ongoing_project_titles.length == investigators_ongoing_projects.length) {
                    if (investigators_ongoing_project_titles.length>0) {
                        for(let j=0;j<investigators_ongoing_project_titles.length;j++)
                        {
                            if (!getSavedData["scheme_ongoing_project_details"][j]) { return false; }
                            if ( investigators_ongoing_project_titles[j].value == investigators_ongoing_projects[j].title ) { } else { return false; }
                            if ( investigators_ongoing_project_costs[j].value == investigators_ongoing_projects[j].cost_in_lakhs ) { } else { return false; }
                            if ( investigators_ongoing_project_start_dates[j].value == investigators_ongoing_projects[j].start_date 
                                || (investigators_ongoing_project_start_dates[j].value=="" 
                                    && investigators_ongoing_projects[j].start_date == "0000-00-00") ) { } else { return false; }
                            if ( investigators_ongoing_project_end_dates[j].value == investigators_ongoing_projects[j].end_date 
                                || (investigators_ongoing_project_end_dates[j].value=="" 
                                    && investigators_ongoing_projects[j].end_date == "0000-00-00") ) { } else { return false; }
                            if ( investigators_ongoing_project_roles[j].value == investigators_ongoing_projects[j].role ) { } else { return false; }
                            if ( investigators_ongoing_project_agencies[j].value == investigators_ongoing_projects[j].agency ) { } else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

            if (getSavedData["scheme_completed_project_details"] && getSavedData["scheme_completed_project_details"].length>0 && isSavedForm_5 ) {
                let investigators_completed_projects = getSavedData["scheme_completed_project_details"];
                if (investigators_completed_project_titles.length == investigators_completed_projects.length) {
                    if (investigators_completed_project_titles.length>0) {
                        for(let j=0;j<investigators_completed_project_titles.length;j++)
                        {
                            if (!getSavedData["scheme_completed_project_details"][j]) { return false; }
                            if ( investigators_completed_project_titles[j].value == investigators_completed_projects[j].title ) { } else { return false; }
                            if ( investigators_completed_project_costs[j].value == investigators_completed_projects[j].cost_in_lakhs ) { } else { return false; }
                            if ( investigators_completed_project_start_dates[j].value == investigators_completed_projects[j].start_date 
                                || (investigators_completed_project_start_dates[j].value=="" 
                                    && investigators_completed_projects[j].start_date == "0000-00-00") ) { } else { return false; }
                            if ( investigators_completed_project_end_dates[j].value == investigators_completed_projects[j].end_date 
                                || (investigators_completed_project_end_dates[j].value=="" 
                                    && investigators_completed_projects[j].end_date == "0000-00-00") ) { } else { return false; }
                            if ( investigators_completed_project_roles[j].value == investigators_completed_projects[j].role ) { } else { return false; }
                            if ( investigators_completed_project_agencies[j].value == investigators_completed_projects[j].agency ) { } else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

        } else if (formNo==6) {
            if (getSavedData["infrastructural_facility_details"] && getSavedData["infrastructural_facility_details"].length>0 && isSavedForm_6 ) {
                if (projects_impl_infra_facilities.length == getSavedData["infrastructural_facility_details"].length) {
                    if (projects_impl_infra_facilities.length>0) {
                        for(let j=0;j<projects_impl_infra_facilities.length;j++)
                        {
                            if (!getSavedData["infrastructural_facility_details"][j]) { return false; }
                            if ( projects_impl_infra_facilities[j].value == getSavedData["infrastructural_facility_details"][j].title ) { } else { return false; }
                            if ( is_projects_impl_infra_facilities[j].value == getSavedData["infrastructural_facility_details"][j].status ) { } else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

            if (getSavedData["equipment_details"] && getSavedData["equipment_details"].length>0 && isSavedForm_6 ) {
                if (equipment_names.length == getSavedData["equipment_details"].length) {
                    if (equipment_names.length>0) {
                        for(let j=0;j<equipment_names.length;j++)
                        {
                            if (!getSavedData["equipment_details"][j]) { return false; }
                            if ( equipment_institutes[j].value == getSavedData["equipment_details"][j].available_with ) { } else { return false; }
                            if ( equipment_names[j].value == getSavedData["equipment_details"][j].generic_name ) { } else { return false; }
                            if ( equipment_models[j].value == getSavedData["equipment_details"][j].purchase_details ) { } else { return false; }
                            if ( equipment_remarks[j].value == getSavedData["equipment_details"][j].remarks_on_accessories ) { } else { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

        } else if (formNo==7) {
            if (getSavedData["outcome_interested_expert_details"] && getSavedData["outcome_interested_expert_details"].length>0 && isSavedForm_7 ) {
                if (expert_guide_names.length == getSavedData["outcome_interested_expert_details"].length) {
                    if (expert_guide_names.length>0) {
                        for(let j=0;j<expert_guide_names.length;j++)
                        {
                            if (!getSavedData["outcome_interested_expert_details"][j]) { return false; }
                            if ( expert_guide_names[j].value == getSavedData["outcome_interested_expert_details"][j].name ) { } else { return false; }
                            if ( expert_guide_address[j].value == getSavedData["outcome_interested_expert_details"][j].address ) { } else { return false; }
                        }
                    } 
                } else { return false; }
            } else { return false; }

        } else if (formNo==8) {
            if (budget_consolidated==getSavedData["budget_consolidated"] &&
                budget_project_relevance==getSavedData["budget_project_relevance"] &&
                equipment_a==getSavedData["equipment_a"] &&
                equipment_b==getSavedData["equipment_b"] &&
                equipment_c==getSavedData["equipment_c"] &&
                equipment_d==getSavedData["equipment_d"] &&
                equipment_e==getSavedData["equipment_e"] && 
                year_1_1==getSavedData["year_1_1"] && year_1_2==getSavedData["year_1_2"] && year_1_total==getSavedData["year_1_total"] && 
                year_2_1==getSavedData["year_2_1"] && year_2_2==getSavedData["year_2_2"] && year_2_total==getSavedData["year_2_total"] &&
                year_3_1==getSavedData["year_3_1"] && year_3_2==getSavedData["year_3_2"] && year_3_total==getSavedData["year_3_total"] &&
                year_4_1==getSavedData["year_4_1"] && year_4_2==getSavedData["year_4_2"] && year_4_total==getSavedData["year_4_total"] &&
                year_5_1==getSavedData["year_5_1"] && year_5_2==getSavedData["year_5_2"] && year_5_total==getSavedData["year_5_total"] && 
                year_6_1==getSavedData["year_6_1"] && year_6_2==getSavedData["year_6_2"] && year_6_total==getSavedData["year_6_total"] &&
                year_7_1==getSavedData["year_7_1"] && year_7_2==getSavedData["year_7_2"] && year_7_total==getSavedData["year_7_total"] &&
                year_8_1==getSavedData["year_8_1"] && year_8_2==getSavedData["year_8_2"] && year_8_total==getSavedData["year_8_total"] && 
                year_9_1==getSavedData["year_9_1"] && year_9_2==getSavedData["year_9_2"] && year_9_total==getSavedData["year_9_total"] &&
                year_10_1==getSavedData["year_10_1"] && year_10_2==getSavedData["year_10_2"] && year_10_total==getSavedData["year_10_total"] &&
                year_11_1==getSavedData["year_11_1"] && year_11_2==getSavedData["year_11_2"] && year_11_total==getSavedData["year_11_total"] &&
                year_12_1==getSavedData["year_12_1"] && year_12_2==getSavedData["year_12_2"] && year_12_total==getSavedData["year_12_total"] &&
                year_13_1==getSavedData["year_13_1"] && year_13_2==getSavedData["year_13_2"] && year_13_total==getSavedData["year_13_total"] &&
                year_14_1==getSavedData["year_14_1"] && year_14_2==getSavedData["year_14_2"] && year_14_total==getSavedData["year_14_total"] &&
                year_15_1==getSavedData["year_15_1"] && year_15_2==getSavedData["year_15_2"] && year_15_total==getSavedData["year_15_total"] &&
                year_16_1==getSavedData["year_16_1"] && year_16_2==getSavedData["year_16_2"] && year_16_total==getSavedData["year_16_total"] &&
                isSavedForm_8
            ) { 
                // budget_components_details==getSavedData["budget_components_details"] &&
                if (getSavedData["budget_components_details"] && getSavedData["budget_components_details"].length>0 ) {
                    if (budget_components_items.length == getSavedData["budget_components_details"].length) {
                        if (budget_components_items.length>0) {
                            for(let j=0;j<budget_components_items.length;j++)
                            {
                                if (!getSavedData["budget_components_details"][j]) { return false; }
                                if ( budget_components_justifications[j].value == getSavedData["budget_components_details"][j].description ) {} else  { return false; }
                                if ( budget_components_items[j].value == getSavedData["budget_components_details"][j].name ) {} else { return false; }
                            }
                        }
                    } else { return false; }
                } else { return false; }
            } else { return false; }

        } else if (formNo==9) {
            if ( is_pi_belong_to_category==getSavedData["is_pi_belong_to_category"] && 
                file_category_certificate == getSavedData["file_category_certificate"] &&
                is_pi_differently_abled==getSavedData["is_pi_differently_abled"] && 
                file_pi_diff_abled_certificate == getSavedData["file_pi_diff_abled_certificate"] &&
                file_pi_certification == getSavedData["file_pi_certification"] &&
                file_aadhar_card == getSavedData["file_aadhar_card"] &&
                file_principal_endorsement_certificate == getSavedData["file_principal_endorsement_certificate"] &&
                // file_registrar_endorsement_certificate == getSavedData["file_registrar_endorsement_certificate"] &&
                // file_head_inst_endorsement_certificate == getSavedData["file_head_inst_endorsement_certificate"] &&
                file_pi_cv == getSavedData["file_pi_cv"] && 
                file_pi_bona_fide_certificate == getSavedData["file_pi_bona_fide_certificate"] && 
                isSavedForm_9
            ) { } else { return false; }
        }
        // console.log('info:10004');
        return true;
    }
    function validateInputType(type, inputFieldId, inputFieldValue) {
        // return error message
        let trimInputFieldId = inputFieldId.slice(0, -2);
        let checkTextLength = checkText = checkTextArea = true;
        let msg = '';
        let minCharLength = 2;
        let maxCharLength = 250;
        var allowCharsLengthForID = ["projects_impl_infra_facility"];
        var allowCharsForID = [
            "investigators_project_title","investigators_project_cost","investigators_project_role","investigators_project_agency","investigators_project_status",
            "investigators_ongoing_project_title","investigators_ongoing_project_cost","investigators_ongoing_project_role","investigators_ongoing_project_agency",
            "investigators_completed_project_title","investigators_completed_project_cost","investigators_completed_project_role","investigators_completed_project_agency",
            "equipment_a","equipment_b","equipment_c","equipment_d","equipment_e"
        ];  // "broad_discipline", "proposal_title",
        
        if (allowCharsLengthForID.includes(inputFieldId)) {
            checkTextLength = false;
        }
        if (allowCharsForID.includes(inputFieldId) || allowCharsForID.includes(trimInputFieldId)) {
            checkText = false;
        } else {
            checkTextArea = false;
        }

        if (inputFieldId=="broad_discipline" || inputFieldId=="official_address"
            || trimInputFieldId=="investigator_publication" || trimInputFieldId=="bibliography"
            || trimInputFieldId=="institute_address" || trimInputFieldId=="guide_address"
            || trimInputFieldId=="budget_components_justification"
        ) {
            minCharLength = 10;
        }
        
        if (type=='text') {
            var textValFieldArrID = ["institute_name", "institute_address", "guide_name", "guide_address", "budget_components_item", "projects_impl_infra_facility",
                    "investigators_project_title", "investigators_project_role", "investigators_project_agency", "investigators_project_status", "investigators_ongoing_project_title", "investigators_ongoing_project_role", "investigators_ongoing_project_agency", "investigators_completed_project_title", "investigators_completed_project_role", "investigators_completed_project_agency"
                ];
            if (textValFieldArrID.includes(trimInputFieldId)) {
                if (inputFieldValue == '') {
                    switch (trimInputFieldId) {
                        case 'institute_name': msg = 'Institute name is required'; break;
                        case 'institute_address': msg = 'Institute address is required'; break;
                        case 'budget_components_item': msg = 'Item Name is required'; break;
                        case 'guide_name': msg = 'Experts name is required'; break;
                        case 'guide_address': msg = 'Experts address is required'; break;
                        case 'investigators_project_title': msg = 'Project title is required'; break;
                        case 'investigators_project_role': msg = 'Project role is required'; break;
                        case 'investigators_project_agency': msg = 'Project Agency is required'; break;
                        case 'investigators_project_status': msg = 'Project Status is required'; break;
                        case 'investigators_ongoing_project_title': msg = 'Project title is required'; break;
                        case 'investigators_ongoing_project_role': msg = 'Project role is required'; break;
                        case 'investigators_ongoing_project_agency': msg = 'Project Agency is required'; break;
                        case 'investigators_completed_project_title': msg = 'Project title is required'; break;
                        case 'investigators_completed_project_role': msg = 'Project role is required'; break;
                        case 'investigators_completed_project_agency': msg = 'Project Agency is required'; break;
                        default: msg = ''; break;
                    }
                } else if (checkTextLength && inputFieldValue.length < minCharLength) {
                    msg = 'must be between '+minCharLength+' and '+maxCharLength+' characters';
                    switch (trimInputFieldId) {
                        case 'institute_name': msg = 'Institute name '+msg; break;
                        case 'institute_address': msg = 'Institute address '+msg; break;
                        case 'budget_components_item': msg = 'Item Name '+msg; break;
                        case 'guide_name': msg = 'Experts name '+msg; break;
                        case 'guide_address': msg = 'Experts address '+msg; break;
                        default: msg = 'Input field '+msg; break;
                    }
                } else if (inputFieldValue.length < minCharLength) {
                    msg = 'Please enter relevant information, min '+ minCharLength +' characters';
                } else if (inputFieldValue.length > maxCharLength) {
                    msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
                } else if (/[<>]/.test(inputFieldValue)) {
                    msg = 'Invalid characters or content detected, not allowed <,>';
                } else if (!isValidEducationName(inputFieldValue) && (trimInputFieldId=='institute_name' || trimInputFieldId=='guide_name' )) {
                    msg = 'Invalid Input !'; 
                } else {
                    msg = '';
                }
            } else {
                minCharLength = 2;
                // check null fields, length, validate special characters, else return empty msg
                if (inputFieldValue === '') {   
                    switch (inputFieldId) {
                        case 'first_name': msg = 'First name is required'; break;
                        case 'last_name': msg = 'Last name is required'; break;
                        case 'email': msg = 'Email is required'; break;
                        case 'designation': msg = 'Designation is required'; break;
                        case 'qualification': msg = 'Qualification is required'; break;
                    }

                } else if (checkText && !regexOnlyTextSupportChars.test(inputFieldValue)) {
                    msg = 'Invalid input !'; 
                } else if (/[<>]/.test(inputFieldValue)) {
                    msg = 'Invalid characters or content detected, not allowed <,>';

                // } else if (!/^[a-zA-Z\s.]+$/.test(inputFieldValue) || !/^[a-zA-Z\s..]+$/.test(inputFieldValue)) {
                    // msg = 'Special characters not allowed'; 
                // } else if (inputFieldValue.length < 2 || inputFieldValue.length > maxCharLength) {
                //     msg = ' must be between 2 and '+maxCharLength+' characters';
                } else if (inputFieldValue.length < minCharLength) {
                    msg = ' must be between '+minCharLength+' and '+maxCharLength+' characters';
                    switch (inputFieldId) {
                        case 'qualification': msg = 'Last name '+msg; break;
                        case 'designation': msg = 'Name '+msg; break;
                        case 'email': msg = 'Name '+msg; break;
                        case 'phone_no': msg = 'Name '+msg; break;
                        case 'country_code': msg = 'Name '+msg; break;
                        case 'last_name': msg = 'Name '+msg; break;
                        case 'middle_name': msg = 'Name '+msg; break;
                        case 'first_name': msg = 'Name '+msg; break;
                        case 'equipment_a': msg = 'Equipment A ' +msg; break;
                        case 'equipment_b': msg = 'Equipment B ' +msg; break;
                        case 'equipment_c': msg = 'Equipment C ' +msg; break;
                        case 'equipment_d': msg = 'Equipment D ' +msg; break;
                        case 'equipment_e': msg = 'Equipment E ' +msg; break;
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
            // if (inputFieldId=="expected_outcome" || inputFieldId=="objectives" || inputFieldId=="proposal_summary" ) {
            //     checkTextLength = false;    
            // }

            if (inputFieldValue === '') {
                minCharLength = 10;
                if (inputFieldId=="broad_discipline" || inputFieldId=="proposal_title") {
                    minCharLength = 3;
                }

                switch (inputFieldId) {
                    case 'official_address': msg = 'Please enter the official address'; break;
                    case 'expected_outcome': msg = 'Expected outcome is required'; break;
                    case 'objectives': msg = 'Objectives is required'; break;
                    case 'proposal_summary': msg = 'Summary of the research is required'; break;
                    case 'broad_discipline': msg = 'Broad discipline is required'; break;
                    case 'proposal_title': msg = 'Proposal title is required'; break;
                    case 'budget_project_relevance': msg = 'Project social/local relevance is required'; break;
                    case 'any_other_details': msg = ''; break;
                    default : msg = 'Please enter relevant information'; break;
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
                    case 'dob': msg = 'Date of birth is required'; break;
                    default: msg = ''; break;
                }
                var dateValFieldArrID = [
                        "investigators_ongoing_project_start_date", "investigators_ongoing_project_end_date",
                        "investigators_completed_project_start_date", "investigators_completed_project_end_date"
                    ];
                if (dateValFieldArrID.includes(trimInputFieldId)) {
                    msg = 'Date is required!';
                }
            }
        } else if (type=='month') {
            if (inputFieldValue === '') {   
                if (trimInputFieldId=="investigators_project_submission_month") {
                    msg = 'Month of submission is required!';
                }
            }
        
        } else if (type=='number') {
            if (!/^[0-9\.]+$/.test(inputFieldValue)) {
                msg = 'Invalid Input!';
            }

            if (inputFieldValue === '') {   
                switch (inputFieldId) {
                    case 'phone_no': msg = 'Phone No is required'; break;
                    case 'proposed_amount': msg = 'Proposed amount is required'; break;
                    case 'budget_consolidated': msg = 'Please provide consolidated budget'; break;
                    // case 'year_11_1': msg = 'Hiring service fees for 1st year is required'; break;
                    // case 'year_11_total': msg = 'Please enter the total for 3 years'; break;
                    default: msg = ''; break;
                }
                
                var projectCostValFieldArrID = ["investigators_project_cost", "investigators_ongoing_project_cost", "investigators_completed_project_cost" ];
                if (projectCostValFieldArrID.includes(trimInputFieldId)) {
                    msg = 'Project cost is required';
                }
            }

        }
        // console.log('info:10005');
        return msg;
    }
    function submitForm() {
        if (validateFormData(0) && validateFormData(1) && validateFormData(2) && validateFormData(3) && validateFormData(4) && validateFormData(5) && validateFormData(6) && validateFormData(7) && validateFormData(8) && validateFormData(9) ) {
            // is data saved 
            if (validateSavedData(0) && validateSavedData(1) && validateSavedData(2) && validateSavedData(3) && validateSavedData(4) && validateSavedData(5) && validateSavedData(6) && validateSavedData(7) && validateSavedData(8) && validateSavedData(9) ) {
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
                // console.log('info:10006');
            }
        } else {
            // popUpMsg("Required fields are empty");
            // console.log('info:10007');
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
                url: 'api/schemeMinorResearchProjectApi.php',
                data: saveData,
                form_type: 'apply-scheme',
                is_loader: 'within_the_page',
            });
        } else {
            // console.log('info:10007');
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
                localStorage.setItem("minorResearchProjectData", JSON.stringify(getSavedData));
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else if (type=='apply-scheme') {
                AmagiLoader.hide();
                popUpSchemeConfirmMsg({
                    localStorageKey : 'minorResearchProjectData',
                    schemeUrl : '<?php echo $schemeUrl ?>',
                    scheme_code : scheme_code,
                    title : res.message, 
                    confirmButtonText : 'Confirm',
                    showCancelButton : false,
                });
                // generate pdf
                callApi({
                    method: 'GET',
                    url: 'api/schemeMinorResearchProjectApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
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