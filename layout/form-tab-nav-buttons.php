<?php
function showProgressBar($fileType, $responseId, $margin) {
    if ($fileType=='docs') {
        echo '
            <a href="#" class="btn btn-outline file_name_class_in_progressbar '.$margin.' d-none" id="view_'.$responseId.'" target="_blank">View File(<span></span>)</a>
            <a href="#" class="btn btn-outline remove_file text-center '.$margin.' d-none" id="remove_'.$responseId.'" onclick="removeUploadedFile(\''.$fileType.'\', \''.$responseId.'\', \'minorResearchProjectData\'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
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
function showNavigationButton($isBack, $backForm, $saveForm, $isNext, $nextForm) {
    echo '
        <div class="row mt-5 mb-0 nav_buttons"> 
            <p>Please review and save your changes before proceeding to the next step</p>
            <div class="col-md-12">';
            if ($isBack!=3) {
                echo '<button type="button" class="btn next_btn back_btn" onClick="openNextForm('.$isBack.', '.$backForm.');" > Back </button>';
            }
            echo '<button type="button" class="btn next_btn save_btn" onClick="saveForm('.$saveForm.');" > Save </button> ';
            if ($nextForm!='') {
                echo '<button type="button" class="btn next_btn" onClick="openNextForm('.$isNext.', '.$nextForm.');" >
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 28 28" fill="none">
                            <path d="M11.6667 19.8327L17.5 13.9993L11.6667 8.16602" stroke="#0A6EBD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> 
                    </button>';
            } else {
                echo '<button type="button" class="btn btn-primary submit_btn" onClick="submitForm();" > Submit </button>';
            }
        echo '
            </div>
        </div>
    ';
}
?>