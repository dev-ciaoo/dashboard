<?php
include('connection.php');
include('fileUploadBSP.php');


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$offManual = $_POST['offManual'];
$offDetail = $_POST['offDetail'];
$offAcc = $_POST['offAcc'];
$offReg = $_POST['offReg'];
$offManda = $_POST['offManda'];
$offUtil = $_POST['offUtil'];
$offSingle = $_POST['offSingle'];

$offManualDesc = $_POST['offManualDesc'];
$offDetailDesc = $_POST['offDetailDesc'];
$offAccDesc = $_POST['offAccDesc'];
$offRegDesc = $_POST['offRegDesc'];
$offMandaDesc = $_POST['offMandaDesc'];
$offUtilDesc = $_POST['offUtilDesc'];
$offSingleDesc = $_POST['offSingleDesc'];

if(empty($offManualDesc) || $offManualDesc == ""){
  $offManualDesc = " ";
}
if(empty($offDetailDesc) || $offDetailDesc == ""){
  $offDetailDesc = " ";
}
if(empty($offAccDesc) || $offAccDesc == ""){
  $offAccDesc = " ";
}
if(empty($offRegDesc) || $offRegDesc == ""){
  $offRegDesc = " ";
}
if(empty($offMandaDesc) || $offMandaDesc == ""){
  $offMandaDesc = " ";
}
if(empty($offUtilDesc) || $offUtilDesc == ""){
  $offUtilDesc = " ";
}
if(empty($offSingleDesc) || $offSingleDesc == ""){
  $offSingleDesc = " ";
}


// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
$offManualFile = upload_file($_FILES['offManual'], 'bspoffice', $offManual);
$offDetailFile = upload_file($_FILES['offDetail'], 'bspoffice', $offDetail);
$offAccFile = upload_file($_FILES['offAcc'], 'bspoffice', $offAcc);
$offRegFile = upload_file($_FILES['offReg'], 'bspoffice', $offReg);
$offMandaFile = upload_file($_FILES['offManda'], 'bspoffice', $offManda);
$offUtilFile = upload_file($_FILES['offUtil'], 'bspoffice', $offUtil);
$offSingleFile = upload_file($_FILES['offSingle'], 'bspoffice', $offSingle);

$offManualPath = $offManualFile['path'];
$offDetailPath = $offDetailFile['path'];
$offAccPath = $offAccFile['path'];
$offRegPath = $offRegFile['path'];
$offMandaPath = $offMandaFile['path'];
$offUtilPath = $offUtilFile['path'];
$offSinglePath = $offSingleFile['path'];

$sqlSelect = "SELECT * FROM `bspoffice`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if($data){

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE `bspoffice` SET";
// check each data path, If the data path is not empty, it will update

// DATA
addColumnUpdate($sqlUpdate, "offManual", $offManualPath);
addColumnUpdate($sqlUpdate, "offDetail", $offDetailPath);
addColumnUpdate($sqlUpdate, "offAcc", $offAccPath);
addColumnUpdate($sqlUpdate, "offReg", $offRegPath);
addColumnUpdate($sqlUpdate, "offManda", $offMandaPath);
addColumnUpdate($sqlUpdate, "offUtil", $offUtilPath);
addColumnUpdate($sqlUpdate, "offSingle", $offSinglePath);

// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
  }
}

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "offManualDesc", $offManualDesc, "");
addStatus($sqlUpdate, "offDetailDesc", $offDetailDesc, "");
addStatus($sqlUpdate, "offAccDesc", $offAccDesc, "");
addStatus($sqlUpdate, "offRegDesc", $offRegDesc, "");
addStatus($sqlUpdate, "offMandaDesc", $offMandaDesc, "");
addStatus($sqlUpdate, "offUtilDesc", $offUtilDesc, "");
addStatus($sqlUpdate, "offSingleDesc", $offSingleDesc, "");

$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= "WHERE id = 1";

$updateQuery = mysqli_query($con, $sqlUpdate);

if (!$updateQuery) {
  echo "Error updating record: " . mysqli_error($con);
} else {
  echo "Record updated successfully!";
}

}else{
  $insertSql = "INSERT INTO `bspoffice` (`offManual`, `offDetail`, `offAcc`, `offReg`, `offManda`, `offUtil`, `offSingle`) 
                              VALUES 
                                    ('$offManualPath', '$offDetailPath', '$offAccPath', '$offRegPath', '$offMandaPath', '$offUtilPath' , '$offSinglePath')";
  $insertQuery = mysqli_query($con, $insertSql);

  if(!$insertQuery){

    echo("Error Insertion: " . mysqli_error($con));

  }else{
    echo "Inserted Successfully";
  }
}

?>
