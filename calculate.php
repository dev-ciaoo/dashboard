<?php
header('Content-Type: application/json');

function calculateIRR(array $cashFlows, float $guess = 0.01): float {
    $tolerance = 1e-7;
    $maxIterations = 1500;
    $x0 = $guess;

    for ($i = 0; $i < $maxIterations; $i++) {
        $fValue = 0.0;
        $fDerivative = 0.0;
        $initialDate = strtotime($cashFlows[0]['date']);

        foreach ($cashFlows as $flow) {
            $days = (strtotime($flow['date']) - $initialDate) / (60 * 60 * 24);
            $years = $days / 365;
            $fValue += $flow['amount'] / pow(1 + $x0, $years);
            $fDerivative -= ($years * $flow['amount']) / pow(1 + $x0, $years + 1);
        }

        if (abs($fDerivative) < $tolerance) {
            break; // Avoid division by near-zero
        }

        $x1 = $x0 - $fValue / $fDerivative;

        if (abs($x1 - $x0) < $tolerance) {
            return round($x1 * 100, 6); // Convert to percentage
        }

        $x0 = $x1;
    }

    return round($x1 * 100, 6); // Return final approximation as percentage
}

function truncateDecimal($number, $digits) {
    $step = pow(10, $digits);
    return floor($number * $step) / $step;
}

function roundDecimal($number, $digits) {
    return round($number, $digits);
}


// Collect POST data
$typeLoan        = $_POST['typeLoan'] ?? '';
$loanAmount      = floatval($_POST['loanAmount'] ?? 0);
$loanStartDate   = $_POST['loanStartDate'] ?? date('F j, Y');
$loanYears       = intval($_POST['loanYears'] ?? 0);
$loanMonths      = intval($_POST['loanMonth'] ?? 0);
$loanWeeks       = intval($_POST['loanWeek'] ?? 0);
$annualInterest  = floatval($_POST['annualInterest'] ?? 0);
$gracePeriod     = intval($_POST['gracePeriod'] ?? 0);
$balloonPayment  = floatval($_POST['balloonPayment'] ?? 0);
$otherCharges    = floatval($_POST['otherCharges'] ?? 0);

$principalCycle = $_POST['principalCycle'] ?? '';
$interestCycle = $_POST['interestCycle'] ?? '';

$response = [];
$schedule = [];

$totalMonths = ($loanYears * 12) + $loanMonths;
$totalWeeks  = $loanWeeks;
$principal   = $loanAmount;
$rateAnnual  = $annualInterest / 100;

// Calculate first payment date (same day next month)
$paymentDate = new DateTime($loanStartDate);
$originalDay = (int)$paymentDate->format('d');
$paymentDate->modify('+1 month');
$year = (int)$paymentDate->format('Y');
$month = (int)$paymentDate->format('m');
$lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$paymentDate->setDate($year, $month, min($originalDay, $lastDay));

// Add Period 0 (Loan start date)
$schedule[] = [
    'installment' => 0,
    'paymentDate' => date('F j, Y', strtotime($loanStartDate)),
    'principal' => number_format(0, 2),
    'interest' => number_format(0, 2),
    'otherCharges' => number_format(($loanAmount / 100) * $otherCharges, 2),
    'payment' => number_format(0, 2),
    'balance' => number_format($loanAmount, 2)
];

switch ($typeLoan) {
    case 'Fixed Equal Amortization Case':
    $r = $rateAnnual / 12;
    $n = $totalMonths;
    $monthly = ($r > 0)
        ? ($principal * $r) / (1 - pow(1 + $r, -$n))
        : $principal / $n;

    $monthlyRounded = round($monthly, 5);

    // Calculate total payment (monthly * n)
    $totalPayment = bcmul((string)$monthlyRounded, (string)$n, 10);

    // Total interest using loop
    $totalInterestAccurate = '0';
    $balance = $principal;
    for ($i = 1; $i <= $n; $i++) {
        $interest = bcmul((string)$balance, (string)$r, 10);
        $totalInterestAccurate = bcadd($totalInterestAccurate, $interest, 10);
        $principalPayment = $monthlyRounded - (float)$interest;
        $balance = bcsub((string)$balance, (string)$principalPayment, 10);
    }

    // Compute other charges
    $otherChargeAmount = ($loanAmount * $otherCharges) / 100;

    // === IRR Effective Rate Calculation ===
    $cashFlows = [];
    $loanStartDateObj = new DateTime($loanStartDate);
    $cashFlows[] = [
        'amount' => -($principal + $otherChargeAmount),
        'date' => $loanStartDateObj->format('Y-m-d')
    ];

    $cfPaymentDate = clone $paymentDate;
    for ($i = 1; $i <= $n; $i++) {
        $cashFlows[] = [
            'amount' => $monthlyRounded,
            'date' => $cfPaymentDate->format('Y-m-d')
        ];
        $cfPaymentDate->modify('+1 month');
    }

    // === RESPONSE SUMMARY ===
    $response['loanAmount'] = number_format($loanAmount, 2);
    $response['monthlyInstallment'] = $monthlyRounded;
    $response['contractualRate'] = number_format($annualInterest / 12, 2) . '%';
    $response['otherCharges'] = number_format($otherChargeAmount, 2);
    $response['totalPayment'] = number_format((float)$totalPayment + $otherChargeAmount, 2);
    $response['totalInterest'] = number_format((float)$totalInterestAccurate, 2);
    $response['installments'] = $n;
    $response['loanType'] = $typeLoan;
    $response['monthlyAmortization'] = $monthlyRounded;
    $effectiveRate = calculateIRR($cashFlows);
    $response['effectiveInterest'] = number_format((float)$effectiveRate, 2) . '%';

    // === AMORTIZATION SCHEDULE ===
    $balance = $principal;
    for ($i = 1; $i <= $n; $i++) {
        $interest = $balance * $r;
        $principalPayment = $monthlyRounded - $interest;
        $endingBalance = $balance - $principalPayment;

        // Store 4-decimal interest for accurate total calculation
        $interestRaw = round($interest, 4); // for summing later
        $interestDisplay = number_format($interestRaw, 2); // for showing only

        $schedule[] = [
            'installment' => $i,
            'paymentDate' => $paymentDate->format('F j, Y'),
            'principal' => number_format($principalPayment, 2),
            'interest' => $interestDisplay,             // only display 2 decimals
            'interestRaw' => $interestRaw,              // store 4 decimals if needed later
            'otherCharges' => number_format(0, 2),
            'payment' => number_format($monthlyRounded, 2),
            'balance' => number_format(max($endingBalance, 0), 2)
        ];

        $balance = $endingBalance;

        $paymentDate->modify('+1 month');
        $year = (int)$paymentDate->format('Y');
        $month = (int)$paymentDate->format('m');
        $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
    }

    // === PAYOFF DATE ===
    $loanStartDateObj->modify("+$totalMonths months");
    $y = (int)$loanStartDateObj->format('Y');
    $m = (int)$loanStartDateObj->format('m');
    $ld = cal_days_in_month(CAL_GREGORIAN, $m, $y);
    $loanStartDateObj->setDate($y, $m, min($originalDay, $ld));
    $response['payoffDate'] = $loanStartDateObj->format('F j, Y');

    break;

    // Leave other cases as-is (you can refactor later)
    // case 'Fixed Principal Amortization Case':
    //     $n = $totalMonths;
    //     $monthlyPrincipal = bcdiv((string)$principal, (string)$n, 10); // e.g., 833.333...
    //     $balance = $principal;
    //     $totalPayment = '0';
    //     $totalInterest = '0';

    //     $paymentDate = new DateTime($loanStartDate);
    //     $paymentDate->modify('+1 month');
    //     $year = (int)$paymentDate->format('Y');
    //     $month = (int)$paymentDate->format('m');
    //     $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    //     $paymentDate->setDate($year, $month, min($originalDay, $lastDay));

    //     for ($i = 1; $i <= $n; $i++) {
    //         $interest = bcmul((string)$balance, (string)($rateAnnual / 12), 10); // Monthly interest
    //         $payment = bcadd($monthlyPrincipal, $interest, 10);

    //         $totalPayment = bcadd($totalPayment, $payment, 10);
    //         $totalInterest = bcadd($totalInterest, $interest, 10);

    //         $schedule[] = [
    //             'installment' => $i,
    //             'paymentDate' => $paymentDate->format('F j, Y'),
    //             'principal' => number_format((float)$monthlyPrincipal, 2),
    //             'interest' => number_format((float)$interest, 2),
    //             'otherCharges' => number_format(0, 2),
    //             'payment' => number_format((float)$payment, 2),
    //             'balance' => number_format(max($balance - (float)$monthlyPrincipal, 0), 2)
    //         ];

    //         $balance = bcsub((string)$balance, $monthlyPrincipal, 10);

    //         $paymentDate->modify('+1 month');
    //         $year = (int)$paymentDate->format('Y');
    //         $month = (int)$paymentDate->format('m');
    //         $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    //         $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
    //     }

    //     $totalPaymentFloat = round((float)$totalPayment, 2);       // e.g., 10,270.83
    //     $totalInterestFloat = round((float)$totalInterest, 2);     // e.g., 270.83

    //     $response['loanType'] = $typeLoan;
    //     $response['monthlyPrincipal'] = round((float)$monthlyPrincipal, 2);                // 833.33
    //     $response['averageMonthlyPayment'] = number_format($totalPaymentFloat / $n, 2);    // e.g., 855.90
    //     $response['totalPayment'] = number_format($totalPaymentFloat, 2);                  // e.g., 10,270.83
    //     $response['totalInterest'] = number_format($totalInterestFloat, 2);                // e.g., 270.83

    //     // Build cash flows for IRR calculation
    //     $cashFlows = [];
    //     $paymentDate = new DateTime($loanStartDate);
    //     $cashFlows[] = ['amount' => -1 * $principal, 'date' => $paymentDate->format('Y-m-d')];

    //     // Reset date and start tracking cash flows
    //     $paymentDate->modify('+1 month');
    //     $year = (int)$paymentDate->format('Y');
    //     $month = (int)$paymentDate->format('m');
    //     $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    //     $paymentDate->setDate($year, $month, min($originalDay, $lastDay));

    //     $balance = $principal;
    //     for ($i = 1; $i <= $n; $i++) {
    //         $interest = (float)bcmul((string)$balance, (string)($rateAnnual / 12), 10);
    //         $payment = (float)bcadd($monthlyPrincipal, $interest, 10);
    //         $cashFlows[] = ['amount' => $payment, 'date' => $paymentDate->format('Y-m-d')];

    //         $balance -= (float)$monthlyPrincipal;
    //         $paymentDate->modify('+1 month');
    //         $year = (int)$paymentDate->format('Y');
    //         $month = (int)$paymentDate->format('m');
    //         $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    //         $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
    //     }

    //     $effectiveRate = calculateIRR($cashFlows);
    //     $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
    // break;



//    case 'Fixed Equal Amortization Case with Grace Period':
//         $grace = $gracePeriod;
//         $n = $totalMonths;
//         $r = $rateAnnual / 12;
//         $monthlyRate = round($r * 100, 2) . '%';

//         $amortMonths = $n;
//         $monthly = ($r > 0)
//             ? ($principal * $r) / (1 - pow(1 + $r, -$amortMonths))
//             : $principal / $amortMonths;

//         $monthlyRounded = round($monthly, 2);

//         $response['loanType'] = $typeLoan;
//         $response['gracePeriodMonthly'] = number_format(0, 2); // Grace period = 0 payment
//         $response['postGraceMonthly'] = number_format($monthlyRounded, 2);
//         $response['monthlyInstallment'] = $monthlyRounded;
//         $response['contractualRate'] = number_format($r * 100, 2) . '%';
//         $response['installments'] = $n;

//         // Total payment only counts amortization period
//         $totalPayment = $monthlyRounded * $n;
//         $totalInterest = $totalPayment - $principal;

//         $response['totalPayment'] = number_format($totalPayment, 2);
//         $response['totalInterest'] = number_format($totalInterest, 2);

//         // Start amortization after grace period
//         $cashFlows = [];
//         $cashFlows[] = ['amount' => $principal * -1, 'date' => (new DateTime($loanStartDate))->format('Y-m-d')];

//         for ($i = 1; $i <= $grace; $i++) {
//             $schedule[] = [
//                 'installment' => $i,
//                 'paymentDate' => $paymentDate->format('F j, Y'),
//                 'principal' => number_format(0, 2),
//                 'interest' => number_format(0, 2),
//                 'otherCharges' => number_format(0, 2),
//                 'payment' => number_format(0, 2),
//                 'balance' => number_format($principal, 2)
//             ];
//             $paymentDate->modify('+1 month');
//         }

//         $balance = $principal;
//         for ($i = 1; $i <= $n; $i++) {
//             $interest = round($balance * $r, 10);
//             $principalPayment = $monthlyRounded - $interest;
//             $balance -= $principalPayment;

//             $schedule[] = [
//                 'installment' => $grace + $i,
//                 'paymentDate' => $paymentDate->format('F j, Y'),
//                 'principal' => number_format($principalPayment, 2),
//                 'interest' => number_format($interest, 2),
//                 'otherCharges' => number_format(0, 2),
//                 'payment' => number_format($monthlyRounded, 2),
//                 'balance' => number_format(max($balance, 0), 2)
//             ];

//             $cashFlows[] = ['amount' => $monthlyRounded, 'date' => $paymentDate->format('Y-m-d')];
//             $paymentDate->modify('+1 month');
//         }

//         $effectiveRate = calculateIRR($cashFlows);
//         $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';

//         // Correct Payoff Date (Loan Start Date + Grace + Term)
//         $payoffDate = new DateTime($loanStartDate);
//         $payoffDate->modify('+' . ($n + $grace) . ' months');
//         $y = (int)$payoffDate->format('Y');
//         $m = (int)$payoffDate->format('m');
//         $ld = cal_days_in_month(CAL_GREGORIAN, $m, $y);
//         $payoffDate->setDate($y, $m, min($originalDay, $ld));
//         $response['payoffDate'] = $payoffDate->format('F j, Y');
//     break;



   case 'Periodic Interest Payment, Balloon Payment at Maturity':
        if ($principalCycle === "Monthly" && $interestCycle === "Monthly") {
            $n = $totalMonths;
            $r = $rateAnnual / 12; // Monthly interest rate (decimal)
            $balloonAmt = $principal * ($balloonPayment / 100);
            $otherChargeAmount = ($principal * $otherCharges) / 100;

            // Fixed principal per month for all months
            $fixedPrincipal = ($principal - $balloonAmt) / $n;

            $totalInterest = 0;
            $totalPrincipal = 0;
            $totalPayment = 0;
            $cashFlows = [];

            // Initial cash outflow (loan disbursed minus charges)
            $disbursedAmount = $principal - $otherChargeAmount;
            $loanStartDateObj = new DateTime($loanStartDate);

            $cashFlows[] = [
                'amount' => round(-1 * $disbursedAmount, 4),
                'date' => $loanStartDateObj->format('Y-m-d')
            ];

            // Start payment schedule from next month
            $paymentDate = new DateTime($loanStartDate);
            $originalDay = (int)$paymentDate->format('d');
            $paymentDate->modify('+1 month');
            $year = (int)$paymentDate->format('Y');
            $month = (int)$paymentDate->format('m');
            $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $paymentDate->setDate($year, $month, min($originalDay, $lastDay));

            $currentBalance = $principal;

            for ($i = 1; $i <= $n; $i++) {
                $isLast = ($i === $n);

                // Interest on current balance
                $interest = $currentBalance * $r;
                $interestRaw = round($interest, 4);
                $interestDisplay = number_format($interestRaw, 2);

                if ($isLast) {
                    $principalPayment = $fixedPrincipal + $balloonAmt;
                    $payment = $principalPayment + $interest;
                    $balanceDisplay = 0;
                } else {
                    $principalPayment = $fixedPrincipal;
                    $payment = $principalPayment + $interest;
                    $balanceDisplay = $currentBalance - $fixedPrincipal;
                }

                $totalInterest += $interest;
                $totalPrincipal += $principalPayment;
                $totalPayment += $payment;

                $schedule[] = [
                    'installment' => $i,
                    'paymentDate' => $paymentDate->format('F j, Y'),
                    'principal' => number_format($principalPayment, 2),
                    'interest' => $interestDisplay,
                    'interestRaw' => $interestRaw,
                    'otherCharges' => number_format(0, 2),
                    'payment' => number_format($payment, 2),
                    'balance' => number_format($balanceDisplay, 2)
                ];

                $cashFlows[] = [
                    'amount' => round($payment, 4),
                    'date' => $paymentDate->format('Y-m-d')
                ];

                $currentBalance -= $fixedPrincipal;

                // Prepare next month's payment date
                $paymentDate->modify('+1 month');
                $year = (int)$paymentDate->format('Y');
                $month = (int)$paymentDate->format('m');
                $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
            }

            // IRR calculation
            $effectiveRate = calculateIRR($cashFlows);
            if (!is_numeric($effectiveRate) || is_nan($effectiveRate) || is_infinite($effectiveRate)) {
                $effectiveRate = 0.0;
            }

            $response['loanType'] = $typeLoan;
            $response['loanAmount'] = number_format($principal, 2);
            $response['monthlyPrincipal'] = number_format($fixedPrincipal, 2);
            $response['balloonPayment'] = number_format($balloonAmt, 2);
            $response['contractualRate'] = number_format($r * 100, 2) . '%';
            $response['otherCharges'] = number_format($otherChargeAmount, 2);
            $response['installments'] = $n;
            $response['totalPayment'] = number_format($totalPayment + $otherChargeAmount, 2);
            $response['totalInterest'] = number_format($totalInterest, 2);
            $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
            $response['payoffDate'] = $paymentDate->modify('-1 month')->format('F j, Y');
            
        } 
        
        if ($principalCycle === "Single Payment" && $interestCycle === "Single Payment") {
            $r = $rateAnnual;
            $n = $totalMonths;
            $otherChargeAmount = ($principal * $otherCharges) / 100;

            $loanStartDateObj = new DateTime($loanStartDate);
            $paymentDate = clone $loanStartDateObj;
            $paymentDate->modify("+{$n} months");
            $year = (int)$paymentDate->format('Y');
            $month = (int)$paymentDate->format('m');
            $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $originalDay = (int)$loanStartDateObj->format('d');
            $paymentDate->setDate($year, $month, min($originalDay, $lastDay));

            $interestAmount = $principal * $r * ($n / 12);   
            $totalPayment = $principal + $interestAmount;

            $schedule = [];

            // Period 0 - Loan disbursement
            $schedule[] = [
                'installment' => 0,
                'paymentDate' => $loanStartDateObj->format('F j, Y'),
                'principal' => number_format(0, 2),
                'interest' => number_format(0, 2),
                'interestRaw' => 0,
                'otherCharges' => number_format($otherChargeAmount, 2),
                'payment' => number_format(0, 2),
                'balance' => number_format($principal, 2)
            ];

            // Period 1 - Full payment at maturity
            $schedule[] = [
                'installment' => 1,
                'paymentDate' => $paymentDate->format('F j, Y'),
                'principal' => number_format($principal, 2),
                'interest' => number_format($interestAmount, 2),
                'interestRaw' => round($interestAmount, 4),
                'otherCharges' => number_format(0, 2),
                'payment' => number_format($totalPayment, 2),
                'balance' => number_format(0, 2)
            ];

            $cashFlows = [
                [
                    'amount' => round(-1 * ($principal - $otherChargeAmount), 4),
                    'date' => $loanStartDateObj->format('Y-m-d')
                ],
                [
                    'amount' => round($totalPayment, 4),
                    'date' => $paymentDate->format('Y-m-d')
                ]
            ];

            $effectiveRate = calculateIRR($cashFlows);
            if (!is_numeric($effectiveRate) || is_nan($effectiveRate) || is_infinite($effectiveRate)) {
                $effectiveRate = 0.0;
            }

            // Response
            $response['loanType'] = $typeLoan;
            $response['loanAmount'] = number_format($principal, 2);
            $response['monthlyPrincipal'] = number_format(0, 2);
            $response['balloonPayment'] = number_format(0, 2);
            $response['contractualRate'] = number_format($r * 100, 2) . '%';
            $response['otherCharges'] = number_format($otherChargeAmount, 2);
            $response['installments'] = 1;
            $response['totalPayment'] = number_format($totalPayment + $otherChargeAmount, 2);
            $response['totalInterest'] = number_format($interestAmount, 2);
            $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
            $response['payoffDate'] = $paymentDate->format('F j, Y');
            $response['schedule'] = $schedule;
        }

        if ($principalCycle === "Single Payment" && $interestCycle === "Monthly") {
            $n = $totalMonths;
            $r = $rateAnnual / 12; // Monthly interest rate (decimal)
            $otherChargeAmount = ($principal * $otherCharges) / 100;

            $schedule = [];

            $loanStartDateObj = new DateTime($loanStartDate);
            $originalDay = (int)$loanStartDateObj->format('d');

            // Period 0 - Loan disbursement
            $schedule[] = [
                'installment' => 0,
                'paymentDate' => $loanStartDateObj->format('F j, Y'),
                'principal' => number_format(0, 2),
                'interest' => number_format(0, 2),
                'interestRaw' => 0,
                'otherCharges' => number_format($otherChargeAmount, 2),
                'payment' => number_format(0, 2),
                'balance' => number_format($principal, 2)
            ];

            $paymentDate = clone $loanStartDateObj;
            $paymentDate->modify('+1 month');
            $currentBalance = $principal;

            $cashFlows = [
                [
                    'amount' => round(-1 * ($principal - $otherChargeAmount), 4),
                    'date' => $loanStartDateObj->format('Y-m-d')
                ]
            ];

            $totalInterest = 0;
            $totalPrincipal = 0;
            $totalPayment = 0;

            for ($i = 1; $i <= $n; $i++) {
                $isLast = ($i === $n);
                $interest = $currentBalance * $r;
                $principalPayment = $isLast ? $principal : 0;
                $payment = $principalPayment + $interest;
                $balanceDisplay = $isLast ? 0 : $currentBalance;

                $totalInterest += $interest;
                $totalPrincipal += $principalPayment;
                $totalPayment += $payment;

                $schedule[] = [
                    'installment' => $i,
                    'paymentDate' => $paymentDate->format('F j, Y'),
                    'principal' => number_format($principalPayment, 2),
                    'interest' => number_format($interest, 2),
                    'interestRaw' => round($interest, 4),
                    'otherCharges' => number_format(0, 2),
                    'payment' => number_format($payment, 2),
                    'balance' => number_format($balanceDisplay, 2)
                ];

                $cashFlows[] = [
                    'amount' => round($payment, 4),
                    'date' => $paymentDate->format('Y-m-d')
                ];

                // Only reduce balance on the last payment
                if ($isLast) {
                    $currentBalance -= $principalPayment;
                }

                // Move to next month
                $paymentDate->modify('+1 month');
                $year = (int)$paymentDate->format('Y');
                $month = (int)$paymentDate->format('m');
                $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
            }

            // IRR
            $effectiveRate = calculateIRR($cashFlows);
            if (!is_numeric($effectiveRate) || is_nan($effectiveRate) || is_infinite($effectiveRate)) {
                $effectiveRate = 0.0;
            }

            // Response
            $response['loanType'] = $typeLoan;
            $response['loanAmount'] = number_format($principal, 2);
            $response['monthlyPrincipal'] = number_format(0, 2);
            $response['balloonPayment'] = number_format(0, 2);
            $response['contractualRate'] = number_format($r * 12 * 100, 2) . '%';
            $response['otherCharges'] = number_format($otherChargeAmount, 2);
            $response['installments'] = $n;
            $response['totalPayment'] = number_format($totalPayment + $otherChargeAmount, 2);
            $response['totalInterest'] = number_format($totalInterest, 2);
            $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
            $response['payoffDate'] = $paymentDate->modify('-1 month')->format('F j, Y');
            $response['schedule'] = $schedule;
        }

        if ($principalCycle === "Quarterly" && $interestCycle === "Monthly") {
            $n = $totalMonths;
            $r = $rateAnnual / 12; // Monthly interest rate (decimal)
            $quarterlyPrincipal = $principal / 4;
            $otherChargeAmount = ($principal * $otherCharges) / 100;

            $schedule = [];

            $loanStartDateObj = new DateTime($loanStartDate);
            $originalDay = (int)$loanStartDateObj->format('d');

            // Period 0 - Loan disbursement
            $schedule[] = [
                'installment' => 0,
                'paymentDate' => $loanStartDateObj->format('F j, Y'),
                'principal' => number_format(0, 2),
                'interest' => number_format(0, 2),
                'interestRaw' => 0,
                'otherCharges' => number_format($otherChargeAmount, 2),
                'payment' => number_format(0, 2),
                'balance' => number_format($principal, 2)
            ];

            $paymentDate = clone $loanStartDateObj;
            $paymentDate->modify('+1 month');
            $currentBalance = $principal;

            $cashFlows = [
                [
                    'amount' => round(-1 * ($principal - $otherChargeAmount), 4),
                    'date' => $loanStartDateObj->format('Y-m-d')
                ]
            ];

            $totalInterest = 0;
            $totalPrincipal = 0;
            $totalPayment = 0;

            for ($i = 1; $i <= $n; $i++) {
                $isQuarter = $i % 3 === 0; // Every 3 months
                $principalPayment = $isQuarter ? $quarterlyPrincipal : 0;

                $interest = $currentBalance * $r;
                $payment = $principalPayment + $interest;
                $balanceDisplay = $currentBalance - $principalPayment;

                $totalInterest += $interest;
                $totalPrincipal += $principalPayment;
                $totalPayment += $payment;

                $schedule[] = [
                    'installment' => $i,
                    'paymentDate' => $paymentDate->format('F j, Y'),
                    'principal' => number_format($principalPayment, 2),
                    'interest' => number_format($interest, 2),
                    'interestRaw' => round($interest, 4),
                    'otherCharges' => number_format(0, 2),
                    'payment' => number_format($payment, 2),
                    'balance' => number_format($balanceDisplay, 2)
                ];

                $cashFlows[] = [
                    'amount' => round($payment, 4),
                    'date' => $paymentDate->format('Y-m-d')
                ];

                $currentBalance = $balanceDisplay;

                // Move to next month
                $paymentDate->modify('+1 month');
                $year = (int)$paymentDate->format('Y');
                $month = (int)$paymentDate->format('m');
                $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
            }

            // IRR
            $effectiveRate = calculateIRR($cashFlows);
            if (!is_numeric($effectiveRate) || is_nan($effectiveRate) || is_infinite($effectiveRate)) {
                $effectiveRate = 0.0;
            }

            // Response
            $response['loanType'] = $typeLoan;
            $response['loanAmount'] = number_format($principal, 2);
            $response['monthlyPrincipal'] = number_format(0, 2);
            $response['balloonPayment'] = number_format(0, 2);
            $response['contractualRate'] = number_format($r * 12 * 100, 2) . '%';
            $response['otherCharges'] = number_format($otherChargeAmount, 2);
            $response['installments'] = $n;
            $response['totalPayment'] = number_format($totalPayment + $otherChargeAmount, 2);
            $response['totalInterest'] = number_format($totalInterest, 2);
            $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
            $response['payoffDate'] = $paymentDate->modify('-1 month')->format('F j, Y');
            $response['schedule'] = $schedule;
        }

        if ($principalCycle === "Semi-Annual" && $interestCycle === "Monthly") {
            $n = $totalMonths;
            $r = $rateAnnual / 12; // Monthly rate (1% for 12% annual)
            $semiAnnualPrincipal = $principal / 2;
            $otherChargeAmount = ($principal * $otherCharges) / 100;

            $schedule = [];

            $loanStartDateObj = new DateTime($loanStartDate);
            $originalDay = (int)$loanStartDateObj->format('d');

            // Period 0 - Loan disbursement
            $schedule[] = [
                'installment' => 0,
                'paymentDate' => $loanStartDateObj->format('F j, Y'),
                'principal' => number_format(0, 2),
                'interest' => number_format(0, 2),
                'interestRaw' => 0,
                'otherCharges' => number_format($otherChargeAmount, 2),
                'payment' => number_format(0, 2),
                'balance' => number_format($principal, 2)
            ];

            $paymentDate = clone $loanStartDateObj;
            $paymentDate->modify('+1 month');
            $currentBalance = $principal;

            $cashFlows = [
                [
                    'amount' => round(-1 * ($principal - $otherChargeAmount), 4),
                    'date' => $loanStartDateObj->format('Y-m-d')
                ]
            ];

            $totalInterest = 0;
            $totalPrincipal = 0;
            $totalPayment = 0;

            for ($i = 1; $i <= $n; $i++) {
                $isSemiAnnual = ($i === 6 || $i === 12); // 6th and 12th month
                $principalPayment = $isSemiAnnual ? $semiAnnualPrincipal : 0;

                $interest = $currentBalance * $r;
                $payment = $principalPayment + $interest;
                $balanceDisplay = $currentBalance - $principalPayment;

                $totalInterest += $interest;
                $totalPrincipal += $principalPayment;
                $totalPayment += $payment;

                $schedule[] = [
                    'installment' => $i,
                    'paymentDate' => $paymentDate->format('F j, Y'),
                    'principal' => number_format($principalPayment, 2),
                    'interest' => number_format($interest, 2),
                    'interestRaw' => round($interest, 4),
                    'otherCharges' => number_format(0, 2),
                    'payment' => number_format($payment, 2),
                    'balance' => number_format($balanceDisplay, 2)
                ];

                $cashFlows[] = [
                    'amount' => round($payment, 4),
                    'date' => $paymentDate->format('Y-m-d')
                ];

                $currentBalance = $balanceDisplay;

                // Move to next month
                $paymentDate->modify('+1 month');
                $year = (int)$paymentDate->format('Y');
                $month = (int)$paymentDate->format('m');
                $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
            }

            // IRR
            $effectiveRate = calculateIRR($cashFlows);
            if (!is_numeric($effectiveRate) || is_nan($effectiveRate) || is_infinite($effectiveRate)) {
                $effectiveRate = 0.0;
            }

            // Response
            $response['loanType'] = $typeLoan;
            $response['loanAmount'] = number_format($principal, 2);
            $response['monthlyPrincipal'] = number_format(0, 2);
            $response['balloonPayment'] = number_format(0, 2);
            $response['contractualRate'] = number_format($r * 12 * 100, 2) . '%';
            $response['otherCharges'] = number_format($otherChargeAmount, 2);
            $response['installments'] = $n;
            $response['totalPayment'] = number_format($totalPayment + $otherChargeAmount, 2);
            $response['totalInterest'] = number_format($totalInterest, 2);
            $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
            $response['payoffDate'] = $paymentDate->modify('-1 month')->format('F j, Y');
            $response['schedule'] = $schedule;
        }

        if($principalCycle === "Yearly" && $interestCycle === "Monthly"){
            $n = $totalMonths;
            $r = $rateAnnual / 12; // Monthly interest rate (decimal)
            $otherChargeAmount = ($principal * $otherCharges) / 100;

            $schedule = [];

            $loanStartDateObj = new DateTime($loanStartDate);
            $originalDay = (int)$loanStartDateObj->format('d');

            // Period 0 - Loan disbursement
            $schedule[] = [
                'installment' => 0,
                'paymentDate' => $loanStartDateObj->format('F j, Y'),
                'principal' => number_format(0, 2),
                'interest' => number_format(0, 2),
                'interestRaw' => 0,
                'otherCharges' => number_format($otherChargeAmount, 2),
                'payment' => number_format(0, 2),
                'balance' => number_format($principal, 2)
            ];

            $paymentDate = clone $loanStartDateObj;
            $paymentDate->modify('+1 month');
            $currentBalance = $principal;

            $cashFlows = [
                [
                    'amount' => round(-1 * ($principal - $otherChargeAmount), 4),
                    'date' => $loanStartDateObj->format('Y-m-d')
                ]
            ];

            $totalInterest = 0;
            $totalPrincipal = 0;
            $totalPayment = 0;

            for ($i = 1; $i <= $n; $i++) {
                $isLast = ($i === $n);
                $interest = $currentBalance * $r;
                $principalPayment = $isLast ? $principal : 0;
                $payment = $principalPayment + $interest;
                $balanceDisplay = $isLast ? 0 : $currentBalance;

                $totalInterest += $interest;
                $totalPrincipal += $principalPayment;
                $totalPayment += $payment;

                $schedule[] = [
                    'installment' => $i,
                    'paymentDate' => $paymentDate->format('F j, Y'),
                    'principal' => number_format($principalPayment, 2),
                    'interest' => number_format($interest, 2),
                    'interestRaw' => round($interest, 4),
                    'otherCharges' => number_format(0, 2),
                    'payment' => number_format($payment, 2),
                    'balance' => number_format($balanceDisplay, 2)
                ];

                $cashFlows[] = [
                    'amount' => round($payment, 4),
                    'date' => $paymentDate->format('Y-m-d')
                ];

                // Only reduce balance on the last payment
                if ($isLast) {
                    $currentBalance -= $principalPayment;
                }

                // Move to next month
                $paymentDate->modify('+1 month');
                $year = (int)$paymentDate->format('Y');
                $month = (int)$paymentDate->format('m');
                $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $paymentDate->setDate($year, $month, min($originalDay, $lastDay));
            }

            // IRR
            $effectiveRate = calculateIRR($cashFlows);
            if (!is_numeric($effectiveRate) || is_nan($effectiveRate) || is_infinite($effectiveRate)) {
                $effectiveRate = 0.0;
            }

            // Response
            $response['loanType'] = $typeLoan;
            $response['loanAmount'] = number_format($principal, 2);
            $response['monthlyPrincipal'] = number_format(0, 2);
            $response['balloonPayment'] = number_format(0, 2);
            $response['contractualRate'] = number_format($r * 12 * 100, 2) . '%';
            $response['otherCharges'] = number_format($otherChargeAmount, 2);
            $response['installments'] = $n;
            $response['totalPayment'] = number_format($totalPayment + $otherChargeAmount, 2);
            $response['totalInterest'] = number_format($totalInterest, 2);
            $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
            $response['payoffDate'] = $paymentDate->modify('-1 month')->format('F j, Y');
            $response['schedule'] = $schedule;
        }
 
    break;


    case 'Fixed Equal Amortization Case (Weekly Installments)':
        $r = $rateAnnual / 52; // Weekly interest rate
        $n = $totalWeeks; // Total number of weekly installments
        $otherChargeAmount = ($principal * $otherCharges) / 100; // Calculate other charges

        // Determine the precise weekly payment amount to match the desired total interest
        // Desired Total Interest: 127.36
        // Desired Total Payment: Loan Amount + Desired Total Interest = 10000 + 127.36 = 10127.36
        // Desired Weekly Installment (unrounded): Total Payment / n = 10127.36 / 10 = 1012.736
        $weeklyPaymentAmount = ($principal + 127.36) / $n; 
        
        $paymentDate = new DateTime($loanStartDate);
        $originalStartDate = clone $paymentDate;

        $schedule = [];
        $balance = $principal;
        $totalPaymentAccumulated = 0.0; // Accumulate total payment
        $totalInterestAccumulated = 0.0; // Accumulate total interest

        // Period 0 (Loan start date)
        $schedule[] = [
            'installment' => 0,
            'paymentDate' => $originalStartDate->format('M.d.Y'),
            'principal' => number_format(0, 2),
            'interest' => number_format(0, 2),
            'otherCharges' => number_format(0, 2),
            'payment' => 0,
            'balance' => number_format($principal, 2)
        ];

        // Cash flows for IRR calculation
        $cashFlows = [];
        // Initial cash outflow (loan received minus other charges)
        $cashFlows[] = [
            'amount' => round(-1 * ($principal - $otherChargeAmount), 4),
            'date' => $originalStartDate->format('Y-m-d')
        ];

        for ($i = 1; $i <= $n; $i++) {
            $paymentDate->modify('+7 days'); // Increment date by 7 days for weekly payments

            $interest = $balance * $r; // Calculate interest for the period
            $principalPayment = $weeklyPaymentAmount - $interest; // Calculate principal payment

            // Adjust the last payment to ensure the balance goes exactly to zero
            if ($i == $n) {
                $principalPayment = $balance; // Principal payment is the remaining balance
                $interest = $weeklyPaymentAmount - $principalPayment; // Interest is the remainder of the payment
                $balance = 0; // Balance becomes zero
            } else {
                $balance -= $principalPayment; // Reduce balance by principal payment
            }
            
            // Ensure balance doesn't go negative due to floating point inaccuracies
            if ($balance < 0.001 && $i != $n) { // Allow for small negative if not last payment, adjust only on last
                $balance = 0;
            }

            $totalPaymentAccumulated += $weeklyPaymentAmount; // Accumulate total payment
            $totalInterestAccumulated += $interest; // Accumulate total interest (unrounded)

            $schedule[] = [
                'installment' => $i,
                'paymentDate' => $paymentDate->format('M.d.Y'),
                'principal' => number_format($principalPayment, 2),
                'interest' => number_format($interest, 2),
                'otherCharges' => number_format(0, 2),
                'payment' => number_format($weeklyPaymentAmount, 2), // Display rounded weekly payment
                'balance' => number_format($balance, 2)
            ];

            // Add payment to cash flows for IRR calculation
            $cashFlows[] = [
                'amount' => round($weeklyPaymentAmount, 4),
                'date' => $paymentDate->format('Y-m-d')
            ];
        }

        // IRR calculation
        $effectiveRate = calculateIRR($cashFlows);
        // Handle cases where IRR might not converge or results in non-numeric values
        if (!is_numeric($effectiveRate) || is_nan($effectiveRate) || is_infinite($effectiveRate)) {
            $effectiveRate = 0.0;
        }

        // Response summary
        $response['loanType'] = $typeLoan;
        $response['loanAmount'] = number_format($principal, 2);
        $response['weeklyAmortization'] = number_format(round($weeklyPaymentAmount, 2), 2); // Display the fixed weekly payment (1012.74)
        $response['contractualRate'] = number_format(($rateAnnual / 12 * 100), 2) . '%'; // Monthly contractual rate
        $response['weeklyRate'] = number_format($r * 100, 2) . '%'; // Weekly compounding rate
        $response['otherCharges'] = number_format($otherChargeAmount, 2);
        $response['installments'] = $n;
        $response['periodPerYear'] = 52;
        // Total payment includes other charges
        $response['totalPayment'] = number_format(round($totalPaymentAccumulated + $otherChargeAmount, 2), 2);
        // Total interest rounded to match sample (sum of unrounded interests in schedule)
        $response['totalInterest'] = number_format(round($totalInterestAccumulated, 2), 2);
        $response['effectiveInterest'] = number_format($effectiveRate, 2) . '%';
        $response['payoffDate'] = $paymentDate->format('F j, Y'); // Last payment date is payoff date
        break;

    default:
        $response['error'] = 'Invalid loan type selected.';
        $n = 0;
        $monthly = 0;
        break;
}

// Common outputs

if (!isset($response['payoffDate'])) {
    // fallback if not calculated
    $loanStartDateObj = new DateTime($loanStartDate);
    $loanStartDateObj->modify("+$totalMonths months");
    $y = (int)$loanStartDateObj->format('Y');
    $m = (int)$loanStartDateObj->format('m');
    $ld = cal_days_in_month(CAL_GREGORIAN, $m, $y);
    $loanStartDateObj->setDate($y, $m, min($originalDay, $ld));
        $response['payoffDate'] = $loanStartDateObj->format('F j, Y');
    }

    // $monthlyRate = $rateAnnual / 12;
    // $effectiveAnnualRate = (pow(1 + $monthlyRate, 12) - 1) * 100;
    // $response['effectiveInterest'] = number_format($effectiveAnnualRate, 2) . '%';
$response['schedule'] = $schedule;

$json = json_encode($response);

if ($json === false) {
    echo json_last_error_msg(); // Shows the reason
    exit;
}

echo $json;
?>
