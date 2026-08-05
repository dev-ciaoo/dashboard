<?php
include('connection.php');
ini_set('max_execution_time', 0);
ini_set('mysql.connect_timeout', 0);
set_time_limit(0);

// Retrieve and escape input values
$date = mysqli_real_escape_string($con, $_POST['date']);
$basicpay = mysqli_real_escape_string($con, $_POST['valselectorbasicpay']);
$riceallow = mysqli_real_escape_string($con, $_POST['valselectorriceallow']);
$transpo = mysqli_real_escape_string($con, $_POST['valselectortranspoAllow']);
$otherpay = mysqli_real_escape_string($con, $_POST['valselectorotherpay']);
$overtime = mysqli_real_escape_string($con, $_POST['valselectorovertimePay']);
$sssmand = mysqli_real_escape_string($con, $_POST['valselectorsssmand']);
$sss = mysqli_real_escape_string($con, $_POST['valselectorsss']);
$pagibig = mysqli_real_escape_string($con, $_POST['valselectorpagibig']);
$philhealth = mysqli_real_escape_string($con, $_POST['valselectorphilhealth']);
$sssloan = mysqli_real_escape_string($con, $_POST['valselectorsssloan']);
$ssscalamity = mysqli_real_escape_string($con, $_POST['valselectorssscalamity']);
$pagibigloan = mysqli_real_escape_string($con, $_POST['valselectorpagibigloan']);
$pagibigcalamity = mysqli_real_escape_string($con, $_POST['valselectorpagibigcalamity']);
$employeeloan = mysqli_real_escape_string($con, $_POST['valselectoremployeeloan']);
$tax = mysqli_real_escape_string($con, $_POST['valselectortax']);
$absent = mysqli_real_escape_string($con, $_POST['valselectorabsent']);
$late = mysqli_real_escape_string($con, $_POST['valselectorlate']);
$otherdeduction = mysqli_real_escape_string($con, $_POST['valselectorotherDeduction']);
$totalearnings = mysqli_real_escape_string($con, $_POST['valselectortotalearnings']);
$totaldeduction = mysqli_real_escape_string($con, $_POST['valselectortotaldeduction']);
$netpay = mysqli_real_escape_string($con, $_POST['valselectornetpay']);
$sssEmployer = mysqli_real_escape_string($con, $_POST['valselectorsssEmployer']);
$sssmandEmployer = mysqli_real_escape_string($con, $_POST['valselectorsssmandEmployer']);
$pagibigEmployer = mysqli_real_escape_string($con, $_POST['valselectorpagibigEmployer']);
$philhealthEmployer = mysqli_real_escape_string($con, $_POST['valselectorphilhealthEmployer']);
$empId = mysqli_real_escape_string($con, $_POST['empId']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$branch = mysqli_real_escape_string($con, $_POST['branch']);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if record already exists
$sql = "SELECT * FROM `pay_record` WHERE `date` = ? AND `employeeId` = ?";
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ss", $date, $empId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && mysqli_num_rows($result) > 0) {
        // Record exists - UPDATE it
        $stmt->close(); // Close the SELECT statement first
        
        $updateRecord = "UPDATE pay_record SET 
            `basicpay` = ?, 
            `riceallow` = ?, 
            `transpo` = ?, 
            `otherpay` = ?, 
            `overtime` = ?, 
            `sssmand` = ?, 
            `sss` = ?, 
            `pagibig` = ?, 
            `philhealth` = ?, 
            `sssloan` = ?,
            `ssscalamity` = ?, 
            `pagibigloan` = ?, 
            `pagibigcalamity` = ?, 
            `emploan` = ?,
            `withholdingtax` = ?,
            `absent` = ?, 
            `late` = ?, 
            `otherdeduction` = ?, 
            `totalearning` = ?, 
            `totaldeduction` = ?, 
            `netsalary` = ?,
            `sssEmployer` = ?,
            `sssmandEmployer` = ?,
            `pagibigEmployer` = ?,
            `philhealthEmployer` = ?
            WHERE `date` = ? AND `employeeId` = ?"; 

        $stmt_update = $con->prepare($updateRecord);
        if ($stmt_update) {
            $stmt_update->bind_param("sssssssssssssssssssssssssss", 
                $basicpay, $riceallow, $transpo, $otherpay, $overtime, 
                $sssmand, $sss, $pagibig, $philhealth, $sssloan, 
                $ssscalamity, $pagibigloan, $pagibigcalamity, $employeeloan, $tax, 
                $absent, $late, $otherdeduction, $totalearnings, $totaldeduction, 
                $netpay, $sssEmployer, $sssmandEmployer, $pagibigEmployer, 
                $philhealthEmployer, $date, $empId);
            
            if ($stmt_update->execute()) {
                echo $empId;
            } else {
                echo "Error updating record: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            echo "Error preparing update statement: " . $con->error;
        }
        
    } else {
        // Record doesn't exist - INSERT it
        $stmt->close(); // Close the SELECT statement first
        
        // Update the selecteddate status
        $update = "UPDATE pay_selecteddate SET status ='1' WHERE selectedDate = ?";
        $stmt_status = $con->prepare($update);
        if ($stmt_status) {
            $stmt_status->bind_param("s", $date);
            $stmt_status->execute();
            $stmt_status->close();
        } else {
            echo "Error preparing statement for update: " . $con->error;
        }
        
        // Insert new record
        $add = "INSERT INTO `pay_record` (`employeeId`, `date`, `basicpay`, `name`, `branch`, `riceallow`, `transpo`, `otherpay`, `overtime`, `sssmand`, `sss`, `pagibig`, `philhealth`, `sssloan`, `ssscalamity`, `pagibigloan`, `pagibigcalamity`, `emploan`, `withholdingtax`, `absent`, `late`, `otherdeduction`, `totalearning`, `totaldeduction`, `netsalary`,`sssEmployer`,`sssmandEmployer`,`pagibigEmployer`,`philhealthEmployer`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $con->prepare($add);
        if ($stmt_insert) {
            $stmt_insert->bind_param("sssssssssssssssssssssssssssss", 
                $empId, $date, $basicpay, $name, $branch, $riceallow, $transpo, $otherpay, $overtime, 
                $sssmand, $sss, $pagibig, $philhealth, $sssloan, $ssscalamity, $pagibigloan, 
                $pagibigcalamity, $employeeloan, $tax, $absent, $late, $otherdeduction, 
                $totalearnings, $totaldeduction, $netpay, $sssEmployer, $sssmandEmployer, 
                $pagibigEmployer, $philhealthEmployer);
            
            if ($stmt_insert->execute()) {
                echo $empId;
            } else {
                echo "Error executing insert statement: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        } else {
            echo "Error preparing insert statement: " . $con->error;
        }
    }
} else {
    echo "Error preparing select statement: " . $con->error;
}

$con->close();
?>