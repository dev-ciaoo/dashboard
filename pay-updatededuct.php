<?php
include('connection.php');

// Clean output buffers
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: application/json; charset=utf-8');

$field = $_POST['field'] ?? '';
$value = $_POST['value'] ?? '';
$id = $_POST['id'] ?? '';

// ✅ ENHANCED LOGGING
$logFile = 'deduct_debug.log';
file_put_contents($logFile, 
    date('Y-m-d H:i:s') . " - RECEIVED: ID=$id, Field=$field, Value=$value\n", 
    FILE_APPEND
);

// Validate inputs
if (empty($field) || empty($id)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

// Whitelist allowed fields
$allowed_fields = ['date', 'amount', 'remarks'];
if (!in_array($field, $allowed_fields)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'error' => 'Invalid field name']);
    exit;
}

// Validate and format amount
if ($field === 'amount') {
    if (!is_numeric($value)) {
        ob_end_clean();
        echo json_encode(['success' => false, 'error' => 'Amount must be numeric']);
        exit;
    }
    $value = number_format((float)$value, 2, '.', '');
}

// Validate date format
if ($field === 'date') {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        ob_end_clean();
        echo json_encode(['success' => false, 'error' => 'Invalid date format']);
        exit;
    }
}

// Check if record exists
$check_sql = "SELECT id, `$field` FROM pay_otherdeductions WHERE id = ?";
$check_stmt = $con->prepare($check_sql);
$check_stmt->bind_param('i', $id);
$check_stmt->execute();
$check_stmt->bind_result($found_id, $current_value);
$check_stmt->fetch();
$check_stmt->close();

if (!$found_id) {
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - ERROR: Record ID=$id not found\n", FILE_APPEND);
    ob_end_clean();
    echo json_encode(['success' => false, 'error' => 'Record not found']);
    exit;
}

// Log current value
file_put_contents($logFile, 
    date('Y-m-d H:i:s') . " - CURRENT VALUE: $current_value -> NEW VALUE: $value\n", 
    FILE_APPEND
);

// Update the record
$sql = "UPDATE pay_otherdeductions SET `$field` = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - SQL ERROR: " . $con->error . "\n", FILE_APPEND);
    ob_end_clean();
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $con->error]);
    exit;
}

$stmt->bind_param('si', $value, $id);

if ($stmt->execute()) {
    $affected = $stmt->affected_rows;
    file_put_contents($logFile, 
        date('Y-m-d H:i:s') . " - AFFECTED ROWS: $affected\n", 
        FILE_APPEND
    );
    
    ob_end_clean();
    echo json_encode([
        'success' => true, 
        'message' => "Updated $field to $value",
        'affected_rows' => $affected
    ]);
} else {
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - EXECUTE ERROR: " . $stmt->error . "\n", FILE_APPEND);
    ob_end_clean();
    echo json_encode(['success' => false, 'error' => 'Failed to execute: ' . $stmt->error]);
}

$stmt->close();
$con->close();
exit;
?>