
<!-- Modal -->
<div class="modal fade" id="uploadFormApplicationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uploadFormApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content upload_application">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFormApplicationModalLabel">Application Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="file_application_form_field">
                <label for="file_application_form" class="form-label star">Upload scanned copy of Application Form</label>
                <div class="form-check" style="padding-left: 0;">
                    <input type="file" id="file_application_form" name="file_application_form" placeholder="" class="form-control input-md" accept="application/pdf">
                </div>
                <p>Attach a scanned PDF copy of max 5MB</p>
                
                <a href="#" class="btn btn-outline d-none" id="view_file_application_form" target="_blank">View File(<span></span>)</a>
                <a href="#" class="btn btn-outline remove_file text-center d-none" id="remove_file_application_form" onclick="removeUploadedFile('docs', 'file_application_form', '<?php echo $localStorageKey ?>'); return false;" title="Remove File" ><i class="bi bi-trash custom_btn btn2"></i></a>
                <span class="btn btn-outline text-center fw6 d-none" id="upload_file_application_form">Uploading your file</span></br>
                <div class="progress mx-3 p-0 progressBarContainer d-none" style="height:6px; max-width:340px;">
                    <div class="progress-bar progress-bar-striped bg-info progress-bar-animated progressBarWidth" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>

            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary apply_btn my-3" id="submit_app_btn" onclick="submitApplication()" DISABLED>SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadFormResponseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uploadFormResponseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content upload_application">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFormResponseModalLabel">Application Submitted Successfully</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="file_application_form_field">
                <h4 style="color:green; ">
                    THANK YOU for your APPLICATION
                </h4>
                <p>
                    We will review your application and get back to you shortly.
                </p>
            </div>
        </div>
    </div>
</div>