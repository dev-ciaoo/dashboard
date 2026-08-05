<?php
include('connection.php');

$btnMicro = mysqli_real_escape_string($con, $_POST['btnmicroId']);
$stats = 3;

$updateSal = "UPDATE loan SET pipeStats = ? WHERE loan_Id = ?";
$stmt = $con->prepare($updateSal);

if($stmt === false){
    die('Error: ' . htmlspecialchars($con->error));
}

$stmt->bind_param('ii', $stats, $btnMicro);

if($stmt->execute()){
    echo 'Success';
}else{
    echo 'Error Executing Update SQL: ' . htmlspecialchars($con->error);
}

$stmt->close();
$con->close();

?>