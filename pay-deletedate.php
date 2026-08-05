<?php
include('connection.php');

$deleteDate = mysqli_real_escape_string($con, $_POST['deleteDate']);

// Ensure the date is properly quoted in the SQL statement
$sql = "DELETE FROM pay_selecteddate WHERE date = '$deleteDate'";

$result = mysqli_query($con, $sql);

if ($result) {
    // If successful, redirect to the page after successful update or insert
    header("Location: payEmployee.php");
    exit(); // Make sure to exit after redirection
} else {
    // If there's an error, display the error message
    echo "Error deleting record: " . mysqli_error($con);
}

?>