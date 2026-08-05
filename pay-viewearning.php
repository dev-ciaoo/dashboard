<?php
include('connection.php'); // Make sure the database connection is properly included
$emptyDate = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];



    try {
        $sql = "SELECT pe.*, acc.*, ploan.* 
        FROM accounts acc 
        LEFT JOIN pay_earningshr pe ON pe.employeeID = acc.employeeID AND pe.datedeleted = ''
        LEFT JOIN pay_earningsloan ploan ON acc.employeeID = ploan.employeeID AND ploan.datedeleted = ''
        WHERE acc.employeeID = ? AND (pe.datedeleted = '' OR ploan.datedeleted = '') ";
        $stmt = mysqli_prepare($con, $sql);
        // UPDATED SQL QUERY - Shows both active loans AND loans paid in current session
// $sql = "SELECT a.*, e.*, l.* FROM accounts AS a
//         LEFT JOIN empinfo AS e ON e.empId = a.employeeId
//         LEFT JOIN pay_earningsloan AS l ON l.employeeId = a.employeeId 
//         AND (l.paid = '0' OR (l.paid = '1' AND l.datemodified = CURDATE()))
//         WHERE a.employeeId = '$id'
//         ORDER BY l.datemodified DESC, l.id DESC
//         LIMIT 1";

        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            $name = htmlspecialchars($row['fullName']);
            $position = htmlspecialchars($row['bankPosition']);
            $branch = htmlspecialchars($row['address']);
            $monthlyRate = htmlspecialchars($row['MonthlySalary']);
            $riceAllowance = htmlspecialchars($row['RiceAllowance']);
            $transpoAllowance = htmlspecialchars($row['TranspoAllowance']); 
            $transpoSelect = htmlspecialchars($row['transpoSelect']); 
            $sss = htmlspecialchars($row['sss']);
            $sssmand = htmlspecialchars($row['sssmandprovident']);
            $pagibig = htmlspecialchars($row['pagibig']);
            $philhealth = htmlspecialchars($row['philhealth']);
            $specialAllow = htmlspecialchars($row['specialAllow']);
            $otherAllow = htmlspecialchars($row['otherAllow']);
            $otherAllowSelect = htmlspecialchars($row['otherAllowSelect']);
            $sssEmployer = htmlspecialchars($row['sssEmployer']);
            $sssmandEmployer = htmlspecialchars($row['sssmandEmployer']);
            $pagibigEmployer = htmlspecialchars($row['pagibigEmployer']);
            $philhealthEmployer = htmlspecialchars($row['philhealthEmployer']);

            $sssloan = htmlspecialchars($row['sssloan']);
            $sssloanFirst = htmlspecialchars($row['sssloanFirst']);
            $sssloanLast = htmlspecialchars($row['sssloanLast']);
            $sssloanDate = htmlspecialchars($row['sssloanDate']);
            $sssloanDuedate = htmlspecialchars($row['sssloanDuedate']);
            $sssloanPayment = htmlspecialchars($row['sssloanPayment']);
            $sssloanCutoffSelect = htmlspecialchars($row['sssloanCutoffSelect']);

            $ssscalamity = htmlspecialchars($row['ssscalamity']);
            $ssscalamityFirst = htmlspecialchars($row['ssscalamityFirst']);
            $ssscalamityLast = htmlspecialchars($row['ssscalamityLast']);
            $ssscalamityDate = htmlspecialchars($row['ssscalamityDate']);
            $ssscalamityDuedate = htmlspecialchars($row['ssscalamityDuedate']);
            $ssscalamityPayment = htmlspecialchars($row['ssscalamityPayment']);
            $ssscalamityCutoffSelect = htmlspecialchars($row['ssscalamityCutoffSelect']);

            $pagibigloan = htmlspecialchars($row['pagibigloan']);
            $pagibigloanFirst = htmlspecialchars($row['pagibigloanFirst']);
            $pagibigloanLast = htmlspecialchars($row['pagibigloanLast']);
            $pagibigloanDate = htmlspecialchars($row['pagibigloanDate']);
            $pagibigloanDuedate = htmlspecialchars($row['pagibigloanDuedate']);
            $pagibigloanPayment = htmlspecialchars($row['pagibigloanPayment']);
            $pagibigloanCutoffSelect = htmlspecialchars($row['pagibigloanCutoffSelect']);

            $pagibigcalamity = htmlspecialchars($row['pagibigcalamity']);
            $pagibigcalamityFirst = htmlspecialchars($row['pagibigcalamityFirst']);
            $pagibigcalamityLast = htmlspecialchars($row['pagibigcalamityLast']);
            $pagibigcalamityDate = htmlspecialchars($row['pagibigcalamityDate']);
            $pagibigcalamityDuedate = htmlspecialchars($row['pagibigcalamityDuedate']);
            $pagibigcalamityPayment = htmlspecialchars($row['pagibigcalamityPayment']);
            $pagibigcalamityCutoffSelect = htmlspecialchars($row['pagibigcalamityCutoffSelect']);


            $tax = htmlspecialchars($row['withholdingtax']);
            $salaryloan =  htmlspecialchars($row['salaryloan']);
            $principal =  htmlspecialchars($row['principal']);
            $interest =  htmlspecialchars($row['interest']);
            $slBalance =  htmlspecialchars($row['slBalance']);
            $slPayment = htmlspecialchars($row['slPayment']);
            $slYear = htmlspecialchars($row['slYear']);
            $slAmortization = htmlspecialchars($row['slAmortization']);
            $slAmortizationFirst = htmlspecialchars($row['slAmortizationFirst']);
            $slAmortizationLast = htmlspecialchars($row['slAmortizationLast']);
            $slDate = htmlspecialchars($row['slDate']);
            $slDuedate = htmlspecialchars($row['slDuedate']);
            $slBank = htmlspecialchars($row['slBank']);
            $slCutoffSelect = htmlspecialchars($row['slCutoffSelect']);
        } else {
            $sql ="SELECT * FROM accounts where `employeeId` = ?";
            $stmt = mysqli_prepare($con, $sql);

            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
                
      if ($result && mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            $name = htmlspecialchars($row['fullName']);
            $position = htmlspecialchars($row['bankPosition']);
            $branch = htmlspecialchars($row['address']);
      }
        }

        mysqli_stmt_close($stmt);
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "No ID provided";
}

?>  