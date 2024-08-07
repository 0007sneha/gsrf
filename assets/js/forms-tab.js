
const tabs = document.querySelectorAll('.tab'); // Get the elements
const tabsContent = document.querySelectorAll(".tabcontent");

// Add click event listeners to the tabs ---------------------------------------------------------
tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => {
        if ($('#scheme_id').val()) {
            // Remove active class from all tabs
            tabs.forEach(tab => tab.classList.remove('active'));
            tabsContent.forEach(tabContent => tabContent.classList.remove('d-block'));
            tabsContent.forEach(tabContent => tabContent.classList.add('d-none'));
            // Add active class to the clicked tab
            tab.classList.add('active');
            $("#form_" + index + "").removeClass('d-none');
            $("#form_" + index + "").addClass('d-block');
        } else {
            popUpMsg("Please Save Record first, Before moving to next Step!");
        }
    });
});

// type = 1 then moving next form || 0 then moving prev form 
function openNextForm(type, nextFormNo) {
    let currentFormNo = nextFormNo + 1;
    let isNextForm = isDataSaved = true;
    $("#tab_" + currentFormNo + "").removeClass('visited');
    if (type) {
        isNextForm = isDataSaved = false;
        currentFormNo = nextFormNo - 1;
        $("#tab_" + currentFormNo + "").addClass('visited');
        isNextForm = validateFormData(currentFormNo);
        if (isNextForm) {
            isDataSaved = validateSavedData(currentFormNo);
        }
    }
    if (isNextForm) {
        // is data saved 
        if (isDataSaved) {
            tabs.forEach(tab => tab.classList.remove('active'));
            tabsContent.forEach(tabContent => tabContent.classList.remove('d-block'));
            tabsContent.forEach(tabContent => tabContent.classList.add('d-none'));

            // Add active class to the clicked tab
            $("#tab_" + nextFormNo + "").addClass('active');
            $("#form_" + currentFormNo + "").addClass('d-none');
            $("#form_" + nextFormNo + "").removeClass('d-none');
            $("#form_" + nextFormNo + "").addClass('d-block');

            $('html, body').animate({ scrollTop: 0 }, 'fast');
        } else {
            popUpMsg("Please save the data first !!");
            console.log("info:10001");
        }
    } else {
        // console.log("Required fields are empty !");
        console.log("info:10002");
    }
}
