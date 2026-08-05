<?php
include 'connection.php';
header('Content-Type: application/json');

// Prevent PHP notices from breaking JSON
error_reporting(0);

$category = $_POST['iCategoryId'] ?? '';
$branch   = $_POST['iBranch'] ?? '';

if ($category === '' || $branch === '') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing parameters'
    ]);
    exit;
}

$query = "
            SELECT id, category, computer, description
                                                        FROM inventory
                                                                        WHERE category = ?
                                                                                            AND location = ?
";

$stmt = $con->prepare($query);

if (!$stmt) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Prepare failed'
        ]);
        exit;
}

$stmt->bind_param("is", $category, $branch);
$stmt->execute();
$result = $stmt->get_result();

$items = [];

while ($row = $result->fetch_assoc()) {
    $items[] = [
        'id'          => $row['id'],
        'category'    => $row['category'],
        'computer'    => $row['computer'],
        'description' => $row['description']
    ];
}

echo json_encode([
    'status' => 'success',
    'items'  => $items
]);
exit;

?>