<?php
include('connection.php');

$id = $_GET['id'];

$sql = "UPDATE leavetbl SET iStatus = '3' WHERE id = $id";

if ($con->query($sql) === TRUE) {
    echo "Record marked as deleted successfully";
} else {
    echo "Error marking record as deleted: " . $con->error;
}

?>