<?php
// pay-publishpayslip.php
// Called via AJAX to publish (or unpublish) payslip visibility for a payroll date.
// Only executes if the record is already both approved AND verified (freeze lock rules).

try {
include('connection.php');

$date   = mysqli_real_escape_string($con, $_POST['date']   ?? '');
$action = mysqli_real_escape_string($con, $_POST['action'] ?? 'publish'); // 'publish' | 'unpublish'

if (empty($date)) {
    echo json_encode(['success' => false, 'message' => 'Date is required.']);
    exit;
}

// Safety check: only allow publish if record is approved AND verified
$checkSql = "SELECT approved, verified, payslipPublished
                FROM pay_selecteddate
                WHERE date = '$date' OR selectedDate = '$date'
                LIMIT 1";
$checkResult = mysqli_query($con, $checkSql);

if (!$checkResult || mysqli_num_rows($checkResult) === 0) {
    echo json_encode(['success' => false, 'message' => 'Payroll date not found.']);
    exit;
}

$row = mysqli_fetch_assoc($checkResult);

if ($row['approved'] != '1' || $row['verified'] != '1') {
    echo json_encode([
        'success' => false,
        'message' => 'Payroll must be approved and verified before publishing.'
    ]);
    exit;
}

$newValue = ($action === 'unpublish') ? 0 : 1;

$updateSql = "UPDATE pay_selecteddate
                SET payslipPublished = $newValue
                WHERE date = '$date' OR selectedDate = '$date'";

$updateResult = mysqli_query($con, $updateSql);

if ($updateResult) {
    $label = $newValue === 1 ? 'Published' : 'Unpublished';
    echo json_encode([
        'success'   => true,
        'published' => $newValue,
        'message'   => "Payslip $label successfully."
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . mysqli_error($con)
    ]);
}

} catch (Exception $e) {
echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>