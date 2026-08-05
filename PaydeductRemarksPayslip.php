<?php
include('connection.php');

// Clean output buffer
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: application/json; charset=utf-8');

$startdate = trim($_POST['startdateoutput'] ?? '');
$enddate   = trim($_POST['enddateoutput'] ?? '');
$empId     = trim($_POST['empId'] ?? '');

// Validate required parameters
if ($startdate === '' || $enddate === '' || $empId === '') {
    ob_end_clean();
    echo json_encode(array('items' => array(), 'total' => '0.00', 'count' => 0));
    exit;
}

// SQL query to get itemized other deductions with remarks
// Date is already in YYYY-MM-DD format in database, so direct comparison works
$sql = "SELECT amount, remarks FROM pay_otherdeductions
        WHERE (datedeleted = '' OR datedeleted IS NULL)
          AND employeeId = ?
          AND date BETWEEN ? AND ?
        ORDER BY date ASC";

$stmt = $con->prepare($sql);
if (!$stmt) {
    ob_end_clean();
    echo json_encode(array('items' => array(), 'total' => '0.00', 'count' => 0));
    exit;
}

$stmt->bind_param("sss", $empId, $startdate, $enddate);

if (!$stmt->execute()) {
    ob_end_clean();
    echo json_encode(array('items' => array(), 'total' => '0.00', 'count' => 0));
    exit;
}

$result = $stmt->get_result();
$items = array();
$total = 0;

while ($row = $result->fetch_assoc()) {
    $amount = floatval($row['amount']);
    $remark = trim($row['remarks']);
    
    // If remark is empty, set default
    if (empty($remark)) {
        $remark = "Other Deduction";
    }
    
    $items[] = array(
        'amount' => number_format($amount, 2, '.', ''),
        'remark' => $remark
    );
    
    $total += $amount;
}

$response = array(
    'items' => $items,
    'total' => number_format($total, 2, '.', ''),
    'count' => count($items)
);

$stmt->close();
$con->close();

ob_end_clean();
echo json_encode($response);
exit;
?>