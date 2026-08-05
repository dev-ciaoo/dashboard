<?php
include('connection.php');

$id = $_POST['idinfo'];
$empStatus = $_POST['empStatus'];
$empCivil = $_POST['empCivil'];
$empPosition = $_POST['empPosition'];
$contactPerson = $_POST['contactPerson'];
$emergencyNum = $_POST['emergencyNum'];
$empBday = $_POST['empBday']; 
$empAddr = $_POST['empAddr']; 
$empBranch = $_POST['empBranch']; 
$empDept = $_POST['empDept']; 
$empEmail = $_POST['empEmail']; 
$empHired = $_POST['empHired']; 
$sssinfo = $_POST['sssinfo'];
$tininfo = $_POST['tininfo'];
$pagibiginfo = $_POST['pagibiginfo'];
$philhealthinfo = $_POST['philhealthinfo'];
$empSched = $_POST['empSched'];
$remarksSched = $_POST['remarksSched'];



$id = !empty($id) ? $id : '';
$empCivil = !empty($empCivil) ? $empCivil : '';
$empPosition = !empty($empPosition) ? $empPosition : '';
$contactPerson = !empty($contactPerson) ? $contactPerson : '';
$emergencyNum = !empty($emergencyNum) ? $emergencyNum : '';
$empStatus = !empty($empStatus) ? $empStatus : '';
$empBday = !empty($empBday) ? $empBday : '';
$empAddr = !empty($empAddr) ? $empAddr : '';
$empBranch = !empty($empBranch) ? $empBranch : '';
$empDept = !empty($empDept) ? $empDept : '';
$empEmail = !empty($empEmail) ? $empEmail : '';
$empHired = !empty($empHired) ? $empHired : '';
$sssinfo = !empty($sssinfo) ? $sssinfo : '';
$tininfo = !empty($tininfo) ? $tininfo : '';
$pagibiginfo = !empty($pagibiginfo) ? $pagibiginfo : '';
$philhealthinfo = !empty($philhealthinfo) ? $philhealthinfo : '';
$empSched = !empty($empSched) ? $empSched : '';
$remarksSched = !empty($remarksSched) ? $remarksSched : '';

$postData = json_encode($_POST);

$check = "SELECT * FROM empinfo WHERE empId = ?";
$stmt = $con->prepare($check);

if ($stmt === false) {
    die("Error preparing the statement: " . $con->error);
}

$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql = "UPDATE empinfo SET civilStats = ?, empPosition = ?, contactPerson = ?, emergencyNum = ?, empStatus = ?,
    bday = ?, townAddress = ?, dateHired = ?, sss = ?, tin = ?, pagibig = ?, philhealth = ?, flexTime = ?, remarks = ?
    WHERE empId = ?";
    $stmt = $con->prepare($sql);
    if ($stmt === false) {
        die("Error preparing the statement: " . $con->error);
    }

    $stmt->bind_param('sssssssssssssss', $empCivil, $empPosition, $contactPerson, $emergencyNum, $empStatus,$empBday, $empAddr, $empHired, $sssinfo, $tininfo, $pagibiginfo, $philhealthinfo, $empSched, $remarksSched, $id);
    
    if ($stmt->execute()) {
        // $selectAcc = "SELECT bankPosition WHERE employeeId = ?";
        // $stmt2 = $con->prepare($selectAcc);
        // $res = $con->fetch_assoc();
        // if($stmt2->execute()){
        //     if($res['bankPosition'] !== ''){
        //         return;
        //     }else{

        //     }
        // }
        // $updateAcc = "UPDATE accounts SET bankPosition = ? WHERE employeeId = ?";
        // $stmt2 = $con->prepare($updateAcc);
        // $stmt2->bind_param('ss', $empPosition, $id);
        // $stmt2->execute();
        // if ($stmt->affected_rows > 0) {
        //     echo "Success";
        // } else {
        //     echo "No rows affected by UPDATE query.";
        echo "Success";
        // }
    } else {
        echo "Error executing UPDATE query: " . $stmt->error;
    }

    $stmt->close();

} else {
    $insert = "INSERT INTO empinfo (empId, civilStats, empPosition, contactPerson, emergencyNum, empStatus, bday, townAddress, dateHired, sss, tin, pagibig, philhealth, flexTime, remarks)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($insert);
    if ($stmt === false) {
        die("Error preparing the statement: " . $con->error);
    }
    $stmt->bind_param('sssssssssssssss', $id, $empCivil, $empPosition, $contactPerson, $emergencyNum, $empStatus, $empBday, $empAddr, $empHired, $sssinfo, $tininfo, $pagibiginfo, $philhealthinfo, $empSched, $remarksSched);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Success";
        } else {
            echo "No rows affected by INSERT query.";
        }
    } else {
        echo "Error executing INSERT query: " . $stmt->error;
    }
    $stmt->close();
}
$stmt2->close();
$con->close();
?>
