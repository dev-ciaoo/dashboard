<?php
include ('connection.php');

$id = $_POST['id'];
$empid = $_POST['empid'];
$name = $_POST['name'];
$position = $_POST['position'];
$branch = $_POST['branch'];
$amount = $_POST['amount'];
$remarks = $_POST['remarks'];
$date = $_POST['date'];

$empid = mysqli_real_escape_string($con, $empid);
$name = mysqli_real_escape_string($con, $name);
$position = mysqli_real_escape_string($con, $position);
$branch = mysqli_real_escape_string($con, $branch);
$amount = mysqli_real_escape_string($con, $amount);
$remarks = mysqli_real_escape_string($con, $remarks);
$date = mysqli_real_escape_string($con, $date);

// Enclose string values in single quotes in the SQL query
$sql = "UPDATE pay_otherpayment SET 
            employeeId = '$empid', 
            name = '$name', 
            position = '$position', 
            branch = '$branch', 
            amount = '$amount', 
            remarks = '$remarks', 
            date = '$date' 
        WHERE id = $id";

$result = mysqli_query($con, $sql);

if ($result) {
    header("Location: payreadother.php");
    exit(); // Always exit after redirection
} else {
    echo "Error: " . mysqli_error($con); // Display MySQL error if query fails
}

mysqli_close($con);
?>