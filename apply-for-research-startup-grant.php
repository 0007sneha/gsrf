<?php 
require "layout/head.php"; 
if (!isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
$schemeUrl = "schemes-research-start-up-grants.php";
?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/generalData.php";
$isSchemeAvailableFor = "RSG"; 
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
                                <li><a href="<?php echo $schemeUrl;?>">RESEARCH START-UP GRANT</a></li>
                                <li>Apply Here</li>
                            </ol>
                            <h2>
                                Application for RESEARCH START-UP GRANT
                                <br>
                                <p>
                                    Embark on an Extraordinary Research Voyage: Apply Now for the RESEARCH START-UP GRANT 
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
                                <div class="tab-text">Employment Details</div>
                            </div>
                            <div class="tab" id="tab_2">
                                <div class="tab-number">3</div>
                                <div class="tab-text">Ph.D Details</div>
                            </div>
                            <div class="tab" id="tab_3">
                                <div class="tab-number">4</div>
                                <div class="tab-text">Institution Details</div>
                            </div>
                            <div class="tab" id="tab_4">
                                <div class="tab-number">5</div>
                                <div class="tab-text">Work Details</div>
                            </div>
                            <div class="tab" id="tab_5">
                                <div class="tab-number">6</div>
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
                                        <label for="basic-url" class="form-label star">Are you differently abled?</label>
                                        <br>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_differently_abled" id="is_differently_abled1" value="1">
                                            <label class="form-check-label" for="is_differently_abled1">
                                                yes
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <input class="form-check-input" type="radio" name="is_differently_abled" id="is_differently_abled2" value="0" checked="true">
                                            <label class="form-check-label" for="is_differently_abled2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mb-4">
                                        <span class="d-none" id="file_differently_abled_certificate_field">
                                            <label for="file_differently_abled_certificate" class="form-label star fw6">Upload certificate</label><br>
                                            <small class="form-text text-muted"><strong>Note: </strong>Please upload a valid Certificate</small>
                                            <small class="form-text text-muted">(Scanned PDF copy of max <strong>700KB</strong>)</small> <?php include "layout/tooltip-i.php"; ?> 
                                            <div class="form-check col-md-7" style="padding-left: 0;">
                                                <input type="file" id="file_differently_abled_certificate" name="file_differently_abled_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                                <?php showProgressBar('docs','file_differently_abled_certificate', ''); ?>
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
                                            <a href="#" class="btn btn-outline remove_file text-center d-none" id="remove_file_profile_picture" onclick="removeUploadedFile('img', 'file_profile_picture', 'researchStartupData'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(3,'',0,1,1); ?>
                            </div>
                            <div id="form_1" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Employment Details</h3>
                                    <div class="col-md-4 mb-4">
                                        <label for="designation" class="form-label star">Designation</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="designation" name="designation" value="" oninput="validateInput(this)" placeholder="Enter your designation" aria-describedby="designation">
                                            <span class="error-msg col-md-12" id="designation_error_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mb-4">
                                        <label for="official_address" class="form-label star">Official Address(institution)</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="official_address" id="official_address" oninput="validateInput(this)" cols="80" rows="2" required></textarea>
                                            <span class="error-msg col-md-12" id="official_address_error_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="joining_date" class="form-label star">Date of joining the present position</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" id="joining_date" name="joining_date" value="" oninput="validateInput(this)" placeholder="Enter your joining_date" aria-describedby="joining_date">
                                            <span class="error-msg col-md-12" id="joining_date_error_msg"></span>
                                        </div>
                                    </div> 
                                </div>
                                <?php showNavigationButton(0,0,1,1,2); ?>
                            </div>
                            <div id="form_2" class="tabcontent">
                                <div class="row">
                                    
                                    <h3 class="mb-5">Ph.D Details</h3>
                                    <div class="col-md-8 mb-4">
                                        <label for="thesis_title" class="form-label star">Title of Ph.D./M.D/M.S/M.D.S/M.V.Sc. thesis</label>
                                        <input type="text" class="form-control" name="thesis_title" id="thesis_title" value="" oninput="validateInput(this)" placeholder="Title of Ph.D./M.D/M.S/M.D.S/M.V.Sc. thesis" aria-describedby="">
                                        <span class="error-msg col-md-12" id="thesis_title_error_msg"></span>
                                    </div>
                                    <div class="col-md-8 mb-4">
                                        <label for="university_name" class="form-label star">University from where Ph.D./M.D/M.S/M.D.S/M.V.Sc.is obtained</label>
                                        <input type="text" class="form-control" name="university_name" id="university_name" value="" oninput="validateInput(this)" placeholder="Enter full address" aria-describedby="">
                                        <span class="error-msg col-md-12" id="university_name_error_msg"></span>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label for="year_of_obtaining_degree" class="form-label star">Year of obtaining Ph.D. degree</label>
                                        <select class="form-control" id="year_of_obtaining_degree" placeholder="YYYY" aria-describedby="year_of_obtaining_degree"></select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="broad_discipline" class="form-label star">Broad Discipline</label>
                                        <input type="text" class="form-control" name="broad_discipline" id="broad_discipline" value="" oninput="validateInput(this)" placeholder="eg. chemistry" aria-describedby="">
                                        <span class="error-msg col-md-12" id="broad_discipline_error_msg"></span>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="specialisation" class="form-label star">Specialisation</label>
                                        <input type="text" class="form-control" name="specialisation" id="specialisation" value="" oninput="validateInput(this)" placeholder="eg. inorganic chemistry , organic chemistry, industrial" aria-describedby="">
                                        <span class="error-msg col-md-12" id="specialisation_error_msg"></span>
                                    </div>
                                    <!-- <div class="col-md-8 mb-4">
                                        <label for="dissertation_thesis_title" class="form-label star">Title of the thesis/dissertation (Ph.D. /M.D/M.S/M.D.S/M.V.Sc)</label>
                                        <input type="text" class="form-control d-none" id="dissertation_thesis_title" name="dissertation_thesis_title" value="" oninput="validateInput(this)" placeholder="Enter dissertation thesis title" >
                                        <span class="error-msg col-md-12" id="dissertation_thesis_title_error_msg"></span>
                                    </div> -->
                                </div>
                                <?php showNavigationButton(0,1,2,1,3); ?>
                            </div>
                            <div id="form_3" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Institution details where the seed grant will be utilized</h3>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="institution_name">Institution Name</label>  
                                        <input type="text" id="institution_name" name="institution_name" value="" oninput="validateInput(this)" placeholder="Enter name" class="form-control">
                                        <span class="error-msg col-md-12" id="institution_name_error_msg"></span>
                                    </div>
                                    <div class="col-md-8 mb-4">
                                        <label class="form-label star" for="institution_address">Institution Address</label>  
                                        <input type="text" id="institution_address" name="institution_address" value="" oninput="validateInput(this)" placeholder="Enter complete address of the Institution" class="form-control">
                                        <span class="error-msg col-md-12" id="institution_address_error_msg"></span>
                                    </div>

                                    <div class="col-md-8 mb-4">
                                        <label for="is_running_any_project" class="form-label star">Are you running any project(s) right now?</label>
                                        <br>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <label class="form-check-label" for="is_running_any_project_1">
                                                Yes
                                                <input class="form-check-input" type="radio" name="is_running_any_project" id="is_running_any_project_1" value="1">
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block pt-1 ">
                                            <label class="form-check-label" for="is_running_any_project_2">
                                                No
                                                <input class="form-check-input" type="radio" name="is_running_any_project" id="is_running_any_project_2" value="0" checked="true">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 table-responsive mb-4 d-none" id="file_project_details_field">
                                        <label class="star"> Project Details</label>
                                        <p>Please provide full details of projects</p>
                                        <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_projectDetails">
                                            <thead class="table-light">
                                                <th>Sr. No.</th>
                                                <th>Title</th>
                                                <th>amount</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Agency</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr class="wrapper_row">
                                                    <td class="serial-number text-center">1</td>
                                                    <td>
                                                        <input type="text" class="form-control" name="project_title[]" id="project_title_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project title">
                                                        <span class="error-msg col-md-12" id="project_title_1_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="project_cost[]" id="project_cost_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="0000">
                                                        <span class="error-msg col-md-12" id="project_cost_1_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" name="project_start_date[]" id="project_start_date_1" value="" oninput="validateInput(this)" onchange="validateDate(this,'1', 'project_');" placeholder="" aria-describedby="start date">
                                                        <span class="error-msg col-md-12" id="project_start_date_1_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" name="project_end_date[]" id="project_end_date_1" value="" oninput="validateInput(this)" onchange="validateDate(this,'1', 'project_');" placeholder="" aria-describedby="End Date">
                                                        <span class="error-msg col-md-12" id="project_end_date_1_error_msg"></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="project_agency[]" id="project_agency_1" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                                        <span class="error-msg col-md-12" id="project_agency_1_error_msg"></span>
                                                    </td>
                                                    <td width="62px">
                                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Add more fields -->
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn link_btn add_field_button_projectDetails" style="text-align: inherit;">+ Add Project</button>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,2,3,1,4); ?>
                            </div>
                            <div id="form_4" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Proposed Work</h3>
                                    <div class="col-md-12 mb-4">
                                        <label for="proposed_work" class="form-label star">Write up of your proposed work</label>
                                        <p>Writeup shall contain Title, statement of the problem, objectives, materials and methods and expected outcome, in brief</p>
                                        <textarea class="form-control" name="proposed_work" id="proposed_work" oninput="validateInput(this)" onkeyup="validateWordCount('proposed_work','500')" cols="80" rows="5" placeholder="Write up of your proposed work"></textarea>
                                        Total word Count : <span id="proposed_work_display_count">0</span> / 500 words. <span id="proposed_work_error_msg" class="error-msg"></span>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="file_published_papers" class="form-label star">Published papers <span>(Minimum 3 publications)</span></label>
                                        <br>
                                        <small>Upload atleast first pages of the 3 publications (combine the first pages of the three publications into one pdf document)</small>
                                        <p>Attach a scanned PDF copy of max 2MB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check col-md-6" style="padding-left: 0;">
                                            <input type="file" id="file_published_papers" name="file_published_papers" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_published_papers_field">
                                        <?php showProgressBar('docs','file_published_papers', ''); ?>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,3,4,1,5); ?>
                            </div>
                            <div id="form_5" class="tabcontent">
                                <div class="row">
                                    <h3 class="mb-5">Certificates</h3>
                                    
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
                                        <label for="file_declaration_certificate" class="form-label star">Declaration of the candidate</label>
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
                                        <label for="file_curriculum_vitae_certificate" class="form-label star">Curriculum vitae </label>
                                        <span>(Please provide complete details) </span>
                                        <p>Attach a scanned PDF copy of max 2MB <?php include "layout/tooltip-i.php"; ?> </p>
                                        <div class="form-check" style="padding-left: 0;">
                                            <input type="file" id="file_curriculum_vitae_certificate" name="file_curriculum_vitae_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="file_curriculum_vitae_certificate_field">
                                        <?php showProgressBar('docs','file_curriculum_vitae_certificate', 'mt30'); ?>
                                    </div>

                                    <?php include 'layout/note-before-file-submission.php'; ?>

                                </div>
                                <?php showNavigationButton(0,4,5,'',''); ?>
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
    let schemeBatchId = "<?php echo $researchStartUpGrantsRequiredDocs["scheme_batch_id"] ?>";
    let form_no_saved = 0;

    let first_name=middle_name=last_name=dob=category=
        file_category_certificate=file_differently_abled_certificate=file_profile_picture
        ="";
    let is_differently_abled = is_running_any_project = 0;
    let designation=official_address=joining_date="";
    let thesis_title=university_name=year_of_obtaining_degree=broad_discipline=
        specialisation=dissertation_thesis_title="";
        
    let institution_name=institution_address="";
    let project_titles = document.getElementsByName("project_title[]");
    let project_costs = document.getElementsByName("project_cost[]");
    let project_start_dates = document.getElementsByName("project_start_date[]");
    let project_end_dates = document.getElementsByName("project_end_date[]");
    let project_agencies = document.getElementsByName("project_agency[]");

    let proposed_work ="";
    let file_published_papers=file_aadhar_card=file_declaration_certificate=file_institute_head_certificate=file_curriculum_vitae_certificate
        ="";
    
    const fileInputCategoryCertificate = document.getElementById('file_category_certificate');
    const fileInputProfilePicture = document.getElementById('file_profile_picture');
    const fileInputDifferentlyAbledCertificate = document.getElementById('file_differently_abled_certificate');
    const fileInputPublishedPapers = document.getElementById('file_published_papers');
    const fileInputPIAadharCard = document.getElementById('file_aadhar_card');
    const fileInputDeclarationCertificate = document.getElementById('file_declaration_certificate');
    const fileInputInstituteHeadCertificate = document.getElementById('file_institute_head_certificate');
    const fileInputCurriculumVitaeCertificate = document.getElementById('file_curriculum_vitae_certificate');

    let isSavedForm_0 = isSavedForm_1 = isSavedForm_2 = isSavedForm_3 = isSavedForm_4 = isSavedForm_5 = isSavedForm_6 = true; 

    // custom requirement 
    let isFileUploaded = 0;
    isUserApplicableForScheme(scheme_code);

    
	// add more fields function
	let max_fields_projectDetails = 8;
	let x_projectDetails = 1;
	var wrapper_projectDetails = $(".input_fields_wrap_projectDetails > tbody"); 		//Fields wrapper
	let add_button_projectDetails = $(".add_field_button_projectDetails"); 	//Add button ID
    $( document ).ready(function() {
        // set max date as Today 
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        document.getElementById('dob').max = today;
        document.getElementById('joining_date').max = today;
        document.getElementById('project_start_date_1').max = today;
        // document.getElementById('project_end_date_1').max = today;
        getFinancialYears();

        // set saved data
        saveData = getSavedData = JSON.parse(localStorage.getItem("researchStartupData"));
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

            if (getSavedData['category']) {
                category = getSavedData['category'];
            }
            $("#category").val(category);
            showMoreOptions('category', category);
            if (getSavedData['file_category_certificate']) {   
                file_category_certificate = getSavedData['file_category_certificate'];
                displayUploadedFile('docs', 'file_category_certificate', file_category_certificate);
            }

            if (getSavedData['is_differently_abled']) {
                is_differently_abled = getSavedData['is_differently_abled'];
            }
            $("input:radio[name=is_differently_abled]").val([is_differently_abled]);
            showMoreOptions('differently_abled', is_differently_abled);
            if (getSavedData['file_differently_abled_certificate']) {
                file_differently_abled_certificate = getSavedData['file_differently_abled_certificate'];
                displayUploadedFile('docs', 'file_differently_abled_certificate', file_differently_abled_certificate);
            }
            if (getSavedData['file_profile_picture']) {
                file_profile_picture = getSavedData['file_profile_picture'];
                displayUploadedFile('img', 'file_profile_picture', file_profile_picture);
            }

            $("#designation").val(getSavedData["designation"]);
            $("#official_address").val(getSavedData["official_address"]);
            $("#joining_date").val(getSavedData["joining_date"]);
            
            $("#thesis_title").val(getSavedData["thesis_title"]);
            $("#university_name").val(getSavedData["university_name"]);
            $("#year_of_obtaining_degree").val(getSavedData["year_of_obtaining_degree"]);
            $("#broad_discipline").val(getSavedData["broad_discipline"]);
            $("#specialisation").val(getSavedData["specialisation"]);
            // $("#dissertation_thesis_title").val(getSavedData["dissertation_thesis_title"]);

            $("#institution_name").val(getSavedData["institution_name"]);
            $("#institution_address").val(getSavedData["institution_address"]);
            if (getSavedData["is_running_any_project"]) {
                is_running_any_project = getSavedData["is_running_any_project"];
            }
            $("input:radio[name=is_running_any_project]").val([is_running_any_project]);
            showMoreOptions('running_project', is_running_any_project);
        
            if ( !getSavedData["project_details"] || getSavedData["project_details"] == "null" ) {} else {
                x_projectDetails = 0;
                getSavedData["project_details"].forEach(projectDetail => {
                    if(x_projectDetails < max_fields_projectDetails){ 					//max input box allowed
                        x_projectDetails++; 								//text box increment
                        if (x_projectDetails==1) {
                            $("#project_title_1").val(projectDetail['title']);
                            $("#project_cost_1").val(projectDetail['cost_in_lakhs']);
                            $("#project_start_date_1").val(projectDetail['start_date']);
                            $("#project_end_date_1").val(projectDetail['end_date']);
                            $("#project_agency_1").val(projectDetail['agency']);
                        } else {
                            $(wrapper_projectDetails).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_projectDetails+`</td>
                                    <td>
                                        <input type="text" class="form-control" name="project_title[]" id="project_title_`+x_projectDetails+`" value="${projectDetail['title']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project title">
                                        <span class="error-msg col-md-12" id="project_title_`+x_projectDetails+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="project_cost[]" id="project_cost_`+x_projectDetails+`" value="${projectDetail['cost_in_lakhs']}" oninput="validateInput(this)" placeholder="" aria-describedby="0000">
                                        <span class="error-msg col-md-12" id="project_cost_`+x_projectDetails+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="project_start_date[]" id="project_start_date_`+x_projectDetails+`" value="${projectDetail['start_date']}" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetails}, 'project_');"placeholder="" aria-describedby="start date">
                                        <span class="error-msg col-md-12" id="project_start_date_`+x_projectDetails+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="project_end_date[]" id="project_end_date_`+x_projectDetails+`" value="${projectDetail['end_date']}" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetails}, 'project_');" placeholder="" aria-describedby="End Date">
                                        <span class="error-msg col-md-12" id="project_end_date_`+x_projectDetails+`_error_msg"></span>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="project_agency[]" id="project_agency_`+x_projectDetails+`" value="${projectDetail['agency']}" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                                        <span class="error-msg col-md-12" id="project_agency_`+x_projectDetails+`_error_msg"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                        }
                    }
                });
            }
            $("#proposed_work").val(getSavedData["proposed_work"]);
            if (getSavedData["file_published_papers"]) {
                file_published_papers = getSavedData["file_published_papers"];
                displayUploadedFile('docs', 'file_published_papers', file_published_papers);
            }

            if (getSavedData["file_aadhar_card"]) {
                file_aadhar_card = getSavedData["file_aadhar_card"];
                displayUploadedFile('docs', 'file_aadhar_card', file_aadhar_card);
            }
            if (getSavedData["file_declaration_certificate"]) {
                file_declaration_certificate = getSavedData["file_declaration_certificate"];
                displayUploadedFile('docs', 'file_declaration_certificate', file_declaration_certificate);
            }
            if (getSavedData["file_institute_head_certificate"]) {
                file_institute_head_certificate = getSavedData["file_institute_head_certificate"];
                displayUploadedFile('docs', 'file_institute_head_certificate', file_institute_head_certificate);
            }
            if (getSavedData["file_curriculum_vitae_certificate"]) {
                file_curriculum_vitae_certificate = getSavedData["file_curriculum_vitae_certificate"];
                displayUploadedFile('docs', 'file_curriculum_vitae_certificate', file_curriculum_vitae_certificate);
            }
        } else {
            $("#form_0").addClass('d-block');
            callApi({
                method: 'GET',
                url: 'api/schemeResearchStartupGrantApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
                form_type: 'preview-data',
                is_loader: 'within_the_page',
            });
            AmagiLoader.show();
        }
        // if no data saved 
        getPresetUserData("RSG");

        $(add_button_projectDetails).click(function(e){ 			    //on add input button click
            e.preventDefault();
            x_projectDetails = project_titles.length;
            if(x_projectDetails < max_fields_projectDetails){ 					//max input box allowed
                x_projectDetails++;					                    //text box increment
                $(wrapper_projectDetails).append(`
                    <tr class="wrapper_row">
                        <td class="serial-number text-center">`+x_projectDetails+`</td>
                        <td>
                            <input type="text" class="form-control" name="project_title[]" id="project_title_`+x_projectDetails+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project title">
                            <span class="error-msg col-md-12" id="project_title_`+x_projectDetails+`_error_msg"></span>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="project_cost[]" id="project_cost_`+x_projectDetails+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="0000">
                            <span class="error-msg col-md-12" id="project_cost_`+x_projectDetails+`_error_msg"></span>
                        </td> 
                        <td>
                            <input type="date" class="form-control" name="project_start_date[]" id="project_start_date_`+x_projectDetails+`" value="" max="`+today+`" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetails}, 'project_');" placeholder="" aria-describedby="start date">
                            <span class="error-msg col-md-12" id="project_start_date_`+x_projectDetails+`_error_msg"></span>
                        </td>
                        <td>
                            <input type="date" class="form-control" name="project_end_date[]" id="project_end_date_`+x_projectDetails+`" value="" oninput="validateInput(this)" onchange="validateDate(this,${x_projectDetails}, 'project_');" placeholder="" aria-describedby="End Date">
                            <span class="error-msg col-md-12" id="project_end_date_`+x_projectDetails+`_error_msg"></span>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="project_agency[]" id="project_agency_`+x_projectDetails+`" value="" oninput="validateInput(this)" placeholder="" aria-describedby="Project agency">
                            <span class="error-msg col-md-12" id="project_agency_`+x_projectDetails+`_error_msg"></span>
                        </td>
                        <td width="62px">
                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                        </td>
                    </tr>
                `); //add input box
            }
        });
        $(wrapper_projectDetails).on("click",".remove_field", function(e){
            e.preventDefault(); 
            $(this).closest('tr').remove();
            x_projectDetails--;
            if (x_projectDetails < max_fields_projectDetails) {
                $(".add_field_button_projectDetailsCompleted").attr("disabled", false);
            }
            updateSerialNumbers(wrapper_projectDetails);
        }); // click on remove fields
        
        // add here ----------------------------------------------

    });
    
    $("#category").on("change", function() {
        category = this.value;
        showMoreOptions('category', category);
    });
    $('input:radio[name=is_differently_abled]').on("change", function() {
        is_differently_abled = this.value;
        showMoreOptions('differently_abled', is_differently_abled);
    });
    $('input:radio[name=is_running_any_project]').on("change", function() {
        is_running_any_project = this.value;
        showMoreOptions('running_project', is_running_any_project);
    });

    function getFinancialYears() {
        let getCurrentYear = new Date().getFullYear();
        // Set Default value for years
        $("#year_of_obtaining_degree").empty();
        for (let index = getCurrentYear; index >= 1900; index--) {
            $("#year_of_obtaining_degree").append('<option value="'+index+'">'+index+'</option>');
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
                    'storage_key' : 'researchStartupData'
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
                    'storage_key' : 'researchStartupData'
                });
                isSavedForm_0 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputDifferentlyAbledCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_differently_abled_certificate', 
                    'file_id' : fileInputDifferentlyAbledCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'researchStartupData'
                });
                isSavedForm_0 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });

        fileInputPublishedPapers.addEventListener('change', async (event) => {
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
                    'file_id' : fileInputPublishedPapers, 
                    'file_data' : fileData, 
                    'storage_key' : 'researchStartupData',
                    'max_file_upload_size' : 2,
                });
                isSavedForm_4 = false;
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
                    'storage_key' : 'researchStartupData'
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
                    'storage_key' : 'researchStartupData'
                });
                isSavedForm_5 = false;
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
                    'storage_key' : 'researchStartupData'
                });
                isSavedForm_5 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputCurriculumVitaeCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_curriculum_vitae_certificate', 
                    'file_id' : fileInputCurriculumVitaeCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'researchStartupData',
                    'max_file_upload_size': 2
                });
                isSavedForm_5 = false;
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
            saveData["category"] = category;
            saveData["is_differently_abled"] = is_differently_abled; 
            file_category_certificate = saveData["file_category_certificate"];
            file_differently_abled_certificate = saveData["file_differently_abled_certificate"];
            file_profile_picture = saveData["file_profile_picture"];
            isSavedForm_0 = true;
            
        } else if (formNo==1) {
            saveData["designation"] = validateEmptyFields("designation", "");
            saveData["official_address"] = validateEmptyFields("official_address", "");
            saveData["joining_date"] = validateEmptyFields("joining_date", "");
            isSavedForm_1 = true;

        } else if (formNo==2) {
            saveData["thesis_title"] = validateEmptyFields("thesis_title", "");
            saveData["university_name"] = validateEmptyFields("university_name", "");
            saveData["year_of_obtaining_degree"] = validateEmptyFields("year_of_obtaining_degree", "");
            saveData["broad_discipline"] = validateEmptyFields("broad_discipline", "");
            saveData["specialisation"] = validateEmptyFields("specialisation", "");
            // saveData["dissertation_thesis_title"] = validateEmptyFields("dissertation_thesis_title", "");
            isSavedForm_2 = true;

        } else if (formNo==3) {
            saveData["institution_name"] = validateEmptyFields("institution_name", "");
            saveData["institution_address"] = validateEmptyFields("institution_address", "");
            saveData["is_running_any_project"] = is_running_any_project;
            
            saveData["project_details"] = [];
            if (project_titles.length>0) {
				for(let j=0;j<project_titles.length;j++)
				{
					if ( project_titles[j].value == "" ) {
						// do nothing all fields are empty  
					} else {
						saveData["project_details"].push({
                            'project_status' : 'ongoing',
                            'type' : 'other',
                            'title' : project_titles[j].value,
                            'cost_in_lakhs' : project_costs[j].value,
                            'start_date' : project_start_dates[j].value,
                            'end_date' : project_end_dates[j].value,
                            'agency' : project_agencies[j].value,
						});
					}
				}
			}
            isSavedForm_3 = true;

        } else if (formNo==4) {
            saveData["proposed_work"] = validateEmptyFields("proposed_work", "");
            file_published_papers = saveData["file_published_papers"];
            isSavedForm_4 = true;

        } else if (formNo==5) {
            file_aadhar_card = saveData["file_aadhar_card"];
            file_declaration_certificate = saveData["file_declaration_certificate"];
            file_institute_head_certificate = saveData["file_institute_head_certificate"];
            file_curriculum_vitae_certificate = saveData["file_curriculum_vitae_certificate"];
            isSavedForm_5 = true;
        }
        saveData["form_type"] = 'save-form';
        saveData["form_no"] = formNo;
        saveData["scheme_id"] = $("#scheme_id").val();
        popUpMsg("Saving your data.","","success");
        localStorage.setItem("researchStartupData", JSON.stringify(saveData));

        // save every response for saving user data
        callApi({
            method: 'POST',
            url: 'api/schemeResearchStartupGrantApi.php',
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
            if (saveData['file_differently_abled_certificate']) {
                file_differently_abled_certificate = saveData['file_differently_abled_certificate'];
            }
            if (saveData['file_category_certificate']) {   
                file_category_certificate = saveData['file_category_certificate'];
            }
            dob = validateEmptyFields("dob", "Please enter your Date of Birth!");
            last_name = validateEmptyFields("last_name", "Last name cannot be empty, Please enter Last name!");
            middle_name = validateEmptyFields("middle_name", "");
            first_name = validateEmptyFields("first_name", "First name cannot be empty, Please enter First name!");
            
            if (first_name && last_name && dob && file_profile_picture && category!=0 ) {
                if (is_differently_abled==1) {
                    if (!file_differently_abled_certificate){ popUpMsg('Please upload the disability certificate.'); return false; }
                }
                if (category==0 || category==2) { } else {
                    if (!file_category_certificate){ popUpMsg('Please upload the certificate.'); return false; }
                }
                if (!file_profile_picture){ popUpMsg('Please upload your profile picture.'); return false; }
            } else {
                if (category==0){ popUpMsg('Please select the category, first.'); return false; }
                if (category==0 || category==2) { } else {
                    if (!file_category_certificate){ popUpMsg('Please upload the certificate.'); return false; }
                }
                if (!file_profile_picture){ popUpMsg('Please upload your profile picture.'); return false; }
                return false;
            }
            
        } else if (formNo==1) {
            joining_date = validateEmptyFields("joining_date", "Please select date of joining");
            official_address = validateEmptyFields("official_address", "Please enter the official address.");
            designation = validateEmptyFields("designation", "Please enter the designation.");
            if (joining_date && official_address && designation ) { } else { return false; }

        } else if (formNo==2) {
            // dissertation_thesis_title = validateEmptyFields("dissertation_thesis_title", "This field is required!!");
            specialisation = validateEmptyFields("specialisation", "This field is required!!");
            broad_discipline = validateEmptyFields("broad_discipline", "This field is required!!");
            year_of_obtaining_degree = validateEmptyFields("year_of_obtaining_degree", "This field is required!!");
            university_name = validateEmptyFields("university_name", "This field is required!!");
            thesis_title = validateEmptyFields("thesis_title", "This field is required!!");
            if (thesis_title && university_name && year_of_obtaining_degree && broad_discipline && specialisation  ) {
            } else { return false; }

        } else if (formNo==3) {
            institution_address = validateEmptyFields("institution_address", "This field is required!!");
            institution_name = validateEmptyFields("institution_name", "This field is required!!");

            if (is_running_any_project==1) {
                if (project_titles.length>0) {
                    for(let j=0;j<project_titles.length;j++)
                    {
                        let tempIdKey = j+1;
                        if ( validateEmptyFields("project_title_"+tempIdKey, "Please Enter the project Title!") ) {} else { return false; }
                        if ( validateEmptyFields("project_cost_"+tempIdKey, "Please Enter the project Cost!") ) {} else { return false; }
                        if ( validateEmptyFields("project_start_date_"+tempIdKey, "Please Enter the project Start Date!") ) {} else { return false; }
                        if ( validateEmptyFields("project_end_date_"+tempIdKey, "Please Enter the project End Date!") ) {} else { return false; }
                        if ( validateEmptyFields("project_agency_"+tempIdKey, "Please Enter the agency!") ) {} else { return false; }
                    }
                } else {
                    popUpMsg('Please add project details!'); return false;
                }
            }
            if (institution_name && institution_address) { } else { return false; }

        } else if (formNo==4) {
            if (saveData['file_published_papers']) {
                file_published_papers = saveData["file_published_papers"];
            }
            proposed_work = validateEmptyFields("proposed_work", "Please enter the required details! ");
            if ( proposed_work)  { 
                if (!file_published_papers || file_published_papers==""){ popUpMsg('Please upload the scanned copy of Published Papers.'); return false; }
            } else { return false; }

        } else if (formNo==5) {
            if (saveData['file_aadhar_card']) {
                file_aadhar_card = saveData["file_aadhar_card"];
            }
            if (saveData['file_curriculum_vitae_certificate']) {
                file_curriculum_vitae_certificate = saveData["file_curriculum_vitae_certificate"];
            }
            if (saveData['file_institute_head_certificate']) {
                file_institute_head_certificate = saveData["file_institute_head_certificate"];
            }
            if (saveData['file_declaration_certificate']) {
                file_declaration_certificate = saveData["file_declaration_certificate"];
            }
            if ( file_aadhar_card && file_declaration_certificate && file_institute_head_certificate && file_curriculum_vitae_certificate ) {
            } else {
                if (!file_aadhar_card || file_aadhar_card==""){ popUpMsg('Please upload the scanned Aadhar Card copy.'); }
                if (!file_curriculum_vitae_certificate || file_curriculum_vitae_certificate==""){ popUpMsg('Please upload the scanned copy of Curriculum Vitae.'); }
                if (!file_institute_head_certificate || file_institute_head_certificate==""){ popUpMsg('Please upload the scanned copy of Certificate from Head of the Institute.'); }
                if (!file_declaration_certificate || file_declaration_certificate==""){ popUpMsg('Please upload the scanned copy Self declaration Certificate.'); }
                return false;
            }
        }
        return true;
    }
    function validateSavedData(formNo) {
        if (formNo==0) {
            if ( first_name==getSavedData["first_name"] && middle_name==getSavedData["middle_name"] && 
                last_name==getSavedData["last_name"] && dob==getSavedData["dob"] && 
                is_differently_abled==getSavedData["is_differently_abled"] && category==getSavedData["category"] && 
                file_profile_picture==getSavedData["file_profile_picture"] &&
                isSavedForm_0 ) { } else { return false; } 

        } else if (formNo==1) {
            if (designation==getSavedData["designation"] && official_address==getSavedData["official_address"] && joining_date==getSavedData["joining_date"] &&
                isSavedForm_1 ) { } else { return false; } 
                
        } else if (formNo==2) {
            // dissertation_thesis_title==getSavedData["dissertation_thesis_title"] &&
            if (thesis_title==getSavedData["thesis_title"] && university_name==getSavedData["university_name"] && year_of_obtaining_degree==getSavedData["year_of_obtaining_degree"] && 
                broad_discipline==getSavedData["broad_discipline"] && specialisation==getSavedData["specialisation"] && 
                isSavedForm_2 ) { } else { return false; } 
                
        } else if (formNo==3) {
            if (institution_name==getSavedData["institution_name"] && 
                institution_address==getSavedData["institution_address"] && 
                is_running_any_project==getSavedData["is_running_any_project"] &&
                isSavedForm_3 ) { } else { return false; } 
                
            if (is_running_any_project==1) {
                if (getSavedData["project_details"] && getSavedData["project_details"].length>0) {
                    let project_details = getSavedData["project_details"];
                    if (project_titles.length == project_details.length) {
                        if (project_titles.length>0) {
                            for(let j=0;j<project_titles.length;j++)
                            {
                                if (!project_details[j]) { return false; }
                                if ( project_titles[j].value == project_details[j].title ) { } else { return false; }
                                if ( project_costs[j].value == project_details[j].cost_in_lakhs ) { } else { return false; }
                                if ( project_start_dates[j].value == project_details[j].start_date ) { } else { return false; }
                                if ( project_end_dates[j].value == project_details[j].end_date ) { } else { return false; }
                                if ( project_agencies[j].value == project_details[j].agency ) { } else { return false; }
                            }
                        }
                    } else { return false; }
                } else { return false; }
            }
        
        } else if (formNo==4) {
            if ( proposed_work==getSavedData["proposed_work"] && file_published_papers==getSavedData["file_published_papers"] &&
                isSavedForm_4 ) { } else { return false; } 

        } else if (formNo==5) {
            if ( file_aadhar_card==getSavedData["file_aadhar_card"] && file_curriculum_vitae_certificate==getSavedData["file_curriculum_vitae_certificate"] && file_declaration_certificate==getSavedData["file_declaration_certificate"] && 
                file_institute_head_certificate==getSavedData["file_institute_head_certificate"] &&
                isSavedForm_5 ) { } else { return false; } 
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
        var allowCharsForID = ["thesis_title", "institution_address","broad_discipline"];
        
        if (allowCharsForID.includes(inputFieldId)) {
            checkText = false;
        }
        //  else {
            // maxCharLength = 100;
        // }
        // if (inputFieldId=="aaa") {
        //     checkTextValidate = false;
        //     checkTextLength = false;
        // }
        
        if (type=='text') {
            if (inputFieldValue === '') {   
                switch (inputFieldId) {
                    case 'first_name': msg = 'First name is required'; break;
                    case 'last_name': msg = 'Last name is required'; break;
                    case 'designation': msg = 'Designation name is required'; break;
                    case 'thesis_title': msg = 'Title of the thesis is required'; break;
                    case 'university_name': msg = 'University name is required'; break;
                    case 'broad_discipline': msg = 'Broad Discipline is required'; break;
                    case 'specialisation': msg = 'Specialisation is required'; break;
                    case 'dissertation_thesis_title': msg = 'Title of the thesis/dissertation is required'; break;
                    case 'institution_name': msg = 'Name of the institution is required'; break;
                    case 'institution_address': msg = 'Complete address of the institution is required'; break;
                    default: msg = ''; break;
                }
                switch (trimInputFieldId) {
                    case 'project_title': msg = 'Project title is required'; break;
                    case 'project_agency': msg = 'Project Agency is required'; break;
                    default: msg = ''; break;
                }
                
            } else if (checkText && !regexOnlyTextSupportChars.test(inputFieldValue)) {
                msg = 'Invalid input !'; 
            } else if (checkTextArea && /[<>]/.test(inputFieldValue)) {
                msg = 'Invalid characters or content detected, not allowed <,>';
            } else if (checkTextLength && inputFieldValue.length < minCharLength) {
                msg = ' must be between '+minCharLength+' and '+maxCharLength+' characters';
                switch (inputFieldId) {
                    case 'first_name': msg = 'First name '+msg; break;
                    case 'last_name': msg = 'Last name '+msg; break;
                    case 'designation': msg = 'Designation title '+msg; break;
                    case 'thesis_title': msg = 'Title of the thesis '+msg; break;
                    case 'university_name': msg = 'University name '+msg; break;
                    case 'broad_discipline': msg = 'Broad Discipline '+msg; break;
                    case 'specialisation': msg = 'Specialisation '+msg; break;
                    case 'dissertation_thesis_title': msg = 'Title of the thesis/dissertation '+msg; break;
                    case 'institution_name': msg = 'Name of the institution '+msg; break;
                    case 'institution_address': msg = 'Institution address '+msg; break;
                    default: msg = 'Input field '+msg; break;
                }
            } else if (inputFieldValue.length > maxCharLength) {
                msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
            } else if (!isValidEducationName(inputFieldValue) && (trimInputFieldId=='institute_name' || trimInputFieldId=='guide_name' )) {
                msg = 'Invalid Input !'; 
            // } else if (!/^[a-zA-Z\s.]+$/.test(inputFieldValue)) {
            //     msg = 'Special characters not allowed'; 
            } else {
                msg = '';
            }

        } else if (type=='textarea') {
            maxCharLength = 4000;
            minCharLength = 10;
            if (inputFieldValue === '') {
                msg = 'This is required';
                // if (checkTextLength) {
                //     msg = 'Address is required';
                // } else {
                    // if (checkTextValidate) {
                    //     msg = 'This is required';
                    // }
                // }
                switch (inputFieldId) {
                    case 'proposed_work': msg = 'Please add write up of your proposed work'; break;
                    case 'official_address': msg = 'Please enter institution address'; break;
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
        } else if (type=='date') {
            if (inputFieldValue === '') {   
                switch (inputFieldId) {
                    case 'dob': msg = 'Please provide date of birth'; break;
                    case 'joining_date': msg = 'Please provide the joining date'; break;
                    case 'year_of_obtaining_degree': msg = 'Please provide the date when you obtained the degree'; break;
                    default: msg = ''; break;
                }

                var dateValFieldArrID = [
                        "project_start_date", "project_end_date"
                    ];
                if (dateValFieldArrID.includes(trimInputFieldId)) {
                    msg = 'Date is required!';
                }
            }
        } else if (type=='number') {
            if (!/^[0-9\.]+$/.test(inputFieldValue)) {
                msg = 'Invalid Input!';
            }

            if (inputFieldValue === '') {   
                var projectCostValFieldArrID = ["project_cost" ];
                if (projectCostValFieldArrID.includes(trimInputFieldId)) {
                    msg = 'Project cost is required';
                }
            }
        }

        return msg;
    }

    function submitForm() {
        if (validateFormData(0) && validateFormData(1) && validateFormData(2) && validateFormData(3) && validateFormData(4) && validateFormData(5)) {
            // is data saved 
            if (validateSavedData(0) && validateSavedData(1) && validateSavedData(2) && validateSavedData(3) && validateSavedData(4) && validateSavedData(5)) {
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
                url: 'api/schemeResearchStartupGrantApi.php',
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
                localStorage.setItem("researchStartupData", JSON.stringify(getSavedData));
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else if (type=='apply-scheme') {
                AmagiLoader.hide();
                popUpSchemeConfirmMsg({
                    localStorageKey : 'researchStartupData',
                    schemeUrl : '<?php echo $schemeUrl ?>',
                    scheme_code : scheme_code,
                    title : res.message, 
                    confirmButtonText : 'Confirm',
                    showCancelButton : false,
                });
                // generate pdf
                callApi({
                    method: 'GET',
                    url: 'api/schemeResearchStartupGrantApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
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