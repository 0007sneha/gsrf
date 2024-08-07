// assets/js/custom-scripts.js?<?php echo time() ?>

const currentDate = new Date();
let getCurrentYear = currentDate.getFullYear();
let getPreviousYear = getCurrentYear - 1;
var getCurrentMonth = currentDate.getMonth() + 1;

const monthsArr = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const monthsShortArr = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
const weekdaysShortArr = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
var phoneNoReg = /^\d{10}$/;
var regexCharsAllow = /^[a-zA-Z\s.]+$/;
var regexOnlyTextSupportChars = /^[a-zA-Z\s.\-,\'":()]+$/i;
        // allows: uppercase,lower, spaces, tabs, ., -, ,, ', ", ((), but not used together
        // What it disallows: Numbers (0-9), Symbols beyond the listed ones (e.g., @, #, $, %), Empty strings
var regexWordRegexSpace = /\S+/g;
var regexWordRegexExceptSpaceSlashHyphen = /[a-zA-Z0-9\/-]+/g;
var regexWordSpaceSlashHyphen = /[a-zA-Z0-9]+/g;
var regexCoddingTags = /[<>]/;

// custom added ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// console.log('test ---------2');

function removeTimeString(dateString) {
    if (dateString.length > 10) {
        return dateString.slice(0, 10); // Assuming yyyy-mm-dd format
    }
    return dateString;
}
// set loader ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
function loaderTimeOut(url, timer = 3000) {
    setTimeout(() => {
        if (url) {
            window.location.href = url;
        } else {
            window.location.reload();
        }
    }, timer);
}
function pageName() {
    // Get the current URL of the page
    let currentURL = window.location.href;
    // Split the URL by "/" to get its components
    let urlComponents = currentURL.split('/');
    // Get the last component (which should be the file name)
    let fileName = urlComponents[urlComponents.length - 1];
    // console.log('File name:', fileName);
    return fileName;
}

function getToday(value = '', format = 'ymd') {
    let dateTime, response, day, month, year, monthName, monthNameShort;

    if (value == "0000-00-00") {
        return response = null;
    } else if (value) {
        dateTime = new Date(value);
    } else {
        dateTime = new Date();
    }
    day = dateTime.getDate();
    month = dateTime.getMonth() + 1;
    year = dateTime.getFullYear();
    monthName = monthsArr[dateTime.getMonth()];
    monthNameShort = monthsShortArr[dateTime.getMonth()];

    // format day
    day = day.toString().padStart(2, '0');
    month = month.toString().padStart(2, '0');

    switch (format) {
        case 'dmy': response = `${day}-${month}-${year}`; break;
        case 'dMy': response = `${day}-${monthName}-${year}`; break;
        case 'mdy': response = `${monthNameShort}-${day}-${year}`; break;
        case 'ymd': response = `${year}-${month}-${day}`; break;
        default: response = ''; break;
    }
    return response;
}

// alerts  ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 10000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
function popUpMsg(msg, position = "top-end", icon = "warning") {
    Toast.fire({
        icon: icon,
        title: msg,
    });
}
function popUpAlertLogin() {
    Swal.fire({
        title: '<strong>Not registered with GSRF yet?</strong>',
        icon: 'info',
        iconColor: '#0A6EBD',
        html: 'Please register yourself, before applying for the scheme! <br> or Already have an account? Sign in. ',
        allowOutsideClick: false,
        focusConfirm: true,
        showConfirmButton: true,
        confirmButtonColor: '#0A6EBD',
        confirmButtonText: '<span class="sign_in_alert">Register</span>',
        showCancelButton: true,
        cancelButtonColor: '#d8a47f',
        cancelButtonText: '<span class="sign_in_alert">Log in</span>',
        showCloseButton: true,
    }).then((result) => {
        if (result['isConfirmed']) {
            location.href = "registration-form.php";
        } else if (result.dismiss == 'cancel') {
            location.href = "login.php";
        } else if (result.dismiss == 'esc') {
            // console.log('cancle-esc**strong text**');
        }
    });
}

function popUpAlertEmailReVerification(email) {
    Swal.fire({
        title: '<strong>Email verification not completed yet?</strong>',
        icon: 'info',
        iconColor: '#0A6EBD',
        html: 'Please find the verification link in your mail box. <br> or <br> if, didn\'t receive the mail then please click on the link below for reverification of email.',
        allowOutsideClick: false,
        focusConfirm: true,
        showConfirmButton: true,
        confirmButtonColor: '#0A6EBD',
        confirmButtonText: '<span class="sign_in_alert">Re-Verify Email</span>',
        showCancelButton: true,
        cancelButtonColor: '#d8a47f',
        cancelButtonText: '<span class="sign_in_alert">Cancel</span>',
        showCloseButton: true,
    }).then((result) => {
        if (result['isConfirmed']) {
            // console.log('send email');
            var data = {
                email: email
            }
            callApi({
                method: 'POST',
                url: 'api/registerUserApi.php',
                data: data,
                form_type: 'reverification',
            });

        } else if (result.dismiss == 'cancel') {
            // console.log('close result['isDenied']');
        } else if (result.dismiss == 'esc') {
            // console.log('cancle-esc result['isDismissed']');
        }
    });
}
function popUpSchemeConfirmMsg({
    localStorageKey = '',
    schemeUrl = '',
    scheme_code = '',
    title,
    msg = 'Please <strong>download the softcopy</strong>, take a printout, and substitute with original <strong>certificates</strong> and <strong>endorsements</strong>. <br><strong> Note: Kindly submit the hard copy to the GSRF within a week.</strong>',
    icon = 'success',
    iconColor = '#0abd3c',
    confirmButtonText = 'Confirm',
    confirmButtonColor = '#0A6EBD',
    showCancelButton = true,
    cancelButtonText = 'Cancel',
    cancelButtonColor = '',
    type = 'confirm', // [confirm=>after response, alert=>before form submission]
}) {
    if (type=='alert') {
        msg = 'Please note that <strong> once a form is submitted, no changes can be made to the submission</strong>. <p style = "font-size:14px; padding-top:8px;" > It is essential to review and ensure the accuracy of your submission before submitting, as it cannot be updated or changed after submission.</p> ';
    }
    return Swal.fire({
        title: '<strong>' + title + '</strong>',
        icon: icon,
        iconColor: iconColor,
        html: msg,
        allowOutsideClick: false,
        focusConfirm: true,
        showConfirmButton: true,
        confirmButtonColor: confirmButtonColor,
        confirmButtonText: '<span class="sign_in_alert">' + confirmButtonText + '</span>',
        showCancelButton: showCancelButton,
        cancelButtonColor: cancelButtonColor,
        cancelButtonText: '<span class="sign_in_alert">' + cancelButtonText + '</span>',
        showCloseButton: true,
    }).then((result) => {
        // console.log(result);
        if (type == 'alert') {
            return result['isConfirmed'];
        } else {
            if (result) {
                clearData(localStorageKey, schemeUrl, false, 1000);
                applyForTheScheme(scheme_code);
            }
        }
    });
}
function popUpAlertMsg({
    title,
    msg,
    icon = 'info',
    iconColor = '#0A6EBD',
    confirmButtonText = 'Confirm',
    confirmButtonColor = '#0A6EBD',
    cancelButtonText = 'Cancel',
    cancelButtonColor = '',
}) {
    Swal.fire({
        title: '<strong>' + title+'</strong>',
        icon: icon,
        iconColor: iconColor,
        html: msg,
        allowOutsideClick: false,
        focusConfirm: true,
        showConfirmButton: true,
        confirmButtonColor: confirmButtonColor,
        confirmButtonText: '<span class="sign_in_alert">' + confirmButtonText +'</span>',
        showCancelButton: true,
        cancelButtonColor: cancelButtonColor,
        cancelButtonText: '<span class="sign_in_alert">' + cancelButtonText +'</span>',
        showCloseButton: true,
    }).then((result) => {
        console.log(result['isConfirmed']);
        
        // if (result['isConfirmed']) {
        //     return true;
        // } else if (result.dismiss == 'cancel') {
        //     return false;
        // } else if (result.dismiss == 'esc') {
        //     // console.log('cancle-esc**strong text**');
        // }
    });
}

// validations  ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
function validateDOB(id, msg = "Please enter validate Date Of Birth !") {
    let tempValue = $("#" + id).val();
    // Parse the input date string into a Date object
    const dob = new Date(tempValue);
    // Calculate the minimum and maximum allowed birth years
    const currentYear = new Date().getFullYear();
    const minimumBirthYear = currentYear - 14; // Minimum age of 14
    const maximumBirthYear = currentYear - 120; // Adjust the maximum age as needed
    // Check if the birth year is within the allowed range
    const birthYear = dob.getFullYear();

    if (tempValue == "") {
        msg;
    } else if (!/^\d{4}-\d{2}-\d{2}$/.test(tempValue)) {
        // Check if the input is a valid date in the format "YYYY-MM-DD"
        msg = "Please enter validate date format !";
    } else if (isNaN(dob)) {
        // Check if the parsed date is valid (not NaN)
        msg = "Please enter validate date !";
    } else if (birthYear > minimumBirthYear) {
        msg = "Eligibility for the scheme is minimum 14 years !";
    } else if (birthYear < maximumBirthYear) {
        msg = "Please enter proper date !";
    } else {
        return true;
    }

    $("#" + id).focus();
    $("#" + id).addClass("error-msg-field");
    setTimeout(() => {
        $("#" + id).removeClass("error-msg-field");
    }, 5000);
    popUpMsg(msg);
    return false;
}
function verifyIdentification(idNumber) {
    if (isValidAadhar(idNumber)) {
        return true;
    } else if (isValidEPIC(idNumber)) {
        return true;
    } else if (isValidPAN(idNumber)) {
        return true;
    } else {
        popUpMsg("Please enter valid Identity Proof Number!!", "", "warning");
        $("#identity_no").focus();
        $("#identity_no").addClass("error-msg-field");
        setTimeout(() => {
            $("#identity_no").removeClass("error-msg-field");
        }, 5000);
        return false;
    }
}
function isValidAadhar(aadharNumber) {
    // Aadhar number should be a 12-digit number '123456789012'
    const aadharRegex = /^\d{12}$/;
    return aadharRegex.test(aadharNumber);
}
function isValidEPIC(epicNumber) {
    // EPIC number should be a combination of letters and numbers with a length of 10 number 'AB12345678';
    const epicRegex = /^[a-zA-Z0-9]{10}$/;
    return epicRegex.test(epicNumber);
}
function isValidPAN(panNumber) {
    // PAN number should be in the format AAAAB1234C number ABCDE1234F
    const panRegex = /^[A-Z]{5}\d{4}[A-Z]{1}$/;
    return panRegex.test(panNumber);
}
function isValidEducationName(name) {
    // Validate against special characters, symbols, numbers, etc.
    return /^[a-zA-Z\s.'-]*$/.test(name);
}
function validateText(e) {
    if (e.shiftKey || e.ctrlKey || e.altKey) {
        // e.preventDefault();
        console.log('shift, ctrl, alt');
    } else {
        var key = e.keyCode;
        if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault();
            console.log('key');
        } else {
            console.log('allow');
        }
    }
}
function validatePhoneNumber(id, msg) { 
    let tempPhoneNo = $("#" + id).val();
    if (msg) {
        if (tempPhoneNo == "") {
            $("#" + id).focus();
            popUpMsg(msg);
            return false;

        } else if (tempPhoneNo.match(phoneNoReg)) {
            return tempPhoneNo;

        } else {
            $("#" + id).focus();
            popUpMsg('Please enter valid mobile Number!');
            return false;
        }
    } else {
        return tempPhoneNo;
    }
}
function validateEmailId(id, msg) {
    let tempEmail = $("#" + id).val();
    if (msg) {
        if (tempEmail == "") {
            $("#" + id).focus();
            popUpMsg(msg);
            return false;

        } else if (!emailReg.test(tempEmail)) {
            $("#" + id).focus();
            popUpMsg('Please enter valid email address!');
            return false;
        } else {
            return tempEmail;
        }
    } else {
        return tempEmail;
    }
}
function validateNewPassword(id) {
    let tempValue = $("#" + id).val();
    let isErrorMsg = "error";

    // Check if the password is at least 8 characters long
    if (tempValue.length < 8) {
        showErrorField(id, isErrorMsg);
        popUpMsg('Password must be min 8 characters!');
        return false;
    }
    // Check if the password contains at least one uppercase letter
    if (!/[A-Z]/.test(tempValue)) {
        showErrorField(id, isErrorMsg);
        popUpMsg('Password must contains at least one uppercase letter!');
        return false;
    }
    // Check if the password contains at least one lowercase letter
    if (!/[a-z]/.test(tempValue)) {
        showErrorField(id, isErrorMsg);
        popUpMsg('Password must contains at least one lowercase letter!');
        return false;
    }
    // Check if the password contains at least one number
    if (!/[0-9]/.test(tempValue)) {
        showErrorField(id, isErrorMsg);
        popUpMsg('Password must contains at least one number!');
        return false;
    }
    // Check if the password contains at least one special character
    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(tempValue)) {
        showErrorField(id, isErrorMsg);
        popUpMsg('Password must contains at least one special character!');
        return false;
    }
    // If all checks pass, the password is valid
    return true;
}

function validatePassword() {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;
    let isPasswordSatisfies = validateNewPassword("password");

    if (isPasswordSatisfies && password && confirmPassword) {
        // Compare the two password values
        if (password !== confirmPassword) {
            $(".error-msg").text("Passwords do not match. Please recheck your password.");
            $("#password").addClass("error-msg-field");
            $("#confirm_password").addClass("error-msg-field");
            popUpMsg("Please confirm your password !!");
            $("#confirm_password").focus();

            return false;
        } else {
            $(".error-msg").text("");
            $("#password").removeClass("error-msg-field");
            $("#confirm_password").removeClass("error-msg-field");
            $("#password").addClass("success-msg-field");
            $("#confirm_password").addClass("success-msg-field");

            setTimeout(() => {
                $("#password").removeClass("success-msg-field");
                $("input#confirm_password").removeClass("success-msg-field");
            }, 5000);

            return true;
        }
    } else {
        return false;
    }
}

function countDevanagariWordsSimple(text) {
    const words = text.split(/\s+/).filter(word => word.trim() !== "" && word !== "-");
    return words.length;
}
function truncateWords(text, id, limit) {
    // Split the text into an array of words
    const words = text.trim().split(/\s+/);
    // Truncate the array to the specified limit
    words.length = Math.min(words.length, limit);
    // Join the truncated array back into a string
    const truncatedText = words.join(' ');

    // Update the value of the element with the given ID
    $("#" + id).val(truncatedText);
    // $("#" + id).text(truncatedText);
}
// function truncateWords(text, id, limit) {
//     const lines = text.split('\n');
//     const truncatedLines = lines.map(line => {
//         const words = line.trim().split(/\s+/);
//         const truncatedWords = words.slice(0, limit);
//         // Remove trailing whitespace from the last word if necessary
//         const lastWord = truncatedWords[truncatedWords.length - 1];
//         if (lastWord.endsWith(' ') || lastWord.endsWith('\t')) {
//         truncatedWords[truncatedWords.length - 1] = lastWord.trim();
//         }
//         return truncatedWords.join(' ');
//     });
//     const truncatedText = truncatedLines.join('\n');
//     $("#" + id).val(truncatedText);
//     // $("#" + id).text(truncatedText);
// }

function validateWordCount(id, limit) {
    let tempFieldInput = $("#" + id).val();
    let tempFieldDiv = '';
    // tempFieldDiv = $("#" + id).text();
    let tempField = tempFieldDiv ? tempFieldDiv : tempFieldInput;
    var words = 0;

    // Regular expression to match words with letters, numbers, "/", and "-"
    // var regexWordSpaceSlashHyphen = /[a-zA-Z0-9\/-]+/g;
    // if ((tempField.match(regexWordSpaceSlashHyphen)) != null) {
    //     words = tempField.match(regexWordSpaceSlashHyphen).length;
    // }
    words = countDevanagariWordsSimple(tempField);

    if (words >= (limit-10)) {
        $("#" + id).addClass('word-limit-reached');
    } else {
        $("#" + id).removeClass('word-limit-reached');
    }

    if (words > limit) {
        $("#" + id).focus();
        $("#" + id).addClass("error-msg-field");
        // $("#" + id).val(tempField.match(regexWordSpaceSlashHyphen).slice(0, limit).join(' '));
        truncateWords(tempField, id, limit);
        $("#" + id + "_error_msg").text("you are not allowed to write more than " + limit + " words.");  // words left

        setTimeout(() => {
            $("#" + id).removeClass("error-msg-field");
        }, 2000);
    } else {
        $("#" + id + "_display_count").text(words);// number of words
        // $('#word_left').text(limit-words);  // words left
    }
}

// calculate values------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
function convertNumberToDecimal(e) {
    let decimal_value = addZeroes(e.value);
    $("#" + e.id).val(decimal_value);
}
function calculateTotalBudget(e) {
    let lectureRate = 750;
    let practicalsRate = 750;
    let assistantRate = 500;
    let totalLectureRate = totalPracticalsRate = totalAssistantRate = 
        item_cost_honorarium_no_of_lecture_sessions =
        item_cost_honorarium_no_of_practical_sessions =
        item_cost_honorarium_no_of_assistants =
        item_cost_honorarium_no_of_days =
        item_cost_working_lunch_rate_per_day =
        item_cost_working_lunch_no_of_assistants =
        item_cost_working_lunch_no_of_days = 0;
    let item_cost_consumables = item_cost_honorarium = item_cost_working = item_cost_contingency = item_cost_overhead = total_1_4 = total = 0;

    item_cost_consumables = Number($("#item_cost_consumables").val()) ?? 0;
    
    // if (e.id == "item_cost_honorarium_no_of_lecture_sessions" ||
    //     e.id == "item_cost_honorarium_no_of_practical_sessions" ||
    //     e.id == "item_cost_honorarium_no_of_assistants" ||
    //     e.id == "item_cost_honorarium_no_of_days"
    // ) {
        // honorarium
        item_cost_honorarium_no_of_lecture_sessions = Number($("#item_cost_honorarium_no_of_lecture_sessions").val()) ?? 0;
        item_cost_honorarium_no_of_practical_sessions = Number($("#item_cost_honorarium_no_of_practical_sessions").val()) ?? 0;
        item_cost_honorarium_no_of_assistants = Number($("#item_cost_honorarium_no_of_assistants").val()) ?? 0;
        item_cost_honorarium_no_of_days = Number($("#item_cost_honorarium_no_of_days").val()) ?? 0;
        
        totalLectureRate = lectureRate * item_cost_honorarium_no_of_lecture_sessions;
        totalPracticalsRate = practicalsRate * item_cost_honorarium_no_of_practical_sessions;
        totalAssistantRate = (assistantRate * item_cost_honorarium_no_of_assistants) * item_cost_honorarium_no_of_days;
        item_cost_honorarium = totalLectureRate + totalPracticalsRate + totalAssistantRate;
        $("#item_cost_honorarium").val(addZeroes(item_cost_honorarium));
    // }
    if ($("#item_cost_honorarium_no_of_lecture_sessions").val() == ""&& $("#item_cost_honorarium_no_of_practical_sessions").val() == "" && ($("#item_cost_honorarium_no_of_assistants").val() == "" || $("#item_cost_honorarium_no_of_days").val() == "") ) {
        $("#item_cost_honorarium").val('');
    }

    // if (e.id == "item_cost_working_lunch_rate_per_day" ||
    //     e.id == "item_cost_working_lunch_no_of_assistants" ||
    //     e.id == "item_cost_working_lunch_no_of_days"
    // ) {
        item_cost_working_lunch_rate_per_day = Number($("#item_cost_working_lunch_rate_per_day").val()) ?? 0;
        item_cost_working_lunch_no_of_assistants = Number($("#item_cost_working_lunch_no_of_assistants").val()) ?? 0;
        item_cost_working_lunch_no_of_days = Number($("#item_cost_working_lunch_no_of_days").val()) ?? 0;
        item_cost_working = (item_cost_working_lunch_rate_per_day * item_cost_working_lunch_no_of_assistants) * item_cost_working_lunch_no_of_days;
        $("#item_cost_working").val(addZeroes(item_cost_working));
    // }
    if ($("#item_cost_working_lunch_rate_per_day").val() == "" ||  $("#item_cost_working_lunch_no_of_assistants").val() == "" ||  $("#item_cost_working_lunch_no_of_days").val() == "") {
        $("#item_cost_working").val('');
    }

    item_cost_contingency = Number($("#item_cost_contingency").val()) ?? 0;
    total_1_4 = item_cost_consumables + item_cost_honorarium + item_cost_working + item_cost_contingency;

    item_cost_overhead = total_1_4 * (20 / 100);
    $("#item_cost_overhead").val(addZeroes(item_cost_overhead));

    total = total_1_4 + item_cost_overhead;
    $("#item_cost_total").val(addZeroes(total));

    validateInput({
        'id': 'item_cost_total',
        'value': total.toString(),
        'type': 'number',
    });
    if (total > 250000) {
        popUpMsg('Kindly review your transactions and ensure they align with this limit. If you have any concerns or require assistance, feel free to reach out to our support team.');
    }
}
function calculateTotalBudgetForMinMaj(e) {
    let inputFieldId = e.id;
    let trimInputFieldId = inputFieldId.slice(0, -2);
    let inputFieldIdNumber = inputFieldId.split("_")[1];

    let year1 = year2 = year3 = total = 0;
    let year1Total = year2Total = year3Total = yearlyTotal = 0;
    let year1Total2 = year2Total2 = year3Total2 = yearlyTotal2 = 0;
    let iterateInputFieldFrom = maxCountID = grandTotalNumberID = 0;
    let equipmentYear1Total = equipmentYear2Total = equipmentYear3Total = equipmentYearlyTotal = 0;
    let equipmentCountID = 2,
        equipmentIDStart = 3,
        equipmentIDEnd = 8;

    let isYear3 = false;

    // Set condition for Rec & Non-rec Totals
    if (inputFieldIdNumber<=9) {
        iterateInputFieldFrom = 3;
        maxCountID = 9;
        if (scheme_code=="MIN") {
            maxCountID2 = 15;
            grandTotalNumberID = 16;
        } else {
            maxCountID2 = 16;
            grandTotalNumberID = 17;
        }
    } else {
        iterateInputFieldFrom = 10;
        maxCountID2 = 9;
        if (scheme_code == "MIN") {
            maxCountID = 15;
            grandTotalNumberID = 16;
        } else {
            maxCountID = 16;
            grandTotalNumberID = 17;
        }
    }
    
    // calculate total for Rec & Non-rec Years
    for (let index = iterateInputFieldFrom; index < maxCountID; index++) {
        if (document.getElementById("year_" + index + "_3")) {
            isYear3 = true;
        }

        year1 = Number($("#year_"+index+"_1").val()) ?? 0;
        year2 = Number($("#year_" + index + "_2").val()) ?? 0;
        if (isYear3) {
            year3 = Number($("#year_"+index+"_3").val()) ?? 0;
        }
        total = year1 + year2 + year3;
        $("#year_" + index + "_total").val(addZeroes(total));

        if (equipmentIDStart <= index && equipmentIDEnd >= index) {
            equipmentYear1Total = equipmentYear1Total + year1;
            equipmentYear2Total = equipmentYear2Total + year2;
            equipmentYear3Total = equipmentYear3Total + year3;
            equipmentYearlyTotal = equipmentYearlyTotal + total;

            $("#year_" + equipmentCountID + "_1").val(addZeroes(year1Total));
            $("#year_" + equipmentCountID + "_2").val(addZeroes(year2Total));
            if (isYear3) {
                $("#year_" + equipmentCountID + "_3").val(addZeroes(year3Total));
            }
            $("#year_" + equipmentCountID + "_total").val(addZeroes(yearlyTotal));
        }
            
        // Rec/Non-rec Totals
        year1Total += year1;
        year2Total += year2;
        year3Total += year3;
        yearlyTotal += total;
        $("#year_" + maxCountID + "_1").val(addZeroes(year1Total));
        $("#year_" + maxCountID + "_2").val(addZeroes(year2Total));
        if (isYear3) {
            $("#year_" + maxCountID + "_3").val(addZeroes(year3Total));
        }
        $("#year_" + maxCountID + "_total").val(addZeroes(yearlyTotal));

        // Rec/Non-rec Totals
        year1Total2 = $("#year_" + maxCountID2 + "_1").val();
        year2Total2 = $("#year_" + maxCountID2 + "_2").val();
        if (isYear3) {
            year3Total2 = $("#year_" + maxCountID2 + "_3").val();
        }
        yearlyTotal2 = $("#year_" + maxCountID2 + "_total").val();

        // Rec & Non-rec Grand Total Yearly
        year1Total2 = Number(year1Total) + Number(year1Total2); 
        year2Total2 = Number(year2Total) + Number(year2Total2); 
        year3Total2 = Number(year3Total) + Number(year3Total2); 
        yearlyTotal2 = Number(yearlyTotal) + Number(yearlyTotal2); 
        $("#year_" + grandTotalNumberID + "_1").val(addZeroes(year1Total2));
        $("#year_" + grandTotalNumberID + "_2").val(addZeroes(year2Total2));
        if (isYear3) {
            $("#year_" + grandTotalNumberID + "_3").val(addZeroes(year3Total2));
        }
        $("#year_" + grandTotalNumberID + "_total").val(addZeroes(yearlyTotal2));
        $("#budget_consolidated").val(addZeroes(yearlyTotal2));
        $("#proposed_amount").val(addZeroes(yearlyTotal2));
    }
}

function addZeroes(userInput) {
    // Convert the user input to a floating-point number
    var floatValue = parseFloat(userInput);
    // Check if the input is a valid number
    if (!isNaN(floatValue)) {
        // Format the number to two decimal places
        var formattedInput = floatValue.toFixed(2);
        // Display the formatted input
        // console.log(formattedInput);
    } else {
        // Handle invalid input (e.g., not a number)
        // console.log("Invalid input");
    }
    return formattedInput;
}

function getDayCountBasedOnEventDateSelection() {
    let start_date = $('#starting_date').val();
    let end_date = $('#ending_date').val();

    if (start_date && end_date) {
        // Convert the date strings to Date objects
        const startDate = new Date(start_date);
        const endDate = new Date(end_date);
    
        // Calculate the difference in milliseconds
        const differenceInTime = endDate.getTime() - startDate.getTime();
        // Convert the difference from milliseconds to days
        const differenceInDays = differenceInTime / (1000 * 3600 * 24) + 1
        
        return differenceInDays;
    } else {
        return 1;
    }
}

function isStartingDateSelected(value) {
    let start_date = $('#starting_date').val();
    let end_date = $('#ending_date').val();
    
    // if (start_date == '') {
    //     let msg = "Please select starting date first!";
    //     showErrorField("ending_date", msg);
    //     popUpMsg(msg);
    //     $('#ending_date').val("");
    // }
    if (start_date == end_date) {
        let msg = "Proposed Starting and Ending date cannot be same !";
        showErrorField("ending_date", msg);
        popUpMsg(msg);
        // $('#ending_date').val("");
    }

    if (end_date != '' && start_date > end_date) {
        let msg = "The ending date of the event cannot be earlier than the starting date. Please select a valid date range.";
        if (value=='end') {
            showErrorField("ending_date", msg);
        } else {
            showErrorField("starting_date", msg);
        }
        popUpMsg(msg);
        // $('#starting_date').val("");
    }
}
function validateDate(e, row_temp_id, idName) {
    const selected_element_id = e.getAttribute('id');
    let row_id = extractNumberFromString(selected_element_id);

    let start_date_id = idName + 'start_date_' + row_id;
    let end_date_id = idName + 'end_date_' + row_id;
    let error_msg_title_1 = 'Start ';
    let error_msg_title_2 = 'End ';
    if (row_temp_id == 'reg_con_date') {
        start_date_id = 'registration_date';
        end_date_id = 'confirmation_date';
        error_msg_title_1 = 'Registration';
        error_msg_title_2 = 'Confirmation';
    } else if (row_temp_id == 'start_end_date') {
        start_date_id = 'starting_date';
        end_date_id = 'ending_date';
    }

    var selectedStartDate = document.getElementById(start_date_id).value;
    var startDate = new Date(selectedStartDate);
    var endDate = new Date(document.getElementById(end_date_id).value);

    if (startDate) {
        document.getElementById(end_date_id).min = selectedStartDate;
    }
    if (startDate && startDate >= endDate) {
        if (startDate > endDate) {
            document.getElementById(end_date_id+'_error_msg').innerText = error_msg_title_1+" date must be before "+error_msg_title_2+" date.";
        } else {
            // if start == end 
            document.getElementById(end_date_id+'_error_msg').innerText = error_msg_title_2+" date cannot be same as "+error_msg_title_1+" Date.";
        }
        document.getElementById(end_date_id).value = "";
    } else {
        document.getElementById(end_date_id+'_error_msg').innerText = "";
    }
}

function getDateInJSFormat(selected_date) {
    // Add 1 to the month since JavaScript months are 0-based (0 = January, 1 = February, etc.)
    let month = selected_date.getMonth() + 1;
    let day = selected_date.getDate();

    // Get the Year, Month, and Day components
    return selected_date.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
// Function to set the min and max dates for the second date picker
function setSecondDatePickerRange(value) {
    $('#ending_date').val("");
    var currentDate = new Date(value); // Get the current date

    // Calculate the minimum and maximum date values
    var minDate = new Date(currentDate);
    minDate.setDate(currentDate.getDate() + 5); // Minimum 5 days from today

    var maxDate = new Date(currentDate);
    maxDate.setDate(currentDate.getDate() + 10); // Maximum 10 days from today

    // Set the min and max dates for the second date picker
    document.getElementById('ending_date').min = getDateInJSFormat(minDate);
    document.getElementById('ending_date').max = getDateInJSFormat(maxDate);
}
function setDateRangeForEvent(e) {
    document.getElementById(e.id).min = $('#starting_date').val();;
    document.getElementById(e.id).max = $('#ending_date').val();
}

// upload encoded file ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
function encodeFile(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => {
            const encoded = btoa(reader.result);
            resolve(encoded);
        };
        reader.onerror = reject;
        reader.readAsBinaryString(file);
    });
}
function validateFile(fileId, fileType = "docs", fileSizeLimit, filUploadFormats) {
    var selectedFile = fileId.files[0];
    var sizeInMb = (selectedFile.size / 1024) / 1024;
    var sizeLimit = fileSizeLimit;
    if (!sizeLimit) {
        sizeLimit = 0.7;
    }
    if (sizeInMb > sizeLimit) {
        let sizeAllowed = '';
        if (sizeLimit == 0.7) {
            sizeAllowed = '700 KB';
        } else {
            sizeAllowed = fileSizeLimit+' MB';
        }
        popUpMsg('Please compress the document, File size must be less than ' + sizeAllowed +'!');
        fileId.value = "";
        $("#input_file").focus()
        return false;
    }
    var filename = fileId.value;
    var extension = filename.replace(/^.*\./, '');
    if (extension == filename) {
        extension = '';
    } else {
        extension = extension.toLowerCase();
    }

    if (fileType == "docs") {
        let supported_file_format = '';
        let is_supported_format = false;

        filUploadFormats.forEach(element => {
            supported_file_format += '.'+element + ' ';
            if (element == extension) {
                is_supported_format = true;
            }
        });
        if (is_supported_format == true) {
            switch (extension) {
                case 'pdf':
                case 'doc':
                case 'docx':
                case 'xls':
                case 'xlsx':
                case 'ppt':
                case 'pptx':
                case 'rtf':
                case 'txt':
                    break;
                default:
                    popUpMsg('Please upload valid file! Supported file type is ' + supported_file_format + ',');
                    $("#input_file").focus();
                    return false;
            }
        } else {
            popUpMsg('Please upload valid file! Supported file type is ' + supported_file_format + ',');
            $("#input_file").focus();
            return false;
        }
        
    } else if (fileType == "img") {
        switch (extension) {
            case 'jpg':
            case 'png':
            case 'jpeg':
                break;
            default:
                popUpMsg('Please upload valid file! Supported file type jpg, png, jpeg!')
                $("#input_file").focus()
                return false;
        }
    }
    return true;
}
// let isFileUploaded = 0;
let progressInterval;
function showProgressBarOnFileUpload(fileType, responseId,storage_key='') {
    const progressBar = document.querySelector("#" + responseId + "_field .progressBarContainer .progressBarWidth");
    let percentComplete = 0;
    progressInterval;

    if (fileType == "docs") {
        $("#view_" + responseId).addClass("d-none");
    } else if (fileType == "img") {
        $("#img_" + responseId).addClass("d-none");
        $("#hide_center_container").addClass("d-none");
    }
    $("#remove_" + responseId).addClass("d-none");
    $("#upload_" + responseId).removeClass("d-none");
    $("#" + responseId + "_field .progressBarContainer").removeClass("d-none");

    progressInterval = setInterval(function () {
        if (percentComplete >= 100) {
            clearInterval(progressInterval);
            
            document.querySelectorAll('button').forEach(button => {
                button.disabled = false;
            });
        } else {
            if (percentComplete >= 67) {
                // wait for the file to upload
                if (isFileUploaded == 1) {
                    percentComplete++;
                } else if (isFileUploaded == 2) {
                    // popUpMsg('Failed to upload file !', 'warning');
                    percentComplete = 0;
                    clearInterval(progressInterval);
                    if (fileType == "docs") {
                        $("#view" + responseId).attr("href", '');
                        $("#view_" + responseId).addClass("d-none");

                    } else if (fileType == "img") {
                        $("#img_" + responseId).addClass("d-none");
                        $("#hide_center_container").removeClass("d-none");
                    }
                    $("#remove_" + responseId).addClass("d-none");
                    $("#upload_" + responseId).addClass("d-none");
                    $("#" + responseId + "_field .progressBarContainer").addClass("d-none");
                    
                    document.querySelectorAll('button').forEach(button => {
                        button.disabled = false;
                    });
                }
            } else {
                percentComplete++;
            }
            progressBar.style.width = percentComplete + '%';

            if (percentComplete == 100) {
                window.setTimeout(function () {
                    if (fileType == "docs") {
                        $("#view_" + responseId).removeClass("d-none");
                    }
                    $("#remove_" + responseId).removeClass("d-none");
                    $("#upload_" + responseId).addClass("d-none");
                    $("#" + responseId + "_field .progressBarContainer").addClass("d-none");

                    displayUploadedFile(fileType, responseId, saveData[responseId], storage_key);
                    percentComplete = 0;
                    progressBar.style.width = percentComplete + '%';
                }, 500);
            }
        }
    }, 40);
}



function checkInputToNull(row_temp_id, e, table_name) {
    let temp_empty_val = e.value;
    let is_not_applicable = temp_empty_val ? temp_empty_val.toUpperCase() : ''; 
    const selected_element_id = e.getAttribute('id');
    let row_id = extractNumberFromString(selected_element_id);

    if (is_not_applicable == "NIL" || is_not_applicable == "NA") {
        $("#" + e.id).val(is_not_applicable);

        if (table_name == 'investigators_project') {
            $("#investigators_project_cost_"+row_id).prop('readonly', true);
            $("#investigators_project_submission_month_"+row_id).prop('readonly', true);
            $("#investigators_project_role_"+row_id).prop('readonly', true);
            $("#investigators_project_agency_"+row_id).prop('readonly', true);
            $("#investigators_project_status_" + row_id).prop('readonly', true);

            $("#investigators_project_cost_" + row_id).val("");
            $("#investigators_project_submission_month_" + row_id).val("");
            $("#investigators_project_role_" + row_id).val("");
            $("#investigators_project_agency_" + row_id).val("");
            $("#investigators_project_status_" + row_id).val("");

        } else if (table_name == 'investigators_ongoing_project') {
            $("#investigators_ongoing_project_cost_"+row_id).prop('readonly', true);
            $("#investigators_ongoing_project_start_date_"+row_id).prop('readonly', true);
            $("#investigators_ongoing_project_end_date_"+row_id).prop('readonly', true);
            $("#investigators_ongoing_project_role_"+row_id).prop('readonly', true);
            $("#investigators_ongoing_project_agency_" + row_id).prop('readonly', true);
            
            $("#investigators_ongoing_project_cost_" + row_id).val("");
            $("#investigators_ongoing_project_start_date_" + row_id).val("");
            $("#investigators_ongoing_project_end_date_" + row_id).val("");
            $("#investigators_ongoing_project_role_" + row_id).val("");
            $("#investigators_ongoing_project_agency_" + row_id).val("");
        
        } else if (table_name == 'investigators_completed_project') {
            $("#investigators_completed_project_cost_" + row_id).prop('readonly', true);
            $("#investigators_completed_project_start_date_" + row_id).prop('readonly', true);
            $("#investigators_completed_project_end_date_" + row_id).prop('readonly', true);
            $("#investigators_completed_project_role_" + row_id).prop('readonly', true);
            $("#investigators_completed_project_agency_" + row_id).prop('readonly', true);
            
            $("#investigators_completed_project_cost_" + row_id).val("");
            $("#investigators_completed_project_start_date_" + row_id).val("");
            $("#investigators_completed_project_end_date_" + row_id).val("");
            $("#investigators_completed_project_role_" + row_id).val("");
            $("#investigators_completed_project_agency_" + row_id).val("");
        
        // Facilities 
        } else if (table_name == 'equipment_name') {
            $("#equipment_institute_" + row_id).prop('readonly', true);
            $("#equipment_model_" + row_id).prop('readonly', true);
            $("#equipment_remark_" + row_id).prop('readonly', true);

            if (row_id>2) {
                $("#equipment_institute_" + row_id).val("");
            }
            $("#equipment_model_" + row_id).val("");
            $("#equipment_remark_" + row_id).val("");
        }
    } else {
        if (table_name == 'investigators_project') {
            $("#investigators_project_cost_"+row_id).prop('readonly', false);
            $("#investigators_project_submission_month_"+row_id).prop('readonly', false);
            $("#investigators_project_role_"+row_id).prop('readonly', false);
            $("#investigators_project_agency_"+row_id).prop('readonly', false);
            $("#investigators_project_status_" + row_id).prop('readonly', false);
        
        } else if (table_name == 'investigators_ongoing_project') {
            $("#investigators_ongoing_project_cost_"+row_id).prop('readonly', false);
            $("#investigators_ongoing_project_start_date_"+row_id).prop('readonly', false);
            $("#investigators_ongoing_project_end_date_"+row_id).prop('readonly', false);
            $("#investigators_ongoing_project_role_"+row_id).prop('readonly', false);
            $("#investigators_ongoing_project_agency_" + row_id).prop('readonly', false);
        
        } else if (table_name == 'investigators_completed_project') {
            $("#investigators_completed_project_cost_" + row_id).prop('readonly', false);
            $("#investigators_completed_project_start_date_" + row_id).prop('readonly', false);
            $("#investigators_completed_project_end_date_" + row_id).prop('readonly', false);
            $("#investigators_completed_project_role_" + row_id).prop('readonly', false);
            $("#investigators_completed_project_agency_" + row_id).prop('readonly', false);
        
            // Facilities
        } else if (table_name == 'equipment_name') {
            $("#equipment_institute_" + row_id).prop('readonly', false);
            $("#equipment_model_" + row_id).prop('readonly', false);
            $("#equipment_remark_" + row_id).prop('readonly', false);
        }
    }
}

// Function to update the serial numbers Table rows
function updateSerialNumbers(wrapper_data) {
    $(wrapper_data).find('.wrapper_row').each(function (index, element) {
        const set_new_id_count_for_element = index + 1;
        // set serial no count for row
        setTimeout(() => {
            // console.log('wait for the call');
        }, 500);
        $(element).find('.serial-number').text(set_new_id_count_for_element); // Update serial number based on index
        
        // set element id
        if (element.querySelectorAll('input')) {
            element.querySelectorAll('input').forEach(input => {
                updateSelectedFieldId(input, set_new_id_count_for_element);
            });
        }
        if (element.querySelectorAll('select')) {
            element.querySelectorAll('select').forEach(input => {
                updateSelectedFieldId(input, set_new_id_count_for_element);
            });
        }
        if (element.querySelectorAll('textarea')) {
            element.querySelectorAll('textarea').forEach(input => {
                updateSelectedFieldId(input, set_new_id_count_for_element);
            });
        }
    });
}
function updateSelectedFieldId(input, set_new_id_count_for_element) {
    const name = input.getAttribute('name');
    const set_new_id = name.split('[')[0] + '_' + set_new_id_count_for_element;

    input.id = set_new_id;
    input.nextElementSibling.id = set_new_id + '_error_msg';
}
// function updateFieldIds() {
//     const rows = document.querySelectorAll('#dynamic-table-body tr');
//     rows.forEach((row, index) => {
//         const idx = index + 1;
//         row.querySelectorAll('input').forEach(input => {
//             const name = input.getAttribute('name');
//             const newId = name.split('[')[0] + '_' + idx;
//             input.id = newId;
//             input.nextElementSibling.id = newId + '_error_msg';
//         });
//     });
// }
function extractNumberFromString(idString) {
    const regex = /\d+$/;
    const match = idString.match(regex);
    return match ? parseInt(match[0], 10) : null;
}


function checkUploadedFiles() {
    let errorFound = false;

    // Select all elements with the class name
    document.querySelectorAll('.file_name_class_in_progressbar').forEach(parentElement => {
        // Check if the parent element does not have the class d-none
        if (!parentElement.classList.contains('d-none')) {
            // Find the span element inside the parent element
            const spanText = parentElement.querySelector('span').textContent;
            // Log the text to the console
            if (spanText === "") {
                let trimmedStrId = parentElement.id.replace(/^view_/, '');
                let trimmedStr = trimmedStrId.replace(/_/g, ' ');
                $("#" + trimmedStr).focus();
                popUpMsg('Failed to upload ' + trimmedStr + ', Please try again.');
                // popUpMsg('Please confirm that your file has been uploaded successfully.');
                errorFound = true;
                return;
            }
        }
    });

    if (errorFound) {
        return 'Error';
    } else {
        return 'Success';
    }
}


// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
function getYearOfPassing(yearValue, fromRow) {
    // if (fromRow<1) { $("#year_of_passing_1").empty(); }
    // if (fromRow<2) { $("#year_of_passing_2").empty(); }
    // if (fromRow<3) { $("#year_of_passing_3").empty(); }
    // if (fromRow<4) { $("#year_of_passing_4").empty(); }
    // if (fromRow<5) { $("#year_of_passing_5").empty(); }
    // if (fromRow<1) { $("#year_of_passing_1").empty(); }
    // if (fromRow<2) { $("#year_of_passing_2").empty(); }
    // if (fromRow<3) { $("#year_of_passing_3").empty(); }
    // if (fromRow<4) { $("#year_of_passing_4").empty(); }
    // if (fromRow<5) { $("#year_of_passing_5").empty(); }

    // // Set Default value for years
    // for (let index = yearValue; index <= getCurrentYear; index++) {
    //     if ( index == getCurrentYear ) {
    //         if (fromRow<1) {
    //             $("#year_of_passing_1").append('<option selected="selected" value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<2) {
    //             $("#year_of_passing_2").append('<option selected="selected" value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<3) {
    //             $("#year_of_passing_3").append('<option selected="selected" value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<4) {
    //             $("#year_of_passing_4").append('<option selected="selected" value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<5) {
    //             $("#year_of_passing_5").append('<option selected="selected" value="'+index+'">'+index+'</option>');
    //         }
    //     } else {
    //         if (fromRow<1) {
    //             $("#year_of_passing_1").append('<option value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<2) {
    //             $("#year_of_passing_2").append('<option value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<3) {
    //             $("#year_of_passing_3").append('<option value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<4) {
    //             $("#year_of_passing_4").append('<option value="'+index+'">'+index+'</option>');
    //         }
    //         if (fromRow<5) {
    //             $("#year_of_passing_5").append('<option value="'+index+'">'+index+'</option>');
    //         }
    //     }
    // }
}
function displayInputField(id) {
    document.getElementById(id).readOnly = false;
}


// ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// Schemes Validation  ----  DF, PDF, --------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
function getPresetUserData(formType) {
    let isCat = 1;

    // console.log(userData);
    if (!getSavedData['flag'] && userData) {
        $("#first_name").val(userData['first_name']);
        $("#middle_name").val(userData['middle_name']);
        $("#last_name").val(userData['last_name']);
        $("#dob").val(userData['dob']);
        $("#country_code").val(userData['country_code']);
        $("#phone_no").val(userData['phone_no']);
        $("#email").val(userData['email']);
        if (userData['gender']) {
            gender = userData['gender'];
        }
        $("input:radio[name=gender]").val([gender]);

        category = userData['category'];

        if (formType == "MajMin") {
            // is selected category has certificate then display
            if (category == 2) {
                isCat = 0;
            }
            $("input:radio[name=is_pi_belong_to_category]").val([isCat]);
            showMoreOptions('category', isCat);
            if (userData['file_category_certificate']) {
                file_category_certificate = userData['file_category_certificate'];
                saveData['file_category_certificate'] = file_category_certificate;
                displayUploadedFile('docs', 'file_category_certificate', file_category_certificate);
            }

            $("input:radio[name=is_pi_differently_abled]").val([userData['differently_abled']]);
            showMoreOptions('pi_diff_abled', userData['differently_abled']);

        } else {
            $("#category").val(category);
            showMoreOptions('category', category);
            if (userData['file_category_certificate']) {
                file_category_certificate = userData['file_category_certificate'];
                saveData['file_category_certificate'] = file_category_certificate;
                displayUploadedFile('docs', 'file_category_certificate', file_category_certificate);
            }

            if (formType == "RSG") {
                $("#is_differently_abled").val(userData['is_differently_abled']);
                showMoreOptions('differently_abled', userData['differently_abled']);
                // if (userData['file_differently_abled_certificate']) {
                //     file_differently_abled_certificate = userData['file_differently_abled_certificate'];
                //     displayUploadedFile('docs', 'file_differently_abled_certificate', file_differently_abled_certificate);
                // }
            } 
        }
    }

    // incase used didn't save form in last part for MIN-MAJ then 
    if (getSavedData['flag'] && userData) {
        if (formType == "MajMin") {
            category = userData['category'];
            
            // is selected category has certificate then display
            if (category == 2) {
                isCat = 0;
            }
            if (getSavedData['is_pi_belong_to_category'] != isCat ) {
                $("input:radio[name=is_pi_belong_to_category]").val([isCat]);
                showMoreOptions('category', isCat);
                if (userData['file_category_certificate']) {
                    file_category_certificate = userData['file_category_certificate'];
                    saveData['file_category_certificate'] = file_category_certificate;
                    displayUploadedFile('docs', 'file_category_certificate', file_category_certificate);
                }
    
                $("input:radio[name=is_pi_differently_abled]").val([userData['differently_abled']]);
                showMoreOptions('pi_diff_abled', userData['differently_abled']);
            }
        }
    }
}
function clearData(localStorageKey, url, isUrl=true, timer) {
    // DF, PDF,
    localStorage.setItem(localStorageKey, JSON.stringify({}));
    if (isUrl) {
        loaderTimeOut(url, timer);
    }
}
function setCurrentYearForYearOfPassing(type = "") {
    // DF, PDF,
    // Set Default value for years
    for (let index = 1900; index <= getCurrentYear; index++) {
        if (index == getCurrentYear) {
            $("#year_of_passing_1").append('<option selected="selected" value="' + index + '">' + index + '</option>');
            $("#year_of_passing_2").append('<option selected="selected" value="' + index + '">' + index + '</option>');
            $("#year_of_passing_3").append('<option selected="selected" value="' + index + '">' + index + '</option>');
            $("#year_of_passing_4").append('<option selected="selected" value="' + index + '">' + index + '</option>');
            $("#year_of_passing_5").append('<option selected="selected" value="' + index + '">' + index + '</option>');
            if (type=="PDFs") {
                $("#year_of_passing_6").append('<option selected="selected" value="' + index + '">' + index + '</option>');
            }
        } else {
            $("#year_of_passing_1").append('<option value="' + index + '">' + index + '</option>');
            $("#year_of_passing_2").append('<option value="' + index + '">' + index + '</option>');
            $("#year_of_passing_3").append('<option value="' + index + '">' + index + '</option>');
            $("#year_of_passing_4").append('<option value="' + index + '">' + index + '</option>');
            $("#year_of_passing_5").append('<option value="' + index + '">' + index + '</option>');
            if (type == "PDFs") {
                $("#year_of_passing_6").append('<option value="' + index + '">' + index + '</option>');
            }
        }
    }
}
function showMoreOptions(type, value) {
    // DF, PDF, mj, RSG
    if (type == "category") {
        if (value == 0 || value == 2) {
            $("#file_category_certificate_field").addClass("d-none");
        } else {
            $("#file_category_certificate_field").removeClass("d-none");
        }
    } else if (type == "domicile") {
        if (value == 1) {
            $("#file_domicile_certificate_field").removeClass("d-none");
        } else {
            $("#file_domicile_certificate_field").addClass("d-none");
        }
    } else if (type == "papers_published") {
        if (value == 1) {
            $("#file_published_papers_field").removeClass("d-none");
        } else {
            $("#file_published_papers_field").addClass("d-none");
        }
    } else if (type == "pi_diff_abled") {
        if (value == 1) {
            $("#file_pi_diff_abled_certificate_field").removeClass("d-none");
        } else {
            $("#file_pi_diff_abled_certificate_field").addClass("d-none");
        }
    } else if (type == "differently_abled") {
        if (value == 1) {
            $("#file_differently_abled_certificate_field").removeClass("d-none");
        } else {
            $("#file_differently_abled_certificate_field").addClass("d-none");
        }
    } else if (type == "running_project") {
        if (value == 1) {
            $("#file_project_details_field").removeClass("d-none");
        } else {
            $("#file_project_details_field").addClass("d-none");
        }
    } else if (type == "non_phd") {
        if (value == 1) {
            $("#file_pi_bona_fide_certificate_field").removeClass("d-none");
        } else {
            $("#file_pi_bona_fide_certificate_field").addClass("d-none");
        }
    }
}
function addProposedWork(showQuarter, showAddButton=false) {
    // DF, PDF,
    let quarters = document.getElementsByClassName("quarter_" + showQuarter);
    for (i = 0; i < quarters.length; i++) {
        $(quarters[i]).toggleClass("d-none");
    }
    if (showAddButton==true && showQuarter == 3) {
        $("#quarter_3").addClass("d-none");
    }
}
function validateEmptyFields(id, msg, fieldName = "") {
    // DF, PDF,
    // forms tab js added
    let tempValue;
    if (id) {
        let inputFieldIdValue = $("#" + id).val();
        let inputFieldDivValue = '';
        // inputFieldDivValue = $("#" + id).text();

        tempValue = inputFieldDivValue ? inputFieldDivValue.trim() : inputFieldIdValue ? inputFieldIdValue.trim() : ''; 
    } else {
        tempValue = $("input:radio[name=" + fieldName + "]").val();
    }
    if (msg == "") {
        return tempValue;
    } else {
        let tempInputFieldType = $("#" + id).attr('type');
        // check if fields are other then input type elements
        if ($("#" + id).is("select")) {
            tempInputFieldType = "select";
        } else if ($("#" + id).is("textarea")) {
            tempInputFieldType = "textarea";
        } else if (fieldName) {
            // if type radio then return the value
            tempInputFieldType = "radio";
            return tempValue;
        // } else {
        //     tempInputFieldType = "div";
        }

        let trimTempValue = '';
        if (tempValue) {
            trimTempValue = tempValue.trim();
        }
        isErrorMsg = validateInputType(tempInputFieldType, id, trimTempValue);
        if (isErrorMsg != '') {
            showErrorField(id, "error");
            popUpMsg(isErrorMsg);
            return false;
        } else {
            if (tempValue == '' || tempValue == null) {
                return 'null';
            }
            return tempValue;
        }
    }
}
function validateInput(inputElement) {
    // DF, PDF,
    const inputFieldId = inputElement.id;
    let inputFieldIdValue = inputElement.value;
    let inputFieldDivValue = '';
    // inputFieldDivValue = $("#" + inputFieldId).text();
    const inputFieldValue = inputFieldDivValue ? inputFieldDivValue.trim() : inputFieldIdValue ? inputFieldIdValue.trim() : ''; 
    
    const inputFieldType = inputElement.type;
    const errorMsg = document.getElementById(inputFieldId + "_error_msg");
    let isErrorMsg;

    // Remove any existing numbers from the input value
    isErrorMsg = validateInputType(inputFieldType, inputFieldId, inputFieldValue);
    showErrorField(inputFieldId, isErrorMsg);
    errorMsg.textContent = isErrorMsg;
}
function showErrorField(inputFieldId, isErrorMsg) {
    if (isErrorMsg) {
        $("#" + inputFieldId).focus();
        $("#" + inputFieldId).removeClass("success-msg-field");
        $("#" + inputFieldId).addClass("error-msg-field");
        setTimeout(() => {
            $("#" + inputFieldId).removeClass("error-msg-field");
        }, 5000);
    } else {
        $("#" + inputFieldId).removeClass("error-msg-field");
        $("#" + inputFieldId).addClass("success-msg-field");
        setTimeout(() => {
            $("#" + inputFieldId).removeClass("success-msg-field");
        }, 5000);
    }
}

function displayUploadedFile(fileType, responseId, url, storage_key='') {
    let tempTrimStr, tempStrExt;
    if (!url || url.length < 22) {
        popUpMsg("Failed to upload File!", "", "error");
        return false;
    }
    tempTrimStr = url.slice(22);
    
    if (tempTrimStr.length > 22) {
        tempTrimStr = tempTrimStr.substr(0, 15);
        tempStrExt = url.slice(-4);
        tempTrimStr = tempTrimStr + tempStrExt;
    }
    if (responseId == "file_approved_app_result") {
        tempTrimStr = url.slice(34);
    }

    if (fileType == "img") {
        $("#img_" + responseId).removeClass("d-none");
        if (storage_key=="adminPage") {
            $("#img_" + responseId).attr("src", '../'+url);
        } else {
            $("#img_" + responseId).attr("src", url);
        }
        $("#hide_center_container").addClass("d-none");
        $("#" + responseId + "_field .image_container").addClass("width");

    } else if (fileType == "docs") {
        $("#view_" + responseId).removeClass("d-none");
        if (responseId =="file_approved_app_result") {
            $("#view_" + responseId).attr("href", '../'+url);
        } else {
            $("#view_" + responseId).attr("href", url);
        }
        $("#view_" + responseId + ">span").text(tempTrimStr);
    }
    $("#remove_" + responseId).removeClass("d-none");
}
function removeUploadedFile(fileType, responseId, localStorageKey) {
    // DF, PDF, RegF
    $("#" + responseId).val("");
    if (fileType == 'docs') {
        $("#view_" + responseId).attr("href", '');
        $("#view_" + responseId).addClass("d-none");

    } else if (fileType == 'img') {
        $("#img_" + responseId).attr("src", '');
        $("#img_" + responseId).addClass("d-none");
        $("#hide_center_container").removeClass("d-none");
        $("#" + responseId + "_field .image_container").removeClass("width");
    }
    $("#remove_" + responseId).addClass("d-none");

    if (localStorageKey) {
        saveData[responseId] = '';
        localStorage.setItem(localStorageKey, JSON.stringify(saveData));
    }
    if (localStorageKey =="adminSchemeData") {
        $("#file_approved_app_result_value").val("");
    }
}

// uploadFile({
//     'file_type' : 'docs',
//     'response_id' : 'file_time_schedule',
//     'file_id' : fileInputTimeSchedule,
//     'file_data': fileData,
//     'storage_key': 'majorResearchProjectData',
//     'max_file_upload_size': 2,
//     'file_upload_formats' : ['pdf', 'doc', 'docx', 'xls', 'xlsx'],
// });
function uploadFile(data) {
    // DF, PDF, RegF
    let file_upload_size = 0, file_upload_formats = '';
    if (data.max_file_upload_size) {
        file_upload_size = data.max_file_upload_size;
    }
    if (data.file_upload_formats) {
        file_upload_formats = data.file_upload_formats;
    } else {
        file_upload_formats = ['pdf'];
    }
    if (validateFile(data.file_id, data.file_type, file_upload_size, file_upload_formats)) {
        isFileUploaded = 0;
        
        document.querySelectorAll('button').forEach(button => {
            button.disabled = true;
        });

        showProgressBarOnFileUpload(data.file_type, data.response_id, data.storage_key);

        window.setTimeout(function () {
            let adminApiCall = '';
            if (data.storage_key=='adminSchemeData' || data.storage_key=='adminPage' ) {
                adminApiCall = '../';
            }
            $.ajax({
                type: "POST",
                url: adminApiCall+"api/uploadFileApi.php",
                data: JSON.stringify(data.file_data),
                contentType: false,
                processData: false,
                cache: false,
                async: true,
                success: function (response) {
                    // console.log(response);
                    var responseData = JSON.parse(response);
                    if (responseData.flag && responseData.status == '200') {
                        isFileUploaded = 1;
                        saveData[data.response_id] = responseData.data;
                        localStorage.setItem(data.storage_key, JSON.stringify(saveData));
                        if (data.storage_key == 'adminSchemeData' || data.storage_key == 'adminPage') {
                            $("#file_approved_app_result_value").val(responseData.data);
                        } else {
                            $('#submit_app_btn').prop('disabled', false);
                        }
                    } else {
                        isFileUploaded = 2;
                        popUpMsg(responseData.message);
                    }
                },
            });
        }, 2000);

    }
}
// callApi({
//     method: 'GET',
//     url: '',
//     data: '',
//     form_type: '',
//     is_loader: '', //within_the_page
// });
function callApi(dataArr) {
    // console.log(dataArr);
    if (dataArr.is_loader && dataArr.is_loader == 'within_the_page') { } else {
        AmagiLoader.show();
    }

    if (dataArr.method=="GET") {
        $.ajax({
            type: dataArr.method,
            url: dataArr.url,
            success: function (res) {
                var responseData = JSON.parse(res);
                if (dataArr.form_type == "verify-submission") {
                    getSchemeResponse(responseData);
                } else if (dataArr.form_type == "fetch-visitors") {
                    getApiResponseVisitors(responseData, dataArr.form_type);
                } else {
                    getApiResponse(responseData, dataArr.form_type);
                }

                if (dataArr.is_loader && dataArr.is_loader == 'within_the_page') { } else {
                    AmagiLoader.hide();
                }
            },
        });
    } else if (dataArr.method == "POST") {
        $.ajax({
            type: dataArr.method,
            url: dataArr.url,
            data: JSON.stringify(dataArr.data),
            success: function (res) {
                var responseData = JSON.parse(res);
                // console.log(responseData);
                
                // login, submit-Doc, reverification
                if (dataArr.form_type == "login" || dataArr.form_type == "submit-Doc" || dataArr.form_type == "reverification") {
                    if (responseData.flag && responseData.status == '200') {
                        if (dataArr.form_type == "login") {
                            window.location.href = 'index.php';
                        } else if (dataArr.form_type == "submit-Doc") {
                            popUpMsg(responseData.message, "", "success");
                        } else if (dataArr.form_type == "reverification") {
                            popUpMsg(responseData.message, "", "success");
                            window.location.href = "account-verification.php";
                        }
                    } else {
                        if (dataArr.form_type == "login") {
                            popUpMsg(responseData.message, "", "warning");
                            // user is not verified
                            if (responseData.status == 201) {
                                popUpAlertEmailReVerification(dataArr.data['username']);
                            }
                        } else if (dataArr.form_type == "reverification") {
                            popUpMsg(responseData.message, "", "warning");
                        } 
                    }
                } else if (dataArr.form_type == "update-visitors") {
                    getApiResponseVisitors(responseData, dataArr.form_type);
                } else {
                    getApiResponse(responseData, dataArr.form_type);
                }
                
                if (dataArr.is_loader && dataArr.is_loader == 'within_the_page') {
                } else {
                    AmagiLoader.hide();
                }
            }
        }); 
    } else if (dataArr.method == "DELETE") {
        $.ajax({
            type: dataArr.method,
            url: dataArr.url,
            success: function (res) {
                var responseData = JSON.parse(res);
                
                getApiResponse(responseData, dataArr.form_type);
            },
        });
    }
}

// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// User Validation (is Form submitted) for Applying scheme, APPLY BUTTON Control
function isUserApplicableForScheme(value, type = 'form') {
    if (userData) {
        if (type == 'doc') {
            // direct file submission && (value == "DF" || value == "MIN" || value == "RSG")
            let apiUrl = 'api/';
            switch (value) {
                case "DF": apiUrl += 'schemeDoctoralFellowshipApi.php'; break;
                case "MIN": apiUrl += 'schemeMinorResearchProjectApi.php'; break;
                case "RSG": apiUrl += 'schemeResearchStartupGrantApi.php'; break;
                case "PDF": apiUrl += 'schemePostDoctoralFellowshipApi.php'; break;
                case "MAJ": apiUrl += 'schemeMajorResearchProjectApi.php'; break;
                case "SS": apiUrl += 'schemeSummerSchoolApi.php'; break;
                case "IRIS": apiUrl += 'schemeIrisApi.php'; break;
                default: apiUrl += ''; break;
            }
            callApi({
                method: 'GET',
                url: apiUrl + '?id=' + userId + '&schemeBatchId=' + schemeBatchId +'&type=verify-submission',
                form_type: 'verify-submission',
            });
        } else if (type == 'form' ) { 
        // value == "PDF" || value == "MAJ" || value == "SS"
            // form submission
            applyForTheScheme(value);
        }
    } else {
        popUpAlertLogin();
    }
}
function getSchemeResponse(data) {
    let showModalId = '';
    if (data.status==200) {
        showModalId = 'uploadFormResponseModal';
    } else {
        showModalId = 'uploadFormApplicationModal';
    }
    const formApplicationModal = new bootstrap.Modal(document.getElementById(showModalId));
    formApplicationModal.show();
}
function applyForTheScheme(type) {
    let urlTo = '';
    $.ajax({
        type: "GET",
        url: "api/userApi.php?userId=" + userId + '&schemeBatchId=' + schemeBatchId + "&type=" + type,
        contentType: false,
        processData: false,
        cache: false,
        async: true,
        success: function (response) {
            // console.log(response);
            var responseData = JSON.parse(response);
            if (responseData.flag && responseData.status == '200') {
                // if the user have submitted the form show the filled form
                switch (type) {
                    case 'DF': urlTo = 'preview-doctoral-fellowship.php'; break;
                    case 'PDF': urlTo = 'preview-post-doctoral-fellowship.php'; break;
                    case 'MIN': urlTo = 'preview-minor-research-project.php'; break;
                    case 'MAJ': urlTo = 'preview-major-research-project.php'; break;
                    case 'RSG': urlTo = 'preview-research-startup-grant.php'; break;
                    case 'SS': urlTo = 'preview-summer-school-scheme.php'; break;
                    default: urlTo = 'to-be-updated.php?vkflgf=scm'; break;
                }
            } else {
                // new application request form
                switch (type) {
                    case 'DF': urlTo = 'apply-for-doctoral-fellowship.php'; break;
                    case 'PDF': urlTo = 'apply-for-post-doctoral-fellowship.php'; break;
                    case 'MIN': urlTo = 'apply-for-minor-research-project.php'; break;
                    case 'MAJ': urlTo = 'apply-for-major-research-project.php'; break;
                    case 'RSG': urlTo = 'apply-for-research-startup-grant.php'; break;
                    case 'SS': urlTo = 'apply-for-summer-school.php'; break;
                    default: urlTo = 'to-be-updated.php?vkflgf=scm'; break;
                }
            }
            if (pageName() == urlTo) {
                // console.log('same page'); // do nothing
            } else {
                window.location.href = urlTo;
            }
        },
        error: function (xhr, status, error) {
            // handle error
            // console.log('error--- here');
            // console.log(status);
            // console.log(error);
        }
    });
}
// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------

function escapeHtml(unsafe) {
    return unsafe.replace(/[&<"']/g, function (m) {
        switch (m) {
            case '&':
                return '&amp;';
            case '<':
                return '&lt;';
            case '"':
                return '&quot;';
            case "'":
                return '&#39;';
        }
    }).replace(/\n/g, '<br>').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;'); // Handle newline and tab
}
// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// Customs ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
