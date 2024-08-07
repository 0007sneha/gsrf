<?php 
require "layout/head.php"; 
if (!isset($_SESSION['userUID'])) {
    echo "<script>location.href = 'index.php';</script>";
}
$schemeUrl = "schemes-minor-grants.php";
?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/generalData.php";
$isSchemeAvailableFor = "MIN"; 
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
                                <li><a href="<?php echo $schemeUrl;?>">Minor Research Project</a></li>
                                <li>View application</li>
                            </ol>
                            <h2>
                                Application for Minor Research Project
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
                            <h3 class="mb-5">Principal Investigator Details</h3>
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
                                <label>Gender : </label>
                                <div id="gender"> </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label>Date of Birth : </label>
                                <div id="dob"> </div>
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
                                <label>Qualification (Highest) : </label>
                                <div id="qualification"> </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Official Address : </label>
                                <div id="official_address"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Specialisation(if any) : </label>
                                <div id="specialisation"> </div>
                            </div>
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
                            <div class="col-md-12">
                                <h3 class="mb-5">Institution Details</h3>
                                <label>Name and complete address of the Institution where the project will be carried out</label>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_institute_details">
                                    <thead class="table-light">
                                        <th>Name of the Institute</th>
                                        <th>Institute Address</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <br><br>
                            </div>
                                
                            <h3 class="mb-5">The amount proposed for the project</h3>
                            <div class="col-md-4 mb-4">
                                <label>Proposed Amount : </label>
                                <div id="proposed_amount"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <h3 class="mb-5">Basic details of the proposal</h3>
                            <div class="col-md-12 mb-4">
                                <label>Title of the proposal</label>
                                <div id="proposal_title"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Broad discipline</label>
                                <div id="broad_discipline"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Summary of the research proposal </label>
                                <div id="proposal_summary"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Objectives</label>
                                <div id="objectives"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Expected outcome</label>
                                <div id="expected_outcome"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <h3>Background Information</h3>
                                <label for="proposal_background" class="form-label star">Background and Rationale of the Proposal</label>
                                <p class="mb-4">Please elaborate on the background and rationale for proposing this work</p>
                                <div id="proposal_background"> </div>
                            </div>
                            <h3 class="mb-4">Review of literature in the proposed area</h3>
                            <div class="col-md-12 mb-4">
                                <label>International Status</label>
                                <p>The relevant literature, including the latest and their contributions to be highlighted</p>
                                <div id="international_status"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>National Status</label>
                                <p>The relevant literature from India and their contributions to be highlighted</p>
                                <div id="national_status"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Local status (if it is a locally relevant proposal)</label>
                                <p>The relevant literature and their contributions to be highlighted</p>
                                <div id="local_status"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Significance of the proposal</label>
                                <p>The gaps to be filled/ problem to be solved / or hypothesis proposed</p>
                                <div id="proposal_significance"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Objectives</label>
                                <p>To be given as bullet points/enumerated; objectives must be achievable in the given time frame</p>
                                <div id="proposal_objectives"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Is the project location specific?</label>
                                <p>If yes, please highlight the reasons for choosing the location/site</p>
                                <div id="project_location"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h3>Work Plan</h3>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Methodology in detail</label>
                                <p>It should explain the general methodology; for each objective, clearly define the methods, <br>
                                    if more than one method is available, give reasons for choosing a particular method. <br>
                                    If the work is focussing on a location, the locational details are also to be given <br>
                                </p>
                                <div id="methodology"> </div>
                            </div>
                            <div class="col-md-12 mb-4" id="file_methodology_field">
                                <label>If there is any additional methodology information involving images can be uploaded here as a single pdf file.</label>
                                <p>Attach a scanned PDF copy of max 700KB</p>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline d-none" id="view_file_methodology" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                            <div class="col-md-8 mb-4" id="file_time_schedule_field">
                                <label>Provide a Time Schedule of activities</label>
                                <p>Give a bar diagram or GANTT chart on Quarterly basis</p>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_time_schedule" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Plan of action for utilising research outcome</label>
                                <div id="action_plan"> </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label>Any other details</label>
                                <p>Such as specific permissions for carrying out the project/safety measures that will be taken / ethical guidelines that will be followed / prior informed consent that will be obtained, should be highlighted</p>
                                <div id="any_other_details"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="forms">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h3>Expertise</h3>
                            </div>
                            <div class="col-md-12 mb-5">
                                <label>Highlight the specific expertise available with the PI and Co-PIs for executing the project</label>
                                <p>This is an essential component; the expertise should match the proposal</p>
                                <div id="specific_expertise_of_pi"> </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label>Important publications by the Investigator(s) related to the theme of the proposal during the last 5 years</label>
                                <p>Give the list of relevant publications only </p>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_invest_publication">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Publications</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label>Bibliography</label>
                                <p>Please provide all the references cited in the proposal</p>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_bibliography">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Bibliography</th>
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
                                <h3>List of Projects submitted/implemented by the Investigators</h3>
                                <p class="mb-5">Note : Write NIL or NA in Title field if not applicable</p>
                                
                                <label class="">Details of Project proposals Submitted to various funding agencies</label>
                                <table class="table table-stripped table-bordered border-light edu_details mb-5 input_fields_wrap_projectDetailsSubmitted">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Title</th>
                                        <th>Cost in Lakhs</th>
                                        <th>Month of submission</th>
                                        <th>Role as PI/Co-PI</th>
                                        <th>Agency</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                
                                <label>Details of Ongoing Projects</label>
                                <table class="table table-stripped table-bordered border-light edu_details mb-5 input_fields_wrap_projectDetailsOngoing">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Title</th>
                                        <th>Cost in Lakhs</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Role as PI/Co-PI</th>
                                        <th>Agency</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                                <label>Completed Projects</label>
                                <p>Please provide full details of projects completed during the last 5 years</p>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_projectDetailsCompleted">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Title</th>
                                        <th>Cost in Lakhs</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Role as PI/Co-PI</th>
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
                            <div class="col-md-12 mb-4">
                                <h3 class="mb-4">Facilities extended by parent institution(s) for the project implementation</h3>
                                
                                <label>Infrastructural Facilities, including administrative help</label>
                                <table class="table table-stripped table-bordered border-light edu_details mb-5 input_fields_wrap_facilityDetailsInfra">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Facilities</th>
                                        <th>Yes/No</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                
                                <label>Equipment available with the Institute/ Group/ Department/Other Institutes for the project</label>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_facilityDetailsEquipment">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Equipment available with</th>
                                        <th>Generic name of Equipment </th>
                                        <th>Model, Make & year of purchase</th>
                                        <th>Remarks including accessories available and current usage of</th>
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
                                <h3 class="mb-5">List of Experts/Institutions </h3>
                                <h3>Name and address of Experts/Institutions interested in the subject/outcome of the project</h3>
                                <p>Provide names of at least five experts and/or institutions</p>

                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_expertOrInstitution">
                                    <thead class="table-light">
                                        <th>Sr. No.</th>
                                        <th>Name</th>
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
                            <h3 class="mb-5">Budget</h3>
                            <div class="col-md-12 mb-5">
                                <label>Consolidated (Grand Total): Rs</label>
                                <div id="budget_consolidated"> </div>
                            </div>

                            <table class="table table-stripped table-bordered border-light edu_details budget_table">
                                <thead class="table-light">
                                    <th>Sr. No.</th>
                                    <th>Item</th>
                                    <th class="year_field_1">Year 1 (Rs)</th>
                                    <th class="year_field_2">Year 2 (Rs)</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>I</td>
                                        <td>Non-Recurring</td>
                                        <td class="year_field_1 non_recuring"><div id="year_1_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_1_2"> </div></td>
                                        <td><div id="year_1_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td class="budget_row_count">1</td>
                                        <td>Equipment</td>
                                        <td class="year_field_1 non_recuring"><div id="year_2_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_2_2"> </div></td>
                                        <td><div id="year_2_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>(a) <span id="equipment_a"> </span></td>
                                        <td class="year_field_1 non_recuring"><div id="year_3_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_3_2"> </div></td>
                                        <td><div id="year_3_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>(b) <span id="equipment_b"> </span></td>
                                        <td class="year_field_1 non_recuring"><div id="year_4_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_4_2"> </div></td>
                                        <td><div id="year_4_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>(c) <span id="equipment_c"> </span></td>
                                        <td class="year_field_1 non_recuring"><div id="year_5_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_5_2"> </div></td>
                                        <td><div id="year_5_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>(d) <span id="equipment_d"> </span></td>
                                        <td class="year_field_1 non_recuring"><div id="year_6_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_6_2"> </div></td>
                                        <td><div id="year_6_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>(e) <span id="equipment_e"> </span></td>
                                        <td class="year_field_1 non_recuring"><div id="year_7_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_7_2"> </div></td>
                                        <td><div id="year_7_total"> </div></td>
                                    </tr>
                                    <tr class="books_journals_row">
                                        <td class="budget_row_count">2</td>
                                        <td>Books and Journals</td>
                                        <td class="year_field_1 non_recuring"><div id="year_8_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_8_2"> </div></td>
                                        <td><div id="year_8_total"> </div></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td>TOTAL</td>
                                        <td class="year_field_1 non_recuring"><div id="year_9_1"> </div></td>
                                        <td class="year_field_2 non_recuring"><div id="year_9_2"> </div></td>
                                        <td><div id="year_9_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td>II</td>
                                        <td>Recurring</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="budget_row_count">3</td>
                                        <td class="">Hiring services #</td>
                                        <td class="year_field_1"><div id="year_10_1"> </div></td>
                                        <td class="year_field_2"><div id="year_10_2"> </div></td>
                                        <td><div id="year_10_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td class="budget_row_count">4</td>
                                        <td>Contingency</td>
                                        <td class="year_field_1"><div id="year_11_1"> </div></td>
                                        <td class="year_field_2"><div id="year_11_2"> </div></td>
                                        <td><div id="year_11_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td class="budget_row_count">5</td>
                                        <td>Chemicals and consumables</td>
                                        <td class="year_field_1"><div id="year_12_1"> </div></td>
                                        <td class="year_field_2"><div id="year_12_2"> </div></td>
                                        <td><div id="year_12_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td class="budget_row_count">6</td>
                                        <td>Travel and/or Field Work</td>
                                        <td class="year_field_1"><div id="year_13_1"> </div></td>
                                        <td class="year_field_2"><div id="year_13_2"> </div></td>
                                        <td><div id="year_13_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td class="budget_row_count">7</td>
                                        <td>Special Needs (if any)</td>
                                        <td class="year_field_1"><div id="year_14_1"> </div></td>
                                        <td class="year_field_2"><div id="year_14_2"> </div></td>
                                        <td><div id="year_14_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Total</td>
                                        <td class="year_field_1"><div id="year_15_1"> </div></td>
                                        <td class="year_field_2"><div id="year_15_2"> </div></td>
                                        <td><div id="year_15_total"> </div></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Grand Total</td>
                                        <td class="year_field_1"><div id="year_16_1"> </div></td>
                                        <td class="year_field_2"><div id="year_16_2"> </div></td>
                                        <td><div id="year_16_total"> </div></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="">NOTE : Please consult the scheme for the details #</p>

                            <div class="col-md-12 mt-5" >
                                <h3>Budget Components Details</h3>
                                <label for="budget_components_details" class="form-label star">Please justify each of the budget components by specifying the serial number given in the table</label>
                                <p>Budget without proper justification may lead to rejection of the application</p>
                                <p class="d-none">If more than one institution is involved, please provide institution-wise budget details in addition to the above.</p>
                                <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_budget_components_details">
                                    <thead class="table-light">
                                        <th>Sr. No</th>
                                        <th>Item Name</th>
                                        <th>Justification</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <br><br>
                            </div>
                            
                            <div class="col-md-12 mb-5">
                                <label>If the project has social /local relevance, please highlight</label>
                                <div id="budget_project_relevance"> </div>
                            </div>
                        </div>
                    </div>


                    <div class="forms">
                        <h3 class="mb-5">Certificates</h3>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label>Do you (PI) belong to EWS/OBC/SC/ST category?</label>
                                <div id="is_pi_belong_to_category"> </div>
                            </div>
                            <div class="col-md-6" id="file_category_certificate_field">
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_category_certificate" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label>Are you (PI/Co-PI) Differently Abled?</label>
                                <div id="is_pi_differently_abled"> </div>
                            </div>
                            <div class="col-md-6" id="file_pi_diff_abled_certificate_field">
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_pi_diff_abled_certificate" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="d-block">Certification from PI</label>
                                <a href="#" class="btn btn-outline" id="view_file_pi_certification" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="d-block">Aadhar Card of the PI</label>
                                <a href="#" class="btn btn-outline" id="view_file_aadhar_card" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <label class="d-block">Endorsement from the Principal/Registrar/Head of the Institution</label>
                                <a href="#" class="btn btn-outline" id="view_file_principal_endorsement_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                            <!-- <div class="col-md-6">
                                <label class="d-block">Endorsement from the Registrar of the Institution </label>
                                <a href="#" class="btn btn-outline" id="view_file_registrar_endorsement_certificate" target="_blank">View File(<span></span>)</a>
                            </div> -->
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-8">
                                <label class="d-block">Endorsement from the Head of the Institution </label>
                                <a href="#" class="btn btn-outline" id="view_file_head_inst_endorsement_certificate" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div> -->
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label>Are you a non-Ph.D. but a registered PhD student? </label>
                                <div id="is_pi_non_phd"> </div>
                            </div>
                            <div class="col-md-6" id="file_pi_bona_fide_certificate_field">
                                <label>Bona fide certificate</label>
                                <div class="form-check p-0">
                                    <a href="#" class="btn btn-outline" id="view_file_pi_bona_fide_certificate" target="_blank">View File(<span></span>)</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="d-block">CV of the PI </label>
                                <a href="#" class="btn btn-outline" id="view_file_pi_cv" target="_blank">View File(<span></span>)</a>
                            </div>
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'layout/note-before-preview-form.php'; ?>

    <section class="inner-page readableContent normalFont text-center pt-0 pb-5">
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
    let schemeBatchId = "<?php echo $minorGrantsRequiredDocs["scheme_batch_id"] ?>";
    const rupeeSign = "₹ ";

    isUserApplicableForScheme(scheme_code);
    callApi({
        method: 'GET',
        url: 'api/schemeMinorResearchProjectApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
        form_type: 'preview-data',
    });

    $( document ).ready(function() {
    
        // $(".year_field_2").hide(); // updated on 08/06/2024
        $(".books_journals_row").hide();// updated on 08/06/2024
        let budget_row_count = 1; // initialize serial number
        let budget_rows = document.querySelectorAll('td.budget_row_count'); // get all cells with class xyz in the row
        if (budget_rows.length > 0) {
            budget_rows.forEach((cell) => {
                if (cell.parentNode.style.display!== 'none') {
                    cell.textContent = budget_row_count; // assign serial number to the cell
                    budget_row_count++; // increment serial number
                }
            });
        }
    });
    
    function downloadApplicationForm(type) 
    {
        AmagiLoader.show();
        callApi({
            method: 'GET',
            url: 'api/schemeMinorResearchProjectApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=download-pdf',
            form_type: 'download-pdf',
            is_loader: 'within_the_page',
        });
        // location.href ="api/schemeMinorResearchProjectApi.php?id="+userId+'&schemeBatchId='+schemeBatchId+"&type="+type;
    }

    function getApiResponse(res, type) 
    {
        if (res.flag && res.status=='200') {
            data = res.data;
            
            let triggerDownloadElement = document.createElement('a');
                triggerDownloadElement.target= '_blank';
            
            if (type=='download-pdf') {
                if (data['file_application_form']) {
                    triggerDownloadElement.href = data['file_application_form'];
                    triggerDownloadElement.click();
                    AmagiLoader.hide();
                } else {
                    popUpMsg("Please Wait!...Fetching Data.");
                    $(".apply_btn").attr('disabled', true); 
                    AmagiLoader.show();
                    callApi({
                        method: 'GET',
                        url: 'api/schemeMinorResearchProjectApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
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
                let max_fields_budgetComponentsDetails = 10,
                    max_fields_bibliography = 
                    max_fields_investPublication = 20,
                    max_fields_instituteDetails = 
                    max_fields_projectDetailsSubmitted = 
                    max_fields_projectDetailsOngoing = 
                    max_fields_projectDetailsCompleted = 
                    max_fields_facilityDetailsInfra = 
                    max_fields_facilityDetailsEquipment = 
                    max_fields_expertOrInstitution = 
                    20;
                let x_bibliography = 
                    x_budgetComponentsDetails = 
                    x_instituteDetails = 
                    x_investPublication = 
                    x_projectDetailsSubmitted = 
                    x_projectDetailsOngoing = 
                    x_projectDetailsCompleted = 
                    x_facilityDetailsInfra = 
                    x_facilityDetailsEquipment = 
                    x_expertOrInstitution = 
                    0;
                var wrapper_instituteDetails = $(".input_fields_wrap_institute_details > tbody");     // Fields wrapper
                var wrapper_investPublication = $(".input_fields_wrap_invest_publication > tbody");     // Fields wrapper
	            var wrapper_bibliography = $(".input_fields_wrap_bibliography > tbody");     // Fields wrapper
                var wrapper_projectDetailsSubmitted = $(".input_fields_wrap_projectDetailsSubmitted > tbody");     // Fields wrapper
                var wrapper_projectDetailsOngoing = $(".input_fields_wrap_projectDetailsOngoing > tbody");     // Fields wrapper
                var wrapper_projectDetailsCompleted = $(".input_fields_wrap_projectDetailsCompleted > tbody");     // Fields wrapper
                var wrapper_facilityDetailsInfra = $(".input_fields_wrap_facilityDetailsInfra > tbody");     // Fields wrapper
                var wrapper_facilityDetailsEquipment = $(".input_fields_wrap_facilityDetailsEquipment > tbody");     // Fields wrapper
                var wrapper_expertOrInstitution = $(".input_fields_wrap_expertOrInstitution > tbody");     // Fields wrapper
                var wrapper_budgetComponentsDetails = $(".input_fields_wrap_budget_components_details");     // Fields wrapper

                $("#application_no").text(data['application_no']);

                data['investigator_details'].forEach(element => {
                    let pre_id='';
                    switch (element.type) {
                        case "principal_investigator" : pre_id=''; break;
                        default: break;
                    }

                    $("#"+pre_id+"first_name").text(element['first_name']);
                    $("#"+pre_id+"middle_name").text(element['middle_name']);
                    $("#"+pre_id+"last_name").text(element['last_name']);
                    $("#"+pre_id+"gender").text(element['gender']);
                    $("#"+pre_id+"dob").text(getToday(element['dob'], 'dmy'));

                    countryCode_data = countryCode_json.find(o => o.id === parseInt(element['country_code']));
                    $("#"+pre_id+"country_code").text(countryCode_data.name);
                    $("#"+pre_id+"phone_no").text(element['phone_no']);
                    $("#"+pre_id+"email").text(element['email']);
                    $("#"+pre_id+"designation").text(element['designation']);
                    $("#"+pre_id+"qualification").text(element['qualification']);
                    $("#"+pre_id+"official_address").html(escapeHtml(element['official_address']));
                });
                $("#specialisation").html(escapeHtml(data["specialisation"]));
                if (data['file_profile_picture']) {
                    displayUploadedFile('img', 'file_profile_picture', data['file_profile_picture']);
                }
                $("#proposed_amount").text(rupeeSign+''+data["proposed_amount"]);
                
                if ( !data["institution_details"] || data["institution_details"] == "null" ) {} else {
                    data["institution_details"].forEach(institutionDetail => {
                        if(x_instituteDetails < max_fields_instituteDetails){ 					//max input box allowed
                            x_instituteDetails++; 								//text box increment
                            $(wrapper_instituteDetails).append(`
                                <tr>
                                    <td>${institutionDetail['name']}</td>
                                    <td>${institutionDetail['address']} </td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                $("#proposal_title").html(escapeHtml(data["proposal_title"]));
                $("#broad_discipline").html(escapeHtml(data["broad_discipline"]));
                $("#proposal_summary").html(escapeHtml(data["proposal_summary"]));
                $("#objectives").html(escapeHtml(data["objectives"]));
                $("#expected_outcome").html(escapeHtml(data["expected_outcome"]));
                
                $("#proposal_background").html(escapeHtml(data["proposal_background"]));
                $("#international_status").html(escapeHtml(data["international_status"]));
                $("#national_status").html(escapeHtml(data["national_status"]));
                $("#local_status").html(escapeHtml(data["local_status"]));
                $("#proposal_significance").html(escapeHtml(data["proposal_significance"]));
                $("#proposal_objectives").html(escapeHtml(data["proposal_objectives"]));
                $("#project_location").html(escapeHtml(data["project_location"]));

                $("#methodology").html(escapeHtml(data["methodology"]));
                if (data["file_methodology"]) {
                    displayUploadedFile('docs', 'file_methodology', data["file_methodology"]);
                }
                if (data["file_time_schedule"]) {
                    displayUploadedFile('docs', 'file_time_schedule', data["file_time_schedule"]);
                }
                $("#action_plan").html(escapeHtml(data["action_plan"]));
                $("#any_other_details").html(escapeHtml(data["any_other_details"]));

                $("#specific_expertise_of_pi").html(escapeHtml(data["specific_expertise_of_pi"]));
                
                if ( !data["investigator_publications_details"] || data["investigator_publications_details"] == "null" ) {} else {
                    data["investigator_publications_details"].forEach(investigatorPublicationsDetail => {
                        if(x_investPublication < max_fields_investPublication){ 					//max input box allowed
                            x_investPublication++; 								//text box increment
                            $(wrapper_investPublication).append(`
                                <tr>
                                    <td>`+x_investPublication+`</td>
                                    <td>${investigatorPublicationsDetail['name']}</td>
                            `); //add input box
                        }
                    });
                }
                if ( !data["bibliography_details"] || data["bibliography_details"] == "null" ) {} else {
                    data["bibliography_details"].forEach(bibliographyDetail => {
                        if(x_bibliography < max_fields_bibliography){ 					//max input box allowed
                            x_bibliography++; 								//text box increment
                            $(wrapper_bibliography).append(`
                                <tr>
                                    <td>`+x_bibliography+`</td>
                                    <td>${bibliographyDetail['name']}</td>
                            `); //add input box
                        }
                    });
                }

                if ( !data["scheme_submitted_project_details"] || data["scheme_submitted_project_details"] == "null" ) {} else {
                    data["scheme_submitted_project_details"].forEach(investigatorsSubmittedProject => {
                        if(x_projectDetailsSubmitted < max_fields_projectDetailsSubmitted){ 					//max input box allowed
                            x_projectDetailsSubmitted++; 								//text box increment
                            $(wrapper_projectDetailsSubmitted).append(`
                                <tr>
                                    <td>`+x_projectDetailsSubmitted+`</td>
                                    <td>${investigatorsSubmittedProject['title']}</td>
                                    <td>${rupeeSign} ${investigatorsSubmittedProject['cost_in_lakhs']}</td>
                                    <td>${investigatorsSubmittedProject['submission_month']}</td>
                                    <td>${investigatorsSubmittedProject['role']}</td>
                                    <td>${investigatorsSubmittedProject['agency']}</td>
                                    <td>${investigatorsSubmittedProject['status']}</td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                    
                if ( !data["scheme_ongoing_project_details"] || data["scheme_ongoing_project_details"] == "null" ) {} else {
                    data["scheme_ongoing_project_details"].forEach(investigatorsOngoingProject => {
                        if(x_projectDetailsOngoing < max_fields_projectDetailsOngoing){ 					//max input box allowed
                            x_projectDetailsOngoing++; 	
                            $(wrapper_projectDetailsOngoing).append(`
                                <tr>
                                    <td>`+x_projectDetailsOngoing+`</td>
                                    <td>${investigatorsOngoingProject['title']}</td>
                                    <td>${rupeeSign} ${investigatorsOngoingProject['cost_in_lakhs']}</td>
                                    <td>${investigatorsOngoingProject['start_date']}</td>
                                    <td>${investigatorsOngoingProject['end_date']}</td>
                                    <td>${investigatorsOngoingProject['role']}</td>
                                    <td>${investigatorsOngoingProject['agency']}</td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                if ( !data["scheme_completed_project_details"] || data["scheme_completed_project_details"] == "null" ) {} else {
                    data["scheme_completed_project_details"].forEach(investigatorsCompletedProject => {
                        if(x_projectDetailsCompleted < max_fields_projectDetailsCompleted){ 					//max input box allowed
                            x_projectDetailsCompleted++; 								//text box increment
                            $(wrapper_projectDetailsCompleted).append(`
                                <tr>
                                    <td>`+x_projectDetailsCompleted+`</td>
                                    <td>${investigatorsCompletedProject['title']}</td>
                                    <td>${rupeeSign} ${investigatorsCompletedProject['cost_in_lakhs']}</td>
                                    <td>${investigatorsCompletedProject['start_date']}</td>
                                    <td>${investigatorsCompletedProject['end_date']}</td>
                                    <td>${investigatorsCompletedProject['role']}</td>
                                    <td>${investigatorsCompletedProject['agency']}</td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                if ( !data["infrastructural_facility_details"] || data["infrastructural_facility_details"] == "null" ) {} else {
                    data["infrastructural_facility_details"].forEach(infrastructuralFacilityDetail => {
                        if(x_facilityDetailsInfra < max_fields_facilityDetailsInfra){ 					//max input box allowed
                            x_facilityDetailsInfra++; 								//text box increment
                            $(wrapper_facilityDetailsInfra).append(`
                                <tr>
                                    <td>`+x_facilityDetailsInfra+`</td>
                                    <td>${infrastructuralFacilityDetail['title']}</td>
                                    <td>${infrastructuralFacilityDetail['status']}</td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                if ( !data["equipment_details"] || data["equipment_details"] == "null" ) {} else {
                    data["equipment_details"].forEach(equipmentDetail => {
                        if(x_facilityDetailsEquipment < max_fields_facilityDetailsEquipment){ 					//max input box allowed
                            x_facilityDetailsEquipment++; 								//text box increment
                            $(wrapper_facilityDetailsEquipment).append(`
                                <tr>
                                    <td>`+x_facilityDetailsEquipment+`</td>
                                    <td>${equipmentDetail['available_with']}</td>
                                    <td>${equipmentDetail['generic_name']}</td>
                                    <td>${equipmentDetail['purchase_details']}</td>
                                    <td>${equipmentDetail['remarks_on_accessories']}</td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                if ( !data["outcome_interested_expert_details"] || data["outcome_interested_expert_details"] == "null" ) {} else {
                    data["outcome_interested_expert_details"].forEach(outcomeInterestedExpertDetail => {
                        if(x_expertOrInstitution < max_fields_expertOrInstitution){ 					//max input box allowed
                            x_expertOrInstitution++; 								//text box increment
                            $(wrapper_expertOrInstitution).append(`
                                <tr>
                                    <td>`+x_expertOrInstitution+`</td>
                                    <td>${outcomeInterestedExpertDetail['name']}</td>
                                    <td>${outcomeInterestedExpertDetail['address']}</td>
                                </tr>
                            `); //add input box
                        }
                    });
                }
                
                $("#budget_consolidated").text(rupeeSign+''+data["budget_consolidated"]);
                if ( !data["budget_components_details"] || data["budget_components_details"] == "null" ) {} else {
                    data["budget_components_details"].forEach(budgetComponentsDetail => {
                        if(x_budgetComponentsDetails < max_fields_budgetComponentsDetails){ 					//max input box allowed
                            x_budgetComponentsDetails++; 								//text box increment
                            $(wrapper_budgetComponentsDetails).append(`
                                <tr>
                                    <td>`+x_budgetComponentsDetails+`</td>
                                    <td>${budgetComponentsDetail['name']}</td>
                                    <td>${escapeHtml(budgetComponentsDetail['description'])} </td>
                                </tr>
                            `); //add input box
                        }
                    });
                }

                $("#budget_project_relevance").text(data["budget_project_relevance"]);
                $("#equipment_a").text(data["equipment_a"]);
                $("#equipment_b").text(data["equipment_b"]);
                $("#equipment_c").text(data["equipment_c"]);
                $("#equipment_d").text(data["equipment_d"]);
                $("#equipment_e").text(data["equipment_e"]);

                for (let index = 1; index <= 16; index++) {
                    let tempNo = index;
                    $("#year_"+tempNo+"_1").text(data["year_"+tempNo+"_1"]);
                    $("#year_"+tempNo+"_2").text(data["year_"+tempNo+"_2"]);
                    $("#year_"+tempNo+"_total").text(data["year_"+tempNo+"_total"]);
                }

                if (data['is_pi_belong_to_category']==1) {
                    is_pi_belong_to_category = 'Yes';
                } else {
                    is_pi_belong_to_category = 'No';
                }
                $("#is_pi_belong_to_category").text(is_pi_belong_to_category);
                showMoreOptions('category', data['is_pi_belong_to_category']);
                if (data['file_category_certificate']) {
                    displayUploadedFile('docs', 'file_category_certificate', data['file_category_certificate']);
                }
                
                if (data['is_pi_differently_abled']==1) {
                    is_pi_differently_abled = 'Yes';
                } else {
                    is_pi_differently_abled = 'No';
                }
                $("#is_pi_differently_abled").text(is_pi_differently_abled);
                showMoreOptions('pi_diff_abled', data['is_pi_differently_abled']);
                if (data['file_pi_diff_abled_certificate']) {
                    displayUploadedFile('docs', 'file_pi_diff_abled_certificate', data['file_pi_diff_abled_certificate']);
                }

                if (data["file_pi_certification"]) {
                    displayUploadedFile('docs', 'file_pi_certification', data["file_pi_certification"]);
                }
                if (data["file_aadhar_card"]) {
                    displayUploadedFile('docs', 'file_aadhar_card', data["file_aadhar_card"]);
                }
                if (data["file_principal_endorsement_certificate"]) {
                    displayUploadedFile('docs', 'file_principal_endorsement_certificate', data["file_principal_endorsement_certificate"]);
                }
                if (data["file_registrar_endorsement_certificate"]) {
                    displayUploadedFile('docs', 'file_registrar_endorsement_certificate', data["file_registrar_endorsement_certificate"]);
                }
                if (data["file_head_inst_endorsement_certificate"]) {
                    displayUploadedFile('docs', 'file_head_inst_endorsement_certificate', data["file_head_inst_endorsement_certificate"]);
                }
                if (data["file_pi_cv"]) {
                    displayUploadedFile('docs', 'file_pi_cv', data["file_pi_cv"]);
                }
                
                if (data['is_pi_non_phd']==1) {
                    is_pi_non_phd = 'Yes';
                } else {
                    is_pi_non_phd = 'No';
                }
                $("#is_pi_non_phd").text(is_pi_non_phd);
                showMoreOptions('non_phd', data['is_pi_non_phd']);
                if (data["file_pi_bona_fide_certificate"]) {
                    displayUploadedFile('docs', 'file_pi_bona_fide_certificate', data["file_pi_bona_fide_certificate"]);
                }
            }
        } else {
            popUpMsg(res.message);
        }
    }
</script>
</body>
</html>