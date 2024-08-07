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
                        GSRF Minor Research Grant Scheme
                    </h2>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_not_exist">
                    <?php 
                        echo $minorGrantsRequiredDocs["message"];

                        if ($minorGrantsRequiredDocs["status"]=="open") { 
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'MIN\',\''.$minorGrantsRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$minorGrantsRequiredDocs['btn_title'].'</a>'; 
                            echo $minorGrantsRequiredDocs["note"];
                        }
                        if ($minorGrantsRequiredDocs["status"]=="result") { 
                            echo '<a href="'.$minorGrantsRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                        }
                    ?>
                </div>
                <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_exist d-none">
                    <p class="scheme-status m-0"><?php echo $minorGrantsRequiredDocs["app_download_msg"] ?></p>
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
                        National Education Policy 2020 recognises the importance of Research and knowledge creation in sustaining a vibrant economy. It underlines the significant expansion of research capabilities and output across disciplines. However, to conduct their research, funding opportunities shall be provided to the faculty members at Higher Educational Institutes. 
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Hence, the “GSRF Minor Research Grant Scheme” has been designed to promote research in all areas by providing financial assistance to the faculty members of Goa University and its affiliated and autonomous colleges on a competitive basis to pursue research work along with their academic engagement.
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
                        This scheme aims to promote excellence in research and innovation in various disciplines at Higher Educational Institutes (HEIs). Research problems shall also consider local needs. Industries and Government Departments shall be partners, and the benefits shall ultimately reach society.
                    </p>
                    <p> The key objective of the scheme is: </p>
                    <ol type="i">
                        <li>To provide research support for the faculty members of HEIs in Goa and foster their research temper.</li>
                        <li>To cultivate the basic research capacity of faculty through the individual level of research support and motivate their original ideas and talent.</li>
                        <li>Provide grants to faculty in all disciplines and encourage interdisciplinary research work for the benefit of society.</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <p>
                        Research and Development activities are considered essential components of the higher education system because they create new knowledge and insights and impart excitement and dynamism to the educational process. The scope of the scheme includes creating and improving the general research capabilities of the faculty members of the various Higher Educational Institutes (Goa University and its affiliated and autonomous colleges).
                    </p>
                    <p>
                        The proposals submitted by the project investigators shall include a specific project theme with a clear statement of achievable objectives, methodology, details of equipment and other research facilities proposed to be acquired and the expected deliverables from the project.
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
                <h4 class="title">  PATTERN OF ASSISTANCE </h4>
            </div>
            <div class="row gx-5 multiContent">
                <div class="col-md-6">  
                    <p>
                        The <strong>quantum of assistance</strong> under this <strong>GSRF Minor Research Grant Scheme</strong> will be as follows:
                    </p>
                    <p>
                        The maximum permissible grant in the disciplines <strong>outside STEM</strong> areas will be Rs. 3.00 Lakhs (Non-recurring grant – Rs. 1.00 Lakh and Recurring grants – Rs. 2.00 Lakhs), and in <strong>STEM</strong> areas will be Rs. 4.00 Lakhs (Non-recurring grant – Rs. 1.50 Lakh and Recurring grants – Rs. 2.50 Lakhs). No project staff will be allowed under this scheme.
                    </p>
                    <p>
                        The following are the Heads under which the budget will be recognised:
                    </p>
                    <ol type="I">
                        <li>
                            <strong>Non-Recurring Grants</strong>
                            <ol type="a">
                                <li>Minor Equipment</li>
                                <!-- <li>Books and Journals</li> -->
                            <!-- </ol>
                            <ol type="i"> -->
                                <li>The equipment, 
                                    <!-- Books and Journals  -->
                                    grants may be utilised to procure the essential equipment 
                                    <!-- and books and journals  -->
                                    needed for the proposed research work.</li>
                                <li>The Equipment, 
                                    <!-- Books and Journals  -->
                                    acquired by the P.I. under this scheme must be deposited at College / Goa University, as the case may be, after the completion of the project. These items will be institutional property.</li>
                            </ol>
                        </li>
                        <li>
                            <strong>Recurring Grants</strong>
                            <ol type="1">
                                <li><strong>Hiring Services:</strong> This is meant for specialised technical services available on a payment basis, such as sample analysis, for which the University/ College/institution has no infrastructure.</li>
                                <li><strong>Contingency:</strong> The admissible contingency grant may be utilised on spares for apparatus, photostat copies and microfilms, typing, stationery, postage, telephone calls, internet, fax, computation, printing and other project-related items. Expenditure towards the audit fee may also be claimed under the contingency head.</li>
                            </ol>
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol start="2">
                        <li>
                            <ol start="3">
                                <li><strong>Chemicals and Consumables:</strong> To meet expenditure on chemicals, glassware and other consumable items.</li>
                                <li><strong>Travel and/or Field Work:</strong> The amount allocated under the head travel/field work will be utilised for data collection and other information, including documents and visits to libraries within the general scope and sphere of the ongoing project. This can also be used for attending conferences, seminars, workshops, training courses, etc. However, it should be directly related to the project work and, at the most, one event in a year.</li>
                                <li><strong>Specific Need:</strong> Assistance may be provided for any other specific requirement concerning the project which is not covered under any other ‘Head’ of assistance under the scheme.</li>
                                <li><strong>Overhead charges:</strong> Institutional overhead charges are NOT PERMITTED under this scheme.</li>
                            </ol>
                            <p>
                                Grants will be released to the principal of the college/Registrar of the Goa University/Head of the Institution.
                            </p>
                        </li>
                        <li>
                            <strong>Re-appropriation:</strong> 
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
                                    Financial assistance for GSRF Minor Research Grant Scheme - can be availed by the full-time regular faculty of  Goa University and its affiliated or autonomous institutions and Goa Government funded research Institutes:
                                </p>
                                <ol>
                                    <li>
                                        The Principal Investigator (P.I.) shall be a regular faculty member of Goa University or its affiliated or autonomous colleges or Goa Government-funded research Institutes. And in addition, shall fulfil anyone of the following conditions:
                                        <ol type="a">
                                            <li>Hold a PhD degree or M.D/M.S/M.D.S/M.V.Sc. in Medicine, Dental and Veterinary from a recognised institution.</li>
                                            <li>A registered PhD candidate at a recognised institution. </li>
                                            <li>Published at least one article in the UGC-CARE list of journals as the first author or corresponding author within the last three years.</li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                            <div class="col-md-6 pl70">
                                <ol start="2">
                                    <li>Individual faculty members can apply for a maximum of two projects at a time. However, if both projects are selected, the applicant can choose only one.</li>
                                    <li>A faculty member can avail of only one project under this or any other scheme of GSRF at any given time.</li>
                                    <li>The proposal submitted must be original in idea and content. Plagiarism in any form will lead to rejection of the proposal. </li>
                                    <li>The PI shall have a minimum 03 years of service remaining before superannuation.</li>
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
                                    The Applicants are required to apply online as per the format in response to the call by GSRF. Pre-registration of PI is a must for applying online.
                                </p>
                                <br><br>
                                
                                <h4>PROCEDURE FOR APPROVAL</h4>
                                <p>
                                    The applications received, complete in all aspects, will be peer-reviewed by the subject experts. Based on the review, recommendations will be made by the committee constituted for the purpose. The Governing Council of GSRF will take the final decision based on the recommendations made by the committee and the availability of funds under the scheme.
                                </p>
                                <br><br>
                                
                                <h4>PROCEDURE FOR RELEASE OF GRANTS</h4>
                                <p>
                                    The first installment of the grant shall comprise 100% of the non-Recurring grant and 50% of the Recurring grant approved by the GSRF for the project’s duration. The grant will be released to the Principal of the college/Registrar of the Goa University/Head of the Institution.
                                </p>
                                <p>
                                    On submission of the Annual Progress Report, statement of expenditure and utilization certificate of 1st installment of the grant, the remaining grant will be released as the second installment.
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
                                    <li>The unutilised grant, if any, may be refunded immediately through a demand draft in favour of GSRF.</li>
                                    <li>It is mandatory to post the Executive Summary of the report, Research documents, monograph, academic papers published (or its link in case of copyrighted material), etc., under the Project on the college's website and that of GSRF.</li>
                                    <li>Upon project completion, the PI/Institution is expected to settle the accounts immediately (within three months). If the remaining grant is not claimed within six months from the project’s completion date, the same will lapse, and no representation will be entertained on this behalf.</li>
                                    <li>The committee constituted for the purpose should review the completion report, and the closure letter shall be issued to the PI and the institution by the GSRF.</li>
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
                                <h4>GENERAL:</h4>
                                <ol type="1">
                                    <li>After selecting the proposals, the names of PIs will be intimated to the respective institutions and/or PI. The PIs should send their acceptance certificate duly forwarded by the principal of the college/Registrar of the Goa University/Head of the Institution within two weeks to the GSRF.</li>
                                    <li>The project is not transferable.</li>
                                    <li>In case the PI is transferred from his/her original place of work to another Institution within Goa, a No Objection Certificate should be furnished for the transfer of the project from both Institutions stating that necessary facilities will be provided by the Institution in which the awardee is transferred for the smooth functioning of the project. The instruments purchased under this scheme can be transferred to the new institution of PI if it is an ongoing project. </li>
                                    <li>GSRF encourages publishing the results with an acknowledgement of its support.</li>
                                    <li>Generally, no extension in tenure is permissible.</li>
                                    <li>Annual Report should be submitted at the end of the first year of the project.</li>
                                </ol>
                            </div>
                            <div class="col-md-6 pr70">
                                <!-- <ol start="7">
                                    <li>If found appropriate, instruments/infrastructure developed through this scheme can be moved to a centralised facility/institute during or on completion of the grant period, as decided by GSRF.</li>
                                </ol>
                                <br><br> -->

                                <h4>RELAXATION</h4>
                                <p>
                                    The GSRF is empowered to relax any or all clauses or conditions of the scheme in genuine cases.
                                </p>
                                <br><br>

                                <h4>REDRESSAL OF GRIEVANCES AND DISPUTES</h4>
                                <p>
                                    Grievances, if any, arising out of the implementation of this scheme will be heard and decided by the Chairperson (GSRF), and the decision in this regard shall be final and binding on all concerned.
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
                        The tenure of the GSRF Minor Research Grant project will be two years (2 years) from the date of sanctioning the project.
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
                                I have been working for the past more than five years on contract. Can I Apply?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    This scheme is for the faculty who are in regular positions. Hence, people on contract cannot apply.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">
                                I don’t have a PhD. Am I eligible?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    If you are having M.D/M.S/M.D.S/M.V.Sc. you are eligible even without a PhD.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">
                                I don’t have PhD, but I have registered for a PhD. Am I eligible?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes, as long as it is a recognised University and you are a regular faculty at Goa University or its affiliated or autonomous college.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">
                                If I have registered for PhD, can I submit the same work as the proposal?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes, you can. But, the funding is based on a peer review process and on a competitive basis.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">
                                I don’t have PhD and have not registered for it, but I have published a research paper. Am I eligible?
                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes! But publication should be in the UGC-CARE list of journals as the first author or corresponding author within the last three years.
                                </p>
                            </div>
                        </li>
                        <li>
                            <!-- <span>20 June 2023</span> -->
                            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">
                                Can I apply for this as well as GSRF Major Research Grants scheme?                                <i class="bi bi-plus icon-show"></i>
                                <i class="bi bi-dash icon-close"></i>
                            </div>
                            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Yes, you can! In case both are sanctioned, only one needs to be opted.
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
                        <li>If registered for PhD a bonafide certificate (in pdf format to upload)</li>
                        <li>Soft copy of the publication(s) if neither PhD nor registered (in pdf format to upload)</li>
                        <li>Curriculum Vitae (Biodata) (in pdf format to upload)</li>
                        <li>Aadhar Card of the PI (Self Attested)</li>
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
                                foreach ($minorGrantsRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>'.++$key.'</td>
                                        <td>'.$value['name'].'</td>
                                        <td><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download"></i> '.$value['fileName'].''.$minorGrantsRequiredDocs['file_format_1'].'</a></td>
                                        <td>';
                                        if ($value['url_type_2']) {
                                            echo '<a href="'.$value['url_type_2'].'" class="customLink"><i class="bi bi-download"></i> '.$value['fileName'].''.$minorGrantsRequiredDocs['file_format_2'].'</a></td>';
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
                    <?php if ($minorGrantsRequiredDocs["status"]=="open" && $minorGrantsRequiredDocs["app_type"]=="doc") { 
                            echo $minorGrantsRequiredDocs["message_bottom"];
                        } else if ($minorGrantsRequiredDocs["status"]=="close") { 
                            echo $minorGrantsRequiredDocs["message"];
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
                        if ($minorGrantsRequiredDocs["status"]=="open") {    
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'MIN\',\''.$minorGrantsRequiredDocs["app_type"].'\');" class="btn btn-primary apply_btn my-3 ">'.$minorGrantsRequiredDocs['btn_title'].'</a>
                                <p class="note">
                                    If you have gone through the details given above,
                                    <br> ';
                                    if ($minorGrantsRequiredDocs["app_type"]=="form") { 
                                        echo 'you can click here to APPLY';
                                    } else if ($minorGrantsRequiredDocs["app_type"]=="doc") { 
                                        echo 'you can click here to Submit Application Form';
                                    }
                            echo '</p>'; 
                        } else if ($minorGrantsRequiredDocs["status"]=="pending" || $minorGrantsRequiredDocs["status"]=="result") { 
                            echo $minorGrantsRequiredDocs["message"];
                            
                            if ($minorGrantsRequiredDocs["status"]=="result") { 
                                echo '<a href="'.$minorGrantsRequiredDocs["approved_app_url"].'" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                            } 
                        } 
                    ?>
                </div>
            </div>
            <div class="row gx-5 multiContent justify-content-md-center user_application_exist d-none">
                <div class="col-md-12">
                    <p class="scheme-status m-0"><?php echo $minorGrantsRequiredDocs["app_download_msg"] ?></p>
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
$localStorageKey = 'minorResearchProjectData';
require "layout/upload-application.php"; 
require "layout/footer.php"; 
?>

<script src="assets/js/custom-upload-file-application.js?<?php echo time() ?>"></script>
<script type="text/javascript">
    var saveData = {};
    let schemeBatchId = "<?php echo $minorGrantsRequiredDocs["scheme_batch_id"] ?>";
    let schemeStatus = "<?php echo $minorGrantsRequiredDocs["status"] ?>";
    let schemeAppType = "<?php echo $minorGrantsRequiredDocs["app_type"] ?>";
    // custom requirement 
    let isFileUploaded = 0;

    $(document).ready(function() {
        document.getElementById('eligibility').style.display = "block";
        $("#eligibility.tabcontentCriteria").addClass(" active");

        // Assign variable to store
        localStorage.setItem("minorResearchProjectData", JSON.stringify({}));

        // get user application response
        if (userId && schemeStatus!='result') {
            callApi({
                method: 'GET',
                url: 'api/userApi.php?userId=' + userId + '&schemeBatchId='+schemeBatchId+'&type=MIN',
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
            url: 'api/schemeMinorResearchProjectApi.php',
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
            url: 'api/schemeMinorResearchProjectApi.php?id=' + userId + '&schemeBatchId='+schemeBatchId + '&type=download-pdf',
            form_type: 'download-pdf',
        });
        // location.href ="api/schemeMinorResearchProjectApi.php?id=" + userId + '&schemeBatchId='+schemeBatchId + "&type="+type;
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