<?php
session_start();
require_once './config/config.php';
$token = bin2hex(openssl_random_pseudo_bytes(16));

// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['scheme_admin_logged_in']) && $_SESSION['scheme_admin_logged_in'] === TRUE) {
  header('Location:index.php');
}

// If user has previously selected "remember me option": 
if (isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token'])) {
  // Get user credentials from cookies.
  $series_id = filter_var($_COOKIE['series_id']);
  $remember_token = filter_var($_COOKIE['remember_token']);
  $db = getDbInstance();
  // Get user By series ID: 
  $db->where('series_id', $series_id);
  $row = $db->getOne('admin_accounts');

  if ($db->count >= 1) {
    // User found. verify remember token
    if (password_verify($remember_token, $row['remember_token'])) {
      // Verify if expiry time is modified. 
      $expires = strtotime($row['expires']);

      if (strtotime(date()) > $expires) {
        // Remember Cookie has expired. 
        clearAuthCookie();
        header('Location:login.php');
        exit;
      }

      $_SESSION['scheme_admin_logged_in'] = TRUE;
      $_SESSION['admin_type'] = $row['admin_type'];
      header('Location:index.php');
      exit;
    } else {
      clearAuthCookie();
      header('Location:login.php');
      exit;
    }
  } else {
    clearAuthCookie();
    header('Location:login.php');
    exit;
  }
}
include BASE_PATH . '/includes/header.php';
?>
<main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="card mb-3 py-3">
              <div class="card-body px-4">
                <div class="pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Scheme Admin Login</h5>
                </div>

                <form class="row g-3 needs-validation" novalidate="" method="POST" action="authenticate.php">
                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="email" class="form-control" id="yourUsername" required="">
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="passwd" class="form-control" id="yourPassword" required="">
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>
                  <?php
                  include('./includes/flash_messages.php')
                  ?>
                  <br>
                  <div class="col-6">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>
                  <div class="col-6">
                    <button class="btn btn-light w-100" onclick="location.href='../admin'; return false">Back</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include BASE_PATH . '/includes/footer.php'; ?>