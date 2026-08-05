<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        $remarks = $_POST['aamManualDesc'];
        $updateSql = "UPDATE bspassets SET  userid = $user, aamManualDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['aamListDesc'];
        $updateSql = "UPDATE bspassets SET  userid = $user, aamListDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['aamAssestsDesc'];
        $updateSql = "UPDATE bspassets SET  userid = $user, aamAssestsDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['aamSalesDesc'];
        $updateSql = "UPDATE bspassets SET  userid = $user, aamSalesDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') {
        $remarks = $_POST['aamSchedDesc'];
        $updateSql = "UPDATE bspassets SET  userid = $user, aamSchedDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '6') {
        $remarks = $_POST['aamSched2Desc'];
        $updateSql = "UPDATE bspassets SET  userid = $user, aamSched2Desc = '$remarks' WHERE id = $id";
    }

    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-assets.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>