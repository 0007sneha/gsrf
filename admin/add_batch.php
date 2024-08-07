<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../config/send_email.php';
require_once '../config/be_function.php';
require_once '../data/generalData.php'; 

$db = getDbInstance();
$scheme_types = $db->get('scheme_types');

$db = getDbInstance();
$action = isset($_GET['action']) ? $_GET['action'] : 'create';
$id = $_GET['id'] ?? null;
$updateData = null;

function getData($key)
{
    global $updateData;
    return $updateData != null ? $updateData[$key] : null;
}

if ($action == "update" && $id != null) {
    $db = getDbInstance();
    $updateData = $db->where('id', $id)->getOne('scheme_batch');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_to_store = filter_input_array(INPUT_POST);
    $updateId = $data_to_store['update-id'] ?? null; 
    unset($data_to_store['update-id']);

    if ($updateId == null) {
        $db = getDbInstance();
        $db->where('batch_no', $data_to_store['batch_no']);
        $db->where('scheme_types_id', $data_to_store['scheme_types_id']);
        $db->get('scheme_batch');
        if ($db->count > 0) {
            $_SESSION['failure'] = "Batch Already assigned to the Selected Scheme";
            // header('location: add_batch.php');
            // exit();
        } else {
            $db = getDbInstance();
            $db->where('status', 'open');
            $db->where('scheme_types_id', $data_to_store['scheme_types_id']);
            $checkSchemeBatchData = $db->getOne('scheme_batch');
            

            if ($checkSchemeBatchData) {
                $_SESSION['failure'] = "Previous Batch is Still OPEN for the Selected Scheme, Please Close the Batch first!";
            } else {
                //reset db instance
                $db = getDbInstance();
                $last_id = $db->insert('scheme_batch', $data_to_store);
                $_SESSION['success'] = "New Batch Created Successfully!";
            }
        }
    } else {
        $last_id = $db->where('id', $updateId)->update('scheme_batch', $data_to_store);

        $_SESSION['success'] = "Scheme Batch Updated successfully!";
        header('location: list_batch.php');
        exit();
    }
}
$opening_msg_template = '&lt;p&gt;
    // Scheme Title Message in Bold
&lt;/p&gt;
&lt;p class="note mt-3 mb-1" id="scheme"&gt;
    // description (required element) 
    use &lt;strong&gt; to highlight content&lt;/strong&gt;
&lt;/p&gt;
&lt;p class="note"&gt;
    // message in ITALICS Font style before applying scheme
&lt;/p&gt;';
$reminder_msg ='&lt;p class="scheme-status"&gt;  Enter Message to be displayed under Apply Button....    &lt;/p&gt;';
$other_msg = '&lt;p class="scheme-status"&gt;    Enter Scheme Message here....  &lt;/p&gt;
// use class name "scheme-status" to show content in Bold Font and Primary BLue Font Color
'
;
// exit();
include_once('includes/header.php');
?>

<div class="pagetitle">
    <h1>Scheme Batch</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="list_batch.php">Scheme Batches</a></li>

        <li class="breadcrumb-item active"><?php echo $action == "update" ? 'Update' : 'Add New' ?> Batch</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<?php
    include('./includes/flash_messages.php');
?>
<div class="row">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $action == "update" ? 'Update' : 'Create' ?> Scheme Batch</h5>
                <!-- General Form Elements -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="update-id" class="form-control" value="<?php echo getData("id") ?>" hidden>
                    <div class="row mb-3">
                        <div class="col-md-8 mb-4">
                            <label for="batch_no" placeholder="Enter Batch" class="col-form-label star">Batch Title</label>
                            <input type="text" name="batch_no" id="batch_no" class="form-control" value="<?php echo getData("batch_no") ?>" placeholder="ex: 2023-24(Q1)" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="app_type" class="col-form-label star">Application Type</label>
                            <select name="app_type" id="app_type" class="form-control" placeholder="Select App Type" required>
                                <?php 
                                    foreach ($appTypeArr as $key => $value) {
                                        $selected = ''; 
                                        if (getData("app_type") == $value["id"]) {
                                            $selected = 'selected'; 
                                        }
                                        echo '<option value="'.$value["id"].'" '.$selected.'>'.$value["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="scheme_types_id" class="col-form-label star">Select Scheme</label>
                            <select name="scheme_types_id" id="scheme_types_id" class="form-control" placeholder="Select Scheme" required>
                                <?php 
                                    echo '<option value="">Select Scheme Name</option>';
                                    foreach ($scheme_types as $key => $value) {
                                        $selected = ''; 
                                        if (getData("scheme_types_id") == $value["id"]) {
                                            $selected = 'selected'; 
                                        }
                                        echo '<option value="'.$value["id"].'" '.$selected.'>'.$value["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="status" class="col-form-label star">Status</label>
                            <select name="status" id="status" class="form-control" placeholder="Select Status" required>
                                <?php 
                                    foreach ($batchStatusArr as $key => $value) {
                                        $selected = ''; 
                                        if (getData("status") == $value["id"]) {
                                            $selected = 'selected'; 
                                        }
                                        echo '<option value="'.$value["id"].'" '.$selected.'>'.$value["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="opening_date" class="col-form-label star">Opening Date</label>
                            <input type="date" name="opening_date" id="opening_date" value="<?php echo getData("opening_date") ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="closing_date" class="col-form-label star">Closing Date</label>
                            <input type="date" name="closing_date" id="closing_date" value="<?php echo getData("closing_date") ?>" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="scheme_opening_msg" class="col-form-label star">Scheme Opening Message (Displayed at Top Section)</label>
                            <br><small>(Use below Schema Element while adding Info, Above Apply Button)</small>  <!--  tinymce-editor -->
                            <textarea name="scheme_opening_msg" id="scheme_opening_msg" class="form-control" cols="30" rows="10" placeholder='<?php echo $opening_msg_template; ?>'><?php echo getData("scheme_opening_msg")!='' ? getData("scheme_opening_msg") : ''; ?></textarea>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="reminder_note" class="col-form-label">Reminder Message (Displayed at Top Section)</label>
                            <br><small>(Displayed, bellow Apply Button)</small>  <!--  tinymce-editor -->
                            <textarea name="reminder_note" id="reminder_note" class="form-control" cols="30" rows="3" placeholder='<?php echo $reminder_msg; ?>'><?php echo getData("reminder_note")!='' ? getData("reminder_note") : ''; ?></textarea>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="scheme_opening_msg_bottom" class="col-form-label star">Scheme Opening Message (Displayed at Bottom Section)</label>
                            <br><small>(Use below Schema Element while adding Info, Above Apply Button)</small>  <!--  tinymce-editor -->
                            <textarea name="scheme_opening_msg_bottom" id="scheme_opening_msg_bottom" class="form-control" cols="30" rows="10" placeholder='<?php echo $opening_msg_template; ?>'><?php echo getData("scheme_opening_msg_bottom")!='' ? getData("scheme_opening_msg_bottom") : ''; ?></textarea>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="scheme_closing_msg" class="col-form-label">Scheme Closing Message</label>
                            <textarea name="scheme_closing_msg" id="scheme_closing_msg" class="form-control" cols="30" rows="3" placeholder='<?php echo $other_msg; ?>'><?php echo getData("scheme_closing_msg")!='' ? getData("scheme_closing_msg") : ''; ?></textarea>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="scheme_pending_msg" class="col-form-label">Scheme Await Message</label>
                            <textarea name="scheme_pending_msg" id="scheme_pending_msg" class="form-control" cols="30" rows="3" placeholder='<?php echo $other_msg; ?>'><?php echo getData("scheme_pending_msg")!='' ? getData("scheme_pending_msg") : ''; ?></textarea>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="scheme_result_msg" class="col-form-label">Scheme Result Message</label>
                            <textarea name="scheme_result_msg" id="scheme_result_msg" class="form-control" cols="30" rows="3" placeholder='<?php echo $other_msg; ?>'><?php echo getData("scheme_result_msg")!='' ? getData("scheme_result_msg") : ''; ?></textarea>
                        </div>

                        <div class="col-md-12 mb-4" id="file_approved_app_result_field">
                            <label for="file_approved_app_result" class="form-label">Upload Scheme Result </label>
                            <small class="form-text text-muted">(Attach a scanned PDF copy of max 700KB)</small><br>
                            <small class="form-text text-muted">
                                Please name your file using the following format: <strong>[SchemeName BatchTitle]</strong>
                            </small><br>
                            <small class="form-text text-muted">
                                For example: <em>GSRF Doctoral Research Fellowship 2023-24.pdf</em>
                            </small>
                            <div class="form-check" style="padding-left: 0;">
                                <input type="hidden" id="file_approved_app_result_value" name="file_approved_app_result" value="<?php echo getData("file_approved_app_result") ?>">
                                <input type="file" id="file_approved_app_result" placeholder="" class="form-control input-md" accept="application/pdf">
                                <?php 
                                    echo '
                                        <a href="#" class="btn btn-outline d-none" id="view_file_approved_app_result" target="_blank">View File(<span></span>)</a>
                                        <a href="#" class="btn btn-outline remove_file text-center d-none" id="remove_file_approved_app_result" onclick="removeUploadedFile(\'docs\', \'file_approved_app_result\', \'adminSchemeData\'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
                                        <span class="btn btn-outline text-center fw6 d-none" id="upload_file_approved_app_result">Uploading your file</span>
                                        <div class="progress mx-3 p-0 progressBarContainer d-none" style="height:6px; max-width:340px;">
                                            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated progressBarWidth" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                    ';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary px-5"><?php echo $action == "update" ? 'Update' : 'Save' ?></button>
                            <button onclick="location.href='list_batch.php'; return false;" class="btn btn-light px-5 mx-2" >Back</button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-primary" style="position: fixed; top: 458px; right: 10px;" data-bs-toggle="modal" data-bs-target="#showOpeningMsgModal">Message Code </button>
<!-- Modal -->
<div class="modal fade" id="showOpeningMsgModal" tabindex="-1" aria-labelledby="showOpeningMsgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showOpeningMsgModalLabel">Opening Message Reference Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
<h5>Opening Message Template for App Form Upload </h5>
<pre><code><!-- Place your code snippet here -->
&lt;p&gt;
    // Scheme Title Message in Bold
&lt;/p&gt;
&lt;p class="note mt-3 mb-1" id="scheme"&gt;
    // description (required element) 
    use &lt;strong&gt; to highlight content&lt;/strong&gt;
&lt;/p&gt;
&lt;p class="scheme-status"&gt;
    // imp message in BOLD Blue Color Font
&lt;/p&gt;
&lt;p class="note"&gt;
    // message in ITALICS Font style before applying scheme
&lt;/p&gt;
&lt;p&gt;
    // normal message before applying scheme
&lt;/p&gt;
&lt;ol class="scheme_info text_left" type="a"&gt;
    &lt;li&gt;
        &lt;p&gt;
            // Info in list Step 
        &lt;/p&gt;
    &lt;/li&gt;
&lt;/ol&gt;
</code></pre>

<br>
<h5>Opening Message Template for Doc Upload </h5>
<pre><code>
&lt;p class="scheme-status"&gt;
    If you have gone through the details, please download the application format (pdf /docx formats) given at the 
    bottom of the page or from the downloads section for filling.
&lt;/p&gt;
&lt;ol class="scheme_info text_left" type="a"&gt;
    &lt;li&gt;
        &lt;p&gt;
            All the attachments shall be at the end of the application, appearing in the same order as in the application.
        &lt;/p&gt;
    &lt;/li&gt;
    &lt;li&gt;
        &lt;p&gt;
            The proposal shall be compiled into a &lt;strong&gt;single pdf file, including attachments, and named as PDF_xxxx_yyyyyy,&lt;/strong&gt; 
            wherein xxxx is the year (eg. 2023) and yyyyyy is your name. The format of the application and other 
            certificates are available for download. 
        &lt;/p&gt;
    &lt;/li&gt;
    &lt;li&gt;
        &lt;p&gt;
            Students from Konkani/Marathi/Hindi, etc. can fill in the application in the respective language.
        &lt;/p&gt;
    &lt;/li&gt;
&lt;/ol&gt;

</code></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="showReminderMsgModal" tabindex="-1" aria-labelledby="showReminderMsgModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showReminderMsgModalLabel">Reminder Message Reference Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
<pre><code><!-- Place your code snippet here -->
&lt;p class="scheme-status"&gt; 
    // Enter Message to be displayed under Apply Button 
&lt;/p&gt;
&lt;p class="note"&gt;
    // normal info alert
&lt;/p&gt;
</code></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>

<script>
    var saveData = {};
    const fileInputApprovedAppResult = document.getElementById('file_approved_app_result');
    fileInputApprovedAppResult.addEventListener('change', async (event) => {
        let batchNo = $("#batch_no").val();

        if (batchNo) {
            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                    'file_location' : 'admin',
                }
                uploadFile({
                    'file_type':'docs', 
                    'response_id' : 'file_approved_app_result', 
                    'file_id' : fileInputApprovedAppResult, 
                    'file_data' : fileData, 
                    'storage_key' : 'adminSchemeData',
                });
            } else {
                if (savedData['file_approved_app_result']=='') {
                    popUpMsg('Please select a File!');
                }
            }
        } else {
            popUpMsg('Please enter Batch-No First!');
        }
	});

    $(function() {
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        let action = "<?php echo $action; ?>";
        if (action == 'create') {
            document.getElementById('opening_date').min = today;
            document.getElementById('closing_date').min = today;
        } else {
            if ('<?php echo getData("file_approved_app_result") ?>') {
                displayUploadedFile('docs', 'file_approved_app_result', '<?php echo getData("file_approved_app_result") ?>');
            }
        }
    });

    $("#opening_date").on("change", function() {
        let closingDate = document.getElementById('closing_date');
        
        if (closingDate.value < this.value) {
            closingDate.value = '';
        }
        closingDate.min = this.value;
    });
</script>