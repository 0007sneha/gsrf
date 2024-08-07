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
                                <li>View application</li>
                            </ol>
                            <h2>
                                Application for Post-Doctoral (Ph.D.) Fellowship
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
                                <label>Do you have resident certificate ? </label>
                                <div id="is_domicile_certificate"> </div>
                            </div>
                            <div class="col-md-8 mb-4" id="file_domicile_certificate_field">
                                <label>Resident Certificate</label>
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
                                        <th class="d-none">CGPA</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>SSC</th>
                                            <td><div id="board_name_1"> </div></td>
                                            <td class="text_left"><div id="college_name_1"> </div></td>
                                            <td><div id="year_of_passing_1"> </div></td>
                                            <td><div id="marks_1"> </div></td>
                                            <td class="d-none"><div id="cgpa_1"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>HSSC</th>
                                            <td><div id="board_name_2"> </div></td>
                                            <td class="text_left"><div id="college_name_2"> </div></td>
                                            <td><div id="year_of_passing_2"> </div></td>
                                            <td><div id="marks_2"> </div></td>
                                            <td class="d-none"><div id="cgpa_2"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>UG</th>
                                            <td><div id="board_name_3"> </div></td>
                                            <td class="text_left"><div id="college_name_3"> </div></td>
                                            <td><div id="year_of_passing_3"> </div></td>
                                            <td><div id="marks_3"> </div></td>
                                            <td class="d-none"><div id="cgpa_3"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>PG</th>
                                            <td><div id="board_name_4"> </div></td>
                                            <td class="text_left"><div id="college_name_4"> </div></td>
                                            <td><div id="year_of_passing_4"> </div></td>
                                            <td><div id="marks_4"> </div></td>
                                            <td class="d-none"><div id="cgpa_4"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>Ph.D</th>
                                            <td><div id="board_name_5"> </div></td>
                                            <td class="text_left"><div id="college_name_5"> </div></td>
                                            <td><div id="year_of_passing_5"> </div></td>
                                            <td><div id="marks_5"> </div></td>
                                            <td class="d-none"><div id="cgpa_5"> </div></td>
                                        </tr>
                                        <tr>
                                            <th>ANY OTHER</th>
                                            <td><div id="board_name_6"> </div></td>
                                            <td class="text_left"><div id="college_name_6"> </div></td>
                                            <td><div id="year_of_passing_6"> </div></td>
                                            <td><div id="marks_6"> </div></td>
                                            <td class="d-none"><div id="cgpa_6"> </div></td>
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
                                <label>Title of the Ph.D. thesis : </label>
                                <div id="phd_thesis"> </div>
                            </div>
                            <div class="col-md-4 mb-4" id="file_phd_degree_field">
                                <label>PhD degree/award communication</label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_phd_degree" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Ph.D. Research Guide Name</label>
                                <div id="phd_research_guide_name"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Ph.D. Research Guide Designation</label>
                                <div id="phd_research_guide_designation"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>University from which Ph.D. degree is obtained </label>
                                <div id="phd_degree_obtained_university"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Institution in which you worked for your Ph.D </label>
                                <div id="phd_work_carried_out"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>The University / Institution in which you propose to carry out your Post-Doctoral work</label>
                                <div id="phd_work_proposed_institution"> </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Mentor Details</h3>
                            <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap">
                                <thead class="table-light">
                                    <th>Name of the Mentor</th>
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
                                <label>Title of the proposed work :</label>
                                <div id="proposed_work"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Broad discipline :</label>
                                <div id="broad_discipline"> </div>
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
                            <div class="col-md-12 mb-4">
                                <label>References : </label>
                                <div id="imp_references"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Importance of proposed work : </label>
                                <div id="imp_of_proposed_work"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Expertise of the Mentor in the proposed area : </label>
                                <div id="expertise_of_mentor"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>List of your publications : </label>
                                <p>All relevant ones</p>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_list_of_publications">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Publications</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Proposed Work Details</h3>
                            <div class="col-md-6 mb-4">
                                <label>Have you published any papers in the proposed area of research?</label>
                                <div id="is_published_any_papers"> </div>
                            </div>
                            <div class="col-md-6 mb-4" id="file_published_papers_field">
                                <label>Published papers : </label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_published_papers" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Timeline (Quarterly) of the proposed study : </label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_proposed_study_timeline" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Certificates</h3>
                            <div class="col-md-6">
                                <label>Certificate from the mentor that he approves the research proposal : </label>
                                <a href="#" class="btn btn-outline" id="view_file_res_guide_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Declaration by the candidate : </label>
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
                            <div class="col-md-6">
                                <label>Endorsement from the Head of the institute : </label>
                                <a href="#" class="btn btn-outline" id="view_file_institute_head_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-5">
                                <label>CV of the candidate : </label>
                                <a href="#" class="btn btn-outline" id="view_file_candidate_cv" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div> 
                        <div class="row mb-5">
                            <div class="col-md-5">
                                <label>CV of the mentor : </label>
                                <a href="#" class="btn btn-outline" id="view_file_mentor_cv" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'layout/note-before-preview-form.php'; ?>

    <section class="inner-page readableContent normalFont pMax text-center">
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
    var getSavedData = {};
    let schemeBatchId = "<?php echo $postDoctoralFellowshipRequiredDocs["scheme_batch_id"] ?>";
    
    isUserApplicableForScheme(scheme_code);
    callApi({
        method: 'GET',
        url: 'api/schemePostDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
        form_type: 'preview-data',
    });

    $( document ).ready(function() {
    
    });
    
    function downloadApplicationForm(type) 
    {
        AmagiLoader.show();
        callApi({
            method: 'GET',
            url: 'api/schemePostDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=download-pdf',
            form_type: 'download-pdf',
            is_loader: 'within_the_page',
        });
        // location.href ="api/schemePostDoctoralFellowshipApi.php?id="+userId+'&schemeBatchId='+schemeBatchId+"&type="+type;
    }

    function getApiResponse(res, type) 
    {
        if (res.flag && res.status=='200') {
            data = res.data;
            
            let triggerDownloadElement = document.createElement('a');
                triggerDownloadElement.target= '_blank';
            
            if (type=='download-pdf') {
                if (res.data['file_application_form']) {
                    triggerDownloadElement.href = res.data['file_application_form'];
                    triggerDownloadElement.click();
                    AmagiLoader.hide();
                } else {
                    popUpMsg("Please Wait!...Fetching Data.");
                    $(".apply_btn").attr('disabled', true); 
                    AmagiLoader.show();
                    callApi({
                        method: 'GET',
                        url: 'api/schemePostDoctoralFellowshipApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
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
                    x_list_of_publications = 
                    0;
                let max_fields = 
                    max_fields_list_of_publications = 
                    20;
                var wrapper = $(".input_fields_wrap > tbody"); 		//Fields wrapper
                var wrapper_list_of_publications = $(".input_fields_wrap_list_of_publications > tbody"); 		//Fields wrapper
                
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
                $("#is_domicile_certificate").text(is_domicile_certificate);
                showMoreOptions('domicile', data['is_domicile_certificate']);
                if (data['file_domicile_certificate']) {
                    displayUploadedFile('docs', 'file_domicile_certificate', data['file_domicile_certificate']);
                }
                if (data['file_profile_picture']) {
                    displayUploadedFile('img', 'file_profile_picture', data['file_profile_picture']);
                }
                
                $("#course_1").text(data["course_1"]);
                $("#board_name_1").text(data["board_name_1"]);
                $("#college_name_1").text(data["college_name_1"]);
                $("#year_of_passing_1").text(data["year_of_passing_1"]);
                $("#marks_1").text(data["marks_1"]);
                $("#cgpa_1").text(data["cgpa_1"]);
                $("#course_2").text(data["course_2"]);
                $("#board_name_2").text(data["board_name_2"]);
                $("#college_name_2").text(data["college_name_2"]);
                $("#year_of_passing_2").text(data["year_of_passing_2"]);
                $("#marks_2").text(data["marks_2"]);
                $("#cgpa_2").text(data["cgpa_2"]);
                $("#course_3").text(data["course_3"]);
                $("#board_name_3").text(data["board_name_3"]);
                $("#college_name_3").text(data["college_name_3"]);
                $("#year_of_passing_3").text(data["year_of_passing_3"]);
                $("#marks_3").text(data["marks_3"]);
                $("#cgpa_3").text(data["cgpa_3"]);
                $("#course_4").text(data["course_4"]);
                $("#board_name_4").text(data["board_name_4"]);
                $("#college_name_4").text(data["college_name_4"]);
                $("#year_of_passing_4").text(data["year_of_passing_4"]);
                $("#marks_4").text(data["marks_4"]);
                $("#cgpa_4").text(data["cgpa_4"]);
                $("#course_5").text(data["course_5"]);
                $("#board_name_5").text(data["board_name_5"]);
                $("#college_name_5").text(data["college_name_5"]);
                $("#year_of_passing_5").text(data["year_of_passing_5"]);
                $("#marks_5").text(data["marks_5"]);
                $("#cgpa_5").text(data["cgpa_5"]);
                $("#course_6").text(data["course_6"]);
                $("#board_name_6").text(data["board_name_6"]);
                $("#college_name_6").text(data["college_name_6"]);
                $("#year_of_passing_6").text(data["year_of_passing_6"]);
                $("#marks_6").text(data["marks_6"]);
                $("#cgpa_6").text(data["cgpa_6"]);

                $("#phd_thesis").html(escapeHtml(data["phd_thesis"]));
                if (data["file_phd_degree"]) {
                    displayUploadedFile('docs', 'file_phd_degree', data["file_phd_degree"]);
                }
                $("#phd_research_guide_name").text(data["phd_research_guide_name"]);
                $("#phd_research_guide_designation").text(data["phd_research_guide_designation"]);
                $("#phd_degree_obtained_university").text(data["phd_degree_obtained_university"]);
                $("#phd_work_carried_out").html(escapeHtml(data["phd_work_carried_out"]));
                $("#phd_work_proposed_institution").text(data["phd_work_proposed_institution"]);

                // add more fields function
                let guideDetails = data["guide_details"];
                if ( !guideDetails || guideDetails == "null" ) {} else {
                    guideDetails.forEach(guideDetail => {
                        if(x < max_fields){ 					//max input box allowed
                            $(wrapper).append(`
                                <tr>
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
                $("#broad_discipline").html(escapeHtml(data["broad_discipline"]));
                $("#work_background").html(escapeHtml(data["work_background"]));
                $("#hypothesis_proposed").html(escapeHtml(data["hypothesis_proposed"]));
                $("#objectives").html(escapeHtml(data["objectives"]));
                $("#mat_and_methods_proposed").html(escapeHtml(data["mat_and_methods_proposed"]));
                $("#expected_outcome").html(escapeHtml(data["expected_outcome"]));
                $("#imp_references").html(escapeHtml(data["imp_references"]));
                $("#imp_of_proposed_work").html(escapeHtml(data["imp_of_proposed_work"]));
                $("#expertise_of_mentor").html(escapeHtml(data["expertise_of_mentor"]));
                if ( !data["list_of_publications_details"] || data["list_of_publications_details"] == "null" ) {} else {
                    data["list_of_publications_details"].forEach(list_of_publications => {
                        if(x_list_of_publications < max_fields_list_of_publications){ 					//max input box allowed
                            x_list_of_publications++; 								//text box increment
                            $(wrapper_list_of_publications).append(`
                                <tr>
                                    <td>`+x_list_of_publications+`</td>
                                    <td>${list_of_publications['name']}</td>
                            `); //add input box
                        }
                    });
                }
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
                if (data['file_proposed_study_timeline']) {
                    displayUploadedFile('docs', 'file_proposed_study_timeline', data['file_proposed_study_timeline']);
                }

                if (data["file_res_guide_certificate"]) {
                    displayUploadedFile('docs', 'file_res_guide_certificate', data["file_res_guide_certificate"]);
                }
                if (data["file_declaration_certificate"]) {
                    displayUploadedFile('docs', 'file_declaration_certificate', data["file_declaration_certificate"]);
                }
                if (data["file_aadhar_card"]) {
                    displayUploadedFile('docs', 'file_aadhar_card', data["file_aadhar_card"]);
                }
                if (data["file_institute_head_certificate"]) {
                    displayUploadedFile('docs', 'file_institute_head_certificate', data["file_institute_head_certificate"]);
                }
                if (data["file_candidate_cv"]) {
                    displayUploadedFile('docs', 'file_candidate_cv', data["file_candidate_cv"]);
                }
                if (data["file_mentor_cv"]) {
                    displayUploadedFile('docs', 'file_mentor_cv', data["file_mentor_cv"]);
                }
            }
        }
    }
</script>
</body>
</html>