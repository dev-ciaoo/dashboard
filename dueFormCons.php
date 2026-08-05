<?php
include('connection.php');
include('fileuploadloan.php');

// $selectIT = "SELECT * FROM `microfinance` WHERE id = 1";
   // $data = mysqli_query($con, $selectIT) ;
   //     if (!$data) {
   //         echo("Error description: " . mysqli_error($con));
   //     }else{
   //         while ($row = mysqli_fetch_array($data)) {
   //             $itChart = $row['itChart'];
   //             $itDocs = $row['itDocs'];
   //             $itBusiness = $row['itBusiness'];
   //             $itPlan = $row['itPlan'];
   //             $itStrats = $row['itStrats'];
   //             $itChartSelect = $row['itChartDesc'];
   //             $itDocsSelect = $row['itDocsDesc'];
   //             $itBusinessSelect = $row['itBusinessDesc'];
   //             $itPlanSelect = $row['itPlanDesc'];
   //             $itStratsSelect = $row['itStratsDesc'];

   //             $itChart2 = $row['itChart2'];

   //             $itChartStats = $row['itChartStats'];
   //             $itDocsStats = $row['itDocsStats'];
   //             $itBusinessStats = $row['itBusinessStats'];
   //             $itPlanStats = $row['itPlanStats'];
   //             $itStratsStats = $row['itStratsStats'];
   //         } 
   //     }

   //     function extractFileName($filePath) {
   //         // Split the file path by underscore and get the last part
   //         $parts = explode('_', $filePath);
   //         $fileName = end($parts);
   //         return $fileName;
   //     }
      
   //     function extractFileName1($filePath, $maxLength) {
   //         // Split the file path by underscore and get the last part
   //         $parts = explode('_', $filePath);
   //         $fileName = end($parts);
         
   //         // Check if the file name length exceeds the maximum length
   //         if (strlen($fileName) > $maxLength) {
   //             // Truncate the file name and append ellipsis
   //             $fileName = substr($fileName, 0, $maxLength - 3) . '...';
   //         }
         
   //         return $fileName;
   //     }
      
   //     function extractFileName2($filePath, $maxLength) {
   //         // Split the file path by underscore and get the last part
   //         $parts = explode('_', $filePath);
   //         $fileName = end($parts);
         
   //         // Check if the file name length exceeds the maximum length
   //         if (strlen($fileName) > $maxLength) {
   //             // Truncate the file name and append ellipsis
   //             $fileName = substr($fileName, 0, $maxLength - 3) . '...';
   //         }
         
   //         return $fileName;
   //     }

   // function uploadFiles($con, $filesName, $tableColumn) {
   //     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES[$filesName])) {
   //         // Define the directory to store uploaded files
   //         $uploadDir = "bspit/";
      
   //         // Create the directory if it doesn't exist
   //         if (!file_exists($uploadDir)) {
   //             mkdir($uploadDir, 0777, true);
   //         }
      
   //         // Loop through each file
   //         foreach ($_FILES[$filesName]['tmp_name'] as $index => $tmpName) {
   //             $fileName = $_FILES[$filesName]['name'][$index];
   //             $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
               
   //             // Add current date to the filename
   //             $date = date('Ymd'); // Format: YYYYMMDD
   //             $newFileName = $date . '_' . $fileName;
      
   //             $targetFile = $uploadDir . $newFileName;
      
   //             // Check if file already exists
   //             if (file_exists($targetFile)) {
   //                 // If file with the same name exists, add a random number
   //                 $randomNumber = rand(1000, 9999);
   //                 $newFileName = $date . '_' . pathinfo($fileName, PATHINFO_FILENAME) . '' . $randomNumber . '.' . $fileType;
   //                 $targetFile = $uploadDir . $newFileName;
   //             }
      
   //             // Upload the file
   //             if (move_uploaded_file($tmpName, $targetFile)) {
   //                 // Insert file path into database
   //                 $sql = "INSERT INTO bspit ($tableColumn) VALUES ('$targetFile')";
   //                 if ($con->query($sql) === TRUE) {
   //                     // echo "The file " . htmlspecialchars(basename($fileName)) . " has been uploaded successfully as " . htmlspecialchars($newFileName) . ".<br>";
   //                 } else {
   //                     echo "Error: " . $sql . "<br>" . $con->error;
   //                 }
   //             } else {        
   //                 // echo "Sorry, there was an error uploading your file.";
   //             }
   //         }
   //     }
// }


$id =  $_POST['loanId'];

// 
$sqlCollection = "SELECT * FROM duecollection WHERE duecLoanId = '$id'";
$queryCollection = mysqli_query($con, $sqlCollection);

if(!$queryCollection) {
   echo "Error SQL SERVER";
} 
else 
{
  while($due = mysqli_fetch_array($queryCollection)) {
      $duecLoanId = $due['duecLoanId'];
      $duecBranch = $due['duecBranch'];
      $duecProdID = $due['duecProdID'];
      $duecBName = $due['duecBName'];
      $duecContact = $due['duecContact'];
      $duecStatus = $due['duecStatus'];
      $duecProdType = $due['duecProdType'];
      $duecDueDate = $due['duecDueDate'];
      $duecDLate = $due['duecDLate'];
      $duecAmountDue = $due['duecAmountDue'];
      $duecOverDue = $due['duecOverDue'];
      $duecAccBal = $due['duecAccBal'];
      $duecLastUnpaid = $due['duecLastUnpaid'];
      $dStatus = $due['dStatus'];
      $dateImported = $due['dateImported'];
  } 
}

?>
<!doctype html>
<html lang="en">
   <!-- <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/styleloan.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" type="text/css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <style type="text/css"></style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <title>Tabs</title>
   </head> -->
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="author" content="devCiao">
      <meta name="description" content="Microfinance Data">
      <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
      <title>Microfinance</title>
            <!-- Required meta tags -->
      <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">
      <link rel="stylesheet" href="assets/fontawesome/css/all.css">
      <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

      <!-- bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/styleloan.css">
      <link rel="stylesheet" type="text/css">
   </head>
   <body>
   <style>
      .nav-item .nav-link.active {
         background-color: lightgreen;
      }

      /* body{
      max-width: 110vw;
      } */

      #showOldModal {
         position: fixed;
         background-color: rgba(0, 0, 0, 0.3);
      }

      #oldFile_length{
         display: none;
      }

      #oldFile_filter{
         display: none;
      }

      #oldFile_paginate{
         float: right;
         position: relative;
      }

      #oldFile_info{
         float: left;
         position: relative;
      }

      td{
         text-align: center;
         font-size: 18px;
      }

      /* Ensure modal stays fixed in the center of the screen */
      #showOldModal .modal-dialog {
         position: fixed !important;  /* Fix position on screen */
         top: 55% !important;  
         left: 50% !important;  
         transform: translate(-50%, -50%) !important;  
         margin: 0 !important;  
         width: 90%; /* Adjust width as needed */
         max-width: 1200px; /* Ensure it doesn't exceed screen width */
      }

      #showOldModal .modal-content {
         max-height: 90vh; /* Prevent modal from overflowing the screen */
         overflow-y: auto; /* Enable scrolling inside modal if needed */
      }


   </style>
      <?php
         $id =  $_POST['loanId'];
         $query = "SELECT * FROM loan WHERE loan_Id='$id'";
         $data = mysqli_query($con, $query) ;
         
         if (!$data) {
             echo("Error description: " . mysqli_error($mysqli));
         } 
         else {
             while ($rows = mysqli_fetch_array($data)) {
                 $Cfname= $rows['customerFirstName'];
                 $Lfname= $rows['customerSurname'];
                 $fullname=$rows['customerFullName'];
                 $birth=$rows['birthDate'];
                 $id=$rows['loan_Id'];
                 $type=$rows['salaryType'];
                 $branch=$rows['branch'];
                 $loanType=$rows['loanType'];
         } 
         }
         

  function setFileVisibility($file, $inputId, $checkImageId,$buttonOpen,$selectValue,$date) {
         
             if (!empty($file)) {
         
      ?>
      <script>
         document.getElementById("<?php echo $inputId; ?>").style.display = "none";
         document.getElementById("<?php echo $checkImageId; ?>").style.visibility = "visible";
         document.getElementById("<?php echo $buttonOpen; ?>").style.display="inline";
         document.getElementById("<?php echo $date; ?>").style.display="inline";
      </script>
      <?php
         if(explode('--', $selectValue)[0] == "2"){
           ?>
      <script>
         document.getElementById("<?php echo $inputId; ?>").style.display = "inline";
         document.getElementById("<?php echo $checkImageId; ?>").src = 'statusImage/xmark.png';
         document.getElementById("<?php echo $buttonOpen; ?>").style.display="none";
         document.getElementById("<?php echo $date; ?>").style.display="none";
      </script>
      <?php
         }
         
         }
    else{
         ?>
      <script>
         document.getElementById("<?php echo $buttonOpen; ?>").style.display="none";
         document.getElementById("<?php echo $date; ?>").style.display="none";
      </script>
      <?php
         if(explode('--', $selectValue)[0] == "2" || $selectValue=="" || $selectValue=="NULL"){
           ?>
      <script>
         document.getElementById("<?php echo $checkImageId; ?>").style.visibility = "visible";
         document.getElementById("<?php echo $checkImageId; ?>").src = 'statusImage/xmark.png';
      </script>
      <?php
         }
         }
         
    }
         if($loanType == "CONSOLIDATED DATA"){
         // Disable Tab Buttons
         ?>
      <script>
         document.getElementById('tab1').classList.add('active');;
         document.getElementById('microfinance').classList.add('active');
         document.getElementById('tab2').setAttribute(', ');
         document.getElementById('tab3').setAttribute(', ');
         document.getElementById('tab4').setAttribute(', ');     
      </script>
      <?php
         $query1 = "SELECT a.*, m.* FROM consolidated AS m
                                          LEFT JOIN consoarchive AS a ON m.consLoanId = a.a_consLoanId
                                          WHERE m.consLoanId= '$id'
                                          ";
         $newdata = mysqli_query($con, $query1) ;
         $rows = mysqli_fetch_array($newdata);
         // BORROWER
         $loanAppForm=$rows['consLoanForm'];
         $memoAgreementS=$rows['consMemoAgrmnt'];
         $certofEmployment=$rows['consCOE'];
         $latestPayslip=$rows['consLatestPayslip'];
         $tin=$rows['consTIN'];
         $clearanceLoan=$rows['consClearanceLoan'];
         // CO MAKER 1
         $coMaker1=$rows['consCoMaker1'];
         $validSignatures=$rows['consValidSign1'];
         $monthsPayslip=$rows['consMonthlyPayslip'];
         // CO MAKER 2
         $coMaker2=$rows['consCoMaker2'];
         $validSignatures2=$rows['consValidSign2'];
         $monthsPayslip2=$rows['consMonthlyPayslip2'];
         // DOCUMENTS
         $deductRemit=$rows['consDeductRemit'];
         $cashflowScore=$rows['consCashFlow'];
         $loanAppMemo=$rows['consLoanMemo'];
         $promissoryNoteS=$rows['consPromisorry'];
         $disclosureStateS=$rows['consDisclosureS'];
         $amortScheduleS=$rows['consAmortSched'];
         // LETTER
         $consfLetter = $rows['consfLetter'];
         $conssLetter = $rows['conssLetter'];
         $constLetter = $rows['constLetter'];
         $consfdLetter = $rows['consfdLetter'];
         //  LETTER2
         $consfLetter2 = $rows['consfLetter2'];
         $conssLetter2 = $rows['conssLetter2'];
         $constLetter2 = $rows['constLetter2'];
         $consfdLetter2 = $rows['consfdLetter2'];
         //  LETTER3
         $consfLetter3 = $rows['consfLetter3'];
         $conssLetter3 = $rows['conssLetter3'];
         $constLetter3 = $rows['constLetter3'];
         $consfdLetter3 = $rows['consfdLetter3'];

         // CLIENT REQ
         $clientReq1 = $rows['clientReq1'];
         $clientReq2 = $rows['clientReq2'];
         $clientReq3 = $rows['clientReq3'];

         $clientReq1Select = $rows['clientReqRemarks'];

         // LEGAL
         $consffClosure = $rows['consffClosure'];
         $conspastLitigation = $rows['conspastLitigation'];
         $conspastLitigation2 = $rows['conspastLitigation2'];
         $consttLitigation = $rows['consttLitigation'];
         $consPrepConso = $rows['consPrepConso'];
         $consaDemand = $rows['consaDemand'];

         // ARCHIVED
         $a_consfLetter = $rows['a_consfLetter'];
         $a_conssLetter = $rows['a_conssLetter'];
         $a_constLetter  = $rows['a_constLetter'];
         $a_consfdLetter = $rows['a_consfdLetter'];

         $a_consfLetter2 = $rows['a_consfLetter2'];
         $a_conssLetter2 = $rows['a_conssLetter2'];
         $a_constLetter2 = $rows['a_constLetter2'];
         $a_consfdLetter2 = $rows['a_consfdLetter2'];
         
         $a_consfLetter3 = $rows['a_consfLetter3'];
         $a_conssLetter3 = $rows['a_conssLetter3'];
         $a_constLetter3 = $rows['a_constLetter3'];
         $a_consfdLetter3 = $rows['a_consfdLetter3'];

         // OTHER ATTACHMENT
         $a_clientReq1 = $rows['a_clientReq1'];
         $a_clientReq2 = $rows['a_clientReq2'];
         $a_clientReq3 = $rows['a_clientReq3'];
         $a_clientReqRemarks = $rows['a_clientReqRemarks'];

         $a_consffClosure = $rows['a_consffClosure'];
         $a_conspastLitigation = $rows['a_conspastLitigation'];
         $a_conspastLitigation2 = $rows['a_conspastLitigation2'];
         $a_consttLitigation = $rows['a_consttLitigation'];
         $a_consPrepConso = $rows['a_consPrepConso'];
         $a_consaDemand = $rows['a_consaDemand'];

         // BORROWER STATUS
         $loanAppFormSelect = $rows['consLoanFormStatus'];
         $memoAgreementSelect = $rows['consMeMoAgrmntStatus'];
         $certEmploymentSelect = $rows['consCOEStatus'];
         $payslipSelect = $rows['consLatestPayslipStatus'];
         $tinSelect = $rows['consTINStatus'];
         $clearanceLoanSelect = $rows['consClearanceStatus'];
         // CO MAKER 1 STATUS
         $coMaker1Select = $rows['consCoMaker1Status'];
         $validSignaturesSelect = $rows['consValidSign1Status'];
         $monthsPayslipSelect = $rows['consMonthlyPayslip1Status'];
         // CO MAKER 2 STATUS
         $coMaker2Select = $rows['consCoMaker2Status'];
         $validSignatures2Select = $rows['consValidSign2Status'];
         $monthsPayslip2Select = $rows['consMonthlyPayslip2Status'];
         // DOCUEMENTS
         $deductRemitSelect = $rows['consDeductRemitStatus'];
         $cashflowScoreSelect = $rows['consCashFlowStatus'];
         $loanAppMemoSelect = $rows['consLoanMemoStatus'];
         $promissoryNoteSSelect = $rows['consPromisorryStatus'];
         $disclosureStateSSelect = $rows['consDisclosureSStatus'];
         $amortScheduleSSelect = $rows['consAmortSchedStatus'];
         // LETTER SELECT
         $consfLetterSelect = $rows['consfLetterRemarks'];
         $conssLetterSelect = $rows['conssLetterRemarks'];
         $constLetterSelect = $rows['constLetterRemarks'];
         $consfdLetterSelect = $rows['consfdLetterRemarks'];
         // LEGAL SELECT
         $consffClosureSelect = $rows['consffClosureRemarks'];
         $conspastLitigationSelect = $rows['conspastLitigationRemarks'];
         $consttLitigationSelect = $rows['consttLitigationRemarks'];
         $consPrepConsoSelect = $rows['consPrepConsoRemarks'];
         $consaDemandSelect = $rows['consaDemandRemarks'];
         // LEGAL PASTCHECK
         $conspastCheck = $rows['conspastCheck'];
         $conspastCheck = $rows['conspastCheck'];
         }
         
         // BORROWER
         setFileVisibility($loanAppForm, "loanAppForm", "loanAppFormImage","loanAppFormButton", $loanAppFormSelect,"loanAppFormDate");
         setFileVisibility($memoAgreementS, "memoAgreementS", "memoAgreementSImage","memoAgreementSButton", $memoAgreementSelect,"memoAgreementSDate");
         setFileVisibility($certofEmployment, "certofEmployment", "certofEmploymentImage","certofEmploymentButton", $certEmploymentSelect,"certofEmploymentDate");
         setFileVisibility($latestPayslip, "latestPayslip", "latestPayslipImage","latestPayslipButton", $payslipSelect,"latestPayslipDate");
         setFileVisibility($tin, "tin", "tinImage","tinButton", $tinSelect,"tinDate");
         setFileVisibility($clearanceLoan, "clearanceLoan", "clearanceLoanImage","clearanceLoanButton", $clearanceLoanSelect,"clearanceLoanDate");
         // CO MAKER 1
         setFileVisibility($coMaker1, "coMaker1", "coMaker1Image","coMaker1Button", $coMaker1Select,"coMaker1Date");
         setFileVisibility($validSignatures, "validSignatures", "validSignaturesImage","validSignaturesButton", $validSignaturesSelect,"validSignaturesDate");
         setFileVisibility($monthsPayslip, "monthsPayslip", "monthsPayslipImage","monthsPayslipButton", $monthsPayslipSelect,"monthsPayslipDate");
         // CO MAKER 2
         setFileVisibility($coMaker2, "coMaker2", "coMaker2Image","coMaker2Button", $coMaker2Select,"coMaker2Date");
         setFileVisibility($validSignatures2, "validSignatures2", "validSignatures2Image","validSignatures2Button", $validSignatures2Select,"validSignatures2Date");
         setFileVisibility($monthsPayslip2, "monthsPayslip2", "monthsPayslip2Image","monthsPayslip2Button", $monthsPayslip2Select,"monthsPayslip2Date");
         // DOCUMENTS
         setFileVisibility($deductRemit, "deductRemit", "deductRemitImage","deductRemitButton", $deductRemitSelect,"deductRemitDate");
         setFileVisibility($cashflowScore, "cashflowScore", "cashflowScoreImage","cashflowScoreButton", $cashflowScoreSelect,"cashflowScoreDate");
         setFileVisibility($loanAppMemo, "loanAppMemo", "loanAppMemoImage","loanAppMemoButton", $loanAppMemoSelect,"loanAppMemoDate");
         setFileVisibility($promissoryNoteS, "promissoryNoteS", "promissoryNoteSImage","promissoryNoteSButton", $promissoryNoteSSelect,"promissoryNoteSDate");
         setFileVisibility($disclosureStateS, "disclosureStateS", "disclosureStateSImage","disclosureStateSButton", $disclosureStateSSelect,"disclosureStateSDate");
         setFileVisibility($amortScheduleS, "amortScheduleS", "amortScheduleSImage","amortScheduleSButton", $amortScheduleSSelect,"amortScheduleSDate");
         // LETTER
         setFileVisibility($consfLetter, "forconsfLetter", "consfLetterImage","consfLetterButton", $consfLetterSelect,"consfLetterDate");
         setFileVisibility($conssLetter, "forconssLetter", "conssLetterImage","conssLetterButton", $conssLetterSelect,"conssLetterDate");
         setFileVisibility($constLetter, "forconstLetter", "constLetterImage","constLetterButton", $constLetterSelect,"constLetterDate");
         setFileVisibility($consfdLetter, "forconsfdLetter", "consfdLetterImage","consfdLetterButton", $consfdLetterSelect,"consfdLetterDate");
         // setFileVisibility($clientReq1, "clientReq1", "clientReq1Image", "cientReq1Button", $clientReq1Select, "clientReq1Date");
         //  LETTER2
         setFileVisibility($consfLetter2, "forconsfLetter2", "consfLetter2Image","consfLetter2Button", "", "");
         setFileVisibility($conssLetter2, "forconssLetter2", "conssLetter2Image","conssLetter2Button", "", "");
         setFileVisibility($constLetter2, "forconstLetter2", "constLetter2Image","constLetter2Button", "", "");
         setFileVisibility($consfdLetter2, "forconsfdLetter2", "consfdLetter2Image","consfdLetter2Button", "", "");
         //  LETTER3
         setFileVisibility($consfLetter3, "forconsfLetter3", "consfLetter3Image","consfLetter3Button", "", "");
         setFileVisibility($conssLetter3, "forconssLetter3", "conssLetter3Image","conssLetter3Button", "", "");
         setFileVisibility($constLetter3, "forconstLetter3", "constLetter3Image","constLetter3Button", "", "");
         setFileVisibility($consfdLetter3, "forconsfdLetter3", "consfdLetter3Image","consfdLetter3Button", "", "");
         // OTHER ATTACHMENT
         setFileVisibility($clientReq1, "forclientReq1", "clientReq1Image", "clientReq1Button", $clientReq1Select, "clientReq1Date");
         setFileVisibility($clientReq2, "forclientReq2", "clientReq2Image", "clientReq2Button", "", "");
         setFileVisibility($clientReq3, "forclientReq3", "clientReq3Image", "clientReq3Button", "", "");
         // LEGAL
         setFileVisibility($consffClosure, "forconsffClosure", "consffClosureImage", "consffClosureButton", $consffClosureSelect, "consffClosureDate");
         setFileVisibility($conspastLitigation, "forconspastLitigation", "conspastLitigationImage", "conspastLitigationButton", $conspastLitigationSelect, "conspastLitigationDate");
         setFileVisibility($conspastLitigation2, "forconspastLitigation2", "conspastLitigation2Image", "conspastLitigation2Button", "", "");
         setFileVisibility($consttLitigation, "forconsttLitigation", "consttLitigationImage", "consttLitigationButton", $consttLitigationSelect, "consttLitigationDate");
         setFileVisibility($consPrepConso, "forconsPrepConso", "consPrepConsoImage", "consPrepConsoButton", $consPrepConsoSelect, "consPrepConsoDate");
         setFileVisibility($consaDemand, "forconsaDemand", "consaDemandImage", "consaDemandButton", $consaDemandSelect, "consaDemandDate");
         
         
         // The NUMBER OF PERCENTAGE
         $numberOfFilesUploaded = 0;
         
         $fileInputs = array(         
         $loanAppFormSelect, $memoAgreementSelect, $certEmploymentSelect, $payslipSelect, $tinSelect, $clearanceLoanSelect,
         $coMaker1Select, $validSignaturesSelect, $monthsPayslipSelect, $coMaker2Select, $validSignatures2Select, $monthsPayslip2Select,
         $deductRemitSelect, $cashflowScoreSelect, $loanAppMemoSelect, $promissoryNoteSSelect, $disclosureStateSSelect, $amortScheduleSSelect
         );
         
         // Filter out empty values from the array
         // Max Number Of Overall File Base on Condition
         $maxCount=count($fileInputs);
         // echo $maxCount;
         $nonEmptyFileInputs = array_filter($fileInputs,function($value) {
            $parts = explode("--", $value);
            return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
        });;
         
         // Count the number of non-empty values
         $numberOfFilesUploaded = count($nonEmptyFileInputs);
         // echo $numberOfFilesUploaded;
         
         // Calculate the percentage
         $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         
         // echo count($numberOfFilesUploaded);
         $percentage= round($numberOfFilesUploaded /$maxCount *100);
       


         $primary="http://10.10.10.120/dashboard/linkSalary.php?id=";
         $link=$primary . $id;
?>
      
         <!-- <div class ="links">
         <button data-bs-toggle="modal" class="btn btn-primary btn-md" name="createNew" id="createNew" data-bs-target="#createNewCustomerFolder">GENERATE LINK</button>
         </div> -->
      <div class="container py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><strong><?php echo "$fullname &nbsp; $birth &nbsp; $type &nbsp; $loanType"; ?></strong></h3></label>
        
         </div>
         <div class="col-12" style="text-align:left; margin-left:0.5%;">
         
            <!-- The PERCENTAGE CIRCLE -->
            <!-- <label class="text-white bg-success">LOAN PROGRESS :</label> -->
            <div class="progress" style="display: inline-block; min-width: 99%; vertical-align:bottom; height: 100%; font-size:130%">
               <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: <?php echo $percentage.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage.'%';?></div>
            </div>
         </div>
                  <div id="myModal" class="modal" style="margin-top:5%; margin-left:20%; width:50%; height:500px;">
                     <div class="modal-content" style="height:50%;">
                        <span class="close" id="closeModal" style= "font-size:2em; margin-left:95%"><i class="fa fa-times" aria-hidden="true"></i></span>
                        <p><h1 id="modalText"></h1></p>
                     </div>
                  </div>
         <div class="row">
            <div class="col-12 ">
               <div class="bg-white rounded p-2">
                  <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver">
                     <li class="nav-item ">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab1" href="#microfinance">Microfinance</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#salary">Salary</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation">Real Estate Mortgage - Corporation</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual">Real Estate Mortgage - Individual</a>
                     </li>
                  </ul>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="salary" class="tab-pane active" style="border: 1px solid #ccc;">
                              <form id="salary-form" action="loanSalaryUploadData.php" method="POST" enctype="multipart/form-data">

                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-10 my-4"><br>
                                       <div class="row">
                                       <div class="col-8" style="border-right:0;">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">REQUIREMENTS</h1>
                                        </div>
                                        <div class="col-4">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 107%;">APPROVAL</h1>
                                        </div>
                                       </div>
 
                                       <!-- content Requirements -->
                                       <div class="salary-tabs" style="border-right: 1px solid #ccc; min-height: 150%; width: 100%; margin-top: -0.5%;">
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>BORROWER</u></label></div>
                                             </div>
                                          </div>
                                           <!-- LOAN APPLICATION FORM -->
                                          <div class="row">
                                            <div class="col-8">
                                             <div class="py-1">  
                                                <label class ="salary-labels">&#x2022; LOAN APPLICATION FORM</label>
                                                <input type="file" id="loanAppForm" name="loanAppForm"><img id="loanAppFormImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $loanAppForm; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormButton">Open File</button></a> 
                                                <label class="date-label" id="loanAppFormDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppForm, strrpos($loanAppForm, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="loanAppFormSelect" name= "loanAppFormSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppFormDesc" name = "loanAppFormDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS"> &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- MEMORANDUM OF AGREEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                             <div class="py-1">  
                                                <label class ="salary-labels">&#x2022; MEMORANDUM OF AGREEMENT</label>
                                                <input type="file" id="memoAgreementS" name="memoAgreementS"><img id="memoAgreementSImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $memoAgreementS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="memoAgreementSButton" >Open File</button></a>
                                                <label class="date-label" id="memoAgreementSDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($memoAgreementS, strrpos($memoAgreementS, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="memoAgreementSelect" name= "memoAgreementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="memoAgreementSDesc" name = "memoAgreementSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- CERTIFICATE OF EMPLOYMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">  
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; CERTIFICATE OF EMPLOYMENT </label>
                                                <input type="file" class="certofEmployment" id="certofEmployment" name="certofEmployment"><img id="certofEmploymentImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $certofEmployment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="certofEmploymentButton">Open File</button></a>
                                                <label class="date-label" id="certofEmploymentDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($certofEmployment, strrpos($certofEmployment, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select id="certEmploymentSelect" name= "certEmploymentSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="certofEmploymentDesc" name = "certofEmploymentDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS"> &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- LATEST PAY-SLIP -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; LATEST PAY-SLIP </label>
                                                <input type="file" id="latestPayslip" name="latestPayslip"><img id="latestPayslipImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $latestPayslip; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestPayslipButton">Open File</button></a>
                                                <label class="date-label" id="latestPayslipDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($latestPayslip, strrpos($latestPayslip, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="payslipSelect" name= "payslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="latestPayslipDesc" name = "latestPayslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- T.I.N AND/OR ANY 2 VALID I.D -->    
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; T.I.N AND/OR ANY 2 VALID I.D</label>
                                                <input type="file" id="tin" name="tin"><img id="tinImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $tin; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="tinButton">Open File</button></a>
                                                <label class="date-label" id="tinDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($tin, strrpos($tin, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="tinSelect" name= "tinSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="tinDesc" name = "tinDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BARANGAY CLEARANCE FOR LOAN PURPOSE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; BARANGAY CLEARANCE FOR LOAN PURPOSE</label>
                                                <input type="file" id="clearanceLoan" name="clearanceLoan"><img id="clearanceLoanImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $clearanceLoan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="clearanceLoanButton">Open File</button></a>
                                                <label class="date-label" id="clearanceLoanDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($clearanceLoan, strrpos($clearanceLoan, '/') + 1, 10); ?></label><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="clearanceLoanSelect" name= "clearanceLoanSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="clearanceLoanDesc" name = "clearanceLoanDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>CO-MAKER 1</u></label></div>
                                             </div>
                                          </div>
                                          <!-- CO-MAKER STATEMENT 1-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class ="salary-labels" >&#x2022; CO-MAKER STATEMENT</label>
                                                <input type="file" id="coMaker1" name="coMaker1"><img id="coMaker1Image" src="statusImage/check.png" alt="statusImage"> 
                                                <a href="<?php echo $coMaker1; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="coMaker1Button">Open File</button></a>
                                                <label class="date-label" id="coMaker1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMaker1, strrpos($coMaker1, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMaker1Select" name= "coMaker1Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMaker1Desc" name = "coMaker1Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                            <!-- VALID ID WITH 3 SIGNATURES -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; VALID ID WITH 3 SIGNATURES </label>
                                                <input type="file" id="validSignatures" name="validSignatures"><img id="validSignaturesImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $validSignatures; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validSignaturesButton">Open File</button></a>
                                                <label class="date-label" id="validSignaturesDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($validSignatures, strrpos($validSignatures, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="validSignaturesSelect" name= "validSignaturesSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="validSignaturesDesc" name = "validSignaturesDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 3 MONTHS PAYSLIP -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; 3 MONTHS PAYSLIP</label>
                                                <input type="file" id="monthsPayslip" name="monthsPayslip"><img id="monthsPayslipImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $monthsPayslip; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="monthsPayslipButton">Open File</button></a>
                                                <label class="date-label" id="monthsPayslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($monthsPayslip, strrpos($monthsPayslip, '/') + 1, 10); ?></label><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="monthsPayslipSelect" name= "monthsPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="monthsPayslipDesc" name = "monthsPayslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>CO-MAKER 2</u></label></div>
                                             </div>
                                          </div>
                                           <!-- CO-MAKER STATEMENT 2-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                <label class ="salary-labels" >&#x2022; CO-MAKER STATEMENT</label>
                                                <input type="file" id="coMaker2" name="coMaker2"><img id="coMaker2Image" src="statusImage/check.png" alt="statusImage"> 
                                                <a href="<?php echo $coMaker2; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="coMaker2Button" >Open File</button></a>
                                                <label class="date-label" id="coMaker2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMaker2, strrpos($coMaker2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMaker2Select" name= "coMaker2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMaker2Desc" name = "coMaker2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- VALID ID WITH 3 SIGNATURES -->
                                          <div class="row">
                                             <div class="col-8">
                                              <div class="py-1">
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; VALID ID WITH 3 SIGNATURES </label>
                                                <input type="file" id="validSignatures2" name="validSignatures2"><img id="validSignatures2Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $validSignatures2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validSignatures2Button">Open File</button></a>
                                                <label class="date-label" id="validSignatures2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($validSignatures2, strrpos($validSignatures2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="validSignatures2Select" name= "validSignatures2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="validSignatures2Desc" name = "validSignatures2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 3 MONTHS PAYSLIP -->
                                          <div class="row" style="height: 4em; margin-bottom:-2%;">
                                             <div class="col-8">
                                                <div>
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; 3 MONTHS PAYSLIP</label>
                                                <input type="file" id="monthsPayslip2" name="monthsPayslip2"><img id="monthsPayslip2Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $monthsPayslip2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="monthsPayslip2Button">Open File</button></a>
                                                <label class="date-label" id="monthsPayslip2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($monthsPayslip2, strrpos($monthsPayslip2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="monthsPayslip2Select" name= "monthsPayslip2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="monthsPayslip2Desc" name = "monthsPayslip2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-10 my-4"><br>
                                    <div class="row">
                                       <div class="col-8" style="border-right:0;">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">REQUIREMENTS</h1>
                                        </div>
                                        <div class="col-4">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 100%;">APPROVAL</h1>
                                        </div>
                                       </div>
                                       <div class="document-labels">
                                          <div class="row">
                                             <div class="col-8" style="height:1em; margin-top:-0.5%;"></div>
                                          </div>
                                          <!-- ASSIGNMENT OF SALARY & AUTHORITY TO DEDUCT AND REMIT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">ASSIGNMENT OF SALARY & AUTHORITY TO DEDUCT AND REMIT</label>
                                                   <input type="file" id="deductRemit" name="deductRemit"><img id="deductRemitImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $deductRemit; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="deductRemitButton" >Open File</button></a>
                                                   <label class="date-label" id="deductRemitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($deductRemit, strrpos($deductRemit, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="deductRemitSelect" name= "deductRemitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="deductRemitDesc" name = "deductRemitDesc" class="form-control w-75 p-1 fs-5  " placeholder="REMARKS">
                                                </div>
                                             </div>
                                          </div>
                                          <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels" >FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD</label>
                                                   <input type="file" id="cashflowScore" name="cashflowScore"><img id="cashflowScoreImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $cashflowScore; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="cashflowScoreButton" >Open File</button></a>
                                                   <label class="date-label" id="cashflowScoreDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cashflowScore, strrpos($cashflowScore, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="cashflowScoreSelect" name= "cashflowScoreSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="cashflowScoreDesc" name = "cashflowScoreDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <!-- LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">LOAN APPROVAL MEMO</label>
                                                   <input type="file" id="loanAppMemo" name="loanAppMemo"><img id="loanAppMemoImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $loanAppMemo; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="loanAppMemoButton" >Open File</button></a>
                                                   <label class="date-label" id="loanAppMemoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppMemo, strrpos($loanAppMemo, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="loanAppMemoSelect" name= "loanAppMemoSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppMemoDesc" name = "loanAppMemoDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><u>SIGNED DOCUMENS FOR LOAN RELEASE</u></label></div>
                                             </div>
                                          </div>
                                          <!-- PORMISORRY NOTE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; PROMISSORY NOTE</label>
                                                   <input type="file" id="promissoryNoteS" name="promissoryNoteS"><img id="promissoryNoteSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $promissoryNoteS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="promissoryNoteSButton">Open File</button></a> 
                                                   <label class="date-label" id="promissoryNoteSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promissoryNoteS, strrpos($promissoryNoteS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="promissoryNoteSSelect" name= "promissoryNoteSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="promissoryNoteSDesc" name = "promissoryNoteSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- DISCLOSURE STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; DISCLOSURE STATEMENT</label>
                                                   <input type="file" id="disclosureStateS" name="disclosureStateS"><img id="disclosureStateSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $disclosureStateS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateSButton">Open File</button></a>
                                                   <label class="date-label" id="disclosureStateSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateS, strrpos($disclosureStateS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="disclosureStateSSelect" name= "disclosureStateSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="disclosureStateSDesc" name = "disclosureStateSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!--  AMORTIZATION SCHEDULE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                                   <input type="file" id="amortScheduleS" name="amortScheduleS"><img id="amortScheduleSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $amortScheduleS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleSButton">Open File</button></a>
                                                   <label class="date-label" id="amortScheduleSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleS, strrpos($amortScheduleS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="amortScheduleSSelect" name= "amortScheduleSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="amortScheduleSDesc" name = "amortScheduleSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>

                                          <!-- FOR SPACE -->
                                          <div class="row">
                                             <div class="col-8" style="height:26em; margin-bottom:-2%;" ></div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- LETTER  -->
                                    <input type="hidden" id="hidden">
                                       <div class="row">
                                          <div class="col-6">
                                             <div>
                                                <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%; border-top: 1px solid #ccc;">COLLECTION</h1>
                                             </div>
                                             <div class="row">
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%;">DEMAND</h5></div>
                                                   <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">FIRST LETTER</label>
                                                   <input type="hidden" id="hiddenif" name="hiddenif" value="<?= $rows['consfLetter']; ?>">
                                                   <input type="hidden" id="hiddenif2" name="hiddenif2" value="<?= $rows['consfLetter2']; ?>">
                                                   <input type="hidden" id="hiddenLate" name="hiddenLate" value="<?= $duecDLate; ?>">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%;">&nbsp;</h5></div>
                                                 <input type="file" id="consfLetter" name="consfLetter" style="display: none;">
                                                 <label for="consfLetter" class="forconsfLetter btn-sm" id="forconsfLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($consfLetter)){
                                                         echo '<a href="' . $consfLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consfLetterButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="consfLetterNew" class="fa-solid fa-plus consfLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="consfLetterShowOld" class="fa-solid fa-scroll consfLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="consfLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">REGISTRY RECEIPT</h5></div>
                                                   <input type="file" id="consfLetter2" name="consfLetter2" style="display: none;">
                                                   <label for="consfLetter2" class="forconsfLetter2 btn-sm" id="forconsfLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($consfLetter2)){
                                                         echo '<a href="' . $consfLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consfLetter2Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="consfLetter2New" class="fa-solid fa-plus consfLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="consfLetter2ShowOld" class="fa-solid fa-scroll consfLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="consfLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">RETURN RECEIPT</h5></div>
                                                   <input type="file" id="consfLetter3" name="consfLetter3" style="display: none;">
                                                   <label for="consfLetter3" class="forconsfLetter3 btn-sm" id="forconsfLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($consfLetter3)){
                                                         echo '<a href="' . $consfLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consfLetter3Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="consfLetter3New" class="fa-solid fa-plus consfLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="consfLetter3ShowOld" class="fa-solid fa-scroll consfLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="consfLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <!-- <div class="py-1"> -->
                                                      <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 102%; border-right: 1px solid #ccc; margin-left: 9%;">DATE</h5></div>
                                                      <label class="date-label" id="consfLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($consfLetter, strrpos($consfLetter, '/') + 1, 10); ?></label>
                                                      <!-- </div> -->
                                                </div>
                                             <div class="col-2">
                                                <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 108%; margin-left: -2%;">REMARKS</h5></div>
                                                <div class="form-group d-flex mb-4" id="">
                                                   &nbsp;&nbsp;<input type="text" id="consfLetterSelect" name="consfLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['consfLetterRemarks']; ?>">
                                                   &nbsp;&nbsp;<input type="hidden" class="fom-control w-75 p-1 fs-4" placeholder="REMARKS" id="consfLetterDesc" name="consfLetterDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">SECOND LETTER</label>
                                                   <input type="hidden" id="hiddenis" name="hiddenis" value="<?= $rows['conssLetter']; ?>">
                                                   <input type="hidden" id="hiddenis2" name="hiddenis2" value="<?= $rows['conssLetter2']; ?>">
                                             </div>
                                             <div class="col-2">
                                                  <input type="file" id="conssLetter" name="conssLetter" style="display: none;">
                                                  <label for="conssLetter" class="forconssLetter btn-sm" id="forconssLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($conssLetter)){
                                                         echo '<a href="' . $conssLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="conssLetterButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="conssLetterNew" class="fa-solid fa-plus conssLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="conssLetterShowOld" class="fa-solid fa-scroll conssLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="conssLetterImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="conssLetter2" name="conssLetter2" style="display: none;">
                                                   <label for="conssLetter2" class="forconssLetter2 btn-sm" id="forconssLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($conssLetter2)){
                                                         echo '<a href="' . $conssLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="conssLetter2Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="conssLetter2New" class="fa-solid fa-plus conssLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="conssLetter2ShowOld" class="fa-solid fa-scroll conssLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="conssLetter2Image" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="conssLetter3" name="conssLetter3" style="display: none;">
                                                   <label for="conssLetter3" class="forconssLetter3 btn-sm" id="forconssLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($conssLetter3)){
                                                         echo '<a href="' . $conssLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="conssLetter3Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="conssLetter3New" class="fa-solid fa-plus conssLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="conssLetter3ShowOld" class="fa-solid fa-scroll conssLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="conssLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="conssLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($conssLetter, strrpos($conssLetter, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2" id="">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="conssLetterSelect" name="conssLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['conssLetterRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="conssLetterDesc" name="conssLetterDesc" >&nbsp;
                                                      </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-2">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">THIRD LETTER</label>
                                                      <input type="hidden" id="hiddenit" name="hiddenit" value="<?= $rows['constLetter']; ?>">
                                                      <input type="hidden" id="hiddenit2" name="hiddenit" value="<?= $rows['constLetter2']; ?>">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="constLetter" name="constLetter" style="display: none;">
                                                      <label for="constLetter" class="forconstLetter btn-sm" id="forconstLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($constLetter)){
                                                            echo '<a href="' . $constLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="constLetterButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="constLetterNew" class="fa-solid fa-plus constLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="constLetterShowOld" class="fa-solid fa-scroll constLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                   <img id="constLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                     <input type="file" id="constLetter2" name="constLetter2" style="display: none;">
                                                     <label for="constLetter2" class="forconstLetter2 btn-sm" id="forconstLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($constLetter2)){
                                                            echo '<a href="' . $constLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="constLetter2Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="constLetter2New" class="fa-solid fa-plus constLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="constLetter2ShowOld" class="fa-solid fa-scroll constLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                   <img id="constLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <input type="file" id="constLetter3" name="constLetter3" style="display: none;">
                                                   <label for="constLetter3" class="forconstLetter3 btn-sm" id="forconstLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($constLetter3)){
                                                            echo '<a href="' . $constLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="constLetter3Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="constLetter3New" class="fa-solid fa-plus constLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="constLetter3ShowOld" class="fa-solid fa-scroll constLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                   <img id="constLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="constLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($constLetter, strrpos($constLetter, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2" id="">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="constLetterSelect" name="constLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['constLetterRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="constLetterDesc" name="constLetterDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                                </div>
                                             <div class="row">
                                                <div class="col-2">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">FINAL LETTER</label>
                                                      <input type="hidden" id="hiddenifd" name="hiddenifd" value="<?= $rows['consfdLetter']; ?>">
                                                      <input type="hidden" id="hiddenifd2" name="hiddenifd2" value="<?= $rows['consfdLetter2']; ?>">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="consfdLetter" name="consfdLetter" style="display: none;">
                                                      <label for="consfdLetter" class="forconsfdLetter btn-sm" id="forconsfdLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($consfdLetter)){
                                                            echo '<a href="' . $consfdLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consfdLetterButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="consfdLetterNew" class="fa-solid fa-plus consfdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="consfdLetterShowOld" class="fa-solid fa-scroll consfdLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                   <img id="consfdLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="consfdLetter2" name="consfdLetter2" style="display: none;">
                                                      <label for="consfdLetter2" class="forconsfdLetter2 btn-sm" id="forconsfdLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($consfdLetter2)){
                                                            echo '<a href="' . $consfdLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consfdLetter2Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="consfdLetter2New" class="fa-solid fa-plus consfdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="consfdLetter2ShowOld" class="fa-solid fa-scroll consfdLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                   <img id="consfdLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="consfdLetter3" name="consfdLetter3" style="display: none;">
                                                      <label for="consfdLetter3" class="forconsfdLetter3 btn-sm" id="forconsfdLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($consfdLetter3)){
                                                               echo '<a href="' . $consfdLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consfdLetter3Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="consfdLetter3New" class="fa-solid fa-plus consfdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="consfdLetter3ShowOld" class="fa-solid fa-scroll consfdLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="consfdLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="consfdLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($consfdLetter, strrpos($consfdLetter, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2" id="">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="consfdLetterSelect" name="consfdLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['consfdLetterRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="consfdLetterDesc" name="consfdLetterDesc" >&nbsp;
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="row">
                                                   <div class="col-8" style="border-right: none;">
                                                      <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%; border-top: 1px solid #ccc;">OTHER ATTACHMENT/S</h5></div>
                                                   </div>
                                                   <div class="col-2">
                                                      <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%; border-top: 1px solid #ccc; border-left: 1px solid #ccc; border-right: 1px solid #ccc;">DATE</h5></div>
                                                   </div>
                                                   <div class="col-2">
                                                      <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; width: 108.3%; margin-left: -2%;">REMARKS</h5></div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-2">
                                                         <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 18px; padding-left: 2%;">REQ. ATTACHMENT</label>
                                                         <input type="hidden" id="hiddenClient1" name="hiddenClient1" value="<?= $rows['clientReq1']; ?>">
                                                         <input type="hidden" id="hiddenClient2" name="hiddenClient2" value="<?= $rows['clientReq2']; ?>">
                                                         <input type="hidden" id="hiddenClient3" name="hiddenClient3" value="<?= $rows['clientReq3']; ?>">
                                                   </div>
                                                   <div class="col-2">
                                                         <input type="file" id="clientReq1" name="clientReq1" style="display: none;">
                                                         <label for="clientReq1" class="forclientReq1 btn-sm" id="forclientReq1" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($clientReq1)){
                                                               echo '<a href="' . $clientReq1 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="clientReq1Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="clientReq1New" class="fa-solid fa-plus clientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="clientReq1ShowOld" class="fa-solid fa-scroll clientReq1ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="clientReq1Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                         <input type="file" id="clientReq2" name="clientReq2" style="display: none;">
                                                         <label for="clientReq2" class="forclientReq2 btn-sm" id="forclientReq2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($clientReq2)){
                                                               echo '<a href="' . $clientReq2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="clientReq2Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="clientReq2New" class="fa-solid fa-plus clientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="clientReq2ShowOld" class="fa-solid fa-scroll clientReq2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="clientReq2Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                         <input type="file" id="clientReq3" name="clientReq3" style="display: none;">
                                                         <label for="clientReq3" class="forclientReq3 btn-sm" id="forclientReq3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                            <?php 
                                                               if(!empty($clientReq3)){
                                                                  echo '<a href="' . $clientReq3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="clientReq3Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                                  echo '&nbsp;<button type="button" id="clientReq3New" class="fa-solid fa-plus clientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                               }else{
                                                                  // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                               }
                                                               echo '&nbsp;<button type="button" id="clientReq3ShowOld" class="fa-solid fa-scroll clientReq3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            ?>
                                                         <img id="clientReq3Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                         <label class="date-label" id="clientReq1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($clientReq1, strrpos($clientReq1, '/') + 1, 10); ?></label>
                                                   </div>
                                                   <div class="col-2" id="">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="clientReq1Select" name="clientReq1Select" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['clientReqRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="clientReq1Desc" name="clientReq1Desc" >&nbsp;
                                                      </div>
                                                   </div>
                                                </div>
                                          </div>
                                          <div class="col-6">
                                             <div>
                                                <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 101.6%; border-top: 1px solid #ccc;">LEGAL</h1>
                                             </div>
                                             <div class="row">
                                                <div class="col-12" style="margin-top: -10.9px; height: 2em;"></div>
                                             </div>
                                             <div class="row">
                                                <div class="col-12" style="margin-top: -10.9px; height: 2em; border-bottom: 1px solid lightgray;"></div>
                                             </div>
                                             <div class="row">
                                                <div class="col-12" style="margin-top: -10.9px; height: 2em;"></div>
                                             </div>
                                             <div class="row">
                                                <div class="col-3">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style=" padding-left: 2%;">RECOMMENDATION FOR <br>FORECLOSURE</label>
                                                </div>
                                                <div class="col-2">
                                                   
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="consffClosure" name="consffClosure" style="display: none;">
                                                      <label for="consffClosure" class="forconsffClosure btn-sm" id="forconsffClosure" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($consffClosure)){
                                                               echo '<a href="' . $consffClosure . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consffClosureButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="consffClosureNew" class="fa-solid fa-plus consffClosureNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="consffClosureShowOld" class="fa-solid fa-scroll consffClosureShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="consffClosureImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                       
                                                   </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="consffClosureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($consffClosure, strrpos($consffClosure, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="consffClosureSelect" name="consffClosureSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['consffClosureRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="consffClosureDesc" name="consffClosureDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-3">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style="padding-left: 2%;">PASTDUE TO LITIGATION</label>
                                                </div>
                                                <div class="col-2">
                                                   <input type="file" id="conspastLitigation" name="conspastLitigation" style="display: none;">
                                                   <label for="conspastLitigation" class="forconspastLitigation btn-sm" id="forconspastLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($conspastLitigation)){
                                                               echo '<a href="' . $conspastLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="conspastLitigationButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="conspastLitigationNew" class="fa-solid fa-plus conspastLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="conspastLitigationShowOld" class="fa-solid fa-scroll conspastLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="conspastLitigationImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="conspastLitigation2" name="conspastLitigation2" style="display: none;">
                                                      <label for="conspastLitigation2" class="forconspastLitigation2 btn-sm" id="forconspastLitigation2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($conspastLitigation2)){
                                                               echo '<a href="' . $conspastLitigation2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="conspastLitigationButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="conspastLitigation2New" class="fa-solid fa-plus conspastLitigation2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="conspastLitigation2ShowOld" class="fa-solid fa-scroll conspastLitigation2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="conspastLitigation2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                                   <input class="form-check-input" type="checkbox" value="Yes" id="conspastCheck" name="conspastCheck"><label for=""><label class="individual-labels" id="label23" for="forconspastCheck" style="font-size: 15px; display: inline;"> Bidding</label>
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="conspastLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($conspastLitigation, strrpos($conspastLitigation, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="conspastLitigationSelect" name="conspastLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['conspastLitigationRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="conspastLitigationDesc" name="conspastLitigationDesc" >&nbsp;
                                                         </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-3">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style=" padding-left: 2%;">TRANSFER FROM LITIGATION <br>TO ROPA</label>
                                                </div>
                                                <div class="col-2">
                                                   
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="consttLitigation" name="consttLitigation" style="display: none;">
                                                      <label for="consttLitigation" class="forconsttLitigation btn-sm" id="forconsttLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($consttLitigation)){
                                                               echo '<a href="' . $consttLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consttLitigationButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="consttLitigationNew" class="fa-solid fa-plus consttLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="consttLitigationShowOld" class="fa-solid fa-scroll consttLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="consttLitigationImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                       
                                                   </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="consttLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($consttLitigation, strrpos($consttLitigation, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="consttLitigationSelect" name="consttLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['consttLitigationRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="consttLitigationDesc" name="consttLitigationDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                             </div>
                                             <div class="row">
                                             <div class="col-3">
                                                   <label class="corporation-label" id="tab-corporation" for="custom" style=" padding-left: 2%;">PREPARE TO CONSOLIDATION <br>IN THE NAME OF THE BANK</label>
                                             </div>
                                             <div class="col-2">
                                                  
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="consPrepConso" name="consPrepConso" style="display: none;">
                                                   <label for="consPrepConso" class="forconsPrepConso btn-sm" id="forconsPrepConso" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($consPrepConso)){
                                                               echo '<a href="' . $consPrepConso . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consPrepConsoButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="consPrepConsoNew" class="fa-solid fa-plus consPrepConsoNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="consPrepConsoShowOld" class="fa-solid fa-scroll consPrepConsoShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="consPrepConsoImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-1">
                                     
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="consPrepConsoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($consPrepConso, strrpos($consPrepConso, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="consPrepConsoSelect" name="consPrepConsoSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['consPrepConsoRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="consPrepConsoDesc" name="consPrepConsoDesc" >&nbsp;
                                                      </div>
                                                </div>
                                          </div>                                       
                                          <div class="row">
                                             <div class="col-3">
                                                   <label class="corporation-label" id="tab-corporation" for="custom" style=" padding-left: 2%;">DUE AND DEMANDABLE</label>
                                             </div>
                                             <div class="col-2">
                                                  
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="consaDemand" name="consaDemand" style="display: none;">
                                                   <label for="consaDemand" class="forconsaDemand btn-sm" id="forconsaDemand" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($consaDemand)){
                                                               echo '<a href="' . $consaDemand . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="consaDemandButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="consaDemandNew" class="fa-solid fa-plus consaDemandNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="consaDemandShowOld" class="fa-solid fa-scroll consaDemandShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                      <img id="consaDemandImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-1">
                                     
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="consaDemandDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($consaDemand, strrpos($consaDemand, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="consaDemandSelect" name="consaDemandSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['consaDemandRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="consaDemandDesc" name="consaDemandDesc" >&nbsp;
                                                      </div>
                                                </div>
                                          </div>
                                             <div class="row">
                                              <!-- <div class="col-8" id= "notEndBuyerSpace" style="margin-bottom:-5%;"></div> -->
                                           </div>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

  <div class="modal" id="showOldModal" tabindex="-1" aria-labelledby="showOldModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content" id="showOldModalContent">
            <div class="modal-header">
               <h5 class="modal-title" id="showOldModalLabel">History</h5>
               <button type="button" class="btn btn-secondary btn-sm" id="btnCloseModal" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
               <table id="oldFile" class="table table-bordered" width="100%" height="auto" cellspacing="0">
                  <thead>
                  <th>FILE</th>
                  <th>REMARKS</th>
                  <th>DATE</th>
                  </thead>
               </table>
            </div>
            <div class="modal-footer">
            </div>
         </div>
      </div>
   </div>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
   <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->


   <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
   <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>
<script>
// Get all input elements with type="text", class="form-control w-75 p-1 fs-5", and attribute
function hideText(){
    const inputElements = document.querySelectorAll('input[type="text"].form-control.w-75.p-1.fs-4');

// Loop through each input element and set the hidden attribute
inputElements.forEach(inputElement => {
  inputElement.style.visibility="hidden";
});
  }
hideText();


</script>
<script>
  function updateFileStatus(inputId, imageId, select) {
  var inputFile = document.getElementById(inputId);
  var image = document.getElementById(imageId);
  var select=document.getElementById(select);
  if (inputFile.files.length > 0) {
    image.src = 'statusImage/check.png'; // Show check icon if file is uploaded
    image.style.visibility = 'visible'; // Make the image visible
  }
}

// Show the textField if chooses "INCOMPLETE".
function handleSelectChange(selectId,textField) {
  $('#' + selectId).on('change', function() {
    var selectedValue = $(this).val();

    if (selectedValue === "2") {

      document.getElementById(textField).style.visibility = 'visible';    
    } 
    else{
      document.getElementById(textField).style.visibility = 'hidden';
    }
  });
}
// BORROWER
handleSelectChange('loanAppFormSelect', 'loanAppFormDesc');
handleSelectChange('memoAgreementSelect', 'memoAgreementSDesc');
handleSelectChange('certEmploymentSelect', 'certofEmploymentDesc');
handleSelectChange('latestPayslipSelect', 'latestPayslipDesc');
handleSelectChange('tinSelect', 'tinDesc');
handleSelectChange('clearanceLoanSelect', 'clearanceLoanDesc');
// CO MAKER 1
handleSelectChange('coMaker1Select', 'coMaker1Desc');
handleSelectChange('validSignaturesSelect', 'validSignaturesDesc');
handleSelectChange('monthsPayslipSelect', 'monthsPayslipDesc');
// CO-MAKER 2
handleSelectChange('coMaker2Select', 'coMaker2Desc');
handleSelectChange('validSignatures2Select', 'validSignatures2Desc');
handleSelectChange('monthsPayslip2Select', 'monthsPayslip2Desc');
// DOCUMENTS
handleSelectChange('deductRemitSelect', 'deductRemitDesc');
handleSelectChange('cashflowScoreSelect', 'cashflowScoreDesc');
handleSelectChange('loanAppMemoSelect', 'loanAppMemoDesc');
handleSelectChange('promissoryNoteSSelect', 'promissoryNoteSDesc');
handleSelectChange('disclosureStateSSelect', 'disclosureStateSDesc');
handleSelectChange('amortScheduleSSelect', 'amortScheduleSDesc');
// LETTER
// handleSelectChange('sfLetterSelect', 'amortScheduleSDesc');
</script>

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, consId) {
    $(document).ready(function() {

         if ($.fn.DataTable.isDataTable(tableId)) {
            $(tableId).DataTable().clear().destroy();
         }
         
         var mytable = $(tableId).DataTable({
               "fnCreatedRow": function(nRow, aData, iDataIndex) {
                  $(nRow).attr('id', aData[0]);
                  // Customize row style or classes if needed
               },
               'serverSide': true,
               'processing': true,
               'paging': true,
               'responsive': true,
               'order': [],
               'ajax': {
                  'url': ajaxUrl,
                  'type': 'post',
                  'data': function(d){
                        d.consId = consId;
                  }
               },
               "aoColumnDefs": [{
                  "bSortable": false,
                  "aTargets": [] // Apply sorting preferences if necessary
               }]
            });
         });
      }
   // First Consolidated Demand
   $(document).on('click', '#consfLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consfLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#consfLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consfLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#consfLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consfLetter3.php', '<?php echo $id; ?>');
   });
   // Second Consolidated Demand
   $(document).on('click', '#conssLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_conssLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#conssLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_conssLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#conssLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_conssLetter3.php', '<?php echo $id; ?>');
   });
   // Third Consolidated Demand
   $(document).on('click', '#constLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_constLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#constLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_constLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#constLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_constLetter3.php', '<?php echo $id; ?>');
   });
   // Final Consolidated Demand
   $(document).on('click', '#consfdLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consfdLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#consfdLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consfdLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#consfdLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consfdLetter3.php', '<?php echo $id; ?>');
   });
   // Other Attachment
   $(document).on('click', '#clientReq1ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_clientReq1.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#clientReq2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_clientReq2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#clientReq3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_clientReq3.php', '<?php echo $id; ?>');
   });
   // foreclosure
   $(document).on('click', '#consffClosureShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consffClosure.php', '<?php echo $id; ?>');
   });
   // pastdue LITIGATION
   $(document).on('click', '#conspastLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_conspastLitigation.php', '<?php echo $id; ?>');
   });
   // pastdue LITIGATION2
   $(document).on('click', '#conspastLitigation2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_conspastLitigation2.php', '<?php echo $id; ?>');
   });
   // trasnfer to ROPA
   $(document).on('click', '#consttLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consttLitigation.php', '<?php echo $id; ?>');
   });
   // prep Consolidated
   $(document).on('click', '#consPrepConsoShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consPrepConso.php', '<?php echo $id; ?>');
   });
   // due and DEMANDABLE
   $(document).on('click', '#consaDemandShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ac_consaDemand.php', '<?php echo $id; ?>');
   });
</script>

<script>
   var historyModal = $('#showOldModal');
   $(document).on('click', '#btnCloseModal', function(){
      historyModal.hide();
      if ($.fn.DataTable.isDataTable('#oldFile')) {
         $('#oldFile').DataTable().destroy();
      }
      });
   // 1st Demand
   $(document).on('click', '#consfLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#consfLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#consfLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 2nd Demand
   $(document).on('click', '#conssLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#conssLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#conssLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 3rd Demand
   $(document).on('click', '#constLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#constLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#constLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // Final Demand
   $(document).on('click', '#consfdLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#consfdLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#consfdLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // Other ATTACHMENT
   $(document).on('click', '#clientReq1ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#clientReq2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#clientReq3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // foreclosure
   $(document).on('click', '#consffClosureShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // pastdue Litigation
   $(document).on('click', '#conspastLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // pastdue Litigation2
   $(document).on('click', '#conspastLitigation2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // transfer to ROPA
   $(document).on('click', '#consttLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // prep Consolidated
   $(document).on('click', '#consPrepConsoShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
      // Due and Demandable
      $(document).on('click', '#consaDemandShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
</script>


<!-- Salary-FORM AJAX-->
<script>
  var salaryform = document.getElementById("salary-form");
  var branch = "<?php echo $branch; ?>";
  var consId = "<?php echo $id; ?>";
  var fullname= "<?php echo $fullname; ?>";
  var salaryType= "<?php echo $type; ?>";
  var loanType= "<?php echo $loanType; ?>";
  var endPrompt = ""; // Global variable for remarks
  function uploadFileS() {
    var salaryformData = new FormData(salaryform);
    salaryformData.append('consId', consId);
    salaryformData.append('fullname', fullname);
    salaryformData.append('salaryType', salaryType);
    salaryformData.append('branch', branch);
    salaryformData.append('loanType', loanType);

   // Append the endPrompt to the FormData
   salaryformData.append('endPrompt', endPrompt);
    
    $.ajax({
      url: 'dueFormConsUpload.php', 
      type: 'POST',
      data: salaryformData,
      processData: false,
      contentType: false,
      success: function(response) {
      // BORROWER
      updateFileStatus('loanAppForm', 'loanAppFormImage',`loanAppFormSelect`);
      updateFileStatus('memoAgreementS', 'memoAgreementSImage');
      updateFileStatus('certofEmployment', 'certofEmploymentImage');
      updateFileStatus('latestPayslip', 'latestPayslipImage');
      updateFileStatus('tin', 'tinImage');
      updateFileStatus('clearanceLoan', 'clearanceLoanImage');
      // CO MAKER 1
      updateFileStatus('coMaker1', 'coMaker1Image');
      updateFileStatus('validSignatures', 'validSignaturesImage');
      updateFileStatus('monthsPayslip', 'monthsPayslipImage');
      // CO MAKER 2
      updateFileStatus('coMaker2', 'coMaker2Image');
      updateFileStatus('validSignatures2', 'validSignatures2Image');
      updateFileStatus('monthsPayslip2', 'monthsPayslip2Image');
      // DOCUMENTS
      updateFileStatus('deductRemit', 'deductRemitImage');
      updateFileStatus('cashflowScore', 'cashflowScoreImage');
      updateFileStatus('loanAppMemo', 'loanAppMemoImage');
      updateFileStatus('promissoryNoteS', 'promissoryNoteSImage');
      updateFileStatus('disclosureStateS', 'disclosureStateSImage');
      updateFileStatus('amortScheduleS', 'amortScheduleSImage');
      resetIndex('loanAppForm', 'loanAppFormSelect', 'loanAppFormDesc');
      // LETTER
      updateFileStatus('consfLetter', 'consfLetterImage');
      updateFileStatus('conssLetter', 'conssLetterImage');
      updateFileStatus('constLetter', 'constLetterImage');
      updateFileStatus('consfdLetter', 'consfdLetterImage');
      // LETTER2  
      updateFileStatus('consfLetter2', 'consfLetter2Image');
      updateFileStatus('conssLetter2', 'conssLetter2Image');
      updateFileStatus('constLetter2', 'constLetter2Image');
      updateFileStatus('consfdLetter2', 'consfdLetter2Image'); 
      // LETTER3
      updateFileStatus('consfLetter3', 'consfLetter3Image');
      updateFileStatus('conssLetter3', 'conssLetter3Image');
      updateFileStatus('constLetter3', 'constLetter3Image');
      updateFileStatus('consfdLetter3', 'consfdLetter3Image');   
      // OTHER ATTACHMENT
      updateFileStatus('clientReq1', 'clientReq1Image');
      updateFileStatus('clientReq2', 'clientReq2Image');
      updateFileStatus('clientReq3', 'clientReq3Image');
      // LEGAL
      updateFileStatus('consffClosure', 'consffClosureImage');
      updateFileStatus('conspastLitigation', 'conspastLitigationImage');
      updateFileStatus('conspastLitigation2', 'conspastLitigation2Image');
      updateFileStatus('consttLitigation', 'consttLitigationImage');
      updateFileStatus('consPrepConso', 'consPrepConsoImage');
      updateFileStatus('consaDemand', 'consaDemandImage');

      },
      error: function(xhr, status, error) {
        console.log('File upload failed');
      }
    });
  }
  function handleEndorsementUpload(inputSelector) {
    var endPrompt = prompt('Remarks: ');

    if (endPrompt !== null && endPrompt.trim() !== "") {
        // Create FormData object
        var formData = new FormData();
        var consId = "<?php echo $id; ?>";
        // Trigger the file input and append the selected file to the form data
        setTimeout(function () {
            var fileInput = document.querySelector(inputSelector);
            fileInput.onchange = function () {
                var file = fileInput.files[0];
                if (file) {
                    formData.append(fileInput.name, file);  // Add file to the form data
                    formData.append('endPrompt', endPrompt); // Add remarks to the form data
                    formData.append('consId',  consId);

                    // Log FormData before sending
                    console.log("FormData before AJAX:", Array.from(formData.entries()));

                    // Send form data via AJAX
                    $.ajax({
                        url: 'dueFormConsUpload.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            alert('Updated Successfully!');
                            console.log('Server Response:', response);

                            // Update the UI dynamically (optional, depends on your requirements)
                            // For example, refresh a section of the page or notify the user
                        },
                        error: function () {
                            alert('Failed to upload');
                        }
                    });
                }
            };
            $(inputSelector).click(); // Trigger file input click
        }, 1000); // Adjust the timeout as necessary
    } else {
        alert('Remarks are required to proceed.');
        console.log('Prompt was cancelled or empty.');
    }
}

   // for consfLetter
   $(document).on('click', '.consfLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consfLetter');
   });
   $(document).on('click', '.consfLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consfLetter2');
   });
   $(document).on('click', '.consfLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consfLetter3');
   });
   // for conssLetter
   $(document).on('click', '.conssLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#conssLetter');
   });
   $(document).on('click', '.conssLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#conssLetter2');
   });
   $(document).on('click', '.conssLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#conssLetter3');
   });
   // for constLetter
   $(document).on('click', '.constLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#constLetter');
   });
   $(document).on('click', '.constLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#constLetter2');
   });
   $(document).on('click', '.constLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#constLetter3');
   });
   // for consfdLetter
   $(document).on('click', '.consfdLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consfdLetter');
   });
   $(document).on('click', '.consfdLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consfdLetter2');
   });
   $(document).on('click', '.consfdLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consfdLetter3');
   });
   // for Other Attachments
   $(document).on('click', '.clientReq1New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#clientReq1');
   });
   $(document).on('click', '.clientReq2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#clientReq2');
   });
   $(document).on('click', '.clientReq3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#clientReq3');
   });
   // for foreclosure
   $(document).on('click', '.consffClosureNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consffClosure');
   });
   // for pastdue Litigation
   $(document).on('click', '.conspastLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#conspastLitigation');
   });
   // for pastdue Litigation
   $(document).on('click', '.conspastLitigation2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#conspastLitigation2');
   });
   // for transfer to ROPA
   $(document).on('click', '.consttLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consttLitigation');
   });
   // prep Consolidated
   $(document).on('click', '.consPrepConsoNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consPrepConso');
   });
   // for Due and Demandable
   $(document).on('click', '.consaDemandNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#consaDemand');
   });

  salaryform.addEventListener("change", function() {
    uploadFileS();
  });
</script>
<!-- Approval Status and Description -->
<script>
function selectOptionBasedOnValue(fieldValue, selectionId,description,target) {
  var dropdown = document.getElementById(selectionId);
  for (var i = 0; i < dropdown.options.length; i++) {
    if (dropdown.options[i].value === fieldValue) {
      if(fieldValue=="2"){
        document.getElementById(description).style.visibility="visible";
        document.getElementById(description).value = target;
        dropdown.selectedIndex = i;
        break;
      }
      else{
      document.getElementById(description).style.visibility="hidden";
      document.getElementById(description).value = target;
      dropdown.selectedIndex = i;
      break;
      }
    }
  }
}

// Using explode to Cut the data into two, So it can be print back to textfield
// BORROWER
selectOptionBasedOnValue('<?php echo explode('--', $loanAppFormSelect)[0]; ?>', 'loanAppFormSelect','loanAppFormDesc','<?php echo explode("--", $loanAppFormSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $memoAgreementSelect)[0]; ?>', 'memoAgreementSelect','memoAgreementSDesc','<?php echo explode("--", $memoAgreementSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $certEmploymentSelect)[0]; ?>', 'certEmploymentSelect','certofEmploymentDesc','<?php echo explode("--", $certEmploymentSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $payslipSelect)[0]; ?>', 'payslipSelect','latestPayslipDesc','<?php echo explode("--", $payslipSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $tinSelect)[0]; ?>', 'tinSelect','tinDesc','<?php echo explode("--", $tinSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $clearanceLoanSelect)[0]; ?>', 'clearanceLoanSelect','clearanceLoanDesc','<?php echo explode("--", $clearanceLoanSelect)[1]; ?>');
// CO-MAKER 1
selectOptionBasedOnValue('<?php echo explode('--', $coMaker1Select)[0]; ?>', 'coMaker1Select','coMaker1Desc','<?php echo explode("--", $coMaker1Select)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $validSignaturesSelect)[0]; ?>', 'validSignaturesSelect','validSignaturesDesc','<?php echo explode("--", $validSignaturesSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $monthsPayslipSelect)[0]; ?>', 'monthsPayslipSelect','monthsPayslipDesc','<?php echo explode("--", $monthsPayslipSelect)[1]; ?>');
// CO-MAKER 2
selectOptionBasedOnValue('<?php echo explode('--', $coMaker2Select)[0]; ?>', 'coMaker2Select','coMaker2Desc','<?php echo explode("--", $coMaker2Select)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $validSignatures2Select)[0]; ?>', 'validSignatures2Select','validSignatures2Desc','<?php echo explode("--", $validSignatures2Select)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $monthsPayslip2Select)[0]; ?>', 'monthsPayslip2Select','monthsPayslip2Desc','<?php echo explode("--", $monthsPayslip2Select)[1]; ?>');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo explode('--', $deductRemitSelect)[0]; ?>', 'deductRemitSelect','deductRemitDesc','<?php echo explode("--", $deductRemitSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $cashflowScoreSelect)[0]; ?>', 'cashflowScoreSelect','cashflowScoreDesc','<?php echo explode("--", $cashflowScoreSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $loanAppMemoSelect)[0]; ?>', 'loanAppMemoSelect','loanAppMemoDesc','<?php echo explode("--", $loanAppMemoSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $promissoryNoteSSelect)[0]; ?>', 'promissoryNoteSSelect','promissoryNoteSDesc','<?php echo explode("--", $promissoryNoteSSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $disclosureStateSSelect)[0]; ?>', 'disclosureStateSSelect','disclosureStateSDesc','<?php echo explode("--", $disclosureStateSSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $amortScheduleSSelect)[0]; ?>', 'amortScheduleSSelect','amortScheduleSDesc','<?php echo explode("--", $amortScheduleSSelect)[1]; ?>');
</script>



<script>

   function resetIndex(targetId,targetSelect,targetDesc){
  document.getElementById(targetId).addEventListener('change', function() {
  var selectElement = document.getElementById(targetSelect);
  selectElement.selectedIndex = 0;
  document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
  });
  }

resetIndex('loanAppForm', 'loanAppFormSelect', 'loanAppFormDesc');
resetIndex('memoAgreementS', 'memoAgreementSelect', 'memoAgreementSDesc');
resetIndex('certofEmployment', 'certEmploymentSelect', 'certofEmploymentDesc');
resetIndex('latestPayslip', 'payslipSelect', 'latestPayslipDesc');
resetIndex('tin', 'tinSelect', 'tinDesc');
resetIndex('clearanceLoan', 'clearanceLoanSelect', 'clearanceLoanDesc');
resetIndex('coMaker1', 'coMaker1Select', 'coMaker1Desc');
resetIndex('validSignatures', 'validSignaturesSelect', 'validSignaturesDesc');
resetIndex('monthsPayslip', 'monthsPayslipSelect', 'monthsPayslipDesc');
resetIndex('coMaker2', 'coMaker2Select', 'coMaker2Desc');
resetIndex('validSignatures2', 'validSignatures2Select', 'validSignatures2Desc');
resetIndex('monthsPayslip2', 'monthsPayslip2Select', 'monthsPayslip2Desc');
resetIndex('deductRemit', 'deductRemitSelect', 'deductRemitDesc');
resetIndex('cashflowScore', 'cashflowScoreSelect', 'cashflowScoreDesc');
resetIndex('loanAppMemo', 'loanAppMemoSelect', 'loanAppMemoDesc');
resetIndex('promissoryNoteS', 'promissoryNoteSSelect', 'promissoryNoteSDesc');
resetIndex('disclosureStateS', 'disclosureStateSSelect', 'disclosureStateSDesc');
resetIndex('amortScheduleS', 'amortScheduleSSelect', 'amortScheduleSDesc');
// // LETTER
// resetIndex('sfLetter', 'sfLetterSelect', 'sfLetterDesc');
// resetIndex('ssLetter', 'ssLetterSelect', 'ssLetterDesc');
// resetIndex('stLetter', 'stLetterSelect', 'stLetterDesc');
// resetIndex('sfdLetter', 'sfdLetterSelect', 'sfdLetterDesc');
// // LEGAL
// resetIndex('sffClosure', 'sffClosureSelect', 'sffClosureDesc');
// resetIndex('sttLitigation', 'sttLitigationSelect', 'sttLitigationDesc');
// resetIndex('saDemand', 'saDemandSelect', 'saDemandDesc');

</script> 

<script>
function initializePastCheck() {  
  var pastCheckVal = "<?php echo $conspastCheck; ?>";

  // Get the checkbox elements
  const pastCheckk = document.getElementById('conspastCheck');

  // Check the checkboxes based on the PHP Data
   function showInput2(inputValue2, checkbox2) {
      if (inputValue2 === "Yes") {
         checkbox2.setAttribute('checked', 'Yes');
      } else if(inputValue2=="No" || inputValue2==""){
         checkbox2.setAttribute('unchecked', 'No');
      }     
   }
   showInput2(pastCheckVal, pastCheckk);
}
// Call the function to initialize the checkboxes on page load
initializePastCheck();
</script>

<script>
   // # Hidden Letter & Legal
   // function hiddenLetter(){
   //    var late = $('#hiddenLate').val();
   //    var fLetter = $('#hiddenif').val();
   //    var fLetter2 = $('#hiddenif2').val();
   //    var fLetterSelect = $('#ifLetterSelect').val();
   //    var sLetter = $('#hiddenis').val();
   //    var sLetter2 = $('#hiddenis2').val();
   //    var sLetterSelect = $('isLetterSelect').val();
   //    var tLetter = $('#hiddenit').val();
   //    var tLetter2 = $('#hiddenit2').val();
   //    var tLetterSelect = $('itLetterSelect').val();
   //    // if true = & disable || readonly.
   //    if(late >= 1 && late <= 30){
   //       document.getElementById('consfLetter').style.visibility = "true";
   //       document.getElementById('consfLetter2').style.visibility = "true";
   //       document.getElementById('consfLetter3').style.visibility = "true";
   //       document.getElementById('consfLetterSelect').style.visibility = "true";
   //       document.getElementById('consfLetterImage').style.visibility = "true";
   //       document.getElementById('consfLetter2Image').style.visibility = "true";
   //       document.getElementById('consfLetter3Image').style.visibility = "true";
   //    }
   //    else{
   //       if(late <= 0){
   //          document.getElementById('consfLetter').style.visibility = "hidden";
   //          document.getElementById('consfLetter2').style.visibility = "hidden";
   //          document.getElementById('consfLetter3').style.visibility = "hidden";
   //          document.getElementById('consfLetterSelect').style.visibility = "hidden";
   //          document.getElementById('consfLetterImage').style.visibility = "hidden";
   //          document.getElementById('consfLetter2Image').style.visibility = "hidden";
   //          document.getElementById('consfLetter3Image').style.visibility = "hidden";
   //       }
   //    }
   //    if(fLetterSelect != '' && fLetter != '' && fLetter2 != '' && late >= 31 && late <= 60){
   //       document.getElementById('conssLetter').style.visibility = "true";
   //       document.getElementById('conssLetter2').style.visibility = "true";
   //       document.getElementById('conssLetter3').style.visibility = "true";
   //       document.getElementById('conssLetterSelect').style.visibility = "true";
   //       document.getElementById('conssLetterImage').style.visibility = "true";
   //       document.getElementById('conssLetter2Image').style.visibility = "true";
   //       document.getElementById('conssLetter3Image').style.visibility = "true";
   //    }else{
   //       document.getElementById('conssLetter').style.visibility = "hidden";
   //       document.getElementById('conssLetter2').style.visibility = "hidden";
   //       document.getElementById('conssLetter3').style.visibility = "hidden";
   //       document.getElementById('conssLetterSelect').style.visibility = "hidden";
   //       document.getElementById('conssLetterImage').style.visibility = "hidden";
   //       document.getElementById('conssLetter2Image').style.visibility = "hidden";
   //       document.getElementById('conssLetter3Image').style.visibility = "hidden";
   //    }
   //    if(sLetter != '' && sLetterSelect != '' && sLetter2 != '' && late >= 61 && late <= 91){
   //       document.getElementById('constLetter').style.visibility = "true";
   //       document.getElementById('constLetter2').style.visibility = "true";
   //       document.getElementById('constLetter3').style.visibility = "true";
   //       document.getElementById('constLetterSelect').style.visibility = "true";
   //       document.getElementById('constLetterImage').style.visibility = "true";
   //       document.getElementById('constLetter2Image').style.visibility = "true";
   //       document.getElementById('constLetter3Image').style.visibility = "true";
   //    }else{
   //       document.getElementById('constLetter').style.visibility = "hidden";
   //       document.getElementById('constLetter2').style.visibility = "hidden";
   //       document.getElementById('constLetter3').style.visibility = "hidden";
   //       document.getElementById('constLetterSelect').style.visibility = "hidden";
   //       document.getElementById('constLetterImage').style.visibility = "hidden";
   //       document.getElementById('constLetter2Image').style.visibility = "hidden";
   //       document.getElementById('constLetter3Image').style.visibility = "hidden";
   //    }
   //    if(tLetter != '' && tLetterSelect != '' && tLetter2 != '' && late >= 92){ // up to 107 days late
   //       document.getElementById('consfdLetter').style.visibility = "true";
   //       document.getElementById('consfdLetter2').style.visibility = "true";
   //       document.getElementById('consfdLetter3').style.visibility = "true";
   //       document.getElementById('consfddLetterSelect').style.visibility = "true";
   //       document.getElementById('consfdLetterImage').style.visibility = "true";
   //       document.getElementById('consfdLetter2Image').style.visibility = "true";
   //       document.getElementById('consfdLetter3Image').style.visibility = "true";
   //    }else{
   //       document.getElementById('consfdLetter').style.visibility = "hidden";
   //       document.getElementById('consfdLetter2').style.visibility = "hidden";
   //       document.getElementById('consfdLetter3').style.visibility = "hidden";
   //       document.getElementById('consfdLetterSelect').style.visibility = "hidden";
   //       document.getElementById('consfdLetterImage').style.visibility = "hidden";
   //       document.getElementById('consfdLetter2Image').style.visibility = "hidden";
   //       document.getElementById('consfdLetter3Image').style.visibility = "hidden";
   //    }
   // }
   // hiddenLetter();
</script>

<script>   
    function handleSearch() {
        const selectElements = document.querySelectorAll('#salary select');
        const descriptionInputs = document.querySelectorAll('#salary input[type="text"]');
        const inputFiles = document.querySelectorAll('.salary-tabs input[type=file]');
        const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
        const creditButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
        var username = "<?php echo $_SESSION['username']; ?>";
        var bankposition = "<?php echo $_SESSION['bankposition']; ?>";
        var position = "<?php echo $_SESSION['position']; ?>";
        var department = "<?php echo $_SESSION['department']; ?>";

            // APPROVAL BUTTONS RESTRICTION
            if (department !== "1" && department !== "6" && position !== "BM") {
                  selectElements.forEach(function(selectElement) {
                     selectElement.style.pointerEvents = "none";
             });
                  descriptionInputs.forEach(function(descriptionInput) {
                      descriptionInput.style.pointerEvents = "none";
             });
            }

    
   // REQUIREMENTS RESTRICTION
   if(position !== "BM" && department !== "1"){
      inputFiles.forEach(function(inputFile){
         inputFile.style.display="none";
      });
   }
   if(bankposition !== "LOAN Assistant" && position !== "BM" && department !=="1"){
      document.getElementById("deductRemit").style.display="none";
   } 
   if(bankposition !== "LOAN Assistant" && position !== "BM" && username !=="apreyes" && department !=="1"){
      document.getElementById("cashflowScore").style.display="none";
      document.getElementById("loanAppMemo").style.display="none";
      document.getElementById("promissoryNoteS").style.display="none";
      document.getElementById("disclosureStateS").style.display="none";
      document.getElementById("amortScheduleS").style.display="none";
   } 

   if(department !== "6" && department !== "1" && position !== "BM"){
      document.getElementById("consfLetter").style.visibility="hidden";
      document.getElementById("consfLetter2").style.visibility="hidden";
      document.getElementById("consfLetter3").style.visibility="hidden";
      document.getElementById("conssLetter").style.visibility="hidden";
      document.getElementById("conssLetter2").style.visibility="hidden";
      document.getElementById("conssLetter3").style.visibility="hidden";
      document.getElementById("constLetter").style.visibility="hidden";
      document.getElementById("constLetter2").style.visibility="hidden";
      document.getElementById("constLetter3").style.visibility="hidden";
      document.getElementById("consfdLetter").style.visibility="hidden";
      document.getElementById("consfdLetter2").style.visibility="hidden";
      document.getElementById("consfdLetter3").style.visibility="hidden";
      document.getElementById("clientReq1").style.visibility="hidden";
      document.getElementById("clientReq2").style.visibility="hidden";
      document.getElementById("clientReq3").style.visibility="hidden";

      // 
      document.getElementById("consffClosure").style.visibility="hidden";
      document.getElementById("conspastLitigation").style.visibility="hidden";
      document.getElementById("conspastLitigation2").style.visibility="hidden";
      document.getElementById("conspastCheck").style.visibility="hidden";
      document.getElementById("label23").style.visibility="hidden";
      document.getElementById("consttLitigation").style.visibility="hidden";
      document.getElementById("consPrepConso").style.visibility="hidden";
      document.getElementById("consaDemand").style.visibility="hidden";
   }

    }

    // Important!!, Allow the it to initially run this function first.
    handleSearch();


</script>
<script>
document.getElementById("copyLink").addEventListener("click", function() {
   var copyText = document.getElementById("linkGenerated");
   copyText.select();
   copyText.setSelectionRange(0, 99999);
   clipboard.writeText(copyText.value);
   try {
       navigator.clipboard.writeText(copyText.value).then(function() {
           alert('Copied Sucessfully');
       }).catch(function(err) {
           console.error('Unable to copy link: ', err);
       });
   } catch (err) {
       console.error('Unable to copy link: ', err);
   }
});
</script>


<script>
   function showText(target,position){
      var modal = document.getElementById("myModal");
      var span = document.getElementById("closeModal");
      var btn = document.getElementById(target);
      var modalText = document.getElementById("modalText"); 


      // When the button is clicked, display the modal
      btn.addEventListener("click", function () {
            modalText.textContent = btn.value; // Set the modalText content
            modal.style.marginTop = position;
            modal.style.display = "block";
         
      });

      btn.addEventListener("input", function () {
            modalText.textContent = btn.value; // Set the modalText content
            modalText.textContent = textField.value;
         
      });
      // When the 'x' (close) is clicked, close the modal
      span.addEventListener("click", function () {
         modal.style.display = "none";
      });

      // When the background is clicked, close the modal
      window.addEventListener("click", function (event) {
         if (event.target === modal) {
            modal.style.display = "none";
         }
      });

      }
// LETTERS
showText('consfLetterSelect','42%');
showText('conssLetterSelect','42%');
showText('constLetterSelect','42%');
showText('consfdLetterSelect','42%');
showText('clientReq1Select','42%');

showText('consffClosureSelect','42%');
showText('conspastLitigationSelect','42%');
showText('consttLitigationSelect','42%');
showText('consPrepConsoSelect','42%');
showText('consaDemandSelect','42%');

    </script>

</body>
</html>