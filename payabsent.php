<?php 
include('connection.php');

$absent = "0.00";

$startdate = isset($_POST['startdateoutput']) ? trim($_POST['startdateoutput']) : '';
$enddate   = isset($_POST['enddateoutput'])   ? trim($_POST['enddateoutput'])   : '';
$empId     = isset($_POST['empId'])           ? trim($_POST['empId'])           : '';

if (empty($startdate) || empty($enddate) || empty($empId)) {
    echo "0.00";
    exit;
}

// ============================================
// STEP 1: Get all approved Unpaid Leaves that
//         overlap with the cutoff period
// ============================================
$stmt = mysqli_prepare($con, "SELECT 
    dateFrom,
    dateTo,
    kindDay,
    workingDays
FROM leavetbl
WHERE employee_Id = ?
    AND iCategory = 'Unpaid Leave'
    AND iStatus = '2'
    AND NOT (dateTo < ? OR dateFrom > ?)
ORDER BY dateFrom");

if (!$stmt) {
    error_log("Prepare failed: " . mysqli_error($con));
    echo "0.00";
    exit;
}

mysqli_stmt_bind_param($stmt, "sss", $empId, $startdate, $enddate);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$totalAbsentDays = 0;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $leaveStart   = strtotime($row['dateFrom']);
        $leaveEnd     = strtotime($row['dateTo']);
        $cutoffStart  = strtotime($startdate);
        $cutoffEnd    = strtotime($enddate);

        // Calculate the actual overlap period
        $overlapStart = max($leaveStart, $cutoffStart);
        $overlapEnd   = min($leaveEnd,   $cutoffEnd);

        // ============================================
        // STEP 2: Loop through each day in the overlap
        //         and check if it's a weekday
        // ============================================
        $currentDate = $overlapStart;

        while ($currentDate <= $overlapEnd) {
            $dayOfWeek = (int) date('N', $currentDate); // 1=Mon ... 7=Sun

            // Only count weekdays (Monday–Friday)
            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {


                if ($row['kindDay'] === 'Half Day') {
                    $totalAbsentDays += 0.5;
                } else {
                    // Whole Day — trust the approved leave, no payroll_time check
                    $totalAbsentDays += 1.0;
                }
            }

            // Use strtotime('+1 day') instead of += 86400
            // to safely handle daylight saving time changes
            $currentDate = strtotime('+1 day', $currentDate);
        }
    }
}

$absent = number_format($totalAbsentDays, 2, '.', '');

mysqli_stmt_close($stmt);
mysqli_close($con);
echo $absent;
?>