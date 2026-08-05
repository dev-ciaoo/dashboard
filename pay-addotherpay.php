<?php
include('connection.php');

// Clean output buffer completely
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: text/plain; charset=utf-8');

error_log("====================================");
error_log("pay-addotherpay.php called");
error_log("POST data: " . print_r($_POST, true));

if(isset($_POST['field']) && isset($_POST['value'])) {
    $fieldNames = $_POST['field'];
    $cellValues = $_POST['value'];
    $name = trim($_POST['name'] ?? '');
    $empid = trim($_POST['empid'] ?? '');

    // Validate required fields
    if (empty($name) || empty($empid)) {
        error_log("Missing name or empid");
        ob_end_clean();
        echo "0";
        exit;
    }

    $sql = "INSERT INTO pay_otherpayment (name, employeeId, ";
    $sql .= implode(", ", $fieldNames);
    $sql .= ") VALUES (?, ?, ";
    $placeholders = array_fill(0, count($fieldNames), "?");
    $sql .= implode(", ", $placeholders);
    $sql .= ")";

    error_log("SQL Query: " . $sql);

    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        error_log("Prepare failed: " . $con->error);
        ob_end_clean();
        echo "0";
        exit;
    }

    $types = "ss" . str_repeat("s", count($cellValues));
    $stmt->bind_param($types, $name, $empid, ...$cellValues);
    
    if ($stmt->execute()) {
        if($stmt->affected_rows > 0) {
            $last_id = $con->insert_id;
            error_log("✅ Inserted successfully. New ID: $last_id");
            ob_end_clean();
            echo trim($last_id);
        } else {
            error_log("❌ No rows inserted");
            ob_end_clean();
            echo "0";
        }
    } else {
        error_log("❌ Execute failed: " . $stmt->error);
        ob_end_clean();
        echo "0";
    }

    $stmt->close();
} else {
    error_log("Missing field or value parameters");
    ob_end_clean();
    echo "0";
}

$con->close();
error_log("====================================");
exit;
?>