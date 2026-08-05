<?php
include 'connection.php';
header('Content-Type: application/json');

// Prevent notices from breaking JSON
error_reporting(0);

$itemId = $_POST['iDescription'] ?? '';

if ($itemId === '') {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Missing parameter'
    ]);
    exit;
}

$query = "
    SELECT id, computer, category, computer, description, dateAdded, price
    FROM inventory
    WHERE id = ?
";

$stmt = $con->prepare($query);

if (!$stmt) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Prepare failed'
    ]);
    exit;
}

$stmt->bind_param("i", $itemId);
$stmt->execute();

$result = $stmt->get_result();
$item = $result->fetch_assoc();

if ($item) {
    echo json_encode([
        'status' => 'success',
        'item'   => $item
    ]);
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Item not found'
    ]);
}

exit;
