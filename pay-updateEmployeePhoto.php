<?php
include('connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploadedFile'])) {
    $targetDir = "photo/"; // Specify the folder where you want to save the uploaded file
    $fileName = pathinfo($_FILES["uploadedFile"]["name"], PATHINFO_FILENAME);
    $empId = isset($_POST['empId']) ? $_POST['empId'] : '';
    $fileExtension = strtolower(pathinfo($_FILES["uploadedFile"]["name"], PATHINFO_EXTENSION));
    $targetFile = $targetDir . $fileName . "." . $fileExtension;

    $counter = 1;
    while (file_exists($targetFile)) {
        $targetFile = $targetDir . $fileName . "_" . $counter . "." . $fileExtension;
        $counter++;
    }

    // Check file size (optional)
    if ($_FILES["uploadedFile"]["size"] > 500000) { // Limit to 500KB
        echo "Sorry, your file is too large.";
        exit;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png"];
    if (!in_array($fileExtension, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        exit;
    }

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully: " . $targetFile;
        echo "Employee ID: " . htmlspecialchars($empId);
        $sql = "UPDATE accounts SET userAvatar = '$targetFile' WHERE employeeId = '$empId'";

        if ($con->query($sql) === TRUE) {
            if ($con->affected_rows > 0) {
                echo "Record updated successfully.";
            } else {
                echo "No record was updated. Check if the employeeId exists.";
            }
        } else {
            echo "Error updating record: " . $con->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file uploaded or invalid request.";
}
?>
