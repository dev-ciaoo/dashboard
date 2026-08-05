<?php 
include('connection.php');

$startdate = isset($_POST['startdateoutput']) ? $_POST['startdateoutput'] : '';
$enddate = isset($_POST['enddateoutput']) ? $_POST['enddateoutput'] : '';
$empId = isset($_POST['empId']) ? $_POST['empId'] : '';

// Sanitize the inputs
$startdate = mysqli_real_escape_string($con, $startdate);
$enddate = mysqli_real_escape_string($con, $enddate);
$empId = mysqli_real_escape_string($con, $empId);

// Check if required parameters are set
if (!empty($startdate) && !empty($enddate) && !empty($empId)) {
    
    // SQL query to get total other payment - FIXED DATE COMPARISON
    $sql = "SELECT SUM(amount) AS total_amount FROM pay_otherpayment 
            WHERE STR_TO_DATE(date, '%Y-%m-%d') >= STR_TO_DATE('$startdate', '%Y-%m-%d')
            AND STR_TO_DATE(date, '%Y-%m-%d') <= STR_TO_DATE('$enddate', '%Y-%m-%d')
            AND employeeId = '$empId' 
            AND (datedeleted = '' OR datedeleted IS NULL)";
    
    $result1 = mysqli_query($con, $sql);
    
    // Debug logging
    error_log("Other Pay Query - EmpID: $empId, Start: $startdate, End: $enddate");
    if ($result1) {
        error_log("Other Pay Query - Rows found: " . mysqli_num_rows($result1));
    } else {
        error_log("Other Pay Query - MySQL Error: " . mysqli_error($con));
    }

    if ($result1) {
        // Fetch the result
        $row = mysqli_fetch_assoc($result1);
        
        // Get the total amount (will be NULL if no records found)
        $total_amount = $row['total_amount'];
        
        // Match the EXACT logic from paydeduct.php
        if ($total_amount === null || $total_amount === '' || $total_amount == 0) {
            echo '0.00';
        } else {
            // Format to 2 decimal places - NO TRIM, return as-is like paydeduct.php
            echo number_format((float)$total_amount, 2, '.', '');
        }
    } else {
        // Query failed
        echo '0.00';
    }

} else {
    // Missing parameters
    echo '0.00';
}

// Close the connection
mysqli_close($con);
?>