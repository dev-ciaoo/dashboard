<?php
// pay-extractcsv.php - FLEXIBLE CUTOFF WITH DATE FILTERING
include('connection.php');
ini_set('max_execution_time', 0);
ini_set('mysql.connect_timeout', 0);
set_time_limit(0);

date_default_timezone_set('Asia/Manila');

$targetDir = "payroll/";
if (!is_dir($targetDir)) {
    @mkdir($targetDir, 0755, true);
}

// ===================================================================
// ✅ GET USER-SELECTED PAYROLL PERIOD FROM DROPDOWN
// ===================================================================

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "<script>alert('Invalid request method.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// ✅ Capture the dropdown selection
$userSelectedPeriod = isset($_POST['payrollPeriod']) ? trim($_POST['payrollPeriod']) : '';

if (empty($userSelectedPeriod)) {
    echo "<script>alert('Please select a Payroll Period from the dropdown.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

if (!isset($_FILES["csvFile"])) {
    echo "<script>alert('No file uploaded.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

$originalFileName = $_FILES["csvFile"]["name"];
$tmpName = $_FILES["csvFile"]["tmp_name"];
$fileError = $_FILES["csvFile"]["error"];
$fileSize = $_FILES["csvFile"]["size"];

// Check upload errors
if ($fileError !== UPLOAD_ERR_OK) {
    $errMsg = 'Unknown upload error.';
    $map = [
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds upload_max_filesize.',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the form MAX_FILE_SIZE.',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded.',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.',
    ];
    if (isset($map[$fileError])) $errMsg = $map[$fileError];
    echo "<script>alert('Upload error: {$errMsg}');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// Validate extension
$fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
if ($fileType != "csv") {
    echo "<script>alert('Only CSV files are allowed.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// Size limit check
$maxBytes = 10 * 1024 * 1024; // 10 MB
if ($fileSize > $maxBytes) {
    echo "<script>alert('File is too large. Maximum allowed is 10 MB.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// Move uploaded file
$targetFile = $targetDir . basename($originalFileName);
if (file_exists($targetFile)) {
    $randomNumber = rand(1000, 9999);
    $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $randomNumber . '.' . $fileType;
    $targetFile = $targetDir . $newFileName;
}

if (!move_uploaded_file($tmpName, $targetFile)) {
    echo "<script>alert('There was an error moving the uploaded file.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// ===================================================================
// ✅ NEW LOGIC: AUTO-DETECT DATE RANGE FROM CSV CONTENT
// ===================================================================

// STEP 1: Scan CSV to find actual date range
$handle = fopen($targetFile, 'r');
if ($handle === false) {
    echo "<script>alert('Failed to open uploaded CSV for reading.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// Skip header if exists
$firstRow = fgetcsv($handle);
$hasHeader = false;
if ($firstRow !== false) {
    $maybeId = isset($firstRow[0]) ? trim($firstRow[0]) : '';
    if (!is_numeric($maybeId)) {
        $hasHeader = true;
    } else {
        rewind($handle);
    }
}

// Scan all dates in CSV
$csvDates = [];
while (($data = fgetcsv($handle)) !== false) {
    if (count($data) === 1 && trim($data[0]) === '') continue;
    
    $dateFromCSV = isset($data[2]) ? trim($data[2]) : '';
    if ($dateFromCSV !== '') {
        $parsedDate = date("Y-m-d", strtotime($dateFromCSV));
        if ($parsedDate !== '1970-01-01' && $parsedDate !== false) {
            $csvDates[] = $parsedDate;
        }
    }
}
fclose($handle);

// Validate we have dates
if (empty($csvDates)) {
    echo "<script>alert('No valid dates found in CSV file.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// Get earliest and latest dates from CSV
sort($csvDates);
$csvMinDate = $csvDates[0];
$csvMaxDate = end($csvDates);

// ===================================================================
// ✅ FIXED: Determine correct cutoff period based on CSV dates
// ===================================================================

// For 15th cutoff: "current month" = month containing the 10th
// For 30th cutoff: "current month" = month containing the 11th-25th

$currentMonth = null;
$currentYear = null;

if ($userSelectedPeriod === '15th') {
    // Find the "current month" by looking for dates in the 1-10 range
    foreach ($csvDates as $d) {
        $day = (int)date('j', strtotime($d));
        if ($day >= 1 && $day <= 10) {
            $currentMonth = (int)date('n', strtotime($d));
            $currentYear = (int)date('Y', strtotime($d));
            break;
        }
    }
    
    // If no dates in 1-10 found, check for dates in 26-31 range
    // Those dates are in the "previous month", so we calculate "current month" as next month
    if ($currentMonth === null) {
        foreach ($csvDates as $d) {
            $day = (int)date('j', strtotime($d));
            if ($day >= 26) {
                $tempMonth = (int)date('n', strtotime($d));
                $tempYear = (int)date('Y', strtotime($d));
                
                // The next month is the "current month"
                if ($tempMonth == 12) {
                    $currentMonth = 1;
                    $currentYear = $tempYear + 1;
                } else {
                    $currentMonth = $tempMonth + 1;
                    $currentYear = $tempYear;
                }
                break;
            }
        }
    }
    
    // Calculate 15th cutoff range: 26th (previous month) to 10th (current month)
    if ($currentMonth === 1) {
        $startDate = ($currentYear - 1) . '-12-26';
    } else {
        $prevMonth = $currentMonth - 1;
        $startDate = $currentYear . '-' . str_pad($prevMonth, 2, '0', STR_PAD_LEFT) . '-26';
    }
    $endDate = $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-10';
    $modifiedDate = date("$currentYear-$currentMonth-15");
    
} else { // 30th cutoff
    // Find the "current month" by looking for dates in the 11-25 range
    foreach ($csvDates as $d) {
        $day = (int)date('j', strtotime($d));
        if ($day >= 11 && $day <= 25) {
            $currentMonth = (int)date('n', strtotime($d));
            $currentYear = (int)date('Y', strtotime($d));
            break;
        }
    }
    
    // If no dates found in 11-25, use the minimum date's month as fallback
    if ($currentMonth === null) {
        $currentMonth = (int)date('n', strtotime($csvMinDate));
        $currentYear = (int)date('Y', strtotime($csvMinDate));
    }
    
    // Calculate 30th cutoff range: 11th to 25th (same current month)
    $startDate = $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-11';
    $endDate = $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-25';
    
    // Handle February special case for modified date
    if ($currentMonth == 2) {
        if (date('L', strtotime("$currentYear-01-01"))) {
            $modifiedDate = date("$currentYear-02-29");
        } else {
            $modifiedDate = date("$currentYear-02-28");
        }
    } else {
        $modifiedDate = date("$currentYear-$currentMonth-30");
    }
}

error_log("CSV Date Range Detected: $csvMinDate to $csvMaxDate");
error_log("User Selected: $userSelectedPeriod | Calculated Range: $startDate to $endDate");

// Convert to timestamps for comparison
$startTimestamp = strtotime($startDate);
$endTimestamp = strtotime($endDate);

$current_date = date('Y-m-d H:i:s');
$formattedDate = date('F j, Y', strtotime($modifiedDate));

// ===================================================================
// ✅ STORE DATE RANGE VIA AJAX (Using CSV-detected period)
// ===================================================================

echo "<script src=\"js/jquery-3.6.0.min.js\" crossorigin=\"anonymous\"></script>";
echo "<script>
    var modifiedDate = '" . $modifiedDate . "';
    var formattedDate = '" . $formattedDate . "';
    var startDate = '" . $startDate . "';
    var endDate = '" . $endDate . "';
    
    $.ajax({
        url: 'pay-adddate.php',
        method: 'POST',
        data: {
            modifiedDate : modifiedDate,
            formattedDate : formattedDate,
            selectedStartDate : startDate,
            selectedEndDate : endDate
        },
        success: function(response) {
            console.log('Date range stored successfully');
        },
        error: function(xhr, status, error) {
            console.log('pay-adddate error', error);
        }
    });
</script>";

// ===================================================================
// ✅ PROCESS CSV WITH DATE FILTERING
// ===================================================================

$handle = fopen($targetFile, 'r');
if ($handle === false) {
    echo "<script>alert('Failed to open uploaded CSV for reading.');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

// Skip header if present
$firstRow = fgetcsv($handle);
$hasHeader = false;
if ($firstRow !== false) {
    $maybeId = isset($firstRow[0]) ? trim($firstRow[0]) : '';
    if (!is_numeric($maybeId)) {
        $hasHeader = true;
    } else {
        rewind($handle);
    }
}

// Counters for tracking
$totalRows = 0;
$processedRows = 0;
$skippedRows = 0;
$skippedDates = [];

// Insert rows into payroll table (WITH DATE FILTERING)
while (($data = fgetcsv($handle)) !== false) {
    if (count($data) === 1 && trim($data[0]) === '') continue;
    if ($hasHeader && isset($data) && $data === $firstRow) {
        $hasHeader = false;
        continue;
    }

    $id = isset($data[0]) ? trim($data[0]) : '';
    $name = isset($data[1]) ? trim($data[1]) : '';
    $dateFromCSV = isset($data[2]) ? trim($data[2]) : '';
    $timeFromCSV = isset($data[3]) ? trim($data[3]) : '';
    $branch = isset($data[4]) ? trim($data[4]) : '';

    if ($id === '' && $name === '') {
        continue;
    }

    $totalRows++;

    $date = date("Y-m-d", strtotime($dateFromCSV));
    $time = date("H:i:s", strtotime($timeFromCSV));
    
    if ($date === false || $date === '1970-01-01') {
        $date = date("Y-m-d");
    }
    if ($time === false) {
        $time = date("H:i:s");
    }

    // ✅ CHECK IF DATE FALLS WITHIN SELECTED CUTOFF RANGE
    $dateTimestamp = strtotime($date);
    
    if ($dateTimestamp < $startTimestamp || $dateTimestamp > $endTimestamp) {
        // Date is OUTSIDE the selected cutoff range - SKIP IT
        $skippedRows++;
        if (!in_array($date, $skippedDates)) {
            $skippedDates[] = $date;
        }
        error_log("SKIPPED: Date $date is outside range $startDate to $endDate");
        continue; // Skip this row
    }

    // ✅ Date is WITHIN range - PROCESS IT
    $processedRows++;

    $sql = "INSERT INTO payroll (`name`, `employeeId`, `time`, `branch`, `date`,`datesubmitted`) 
            VALUES ('" . mysqli_real_escape_string($con, $name) . "',
                    '" . mysqli_real_escape_string($con, $id) . "',
                    '" . mysqli_real_escape_string($con, $time) . "',
                    '" . mysqli_real_escape_string($con, $branch) . "',
                    '" . mysqli_real_escape_string($con, $date) . "',
                    '" . mysqli_real_escape_string($con, $current_date) . "')";
    if (!mysqli_query($con, $sql)) {
        error_log("pay-extractcsv insert error: " . mysqli_error($con) . " -- SQL: $sql");
    }
}

fclose($handle);

error_log("CSV Processing: Total=$totalRows, Processed=$processedRows, Skipped=$skippedRows");

// ===================================================================
// ✅ CHECK IF ANY VALID DATA WAS PROCESSED
// ===================================================================

if ($processedRows === 0) {
    echo "<script>alert('No valid dates found within the selected cutoff period.\\n\\nSelected: {$userSelectedPeriod} Cutoff\\nExpected Range: " . date('M d', strtotime($startDate)) . " - " . date('M d', strtotime($endDate)) . "');</script>";
    header("Refresh:1;pay-importdata.php");
    exit;
}

$select_sql = "SELECT accounts.fullName as name, payroll.employeeId, MAX(payroll.id) as max_id, payroll.date, 
            MAX(payroll.time) as max_time, MIN(payroll.time) as min_time, leavetbl.*
            FROM payroll 
            LEFT JOIN accounts ON accounts.employeeId = payroll.employeeId 
            LEFT JOIN leavetbl ON leavetbl.employee_Id = payroll.employeeId AND leavetbl.dateFrom = payroll.date AND (leavetbl.iCategory = 'Vacation Leave' OR leavetbl.iCategory = 'Sick Leave' OR leavetbl.iCategory = 'Mandatory Leave' OR leavetbl.iCategory = 'Unpaid Leave')
            WHERE (payroll.status = '0' OR payroll.status = '') 
            GROUP BY payroll.employeeId, payroll.date";

$result = mysqli_query($con, $select_sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $emp_id = $row['employeeId'];
            $name = $row['name'];
            $date = $row['date'];
            $max_time = $row['max_time'];
            $min_time = $row['min_time'];
            $kindDay = isset($row['kindDay']) ? $row['kindDay'] : null;
            $iStatus = isset($row['iStatus']) ? $row['iStatus'] : null;

            $min_time_str = $min_time ?: '08:00:00';
            $max_time_str = $max_time ?: '16:00:00';

            $time_in = strtotime($min_time_str);
            $time_out = strtotime($max_time_str);

            $actual_time_in = date('H:i:s', $time_in);

            if ($actual_time_in < '08:00:00') {
                $time_in_for_hours = strtotime(date('Y-m-d 08:00:00', $time_in));
            } else {
                $time_in_for_hours = $time_in;
            }

            if (date('H:i:s', $time_out) > '16:00:00') {
                $time_out = strtotime(date('Y-m-d 16:00:00', $time_out));
            }

            $time_difference = $time_out - $time_in_for_hours;
            $hours = floor($time_difference / 3600);
            $remaining_minutes = ($time_difference % 3600) / 60;

            if ($remaining_minutes > 30) {
                $hours += 0.5;
            }

            // Late hours calculation (unchanged)
            $latehours = 0;
            $actual_time_in_stamp = strtotime(date('Y-m-d', $time_in) . ' ' . $actual_time_in);
            $grace_end = strtotime(date('Y-m-d 08:11:00', $time_in));

            if ($actual_time_in_stamp >= $grace_end) {
                $minutes_from_8_11 = floor(($actual_time_in_stamp - $grace_end) / 60);
                
                if ($minutes_from_8_11 < 20) {
                    $latehours = 0.5;
                } else {
                    $minutes_after_first_bracket = $minutes_from_8_11 - 20;
                    $additional_brackets = floor($minutes_after_first_bracket / 30) + 1;
                    $latehours = 0.5 + ($additional_brackets * 0.5);
                    
                    if ($latehours > 4) {
                        $latehours = 4;
                    }
                }
            } else {
                $latehours = 0;
            }

            $total = ($kindDay === 'Half Day' && $iStatus == '2') ? 4 : 8;

            date_default_timezone_set('Asia/Manila');
            $dateUploaded = date('F j, Y');

            $emp_id_esc = mysqli_real_escape_string($con, $emp_id);
            $min_time_esc = mysqli_real_escape_string($con, date('H:i:s', $time_in));
            $max_time_esc = mysqli_real_escape_string($con, date('H:i:s', $time_out));
            $date_esc = mysqli_real_escape_string($con, $date);
            $name_esc = mysqli_real_escape_string($con, $name);
            $latehours_esc = mysqli_real_escape_string($con, $latehours);
            $dateUploaded_esc = mysqli_real_escape_string($con, $dateUploaded);

            $check_sql = "SELECT * FROM payroll_time WHERE employeeId = '$emp_id_esc' AND date = '$date_esc'";
            $check_result = mysqli_query($con, $check_sql);

            if ($check_result && mysqli_num_rows($check_result) > 0) {
                $update_sql = "UPDATE payroll_time SET 
                                `time_in` = '$min_time_esc', 
                                `time_out` = '$max_time_esc', 
                                `totalhours` = $hours,
                                `latehours` = '$latehours_esc',
                                `dateUploaded` = '$dateUploaded_esc'
                               WHERE `employeeId` = '$emp_id_esc' AND `date` = '$date_esc'";
                if (!mysqli_query($con, $update_sql)) {
                    error_log("pay-extractcsv update payroll_time error: " . mysqli_error($con));
                }
            } else {
                $insert_sql = "INSERT INTO payroll_time 
                                (`employeeId`, `time_in`, `time_out`, `date`, `name`, `totalhours`, `dateUploaded`, `latehours`)
                               VALUES (
                                '$emp_id_esc', '$min_time_esc', '$max_time_esc', '$date_esc', '$name_esc', $hours, '$dateUploaded_esc', '$latehours_esc'
                               )";
                if (!mysqli_query($con, $insert_sql)) {
                    error_log("pay-extractcsv insert payroll_time error: " . mysqli_error($con));
                }
            }
        }
    }
}

$update_status_sql = "UPDATE payroll SET `status` = '1' ";
mysqli_query($con, $update_status_sql);

$update_status2_sql = "UPDATE payroll_time SET `status` = '1' ";
if (mysqli_query($con, $update_status2_sql)) {
    $move = "DELETE FROM `payroll_time` WHERE `dateUploaded` <> '$dateUploaded'";
    mysqli_query($con, $move);
}

mysqli_close($con);

// ===================================================================
// ✅ SHOW SUCCESS MESSAGE WITH SUMMARY
// ===================================================================

$successMessage = "✅ Upload Successful!\\n\\n";
$successMessage .= "File: " . htmlspecialchars(basename($originalFileName)) . "\\n";
$successMessage .= "Period: {$userSelectedPeriod} Cutoff ({$formattedDate})\\n";
$successMessage .= "Date Range: " . date('M d', strtotime($startDate)) . " - " . date('M d', strtotime($endDate)) . "\\n\\n";
$successMessage .= "Processed: {$processedRows} records\\n";

if ($skippedRows > 0) {
    $successMessage .= "Skipped: {$skippedRows} records (outside date range)\\n";
    $successMessage .= "Skipped Dates: " . implode(', ', array_map(function($d) { return date('M d', strtotime($d)); }, $skippedDates));
}

echo "<script>alert('{$successMessage}');</script>";

header("Refresh:1;pay-importdata.php");
exit;
?>