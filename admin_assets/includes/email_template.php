
<?php
$email_template_head_before_title = "
    <!DOCTYPE html>
    <html lang='en' xmlns:o='urn:schemas-microsoft-com:office:office'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta name='x-apple-disable-message-reformatting'>";
$email_template_head_title = "<title>GSRF</title>";
$email_template_head_after_title = "
            <!--[if mso]>
            <noscript>
            <xml>
                <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
            </xml>
            </noscript>
            <![endif]-->
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1,h2 {
                    color: #333;
                }
                p {
                    line-height: 1.6;
                    color: #666;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007BFF;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 5px;
                }
                *,h1,h2,li {
                    font-size: 14px !important;
                }
            </style>
        </head>
        <body>
            <div class='container'>";
$email_template_body = "";
$email_template_footer = " 
            </div>
        </body>
    </html>";



// email content
$email_body_footer = "
<p>Warm Regards,</p>
<p>The GOA STATE RESEARCH FOUNDATION Team</p>
    ";
    // <div style="display: flex;">
    //     <img src="'.$logoUrl.'" alt="'.$logoAlt.'" style="width: 70px;">
    // </div>


// url - require_once '../admin_assets/includes/email_template.php';

// Used in places with
// require_once '../admin_assets/api/schemeApplicationStatusApiData.php';
// require '../admin_assets/add_reviewer.php';

// email template for sending user response
    // $subject = $email_subject;
    // $content = $email_template_head_before_title;
    // $content .= "<title>".$subject."</title>";
    // $content .= $email_template_head_after_title;
    // $content .= $email_content;
    // $content .= $email_body_footer;
    // $content .= $email_template_footer;
?>