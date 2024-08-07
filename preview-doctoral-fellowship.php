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
                                <li>View application</li>
                            </ol>
                            <h2>
                                Application for Doctoral (Ph.D.) Fellowship
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="row d-flex justify-content-md-center content-wrap">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 inner-forms">
                    <div class="forms">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div class="col-md-6 mb-4">
                                    <h3 class="mb-5">Application Details</h3>
                                    <strong>Application No : <span id="application_no"> </span></strong>
                                </div>
                                <div class="col-md-6 mb-4 text-end tooltip-container">
                                    <a href="#" onclick="downloadApplicationForm('download-pdf');" class="btn btn-primary apply_btn my-3"><i class="bi bi-download"></i> Download </a>
                                    <span class="tooltip-text">  
                                        <strong class="star">IMPORTANT NOTE : </strong>
                                        Submit the hard copy to the GSRF Office within a week.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row mb-0">
                            <h3 class="mb-5">Personal Information</h3>
                            <div class="col-md-4 mb-4">
                                <label>First Name : </label>
                                <div id="first_name"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Middle Name : </label>
                                <div id="middle_name"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Last Name : </label>
                                <div id="last_name"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Date of Birth : </label>
                                <div id="dob"> </div>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label>Residential Address : </label>
                                <div id="res_address"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="col-md-12">Mobile No. : </label>
                                <span id="country_code"> </span>&nbsp;<span id="phone_no"> </span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Email ID : </label>
                                <div id="email"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Gender : </label>
                                <div id="gender"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Institutional Address : </label>
                                <div id="institutional_address"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Category : </label>
                                <div id="category"> </div>
                            </div>
                            <div class="col-md-8 mb-4" id="file_category_certificate_field">
                                <label>Category Certificate</label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_category_certificate" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-4 mb-4">
                                <label>Do you have Residence certificate ? </label>
                                <div id="is_domicile_certificate"> </div>
                            </div>
                            <div class="col-md-8 mb-4" id="file_domicile_certificate_field">
                                <label>Residence Certificate</label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_domicile_certificate" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12 mb-4">
                                <label for="file_profile_picture" class="form-label">User Picture</label>
                                <div class="form-check image_container width">
                                    <a href="javascript:void(0)" class="fill_image_container">
                                        <img class="row d-none" id="img_file_profile_picture" src="" alt="profile picture" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Qualification Details</h3>
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Educational Qualifications</label>
                                <table class="table table-stripped table-bordered border-light text-center no_edit">
                                    <thead class="table-light">
                                        <th>Degree</th>
                                        <th>Board/ University</th>
                                        <th>School/ College</th>
                                        <th>Year of Passing</th>
                                        <th>Percentage</th>
                                        <th>CGPA</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>SSC</th>
                                            <td><div id="board_name_1"> </div></td>
                                            <td class="text_left"><div id="college_name_1"> </div></td>
                                            <td><div id="year_of_passing_1"> </div></td>
                                            <td><div id="marks_1"> </div></td>
                                            <td><div id="cgpa_1"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>HSSC</th>
                                            <td><div id="board_name_2"> </div></td>
                                            <td class="text_left"><div id="college_name_2"> </div></td>
                                            <td><div id="year_of_passing_2"> </div></td>
                                            <td><div id="marks_2"> </div></td>
                                            <td><div id="cgpa_2"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>UG</th>
                                            <td><div id="board_name_3"> </div></td>
                                            <td class="text_left"><div id="college_name_3"> </div></td>
                                            <td><div id="year_of_passing_3"> </div></td>
                                            <td><div id="marks_3"> </div></td>
                                            <td><div id="cgpa_3"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>PG</th>
                                            <td><div id="board_name_4"> </div></td>
                                            <td class="text_left"><div id="college_name_4"> </div></td>
                                            <td><div id="year_of_passing_4"> </div></td>
                                            <td><div id="marks_4"> </div></td>
                                            <td><div id="cgpa_4"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>ANY OTHER</th>
                                            <td><div id="board_name_5"> </div></td>
                                            <td class="text_left"><div id="college_name_5"> </div></td>
                                            <td><div id="year_of_passing_5"> </div></td>
                                            <td><div id="marks_5"> </div></td>
                                            <td><div id="cgpa_5"> </div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Ph.D Details</h3>
                            <div class="col-md-8 mb-4">
                                <label>Institute/College wherein Ph.D. work is being carried out : </label>
                                <div id="phd_work_carried_out"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Are you registered with Goa University for Ph.D. ? </label>
                                <div id="is_registered_with_goa_uni"> </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label>Date of Registration : </label>
                                <div id="registration_date"> </div>
                            </div>
                            <div class="col-md-5 mb-4">
                                <label>Date of confirmation of registration : </label>
                                <div id="confirmation_date"> </div>
                            </div>
                            <div class="col-md-4 mb-4" id="file_confirmation_letter_field">
                                <label>Confirmation letter</label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_confirmation_letter" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label>Subject area in which Ph.D. is registered : </label>
                                <div id="phd_subject_area"> </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Guide Details</h3>
                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap">
                                <thead class="table-light">
                                    <th>Guide</th>
                                    <th>Name of the Guide</th>
                                    <th>Designation</th>
                                    <th>Address</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Work Details</h3>
                            <div class="col-md-6 mb-4">
                                <label>Title of the proposed work (thesis) : </label>
                                <div id="proposed_work"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Background of the work : </label>
                                <div id="work_background"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>The hypothesis proposed / Gaps identified in existing knowledge : </label>
                                <div id="hypothesis_proposed"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Objectives : </label>
                                <div id="objectives"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Materials and Methods Proposed : </label>
                                <div id="mat_and_methods_proposed"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Expected outcome : </label>
                                <div id="expected_outcome"> </div>
                            </div>
                            <!-- <div class="col-md-12 mb-4">
                                <label>References : </label>
                                <div id="imp_references"> </div>
                            </div> -->
                            <div class="col-md-12 mb-4">
                                <label>Importance of proposed work : </label>
                                <div id="imp_of_proposed_work"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">References :</h3>
                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_imp_references">
                                <thead class="table-light">
                                    <th>Sr. No</th>
                                    <th>Reference</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Proposed Work Details</h3>
                            <div class="col-md-6 mb-4">
                                <label>Have you published any papers in the proposed area? </label>
                                <div id="is_published_any_papers"> </div>
                            </div>
                            <div class="col-md-6 mb-4" id="file_published_papers_field">
                                <label>Published papers : </label><br>
                                <small class="form-text text-muted"><strong>Note: </strong>Incase of more publication/large publication size, only first page of publications/ page to be uploaded respectively.</small>
                                <small class="form-text text-muted">(Max size for scanned PDF copy is <strong>2MB</strong>)</small>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_published_papers" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Timeline (Quarterly) of the proposed study : </label>
                                <table class="table table-stripped table-bordered work_details">
                                    <thead class="table-light">
                                        <th style="width: 10%;" >Year</th>
                                        <th style="width: 10%;" >Quarter</th>
                                        <th>Proposed Work</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="4">I</th>
                                            <th>1</th>
                                            <td><div id="proposed_work_1_1"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <td><div id="proposed_work_1_2"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <td><div id="proposed_work_1_3"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <td><div id="proposed_work_1_4"> </div></td>
                                        </tr>
                                        <tr class="quarter_2 d-none">
                                            <th rowspan="4">II</th>
                                            <th>1</th>
                                            <td><div id="proposed_work_2_1"> </div></td>
                                        </tr>
                                        <tr class="quarter_2 d-none">
                                            <th>2</th>
                                            <td><div id="proposed_work_2_2"> </div></td>
                                        </tr>
                                        <tr class="quarter_2 d-none">
                                            <th>3</th>
                                            <td><div id="proposed_work_2_3"> </div></td>
                                        </tr>
                                        <tr class="quarter_2 d-none">
                                            <th>4</th>
                                            <td><div id="proposed_work_2_4"> </div></td>
                                        </tr>
                                        <tr class="quarter_3 d-none">
                                            <th rowspan="4">III</th>
                                            <th>1</th>
                                            <td><div id="proposed_work_3_1"> </div></td>
                                        </tr>
                                        <tr class="quarter_3 d-none">
                                            <th>2</th>
                                            <td><div id="proposed_work_3_2"> </div></td>
                                        </tr>
                                        <tr class="quarter_3 d-none">
                                            <th>3</th>
                                            <td><div id="proposed_work_3_3"> </div></td>
                                        </tr>
                                        <tr class="quarter_3 d-none">
                                            <th>4</th>
                                            <td><div id="proposed_work_3_4"> </div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Certificates</h3>
                            <div class="col-md-12">
                                <label>Any other information : </label><br>
                                <div id="any_other_info"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Declaration by the candidate : </label><br>
                                <a href="#" class="btn btn-outline" id="view_file_declaration_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Aadhar Card : </label><br>
                                <a href="#" class="btn btn-outline" id="view_file_aadhar_card" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Certificate from the Research Guide : </label><br>
                                <a href="#" class="btn btn-outline" id="view_file_res_guide_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label>Certificate from the Head of the institute : </label><br>
                                <a href="#" class="btn btn-outline" id="view_file_institute_head_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'layout/note-before-preview-form.php'; ?>
    
    <section class="inner-page readableContent normalFont pMax text-center pt-0 pb-5">
        <div class="container" data-aos="fade-up">
            <!-- <div class="section-header">
                <h4 class="title"> </h4>
            </div> -->
            <div class="row gx-5 multiContent">
                <div class="col-md-12">
                    <a href="#" onclick="downloadApplicationForm('download-pdf');" class="btn btn-primary apply_btn my-3"><i class="bi bi-download"></i> Download </a>
                </div>
            </div>
            <img class="bgImg left" src="assets/img/bg/group6.png" alt="">
            <img class="bgImg right" src="assets/img/bg/group7.png" alt="">
        </div>
    </section>

</main>
<!-- End #main -->
<?php
require "layout/footer.php"; 
?>
<script src="assets/js/forms-tab.js?<?php echo time() ?>"></script>
<script>
    let countryCode_json = <?php echo json_encode($countryCodeArr) ?>; 
    let categories_json = <?php echo json_encode($categoriesArr) ?>; 
    let countryCode_data, categories_data;
    var data = {};
    let schemeBatchId = "<?php echo $doctoralFellowshipRequiredDocs["scheme_batch_id"] ?>";
    
    isUserApplicableForScheme(scheme_code);
    callApi({
        method: 'GET',
        url: 'api/schemeDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
        form_type: 'preview-data',
    });

    $( document ).ready(function() {

    });


    function downloadApplicationForm(type) 
    {
        AmagiLoader.show();
        callApi({
            method: 'GET',
            url: 'api/schemeDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=download-pdf',
            form_type: 'download-pdf',
            is_loader: 'within_the_page',
        });
        // location.href ="api/schemeDoctoralFellowshipApi.php?id="+userId+'&schemeBatchId='+schemeBatchId+"&type="+type;
    }

    function getApiResponse(res, type) 
    {
        if (res.flag && res.status=='200') {
            data = res.data;

            let triggerDownloadElement = document.createElement('a');
                triggerDownloadElement.target= '_blank';
            
            if (type=='download-pdf') {
                if (res.data['file_application_form']) {
                    triggerDownloadElement.href = data['file_application_form'];
                    triggerDownloadElement.click();
                    AmagiLoader.hide();
                } else {
                    popUpMsg("Please Wait!...Fetching Data.");
                    $(".apply_btn").attr('disabled', true); 
                    AmagiLoader.show();
                    callApi({
                        method: 'GET',
                        url: 'api/schemeDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
                        form_type: 'generate-pdf',
                        is_loader: 'within_the_page',
                    });
                    // popUpMsg("We are unable to locate your application. Please contact support Team");
                }
            } else if (type=='generate-pdf') {
                popUpMsg(res.message);
                if (data['file_application_form']) {
                    setTimeout(() => {
                        $(".apply_btn").attr('disabled', false); // Enable
                        AmagiLoader.hide();
                        triggerDownloadElement.href = data['file_application_form'];
                        triggerDownloadElement.click();
                    }, 900);
                }
            
            } else if (type=='preview-data') {
                let x =
                    x_impReferences = 
                    0;
                let max_fields =
                    max_fields_impReferences = 
                    20;
                var wrapper = $(".input_fields_wrap > tbody"); 		//Fields wrapper
                var wrapper_impReferences = $(".input_fields_wrap_imp_references > tbody"); 		//Fields wrapper
                let add_button = $(".add_field_button"); 	//Add button ID
                let add_button_impReferences = $(".add_field_button_imp_references"); 	//Add button ID

                $("#application_no").text(data['application_no']);
                $("#first_name").text(data['first_name']);
                $("#middle_name").text(data['middle_name']);
                $("#last_name").text(data['last_name']);
                $("#dob").text(getToday(data['dob'], 'dmy'));
                $("#res_address").html(escapeHtml(data['res_address']));
                countryCode_data = countryCode_json.find(o => o.id === parseInt(data['country_code']));
                $("#country_code").text(countryCode_data.name);
                $("#phone_no").text(data['phone_no']);
                $("#email").text(data['email']);
                $("#gender").text(data['gender']);
                $("#institutional_address").text(data['institutional_address']);
                categories_data = categories_json.find(o => o.id === parseInt(data['category']));
                $("#category").text(categories_data.name);
                showMoreOptions('category', data['category']);
                if (data['file_category_certificate']) {
                    displayUploadedFile('docs', 'file_category_certificate', data['file_category_certificate']);
                }
                if (data['is_domicile_certificate']==1) {
                    is_domicile_certificate = 'Yes';
                } else {
                    is_domicile_certificate = 'No';
                }
                $("#is_domicile_certificate").html(escapeHtml(is_domicile_certificate));
                showMoreOptions('domicile', data['is_domicile_certificate']);
                if (data['file_domicile_certificate']) {
                    displayUploadedFile('docs', 'file_domicile_certificate', data['file_domicile_certificate']);
                }
                if (data['file_profile_picture']) {
                    displayUploadedFile('img', 'file_profile_picture', data['file_profile_picture']);
                }
                
                $("#course_1").text(data["course_1"] ?? '');
                $("#board_name_1").text(data["board_name_1"] ?? '');
                $("#college_name_1").text(data["college_name_1"] ?? '');
                $("#year_of_passing_1").text(data["year_of_passing_1"] ?? '');
                $("#marks_1").text(data["marks_1"] ?? '');
                $("#cgpa_1").text(data["cgpa_1"] ?? '');
                $("#course_2").text(data["course_2"] ?? '');
                $("#board_name_2").text(data["board_name_2"] ?? '');
                $("#college_name_2").text(data["college_name_2"] ?? '');
                $("#year_of_passing_2").text(data["year_of_passing_2"] ?? '');
                $("#marks_2").text(data["marks_2"] ?? '');
                $("#cgpa_2").text(data["cgpa_2"] ?? '');
                $("#course_3").text(data["course_3"] ?? '');
                $("#board_name_3").text(data["board_name_3"] ?? '');
                $("#college_name_3").text(data["college_name_3"] ?? '');
                $("#year_of_passing_3").text(data["year_of_passing_3"] ?? '');
                $("#marks_3").text(data["marks_3"] ?? '');
                $("#cgpa_3").text(data["cgpa_3"] ?? '');
                $("#course_4").text(data["course_4"] ?? '');
                $("#board_name_4").text(data["board_name_4"] ?? '');
                $("#college_name_4").text(data["college_name_4"] ?? '');
                $("#year_of_passing_4").text(data["year_of_passing_4"] ?? '');
                $("#marks_4").text(data["marks_4"] ?? '');
                $("#cgpa_4").text(data["cgpa_4"] ?? '');
                $("#course_5").text(data["course_5"] ?? '');
                $("#board_name_5").text(data["board_name_5"] ?? '');
                $("#college_name_5").text(data["college_name_5"] ?? '');
                $("#year_of_passing_5").text(data["year_of_passing_5"] ?? '');
                $("#marks_5").text(data["marks_5"] ?? '');
                $("#cgpa_5").text(data["cgpa_5"] ?? '');
                
                $("#phd_work_carried_out").html(escapeHtml(data["phd_work_carried_out"] ?? ''));
                if (data['is_registered_with_goa_uni']==1) {
                    is_registered_with_goa_uni = 'Yes';
                } else {
                    is_registered_with_goa_uni = 'No';
                }
                $("#is_registered_with_goa_uni").html(escapeHtml(is_registered_with_goa_uni));
                $("#registration_date").text(getToday(data['registration_date'], 'dmy'));
                $("#confirmation_date").text(getToday(data['confirmation_date'], 'dmy'));
                if (data["file_confirmation_letter"]) {
                    displayUploadedFile('docs', 'file_confirmation_letter', data["file_confirmation_letter"]);
                }
                $("#phd_subject_area").html(escapeHtml(data["phd_subject_area"]));
                
                // add more fields function
                let guideDetails = data["guide_details"];
                if ( !guideDetails || guideDetails == "null" ) {} else {
                    guideDetails.forEach(guideDetail => {
                        let guide_type = "";
                        if(x < max_fields){ 					//max input box allowed
                            if (x>1) {
                                guide_type = "Co-";
                            }
                            $(wrapper).append(`
                                <tr>
                                    <td><div id="guide_type_`+x+`">`+guide_type+`Guide</div></td>
                                    <td><div id="guide_name_`+x+`">${guideDetail['guide_name']} </div></td>
                                    <td><div id="guide_designation_`+x+`">${guideDetail['guide_designation']}</div></td>
                                    <td><div id="guide_address_`+x+`">${guideDetail['guide_address']} </div></td>
                                </tr>
                            `); //add input box
                            x++; 								//text box increment
                        }
                    });
                }
                $("#proposed_work").html(escapeHtml(data["proposed_work"]));
                $("#work_background").html(escapeHtml(data["work_background"]));
                $("#hypothesis_proposed").html(escapeHtml(data["hypothesis_proposed"]));
                $("#objectives").html(escapeHtml(data["objectives"]));
                $("#mat_and_methods_proposed").html(escapeHtml(data["mat_and_methods_proposed"]));
                $("#expected_outcome").html(escapeHtml(data["expected_outcome"]));
                // $("#imp_references").html(escapeHtml(data["imp_references"]));
                // add more fields function
                let impReferencesDetails = data["imp_references_details"];
                if ( !impReferencesDetails || impReferencesDetails == "null" ) {} else {
                    impReferencesDetails.forEach(impReferencesDetail => {
                        if(x_impReferences < max_fields_impReferences){ 					//max input box allowed
                            x_impReferences++; 								//text box increment
                            $(wrapper_impReferences).append(`
                                <tr>
                                    <td><div id="sr_no`+x_impReferences+`">`+x_impReferences+`</div></td>
                                    <td><div id="imp_references_`+x_impReferences+`">${impReferencesDetail['name']} </div></td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                $("#imp_of_proposed_work").html(escapeHtml(data["imp_of_proposed_work"]));
                if (data['is_published_any_papers']==1) {
                    is_published_any_papers = 'Yes';
                } else {
                    is_published_any_papers = 'No';
                }
                $("#is_published_any_papers").text(is_published_any_papers);
                showMoreOptions('papers_published', data['is_published_any_papers']);
                if (data['file_published_papers']) {
                    displayUploadedFile('docs', 'file_published_papers', data['file_published_papers']);
                }

                $("#proposed_work_1_1").html(escapeHtml(data["proposed_work_1_1"]));
                $("#proposed_work_1_2").html(escapeHtml(data["proposed_work_1_2"]));
                $("#proposed_work_1_3").html(escapeHtml(data["proposed_work_1_3"]));
                $("#proposed_work_1_4").html(escapeHtml(data["proposed_work_1_4"]));
                for (let index = 1; index <= 4; index++) {
                    if (data["proposed_work_2_"+index]) {
                        addProposedWork(2);
                        index=5;
                    }
                }
                $("#proposed_work_2_1").html(escapeHtml(data["proposed_work_2_1"]));
                $("#proposed_work_2_2").html(escapeHtml(data["proposed_work_2_2"]));
                $("#proposed_work_2_3").html(escapeHtml(data["proposed_work_2_3"]));
                $("#proposed_work_2_4").html(escapeHtml(data["proposed_work_2_4"]));
                for (let index = 1; index <= 4; index++) {
                    if (data["proposed_work_3_"+index]) {
                        addProposedWork(3);
                        index=5;
                    }
                }
                $("#proposed_work_3_1").html(escapeHtml(data["proposed_work_3_1"]));
                $("#proposed_work_3_2").html(escapeHtml(data["proposed_work_3_2"]));
                $("#proposed_work_3_3").html(escapeHtml(data["proposed_work_3_3"]));
                $("#proposed_work_3_4").html(escapeHtml(data["proposed_work_3_4"]));

                $("#any_other_info").html(escapeHtml(data["any_other_info"]));
                if (data["file_declaration_certificate"]) {
                    displayUploadedFile('docs', 'file_declaration_certificate', data["file_declaration_certificate"]);
                }
                if (data["file_aadhar_card"]) {
                    displayUploadedFile('docs', 'file_aadhar_card', data["file_aadhar_card"]);
                }
                if (data["file_res_guide_certificate"]) {
                    displayUploadedFile('docs', 'file_res_guide_certificate', data["file_res_guide_certificate"]);
                }
                if (data["file_institute_head_certificate"]) {
                    displayUploadedFile('docs', 'file_institute_head_certificate', data["file_institute_head_certificate"]);
                }
            }
        }
    }   
</script>
</body>
</html>