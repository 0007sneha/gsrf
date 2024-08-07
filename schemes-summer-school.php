<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/schemesData.php"; 
?>
<style>
    section:nth-child(even) {
        background-color: var(--whiteShade1) !important;
    }
    section:nth-child(odd) {
        background-color: var(--white) !important;
    }
    section .bgImg {
        top: -260px !important;
    }
    .readableContent p {
        text-transform: inherit;
    }
    .multiContent ol>li {
        margin-bottom: inherit;
    }
</style>
<main id="main"> 

    <section class="inner-page mtBreadcrumbs text-center readableContent normalFont pMax bgImage">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-md-center">
                <div class="col-md-12 col-lg-8">
                    <h2>
                        GSRF Summer/Winter School Scheme
                    </h2>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_not_exist">
                    <?php 
                        echo $summerSchoolRequiredDocs["message"];

                        if ($summerSchoolRequiredDocs["status"]=="open") {
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'SS\',\''.$summerSchoolRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$summerSchoolRequiredDocs['btn_title'].'</a>'; 
                            echo $summerSchoolRequiredDocs["note"];
                        }
                        if ($summerSchoolRequiredDocs["status"]=="result") { 
                            echo '<a href="'.$summerSchoolRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                        }
                    ?>
                </div>  
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_exist d-none">
                    <p class="scheme-status m-0"><?php echo $summerSchoolRequiredDocs["app_download_msg"] ?></p>
                    <a href="#" onclick="downloadApplicationForm('download-pdf');" class="btn btn-primary apply_btn my-3 "><i class="bi bi-download"></i> Download </a>
                </div>  
            </div>
        </div>
    </section>
    <section class="cards">
        <div class="container">
            <div class="row">
                <div class="col-md-4 border_right">
                    <a href="#scheme">
                        <div class="box">
                            <h4>Scheme</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 border_right">
                    <a href="#documents-required">
                        <div class="box">
                            <h4>Documents required</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#document-formats">
                        <div class="box">
                            <h4>Document formats</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title">INTRODUCTION TO THE SCHEME</h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">
                    <p>
                        Summer and Winter vacations could promote research by exposing school students, school teachers and UG students to various aspects of research, including instrumentation, experimentation, ideation through brainstorming, hackathons, programming, exposure to software used in research, field data collection, analysing data, etc.
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        As already instrumentation facilities, lab facilities, computer facilities, classrooms, etc., are available in the Colleges and Goa University and they are generally not utilised during the vacations in Summer and Winter, they could be effectively used by the faculty members and their research students to conduct these summer/winter schools.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="inner-page readableContent normalFont pMax">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title">OBJECTIVES AND SCOPE </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">
                    <p>
                        This scheme aims to expose students from IX-XII standard, school teachers and UG students to research methods and tools, including instrumentation, to create excitement. 
                    </p>
                    <p>
                        The following are the key objectives:
                    </p>
                    <ol type="a">
                        <li>To use the summer/winter vacations in creating research interest in students from IX standard to UG level and school teachers.</li>
                        <li>To provide financial assistance to the institutions and faculty members to conduct this programme.</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <p>
                        Under this scheme, financial assistance can be requested by the HEIs/faculty members for the following:
                    </p>
                    <ol type="i">
                        <li>Summer/Winter School for School students from IX–XII from schools of Goa (Affiliated /Autonomous colleges of Goa University are eligible to apply).</li>
                        <li>Summer/Winter School for School teachers from IX–XII from schools of Goa (Affiliated /Autonomous colleges of Goa University are eligible to apply).</li>
                        <li>Summer/Winter School for Under Graduate students from affiliated/autonomous colleges of Goa University (Goa University and recognised research centres of Goa University in colleges are eligible to apply).</li>
                    </ol>
                    <p>
                        The duration of the workshop shall be a minimum of five working days to a maximum of ten working days.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="inner-page readableContent normalFont pMax">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title"> OPERATION OF THE SCHEME</h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">
                    <p>
                        The Goa State Research Foundation (GSRF) will execute this scheme.
                    </p>
                </div>
                <div class="col-md-6">
                    <p>

                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax">
        <div class="container">
            <div class="section-header">
                <h4 class="title"> PATTERN OF ASSISTANCE </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">  
                    <p>
                        The quantum of assistance under this scheme is based on the approved proposal with estimates and actual expenditure under the following heads:
                    </p>
                    <ol>
                        <li>Consumables (including chemicals, essential glassware, etc.)</li>
                        <li>Honorarium (for the resource persons, assistants in the laboratory, etc.)</li>
                        
                    </ol>
                    
                </div>
                <div class="col-md-6">
                    <ol start="3">
                        <li>Working lunch, tea, snacks</li>
                        <li>Contingency (for stationery, photocopying, certificate printing, etc.)</li>
                        <li>Overhead charges for the institute (20% total cost of a-d above).</li>
                    </ol>
                    <p>
                        However, the total support for any event shall not exceed Rs. 2,50,000.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax" id="criteria">
        <div class="container" data-aos="fade-up">
            <div class="row multiContent justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12">
                    <div class="tab">
                        <button class="tablinks tablinksCriteria active" onclick="openCriteria(event, 'eligibility')">ELIGIBILITY</button>
                        <button class="tablinks tablinksCriteria" onclick="openCriteria(event, 'procedure')">PROCEDURES</button>
                        <button class="tablinks tablinksCriteria" onclick="openCriteria(event, 'condition')">CONDITIONS</button>
                    </div>

                    <div id="eligibility" class="tabcontent tabcontentCriteria">
                        <div class="my-5">
                            <h2 class="title" id="documents-required">ELIGIBILITY</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr70">
                                <p>
                                    Considering the availability of research facilities, the following types of institutions are eligible to conduct the programme:
                                </p>
                                <ol type="1">
                                    <li>Affiliated and autonomous colleges of Goa University to conduct Summer/Winter Schools for School students from IX–XII.</li>
                                </ol>
                            </div>
                            <div class="col-md-6 pl70">
                                <ol start="2">
                                    <li>Affiliated and autonomous colleges of Goa University to conduct Summer/Winter Schools for School teachers.</li>
                                    <li>Goa University and recognised research centres of Goa University in colleges are eligible to run Summer/Winter Schools for Under Graduate students.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div id="procedure" class="tabcontent tabcontentCriteria">
                        <div class="my-5">
                            <h2 class="title">PROCEDURES</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr70">
                                <h4>PROCEDURE FOR APPLYING UNDER THE SCHEME</h4>
                                <p>
                                    Higher Education Institutes in Goa, as specified under eligibility criteria, can apply online in response to the call by the GSRF. Each institute can apply for multiple Schools under the scheme (eg. Both Summer and Winter or one in science and another in Humanities).
                                </p>
                                <p>
                                    The proposal shall contain a whole syllabus that will be covered along with identified resource persons. The schools can be multidisciplinary, interdisciplinary or only in identified specialised areas. A coordinator needs to be identified. Tentative dates and target audience, including number, must be given in the application. A certificate from the Head of the Institution assuring all the facilities shall be uploaded along with the application.
                                </p>
                            </div>
                            <div class="col-md-6 pr70">
                                <h4>PROCEDURE FOR SELECTION</h4>
                                <p>
                                    Applications received will be scrutinised and evaluated by an appointed committee. The committee may invite the coordinator to discuss the content (syllabus) and/or budget during the reviewing process. Once recommended by the committee with their observations, the Governing Council will take a final decision based on the observations and recommendations of the committee and the availability of the funds under the scheme.
                                </p>
                                <br><br>
                                <h4>PROCEDURE FOR RELEASE OF GRANTS</h4>
                                <p>
                                    After the approval of selection by the Governing Council for funding, the concerned coordinators/institutes will be informed by the GSRF. The sanction letters will be issued, and the grant will be released after receiving an acceptance letter from the institute.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="condition" class="tabcontent tabcontentCriteria">
                        <div class="my-5">
                            <h2 class="title">CONDITIONS</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr70">
                                <h4>GENERAL TERMS & CONDITIONS:</h4>
                                <p>
                                    On completion of the programme, the following documents need to be submitted by the Co-ordinator/Institute:
                                </p>
                                <ol type="1">
                                    <li>A report of the event</li>
                                    <li>Attendance certificate of the participants</li>
                                    <li>Feedback from the participants</li>
                                    <li>Statement of expenditure</li>
                                    <li>Utilisation certificate</li>
                                    <li>The unutilised grant, if any, shall be returned to the GSRF.</li>
                                </ol>
                            </div>
                            <div class="col-md-6 pr70">
                                <h4>RELAXATION OF CONDITIONS</h4>
                                <p>
                                    The GSRF is empowered to relax any or all clauses or conditions of the Scheme in genuine cases.
                                </p>
                                <br><br>

                                <h4>INTERPRETATION</h4>
                                <p>
                                    Any question arising regarding the interpretation of any clause, word or expression of the scheme, the decision about the interpretation shall be with the GSRF, which shall be final and binding on all concerned.
                                </p>
                                <br><br>

                                <h4>AMENDMENT</h4>
                                <p>
                                    The Governing Council of GSRF reserves the right to amend the terms and conditions of the scheme as and when required for better and more effective implementation of the Scheme.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax">
        <div class="container">
            <div class="section-header">
                <h4 class="title"> Documents required </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-12">
                    <ol type="1">
                        <li id="document-formats">Declaration by the co-ordinator (in pdf format to upload)</li>
                        <li>Certificate from the Principal/HoI/Registrar (in pdf format to upload)</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax">
        <div class="container">
            <div class="section-header">
                <h4 class="title"> Document formats </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-12">
                    <table class="table table-borderless">
                        <tbody>
                            <?php
                                foreach ($summerSchoolRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>'.++$key.'</td>
                                        <td>'.$value['name'].'</td>
                                        <td><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download"></i> '.$value['fileName'].''.$summerSchoolRequiredDocs['file_format_1'].'</a></td>
                                        <td>';
                                        if ($value['url_type_2']) {
                                            echo '<a href="'.$value['url_type_2'].'" class="customLink"><i class="bi bi-download"></i> '.$value['fileName'].''.$summerSchoolRequiredDocs['file_format_2'].'</a></td>';
                                        }
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax text-center">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title"> </h4>
            </div>
            <div class="row gx-5 multiContent text_left user_application_not_exist">
                <div class="col-md-12">
                    <?php if ($summerSchoolRequiredDocs["status"]=="open" && $summerSchoolRequiredDocs["app_type"]=="doc") { 
                            echo $summerSchoolRequiredDocs["message_bottom"];
                        } else if ($summerSchoolRequiredDocs["status"]=="close") { 
                            echo $summerSchoolRequiredDocs["message"];
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title"> </h4>
            </div>
            <div class="row gx-5 multiContent justify-content-md-center user_application_not_exist">
                <div class="col-md-12">
                    <?php 
                        if ($summerSchoolRequiredDocs["status"]=="open") {    
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'SS\',\''.$summerSchoolRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$summerSchoolRequiredDocs['btn_title'].'</a>
                                <p class="note">
                                    If you have gone through the details given above,
                                    <br> ';
                                    if ($summerSchoolRequiredDocs["app_type"]=="form") { 
                                        echo 'you can click here to APPLY';
                                    } else if ($summerSchoolRequiredDocs["app_type"]=="doc") { 
                                        echo 'you can click here to Submit Application Form';
                                    }
                            echo '</p>'; 
                        } else if ($summerSchoolRequiredDocs["status"]=="pending" || $summerSchoolRequiredDocs["status"]=="result") { 
                            echo $summerSchoolRequiredDocs["message"];
                            
                            if ($summerSchoolRequiredDocs["status"]=="result") { 
                                echo '<a href="'.$summerSchoolRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                            } 
                        }
                    ?>
                </div>
            </div>
            <div class="row gx-5 multiContent justify-content-md-center user_application_exist d-none">
                <div class="col-md-12">
                    <p class="scheme-status m-0"><?php echo $summerSchoolRequiredDocs["app_download_msg"] ?></p>
                    <a href="#" onclick="downloadApplicationForm('download-pdf');" class="btn btn-primary apply_btn my-3 "><i class="bi bi-download"></i> Download </a>
                </div>
            </div>
            <img class="bgImg left" src="assets/img/bg/group6.png" alt="">
            <img class="bgImg right" src="assets/img/bg/group7.png" alt="">
        </div>
    </section>

</main>
<!-- End #main -->
<?php 
$localStorageKey = 'summerSchoolData';
require "layout/upload-application.php"; 
require "layout/footer.php"; 
?>

<script src="assets/js/custom-upload-file-application.js?<?php echo time() ?>"></script>
<script type="text/javascript">
    var saveData = {};
    let schemeBatchId = "<?php echo $summerSchoolRequiredDocs["scheme_batch_id"] ?>";
    let schemeStatus = "<?php echo $summerSchoolRequiredDocs["status"] ?>";
    let schemeAppType = "<?php echo $summerSchoolRequiredDocs["app_type"] ?>";
    // custom requirement 
    let isFileUploaded = 0;

    $(document).ready(function() {
        document.getElementById('eligibility').style.display = "block";
        $("#eligibility.tabcontentCriteria").addClass(" active");
        
        //  Assign variable to store
        localStorage.setItem("summerSchoolData", JSON.stringify({}));
        
        // get user application response
        if (userId && schemeStatus!='result') {
            callApi({
                method: 'GET',
                url: 'api/userApi.php?userId=' + userId + '&schemeBatchId='+schemeBatchId + '&type=SS',
                form_type: 'user-scheme_status',
            });
        }
    });

    function openCriteria(evt, tabId) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontentCriteria");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinksCriteria");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabId).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function submitApplication() {
        saveData["flag"] = true;
        saveData["user_id"] = userId;
        saveData["scheme_batch_id"] = schemeBatchId;
        saveData["form_type"] = 'submit-form';
        saveData.formSubmissionType = 'direct';
        file_application_form = saveData["file_application_form"];

        $('#submit_app_btn').prop('disabled', true);
        callApi({
            method: 'POST',
            url: 'api/schemeSummerSchoolApi.php',
            data: saveData,
            form_type: 'submit-Doc',
        });
        setTimeout(() => {
            $("#uploadFormApplicationModal .btn-close").click();
        }, 3000);
    }

    function downloadApplicationForm(type) 
    {
        callApi({
            method: 'GET',
            url: 'api/schemeSummerSchoolApi.php?id=' + userId + '&schemeBatchId='+schemeBatchId + '&type=download-pdf',
            form_type: 'download-pdf',
        });
        // location.href ="api/schemeSummerSchoolApi.php?id=" + userId + '&schemeBatchId='+schemeBatchId + "&type="+type;
    }

    function getApiResponse(res, form_type) {
        if (res.flag && res.status == '200') {
            if (form_type=="user-scheme_status") {
                if (res.data['file_application_form'] && schemeAppType=="form") {
                    var user_application_not_exist = document.getElementsByClassName("user_application_not_exist");
                    for (var i = 0; i < user_application_not_exist.length; i++) {
                        user_application_not_exist[i].classList.add("d-none");
                    }
                    var user_application_exist = document.getElementsByClassName("user_application_exist");
                    for (var i = 0; i < user_application_exist.length; i++) {
                        user_application_exist[i].classList.remove("d-none");
                    }
                }
            } else if (form_type=="download-pdf") {
                if (res.data['file_application_form']) {
                    let a= document.createElement('a');
                        a.target= '_blank';
                        a.href = res.data['file_application_form'];
                        a.click();
                } else {
                    popUpMsg("Could not find Application File! Try again later.");
                }
            } else {
                // do nothing
                // console.log(res.message);
            }
        } else {
            if (form_type=="submit-Doc") {
                $('#submit_app_btn').prop('disabled', false);
            }
            // console.log(res.message);
        }
    }
</script>
</body>
</html>