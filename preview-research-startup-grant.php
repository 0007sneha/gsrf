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
                                <li><a href="<?php echo $schemeUrl;?>">Research startup grants</a></li>
                                <li>View application</li>
                            </ol>
                            <h2>
                                Application for Research Start-Up Grants
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
                                <label>Are you differently abled ? </label>
                                <div id="is_differently_abled"> </div>
                            </div>
                            <div class="col-md-8 mb-4" id="file_differently_abled_certificate_field">
                                <label>Differently abled Certificate</label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_differently_abled_certificate" target="_blank">View File(<span></span>)</a>
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
                            <h3 class="mb-5">Employment Details</h3>
                            <div class="col-md-4 mb-4">
                                <label>Designation : </label>
                                <div id="designation"> </div>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label>Official Address(institution)</label>
                                <div id="official_address"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Date of joining the present position :</label>
                                <div id="joining_date"> </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Ph.D Details</h3>
                            <div class="col-md-8 mb-4">
                                <label>Title of Ph.D. thesis : </label>
                                <div id="thesis_title"> </div>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label>University from where Ph.D./M.D/M.S/M.D.S/M.V.Sc.is obtained</label>
                                <div id="university_name"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Year of obtaining Ph.D. degree :</label>
                                <div id="year_of_obtaining_degree"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Broad Discipline : </label>
                                <div id="broad_discipline"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Specialisation : </label>
                                <div id="specialisation"> </div>
                            </div>
                            <!-- <div class="col-md-8 mb-4">
                                <label>Title of the thesis/dissertation (Ph.D. /M.D/M.S/M.D.S/M.V.Sc) : </label>
                                <div id="dissertation_thesis_title"> </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Institution details where the seed grant will be utilized</h3>
                            <div class="col-md-4 mb-4">
                                <label>Institution Name : </label>
                                <div id="institution_name"> </div>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label>Institution Address : </label>
                                <div id="institution_address"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Are you running any project(s) right now? </label>
                                <div id="is_running_any_project"> </div>
                            </div>
                            <div class="col-md-12 mb-4 d-none" id="file_project_details_field">
                                <label> Project Details</label>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_projectDetails">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Agency</th>
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
                            <div class="col-md-12 mb-4">
                                <label>Write up of your proposed work : </label>
                                <p>Writeup shall contain Title, statement of the problem, objectives, materials and methods and expected outcome, in brief</p>
                                <div id="proposed_work"> </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Published Papers : </label><br>
                                    <a href="#" class="btn btn-outline" id="view_file_published_papers" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Certificates</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Aadhar Card : </label><br>
                                <a href="#" class="btn btn-outline" id="view_file_aadhar_card" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Declaration by the candidate : </label>
                                <a href="#" class="btn btn-outline" id="view_file_declaration_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Endorsement from the Head of the institute : </label>
                                <a href="#" class="btn btn-outline" id="view_file_institute_head_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label>Curriculum vitae : </label>
                                <p>Please provide complete details</p>
                                <a href="#" class="btn btn-outline" id="view_file_curriculum_vitae_certificate" target="_blank">View File(<span></span>)</a>
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
    let schemeBatchId = "<?php echo $researchStartUpGrantsRequiredDocs["scheme_batch_id"] ?>";
    
    isUserApplicableForScheme(scheme_code);
    callApi({
        method: 'GET',
        url: 'api/schemeResearchStartupGrantApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
        form_type: 'preview-data',
    });

    $( document ).ready(function() {

    });


    function downloadApplicationForm(type) 
    {
        AmagiLoader.show();
        callApi({
            method: 'GET',
            url: 'api/schemeResearchStartupGrantApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=download-pdf',
            form_type: 'download-pdf',
            is_loader: 'within_the_page',
        });
        // location.href ="api/schemeResearchStartupGrantApi.php?id="+userId+'&schemeBatchId='+schemeBatchId+"&type="+type;
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
                        url: 'api/schemeResearchStartupGrantApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
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
                $("#application_no").text(data['application_no']);
                $("#first_name").text(data['first_name']);
                $("#middle_name").text(data['middle_name']);
                $("#last_name").text(data['last_name']);
                $("#dob").text(getToday(data['dob'], 'dmy'));
                categories_data = categories_json.find(o => o.id === parseInt(data['category']));
                $("#category").text(categories_data.name);
                showMoreOptions('category', data['category']);
                if (data['file_category_certificate']) {
                    displayUploadedFile('docs', 'file_category_certificate', data['file_category_certificate']);
                }
                if (data['is_differently_abled']==1) {
                    is_differently_abled = 'Yes';
                } else {
                    is_differently_abled = 'No';
                }
                $("#is_differently_abled").text(is_differently_abled);
                showMoreOptions('differently_abled', data['is_differently_abled']);
                if (data['file_differently_abled_certificate']) {
                    displayUploadedFile('docs', 'file_differently_abled_certificate', data['file_differently_abled_certificate']);
                }
                if (data['file_profile_picture']) {
                    displayUploadedFile('img', 'file_profile_picture', data['file_profile_picture']);
                }
                
                $("#designation").text(data["designation"]);
                $("#official_address").html(escapeHtml(data["official_address"]));
                $("#joining_date").text(getToday(data["joining_date"], 'dmy'));

                $("#thesis_title").html(escapeHtml(data["thesis_title"]));
                $("#university_name").html(escapeHtml(data["university_name"]));
                $("#year_of_obtaining_degree").text(data["year_of_obtaining_degree"]);
                $("#broad_discipline").html(escapeHtml(data["broad_discipline"]));
                $("#specialisation").html(escapeHtml(data["specialisation"]));
                // $("#dissertation_thesis_title").html(escapeHtml(data["dissertation_thesis_title"]));

                $("#institution_name").text(data["institution_name"]);
                $("#institution_address").html(escapeHtml(data["institution_address"]));
                
                if (data['is_running_any_project']==1) {
                    is_running_any_project = 'Yes';
                } else {
                    is_running_any_project = 'No';
                }
                $("#is_running_any_project").text(is_running_any_project);
                showMoreOptions('running_project', data['is_running_any_project']);
                
                // add more fields function
                let max_fields = 8;
                var wrapper = $(".input_fields_wrap_projectDetails > tbody"); 		//Fields wrapper
                let x = 0;
                let project_details = data["project_details"];
                if ( !project_details || project_details == "null" ) {} else {
                    project_details.forEach(project_detail => {
                        x++; 								//text box increment
                        if(x < max_fields){ 					//max input box allowed
                            $(wrapper).append(`
                                <tr>
                                    <td><div>`+x+`</div></td>
                                    <td><div>${project_detail['title']} </div></td>
                                    <td><div>${project_detail['cost_in_lakhs']}</div></td>
                                    <td><div>${getToday(project_detail['start_date'], 'dmy')} </div></td>
                                    <td><div>${getToday(project_detail['end_date'], 'dmy')} </div></td>
                                    <td><div>${project_detail['agency']} </div></td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                $("#proposed_work").html(escapeHtml(data["proposed_work"]));
                if (data["file_published_papers"]) {
                    displayUploadedFile('docs', 'file_published_papers', data["file_published_papers"]);
                }
                if (data["file_aadhar_card"]) {
                    displayUploadedFile('docs', 'file_aadhar_card', data["file_aadhar_card"]);
                }
                if (data["file_declaration_certificate"]) {
                    displayUploadedFile('docs', 'file_declaration_certificate', data["file_declaration_certificate"]);
                }
                if (data["file_institute_head_certificate"]) {
                    displayUploadedFile('docs', 'file_institute_head_certificate', data["file_institute_head_certificate"]);
                }
                if (data["file_curriculum_vitae_certificate"]) {
                    displayUploadedFile('docs', 'file_curriculum_vitae_certificate', data["file_curriculum_vitae_certificate"]);
                }
            }
        }
    }
</script>
</body>
</html>