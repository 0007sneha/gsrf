<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once '../config/send_email.php';
require_once '../config/be_function.php';
require_once '../data/generalData.php'; 

$db = getDbInstance();
$scheme_types = $db->get('scheme_types');

// $db = getDbInstance();
$action = isset($_GET['action']) ? $_GET['action'] : 'create';
$id = $_GET['id'] ?? null;
$updateData = null;

function getData($key)
{
    global $updateData;
    return $updateData != null ? $updateData[$key] : null;
}

// if ($action == "update" && $id != null) {
//     $db = getDbInstance();
//     $updateData = $db->where('id', $id)->getOne('scheme_batch');
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $data_to_store = filter_input_array(INPUT_POST);
//     $updateId = $data_to_store['update-id'] ?? null; 
//     unset($data_to_store['update-id']);

//     if ($updateId == null) {
//         $db = getDbInstance();
//         $db->where('batch_no', $data_to_store['batch_no']);
//         $db->where('scheme_types_id', $data_to_store['scheme_types_id']);
//         $db->get('scheme_batch');
//         if ($db->count > 0) {
//             $_SESSION['failure'] = "Batch Already assigned to the Selected Scheme";
//             // header('location: add_batch.php');
//             // exit();
//         } else {
//             $db = getDbInstance();
//             $db->where('status', 'open');
//             $db->where('scheme_types_id', $data_to_store['scheme_types_id']);
//             $checkSchemeBatchData = $db->getOne('scheme_batch');
            

//             if ($checkSchemeBatchData) {
//                 $_SESSION['failure'] = "Previous Batch is Still OPEN for the Selected Scheme, Please Close the Batch first!";
//             } else {
//                 //reset db instance
//                 $db = getDbInstance();
//                 $last_id = $db->insert('scheme_batch', $data_to_store);
//                 $_SESSION['success'] = "New Batch Created Successfully!";
//             }
//         }
//     } else {
//         $last_id = $db->where('id', $updateId)->update('scheme_batch', $data_to_store);

//         $_SESSION['success'] = "Scheme Batch Updated successfully!";
//         header('location: list_batch.php');
//         exit();
//     }
// }
// exit();
include_once('includes/header.php');
?>

<div class="pagetitle">
    <h1>Event</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="list_batch.php">Events</a></li>

        <li class="breadcrumb-item active"><?php echo $action == "update" ? 'Update' : 'Add New' ?> Event</li>
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
                <h5 class="card-title"><?php echo $action == "update" ? 'Update' : 'Create' ?> Event</h5>
                <!-- General Form Elements -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="update-id" class="form-control" value="<?php echo getData("id") ?>" hidden>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-4">
                            <label for="title" placeholder="Enter Batch" class="col-form-label star">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo getData("title") ?? 'this is test data' ?>" placeholder="" required>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="short_title" placeholder="Enter Batch" class="col-form-label">Short Title (optional)</label>
                            <input type="text" name="short_title" id="short_title" class="form-control" value="<?php echo getData("short_title") ?>" placeholder="">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="date" class="col-form-label star">Event Date</label>
                            <input type="date" name="date" id="date" value="<?php echo getData("date") ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="event_status" class="col-form-label star">Event Status</label>
                            <select name="event_status" id="event_status" class="form-control" placeholder="Select App Type" required>
                                <?php 
                                    foreach ($eventStatusArr as $key => $value) {
                                        $selected = ''; 
                                        if (getData("event_status") == $value["id"]) {
                                            $selected = 'selected'; 
                                        }
                                        echo '<option value="'.$value["id"].'" '.$selected.'>'.$value["name"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="content" class="col-form-label star">Description</label>
                            <textarea name="content" id="content" class="form-control" cols="30" rows="3" placeholder="Event Description..."><?php echo getData("content") ?></textarea>
                        </div>

                        <div class="col-md-12 mb-4" id="file_cover_image_field">
                            <label for="file_cover_image" class="form-label star">Upload Cover Image </label>
                            <p>(Uploaded image size must be less than 500KB)</p>
                            <div class="form-check image_container">
                                <input type="file" id="file_cover_image" name="file_cover_image" placeholder="" class="form-control input-md d-none" accept="image/png, image/jpeg, image/jpg" >
                                <a href="javascript:void(0)" class="fill_image_container" onclick="$('#file_cover_image').click()" title="Upload a new File">
                                    <div id="hide_center_container" class="center_container">
                                        <i class='bi bi-cloud-arrow-up-fill' style='font-size:50px'></i><br>
                                        <!-- Drag and drop your file here Or  -->
                                        Browse your file
                                    </div>
                                    <img class="row d-none" id="img_file_cover_image" src="" alt="profile picture" />
                                    <?php showProgressBar('img','file_cover_image', 'mt45'); ?>
                                </a>
                                <a href="#" class="btn btn-outline remove_file text-center d-none" id="remove_file_cover_image" onclick="removeUploadedFile('img', 'file_cover_image', 'doctoralFellowshipData'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
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

<!-- upload image 000000000000000000000000000 test  -->


<?php include_once('includes/footer.php'); ?>

<?php 
function showProgressBar($fileType, $responseId, $margin) {
    if ($fileType=='docs') {
        echo '
            <a href="#" class="btn btn-outline '.$margin.' d-none" id="view_'.$responseId.'" target="_blank">View File(<span></span>)</a>
            <a href="#" class="btn btn-outline remove_file text-center '.$margin.' d-none" id="remove_'.$responseId.'" onclick="removeUploadedFile(\''.$fileType.'\', \''.$responseId.'\', \'doctoralFellowshipData\'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
        ';
    } else {

    }
    echo '
        <span class="btn btn-outline text-center fw6 '.$margin.' d-none" id="upload_'.$responseId.'">Uploading your file</span>
        <div class="progress mx-3 p-0 progressBarContainer d-none" style="height:6px; max-width:340px;">
            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated progressBarWidth" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
    ';
}

?>

<script>
    var saveData = {};
    let file_cover_image = '';
    const fileInputCoverImage = document.getElementById('file_cover_image');
    
    fileInputCoverImage.addEventListener('change', async (event) => {
        let title = $("#title").val();
        if (title) {
            let title_key = '';
            let words = title.split(' ');
            let firstLetters = words.map(word => word.charAt(0));
            firstLetters.forEach(element => {
                title_key += element;
            });

            const file = event.target.files[0];
            if (file) {
                const encodedFile = await encodeFile(file);
                let fileData = {
                    "file" : encodedFile,
                    "file_name" : file.name,
                    "file_location" : 'assets/img/events/',
                }
                //title_key+'-'+
                uploadFile({
                    'file_type':'img', 
                    'response_id' : 'file_cover_image', 
                    'file_id' : fileInputCoverImage, 
                    'file_data' : fileData, 
                    'storage_key' : 'adminPage',
                });
            } else {
                popUpMsg('Please select a File!');
            }
        } else {
            popUpMsg('Please enter Title First!');
        }
    });

    $(function() {
        let today = new Date((new Date().getTime()-1) - (new Date().getTimezoneOffset()-1) * 60000).toISOString().split("T")[0];
        // console.log(today);
        let action = "<?php echo $action; ?>";

        // displayUploadedFile('img', 'file_approved_app_result', '<?php echo getData("file_approved_app_result") ?>');
    });

</script>