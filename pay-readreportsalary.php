<?php

try {
include('connection.php');
ini_set('max_execution_time', 0);
ini_set('mysql.connect_timeout', 0);
set_time_limit(0);
ini_set('memory_limit', '-1'); 

$startdate = mysqli_real_escape_string($con, $_POST['startdate']);
$enddate = mysqli_real_escape_string($con, $_POST['enddate']);
$date = mysqli_real_escape_string($con, $_POST['date']);
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$approved = mysqli_real_escape_string($con, $_POST['approved']);
$approve = mysqli_real_escape_string($con, $_POST['approve']);
$status = mysqli_real_escape_string($con, $_POST['status']);
$totalRegularPay = mysqli_real_escape_string($con, $_POST['totalRegularPay']);
$totalNetPay = mysqli_real_escape_string($con, $_POST['totalNetPay']);
$currentUser = strtolower($_SESSION['username'] ?? $_SESSION['fullname'] ?? '');
$canPublish  = !in_array($currentUser, ['mclerigo', 'prmallabo']);

// === FREEZE LOCK ===
$isFrozen    = false;
$isPublished = false;

$lockCheck = mysqli_query($con, "SELECT approved, verified, payslipPublished 
    FROM pay_selecteddate 
    WHERE date = '$date' OR selectedDate = '$date' 
    LIMIT 1");

if ($lockCheck && mysqli_num_rows($lockCheck) > 0) {
    $lockRow = mysqli_fetch_assoc($lockCheck);
    if ($lockRow['approved'] == '1' && $lockRow['verified'] == '1') {
        // ✅ FIX: Before locking to status=1, verify pay_record actually has data.
        // If pay_record is empty for this date, the JS save hasn't run yet.
        // Fall back to status=0 (live calculation) so data is never lost.
        $recordCheck = mysqli_query($con, "SELECT COUNT(*) AS cnt FROM pay_record WHERE date = '$date'");
        $recordRow   = $recordCheck ? mysqli_fetch_assoc($recordCheck) : null;
        $hasRecords  = $recordRow && $recordRow['cnt'] > 0;

        if ($hasRecords) {
            $status   = 1;
            $isFrozen = true;
        }
        // If no records yet, $status stays at whatever was POSTed (0 or ''),
        // and isFrozen stays false — the JS will still save via pay-addrecord.php
        // on this load because approved/approve POSTed params trigger that path.
    }
    $isPublished = isset($lockRow['payslipPublished']) && $lockRow['payslipPublished'] == '1';
}
// === END FREEZE LOCK ===

$day = date("d", strtotime($date));

// ✅ FIX: Keep $branch as the original POST value throughout.
// The old code overwrote $branch inside the while loop with $row['address'],
// which contaminated every subsequent reference to the POST branch filter.
// We now use $empBranch inside the loop for the employee's own branch value.
$postBranch = $branch; // alias so intent is explicit

    if ($status == 0 || $status == '') {
        $sql = "SELECT a.*, phr.*, a.employeeId as acc_employeeId 
            FROM accounts as a
            LEFT JOIN pay_earningshr as phr ON phr.employeeId = a.employeeId 
                AND phr.datedeleted = ''
                AND phr.id = (
                    SELECT MAX(id) 
                    FROM pay_earningshr 
                    WHERE employeeId = a.employeeId 
                    AND datedeleted = ''
                )";

    if (!empty($postBranch)) {
        $sql .= " WHERE a.employeeId != '0' AND a.stats = 0 AND phr.branch = '$postBranch'";
    } else {
        $sql .= " WHERE a.employeeId != '0' AND a.stats = 0";
    }
    $sql .= " GROUP BY a.employeeId";
} else {
    $sql = "SELECT pr.*,acc.*, acc.employeeId as acc_employeeId
    FROM pay_record pr
    LEFT JOIN accounts acc ON pr.employeeId = acc.employeeId ";
   
    if (!empty($postBranch)) {
        $sql .= " WHERE pr.date = '$date' AND acc.address = '$postBranch' AND acc.stats = 0";
    } else{
        $sql .= " WHERE pr.date = '$date' AND acc.stats = 0";
    }
    $sql .= " GROUP BY acc.employeeId";
}

$result = mysqli_query($con, $sql);

// ============================================================
// ✅ ADDITION 1 — Maternity Leave Lookup Map
// ============================================================
$maternityQuery = "SELECT l.employee_Id, l.id AS leave_id, l.dateFrom, l.dateTo
                   FROM leavetbl l
                   WHERE l.iCategory = 'Maternity Leave'
                     AND l.iStatus = 2";
$maternityResult = mysqli_query($con, $maternityQuery);
$maternityMap    = [];

if ($maternityResult && mysqli_num_rows($maternityResult) > 0) {
    while ($matRow = mysqli_fetch_assoc($maternityResult)) {
        $eid = $matRow['employee_Id'];
        if (!isset($maternityMap[$eid]) ||
            $matRow['dateFrom'] > $maternityMap[$eid]['dateFrom']) {
            $maternityMap[$eid] = [
                'leave_id' => $matRow['leave_id'],
                'dateFrom' => $matRow['dateFrom'],
                'dateTo'   => $matRow['dateTo'],
            ];
        }
    }
}

$tbody = "";
$index = 1;

$scriptAlreadyAdded = false;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        if ($status == 0 || $status == '') {

                $monthlySalary = isset($row["MonthlySalary"]) && $row["MonthlySalary"] !== null && $row["MonthlySalary"] !== '' ? $row["MonthlySalary"] : 0;
                $basicPay = number_format($monthlySalary / 2, 2, '.', '');

            // ============================================================
            // ✅ ADDITION 2 — Maternity Leave: Zero out Basic Pay
            // ============================================================
            $currentEmpId         = $row['acc_employeeId'];
            $isOnMaternity        = false;
            $hasApprovedMaternity = false; 

            if (isset($maternityMap[$currentEmpId])) {
                $mat = $maternityMap[$currentEmpId];

                if ($mat['dateFrom'] <= $enddate && $mat['dateTo'] >= $startdate) {
                    $hasApprovedMaternity = true; 

                    $safeDateFrom = mysqli_real_escape_string($con, $mat['dateFrom']);

                    $bioSql = "SELECT MIN(date) AS firstReturn
                            FROM payroll_time
                            WHERE employeeId = '$currentEmpId'
                                AND date BETWEEN '$startdate' AND '$enddate'
                                AND date >= '$safeDateFrom'";
                    $bioResult = mysqli_query($con, $bioSql);
                    $bioRow    = $bioResult ? mysqli_fetch_assoc($bioResult) : null;

                    if ($bioRow && !empty($bioRow['firstReturn'])) {
                        $isOnMaternity = false;
                    } else {
                        $isOnMaternity = true;
                    }
                }
            }

            if ($isOnMaternity) {
                $basicPay = '0.00';
            }
            // ============================================================

            if ($day == 15){
                $riceAllowance = '0.00';
                $sss = '0.00';
                $sssmand = '0.00';
                $pagibig = '0.00';
                $philhealth = '0.00';
            }else{
                $riceAllowance = isset($row['RiceAllowance']) && $row['RiceAllowance'] !== null && $row['RiceAllowance'] !== '' ? $row['RiceAllowance'] : '0.00';
                $sss = isset($row['sss']) && $row['sss'] !== null && $row['sss'] !== '' ? number_format($row['sss'], 2,'.', '') : '0.00';
                $sssmand = isset($row['sssmandprovident']) && $row['sssmandprovident'] !== null && $row['sssmandprovident'] !== '' ? number_format($row['sssmandprovident'], 2,'.', '') : '0.00';
                $pagibig = isset($row['pagibig']) && $row['pagibig'] !== null && $row['pagibig'] !== '' ? number_format($row['pagibig'],2,'.', '') : '0.00';
                $philhealth = isset($row['philhealth']) && $row['philhealth'] !== null && $row['philhealth'] !== '' ? number_format($row['philhealth'],2,'.', '') : '0.00';
            }

            $forTaxSSS = isset($row['sss']) && $row['sss'] !== null && $row['sss'] !== '' ? $row['sss'] : '0';
            $forTaxSSSMand = isset($row['sssmandprovident']) && $row['sssmandprovident'] !== null && $row['sssmandprovident'] !== '' ? $row['sssmandprovident'] : '0';
            $forTaxPagibig = isset($row['pagibig']) && $row['pagibig'] !== null && $row['pagibig'] !== '' ? $row['pagibig'] : '0';
            $forTaxPhilhealth = isset($row['philhealth']) && $row['philhealth'] !== null && $row['philhealth'] !== '' ? $row['philhealth'] : '0';

            $transpoSelect = isset($row['transpoSelect']) && $row['transpoSelect'] !== null ? $row['transpoSelect'] : '';

            if($transpoSelect == "Firstcutoff" && $day == 15){
                $transpoAllowance = isset($row['TranspoAllowance']) && $row['TranspoAllowance'] !== null ? number_format($row['TranspoAllowance'],2,'.', '') : '0.00';
            }else if($transpoSelect == "Lastcutoff" && $day != 15){
                $transpoAllowance = isset($row['TranspoAllowance']) && $row['TranspoAllowance'] !== null ? number_format($row['TranspoAllowance'],2,'.', '') : '0.00';
            }else{
                $transpoAllowance = "0.00";
            }

            $otherAllowSelect = isset($row['otherAllowSelect']) && $row['otherAllowSelect'] !== null ? $row['otherAllowSelect'] : '';

            if($otherAllowSelect == "Firstcutoff" && $day == 15){
                $otherAllow = isset($row['otherAllow']) && $row['otherAllow'] !== null ? number_format($row['otherAllow'],2,'.', '') : '0.00';
            }else if($otherAllowSelect == "Lastcutoff" && $day != 15){
                $otherAllow = isset($row['otherAllow']) && $row['otherAllow'] !== null ? number_format($row['otherAllow'],2,'.', '') : '0.00';
            }else{
                $otherAllow = "0.00";
            }

            if ($isOnMaternity) {
                $sss              = '0.00';
                $sssmand          = '0.00';
                $pagibig          = '0.00';
                $philhealth       = '0.00';
                $transpoAllowance = '0.00';
                $otherAllow       = '0.00';
                $forTaxSSS        = '0';
                $forTaxSSSMand    = '0';
                $forTaxPagibig    = '0';
                $forTaxPhilhealth = '0';
            }

            $empId = $row['acc_employeeId'];
            $name = $row['fullName'];
            // ✅ FIX: Use $empBranch for the employee's own branch — never overwrites $branch/$postBranch
            $empBranch = $row['address'];


            $maternityClass = $isOnMaternity ? ' class="maternity-row"' : '';
            $tbody .= "<tr data-id='".$empId."'".$maternityClass.">";
            $tbody .= "<td>";
            $tbody .= "<span id='eks_$empId' style='margin-right:15px;'><img height='20px' src='statusImage//xmark.png'></span>";
            $tbody .= "<span id='check_$empId' style='margin-right:15px;display:none;'><img height='20px' src='statusImage//check.png'></span>";
            $tbody .= "<span data-id='$empId'>" . $row['acc_employeeId'] . "</span>";
            $tbody .= "</td>";
            $maternityBadge = $isOnMaternity ? ' <span style="background:#e91e63;color:white;font-size:9px;padding:2px 6px;border-radius:10px;font-weight:600;letter-spacing:0.5px;">MATERNITY LEAVE</span>' : '';
            $tbody .= "<td>". $row['fullName'] . $maternityBadge ."</td>";
            $tbody .= "<td>". $row['bankPosition'] ."</td>";
            $tbody .= "<td>". $empBranch ."</td>";
            $tbody .= '<td class="basicpay salary earning' . $index . '" id="salary' . $index . '">'.$basicPay.'</td>';
            $tbody .= '<td class="basicpay rice earning' . $index . '" id="riceallow' . $index . '">'.$riceAllowance.'</td>';
            $transpoTotal = number_format((float)$transpoAllowance + (float)$otherAllow, 2, '.', '');
            $tbody .= '<td class="transpo earning' . $index . '" id="transpoAllow' . $index . '">'.$transpoTotal.'</td>';
            $tbody .= '<td class="ot earning' . $index . '" id="overtimePay' . $index . '"></td>';
            $tbody .= '<td class="otherpay earning' . $index . '" id="otherpay' . $index . '"></td>';
            $tbody .= '<td class="sss deduction' . $index . '" id="sss' . $index . '">'.$sss.'</td>';
            $tbody .= '<td class="sssmand deduction' . $index . '" id="sssmand' . $index . '">'.$sssmand.'</td>';
            $tbody .= '<td class="pagibig deduction' . $index . '" id="pagibig' . $index . '">'.$pagibig.'</td>';
            $tbody .= '<td class="philhealth deduction' . $index . '" id="philhealth' . $index . '">'.$philhealth.'</td>';
            $tbody .= '<td class="sssloan deduction' . $index . '" id="sssloan' . $index . '"></td>';
            $tbody .= '<td class="ssscalamity deduction' . $index . '" id="ssscalamity' . $index . '"></td>';
            $tbody .= '<td class="pagibigloan deduction' . $index . '" id="pagibigloan' . $index . '"></td>';
            $tbody .= '<td class="pagibigcalamity deduction' . $index . '" id="pagibigcalamity' . $index . '"></td>';
            $tbody .= '<td class="emploan deduction' . $index . '" id="employeeloan' . $index . '"></td>';
            $tbody .= '<td class="tax deduction' . $index . '" id="tax' . $index . '"></td>';
            $tbody .= '<td class="absent deduction' . $index . '" id="absent' . $index . '"></td>';
            $tbody .= '<td class="late deduction' . $index . '" id="late' . $index . '"></td>';
            $tbody .= '<td class="otherdeduct deduction' . $index . '" id="otherDeduction' . $index . '"></td>';
            $tbody .= '<td class="earning summary-earning" id="totalearnings' . $index . '"></td>';
            $tbody .= '<td class="deduction summary-deduction" id="totaldeduction' . $index . '"></td>';
            $tbody .= '<td class="' . ($empId != 20 ? 'netpay' : '') . '" id="netpay' . $index . '"></td>';
            $tbody .= "</tr>";
            
            $tbody .= '<input type="hidden" id="forTaxSSS' . $index . '" value="'.$forTaxSSS.'"></input>';
            $tbody .= '<input type="hidden" id="forTaxSSSMand' . $index . '" value="'.$forTaxSSSMand.'"></input>';
            $tbody .= '<input type="hidden" id="forTaxPagibig' . $index . '" value="'.$forTaxPagibig.'"></input>';
            $tbody .= '<input type="hidden" id="forTaxPhilhealth' . $index . '" value="'.$forTaxPhilhealth.'"></input>';
            
            $tbody .= '<input type ="hidden" id="sssEmployer' . $index . '"></input>';
            $tbody .= '<input type ="hidden" id="sssmandEmployer' . $index . '"></input>';
            $tbody .= '<input type ="hidden" id="pagibigEmployer' . $index . '"></input>';
            $tbody .= '<input type ="hidden" id="philhealthEmployer' . $index . '"></input>';
        }else{
            
            // MATERNITY (frozen)
            $currentEmpId         = $row['acc_employeeId'];
            $isOnMaternity        = false;
            $hasApprovedMaternity = false;

            if (isset($maternityMap[$currentEmpId])) {
                $mat = $maternityMap[$currentEmpId];

                if ($mat['dateFrom'] <= $enddate && $mat['dateTo'] >= $startdate) {
                    $hasApprovedMaternity = true;

                    $safeDateFrom = mysqli_real_escape_string($con, $mat['dateFrom']);

                    $bioSql = "SELECT MIN(date) AS firstReturn
                                FROM payroll_time
                                WHERE employeeId = '$currentEmpId'
                                    AND date BETWEEN '$startdate' AND '$enddate'
                                    AND date >= '$safeDateFrom'";
                    $bioResult = mysqli_query($con, $bioSql);
                    $bioRow    = $bioResult ? mysqli_fetch_assoc($bioResult) : null;

                    if ($bioRow && !empty($bioRow['firstReturn'])) {
                        $isOnMaternity = false;
                    } else {
                        $isOnMaternity = true;
                    }
                }
            }

            $empId = $row['acc_employeeId'];
            $basicpay = $row["basicpay"];
            $riceallow = $row["riceallow"];
            $transpo = $row["transpo"];
            $overtime = $row["overtime"];
            $otherpay = $row["otherpay"];
            $sss = $row["sss"];
            $sssmand = $row["sssmand"];
            $pagibig = $row["pagibig"];
            $philhealth = $row["philhealth"];
            $sssloan = $row["sssloan"];
            $ssscalamity = $row["ssscalamity"];
            $pagibigloan = $row["pagibigloan"];
            $pagibigcalamity = $row["pagibigcalamity"];
            $employeeloan = $row["emploan"];
            $withholdingtax = $row["withholdingtax"];
            $absent = $row["absent"];
            $late = $row["late"];
            $otherdeduction = $row["otherdeduction"];
            $totalearning = $row["totalearning"];
            $totaldeduction = $row["totaldeduction"];
            $netsalary = $row["netsalary"];
            $readPayslip = $row["readPayslip"];
            // ✅ FIX: Use $empBranch here too — same reason as status=0 path
            $empBranch = $row['address'];

            $maternityClass = $isOnMaternity ? ' class="maternity-row"' : '';
            $tbody .= "<tr data-id='".$empId."'".$maternityClass.">";
            $tbody .= "<td><span id='eks_$empId' style='margin-right:15px;'><img height='20px'src='statusImage//xmark.png'></img></span>
            <span id='check_$empId' style='margin-right:15px;display:none;'><img height='20px'src='statusImage//check.png'></img></span>". $row['acc_employeeId'] ."</td>";
            $maternityBadge = $isOnMaternity ? ' <span style="background:#e91e63;color:white;font-size:9px;padding:2px 6px;border-radius:10px;font-weight:600;letter-spacing:0.5px;">MATERNITY LEAVE</span>' : '';
            $tbody .= "<td>". $row['fullName'] . $maternityBadge ."</td>";
            $tbody .= "<td>". $row['bankPosition'] ."</td>";
            $tbody .= "<td>". $empBranch ."</td>";
            $tbody .= '<td class="basicpay salary earning' . $index . '" id="salary' . $index . '">'.$basicpay.'</td>';
            $tbody .= '<td class="basicpay rice earning' . $index . '" id="riceallow' . $index . '">'.$riceallow.'</td>';
            $tbody .= '<td class="transpo earning' . $index . '" id="transpoAllow' . $index . '">'.$transpo.'</td>';
            $tbody .= '<td class="ot earning' . $index . '" id="overtimePay' . $index . '">'.$overtime.'</td>';
            $tbody .= '<td class="otherpay earning' . $index . '" id="otherpay' . $index . '">'.$otherpay.'</td>';
            $tbody .= '<td class="sss deduction' . $index . '" id="sss' . $index . '">'.$sss.'</td>';
            $tbody .= '<td class="sssmand deduction' . $index . '" id="sssmand' . $index . '">'.$sssmand.'</td>';
            $tbody .= '<td class="pagibig deduction' . $index . '" id="pagibig' . $index . '">'.$pagibig.'</td>';
            $tbody .= '<td class="philhealth deduction' . $index . '" id="philhealth' . $index . '">'.$philhealth.'</td>';
            $tbody .= '<td class="sssloan deduction' . $index . '" id="sssloan' . $index . '">'.$sssloan.'</td>';
            $tbody .= '<td class="ssscalamity deduction' . $index . '" id="ssscalamity' . $index . '">'.$ssscalamity.'</td>';
            $tbody .= '<td class="pagibigloan deduction' . $index . '" id="pagibigloan' . $index . '">'.$pagibigloan.'</td>';
            $tbody .= '<td class="pagibigcalamity deduction' . $index . '" id="pagibigcalamity' . $index . '">'.$pagibigcalamity.'</td>';
            $tbody .= '<td class="emploan deduction' . $index . '" id="employeeloan' . $index . '">'.$employeeloan.'</td>';
            $tbody .= '<td class="tax deduction' . $index . '" id="tax' . $index . '">'.$withholdingtax.'</td>';
            $tbody .= '<td class="absent deduction' . $index . '" id="absent' . $index . '">'.$absent.'</td>';
            $tbody .= '<td class="late deduction' . $index . '" id="late' . $index . '">'.$late.'</td>';
            $tbody .= '<td class="otherdeduct deduction' . $index . '" id="otherDeduction' . $index . '">'.$otherdeduction.'</td>';
            $tbody .= '<td class="earning" id="totalearnings' . $index . '">'.$totalearning.'</td>';
            $tbody .= '<td class="deduction" id="totaldeduction' . $index . '">'.$totaldeduction.'</td>';
            $tbody .= '<td class="' . ($empId != 20 ? 'netpay' : '') . '" id="netpay' . $index . '">' . $netsalary . '</td>';
            $tbody .= '</tr>';
            $tbody .= '<input type="hidden" id="readPayslip_'.$empId.'" value="'.$readPayslip.'">';
        }

    if(!$scriptAlreadyAdded && ($status == 0 || $status == '')){
        $scriptAlreadyAdded = true;
        
        echo "<script>
        $(document).ready(function () {
            var allRequests = [];
            
            $('tr[data-id]').each(function() {
                var empRow = $(this);
                var empId = empRow.attr('data-id');
                var currentIndex = empRow.find('.basicpay.salary').attr('id').replace('salary', '');
                
                var date = '" . $date . "';
                var startdate = '" . $startdate . "';
                var approved = '" . $approved . "';
                var approve = '" . $approve . "';
                var enddate = '" . $enddate . "';
                var name = empRow.find('td:eq(1)').text();
                var branch = empRow.find('td:eq(3)').text();
                var monthly = parseFloat(empRow.find('#salary' + currentIndex).text().replace(/,/g, '')) * 2;
                var perDay = +monthly / 22; 
                var perHour = perDay / 8;
                var riceallow = empRow.find('#riceallow' + currentIndex).text();
                var sss = empRow.find('#sss' + currentIndex).text();
                var sssmand = empRow.find('#sssmand' + currentIndex).text();
                var pagibig = empRow.find('#pagibig' + currentIndex).text();
                var philhealth = empRow.find('#philhealth' + currentIndex).text();
             
                var forTaxSSS = parseFloat($('#forTaxSSS' + currentIndex).val() || 0);
                var forTaxSSSMand = parseFloat($('#forTaxSSSMand' + currentIndex).val() || 0);
                var forTaxPagibig = parseFloat($('#forTaxPagibig' + currentIndex).val() || 0);
                var forTaxPhilhealth = parseFloat($('#forTaxPhilhealth' + currentIndex).val() || 0);
             
                var dayOfMonth = parseInt(date.split('-')[2]);
            
                const options = { maximumFractionDigits: 2 };
                var requests = [];

                requests.push($.ajax({
                    url: 'payabsent.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var absentpay = perDay * response;
                        var selector = '#absent' + currentIndex;
                        $(selector).text(absentpay == 0 || absentpay == '' ? '0.00' : absentpay.toFixed(2));
                    }
                }));

                requests.push($.ajax({
                    url: 'paylate.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {         
                        var latepay = response * perHour;
                        var selector = '#late' + currentIndex;
                        $(selector).text(latepay == 0 || latepay == '' ? '0.00' : latepay.toFixed(2));
                    }
                }));

                    var otStartDate, otEndDate;

                    if (dayOfMonth == 15) {
                        var currentDate = new Date(date);
                        var currentYear = currentDate.getFullYear();
                        var currentMonth = currentDate.getMonth() + 1;
                        
                        var prevMonth = currentMonth - 1;
                        var prevYear = currentYear;
                        if (prevMonth === 0) {
                            prevMonth = 12;
                            prevYear = currentYear - 1;
                        }
                        
                        otStartDate = prevYear + '-' + String(prevMonth).padStart(2, '0') + '-11';
                        otEndDate = currentYear + '-' + String(currentMonth).padStart(2, '0') + '-10';
                        
                        console.log('OT Period for 15th cutoff: ' + otStartDate + ' to ' + otEndDate);
                    } else {
                        otStartDate = startdate;
                        otEndDate = enddate;
                    }

                requests.push($.ajax({
                    url: 'payovertime.php',
                    type: 'POST',
                    data: { 
                        valmonthly: monthly, 
                        startdateoutput: otStartDate,
                        enddateoutput: otEndDate,
                        empId: empId, 
                        date: date
                    },
                    success: function(responseOT) {   
                        let selector = '#overtimePay' + currentIndex;

                        if (dayOfMonth == 15) {
                            $(selector).text(responseOT == 0 || responseOT == '' ? '0.00' : responseOT);
                        } else {
                            $(selector).text('0.00');
                        }
                        
                        var selectorTax = '#tax' + currentIndex;
                        var withholdingTax = 0;

                        if (dayOfMonth == 15) {
                            
                            var monthlyBasicSalary = parseFloat(monthly);
                            var monthlyOT = parseFloat(responseOT || 0);
                            
                            var absentDeduction = parseFloat($('#absent' + currentIndex).text() || 0);
                            
                            var totalPay = monthlyBasicSalary + monthlyOT - absentDeduction;
                            
                            var sssContribution = forTaxSSS;
                            var sssmandContribution = forTaxSSSMand;
                            var pagibigContribution = forTaxPagibig;
                            var philhealthContribution = forTaxPhilhealth;
                            
                            var totalContributions = sssContribution + sssmandContribution + 
                                                    pagibigContribution + philhealthContribution;
                            
                            var taxableIncome = totalPay - totalContributions;


                            if (taxableIncome <= 0 || isNaN(taxableIncome)) {
                                withholdingTax = 0;
                            }
                            else if (taxableIncome <= 20833) {
                                withholdingTax = 0;
                            } 
                            else if (taxableIncome <= 33333) {
                                withholdingTax = (taxableIncome - 20833) * 0.15;
                            } 
                            else if (taxableIncome <= 66667) {
                                withholdingTax = (taxableIncome - 33333) * 0.20 + 1875;
                            } 
                            else if (taxableIncome <= 166667) {
                                withholdingTax = (taxableIncome - 66667) * 0.25 + 8541.80;
                            } 
                            else if (taxableIncome <= 666667) {
                                withholdingTax = (taxableIncome - 166667) * 0.30 + 33541.80;
                            } 
                            else {
                                withholdingTax = (taxableIncome - 666667) * 0.35 + 183541.80;
                            }

                            if (parseInt(empId) == 56) {
                                withholdingTax = 27488.92;
                            }
                            if (parseInt(empId) == 3) {
                                withholdingTax = 15555.58;
                            }
                            
                            if (withholdingTax < 0) {
                                $(selectorTax).text('0.00');
                            } else {
                                $(selectorTax).text(withholdingTax.toFixed(2));
                            }
                            
                        } else {
                            $(selectorTax).text('0.00');
                        }
                    }
                }));

                    requests.push($.ajax({
                    url: 'payother.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        console.log('Other Pay Response:', response);
                        
                        var selector = '#otherpay' + currentIndex;
                        
                        var cleanResponse = String(response).trim();
                        var value = parseFloat(cleanResponse);
                        
                        if (isNaN(value) || value === 0 || cleanResponse === '' || cleanResponse === '0.00') {
                            $(selector).text('0.00');
                        } else {
                            $(selector).text(cleanResponse);
                        }
                        
                        console.log('Other Pay Value Set:', $(selector).text());
                    },
                    error: function(xhr, status, error) {
                        console.error('Other Pay AJAX Error:', status, error);
                        $('#otherpay' + currentIndex).text('0.00');
                    }
                }));

                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalaryLoan.php',
                    data: {startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    dataType: 'json',
                    success: function(response) {
                        
                        var selectorsssloan = '#sssloan' + currentIndex;
                        var sssloanValue = response.sssloan;
                        $(selectorsssloan).text(
                            (sssloanValue === null || sssloanValue === undefined || sssloanValue === '' || sssloanValue === 0) 
                            ? '0.00' 
                            : parseFloat(sssloanValue).toFixed(2)
                        );
                        
                        var selectorssscalamity = '#ssscalamity' + currentIndex;
                        var ssscalamityValue = response.ssscalamity;
                        $(selectorssscalamity).text(
                            (ssscalamityValue === null || ssscalamityValue === undefined || ssscalamityValue === '' || ssscalamityValue === 0) 
                            ? '0.00' 
                            : parseFloat(ssscalamityValue).toFixed(2)
                        );

                        var selectorpagibigloan = '#pagibigloan' + currentIndex;
                        var pagibigloanValue = response.pagibigloan;
                        $(selectorpagibigloan).text(
                            (pagibigloanValue === null || pagibigloanValue === undefined || pagibigloanValue === '' || pagibigloanValue === 0) 
                            ? '0.00' 
                            : parseFloat(pagibigloanValue).toFixed(2)
                        );

                        var selectorpagibigcalamity = '#pagibigcalamity' + currentIndex;
                        var pagibigcalamityValue = response.pagibigcalamity;
                        $(selectorpagibigcalamity).text(
                            (pagibigcalamityValue === null || pagibigcalamityValue === undefined || pagibigcalamityValue === '' || pagibigcalamityValue === 0) 
                            ? '0.00' 
                            : parseFloat(pagibigcalamityValue).toFixed(2)
                        );

                        var selectorEmployeeLoan = '#employeeloan' + currentIndex;
                        var emploanValue = response.emploan;
                        $(selectorEmployeeLoan).text(
                            (emploanValue === null || emploanValue === undefined || emploanValue === '' || emploanValue === 0) 
                            ? '0.00' 
                            : parseFloat(emploanValue).toFixed(2)
                        );
                                if (empRow.hasClass('maternity-row')) {
                                    $(selectorsssloan).text('0.00');
                                    $(selectorssscalamity).text('0.00');
                                    $(selectorpagibigloan).text('0.00');
                                    $(selectorpagibigcalamity).text('0.00');
                                    $(selectorEmployeeLoan).text('0.00');
                                }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error in slAmortization AJAX call:', errorThrown);
                        $('#sssloan' + currentIndex).text('0.00');
                        $('#ssscalamity' + currentIndex).text('0.00');
                        $('#pagibigloan' + currentIndex).text('0.00');
                        $('#pagibigcalamity' + currentIndex).text('0.00');
                        $('#employeeloan' + currentIndex).text('0.00');
                    }
                }));

                requests.push($.ajax({
                    url: 'paydeduct.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selectorotherDeduct = '#otherDeduction' + currentIndex;
                        $(selectorotherDeduct).text(response === '' || response === '0' ? '0.00' : response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                }));

                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: {
                        data_to_retrieve: 'sssEmployer',
                        startdateoutput: startdate,
                        enddateoutput: enddate,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#sssEmployer' + currentIndex;
                        $(selector).val(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));

                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: {
                        data_to_retrieve: 'sssmandEmployer',
                        startdateoutput: startdate,
                        enddateoutput: enddate,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#sssmandEmployer' + currentIndex;
                       $(selector).val(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: {
                        data_to_retrieve: 'pagibigEmployer',
                        startdateoutput: startdate,
                        enddateoutput: enddate,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#pagibigEmployer' + currentIndex;
                        $(selector).val(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: {
                        data_to_retrieve: 'philhealthEmployer',
                        startdateoutput: startdate,
                        enddateoutput: enddate,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#philhealthEmployer' + currentIndex;
                        $(selector).val(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));

                requests.push($.ajax({
                type: 'POST',
                url: 'pay-salaryrecord.php',
                data: { 
                    data_to_retrieve: 'readPayslip',
                    date: date,
                    empId: empId 
                },
                success: function(response) {
                    if(response == 1){
                        $('#eks_' + empId).css('display','none');
                        $('#check_' + empId).css('display','');
                    } else {
                        $('#eks_' + empId).css('display','');
                        $('#check_' + empId).css('display','none');
                    }
                }
            }));

                allRequests = allRequests.concat(requests);
                
            });
            
            $.when.apply($, allRequests).done(function() {
                setTimeout(function() {
                    calculateTotalDeductionsForAllEmployees();
                }, 500);
            });
            
        });
        
        function calculateTotalDeductionsForAllEmployees() {
            var date = '" . $date . "';
            var startdate = '" . $startdate . "';
            var approved = '" . $approved . "';
            var approve = '" . $approve . "';
            var enddate = '" . $enddate . "';
            
            $('tr[data-id]').each(function() {
                var empRow = $(this);
                var empId = empRow.attr('data-id');
                var currentIndex = empRow.find('.basicpay.salary').attr('id').replace('salary', '');
                
                var selectDeductions = '.deduction' + currentIndex;
                var totalDeductions = 0;
                
                $(selectDeductions).each(function() {
                    var deductionValue = parseFloat($(this).text().replace(/,/g, ''));
                    if (!isNaN(deductionValue)) {
                        totalDeductions += deductionValue;
                    }
                });
        
                var selectorTotalDeductions = '#totaldeduction' + currentIndex;
                $(selectorTotalDeductions).text(addCommasToNumber(totalDeductions.toFixed(2)));
        
                var selectearnings = '.earning' + currentIndex;
                var totalEarning = 0;
        
                $(selectearnings).each(function() {
                    var earningValue = parseFloat($(this).text().replace(/,/g, ''));
                    if (!isNaN(earningValue)) {
                        totalEarning += earningValue;
                    }
                });
        
                var selectorTotalEarnings = '#totalearnings' + currentIndex;
                $(selectorTotalEarnings).text(addCommasToNumber(totalEarning.toFixed(2)));
        
                var selectorNetpay = '#netpay' + currentIndex;
                var totalnetpay = +totalEarning - +totalDeductions;
                $(selectorNetpay).text(addCommasToNumber(totalnetpay.toFixed(2)));
                
                if(approved == 1 || approve == 1){
                    var name = empRow.find('td:eq(1)').text();
                    var branch = empRow.find('td:eq(3)').text();
                    
                    var valselectorbasicpay = $('#salary' + currentIndex).text();
                    var valselectorriceallow = $('#riceallow' + currentIndex).text();
                    var valselectortranspoAllow = $('#transpoAllow' + currentIndex).text();
                    var valselectorotherpay = $('#otherpay' + currentIndex).text();
                    var valselectorovertimePay = $('#overtimePay' + currentIndex).text();
                    var valselectorsss = $('#sss' + currentIndex).text();
                    var valselectorsssmand = $('#sssmand' + currentIndex).text();
                    var valselectorpagibig = $('#pagibig' + currentIndex).text();
                    var valselectorphilhealth= $('#philhealth' + currentIndex).text();
                    var valselectorsssloan= $('#sssloan' + currentIndex).text();
                    var valselectorssscalamity= $('#ssscalamity' + currentIndex).text();
                    var valselectorpagibigloan= $('#pagibigloan' + currentIndex).text();
                    var valselectorpagibigcalamity = $('#pagibigcalamity' + currentIndex).text();
                    var valselectoremployeeloan = $('#employeeloan' + currentIndex).text();
                    var valselectortax = $('#tax' + currentIndex).text();
                    var valselectorabsent = $('#absent' + currentIndex).text();
                    var valselectorlate = $('#late' + currentIndex).text();
                    var valselectorotherDeduction = $('#otherDeduction' + currentIndex).text();
                    var valselectortotalearnings = $('#totalearnings' + currentIndex).text();
                    var valselectortotaldeduction = $('#totaldeduction' + currentIndex).text();
                    var valselectornetpay = $('#netpay' + currentIndex).text();
                    var valselectorsssEmployer = $('#sssEmployer' + currentIndex).val();
                    var valselectorsssmandEmployer = $('#sssmandEmployer' + currentIndex).val();
                    var valselectorpagibigEmployer = $('#pagibigEmployer' + currentIndex).val();
                    var valselectorphilhealthEmployer = $('#philhealthEmployer' + currentIndex).val();
                    
                    $.ajax({
                        url: 'pay-addrecord.php',
                        type: 'POST',
                        data: { 
                            valselectorbasicpay : valselectorbasicpay,
                            valselectorriceallow : valselectorriceallow,
                            valselectortranspoAllow : valselectortranspoAllow,
                            valselectorotherpay : valselectorotherpay,
                            valselectorovertimePay : valselectorovertimePay,
                            valselectorsssmand : valselectorsssmand,
                            valselectorsss : valselectorsss,
                            valselectorpagibig: valselectorpagibig,
                            valselectorphilhealth : valselectorphilhealth,
                            valselectorsssloan : valselectorsssloan,
                            valselectorssscalamity : valselectorssscalamity,
                            valselectorpagibigloan : valselectorpagibigloan,
                            valselectorpagibigcalamity : valselectorpagibigcalamity,
                            valselectoremployeeloan : valselectoremployeeloan,
                            valselectortax : valselectortax,
                            valselectorabsent : valselectorabsent,
                            valselectorlate : valselectorlate,
                            valselectorotherDeduction : valselectorotherDeduction,
                            valselectortotalearnings : valselectortotalearnings,
                            valselectortotaldeduction : valselectortotaldeduction,
                            valselectornetpay : valselectornetpay,
                            valselectorsssEmployer : valselectorsssEmployer,
                            valselectorsssmandEmployer : valselectorsssmandEmployer,
                            valselectorpagibigEmployer : valselectorpagibigEmployer,
                            valselectorphilhealthEmployer : valselectorphilhealthEmployer,
                            empId : empId,
                            name : name,
                            branch : branch,
                            date : date 
                        },
                        success: function(response) {
                           console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                }
                
            });
            
            var totalNetPay = 0;
            $('.netpay').each(function() {
                var netPayText = $(this).text().replace(/,/g, '');
                var netPay = parseFloat(netPayText);
                if (!isNaN(netPay)) {
                    totalNetPay += netPay;
                }
            });
            $('#totalnetpay').text(addCommasToNumber(totalNetPay.toFixed(2)));
            $('#totalNetSalary').text(addCommasToNumber(totalNetPay.toFixed(2)));

            var totalBasicPay = 0;
            $('.basicpay.salary').each(function() {
                var basicpayText = $(this).text().replace(/,/g, '');
                var basicPay = parseFloat(basicpayText);
                 if (!isNaN(basicPay)) {
                    totalBasicPay += basicPay;
                }
            });
            $('#regularPay').text(addCommasToNumber(totalBasicPay.toFixed(2)));   

            localStorage.setItem('totalbasic', totalBasicPay.toFixed(2))
            localStorage.setItem('totalnet', totalNetPay.toFixed(2))

            $.ajax({
                url: 'pay-addnetpay.php',
                type: 'POST',
                data: {totalBasicPay : totalBasicPay.toFixed(2),
                totalNetPay:totalNetPay.toFixed(2),
                date : date },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            var totalsalary = 0;
            $('.salary').each(function() {
                var totalSalaryText = $(this).text().replace(/,/g, '');
                var salary = parseFloat(totalSalaryText);
                if (!isNaN(salary)) {
                    totalsalary += salary;
                }
            });
            $('#totalSalary').text(addCommasToNumber(totalsalary.toFixed(2)));

            var totalrice = 0;
            $('.rice').each(function() {
                var totalricetext = $(this).text().replace(/,/g, '');
                var rice = parseFloat(totalricetext);
                if (!isNaN(rice)) {
                    totalrice += rice;
                }
            });
            $('#totalRice').text(addCommasToNumber(totalrice.toFixed(2)));

            var totaltranspo = 0;
            $('.transpo').each(function() {
                var totaltranspotext = $(this).text().replace(/,/g, '');
                var Transpo = parseFloat(totaltranspotext);
                if (!isNaN(Transpo)) {
                    totaltranspo += Transpo;
                }
            });
            $('#totalTranspo').text(addCommasToNumber(totaltranspo.toFixed(2)));

            var totalot = 0;
            $('.ot').each(function() {
                var totalottext = $(this).text().replace(/,/g, '');
                var OT = parseFloat(totalottext);
                if (!isNaN(OT)) {
                    totalot += OT;
                }
            });
            $('#totalOT').text(addCommasToNumber(totalot.toFixed(2)));

            var totalotherpay = 0;
            $('.otherpay').each(function() {
                var totalotherpaytext = $(this).text().replace(/,/g, '');
                var otherPay = parseFloat(totalotherpaytext);
                if (!isNaN(otherPay)) {
                    totalotherpay += otherPay;
                }
            });
            $('#totalOtherPay').text(addCommasToNumber(totalotherpay.toFixed(2)));

            var totalsss = 0;
            $('.sss').each(function() {
                var totalssstext = $(this).text().replace(/,/g, '');
                var ssspay = parseFloat(totalssstext);
                if (!isNaN(ssspay)) {
                    totalsss += ssspay;
                }
            });
            $('#totalSSS').text(addCommasToNumber(totalsss.toFixed(2)));

            var totalsssmand = 0;
            $('.sssmand').each(function() {
                var totalsssmandtext = $(this).text().replace(/,/g, '');
                var sssmandpay = parseFloat(totalsssmandtext);
                if (!isNaN(sssmandpay)) {
                    totalsssmand += sssmandpay;
                }
            });
            $('#totalSSSMand').text(addCommasToNumber(totalsssmand.toFixed(2)));

            var totalpagibig = 0;
            $('.pagibig').each(function() {
                var totalpagibigtext = $(this).text().replace(/,/g, '');
                var pagibigpay = parseFloat(totalpagibigtext);
                if (!isNaN(pagibigpay)) {
                    totalpagibig += pagibigpay;
                }
            });
            $('#totalPagibig').text(addCommasToNumber(totalpagibig.toFixed(2)));

            var totalphilhealth = 0;
            $('.philhealth').each(function() {
                var totalphilhealthtext = $(this).text().replace(/,/g, '');
                var philhealthpay = parseFloat(totalphilhealthtext);
                if (!isNaN(philhealthpay)) {
                    totalphilhealth += philhealthpay;
                }
            });
            $('#totalPhilhealth').text(addCommasToNumber(totalphilhealth.toFixed(2)));

            var totalsssloan = 0;
            $('.sssloan').each(function() {
                var totalsssloantext = $(this).text().replace(/,/g, '');
                var sssloanpay = parseFloat(totalsssloantext);
                if (!isNaN(sssloanpay)) {
                    totalsssloan += sssloanpay;
                }
            });
            $('#totalSSSLoan').text(addCommasToNumber(totalsssloan.toFixed(2)));

            var totalssscalamity = 0;
            $('.ssscalamity').each(function() {
                var totalssscalamitytext = $(this).text().replace(/,/g, '');
                var ssscalamitypay = parseFloat(totalssscalamitytext);
                if (!isNaN(ssscalamitypay)) {
                    totalssscalamity += ssscalamitypay;
                }
            });
            
            $('#totalSSSCalamity').text(addCommasToNumber(totalssscalamity.toFixed(2)));

            var totalpagibigloan = 0;
            $('.pagibigloan').each(function() {
                var totalpagibigloantext = $(this).text().replace(/,/g, '');
                var pagibigloanpay = parseFloat(totalpagibigloantext);
                if (!isNaN(pagibigloanpay)) {
                    totalpagibigloan += pagibigloanpay;
                }
            });
            $('#totalPagibigLoan').text(addCommasToNumber(totalpagibigloan.toFixed(2)));

            var totalpagibigcalamity = 0;
            $('.pagibigcalamity').each(function() {
                var totalpagibigcalamitytext = $(this).text().replace(/,/g, '');
                var pagibigcalamitypay = parseFloat(totalpagibigcalamitytext);
                if (!isNaN(pagibigcalamitypay)) {
                    totalpagibigcalamity += pagibigcalamitypay;
                }
            });
            $('#totalPagibigCalamity').text(addCommasToNumber(totalpagibigcalamity.toFixed(2)));

            var totalemploan = 0;
            $('.emploan').each(function() {
                var totalemploantext = $(this).text().replace(/,/g, '');
                var emploanpay = parseFloat(totalemploantext);
                if (!isNaN(emploanpay)) {
                    totalemploan += emploanpay;
                }
            });
            $('#totalEmpLoan').text(addCommasToNumber(totalemploan.toFixed(2)));

            var totalTax = 0;
            $('.tax').each(function() {
                var totalTaxtext = $(this).text().replace(/,/g, '');
                var Taxpay = parseFloat(totalTaxtext);
                if (!isNaN(Taxpay)) {
                    totalTax += Taxpay;
                }
            });
            $('#totalTax').text(addCommasToNumber(totalTax.toFixed(2)));

            var totalAbsent = 0;
            $('.absent').each(function() {
                var totalAbsenttext = $(this).text().replace(/,/g, '');
                var Absentpay = parseFloat(totalAbsenttext);
                if (!isNaN(Absentpay)) {
                    totalAbsent += Absentpay;
                }
            });
            $('#totalAbsent').text(addCommasToNumber(totalAbsent.toFixed(2)));

            var totalLate = 0;
            $('.late').each(function() {
                var totalLatetext = $(this).text().replace(/,/g, '');
                var Latepay = parseFloat(totalLatetext);
                if (!isNaN(Latepay)) {
                    totalLate += Latepay;
                }
            });
            $('#totalLate').text(addCommasToNumber(totalLate.toFixed(2)));

            var totalOtherdeduct = 0;
            $('.otherdeduct').each(function() {
                var totalOtherdeducttext = $(this).text().replace(/,/g, '');
                var Otherdeductpay = parseFloat(totalOtherdeducttext);
                if (!isNaN(Otherdeductpay)) {
                    totalOtherdeduct += Otherdeductpay;
                }
            });
            $('#totalOtherDeduction').text(addCommasToNumber(totalOtherdeduct.toFixed(2)));

            var totalearning = 0;
            $('.earning').each(function() {
                var totalearningtext = $(this).text().replace(/,/g, '');
                var earningpay = parseFloat(totalearningtext);
                if (!isNaN(earningpay)) {
                    totalearning += earningpay;
                }
            });
            $('#totalEarning').text(addCommasToNumber(totalearning.toFixed(2)));

            var totaldeduction = 0;
            $('.deduction').each(function() {
                var totaldeductiontext = $(this).text().replace(/,/g, '');
                var deductionpay = parseFloat(totaldeductiontext);
                if (!isNaN(deductionpay)) {
                    totaldeduction += deductionpay;
                }
            });
            $('#totalDeductions').text(addCommasToNumber(totaldeduction.toFixed(2)));
        }
        
        function addCommasToNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, \",\");
        }
        </script>";
    }
    
    if(!$scriptAlreadyAdded && ($status != 0 && $status != '')){
        $scriptAlreadyAdded = true;
        
        echo "<script>
                $(document).ready(function () {
                    var date = '" . $date . "';
                    var totalRegularPay = '$totalRegularPay';
                    var totalNetPay = '$totalNetPay';
        
                    $('tr[data-id]').each(function() {
                        var empRow = $(this);
                        var empId = empRow.attr('data-id');
                        var currentIndex = empRow.find('.basicpay.salary').attr('id').replace('salary', '');
                        var readPayslip = $('#readPayslip_' + empId).val();
                        
                        if(readPayslip == 1){
                            $('#eks_' + empId).css('display','none');
                            $('#check_' + empId).css('display','');
                        } else {
                            $('#eks_' + empId).css('display','');
                            $('#check_' + empId).css('display','none');
                        }
                    });
                        
                    $('#regularPay').text(totalRegularPay);
                
                    var totalSalary = 0;
                    $('.salary').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalSalary += val;
                    });
                    $('#totalSalary').text(addCommasToNumber(totalSalary.toFixed(2)));

                    var totalRice = 0;
                    $('.rice').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalRice += val;
                    });
                    $('#totalRice').text(addCommasToNumber(totalRice.toFixed(2)));

                    var totalTranspo = 0;
                    $('.transpo').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalTranspo += val;
                    });
                    $('#totalTranspo').text(addCommasToNumber(totalTranspo.toFixed(2)));

                    var totalOT = 0;
                    $('.ot').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalOT += val;
                    });
                    $('#totalOT').text(addCommasToNumber(totalOT.toFixed(2)));

                    var totalOtherPay = 0;
                    $('.otherpay').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalOtherPay += val;
                    });
                    $('#totalOtherPay').text(addCommasToNumber(totalOtherPay.toFixed(2)));

                    var totalSSS = 0;
                    $('.sss').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalSSS += val;
                    });
                    $('#totalSSS').text(addCommasToNumber(totalSSS.toFixed(2)));

                    var totalSSSMand = 0;
                    $('.sssmand').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalSSSMand += val;
                    });
                    $('#totalSSSMand').text(addCommasToNumber(totalSSSMand.toFixed(2)));

                    var totalPagibig = 0;
                    $('.pagibig').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalPagibig += val;
                    });
                    $('#totalPagibig').text(addCommasToNumber(totalPagibig.toFixed(2)));

                    var totalPhilhealth = 0;
                    $('.philhealth').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalPhilhealth += val;
                    });
                    $('#totalPhilhealth').text(addCommasToNumber(totalPhilhealth.toFixed(2)));

                    var totalSSSLoan = 0;
                    $('.sssloan').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalSSSLoan += val;
                    });
                    $('#totalSSSLoan').text(addCommasToNumber(totalSSSLoan.toFixed(2)));

                    var totalSSSCalamity = 0;
                    $('.ssscalamity').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalSSSCalamity += val;
                    });
                    $('#totalSSSCalamity').text(addCommasToNumber(totalSSSCalamity.toFixed(2)));

                    var totalPagibigLoan = 0;
                    $('.pagibigloan').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalPagibigLoan += val;
                    });
                    $('#totalPagibigLoan').text(addCommasToNumber(totalPagibigLoan.toFixed(2)));

                    var totalPagibigCalamity = 0;
                    $('.pagibigcalamity').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalPagibigCalamity += val;
                    });
                    $('#totalPagibigCalamity').text(addCommasToNumber(totalPagibigCalamity.toFixed(2)));

                    var totalEmpLoan = 0;
                    $('.emploan').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalEmpLoan += val;
                    });
                    $('#totalEmpLoan').text(addCommasToNumber(totalEmpLoan.toFixed(2)));

                    var totalTax = 0;
                    $('.tax').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalTax += val;
                    });
                    $('#totalTax').text(addCommasToNumber(totalTax.toFixed(2)));

                    var totalAbsent = 0;
                    $('.absent').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalAbsent += val;
                    });
                    $('#totalAbsent').text(addCommasToNumber(totalAbsent.toFixed(2)));

                    var totalLate = 0;
                    $('.late').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalLate += val;
                    });
                    $('#totalLate').text(addCommasToNumber(totalLate.toFixed(2)));

                    var totalOtherDeduction = 0;
                    $('.otherdeduct').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalOtherDeduction += val;
                    });
                    $('#totalOtherDeduction').text(addCommasToNumber(totalOtherDeduction.toFixed(2)));

                    var totalEarning = 0;
                    $('.earning').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalEarning += val;
                    });
                    $('#totalEarning').text(addCommasToNumber(totalEarning.toFixed(2)));

                    var totalDeduction = 0;
                    $('.deduction').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalDeduction += val;
                    });
                    $('#totalDeductions').text(addCommasToNumber(totalDeduction.toFixed(2)));
                
                    var totalBasicPay = 0;
                    $('.basicpay.salary').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalBasicPay += val;
                    });
                    $('#regularPay').text(addCommasToNumber(totalBasicPay.toFixed(2)));

                    var totalNetPay = 0;
                    $('.netpay').each(function() {
                        var val = parseFloat($(this).text().replace(/,/g, ''));
                        if (!isNaN(val)) totalNetPay += val;
                    });
                    $('#totalnetpay').text(addCommasToNumber(totalNetPay.toFixed(2)));
                    $('#totalNetSalary').text(addCommasToNumber(totalNetPay.toFixed(2)));
                });

                function addCommasToNumber(number) {
                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, \",\");
                }
                </script>";
    }

    $index++;
    }
} else {
    $tbody = "<tr><td colspan='25'>No records found</td></tr>";
}
} catch (Exception $e) {
    echo 'General error: ' . $e->getMessage();
}
?>
<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
<section class="leaveReport">
    <div id="printable-area">

        <div id="table-container" class="responsive-table" style="margin-top:20px;">
            <table id="reporttbl" ...>
              <thead>
                <tr>
                    <th colspan="4" style="background:#e8e6df;color:#5F5E5A;text-align:center;font-size:10px;letter-spacing:0.4px;text-transform:uppercase;">Employee Info</th>
                    <th colspan="5" style="background:#d6ede3;color:#085041;text-align:center;font-size:10px;letter-spacing:0.4px;text-transform:uppercase;">Earnings</th>
                    <th colspan="13" style="background:#f5dede;color:#791F1F;text-align:center;font-size:10px;letter-spacing:0.4px;text-transform:uppercase;">Deductions</th>
                    <th colspan="3" style="background:#d4e8f5;color:#0C447C;text-align:center;font-size:10px;letter-spacing:0.4px;text-transform:uppercase;">Summary</th>
                </tr>
                <tr>
                    <th class="h-info">Emp. ID</th>
                    <th class="h-info">Name</th>
                    <th class="h-info">Position</th>
                    <th class="h-info">Branch</th>
                    <th class="h-earn">Basic Salary</th>
                    <th class="h-earn">Rice Allowance</th>
                    <th class="h-earn">Transpo. Allowance</th>
                    <th class="h-earn">Overtime Pay</th>
                    <th class="h-earn">Other Pay</th>
                    <th class="h-deduct">SSS</th>
                    <th class="h-deduct">SSS Mand. Provident</th>
                    <th class="h-deduct">Pag-ibig</th>
                    <th class="h-deduct">Philhealth</th>
                    <th class="h-deduct">SSS Loan</th>
                    <th class="h-deduct">SSS Calamity</th>
                    <th class="h-deduct">Pagibig Loan</th>
                    <th class="h-deduct">Pagibig Calamity</th>
                    <th class="h-deduct">Emp. Loan</th>
                    <th class="h-deduct">Withholding Tax</th>
                    <th class="h-deduct">Absent</th>
                    <th class="h-deduct">Late</th>
                    <th class="h-deduct">Other Deduction</th>
                    <th class="h-total">Total Earning</th>
                    <th class="h-total">Total Deductions</th>
                    <th class="h-total">Net Salary</th>
                </tr>
                </thead>
              <tbody>
                <?php echo $tbody ?>
                <tr>
                    <td class="text-center bg-dark text-white" colspan="4"><strong>TOTAL</strong></td>
                    <td id="totalSalary"></td>
                    <td id="totalRice"></td>
                    <td id="totalTranspo"></td>
                    <td id="totalOT"></td>
                    <td id="totalOtherPay"></td>
                    <td id="totalSSS"></td>
                    <td id="totalSSSMand"></td>
                    <td id="totalPagibig"></td>
                    <td id="totalPhilhealth"></td>
                    <td id="totalSSSLoan"></td>
                    <td id="totalSSSCalamity"></td>
                    <td id="totalPagibigLoan"></td>
                    <td id="totalPagibigCalamity"></td>
                    <td id="totalEmpLoan"></td>
                    <td id="totalTax"></td>
                    <td id="totalAbsent"></td>
                    <td id="totalLate"></td>
                    <td id="totalOtherDeduction"></td>
                    <td id="totalEarning"></td>
                    <td id="totalDeductions"></td>
                    <td id="totalNetSalary"></td>
                </tr>
              </tbody>
            </table>
</div>
<div class="m-2 d-flex flex-column">
    <div>
        <span ><strong>TOTAL BASIC SALARY: </strong></span>
        <span id="regularPay"></span>
    </div>
    <div>
        <span><strong>TOTAL NET SALARY: </strong></span>
        <span id="totalnetpay"></span>
    </div>
</div>

<div class="m-2 d-flex justify-content-between align-items-center flex-wrap" style="gap:8px;">

    <?php if ($isFrozen && $canPublish): ?>
    <div style="display:flex;align-items:center;gap:10px;">
        <span id="publishStatusBadge" style="
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 16px;border-radius:8px;font-size:13px;font-weight:500;
            <?= $isPublished 
                ? 'background:#e4f2eb;color:#085041;border:1.5px solid #a8d8bc;' 
                : 'background:#ddeef8;color:#0C447C;border:1.5px solid #a8cce8;' ?>">
            <?= $isPublished ? '✓ Payslip Published' : '⏸ Payslip Not Yet Published' ?>
        </span>
        <button id="publishBtn" onclick="handlePublish('publish')"
            style="display:<?= $isPublished ? 'none' : 'inline-block' ?>;
                   padding:10px 22px;background:#085041;color:white;
                   border:none;border-radius:8px;cursor:pointer;font-size:13px;
                   font-weight:500;letter-spacing:0.3px;transition:background 0.2s;"
            onmouseover="this.style.background='#0F6E56';"
            onmouseout="this.style.background='#085041';">
            ↑ Upload Payslip
        </button>
        <button id="unpublishBtn" onclick="handlePublish('unpublish')"
            style="display:<?= $isPublished ? 'inline-block' : 'none' ?>;
                   padding:8px 16px;background:white;color:#791F1F;
                   border:1.5px solid #f0b8b8;border-radius:8px;cursor:pointer;font-size:12px;
                   font-weight:500;">
            Unpublish
        </button>
    </div>
    <?php elseif ($isFrozen): ?>
    <span id="publishStatusBadge" style="
        display:inline-flex;align-items:center;gap:6px;
        padding:8px 16px;border-radius:8px;font-size:13px;font-weight:500;
        <?= $isPublished 
            ? 'background:#e4f2eb;color:#085041;border:1.5px solid #a8d8bc;' 
            : 'background:#ddeef8;color:#0C447C;border:1.5px solid #a8cce8;' ?>">
        <?= $isPublished ? '✓ Payslip Published' : '⏸ Payslip Not Yet Published' ?>
    </span>
    <?php elseif ($canPublish): ?>
    <span style="padding:8px 16px;background:#f1f0ec;color:#888780;
        border:1px solid #D3D1C7;border-radius:8px;font-size:12px;">
        Payslip upload available after Approve + Verify
    </span>
    <?php endif; ?>

    <div style="display:flex;gap:8px;">
        <button class="print-btn" onclick="printPayrollTable()"
            style="
                padding:10px 20px;
                background:white;color:#737476;
                border:1.5px solid #737476;
                border-radius:8px;cursor:pointer;
                font-weight:500;font-size:13px;letter-spacing:0.5px;
                transition:all 0.2s ease;"
            onmouseover="this.style.background='#737476';this.style.color='white';"
            onmouseout="this.style.background='white';this.style.color='#737476';">
            🖨️ Save / Print as PDF
        </button>
        <button onclick="exportToCSV()"
            style="
                padding:10px 20px;
                background:white;color:#085041;
                border:1.5px solid #085041;
                border-radius:8px;cursor:pointer;
                font-weight:500;font-size:13px;letter-spacing:0.5px;
                transition:all 0.2s ease;"
            onmouseover="this.style.background='#085041';this.style.color='white';"
            onmouseout="this.style.background='white';this.style.color='#085041';">
            ⬇ Export as CSV
        </button>
    </div>
 
</div>

    <span style="display:none;" class="loader"></span>

</section>


<script>
    function printPayrollTable() {
    var container = document.getElementById('table-container');
    var originalOverflowX = container.style.overflowX;
    var originalOverflowY = container.style.overflowY;
    var originalMaxHeight = container.style.maxHeight;

    container.style.overflowX = 'visible';
    container.style.overflowY = 'visible';
    container.style.maxHeight = 'none';

    window.print();

    setTimeout(function() {
        container.style.overflowX = originalOverflowX;
        container.style.overflowY = originalOverflowY;
        container.style.maxHeight = originalMaxHeight;
    }, 1000);
}

    
</script>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {
    var tr = document.querySelector('tr[data-id="20"]');

    if (tr) {
        tr.style.backgroundColor = 'lightblue';

        var tds = tr.querySelectorAll('td');

        tds.forEach(function(td) {
            td.classList.remove('netpay');
        });
    }
});


function addCommasToNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
</script>

<script>
function handlePublish(action) {
    var date     = '<?php echo $date; ?>';
    var btnId    = action === 'publish' ? '#publishBtn' : '#unpublishBtn';
    var label    = action === 'publish' ? '↑ Upload Payslip' : 'Unpublish';
    var loading  = action === 'publish' ? 'Uploading...' : 'Removing...';
    var confirmMsg = action === 'publish'
        ? 'Upload this payroll to employee payslips? Employees will be able to see their payslip once uploaded.'
        : 'Remove payslip visibility from employees?';
 
    if (!confirm(confirmMsg)) return;
 
    $(btnId).text(loading).prop('disabled', true);
 
    $.ajax({
        url:  'pay-publishpayslip.php',
        type: 'POST',
        dataType: 'json',
        data: { date: date, action: action },
        success: function(response) {
            if (response.success) {
                if (action === 'publish') {
                    $('#publishStatusBadge').css({
                        'background': '#e4f2eb',
                        'color': '#085041',
                        'border': '1.5px solid #a8d8bc'
                    }).text('✓ Payslip Published');
                    $('#publishBtn').hide();
                    $('#unpublishBtn').show();
                } else {
                    $('#publishStatusBadge').css({
                        'background': '#ddeef8',
                        'color': '#0C447C',
                        'border': '1.5px solid #a8cce8'
                    }).text('⏸ Payslip Not Yet Published');
                    $('#unpublishBtn').hide();
                    $('#publishBtn').show();
                }
            } else {
                alert('Error: ' + response.message);
                $(btnId).text(label).prop('disabled', false);
            }
        },
        error: function(xhr, status, error) {
            console.error('Publish AJAX error:', status, error);
            alert('Request failed. Please try again.');
            $(btnId).text(label).prop('disabled', false);
        }
    });
}

    function exportToCSV() {
            var rows = [];

            // Header row
            var headers = [];
            headers.push('Acknowledged');
            $('#reporttbl thead tr:last-child th').each(function() {
                headers.push('"' + $(this).text().trim().replace(/"/g, '""') + '"');
            });
            rows.push(headers.join(','));

            // Data rows — skip the TOTAL row (last tr in tbody)
            var $dataRows = $('#reporttbl tbody tr[data-id]');

            $dataRows.each(function() {
                var empId  = $(this).attr('data-id');
                var isAcknowledged = $('#check_' + empId).is(':visible') ? 'Acknowledged' : 'Not Acknowledged';

                var cols = [];
                cols.push('"' + isAcknowledged + '"');

                $(this).find('td').each(function() {
                    var val = $(this).text().trim().replace(/"/g, '""');
                    // Strip maternity badge text if present
                    val = val.replace('MATERNITY LEAVE', '').trim();
                    cols.push('"' + val + '"');
                });

                rows.push(cols.join(','));
            });

            var csvContent = rows.join('\n');
            var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            var url  = URL.createObjectURL(blob);

            var a = document.createElement('a');
            a.href     = url;
            a.download = 'payroll_' + '<?php echo $date; ?>' + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }
        
</script>

<style>
    th { text-align: center !important; }
    .dtr-control { width: 80px; text-align: right; }
    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate,
    .dataTables_paging,
    .dataTables_search { display: none; }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
        zoom: 60%;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    #table-container {
        overflow-x: auto;
        max-width: 100%;
        max-height: 610px;
        overflow-y: auto;
        position: relative;
    }

    #reporttbl thead th.h-info {
        background-color: #f1f0ec;
        color: #5F5E5A;
    }
    #reporttbl thead th.h-earn {
        background-color: #e4f2eb;
        color: #085041;
    }
    #reporttbl thead th.h-deduct {
        background-color: #faeaea;
        color: #791F1F;
    }
    #reporttbl thead th.h-total {
        background-color: #ddeef8;
        color: #0C447C;
    }
    #reporttbl thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 2px -1px rgba(0,0,0,0.08);
        font-weight: 500;
        font-size: 11px;
        text-align: center !important;
    }
    #reporttbl thead tr:first-child th {
        top: 0;
        z-index: 11;
    }
    #reporttbl thead tr:last-child th {
        top: 29px;
    }

    #reporttbl tbody tr:nth-child(odd) td  { background-color: #fafafa; }
    #reporttbl tbody tr:nth-child(even) td { background-color: #ffffff; }
    #reporttbl tbody tr:hover td           { background-color: #e8f5ee !important; transition: background-color 0.15s ease; }

    #reporttbl tbody tr:last-child    { background-color: #eeece6 !important; font-weight: 600; }
    #reporttbl tbody tr:last-child td { color: #2C2C2A !important; background-color: #eeece6 !important; }

    tr[data-id="20"]       { background-color: #d1ecf1 !important; border-left: 3px solid #17a2b8; }
    tr[data-id="20"]:hover { background-color: #bee5eb !important; }

    #reporttbl tbody td:first-child,
    #reporttbl thead th:first-child {
        position: sticky;
        left: 0;
        z-index: 9;
        border-right: 2px solid #dee2e6;
    }
    #reporttbl tbody tr:nth-child(odd)  td:first-child { background-color: #fafafa; }
    #reporttbl tbody tr:nth-child(even) td:first-child { background-color: #ffffff; }
    #reporttbl thead th:first-child {
        background-color: #e8e6df;
        color: #5F5E5A;
        z-index: 12;
    }

    #reporttbl th,
    #reporttbl td {
        padding: 9px 11px;
        border: 1px solid #dee2e6;
    }

    #reporttbl tbody tr.maternity-row td         { background-color: #fce4ec !important; color: #880e4f; font-weight: 600; }
    #reporttbl tbody tr.maternity-row            { border-left: 4px solid #e91e63; }
    #reporttbl tbody tr.maternity-row:hover td   { background-color: #f8bbd0 !important; }

    @media print {
        body * { visibility: hidden; }
        #printable-area, #printable-area * { visibility: visible; }
        #printable-area { position: absolute; top: 0; left: 0; width: 100%; }
        .print-btn { display: none !important; }
        #table-container { overflow: visible !important; max-height: none !important; max-width: none !important; }
        table { zoom: 100% !important; width: 100% !important; font-size: 10px !important; table-layout: auto !important; }
        th, td { padding: 4px 5px !important; font-size: 10px !important; white-space: nowrap; }
        #reporttbl thead th,
        #reporttbl tbody td:first-child,
        #reporttbl thead th:first-child { position: static !important; box-shadow: none !important; }
        @page { size: A4 landscape; margin: 4mm; }
        #reporttbl tbody tr:nth-child(odd),
        #reporttbl tbody tr:nth-child(even) { background-color: white !important; }
        #reporttbl tbody tr:last-child    { background-color: #ccc !important; color: black !important; }
        #reporttbl tbody tr:last-child td { color: black !important; }
        .slip { border: 1px dashed !important; }
    }

    @media (min-resolution: 120dpi) and (max-resolution: 143dpi) { body { zoom: 90%; } }
    @media (min-resolution: 144dpi) and (max-resolution: 167dpi) { body { zoom: 70%; } }
    @media (min-resolution: 168dpi) and (max-resolution: 191dpi) { body { zoom: 65%; } }
    @media (min-resolution: 192dpi) and (max-resolution: 239dpi) { body { zoom: 55%; } }
    @media (min-resolution: 240dpi) and (max-resolution: 299dpi) { body { zoom: 45%; } }
    @media (min-resolution: 300dpi) and (max-resolution: 399dpi) { body { zoom: 45%; } }
    @media (min-resolution: 400dpi) and (max-resolution: 499dpi) { body { zoom: 30%; } }
    @media (min-resolution: 500dpi)                               { body { zoom: 25%; } }
    
    #payrollTable {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #payrollTable tbody tr:nth-child(even) {
        background-color: #fcfcfc;
    }

    #payrollTable tbody tr:hover {
        background-color: #f1f4f9;
    }

    #payrollTable td, #payrollTable th {
        padding: 12px 8px;
        border-bottom: 1px solid #eee;
        text-align: right;
    }

    #payrollTable td:nth-child(1), 
    #payrollTable td:nth-child(2) {
        text-align: left;
    }

    #payrollTable thead th {
        position: sticky;
        top: 0;
        background-color: #003366;
        color: white;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    #reporttbl tbody td:nth-child(-n+4)     { color: #5F5E5A; }
    #reporttbl tbody td[class*="earning"]   { color: #0da51f; }
    #reporttbl tbody td[class*="deduction"] { color: #ff0101; }
    #reporttbl tbody td:nth-last-child(-n+3){ color: #0C447C; }

    #reporttbl tbody td.summary-earning { color: #0da51f !important; }
    #reporttbl tbody td.summary-deduction { color: #ff0101 !important; }
</style>