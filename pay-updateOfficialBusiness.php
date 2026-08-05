<?php
include('connection.php');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '256M');
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Manila');
$dateUploaded = date('F j, Y'); // Or whatever format your DB column uses

// Archive old records (optimized with batching)
$select_old = "SELECT * FROM payroll_time WHERE `dateUploaded` <> '$dateUploaded'";
$result_old = mysqli_query($con, $select_old);

if ($result_old) {
    $batchArchives = [];
    if (mysqli_num_rows($result_old) > 0) {
        while ($row_old = mysqli_fetch_assoc($result_old)) {
            $batchArchives[] = "('" . mysqli_real_escape_string($con, $row_old['employeeId']) . "', '" . mysqli_real_escape_string($con, $row_old['name']) . "', '" . mysqli_real_escape_string($con, $row_old['time_in']) . "', '" . mysqli_real_escape_string($con, $row_old['time_out']) . "', '" . mysqli_real_escape_string($con, $row_old['totalhours']) . "', '" . mysqli_real_escape_string($con, $row_old['latehours']) . "', '" . mysqli_real_escape_string($con, $row_old['date']) . "', '" . mysqli_real_escape_string($con, $row_old['remarks']) . "', '" . mysqli_real_escape_string($con, $row_old['status']) . "', '" . mysqli_real_escape_string($con, $row_old['exempt']) . "', '" . mysqli_real_escape_string($con, $row_old['dateUploaded']) . "')";
        }
        if (!empty($batchArchives)) {
            $insert_sql = "INSERT INTO payroll_time_archive (`employeeId`, `name`, `time_in`, `time_out`, `totalhours`, `latehours`, `date`, `remarks`, `status`, `exempt`, `dateUploaded`) VALUES " . implode(',', $batchArchives);
            if (!mysqli_query($con, $insert_sql)) {
                error_log("Error archiving records: " . mysqli_error($con));
            }
        }
    }
} else {
    error_log("Error selecting old records: " . mysqli_error($con));
}

// Process official business leaves
$currentDate = new DateTime('now');
$currentDateFormatted = $currentDate->format('Y-m-d');
$currentDate->modify('-1 month');
$oneMonthBefore = $currentDate->format('Y-m-d');

$sql = "SELECT * FROM leavetbl WHERE iCategory = 'Official Business' AND iStatus = '2' AND dateFrom > '$oneMonthBefore' AND dateFrom < '$currentDateFormatted'";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    $batchInserts = [];
    $batchUpdates = [];
    while ($row = $result->fetch_assoc()) {
        $empId = mysqli_real_escape_string($con, $row['employee_Id']);
        $fullNamee = mysqli_real_escape_string($con, $row['iName']);
        $start = new DateTime($row['dateFrom']);
        $end = new DateTime($row['dateTo']);
        $dateUploaded = date('F j, Y');

        while ($start->format('Y-m-d') <= $end->format('Y-m-d')) {
            $currentDate = $start->format('Y-m-d');
            $checkQuery = "SELECT * FROM payroll_time WHERE employeeId = '$empId' AND date = '$currentDate'";
            $checkResult = $con->query($checkQuery);

            if ($checkResult && $checkResult->num_rows == 0) {
                $batchInserts[] = "('$fullNamee', '$empId', '08:00:00', '16:00:00', '$currentDate', 'Official Business', '1', '1', '8', '0', '$dateUploaded')";
            } else {
                $batchUpdates[] = "UPDATE payroll_time SET `time_in` = '08:00:00', `time_out` = '16:00:00', `remarks` = 'Official Business', `exempt` = '1', `status` = '1', `totalhours` = '8', `latehours` = '0', `dateUploaded` = '$dateUploaded' WHERE employeeId = '$empId' AND date = '$currentDate'";
            }
            $start->modify('+1 day');
        }
    }

    // Execute batches
    if (!empty($batchInserts)) {
        $insert_sql = "INSERT INTO payroll_time (`name`, `employeeId`, `time_in`, `time_out`, `date`, `remarks`, `exempt`, `status`, `totalhours`, `latehours`, `dateUploaded`) VALUES " . implode(',', $batchInserts);
        if (!mysqli_query($con, $insert_sql)) {
            error_log("Error batch inserting OB: " . mysqli_error($con));
        }
    }
    foreach ($batchUpdates as $update_sql) {
        if (!mysqli_query($con, $update_sql)) {
            error_log("Error updating OB: " . mysqli_error($con));
        }
    }
} else {
    if (!$result) {
        error_log("Error querying leavetbl: " . mysqli_error($con));
    }
}

$con->close();
?>