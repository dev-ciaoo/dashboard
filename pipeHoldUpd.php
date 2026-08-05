<?php
include('connection.php');

$btnHold = mysqli_real_escape_string($con, $_POST['btnHoldOutId']);
$stats = 3;

$updateSal = "UPDATE loan SET pipeStats = ? WHERE loan_Id = ?";
$stmt = $con->prepare($updateSal);

if($stmt === false){
    die('Error: ' . htmlspecialchars($con->error));
}

$stmt->bind_param('ii', $stats, $btnHold);

if($stmt->execute()){
    echo 'Success';
}else{
    echo 'Error Executing Update SQL: ' . htmlspecialchars($con->error);
}

$stmt->close();
$con->close();

?>