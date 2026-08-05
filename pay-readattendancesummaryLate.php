<?php
include('connection.php');

$restrictedUsers  = ['mclerigo', 'prmallabo'];
$currentUser      = $_SESSION['username'] ?? '';
$isRestrictedUser = in_array($currentUser, $restrictedUsers);

$date      = $_POST['date']      ?? '';
$periodpay = $_POST['periodpay'] ?? '';
$startdate = $_POST['startdate'] ?? '';
$enddate   = $_POST['enddate']   ?? '';
$branch    = $_POST['branch']    ?? '';

if (strpos($startdate, '-00-') !== false) {
    $parts    = explode('-', $startdate);
    $parts[0] = $parts[0] - 1;
    $parts[1] = '12';
    $startdate = implode('-', $parts);
}

$startdate = mysqli_real_escape_string($con, $startdate);
$enddate   = mysqli_real_escape_string($con, $enddate);
$branch    = mysqli_real_escape_string($con, $branch);

$branch_filter = !empty($branch) ? "AND a.address = '$branch'" : "";

// ============================================================
// FIX: Removed `ob.timeFrom <= '08:00:00'` and
//      `ob2.timeFrom <= '08:00:00'` filters from all OB
//      subqueries. Previously, afternoon OB filings
//      (timeFrom > 08:00) were not detected, causing
//      employees with approved OB to appear as
//      "Missing Time OUT" instead of "OB".
//      Now any approved OB on that date is recognized
//      regardless of what time the OB started.
// ============================================================
$sql = "SELECT
    p.*,
    a.*,
    e.*,
    p.remarks AS timeRemarks,
    CAST(p.latehours AS DECIMAL(10,2)) AS late_decimal,

    (SELECT COUNT(*) FROM leavetbl ob
     WHERE ob.employee_Id = p.employeeId
       AND p.date BETWEEN ob.dateFrom AND ob.dateTo
       AND ob.iStatus = 2
       AND ob.iCategory = 'Official Business'
     LIMIT 1) AS has_ob,

    (SELECT ob2.timeFrom FROM leavetbl ob2
     WHERE ob2.employee_Id = p.employeeId
       AND p.date BETWEEN ob2.dateFrom AND ob2.dateTo
       AND ob2.iStatus = 2 AND ob2.iCategory = 'Official Business'
     LIMIT 1) AS ob_timeFrom,

    (SELECT ob2.timeTo FROM leavetbl ob2
     WHERE ob2.employee_Id = p.employeeId
       AND p.date BETWEEN ob2.dateFrom AND ob2.dateTo
       AND ob2.iStatus = 2 AND ob2.iCategory = 'Official Business'
     LIMIT 1) AS ob_timeTo,

    (SELECT ob2.iMessage FROM leavetbl ob2
     WHERE ob2.employee_Id = p.employeeId
       AND p.date BETWEEN ob2.dateFrom AND ob2.dateTo
       AND ob2.iStatus = 2 AND ob2.iCategory = 'Official Business'
     LIMIT 1) AS ob_message,

    (SELECT COUNT(*) FROM leavetbl hd
     WHERE hd.employee_Id = p.employeeId
       AND p.date BETWEEN hd.dateFrom AND hd.dateTo
       AND hd.iStatus = 2
       AND hd.kindDay = 'Half Day'
     LIMIT 1) AS has_halfday,

    (SELECT hd2.kindDay FROM leavetbl hd2
     WHERE hd2.employee_Id = p.employeeId
       AND p.date BETWEEN hd2.dateFrom AND hd2.dateTo
       AND hd2.iStatus = 2 AND hd2.kindDay = 'Half Day'
     LIMIT 1) AS hd_kindDay,

    (SELECT hd2.timeFrom FROM leavetbl hd2
     WHERE hd2.employee_Id = p.employeeId
       AND p.date BETWEEN hd2.dateFrom AND hd2.dateTo
       AND hd2.iStatus = 2 AND hd2.kindDay = 'Half Day'
     LIMIT 1) AS hd_timeFrom,

    (SELECT hd2.timeTo FROM leavetbl hd2
     WHERE hd2.employee_Id = p.employeeId
       AND p.date BETWEEN hd2.dateFrom AND hd2.dateTo
       AND hd2.iStatus = 2 AND hd2.kindDay = 'Half Day'
     LIMIT 1) AS hd_timeTo,

    (SELECT hd2.iCategory FROM leavetbl hd2
     WHERE hd2.employee_Id = p.employeeId
       AND p.date BETWEEN hd2.dateFrom AND hd2.dateTo
       AND hd2.iStatus = 2 AND hd2.kindDay = 'Half Day'
     LIMIT 1) AS hd_iCategory,

    -- UNDERTIME: nag-out before 4PM, valid time_out, not a missing punch
    (CASE WHEN p.time_out IS NOT NULL
               AND p.time_out != '00:00:00'
               AND p.time_in  != p.time_out
               AND p.time_out < '16:00:00'
          THEN 1 ELSE 0 END) AS has_undertime

FROM payroll_time p
LEFT JOIN accounts a ON p.employeeId = a.employeeId
LEFT JOIN empinfo e  ON p.employeeId = e.empId
WHERE (
    CAST(p.latehours AS DECIMAL(10,2)) > 0
    OR p.time_in = p.time_out
    OR p.time_in IS NULL
    OR p.time_in = '00:00:00'
    OR (
        p.time_out IS NOT NULL
        AND p.time_out != '00:00:00'
        AND p.time_in  != p.time_out
        AND p.time_out < '16:00:00'
    )
)
AND (p.exempt IS NULL OR p.exempt = '0')
AND (e.empId IS NULL OR e.flextime IS NULL OR e.flextime = '0' OR e.flextime = '')
AND p.date BETWEEN '$startdate' AND '$enddate'
$branch_filter
AND NOT EXISTS (
    SELECT 1 FROM leavetbl l
    WHERE l.employee_Id = p.employeeId
      AND p.date BETWEEN l.dateFrom AND l.dateTo
      AND l.iStatus = 2
      AND l.iCategory = 'Overtime'
      AND l.kindOT = 'Weekend OT'
)
ORDER BY p.date ASC, a.employeeId ASC";

$result = mysqli_query($con, $sql);

$tbody   = '';
$colspan = $isRestrictedUser ? '7' : '8';

$countLate      = 0;
$countMissing   = 0;
$countOB        = 0;
$countHalfDay   = 0;
$countUndertime = 0;

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $timeID    = $row['time_id'];
            $exempt    = $row['exempt'];
            $flexTime  = $row['flextime'];
            $lateHours = number_format((float)$row['late_decimal'], 2);

            $timeIn  = $row['time_in'];
            $timeOut = $row['time_out'];

            $isMissingPunch = (
                empty($timeIn)
                || $timeIn === '00:00:00'
                || $timeIn === $timeOut
            );

            $isMissingTimeIn  = (empty($timeIn) || $timeIn === '00:00:00');
            $isMissingTimeOut = (!$isMissingTimeIn && $timeIn === $timeOut);

            $isLate      = ((float)$row['late_decimal'] > 0);
            $hasOB       = ((int)$row['has_ob'] > 0);
            $hasHalfDay  = ((int)$row['has_halfday'] > 0);
            $isUndertime = ((int)$row['has_undertime'] > 0 && !$hasOB);

            // ============================================================
            // HALF DAY LATE RULE:
            //   AM half day (hd_timeTo <= 12:00) — employee's day starts
            //   at 12:00, so "late" threshold is 12:11PM.
            //   If time_in > 12:10 → late (isLateForHalfDay = true)
            //
            //   PM half day (hd_timeFrom >= 12:00) — employee works only
            //   morning, normal 08:11 late rule applies.
            //
            //   No half day — use existing $isLate (latehours > 0)
            // ============================================================
            $hdTimeTo   = $row['hd_timeTo']   ?? '';
            $hdTimeFrom = $row['hd_timeFrom'] ?? '';

            $isAMHalfDay = ($hasHalfDay && !empty($hdTimeTo)   && $hdTimeTo   <= '12:00:00');
            $isPMHalfDay = ($hasHalfDay && !empty($hdTimeFrom) && $hdTimeFrom >= '12:00:00');

            if ($isAMHalfDay) {
                $isLateForHalfDay = (!empty($timeIn) && $timeIn !== '00:00:00' && $timeIn > '12:10:00');
            } elseif ($isPMHalfDay) {
                $isLateForHalfDay = ((float)$row['late_decimal'] > 0);
            } else {
                $isLateForHalfDay = false;
            }

            // ============================================================
            // STATUS PRIORITY: OB > Half Day > Missing > Late
            //
            // UNDERTIME is additive — it stacks on top of any status:
            //   OB + Undertime       → [OB] [Undertime]
            //   Half Day + Undertime → [Half Day] [Undertime]
            //   Late + Undertime     → [Late] [Undertime]
            //   Undertime only       → [Undertime]
            //
            // Flextime employees are excluded from undertime.
            // Missing punch (time_in = time_out) is not undertime.
            // ============================================================

            if ($hasOB) {
                $status = 'OB';
                $countOB++;
                if ($isMissingPunch) $countMissing++;
                if ($isLate)        $countLate++;
            } elseif ($hasHalfDay) {
                $status = 'Half Day';
                $countHalfDay++;
                if ($isLateForHalfDay) $countLate++;
            } elseif ($isMissingPunch) {
                $hasRealTimeIn = !empty($timeIn) && $timeIn !== '00:00:00';
                if ($hasRealTimeIn && $timeIn < '12:00:00') {
                    $status = 'Missing Time OUT';
                } else {
                    $status = 'Missing Time IN';
                }
                $countMissing++;
                if ($isLate) $countLate++;
            } else {
                $status = 'Late';
                $countLate++;
            }

            if ($isUndertime) $countUndertime++;

            // ============================================================
            // Row background — status priority color
            // Undertime-only gets its own orange tint
            // ============================================================
            $rowStyle = '';
            switch ($status) {
                case 'OB':              $rowStyle = 'background-color:#CCE5FF'; break;
                case 'Half Day':        $rowStyle = 'background-color:#FFE8CC'; break;
                case 'Missing Time OUT':
                case 'Missing Time IN': $rowStyle = 'background-color:#FFE4E4'; break;
                case 'Late':
                    $rowStyle = $isUndertime
                        ? 'background-color:#FFE8CC'   // late + undertime → orange
                        : 'background-color:#FFFACD';  // late only → yellow
                    break;
            }
            // Pure undertime (no late, no missing, no OB, no half day)
            if ($isUndertime && $status === 'Late' && !$isLate) {
                $rowStyle = 'background-color:#FFE0B2';
            }

            // ============================================================
            // Status badge(s)
            //
            // OB + Missing punch     → [OB] [Missing Time IN/OUT]
            // OB only                → [OB]
            // Missing + Late         → [Missing] [Late]
            // Half Day + Late        → [Half Day] [Late]
            // Late only              → [Late]
            // + Undertime stacks on any of the above → append [Undertime]
            // ============================================================
            $isMissingStatus = ($status === 'Missing Time IN' || $status === 'Missing Time OUT');

            if ($hasOB && $isMissingPunch) {
                $missingLabel = $isMissingTimeIn ? 'Missing Time IN' : 'Missing Time OUT';
                $statusBadge  = '<span class="badge bg-primary">OB</span> '
                              . '<span class="badge bg-danger">' . $missingLabel . '</span>';
            } elseif ($hasOB && $isLate) {
                // OB but came in late
                $statusBadge = '<span class="badge bg-primary">OB</span> '
                             . '<span class="badge bg-secondary">Late</span>';
            } elseif ($hasOB) {
                $statusBadge = '<span class="badge bg-primary">OB</span>';
            } elseif ($isMissingStatus && $isLate) {
                $statusBadge = '<span class="badge bg-danger">' . $status . '</span> '
                             . '<span class="badge bg-secondary">Late</span>';
            } elseif ($status === 'Half Day' && $isLateForHalfDay) {
                $statusBadge = '<span class="badge bg-warning text-dark">Half Day</span> '
                             . '<span class="badge bg-secondary">Late</span>';
            } else {
                $badgeClass = '';
                switch ($status) {
                    case 'Missing Time OUT':
                    case 'Missing Time IN': $badgeClass = 'bg-danger';            break;
                    case 'OB':              $badgeClass = 'bg-primary';           break;
                    case 'Half Day':        $badgeClass = 'bg-warning text-dark'; break;
                    case 'Late':            $badgeClass = 'bg-secondary';         break;
                }
                $statusBadge = '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
            }

            // Undertime stacks on any status
            if ($isUndertime) {
                $statusBadge .= ' <span class="badge bg-undertime">Undertime</span>';
            }

            // ============================================================
            // Name cell — append OB badge with time range and purpose
            // Also append Missing badge on name cell if OB + missing
            // ============================================================
            $nameCell = htmlspecialchars($row['fullName'] ?? '');
            if ($hasOB) {
                $obTimeLabel = htmlspecialchars($row['ob_timeFrom'] ?? '') . ' – ' . htmlspecialchars($row['ob_timeTo'] ?? '');
                $obPurpose   = htmlspecialchars($row['ob_message'] ?? '');
                $nameCell   .= ' <span class="ob-badge" title="' . $obPurpose . '">&#128203; OB: ' . $obTimeLabel . '</span>';
                // If OB + missing, also show missing indicator on name cell
                if ($isMissingPunch) {
                    $missingLabel = $isMissingTimeIn ? 'No Time IN' : 'No Time OUT';
                    $nameCell .= ' <span class="missing-badge">&#9888; ' . $missingLabel . '</span>';
                }
            }
            if ($status === 'Half Day') {
                $hdLabel   = htmlspecialchars($row['hd_iCategory'] ?? $row['hd_kindDay'] ?? 'Half Day');
                $hdFrom    = htmlspecialchars($row['hd_timeFrom'] ?? '');
                $hdTo      = htmlspecialchars($row['hd_timeTo'] ?? '');
                $nameCell .= ' <span class="hd-badge" title="' . $hdFrom . ' – ' . $hdTo . '">&#128197; ' . $hdLabel . '</span>';
            }

            // data-status value for filter chips
            // undertime stacks so serialize all active flags
            $dataStatuses = [];
            if ($hasOB)          $dataStatuses[] = 'ob';
            if ($hasHalfDay)     $dataStatuses[] = 'halfday';
            if ($isMissingPunch && !$hasOB) {
                $dataStatuses[] = 'missing';
            }
            if ($isMissingPunch && $hasOB) {
                $dataStatuses[] = 'missing';
            }
            if ($isLate)         $dataStatuses[] = 'late';
            if ($isUndertime)    $dataStatuses[] = 'undertime';
            if (empty($dataStatuses)) $dataStatuses[] = 'late';
            $dataStatusAttr = implode(' ', array_unique($dataStatuses));

            $tbody .= '<tr style="' . $rowStyle . '" class="tablerow" data-status="' . $dataStatusAttr . '">';
            $tbody .= '<td>' . htmlspecialchars($row['employeeId']) . '</td>';
            $tbody .= '<td>' . $nameCell . '</td>';
            $tbody .= '<td>' . htmlspecialchars($row['date']) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($timeIn) . ' - ' . htmlspecialchars($timeOut) . '</td>';
            $tbody .= '<td class="latehrs">' . $lateHours . '</td>';
            $tbody .= '<td class="remarks">' . htmlspecialchars($row['timeRemarks']) . '</td>';
            $tbody .= '<td class="text-center">' . $statusBadge . '</td>';

            if (!$isRestrictedUser) {
                if ($exempt != 1 && $flexTime != 1) {
                    $tbody .= '<td class="text-center">
                        <a class="updateReport btn btn-primary btn-sm" data-id="' . $timeID . '">Update</a>
                        <a class="save text-center btn btn-info btn-sm" data-id="' . $timeID . '" style="display:none;">SAVE</a>
                        <a class="exempt btn btn-danger btn-sm" data-id="' . $timeID . '">Exempt</a>
                        <a class="done text-center btn btn-info btn-sm" data-id="' . $timeID . '" style="display:none;">Done</a>
                        <a class="exempted btn btn-success btn-sm" data-id="' . $timeID . '" style="display:none;">EXEMPTED</a>
                    </td>';
                } else {
                    $tbody .= '<td class="text-center">
                        <a class="updateReport btn btn-primary btn-sm" data-id="' . $timeID . '" style="display:none;">Update</a>
                        <a class="save text-center btn btn-info btn-sm" data-id="' . $timeID . '" style="display:none;">SAVE</a>
                        <a class="exempt btn btn-danger btn-sm" data-id="' . $timeID . '" style="display:none;">Exempt</a>
                        <a class="done text-center btn btn-info btn-sm" data-id="' . $timeID . '" style="display:none;">Done</a>';
                    if ($flexTime != 1) {
                        $tbody .= '<a class="exempted btn btn-success btn-sm" data-id="' . $timeID . '">EXEMPTED</a>';
                    } else {
                        $tbody .= '<a class="exempted btn btn-success btn-sm" data-id="' . $timeID . '" style="pointer-events:none;">EXEMPTED</a>';
                    }
                    $tbody .= '</td>';
                }
            }

            $tbody .= '</tr>';
        }
    } else {
        $tbody = "<tr><td colspan='$colspan' class='text-center'>No records found</td></tr>";
    }
} else {
    $tbody = "<tr><td colspan='$colspan' class='text-center'>Query error: " . mysqli_error($con) . "</td></tr>";
}

$totalrow = $countLate + $countMissing + $countOB + $countHalfDay;

$sql2 = "SELECT
    p.employeeId,
    a.fullName,
    SUM(CAST(p.latehours AS DECIMAL(10,2))) AS total_latehours,
    COUNT(*) AS total_count,
    SUM(CASE WHEN (p.time_in IS NULL OR p.time_in = '00:00:00' OR p.time_in = p.time_out) THEN 1 ELSE 0 END) AS missing_count,
    SUM(CASE WHEN (p.time_in IS NOT NULL AND p.time_in != '00:00:00' AND p.time_in != p.time_out)
              AND EXISTS (
                SELECT 1 FROM leavetbl ob2
                WHERE ob2.employee_Id = p.employeeId
                  AND p.date BETWEEN ob2.dateFrom AND ob2.dateTo
                  AND ob2.iStatus = 2 AND ob2.iCategory = 'Official Business'
              ) THEN 1 ELSE 0 END) AS ob_count,
    -- FIX: Also count OB rows that have missing punch (time_in = time_out, etc.)
    SUM(CASE WHEN (p.time_in IS NULL OR p.time_in = '00:00:00' OR p.time_in = p.time_out)
              AND EXISTS (
                SELECT 1 FROM leavetbl ob3
                WHERE ob3.employee_Id = p.employeeId
                  AND p.date BETWEEN ob3.dateFrom AND ob3.dateTo
                  AND ob3.iStatus = 2 AND ob3.iCategory = 'Official Business'
              ) THEN 1 ELSE 0 END) AS ob_missing_count,
    SUM(CASE WHEN (p.time_in IS NOT NULL AND p.time_in != '00:00:00' AND p.time_in != p.time_out)
              AND EXISTS (
                SELECT 1 FROM leavetbl hd2
                WHERE hd2.employee_Id = p.employeeId
                  AND p.date BETWEEN hd2.dateFrom AND hd2.dateTo
                  AND hd2.iStatus = 2 AND hd2.kindDay = 'Half Day'
              ) THEN 1 ELSE 0 END) AS halfday_count,
    SUM(CASE WHEN p.time_out IS NOT NULL
                  AND p.time_out != '00:00:00'
                  AND p.time_in  != p.time_out
                  AND p.time_out < '16:00:00' THEN 1 ELSE 0 END) AS undertime_count
FROM payroll_time p
LEFT JOIN accounts a ON p.employeeId = a.employeeId
LEFT JOIN empinfo e  ON p.employeeId = e.empId
WHERE (
    CAST(p.latehours AS DECIMAL(10,2)) > 0
    OR p.time_in = p.time_out
    OR p.time_in IS NULL
    OR p.time_in = '00:00:00'
)
AND (p.exempt IS NULL OR p.exempt = '0')
AND (e.empId IS NULL OR e.flextime IS NULL OR e.flextime = '0' OR e.flextime = '')
AND p.date BETWEEN '$startdate' AND '$enddate'";

if (!empty($branch)) {
    $sql2 .= " AND a.address = '$branch'";
}

$sql2 .= " AND NOT EXISTS (
    SELECT 1 FROM leavetbl l
    WHERE l.employee_Id = p.employeeId
      AND p.date BETWEEN l.dateFrom AND l.dateTo
      AND l.iStatus = 2
      AND l.iCategory = 'Overtime'
      AND l.kindOT = 'Weekend OT'
)";

$sql2 .= " GROUP BY p.employeeId, a.fullName ORDER BY total_latehours DESC";

$result2 = mysqli_query($con, $sql2);
$tbody2  = '';

if ($result2 && mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $tbody2 .= '<tr>';
        $tbody2 .= '<td>' . htmlspecialchars($row['fullName']) . '</td>';
        $tbody2 .= '<td class="text-center">' . $row['total_count'] . '</td>';
        $tbody2 .= '<td class="text-center">';
        if ($row['missing_count'] > 0)     $tbody2 .= '<span class="badge bg-danger me-1">'           . $row['missing_count']     . ' Missing</span>';
        // OB with complete biometrics
        if ($row['ob_count'] > 0)          $tbody2 .= '<span class="badge bg-primary me-1">'           . $row['ob_count']          . ' OB</span>';
        // OB with missing biometrics — double badge in summary too
        if ($row['ob_missing_count'] > 0)  $tbody2 .= '<span class="badge bg-primary me-1">'           . $row['ob_missing_count']  . ' OB</span>'
                                                     . '<span class="badge bg-danger me-1">'            . $row['ob_missing_count']  . ' Missing</span>';
        if ($row['halfday_count'] > 0)     $tbody2 .= '<span class="badge bg-warning text-dark me-1">' . $row['halfday_count']     . ' Half Day</span>';
        if ($row['undertime_count'] > 0)   $tbody2 .= '<span class="badge bg-undertime me-1">'         . $row['undertime_count']   . ' Undertime</span>';
        $late_only = $row['total_count']
                   - $row['missing_count']
                   - $row['ob_count']
                   - $row['ob_missing_count']
                   - $row['halfday_count'];
        if ($late_only > 0)                $tbody2 .= '<span class="badge bg-secondary">'              . $late_only                . ' Late</span>';
        $tbody2 .= '</td>';
        $tbody2 .= '<td class="text-end">' . number_format((float)$row['total_latehours'], 2) . '</td>';
        $tbody2 .= '</tr>';
    }
} else {
    $tbody2 = "<tr><td colspan='4' class='text-center'>No records found</td></tr>";
}

$sql3 = "SELECT
    p.time_id,
    p.employeeId,
    p.date,
    p.time_in,
    p.time_out,
    CAST(p.latehours AS DECIMAL(10,2)) AS late_decimal,
    p.remarks   AS timeRemarks,
    p.exempt,
    a.fullName,
    a.address,
    e.flextime
FROM payroll_time p
LEFT JOIN accounts a ON p.employeeId = a.employeeId
LEFT JOIN empinfo  e ON p.employeeId = e.empId
WHERE (
    p.time_in > '08:00:00'
    OR CAST(p.latehours AS DECIMAL(10,2)) > 0
    OR p.time_in IS NULL
    OR p.time_in = '00:00:00'
    OR p.time_in = p.time_out
    OR (
        p.time_out IS NOT NULL
        AND p.time_out != '00:00:00'
        AND p.time_in  != p.time_out
        AND p.time_out < '16:00:00'
    )
)
AND p.date BETWEEN '$startdate' AND '$enddate'
$branch_filter
AND NOT EXISTS (
    SELECT 1 FROM leavetbl l
    WHERE l.employee_Id = p.employeeId
      AND p.date BETWEEN l.dateFrom AND l.dateTo
      AND l.iStatus = 2
      AND l.iCategory = 'Overtime'
      AND l.kindOT = 'Weekend OT'
)
ORDER BY p.date ASC, a.employeeId ASC";

$result3        = mysqli_query($con, $sql3);
$tbody3         = '';
$allLateTotal   = 0;
$allLateDeduct  = 0;
$allLateExcluded = 0;

if ($result3 && mysqli_num_rows($result3) > 0) {
    while ($row3 = mysqli_fetch_assoc($result3)) {

        $allLateTotal++;

        $r3_timeIn   = $row3['time_in']   ?? '';
        $r3_timeOut  = $row3['time_out']  ?? '';
        $r3_lateHrs  = number_format((float)$row3['late_decimal'], 2);
        $r3_exempt   = $row3['exempt'];
        $r3_flex     = $row3['flextime'];
        $r3_remarks  = htmlspecialchars($row3['timeRemarks'] ?? '');
        $r3_name     = htmlspecialchars($row3['fullName']    ?? '');
        $r3_empId    = htmlspecialchars($row3['employeeId']  ?? '');
        $r3_date     = htmlspecialchars($row3['date']        ?? '');

        $r3_isMissing = (
            empty($r3_timeIn)
            || $r3_timeIn === '00:00:00'
            || $r3_timeIn === $r3_timeOut
        );

        if ($r3_isMissing) {
            $hasRealIn3 = !empty($r3_timeIn) && $r3_timeIn !== '00:00:00';
            $r3_type    = ($hasRealIn3 && $r3_timeIn < '12:00:00') ? 'Missing Time OUT' : 'Missing Time IN';
        } else {
            $r3_type = 'Late';
        }

        $r3_isExcluded = ($r3_exempt == 1 || $r3_flex == 1);
        if ($r3_isExcluded) {
            $allLateExcluded++;
            $r3_excReason = ($r3_exempt == 1) ? 'Exempted' : 'Flextime';
        } else {
            $allLateDeduct++;
            $r3_excReason = '';
        }

        $r3_rowOpacity = $r3_isExcluded ? ' style="opacity:0.55;"' : '';

        $r3_isLate = ((float)$row3['late_decimal'] > 0);
        $r3_isMissingStatus = ($r3_type === 'Missing Time IN' || $r3_type === 'Missing Time OUT');

        if ($r3_isMissingStatus && $r3_isLate) {
            $r3_typeBadge = '<span class="badge bg-danger">' . $r3_type . '</span> '
                          . '<span class="badge bg-secondary">Late</span>';
        } elseif ($r3_isMissingStatus) {
            $r3_typeBadge = '<span class="badge bg-danger">' . $r3_type . '</span>';
        } else {
            $r3_typeBadge = '<span class="badge bg-secondary">Late</span>';
        }

        $r3_exclBadge = '';
        if ($r3_excReason === 'Exempted') {
            $r3_exclBadge = ' <span class="badge bg-success ms-1">Exempted</span>';
        } elseif ($r3_excReason === 'Flextime') {
            $r3_exclBadge = ' <span class="badge bg-info text-dark ms-1">Flextime</span>';
        }

        $r3_timeInDisplay = (empty($r3_timeIn) || $r3_timeIn === '00:00:00')
            ? '<span class="text-danger fw-semibold">—</span>'
            : htmlspecialchars($r3_timeIn);

        $tbody3 .= '<tr' . $r3_rowOpacity . '>';
        $tbody3 .= '<td>'
                     . '<div class="fw-semibold small">' . $r3_name  . '</div>'
                     . '<div class="text-muted" style="font-size:0.75rem;">' . $r3_empId . '</div>'
                  . '</td>';
        $tbody3 .= '<td class="small">' . $r3_date . '</td>';
        $tbody3 .= '<td class="text-center small font-monospace">'
                     . $r3_timeInDisplay . ' &ndash; ' . htmlspecialchars($r3_timeOut)
                  . '</td>';
        $tbody3 .= '<td class="text-end small">';
        if ($r3_isExcluded) {
            $tbody3 .= '<span class="text-muted">' . $r3_lateHrs . '</span>';
        } else {
            $tbody3 .= '<span class="fw-semibold text-danger">' . $r3_lateHrs . '</span>';
        }
        $tbody3 .= '</td>';
        $tbody3 .= '<td class="small text-muted">' . ($r3_remarks ?: '&mdash;') . '</td>';
        $tbody3 .= '<td class="text-center">' . $r3_typeBadge . $r3_exclBadge . '</td>';
        $tbody3 .= '</tr>';
    }
} else {
    $tbody3 = "<tr><td colspan='6' class='text-center text-muted small py-3'>No late records found for this period.</td></tr>";
}
?>

<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<!-- MODAL 1 — Attendance Issues Summary -->
<div class="modal" id="countrow">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Attendance Issues Summary</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Period: <?php echo date('M d, Y', strtotime($startdate)) . ' – ' . date('M d, Y', strtotime($enddate)); ?></p>
                <div class="d-flex gap-2 mb-3 flex-wrap">
                    <span class="badge bg-secondary fs-6"><?php echo $countLate; ?> Late</span>
                    <span class="badge bg-danger fs-6"><?php echo $countMissing; ?> Missing Punch</span>
                    <span class="badge bg-primary fs-6"><?php echo $countOB; ?> OB</span>
                    <span class="badge bg-warning text-dark fs-6"><?php echo $countHalfDay; ?> Half Day</span>
                    <span class="badge bg-undertime fs-6"><?php echo $countUndertime; ?> Undertime</span>
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Employee Name</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Breakdown</th>
                            <th class="text-end">Total Late Hrs</th>
                        </tr>
                    </thead>
                    <tbody><?php echo $tbody2; ?></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2 — All Late Arrivals: Raw Database View -->
<div class="modal fade" id="allLateModal" tabindex="-1" aria-labelledby="allLateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-bottom bg-light">
                <div>
                    <h5 class="modal-title mb-1" id="allLateModalLabel">
                        <i class="fas fa-clock text-danger me-2"></i>
                        All Late Arrivals &mdash; Raw Database View
                    </h5>
                    <p class="text-muted mb-0" style="font-size:0.8rem;">
                        All records where <code>time in &gt; 08:00 AM</code>
                        or a missing punch was detected &mdash; including exempted and flextime employees.
                        Period:
                        <strong><?php echo date('M d, Y', strtotime($startdate)) . ' – ' . date('M d, Y', strtotime($enddate)); ?></strong>
                        <?php if (!empty($branch)): ?>
                            &nbsp;&bull;&nbsp; Branch: <strong><?php echo htmlspecialchars($branch); ?></strong>
                        <?php endif; ?>
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="d-flex gap-3 flex-wrap align-items-center px-3 py-2 border-bottom bg-white">
                    <span class="badge bg-dark fs-6"><i class="fas fa-list me-1"></i><?php echo $allLateTotal; ?> Total records</span>
                    <span class="badge bg-danger fs-6"><i class="fas fa-exclamation-circle me-1"></i><?php echo $allLateDeduct; ?> For deduction</span>
                    <span class="badge bg-secondary fs-6"><i class="fas fa-ban me-1"></i><?php echo $allLateExcluded; ?> Excluded</span>
                    <small class="text-muted ms-auto fst-italic">Muted rows are excluded from payroll deduction.</small>
                </div>
                <div class="d-flex gap-2 flex-wrap align-items-center px-3 py-2 border-bottom bg-white" style="font-size:0.78rem;">
                    <span class="text-muted fw-semibold me-1">Legend:</span>
                    <span class="badge bg-secondary">Late</span>
                    <span class="badge bg-danger">Missing Time IN</span>
                    <span class="badge bg-danger">Missing Time OUT</span>
                    <span class="badge bg-danger">Missing Time IN/OUT</span> <span class="badge bg-secondary">Late</span>
                    <span class="text-muted">(both = missing punch with late deduction)</span>
                    <span class="badge bg-success">Exempted</span>
                    <span class="badge bg-info text-dark">Flextime</span>
                </div>
                <div class="px-2 pt-2">
                    <table id="allLateTable" class="table table-bordered table-hover w-100" style="font-size:0.85rem;">
                        <thead class="table-dark">
                            <tr>
                                <th>Employee</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time In &ndash; Out</th>
                                <th class="text-end">Late Hrs</th>
                                <th class="text-center">Remarks</th>
                                <th class="text-center">Status / Flag</th>
                            </tr>
                        </thead>
                        <tbody><?php echo $tbody3; ?></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top bg-light justify-content-between">
                <span class="text-muted small">
                    <?php echo $allLateTotal; ?> records &nbsp;&bull;&nbsp;
                    <?php echo $allLateDeduct; ?> for deduction &nbsp;&bull;&nbsp;
                    <?php echo $allLateExcluded; ?> excluded
                </span>
                <div class="d-flex gap-2">
                    <button type="button" id="btnDownloadAllLate" class="btn btn-success btn-sm">
                        <i class="fas fa-file-csv me-1"></i> Download CSV
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MAIN REPORT -->
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <h4>Attendance Report – <?php echo htmlspecialchars($periodpay); ?></h4>
            <p class="text-muted">
                Period: <?php echo date('M d, Y', strtotime($startdate)) . ' – ' . date('M d, Y', strtotime($enddate)); ?>
                <?php if (!empty($branch)) echo ' | Branch: ' . htmlspecialchars($branch); ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <!-- ── LEGEND ─────────────────────────────────────────────────── -->
            <div class="d-flex flex-wrap gap-3 align-items-center mb-3 px-2 py-2" style="font-size:0.92rem; background:#f8f9fa; border:1px solid #dee2e6; border-radius:6px;">
                <span class="fw-bold text-secondary me-1" style="font-size:0.95rem;">Legend:</span>
                <span class="d-flex align-items-center gap-2">
                    <span style="width:18px;height:18px;background:#FFFACD;border:1px solid #ccc;display:inline-block;border-radius:3px;flex-shrink:0;"></span>
                    <span class="badge bg-secondary" style="font-size:0.82rem;">Late</span>
                </span>
                <span class="d-flex align-items-center gap-2">
                    <span style="width:18px;height:18px;background:#FFE4E4;border:1px solid #ccc;display:inline-block;border-radius:3px;flex-shrink:0;"></span>
                    <span class="badge bg-danger" style="font-size:0.82rem;">Missing Time IN</span>
                    <span class="badge bg-danger" style="font-size:0.82rem;">Missing Time OUT</span>
                </span>
                <span class="d-flex align-items-center gap-2">
                    <span style="width:18px;height:18px;background:#CCE5FF;border:1px solid #ccc;display:inline-block;border-radius:3px;flex-shrink:0;"></span>
                    <span class="badge bg-primary" style="font-size:0.82rem;">OB</span>
                    <span class="text-muted" style="font-size:0.78rem;"></span>
                    <span class="badge bg-danger" style="font-size:0.82rem;">Missing</span>
                    <span class="text-muted" style="font-size:0.78rem;"></span>
                </span>
                <span class="d-flex align-items-center gap-2">
                    <span style="width:18px;height:18px;background:#FFE8CC;border:1px solid #ccc;display:inline-block;border-radius:3px;flex-shrink:0;"></span>
                    <span class="badge bg-warning text-dark" style="font-size:0.82rem;">Half Day</span>
                </span>
                <span class="d-flex align-items-center gap-2">
                    <span style="width:18px;height:18px;background:#FFE0B2;border:1px solid #ccc;display:inline-block;border-radius:3px;flex-shrink:0;"></span>
                    <span class="badge bg-undertime" style="font-size:0.82rem;">Undertime</span>
                    <span class="text-muted" style="font-size:0.78rem;"></span>
                </span>
            </div>
            <!-- ── END LEGEND ─────────────────────────────────────────────── -->

            <!-- ── STATUS FILTER CHIPS ───────────────────────────────────── -->
            <div class="d-flex flex-wrap gap-2 align-items-center mb-3" id="statusFilterBar">
                <span class="fw-bold text-secondary me-1" style="font-size:0.85rem;">Filter:</span>
                <button type="button" class="status-chip active" data-filter="all">
                    All <span class="chip-count"><?php echo $totalrow; ?></span>
                </button>
                <button type="button" class="status-chip" data-filter="late">
                    Late <span class="chip-count"><?php echo $countLate; ?></span>
                </button>
                <button type="button" class="status-chip" data-filter="missing">
                    Missing <span class="chip-count"><?php echo $countMissing; ?></span>
                </button>
                <button type="button" class="status-chip" data-filter="ob">
                    OB <span class="chip-count"><?php echo $countOB; ?></span>
                </button>
                <button type="button" class="status-chip" data-filter="halfday">
                    Half Day <span class="chip-count"><?php echo $countHalfDay; ?></span>
                </button>
                <button type="button" class="status-chip" data-filter="undertime">
                    Undertime <span class="chip-count"><?php echo $countUndertime; ?></span>
                </button>
            </div>
            <!-- ── END STATUS FILTER CHIPS ───────────────────────────────── -->

            <table id="reporttbl" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">NAME</th>
                        <th class="text-center">DATE</th>
                        <th class="text-center">TIME</th>
                        <th class="text-center">LATE HOURS</th>
                        <th class="text-center">REMARKS</th>
                        <th class="text-center">STATUS</th>
                        <?php if (!$isRestrictedUser): ?>
                        <th class="text-center">ACTION</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody><?php echo $tbody; ?></tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 d-flex gap-2 flex-wrap align-items-center">
            <a href="javascript:void(0)" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#countrow">
                <i class="fas fa-chart-bar"></i>
                View Summary (<?php echo $countLate; ?> Late | <?php echo $countMissing; ?> Missing | <?php echo $countOB; ?> OB | <?php echo $countHalfDay; ?> Half Day | <?php echo $countUndertime; ?> Undertime)
            </a>
            <?php if (!$isRestrictedUser): ?>
            <a href="javascript:void(0)" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#allLateModal">
                <i class="fas fa-clock me-1"></i>
                All Late Records (<?php echo $allLateTotal; ?> total &mdash; <?php echo $allLateDeduct; ?> for deduction)
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script>
$(document).ready(function() {
    var isRestrictedUser = <?php echo $isRestrictedUser ? 'true' : 'false'; ?>;

    var myTable = $('#reporttbl').DataTable({
        autoWidth: false,
        order: [[2, 'asc'], [0, 'asc']],
        columnDefs: [
            { targets: [0], orderData: [0, 1] },
            { targets: [1], orderData: [1, 0] },
            { targets: [4], orderData: [4, 0], type: 'num' }
        ],
        createdRow: function(row, data, dataIndex) {
            $(row).attr('id', data[0]);
        },
        pageLength: 25,
        language: { emptyTable: "No records found for this period" }
    });

    // ── STATUS FILTER CHIPS ───────────────────────────────────────────────
    // Uses DataTables $.fn.dataTable.ext.search to filter rows by data-status
    var activeFilter = 'all';

    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        if (settings.nTable.id !== 'reporttbl') return true;
        if (activeFilter === 'all') return true;
        var $row    = $(myTable.row(dataIndex).node());
        var statuses = ($row.data('status') || '').split(' ');
        return statuses.indexOf(activeFilter) !== -1;
    });

    $(document).on('click', '.status-chip', function() {
        $('.status-chip').removeClass('active');
        $(this).addClass('active');
        activeFilter = $(this).data('filter');
        myTable.draw();
    });
    // ── END STATUS FILTER CHIPS ───────────────────────────────────────────
    var allLateDT        = null;
    var allLateTableInit  = false;  

    $('#allLateModal').on('shown.bs.modal', function() {
        if (!allLateTableInit) {
            allLateDT = $('#allLateTable').DataTable({
                autoWidth  : false,
                order      : [[1, 'asc'], [0, 'asc']],
                pageLength : 130,
                columnDefs : [
                    { targets: [2, 5], orderable: false },
                    { targets: [3],    type: 'num'      }
                ],
                language: { emptyTable: 'No late records found for this period.' }
            });
            allLateTableInit = true;
        }
        setTimeout(function() {
            allLateDT.columns.adjust().draw(false);
            $(window).trigger('resize');
        }, 50);
    });

    $(document).on('click', '#btnDownloadAllLate', function() {
        if (!allLateDT) return;

        var headers = ['Employee', 'Employee ID', 'Date', 'Time In', 'Time Out', 'Late Hrs', 'Remarks', 'Status'];
        var rows    = [headers];

        allLateDT.rows({ search: 'applied' }).nodes().each(function(tr) {
            var $tr      = $(tr);
            var nameRaw  = $tr.find('td:eq(0)').clone();
            nameRaw.find('.text-muted').remove();
            var empName  = nameRaw.text().trim();
            var empId    = $tr.find('td:eq(0) .text-muted').text().trim();
            var date     = $tr.find('td:eq(1)').text().trim();
            var timePair = $tr.find('td:eq(2)').text().trim().replace(/\s*[–-]\s*/, '\t').split('\t');
            var lateHrs  = $tr.find('td:eq(3)').text().trim();
            var remarks  = $tr.find('td:eq(4)').text().trim();
            var status   = $tr.find('td:eq(5)').text().trim();

            rows.push([
                '"' + empName.replace(/"/g, '""')  + '"',
                '"' + empId.replace(/"/g, '""')    + '"',
                '"' + date                          + '"',
                '"' + (timePair[0] || '').trim()   + '"',
                '"' + (timePair[1] || '').trim()   + '"',
                '"' + lateHrs                      + '"',
                '"' + remarks.replace(/"/g, '""')  + '"',
                '"' + status.replace(/"/g, '""')   + '"'
            ]);
        });

        var csvContent = rows.map(function(r) { return r.join(','); }).join('\r\n');
        var blob       = new Blob(['\uFEFF' + csvContent], { type: 'text/csv;charset=utf-8;' });
        var url        = URL.createObjectURL(blob);
        var a          = document.createElement('a');
        a.href         = url;
        a.download     = 'all-late-arrivals-<?php echo $startdate; ?>-to-<?php echo $enddate; ?>.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });

    if (isRestrictedUser) return;

    $(document).off('click', '.updateReport').on('click', '.updateReport', function(e) {
        e.preventDefault();
        var id   = $(this).data('id');
        var $row = $(this).closest('tr');
        $row.find('.latehrs, .remarks').attr('contenteditable', true).css({ 'border': '2px solid #007bff', 'background-color': '#fff3cd' });
        $(this).hide();
        $row.find('.save').show();
        $row.find('.exempt').hide();

        $row.find('.save').off('click').on('click', function() {
            var newlatehrs = parseFloat($row.find('.latehrs').text());
            var newremarks = $row.find('.remarks').text().trim();
            var $saveBtn   = $(this);
            if (isNaN(newlatehrs) || newlatehrs < 0) { alert('Please enter a valid late hours value.'); return; }
            if (newlatehrs > 8 && !confirm('Late hours exceeds 8. Are you sure?')) return;
            $.ajax({
                url: 'pay-updatelate.php', method: 'GET',
                data: { newlatehrs: newlatehrs.toFixed(2), newremarks: newremarks, id: id, exempt: '0' },
                success: function() {
                    $row.find('.latehrs, .remarks').attr('contenteditable', false).css({ 'border': '1px solid #dee2e6', 'background-color': 'transparent' });
                    $row.find('.latehrs').text(newlatehrs.toFixed(2));
                    $row.find('.updateReport').show();
                    $row.find('.exempt').show();
                    $saveBtn.hide();
                    if (newlatehrs === 0 && confirm('Late hours set to 0. Remove from list?')) { myTable.row($row).remove().draw(); }
                },
                error: function() { alert('Failed to update record.'); }
            });
        });
    });

    $(document).off('click', '.exempt').on('click', '.exempt', function(e) {
        e.preventDefault();
        var id   = $(this).data('id');
        var $row = $(this).closest('tr');
        $row.find('.remarks').attr('contenteditable', true).css({ 'border': '2px solid #dc3545', 'background-color': '#f8d7da' }).focus();
        $(this).hide();
        $row.find('.done').show();
        $row.find('.updateReport').hide();

        $row.find('.done').off('click').on('click', function() {
            var newlatehrs = $row.find('.latehrs').text();
            var newremarks = $row.find('.remarks').text().trim();
            var $done      = $(this);
            if (!newremarks) { alert('Please provide a reason for exemption.'); return; }
            if (!confirm('Exempt this record? It will be excluded from payroll calculations.')) {
                $row.find('.remarks').attr('contenteditable', false).css({ 'border': '1px solid #dee2e6', 'background-color': 'transparent' });
                $done.hide(); $row.find('.exempt').show(); $row.find('.updateReport').show();
                return;
            }
            $.ajax({
                url: 'pay-updatelate.php', method: 'GET',
                data: { newlatehrs: newlatehrs, newremarks: newremarks, id: id, exempt: '1' },
                success: function() {
                    $row.find('.remarks').attr('contenteditable', false).css({ 'border': '1px solid #dee2e6', 'background-color': '#d4edda' });
                    $row.find('.exempted').show(); $done.hide(); $row.find('.updateReport').hide(); $row.find('.exempt').hide();
                },
                error: function() { alert('Failed to exempt record.'); }
            });
        });
    });

    $(document).off('click', '.exempted').on('click', '.exempted', function(e) {
        e.preventDefault();
        var id   = $(this).data('id');
        var $row = $(this).closest('tr');
        if (!confirm('Un-exempt this record? It will be included in payroll calculations again.')) return;
        $.ajax({
            url: 'pay-updatelate.php', method: 'GET',
            data: { newlatehrs: $row.find('.latehrs').text(), newremarks: $row.find('.remarks').text(), id: id, exempt: '0' },
            success: function() {
                $row.find('.remarks').css('background-color', '#fffacd');
                $row.find('.exempted').hide(); $row.find('.updateReport').show(); $row.find('.exempt').show();
            },
            error: function() { alert('Failed to un-exempt record.'); }
        });
    });
});
</script>

<style>
    .dataTables_length  { margin-top: 10px; }
    .dataTables_filter  { margin-right: auto; margin-top: 10px; }
    .dataTables_info    { margin-top: 10px; }
    .latehrs[contenteditable="true"],
    .remarks[contenteditable="true"] { padding: 5px; border-radius: 4px; }
    .table tbody tr { transition: background-color 0.2s; }
    .table tbody tr:hover { background-color: #f8f9fa !important; }
    .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.875rem; }

    .ob-badge {
        display: inline-block;
        background-color: #1d4ed8; color: #fff;
        font-size: 0.68rem; font-weight: 700;
        padding: 2px 8px; border-radius: 20px;
        margin-left: 6px; cursor: default;
        letter-spacing: 0.3px; white-space: nowrap;
    }
    .hd-badge {
        display: inline-block;
        background-color: #d97706; color: #fff;
        font-size: 0.68rem; font-weight: 700;
        padding: 2px 8px; border-radius: 20px;
        margin-left: 6px; cursor: default;
        white-space: nowrap;
    }
    /* NEW: Missing punch indicator on name cell when employee has OB but no biometrics */
    .missing-badge {
        display: inline-block;
        background-color: #dc3545; color: #fff;
        font-size: 0.68rem; font-weight: 700;
        padding: 2px 8px; border-radius: 20px;
        margin-left: 4px; cursor: default;
        white-space: nowrap;
    }

    /* ── Status filter chips ───────────────────────────────── */
    #statusFilterBar .status-chip {
        border: 1.5px solid #dee2e6;
        background: #fff;
        color: #555;
        font-size: 11.5px; font-weight: 700;
        padding: 5px 14px;
        border-radius: 99px;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s, box-shadow .15s;
        display: inline-flex; align-items: center; gap: 5px;
    }
    #statusFilterBar .status-chip:hover:not(.active) {
        background: #f8f9fa;
        border-color: #adb5bd;
    }
    #statusFilterBar .status-chip.active {
        background: #212529;
        color: #fff;
        border-color: #212529;
        box-shadow: 0 2px 6px rgba(0,0,0,.15);
    }
    #statusFilterBar .chip-count {
        background: rgba(255,255,255,.25);
        font-size: 10px;
        padding: 1px 6px;
        border-radius: 99px;
        font-weight: 800;
    }
    #statusFilterBar .status-chip.active .chip-count {
        background: rgba(255,255,255,.2);
    }

    /* Undertime badge — orange */
    .bg-undertime {
        background-color: #E65100 !important;
        color: #fff !important;
    }

    #allLateModal .modal-header       { padding: 1rem 1.25rem 0.75rem; }
    #allLateModal .modal-body         { padding: 0; }
    #allLateModal .modal-footer       { padding: 0.6rem 1.25rem; }
    #allLateModal code                { font-size: 0.78rem; background: #f0f0f0; padding: 1px 5px; border-radius: 3px; }
    #allLateModal .table thead th     { font-size: 0.78rem; white-space: nowrap; }
    #allLateModal .table tbody tr:hover { background-color: #f8f9fa !important; }
    #allLateModal .font-monospace     { font-family: 'Courier New', monospace; font-size: 0.8rem; }
</style>