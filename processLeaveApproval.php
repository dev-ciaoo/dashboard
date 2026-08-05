<?php
include('connection.php');

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Unknown error'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

$id        = $_POST['reqId'];
$userID    = $_POST['userID'];
$rCategory = $_POST['rCategory'];
$rPosition = $_POST['rPosition'];
$rStatus   = $_POST['rStatus'];
$day       = $_POST['kindDay'];
$dateFrom  = $_POST['rdateFrom'];
$dateTo    = $_POST['rdateTo'];
$rRemark   = $_POST['rRemark'];

date_default_timezone_set('Asia/Manila');
$approver  = $_SESSION['username'];
$dateToday = date('Y-m-d H:i:s');

/* 🔒 PREVENT DOUBLE APPROVAL */
$check = $con->prepare("SELECT iStatus FROM leavetbl WHERE id = ?");
$check->bind_param("i", $id);
$check->execute();
$current = $check->get_result()->fetch_assoc();

if ($current && $current['iStatus'] == 2) {
    echo json_encode([
        'status' => 'warning',
        'message' => 'This request is already approved.'
    ]);
    exit;
}

/* Working days */
function workingDays($start, $end) {
    $days = 0;
    for ($i = strtotime($start); $i <= strtotime($end); $i += 86400) {
        if (date("N", $i) <= 5) $days++;
    }
    return $days;
}

$startDate   = date('Y-m-d', strtotime($dateFrom));
$endDate     = date('Y-m-d', strtotime($dateTo));
$workingDays = workingDays($startDate, $endDate);

/* 🔒 FINAL DEDUCTION VALUE */
$deductDays = $workingDays;

if ($day === 'Half Day' && $startDate === $endDate) {
    $deductDays = 0.5;
}

if ($rCategory === 'Overtime' || $rCategory === 'Official Business') {
    $deductDays = 0;
}

/* Fetch balances */
$stmt = $con->prepare("SELECT VL, SL, ML, EL, PT, MT, UL FROM accounts WHERE userId = ?");
$stmt->bind_param("s", $userID);
$stmt->execute();
$bal = $stmt->get_result()->fetch_assoc();

/* APPROVAL */
$iStatus = 2;
$iAbsent = 1;

switch ($rCategory) {
    case 'Vacation Leave':
        if ($bal['VL'] < $deductDays) break;
        $sql2 = "UPDATE accounts SET VL = VL - $deductDays WHERE userId = '$userID'";
        break;

    case 'Sick Leave':
        if ($bal['SL'] < $deductDays) break;
        $sql2 = "UPDATE accounts SET SL = SL - $deductDays WHERE userId = '$userID'";
        break;

    case 'Mandatory Leave':
        if ($bal['ML'] < $deductDays) break;
        $sql2 = "UPDATE accounts SET ML = ML - $deductDays WHERE userId = '$userID'";
        break;

    case 'Emergency Leave':
        // if ($rPosition == 'Staff' && $rStatus == 1) {
        //     $stmt = $con->prepare("
        //         UPDATE leavetbl 
        //         SET iStatus = 4, timeApproved = ?, approver = ?
        //         WHERE id = ?
        //     ");
        //     $stmt->bind_param("ssi", $dateToday, $approver, $id);
        //     $stmt->execute();

        //     echo json_encode([
        //         'status' => 'success',
        //         'message' => 'Emergency leave approved (forwarded).'
        //     ]);
        //     exit;
        // }
        $sql2 = "UPDATE accounts SET EL = EL - $deductDays WHERE userId = '$userID'";
        break;

    case 'Paternity Leave':
        $sql2 = "UPDATE accounts SET PT = PT - $deductDays WHERE userId = '$userID'";
        break;

    case 'Maternity Leave':
        $sql2 = "UPDATE accounts SET MT = MT - $deductDays WHERE userId = '$userID'";
        break;

    case 'Unpaid Leave':
        $sql2 = "UPDATE accounts SET UL = UL + $deductDays WHERE userId = '$userID'";
        break;
}

if (isset($sql2)) {
    mysqli_query($con, $sql2);
}

/* FINAL UPDATE */
mysqli_query($con, "
    UPDATE leavetbl SET
        workingDays = '$deductDays',
        iStatus = '$iStatus',
        iRemarks = '$rRemark',
        timeApproved = '$dateToday',
        approver = '$approver',
        iAbsent = '$iAbsent'
    WHERE id = '$id'
");

$response = [
    'status' => 'success',
    'message' => 'Leave Successfully Approved.'
];

echo json_encode($response);
