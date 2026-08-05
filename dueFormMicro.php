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
<!-- <!doctype html>
<html lang="en">
  <head> -->
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styleloan.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css"> -->
    
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style type="text/css"></style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 -->

<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <meta Http-Equiv="Cache-Control" Content="no-cache">
  <meta Http-Equiv="Pragma" Content="no-cache">
  <meta Http-Equiv="Expires" Content="0">
  <meta Http-Equiv="Pragma-directive: no-cache">
  <meta Http-Equiv="Cache-directive: no-cache"> -->
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
// SELECT Loan
$query = "SELECT * FROM loan WHERE loan_Id='$id'";
$data = mysqli_query($con, $query) ;

if (!$data) {
    echo("Error description: " . mysqli_error($mysqli));
} 
else 
{
   while ($row = mysqli_fetch_array($data)) {
       
      $Cfname= $row['customerFirstName'];
      $Lfname= $row['customerSurname'];
      $fullname=$row['customerFullName'];
      $birth=$row['birthDate'];
      $id=$row['loan_Id'];
      $type=$row['salaryType'];
      $branch=$row['branch'];
      $loanType= $row['loanType'];
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
   }else{
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

function setFileVisibility2($file2, $input2Id, $check2ImageId,$button2Open) {
   if (!empty($file2)) {
      ?>
         <script>
            document.getElementById("<?php echo $input2Id; ?>").style.display = "none";
            document.getElementById("<?php echo $check2ImageId; ?>").style.visibility = "visible";
            document.getElementById("<?php echo $button2Open; ?>").style.display="inline";
         </script>
      <?php
   }
}
         
      
 
if($type == "Microfinance") {
    ?>
         <script>
            document.getElementById('tab1').classList.add('active');;
            document.getElementById('microfinance').classList.add('active');
            document.getElementById('tab2').setAttribute('', '');
            document.getElementById('tab3').setAttribute('', '');
            document.getElementById('tab4').setAttribute('', '');
        </script>
    <?php
            
            $query1 = "SELECT a.*, m.* FROM microfinance AS m
                                       LEFT JOIN microarchive AS a ON m.mLoan_Id = a.a_mLoan_Id
                                       WHERE m.mLoan_Id= '$id'
                     ";
            $newdata= mysqli_query($con, $query1);
            $rows = mysqli_fetch_array($newdata); 
    
            // BORROWER
            $loanAppFormM = $rows['loanAppFormM'];
            $borrower_Idsignature = $rows['mborrower_IdSign'];
            $borrower_Lbp = $rows['mborrower_Lbp'];
            $borrower_Lpb = $rows['mborrower_Lpb'];
            // CO-BORROWER
            $coborrowerStatement = $rows['coborrowerStatement'];
            $coBorrowerIdSign = $rows['mcoBorrower_Id'];
            $proofIncome=$rows['proofIncome'];
            // CO-MAKER
            $comakerStatement = $rows['comakerStatement'];  
            $coMakerIdWithSign = $rows['mcoMaker_IdSign'];
            $latestPermit = $rows['mcoMaker_Lbp'];
            $coMakerPayslip = $rows['mcoMaker_Payslip']; 
            //OTHERS
            $businessPicture = $rows['businessPicture'];
            $otherSuport = $rows['otherSuport']; 
            // DOCUMENTS
            $validCardReport = $rows['validCardReport'];
            $creditReport = $rows['creditReport'];
            $creditInvestigationReportM = $rows['creditInvestigationReportM'];
            $debitWaiver = $rows['debitWaiver']; 
            $affidavitSurrender = $rows['affidavitSurrender'];
            $riskRating = $rows['riskRating'];
            $loanApprovalSheet = $rows['loanApprovalSheet'];
            // LETTER
            $mfLetter = $rows['mfLetter'];
            $msLetter = $rows['msLetter'];
            $mtLetter = $rows['mtLetter'];
            $mfdLetter = $rows['mfdLetter'];
            //  LETTER2
            $mfLetter2 = $rows['mfLetter2'];
            $msLetter2 = $rows['msLetter2'];
            $mtLetter2 = $rows['mtLetter2'];
            $mfdLetter2 = $rows['mfdLetter2'];
            //  LETTER3
            $mfLetter3 = $rows['mfLetter3'];
            $msLetter3 = $rows['msLetter3'];
            $mtLetter3 = $rows['mtLetter3'];
            $mfdLetter3 = $rows['mfdLetter3'];
            // OTHER ATTACHMENT
            $mclientReq1 = $rows['mclientReq1'];
            $mclientReq2 = $rows['mclientReq2'];
            $mclientReq3 = $rows['mclientReq3'];
            $mclientReqRemarks = $rows['mclientReqRemarks'];
            // LEGAL
            $mffClosure = $rows['mffClosure'];
            $mpastLitigation = $rows['mpastDueLitigation'];
            $mpastLitigation2 = $rows['mpastDueLitigation'];
            $mttLitigation = $rows['mtransferLitigation'];
            $mPrepConso = $rows['mPrepConso'];
            $maDemand = $rows['maDemand'];

            // ARCHIVED
            $a_mfLetter = $rows['a_mfLetter'];
            $a_msLetter = $rows['a_msLetter'];
            $a_mtLetter  = $rows['a_mtLetter'];
            $a_mfdLetter = $rows['a_mfdLetter'];

            $a_mfLetter2 = $rows['a_mfLetter2'];
            $a_msLetter2 = $rows['a_msLetter2'];
            $a_mtLetter2 = $rows['a_mtLetter2'];
            $a_mfdLetter2 = $rows['a_mfdLetter2'];
            
            $a_mfLetter3 = $rows['a_mfLetter3'];
            $a_msLetter3 = $rows['a_msLetter3'];
            $a_mtLetter3 = $rows['a_mtLetter3'];
            $a_mfdLetter3 = $rows['a_mfdLetter3'];

            $a_mffClosure = $rows['a_mffClosure'];
            $a_mpastLitigation = $rows['a_mpastDueLitigation'];
            $a_mpastLitigation2 = $rows['a_mpastDueLitigation'];
            $a_mttLitigation = $rows['a_mtransferLitigation'];
            $a_mPrepConso = $rows['a_mPrepConso'];
            $a_maDemand = $rows['a_maDemand'];

            // AFTER RELASE
            $promissoryNoteM = $rows['promissoryNoteM'];  
            $disclosureStateM = $rows['disclosureStateM'];
            $amortScheduleM = $rows['amortScheduleM'];
            //CHECKBOX
            $businessPictureCheck = $rows['businessPictureCheck'];
            $otherSuportCheck = $rows['otherSuportCheck']; 

            
            // BORROWER STATUS
            $loanAppFormMSelect=$rows['loanAppFormMStatus'];
            $borrower_IdSignSelect = $rows['mborrower_IdSignStatus'];
            $borrower_LbpSelect = $rows['mborrower_LbpStatus'];
            $borrower_LpbSelect = $rows['mborrower_LpbStatus'];
            // CO-BORROWER STATUS
            $coborrowerStatementSelect=$rows['coborrowerStatementStatus'];
            $coBorrower_IdSignSelect = $rows['mcoBorrower_IdSignStatus'];
            $proofIncomeSelect = $rows['proofIncomeStatus'];
            // CO-MAKER STATUS
            $comakerStatementSelect= $rows['comakerStatementStatus'];
            $coMaker_IdSignSelect = $rows['mcoMaker_IdSignStatus'];
            $coMaker_LbpSelect = $rows['mcoMaker_LbpStatus'];
            $coMaker_PayslipSelect = $rows['mcoMaker_PayslipStatus'];
            // OTHERS
            $businessPictureSelect = $rows['businessPictureStatus'];
            $otherSuportSelect = $rows['otherSuportStatus'];
            // DOCUMENTS STATUS
            $validCardReportSelect = $rows['validCardReportStatus'];
            $creditReportSelect = $rows['creditReportStatus'];
            $creditInvestigationReportMSelect = $rows['creditInvestigationReportMStatus'];
            $debitWaiverSelect = $rows['debitWaiverStatus']; 
            $affidavitSurrenderSelect = $rows['affidavitSurrenderStatus'];
            $riskRatingSelect = $rows['riskRatingStatus'];
            $loanApprovalSheetSelect = $rows['loanApprovalSheetStatus'];
            // LETTER SELECT
            $mfLetterSelect = $rows['mfLetterRemarks'];
            $msLetterSelect = $rows['msLetterRemarks'];
            $mtLetterSelect = $rows['mtLetterRemarks'];
            $mfdLetterSelect = $rows['mfdLetterRemarks'];
            // LEGAL SELECT
            $mffClosureSelect = $rows['mffClosureRemarks'];
            $mpastLitigationSelect = $rows['mpastLitigationRemarks'];
            $mttLitigationSelect = $rows['mttLitigationRemarks'];
            $mPrepConsoSelect = $rows['mPrepConsoRemarks'];
            $maDemandSelect = $rows['maDemandRemarks'];
            // AFTER RELASE STATUS
            $promissoryNoteMSelect = $rows['promissoryNoteMStatus'];  
            $disclosureStateMSelect = $rows['disclosureStateMStatus'];
            $amortScheduleMSelect = $rows['amortScheduleMStatus'];

            // LEGAL PASTCHECK
            $mpastCheck = $rows['mpastCheck'];
    } 
    

   // DISPLAY A CHECKIMAGE IF THERE IS A FILE
   // BORROWER
   setFileVisibility($loanAppFormM, "loanAppFormM", "loanAppFormMImage", "loanAppFormMButton", $loanAppFormMSelect,"loanAppFormMDate");
   setFileVisibility($borrower_Idsignature, "borrower_Idsignature", "borrower_IdsignatureImage", "borrower_IdsignatureButton", $borrower_IdSignSelect,"borrower_IdsignatureDate");
   setFileVisibility($borrower_Lbp, "borrower_Lbp", "borrower_LbpImage", "borrower_LbpButton", $borrower_LbpSelect,"borrower_LbpDate");
   setFileVisibility($borrower_Lpb, "borrower_Lpb", "borrower_LpbImage", "borrower_LpbButton", $borrower_LpbSelect,"borrower_LpbDate");
   // CO-BORROWER
   setFileVisibility($coborrowerStatement, "coborrowerStatement", "coborrowerStatementImage", "coborrowerStatementButton", $coborrowerStatementSelect,"coborrowerStatementDate");
   setFileVisibility($coBorrowerIdSign, "coBorrowerIdSign", "coBorrowerIdSignImage", "coBorrowerIdSignButton", $coBorrower_IdSignSelect,"coBorrowerIdSignDate");
   setFileVisibility($proofIncome, "proofIncome", "proofIncomeImage", "proofIncomeButton", $proofIncomeSelect,"proofIncomeDate");
   // CO-MAKER
   setFileVisibility($comakerStatement, "comakerStatement", "comakerStatementImage", "comakerStatementButton", $comakerStatementSelect,"comakerStatementDate");
   setFileVisibility($coMakerIdWithSign, "coMakerIdWithSign", "coMakerIdWithSignImage", "coMakerIdWithSignButton", $coMaker_IdSignSelect,"coMakerIdWithSignDate");
   setFileVisibility($latestPermit, "latestPermit", "latestPermitImage", "latestPermitButton", $coMaker_LbpSelect,"latestPermitDate");
   setFileVisibility($coMakerPayslip, "coMakerPayslip", "coMakerPayslipImage", "coMakerPayslipButton", $coMaker_PayslipSelect,"coMakerPayslipDate");
   // OTHERS
   setFileVisibility($businessPicture, "businessPicture", "businessPictureImage", "businessPictureButton", $businessPictureSelect,"businessPictureDate");
   setFileVisibility($otherSuport, "otherSuport", "otherSuportImage", "otherSuportButton", $otherSuportSelect,"otherSuportDate");
   // DOCUMENTS
   setFileVisibility($validCardReport, "validCardReport", "validCardReportImage", "validCardReportButton", $validCardReportSelect,"validCardReportDate");
   setFileVisibility($creditReport, "creditReport", "creditReportImage", "creditReportButton", $creditReportSelect,"creditReportDate");
   setFileVisibility($creditInvestigationReportM, "creditInvestigationReportM", "creditInvestigationReportMImage", "creditInvestigationReportMButton", $creditInvestigationReportMSelect,"creditInvestigationReportMDate");
   setFileVisibility($debitWaiver, "debitWaiver", "debitWaiverImage", "debitWaiverButton", $debitWaiverSelect,"debitWaiverDate");
   setFileVisibility($affidavitSurrender, "affidavitSurrender", "affidavitSurrenderImage", "affidavitSurrenderButton", $affidavitSurrenderSelect,"affidavitSurrenderDate");
   setFileVisibility($riskRating, "riskRating", "riskRatingImage", "riskRatingButton", $riskRatingSelect,"riskRatingDate");
   setFileVisibility($loanApprovalSheet, "loanApprovalSheet", "loanApprovalSheetImage", "loanApprovalSheetButton", $loanApprovalSheetSelect,"loanApprovalSheetDate");
   setFileVisibility($promissoryNoteM, "promissoryNoteM", "promissoryNoteMImage", "promissoryNoteMButton", $promissoryNoteMSelect,"promissoryNoteMDate");
   setFileVisibility($disclosureStateM, "disclosureStateM", "disclosureStateMImage", "disclosureStateMButton", $disclosureStateMSelect,"disclosureStateMDate");
   setFileVisibility($amortScheduleM, "amortScheduleM", "amortScheduleMImage", "amortScheduleMButton", $amortScheduleMSelect,"amortScheduleMDate");
   // // LETTER
   // setFileVisibility($mfLetter, "mfLetter", "mfLetterImage","mfLetterButton", $mfLetterSelect,"mfLetterDate");
   // setFileVisibility($msLetter, "msLetter", "msLetterImage","msLetterButton", $msLetterSelect,"msLetterDate");
   // setFileVisibility($mtLetter, "mtLetter", "mtLetterImage","mtLetterButton", $mtLetterSelect,"mtLetterDate");
   // setFileVisibility($mfdLetter, "mfdLetter", "mfdLetterImage","mfdLetterButton", $mfdLetterSelect,"mfdLetterDate");
   // //  LETTER2
   // setFileVisibility($mfLetter2, "mfLetter2", "mfLetter2Image","mfLetter2Button", "", "");
   // setFileVisibility($msLetter2, "msLetter2", "msLetter2Image","msLetter2Button", "", "");
   // setFileVisibility($mtLetter2, "mtLetter2", "mtLetter2Image","mtLetter2Button", "", "");
   // setFileVisibility($mfdLetter2, "mfdLetter2", "mfdLetter2Image","mfdLetter2Button", "", "");
   // //  LETTER3
   // setFileVisibility($mfLetter3, "mfLetter3", "mfLetter3Image","mfLetter3Button", "", "");
   // setFileVisibility($msLetter3, "msLetter3", "msLetter3Image","msLetter3Button", "", "");
   // setFileVisibility($mtLetter3, "mtLetter3", "mtLetter3Image","mtLetter3Button", "", "");
   // setFileVisibility($mfdLetter3, "mfdLetter3", "mfdLetter3Image","mfdLetter3Button", "", "");
   // // OTHER ATTACHMENT
   // setFileVisibility($mclientReq1, "mclientReq1", "mclientReq1Image", "mclientReq1Button", $mclientReq1Select, "mclientReq1Date");
   // setFileVisibility($mclientReq2, "mclientReq2", "mclientReq2Image", "mclientReq2Button", "", "");
   // setFileVisibility($mclientReq3, "mclientReq3", "mclientReq3Image", "mclientReq3Button", "", "");
   // // LEGAL
   // setFileVisibility($mffClosure, "mffClosure", "mffClosureImage", "mffClosureButton", $mffClosureSelect, "mffClosureDate");
   // setFileVisibility($mpastLitigation, "mpastLitigation", "mpastLitigationImage", "mpastLitigationButton", $mpastLitigationSelect, "mpastLitigationDate");
   // setFileVisibility($mpastLitigation2, "mpastLitigation2", "mpastLitigation2Image", "mpastLitigation2Button", "", "");
   // setFileVisibility($mttLitigation, "mttLitigation", "mttLitigationImage", "mttLitigationButton", $mttLitigationSelect, "mttLitigationDate");
   // setFileVisibility($mPrepConso, "mPrepConso", "mPrepConsoImage", "mPrepConsoButton", $mPrepConsoSelect, "mPrepConsoDate");
   // setFileVisibility($maDemand, "maDemand", "maDemandImage", "maDemandButton", $maDemandSelect, "maDemandDate");
   // LETTER
   setFileVisibility($mfLetter, "formfLetter", "mfLetterImage","mfLetterButton", $mfLetterSelect,"mfLetterDate");
   setFileVisibility($msLetter, "formsLetter", "msLetterImage","msLetterButton", $msLetterSelect,"msLetterDate");
   setFileVisibility($mtLetter, "formtLetter", "mtLetterImage","mtLetterButton", $mtLetterSelect,"mtLetterDate");
   setFileVisibility($mfdLetter, "formfdLetter", "mfdLetterImage","mfdLetterButton", $mfdLetterSelect,"mfdLetterDate");
   //  LETTER2
   setFileVisibility($mfLetter2, "formfLetter2", "mfLetter2Image","mfLetter2Button", "", "");
   setFileVisibility($msLetter2, "formsLetter2", "msLetter2Image","msLetter2Button", "", "");
   setFileVisibility($mtLetter2, "formtLetter2", "mtLetter2Image","mtLetter2Button", "", "");
   setFileVisibility($mfdLetter2, "formfdLetter2", "mfdLetter2Image","mfdLetter2Button", "", "");
   //  LETTER3
   setFileVisibility($mfLetter3, "formfLetter3", "mfLetter3Image","mfLetter3Button", "", "");
   setFileVisibility($msLetter3, "formsLetter3", "msLetter3Image","msLetter3Button", "", "");
   setFileVisibility($mtLetter3, "formtLetter3", "mtLetter3Image","mtLetter3Button", "", "");
   setFileVisibility($mfdLetter3, "formfdLetter3", "mfdLetter3Image","mfdLetter3Button", "", "");
   // OTHER ATTACHMENT
   setFileVisibility($mclientReq1, "formclientReq1", "mclientReq1Image", "mclientReq1Button", $mclientReq1Select, "mclientReq1Date");
   setFileVisibility($mclientReq2, "formclientReq2", "mclientReq2Image", "mclientReq2Button", "", "");
   setFileVisibility($mclientReq3, "formclientReq3", "mclientReq3Image", "mclientReq3Button", "", "");
   // LEGAL
   setFileVisibility($mffClosure, "formffClosure", "mffClosureImage", "mffClosureButton", $mffClosureSelect, "mffClosureDate");
   setFileVisibility($mpastLitigation, "formpastLitigation", "mpastLitigationImage", "mpastLitigationButton", $mpastLitigationSelect, "mpastLitigationDate");
   setFileVisibility($mpastLitigation2, "formpastLitigation2", "mpastLitigation2Image", "mpastLitigation2Button", "", "");
   setFileVisibility($mttLitigation, "formttLitigation", "mttLitigationImage", "mttLitigationButton", $mttLitigationSelect, "mttLitigationDate");
   setFileVisibility($mPrepConso, "formPrepConso", "mPrepConsoImage", "mPrepConsoButton", $mPrepConsoSelect, "mPrepConsoDate");
   setFileVisibility($maDemand, "formaDemand", "maDemandImage", "maDemandButton", $maDemandSelect, "maDemandDate");

    // The NUMBER OF PERCENTAGE
    $numberOfFilesUploaded = 0;
    $fileInputs = array(
      $loanAppFormMSelect, $borrower_IdSignSelect,$borrower_LbpSelect, $borrower_LpbSelect,$coborrowerStatementSelect, $coBorrower_IdSignSelect, $proofIncomeSelect, $comakerStatementSelect, $coMaker_IdSignSelect, $coMaker_LbpSelect,$coMaker_PayslipSelect, $validCardReportSelect,
      $creditReportSelect, $creditInvestigationReportMSelect, $debitWaiverSelect, $affidavitSurrenderSelect, $riskRatingSelect, $loanApprovalSheetSelect,$promissoryNoteMSelect, $disclosureStateMSelect,
      $amortScheduleMSelect
     );
    //  echo count($fileInputs);
    // Loop the file and Count the numbers of File uploaded
         // Filter out empty values from the array
         // Max Number Of Overall File Base on Condition
         $maxCount=count($fileInputs);
         // echo $maxCount;
         $nonEmptyFileInputs = array_filter($fileInputs,function($value) {
          $parts = explode("--", $value);
          return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
      });;
         // echo count($nonEmptyFileInputs);
         // Count the number of non-empty values
         $numberOfFilesUploaded = count($nonEmptyFileInputs);

         // Calculate the percentage
         $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         
         // echo count($numberOfFilesUploaded);
         $percentage= round($numberOfFilesUploaded /$maxCount *100);
    // echo $percentage ;
?>
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
         <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver;"  >
            <li class="nav-item ">
               <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab1" href="#microfinance">Microfinance</a>
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
                  <div id="microfinance" class="tab-pane active" style="border: 1px solid #ccc;">
                     <form id="microfinance-form" action="loanMicroUploadData.php" method="POST" enctype="multipart/form-data">

                     <div id="nextbankSection" style="position: absolute; top: 0; right: 0; margin-right: 4.4em;">
                        <div class="form">
                              <input hidden type="text" class="form-control" id="productID" name="productID" style="width: 25em; height: 4em; display: inline-block; font-size: 1.1em; font-weight: bold; " value="<?php echo $duecProdID; ?>" placeholder="NEXTBANK PRODUCT ID" tabindex="-1">
                        </div>
                     </div>
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6 my-4"><br>
                              <div class="row">
                                 <div class="col-8" style="border-right:0;">
                                    <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">REQUIREMENTS</h1>
                                 </div>
                                 <div class="col-4">
                                    <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 107%;">APPROVAL</h1>
                                 </div>
                              </div>
                              <div class="microfinance-tabs" style="border-right: 1px solid #ccc; min-height: 147%; width:100%; margin-top: -0.5%;">
                                 <!-- Requirements Form -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><u>BORROWER</u></label></div>
                                    </div>
                                 </div>
                                 <!--LOAN APPLICATION FORM  --> 
                                 <div class="row" >
                                    <div class="col-8">
                                       <div class="py-2">                                   
                                          <label class ="micro-labels" id="tab-label" for="custom">LOAN APPLICATION</label>
                                          <input type="file" id="loanAppFormM" name="loanAppFormM"><img id="loanAppFormMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanAppFormM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormMButton">Open File</button></a> 
                                          <label class="date-label" id="loanAppFormMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormM, strrpos($loanAppFormM, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="loanAppFormMSelect" name="loanAppFormMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanAppFormMDesc"  name="loanAppFormMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 2 COPIES OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">2 COPIES OF 2 VALID ID WITH 3 SIGNATURES</label>
                                          <input type="file" id="borrower_Idsignature" name="borrower_Idsignature"><img id="borrower_IdsignatureImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $borrower_Idsignature; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_IdsignatureButton">Open File</button></a>
                                          <label class="date-label" id="borrower_IdsignatureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Idsignature, strrpos($borrower_Idsignature, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-1">
                                          <select id="borrowerValidSelect" name="borrowerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_IdsignatureDesc"  name="borrower_IdsignatureDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                       <br>
                                    </div>
                                 </div>
                                  <!--LATEST BUSINESS PERMIT  -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LATEST BUSINESS PERMIT</label>   
                                          <input type="file" id="borrower_Lbp" name="borrower_Lbp"><img id="borrower_LbpImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $borrower_Lbp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_LbpButton">Open File</button></a>
                                          <label class="date-label" id="borrower_LbpDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Lbp, strrpos($borrower_Lbp, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="latestPermitSelect" name="latestPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_LbpDesc" name="borrower_LbpDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LATEST PROOF OF BILLING (MERALCO) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LATEST PROOF OF BILLING (MERALCO)</label>
                                          <input type="file" id="borrower_Lpb" name="borrower_Lpb"><img id="borrower_LpbImage" src="statusImage/check.png" alt="statusImage"> 
                                          <a href="<?php echo $borrower_Lpb; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_LpbButton">Open File</button></a>
                                          <label class="date-label" id="borrower_LpbDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Lpb, strrpos($borrower_Lpb, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-3">
                                          <select  id="latestProofSelect" name="latestProofSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_LpbDesc" name="borrower_LpbDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><u>CO-BORROWER</u></label></div>
                                    </div>
                                 </div>
                                  <!-- CO-BORROWER STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels">CO-BORROWER STATEMENT </label>
                                          <input type="file" id="coborrowerStatement" name="coborrowerStatement"><img id="coborrowerStatementImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coborrowerStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coborrowerStatementButton">Open File</button></a> 
                                          <label class="date-label" id="coborrowerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coborrowerStatement, strrpos($coborrowerStatement, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="coborrowerStatementSelect" name="coborrowerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coborrowerStatementDesc"  name="coborrowerStatementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class="micro-labels" id="tab-label" for="custom" >1 COPY OF 2 VALID ID WITH 3 SIGNATURES</label> 
                                          <input type="file" id="coBorrowerIdSign" name="coBorrowerIdSign"><img id="coBorrowerIdSignImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coBorrowerIdSign; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coBorrowerIdSignButton">Open File</button></a>
                                          <label class="date-label" id="coBorrowerIdSignDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($coBorrowerIdSign, strrpos($coBorrowerIdSign, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="coborrowerIdSelect" name="coborrowerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL" >Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coBorrowerIdSignDesc" name="coBorrowerIdSignDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!--PROOF OF INCOME (IF APPLICABLE) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class="micro-labels" id="tab-label" for="custom">PROOF OF INCOME (IF APPLICABLE)</label>
                                          <input type="file" id="proofIncome" name="proofIncome"><img id="proofIncomeImage" src="statusImage/check.png" alt="statusImage"> 
                                          <a href="<?php echo $proofIncome; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofIncomeButton">Open File</button></a>
                                          <label class="date-label" id="proofIncomeDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($proofIncome, strrpos($proofIncome, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="proofIncomeSelect" name="proofIncomeSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="proofIncomeDesc" name="proofIncomeDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><u>CO-MAKER</u></label></div>
                                    </div>
                                 </div>
                                 <!-- CO=MAKER STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels">CO-MAKER STATEMENT</label>
                                          <input type="file" id="comakerStatement" name="comakerStatement"><img id="comakerStatementImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $comakerStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="comakerStatementButton">Open File</button></a> 
                                          <label class="date-label" id="comakerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($comakerStatement, strrpos($comakerStatement, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerStatementSelect" name="comakerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="comakerStatementDesc" name="comakerStatementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">1 COPY OF 2 VALID ID WITH 3 SIGNATURES</label>
                                          <input type="file" id="coMakerIdWithSign" name="coMakerIdWithSign"><img id="coMakerIdWithSignImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coMakerIdWithSign; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coMakerIdWithSignButton">Open File</button></a>
                                          <label class="date-label" id="coMakerIdWithSignDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerIdWithSign, strrpos($coMakerIdWithSign, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerValidSelect" name="comakerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coMakerIdWithSignDesc" name="coMakerIdWithSignDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LATEST BUSINESS PERMIT (IF APPLICABLE) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LATEST BUSINESS PERMIT (IF APPLICABLE)</label>
                                          <input type="file" id="latestPermit" name="latestPermit"><img id="latestPermitImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $latestPermit; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestPermitButton">Open File</button></a>
                                          <label class="date-label" id="latestPermitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestPermit, strrpos($latestPermit, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerPermitSelect" name="comakerPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="latestPermitvDesc" name="latestPermitvDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                  <!--3 MONTHS OF PAYSLIP (IF EMPLOYED)  -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">3 MONTHS OF PAYSLIP (IF EMPLOYED)</label>
                                          <input type="file" id="coMakerPayslip" name="coMakerPayslip"><img id="coMakerPayslipImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coMakerPayslip;?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coMakerPayslipButton">Open File</button></a>
                                          <label class="date-label" id="coMakerPayslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerPayslip, strrpos($coMakerPayslip, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerPayslipSelect" name="comakerPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coMakerPayslipDesc" name="coMakerPayslipDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8" style="height:5.8em; margin-bottom:-2%;"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 my-4"><br>
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
                                       <div class="col-8" style="height:1; margin-top:-0.5%;"></div>
                                    </div>
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-3">&nbsp;<label style="font-size:130%"><u>DOCUMENT REPORTS</u></label></div>
                                       </div>
                                    </div>
                                    <!-- CLIENT'S VALIDATION CARD REPORTS -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">&#x2022; CLIENT'S VISITATION CARD REPORTS</label>
                                             <input type="file" id="validCardReport" name="validCardReport"><img id="validCardReportImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $validCardReport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validCardReportButton">Open File</button></a> 
                                             <label class="date-label" id="validCardReportDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($validCardReport, strrpos($validCardReport, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4 ">
                                             <select  id="validCardReportSelect" name="validCardReportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="validCardReportDesc" name="validCardReportDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- CREDIT INVESTIGATION REPORT -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">&#x2022; CREDIT INVESTIGATION REPORT</label>
                                             <input type="file" id="creditReport" name="creditReport"><img id="creditReportImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $creditReport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditReportButton">Open File</button></a> 
                                             <label class="date-label" id="creditReportDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditReport, strrpos($creditReport, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4">
                                             <select id="creditReportSelect" name="creditReportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL" >Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="creditReportDesc" name="creditReportDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- CREDIT INFORMATION AND BACKGROUND INVESTIGATION REPORT -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2 mb-3">
                                             <label class ="micro-labels"> &#x2022; CREDIT INFORMATION AND BACKGROUND INVESTIGATION REPORT</label>
                                             <input type="file" id="creditInvestigationReportM" name="creditInvestigationReportM"><img id="creditInvestigationReportMImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $creditInvestigationReportM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportMButton">Open File</button></a> 
                                             <label class="date-label" id="creditInvestigationReportMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportM, strrpos($creditInvestigationReportM, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-2">
                                             <select id="creditInvestigationReportMSelect" name="creditInvestigationReportMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="creditInvestigationReportMDesc" name="creditInvestigationReportMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- AUTHORITY TO DEBIT AND WAIVER -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">AUTHORITY TO DEBIT AND WAIVER</label>
                                             <input type="file" id="debitWaiver" name="debitWaiver"><img id="debitWaiverImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $debitWaiver; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="debitWaiverButton">Open File</button></a> 
                                             <label class="date-label" id="debitWaiverDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($debitWaiver, strrpos($debitWaiver, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4">
                                             <select id="debitWaiverSelect" name="debitWaiverSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="debitWaiverDesc" name="debitWaiverDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- AFFIDAVIT OF VOLUNTARY SURRENDER -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">AFFIDAVIT OF VOLUNTARY SURRENDER</label>
                                             <input type="file" id="affidavitSurrender" name="affidavitSurrender"><img id="affidavitSurrenderImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $affidavitSurrender; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="affidavitSurrenderButton">Open File</button></a> 
                                             <label class="date-label" id="affidavitSurrenderDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($affidavitSurrender, strrpos($affidavitSurrender, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4">
                                             <select id="affidavitSurrenderSelect" name="affidavitSurrenderSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="affidavitSurrenderDesc" name="affidavitSurrenderDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- BORROWER'S RISK RATING (BRR)/CASHFLOW -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels"> BORROWER'S RISK RATING (BRR)/CASHFLOW </label>
                                             <input type="file" id="riskRating" name="riskRating"><img id="riskRatingImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $riskRating; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="riskRatingButton">Open File</button></a> 
                                             <label class="date-label" id="riskRatingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($riskRating, strrpos($riskRating, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-3">
                                             <select id="riskRatingSelect" name="riskRatingSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="riskRatingDesc" name="riskRatingDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- LOAN APPROVAL SHEET -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">LOAN APPROVAL SHEET </label>
                                             <input type="file" id="loanApprovalSheet" name="loanApprovalSheet"><img id="loanApprovalSheetImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $loanApprovalSheet; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanApprovalSheetButton">Open File</button></a> 
                                             <label class="date-label" id="loanApprovalSheetDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanApprovalSheet, strrpos($loanApprovalSheet, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4" >
                                             <select id="loanApprovalSheetSelect" name="loanApprovalSheetSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="loanApprovalSheetDesc" name="loanApprovalSheetDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-1">&nbsp;<label style="font-size:130%"><u>SIGNED DOCUMENTS FOR LOAN RELEASSES</u></label></div>
                                       </div>
                                    </div>
                                    <!-- PROMISSORY NOTE -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">&#x2022; PROMISSORY NOTE</label>
                                             <input type="file" id="promissoryNoteM" name="promissoryNoteM"><img id="promissoryNoteMImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $promissoryNoteM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promissoryNoteMButton">Open File</button></a>
                                             <label class="date-label" id="promissoryNoteMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promissoryNoteM, strrpos($promissoryNoteM, '/') + 1, 10); ?></label> 
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4">
                                             <select id="promissoryNoteMSelect" name="promissoryNoteMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="promissoryNoteMDesc" name="promissoryNoteMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- DISCLOSURE STATEMENT -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">&#x2022; DISCLOSURE STATEMENT</label>
                                             <input type="file" id="disclosureStateM" name="disclosureStateM"><img id="disclosureStateMImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $disclosureStateM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateMButton">Open File</button></a> 
                                             <label class="date-label" id="disclosureStateMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateM, strrpos($disclosureStateM, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4">
                                             <select id="disclosureStateMSelect" name="disclosureStateMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="disclosureStateMDesc" name="disclosureStateMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- AMORTIZATION SCHEDULE -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2">
                                             <label class ="micro-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                             <input type="file" id="amortScheduleM" name="amortScheduleM"><img id="amortScheduleMImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $amortScheduleM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleMButton">Open File</button></a>
                                             <label class="date-label" id="amortScheduleMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleM, strrpos($amortScheduleM, '/') + 1, 10); ?></label> 
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex">
                                             <select id="amortScheduleMSelect" name="amortScheduleMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="amortScheduleMDesc" name="amortScheduleMDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                          </div>
                                       </div>
                                    </div>
                                    <div class ="OTHERS">
                                    <div class="row">
                                       <div class="col-8">
                                          <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.4em;">
                                             <div class="py-1">&nbsp;<label style="font-size:150%"><u>OTHERS</u></label></div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- BUSINESS PICTURE -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2"> 
                                             &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="businessPictureCheck" name="businessPictureCheck">
                                             <label class ="micro-labels">BUSINESS PICTURE </label>
                                             <input type="file" id="businessPicture" name="businessPicture"><img id="businessPictureImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $businessPicture; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessPictureButton">Open File</button></a> 
                                             <label class="date-label" id="businessPictureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessPicture, strrpos($businessPicture, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex mb-4">
                                             <select id="businessPictureSelect" name="businessPictureSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>t
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="businessPictureDesc" name="businessPictureDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <!-- OTHERS (SUPPORTING DOCUMENTS) -->
                                    <div class="row">
                                       <div class="col-8">
                                          <div class="py-2"> 
                                             &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="otherSuportCheck" name="otherSuportCheck">
                                             <label class ="micro-labels">OTHERS (SUPPORTING DOCUMENTS)</label>
                                             <input type="file" id="otherSuport" name="otherSuport"><img id="otherSuportImage" src="statusImage/check.png" alt="statusImage">
                                             <a href="<?php echo $otherSuport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherSuportButton">Open File</button></a>
                                             <label class="date-label" id="otherSuportDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherSuport, strrpos($otherSuport, '/') + 1, 10); ?></label>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group d-flex">
                                             <select id="otherSuportSelect" name="otherSuportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                <option selected value="NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                             </select>
                                             &nbsp;&nbsp;<input type="text" id="otherSuportDesc" name="otherSuportDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-8" style="height: 1.3em; margin-bottom:-2%;"></div>
                                    </div>
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
                                    <input type="hidden" id="hiddenif" name="hiddenif" value="<?= $rows['mfLetter']; ?>">
                                    <input type="hidden" id="hiddenif2" name="hiddenif2" value="<?= $rows['mfLetter2']; ?>">
                                    <input type="hidden" id="hiddenLate" name="hiddenLate" value="<?= $duecDLate; ?>">
                                 </div>
                                 <div class="col-2">
                                    <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%;">&nbsp;</h5></div>
                                    <input type="file" id="mfLetter" name="mfLetter" style="display: none;">
                                    <label for="mfLetter" class="formfLetter btn-sm" id="formfLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                    
                                    <?php 
                                       if(!empty($mfLetter)){
                                          echo '<a href="' . $mfLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mfLetterButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                          echo '&nbsp;<button type="button" id="mfLetterNew" class="fa-solid fa-plus mfLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       }else{
                                          // echo '&nbsp;<button type="button" id="mfLetterNew" class="fa-solid fa-plus mfLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                       }
                                       echo '&nbsp;<button type="button" id="mfLetterShowOld" class="fa-solid fa-scroll mfLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                    ?>
                                    <img id="mfLetterImage" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                    <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">REGISTRY RECEIPT</h5></div>
                                    <input type="file" id="mfLetter2" name="mfLetter2" style="display: none;">
                                    <label for="mfLetter2" class="formfLetter2 btn-sm" id="formfLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                    <?php 
                                       if(!empty($mfLetter2)){
                                          echo '<a href="' . $mfLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mfLetter2Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                          echo '&nbsp;<button type="button" id="mfLetter2New" class="fa-solid fa-plus mfLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       }else{
                                          // echo '&nbsp;<button type="button" id="mfLetter2New" class="fa-solid fa-plus mfLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                       }
                                       echo '&nbsp;<button type="button" id="mfLetter2ShowOld" class="fa-solid fa-scroll mfLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                    ?>
                                    <img id="mfLetter2Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                    <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">RETURN RECEIPT</h5></div>
                                    <input type="file" id="mfLetter3" name="mfLetter3" style="display: none;">
                                    <label for="mfLetter3" class="formfLetter3 btn-sm" id="formfLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                    <?php 
                                       if(!empty($mfLetter3)){
                                          echo '<a href="' . $mfLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mfLetter3Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                          echo '&nbsp;<button type="button" id="mfLetter3New" class="fa-solid fa-plus mfLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       }else{
                                          // echo '&nbsp;<button type="button" id="mfLetter3New" class="fa-solid fa-plus mfLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                       }
                                       echo '&nbsp;<button type="button" id="mfLetter3ShowOld" class="fa-solid fa-scroll mfLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                    ?>
                                    <img id="mfLetter3Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                       <!-- <div class="py-1"> -->
                                       <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 102%; border-right: 1px solid #ccc; margin-left: 9%;">DATE</h5></div>
                                       <label class="date-label" id="mfLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mfLetter, strrpos($mfLetter, '/') + 1, 10); ?></label>
                                       <!-- </div> -->
                                 </div>
                              <div class="col-2">
                                 <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 108%; margin-left: -2%;">REMARKS</h5></div>
                                 <div class="form-group d-flex mb-4" id="">
                                    &nbsp;&nbsp;<input type="text" id="mfLetterSelect" name="mfLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mfLetterRemarks']; ?>">
                                    &nbsp;&nbsp;<input type="hidden" class="fom-control w-75 p-1 fs-4" placeholder="REMARKS" id="mfLetterDesc" name="mfLetterDesc" >&nbsp;
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-2">
                                    <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">SECOND LETTER</label>
                                    <input type="hidden" id="hiddenis" name="hiddenis" value="<?= $rows['msLetter']; ?>">
                                    <input type="hidden" id="hiddenis2" name="hiddenis2" value="<?= $rows['msLetter2']; ?>">
                              </div>
                              <div class="col-2">
                                    <input type="file" id="msLetter" name="msLetter" style="display: none;">
                                    <label for="msLetter" class="formsLetter btn-sm" id="formsLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                    <?php 
                                       if(!empty($msLetter)){
                                          echo '<a href="' . $msLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="msLetterButton" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                          echo '&nbsp;<button type="button" id="msLetterNew" class="fa-solid fa-plus msLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       }else{
                                          // echo '&nbsp;<button type="button" id="msLetterNew" class="fa-solid fa-plus msLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                       }
                                       echo '&nbsp;<button type="button" id="msLetterShowOld" class="fa-solid fa-scroll msLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                    ?>
                                    <img id="msLetterImage" src="statusImage/check.png" alt="statusImage">
                              </div>
                              <div class="col-2">
                                    <input type="file" id="msLetter2" name="msLetter2" style="display: none;">
                                    <label for="msLetter2" class="formsLetter2 btn-sm" id="formsLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                    <?php 
                                       if(!empty($msLetter2)){
                                          echo '<a href="' . $msLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="msLetter2Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                          echo '&nbsp;<button type="button" id="msLetter2New" class="fa-solid fa-plus msLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       }else{
                                          // echo '&nbsp;<button type="button" id="msLetter2New" class="fa-solid fa-plus msLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                       }
                                       echo '&nbsp;<button type="button" id="msLetter2ShowOld" class="fa-solid fa-scroll msLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                    ?>
                                    <img id="msLetter2Image" src="statusImage/check.png" alt="statusImage">
                              </div>
                              <div class="col-2">
                                    <input type="file" id="msLetter3" name="msLetter3" style="display: none;">
                                    <label for="msLetter3" class="formsLetter3 btn-sm btn" id="formsLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                    <?php 
                                       if(!empty($msLetter3)){
                                          echo '<a href="' . $msLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="msLetter3Button" style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                          echo '&nbsp;<button type="button" id="msLetter3New" class="fa-solid fa-plus msLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       }else{
                                          // echo '&nbsp;<button type="button" id="msLetter3New" class="fa-solid fa-plus msLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                       }
                                       echo '&nbsp;<button type="button" id="msLetter3ShowOld" class="fa-solid fa-scroll msLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                    ?>
                                    <img id="msLetter3Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                              <div class="col-2">
                                    <label class="date-label" id="msLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($msLetter, strrpos($msLetter, '/') + 1, 10); ?></label>
                              </div>
                                 <div class="col-2" id="">
                                    <div class="form-group d-flex mb-4">
                                       &nbsp;&nbsp;<input type="text" id="msLetterSelect" name="msLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['msLetterRemarks']; ?>">
                                       &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="msLetterDesc" name="msLetterDesc" >&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-2">
                                       <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">THIRD LETTER</label>
                                       <input type="hidden" id="hiddenit" name="hiddenit" value="<?= $rows['mtLetter']; ?>">
                                       <input type="hidden" id="hiddenit2" name="hiddenit" value="<?= $rows['mtLetter2']; ?>">
                                 </div>
                                 <div class="col-2">
                                    <input type="file" id="mtLetter" name="mtLetter" style="display: none;">
                                    <label for="mtLetter" class="formtLetter btn-sm btn" id="formtLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mtLetter)){
                                             echo '<a href="' . $mtLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mtLetterButton" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mtLetterNew" class="fa-solid fa-plus mtLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mtLetterNew" class="fa-solid fa-plus mtLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mtLetterShowOld" class="fa-solid fa-scroll mtLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                    <img id="mtLetterImage" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                    <input type="file" id="mtLetter2" name="mtLetter2" style="display: none;">
                                    <label for="mtLetter2" class="formtLetter2 btn-sm btn" id="formtLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mtLetter2)){
                                             echo '<a href="' . $mtLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mtLetter2Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mtLetter2New" class="fa-solid fa-plus mtLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mtLetter2New" class="fa-solid fa-plus mtLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mtLetter2ShowOld" class="fa-solid fa-scroll mtLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mtLetter2Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                    <input type="file" id="mtLetter3" name="mtLetter3" style="display: none;">
                                    <label for="mtLetter3" class="formtLetter3 btn-sm btn" id="formtLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mtLetter3)){
                                             echo '<a href="' . $mtLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mtLetter3Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mtLetter3New" class="fa-solid fa-plus mtLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mtLetter3New" class="fa-solid fa-plus mtLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mtLetter3ShowOld" class="fa-solid fa-scroll mtLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mtLetter3Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                       <label class="date-label" id="mtLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mtLetter, strrpos($mtLetter, '/') + 1, 10); ?></label>
                                 </div>
                                 <div class="col-2" id="">
                                          <div class="form-group d-flex mb-4">
                                             &nbsp;&nbsp;<input type="text" id="mtLetterSelect" name="mtLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mtLetterRemarks']; ?>">
                                             &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mtLetterDesc" name="mtLetterDesc" >&nbsp;
                                          </div>
                                    </div>
                                 </div>
                              <div class="row">
                                 <div class="col-2">
                                    <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">FINAL LETTER</label>
                                    <input type="hidden" id="hiddenifd" name="hiddenifd" value="<?= $rows['mfdLetter']; ?>">
                                    <input type="hidden" id="hiddenifd2" name="hiddenifd2" value="<?= $rows['mfdLetter2']; ?>">
                                 </div>
                                 <div class="col-2">
                                    <input type="file" id="mfdLetter" name="mfdLetter" style="display: none;">
                                    <label for="mfdLetter" class="formfdLetter btn-sm btn" id="formfdLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mfdLetter)){
                                             echo '<a href="' . $mfdLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mfdLetterButton" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mfdLetterNew" class="fa-solid fa-plus mfdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mfdLetterNew" class="fa-solid fa-plus mfdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mfdLetterShowOld" class="fa-solid fa-scroll mfdLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mfdLetterImage" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                    <input type="file" id="mfdLetter2" name="mfdLetter2" style="display: none;">
                                    <label for="mfdLetter2" class="formfdLetter2 btn-sm btn" id="formfdLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mfdLetter2)){
                                             echo '<a href="' . $mfdLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mfdLetter2Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mfdLetter2New" class="fa-solid fa-plus mfdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mfdLetter2New" class="fa-solid fa-plus mfdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mfdLetter2ShowOld" class="fa-solid fa-scroll mfdLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mfdLetter2Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                    <input type="file" id="mfdLetter3" name="mfdLetter3" style="display: none;">
                                    <label for="mfdLetter3" class="formfdLetter3 btn-sm btn" id="formfdLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mfdLetter3)){
                                             echo '<a href="' . $mfdLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mfdLetter3Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mfdLetter3New" class="fa-solid fa-plus mfdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mfdLetter3New" class="fa-solid fa-plus mfdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mfdLetter3ShowOld" class="fa-solid fa-scroll mfdLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mfdLetter3Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                       <label class="date-label" id="mfdLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mfdLetter, strrpos($mfdLetter, '/') + 1, 10); ?></label>
                                 </div>
                                 <div class="col-2" id="">
                                       <div class="form-group d-flex mb-4">
                                          &nbsp;&nbsp;<input type="text" id="mfdLetterSelect" name="mfdLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mfdLetterRemarks']; ?>">
                                          &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mfdLetterDesc" name="mfdLetterDesc" >&nbsp;
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
                                          <input type="hidden" id="hiddenClient1" name="hiddenClient1" value="<?= $rows['mclientReq1']; ?>">
                                          <input type="hidden" id="hiddenClient2" name="hiddenClient2" value="<?= $rows['mclientReq2']; ?>">
                                          <input type="hidden" id="hiddenClient3" name="hiddenClient3" value="<?= $rows['mclientReq3']; ?>">
                                    </div>
                                    <div class="col-2">
                                          <input type="file" id="mclientReq1" name="mclientReq1" style="display: none;">
                                          <label for="mclientReq1" class="formclientReq1 btn-sm" id="formclientReq1" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mclientReq1)){
                                             echo '<a href="' . $mclientReq1 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mclientReq1Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mclientReq1New" class="fa-solid fa-plus mclientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mclientReq1New" class="fa-solid fa-plus mclientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mclientReq1ShowOld" class="fa-solid fa-scroll mclientReq1ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mclientReq1Image" src="statusImage/check.png" alt="statusImage">
                                    </div>
                                    <div class="col-2">
                                          <input type="file" id="mclientReq2" name="mclientReq2" style="display: none;">
                                          <label for="mclientReq2" class="formclientReq2 btn-sm" id="formclientReq2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mclientReq2)){
                                             echo '<a href="' . $mclientReq2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mclientReq2Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mclientReq2New" class="fa-solid fa-plus mclientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mclientReq1New" class="fa-solid fa-plus mclientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mclientReq2ShowOld" class="fa-solid fa-scroll mclientReq2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mclientReq2Image" src="statusImage/check.png" alt="statusImage">
                                    </div>
                                    <div class="col-2">
                                       <input type="file" id="mclientReq3" name="mclientReq3" style="display: none;">
                                       <label for="mclientReq3" class="formclientReq3 btn-sm" id="formclientReq3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mclientReq3)){
                                             echo '<a href="' . $mclientReq3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mclientReq3Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mclientReq3New" class="fa-solid fa-plus mclientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="mclientReq3New" class="fa-solid fa-plus mclientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mclientReq3ShowOld" class="fa-solid fa-scroll mclientReq3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mclientReq3Image" src="statusImage/check.png" alt="statusImage">
                                    </div>
                                    <div class="col-2">
                                          <label class="date-label" id="mclientReq1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mclientReq1, strrpos($mclientReq1, '/') + 1, 10); ?></label>
                                    </div>
                                    <div class="col-2" id="">
                                       <div class="form-group d-flex mb-4">
                                          &nbsp;&nbsp;<input type="text" id="mclientReq1Select" name="mclientReq1Select" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mclientReqRemarks']; ?>">
                                          &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mclientReq1Desc" name="mclientReq1Desc" >&nbsp;
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
                                       <input type="file" id="mffClosure" name="mffClosure" style="display: none;">
                                       <label for="mffClosure" class="formffClosure btn-sm" id="formffClosure" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mffClosure)){
                                             echo '<a href="' . $mffClosure . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mffClosureButton" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mffClosureNew" class="fa-solid fa-plus mffClosureNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mffClosureShowOld" class="fa-solid fa-scroll mffClosureShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mffClosureImage" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-1">
                        
                                    </div>
                                 <div class="col-2">
                                       <label class="date-label" id="mffClosureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mffClosure, strrpos($mffClosure, '/') + 1, 10); ?></label>
                                 </div>
                                 <div class="col-2">
                                          <div class="form-group d-flex mb-4">
                                             &nbsp;&nbsp;<input type="text" id="mffClosureSelect" name="mffClosureSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mffClosureRemarks']; ?>">
                                             &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mffClosureDesc" name="mffClosureDesc" >&nbsp;
                                          </div>
                                    </div>
                              </div>
                              <div class="row">
                                 <div class="col-3">
                                       <label class="corporation-label" id="tab-corporation" for="custom" style="padding-left: 2%;">PASTDUE TO LITIGATION</label>
                                 </div>
                                 <div class="col-2">
                                    <input type="file" id="mpastLitigation" name="mpastLitigation" style="display: none;">
                                    <label for="mpastLitigation" class="formpastLitigation btn-sm" id="formpastLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mpastLitigation)){
                                             echo '<a href="' . $mpastLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mpastLitigationButton" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mpastLitigationNew" class="fa-solid fa-plus mpastLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mpastLitigationShowOld" class="fa-solid fa-scroll mpastLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mpastLitigationImage" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-2">
                                       <input type="file" id="mpastLitigation2" name="mpastLitigation2" style="display: none;">
                                       <label for="mpastLitigation2" class="formpastLitigation2 btn-sm" id="formpastLitigation2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mpastLitigation2)){
                                             echo '<a href="' . $mpastLitigation2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mpastLitigation2Button" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mpastLitigation2New" class="fa-solid fa-plus mpastLitigation2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mpastLitigation2ShowOld" class="fa-solid fa-scroll mpastLitigation2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mpastLitigation2Image" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-1">
                                    <input class="form-check-input" type="checkbox" value="Yes" id="mpastCheck" name="mpastCheck"><label for=""><label class="individual-labels" id="label23" for="formpastCheck" style="font-size: 15px; display: inline;"> Bidding</label>
                                 </div>
                                 <div class="col-2">
                                       <label class="date-label" id="mpastLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mpastLitigation, strrpos($mpastLitigation, '/') + 1, 10); ?></label>
                                 </div>
                                 <div class="col-2">
                                          <div class="form-group d-flex mb-4">
                                             &nbsp;&nbsp;<input type="text" id="mpastLitigationSelect" name="mpastLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mpastLitigationRemarks']; ?>">
                                             &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mpastLitigationDesc" name="mpastLitigationDesc" >&nbsp;
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
                                       <input type="file" id="mttLitigation" name="mttLitigation" style="display: none;">
                                       <label for="mttLitigation" class="formttLitigation btn-sm" id="formttLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mttLitigation)){
                                             echo '<a href="' . $mttLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mttLitigationButton" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mttLitigationNew" class="fa-solid fa-plus mttLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mttLitigationShowOld" class="fa-solid fa-scroll mttLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mttLitigationImage" src="statusImage/check.png" alt="statusImage">
                                 </div>
                                 <div class="col-1">
                        
                                    </div>
                                 <div class="col-2">
                                       <label class="date-label" id="mttLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mttLitigation, strrpos($mttLitigation, '/') + 1, 10); ?></label>
                                 </div>
                                 <div class="col-2">
                                          <div class="form-group d-flex mb-4">
                                             &nbsp;&nbsp;<input type="text" id="mttLitigationSelect" name="mttLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mttLitigationRemarks']; ?>">
                                             &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mttLitigationDesc" name="mttLitigationDesc" >&nbsp;
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
                                    <input type="file" id="mPrepConso" name="mPrepConso" style="display : none;">
                                    <label for="mPrepConso" class="formPrepConso btn-sm" id="formPrepConso" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($mPrepConso)){
                                             echo '<a href="' . $mPrepConso . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="mPrepConsoButton" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="mPrepConsoNew" class="fa-solid fa-plus mPrepConsoNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="mPrepConsoShowOld" class="fa-solid fa-scroll mPrepConsoShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="mPrepConsoImage" src="statusImage/check.png" alt="statusImage">
                              </div>
                              <div class="col-1">
                        
                                 </div>
                              <div class="col-2">
                                    <label class="date-label" id="mPrepConsoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mPrepConso, strrpos($mPrepConso, '/') + 1, 10); ?></label>
                              </div>
                              <div class="col-2">
                                       <div class="form-group d-flex mb-4">
                                          &nbsp;&nbsp;<input type="text" id="mPrepConsoSelect" name="mPrepConsoSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['mPrepConsoRemarks']; ?>">
                                          &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mPrepConsoDesc" name="mPrepConsoDesc" >&nbsp;
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
                                    <input type="file" id="maDemand" name="maDemand" style="display: none;">
                                    <label for="maDemand" class="formaDemand btn-sm" id="formaDemand" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                       <?php 
                                          if(!empty($maDemand)){
                                             echo '<a href="' . $maDemand . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="maDemandButton" 
                                                   style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                             echo '&nbsp;<button type="button" id="maDemandNew" class="fa-solid fa-plus maDemandNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                          }else{
                                             // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                          }
                                          echo '&nbsp;<button type="button" id="maDemandShowOld" class="fa-solid fa-scroll maDemandShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                       ?>
                                       <img id="maDemandImage" src="statusImage/check.png" alt="statusImage">
                              </div>
                              <div class="col-1">
                        
                                 </div>
                              <div class="col-2">
                                    <label class="date-label" id="maDemandDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($maDemand, strrpos($maDemand, '/') + 1, 10); ?></label>
                              </div>
                              <div class="col-2">
                                       <div class="form-group d-flex mb-4">
                                          &nbsp;&nbsp;<input type="text" id="maDemandSelect" name="maDemandSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['maDemandRemarks']; ?>">
                                          &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="maDemandDesc" name="maDemandDesc" >&nbsp;
                                       </div>
                                 </div>
                           </div>
                              <div class="row">
                                 <!-- <div class="col-8" id= "notEndBuyerSpace" style="margin-bottom:-5%;"></div> -->
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
function hideText(){
    const inputElements = document.querySelectorAll('input[type="text"].form-control.w-75.p-1.fs-4');

// Loop through each input element and set the hidden attribute
inputElements.forEach(inputElement => {
  inputElement.style.visibility="hidden";
});
  }
hideText();

  function updateFileStatus(inputId, imageId) {
  var inputFile = document.getElementById(inputId);
  var image = document.getElementById(imageId);

  if (inputFile.files.length > 0) {
    image.src = 'statusImage/check.png'; // Show check icon if file is uploaded
    image.style.visibility = 'visible'; // Make the image visible
  }
}
// Displays the 'remarks' text field if the status is set to 'INCOMPLETE'.
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
handleSelectChange('loanAppFormMSelect', 'loanAppFormMDesc');
handleSelectChange('borrowerValidSelect', 'borrower_IdsignatureDesc');
handleSelectChange('latestPermitSelect', 'borrower_LbpDesc');
handleSelectChange('latestProofSelect', 'borrower_LpbDesc');
// CO-MAKER 1
handleSelectChange('coborrowerStatementSelect', 'coborrowerStatementDesc');
handleSelectChange('coborrowerIdSelect', 'coBorrowerIdSignDesc');
handleSelectChange('proofIncomeSelect', 'proofIncomeDesc');
// CO-MAKER 2
handleSelectChange('comakerStatementSelect', 'comakerStatementDesc');
handleSelectChange('comakerValidSelect', 'coMakerIdWithSignDesc');
handleSelectChange('comakerPermitSelect', 'latestPermitvDesc');
handleSelectChange('comakerPayslipSelect', 'coMakerPayslipDesc');
// OTHERS
handleSelectChange('businessPictureSelect', 'businessPictureDesc');
handleSelectChange('otherSuportSelect', 'otherSuportDesc');
// DOCUMENTS
handleSelectChange('validCardReportSelect', 'validCardReportDesc');
handleSelectChange('creditReportSelect', 'creditReportDesc');
handleSelectChange('creditInvestigationReportMSelect', 'creditInvestigationReportMDesc');
handleSelectChange('debitWaiverSelect', 'debitWaiverDesc');
handleSelectChange('affidavitSurrenderSelect', 'affidavitSurrenderDesc');
handleSelectChange('riskRatingSelect', 'riskRatingDesc');
handleSelectChange('loanApprovalSheetSelect', 'loanApprovalSheetDesc');
handleSelectChange('promissoryNoteMSelect', 'promissoryNoteMDesc');
handleSelectChange('disclosureStateMSelect', 'disclosureStateMDesc');
handleSelectChange('amortScheduleMSelect', 'amortScheduleMDesc');
// LETTER
// LEGAL
</script>

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, micId) {
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
                        d.micId = micId;
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
   $(document).on('click', '#mfLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mfLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mfLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mfLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mfLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mfLetter3.php', '<?php echo $id; ?>');
   });

   // Second Demand
   $(document).on('click', '#msLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_msLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#msLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_msLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#msLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_msLetter3.php', '<?php echo $id; ?>');
   });

   // Third Demand
   $(document).on('click', '#mtLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mtLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mtLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mtLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mtLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mtLetter3.php', '<?php echo $id; ?>');
   });

   // Final Demand
   $(document).on('click', '#mfdLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mfdLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mfdLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mfdLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mfdLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mfdLetter3.php', '<?php echo $id; ?>');
   });

   // other DOCUMENTS mclientReq1
   $(document).on('click', '#mclientReq1ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mclientReq1.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mclientReq2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mclientReq2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mclientReq3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mclientReq3.php', '<?php echo $id; ?>');
   });

   // foreclosure #
   $(document).on('click', '#mffClosureShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mffClosure.php', '<?php echo $id; ?>');
   });

   // pastdue litigation
   $(document).on('click', '#mpastLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mpastLitigation.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#mpastLitigation2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mpastLitigation2.php', '<?php echo $id; ?>');
   });

   //transfer litigation
   $(document).on('click', '#mttLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mttLitigation.php', '<?php echo $id; ?>');
   });

   // prepare for consolidate
   $(document).on('click', '#mPrepConsoShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_mPrepConso.php', '<?php echo $id; ?>');
   });

   // due and demandable
   $(document).on('click', '#maDemandShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_dm_maDemand.php', '<?php echo $id; ?>');
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
   $(document).on('click', '#mfLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mfLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mfLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 2nd Demand
   $(document).on('click', '#msLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#msLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#msLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 3rd Demand
   $(document).on('click', '#mtLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mtLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mtLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // Final Demand
   $(document).on('click', '#mfdLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mfdLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mfdLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // other docs #
   $(document).on('click', '#mclientReq1ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mclientReq2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mclientReq3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // foreclosure
   $(document).on('click', '#mffClosureShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // pastdue litigation
   $(document).on('click', '#mpastLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#mpastLitigation2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // transfer litigation
   $(document).on('click', '#mttLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // prepare for consolidate
   $(document).on('click', '#mPrepConsoShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // due and Demandable
   $(document).on('click', '#maDemandShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
</script>

<!-- Microfinance AJAX -->
<script>
var microform = document.getElementById("microfinance-form");
var microId = "<?php echo $id; ?>";
var fullname = "<?php echo $fullname; ?>";
var salaryType = "<?php echo $type; ?>";
var branch = "<?php echo $branch; ?>";
var loanType = "<?php echo $loanType; ?>";
var endPrompt = ""; // Global variable for remarks

//Function to handle file upload separately
function uploadFileM() {
  var microformData = new FormData(microform);
  microformData.append('microId',microId);
  microformData.append('fullname',fullname);
  microformData.append('salaryType',salaryType);
  microformData.append('branch',branch);
  microformData.append('loanType',loanType);

   // Append the endPrompt to the FormData
   microformData.append('endPrompt', endPrompt);
  $.ajax({
    url: 'loanMicroUploadData.php', // Targeted URL
    type: 'POST',
    data: microformData,
    processData: false,
    contentType: false,
    success: function(response) {
      // BORROWER
      updateFileStatus('loanAppFormM', 'loanAppFormMImage');
      updateFileStatus('borrower_Idsignature', 'borrower_IdsignatureImage');
      updateFileStatus('borrower_Lbp', 'borrower_LbpImage');
      updateFileStatus('borrower_Lpb', 'borrower_LpbImage');
      // CO BORROWER
      updateFileStatus('coborrowerStatement', 'coborrowerStatementImage');
      updateFileStatus('coBorrowerIdSign', 'coBorrowerIdSignImage');
      updateFileStatus('proofIncome', 'proofIncomeImage');
      // CO MAKER
      updateFileStatus('comakerStatement', 'comakerStatementImage');
      updateFileStatus('coMakerIdWithSign', 'coMakerIdWithSignImage');
      updateFileStatus('latestPermit', 'latestPermitImage');
      updateFileStatus('coMakerPayslip', 'coMakerPayslipImage');
      // OTHERS
      updateFileStatus('businessPicture', 'businessPictureImage');
      updateFileStatus('otherSuport', 'otherSuportImage');
      // DOCUMENTS
      updateFileStatus('validCardReport', 'validCardReportImage');
      updateFileStatus('creditReport', 'creditReportImage');
      updateFileStatus('creditInvestigationReportM', 'creditInvestigationReportMImage');
      updateFileStatus('debitWaiver', 'debitWaiverImage');
      updateFileStatus('affidavitSurrender', 'affidavitSurrenderImage');
      updateFileStatus('riskRating', 'riskRatingImage');
      updateFileStatus('loanApprovalSheet', 'loanApprovalSheetImage');
      // AFTER RELEASE DOCUMENTS
      updateFileStatus('promissoryNoteM', 'promissoryNoteMImage');
      updateFileStatus('disclosureStateM', 'disclosureStateMImage');
      updateFileStatus('amortScheduleM', 'amortScheduleMImage');
      // LETTER
      updateFileStatus('mfLetter', 'mfLetterImage');
      updateFileStatus('msLetter', 'msLetterImage');
      updateFileStatus('mtLetter', 'mtLetterImage');
      updateFileStatus('mfdLetter', 'mfdLetterImage');
      // LETTER2  
      updateFileStatus('mfLetter2', 'mfLetter2Image');
      updateFileStatus('msLetter2', 'msLetter2Image');
      updateFileStatus('mtLetter2', 'mtLetter2Image');
      updateFileStatus('mfdLetter2', 'mfdLetter2Image'); 
      // LETTER3
      updateFileStatus('mfLetter3', 'mfLetter3Image');
      updateFileStatus('msLetter3', 'msLetter3Image');
      updateFileStatus('mtLetter3', 'mtLetter3Image');
      updateFileStatus('mfdLetter3', 'mfdLetter3Image');   
      // OTHER ATTACHMENT
      updateFileStatus('mclientReq1', 'mclientReq1Image');
      updateFileStatus('mclientReq2', 'mclientReq2Image');
      updateFileStatus('mclientReq3', 'mclientReq3Image');
      // LEGAL
      updateFileStatus('mffClosure', 'mffClosureImage');
      updateFileStatus('mpastLitigation', 'mpastLitigationImage');
      updateFileStatus('mpastLitigation2', 'mpastLitigation2Image');
      updateFileStatus('mttLitigation', 'mttLitigationImage');
      updateFileStatus('mPrepConso', 'mPrepConsoImage');
      updateFileStatus('maDemand', 'maDemandImage');
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
        var microId = "<?php echo $id; ?>";
        // Trigger the file input and append the selected file to the form data
        setTimeout(function () {
            var fileInput = document.querySelector(inputSelector);
            fileInput.onchange = function () {
                var file = fileInput.files[0];
                if (file) {
                    formData.append(fileInput.name, file);  // Add file to the form data
                    formData.append('endPrompt', endPrompt); // Add remarks to the form data
                    formData.append('microId',  microId);

                    // Log FormData before sending
                    console.log("FormData before AJAX:", Array.from(formData.entries()));

                    // Send form data via AJAX
                    $.ajax({
                        url: 'loanMicroUploadData.php',
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
   $(document).on('click', '.mfLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mfLetter');
   });
   $(document).on('click', '.mfLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mfLetter2');
   });
   $(document).on('click', '.mfLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mfLetter3');
   });
   // for msLetter
   $(document).on('click', '.msLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#msLetter');
   });
   $(document).on('click', '.msLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#msLetter2');
   });
   $(document).on('click', '.msLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#msLetter3');
   });
   // 3rd Letter
   $(document).on('click', '.mtLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mtLetter');
   });
   $(document).on('click', '.mtLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mtLetter2');
   });
   $(document).on('click', '.mtLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mtLetter3');
   });
   // final DEMAND
   $(document).on('click', '.mfdLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mfdLetter');
   });
   $(document).on('click', '.mfdLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mfdLetter2');
   });
   $(document).on('click', '.mfdLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mfdLetter3');
   });

   // OTHER ATTACHMENT
   $(document).on('click', '.mclientReq1New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mclientReq1');
   });
   $(document).on('click', '.mclientReq2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mclientReq2');
   });
   $(document).on('click', '.mclientReq3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mclientReq3');
   });

   // LEGAL
   $(document).on('click', '.mffClosureNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mffClosure');
   });
   $(document).on('click', '.mpastLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mpastLitigation');
   });
   $(document).on('click', '.mpastLitigation2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mpastLitigation2');
   });
   
   // Transfer to ROPA
   $(document).on('click', '.mttLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mttLitigation');
   });
   // Prepare to Consolidation
   $(document).on('click', '.mPrepConsoNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#mPrepConso');
   });
   // Due and Demandable
   $(document).on('click', '.maDemandNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#maDemand');
   });


microform.addEventListener("change", function() {
  uploadFileM();
});
</script>

<!--  Approval Status and Description -->
<script>
  function selectOptionBasedOnValue(fieldValue, selectionId, description, target) {
    var dropdown = document.getElementById(selectionId);
    for (var i = 0; i < dropdown.options.length; i++) {
      if (dropdown.options[i].value === fieldValue) {
        if (fieldValue == "2") {
          document.getElementById(description).style.visibility = "visible";
          document.getElementById(description).value = target;
          dropdown.selectedIndex = i;
          break;
        } if(fieldValue=="1") {
          document.getElementById(description).style.visibility="hidden";
          document.getElementById(description).value = target;
          dropdown.selectedIndex = i;
          break;
        }
        else{
          document.getElementById(description).style.visibility="hidden";
        }
      }
    }
  }
// Used explode, to cut the data 

// BORROWER
selectOptionBasedOnValue('<?php echo explode('--', $loanAppFormMSelect)[0]; ?>', 'loanAppFormMSelect','loanAppFormMDesc','<?php echo explode("--", $loanAppFormMSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $borrower_IdSignSelect)[0]; ?>', 'borrowerValidSelect','borrower_IdsignatureDesc','<?php echo explode("--", $borrower_IdSignSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $borrower_LbpSelect)[0]; ?>', 'latestPermitSelect','borrower_LbpDesc','<?php echo explode("--", $borrower_LbpSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $borrower_LpbSelect)[0]; ?>', 'latestProofSelect','borrower_LpbDesc','<?php echo explode("--", $borrower_LpbSelect)[1]; ?>');
// CO-BORROWER
selectOptionBasedOnValue('<?php echo explode('--', $coborrowerStatementSelect)[0]; ?>', 'coborrowerStatementSelect','coborrowerStatementDesc','<?php echo explode("--", $coborrowerStatementSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $coBorrower_IdSignSelect)[0]; ?>', 'coborrowerIdSelect','coBorrowerIdSignDesc','<?php echo explode("--", $coBorrower_IdSignSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $proofIncomeSelect)[0]; ?>', 'proofIncomeSelect','proofIncomeDesc','<?php echo explode("--", $proofIncomeSelect)[1]; ?>');
// CO-MAKER
selectOptionBasedOnValue('<?php echo explode('--', $comakerStatementSelect)[0]; ?>', 'comakerStatementSelect','comakerStatementDesc','<?php echo explode("--", $comakerStatementSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $coMaker_IdSignSelect)[0]; ?>', 'comakerValidSelect','coMakerIdWithSignDesc','<?php echo explode("--", $coMaker_IdSignSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $coMaker_LbpSelect)[0]; ?>', 'comakerPermitSelect','latestPermitvDesc','<?php echo explode("--", $coMaker_LbpSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $coMaker_PayslipSelect)[0]; ?>', 'comakerPayslipSelect','coMakerPayslipDesc','<?php echo explode("--", $coMaker_PayslipSelect)[1]; ?>');
// OTHERS
selectOptionBasedOnValue('<?php echo explode('--', $businessPictureSelect)[0]; ?>', 'businessPictureSelect','businessPictureDesc','<?php echo explode("--", $businessPictureSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $otherSuportSelect)[0]; ?>', 'otherSuportSelect','otherSuportDesc','<?php echo explode("--", $otherSuportSelect)[1]; ?>');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo explode('--', $validCardReportSelect)[0]; ?>', 'validCardReportSelect','validCardReportDesc','<?php echo explode("--", $validCardReportSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $creditReportSelect)[0]; ?>', 'creditReportSelect','creditReportDesc','<?php echo explode("--", $creditReportSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $creditInvestigationReportMSelect)[0]; ?>', 'creditInvestigationReportMSelect','creditInvestigationReportMDesc','<?php echo explode("--", $creditInvestigationReportMSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $debitWaiverSelect)[0]; ?>', 'debitWaiverSelect','debitWaiverDesc','<?php echo explode("--", $debitWaiverSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $affidavitSurrenderSelect)[0]; ?>', 'affidavitSurrenderSelect','affidavitSurrenderDesc','<?php echo explode("--", $affidavitSurrenderSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $riskRatingSelect)[0]; ?>', 'riskRatingSelect','riskRatingDesc','<?php echo explode("--", $riskRatingSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $loanApprovalSheetSelect)[0]; ?>', 'loanApprovalSheetSelect','loanApprovalSheetDesc','<?php echo explode("--", $loanApprovalSheetSelect)[1]; ?>');
// AFTER RELEASE 
selectOptionBasedOnValue('<?php echo explode('--', $promissoryNoteMSelect)[0]; ?>', 'promissoryNoteMSelect','promissoryNoteMDesc','<?php echo explode("--", $promissoryNoteMSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $disclosureStateMSelect)[0]; ?>', 'disclosureStateMSelect','disclosureStateMDesc','<?php echo explode("--", $disclosureStateMSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode('--', $amortScheduleMSelect)[0]; ?>', 'amortScheduleMSelect','amortScheduleMDesc','<?php echo explode("--", $amortScheduleMSelect)[1]; ?>');

// LETTER

// LEGAL


</script>


<script>
  
  // Only BM can see the Upload Button
$(document).ready(function() {
  var bm= "<?php echo $_SESSION['position']; ?>";
  var username = "<?php echo $_SESSION['username']; ?>";
  if (bm == "BM" || username == "jcvillanueva" || username == 'ctborgonia') {
  $('.microfinance-tabs input[type="file"]').css('visibility', 'visible');
} else {
  $('.microfinance-tabs  input[type="file"]').css('visibility', 'hidden'); 
}
});
</script>

<script>
function initializeCheckboxes() {  
  var businessPictureValue = "<?php echo $businessPictureCheck; ?>";
  var otherSuportValue = "<?php echo $otherSuportCheck; ?>";

  // Get the checkbox elements
  const businessPictureCheck = document.getElementById('businessPictureCheck');
  const otherSuportCheck = document.getElementById('otherSuportCheck');

  // Check the checkboxes based on the PHP Data
  function showInput(inputValue, checkbox, files, select, description, image) {
   if (inputValue === "Check") {
    checkbox.setAttribute('checked', 'checked');
  } else if(inputValue=="Uncheck" || inputValue==""){
    document.getElementById(select).style.visibility = "hidden";
    document.getElementById(files).style.display = "none";
    document.getElementById(description).style.visibility = "hidden";
    document.getElementById(image).style.visibility = "hidden";
  }
}
showInput(businessPictureValue, businessPictureCheck,'businessPicture', 'businessPictureSelect', 'businessPictureDesc', `businessPictureImage`);
showInput(otherSuportValue, otherSuportCheck,'otherSuport', 'otherSuportSelect', 'otherSuportDesc',`otherSuportImage`);
  
}
// Call the function to initialize the checkboxes on page load
initializeCheckboxes();

</script>
<script>
function toggleVisibility(elementId) {
    var element = document.getElementById(elementId);
    var selectElement = document.getElementById(elementId + 'Select');
    var descElement = document.getElementById(elementId + 'Desc');
    if (element.style.display === 'none') {
        element.style.display = "inline";
        selectElement.style.visibility = "visible";
        selectElement.selectedIndex = 0;
    } else {
        element.style.display = "none";
        selectElement.style.visibility = "hidden";

        if(descElement.style.visibility==='visible'){
          descElement.style.visibility="hidden";
        }
    }
}

document.getElementById("businessPictureCheck").addEventListener("click", function() {
    toggleVisibility('businessPicture');
});

document.getElementById("otherSuportCheck").addEventListener("click", function() {
    toggleVisibility('otherSuport');
});

</script>

<script>
// RESET THE VALUE OF SELECT TO ZERO(OPTION)
  function resetIndex(targetId,targetSelect,targetDesc){
  document.getElementById(targetId).addEventListener('change', function() {
  var selectElement = document.getElementById(targetSelect);
  selectElement.selectedIndex = 0;
  document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
  });
  }
resetIndex('loanAppFormM', 'loanAppFormMSelect', 'loanAppFormMDesc');
resetIndex('borrower_Idsignature', 'borrowerValidSelect', 'borrower_IdsignatureDesc');
resetIndex('borrower_Lbp', 'latestPermitSelect', 'borrower_LbpDesc');
resetIndex('borrower_Lpb', 'latestProofSelect', 'borrower_LpbDesc');
resetIndex('coborrowerStatement', 'coborrowerStatementSelect', 'coborrowerStatementDesc');
resetIndex('coBorrowerIdSign', 'coborrowerIdSelect', 'coBorrowerIdSignDesc');
resetIndex('proofIncome', 'proofIncomeSelect', 'proofIncomeDesc');
resetIndex('comakerStatement', 'comakerStatementSelect', 'comakerStatementDesc');
resetIndex('coMakerIdWithSign', 'comakerValidSelect', 'coMakerIdWithSignDesc');
resetIndex('latestPermit', 'comakerPermitSelect', 'latestPermitvDesc');
resetIndex('coMakerPayslip', 'comakerPayslipSelect', 'coMakerPayslipDesc');
resetIndex('businessPicture', 'businessPictureSelect', 'businessPictureDesc');
resetIndex('otherSuport', 'otherSuportSelect', 'otherSuportDesc');
resetIndex('validCardReport', 'validCardReportSelect', 'validCardReportDesc');
resetIndex('creditReport', 'creditReportSelect', 'creditReportDesc');
resetIndex('creditInvestigationReportM', 'creditInvestigationReportMSelect', 'creditInvestigationReportMDesc');
resetIndex('debitWaiver', 'debitWaiverSelect', 'debitWaiverDesc');
resetIndex('affidavitSurrender', 'affidavitSurrenderSelect', 'affidavitSurrenderDesc');
resetIndex('riskRating', 'riskRatingSelect', 'riskRatingDesc');
resetIndex('loanApprovalSheet', 'loanApprovalSheetSelect', 'loanApprovalSheetDesc');
resetIndex('promissoryNoteM', 'promissoryNoteMSelect', 'promissoryNoteMDesc');
resetIndex('disclosureStateM', 'disclosureStateMSelect', 'disclosureStateMDesc');
resetIndex('amortScheduleM', 'amortScheduleMSelect', 'amortScheduleMDesc');
// // LETTER
// resetIndex('mfLetter', 'mfLetterSelect', 'mfLetterDesc');
// resetIndex('msLetter', 'msLetterSelect', 'msLetterDesc');
// resetIndex('mtLetter', 'mtLetterSelect', 'mtLetterDesc');
// resetIndex('mfdLetter', 'mfdLetterSelect', 'mfdLetterDesc');
// // LEGAL
// resetIndex('mffClosure', 'mffClosureSelect', 'mffClosureDesc');
// resetIndex('mttLitigation', 'mttLitigationSelect', 'mttLitigationDesc');
// resetIndex('maDemand', 'maDemandSelect', 'maDemandDesc');
</script> 

<script>
function initializePastCheck() {  
  var pastCheckVal = "<?php echo $mpastCheck; ?>";

  // Get the checkbox elements
  const pastCheckk = document.getElementById('mpastCheck');

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
   // Hidden Letter & Legal
   // function hiddenLetter(){
   //    var fLetter = $('#hiddenMf').val();
   //    var fLetterSelect = $('#mfLetterSelect').val();
   //    var sLetter = $('#hiddenMs').val();
   //    var sLetterSelect = $('msLetterSelect').val();
   //    var tLetter = $('#hiddenMt').val();
   //    var tLetterSelect = $('mtLetterSelect').val();
   //    // if true = & disable || readonly.
   //    if(fLetterSelect != '' && fLetter != ''){
   //       document.getElementById('msLetter').style.visibility = "true";
   //       document.getElementById('msLetterSelect').style.visibility = "true";
   //       document.getElementById('msLetterImage').style.visibility = "true";
   //    }
   //    else{
   //       document.getElementById('msLetter').style.visibility = "hidden";
   //       document.getElementById('msLetterSelect').style.visibility = "hidden";
   //       document.getElementById('msLetterImage').style.visibility = "hidden";
   //    }
   //    if(sLetter != '' && sLetterSelect != ''){
   //       document.getElementById('mtLetter').style.visibility = "true";
   //       document.getElementById('mtLetterSelect').style.visibility = "true";
   //       document.getElementById('mtLetterImage').style.visibility = "true";
   //    }
   //    else{
   //       document.getElementById('mtLetter').style.visibility = "hidden";
   //       document.getElementById('mtLetterSelect').style.visibility = "hidden";
   //       document.getElementById('mtLetterImage').style.visibility = "hidden";
   //    }
   //    if(tLetter != '' && tLetterSelect != ''){
   //       document.getElementById('mfdLetter').style.visibility = "true";
   //       document.getElementById('mfddLetterSelect').style.visibility = "true";
   //       document.getElementById('mfdLetterImage').style.visibility = "true";
   //    }
   //    else{
   //       document.getElementById('mfdLetter').style.visibility = "hidden";
   //       document.getElementById('mfdLetterSelect').style.visibility = "hidden";
   //       document.getElementById('mfdLetterImage').style.visibility = "hidden";
   //    }
   // }
   // hiddenLetter();
</script>

<script>

    function handleSearch() {
        // Buttons Selectors
        const selectElements = document.querySelectorAll('#microfinance select');
        const descriptionInputs = document.querySelectorAll('#microfinance input[type=text]');
        const inputFiles = document.querySelectorAll('.microfinance-tabs input[type=file]');
        const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
        const creditButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
       
        var username = "<?php echo $_SESSION['username']; ?>";
        var bankposition = "<?php echo $_SESSION['bankposition']; ?>";
        var position = "<?php echo $_SESSION['position']; ?>";
        var department = "<?php echo $_SESSION['department']; ?>";

        // Only this Person can Access Aprroval Section
             if (username !== "jcvillanueva" || username !== 'ctborgonia') {
                  selectElements.forEach(function(selectElement) {
                     selectElement.style.pointerEvents = "none";
             });
            //       descriptionInputs.forEach(function(descriptionInput) {
            //           descriptionInput.style.pointerEvents = "none";
            //  });
            }
   // REQUIREMENTS RESTRICTION
   if(position !== "BM" && department !== "1"){
      inputFiles.forEach(function(inputFile){
         inputFile.style.display="none";
      });
   }     
   if(bankposition !== "LOAN Assistant" && position !== "BM" && department !== "1"){
      document.getElementById("validCardReport").style.display="none";
      document.getElementById("debitWaiver").style.display="none";
      document.getElementById("affidavitSurrender").style.display="none";
   }

   if(username !== "cevinluan" && username !== "hriegodedios" && department!=="1"){
      document.getElementById("creditReport").style.display="none";
   }

   if(username !== "cevinluan" && username !== "hriegodedios" && department !== "1"){
      document.getElementById("creditReport").style.display="none";
      document.getElementById("creditInvestigationReportM").style.display="none";
   }
   if(username !== "apreyes" && department !== "1"){
      document.getElementById("validCardReport").style.display="none";

   }
   if(bankposition !== "LOAN Assistant" && position !== "BM" && username !== "apreyes" && department !== "1"){
      document.getElementById("riskRating").style.display="none";
      document.getElementById("loanApprovalSheet").style.display="none";
      document.getElementById("promissoryNoteM").style.display="none";
      document.getElementById("disclosureStateM").style.display="none";
      document.getElementById("amortScheduleM").style.display="none";
   }
    }
    // Important!!, Allow the it to initially run this function first.
    handleSearch();
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
showText('mfLetterSelect','46%');
showText('msLetterSelect','46%');
showText('mtLetterSelect','46%');
showText('mfdLetterSelect','46%');

showText('mffClosureSelect','46%');
showText('mpastLitigationSelect','46%');
showText('mttLitigationSelect','46%');
showText('mPrepConsoSelect','46%');
showText('maDemandSelect','46%');

showText('mclientReq1Select', '46%');

</script>

</body>
</html>