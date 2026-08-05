<?php
include('connection.php');
include('fileUploadBSP.php');


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');


$itChart = $_POST['itChart'];
$itDocs = $_POST['itDocs'];
$itBusiness = $_POST['itBusiness'];
$itPlan = $_POST['itPlan'];
$itStrats = $_POST['itStrats'];

$itChartDesc = $_POST['itChartDesc'];
$itDocsDesc = $_POST['itDocsDesc'];
$itBusinessDesc = $_POST['itBusinessDesc'];
$itPlanDesc = $_POST['itPlanDesc'];
$itStratsDesc = $_POST['itStratsDesc'];
$itChartSelect = $_POST['itChartSelect'];

if(empty($itChartDesc) || $itChartDesc == ""){
  $itChartDesc = " ";
}
if(empty($itDocsDesc) || $itDocsDesc == ""){
  $itDocsDesc = " ";
}
if(empty($itBusinessDesc) || $itBusinessDesc == ""){
  $itBusinessDesc = " ";
}
if(empty($itPlanDesc) || $itPlanDesc == ""){
  $itPlanDesc = " ";
}
if(empty($itStratsDesc) || $itStratsDesc == ""){
  $itStratsDesc = " ";
}
if(empty($itChartSelect) || $itChartSelect == ""){
  $itChartSelect = " ";
}

$itChartFile = upload_file($_FILES['itChart'], 'bspit', $itChart);
$itDocsFile = upload_file($_FILES['itDocs'], 'bspit', $itDocs);
$itBusinessFile = upload_file($_FILES['itBusiness'], 'bspit', $itBusiness);
$itPlanFile = upload_file($_FILES['itPlan'], 'bspit', $itPlan);
$itStratsFile = upload_file($_FILES['itStrats'], 'bspit', $itStrats);

$itChartPath = $itChartFile['path'];
$itDocsPath = $itDocsFile['path'];
$itBusinessPath = $itBusinessFile['path'];
$itPlanPath = $itPlanFile['path'];
$itStratsPath = $itStratsFile['path'];

$sqlSelect = "SELECT * FROM bspit";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if($data){

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE bspit SET";
// check each data path, If the data path is not empty, it will update

// DATA
addColumnUpdate($sqlUpdate, "itChart", $itChartPath);
addColumnUpdate($sqlUpdate, "itDocs", $itDocsPath);
addColumnUpdate($sqlUpdate, "itBusiness", $itBusinessPath);
addColumnUpdate($sqlUpdate, "itPlan", $itPlanPath);
addColumnUpdate($sqlUpdate, "itStrats", $itStratsPath);

// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
  }
}

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "itChartDesc", $itChartDesc, "");
addStatus($sqlUpdate, "itDocsDesc", $itDocsDesc, "");
addStatus($sqlUpdate, "itBusinessDesc", $itBusinessDesc, "");
addStatus($sqlUpdate, "itPlanDesc", $itPlanDesc, "");
addStatus($sqlUpdate, "itStratsDesc", $itStratsDesc, "");

$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= "WHERE id = 1";

$updateQuery = mysqli_query($con, $sqlUpdate);


if (!$updateQuery) {
  echo "Error updating record: " . mysqli_error($con);
}else{
  
}

}else{
  $insertSql = "INSERT INTO `bspit` (`itChart`, `itDocs`, `itBusiness`, `itPlan`, `itStrats`) 
                            VALUES 
                                    ('$itChartPath', '$itDocsPath', '$itBusiness', '$itPlan', '$itStratsPath')";
  $insertQuery = mysqli_query($con, $insertSql);
  if(!$insertQuery){
    echo("Error Insertion: " . mysqli_error($con));
  }else{
    
  }
}

?>
