<?php

require_once('../connection.php');
require_once('../auth_check.php');

$sqlMaterials = "SELECT * FROM `exam_materials` WHERE is_active = 1 ORDER BY uploaded_at DESC";
$resMaterials = mysqli_query($con, $sqlMaterials);
$activeMaterials = [];
while ($row = mysqli_fetch_assoc($resMaterials)) {
    $activeMaterials[] = $row;
}

$sessionUserId = (int)$_SESSION['userid'];
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<style>
/* ── BS4 → BS5 shim ───────────────────────────────────────────── */
.mr-1{margin-right:.25rem!important}.mr-2{margin-right:.5rem!important}
.ml-1{margin-left:.25rem!important} .ml-2{margin-left:.5rem!important}
.font-weight-bold{font-weight:700!important}
.text-left{text-align:left!important}

/* ── Screen system ────────────────────────────────────────────── */
.screen        { display: none; }
.screen.active { display: block; }

/* ── Landing hero ─────────────────────────────────────────────── */
.exam-hero {
    /* background: linear-gradient(135deg, #0a2d6e 0%, #1a4fa0 60%, #1565c0 100%); */
    background: linear-gradient(to right, #ffffcc 24%, #ffff66 100%);
    border-radius: 12px;
    padding: 28px 32px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 4px 20px rgba(10,45,110,.25);
}
.exam-hero img.hero-logo {
    height: 64px; width: auto; object-fit: contain; flex-shrink: 0;
}
.exam-hero .hero-divider {
    width: 2px; height: 48px; background: rgba(0, 0, 0, 0.3);
    border-radius: 2px; flex-shrink: 0;
}
.exam-hero .hero-text h4 {
    color: #000000; font-weight: 700; margin: 0 0 3px;
    font-size: 1.2rem; letter-spacing: .3px;
}
.exam-hero .hero-text p { color: rgba(33, 30, 30, 0.72); font-size: .82rem; margin: 0; }

/* ── Material row list ────────────────────────────────────────── */
.material-row {
    background: #fff;
    border: 2px solid #dee2e6;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color .18s, box-shadow .18s;
    margin-bottom: 10px;
}
.material-row:hover       { border-color: #0d6efd; box-shadow: 0 4px 14px rgba(13,110,253,.12); }
.material-row.expanded    { border-color: #0d6efd; box-shadow: 0 4px 14px rgba(13,110,253,.12); }
.material-row.row-passed  { border-color: #28a745; }
.material-row.row-passed:hover { border-color: #1e7e34; box-shadow: 0 4px 14px rgba(40,167,69,.12); }

/* .mr-main {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 16px;
} */
    .mr-main {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 16px 20px;
}
/* .mr-thumb-wrap {
    width: 52px; height: 68px;
    background: #f0f4f8;
    border-radius: 6px;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
} */
    .mr-thumb-wrap {
    /* width: 90px; height: 115px; */
    width: 120px; height: 155px;
    background: #f0f4f8;
    border-radius: 6px;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.mr-thumb-wrap canvas { width: 100% !important; height: 100% !important; object-fit: cover; display: block; }
.mr-ph { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; }
/* .mr-ph i { font-size: 1.6rem; color: #dc3545; opacity: .5; } */
.mr-ph i { font-size: 2.6rem; color: #dc3545; opacity: .5; }

.mr-info        { flex: 1; min-width: 0; }
/* .mr-title       { font-weight: 600; font-size: .93rem; color: #212529; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-bottom: 3px; } */
.mr-title { font-weight: 600; font-size: 1.05rem; color: #212529; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-bottom: 5px; }
.mr-date        { font-size: .73rem; color: #6c757d; }
.mr-status-wrap { flex-shrink: 0; }
.mr-expand-icon { flex-shrink: 0; color: #adb5bd; }
.mr-expand-icon i { transition: transform .2s; }
.material-row.expanded .mr-expand-icon i { transform: rotate(180deg); }

.mr-actions-wrap {
    display: none;
    padding: 10px 16px 14px 82px;
    gap: 8px;
    border-top: 1px solid #e9ecef;
    background: #f8f9fa;
    flex-wrap: wrap;
}
.material-row.expanded .mr-actions-wrap { display: flex; }

/* status badges */
.badge-passed   { background:#d4edda; color:#155724; border:1px solid #c3e6cb; font-size:.85rem; padding:6px 14px; border-radius:12px; font-weight:700; }
.badge-maxed    { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; font-size:.85rem; padding:6px 14px; border-radius:12px; font-weight:600; }
.badge-attempts { background:#fff3cd; color:#856404; border:1px solid #ffeeba; font-size:.85rem; padding:6px 14px; border-radius:12px; font-weight:600; }
.badge-new      { background:#e2e3e5; color:#383d41; border:1px solid #d6d8db; font-size:.85rem; padding:6px 14px; border-radius:12px; font-weight:600; }

/* ── Reviewer ─────────────────────────────────────────────────── */
/* .pdf-wrapper {
    height: 520px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    overflow: hidden;
} */
    .pdf-wrapper {
    height: 45vh;
    min-height: 520px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    overflow: hidden;
}
.no-material-box {
    min-height: 300px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    color: #6c757d;
}

/* ── Exam choices ─────────────────────────────────────────────── */
.exam-choice { cursor: pointer; border: 2px solid #dee2e6; border-radius: 8px; padding: 12px 16px; margin-bottom: 10px; transition: border-color .15s, background-color .15s; user-select: none; }
.exam-choice:hover             { border-color: #0d6efd; background-color: #f0f7ff; }
.exam-choice.selected          { border-color: #0d6efd; background-color: #e3f0ff; font-weight: 500; }
.exam-choice.correct           { border-color: #28a745; background-color: #d4edda; pointer-events: none; }
.exam-choice.wrong             { border-color: #dc3545; background-color: #f8d7da; pointer-events: none; }
.exam-choice.correct-highlight { border-color: #28a745; background-color: #d4edda; pointer-events: none; }

/* ── Exam title strip ─────────────────────────────────────────── */
.exam-title-strip { background: #f8f9fa; border-bottom: 1px solid #e9ecef; padding: 7px 20px; font-size: .78rem; color: #495057; display: flex; align-items: center; gap: 6px; }
.exam-title-strip i { color: #dc3545; font-size: .85rem; }
.exam-title-strip strong { color: #212529; }
.exam-title-strip #examTimer {color: #000 !important;}

/* ── Timer ────────────────────────────────────────────────────── */
#examTimer { font-size: 1.4rem; font-weight: 700; letter-spacing: 2px; font-variant-numeric: tabular-nums; }
#examTimer.timer-warning { color: #dc3545 !important; animation: timerBlink .8s step-start infinite; }
@keyframes timerBlink { 50% { opacity: .4; } }

/* ── Progress dots ────────────────────────────────────────────── */
/* .q-dot { display: inline-block; width: 11px; height: 11px; border-radius: 50%; background-color: #dee2e6; margin: 2px; cursor: pointer; transition: background-color .15s; }
.q-dot.dot-answered { background-color: #0d6efd; }
.q-dot.dot-current  { background-color: #ffc107; } */
/* PALITAN NG ITO: */
.q-dot {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border-radius: 6px;
    border: 1px solid #dee2e6;
    background: transparent;
    font-size: 10px;
    font-weight: 500;
    color: #6c757d;
    cursor: pointer;
    transition: all .12s;
}
.q-dot:hover          { border-color: #0d6efd; color: #0d6efd; }
.q-dot.dot-answered   { background: #0d6efd; border-color: #0a58ca; color: #fff; }
.q-dot.dot-current    { background: #28a745; border-color: #1e7e34; color: #fff; transform: scale(1.12); box-shadow: 0 0 0 3px rgba(40,167,69,.18); }

/* ── Results ──────────────────────────────────────────────────── */
.score-ring { width: 140px; height: 140px; border-radius: 50%; border: 7px solid; display: flex; flex-direction: column; align-items: center; justify-content: center; margin: 0 auto 1rem; }
.score-ring.ring-pass { border-color: #28a745; color: #28a745; }
.score-ring.ring-fail { border-color: #dc3545; color: #dc3545; }
.review-item { border-left: 4px solid; border-radius: 4px; padding: 10px 14px; margin-bottom: 8px; font-size: .9rem; }
.review-item.r-correct { border-color: #28a745; background: #f6fff8; }
.review-item.r-wrong   { border-color: #dc3545; background: #fff6f6; }

/* ── Attempt pips ─────────────────────────────────────────────── */
.attempt-pip { display: inline-block; width: 12px; height: 12px; border-radius: 50%; margin: 0 2px; background-color: #dee2e6; }
.attempt-pip.pip-used   { background-color: #dc3545; }
.attempt-pip.pip-remain { background-color: #28a745; }
</style>

<div class="container-fluid mt-3 px-4">

    <!-- ========================= SCREEN 0: LANDING ========================= -->
    <div id="screen-landing" class="screen active">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="exam-hero">
                    <img class="hero-logo"
                         src="../images/logo.png"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='none';"
                         alt="Bank Logo">
                    <div class="hero-divider"></div>
                    <div class="hero-text">
                        <h4><i class="fa-solid fa-chalkboard-user mr-2"></i>Online Training Module</h4>
                        <p>Select a material to review or take the exam directly.</p>
                    </div>
                </div>
                <!-- Search bar -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text"
                            class="form-control border-start-0 ps-0"
                            id="materialSearch"
                            placeholder="Search materials…"
                            autocomplete="off">
                        <button class="btn btn-outline-secondary" type="button" id="searchClearBtn" style="display:none;" onclick="clearSearch()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div id="searchEmpty" class="text-center text-muted py-4" style="display:none;">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> No materials match your search.
                    </div>
                </div>
                <!-- Search bar -->
                <div class="card shadow-sm border-0">
                    <div class="card-body pt-4">
                        <div class="alert alert-info mb-4 py-2">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            Click a material to expand it, then choose to <strong>Review</strong> or <strong>Take Exam</strong>.
                        </div>

                        <?php if (!empty($activeMaterials)): ?>
                        <div>
                            <?php foreach ($activeMaterials as $mat): ?>
                            <div class="material-row"
                                 data-id="<?= (int)$mat['id'] ?>"
                                 data-filename="<?= htmlspecialchars($mat['filename']) ?>"
                                 data-origname="<?= htmlspecialchars($mat['display_name'] ?? $mat['original_name']) ?>"
                                 onclick="toggleMaterialRow(this)">

                                <div class="mr-main">
                                    <!-- <div class="mr-thumb-wrap">
                                        <canvas id="thumb-<?= (int)$mat['id'] ?>" style="display:none;"></canvas>
                                        <div class="mr-ph" id="thumb-ph-<?= (int)$mat['id'] ?>">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </div>
                                    </div> -->
                                    <div class="mr-thumb-wrap">
                                    <?php if (!empty($mat['thumbnail'])): ?>
                                        <!-- <img src="materials/<?= htmlspecialchars($mat['thumbnail']) ?>"
                                            style="width:100%; height:100%; object-fit:cover; display:block;"
                                            alt="<?= htmlspecialchars($mat['display_name'] ?? $mat['original_name']) ?>"> -->
                                            <img src="materials/<?= htmlspecialchars($mat['thumbnail']) ?>"
                                                style="width:100%; height:100%; object-fit:contain; display:block; background:#f0f4f8;"
                                                alt="...">
                                    <?php else: ?>
                                        <canvas id="thumb-<?= (int)$mat['id'] ?>" style="display:none;"></canvas>
                                        <div class="mr-ph" id="thumb-ph-<?= (int)$mat['id'] ?>">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                    <div class="mr-info">
                                        <div class="mr-title">
                                            <!-- <?= htmlspecialchars(preg_replace('/\.pdf$/i', '', $mat['original_name'])) ?> -->
                                             <?= htmlspecialchars(preg_replace('/\.pdf$/i', '', $mat['display_name'] ?? $mat['original_name'])) ?>
                                        </div>
                                        <div class="mr-date">
                                            <i class="fa-regular fa-clock mr-1"></i>
                                            <?= date('M d, Y', strtotime($mat['uploaded_at'])) ?>
                                        </div>
                                    </div>

                                    <div class="mr-status-wrap" id="row-status-<?= (int)$mat['id'] ?>">
                                        <span class="badge-new" style="opacity:.4;">—</span>
                                    </div>

                                    <div class="mr-expand-icon">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>

                                <div class="mr-actions-wrap">
                                    <button class="btn btn-outline-primary btn-sm"
                                            onclick="event.stopPropagation(); openReviewer(this.closest('.material-row'))">
                                        <i class="fa-solid fa-book-open mr-1"></i> Review Material
                                    </button>
                                    <button class="btn btn-primary btn-sm"
                                            onclick="event.stopPropagation(); openExamDirect(this.closest('.material-row'))">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Take Exam
                                    </button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <div class="no-material-box">
                            <i class="fa-solid fa-file-circle-exclamation fa-3x mb-3 text-warning"></i>
                            <h6 class="text-muted">No exam materials available at this time.</h6>
                            <small class="text-muted">Please contact HR for updates.</small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ========================= SCREEN 1: REVIEWER ========================= -->
    <div id="screen-reviewer" class="screen">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-book-open mr-2"></i> Exam Reviewer
                        </h5>
                        <div>
                            <span class="mr-2 small">Attempts:</span>
                            <span id="pip-display"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-3 py-2" id="reviewerAlert">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            Please read the entire material before proceeding.
                            The <strong>Proceed to Exam</strong> button will be enabled after checking the confirmation below.
                        </div>
                        <div id="reviewerPdfArea"></div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center flex-wrap" style="gap:8px;">
                        <button class="btn btn-outline-secondary btn-sm" onclick="backToLanding()">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Back to Materials
                        </button>
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" id="confirmRead">
                            <label class="form-check-label text-muted" for="confirmRead">
                                I have read the entire material.
                            </label>
                        </div>
                        <button class="btn btn-primary" id="proceedBtn" disabled onclick="startExam()">
                            <i class="fa-solid fa-arrow-right mr-1"></i> Proceed to Exam
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ========================= SCREEN 2: EXAM ========================= -->
<div id="screen-exam" class="screen">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span class="small">
                        Question <strong id="qCurrent">1</strong> / <strong id="qTotal">-</strong>
                    </span>
                    <span class="small text-right" style="font-size:.99rem; font-style: bold; letter-spacing:.3px;">
                        <i class="fa-solid fa-file-pdf me-1" style="color:#ff6b6b;"></i>
                        <span id="examTitleStrip">—</span>
                    </span>
                    <span class="small text-white">
                        Attempts left: <strong id="examAttemptsLeft" class="text-white">-</strong>
                    </span>
                </div>

                <div class="exam-title-strip d-flex justify-content-end align-items-center">
                    <i class="fa-solid fa-clock mr-1" style="font-size:.85rem;"></i>
                    <strong id="examTimer" style="font-size:.75rem; letter-spacing:1px;"><span id="timerDisplay">--:--</span></strong>
                </div>

                <div class="px-4 pt-3 pb-0" id="progressDots"></div>

                <div class="card-body px-4 pt-3 pb-4">
                    <p class="font-weight-bold mb-4" id="questionText" style="font-size:1.05rem; line-height:1.6;">
                        Loading...
                    </p>
                    <div id="choicesContainer"></div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-outline-secondary" id="prevBtn" onclick="prevQ()" disabled>
                        <i class="fa-solid fa-arrow-left mr-1"></i> Previous
                    </button>
                    <button class="btn btn-primary" id="nextBtn" onclick="nextQ()">
                        Next <i class="fa-solid fa-arrow-right ml-1"></i>
                    </button>
                    <button class="btn btn-success" id="submitBtn" onclick="submitExam()" style="display:none;">
                        <i class="fa-solid fa-check mr-1"></i> Submit Exam
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- ========================= SCREEN 3: RESULTS ========================= -->
    <div id="screen-results" class="screen">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white d-flex justify-content-between align-items-center" id="resultHeader">
                        <h5 class="mb-0"><i class="fa-solid fa-flag-checkered mr-2"></i> Exam Results</h5>
                    </div>
                    <div class="card-body text-center py-4">
                        <div class="score-ring" id="scoreRing">
                            <span id="scoreDisplay" style="font-size:1.8rem; font-weight:700;">0/0</span>
                            <span id="scorePercent" style="font-size:.85rem;">0%</span>
                        </div>
                        <h4 id="resultLabel" class="mb-1">-</h4>
                        <p id="resultMessage" class="text-muted mb-3">-</p>
                        <div class="mb-4" id="attemptsVisual"></div>
                        <hr>
                        <div class="text-left mt-3" id="reviewSection">
                            <h6 class="font-weight-bold mb-3">
                                <i class="fa-solid fa-list-check mr-2"></i> Answer Review
                            </h6>
                            <div id="reviewContainer"></div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center" style="gap:8px;">
                        <button class="btn btn-outline-secondary" onclick="backToLanding()">
                            <i class="fa-solid fa-graduation-cap mr-1"></i> Back to Materials
                        </button>
                        <button class="btn btn-primary" id="retakeBtn" onclick="retakeExam()">
                            <i class="fa-solid fa-rotate-right mr-1"></i> Retake Exam
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
// ================================================================
// PDF.js — accepts optional scale so row thumbs stay small
// ================================================================
pdfjsLib.GlobalWorkerOptions.workerSrc =
    'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

function renderThumb(canvasId, placeholderId, pdfUrl, scale) {
    var thumbScale = scale || 0.45;
    pdfjsLib.getDocument(pdfUrl).promise
        .then(function(pdf) { return pdf.getPage(1); })
        .then(function(page) {
            var canvas   = document.getElementById(canvasId);
            var ph       = document.getElementById(placeholderId);
            var viewport = page.getViewport({ scale: thumbScale });
            canvas.width  = viewport.width;
            canvas.height = viewport.height;
            return page.render({ canvasContext: canvas.getContext('2d'), viewport: viewport }).promise
                .then(function() {
                    canvas.style.display = 'block';
                    ph.style.display     = 'none';
                });
        })
        .catch(function() {
            var ph = document.getElementById(placeholderId);
            if (ph) ph.querySelector('i') && (ph.querySelector('i').style.opacity = '0.3');
        });
}

<?php foreach ($activeMaterials as $mat): ?>
renderThumb(
    'thumb-<?= (int)$mat['id'] ?>',
    'thumb-ph-<?= (int)$mat['id'] ?>',
    'materials/<?= htmlspecialchars($mat['filename']) ?>',
    // 0.15
    0.28
);
<?php endforeach; ?>

// ================================================================
// STATE
// ================================================================
const MAX_ATTEMPTS = 3;
const TIME_LIMIT   = 3600;   // 60 minutes
const PASSING_PCT  = 75;

let examQuestions    = [];
let userAnswers      = [];
let currentIndex     = 0;
let timerInterval    = null;
let timeLeft         = TIME_LIMIT;
let attemptsUsed     = 0;
let hasPassed        = false;   // fixed: tracks per-material pass status
let selectedMaterial = { id: 0, filename: '', origname: '' };
let TOTAL_Q          = 0;
let examServerResults = []; // security

// ================================================================
// HELPERS
// ================================================================
function showScreen(id) {
    ['screen-landing','screen-reviewer','screen-exam','screen-results'].forEach(function(s) {
        document.getElementById(s).classList.remove('active');
    });
    document.getElementById(id).classList.add('active');
}

function stripPdfExt(name) { return name.replace(/\.pdf$/i, ''); }

// ================================================================
// LANDING — row toggle
// ================================================================
function toggleMaterialRow(row) {
    var wasExpanded = row.classList.contains('expanded');
    document.querySelectorAll('.material-row').forEach(function(r) { r.classList.remove('expanded'); });
    if (!wasExpanded) row.classList.add('expanded');
}

// ================================================================
// ROW STATUS BADGE — updates the per-material badge on landing
// ================================================================
function updateRowStatus(materialId) {
    var el  = document.getElementById('row-status-' + materialId);
    var row = document.querySelector('.material-row[data-id="' + materialId + '"]');
    if (!el) return;

    if (hasPassed) {
        el.innerHTML = '<span class="badge-passed"><i class="fa-solid fa-trophy me-1"></i>Passed</span>';
        if (row) row.classList.add('row-passed');
    } else if (attemptsUsed >= MAX_ATTEMPTS) {
        el.innerHTML = '<span class="badge-maxed"><i class="fa-solid fa-ban me-1"></i>No attempts left</span>';
        if (row) row.classList.remove('row-passed');
    } else if (attemptsUsed > 0) {
        el.innerHTML = '<span class="badge-attempts">' + attemptsUsed + '/' + MAX_ATTEMPTS + ' used</span>';
        if (row) row.classList.remove('row-passed');
    } else {
        el.innerHTML = '<span class="badge-new"><i class="fa-solid fa-circle-dot me-1"></i>Not taken</span>';
        if (row) row.classList.remove('row-passed');
    }
}

// Pre-load all row statuses on page load (each material independently)
<?php foreach ($activeMaterials as $mat): ?>
(function() {
    var matId = <?= (int)$mat['id'] ?>;
    fetch('get-attempts.php?material_id=' + matId)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var used   = data.attempts_used || 0;
            var passed = data.has_passed    || false;
            var el  = document.getElementById('row-status-' + matId);
            var row = document.querySelector('.material-row[data-id="' + matId + '"]');
            if (!el) return;
            if (passed) {
                el.innerHTML = '<span class="badge-passed"><i class="fa-solid fa-trophy me-1"></i>Passed</span>';
                if (row) row.classList.add('row-passed');
            } else if (used >= MAX_ATTEMPTS) {
                el.innerHTML = '<span class="badge-maxed"><i class="fa-solid fa-ban me-1"></i>No attempts left</span>';
            } else if (used > 0) {
                el.innerHTML = '<span class="badge-attempts">' + used + '/' + MAX_ATTEMPTS + ' used</span>';
            } else {
                el.innerHTML = '<span class="badge-new"><i class="fa-solid fa-circle-dot me-1"></i>Not taken</span>';
            }
        })
        .catch(function() {});
})();
<?php endforeach; ?>

// ================================================================
// FETCH ATTEMPTS — always scoped to the selected material
// ================================================================
function fetchAttempts(materialId, callback) {
    fetch('get-attempts.php?material_id=' + materialId)
        .then(function(r) { return r.text(); })
        .then(function(text) {
            try {
                var data     = JSON.parse(text);
                attemptsUsed = data.attempts_used || 0;
                hasPassed    = data.has_passed    || false;
            } catch(e) {
                console.error('Attempts parse error:', text.substring(0, 200));
            }
            updateRowStatus(materialId);
            renderAttemptPips();
            if (callback) callback();
        })
        .catch(function(err) {
            console.error('Attempts fetch failed:', err);
            if (callback) callback();
        });
}

// ================================================================
// OPEN REVIEWER
// ================================================================
function openReviewer(card) {
    selectedMaterial.id       = card.getAttribute('data-id');
    selectedMaterial.filename = card.getAttribute('data-filename');
    selectedMaterial.origname = card.getAttribute('data-origname');
    // selectedMaterial.origname = card.getAttribute('data-origname');

    var pdfSrc  = 'materials/' + selectedMaterial.filename;
    var pdfArea = document.getElementById('reviewerPdfArea');

    pdfArea.innerHTML =
        '<div class="d-flex justify-content-between align-items-center mb-2">' +
            '<small class="text-muted">' +
                '<i class="fa-solid fa-file-pdf mr-1 text-danger"></i>' +
                htmlEscape(stripPdfExt(selectedMaterial.origname)) +
            '</small>' +
            '<a href="' + pdfSrc + '" target="_blank" class="btn btn-sm btn-outline-secondary">' +
                '<i class="fa-solid fa-external-link-alt mr-1"></i> Open in New Tab' +
            '</a>' +
        '</div>' +
        '<div class="pdf-wrapper">' +
            // '<embed src="' + pdfSrc + '" type="application/pdf" width="100%" height="520px">' 
            '<embed src="' + pdfSrc + '" type="application/pdf" width="100%" height="100%">'
            +
        '</div>';

    var chk = document.getElementById('confirmRead');
    chk.checked  = false;
    chk.disabled = false;
    document.getElementById('proceedBtn').disabled = true;

    // Reset alert before fetch resolves
    var alertEl = document.getElementById('reviewerAlert');
    alertEl.className = 'alert alert-info mb-3 py-2';
    alertEl.innerHTML = '<i class="fa-solid fa-circle-info mr-1"></i> Please read the entire material before proceeding. The <strong>Proceed to Exam</strong> button will be enabled after checking the confirmation below.';

    fetchAttempts(selectedMaterial.id, function() {
        var alertEl = document.getElementById('reviewerAlert');
        if (hasPassed) {
            chk.disabled = true;
            document.getElementById('proceedBtn').disabled = true;
            alertEl.className = 'alert alert-success mb-3 py-2';
            alertEl.innerHTML = '<i class="fa-solid fa-trophy mr-1"></i> You have already <strong>passed</strong> this exam. No further attempts are allowed for this material.';
        } else if (attemptsUsed >= MAX_ATTEMPTS) {
            chk.disabled = true;
            document.getElementById('proceedBtn').disabled = true;
            alertEl.className = 'alert alert-danger mb-3 py-2';
            alertEl.innerHTML = '<i class="fa-solid fa-ban mr-1"></i> You have used all <strong>' + MAX_ATTEMPTS + ' attempts</strong> for this material.';
        }
        showScreen('screen-reviewer');
    });
}

// ================================================================
// OPEN EXAM DIRECTLY
// ================================================================
function openExamDirect(card) {
    selectedMaterial.id       = card.getAttribute('data-id');
    selectedMaterial.filename = card.getAttribute('data-filename');
    selectedMaterial.origname = card.getAttribute('data-origname');

    fetchAttempts(selectedMaterial.id, function() {
        if (hasPassed) {
            alert('You have already passed this material. No further attempts are allowed.');
            return;
        }
        if (attemptsUsed >= MAX_ATTEMPTS) {
            alert('You have used all available attempts for this material.');
            return;
        }
        startExam();
    });
}

// ================================================================
// REVIEWER — checkbox
// ================================================================
document.getElementById('confirmRead').addEventListener('change', function() {
    document.getElementById('proceedBtn').disabled =
        !this.checked || (attemptsUsed >= MAX_ATTEMPTS) || hasPassed;
});

// ================================================================
// SEARCH
// ================================================================
document.getElementById('materialSearch').addEventListener('input', function() {
    var q       = this.value.trim().toLowerCase();
    var rows    = document.querySelectorAll('.material-row');
    var visible = 0;

    rows.forEach(function(row) {
        var title = row.getAttribute('data-origname').toLowerCase();
        var match = !q || title.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
        // collapse any expanded row that gets hidden
        if (!match) row.classList.remove('expanded');
    });

    document.getElementById('searchClearBtn').style.display = q ? 'inline-block' : 'none';
    document.getElementById('searchEmpty').style.display    = visible === 0 ? 'block' : 'none';
});

function clearSearch() {
    document.getElementById('materialSearch').value = '';
    document.getElementById('materialSearch').dispatchEvent(new Event('input'));
}

// ================================================================
// ATTEMPT PIPS (reviewer screen)
// ================================================================
function renderAttemptPips() {
    var html = '';
    for (var i = 0; i < MAX_ATTEMPTS; i++) {
        html += '<span class="attempt-pip ' + (i < attemptsUsed ? 'pip-used' : 'pip-remain') +
                '" title="Attempt ' + (i+1) + '"></span>';
    }
    var a = document.getElementById('pip-display');
    if (a) a.innerHTML = html;
}

// ================================================================
// FETCH QUESTIONS
// ================================================================
function fetchQuestions(materialId, callback) {
    fetch('get-exam-questions.php?material_id=' + materialId)
        .then(function(r) { return r.text(); })
        .then(function(text) {
            try {
                var data = JSON.parse(text);
                callback(data.questions || []);
            } catch(e) {
                console.error('Questions parse error:', text.substring(0, 200));
                callback([]);
            }
        })
        .catch(function(err) {
            console.error('Questions fetch failed:', err);
            callback([]);
        });
}

// ================================================================
// START EXAM
// ================================================================
function startExam() {
    if (hasPassed) {
        alert('You have already passed this material. No further attempts are allowed.');
        return;
    }
    if (attemptsUsed >= MAX_ATTEMPTS) {
        alert('You have used all available attempts for this material.');
        return;
    }

    fetchQuestions(selectedMaterial.id, function(questions) {
        if (!questions.length) {
            alert('No questions available for this material yet. Please contact HR.');
            return;
        }

        var pool      = shuffle(questions.slice());
        examQuestions = pool.slice(0, 20);
        TOTAL_Q       = examQuestions.length;
        userAnswers   = new Array(TOTAL_Q).fill(null);
        currentIndex  = 0;
        timeLeft      = TIME_LIMIT;

        document.getElementById('qTotal').textContent           = TOTAL_Q;
        document.getElementById('examAttemptsLeft').textContent = MAX_ATTEMPTS - attemptsUsed;
        document.getElementById('examTimer').classList.remove('timer-warning');
        document.getElementById('examTitleStrip').textContent   = stripPdfExt(selectedMaterial.origname);

        var m = Math.floor(TIME_LIMIT / 60);
        var s = TIME_LIMIT % 60;
        document.getElementById('timerDisplay').textContent = m + ':' + (s < 10 ? '0' + s : s);

        renderProgressDots();
        renderQuestion();
        startTimer();
        showScreen('screen-exam');
    });
}

// ================================================================
// TIMER
// ================================================================
function startTimer() {
    clearInterval(timerInterval);
    timerInterval = setInterval(function() {
        timeLeft--;
        var m = Math.floor(timeLeft / 60);
        var s = timeLeft % 60;
        document.getElementById('timerDisplay').textContent = m + ':' + (s < 10 ? '0' + s : s);
        if (timeLeft <= 30) document.getElementById('examTimer').classList.add('timer-warning');
        if (timeLeft <= 0) { clearInterval(timerInterval); submitExam(true); }
    }, 1000);
}

// ================================================================
// RENDER QUESTION
// ================================================================
var letters = ['A','B','C','D'];

function renderQuestion() {
    var q = examQuestions[currentIndex];
    document.getElementById('qCurrent').textContent     = currentIndex + 1;
    document.getElementById('questionText').textContent = (currentIndex + 1) + '. ' + q.q;

    var container = document.getElementById('choicesContainer');
    container.innerHTML = '';
    q.choices.forEach(function(choice, i) {
        var div       = document.createElement('div');
        div.className = 'exam-choice' + (userAnswers[currentIndex] === i ? ' selected' : '');
        div.innerHTML = '<strong>' + letters[i] + '.</strong>&nbsp;' + choice;
        div.onclick   = function() { selectAnswer(i); };
        container.appendChild(div);
    });

    document.getElementById('prevBtn').disabled = (currentIndex === 0);

    if (currentIndex === TOTAL_Q - 1) {
        document.getElementById('nextBtn').style.display   = 'none';
        document.getElementById('submitBtn').style.display = 'inline-block';
    } else {
        document.getElementById('nextBtn').style.display   = 'inline-block';
        document.getElementById('submitBtn').style.display = 'none';
    }
    updateProgressDots();
}

function selectAnswer(index) { userAnswers[currentIndex] = index; renderQuestion(); }
function nextQ() { if (currentIndex < TOTAL_Q - 1) { currentIndex++; renderQuestion(); } }
function prevQ() { if (currentIndex > 0) { currentIndex--; renderQuestion(); } }

// ================================================================
// PROGRESS DOTS
// ================================================================
function renderProgressDots() {
    var c = document.getElementById('progressDots');
    c.innerHTML = '';
    var wrap = document.createElement('div');
    wrap.style.cssText = 'display:flex; flex-wrap:wrap; gap:4px; padding:4px 0 8px;';
    for (var i = 0; i < TOTAL_Q; i++) {
        (function(idx) {
            var dot         = document.createElement('div'); // dati span, ngayon div
            dot.className   = 'q-dot';
            dot.id          = 'dot-' + idx;
            dot.title       = 'Q' + (idx + 1);
            dot.textContent = idx + 1;                       // ito lang ang nadagdag — number
            dot.onclick     = function() { currentIndex = idx; renderQuestion(); };
            wrap.appendChild(dot);
        })(i);
    }
    c.appendChild(wrap);
}

function updateProgressDots() {
    var unanswered = 0;
    for (var i = 0; i < TOTAL_Q; i++) {
        var dot = document.getElementById('dot-' + i);
        if (!dot) continue;
        dot.className = 'q-dot';
        if      (i === currentIndex)      dot.classList.add('dot-current');
        else if (userAnswers[i] !== null) dot.classList.add('dot-answered');
        else unanswered++;
    }
    var submitBtn = document.getElementById('submitBtn');
    if (submitBtn && submitBtn.style.display !== 'none') {
        if (unanswered > 0) {
            submitBtn.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Submit Exam <span class="badge bg-warning text-dark ms-1">' + unanswered + ' unanswered</span>';
            submitBtn.classList.replace('btn-success', 'btn-secondary');
        } else {
            submitBtn.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Submit Exam';
            submitBtn.classList.replace('btn-secondary', 'btn-success');
        }
    }
}

// ================================================================
// SUBMIT  — replace the entire submitExam function with this
// ================================================================
function submitExam(force) {
    if (!force) {
        var unanswered = userAnswers.filter(function(a) { return a === null; }).length;
        if (unanswered > 0) {
            alert('Please answer all ' + TOTAL_Q + ' questions before submitting.\n' + unanswered + ' unanswered item(s) remaining.\n\nUse the dots at the top to jump to unanswered questions.');
            for (var i = 0; i < TOTAL_Q; i++) {
                if (userAnswers[i] === null) { currentIndex = i; renderQuestion(); break; }
            }
            return;
        }
    }

    clearInterval(timerInterval);

    var score = 0;
    examQuestions.forEach(function(q, i) { if (userAnswers[i] === q.answer) score++; });

    var pct    = Math.round((score / TOTAL_Q) * 100);
    var passed = pct >= PASSING_PCT;

        var details = examQuestions.map(function(q, i) {
            return {
                question_id:    q.id,               
                question_text:  q.q,
                choice_a:       q.choices[0],
                choice_b:       q.choices[1],
                choice_c:       q.choices[2],
                choice_d:       q.choices[3],
                correct_answer: q.answer,
                user_answer:    userAnswers[i] !== null ? userAnswers[i] : null,
                is_correct:     userAnswers[i] === q.answer ? 1 : 0
            };
        });

    // ── Show a saving overlay so the user cannot interact while saving ──
    var overlay = document.createElement('div');
    overlay.id  = 'savingOverlay';
    overlay.style.cssText =
        'position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;' +
        'display:flex;align-items:center;justify-content:center;';
    overlay.innerHTML =
        '<div style="background:#fff;border-radius:10px;padding:28px 36px;text-align:center;">' +
            '<div class="mb-2" style="font-size:1.5rem;">⏳</div>' +
            '<div style="font-weight:600;">Saving your exam result…</div>' +
            '<div style="font-size:.8rem;color:#6c757d;margin-top:4px;">Please do not close this page.</div>' +
        '</div>';
    document.body.appendChild(overlay);

    fetch('save-exam-result.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                material_id: selectedMaterial.id,
                score:       score,
                total:       TOTAL_Q,
                passed:      passed ? 1 : 0,
                details:     details
            })
        })

    .then(function(r) { return r.json(); })
    .then(function(res) {
        document.body.removeChild(overlay);

        if (!res.ok) {
            // Server rejected the save (no_attempts_left, invalid_params, DB error)
            var msg = res.error === 'no_attempts_left'
                ? 'This attempt could not be saved because you have no remaining attempts or have already passed.'
                : 'There was an error saving your result (' + (res.error || 'unknown') + '). Please contact HR.';
            alert(msg);
            // Do NOT increment attemptsUsed — save did not happen
            showScreen('screen-landing');
            return;
        }

        // store server results for buildReview
        examServerResults = res.results || [];

        // use server values
        var score  = res.score;
        var total  = res.total;
        var passed = res.passed === 1;
        var pct    = Math.round((score / total) * 100);


        // ── Save confirmed — now update local state and show results ──
        attemptsUsed++;
        if (passed) hasPassed = true;

        updateRowStatus(selectedMaterial.id);
        renderAttemptPips();

        document.getElementById('scoreDisplay').textContent = score + '/' + TOTAL_Q;
        document.getElementById('scorePercent').textContent = pct + '%';

        document.getElementById('scoreRing').className =
            'score-ring ' + (passed ? 'ring-pass' : 'ring-fail');
        document.getElementById('resultHeader').className =
            'card-header text-white d-flex justify-content-between align-items-center ' +
            (passed ? 'bg-success' : 'bg-danger');

        document.getElementById('resultLabel').textContent   = passed ? 'PASSED' : 'FAILED';
        document.getElementById('resultMessage').textContent = passed
            ? 'Congratulations! You have passed the exam.'
            : 'You did not meet the passing score of ' + PASSING_PCT + '%. ' +
              (attemptsUsed < MAX_ATTEMPTS ? 'You may retake the exam.' : 'You have used all available attempts.');

        var pipHtml = '<small class="text-muted mr-2">Attempts:</small>';
        for (var i = 0; i < MAX_ATTEMPTS; i++) {
            pipHtml += '<span class="attempt-pip ' +
                       (i < attemptsUsed ? 'pip-used' : 'pip-remain') + '"></span>';
        }
        document.getElementById('attemptsVisual').innerHTML = pipHtml;

        document.getElementById('retakeBtn').style.display =
            (attemptsUsed >= MAX_ATTEMPTS || passed) ? 'none' : 'inline-block';

        buildReview();
        showScreen('screen-results');
    })
    .catch(function(err) {
        document.body.removeChild(overlay);
        console.error('Save failed:', err);
        alert('Network error while saving your result. Please check your connection and contact HR if this persists.');
        // Stay on exam screen — do not increment attemptsUsed
    });
}

// ================================================================
// REVIEW
// ================================================================
function buildReview() {
    var container = document.getElementById('reviewContainer');
    container.innerHTML = '';
    examQuestions.forEach(function(q, i) {
        var ua        = userAnswers[i];
        var isCorrect = examServerResults[i] ? examServerResults[i].is_correct === 1 : false;
        var item      = document.createElement('div');
        item.className = 'review-item ' + (isCorrect ? 'r-correct' : 'r-wrong');

        var userAnsText = ua !== null
            ? '<strong>' + letters[ua] + '.</strong> ' + q.choices[ua]
            : '<em>Not answered</em>';

        item.innerHTML =
            '<div><span class="badge ' + (isCorrect ? 'bg-success' : 'bg-danger') + ' me-1">' + (i+1) + '</span> ' + q.q + '</div>' +
            '<div class="text-' + (isCorrect ? 'success' : 'danger') + ' mt-1">' +
                '<i class="fa-solid fa-' + (isCorrect ? 'check' : 'times') + ' mr-1"></i>' +
                'Your answer: ' + userAnsText +
            '</div>';

        container.appendChild(item);
    });
}

// function buildReview() {
//     var container = document.getElementById('reviewContainer');
//     container.innerHTML = '';
//     examQuestions.forEach(function(q, i) {
//         var ua        = userAnswers[i];
//         var isCorrect = ua === q.answer;
//         var item      = document.createElement('div');
//         item.className = 'review-item ' + (isCorrect ? 'r-correct' : 'r-wrong');

//         var userAnsText = ua !== null
//             ? '<strong>' + letters[ua] + '.</strong> ' + q.choices[ua]
//             : '<em>Not answered</em>';

//         item.innerHTML =
//             '<div><span class="badge ' + (isCorrect ? 'bg-success' : 'bg-danger') + ' me-1">' + (i+1) + '</span> ' + q.q + '</div>' +
//             '<div class="text-' + (isCorrect ? 'success' : 'danger') + ' mt-1">' +
//                 '<i class="fa-solid fa-' + (isCorrect ? 'check' : 'times') + ' mr-1"></i>' +
//                 'Your answer: ' + userAnsText +
//             '</div>';

//         container.appendChild(item);
//     });
// }


// ================================================================
// NAVIGATION
// ================================================================
function backToLanding() {
    clearInterval(timerInterval);
    document.querySelectorAll('.material-row').forEach(function(r) { r.classList.remove('expanded'); });
    // Reset global state — no material is selected on landing
    attemptsUsed = 0;
    hasPassed    = false;
    showScreen('screen-landing');
}

function retakeExam() {
    if (hasPassed) {
        alert('You have already passed this material. No further attempts are allowed.');
        return;
    }
    if (attemptsUsed >= MAX_ATTEMPTS) {
        alert('You have used all available attempts.');
        return;
    }
    startExam();
}

// ================================================================
// UTILITY
// ================================================================
function shuffle(arr) {
    for (var i = arr.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var t = arr[i]; arr[i] = arr[j]; arr[j] = t;
    }
    return arr;
}

function htmlEscape(str) {
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

renderAttemptPips();

// ================================================================
// EXAM SECURITY LAYER — additive only, no existing code changed
// ================================================================
(function () {

    var MAX_VIOLATIONS   = 3;
    var violations       = 0;
    var examActive       = false;
    var devtoolsWarned   = false;

    // ── Track when exam screen is active ──────────────────────────
    var _showScreen = window.showScreen;
    window.showScreen = function (id) {
        examActive = (id === 'screen-exam');
        _showScreen(id);
    };

    // ── 1. Tab / window visibility detection ─────────────────────
    document.addEventListener('visibilitychange', function () {
        if (!examActive) return;
        if (document.hidden) {
            violations++;
            var remaining = MAX_VIOLATIONS - violations;
            if (violations >= MAX_VIOLATIONS) {
                alert('⚠️ Exam auto-submitted: too many tab switches detected.');
                submitExam(true);
            } else {
                alert('⚠️ Warning ' + violations + '/' + MAX_VIOLATIONS + ': '
                    + 'Switching tabs during the exam is not allowed.\n'
                    + remaining + ' warning(s) remaining before auto-submit.');
            }
        }
    });

    // ── 2. Window blur (alt-tab, other app) ──────────────────────
    window.addEventListener('blur', function () {
        if (!examActive) return;
        violations++;
        var remaining = MAX_VIOLATIONS - violations;
        if (violations >= MAX_VIOLATIONS) {
            alert('⚠️ Exam auto-submitted: too many focus losses detected.');
            submitExam(true);
        } else {
            alert('⚠️ Warning ' + violations + '/' + MAX_VIOLATIONS + ': '
                + 'Leaving the exam window is not allowed.\n'
                + remaining + ' warning(s) remaining before auto-submit.');
        }
    });

    // ── 3. Right-click disabled during exam ──────────────────────
    document.addEventListener('contextmenu', function (e) {
        if (!examActive) return;
        e.preventDefault();
    });

    // ── 4. Keyboard shortcuts — DevTools, View Source, Save ──────
    document.addEventListener('keydown', function (e) {
        if (!examActive) return;
        var blocked =
            e.key === 'F12' ||
            (e.ctrlKey && e.shiftKey && ['I','J','C'].includes(e.key.toUpperCase())) ||
            (e.ctrlKey && ['U','S','A'].includes(e.key.toUpperCase()));
        if (blocked) e.preventDefault();
    });

    // ── 5. Text selection disabled during exam ───────────────────
    document.addEventListener('selectstart', function (e) {
        if (!examActive) return;
        e.preventDefault();
    });

    // ── 6. DevTools size detection (interval) ────────────────────
    var devtoolsCheck = setInterval(function () {
        if (!examActive) return;
        var widthThreshold  = window.outerWidth  - window.innerWidth  > 160;
        var heightThreshold = window.outerHeight - window.innerHeight > 160;
        if ((widthThreshold || heightThreshold) && !devtoolsWarned) {
            devtoolsWarned = true;
            alert('⚠️ Developer tools detected. This incident has been noted.');
        }
        if (!widthThreshold && !heightThreshold) {
            devtoolsWarned = false;
        }
    }, 1000);

    // ── 7. Clear interval when exam ends ─────────────────────────
    var _submit = window.submitExam;
    window.submitExam = function (force) {
        clearInterval(devtoolsCheck);
        examActive = false;
        _submit(force);
    };

})();

</script>