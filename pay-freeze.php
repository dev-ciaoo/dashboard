<?php
include('connection.php');

if (!isset($_POST['date']) || empty($_POST['date'])) {
    echo "error: no date provided";
    exit;
}

$date = mysqli_real_escape_string($con, $_POST['date']);

// ============================================================
// AUTO-CREATE pay_record_frozen if it does not exist yet
// ============================================================
$createTable = "CREATE TABLE IF NOT EXISTS `pay_record_frozen` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `date` varchar(100) NOT NULL,
    `employeeId` varchar(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `branch` varchar(100) NOT NULL,
    `basicpay` varchar(100) NOT NULL,
    `transpo` varchar(100) NOT NULL,
    `riceallow` varchar(100) NOT NULL,
    `overtime` varchar(100) NOT NULL,
    `otherpay` varchar(100) NOT NULL,
    `sss` varchar(100) NOT NULL,
    `sssmand` varchar(100) NOT NULL,
    `pagibig` varchar(100) NOT NULL,
    `philhealth` varchar(100) NOT NULL,
    `sssloan` varchar(100) NOT NULL,
    `ssscalamity` varchar(100) NOT NULL,
    `pagibigloan` varchar(100) NOT NULL,
    `pagibigcalamity` varchar(100) NOT NULL,
    `emploan` varchar(100) NOT NULL,
    `withholdingtax` varchar(100) NOT NULL,
    `absent` varchar(100) NOT NULL,
    `late` varchar(100) NOT NULL,
    `otherdeduction` varchar(100) NOT NULL,
    `totalearning` varchar(100) NOT NULL,
    `totaldeduction` varchar(100) NOT NULL,
    `netsalary` varchar(100) NOT NULL,
    `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
    `sssEmployer` varchar(100) DEFAULT '0',
    `sssmandEmployer` varchar(100) DEFAULT '0',
    `pagibigEmployer` varchar(100) DEFAULT '0',
    `philhealthEmployer` varchar(100) DEFAULT '0',
    `readPayslip` varchar(50) DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if (!$con->query($createTable)) {
    echo "error: could not create table - " . $con->error;
    $con->close();
    exit;
}

// ============================================================
// Check if already frozen for this payroll date — never overwrite
// ============================================================
$checkSql  = "SELECT id FROM pay_record_frozen WHERE date = ? LIMIT 1";
$checkStmt = $con->prepare($checkSql);
if (!$checkStmt) {
    echo "error: prepare failed - " . $con->error;
    $con->close();
    exit;
}
$checkStmt->bind_param("s", $date);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$checkStmt->close();

if ($checkResult && mysqli_num_rows($checkResult) > 0) {
    echo "already_frozen";
    $con->close();
    exit;
}

// ============================================================
// Verify pay_record has data for this date before copying
// ============================================================
$countSql  = "SELECT COUNT(*) as total FROM pay_record WHERE date = ?";
$countStmt = $con->prepare($countSql);
$countStmt->bind_param("s", $date);
$countStmt->execute();
$countResult = $countStmt->get_result();
$countRow    = $countResult->fetch_assoc();
$countStmt->close();

if ($countRow['total'] == 0) {
    echo "error: no records in pay_record for date=" . $date;
    $con->close();
    exit;
}

// ============================================================
// Copy ALL records for this date from pay_record to pay_record_frozen
// One-time snapshot — frozen forever after this
// ============================================================
$copySql = "INSERT INTO pay_record_frozen 
            (date, employeeId, name, branch, basicpay, riceallow, transpo, otherpay, overtime,
             sssmand, sss, pagibig, philhealth, sssloan, ssscalamity, pagibigloan, pagibigcalamity,
             emploan, withholdingtax, absent, late, otherdeduction, totalearning, totaldeduction,
             netsalary, sssEmployer, sssmandEmployer, pagibigEmployer, philhealthEmployer, readPayslip)
            SELECT 
             date, employeeId, name, branch, basicpay, riceallow, transpo, otherpay, overtime,
             sssmand, sss, pagibig, philhealth, sssloan, ssscalamity, pagibigloan, pagibigcalamity,
             emploan, withholdingtax, absent, late, otherdeduction, totalearning, totaldeduction,
             netsalary, sssEmployer, sssmandEmployer, pagibigEmployer, philhealthEmployer, readPayslip
            FROM pay_record
            WHERE date = ?";

$copyStmt = $con->prepare($copySql);
if (!$copyStmt) {
    echo "error: copy prepare failed - " . $con->error;
    $con->close();
    exit;
}
$copyStmt->bind_param("s", $date);

if ($copyStmt->execute()) {
    echo "frozen:" . $copyStmt->affected_rows;
} else {
    echo "error: copy failed - " . $copyStmt->error;
}

$copyStmt->close();
$con->close();
?>