<?php

// Error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors to user
ini_set('log_errors', 1);     // Log errors to file

// Include database connection
include('connection.php');

// Initialize response array
$response = [
    'sssloan' => '0.00',
    'ssscalamity' => '0.00',
    'pagibigloan' => '0.00',
    'pagibigcalamity' => '0.00',
    'emploan' => '0.00'
];

// Helper: get the cutoff date of a loan based on its start date
// Day 1-15  = 15th of that month
// Day 16-31 = last day of that month
function getLoanCutoffDate($loanDate) {
    $d = new DateTime($loanDate);
    $day = (int)$d->format('d');
    if ($day <= 15) {
        return $d->format('Y-m') . '-15';
    } else {
        return $d->format('Y-m-') . $d->format('t');
    }
}

try {
    // ========================================
    // GET INPUT PARAMETERS
    // ========================================
    
    $empId = isset($_POST['empId']) ? mysqli_real_escape_string($con, $_POST['empId']) : '';
    $startdate = isset($_POST['startdateoutput']) ? mysqli_real_escape_string($con, $_POST['startdateoutput']) : '';
    $enddate = isset($_POST['enddateoutput']) ? mysqli_real_escape_string($con, $_POST['enddateoutput']) : '';
    
    // Validate required parameters
    if (empty($empId)) {
        throw new Exception('Employee ID is required');
    }
    
    // Get the current date from the payroll period
    // If no date provided, use enddate
    $date = !empty($enddate) ? $enddate : date('Y-m-d');
    $day = intval(date("d", strtotime($date)));

    // Determine which cutoff period this payroll run belongs to
    // First Cutoff = days 1 to 15
    // Last Cutoff  = days 16 to end of month
    $currentCutoff = ($day <= 15) ? 'Firstcutoff' : 'Lastcutoff';
    
    // ========================================
    // FETCH LOAN DATA FROM DATABASE
    // ========================================
    
    // Get the LATEST non-deleted loan record for this employee$today = date('Y-m-d');

    $sql = "SELECT * FROM pay_earningsloan 
            WHERE employeeId = '$empId' 
            AND (datedeleted = '' OR datedeleted IS NULL)
            ORDER BY id DESC 
            LIMIT 1";
    
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        throw new Exception('Database query failed: ' . mysqli_error($con));
    }
    
    if (mysqli_num_rows($result) == 0) {
        // No loan record found - return zeros
        echo json_encode($response);
        exit;
    }
    
    $row = mysqli_fetch_assoc($result);

    // ========================================
    // FIX: I-blank out ang loan na hindi pa
    // nagsisimula base sa loan cutoff date
    // Day 1-15  = 15th cutoff ng loan month
    // Day 16-31 = 30th cutoff ng loan month
    // Kung ang cutoff date ng loan > enddate ng payroll = hindi pa dapat lumabas
    // ========================================

    $payrollDate = !empty($_POST['date']) // DATE RANGE SALARY LOAN
    ? mysqli_real_escape_string($con, $_POST['date']) 
    : $enddate;

    // SSS Loan date check
    // if (!empty($row['sssloanDate']) && getLoanCutoffDate($row['sssloanDate']) > $enddate) {
    if (!empty($row['sssloanDate'])         && getLoanCutoffDate($row['sssloanDate'])         > $payrollDate) {
        $row['sssloan']            = '0';
        $row['sssloanFirst']       = '0';
        $row['sssloanLast']        = '0';
        $row['sssloanPayment']     = '';
        $row['sssloanCutoffSelect'] = '';
    }

    // SSS Calamity date check
    // if (!empty($row['ssscalamityDate']) && getLoanCutoffDate($row['ssscalamityDate']) > $enddate) {
    if (!empty($row['ssscalamityDate'])     && getLoanCutoffDate($row['ssscalamityDate'])     > $payrollDate) {
        $row['ssscalamity']            = '0';
        $row['ssscalamityFirst']       = '0';
        $row['ssscalamityLast']        = '0';
        $row['ssscalamityPayment']     = '';
        $row['ssscalamityCutoffSelect'] = '';
    }

    // Pagibig Loan date check
    // if (!empty($row['pagibigloanDate']) && getLoanCutoffDate($row['pagibigloanDate']) > $enddate) {
    if (!empty($row['pagibigloanDate'])     && getLoanCutoffDate($row['pagibigloanDate'])     > $payrollDate) {
        $row['pagibigloan']            = '0';
        $row['pagibigloanFirst']       = '0';
        $row['pagibigloanLast']        = '0';
        $row['pagibigloanPayment']     = '';
        $row['pagibigloanCutoffSelect'] = '';
    }

    // Pagibig Calamity date check
    // if (!empty($row['pagibigcalamityDate']) && getLoanCutoffDate($row['pagibigcalamityDate']) > $enddate) {
    if (!empty($row['pagibigcalamityDate']) && getLoanCutoffDate($row['pagibigcalamityDate']) > $payrollDate) {
        $row['pagibigcalamity']            = '0';
        $row['pagibigcalamityFirst']       = '0';
        $row['pagibigcalamityLast']        = '0';
        $row['pagibigcalamityPayment']     = '';
        $row['pagibigcalamityCutoffSelect'] = '';
    }

    // Salary Loan date check
    // if (!empty($row['slDate']) && getLoanCutoffDate($row['slDate']) > $enddate) {
    if (!empty($row['slDate'])              && getLoanCutoffDate($row['slDate'])              > $payrollDate) {
        $row['salaryloan']          = '0';
        $row['slAmortization']      = '0';
        $row['slAmortizationFirst'] = '0';
        $row['slAmortizationLast']  = '0';
        $row['slPayment']           = '';
        $row['slCutoffSelect']      = '';
    }
    
    // ========================================
    // DEBUG LOGGING (for troubleshooting)
    // ========================================
    
    // // Enable for specific employee (Jupen Anthony = 132)
    // $debugMode = ($empId == '132');
    
    // if ($debugMode) {
    //     error_log("=== LOAN CALCULATION DEBUG - Employee $empId ===");
    //     error_log("Date: $date (Day: $day)");
    //     error_log("Current Cutoff: $currentCutoff");
    // }
    
    // ========================================
    // CALCULATE SSS LOAN
    // ========================================
    
    $sssloan = $row['sssloan'] ?? '0.00';
    $sssloanFirst = $row['sssloanFirst'] ?? '0.00';
    $sssloanLast = $row['sssloanLast'] ?? '0.00';
    $sssloanPayment = $row['sssloanPayment'] ?? '';
    $sssloanCutoffSelect = $row['sssloanCutoffSelect'] ?? '';
    
    $sssloanAmount = 0;
    
    if ($sssloanPayment == '1') {
        // Per Month - only show on the cutoff that matches the selection
        if ($sssloanCutoffSelect == $currentCutoff) {
            $sssloanAmount = floatval($sssloan);
        }
    } elseif ($sssloanPayment == '2') {
        // Per Cut Off - show on both cutoffs with different amounts
        $sssloanAmount = ($currentCutoff == 'Firstcutoff')
            ? floatval($sssloanFirst)
            : floatval($sssloanLast);
    }
    // Payment method 3 (Deferred) = 0
    
    $response['sssloan'] = number_format(max(0, $sssloanAmount), 2, '.', '');
    
    if ($debugMode) {
        error_log("SSS Loan - Payment: $sssloanPayment, CutoffSelect: $sssloanCutoffSelect, CurrentCutoff: $currentCutoff, Amount: " . $response['sssloan']);
    }
    
    // ========================================
    // CALCULATE SSS CALAMITY
    // ========================================
    
    $ssscalamity = $row['ssscalamity'] ?? '0.00';
    $ssscalamityFirst = $row['ssscalamityFirst'] ?? '0.00';
    $ssscalamityLast = $row['ssscalamityLast'] ?? '0.00';
    $ssscalamityPayment = $row['ssscalamityPayment'] ?? '';
    $ssscalamityCutoffSelect = $row['ssscalamityCutoffSelect'] ?? '';
    
    $ssscalamityAmount = 0;
    
    if ($ssscalamityPayment == '1') {
        // Per Month - only show on the cutoff that matches the selection
        if ($ssscalamityCutoffSelect == $currentCutoff) {
            $ssscalamityAmount = floatval($ssscalamity);
        }
    } elseif ($ssscalamityPayment == '2') {
        // Per Cut Off - show on both cutoffs with different amounts
        $ssscalamityAmount = ($currentCutoff == 'Firstcutoff')
            ? floatval($ssscalamityFirst)
            : floatval($ssscalamityLast);
    }
    
    $response['ssscalamity'] = number_format(max(0, $ssscalamityAmount), 2, '.', '');
    
    if ($debugMode) {
        error_log("SSS Calamity - Payment: $ssscalamityPayment, CutoffSelect: $ssscalamityCutoffSelect, CurrentCutoff: $currentCutoff, Amount: " . $response['ssscalamity']);
    }
    
    // ========================================
    // CALCULATE PAGIBIG LOAN
    // ========================================
    
    $pagibigloan = $row['pagibigloan'] ?? '0.00';
    $pagibigloanFirst = $row['pagibigloanFirst'] ?? '0.00';
    $pagibigloanLast = $row['pagibigloanLast'] ?? '0.00';
    $pagibigloanPayment = $row['pagibigloanPayment'] ?? '';
    $pagibigloanCutoffSelect = $row['pagibigloanCutoffSelect'] ?? '';
    
    $pagibigloanAmount = 0;
    
    if ($pagibigloanPayment == '1') {
        // Per Month - only show on the cutoff that matches the selection
        if ($pagibigloanCutoffSelect == $currentCutoff) {
            $pagibigloanAmount = floatval($pagibigloan);
        }
    } elseif ($pagibigloanPayment == '2') {
        // Per Cut Off - show on both cutoffs with different amounts
        $pagibigloanAmount = ($currentCutoff == 'Firstcutoff')
            ? floatval($pagibigloanFirst)
            : floatval($pagibigloanLast);
    }
    
    $response['pagibigloan'] = number_format(max(0, $pagibigloanAmount), 2, '.', '');
    
    if ($debugMode) {
        error_log("Pagibig Loan - Payment: $pagibigloanPayment, CutoffSelect: $pagibigloanCutoffSelect, CurrentCutoff: $currentCutoff, Amount: " . $response['pagibigloan']);
    }
    
    // ========================================
    // CALCULATE PAGIBIG CALAMITY
    // ========================================
    
    $pagibigcalamity = $row['pagibigcalamity'] ?? '0.00';
    $pagibigcalamityFirst = $row['pagibigcalamityFirst'] ?? '0.00';
    $pagibigcalamityLast = $row['pagibigcalamityLast'] ?? '0.00';
    $pagibigcalamityPayment = $row['pagibigcalamityPayment'] ?? '';
    $pagibigcalamityCutoffSelect = $row['pagibigcalamityCutoffSelect'] ?? '';
    
    $pagibigcalamityAmount = 0;
    
    if ($pagibigcalamityPayment == '1') {
        // Per Month - only show on the cutoff that matches the selection
        if ($pagibigcalamityCutoffSelect == $currentCutoff) {
            $pagibigcalamityAmount = floatval($pagibigcalamity);
        }
    } elseif ($pagibigcalamityPayment == '2') {
        // Per Cut Off - show on both cutoffs with different amounts
        $pagibigcalamityAmount = ($currentCutoff == 'Firstcutoff')
            ? floatval($pagibigcalamityFirst)
            : floatval($pagibigcalamityLast);
    }
    // Payment method 3 (Deferred) = 0
    
    $response['pagibigcalamity'] = number_format(max(0, $pagibigcalamityAmount), 2, '.', '');
    
    if ($debugMode) {
        error_log("Pagibig Calamity - Payment: $pagibigcalamityPayment, CutoffSelect: $pagibigcalamityCutoffSelect, CurrentCutoff: $currentCutoff, Amount: " . $response['pagibigcalamity']);
        error_log("  Monthly: $pagibigcalamity, First: $pagibigcalamityFirst, Last: $pagibigcalamityLast");
    }
    
    // ========================================
    // CALCULATE SALARY LOAN (EMPLOAN)
    // ========================================
    
    $salaryloan = $row['salaryloan'] ?? '0.00';
    $slAmortizationFirst = $row['slAmortizationFirst'] ?? '0.00';
    $slAmortizationLast = $row['slAmortizationLast'] ?? '0.00';
    $slPayment = $row['slPayment'] ?? '';
    $slCutoffSelect = $row['slCutoffSelect'] ?? '';
    $slAmortization = $row['slAmortization'] ?? '0.00';
    
    $emploanAmount = 0;
    
    if ($slPayment == '1') {
        // Per Month - only show on the cutoff that matches the selection
        if ($slCutoffSelect == $currentCutoff) {
            $emploanAmount = floatval($slAmortization);
        }
    } elseif ($slPayment == '2') {
        // Per Cut Off - show on both cutoffs with different amounts
        $emploanAmount = ($currentCutoff == 'Firstcutoff')
            ? floatval($slAmortizationFirst)
            : floatval($slAmortizationLast);
    }
    
    $response['emploan'] = number_format(max(0, $emploanAmount), 2, '.', '');
    
    if ($debugMode) {
        error_log("Salary Loan - Payment: $slPayment, CutoffSelect: $slCutoffSelect, CurrentCutoff: $currentCutoff, Amount: " . $response['emploan']);
        error_log("=============================================");
    }
    
    // ========================================
    // RETURN JSON RESPONSE
    // ========================================
    
    header('Content-Type: application/json');
    echo json_encode($response);
    
} catch (Exception $e) {
    // Log error
    error_log("ERROR in paySalaryLoan.php: " . $e->getMessage());
    
    // Return zero values with error flag
    $response['error'] = $e->getMessage();
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close database connection
if (isset($con)) {
    mysqli_close($con);
}
?>