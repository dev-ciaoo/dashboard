<?php
include('connection.php');

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Unknown error'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

// Get POST data
$id      = $_POST['reqId'];
$rRemark = $_POST['rRemark'];

date_default_timezone_set('Asia/Manila');
$approver  = $_SESSION['username'] ?? 'System';
$dateToday = date('Y-m-d H:i:s');

/* 🔒 Prevent double rejection or approval */
$check = $con->prepare("SELECT iStatus FROM leavetbl WHERE id = ?");
$check->bind_param("i", $id);
$check->execute();
$current = $check->get_result()->fetch_assoc();

if ($current && ($current['iStatus'] == 2 || $current['iStatus'] == 3)) {
    echo json_encode([
        'status' => 'warning',
        'message' => 'This request has already been processed.'
    ]);
    exit;
}

/* Reject leave */
$iStatus = 3; // 3 = Rejected
$iAbsent = 0;

$stmt = $con->prepare("
    UPDATE leavetbl SET
        iStatus = ?,
        iRemarks = ?,
        timeApproved = ?,
        approver = ?,
        iAbsent = ?
    WHERE id = ?
");
$stmt->bind_param("issssi", $iStatus, $rRemark, $dateToday, $approver, $iAbsent, $id);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Leave request has been rejected.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to reject leave request.'
    ]);
}
