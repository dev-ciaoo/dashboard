<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        $remarks = $_POST['offManualDesc'];
        $updateSql = "UPDATE bspoffice SET  userid = $user,offManualDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['offDetailDesc'];
        $updateSql = "UPDATE bspoffice SET  userid = $user,offDetailDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['offAccDesc'];
        $updateSql = "UPDATE bspoffice SET  userid = $user,offAccDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['offRegDesc'];
        $updateSql = "UPDATE bspoffice SET  userid = $user,offRegDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') {
        $remarks = $_POST['offMandaDesc'];
        $updateSql = "UPDATE bspoffice SET  userid = $user,offMandaDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '6') {
        $remarks = $_POST['offUtilDesc'];
        $updateSql = "UPDATE bspoffice SET  userid = $user,offUtilDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '7') {
        $remarks = $_POST['offSingleDesc'];
        $updateSql = "UPDATE bspoffice SET  userid = $user,offSingleDesc = '$remarks' WHERE id = $id";
    }


    
    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-office.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>