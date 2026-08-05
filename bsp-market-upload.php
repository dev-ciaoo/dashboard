<?php
include('connection.php');
include('fileUploadBSP.php');

date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$mrkManuals = $_POST['mrkManuals'] ?? '';
$mrkMemo = $_POST['mrkMemo'] ?? '';
$mrkList = $_POST['mrkList'] ?? '';
$mrkDetails = $_POST['mrkDetails'] ?? '';
$mrkRun = $_POST['mrkRun'] ?? '';
$mrkSchedule = $_POST['mrkSchedule'] ?? '';
$mrkBreakdown = $_POST['mrkBreakdown'] ?? '';

$mrkManualsDesc = $_POST['mrkManualsDesc'];
$mrkMemoDesc = $_POST['mrkMemoDesc'];
$mrkListDesc = $_POST['mrkListDesc'];
$mrkDetailsDesc = $_POST['mrkDetailsDesc'];
$mrkRunDesc = $_POST['mrkRunDesc'];
$mrkScheduleDesc = $_POST['mrkScheduleDesc'];
$mrkBreakdownDesc = $_POST['mrkBreakdownDesc'];

if(empty($mrkManualsDesc) || $mrkManualsDesc == ""){
  $mrkManualsDesc = " ";
}
if(empty($mrkMemoDesc) || $mrkMemoDesc == ""){
  $mrkMemoDesc = " ";
}
if(empty($mrkListDesc) || $mrkListDesc == ""){
  $mrkListDesc = " ";
}
if(empty($mrkDetailsDesc) || $mrkDetailsDesc == ""){
  $mrkDetailsDesc = " ";
}
if(empty($mrkRunDesc) || $mrkRunDesc == ""){
  $mrkRunDesc = " ";
}
if(empty($mrkScheduleDesc) || $mrkScheduleDesc == ""){
  $mrkScheduleDesc = " ";
}
if(empty($mrkBreakdownDesc) || $mrkBreakdownDesc == ""){
  $mrkBreakdownDesc = " ";
}

// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
// PRINCIPAL BORROWER// Get uploaded file paths
$mrkManualsFile = upload_file($_FILES['mrkManuals'] ?? [], 'bspmarket', $mrkManuals);
$mrkMemoFile = upload_file($_FILES['mrkMemo'] ?? [], 'bspmarket', $mrkMemo);
$mrkListFile = upload_file($_FILES['mrkList'] ?? [], 'bspmarket', $mrkList);
$mrkDetailsFile = upload_file($_FILES['mrkDetails'] ?? [], 'bspmarket', $mrkDetails);
$mrkRunFile = upload_file($_FILES['mrkRun'] ?? [], 'bspmarket', $mrkRun);
$mrkScheduleFile = upload_file($_FILES['mrkSchedule'] ?? [], 'bspmarket', $mrkSchedule);
$mrkBreakdownFile = upload_file($_FILES['mrkBreakdown'] ?? [], 'bspmarket', $mrkBreakdown);

// PRINCIPAL BORROWER
$mrkManualsPath = $mrkManualsFile['path'];
$mrkMemoPath = $mrkMemoFile['path'];
$mrkListPath = $mrkListFile['path'];
$mrkDetailsPath = $mrkDetailsFile['path'];
$mrkRunPath = $mrkRunFile['path'];
$mrkSchedulePath = $mrkScheduleFile['path'];
$mrkBreakdownPath = $mrkBreakdownFile['path'];

// Check if data already exists in the database
$sqlSelect = "SELECT * FROM `bspmarket`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if ($data) {

  function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
    if (!empty($columnValue)) {
      $sqlUpdate .= " `$columnName` = '$columnValue',";
    }
  }

  $sqlUpdate = "UPDATE `bspmarket` SET";
  // check each data path, If the data path is not empty, it will update

  // DATA
  addColumnUpdate($sqlUpdate, "mrkManuals", $mrkManualsPath);
  addColumnUpdate($sqlUpdate, "mrkMemo", $mrkMemoPath);
  addColumnUpdate($sqlUpdate, "mrkList", $mrkListPath);
  addColumnUpdate($sqlUpdate, "mrkDetails", $mrkDetailsPath);
  addColumnUpdate($sqlUpdate, "mrkRun", $mrkRunPath);
  addColumnUpdate($sqlUpdate, "mrkSchedule", $mrkSchedulePath);
  addColumnUpdate($sqlUpdate, "mrkBreakdown", $mrkBreakdownPath);

  // STATUS FUNCTION
  function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
    if (!empty($columnSelect)) {
      $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
    }
  }

  // PRINCIPAL BORROWER
  addStatus($sqlUpdate, "mrkManualsDesc", $mrkManualsDesc, "");
  addStatus($sqlUpdate, "mrkListDesc", $mrkListDesc, "");
  addStatus($sqlUpdate, "mrkMemoDesc", $mrkMemoDesc, "");
  addStatus($sqlUpdate, "mrkDetailsDesc", $mrkDetailsDesc, "");
  addStatus($sqlUpdate, "mrkRunDesc", $mrkRunDesc, "");
  addStatus($sqlUpdate, "mrkScheduleDesc", $mrkScheduleDesc, "");
  addStatus($sqlUpdate, "mrkBreakdownDesc", $mrkBreakdownDesc, "");

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
  $insertSql = "INSERT INTO `bspmarket` (`mrkManuals`, `mrkMemo`, `mrkList`, `mrkDetails`, `mrkRun`, `mrkSchedule`, `mrkBreakdown`) 
  VALUES ('$mrkManualsPath', '$mrkMemoPath', '$mrkListPath', '$mrkDetailsPath', '$mrkRunPath', '$mrkSchedulePath', '$mrkBreakdownPath')";
  $insertQuery = mysqli_query($con, $insertSql);

  if ($insertQuery) {
    echo "Insert successful";
  } else {
    echo "Error: " . mysqli_error($con);
  }
}
?>