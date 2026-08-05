<?php
include('connection.php');

$id = $_POST['id'];
$iCategory = $_POST['iCategory'] ?? '';
$kindOfDay = $_POST['kindOfDay'] ?? '';
$dateFrom = $_POST['dateFrom'] ?? '';
$dateTo = $_POST['dateTo'] ?? '';
$timeFrom = $_POST['timeFrom'] ?? '';
$timeTo = $_POST['timeTo'] ?? '';

$sqlUpd = "UPDATE leavetbl SET 
                                `iCategory`=?, `kindDay`=?, `dateFrom`=?, `dateTo`=?, `timeFrom`=?, `timeTo`=?
                                    WHERE `id`=?;
          ";
$stmt = $con->prepare($sqlUpd);
$stmt->bind_param("ssssssi", $iCategory, $kindOfDay, $dateFrom, $dateTo, $timeFrom, $timeTo, $id);

if(!$stmt->execute()) {
    echo "Error Executing Update SQL" . $stmt->error; 
}else{
    echo "Success";
}

$stmt->close();
$con->close();

?>