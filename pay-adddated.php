<?php
include('connection.php');

if (isset($_FILES["csvFile"])) {
    $targetDir = "uploads/"; // Ensure this directory exists
    $originalFileName = basename($_FILES["csvFile"]["name"]);
    $targetFile = $targetDir . $originalFileName;

    if (move_uploaded_file($_FILES["csvFile"]["tmp_name"], $targetFile)) {
        // Send success response
        echo json_encode([
            "status" => "success",
            "message" => "The file '$originalFileName' has been uploaded."
        ]);
    } else {
        // Send error response
        echo json_encode([
            "status" => "error",
            "message" => "File upload failed."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No file received."
    ]);
}
?>
