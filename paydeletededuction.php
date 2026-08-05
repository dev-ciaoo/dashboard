<?php
include('connection.php');

$id = $_GET['id'];

// Assuming 'delete_date' is the name of the column to update.
// You might need to adjust this query based on your table structure.
$sql = "UPDATE pay_otherdeductions SET datedeleted = NOW() WHERE id = $id";

if ($con->query($sql) === TRUE) {
    echo "Record marked as deleted successfully";
    header("Location: payreadother.php");
} else {
    echo "Error marking record as deleted: " . $con->error;
}

$con->close();
?>