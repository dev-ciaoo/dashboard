<?php
include('connection.php');

// Clean output buffer completely
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: text/plain; charset=utf-8');

$startdate = trim($_POST['startdateoutput'] ?? '');
$enddate   = trim($_POST['enddateoutput'] ?? '');
$empId     = trim($_POST['empId'] ?? '');

// ✅ ADD: Detailed logging
error_log("====================================");
error_log("paydeduct.php called");
error_log("Employee ID: $empId");
error_log("Start Date: $startdate");
error_log("End Date: $enddate");

// Validate required parameters
if ($startdate === '' || $enddate === '' || $empId === '') {
    error_log("paydeduct.php ERROR: Missing parameters");
    ob_end_clean();
    echo "0.00";
    exit;
}

// ✅ FIX: Correct column name is 'amount' and use proper date comparison
$sql = "
    SELECT COALESCE(SUM(CAST(amount AS DECIMAL(10,2))), 0) AS total_amount
    FROM pay_otherdeductions
    WHERE (datedeleted = '' OR datedeleted IS NULL)
      AND employeeId = ?
      AND STR_TO_DATE(date, '%Y-%m-%d') BETWEEN STR_TO_DATE(?, '%Y-%m-%d') AND STR_TO_DATE(?, '%Y-%m-%d')
";

error_log("SQL Query: " . $sql);

$stmt = $con->prepare($sql);
if (!$stmt) {
    error_log("paydeduct.php SQL Prepare Error: " . $con->error);
    ob_end_clean();
    echo "0.00";
    exit;
}

$stmt->bind_param("sss", $empId, $startdate, $enddate);

if (!$stmt->execute()) {
    error_log("paydeduct.php SQL Execute Error: " . $stmt->error);
    ob_end_clean();
    echo "0.00";
    exit;
}

$stmt->bind_result($total_amount);
$stmt->fetch();

// ✅ ADD: Log the result
error_log("Total Amount Found: " . $total_amount);

$stmt->close();
$con->close();

// Clean buffer and output only the number
ob_end_clean();
$result = number_format((float)$total_amount, 2, '.', '');
error_log("Returning: " . $result);
error_log("====================================");

echo $result;
exit;
?>