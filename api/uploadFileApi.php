<?php
	session_start();
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    include '../vendor/autoload.php'; 
    use setasign\Fpdi\Fpdi;
    use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
    use setasign\Fpdi\PdfParser\PdfParserException;
    use setasign\Fpdi\PdfReader\PdfReaderException;

	$postData = json_decode(file_get_contents("php://input"), true);

	$now = new DateTime();
	$getDate = $now->format('Y-m-d H:i:s');    
	
    $encodedFileContent = $postData["file"];
    $filename = $postData["file_name"];
    $fileLocation  = isset($postData["file_location"]) ? $postData["file_location"] : '';

    // Replace this with your file name
    $fileExtension = '';
    // Find the position of the last dot (file extension)
    $lastDotPosition = strrpos($filename, '.');
    // Check if a dot was found
    if ($lastDotPosition !== false) {
        // Separate the file name and extension
        $fileExtension = substr($filename, $lastDotPosition);
        $fileNameWithoutExtension = substr($filename, 0, $lastDotPosition);
        // Replace dots in the file name (excluding the last one)
        $fileNameWithoutExtension = str_replace('.', '_', $fileNameWithoutExtension);
        // Recombine the file name and extension
        $newFilename = $fileNameWithoutExtension . $fileExtension;
    } else {
        // No dot found; the file name has no extension
        $newFilename = $filename;
    }
    $newFilename = str_replace(" ","_", $newFilename);

    $filePath = '';
    $message = 'The PDF you tried to upload is in a format that isn\'t supported. To fix this, you\'ll need to create the PDF file again using a different method or software.';
    $error_message = '';
    $status = '500';
    if ($encodedFileContent) {
        $decodedFileContent = base64_decode($encodedFileContent);
        // Save the file to the server
        if ($fileLocation && $fileLocation=="admin") {
            $filePath = 'assets/documents/approved-schemes/'.$filename;
        } else if ($fileLocation) {
            $filePath = $fileLocation.$filename;
        } else {
            $filePath = 'uploads/'.uniqid().'-'.$newFilename;
        }
        file_put_contents('../'.$filePath, $decodedFileContent);

        if ($fileExtension=='.pdf') {
            try {
                $pdf = new FPDI();
                $pageCount = $pdf->setSourceFile('../'.$filePath);
                $error_message = "The PDF is not encrypted and has $pageCount pages.";
                $message = "success";
                $status = '200';
            } catch (PdfReaderException $e) {
                $error_message = "The PDF is encrypted or not readable. Error: " . $e->getMessage();
            } catch (PdfParserException $e) {
                $error_message = "The PDF parsing failed. Error: " . $e->getMessage();
            } catch (CrossReferenceException $e) {
                $error_message = "Cross reference error in the PDF. Error: " . $e->getMessage();
            } catch (Exception $e) {
                $error_message = "An unexpected error occurred. Error: " . $e->getMessage();
            }
        } else {
            $message = "success";
            $status = '200';
        }
    } 
    // echo $filePath;
    echo json_encode(['flag'=>true, 'status'=>$status, 'message'=>$message, 'error-message'=>$error_message, 'data'=>$filePath]);
?>