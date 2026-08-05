<?php
include('connection.php');
include('fileUploadBSP.php');


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$amlAnti = $_POST['amlAnti'];
$amlCert = $_POST['amlCert'];
$amlList = $_POST['amlList'];
$amlStats = $_POST['amlStats'];

$amlAntiDesc = $_POST['amlAntiDesc'];
$amlCertDesc = $_POST['amlCertDesc'];
$amlListDesc = $_POST['amlListDesc'];
$amlStatsDesc = $_POST['amlStatsDesc'];

if(empty($amlAntiDesc) || $amlAntiDesc == ""){
  $amlAntiDesc = " ";
}
if(empty($amlCertDesc) || $amlCertDesc == ""){
  $amlCertDesc = " ";
}
if(empty($amlListDesc) || $amlListDesc == ""){
  $amlListDesc = " ";
}
if(empty($amlStatsDesc) || $amlStatsDesc == ""){
  $amlStatsDesc = " ";
}

// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
$amlAntiFile = upload_file($_FILES['amlAnti'], 'bspamla', $amlAnti);
$amlCertFile = upload_file($_FILES['amlCert'], 'bspamla', $amlCert);
$amlListFile = upload_file($_FILES['amlList'], 'bspamla', $amlList);
$amlStatsFile = upload_file($_FILES['amlStats'], 'bspamla', $amlStats);

$amlAntiPath = $amlAntiFile['path'];
$amlCertPath = $amlCertFile['path'];
$amlListPath = $amlListFile['path'];
$amlStatsPath = $amlStatsFile['path'];

$sqlSelect = "SELECT * FROM `bspamla`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if($data){

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE `bspamla` SET";
// check each data path, If the data path is not empty, it will update

// DATA
addColumnUpdate($sqlUpdate, "amlAnti", $amlAntiPath);
addColumnUpdate($sqlUpdate, "amlCert", $amlCertPath);
addColumnUpdate($sqlUpdate, "amlList", $amlListPath);
addColumnUpdate($sqlUpdate, "amlStats", $amlStatsPath);
// addColumnUpdate($sqlUpdate, "itStrats", $itStratsPath);

// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
  }
}

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "amlAntiDesc", $amlAntiDesc, "");
addStatus($sqlUpdate, "amlCertDesc", $amlCertDesc, "");
addStatus($sqlUpdate, "amlListDesc", $amlListDesc, "");
addStatus($sqlUpdate, "amlStatsDesc", $amlStatsDesc, "");

$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= "WHERE id = 1";

$updateQuery = mysqli_query($con, $sqlUpdate);

if (!$updateQuery) {
  echo "Error updating record: " . mysqli_error($con);
} else {
  echo "Record updated successfully!";
}

}else{
  $insertSql = "INSERT INTO `bspamla` (`amlAnti`, `amlCert`, `amlList`, `amlStats`) 
                              VALUES 
                                    ('$amlAntiPath', '$amlCertPath', '$amlListPath', '$amlStatsPath')";
  $insertQuery = mysqli_query($con, $insertSql);

  if(!$insertQuery){

    echo("Error Insertion: " . mysqli_error($con));

  }else{
    echo "Inserted Successfully";
  }
}

?>
