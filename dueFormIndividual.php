<?php
include('connection.php');
include('fileuploadloan.php');

$id =  $_POST['loanId'];
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
    top: 67% !important;  
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
         $id =  mysqli_real_escape_string($con, $_POST['loanId']);
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
                 $remType=$row['remType'];
                 $branch=$row['branch'];
                 $loanType= $row['loanType'];
                 $sourceIncome= $row['sourceIncome'];
                 
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
         if($type == "REM: Individual") {
            
         ?>
      <script>
         document.getElementById('tab4').classList.add('active');;
         document.getElementById('individual').classList.add('active');
         document.getElementById('tab1').setAttribute('', '');
         document.getElementById('tab2').setAttribute('', '');
         document.getElementById('tab3').setAttribute('', '');
      </script>
      <?php
          $query4 = "SELECT a.*, i.* FROM individual AS i
                              LEFT JOIN indivarchive AS a ON i.indivLoanId = a.a_indivLoanId
                              WHERE i.indivloanId = '$id'
                     ";
         $newdata = mysqli_query($con, $query4);
         $rows = mysqli_fetch_array($newdata);
         
         // PRINCIPAL BORROWER
         $endorsement = $rows['endorsement'];
         $loanAppFormI = $rows['loanAppFormI'];
         $photocopyIdSignatures = $rows['photocopyIdSignatures'];
         $proofBilling = $rows['proofBilling'];
         $personalBank = $rows['personalBank'];
         $marriageContract = $rows['marriageContract'];
         $barangayClearance = $rows['barangayClearance'];
         // COLLATERAL DOCUMENTS
         $transferCertificate = $rows['transferCertificate'];
         $taxDeclarationLot = $rows['taxDeclarationLot'];
         $taxDeclarationImp = $rows['taxDeclarationImp'];
         $realEstateTaxClearance = $rows['realEstateTaxClearance'];
         $realEstateTaxReceipt = $rows['realEstateTaxReceipt'];
         $cancellationDischarge = $rows['cancellationDischarge'];
         // SUNTRUST DOCUMENTS
         $sunTransferCertificate = $rows['sunTransferCertificate'];
         $sunTaxDeclarationLot = $rows['sunTaxDeclarationLot'];
         $sunTaxDeclarationImp = $rows['sunTaxDeclarationImp'];
         $sunContractSell = $rows['sunContractSell'];
         $sunStatementAccount = $rows['sunStatementAccount'];
         // BUSINESS PROOF OF INCOME
         $updatedBusiness = $rows['updatedBusiness'];
         $auditedFinancial = $rows['auditedFinancial'];
         $inhouseFinancial = $rows['inhouseFinancial'];
         $businessBankStatement = $rows['businessBankStatement'];
         $salesRecord = $rows['salesRecord'];
         $incomeTaxReturn = $rows['incomeTaxReturn'];
         $contractLease = $rows['contractLease'];
         $customerNumber = $rows['customerNumber'];
         $customerSupplier = $rows['customerSupplier'];
         $otherIncomeB = $rows['otherIncomeB'];
         // EMPLOYED PROOF OF INCOME
         $employmentContract = $rows['employmentContract'];
         $certificateEmployment = $rows['certificateEmployment'];
         $incomeTax = $rows['incomeTax'];
         $payslipMonths = $rows['payslipMonths'];
         $otherIncome = $rows['otherIncome'];
         // OTHERS
         $powerAttorneyI = $rows['powerAttorneyI'];
         $generalInfo = $rows['generalInfo'];
         $securityExchange = $rows['securityExchange'];
         $letterGuarantee = $rows['letterGuarantee'];
         $boardResolution = $rows['boardResolution'];
         $statementAccountI = $rows['statementAccount'];
         $billMaterial = $rows['billMaterial'];
         $proposedPlan = $rows['proposedPlan'];
         // DOCUMENTS
         $receipt = $rows['receipt'];
         $creditInvestigationReportI = $rows['creditInvestigationReportI'];
         $collateralAppraisalReportI = $rows['collateralAppraisalReportI'];
         $financialEvaluationI = $rows['financialEvaluationI'];
         $signedLetterI = $rows['signedLetterI'];
         $signedLoanMemoI = $rows['signedLoanMemoI'];            
         $remContractI = $rows['remContractI'];
         $promNoteI = $rows['promNoteI'];
         $disclosureStateI = $rows['disclosureStateI'];
         $mriFormI = $rows['mriFormI'];
         $remContractAnnotatedI = $rows['remContractAnnotatedI'];
         $signedLetterUnderEndI = $rows['signedLetterUnderEndI'];
         $remContractEndI = $rows['remContractEndI'];
         $promNoteEndI = $rows['promNoteEndI'];
         $disclosureStateEndI = $rows['disclosureStateEndI'];
         $mriFormEndI = $rows['mriFormEndI'];
         $signedDeedUnderEndI = $rows['signedDeedUnderEndI'];
         $amortScheduleI = $rows['amortScheduleI'];
         $amortScheduleEndI = $rows['amortScheduleEndI'];
         $utilization=$rows['utilization'];
         $powerpoint=$rows['powerpoint'];
         $excel=$rows['excel'];
         // LETTER
         $ifLetter = $rows['ifLetter'];
         $isLetter = $rows['isLetter'];
         $itLetter = $rows['itLetter'];
         $ifdLetter = $rows['ifdLetter'];
         // LETTER2
         $ifLetter2 = $rows['ifLetter2'];
         $isLetter2 = $rows['isLetter2'];
         $itLetter2 = $rows['itLetter2'];
         $ifdLetter2 = $rows['ifdLetter2'];
         // LETTER3
         $ifLetter3 = $rows['ifLetter3'];
         $isLetter3 = $rows['isLetter3'];
         $itLetter3 = $rows['itLetter3'];
         $ifdLetter3 = $rows['ifdLetter3'];
         // OTHER ATTACHMENT
         $iclientReq1 = $rows['iclientReq1'];
         $iclientReq2 = $rows['iclientReq2'];
         $iclientReq3 = $rows['iclientReq3'];

         $iclientReq1Select = $rows['iclientReqRemarks'];
         // LEGAL    
         $iffClosure = $rows['iffClosure'];
         $pastLitigation = $rows['pastLitigation'];
         $pastLitigation2 = $rows['pastLitigation2'];
         $ittLitigation = $rows['ittLitigation'];
         $prepConso = $rows['prepConso'];
         $iaDemand = $rows['iaDemand'];

         //ARCHIVE
         // LETTER
         $a_ifLetter = $rows['ifLetter'];
         $a_isLetter = $rows['isLetter'];
         $a_itLetter = $rows['itLetter'];
         $a_ifdLetter = $rows['ifdLetter'];
         // LETTER2
         $a_ifLetter2 = $rows['ifLetter2'];
         $a_isLetter2 = $rows['isLetter2'];
         $a_itLetter2 = $rows['itLetter2'];
         $a_ifdLetter2 = $rows['ifdLetter2'];
         // LETTER3
         $a_ifLetter3 = $rows['ifLetter3'];
         $a_isLetter3 = $rows['isLetter3'];
         $a_itLetter3 = $rows['itLetter3'];
         $a_ifdLetter3 = $rows['ifdLetter3'];
         // OTHER ATTACHMENT
         $a_iclientReq1 = $rows['iclientReq1'];
         $a_iclientReq2 = $rows['iclientReq2'];
         $a_iclientReq3 = $rows['iclientReq3'];
         $a_iclientReqRemarks = $rows['a_iclientReqRemarks'];

         $a_iffClosure = $rows['a_iffClosure'];
         $a_pastLitigation = $rows['a_pastLitigation'];
         $a_pastLitigation2 = $rows['a_pastLitigation2'];
         $a_ittLitigation = $rows['a_ittLitigation'];
         $a_prepConso = $rows['a_prepConso'];
         $a_iaDemand = $rows['a_iaDemand'];

         
         // GET STATUS 
         // PRINCIPAL BORROWER
         $endorsementSelect = $rows['endorsementStatus'];
         $loanAppFormISelect = $rows['loanAppFormIStatus'];
         $photocopyIdSignaturesSelect = $rows['photocopyIdSignaturesStatus'];
         $proofBillingSelect = $rows['proofBillingStatus'];
         $personalBankSelect = $rows['personalBankStatus'];
         $marriageContractSelect = $rows['marriageContractStatus'];
         $barangayClearanceSelect = $rows['barangayClearanceStatus'];
         // COLLATERAL DOCUMENTS
         $transferCertificateSelect = $rows['transferCertificateStatus'];
         $taxDeclarationLotSelect = $rows['taxDeclarationLotStatus'];
         $taxDeclarationImpSelect = $rows['taxDeclarationImpStatus'];
         $realEstateTaxClearanceSelect = $rows['realEstateTaxClearanceStatus'];
         $realEstateTaxReceiptSelect = $rows['realEstateTaxReceiptStatus'];
         $cancellationDischargeSelect = $rows['cancellationDischarageStatus'];
         // SUNTRUST DOCUMENTS
         $sunTransferCertificateSelect = $rows['sunTransferCertificateStatus'];
         $sunTaxDeclarationLotSelect = $rows['sunTaxDeclarationLotStatus'];
         $sunTaxDeclarationImpSelect = $rows['sunTaxDeclarationImpStatus'];
         $sunContractSellSelect = $rows['sunContractSellStatus'];
         $sunStatementAccountSelect = $rows['sunStatementAccountStatus'];
         // BUSINESS PROOF OF INCOME
         $updatedBusinessSelect = $rows['updatedBusinessStatus'];
         $auditedFinancialSelect = $rows['auditedFinancialStatus'];
         $inhouseFinancialSelect = $rows['inhouseFinancialStatus'];
         $businessBankStatementSelect = $rows['businessBankStatementStatus'];
         $salesRecordSelect = $rows['salesRecordStatus'];
         $incomeTaxReturnSelect = $rows['incomeTaxReturnStatus'];
         $contractLeaseSelect = $rows['contractLeaseStatus'];
         $customerNumberSelect = $rows['customerNumberStatus'];
         $customerSupplierSelect = $rows['customerSupplierStatus'];
         $otherIncomeBSelect = $rows['otherIncomeBStatus'];
         // EMPLOYED PROOF OF INCOME
         $employmentContractSelect = $rows['employmentContractStatus'];
         $certificateEmploymentSelect = $rows['certificateEmploymentStatus'];
         $incomeTaxSelect = $rows['incomeTaxStatus'];
         $payslipMonthsSelect = $rows['payslipMonthsStatus'];
         $otherIncomeSelect = $rows['otherIncomeStatus'];
         // OTHERS
         $powerAttorneyISelect = $rows['powerAttorneyIStatus'];
         $generalInfoSelect = $rows['generalInfoStatus'];
         $securityExchangeSelect = $rows['securityExchangeStatus'];
         $letterGuaranteeSelect = $rows['letterGuaranteeStatus'];
         $boardResolutionSelect = $rows['boardResolutionStatus'];
         $statementAccountSelect = $rows['statementAccountStatus'];
         $billMaterialSelect = $rows['billMaterialStatus'];
         $proposedPlanSelect = $rows['proposedPlanStatus'];
         // DOCUMENTS
         $receiptSelect = $rows['receiptStatus'];
         $creditInvestigationReportISelect = $rows['creditInvestigationReportIStatus'];
         $collateralAppraisalReportISelect = $rows['collateralAppraisalReportIStatus'];
         $financialEvaluationISelect = $rows['financialEvaluationIStatus'];
         $signedLetterISelect = $rows['signedLetterIStatus'];
         $signedLetterUnderEndISelect = $rows['signedLetterUnderEndIStatus'];
         $signedLoanMemoISelect = $rows['signedLoanMemoIStatus'];
         $remContractISelect = $rows['remContractIStatus'];
         $remContractAnnotatedISelect = $rows['remContractAnnotatedIStatus'];
         $promNoteISelect = $rows['promNoteIStatus'];
         $disclosureStateISelect = $rows['disclosureStateIStatus'];
         $mriFormISelect = $rows['mriFormIStatus'];
         $amortScheduleISelect = $rows['amortScheduleIStatus'];
         $remContractEndISelect = $rows['remContractEndIStatus'];
         $promNoteEndISelect = $rows['promNoteEndIStatus'];
         $disclosureStateEndISelect = $rows['disclosureStateEndIStatus'];
         $mriFormEndISelect = $rows['mriFormEndIStatus'];
         $amortScheduleEndISelect = $rows['amortScheduleEndIStatus'];
         $signedDeedUnderEndISelect = $rows['signedDeedUnderEndIStatus'];
         $utilizationSelect=$rows['utilizationStatus'];
         // LETTER SELECT
         $ifLetterSelect = $rows['ifLetterRemarks'];
         $isLetterSelect = $rows['isLetterRemarks'];
         $itLetterSelect = $rows['itLetterRemarks'];
         $ifdLetterSelect = $rows['ifdLetterRemarks'];
         // LEGAL SELECT 
         $iffClosureSelect = $rows['iffClosureRemarks'];
         $pastLitigationSelect = $rows['pastLitigationRemarks'];
         $prepConsoSelect = $rows['prepConsoRemarks'];
         $ittLitigationSelect = $rows['ittLitigationRemarks'];
         $iaDemandSelect = $rows['iaDemandRemarks'];   
         // CHECKBOX
         $powerAttorneyICheck = $rows['powerAttorneyICheck'];
         $generalInfoCheck = $rows['generalInfoCheck'];
         $securityExchangeCheck = $rows['securityExchangeCheck'];
         $letterGuaranteeCheck = $rows['letterGuaranteeCheck'];
         $boardResolutionCheck = $rows['boardResolutionCheck'];
         $statementAccountICheck = $rows['statementAccountICheck'];
         $billMaterialCheck = $rows['billMaterialCheck'];
         $proposedPlanCheck = $rows['proposedPlanCheck'];
         $pastCheck = $rows['pastCheck'];

         $a_pastCheck = $rows['a_pastCheck'];
         }

      // Check If there is a File and File upload button gone and check image visible
      // PRINICIPAL BORROWER
      setFileVisibility($endorsement, "endorsement", "endorsementImage","endorsementButton", $endorsementSelect,"endorsementDate");
      setFileVisibility($loanAppFormI, "loanAppFormI", "loanAppFormIImage","loanAppFormIButton", $loanAppFormISelect,"loanAppFormIDate");
      setFileVisibility($photocopyIdSignatures, "photocopyIdSignatures", "photocopyIdSignaturesImage","photocopyIdSignaturesButton", $photocopyIdSignaturesSelect,"photocopyIdSignaturesDate");
      setFileVisibility($proofBilling, "proofBilling", "proofBillingImage","proofBillingButton", $proofBillingSelect,"proofBillingDate");
      setFileVisibility($personalBank, "personalBank", "personalBankImage", "personalBankButton", $personalBankSelect,"personalBankDate");
      setFileVisibility($marriageContract, "marriageContract", "marriageContractImage", "marriageContractButton", $marriageContractSelect,"marriageContractDate");
      setFileVisibility($barangayClearance, "barangayClearance", "barangayClearanceImage", "barangayClearanceButton", $barangayClearanceSelect,"barangayClearanceDate");
      // COLLATERAL DOCUMENTS
      setFileVisibility($transferCertificate, "transferCertificate", "transferCertificateImage", "transferCertificateButton", $transferCertificateSelect,"transferCertificateDate");
      setFileVisibility($taxDeclarationLot, "taxDeclarationLot", "taxDeclarationLotImage", "taxDeclarationLotButton", $taxDeclarationLotSelect,"taxDeclarationLotDate");
      setFileVisibility($taxDeclarationImp, "taxDeclarationImp", "taxDeclarationImpImage", "taxDeclarationImpButton", $taxDeclarationImpSelect,"taxDeclarationImpDate");
      setFileVisibility($realEstateTaxClearance, "realEstateTaxClearance", "realEstateTaxClearanceImage", "realEstateTaxClearanceButton", $realEstateTaxClearanceSelect,"realEstateTaxClearanceDate");
      setFileVisibility($realEstateTaxReceipt, "realEstateTaxReceipt", "realEstateTaxReceiptImage", "realEstateTaxReceiptButton", $realEstateTaxReceiptSelect,"realEstateTaxReceiptDate");
      setFileVisibility($cancellationDischarge, "cancellationDischarge", "cancellationDischargeImage", "cancellationDischargeButton", $cancellationDischargeSelect,"cancellationDischargeDate");
      // SUNTRUST DOCUMENTS
      setFileVisibility($sunTransferCertificate, "sunTransferCertificate", "sunTransferCertificateImage", "sunTransferCertificateButton", $sunTransferCertificateSelect,"sunTransferCertificateDate");
      setFileVisibility($sunTaxDeclarationLot, "sunTaxDeclarationLot", "sunTaxDeclarationLotImage", "sunTaxDeclarationLotButton", $sunTaxDeclarationLotSelect,"sunTaxDeclarationLotDate");
      setFileVisibility($sunTaxDeclarationImp, "sunTaxDeclarationImp", "sunTaxDeclarationImpImage", "sunTaxDeclarationImpButton", $sunTaxDeclarationImpSelect,"sunTaxDeclarationImpDate");
      setFileVisibility($sunContractSell, "sunContractSell", "sunContractSellImage", "sunContractSellButton", $sunContractSellSelect,"sunContractSellDate");
      setFileVisibility($sunStatementAccount, "sunStatementAccount", "sunStatementAccountImage", "sunStatementAccountButton", $sunStatementAccountSelect,"sunStatementAccountDate");
      // BUSINESS PROOF OF INCOME
      setFileVisibility($updatedBusiness, "updatedBusiness", "updatedBusinessImage", "updatedBusinessButton", $updatedBusinessSelect,"updatedBusinessDate");
      setFileVisibility($auditedFinancial, "auditedFinancial", "auditedFinancialImage", "auditedFinancialButton", $auditedFinancialSelect,"auditedFinancialDate");
      setFileVisibility($inhouseFinancial, "inhouseFinancial", "inhouseFinancialImage", "inhouseFinancialButton", $inhouseFinancialSelect,"inhouseFinancialDate");
      setFileVisibility($businessBankStatement, "businessBankStatement", "businessBankStatementImage", "businessBankStatementButton", $businessBankStatementSelect,"businessBankStatementDate");
      setFileVisibility($salesRecord, "salesRecord", "salesRecordImage", "salesRecordButton", $salesRecordSelect,"salesRecordDate");
      setFileVisibility($incomeTaxReturn, "incomeTaxReturn", "incomeTaxReturnImage", "incomeTaxReturnButton", $incomeTaxReturnSelect,"incomeTaxReturnDate");
      setFileVisibility($contractLease, "contractLease", "contractLeaseImage", "contractLeaseButton", $contractLeaseSelect,"contractLeaseDate");
      setFileVisibility($customerNumber, "customerNumber", "customerNumberImage", "customerNumberButton", $customerNumberSelect,"customerNumberDate");
      setFileVisibility($customerSupplier, "customerSupplier", "customerSupplierImage", "customerSupplierButton", $customerSupplierSelect,"customerSupplierDate");
      setFileVisibility($otherIncomeB, "otherIncomeB", "otherIncomeBImage", "otherIncomeBButton", $otherIncomeBSelect,"otherIncomeBDate");
      // EMPLOYED PROOF OF INCOME
      setFileVisibility($employmentContract, "employmentContract", "employmentContractImage", "employmentContractButton", $employmentContractSelect,"employmentContractDate");
      setFileVisibility($certificateEmployment, "certificateEmployment", "certificateEmploymentImage", "certificateEmploymentButton", $certificateEmploymentSelect,"certificateEmploymentDate");
      setFileVisibility($incomeTax, "incomeTax", "incomeTaxImage", "incomeTaxButton", $incomeTaxSelect,"incomeTaxDate");
      setFileVisibility($payslipMonths, "payslipMonths", "payslipMonthsImage", "payslipMonthsButton", $payslipMonthsSelect,"payslipMonthsDate");
      setFileVisibility($otherIncome, "otherIncome", "otherIncomeImage", "otherIncomeButton", $otherIncomeSelect,"otherIncomeDate");
      //  OTHERS
      setFileVisibility($powerAttorneyI, "powerAttorneyI", "powerAttorneyIImage", "powerAttorneyIButton", $powerAttorneyISelect,"powerAttorneyIDate");
      setFileVisibility($generalInfo, "generalInfo", "generalInfoImage", "generalInfoButton", $generalInfoSelect,"generalInfoDate");
      setFileVisibility($securityExchange, "securityExchange", "securityExchangeImage", "securityExchangeButton", $securityExchangeSelect,"securityExchangeDate");
      setFileVisibility($letterGuarantee, "letterGuarantee", "letterGuaranteeImage", "letterGuaranteeButton", $letterGuaranteeSelect,"letterGuaranteeDate");
      setFileVisibility($boardResolution, "boardResolution", "boardResolutionImage", "boardResolutionButton", $boardResolutionSelect,"boardResolutionDate");
      setFileVisibility($statementAccountI, "statementAccountI", "statementAccountImage", "statementAccountIButton", $statementAccountSelect,"statementAccountIDate");
      setFileVisibility($billMaterial, "billMaterial", "billMaterialImage", "billMaterialButton", $billMaterialSelect,"billMaterialDate");
      setFileVisibility($proposedPlan, "proposedPlan", "proposedPlanImage", "proposedPlanButton", $proposedPlanSelect,"proposedPlanDate");
      //  DOCUMENTS
      setFileVisibility($receipt, "receipt", "receiptImage", "receiptButton", $receiptSelect,"receiptDate");
      setFileVisibility($creditInvestigationReportI, "creditInvestigationReportI", "creditInvestigationReportIImage", "creditInvestigationReportIButton", $creditInvestigationReportISelect,"creditInvestigationReportIDate");
      setFileVisibility($collateralAppraisalReportI, "collateralAppraisalReportI", "collateralAppraisalReportIImage", "collateralAppraisalReportIButton", $collateralAppraisalReportISelect,"collateralAppraisalReportIDate");
      setFileVisibility($financialEvaluationI, "financialEvaluationI", "financialEvaluationIImage", "financialEvaluationIButton", $financialEvaluationISelect,"financialEvaluationIDate");
      setFileVisibility($signedLetterI, "signedLetterI", "signedLetterIImage", "signedLetterIButton", $signedLetterISelect,"signedLetterIDate");
      setFileVisibility($signedLoanMemoI, "signedLoanMemoI", "signedLoanMemoIImage", "signedLoanMemoIButton", $signedLoanMemoISelect,"signedLoanMemoIDate");
      setFileVisibility($remContractI, "remContractI", "remContractIImage", "remContractIButton", $remContractISelect,"remContractIDate");
      setFileVisibility($promNoteI, "promNoteI", "promNoteIImage", "promNoteIButton", $promNoteISelect,"promNoteIDate");
      setFileVisibility($disclosureStateI, "disclosureStateI", "disclosureStateIImage", "disclosureStateIButton", $disclosureStateISelect,"disclosureStateIDate");
      setFileVisibility($mriFormI, "mriFormI", "mriFormIImage", "mriFormIButton", $mriFormISelect,"mriFormIDate");
      setFileVisibility($remContractAnnotatedI, "remContractAnnotatedI", "remContractAnnotatedIImage", "remContractAnnotatedIButton", $remContractAnnotatedISelect,"remContractAnnotatedIDate");
      setFileVisibility($signedLetterUnderEndI, "signedLetterUnderEndI", "signedLetterUnderEndIImage", "signedLetterUnderEndIButton", $signedLetterUnderEndISelect,"signedLetterUnderEndIDate");
      setFileVisibility($remContractEndI, "remContractEndI", "remContractEndIImage", "remContractEndIButton", $remContractEndISelect,"remContractEndIDate");
      setFileVisibility($promNoteEndI, "promNoteEndI", "promNoteEndIImage", "promNoteEndIButton", $promNoteEndISelect,"promNoteEndIDate");
      setFileVisibility($disclosureStateEndI, "disclosureStateEndI", "disclosureStateEndIImage", "disclosureStateEndIButton", $disclosureStateEndISelect,"disclosureStateEndIDate");
      setFileVisibility($mriFormEndI, "mriFormEndI", "mriFormEndIImage", "mriFormEndIButton", $mriFormEndISelect,"mriFormEndIDate");
      setFileVisibility($signedDeedUnderEndI, "signedDeedUnderEndI", "signedDeedUnderEndIImage", "signedDeedUnderEndIButton", $signedDeedUnderEndISelect,"signedDeedUnderEndIDate");
      setFileVisibility($amortScheduleI, "amortScheduleI", "amortScheduleIImage", "amortScheduleIButton", $amortScheduleISelect,"amortScheduleIDate");
      setFileVisibility($amortScheduleEndI, "amortScheduleEndI", "amortScheduleEndIImage", "amortScheduleEndIButton", $amortScheduleEndISelect,"amortScheduleEndIDate");
      setFileVisibility($utilization, "utilization", "utilizationImage", "utilizationButton", $utilizationSelect,"utilizationDate");
      setFileVisibility($excel, "excel", "excelImage", "excelButton", "","excelDate");
      setFileVisibility($powerpoint, "powerpoint", "powerpointImage", "powerpointButton", "","powerpointDate");
      // LETTER
      setFileVisibility($ifLetter, "forifLetter", "ifLetterImage", "ifLetterButton", $ifLetterSelect,"ifLetterDate");
      setFileVisibility($isLetter, "forisLetter", "isLetterImage", "isLetterButton", $isLetterSelect,"isLetterDate");
      setFileVisibility($itLetter, "foritLetter", "itLetterImage", "itLetterButton", $itLetterSelect,"itLetterDate");
      setFileVisibility($ifdLetter, "forifdLetter", "ifdLetterImage", "ifdLetterButton", $ifdLetterSelect,"ifdLetterDate");
      // LETTER2
      setFileVisibility($ifLetter2, "forifLetter2", "ifLetter2Image", "ifLetter2Button", "","");
      setFileVisibility($isLetter2, "forisLetter2", "isLetter2Image", "isLetter2Button", "","");
      setFileVisibility($itLetter2, "foritLetter2", "itLetter2Image", "itLetter2Button", "","");
      setFileVisibility($ifdLetter2, "forifdLetter2", "ifdLetter2Image", "ifdLetter2Button", "","");
      // LETTER3
      setFileVisibility($ifLetter3, "forifLetter3", "ifLetter3Image", "ifLetter3Button", "","");
      setFileVisibility($isLetter3, "forisLetter3", "isLetter3Image", "isLetter3Button", "","");
      setFileVisibility($itLetter3, "foritLetter3", "itLetter3Image", "itLetter3Button", "","");
      setFileVisibility($ifdLetter3, "forifdLetter3", "ifdLetter3Image", "ifdLetter3Button", "","");
      // OTHER ATTACHMENT
      setFileVisibility($iclientReq1, "foriclientReq1", "iclientReq1Image", "iclientReq1Button", $iclientReq1Select, "iclientReq1Date");
      setFileVisibility($iclientReq2, "foriclientReq2", "iclientReq2Image", "iclientReq2Button", "", "");
      setFileVisibility($iclientReq3, "foriclientReq3", "iclientReq3Image", "iclientReq3Button", "", "");
      // LEGAL
      setFileVisibility($iffClosure, "foriffClosure", "iffClosureImage", "iffClosureButton", $iffClosureSelect,"iffClosureDate");
      setFileVisibility($pastLitigation, "forpastLitigation", "pastLitigationImage", "pastLitigationButton", $pastLitigationSelect,"pastLitigationDate");
      setFileVisibility($pastLitigation2, "forpastLitigation2", "pastLitigation2Image", "pastLitigation2Button", "","");
      setFileVisibility($ittLitigation, "forittLitigation", "ittLitigationImage", "ittLitigationButton", $ittLitigationSelect,"ittLitigationDate");
      setFileVisibility($prepConso, "forprepConso", "prepConsoImage", "prepConsoButton", $prepConsoSelect,"prepConsoDate");
      setFileVisibility($iaDemand, "foriaDemand", "iaDemandImage", "iaDemandButton", $iaDemandSelect,"iaDemandDate");
      
         // The NUMBER OF PERCENTAGE
         $principalBorrower=array($loanAppFormISelect, $photocopyIdSignaturesSelect, $proofBillingSelect, $personalBankSelect, $marriageContractSelect, $barangayClearanceSelect);

         $collateralDocuments=array($transferCertificateSelect, $taxDeclarationLotSelect, $taxDeclarationImpSelect, $realEstateTaxClearanceSelect, $realEstateTaxReceiptSelect);
         
         $suntrustDocuments=array($sunTransferCertificateSelect, $sunTaxDeclarationLotSelect, $sunTaxDeclarationImpSelect, $sunContractSellSelect, $sunStatementAccountSelect);
         
         $businessIncome=array($updatedBusinessSelect, $auditedFinancialSelect, $inhouseFinancialSelect, $businessBankStatementSelect, $incomeTaxReturnSelect, $contractLeaseSelect, $customerNumberSelect, $customerSupplierSelect);
         
         $employedIncome=array($certificateEmploymentSelect, $payslipMonthsSelect);
         
         $documents=array($creditInvestigationReportISelect, $collateralAppraisalReportISelect, $financialEvaluationISelect, $signedLetterISelect, $signedLoanMemoISelect);
         
         $endBuyerDocuments=array($signedLetterUnderEndISelect, $remContractEndISelect, $promNoteEndISelect, $disclosureStateEndISelect, $mriFormEndISelect,$amortScheduleEndISelect);
         
         $notEndBuyerDocuments=array($remContractISelect, $remContractAnnotatedISelect, $promNoteISelect, $disclosureStateISelect, $mriFormISelect, $amortScheduleISelect);
         
         if($remType=="End Buyer"){
         $numberOfFilesUploaded = array_merge($principalBorrower, $suntrustDocuments, $endBuyerDocuments, $documents);
         
         if($sourceIncome=="Business"){
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $businessIncome);
         }
         else{
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $employedIncome);
         }

         }
         else{
         $numberOfFilesUploaded = array_merge($principalBorrower, $collateralDocuments, $notEndBuyerDocuments, $documents);
         if($sourceIncome=="Business"){
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $businessIncome);
         }
         else{
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $employedIncome);
         }
         }
         // Filter out empty values from the array
         // Max Number Of Overall File Base on Condition
         $maxCount=count($numberOfFilesUploaded);
         // echo $maxCount;

         // ONLY COUNT SELECT THAT HAS VALUE == 1
         $nonEmptyFileInputs = array_filter($numberOfFilesUploaded,function($value) {
            $parts = explode("--", $value);
            return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
        });;
         
         // Count the number of non-empty values
         $numberOfFilesUploaded = count($nonEmptyFileInputs);
         // Calculate the percentage
         $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         
         // echo count($numberOfFilesUploaded);
         
         ?>
      <div class="container py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><strong><?php echo "$fullname &nbsp; $birth &nbsp; $loanType &nbsp; $type &nbsp; $sourceIncome &nbsp; $remType"; ?></strong></h3></label>
         </div>
         <div class="col-12" style="text-align:left; margin-left:0.5%;">
            <!-- The PERCENTAGE CIRCLE -->
            <!-- <label class="text-white bg-success">LOAN PROGRESS :</label> -->
            <div class="progress" style="display: inline-block; min-width: 99%; vertical-align:bottom; height: 100%; font-size:130%">
               <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: <?php echo $percentage.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage.'%';?></div>
            </div>
            <div id="myModal" class="modal" style="margin-top:5%; margin-left:20%; width:50%; height:500px;">
               <div class="modal-content" style="height:50%;">
                  <span class="close" id="closeModal" style= "font-size:2em; margin-left:95%"><i class="fa fa-times" aria-hidden="true"></i></span>
                  <p><h1 id="modalText"></h1></p>
               </div>
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
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab4" href="#individual">Real Estate Mortgage - Individual</a>
                     </li>
                  </ul>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="individual" class="tab-pane active"  style=" border: 1px solid #ccc;">
                              <form id="individual-form" action="loanIndividualUploadData.php" method="POST" enctype="multipart/form-data">
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
                                       <div class="individual-tabs" style=" border-right: 1px solid #ccc; min-height: 122%; margin-bottom:0; margin-top:-0.5%;">
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
                                                   <label class="individual-labels" id="tab-label" for="custom"> ENDORSEMENT LETTER</label>
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
                                                   <label class="individual-labels" id="tab-label" for="custom">LOAN APPLICATION FORM</label>
                                                   <input type="file" id="loanAppFormI" name="loanAppFormI"><img id="loanAppFormIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppFormI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormIButton">Open File</button></a>
                                                   <label class="date-label" id="loanAppFormIDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormI, strrpos($loanAppFormI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="loanAppFormISelect" name="loanAppFormISelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="loanAppFormIDesc" name="loanAppFormIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED IDs WITH 3 SIGNATURES -->
                                          <div class="row">
                                             <div class="col-8">

                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED IDs WITH 3 SIGNATURES</label>
                                                   <input type="file" id="photocopyIdSignatures" name="photocopyIdSignatures"><img id="photocopyIdSignaturesImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $photocopyIdSignatures; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="photocopyIdSignaturesButton">Open File</button></a>
                                                   <label class="date-label" id="photocopyIdSignaturesDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($photocopyIdSignatures, strrpos($photocopyIdSignatures, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="photocopyIdSignaturesSelect" name="photocopyIdSignaturesSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="photocopyIdSignaturesDesc" name="photocopyIdSignaturesDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- PROOF OF BILLING (MERALCO, INTERNET BILL, WATER BILL) -->
                                            <div class="row">
                                             <div class="col-8">
                                               <div class="py-2" >
                                                <label class ="individual-labels" id="tab-label" for="custom">PROOF OF BILLING (MERALCO, INTERNEET BILL, WATER BILL)</label>
                                                <input type="file" id="proofBilling" name="proofBilling"><img id="proofBillingImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $proofBilling; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofBillingButton" >Open File</button></a>
                                                <label class="date-label" id="proofBillingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label>
                                              </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex" >
                                                <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "proofBillingSelect" name = "proofBillingSelect" tabindex="-1">
                                                <option selected value= "NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                                <option value="3">N/A</option>
                                                </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proofBillingDesc" name = "proofBillingDesc" >&nbsp;
                                              </div>
                                             </div>
                                          </div>
                                           <!-- PERSONAL-BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">PERSONAL-BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS</label>
                                                   <input type="file" id="personalBank" name="personalBank"><img id="personalBankImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $personalBank; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="personalBankButton">Open File</button></a>
                                                   <label class="date-label" id="personalBankDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($personalBank, strrpos($personalBank, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                          <div class="col-4">
                                           <div class="form-group d-flex mb-4" >
                                              <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "personalBankSelect" name = "personalBankSelect" tabindex="-1">
                                                <option selected value= "NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                                <option value="2">N/A</option>
                                             </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="personalBankDesc" name = "personalBankDesc" >&nbsp;
                                        </div>
                                     </div>
                                    </div>
                                           <!-- MARRIAGE CONTRACT (IF MARRIED) *CENOMAR (IF SINGLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">MARRIAGE CONTRACT (IF MARRIED) *CENOMAR (IF SINGLE)</label>
                                                   <input type="file" id="marriageContract" name="marriageContract"><img id="marriageContractImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $marriageContract; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="marriageContractButton">Open File</button></a>
                                                   <label class="date-label" id="marriageContractDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($marriageContract, strrpos($marriageContract, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="marriageContractSelect" name="marriageContractSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="marriageContractDesc" name="marriageContractDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BARANGAY CLEARANCE FOR LOAN PURPOSE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">BARANGAY CLEARANCE FOR LOAN PURPOSE</label>
                                                   <input type="file" id="barangayClearance" name="barangayClearance"><img id="barangayClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $barangayClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="barangayClearanceButton">Open File</button></a>
                                                   <label class="date-label" id="barangayClearanceDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($barangayClearance, strrpos($barangayClearance, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="barangayClearanceSelect" name="barangayClearanceSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="barangayClearanceDesc" name="barangayClearanceDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--DIV HERE FOR COLLATERAL  -->
                                          <div class="collateralDocuments" id="collateralDocuments" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>COLLATERAL DOCUMENTS</u></label></div>
                                                </div>
                                             </div>
                                             <!-- TRANSFER CERTIFICATE OF TITLE (ORIGINAL & CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   
                                                   <div class="py-2">
                                                      <label class="individual-labels" id="tab-label" for="custom">TRANSFER CERTIFICATE OF TITLE (ORIGINAL & CERTIFIED TRUE COPY)</label>
                                                      <input type="file" id="transferCertificate" name="transferCertificate"><img id="transferCertificateImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $transferCertificate; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="transferCertificateButton">Open File</button></a>
                                                      <label class="date-label" id="transferCertificateDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($transferCertificate, strrpos($transferCertificate, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-1">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="transferCertificateSelect" name="transferCertificateSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="transferCertificateDesc" name="transferCertificateDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (LOT - CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels" id="tab-label" for="custom">TAX DECLARATION <br> (LOT - CERTIFIED TRUE COPY)</label>
                                                      <input type="file" id="taxDeclarationLot" name="taxDeclarationLot"><img id="taxDeclarationLotImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $taxDeclarationLot; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationLotButton">Open File</button></a>
                                                      <label class="date-label" id="taxDeclarationLotDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclarationLot, strrpos($taxDeclarationLot, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclarationLotSelect" name="taxDeclarationLotSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationLotDesc" name="taxDeclarationLotDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (IMPROVEMENT - CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">TAX DECLARATION (IMPROVEMENT - CERTIFIED TRUE COPY)  </label>
                                                      <input type="file" id="taxDeclarationImp" name="taxDeclarationImp"><img id="taxDeclarationImpImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $taxDeclarationImp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationImpButton" >Open File</button></a>
                                                      <label class="date-label" id="taxDeclarationImpDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclarationImp, strrpos($taxDeclarationImp, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "taxDeclarationImpSelect" name = "taxDeclarationImpSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationImpDesc" name = "taxDeclarationImpDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!-- REAL ESTATE TAX CLEARANCE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">REAL ESTATE TAX CLEARANCE </label>
                                                      <input type="file" id="realEstateTaxClearance" name="realEstateTaxClearance"><img id="realEstateTaxClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $realEstateTaxClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxClearanceButton" >Open File</button></a>
                                                      <label class="date-label" id="realEstateTaxClearanceDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxClearance, strrpos($realEstateTaxClearance, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "realEstateTaxClearanceSelect" name = "realEstateTaxClearanceSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="realEstateTaxClearanceDesc" name = "realEstateTaxClearanceDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!--REAL ESTATE TAX RECEIPT   -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">REAL ESTATE TAX RECEIPT (AMILYAR) </label>
                                                      <input type="file" id="realEstateTaxReceipt" name="realEstateTaxReceipt"><img id="realEstateTaxReceiptImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $realEstateTaxReceipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxReceiptButton" >Open File</button></a>
                                                      <label class="date-label" id="realEstateTaxReceiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxReceipt, strrpos($realEstateTaxReceipt, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "realEstateTaxReceiptSelect" name = "realEstateTaxReceiptSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="realEstateTaxReceiptDesc" name = "realEstateTaxReceiptDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!--CANCELLATION AND DISCHARGE OF MORTGAGE (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">CANCELLATION AND DISCHARGE OF MORTGAGE (IF APPLICABLE)</label>
                                                      <input type="file" id="cancellationDischarge" name="cancellationDischarge"><img id="cancellationDischargeImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $cancellationDischarge; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cancellationDischargeButton" >Open File</button></a>
                                                      <label class="date-label" id="cancellationDischargeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cancellationDischarge, strrpos($cancellationDischarge, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "cancellationDischargeSelect" name = "cancellationDischargeSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cancellationDischargeDesc" name = "cancellationDischargeDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="suntrustDocuments" id="suntrustDocuments" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>SUNTRUST DOCUMENTS</u></label></div>
                                                </div>
                                             </div>
                                              <!-- COPY OF TRANSFER CERTIFICATE OF TITLE-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">COPY OF TRANSFER CERTIFICATE OF TITLE </label>
                                                      <input type="file" id="sunTransferCertificate" name="sunTransferCertificate"><img id="sunTransferCertificateImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $sunTransferCertificate; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTransferCertificateButton" >Open File</button></a>
                                                      <label class="date-label" id="sunTransferCertificateDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTransferCertificate, strrpos($sunTransferCertificate, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "sunTransferCertificateSelect" name = "sunTransferCertificateSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="sunTransferCertificateDesc" name = "sunTransferCertificateDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (LOT-COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">TAX DECLARATION (LOT-COPY)  </label>
                                                      <input type="file" id="sunTaxDeclarationLot" name="sunTaxDeclarationLot"><img id="sunTaxDeclarationLotImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $sunTaxDeclarationLot; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTaxDeclarationLotButton" >Open File</button></a>
                                                      <label class="date-label" id="sunTaxDeclarationLotDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTaxDeclarationLot, strrpos($sunTaxDeclarationLot, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunTaxDeclarationLotSelect" name = "sunTaxDeclarationLotSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunTaxDeclarationLotDesc" name = "sunTaxDeclarationLotDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (IMPROVEMENT - COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">TAX DECLARATION (IMPROVEMENT - COPY) </label>
                                                      <input type="file" id="sunTaxDeclarationImp" name="sunTaxDeclarationImp"><img id="sunTaxDeclarationImpImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunTaxDeclarationImp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTaxDeclarationImpButton" >Open File</button></a>
                                                      <label class="date-label" id="sunTaxDeclarationImpDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTaxDeclarationImp, strrpos($sunTaxDeclarationImp, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunTaxDeclarationImpSelect" name = "sunTaxDeclarationImpSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunTaxDeclarationImpDesc" name = "sunTaxDeclarationImpDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--CONTRACT TO SELL   -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">CONTRACT TO SELL  </label>
                                                      <input type="file" id="sunContractSell" name="sunContractSell"><img id="sunContractSellImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunContractSell; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunContractSellButton" >Open File</button></a>
                                                      <label class="date-label" id="sunContractSellDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunContractSell, strrpos($sunContractSell, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunContractSellSelect" name = "sunContractSellSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunContractSellDesc" name = "sunContractSellDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY</label>
                                                      <input type="file" id="sunStatementAccount" name="sunStatementAccount"><img id="sunStatementAccountImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunStatementAccount; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunStatementAccountButton" >Open File</button></a>
                                                      <label class="date-label" id="sunStatementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunStatementAccount, strrpos($sunStatementAccount, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                    <!-- STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY  -->
                                                  <div class="form-group d-flex mb-2">
                                                    <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunStatementAccountSelect" name = "sunStatementAccountSelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                               </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunStatementAccountDesc" name = "sunStatementAccountDesc" >&nbsp;
                                                  </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- here end -->
                                          <!-- BUSUINESS PROOF OF INCOME -->
                                          <div class="businessProofIncome" id="businessProofIncome" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>BUSINESS PROOF OF INCOME</u></label></div>
                                                </div>
                                             </div>
                                             <!-- UPDATED BUSINESS PERMIT (MAYOR'S, BARANGAY AND/OR DTI)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> UPDATED BUSINESS PERMIT <br> (MAYOR'S, BARANGAY AND/OR DTI)</label> 
                                                      <input type="file" id="updatedBusiness" name="updatedBusiness"><img id="updatedBusinessImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $updatedBusiness; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="updatedBusinessButton" >Open File</button></a>
                                                      <label class="date-label" id="updatedBusinessDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($updatedBusiness, strrpos($updatedBusiness, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "updatedBusinessSelect" name = "updatedBusinessSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="updatedBusinessDesc" name = "updatedBusinessDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--AUDITED FINANCIAL STATEMENT (3 YEARS)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">AUDITED FINANCIAL STATEMENT <br>(3 YEARS)</i></label> 
                                                      <input type="file" id="auditedFinancial" name="auditedFinancial"><img id="auditedFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $auditedFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="auditedFinancialButton">Open File</button></a>
                                                      <label class="date-label" id="auditedFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($auditedFinancial, strrpos($auditedFinancial, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "auditedFinancialSelect" name = "auditedFinancialSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="auditedFinancialDesc" name = "auditedFinancialDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- IN-HOUSE FINANCIAL STATEMENT (3 YEARS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">IN-HOUSE FINANCIAL STATEMENT <br> (3 YEARS) </label>
                                                      <input type="file" id="inhouseFinancial" name="inhouseFinancial"><img id="inhouseFinancialImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $inhouseFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="inhouseFinancialButton" >Open File</button></a>
                                                      <label class="date-label" id="inhouseFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($inhouseFinancial, strrpos($inhouseFinancial, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inhouseFinancialSelect" name = "inhouseFinancialSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="inhouseFinancialDesc" name = "inhouseFinancialDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- BUSINESS - BANK STATEMENT OR PASSBOOK FOR THE LAST 6 MONTHS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> BUSINESS - BANK STATEMENT OR PASSBOOK FOR THE LAST 6 MONTHS </label>
                                                      <input type="file" id="businessBankStatement" name="businessBankStatement"><img id="businessBankStatementImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $businessBankStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessBankStatementButton">Open File</button></a>
                                                      <label class="date-label" id="businessBankStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessBankStatement, strrpos($businessBankStatement, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "businessBankStatementSelect" name = "businessBankStatementSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="businessBankStatementDesc" name = "businessBankStatementDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- SALES RECORD & PURCHASES RECEIPTS OR LOGBOOK -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> SALES RECORD & PURCHASES RECEIPTS OR LOGBOOK (IF APPLICABLE) </label>
                                                      <input type="file" id="salesRecord" name="salesRecord"><img id="salesRecordImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $salesRecord; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="salesRecordButton">Open File</button></a>
                                                      <label class="date-label" id="salesRecordDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($salesRecord, strrpos($salesRecord, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "salesRecordSelect" name = "salesRecordSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="salesRecordDesc" name = "salesRecordDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!--INCOME TAX RETURN (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">INCOME TAX RETURN (IF APPLICABLE) </label> 
                                                      <input type="file" id="incomeTaxReturn" name="incomeTaxReturn"><img id="incomeTaxReturnImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $incomeTaxReturn; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxReturnButton" >Open File</button></a>
                                                      <label class="date-label" id="incomeTaxReturnDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTaxReturn, strrpos($incomeTaxReturn, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "incomeTaxReturnSelect" name = "incomeTaxReturnSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxReturnDesc" name = "incomeTaxReturnDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- CONTRACT OF LEASE (IF RENTAL BUSINESS)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">CONTRACT OF LEASE (IF RENTAL BUSINESS)</label> 
                                                      <input type="file" id="contractLease" name="contractLease"><img id="contractLeaseImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $contractLease; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractLeaseButton" >Open File</button></a>
                                                      <label class="date-label" id="contractLeaseDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractLease, strrpos($contractLease, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "contractLeaseSelect" name = "contractLeaseSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractLeaseDesc" name = "contractLeaseDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- 5 CUSTOMERS WITH CONTACT NUMBER  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> 5 CUSTOMERS WITH CONTACT NUMBER</label> 
                                                      <input type="file" id="customerNumber" name="customerNumber"><img id="customerNumberImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $customerNumber; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerNumberButton" >Open File</button></a>
                                                      <label class="date-label" id="customerNumberDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerNumber, strrpos($customerNumber, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "customerNumberSelect" name = "customerNumberSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerNumberDesc" name = "customerNumberDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- 5 SUPPLIERS WITH CONTACT NUMBER -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> 5 SUPPLIERS WITH CONTACT NUMBER</label>
                                                      <input type="file" id="customerSupplier" name="customerSupplier"><img id="customerSupplierImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $customerSupplier; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerSupplierButton" >Open File</button></a>
                                                      <label class="date-label" id="customerSupplierDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerSupplier, strrpos($customerSupplier, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "customerSupplierSelect" name = "customerSupplierSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerSupplierDesc" name = "customerSupplierDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- OTHER SOURCE OF INCOME -->
                                               <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> OTHER SOURCE OF INCOME <br> (IF APPLICABLE)</label>
                                                      <input type="file" id="otherIncomeB" name="otherIncomeB"><img id="otherIncomeBImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $otherIncomeB; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherIncomeBButton" >Open File</button></a>
                                                      <label class="date-label" id="otherIncomeBDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherIncomeB, strrpos($otherIncomeB, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherIncomeBSelect" name = "otherIncomeBSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="otherIncomeBDesc" name = "otherIncomeBDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             
                                          </div>
                                           <!-- FOR SPACE BUSINESS-->
                                             <div class="row">
                                              <div class="col-8" id="businessSpace" style="margin-bottom:-2%; "></div>
                                           </div>
                                          <!-- EMPLOYED PROOF OF INCOME -->
                                          <div class="employedProofIncome" id="employedProofIncome" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3 mt-4"><label style="font-size:120%"><u>EMPLOYED PROOF OF INCOME</u></label></div>
                                                </div>
                                             </div>
                                             <!-- EMPLOYMENT CONTRACT (IF APPLICABLE)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">EMPLOYMENT CONTRACT <br> (IF APPLICABLE)</label> 
                                                      <input type="file" id="employmentContract" name="employmentContract"><img id="employmentContractImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $employmentContract; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="employmentContractButton" >Open File</button></a>
                                                      <label class="date-label" id="employmentContractDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($employmentContract, strrpos($employmentContract, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "employmentContractSelect" name = "employmentContractSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="employmentContractDesc" name = "employmentContractDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- CERTIFICATE OF EMPLOYMENT WITH COMPENSATION  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">
                                                      <label class ="individual-labels" id="tab-label" for="custom"> CERTIFICATE OF EMPLOYMENT WITH COMPENSATION</label> 
                                                      <input type="file" id="certificateEmployment" name="certificateEmployment"><img id="certificateEmploymentImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $certificateEmployment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="certificateEmploymentButton" >Open File</button></a>
                                                      <label class="date-label" id="certificateEmploymentDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($certificateEmployment, strrpos($certificateEmployment, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "certificateEmploymentSelect" name = "certificateEmploymentSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="certificateEmploymentDesc" name = "certificateEmploymentDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- INCOME TAX RETURN -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> INCOME TAX RETURN (IF APPLICABLE)</label>
                                                      <input type="file" id="incomeTax" name="incomeTax"><img id="incomeTaxImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $incomeTax; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxButton" >Open File</button></a>
                                                      <label class="date-label" id="incomeTaxDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTax, strrpos($incomeTax, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "incomeTaxSelect" name = "incomeTaxSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxDesc" name = "incomeTaxDesc">
                                                   </div>
                                                </div>
                                             </div>

                                             <!-- PAYSLIP FOR 6 MONTHS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> PAYSLIP FOR 6 MONTHS</label>
                                                      <input type="file" id="payslipMonths" name="payslipMonths"><img id="payslipMonthsImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $payslipMonths; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="payslipMonthsButton" >Open File</button></a>
                                                      <label class="date-label" id="payslipMonthsDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($payslipMonths, strrpos($payslipMonths, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "payslipMonthsSelect" name = "payslipMonthsSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="payslipMonthsDesc" name = "payslipMonthsDesc">
                                                   </div>
                                                </div>
                                             </div>
                                          <!-- OTHER SOURCE OF INCOME -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> OTHER SOURCE OF INCOME <br> (IF APPLICABLE)</label>
                                                      <input type="file" id="otherIncome" name="otherIncome"><img id="otherIncomeImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $otherIncome; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherIncomeButton" >Open File</button></a>
                                                      <label class="date-label" id="otherIncomeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherIncome, strrpos($otherIncome, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherIncomeSelect" name = "otherIncomeSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="otherIncomeDesc" name = "otherIncomeDesc">
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
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 my-4"><br>
                                    <div class="row">
                                       <div class="col-8" style="border-right:0;">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">DOCUMENTS</h1>
                                       </div>
                                       <div class="col-4">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 100%;">APPROVAL</h1>
                                       </div>
                                       </div>
                                       <div class="document-labels">
                                          <div class="row">
                                              <div class="col-8" style="height:1em; margin-top:-0.5%;"></div>
                                           </div>
                                           <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:130%"><u>DOCUMENT REPORTS AND CASHFLOW ANALYSIS</u></label></div>
                                             </div>
                                          </div>
                                         <!-- APPRAISAL FEE RECEIPT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label">APPRAISAL FEE RECEIPT</label>
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
                                           <!-- CREDIT INVESTIGATION AND CREDIT INBESTIGATION REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <label class ="individual-labels">CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT</label>
                                                   <input type="file" id="creditInvestigationReportI" name="creditInvestigationReportI"><img id="creditInvestigationReportIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $creditInvestigationReportI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportIButton">Open File</button></a>
                                                   <label class="date-label" id="creditInvestigationReportIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportI, strrpos($creditInvestigationReportI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select  class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "creditInvestigationReportISelect" name = "creditInvestigationReportISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="creditInvestigationReportIDesc" name = "creditInvestigationReportIDesc"  >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- APPRAISE THE PROPERTY AND COLLATERAL APPRIASAL REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class ="individual-labels">APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT</label>
                                                   <input type="file" id="collateralAppraisalReportI" name="collateralAppraisalReportI"><img id="collateralAppraisalReportIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $collateralAppraisalReportI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="collateralAppraisalReportIButton">Open File</button></a> 
                                                   <label class="date-label" id="collateralAppraisalReportIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($collateralAppraisalReportI, strrpos($collateralAppraisalReportI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select  class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "collateralAppraisalReportISelect" name = "collateralAppraisalReportISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="collateralAppraisalReportIDesc" name = "collateralAppraisalReportIDesc"  >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREDBOARD -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD </label>
                                                   <input type="file" id="financialEvaluationI" name="financialEvaluationI"><img id="financialEvaluationIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $financialEvaluationI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="financialEvaluationIButton">Open File</button></a> 
                                                   <label class="date-label" id="financialEvaluationIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($financialEvaluationI, strrpos($financialEvaluationI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "financialEvaluationISelect" name = "financialEvaluationISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="financialEvaluationIDesc" name = "financialEvaluationIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:135%"><u>SIGNING OF APPROVAL</u></label></div>
                                             </div>
                                          </div>
                                            <!-- SIGNED LETTER OF APPROVAL -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; SIGNED LETTER OF APPROVAL </label>
                                                   <input type="file" id="signedLetterI" name="signedLetterI"><img id="signedLetterIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLetterI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterIButton">Open File</button></a>
                                                   <label class="date-label" id="signedLetterIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterI, strrpos($signedLetterI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "signedLetterISelect" name = "signedLetterISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterIDesc" name = "signedLetterIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- END BUYER SECTION -->
                                          <div class="endBuyerUnder" id="endBuyerUnder" style="display:none;">
                                              <!-- SIGNED LETTER OF UNDERTAKING -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2 mt-3">
                                                      <label class="individual-labels">&#x2022; SIGNED LETTER OF UNDERTAKING </label>
                                                      <input type="file" id="signedLetterUnderEndI" name="signedLetterUnderEndI"><img id="signedLetterUnderEndIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedLetterUnderEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterUnderEndIButton">Open File</button></a>
                                                      <label class="date-label" id="signedLetterUnderEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterUnderEndI, strrpos($signedLetterUnderEndI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mt-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedLetterUnderEndISelect" name = "signedLetterUnderEndISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterUnderEndIDesc" name = "signedLetterUnderEndIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE</u></label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; SIGNED LOAN APPROVAL MEMO </label>
                                                   <input type="file" id="signedLoanMemoI" name="signedLoanMemoI"><img id="signedLoanMemoIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLoanMemoI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLoanMemoIButton">Open File</button></a>
                                                   <label class="date-label" id="signedLoanMemoIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLoanMemoI, strrpos($signedLoanMemoI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedLoanMemoISelect" name = "signedLoanMemoISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   <input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLoanMemoIDesc" name = "signedLoanMemoIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- Not End Buyer Section -->
                                          <div class="notEndBuyer" id="notEndBuyer" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><u>SIGNING OF REM CONTRACT</u></label></div>
                                                </div>
                                             </div>
                                             <!-- SIGNED REAL ESTATE MORTGAGE CONTRACT --> 
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; SIGNED REAL ESTATE MORTGAGE CONTRACT</label>
                                                      <input type="file" id="remContractI" name="remContractI"><img id="remContractIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractIButton">Open File</button></a>
                                                      <label class="date-label" id="remContractIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractI, strrpos($remContractI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "remContractISelect" name = "remContractISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractIDesc" name = "remContractIDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><u>REGISTRATION IN REGISTRY OF DEEDS</u></label></div>
                                                </div>
                                             </div>
                                             <!-- REM CONTRACT ANNOTATED -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; REM CONTRACT ANNOTATED</label>
                                                      <input type="file" id="remContractAnnotatedI" name="remContractAnnotatedI"><img id="remContractAnnotatedIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractAnnotatedI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractAnnotatedIButton">Open File</button></a>
                                                      <label class="date-label" id="remContractAnnotatedIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractAnnotatedI, strrpos($remContractAnnotatedI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "remContractAnnotatedISelect" name = "remContractAnnotatedISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractAnnotatedIDesc" name = "remContractAnnotatedIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><u>SIGNED DOCUMENTS AFTER THE RELEASE OF THE LOAN</u></label></div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; PROMISSORY NOTE </label>
                                                      <input type="file" id="promNoteI" name="promNoteI"><img id="promNoteIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteIButton">Open File</button></a> 
                                                      <label class="date-label" id="promNoteIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteI, strrpos($promNoteI, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "promNoteISelect" name = "promNoteISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteIDesc" name = "promNoteIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; DISCLOSURE STATEMENT </label>
                                                      <input type="file" id="disclosureStateI" name="disclosureStateI"><img id="disclosureStateIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateIButton">Open File</button></a>
                                                      <label class="date-label" id="disclosureStateIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateI, strrpos($disclosureStateI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "disclosureStateISelect" name = "disclosureStateISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateIDesc" name = "disclosureStateIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- MRI FORM (COUNTRY BANKERS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; INSURANCE DOCUMENTS </label>
                                                      <input type="file" id="mriFormI" name="mriFormI"><img id="mriFormIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormIButton">Open File</button></a>
                                                      <label class="date-label" id="mriFormIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormI, strrpos($mriFormI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "mriFormISelect" name = "mriFormISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormIDesc" name = "mriFormIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                                      <input type="file" id="amortScheduleI" name="amortScheduleI"><img id="amortScheduleIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleIButton">Open File</button></a>
                                                      <label class="date-label" id="amortScheduleIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleI, strrpos($amortScheduleI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "amortScheduleISelect" name = "amortScheduleISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleIDesc" name = "amortScheduleIDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                          <div class="endBuyer" id="endBuyer" style="display:none">
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF REM CONTRACT AND DOCUMENTS FOR LOAN RELEASES</u></label></div>
                                             </div>
                                          </div>
                                           <!-- REAL ESTATE MORTGATE CONTRACT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; REAL ESTATE MORTGAGE CONTRACT </label>
                                                   <input type="file" id="remContractEndI" name="remContractEndI"><img id="remContractEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $remContractEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractEndIButton">Open File</button></a>
                                                   <label class="date-label" id="remContractEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractEndI, strrpos($remContractEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "remContractEndISelect" name = "remContractEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractEndIDesc" name = "remContractEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                            <!-- PROMISSORY NOTE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; PROMISSORY NOTE </label>
                                                   <input type="file" id="promNoteEndI" name="promNoteEndI"><img id="promNoteEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $promNoteEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteEndIButton">Open File</button></a> 
                                                   <label class="date-label" id="promNoteEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteEndI, strrpos($promNoteEndI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "promNoteEndISelect" name = "promNoteEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteEndIDesc" name = "promNoteEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- DISCLOSURE STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; DISCLOSURE STATEMENT </label>
                                                   <input type="file" id="disclosureStateEndI" name="disclosureStateEndI"><img id="disclosureStateEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $disclosureStateEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateEndIButton">Open File</button></a>
                                                   <label class="date-label" id="disclosureStateEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateEndI, strrpos($disclosureStateEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "disclosureStateEndISelect" name = "disclosureStateEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateEndIDesc" name = "disclosureStateEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- INSURANCE DOCUMENTS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; INSURANCE DOCUMENTS </label>
                                                   <input type="file" id="mriFormEndI" name="mriFormEndI"><img id="mriFormEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $mriFormEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormEndIButton">Open File</button></a>
                                                   <label class="date-label" id="mriFormEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormEndI, strrpos($mriFormEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "mriFormEndISelect" name = "mriFormEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormEndIDesc" name = "mriFormEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- AMORTIZATION SCHEDULE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                                   <input type="file" id="amortScheduleEndI" name="amortScheduleEndI"><img id="amortScheduleEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $amortScheduleEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleEndIButton">Open File</button></a>
                                                   <label class="date-label" id="amortScheduleEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleEndI, strrpos($amortScheduleEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "amortScheduleEndISelect" name = "amortScheduleEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleEndIDesc" name = "amortScheduleEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF DOCUMENTS TO SUNTRUST PROPERTIES INC. EXCHANGING TO DEED OF UNDERTAKING</u></label></div>
                                             </div>
                                          </div>
                                           <!-- SIGNED DEED OF UNDERTAKING -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <label class="individual-labels">&#x2022; SIGNED DEED of UNDERTAKING </label>
                                                   <input type="file" id="signedDeedUnderEndI" name="signedDeedUnderEndI"><img id="signedDeedUnderEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedDeedUnderEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedDeedUnderEndIButton">Open File</button></a></label>
                                                   <label class="date-label" id="signedDeedUnderEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedDeedUnderEndI, strrpos($signedDeedUnderEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedDeedUnderEndISelect" name = "signedDeedUnderEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedDeedUnderEndIDesc" name = "signedDeedUnderEndIDesc" >&nbsp;
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
                                                      <label class ="micro-labels">&#x2022; LOAN UTILIZATION</label>
                                                      <input type="file" id="utilization" name="utilization"><img id="utilizationImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $utilization; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="utilizationButton">Open File</button></a>
                                                      <label class="date-label" id="utilizationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($utilization, strrpos($utilization, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select id="utilizationSelect" name= "utilizationSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
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
                                                      <label class ="micro-labels">&#x2022; POWERPOINT CI AND <br> &nbsp; APPRAISAL REPORT</label>
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
                                                      <label class ="micro-labels">&#x2022; EXCEL CASHFLOW ANALYSIS  </label>
                                                      <input type="file" id="excel" name="excel"><img id="excelImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $excel; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="excelButton">Open File</button></a>
                                                      <label class="date-label" id="excelDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($excel, strrpos($excel, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                             </div>
                                       <div class="row">
                                             <div class="col-8">
                                                 <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.4em">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>OTHERS</u></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class = "OTHERS">
                                           <!-- SPECIAL POWER OF ATTORNEY (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="powerAttorneyICheck" name="powerAttorneyICheck">
                                                   <label class ="individual-labels" for="powerAttorneyICheck">SPECIAL POWER OF ATTORNEY</label>
                                                   <input type="file" id="powerAttorneyI" name="powerAttorneyI" ><img id="powerAttorneyIImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $powerAttorneyI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="powerAttorneyIButton" >Open File</button></a>
                                                   <label class="date-label" id="powerAttorneyIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerAttorneyI, strrpos($powerAttorneyI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "powerAttorneyISelect" name = "powerAttorneyISelect" tabindex="-1">
                                                      <option selected value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="powerAttorneyIDesc" name = "powerAttorneyIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- GENERAL INFORMATION SHEET (IF APPLICABLE)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="generalInfoCheck" name="generalInfoCheck">
                                                   <label class ="individual-labels" id="tab-label" for="generalInfoCheck"> GENERAL INFORMATION SHEET</label>
                                                   <input type="file" id="generalInfo" name="generalInfo"><img id="generalInfoImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $generalInfo; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="generalInfoButton" >Open File</button></a>
                                                   <label class="date-label" id="generalInfoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($generalInfo, strrpos($generalInfo, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "generalInfoSelect" name = "generalInfoSelect" tabindex="-1">
                                                      <option selected value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="generalInfoDesc" name = "generalInfoDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- SECURITY EXCHANGE COMMISSION (SEC) WITH ARTICLES AND BY LAW (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="securityExchangeCheck" name="securityExchangeCheck">
                                                   <label class ="individual-labels" id="tab-label" for="securityExchangeCheck"> SECURITY EXCHANGE COMMISSION <br> (SEC) WITH ARTICLES AND BY LAW </label> 
                                                   <input type="file" id="securityExchange" name="securityExchange"><img id="securityExchangeImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $securityExchange; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="securityExchangeButton" >Open File</button></a>
                                                   <label class="date-label" id="securityExchangeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($securityExchange, strrpos($securityExchange, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "securityExchangeSelect" name = "securityExchangeSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="securityExchangeDesc" name = "securityExchangeDesc" >
                                                </div>
                                             </div>
                                          </div>
                                           <!-- LETTER OF GUARANTEE (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="letterGuaranteeCheck" name="letterGuaranteeCheck">
                                                   <label class ="individual-labels" id="tab-label" for="letterGuaranteeCheck">LETTER OF GUARANTEE</label> 
                                                   <input type="file" id="letterGuarantee" name="letterGuarantee"><img id="letterGuaranteeImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $letterGuarantee; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="letterGuaranteeButton" >Open File</button></a>
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
                                          <!--ORIGINAL BOARD RESOLUTION AND NOTARIZED SECRETARY CERTIFICATE (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="boardResolutionCheck" name="boardResolutionCheck">
                                                   <label class ="individual-labels" id="tab-label" for="boardResolutionCheck"> ORIGINAL BOARD RESOLUTION AND NOTARIZED SECRETARY CERTIFICATE</label>
                                                   <input type="file" id="boardResolution" name="boardResolution"><img id="boardResolutionImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $boardResolution; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="boardResolutionButton" >Open File</button></a>
                                                   <label class="date-label" id="boardResolutionDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($boardResolution, strrpos($boardResolution, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "boardResolutionSelect" name = "boardResolutionSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="boardResolutionDesc" name = "boardResolutionDesc" >
                                                </div>
                                             </div>
                                          </div>
                                           <!-- STATEMENT OF ACCOUNT (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="statementAccountICheck" name="statementAccountICheck">
                                                   <label class ="individual-labels" id="tab-label" for="statementAccountICheck"> STATEMENT OF ACCOUNT</label>
                                                   <input type="file" id="statementAccountI" name="statementAccountI"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $statementAccountI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountIButton" >Open File</button></a>
                                                   <label class="date-label" id="statementAccountIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccountI, strrpos($statementAccountI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "statementAccountISelect" name = "statementAccountISelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="statementAccountIDesc" name = "statementAccountIDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BILL/COST OF MATERIALS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="billMaterialCheck" name="billMaterialCheck">
                                                   <label class ="individual-labels" id="tab-label" for="billMaterialCheck">BILL/COST OF MATERIALS</label>
                                                   <input type="file" id="billMaterial" name="billMaterial"><img id="billMaterialImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $billMaterial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="billMaterialButton" >Open File</button></a>
                                                   <label class="date-label" id="billMaterialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($billMaterial, strrpos($billMaterial, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "billMaterialSelect" name = "billMaterialSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="billMaterialDesc" name = "billMaterialDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PROPOSED PERSPECTIVE PLAN -->
                                          <div class="row" style="margin-bottom:-1.7%; height:3em;">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="proposedPlanCheck" name="proposedPlanCheck">
                                                   <label class ="individual-labels" id="tab-label" for="proposedPlanCheck">PROPOSED PERSPECTIVE PLAN</label>
                                                   <input type="file" id="proposedPlan" name="proposedPlan"><img id="proposedPlanImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $proposedPlan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proposedPlanButton" >Open File</button></a>
                                                   <label class="date-label" id="proposedPlanDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proposedPlan, strrpos($proposedPlan, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "proposedPlanSelect" name = "proposedPlanSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proposedPlanDesc" name = "proposedPlanDesc" >
                                                </div>
                                             </div>
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
                                                   <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">FIRST LETTER</label>
                                                   <input type="hidden" id="hiddenif" name="hiddenif" value="<?= $rows['ifLetter']; ?>">
                                                   <input type="hidden" id="hiddenif2" name="hiddenif2" value="<?= $rows['ifLetter2']; ?>">
                                                   <input type="hidden" id="hiddenLate" name="hiddenLate" value="<?= $duecDLate; ?>">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 115%;">&nbsp;</h5></div>
                                                   <input type="file" id="ifLetter" name="ifLetter" style="display: none;">
                                                   <label for="ifLetter" class="forifLetter btn-sm" id="forifLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($ifLetter)){
                                                         echo '<a href="' . $ifLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ifLetterButton" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="ifLetterNew" class="fa-solid fa-plus ifLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="ifLetterNew" class="fa-solid fa-plus ifLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="ifLetterShowOld" class="fa-solid fa-scroll ifLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="ifLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">REGISTRY RECEIPT</h5></div>
                                                   <input type="file" id="ifLetter2" name="ifLetter2" style="display : none;">
                                                   <label for="ifLetter2" class="forifLetter2 btn-sm" id="forifLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($ifLetter2)){
                                                            echo '<a href="' . $ifLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ifLetter2Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="ifLetter2New" class="fa-solid fa-plus ifLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="ifLetter2ShowOld" class="fa-solid fa-scroll ifLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="ifLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 135%; margin-left: -15%;">RETURN RECEIPT</h5></div>
                                                   <input type="file" id="ifLetter3" name="ifLetter3" style="display : none;">
                                                   <label for="ifLetter3" class="forifLetter3 btn-sm" id="forifLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($ifLetter3)){
                                                            echo '<a href="' . $ifLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ifLetter3Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="ifLetter3New" class="fa-solid fa-plus ifLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="ifLetter3ShowOld" class="fa-solid fa-scroll ifLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="ifLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <!-- <div class="py-1"> -->
                                                      <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 102%; border-right: 1px solid #ccc; margin-left: 9%;">DATE</h5></div>
                                                      <label class="date-label" id="ifLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($ifLetter, strrpos($ifLetter, '/') + 1, 10); ?></label>
                                                      <!-- </div> -->
                                                </div>
                                             <div class="col-2">
                                                <div><h5 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 108%; margin-left: -2%;">REMARKS</h5></div>
                                                <div class="form-group d-flex mb-4" >
                                                   &nbsp;&nbsp;<input type="text" id="ifLetterSelect" name="ifLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['ifLetterRemarks']; ?>">
                                                   &nbsp;&nbsp;<input type="hidden" class="fom-control w-75 p-1 fs-4" placeholder="REMARKS" id="ifLetterDesc" name="ifLetterDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-2">
                                                   <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">SECOND LETTER</label>
                                                   <input type="hidden" id="hiddenis" name="hiddenis" value="<?= $rows['isLetter']; ?>">
                                                   <input type="hidden" id="hiddenis2" name="hiddenis2" value="<?= $rows['isLetter2']; ?>">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="isLetter" name="isLetter" style="display : none;">
                                                   <label for="isLetter" class="forisLetter btn-sm" id="forisLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($isLetter)){
                                                            echo '<a href="' . $isLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="isLetterButton" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="isLetterNew" class="fa-solid fa-plus isLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="isLetterShowOld" class="fa-solid fa-scroll isLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="isLetterImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="isLetter2" name="isLetter2" style="display : none;">
                                                   <label for="isLetter2" class="forisLetter2 btn-sm" id="forisLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($isLetter2)){
                                                            echo '<a href="' . $isLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="isLetter2Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="isLetter2New" class="fa-solid fa-plus isLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="isLetter2ShowOld" class="fa-solid fa-scroll isLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="isLetter2Image" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="isLetter3" name="isLetter3" style="display : none;">
                                                   <label for="isLetter3" class="forisLetter3 btn-sm" id="forisLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($isLetter3)){
                                                            echo '<a href="' . $isLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="isLetter3Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="isLetter3New" class="fa-solid fa-plus isLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="isLetter3ShowOld" class="fa-solid fa-scroll isLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="isLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="isLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($isLetter, strrpos($isLetter, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2" >
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="isLetterSelect" name="isLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['isLetterRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="isLetterDesc" name="isLetterDesc" >&nbsp;
                                                      </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-2">
                                                      <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">THIRD LETTER</label>
                                                      <input type="hidden" id="hiddenit" name="hiddenit" value="<?= $rows['itLetter']; ?>">
                                                      <input type="hidden" id="hiddenit2" name="hiddenit2" value="<?= $rows['itLetter2']; ?>">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="itLetter" name="itLetter" style="display : none;">
                                                      <label for="itLetter" class="foritLetter btn-sm" id="foritLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($itLetter)){
                                                               echo '<a href="' . $itLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="itLetterButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="itLetterNew" class="fa-solid fa-plus itLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="itLetterShowOld" class="fa-solid fa-scroll itLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="itLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                     <input type="file" id="itLetter2" name="itLetter2" style="display : none;">
                                                      <label for="itLetter2" class="foritLetter2 btn-sm" id="foritLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($itLetter2)){
                                                               echo '<a href="' . $itLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="itLetter2Button" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="itLetter2New" class="fa-solid fa-plus itLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="itLetter2ShowOld" class="fa-solid fa-scroll itLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="itLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <input type="file" id="itLetter3" name="itLetter3" style="display : none;">
                                                   <label for="itLetter3" class="foritLetter3 btn-sm" id="foritLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($itLetter3)){
                                                            echo '<a href="' . $itLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="itLetter3Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="itLetter3New" class="fa-solid fa-plus itLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="itLetter3ShowOld" class="fa-solid fa-scroll itLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="itLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="itLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($itLetter, strrpos($itLetter, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2" >
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="itLetterSelect" name="itLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['itLetterRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="itLetterDesc" name="itLetterDesc" >&nbsp;
                                                         </div>
                                                   </div>
                                                </div>
                                             <div class="row">
                                                <div class="col-2">
                                                      <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">FINAL LETTER</label>
                                                      <input type="hidden" id="hiddenifd" name="hiddenifd" value="<?= $rows['ifdLetter']; ?>">
                                                      <input type="hidden" id="hiddenifd2" name="hiddenifd2" value="<?= $rows['ifdLetter2']; ?>">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="ifdLetter" name="ifdLetter" style="display : none;">
                                                      <label for="ifdLetter" class="forifdLetter btn-sm" id="forifdLetter" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($ifdLetter)){
                                                               echo '<a href="' . $ifdLetter . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ifdLetterButton" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="ifdLetterNew" class="fa-solid fa-plus ifdLetterNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="ifdLetterShowOld" class="fa-solid fa-scroll ifdLetterShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="ifdLetterImage" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <input type="file" id="ifdLetter2" name="ifdLetter2" style="display : none;">
                                                      <label for="ifdLetter2" class="forifdLetter2 btn-sm" id="forifdLetter2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($ifdLetter2)){
                                                               echo '<a href="' . $ifdLetter2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ifdLetter2Button" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="ifdLetter2New" class="fa-solid fa-plus ifdLetter2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="ifdLetter2ShowOld" class="fa-solid fa-scroll ifdLetter2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="ifdLetter2Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                   <input type="file" id="ifdLetter3" name="ifdLetter3" style="display : none;">
                                                   <label for="ifdLetter3" class="forifdLetter3 btn-sm" id="forifdLetter3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($ifdLetter3)){
                                                            echo '<a href="' . $ifdLetter3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ifdLetter3Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="ifdLetter3New" class="fa-solid fa-plus ifdLetter3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="ifdLetter3ShowOld" class="fa-solid fa-scroll ifdLetter3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="ifdLetter3Image" src="statusImage/check.png" alt="statusImage">
                                                </div>
                                                <div class="col-2">
                                                      <label class="date-label" id="ifdLetterDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($ifdLetter, strrpos($ifdLetter, '/') + 1, 10); ?></label>
                                                </div>
                                                <div class="col-2" >
                                                         <div class="form-group d-flex mb-4">
                                                            &nbsp;&nbsp;<input type="text" id="ifdLetterSelect" name="ifdLetterSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['ifdLetterRemarks']; ?>">
                                                            &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="ifdLetterDesc" name="ifdLetterDesc" >&nbsp;
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
                                                         <input type="hidden" id="hiddenClient1" name="hiddenClient1" value="<?= $rows['iclientReq1']; ?>">
                                                         <input type="hidden" id="hiddenClient2" name="hiddenClient2" value="<?= $rows['iclientReq2']; ?>">
                                                         <input type="hidden" id="hiddenClient3" name="hiddenClient3" value="<?= $rows['iclientReq3']; ?>">
                                                   </div>
                                                   <div class="col-2">
                                                         <input type="file" id="iclientReq1" name="iclientReq1" style="display : none;">
                                                         <label for="iclientReq1" class="foriclientReq1 btn-sm" id="foriclientReq1" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                            <?php 
                                                               if(!empty($iclientReq1)){
                                                                  echo '<a href="' . $iclientReq1 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="iclientReq1Button" 
                                                                        style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                                  echo '&nbsp;<button type="button" id="iclientReq1New" class="fa-solid fa-plus iclientReq1New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                               }else{
                                                                  // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                               }
                                                               echo '&nbsp;<button type="button" id="iclientReq1ShowOld" class="fa-solid fa-scroll iclientReq1ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            ?>
                                                            <img id="iclientReq1Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                         <input type="file" id="iclientReq2" name="iclientReq2" style="display : none;">
                                                         <label for="iclientReq2" class="foriclientReq2 btn-sm" id="foriclientReq2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                            <?php 
                                                               if(!empty($iclientReq2)){
                                                                  echo '<a href="' . $iclientReq2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="iclientReq2Button" 
                                                                        style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                                  echo '&nbsp;<button type="button" id="iclientReq2New" class="fa-solid fa-plus iclientReq2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                               }else{
                                                                  // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                               }
                                                               echo '&nbsp;<button type="button" id="iclientReq2ShowOld" class="fa-solid fa-scroll iclientReq2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            ?>
                                                            <img id="iclientReq2Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                      <input type="file" id="iclientReq3" name="iclientReq3" style="display : none;">
                                                      <label for="iclientReq3" class="foriclientReq3 btn-sm" id="foriclientReq3" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                         <?php 
                                                            if(!empty($iclientReq3)){
                                                               echo '<a href="' . $iclientReq3 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="iclientReq3Button" 
                                                                     style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                               echo '&nbsp;<button type="button" id="iclientReq3New" class="fa-solid fa-plus iclientReq3New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                            }else{
                                                               // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                            }
                                                            echo '&nbsp;<button type="button" id="iclientReq3ShowOld" class="fa-solid fa-scroll iclientReq3ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         ?>
                                                         <img id="iclientReq3Image" src="statusImage/check.png" alt="statusImage">
                                                   </div>
                                                   <div class="col-2">
                                                         <label class="date-label" id="iclientReq1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($iclientReq1, strrpos($iclientReq1, '/') + 1, 10); ?></label>
                                                   </div>
                                                   <div class="col-2" id="">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="iclientReq1Select" name="iclientReq1Select" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['iclientReqRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="iclientReq1Desc" name="iclientReq1Desc" >&nbsp;
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
                                                   <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">RECOMMENDATION FOR <br>FORECLOSURE</label>
                                             </div>
                                             <div class="col-2">
                                                  
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="iffClosure" name="iffClosure" style="display : none;">
                                                   <label for="iffClosure" class="foriffClosure btn-sm" id="foriffClosure" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($iffClosure)){
                                                            echo '<a href="' . $iffClosure . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="iffClosureButton" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="iffClosureNew" class="fa-solid fa-plus iffClosureNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="iffClosureShowOld" class="fa-solid fa-scroll iffClosureShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="iffClosureImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-1">
                                     
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="iffClosureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($iffClosure, strrpos($iffClosure, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="iffClosureSelect" name="iffClosureSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['iffClosureRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="iffClosureDesc" name="iffClosureDesc" >&nbsp;
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-3">
                                                   <label class ="individual-labels" id="tab-label" for="custom" style="padding-left: 2%;">PASTDUE TO LITIGATION</label>
                                             </div>
                                             <div class="col-2">
                                                <input type="file" id="pastLitigation" name="pastLitigation" style="display : none;">
                                                <label for="pastLitigation" class="forpastLitigation btn-sm" id="forpastLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                   <?php 
                                                      if(!empty($pastLitigation)){
                                                         echo '<a href="' . $pastLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="pastLitigationButton" 
                                                               style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                         echo '&nbsp;<button type="button" id="pastLitigationNew" class="fa-solid fa-plus pastLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      }else{
                                                         // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                      }
                                                      echo '&nbsp;<button type="button" id="pastLitigationShowOld" class="fa-solid fa-scroll pastLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                   ?>
                                                   <img id="pastLitigationImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="pastLitigation2" name="pastLitigation2" style="display : none;">
                                                   <label for="pastLitigation2" class="forpastLitigation2 btn-sm" id="forpastLitigation2" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($pastLitigation2)){
                                                            echo '<a href="' . $pastLitigation2 . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="pastLitigation2Button" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="pastLitigation2New" class="fa-solid fa-plus pastLitigation2New btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="pastLitigation2ShowOld" class="fa-solid fa-scroll pastLitigation2ShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="pastLitigation2Image" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-1">
                                                <input class="form-check-input" type="checkbox" value="Yes" id="pastCheck" name="pastCheck"><label for=""><label class="individual-labels" id="label23" for="forpastCheck" style="font-size: 15px; display: inline;"> Bidding</label>
                                             </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="pastLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($pastLitigation, strrpos($pastLitigation, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="pastLitigationSelect" name="pastLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['pastLitigationRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="pastLitigationDesc" name="pastLitigationDesc" >&nbsp;
                                                      </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-3">
                                                   <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">TRANSFER FROM LITIGATION <br>TO ROPA</label>
                                             </div>
                                             <div class="col-2">
                                                  
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="ittLitigation" name="ittLitigation" style="display : none;">
                                                   <label for="ittLitigation" class="forittLitigation btn-sm" id="forittLitigation" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($ittLitigation)){
                                                            echo '<a href="' . $ittLitigation . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="ittLitigationButton" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="ittLitigationNew" class="fa-solid fa-plus ittLitigationNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="ittLitigationShowOld" class="fa-solid fa-scroll ittLitigationShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="ittLitigationImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-1">
                                     
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="ittLitigationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($ittLitigation, strrpos($ittLitigation, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="ittLitigationSelect" name="ittLitigationSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['ittLitigationRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="ittLitigationDesc" name="ittLitigationDesc" >&nbsp;
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-3">
                                                   <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">ANNOTATIONS OF COS</label>
                                             </div>
                                             <div class="col-2">
                                                  
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="prepConso" name="prepConso" style="display : none;">
                                                   <label for="prepConso" class="forprepConso btn-sm" id="forprepConso" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($prepConso)){
                                                            echo '<a href="' . $prepConso . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="prepConsoButton" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="prepConsoNew" class="fa-solid fa-plus prepConsoNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="prepConsoShowOld" class="fa-solid fa-scroll prepConsoShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="prepConsoImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-1">
                                     
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="prepConsoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($prepConso, strrpos($prepConso, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="prepConsoSelect" name="prepConsoSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['prepConsoRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="prepConsoDesc" name="prepConsoDesc" >&nbsp;
                                                      </div>
                                                </div>
                                          </div>                                          
                                          <div class="row">
                                             <div class="col-3">
                                                   <label class ="individual-labels" id="tab-label" for="custom" style=" padding-left: 2%;">PREPARE TO CONSOLIDATION <br>IN THE NAME OF THE BANK</label>
                                             </div>
                                             <div class="col-2">
                                                  
                                             </div>
                                             <div class="col-2">
                                                   <input type="file" id="iaDemand" name="iaDemand" style="display : none;">
                                                   <label for="iaDemand" class="foriaDemand btn-sm" id="foriaDemand" style="cursor: pointer; border: 1px solid black; padding: 1px 5px; color: green;"><span class="fa-solid fa-upload fa-sm"></span></label>
                                                      <?php 
                                                         if(!empty($iaDemand)){
                                                            echo '<a href="' . $iaDemand . '" target="_blank"><button type="button" class="fa-solid fa-eye btn-sm btnFile btn" id="iaDemandButton" 
                                                                  style="border: 1px solid black; padding: 5px 5px;"></button></a>';
                                                            echo '&nbsp;<button type="button" id="iaDemandNew" class="fa-solid fa-plus iaDemandNew btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                         }else{
                                                            // echo '&nbsp;<button type="button" id="" class="fa-solid fa-plus btn-sm btn" style="border: 1px solid black; padding: 5px 5px;" disabled></button>';
                                                         }
                                                         echo '&nbsp;<button type="button" id="iaDemandShowOld" class="fa-solid fa-scroll iaDemandShowOld btn-sm btn" style="border: 1px solid black; padding: 5px 5px;"></button>';
                                                      ?>
                                                      <img id="iaDemandImage" src="statusImage/check.png" alt="statusImage">
                                             </div>
                                             <div class="col-1">
                                     
                                                </div>
                                             <div class="col-2">
                                                   <label class="date-label" id="iaDemandDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($iaDemand, strrpos($iaDemand, '/') + 1, 10); ?></label>
                                             </div>
                                             <div class="col-2">
                                                      <div class="form-group d-flex mb-4">
                                                         &nbsp;&nbsp;<input type="text" id="iaDemandSelect" name="iaDemandSelect" class="form-control w-90 p-1 fs-5" placeholder="      REMARKS" value="<?= $rows['iaDemandRemarks']; ?>">
                                                         &nbsp;&nbsp;<input type="hidden" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="iaDemandDesc" name="iaDemandDesc" >&nbsp;
                                                      </div>
                                                </div>
                                          </div>
                                             <!-- <div class="row">
                                              <div class="col-8" id= "notEndBuyerSpace" style="margin-bottom:-5%;"></div>
                                           </div> -->
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
    $('#endBuyer, #endBuyerUnder, #suntrustDocuments').show();
    if (sourceIncome === "Business"){
      document.getElementById("businessSpace").style.height="22.9em";
    }
    else{
      document.getElementById("endBuyerSpace").style.height="36.4em";
    }
  } else {
   $('#notEndBuyer, #collateralDocuments').show();
      if (sourceIncome === "Business"){
      document.getElementById("businessSpace").style.height="18em";
    }
    else{
      document.getElementById("notEndBuyerSpace").style.height="32.9em";
    }

  }

  if (sourceIncome === "Business") {
    $('#businessProofIncome, #businessProofIncomeSelect').show();
  } else {
    $('#employedProofIncome, #employedProofIncomeSelect').show();
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

// INDIVIDUAL TEXT FIELD, IF YOU SELECT INCOMPLETE IT WILL DISPLAY TEXTFIELD
// PRINCIPAL BORROWER
handleSelectChange('endorsementSelect', 'endorsementDesc');
handleSelectChange('loanAppFormISelect', 'loanAppFormIDesc');
handleSelectChange('photocopyIdSignaturesSelect', 'photocopyIdSignaturesDesc');
handleSelectChange('proofBillingSelect', 'proofBillingDesc');
handleSelectChange('personalBankSelect', 'personalBankDesc');
handleSelectChange('marriageContractSelect', 'marriageContractDesc');
handleSelectChange('barangayClearanceSelect', 'barangayClearanceDesc');
// COLLATERAL DOCUMENTS
handleSelectChange('transferCertificateSelect', 'transferCertificateDesc');
handleSelectChange('taxDeclarationLotSelect', 'taxDeclarationLotDesc');
handleSelectChange('taxDeclarationImpSelect', 'taxDeclarationImpDesc');
handleSelectChange('realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
handleSelectChange('realEstateTaxReceiptSelect', 'realEstateTaxReceiptDesc');
handleSelectChange('cancellationDischargeSelect', 'cancellationDischargeDesc');
// SUNTRUST DOCUMENTS
handleSelectChange('sunTransferCertificateSelect', 'sunTransferCertificateDesc');
handleSelectChange('sunTaxDeclarationLotSelect', 'sunTaxDeclarationLotDesc');
handleSelectChange('sunTaxDeclarationImpSelect', 'sunTaxDeclarationImpDesc');
handleSelectChange('sunContractSellSelect', 'sunContractSellDesc');
handleSelectChange('sunStatementAccountSelect', 'sunStatementAccountDesc');
// BUSINESS PROOF OF INCOME
handleSelectChange('updatedBusinessSelect', 'updatedBusinessDesc');
handleSelectChange('auditedFinancialSelect', 'auditedFinancialDesc');
handleSelectChange('inhouseFinancialSelect', 'inhouseFinancialDesc');
handleSelectChange('businessBankStatementSelect', 'businessBankStatementDesc');
handleSelectChange('salesRecordSelect', 'salesRecordDesc');
handleSelectChange('incomeTaxReturnSelect', 'incomeTaxReturnDesc');
handleSelectChange('contractLeaseSelect', 'contractLeaseDesc');
handleSelectChange('customerNumberSelect', 'customerNumberDesc');
handleSelectChange('customerSupplierSelect', 'customerSupplierDesc');
handleSelectChange('otherIncomeBSelect', 'otherIncomeBDesc');
// EMPLOYED PROOF OF INCOME
handleSelectChange('employmentContractSelect', 'employmentContractDesc');
handleSelectChange('certificateEmploymentSelect', 'certificateEmploymentDesc');
handleSelectChange('incomeTaxSelect', 'incomeTaxDesc');
handleSelectChange('payslipMonthsSelect', 'payslipMonthsDesc');
handleSelectChange('otherIncomeSelect', 'otherIncomeDesc');
// OTHERS
handleSelectChange('powerAttorneyISelect', 'powerAttorneyIDesc');
handleSelectChange('generalInfoSelect', 'generalInfoDesc');
handleSelectChange('securityExchangeSelect', 'securityExchangeDesc');
handleSelectChange('letterGuaranteeSelect', 'letterGuaranteeDesc');
handleSelectChange('boardResolutionSelect', 'boardResolutionDesc');
handleSelectChange('statementAccountISelect', 'statementAccountIDesc');
handleSelectChange('billMaterialSelect', 'billMaterialDesc');
handleSelectChange('proposedPlanSelect', 'proposedPlanDesc');
// DOCUMENTS
handleSelectChange('receiptSelect', 'receiptDesc');
handleSelectChange('creditInvestigationReportISelect', 'creditInvestigationReportIDesc');
handleSelectChange('collateralAppraisalReportISelect', 'collateralAppraisalReportIDesc');
handleSelectChange('financialEvaluationISelect', 'financialEvaluationIDesc');
handleSelectChange('signedLetterISelect', 'signedLetterIDesc');
handleSelectChange('signedLetterUnderEndISelect', 'signedLetterUnderEndIDesc');
handleSelectChange('signedLoanMemoISelect', 'signedLoanMemoIDesc');
handleSelectChange('remContractISelect', 'remContractIDesc');
handleSelectChange('remContractAnnotatedISelect', 'remContractAnnotatedIDesc');
handleSelectChange('promNoteISelect', 'promNoteIDesc');
handleSelectChange('disclosureStateISelect', 'disclosureStateIDesc');
handleSelectChange('mriFormISelect', 'mriFormIDesc');
handleSelectChange('amortScheduleISelect', 'amortScheduleIDesc');
handleSelectChange('remContractEndISelect', 'remContractEndIDesc');
handleSelectChange('promNoteEndISelect', 'promNoteEndIDesc');
handleSelectChange('disclosureStateEndISelect', 'disclosureStateEndIDesc');
handleSelectChange('mriFormEndISelect', 'mriFormEndIDesc');
handleSelectChange('amortScheduleEndISelect', 'amortScheduleEndIDesc');
handleSelectChange('signedDeedUnderEndISelect', 'signedDeedUnderEndIDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');

</script>

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, indivId) {
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
                        d.indivId = indivId;
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
   $(document).on('click', '#ifLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_ifLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ifLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_ifLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ifLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_ifLetter3.php', '<?php echo $id; ?>');
   });

   // Second Demand
   $(document).on('click', '#isLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_isLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#isLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_isLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#isLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_isLetter3.php', '<?php echo $id; ?>');
   });

   // Third Demand
   $(document).on('click', '#itLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_itLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#itLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_itLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#itLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_itLetter3.php', '<?php echo $id; ?>');
   });

   // Final Demand
   $(document).on('click', '#ifdLetterShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_ifdLetter.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ifdLetter2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_ifdLetter2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#ifdLetter3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_ifdLetter3.php', '<?php echo $id; ?>');
   });

   // other DOCUMENTS iclientReq1
   $(document).on('click', '#iclientReq1ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_iclientReq1.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#iclientReq2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_iclientReq2.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#iclientReq3ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_iclientReq3.php', '<?php echo $id; ?>');
   });

   // foreclosure #
   $(document).on('click', '#iffClosureShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_iffClosure.php', '<?php echo $id; ?>');
   });

   // pastdue litigation
   $(document).on('click', '#pastLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_pastLitigation.php', '<?php echo $id; ?>');
   });
   $(document).on('click', '#pastLitigation2ShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_pastLitigation2.php', '<?php echo $id; ?>');
   });

   //transfer litigation
   $(document).on('click', '#ittLitigationShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_ittLitigation.php', '<?php echo $id; ?>');
   });

   // prepare for consolidate
   $(document).on('click', '#prepConsoShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_prepConso.php', '<?php echo $id; ?>');
   });

   // due and demandable
   $(document).on('click', '#iaDemandShowOld', function(){
      initializeDataTable('#oldFile', 'fetch_ia_iaDemand.php', '<?php echo $id; ?>');
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
   $(document).on('click', '#ifLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ifLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ifLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 2nd Demand
   $(document).on('click', '#isLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#isLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#isLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // 3rd Demand
   $(document).on('click', '#itLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#itLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#itLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // Final Demand
   $(document).on('click', '#ifdLetterShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ifdLetter2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#ifdLetter3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // other docs #
   $(document).on('click', '#iclientReq1ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#iclientReq2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#iclientReq3ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // foreclosure
   $(document).on('click', '#iffClosureShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // pastdue litigation
   $(document).on('click', '#pastLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   $(document).on('click', '#pastLitigation2ShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // transfer litigation
   $(document).on('click', '#ittLitigationShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // prepare for consolidate
   $(document).on('click', '#prepConsoShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
   // due and Demandable
   $(document).on('click', '#iaDemandShowOld', function(e){
      e.preventDefault();
      historyModal.show()
   });
</script>

<!-- individual Form -->
<script>
var indivForm = document.getElementById("individual-form");
var indivId = "<?php echo $id; ?>";
var fullname = "<?php echo $fullname; ?>";
var salaryType = "<?php echo $type; ?>";
var branch = "<?php echo $branch; ?>";
var loanType = "<?php echo $loanType; ?>";

var endPrompt = ""; // Global variable for remarks

function uploadFileI() {
  var indivformData = new FormData(indivForm);
  indivformData.append('indivId',indivId);
  indivformData.append('fullname',fullname);
  indivformData.append('salaryType',salaryType);
  indivformData.append('branch',branch);
  indivformData.append('loanType',loanType);

  // Append the endPrompt to the FormData
  indivformData.append('endPrompt', endPrompt);
  $.ajax({
    url: 'loanIndividualUploadData.php', 
    type: 'POST',
    data: indivformData,
    processData: false,
    contentType: false,
    
    success: function(response) {
// Automatically adds a Check Icon whenever you select Image from your local
// FOR LOAN APPLICATION:
updateFileStatus('endorsement', 'endorsementImage');
updateFileStatus('loanAppFormI', 'loanAppFormIImage');
updateFileStatus('photocopyIdSignatures', 'photocopyIdSignaturesImage');
updateFileStatus('proofBilling', 'proofBillingImage');
updateFileStatus('personalBank', 'personalBankImage');
updateFileStatus('marriageContract', 'marriageContractImage');
updateFileStatus('barangayClearance', 'barangayClearanceImage');
// FOR PROPERTY-RELATED DOCUMENTS:
updateFileStatus('transferCertificate', 'transferCertificateImage');
updateFileStatus('taxDeclarationLot', 'taxDeclarationLotImage');
updateFileStatus('taxDeclarationImp', 'taxDeclarationImpImage');
updateFileStatus('realEstateTaxClearance', 'realEstateTaxClearanceImage');
updateFileStatus('realEstateTaxReceipt', 'realEstateTaxReceiptImage');
updateFileStatus('cancellationDischarge', 'cancellationDischargeImage');
// FOR SUN-RELATED DOCUMENTS:
updateFileStatus('sunTransferCertificate', 'sunTransferCertificateImage');
updateFileStatus('sunTaxDeclarationLot', 'sunTaxDeclarationLotImage');
updateFileStatus('sunTaxDeclarationImp', 'sunTaxDeclarationImpImage');
updateFileStatus('sunContractSell', 'sunContractSellImage');
updateFileStatus('sunStatementAccount', 'sunStatementAccountImage');
// FOR BUSINESS-RELATED DOCUMENTS:
updateFileStatus('updatedBusiness', 'updatedBusinessImage');
updateFileStatus('auditedFinancial', 'auditedFinancialImage');
updateFileStatus('inhouseFinancial', 'inhouseFinancialImage');
updateFileStatus('businessBankStatement', 'businessBankStatementImage');
updateFileStatus('salesRecord', 'salesRecordImage');
updateFileStatus('incomeTaxReturn', 'incomeTaxReturnImage');
updateFileStatus('contractLease', 'contractLeaseImage');
updateFileStatus('customerNumber', 'customerNumberImage');
updateFileStatus('customerSupplier', 'customerSupplierImage');
updateFileStatus('otherIncomeB', 'otherIncomeBImage');
// FOR EMPLOYMENT-RELATED DOCUMENTS:
updateFileStatus('employmentContract', 'employmentContractImage');
updateFileStatus('certificateEmployment', 'certificateEmploymentImage');
updateFileStatus('incomeTax', 'incomeTaxImage');
updateFileStatus('payslipMonths', 'payslipMonthsImage');
updateFileStatus('otherIncome', 'otherIncomeImage');
// OTHERS
updateFileStatus('powerAttorneyI', 'powerAttorneyIImage');
updateFileStatus('generalInfo', 'generalInfoImage');
updateFileStatus('securityExchange', 'securityExchangeImage');
updateFileStatus('letterGuarantee', 'letterGuaranteeImage');
updateFileStatus('boardResolution', 'boardResolutionImage');
updateFileStatus('statementAccountI', 'statementAccountImage');
updateFileStatus('billMaterial', 'billMaterialImage');
updateFileStatus('proposedPlan', 'proposedPlanImage');
// DOCUMENTS SECTION
updateFileStatus('receipt', 'receiptImage');
updateFileStatus('creditInvestigationReportI', 'creditInvestigationReportIImage');
updateFileStatus('collateralAppraisalReportI', 'collateralAppraisalReportIImage');
updateFileStatus('financialEvaluationI', 'financialEvaluationIImage');
updateFileStatus('signedLetterI', 'signedLetterIImage');
updateFileStatus('signedLetterUnderEndI', 'signedLetterUnderEndIImage');
updateFileStatus('signedLoanMemoI', 'signedLoanMemoIImage');
updateFileStatus('remContractI', 'remContractIImage');
updateFileStatus('remContractAnnotatedI', 'remContractAnnotatedIImage');
updateFileStatus('remContractEndI', 'remContractEndIImage');
updateFileStatus('promNoteI', 'promNoteIImage');
updateFileStatus('promNoteEndI', 'promNoteEndIImage');
updateFileStatus('disclosureStateI', 'disclosureStateIImage');
updateFileStatus('disclosureStateEndI', 'disclosureStateEndIImage');
updateFileStatus('mriFormI', 'mriFormIImage');
updateFileStatus('mriFormEndI', 'mriFormEndIImage');
updateFileStatus('amortScheduleI', 'amortScheduleIImage');
updateFileStatus('amortScheduleEndI', 'amortScheduleEndIImage');
updateFileStatus('signedDeedUnderEndI', 'signedDeedUnderEndIImage');
updateFileStatus('utilization', 'utilizationImage');
updateFileStatus('powerpoint', 'powerpointImage');
updateFileStatus('excel', 'excelImage');
// LETTER
updateFileStatus('ifLetter', 'ifLetterImage');
updateFileStatus('isLetter', 'isLetterImage');
updateFileStatus('itLetter', 'itLetterImage');
updateFileStatus('ifdLetter', 'ifdLetterImage');
// LETTER2
updateFileStatus('ifLetter2', 'ifLetter2Image');
updateFileStatus('isLetter2', 'isLetter2Image');
updateFileStatus('itLetter2', 'itLetter2Image');
updateFileStatus('ifdLetter2', 'ifdLetter2Image');
// LETTER3
updateFileStatus('ifLetter3', 'ifLetter3Image');
updateFileStatus('isLetter3', 'isLetter3Image');
updateFileStatus('itLetter3', 'itLetter3Image');
updateFileStatus('ifdLetter3', 'ifdLetter3Image');
// OTHER ATTACHMENT
updateFileStatus('iclientReq1', 'iclientReq1Image');
updateFileStatus('iclientReq2', 'iclientReq2Image');
updateFileStatus('iclientReq3', 'iclientReq3Image');
// LEGAL
updateFileStatus('iffClosure', 'iffClosureImage');
updateFileStatus('pastLitigation', 'pastLitigationImage');
updateFileStatus('pastLitigation2', 'pastLitigation2Image');
updateFileStatus('ittLitigation', 'ittLitigationImage');
updateFileStatus('prepConso', 'prepConsoImage');
updateFileStatus('iaDemand', 'iaDemandImage');

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
                    formData.append('indivId',  indivId);

                    // Log FormData before sending
                    console.log("FormData before AJAX:", Array.from(formData.entries()));

                    // Send form data via AJAX
                    $.ajax({
                        url: 'loanIndividualUploadData.php',
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

   // for ifLetter
   $(document).on('click', '.ifLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ifLetter');
   });
   $(document).on('click', '.ifLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ifLetter2');
   });
   $(document).on('click', '.ifLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ifLetter3');
   });
   // for isLetter
   $(document).on('click', '.isLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#isLetter');
   });
   $(document).on('click', '.isLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#isLetter2');
   });
   $(document).on('click', '.isLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#isLetter3');
   });
   // 3rd Letter
   $(document).on('click', '.itLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#itLetter');
   });
   $(document).on('click', '.itLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#itLetter2');
   });
   $(document).on('click', '.itLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#itLetter3');
   });
   // final DEMAND
   $(document).on('click', '.ifdLetterNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ifdLetter');
   });
   $(document).on('click', '.ifdLetter2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ifdLetter2');
   });
   $(document).on('click', '.ifdLetter3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ifdLetter3');
   });

   // OTHER ATTACHMENT
   $(document).on('click', '.iclientReq1New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#iclientReq1');
   });
   $(document).on('click', '.iclientReq2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#iclientReq2');
   });
   $(document).on('click', '.iclientReq3New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#iclientReq3');
   });

   // LEGAL
   $(document).on('click', '.iffClosureNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#iffClosure');
   });
   $(document).on('click', '.pastLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#pastLitigation');
   });
   $(document).on('click', '.pastLitigation2New', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#pastLitigation2');
   });
   
   // Transfer to ROPA
   $(document).on('click', '.ittLitigationNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#ittLitigation');
   });
   // Prepare to Consolidation
   $(document).on('click', '.prepConsoNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#prepConso');
   });
   // Due and Demandable
   $(document).on('click', '.iaDemandNew', function(e){
      e.preventDefault();
   
      handleEndorsementUpload('#iaDemand');
   });

indivForm.addEventListener("change", function() {
  uploadFileI();
});

 </script> 
<!--  Approval Status and Description -->
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
      if(fieldValue=="1"){
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
// USED TO FILTER DATA FROM DATABASE THEN PUT IT ON TEXTFIELD
// PRINCIPAL BORROWER
selectOptionBasedOnValue('<?php echo explode("--", $endorsementSelect)[0]; ?>', 'endorsementSelect', 'endorsementDesc', '<?php echo explode("--", $endorsementSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $loanAppFormISelect)[0]; ?>', 'loanAppFormISelect', 'loanAppFormIDesc', '<?php echo explode("--", $loanAppFormISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $photocopyIdSignaturesSelect)[0]; ?>', 'photocopyIdSignaturesSelect', 'photocopyIdSignaturesDesc', '<?php echo explode("--", $photocopyIdSignaturesSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $proofBillingSelect)[0]; ?>', 'proofBillingSelect', 'proofBillingDesc', '<?php echo explode("--", $proofBillingSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $personalBankSelect)[0]; ?>', 'personalBankSelect', 'personalBankDesc', '<?php echo explode("--", $personalBankSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $marriageContractSelect)[0]; ?>', 'marriageContractSelect', 'marriageContractDesc', '<?php echo explode("--", $marriageContractSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $barangayClearanceSelect)[0]; ?>', 'barangayClearanceSelect', 'barangayClearanceDesc', '<?php echo explode("--", $barangayClearanceSelect)[1]; ?>');
// COLLATERAL DOCUMENTS
selectOptionBasedOnValue('<?php echo explode("--", $transferCertificateSelect)[0]; ?>', 'transferCertificateSelect', 'transferCertificateDesc', '<?php echo explode("--", $transferCertificateSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $taxDeclarationLotSelect)[0]; ?>', 'taxDeclarationLotSelect', 'taxDeclarationLotDesc', '<?php echo explode("--", $taxDeclarationLotSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $taxDeclarationImpSelect)[0]; ?>', 'taxDeclarationImpSelect', 'taxDeclarationImpDesc', '<?php echo explode("--", $taxDeclarationImpSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $realEstateTaxClearanceSelect)[0]; ?>', 'realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc', '<?php echo explode("--", $realEstateTaxClearanceSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $realEstateTaxReceiptSelect)[0]; ?>', 'realEstateTaxReceiptSelect', 'realEstateTaxReceiptDesc', '<?php echo explode("--", $realEstateTaxReceiptSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $cancellationDischargeSelect)[0]; ?>', 'cancellationDischargeSelect', 'cancellationDischargeDesc', '<?php echo explode("--", $cancellationDischargeSelect)[1]; ?>');
// SUNTRUST DOCUMENTS
selectOptionBasedOnValue('<?php echo explode("--", $sunTransferCertificateSelect)[0]; ?>', 'sunTransferCertificateSelect', 'sunTransferCertificateDesc', '<?php echo explode("--", $sunTransferCertificateSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $sunTaxDeclarationLotSelect)[0]; ?>', 'sunTaxDeclarationLotSelect', 'sunTaxDeclarationLotDesc', '<?php echo explode("--", $sunTaxDeclarationLotSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $sunTaxDeclarationImpSelect)[0]; ?>', 'sunTaxDeclarationImpSelect', 'sunTaxDeclarationImpDesc', '<?php echo explode("--", $sunTaxDeclarationImpSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $sunContractSellSelect)[0]; ?>', 'sunContractSellSelect', 'sunContractSellDesc', '<?php echo explode("--", $sunContractSellSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $sunStatementAccountSelect)[0]; ?>', 'sunStatementAccountSelect', 'sunStatementAccountDesc', '<?php echo explode("--", $sunStatementAccountSelect)[1]; ?>');
// BUSINESS PROOF OF INCOME
selectOptionBasedOnValue('<?php echo explode("--", $updatedBusinessSelect)[0]; ?>', 'updatedBusinessSelect', 'updatedBusinessDesc', '<?php echo explode("--", $updatedBusinessSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $auditedFinancialSelect)[0]; ?>', 'auditedFinancialSelect', 'auditedFinancialDesc', '<?php echo explode("--", $auditedFinancialSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $inhouseFinancialSelect)[0]; ?>', 'inhouseFinancialSelect', 'inhouseFinancialDesc', '<?php echo explode("--", $inhouseFinancialSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $businessBankStatementSelect)[0]; ?>', 'businessBankStatementSelect', 'businessBankStatementDesc', '<?php echo explode("--", $businessBankStatementSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $salesRecordSelect)[0]; ?>', 'salesRecordSelect', 'salesRecordDesc', '<?php echo explode("--", $salesRecordSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $incomeTaxReturnSelect)[0]; ?>', 'incomeTaxReturnSelect', 'incomeTaxReturnDesc', '<?php echo explode("--", $incomeTaxReturnSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $contractLeaseSelect)[0]; ?>', 'contractLeaseSelect', 'contractLeaseDesc', '<?php echo explode("--", $contractLeaseSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $customerNumberSelect)[0]; ?>', 'customerNumberSelect', 'customerNumberDesc', '<?php echo explode("--", $customerNumberSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $customerSupplierSelect)[0]; ?>', 'customerSupplierSelect', 'customerSupplierDesc', '<?php echo explode("--", $customerSupplierSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $otherIncomeBSelect)[0]; ?>', 'otherIncomeBSelect', 'otherIncomeBDesc', '<?php echo explode("--", $otherIncomeBSelect)[1]; ?>');
// EMPLOYED PROOF OF INCOME
selectOptionBasedOnValue('<?php echo explode("--", $employmentContractSelect)[0]; ?>', 'employmentContractSelect', 'employmentContractDesc', '<?php echo explode("--", $employmentContractSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $certificateEmploymentSelect)[0]; ?>', 'certificateEmploymentSelect', 'certificateEmploymentDesc', '<?php echo explode("--", $certificateEmploymentSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $incomeTaxSelect)[0]; ?>', 'incomeTaxSelect', 'incomeTaxDesc', '<?php echo explode("--", $incomeTaxSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $payslipMonthsSelect)[0]; ?>', 'payslipMonthsSelect', 'payslipMonthsDesc', '<?php echo explode("--", $payslipMonthsSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $otherIncomeSelect)[0]; ?>', 'otherIncomeSelect', 'otherIncomeDesc', '<?php echo explode("--", $otherIncomeSelect)[1]; ?>');
// OTHERS
selectOptionBasedOnValue('<?php echo explode("--", $powerAttorneyISelect)[0]; ?>', 'powerAttorneyISelect', 'powerAttorneyIDesc', '<?php echo explode("--", $powerAttorneyISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $generalInfoSelect)[0]; ?>', 'generalInfoSelect', 'generalInfoDesc', '<?php echo explode("--", $generalInfoSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $securityExchangeSelect)[0]; ?>', 'securityExchangeSelect', 'securityExchangeDesc', '<?php echo explode("--", $securityExchangeSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $letterGuaranteeSelect)[0]; ?>', 'letterGuaranteeSelect', 'letterGuaranteeDesc', '<?php echo explode("--", $letterGuaranteeSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $boardResolutionSelect)[0]; ?>', 'boardResolutionSelect', 'boardResolutionDesc', '<?php echo explode("--", $boardResolutionSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $statementAccountSelect)[0]; ?>', 'statementAccountISelect', 'statementAccountIDesc', '<?php echo explode("--", $statementAccountSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $billMaterialSelect)[0]; ?>', 'billMaterialSelect', 'billMaterialDesc', '<?php echo explode("--", $billMaterialSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $proposedPlanSelect)[0]; ?>', 'proposedPlanSelect', 'proposedPlanDesc', '<?php echo explode("--", $proposedPlanSelect)[1]; ?>');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo explode("--", $receiptSelect)[0]; ?>', 'receiptSelect', 'receiptDesc', '<?php echo explode("--", $receiptSelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $creditInvestigationReportISelect)[0]; ?>', 'creditInvestigationReportISelect', 'creditInvestigationReportIDesc', '<?php echo explode("--", $creditInvestigationReportISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $collateralAppraisalReportISelect)[0]; ?>', 'collateralAppraisalReportISelect', 'collateralAppraisalReportIDesc', '<?php echo explode("--", $collateralAppraisalReportISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $financialEvaluationISelect)[0]; ?>', 'financialEvaluationISelect', 'financialEvaluationIDesc', '<?php echo explode("--", $financialEvaluationISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedLetterISelect)[0]; ?>', 'signedLetterISelect', 'signedLetterIDesc', '<?php echo explode("--", $signedLetterISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedLetterUnderEndISelect)[0]; ?>', 'signedLetterUnderEndISelect', 'signedLetterUnderEndIDesc', '<?php echo explode("--", $signedLetterUnderEndISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedLoanMemoISelect)[0]; ?>', 'signedLoanMemoISelect', 'signedLoanMemoIDesc', '<?php echo explode("--", $signedLoanMemoISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $remContractISelect)[0]; ?>', 'remContractISelect', 'remContractIDesc', '<?php echo explode("--", $remContractISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $remContractAnnotatedISelect)[0]; ?>', 'remContractAnnotatedISelect', 'remContractAnnotatedIDesc', '<?php echo explode("--", $remContractAnnotatedISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $promNoteISelect)[0]; ?>', 'promNoteISelect', 'promNoteIDesc', '<?php echo explode("--", $promNoteISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $disclosureStateISelect)[0]; ?>', 'disclosureStateISelect', 'disclosureStateIDesc', '<?php echo explode("--", $disclosureStateISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $mriFormISelect)[0]; ?>', 'mriFormISelect', 'mriFormIDesc', '<?php echo explode("--", $mriFormISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $amortScheduleISelect)[0]; ?>', 'amortScheduleISelect', 'amortScheduleIDesc', '<?php echo explode("--", $amortScheduleISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $remContractEndISelect)[0]; ?>', 'remContractEndISelect', 'remContractEndIDesc', '<?php echo explode("--", $remContractEndISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $promNoteEndISelect)[0]; ?>', 'promNoteEndISelect', 'promNoteEndIDesc', '<?php echo explode("--", $promNoteEndISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $disclosureStateEndISelect)[0]; ?>', 'disclosureStateEndISelect', 'disclosureStateEndIDesc', '<?php echo explode("--", $disclosureStateEndISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $mriFormEndISelect)[0]; ?>', 'mriFormEndISelect', 'mriFormEndIDesc', '<?php echo explode("--", $mriFormEndISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $amortScheduleEndISelect)[0]; ?>', 'amortScheduleEndISelect', 'amortScheduleEndIDesc', '<?php echo explode("--", $amortScheduleEndISelect)[1]; ?>');
selectOptionBasedOnValue('<?php echo explode("--", $signedDeedUnderEndISelect)[0]; ?>', 'signedDeedUnderEndISelect', 'signedDeedUnderEndIDesc', '<?php echo explode("--", $signedDeedUnderEndISelect)[1]; ?>');
</script>



<script>
function initializeCheckboxes() {  
  var powerAttorneyIValue = "<?php echo $powerAttorneyICheck; ?>";
  var generalInfoValue = "<?php echo $generalInfoCheck; ?>";
  var securityExchangeValue = "<?php echo $securityExchangeCheck; ?>";
  var letterGuaranteeValue = "<?php echo $letterGuaranteeCheck; ?>";
  var boardResolutionValue = "<?php echo $boardResolutionCheck; ?>";
  var statementAccountIValue = "<?php echo $statementAccountICheck; ?>";
  var billMaterialValue = "<?php echo $billMaterialCheck; ?>";
  var proposedPlanValue = "<?php echo $proposedPlanCheck; ?>";
  // Get the checkbox elements
  const powerAttorneyICheck = document.getElementById('powerAttorneyICheck');
  const generalInfoCheck = document.getElementById('generalInfoCheck');
  const securityExchangeCheck = document.getElementById('securityExchangeCheck');
  const letterGuaranteeCheck = document.getElementById('letterGuaranteeCheck');
  const boardResolutionCheck = document.getElementById('boardResolutionCheck');
  const statementAccountICheck = document.getElementById('statementAccountICheck');
  const billMaterialCheck = document.getElementById('billMaterialCheck');
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

showInput(powerAttorneyIValue, powerAttorneyICheck,'powerAttorneyI', 'powerAttorneyISelect', 'powerAttorneyIDesc',`powerAttorneyIImage` );
showInput(generalInfoValue, generalInfoCheck,'generalInfo', 'generalInfoSelect', 'generalInfoDesc',`generalInfoImage`);
showInput(securityExchangeValue, securityExchangeCheck,'securityExchange', 'securityExchangeSelect', 'securityExchangeDesc',`securityExchangeImage`);
showInput(letterGuaranteeValue, letterGuaranteeCheck, 'letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc',`letterGuaranteeImage`);
showInput(boardResolutionValue, boardResolutionCheck, 'boardResolution', 'boardResolutionSelect', 'boardResolutionDesc',`boardResolutionImage`);
showInput(statementAccountIValue, statementAccountICheck, 'statementAccountI', 'statementAccountISelect', 'statementAccountIDesc',`statementAccountImage`);
showInput(billMaterialValue, billMaterialCheck, 'billMaterial', 'billMaterialSelect', 'billMaterialDesc',`billMaterialImage`);
showInput(proposedPlanValue, proposedPlanCheck,'proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc',`proposedPlanImage`);



}
// Call the function to initialize the checkboxes on page load
initializeCheckboxes();

</script>

</script>

<script>
function initializePastCheck() {  
  var pastCheckVal = "<?php echo $pastCheck; ?>";

  // Get the checkbox elements
  const pastCheckk = document.getElementById('pastCheck');

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

document.getElementById("powerAttorneyICheck").addEventListener("click", function() {
    toggleVisibility('powerAttorneyI');
});

document.getElementById("generalInfoCheck").addEventListener("click", function() {
    toggleVisibility('generalInfo');
});

document.getElementById("securityExchangeCheck").addEventListener("click", function() {
    toggleVisibility('securityExchange');
});
document.getElementById("letterGuaranteeCheck").addEventListener("click", function() {
    toggleVisibility('letterGuarantee');
});

document.getElementById("boardResolutionCheck").addEventListener("click", function() {
    toggleVisibility('boardResolution');
});

document.getElementById("statementAccountICheck").addEventListener("click", function() {
    toggleVisibility('statementAccountI');

});
document.getElementById("billMaterialCheck").addEventListener("click", function() {
    toggleVisibility('billMaterial');
});

document.getElementById("proposedPlanCheck").addEventListener("click", function() {
    toggleVisibility('proposedPlan');

});

</script>
<script>
// RESET THE VALUE OF SELECT TO ZERO(OPTION)
  function resetIndex(targetId,targetSelect,targetDesc){
  document.getElementById(targetId).addEventListener('change', function() {
  var selectElement = document.getElementById(targetSelect,"loanAppFormIDate");
  selectElement.selectedIndex = 0;
  document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
  });
  }
// PRINCIPAL BORROWER
resetIndex('endorsement', 'endorsementSelect', 'endorsementDesc');
resetIndex('loanAppFormI', 'loanAppFormISelect', 'loanAppFormIDesc');
resetIndex('photocopyIdSignatures', 'photocopyIdSignaturesSelect', 'photocopyIdSignaturesDesc');
resetIndex('proofBilling', 'proofBillingSelect', 'proofBillingDesc');
resetIndex('personalBank', 'personalBankSelect', 'personalBankDesc');
resetIndex('marriageContract', 'marriageContractSelect', 'marriageContractDesc');
resetIndex('barangayClearance', 'barangayClearanceSelect', 'barangayClearanceDesc');
// COLLATERAL DOCUMENTS
resetIndex('transferCertificate', 'transferCertificateSelect', 'transferCertificateDesc');
resetIndex('taxDeclarationLot', 'taxDeclarationLotSelect', 'taxDeclarationLotDesc');
resetIndex('taxDeclarationImp', 'taxDeclarationImpSelect', 'taxDeclarationImpDesc');
resetIndex('realEstateTaxClearance', 'realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
resetIndex('realEstateTaxReceipt', 'realEstateTaxReceiptSelect', 'realEstateTaxReceiptDesc');
resetIndex('cancellationDischarge', 'cancellationDischargeSelect', 'cancellationDischargeDesc');
// SUNTRUST DOCUMENTS
resetIndex('sunTransferCertificate', 'sunTransferCertificateSelect', 'sunTransferCertificateDesc');
resetIndex('sunTaxDeclarationLot', 'sunTaxDeclarationLotSelect', 'sunTaxDeclarationLotDesc');
resetIndex('sunTaxDeclarationImp', 'sunTaxDeclarationImpSelect', 'sunTaxDeclarationImpDesc');
resetIndex('sunContractSell', 'sunContractSellSelect', 'sunContractSellDesc');
resetIndex('sunStatementAccount', 'sunStatementAccountSelect', 'sunStatementAccountDesc');
// BUSINESS PROOF OF INCOME
resetIndex('updatedBusiness', 'updatedBusinessSelect', 'updatedBusinessDesc');
resetIndex('auditedFinancial', 'auditedFinancialSelect', 'auditedFinancialDesc');
resetIndex('inhouseFinancial', 'inhouseFinancialSelect', 'inhouseFinancialDesc');
resetIndex('businessBankStatement', 'businessBankStatementSelect', 'businessBankStatementDesc');
resetIndex('salesRecord', 'salesRecordSelect', 'salesRecordDesc');
resetIndex('incomeTaxReturn', 'incomeTaxReturnSelect', 'incomeTaxReturnDesc');
resetIndex('contractLease', 'contractLeaseSelect', 'contractLeaseDesc');
resetIndex('customerNumber', 'customerNumberSelect', 'customerNumberDesc');
resetIndex('customerSupplier', 'customerSupplierSelect', 'customerSupplierDesc');
resetIndex('otherIncomeB', 'otherIncomeBSelect', 'otherIncomeBDesc');
// EMPLOYED PROOF OF INCOME
resetIndex('employmentContract', 'employmentContractSelect', 'employmentContractDesc');
resetIndex('certificateEmployment', 'certificateEmploymentSelect', 'certificateEmploymentDesc');
resetIndex('incomeTax', 'incomeTaxSelect', 'incomeTaxDesc');
resetIndex('payslipMonths', 'payslipMonthsSelect', 'payslipMonthsDesc');
resetIndex('otherIncome', 'otherIncomeSelect', 'otherIncomeDesc');
// OTHERS
resetIndex('powerAttorneyI', 'powerAttorneyISelect', 'powerAttorneyIDesc');
resetIndex('generalInfo', 'generalInfoSelect', 'generalInfoDesc');
resetIndex('securityExchange', 'securityExchangeSelect', 'securityExchangeDesc');
resetIndex('letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc');
resetIndex('boardResolution', 'boardResolutionSelect', 'boardResolutionDesc');
resetIndex('statementAccountI', 'statementAccountISelect', 'statementAccountIDesc');
resetIndex('billMaterial', 'billMaterialSelect', 'billMaterialDesc');
resetIndex('proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc');
// DOCUMENTS
resetIndex('receipt', 'receiptSelect', 'receiptDesc');
resetIndex('creditInvestigationReportI', 'creditInvestigationReportISelect', 'creditInvestigationReportIDesc');
resetIndex('collateralAppraisalReportI', 'collateralAppraisalReportISelect', 'collateralAppraisalReportIDesc');
resetIndex('financialEvaluationI', 'financialEvaluationISelect', 'financialEvaluationIDesc');
resetIndex('signedLetterI', 'signedLetterISelect', 'signedLetterIDesc');
resetIndex('signedLoanMemoI', 'signedLoanMemoISelect', 'signedLoanMemoIDesc');
resetIndex('remContractI', 'remContractISelect', 'remContractIDesc');
resetIndex('promNoteI', 'promNoteISelect', 'promNoteIDesc');
resetIndex('disclosureStateI', 'disclosureStateISelect', 'disclosureStateIDesc');
resetIndex('mriFormI', 'mriFormISelect', 'mriFormIDesc');
resetIndex('remContractAnnotatedI', 'remContractAnnotatedISelect', 'remContractAnnotatedIDesc');
resetIndex('signedLetterUnderEndI', 'signedLetterUnderEndISelect', 'signedLetterUnderEndIDesc');
resetIndex('remContractEndI', 'remContractEndISelect', 'remContractEndIDesc');
resetIndex('promNoteEndI', 'promNoteEndISelect', 'promNoteEndIDesc');
resetIndex('disclosureStateEndI', 'disclosureStateEndISelect', 'disclosureStateEndIDesc');
resetIndex('mriFormEndI', 'mriFormEndISelect', 'mriFormEndIDesc');
resetIndex('signedDeedUnderEndI', 'signedDeedUnderEndISelect', 'signedDeedUnderEndIDesc');
resetIndex('loanAppFormI', 'loanAppFormISelect', 'loanAppFormIDesc');
resetIndex('amortScheduleI', 'amortScheduleISelect', 'amortScheduleIDesc');
resetIndex('amortScheduleEndI', 'amortScheduleEndISelect', 'amortScheduleEndIDesc');
resetIndex('utilization', 'utilizationSelect', 'utilizationDesc');

</script> 

<!-- <script>
   // Hidden Letter & Legal
   function hiddenLetter(){
      var late = $('#hiddenLate').val();
      var fLetter = $('#hiddenif').val();
      var fLetter2 = $('#hiddenif2').val();
      var fLetterSelect = $('#ifLetterSelect').val();
      var sLetter = $('#hiddenis').val();
      var sLetter2 = $('#hiddenis2').val();
      var sLetterSelect = $('isLetterSelect').val();
      var tLetter = $('#hiddenit').val();
      var tLetter2 = $('#hiddenit2').val();
      var tLetterSelect = $('itLetterSelect').val();
      // if true = & disable || readonly.
      if(late >= 1 && late <= 30){
         document.getElementById('ifLetter').style.visibility = "true";
         document.getElementById('ifLetter2').style.visibility = "true";
         document.getElementById('ifLetter3').style.visibility = "true";
         document.getElementById('ifLetterSelect').style.visibility = "true";
         document.getElementById('ifLetterImage').style.visibility = "true";
         document.getElementById('ifLetter2Image').style.visibility = "true";
         document.getElementById('ifLetter3Image').style.visibility = "true";
      }
      else{
         if(late <= 0){
            document.getElementById('ifLetter').style.visibility = "hidden";
            document.getElementById('ifLetter2').style.visibility = "hidden";
            document.getElementById('ifLetter3').style.visibility = "hidden";
            document.getElementById('ifLetterSelect').style.visibility = "hidden";
            document.getElementById('ifLetterImage').style.visibility = "hidden";
            document.getElementById('ifLetter2Image').style.visibility = "hidden";
            document.getElementById('ifLetter3Image').style.visibility = "hidden";
         }
      }
      if(fLetterSelect != '' && fLetter != '' && fLetter2 != '' && late >= 31 && late <= 60){
         document.getElementById('isLetter').style.visibility = "true";
         document.getElementById('isLetter2').style.visibility = "true";
         document.getElementById('isLetter3').style.visibility = "true";
         document.getElementById('isLetterSelect').style.visibility = "true";
         document.getElementById('isLetterImage').style.visibility = "true";
         document.getElementById('isLetter2Image').style.visibility = "true";
         document.getElementById('isLetter3Image').style.visibility = "true";
      }else{
         document.getElementById('isLetter').style.visibility = "hidden";
         document.getElementById('isLetter2').style.visibility = "hidden";
         document.getElementById('isLetter3').style.visibility = "hidden";
         document.getElementById('isLetterSelect').style.visibility = "hidden";
         document.getElementById('isLetterImage').style.visibility = "hidden";
         document.getElementById('isLetter2Image').style.visibility = "hidden";
         document.getElementById('isLetter3Image').style.visibility = "hidden";
      }
      if(sLetter != '' && sLetterSelect != '' && sLetter2 != '' && late >= 61 && late <= 91){
         document.getElementById('itLetter').style.visibility = "true";
         document.getElementById('itLetter2').style.visibility = "true";
         document.getElementById('itLetter3').style.visibility = "true";
         document.getElementById('itLetterSelect').style.visibility = "true";
         document.getElementById('itLetterImage').style.visibility = "true";
         document.getElementById('itLetter2Image').style.visibility = "true";
         document.getElementById('itLetter3Image').style.visibility = "true";
      }else{
         document.getElementById('itLetter').style.visibility = "hidden";
         document.getElementById('itLetter2').style.visibility = "hidden";
         document.getElementById('itLetter3').style.visibility = "hidden";
         document.getElementById('itLetterSelect').style.visibility = "hidden";
         document.getElementById('itLetterImage').style.visibility = "hidden";
         document.getElementById('itLetter2Image').style.visibility = "hidden";
         document.getElementById('itLetter3Image').style.visibility = "hidden";
      }
      if(tLetter != '' && tLetterSelect != '' && tLetter2 != '' && late >= 92){ // up to 107 days late
         document.getElementById('ifdLetter').style.visibility = "true";
         document.getElementById('ifdLetter2').style.visibility = "true";
         document.getElementById('ifdLetter3').style.visibility = "true";
         document.getElementById('ifdLetterSelect').style.visibility = "true";
         document.getElementById('ifdLetterImage').style.visibility = "true";
         document.getElementById('ifdLetter2Image').style.visibility = "true";
         document.getElementById('ifdLetter3Image').style.visibility = "true";
      }else{
         document.getElementById('ifdLetter').style.visibility = "hidden";
         document.getElementById('ifdLetter2').style.visibility = "hidden";
         document.getElementById('ifdLetter3').style.visibility = "hidden";
         document.getElementById('ifdLetterSelect').style.visibility = "hidden";
         document.getElementById('ifdLetterImage').style.visibility = "hidden";
         document.getElementById('ifdLetter2Image').style.visibility = "hidden";
         document.getElementById('ifdLetter3Image').style.visibility = "hidden";
      }
   }
   hiddenLetter();
</script> -->

<script>
  function handleSearch() {
    // Buttons Selectors
    const selectElements = document.querySelectorAll('#individual select');
    const descriptionInputs = document.querySelectorAll('#individual input[type=text]');
    const inputFiles = document.querySelectorAll('.individual-tabs input[type=file]');
    const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');

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
      document.getElementById("creditInvestigationReportI").style.display="none";
   } 
   if(username!=="tmgavituya" && department !=="1"){
      document.getElementById("collateralAppraisalReportI").style.display="none";
   } 
   if(username!=="irmilano" && department !=="1"){
      document.getElementById("financialEvaluationI").style.display="none";
      document.getElementById("excel").style.display="none";
   } 
   if(username!=="apreyes" && department !=="1"){
      document.getElementById("signedLetterI").style.display="none";
      document.getElementById("signedLoanMemoI").style.display="none";
      document.getElementById("signedDeedUnderEndI").style.display="none";
      // PN-DS-AS
      document.getElementById("promNoteI").style.display="none";
      document.getElementById("disclosureStateI").style.display="none";
      document.getElementById("mriFormI").style.display="none";
      document.getElementById("amortScheduleI").style.display="none";
      // PN-DS-AS END BUYER
      document.getElementById("promNoteEndI").style.display="none";
      document.getElementById("disclosureStateEndI").style.display="none";
      document.getElementById("mriFormEndI").style.display="none";
      document.getElementById("amortScheduleEndI").style.display="none";
      //  PRESENTATION
      document.getElementById("powerpoint").style.display="none";
   } 
   if(department!=="3" && department !=="1"){
      document.getElementById("remContractI").style.display="none";
      document.getElementById("remContractEndI").style.display="none";
   } 
   if(username!=="jdiokno" && username!=="lverder" && department !=="1"){
      document.getElementById("remContractAnnotatedI").style.display="none";
   } 
   if(bankposition!=="Collection Officer" &&  department !=="1"){
      document.getElementById("utilization").style.display="none";
   } 

   if(department !== "6" && department !== "1"){
      document.getElementById("ifLetter").style.visibility="hidden";
      document.getElementById("ifLetter2").style.visibility="hidden";
      document.getElementById("ifLetter3").style.visibility="hidden";
      document.getElementById("isLetter").style.visibility="hidden";
      document.getElementById("isLetter2").style.visibility="hidden";
      document.getElementById("isLetter3").style.visibility="hidden";
      document.getElementById("itLetter").style.visibility="hidden";
      document.getElementById("itLetter2").style.visibility="hidden";
      document.getElementById("itLetter3").style.visibility="hidden";
      document.getElementById("ifdLetter").style.visibility="hidden";
      document.getElementById("ifdLetter2").style.visibility="hidden";
      document.getElementById("ifdLetter3").style.visibility="hidden";
      document.getElementById("iclientReq1").style.visibility="hidden";
      document.getElementById("iclientReq2").style.visibility="hidden";
      document.getElementById("iclientReq3").style.visibility="hidden";
      // 
      document.getElementById("iffClosure").style.visibility="hidden";
      document.getElementById("pastLitigation").style.visibility="hidden";
      document.getElementById("pastLitigation2").style.visibility="hidden";
      document.getElementById("pastCheck").style.visibility="hidden";
      document.getElementById("label23").style.visibility="hidden";
      document.getElementById("ittLitigation").style.visibility="hidden";
      document.getElementById("prepConso").style.visibility="hidden";
      document.getElementById("iaDemand").style.visibility="hidden";
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
showText('ifLetterSelect','70%');
showText('isLetterSelect','70%');
showText('itLetterSelect','70%');
showText('ifdLetterSelect','70%');

showText('iffClosureSelect','70%');
showText('pastLitigationSelect','70%');
showText('prepConsoSelect','70%');
showText('ittLitigationSelect','70%');
showText('iaDemandSelect','70%');

showText('iclientReq1Select', '70%');

</script>


</body>
</html>

<!-- ITUTULOY MO DITO BACKEND KANA -->