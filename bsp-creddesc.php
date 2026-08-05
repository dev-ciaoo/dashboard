<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];
    if ($form_number == '1') {
        // Form 1 submitted
        $remarks = $_POST['lendProcessDesc1'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendProcessDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        // Form 2 submitted
        $remarks = $_POST['lendCreditDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendCreditDesc = '$remarks' WHERE id = $id";
    }
    elseif ($form_number == '3') { 
        $remarks = $_POST['lendManagementDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendManagementDesc = '$remarks' WHERE id = $id";
    }
    elseif ($form_number == '4') { 
        $remarks = $_POST['lendSummaryDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendSummaryDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') { 
        $remarks = $_POST['lendCopyDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendCopyDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '6') { 
        $remarks = $_POST['lendSummary2Desc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendSummary2Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '7') { 
        $remarks = $_POST['lendSchedDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendSchedDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '8') { 
        $remarks = $_POST['lendListDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendListDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '9') { 
        $remarks = $_POST['lendLoanDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendLoanDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '10') { 
        $remarks = $_POST['lendProcess2Desc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendProcess2Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '11') { 
        $remarks = $_POST['lendAgingDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendAgingDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '12') { 
        $remarks = $_POST['lendSched2Desc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendSched2Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '13') { 
        $remarks = $_POST['lendOtherDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendOtherDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '14') { 
        $remarks = $_POST['lendLoan2Desc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendLoan2Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '15') { 
        $remarks = $_POST['lendSummary3Desc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendSummary3Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '16') { 
        $remarks = $_POST['lendClassDesc'];
        $updateSql = "UPDATE bsplending SET  userid = $user, lendClassDesc = '$remarks' WHERE id = $id";
    }

    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-credit.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>