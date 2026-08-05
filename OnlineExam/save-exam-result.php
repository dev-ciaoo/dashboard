<?php
ob_start();
require_once('../connection.php');
require_once('../auth_check.php');
ob_clean();

header('Content-Type: application/json');

function fail($error) {
    echo json_encode(['ok' => false, 'error' => $error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('method_not_allowed');
}

$rawBody = file_get_contents('php://input');
if (empty($rawBody)) { fail('empty_body'); }

$body = json_decode($rawBody, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('save-exam-result: json_decode failed. Error=' . json_last_error_msg());
    fail('body_json_error');
}

$userId     = (int)$_SESSION['userid'];
$materialId = isset($body['material_id']) ? (int)$body['material_id'] : 0;
$details    = isset($body['details'])     ? $body['details']          : [];

// client-sent score/passed are ignored — recalculated server-side
if ($materialId <= 0) { fail('invalid_params'); }
if (!is_array($details) || count($details) === 0) { fail('invalid_details'); }

// ── Verify material ───────────────────────────────────────────────
$stmtMat = mysqli_prepare($con,
    "SELECT id FROM exam_materials WHERE id = ? AND is_active = 1 LIMIT 1");
if (!$stmtMat) { fail('db_error: ' . mysqli_error($con)); }
mysqli_stmt_bind_param($stmtMat, 'i', $materialId);
mysqli_stmt_execute($stmtMat);
mysqli_stmt_store_result($stmtMat);
if (mysqli_stmt_num_rows($stmtMat) === 0) {
    mysqli_stmt_close($stmtMat);
    fail('material_not_found');
}
mysqli_stmt_close($stmtMat);

// ── Attempt guard ─────────────────────────────────────────────────
$MAX_ATTEMPTS = 3;
$stmtChk = mysqli_prepare($con,
    "SELECT COUNT(*) AS attempts_used, MAX(passed) AS has_passed
     FROM exam_results WHERE user_id = ? AND material_id = ?");
if (!$stmtChk) { fail('db_error: ' . mysqli_error($con)); }
mysqli_stmt_bind_param($stmtChk, 'ii', $userId, $materialId);
mysqli_stmt_execute($stmtChk);
$rowChk = mysqli_stmt_get_result($stmtChk)->fetch_assoc();
mysqli_stmt_close($stmtChk);

if ((bool)$rowChk['has_passed'] || (int)$rowChk['attempts_used'] >= $MAX_ATTEMPTS) {
    fail('no_attempts_left');
}

// ── Fetch correct answers from DB ─────────────────────────────────
$questionIds = [];
foreach ($details as $d) {
    if (isset($d['question_id']) && $d['question_id'] !== null && $d['question_id'] !== '') {
        $questionIds[] = (int)$d['question_id'];
    }
}
$questionIds = array_unique(array_filter($questionIds));

$correctAnswers = [];
if (!empty($questionIds)) {
    $placeholders = implode(',', array_fill(0, count($questionIds), '?'));
    $types        = str_repeat('i', count($questionIds)) . 'i';
    $params       = array_merge($questionIds, [$materialId]);

    $stmtAns = mysqli_prepare($con,
        "SELECT id, correct_answer FROM exam_questions
         WHERE id IN ($placeholders) AND material_id = ?");
    if (!$stmtAns) { fail('db_error: ' . mysqli_error($con)); }

    mysqli_stmt_bind_param($stmtAns, $types, ...$params);
    mysqli_stmt_execute($stmtAns);
    $resAns = mysqli_stmt_get_result($stmtAns);
    while ($r = mysqli_fetch_assoc($resAns)) {
        $correctAnswers[(int)$r['id']] = (int)$r['correct_answer'];
    }
    mysqli_stmt_close($stmtAns);
}

// ── Recalculate score server-side ─────────────────────────────────
$serverScore   = 0;
$total         = count($details);
$serverResults = []; // returned to client for buildReview

foreach ($details as &$d) {
    $qId = (isset($d['question_id']) && $d['question_id'] !== '') ? (int)$d['question_id'] : null;
    $ua  = (isset($d['user_answer']) && $d['user_answer'] !== null && $d['user_answer'] !== '')
           ? (int)$d['user_answer'] : null;

    if ($qId && isset($correctAnswers[$qId])) {
        $correct          = $correctAnswers[$qId];
        $d['correct_answer'] = $correct;
        $d['is_correct']  = ($ua !== null && $ua === $correct) ? 1 : 0;
    } else {
        $d['is_correct']  = 0;
    }

    if ($d['is_correct']) $serverScore++;
    $serverResults[] = ['is_correct' => $d['is_correct']];
}
unset($d);

$passed = ($total > 0 && (($serverScore / $total) * 100) >= 75) ? 1 : 0;

// ── NULL-safe insert helper ───────────────────────────────────────
function insertDetail($con, $resultId, $qId, $qText, $a, $b, $c, $d, $correct, $ua, $isCorrect)
{
    if ($qId !== null && $ua !== null) {
        $s = mysqli_prepare($con,
            "INSERT INTO exam_result_details
                 (result_id,question_id,question_text,choice_a,choice_b,choice_c,choice_d,correct_answer,user_answer,is_correct)
             VALUES (?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($s, 'iisssssiis',
            $resultId, $qId, $qText, $a, $b, $c, $d, $correct, $ua, $isCorrect);
    } elseif ($qId !== null) {
        $s = mysqli_prepare($con,
            "INSERT INTO exam_result_details
                 (result_id,question_id,question_text,choice_a,choice_b,choice_c,choice_d,correct_answer,user_answer,is_correct)
             VALUES (?,?,?,?,?,?,?,?,NULL,?)");
        mysqli_stmt_bind_param($s, 'iisssssii',
            $resultId, $qId, $qText, $a, $b, $c, $d, $correct, $isCorrect);
    } elseif ($ua !== null) {
        $s = mysqli_prepare($con,
            "INSERT INTO exam_result_details
                 (result_id,question_id,question_text,choice_a,choice_b,choice_c,choice_d,correct_answer,user_answer,is_correct)
             VALUES (?,NULL,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($s, 'isssssiis',
            $resultId, $qText, $a, $b, $c, $d, $correct, $ua, $isCorrect);
    } else {
        $s = mysqli_prepare($con,
            "INSERT INTO exam_result_details
                 (result_id,question_id,question_text,choice_a,choice_b,choice_c,choice_d,correct_answer,user_answer,is_correct)
             VALUES (?,NULL,?,?,?,?,?,?,NULL,?)");
        mysqli_stmt_bind_param($s, 'isssssii',
            $resultId, $qText, $a, $b, $c, $d, $correct, $isCorrect);
    }

    if (!$s) { return false; }
    $ok = mysqli_stmt_execute($s);
    mysqli_stmt_close($s);
    return $ok;
}

// ── Transaction ───────────────────────────────────────────────────
mysqli_begin_transaction($con);

try {
    $stmtRes = mysqli_prepare($con,
        "INSERT INTO exam_results (user_id, material_id, score, total, passed)
         VALUES (?, ?, ?, ?, ?)");
    if (!$stmtRes) { throw new Exception('db_prepare_result: ' . mysqli_error($con)); }
    mysqli_stmt_bind_param($stmtRes, 'iiiii', $userId, $materialId, $serverScore, $total, $passed);
    if (!mysqli_stmt_execute($stmtRes)) {
        throw new Exception('result_insert_failed: ' . mysqli_error($con));
    }
    $resultId = mysqli_insert_id($con);
    mysqli_stmt_close($stmtRes);

    foreach ($details as $idx => $d) {
        $questionId    = (isset($d['question_id']) && $d['question_id'] !== null && $d['question_id'] !== '')
                         ? (int)$d['question_id'] : null;
        $qText         = mb_substr((string)($d['question_text']  ?? ''), 0, 2000);
        $choiceA       = mb_substr((string)($d['choice_a']       ?? ''), 0, 1000);
        $choiceB       = mb_substr((string)($d['choice_b']       ?? ''), 0, 1000);
        $choiceC       = mb_substr((string)($d['choice_c']       ?? ''), 0, 1000);
        $choiceD       = mb_substr((string)($d['choice_d']       ?? ''), 0, 1000);
        $correctAnswer = isset($d['correct_answer']) ? (int)$d['correct_answer'] : 0;
        $isCorrect     = (int)$d['is_correct'];
        $userAnswer    = (isset($d['user_answer']) && $d['user_answer'] !== null && $d['user_answer'] !== '')
                         ? (int)$d['user_answer'] : null;

        $ok = insertDetail($con, $resultId,
            $questionId, $qText,
            $choiceA, $choiceB, $choiceC, $choiceD,
            $correctAnswer, $userAnswer, $isCorrect);

        if (!$ok) {
            throw new Exception('detail_insert_failed row ' . $idx . ': ' . mysqli_error($con));
        }
    }

    mysqli_commit($con);
    echo json_encode([
        'ok'        => true,
        'result_id' => $resultId,
        'score'     => $serverScore,
        'total'     => $total,
        'passed'    => $passed,
        'results'   => $serverResults   // is_correct per question for buildReview
    ]);

} catch (Exception $e) {
    mysqli_rollback($con);
    error_log('save-exam-result EXCEPTION: ' . $e->getMessage());
    fail($e->getMessage());
}
exit;