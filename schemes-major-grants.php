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
                        GSRF Major Research Grant Scheme
                    </h2>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_not_exist">
                    <?php 
                        echo $majorGrantsRequiredDocs["message"];

                        if ($majorGrantsRequiredDocs["status"]=="open") {
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'MAJ\',\''.$majorGrantsRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$majorGrantsRequiredDocs['btn_title'].'</a>';
                            echo $majorGrantsRequiredDocs["note"];
                        }
                        if ($majorGrantsRequiredDocs["status"]=="result") { 
                            echo '<a href="'.$majorGrantsRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                        }
                    ?>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_exist d-none">
                    <p class="scheme-status m-0"><?php echo $majorGrantsRequiredDocs["app_download_msg"] ?></p>
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
                        National Education Policy 2020 recognises the importance of Research and knowledge creation in sustaining a vibrant economy. The significance of high-quality, interdisciplinary research across fields is felt much more than ever.
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Hence, the “GSRF Major Research Grant Scheme” has been designed to provide financial assistance to the faculty members of Goa University and its affiliated and autonomous colleges on a competitive basis to pursue research work along with their regular academic engagement. The Scheme will promote research in all the basic, applied and interdisciplinary/multidisciplinary areas by providing financial assistance on a competitive basis.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="inner-page readableContent normalFont pMax">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title">OBJECTIVES AND SCOPE OF THE SCHEME </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">
                    <p>
                        This scheme aims to promote excellence in research and innovation in Higher Education Institutes by supporting researchers in various disciplines by providing funding. Research that considers local needs and works in collaboration with industries and Government Departments, whose benefits will ultimately reach society, will be promoted.
                    </p>
                    <p> The key objective of the scheme is: </p>
                    <ol type="i">
                        <li>
                            To create a research ambience in the State of Goa through Goa University and its affiliated and autonomous colleges by promoting research in basic, applied, interdisciplinary and multidisciplinary areas.
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <p>
                        Research and Development activities are considered essential components of the higher education system because they create new knowledge and insights and impart excitement and dynamism to the education process. The scope of the scheme includes creating and improving the general research capabilities of the faculty members of the various Higher Educational Institutes (Goa University and its affiliated and autonomous colleges).
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
                        The Goa State Research Foundation (GSRF) shall implement and operate this scheme. 
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
                <h4 class="title">  PATTERN OF ASSISTANCE </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">  
                    <p>
                        The <strong>quantum of assistance</strong> for a major research project under this scheme will be as under
                    </p>
                    <ol type="a">
                        <li>The maximum permissible grant in the disciplines <strong>outside STEM</strong> areas (eg. Humanities, Social Sciences, Arts, Languages, Commerce, Law, management, etc.) will be Rs. 15.00 lakhs only, i.e. Non-recurring Rs. 2.00 Lakhs and Recurring Grants-Rs. 13.00 Lakhs.</li>
                        <li>The maximum permissible grant in the disciplines <strong>in STEM</strong> areas (eg. Sciences, Engineering, Technology) will be Rs. 25.00 lakhs only, i.e. Non-recurring Rs. 5.00 Lakhs and Recurring Grants-Rs. 20.00 Lakhs.</li>
                        <li>The maximum permissible grant in the interdisciplinary areas involving <strong>STEM</strong> areas (eg. Sciences, Engineering, Technology) will be Rs. 25.00 lakhs only, i.e. Non-recurring Rs. 5.00 Lakhs and Recurring Grants-Rs. 20.00 Lakhs. This also includes STEM areas involving non-STEM areas.</li>
                        <li>The maximum permissible grant in the interdisciplinary areas involving outside STEM areas (eg. Humanities, Social Sciences, Arts, Languages, Commerce, Law, management, etc.) will be Rs. 15.00 lakhs only, i.e. Non-recurring Rs. 2.00 Lakhs and Recurring Grants-Rs. 13.00 Lakhs</li>
                    </ol>
                    <p>
                        The following are the Heads under which the budget will be recognised:
                    </p>
                    <ol>
                        <li>
                            <strong>Non-Recurring Grants</strong>
                            <ol type="I">
                                <li>Minor Equipment</li>
                                <!-- <li>Books and Journals</li> -->
                            </ol>
                            <p>The equipment, 
                                <!-- Books and Journals  --> 
                                grants may be utilised to procure the essential equipment and 
                                <!-- books and journals  --> 
                                needed for the proposed research work.</p>
                            <p>The Equipment, 
                                <!-- Books and Journals  --> 
                                acquired by the P.I. under this scheme must be deposited at College / Goa University, as the case may be, after the completion of the project. These items will be institutional property.</p>
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="2">
                        <li>
                            <strong>Recurring Grants</strong>
                            <ol type="1">
                                <li><strong>Project staff:</strong> This is basically for appointing temporary staff such as Project Assistants. The fellowship will be Rs. 20,000/- per month (rupees twenty thousand only) or as per the guidelines issued from time to time by the GSRF.</li>
                                <li><strong>Hiring Services:</strong> This is meant for specialised technical services available on a payment basis, such as sample analysis, for which the University/College/institution has no infrastructure.</li>
                            <!-- </ol>
                        </li>
                        <li>
                            <ol start="3"> -->
                                <li><strong>Contingency: </strong> The admissible contingency grant may be utilised on spares for apparatus, photostat copies and microfilms, typing, stationery, postage, telephone calls, internet, fax, computation, printing and other project-related items. Expenditure towards the audit fee may also be claimed under the contingency head.</li>
                                <li><strong>Chemicals and Consumables: </strong> To meet expenditure on chemicals, glassware and other consumable items.</li>
                                <li><strong>Travel and/or Field Work: </strong> The amount allocated under the head travel/field work will be utilised for data collection and other information, including documents and visits to libraries within the general scope and sphere of the ongoing project. This can also be used for attending conferences, seminars, workshops, training courses, etc.; however, it should be directly related to the project work and, at most, one event in a year. No foreign travel will be allowed under this scheme.</li>
                                <li><strong>Special Need: </strong> Assistance may be provided for any other special requirement concerning the project which is not covered under any other ‘Head’ of assistance under the scheme.</li>
                                <li><strong>Overhead charges: </strong> Institutional overhead charges are NOT PERMITTED under this scheme.</li>
                            </ol>
                            <p>
                                Grants will be released to the principal of the college/Registrar of the Goa University/Head of the Institution.
                            </p>
                        </li>
                        <li>
                            <strong>RE-APPROPRIATION:</strong> 
                            <p>
                                The Principal Investigator may re-appropriate a maximum of 20 per cent of the non-recurring grant to a recurring grant and vice-versa allocated under each Head with the permission of GSRF by providing proper justification.
                            </p>
                        </li>
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
                                <p>
                                    Financial assistance for Major Research Projects under this scheme can be availed by the full-time regular faculty of Goa University and its affiliated/autonomous colleges and Goa Government-funded Research Institutes.
                                </p>
                                <ol>
                                    <li>
                                        The Principal Investigator (P.I.) and Co-Principal Investigator, if any, should be a full-time regular employee with a PhD degree or M.D./M.S./M.D.S./M.V.Sc. in the fields of Medicine, Dental or Veterinary, and an interest in high-quality research. 
                                    </li>
                                </ol>
                            </div>
                            <div class="col-md-6 pl70">
                                <ol start="2">
                                    <li>Individual faculty members can apply for a maximum of two projects at a time. However, if both projects are selected, the applicant can choose only one.</li>
                                    <li>A faculty member can avail of only one project under this or any other scheme of GSRF at any given time.</li>
                                    <li>The PI (and Co PI) shall have minimum 04 years of service remaining before superannuation.</li>
                                    <li>The Co-PI(if any) should be from another Department /School (and not from the same as the PI)</li>
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
                                    The Applicants are required to apply online as per the format in response to the call by GSRF. Pre-registration of PI, Co-PI (if any) and the institution is a must for applying online.
                                </p>
                                <br><br>
                                
                                <h4>PROCEDURE FOR APPROVAL</h4>
                                <p>
                                    The applications received, complete in all aspects, will be peer-reviewed by the subject experts. Based on the review, recommendations will be made by the committee constituted for the purpose. The Governing Council of GSRF will take the final decision based on the recommendations made by the committee and the availability of funds under the scheme.
                                </p>
                                <br><br>
                                
                                <h4>PROCEDURE FOR RELEASE OF GRANTS</h4>
                                <p>
                                    The first instalment of the grant shall comprise 100% of the Non-Recurring grant and 100% of the Recurring grant approved by the GSRF for the first year. The grant will be released to the Principal of the college/Registrar of the Goa University/Head of the Institution.
                                </p>
                                <p>
                                    On submission of the Annual Progress Report, statement of expenditure and utilisation certificate of 1st instalment of the grant, the second year grant will be released as the second instalment. Following a similar procedure, the third-year instalment will be released. 
                                </p>
                            </div>
                            <div class="col-md-6 pr70">
                                <h4>COMPLETION OF THE PROJECT</h4>
                                <p>
                                    The following documents shall be submitted within three months from the end of the project:
                                </p>
                                <ol>
                                    <li>Copy of the Final Technical Report of the project along with the soft copy.</li>
                                    <li>A consolidated item-wise detailed statement of expenditure incurred during the entire project period in the prescribed proforma duly signed and sealed by the PI and the Principal of the college/Registrar of the Goa University/Head of the Institution.</li>
                                    <li>A consolidated Audited Utilization Certificate for the amount utilised towards the project duly signed and sealed by the Chartered Accountant, Principal of the college/Registrar of the Goa University/Head of the Institution and the PI in the prescribed proforma.</li>
                                    <li>The unutilised grant, if any, shall be refunded immediately through a demand draft in favour of GSRF.</li>
                                    <li>The committee constituted for the purpose should review the completion report.</li>
                                </ol>
                                <br><br>
                            </div>
                        </div>
                    </div>
                    <div id="condition" class="tabcontent tabcontentCriteria">
                        <div class="my-5">
                            <h2 class="title">CONDITIONS</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr70">
                                <h4>GENERAL</h4>
                                <ol type="1">
                                    <li>After the finalisation of the selection of the Major Research projects, the names of the selected PIs will be intimated to the respective institutions and/or PI. The PIs should send their acceptance certificate duly forwarded by the principal of the college/Registrar of the Goa University/Head of the Institution immediately to the GSRF.</li>
                                    <li>The project is not transferable.</li>
                                    <li>In case the PI is transferred from his/her original place of work to another Institution within Goa, a No Objection Certificate should be furnished for the transfer of the project from the host Institution. The new host institution shall provide a certificate stating that the Institution will provide necessary facilities to the awardee for the smooth functioning of the project. The assets acquired can be transferred to the new institution in case of ongoing projects.</li>
                                    <li>The GSRF encourages publishing results of the project supported by the GSRF. However, the investigator should acknowledge the support received from the GSRF in these publications.</li>
                                    <li>Generally, no extension in tenure is permissible.</li>
                                </ol>
                            </div>
                            <div class="col-md-6 pr70">
                                <h4>RELAXATION OF CONDITIONS</h4>
                                <p>
                                    The GSRF is empowered to relax any or all clauses or conditions of the scheme in genuine cases.
                                </p>
                                <br><br>

                                <h4>INTERPRETATION</h4>
                                <p>
                                    If any questions arise regarding the interpretation of any clause, word or expression of the scheme, the decision about the interpretation shall be with the GSRF, which shall be final and binding on all concerned.
                                </p>
                                <p>
                                    The Governing Council of Goa State Research Foundation approved the scheme during its first meeting on 21st July 2023.
                                </p>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent normalFont pMax">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title"> TENURE AND IMPLEMENTATION:</h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">
                    <p>
                        The project's tenure sanctioned under GSRF Major Research Grant Scheme will be three years (3 years) from the project's sanction date.
                    </p>
                </div>
                <div class="col-md-6">
                    <p>

                    </p>
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
                                I am a co-PI in a proposal submitted by my colleague. Am I still eligible to submit a proposal as a PI?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes. Still, you can apply. If both are sanctioned, you can still continue as Co-PI in other projects.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="documents-required"></div>
    </section>

    <section class="inner-page readableContent normalFont pMax">
        <div class="container">
            <div class="section-header">
                <h4 class="title"> Documents required </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-12">
                    <ol type="1">
                        <li>Category certificate in applicable cases (in pdf format to upload)</li>
                        <li>PwD certificate in applicable cases (in pdf format to upload)</li>
                        <li>Certificate (Declaration) from PI (in pdf format to upload)</li>
                        <li>Endorsement from the Principal/HoI/Registrar (in pdf format to upload)</li>
                        <li>Curriculum Vitae (Biodata) (in pdf format to upload)</li>
                        <li>Aadhar card of the PI /Co-PI (self attested) (in pdf format to upload)</li>
                        <li>PhD Certificates(self attested) (in pdf format to upload)</li>
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
                                foreach ($majorGrantsRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>'.++$key.'</td>
                                        <td>'.$value['name'].'</td>
                                        <td><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download"></i> '.$value['fileName'].''.$majorGrantsRequiredDocs['file_format_1'].'</a></td>
                                        <td>';
                                        if ($value['url_type_2']) {
                                            echo '<a href="'.$value['url_type_2'].'" class="customLink"><i class="bi bi-download"></i> '.$value['fileName'].''.$majorGrantsRequiredDocs['file_format_2'].'</a></td>';
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
                    <?php if ($majorGrantsRequiredDocs["status"]=="open" && $majorGrantsRequiredDocs["app_type"]=="doc") { 
                            echo $majorGrantsRequiredDocs["message_bottom"];
                        } else if ($majorGrantsRequiredDocs["status"]=="close") { 
                            echo $majorGrantsRequiredDocs["message"];
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
                        if ($majorGrantsRequiredDocs["status"]=="open") {    
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'MAJ\',\''.$majorGrantsRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$majorGrantsRequiredDocs['btn_title'].'</a>
                                <p class="note">
                                    If you have gone through the details given above,
                                    <br> ';
                                    if ($majorGrantsRequiredDocs["app_type"]=="form") { 
                                        echo 'you can click here to APPLY';
                                    } else if ($majorGrantsRequiredDocs["app_type"]=="doc") { 
                                        echo 'you can click here to Submit Application Form';
                                    }
                            echo '</p>'; 
                        } else if ($majorGrantsRequiredDocs["status"]=="pending" || $majorGrantsRequiredDocs["status"]=="result") { 
                            echo $majorGrantsRequiredDocs["message"];
                            
                            if ($majorGrantsRequiredDocs["status"]=="result") { 
                                echo '<a href="'.$majorGrantsRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                            } 
                        } 
                    ?>
                </div>
            </div>
            <div class="row gx-5 multiContent justify-content-md-center user_application_exist d-none">
                <div class="col-md-12">
                    <p class="scheme-status m-0"><?php echo $majorGrantsRequiredDocs["app_download_msg"] ?></p>
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
$localStorageKey = 'majorResearchProjectData';
require "layout/upload-application.php"; 
require "layout/footer.php"; 
?>
 
<script src="assets/js/custom-upload-file-application.js?<?php echo time() ?>"></script>
<script type="text/javascript">
    var saveData = {};
    let schemeBatchId = "<?php echo $majorGrantsRequiredDocs["scheme_batch_id"] ?>";
    let schemeStatus = "<?php echo $majorGrantsRequiredDocs["status"] ?>";
    let schemeAppType = "<?php echo $majorGrantsRequiredDocs["app_type"] ?>";
    // custom requirement 
    let isFileUploaded = 0;

    $(document).ready(function() {
        document.getElementById('eligibility').style.display = "block";
        $("#eligibility.tabcontentCriteria").addClass(" active");
        
        //  Assign variable to store
        localStorage.setItem("majorResearchProjectData", JSON.stringify({}));

        // get user application response
        if (userId && schemeStatus!='result') {
            callApi({
                method: 'GET',
                url: 'api/userApi.php?userId=' + userId + '&schemeBatchId='+schemeBatchId + '&type=MAJ',
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
            url: 'api/schemeMajorResearchProjectApi.php',
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
            url: 'api/schemeMajorResearchProjectApi.php?id=' + userId + '&schemeBatchId='+schemeBatchId + '&type=download-pdf',
            form_type: 'download-pdf',
        });
        // location.href ="api/schemeMajorResearchProjectApi.php?id=" + userId + '&schemeBatchId='+schemeBatchId + "&type="+type;
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