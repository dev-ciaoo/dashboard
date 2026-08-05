<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        $remarks = $_POST['hrSumDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrSumDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['hrCopyDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrCopyDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['hrBoardDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrBoardDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['hrOrgDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrOrgDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') {
        $remarks = $_POST['hrOfficerDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrOfficerDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '6') {
        $remarks = $_POST['hrPostDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrPostDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '7') {
        $remarks = $_POST['hrMemberDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrMemberDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '8') {
        $remarks = $_POST['hrEmpDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrEmpDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '9') {
        $remarks = $_POST['hrDutiesDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrDutiesDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '10') {
        $remarks = $_POST['hrTrainDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrTrainDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '11') {
        $remarks = $_POST['hrPolDesc'];
        $updateSql = "UPDATE bsphr  SET  userid = $user, hrPolDesc = '$remarks' WHERE id = $id";
    }


    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-hrm.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>