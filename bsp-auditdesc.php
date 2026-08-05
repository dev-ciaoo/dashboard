<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        $remarks = $_POST['audManualDesc'];
        $updateSql = "UPDATE bspaudit SET  userid = $user, audManualDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['audListDesc'];
        $updateSql = "UPDATE bspaudit SET  userid = $user, audListDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['audPlanDesc'];
        $updateSql = "UPDATE bspaudit SET  userid = $user, audPlanDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['audReportDesc'];
        $updateSql = "UPDATE bspaudit SET  userid = $user, audReportDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') {
        $remarks = $_POST['audOutDesc'];
        $updateSql = "UPDATE bspaudit SET  userid = $user, audOutDesc = '$remarks' WHERE id = $id";
    }
    
    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-Audit.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>