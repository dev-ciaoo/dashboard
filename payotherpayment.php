<?php 
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['empid'];
    $name = $_POST['name'];
    $branch = $_POST['address'];
    $position = $_POST['bankPosition'];
    $amount = $_POST['otherpayment'];
    $date = $_POST['date'];
    $remarks = $_POST['remarks'];

    try {
        $query = "INSERT INTO pay_otherpayment (`employeeId`, `name`, `branch`, `position`, `amount`, `date`,`remarks`)
        VALUES (?,?,?,?,?,?,?)";

        $stmt = mysqli_prepare($con, $query);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . mysqli_error($con));
        }

        // Assuming `employeeId` is a string, so 's' is used as parameter type
        mysqli_stmt_bind_param($stmt, "sssssss", $id, $name, $branch, $position, $amount, $date,$remarks);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Redirect to the page after successful update or insert
            header("Location: payreadother.php");
            echo "<script> location.reload(); </script>";
            exit();
        } else {
            echo "Error updating/inserting record: " . mysqli_error($con);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
        // Close the database connection
        mysqli_close($con);

    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
?>