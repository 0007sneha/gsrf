<?php 
require "layout/head.php"; 
if (!isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
$schemeUrl = "schemes-summer-school.php";
?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/generalData.php";
$isSchemeAvailableFor = "SS"; 
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
                                <li><a href="<?php echo $schemeUrl;?>">Summer School Scheme</a></li>
                                <li>View application</li>
                            </ol>
                            <h2>
                                Application for Summer School Scheme
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
                        <div class="row">
                            <h3 class="mb-5">Coordinator Information</h3>
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
                                <label class="col-md-12">Mobile No. : </label>
                                <span id="country_code"> </span>&nbsp;<span id="phone_no"> </span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Email ID : </label>
                                <div id="email"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Designation : </label>
                                <div id="designation"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Official Address : </label>
                                <div id="official_address"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Deputy Coordinator Information</h3>
                            <div class="col-md-4 mb-4">
                                <label>First Name : </label>
                                <div id="deputy_co_first_name"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Middle Name : </label>
                                <div id="deputy_co_middle_name"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Last Name : </label>
                                <div id="deputy_co_last_name"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="col-md-12">Mobile No. : </label>
                                <span id="deputy_co_country_code"> </span>&nbsp;<span id="deputy_co_phone_no"> </span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Email ID : </label>
                                <div id="deputy_co_email"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Designation : </label>
                                <div id="deputy_co_designation"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Official Address : </label>
                                <div id="deputy_co_official_address"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="mb-5">Institution Details</h3>
                                <label>Name and complete address of the Institution</label>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_institute_details">
                                    <thead class="table-light">
                                        <th>Sr. No</th>
                                        <th>Name of the Institute</th>
                                        <th>Institute Address</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <br><br>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Event Details</h3>
                            <div class="col-md-6 mb-4">
                                <label>A broad area of the workshop</label>
                                <div id="broad_area_of_workshop"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Title of the summer/winter school</label>
                                <div id="scheme_title"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Target audience </label>
                                <div class="row">
                                    <?php
                                        foreach ($targetAudienceArr as $key => $value) {
                                            echo '
                                                <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3"> 
                                                    <div class="form-check">
                                                    <label class="form-check-label" for="target_audience_'.$value["id"].'">
                                                        <input class="form-check-input" type="checkbox" name="target_audience" id="target_audience_'.$value["id"].'" value="'.$value["name"].'" onclick="return false;">
                                                            '.$value["name"].'
                                                        </label>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Proposed starting date</label>
                                <div id="starting_date"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Proposed ending date</label>
                                <div id="ending_date"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Total number of working days</label>
                                <div id="no_of_working_days"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>No. of participants</label>
                                <div id="no_of_participants"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h3>Resource Persons Details</h3>
                            </div>
                            <div class="col-md-12 mb-4">
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_resource_person_details">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Address</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h3>Topics (syllabus) to be covered</h3>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_session_wise_topic">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Days</th>
                                        <th>Session Wise Topics/Syllabus</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h3 class="mb-4">Budget Details</h3>
                                
                                <table class="table table-stripped table-bordered border-light edu_details">
                                    <thead class="table-light">
                                        <th style="width: 50px">S.No. </th>
                                        <th style="width: 70%;">Item</th>
                                        <th style="width: 20%;">Amount</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center">1</th>
                                            <th>Consumables
                                                <p>Including chemicals, essential glassware, etc.</p>
                                            </th>
                                            <td  class="text-end"><div id="item_cost_consumables"> </div></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">2</th>
                                            <th>
                                                Honorarium
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        A. Resource  Person Lecture rate 
                                                        <p>(₹750 per 1 hour session) </p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="item_cost_honorarium_no_of_lecture_sessions"><p class="mb-0">No. of Sessions</p></label>
                                                        <div class="pInherit text-center" id="item_cost_honorarium_no_of_lecture_sessions"></div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        B. Resource  Person Practicals/Field rate
                                                        <p>(₹750 per 2 hour session)</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="item_cost_honorarium_no_of_practical_sessions"><p class="mb-0">No. of Sessions</p></label>
                                                        <div class="pInherit text-center" id="item_cost_honorarium_no_of_practical_sessions"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        C. Assistant(s) for eg. in laboratory etc.
                                                        <p>
                                                            (₹500 per day per person)
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="item_cost_honorarium_no_of_assistants"><p class="mb-0">No. of People</p></label>
                                                        <div class="pInherit text-center" id="item_cost_honorarium_no_of_assistants"></div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="item_cost_honorarium_no_of_days"><p class="mb-0">No. of Days</p></label>
                                                        <div class="pInherit text-center" id="item_cost_honorarium_no_of_days"></div>
                                                    </div>
                                                </div>
                                                <p>As  the resource  persons  are  expected  to  be  from  the same institute no Travel budget is allowed</p>
                                            </th>
                                            <td class="text-end"><div id="item_cost_honorarium"> </div></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">3</th>
                                            <th>
                                                Working lunch, tea, snacks &nbsp; 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row input_field_label">
                                                            &nbsp;&nbsp; At the rate of ₹<span id="item_cost_working_lunch_rate_per_day" class="span_container_msg"></span> &nbsp; per day
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="item_cost_working_lunch_no_of_assistants"><p class="mb-0">No. of People</p></label>
                                                        <div class="pInherit text-center" id="item_cost_working_lunch_no_of_assistants"></div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="item_cost_working_lunch_no_of_days"><p class="mb-0">No. of Days</p></label>
                                                        <div class="pInherit text-center" id="item_cost_working_lunch_no_of_days"></div>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="text-end"><div id="item_cost_working"> </div></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">4</th>
                                            <th>Contingency 
                                                <p>For  stationery,  photocopying, certificate printing, etc.</p>
                                            </th>
                                            <td  class="text-end"><div id="item_cost_contingency"> </div></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">5</th>
                                            <th>Overhead (20% of the total (S.No. 1-4))</th>
                                            <td class="text-end"><div id="item_cost_overhead"> </div></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>TOTAL
                                                <p>
                                                    Important Notice: To ensure compliance with our financial policies, please note that the total amount should not exceed 2.5 Lakhs.
                                                    For lesser no. of days it shall be calculated proportionally.
                                                </p>
                                            </th>
                                            <td class="text-end"><div id="item_cost_total"> </div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h3>Expected outcome </h3>
                                <p>Not more than 100 words</p>
                                
                                <div class="col-md-12 mt-5 mb-4">
                                    <label>A broad area of the workshop</label>
                                    <div id="expected_outcome"> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="forms">
                        <h3 class="mb-5">Certificates</h3>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="d-block">Declaration by the coordinator</label>
                                <a href="#" class="btn btn-outline" id="view_file_declaration_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row mb-5 d-none">
                            <div class="col-md-6">
                                <label class="d-block">Aadhar Card (Self Attested)</label>
                                <a href="#" class="btn btn-outline" id="view_file_aadhar_card" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label class="d-block">Certificate (from Principal/Registrar) on official letterhead </label>
                                <a href="#" class="btn btn-outline" id="view_file_principal_registrar_certificate" target="_blank">View File(<span></span>)</a>
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
    var data = {};
    let schemeBatchId = "<?php echo $summerSchoolRequiredDocs["scheme_batch_id"] ?>";
    const rupeeSign = "₹ ";
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    isUserApplicableForScheme(scheme_code);
    callApi({
        method: 'GET',
        url: 'api/schemeSummerSchoolApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
        form_type: 'preview-data',
    });

    $( document ).ready(function() {
    
    });
    
    function downloadApplicationForm(type) 
    {
        AmagiLoader.show();
        callApi({
            method: 'GET',
            url: 'api/schemeSummerSchoolApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=download-pdf',
            form_type: 'download-pdf',
            is_loader: 'within_the_page',
        });
        // location.href ="api/schemeSummerSchoolApi.php?id="+userId+'&schemeBatchId='+schemeBatchId+"&type="+type;
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
                        url: 'api/schemeSummerSchoolApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
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
                let max_fields_instituteDetails = 
                    max_fields_resource_person = 
                    max_fields_sessionWiseTopicDetails = 
                    50;
                let x_instituteDetails = 
                    x_resource_person = 
                    x_sessionWiseTopicDetails = 
                    0;
                var wrapper_instituteDetails = $(".input_fields_wrap_institute_details > tbody");     // Fields wrapper
                var wrapper_resourcePerson = $(".input_fields_wrap_resource_person_details > tbody");     // Fields wrapper
                var wrapper_investPublication = $(".input_fields_wrap_session_wise_topic > tbody");     // Fields wrapper

                $("#application_no").text(data['application_no']);

                data['coordinator_details'].forEach(element => {
                    let pre_id='';
                    if (element.type == 'coordinator') {
                        pre_id=''; 
                    } else if (element.type == 'deputy_coordinator') {
                        pre_id='deputy_co_';
                    }
                    $("#"+pre_id+"first_name").text(element['first_name']);
                    $("#"+pre_id+"middle_name").text(element['middle_name']);
                    $("#"+pre_id+"last_name").text(element['last_name']);
                    countryCode_data = countryCode_json.find(o => o.id === parseInt(element['country_code']));
                    $("#"+pre_id+"country_code").text(countryCode_data.name);
                    $("#"+pre_id+"phone_no").text(element['phone_no']);
                    $("#"+pre_id+"email").text(element['email']);
                    $("#"+pre_id+"designation").text(element['designation']);
                    $("#"+pre_id+"official_address").html(escapeHtml(element['official_address']));
                });
                
                if ( !data["institution_details"] || data["institution_details"] == "null" ) {} else {
                    data["institution_details"].forEach(institutionDetail => {
                        x_instituteDetails++; 								//text box increment
                        $(wrapper_instituteDetails).append(`
                            <tr>
                                <td class="text-center">${x_instituteDetails}</td>
                                <td>${institutionDetail['name']}</td>
                                <td>${institutionDetail['address']} </td>
                            </tr>
                        `); //add input box
                    });
                }
                $("#broad_area_of_workshop").html(escapeHtml(data["broad_area_of_workshop"]));
                $("#scheme_title").text(data["scheme_title"]);
                $("#starting_date").text(getToday(data["starting_date"], 'dmy'));
                $("#ending_date").text(getToday(data["ending_date"], 'dmy'));
                $("#no_of_working_days").text(data["no_of_working_days"]);
                $("#no_of_participants").text(data["no_of_participants"]);
                let countCheckedValue = 0;
                if (data["target_audience"]) {
                    data["target_audience"].forEach(element => {
                        if (element.checked) {
                            checkboxes[countCheckedValue].checked = true;
                        }
                        countCheckedValue++;
                    });
                }
                
                if ( !data["resource_person_details"] || data["resource_person_details"] == "null" ) {} else {
                    data["resource_person_details"].forEach(resource_personDetail => {
                        x_resource_person++; 								//text box increment
                        $(wrapper_resourcePerson).append(`
                            <tr>
                                <td class="text-center">${x_resource_person}</td>
                                <td>${resource_personDetail['name'] ?? ''}</td>
                                <td>${resource_personDetail['designation'] ?? ''}</td>
                                <td>${resource_personDetail['official_address'] ?? ''} </td>
                            </tr>
                        `); //add input box
                    });
                }

                if ( !data["session_wise_topic_details"] || data["session_wise_topic_details"] == "null" ) {} else {
                    data["session_wise_topic_details"].forEach(sessionWiseTopicDetail => {
                        x_sessionWiseTopicDetails++; 								//text box increment
                        $(wrapper_investPublication).append(`
                            <tr>
                                <td class="text-center">`+x_sessionWiseTopicDetails+`</td>
                                <td class="text-center">${getToday(sessionWiseTopicDetail['day'], 'dmy')}</td>
                                <td>${sessionWiseTopicDetail['topic']}</td>
                        `); //add input box
                    });
                }
                $("#item_cost_total").text(rupeeSign + ' ' +data["item_cost_total"]);
                $("#item_cost_overhead").text(rupeeSign + ' ' +data["item_cost_overhead"]);
                $("#item_cost_contingency").text(rupeeSign + ' ' +data["item_cost_contingency"]);
                $("#item_cost_working").text(rupeeSign + ' ' +data["item_cost_working"]);
                $("#item_cost_working_lunch_no_of_days").text(data["item_cost_working_lunch_no_of_days"]);
                $("#item_cost_working_lunch_no_of_assistants").text(data["item_cost_working_lunch_no_of_assistants"]);
                $("#item_cost_working_lunch_rate_per_day").text(data["item_cost_working_lunch_rate_per_day"]);
                $("#item_cost_honorarium").text(rupeeSign + ' ' +data["item_cost_honorarium"]);
                $("#item_cost_honorarium_no_of_days").text(data["item_cost_honorarium_no_of_days"]);
                $("#item_cost_honorarium_no_of_assistants").text(data["item_cost_honorarium_no_of_assistants"]);
                $("#item_cost_honorarium_no_of_practical_sessions").text(data["item_cost_honorarium_no_of_practical_sessions"]);
                $("#item_cost_honorarium_no_of_lecture_sessions").text(data["item_cost_honorarium_no_of_lecture_sessions"]);
                $("#item_cost_consumables").text(rupeeSign + ' ' +data["item_cost_consumables"]);
                
                $("#expected_outcome").html(escapeHtml(data["expected_outcome"]));
                
                if (data["file_declaration_certificate"]) {
                    displayUploadedFile('docs', 'file_declaration_certificate', data["file_declaration_certificate"]);
                }
                if (data["file_aadhar_card"]) {
                    displayUploadedFile('docs', 'file_aadhar_card', data["file_aadhar_card"]);
                }
                if (data["file_principal_registrar_certificate"]) {
                    displayUploadedFile('docs', 'file_principal_registrar_certificate', data["file_principal_registrar_certificate"]);
                }
            }
        }
    }
</script>
</body>
</html>