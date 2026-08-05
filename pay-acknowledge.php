<?php
include('connection.php');

// Sanitize inputs
$date = mysqli_real_escape_string($con, $_POST['date']);
$empId = mysqli_real_escape_string($con, $_POST['empId']);

// Update query with prepared statement
$sql = "UPDATE pay_record SET readPayslip = '1' WHERE employeeId = ? AND date = ?";
$stmt = mysqli_prepare($con, $sql);

// FIXED: Changed parameter binding - empId should be string "s" not integer "i"
// Original had "is" which means integer then string
// Changed to "ss" which means string then string (both are strings in your database)
mysqli_stmt_bind_param($stmt, "ss", $empId, $date);

if (mysqli_stmt_execute($stmt)) {
    // ADDED: Check if any rows were actually affected
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    
    if ($affected_rows > 0) {
        echo "Record updated successfully";
    } else {
        // ADDED: Better error handling - record might not exist
        echo "No record found to update. Please ensure the payslip exists for this date.";
    }
} else {
    echo "Error updating record: " . mysqli_stmt_error($stmt);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>