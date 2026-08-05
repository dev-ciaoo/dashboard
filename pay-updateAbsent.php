<?php
include('connection.php');

$newiCategory = $_GET['newiCategory'];
$newreason = $_GET['newreason'];
$id = $_GET['id'];

$newiCategory = mysqli_real_escape_string($con, $newiCategory);
$newreason = mysqli_real_escape_string($con, $newreason);
$id = mysqli_real_escape_string($con, $id);

$sql = "UPDATE leavetbl  SET `iCategory` = '$newiCategory', `iMessage` = '$newreason' WHERE `id` = $id ";

if (mysqli_query($con, $sql)) {
    echo "Data update into leavetbl table successfully.<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

?>