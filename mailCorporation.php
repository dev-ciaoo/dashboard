<?php 
include('connection.php');
include('mailLoan.php');
ini_set('max_execution_time', '0');

?>

CORPORATION MAILER:
<?php

$sqlSelect = "SELECT * FROM corporation JOIN loan ON corporation.corpLoanId = loan.loan_Id WHERE `loan.status` <> 1";
$data = mysqli_query($con, $sqlSelect);
ini_set('display_errors', 1);
error_reporting(E_ALL);

if($data){
    $count = 1;
    while ($row = mysqli_fetch_array($data)) {
        $clientName=$row['customerFullName'];

    $remType =$row['remType'];
    $sourceIncome =$row['sourceIncome'];
    $branch =$row['branch'];          
    $progress =$row['progress'];
    // PRINCIPAL BORROWER
    $endorsement = $row['endorsement'];
    $loanAppFormC = $row['loanAppFormC'];
    $companyProfile = $row['ccompanyProfile'];
    $governmentId = $row['governmentId'];
    $secRegistration = $row['csecRegistration'];
    $latestGIS = $row['clatestGIS'];
    $copyBRS = $row['ccopyBRS'];
    $copyidCST = $row['ccopyidCST'];
    // COLLATERAL DOCUMENTS
    $transferCertTitle = $row['ctransferCertTitle'];
    $taxDeclaration = $row['ctaxDeclaration'];
    $taxDeclartionICTC = $row['ctaxDeclartionICTC'];
    $realStateReceipt = $row['crealStateReceipt'];
    $realEstateTaxClearance = $row['crealEstateTaxClearance'];
    $cdOfMorgage = $row['ccdOfMorgage'];
    // BUSINESS PROOF OF INCOME
    $copyUpdatedBP = $row['ccopyUpdatedBP'];
    $auditedFinancial = $row['cauditedFinancial'];
    $inhouseFinancial = $row['cinhouseFinancial'];
    $latestBank = $row['clatestBank'];
    $incomeTaxReturn = $row['incomeTaxReturn'];
    $contractLease = $row['contractLease'];
    $customerContact = $row['ccustomerContact'];
    $supplierContact = $row['csupplierContact'];
    $proofBilling = $row['cproofBilling'];
    // OTHERS
    $powerAttorney = $row['powerAttorney'];
    $contractSell = $row['contractSell'];
    $letterGuarantee = $row['letterGuarantee'];
    $statementAccount = $row['statementAccount'];
    $billMaterials = $row['billMaterials'];
    $proposedPlan = $row['proposedPlan'];
    $otherDoc = $row['otherDoc'];
    // DOCUMENTS
    $receipt = $row['receipt'];
    $creditInvestigationReportC = $row['creditInvestigationReportC'];
    $collateralAppraisalReportC = $row['collateralAppraisalReportC'];
    $financialEvaluationC = $row['financialEvaluationC'];
    $signedLetterC = $row['signedLetterC'];
    $signedLoanMemoC = $row['signedLoanMemoC'];
    $remContractC = $row['remContractC'];
    $promNoteC = $row['promNoteC'];
    $disclosureStateC = $row['disclosureStateC'];
    $mriFormC = $row['mriFormC'];
    $amortScheduleC = $row['amortScheduleC'];
    $remContractAnnotatedC = $row['remContractAnnotatedC'];
    $signedLetterUnderEndC = $row['signedLetterUnderEndC'];
    $remContractEndC = $row['remContractEndC'];
    $promNoteEndC = $row['promNoteEndC'];
    $disclosureStateEndC = $row['disclosureStateEndC'];
    $mriFormEndC = $row['mriFormEndC'];
    $amortScheduleEndC = $row['amortScheduleEndC'];
    $signedDeedUnderEndC = $row['signedDeedUnderEndC'];
    $utilization=$row['utilization'];
    $powerpoint=$row['powerpoint'];
    $excel=$row['excel'];
    // GETTING OF STATUS FROM DATABASE
    // PRINCIPAL BORROWER
    $endorsementSelect = $row['endorsementStatus'];
    $loanAppFormCSelect = $row['loanAppFormCStatus'];
    $companyProfileSelect = $row['ccompanyProfileStatus'];
    $governmentIdSelect = $row['governmentIdStatus'];
    $secRegistrationSelect = $row['csecRegistrationStatus'];
    $latestGISSelect = $row['clatestGISStatus'];
    $copyBRSSelect = $row['ccopyBRSStatus'];
    $copyidCSTSelect = $row['ccopyidCSTStatus'];
    // COLLATERAL DOCUMENTS
    $transferCertTitleSelect = $row['ctransferCertTitleStatus'];
    $taxDeclarationSelect = $row['ctaxDeclarationStatus'];
    $taxDeclartionICTCSelect = $row['ctaxDeclartionICTCStatus'];
    $realStateReceiptSelect = $row['crealStateReceiptStatus'];
    $realEstateTaxClearanceSelect = $row['crealEstateTaxClearanceStatus'];
    $cdOfMorgageSelect = $row['ccdOfMorgageStatus'];
    $copyUpdatedBPSelect = $row['ccopyUpdatedBPStatus'];
    // BUSINESS PROOF OF INCOME
    $auditedFinancialSelect = $row['cauditedFinancialStatus'];
    $inhouseFinancialSelect = $row['cinhouseFinancialStatus'];
    $latestBankSelect = $row['clatestBankStatus'];
    $incomeTaxReturnSelect = $row['incomeTaxReturnStatus'];
    $contractLeaseSelect = $row['contractLeaseStatus'];
    $customerContactSelect = $row['ccustomerContactStatus'];
    $supplierContactSelect = $row['csupplierContactStatus'];
    $proofBillingSelect = $row['cproofBillingStatus'];
    // OTHERS
    $powerAttorneySelect = $row['powerAttorneyStatus'];
    $contractSellSelect = $row['contractSellStatus'];
    $letterGuaranteeSelect = $row['letterGuaranteeStatus'];
    $statementAccountSelect = $row['statementAccountStatus'];
    $billMaterialsSelect = $row['billMaterialsStatus'];
    $proposedPlanSelect = $row['proposedPlanStatus'];
    $otherDocSelect = $row['otherDocStatus'];
    // DOCUMENTS
    $receiptSelect = $row['receiptStatus'];
    $creditInvestigationReportCSelect = $row['creditInvestigationReportCStatus'];
    $collateralAppraisalReportCSelect = $row['collateralAppraisalReportCStatus'];
    $financialEvaluationCSelect = $row['financialEvaluationCStatus'];
    $signedLetterCSelect = $row['signedLetterCStatus'];
    $signedLetterUnderEndCSelect = $row['signedLetterUnderEndCStatus'];
    $signedLoanMemoCSelect = $row['signedLoanMemoCStatus'];
    $remContractCSelect = $row['remContractCStatus'];
    $remContractAnnotatedCSelect = $row['remContractAnnotatedCStatus'];
    $promNoteCSelect = $row['promNoteCStatus'];
    $disclosureStateCSelect = $row['disclosureStateCStatus'];
    $mriFormCSelect = $row['mriFormCStatus'];
    $amortScheduleCSelect = $row['amortScheduleCStatus'];
    $remContractEndCSelect = $row['remContractEndCStatus'];
    $promNoteEndCSelect = $row['promNoteEndCStatus'];
    $disclosureStateEndCSelect = $row['disclosureStateEndCStatus'];
    $mriFormEndCSelect = $row['mriFormEndCStatus'];
    $amortScheduleEndCSelect = $row['amortScheduleEndCStatus'];
    $signedDeedUnderEndCSelect = $row['signedDeedUnderEndCStatus'];
    $utilizationSelect=$row['utilizationStatus'];


            // PRINCIPAL BORROWER
            $loanAppFormCName = "LOAN APPLICATION FORM.";
            $companyProfileName = "COMPANY PROFILE.";
            $governmentIdName = "PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED ID OF REPRESENTATIVE OF LOAN WITH 3 SIGNATURES.";
            $secRegistrationName = "PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS.";
            $latestGISName = "PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GIS).";
            $copyBRSName = "ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE.";
            $copyidCSTName = "PHOTOCOPY OF 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES.";
            // COLLATERAL DOCUMENTS
            $transferCertTitleName = "TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY).";
            $taxDeclarationName = "TAX DECLARTION (LOT-CERTIFIED TRUE COPY).";
            $taxDeclartionICTCName = "TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY).";
            $realStateReceiptName = "REAL ESTATE RECEIPT (AMILYAR).";
            $realEstateTaxClearanceName = "REAL ESTATE TAX CLEARANCE.";
            // BUSINESS PROOF OF INCOME
            $copyUpdatedBPName = "UPDATED BUSINESS PERMIT PERMIT (MAYOR'S, BARANGAY AND/OR DTI).";
            $auditedFinancialName = "PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT.";
            $inhouseFinancialName = "PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT.";
            $latestBankName = "PHOTOCOPY OF AT LEAST 6 MONTHS OF BUSINESS LATEST BANK STATEMENT.";
            $incomeTaxReturnName = "INCOME TAX RETURN (IF APPLICABLE).";
            $contractLeaseName = "CONTRACT OF LEASE.";
            $customerContactName = "5 CUSTOMERS WITH CONTACT NUMBER.";
            $supplierContactName = "5 SUPPLIERS WITH CONTACT NUMBER.";
            $proofBillingName= "PROOF OF BILLING.";
            // DOCUMENTS
            $creditInvestigationReportCName = "CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT.";
            $collateralAppraisalReportCName = "APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT.";
            $financialEvaluationCName = "FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD.";
            $signedLetterCName = "SIGNED LETTER OF APPROVAL.";
            $signedLoanMemoCName = "SIGNED LOAN APPROVAL MEMO.";
            $remContractCName = "REAL ESTATE MORTGAGE CONTRACT.";
            $promNoteCName = "PROMISSORY NOTE.";
            $disclosureStateCName = "DISCLOSURE STATEMENT.";
            $mriFormCName = "MRI FORM (COUNTRY BANKERS).";
            $amortScheduleCName = " AMORTIZATION SCHEDULE.";
            $remContractAnnotatedCName = "REM CONTRACT ANNOTATED.";
            $signedLetterUnderEndCName = "SIGNED LETTER OF UNDERTAKING.";
            $signedDeedUnderEndCName = "SIGNED DEED OF UNDERTAKING.";

            switch ($branch) {
                case "Head Office":
                    $email = "apreyes@ourbank.ph";
                    // $email = "ctborgonia@ourbank.ph";
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

            if($progress =="ONGOING"){
                // PRINCIPAL BORROWER
                sendMail($loanAppFormC, $loanAppFormCSelect, $email, $clientName, $loanAppFormCName);
                sendMail($companyProfile, $companyProfileSelect, $email, $clientName, $companyProfileName);
                sendMail($governmentId, $governmentIdSelect, $email, $clientName, $governmentIdName);
                sendMail($secRegistration, $secRegistrationSelect, $email, $clientName, $secRegistrationName);
                sendMail($latestGIS, $latestGISSelect, $email, $clientName, $latestGISName);
                sendMail($copyBRS, $copyBRSSelect, $email, $clientName, $copyBRSName);
                sendMail($copyidCST, $copyidCSTSelect, $email, $clientName, $copyidCSTName);
                // COLATERAL DOCUMENTS
                sendMail($transferCertTitle, $transferCertTitleSelect, $email, $clientName, $transferCertTitleName);
                sendMail($taxDeclaration, $taxDeclarationSelect, $email, $clientName, $taxDeclarationName);
                sendMail($taxDeclartionICTC, $taxDeclartionICTCSelect, $email, $clientName, $taxDeclartionICTCName);
                sendMail($realStateReceipt, $realStateReceiptSelect, $email, $clientName, $realStateReceiptName);
                sendMail($realEstateTaxClearance, $realEstateTaxClearanceSelect, $email, $clientName, $realEstateTaxClearanceName);
                // BUSINESS PROOF OF INCOME
                sendMail($copyUpdatedBP, $copyUpdatedBPSelect, $email, $clientName, $copyUpdatedBPName);
                sendMail($auditedFinancial, $auditedFinancialSelect, $email, $clientName, $auditedFinancialName);
                sendMail($inhouseFinancial, $inhouseFinancialSelect, $email, $clientName, $inhouseFinancialName);
                sendMail($latestBank, $latestBankSelect, $email, $clientName, $latestBankName);
                sendMail($incomeTaxReturn, $incomeTaxReturnSelect, $email, $clientName, $incomeTaxReturnName);
                sendMail($contractLease, $contractLeaseSelect, $email, $clientName, $contractLeaseName);
                sendMail($customerContact, $customerContactSelect, $email, $clientName, $customerContactName);
                sendMail($supplierContact, $supplierContactSelect, $email, $clientName, $supplierContactName);
                sendMail($proofBilling, $proofBillingSelect, $email, $clientName, $proofBillingName);


                if (!empty($receipt)) {
                    sendMail($creditInvestigationReportC, $creditInvestigationReportCSelect, 'tmgavituya@ourbank.ph', $clientName, $creditInvestigationReportCName);
                    sendMail($collateralAppraisalReportC, $collateralAppraisalReportCSelect, 'tmgavituya@ourbank.ph', $clientName, $collateralAppraisalReportCName);

                    sendMail($creditInvestigationReportC, $creditInvestigationReportCSelect, 'cevinluan@ourbank.ph', $clientName, $creditInvestigationReportCName);
                    sendMail($collateralAppraisalReportC, $collateralAppraisalReportCSelect, 'cevinluan@ourbank.ph', $clientName, $collateralAppraisalReportCName);
                }
                    
                if (!empty($creditInvestigationReportC) && !empty($collateralAppraisalReportC)){
                    sendMail($financialEvaluationC, $financialEvaluationCSelect, 'irmilano@ourbank.ph', $clientName, $financialEvaluationCName);
                }
                
                if (!empty($signedLoanMemoC)) {
                    sendMail($remContractC, $remContractCSelect, 'jonathan.quijano@ourbank.ph', $clientName, $remContractCName);
                    // sendMail($remContractEndI, $remContractEndISelect, 'moonsana@ourbank.ph', $clientName, $remContractIName);
                    sendMail($remContractC, $remContractCSelect, 'jlcricafrente@ourbank.ph', $clientName, $remContractCName);
                }

                if (!empty($remContractC)) {
                    sendMail($remContractAnnotatedC, $remContractAnnotatedCSelect, 'jesus.diokno@ourbank.ph', $clientName, $remContractAnnotatedCName);
                }
                
                if (!empty($remContractAnnotatedC)) {
                    sendMail($promNoteC, $promNoteCSelect, 'apreyes@ourbank.ph', $clientName, $promNoteCName);
                    sendMail($disclosureStateC, $disclosureStateCSelect, 'apreyes@ourbank.ph', $clientName, $disclosureStateCName);
                    sendMail($mriFormC, $mriFormCSelect, 'apreyes@ourbank.ph', $clientName, $mriFormCName);
                    sendMail($amortScheduleC, $amortScheduleCSelect, 'apreyes@ourbank.ph', $clientName, $amortScheduleCName);
                    
                }


            }
        


   
        }

}else{
    echo "DATA ERROR". mysqli_error($con);
}

?>



