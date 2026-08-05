<?php
include('connection.php');

// Turn OFF display errors for AJAX - log to file instead
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

// CRITICAL: Set JSON header BEFORE any output
header('Content-Type: application/json');

define('MONTHLY_INTEREST_RATE', 0.0075);
define('PAYMENT_METHOD_MONTHLY', 1);
define('PAYMENT_METHOD_SEMI_MONTHLY', 2);
define('PAYMENT_METHOD_LUMP_SUM', 3);
define('BALANCE_CLOSEOUT_TOLERANCE', 0.11);

class LoanBalanceCalculator {
    public static function calculateTotalAmortization($paymentMethod, $slAmortization, $slAmortizationFirst, $slAmortizationLast) {
        if ($paymentMethod == PAYMENT_METHOD_MONTHLY || $paymentMethod == PAYMENT_METHOD_LUMP_SUM) {
            return (float)$slAmortization;
        }
        return (float)$slAmortizationFirst + (float)$slAmortizationLast;
    }

    public static function calculateMonthsDifference($startDate, $endDate) {
        $yearsDiff = (int)$endDate->format('Y') - (int)$startDate->format('Y');
        $monthsDiff = (int)$endDate->format('m') - (int)$startDate->format('m');

        if ($monthsDiff < 0) {
            $yearsDiff--;
            $monthsDiff += 12;
        }

        $months = $yearsDiff * 12 + $monthsDiff;

        if ((int)$endDate->format('d') >= (int)$startDate->format('d')) {
            $months++;
        }

        return max(0, $months);
    }

    // NEW METHOD — counts actual cutoff dates (15th and 30th) that have passed since start
    public static function calculateCutoffPeriodsPassed($startDate, $endDate) {
        $periods = 0;
        $y = (int)$startDate->format('Y');
        $m = (int)$startDate->format('m');

        while (true) {
            $lastDay = (int)(new DateTime("$y-$m-01"))->format('t');
            $mid = new DateTime(sprintf('%04d-%02d-15', $y, $m));
            $end = new DateTime(sprintf('%04d-%02d-%02d', $y, $m, $lastDay));

            if ($mid > $endDate) break;
            if ($mid >= $startDate) $periods++;

            if ($end > $endDate) break;
            if ($end >= $startDate) $periods++;

            $m++;
            if ($m > 12) { $m = 1; $y++; }
        }

        return $periods;
    }

    public static function calculateCurrentBalance($initialBalance, $amortization, $monthsPassed, $paymentMethod) {
        $currentBalance = (float)$initialBalance;
        $lastInterest = 0.00;
        $lastPrincipal = 0.00;

        if ($paymentMethod == PAYMENT_METHOD_MONTHLY || $paymentMethod == PAYMENT_METHOD_LUMP_SUM) {
            for ($i = 0; $i < $monthsPassed; $i++) {
                $lastInterest  = round($currentBalance * MONTHLY_INTEREST_RATE, 2);
                $lastPrincipal = round($amortization - $lastInterest, 2);
                $currentBalance = round($currentBalance - $lastPrincipal, 2);
                if ($currentBalance < 0) { $currentBalance = 0.00; break; }
            }
        } elseif ($paymentMethod == PAYMENT_METHOD_SEMI_MONTHLY) {
            $halfMonthRate = MONTHLY_INTEREST_RATE / 2;
            $halfMonthAmortization = $amortization / 2;
            $totalPeriods = $monthsPassed; // already actual cutoff periods, no *2

            for ($i = 0; $i < $totalPeriods; $i++) {
                $lastInterest  = round($currentBalance * $halfMonthRate, 2);
                $lastPrincipal = round($halfMonthAmortization - $lastInterest, 2);
                $currentBalance = round($currentBalance - $lastPrincipal, 2);
                if ($currentBalance < 0) { $currentBalance = 0.00; break; }
            }
        }

        if ($currentBalance < 0) $currentBalance = 0.00;

        return [
            'balance' => (float)$currentBalance,
            'interest' => (float)$lastInterest,
            'principal' => (float)$lastPrincipal
        ];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $id = (int)($_POST['employeeId'] ?? 0);
        $name = $_POST['name'] ?? '';
        $branch = $_POST['address'] ?? '';

        // SSS loan fields
        $sssloan = $_POST['sssloan'] ?? '';
        $sssloanfirst = $_POST['sssloanfirst'] ?? '';
        $sssloanlast = $_POST['sssloanlast'] ?? '';
        $sssloanDate = $_POST['sssloanDate'] ?? '';
        $sssloanDuedate = $_POST['sssloanDuedate'] ?? '';
        $sssloanPayment = $_POST['sssloanPayment'] ?? '';
        $sssloanCutoffSelect = $_POST['sssloanCutoffSelect'] ?? '';

        // SSS calamity
        $ssscalamity = $_POST['ssscalamity'] ?? '';
        $ssscalamityfirst = $_POST['ssscalamityfirst'] ?? '';
        $ssscalamitylast = $_POST['ssscalamitylast'] ?? '';
        $ssscalamityDate = $_POST['ssscalamityDate'] ?? '';
        $ssscalamityDuedate = $_POST['ssscalamityDuedate'] ?? '';
        $ssscalamityPayment = $_POST['ssscalamityPayment'] ?? '';
        $ssscalamityCutoffSelect = $_POST['ssscalamityCutoffSelect'] ?? '';

        // Pagibig loan
        $pagibigloan = $_POST['pagibigloan'] ?? '';
        $pagibigloanfirst = $_POST['pagibigloanfirst'] ?? '';
        $pagibigloanlast = $_POST['pagibigloanlast'] ?? '';
        $pagibigloanDate = $_POST['pagibigloanDate'] ?? '';
        $pagibigloanDuedate = $_POST['pagibigloanDuedate'] ?? '';
        $pagibigloanPayment = $_POST['pagibigloanPayment'] ?? '';
        $pagibigloanCutoffSelect = $_POST['pagibigloanCutoffSelect'] ?? '';

        // Pagibig calamity
        $pagibigcalamity = $_POST['pagibigcalamity'] ?? '';
        $pagibigcalamityfirst = $_POST['pagibigcalamityfirst'] ?? '';
        $pagibigcalamitylast = $_POST['pagibigcalamitylast'] ?? '';
        $pagibigcalamityDate = $_POST['pagibigcalamityDate'] ?? '';
        $pagibigcalamityDuedate = $_POST['pagibigcalamityDuedate'] ?? '';
        $pagibigcalamityPayment = $_POST['pagibigcalamityPayment'] ?? '';
        $pagibigcalamityCutoffSelect = $_POST['pagibigcalamityCutoffSelect'] ?? '';

        // Salary loan fields
        $salaryloan = $_POST['salaryloan'] ?? '';
        $slyear = $_POST['slyear'] ?? '';
        $slPayment = $_POST['slPayment'] ?? '';
        $slDate = $_POST['slDate'] ?? '';
        $slDuedate = $_POST['slDuedate'] ?? '';
        $slAmortization = $_POST['slAmortization'] ?? '';
        $slAmortizationfirst = $_POST['slAmortizationfirst'] ?? '';
        $slAmortizationlast = $_POST['slAmortizationlast'] ?? '';
        $slCount = $_POST['slCount'] ?? '';
        $slcutoffSelect = $_POST['slcutoffSelect'] ?? '';
        $slBank = $_POST['slBank'] ?? '';

        // FULLY PAID HANDLING
        $inputPaid = $_POST['inputPaid'] ?? "0";
        $currentDate = date("Y-m-d");

        // If marked as fully paid, set balance to 0 and archive immediately
        if ($inputPaid == "1") {
            $computedSlBalance = "0.00";
            
            // Mark existing records as deleted (archived)
            $archive_query = "UPDATE pay_earningsloan SET datedeleted = ?, paid = '1' WHERE employeeId = ? AND datedeleted = ''";
            $stmt_archive = mysqli_prepare($con, $archive_query);
            if (!$stmt_archive) throw new Exception('Error preparing archive statement: ' . mysqli_error($con));
            
            mysqli_stmt_bind_param($stmt_archive, "si", $currentDate, $id);
            mysqli_stmt_execute($stmt_archive);
            mysqli_stmt_close($stmt_archive);
            
            // Don't insert new record when fully paid
            echo json_encode([
                'success' => true, 
                'message' => 'Loan marked as fully paid and archived', 
                'balance' => '0.00',
                'fullyPaid' => true
            ]);
            exit;
        }

        // SERVER-SIDE recompute slBalance (only if NOT fully paid)
        $computedSlBalance = "0.00";
        $initialBalance = (float)$salaryloan;
        $pm = (int)$slPayment;

        if ($initialBalance > 0 && in_array($pm, [PAYMENT_METHOD_MONTHLY, PAYMENT_METHOD_SEMI_MONTHLY, PAYMENT_METHOD_LUMP_SUM], true) && !empty($slDate)) {
            $startDate = new DateTime($slDate);

            // Resolve $now based on start date cutoff: day 1-15 = 15th cutoff, day 16-31 = 30th cutoff
            $now = new DateTime();
            $startDay  = (int)$startDate->format('d');
            $slMonth   = $startDate->format('m');
            $slYear    = $startDate->format('Y');

            if ($startDay <= 15) {
                $cutoffRef = new DateTime("$slYear-$slMonth-15");
            } else {
                $lastDay   = (int)$startDate->format('t');
                $cutoffRef = new DateTime("$slYear-$slMonth-$lastDay");
            }

            if ($now < $cutoffRef) {
                $now = $cutoffRef;
            }

            $dueDateObj = null;
            if (!empty($slDuedate)) $dueDateObj = new DateTime($slDuedate);

            $amort = LoanBalanceCalculator::calculateTotalAmortization(
                $pm,
                $slAmortization,
                $slAmortizationfirst,
                $slAmortizationlast
            );

            // Use cutoff period counter for semi-monthly, month counter for others
            if ($pm == PAYMENT_METHOD_SEMI_MONTHLY) {
                $monthsPassed = LoanBalanceCalculator::calculateCutoffPeriodsPassed($startDate, $now);
            } else {
                $monthsPassed = LoanBalanceCalculator::calculateMonthsDifference($startDate, $now);
            }

            $balanceData = LoanBalanceCalculator::calculateCurrentBalance($initialBalance, $amort, $monthsPassed, $pm);

            if ($dueDateObj && $now >= $dueDateObj) {
                $balanceData['balance'] = 0.00;
                $balanceData['interest'] = 0.00;
                $balanceData['principal'] = 0.00;
            }

            if (abs((float)$balanceData['balance']) <= BALANCE_CLOSEOUT_TOLERANCE) {
                $balanceData['balance'] = 0.00;
            }

            $computedSlBalance = number_format((float)$balanceData['balance'], 2, '.', '');
        }

        // Archive previous records (soft delete)
        $check_query = "SELECT employeeId FROM pay_earningsloan WHERE employeeId = ? AND datedeleted = ''";
        $stmt_check = mysqli_prepare($con, $check_query);
        if (!$stmt_check) throw new Exception('Error preparing check statement: ' . mysqli_error($con));

        mysqli_stmt_bind_param($stmt_check, "i", $id);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            $update_query = "UPDATE pay_earningsloan SET datedeleted = ? WHERE employeeId = ? AND datedeleted = ''";
            $stmt_update = mysqli_prepare($con, $update_query);
            if (!$stmt_update) throw new Exception('Error preparing update statement: ' . mysqli_error($con));

            mysqli_stmt_bind_param($stmt_update, "si", $currentDate, $id); // LOANS ATA 
            mysqli_stmt_execute($stmt_update); 
            mysqli_stmt_close($stmt_update);
        }
        mysqli_stmt_close($stmt_check);

        // Insert new record
        $insertQuery = "INSERT INTO pay_earningsloan
        (`employeeId`, `name`, `branch`,`datemodified`,
         `salaryloan`,`slYear`,`slPayment`,`slDate`,`slDuedate`,
         `slAmortization`,`slBalance`,`slCount`,`slCutoffSelect`,`slBank`,
         `sssloan`,`sssloandate`,`sssloanDuedate`,`sssloanPayment`,`sssloanCutoffSelect`,
         `ssscalamity`,`ssscalamityDate`,`ssscalamityDuedate`,`ssscalamityPayment`,`ssscalamityCutoffSelect`,
         `pagibigloan`,`pagibigloanDate`,`pagibigloanDuedate`,`pagibigloanPayment`,`pagibigloanCutoffSelect`,
         `pagibigcalamity`,`pagibigcalamityDate`,`pagibigcalamityDuedate`,`pagibigcalamityPayment`,`pagibigcalamityCutoffSelect`,
         `sssloanFirst`,`sssloanLast`,`ssscalamityFirst`,`ssscalamityLast`,`pagibigloanFirst`,`pagibigloanLast`,
         `pagibigcalamityFirst`,`pagibigcalamityLast`,`slAmortizationFirst`,`slAmortizationLast`,`paid`)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = mysqli_prepare($con, $insertQuery);
        if (!$stmt) throw new Exception('Error preparing insert statement: ' . mysqli_error($con));

        mysqli_stmt_bind_param(
            $stmt,
            "issssssssssssssssssssssssssssssssssssssssssss",
            $id, $name, $branch, $currentDate,
            $salaryloan, $slyear, $slPayment, $slDate, $slDuedate,
            $slAmortization, $computedSlBalance, $slCount, $slcutoffSelect, $slBank,
            $sssloan, $sssloanDate, $sssloanDuedate, $sssloanPayment, $sssloanCutoffSelect,
            $ssscalamity, $ssscalamityDate, $ssscalamityDuedate, $ssscalamityPayment, $ssscalamityCutoffSelect,
            $pagibigloan, $pagibigloanDate, $pagibigloanDuedate, $pagibigloanPayment, $pagibigloanCutoffSelect,
            $pagibigcalamity, $pagibigcalamityDate, $pagibigcalamityDuedate, $pagibigcalamityPayment, $pagibigcalamityCutoffSelect,
            $sssloanfirst, $sssloanlast, $ssscalamityfirst, $ssscalamitylast, $pagibigloanfirst, $pagibigloanlast,
            $pagibigcalamityfirst, $pagibigcalamitylast, $slAmortizationfirst, $slAmortizationlast, $inputPaid
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception('Execute failed: ' . mysqli_stmt_error($stmt));
        }
        
        // SUCCESS
        echo json_encode([
            'success' => true, 
            'message' => 'Loan record saved successfully', 
            'balance' => $computedSlBalance
        ]);
        
        mysqli_stmt_close($stmt);
        mysqli_close($con);

    } catch (Exception $e) {
        // ERROR
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    
    exit;
}
?>