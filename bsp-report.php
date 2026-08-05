<?php
include('connection.php');
// FOR IT
$sql = "SELECT * FROM `bspit`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();
    
    // Assigning values to variables
    $itChart = $row['itChart'];
    $itDocs = $row['itDocs'];
    $itBusiness = $row['itBusiness'];
    $itPlan = $row['itPlan'];
    $itStrats = $row['itStrats'];

    $itChartDesc = $row['itChartDesc'];
    $itDocsDesc = $row['itDocsDesc'];
    $itBusinessDesc = $row['itBusinessDesc'];
    $itPlanDesc = $row['itPlanDesc'];
    $itStratsDesc = $row['itStratsDesc'];
} else {
    //echo "<tr><td>No files uploaded yet.</td></tr>";
}
//GENERAL INFORMATION
$sql = "SELECT * FROM `bspgen`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();
    
    // Assigning values to variables
    $genStock = $row['genStock'];
    $genComm = $row['genComm'];
    $genRecent = $row['genRecent'];
    $genMin = $row['genMin'];
    $genStrat = $row['genStrat'];
    $genList = $row['genList'];
    $genLease = $row['genLease'];
    $genInsurance = $row['genInsurance'];
    $genReports = $row['genReports'];
    $genCorr = $row['genCorr'];
    $genAct = $row['genAct'];
    $genCredit = $row['genCredit'];
    $genFolder = $row['genFolder'];
    $genInvent = $row['genInvent'];
    $genReview1 = $row['genReview1'];
    $genReview2 = $row['genReview2'];
    $genReview3 = $row['genReview3'];
    $genReview4 = $row['genReview4'];
    $genReview5 = $row['genReview5'];
    $genReview6 = $row['genReview6'];
    $genReview7 = $row['genReview7'];
    $genReview8 = $row['genReview8'];
    $genReview9 = $row['genReview9'];
    $genReview10 = $row['genReview10'];


    


    $genStockDesc = $row['genStockDesc'];
    $genCommDesc = $row['genCommDesc'];
    $genRecentDesc = $row['genRecentDesc'];
    $genMinDesc	 = $row['genMinDesc	'];
    $genStratDesc = $row['genStratDesc'];
    $genListDesc = $row['genListDesc'];
    $genLeaseDesc = $row['genLeaseDesc'];
    $genInsuranceDesc = $row['genInsuranceDesc'];
    $genReportsDesc = $row['genReportsDesc'];
    $genCorrDesc = $row['genCorrDesc'];
    $genActDesc = $row['genActDesc'];
    $genCreditDesc = $row['genCreditDesc'];
    $genFolderDesc = $row['genFolderDesc'];
    $genInventDesc = $row['genInventDesc'];
    $genReview1Desc = $row['genReview1Desc'];
    $genReview2Desc = $row['genReview2Desc'];
    $genReview3Desc = $row['genReview3Desc'];
    $genReview4Desc = $row['genReview4Desc'];
    $genReview5Desc = $row['genReview5Desc'];
    $genReview6Desc = $row['genReview6Desc'];
    $genReview7Desc = $row['genReview7Desc'];
    $genReview8Desc = $row['genReview8Desc'];
    $genReview9Desc = $row['genReview9Desc'];
    $genReview10Desc = $row['genReview10Desc'];
} else {
    echo "<tr><td>No files uploaded yet.</td></tr>";
}

//FOR SUBMISSION
$sql = "SELECT * FROM `bspsub`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $subFin	 = $row['subFin'];
    $subLedg = $row['subLedg'];
    $subDue = $row['subDue'];
    $subInv = $row['subInv'];
    $subAcc = $row['subAcc'];
    $subBank = $row['subBank'];
    $subInc = $row['subInc'];
    $subRec = $row['subRec'];
    $subChange = $row['subChange'];
    $subList = $row['subList'];
    $subArt = $row['subArt']; 
    $subAudit = $row['subAudit']; 

    $subFinDesc	 = $row['subFinDesc'];
    $subLedgDesc = $row['subLedgDesc'];
    $subDueDesc = $row['subDueDesc'];
    $subInvDesc = $row['subInvDesc'];
    $subAccDesc	 = $row['subAccDesc'];
    $subBankDesc = $row['subBankDesc'];
    $subIncDesc = $row['subIncDesc'];
    $subRecDesc = $row['subRecDesc'];
    $subChangeDesc	 = $row['subChangeDesc'];
    $subListDesc = $row['subListDesc'];
    $subArtDesc = $row['subArtDesc']; 
    $subAuditDesc = $row['subAuditDesc']; 


} else {
   // echo "<tr><td>No files uploaded yet.</td></tr>";
}

//FOR LENDING/CREDIT RISK
$sql = "SELECT * FROM `bsplending`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $lendProcess = $row['lendProcess'];
    $lendCredit = $row['lendCredit'];
    $lendManagement = $row['lendManagement'];
    $lendSummary = $row['lendSummary'];
    $lendCopy = $row['lendCopy'];
    $lendSummary2 = $row['lendSummary2'];
    $lendSched = $row['lendSched'];
    $lendList = $row['lendList'];
    $lendLoan = $row['lendLoan'];
    $lendProcess2 = $row['lendProcess2'];
    $lendAging = $row['lendAging'];
    $lendSched2 = $row['lendSched2'];
    $lendOther = $row['lendOther'];
    $lendLoan2 = $row['lendLoan2'];
    $lendSummary3 = $row['lendSummary3'];
    $lendClass = $row['lendClass'];

    $lendProcessDesc = $row['lendProcessDesc'];
    $lendCreditDesc = $row['lendCreditDesc'];
    $lendManagementDesc = $row['lendManagementDesc'];
    $lendSummaryDesc = $row['lendSummaryDesc'];
    $lendCopyDesc = $row['lendCopyDesc'];
    $lendSummary2Desc = $row['lendSummary2Desc'];
    $lendSchedDesc = $row['lendSchedDesc'];
    $lendListDesc = $row['lendListDesc'];
    $lendLoanDesc = $row['lendLoanDesc'];
    $lendProcess2Desc = $row['lendProcess2Desc'];
    $lendAgingDesc = $row['lendAgingDesc'];
    $lendSched2Desc = $row['lendSched2Desc'];
    $lendOtherDesc = $row['lendOtherDesc'];
    $lendLoan2Desc = $row['lendLoan2Desc'];
    $lendSummary3Desc = $row['lendSummary3Desc'];
    $lendClassDesc = $row['lendClassDesc'];
} else {
    //echo "<tr><td>No files uploaded yet.</td></tr>";
}

//FOR AAMandRM
$sql = "SELECT * FROM `bspassets`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $aamManual = $row['aamManual'];
    $aamList = $row['aamList'];
    $aamAssests = $row['aamAssests'];
    $aamSales = $row['aamSales'];
    $aamSched = $row['aamSched'];
    $aamSched2 = $row['aamSched2'];

    $aamManualDesc = $row['aamManualDesc'];
    $aamListDesc = $row['aamListDesc'];
    $aamAssestsDesc = $row['aamAssestsDesc'];
    $aamSalesDesc = $row['aamSalesDesc'];
    $aamSchedDesc = $row['aamSchedDesc'];
    $aamSched2Desc = $row['aamSched2Desc'];
    
} else {
   // echo "<tr><td>No files uploaded yet.</td></tr>";
}

//For Market

$sql = "SELECT * FROM `bspmarket` WHERE id = 1";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        // You can access all columns of each row using $row['column_name']
        $mrkManuals = $row['mrkManuals'];
        $mrkList = $row['mrkList'];
        $mrkMemo = $row['mrkMemo'];
        $mrkDetails = $row['mrkDetails'];
        $mrkRun = $row['mrkRun'];
        $mrkSchedule = $row['mrkSchedule'];
        $mrkBreakdown = $row['mrkBreakdown'];

        // Similarly, access corresponding description columns if needed
        $mrkManualsDesc = $row['mrkManualsDesc'];
        $mrkListDesc = $row['mrkListDesc'];
        $mrkMemoDesc = $row['mrkMemoDesc'];
        $mrkDetailsDesc = $row['mrkDetailsDesc'];
        $mrkRunDesc = $row['mrkRunDesc'];
        $mrkScheduleDesc = $row['mrkScheduleDesc'];
        $mrkBreakdownDesc = $row['mrkBreakdownDesc'];

        // Process or display data as needed
        
    }
} else {
    // No rows found
}

//FOR Human Resource Management
$sql = "SELECT * FROM `bsphr`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $hrSum	 = $row['hrSum'];
    $hrCopy	 = $row['hrCopy'];
    $hrBoard = $row['hrBoard'];
    $hrOrg	 = $row['hrOrg'];
    $hrOfficer	 = $row['hrOfficer'];
    $hrPost	 = $row['hrPost'];
    $hrMember	 = $row['hrMember'];
    $hrEmp	 = $row['hrEmp'];
    $hrDuties	 = $row['hrDuties'];
    $hrTrain	 = $row['hrTrain'];
    $hrPol	 = $row['hrPol'];

    $hrSumDesc	 = $row['hrSumDesc'];
    $hrCopyDesc	 = $row['hrCopyDesc'];
    $hrBoardDesc	 = $row['hrBoardDesc'];
    $hrOrgDesc	 = $row['hrOrgDesc'];
    $hrOfficerDesc	 = $row['hrOfficerDesc'];
    $hrPostDesc	 = $row['hrPostDesc'];
    $hrMemberDesc	 = $row['hrMemberDesc'];
    $hrEmpDesc	 = $row['hrEmpDesc'];
    $hrDutiesDesc = $row['hrDutiesDesc'];
    $hrTrainDesc = $row['hrTrainDesc'];
    $hrPolDesc = $row['hrPolDesc'];

} else {
   // echo "<tr><td>No files uploaded yet.</td></tr>";
}


//FOR Legal Management
$sql = "SELECT * FROM `bsplegal`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $legalReg = $row['legalReg'];
    $legalStats = $row['legalStats'];

    $legalRegDesc = $row['legalRegDesc'];
    $legalStatsDesc = $row['legalStatsDesc'];
    
} else {
  //  echo "<tr><td>No files uploaded yet.</td></tr>";
}


//FOR Internal Audit
$sql = "SELECT * FROM `bspaudit`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $audManual = $row['audManual'];
    $audList = $row['audList'];
    $audPlan = $row['audPlan'];
    $audReport = $row['audReport'];
    $audOut = $row['audOut'];


    $audManualDesc = $row['audManualDesc'];
    $audListDesc = $row['audListDesc'];
    $audPlanDesc = $row['audPlanDesc'];
    $audReportDesc = $row['audReportDesc'];
    $audOutDesc = $row['audOutDesc'];
    
} else {
    echo "<tr><td>No files uploaded yet.</td></tr>";
}

//FOR COMPLIANCE OFFICE
$sql = "SELECT * FROM `bspoffice`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $offManual = $row['offManual'];
    $offDetail = $row['offDetail'];
    $offAcc = $row['offAcc'];
    $offReg = $row['offReg'];
    $offManda = $row['offManda'];
    $offUtil = $row['offUtil'];
    $offSingle = $row['offSingle'];


    $offManualDesc = $row['offManualDesc'];
    $offDetailDesc = $row['offDetailDesc'];
    $offAccDesc = $row['offAccDesc'];
    $offRegDesc = $row['offRegDesc'];
    $offMandaDesc = $row['offMandaDesc'];
    $offUtilDesc = $row['offUtilDesc'];
    $offSingleDesc = $row['offSingleDesc'];
    
} else {
   // echo "<tr><td>No files uploaded yet.</td></tr>";
}
//FOR AMLA
$sql = "SELECT * FROM `bspamla`";
$result = $con->query($sql);

if (!$result) {
    // Handle query error
    die("Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Fetching only the first row (assuming you only need one)
    $row = $result->fetch_assoc();

    $amlAnti = $row['amlAnti'];
    $amlCert = $row['amlCert'];
    $amlList = $row['amlList'];
    $amlStats = $row['amlStats'];

    $amlAntiDesc = $row['amlAntiDesc'];
    $amlCertDesc = $row['amlCertDesc'];
    $amlListDesc = $row['amlListDesc'];
    $amlStatsDesc = $row['amlStatsDesc'];
    
} else {
  //  echo "<tr><td>No files uploaded yet.</td></tr>";
}


function extractFileName1($filePath, $maxLength) {
    // Split the file path by hyphen or underscore and get the last part
    $parts = preg_split('/[-_]/', $filePath);
    $fileName = end($parts);

    // Check if the file name length exceeds the maximum length
    if (strlen($fileName) > $maxLength) {
        // Truncate the file name and append ellipsis
        $fileName = substr($fileName, 0, $maxLength - 3) . '...';
    }

    return $fileName;
}


function extractFileName2($filePath, $maxLength) {
    // Split the file path by underscore and get the last part
    $parts = explode('_', $filePath);
    $fileName = end($parts);
    
    // Check if the file name length exceeds the maximum length
    if (strlen($fileName) > $maxLength) {
        // Truncate the file name and append ellipsis
        $fileName = substr($fileName, 0, $maxLength - 3) . '...';
    }
    
    return $fileName;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="./css/dash.css">
  <!-- <link rel="stylesheet" href="css/styleloan.css"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

</head>

<style>
    h3{
      font-family: "Source Sans Pro", sans-serif;
      color: #656565;
      margin: 30px 0 20px;
      position: relative;
      text-align: center;
      float: center;
    }


    /* CHECK IMAGE */
img[src='statusImage/check.png'] {
  width: 23px;
  height: 23px;
  display:inline-block;
  vertical-align: top;
}
/* XMARK IMAGE */
img[src='statusImage/xmark.png'] {
  width: 23px;
  height: 23px;
  /* visibility: hidden; */
  display:inline-block;
  vertical-align: top;
}

    .pagination {
        display: inline-block;
        position: relative;
        float: right;
    }
    
    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
    }
    
    .pagination a.active {
        background-color: #0d6efd;
        color: white;
        border: 1px solid #0d6efd;
    }
    
    .pagination a:hover:not(.active) {background-color: #ddd;}

    .col-sm-2, .col-sm-4 {
        font-size: 12px;
    }

    

</style>

  
<body oncontextmenu="return false;">
<button class="btn btn-secondary btn-md btnBack">Back</button>  
    <div id="items" class="mb-5 container">
    <div>
        <div><h3>GENERAL INFORMATION</h3></div>
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
              
                <th style="text-align: center;">File Name</th>
                <th style="text-align: center;">Remarks</th>
                <th style="text-align: center;">Submitted</th>
            </tr>
            </thead>    
            <tbody>
                <tr>
                    <td class="table-dark" colspan="3">
                        1. Stock and Transfer Book
                        <br>&nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong>
                    </td>
                    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genStock != '' AND genStock IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genStock = $row1['genStock'];
            $genStockDesc = $row1['genStockDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
         
            echo '<td class="col-sm-3" style="text-align: left;">'. extractFileName1($genStock,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genStockDesc . '</td>';
            echo '<td  class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genStock ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
                </tr>
                <tr>
    <td class="table-dark"colspan="3" >
        2. Committee charters, members of all existing committees and reports of each committee from previous examination reference date to latest available
        <br>&nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong>
    </td>

    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genComm != '' AND genComm IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genComm = $row1['genComm'];
            $genCommDesc = $row1['genCommDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
         
            echo '<td class="col-sm-3" style="text-align: left;">'. extractFileName1($genComm,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genCommDesc . '</td>';
            echo '<td  class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genComm ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<td class="table-dark" colspan="3">
3. Recent biographical data of directors and key officers as well as the job descriptions of all key officers 
<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
</td>
<?php 
    $sql1 = "SELECT * FROM bspgen WHERE genRecent != '' AND genRecent IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genRecent = $row1['genRecent'];
            $genRecentDesc = $row1['genRecentDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">'. extractFileName1($genRecent,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genRecentDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genRecent ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
<td class="table-dark" colspan="3">
    4. Minutes of Board, Stockholders and Committee, meetings from 01 July 2020 to the latest available, including information packages presented to them 
    <br>&nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong>
</td>
<?php 
    $sql1 = "SELECT * FROM bspgen WHERE genMin != '' AND genMin IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genMin = $row1['genMin'];
            $genMinDesc = $row1['genMinDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genMin,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genMinDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genMin ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
<td colspan="3" class="table-dark">
5. Strategic business plans and previous and current years financial projections/budgets
</td>
<?php 
    $sql1 = "SELECT * FROM bspgen WHERE genStrat != '' AND genStrat IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genStrat = $row1['genStrat'];
            $genStratDesc = $row1['genStratDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genStrat,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genStratDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genStrat ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    6. List of all Outsourced and Insourced Services of the Bank and Outsourcing Contracts/Service Agreements
    <br>&nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genList != '' AND genList IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genList = $row1['genList'];
            $genListDesc = $row1['genListDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genList,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genListDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genList ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    7. Lease contracts of bank premises, if any
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genLease != '' AND genLease IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genLease = $row1['genLease'];
            $genLeaseDesc = $row1['genLeaseDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genLease,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genLeaseDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genLease ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    8. Insurance policies and fidelity bonds on cash (including cash transfers), properties and indemnities
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genInsurance != '' AND genInsurance IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genInsurance = $row1['genInsurance'];
            $genInsuranceDesc = $row1['genInsuranceDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genInsurance,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genInsuranceDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genInsurance ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    9. Reports on crimes and losses from 01 July 2020 to latest available, if any
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReport != '' AND genReport IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReport = $row1['genReport'];
            $genReportDesc = $row1['genReportDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReport,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReportDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReport ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    10. Correspondence files/letters between the Bank and other regulatory agencies such as Philippine Deposit Insurance Corporation (PDIC), Bureau of Internal Revenue (BIR), etc.
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes) </strong>
</td>
<?php 
    $sql1 = "SELECT * FROM bspgen WHERE genCorr != '' AND genCorr IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genCorr = $row1['genCorr'];
            $genCorrDesc = $row1['genCorrDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genCorr,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genCorrDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genCorr ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    11. Actuarial Valuation Report
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genAct != '' AND genAct IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genAct = $row1['genAct'];
            $genActDesc = $row1['genActDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genAct,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genActDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genAct ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
    ?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    12. Credit folders of top 20 borrowers (additional credit folders will be requested during the conduct of the regular examination)
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genCredit != '' AND genCredit IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genCredit = $row1['genCredit'];
            $genCreditDesc = $row1['genCreditDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genCredit,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genCreditDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genCredit ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    13. Folders of all ROPA and SCR, if any
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genFolder != '' AND genFolder IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genFolder = $row1['genFolder'];
            $genFolderDesc = $row1['genFolderDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genFolder,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genFolderDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genFolder ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    14. Inventory/List of existing Manual, Policies and Procedures (please indicate the latest date when updates were made and the date and number of Board Resolution)
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genInvent != '' AND genInvent IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genInvent = $row1['genInvent'];
            $genInventDesc = $row1['genInventDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genInvent,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genInventDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genInvent ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    <strong>Also, please make the following available for review during the examination:</strong>
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Christine Diane Alegre)</strong>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;a. Acquired Assets Management and Remedial Mangement Policies and Procedures.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview1 != '' AND genReview1 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview1 = $row1['genReview1'];
            $genReview1Desc = $row1['genReview1Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview1,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview1Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview1 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;b. Code of Ethics/Conduct for Board of Directors, Senior Management and Employees.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview2 != '' AND genReview2 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview2 = $row1['genReview2'];
            $genReview2Desc = $row1['genReview2Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview2,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview2Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview2 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;c. Human Resources Management Manual, including fringe benefits and retirement program.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview3 != '' AND genReview3 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview3 = $row1['genReview3'];
            $genReview3Desc = $row1['genReview3Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview3,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview3Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview3 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;d. Succession Plan.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview4 != '' AND genReview4 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview4 = $row1['genReview4'];
            $genReview4Desc = $row1['genReview4Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview4,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview4Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview4 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;e. Manual of Operations.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview5 != '' AND genReview5 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview5 = $row1['genReview5'];
            $genReview5Desc = $row1['genReview5Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview5,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview5Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview5 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;f. Internal Control System/Manual.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview6 != '' AND genReview6 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview6 = $row1['genReview6'];
            $genReview6Desc = $row1['genReview6Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview6,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview6Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview6 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
    <td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;g. Risk Management System/Manual.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview7 != '' AND genReview7 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview7 = $row1['genReview7'];
            $genReview7Desc = $row1['genReview7Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview7,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview7Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview7 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;h. Security Manual.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview8 != '' AND genReview8 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview8 = $row1['genReview8'];
            $genReview8Desc = $row1['genReview8Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview8,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview8Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview8 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;i. Internal Audit Manuals/Programs/Plan/Charter.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview9 != '' AND genReview9 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview9 = $row1['genReview9'];
            $genReview9Desc = $row1['genReview9Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview9,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview9Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview9 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark">
    &nbsp;&nbsp;&nbsp;j. Compliance Program and list of updates from 01 January 2022 to latest available.
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspgen WHERE genReview10 != '' AND genReview10 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $genReview10 = $row1['genReview10'];
            $genReview10Desc = $row1['genReview10Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($genReview10,100) . '</td>';
            echo '<td class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $genReview10Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($genReview10 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
                </tr>
            </tbody>
        </table>  
</div>
<div>
<div><h3>FOR SUBMISSION</h3></div>
<br>
    <table class ="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">File Name</th>
                <th scope="col" style="text-align: center;">Remarks</th>
                <th scope="col" style="text-align: center;">Submitted</th>
            </tr>
        </thead>
        <tbody>
<tr>
    <td colspan="3" class="table-dark col-sm-6">
    1. General Financial Reports and Details of Accounts for submission (certified digital copy and excel copy)
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
                <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subFin != '' AND subFin IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subFin = $row1['subFin'];
            $subFinDesc = $row1['subFinDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subFin,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subFinDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subFin ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark col-sm-6">
    2. General ledger trial balances as of 31 December 2023, 31 December 2022, 31 December 2021 and 31 March 2024.
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subLedg != '' AND subLedg IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subLedg = $row1['subLedg'];
            $subLedgDesc = $row1['subLedgDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subLedg,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subLedgDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subLedg ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan="3" class="table-dark col-sm-6">
    3. Schedule of Due from BSP and Due from Other Banks
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subDue != '' AND subDue IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subDue = $row1['subDue'];
            $subDueDesc = $row1['subDueDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subDue,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subDueDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subDue ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
    <td colspan = "3" class="table-dark">
    4. Schedule of Investments in Securities/Other Investments with supporting documents.
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subInv != '' AND subInv IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subInv = $row1['subInv'];
            $subInvDesc = $row1['subInvDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subInv,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subInvDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subInv ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    5. Schedules of the following accounts (breakdown of details: date booked, nature, counterparty and amount) 
    and supply aging report as of 31 March 2024, as applicable:
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subAcc != '' AND subAcc IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subAcc = $row1['subAcc'];
            $subAccDesc = $row1['subAccDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subAcc,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subAccDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subAcc ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    6. Schedule of Bank premises, furniture, fixture and equipment with copies of proof of ownership e.g. TCT, OR/CR, etc.
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subBank != '' AND subBank IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subBank = $row1['subBank'];
            $subBankDesc = $row1['subBankDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subBank,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subBankDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subBank ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    7.  Schedule of the following Income and Expense Accounts for the period ended 31 March 2024, 
    and immediately preceding 3 year-ends, as applicable:
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subInc != '' AND subInc IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subInc = $row1['subInc'];
            $subIncDesc = $row1['subIncDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subInc,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subIncDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subInc ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    8. Reconciiation statements
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subRec != '' AND subRec IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subRec = $row1['subRec'];
            $subRecDesc = $row1['subRecDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subRec,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subRecDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subRec ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
9. Statement of Changes in Retaine Earnings from 01 January 2022 to lates available
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subChange != '' AND subChange IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subChange = $row1['subChange'];
            $subChangeDesc = $row1['subChangeDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subChange,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subChangeDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subChange ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
10. Comparative List of Stockholdings (01 January 2022 and 31 March 2024)
<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subList != '' AND subList IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subList = $row1['subList'];
            $subListDesc = $row1['subListDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subList,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subListDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subList ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
11. Articles of Incorporation and By-Laws, including documents regarding amendments, if any.
<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspsub WHERE subArt != '' AND subArt IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subArt = $row1['subArt'];
            $subArtDesc = $row1['subArtDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subArt,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subArtDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subArt ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
12. Latest Audited Financial Statements including management letter/letter of comments, if any, and reconciliation of audited financial 
statements with consolidated statement of condition/consolidated income and expense/financial reporting package and adjusting entries recommended by the external auditor
<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
</td>
<?php 
    $sql1 = "SELECT * FROM bspsub WHERE subAudit != '' AND subAudit IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $subAudit = $row1['subAudit'];
            $subAuditDesc = $row1['subAuditDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName2($subAudit,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $subAuditDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($subAudit ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <div><h3>LENDING/CREDIT RISK</h3></div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">File Name</th>
                <th scope="col" style="text-align: center;">Remarks</th>
                <th scope="col" style="text-align: center;">Submitted</th>
            </tr>
        </thead>
        <tbody>
<tr>
<td colspan = "3" class="table-dark">
1. Process flow (flow chart) of lending activities from initiation to payment/renewal/other remedial actions. 
Schedule a presentation/walk-through of the process (preferably 3rd day of examination).
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
</td>
<?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendProcess != '' AND lendProcess IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendProcess = $row1['lendProcess'];
            $lendProcessDesc = $row1['subAuditDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendProcess,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendProcessDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendProcess ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    2. Credit Policy Manual (including Loan Quality Review, Loan Loss Provisioning and Internal credit 
    risk rating guidelines including rating factors)
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendCredit != '' AND lendCredit IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendCredit = $row1['lendCredit'];
            $lendCreditDesc = $row1['lendCreditDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendCredit,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendCreditDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendCredit ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>   
<tr>
<td colspan = "3" class="table-dark">
    3. Management report on loan portfolio and credit risk
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendManagement != '' AND lendManagement IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendManagement = $row1['lendManagement'];
            $lendManagementDesc = $row1['lendManagementDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendManagement,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendManagementDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendManagement ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>   
<tr>
<td colspan = "3" class="table-dark">
    4. Summary of changes to the bank’s credit policies and procedures, if any, since 01 July 2020
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendSummary != '' AND lendSummary IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendSummary = $row1['lendSummary'];
            $lendSummaryDesc = $row1['lendSummaryDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendSummary,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendSummaryDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendSummary ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>  
<tr>
   <td colspan = "3" class="table-dark">
    5. Copy of credit approval and signing authority of officers or committee(s)
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendCopy != '' AND lendCopy IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendCopy = $row1['lendCopy'];
            $lendCopyDesc = $row1['lendCopyDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendCopy,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendCopyDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendCopy ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>  
<tr>
<td colspan = "3" class="table-dark">
    6. Summary of any new loan products launched since 01 July 2020, if any
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendSummary2 != '' AND lendSummary2 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendSummary2 = $row1['lendSummary2'];
            $lendSummary2Desc = $row1['lendSummary2Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendSummary2,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendSummary2Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendSummary2 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>  
<tr>
<td colspan = "3" class="table-dark">
    7. Schedule of Loan Portfolio (loans and receivables, restructured loans) of all branches, OBOs and Head Office as of 31 March 2024 – 
    gross and net of Unearned Interest Discount, Service Charges and other amortized lending costs
    Suggested Column Headings (information required):
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendSched != '' AND lendSched IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendSched = $row1['lendSched'];
            $lendSchedDesc = $row1['lendSchedDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendSched,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendSchedDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendSched ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    8. List of Top Twenty (20) Borrowers based on aggregate outstanding balances (softcopy of amortization schedule/s, if applicable, and current subsidiary ledger/s of 
    each borrower and SL of immediately preceding loan account, if applicable, to be requested as may be necessary).
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong> 
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendList != '' AND lendList IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendList = $row1['lendList'];
            $lendListDesc = $row1['lendListDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendList,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendListDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendList ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    9. Loans classified by industry
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendLoan != '' AND lendLoan IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendLoan = $row1['lendLoan'];
            $lendLoanDesc = $row1['lendLoanDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendLoan,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendLoanDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendLoan ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>    
<tr>
<td colspan = "3" class="table-dark">
    10. Processes Flow on disclosure, booking and monitoring of installment loans
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendProcess2 != '' AND lendProcess2 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendProcess2 = $row1['lendProcess2'];
            $lendProcess2Desc = $row1['lendProcess2Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendProcess2,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendProcess2Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendProcess2 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr>   
<tr>
<td colspan = "3" class="table-dark">
11. Aging schedule and status report of loans and advances under “In Litigation and Past Due Accounts”  
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendAging != '' AND lendAging IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendAging = $row1['lendAging'];
            $lendAgingDesc = $row1['lendAgingDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendAging,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendAgingDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendAging ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>      
</tr>   
<tr>
<td colspan = "3" class="table-dark">
12. Schedule of loans and other credit accommodations to related parties (DOSRI, etc.) 
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendSched2 != '' AND lendSched2 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendSched2 = $row1['lendSched2'];
            $lendSched2Desc = $row1['lendSched2Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendSched2,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendSched2Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendSched2 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>         
</tr>   
<tr>
<td colspan = "3" class="table-dark">
13. Other related party transactions (other than loans and credit accommodations)
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendOther != '' AND lendOther IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendOther = $row1['lendOther'];
            $lendOtherDesc = $row1['lendOtherDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendOther,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendOtherDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendOther ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>         
</tr>   
<tr>
<td colspan = "3" class="table-dark">
14. Loans Granted under Fringe Benefit Program
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendLoan2 != '' AND lendLoan2 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendLoan2 = $row1['lendLoan2'];
            $lendLoan2Desc = $row1['lendLoan2Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendLoan2,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendLoan2Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendLoan2 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>         
</tr>   
<tr>
<td colspan = "3" class="table-dark">
15. Summary of Loans Written-off/Recoveries from 01 July 2020 to latest available including all related communications from BSP
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendSummary3 != '' AND lendSummary3 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendSummary3 = $row1['lendSummary3'];
            $lendSummary3Desc = $row1['lendSummary3Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendSummary3,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendSummary3Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendSummary3 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>         
</tr> 
<tr>
<td colspan = "3" class="table-dark">
16. Classified Other Risk Assets
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bsplending WHERE lendClass != '' AND lendClass IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $lendClass = $row1['lendClass'];
            $lendClassDesc = $row1['lendClassDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($lendClass,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $lendClassDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($lendClass ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
            </tr> 
        </tbody>
    </table>
</div>
<div>
<div><h3>ACQUIRED ASSETS MANAGEMENT AND REMEDIAL MANAGEMENT<br>
        &nbsp;&nbsp;(ROPA/SCR/NON-CURRENT ASSESTS HELD FOR SALE)
        </h3></div>
    <br>
    <table class ="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">File Name</th>
                <th scope="col" style="text-align: center;">Remarks</th>
                <th scope="col" style="text-align: center;">Submitted</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td colspan = "3" class="table-dark">
               1. Manuals, policies and procedures on acquired assets management and remedial management (ROPA, SCR, Non-current Assets Held for Sale)
               <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
                </td>
                <?php 
    $sql1 = "SELECT * FROM bspassets WHERE aamManual != '' AND aamManual IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $aamManual = $row1['aamManual'];
            $aamManualDesc = $row1['aamManualDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($aamManual,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $aamManualDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($aamManual ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    2. List and copies of reports generated by collection and work-out unit on a regular basis
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspassets WHERE aamList != '' AND aamList IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $aamList = $row1['aamList'];
            $aamListDesc = $row1['aamListDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($aamList,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $aamListDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($aamList ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    3. Assets acquired in settlement of loans as of 31 March 2024 (Please provide copies of loan subsidiary ledgers prior to booking to ROPA)
    Suggested Column Headings (information required):
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspassets WHERE aamAssests != '' AND aamAssests IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $aamAssests = $row1['aamAssests'];
            $aamAssestsDesc = $row1['aamAssestsDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($aamAssests,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $aamAssestsDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($aamAssests ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    4. Sales contract receivable as of 31 March 2024 (Please provide copies of subsidiary ledgers)
    Suggested Column Headings (information required):
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspassets WHERE aamSales != '' AND aamSales IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $aamSales = $row1['aamSales'];
            $aamSalesDesc = $row1['aamSalesDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($aamSales,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $aamSalesDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($aamSales ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?> 
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    5. Schedule of ROPA sold from 01 July 2021 to latest available (Indicate previous ROPA account name,
    name of buyer, date sold, selling price and gain/loss sale).
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspassets WHERE aamSched != '' AND aamSched IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $aamSched = $row1['aamSched'];
            $aamSchedDesc = $row1['aamSchedDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($aamSched,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $aamSchedDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($aamSched ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    6. Schedule of paid SCR - from 01 July 2021 to latest available (Indicate previous ROPA account name,
        name of buyer, date sold, selling price and gain/loss on sale)
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspassets WHERE aamSched2 != '' AND aamSched2 IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $aamSched2 = $row1['aamSched2'];
            $aamSched2Desc = $row1['aamSched2Desc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($aamSched2,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $aamSched2Desc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($aamSched2 ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
            </tr> 
        </tbody>
    </table>
</div>
<div>
<div><h3>MARKET AND LIQUIDITY RISK</h3></div>
    <table  class ="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">File Name</th>
                <th scope="col" style="text-align: center;">Remarks</th>
                <th scope="col" style="text-align: center;">Submitted</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td colspan = "3" class="table-dark">
                1. Manuals, policies and procedures relative to market and liquidity risks
                <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
                </td>
                <?php 
    $sql1 = "SELECT * FROM bspmarket WHERE mrkManuals != '' AND mrkManuals IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $mrkManuals = $row1['mrkManuals'];
            $mrkManualsDesc = $row1['mrkManualsDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($mrkManuals,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $mrkManualsDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($mrkManuals ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    2. List of Management reports on market and liquidity risks, indicating the frequency and the recipients thereof 
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspmarket WHERE mrkList != '' AND mrkList IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $mrkList = $row1['mrkList'];
            $mrkListDesc = $row1['mrkListDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($mrkList,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $mrkListDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($mrkList ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    3. Memo/Policy on setting interest rates for Deposits (Savings, Demand, Time Deposits) and Loans;
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspmarket WHERE mrkMemo != '' AND mrkMemo IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $mrkMemo = $row1['mrkMemo'];
            $mrkMemoDesc = $row1['mrkMemoDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($mrkMemo,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $mrkMemoDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($mrkMemo ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    4. Details of Required and Available Reserves from 01 July 2020 to 31 December 2021
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
    </td>
    <?php 
    $sql1 = "SELECT * FROM bspmarket WHERE mrkDetails != '' AND mrkDetails IS NOT NULL";
    $result1 = $con->query($sql1);

    if ($result1->num_rows > 0) {
 

        while ($row1 = $result1->fetch_assoc()) {
            $mrkDetails = $row1['mrkDetails'];
            $mrkDetailsDesc = $row1['mrkDetailsDesc'];

            // Output genComm and genCommDesc in their respective columns
            echo '<tr>';
        
            echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($mrkDetails,100) . '</td>';
            echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $mrkDetailsDesc . '</td>';
            echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($mrkDetails ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
            echo '</tr>';
        }
    }
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    5. Run-up of deposits excluding the name of the depositor
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
    </td>
<?php 
$sql1 = "SELECT * FROM bspmarket WHERE mrkRun != '' AND mrkRun IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $mrkRun = $row1['mrkRun'];
        $mrkRunDesc = $row1['mrkRunDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($mrkRun,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $mrkRunDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($mrkRun ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    6. Schedule of deposit liabilities by size of account, interest rate and term
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspmarket WHERE mrkSchedule != '' AND mrkSchedule IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $mrkSchedule = $row1['mrkSchedule'];
        $mrkScheduleDesc = $row1['mrkScheduleDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($mrkSchedule,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $mrkScheduleDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($mrkSchedule ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    7. Breakdown of all interest-bearing assets and liabilities as to interest rate and maturity
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspmarket WHERE mrkBreakdown != '' AND mrkBreakdown IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $mrkBreakdown = $row1['mrkBreakdown'];
        $mrkBreakdownDesc = $row1['mrkBreakdownDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($mrkBreakdown,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $mrkBreakdownDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($mrkBreakdown ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
            </tr> 
        </tbody>
    </table>
</div>
<div>
    <div><h3>HUMAN RESOURCES MANAGEMENT</h3></div>
    <table  class ="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">File Name</th>
                <th scope="col" style="text-align: center;">Remarks</th>
                <th scope="col" style="text-align: center;">Submitted</th>
            </tr>
        </thead>
        <tbody>
        <tr>
        <td colspan = "3" class="table-dark">
            1. Summary of Board Resolutions adopted from 01 July 2020 to latest available certified complete and accurate by the Corporate Secretary
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong>
            </td>
            <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrSum != '' AND hrSum IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrSum = $row1['hrSum'];
        $hrSumDesc = $row1['hrSumDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrSum,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrSumDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrSum ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    2. Copies of all management compensation programs, including any incentive plans
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrCopy != '' AND hrCopy IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrCopy = $row1['hrCopy'];
        $hrCopyDesc = $row1['hrCopyDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrCopy,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrCopyDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrCopy ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr> 
<tr>
<td colspan = "3" class="table-dark">
    3. Latest Board-approved organizational charts for key functional areas, indicating
        positions and name of officers responsible for each unit
        <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrBoard != '' AND hrBoard IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrBoard = $row1['hrBoard'];
        $hrBoardDesc = $row1['hrBoardDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrBoard,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrBoardDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrBoard ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>   
<tr>
<td colspan = "3" class="table-dark">
    4. Plantilla of Organization (Directors/Officers/Other Personnel); Indicate positions, residential addresses, birthdays, date hired/appointed
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
</td>
<?php 
$sql1 = "SELECT * FROM bsphr WHERE hrOrg != '' AND hrOrg IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrOrg = $row1['hrOrg'];
        $hrOrgDesc = $row1['hrOrgDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrOrg,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrOrgDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrOrg ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>   
<tr>
<td colspan = "3" class="table-dark">
    5. Identifiers for directors and officers; Indicate Full Name (First Name, Middle Name, Last Name and Suffix), Mother’s
        Maiden Name, Civil Status, TIN, Gender, Date of Birth, Last Known Address, Position, Date of Appointment.
        <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrOfficer != '' AND hrOfficer IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrOfficer = $row1['hrOfficer'];
        $hrOfficerDesc = $row1['hrOfficerDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrOfficer,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrOfficerDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrOfficer ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    6. Details of Provision for Post-Retirement Benefits, if any
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrPost != '' AND hrPost IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrPost = $row1['hrPost'];
        $hrPostDesc = $row1['hrPostDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrPost,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrPostDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrPost ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>    
<tr>
<td colspan = "3" class="table-dark">
    7. List of New Officers and Members of the Board from 01 July 2020 to latest available
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrMember != '' AND hrMember IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrMember = $row1['hrMember'];
        $hrMemberDesc = $row1['hrMemberDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrMember,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrMemberDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrMember ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>     
</tr>    
<tr>
<td colspan = "3" class="table-dark">
    8. List of separated employees, officers/date separated/reason from 01 July 2020 to latest available
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrEmp != '' AND hrEmp IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrEmp = $row1['hrEmp'];
        $hrEmpDesc = $row1['hrEmpDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrEmp,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrEmpDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrEmp ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>           
</tr>      
<tr>
<td colspan = "3" class="table-dark">
9. Copy of duties and responsibilities (job description) of officers and employees
<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrDuties != '' AND hrDuties IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrDuties = $row1['hrDuties'];
        $hrDutiesDesc = $row1['hrDutiesDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrDuties,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrDutiesDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrDuties ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>                 
</tr>      
<tr>
<td colspan = "3" class="table-dark">
    10. Complete list of trainings from 01 July 2020 to latest available including participants
    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrTrain != '' AND hrTrain IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrTrain = $row1['hrTrain'];
        $hrTrainDesc = $row1['hrTrainDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrTrain,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrTrainDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrTrain ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>             
</tr>      
<tr>
<td colspan = "3" class="table-dark">
11. Hiring policies for Senior Management (including screening process)
<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsphr WHERE hrPol != '' AND hrPol IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $hrPol = $row1['hrPol'];
        $hrPolDesc = $row1['hrPolDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($hrPol,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $hrPolDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($hrPol ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>  
        </tr>     
        </tbody>
    </table>
</div>
<div>
   <div> <h3>LEGAL MANAGEMENT</h3></div>
    <table class ="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">File Name</th>
                <th scope="col" style="text-align: center;">Remarks</th>
                <th scope="col" style="text-align: center;">Submitted</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td colspan = "3" class="table-dark">
                1. List of reports regularly submitted to Board and/or Senior Management
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
                </td>
                <?php 
$sql1 = "SELECT * FROM bsplegal WHERE legalReg != '' AND legalReg IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $legalReg = $row1['legalReg'];
        $legalRegDesc = $row1['legalRegDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($legalReg,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $legalRegDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($legalReg ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>  
</tr>     
<tr>
<td colspan = "3" class="table-dark">
    2. Inventory/Status of all legal cases involving the Bank, whether filed by or against the Bank
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bsplegal WHERE legalStats != '' AND legalStats IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $legalStats = $row1['legalStats'];
        $legalStatsDesc = $row1['legalStatsDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($legalStats,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $legalStatsDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($legalStats ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?> 
            </tr>     
        </tbody>
    </table>
</div>
<div>
<div><h3>INTERNAL AUDIT</h3></div>
<table  class ="table table-bordered">
    <thead>
        <tr>
            <th scope="col" style="text-align: center;">File Name</th>
            <th scope="col" style="text-align: center;">Remarks</th>
            <th scope="col" style="text-align: center;">Submitted</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td colspan = "3" class="table-dark">
                1. Internal Audit Manuals, Policies and Procedures
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
            </td>
            <?php 
$sql1 = "SELECT * FROM bspaudit WHERE audManual != '' AND audManual IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $audManual = $row1['audManual'];
        $audManualDesc = $row1['audManualDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($audManual,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $audManualDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($audManual ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
        2. List of all internal audits completed from 01 July 2020 to 31 March 2024 with their most recent audit reports along with audit ratings assigned to each auditee.
        Please indicate cut-off date of audits
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspaudit WHERE audList != '' AND audList IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $audList = $row1['audList'];
        $audListDesc = $row1['audListDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($audList,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $audListDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($audList ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
        3. Audit plans for previous and current years and compliance with audit plans for the previous year
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspaudit WHERE audPlan != '' AND audPlan IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $audPlan = $row1['audPlan'];
        $audPlanDesc = $row1['audPlanDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($audPlan,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $audPlanDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($audPlan ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
        4. Special audit reports, if any, involving crimes and/or losses (from 01 January 2022 to 31 March 2024)
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspaudit WHERE audReport != '' AND audReport IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $audReport = $row1['audReport'];
        $audReportDesc = $row1['audReportDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($audReport,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $audReportDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($audReport ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
        5. List of all outstanding exceptions and proposed corrective actions, deadlines for implementation and the most recent update of progress
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspaudit WHERE audOut != '' AND audOut IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $audOut = $row1['audOut'];
        $audOutDesc = $row1['audOutDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($audOut,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $audOutDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($audOut ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
        </tr>
    </tbody>
</table>
</div>
<div>
<div><h3>COMPLIANCE OFFICE</h3></div>
<table  class ="table table-bordered">
    <thead>
        <tr>
            <th scope="col" style="text-align: center;">File Name</th>
            <th scope="col" style="text-align: center;">Remarks</th>
            <th scope="col" style="text-align: center;">Submitted</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td colspan = "3" class="table-dark">
              1. Compliance Office Manuals, Policies and Procedures
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <?php 
$sql1 = "SELECT * FROM bspoffice WHERE offManual != '' AND offManual IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $offManual = $row1['offManual'];
        $offManualDesc = $row1['offManualDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($offManual,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $offManualDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($offManual ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    2. 2020 and 2021 Detailed Plan of the Compliance Office
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspoffice WHERE offDetail != '' AND offDetail IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $offDetail = $row1['offDetail'];
        $offDetailDesc = $row1['offDetailDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($offDetail,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $offDetailDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($offDetail ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    3. 2020 and 2021 Compliance Office Accomplishment Reports
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspoffice WHERE offAcc != '' AND offAcc IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $offAcc = $row1['offAcc'];
        $offAccDesc = $row1['offAccDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($offAcc,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $offAccDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($offAcc ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    4. List of reports regularly generated by Compliance Officer, indicating the frequency and appropriate recipients
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspoffice WHERE offReg != '' AND offReg IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $offReg = $row1['offReg'];
        $offRegDesc = $row1['offRegDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($offReg,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $offRegDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($offReg ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    5. Copy of Report on Compliance with Mandatory Credit Allocation to SMEs as of RE reference date
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspoffice WHERE offManda != '' AND offManda IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $offManda = $row1['offManda'];
        $offMandaDesc = $row1['offMandaDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($offManda,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $offMandaDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($offManda ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    6. Copy of Report on Utilization of Loanable Funds Set Aside for Agri-Agra Loans as of RE reference date
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspoffice WHERE offUtil != '' AND offUtil IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $offUtil = $row1['offUtil'];
        $offUtilDesc = $row1['offUtilDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($offUtil,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $offUtilDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($offUtil ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    7. Copy of Report on Single Borrower’s Limit and Consolidated Report on Compliance with Individual
    and Aggregate Ceilings on Direct Credit Accommodations to DOSRI as of RE reference date
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>
    <?php 
$sql1 = "SELECT * FROM bspoffice WHERE offSingle != '' AND offSingle IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $offSingle = $row1['offSingle'];
        $offSingleDesc = $row1['offSingleDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($offSingle,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $offSingleDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($offSingle ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
        </tr>
    </tbody>
</table>
</div>
<div>
<div><h3>INFORMATION TECHNOLOGY (IT)</h3></div>
<table  class ="table table-bordered">
    <thead>
        <tr>
            <th scope="col" style="text-align: center;">File Name</th>
            <th scope="col" style="text-align: center;">Remarks</th>
            <th scope="col" style="text-align: center;">Submitted</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td colspan = "3" class="table-dark">
         1. IT Organizational Chart
         <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
            </td>   
            <?php 
$sql1 = "SELECT * FROM bspit WHERE itChart != '' AND itChart IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $itChart = $row1['itChart'];
        $itChartDesc = $row1['itChartDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($itChart,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $itChartDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($itChart ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
2. Bank's network diagram including system documentation/data flow diagrams/process flows
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
    </td>   
    <?php 
$sql1 = "SELECT * FROM bspit WHERE itDocs != '' AND itDocs IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $itDocs = $row1['itDocs'];
        $itDocsDesc = $row1['itDocsDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($itDocs,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $itDocsDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($itDocs ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?> 
</tr>
<tr>
<td colspan = "3" class="table-dark">
3. Business Continuity Plan and IT Manuals, Policies and Procedures
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
    </td>   
    <?php 
$sql1 = "SELECT * FROM bspit WHERE itBusiness != '' AND itBusiness IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $itBusiness = $row1['itBusiness'];
        $itBusinessDesc = $row1['itBusinessDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($itBusiness,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $itBusinessDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($itBusiness ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>  
</tr>
<tr>
<td colspan = "3" class="table-dark">
4. Types of programs or software being used in banking operations
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
    </td> 
    <?php 
$sql1 = "SELECT * FROM bspit WHERE itPlan != '' AND itPlan IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $itPlan = $row1['itPlan'];
        $itPlanDesc = $row1['itPlanDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($itPlan,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $itPlanDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($itPlan ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
5. IT plans, including strategies applied to ensure security of back-up files, records and computers
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
    </td>   
    <?php 
$sql1 = "SELECT * FROM bspit WHERE itStrats != '' AND itStrats IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $itStrats = $row1['itStrats'];
        $itStratsDesc = $row1['itStratsDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($itStrats,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $itStratsDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($itStrats ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
        </tr>
    </tbody>
</table>  
</div>
<div>
<div><h3>COMPLIANCE WITH ANTI-MONEY LAUNDERING ACT (AMLA)</h3></div>
<table  class ="table table-bordered">
    <thead>
        <tr>
            <th scope="col" style="text-align: center;">File Name</th>
            <th scope="col" style="text-align: center;">Remarks</th>
            <th scope="col" style="text-align: center;">Submitted</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    <td colspan = "3" class="table-dark">
1. Anti-Money Laundering (AML) Manual and AMLA Compliance Audit Program
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td> 
    <?php 
$sql1 = "SELECT * FROM bspamla WHERE amlAnti != '' AND amlAnti IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $amlAnti = $row1['amlAnti'];
        $amlAntiDesc = $row1['amlAntiDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($amlAnti,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $amlAntiDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($amlAnti ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
2. Certification from the Compliance Officer that the institution complies with the record retention requirements for existing and new deposit accounts/transactions,
closed accounts and accounts involved in money laundering cases, if any;
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>  
    <?php 
$sql1 = "SELECT * FROM bspamla WHERE amlCert != '' AND amlCert IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $amlCert = $row1['amlCert'];
        $amlCertDesc = $row1['amlCertDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($amlCert,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $amlCertDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($amlCert ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>  
</tr>
<tr>
<td colspan = "3" class="table-dark">
3. List of Numbered Accounts Maintained and Non-resident accounts (please prepare the customer identification documents of accounts to be sampled for further review)
in spreadsheet format including the following information (if applicable):
<br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
    </td>  
    <?php 
$sql1 = "SELECT * FROM bspamla WHERE amlList != '' AND amlList IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $amlList = $row1['amlList'];
        $amlListDesc = $row1['amlListDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($amlList,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $amlListDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($amlList ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
</tr>
<tr>
<td colspan = "3" class="table-dark">
    4. Statistical information on number of Covered Transaction Reports and Suspicious Transaction Reports submitted to AMLC since 01 July 2020
    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
</td>   
<?php 
$sql1 = "SELECT * FROM bspamla WHERE amlStats != '' AND amlStats IS NOT NULL";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {


    while ($row1 = $result1->fetch_assoc()) {
        $amlStats = $row1['amlStats'];
        $amlStatsDesc = $row1['amlStatsDesc'];

        // Output genComm and genCommDesc in their respective columns
        echo '<tr>';
    
        echo '<td class="col-sm-3" style="text-align: left;">' . extractFileName1($amlStats,100) . '</td>';
        echo '<td  class="col-sm-6" style="text-align: left; max-width: 200px; word-wrap: break-word;">' . $amlStatsDesc . '</td>';
        echo '<td class="col-sm-3" style="text-align: center;"><img id="itChartImage"  src="' . ($amlStats ? 'statusImage/check.png' : 'statusImage/xmark.png') . '" alt="statusImage"></td>';
        echo '</tr>';
    }
}
?>
        </tr>
    </tbody>
</table>
</div>
</div>

<div class="fixed-bottom bg-light" style ="background-color:light;"> 
 
    
<div class="pagination" id="pagination"></div>
            
</div>

</body>



<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
$(document).ready(function() {
    $(".btnBack").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp.php";
    });
});
</script>
<script>
    var items = document.getElementById('items').children;
    var itemsPerPage = 1;
    var totalPages = Math.ceil(items.length / itemsPerPage);
    var currentPage = 1;

    function showPage(page) {
        for (var i = 0; i < items.length; i++) {
            items[i].style.display = 'none';
        }
        for (var i = (page - 1) * itemsPerPage; i < page * itemsPerPage && i < items.length; i++) {
            items[i].style.display = 'block';
        }
        currentPage = page;
    }

    function setupPagination() {
        var pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        var prevButton = document.createElement('a');
        prevButton.href = '#';
        prevButton.textContent = 'Prev';
        prevButton.onclick = function() {
            if (currentPage > 1) {
                showPage(currentPage - 1);
                updatePaginationState();
            }
        };
        pagination.appendChild(prevButton);

        for (var i = 1; i <= totalPages; i++) {
            var link = document.createElement('a');
            link.href = '#';
            link.textContent = i;
            link.onclick = function() {
                showPage(parseInt(this.textContent));
                updatePaginationState();
            };
            pagination.appendChild(link);
        }

        var nextButton = document.createElement('a');
        nextButton.href = '#';
        nextButton.textContent = 'Next';
        nextButton.onclick = function() {
            if (currentPage < totalPages) {
                showPage(currentPage + 1);
                updatePaginationState();
            }
        };
        pagination.appendChild(nextButton);

        showPage(1);
        pagination.children[1].className += ' active';
    }

    function updatePaginationState() {
        var pagination = document.getElementById('pagination');
        var current = pagination.getElementsByClassName('active');
        if (current.length > 0) {
            current[0].className = current[0].className.replace('active', '');
        }
        pagination.children[currentPage].className += ' active';
    }

    setupPagination();

   
</script>


</html>
