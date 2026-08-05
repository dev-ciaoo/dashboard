<?php
include('connection.php');

// Retrieve and sanitize input
$empId   = isset($_POST['empId'])   ? mysqli_real_escape_string($con, $_POST['empId'])   : '';
$name    = isset($_POST['name'])    ? mysqli_real_escape_string($con, $_POST['name'])    : '';
$branch  = isset($_POST['branch'])  ? mysqli_real_escape_string($con, $_POST['branch'])  : '';
$date    = isset($_POST['date'])    ? mysqli_real_escape_string($con, $_POST['date'])    : '';
$reason  = isset($_POST['reason'])  ? mysqli_real_escape_string($con, $_POST['reason'])  : '';
$kindOT  = isset($_POST['kindOT'])  ? mysqli_real_escape_string($con, $_POST['kindOT'])  : '';
$hours   = isset($_POST['hours'])   ? mysqli_real_escape_string($con, $_POST['hours'])   : 0;
$remarks = isset($_POST['remarks']) ? mysqli_real_escape_string($con, $_POST['remarks']) : '';

// Input validation
if (!is_numeric($empId) || !is_numeric($hours) || empty($date)) {
    echo "Invalid input.";
    exit();
}

// ✅ FIX BUG 3: Use a separate variable for dateTo instead of reusing $date
$dateTo = $date;

// Cast to proper types for bind_param
$empIdInt   = (int)$empId;
$hoursFloat = (float)$hours;

// Formatted date string for myDate column (matches format used in leavetbl)
$myDate = date('F j, Y \a\t g:i A'); // e.g. February 25, 2026 at 10:00 AM

// Prepare insert statement
// Columns: user_Id, employee_Id, iName, iBranch, myDate, iEmail, toEmail, iCategory,
//          dateFrom, dateTo, timeFrom, timeTo, workingDays, totalHours,
//          kindDay, kindOT, iMessage, iRemarks, approver, timeApproved, iStatus, iAbsent
$sql = "INSERT INTO leavetbl 
        (user_Id, employee_Id, iName, iBranch, myDate, iEmail, toEmail, iCategory, 
         dateFrom, dateTo, timeFrom, timeTo, workingDays, totalHours, 
         kindDay, kindOT, iMessage, iRemarks, approver, timeApproved, iStatus, iAbsent)
        VALUES (?, ?, ?, ?, ?, '', '', 'Overtime', ?, ?, '--:--', '--:--', 0, ?, 'Whole Day', ?, ?, ?, 'Admin', NOW(), 2, 0)";

$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    echo "Prepare failed: " . mysqli_error($con);
    exit();
}

// Bind parameters:
// i = user_Id       ($empIdInt)
// i = employee_Id   ($empIdInt)
// s = iName         ($name)
// s = iBranch       ($branch)
// s = myDate        ($myDate)
// s = dateFrom      ($date)
// s = dateTo        ($dateTo)   ✅ FIX: separate variable, not $date again
// d = totalHours    ($hoursFloat)
// s = kindOT        ($kindOT)
// s = iMessage      ($reason)
// s = iRemarks      ($remarks)
mysqli_stmt_bind_param($stmt, 'iisssssdsss',
    $empIdInt,    // user_Id
    $empIdInt,    // employee_Id
    $name,
    $branch,
    $myDate,
    $date,        // dateFrom
    $dateTo,      // dateTo ✅ now a separate variable
    $hoursFloat,
    $kindOT,
    $reason,
    $remarks
);

if (mysqli_stmt_execute($stmt)) {
    echo "OT record inserted successfully.";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>