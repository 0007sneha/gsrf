<?php
// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';

$tagsArr = ['Message','Account','OTP','Confirmation','Other'];

$today = new DateTime(); // Get the current date and time
$year = $today->format('Y'); // Get the current year
$selectedYear = isset($_GET['yearlydata']) ? $_GET['yearlydata'] : $year;
$currentPage = $_GET["page"] ?? 1;
$query = $_GET['search'] ?? "";
$queryTag = $_GET['tag'] ?? "";
// set page limit to 2 results per page. 20 by default
$db = getDbInstance();
$db->pageLimit = 10;
if ($query!='') {
    $_SESSION['info'] = "Search result !";
}
if ($queryTag!='') {
    $_SESSION['info'] = "Search ".$queryTag." Tag !";
}

$db->where("( 
    log_type LIKE '%" . $query . "%' 
    OR application_no LIKE '%" . $query . "%' 
    OR title LIKE '%" . $query . "%' 
    OR subject LIKE '%" . $query . "%' 
    OR sent_to LIKE '%" . $query . "%' 
    OR created_at LIKE '%" . $query . "%' 
)");
$db->where("log_type LIKE '%" . $queryTag . "%' ");
if ($selectedYear) {
    $db->where("YEAR(created_at) =". $selectedYear);
}
$db->orderBy('id', 'DESC');
$logs = $db->arraybuilder()->paginate("communication_log", $currentPage);
$totalPages = $db->totalPages;

$search_placeholder = 'Search by Title, Rec Email, Subject, App No, Date or Tags';

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <div class="d-md-flex align-items-center justify-content-between">
      <h1>Activity Log</h1>
      <div class="col-md-auto">
          <select id="years" onchange="getYearlyData('list_activity_logs', this.value)" class="form-control">
              <option disabled value="">Select Financial Year </option>
              <option value="2022">2022</option>
          </select>
      </div>
  </div>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Activity Logs</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<form method="GET" action="" class="row">
    <input type="hidden" class="form-control" name="yearlydata" value="<?php echo $selectedYear ?>" >
    <div class="col-md-6 mb-2">
        <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="<?php echo $search_placeholder ?>">
    </div>
    <div class="col-md-2 mb-2">
        <select class="form-control" name="tag" onchange="submit()">
          <option value="">All Tags</option>
          <?php 
            foreach ($tagsArr as $key2 => $value) {
              if ($value == $queryTag) {
                $isSelected = "Selected";
              } else {
                $isSelected = "";
              }
              echo '<option value="'.$value.'" '.$isSelected.' >'.$value.'</option>';
            }
          ?>
        </select>
    </div>
    <div class="col-md-4 mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?<?php echo 'yearlydata='.$selectedYear.'&search=&tag='; ?>" class="btn btn-secondary ml-2">Clear Search</a>
    </div>
</form>
<?php
  // include('../admin_assets/includes/search_form.php');
  include('./includes/flash_messages.php');
?>

<div class="row mt-3">
  <div class="col-lg-10">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Activities</h5>
        <!-- Accordion without outline borders = accordion-flush -->
        <div class="accordion accordion-flush" id="accordionFlushContainer">
          <?php
            $key = 0;
            if ($logs) {
              foreach ($logs as $log) :
                $key++;
                $sr_no = $currentPage-1;
                $sr_no = $sr_no .''. $key;
                if ($key==10 ) {
                  $sr_no = (int)$key * $currentPage;
                } else {
                  $sr_no = (int)$sr_no;
                }
                ?>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-heading-<?php echo $sr_no ?>" >
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo $sr_no ?>" aria-expanded="false" aria-controls="flush-collapse-<?php echo $sr_no ?>">
                      <?php 
                        echo '<span class="badge border-secondary border-1 text-info">'.$log['created_at'].'</span>';
                        echo $log['title']; 
                        if ($log['application_no']) {
                          echo '<span class="alert alert-primary alert-dismissible fade show" role="alert" style="margin: auto auto auto 5px; padding: 5px 10px;">'.$log['application_no'].'</span>';
                        }
                      ?>
                    </button>
                  </h2>
                  <div id="flush-collapse-<?php echo $sr_no ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading-<?php echo $sr_no ?>"  data-bs-parent="#accordionFlushContainer">
                    <div class="accordion-body">
                      <?php 
                        if ($log['message']) { ?>
                          <div class="alert alert-info border-light alert-dismissible fade show" role="alert">
                            <span class="badge bg-primary"><i class="bi bi-check-circle me-1"></i> <?php echo $log['sent_to']; ?></span>
                            <h4 class="alert-heading text-primary">Subject</h4>
                            <p class="mb-0"><?php echo $log['subject']; ?></p>
                            <hr>
                            <h4 class="alert-heading text-primary">Message</h4>
                            <?php echo $log['message']; ?>
                          </div>
                          <?php 
                        } else {
                          echo 'No Content Available !';
                        }
                      ?>
                    </div>
                  </div>
                </div>
                <?php
              endforeach;
            } else {
              echo '<div class="empty-table-container">No Logs Available</div>';
            }
          ?>
        </div><!-- End Accordion without outline borders -->
        <ul class="pagination justify-content-center">
          <?php echo paginationLinks($currentPage, $totalPages, "") ?>
        </ul>
      </div>
    </div>
  </div>

<?php include_once('includes/footer.php'); ?>
