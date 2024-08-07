<?php
// session_start();
// require_once './config/config.php';
// require_once 'includes/auth_validate.php';
// require_once '../data/generalData.php';
// include('../admin_assets/includes/custom_functions.php');
// require_once '../vendor/autoload.php';

$db = getDbInstance();
$schemes_type = $db->get('scheme_types');

$selected_scheme_type = $_GET["scheme_type"] ?? '1';

$db = getDbInstance();
$selected_scheme = $db->where('id', $selected_scheme_type)->getOne('scheme_types');

$scheme_table = getTableNameBasedOnSchemeApplicationCode($selected_scheme['code']);
$scheme_name = getSchemeNameBasedOnSchemeApplicationCode($selected_scheme['code']);

include('../admin_assets/api/applicationListApi.php');

$search_placeholder = 'Search...';

include_once('includes/header.php');
?>

<!-- /.row -->
<div class="pagetitle">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>Scheme Wise Applications</h1>
        <div class="col-md-auto">
            <select id="years" onchange="getYearlyData('applications_list', this.value, '<?php echo '&scheme_type='.$selected_scheme_type.'&schemeBatch='.$schemeBatchId.'&search='.$query ; ?>' )" class="form-control">
                <option disabled value="">Select Financial Year </option>
                <option value="2022">2022</option>
            </select>
        </div>
    </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Application List</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<form method="GET" action="" class="row">
    <input type="hidden" class="form-control" name="yearlydata" value="<?php echo $selectedYear ?>" >
    <div class="col-md-3 mb-2">
        <select class="form-select" id="applicableSchemes" name="scheme_type" onchange="this.form.submit()">
            <?php foreach ($schemes_type as $scheme) : ?>
                    <option <?php if ($selected_scheme_type == $scheme['id']) : ?> selected <?php endif ?> value="<?php echo $scheme['id'] ?>"><?php echo $scheme['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <select class="form-control" name="schemeBatch" onchange="submit()">
            <option value="" >Select Scheme Batch No</option>
            <?php 
                foreach ($scheme_batch_data as $key2 => $value) {
                if ($value['id'] == $schemeBatchId) {
                    $isSelected = "Selected";
                } else {
                    $isSelected = "";
                }
                echo '<option value="'.$value['id'].'" '.$isSelected.' >'.$value['batch_no'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="Search..">
    </div>
    <div class="col-md-3 mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?<?php echo 'yearlydata='.$selectedYear.'&scheme_type='.$selected_scheme_type.'&schemeBatch=&search='; ?>" class="btn btn-secondary ml-2">Clear Search</a>
    </div>
</form>

<div class="card card_having_table mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">Application List</h5>
            <a class="btn btn-primary m-auto" style="margin-right: 0px !important;" href="../admin_assets/api/exportApplicationListApi.php?<?php echo 'yearlydata='.$selectedYear.'&scheme_type='.$selected_scheme_type.'&schemeBatch='.$schemeBatchId.'&search='.$query.'&s='.$scheme_table.'&n='.$scheme_name ?>" title="Excel Sheet">
                <i class="ri-download-2-fill"></i> Download List
            </a>
        </div>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col text-center">#</th>
                    <th scope="col text-center">Application No</th>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Rev 1 Name</th>
                    <th scope="col">Rev 1 <br> Recommendation</th>
                    <th scope="col">Rev 1 score</th>
                    <th scope="col">Rev 2 Name</th>
                    <th scope="col">Rev 2 <br> Recommendation</th>
                    <th scope="col">Rev 2 score</th>
                    <th scope="col text-center"> View Review</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $key = 0;
                if (isset($data) && $data) {
                    foreach ($data as $value) :

                        $key++;
                        $sr_no = $currentPage - 1;
                        $sr_no = $sr_no . '' . $key;
                        if ($key == 10) {
                            $sr_no = (int)$key * $currentPage;
                        } else {
                            $sr_no = (int)$sr_no;
                        }

                        $rev_feedback_given_0 = "";
                        $rev_name_0 = $rev_remarks_0 = $rev_overall_rating_0 = $rev_due_date_0 =
                        $rev_name_1 = $rev_remarks_1 = $rev_overall_rating_1 = $rev_feedback_given_1 = $rev_due_date_1 = "-";

                        if (isset($value['rev_assigned'])) {
                            if ( isset($value['rev_assigned'][0]) ) {
                                $rev_assigned = $value['rev_assigned'][0];
                                $rev_name_0 =  $rev_assigned['reviewer']['name'] ?? "-" ;

                                $rev_remarks_0 =  $rev_assigned['rev_feedback']['remarks'] ?? "-" ;
                                $rev_overall_rating_0 =  $rev_assigned['rev_feedback']['overall_rating'] ?? "-" ;

                                $rev_feedback_given_0 = $rev_assigned['feedbackGiven'];
                                if ($rev_assigned['due_date']) {
                                    $due_date = date('d-m-Y', strtotime($rev_assigned['due_date']));
                                } else {
                                    $due_date = '-';
                                }
                                $rev_due_date_0 = $due_date;
                            }
                            if ( isset($value['rev_assigned'][1]) ) {
                                $rev_assigned = $value['rev_assigned'][1];
                                $rev_name_1 =  $rev_assigned['reviewer']['name'] ?? "-" ;

                                $rev_remarks_1 =  $rev_assigned['rev_feedback']['remarks'] ?? "-" ;
                                $rev_overall_rating_1 =  $rev_assigned['rev_feedback']['overall_rating'] ?? "-" ;

                                $rev_feedback_given_1 = $rev_assigned['feedbackGiven'];
                                if ($rev_assigned['due_date']) {
                                    $due_date = date('d-m-Y', strtotime($rev_assigned['due_date']));
                                } else {
                                    $due_date = '-';
                                }
                                $rev_due_date_1 = $due_date;
                            }
                        }

                    ?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo $sr_no ?></th>
                            <td class="text-center">
                                <?php 
                                    echo $value['application_no'];
                                    
                                    $file_to_download = "../".$value['file_application_form'];
                                    if ($value['file_application_form'] && file_exists($file_to_download)) {
                                        echo '<a href="'.$file_to_download.'" download> <i class="ri-download-2-fill"> Download </i></a>';
                                    } else {
                                        echo '<a href="#" title="Error: File not found on server. The file might have been moved or deleted."> <i class="ri-file-excel-line"> File not found </i></a>';
                                    }
                                ?>
                            </td>
                            <td><?php echo isset($value['usr_full_name']) ? $value['usr_full_name'] : 'Not Found'; ?></td>
                            <td>
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                <?php 
                                    echo $rev_name_0;
                                    if ($rev_name_0!="-") {
                                        echo '<span class="badge border-primary border-1 text-danger">Due on '.$rev_due_date_0.' </span>';
                                    } 
                                ?>
                                </div>
                            </td>
                            <td><?php echo $rev_remarks_0 ?></td>
                            <td class="text-center"><?php echo $rev_overall_rating_0?></td>
                            <td>
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                <?php 
                                    echo $rev_name_1;
                                    if ($rev_name_1!="-") {
                                        echo '<span class="badge border-primary border-1 text-danger">Due on '.$rev_due_date_1.' </span>';
                                    } 
                                ?>
                                </div>
                            </td>
                            <td><?php echo $rev_remarks_1 ?></td>
                            <td class="text-center"><?php echo $rev_overall_rating_1?></td>
                            <td class="text-center">
                                <?php
                                    if ($rev_feedback_given_0 == "") {
                                        echo '<span class="badge border-secondary border-1 text-secondary">Unassigned</span>';
                                    } else if ($rev_feedback_given_0 == 0) {
                                        echo '<span class="badge border-primary border-1 text-primary">In Review</span>';
                                    } else {
                                        echo '<span class="badge border-success border-1 text-success">Reviewed <br>
                                                <a class="mt-2" href="view_all_feedbacks.php?yearlydata='.$selectedYear.'&scheme_type='.$selected_scheme_type.'&schemeBatch='.$schemeBatchId.'&search='.$query.'&page='.$currentPage.'&aid=' . $value['application_no'] . '" type="button" class="btn btn-primary btn-sm">View Review</a>
                                                </span>';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                } else {
                    echo '<tr><td colspan="10" class="text-center"> No Data Found</td></tr>';
                }
                ?>

            </tbody>
        </table>
        <ul class="pagination justify-content-center">
            <?php echo paginationLinks($currentPage, $totalPagesCount, "") ?>
        </ul>
        <!-- End Default Table Example -->
    </div>
</div>



<?php include_once('includes/footer.php'); ?>