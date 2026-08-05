<?php
include('connection.php');
include('fileUploadBSP.php');

date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');

$aamManual = $_POST['aamManual'] ?? '';
$aamList = $_POST['aamList'] ?? '';
$aamAssests = $_POST['aamAssests'] ?? '';
$aamSales = $_POST['aamSales'] ?? '';
$aamSched = $_POST['aamSched'] ?? '';
$aamSched2 = $_POST['aamSched2'] ?? '';

$aamManualDesc = $_POST['aamManualDesc'];
$aamListDesc = $_POST['aamListDesc'];
$aamAssestsDesc = $_POST['aamAssestsDesc'];
$aamSalesDesc = $_POST['aamSalesDesc'];
$aamSchedDesc = $_POST['aamSchedDesc'];
$aamSched2Desc = $_POST['aamSched2Desc'];

if(empty($aamManualDesc) || $aamManualDesc == ""){
  $aamManualDesc = " ";
}

if(empty($aamListDesc) || $aamListDesc == ""){
  $aamListDesc = " ";
}

if(empty($aamAssestsDesc) || $aamAssestsDesc == ""){
  $aamAssestsDesc = " ";
}

if(empty($aamSalesDesc) || $aamSalesDesc == ""){
  $aamSalesDesc = " ";
}

if(empty($aamSchedDesc) || $aamSchedDesc == ""){
  $aamSchedDesc = " ";
}

if(empty($aamSched2Desc) || $aamSched2Desc == ""){
  $aamSched2Desc = " ";
}


// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
// PRINCIPAL BORROWER// Get uploaded file paths
$aamManualFile = upload_file($_FILES['aamManual'] ?? [], 'bspassets', $aamManual);
$aamListFile = upload_file($_FILES['aamList'] ?? [], 'bspassets', $aamList);
$aamAssestsFile = upload_file($_FILES['aamAssests'] ?? [], 'bspassets', $aamAssests);
$aamSalesFile = upload_file($_FILES['aamSales'] ?? [], 'bspassets', $aamSales);
$aamSchedFile = upload_file($_FILES['aamSched'] ?? [], 'bspassets', $aamSched);
$aamSched2File = upload_file($_FILES['aamSched2'] ?? [], 'bspassets', $aamSched2);


// PRINCIPAL BORROWER
$aamManualPath = $aamManualFile['path'];
$aamListPath = $aamListFile['path'];
$aamAssestsPath = $aamAssestsFile['path'];
$aamSalesPath = $aamSalesFile['path'];
$aamSchedPath = $aamSchedFile['path'];
$aamSched2Path = $aamSched2File['path'];

// Check if data already exists in the database
$sqlSelect = "SELECT * FROM `bspassets`";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if ($data) {

  function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
    if (!empty($columnValue)) {
      $sqlUpdate .= " `$columnName` = '$columnValue',";
    }
  }

  $sqlUpdate = "UPDATE `bspassets` SET";
  // check each data path, If the data path is not empty, it will update

  // DATA
  addColumnUpdate($sqlUpdate, "aamManual", $aamManualPath);
  addColumnUpdate($sqlUpdate, "aamList", $aamListPath);
  addColumnUpdate($sqlUpdate, "aamAssests", $aamAssestsPath);
  addColumnUpdate($sqlUpdate, "aamSales", $aamSalesPath);
  addColumnUpdate($sqlUpdate, "aamSched", $aamSchedPath);
  addColumnUpdate($sqlUpdate, "aamSched2", $aamSched2Path);

  // STATUS FUNCTION
  function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
    if (!empty($columnSelect)) {
      $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
    }
  }

  // PRINCIPAL BORROWER
  addStatus($sqlUpdate, "aamManualDesc", $aamManualDesc, "");
  addStatus($sqlUpdate, "aamListDesc", $aamListDesc, "");
  addStatus($sqlUpdate, "aamAssestsDesc", $aamAssestsDesc, "");
  addStatus($sqlUpdate, "aamSalesDesc", $aamSalesDesc, "");
  addStatus($sqlUpdate, "aamSchedDesc", $aamSchedDesc, "");
  addStatus($sqlUpdate, "aamSched2Desc", $aamSched2Desc, "");

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
  $insertSql = "INSERT INTO `bspassets` (`aamManual`, `aamList`, `aamAssests`, `aamSales`, `aamSched`, `aamSched2`    ) 
                      VALUES 
                                        ('$aamManualPath', '$aamListPath', '$aamAssestsPath', '$aamSalesPath', '$aamSchedPath', '$aamSched2Path')";
  $insertQuery = mysqli_query($con, $insertSql);

  if ($insertQuery) {
    echo "Insert successful";
  } else {
    echo "Error: " . mysqli_error($con);
  }
}
?>