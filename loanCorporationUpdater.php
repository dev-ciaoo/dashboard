<?php
include('connection.php');

    $amountApplied = $_POST['amountApplyy'];
    $terms = $_POST['termYearss'];
    $interestRate = $_POST['intRate'];
    $msme = $_POST['sme'];
    $id = $_POST['hiddenID'];
    
    $upd = "UPDATE `loan` SET `amountApplied` = '$amountApplied', `terms` = '$terms', `interestRate` = '$interestRate', `msme` = '$msme' WHERE loan_Id = '$id'";
    $updQry = mysqli_query($con, $upd);
    
    if(!$updQry){
        echo "Error" . mysqli_error($con);
    }else{
        // echo "Updated Successfully";
    }


?>