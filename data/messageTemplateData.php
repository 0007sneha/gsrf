<?php
$scheme_names = [
    'GSRF Doctoral Research Fellowship Scheme',
    'GSRF Major Research Grant Scheme',
    'GSRF Minor Research Grant Scheme',
    'GSRF Post-Doctoral Fellowship Scheme',
    'GSRF Research Start-Up Grant',
    'GSRF Summer/Winter School Scheme',
];

$messages = [
    array(
        'Status' => 'Approved',
        'template' => "Congratulations! Your application for the $scheme_name has been approved. Please check your email for further instructions and next steps. Best of luck with your research!",
        'msg' => "Congratulations! Your application for the $scheme_name has been approved. Please check your email for further instructions.!",
    ),
    array(
        'Status' => 'Pending Review',
        'template' => "Thank you for your application for the $scheme_name. Your application is currently under review. We will notify you once a decision is made. Stay tuned!",
        'msg' => "Your application for the $scheme_name is currently under review. We will notify you once a decision is made. Stay tuned!",
    ),
    array(
        'Status' => 'Rejected',
        'template' => "We regret to inform you that your application for the $scheme_name has been rejected. We appreciate your effort and encourage you to apply again in the future. Keep pursuing your research goals!",
        'msg' => "We regret to inform you that your application for the $scheme_name has been rejected.",
    ),
    array(
        'Status' => 'Additional Information Required',
        'template' => "Your application for the $scheme_name is almost complete. We require some additional information to process your application. Please check your email for a request from us.",
        'msg' => "Your application for the $scheme_name is almost complete. We require some additional information to process your application. Please check your email for a request from us.",
    ),
    array(
        'Status' => 'Interview Scheduled',
        'template' => "Great news! You've been selected for an interview for the $scheme_name. Please check your email for the interview details and prepare accordingly.",
        'msg' => "Great news! You've been selected for an interview for the $scheme_name. Please check your email for the interview details and prepare accordingly.",
    ),
    array(
        'Status' => 'Final Decision Pending',
        'template' => "Your application for the $scheme_name is in the final stages of evaluation. We will notify you of the decision soon. Keep your fingers crossed!",
        'msg' => "Your application for the $scheme_name is in the final stages of evaluation. We will notify you of the decision soon. Keep your fingers crossed!",
    ),
    array(
        'Status' => 'Deadline Extended',
        'template' => "Good news! The deadline for the $scheme_name has been extended. You now have more time to submit or update your application. Don't miss this opportunity!",
        'msg' => "Good news! The deadline for the $scheme_name has been extended. You now have more time to submit or update your application. Don't miss this opportunity!",
    ),
    array(
        'Status' => 'Thank You for Applying',
        'template' => "We appreciate your application for the $scheme_name. We'll be in touch with updates soon. In the meantime, keep up the good work with your research!",
        'msg' => "We appreciate your application for the $scheme_name. We'll be in touch with updates soon. In the meantime, keep up the good work with your research!",
    ),
    array(
        'Status' => 'Check the Application Status',
        'template' => "To check the status of your $scheme_name application, please visit our website and log in to your applicant portal. We'll keep you informed!",
        'msg' => "To check the status of your $scheme_name application, please visit our website and log in to your applicant portal. We'll keep you informed!",
    ),
    array(
        'Status' => 'Stay Connected',
        'template' => "Stay connected with us on our social media channels for updates, tips, and opportunities. Your journey in research and education matters to us. #ResearchOpportunities",
        'msg' => "Stay connected with us on our social media channels for updates, tips, and opportunities. Your journey in research and education matters to us. #ResearchOpportunities",
    ),
];

?>