<?php
include('connection.php');
include('fileupload.php');

$id = $_POST['id'];

$sql_inv = "SELECT code_id FROM `inventory` WHERE category=$id ORDER BY id DESC LIMIT 1";
$sql_cat = "SELECT categoryCode FROM `categorytbl` WHERE id=$id ORDER BY id DESC LIMIT 1";
$query = mysqli_query($con, $sql_cat);
if ($query) {
    while($row = mysqli_fetch_assoc($query)){
        echo $categoryCode = $row['categoryCode']."_";
    }
}
$query = mysqli_query($con, $sql_inv);
if ($query) {
    while($row = mysqli_fetch_assoc($query)){
        echo  (int)$row['code_id'] + 1;
        die();
    }
}
echo 1;