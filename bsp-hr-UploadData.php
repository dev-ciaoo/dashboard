<?php
include('connection.php');
include('fileUploadBSP.php');


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$hrSum = $_POST['hrSum'];
$hrCopy = $_POST['hrCopy'];
$hrBoard = $_POST['hrBoard'];
$hrOrg = $_POST['hrOrg'];
$hrOfficer = $_POST['hrOfficer'];
$hrPost = $_POST['hrPost'];
$hrMember = $_POST['hrMember'];
$hrEmp = $_POST['hrEmp'];
$hrDuties = $_POST['hrDuties'];
$hrTrain = $_POST['hrTrain'];
$hrPol = $_POST['hrPol'];

$hrSumDesc = $_POST['hrSumDesc'];
$hrCopyDesc = $_POST['hrCopyDesc'];
$hrBoardDesc = $_POST['hrBoardDesc'];
$hrOrgDesc = $_POST['hrOrgDesc'];
$hrOfficerDesc = $_POST['hrOfficerDesc'];
$hrPostDesc = $_POST['hrPostDesc'];
$hrMemberDesc = $_POST['hrMemberDesc'];
$hrEmpDesc = $_POST['hrEmpDesc'];
$hrDutiesDesc = $_POST['hrDutiesDesc'];
$hrTrainDesc = $_POST['hrTrainDesc'];
$hrPolDesc = $_POST['hrPolDesc'];

if(empty($hrSumDesc) || $hrSumDesc == ""){
  $hrSumDesc = " ";
}
if(empty($hrCopyDesc) || $hrCopyDesc == ""){
  $hrCopyDesc = " ";
}
if(empty($hrBoardDesc) || $hrBoardDesc == ""){
  $hrBoardDesc = " ";
}
if(empty($hrOrgDesc) || $hrOrgDesc == ""){
  $hrOrgDesc = " ";
}
if(empty($hrOfficerDesc) || $hrOfficerDesc == ""){
  $hrOfficerDesc = " ";
}
if(empty($hrPostDesc) || $hrPostDesc == ""){
  $hrPostDesc = " ";
}
if(empty($hrMemberDesc) || $hrMemberDesc == ""){
  $hrMemberDesc = " ";
}
if(empty($hrEmpDesc) || $hrEmpDesc == ""){
  $hrEmpDesc = " ";
}
if(empty($hrDutiesDesc) || $hrDutiesDesc == ""){
  $hrDutiesDesc = " ";
}
if(empty($hrTrainDesc) || $hrTrainDesc == ""){
  $hrTrainDesc = " ";
}
if(empty($hrPolDesc) || $hrPolDesc == ""){
  $hrPolDesc = " ";
}

// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
$hrSumFile = upload_file($_FILES['hrSum'], 'bsphr', $hrSum);
$hrCopyFile = upload_file($_FILES['hrCopy'], 'bsphr', $hrCopy);
$hrBoardFile = upload_file($_FILES['hrBoard'], 'bsphr', $hrBoard);
$hrOrgFile = upload_file($_FILES['hrOrg'], 'bsphr', $hrOrg);
$hrOfficerFile = upload_file($_FILES['hrOfficer'], 'bsphr', $hrOfficer);
$hrPostFile = upload_file($_FILES['hrPost'], 'bsphr', $hrPost);
$hrMemberFile = upload_file($_FILES['hrMember'], 'bsphr', $hrMember);
$hrEmpFile = upload_file($_FILES['hrEmp'], 'bsphr', $hrEmp);
$hrDutiesFile = upload_file($_FILES['hrDuties'], 'bsphr', $hrDuties);
$hrTrainFile = upload_file($_FILES['hrTrain'], 'bsphr', $hrTrain);
$hrPolFile = upload_file($_FILES['hrPol'], 'bsphr', $hrPol);

$hrSumPath = $hrSumFile['path'];
$hrCopyPath = $hrCopyFile['path'];
$hrBoardPath = $hrBoardFile['path'];
$hrOrgPath = $hrOrgFile['path'];
$hrOfficerPath = $hrOfficerFile['path'];
$hrPostPath = $hrPostFile['path'];
$hrMemberPath = $hrMemberFile['path'];
$hrEmpPath = $hrEmpFile['path'];
$hrDutiesPath = $hrDutiesFile['path'];
$hrTrainPath = $hrTrainFile['path'];
$hrPolPath = $hrPolFile['path'];

$sqlSelect = "SELECT * FROM `bsphr`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if($data){

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE `bsphr` SET";
// check each data path, If the data path is not empty, it will update

// DATA
addColumnUpdate($sqlUpdate, "hrSum", $hrSumPath);
addColumnUpdate($sqlUpdate, "hrCopy", $hrCopyPath);
addColumnUpdate($sqlUpdate, "hrBoard", $hrBoardPath);
addColumnUpdate($sqlUpdate, "hrOrg", $hrOrgPath);
addColumnUpdate($sqlUpdate, "hrOfficer", $hrOfficerPath);
addColumnUpdate($sqlUpdate, "hrPost", $hrPostPath);
addColumnUpdate($sqlUpdate, "hrMember", $hrMemberPath);
addColumnUpdate($sqlUpdate, "hrEmp", $hrEmpPath);
addColumnUpdate($sqlUpdate, "hrDuties", $hrDutiesPath);
addColumnUpdate($sqlUpdate, "hrTrain", $hrTrainPath);
addColumnUpdate($sqlUpdate, "hrPol", $hrPolPath);

// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
  }
}

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "hrSumDesc", $hrSumDesc, "");
addStatus($sqlUpdate, "hrCopyDesc", $hrCopyDesc, "");
addStatus($sqlUpdate, "hrBoardDesc", $hrBoardDesc, "");
addStatus($sqlUpdate, "hrOrgDesc", $hrOrgDesc, "");
addStatus($sqlUpdate, "hrOfficerDesc", $hrOfficerDesc, "");
addStatus($sqlUpdate, "hrPostDesc", $hrPostDesc, "");
addStatus($sqlUpdate, "hrMemberDesc", $hrMemberDesc, "");
addStatus($sqlUpdate, "hrEmpDesc", $hrEmpDesc, "");
addStatus($sqlUpdate, "hrDutiesDesc", $hrDutiesDesc, "");
addStatus($sqlUpdate, "hrTrainDesc", $hrTrainDesc, "");
addStatus($sqlUpdate, "hrPolDesc", $hrPolDesc, "");

$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= "WHERE id = 1";

$updateQuery = mysqli_query($con, $sqlUpdate);

if (!$updateQuery) {
  echo "Error updating record: " . mysqli_error($con);
} else {
  echo "Record updated successfully!";
}

}else{
  $insertSql = "INSERT INTO `bsphr` (`hrSum`, `hrCopy`, `hrBoard`, `hrOrg`, `hrOfficer`, `hrPost`, `hrMember`, `hrEmp`, `hrDuties`, `hrTrain`, `hrPol`) 
                              VALUES 
                                    ('$hrSumPath', '$hrCopyPath', '$hrBoardPath', '$hrOrgPath', '$hrOfficerPath', '$hrPostPath' , '$hrMemberPath', '$hrEmpPath', '$hrDutiesPath', '$hrTrainPath', '$hrPolPath')";
  $insertQuery = mysqli_query($con, $insertSql);

  if(!$insertQuery){

    echo("Error Insertion: " . mysqli_error($con));

  }else{
    echo "Inserted Successfully";
  }
}

?>
