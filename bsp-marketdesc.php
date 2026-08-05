<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $userid = $_SESSION['userid'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        // Form 1 submitted
        $remarks = $_POST['mrkManualsDesc1'];
        $updateSql = "UPDATE bspmarket SET  userid = $user, mrkManualsDesc = '$remarks', userid = '$userid' WHERE id = $id";
    } elseif ($form_number == '2') {
        // Form 2 submitted
        $remarks = $_POST['mrkListDesc1'];
        $updateSql = "UPDATE bspmarket SET  userid = $user, mrkListDesc = '$remarks', userid = '$userid' WHERE id = $id";
    }
    elseif ($form_number == '3') { 
        $remarks = $_POST['mrkMemoDesc1'];
        $updateSql = "UPDATE bspmarket SET  userid = $user, mrkMemoDesc = '$remarks', userid = '$userid' WHERE id = $id";
    }
    elseif ($form_number == '4') { 
        $remarks = $_POST['mrkDetailsDesc1'];
        $updateSql = "UPDATE bspmarket SET  userid = $user, mrkDetailsDesc = '$remarks', userid = '$userid' WHERE id = $id";
    }elseif ($form_number == '5') { 
        $remarks = $_POST['mrkRunDesc1'];
        $updateSql = "UPDATE bspmarket SET  userid = $user, mrkRunDesc = '$remarks', userid = '$userid' WHERE id = $id";
    }elseif ($form_number == '6') { 
        $remarks = $_POST['mrkScheduleDesc1'];
        $updateSql = "UPDATE bspmarket SET  userid = $user, mrkScheduleDesc = '$remarks', userid = '$userid' WHERE id = $id";
    }elseif ($form_number == '7') { 
        $remarks = $_POST['mrkBreakdownDesc1'];
        $updateSql = "UPDATE bspmarket SET  userid = $user, mrkBreakdownDesc = '$remarks', userid = '$userid' WHERE id = $id";
    }else{
        
    }

    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-market.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>