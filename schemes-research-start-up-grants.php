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
                        GSRF Research Start-Up Grant Scheme
                    </h2>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_not_exist">
                    <?php 
                        echo $researchStartUpGrantsRequiredDocs["message"];

                        if ($researchStartUpGrantsRequiredDocs["status"]=="open") {
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'RSG\',\''.$researchStartUpGrantsRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$researchStartUpGrantsRequiredDocs['btn_title'].'</a>'; 
                            echo $researchStartUpGrantsRequiredDocs["note"];
                        }
                        if ($researchStartUpGrantsRequiredDocs["status"]=="result") { 
                            echo '<a href="'.$researchStartUpGrantsRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                        }
                    ?>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_exist d-none">
                    <p class="scheme-status m-0"><?php echo $researchStartUpGrantsRequiredDocs["app_download_msg"] ?></p>
                    <a href="#" onclick="downloadApplicationForm('download-pdf');" class="btn btn-primary apply_btn my-3 "><i class="bi bi-download"></i> Download </a>
                </div>
            </div>
        </div>
    </section>
    <section class="cards">
        <div class="container">
            <div class="row">
                <div class="col-md-3 border_right">
                    <a href="#scheme">
                        <div class="box">
                            <h4>Scheme</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 border_right">
                    <a href="#faq">
                        <div class="box">
                            <h4>FAQs</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 border_right">
                    <a href="#documents-required">
                        <div class="box">
                            <h4>Documents required</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
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
                        National Education Policy 2020 indicates the need for nurturing research at Higher Educational Institutions (HEIs). While more and more faculty members are joining HEIs with research degrees, more funding opportunities are needed to head start their research. 
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        A grant provided at the beginning of their career helps them to begin their research immediately. This support is expected to provide an encouraging research ecosystem in every HEI.
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
                        This scheme aims to provide grants to the newly recruited faculty members at the level of Assistant Professor to establish a research setup and start their independent research without any financial constraints. 
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        The primary objectives are:
                    </p>
                    <ol type="a">
                        <li>To provide an opportunity through funding for the newly recruited faculty members to start their research.</li>
                        <li>To encourage talented research-oriented faculty members to take a systematic research approach.</li>
                    </ol>
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
                        The Goa State Research Foundation (GSRF) will operate this scheme.
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
                <h4 class="title">  PATTERN OF FINANCIAL ASSISTANCE </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">  
                    <p>The nature and quantum of assistance under this Scheme will be as follows:</p>
                    <ol>
                        <li>It will be a one-time grant.</li>
                        <li>The grant will be Rs. 5,00,000/- for the faculty in the field of STEM and Rs. 3,00,000/- for the people from other disciplines.</li>
                        <li>The duration to utilise this money will be two years from the date of the sanction letter.</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="4">
                        <li>The grant can be utilised towards minor equipment, consumables, contingencies, analytical charges, travel, fieldwork, etc. There is no provision for overhead charges. Purchase of Desktops/Laptops, printers, and furniture not permitted. PI can decide the proportion of money to spend under each head.</li>
                        <li>Grant cannot be used for international travel or appointing research personnel or project assistants.</li>
                    </ol>
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
                            <h2 class="title">ELIGIBILITY</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr70">
                                <h4>ELIGIBILITY FOR RESEARCH START-UP GRANT SCHEME</h4>
                                <ol type="1">
                                    <li>
                                        The newly joined faculty members with PhD degrees or M.D/M.S/M.D.S/M.V.Sc. in the fields of Medicine, Dental and Veterinary, and appointed against the permanent position at the level of the Assistant Professor in Goa University or its affiliated or autonomous colleges are eligible to apply within two years from the date of joining.
                                    </li>
                                </ol>
                            </div>
                            <div class="col-md-6 pl70">
                                <ol start="2">
                                    <li>They should have published a minimum of three research articles in UGC-CARE-listed journals.</li>
                                    <li>The applicant should not have received any other grant from funding agencies.</li>
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
                                <h4>PROCEDURE FOR APPLYING FOR THE SCHEME</h4>
                                <p>
                                    An application can be made once in a year after the call is made by the GSRF through its web portal.
                                </p>
                                <p>
                                    Documents required and procedure to be followed during application:
                                </p>
                                <ol type="a">
                                    <li>Online registration with all the details</li>
                                    <li>Write-up of proposed work in about 500 words</li>
                                    <li>Scanned copy of category certificate and/or Differently Abled certificate.</li>
                                    <li>Declaration from the candidate (in prescribed format).</li>
                                    <li>Endorsement from the Head of the Institute (in prescribed format)</li>
                                    <li>Proper proposal including justification of heads of expenses / amounts and final outcome to be clearly stated in the application.</li>
                                </ol>
                                <br><br>

                            </div>
                            <div class="col-md-6 pr70">
                                <h4>PROCEDURE FOR SELECTION</h4>
                                <p>
                                    The Expert Committee constituted for this purpose will review the applications and make recommendations. The Governing Council of GSRF will take the final decision based on recommendations made by the Expert Committee and the availability of funds under the scheme.
                                </p>
                                <br><br>

                                <h4>PROCEDURE FOR RELEASE OF GRANTS</h4>
                                <ol type="a">
                                    <li>With the sanction letter, 80% of the grants will be released as the first instalment. The remaining 20% will be released in the second year against the submission of UC of the first instalment. </li>
                                    <li>PI shall submit 06 months(half yearly) report to GSRF within one month of the end of the 06 months.</li>
                                    <li>PIs shall spend the sanctioned money by the closure date, i.e. within two years of the first sanction letter.</li>
                                    <li>At the end of two years, PI shall submit UC, Statement of Expenditure and other details along with Terminal Report to the GSRF within one month of the closure date.</li>
                                    <li>All the grants will be released to the College/Goa University, as the case may be.</li>
                                </ol>
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
                                <ol type="1">
                                    <li>Selected candidates will be informed of their selection, and the awardees should send their acceptance certificate duly forwarded by the Head of the institution immediately to the GSRF to enable the office to send the approval/sanction letters.</li>
                                    <li>Research Start-up grant is not transferable.</li>
                                    <li>It is expected that at least one research paper is published in a reputed journal through the the work carried out through the grant</li>
                                    <li>The recipients of grants are encouraged to publish research papers based on the research work done during this period in journals of high repute (UGC CARE list Group II journals). The investigator should acknowledge the support from the GSRF in their publications. </li>
                                    <li>The recipients shall also inform GSRF about any publications that have resulted because of the award of the grant, even if the articles are published after the completion of the tenure of the support. A soft copy of the published paper should be sent to the GSRF.</li>
                                    <li>No extension in tenure is permissible.</li>
                                    <li>Grantees must submit a Final Technical Report, Utilization Certificate, Statement of Expenditure and Copies of publications (both hard and soft copies) at the end of the grant period. In addition, they must fill in a questionnaire or give a presentation on their work or both on submitting their terminal report.</li>
                                </ol>
                            </div>
                            <div class="col-md-6 pr70">
                                <ol start="8">
                                    <li>If found appropriate, instruments/infrastructure developed through this scheme can be moved to a centralised facility/institute during or on completion of the grant period, as decided by GSRF.</li>
                                </ol>
                                <br><br>

                                <h4>RELAXATION OF CONDITIONS</h4>
                                <p>The Governing Council shall be empowered to relax any or all clauses or conditions of the Scheme in genuine cases.</p>
                                <br><br>

                                <h4>INTERPRETATION</h4>
                                <p>Any question arising regarding the interpretation of any clause, word or expression of the scheme, the decision about the interpretation shall be with the GSRF, which shall be final and binding on all concerned.</p>
                                <br><br>

                                <h4>AMENDMENT</h4>
                                <p>The GSRF reserves the right to amend the terms and conditions of the scheme as and when required for better and effective implementation of the Scheme. </p>
                                <p>The Governing Council of Goa State Research Foundation approved the scheme during its first meeting on 21st July 2023.</p>
                                <!-- <p>Please go through the details of the scheme and other details given below before applying. If you have already gone through these details, please click here to APPLY</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax" id="faq">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title">FAQs (Frequently Asked Questions)</h4>
            </div>
            <div class="row multiContent justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12">
                    <ul class="faq-list">
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq1" class="collapsed question">
                                I completed two years after joining. Can I apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    This scheme is for people within two years of joining a regular position. However, you can apply for GSRF Minor Grants Research Scheme.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">
                                I don’t have a PhD degree. Can I apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    You can, provided you are a M.D/M.S/M.D.S/M.V.Sc. degree holder
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">
                                I have registered for PhD degree. Can I apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    No! You should have PhD degree on the date of your application.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">
                                I have applied for another project. Am I eligible to apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    You can! When sanctioning this grant, you should not have had any other project sanctioned for you.
                                </p>
                            </div>
                        </li>
                    </ul>
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
                <div class="col-md-6">
                    <ol type="1">
                        <li>Category certificate in applicable cases (in pdf format to upload)</li>
                        <li>PwD certificate in applicable cases (in pdf format to upload)</li>
                        <li>Certificate (Declaration) from PI (in pdf format to upload)</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="4">
                        <li>Endorsement from the Principal/HoI/Registrar (in pdf format to upload)</li>
                        <li>Curriculum Vitae (Biodata) (in pdf format to upload)</li>
                        <li>Aadhar Card - Self Attested (in pdf format to upload)</li>
                    </ol>
                </div>
            </div>
        </div>
        <div id="document-formats"></div>
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
                                foreach ($researchStartUpGrantsRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>'.++$key.'</td>
                                        <td>'.$value['name'].'</td>
                                        <td><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download"></i> '.$value['fileName'].''.$researchStartUpGrantsRequiredDocs['file_format_1'].'</a></td>
                                        <td>';
                                        if ($value['url_type_2']) {
                                            echo '<a href="'.$value['url_type_2'].'" class="customLink"><i class="bi bi-download"></i> '.$value['fileName'].''.$researchStartUpGrantsRequiredDocs['file_format_2'].'</a></td>';
                                        }
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div id="documents-required"></div>
    </section>

    <section class="inner-page readableContent normalFont pMax text-center">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title"> </h4>
            </div>
            <div class="row gx-5 multiContent text_left user_application_not_exist">
                <div class="col-md-12">
                    <?php if ($researchStartUpGrantsRequiredDocs["status"]=="open" && $researchStartUpGrantsRequiredDocs["app_type"]=="doc") { 
                            echo $researchStartUpGrantsRequiredDocs["message_bottom"];
                        } else if ($researchStartUpGrantsRequiredDocs["status"]=="close") { 
                            echo $researchStartUpGrantsRequiredDocs["message"];
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
                        if ($researchStartUpGrantsRequiredDocs["status"]=="open") {    
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'RSG\',\''.$researchStartUpGrantsRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$researchStartUpGrantsRequiredDocs['btn_title'].'</a>
                                <p class="note">
                                    If you have gone through the details given above,
                                    <br> ';
                                    if ($researchStartUpGrantsRequiredDocs["app_type"]=="form") { 
                                        echo 'you can click here to APPLY';
                                    } else if ($researchStartUpGrantsRequiredDocs["app_type"]=="doc") { 
                                        echo 'you can click here to Submit Application Form';
                                    }
                            echo '</p>'; 
                        } else if ($researchStartUpGrantsRequiredDocs["status"]=="pending" || $researchStartUpGrantsRequiredDocs["status"]=="result") { 
                            echo $researchStartUpGrantsRequiredDocs["message"];

                            if ($researchStartUpGrantsRequiredDocs["status"]=="result") { 
                                echo '<a href="'.$researchStartUpGrantsRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                            } 
                        } 
                    ?>
                </div>
            </div>
            <div class="row gx-5 multiContent justify-content-md-center user_application_exist d-none">
                <div class="col-md-12">
                    <p class="scheme-status m-0"><?php echo $researchStartUpGrantsRequiredDocs["app_download_msg"] ?></p>
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
$localStorageKey = 'researchStartupData';
require "layout/upload-application.php"; 
require "layout/footer.php"; 
?>
 
<script src="assets/js/custom-upload-file-application.js?<?php echo time() ?>"></script>
<script type="text/javascript">
    var saveData = {};
    let schemeBatchId = "<?php echo $researchStartUpGrantsRequiredDocs["scheme_batch_id"] ?>";
    let schemeStatus = "<?php echo $researchStartUpGrantsRequiredDocs["status"] ?>";
    let schemeAppType = "<?php echo $researchStartUpGrantsRequiredDocs["app_type"] ?>";
    // custom requirement 
    let isFileUploaded = 0;

    $(document).ready(function() {
        document.getElementById('eligibility').style.display = "block";
        $("#eligibility.tabcontentCriteria").addClass(" active");
        
        //  Assign variable to store
        localStorage.setItem("researchStartupData", JSON.stringify({}));
        
        // get user application response
        if (userId && schemeStatus!='result') {
            callApi({
                method: 'GET',
                url: 'api/userApi.php?userId=' + userId + '&schemeBatchId='+schemeBatchId + '&type=RSG',
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
            url: 'api/schemeResearchStartupGrantApi.php',
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
            url: 'api/schemeResearchStartupGrantApi.php?id=' + userId + '&schemeBatchId='+schemeBatchId + '&type=download-pdf',
            form_type: 'download-pdf',
        });
        // location.href ="api/schemeResearchStartupGrantApi.php?id=" + userId + '&schemeBatchId='+schemeBatchId + "&type="+type;
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