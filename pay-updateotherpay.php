<?php
include('connection.php');

// Clean output buffer
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: application/json; charset=utf-8');

// Enable error logging
error_log("====================================");
error_log("pay-updateotherpay.php called");
error_log("POST data: " . print_r($_POST, true));

if(isset($_POST['id']) && isset($_POST['field']) && isset($_POST['value'])) {
    $id = intval($_POST['id']);
    $field = $_POST['field'];
    $value = trim($_POST['value']);
    
    // Whitelist validation
    $allowed_fields = ['date', 'amount', 'remarks'];
    if(!in_array($field, $allowed_fields, true)) {
        error_log("Invalid field: $field");
        ob_end_clean();
        echo json_encode(['success' => false, 'error' => 'Invalid field']);
        exit;
    }
    
    // Validate ID
    if($id <= 0) {
        error_log("Invalid ID: $id");
        ob_end_clean();
        echo json_encode(['success' => false, 'error' => 'Invalid ID']);
        exit;
    }
    
    // Handle different data types
    if($field === 'amount') {
        // For amount: clean and convert to decimal
        $value = floatval(str_replace(',', '', $value));
        $sql = "UPDATE pay_otherpayment SET `$field` = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        
        if (!$stmt) {
            error_log("Prepare failed: " . $con->error);
            ob_end_clean();
            echo json_encode(['success' => false, 'error' => $con->error]);
            exit;
        }
        
        $stmt->bind_param("di", $value, $id);
    } else {
        // For date and remarks: use string
        $sql = "UPDATE pay_otherpayment SET `$field` = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        
        if (!$stmt) {
            error_log("Prepare failed: " . $con->error);
            ob_end_clean();
            echo json_encode(['success' => false, 'error' => $con->error]);
            exit;
        }
        
        $stmt->bind_param("si", $value, $id);
    }
    
    if($stmt->execute()) {
        if($stmt->affected_rows > 0) {
            error_log("✅ Updated successfully: ID=$id, Field=$field, Value=$value");
            ob_end_clean();
            echo json_encode(['success' => true, 'message' => 'Updated successfully']);
        } else {
            error_log("⚠️ No rows affected - ID might not exist: $id");
            ob_end_clean();
            echo json_encode(['success' => false, 'error' => 'No rows updated']);
        }
    } else {
        error_log("❌ Query failed: " . $stmt->error);
        ob_end_clean();
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    
    $stmt->close();
} else {
    error_log("Missing parameters: " . print_r($_POST, true));
    ob_end_clean();
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
}

$con->close();
error_log("====================================");
exit;
?>