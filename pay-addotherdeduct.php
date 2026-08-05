<?php
include('connection.php');

// Clean ALL output buffers
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: text/plain; charset=utf-8');

// Validate required fields
if(!isset($_POST['field']) || !isset($_POST['value']) || !isset($_POST['empid']) || !isset($_POST['name'])) {
    ob_end_clean();
    echo "0";
    error_log("pay-addotherdeduct.php: Missing required fields");
    exit;
}

$fieldNames = $_POST['field'];
$cellValues = $_POST['value'];
$name = mysqli_real_escape_string($con, $_POST['name']);
$empid = mysqli_real_escape_string($con, $_POST['empid']);
$position = isset($_POST['position']) ? mysqli_real_escape_string($con, $_POST['position']) : '';
$branch = isset($_POST['branch']) ? mysqli_real_escape_string($con, $_POST['branch']) : '';

// ✅ FIX: Build SQL with ALL required columns including name, position, branch
$sql = "INSERT INTO pay_otherdeductions (name, employeeId, position, branch, datedeleted, ";
$sql .= implode(", ", array_map(function($field) use ($con) {
    return mysqli_real_escape_string($con, $field);
}, $fieldNames));
$sql .= ") VALUES (?, ?, ?, ?, '', ";

// Placeholders for dynamic fields
$placeholders = array_fill(0, count($fieldNames), "?");
$sql .= implode(", ", $placeholders);
$sql .= ")";

$stmt = $con->prepare($sql);

if (!$stmt) {
    error_log("pay-addotherdeduct.php SQL Error: " . $con->error);
    error_log("SQL: " . $sql);
    ob_end_clean();
    echo "0";
    exit;
}

// ✅ FIX: Correct bind_param - 4 fixed fields (name, empid, position, branch) + dynamic fields
$types = str_repeat("s", 4 + count($cellValues));
$params = array_merge([$name, $empid, $position, $branch], $cellValues);

$stmt->bind_param($types, ...$params);

// Execute and get the new ID
if ($stmt->execute() && $stmt->affected_rows > 0) {
    $last_id = $con->insert_id;
    
    // ✅ CRITICAL: Clean output buffer before echoing
    ob_end_clean();
    echo $last_id;
    
    error_log("pay-addotherdeduct.php SUCCESS: ID=$last_id, EmpID=$empid, Name=$name");
} else {
    error_log("pay-addotherdeduct.php FAILED: " . $stmt->error);
    error_log("Affected Rows: " . $stmt->affected_rows);
    
    ob_end_clean();
    echo "0";
}

$stmt->close();
$con->close();
exit;
?>