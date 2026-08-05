<?php
include('connection.php');
include('fileUploadBSP.php');


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$legalReg = $_POST['legalReg'];
$legalStats = $_POST['legalStats'];

$legalRegDesc = $_POST['legalRegDesc'];
$legalStatsDesc = $_POST['legalStatsDesc'];

if(empty($legalRegDesc) || $legalRegDesc == ""){
  $legalRegDesc = " ";
}
if(empty($legalStatsDesc) || $legalStatsDesc == ""){
  $legalStatsDesc = " ";
}

// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
$legalRegFile = upload_file($_FILES['legalReg'], 'bsplegal', $legalReg);
$legalStatsFile = upload_file($_FILES['legalStats'], 'bsplegal', $legalStats);

$legalRegPath = $legalRegFile['path'];
$legalStatsPath = $legalStatsFile['path'];

$sqlSelect = "SELECT * FROM `bsplegal`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if($data){

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE `bsplegal` SET";
// check each data path, If the data path is not empty, it will update

// DATA
addColumnUpdate($sqlUpdate, "legalReg", $legalRegPath);
addColumnUpdate($sqlUpdate, "legalStats", $legalStatsPath);

// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
  }
}

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "legalRegDesc", $legalRegDesc, "");
addStatus($sqlUpdate, "legalStatsDesc", $legalStatsDesc, "");

$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= "WHERE id = 1"; 

$updateQuery = mysqli_query($con, $sqlUpdate);

if (!$updateQuery) {
  echo "Error updating record: " . mysqli_error($con);
} else {
  echo "Record updated successfully!";
}

}else{
  $insertSql = "INSERT INTO `bsplegal` (`legalReg`, `legalStats`) 
                              VALUES 
                                        ('$legalRegPath', '$legalStatsPath')";
  $insertQuery = mysqli_query($con, $insertSql);

  if(!$insertQuery){

    echo("Error Insertion: " . mysqli_error($con));

  }else{
    echo "Inserted Successfully";
  }
}

?>
