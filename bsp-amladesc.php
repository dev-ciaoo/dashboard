<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        $remarks = $_POST['amlAntiDesc'];
        $updateSql = "UPDATE bspamla SET  userid = $user, amlAntiDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['amlCertDesc'];
        $updateSql = "UPDATE bspamla SET  userid = $user, amlCertDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['amlListDesc'];
        $updateSql = "UPDATE bspamla SET  userid = $user, amlListDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['amlStatsDesc'];
        $updateSql = "UPDATE bspamla SET  userid = $user, amlStatsDesc = '$remarks' WHERE id = $id";
    }
    
    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-amla.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>s