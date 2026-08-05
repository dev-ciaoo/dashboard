<?php

require_once('../connection.php');
require_once('../auth_check.php');

// Access control — HR Officer and IT Officer only
$allowedPositions = ['HR Officer', 'IT Officer', 'Compliance Officer', 'HR Assistant'];
if (!in_array($_SESSION['bankposition'], $allowedPositions)) {
    echo '<div class="alert alert-danger m-4"><i class="fa-solid fa-ban mr-2"></i>Access Denied.</div>';
    exit;
}


$uploadDir   = __DIR__ . '/materials/';
$uploadDirOk = is_dir($uploadDir) || mkdir($uploadDir, 0755, true);
$message     = '';
$msgType     = 'success';

if (!defined('MAX_ACTIVE'))   define('MAX_ACTIVE',   15);
if (!defined('MAX_ATTEMPTS')) define('MAX_ATTEMPTS', 3);

// ================================================================
// HELPER: Count currently active materials
// ================================================================
function countActive($con) {
    $res = mysqli_query($con, "SELECT COUNT(*) AS cnt FROM `exam_materials` WHERE is_active = 1");
    $row = mysqli_fetch_assoc($res);
    return (int)$row['cnt'];
}

$activeCount = countActive($con);

// ================================================================
// CSRF TOKEN
// ================================================================
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function verifyCsrf() {
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        http_response_code(403);
        die('<div class="alert alert-danger m-4">Invalid request token. Please refresh and try again.</div>');
    }
}

// ================================================================
// HANDLE: Upload
// ================================================================
if (isset($_POST['action']) && $_POST['action'] === 'upload') {
    verifyCsrf();

    if (!$uploadDirOk) {
        $message = 'Unable to create the materials folder. Check server permissions.';
        $msgType = 'danger';
    } elseif (empty($_FILES['pdf_file']['name'])) {
        $message = 'No file selected.';
        $msgType = 'warning';
    } else {
        $file    = $_FILES['pdf_file'];
        $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $maxSize = 20 * 1024 * 1024;

        if ($ext !== 'pdf') {
            $message = 'Only PDF files are accepted.';
            $msgType = 'danger';
        } elseif ($file['size'] > $maxSize) {
            $message = 'File is too large. Maximum size is 20MB.';
            $msgType = 'danger';
        } elseif ($file['error'] !== UPLOAD_ERR_OK) {
            $message = 'Upload error. Please try again.';
            $msgType = 'danger';
        } else {
            $originalName = basename($file['name']);
            $newFilename  = uniqid('material_', true) . '.pdf';
            $destination  = $uploadDir . $newFilename;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $uploadedBy = (int)$_SESSION['userid'];

                if (!empty($_POST['set_active'])) {
                    if ($activeCount >= MAX_ACTIVE) {
                        $isActive = 0;
                        $message  = 'File uploaded, but the active material limit (' . MAX_ACTIVE . ') has been reached. '
                                  . 'Deactivate an existing material before activating this one.';
                        $msgType  = 'warning';
                    } else {
                        $isActive = 1;
                    }
                } else {
                    $isActive = 0;
                }

                $stmt = mysqli_prepare($con,
                    "INSERT INTO `exam_materials` (filename, original_name, uploaded_by, is_active) VALUES (?, ?, ?, ?)"
                );
                mysqli_stmt_bind_param($stmt, 'ssii', $newFilename, $originalName, $uploadedBy, $isActive);

                if (mysqli_stmt_execute($stmt)) {
                    if ($isActive) { $activeCount++; }
                    if ($message === '') {
                        $message = 'Successfully uploaded <strong>' . htmlspecialchars($originalName) . '</strong>.';
                        $msgType = 'success';
                    }
                } else {
                    unlink($destination);
                    $message = 'Database error: ' . mysqli_error($con);
                    $msgType = 'danger';
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Unable to move the file. Check folder permissions.';
                $msgType = 'danger';
            }
        }
    }
}

// ================================================================
// HANDLE: Activate
// ================================================================
if (isset($_POST['action']) && $_POST['action'] === 'activate') {
    verifyCsrf();
    $activateId = (int)$_POST['material_id'];

    if ($activeCount >= MAX_ACTIVE) {
        $message = 'The active material limit (' . MAX_ACTIVE . ') has been reached. '
                 . 'Deactivate an existing material before activating another.';
        $msgType = 'warning';
    } else {
        mysqli_query($con, "UPDATE `exam_materials` SET is_active = 1 WHERE id = $activateId");
        $activeCount = countActive($con);
        $message = 'Material has been set as active.';
        $msgType = 'success';
    }
}

// ================================================================
// HANDLE: Deactivate
// ================================================================
if (isset($_POST['action']) && $_POST['action'] === 'deactivate') {
    verifyCsrf();
    $deactivateId = (int)$_POST['material_id'];
    mysqli_query($con, "UPDATE `exam_materials` SET is_active = 0 WHERE id = $deactivateId");
    $activeCount = countActive($con);
    $message = 'Material has been deactivated.';
    $msgType = 'info';
}

// ================================================================
// HANDLE: Delete material
// ================================================================
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    verifyCsrf();
    $deleteId = (int)$_POST['material_id'];
    $sqlGet   = "SELECT filename, is_active FROM `exam_materials` WHERE id = $deleteId";
    $resGet   = mysqli_query($con, $sqlGet);
    $rowGet   = mysqli_fetch_assoc($resGet);

    if ($rowGet) {
        if ($rowGet['is_active'] == 1) {
            $message = 'Cannot delete an active material. Deactivate it first before deleting.';
            $msgType = 'warning';
        } else {
            $filePath = $uploadDir . $rowGet['filename'];
            if (file_exists($filePath)) { unlink($filePath); }
            mysqli_query($con, "DELETE FROM `exam_questions` WHERE material_id = $deleteId");
            mysqli_query($con, "DELETE FROM `exam_materials` WHERE id = $deleteId");
            $message = 'Material and its questions have been deleted.';
            $msgType = 'success';
        }
    }
}

// ================================================================
// HANDLE: Rename material
// ================================================================
if (isset($_POST['action']) && $_POST['action'] === 'rename_material') {
    verifyCsrf();
    $renameId   = (int)$_POST['material_id'];
    $newName    = trim($_POST['display_name'] ?? '');

    if ($renameId <= 0 || $newName === '') {
        $message = 'Invalid rename request.';
        $msgType = 'warning';
    } else {
        $stmt = mysqli_prepare($con,
            "UPDATE `exam_materials` SET display_name = ? WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, 'si', $newName, $renameId);
        if (mysqli_stmt_execute($stmt)) {
            $message = 'Material name updated successfully.';
            $msgType = 'success';
        } else {
            $message = 'Database error: ' . mysqli_error($con);
            $msgType = 'danger';
        }
        mysqli_stmt_close($stmt);
    }
}

// ================================================================
// HANDLE: Upload thumbnail
// ================================================================
if (isset($_POST['action']) && $_POST['action'] === 'upload_thumbnail') {
    verifyCsrf();
    $thumbMatId = (int)$_POST['material_id'];

    if ($thumbMatId <= 0) {
        $message = 'Invalid thumbnail request.';
        $msgType = 'warning';
    } elseif (empty($_FILES['thumbnail_file']['name'])) {
        $message = 'No file selected.';
        $msgType = 'warning';
    } else {
        $tFile    = $_FILES['thumbnail_file'];
        $tExt     = strtolower(pathinfo($tFile['name'], PATHINFO_EXTENSION));
        $allowed  = ['jpg', 'jpeg', 'png', 'webp'];
        $maxSize  = 2 * 1024 * 1024;

        if (!in_array($tExt, $allowed)) {
            $message = 'Only JPG, PNG, or WEBP images are accepted for thumbnails.';
            $msgType = 'danger';
        } elseif ($tFile['size'] > $maxSize) {
            $message = 'Thumbnail too large. Maximum size is 2MB.';
            $msgType = 'danger';
        } elseif ($tFile['error'] !== UPLOAD_ERR_OK) {
            $message = 'Upload error. Please try again.';
            $msgType = 'danger';
        } else {
            $resOld = mysqli_query($con,
                "SELECT thumbnail FROM `exam_materials` WHERE id = $thumbMatId"
            );
            $rowOld = mysqli_fetch_assoc($resOld);
            if (!empty($rowOld['thumbnail'])) {
                $oldPath = $uploadDir . $rowOld['thumbnail'];
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $newThumb   = uniqid('thumb_', true) . '.' . $tExt;
            $thumbDest  = $uploadDir . $newThumb;

            if (move_uploaded_file($tFile['tmp_name'], $thumbDest)) {
                $stmt = mysqli_prepare($con,
                    "UPDATE `exam_materials` SET thumbnail = ? WHERE id = ?"
                );
                mysqli_stmt_bind_param($stmt, 'si', $newThumb, $thumbMatId);
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Thumbnail uploaded successfully.';
                    $msgType = 'success';
                } else {
                    unlink($thumbDest);
                    $message = 'Database error: ' . mysqli_error($con);
                    $msgType = 'danger';
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Unable to move thumbnail. Check folder permissions.';
                $msgType = 'danger';
            }
        }
    }
}

// ================================================================
// HANDLE: Reset attempts
// ================================================================
if (isset($_POST['action']) && $_POST['action'] === 'reset_attempts') {
    verifyCsrf();
    $resetUserId = (int)$_POST['reset_user_id'];
    $resetMatId  = (int)$_POST['reset_material_id'];

    if ($resetUserId > 0 && $resetMatId > 0) {
        mysqli_query($con,
            "DELETE FROM `exam_results`
             WHERE user_id = $resetUserId AND material_id = $resetMatId"
        );
        $message = 'Attempts have been reset for this user.';
        $msgType = 'success';
    } else {
        $message = 'Invalid reset request.';
        $msgType = 'danger';
    }
}

// ================================================================
// FETCH: All materials + question counts
// ================================================================
$sqlAll = "SELECT m.*, a.fullName,
               (SELECT COUNT(*) FROM `exam_questions` q WHERE q.material_id = m.id) AS question_count
           FROM `exam_materials` m
           LEFT JOIN `accounts` a ON a.userId = m.uploaded_by
           ORDER BY m.is_active DESC, m.uploaded_at DESC";
$resAll    = mysqli_query($con, $sqlAll);
$materials = [];
while ($row = mysqli_fetch_assoc($resAll)) {
    $materials[] = $row;
}

// ================================================================
// FETCH: Exam attempt summary
// ================================================================

$sqlSummary = "
    SELECT
        er.user_id,
        acc.fullName,
        acc.employeeId,
        acc.address,
        acc.bankPosition,
        er.material_id,
        m.original_name,
        COUNT(*)                    AS attempts_used,
        MAX(er.score)               AS best_score,
        MAX(er.total)               AS total_questions,
        MAX(er.passed)              AS ever_passed,
        MAX(er.taken_at)            AS last_attempt
    FROM `exam_results`    er
    JOIN `accounts`        acc ON acc.userId  = er.user_id
    JOIN `exam_materials`  m   ON m.id        = er.material_id
    GROUP BY er.user_id, er.material_id
    ORDER BY last_attempt DESC
";
$resSummary  = mysqli_query($con, $sqlSummary);
$summaryRows = [];
if ($resSummary) {
    while ($sRow = mysqli_fetch_assoc($resSummary)) {
        $summaryRows[] = $sRow;
    }
}



$openMaterialId = (int)($_POST['open_material_id'] ?? 0);
?>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc4s9bIOgUxi8T/jzmdzrQAhUBcnFaQZBQ3m6NqKRLi"
        crossorigin="anonymous"></script>

<style>
/* ------------------------------------------------------------------
   BOOTSTRAP 4 → 5 COMPATIBILITY SHIM
------------------------------------------------------------------ */
.mr-1 { margin-right: .25rem !important; }
.mr-2 { margin-right: .5rem  !important; }
.mr-3 { margin-right: 1rem   !important; }
.ml-1 { margin-left:  .25rem !important; }
.ml-2 { margin-left:  .5rem  !important; }
.ml-3 { margin-left:  1rem   !important; }
.font-weight-bold { font-weight: 700 !important; }
.btn-block { display: block; width: 100%; }

/* ------------------------------------------------------------------
   MATERIAL CARDS
------------------------------------------------------------------ */
.material-card {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 14px 16px;
    margin-bottom: 12px;
    transition: border-color .15s, background .15s;
    background: #fff;
}
.material-card.is-active   { border-color: #28a745; background: #f6fff8; }
.material-card.is-inactive { border-color: #dee2e6; opacity: .88; }

/* ------------------------------------------------------------------
   UPLOAD ZONE
------------------------------------------------------------------ */
.upload-zone {
    border: 2px dashed #0d6efd;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    background: #f0f7ff;
    cursor: pointer;
    transition: background .15s;
}
.upload-zone:hover { background: #dbeeff; }
.upload-zone .fa-cloud-arrow-up { font-size: 2.5rem; color: #0d6efd; }

/* ------------------------------------------------------------------
   ACTIVE LIMIT PROGRESS BAR
------------------------------------------------------------------ */
.active-limit-bar {
    height: 6px;
    border-radius: 3px;
    background: #dee2e6;
    overflow: hidden;
    margin-top: 4px;
}
.active-limit-bar .fill {
    height: 100%;
    border-radius: 3px;
    background: #28a745;
    transition: width .3s;
}
.active-limit-bar .fill.at-limit { background: #dc3545; }

/* ------------------------------------------------------------------
   SUMMARY TABLE
------------------------------------------------------------------ */
.summary-table th { font-size: .8rem; white-space: nowrap; }
.summary-table td { font-size: .85rem; vertical-align: middle; }

.attempt-pips     { display: flex; gap: 4px; align-items: center; }
.attempt-pip {
    width: 10px; height: 10px; border-radius: 50%;
    background: #dee2e6;
    display: inline-block;
    flex-shrink: 0;
}
.attempt-pip.used  { background: #dc3545; }
.attempt-pip.avail { background: #28a745; }

.score-bar-wrap {
    height: 6px; background: #dee2e6; border-radius: 3px;
    overflow: hidden; min-width: 60px;
}
.score-bar-fill {
    height: 100%; border-radius: 3px; transition: width .3s;
}

.emp-id-badge {
    font-size: .72rem;
    background: #e8f4fd;
    color: #0a58ca;
    border: 1px solid #b6d4fe;
    border-radius: 20px;
    padding: 1px 8px;
    font-weight: 600;
    white-space: nowrap;
}
.branch-badge {
    font-size: .72rem;
    background: #fff3cd;
    color: #664d03;
    border: 1px solid #ffda6a;
    border-radius: 20px;
    padding: 1px 8px;
    font-weight: 600;
    white-space: nowrap;
}
.position-badge {
    font-size: .72rem;
    background: #f0e6ff;
    color: #4a0d8f;
    border: 1px solid #d3b4fd;
    border-radius: 20px;
    padding: 1px 8px;
    font-weight: 600;
    white-space: nowrap;
    display: inline-block;
}

/* ------------------------------------------------------------------
   HISTORY MODAL
------------------------------------------------------------------ */
.history-modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,.55);
    z-index: 9999; display: none;
    align-items: flex-start; justify-content: center;
    padding: 30px 15px; overflow-y: auto;
}
.history-modal-overlay.show { display: flex; }
.history-modal {
    background: #fff; border-radius: 10px; width: 100%; max-width: 840px;
    box-shadow: 0 8px 40px rgba(0,0,0,.25); margin: auto;
}
.history-modal .hm-header {
    background: #212529; color: #fff; padding: 14px 20px;
    border-radius: 10px 10px 0 0;
    display: flex; justify-content: space-between; align-items: center;
}
.history-modal .hm-body { padding: 20px; max-height: 72vh; overflow-y: auto; }
.attempt-block { border: 1px solid #dee2e6; border-radius: 8px; margin-bottom: 16px; overflow: hidden; }
.attempt-block .ab-header {
    background: #f8f9fa; padding: 10px 14px;
    display: flex; justify-content: space-between; align-items: center;
    border-bottom: 1px solid #dee2e6; font-size: .88rem;
}
.q-detail-row { padding: 9px 14px; border-bottom: 1px solid #f0f0f0; font-size: .83rem; }
.q-detail-row:last-child { border-bottom: none; }
.q-detail-row.q-wrong { background: #fff6f6; }
.q-detail-row.q-right { background: #f6fff8; }
.choice-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3px; margin-top: 5px; padding-left: 12px; }
.choice-item { font-size: .79rem; padding: 1px 0; color: #495057; }
.choice-item.is-correct { color: #155724; font-weight: 700; }
.choice-item.is-wrong-pick { color: #721c24; text-decoration: underline dotted; }

/* ------------------------------------------------------------------
   QUESTIONNAIRE MODAL — iframe container
------------------------------------------------------------------ */
#qModalFrame {
    width: 100%;
    min-height: 520px;
    border: none;
    display: block;
}

/* questionnaire modal body — no extra padding so iframe fills flush */
#qOverlay .hm-body {
    padding: 0;
    overflow: hidden;
}

/* Print styles */
@media print {
    .no-print { display: none !important; }
    .attempt-pip.used   { background: #dc3545 !important; -webkit-print-color-adjust: exact; }
    .attempt-pip.avail  { background: #28a745 !important; -webkit-print-color-adjust: exact; }
}
</style>

<div class="container-fluid mt-3 px-4">

    <!-- ================================================================ -->
    <!-- HEADER                                                            -->
    <!-- ================================================================ -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-11">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Online Training Management
                    </h5>
                    <span class="badge <?= $activeCount > 0 ? 'bg-success' : 'bg-secondary' ?> px-3 py-2">
                        <?php if ($activeCount > 0): ?>
                            <i class="fa-solid fa-circle-check mr-1"></i> <?= $activeCount ?> / <?= MAX_ACTIVE ?> Active
                        <?php else: ?>
                            <i class="fa-solid fa-circle-xmark mr-1"></i> No Active Material
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <?php if ($message): ?>
    <div class="row justify-content-center mb-3">
        <div class="col-md-11">
            <div class="alert alert-<?= $msgType ?> alert-dismissible fade show py-2">
                <i class="fa-solid fa-<?= $msgType === 'success' ? 'circle-check' : ($msgType === 'danger' ? 'circle-xmark' : 'circle-info') ?> mr-2"></i>
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ================================================================ -->
    <!-- EXAM RESULTS SUMMARY                                              -->
    <!-- ================================================================ -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-11">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fa-solid fa-chart-bar mr-2"></i> Exam Results Summary
                    </h6>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark"><?= count($summaryRows) ?> record(s)</span>
                        <button class="btn btn-sm btn-outline-light no-print" onclick="printOverallReport()">
                            <i class="fa-solid fa-print mr-1"></i> Print Report
                        </button>
                        <button class="btn btn-sm btn-outline-light no-print" onclick="exportCSV()">
                            <i class="fa-solid fa-file-csv mr-1"></i> Export CSV
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($summaryRows)): ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-inbox fa-3x mb-3 d-block"></i>
                            No exam attempts recorded yet.
                        </div>
                    <?php else: ?>

                    <!-- Search / Filter Controls -->
                    <div class="px-3 pt-3 pb-2 d-flex flex-wrap gap-2 align-items-end" id="summaryControls">
                        <div style="min-width:220px; flex:1;">
                            <label class="form-label mb-1" style="font-size:.78rem; font-weight:600; color:#495057;">
                                <i class="fa-solid fa-magnifying-glass me-1"></i> Search
                            </label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="summarySearch" class="form-control border-end-0"
                                    placeholder="Name, Emp ID, Branch, Position, Material…" autocomplete="off">
                                <button class="btn btn-outline-secondary border-start-0" type="button"
                                        id="summaryClearBtn" style="display:none;" onclick="clearSummarySearch()">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div style="min-width:140px;">
                            <label class="form-label mb-1" style="font-size:.78rem; font-weight:600; color:#495057;">
                                <i class="fa-solid fa-filter me-1"></i> Status
                            </label>
                            <select id="summaryFilterStatus" class="form-select form-select-sm">
                                <option value="">All Status</option>
                                <option value="passed">Passed</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                        <div style="min-width:180px;">
                            <label class="form-label mb-1" style="font-size:.78rem; font-weight:600; color:#495057;">
                                <i class="fa-solid fa-file-pdf me-1"></i> Material
                            </label>
                            <select id="summaryFilterMaterial" class="form-select form-select-sm">
                                <option value="">All Materials</option>
                                <?php
                                $uniqueMaterials = [];
                                foreach ($summaryRows as $sr) {
                                    $key = (int)$sr['material_id'];
                                    if (!isset($uniqueMaterials[$key])) {
                                        $uniqueMaterials[$key] = $sr['original_name'];
                                    }
                                }
                                foreach ($uniqueMaterials as $mid => $mname):
                                ?>
                                <option value="<?= $mid ?>">
                                    <?= htmlspecialchars(strlen($mname) > 35 ? substr($mname, 0, 32) . '…' : $mname) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="ms-auto align-self-end">
                            <small class="text-muted" id="summaryCount"></small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered summary-table mb-0">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="ps-3 text-center">Emp ID</th>
                                    <th>Employee</th>
                                    <th>Branch</th>
                                    <th>Position</th>
                                    <th>Material</th>
                                    <th class="text-center">Attempts</th>
                                    <th class="text-center">Best Score</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Last Attempt</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center no-print">History</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($summaryRows as $sr):
                                $attemptsUsed   = (int)$sr['attempts_used'];
                                $bestScore      = (int)$sr['best_score'];
                                $totalQuestions = (int)$sr['total_questions'];
                                $everPassed     = (int)$sr['ever_passed'];
                                $exhausted      = ($attemptsUsed >= MAX_ATTEMPTS);
                                $pct = ($totalQuestions > 0)
                                    ? round(($bestScore / $totalQuestions) * 100)
                                    : 0;
                                $barColor = $pct >= 75 ? '#28a745' : ($pct >= 50 ? '#ffc107' : '#dc3545');
                            ?>
                            <tr>
                                <td class="ps-3 text-center">
                                    <?php if (!empty($sr['employeeId'])): ?>
                                        <span class="emp-id-badge"><?= htmlspecialchars($sr['employeeId']) ?></span>
                                    <?php else: ?>
                                        <small class="text-muted">—</small>
                                    <?php endif; ?>
                                </td>
                                <td class="font-weight-bold">
                                    <i class="fa-solid fa-user-tie text-secondary mr-1"></i>
                                    <?= htmlspecialchars($sr['fullName']) ?>
                                </td>
                                <td>
                                    <?php if (!empty($sr['address'])): ?>
                                        <span class="branch-badge">
                                            <i class="fa-solid fa-building-columns mr-1"></i>
                                            <?= htmlspecialchars($sr['address']) ?>
                                        </span>
                                    <?php else: ?>
                                        <small class="text-muted">—</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($sr['bankPosition'])): ?>
                                        <span class="position-badge"><?= htmlspecialchars($sr['bankPosition']) ?></span>
                                    <?php else: ?>
                                        <small class="text-muted">—</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span title="<?= htmlspecialchars($sr['original_name']) ?>">
                                        <?= htmlspecialchars(
                                            strlen($sr['original_name']) > 30
                                                ? substr($sr['original_name'], 0, 27) . '…'
                                                : $sr['original_name']
                                        ) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="attempt-pips justify-content-center">
                                        <?php for ($p = 0; $p < MAX_ATTEMPTS; $p++): ?>
                                            <span class="attempt-pip <?= $p < $attemptsUsed ? 'used' : 'avail' ?>"
                                                  title="<?= $p < $attemptsUsed ? 'Used' : 'Available' ?>"></span>
                                        <?php endfor; ?>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        <?= $attemptsUsed ?> / <?= MAX_ATTEMPTS ?>
                                        <?php if ($exhausted): ?>
                                            <span class="text-danger font-weight-bold">&mdash; Exhausted</span>
                                        <?php endif; ?>
                                    </small>
                                </td>
                                <td class="text-center" style="min-width:110px;">
                                    <?php if ($totalQuestions > 0): ?>
                                        <div class="score-bar-wrap mx-auto mb-1">
                                            <div class="score-bar-fill"
                                                 style="width:<?= $pct ?>%; background:<?= $barColor ?>;"></div>
                                        </div>
                                        <small>
                                            <?= $bestScore ?> / <?= $totalQuestions ?>
                                            <span style="color:<?= $barColor ?>; font-weight:700;">(<?= $pct ?>%)</span>
                                        </small>
                                    <?php else: ?>
                                        <small class="text-muted">N/A</small>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($everPassed): ?>
                                        <span class="badge bg-success text-white px-2 py-1">
                                            <i class="fa-solid fa-circle-check mr-1"></i> Passed
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger text-white px-2 py-1">
                                            <i class="fa-solid fa-circle-xmark mr-1"></i> Failed
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <small><?= date('M d, Y h:i A', strtotime($sr['last_attempt'])) ?></small>
                                </td>
                                <td class="text-center">
                                    <?php if ($attemptsUsed > 0): ?>
                                    <form method="POST" style="margin:0;">
                                        <input type="hidden" name="action"            value="reset_attempts">
                                        <input type="hidden" name="reset_user_id"     value="<?= (int)$sr['user_id'] ?>">
                                        <input type="hidden" name="reset_material_id" value="<?= (int)$sr['material_id'] ?>">
                                        <input type="hidden" name="csrf_token"        value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-warning"
                                                onclick="return confirm('Reset all <?= $attemptsUsed ?> attempt(s) for <?= addslashes(htmlspecialchars($sr['fullName'])) ?>? This cannot be undone.')">
                                            <i class="fa-solid fa-rotate-left mr-1"></i> Reset
                                        </button>
                                    </form>
                                    <?php else: ?>
                                        <small class="text-muted">—</small>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center no-print">
                                    <button class="btn btn-sm btn-outline-info"
                                            onclick="openHistory(<?= (int)$sr['user_id'] ?>, <?= (int)$sr['material_id'] ?>, '<?= addslashes(htmlspecialchars($sr['fullName'])) ?>', '<?= addslashes(htmlspecialchars(preg_replace('/\.pdf$/i','', $sr['original_name']))) ?>')">
                                        <i class="fa-solid fa-clock-rotate-left mr-1"></i> View
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Each employee has a maximum of <?= MAX_ATTEMPTS ?> attempts per material.
                        Resetting removes all recorded attempts and scores for that user and material.
                        &nbsp;&mdash;&nbsp;
                        <span class="attempt-pip used d-inline-block" style="vertical-align:middle;"></span> Used &nbsp;
                        <span class="attempt-pip avail d-inline-block" style="vertical-align:middle;"></span> Available
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================ -->
    <!-- UPLOAD + MATERIALS LIST                                           -->
    <!-- ================================================================ -->
    <div class="row justify-content-center">

        <!-- Upload Form -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fa-solid fa-upload mr-2"></i> Upload Exam Material</h6>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="uploadForm">
                        <input type="hidden" name="action"     value="upload">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                        <div class="upload-zone mb-3" onclick="document.getElementById('pdf_file').click()">
                            <i class="fa-solid fa-cloud-arrow-up d-block mb-2"></i>
                            <p class="mb-1 font-weight-bold text-primary">Click to select a PDF file</p>
                            <small class="text-muted">PDF only &bull; Maximum 20MB</small>
                            <p id="fileName" class="mt-2 mb-0 small text-dark font-weight-bold"></p>
                        </div>

                        <input type="file" id="pdf_file" name="pdf_file" accept=".pdf"
                               class="d-none" onchange="showFileName(this)">

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="set_active" name="set_active" value="1"
                                   <?= $activeCount >= MAX_ACTIVE ? 'disabled' : '' ?>>
                            <label class="form-check-label" for="set_active">
                                Set as <strong>active</strong> immediately
                                <?php if ($activeCount >= MAX_ACTIVE): ?>
                                    <span class="text-danger small d-block">Active limit reached (<?= MAX_ACTIVE ?>). Deactivate one first.</span>
                                <?php endif; ?>
                            </label>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Active slots used</small>
                                <small class="<?= $activeCount >= MAX_ACTIVE ? 'text-danger' : 'text-success' ?> font-weight-bold">
                                    <?= $activeCount ?> / <?= MAX_ACTIVE ?>
                                </small>
                            </div>
                            <div class="active-limit-bar">
                                <div class="fill <?= $activeCount >= MAX_ACTIVE ? 'at-limit' : '' ?>"
                                     style="width: <?= ($activeCount / MAX_ACTIVE) * 100 ?>%"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block w-100" id="uploadBtn" disabled>
                            <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Upload PDF
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Up to <?= MAX_ACTIVE ?> materials can be active at the same time.
                        Only active materials are visible to employees in the reviewer.
                    </small>
                </div>
            </div>
        </div>

        <!-- Materials List -->
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fa-solid fa-list mr-2"></i> Uploaded Materials
                    </h6>
                    <span class="badge bg-light text-dark"><?= count($materials) ?> file(s)</span>
                </div>
                <div class="card-body">
                    <?php if (empty($materials)): ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-folder-open fa-3x mb-3 d-block"></i>
                            No materials have been uploaded yet.
                        </div>
                    <?php else: ?>
                        <?php foreach ($materials as $mat):
                            $matId  = (int)$mat['id'];
                            $qCount = (int)$mat['question_count'];
                        ?>
                        <div class="material-card <?= $mat['is_active'] ? 'is-active' : 'is-inactive' ?>"
                             id="mc-<?= $matId ?>">
                            <div class="d-flex justify-content-between align-items-start">
                                <div style="flex:1; min-width:0; padding-right:10px;">
                                    <?php if ($mat['is_active']): ?>
                                        <span class="badge bg-success text-white mb-1">
                                            <i class="fa-solid fa-circle-check mr-1"></i> ACTIVE
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary text-white mb-1">Inactive</span>
                                    <?php endif; ?>
                                    <span class="badge bg-info text-dark mb-1 ml-1">
                                        <i class="fa-solid fa-circle-question mr-1"></i>
                                        <?= $qCount ?> question<?= $qCount !== 1 ? 's' : '' ?>
                                    </span>

                                    <!-- Inline rename -->
                                    <div class="d-flex align-items-center gap-2 mt-1" id="name-display-<?= $matId ?>">
                                        <i class="fa-solid fa-file-pdf text-danger"></i>
                                        <span class="font-weight-bold text-truncate" id="name-text-<?= $matId ?>">
                                            <?= htmlspecialchars($mat['display_name'] ?? $mat['original_name']) ?>
                                        </span>
                                        <button class="btn btn-sm btn-link p-0 text-muted"
                                                style="font-size:.75rem; flex-shrink:0;"
                                                onclick="event.stopPropagation(); startRename(<?= $matId ?>)"
                                                title="Rename">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </div>
                                    <div class="d-none align-items-center gap-2 mt-1" id="name-edit-<?= $matId ?>">
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               id="name-input-<?= $matId ?>"
                                               value="<?= htmlspecialchars($mat['display_name'] ?? $mat['original_name']) ?>"
                                               style="max-width:220px;"
                                               onclick="event.stopPropagation()">
                                        <button class="btn btn-sm btn-success"
                                                onclick="event.stopPropagation(); saveRename(<?= $matId ?>)">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary"
                                                onclick="event.stopPropagation(); cancelRename(<?= $matId ?>)">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">
                                        Uploaded by <?= htmlspecialchars($mat['fullName'] ?? 'Unknown') ?>
                                        &bull; <?= date('M d, Y h:i A', strtotime($mat['uploaded_at'])) ?>
                                    </small>
                                </div>

                                <div class="d-flex flex-column" style="gap:4px; min-width:130px;">

                                    <!-- Preview -->
                                    <a href="materials/<?= htmlspecialchars($mat['filename']) ?>"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fa-solid fa-eye mr-1"></i> Preview
                                    </a>

                                    <!-- Thumbnail upload -->
                                    <form method="POST" enctype="multipart/form-data" style="margin:0;"
                                          onclick="event.stopPropagation()">
                                        <input type="hidden" name="action"           value="upload_thumbnail">
                                        <input type="hidden" name="material_id"      value="<?= $matId ?>">
                                        <input type="hidden" name="csrf_token"       value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                        <input type="hidden" name="open_material_id" value="<?= $matId ?>">
                                        <div onclick="event.stopPropagation()">
                                            <label class="btn btn-sm btn-outline-info w-100 mb-0" style="cursor:pointer;">
                                                <?php if (!empty($mat['thumbnail'])): ?>
                                                    <i class="fa-solid fa-image mr-1"></i> Change Thumb
                                                <?php else: ?>
                                                    <i class="fa-solid fa-image mr-1"></i> Set Thumbnail
                                                <?php endif; ?>
                                                <input type="file" name="thumbnail_file" accept=".jpg,.jpeg,.png,.webp"
                                                       class="d-none"
                                                       onchange="this.closest('form').submit()">
                                            </label>
                                            <div style="font-size:.68rem; color:#6c757d; text-align:center; margin-top:2px; line-height:1.3;">
                                                480×620px · JPG/PNG
                                            </div>
                                        </div>
                                    </form>

                                    <?php if (!empty($mat['thumbnail'])): ?>
                                    <!-- <div style="text-align:center;">
                                        <img src="materials/<?= htmlspecialchars($mat['thumbnail']) ?>"
                                             style="width:45px; height:58px; object-fit:cover; border-radius:4px; border:1px solid #dee2e6;"
                                             alt="Thumbnail preview">
                                    </div> -->
                                    <img src="materials/<?= htmlspecialchars($mat['thumbnail']) ?>"
                                        style="width:45px; height:58px; object-fit:contain; border-radius:4px; border:1px solid #dee2e6; background:#f0f4f8;"
                                        alt="Thumbnail preview">
                                    <?php endif; ?>

                                    <!-- Questionnaire modal trigger -->
                                    <button class="btn btn-sm btn-outline-primary"
                                            onclick="openQModal(<?= $matId ?>, this.dataset.name)"
                                            data-name="<?= htmlspecialchars($mat['display_name'] ?? $mat['original_name'], ENT_QUOTES) ?>">
                                        <i class="fa-solid fa-list-check mr-1"></i> Questionnaire
                                    </button>

                                    <?php if (!$mat['is_active']): ?>

                                    <!-- Activate -->
                                    <form method="POST" style="margin:0;">
                                        <input type="hidden" name="action"      value="activate">
                                        <input type="hidden" name="material_id" value="<?= $matId ?>">
                                        <input type="hidden" name="csrf_token"  value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                        <button type="submit"
                                                class="btn btn-sm btn-success w-100"
                                                <?= $activeCount >= MAX_ACTIVE ? 'disabled title="Active limit reached"' : '' ?>
                                                onclick="return confirm('Set this material as active?')">
                                            <i class="fa-solid fa-circle-check mr-1"></i> Set Active
                                        </button>
                                    </form>

                                    <!-- Delete -->
                                    <form method="POST" style="margin:0;">
                                        <input type="hidden" name="action"      value="delete">
                                        <input type="hidden" name="material_id" value="<?= $matId ?>">
                                        <input type="hidden" name="csrf_token"  value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger w-100"
                                                onclick="return confirm('Delete \'<?= addslashes(htmlspecialchars($mat['original_name'])) ?>\'?')">
                                            <i class="fa-solid fa-trash mr-1"></i> Delete
                                        </button>
                                    </form>

                                    <?php else: ?>

                                    <!-- Deactivate -->
                                    <form method="POST" style="margin:0;">
                                        <input type="hidden" name="action"      value="deactivate">
                                        <input type="hidden" name="material_id" value="<?= $matId ?>">
                                        <input type="hidden" name="csrf_token"  value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                        <button type="submit"
                                                class="btn btn-sm btn-warning w-100"
                                                onclick="return confirm('Deactivate this material?')">
                                            <i class="fa-solid fa-circle-xmark mr-1"></i> Deactivate
                                        </button>
                                    </form>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div><!-- /upload + materials row -->

    <!-- ================================================================ -->
    <!-- HISTORY MODAL                                                     -->
    <!-- ================================================================ -->
    <div class="history-modal-overlay no-print" id="historyOverlay" onclick="closeHistory(event)">
        <div class="history-modal" onclick="event.stopPropagation()">
            <div class="hm-header">
                <div>
                    <div style="font-weight:700; font-size:1rem;" id="hmEmployeeName">—</div>
                    <div style="font-size:.78rem; opacity:.7;" id="hmMaterialName">—</div>
                </div>
                <button onclick="closeHistory()" style="background:none; border:none; color:#fff; font-size:1.3rem; cursor:pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="hm-body" id="hmBody">
                <div class="text-center py-4 text-muted">
                    <i class="fa-solid fa-spinner fa-spin fa-2x mb-2 d-block"></i>
                    Loading history...
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================ -->
    <!-- QUESTIONNAIRE MODAL                                               -->
    <!-- Loads questionnaire.php inside an iframe — same origin, same     -->
    <!-- session, so auth + CSRF work without any extra plumbing.         -->
    <!-- ================================================================ -->
    <!-- <div class="history-modal-overlay no-print" id="qOverlay" onclick="closeQModal(event)"> -->
        <div class="history-modal-overlay no-print" id="qOverlay">
        <div class="history-modal" onclick="event.stopPropagation()">
            <div class="hm-header">
                <div>
                    <div style="font-weight:700; font-size:1rem;">
                        <i class="fa-solid fa-list-check mr-2"></i> Questionnaire
                    </div>
                    <div style="font-size:.78rem; opacity:.7;" id="qModalMatName"></div>
                </div>
                <button onclick="closeQModal()" style="background:none; border:none; color:#fff; font-size:1.3rem; cursor:pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <!-- No padding — iframe fills flush to the modal edges -->
            <!-- <div class="hm-body" id="qModalBody"></div> -->
             <!-- No padding — iframe fills flush to the modal edges -->
            <div class="hm-body" id="qModalBody"></div>
            <div style="padding:12px 16px; border-top:1px solid #dee2e6; background:#f8f9fa; border-radius:0 0 10px 10px; text-align:right;">
                <button class="btn btn-primary" onclick="closeQModal()">
                    <i class="fa-solid fa-check me-1"></i> Submit
                </button>
            </div>
        </div>
    </div>
        </div>
    </div>

</div><!-- /container -->

<script>
// ================================================================
// FILE UPLOAD
// ================================================================
function showFileName(input) {
    var label = document.getElementById('fileName');
    var btn   = document.getElementById('uploadBtn');
    if (input.files && input.files[0]) {
        label.textContent = '\uD83D\uDCC4 ' + input.files[0].name;
        btn.disabled = false;
    } else {
        label.textContent = '';
        btn.disabled = true;
    }
}

// ================================================================
// SUMMARY TABLE — Search / Filter / Pagination
// ================================================================
(function () {
    var PAGE_SIZE = 10;
    var currentPage = 1;

    var tbody   = document.querySelector('.summary-table tbody');
    if (!tbody) return;
    var allRows = Array.from(tbody.querySelectorAll('tr'));

    var searchEl   = document.getElementById('summarySearch');
    var clearBtn   = document.getElementById('summaryClearBtn');
    var statusEl   = document.getElementById('summaryFilterStatus');
    var materialEl = document.getElementById('summaryFilterMaterial');
    var countEl    = document.getElementById('summaryCount');

    var paginationWrap = document.createElement('div');
    paginationWrap.className = 'px-3 pb-3 pt-2 d-flex justify-content-between align-items-center flex-wrap gap-2';
    paginationWrap.id = 'summaryPagination';
    var tableResponsive = document.querySelector('.summary-table').closest('.table-responsive');
    tableResponsive.insertAdjacentElement('afterend', paginationWrap);

    function getRowText(row) {
        return [0,1,2,3,4].map(function(i) {
            return (row.cells[i] ? row.cells[i].innerText : '').toLowerCase();
        }).join(' ');
    }

    function getRowStatus(row) {
        var cell = row.cells[7];
        if (!cell) return '';
        var text = cell.innerText.trim().toLowerCase();
        return text.includes('passed') ? 'passed' : 'failed';
    }

    function getRowMaterialId(row) {
        return row.getAttribute('data-material-id') || '';
    }

    function applyFilters() {
        var q        = (searchEl.value || '').trim().toLowerCase();
        var status   = statusEl.value;
        var material = materialEl.value;

        clearBtn.style.display = q ? 'inline-block' : 'none';

        var filtered = allRows.filter(function(row) {
            var matchSearch   = !q        || getRowText(row).includes(q);
            var matchStatus   = !status   || getRowStatus(row) === status;
            var matchMaterial = !material || getRowMaterialId(row) === material;
            return matchSearch && matchStatus && matchMaterial;
        });

        currentPage = 1;
        renderPage(filtered);
    }

    function renderPage(filtered) {
        var total = filtered.length;
        var pages = Math.max(1, Math.ceil(total / PAGE_SIZE));
        if (currentPage > pages) currentPage = pages;

        var start = (currentPage - 1) * PAGE_SIZE;
        var end   = start + PAGE_SIZE;

        allRows.forEach(function(row) { row.style.display = 'none'; });
        filtered.forEach(function(row, i) {
            row.style.display = (i >= start && i < end) ? '' : 'none';
        });

        if (countEl) {
            countEl.textContent = total === 0
                ? 'No records found'
                : 'Showing ' + (Math.min(start + 1, total)) + '–' + Math.min(end, total) + ' of ' + total + ' record(s)';
        }

        var emptyRow = tbody.querySelector('.summary-empty-row');
        if (total === 0) {
            if (!emptyRow) {
                emptyRow = document.createElement('tr');
                emptyRow.className = 'summary-empty-row';
                emptyRow.innerHTML = '<td colspan="11" class="text-center py-4 text-muted">' +
                    '<i class="fa-solid fa-circle-exclamation me-1"></i> No records match your search.</td>';
                tbody.appendChild(emptyRow);
            }
            emptyRow.style.display = '';
        } else {
            if (emptyRow) emptyRow.style.display = 'none';
        }

        renderPagination(filtered, total, pages);
    }

    function renderPagination(filtered, total, pages) {
        paginationWrap.innerHTML = '';
        if (pages <= 1 && total <= PAGE_SIZE) return;

        var prev = document.createElement('button');
        prev.className = 'btn btn-sm btn-outline-secondary';
        prev.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
        prev.disabled  = (currentPage === 1);
        prev.onclick   = function() { currentPage--; renderPage(filtered); };

        var pageGroup = document.createElement('div');
        pageGroup.className = 'd-flex gap-1';

        var half   = 2;
        var pStart = Math.max(1, currentPage - half);
        var pEnd   = Math.min(pages, pStart + 4);
        if (pEnd - pStart < 4) pStart = Math.max(1, pEnd - 4);

        for (var p = pStart; p <= pEnd; p++) {
            (function(pg) {
                var btn = document.createElement('button');
                btn.className = 'btn btn-sm ' + (pg === currentPage ? 'btn-dark' : 'btn-outline-secondary');
                btn.textContent = pg;
                btn.onclick = function() { currentPage = pg; renderPage(filtered); };
                pageGroup.appendChild(btn);
            })(p);
        }

        var next = document.createElement('button');
        next.className = 'btn btn-sm btn-outline-secondary';
        next.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
        next.disabled  = (currentPage === pages);
        next.onclick   = function() { currentPage++; renderPage(filtered); };

        var info = document.createElement('small');
        info.className = 'text-muted align-self-center';
        info.textContent = 'Page ' + currentPage + ' of ' + pages;

        paginationWrap.appendChild(prev);
        paginationWrap.appendChild(pageGroup);
        paginationWrap.appendChild(next);
        paginationWrap.appendChild(info);
    }

    // Stamp material_id onto each <tr> for filter
    <?php foreach ($summaryRows as $idx => $sr): ?>
    (function() {
        var row = allRows[<?= $idx ?>];
        if (row) row.setAttribute('data-material-id', '<?= (int)$sr['material_id'] ?>');
    })();
    <?php endforeach; ?>

    searchEl.addEventListener('input', applyFilters);
    statusEl.addEventListener('change', applyFilters);
    materialEl.addEventListener('change', applyFilters);

    applyFilters();

    // ================================================================
    // HISTORY MODAL
    // ================================================================
    window.openHistory = function(userId, materialId, employeeName, materialName) {
        document.getElementById('hmEmployeeName').textContent = employeeName;
        document.getElementById('hmMaterialName').textContent = materialName;
        document.getElementById('hmBody').innerHTML =
            '<div class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin fa-2x mb-2 d-block"></i>Loading history...</div>';
        document.getElementById('historyOverlay').classList.add('show');

        fetch('get-attempt-details.php?user_id=' + userId + '&material_id=' + materialId)
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!data.ok || !data.attempts.length) {
                    document.getElementById('hmBody').innerHTML =
                        '<div class="text-center py-4 text-muted">No attempt history found.</div>';
                    return;
                }
                var answerLetters = ['A','B','C','D'];
                var html = '';
                data.attempts.forEach(function(a, ai) {
                    var pct    = a.total > 0 ? Math.round((a.score / a.total) * 100) : 0;
                    var passed = a.passed == 1;
                    var date   = new Date(a.taken_at).toLocaleString('en-PH', {
                        month: 'short', day: 'numeric', year: 'numeric',
                        hour: 'numeric', minute: '2-digit', hour12: true
                    });
                    html += '<div class="attempt-block">';
                    html += '<div class="ab-header">';
                    html += '<span><strong>Attempt ' + (ai + 1) + '</strong> &mdash; ' + date + '</span>';
                    html += '<span>' +
                        '<span class="badge ' + (passed ? 'bg-success' : 'bg-danger') + ' me-2">' +
                        (passed ? 'PASSED' : 'FAILED') + '</span>' +
                        '<strong>' + a.score + '/' + a.total + '</strong> (' + pct + '%)' +
                    '</span>';
                    html += '</div>';

                    if (!a.details || !a.details.length) {
                        html += '<div class="q-detail-row text-muted">No question details recorded for this attempt.</div>';
                    } else {
                        a.details.forEach(function(d, di) {
                            var correct  = parseInt(d.correct_answer);
                            var userAns  = d.user_answer !== null ? parseInt(d.user_answer) : null;
                            var isRight  = d.is_correct == 1;
                            var choices  = [d.choice_a, d.choice_b, d.choice_c, d.choice_d];
                            html += '<div class="q-detail-row ' + (isRight ? 'q-right' : 'q-wrong') + '">';
                            html += '<div style="display:flex; gap:8px; align-items:flex-start;">';
                            html += '<span class="badge ' + (isRight ? 'bg-success' : 'bg-danger') + ' mt-1" style="flex-shrink:0;">' + (di + 1) + '</span>';
                            html += '<div style="flex:1;">';
                            html += '<div style="font-weight:600; margin-bottom:4px;">' + escHtml(d.question_text) + '</div>';
                            html += '<div class="choice-grid">';
                            choices.forEach(function(ch, ci) {
                                var cls  = '';
                                if (ci === correct && ci === userAns) cls = 'is-correct';
                                else if (ci === correct)              cls = 'is-correct';
                                else if (ci === userAns)              cls = 'is-wrong-pick';
                                var icon = '';
                                if (ci === correct)             icon = ' <i class="fa-solid fa-check" style="color:#155724;"></i>';
                                if (ci === userAns && !isRight) icon = ' <i class="fa-solid fa-xmark" style="color:#721c24;"></i>';
                                html += '<div class="choice-item ' + cls + '"><strong>' + answerLetters[ci] + '.</strong> ' + escHtml(ch) + icon + '</div>';
                            });
                            html += '</div>';
                            if (userAns === null) {
                                html += '<small class="text-muted">Not answered</small>';
                            }
                            html += '</div></div></div>';
                        });
                    }
                    html += '</div>';
                });
                document.getElementById('hmBody').innerHTML = html;
            })
            .catch(function() {
                document.getElementById('hmBody').innerHTML =
                    '<div class="text-center py-4 text-danger">Failed to load history.</div>';
            });
    };

    window.closeHistory = function(e) {
        if (!e || e.target === document.getElementById('historyOverlay')) {
            document.getElementById('historyOverlay').classList.remove('show');
        }
    };

    // ================================================================
    // PRINT / EXPORT
    // ================================================================
    function getFilteredRows() {
        var q        = (searchEl.value || '').trim().toLowerCase();
        var status   = statusEl.value;
        var material = materialEl.value;
        return allRows.filter(function(r) {
            if (r.classList.contains('summary-empty-row')) return false;
            var matchSearch   = !q        || getRowText(r).includes(q);
            var matchStatus   = !status   || getRowStatus(r) === status;
            var matchMaterial = !material || getRowMaterialId(r) === material;
            return matchSearch && matchStatus && matchMaterial;
        });
    }

    function cellText(cell) { return cell ? cell.innerText.trim() : ''; }

    function csvEscape(val) {
        val = String(val).replace(/"/g, '""');
        return '"' + val + '"';
    }

    function getMaterialLabel() {
        var materialSelect = document.getElementById('summaryFilterMaterial');
        if (materialSelect && materialSelect.value !== '') {
            return materialSelect.options[materialSelect.selectedIndex].text.trim()
                .replace(/[^a-zA-Z0-9\s]/g, '')
                .replace(/\s+/g, '_')
                .toLowerCase()
                .substring(0, 40);
        }
        return 'all_materials';
    }

    window.printOverallReport = function() {
        var printWin      = window.open('', '_blank', 'width=1000,height=700');
        var rows          = getFilteredRows();
        var materialLabel = getMaterialLabel();
        var dateStr       = new Date().toLocaleDateString('en-PH', { month:'long', day:'numeric', year:'numeric' });
        var titleStr      = 'Exam Report — ' + materialLabel.replace(/_/g, ' ') + ' — ' + dateStr;

        var tableHtml = '<table border="1" cellpadding="6" cellspacing="0" '
            + 'style="width:100%; border-collapse:collapse; font-size:11px;">'
            + '<thead style="background:#212529; color:#fff;">'
            + '<tr><th>Emp ID</th><th>Employee</th><th>Branch</th><th>Position</th>'
            + '<th>Material</th><th>Attempts</th><th>Best Score</th>'
            + '<th>Status</th><th>Last Attempt</th></tr>'
            + '</thead><tbody>';

        rows.forEach(function(row) {
            var cells  = row.cells;
            var passed = (cells[7] ? cells[7].innerText.trim().toLowerCase() : '').includes('passed');
            var color  = passed ? '#d4edda' : '#f8d7da';
            tableHtml += '<tr style="background:' + color + ';">'
                + '<td>' + cellText(cells[0]) + '</td>'
                + '<td>' + cellText(cells[1]) + '</td>'
                + '<td>' + cellText(cells[2]) + '</td>'
                + '<td>' + cellText(cells[3]) + '</td>'
                + '<td>' + cellText(cells[4]) + '</td>'
                + '<td>' + cellText(cells[5]) + '</td>'
                + '<td>' + cellText(cells[6]) + '</td>'
                + '<td>' + cellText(cells[7]) + '</td>'
                + '<td>' + cellText(cells[8]) + '</td>'
                + '</tr>';
        });
        tableHtml += '</tbody></table>';

        printWin.document.write(
            '<html><head><title>' + titleStr + '</title>'
            + '<style>body{font-family:Arial,sans-serif; padding:20px;} h2{margin-bottom:4px;} p{margin-top:0;}</style>'
            + '</head><body>'
            + '<h2>' + titleStr + '</h2>'
            + '<p style="font-size:11px; color:#555; margin-bottom:12px;">' + rows.length + ' record(s)</p>'
            + tableHtml
            + '<script>window.onload=function(){window.print();window.close();}<\/script>'
            + '</body></html>'
        );
        printWin.document.close();
    };

    window.exportCSV = function() {
        var rows          = getFilteredRows();
        var materialLabel = getMaterialLabel();
        var dateStr       = new Date().toISOString().slice(0, 10);
        var filename      = 'exam_report_' + materialLabel + '_' + dateStr + '.csv';

        var header = ['Emp ID','Employee','Branch','Position','Material',
                      'Attempts Used','Best Score','Status','Last Attempt'];
        var lines  = [header.map(csvEscape).join(',')];

        rows.forEach(function(row) {
            var cells = row.cells;
            lines.push([
                csvEscape(cellText(cells[0])),
                csvEscape(cellText(cells[1])),
                csvEscape(cellText(cells[2])),
                csvEscape(cellText(cells[3])),
                csvEscape(cellText(cells[4])),
                csvEscape(cellText(cells[5])),
                csvEscape(cellText(cells[6])),
                csvEscape(cellText(cells[7])),
                csvEscape(cellText(cells[8]))
            ].join(','));
        });

        var blob = new Blob([lines.join('\r\n')], { type: 'text/csv;charset=utf-8;' });
        var url  = URL.createObjectURL(blob);
        var a    = document.createElement('a');
        a.href     = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    };

    function escHtml(str) {
        var d = document.createElement('div');
        d.appendChild(document.createTextNode(str || ''));
        return d.innerHTML;
    }

    window.clearSummarySearch = function() {
        searchEl.value = '';
        applyFilters();
    };
})();

// ================================================================
// INLINE RENAME
// ================================================================
function startRename(matId) {
    document.getElementById('name-display-' + matId).classList.add('d-none');
    document.getElementById('name-display-' + matId).classList.remove('d-flex');
    document.getElementById('name-edit-' + matId).classList.remove('d-none');
    document.getElementById('name-edit-' + matId).classList.add('d-flex');
    document.getElementById('name-input-' + matId).focus();
    document.getElementById('name-input-' + matId).select();
}

function cancelRename(matId) {
    document.getElementById('name-edit-' + matId).classList.add('d-none');
    document.getElementById('name-edit-' + matId).classList.remove('d-flex');
    document.getElementById('name-display-' + matId).classList.remove('d-none');
    document.getElementById('name-display-' + matId).classList.add('d-flex');
}

function saveRename(matId) {
    var newName = document.getElementById('name-input-' + matId).value.trim();
    if (!newName) { alert('Name cannot be empty.'); return; }

    var form   = document.createElement('form');
    form.method = 'POST';
    form.style.display = 'none';

    var fields = {
        action:           'rename_material',
        material_id:      matId,
        display_name:     newName,
        open_material_id: matId,
        csrf_token:       '<?= htmlspecialchars($_SESSION['csrf_token']) ?>'
    };

    Object.keys(fields).forEach(function(key) {
        var inp   = document.createElement('input');
        inp.type  = 'hidden';
        inp.name  = key;
        inp.value = fields[key];
        form.appendChild(inp);
    });

    document.body.appendChild(form);
    form.submit();
}

// ================================================================
// QUESTIONNAIRE MODAL
// Injects an iframe pointing to questionnaire.php?material_id=X.
// Same origin → session cookie is shared → auth + CSRF work as-is.
// On close the iframe src is cleared so it stops any pending network
// requests and resets state for the next open.
// ================================================================
function openQModal(matId, matName) {
    document.getElementById('qModalMatName').textContent = matName;
    document.getElementById('qModalBody').innerHTML =
        '<iframe id="qModalFrame" src="questionnaire.php?material_id=' + encodeURIComponent(matId) + '"'
        + ' style="width:100%; min-height:520px; border:none; display:block;"'
        + ' title="Questionnaire"></iframe>';
    document.getElementById('qOverlay').classList.add('show');
}

// function closeQModal(e) {
//     if (!e || e.target === document.getElementById('qOverlay')) {
//         // Clear iframe src first to abort any in-flight requests inside it
//         var frame = document.getElementById('qModalFrame');
//         if (frame) { frame.src = 'about:blank'; }
//         document.getElementById('qModalBody').innerHTML = '';
//         document.getElementById('qOverlay').classList.remove('show');
//     }
// }
function closeQModal() {
    var frame = document.getElementById('qModalFrame');
    if (frame) { frame.src = 'about:blank'; }
    document.getElementById('qModalBody').innerHTML = '';
    document.getElementById('qOverlay').classList.remove('show');
    location.reload();
}

// ================================================================
// AUTO-DISMISS MESSAGE ALERT 
// ================================================================
(function () {
    var alertEl = document.querySelector('.alert.alert-dismissible');
    if (!alertEl) return;
    setTimeout(function () {
        var bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
        if (bsAlert) bsAlert.close();
    }, 10000);
})();

</script>