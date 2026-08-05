<?php
require_once('../connection.php');
require_once('../auth_check.php');

header('Content-Type: application/json');

$materialId = isset($_GET['material_id']) ? (int)$_GET['material_id'] : 0;

if ($materialId <= 0) {
    echo json_encode(['questions' => []]);
    exit;
}

$stmt = mysqli_prepare($con,
    "SELECT id, question_text, choice_a, choice_b, choice_c, choice_d
     FROM   exam_questions
     WHERE  material_id = ?
     ORDER  BY id ASC");

mysqli_stmt_bind_param($stmt, 'i', $materialId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$questions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = [
        'id'      => (int)$row['id'],
        'q'       => $row['question_text'],
        'choices' => [
            $row['choice_a'],
            $row['choice_b'],
            $row['choice_c'],
            $row['choice_d'],
        ],
        // correct_answer intentionally excluded
    ];
}

mysqli_stmt_close($stmt);
echo json_encode(['questions' => $questions]);
exit;