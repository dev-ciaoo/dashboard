<?php
include('connection.php');

// Initialize variables
$regularOTPay = 0;
$weekendOTPay = 0;
$totalOTPay   = 0;

$startdate     = isset($_POST['startdateoutput']) ? mysqli_real_escape_string($con, $_POST['startdateoutput']) : '';
$enddate       = isset($_POST['enddateoutput'])   ? mysqli_real_escape_string($con, $_POST['enddateoutput'])   : '';
$date          = mysqli_real_escape_string($con, $_POST['date']);
$monthlySalary = isset($_POST['valmonthly']) ? floatval($_POST['valmonthly']) : 0;
$empId         = mysqli_real_escape_string($con, isset($_POST['empId']) ? $_POST['empId'] : '');

if (empty($startdate) || empty($enddate) || empty($empId)) {
    echo "0.00";
    mysqli_close($con); // ← prevent connection leak on early exit
    exit;
}


$bcScale = 10; // internal precision scale for bcmath

$perDay  = bcdiv((string)$monthlySalary, '22', $bcScale);  // Excel column D (full precision)
$perHour = bcdiv($perDay, '8', $bcScale);                   // Excel column C (full precision)

// ============================================
// Calculate REGULAR OT
// ============================================
$sqlRegular = "SELECT ROUND(SUM(totalHours), 2) as totalHours
        FROM leavetbl
        WHERE `iStatus` = '2'
        AND `employee_Id` = '$empId'
        AND `iCategory` = 'Overtime'
        AND `kindOT` = 'Regular OT'
        AND `dateFrom` >= '$startdate'
        AND `dateFrom` <= '$enddate'";

$resultRegular = mysqli_query($con, $sqlRegular);

if ($resultRegular) {
    $row          = mysqli_fetch_assoc($resultRegular);
    $regularHours = ($row['totalHours'] !== null) ? floatval($row['totalHours']) : 0;

    // Excel Formula: Hours × PerHour × 1.25
    // bcmath: multiply regularHours × perHour first, then × 1.25
    $regularOTPay = bcmul(
                        bcmul((string)$regularHours, $perHour, $bcScale),
                        '1.25',
                        $bcScale
                    );
}

// ============================================
// Calculate WEEKEND OT
// ============================================
$sqlWeekend = "SELECT ROUND(SUM(totalHours), 2) as totalHours,
                      ROUND(SUM(workingDays), 2) as totalDays
        FROM leavetbl
        WHERE `iStatus` = '2'
        AND `employee_Id` = '$empId'
        AND `iCategory` = 'Overtime'
        AND `kindOT` = 'Weekend OT'
        AND `dateFrom` >= '$startdate'
        AND `dateFrom` <= '$enddate'";

$resultWeekend = mysqli_query($con, $sqlWeekend);

if ($resultWeekend) {
    $row          = mysqli_fetch_assoc($resultWeekend);
    $weekendHours = ($row['totalHours'] !== null) ? floatval($row['totalHours']) : 0;
    $weekendDays  = ($row['totalDays']  !== null) ? floatval($row['totalDays'])  : 0;


    if (bccomp((string)$weekendDays, '0', $bcScale) === 0 && $weekendHours > 0) {
        $weekendDays = bcdiv((string)$weekendHours, '8', $bcScale);
    }

    // Excel Formula: Days × PerDay × 1.3
    // bcmath: multiply weekendDays × perDay first, then × 1.3
    $weekendOTPay = bcmul(
                        bcmul((string)$weekendDays, $perDay, $bcScale),
                        '1.3',
                        $bcScale
                    );
}

// ============================================
// Step 4: Add Regular OT + Weekend OT
// ============================================
// bcmath: add both OT values at full precision, THEN round once at the end
$totalOTPay = bcadd((string)$regularOTPay, (string)$weekendOTPay, $bcScale);

// Round to 2 decimals to match Excel (464.009 → 464.01)
// Single rounding point — no precision was lost before this step
$totalOTPay = round((float)$totalOTPay, 2);

// Return the total
echo number_format($totalOTPay, 2, '.', '');

mysqli_close($con);
?>