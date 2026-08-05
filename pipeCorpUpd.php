<?php
include('connection.php');

$btnCorp = mysqli_real_escape_string($con, $_POST['btncorpId']);
$stats = 3;

$updateSal = "UPDATE loan SET pipeStats = ? WHERE loan_Id = ?";
$stmt = $con->prepare($updateSal);

if($stmt === false){
    die('Error: ' . htmlspecialchars($con->error));
}

$stmt->bind_param('ii', $stats, $btnCorp);

if($stmt->execute()){
    echo 'Success';
}else{
    echo 'Error Executing Update SQL: ' . htmlspecialchars($con->error);
}

$stmt->close();
$con->close();

?>