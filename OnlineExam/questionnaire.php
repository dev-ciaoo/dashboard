<?php
/**
 * questionnaire.php
 *
 * Accessed two ways:
 *   1. GET  ?material_id=X        → renders questions list + add form inside the iframe
 *   2. POST action=add_question   → saves question, redirects back to GET (PRG)
 *   3. POST action=delete_question→ deletes question, redirects back to GET (PRG)
 *
 * Loaded inside a Bootstrap modal iframe from the main admin page.
 * Has its own auth + DB bootstrap so it also works standalone.
 */

require_once('../connection.php');
require_once('../auth_check.php');

// Build an absolute self-URL for redirects so header() works correctly
// regardless of whether the file is accessed directly or via iframe.
$selfUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
         . '://' . $_SERVER['HTTP_HOST']
         . strtok($_SERVER['REQUEST_URI'], '?');  // strip existing query string

// Access control — same as parent
$allowedPositions = ['HR Officer', 'IT Officer'];
if (!in_array($_SESSION['bankposition'], $allowedPositions)) {
    http_response_code(403);
    echo '<div class="alert alert-danger m-3"><i class="fa-solid fa-ban me-2"></i>Access Denied.</div>';
    exit;
}

// CSRF helpers
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function verifyCsrfQ(): void {
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        http_response_code(403);
        die('<div class="alert alert-danger m-3">Invalid request token. Refresh and try again.</div>');
    }
}

// ================================================================
// POST: Add question
// ================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add_question') {
    verifyCsrfQ();

    $matId   = (int)($_POST['q_material_id'] ?? 0);
    $qText   = trim($_POST['question_text']  ?? '');
    $choiceA = trim($_POST['choice_a']       ?? '');
    $choiceB = trim($_POST['choice_b']       ?? '');
    $choiceC = trim($_POST['choice_c']       ?? '');
    $choiceD = trim($_POST['choice_d']       ?? '');

    // Validate correct_answer before casting — empty string would silently become 0 (choice A)
    $correctRaw = $_POST['correct_answer'] ?? '';
    $correct    = ($correctRaw !== '') ? (int)$correctRaw : -1;

    $error = '';
    if ($matId <= 0 || $qText === '' || $choiceA === '' || $choiceB === '' || $choiceC === '' || $choiceD === '') {
        $error = 'All fields are required.';
    } elseif ($correct < 0 || $correct > 3) {
        $error = 'Please select a valid correct answer (A–D).';
    }

    if ($error === '') {
        $stmt = mysqli_prepare($con,
            "INSERT INTO `exam_questions`
                (material_id, question_text, choice_a, choice_b, choice_c, choice_d, correct_answer)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, 'isssssi', $matId, $qText, $choiceA, $choiceB, $choiceC, $choiceD, $correct);
        if (!mysqli_stmt_execute($stmt)) {
            $error = 'Database error: ' . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }

    // PRG — redirect back to GET using $selfUrl so the path is always correct
    // whether this file is accessed directly or via iframe.
    $qs = http_build_query([
        'material_id' => $matId,
        'msg'         => $error === '' ? 'added' : '',
        'err'         => $error,
    ]);
    header("Location: $selfUrl?$qs");
    exit;
}

// ================================================================
// POST: Delete question
// ================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete_question') {
    verifyCsrfQ();

    $qId   = (int)($_POST['question_id']  ?? 0);
    $matId = (int)($_POST['q_material_id'] ?? 0);

    if ($qId > 0) {
        // Safety: confirm question belongs to the stated material before deleting
        $check = mysqli_query($con, "SELECT id FROM `exam_questions` WHERE id = $qId AND material_id = $matId LIMIT 1");
        if (mysqli_num_rows($check) === 1) {
            mysqli_query($con, "DELETE FROM `exam_questions` WHERE id = $qId");
        }
    }

    $qs = http_build_query([
        'material_id' => $matId,
        'msg'         => 'deleted',
    ]);
    header("Location: $selfUrl?$qs");
    exit;
}

// ================================================================
// GET: Render modal body fragment
// ================================================================
$matId = (int)($_GET['material_id'] ?? 0);
$msg   = $_GET['msg'] ?? '';
$err   = trim($_GET['err'] ?? '');

if ($matId <= 0) {
    echo '<div class="alert alert-warning m-3">No material selected.</div>';
    exit;
}

// Fetch material info
$resMat = mysqli_query($con, "SELECT id, original_name, display_name FROM `exam_materials` WHERE id = $matId LIMIT 1");
$mat    = mysqli_fetch_assoc($resMat);

if (!$mat) {
    echo '<div class="alert alert-danger m-3">Material not found.</div>';
    exit;
}

// Fetch questions for this material
$resQ      = mysqli_query($con, "SELECT * FROM `exam_questions` WHERE material_id = $matId ORDER BY id ASC");
$questions = [];
while ($qRow = mysqli_fetch_assoc($resQ)) {
    $questions[] = $qRow;
}

$matName    = htmlspecialchars($mat['display_name'] ?? $mat['original_name']);
$csrfToken  = htmlspecialchars($_SESSION['csrf_token']);
$letters    = ['A', 'B', 'C', 'D'];
$choiceKeys = ['choice_a', 'choice_b', 'choice_c', 'choice_d'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Questionnaire — <?= $matName ?></title>
<!-- Bootstrap 5 + FA are already loaded on the parent; loaded here for standalone access -->
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      crossorigin="anonymous">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      crossorigin="anonymous">
<style>
  /* Scoped styles — safe whether rendered standalone or injected into the modal */
  .q-list-wrap   { max-height: 55vh; overflow-y: auto; padding-right: 4px; }
  .q-card        { border: 1px solid #dee2e6; border-radius: 8px; margin-bottom: 10px;
                   background: #fff; transition: box-shadow .15s; }
  .q-card:hover  { box-shadow: 0 2px 8px rgba(0,0,0,.09); }
  .q-card-header { background: #f8f9fa; border-bottom: 1px solid #dee2e6;
                   border-radius: 8px 8px 0 0; padding: 8px 14px;
                   display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; }
  .q-num         { font-weight: 700; color: #0d6efd; font-size: .82rem; white-space: nowrap; flex-shrink: 0; }
  .q-text        { font-size: .88rem; font-weight: 600; flex: 1; }
  .q-choices     { display: grid; grid-template-columns: 1fr 1fr; gap: 3px;
                   padding: 10px 14px; font-size: .83rem; }
  .q-choice      { padding: 3px 6px; border-radius: 4px; color: #495057; }
  .q-choice.correct   { background: #d1e7dd; color: #0a3622; font-weight: 700; }
  .correct-badge { font-size: .68rem; background: #0a3622; color: #fff;
                   border-radius: 10px; padding: 1px 7px; margin-left: 6px; }

  /* Add-question form */
  .add-q-section { background: #eef4ff; border: 1px dashed #b6d4fe;
                   border-radius: 8px; padding: 16px; margin-top: 14px; }
  .add-q-section .form-label { font-size: .8rem; font-weight: 600; margin-bottom: 3px; }
  .add-q-section .form-control,
  .add-q-section .form-select { font-size: .85rem; }

  /* Flash messages */
  .q-flash { font-size: .85rem; margin-bottom: 12px; border-radius: 6px; padding: 8px 14px; }

  /* Empty state */
  .q-empty { text-align: center; padding: 30px 0; color: #868e96; font-size: .88rem; }
  .q-empty i { font-size: 2rem; margin-bottom: 8px; display: block; }
</style>
</head>
<body class="p-3 m-0" style="background:#fff;">

<?php /* ── Flash messages (from redirect params) ── */ ?>
<?php if ($msg === 'added' && $err === ''): ?>
  <div class="q-flash alert alert-success py-2">
    <i class="fa-solid fa-circle-check me-1"></i> Question added successfully.
  </div>
<?php elseif ($msg === 'deleted'): ?>
  <div class="q-flash alert alert-info py-2">
    <i class="fa-solid fa-trash me-1"></i> Question deleted.
  </div>
<?php elseif ($err !== ''): ?>
  <div class="q-flash alert alert-warning py-2">
    <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= htmlspecialchars($err) ?>
  </div>
<?php endif; ?>

<?php /* ── Question count badge ── */ ?>
<div class="d-flex justify-content-between align-items-center mb-2 px-1">
  <span class="text-muted" style="font-size:.82rem;">
    <i class="fa-solid fa-circle-question me-1 text-primary"></i>
    <?= count($questions) ?> question<?= count($questions) !== 1 ? 's' : '' ?> for this material
  </span>
</div>

<?php /* ── Questions list ── */ ?>
<div class="q-list-wrap">
  <?php if (empty($questions)): ?>
    <div class="q-empty">
      <i class="fa-solid fa-list-check"></i>
      No questions yet. Add the first one below.
    </div>
  <?php else: ?>
    <?php foreach ($questions as $idx => $q):
      $correct = (int)$q['correct_answer'];
    ?>
    <div class="q-card">
      <div class="q-card-header">
        <span class="q-num"><?= $idx + 1 ?>.</span>
        <span class="q-text"><?= htmlspecialchars($q['question_text']) ?></span>
        <!-- Delete — action uses $selfUrl so POST goes to the right path in any context -->
        <form method="POST" action="<?= htmlspecialchars($selfUrl) ?>" style="margin:0; flex-shrink:0;"
              onsubmit="return confirm('Delete this question? This cannot be undone.')">
          <input type="hidden" name="action"         value="delete_question">
          <input type="hidden" name="question_id"    value="<?= (int)$q['id'] ?>">
          <input type="hidden" name="q_material_id"  value="<?= $matId ?>">
          <input type="hidden" name="csrf_token"     value="<?= $csrfToken ?>">
          <button type="submit" class="btn btn-sm btn-outline-danger" style="padding:2px 8px; font-size:.78rem;">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      </div>
      <div class="q-choices">
        <?php foreach ($choiceKeys as $li => $key): ?>
          <div class="q-choice <?= $correct === $li ? 'correct' : '' ?>">
            <strong><?= $letters[$li] ?>.</strong>
            <?= htmlspecialchars($q[$key]) ?>
            <?php if ($correct === $li): ?>
              <span class="correct-badge">Correct</span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php /* ── Add Question form — action uses $selfUrl ── */ ?>
<div class="add-q-section">
  <p class="fw-bold mb-3" style="font-size:.85rem; color:#0d6efd;">
    <i class="fa-solid fa-plus-circle me-1"></i> Add New Question
  </p>
  <form method="POST" action="<?= htmlspecialchars($selfUrl) ?>" id="addQForm">
    <input type="hidden" name="action"        value="add_question">
    <input type="hidden" name="q_material_id" value="<?= $matId ?>">
    <input type="hidden" name="csrf_token"    value="<?= $csrfToken ?>">

    <div class="mb-2">
      <label class="form-label">Question</label>
      <textarea class="form-control form-control-sm" name="question_text"
                rows="2" placeholder="Type the question here…" required></textarea>
    </div>

    <div class="row g-2 mb-2">
      <?php foreach (['A','B','C','D'] as $ltr): ?>
      <div class="col-6">
        <label class="form-label">Choice <?= $ltr ?></label>
        <input type="text" class="form-control form-control-sm"
               name="choice_<?= strtolower($ltr) ?>"
               placeholder="Choice <?= $ltr ?>" required>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="mb-3">
      <label class="form-label">Correct Answer</label>
      <select class="form-select form-select-sm" name="correct_answer" required>
        <option value="" disabled selected>— Select correct answer —</option>
        <option value="0">A</option>
        <option value="1">B</option>
        <option value="2">C</option>
        <option value="3">D</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">
      <i class="fa-solid fa-plus me-1"></i> Add Question
    </button>
  </form>
</div>

</body>
</html>