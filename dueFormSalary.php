<?php
include('connection.php');
include('fileuploadloan.php');

// public id for Loan
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
<!-- <html lang="en">
   <head>

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
   </head>
   <body>
      <style>
         .nav-item .nav-link.active {
         background-color: #F5F5F5;
         }
      </style> -->

<!doctype html>
<html lang="en">
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
<style>
@media screen and (max-width: 1921px){
  @-ms-viewport { }
  body {
    zoom: 100%;
  }
}
   /* 125% */
   @media screen and (max-width: 1536px){
  @-ms-viewport { }
  body {
    zoom: 80%;
  }
}

/* @media screen and (max-width: 1746.45px){
  @-ms-viewport { }
  body {
    zoom: 95%;
  }
} */
  /* 150% */
  @media screen and (max-width: 1281px){
  @-ms-viewport { }
   body {
      zoom: 75%;
   }

   #showOldModal .modal-dialog {
    zoom: 75%;
    top: 20%!important;
   }
  
}

@media screen and (max-width: 1098.14px){
  @-ms-viewport { }
  body {
    zoom: 75%;
  }
  #showOldModal .modal-dialog {
     zoom: 75%;
     top: 20%!important;
   }
}

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
    top: 50% !important;  
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
             while ($row = mysqli_fetch_array($data)) {
                 $Cfname= $row['customerFirstName'];
                 $Lfname= $row['customerSurname'];
                 $fullname=$row['customerFullName'];
                 $birth=$row['birthDate'];
                 $id=$row['loan_Id'];
                 $type=$row['salaryType'];
                 $branch=$row['branch'];
                 $loanType=$row['loanType'];
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
         
         // Disable Tab Buttons
         if($type == "Salary Loan") {       
         ?>
      <script>
         document.getElementById('tab2').classList.add('active');;
         document.getElementById('salary').classList.add('active');
         document.getElementById('tab1').setAttribute(', ');
         document.getElementById('tab3').setAttribute(', ');
         document.getElementById('tab4').setAttribute(', ');     
      </script>
      <?php
         $query1 = "SELECT a.*, m.* FROM salaryloan AS m
                                                   LEFT JOIN salaryarchive AS a ON m.salaryLoanId = a.a_salaryLoanId
                                                   WHERE m.salaryLoanId= '$id'
                                          ";
         $newdata = mysqli_query($con, $query1) ;
         $row = mysqli_fetch_array($newdata);
         // BORROWER
         $loanAppForm=$row['loanAppForm'];
         $memoAgreementS=$row['memoAgreementS'];
         $certofEmployment=$row['certofEmployment'];
         $latestPayslip=$row['latestPayslip'];
         $tin=$row['tin'];
         $clearanceLoan=$row['clearanceLoan'];
         // CO MAKER 1
         $coMaker1=$row['coMaker1'];
         $validSignatures=$row['validSignatures'];
         $monthsPayslip=$row['monthsPayslip'];
         // CO MAKER 2
         $coMaker2=$row['coMaker2'];
         $validSignatures2=$row['validSignatures2'];
         $monthsPayslip2=$row['monthsPayslip2'];
         // DOCUMENTS
         $deductRemit=$row['deductRemit'];
         $cashflowScore=$row['cashflowScore'];
         $loanAppMemo=$row['loanAppMemo'];
         $promissoryNoteS=$row['promissoryNoteS'];
         $disclosureStateS=$row['disclosureStateS'];
         $amortScheduleS=$row['amortScheduleS'];
         // LETTER
         $sfLetter = $row['sfLetter'];
         $ssLetter = $row['ssLetter'];
         $stLetter = $row['stLetter'];
         $sfdLetter = $row['sfdLetter'];
         //  LETTER2
         $sfLetter2 = $row['sfLetter2'];
         $ssLetter2 = $row['ssLetter2'];
         $stLetter2 = $row['stLetter2'];
         $sfdLetter2 = $row['sfdLetter2'];
         //  LETTER3
         $sfLetter3 = $row['sfLetter3'];
         $ssLetter3 = $row['ssLetter3'];
         $stLetter3 = $row['stLetter3'];
         $sfdLetter3 = $row['sfdLetter3'];
         // OTHER ATTACHMENT
         $sclientReq1 = $row['sclientReq1'];
         $sclientReq2 = $row['sclientReq2'];
         $sclientReq3 = $row['sclientReq3'];

         $sclientReq1Select = $row['sclientReqRemarks'];
         // LEGAL
         $sffClosure = $row['sffClosure'];
         $spastLitigation = $row['spastDueLitigation'];
         $spastLitigation2 = $row['spastDueLitigation2'];
         $sttLitigation = $row['sttLitigation'];
         $sPrepConso = $row['sPrepConso'];
         $saDemand = $row['saDemand'];

         // ARCHIVED
         $a_sfLetter = $row['a_sfLetter'];
         $a_ssLetter = $row['a_ssLetter'];
         $a_stLetter  = $row['a_stLetter'];
         $a_sfdLetter = $row['a_sfdLetter'];

         $a_sfLetter2 = $row['a_sfLetter2'];
         $a_ssLetter2 = $row['a_ssLetter2'];
         $a_stLetter2 = $row['a_stLetter2'];
         $a_sfdLetter2 = $row['a_sfdLetter2'];
         
         $a_sfLetter3 = $row['a_sfLetter3'];
         $a_ssLetter3 = $row['a_ssLetter3'];
         $a_stLetter3 = $row['a_stLetter3'];
         $a_sfdLetter3 = $row['a_sfdLetter3'];

         // OTHER ATTACHMENT
         $a_sclientReq1 = $row['a_sclientReq1'];
         $a_sclientReq2 = $row['a_sclientReq2'];
         $a_sclientReq3 = $row['a_sclientReq3'];
         $a_sclientReqRemarks = $row['a_sclientReqRemarks'];

         $a_mffClosure = $row['a_mffClosure'];
         $a_mpastLitigation = $row['a_mpastDueLitigation'];
         $a_mpastLitigation2 = $row['a_mpastDueLitigation'];
         $a_mttLitigation = $row['a_mtransferLitigation'];
         $a_sfLetter = $row['a_sfLetter'];
         $a_maDemand = $row['a_maDemand'];
         // BORROWER STATUS
         $loanAppFormSelect = $row['loanAppFormStatus'];
         $memoAgreementSelect = $row['memoAgreementStatus'];
         $certEmploymentSelect = $row['certofEmploymentStatus'];
         $payslipSelect = $row['latestPayslipStatus'];
         $tinSelect = $row['tinStatus'];
         $clearanceLoanSelect = $row['clearanceLoanStatus'];
         // CO MAKER 1 STATUS
         $coMaker1Select = $row['coMaker1Status'];
         $validSignaturesSelect = $row['validSignaturesStatus'];
         $monthsPayslipSelect = $row['monthsPayslipStatus'];
         // CO MAKER 2 STATUS
         $coMaker2Select = $row['coMaker2Status'];
         $validSignatures2Select = $row['validSignatures2Status'];
         $monthsPayslip2Select = $row['monthsPayslip2Status'];
         // DOCUEMENTS
         $deductRemitSelect = $row['deductRemitStatus'];
         $cashflowScoreSelect = $row['cashflowScoreStatus'];
         $loanAppMemoSelect = $row['loanAppMemoStatus'];
         $promissoryNoteSSelect = $row['promissoryNoteSStatus'];
         $disclosureStateSSelect = $row['disclosureStateSStatus'];
         $amortScheduleSSelect = $row['amortScheduleSStatus'];
          // LETTER SELECT
          $sfLetterSelect = $row['sfLetterRemarks'];
          $ssLetterSelect = $row['ssLetterRemarks'];
          $stLetterSelect = $row['stLetterRemarks'];
          $sfdLetterSelect = $row['sfdLetterRemarks'];
          // LEGAL SELECT
          $sffClosureSelect = $row['sffClosureRemarks'];
          $spastLitigationSelect = $row['spastLitigationRemarks'];
          $sttLitigationSelect = $row['sttLitigationRemarks'];
          $sPrepConsoSelect = $row['sPrepConsoRemarks'];
          $saDemandSelect = $row['saDemandRemarks'];

          
            // LEGAL PASTCHECK
         $spastCheck = $row['spastCheck'];
         
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
         setFileVisibility($sfLetter, "forsfLetter", "sfLetterImage","sfLetterButton", $sfLetterSelect,"sfLetterDate");
         setFileVisibility($ssLetter, "forssLetter", "ssLetterImage","ssLetterButton", $ssLetterSelect,"ssLetterDate");
         setFileVisibility($stLetter, "forstLetter", "stLetterImage","stLetterButton", $stLetterSelect,"stLetterDate");
         setFileVisibility($sfdLetter, "forsfdLetter", "sfdLetterImage","sfdLetterButton", $sfdLetterSelect,"sfdLetterDate");
         //  LETTER2
         setFileVisibility($sfLetter2, "forsfLetter2", "sfLetter2Image","sfLetter2Button", "", "");
         setFileVisibility($ssLetter2, "forssLetter2", "ssLetter2Image","ssLetter2Button", "", "");
         setFileVisibility($stLetter2, "forstLetter2", "stLetter2Image","stLetter2Button", "", "");
         setFileVisibility($sfdLetter2, "forsfdLetter2", "sfdLetter2Image","sfdLetter2Button", "", "");
         //  LETTER3
         setFileVisibility($sfLetter3, "forsfLetter3", "sfLetter3Image","sfLetter3Button", "", "");
         setFileVisibility($ssLetter3, "forssLetter3", "ssLetter3Image","ssLetter3Button", "", "");
         setFileVisibility($stLetter3, "forstLetter3", "stLetter3Image","stLetter3Button", "", "");
         setFileVisibility($sfdLetter3, "forsfdLetter3", "sfdLetter3Image","sfdLetter3Button", "", "");
            // OTHER ATTACHMENT
         setFileVisibility($sclientReq1, "forsclientReq1", "sclientReq1Image", "sclientReq1Button", $sclientReq1Select, "sclientReq1Date");
         setFileVisibility($sclientReq2, "forsclientReq2", "sclientReq2Image", "sclientReq2Button", "", "");
         setFileVisibility($sclientReq3, "forsclientReq3", "sclientReq3Image", "sclientReq3Button", "", "");
         // LEGAL
         setFileVisibility($sffClosure, "forsffClosure", "sffClosureImage", "sffClosureButton", $sffClosureSelect, "sffClosureDate");
         setFileVisibility($spastLitigation, "forspastLitigation", "spastLitigationImage", "spastLitigationButton", $spastLitigationSelect, "spastLitigationDate");
         setFileVisibility($spastLitigation2, "forspastLitigation2", "spastLitigation2Image", "spastLitigation2Button", "", "");
         setFileVisibility($sttLitigation, "forsttLitigation", "sttLitigationImage", "sttLitigationButton", $sttLitigationSelect, "sttLitigationDate");
         setFileVisibility($sPrepConso, "forsPrepConso", "sPrepConsoImage", "sPrepConsoButton", $sPrepConsoSelect, "sPrepConsoDate");
         setFileVisibility($saDemand, "forsaDemand", "saDemandImage", "saDemandButton", $saDemandSelect, "saDemandDate");
         
         
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
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab2" href="#salary">Salary</a>
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
                                 <div id="nextbankSection" style="position: absolute; top: 0; right: 0; margin-right: 4.4em;">
                                    <div class="form">
                                          <input hidden type="text" class="form-control" id="productID" name="productID" style="width: 25em; height: 4em; display: inline-block; font-size: 1.1em; font-weight: bold; " value="<?php echo $duecProdID; ?>" placeholder="NEXTBANK PRODUCT ID" tabindex="-1">
                                    </div>
                                 </div>
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
                                       <div class="salary-tabs" style="border-right: 1px solid #ccc; min-height: 142%; width: 100%; margin-top: -0.5%;">
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
                                             <input type="hidden" id="hiddenif" name="hiddenif" value="<?= $row['sfLetter']; ?>">
                                             <input type="hidden" id="hiddenif2" name="hiddenif2" value="<?= $row['sfLetter2']; ?>">
                                             <input type="hidden" id="hiddenLate" name="hiddenLate" value="<?= $duecDLate; ?>">
                                          </div>
                                          <div class="col-2">
                                             <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%;">&nbsp;</h5></div>
                                             <input type="file" id="sfLetter" name="sfLetter" style="display: none;">
                                             <label for="sfLetter" class="forsfLetter btn-sm" id="forsfLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($sfLetter)){
                                                   echo '<a href="' . $sfLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sfLetterButton" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="sfLetterNew" class="fa-solid fa-plus sfLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="sfLetterShowOld" class="fa-solid fa-scroll sfLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="sfLetterImage" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                             <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">REGISTRY RECEIPT</h5></div>
                                             <input type="file" id="sfLetter2" name="sfLetter2" style="display: none;">
                                             <label for="sfLetter2" class="forsfLetter2 btn-sm" id="forsfLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($sfLetter2)){
                                                   echo '<a href="' . $sfLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sfLetter2Button" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="sfLetter2New" class="fa-solid fa-plus sfLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="sfLetter2ShowOld" class="fa-solid fa-scroll sfLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="sfLetter2Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                             <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">RETURN RECEIPT</h5></div>
                                             <input type="file" id="sfLetter3" name="sfLetter3" style="display: none;">
                                             <label for="sfLetter3" class="forsfLetter3 btn-sm" id="forsfLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($sfLetter3)){
                                                   echo '<a href="' . $sfLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sfLetter3Button" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="sfLetter3New" class="fa-solid fa-plus sfLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="sfLetter3ShowOld" class="fa-solid fa-scroll sfLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="sfLetter3Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                                <!-- <div class="py-1"> -->
                                                <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 102%; border-right: 1px solid #ccc; margin-left: 9%;">DATE</h5></div>
                                                <label class="date-label" id="sfLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sfLetter, strrpos($sfLetter, '/') + 1, 10); ?></label>
                                                <!-- </div> -->
                                          </div>
                                       <div class="col-2">
                                          <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 108%; margin-left: -2%;">REMARKS</h5></div>
                                          <div class="form-group d-flex mb-4" id="">
                                             &nbsp;&nbsp;<input type="text" id="sfLetterSelect" name="sfLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['sfLetterRemarks']; ?>">
                                             &nbsp;&nbsp;<input type="hidden" class="fom-control w-75 p-1 fs-4" placeholder="REMARKS" id="sfLetterDesc" name="sfLetterDesc" >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-2">
                                             <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">SECOND LETTER</label>
                                             <input type="hidden" id="hiddenis" name="hiddenis" value="<?= $row['ssLetter']; ?>">
                                             <input type="hidden" id="hiddenis2" name="hiddenis2" value="<?= $row['ssLetter2']; ?>">
                                       </div>
                                       <div class="col-2">
                                             <input type="file" id="ssLetter" name="ssLetter" style="display: none;">
                                             <label for="ssLetter" class="forssLetter btn-sm btn" id="forssLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($ssLetter)){
                                                   echo '<a href="' . $ssLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ssLetterButton" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="ssLetterNew" class="fa-solid fa-plus ssLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="ssLetterNew" class="fa-solid fa-plus ssLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="ssLetterShowOld" class="fa-solid fa-scroll ssLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="ssLetterImage" src="statusImage/check.png" alt="statusImage">
                                       </div>
                                       <div class="col-2">
                                             <input type="file" id="ssLetter2" name="ssLetter2" style="display: none;">
                                             <label for="ssLetter2" class="forssLetter2 btn-sm btn" id="forssLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($ssLetter2)){
                                             echo '<a href="' . $ssLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ssLetter2Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="ssLetter2New" class="fa-solid fa-plus ssLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="ssLetter2New" class="fa-solid fa-plus ssLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="ssLetter2ShowOld" class="fa-solid fa-scroll ssLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="ssLetter2Image" src="statusImage/check.png" alt="statusImage">
                                       </div>
                                       <div class="col-2">
                                             <input type="file" id="ssLetter3" name="ssLetter3" style="display: none;">
                                             <label for="ssLetter3" class="forssLetter3 btn-sm btn" id="forssLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($ssLetter3)){
                                                   echo '<a href="' . $ssLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ssLetter3Button" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="ssLetter3New" class="fa-solid fa-plus ssLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="ssLetter3New" class="fa-solid fa-plus ssLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="ssLetter3ShowOld" class="fa-solid fa-scroll ssLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="ssLetter3Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                       <div class="col-2">
                                             <label class="date-label" id="ssLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($ssLetter, strrpos($ssLetter, '/') + 1, 10); ?></label>
                                       </div>
                                       <div class="col-2" id="">
                                                <div class="form-group d-flex mb-4">
                                                   &nbsp;&nbsp;<input type="text" id="ssLetterSelect" name="ssLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['ssLetterRemarks']; ?>">
                                                   &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="ssLetterDesc" name="ssLetterDesc" >&nbsp;
                                                </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-2">
                                                <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">THIRD LETTER</label>
                                                <input type="hidden" id="hiddenit" name="hiddenit" value="<?= $row['stLetter']; ?>">
                                                <input type="hidden" id="hiddenit2" name="hiddenit" value="<?= $row['stLetter2']; ?>">
                                          </div>
                                          <div class="col-2">
                                                <input type="file" id="stLetter" name="stLetter" style="display: none;">
                                                <label for="stLetter" class="forstLetter btn-sm btn" id="forstLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($stLetter)){
                                                      echo '<a href="' . $stLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="stLetterButton" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="stLetterNew" class="fa-solid fa-plus stLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="stLetterNew" class="fa-solid fa-plus stLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="stLetterShowOld" class="fa-solid fa-scroll stLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                       <img id="stLetterImage" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                                <input type="file" id="stLetter2" name="stLetter2" style="display: none;">
                                                <label for="stLetter2" class="forstLetter2 btn-sm btn" id="forstLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($stLetter2)){
                                                      echo '<a href="' . $stLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="stLetter2Button" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="stLetter2New" class="fa-solid fa-plus stLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="stLetter2New" class="fa-solid fa-plus stLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="stLetter2ShowOld" class="fa-solid fa-scroll stLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                                <img id="stLetter2Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                             <input type="file" id="stLetter3" name="stLetter3" style="display: none;">
                                             <label for="stLetter3" class="forstLetter3 btn-sm btn" id="forstLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($stLetter3)){
                                                   echo '<a href="' . $stLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="stLetter3Button" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="stLetter3New" class="fa-solid fa-plus stLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="stLetter3New" class="fa-solid fa-plus stLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="stLetter3ShowOld" class="fa-solid fa-scroll stLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="stLetter3Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                                <label class="date-label" id="stLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($stLetter, strrpos($stLetter, '/') + 1, 10); ?></label>
                                          </div>
                                          <div class="col-2" id="">
                                                   <div class="form-group d-flex mb-4">
                                                      &nbsp;&nbsp;<input type="text" id="stLetterSelect" name="stLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['stLetterRemarks']; ?>">
                                                      &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="stLetterDesc" name="stLetterDesc" >&nbsp;
                                                   </div>
                                             </div>
                                          </div>
                                       <div class="row">
                                          <div class="col-2">
                                                <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">FINAL LETTER</label>
                                                <input type="hidden" id="hiddenifd" name="hiddenifd" value="<?= $row['sfdLetter']; ?>">
                                                <input type="hidden" id="hiddenifd2" name="hiddenifd2" value="<?= $row['sfdLetter2']; ?>">
                                          </div>
                                          <div class="col-2">
                                                <input type="file" id="sfdLetter" name="sfdLetter" style="display: none;">
                                                <label for="sfdLetter" class="forsfdLetter btn-sm btn" id="forsfdLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($sfdLetter)){
                                                      echo '<a href="' . $sfdLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sfdLetterButton" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="sfdLetterNew" class="fa-solid fa-plus sfdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="sfdLetterNew" class="fa-solid fa-plus sfdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="sfdLetterShowOld" class="fa-solid fa-scroll sfdLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                       <img id="sfdLetterImage" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                                <input type="file" id="sfdLetter2" name="sfdLetter2" style="display: none;">
                                                <label for="sfdLetter2" class="forsfdLetter2 btn-sm btn" id="forsfdLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($sfdLetter2)){
                                                      echo '<a href="' . $sfdLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sfdLetter2Button" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="sfdLetter2New" class="fa-solid fa-plus sfdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="sfdLetter2New" class="fa-solid fa-plus sfdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="sfdLetter2ShowOld" class="fa-solid fa-scroll sfdLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                       <img id="sfdLetter2Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                             <input type="file" id="sfdLetter3" name="sfdLetter3" style="display: none;">
                                             <label for="sfdLetter3" class="forsfdLetter3 btn-sm btn" id="forsfdLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($sfdLetter3)){
                                                   echo '<a href="' . $sfdLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sfdLetter3Button" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="sfdLetter3New" class="fa-solid fa-plus sfdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="sfdLetter3New" class="fa-solid fa-plus sfdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="sfdLetter3ShowOld" class="fa-solid fa-scroll sfdLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="sfdLetter3Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                                <label class="date-label" id="sfdLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sfdLetter, strrpos($sfdLetter, '/') + 1, 10); ?></label>
                                          </div>
                                          <div class="col-2" id="">
                                                   <div class="form-group d-flex mb-4">
                                                      &nbsp;&nbsp;<input type="text" id="sfdLetterSelect" name="sfdLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['sfdLetterRemarks']; ?>">
                                                      &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sfdLetterDesc" name="sfdLetterDesc" >&nbsp;
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
                                                   <input type="hidden" id="hiddenClient1" name="hiddenClient1" value="<?= $row['sclientReq1']; ?>">
                                                   <input type="hidden" id="hiddenClient2" name="hiddenClient2" value="<?= $row['sclientReq2']; ?>">
                                                   <input type="hidden" id="hiddenClient3" name="hiddenClient3" value="<?= $row['sclientReq3']; ?>">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="sclientReq1" name="sclientReq1" style="display: none;">
                                                   <label for="sclientReq1" class="forsclientReq1 btn-sm btn" id="forsclientReq1" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($sclientReq1)){
                                                         echo '<a href="' . $sclientReq1 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sclientReq1Button" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="sclientReq1New" class="fa-solid fa-plus sclientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="sclientReq1New" class="fa-solid fa-plus sclientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="sclientReq1ShowOld" class="fa-solid fa-scroll sclientReq1ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="sclientReq1Image" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="sclientReq2" name="sclientReq2" style="display: none;">
                                                   <label for="sclientReq2" class="forsclientReq2 btn-sm btn" id="forsclientReq2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($sclientReq2)){
                                                         echo '<a href="' . $sclientReq2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sclientReq2Button" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="sclientReq2New" class="fa-solid fa-plus sclientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="sclientReq2New" class="fa-solid fa-plus sclientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="sclientReq2ShowOld" class="fa-solid fa-scroll sclientReq2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="sclientReq2Image" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                <input type="file" id="sclientReq3" name="sclientReq3" style="display: none;">
                                                <label for="sclientReq3" class="forsclientReq3 btn-sm btn" id="forsclientReq3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($sclientReq3)){
                                                      echo '<a href="' . $sclientReq3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sclientReq3Button" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="sclientReq3New" class="fa-solid fa-plus sclientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="sclientReq3New" class="fa-solid fa-plus sclientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="sclientReq3ShowOld" class="fa-solid fa-scroll sclientReq3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                                <img id="sclientReq3Image" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="sclientReq1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sclientReq1, strrpos($sclientReq1, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2" id="">
                                                <div class="form-group d-flex mb-4">
                                                   &nbsp;&nbsp;<input type="text" id="sclientReq1Select" name="sclientReq1Select" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['sclientReqRemarks']; ?>">
                                                   &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sclientReq1Desc" name="sclientReq1Desc" >&nbsp;
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
                                                <input type="file" id="sffClosure" name="sffClosure" style="display: none;">
                                                <label for="sffClosure" class="forsffClosure btn-sm btn" id="forsffClosure" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($sffClosure)){
                                                      echo '<a href="' . $sffClosure . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sffClosureButton" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="sffClosureNew" class="fa-solid fa-plus sffClosureNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="sffClosureNew" class="fa-solid fa-plus sffClosureNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="sffClosureShowOld" class="fa-solid fa-scroll sffClosureShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                                <img id="sffClosureImage" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-1">
                                 
                                             </div>
                                          <div class="col-2">
                                                <label class="date-label" id="sffClosureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sffClosure, strrpos($sffClosure, '/') + 1, 10); ?></label>
                                          </div>
                                          <div class="col-2">
                                                   <div class="form-group d-flex mb-4">
                                                      &nbsp;&nbsp;<input type="text" id="sffClosureSelect" name="sffClosureSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['sffClosureRemarks']; ?>">
                                                      &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sffClosureDesc" name="sffClosureDesc" >&nbsp;
                                                   </div>
                                             </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-3">
                                                <label class="corporation-label" id="tab-corporation" for="custom" style="padding-left: 2%;">PASTDUE TO LITIGATION</label>
                                          </div>
                                          <div class="col-2">
                                             <input type="file" id="spastLitigation" name="spastLitigation" style="display: none;">
                                             <label for="spastLitigation" class="forspastLitigation btn-sm btn" id="forspastLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($spastLitigation)){
                                                   echo '<a href="' . $spastLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="spastLitigationButton" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="spastLitigationNew" class="fa-solid fa-plus spastLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="spastLitigationNew" class="fa-solid fa-plus spastLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="spastLitigationShowOld" class="fa-solid fa-scroll spastLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="spastLitigationImage" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-2">
                                                <input type="file" id="spastLitigation2" name="spastLitigation2" style="display: none;">
                                                <label for="spastLitigation2" class="forspastLitigation2 btn-sm btn" id="forspastLitigation2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($spastLitigation2)){
                                                      echo '<a href="' . $spastLitigation2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="spastLitigation2Button" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="spastLitigation2New" class="fa-solid fa-plus spastLitigation2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="spastLitigation2New" class="fa-solid fa-plus spastLitigation2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="spastLitigation2ShowOld" class="fa-solid fa-scroll spastLitigation2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                                <img id="spastLitigation2Image" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-1">
                                             <input class="form-check-input" type="checkbox" value="Yes" id="spastCheck" name="spastCheck"><label for="">
                                             <label class="individual-labels" id="label23" for="forspastCheck" style="font-size: 15px; display: inline;"> Bidding</label>
                                          </div>
                                          <div class="col-2">
                                                <label class="date-label" id="spastLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($spastLitigation, strrpos($spastLitigation, '/') + 1, 10); ?></label>
                                          </div>
                                          <div class="col-2">
                                                   <div class="form-group d-flex mb-4">
                                                      &nbsp;&nbsp;<input type="text" id="spastLitigationSelect" name="spastLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['spastLitigationRemarks']; ?>">
                                                      &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="spastLitigationDesc" name="spastLitigationDesc" >&nbsp;
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
                                                <input type="file" id="sttLitigation" name="sttLitigation" style="display: none;">
                                                <label for="sttLitigation" class="forsttLitigation btn-sm btn" id="forsttLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                <?php 
                                                   if(!empty($sttLitigation)){
                                                      echo '<a href="' . $sttLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sttLitigationButton" 
                                                            style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                      echo '&nbsp;<button type="button" id="sttLitigationNew" class="fa-solid fa-plus sttLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   }else{
                                                      // echo '&nbsp;<button type="button" id="sttLitigationNew" class="fa-solid fa-plus sttLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                   }
                                                   echo '&nbsp;<button type="button" id="sttLitigationShowOld" class="fa-solid fa-scroll sttLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                ?>
                                                <img id="sttLitigationImage" src="statusImage/check.png" alt="statusImage">
                                          </div>
                                          <div class="col-1">
                                 
                                             </div>
                                          <div class="col-2">
                                                <label class="date-label" id="sttLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sttLitigation, strrpos($sttLitigation, '/') + 1, 10); ?></label>
                                          </div>
                                          <div class="col-2">
                                                   <div class="form-group d-flex mb-4">
                                                      &nbsp;&nbsp;<input type="text" id="sttLitigationSelect" name="sttLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['sttLitigationRemarks']; ?>">
                                                      &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sttLitigationDesc" name="sttLitigationDesc" >&nbsp;
                                                   </div>
                                             </div>
                                       </div>
                                       <div class="row">
                                       <div class="col-3">
                                             <label class="corporation-label" id="tab-corporation" for="custom" style=" padding-left: 2%;">PREPARE TO mOLIDATION <br>IN THE NAME OF THE BANK</label>
                                       </div>
                                       <div class="col-2">
                                             
                                       </div>
                                       <div class="col-2">
                                             <input type="file" id="sPrepConso" name="sPrepConso" style="display: none;">
                                             <label for="sPrepConso" class="forsPrepConso btn-sm btn" id="forsPrepConso" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($sPrepConso)){
                                                   echo '<a href="' . $sPrepConso . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="sPrepConsoButton" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="sPrepConsoNew" class="fa-solid fa-plus sPrepConsoNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="sPrepConsoNew" class="fa-solid fa-plus sPrepConsoNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="sPrepConsoShowOld" class="fa-solid fa-scroll sPrepConsoShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="sPrepConsoImage" src="statusImage/check.png" alt="statusImage">
                                       </div>
                                       <div class="col-1">
                                 
                                          </div>
                                       <div class="col-2">
                                             <label class="date-label" id="sPrepConsoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sPrepConso, strrpos($sPrepConso, '/') + 1, 10); ?></label>
                                       </div>
                                       <div class="col-2">
                                                <div class="form-group d-flex mb-4">
                                                   &nbsp;&nbsp;<input type="text" id="sPrepConsoSelect" name="sPrepConsoSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['sPrepConsoRemarks']; ?>">
                                                   &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sPrepConsoDesc" name="sPrepConsoDesc" >&nbsp;
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
                                             <input type="file" id="saDemand" name="saDemand" style="display: none;">
                                             <label for="saDemand" class="forsaDemand btn-sm btn" id="forsaDemand" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                             <?php 
                                                if(!empty($saDemand)){
                                                   echo '<a href="' . $saDemand . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="saDemandButton" 
                                                         style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                   echo '&nbsp;<button type="button" id="saDemandNew" class="fa-solid fa-plus saDemandNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                }else{
                                                   // echo '&nbsp;<button type="button" id="saDemandNew" class="fa-solid fa-plus saDemandNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                }
                                                echo '&nbsp;<button type="button" id="saDemandShowOld" class="fa-solid fa-scroll saDemandShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                             ?>
                                             <img id="saDemandImage" src="statusImage/check.png" alt="statusImage">
                                       </div>
                                       <div class="col-1">
                                 
                                          </div>
                                       <div class="col-2">
                                             <label class="date-label" id="saDemandDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($saDemand, strrpos($saDemand, '/') + 1, 10); ?></label>
                                       </div>
                                       <div class="col-2">
                                                <div class="form-group d-flex mb-4">
                                                   &nbsp;&nbsp;<input type="text" id="saDemandSelect" name="saDemandSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $row['saDemandRemarks']; ?>">
                                                   &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="saDemandDesc" name="saDemandDesc" >&nbsp;
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
function initializeDataTable(tableId, ajaxUrl, salId) {
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
                        d.salId = salId;
                  }
               },
               "aoColumnDefs": [{
                  "bSortable": false,
                  "aTargets": [] // Apply sorting preferences if necessary
               }]
            });
         });
      }
      // First Demand
   $(document).on('click', '#sfLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sfLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#sfLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sfLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#sfLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sfLetter3.php', '<?php echo $id; ?>');
   });

   // Second Demand
   $(document).on('click', '#ssLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_ssLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ssLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_ssLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ssLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_ssLetter3.php', '<?php echo $id; ?>');
   });

   // Third Demand
   $(document).on('click', '#stLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_stLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#stLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_stLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#stLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_stLetter3.php', '<?php echo $id; ?>');
   });

   // Final Demand
   $(document).on('click', '#sfdLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sfdLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#sfdLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sfdLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#sfdLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sfdLetter3.php', '<?php echo $id; ?>');
   });

   // other DOCUMENTS mclientReq1
   $(document).on('click', '#sclientReq1ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sclientReq1.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#sclientReq2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sclientReq2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#sclientReq3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sclientReq3.php', '<?php echo $id; ?>');
   });

   // foreclosure #
   $(document).on('click', '#sffClosureShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sffClosure.php', '<?php echo $id; ?>');
   });

   // pastdue litigation
   $(document).on('click', '#spastLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_spastLitigation.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#spastLitigation2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_spastLitigation2.php', '<?php echo $id; ?>');
   });

   //transfer litigation
   $(document).on('click', '#sttLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sttLitigation.php', '<?php echo $id; ?>');
   });

   // prepare for consolidate
   $(document).on('click', '#sPrepConsoShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_sPrepConso.php', '<?php echo $id; ?>');
   });

   // due and demandable
   $(document).on('click', '#saDemandShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_sa_saDemand.php', '<?php echo $id; ?>');
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
   $(document).on('click', '#sfLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#sfLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#sfLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 2nd Demand
   $(document).on('click', '#ssLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ssLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ssLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 3rd Demand
   $(document).on('click', '#stLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#stLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#stLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // Final Demand
   $(document).on('click', '#sfdLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#sfdLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#sfdLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // other docs #
   $(document).on('click', '#sclientReq1ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#sclientReq2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#sclientReq3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // foreclosure
   $(document).on('click', '#sffClosureShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // pastdue litigation
   $(document).on('click', '#spastLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#spastLitigation2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // transfer litigation
   $(document).on('click', '#sttLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // prepare for consolidate
   $(document).on('click', '#sPrepConsoShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // due and Demandable
   $(document).on('click', '#saDemandShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
</script>


<!-- Salary-FORM AJAX-->
<script>
  var salaryform = document.getElementById("salary-form");
  var branch = "<?php echo $branch; ?>";
  var salaryId = "<?php echo $id; ?>";
  var fullname= "<?php echo $fullname; ?>";
  var salaryType= "<?php echo $type; ?>";
  var loanType= "<?php echo $loanType; ?>";

  var endPrompt = ""; // Global variable for remarks
  function uploadFileS() {
    var salaryformData = new FormData(salaryform);
    salaryformData.append('salaryId', salaryId);
    salaryformData.append('fullname', fullname);
    salaryformData.append('salaryType', salaryType);
    salaryformData.append('branch', branch);
    salaryformData.append('loanType', loanType);

   // Append the endPrompt to the FormData
   salaryformData.append('endPrompt', endPrompt);
    
    $.ajax({
      url: 'loanSalaryUploadData.php', 
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
      updateFileStatus('sfLetter', 'sfLetterImage');
      updateFileStatus('ssLetter', 'ssLetterImage');
      updateFileStatus('stLetter', 'stLetterImage');
      updateFileStatus('sfdLetter', 'sfdLetterImage');
      // LETTER2  
      updateFileStatus('sfLetter2', 'sfLetter2Image');
      updateFileStatus('ssLetter2', 'ssLetter2Image');
      updateFileStatus('stLetter2', 'stLetter2Image');
      updateFileStatus('sfdLetter2', 'sfdLetter2Image'); 
      // LETTER3
      updateFileStatus('sfLetter3', 'sfLetter3Image');
      updateFileStatus('ssLetter3', 'ssLetter3Image');
      updateFileStatus('stLetter3', 'stLetter3Image');
      updateFileStatus('sfdLetter3', 'sfdLetter3Image');   
      // OTHER ATTACHMENT
      updateFileStatus('sclientReq1', 'sclientReq1Image');
      updateFileStatus('sclientReq2', 'sclientReq2Image');
      updateFileStatus('sclientReq3', 'sclientReq3Image');
      // LEGAL
      updateFileStatus('sffClosure', 'sffClosureImage');
      updateFileStatus('spastLitigation', 'spastLitigationImage');
      updateFileStatus('spastLitigation2', 'spastLitigation2Image');
      updateFileStatus('sttLitigation', 'sttLitigationImage');
      updateFileStatus('sPrepConso', 'sPrepConsoImage');
      updateFileStatus('saDemand', 'saDemandImage');
      updateFileStatus('spastCheck', )

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

        // Trigger the file input and append the selected file to the form data
        setTimeout(function () {
            var fileInput = document.querySelector(inputSelector);
            fileInput.onchange = function () {
                var file = fileInput.files[0];
                if (file) {
                    formData.append(fileInput.name, file);  // Add file to the form data
                    formData.append('endPrompt', endPrompt); // Add remarks to the form data
                    formData.append('salaryId',  salaryId);

                    // Log FormData before sending
                    console.log("FormData before AJAX:", Array.from(formData.entries()));

                    // Send form data via AJAX
                    $.ajax({
                        url: 'loanSalaryUploadData.php',
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

   // for mfLetter
   $(document).on('click', '.sfLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sfLetter');
   });
   $(document).on('click', '.sfLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sfLetter2');
   });
   $(document).on('click', '.sfLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sfLetter3');
   });
   // for msLetter
   $(document).on('click', '.ssLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ssLetter');
   });
   $(document).on('click', '.ssLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ssLetter2');
   });
   $(document).on('click', '.ssLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ssLetter3');
   });
   // 3rd Letter
   $(document).on('click', '.stLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#stLetter');
   });
   $(document).on('click', '.stLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#stLetter2');
   });
   $(document).on('click', '.stLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#stLetter3');
   });
   // final DEMAND
   $(document).on('click', '.sfdLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sfdLetter');
   });
   $(document).on('click', '.sfdLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sfdLetter2');
   });
   $(document).on('click', '.sfdLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sfdLetter3');
   });

   // OTHER ATTACHMENT
   $(document).on('click', '.sclientReq1New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sclientReq1');
   });
   $(document).on('click', '.sclientReq2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sclientReq2');
   });
   $(document).on('click', '.sclientReq3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sclientReq3');
   });

   // LEGAL
   $(document).on('click', '.sffClosureNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sffClosure');
   });
   $(document).on('click', '.spastLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#spastLitigation');
   });
   $(document).on('click', '.spastLitigation2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#spastLitigation2');
   });
   
   // Transfer to ROPA
   $(document).on('click', '.sttLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sttLitigation');
   });
   // Prepare to Consolidation
   $(document).on('click', '.sPrepConsoNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#sPrepConso');
   });
   // Due and Demandable
   $(document).on('click', '.saDemandNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#saDemand');
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
// LETTER
resetIndex('sfLetter', 'sfLetterSelect', 'sfLetterDesc');
resetIndex('ssLetter', 'ssLetterSelect', 'ssLetterDesc');
resetIndex('stLetter', 'stLetterSelect', 'stLetterDesc');
resetIndex('sfdLetter', 'sfdLetterSelect', 'sfdLetterDesc');
// LEGAL
resetIndex('sffClosure', 'sffClosureSelect', 'sffClosureDesc');
resetIndex('sttLitigation', 'sttLitigationSelect', 'sttLitigationDesc');
resetIndex('saDemand', 'saDemandSelect', 'saDemandDesc');

</script> 

<script>
function initializePastCheck() {  
  var pastCheckVal = "<?php echo $spastCheck; ?>";

  // Get the checkbox elements
  const pastCheckk = document.getElementById('spastCheck');

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
            if (username !== "vcdyoshino" && username !== "jcvillanueva" || username !== 'ctborgonia') {
                  selectElements.forEach(function(selectElement) {
                     selectElement.style.pointerEvents = "none";
             });
            //       descriptionInputs.forEach(function(descriptionInput) {
            //           descriptionInput.style.pointerEvents = "none";
            //  });
            }

    
   // REQUIREMENTS RESTRICTION
   if(position!=="BM" && department!=="1"){
      inputFiles.forEach(function(inputFile){
         inputFile.style.display="none";
      });
   }
   if(bankposition!=="LOAN Assistant" && position!=="BM" && department !=="1"){
      document.getElementById("deductRemit").style.display="none";
   } 
   if(bankposition!=="LOAN Assistant" && position!=="BM" && username !=="apreyes" && department !=="1"){
      document.getElementById("cashflowScore").style.display="none";
      document.getElementById("loanAppMemo").style.display="none";
      document.getElementById("promissoryNoteS").style.display="none";
      document.getElementById("disclosureStateS").style.display="none";
      document.getElementById("amortScheduleS").style.display="none";
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
showText('sfLetterSelect','46%');
showText('ssLetterSelect','46%');
showText('stLetterSelect','46%');
showText('sfdLetterSelect','46%');

showText('sffClosureSelect','46%');
showText('spastLitigationSelect','46%');
showText('sttLitigationSelect','46%');
showText('sPrepConsoSelect','46%');
showText('saDemandSelect','46%');

showText('sclientReq1Select', '46%');

</script>

</body>
</html>