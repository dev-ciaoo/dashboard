<?php
include('connection.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data_to_retrieve = $_POST['data_to_retrieve'];

$date = isset($_POST['date']) ? $_POST['date'] : '';
$empid = isset($_POST['empId']) ? $_POST['empId'] : '';

// Sanitize input and use prepared statements to avoid SQL injection
$date = mysqli_real_escape_string($con, $date);
$empid = mysqli_real_escape_string($con, $empid);

$sql = "SELECT * FROM pay_record WHERE date = ? AND employeeId = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('ss', $date, $empid); 

$stmt->execute();
$result = $stmt->get_result();

// ✅ INITIALIZE ALL VARIABLES WITH DEFAULT VALUES FIRST
$employeeId = '';
$name = '';
$branch = '';
$basicpay = '0.00';
$transpo = '0.00';
$riceallow = '0.00';
$overtime = '0.00';
$otherpay = '0.00';
$sss = '0.00';
$sssmand = '0.00';
$pagibig = '0.00';
$philhealth = '0.00';
$sssloan = '0.00';
$ssscalamity = '0.00';
$pagibigloan = '0.00';
$pagibigcalamity = '0.00';
$emploan = '0.00';
$withholdingtax = '0.00';
$absent = '0.00';
$late = '0.00';
$otherdeduction = '0.00';
$totalearning = '0.00';
$totaldeduction = '0.00';
$netsalary = '0.00';
$sssEmployer = '0.00';
$sssmandEmployer = '0.00';
$pagibigEmployer = '0.00';
$philhealthEmployer = '0.00';
$readPayslip = '0';

if ($result) {
    if($row = $result->fetch_assoc()) {
        // ✅ OVERRIDE WITH ACTUAL VALUES IF RECORD EXISTS
        $employeeId = $row['employeeId'];
        $name = $row['name'];
        $branch = $row['branch'];
        $basicpay = ($row['basicpay'] !== '' && $row['basicpay'] !== null) ? $row['basicpay'] : '0.00';
        $transpo = ($row['transpo'] !== '' && $row['transpo'] !== null) ? $row['transpo'] : '0.00';
        $riceallow = ($row['riceallow'] !== '' && $row['riceallow'] !== null) ? $row['riceallow'] : '0.00';
        $overtime = ($row['overtime'] !== '' && $row['overtime'] !== null) ? $row['overtime'] : '0.00';
        $otherpay = ($row['otherpay'] !== '' && $row['otherpay'] !== null) ? $row['otherpay'] : '0.00';
        $sss = ($row['sss'] !== '' && $row['sss'] !== null) ? $row['sss'] : '0.00';
        $sssmand = ($row['sssmand'] !== '' && $row['sssmand'] !== null) ? $row['sssmand'] : '0.00';
        $pagibig = ($row['pagibig'] !== '' && $row['pagibig'] !== null) ? $row['pagibig'] : '0.00';
        $philhealth = ($row['philhealth'] !== '' && $row['philhealth'] !== null) ? $row['philhealth'] : '0.00';
        $sssloan = ($row['sssloan'] !== '' && $row['sssloan'] !== null) ? $row['sssloan'] : '0.00';
        $ssscalamity = ($row['ssscalamity'] !== '' && $row['ssscalamity'] !== null) ? $row['ssscalamity'] : '0.00';
        $pagibigloan = ($row['pagibigloan'] !== '' && $row['pagibigloan'] !== null) ? $row['pagibigloan'] : '0.00';
        $pagibigcalamity = ($row['pagibigcalamity'] !== '' && $row['pagibigcalamity'] !== null) ? $row['pagibigcalamity'] : '0.00';
        $emploan = ($row['emploan'] !== '' && $row['emploan'] !== null) ? $row['emploan'] : '0.00';
        $withholdingtax = ($row['withholdingtax'] !== '' && $row['withholdingtax'] !== null) ? $row['withholdingtax'] : '0.00';
        $absent = ($row['absent'] !== '' && $row['absent'] !== null) ? $row['absent'] : '0.00';
        $late = ($row['late'] !== '' && $row['late'] !== null) ? $row['late'] : '0.00';
        $otherdeduction = ($row['otherdeduction'] !== '' && $row['otherdeduction'] !== null) ? $row['otherdeduction'] : '0.00';
        $totalearning = ($row['totalearning'] !== '' && $row['totalearning'] !== null) ? $row['totalearning'] : '0.00';
        $totaldeduction = ($row['totaldeduction'] !== '' && $row['totaldeduction'] !== null) ? $row['totaldeduction'] : '0.00';
        $netsalary = ($row['netsalary'] !== '' && $row['netsalary'] !== null) ? $row['netsalary'] : '0.00';
        $sssEmployer = ($row['sssEmployer'] !== '' && $row['sssEmployer'] !== null) ? $row['sssEmployer'] : '0.00';
        $sssmandEmployer = ($row['sssmandEmployer'] !== '' && $row['sssmandEmployer'] !== null) ? $row['sssmandEmployer'] : '0.00';
        $pagibigEmployer = ($row['pagibigEmployer'] !== '' && $row['pagibigEmployer'] !== null) ? $row['pagibigEmployer'] : '0.00';
        $philhealthEmployer = ($row['philhealthEmployer'] !== '' && $row['philhealthEmployer'] !== null) ? $row['philhealthEmployer'] : '0.00';
        $readPayslip = $row['readPayslip'];
    }
}

// ✅ NOW ECHO THE VALUES (VARIABLES ARE ALWAYS DEFINED)
if ($data_to_retrieve === 'basicsalary') {
    echo htmlspecialchars($basicpay, ENT_QUOTES, 'UTF-8');
} elseif ($data_to_retrieve === 'riceallowance') {
    echo $riceallow;
} elseif ($data_to_retrieve === 'transpo') {
    echo $transpo;
} else if ($data_to_retrieve === 'sss'){
    echo $sss;
} else if ($data_to_retrieve === 'sssmand'){
    echo $sssmand;
} else if ($data_to_retrieve === 'pagibig'){
    echo $pagibig;
} else if ($data_to_retrieve === 'philhealth'){
    echo $philhealth;
} else if ($data_to_retrieve === 'sssloan'){
    echo $sssloan;
} else if ($data_to_retrieve === 'tax'){
    echo $withholdingtax;
} else if ($data_to_retrieve === 'slAmortization'){
    echo $emploan;
} else if ($data_to_retrieve === 'ssscalamity'){
    echo $ssscalamity;
} else if ($data_to_retrieve === 'pagibigloan'){
    echo $pagibigloan;
} else if ($data_to_retrieve === 'pagibigcalamity'){
    echo $pagibigcalamity;
} else if ($data_to_retrieve === 'overtime'){
    echo $overtime;
} else if ($data_to_retrieve === 'absent'){
    echo $absent;
} else if ($data_to_retrieve === 'late'){
    echo $late;
} else if ($data_to_retrieve === 'otherpay'){
    echo $otherpay;
} else if ($data_to_retrieve === 'otherdeduction'){
    echo $otherdeduction;
} else if ($data_to_retrieve === 'totalearning'){
    echo $totalearning;
} else if ($data_to_retrieve === 'totaldeduction'){
    echo $totaldeduction;
} else if ($data_to_retrieve === 'netsalary'){
    echo $netsalary;
} else if ($data_to_retrieve === 'employeeId'){
    echo $employeeId;
} else if ($data_to_retrieve === 'readPayslip'){
    echo $readPayslip;
} else if ($data_to_retrieve === 'sssEmployer'){
    echo $sssEmployer;
} else if ($data_to_retrieve === 'sssmandEmployer'){
    echo $sssmandEmployer;
} else if ($data_to_retrieve === 'pagibigEmployer'){
    echo $pagibigEmployer;
} else if ($data_to_retrieve === 'philhealthEmployer'){
    echo $philhealthEmployer;
}

$stmt->close();
$con->close();
?>