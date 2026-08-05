<?php
include('connection.php');
include('fileUploadBSP.php');


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$audManual = $_POST['audManual'];
$audList = $_POST['audList'];
$audPlan = $_POST['audPlan'];
$audReport = $_POST['audReport'];
$audOut = $_POST['audOut'];

$audManualDesc = $_POST['audManualDesc'];
$audListDesc = $_POST['audListDesc'];
$audPlanDesc = $_POST['audPlanDesc'];
$audReportDesc = $_POST['audReportDesc'];
$audOutDesc = $_POST['audOutDesc'];

if(empty($audManualDesc) || $audManualDesc == "") { 
  $audManualDesc = " ";
}
if(empty($audListDesc) || $audListDesc == "") { 
  $audListDesc = " ";
}
if(empty($audPlanDesc) || $audPlanDesc == "") { 
  $audPlanDesc = " ";
}
if(empty($audReportDesc) || $audReportDesc == "") { 
  $audReportDesc = " ";
}
if(empty($audOutDesc) || $audOutDesc == "") { 
  $audOutDesc = " ";
}

// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
$audManualFile = upload_file($_FILES['audManual'], 'bspaudit', $audManual);
$audListFile = upload_file($_FILES['audList'], 'bspaudit', $audList);
$audPlanFile = upload_file($_FILES['audPlan'], 'bspaudit', $audPlan);
$audReportFile = upload_file($_FILES['audReport'], 'bspaudit', $audReport);
$audOutFile = upload_file($_FILES['audOut'], 'bspaudit', $audOut);

$audManualPath = $audManualFile['path'];
$audListPath = $audListFile['path'];
$audPlanPath = $audPlanFile['path'];
$audReportPath = $audReportFile['path'];
$audOutPath = $audOutFile['path'];

$sqlSelect = "SELECT * FROM `bspaudit`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if($data){

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE `bspaudit` SET";
// check each data path, If the data path is not empty, it will update

// DATA
addColumnUpdate($sqlUpdate, "audManual", $audManualPath);
addColumnUpdate($sqlUpdate, "audList", $audListPath);
addColumnUpdate($sqlUpdate, "audPlan", $audPlanPath);
addColumnUpdate($sqlUpdate, "audReport", $audReportPath);
addColumnUpdate($sqlUpdate, "audOut", $audOutPath);

// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
  }
}

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "audManualDesc", $audManualDesc, "");
addStatus($sqlUpdate, "audListDesc", $audListDesc, "");
addStatus($sqlUpdate, "audPlanDesc", $audPlanDesc, "");
addStatus($sqlUpdate, "audReportDesc", $audReportDesc, "");
addStatus($sqlUpdate, "audOutDesc", $audOutDesc, "");

$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= "WHERE id = 1";

$updateQuery = mysqli_query($con, $sqlUpdate);

if (!$updateQuery) {
  echo "Error updating record: " . mysqli_error($con);
} else {
  echo "Record updated successfully!";
}

}else{
  $insertSql = "INSERT INTO `bspaudit` (`audManual`, `audList`, `audPlan`, `audReport`, `audOut`) 
                              VALUES 
                                    ('$audManualPath', '$audListPath', '$audPlanPath', '$audReportPath', '$audOutPath')";
  $insertQuery = mysqli_query($con, $insertSql);

  if(!$insertQuery){

    echo("Error Insertion: " . mysqli_error($con));

  }else{
    echo "Inserted Successfully";
  }
}

?>
