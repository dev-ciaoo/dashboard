<?php
include('connection.php');

$currentDate = date("Y-m-d");
$sql = "SELECT pe.*
        FROM pay_earnings pe
        JOIN (
            SELECT employeeId, MAX(id) AS max_id
            FROM pay_earnings
            GROUP BY employeeId
        ) max_ids
        ON pe.employeeId = max_ids.employeeId AND pe.id = max_ids.max_id";
$result = mysqli_query($con, $sql);

if (!$result) {
    // Handle query execution error
    die("Error in SQL query: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['employeeId'];
        $ID = $row['id'];
        $name = $row['name'];
        $branch = $row['branch'];
        $MonthlySalary = $row['MonthlySalary'];
        $RiceAllowance = $row['RiceAllowance'];
        $TranspoAllowance = $row['TranspoAllowance'];
        $sss = $row['sss'];
        $sssmandprovident = $row['sssmandprovident'];
        $pagibig = $row['pagibig'];
        $philhealth = $row['philhealth'];
        $withholdingtax = $row['withholdingtax'];
        $slDuedate = $row['slDuedate'];

       if ($slDuedate !== '' && isset($slDuedate) && strtotime($slDuedate) <= strtotime($currentDate)) {
            // Update datedeleted column with current date for the current employee
            $updateSql = "UPDATE pay_earnings SET datedeleted = '$currentDate' WHERE employeeId = '$id'";
            $updateResult = mysqli_query($con, $updateSql);
            if (!$updateResult) {
                // Handle update query execution error
                die("Error in update query: " . mysqli_error($con));
            }
                
                $insertSql = "INSERT INTO pay_earnings (employeeId, name, branch, MonthlySalary, RiceAllowance, TranspoAllowance, sss, sssmandprovident, pagibig, philhealth, withholdingtax, datemodified)
                              VALUES ('$id', '$name', '$branch', '$MonthlySalary', '$RiceAllowance', '$TranspoAllowance', '$sss', '$sssmandprovident', '$pagibig', '$philhealth', '$withholdingtax', '$currentDate')";
                              
                $insertResult = mysqli_query($con, $insertSql);
                if (!$insertResult) {
                  
                    die("Error in insert query: " . mysqli_error($con));
                }
        }       
}
}

mysqli_close($con); // Close the database connection
?>