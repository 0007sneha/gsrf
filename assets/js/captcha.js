// custom added ------------------------------------------- ------------------------------- ------------------------------------------- ------------------------------- ---------------- ------------------ ------------- ------------------------------ ------------------------------- -------- ----------------------------- --------------------- --------------------
// call files
{/* <script src="assets/js/captcha.js"></script> */}
{/* <script src="https://www.google.com/recaptcha/api.js"></script> */}

// Code
var siteK = '6LcXWRQnAAAAAAPZBb7UhNzE-3BwK4mDURyqZsMj';
var widgetId1;
var widgetId2;
var reCaptchaResponse;
var reCaptchaResponseOnLoad;

var onloadCallback = function() {
    // Renders the HTML element with id 'example1' as a reCAPTCHA widget.
    // The id of the reCAPTCHA widget is assigned to 'widgetId1'.
    // reCaptchaResponseOnLoad = grecaptcha.getResponse(widgetId1);        
    
    widgetId1 = grecaptcha.render('getRecaptcha', {
        'sitekey' : siteK,
        'theme' : 'light',
        'callback' : verifyCallback,
        'error-callback' : function () {
            grecaptcha.render(document.getElementById('getRecaptcha'), {
                'sitekey' : siteK
            });
        }
    });
    
    
};


var verifyCallback = function(response) {
    // console.log(response);
    if (response) {
        reCaptchaResponse = response;
        setTimeout(resetRecaptcha, 60000);
    } else {
        reCaptchaResponse = "";
    }
};
function resetRecaptcha() {
    // Resets reCAPTCHA widgetId2 upon Expiry
    // Resets reCAPTCHA widgetId2 upon Expiry
    grecaptcha.reset(widgetId2);
    reCaptchaResponse = "";
}

// function submit() {
//     if (reCaptchaResponse) {
//         console.log('submited form');
//         console.log(reCaptchaResponse);
//     } else {
//         alert("Please click on ReCaptcha !!");
//     }
// }
