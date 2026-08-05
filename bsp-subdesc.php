<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];

    if ($form_number == '1') {
        $remarks = $_POST['subFinDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subFinDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['subLedgDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subLedgDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['subDueDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subDueDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['subInvDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subInvDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') {
        $remarks = $_POST['subAccDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subAccDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '6') {
        $remarks = $_POST['subBankDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subBankDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '7') {
        $remarks = $_POST['subIncDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subIncDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '8') {
        $remarks = $_POST['subRecDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subRecDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '9') {
        $remarks = $_POST['subChangeDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subChangeDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '10') {
        $remarks = $_POST['subListDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subListDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '11') {
        $remarks = $_POST['subArtDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subArtDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '12') {
        $remarks = $_POST['subAuditDesc'];
        $updateSql = "UPDATE bspsub SET userid = $user, subAuditDesc = '$remarks' WHERE id = $id";
    }


    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-submission.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>