<?php
include('connection.php');

$remarks = $_POST['remarks'];
$date = $_POST['date'];

// Prepare and bind
$stmt = $con->prepare("UPDATE pay_selecteddate SET remarks = ? WHERE selectedDate = ?");
if ($stmt === false) {
    die("Prepare failed: " . $con->error);
}

$stmt->bind_param("ss", $remarks,$date); // "d" denotes double, "s" denotes string

// Execute the statement
if ($stmt->execute() === false) {
    die("Execute failed: " . $stmt->error);
} else {
    echo "Record updated successfully";
}

// Close statement and connection
$stmt->close();

?>