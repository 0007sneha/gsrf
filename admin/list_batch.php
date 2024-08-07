<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../data/generalData.php'; 
require_once '../config/be_function.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();
// if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['toggle_status_form'])) {
//     $payload = filter_input_array(INPUT_POST);
//     $recordId = $payload['id'];

//     // Update the database with the new value
//     $data = ['status' => $payload['toggle-status']];    
//     $db = getDbInstance();
//     $db->where('id', $recordId);
//     $db->update('scheme_batch', $data);

//     $_SESSION['success'] = "Scheme Batch STATUS updated successfully!";
// }

$currentPage = $_GET["page"] ?? 1;
$query = $_GET['search'] ?? "";
$query = trim($query);

$queryBatchStatus = $_GET['status'] ?? "";

// search date result
$query_date = str_replace('/', '-', $query);
$date_formatted = date('Y-m-d', strtotime($query_date));

$db = getDbInstance();
// set page limit to 2 results per page. 20 by default
$db->pageLimit = 10;
$db->where("( 
    batch_no LIKE '%" . $query . "%' 
    OR st.name LIKE '%" . $query . "%' 
    OR opening_date LIKE '%" . $date_formatted . "%'
    OR closing_date LIKE '%" . $date_formatted . "%'
)");
if ($queryBatchStatus ) {
    $db->where("status", $queryBatchStatus);
}
$db->orderBy('id', 'DESC');
$result = $db
->join('scheme_types st', 'sb.scheme_types_id = st.id', 'LEFT')
->arraybuilder()->paginate("scheme_batch sb", $currentPage, 'sb.*,
                st.id AS st_id, st.name AS st_name
            ');
$totalPages = $db->totalPages;

// echo '<pre>';print_r($result); exit;
$search_placeholder = 'Search Batch, Scheme Name, Dates';
include_once('includes/header.php');
?>
<!-- /.row -->
<div class="pagetitle">
    <h1>Scheme Batches</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Scheme Batches</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<form method="GET" action="" class="row mb-3">
    <div class="col-md-5 mb-2">
        <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="<?php echo $search_placeholder ?>">
    </div>
    <div class="col-md-3 mb-2">
        <select class="form-control" name="status" id="status" onchange="submit()">
            <?php 
                foreach ($batchStatusArr as $key4 => $value) {
                    if ($value['id'] == $queryBatchStatus) {
                        $isSelected = "Selected";
                    } else {
                        $isSelected = "";
                    }
                echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['name'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col-md-4 mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?" class="btn btn-secondary ml-2">Clear Search</a>
    </div>
</form>
<?php
    // include('../admin_assets/includes/search_form.php');
    include('./includes/flash_messages.php');
?>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between">
                    All Batches
                    <a href="add_batch.php" class="btn btn-primary">Add New Batch</a>
                </h5>
                <!-- Default Table -->
                <table class="table mt-4">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Scheme</th>
                        <th scope="col">Opening Date</th>
                        <th scope="col">Closing Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $key = 0;
                            foreach ($result as $data) :
                                $key++;
                                // $adminDataEncoded = json_encode($data);

                                $sr_no = $currentPage-1;
                                $sr_no = $sr_no .''. $key;
                                if ($key==10 ) {
                                    $sr_no = (int)$key * $currentPage;
                                } else {
                                    $sr_no = (int)$sr_no;
                                }
                                
                                $schemeStatusColor = "";
                                // if (isDateBeforeCurrentDate($data['closing_date']) && $data['status']=="open" ) {
                                //     $schemeStatusColor = "bg-warning-light";
                                // }

                                switch ($data['status'] ) {
                                    case 'open': $statusClass = "waiting"; break;
                                    case 'close': $statusClass = "pending"; break;
                                    case 'pending': $statusClass = "inactive"; break;
                                    case 'result': $statusClass = ""; break;
                                    default: $statusClass = ""; break;
                                }
                                ?>
                                <tr>
                                    <th class="text-center <?php echo $schemeStatusColor?>" scope="row"><?php echo $sr_no ?></th>
                                    <td class="text-center <?php echo $schemeStatusColor?>"><?php echo $data['batch_no'] ?></td>
                                    <td class="<?php echo $schemeStatusColor?>"><?php echo $data['st_name'] ?></td>
                                    <td class="text-center <?php echo $schemeStatusColor?>"><?php echo date('d-m-Y',strtotime($data['opening_date'])) ?></td>
                                    <td class="text-center <?php echo $schemeStatusColor?>"><?php echo date('d-m-Y',strtotime($data['closing_date'])) ?></td>
                                    <td class="text-center <?php echo $schemeStatusColor?>"><span class="user_status text-uppercase <?php echo $statusClass ?>"><?php echo $data['status'] ?></span> </td>
                                    <td class="text-center <?php echo $schemeStatusColor?>">
                                        <a href="add_batch.php?id=<?php echo $data['id']; ?>&action=update" class="btn btn-primary btn-sm"><span><i class="bi bi-pencil-square"></i></span></a>
                                    </td>
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
    let editButtonElement = $("#edit_record");
    $("#uid").val("");

    function edit(data, id) {
        // console.log("Data received:", data); // Check the data in the console
        let decoded = decodeURIComponent(decodeURIComponent(data));
        var data = JSON.parse(decoded);
        $("#uid").val(data.id);
        $("#name").val(data.name.replace(/\+/g, ' '));
        $("#email").val(data.email);
        $("#password").val(data.password);
    }
    
</script>

<?php include_once('includes/footer.php'); ?>