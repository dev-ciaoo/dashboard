<?php
include('connection.php');

// Retrieve and sanitize input
$newtotalOT = isset($_GET['newtotalOT']) ? mysqli_real_escape_string($con, $_GET['newtotalOT']) : '';
$newremarks = isset($_GET['newremarks']) ? mysqli_real_escape_string($con, $_GET['newremarks']) : '';
$newkindOT = isset($_GET['newkindOT']) ? mysqli_real_escape_string($con, $_GET['newkindOT']) : '';
$id = isset($_GET['id']) ? mysqli_real_escape_string($con, $_GET['id']) : '';

// Input validation
if (!is_numeric($id) || !is_numeric($newtotalOT)) {
    echo "Invalid input.";
    exit();
}

// Prepare the SQL statement
$sql = "UPDATE leavetbl SET `totalHours` = ?, `iRemarks` = ?, `kindOT` = ? WHERE `id` = ?";

// Prepare and bind
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'dssi', $newtotalOT, $newremarks,$newkindOT, $id);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    echo "Data updated in leavetbl table successfully.<br>";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
