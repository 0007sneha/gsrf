// admin, scheme_admin, reviewer
$("input:radio[name=recommendation]").on("change", function () {
    showCommentBox(this.value);
    document.getElementById('comment_on_recommendation').setAttribute('required', 'true');
});

// feedback form slider function
for (let index = 1; index <= questionsCount; index++) {
    const
        range = document.getElementById('ratings-selection-' + index),
        rangeV = document.getElementById('ratings-selection-value-' + index),
        setValue = () => {
            const
                newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
                newPosition = 10 - (newValue * 0.2);
            rangeV.innerHTML = `<span>${range.value}</span>`;
            rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
        };
    document.addEventListener("DOMContentLoaded", setValue);
    range.addEventListener('input', setValue);
}

function ratingsOnQuestions(e) {
    let ratingsGiven = totalRatingsGiven = outOfRatings = 0,
        maxRating = 10,
        overallScore = 0,
        totalOfMaxRating = maxRating * questionsCount;

    for (let index = 1; index <= questionsCount; index++) {
        ratingsGiven = document.getElementById('ratings-selection-' + index).value;
        totalRatingsGiven += parseFloat(ratingsGiven);
    }
    overallScore = (totalRatingsGiven / totalOfMaxRating) * 10;
    overallScore = Math.round(overallScore * 100) / 100;
    overallScore = overallScore.toFixed(2);

    $("#decimalInput").val(overallScore);
}

function showCommentBox(value) {
    $(".if_recommendation").removeClass("d-none");
    if (value == 1) {
        $("#if_recommendation_yes").removeClass("d-none");
        $("#if_recommendation_no").addClass("d-none");
        $("#if_recommendation_yes_msg").removeClass("d-none");
        $("#if_recommendation_no_msg").addClass("d-none");
    } else {
        $("#if_recommendation_yes").addClass("d-none");
        $("#if_recommendation_no").removeClass("d-none");
        $("#if_recommendation_yes_msg").addClass("d-none");
        $("#if_recommendation_no_msg").removeClass("d-none");
    }
}

function checkRangeValues() {
    if ($("#scheme_type").val() == "MAJ") {
        // Get all range sliders by class name
        var rangeSliders = document.getElementsByClassName('form-range');
        // Flag to check if any range value is zero
        var isZeroValue = true;

        // Iterate through all range sliders
        for (var i = 0; i < rangeSliders.length; i++) {
            // Get the current value of the range
            var currentValue = parseFloat(rangeSliders[i].value);

            // Check if the value is zero
            if (currentValue == 0) {
                isZeroValue = false;
                // You can perform additional actions here if needed
                // console.log('Range value is zero for:', rangeSliders[i].name);
                let qNo = i + 1;
                popUpMsg("Range value is zero for Question No " + qNo);
                return isZeroValue;
            }
        }
        // Return false to prevent form submission if any range value is zero
        return isZeroValue;
    } else {
        return true;
    }
}

