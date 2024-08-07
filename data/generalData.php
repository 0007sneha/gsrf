<?php 
// include "data/generalData.php";

$genderArr = [
    array('id' => '', 'name' => 'Select Gender'),
    array('id' => 'male', 'name' => 'Male'),
    array('id' => 'female', 'name' => 'Female'),
    array('id' => 'other', 'name' => 'Other'),
];

// category== 0 || 2 then no need for  uploading File
$categoriesArr = [
    array('id' => 0, 'name' => 'Select Category'),
    array('id' => 1, 'name' => 'EWS'),
    array('id' => 2, 'name' => 'General'),
    array('id' => 3, 'name' => 'OBC'),
    array('id' => 4, 'name' => 'SC'),
    array('id' => 5, 'name' => 'ST'),
];

$countryCodeArr = [
    array('id' => 1, 'name' => '+91'),
    array('id' => 2, 'name' => '+92'),
    array('id' => 3, 'name' => '+27'),
    array('id' => 4, 'name' => '+971'),
];

$targetAudienceArr = [
    array('id' => 1, 'name' => 'School students'),
    array('id' => 2, 'name' => 'School teachers'),
    array('id' => 3, 'name' => 'UG students'),
];

$feedbackStatusArr = [
    array('id' => '', 'name' => 'All Records'),
    array('id' => 1, 'name' => 'Reviewed'),
    array('id' => 0, 'name' => 'In-Review'),
];

$feedbackAppStatusArr = [
    array('id' => '', 'name' => 'All Records'),
    array('id' => 0, 'name' => 'In-Review'),
    array('id' => 1, 'name' => 'Reviewed'),
    array('id' => 2, 'name' => 'REJECTED'),
    array('id' => 3, 'name' => 'ACCEPTED'),
];

$reviewerPrefixArr = [
    array('id' => '', 'name' => 'Select Prefix'),
    array('id' => 'Prof.', 'name' => 'Prof.'),
    array('id' => 'Dr.', 'name' => 'Dr.'),
];

$batchStatusArr = [
    array('id' => '', 'name' => 'Select Status'),
    array('id' => 'open', 'name' => 'Open'),
    array('id' => 'close', 'name' => 'Close'),
    array('id' => 'pending', 'name' => 'Pending(Await)'), // will be opening soon
    array('id' => 'result', 'name' => 'Show Results'),
];

$appTypeArr = [
    array('id' => '', 'name' => 'Select App Type'),
    array('id' => 'form', 'name' => 'Fill App Form'),
    array('id' => 'doc', 'name' => 'Upload PDF File'),
];

$eventStatusArr = [
    // array('id' => '', 'name' => 'Select Event Status'),
    array('id' => 'completed', 'name' => 'Completed'),
    array('id' => 'upcoming', 'name' => 'Upcoming'),
];

$email_types = [
    array( 'id' => '', 'name' => 'Select Type'),
    array( 'id' => 1, 'name' => 'OTP'),
    array( 'id' => 2, 'name' => 'Registration'),
    array( 'id' => 3, 'name' => 'Confirmation'),
    array( 'id' => 4, 'name' => 'Scheme Admin Account Creation'),
    array( 'id' => 5, 'name' => 'Scheme Admin Password Update'),
    array( 'id' => 6, 'name' => 'Reviewer Account has been Created'),
    array( 'id' => 7, 'name' => 'Reviewer Password Update'),
    array( 'id' => 11, 'name' => 'Reassignment of Application to Reviewer'),
    array( 'id' => 12, 'name' => 'Revoking Assigned Application'),
    array( 'id' => 9, 'name' => 'Extending/Re-assign Task Due Date'),
    array( 'id' => 8, 'name' => 'Request to review the GSRF Scheme Application'), //assign reviewer //assign-reviewer-submit
    array( 'id' => 10, 'name' => 'Reminder: Application Review Task'), //email-reminder
    array( 'id' => 13, 'name' => 'Accepted Applications Send Email Update'), //Application Status Update
    array( 'id' => 14, 'name' => 'Rejected Applications Send Email Update'), //Application Status Update
    array( 'id' => 15, 'name' => 'Candidate Notification'), //Scheme Update Notification
    array( 'id' => 16, 'name' => 'Acknowledgment of Task Decline'),
    array( 'id' => 17, 'name' => 'Thank you Email for Scheme Application'),
    // array( 'id' => 18, 'name' => ''),
];

?>