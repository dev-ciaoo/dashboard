<?php
$targetDir = './workshop/video/general-monthly/March'; // Directory where videos will be stored
$response = ['success' => false, 'uploadedFiles' => [], 'error' => ''];

if (isset($_FILES['videos'])) {
    foreach ($_FILES['videos']['name'] as $key => $name) {
        $targetFile = $targetDir . basename($_FILES['videos']['name'][$key]);
        
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['videos']['tmp_name'][$key], $targetFile)) {
            $response['uploadedFiles'][] = $_FILES['videos']['name'][$key];
        } else {
            $response['error'] = 'Failed to upload ' . $_FILES['videos']['name'][$key];
            break;
        }
    }
    
    if (empty($response['error'])) {
        $response['success'] = true;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
