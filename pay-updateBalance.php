<?php
require_once 'connection.php';

define('MONTHLY_INTEREST_RATE', 0.0075);
define('PAYMENT_METHOD_MONTHLY', 1);
define('PAYMENT_METHOD_SEMI_MONTHLY', 2);
define('PAYMENT_METHOD_LUMP_SUM', 3);
define('BALANCE_CLOSEOUT_TOLERANCE', 0.11);

class DatabaseHandler {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function fetchAllActiveSalaryLoanRecords() {
        // IMPORTANT: include `id` so we can update the exact active row
        $sql = "SELECT
                    id,
                    employeeId,
                    salaryloan,
                    slAmortization,
                    slAmortizationFirst,
                    slAmortizationLast,
                    slPayment,
                    slDate,
                    slDuedate
                FROM pay_earningsloan
                WHERE salaryloan > 0
                  AND paid = '0'
                  AND (datedeleted = '' OR datedeleted IS NULL)";

        $result = $this->connection->query($sql);
        if (!$result) throw new Exception('Query failed: ' . $this->connection->error);
        return $result;
    }

    public function updateLoanBalanceByRowId($rowId, $balance) {
        $stmt = $this->connection->prepare(
            "UPDATE pay_earningsloan
             SET slBalance = ?,
                 updatedAt = NOW()
             WHERE id = ?"
        );
        if (!$stmt) throw new Exception("Prepare failed: " . $this->connection->error);

        $formattedBalance = number_format((float)$balance, 2, '.', '');
        $stmt->bind_param("si", $formattedBalance, $rowId);

        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function close() {
        $this->connection->close();
    }
}

class LoanBalanceCalculator {
    public static function calculateTotalAmortization($paymentMethod, $slAmortization, $slAmortizationFirst, $slAmortizationLast) {
        if ($paymentMethod == PAYMENT_METHOD_MONTHLY || $paymentMethod == PAYMENT_METHOD_LUMP_SUM) {
            return (float)$slAmortization;
        }
        return (float)$slAmortizationFirst + (float)$slAmortizationLast;
    }

    public static function calculateMonthsDifference($startDate, $endDate) {
        $yearsDiff  = (int)$endDate->format('Y') - (int)$startDate->format('Y');
        $monthsDiff = (int)$endDate->format('m') - (int)$startDate->format('m');

        if ($monthsDiff < 0) { $yearsDiff--; $monthsDiff += 12; }
        return $yearsDiff * 12 + $monthsDiff;
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
            $totalPeriods = $monthsPassed * 2;

            for ($i = 0; $i < $totalPeriods; $i++) {
                $lastInterest  = round($currentBalance * $halfMonthRate, 2);
                $lastPrincipal = round($halfMonthAmortization - $lastInterest, 2);
                $currentBalance = round($currentBalance - $lastPrincipal, 2);
                if ($currentBalance < 0) { $currentBalance = 0.00; break; }
            }
        }

        if ($currentBalance < 0) $currentBalance = 0.00;

        return [
            'balance'   => (float)$currentBalance,
            'interest'  => (float)$lastInterest,
            'principal' => (float)$lastPrincipal
        ];
    }
}

class LoanUpdateProcessor {
    private $db;
    private $processed = 0;
    private $errors = 0;
    private $errorDetails = [];

    public function __construct($dbHandler) { $this->db = $dbHandler; }

    public function processAllLoans() {
        try {
            $result = $this->db->fetchAllActiveSalaryLoanRecords();
            if ($result->num_rows === 0) {
                return ['status'=>'info','message'=>'No active salary loans found','processed'=>0,'errors'=>0];
            }

            while ($row = $result->fetch_assoc()) {
                $this->processLoanRecord($row);
            }

            return [
                'status' => 'success',
                'message' => 'Loan balances updated successfully',
                'processed' => $this->processed,
                'errors' => $this->errors,
                'error_details' => $this->errorDetails
            ];
        } catch (Exception $e) {
            return ['status'=>'error','message'=>'Fatal error: '.$e->getMessage(),'processed'=>$this->processed,'errors'=>$this->errors];
        }
    }

    private function processLoanRecord($r) {
        try {
            if (empty($r['id']) || empty($r['salaryloan']) || empty($r['slPayment']) || empty($r['slDate'])) {
                throw new Exception("Invalid loan row");
            }

            $rowId = (int)$r['id'];
            $initialBalance = (float)$r['salaryloan'];
            $paymentMethod = (int)$r['slPayment'];

            $startDate = new DateTime($r['slDate']);
            $currentDate = new DateTime();

            $dueDate = null;
            if (!empty($r['slDuedate'])) $dueDate = new DateTime($r['slDuedate']);

            $amortization = LoanBalanceCalculator::calculateTotalAmortization(
                $paymentMethod,
                $r['slAmortization'] ?? 0,
                $r['slAmortizationFirst'] ?? 0,
                $r['slAmortizationLast'] ?? 0
            );

            $monthsPassed = LoanBalanceCalculator::calculateMonthsDifference($startDate, $currentDate);

            $bal = LoanBalanceCalculator::calculateCurrentBalance(
                $initialBalance,
                $amortization,
                $monthsPassed,
                $paymentMethod
            );

            if ($dueDate && $currentDate >= $dueDate) {
                $bal['balance'] = 0.00;
                $bal['interest'] = 0.00;
                $bal['principal'] = 0.00;
            }

            if (abs((float)$bal['balance']) <= BALANCE_CLOSEOUT_TOLERANCE) {
                $bal['balance'] = 0.00;
            }

            if (!$this->db->updateLoanBalanceByRowId($rowId, $bal['balance'])) {
                throw new Exception("DB update failed");
            }

            $this->processed++;
        } catch (Exception $e) {
            $this->errors++;
            $this->errorDetails[] = ['rowId'=>$r['id'] ?? 'unknown', 'employeeId'=>$r['employeeId'] ?? 'unknown', 'error'=>$e->getMessage()];
        }
    }
}

class ResponseHandler {
    public static function sendHTML($data) {
        $statusClass = $data['status'] === 'success' ? 'success' : ($data['status'] === 'info' ? 'info' : 'error');
        echo "<div class='response-{$statusClass}'>";
        echo "<h3>" . ucfirst($data['status']) . "</h3>";
        echo "<p>{$data['message']}</p>";
        echo "<p>Processed: {$data['processed']} | Errors: {$data['errors']}</p>";
        if (!empty($data['error_details'])) {
            echo "<details><summary>Error Details</summary><pre>";
            print_r($data['error_details']);
            echo "</pre></details>";
        }
        echo "</div>";
    }
}

try {
    $db = new DatabaseHandler($con);
    $processor = new LoanUpdateProcessor($db);
    $result = $processor->processAllLoans();
    ResponseHandler::sendHTML($result);
    $db->close();
} catch (Exception $e) {
    ResponseHandler::sendHTML(['status'=>'error','message'=>'System error: '.$e->getMessage(),'processed'=>0,'errors'=>1]);
}
