<?php
require_once('../connection.php');
require_once('../auth_check.php');

header('Content-Type: application/json');

// No position restriction — any authenticated employee checks their OWN attempts only.
// User ID always comes from the session, never from GET, so it cannot be spoofed.
$userId     = (int)$_SESSION['userid'];
$materialId = isset($_GET['material_id']) ? (int)$_GET['material_id'] : 0;

if ($materialId <= 0) {
    echo json_encode(['attempts_used' => 0, 'has_passed' => false]);
    exit;
}

$stmt = mysqli_prepare($con,
    "SELECT COUNT(*) AS attempts_used, MAX(passed) AS has_passed
     FROM `exam_results`
     WHERE user_id = ? AND material_id = ?");
if (!$stmt) {
    echo json_encode(['attempts_used' => 0, 'has_passed' => false]);
    exit;
}
mysqli_stmt_bind_param($stmt, 'ii', $userId, $materialId);
mysqli_stmt_execute($stmt);
$row = mysqli_stmt_get_result($stmt)->fetch_assoc();
mysqli_stmt_close($stmt);

echo json_encode([
    'attempts_used' => (int)$row['attempts_used'],
    'has_passed'    => (bool)$row['has_passed'],
]);
exit;