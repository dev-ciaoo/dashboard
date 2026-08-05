<?php
// pay-adddate.php
include('connection.php'); // Ensure this file exists and defines $con

header('Content-Type: application/json');

// =======================================================
// 1. ACKNOWLEDGEMENT HANDLER: Updates status to '1'
//    ***FIXED to use payslipId instead of selectedDate***
// =======================================================
if (isset($_POST['acknowledgement'], $_POST['payslipId'])) {
    $payslipId = mysqli_real_escape_string($con, $_POST['payslipId']); 
    $ackStatus = '1'; 

    // **IMPORTANT:** Replace `id` in the WHERE clause below with the actual name
    // of the unique ID column in your `pay_selecteddate` table (e.g., `payslip_id`).
// In pay-adddate.php
$sql = "UPDATE pay_selecteddate 
            SET `status` = '$ackStatus'
            WHERE `selectedDate` = '$ackDate'
        AND `readPayslip` <> '1'"; // This line ensures the update only runs if status isn't already 1

    $result = mysqli_query($con, $sql);
    
    if ($result && mysqli_affected_rows($con) > 0) {
        // Success: Row updated.
        echo json_encode(['success' => true, 'message' => 'Payslip acknowledged successfully.']);
    } else {
        // Failure: Query failed, or zero rows matched (ID mismatch, or status was already 1).
        echo json_encode(['success' => false, 'message' => 'Error: Update failed. Record not found or status already set. Detail:  ' . $payslipId . mysqli_error($con)]);
    }
    
    exit; 
}
// =======================================================


// =======================================================
// 2. DATE RANGE INSERT/UPDATE LOGIC 
// (UNCHANGED from your original file)
// =======================================================
if (isset($_POST['modifiedDate'], $_POST['formattedDate'], $_POST['selectedStartDate'], $_POST['selectedEndDate'])) {
    $formattedDate = mysqli_real_escape_string($con, $_POST['formattedDate']);
    $selectedStartDate = mysqli_real_escape_string($con, $_POST['selectedStartDate']);
    $selectedEndDate = mysqli_real_escape_string($con, $_POST['selectedEndDate']);
    $addedDate = mysqli_real_escape_string($con, $_POST['modifiedDate']);
    $defaultStatus = '0'; // Sets default status to unacknowledged

    $query = "SELECT * FROM pay_selecteddate WHERE `selectedDate` = '$addedDate'";
    $result1 = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result1) > 0) {
        // UPDATE existing record
        $sql = "UPDATE pay_selecteddate SET `date` = '$formattedDate', `startdate` = '$selectedStartDate', `enddate` = '$selectedEndDate' WHERE `selectedDate` = '$addedDate'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Record updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating record: ' . mysqli_error($con)]);
        }
    } else {
        // INSERT new record: Includes `status` column with default '0'.
        $sql = "INSERT INTO pay_selecteddate (`selectedDate`, `date`, `startdate`, `enddate`, `status`) VALUES ('$addedDate', '$formattedDate', '$selectedStartDate', '$selectedEndDate', '$defaultStatus')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'New record inserted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error inserting record: ' . mysqli_error($con)]);
        }
    }
} else {
    if (!isset($_POST['acknowledgement'])) {
        echo json_encode(['success' => false, 'message' => 'Missing POST variables']);
    }
}
?> 




 
