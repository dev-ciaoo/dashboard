<?php
    include('connection.php');

    $id = $_GET['id'];

    $currentDate = date("Y-m-d");

    // Select the maximum ID for the employee
    $maxIdQuery = "SELECT MAX(h.id) AS max_idHR, MAX(l.id) as max_idLoan FROM pay_earningshr as h
    LEFT JOIN pay_earningsloan as l ON l.employeeId = h.employeeId
    WHERE h.employeeId = '$id'";
    $maxIdResult = mysqli_query($con, $maxIdQuery);

    if (!$maxIdResult) {
        echo "Error selecting maximum ID: " . mysqli_error($con);
        exit; // Exit the script if there's an error
    }

    $row = mysqli_fetch_assoc($maxIdResult);
    $max_idHR = $row['max_idHR'];
    $max_idLoan = $row['max_idLoan'];

    // Update the record with the maximum IDi
    $sql = "UPDATE pay_earningshr SET `datedeleted` = '$currentDate'
            WHERE `id` = '$max_idHR' AND `datedeleted` = ''";

    $sql2 = "UPDATE pay_earningsloan SET `datedeleted` = '$currentDate'
            WHERE `id` = '$max_idLoan' AND `datedeleted` = ''";

    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql2);
        
    if ($result) {
        echo "Record updated successfully. Current date: $currentDate";
        echo "<br> my id :$id"; 
        header("Location: pay-employeemanagement.php");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
?>