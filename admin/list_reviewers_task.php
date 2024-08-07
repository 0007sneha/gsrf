<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include "../data/generalData.php";
include('../admin_assets/includes/custom_functions.php');

$today = new DateTime(); // Get the current date and time
$year = $today->format('Y'); // Get the current year
$selectedYear = isset($_GET['yearlydata']) ? $_GET['yearlydata'] : $year;

$selected_scheme_type = $_GET["scheme_type"] ?? '';
$schemeBatchId = $_GET['schemeBatch'] ?? "";

$queryReviewer = $_GET['reviewers'] ?? "";
$queryFBStatus = $_GET['feedback_status'] ?? "";


$db = getDbInstance();
$schemes_type = $db->get('scheme_types');

// get scheme_batch
if ($selected_scheme_type) {
  $db = getDbInstance();
  if ($selectedYear) {
      $db->where(
          "(YEAR(created_at) =". $selectedYear."
          OR SUBSTRING(batch_no, 1, 4) = ". $selectedYear .")"
      );
  }
  $db->where("sb.scheme_types_id", $selected_scheme_type);
  $scheme_batch_data = $db->get("scheme_batch sb", null, "sb.id, sb.batch_no, sb.scheme_types_id");
}
// if ($schemeBatchId) {
//   $db = getDbInstance();
//   $selected_batch_scheme = $db->where('id', $schemeBatchId)->getOne('scheme_batch');
//   $selected_scheme_type = $selected_batch_scheme['scheme_types_id'];
// }

if ($selected_scheme_type) {
  $db = getDbInstance();
  $selected_scheme = $db->where('id', $selected_scheme_type)->getOne('scheme_types');

  $scheme_table = getTableNameBasedOnSchemeApplicationCode($selected_scheme['code']);
  $scheme_app_code = $selected_scheme['app_code'];
} else {
  $scheme_table = '';
  $scheme_app_code = '';
}

$db = getDbInstance();
$db->orderBy('name', 'ASC');
$reviewers = $db->get("reviewers", null, "id, name");
// echo '<pre>'; print_r($selected_scheme); exit;

$currentPage = $_GET["page"] ?? 1;
// set page limit to 2 results per page. 20 by default
$query = $_GET['search'] ?? "";
$query = trim($query);
// search date result
$query_date = str_replace('/', '-', $query);
$date_formatted = date('Y-m-d', strtotime($query_date));
// assign rev name


$db = getDbInstance();
$db->pageLimit = 10;
if (!empty($selectedYear)) {
  $db->where("YEAR(ra.due_date)", $selectedYear);
}
if (!empty($selected_scheme_type)) {
  $db->where("SUBSTRING(ra.application_no, 1, 3) LIKE '%" . $scheme_app_code . "%'");
}
if (!empty($schemeBatchId)) {
  $db->where("s.scheme_batch_id", $schemeBatchId);
}
if (!empty($queryReviewer)) {
  $db->where("rev.name", $queryReviewer);
}
if (!empty($query)) {
  $db->where("(
    ra.application_no LIKE '%" . $query . "%'
    OR ra.due_date LIKE '%" . $date_formatted . "%'
  )");
}
if ($queryFBStatus==0) {
  $db->where("ra.feedbackGiven", 0);
} else if ($queryFBStatus==1) {
  $db->where("ra.feedbackGiven", 1, '>=');
}
$db->join('reviewers rev', 'ra.reviewer_id = rev.id', 'LEFT');
if (!empty($schemeBatchId)) {
  $db->join($scheme_table.' s', 'ra.application_no = s.application_no', 'LEFT');
}
$result = $db->arraybuilder()
  ->paginate("reviewers_assigned ra", $currentPage, 'rev.*, 
                        ra.id AS ra_id, ra.application_no AS ra_application_no, ra.due_date AS ra_due_date, ra.feedbackGiven AS ra_feedbackGiven, ra.status AS ra_status, ra.created_at AS ra_created_at 
                    ');
// echo '<pre>'; print_r($result); exit;

$totalPages = $db->totalPages;

$search_placeholder = 'Search Application No or Due Date';

include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
  <div class="d-md-flex align-items-center justify-content-between">
    <h1>Reviewers Assigned Task List</h1>
    <div class="col-md-auto">
        <select id="years" onchange="getYearlyData('list_reviewers_task', this.value, '<?php echo '&scheme_type='.$selected_scheme_type.'&schemeBatch='.$schemeBatchId.'&reviewers='.$queryReviewer.'&search='.$query.'&feedback_status='.$queryFBStatus; ?>' )" class="form-control">
            <option disabled value="">Select Financial Year </option>
            <option value="2022">2022</option>
        </select>
    </div>
  </div>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Reviewers Assigned Task List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<form method="GET" action="" class="row mb-3">
    <input type="hidden" class="form-control" name="yearlydata" value="<?php echo $selectedYear ?>" >
    <div class="col-md-4 mb-2">
        <select class="form-select" id="applicableSchemes" name="scheme_type" onchange="this.form.submit()">
            <option value="">Select Scheme Name</option>
            <?php foreach ($schemes_type as $scheme) : ?>
                    <option <?php if ($selected_scheme_type == $scheme['id']) : ?> selected <?php endif ?> value="<?php echo $scheme['id'] ?>"><?php echo $scheme['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-4 mb-2">
        <select class="form-control" name="schemeBatch" onchange="submit()">
            <?php 
                if ($scheme_batch_data) {
                  echo '<option value="" >Select Scheme Batch No</option>';
                  foreach ($scheme_batch_data as $key2 => $value) {
                    if ($value['id'] == $schemeBatchId) {
                        $isSelected = "Selected";
                    } else {
                        $isSelected = "";
                    }
                    echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['batch_no'].'</option>';
                  }
                } else {
                  echo '<option value="" >No Batch Found</option>';
                }
            
              
            ?>
        </select>
    </div>
    <div class="col-md-4 mb-2"></div>
    <div class="col-md-3 mb-2">
        <select class="form-control" name="reviewers" id="reviewers" onchange="submit()">
          <option value="">Select Reviewer</option>
          <?php 
            foreach ($reviewers as $key3 => $value) {
              if ($value['name'] == $queryReviewer) {
                $isSelected = "Selected";
              } else {
                $isSelected = "";
              }
              echo '<option value="'.$value['name'].'" '.$isSelected.' >'.$value['name'].'</option>';
            }
          ?>
        </select>
    </div>
    <div class="col-md-4 mb-2">
        <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="<?php echo $search_placeholder ?>">
    </div>
    <div class="col-md-2 mb-2">
        <select class="form-control" name="feedback_status" id="feedback_status" onchange="submit()">
          <?php 
            foreach ($feedbackStatusArr as $key4 => $value) {
              if ($value['id'] == $queryFBStatus) {
                $isSelected = "Selected";
              } else {
                $isSelected = "";
              }
              echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['name'].'</option>';
            }
          ?>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?<?php echo 'yearlydata='.$selectedYear.'&scheme_type=&schemeBatch=&reviewers=&search=&feedback_status='; ?>" class="btn btn-secondary ml-2">Clear Search</a>
    </div>
</form>
<?php
  // include('../admin_assets/includes/search_form.php');
  include('./includes/flash_messages.php');
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Assigned Task</h5>
        <!-- Default Table -->
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Reviewers Name</th>
              <th scope="col">Application No</th>
              <th scope="col">Due Date</th>
              <th scope="col">Status</th>
              <th scope="col">Task Assigned on</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $key = 0;
            foreach ($result as $data) :
              $key++;
              $adminDataEncoded = json_encode($data);

              $sr_no = $currentPage-1;
              $sr_no = $sr_no .''. $key;
              if ($key==10 ) {
                $sr_no = (int)$key * $currentPage;
              } else {
                $sr_no = (int)$sr_no;
              }

              if ($data['ra_feedbackGiven']==1 && $data['ra_status']==1) {
                $statusColor = "text-success"; 
                $statusBGColor = "bg-success"; 
                $status = "Reviewed";
              } else if ($data['ra_feedbackGiven']==1 && $data['ra_status']==0) {
                $statusColor = "text-warning";
                $statusBGColor = "bg-warning";
                $status = "Reviewed Task Removed";
              } else if ($data['ra_feedbackGiven']==0 && $data['ra_status']==1) {
                $statusColor = "text-primary";
                $statusBGColor = "bg-primary";
                $status = "In-Review";
              } else if ($data['ra_feedbackGiven']==0 && $data['ra_status']==0) {
                $statusColor = "text-danger";
                $statusBGColor = "bg-danger";
                $status = "Pending Task Removed";
              } else {
                $statusColor = "";
                $statusBGColor = "";
                $status = "";
              }
            ?>
              <tr>
                <th scope="row"><?php echo $sr_no ?></th>
                <td><?php echo $data['name'] ?></td>
                <td class="text-center"><?php echo $data['ra_application_no'] ?></td>
                <td class="text-center"><?php echo date('d-m-Y', strtotime($data['ra_due_date'])); ?></td>
                <td class="text-center"><span class="badge border-secondary border-1 <?php echo $statusBGColor ?>"><?php echo $status ?></span></td>
                <td class="text-center"><?php echo $data['ra_created_at']!="" ? date('d-m-Y', strtotime($data['ra_created_at'])) : ''; ?></td>
              </tr>
            <?php
            endforeach;
            ?>
          </tbody>
        </table>
        <ul class="pagination justify-content-center">
          <?php echo paginationLinks($currentPage, $totalPages, "") ?>
        </ul>
        <!-- End Default Table Example -->
      </div>
    </div>
  </div>
</div>


<script>
</script>
<?php include_once('includes/footer.php'); ?>
