// submit form applications
const fileApplicationForm = document.getElementById('file_application_form');
fileApplicationForm.addEventListener('change', async (event) => {
    const file = event.target.files[0];
    if (file) {
        const encodedFile = await encodeFile(file);
        let fileData = {
            "file": encodedFile,
            "file_name": file.name,
        }
        uploadFile({
            'file_type' : 'docs',
            'response_id' : 'file_application_form',
            'file_id' : fileApplicationForm,
            'file_data' : fileData,
            'storage_key' : 'doctoralFellowshipData',
            'max_file_upload_size' : 5
        });
    } else {
        popUpMsg('Please select a File!');
    }
});