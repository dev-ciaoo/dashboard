<?php
include('connection.php');

// Clean output buffers
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: text/plain; charset=utf-8');

$id = $_POST['id'] ?? '';

// ✅ ADDED: Log incoming data for debugging
error_log("pay-deletededuction.php: Received - ID=$id");

// Validate ID
if (empty($id) || !is_numeric($id)) {
    error_log("pay-deletededuction.php ERROR: Invalid ID '$id'");
    ob_end_clean();
    echo "Error: Invalid ID ($id)";
    exit;
}

// ✅ FIX: Use prepared statement and soft delete by setting datedeleted
$sql = "UPDATE pay_otherdeductions SET datedeleted = NOW() WHERE id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    error_log("pay-deletededuction.php SQL PREPARE ERROR: " . $con->error);
    ob_end_clean();
    echo "Error: Database error - " . $con->error;
    exit;
}

$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        error_log("pay-deletededuction.php ✅ SUCCESS: Deleted ID=$id");
        ob_end_clean();
        echo "Success: Record marked as deleted";
    } else {
        error_log("pay-deletededuction.php WARNING: No rows affected (ID=$id) - Record may not exist or already deleted");
        ob_end_clean();
        echo "Error: No record found with ID=$id or already deleted";
    }
} else {
    error_log("pay-deletededuction.php ❌ EXECUTE ERROR: " . $stmt->error);
    ob_end_clean();
    echo "Error: Failed to delete - " . $stmt->error;
}

$stmt->close();
$con->close();
exit;
?>