<?php

require_once('../connection.php');
require_once('../auth_check.php');

header('Content-Type: application/json');

// FIX: access control was entirely missing — any authenticated user could read
// any employee's full exam history by passing an arbitrary user_id in GET.
$allowedPositions = ['HR Officer', 'IT Officer'];
if (!in_array($_SESSION['bankposition'], $allowedPositions)) {
    echo json_encode(['ok' => false, 'error' => 'access_denied']);
    exit;
}

$userId     = (int)($_GET['user_id']     ?? 0);
$materialId = (int)($_GET['material_id'] ?? 0);

if ($userId <= 0 || $materialId <= 0) {
    echo json_encode(['ok' => false, 'error' => 'Invalid parameters.']);
    exit;
}

// ================================================================
// Fetch all exam_results rows for this user + material
// ================================================================
$sqlResults = "
    SELECT id, score, total, passed, taken_at
    FROM   `exam_results`
    WHERE  user_id = $userId AND material_id = $materialId
    ORDER  BY taken_at ASC
";
$resResults = mysqli_query($con, $sqlResults);

if (!$resResults) {
    echo json_encode(['ok' => false, 'error' => 'Query failed.']);
    exit;
}

$attempts = [];

while ($row = mysqli_fetch_assoc($resResults)) {
    $resultId = (int)$row['id'];

    // Fetch per-question details from exam_result_details
    $sqlDetails = "
        SELECT question_text, choice_a, choice_b, choice_c, choice_d,
               correct_answer, user_answer, is_correct
        FROM   `exam_result_details`
        WHERE  result_id = $resultId
        ORDER  BY id ASC
    ";
    $resDetails = mysqli_query($con, $sqlDetails);

    $details = [];
    if ($resDetails) {
        while ($d = mysqli_fetch_assoc($resDetails)) {
            $details[] = [
                'question_text'  => $d['question_text'],
                'choice_a'       => $d['choice_a'],
                'choice_b'       => $d['choice_b'],
                'choice_c'       => $d['choice_c'],
                'choice_d'       => $d['choice_d'],
                'correct_answer' => $d['correct_answer'],
                'user_answer'    => $d['user_answer'],
                'is_correct'     => $d['is_correct'],
            ];
        }
    }

    $attempts[] = [
        'score'    => (int)$row['score'],
        'total'    => (int)$row['total'],
        'passed'   => (int)$row['passed'],
        'taken_at' => $row['taken_at'],
        'details'  => $details,
    ];
}

echo json_encode(['ok' => true, 'attempts' => $attempts]);
exit;