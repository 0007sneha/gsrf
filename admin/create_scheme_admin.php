<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../config/send_email.php';
require_once '../config/be_function.php';
require_once '../admin_assets/includes/email_template.php';

$admin_type = '';
if (isset($_SESSION['admin_type'])) {
	$admin_type = $_SESSION['admin_type'];
}

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$schemes = $db->get("scheme_types");

$action = $_GET['action'] ?? 'create';
$id = $_GET['id'] ?? null;
$updateData = null;

function getData($key)
{
  global $updateData;
  return $updateData != null ? $updateData[$key] : null;
}

function isSchemeApplicable($scheme)
{
  global $updateData;
  if ($updateData == null) return false;
  $applicableSchemes = json_decode(getData("applicable_schemes"));
  return in_array($scheme, $applicableSchemes);
}


if ($action == "update" && $id != null) {
  $updateData = $db->where('id', $id)->getOne('scheme_admin_accounts');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data_to_store = filter_input_array(INPUT_POST);
  $password = generatePassword();
  $updateId = $data_to_store['update-id'] ?? null; 
  $data_to_store['password'] = password_hash($password, PASSWORD_DEFAULT);
  $data_to_store['applicable_schemes'] = json_encode($data_to_store['applicable_schemes']);

  $db = getDbInstance();
  unset($data_to_store['update-id']);
  unset($data_to_store['change_password']);
  // print_r($data_to_store);

  if ($updateId == null) {
    $db->where('email', $data_to_store['email']);
    $db->get('scheme_admin_accounts');
    if ($db->count >= 1) {
      $_SESSION['failure'] = "Email already exists";
      header('location: create_scheme_admin.php');
      exit();
    }

    $db = getDbInstance();
    $last_id = $db->insert('scheme_admin_accounts', $data_to_store);

    $db = getDbInstance();
    $data_to_users = [
        'user_id' => $last_id,
        'type' => 'Scheme Admin',
        'name' => $password,
        'description' => 'created',
    ];
    $db->insert('users_to_user', $data_to_users);
    
    $user_name = $data_to_store['name'];
    $user_email = $data_to_store['email'];

    $db = getDbInstance();
    $db->where("type", 4);
    $db->where("status", 1);
    $email = $db->getOne("emails", "subject, content");
    // set email variables to replace
    $placeholders = array('$user_name', '$user_email', '$password');
    $values = array($user_name, $user_email, $password);
    
    $_SESSION['success'] = "Scheme Admin added successfully!";
    // $subject = "Welcome! Your Account has been Created as a Scheme Admin";
    $subject = $email['subject'];
    $content = $email_template_head_before_title;
    $content .= "<title>".$subject."</title>";
    $content .= $email_template_head_after_title;
    // $content .= '
      //             <h1>Welcome! Your Account has been Created</h1>
      //             <p>Dear '.$user_name.',</p>
      //             <p>We are delighted to inform you that your account has been successfully created, and you have been assigned the role of a Scheme Admin.</p>

      //             <h2>Your Credentials:</h2>
      //             <ol>
      //                 <li><strong>User Id:</strong> '.$user_email.'</li>
      //                 <li><strong>Password:</strong> '. $password.'</li>
      //             </ol>

      //             <h2>Your Role as a Scheme Admin:</h2>
      //             <p>As a Scheme Admin, you play a critical role in our organization. Your responsibilities include:</p>
      //             <ul>
      //                 <li>Adding and managing reviewers on the portal.</li>
      //                 <li>Assigning tasks to reviewers for reviewing candidates\' applications.</li>
      //                 <li>Analyzing the responses and feedback from reviewers.</li>
      //             </ul>

      //             <h2>Getting Started:</h2>
      //             <p>To begin your role as a Scheme Admin, please follow these steps:</p>
      //             <ol>
      //                 <li><strong>Login:</strong> Use the provided login credentials to access the admin portal.</li>
      //                 <li><strong>Add Reviewers:</strong> Navigate to the "Manage Reviewers" section to add reviewers to the system.</li>
      //                 <li><strong>Assign Tasks:</strong> In the "Task Assignment" section, assign tasks to reviewers for candidate application reviews.</li>
      //                 <li><strong>Review Feedback:</strong> Monitor the feedback and analysis provided by reviewers and take necessary actions.</li>
      //             </ol>

      //             <p>If you have any questions or require assistance, please don\'t hesitate to reach out to our support team at office.gsrf@gmail.com. We are here to support you in your role as a Scheme Admin.</p>

      //             <p>Thank you for being a part of our organization, and we look forward to your contributions in improving our processes and services.</p>
      //             ';
    // $content .= $email_body_footer;
    $content .= str_replace($placeholders, $values, $email['content']);
    $content .= $email_template_footer;
    $response = smtp_mailer($data_to_store['email'], $subject, $content);
    if ($response) {
        $log_data = [
            'log_type' => 'Account',
            'sender_id' => cuid(),
            'sent_by' => $admin_type,
            'application_no' => '',
            'title' => 'Scheme Admin account created for '.$data_to_store['name'],
            'receiver' => 'Scheme Admin',
            'sent_from' => '',
            'sent_to' => $data_to_store['email'],
            'subject' => $subject,
            'message' => contentFromHtmlBody($content),
        ];
        $db = getDbInstance();
        $save_conversation = $db->insert('communication_log', $log_data);
        header('location: create_scheme_admin.php');
        exit();
    }
  } else {
    if(!$_POST['change_password']){
        unset($data_to_store['password']);
    }
    $last_id = $db->where('id', $updateId)->update('scheme_admin_accounts', $data_to_store);
    
    $db = getDbInstance();
    $db->where('user_id', $updateId)
        ->where('type', 'Scheme Admin')
        ->update('users_to_user', ['name'=>$password, 'description' => 'updated']);
    
    if($_POST['change_password']){
      $user_name = $data_to_store['name'];
      $user_email = $data_to_store['email'];

      $db = getDbInstance();
      $db->where("type", 5);
      $db->where("status", 1);
      $email = $db->getOne("emails", "subject, content");
      // set email variables to replace
      $placeholders = array('$user_name', '$user_email', '$password');
      $values = array($user_name, $user_email, $password);
      
      // $subject = "Your Account Details Have Been Updated";
      $subject = $email['subject'];
      $content = $email_template_head_before_title;
      $content .= "<title>".$subject."</title>";
      $content .= $email_template_head_after_title;
      // $content .= '
        //             <p>Dear '.$user_name.',</p>

        //             <p>I hope this message finds you well. This is to confirm that your password has been successfully updated as per your recent request. Your account security is our top priority, and we appreciate your proactive approach to managing your login credentials.</p>

        //             <h2>Your Updated Login Credentials:</h2>
        //             <ol>
        //                 <li><strong>User Id:</strong> '.$user_email.'</li>
        //                 <li><strong>New Password:</strong> '.$password.'</li>
        //             </ol>

        //             <p>Please ensure to keep your login credentials secure. If you did not request these changes or have any concerns, please contact our support team at office.gsrf@gmail.com immediately.</p>

        //             <p>Thank you for being a valued member of our organization.</p>
        //         ';
      // $content .= $email_body_footer;
      $content .= str_replace($placeholders, $values, $email['content']);
      $content .= $email_template_footer;
      $response = smtp_mailer($data_to_store['email'], $subject, $content);
      if ($response) {
          $log_data = [
              'log_type' => 'Account',
              'sender_id' => cuid(),
              'sent_by' => $admin_type,
              'application_no' => '',
              'title' => 'Account details updated for the Scheme Admin, '.$data_to_store['name'],
              'receiver' => 'Scheme Admin',
              'sent_from' => '',
              'sent_to' => $data_to_store['email'],
              'subject' => $subject,
              'message' => contentFromHtmlBody($content),
          ];
          $db = getDbInstance();
          $save_conversation = $db->insert('communication_log', $log_data);
        }
    }
    $_SESSION['success'] = "Scheme Admin Updated successfully!";
    header('location: list_scheme_admin.php');
    exit();
  } 
}
include_once('includes/header.php');
?>

<div class="pagetitle">
  <h1>Scheme Admins</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Scheme Admins</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $action == "update" ? 'Update' : 'Create' ?> Scheme Admin</h5>

        <!-- General Form Elements -->
        <form action="create_scheme_admin.php" method="POST">
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" value="<?php echo getData("name") ?>" required>
              <input type="text" name="update-id" class="form-control" value="<?php echo getData("id") ?>" hidden>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" value="<?php echo getData("email") ?>" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="applicableSchemes" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <p>Hold down the Ctrl (windows) / Command (Mac) button to select applicable schemes:</p>
              <select multiple class="form-select" id="applicableSchemes" name="applicable_schemes[]" required>
                <?php
                foreach ($schemes as $scheme) :
                ?>
                  <option <?php echo isSchemeApplicable($scheme['code']) == 1 ? 'selected' : '' ?> value="<?php echo $scheme['code'] ?>"><?php echo $scheme['name'] . isSchemeApplicable($scheme['code'])   ?></option>
                <?php
                endforeach;
                ?>
              </select>
              <ul id="selected-options" class="mt-4">
              </ul>
            </div>
          </div>

          <?php if ($action == 'update') : ?>
            <div class="row mb-3">
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" name="change_password" type="checkbox" id="gridCheck1">
                  <label class="form-check-label" for="gridCheck1">
                    Change Password
                  </label>
                </div>
              </div>
            </div>
          <?php endif;?>

          <?php
          include('./includes/flash_messages.php');
          ?>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-4 d-flex">
              <button type="submit" class="btn btn-primary px-5"><?php echo $action == "update" ? 'Update' : 'Save' ?> </button>
              <button onclick="location.href='list_scheme_admin.php'; return false;" class="btn btn-light px-5 mx-2" >Back</button>
            </div>
          </div>
        </form><!-- End General Form Elements -->

      </div>
    </div>
  </div>
</div>

<?php include_once('includes/footer.php'); ?>