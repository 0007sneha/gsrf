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
include "layout/form-tab-nav-buttons.php";
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
                                <li><a href="<?php echo $schemeUrl;?>">Summer School</a></li>
                                <li>Apply Here</li>
                            </ol>
                            <h2>
                                Application for Summer School
                                <br>
                                <p>
                                    Embark on an Extraordinary Research Voyage: Apply Now for the Summer School Scheme 
                                    <br>
                                    and open doors to unparalleled academic exploration and advancement.
                                </p>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10">
                    <div class="custom-horizontal-tabs">
                        <div class="tabs">
                            <div class="tab active" id="tab_0">
                                <div class="tab-number">1</div>
                                <div class="tab-text">Personal Information</div>
                            </div>
                            <div class="tab" id="tab_1">
                                <div class="tab-number">2</div>
                                <div class="tab-text">Event Details</div>
                            </div>
                            <div class="tab" id="tab_2">
                                <div class="tab-number">3</div>
                                <div class="tab-text">Resource Persons</div>
                            </div>
                            <div class="tab" id="tab_3">
                                <div class="tab-number">4</div>
                                <div class="tab-text">Event Topics</div>
                            </div>
                            <div class="tab" id="tab_4">
                                <div class="tab-number">5</div>
                                <div class="tab-text">Budget</div>
                            </div>
                            <div class="tab" id="tab_5">
                                <div class="tab-number">6</div>
                                <div class="tab-text">Outcome</div>
                            </div>
                            <div class="tab" id="tab_6">
                                <div class="tab-number">7</div>
                                <div class="tab-text">Other Details</div>
                            </div>
                        </div>
                
                        <form>
                            <input type="hidden" id="scheme_id" name="scheme_id" value="" readonly>
                            <!-- Step One -->
                            <div id="form_0" class="tabcontent">
                                <div class="forms mb-5">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Coordinator Information</h3>
                                        <div class="col-md-4 mb-4">
                                            <label for="first_name" class="form-label star">First Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="" oninput="validateInput(this)" placeholder="Enter first name" aria-describedby="first name" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_first_name" onClick="displayInputField('first_name')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="first_name_error_msg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="middle_name" class="form-label">Middle Name</label>
                                            <div class="input-group mb-3">        
                                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="" oninput="validateInput(this)" placeholder="Enter middle name" aria-describedby="middle name" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_middle_name" onClick="displayInputField('middle_name')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="middle_name_error_msg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="last_name" class="form-label star">Last Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="" oninput="validateInput(this)" placeholder="Enter last name" aria-describedby="last name" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_last_name" onClick="displayInputField('last_name')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="last_name_error_msg"></span>
                                            </div>
                                        </div>                 
                                        <div class="col-md-4 mb-4">
                                            <label for="email" class="form-label star">Email ID</label>
                                            <div class="input-group mb-3">
                                                <input type="email" class="form-control" id="email" name="email" value="" oninput="validateInput(this)" placeholder="Enter email id" aria-describedby="email" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_email" onClick="displayInputField('email')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="email_error_msg"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-4">
                                            <label for="phone_no" class="form-label star">Mobile No.</label>
                                            <div class="input-group mb-3 input_field_shadow">
                                                <select id="country_code" name="country_code" class="input-group-text merge_input_field">
                                                    <?php
                                                        foreach ($countryCodeArr as $key => $value) {
                                                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <input type="number" class="form-control" id="phone_no" value="" onchange="validateInput(this)"  aria-describedby="phone_no" readonly>
                                                <button class="btn btn-outline-secondary editable_input_field" type="button" id="edit_phone_no" onClick="displayInputField('phone_no')"><i class="bi bi-pencil-fill"></i></button>
                                                <span class="error-msg col-md-12" id="phone_no_error_msg"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-4">
                                            <label for="designation" class="form-label star">Designation</label>
                                            <input type="text" class="form-control" name="designation" id="designation" value="" oninput="validateInput(this)" placeholder="" aria-describedby="">
                                            <span class="error-msg col-md-12" id="designation_error_msg"></span>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <label for="official_address" class="form-label">Address</label>
                                            <textarea class="form-control" name="official_address" id="official_address" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                            <span class="error-msg col-md-12" id="official_address_error_msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="forms mb-5">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Deputy Coordinator Information</h3>
                                        <div class="col-md-4 mb-4">
                                            <label for="deputy_co_first_name" class="form-label star">First Name</label>
                                            <input type="text" class="form-control" id="deputy_co_first_name" name="deputy_co_first_name" value="" oninput="validateInput(this)" placeholder="Enter first name" aria-describedby="first name">
                                            <span class="error-msg col-md-12" id="deputy_co_first_name_error_msg"></span>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="deputy_co_middle_name" class="form-label">Middle Name</label>
                                            <div class="input-group mb-3">        
                                                <input type="text" class="form-control" id="deputy_co_middle_name" name="deputy_co_middle_name" value="" oninput="validateInput(this)" placeholder="Enter middle name" aria-describedby="middle name">
                                                <span class="error-msg col-md-12" id="deputy_co_middle_name_error_msg"></span>
                                            </div>                                    
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="lname" class="form-label star">Last Name</label>
                                            <input type="text" class="form-control" id="deputy_co_last_name" name="deputy_co_last_name" value="" oninput="validateInput(this)" placeholder="Enter last name" aria-describedby="last name">
                                            <span class="error-msg col-md-12" id="deputy_co_last_name_error_msg"></span>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="deputy_co_email" class="form-label star">Email ID</label>
                                            <input type="email" class="form-control" name="deputy_co_email" id="deputy_co_email" value="" oninput="validateInput(this)" placeholder="Enter email id" aria-describedby="email">
                                            <span class="error-msg col-md-12" id="deputy_co_email_error_msg"></span>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="deputy_co_phone_no" class="form-label star">Mobile No.</label>
                                            <div class="input-group mb-3 input_field_shadow">
                                                <select id="deputy_co_country_code" name="deputy_co_country_code" value="" oninput="validateInput(this)"  class="input-group-text merge_input_field">
                                                    <?php
                                                        foreach ($countryCodeArr as $key => $value) {
                                                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <input type="number" class="form-control" id="deputy_co_phone_no" value="" onchange="validateInput(this)" aria-describedby="deputy_co_phone_no">
                                                <span class="error-msg col-md-12" id="deputy_co_phone_no_error_msg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="deputy_co_designation" class="form-label star">Designation</label>
                                            <input type="text" class="form-control" name="deputy_co_designation" id="deputy_co_designation" value="" oninput="validateInput(this)" placeholder="" aria-describedby="">
                                            <span class="error-msg col-md-12" id="deputy_co_designation_error_msg"></span>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <label for="deputy_co_official_address" class="form-label">Address</label>
                                            <textarea class="form-control" name="deputy_co_official_address" id="deputy_co_official_address" oninput="validateInput(this)" cols="80" rows="2" placeholder=""></textarea>
                                            <span class="error-msg col-md-12" id="deputy_co_official_address_error_msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Name and complete address of the Institution</h3>

                                        <div class="input_fields_wrap_institute_details">
                                            <div class="row wrapper_row">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="form-group col-md-5 mb-4">
                                                            <label for="institute_name_1" class="form-label star fw6">Name of the Institute</label>
                                                            <input type="text" class="form-control" id="institute_name_1" name="institute_name[]" value="" oninput="validateInput(this)" placeholder="Enter the full name of the Institute" aria-describedby="name of the Institute">
                                                            <span class="error-msg col-md-12" id="institute_name_1_error_msg"></span>
                                                        </div>
                                                        <div class="form-group col-md-7 mb-4">
                                                            <label for="institute_address_1" class="form-label star fw6">Institute Address</label>
                                                            <textarea class="form-control" name="institute_address[]" id="institute_address_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Institute complete Address"></textarea>
                                                            <span class="error-msg col-md-12" id="institute_address_1_error_msg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                            </div>
                                        </div> <!-- Add more fields -->
                                        <button type="button" class="btn link_btn add_field_button_inst_add" style="text-align: inherit;">+ Add more institutions (if any)</button>

                                    </div>
                                </div>
                                <?php showNavigationButton(3,'',0,1,1); ?>  
                            </div>
                            <div id="form_1" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Event Details</h3>
                                        <div class="col-md-12 mb-4">
                                            <label for="broad_area_of_workshop" class="form-label star">A broad area of the workshop</label>
                                            <input type="text" class="form-control" name="broad_area_of_workshop" id="broad_area_of_workshop" value="" oninput="validateInput(this)" placeholder="eg. Science, Social Science, Economics, Zoology, multidisciplinary, interdisciplinary etc" aria-describedby="">
                                            <span class="error-msg col-md-12" id="broad_area_of_workshop_error_msg"></span>
                                        </div>
                                        <div class="col-md-8 col-lg-8 mb-4">
                                            <label for="scheme_title" class="form-label star">Title of the summer/winter school </label>
                                            <p>should be broad area</p>
                                            <input type="text" class="form-control" name="scheme_title" id="scheme_title" value="" oninput="validateInput(this)" placeholder="Scheme Title" aria-describedby="">
                                            <span class="error-msg col-md-12" id="scheme_title_error_msg"></span>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label for="target_audience" class="form-label star">Target audience</label>
                                            <div class="row">
                                                <?php
                                                    foreach ($targetAudienceArr as $key => $value) {
                                                        echo '
                                                            <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3"> 
                                                                <div class="form-check">
                                                                <label class="form-check-label" for="target_audience_'.$value["id"].'">
                                                                    <input class="form-check-input" type="checkbox" name="target_audience" id="target_audience_'.$value["id"].'" value="'.$value["name"].'" >
                                                                        '.$value["name"].'
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        ';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <p>Note : Proposed date, maximum 10 days and minimum 5 days workshop to be held</p>
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <label for="starting_date" class="form-label star">Proposed starting date</label>
                                            <input type="date" class="form-control" id="starting_date" onchange="validateDate(this,'start_end_date');" placeholder="DD/MM/YYYY" aria-describedby="starting_date">
                                            <span class="error-msg col-md-12" id="starting_date_error_msg"></span>
                                        </div>
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <label for="ending_date" class="form-label star">Proposed ending date</label>
                                            <input type="date" class="form-control" id="ending_date" onchange="validateDate(this,'start_end_date', '');" placeholder="DD/MM/YYYY" aria-describedby="ending_date">
                                            <span class="error-msg col-md-12" id="ending_date_error_msg"></span>
                                        </div>
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <label for="no_of_working_days" class="form-label star">Total number of working days</label>
                                            <input type="number" class="form-control" name="no_of_working_days" id="no_of_working_days" value="" oninput="validateInput(this)" min="5" placeholder="Enter no of Days" aria-describedby="no_of_working_days">
                                            <span class="error-msg col-md-12" id="no_of_working_days_error_msg"></span>
                                        </div>
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <label for="no_of_participants" class="form-label star">No. of participants</label>
                                            <input type="number" class="form-control" name="no_of_participants" id="no_of_participants" value="" oninput="validateInput(this)" min="1" placeholder="Enter count of Participants" aria-describedby="no_of_participants">
                                            <span class="error-msg col-md-12" id="no_of_participants_error_msg"></span>
                                        </div>

                                    </div>
                                </div>
                                <?php showNavigationButton(0,0,1,1,2); ?>
                            </div>
                            <div id="form_2" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5">Resource Persons Details</h3>
                                        
                                        <div class="input_fields_wrap">
                                            <div class="row wrapper_row">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-4">
                                                            <label class="form-label fw6 star" for="resource_person_name_1">Name</label>  
                                                            <input type="text" id="resource_person_name_1" name="resource_person_name[]" value="" oninput="validateInput(this)" placeholder="Enter full name" class="form-control">
                                                            <span class="error-msg col-md-12" id="resource_person_name_1_error_msg"></span>
                                                        </div>
                                                        <div class="form-group col-md-3 mb-4">
                                                            <label class="form-label fw6 star" for="resource_person_designation_1">Designation</label>  
                                                            <input type="text" id="resource_person_designation_1" name="resource_person_designation[]" value="" oninput="validateInput(this)" placeholder="Enter designation" class="form-control">
                                                            <span class="error-msg col-md-12" id="resource_person_designation_1_error_msg"></span>
                                                        </div>
                                                        <div class="form-group col-md-5 mb-4">
                                                            <label class="form-label fw6 star" for="resource_person_address_1">Address</label>  
                                                            <textarea class="form-control" name="resource_person_address[]" id="resource_person_address_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter address"></textarea>
                                                            <span class="error-msg col-md-12" id="resource_person_address_1_error_msg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                            </div>
                                        </div><!-- Show Added Days -->
                                        <button type="button" class="btn link_btn add_field_button" style="text-align: inherit;">+ Add More</button>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,1,2,1,3); ?>
                            </div>
                            <div id="form_3" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="mb-5 star">Topics (syllabus) to be covered</h3>
                                        <table class="table table-stripped table-bordered border-light edu_details input_fields_wrap_session_wise_topic">
                                            <thead class="table-light">
                                                <th>Sr. No.</th>
                                                <th>Days</th>
                                                <th>Session Wise Topics/Syllabus</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr class="wrapper_row">
                                                    <td class="serial-number text-center">1</td>
                                                    <td>
                                                        <input type="date" id="session_wise_topic_day_1" name="session_wise_topic_day[]" value="" oninput="validateInput(this)" onclick="setDateRangeForEvent(this)" placeholder="Enter day" class="form-control">
                                                        <span id="session_wise_topic_day_1_error_msg" class="error-msg col-md-12"></span>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="session_wise_topic[]" id="session_wise_topic_1" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter Session wise Topic and brief description "></textarea>
                                                        <span id="session_wise_topic_1_error_msg" class="error-msg col-md-12"></span>
                                                    </td>
                                                    <td width="62px">
                                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Add more fields -->
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn link_btn add_field_button_session_wise_topic" style="text-align: inherit;">+ Add More</button>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,2,3,1,4); ?>
                            </div>
                            <div id="form_4" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="star">Budget Details</h3>
                                        <p>Note: Please ensure to enter '0' in the budget amount field if any row for a school is not applicable. This helps accurately reflect the absence of budget for the specified school.</p>
                                        <div class="col-md-12 mt-5 mb-4">
                                            <table class="table table-stripped table-bordered work_details edu_details">
                                                <thead class="table-dark">
                                                    <th style="width: 10%;">S.No. </th>
                                                    <th style="width: 70%;">Item</th>
                                                    <th style="width: 20%;">Amount</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th class="text-center">1</th>
                                                        <th>Consumables
                                                            <p>Including chemicals, essential glassware, etc.</p>
                                                        </th>
                                                        <td>
                                                            <input type="number" id="item_cost_consumables" name="item_cost_consumables" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudget(this)" placeholder="₹ 0.00" class="form-control text-end">
                                                            <span id="item_cost_consumables_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">2</th>
                                                        <th>
                                                            Honorarium
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    A. Resource  Person (Lecture rate) 
                                                                    <p>(₹750 per 1 hour session)</p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="item_cost_honorarium_no_of_lecture_sessions"><p class="mb-0">No. of Sessions</p></label>
                                                                    <input type="number" class="form-control pInherit text-end" id="item_cost_honorarium_no_of_lecture_sessions" name="item_cost_honorarium_no_of_lecture_sessions" value="" min="0" oninput="validateInput(this)" onkeyup="calculateTotalBudget(this)" placeholder="">
                                                                    <span id="item_cost_honorarium_no_of_lecture_sessions_error_msg" class="error-msg col-md-12"></span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    B. Resource  Person (Practicals/Field rate)
                                                                    <p>(₹750 per 2 hour session)</p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="item_cost_honorarium_no_of_practical_sessions"><p class="mb-0">No. of Sessions</p></label>
                                                                    <input type="number" class="form-control pInherit text-end" id="item_cost_honorarium_no_of_practical_sessions" name="item_cost_honorarium_no_of_practical_sessions" value="" min="0" oninput="validateInput(this)" onkeyup="calculateTotalBudget(this)" placeholder="">
                                                                    <span id="item_cost_honorarium_no_of_practical_sessions_error_msg" class="error-msg col-md-12"></span>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    C. Assistant(s) for eg. in laboratory etc.
                                                                    <p>
                                                                        (₹500 per day per person)
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="item_cost_honorarium_no_of_assistants"><p class="mb-0">No. of People</p></label>
                                                                    <input type="number" class="form-control pInherit text-end" id="item_cost_honorarium_no_of_assistants" name="item_cost_honorarium_no_of_assistants" value="" min="0" oninput="validateInput(this)" onkeyup="calculateTotalBudget(this)" placeholder="">
                                                                    <span id="item_cost_honorarium_no_of_assistants_error_msg" class="error-msg col-md-12"></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="item_cost_honorarium_no_of_days"><p class="mb-0">No. of Days</p></label>
                                                                    <input type="number" class="form-control pInherit text-end" id="item_cost_honorarium_no_of_days" name="item_cost_honorarium_no_of_days" value="" min="0" oninput="validateInput(this)" onkeyup="calculateTotalBudget(this)" placeholder="">
                                                                    <span id="item_cost_honorarium_no_of_days_error_msg" class="error-msg col-md-12"></span>
                                                                </div>
                                                            </div>
                                                            <p>As  the resource  persons  are  expected  to  be  from  the same institute no Travel budget is allowed</p>
                                                        </th>
                                                        <td>
                                                            <input type="number" id="item_cost_honorarium" name="item_cost_honorarium" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudget(this)" placeholder="₹ 0.00" class="form-control text-end" readonly>
                                                            <span id="item_cost_item_cost_honorarium_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">3</th>
                                                        <th>
                                                            Working lunch, tea, snacks
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="input_field_label" for="item_cost_working_lunch_rate_per_day">At the rate of ₹__ per day </label>
                                                                    <input type="number" style="width: inherit;" class="form-control pInherit text-end" id="item_cost_working_lunch_rate_per_day" name="item_cost_working_lunch_rate_per_day" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudget(this)" placeholder="₹ 0.00">
                                                                    <span id="item_cost_working_lunch_rate_per_day_error_msg"></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="item_cost_working_lunch_no_of_assistants"><p class="mb-0">No. of People</p></label>
                                                                    <input type="number" class="form-control pInherit text-end" id="item_cost_working_lunch_no_of_assistants" name="item_cost_working_lunch_no_of_assistants" value="" min="0" oninput="validateInput(this)" onkeyup="calculateTotalBudget(this)" placeholder="">
                                                                    <span id="item_cost_working_lunch_no_of_assistants_error_msg" class="error-msg col-md-12"></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="item_cost_working_lunch_no_of_days"><p class="mb-0">No. of Days</p></label>
                                                                    <input type="number" class="form-control pInherit text-end" id="item_cost_working_lunch_no_of_days" name="item_cost_working_lunch_no_of_days" value="" min="0" oninput="validateInput(this)" onkeyup="calculateTotalBudget(this)" placeholder="">
                                                                    <span id="item_cost_working_lunch_no_of_days_error_msg" class="error-msg col-md-12"></span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <input type="number" id="item_cost_working" name="item_cost_working" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudget(this)" placeholder="₹ 0.00" class="form-control text-end" readonly>
                                                            <span id="item_cost_working_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">4</th>
                                                        <th>Contingency 
                                                            <p>For  stationery,  photocopying, certificate printing, etc.</p>
                                                        </th>
                                                        <td>
                                                            <input type="number" id="item_cost_contingency" name="item_cost_contingency" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudget(this)" placeholder="₹ 0.00" class="form-control text-end">
                                                            <span id="item_cost_contingency_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">5</th>
                                                        <th>Overhead (20% of the total (S.No. 1-4))</th>
                                                        <td>
                                                            <input type="number" id="item_cost_overhead" name="item_cost_overhead" value="" min="0" oninput="validateInput(this)" onblur="convertNumberToDecimal(this)" onkeyup="calculateTotalBudget(this)" placeholder="₹ 0.00" class="form-control text-end" readonly>
                                                            <span id="item_cost_overhead_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center"></th>
                                                        <th>
                                                            TOTAL
                                                            <p>
                                                                Important Notice: To ensure compliance with our financial policies, please note that the total amount should not exceed 2.5 Lakhs.
                                                                For lesser no. of days it shall be calculated proportionally.
                                                            </p>
                                                        </th>
                                                        <td>
                                                            <input type="number" id="item_cost_total" name="item_cost_total" value="" min="0" oninput="validateInput(this)" placeholder="₹ 0.00" class="form-control text-end" readonly>
                                                            <span id="item_cost_total_error_msg" class="error-msg col-md-12"></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,3,4,1,5); ?>
                            </div>
                            <div id="form_5" class="tabcontent">
                                <div class="forms">
                                    <div class="row mb-0">
                                        <h3 class="star">Expected outcome</h3>
                                        <p>Not more than 100 words</p>
                                        <div class="col-md-12 mb-4">
                                            <!-- <label for="expected_outcome" class="form-label star"></label> -->
                                            <textarea class="form-control" name="expected_outcome" id="expected_outcome" oninput="validateInput(this)" onkeyup="validateWordCount('expected_outcome','100')" cols="80" rows="4"></textarea>
                                            Total word Count : <span id="expected_outcome_display_count">0</span> / 100 words. <span id="expected_outcome_error_msg" class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php showNavigationButton(0,4,5,1,6); ?>
                            </div>
                            <div id="form_6" class="tabcontent">
                                <div class="forms">
                                    <div class="row">
                                        <h3 class="mb-5">Certificates</h3>

                                        <div class="col-md-7 mb-4">
                                            <label for="file_declaration_certificate" class="form-label star">Declaration by the coordinator</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check col-md-10" style="padding-left: 0;">
                                                <input type="file" id="file_declaration_certificate" name="file_declaration_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                            </div>
                                        </div>
                                        <div class="col-md-5" id="file_declaration_certificate_field">
                                            <?php showProgressBar('docs','file_declaration_certificate', 'mt30'); ?>
                                        </div>

                                        <div class="col-md-7 mb-4 d-none">
                                            <label for="file_aadhar_card" class="form-label star">Aadhar Card <span>(Self Attested)</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check col-md-10" style="padding-left: 0;">
                                                <input type="file" id="file_aadhar_card" name="file_aadhar_card" placeholder="" class="form-control input-md" accept="application/pdf">
                                            </div>
                                        </div>
                                        <div class="col-md-5 d-none" id="file_aadhar_card_field">
                                            <?php showProgressBar('docs','file_aadhar_card', 'mt30'); ?>
                                        </div>

                                        <div class="col-md-7 mb-4">
                                            <label for="file_principal_registrar_certificate" class="form-label star">Certificate (from Principal/Registrar) on official letterhead</label>
                                            <p>Attach a scanned PDF copy of max 700KB <?php include "layout/tooltip-i.php"; ?> </p>
                                            <div class="form-check col-md-10" style="padding-left: 0;">
                                                <input type="file" id="file_principal_registrar_certificate" name="file_principal_registrar_certificate" placeholder="" class="form-control input-md" accept="application/pdf">
                                            </div>
                                        </div>
                                        <div class="col-md-5" id="file_principal_registrar_certificate_field">
                                            <?php showProgressBar('docs','file_principal_registrar_certificate', 'mt30'); ?>
                                        </div>
                                    </div>

                                    <?php include 'layout/note-before-file-submission.php'; ?>
                                </div>
                                <?php showNavigationButton(0,5,6,'',''); ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
<?php 
require "layout/footer.php";  
?>
<script>
    var saveData = getSavedData = {};
    let schemeBatchId = "<?php echo $summerSchoolRequiredDocs["scheme_batch_id"] ?>";

    let first_name=middle_name=last_name=email=country_code=phone_no=
        designation=official_address=
        deputy_co_first_name=deputy_co_middle_name=deputy_co_last_name=deputy_co_email=
        deputy_co_country_code=deputy_co_phone_no=deputy_co_designation=deputy_co_official_address=
        "";
    let institute_names = document.getElementsByName("institute_name[]");
    let institute_address = document.getElementsByName("institute_address[]");

    let broad_area_of_workshop=scheme_title=target_audience=starting_date=ending_date=
        no_of_working_days=no_of_participants="";
        
    let resource_person_names = document.getElementsByName("resource_person_name[]");
    let resource_person_designations = document.getElementsByName("resource_person_designation[]");
    let resource_person_addresses = document.getElementsByName("resource_person_address[]");
    
    let session_wise_topic_days = document.getElementsByName("session_wise_topic_day[]");
    let session_wise_topics = document.getElementsByName("session_wise_topic[]");

    let item_cost_consumables=
        item_cost_honorarium=item_cost_honorarium_no_of_days=item_cost_honorarium_no_of_assistants=item_cost_honorarium_no_of_practical_sessions=item_cost_honorarium_no_of_lecture_sessions=
        item_cost_working=item_cost_working_lunch_no_of_days=item_cost_working_lunch_no_of_assistants=item_cost_working_lunch_rate_per_day=
        item_cost_contingency=item_cost_overhead=item_cost_total=0;
    
    let expected_outcome='';

    let file_declaration_certificate=file_aadhar_card=file_principal_registrar_certificate="";
    
    const fileInputDeclarationCertificate = document.getElementById('file_declaration_certificate');
    const fileInputPIAadharCard = document.getElementById('file_aadhar_card');
    const fileInputInstituteHeadCertificate = document.getElementById('file_principal_registrar_certificate');

    let isSavedForm_0 = isSavedForm_1 = isSavedForm_2 = isSavedForm_3 = isSavedForm_4 = isSavedForm_5 = isSavedForm_6 = true; 

    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="target_audience"]');
    let atLeastOneChecked = false;

    // custom requirement 
    let isFileUploaded = 0;

    isUserApplicableForScheme(scheme_code);

	// add more fields function
	let max_fields_instituteDetails =
        max_fields_sessionWiseTopicDetails = 
        max_fields_resource_person = 20;
    let x_instituteDetails =
        x_sessionWiseTopicDetails = 
        x_resource_person = 1;
	var wrapper_instituteDetails = $(".input_fields_wrap_institute_details");     // Fields wrapper
	let add_button_instituteDetails = $(".add_field_button_inst_add"); 	// Add button ID
	var wrapper_sessionWiseTopic = $(".input_fields_wrap_session_wise_topic > tbody");     // Fields wrapper
	let add_button_sessionWiseTopic = $(".add_field_button_session_wise_topic"); 	// Add button ID
	var wrapper_resourcePerson = $(".input_fields_wrap"); 		//Fields wrapper
	let add_button_resource_person = $(".add_field_button"); 	//Add button ID

    let coordinator_detail = deputy_coordinator_detail = '';
    $( document ).ready(function() {
        // display tab content
        $("#form_0").addClass('d-block');
        
        // set max date as Today 
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        // document.getElementById('starting_date').max = today;
        // document.getElementById('ending_date').max = today;

        // set saved data
        saveData = getSavedData = JSON.parse(localStorage.getItem("summerSchoolData"));
        if (getSavedData && getSavedData['id']) {
            $("#scheme_id").val(getSavedData['id']);
            
            if (getSavedData["coordinator_details"] && getSavedData["coordinator_details"][0]) {
                coordinator_detail = getSavedData["coordinator_details"][0];

                $("#first_name").val(coordinator_detail['first_name']);
                $("#middle_name").val(coordinator_detail['middle_name']);
                $("#last_name").val(coordinator_detail['last_name']);
                $("#email").val(coordinator_detail['email']);
                $("#country_code").val(coordinator_detail['country_code']);
                $("#phone_no").val(coordinator_detail['phone_no']);
                $("#designation").val(coordinator_detail['designation']);
                $("#official_address").val(coordinator_detail['official_address']);
            }

            if (getSavedData["coordinator_details"] && getSavedData["coordinator_details"][1]) {
                deputy_coordinator_detail = getSavedData["coordinator_details"][1];

                $("#deputy_co_first_name").val(deputy_coordinator_detail['first_name']);
                $("#deputy_co_middle_name").val(deputy_coordinator_detail['middle_name']);
                $("#deputy_co_last_name").val(deputy_coordinator_detail['last_name']);
                $("#deputy_co_email").val(deputy_coordinator_detail['email']);
                $("#deputy_co_country_code").val(deputy_coordinator_detail['country_code']);
                $("#deputy_co_phone_no").val(deputy_coordinator_detail['phone_no']);
                $("#deputy_co_designation").val(deputy_coordinator_detail['designation']);
                $("#deputy_co_official_address").val(deputy_coordinator_detail['official_address']);
            }
            
            if ( !getSavedData["institution_details"] || getSavedData["institution_details"] == "null" ) {} else {
                x_instituteDetails = 0;
                getSavedData["institution_details"].forEach(institutionDetail => {
                    if(x_instituteDetails < max_fields_instituteDetails){ 					//max input box allowed
                        x_instituteDetails++; 								//text box increment
                        if (x_instituteDetails==1) {
                            $("#institute_name_1").val(institutionDetail['name']);
                            $("#institute_address_1").val(institutionDetail['address']);
                        } else {
                            $(wrapper_instituteDetails).append(`
                                <div class="row wrapper_row">
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="form-group col-md-5 mb-4">
                                                <label class="form-label star fw6" for="institute_name_`+x_instituteDetails+`">Name of the Institute</label>  
                                                <input type="text" id="institute_name_`+x_instituteDetails+`" name="institute_name[]" value="${institutionDetail['name']}" oninput="validateInput(this)" placeholder="Enter the full name of the Institute" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="institute_name_`+x_instituteDetails+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-7 mb-4">
                                                <label class="form-label star fw6" for="institute_address_`+x_instituteDetails+`">Institute Address</label>  
                                                <textarea class="form-control" name="institute_address[]" id="institute_address_`+x_instituteDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Institute complete Address">${institutionDetail['address']}</textarea>
                                                <span class="error-msg col-md-12" id="institute_address_`+x_instituteDetails+`_error_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                </div>
                            `); //add input box
                            if (x_instituteDetails == max_fields_instituteDetails) {
                                $(".add_field_button_inst_add").attr("disabled", true);
                            }
                        }
                    }
                });
            }

            $("#broad_area_of_workshop").val(getSavedData["broad_area_of_workshop"]);
            $("#scheme_title").val(getSavedData["scheme_title"]);
            $("#starting_date").val(getSavedData["starting_date"]);
            $("#ending_date").val(getSavedData["ending_date"]);
            $("#no_of_working_days").val(getSavedData["no_of_working_days"]);
            $("#no_of_participants").val(getSavedData["no_of_participants"]);
            let countCheckedValue = 0;
            if (getSavedData["target_audience"]) {
                getSavedData["target_audience"].forEach(element => {
                    if (element.checked) {
                        checkboxes[countCheckedValue].checked = true;
                    }
                    countCheckedValue++;
                });
            }
            
            if ( !getSavedData["resource_person_details"] || getSavedData["resource_person_details"] == "null" ) {} else {
                let resource_personDetails = getSavedData["resource_person_details"];
                x_resource_person = 0;
                resource_personDetails.forEach(resource_personDetail => {
                    if(x_resource_person < max_fields_resource_person){ 					//max input box allowed
                        x_resource_person++; 								//text box increment
                        if (x_resource_person==1) {
                            $("#resource_person_name_1").val(resource_personDetail['name']);
                            $("#resource_person_designation_1").val(resource_personDetail['designation']);
                            $("#resource_person_address_1").val(resource_personDetail['official_address']);
                        } else {
                            $(wrapper_resourcePerson).append(`
                                <div class="row wrapper_row">
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="form-group col-md-4 mb-4">
                                                <label class="form-label fw6 star" for="resource_person_name_`+x_resource_person+`">Name</label>  
                                                <input type="text" id="resource_person_name_`+x_resource_person+`" name="resource_person_name[]" value="${resource_personDetail['name'] ?? ''}" oninput="validateInput(this)" placeholder="Enter name" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="resource_person_name_`+x_resource_person+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-3 mb-4">
                                                <label class="form-label fw6 star" for="resource_person_designation_`+x_resource_person+`">Designation</label>  
                                                <input type="text" id="resource_person_designation_`+x_resource_person+`" name="resource_person_designation[]" value="${resource_personDetail['designation'] ?? ''}" oninput="validateInput(this)" placeholder="Enter designation" class="form-control input-md">
                                                <span class="error-msg col-md-12" id="resource_person_designation_`+x_resource_person+`_error_msg"></span>
                                            </div>
                                            <div class="form-group col-md-5 mb-4">
                                                <label class="form-label fw6 star" for="resource_person_address_`+x_resource_person+`">Address</label>  
                                                <textarea class="form-control input-md" name="resource_person_address[]" id="resource_person_address_`+x_resource_person+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter address">${resource_personDetail['official_address'] ?? ''}</textarea>
                                                <span class="error-msg col-md-12" id="resource_person_address_`+x_resource_person+`_error_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                </div>
                            `); //add input box
                            if (x_resource_person == max_fields_resource_person) {
                                $(".add_field_button").attr("disabled", true);
                            }
                        }
                    }
                });
            }

            if ( !getSavedData["session_wise_topic_details"] || getSavedData["session_wise_topic_details"] == "null" ) {} else {
                let sessionWiseTopicDetailsArr = getSavedData["session_wise_topic_details"];
                x_sessionWiseTopicDetails = 0;
                max_fields_sessionWiseTopicDetails = getDayCountBasedOnEventDateSelection();

                sessionWiseTopicDetailsArr.forEach(sessionWiseTopicDetail => {
                    if(x_sessionWiseTopicDetails < max_fields_sessionWiseTopicDetails){ 					//max input box allowed
                        x_sessionWiseTopicDetails++; 								//text box increment
                        if (x_sessionWiseTopicDetails==1) {
                            $("#session_wise_topic_day_1").val(sessionWiseTopicDetail['day']);
                            $("#session_wise_topic_1").val(sessionWiseTopicDetail['topic']);
                        } else {
                            $(wrapper_sessionWiseTopic).append(`
                                <tr class="wrapper_row">
                                    <td class="serial-number text-center">`+x_sessionWiseTopicDetails+`</td>
                                    <td>
                                        <input type="date" id="session_wise_topic_day_`+x_sessionWiseTopicDetails+`" name="session_wise_topic_day[]" value="${sessionWiseTopicDetail['day']}" oninput="validateInput(this)" onclick="setDateRangeForEvent(this)" placeholder="Enter day" class="form-control">
                                        <span id="session_wise_topic_day_`+x_sessionWiseTopicDetails+`_error_msg" class="error-msg col-md-12"></span>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="session_wise_topic[]" id="session_wise_topic_`+x_sessionWiseTopicDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter publications">${sessionWiseTopicDetail['topic']}</textarea>
                                        <span id="session_wise_topic_`+x_sessionWiseTopicDetails+`_error_msg" class="error-msg col-md-12"></span>
                                    </td>
                                    <td width="62px">
                                        <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                                    </td>
                                </tr>
                            `); //add input box
                            if (x_sessionWiseTopicDetails == max_fields_sessionWiseTopicDetails) {
                                $(".add_field_button_session_wise_topic").attr("disabled", true);
                            }
                        }
                    } else {
                        popUpMsg("You've reached the maximum limit of " + max_fields_sessionWiseTopicDetails + " topics.");
                    }
                });
            }
            $("#item_cost_total").val(getSavedData["item_cost_total"]);
            $("#item_cost_overhead").val(getSavedData["item_cost_overhead"]);
            $("#item_cost_contingency").val(getSavedData["item_cost_contingency"]);
            $("#item_cost_working").val(getSavedData["item_cost_working"]);
            $("#item_cost_working_lunch_no_of_days").val(getSavedData["item_cost_working_lunch_no_of_days"]);
            $("#item_cost_working_lunch_no_of_assistants").val(getSavedData["item_cost_working_lunch_no_of_assistants"]);
            $("#item_cost_working_lunch_rate_per_day").val(getSavedData["item_cost_working_lunch_rate_per_day"]);
            $("#item_cost_honorarium").val(getSavedData["item_cost_honorarium"]);
            $("#item_cost_honorarium_no_of_days").val(getSavedData["item_cost_honorarium_no_of_days"]);
            $("#item_cost_honorarium_no_of_assistants").val(getSavedData["item_cost_honorarium_no_of_assistants"]);
            $("#item_cost_honorarium_no_of_practical_sessions").val(getSavedData["item_cost_honorarium_no_of_practical_sessions"]);
            $("#item_cost_honorarium_no_of_lecture_sessions").val(getSavedData["item_cost_honorarium_no_of_lecture_sessions"]);
            $("#item_cost_consumables").val(getSavedData["item_cost_consumables"]);

            $("#expected_outcome").val(getSavedData["expected_outcome"]);

            if (getSavedData["file_declaration_certificate"]) {
                file_declaration_certificate = getSavedData["file_declaration_certificate"];
                displayUploadedFile('docs', 'file_declaration_certificate', file_declaration_certificate);
            }
            if (getSavedData["file_aadhar_card"]) {
                file_aadhar_card = getSavedData["file_aadhar_card"];
                displayUploadedFile('docs', 'file_aadhar_card', file_aadhar_card);
            }
            if (getSavedData["file_principal_registrar_certificate"]) {
                file_principal_registrar_certificate = getSavedData["file_principal_registrar_certificate"];
                displayUploadedFile('docs', 'file_principal_registrar_certificate', file_principal_registrar_certificate);
            }
        } else {
            callApi({
                method: 'GET',
                url: 'api/schemeSummerSchoolApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=preview',
                form_type: 'preview-data',
                is_loader: 'within_the_page',
            });
            AmagiLoader.show();
        }
        // if no data saved 
        getPresetUserData();

        // Institution Details
        $(add_button_instituteDetails).click(function(e){ 			    //on add input button click
            e.preventDefault();
            x_instituteDetails = institute_names.length;
            if(x_instituteDetails < max_fields_instituteDetails){ 					//max input box allowed
                x_instituteDetails++;					                    //text box increment
                $(wrapper_instituteDetails).append(`
                    <div class="row wrapper_row">
                        <div class="col-md-11">
                            <div class="row">
                                <div class="form-group col-md-5 mb-4">
                                    <label class="form-label star fw6" for="institute_name_`+x_instituteDetails+`">Name of the Institute</label>  
                                    <input type="text" id="institute_name_`+x_instituteDetails+`" name="institute_name[]" value="" oninput="validateInput(this)" placeholder="Enter the full name of the Institute" class="form-control input-md">
                                    <span class="error-msg col-md-12" id="institute_name_`+x_instituteDetails+`_error_msg"></span>
                                </div>
                                <div class="form-group col-md-7 mb-4">
                                    <label class="form-label star fw6" for="institute_address_`+x_instituteDetails+`">Institute Address</label>  
                                    <textarea class="form-control" name="institute_address[]" id="institute_address_`+x_instituteDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Institute complete Address"></textarea>
                                    <span class="error-msg col-md-12" id="institute_address_`+x_instituteDetails+`_error_msg"></span>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                    </div>
                `); //add input box
                if (x_instituteDetails == max_fields_instituteDetails) {
                    $(".add_field_button_inst_add").attr("disabled", true);
                }
            }
        });
        $(wrapper_instituteDetails).on("click",".remove_field", function(e){
            e.preventDefault(); 
            $(this).parent('div').remove();
            x_instituteDetails--;
            if (x_instituteDetails < max_fields_instituteDetails) {
                $(".add_field_button_inst_add").attr("disabled", false);
            }
            updateSerialNumbers(wrapper_instituteDetails);
        }); // click on remove fields
        
        // Resource person
        $(add_button_resource_person).click(function(e){ 			//on add input button click
			e.preventDefault();
            x_resource_person = resource_person_names.length;
			if(x_resource_person < max_fields_resource_person){ 					//max input box allowed
				x_resource_person++; 								//text box increment
				$(wrapper_resourcePerson).append(`
					<div class="row wrapper_row">
						<div class="col-md-11">
							<div class="row">
                                <div class="form-group col-md-4 mb-4">
									<label class="form-label fw6 star" for="resource_person_name_`+x_resource_person+`">Name</label>  
									<input type="text" id="resource_person_name_`+x_resource_person+`" name="resource_person_name[]" value="" oninput="validateInput(this)" placeholder="Enter full name" class="form-control input-md">
                                    <span class="error-msg col-md-12" id="resource_person_name_`+x_resource_person+`_error_msg"></span>
								</div>
                                <div class="form-group col-md-3 mb-4">
									<label class="form-label fw6 star" for="resource_person_designation_`+x_resource_person+`">Designation</label>  
									<input type="text" id="resource_person_designation_`+x_resource_person+`" name="resource_person_designation[]" value="" oninput="validateInput(this)" placeholder="Enter designation" class="form-control input-md">
                                    <span class="error-msg col-md-12" id="resource_person_designation_`+x_resource_person+`_error_msg"></span>
								</div>
                                <div class="form-group col-md-5 mb-4">
									<label class="form-label fw6 star" for="resource_person_address_`+x_resource_person+`">Address</label>  
									<textarea class="form-control" name="resource_person_address[]" id="resource_person_address_`+x_resource_person+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter address"></textarea>
                                    <span class="error-msg col-md-12" id="resource_person_address_`+x_resource_person+`_error_msg"></span>
								</div>
							</div>
						</div>
						<a href="#" class="col-md-1 remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
					</div>
				`); //add input box
                if (x_resource_person == max_fields_resource_person) {
                    $(".add_field_button").attr("disabled", true);
                }
			}
		}); 
		// click on remove fields
		$(wrapper_resourcePerson).on("click",".remove_field", function(e){
			e.preventDefault(); 
			$(this).parent('div').remove();
			x_resource_person--;
            if (x_resource_person < max_fields_resource_person) {
                $(".add_field_button").attr("disabled", false);
            }
            updateSerialNumbers(wrapper_resourcePerson);
		});

        // Expertise Investor Publications
        $(add_button_sessionWiseTopic).click(function(e){ 			    //on add input button click
            e.preventDefault();
            x_sessionWiseTopicDetails = session_wise_topics.length;
            max_fields_sessionWiseTopicDetails = getDayCountBasedOnEventDateSelection();

            if(x_sessionWiseTopicDetails < max_fields_sessionWiseTopicDetails){ 					//max input box allowed
                x_sessionWiseTopicDetails++;					                    //text box increment
                $(wrapper_sessionWiseTopic).append(`
                    <tr class="wrapper_row">
                        <td class="serial-number text-center">`+x_sessionWiseTopicDetails+`</td>
                        <td>
                            <input type="date" id="session_wise_topic_day_`+x_sessionWiseTopicDetails+`" name="session_wise_topic_day[]" value="" oninput="validateInput(this)" onclick="setDateRangeForEvent(this)" placeholder="Enter day" class="form-control">
                            <span id="session_wise_topic_day_`+x_sessionWiseTopicDetails+`_error_msg" class="error-msg col-md-12"></span>
                        </td>
                        <td>
                            <textarea class="form-control" name="session_wise_topic[]" id="session_wise_topic_`+x_sessionWiseTopicDetails+`" oninput="validateInput(this)" cols="80" rows="1" placeholder="Enter session wise topic and brief description "></textarea>
                            <span id="session_wise_topic_`+x_sessionWiseTopicDetails+`_error_msg" class="error-msg col-md-12"></span>
                        </td>
                        <td width="62px">
                            <a href="#" class="remove_field text-center"><i class="bi bi-trash custom_btn btn2"></i></a>
                        </td>
                    </tr>
                `); //add input box
                if (x_sessionWiseTopicDetails == max_fields_sessionWiseTopicDetails) {
                    $(".add_field_button_session_wise_topic").attr("disabled", true);
                }
            } else {
                popUpMsg("You've reached the maximum limit of " + max_fields_sessionWiseTopicDetails + " topics.");
            }
        });
        $(wrapper_sessionWiseTopic).on("click",".remove_field", function(e){
            e.preventDefault(); 
            $(this).closest('tr').remove();
            x_sessionWiseTopicDetails--;
            if (x_sessionWiseTopicDetails < max_fields_sessionWiseTopicDetails) {
                $(".add_field_button_session_wise_topic").attr("disabled", false);
            }
            updateSerialNumbers(wrapper_sessionWiseTopic);
        }); // click on remove fields

        // add here ----------------------------------------------

    });
    
    // upload images --------------------------------
        fileInputDeclarationCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_declaration_certificate', 
                    'file_id' : fileInputDeclarationCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'summerSchoolData'
                });
                isSavedForm_6 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputPIAadharCard.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_aadhar_card', 
                    'file_id' : fileInputPIAadharCard, 
                    'file_data' : fileData, 
                    'storage_key' : 'summerSchoolData'
                });
                isSavedForm_6 = false;
            } else {
                popUpMsg('Please select a File!');
            }
        });
        fileInputInstituteHeadCertificate.addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                }
                uploadFile({
                    'file_type' : 'docs', 
                    'response_id' : 'file_principal_registrar_certificate', 
                    'file_id' : fileInputInstituteHeadCertificate, 
                    'file_data' : fileData, 
                    'storage_key' : 'summerSchoolData'
                });
                isSavedForm_6 = false;
            } else {
                if (savedData['file_principal_registrar_certificate']=='') {
                    popUpMsg('Please select a File!');
                }
            }
        });

    function saveForm(formNo) {
        if (formNo==0) {
            saveData["flag"] = true;
            saveData["user_id"] = userId;
            saveData["scheme_batch_id"] = schemeBatchId;
            
            saveData["coordinator_details"] = [];
            saveData["coordinator_details"].push({
                        'type' : 'coordinator',
                        'first_name': validateEmptyFields("first_name", ""),
                        'middle_name' : validateEmptyFields("middle_name", ""),
                        'last_name' : validateEmptyFields("last_name", ""),
                        'email' : validateEmptyFields("email", ""),
                        'country_code' : validateEmptyFields("country_code", ""),
                        'phone_no' : validateEmptyFields("phone_no", ""),
                        'designation' : validateEmptyFields("designation", ""),
                        'official_address' : validateEmptyFields("official_address", ""),
                    });
            saveData["coordinator_details"].push({
                        'type' : 'deputy_coordinator',
                        'first_name': validateEmptyFields("deputy_co_first_name", ""),
                        'middle_name' : validateEmptyFields("deputy_co_middle_name", ""),
                        'last_name' : validateEmptyFields("deputy_co_last_name", ""),
                        'email' : validateEmptyFields("deputy_co_email", ""),
                        'country_code' : validateEmptyFields("deputy_co_country_code", ""),
                        'phone_no' : validateEmptyFields("deputy_co_phone_no", ""),
                        'designation' : validateEmptyFields("deputy_co_designation", ""),
                        'official_address' : validateEmptyFields("deputy_co_official_address", ""),
                    });

            saveData["institution_details"] = [];
			if (institute_names.length>0) {
				for(let j=0;j<institute_names.length;j++)
				{
					if ( institute_names[j].value == "" && institute_address[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["institution_details"].push({
							'name': institute_names[j].value,
							'address': institute_address[j].value,
						});
					}
				}
			}
            isSavedForm_0 = true;
            
        } else if (formNo==1) {
            saveData["no_of_participants"] = validateEmptyFields("no_of_participants", "");
            saveData["no_of_working_days"] = validateEmptyFields("no_of_working_days", "");
            saveData["ending_date"] = validateEmptyFields("ending_date", "");
            saveData["starting_date"] = validateEmptyFields("starting_date", "");
            saveData["scheme_title"] = validateEmptyFields("scheme_title", "");
            saveData["broad_area_of_workshop"] = validateEmptyFields("broad_area_of_workshop", "");
            saveData["target_audience"] = [];
            checkboxes.forEach(checkbox => {
                saveData["target_audience"].push({
                            'id' : checkbox.id,
                            'value' : checkbox.value,
                            'checked' : checkbox.checked, 
                        });
            });
            isSavedForm_1 = true;
            
        } else if (formNo==2) {
            saveData["resource_person_details"] = [];
			if (resource_person_names.length>0) {
				for(let j=0;j<resource_person_names.length;j++)
				{
					if ( resource_person_names[j].value == "" && resource_person_designations[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["resource_person_details"].push({
                            'type' : 'resource_person',
							'name': resource_person_names[j].value,
							'designation': resource_person_designations[j].value,
							'official_address': resource_person_addresses[j].value ?? '',
						});
					}
				}
			}
            isSavedForm_2 = true;

        } else if (formNo==3) {
			saveData["session_wise_topic_details"] = [];
			if (session_wise_topics.length>0) {
				for(let j=0;j<session_wise_topics.length;j++)
				{
					if ( session_wise_topics[j].value == "" && session_wise_topic_days[j].value == "" ) {
						// do nothing all fields are empty
					} else {
						saveData["session_wise_topic_details"].push({
							'day': session_wise_topic_days[j].value,
							'topic': session_wise_topics[j].value,
						});
					}
				}
			}
            isSavedForm_3 = true;

        } else if (formNo==4) {
            saveData["item_cost_total"] = validateEmptyFields("item_cost_total", "");
            saveData["item_cost_overhead"] = validateEmptyFields("item_cost_overhead", "");
            saveData["item_cost_contingency"] = validateEmptyFields("item_cost_contingency", "");
            saveData["item_cost_working"] = validateEmptyFields("item_cost_working", "");
            saveData["item_cost_working_lunch_no_of_days"] = validateEmptyFields("item_cost_working_lunch_no_of_days", "");
            saveData["item_cost_working_lunch_no_of_assistants"] = validateEmptyFields("item_cost_working_lunch_no_of_assistants", "");
            saveData["item_cost_working_lunch_rate_per_day"] = validateEmptyFields("item_cost_working_lunch_rate_per_day", "");
            saveData["item_cost_honorarium"] = validateEmptyFields("item_cost_honorarium", "");
            saveData["item_cost_honorarium_no_of_days"] = validateEmptyFields("item_cost_honorarium_no_of_days", "");
            saveData["item_cost_honorarium_no_of_assistants"] = validateEmptyFields("item_cost_honorarium_no_of_assistants", "");
            saveData["item_cost_honorarium_no_of_practical_sessions"] = validateEmptyFields("item_cost_honorarium_no_of_practical_sessions", "");
            saveData["item_cost_honorarium_no_of_lecture_sessions"] = validateEmptyFields("item_cost_honorarium_no_of_lecture_sessions", "");
            saveData["item_cost_consumables"] = validateEmptyFields("item_cost_consumables", "");
            isSavedForm_4 = true;
            
        } else if (formNo==5) {
            saveData["expected_outcome"] = validateEmptyFields("expected_outcome", "");
            isSavedForm_5 = true;

        } else if (formNo==6) {
            file_declaration_certificate = saveData["file_declaration_certificate"];
            file_aadhar_card = saveData["file_aadhar_card"];
            file_principal_registrar_certificate = saveData["file_principal_registrar_certificate"];
            isSavedForm_6 = true;
        }
        saveData["form_type"] = 'save-form';
        saveData["form_no"] = formNo;
        saveData["scheme_id"] = $("#scheme_id").val();
        popUpMsg("Saving your data.","","success");
        localStorage.setItem("summerSchoolData", JSON.stringify(saveData));

        // save every response for saving user data
        callApi({
            method: 'POST',
            url: 'api/schemeSummerSchoolApi.php',
            data: saveData,
            form_type: 'save-form',
            is_loader: 'within_the_page',
        });
    }
    function validateFormData(formNo) {
        let minCharLength = 3;
        let msg = ' must be between  '+minCharLength+' and 100 characters';

        if (formNo==0) {
            deputy_co_official_address = validateEmptyFields("deputy_co_official_address", "");
            deputy_co_designation = validateEmptyFields("deputy_co_designation", "Please enter designation!");
            deputy_co_phone_no = validatePhoneNumber("deputy_co_phone_no", "Phone Number cannot be empty!");
            deputy_co_country_code = validateEmptyFields("deputy_co_country_code", "Country code cannot be empty!");
            deputy_co_email = validateEmailId("deputy_co_email", "Please enter your EMAIL ID!");
            deputy_co_last_name = validateEmptyFields("deputy_co_last_name", "Last name cannot be empty, Please enter Last name!");
            deputy_co_middle_name = validateEmptyFields("deputy_co_middle_name", "");
            deputy_co_first_name = validateEmptyFields("deputy_co_first_name", "First name cannot be empty, Please enter First name!");
            
            official_address = validateEmptyFields("official_address", "");
            designation = validateEmptyFields("designation", "Please enter designation!");
            phone_no = validatePhoneNumber("phone_no", "Phone Number cannot be empty!");
            country_code = validateEmptyFields("country_code", "Country code cannot be empty!");
            email = validateEmailId("email", "Please enter your EMAIL ID!");
            last_name = validateEmptyFields("last_name", "Last name cannot be empty, Please enter Last name!");
            middle_name = validateEmptyFields("middle_name", "");
            first_name = validateEmptyFields("first_name", "First name cannot be empty, Please enter First name!");

            if (first_name && last_name && country_code && phone_no && email && designation 
                && deputy_co_first_name && deputy_co_last_name && deputy_co_country_code && deputy_co_phone_no && deputy_co_email && deputy_co_designation 
            ) {
                if (institute_names.length>0) {
                    for(let j=0;j<institute_names.length;j++)
                    {
                        let tempIdKey = j+1;
                        if ( validateEmptyFields("institute_name_"+tempIdKey, "Please enter the name of institution!") ) { } else { return false; }
                        if ( validateEmptyFields("institute_address_"+tempIdKey, "Please enter the address of institution!") ) { } else { return false; }
                    }
                } else {
                    popUpMsg('Please add at least one Institution Detail, before moving to next form!'); return false;
                }
                if (middle_name) { middle_name = validateEmptyFields("middle_name", "Please enter proper name !"); if (!middle_name) { return false; } }
                if (deputy_co_middle_name) { deputy_co_middle_name = validateEmptyFields("deputy_co_middle_name", "Please enter proper name !"); if (!deputy_co_middle_name) { return false; } }
                if (official_address) { official_address = validateEmptyFields("official_address", "required"); if (!official_address) { return false; } }
                if (deputy_co_official_address) { deputy_co_official_address = validateEmptyFields("deputy_co_official_address", "required"); if (!deputy_co_official_address) { return false; } }
            } else { return false; }
            
        } else if (formNo==1) {
            no_of_participants = validateEmptyFields("no_of_participants", "Please enter the count of participants!!");
            no_of_working_days = validateEmptyFields("no_of_working_days", "Please enter no of working days!!");
            ending_date = validateEmptyFields("ending_date", "Ending date is required!!");
            starting_date = validateEmptyFields("starting_date", "Starting date is required!!");
            scheme_title = validateEmptyFields("scheme_title", "Please enter broad area of workshop!!");
            broad_area_of_workshop = validateEmptyFields("broad_area_of_workshop", "Please enter borad area of workshop!!");
            if (broad_area_of_workshop && scheme_title && starting_date && ending_date && no_of_working_days && no_of_participants ) {
                atLeastOneChecked = false;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        atLeastOneChecked = true;
                    }
                });
                if (!atLeastOneChecked) {
                    popUpMsg("Please select at least one Target audience."); 
                    return false;
                }
                if (starting_date == ending_date || starting_date > ending_date) {
                    if (starting_date == ending_date) {
                        popUpMsg("Start and End date cannot be same"); 
                    }
                    if (starting_date > ending_date) {
                        popUpMsg("Invalid ending date of the event cannot be earlier than the starting date. Please select a valid date range."); 
                    }
                    showErrorField("ending_date", "error message") 
                    return false;
                }
            } else { return false; }

        } else if (formNo==2) {
            if (resource_person_names.length>0) {
                for(let j=0;j<resource_person_names.length;j++)
                {
                    let tempIdKey = j+1;
                    if ( validateEmptyFields("resource_person_name_"+tempIdKey, "Please enter name!") ) { } else { return false; }
                    if ( validateEmptyFields("resource_person_designation_"+tempIdKey, "Please enter designation!") ) { } else { return false; }
                    if ( validateEmptyFields("resource_person_address_"+tempIdKey, "Please enter address!") ) { } else { return false; }
                }
            } else {
                popUpMsg('Please add at least one Resource Persons Details, before moving to next form!'); return false;
            }

        } else if (formNo==3) {
            if (session_wise_topics.length>0) {
                for(let j=0;j<session_wise_topics.length;j++)
                {
                    let tempIdKey = j+1;
                    if ( validateEmptyFields("session_wise_topic_day_"+tempIdKey, "Please select date!") ) { } else { return false; }
                    if ( validateEmptyFields("session_wise_topic_"+tempIdKey, "Please enter the session details!") ) { } else { return false; }
                }
            } else {
                popUpMsg('Please add Session Wise Topics/Syllabus, before moving to next form!'); return false;
            }

        } else if (formNo==4) {
            item_cost_total = validateEmptyFields("item_cost_total", "Total cannot be empty ! ");
            item_cost_overhead = validateEmptyFields("item_cost_overhead", "Please enter the item cost for overhead ! ");
            item_cost_contingency = validateEmptyFields("item_cost_contingency", "Please enter the item cost for contingency ! ");
            item_cost_working = validateEmptyFields("item_cost_working", "Please enter the item cost for working ! ");
            item_cost_working_lunch_no_of_days = validateEmptyFields("item_cost_working_lunch_no_of_days", "Please enter the no of days ! ");
            item_cost_working_lunch_no_of_assistants = validateEmptyFields("item_cost_working_lunch_no_of_assistants", "Please enter the no of people ! ");
            item_cost_working_lunch_rate_per_day = validateEmptyFields("item_cost_working_lunch_rate_per_day", "Please enter the per day cost for eatables ! ");
            item_cost_honorarium = validateEmptyFields("item_cost_honorarium", "Please enter the item cost for honorarium ! ");
            item_cost_honorarium_no_of_days = validateEmptyFields("item_cost_honorarium_no_of_days", "Please enter the item no of days ! ");
            item_cost_honorarium_no_of_assistants = validateEmptyFields("item_cost_honorarium_no_of_assistants", "Please enter the no of people ! ");
            item_cost_honorarium_no_of_practical_sessions = validateEmptyFields("item_cost_honorarium_no_of_practical_sessions", "Please enter the no of practical sessions ! ");
            item_cost_honorarium_no_of_lecture_sessions = validateEmptyFields("item_cost_honorarium_no_of_lecture_sessions", "Please enter the no of lecture sessions ! ");
            item_cost_consumables = validateEmptyFields("item_cost_consumables", "Please enter the item cost for consumables ! ");
            if (item_cost_consumables 
            && item_cost_honorarium && item_cost_honorarium_no_of_days && item_cost_honorarium_no_of_assistants && item_cost_honorarium_no_of_practical_sessions && item_cost_honorarium_no_of_lecture_sessions  
            && item_cost_working && item_cost_working_lunch_no_of_days && item_cost_working_lunch_no_of_assistants && item_cost_working_lunch_rate_per_day
            && item_cost_contingency && item_cost_overhead && item_cost_total ) {
                if (item_cost_working_lunch_rate_per_day>0) {
                    if (item_cost_working_lunch_no_of_assistants<=0 || item_cost_working_lunch_no_of_days<=0) { return false; } 
                }
                if (item_cost_working_lunch_no_of_assistants>0) {
                    if (item_cost_working_lunch_rate_per_day<=0 || item_cost_working_lunch_no_of_days<=0) { return false; } 
                }
                if (item_cost_working_lunch_no_of_days>0) {
                    if (item_cost_working_lunch_no_of_assistants<=0 || item_cost_working_lunch_rate_per_day<=0) { return false; } 
                }
            } else { return false; }

        } else if (formNo==5) {
            expected_outcome = validateEmptyFields("expected_outcome", "Please enter the required details! ");
            if ( expected_outcome ) {
            } else { return false; }

        } else if (formNo==6) {
            if (saveData['file_declaration_certificate']) {
                file_declaration_certificate = saveData["file_declaration_certificate"];
            }
            if (saveData['file_aadhar_card']) {
                file_aadhar_card = saveData["file_aadhar_card"];
            }
            if (saveData['file_principal_registrar_certificate']) {
                file_principal_registrar_certificate = saveData["file_principal_registrar_certificate"];
            }
            // && file_aadhar_card 
            if ( file_declaration_certificate && file_principal_registrar_certificate ) {
            } else {
                if (!file_principal_registrar_certificate || file_principal_registrar_certificate==""){ popUpMsg('Please upload the scanned copy of Certificate from Head of the Institute.'); }
                // if (!file_aadhar_card || file_aadhar_card==""){ popUpMsg('Please upload the scanned Aadhar Card copy.'); }
                if (!file_declaration_certificate || file_declaration_certificate==""){ popUpMsg('Please upload the scanned copy of Self Declaration.'); }
                return false;
            }
        }
        return true;
    }
    function validateSavedData(formNo) {
        if (formNo==0) {
            if ( 
                getSavedData['coordinator_details'] &&
                first_name==getSavedData['coordinator_details'][0]["first_name"] && 
                middle_name==getSavedData['coordinator_details'][0]["middle_name"] && 
                last_name==getSavedData['coordinator_details'][0]["last_name"] && 
                email==getSavedData['coordinator_details'][0]["email"] && 
                country_code==getSavedData['coordinator_details'][0]["country_code"] && 
                phone_no==getSavedData['coordinator_details'][0]["phone_no"] && 
                designation==getSavedData['coordinator_details'][0]["designation"] && 
                official_address==getSavedData['coordinator_details'][0]["official_address"] && 
                deputy_co_first_name==getSavedData['coordinator_details'][1]["first_name"] && 
                deputy_co_middle_name==getSavedData['coordinator_details'][1]["middle_name"] && 
                deputy_co_last_name==getSavedData['coordinator_details'][1]["last_name"] && 
                deputy_co_email==getSavedData['coordinator_details'][1]["email"] && 
                deputy_co_country_code==getSavedData['coordinator_details'][1]["country_code"] && 
                deputy_co_phone_no==getSavedData['coordinator_details'][1]["phone_no"] && 
                deputy_co_designation==getSavedData['coordinator_details'][1]["designation"] && 
                deputy_co_official_address==getSavedData['coordinator_details'][1]["official_address"] &&
                isSavedForm_0
            ) {
                if (getSavedData["institution_details"] && getSavedData["institution_details"].length>0) {
                    let institution_detailsArr = getSavedData["institution_details"];
                    if (institute_names.length == institution_detailsArr.length) {
                        if (institute_names.length>0) {
                            for(let j=0;j<institute_names.length;j++)
                            {
                                if (!institution_detailsArr[j]) { return false; }
                                if ( institute_names[j].value == institution_detailsArr[j].name ) {} else { return false; }
                                if ( institute_address[j].value == institution_detailsArr[j].address ) {} else  { return false; }
                            }
                        }
                    } else { return false; }
                } else { return false; }
            } else { return false; } 
        
        } else if (formNo==1) {
            if (no_of_participants==getSavedData["no_of_participants"] && 
                no_of_working_days==getSavedData["no_of_working_days"] && 
                ending_date==getSavedData["ending_date"] && 
                starting_date==getSavedData["starting_date"] &&
                scheme_title==getSavedData["scheme_title"] && 
                broad_area_of_workshop==getSavedData["broad_area_of_workshop"] &&
                isSavedForm_1
            ) {
                for (const checkbox of checkboxes) {
                    // Check if the checkbox value is present in the saved array
                    const checkboxValue = checkbox.value;
                    const isChecked = checkbox.checked;

                    // Find the corresponding item in the saved array
                    const savedItem = getSavedData["target_audience"].find(item => item.value === checkboxValue);
                    // If the checkbox value is present in the saved array and the checkbox is checked based on saved data
                    if (savedItem && savedItem.checked === isChecked) {
                        continue; // Continue checking other checkboxes
                    } else {
                        return false; // Return false1 if a mismatch is found
                    }
                }
                return true; // Return true if all checkboxes match the saved data
            } else { return false; }

        } else if (formNo==2) {
            if (getSavedData["resource_person_details"] && getSavedData["resource_person_details"].length>0 && isSavedForm_2 ) {
                let resourcePersonDetailsArr = getSavedData["resource_person_details"];
                if (resource_person_names.length == resourcePersonDetailsArr.length) {
                    if (resource_person_names.length>0) {
                        for(let j=0;j<resource_person_names.length;j++)
                        {
                            if (!resourcePersonDetailsArr[j]) { return false; }
                            if ( resource_person_names[j].value == resourcePersonDetailsArr[j].name ) {} else { return false; }
                            if ( resource_person_designations[j].value == resourcePersonDetailsArr[j].designation ) {} else  { return false; }
                            if ( resource_person_addresses[j].value == resourcePersonDetailsArr[j].official_address ) {} else  { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

        } else if (formNo==3) {
            if (getSavedData["session_wise_topic_details"] && getSavedData["session_wise_topic_details"].length>0 && isSavedForm_3 ) {
                let sessionWiseTopicDetailsArr = getSavedData["session_wise_topic_details"];
                if (session_wise_topics.length == sessionWiseTopicDetailsArr.length) {
                    if (session_wise_topics.length>0) {
                        for(let j=0;j<session_wise_topics.length;j++)
                        {
                            if (!sessionWiseTopicDetailsArr[j]) { return false; }
                            if ( session_wise_topic_days[j].value == sessionWiseTopicDetailsArr[j].day ) {} else { return false; }
                            if ( session_wise_topics[j].value == sessionWiseTopicDetailsArr[j].topic ) {} else  { return false; }
                        }
                    }
                } else { return false; }
            } else { return false; }

        } else if (formNo==4) {
            if (item_cost_total==getSavedData["item_cost_total"] &&
                item_cost_overhead==getSavedData["item_cost_overhead"] &&
                item_cost_contingency==getSavedData["item_cost_contingency"] &&
                item_cost_working==getSavedData["item_cost_working"] &&
                item_cost_working_lunch_rate_per_day==getSavedData["item_cost_working_lunch_rate_per_day"] &&
                item_cost_working_lunch_no_of_assistants==getSavedData["item_cost_working_lunch_no_of_assistants"] &&
                item_cost_working_lunch_no_of_days==getSavedData["item_cost_working_lunch_no_of_days"] &&
                item_cost_honorarium==getSavedData["item_cost_honorarium"] &&
                item_cost_honorarium_no_of_lecture_sessions==getSavedData["item_cost_honorarium_no_of_lecture_sessions"] &&
                item_cost_honorarium_no_of_practical_sessions==getSavedData["item_cost_honorarium_no_of_practical_sessions"] &&
                item_cost_honorarium_no_of_assistants==getSavedData["item_cost_honorarium_no_of_assistants"] &&
                item_cost_honorarium_no_of_days==getSavedData["item_cost_honorarium_no_of_days"] &&
                item_cost_consumables==getSavedData["item_cost_consumables"] &&
                isSavedForm_4
            ) { } else { return false; }

        } else if (formNo==5) {
            if ( expected_outcome==getSavedData["expected_outcome"] && isSavedForm_5 ) {
            } else { return false; }

        } else if (formNo==6) {
            if ( file_declaration_certificate==getSavedData["file_declaration_certificate"] && file_aadhar_card == getSavedData["file_aadhar_card"] && file_principal_registrar_certificate==getSavedData["file_principal_registrar_certificate"] && 
                isSavedForm_6 ) {
            } else { return false; }
        }
        return true;
    }
    function validateInputType(type, inputFieldId, inputFieldValue) {
         // return error message
        let trimInputFieldId = inputFieldId.slice(0, -2);
        let checkTextLength=checkTextValidate = checkText = checkTextArea = true;
        let msg = '';
        let minCharLength = 2;
        let maxCharLength = 250;
        let optionalFieldIDArr = ['official_address', 'deputy_co_official_address'];

        if (inputFieldId=="broad_area_of_workshop" || inputFieldId=="scheme_title" ) {
            maxCharLength = 100;
        }
        
        if (type=='text') {
            minCharLength = 3;
            if (inputFieldId=="designation" || inputFieldId=="deputy_co_designation"
                || inputFieldId=="resource_person_designation"
            ) {
                minCharLength = 2;
            } else  if ( inputFieldId=="middle_name" || inputFieldId=="deputy_co_middle_name" ) {
                minCharLength = 1;
            }
            
            if (trimInputFieldId=="resource_person_name" || trimInputFieldId=="resource_person_designation" || trimInputFieldId=="resource_person_address"  
                || trimInputFieldId=="institute_name" || trimInputFieldId=="institute_address" 
                ) {
                if (checkTextValidate && inputFieldValue === '') {
                    switch (trimInputFieldId) {
                        case 'institute_name': msg = 'Institute name is required'; break;
                        case 'institute_address': msg = 'Institute address is required'; break;
                        case 'resource_person_name': msg = 'Resource person name is required'; break;
                        case 'resource_person_designation': msg = 'Designation is required'; break;
                        default: msg = ''; break;
                    }
                } else if (checkTextLength && inputFieldValue.length < minCharLength) {
                    msg = ' must be between '+minCharLength+' and '+maxCharLength+' characters';
                    switch (trimInputFieldId) {
                        case 'institute_name': msg = 'Institute name '+msg; break;
                        case 'institute_address': msg = 'Institute address '+msg; break;
                        case 'resource_person_name': msg = 'Name '+msg; break;
                        case 'resource_person_designation': msg = 'Designation '+msg; break;
                        case 'resource_person_address': msg = 'Address '+msg;; break;
                    }
                } else if (inputFieldValue.length > maxCharLength) {
                    msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
                } else if (/[<>]/.test(inputFieldValue)) {
                    msg = 'Invalid characters or content detected, not allowed <,>';
                } else if (!isValidEducationName(inputFieldValue)) {
                    msg = 'Invalid Input !'; 
                } else {
                    msg = '';
                }
            } else {
                if (inputFieldValue === '') {   
                    switch (inputFieldId) {
                        case 'first_name': msg = 'First name is required'; break;
                        case 'last_name': msg = 'Last name is required'; break;
                        case 'designation': msg = 'Designation is required'; break;
                        case 'deputy_co_first_name': msg = 'First name is required'; break;
                        case 'deputy_co_last_name': msg = 'Last name is required'; break;
                        case 'deputy_co_designation': msg = 'Designation is required'; break;
                        case 'scheme_title': msg = 'Title of the scheme is required'; break;
                        case 'broad_area_of_workshop': msg = 'Workshop detail is required'; break;
                        default: msg = ''; break;
                    }
                } else if (!regexOnlyTextSupportChars.test(inputFieldValue)) {
                    msg = 'Invalid input, Numbers and Special characters are not allowed!'; 

                } else if (inputFieldValue.length < minCharLength) {
                    msg = ' must be between '+minCharLength+' and '+maxCharLength+' characters';
                    switch (inputFieldId) {
                        case 'first_name': msg = 'First name '+msg; break;
                        case 'middle_name': msg = 'Middle name '+msg; break;
                        case 'last_name': msg = 'Last name '+msg; break;
                        case 'designation': msg = 'Designation '+msg; break;
                        case 'deputy_co_first_name': msg = 'First name '+msg; break;
                        case 'deputy_co_middle_name': msg = 'Middle name '+msg; break;
                        case 'deputy_co_last_name': msg = 'Last name '+msg; break;
                        case 'deputy_co_designation': msg = 'Designation '+msg; break;
                        case 'scheme_title': msg = 'Title of the scheme '+msg; break;
                        case 'broad_area_of_workshop': msg = 'Workshop detail '+msg; break;
                        default: msg = ''; break;
                    }
                } else if (inputFieldValue.length > maxCharLength) {
                    msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
                } else if (/[<>]/.test(inputFieldValue)) {
                    msg = 'Invalid characters or content detected, not allowed <,>';
                } else {
                    msg = '';
                }
            }

        } else if (type=='textarea') {
            maxCharLength = 4000;
            minCharLength = 10;
            if (inputFieldValue === '' || trimInputFieldId === '') {
                switch (inputFieldId) {
                    case 'expected_outcome': msg = 'Please provide expected outcome'; break;
                    default : msg = 'This field is required!'; break;
                }
                if (optionalFieldIDArr.includes(inputFieldId)) {
                    msg = '';
                }
            } else if ( /[<>]/.test(inputFieldValue) ) {
                msg = 'Invalid characters or content detected, not allowed <,>';
            } else if (inputFieldValue.length < minCharLength) {
                msg = 'Please enter relevant information, min '+minCharLength+' characters';
            } else if (inputFieldValue.length > maxCharLength) {
                msg = 'Maximum limit of '+maxCharLength+' characters reached for the Input Field!';
            } else {
                msg = '';
            }
        
        } else if (type=='date') {
            if (inputFieldValue === '') {   
                switch (inputFieldId) {
                    case 'starting_date': msg = 'Please provide Proposed starting date'; break;
                    case 'ending_date': msg = 'Please provide Proposed ending date'; break;
                    default: msg = ''; break;
                }

                if (trimInputFieldId == 'session_wise_topic_day') {   
                    msg = 'Please enter Topic Date!';
                }
            }
        } else if (type=='number') {
            if (inputFieldId=="phone_no" || inputFieldId=="deputy_co_phone_no") {
                if (inputFieldValue === '') {   
                    msg = 'Please enter your mobile Number!';
                }
                if (inputFieldValue.match(phoneNoReg)) {
                    msg = '';
                } else {
                    msg = 'Please enter valid mobile Number';
                }
            } else {
                if (inputFieldValue === '') {   
                    switch (inputFieldId) {
                        case 'no_of_working_days': msg = 'Please provide number of working days'; break;
                        case 'no_of_participants': msg = 'Please provide No. of participants'; break;
                        case 'item_cost_consumables': msg = 'This field is required!'; break;
                        case 'item_cost_honorarium': msg = 'This field is required!'; break;
                        case 'item_cost_honorarium_no_of_lecture_sessions': msg = 'This field is required!'; break;
                        case 'item_cost_honorarium_no_of_practical_sessions': msg = 'This field is required!'; break;
                        case 'item_cost_honorarium_no_of_assistants': msg = 'This field is required!'; break;
                        case 'item_cost_honorarium_no_of_days': msg = 'This field is required!'; break;
                        case 'item_cost_working': msg = 'This field is required!'; break;
                        case 'item_cost_working_lunch_rate_per_day': msg = 'This field is required!'; break;
                        case 'item_cost_working_lunch_no_of_assistants': msg = 'This field is required!'; break;
                        case 'item_cost_working_lunch_no_of_days': msg = 'This field is required!'; break;
                        case 'item_cost_contingency': msg = 'This field is required!'; break;
                        case 'item_cost_overhead': msg = 'This field is required!'; break;
                        case 'item_cost_total': msg = 'This field is required!'; break;
                        default: msg = ''; break;
                    }
                } else if (inputFieldId == 'no_of_working_days') {
                    if (inputFieldValue<=4) {
                        msg = 'Please note that a minimum of 5 working days is required for processing'; 
                    }
                } else if (inputFieldId == 'no_of_participants') {
                    if (inputFieldValue<=0) {
                        msg = 'Please be advised that a minimum of 1 participant is required.'; 
                    }

                } else if (inputFieldId == 'item_cost_honorarium_no_of_lecture_sessions' || inputFieldId == 'item_cost_honorarium_no_of_practical_sessions' || inputFieldId == 'item_cost_honorarium_no_of_assistants' || inputFieldId == 'item_cost_honorarium_no_of_days'
                        || inputFieldId == 'item_cost_working_lunch_rate_per_day' || inputFieldId == 'item_cost_working_lunch_no_of_assistants'|| inputFieldId == 'item_cost_working_lunch_no_of_days'
                        || inputFieldId == 'item_cost_total'
                    ) {
                    if (inputFieldId == 'item_cost_total') {
                        if (inputFieldValue>250000) {
                            msg = 'Specified Limit Exceeded !'; 
                        } 
                        
                    } else if (inputFieldId == 'item_cost_honorarium_no_of_assistants' && (inputFieldValue==0 || inputFieldValue=='0.00' || inputFieldValue=='' )) {
                        if ($("#item_cost_honorarium_no_of_days").val()>0) {
                            msg = 'Please enter no of days!';  
                        }
                    } else if (inputFieldId == 'item_cost_honorarium_no_of_days' && (inputFieldValue==0 || inputFieldValue=='' )) {
                        if ($("#item_cost_honorarium_no_of_assistants").val()>0) {
                            msg = 'Please enter no of people!';
                        }

                    } else if (inputFieldId == 'item_cost_working_lunch_rate_per_day' && (inputFieldValue==0 || inputFieldValue=='0.00' || inputFieldValue=='' )) {
                        if ($("#item_cost_working_lunch_no_of_assistants").val()>0 || $("#item_cost_working_lunch_no_of_days").val()>0) {
                            msg = 'Please enter the rate for lunch!';
                        }
                    } else if (inputFieldId == 'item_cost_working_lunch_no_of_assistants' && (inputFieldValue==0 || inputFieldValue=='' )) {
                        if ($("#item_cost_working_lunch_rate_per_day").val()>0 || $("#item_cost_working_lunch_no_of_days").val()>0) {
                            msg = 'Please enter no of people!';
                        }
                    } else if (inputFieldId == 'item_cost_working_lunch_no_of_days' && (inputFieldValue==0 || inputFieldValue=='' )) {
                        if ($("#item_cost_working_lunch_no_of_assistants").val()>0 || $("#item_cost_working_lunch_rate_per_day").val()>0) {
                            msg = 'Please enter no of days!';  
                        }
                    }

                    if (inputFieldValue<0) {   
                        msg = 'Invalid input !'; 
                    }
                } else if (inputFieldValue<0) {   
                    msg = 'Negative values are not allowed. Please enter a valid value.';  
                }
            }

        } else if (type=='email') {
            if (inputFieldValue === '') {   
                msg = 'Please enter your EMAIL ID!';
            } else if (!emailReg.test(inputFieldValue)) {
                msg = 'Please enter valid email address';
            }
        }
        return msg;
    }

    function submitForm() {
        if (validateFormData(0) && validateFormData(1) && validateFormData(2) && validateFormData(3) && validateFormData(4) && validateFormData(5) && validateFormData(6)) {
            // is data saved 
            if (validateSavedData(0) && validateSavedData(1) && validateSavedData(2) && validateSavedData(3) && validateSavedData(4) && validateSavedData(5) && validateSavedData(6)) {
                if (document.querySelector("#form_submission_note").checked) {
                    // alert
                    submitFormAlert();
                } else {
                    popUpMsg("Please agree to the Form submission to GSRF office!");
                }
            } else {
                popUpMsg("Please save the data first !!");
            }
        } else {
            // popUpMsg("Required fields are empty");
        }
    }
    async function submitFormAlert() {
        const result = await popUpSchemeConfirmMsg({
            icon: 'warning',
            iconColor: '#e3da16',
            title: 'Form Submissions are Final', 
            confirmButtonText: 'Confirm',
            showCancelButton: true,
            type: 'alert',
        });

        if (result) {
            saveData["form_type"] = 'submit-form';
            saveData["scheme_id"] = $("#scheme_id").val();
            AmagiLoader.show();
            callApi({
                method: 'POST',
                url: 'api/schemeSummerSchoolApi.php',
                data: saveData,
                form_type: 'apply-scheme',
                is_loader: 'within_the_page',
            });
        }
    }
    function getApiResponse(res, type) {
        if (res.flag && res.status=='200') {
            if (type=='save-form') {
                if (res.data['scheme_id']) {
                    $('#scheme_id').val(res.data['scheme_id']);
                }
                $(".save_btn").attr('disabled', false);
            } else if (type=='preview-data') {
                getSavedData = res.data;
                getSavedData['flag'] = true; 
                localStorage.setItem("summerSchoolData", JSON.stringify(getSavedData));
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else if (type=='apply-scheme') {
                AmagiLoader.hide();
                popUpSchemeConfirmMsg({
                    localStorageKey : 'summerSchoolData',
                    schemeUrl : '<?php echo $schemeUrl ?>',
                    scheme_code : scheme_code,
                    title : res.message, 
                    confirmButtonText : 'Confirm',
                    showCancelButton : false,
                });
                // generate pdf
                callApi({
                    method: 'GET',
                    url: 'api/schemeSummerSchoolApi.php?id='+userId+'&schemeBatchId='+schemeBatchId+'&type=generate-pdf',
                    form_type: 'generate-pdf',
                    is_loader: 'within_the_page',
                });
            } else if (type=='generate-pdf') {
                // do nothing
            }
        } else {
            // if not preview data then show error
            if (type=='preview-data') {
                AmagiLoader.hide()
            } else {
                popUpMsg(res.message, "", "error");
            }
        }
        // scroll effect
        if (type=='save-form') {} else {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
</script>
<script src="assets/js/forms-tab.js?<?php echo time() ?>"></script>
</body>
</html>