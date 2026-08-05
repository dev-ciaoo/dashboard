<?php
    include('connection.php');
    include('fileUploadBSP.php');

    print_r($_POST);
    date_default_timezone_set('Asia/Manila');
    $dateToday = date('M j, Y');
    
    $genStock = $_POST['genStock'];
    $genComm = $_POST['genComm'];
    $genRecent = $_POST['genRecent'];
    $genMin	 = $_POST['genMin'];
    $genStrat = $_POST['genStrat'];
    $genList = $_POST['genList'];
    $genLease	 = $_POST['genLease'];
    $genInsurance	 = $_POST['genInsurance'];
    $genReports	 = $_POST['genReports'];
    $genCorr = $_POST['genCorr'];
    $genAct	 = $_POST['genAct'];
    $genCredit	 = $_POST['genCredit'];
    $genFolder	 = $_POST['genFolder'];
    $genInvent	 = $_POST['genInvent'];
    $genReview	 = $_POST['genReview'];
    $genReview1 = $_POST['genReview1'];
    $genReview2 = $_POST['genReview2'];
    $genReview3 = $_POST['genReview3'];
    $genReview4 = $_POST['genReview4'];
    $genReview5 = $_POST['genReview5'];
    $genReview6 = $_POST['genReview6'];
    $genReview7 = $_POST['genReview7'];
    $genReview8 = $_POST['genReview8'];
    $genReview9 = $_POST['genReview9'];
    $genReview10 = $_POST['genReview10'];

    $genStockDesc = $_POST['genStockDesc'];
    $genCommDesc = $_POST['genCommDesc'];
    $genRecentDesc = $_POST['genRecentDesc'];
    $genMinDesc = $_POST['genMinDesc'];
    $genStratDesc = $_POST['genStratDesc'];
    $genListDesc = $_POST['genListDesc'];
    $genLeaseDesc = $_POST['genLeaseDesc'];
    $genInsuranceDesc = $_POST['genInsuranceDesc'];
    $genReportsDesc = $_POST['genReportsDesc'];
    $genCorrDesc = $_POST['genCorrDesc'];
    $genActDesc = $_POST['genActDesc'];
    $genCreditDesc = $_POST['genCreditDesc'];
    $genFolderDesc = $_POST['genFolderDesc'];
    $genInventDesc = $_POST['genInventDesc'];
    $genReviewDesc = $_POST['genReviewDesc'];
    $genReview1Desc = $_POST['genReview1Desc'];
    $genReview2Desc = $_POST['genReview2Desc'];
    $genReview3Desc = $_POST['genReview3Desc'];
    $genReview4Desc = $_POST['genReview4Desc'];
    $genReview5Desc = $_POST['genReview5Desc'];
    $genReview6Desc = $_POST['genReview6Desc'];
    $genReview7Desc = $_POST['genReview7Desc'];
    $genReview8Desc = $_POST['genReview8Desc'];
    $genReview9Desc = $_POST['genReview9Desc'];
    $genReview10Desc = $_POST['genReview10Desc'];

    if(empty($genStockDesc) || $genStockDesc == ""){
        $genStockDesc = " ";
    }
    if(empty($genCommDesc) || $genCommDesc == ""){
        $genCommDesc = " ";
    }
    if(empty($genRecentDesc) || $genRecentDesc == ""){
        $genRecentDesc = " ";
    }
    if(empty($genMinDesc) || $genMinDesc == ""){
        $genMinDesc = " ";
    }
    if(empty($genStratDesc) || $genStratDesc == ""){
        $genStratDesc = " ";
    }
    if(empty($genListDesc) || $genListDesc == ""){
        $genListDesc = " ";
    }
    if(empty($genLeaseDesc) || $genLeaseDesc == ""){
        $genLeaseDesc = " ";
    }
    if(empty($genInsuranceDesc) || $genInsuranceDesc == ""){
        $genInsuranceDesc = " ";
    }
    if(empty($genReportsDesc) || $genReportsDesc == ""){
        $genReportsDesc = " ";
    }
    if(empty($genCorrDesc) || $genCorrDesc == ""){
        $genCorrDesc = " ";
    }
    if(empty($genActDesc) || $genActDesc == ""){
        $genActDesc = " ";
    }
    if(empty($genCreditDesc) || $genCreditDesc == ""){
        $genCreditDesc = " ";
    }
    if(empty($genFolderDesc) || $genFolderDesc == ""){
        $genFolderDesc = " ";
    }
    if(empty($genInventDesc) || $genInventDesc == ""){
        $genInventDesc = " ";
    }
    if(empty($genReviewDesc) || $genReviewDesc == ""){
        $genReviewDesc = " ";
    }
    if(empty($genReview1Desc) || $genReview1Desc == ""){
        $genReview1Desc = " ";
    }
    if(empty($genReview2Desc) || $genReview2Desc == ""){
        $genReview2Desc = " ";
    }
    if(empty($genReview3Desc) || $genReview3Desc == ""){
        $genReview3Desc = " ";
    }
    if(empty($genReview4Desc) || $genReview4Desc == ""){
        $genReview4Desc = " ";
    }
    if(empty($genReview5Desc) || $genReview5Desc == ""){
        $genReviewDesc = " ";
    }
    if(empty($genReview6Desc) || $genReview6Desc == ""){
        $genReview6Desc = " ";
    }
    if(empty($genReview7Desc) || $genReview7Desc == ""){
        $genReview7Desc = " ";
    }
    if(empty($genReview8Desc) || $genReview8Desc == ""){
        $genReview8Desc = " ";
    }
    if(empty($genReview9Desc) || $genReview9Desc == ""){
        $genReview9Desc = " ";
    }
    if(empty($genReview10Desc) || $genReview10Desc == ""){
        $genReview10Desc = " ";
    }

    // GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
    // PRINCIPAL BORROWER// Get uploaded file paths
    $genStockFile = upload_file($_FILES['genStock'],'bspgen', $genStock);
    $genCommFile = upload_file($_FILES['genComm'],'bspgen', $genComm);
    $genRecentFile = upload_file($_FILES['genRecent'],'bspgen', $genRecent);      
    $genMinFile = upload_file($_FILES['genMin'],'bspgen', $genMin);
    $genStratFile = upload_file($_FILES['genStrat'],'bspgen', $genStrat);
    $genListFile = upload_file($_FILES['genList'],'bspgen', $genList);
    $genLeaseFile = upload_file($_FILES['genLease'],'bspgen', $genLease);
    $genInsuranceFile = upload_file($_FILES['genInsurance'],'bspgen', $genInsurance);
    $genReportsFile = upload_file($_FILES['genReports'] ,'bspgen', $genReports);
    $genCorrFile = upload_file($_FILES['genCorr'],'bspgen', $genCorr);
    $genActFile = upload_file($_FILES['genAct'],'bspgen', $genAct);
    $genCreditFile = upload_file($_FILES['genCredit'] ,'bspgen', $genCredit);
    $genFolderFile = upload_file($_FILES['genFolder'] ,'bspgen', $genFolder);
    $genInventFile = upload_file($_FILES['genInvent'],'bspgen', $genInvent);
    $genReviewFile = upload_file($_FILES['genReview'],'bspgen', $genReview);
    $genReview1File = upload_file($_FILES['genReview1'],'bspgen', $genReview1);
    $genReview2File = upload_file($_FILES['genReview2'],'bspgen', $genReview2);
    $genReview3File = upload_file($_FILES['genReview3'],'bspgen', $genReview3);
    $genReview4File = upload_file($_FILES['genReview4'],'bspgen', $genReview4);
    $genReview5File = upload_file($_FILES['genReview5'],'bspgen', $genReview5);
    $genReview6File = upload_file($_FILES['genReview6'],'bspgen', $genReview6);
    $genReview7File = upload_file($_FILES['genReview7'],'bspgen', $genReview7);
    $genReview8File = upload_file($_FILES['genReview8'],'bspgen', $genReview8);
    $genReview9File = upload_file($_FILES['genReview9'],'bspgen', $genReview9);
    $genReview10File = upload_file($_FILES['genReview10'],'bspgen', $genReview10);

    // PRINCIPAL BORROWER
    $genStockPath = $genStockFile['path'];
    $genCommPath = $genCommFile['path'];
    $genRecentPath = $genRecentFile['path'];
    $genMinPath = $genMinFile['path'];
    $genStratPath = $genStratFile['path'];
    $genListPath = $genListFile['path'];
    $genLeasePath = $genLeaseFile['path'];
    $genInsurancePath = $genInsuranceFile['path'];
    $genReportsPath = $genReportsFile['path'];
    $genCorrPath = $genCorrFile['path'];
    $genActPath = $genActFile['path'];
    $genCreditPath = $genCreditFile['path'];
    $genFolderPath = $genFolderFile['path'];
    $genInventPath = $genInventFile['path'];
    $genReviewPath = $genReviewFile['path'];
    $genReview1Path = $genReview1File['path'];
    $genReview2Path = $genReview2File['path'];
    $genReview3Path = $genReview3File['path'];
    $genReview4Path = $genReview4File['path'];
    $genReview5Path = $genReview5File['path'];
    $genReview6Path = $genReview6File['path'];
    $genReview7Path = $genReview7File['path'];
    $genReview8Path = $genReview8File['path'];
    $genReview9Path = $genReview9File['path'];
    $genReview10Path = $genReview10File['path'];


    // Check if data already exists in the database
    $sqlSelect = "SELECT * FROM `bspgen`";
    $selectQuery = mysqli_query($con, $sqlSelect);
    $data = mysqli_fetch_assoc($selectQuery);

    if ($data) {

    function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
        if (!empty($columnValue)) {
        $sqlUpdate .= " `$columnName` = '$columnValue',";
        }
    }

    $sqlUpdate = "UPDATE `bspgen` SET";
    // check each data path, If the data path is not empty, it will update

    // DATA
    addColumnUpdate($sqlUpdate, "genStock", $genStockPath );
    addColumnUpdate($sqlUpdate, "genComm", $genCommPath);
    addColumnUpdate($sqlUpdate, "genRecent", $genRecentPath);
    addColumnUpdate($sqlUpdate, "genMin", $genMinPath);
    addColumnUpdate($sqlUpdate, "genStrat", $genStratPath);
    addColumnUpdate($sqlUpdate, "genList", $genListPath);
    addColumnUpdate($sqlUpdate, "genLease", $genLeasePath);
    addColumnUpdate($sqlUpdate, "genInsurance", $genInsurancePath);
    addColumnUpdate($sqlUpdate, "genReports", $genReportsPath);
    addColumnUpdate($sqlUpdate, "genCorr", $genCorrPath);
    addColumnUpdate($sqlUpdate, "genAct", $genActPath);
    addColumnUpdate($sqlUpdate, "genCredit", $genCreditPath);
    addColumnUpdate($sqlUpdate, "genFolder", $genFolderPath);
    addColumnUpdate($sqlUpdate, "genInvent", $genInventPath);
    addColumnUpdate($sqlUpdate, "genReview", $genReviewPath);
    addColumnUpdate($sqlUpdate, "genReview1", $genReview1Path);
    addColumnUpdate($sqlUpdate, "genReview2", $genReview2Path);
    addColumnUpdate($sqlUpdate, "genReview3", $genReview3Path);
    addColumnUpdate($sqlUpdate, "genReview4", $genReview4Path);
    addColumnUpdate($sqlUpdate, "genReview5", $genReview5Path);
    addColumnUpdate($sqlUpdate, "genReview6", $genReview6Path);
    addColumnUpdate($sqlUpdate, "genReview7", $genReview7Path);
    addColumnUpdate($sqlUpdate, "genReview8", $genReview8Path);
    addColumnUpdate($sqlUpdate, "genReview9", $genReview9Path);
    addColumnUpdate($sqlUpdate, "genReview10", $genReview10Path);


    // STATUS FUNCTION
    function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
        if (!empty($columnSelect)) {
        $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
        }
    }

    // PRINCIPAL BORROWER
    addStatus($sqlUpdate, "genStockDesc", $genStockDesc, "");
    addStatus($sqlUpdate, "genCommDesc", $genCommDesc, "");
    addStatus($sqlUpdate, "genRecentDesc", $genRecentDesc, "");
    addStatus($sqlUpdate, "genMinDesc", $genMinDesc, "");
    addStatus($sqlUpdate, "genStratDesc", $genStratDesc, "");
    addStatus($sqlUpdate, "genListDesc", $genListDesc, "");
    addStatus($sqlUpdate, "genLeaseDesc", $genLeaseDesc, "");
    addStatus($sqlUpdate, "genInsuranceDesc", $genInsuranceDesc, "");
    addStatus($sqlUpdate, "genReportsDesc", $genReportsDesc, "");
    addStatus($sqlUpdate, "genCorrDesc", $genCorrDesc, "");
    addStatus($sqlUpdate, "genActDesc", $genActDesc, "");
    addStatus($sqlUpdate, "genCreditDesc", $genCreditDesc, "");
    addStatus($sqlUpdate, "genFolderDesc", $genFolderDesc, "");
    addStatus($sqlUpdate, "genInventDesc", $genInventDesc, "");
    addStatus($sqlUpdate, "genReviewDesc", $genReviewDesc, "");
    addStatus($sqlUpdate, "genReview1Desc", $genReview1Desc, "");
    addStatus($sqlUpdate, "genReview2Desc", $genReview2Desc, "");
    addStatus($sqlUpdate, "genReview3Desc", $genReview3Desc, "");
    addStatus($sqlUpdate, "genReview4Desc", $genReview4Desc, "");
    addStatus($sqlUpdate, "genReview5Desc", $genReview5Desc, "");
    addStatus($sqlUpdate, "genReview6Desc", $genReview6Desc, "");
    addStatus($sqlUpdate, "genReview7Desc", $genReview7Desc, "");
    addStatus($sqlUpdate, "genReview8Desc", $genReview8Desc, "");
    addStatus($sqlUpdate, "genReview9Desc", $genReview9Desc, "");
    addStatus($sqlUpdate, "genReview10Desc", $genReview10Desc, "");

    $sqlUpdate = rtrim($sqlUpdate, ', ');

    $sqlUpdate .= "WHERE id = 1";

    $updateQuery = mysqli_query($con, $sqlUpdate);


    if ($updateQuery == true) {
        // Update successful
    } else {
        echo "Error: " . mysqli_error($con);
    }
    } else {
    // Insert new record
    $insertSql = "INSERT INTO `bspgen` (`genStock`, `genComm`, `genRecent`, `genMin`, `genStrat`, `genList`, 
                                            `genLease`, `genInsurance`, `genReports`, `genCorr`, `genAct`, 
                                            `genCredit`, `genFolder`, `genInvent`, `genReview`,
                                            `genReview1`, `genReview2`, `genReview3`, `genReview4`, `genReview5`,
                                            `genReview6`, `genReview7`, `genReview8`, `genReview9`, `genReview10`) 
                                VALUES 
                                        ('$genStockPath', '$genCommPath', '$genRecentPath', '$genMinPath', '$genStratPath', '$genListPath', 
                                            '$genLeasePath', '$genInsurancePath', '$genReportsPath', '$genCorrPath', '$genActPath', 
                                            '$genCreditPath', '$genFolderPath', '$genInventPath', '$genReviewPath',
                                            '$genReview1Path', '$genReview2Path', '$genReview3Path', '$genReview4Path', '$genReview5Path',
                                            '$genReview6Path', '$genReview7Path', '$genReview8Path', '$genReview9Path', '$genReview10Path')";
    $insertQuery = mysqli_query($con, $insertSql);

    if ($insertQuery) {
        echo "Insert successful";
    } else {
        echo "Error: " . mysqli_error($con);
    }
    }   

    // echo "genStock: " . $genStock . "<br>";
    ?>  