<?php 
include('connection.php');
include('mailLoan.php');
ini_set('max_execution_time', '0');
?>

INDIVIDUAL MAILER:
<?php

$sqlSelect = "SELECT * FROM individual JOIN loan ON individual.indivLoanId = loan.loan_Id WHERE `loan.status` <> 1";
$data = mysqli_query($con, $sqlSelect);
ini_set('display_errors', 1);
error_reporting(E_ALL);

if($data){
    $count = 1;
    while ($row = mysqli_fetch_array($data)) {
        $clientName=$row['customerFullName'];
        echo "Count: " . $count . "." . " $clientName ";
        $count++;
  // PRINCIPAL BORROWER
        $remType =$row['remType'];
        $sourceIncome =$row['sourceIncome'];
        $branch =$row['branch'];          
        $progress =$row['progress'];

        $loanAppFormI = $row['loanAppFormI'];
        $endorsement = $row['endorsement'];
        $photocopyIdSignatures = $row['photocopyIdSignatures'];
        $proofBilling = $row['proofBilling'];
        $personalBank = $row['personalBank'];
        $marriageContract = $row['marriageContract'];
        $barangayClearance = $row['barangayClearance'];
        // COLLATERAL DOCUMENTS
        $transferCertificate = $row['transferCertificate'];
        $taxDeclarationLot = $row['taxDeclarationLot'];
        $taxDeclarationImp = $row['taxDeclarationImp'];
        $realEstateTaxClearance = $row['realEstateTaxClearance'];
        $realEstateTaxReceipt = $row['realEstateTaxReceipt'];
        $cancellationDischarge = $row['cancellationDischarge'];
        // SUNTRUST DOCUMENTS
        $sunTransferCertificate = $row['sunTransferCertificate'];
        $sunTaxDeclarationLot = $row['sunTaxDeclarationLot'];
        $sunTaxDeclarationImp = $row['sunTaxDeclarationImp'];
        $sunContractSell = $row['sunContractSell'];
        $sunStatementAccount = $row['sunStatementAccount'];
        // BUSINESS PROOF OF INCOME
        $updatedBusiness = $row['updatedBusiness'];
        $auditedFinancial = $row['auditedFinancial'];
        $inhouseFinancial = $row['inhouseFinancial'];
        $businessBankStatement = $row['businessBankStatement'];
        $salesRecord = $row['salesRecord'];
        $incomeTaxReturn = $row['incomeTaxReturn'];
        $contractLease = $row['contractLease'];
        $customerNumber = $row['customerNumber'];
        $customerSupplier = $row['customerSupplier'];
        $otherIncomeB = $row['otherIncomeB'];
        // EMPLOYED PROOF OF INCOME
        $employmentContract = $row['employmentContract'];
        $certificateEmployment = $row['certificateEmployment'];
        $incomeTax = $row['incomeTax'];
        $payslipMonths = $row['payslipMonths'];
        $otherIncome = $row['otherIncome'];
        // OTHERS
        $powerAttorneyI = $row['powerAttorneyI'];
        $generalInfo = $row['generalInfo'];
        $securityExchange = $row['securityExchange'];
        $letterGuarantee = $row['letterGuarantee'];
        $boardResolution = $row['boardResolution'];
        $statementAccountI = $row['statementAccount'];
        $billMaterial = $row['billMaterial'];
        $proposedPlan = $row['proposedPlan'];
        $otherDoc = $row['otherDoc'];
        // DOCUMENTS
        $receipt = $row['receipt'];
        $creditInvestigationReportI = $row['creditInvestigationReportI'];
        $collateralAppraisalReportI = $row['collateralAppraisalReportI'];
        $financialEvaluationI = $row['financialEvaluationI'];
        $signedLetterI = $row['signedLetterI'];
        $signedLoanMemoI = $row['signedLoanMemoI'];            
        $remContractI = $row['remContractI'];
        $promNoteI = $row['promNoteI'];
        $disclosureStateI = $row['disclosureStateI'];
        $mriFormI = $row['mriFormI'];
        $remContractAnnotatedI = $row['remContractAnnotatedI'];
        $signedLetterUnderEndI = $row['signedLetterUnderEndI'];
        $remContractEndI = $row['remContractEndI'];
        $promNoteEndI = $row['promNoteEndI'];
        $disclosureStateEndI = $row['disclosureStateEndI'];
        $mriFormEndI = $row['mriFormEndI'];
        $signedDeedUnderEndI = $row['signedDeedUnderEndI'];
        $amortScheduleI = $row['amortScheduleI'];
        $amortScheduleEndI = $row['amortScheduleEndI'];
        $utilization=$row['utilization'];
        $powerpoint=$row['powerpoint'];
        $excel=$row['excel'];



        $endorsementSelect = $row['endorsementStatus'];
        $loanAppFormISelect = $row['loanAppFormIStatus'];
        $photocopyIdSignaturesSelect = $row['photocopyIdSignaturesStatus'];
        $proofBillingSelect = $row['proofBillingStatus'];
        $personalBankSelect = $row['personalBankStatus'];
        $marriageContractSelect = $row['marriageContractStatus'];
        $barangayClearanceSelect = $row['barangayClearanceStatus'];
        // COLLATERAL DOCUMENTS
        $transferCertificateSelect = $row['transferCertificateStatus'];
        $taxDeclarationLotSelect = $row['taxDeclarationLotStatus'];
        $taxDeclarationImpSelect = $row['taxDeclarationImpStatus'];
        $realEstateTaxClearanceSelect = $row['realEstateTaxClearanceStatus'];
        $realEstateTaxReceiptSelect = $row['realEstateTaxReceiptStatus'];
        $cancellationDischargeSelect = $row['cancellationDischarageStatus'];
        // SUNTRUST DOCUMENTS
        $sunTransferCertificateSelect = $row['sunTransferCertificateStatus'];
        $sunTaxDeclarationLotSelect = $row['sunTaxDeclarationLotStatus'];
        $sunTaxDeclarationImpSelect = $row['sunTaxDeclarationImpStatus'];
        $sunContractSellSelect = $row['sunContractSellStatus'];
        $sunStatementAccountSelect = $row['sunStatementAccountStatus'];
        // BUSINESS PROOF OF INCOME
        $updatedBusinessSelect = $row['updatedBusinessStatus'];
        $auditedFinancialSelect = $row['auditedFinancialStatus'];
        $inhouseFinancialSelect = $row['inhouseFinancialStatus'];
        $businessBankStatementSelect = $row['businessBankStatementStatus'];
        $salesRecordSelect = $row['salesRecordStatus'];
        $incomeTaxReturnSelect = $row['incomeTaxReturnStatus'];
        $contractLeaseSelect = $row['contractLeaseStatus'];
        $customerNumberSelect = $row['customerNumberStatus'];
        $customerSupplierSelect = $row['customerSupplierStatus'];
        $otherIncomeBSelect = $row['otherIncomeBStatus'];
        // EMPLOYED PROOF OF INCOME
        $employmentContractSelect = $row['employmentContractStatus'];
        $certificateEmploymentSelect = $row['certificateEmploymentStatus'];
        $incomeTaxSelect = $row['incomeTaxStatus'];
        $payslipMonthsSelect = $row['payslipMonthsStatus'];
        $otherIncomeSelect = $row['otherIncomeStatus'];
        // DOCUMENTS
        $creditInvestigationReportISelect = $row['creditInvestigationReportIStatus'];
        $collateralAppraisalReportISelect = $row['collateralAppraisalReportIStatus'];
        $financialEvaluationISelect = $row['financialEvaluationIStatus'];
        $signedLetterISelect = $row['signedLetterIStatus'];
        $signedLetterUnderEndISelect = $row['signedLetterUnderEndIStatus'];
        $signedLoanMemoISelect = $row['signedLoanMemoIStatus'];
        $remContractISelect = $row['remContractIStatus'];
        $remContractAnnotatedISelect = $row['remContractAnnotatedIStatus'];
        $promNoteISelect = $row['promNoteIStatus'];
        $disclosureStateISelect = $row['disclosureStateIStatus'];
        $mriFormISelect = $row['mriFormIStatus'];
        $amortScheduleISelect = $row['amortScheduleIStatus'];
        $remContractEndISelect = $row['remContractEndIStatus'];
        $promNoteEndISelect = $row['promNoteEndIStatus'];
        $disclosureStateEndISelect = $row['disclosureStateEndIStatus'];
        $mriFormEndISelect = $row['mriFormEndIStatus'];
        $amortScheduleEndISelect = $row['amortScheduleEndIStatus'];
        $signedDeedUnderEndISelect = $row['signedDeedUnderEndIStatus'];

          // PRINCIPAL BORROWER
        $endorsementName = "ENDORSEMENT LETTER";
        $loanAppFormIName = "LOAN APPLICATION FORM.";
        $photocopyIdSignaturesName = "PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED IDs WITH 3 SIGNATURES.";
        $proofBillingName = "PROOF OF BILLING (MERALCO, INTERNEET BILL, WATER BILL).";
        $personalBankName = "PERSONAL-BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS.";
        $marriageContractName = "MARRIAGE CONTRACT (IF MARRIED) *CENOMAR (IF SINGLE)";
        $barangayClearanceName = "BARANGAY CLEARANCE FOR LOAN PURPOSE.";
          // COLLATERAL DOCUMENTS
        $transferCertificateName = "TRANSFER CERTIFICATE OF TITLE (ORIGINAL & CERTIFIED TRUE COPY).";
        $taxDeclarationLotName = "TAX DECLARATION (LOT - CERTIFIED TRUE COPY).";
        $taxDeclarationImpName = "TAX DECLARATION (IMPROVEMENT - CERTIFIED TRUE COPY).";
        $realEstateTaxClearanceName = "REAL ESTATE TAX CLEARANCE.";
        $realEstateTaxReceiptName = "REAL ESTATE TAX RECEIPT (AMILYAR).";
          // SUNTRUST DOCUMENTS
        $sunTransferCertificateName = "COPY OF TRANSFER CERTIFICATE OF TITLE.";
        $sunTaxDeclarationLotName = "TAX DECLARATION (LOT-COPY).";
        $sunTaxDeclarationImpName = "TAX DECLARATION (IMPROVEMENT - COPY).";
        $sunContractSellName = "CONTRACT TO SELL.";
        $sunStatementAccountName = "STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY.";
          // BUSINESS PROOF OF INCOME
        $updatedBusinessName = "UPDATED BUSINESS PERMIT (MAYOR'S, BARANGAY AND/OR DTI).";
        $auditedFinancialName = "AUDITED FINANCIAL STATEMENT (3 YEARS).";
        $inhouseFinancialName = "IN-HOUSE FINANCIAL STATEMENT (3 YEARS).";
        $businessBankStatementName = "BUSINESS - BANK STATEMENT OR PASSBOOK FOR THE LAST 6 MONTHS.";
        $salesRecordName = "SALES RECORD & PURCHASES RECEIPTS OR LOGBOOK (IF APPLICABLE)";
        $incomeTaxReturnName = "INCOME TAX RETURN (IF APPLICABLE).";
        $contractLeaseName = "CONTRACT OF LEASE (IF RENTAL BUSINESS).";
        $customerNumberName = "5 CUSTOMERS WITH CONTACT NUMBER.";
        $customerSupplierName = "5 SUPPLIERS WITH CONTACT NUMBER.";
         // EMPLOYED PROOF OF INCOME
        $employmentContractName = "EMPLOYMENT CONTRACT.";
        $certificateEmploymentName = "CERTIFICATE OF EMPLOYMENT WITH COMPENSATION.";
        $payslipMonthsName = "PAYSLIP FOR 6 MONTHS.";
        $incomeTaxName = "PAYSLIP FOR 6 MONTHS.";
          // DOCUMENTS
        $creditInvestigationReportIName = "CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT.";
        $collateralAppraisalReportIName = "APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT.";
        $financialEvaluationIName = "FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD.";
        $signedLetterIName = "SIGNED LETTER OF APPROVAL.";
        $signedLoanMemoIName = "SIGNED LETTER OF UNDERTAKING.";
        $remContractIName = "REAL ESTATE MORTGAGE CONTRACT.";
        $promNoteIName = "PROMISSORY NOTE.";
        $disclosureStateIName = "DISCLOSURE STATEMENT.";
        $mriFormIName = "INSURANCE DOCUMENTS";
        $amortScheduleIName = "AMORTIZATION SCHEDULE.";
        $remContractAnnotatedIName = "REM CONTRACT ANNOTATED.";
        $signedLetterUnderEndIName = "SIGNED LETTER OF UNDERTAKING.";
        $signedDeedUnderEndIName = "SIGNED DEED OF UNDERTAKING.";

        switch ($branch) {
          case "Head Office":
              $email = "apreyes@ourbank.ph";
              // $email = "vcdyoshino@ourbank.ph";
              break;
          case "Magallanes":
              $email = "joan.reduca@ourbank.ph";
              break;
          case "Ternate":
              $email = "melvin.tabanan@ourbank.ph";
              break;
          case "Maragondon":
              $email = "melody.ruazol@ourbank.ph";
              break;
          case "Manggahan":
              $email = "jennifer.giron@ourbank.ph";
              break;
          case "Noveleta":
              $email = "karen.dianne.dampitan@ourbank.ph";
              break;
          case "Poblacion":
              $email = "jacklyn.sarique@ourbank.ph";
              break;
          default:
              $email = "UNKNOWN/"; // Default value if $branch does not match any case
              break;
      }  

  if($progress =="ONGOING") {
    sendMail($endorsement, $endorsementSelect, $email, $clientName, $endorsementName);
    sendMail($loanAppFormI, $loanAppFormISelect, $email, $clientName, $loanAppFormIName);
    sendMail($photocopyIdSignatures, $photocopyIdSignaturesSelect, $email, $clientName, $photocopyIdSignaturesName);
    sendMail($proofBilling, $proofBillingSelect, $email, $clientName, $proofBillingName);
    sendMail($personalBank, $personalBankSelect, $email, $clientName, $personalBankName);
    sendMail($marriageContract, $marriageContractSelect, $email, $clientName, $marriageContractName);
    sendMail($barangayClearance, $barangayClearanceSelect, $email, $clientName, $barangayClearanceName);
    
    if (!empty($receipt)) {
      sendMail($creditInvestigationReportI, $creditInvestigationReportISelect, 'tmgavituya@ourbank.ph', $clientName, $creditInvestigationReportIName);
      sendMail($collateralAppraisalReportI, $collateralAppraisalReportISelect, 'tmgavituya@ourbank.ph', $clientName, $collateralAppraisalReportIName);

      sendMail($creditInvestigationReportI, $creditInvestigationReportISelect, 'cevinluan@ourbank.ph', $clientName, $creditInvestigationReportIName);
      sendMail($collateralAppraisalReportI, $collateralAppraisalReportISelect, 'cevinluan@ourbank.ph', $clientName, $collateralAppraisalReportIName);

     }

     if (!empty($creditInvestigationReportI) && !empty($collateralAppraisalReportI)) {
      sendMail($financialEvaluationI, $financialEvaluationISelect, 'irmilano@ourbank.ph', $clientName, $financialEvaluationIName);
     }

        if($remType== "End Buyer"){
            sendMail($sunTransferCertificate, $sunTransferCertificateSelect, $email, $clientName, $sunTransferCertificateName);
            sendMail($sunTaxDeclarationLot, $sunTaxDeclarationLotSelect, $email, $clientName, $sunTaxDeclarationLotName);
            sendMail($sunTaxDeclarationImp, $sunTaxDeclarationImpSelect, $email, $clientName, $sunTaxDeclarationImpName);
            sendMail($sunContractSell, $sunContractSellSelect, $email, $clientName, $sunContractSellName);
            sendMail($sunStatementAccount, $sunStatementAccountSelect, $email, $clientName, $sunStatementAccountName);

            if (!empty($signedLoanMemoI)) {
              // FOR MELLANIE EMAIL AND SIR JONIE
              sendMail($remContractEndI, $remContractEndISelect, 'jonathan.quijano@ourbank.ph', $clientName, $remContractIName);
              // sendMail($remContractEndI, $remContractEndISelect, 'moonsana@ourbank.ph', $clientName, $remContractIName);
              sendMail($remContractEndI, $remContractEndISelect, 'jlcricafrente@ourbank.ph', $clientName, $remContractIName);
            }
            if (!empty($signedLoanMemoI)) {
              sendMail($promNoteEndI, $promNoteEndISelect, 'apreyes@ourbank.ph', $clientName, $promNoteIName);
              sendMail($disclosureStateEndI, $disclosureStateEndISelect, 'apreyes@ourbank.ph', $clientName, $disclosureStateIName);
              sendMail($mriFormEndI, $mriFormEndISelect, 'apreyes@ourbank.ph', $clientName, $mriFormIName);
              sendMail($amortScheduleEndI, $amortScheduleEndISelect, 'apreyes@ourbank.ph', $clientName, $amortScheduleIName);
              sendMail($signedDeedUnderEndI, $signedDeedUnderEndISelect, 'apreyes@ourbank.ph', $clientName, $signedDeedUnderEndIName);
             }


        }else{
          sendMail($transferCertificate, $transferCertificateSelect, $email, $clientName, $transferCertificateName);
          sendMail($taxDeclarationLot, $taxDeclarationLotSelect, $email, $clientName, $taxDeclarationLotName);
          sendMail($taxDeclarationImp, $taxDeclarationImpSelect, $email, $clientName, $taxDeclarationImpName);
          sendMail($realEstateTaxClearance, $realEstateTaxClearanceSelect, $email, $clientName, $realEstateTaxClearanceName);
          sendMail($realEstateTaxReceipt, $realEstateTaxReceiptSelect, $email, $clientName, $realEstateTaxReceiptName);

          if (!empty($signedLoanMemoI)) {
            sendMail($remContractI, $remContractISelect, 'jonathan.quijano@ourbank.ph', $clientName, $remContractIName);
            sendMail($remContractI, $remContractISelect, 'moonsana@ourbank.ph', $clientName, $remContractIName);
            sendMail($remContractI, $remContractISelect, 'jlcricafrente@ourbank.ph', $clientName, $remContractIName);

          }
          if (!empty($remContractI)) {
            sendMail($remContractAnnotatedI, $remContractAnnotatedISelect, 'jesus.diokno@ourbank.ph', $clientName, $remContractAnnotatedIName);
            sendMail($promNoteI, $promNoteISelect, 'apreyes@ourbank.ph', $clientName, $promNoteIName);
            sendMail($disclosureStateI, $disclosureStateISelect, 'apreyes@ourbank.ph', $clientName, $disclosureStateIName);
            sendMail($mriFormI, $mriFormISelect, 'apreyes@ourbank.ph', $clientName, $mriFormIName);
            sendMail($amortScheduleI, $amortScheduleISelect, 'apreyes@ourbank.ph', $clientName, $amortScheduleIName);
        }


        }

        if($sourceIncome =="Business"){
          sendMail($updatedBusiness, $updatedBusinessSelect, $email, $clientName, $updatedBusinessName);
          sendMail($auditedFinancial, $auditedFinancialSelect, $email, $clientName, $auditedFinancialName);
          sendMail($inhouseFinancial, $inhouseFinancialSelect, $email, $clientName, $inhouseFinancialName);
          sendMail($businessBankStatement, $businessBankStatementSelect, $email, $clientName, $businessBankStatementName);
          sendMail($salesRecord, $salesRecordSelect, $email, $clientName, $salesRecordName);
          sendMail($incomeTaxReturn, $incomeTaxReturnSelect, $email, $clientName, $incomeTaxReturnName);
          sendMail($contractLease, $contractLeaseSelect, $email, $clientName, $contractLeaseName);
          sendMail($customerNumber, $customerNumberSelect, $email, $clientName, $customerNumberName);
          sendMail($customerSupplier, $customerSupplierSelect, $email, $clientName, $customerSupplierName);
          
        }else{
          sendMail($employmentContract, $employmentContractSelect, $email, $clientName, $employmentContractName);
          sendMail($certificateEmployment, $certificateEmploymentSelect, $email, $clientName, $certificateEmploymentName);
          sendMail($incomeTax, $incomeTaxSelect, $email, $clientName, $payslipMonthsName);
          sendMail($payslipMonths, $payslipMonthsSelect, $email, $clientName, $incomeTaxName);


        }


  } 
        }

        }
else{
    echo "DATA ERROR". mysqli_error($con);
}

?>







  