<?php
include('connection.php');

$totalBasicPay = $_POST['totalBasicPay'];
$totalNetPay = $_POST['totalNetPay'];
$date = $_POST['date'];

// Validate inputs
if (!is_numeric($totalBasicPay) || !is_numeric($totalNetPay) || empty($date)) {
    die("Invalid input");
}

// Prepare and bind
$stmt = $con->prepare("UPDATE pay_selecteddate SET totalRegularPay = ?, totalNetPay = ? WHERE selectedDate = ?");
if ($stmt === false) {
    die("Prepare failed: " . $con->error);
}

$stmt->bind_param("dds", $totalBasicPay, $totalNetPay, $date); // 
// Execute the statement
if ($stmt->execute() === false) {
    die("Execute failed: " . $stmt->error);
} else {
    echo "Record updated successfully";
}

// Close statement and connection
$stmt->close();

?>