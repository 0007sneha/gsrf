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
                            GSRF IRIS Scheme
                        </h2>
                    </div>
                    <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_not_exist">
                        <?php
                        echo $irisSchemeRequiredDocs["message"];

                        if ($irisSchemeRequiredDocs["status"] == "open") {
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'IRIS\',\'' . $irisSchemeRequiredDocs["app_type"] . '\');" class="btn btn-primary apply_btn my-3 ">' . $irisSchemeRequiredDocs['btn_title'] . '</a>';
                            echo $irisSchemeRequiredDocs["note"];
                        }
                        if ($irisSchemeRequiredDocs["status"] == "result") {
                            echo '<a href="' . $irisSchemeRequiredDocs["approved_app_url"] . '" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                        }
                        ?>
                    </div>
                    <div class="col-md-12 col-lg-10 px-5 pt-3 user_application_exist d-none">
                        <p class="scheme-status m-0"><?php echo $irisSchemeRequiredDocs["app_download_msg"] ?>
                        </p>
                        <a href="#" onclick="downloadApplicationForm('download-pdf');"
                            class="btn btn-primary apply_btn my-3 "><i class="bi bi-download"></i> Download </a>
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
                            National Education Policy 2020 recognises the importance of Interdisciplinary /
                            Multidisciplinary Research Interventions in solving local problems and providing robust data
                            to formulate new policies for improving the lives of citizens and in guiding Government
                            policies in reaching the citizens. The significance of high-quality, interdisciplinary /
                            multidisciplinary research is the need, as problems are not restricted to any single
                            discipline.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            Hence, the “GSRF Interdisciplinary Research Interventions Scheme for Local Development
                            (IRIS-LD)” has been designed to provide financial assistance to a team of Researchers from
                            various Research and Educational institutions in Goa on a competitive basis to pursue
                            interdisciplinary research work as a team on a chosen problem and come out with practical
                            solutions and/or policy prescriptions.
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
                            This scheme aims to promote interdisciplinary/multidisciplinary teams of researchers,
                            including those from informal/unorganized sector with experience and innovative ideas, to
                            take up any local problems and provide practical solutions based on research interventions.
                            These solutions include scientific solutions that could be implemented/adopted directly on
                            the ground or inputs for policy interventions.
                        </p>


                    </div>
                    <div class="col-md-6">
                        <p>
                            Research that considers working with local bodies, industry and/or government departments,
                            keeping solutions as the output, will be considered. In addition to the above, GSRF would
                            also announce periodically under this scheme, as need arises, ‘thematic’ problems/concerns
                            needing solutions through research interventions. Under IRIS-LD scheme, therefore,
                            applicants would thus have the platform to provide solutions through research interventions
                            to thematic and non-thematic/open local level problems.

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
                    <h4 class="title"> PATTERN OF ASSISTANCE </h4>
                </div>
                <div class="row gx-5 multiContent">
                    <div class="col-md-6">
                        <ol>
                            <li>
                                <b>Assistance:</b> for a single project under this scheme shall not exceed Rs. 10.00
                                Lakhs. In a
                                financial year, the total quantum of assistance shall not exceed Rs. 100.00 Lakhs.
                            </li>
                            <li>
                                <p>
                                    <b>Stratification</b>
                                    The maximum amount payable for accepted proposals will be as follows:
                                </p>
                                <ul>
                                    i. Local / Village / Panchayat level issue: up to Rs. 3.00 lakhs
                                </ul>
                                <ul>
                                    ii. City / Municipality level issue: up to Rs. 4.00 lakhs
                                </ul>
                                <ul>
                                    iii. District level: up to Rs. 5.00 lakhs 
                                </ul>
                                <ul>
                                    iv. State-level / Technology-driven solutions: up to Rs. 10 lakhs
                                </ul>

                            </li>

                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol start="3">
                            <li>
                                <b>Heads of expense:</b>
                                <p>The PI shall specify Heads under which funding is required, with the purpose
                                    explained and quantum fully justified. Funds will be released as follows:
                                </p>
                                <ul>
                                    i. 50% of the sanctioned amount at the beginning of the project.
                                </ul>
                                <ul>
                                    ii. 25% after the half-projected timeline on submission of an Interim Report.
                                </ul>
                                <ul>
                                    iii. 25% after the submission of the Final Technical Report.
                                </ul>
                            </li>
                        </ol>
                        <p>Grants will be released to College Principal/Registrar (Goa University)/Head of Institution.
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
                            <button class="tablinks tablinksCriteria active"
                                onclick="openCriteria(event, 'eligibility')">ELIGIBILITY</button>
                            <button class="tablinks tablinksCriteria"
                                onclick="openCriteria(event, 'procedure')">PROCEDURES</button>
                            <button class="tablinks tablinksCriteria"
                                onclick="openCriteria(event, 'condition')">CONDITIONS</button>
                        </div>

                        <div id="eligibility" class="tabcontent tabcontentCriteria">
                            <div class="my-5">
                                <h2 class="title">ELIGIBILITY</h2>
                            </div>
                            <p>
                                The Principal Investigator (P.I.) who will be considered as the primary applicant, has
                                to have:
                            </p>
                            <div class="row">
                                <div class="col-md-6 pr70">
                                    <ol type="1">
                                        <li>a PhD degree or M.D./M.S./M.D.S./M.V.Sc. in Medicine, Dentistry or
                                            Veterinary Sciences; </li>
                                        <li>an interest in high-quality research; and </li>
                                        <li>has to be a regular faculty working in a recognised Higher Educational
                                            Institute in Goa, or Scientist of a Centrally funded Research Institute in
                                            Goa. </li>


                                    </ol>
                                </div>
                                <div class="col-md-6 pl70">
                                    <p>Co-investigators (Co-PIs) can be from the same or other institutes in Goa. The
                                        team should comprise specialists from different branches to complement the
                                        requirements for achieving the goals. To ensure that IRIS-LD spreads to the
                                        grass-roots, other members/Co-PIs in the team could include experts retired from
                                        formal service, members from NGOs, students with innovative ideas, and/or even
                                        those from the unorganised sector, including mechanics and agriculturists, who
                                        could share and contribute with their innovative insights, experiences and
                                        skills. </p>
                                </div>
                            </div>
                        </div>
                        <div id="procedure" class="tabcontent tabcontentCriteria">
                            <div class="my-5">
                                <h2 class="title">PROCEDURES</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr70">
                                    <p>
                                        On the Scheme being notified/opened for seeking proposals from interested
                                        applicants/PIs, unless notified on GSRF website for closure, it will be open
                                        indefinitely for submission of proposals. The applicants must send a concept
                                        note
                                        with the proposed budget online in response to the call by GSRF.
                                        Pre-registration of
                                        PI and Co-PIs is a must for applying online. The applicants shall present the
                                        proposal before the Committee constituted for the purpose. The PIs of accepted
                                        concepts (with suggestions to modify, if required) will be asked to submit the
                                        full
                                        proposals online. After online submission, a hard copy with original documents
                                        shall
                                        be submitted to GSRF Office within a week of the online application. Since the
                                        scheme will be kept open throughout the year (unless closure is announced),
                                        reviews
                                        of received proposals will be conducted periodically. 
                                    </p>
                                    <h4>PROCEDURE FOR APPROVAL</h4>
                                    <p>The applications received, complete in all aspects, will be peer-reviewed by the
                                        subject Experts Committee; PI’s may be asked to present the proposal, if needed.
                                        Based on the recommendations made by the Committee, the Governing Council of
                                        GSRF will take the final decision based on the availability of funds under the
                                        scheme.</p>
                                    <br><br>

                                    <h4>COMPLETION OF THE PROJECT</h4>
                                    <p>The following documents shall be submitted within three months from the end of
                                        the project:</p>
                                    <ol>
                                        <li>Copy of the project's final technical report containing solution/policy
                                            recommendations, etc., along with the soft copy.</li>
                                        <li>A consolidated item-wise detailed statement of expenditure incurred
                                            during
                                            the entire project period in the prescribed proforma duly signed and sealed
                                            by the PI and the Principal of the College/Registrar of the Goa
                                            University/Head of the Institution.
                                        </li>
                                        <li> A consolidated Audited Utilization Certificate for the amount utilised
                                            towards the project duly signed and sealed by the Chartered Accountant,
                                            Principal of the College/Registrar of the Goa University/Head of the
                                            Institution and the PI in the prescribed proforma.</li>
                                        <li>The unutilised grant, if any, shall be refunded immediately through demand
                                            draft / NEFT in favour of GSRF.</li>
                                        <li>
                                            The Committee constituted shall review the completion report; if
                                            required,
                                            the PI/team will be invited for the presentation and interaction.

                                        </li>
                                    </ol>
                                    <br><br>

                                </div>
                                <div class="col-md-6 pr70">
                                    <h4>GENERAL</h4>

                                    <ol>
                                        <li>The PIs and the Head of the Institution will be intimated about the
                                            selection. The PIs should immediately send their acceptance certificate duly
                                            forwarded by the Principal of the College/Registrar of the Goa
                                            University/Head of the Institution to the GSRF.</li>
                                        <li>The project is not transferable.</li>
                                        <li>If the PI is transferred from the original place of work to another
                                            institution within Goa, a no-objection certificate should be furnished for
                                            the project transfer from the host institution. The new host institution
                                            shall provide a certificate stating that the Institution will provide the
                                            necessary facilities to the awardee for the smooth functioning of the
                                            project. The assets acquired, if any, can be transferred to the new
                                            institution in case of ongoing projects.</li>
                                        <li>Assets, if any, purchased through GSRF assistance may be taken by GSRF on
                                            completion of the project. </li>
                                        <li>GSRF encourages publishing the results of the project supported by it. The
                                            investigator should acknowledge the support received from the GSRF in these
                                            publications.</li>
                                        <li>Generally, no extension in tenure is permissible (please also refer to item
                                            VII).</li>
                                        <li>The solution/policy recommendations should be clearly stated in the Final
                                            Technical Report as per the projections made in the proposal.</li>
                                        <li>If for whatever reason the PI and Co-PI (and team) do not complete or are
                                            unable to complete the project, the entire amount as received from GSRF,
                                            shall be transferred back to GSRF immediately through Demand Draft / NEFT.
                                            This will also apply in case of PIs who move outside the State of Goa during
                                            the tenure of the project, and are no longer associated with the institution
                                            through which the project was originally sanctioned.</li>
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
                                    <h4>RELAXATION OF CONDITIONS</h4>
                                    <p>The GSRF is empowered to relax any/all clauses or conditions of the scheme in
                                        genuine cases.</p>

                                </div>
                                <div class="col-md-6 pr70">
                                    <h4>INTERPRETATION</h4>
                                    <p>If any questions arise regarding the interpretation of any clause, word or
                                        expression of the scheme, the decision about the interpretation shall be with
                                        the GSRF, which shall be final and binding on all concerned.</p>

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
                                    I have 15 years of domicile, but I am pursuing my PhD at a University other than Goa
                                    University. Can I apply?
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
                                        Yes, but you should have published a research paper (as per the condition
                                        specified in the scheme).
                                    </p>
                                </div>
                            </li>
                            <li>
                                <!-- <span>20 June 2023</span> -->
                                <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">
                                    I am getting another fellowship, but I want to apply for this and leave that. Is it
                                    permitted?
                                    <i class="bi bi-plus icon-show"></i>
                                    <i class="bi bi-dash icon-close"></i>
                                </div>
                                <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        No. At the date of application, you should not be availing of any other
                                        fellowship.
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
                                foreach ($irisSchemeRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $irisSchemeRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $irisSchemeRequiredDocs['file_format_2'] . '</a></td>';
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
                        <?php if ($irisSchemeRequiredDocs["status"] == "open" && $irisSchemeRequiredDocs["app_type"] == "doc") {
                            echo $irisSchemeRequiredDocs["message_bottom"];
                        } else if ($irisSchemeRequiredDocs["status"] == "close") {
                            echo $irisSchemeRequiredDocs["message"];
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
                        if ($irisSchemeRequiredDocs["status"] == "open") {
                            echo '<a href="#" onclick="isUserApplicableForScheme(\'IRIS\',\'' . $irisSchemeRequiredDocs["app_type"] . '\');" class="btn btn-primary apply_btn my-3 ">' . $irisSchemeRequiredDocs['btn_title'] . '</a>
                                <p class="note">
                                    If you have gone through the details given above,
                                    <br> ';
                            if ($irisSchemeRequiredDocs["app_type"] == "form") {
                                echo 'you can click here to APPLY';
                            } else if ($irisSchemeRequiredDocs["app_type"] == "doc") {
                                echo 'you can click here to Submit Application Form';
                            }
                            echo '</p>';
                        } else if ($irisSchemeRequiredDocs["status"] == "pending" || $irisSchemeRequiredDocs["status"] == "result") {
                            echo $irisSchemeRequiredDocs["message"];

                            if ($irisSchemeRequiredDocs["status"] == "result") {
                                echo '<a href="' . $irisSchemeRequiredDocs["approved_app_url"] . '" class="btn btn-primary apply_btn my-3" target="_blank">View</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row gx-5 multiContent justify-content-md-center user_application_exist d-none">
                    <div class="col-md-12">
                        <p class="scheme-status m-0"><?php echo $irisSchemeRequiredDocs["app_download_msg"] ?>
                        </p>
                        <a href="#" onclick="downloadApplicationForm('download-pdf');"
                            class="btn btn-primary apply_btn my-3 "><i class="bi bi-download"></i> Download </a>
                    </div>
                </div>
                <img class="bgImg left" src="assets/img/bg/group6.png" alt="">
                <img class="bgImg right" src="assets/img/bg/group7.png" alt="">
            </div>
        </section>
    </main>
    <!-- End #main -->
    <?php
    $localStorageKey = 'SchemeIrisData';
    require "layout/upload-application.php";
    require "layout/footer.php";
    ?>

    <script src="assets/js/custom-upload-file-application.js?<?php echo time() ?>"></script>
    <script type="text/javascript">
        var saveData = {};
        let schemeBatchId = "<?php echo $irisSchemeRequiredDocs["scheme_batch_id"] ?>";
        let schemeStatus = "<?php echo $irisSchemeRequiredDocs["status"] ?>";
        let schemeAppType = "<?php echo $irisSchemeRequiredDocs["app_type"] ?>";
        // custom requirement 
        let isFileUploaded = 0;

        $(document).ready(function () {
            document.getElementById('eligibility').style.display = "block";
            $("#eligibility.tabcontentCriteria").addClass(" active");

            //  Assign variable to store
            localStorage.setItem("SchemeIrisData", JSON.stringify({}));

            // get user application response
            if (userId && schemeStatus != 'result') {
                callApi({
                    method: 'GET',
                    url: 'api/userApi.php?userId=' + userId + '&schemeBatchId=' + schemeBatchId + '&type=IRIS',
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
                url: 'api/schemeIrisApi.php',
                data: saveData,
                form_type: 'submit-Doc',
            });
            setTimeout(() => {
                $("#uploadFormApplicationModal .btn-close").click();
            }, 3000);
        }

        function downloadApplicationForm(type) {
            callApi({
                method: 'GET',
                url: 'api/schemeIrisApi.php?id=' + userId + '&schemeBatchId=' + schemeBatchId + '&type=download-pdf',
                form_type: 'download-pdf',
            });
            // location.href ="api/schemeDoctoralFellowshipApi.php?id=" + userId + '&schemeBatchId='+schemeBatchId + "&type="+type;
        }

        function getApiResponse(res, form_type) {
            if (res.flag && res.status == '200') {
                if (form_type == "user-scheme_status") {
                    if (res.data['file_application_form'] && schemeAppType == "form") {
                        var user_application_not_exist = document.getElementsByClassName("user_application_not_exist");
                        for (var i = 0; i < user_application_not_exist.length; i++) {
                            user_application_not_exist[i].classList.add("d-none");
                        }
                        var user_application_exist = document.getElementsByClassName("user_application_exist");
                        for (var i = 0; i < user_application_exist.length; i++) {
                            user_application_exist[i].classList.remove("d-none");
                        }
                    }
                } else if (form_type == "download-pdf") {
                    if (res.data['file_application_form']) {
                        let a = document.createElement('a');
                        a.target = '_blank';
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
                if (form_type == "submit-Doc") {
                    $('#submit_app_btn').prop('disabled', false);
                }
                // console.log(res.message);
                // console.log(res.data);
            }
        }
    </script>
</body>

</html>