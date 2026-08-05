<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];

    if ($form_number == '1') {
        $remarks = $_POST['legalRegDesc'];
        $updateSql = "UPDATE bsplegal SET  userid = $user, legalRegDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['legalStatsDesc'];
        $updateSql = "UPDATE bsplegal SET  userid = $user, legalStatsDesc = '$remarks' WHERE id = $id";
    }


    
    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-legal.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>