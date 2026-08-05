<?php
include('connection.php');
include('fileUploadBSP.php');


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$subFin = $_POST['subFin'];
$subLedg = $_POST['subLedg'];
$subDue = $_POST['subDue'];
$subInv = $_POST['subInv'];
$subAcc = $_POST['subAcc'];
$subBank = $_POST['subBank'];
$subInc = $_POST['subInc'];
$subRec = $_POST['subRec'];
$subChange = $_POST['subChange'];
$subList = $_POST['subList'];
$subArt = $_POST['subArt'];
$subAudit = $_POST['subAudit'];

$subFinDesc = $_POST['subFinDesc'];
$subLedgDesc = $_POST['subLedgDesc'];
$subDueDesc = $_POST['subDueDesc'];
$subInvDesc = $_POST['subInvDesc'];
$subAccDesc = $_POST['subAccDesc'];
$subBankDesc = $_POST['subBankDesc'];
$subIncDesc = $_POST['subIncDesc'];
$subRecDesc = $_POST['subRecDesc'];
$subChangeDesc = $_POST['subChangeDesc'];
$subListDesc = $_POST['subListDesc'];
$subArtDesc = $_POST['subArtDesc'];
$subAuditDesc = $_POST['subAuditDesc'];

if(empty($subFinDesc) || $subFinDesc == ""){
  $subFinDesc = " ";
}
if(empty($subLedgDesc) || $subLedgDesc == ""){
  $subLedgDesc = " ";
}
if(empty($subDueDesc) || $subDueDesc == ""){
  $subDueDesc = " ";
}
if(empty($subInvDesc) || $subInvDesc == ""){
  $subInvDesc = " ";
}
if(empty($subAccDesc) || $subAccDesc == ""){
  $subAccDesc = " ";
}
if(empty($subBankDesc) || $subBankDesc == ""){
  $subBankDesc = " ";
}
if(empty($subIncDesc) || $subIncDesc == ""){
  $subIncDesc = " ";
}
if(empty($subRecDesc) || $subRecDesc == ""){
  $subRecDesc = " ";
}
if(empty($subChangeDesc) || $subChangeDesc == ""){
  $subChangeDesc = " ";
}
if(empty($subListDesc) || $subListDesc == ""){
  $subListDesc = " ";
}
if(empty($subArtDesc) || $subArtDesc == ""){
  $subArtDesc = " ";
}
if(empty($subAuditDesc) || $subAuditDesc == ""){
  $subAuditDesc = " ";
}

// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
$subFinFile = upload_file($_FILES['subFin'], 'bspsub', $subFin);
$subLedgFile = upload_file($_FILES['subLedg'], 'bspsub', $subLedg);
$subDueFile = upload_file($_FILES['subDue'], 'bspsub', $subDue);
$subInvFile = upload_file($_FILES['subInv'], 'bspsub', $subInv);
$subAccFile = upload_file($_FILES['subAcc'], 'bspsub', $subAcc);
$subBankFile = upload_file($_FILES['subBank'], 'bspsub', $subBank);
$subIncFile = upload_file($_FILES['subInc'], 'bspsub', $subInc);
$subRecFile = upload_file($_FILES['subRec'], 'bspsub', $subRec);
$subChangeFile = upload_file($_FILES['subChange'], 'bspsub', $subChange);
$subListFile = upload_file($_FILES['subList'], 'bspsub', $subList);
$subArtFile = upload_file($_FILES['subArt'], 'bspsub', $subArt);
$subAuditFile = upload_file($_FILES['subAudit'], 'bspsub', $subAudit);

$subFinPath = $subFinFile['path'];
$subLedgPath = $subLedgFile['path'];
$subDuePath = $subDueFile['path'];
$subInvPath = $subInvFile['path'];
$subAccPath = $subAccFile['path'];
$subBankPath = $subBankFile['path'];
$subIncPath = $subIncFile['path'];
$subRecPath = $subRecFile['path'];
$subChangePath = $subChangeFile['path'];
$subListPath = $subListFile['path'];
$subArtPath = $subArtFile['path'];
$subAuditPath = $subAuditFile['path'];

$sqlSelect = "SELECT * FROM `bspsub`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if($data){

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE `bspsub` SET";
// check each data path, If the data path is not empty, it will update

// DATA
addColumnUpdate($sqlUpdate, "subFin", $subFinPath);
addColumnUpdate($sqlUpdate, "subLedg", $subLedgPath);
addColumnUpdate($sqlUpdate, "subDue", $subDuePath);
addColumnUpdate($sqlUpdate, "subInv", $subInvPath);
addColumnUpdate($sqlUpdate, "subAcc", $subAccPath);
addColumnUpdate($sqlUpdate, "subBank", $subBankPath);
addColumnUpdate($sqlUpdate, "subInc", $subIncPath);
addColumnUpdate($sqlUpdate, "subRec", $subRecPath);
addColumnUpdate($sqlUpdate, "subChange", $subChangePath);
addColumnUpdate($sqlUpdate, "subList", $subListPath);
addColumnUpdate($sqlUpdate, "subArt", $subArtPath);
addColumnUpdate($sqlUpdate, "subAudit", $subAuditPath);

// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
  }
}

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "subFinDesc", $subFinDesc, "");
addStatus($sqlUpdate, "subLedgDesc", $subLedgDesc, "");
addStatus($sqlUpdate, "subDueDesc", $subDueDesc, "");
addStatus($sqlUpdate, "subInvDesc", $subInvDesc, "");
addStatus($sqlUpdate, "subAccDesc", $subAccDesc, "");
addStatus($sqlUpdate, "subBankDesc", $subBankDesc, "");
addStatus($sqlUpdate, "subIncDesc", $subIncDesc, "");
addStatus($sqlUpdate, "subRecDesc", $subRecDesc, "");
addStatus($sqlUpdate, "subChangeDesc", $subChangeDesc, "");
addStatus($sqlUpdate, "subListDesc", $subListDesc, "");
addStatus($sqlUpdate, "subArtDesc", $subArtDesc, "");
addStatus($sqlUpdate, "subAuditDesc", $subAuditDesc, "");

$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= "WHERE id = 1";

$updateQuery = mysqli_query($con, $sqlUpdate);

if (!$updateQuery) {
  echo "Error updating record: " . mysqli_error($con);
} else {
  echo "Record updated successfully!";
}

}else{
  $insertSql = "INSERT INTO `bspsub` (`subFin`, `subLedg`, `subDue`, `subInv`, `subAcc`, `subBank`, 
                                    `subInc`, `subRec`, `subChange`, `subList`, `subArt`, `subAudit`) 
                                    VALUES 
                                    ('$subFinPath', '$subLedgPath', '$subDuePath', '$subInvPath', '$subAccPath', '$subBankPath', 
                                    '$subIncPath', '$subRecPath', '$subChangePath', '$subListPath', '$subArtPath', '$subAuditPath')";
  $insertQuery = mysqli_query($con, $insertSql);

  if(!$insertQuery){

    echo("Error Insertion: " . mysqli_error($con));

  }else{
    echo "Inserted Successfully";
  }
}

?>
