<?php
// url for the page -> require '../admin_assets/dashboard.php';

// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';
// $isStatusCount = true;
// include('../admin_assets/api/schemeStatusCountApiData.php');
// include_once('includes/header.php');
?>
    <div class="pagetitle">
      <div class="d-md-flex align-items-center justify-content-between">
        <h1>Dashboard</h1>
        <div class="col-md-auto">
          <select id="years" onchange="getYearlyData('index', this.value)" class="form-control">
            <option disabled value="">Select Financial Year </option>
            <option value="2022">2022</option>
          </select>
        </div>
      </div>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo 'index.php?yearlydata='.$selectedYear; ?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="row">
      <?php if(isSchemeApplicable("DF")):?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-4">
              <h2 class="text-primary">Doctoral Fellowship Applications</h2>
              <div class="d-flex application_status justify-content-between">
                <div class="col text-center py-3">
                  <h5 class="text-dark">Unassigned </h5>
                  <h2 class="text-info"> <?php echo printDataIfArrayExist($status_for_phd_applications, 'unassigned') ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Pending </h5>
                  <h2 class="text-warning"> <?php echo printDataIfArrayExist($status_for_phd_applications, [0,1]) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Rejected </h5>
                  <h2 class="text-danger"> <?php echo printDataIfArrayExist($status_for_phd_applications, 2) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Accepted </h5>
                  <h2 class="text-success"> <?php echo printDataIfArrayExist($status_for_phd_applications, 3) ?> </h2>
                </div>
              </div>
              <a href="scheme_doctoral_fellowship.php?yearlydata=<?php echo $selectedYear; ?>&page=1" class="btn btn-info dashboard_card_btn card-link">View</a>
            </div>
          </div>
        </div>
      <?php endif; 
      
      if(isSchemeApplicable("PDF")):?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-4">
              <h2 class="text-primary">Post-Doctoral Fellowship Applications</h2>
              <div class="d-flex application_status justify-content-between">
                <div class="col text-center py-3">
                  <h5 class="text-dark">Unassigned </h5>
                  <h2 class="text-info"> <?php echo printDataIfArrayExist($status_for_pdf_applications, 'unassigned') ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Pending </h5>
                  <h2 class="text-warning"> <?php echo printDataIfArrayExist($status_for_pdf_applications, [0,1]) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Rejected </h5>
                  <h2 class="text-danger"> <?php echo printDataIfArrayExist($status_for_pdf_applications, 2) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Accepted </h5>
                  <h2 class="text-success"> <?php echo printDataIfArrayExist($status_for_pdf_applications, 3) ?> </h2>
                </div>
              </div>
              <a href="scheme_post_doctoral_fellowship.php?yearlydata=<?php echo $selectedYear; ?>&page=1" class="btn btn-info dashboard_card_btn card-link">View</a>
            </div>
          </div>
        </div>
      <?php endif; 

      if(isSchemeApplicable("RSG")):?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-4">
              <h2 class="text-primary">Research Start-Up Grant Scheme</h2>
              <div class="d-flex application_status justify-content-between">
                <div class="col text-center py-3">
                  <h5 class="text-dark">Unassigned </h5>
                  <h2 class="text-info"> <?php echo printDataIfArrayExist($status_for_sug_applications, 'unassigned') ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Pending </h5>
                  <h2 class="text-warning"> <?php echo printDataIfArrayExist($status_for_sug_applications, [0,1]) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Rejected </h5>
                  <h2 class="text-danger"> <?php echo printDataIfArrayExist($status_for_sug_applications, 2) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Accepted </h5>
                  <h2 class="text-success"> <?php echo printDataIfArrayExist($status_for_sug_applications, 3) ?> </h2>
                </div>
              </div>
              <a href="scheme_research_startup_grant.php?yearlydata=<?php echo $selectedYear; ?>&page=1" class="btn btn-info dashboard_card_btn card-link">View</a>
            </div>
          </div>
        </div>
      <?php endif; 

      if(isSchemeApplicable("MIN")):?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-4">
              <h2 class="text-primary">Minor Research Grant Scheme</h2>
              <div class="d-flex application_status justify-content-between">
                <div class="col text-center py-3">
                  <h5 class="text-dark">Unassigned </h5>
                  <h2 class="text-info"> <?php echo printDataIfArrayExist($status_for_min_applications, 'unassigned') ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Pending </h5>
                  <h2 class="text-warning"> <?php echo printDataIfArrayExist($status_for_min_applications, [0,1]) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Rejected </h5>
                  <h2 class="text-danger"> <?php echo printDataIfArrayExist($status_for_min_applications, 2) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Accepted </h5>
                  <h2 class="text-success"> <?php echo printDataIfArrayExist($status_for_min_applications, 3) ?> </h2>
                </div>
              </div>
              <a href="scheme_minor_project_grant.php?yearlydata=<?php echo $selectedYear; ?>&page=1" class="btn btn-info dashboard_card_btn card-link">View</a>
            </div>
          </div>
        </div>
      <?php endif; 
      
      if(isSchemeApplicable("MAJ")):?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-4">
              <h2 class="text-primary">Major Research Grant Scheme</h2>
              <div class="d-flex application_status justify-content-between">
                <div class="col text-center py-3">
                  <h5 class="text-dark">Unassigned </h5>
                  <h2 class="text-info"> <?php echo printDataIfArrayExist($status_for_maj_applications, 'unassigned') ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Pending </h5>
                  <h2 class="text-warning"> <?php echo printDataIfArrayExist($status_for_maj_applications, [0,1]) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Rejected </h5>
                  <h2 class="text-danger"> <?php echo printDataIfArrayExist($status_for_maj_applications, 2) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Accepted </h5>
                  <h2 class="text-success"> <?php echo printDataIfArrayExist($status_for_maj_applications, 3) ?> </h2>
                </div>
              </div>
              <a href="scheme_major_project_grant.php?yearlydata=<?php echo $selectedYear; ?>&page=1" class="btn btn-info dashboard_card_btn card-link">View</a>
            </div>
          </div>
        </div>
      <?php endif; 

      if(isSchemeApplicable("SS")):?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-4">
              <h2 class="text-primary">Summer School Scheme</h2>
              <div class="d-flex application_status justify-content-between">
                <div class="col text-center py-3">
                  <h5 class="text-dark">Unassigned </h5>
                  <h2 class="text-info"> <?php echo printDataIfArrayExist($status_for_ss_applications, 'unassigned') ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Pending </h5>
                  <h2 class="text-warning"> <?php echo printDataIfArrayExist($status_for_ss_applications, [0,1]) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Rejected </h5>
                  <h2 class="text-danger"> <?php echo printDataIfArrayExist($status_for_ss_applications, 2) ?> </h2>
                </div>
                <div class="col text-center py-3">
                  <h5 class="text-dark">Accepted </h5>
                  <h2 class="text-success"> <?php echo printDataIfArrayExist($status_for_ss_applications, 3) ?> </h2>
                </div>
              </div>
              <a href="scheme_summer_school.php?yearlydata=<?php echo $selectedYear; ?>&page=1" class="btn btn-info dashboard_card_btn card-link">View</a>
            </div>
          </div>
        </div>
      <?php endif; 

      ?>
    </div>
<?php
include_once('includes/footer.php'); ?>
