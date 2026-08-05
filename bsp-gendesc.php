<?php
include('connection.php');

// Assuming $con is your database connection

if(isset($_POST['form_submit'])) {
    $form_number = $_POST['form_submit'];
    $id = $_POST['id'];
    $remarks = '';
    $user = $_SESSION['userid'];

    if ($form_number == '1') {
        $remarks = $_POST['genStockDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genStockDesc = '$remarks' WHERE id = $id";
    } elseif ($form_number == '2') {
        $remarks = $_POST['genCommDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genCommDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '3') {
        $remarks = $_POST['genRecentDesc'];
        $updateSql = "UPDATE bspgen SET  userid = '$user', genRecentDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '4') {
        $remarks = $_POST['genMinDesc'];
        $updateSql = "UPDATE bspgen SET  userid = '$user', genMinDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '5') {
        $remarks = $_POST['genStratDesc'];
        $updateSql = "UPDATE bspgen SET  userid = '$user', genStratDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '6') {
        $remarks = $_POST['genListDesc'];
        $updateSql = "UPDATE bspgen SET  userid = '$user', genListDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '7') {
        $remarks = $_POST['genLeaseDesc'];
        $updateSql = "UPDATE bspgen SET  userid = '$user', genLeaseDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '8') {
        $remarks = $_POST['genInsuranceDesc'];
        $updateSql = "UPDATE bspgen SET  userid = '$user', genInsuranceDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '9') {
        $remarks = $_POST['genReportsDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReportsDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '10') {
        $remarks = $_POST['genCorrDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genCorrDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '11') {
        $remarks = $_POST['genActDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genActDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '12') {
        $remarks = $_POST['genCreditDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genCreditDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '13') {
        $remarks = $_POST['genFolderDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genFolderDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '14') {
        $remarks = $_POST['genInventDesc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genInventDesc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '16') {
        $remarks = $_POST['genReview1Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview1Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '17') {
        $remarks = $_POST['genReview2Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview2Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '18') {
        $remarks = $_POST['genReview3Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview3Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '19') {
        $remarks = $_POST['genReview4Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview4Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '20') {
        $remarks = $_POST['genReview5Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview5Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '21') {
        $remarks = $_POST['genReview6Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview6Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '22') {
        $remarks = $_POST['genReview7Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview7Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '23') {
        $remarks = $_POST['genReview8Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview8Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '24') {
        $remarks = $_POST['genReview9Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview9Desc = '$remarks' WHERE id = $id";
    }elseif ($form_number == '25') {
        $remarks = $_POST['genReview10Desc'];
        $updateSql = "UPDATE bspgen SET userid = '$user', genReview10Desc = '$remarks' WHERE id = $id";
    }
    
    

    if ($con->query($updateSql) === TRUE) {
        header("Location: bsp-generalinfo.php");
        exit();
    } else {
        echo "Error updating remarks: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>