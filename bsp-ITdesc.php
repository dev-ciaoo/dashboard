<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        $remarks = $_POST['itChartDesc'];
        $updateSql = "UPDATE bspit SET  userid = $user, itChartDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['itDocsDesc'];
        $updateSql = "UPDATE bspit SET  userid = $user, itDocsDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['itBusinessDesc'];
        $updateSql = "UPDATE bspit SET  userid = $user, itBusinessDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['itPlanDesc'];
        $updateSql = "UPDATE bspit SET  userid = $user, itPlanDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') {
        $remarks = $_POST['itStratsDesc'];
        $updateSql = "UPDATE bspit SET  userid = $user, itStratsDesc = '$remarks' WHERE id = $id";
    }

    
    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-IT.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>