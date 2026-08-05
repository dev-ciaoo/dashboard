<?php
if (isset($_GET['id']) && isset($_GET['fileName'])) {
    $id = $_GET['id'];
    $fileName = $_GET['fileName'];
    
    // Define the file path
    $filePath = "./blotterforms/" . $fileName; // Adjust the directory path accordingly

    if (file_exists($filePath)) {
        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "File not found!";
    }
} else {
    echo "Invalid request!";
}
?>
