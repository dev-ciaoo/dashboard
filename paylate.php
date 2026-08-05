<?php 
include('connection.php');

$late = "0.00";

$startdate = isset($_POST['startdateoutput']) ? trim($_POST['startdateoutput']) : '';
$enddate = isset($_POST['enddateoutput']) ? trim($_POST['enddateoutput']) : '';
$empId = isset($_POST['empId']) ? trim($_POST['empId']) : '';

if (empty($startdate) || empty($enddate) || empty($empId)) {
    echo "0.00";
    exit;
}

// ============================================
// STEP 1: Get all late hours within the date range
// ============================================
$stmt = mysqli_prepare($con, "SELECT 
    p.time_id,
    p.date,
    p.time_in,
    CAST(p.latehours AS DECIMAL(10,2)) AS latehours
FROM payroll_time p
LEFT JOIN empinfo e ON p.employeeId = e.empId
WHERE p.employeeId = ?
    AND CAST(p.latehours AS DECIMAL(10,2)) > 0
    AND (p.exempt IS NULL OR p.exempt = '0' OR p.exempt = '')
    AND (e.empId IS NULL OR e.flextime IS NULL OR e.flextime = '0' OR e.flextime = '')
    AND p.date >= ?
    AND p.date <= ?
ORDER BY p.date");

if (!$stmt) {
    error_log("Prepare failed: " . mysqli_error($con));
    echo "0.00";
    exit;
}

mysqli_stmt_bind_param($stmt, "sss", $empId, $startdate, $enddate);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$totalLateHours = 0;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $timeId = $row['time_id'];
        $date = $row['date'];
        $timeIn = $row['time_in'];
        $lateHours = (float)$row['latehours'];
        
        // ============================================
        // STEP 2: Check if there's an approved OB/Half-Day/Weekend OT on this date
        // ============================================
        $obStmt = mysqli_prepare($con, "SELECT 
            iCategory,
            timeFrom, 
            timeTo,
            kindDay,
            kindOT
        FROM leavetbl
        WHERE employee_Id = ?
            AND iStatus = '2'
            AND ? BETWEEN dateFrom AND dateTo
            AND (
                (iCategory = 'Official Business' AND timeFrom != '' AND timeTo != '')
                OR (
                    iCategory NOT IN ('Official Business', 'Overtime')
                    AND kindDay = 'Half Day'
                )
                OR (iCategory = 'Overtime' AND kindOT = 'Weekend OT')
            )
        ORDER BY timeFrom
        LIMIT 1");
        
        $adjustedLateHours = $lateHours; // Default to original late hours
        
        if ($obStmt) {
            mysqli_stmt_bind_param($obStmt, "ss", $empId, $date);
            mysqli_stmt_execute($obStmt);
            $obResult = mysqli_stmt_get_result($obStmt);
            
            if ($obResult && mysqli_num_rows($obResult) > 0) {
                $obRow = mysqli_fetch_assoc($obResult);
                $iCategory = $obRow['iCategory'];
                $obTimeFrom = $obRow['timeFrom'];
                $obTimeTo = $obRow['timeTo'];
                $kindDay = $obRow['kindDay'];
                $kindOT = $obRow['kindOT'];
                
                $regularStart = '08:00:00';
                $obCovered = false;
                
                // ============================================
                // STEP 3: Check if OB/Leave covers the late period
                // ============================================
                
                // Official Business Logic
                if ($iCategory == 'Official Business') {
                    if ($obTimeFrom <= $regularStart) {
                        $obCovered = true;
                    } else if ($timeIn >= $obTimeFrom && $timeIn <= $obTimeTo) {
                        $obCovered = true;
                    }
                }
                
                // Half-Day Leave Logic
                // Applies to ANY category except Official Business and Overtime
                // (those two have their own dedicated logic blocks above/below)
                else if (
                    $kindDay == 'Half Day' &&
                    $iCategory != 'Official Business' &&
                    $iCategory != 'Overtime'
                ) {
                    // Morning Half-Day (AM Leave):
                    //   - Employee is on leave in the morning; expected to report at 12:00 noon.
                    //   - timeTo of the filed leave is at or before 12:00.
                    //   - Employee must time in exactly by 12:00:00.
                    //   - Arriving at 12:01 PM or later is considered late.
                    if ($obTimeTo <= '12:00:00' && $timeIn <= '12:00:00') {
                        $obCovered = true;
                    }
                    // Afternoon Half-Day (PM Leave):
                    //   - Employee works the morning and goes on leave at noon.
                    //   - timeFrom of the filed leave is at or after 12:00.
                    //   - Employee must time in by 8:11 AM for their morning shift.
                    //   - Timing out at 12:01 onwards is normal for this half-day; not late.
                    else if ($obTimeFrom >= '12:00:00' && $timeIn <= '08:11:00') {
                        $obCovered = true;
                    }
                }
                
                // Weekend OT Logic
                else if ($iCategory == 'Overtime' && $kindOT == 'Weekend OT') {
                    $obCovered = true;
                }
                
                // If covered, set late hours to 0
                if ($obCovered) {
                    $adjustedLateHours = 0.00;
                }
            }
            
            mysqli_stmt_close($obStmt);
        }
        
        // // ============================================
        // // STEP 4: UPDATE the database with adjusted late hours
        // // ============================================
        // $updateStmt = mysqli_prepare($con, "UPDATE payroll_time 
        //     SET latehours = ? 
        //     WHERE time_id = ?");
        
        // if ($updateStmt) {
        //     mysqli_stmt_bind_param($updateStmt, "di", $adjustedLateHours, $timeId);
        //     mysqli_stmt_execute($updateStmt);
        //     mysqli_stmt_close($updateStmt);
        // }
        
        // Add to total
        $totalLateHours += $adjustedLateHours;
    }
}

$late = number_format($totalLateHours, 2, '.', '');

mysqli_stmt_close($stmt);
mysqli_close($con);
echo $late;
?>