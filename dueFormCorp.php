<?php
include('connection.php');
include('fileuploadloan.php');

$id =  $_POST['loanId'];

// 
$sqlCollection = "SELECT * FROM duecollection WHERE duecProdID = '$id'";
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
         $data = mysqli_query($con, $query);
         
         if (!$data) {
           echo ("Error description: " . mysqli_error($mysqli));
         } else {
           while ($row = mysqli_fetch_array($data)) {
         
             $Cfname = $row['customerFirstName'];
             $Lfname = $row['customerSurname'];
             $fullname = $row['customerFullName'];
             $birth = $row['birthDate'];
             $id = $row['loan_Id'];
             $type = $row['salaryType'];
             $remType=$row['remType'];
             $sourceIncome=$row['sourceIncome'];
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
         if ($type == "REM: Corporation") {
         
         ?>
      <script>
         document.getElementById('tab3').classList.add('active');;
         document.getElementById('corporation').classList.add('active');
         document.getElementById('tab1').setAttribute('', '');
         document.getElementById('tab2').setAttribute('', '');
         document.getElementById('tab4').setAttribute('', '');
      </script>
      <?php
         $query3 = "SELECT * FROM corporation WHERE corpLoanId=$id ";
         $newdata = mysqli_query($con, $query3);
         $rows = mysqli_fetch_array($newdata);
         // PRINCIPAL BORROWER
         $endorsement = $rows['endorsement'];
         $loanAppFormC = $rows['loanAppFormC'];
         $companyProfile = $rows['ccompanyProfile'];
         $governmentId = $rows['governmentId'];
         $secRegistration = $rows['csecRegistration'];
         $latestGIS = $rows['clatestGIS'];
         $copyBRS = $rows['ccopyBRS'];
         $copyidCST = $rows['ccopyidCST'];
         // COLLATERAL DOCUMENTS
         $transferCertTitle = $rows['ctransferCertTitle'];
         $taxDeclaration = $rows['ctaxDeclaration'];
         $taxDeclartionICTC = $rows['ctaxDeclartionICTC'];
         $realStateReceipt = $rows['crealStateReceipt'];
         $realEstateTaxClearance = $rows['crealEstateTaxClearance'];
         $cdOfMorgage = $rows['ccdOfMorgage'];
         // BUSINESS PROOF OF INCOME
         $copyUpdatedBP = $rows['ccopyUpdatedBP'];
         $auditedFinancial = $rows['cauditedFinancial'];
         $inhouseFinancial = $rows['cinhouseFinancial'];
         $latestBank = $rows['clatestBank'];
         $incomeTaxReturn = $rows['incomeTaxReturn'];
         $contractLease = $rows['contractLease'];
         $customerContact = $rows['ccustomerContact'];
         $supplierContact = $rows['csupplierContact'];
         $idPicture = $rows['cidPicture'];
         $proofBilling = $rows['cproofBilling'];
         // OTHERS
         $powerAttorney = $rows['powerAttorney'];
         $contractSell = $rows['contractSell'];
         $letterGuarantee = $rows['letterGuarantee'];
         $statementAccount = $rows['statementAccount'];
         $billMaterials = $rows['billMaterials'];
         $proposedPlan = $rows['proposedPlan'];
         // DOCUMENTS
         $receipt = $rows['receipt'];
         $creditInvestigationReportC = $rows['creditInvestigationReportC'];
         $collateralAppraisalReportC = $rows['collateralAppraisalReportC'];
         $financialEvaluationC = $rows['financialEvaluationC'];
         $signedLetterC = $rows['signedLetterC'];
         $signedLoanMemoC = $rows['signedLoanMemoC'];
         $remContractC = $rows['remContractC'];
         $promNoteC = $rows['promNoteC'];
         $disclosureStateC = $rows['disclosureStateC'];
         $mriFormC = $rows['mriFormC'];
         $amortScheduleC = $rows['amortScheduleC'];
         $remContractAnnotatedC = $rows['remContractAnnotatedC'];
         $signedLetterUnderEndC = $rows['signedLetterUnderEndC'];
         $remContractEndC = $rows['remContractEndC'];
         $promNoteEndC = $rows['promNoteEndC'];
         $disclosureStateEndC = $rows['disclosureStateEndC'];
         $mriFormEndC = $rows['mriFormEndC'];
         $amortScheduleEndC = $rows['amortScheduleEndC'];
         $signedDeedUnderEndC = $rows['signedDeedUnderEndC'];
         $utilization=$rows['utilization'];
         $powerpoint=$rows['powerpoint'];
         $excel=$rows['excel'];
         // GETTING OF STATUS FROM DATABASE
         // PRINCIPAL BORROWER
         $endorsementSelect = $rows['endorsementStatus'];
         $loanAppFormCSelect = $rows['loanAppFormCStatus'];
         $companyProfileSelect = $rows['ccompanyProfileStatus'];
         $governmentIdSelect = $rows['governmentIdStatus'];
         $secRegistrationSelect = $rows['csecRegistrationStatus'];
         $latestGISSelect = $rows['clatestGISStatus'];
         $copyBRSSelect = $rows['ccopyBRSStatus'];
         $copyidCSTSelect = $rows['ccopyidCSTStatus'];
         // COLLATERAL DOCUMENTS
         $transferCertTitleSelect = $rows['ctransferCertTitleStatus'];
         $taxDeclarationSelect = $rows['ctaxDeclarationStatus'];
         $taxDeclartionICTCSelect = $rows['ctaxDeclartionICTCStatus'];
         $realStateReceiptSelect = $rows['crealStateReceiptStatus'];
         $realEstateTaxClearanceSelect = $rows['crealEstateTaxClearanceStatus'];
         $cdOfMorgageSelect = $rows['ccdOfMorgageStatus'];
         $copyUpdatedBPSelect = $rows['ccopyUpdatedBPStatus'];
         // BUSINESS PROOF OF INCOME
         $auditedFinancialSelect = $rows['cauditedFinancialStatus'];
         $inhouseFinancialSelect = $rows['cinhouseFinancialStatus'];
         $latestBankSelect = $rows['clatestBankStatus'];
         $incomeTaxReturnSelect = $rows['incomeTaxReturnStatus'];
         $contractLeaseSelect = $rows['contractLeaseStatus'];
         $customerContactSelect = $rows['ccustomerContactStatus'];
         $supplierContactSelect = $rows['csupplierContactStatus'];
         $proofBillingSelect = $rows['cproofBillingStatus'];
         // OTHERS
         $powerAttorneySelect = $rows['powerAttorneyStatus'];
         $contractSellSelect = $rows['contractSellStatus'];
         $letterGuaranteeSelect = $rows['letterGuaranteeStatus'];
         $statementAccountSelect = $rows['statementAccountStatus'];
         $billMaterialsSelect = $rows['billMaterialsStatus'];
         $proposedPlanSelect = $rows['proposedPlanStatus'];
         // DOCUMENTS
         $receiptSelect = $rows['receiptStatus'];
         $creditInvestigationReportCSelect = $rows['creditInvestigationReportCStatus'];
         $collateralAppraisalReportCSelect = $rows['collateralAppraisalReportCStatus'];
         $financialEvaluationCSelect = $rows['financialEvaluationCStatus'];
         $signedLetterCSelect = $rows['signedLetterCStatus'];
         $signedLetterUnderEndCSelect = $rows['signedLetterUnderEndCStatus'];
         $signedLoanMemoCSelect = $rows['signedLoanMemoCStatus'];
         $remContractCSelect = $rows['remContractCStatus'];
         $remContractAnnotatedCSelect = $rows['remContractAnnotatedCStatus'];
         $promNoteCSelect = $rows['promNoteCStatus'];
         $disclosureStateCSelect = $rows['disclosureStateCStatus'];
         $mriFormCSelect = $rows['mriFormCStatus'];
         $amortScheduleCSelect = $rows['amortScheduleCStatus'];
         $remContractEndCSelect = $rows['remContractEndCStatus'];
         $promNoteEndCSelect = $rows['promNoteEndCStatus'];
         $disclosureStateEndCSelect = $rows['disclosureStateEndCStatus'];
         $mriFormEndCSelect = $rows['mriFormEndCStatus'];
         $amortScheduleEndCSelect = $rows['amortScheduleEndCStatus'];
         $signedDeedUnderEndCSelect = $rows['signedDeedUnderEndCStatus'];
         $utilizationSelect=$rows['utilizationStatus'];

         // LETTER
         $cfLetter = $rows['cfLetter'];
         $cfLetter2 = $rows['cfLetter2'];
         $cfLetter3 = $rows['cfLetter3'];
         $csLetter = $rows['csLetter'];
         $csLetter2 = $rows['csLetter2'];
         $csLetter3 = $rows['csLetter3'];
         $ctLetter = $rows['ctLetter'];
         $ctLetter2 = $rows['ctLetter2'];
         $ctLetter3 = $rows['ctLetter3'];
         $cfdLetter = $rows['cfdLetter'];
         $cfdLetter2 = $rows['cfdLetter2'];
         $cfdLetter3 = $rows['cfdLetter3'];
         // OTHER ATTACHMENT
         $cclientReq1 = $rows['cclientReq1'];
         $cclientReq2 = $rows['cclientReq2'];
         $cclientReq3 = $rows['cclientReq3'];

         $cclientReq1Select = $rows['cclientReq1Select'];
         // LETTER STATUS
         $cfLetterSelect = $rows['cfLetterRemarks'];
         $csLetterSelect = $rows['csLetterRemarks'];
         $ctLetterSelect = $rows['ctLetterRemarks'];
         $cfdLetterSelect = $rows['cdfLetterRemarks'];
         // LEGAL
         $cffClosure = $rows['cffClosure'];
         $cpastLitigation = $rows['cpastLitigation'];
         $cpastLitigation2 = $rows['cpastLitigation2'];
         $cttLitigation = $rows['cttLitigation'];
         $cPrepConso = $rows['cPrepConso'];
         $caDemand = $rows['caDemand'];

         // ARCHIVED
         $a_cfLetter = $rows['a_cfLetter'];
         $a_csLetter = $rows['a_csLetter'];
         $a_ctLetter  = $rows['a_ctLetter'];
         $a_cfdLetter = $rows['a_cfdLetter'];

         $a_cfLetter2 = $rows['a_cfLetter2'];
         $a_csLetter2 = $rows['a_csLetter2'];
         $a_ctLetter2 = $rows['a_ctLetter2'];
         $a_cfdLetter2 = $rows['a_cfdLetter2'];
         
         $a_cfLetter3 = $rows['a_cfLetter3'];
         $a_csLetter3 = $rows['a_csLetter3'];
         $a_ctLetter3 = $rows['a_ctLetter3'];
         $a_cfdLetter3 = $rows['a_cfdLetter3'];

         // OTHER ATTACHMENT
         $a_cclientReq1 = $rows['a_cclientReq1'];
         $a_cclientReq2 = $rows['a_cclientReq2'];
         $a_cclientReq3 = $rows['a_cclientReq3'];
         $a_cclientReqRemarks = $rows['a_cclientReqRemarks'];

         $a_cffClosure = $rows['a_cffClosure'];
         $a_cpastLitigation = $rows['a_mpastDueLitigation'];
         $a_cpastLitigation2 = $rows['a_mpastDueLitigation'];
         $a_cttLitigation = $rows['a_mtransferLitigation'];
         $a_cPrepConso = $rows['a_cPrepConso'];
         $a_caDemand = $rows['a_caDemand'];

         // LEGAL REMARKS
         $cttClosureRemarks = $rows['cttClosureRemarks'];
         $cpastLitigationSelect = $rows['cpastLitigationRemarks'];
         $cttLitigationSelect = $rows['cttLitigationRemarks'];
         $cPrepConsoSelect = $rows['cPrepConsoRemarks	'];
         $cdDemandRemarks = $rows['cdDemandRemarks'];

         $powerAttorneyICheck = $rows['powerAttorneyICheck'];
         $contractSellCheck = $rows['contractSellCheck'];
         $letterGuaranteeCheck = $rows['letterGuaranteeCheck'];
         $statementAccountCheck = $rows['statementAccountCheck'];
         $billMaterialsCheck = $rows['billMaterialsCheck'];
         $proposedPlanCheck = $rows['proposedPlanCheck'];

         $cpastCheck = $rows['cpastCheck'];
         $a_cpastCheck = $rows['a_cpastCheck'];
         
         
         }
         
         // Check If there is a File and File upload button gone and check image visible
         // PRINCIPAL BORROWER
         setFileVisibility($endorsement, "endorsement", "endorsementImage", 'endorsementButton', $endorsementSelect,"endorsementDate");
         setFileVisibility($loanAppFormC, "loanAppFormC", "loanAppFormCImage", 'loanAppFormCButton', $loanAppFormCSelect,"loanAppFormCDate");
         setFileVisibility($companyProfile, "companyProfile", "companyProfileImage", 'companyProfileButton', $companyProfileSelect,"companyProfileDate");
         setFileVisibility($governmentId, "governmentId", "governmentIdImage", 'governmentIdButton', $governmentIdSelect,"governmentIdDate");
         setFileVisibility($secRegistration, "secRegistration", "secRegistrationImage", 'secRegistrationButton', $secRegistrationSelect,"secRegistrationDate");
         setFileVisibility($latestGIS, "latestGIS", "latestGISImage", 'latestGISButton', $latestGISSelect,"latestGISDate");
         setFileVisibility($copyBRS, "copyBRS", "copyBRSImage", 'copyBRSButton', $copyBRSSelect,"copyBRSDate");
         setFileVisibility($copyidCST, "copyidCST", "copyidCSTImage", 'copyidCSTButton', $copyidCSTSelect,"copyidCSTDate");
         // COLLATERAL DOCUMENTS
         setFileVisibility($transferCertTitle, "transferCertTitle", "transferCertTitleImage", 'transferCertTitleButton', $transferCertTitleSelect,"transferCertTitleDate");
         setFileVisibility($taxDeclaration, "taxDeclaration", "taxDeclarationImage", 'taxDeclarationButton', $taxDeclarationSelect,"taxDeclarationDate");
         setFileVisibility($taxDeclartionICTC, "taxDeclartionICTC", "taxDeclartionICTCImage", 'taxDeclartionICTCButton', $taxDeclartionICTCSelect,"taxDeclartionICTCDate");
         setFileVisibility($realStateReceipt, "realStateReceipt", "realStateReceiptImage", 'realStateReceiptButton', $realStateReceiptSelect,"realStateReceiptDate");
         setFileVisibility($realEstateTaxClearance, "realEstateTaxClearance", "realEstateTaxClearanceImage", 'realEstateTaxClearanceButton', $realEstateTaxClearanceSelect,"realEstateTaxClearanceDate");
         setFileVisibility($cdOfMorgage, "cdOfMorgage", "cdOfMorgageImage", 'cdOfMorgageButton', $cdOfMorgageSelect,"cdOfMorgageDate");
         // BUSINESS PROOF OF INCOME
         setFileVisibility($copyUpdatedBP, "copyUpdatedBP", "copyUpdatedBPImage", 'copyUpdatedBPButton', $copyUpdatedBPSelect,"copyUpdatedBPDate");
         setFileVisibility($auditedFinancial, "auditedFinancial", "auditedFinancialImage", 'auditedFinancialButton', $auditedFinancialSelect,"auditedFinancialDate");
         setFileVisibility($inhouseFinancial, "inhouseFinancial", "inhouseFinancialImage", 'inhouseFinancialButton', $inhouseFinancialSelect,"inhouseFinancialDate");
         setFileVisibility($latestBank, "latestBank", "latestBankImage", 'latestBankButton', $latestBankSelect,"latestBankDate");
         setFileVisibility($incomeTaxReturn, "incomeTaxReturn", "incomeTaxReturnImage", 'incomeTaxReturnButton', $incomeTaxReturnSelect,"incomeTaxReturnDate");
         setFileVisibility($contractLease, "contractLease", "contractLeaseImage", 'contractLeaseButton', $contractLeaseSelect,"contractLeaseDate");
         setFileVisibility($customerContact, "customerContact", "customerContactImage", 'customerContactButton', $customerContactSelect,"customerContactDate");
         setFileVisibility($supplierContact, "supplierContact", "supplierContactImage", 'supplierContactButton', $supplierContactSelect,"supplierContactDate");
         setFileVisibility($proofBilling, "proofBilling", "proofBillingImage", 'proofBillingButton', $proofBillingSelect,"proofBillingDate");
         setFileVisibility($sourceIncome, "sourceIncome", "sourceIncomeImage", 'sourceIncomeButton', $sourceIncomeSelect,"sourceIncomeDate");
         // OTHERS
         setFileVisibility($powerAttorney, "powerAttorney", "powerAttorneyImage", 'powerAttorneyButton', $powerAttorneySelect,"powerAttorneyDate");
         setFileVisibility($contractSell, "contractSell", "contractSellImage", 'contractSellButton', $contractSellSelect,"contractSellDate");
         setFileVisibility($letterGuarantee, "letterGuarantee", "letterGuaranteeImage", 'letterGuaranteeButton', $letterGuaranteeSelect,"letterGuaranteeDate");
         setFileVisibility($statementAccount, "statementAccount", "statementAccountImage", 'statementAccountButton', $statementAccountSelect,"statementAccountDate");
         setFileVisibility($billMaterials, "billMaterials", "billMaterialsImage", 'billMaterialsButton', $billMaterialsSelect,"billMaterialsDate");
         setFileVisibility($proposedPlan, "proposedPlan", "proposedPlanImage", 'proposedPlanButton', $proposedPlanSelect,"proposedPlanDate");
         // DOCUMENTS
         setFileVisibility($receipt, "receipt", "receiptImage", 'receiptButton', $receiptSelect,"receiptDate");
         setFileVisibility($creditInvestigationReportC, "creditInvestigationReportC", "creditInvestigationReportCImage", 'creditInvestigationReportCButton', $creditInvestigationReportCSelect,"creditInvestigationReportCDate");
         setFileVisibility($collateralAppraisalReportC, "collateralAppraisalReportC", "collateralAppraisalReportCImage", 'collateralAppraisalReportCButton', $collateralAppraisalReportCSelect,"collateralAppraisalReportCDate");
         setFileVisibility($financialEvaluationC, "financialEvaluationC", "financialEvaluationCImage", 'financialEvaluationCButton', $financialEvaluationCSelect,"financialEvaluationCDate");
         setFileVisibility($signedLetterC, "signedLetterC", "signedLetterCImage", 'signedLetterCButton', $signedLetterCSelect,"signedLetterCDate");
         setFileVisibility($signedLetterUnderEndC, "signedLetterUnderEndC", "signedLetterUnderEndCImage", 'signedLetterUnderEndCButton', $signedLetterUnderEndCSelect,"signedLetterUnderEndCDate");
         setFileVisibility($signedLoanMemoC, "signedLoanMemoC", "signedLoanMemoCImage", 'signedLoanMemoCButton', $signedLoanMemoCSelect,"signedLoanMemoCDate");
         setFileVisibility($remContractC, "remContractC", "remContractCImage", 'remContractCButton', $remContractCSelect,"remContractCDate");
         setFileVisibility($remContractAnnotatedC, "remContractAnnotatedC", "remContractAnnotatedCImage", 'remContractAnnotatedCButton', $remContractAnnotatedCSelect,"remContractAnnotatedCDate");
         setFileVisibility($promNoteC, "promNoteC", "promNoteCImage", 'promNoteCButton', $promNoteCSelect,"promNoteCDate");
         setFileVisibility($disclosureStateC, "disclosureStateC", "disclosureStateCImage", 'disclosureStateCButton', $disclosureStateCSelect,"disclosureStateCDate");
         setFileVisibility($mriFormC, "mriFormC", "mriFormCImage", 'mriFormCButton', $mriFormCSelect,"mriFormCDate");
         setFileVisibility($amortScheduleC, "amortScheduleC", "amortScheduleCImage", 'amortScheduleCButton', $amortScheduleCSelect,"amortScheduleCDate");
         setFileVisibility($remContractEndC, "remContractEndC", "remContractEndCImage", 'remContractEndCButton', $remContractEndCSelect,"remContractEndCDate");
         setFileVisibility($promNoteEndC, "promNoteEndC", "promNoteEndCImage", 'promNoteEndCButton', $promNoteEndCSelect,"promNoteEndCDate");
         setFileVisibility($disclosureStateEndC, "disclosureStateEndC", "disclosureStateEndCImage", 'disclosureStateEndCButton', $disclosureStateEndCSelect,"disclosureStateEndCDate");
         setFileVisibility($mriFormEndC, "mriFormEndC", "mriFormEndCImage", 'mriFormEndCButton', $mriFormEndCSelect,"mriFormEndCDate");
         setFileVisibility($amortScheduleEndC, "amortScheduleEndC", "amortScheduleEndCImage", 'amortScheduleEndCButton', $amortScheduleEndCSelect,"amortScheduleEndCDate");
         setFileVisibility($signedDeedUnderEndC, "signedDeedUnderEndC", "signedDeedUnderEndCImage", 'signedDeedUnderEndCButton', $signedDeedUnderEndCSelect,"signedDeedUnderEndCDate");
         setFileVisibility($utilization, "utilization", "utilizationImage", 'utilizationButton', $utilizationSelect,"utilizationDate");
         setFileVisibility($excel, "excel", "excelImage", "excelButton", "","excelDate");
         setFileVisibility($powerpoint, "powerpoint", "powerpointImage", "powerpointButton", "","powerpointDate");
         // LETTER
         setFileVisibility($cfLetter, "forcfLetter", "cfLetterImage", 'cfLetterButton', $cfLetterSelect,"cfLetterDate");
         setFileVisibility($csLetter, "forcsLetter", "csLetterImage", 'csLetterButton', $csLetterSelect,"csLetterDate");
         setFileVisibility($ctLetter, "forctLetter", "ctLetterImage", 'ctLetterButton', $ctLetterSelect,"ctLetterDate");
         setFileVisibility($cfdLetter, "forcfdLetter", "cfdLetterImage", 'cfdLetterButton', $cfdLetterSelect,"cfdLetterDate");
         // LETTER 2
         setFileVisibility($cfLetter2, "forcfLetter2", "cfLetter2Image", "cfLetter2Button", "" , "");
         setFileVisibility($csLetter2, "forcsLetter2", "csLetter2Image", "csLetter2Button", "" , "");
         setFileVisibility($ctLetter2, "forctLetter2", "ctLetter2Image", "ctLetter2Button", "" , "");
         setFileVisibility($cfdLetter2, "forcfdLetter2", "cfdLetter2Image", "cfdLetter2Button", "" , "");
         // LETTER 3
         setFileVisibility($cfLetter3, "forcfLetter3", "cfLetter3Image", "cfLetter3Button", "" , "");
         setFileVisibility($csLetter3, "forcsLetter3", "csLetter3Image", "csLetter3Button", "" , "");
         setFileVisibility($ctLetter3, "forctLetter3", "ctLetter3Image", "ctLetter3Button", "" , "");
         setFileVisibility($cfdLetter3, "forcfdLetter3", "cfdLetter3Image", "cfdLetter3Button", "" , "");
         // OTHER ATTACHMENT
         setFileVisibility($cclientReq1, "forcclientReq1", "cclientReq1Image", "cclientReq1Button", $cclientReq1Select, "cclientReq1Date");
         setFileVisibility($cclientReq2, "forcclientReq2", "cclientReq2Image", "cclientReq2Button", "", "");
         setFileVisibility($cclientReq3, "forcclientReq3", "cclientReq3Image", "cclientReq3Button", "", "");
         // LEGAL
         setFileVisibility($cffClosure, "forcffClosure", "cffClosureImage", 'cffClosureButton', $cttClosureRemarks,"cffClosureDate");
         setFileVisibility($cpastLitigation, "forcpastLitigation", "cpastLitigationImage", 'cpastLitigationButton', $cpastLitigationSelect,"cpastLitigationDate");
         setFileVisibility($cpastLitigation2, "forcpastLitigation2", "cpastLitigation2Image", 'cpastLitigation2Button', "", "");
         setFileVisibility($cttLitigation, "forcttLitigation", "cttLitigationImage", 'cttLitigationButton', $cttLitigationSelect,"cttLitigationDate");
         setFileVisibility($cPrepConso, "forcPrepConso", "cPrepConsoImage", 'cPrepConsoButton', $cPrepConsoSelect,"cPrepConsoDate");
         setFileVisibility($caDemand, "forcaDemand", "caDemandImage", 'caDemandButton', $cdDemandRemarks,"caDemandDate");

         
         // CALCULATION OF PERCENTAGE
         $requirements = array( $loanAppFormCSelect, $companyProfileSelect, $governmentIdSelect,
         $secRegistrationSelect, $latestGISSelect, $copyBRSSelect, $copyidCSTSelect, $transferCertTitleSelect, $taxDeclarationSelect, $taxDeclartionICTCSelect,
         $realStateReceiptSelect, $realEstateTaxClearanceSelect, $copyUpdatedBPSelect, $auditedFinancialSelect, $inhouseFinancialSelect, $latestBankSelect,
         $contractLeaseSelect, $customerContactSelect, $supplierContactSelect, $creditInvestigationReportCSelect, $collateralAppraisalReportCSelect,
         $financialEvaluationCSelect, $signedLetterCSelect, $signedLoanMemoCSelect,$signedDeedUnderEndCSelect
         );
         $endBuyerDocuments=array($signedLetterUnderEndCSelect, $remContractEndCSelect,  $promNoteEndCSelect, 
         $disclosureStateEndCSelect,  $mriFormEndCSelect, $signedDeedUnderEndCSelect);
         
         $notEndBuyerDocuments=array($remContractCSelect,  $remContractAnnotatedCSelect,  $promNoteCSelect,
         $disclosureStateCSelect,  $mriFormCSelect,  $amortScheduleCSelect);
         
         
         if($remType=="End Buyer"){
         $numberOfFilesUploaded = array_merge($requirements, $endBuyerDocuments);
         
         }
         else{
         $numberOfFilesUploaded = array_merge($requirements, $notEndBuyerDocuments);
         }
         
            // Filter out empty values from the array
           // Max Number Of Overall File Base on Condition
           $maxCount=count($numberOfFilesUploaded);

           $nonEmptyFileInputs = array_filter($numberOfFilesUploaded,function($value) {
            $parts = explode("--", $value);
            return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
        });;
           // Count the number of non-empty values
           $numberOfFilesUploaded = count($nonEmptyFileInputs);
           
           // Calculate the percentage
           $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         
         ?>
      <div class="container py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><strong><?php echo "$fullname &nbsp; $birth &nbsp; $loanType &nbsp; $type &nbsp; $remType"; ?></strong></h3></label>
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
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab3" href="#corporation">Real Estate Mortgage - Corporation</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual">Real Estate Mortgage - Individual</a>
                     </li>
                  </ul>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="corporation" class="tab-pane active" style="border: 1px solid #ccc;">
                              <form id="corporation-form" action="loanCorporationUploadData.php" method="POST" enctype="multipart/form-data">
                                 <div id="nextbankSection" style="position: absolute; top: 0; right: 0; margin-right: 4.4em;">
                                    <div class="form">
                                          <input hidden type="text" class="form-control" id="productID" name="productID" style="width: 25em; height: 4em; display: inline-block; font-size: 1.1em; font-weight: bold; " value="<?php echo $duecProdID; ?>" placeholder="NEXTBANK PRODUCT ID" tabindex="-1">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 my-4"><br>
                                    <div class="row">
                                       <div class="col-8" style="border-right:0;">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">REQUIREMENTS</h1>
                                       </div>
                                       <div class="col-4">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 107%;">APPROVAL</h1>
                                       </div>
                                       </div>
                                       <div class="corporation-tabs" style=" border-right: 1px solid #ccc; min-height: 120.3%; margin-top:-0.5%;">
                                          <!-- Requirements Form -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>PRINCIPAL BORROWER</u></label></div>
                                             </div>
                                          </div>
                                        <!-- ENDORSEMENT/RECOMMENDATION LETTER -->
                                        <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> ENDORSEMENT LETTER</label>
                                                   <input type="file" id="endorsement" name="endorsement"><img id="endorsementImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $endorsement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="endorsementButton">Open File</button></a>
                                                   <label class="date-label" id="endorsementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($endorsement, strrpos($endorsement, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="endorsementSelect" name= "endorsementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="endorsementDesc" name = "endorsementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" > &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- LOAN APPLICATION FORM -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> LOAN APPLICATION FORM</label>
                                                   <input type="file" id="loanAppFormC" name="loanAppFormC"><img id="loanAppFormCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppFormC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormCButton">Open File</button></a>
                                                   <label class="date-label" id="loanAppFormCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormC, strrpos($loanAppFormC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="loanAppFormCSelect" name= "loanAppFormCSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppFormCDesc" name = "loanAppFormCDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" > &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- COMPANY PROFILE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> COMPANY PROFILE</label>
                                                   <input type="file" id="companyProfile" name="companyProfile"><img id="companyProfileImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $companyProfile; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="companyProfileButton">Open File</button></a>
                                                   <label class="date-label" id="companyProfileDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($companyProfile, strrpos($companyProfile, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="companyProfileSelect" name="companyProfileSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="companyProfileDesc" name="companyProfileDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED ID OF REPRESENTATIVE OF LOAN WITH 3 SIGNATURES</label>
                                                   <input type="file" id="governmentId" name="governmentId"><img id="governmentIdImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $governmentId; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="governmentIdButton">Open File</button></a>
                                                   <label class="date-label" id="governmentIdDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($governmentId, strrpos($governmentId, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="governmentIdSelect" name="governmentIdSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="governmentIdDesc" name="governmentIdDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND <br> BY-LAWS </label>
                                                   <input type="file" id="secRegistration" name="secRegistration"><img id="secRegistrationImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $secRegistration; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="secRegistrationButton">Open File</button></a>
                                                   <label class="date-label" id="secRegistrationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($secRegistration, strrpos($secRegistration, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="secRegistrationSelect" name="secRegistrationSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="secRegistrationDesc" name="secRegistrationDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GSIS) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GIS)</label>
                                                   <input type="file" id="latestGIS" name="latestGIS"><img id="latestGISImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $latestGIS; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestGISButton">Open File</button></a>
                                                   <label class="date-label" id="latestGISDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestGIS, strrpos($latestGIS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="latestGISSelect" name="latestGISSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="latestGISDesc" name="latestGISDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE </label>
                                                   <input type="file" id="copyBRS" name="copyBRS"><img id="copyBRSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyBRS; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyBRSButton">Open File</button></a>
                                                   <label class="date-label" id="copyBRSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyBRS, strrpos($copyBRS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyBRSSelect" name="copyBRSSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyBRSDesc" name="copyBRSDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES</label>
                                                   <input type="file" id="copyidCST" name="copyidCST"><img id="copyidCSTImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyidCST; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyidCSTButton">Open File</button></a>
                                                   <label class="date-label" id="copyidCSTDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyidCST, strrpos($copyidCST, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyidCSTSelect" name="copyidCSTSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyidCSTDesc" name="copyidCSTDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>COLLATERAL DOCUMENTS</u> </label></div>
                                             </div>
                                          </div>
                                          <!-- TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">TRANSFER CERTIFICATE TITLE <br> (ORIGINAL & CERTIFIED TRUE COPY) </label>
                                                   <input type="file" id="transferCertTitle" name="transferCertTitle"><img id="transferCertTitleImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $transferCertTitle; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="transferCertTitleButton">Open File</button></a>
                                                   <label class="date-label" id="transferCertTitleDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($transferCertTitle, strrpos($transferCertTitle, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="transferCertTitleSelect" name="transferCertTitleSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="transferCertTitleDesc" name="transferCertTitleDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- TAX DECLARTION (LOT-CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">TAX DECLARTION <br> (LOT-CERTIFIED TRUE COPY) </label>
                                                   <input type="file" id="taxDeclaration" name="taxDeclaration"><img id="taxDeclarationImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $taxDeclaration; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationButton">Open File</button></a>
                                                   <label class="date-label" id="taxDeclarationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclaration, strrpos($taxDeclaration, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclarationSelect" name="taxDeclarationSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationDesc" name="taxDeclarationDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY) </label>
                                                   <input type="file" id="taxDeclartionICTC" name="taxDeclartionICTC"><img id="taxDeclartionICTCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $taxDeclartionICTC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclartionICTCButton">Open File</button></a>
                                                   <label class="date-label" id="taxDeclartionICTCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclartionICTC, strrpos($taxDeclartionICTC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclartionICTCSelect" name="taxDeclartionICTCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclartionICTCDesc" name="taxDeclartionICTCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!--REAL ESTATE RECEIPT (AMILYAR) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">REAL ESTATE RECEIPT (AMILYAR) </label>
                                                   <input type="file" id="realStateReceipt" name="realStateReceipt"><img id="realStateReceiptImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $realStateReceipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realStateReceiptButton">Open File</button></a>
                                                   <label class="date-label" id="realStateReceiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realStateReceipt, strrpos($realStateReceipt, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="realStateReceiptSelect" name="realStateReceiptSelect" tabindex="-1">
                                                      <option selected value="NULL">Options</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS" id="realStateReceiptDesc" name="realStateReceiptDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- REAL ESTATE TAX CLEARANCE-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">REAL ESTATE TAX CLEARANCE </label>
                                                   <input type="file" id="realEstateTaxClearance" name="realEstateTaxClearance"><img id="realEstateTaxClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $realEstateTaxClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxClearanceButton">Open File</button></a>
                                                   <label class="date-label" id="realEstateTaxClearanceDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxClearance, strrpos($realEstateTaxClearance, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="realEstateTaxClearanceSelect" name="realEstateTaxClearanceSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="realEstateTaxClearanceDesc" name="realEstateTaxClearanceDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE) </label>
                                                   <input type="file" id="cdOfMorgage" name="cdOfMorgage"><img id="cdOfMorgageImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $cdOfMorgage; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cdOfMorgageButton">Open File</button></a>
                                                   <label class="date-label" id="cdOfMorgageDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cdOfMorgage, strrpos($cdOfMorgage, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="cdOfMorgageSelect" name="cdOfMorgageSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cdOfMorgageDesc" name="cdOfMorgageDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>BUSINESS PROOF OF INCOME</u> </label></div>
                                             </div>
                                          </div>
                                           <!-- UPDATED BUSINESS PERMIT PERMIT (MAYOR'S, BARANGAY AND/OR DTI)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">UPDATED BUSINESS PERMIT PERMIT (MAYOR'S, BARANGAY AND/OR DTI)</label>
                                                   <input type="file" id="copyUpdatedBP" name="copyUpdatedBP"><img id="copyUpdatedBPImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyUpdatedBP; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyUpdatedBPButton">Open File</button></a>
                                                   <label class="date-label" id="copyUpdatedBPDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyUpdatedBP, strrpos($copyUpdatedBP, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyUpdatedBPSelect" name="copyUpdatedBPSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyUpdatedBPDesc" name="copyUpdatedBPDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT </label>
                                                   <input type="file" id="auditedFinancial" name="auditedFinancial"><img id="auditedFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $auditedFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="auditedFinancialButton">Open File</button></a>
                                                   <label class="date-label" id="auditedFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($auditedFinancial, strrpos($auditedFinancial, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="auditedFinancialSelect" name="auditedFinancialSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="auditedFinancialDesc" name="auditedFinancialDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT </label>
                                                   <input type="file" id="inhouseFinancial" name="inhouseFinancial"><img id="inhouseFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $inhouseFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="inhouseFinancialButton">Open File</button></a>
                                                   <label class="date-label" id="inhouseFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($inhouseFinancial, strrpos($inhouseFinancial, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="inhouseFinancialSelect" name="inhouseFinancialSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="inhouseFinancialDesc" name="inhouseFinancialDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF AT LEAST 6 MONTHS LATEST BANK STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> PHOTOCOPY OF AT LEAST 6 MONTHS OF BUSINESS LATEST BANK STATEMENT </label>
                                                   <input type="file" id="latestBank" name="latestBank"><img id="latestBankImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $latestBank; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestBankButton">Open File</button></a>
                                                   <label class="date-label" id="latestBankDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestBank, strrpos($latestBank, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="latestBankSelect" name="latestBankSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="latestBankDesc" name="latestBankDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--INCOME TAX RETURN (IF APPLICABLE)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">INCOME TAX RETURN (IF APPLICABLE)</label>
                                                   <input type="file" id="incomeTaxReturn" name="incomeTaxReturn"><img id="incomeTaxReturnImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $incomeTaxReturn; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxReturnButton">Open File</button></a>
                                                   <label class="date-label" id="incomeTaxReturnDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTaxReturn, strrpos($incomeTaxReturn, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="incomeTaxReturnSelect" name="incomeTaxReturnSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxReturnDesc" name="incomeTaxReturnDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--CONTRACT OF LEASE (IF RENTAL BUSINESS)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">CONTRACT OF LEASE</label>
                                                   <input type="file" id="contractLease" name="contractLease"><img id="contractLeaseImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $contractLease; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractLeaseButton">Open File</button></a>
                                                   <label class="date-label" id="contractLeaseDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractLease, strrpos($contractLease, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="contractLeaseSelect" name="contractLeaseSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractLeaseDesc" name="contractLeaseDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- 5 CUSTOMERS WITH CONTACT NUMBER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">5 CUSTOMERS WITH CONTACT NUMBER </label>
                                                   <input type="file" id="customerContact" name="customerContact"><img id="customerContactImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $customerContact; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerContactButton">Open File</button></a>
                                                   <label class="date-label" id="customerContactDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerContact, strrpos($customerContact, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="customerContactSelect" name="customerContactSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerContactDesc" name="customerContactDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 5 SUPPLIERS WITH CONTACT NUMBER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> 5 SUPPLIERS WITH CONTACT NUMBER </label>
                                                   <input type="file" id="supplierContact" name="supplierContact"><img id="supplierContactImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $supplierContact; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="supplierContactButton">Open File</button></a>
                                                   <label class="date-label" id="supplierContactDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($supplierContact, strrpos($supplierContact, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="supplierContactSelect" name="supplierContactSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="supplierContactDesc" name="supplierContactDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PROOF OF BILLING (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PROOF OF BILLING (IF APPLICABLE) </label>
                                                   <input type="file" id="proofBilling" name="proofBilling"><img id="proofBillingImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $proofBilling; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofBillingButton">Open File</button></a>
                                                   <label class="date-label" id="proofBillingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="proofBillingSelect" name="proofBillingSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proofBillingDesc" name="proofBillingDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>

                                          <!-- FOR SPACE -->
                                          <div class="row">
                                             <div class="col-8"  style="height:2em; margin-bottom:-2%;"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 my-4"><br>
                                    <div class="row">
                                     <div class="col-8" style="border-right:0;">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">DOCUMENTS</h1>
                                       </div>
                                       <div class="col-4">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 100%;">APPROVAL</h1>
                                       </div>
                                       </div>
                                       <div class="document-labels">
                                          <!-- FOR SPACE -->
                                          <div class="row">
                                             <div class="col-8" style="height:1em; margin-top:-0.5%"></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"><label style="font-size:120%"><u>DOCUMENT REPORTS AND CASHFLOW ANALYSIS</u></label></div>
                                             </div>
                                          </div>
                                       <!-- APPRAISAL FEE RECEIPT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">APPRAISAL FEE RECEIPT</label>
                                                   <input type="file" id="receipt" name="receipt"><img id="receiptImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $receipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="receiptButton">Open File</button></a>
                                                   <label class="date-label" id="receiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($receipt, strrpos($receipt, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="receiptSelect" name="receiptSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="receiptDesc" name="receiptDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT</label>
                                                   <input type="file" id="creditInvestigationReportC" name="creditInvestigationReportC"><img id="creditInvestigationReportCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $creditInvestigationReportC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportCButton">Open File</button></a>
                                                   <label class="date-label" id="creditInvestigationReportCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportC, strrpos($creditInvestigationReportC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4 ">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="creditInvestigationReportCSelect" name="creditInvestigationReportCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="creditInvestigationReportCDesc" name="creditInvestigationReportCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT</label>
                                                   <input type="file" id="collateralAppraisalReportC" name="collateralAppraisalReportC"><img id="collateralAppraisalReportCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $collateralAppraisalReportC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="collateralAppraisalReportCButton">Open File</button></a>
                                                   <label class="date-label" id="collateralAppraisalReportCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($collateralAppraisalReportC, strrpos($collateralAppraisalReportC, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4 ">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="collateralAppraisalReportCSelect" name="collateralAppraisalReportCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="collateralAppraisalReportCDesc" name="collateralAppraisalReportCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREBOARD  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREBOARD</label>
                                                   <input type="file" id="financialEvaluationC" name="financialEvaluationC"><img id="financialEvaluationCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $financialEvaluationC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="financialEvaluationCButton">Open File</button></a>
                                                   <label class="date-label" id="financialEvaluationCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($financialEvaluationC, strrpos($financialEvaluationC, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="financialEvaluationCSelect" name="financialEvaluationCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="financialEvaluationCDesc" name="financialEvaluationCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>SIGNING OF APPROVAL</u> </label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LETTER OF APPROVAL -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                <label class="corporation-label">&#x2022; SIGNED LETTER OF APPROVAL </label>
                                                <input type="file" id="signedLetterC" name="signedLetterC"><img id="signedLetterCImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $signedLetterC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterCButton">Open File</button></a>
                                                <label class="date-label" id="signedLetterCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterC, strrpos($signedLetterC, '/') + 1, 10); ?></label>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLetterCSelect" name="signedLetterCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterCDesc" name="signedLetterCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="endBuyerUnder" id="endBuyerUnder" style="display:none">
                                           <!-- SIGNED LETTER OF UNDERTAKING -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2 mt-3">
                                                      <label class="corporation-label">&#x2022; SIGNED LETTER OF UNDERTAKING </label>
                                                      <input type="file" id="signedLetterUnderEndC" name="signedLetterUnderEndC"><img id="signedLetterUnderEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedLetterUnderEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterUnderEndCButton">Open File</button></a>
                                                      <label class="date-label" id="signedLetterUnderEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterUnderEndC, strrpos($signedLetterUnderEndC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-3 mt-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLetterUnderEndCSelect" name="signedLetterUnderEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterUnderEndCDesc" name="signedLetterUnderEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>SIGNING OF THE LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE</u> </label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2 mb-2">
                                                   <label class="corporation-label">&#x2022; SIGNED LOAN APPROVAL MEMO </label>
                                                   <input type="file" id="signedLoanMemoC" name="signedLoanMemoC"><img id="signedLoanMemoCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLoanMemoC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLoanMemoCButton">Open File</button></a>
                                                   <label class="date-label" id="signedLoanMemoCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLoanMemoC, strrpos($signedLoanMemoC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLoanMemoCSelect" name="signedLoanMemoCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLoanMemoCDesc" name="signedLoanMemoCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- Not End Buyer Section -->
                                          <div class="notEndBuyer" id="notEndBuyer" style="display:none;">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>SIGNING OF REM CONTRACT</u> </label></div>
                                                </div>
                                             </div>
                                              <!-- SIGNED REAL ESTATE MORTGAGE CONTRACT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; SIGNED REAL ESTATE MORTGAGE CONTRACT </label>
                                                      <input type="file" id="remContractC" name="remContractC"><img id="remContractCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractCButton">Open File</button></a>
                                                      <label class="date-label" id="remContractCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractC, strrpos($remContractC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractCSelect" name="remContractCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractCDesc" name="remContractCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>REGISTRATION IN REGISTRY OF DEEDS</u> </label></div>
                                                </div>
                                             </div>
                                             <!-- REM CONTRACT ANNOTATED -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; REM CONTRACT ANNOTATED</label>
                                                      <input type="file" id="remContractAnnotatedC" name="remContractAnnotatedC"><img id="remContractAnnotatedCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractAnnotatedC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractAnnotatedCButton">Open File</button></a>
                                                      <label class="date-label" id="remContractAnnotatedCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractAnnotatedC, strrpos($remContractAnnotatedC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-1">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractAnnotatedCSelect" name="remContractAnnotatedCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractAnnotatedCDesc" name="remContractAnnotatedCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>DOCUMENTS AFTER THE RELEASE OF THE LOAN</u> </label></div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; PROMISSORY NOTE </label>
                                                      <input type="file" id="promNoteC" name="promNoteC"><img id="promNoteCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteCButton">Open File</button></a>
                                                      <label class="date-label" id="promNoteCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteC, strrpos($promNoteC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="promNoteCSelect" name="promNoteCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteCDesc" name="promNoteCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; DISCLOSURE STATEMENT </label>
                                                      <input type="file" id="disclosureStateC" name="disclosureStateC"><img id="disclosureStateCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateCButton">Open File</button></a>
                                                      <label class="date-label" id="disclosureStateCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateC, strrpos($disclosureStateC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="disclosureStateCSelect" name="disclosureStateCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateCDesc" name="disclosureStateCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- MRI FORM (COUNTRY BANKERS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; INSURANCE DOCUMENTS </label>
                                                      <input type="file" id="mriFormC" name="mriFormC"><img id="mriFormCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormCButton">Open File</button></a>
                                                      <label class="date-label" id="mriFormCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormC, strrpos($mriFormC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="mriFormCSelect" name="mriFormCSelect" tabindex="-1">
                                                         <option selected value="NULL">Options</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS" id="mriFormCDesc" name="mriFormCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; AMORTIZATION SCHEDULE </label>
                                                      <input type="file" id="amortScheduleC" name="amortScheduleC"><img id="amortScheduleCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleCButton">Open File</button></a>
                                                      <label class="date-label" id="amortScheduleCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleC, strrpos($amortScheduleC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="amortScheduleCSelect" name="amortScheduleCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="amortScheduleCDesc" name="amortScheduleCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="endBuyer" id="endBuyer" style="display:none;">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>SIGNING OF REM CONTRACT AND DOCUMENTS FOR LOAN RELEASES</u> </label></div>
                                                </div>
                                             </div>
                                              <!-- REAL ESTATE MORTGAGE CONTRACT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; REAL ESTATE MORTGAGE CONTRACT </label>
                                                      <input type="file" id="remContractEndC" name="remContractEndC"><img id="remContractEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractEndCButton">Open File</button></a>
                                                      <label class="date-label" id="remContractEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractEndC, strrpos($remContractEndC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractEndCSelect" name="remContractEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractEndCDesc" name="remContractEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; PROMISSORY NOTE </label>
                                                      <input type="file" id="promNoteEndC" name="promNoteEndC"><img id="promNoteEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteEndCButton">Open File</button></a>
                                                      <label class="date-label" id="promNoteEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteEndC, strrpos($promNoteEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="promNoteEndCSelect" name="promNoteEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteEndCDesc" name="promNoteEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; DISCLOSURE STATEMENT</label>
                                                      <input type="file" id="disclosureStateEndC" name="disclosureStateEndC"><img id="disclosureStateEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateEndCButton">Open File</button></a>
                                                      <label class="date-label" id="disclosureStateEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateEndC, strrpos($disclosureStateEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="disclosureStateEndCSelect" name="disclosureStateEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateEndCDesc" name="disclosureStateEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- INSURANCE DOCUMENTS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; INSURANCE DOCUMENTS </label>
                                                      <input type="file" id="mriFormEndC" name="mriFormEndC"><img id="mriFormEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormEndCButton">Open File</button></a>
                                                      <label class="date-label" id="mriFormEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormEndC, strrpos($mriFormEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="mriFormEndCSelect" name="mriFormEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormEndCDesc" name="mriFormEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; AMORTIZATION SCHEDULE </label>
                                                      <input type="file" id="amortScheduleEndC" name="amortScheduleEndC"><img id="amortScheduleEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleEndCButton">Open File</button></a>
                                                      <label class="date-label" id="amortScheduleEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleEndC, strrpos($amortScheduleEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="amortScheduleEndCSelect" name="amortScheduleEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleEndCDesc" name="amortScheduleEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- End buyer Section -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF DOCUMENTS TO SUNTRUST PROPERTIES INC. EXCHANGING TO DEED OF UNDERTAKING</u> </label></div>
                                                </div>
                                             </div>
                                              <!-- SIGNED DEED OF UNDERTAKING -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div>
                                                      <label class="corporation-label">&#x2022; SIGNED DEED OF UNDERTAKING </label>
                                                      <input type="file" id="signedDeedUnderEndC" name="signedDeedUnderEndC"><img id="signedDeedUnderEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedDeedUnderEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedDeedUnderEndCButton">Open File</button></a>
                                                      <label class="date-label" id="signedDeedUnderEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedDeedUnderEndC, strrpos($signedDeedUnderEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedDeedUnderEndCSelect" name="signedDeedUnderEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedDeedUnderEndCDesc" name="signedDeedUnderEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><u>LOAN UTILIZATION REPORT</u></label></div>
                                              </div>
                                           </div>
                                           <!-- LOAN UTILIZATION REPORT-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="corporation-label">&#x2022; LOAN UTILIZATION</label>
                                                      <input type="file" id="utilization" name="utilization"><img id="utilizationImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $utilization; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="utilizationButton">Open File</button></a>
                                                      <label class="date-label" id="utilizationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($utilization, strrpos($utilization, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select id="utilizationSelect" name= "utilizationSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;
                                                      <input type="text" id="utilizationDesc" name = "utilizationDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                              <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><u>PRESENTATION DOCUMENTS</u></label></div>
                                              </div>
                                           </div>
                                           <!-- POWERPOINT CI AND APPRAISAL REPORT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="corporation-label">&#x2022; POWERPOINT CI AND <br> &nbsp; APPRAISAL REPORT</label>
                                                      <input type="file" id="powerpoint" name="powerpoint"><img id="powerpointImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $powerpoint; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="powerpointButton">Open File</button></a>
                                                      <label class="date-label" id="powerpointDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerpoint, strrpos($powerpoint, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- EXCEL CASHFLOW ANALYSIS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="corporation-label">&#x2022; EXCEL CASHFLOW ANALYSIS  </label>
                                                      <input type="file" id="excel" name="excel"><img id="excelImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $excel; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="excelButton">Open File</button></a>
                                                      <label class="date-label" id="excelDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($excel, strrpos($excel, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                             </div>
                                          <div class="row">
                                             <div class="col-8">
                                                 <div style="border-top: 1px solid #676464; width:104%; margin-left: -1.2em">
                                                <div class="py-1"><label style="font-size:120%"><u>OTHERS</u></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="OTHERS">
                                          <!-- SPECIAL POWER OF ATTORNEY (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="powerAttorneyCheck" name="powerAttorneyCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">SPECIAL POWER OF ATTORNEY </label>
                                                   <input type="file" id="powerAttorney" name="powerAttorney"><img id="powerAttorneyImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $powerAttorney; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="powerAttorneyButton">Open File</button></a>
                                                   <label class="date-label" id="powerAttorneyDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerAttorney, strrpos($powerAttorney, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="powerAttorneySelect" name="powerAttorneySelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="powerAttorneyDesc" name="powerAttorneyDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CONTRACT TO SELL (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="contractSellCheck" name="contractSellCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">CONTRACT TO SELL </label>
                                                   <input type="file" id="contractSell" name="contractSell"><img id="contractSellImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $contractSell; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractSellButton">Open File</button></a>
                                                   <label class="date-label" id="contractSellDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractSell, strrpos($contractSell, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="contractSellSelect" name="contractSellSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractSellDesc" name="contractSellDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- LETTER OF GUARANTEE (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="letterGuaranteeCheck" name="letterGuaranteeCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="letterGuaranteeCheck">LETTER OF GUARANTEE</label> 
                                                   <input type="file" id="letterGuarantee" name="letterGuarantee"><img id="letterGuaranteeImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $letterGuarantee; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="letterGuaranteeButton">Open File</button></a>
                                                   <label class="date-label" id="letterGuaranteeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($letterGuarantee, strrpos($letterGuarantee, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "letterGuaranteeSelect" name = "letterGuaranteeSelect" tabindex="-1">
                                                      <option selected value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="letterGuaranteeDesc" name = "letterGuaranteeDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- STATEMENT OF ACCOUNT (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="statementAccountCheck" name="statementAccountCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">STATEMENT OF ACCOUNT</label>
                                                   <input type="file" id="statementAccount" name="statementAccount"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $statementAccount; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountButton">Open File</button></a>
                                                   <label class="date-label" id="statementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccount, strrpos($statementAccount, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="statementAccountSelect" name="statementAccountSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="statementAccountDesc" name="statementAccountDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BILL/COST OF MATERIALS  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="billMaterialsCheck" name="billMaterialsCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">BILL/COST OF MATERIALS </label>
                                                   <input type="file" id="billMaterials" name="billMaterials"><img id="billMaterialsImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $billMaterials; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="billMaterialsButton">Open File</button></a>
                                                   <label class="date-label" id="billMaterialsDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($billMaterials, strrpos($billMaterials, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="billMaterialsSelect" name="billMaterialsSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="billMaterialsDesc" name="billMaterialsDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PROPOSED PERSPECTIVE PLAN -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="proposedPlanCheck" name="proposedPlanCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PROPOSED PERSPECTIVE PLAN </label>
                                                   <input type="file" id="proposedPlan" name="proposedPlan"><img id="proposedPlanImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $proposedPlan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proposedPlanButton">Open File</button></a>
                                                   <label class="date-label" id="proposedPlanDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proposedPlan, strrpos($proposedPlan, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="proposedPlanSelect" name="proposedPlanSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proposedPlanDesc" name="proposedPlanDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                           <!-- FOR SPACE END BUYER-->
                                          <div class="row">
                                              <div class="col-8" id="endBuyerSpace" style="margin-bottom:-2%; "></div>
                                           </div>
                                               <!-- FOR SPACE NOT END BUYER-->
                                          <div class="row">
                                              <div class="col-8" id= "notEndBuyerSpace" style="margin-bottom:-2%;"></div>
                                           </div>
                                        </div>
                                       </div>
                                       <!-- LETTER  -->
                                       <div class="row">
                                          
                                          <div class="col-6">
                                             <div>
                                                <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%; border-top: 1px solid #ccc;">COLLECTION</h1>
                                             </div>
                                             <div class="row">
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%;">DEMAND</h5></div>
                                                   <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">FIRST LETTER</label>
                                                   <input type="hidden" id="hiddenCf" name="hiddenCf" value="<?= $rows['cfLetter']; ?>">
                                                   <input type="hidden" id="hiddenCf2" name="hiddenCf2" value="<?= $rows['cfLetter2']; ?>">
                                                   <input type="hidden" id="hiddenLate" name="hiddenLate" value="<?= $duecDLate; ?>">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 100%;">&nbsp;</h5></div>
                                                   <input type="file" id="cfLetter" name="cfLetter" style="display: none;">
                                                   <label for="cfLetter" class="forcfLetter btn-sm btn" id="forcfLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($cfLetter)){
                                                         echo '<a href="' . $cfLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cfLetterButton" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="cfLetterNew" class="fa-solid fa-plus cfLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="cfLetterNew" class="fa-solid fa-plus cfLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="cfLetterShowOld" class="fa-solid fa-scroll cfLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                <img id="cfLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">REGISTRY RECEIPT</h5></div>
                                                   <input type="file" id="cfLetter2" name="cfLetter2" style="display: none;">
                                                   <label for="cfLetter2" class="forcfLetter2 btn-sm btn" id="forcfLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($cfLetter2)){
                                                         echo '<a href="' . $cfLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cfLetter2Button" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="cfLetter2New" class="fa-solid fa-plus cfLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="cfLetter2New" class="fa-solid fa-plus cfLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="cfLetter2ShowOld" class="fa-solid fa-scroll cfLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                <img id="cfLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">RETURN RECEIPT</h5></div>
                                                   <input type="file" id="cfLetter3" name="cfLetter3" style="display: none;">
                                                   <label for="cfLetter3" class="forcfLetter3 btn-sm btn" id="forcfLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($cfLetter3)){
                                                         echo '<a href="' . $cfLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cfLetter3Button" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="cfLetter3New" class="fa-solid fa-plus cfLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="cfLetter3New" class="fa-solid fa-plus cfLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="cfLetter3ShowOld" class="fa-solid fa-scroll cfLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                <img id="cfLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <!-- <div class="py-1"> -->
                                                      <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 102%; border-right: 1px solid #ccc; margin-left: 9%;">DATE</h5></div>
                                                      <label class="date-label" id="cfLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cfLetter, strrpos($cfLetter, '/') + 1, 10); ?></label>
                                                      <!-- </div> -->
                                                </div>
                                             <div class="col-2">
                                                <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 105%; margin-left: -2%;">REMARKS</h5></div>
                                                <div class="form-group d-flex mb-4" id="">
                                                   &nbsp;&nbsp;<input type="text" id="cfLetterSelect" name="cfLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cfLetterRemarks']; ?>">
                                                   &nbsp;&nbsp;<input type="hidden" class="fom-control w-75 p-1 fs-4" placeholder="REMARKS" id="cfLetterDesc" name="cfLetterDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">SECOND LETTER</label>
                                                   <input type="hidden" id="hiddenCs" name="hiddenCs" value="<?= $rows['csLetter']; ?>">
                                                   <input type="hidden" id="hiddenCs2" name="hiddenCs2" value="<?= $rows['csLetter2']; ?>">
                                             </div>
                                             <div class="col-2">
                                                  <input type="file" id="csLetter" name="csLetter" style="display: none;">
                                                  <label for="csLetter" class="forcsLetter btn-sm btn" id="forcsLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($csLetter)){
                                                         echo '<a href="' . $csLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="csLetterButton" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="csLetterNew" class="fa-solid fa-plus csLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="csLetterNew" class="fa-solid fa-plus csLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="csLetterShowOld" class="fa-solid fa-scroll csLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="csLetterImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="csLetter2" name="csLetter2" style="display: none;">
                                                   <label for="csLetter2" class="forcsLetter2 btn-sm btn" id="forcsLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($csLetter2)){
                                                         echo '<a href="' . $csLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="csLetter2Button" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="csLetter2New" class="fa-solid fa-plus csLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="csLetter2New" class="fa-solid fa-plus csLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="csLetter2ShowOld" class="fa-solid fa-scroll csLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="csLetter2Image" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="csLetter3" name="csLetter3" style="display: none;">
                                                   <label for="csLetter3" class="forcsLetter3 btn-sm btn" id="forcsLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($csLetter3)){
                                                            echo '<a href="' . $csLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="csLetter3Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="csLetter3New" class="fa-solid fa-plus csLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="csLetter3New" class="fa-solid fa-plus csLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="csLetter3ShowOld" class="fa-solid fa-scroll csLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="csLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="csLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($csLetter, strrpos($csLetter, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2" id="">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="csLetterSelect" name="csLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['csLetterRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="csLetterDesc" name="csLetterDesc" >&nbsp;
                                                      </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-2">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">THIRD LETTER</label>
                                                      <input type="hidden" id="hiddenCt" name="hiddenCt" value="<?= $rows['ctLetter']; ?>">
                                                      <input type="hidden" id="hiddenCt2" name="hiddenCt2" value="<?= $rows['ctLetter2']; ?>"> 
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="ctLetter" name="ctLetter" style="display: none;">
                                                      <label for="ctLetter" class="forctLetter btn-sm btn" id="forctLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($ctLetter)){
                                                               echo '<a href="' . $ctLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ctLetterButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="ctLetterNew" class="fa-solid fa-plus ctLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="ctLetterNew" class="fa-solid fa-plus ctLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="ctLetterShowOld" class="fa-solid fa-scroll ctLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="ctLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                     <input type="file" id="ctLetter2" name="ctLetter2" style="display: none;">
                                                      <label for="ctLetter2" class="forctLetter2 btn-sm btn" id="forctLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($ctLetter2)){
                                                               echo '<a href="' . $ctLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ctLetter2Button" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="ctLetter2New" class="fa-solid fa-plus ctLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="ctLetter2New" class="fa-solid fa-plus ctLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="ctLetter2ShowOld" class="fa-solid fa-scroll ctLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="ctLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <input type="file" id="ctLetter3" name="ctLetter3" style="display: none;">
                                                   <label for="ctLetter3" class="forctLetter3 btn-sm btn" id="forctLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($ctLetter3)){
                                                            echo '<a href="' . $ctLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ctLetter3Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="ctLetter3New" class="fa-solid fa-plus ctLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="ctLetter3New" class="fa-solid fa-plus ctLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="ctLetter3ShowOld" class="fa-solid fa-scroll ctLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="ctLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="ctLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($ctLetter, strrpos($ctLetter, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2" id="">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="ctLetterSelect" name="ctLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['ctLetterRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="ctLetterDesc" name="ctLetterDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                                </div>
                                             <div class="row">
                                                <div class="col-2">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style="font-size: 20px; padding-left: 2%;">FINAL LETTER</label>
                                                      <input type="hidden" id="hiddenCfd" name="hiddenCfd" value="<?= $rows['cfdLetter']; ?>">
                                                      <input type="hidden" id="hiddenCfd2" name="hiddenCfd2" value="<?= $rows['cfdLetter2']; ?>">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="cfdLetter" name="cfdLetter" style="display: none;">
                                                      <label for="cfdLetter" class="forcfdLetter btn-sm btn" id="forcfdLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($cfdLetter)){
                                                               echo '<a href="' . $cfdLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cfdLetterButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="cfdLetterNew" class="fa-solid fa-plus cfdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="cfdLetterNew" class="fa-solid fa-plus cfdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="cfdLetterShowOld" class="fa-solid fa-scroll cfdLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="cfdLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="cfdLetter2" name="cfdLetter2" style="display: none;">
                                                      <label for="cfdLetter2" class="forcfdLetter2 btn-sm btn" id="forcfdLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($cfdLetter2)){
                                                               echo '<a href="' . $cfdLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cfdLetter2Button" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="cfdLetter2New" class="fa-solid fa-plus cfdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="cfdLetter2New" class="fa-solid fa-plus cfdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="cfdLetter2ShowOld" class="fa-solid fa-scroll cfdLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="cfdLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <input type="file" id="cfdLetter3" name="cfdLetter3" style="display: none;">
                                                   <label for="cfdLetter3" class="forcfdLetter3 btn-sm btn" id="forcfdLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($cfdLetter3)){
                                                            echo '<a href="' . $cfdLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cfdLetter3Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="cfdLetter3New" class="fa-solid fa-plus cfdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="cfdLetter3New" class="fa-solid fa-plus cfdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="cfdLetter3ShowOld" class="fa-solid fa-scroll cfdLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="cfdLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="cfdLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cfdLetter, strrpos($cfdLetter, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2" id="">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="cfdLetterSelect" name="cfdLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cdfLetterRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cfdLetterDesc" name="cfdLetterDesc" >&nbsp;
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
                                                         <input type="hidden" id="hiddenClient1" name="hiddenClient1" value="<?= $rows['cclientReq1']; ?>">
                                                         <input type="hidden" id="hiddenClient2" name="hiddenClient2" value="<?= $rows['cclientReq2']; ?>">
                                                         <input type="hidden" id="hiddenClient3" name="hiddenClient3" value="<?= $rows['cclientReq3']; ?>">
                                                   </div>
                                                   <div class="col-2">
                                                         <input type="file" id="cclientReq1" name="cclientReq1" style="display: none;">
                                                         <label for="cclientReq1" class="forcclientReq1 btn-sm btn" id="forcclientReq1" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                            <?php 
                                                               if(!empty($cclientReq1)){
                                                                  echo '<a href="' . $cclientReq1 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cclientReq1Button" 
                                                                        style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                                  echo '&nbsp;<button type="button" id="cclientReq1New" class="fa-solid fa-plus cclientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                               }else{
                                                                  // echo '&nbsp;<button type="button" id="cclientReq1New" class="fa-solid fa-plus cclientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                               }
                                                               echo '&nbsp;<button type="button" id="cclientReq1ShowOld" class="fa-solid fa-scroll cclientReq1ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            ?>
                                                            <img id="cclientReq1Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                         <input type="file" id="cclientReq2" name="cclientReq2" style="display: none;">
                                                         <label for="cclientReq2" class="forcclientReq2 btn-sm btn" id="forcclientReq2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                            <?php 
                                                               if(!empty($cclientReq2)){
                                                                  echo '<a href="' . $cclientReq2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cclientReq2Button" 
                                                                        style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                                  echo '&nbsp;<button type="button" id="cclientReq2New" class="fa-solid fa-plus cclientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                               }else{
                                                                  // echo '&nbsp;<button type="button" id="cclientReq2New" class="fa-solid fa-plus cclientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                               }
                                                               echo '&nbsp;<button type="button" id="cclientReq2ShowOld" class="fa-solid fa-scroll cclientReq2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            ?>
                                                            <img id="cclientReq2Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                      <input type="file" id="cclientReq3" name="cclientReq3" style="display: none;">
                                                      <label for="cclientReq3" class="forcclientReq3 btn-sm btn" id="forcclientReq3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($cclientReq3)){
                                                               echo '<a href="' . $cclientReq3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cclientReq3Button" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="cclientReq3New" class="fa-solid fa-plus cclientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="cclientReq3New" class="fa-solid fa-plus cclientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="cclientReq3ShowOld" class="fa-solid fa-scroll cclientReq3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="cclientReq3Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                         <label class="date-label" id="cclientReq1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cclientReq1, strrpos($cclientReq1, '/') + 1, 10); ?></label>
                                                   </div>
                                                   <div class="col-2" id="">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="cclientReq1Select" name="cclientReq1Select" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cclientReqRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cclientReq1Desc" name="cclientReq1Desc" >&nbsp;
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
                                                      <input type="file" id="cffClosure" name="cffClosure" style="display: none;">
                                                      <label for="cffClosure" class="forcffClosure btn-sm btn" id="forcffClosure" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($cffClosure)){
                                                               echo '<a href="' . $cffClosure . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cffClosureButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="cffClosureNew" class="fa-solid fa-plus cffClosureNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="cffClosureNew" class="fa-solid fa-plus cffClosureNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="cffClosureShowOld" class="fa-solid fa-scroll cffClosureShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="cffClosureImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                       
                                                   </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="cffClosureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cffClosure, strrpos($cffClosure, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="cttClosureRemarks" name="cttClosureRemarks" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cttClosureRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cffClosureDesc" name="cffClosureDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-3">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style="padding-left: 2%;">PASTDUE TO LITIGATION</label>
                                                </div>
                                                <div class="col-2">
                                                   <input type="file" id="cpastLitigation" name="cpastLitigation" style="display: none;">
                                                   <label for="cpastLitigation" class="forcpastLitigation btn-sm btn" id="forcpastLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($cpastLitigation)){
                                                            echo '<a href="' . $cpastLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cpastLitigationButton" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="cpastLitigationNew" class="fa-solid fa-plus cpastLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="cpastLitigationNew" class="fa-solid fa-plus cpastLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="cpastLitigationShowOld" class="fa-solid fa-scroll cpastLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="cpastLitigationImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="cpastLitigation2" name="cpastLitigation2" style="display: none;">
                                                      <label for="cpastLitigation2" class="forcpastLitigation2 btn-sm btn" id="forcpastLitigation2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($cpastLitigation2)){
                                                               echo '<a href="' . $cpastLitigation2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cpastLitigation2Button" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="cpastLitigation2New" class="fa-solid fa-plus cpastLitigation2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="cpastLitigation2New" class="fa-solid fa-plus cpastLitigation2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="cpastLitigation2ShowOld" class="fa-solid fa-scroll cpastLitigation2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="cpastLitigation2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                                   <input class="form-check-input" type="checkbox" value="Yes" id="cpastCheck" name="cpastCheck"><label for=""><label class="individual-labels" id="label23" for="forcpastCheck" style="font-size: 15px; display: inline;"> Bidding</label>
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="cpastLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cpastLitigation, strrpos($cpastLitigation, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="cpastLitigationSelect" name="cpastLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cpastLitigationRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cpastLitigationDesc" name="cpastLitigationDesc" >&nbsp;
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
                                                      <input type="file" id="cttLitigation" name="cttLitigation" style="display: none;">
                                                      <label for="cttLitigation" class="forcttLitigation btn-sm btn" id="forcttLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($cttLitigation)){
                                                               echo '<a href="' . $cttLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cttLitigationButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="cttLitigationNew" class="fa-solid fa-plus cttLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="cttLitigationNew" class="fa-solid fa-plus cttLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="cttLitigationShowOld" class="fa-solid fa-scroll cttLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="cttLitigationImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                       
                                                   </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="cttLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cttLitigation, strrpos($cttLitigation, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="cttLitigationSelect" name="cttLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cttLitigationRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cttLitigationDesc" name="cttLitigationDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-3">
                                                      <label class="corporation-label" id="tab-corporation" for="custom" style=" padding-left: 2%;">ANNOTATIONS OF COS</label>
                                                </div>
                                                <div class="col-2">
                                                   
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="cPrepConso" name="cPrepConso" style="display: none;">
                                                      <label for="cPrepConso" class="forcPrepConso btn-sm btn" id="forcPrepConso" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($cPrepConso)){
                                                               echo '<a href="' . $cPrepConso . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="cPrepConsoButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="cPrepConsoNew" class="fa-solid fa-plus cPrepConsoNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="cPrepConsoNew" class="fa-solid fa-plus cPrepConsoNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="cPrepConsoShowOld" class="fa-solid fa-scroll cPrepConsoShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="cPrepConsoImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                       
                                                   </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="cPrepConsoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cPrepConso, strrpos($cPrepConso, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="cPrepConsoSelect" name="cPrepConsoSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cPrepConsoRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cPrepConsoDesc" name="cPrepConsoDesc" >&nbsp;
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
                                                      <input type="file" id="caDemand" name="caDemand" style="display: none;">
                                                      <label for="caDemand" class="forcaDemand btn-sm btn" id="forcaDemand" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($caDemand)){
                                                               echo '<a href="' . $caDemand . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="caDemandButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="caDemandNew" class="fa-solid fa-plus caDemandNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="caDemandNew" class="fa-solid fa-plus caDemandNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="caDemandShowOld" class="fa-solid fa-scroll caDemandShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="caDemandImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-1">
                                       
                                                   </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="caDemandDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($caDemand, strrpos($caDemand, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2">
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="cdDemandRemarks" name="cdDemandRemarks" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['cdDemandRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="caDemandDesc" name="caDemandDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                             </div>
                                             <div class="row">
                                              <!-- <div class="col-8" id= "notEndBuyerSpace" style="margin-bottom:-5.6%;"></div> -->
                                           </div>
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
$(document).ready(function() {
  var remType = "<?php echo $remType; ?>";
  var sourceIncome = "<?php echo $sourceIncome; ?>";

  if (remType === "End Buyer") {
   document.getElementById("endBuyerSpace").style.height="4.9em";
  } else {
   document.getElementById("notEndBuyerSpace").style.height="4.1em";

  }
});

</script>
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


  function handleSelectChange(selectId, textField) {
    $('#' + selectId).on('change', function() {
      var selectedValue = $(this).val();

      if (selectedValue === "2") {

        document.getElementById(textField).style.visibility = 'visible';
      } else {
        document.getElementById(textField).style.visibility = 'hidden';
      }
    });
  }


// Corporation Text field

// PRINCIPAL BORROWER
handleSelectChange('endorsementSelect', 'endorsementDesc');
handleSelectChange('loanAppFormCSelect', 'loanAppFormCDesc');
handleSelectChange('companyProfileSelect', 'companyProfileDesc');
handleSelectChange('governmentIdSelect', 'governmentIdDesc');
handleSelectChange('secRegistrationSelect', 'secRegistrationDesc');
handleSelectChange('latestGISSelect', 'latestGISDesc');
handleSelectChange('copyBRSSelect', 'copyBRSDesc');
handleSelectChange('copyidCSTSelect', 'copyidCSTDesc');
// COLLATERAL DOCUMENTS
handleSelectChange('transferCertTitleSelect', 'transferCertTitleDesc');
handleSelectChange('taxDeclarationSelect', 'taxDeclarationDesc');
handleSelectChange('taxDeclartionICTCSelect', 'taxDeclartionICTCDesc');
handleSelectChange('realStateReceiptSelect', 'realStateReceiptDesc');
handleSelectChange('realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
handleSelectChange('cdOfMorgageSelect', 'cdOfMorgageDesc');
handleSelectChange('copyUpdatedBPSelect', 'copyUpdatedBPDesc');
// BUSINESS PROOF OF INCOME
handleSelectChange('auditedFinancialSelect', 'auditedFinancialDesc');
handleSelectChange('inhouseFinancialSelect', 'inhouseFinancialDesc');
handleSelectChange('latestBankSelect', 'latestBankDesc');
handleSelectChange('incomeTaxReturnSelect', 'incomeTaxReturnDesc');
handleSelectChange('contractLeaseSelect', 'contractLeaseDesc');
handleSelectChange('customerContactSelect', 'customerContactDesc');
handleSelectChange('supplierContactSelect', 'supplierContactDesc');
handleSelectChange('proofBillingSelect', 'proofBillingDesc');
// OTHERS
handleSelectChange('powerAttorneySelect', 'powerAttorneyDesc');
handleSelectChange('contractSellSelect', 'contractSellDesc');
handleSelectChange('letterGuaranteeSelect', 'letterGuaranteeDesc');
handleSelectChange('statementAccountSelect', 'statementAccountDesc');
handleSelectChange('billMaterialsSelect', 'billMaterialsDesc');
handleSelectChange('proposedPlanSelect', 'proposedPlanDesc');
// DOCUMENTS
handleSelectChange('receiptSelect', 'receiptDesc');
handleSelectChange('creditInvestigationReportCSelect', 'creditInvestigationReportCDesc');
handleSelectChange('collateralAppraisalReportCSelect', 'collateralAppraisalReportCDesc');
handleSelectChange('financialEvaluationCSelect', 'financialEvaluationCDesc');
handleSelectChange('signedLetterCSelect', 'signedLetterCDesc');
handleSelectChange('signedLetterUnderEndCSelect', 'signedLetterUnderEndCDesc');
handleSelectChange('signedLoanMemoCSelect', 'signedLoanMemoCDesc');
handleSelectChange('remContractCSelect', 'remContractCDesc');
handleSelectChange('remContractAnnotatedCSelect', 'remContractAnnotatedCDesc');
handleSelectChange('promNoteCSelect', 'promNoteCDesc');
handleSelectChange('disclosureStateCSelect', 'disclosureStateCDesc');
handleSelectChange('mriFormCSelect', 'mriFormCDesc');
handleSelectChange('amortScheduleCSelect', 'amortScheduleCDesc');
handleSelectChange('remContractEndCSelect', 'remContractEndCDesc');
handleSelectChange('promNoteEndCSelect', 'promNoteEndCDesc');
handleSelectChange('disclosureStateEndCSelect', 'disclosureStateEndCDesc');
handleSelectChange('mriFormEndCSelect', 'mriFormEndCDesc');
handleSelectChange('amortScheduleEndCSelect', 'amortScheduleEndCDesc');
handleSelectChange('signedDeedUnderEndCSelect', 'signedDeedUnderEndCDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');

</script>

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, corpId) {
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
                        d.corpId = corpId;
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
   $(document).on('click', '#cfLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cfLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#cfLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cfLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#cfLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cfLetter3.php', '<?php echo $id; ?>');
   });

   // Second Demand
   $(document).on('click', '#csLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_csLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#csLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_csLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#csLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_csLetter3.php', '<?php echo $id; ?>');
   });

   // Third Demand
   $(document).on('click', '#ctLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_ctLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ctLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_ctLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ctLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_ctLetter3.php', '<?php echo $id; ?>');
   });

   // Final Demand
   $(document).on('click', '#cfdLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cfdLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#cfdLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cfdLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#cfdLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cfdLetter3.php', '<?php echo $id; ?>');
   });

   // other DOCUMENTS cclientReq1
   $(document).on('click', '#cclientReq1ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cclientReq1.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#cclientReq2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cclientReq2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#cclientReq3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cclientReq3.php', '<?php echo $id; ?>');
   });

   // foreclosure #
   $(document).on('click', '#cffClosureShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cffClosure.php', '<?php echo $id; ?>');
   });

   // pastdue litigation
   $(document).on('click', '#cpastLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cpastLitigation.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#cpastLitigation2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cpastLitigation2.php', '<?php echo $id; ?>');
   });

   //transfer litigation
   $(document).on('click', '#cttLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cttLitigation.php', '<?php echo $id; ?>');
   });

   // prepare for consolidate
   $(document).on('click', '#cPrepConsoShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_cPrepConso.php', '<?php echo $id; ?>');
   });

   // due and demandable
   $(document).on('click', '#caDemandShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ca_caDemand.php', '<?php echo $id; ?>');
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
   $(document).on('click', '#cfLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#cfLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#cfLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 2nd Demand
   $(document).on('click', '#csLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#csLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#csLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 3rd Demand
   $(document).on('click', '#ctLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ctLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ctLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // Final Demand
   $(document).on('click', '#cfdLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#cfdLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#cfdLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // other docs #
   $(document).on('click', '#cclientReq1ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#cclientReq2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#cclientReq3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // foreclosure
   $(document).on('click', '#cffClosureShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // pastdue litigation
   $(document).on('click', '#cpastLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#cpastLitigation2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // transfer litigation
   $(document).on('click', '#cttLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // prepare for consolidate
   $(document).on('click', '#cPrepConsoShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // due and Demandable
   $(document).on('click', '#caDemandShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
</script>


<!-- Corporation Form -->
<script>
  var corpForm = document.getElementById("corporation-form");
  var corpId = "<?php echo $id; ?>";
  var fullname = "<?php echo $fullname; ?>";
  var salaryType = "<?php echo $type; ?>";
  var branch = "<?php echo $branch; ?>";
  var loanType = "<?php echo $loanType; ?>";

  var endPrompt = ""; // Global variable for remarks
  function uploadFileC() {
    var corpformData = new FormData(corpForm);
    corpformData.append('corpId', corpId);
    corpformData.append('fullname',fullname);
    corpformData.append('salaryType',salaryType);
    corpformData.append('branch',branch);
    corpformData.append('loanType',loanType);

   // Append the endPrompt to the FormData
   corpformData.append('endPrompt', endPrompt);

    $.ajax({
      url: 'loanCorporationUploadData.php',
      type: 'POST',
      data: corpformData,
      processData: false,
      contentType: false,
      success: function(response) {
// PRINCIPAL BORROWER
// PRINCIPAL BORROWER
updateFileStatus('endorsement', 'endorsementImage');
updateFileStatus('loanAppFormC', 'loanAppFormCImage');
updateFileStatus('companyProfile', 'companyProfileImage');
updateFileStatus('governmentId', 'governmentIdImage');
updateFileStatus('secRegistration', 'secRegistrationImage');
updateFileStatus('latestGIS', 'latestGISImage');
updateFileStatus('copyBRS', 'copyBRSImage');
updateFileStatus('copyidCST', 'copyidCSTImage');
// COLLATERAL DOCUMENTS
updateFileStatus('transferCertTitle', 'transferCertTitleImage');
updateFileStatus('taxDeclaration', 'taxDeclarationImage');
updateFileStatus('taxDeclartionICTC', 'taxDeclartionICTCImage');
updateFileStatus('realStateReceipt', 'realStateReceiptImage');
updateFileStatus('realEstateTaxClearance', 'realEstateTaxClearanceImage');
updateFileStatus('cdOfMorgage', 'cdOfMorgageImage');
// BUSINESS PROOF OF INCOME
updateFileStatus('copyUpdatedBP', 'copyUpdatedBPImage');
updateFileStatus('auditedFinancial', 'auditedFinancialImage');
updateFileStatus('inhouseFinancial', 'inhouseFinancialImage');
updateFileStatus('latestBank', 'latestBankImage');
updateFileStatus('incomeTaxReturn', 'incomeTaxReturnImage');
updateFileStatus('contractLease', 'contractLeaseImage');
updateFileStatus('customerContact', 'customerContactImage');
updateFileStatus('supplierContact', 'supplierContactImage');
updateFileStatus('proofBilling', 'proofBillingImage');
// OTHERS
updateFileStatus('powerAttorney', 'powerAttorneyImage');
updateFileStatus('contractSell', 'contractSellImage');
updateFileStatus('letterGuarantee', 'letterGuaranteeImage');
updateFileStatus('statementAccount', 'statementAccountImage');
updateFileStatus('billMaterials', 'billMaterialsImage');
updateFileStatus('proposedPlan', 'proposedPlanImage');
// DOCUMENTS
updateFileStatus('receipt', 'receiptImage');
updateFileStatus('creditInvestigationReportC', 'creditInvestigationReportCImage');
updateFileStatus('collateralAppraisalReportC', 'collateralAppraisalReportCImage');
updateFileStatus('financialEvaluationC', 'financialEvaluationCImage');
updateFileStatus('signedLetterC', 'signedLetterCImage');
updateFileStatus('signedLetterUnderEndC', 'signedLetterUnderEndCImage');
updateFileStatus('signedLoanMemoC', 'signedLoanMemoCImage');
updateFileStatus('remContractC', 'remContractCImage');
updateFileStatus('remContractAnnotatedC', 'remContractAnnotatedCImage');
updateFileStatus('promNoteC', 'promNoteCImage');
updateFileStatus('disclosureStateC', 'disclosureStateCImage');
updateFileStatus('mriFormC', 'mriFormCImage');
updateFileStatus('amortScheduleC', 'amortScheduleCImage');
updateFileStatus('remContractEndC', 'remContractEndCImage');
updateFileStatus('promNoteEndC', 'promNoteEndCImage');
updateFileStatus('disclosureStateEndC', 'disclosureStateEndCImage');
updateFileStatus('mriFormEndC', 'mriFormEndCImage');
updateFileStatus('amortScheduleEndC', 'amortScheduleEndCImage');
updateFileStatus('signedDeedUnderEndC', 'signedDeedUnderEndCImage');
updateFileStatus('utilization', 'utilizationImage');
updateFileStatus('powerpoint', 'powerpointImage');
updateFileStatus('excel', 'excelImage');
// LETTER
updateFileStatus('cfLetter', 'cfLetterImage');
updateFileStatus('csLetter', 'csLetterImage');
updateFileStatus('ctLetter', 'ctLetterImage');
updateFileStatus('cfdLetter', 'cfdLetterImage');
// LETTER2
updateFileStatus('cfLetter2', 'cfLetter2Image');
updateFileStatus('csLetter2', 'csLetter2Image');
updateFileStatus('ctLetter2', 'ctLetter2Image');
updateFileStatus('cfdLetter2', 'cfdLetter2Image');
// LETTER3
updateFileStatus('cfLetter3', 'cfLetter3Image');
updateFileStatus('csLetter3', 'csLetter3Image');
updateFileStatus('ctLetter3', 'ctLetter3Image');
updateFileStatus('cfdLetter3', 'cfdLetter3Image');
// OTHER ATTACHMENT
updateFileStatus('cclientReq1', 'cclientReq1Image');
updateFileStatus('cclientReq2', 'cclientReq2Image');
updateFileStatus('cclientReq3', 'cclientReq3Image');
// LEGAL
updateFileStatus('cffClosure', 'cffClosureImage');
updateFileStatus('cpastLitigation', 'cpastLitigationImage');
updateFileStatus('cpastLitigation2', 'cpastLitigation2Image');
updateFileStatus('cttLitigation', 'cttLitigationImage');
updateFileStatus('cPrepConso', 'cPrepConsoImage');
updateFileStatus('caDemand', 'caDemandImage');

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
                    formData.append('corpId',  corpId);

                    // Log FormData before sending
                    console.log("FormData before AJAX:", Array.from(formData.entries()));

                    // Send form data via AJAX
                    $.ajax({
                        url: 'loanCorporationUploadData.php',
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

   // for cfLetter
   $(document).on('click', '.cfLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cfLetter');
   });
   $(document).on('click', '.cfLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cfLetter2');
   });
   $(document).on('click', '.cfLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cfLetter3');
   });
   // for csLetter
   $(document).on('click', '.csLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#csLetter');
   });
   $(document).on('click', '.csLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#csLetter2');
   });
   $(document).on('click', '.csLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#csLetter3');
   });
   // 3rd Letter
   $(document).on('click', '.ctLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ctLetter');
   });
   $(document).on('click', '.ctLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ctLetter2');
   });
   $(document).on('click', '.ctLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ctLetter3');
   });
   // final DEMAND
   $(document).on('click', '.cfdLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cfdLetter');
   });
   $(document).on('click', '.cfdLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cfdLetter2');
   });
   $(document).on('click', '.cfdLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cfdLetter3');
   });

   // OTHER ATTACHMENT
   $(document).on('click', '.cclientReq1New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cclientReq1');
   });
   $(document).on('click', '.cclientReq2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cclientReq2');
   });
   $(document).on('click', '.cclientReq3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cclientReq3');
   });

   // LEGAL
   $(document).on('click', '.cffClosureNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cffClosure');
   });
   $(document).on('click', '.cpastLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cpastLitigation');
   });
   $(document).on('click', '.cpastLitigation2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cpastLitigation2');
   });
   
   // Transfer to ROPA
   $(document).on('click', '.cttLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cttLitigation');
   });
   // Prepare to Consolidation
   $(document).on('click', '.cPrepConsoNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#cPrepConso');
   });
   // Due and Demandable
   $(document).on('click', '.caDemandNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#caDemand');
   });

  corpForm.addEventListener("change", function() {
    uploadFileC();
  });
</script>

<script>
   function fileValue()
      document.getElementById("cfLetterSelect").value = $cfLetterSelect;
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



// USED TO FILTER DATA FROM DATABASE THEN PUT THEM ON TEXTFIELD
// PRINCIPAL BORROWER
selectOptionBasedOnValue('<?php echo explode("--", $endorsementSelect)[0]; ?>', 'endorsementSelect', 'endorsementDesc', '<?php echo explode("--", $endorsementSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $loanAppFormCSelect)[0]; ?>', 'loanAppFormCSelect', 'loanAppFormCDesc', '<?php echo explode("--", $loanAppFormCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $companyProfileSelect)[0]; ?>', 'companyProfileSelect', 'companyProfileDesc', '<?php echo explode("--", $companyProfileSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $governmentIdSelect)[0]; ?>', 'governmentIdSelect', 'governmentIdDesc', '<?php echo explode("--", $governmentIdSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $secRegistrationSelect)[0]; ?>', 'secRegistrationSelect', 'secRegistrationDesc', '<?php echo explode("--", $secRegistrationSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $latestGISSelect)[0]; ?>', 'latestGISSelect', 'latestGISDesc', '<?php echo explode("--", $latestGISSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $copyBRSSelect)[0]; ?>', 'copyBRSSelect', 'copyBRSDesc', '<?php echo explode("--", $copyBRSSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $copyidCSTSelect)[0]; ?>', 'copyidCSTSelect', 'copyidCSTDesc', '<?php echo explode("--", $copyidCSTSelect)[1]; ?>');
// COLLATERAL DOCUMENTS
selectOptionBasedOnValue('<?php echo explode("--", $transferCertTitleSelect)[0]; ?>', 'transferCertTitleSelect', 'transferCertTitleDesc', '<?php echo explode("--", $transferCertTitleSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $taxDeclarationSelect)[0]; ?>', 'taxDeclarationSelect', 'taxDeclarationDesc', '<?php echo explode("--", $taxDeclarationSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $taxDeclartionICTCSelect)[0]; ?>', 'taxDeclartionICTCSelect', 'taxDeclartionICTCDesc', '<?php echo explode("--", $taxDeclartionICTCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $realStateReceiptSelect)[0]; ?>', 'realStateReceiptSelect', 'realStateReceiptDesc', '<?php echo explode("--", $realStateReceiptSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $realEstateTaxClearanceSelect)[0]; ?>', 'realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc', '<?php echo explode("--", $realEstateTaxClearanceSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $cdOfMorgageSelect)[0]; ?>', 'cdOfMorgageSelect', 'cdOfMorgageDesc', '<?php echo explode("--", $cdOfMorgageSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $copyUpdatedBPSelect)[0]; ?>', 'copyUpdatedBPSelect', 'copyUpdatedBPDesc', '<?php echo explode("--", $copyUpdatedBPSelect)[1]; ?>');
// BUSINESS PROOF OF INCOME
selectOptionBasedOnValue('<?php echo explode("--", $auditedFinancialSelect)[0]; ?>', 'auditedFinancialSelect', 'auditedFinancialDesc', '<?php echo explode("--", $auditedFinancialSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $inhouseFinancialSelect)[0]; ?>', 'inhouseFinancialSelect', 'inhouseFinancialDesc', '<?php echo explode("--", $inhouseFinancialSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $latestBankSelect)[0]; ?>', 'latestBankSelect', 'latestBankDesc', '<?php echo explode("--", $latestBankSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $incomeTaxReturnSelect)[0]; ?>', 'incomeTaxReturnSelect', 'incomeTaxReturnDesc', '<?php echo explode("--", $incomeTaxReturnSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $contractLeaseSelect)[0]; ?>', 'contractLeaseSelect', 'contractLeaseDesc', '<?php echo explode("--", $contractLeaseSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $customerContactSelect)[0]; ?>', 'customerContactSelect', 'customerContactDesc', '<?php echo explode("--", $customerContactSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $supplierContactSelect)[0]; ?>', 'supplierContactSelect', 'supplierContactDesc', '<?php echo explode("--", $supplierContactSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $proofBillingSelect)[0]; ?>', 'proofBillingSelect', 'proofBillingDesc', '<?php echo explode("--", $proofBillingSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $sourceIncomeSelect)[0]; ?>', 'sourceIncomeSelect', 'sourceIncomeDesc', '<?php echo explode("--", $sourceIncomeSelect)[1]; ?>');
// OTHERS
selectOptionBasedOnValue('<?php echo explode("--", $powerAttorneySelect)[0]; ?>', 'powerAttorneySelect', 'powerAttorneyDesc', '<?php echo explode("--", $powerAttorneySelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $contractSellSelect)[0]; ?>', 'contractSellSelect', 'contractSellDesc', '<?php echo explode("--", $contractSellSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $letterGuaranteeSelect)[0]; ?>', 'letterGuaranteeSelect', 'letterGuaranteeDesc', '<?php echo explode("--", $letterGuaranteeSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $statementAccountSelect)[0]; ?>', 'statementAccountSelect', 'statementAccountDesc', '<?php echo explode("--", $statementAccountSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $billMaterialsSelect)[0]; ?>', 'billMaterialsSelect', 'billMaterialsDesc', '<?php echo explode("--", $billMaterialsSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $proposedPlanSelect)[0]; ?>', 'proposedPlanSelect', 'proposedPlanDesc', '<?php echo explode("--", $proposedPlanSelect)[1]; ?>');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo explode("--", $receiptSelect)[0]; ?>', 'receiptSelect', 'receiptDesc', '<?php echo explode("--", $receiptSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $creditInvestigationReportCSelect)[0]; ?>', 'creditInvestigationReportCSelect', 'creditInvestigationReportCDesc', '<?php echo explode("--", $creditInvestigationReportCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $collateralAppraisalReportCSelect)[0]; ?>', 'collateralAppraisalReportCSelect', 'collateralAppraisalReportCDesc', '<?php echo explode("--", $collateralAppraisalReportCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $financialEvaluationCSelect)[0]; ?>', 'financialEvaluationCSelect', 'financialEvaluationCDesc', '<?php echo explode("--", $financialEvaluationCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedLetterCSelect)[0]; ?>', 'signedLetterCSelect', 'signedLetterCDesc', '<?php echo explode("--", $signedLetterCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedLetterUnderEndCSelect)[0]; ?>', 'signedLetterUnderEndCSelect', 'signedLetterUnderEndCDesc', '<?php echo explode("--", $signedLetterUnderEndCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedLoanMemoCSelect)[0]; ?>', 'signedLoanMemoCSelect', 'signedLoanMemoCDesc', '<?php echo explode("--", $signedLoanMemoCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $remContractCSelect)[0]; ?>', 'remContractCSelect', 'remContractCDesc', '<?php echo explode("--", $remContractCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $remContractAnnotatedCSelect)[0]; ?>', 'remContractAnnotatedCSelect', 'remContractAnnotatedCDesc', '<?php echo explode("--", $remContractAnnotatedCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $promNoteCSelect)[0]; ?>', 'promNoteCSelect', 'promNoteCDesc', '<?php echo explode("--", $promNoteCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $disclosureStateCSelect)[0]; ?>', 'disclosureStateCSelect', 'disclosureStateCDesc', '<?php echo explode("--", $disclosureStateCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $mriFormCSelect)[0]; ?>', 'mriFormCSelect', 'mriFormCDesc', '<?php echo explode("--", $mriFormCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $amortScheduleCSelect)[0]; ?>', 'amortScheduleCSelect', 'amortScheduleCDesc', '<?php echo explode("--", $amortScheduleCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $remContractEndCSelect)[0]; ?>', 'remContractEndCSelect', 'remContractEndCDesc', '<?php echo explode("--", $remContractEndCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $promNoteEndCSelect)[0]; ?>', 'promNoteEndCSelect', 'promNoteEndCDesc', '<?php echo explode("--", $promNoteEndCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $disclosureStateEndCSelect)[0]; ?>', 'disclosureStateEndCSelect', 'disclosureStateEndCDesc', '<?php echo explode("--", $disclosureStateEndCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $mriFormEndCSelect)[0]; ?>', 'mriFormEndCSelect', 'mriFormEndCDesc', '<?php echo explode("--", $mriFormEndCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $amortScheduleEndCSelect)[0]; ?>', 'amortScheduleEndCSelect', 'amortScheduleEndCDesc', '<?php echo explode("--", $amortScheduleEndCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedDeedUnderEndCSelect)[0]; ?>', 'signedDeedUnderEndCSelect', 'signedDeedUnderEndCDesc', '<?php echo explode("--", $signedDeedUnderEndCSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $utilizationSelect)[0]; ?>', 'utilizationSelect', 'utilizationDesc', '<?php echo explode("--", $utilizationSelect)[1]; ?>');
// LETTER
// LEGAL
</script>

<script>
$(document).ready(function() {
  var remType= "<?php echo $remType; ?>";
if(remType=="End Buyer"){
        document.getElementById('endBuyer').style.display="inline";


        document.getElementById('endBuyerUnder').style.display="inline";
        document.getElementById('endBuyerUnderSelect').style.display="inline";
 }
 else{

  document.getElementById('notEndBuyer').style.display="inline";
  document.getElementById('notEndBuyerSelect').style.display="inline";

  document.getElementById('endBuyerUnder').style.display="none";
  document.getElementById('endBuyerUnderSelect').style.display="none";


 }


});
</script>

<script>
function initializeCheckboxes() {  
  var powerAttorneyIValue = "<?php echo $powerAttorneyICheck; ?>";
  var contractSellValue = "<?php echo $contractSellCheck; ?>";
  var letterGuaranteeValue = "<?php echo $letterGuaranteeCheck; ?>";
  var statementAccountValue = "<?php echo $statementAccountCheck; ?>";
  var billMaterialsValue = "<?php echo $billMaterialsCheck; ?>";
  var proposedPlanValue = "<?php echo $proposedPlanCheck; ?>";
  // Get the checkbox elements
  const powerAttorneyICheck = document.getElementById('powerAttorneyCheck');
  const contractSellCheck = document.getElementById('contractSellCheck');
  const letterGuaranteeCheck = document.getElementById('letterGuaranteeCheck');
  const statementAccountCheck = document.getElementById('statementAccountCheck');
  const billMaterialsCheck = document.getElementById('billMaterialsCheck');
  const proposedPlanCheck = document.getElementById('proposedPlanCheck');

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
showInput(powerAttorneyIValue, powerAttorneyICheck,'powerAttorney', 'powerAttorneySelect', 'powerAttorneyDesc',`powerAttorneyImage`);
showInput(contractSellValue, contractSellCheck,'contractSell', 'contractSellSelect', 'contractSellDesc',`contractSellImage`);
showInput(letterGuaranteeValue, letterGuaranteeCheck, 'letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc',`letterGuaranteeImage`);
showInput(statementAccountValue, statementAccountCheck,'statementAccount', 'statementAccountSelect', 'statementAccountDesc',`statementAccountImage`);
showInput(billMaterialsValue, billMaterialsCheck,'billMaterials', 'billMaterialsSelect', 'billMaterialsDesc',`billMaterialsImage`);
showInput(proposedPlanValue, proposedPlanCheck,'proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc',`proposedPlanImage`);
  
}
// Call the function to initialize the checkboxes on page load
initializeCheckboxes();

</script>

<script>
function initializePastCheck() {  
  var pastCheckVal = "<?php echo $cpastCheck; ?>";

  // Get the checkbox elements
  const pastCheckk = document.getElementById('cpastCheck');

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

document.getElementById("powerAttorneyCheck").addEventListener("click", function() {
    toggleVisibility('powerAttorney');
});

document.getElementById("contractSellCheck").addEventListener("click", function() {
    toggleVisibility('contractSell');
});
document.getElementById("letterGuaranteeCheck").addEventListener("click", function() {
    toggleVisibility('letterGuarantee');
});

document.getElementById("statementAccountCheck").addEventListener("click", function() {
    toggleVisibility('statementAccount');
});

document.getElementById("billMaterialsCheck").addEventListener("click", function() {
    toggleVisibility('billMaterials');
});

document.getElementById("proposedPlanCheck").addEventListener("click", function() {
    toggleVisibility('proposedPlan');
});

</script>
<script>
   // RESET THE VALUE OF SELECT TO ZERO(OPTION)
  function resetIndex(targetId,targetSelect,targetDesc){
  document.getElementById(targetId).addEventListener('change', function() {
  var selectElement = document.getElementById(targetSelect,"loanAppFormCDate");
  selectElement.selectedIndex = 0;
  document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
  });
  }
// PRINCIPAL BORROWER
resetIndex('endorsement', 'endorsementSelect', 'endorsementDesc');
resetIndex('loanAppFormC', 'loanAppFormCSelect', 'loanAppFormCDesc');
resetIndex('companyProfile', 'companyProfileSelect', 'companyProfileDesc');
resetIndex('governmentId', 'governmentIdSelect', 'governmentIdDesc');
resetIndex('secRegistration', 'secRegistrationSelect', 'secRegistrationDesc');
resetIndex('latestGIS', 'latestGISSelect', 'latestGISDesc');
resetIndex('copyBRS', 'copyBRSSelect', 'copyBRSDesc');
resetIndex('copyidCST', 'copyidCSTSelect', 'copyidCSTDesc');
// COLLATERAL DOCUMENTS
resetIndex('transferCertTitle', 'transferCertTitleSelect', 'transferCertTitleDesc');
resetIndex('taxDeclaration', 'taxDeclarationSelect', 'taxDeclarationDesc');
resetIndex('taxDeclartionICTC', 'taxDeclartionICTCSelect', 'taxDeclartionICTCDesc');
resetIndex('realStateReceipt', 'realStateReceiptSelect', 'realStateReceiptDesc');
resetIndex('realEstateTaxClearance', 'realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
resetIndex('cdOfMorgage', 'cdOfMorgageSelect', 'cdOfMorgageDesc');
// BUSINESS PROOF OF INCOME
resetIndex('copyUpdatedBP', 'copyUpdatedBPSelect', 'copyUpdatedBPDesc');
resetIndex('auditedFinancial', 'auditedFinancialSelect', 'auditedFinancialDesc');
resetIndex('inhouseFinancial', 'inhouseFinancialSelect', 'inhouseFinancialDesc');
resetIndex('latestBank', 'latestBankSelect', 'latestBankDesc');
resetIndex('incomeTaxReturn', 'incomeTaxReturnSelect', 'incomeTaxReturnDesc');
resetIndex('contractLease', 'contractLeaseSelect', 'contractLeaseDesc');
resetIndex('customerContact', 'customerContactSelect', 'customerContactDesc');
resetIndex('supplierContact', 'supplierContactSelect', 'supplierContactDesc');
resetIndex('proofBilling', 'proofBillingSelect', 'proofBillingDesc');
// OTHERS
resetIndex('powerAttorney', 'powerAttorneySelect', 'powerAttorneyDesc');
resetIndex('contractSell', 'contractSellSelect', 'contractSellDesc');
resetIndex('letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc');
resetIndex('statementAccount', 'statementAccountSelect', 'statementAccountDesc');
resetIndex('billMaterials', 'billMaterialsSelect', 'billMaterialsDesc');
resetIndex('proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc');
// DOCUMENTS
resetIndex('receipt', 'receiptSelect', 'receiptDesc');
resetIndex('creditInvestigationReportC', 'creditInvestigationReportCSelect', 'creditInvestigationReportCDesc');
resetIndex('collateralAppraisalReportC', 'collateralAppraisalReportCSelect', 'collateralAppraisalReportCDesc');
resetIndex('financialEvaluationC', 'financialEvaluationCSelect', 'financialEvaluationCDesc');
resetIndex('signedLetterC', 'signedLetterCSelect', 'signedLetterCDesc');
resetIndex('signedLoanMemoC', 'signedLoanMemoCSelect', 'signedLoanMemoCDesc');
resetIndex('remContractC', 'remContractCSelect', 'remContractCDesc');
resetIndex('promNoteC', 'promNoteCSelect', 'promNoteCDesc');
resetIndex('disclosureStateC', 'disclosureStateCSelect', 'disclosureStateCDesc');
resetIndex('mriFormC', 'mriFormCSelect', 'mriFormCDesc');
resetIndex('remContractAnnotatedC', 'remContractAnnotatedCSelect', 'remContractAnnotatedCDesc');
resetIndex('signedLetterUnderEndC', 'signedLetterUnderEndCSelect', 'signedLetterUnderEndCDesc');
resetIndex('remContractEndC', 'remContractEndCSelect', 'remContractEndCDesc');
resetIndex('promNoteEndC', 'promNoteEndCSelect', 'promNoteEndCDesc');
resetIndex('disclosureStateEndC', 'disclosureStateEndCSelect', 'disclosureStateEndCDesc');
resetIndex('mriFormEndC', 'mriFormEndCSelect', 'mriFormEndCDesc');
resetIndex('signedDeedUnderEndC', 'signedDeedUnderEndCSelect', 'signedDeedUnderEndCDesc');
resetIndex('amortScheduleC', 'amortScheduleCSelect', 'amortScheduleCDesc');
resetIndex('amortScheduleEndC', 'amortScheduleEndCSelect', 'amortScheduleEndCDesc');
resetIndex('utilization', 'utilizationSelect', 'utilizationDesc');
// LETTER
resetIndex('cfLetter', 'cfLetterSelect', 'cfLetterDesc');
resetIndex('csLetter', 'csLetterSelect', 'csLetterDesc');
resetIndex('ctLetter', 'ctLetterSelect', 'ctLetterDesc');
resetIndex('cfdLetter', 'cfdLetterSelect', 'cfdLetterDesc');
// LEGAL
resetIndex('cffClosure', 'cttClosureRemarks', 'cffClosureDesc');
resetIndex('cttLitigation', 'cttLitigationSelect', 'cttLitigationDesc');
resetIndex('caDemand', 'cdDemandRemarks', 'caDemandDesc');
</script> 

<!-- <script>
   // Hidden Letter & Legal
   function hiddenLetter(){
      var late = $('#hiddenLate').val();
      var fLetter = $('#hiddenCf').val();
      var fLetter2 = $('#hiddenCf2').val();
      var fLetterSelect = $('#cfLetterSelect').val();
      var sLetter = $('#hiddenCs').val();
      var sLetter2 = $('#hiddenCs2').val();
      var sLetterSelect = $('csLetterSelect').val();
      var tLetter = $('#hiddenCt').val();
      var tLetter2 = $('#hiddenCt2').val();
      var tLetterSelect = $('ctLetterSelect').val();
      // if true = & disable || readonly.
      if(late >= 31 && late <= 60){
         document.getElementById('cfLetter').style.visibility = "true";
         document.getElementById('cfLetter2').style.visibility = "true";
         document.getElementById('cfLetter3').style.visibility = "true";
         document.getElementById('cfLetterSelect').style.visibility = "true";
         document.getElementById('cfLetterImage').style.visibility = "true";
         document.getElementById('cfLetter2Image').style.visibility = "true";
         document.getElementById('cfLetter3Image').style.visibility = "true";
      }
      else{
         if(late <= 30){
            document.getElementById('cfLetter').style.visibility = "hidden";
            document.getElementById('cfLetter2').style.visibility = "hidden";
            document.getElementById('cfLetter3').style.visibility = "hidden";
            // document.getElementById('cfLetterSelect').style.visibility = "hidden";
            document.getElementById('cfLetterImage').style.visibility = "hidden";
            document.getElementById('cfLetter2Image').style.visibility = "hidden";
            document.getElementById('cfLetter3Image').style.visibility = "hidden";
         }
      }
      if(fLetterSelect != '' && fLetter != '' && fLetter2 != '' && late >= 31 && late <= 60){
         document.getElementById('csLetter').style.visibility = "true";
         document.getElementById('csLetter2').style.visibility = "true";
         document.getElementById('csLetter3').style.visibility = "true";
         document.getElementById('csLetterSelect').style.visibility = "true";
         document.getElementById('csLetterImage').style.visibility = "true";
         document.getElementById('csLetter2Image').style.visibility = "true";
         document.getElementById('csLetter3Image').style.visibility = "true";
      }else{
         document.getElementById('csLetter').style.visibility = "hidden";
         document.getElementById('csLetter2').style.visibility = "hidden";
         document.getElementById('csLetter3').style.visibility = "hidden";
         document.getElementById('csLetterSelect').style.visibility = "hidden";
         document.getElementById('csLetterImage').style.visibility = "hidden";
         document.getElementById('csLetter2Image').style.visibility = "hidden";
         document.getElementById('csLetter3Image').style.visibility = "hidden";
      }
      if(sLetter != '' && sLetterSelect != '' && sLetter2 != '' && late >= 61 && late <= 91){
         document.getElementById('ctLetter').style.visibility = "true";
         document.getElementById('ctLetter2').style.visibility = "true";
         document.getElementById('ctLetter3').style.visibility = "true";
         document.getElementById('ctLetterSelect').style.visibility = "true";
         document.getElementById('ctLetterImage').style.visibility = "true";
         document.getElementById('ctLetter2Image').style.visibility = "true";
         document.getElementById('ctLetter3Image').style.visibility = "true";
      }else{
         document.getElementById('ctLetter').style.visibility = "hidden";
         document.getElementById('ctLetter2').style.visibility = "hidden";
         document.getElementById('ctLetter3').style.visibility = "hidden";
         document.getElementById('ctLetterSelect').style.visibility = "hidden";
         document.getElementById('ctLetterImage').style.visibility = "hidden";
         document.getElementById('ctLetter2Image').style.visibility = "hidden";
         document.getElementById('ctLetter3Image').style.visibility = "hidden";
      }
      if(tLetter != '' && tLetterSelect != '' && tLetter2 != '' && late >= 92){ // up to 107 days late
         document.getElementById('cfdLetter').style.visibility = "true";
         document.getElementById('cfdLetter2').style.visibility = "true";
         document.getElementById('cfdLetter3').style.visibility = "true";
         document.getElementById('cfddLetterSelect').style.visibility = "true";
         document.getElementById('cfdLetterImage').style.visibility = "true";
         document.getElementById('cfdLetter2Image').style.visibility = "true";
         document.getElementById('cfdLetter3Image').style.visibility = "true";
      }else{
         document.getElementById('cfdLetter').style.visibility = "hidden";
         document.getElementById('cfdLetter2').style.visibility = "hidden";
         document.getElementById('cfdLetter3').style.visibility = "hidden";
         document.getElementById('cfdLetterSelect').style.visibility = "hidden";
         document.getElementById('cfdLetterImage').style.visibility = "hidden";
         document.getElementById('cfdLetter2Image').style.visibility = "hidden";
         document.getElementById('cfdLetter3Image').style.visibility = "hidden";
      }
   }
   hiddenLetter();
</script> -->

<script>
  function handleSearch() {
    // Buttons Selectors
    const selectElements = document.querySelectorAll('#corporation select');
    const descriptionInputs = document.querySelectorAll('#corporation input[type=text]');
    const inputFiles = document.querySelectorAll('.corporation-tabs input[type=file]');
    const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
    const creditButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');

        var username = "<?php echo $_SESSION['username']; ?>";
        var bankposition = "<?php echo $_SESSION['bankposition']; ?>";
        var position = "<?php echo $_SESSION['position']; ?>";
        var department = "<?php echo $_SESSION['department']; ?>";

        // Only this Person can Access Aprroval Section
        if (department !== "1" && department !== "6") {
                  selectElements.forEach(function(selectElement) {
                     selectElement.style.pointerEvents = "none";
             });
                  descriptionInputs.forEach(function(descriptionInput) {
                      descriptionInput.style.pointerEvents = "none";
             });
         }
  // REQUIREMENTS RESTRICTION
  if(position!=="BM" && department!=="1"){
      inputFiles.forEach(function(inputFile){
         inputFile.style.display="none";
      });
   }
   if(username!=="jdiokno" && username!=="tmgavituya" && username!=="cevinluan" && department !=="1"){
      document.getElementById("creditInvestigationReportC").style.display="none";
   } 
   if(username!=="tmgavituya" && department !=="1"){
      document.getElementById("collateralAppraisalReportC").style.display="none";
   } 
   if(username!=="irmilano" && department !=="1"){
      document.getElementById("financialEvaluationC").style.display="none";
   } 
   if(username!=="apreyes" && department !=="1"){
      document.getElementById("signedLetterC").style.display="none";
      document.getElementById("signedLoanMemoC").style.display="none";
      document.getElementById("signedLetterUnderEndC").style.display="none";
      // PN-DS-AS
      document.getElementById("promNoteC").style.display="none";
      document.getElementById("disclosureStateC").style.display="none";
      document.getElementById("mriFormC").style.display="none";
      document.getElementById("amortScheduleC").style.display="none";
      // PN-DS-AS END BUYER
      document.getElementById("promNoteEndC").style.display="none";
      document.getElementById("disclosureStateEndC").style.display="none";
      document.getElementById("mriFormEndC").style.display="none";
      document.getElementById("amortScheduleEndC").style.display="none";
   } 
   if(department!=="3" && department !=="1"){
      document.getElementById("remContractC").style.display="none";
      document.getElementById("remContractEndC").style.display="none";
   } 
   if(username!=="jdiokno" && username!=="lverder" && department !=="1"){
      document.getElementById("remContractAnnotatedC").style.display="none";
   } 
   if(bankposition!=="Collection Officer" &&  department !=="1"){
      document.getElementById("utilization").style.display="none";
   } 

   if(department !== "6" && department !== "1"){
      document.getElementById("cfLetter").style.visibility="hidden";
      document.getElementById("cfLetter2").style.visibility="hidden";
      document.getElementById("cfLetter3").style.visibility="hidden";
      document.getElementById("csLetter").style.visibility="hidden";
      document.getElementById("csLetter2").style.visibility="hidden";
      document.getElementById("csLetter3").style.visibility="hidden";
      document.getElementById("ctLetter").style.visibility="hidden";
      document.getElementById("ctLetter2").style.visibility="hidden";
      document.getElementById("ctLetter3").style.visibility="hidden";
      document.getElementById("cfdLetter").style.visibility="hidden";
      document.getElementById("cfdLetter2").style.visibility="hidden";
      document.getElementById("cfdLetter3").style.visibility="hidden";
      document.getElementById("cclientReq1").style.visibility="hidden";
      document.getElementById("cclientReq2").style.visibility="hidden";
      document.getElementById("cclientReq3").style.visibility="hidden";
      // 
      document.getElementById("cffClosure").style.visibility="hidden";
      document.getElementById("cpastLitigation").style.visibility="hidden";
      document.getElementById("cpastLitigation2").style.visibility="hidden";
      document.getElementById("cpastCheck").style.visibility="hidden";
      document.getElementById("label23").style.visibility="hidden";
      document.getElementById("cttLitigation").style.visibility="hidden";
      document.getElementById("cPrepConso").style.visibility="hidden";
      document.getElementById("caDemand").style.visibility="hidden";
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
showText('cfLetterSelect','70%');
showText('csLetterSelect','70%');
showText('ctLetterSelect','70%');
showText('cfdLetterSelect','70%');

showText('cttClosureRemarks','70%');
showText('cpastLitigationSelect','70%');
showText('cttLitigationSelect','70%');
showText('cPrepConsoSelect','70%');
showText('cdDemandRemarks','70%');

showText('cclientReq1Select', '70%');

</script>
</body>
</html>