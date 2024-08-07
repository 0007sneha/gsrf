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
                        GSRF Doctoral Research Fellowship Scheme
                    </h2>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_not_exist">
                    <?php 
                        echo $doctoralFellowshipRequiredDocs["message"];

                        if ($doctoralFellowshipRequiredDocs["status"]=="open") {
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'DF\',\''.$doctoralFellowshipRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$doctoralFellowshipRequiredDocs['btn_title'].'</a>';
                            echo $doctoralFellowshipRequiredDocs["note"];
                        }
                        if ($doctoralFellowshipRequiredDocs["status"]=="result") { 
                            echo '<a href="'.$doctoralFellowshipRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                        }
                    ?>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_exist d-none">
                    <p class="scheme-status m-0"><?php echo $doctoralFellowshipRequiredDocs["app_download_msg"] ?></p>
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
                        Over the past decade, the research portfolio in the State of Goa has steadily grown. However, to achieve global recognition for Goa and to become a hub for high-quality research, there is an immediate need for research capacity building and to grow our global research competitiveness by enhancing research quality and encouraging innovation. 
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        This ‘GSRF Doctoral Research Fellowship Scheme’ envisages promoting research in all disciplines and providing financial assistance to full-time doctoral students from Goa in Goa University, its affiliated or autonomous colleges and Research Centres, as laid down in this notification, to undertake research activities leading to their PhD degrees.
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
                        This scheme aims to promote excellence in research and innovation in Higher Education by supporting young researchers in various disciplines. 
                    </p>
                    <p>The following are the key objectives: </p>
                    <ol type="a">
                        <li>
                            To identify motivated young researchers doing research at PhD level in frontier areas of all disciplines.
                        </li>
                        <li>
                            To provide financial support to them through fellowship and contingency grants and engage them in research.
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <p>
                        The scope of this Scheme is to provide financial assistance to young researchers who do not have any fellowship or scholarship. Assistance will be in the form of fellowship and contingency grant, initially for two years to carry out their Doctoral (PhD) work and extend the same for the third year based on proven performance.
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
                        This scheme shall be implemented and operated by the Goa State Research Foundation (GSRF).
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
                    <ol>
                        <li>
                            A candidate who joined a full-time PhD as per the Goa University process and is selected under this scheme shall be paid Rs. 25,000/- (rupees twenty-five thousand only) monthly. In addition, a contingency grant of Rs 25,000/- (Twenty-five thousand only) per annum will be paid to all the candidates. The fellowship is tenable for 2 years, which is extendable for the 3rd year based on the performance of the doctoral fellow.
                        </li>
                        <li>
                            Grants will be released to the Principal of the College/Head of the Institution
                        </li>
                        <li>
                            Instruments/equipment/books/journals/other resources acquired under this scheme will be the institutional property. They must be shared with other researchers and deposited to the Institute after completion of the Fellowship.
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="4">
                        <li>
                            The amount received under the Scheme may be utilised to incur the expenditure on the following items:
                            <ol>
                                <li>
                                    <strong>Fellowship: </strong>
                                    The amount allotted under this head may be utilised as a stipend (monthly fellowship) to carry out proposed research work. 
                                </li>
                                <li>
                                    <strong>Contingency Grant: </strong>
                                    The admissible contingency grant can be used for purchasing consumables (chemicals, glassware, etc.) and project-related domestic travel, including attending workshops to acquire new skills and/or conferences to present the results of their doctoral work. Grants may also be utilised on spares for apparatus, photocopies and microfilms, typing, stationery, postage, internet, fax, computation, printing, buying books and other project-related items. 
                                </li>
                            </ol>
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
                        <p>
                            The Doctoral (Ph.D.) Fellowship aims to promote fundamental research and create a research culture in the State of Goa. Through this Doctoral Fellowship, meritorious candidates pursuing a full-time PhD program at Goa University, its affiliated or autonomous colleges, or its recognised research centres such as CSIR-NIO, NCPOR and ICAR-CCARI will be supported.  To be eligible, the candidate must have the following:
                        </p>
                        <div class="row">
                            <div class="col-md-6 pr70">
                                <ol type="1">
                                    <li>Have 15 years certificate of residence from Goa,</li>
                                    <li>The candidate must have qualified in any of the examinations recognised by Goa University for PhD admission, </li>
                                    <li>Only full-time PhD students are eligible to apply for this fellowship. Must have a confirmed PhD registration at Goa University within the last one year on the last date of application submission.</li>
                                    <li>Those candidates who do not fall under category (3) above can also apply, provided that they 
                                        <ol type="i">
                                            <li>are not completing three years from the initial (provisional) date of registration at Goa University on the last date for submission of application and </li>
                                            <li>have at least one published article from their PhD work as a lead or corresponding author in UGC-CARE Group II journal.</li>
                                        </ol>
                                    </li>
                                    <li>The maximum support period will be only two years for those candidates falling under category (4). They are not eligible for an extension in the third year.</li>
                                    <li>The upper age limit for the fellowship is 35 years, calculated as of the last date of application submission. Age relaxation of 5 (five) years will be given to candidates belonging to SC/ST/OBC/PWD & Women candidates.</li>
                                </ol>
                            </div>
                            <div class="col-md-6 pl70">
                                <ol start="7">
                                    <li>The selected fellows under this scheme are not eligible to receive any other fellowship/salary from any Government or Non-Governmental sources during the tenure of the fellowship.</li>
                                    <li>The fellowship is tenable only at Goa University, its affiliated or autonomous colleges, or its recognised Research Centres. The host institution should provide necessary administrative and infrastructural support.</li>
                                    <li>The fellowship is purely a temporary assignment and is tenable for a period of 2 years which may be extended for an additional one year for the students falling under the category (3) above, provided the student has at least one published article as a lead author or corresponding author in UGC-CARE Group II journal, during the previous two years.</li>
                                    <li>If the candidate submits his/her thesis during the fellowship period, the day of submission of the thesis will be considered the last day of the fellowship.</li>
                                    <li>Those who are affiliated / registered to / in institution not having provisions for financial assistance / fellowships, will be considered on priority basis for GSRF fellowship</li>
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
                                <p>Candidates must submit their application online in the prescribed proforma, along with required certificates/documents in response to the call/advertisement issued by the GSRF from time to time.</p>
                                <br><br>

                                <h4>PROCEDURE FOR SELECTION OF RESEARCH FELLOWS</h4>
                                <ol type="a">
                                    <li>Applications received from applicants will be scrutinised for eligibility by the officials of GSRF or the committee appointed for the purpose.</li>
                                    <li>The scrutinised proposals shall be reviewed by the experts /expert committee appointed for the purpose and allot scores.</li>
                                    <li>The Governing Council of GSRF will take the final decision based on the scores and recommendations made by the Committee.</li>
                                    <li>The Governing Council will decide the number of fellowships based on the availability of funds under the scheme.</li>
                                </ol>
                                <br><br>

                                <h4>PROCEDURE FOR RELEASE OF FELLOWSHIP/GRANTS</h4>
                                <p>The first six months of the fellowship and the contingency grant of Rs 25,000/- (Twenty-five thousand only) for the first year will be released to the Head of the Institution where the candidate works after the selection.</p>
                            </div>
                            <div class="col-md-6 pr70">
                                
                                <p>The submission of the following documents as per the time frame given is mandatory:</p>
                                <ol type="a">
                                    <li>Six monthly progress reports (at the end of the sixth and eighteenth months).</li>
                                    <li>Satisfactory Performance Report (given by the Research Guide every six months).</li>
                                    <li>Annual Report of the work carried out (at the end of the first year in the prescribed format; to be reviewed by the committee appointed for the purpose).</li>
                                    <li>Annual Statement of Expenditure and Utilization Certificate (at the end of the first year).</li>
                                    <li>Final Technical Report (at the end of the second year in the prescribed format; to be reviewed by the committee appointed for the purpose).</li>
                                    <li>Consolidated Statement of Expenditure and Utilization Certificate (at the end of the second year).</li>
                                    <li>The candidates eligible for the extension (third year) shall submit a request in the prescribed format and a soft copy of their publications along with (e) and (f) above.</li>
                                    <li>The candidates on extension also shall submit a six-monthly report at the end of the thirtieth month and documents as in (e) and (f) at the end of the third year.</li>
                                </ol>
                                <p>The timely release of instalments is contingent upon submitting the documents as above.</p>
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
                                    <li>The selected candidates should send their acceptance certificate within two weeks to the GSRF duly forwarded by the Head of the institution to enable GSRF to send the approval/sanction letters.</li>
                                    <li>Fellowship is not transferable to any other person.</li>
                                    <li>If the Research guide/ mentor is transferred from his/her original place of work to another Institution within the Goa University jurisdiction, No Objection Certificate should be furnished for the transfer of the fellowship from both Institutions stating that necessary facilities will be provided by the Institution in which the awardee is transferred for the smooth functioning of the fellowship, followed by approval from GSRF.</li>
                                    <li>The fellows are encouraged to publish research papers based on the research work done during the fellowship in journals of high repute (UGC CARE list Group II journals). The fellows should acknowledge the support from the GSRF.</li>
                                    <li>The fellows shall also inform GSRF about any publications that have resulted because of the award of the fellowship, even if the articles are published after the completion of the fellowship tenure. A soft copy of the published paper should be sent to the GSRF.</li>
                                    <li>The GSRF reserves the right to terminate the Fellowship at any stage if it is convinced that desired progress is not being made or the fellowship grant is not appropriately utilised.</li>
                                    <li>No extension in tenure is permissible under any circumstances.</li>
                                    <li>If found appropriate, instruments/infrastructure developed through this scheme can be moved to a centralised facility/institute during or on completion of the fellowship by the GSRF.</li>
                                </ol>
                            </div>
                            <div class="col-md-6 pr70">
                                <h4>RELAXATION OF CONDITIONS</h4>
                                <p>The Governing Council of GSRF is empowered to relax any or all clauses or conditions of the Scheme in genuine cases.</p>
                                <br><br>

                                <h4>INTERPRETATION</h4>
                                <p>If any question arises regarding the interpretation of any clause, word or expression of the scheme, the decision about the interpretation shall be with the GSRF, which shall be final and binding on all concerned.</p>
                                <br><br>

                                <h4>AMENDMENT</h4>
                                <p>The Governing Council of GSRF reserves the right to amend the terms and conditions of the scheme as and when required for better and more effective implementation.</p>
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
                                I have registered for PhD but the registration is yet to be confirmed. Can I apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    You can apply only after confirmation of registration.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">
                                I have 15 years of domicile, but I am pursuing my PhD at a University other than Goa University. Can I apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    No. You need to register with Goa University.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">
                                It is more than one year since my registration is confirmed. Am I eligible to apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes,  but you should have published a research paper (as per the condition specified in the scheme).
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">
                                I am getting another fellowship, but I want to apply for this and leave that. Is it permitted?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    No. At the date of application, you should not be availing of any other fellowship.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">
                                I was on fellowship till last month. Now I am not on any fellowship. Am I eligible?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes. You are eligible.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">
                                When I am availing this fellowship, if I get a better fellowship, can I leave this?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes! You can do so by informing GSRF in writing through the proper channel.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq7" class="collapsed question">
                                How long the process will take?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq7" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    The whole reviewing process and approval is likely to take around four months.
                                </p>
                            </div>
                        </li>
                        <li id="documents-required">
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq8" class="collapsed question">
                                Whom to contact for clarification?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq8" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Please write to
                                    <a href="mailto:office.gsrf@gmail.com">office.gsrf@gmail.com</a>
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
                        <li>Category certificate in pdf format (if applicable)</li>
                        <li>Domicile certificate in pdf format</li>
                        <li>Passport photo (jpg format)</li>
                        <li>PhD confirmation letter/certificate from Goa University</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="5">
                        <li id="document-formats">Declaration by the candidate in pdf format</li>
                        <li>Certificate from the Research Guide in pdf format</li>
                        <li>Certificate from the Head of the Institute in pdf format</li>
                        <li>Aadhar Card (Self Attested)</li>
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
                                foreach ($doctoralFellowshipRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>'.++$key.'</td>
                                        <td>'.$value['name'].'</td>
                                        <td><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download"></i> '.$value['fileName'].''.$doctoralFellowshipRequiredDocs['file_format_1'].'</a></td>
                                        <td>';
                                        if ($value['url_type_2']) {
                                            echo '<a href="'.$value['url_type_2'].'" class="customLink"><i class="bi bi-download"></i> '.$value['fileName'].''.$doctoralFellowshipRequiredDocs['file_format_2'].'</a></td>';
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
                    <?php if ($doctoralFellowshipRequiredDocs["status"]=="open" && $doctoralFellowshipRequiredDocs["app_type"]=="doc") { 
                            echo $doctoralFellowshipRequiredDocs["message_bottom"];
                        } else if ($doctoralFellowshipRequiredDocs["status"]=="close") { 
                            echo $doctoralFellowshipRequiredDocs["message"];
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
                        if ($doctoralFellowshipRequiredDocs["status"]=="open") {    
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'DF\',\''.$doctoralFellowshipRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$doctoralFellowshipRequiredDocs['btn_title'].'</a>
                                <p class="note">
                                    If you have gone through the details given above,
                                    <br> ';
                                    if ($doctoralFellowshipRequiredDocs["app_type"]=="form") { 
                                        echo 'you can click here to APPLY';
                                    } else if ($doctoralFellowshipRequiredDocs["app_type"]=="doc") { 
                                        echo 'you can click here to Submit Application Form';
                                    }
                            echo '</p>'; 
                        } else if ($doctoralFellowshipRequiredDocs["status"]=="pending" || $doctoralFellowshipRequiredDocs["status"]=="result") { 
                            echo $doctoralFellowshipRequiredDocs["message"];
                            
                            if ($doctoralFellowshipRequiredDocs["status"]=="result") { 
                                echo '<a href="'.$doctoralFellowshipRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                            } 
                        } 
                    ?>
                </div>
            </div>
            <div class="row gx-5 multiContent justify-content-md-center user_application_exist d-none">
                <div class="col-md-12">
                    <p class="scheme-status m-0"><?php echo $doctoralFellowshipRequiredDocs["app_download_msg"] ?></p>
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
$localStorageKey = 'doctoralFellowshipData';
require "layout/upload-application.php"; 
require "layout/footer.php"; 
?>
 
<script src="assets/js/custom-upload-file-application.js?<?php echo time() ?>"></script>
<script type="text/javascript">
    var saveData = {};
    let schemeBatchId = "<?php echo $doctoralFellowshipRequiredDocs["scheme_batch_id"] ?>";
    let schemeStatus = "<?php echo $doctoralFellowshipRequiredDocs["status"] ?>";
    let schemeAppType = "<?php echo $doctoralFellowshipRequiredDocs["app_type"] ?>";
    // custom requirement 
    let isFileUploaded = 0;

    $(document).ready(function() {
        document.getElementById('eligibility').style.display = "block";
        $("#eligibility.tabcontentCriteria").addClass(" active");
        
        //  Assign variable to store
        localStorage.setItem("doctoralFellowshipData", JSON.stringify({}));
        
        // get user application response
        if (userId && schemeStatus!='result') {
            callApi({
                method: 'GET',
                url: 'api/userApi.php?userId=' + userId + '&schemeBatchId='+schemeBatchId + '&type=DF',
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
            url: 'api/schemeDoctoralFellowshipApi.php',
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
            url: 'api/schemeDoctoralFellowshipApi.php?id=' + userId + '&schemeBatchId='+schemeBatchId + '&type=download-pdf',
            form_type: 'download-pdf',
        });
        // location.href ="api/schemeDoctoralFellowshipApi.php?id=" + userId + '&schemeBatchId='+schemeBatchId + "&type="+type;
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
            // console.log(res.data);
        }
    }
</script>
</body>
</html>