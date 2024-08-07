// admin, scheme_admin, reviewer
const scoreInput = document.getElementById('decimalInput');
scoreInput.addEventListener('input', function () {
    let inputValue = scoreInput.value;

    // Remove non-numeric and non-decimal point characters
    inputValue = inputValue.replace(/[^0-9.]/g, '');

    // Ensure that the value is not less than 0.1
    if (parseFloat(inputValue) < 0.1) {
        inputValue = '0.10';
    }

    // Ensure that the value is not greater than 10.0
    if (parseFloat(inputValue) > 10.0) {
        inputValue = '10.00';
    }

    // Reconstruct the input value
    scoreInput.value = inputValue;
});


function validateInputField(inputElement, min_words, max_words) {
    const inputFieldId = inputElement.id;
    const inputFieldValue = inputElement.value;
    const inputFieldType = inputElement.type;
    const errorMsg = document.getElementById(inputFieldId + "_error_msg");

    let trimInputFieldId = inputFieldId.slice(0, -2);
    let msg = '';
    let minWordLimit = min_words;
    let maxWordLimit = max_words;
    var words = 0;

    // Regular expression to match words with letters, numbers, "/", and "-"
    var regexWordSpaceSlashHyphen = /[a-zA-Z0-9]+/g;
    if ((inputFieldValue.match(regexWordSpaceSlashHyphen)) != null) {
        words = inputFieldValue.match(regexWordSpaceSlashHyphen).length;
    }

    if (/[<>]/.test(inputFieldValue)) {
        msg = 'Invalid characters or content detected, not allowed <,>';
    } else if (words < minWordLimit) {
        msg = `Your input seems a bit short. Please provide more details or information.`;
    } else if (words >= maxWordLimit) {
        msg = `Your input has reached the maximum word limit. Please review and ensure it captures your key points effectively.`;
        $("#" + inputFieldId).val(inputFieldValue.match(regexWordSpaceSlashHyphen).slice(0, maxWordLimit).join(' '));
    } else {
        msg = '';
    }

    if (msg) {
        // if (words >= maxWordLimit) {
        //   $("#" + inputFieldId).addClass("info-msg-field");
        //   $("#" + inputFieldId + "_error_msg").text(msg);
        //   $("#" + inputFieldId + "_error_msg").addClass("info-msg");
        // } else {
        $("#" + inputFieldId).addClass("error-msg-field");
        $("#" + inputFieldId + "_error_msg").text(msg);  // words left
        // }
    } else {
        if (words >= maxWordLimit) {
            setTimeout(() => {
                $("#" + inputFieldId).removeClass("error-msg-field");
                $("#" + inputFieldId + "_error_msg").text(msg);  // words left
                // $("#" + inputFieldId + "_error_msg").removeClass("info-msg");
            }, 5000);
        } else {
            $("#" + inputFieldId).removeClass("error-msg-field");
            $("#" + inputFieldId + "_error_msg").text(msg);  // words left
        }
    }
    return true;
}

function validateForm() {
    if ($(".error-msg-field").length == 0) {
        // popUpAlertMsg({
        //   'title' :  "Kindly Confirm !",
        //   'msg' :  "Before submitting your review. Once submitted, it cannot be changed.",
        // })

        // check for 0 values in Range Slider
        if (checkRangeValues() == true) {
            if (confirm("Kindly Confirm! Before submitting your review. Once submitted, it cannot be changed.")) {
                return true;
            }
        }
        return false;
    } else {
        popUpMsg("Please check error message for the Input value!! ");
        return false;
    }
}
