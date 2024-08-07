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
                        GSRF Post-Doctoral Fellowship Scheme
                    </h2>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_not_exist">
                    <?php 
                        echo $postDoctoralFellowshipRequiredDocs["message"];

                        if ($postDoctoralFellowshipRequiredDocs["status"]=="open") {
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'PDF\',\''.$postDoctoralFellowshipRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$postDoctoralFellowshipRequiredDocs['btn_title'].'</a>'; 
                            echo $postDoctoralFellowshipRequiredDocs["note"];
                        }
                        if ($postDoctoralFellowshipRequiredDocs["status"]=="result") { 
                            echo '<a href="'.$postDoctoralFellowshipRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                        }
                    ?>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_exist d-none">
                    <p class="scheme-status m-0"><?php echo $postDoctoralFellowshipRequiredDocs["app_download_msg"] ?></p>
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
                        One of the exciting periods of one’s research career is the time between submitting a PhD thesis and getting a regular position. During this transition period, with already gained research expertise, they can do frontier research. The post-Doctoral period provides time free of any regular teaching and administrative responsibilities. It lays a solid foundation to become an independent researcher before taking up a full-time academic or research position. However, financial support to Post-Doctorates through fellowships and grants is crucial for continuing their research, which leads to capacity building and enhancing research quality and innovation.
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        This “GSRF Post-Doctoral Fellowship Scheme” envisages promoting research in all disciplines by providing financial assistance to the post-doctoral fellows at Goa University and other institutes of repute within and outside Goa, as laid down in this notification, to undertake research activities.  The Post-Doctoral Fellows will catalyse the research environment in the State by engaging with students, Research Scholars and faculty.
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
                        This scheme aims to promote excellence in research and innovation in Higher Education by supporting young researchers at the post-doctoral level in various disciplines. 
                    </p>
                    <p>
                        The scope of this Scheme is to provide Postdoctoral Fellowships to young and bright Doctorates to continue with their independent research. 
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        The following are the key objectives: 
                    </p>
                    <ol type="a">
                        <li>Attract world-class researchers from India as well as from abroad to Goa</li>
                        <li>Fellows will work on world-class and frontier areas of research</li>
                        <li>Help develop a vibrant research culture in the State of Goa</li>
                        <li>Mentoring graduates, post-graduate and PhD students with PDFs</li>
                        <li>Publish research articles in high-impact research journals</li>
                        <li>Fostering collaborations with other researchers through PDFs. </li>
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
                    <ol type="I">
                        <li>
                            The award shall consist of a Fellowship amounting to Rs 60,000/- (Sixty thousand only) per month (consolidated) and a Research grant of Rs 1,00,000/- (One lakh only) per annum. The fellowship is tenable for a period of 2 years.
                        </li>
                        <li>
                            The amount received under the Scheme may be utilised to incur the expenditure on the following items:
                            <ol>
                                <li>
                                    <strong>Fellowship: </strong>
                                    The amount allotted under this head shall be utilised as a stipend (monthly fellowship) to carry out proposed research work.
                                </li>
                            </ol>
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="2">
                        <li>
                            <strong>Research Grant: </strong>
                            The admissible Research grant can be used for minor equipment, consumables, contingencies and domestic travel. Research grants may be utilised on spares for apparatus, photocopies and microfilms, typing, stationery, postage, telephone calls, internet, fax, computation, printing and other project-related items. Expenditure towards the audit fee may also be claimed under the research grant head. It can be used to purchase chemicals, glassware and other consumable items. There is no provision for providing manpower support under this scheme. The Fellow is expected to undertake the research objectives by himself/herself during the entire fellowship.
                        </li>
                        <li>Grants will be released to the Head of the Institution. The expenditure shall be debited to the appropriate Budget Head. </li>
                        <li>Instruments/equipment/books/journals/other resources acquired under this scheme must be shared with other researchers and deposited to the Institute after the Fellowship is completed, which will be the institutional property. </li>
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
                        <p>
                            The Post-Doctoral Fellowship (PDF) scheme aims to identify motivated and ambitious young researchers and provide them with financial support for engaging in world-class research in frontier areas across the disciplines. To be eligible, the candidate must fulfil the following conditions: 
                        </p>
                        <div class="row">
                            <div class="col-md-6 pr70">
                                <ol>
                                    <li>Must have obtained a PhD from a recognised University/ institute. </li>
                                    <li>The upper age limit for the fellowship is 45 years, calculated as on the last date of the application submission. </li>
                                    <li>This Post-doctoral fellowship can be availed only once by a candidate in his/her career.</li>
                                    <li>The Post-doctoral fellow will work under the guidance of a mentor from the Host institution. </li>
                                    <li>The applicant shall have a 15-year certificate of residence from Goa.</li>
                                    <li>
                                        An applicant without 15 years certificate of residence from Goa can also apply for this fellowship, provided the applicant’s PhD degree is from any of the following types of Institution: 
                                        <ol type="a">
                                            <li>The Top 15 ranked institutes in NIRF (University or Research category) </li>
                                            <li>Institutions of National Importance / Institutions of Eminence/ National Research Institutions </li>
                                            <li>Foreign University/Institute (QS/THE/ARWU ranking among the top 500 in World University ranking at any time). </li>
                                            <li>However, it is mandatory to choose Goa University as the host institution for postdoctoral work in such cases. </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                            <div class="col-md-6 pl70">
                                <ol start="7">
                                    <li>Candidates who obtained a PhD degree from Goa University must choose the Host institution from the list of the Top 25 ranked institutes in NIRF (University or Research category) or a National Research Institution to carry out postdoctoral work. Those applicants with 15 years certificate of residence from Goa but who obtained a Ph.D. degree from other than Goa University must choose Goa University as their host institution. </li>
                                    <li>The proposed mentor must hold a regular academic/research position in a recognised institution in Goa/India and should have a Ph.D. degree in the subject related to the research proposal submitted by the candidate. </li>
                                    <li>The mentor shall not have more than one postdoctoral fellow under this scheme at any given time. </li>
                                    <li>The candidate cannot have the same person as the Mentor if he/she has served as his/her PhD supervisor.  </li>
                                    <li>The Post-doctoral fellows are not eligible to receive any other fellowship/salary from any Government or Non-Governmental sources during the tenure of the fellowship. </li>
                                    <li>There is no provision for providing manpower support under this scheme. The fellows are expected to undertake independent research during the entire fellowship duration.   </li>
                                    <li>The fellowship is a temporary assignment and is tenable for two years. </li>
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
                                    Candidates must submit their application online, along with certificates and documents in response to the call/advertisement issued by the GSRF from time to time in the prescribed proforma, which will be available on the official website of the GSRF. 
                                </p>
                                <br><br>

                                <h4>PROCEDURE FOR SELECTION OF POST-DOCTORAL FELLOWS</h4>
                                <ol type="a">
                                    <li>
                                        Applications received from applicants will be assessed by experts/an expert committee constituted by the GSRF. 
                                    </li>
                                    <li>
                                        An Expert Committee shall be constituted for this purpose by the Chairperson, GSRF, with the Experts in the field as members for considering the Proposals.
                                    </li>
                                    <li>
                                        The Committee shall scrutinise the proposals received for fellowship and recommend the eligible candidates in order of merit. 
                                    </li>
                                    <li>
                                        The Governing Council of GSRF will take the final decision based on recommendations made by the Committee and the availability of funds under the scheme.
                                    </li>
                                </ol>
                                <br><br>
                            </div>
                            <div class="col-md-6 pr70">
                                <h4>PROCEDURE FOR RELEASE OF FELLOWSHIP/GRANTS</h4>
                                <p>
                                    The first-year Fellowship and Research grant of Rs 1,00,000/- (One lakh only) will be released after receiving the joining letter from the Post-doctoral fellow to the host institution. The second-year grant will be released upon the receipt of the following documents: (i) Annual Progress Report; (ii) Annual Statement of Expenditure and Utilisation Certificate. 
                                </p>
                                <p>
                                    <strong>Upon completion of the Fellowship,</strong> the following documents must be submitted:
                                </p>
                                <ol type="a">
                                    <li>Copy of the final report of research work along with a soft copy.</li>
                                    <li>A consolidated item-wise detailed statement of expenditure incurred during the entire fellowship period, duly signed and sealed by the Registrar/Head of the Institution, Finance Officer and the Research guide/Mentor.</li>
                                    <li>A consolidated Audited Utilization Certificate for the amount utilised to carry out proposed research work duly signed and sealed by the Chartered Accountant/Finance Officer, Registrar/Head of the Institution, and the Research guide/Mentor.</li>
                                    <li>The unutilised fund, if any, should be refunded immediately after termination or completion of fellowship through a demand draft drawn in favour of the <strong>GSRF</strong>.</li>
                                </ol>
                                <p>The host institution of the fellows is expected to settle the accounts immediately upon termination or completion of the fellowship.</p>
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
                                <ol>
                                    <li>
                                        After finalisation of the selection of the applicants, the selected candidates will be intimated of their selection. The awardees should send their acceptance certificate within two weeks to the GSRF duly forwarded by the Head of the institution to enable this foundation to send the approval/sanction lette
                                        rs.</li>
                                    <li>
                                        Fellowship is not transferable to any other person.
                                    </li>
                                    <li>
                                        If the Research guide/ mentor is transferred from his/her original place of work to another Institution, No Objection Certificate should be furnished for the transfer of the fellowship from the host institution. The new host Institution shall provide a certificate stating that necessary facilities will be provided by the Institution to which the awardee is transferred for the smooth functioning of the fellowship. This shall be approved by the GSRF.
                                    </li>
                                    <li>
                                        The fellows are encouraged to publish research papers based on the research work done during the fellowship in journals of high repute (UGC CARE list Group II journals). The fellows should acknowledge the support received from the GSRF in their publications. 
                                    </li>
                                    <li>
                                        The fellows shall also inform GSRF about any publications that have resulted because of the award of the fellowship, even if the articles are published after the completion of the fellowship tenure. A soft copy of the published paper should be sent to the GSRF.
                                    </li>
                                </ol>
                            </div>
                            <div class="col-md-6 pr70">
                                <ol start="6">
                                    <li>
                                        The GSRF reserves the right to terminate the Fellowship at any stage if it is convinced that desired progress is not seen and/or the research grant is inappropriately utilised.
                                    </li>
                                    <li>
                                        No extension in tenure is permissible under any circumstances.
                                    </li>
                                    <li>
                                        If found appropriate, instruments/infrastructure developed through this scheme can be moved to a centralised facility/institute during or on completion of the fellowship, as decided by GSRF.
                                    </li>
                                </ol>
                                <br><br>

                                <h4>RELAXATION</h4>
                                <p>The Governing Council of GSRF is empowered to relax any or all clauses or conditions of the Scheme in genuine cases.</p>
                                <br><br>

                                <h4>INTERPRETATION</h4>
                                <p>If any question arises regarding the interpretation of any clause, word or expression of the scheme, the decision about the interpretation shall be with the GSRF, which shall be final and binding on all concerned.</p>
                                <br><br>

                                <h4>AMENDMENT</h4>
                                <p>The Governing Council of GSRF reserves the right to amend the terms and conditions of the scheme as and when required for better and more effective implementation of the Scheme.  </p>
                                <p>The Governing Council of Goa State Research Foundation approved the scheme during its first meeting on 21st July 2023.</p>
                            </div>
                        </div>
                    </div>
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
                <div class="col-md-6">
                    <ol type="1">
                        <li>Category certificate in applicable cases (in pdf format to upload)</li>
                        <li>PhD certificate </li>
                        <li>Residence certificate (in applicable cases)</li>
                        <li>Softcopies of publications (as a single pdf file)</li>
                        <li>Certificate (Declaration) from the candidate (in pdf format to upload)</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="6">
                        <li>Certificate from the mentor (in pdf  format to upload)</li>
                        <li>Endorsement from the Head of the host Institute (in pdf format to upload)</li>
                        <li>CV of the candidate (in pdf format to upload)</li>
                        <li>CV of the mentor</li>
                        <li>Aadhar card (Self Attested)</li>
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
                                foreach ($postDoctoralFellowshipRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>'.++$key.'</td>
                                        <td>'.$value['name'].'</td>
                                        <td><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download"></i> '.$value['fileName'].''.$postDoctoralFellowshipRequiredDocs['file_format_1'].'</a></td>
                                        <td>';
                                        if ($value['url_type_2']) {
                                            echo '<a href="'.$value['url_type_2'].'" class="customLink"><i class="bi bi-download"></i> '.$value['fileName'].''.$postDoctoralFellowshipRequiredDocs['file_format_2'].'</a></td>';
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
                    <?php if ($postDoctoralFellowshipRequiredDocs["status"]=="open" && $postDoctoralFellowshipRequiredDocs["app_type"]=="doc") { 
                            echo $postDoctoralFellowshipRequiredDocs["message_bottom"];
                        } else if ($postDoctoralFellowshipRequiredDocs["status"]=="close") { 
                            echo $postDoctoralFellowshipRequiredDocs["message"];
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
                        if ($postDoctoralFellowshipRequiredDocs["status"]=="open") {    
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'PDF\',\''.$postDoctoralFellowshipRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$postDoctoralFellowshipRequiredDocs['btn_title'].'</a>
                                <p class="note">
                                    If you have gone through the details given above,
                                    <br> ';
                                    if ($postDoctoralFellowshipRequiredDocs["app_type"]=="form") { 
                                        echo 'you can click here to APPLY';
                                    } else if ($postDoctoralFellowshipRequiredDocs["app_type"]=="doc") { 
                                        echo 'you can click here to Submit Application Form';
                                    }
                            echo '</p>'; 
                        } else if ($postDoctoralFellowshipRequiredDocs["status"]=="pending" || $postDoctoralFellowshipRequiredDocs["status"]=="result") { 
                            echo $postDoctoralFellowshipRequiredDocs["message"];
                            
                            if ($postDoctoralFellowshipRequiredDocs["status"]=="result") { 
                                echo '<a href="'.$postDoctoralFellowshipRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                            } 
                        } 
                    ?>
                </div>
            </div>
            <div class="row gx-5 multiContent justify-content-md-center user_application_exist d-none">
                <div class="col-md-12">
                    <p class="scheme-status m-0"><?php echo $postDoctoralFellowshipRequiredDocs["app_download_msg"] ?></p>
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
$localStorageKey = 'postdoctoralFellowshipData';
require "layout/upload-application.php"; 
require "layout/footer.php"; 
?>
 
<script src="assets/js/custom-upload-file-application.js?<?php echo time() ?>"></script>
<script type="text/javascript">
    var saveData = {};
    let schemeBatchId = "<?php echo $postDoctoralFellowshipRequiredDocs["scheme_batch_id"] ?>";
    let schemeStatus = "<?php echo $postDoctoralFellowshipRequiredDocs["status"] ?>";
    let schemeAppType = "<?php echo $postDoctoralFellowshipRequiredDocs["app_type"] ?>";
    // custom requirement 
    let isFileUploaded = 0;

    $(document).ready(function() {
        document.getElementById('eligibility').style.display = "block";
        $("#eligibility.tabcontentCriteria").addClass(" active");
        
        //  Assign variable to store
        localStorage.setItem("postdoctoralFellowshipData", JSON.stringify({}));
        
        // get user application response
        if (userId && schemeStatus!='result') {
            callApi({
                method: 'GET',
                url: 'api/userApi.php?userId=' + userId + '&schemeBatchId='+schemeBatchId + '&type=PDF',
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
            url: 'api/schemePostDoctoralFellowshipApi.php',
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
            url: 'api/schemePostDoctoralFellowshipApi.php?id=' + userId + '&schemeBatchId='+schemeBatchId + '&type=download-pdf',
            form_type: 'download-pdf',
        });
        // location.href ="api/schemePostDoctoralFellowshipApi.php?id=" + userId + '&schemeBatchId='+schemeBatchId + "&type="+type;
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