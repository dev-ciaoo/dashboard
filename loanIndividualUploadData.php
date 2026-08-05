<?php
include('connection.php');
include('fileuploadloan.php');
use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y');
$indivId=$_POST['indivId'];
$fullname=$_POST['fullname'];
$salaryType=$_POST['salaryType'];
$branch=$_POST['branch'];
$loanType=$_POST['loanType'];
$productID=$_POST['productID'];
$edit1 =$_POST['edit1'];

$powerAttorneyIValue = isset($_POST['powerAttorneyICheck']) ? "Check" : "Uncheck";
$generalInfoValue = isset($_POST['generalInfoCheck']) ? "Check" : "Uncheck";
$securityExchangeValue = isset($_POST['securityExchangeCheck']) ? "Check" : "Uncheck";
$letterGuaranteeValue = isset($_POST['letterGuaranteeCheck']) ? "Check" : "Uncheck";
$boardResolutionValue = isset($_POST['boardResolutionCheck']) ? "Check" : "Uncheck";
$statementAccountIValue = isset($_POST['statementAccountICheck']) ? "Check" : "Uncheck";
$billMaterialValue = isset($_POST['billMaterialCheck']) ? "Check" : "Uncheck";
$proposedPlanValue = isset($_POST['proposedPlanCheck']) ? "Check" : "Uncheck";
$otherDocValue = isset($_POST['otherDocCheck']) ? "Check" : "Uncheck";
$cicValue = isset($_POST['cicCheck']) ? "Check" : "Uncheck";
$nfisValue = isset($_POST['nfisCheck']) ? "Check" : "Uncheck";
// Check Button
#LEGAL Checkbox
$pastCheck = isset($_POST['pastCheck']) ? "Yes" : "No";

// GETTING THE SELECT USING POST METHOD

// PRINCIPAL BORROWER
$endorsementSelect = $_POST['endorsementSelect'];
$loanAppFormISelect = $_POST['loanAppFormISelect'];
$photocopyIdSignaturesSelect = $_POST['photocopyIdSignaturesSelect'];
$proofBillingSelect = $_POST['proofBillingSelect'];
$personalBankSelect = $_POST['personalBankSelect'];
$marriageContractSelect = $_POST['marriageContractSelect'];
$barangayClearanceSelect = $_POST['barangayClearanceSelect'];
// COLLATERAL DOCUMENTS
$transferCertificateSelect = $_POST['transferCertificateSelect'];
$taxDeclarationLotSelect = $_POST['taxDeclarationLotSelect'];
$taxDeclarationImpSelect = $_POST['taxDeclarationImpSelect'];
$realEstateTaxClearanceSelect = $_POST['realEstateTaxClearanceSelect'];
$realEstateTaxReceiptSelect = $_POST['realEstateTaxReceiptSelect'];
$cancellationDischargeSelect = $_POST['cancellationDischargeSelect'];
// SUNTRUST DOCUMENTS
$sunTransferCertificateSelect = $_POST['sunTransferCertificateSelect'];
$sunTaxDeclarationLotSelect = $_POST['sunTaxDeclarationLotSelect'];
$sunTaxDeclarationImpSelect = $_POST['sunTaxDeclarationImpSelect'];
$sunContractSellSelect = $_POST['sunContractSellSelect'];
$sunStatementAccountSelect = $_POST['sunStatementAccountSelect'];
// BUSINESS RROOF OF INCOME
$updatedBusinessSelect = $_POST['updatedBusinessSelect'];
$auditedFinancialSelect = $_POST['auditedFinancialSelect'];
$inhouseFinancialSelect = $_POST['inhouseFinancialSelect'];
$businessBankStatementSelect = $_POST['businessBankStatementSelect'];
$salesRecordSelect = $_POST['salesRecordSelect'];
$incomeTaxReturnSelect = $_POST['incomeTaxReturnSelect'];
$contractLeaseSelect = $_POST['contractLeaseSelect'];
$customerNumberSelect = $_POST['customerNumberSelect'];
$customerSupplierSelect = $_POST['customerSupplierSelect'];
$otherIncomeBSelect = $_POST['otherIncomeBSelect'];
// EMPLOYED PROOF OF INCOME
$employmentContractSelect = $_POST['employmentContractSelect'];
$certificateEmploymentSelect = $_POST['certificateEmploymentSelect'];
$incomeTaxSelect = $_POST['incomeTaxSelect'];
$payslipMonthsSelect = $_POST['payslipMonthsSelect'];
$otherIncomeSelect = $_POST['otherIncomeSelect'];
// OTHERS
$powerAttorneyISelect = $_POST['powerAttorneyISelect'];
$generalInfoSelect = $_POST['generalInfoSelect'];
$securityExchangeSelect = $_POST['securityExchangeSelect'];
$letterGuaranteeSelect = $_POST['letterGuaranteeSelect'];
$boardResolutionSelect = $_POST['boardResolutionSelect'];
$statementAccountSelect = $_POST['statementAccountISelect'];
$billMaterialSelect = $_POST['billMaterialSelect'];
$proposedPlanSelect = $_POST['proposedPlanSelect'];
$otherDocSelect = $_POST['otherDocSelect'];
$cicSelect = $_POST['cicSelect'];
$nfisSelect = $_POST['nfisSelect'];
// DOCUMENTS
$receiptSelect = $_POST['receiptSelect'];
$creditInvestigationReportISelect = $_POST['creditInvestigationReportISelect'];
$collateralAppraisalReportISelect = $_POST['collateralAppraisalReportISelect'];
$financialEvaluationISelect = $_POST['financialEvaluationISelect'];
$signedLetterISelect = $_POST['signedLetterISelect'];
$signedLetterUnderEndISelect = $_POST['signedLetterUnderEndISelect'];
$signedLoanMemoISelect = $_POST['signedLoanMemoISelect'];
$remContractISelect = $_POST['remContractISelect'];
$remContractAnnotatedISelect = $_POST['remContractAnnotatedISelect'];
$promNoteISelect = $_POST['promNoteISelect'];
$disclosureStateISelect = $_POST['disclosureStateISelect'];
$mriFormISelect = $_POST['mriFormISelect'];
$amortScheduleISelect = $_POST['amortScheduleISelect'];
$remContractEndISelect = $_POST['remContractEndISelect'];
$promNoteEndISelect = $_POST['promNoteEndISelect'];
$disclosureStateEndISelect = $_POST['disclosureStateEndISelect'];
$mriFormEndISelect = $_POST['mriFormEndISelect'];
$amortScheduleEndISelect = $_POST['amortScheduleEndISelect'];
$signedDeedUnderEndISelect = $_POST['signedDeedUnderEndISelect'];
$utilizationSelect = $_POST['utilizationSelect'];
// LETTER
$ifLetterSelect = $_POST['ifLetterSelect'];
$isLetterSelect = $_POST['isLetterSelect'];
$itLetterSelect = $_POST['itLetterSelect'];
$ifdLetterSelect = $_POST['ifdLetterSelect'];

// OTHER ATTACHMENT
$iclientReq1 = $_POST['iclientReq1'];
$iclientReq2 = $_POST['iclientReq2'];
$iclientReq3 = $_POST['iclientReq3'];

$iclientReq1Select = $_POST['iclientReq1Select'];
$iclientReq1Desc = $_POST['iclientReq1Desc'];
// LEGAL
$iffClosureSelect = $_POST['iffClosureSelect'];
$pastLitigationSelect = $_POST['pastLitigationSelect'];
$ittLitigationSelect = $_POST['ittLitigationSelect'];
$prepConsoSelect = $_POST['prepConsoSelect'];
$iaDemandSelect = $_POST['iaDemandSelect'];

// GETTING THE TEXT FIELD VALUE
// PRINCIPAL BORROWER
$endorsementDesc = $_POST['endorsementDesc'];
$loanAppFormIDesc = $_POST['loanAppFormIDesc'];
$photocopyIdSignaturesDesc = $_POST['photocopyIdSignaturesDesc'];
$proofBillingDesc = $_POST['proofBillingDesc'];
$personalBankDesc = $_POST['personalBankDesc'];
$marriageContractDesc = $_POST['marriageContractDesc'];
$barangayClearanceDesc = $_POST['barangayClearanceDesc'];
// COLLATERAL DOCUMENTS
$transferCertificateDesc = $_POST['transferCertificateDesc'];
$taxDeclarationLotDesc = $_POST['taxDeclarationLotDesc'];
$taxDeclarationImpDesc = $_POST['taxDeclarationImpDesc'];
$realEstateTaxClearanceDesc = $_POST['realEstateTaxClearanceDesc'];
$realEstateTaxReceiptDesc = $_POST['realEstateTaxReceiptDesc'];
$cancellationDischargeDesc = $_POST['cancellationDischargeDesc'];
// SUNTRUST DOCUMENTS
$sunTransferCertificateDesc = $_POST['sunTransferCertificateDesc'];
$sunTaxDeclarationLotDesc = $_POST['sunTaxDeclarationLotDesc'];
$sunTaxDeclarationImpDesc = $_POST['sunTaxDeclarationImpDesc'];
$sunContractSellDesc = $_POST['sunContractSellDesc'];
$sunStatementAccountDesc = $_POST['sunStatementAccountDesc'];
// BUSINESS RROOF OF INCOME
$updatedBusinessDesc = $_POST['updatedBusinessDesc'];
$auditedFinancialDesc = $_POST['auditedFinancialDesc'];
$inhouseFinancialDesc = $_POST['inhouseFinancialDesc'];
$businessBankStatementDesc = $_POST['businessBankStatementDesc'];
$salesRecordDesc = $_POST['salesRecordDesc'];
$incomeTaxReturnDesc = $_POST['incomeTaxReturnDesc'];
$contractLeaseDesc = $_POST['contractLeaseDesc'];
$customerNumberDesc = $_POST['customerNumberDesc'];
$customerSupplierDesc = $_POST['customerSupplierDesc'];
$otherIncomeBDesc = $_POST['otherIncomeBDesc'];
// EMPLOYED PROOF OF INCOME
$employmentContractDesc = $_POST['employmentContractDesc'];
$certificateEmploymentDesc = $_POST['certificateEmploymentDesc'];
$incomeTaxDesc = $_POST['incomeTaxDesc'];
$payslipMonthsDesc = $_POST['payslipMonthsDesc'];
$otherIncomeDesc = $_POST['otherIncomeDesc'];
// OTHERS
$powerAttorneyIDesc = $_POST['powerAttorneyIDesc'];
$generalInfoDesc = $_POST['generalInfoDesc'];
$securityExchangeDesc = $_POST['securityExchangeDesc'];
$letterGuaranteeDesc = $_POST['letterGuaranteeDesc'];
$boardResolutionDesc = $_POST['boardResolutionDesc'];
$statementAccountDesc = $_POST['statementAccountIDesc'];
$billMaterialDesc = $_POST['billMaterialDesc'];
$proposedPlanDesc = $_POST['proposedPlanDesc'];
$otherDocDesc = $_POST['otherDocDesc'];
$cicDesc = $_POST['cicDesc'];
$nfisDesc = $_POST['nfisDesc'];
// DOCUMENTS
$receiptDesc = $_POST['receiptDesc'];
$creditInvestigationReportIDesc = $_POST['creditInvestigationReportIDesc'];
$collateralAppraisalReportIDesc = $_POST['collateralAppraisalReportIDesc'];
$financialEvaluationIDesc = $_POST['financialEvaluationIDesc'];
$signedLetterIDesc = $_POST['signedLetterIDesc'];
$signedLetterUnderEndIDesc = $_POST['signedLetterUnderEndIDesc'];
$signedLoanMemoIDesc = $_POST['signedLoanMemoIDesc'];
$remContractIDesc = $_POST['remContractIDesc'];
$remContractAnnotatedIDesc = $_POST['remContractAnnotatedIDesc'];
$promNoteIDesc = $_POST['promNoteIDesc'];
$disclosureStateIDesc = $_POST['disclosureStateIDesc'];
$mriFormIDesc = $_POST['mriFormIDesc'];
$amortScheduleIDesc = $_POST['amortScheduleIDesc'];
$remContractEndIDesc = $_POST['remContractEndIDesc'];
$promNoteEndIDesc = $_POST['promNoteEndIDesc'];
$disclosureStateEndIDesc = $_POST['disclosureStateEndIDesc'];
$mriFormEndIDesc = $_POST['mriFormEndIDesc'];
$amortScheduleEndIDesc = $_POST['amortScheduleEndIDesc'];
$signedDeedUnderEndIDesc = $_POST['signedDeedUnderEndIDesc'];
$utilizationDesc= $_POST['utilizationDesc'];
// LETTER
$ifLetterDesc = $_POST['ifLetterDesc'];
$isLetterDesc = $_POST['isLetterDesc'];
$itLetterDesc = $_POST['itLetterDesc'];
$ifdLetterDesc = $_POST['ifdLetterDesc'];
// LEGAL
$iffClosureDesc = $_POST['iffClosureDesc'];
$pastLitigationDesc = $_POST['pastLitigationDesc'];
$ittLitigationDesc = $_POST['ittLitigationDesc'];
$prepConsoDesc = $_POST['prepConsoDesc'];
$iaDemandDesc = $_POST['iaDemandDesc'];

// GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL

$file1File = upload_file($_FILES['file1'], 'individual', $indivId);

// function for saving previous file to indivarchive before updating my specific table.

// $endPrompt = isset($_POST['endPrompt']) ? mysqli_real_escape_string($con, $_POST['endPrompt']) : '';
// error_log("End Prompt received: " . $endPrompt); // Log the received endPrompt

function archiveFile($fileKey, $dbField, $indivLoanId, $archiveField, $dateToday, $endPrompt, $con) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        // error_log("In archiveFile - End Prompt: " . $endPrompt);
        
        // Fetch the existing file data from the `individual` table
        $selectQuery = "SELECT `$dbField` FROM `individual` WHERE `indivLoanId` = '$indivLoanId'";
        $selectResult = mysqli_query($con, $selectQuery);
        
        if ($row = mysqli_fetch_array($selectResult)) {
            $fileData = $row[$dbField];
            
            if(!empty($endPrompt) || $endPrompt != ''){
                 // Insert the previous data into the `indivarchive` table
                $insertQuery = "INSERT INTO `indivarchive` (`a_indivLoanId`, `$archiveField`, `a_idateUploaded`, `a_remarks`)
                                                    VALUES 
                                                            ('$indivLoanId', '$fileData', '$dateToday', '$endPrompt')";
                
                // Log the insert query to see what is being executed
                // error_log("Preparing to insert: $insertQuery");
                
                if (mysqli_query($con, $insertQuery)) {
                    error_log("Insert into indivarchive successful: $insertQuery");
                } else {
                    echo 'Error: ' . mysqli_error($con);
                }
            }
           
        } else {
            // error_log("No data found for indivLoanId: $indivLoanId");
        }
    } else {
        error_log("No file uploaded or upload error for key: $fileKey");
    }
}

if(isset($_POST['endPrompt']) != ''){
    $endPrompt = mysqli_real_escape_string($con, $_POST['endPrompt']);
    // BORROWER
    if (isset($_FILES['endorsement'])) {
        archiveFile('endorsement', 'endorsement', $indivId, 'a_endorsement', $dateToday, $endPrompt, $con);
    }
    if (isset($_FILES['loanAppFormI'])) {
        archiveFile('loanAppFormI', 'loanAppFormI', $indivId, 'a_loanAppFormI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['photocopyIdSignatures'])){
        archiveFile('photocopyIdSignatures', 'photocopyIdSignatures', $indivId, 'a_photocopyIdSignatures', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['proofBilling'])){
        archiveFile('proofBilling', 'proofBilling', $indivId, 'a_proofBilling', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['personalBank'])){
        archiveFile('personalBank', 'personalBank', $indivId, 'a_personalBank', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['marriageContract'])){
        archiveFile('marriageContract', 'marriageContract', $indivId, 'a_marriageContract', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['barangayClearance'])){
        archiveFile('barangayClearance', 'barangayClearance', $indivId, 'a_barangayClearance', $dateToday, $endPrompt, $con);
    }
    
    // COLLATERAL DOCUMENTS
    if(isset($_FILES['transferCertificate'])){
        archiveFile('transferCertificate', 'transferCertificate', $indivId, 'a_transferCertificate', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['taxDeclarationLot'])){
        archiveFile('taxDeclarationLot', 'taxDeclarationLot', $indivId, 'a_taxDeclarationLot', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['taxDeclarationImp'])){
        archiveFile('taxDeclarationImp', 'taxDeclarationImp', $indivId, 'a_taxDeclarationImp', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['realEstateTaxClearance'])){
        archiveFile('realEstateTaxClearance', 'realEstateTaxClearance', $indivId, 'a_realEstateTaxClearance', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['realEstateTaxReceipt'])){
        archiveFile('realEstateTaxReceipt', 'realEstateTaxReceipt', $indivId, 'a_realEstateTaxReceipt', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cancellationDischarge'])){
        archiveFile('cancellationDischarge', 'cancellationDischarge', $indivId, 'a_cancellationDischarge', $dateToday, $endPrompt, $con);
    }
    
    // SUNTRUST DOCUMENTS
    if(isset($_FILES['cancellationDischarge'])){
        archiveFile('sunTransferCertificate', 'sunTransferCertificate', $indivId, 'a_sunTransferCertificate', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sunTaxDeclarationLot'])){
        archiveFile('sunTaxDeclarationLot', 'sunTaxDeclarationLot', $indivId, 'a_sunTaxDeclarationLot', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sunTaxDeclarationImp'])){
        archiveFile('sunTaxDeclarationImp', 'sunTaxDeclarationImp', $indivId, 'a_sunTaxDeclarationImp', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sunContractSell'])){
        archiveFile('sunContractSell', 'sunContractSell', $indivId, 'a_sunContractSell', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sunStatementAccount'])){
        archiveFile('sunStatementAccount', 'sunStatementAccount', $indivId, 'a_sunStatementAccount', $dateToday, $endPrompt, $con);
    }
    
    // BUSINESS PROOF OF INCOME
    if(isset($_FILES['updatedBusiness'])){
        archiveFile('updatedBusiness', 'updatedBusiness', $indivId, 'a_updatedBusiness', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['auditedFinancial'])){
        archiveFile('auditedFinancial', 'auditedFinancial', $indivId, 'a_auditedFinancial', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['inhouseFinancial'])){
        archiveFile('inhouseFinancial', 'inhouseFinancial', $indivId, 'a_inhouseFinancial', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['businessBankStatement'])){
        archiveFile('businessBankStatement', 'businessBankStatement', $indivId, 'a_businessBankStatement', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['salesRecord'])){
        archiveFile('salesRecord', 'salesRecord', $indivId, 'a_salesRecord', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['incomeTaxReturn'])){
        archiveFile('incomeTaxReturn', 'incomeTaxReturn', $indivId, 'a_incomeTaxReturn', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['contractLease'])){
        archiveFile('contractLease', 'contractLease', $indivId, 'a_contractLease', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['customerNumber'])){
        archiveFile('customerNumber', 'customerNumber', $indivId, 'a_customerNumber', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['customerSupplier'])){
        archiveFile('customerSupplier', 'customerSupplier', $indivId, 'a_customerSupplier', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['otherIncomeB'])){
        archiveFile('otherIncomeB', 'otherIncomeB', $indivId, 'a_otherIncomeB', $dateToday, $endPrompt, $con);
    }
    
    // EMPLOYED PROOF OF INCOME
    if(isset($_FILES['employmentContract'])){
        archiveFile('employmentContract', 'employmentContract', $indivId, 'a_employmentContract', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['certificateEmployment'])){
        archiveFile('certificateEmployment', 'certificateEmployment', $indivId, 'a_certificateEmployment', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['incomeTax'])){
        archiveFile('incomeTax', 'incomeTax', $indivId, 'a_incomeTax', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['payslipMonths'])){
        archiveFile('payslipMonths', 'payslipMonths', $indivId, 'a_payslipMonths', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['otherIncome'])){
        archiveFile('otherIncome', 'otherIncome', $indivId, 'a_otherIncome', $dateToday, $endPrompt, $con);
    }
    
    // OTHERS
    if(isset($_FILES['powerAttorneyI'])){
        archiveFile('powerAttorneyI', 'powerAttorneyI', $indivId, 'a_powerAttorneyI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['generalInfo'])){
        archiveFile('generalInfo', 'generalInfo', $indivId, 'a_generalInfo', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['securityExchange'])){
        archiveFile('securityExchange', 'securityExchange', $indivId, 'a_securityExchange', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['letterGuarantee'])){
        archiveFile('letterGuarantee', 'letterGuarantee', $indivId, 'a_letterGuarantee', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['boardResolution'])){
        archiveFile('boardResolution', 'boardResolution', $indivId, 'a_boardResolution', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['statementAccountI'])){
        archiveFile('statementAccountI', 'statementAccountI', $indivId, 'a_statementAccount', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['billMaterial'])){
        archiveFile('billMaterial', 'billMaterial', $indivId, 'a_billMaterial', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['proposedPlan'])){
        archiveFile('proposedPlan', 'proposedPlan', $indivId, 'a_proposedPlan', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['otherDoc'])){
        archiveFile('otherDoc', 'otherDoc', $indivId, 'a_otherDoc', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cic'])){
        archiveFile('cic', 'cic', $indivId, 'a_cic', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['nfis'])){
        archiveFile('nfis', 'nfis', $indivId, 'a_nfis', $dateToday, $endPrompt, $con);
    }
    
    // DOCUMENTS
    if(isset($_FILES['receipt'])){
        archiveFile('receipt', 'receipt', $indivId, 'a_receipt', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['creditInvestigationReportI'])){
        archiveFile('creditInvestigationReportI', 'creditInvestigationReportI', $indivId, 'a_creditInvestigationReportI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['collateralAppraisalReportI'])){
        archiveFile('collateralAppraisalReportI', 'collateralAppraisalReportI', $indivId, 'a_collateralAppraisalReportI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['financialEvaluationI'])){
        archiveFile('financialEvaluationI', 'financialEvaluationI', $indivId, 'a_financialEvaluationI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['signedLetterI'])){
        archiveFile('signedLetterI', 'signedLetterI', $indivId, 'a_signedLetterI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['signedLoanMemoI'])){
        archiveFile('signedLoanMemoI', 'signedLoanMemoI', $indivId, 'a_signedLoanMemoI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['remContractI'])){
        archiveFile('remContractI', 'remContractI', $indivId, 'a_remContractI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['promNoteI'])){
        archiveFile('promNoteI', 'promNoteI', $indivId, 'a_promNoteI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['disclosureStateI'])){
        archiveFile('disclosureStateI', 'disclosureStateI', $indivId, 'a_disclosureStateI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mriFormI'])){
        archiveFile('mriFormI', 'mriFormI', $indivId, 'a_mriFormI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['remContractAnnotatedI'])){
        archiveFile('remContractAnnotatedI', 'remContractAnnotatedI', $indivId, 'a_remContractAnnotatedI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['signedLetterUnderEndI'])){
        archiveFile('signedLetterUnderEndI', 'signedLetterUnderEndI', $indivId, 'a_signedLetterUnderEndI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['remContractEndI'])){
        archiveFile('remContractEndI', 'remContractEndI', $indivId, 'a_remContractEndI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['promNoteEndI'])){
        archiveFile('promNoteEndI', 'promNoteEndI', $indivId, 'a_promNoteEndI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['disclosureStateEndI'])){
        archiveFile('disclosureStateEndI', 'disclosureStateEndI', $indivId, 'a_disclosureStateEndI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mriFormEndI'])){
        archiveFile('mriFormEndI', 'mriFormEndI', $indivId, 'a_mriFormEndI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['signedDeedUnderEndI'])){
        archiveFile('signedDeedUnderEndI', 'signedDeedUnderEndI', $indivId, 'a_signedDeedUnderEndI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['amortScheduleI'])){
        archiveFile('amortScheduleI', 'amortScheduleI', $indivId, 'a_amortScheduleI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['amortScheduleI'])){
        archiveFile('amortScheduleEndI', 'amortScheduleEndI', $indivId, 'a_amortScheduleEndI', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['utilization'])){
        archiveFile('utilization', 'utilization', $indivId, 'a_utilization', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['powerpoint'])){
        archiveFile('powerpoint', 'powerpoint', $indivId, 'a_powerpoint', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['excel'])){
        archiveFile('excel', 'excel', $indivId, 'a_excel', $dateToday, $endPrompt, $con);
    }
     // dueCollection
    // ifLetter
    if(isset($_FILES['ifLetter'])){
        archiveFile('ifLetter', 'ifLetter', $indivId, 'a_ifLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ifLetter2'])){
        archiveFile('ifLetter2', 'ifLetter2', $indivId, 'a_ifLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ifLetter3'])){
        archiveFile('ifLetter3', 'ifLetter3', $indivId, 'a_ifLetter3', $dateToday, $endPrompt, $con);
    }
    // isLetter
    if(isset($_FILES['isLetter'])){
        archiveFile('isLetter', 'isLetter', $indivId, 'a_isLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['isLetter2'])){
        archiveFile('isLetter2', 'isLetter2', $indivId, 'a_isLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['isLetter3'])){
        archiveFile('isLetter3', 'isLetter3', $indivId, 'a_isLetter3', $dateToday, $endPrompt, $con);
    }
    // itLetter
    if(isset($_FILES['itLetter'])){
        archiveFile('itLetter', 'itLetter', $indivId, 'a_itLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['itLetter2'])){
        archiveFile('itLetter2', 'itLetter2', $indivId, 'a_itLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['itLetter3'])){
        archiveFile('itLetter3', 'itLetter3', $indivId, 'a_itLetter3', $dateToday, $endPrompt, $con);
    }
    // ifdLetter
    if(isset($_FILES['ifdLetter'])){
        archiveFile('ifdLetter', 'ifdLetter', $indivId, 'a_ifdLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ifdLetter2'])){
        archiveFile('ifdLetter2', 'ifdLetter2', $indivId, 'a_ifdLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ifdLetter3'])){
        archiveFile('ifdLetter3', 'ifdLetter3', $indivId, 'a_ifdLetter3', $dateToday, $endPrompt, $con);
    }

    // other attachment
    if(isset($_FILES['iclientReq1'])){
        archiveFile('iclientReq1', 'iclientReq1', $indivId, 'a_iclientReq1', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['iclientReq2'])){
        archiveFile('iclientReq2', 'iclientReq2', $indivId, 'a_iclientReq2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['iclientReq3'])){
        archiveFile('iclientReq3', 'iclientReq3', $indivId, 'a_iclientReq3', $dateToday, $endPrompt, $con);
    }

    // legal
    if(isset($_FILES['iffClosure'])){
        archiveFile('iffClosure', 'iffClosure', $indivId, 'a_iffClosure', $dateToday, $endPrompt, $con);
    }

    // past due litigation
    if(isset($_FILES['pastLitigation'])){
        archiveFile('pastLitigation', 'pastLitigation', $indivId, 'a_pastLitigation', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['pastLitigation2'])){
        archiveFile('pastLitigation2', 'pastLitigation2', $indivId, 'a_pastLitigation2', $dateToday, $endPrompt, $con);
    }

    // tramsfer to ROPA
    if(isset($_FILES['ittLitigation'])){
        archiveFile('ittLitigation', 'ittLitigation', $indivId, 'a_ittLitigation', $dateToday, $endPrompt, $con);
    }

    // preparation of consolidation
    if(isset($_FILES['prepConso'])){
        archiveFile('prepConso', 'prepConso', $indivId, 'a_prepConso', $dateToday, $endPrompt, $con);
    }

    // due and demandable
    if(isset($_FILES['iaDemand'])){
        archiveFile('iaDemand', 'iaDemand', $indivId, 'a_iaDemand', $dateToday, $endPrompt, $con);
    }
    // end
}


// PRINCIPAL BORROWER
$endorsementFile = upload_file($_FILES['endorsement'], 'individual', $indivId);
$loanAppFormIFile = upload_file($_FILES['loanAppFormI'], 'individual',$indivId);
$photocopyIdSignaturesFile = upload_file($_FILES['photocopyIdSignatures'], 'individual',$indivId);
$proofBillingFile = upload_file($_FILES['proofBilling'], 'individual',$indivId);
$personalBankFile = upload_file($_FILES['personalBank'], 'individual',$indivId);
$marriageContractFile = upload_file($_FILES['marriageContract'], 'individual',$indivId);
$barangayClearanceFile = upload_file($_FILES['barangayClearance'], 'individual',$indivId);
// COLLATERAL DOCUMENTS
$transferCertificateFile = upload_file($_FILES['transferCertificate'], 'individual', $indivId);
$taxDeclarationLotFile = upload_file($_FILES['taxDeclarationLot'], 'individual', $indivId);
$taxDeclarationImpFile = upload_file($_FILES['taxDeclarationImp'], 'individual', $indivId);
$realEstateTaxClearanceFile = upload_file($_FILES['realEstateTaxClearance'], 'individual', $indivId);
$realEstateTaxReceiptFile = upload_file($_FILES['realEstateTaxReceipt'], 'individual', $indivId);
$cancellationDischargeFile = upload_file($_FILES['cancellationDischarge'], 'individual', $indivId);
// SUNTRUST DOCUMENTS
$sunTransferCertificateFile = upload_file($_FILES['sunTransferCertificate'], 'individual',$indivId);
$sunTaxDeclarationLotFile = upload_file($_FILES['sunTaxDeclarationLot'], 'individual',$indivId);
$sunTaxDeclarationImpFile = upload_file($_FILES['sunTaxDeclarationImp'], 'individual',$indivId);
$sunContractSellFile = upload_file($_FILES['sunContractSell'], 'individual',$indivId);
$sunStatementAccountFile = upload_file($_FILES['sunStatementAccount'], 'individual',$indivId);

// BUSINESS PROOF OF INCOME
$updatedBusinessFile = upload_file($_FILES['updatedBusiness'], 'individual',$indivId);
$auditedFinancialFile = upload_file($_FILES['auditedFinancial'], 'individual',$indivId);
$inhouseFinancialFile = upload_file($_FILES['inhouseFinancial'], 'individual',$indivId);
$businessBankStatementFile = upload_file($_FILES['businessBankStatement'], 'individual',$indivId);
$salesRecordFile = upload_file($_FILES['salesRecord'], 'individual',$indivId);
$incomeTaxReturnFile = upload_file($_FILES['incomeTaxReturn'], 'individual',$indivId);
$contractLeaseFile = upload_file($_FILES['contractLease'], 'individual',$indivId);
$customerNumberFile = upload_file($_FILES['customerNumber'], 'individual',$indivId);
$customerSupplierFile = upload_file($_FILES['customerSupplier'], 'individual',$indivId);
$otherIncomeBFile = upload_file($_FILES['otherIncomeB'], 'individual',$indivId);
// EMPLOYED PROOF OF INCOME
$employmentContractFile = upload_file($_FILES['employmentContract'], 'individual',$indivId);
$certificateEmploymentFile = upload_file($_FILES['certificateEmployment'], 'individual',$indivId);
$incomeTaxFile = upload_file($_FILES['incomeTax'], 'individual',$indivId);
$payslipMonthsFile = upload_file($_FILES['payslipMonths'], 'individual',$indivId);
$otherIncomeFile = upload_file($_FILES['otherIncome'], 'individual',$indivId);
// OTHERS
$powerAttorneyIFile = upload_file($_FILES['powerAttorneyI'], 'individual',$indivId);
$generalInfoFile = upload_file($_FILES['generalInfo'], 'individual',$indivId);
$securityExchangeFile = upload_file($_FILES['securityExchange'], 'individual',$indivId);
$letterGuaranteeFile = upload_file($_FILES['letterGuarantee'], 'individual',$indivId);
$boardResolutionFile = upload_file($_FILES['boardResolution'], 'individual',$indivId);
$statementAccountFile = upload_file($_FILES['statementAccountI'], 'individual',$indivId);
$billMaterialFile = upload_file($_FILES['billMaterial'], 'individual',$indivId);
$proposedPlanFile = upload_file($_FILES['proposedPlan'], 'individual',$indivId);
$otherDocFile = upload_file($_FILES['otherDoc'], 'individual',$indivId);
$cicFile = upload_file($_FILES['cic'], 'individual',$indivId);
$nfisFile = upload_file($_FILES['nfis'], 'individual',$indivId);
// DOCUMENTS
$receiptFile = upload_file($_FILES['receipt'], 'individual', $indivId);
$creditInvestigationReportIFile = upload_file($_FILES['creditInvestigationReportI'], 'individual',$indivId);
$collateralAppraisalReportIFile = upload_file($_FILES['collateralAppraisalReportI'], 'individual',$indivId);
$financialEvaluationIFile = upload_file($_FILES['financialEvaluationI'], 'individual',$indivId);
$signedLetterIFile = upload_file($_FILES['signedLetterI'], 'individual',$indivId);
$signedLoanMemoIFile = upload_file($_FILES['signedLoanMemoI'], 'individual',$indivId);
$remContractIFile = upload_file($_FILES['remContractI'], 'individual',$indivId);
$promNoteIFile = upload_file($_FILES['promNoteI'], 'individual',$indivId);
$disclosureStateIFile = upload_file($_FILES['disclosureStateI'], 'individual',$indivId);
$mriFormIFile = upload_file($_FILES['mriFormI'], 'individual',$indivId);
$remContractAnnotatedIFile = upload_file($_FILES['remContractAnnotatedI'], 'individual',$indivId);
$signedLetterUnderEndIFile = upload_file($_FILES['signedLetterUnderEndI'], 'individual',$indivId);
$remContractEndIFile = upload_file($_FILES['remContractEndI'], 'individual',$indivId);
$promNoteEndIFile = upload_file($_FILES['promNoteEndI'], 'individual',$indivId);
$disclosureStateEndIFile = upload_file($_FILES['disclosureStateEndI'], 'individual',$indivId);
$mriFormEndIFile = upload_file($_FILES['mriFormEndI'], 'individual',$indivId);
$signedDeedUnderEndIFile = upload_file($_FILES['signedDeedUnderEndI'], 'individual',$indivId);
$amortScheduleIFile = upload_file($_FILES['amortScheduleI'], 'individual',$indivId);
$amortScheduleEndIFile = upload_file($_FILES['amortScheduleEndI'], 'individual',$indivId);
$utilizationFile = upload_file($_FILES['utilization'], 'individual', $indivId);
$powerpointFile = upload_file($_FILES['powerpoint'], 'individual', $indivId);
$excelFile = upload_file($_FILES['excel'], 'individual', $indivId);
// LETTER
$ifLetterFile = upload_file($_FILES['ifLetter'], 'individual',$indivId);
$isLetterFile = upload_file($_FILES['isLetter'], 'individual',$indivId);
$itLetterFile = upload_file($_FILES['itLetter'], 'individual',$indivId);
$ifdLetterFile = upload_file($_FILES['ifdLetter'], 'individual',$indivId);
// LETTER2
$ifLetter2File = upload_file($_FILES['ifLetter2'], 'individual',$indivId);
$isLetter2File = upload_file($_FILES['isLetter2'], 'individual',$indivId);
$itLetter2File = upload_file($_FILES['itLetter2'], 'individual',$indivId);
$ifdLetter2File = upload_file($_FILES['ifdLetter2'], 'individual',$indivId);
// LETTER3
$ifLetter3File = upload_file($_FILES['ifLetter3'], 'individual',$indivId);
$isLetter3File = upload_file($_FILES['isLetter3'], 'individual',$indivId);
$itLetter3File = upload_file($_FILES['itLetter3'], 'individual',$indivId);
$ifdLetter3File = upload_file($_FILES['ifdLetter3'], 'individual',$indivId);
// OTHER ATTACHMENT
$iclientReq1File = upload_file($_FILES['iclientReq1'], 'individual', $indivId);
$iclientReq2File = upload_file($_FILES['iclientReq2'], 'individual', $indivId);
$iclientReq3File = upload_file($_FILES['iclientReq3'], 'individual', $indivId);
// LEGAL
$iffClosureFile = upload_file($_FILES['iffClosure'], 'individual',$indivId);
$pastLitigatioFile = upload_file($_FILES['pastLitigation'], 'individual',$indivId);
$pastLitigation2File = upload_file($_FILES['pastLitigation2'], 'individual',$indivId);
$ittLitigationFile = upload_file($_FILES['ittLitigation'], 'individual',$indivId);
$prepConsoFile = upload_file($_FILES['prepConso'], 'individual',$indivId);
$iaDemandFile = upload_file($_FILES['iaDemand'], 'individual',$indivId);


$file1Path = $file1File['path'];
// PRINCIPAL BORROWER
$endorsementPath = $endorsementFile['path'];
$loanAppFormIPath = $loanAppFormIFile['path'];
$photocopyIdSignaturesPath = $photocopyIdSignaturesFile['path'];
$proofBillingPath = $proofBillingFile['path'];
$personalBankPath = $personalBankFile['path'];
$marriageContractPath = $marriageContractFile['path'];
$barangayClearancePath = $barangayClearanceFile['path'];
// COLLATERAL DOCUMENTS
$transferCertificatePath = $transferCertificateFile['path'];
$taxDeclarationLotPath = $taxDeclarationLotFile['path'];
$taxDeclarationImpPath = $taxDeclarationImpFile['path'];
$realEstateTaxClearancePath = $realEstateTaxClearanceFile['path'];
$realEstateTaxReceiptPath = $realEstateTaxReceiptFile['path'];
$cancellationDischargePath = $cancellationDischargeFile['path'];
// SUNTRUST DOCUMENTS
$sunTransferCertificatePath = $sunTransferCertificateFile['path'];
$sunTaxDeclarationLotPath = $sunTaxDeclarationLotFile['path'];
$sunTaxDeclarationImpPath = $sunTaxDeclarationImpFile['path'];
$sunContractSellPath = $sunContractSellFile['path'];
$sunStatementAccountPath = $sunStatementAccountFile['path'];
// BUSINESS PROOF OF INCOME
$updatedBusinessPath = $updatedBusinessFile['path'];
$auditedFinancialPath = $auditedFinancialFile['path'];
$inhouseFinancialPath = $inhouseFinancialFile['path'];
$businessBankStatementPath = $businessBankStatementFile['path'];
$salesRecordPath = $salesRecordFile['path'];
$incomeTaxReturnPath = $incomeTaxReturnFile['path'];
$contractLeasePath = $contractLeaseFile['path'];
$customerNumberPath = $customerNumberFile['path'];
$customerSupplierPath = $customerSupplierFile['path'];
$otherIncomeBPath = $otherIncomeBFile['path'];
// EMPLOYED PROOF OF INCOME
$employmentContractPath = $employmentContractFile['path'];
$certificateEmploymentPath = $certificateEmploymentFile['path'];
$incomeTaxPath = $incomeTaxFile['path'];
$payslipMonthsPath = $payslipMonthsFile['path'];
$otherIncomePath = $otherIncomeFile['path'];
// OTHERS
$powerAttorneyIPath = $powerAttorneyIFile['path'];
$generalInfoPath = $generalInfoFile['path'];
$securityExchangePath = $securityExchangeFile['path'];
$letterGuaranteePath = $letterGuaranteeFile['path'];
$boardResolutionPath = $boardResolutionFile['path'];
$statementAccountPath = $statementAccountFile['path'];
$billMaterialPath = $billMaterialFile['path'];
$proposedPlanPath = $proposedPlanFile['path'];
$otherDocPath = $otherDocFile['path'];
$cicPath = $cicFile['path'];
$nfisPath = $nfisFile['path'];
// DOCUMENTS
$receiptPath = $receiptFile['path'];
$creditInvestigationReportIPath = $creditInvestigationReportIFile['path'];
$collateralAppraisalReportIPath = $collateralAppraisalReportIFile['path'];
$financialEvaluationIPath = $financialEvaluationIFile['path'];
$signedLetterIPath = $signedLetterIFile['path'];
$signedLetterUnderEndIPath = $signedLetterUnderEndIFile['path'];
$signedLoanMemoIPath = $signedLoanMemoIFile['path'];
$remContractIPath = $remContractIFile['path'];
$remContractAnnotatedIPath = $remContractAnnotatedIFile['path'];
$promNoteIPath = $promNoteIFile['path'];
$disclosureStateIPath = $disclosureStateIFile['path'];
$mriFormIPath = $mriFormIFile['path'];
$amortScheduleIPath = $amortScheduleIFile['path'];
$remContractEndIPath = $remContractEndIFile['path'];
$promNoteEndIPath = $promNoteEndIFile['path'];
$disclosureStateEndIPath = $disclosureStateEndIFile['path'];
$mriFormEndIPath = $mriFormEndIFile['path'];
$amortScheduleEndIPath = $amortScheduleEndIFile['path'];
$signedDeedUnderEndIPath = $signedDeedUnderEndIFile['path'];
$utilizationPath = $utilizationFile['path'];
$powerpointPath = $powerpointFile['path'];
$excelPath = $excelFile['path'];
// LETTER
$ifLetterPath = $ifLetterFile['path'];
$isLetterPath = $isLetterFile['path'];
$itLetterPath = $itLetterFile['path'];
$ifdLetterPath = $ifdLetterFile['path'];
// LETTER2
$ifLetter2Path = $ifLetter2File['path'];
$isLetter2Path = $isLetter2File['path'];
$itLetter2Path = $itLetter2File['path'];
$ifdLetter2Path = $ifdLetter2File['path'];
// LETTER2
$ifLetter3Path = $ifLetter3File['path'];
$isLetter3Path = $isLetter3File['path'];
$itLetter3Path = $itLetter3File['path'];
$ifdLetter3Path = $ifdLetter3File['path'];
// OTHER ATTACHMENT
$iclientReq1Path = $iclientReq1File['path'];
$iclientReq2Path = $iclientReq2File['path'];
$iclientReq3Path = $iclientReq3File['path'];
// LEGAL
$iffClosurePath = $iffClosureFile['path'];
$pastLitigationPath = $pastLitigatioFile['path'];
$pastLitigation2Path = $pastLitigation2File['path'];
$ittLitigationPath = $ittLitigationFile['path'];
$prepConsoPath = $prepConsoFile['path'];
$iaDemandPath = $iaDemandFile['path'];

//   LETTER MAILING
function letterMail($data,$path,$name,$email,$email2){
    if(!empty($path) && empty($data)){
    // $filename = 'request10.jpg';
    // $cid = 'my-attach';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    // $mail->addEmbeddedImage($filename, $cid);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress($email);
    $mail->addAddress($email2);
    $mail -> isHTML(true);
    $mail->Subject = "[ Collection ]" . $name;
    $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                      <br><br>Customer/Client: ' . $name . '
                     ';
    $mail->send();
    }
  }

//  FINAL DEMAND REQUEST FOR RE-APPRAISAL
// function finalDemand($fddata,$fdpath,$fdname,$email001){
//     if(!empty($fdpath) && empty($fddata)){
//     // $filename = 'request10.jpg';
//     // $cid = 'my-attach';
//     $mail = new PHPMailer(true);
//     $mail->isSMTP();
//     $mail->Host = 'ourbank.ph';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'helpdesk@ourbank.ph';
//     $mail -> Password = '0urb@nk-2025N3w!@';
//     $mail->SMTPSecure = 'ssl';
//     $mail->Port = 465;
//     // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
//     // $mail->addEmbeddedImage($filename, $cid);
//     $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
//     $mail->addAddress($email001);
//     $mail -> isHTML(true);
//     $mail->Subject = "Requesting for Re-Appraisal" . $fdname;
//     $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
//                       <br><br>Customer/Client: ' . $fdname . '
//                       <br><br>Requesting for Re-Appraisal,
//                       <br><br>Thank you.
//                       ';
//     $mail->send();
//     }
//   }

// FUNCTION FOR EMAIL
function sendMail($smdata, $smpath, $smname, $email01, $email03, $email04, $email05, $smdocuments){
    if(!empty($smpath) && empty($smdata)){
    // $filename = 'request10.jpg';
    // $cid = 'my-attach';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail -> isHTML(true);
    // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress($email01);
    // $mail->addAddress($email02);
    $mail->addAddress($email03);
    $mail->addAddress($email04);
    $mail->addAddress($email05);
    $mail->Subject = "$smname";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Customer/Client: <b> ' . $smname . ' </b>
                    <br><br>DOCUMENTS UPLOADED: <b> ' . $smdocuments . ' </b>
                    ';
    $mail->send();
    }

  }  
  // FUNCTION FOR EMAIL
  function mailReport($mrdata,$mrpath,$mrname, $mrdocuments){
    if(!empty($mrpath) && empty($mrdata)){
    // $filename = 'request10.jpg';
    // $cid = 'my-attach';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail -> isHTML(true);
    // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    // $mail->addAddress('');
    $mail->addAddress('jonathan.quijano@ourbank.ph');
    $mail->addAddress('cevinluan@ourbank.ph');
    // $mail->addAddress('cdcruz@ourbank.ph');
    $mail->Subject = "$mrname";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Customer/Client: <b> ' . $mrname . ' </b>
                    <br><br>DOCUMENT UPLOADED: <b> ' . $mrdocuments . ' </b>
                    ';
    $mail->send();
    }
  }
  // FUNCTION FOR EMAIL
  function mailMemo($mdata,$mpath,$mname, $mdocuments){
    if(!empty($mpath) && empty($mdata)){
    // $filename = 'request10.jpg';
    // $cid = 'my-attach';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail -> isHTML(true);
    // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    // $mail->addAddress('');
    $mail->addAddress('moonsana@ourbank.ph');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('jonathan.quijano@ourbank.ph');
    $mail->addAddress('cdcruz@ourbank.ph');
    $mail->Subject = "$mname";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Customer/Client: <b> ' . $mname . ' </b>
                    <br><br>DOCUMENT UPLOADED: <b> ' . $mdocuments . ' </b>
                    ';
    $mail->send();
    }
  }
  
  // REQUIREMENT MAILING
  function requirementsMail($rmname){
    // $filename = 'request10.jpg';
    // $cid = 'my-attach';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail -> isHTML(true);
    // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress('cdcruz@ourbank.ph');
    // $mail->addAddress('');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->Subject = "$rmname";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Requiremnts of ' . $rmname . ' has been uploaded.  
                    ';
    $mail->send();
    }

$sqlSelect = "SELECT * FROM individual WHERE indivLoanId = '$indivId'";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);



// $indivArchive = "INSERT INTO indivarchive (`indivLoanId`, `endorsement`, `loanAppFormI`
//                                                 `photocopyIdSignatures`, `proofBilling`, `personalBank`,
//                                                 `marriageContract`, `barangayClearance`, `transferCertificate`,
//                                                 `taxDeclarationLot`, `taxDeclarationImp`, `realEstateTaxClearance`,
//                                                 `realEstateTaxReceipt`, `cancellationDischarge`, `sunTransferCertificate`,
//                                                 `sunTaxDeclarationLot`, `sunTaxDeclarationImp`, `sunContractSell`, 
//                                                 `sunStatementAccount`, `updatedBusiness`, `auditedFinancial`,
//                                                 `inhouseFinancial`, `businessBankStatement`, `salesRecord`,
//                                                 `incomeTaxReturn`, `contractLease`, `customerNumber`,
//                                                 `customerSupplier`, `otherIncomeB`, `employmentContract`,
//                                                 `certificateEmployment`, `incomeTax`, `payslipMonths`,
//                                                 `otherIncome`, `powerAttorneyI`, `generalInfo`,
//                                                 `securityExchange`, `letterGuarantee`, `boardResolution`,
//                                                 `statementAccount`, `billMaterial`, `proposedPlan`, 
//                                                 `otherDoc`, `receipt`, `creditInvestigationReportI`,
//                                                 `collateralAppraisalReportI`, `financialEvaluationI`, `signedLetterI`,
//                                                 `signedLoanMemoI`, `remContractI`, `remContractAnnotatedI`,
//                                                 `promNoteI`, `disclosureStateI`, `mriFormI`,
//                                                 `amortScheduleI`, `signedLetterUnderEndI`, `remContractEndI`,
//                                                 `promNoteEndI`, `disclosureStateEndI`, `mriFormEndI`,
//                                                 `amortScheduleEndI`, `signedDeedUnderEndI`, `utilization`,
//                                                 `powerpoint`, `excel`, `idateUploaded`
//                                                 )
//                                     VALUES
//                                                 ('$id', '$endorsementPath', '$loanAppFormIPath',
//                                                 '$photocopyIdSignaturesPath', '$proofBillingPath', '$personalBankPath',
//                                                 '$marriageContractPath', '$barangayClearancePath' '$transferCertificatePath',
//                                                 '$taxDeclarationPath', '$taxDeclarationImpPath', '$realEstateTaxClearancePath',
//                                                 '$realEstateTaxReceiptPath', '$cancellationDischaragePath', '$sunTransferCertificatePath',
//                                                 '$sunTaxDeclarationLotPath', '$sunTaxDeclarationImpPath', '$sunContractSellPath',
//                                                 '$inhouseFinancialPath', '$businessBankStatementPath', '$salesRecordPath',
//                                                 '$incomeTaxReturnPath', '$contractLeasePath', '$customerNumberPath',
//                                                 '$customerSupplierPath', '$otherIncomeBPath', '$employmentContractPath',
//                                                 '$certificateEmploymentPath', '$incomeTaxPath', '$payslipMonthsPath',
//                                                 '$otherIncomePath', '$powerAttorneyIPath', '$generalInfoPath',
//                                                 '$securityExchangePath', '$letterGuaranteePath', '$boardResolutionPath',
//                                                 '$statementAccountPath', '$billMaterialPath', '$proposedPlanPath',
//                                                 '$otherDocPath', '$receiptPath', '$creditInvestigationReportIPath',
//                                                 '$collateralAppraisalReportIPath', '$financialEvaluationIPath '$signedLetterIPath',
//                                                 '$signedLoanMemoIPath', '$remContractIPath', '$remContractAnnotatedIPath', 
//                                                 '$promNoteIPath', '$disclosureStateIPath', '$mriFormIPath',
//                                                 '$amortScheduleIPath', '$signedLetterUnderEndIPath', '$remContractEndIPath',
//                                                 '$promNoteEndIPath', '$disclosureStateEndIPath', '$mriFormEndIPath',
//                                                 '$amortScheduleEndIPath', '$signedDeedUnderEndIPath', '$utilizationPath', 
//                                                 '$powerpointPath', '$excelPath', '$dateToday'
//                                                 )
//                     ";
//     $indivQry = mysqli_query($con, $indivArchive);

if($data){
// INSERT NEXTBANK PRODUCT ID TO LOANS -- comment this if error exist 12-20-2023
    if(!empty($productID)){
        $productUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$indivId'";
        $productQuery = mysqli_query($con, $productUpdate);
        if(!$productQuery){
            echo 'ERROR update'. mysqli_error($con);
        }else{
            echo 'Product ID Update Successfully';
        }
    }else{
        echo "Product ID is empty";
    }

function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
  if (!empty($columnValue)) {
    $sqlUpdate .= " `$columnName` = '$columnValue',";
  }
}

$sqlUpdate = "UPDATE individual SET";
// check each data path, If the data path is not empty, it will update

// PRINCIPAL BORROWER
addColumnUpdate($sqlUpdate, "endorsement", $endorsementPath);
addColumnUpdate($sqlUpdate, "loanAppFormI", $loanAppFormIPath);
addColumnUpdate($sqlUpdate, "photocopyIdSignatures", $photocopyIdSignaturesPath);
addColumnUpdate($sqlUpdate, "proofBilling", $proofBillingPath);
addColumnUpdate($sqlUpdate, "personalBank", $personalBankPath);
addColumnUpdate($sqlUpdate, "marriageContract", $marriageContractPath);
addColumnUpdate($sqlUpdate, "barangayClearance", $barangayClearancePath);
// COLLATERAL DOCUMENTS
addColumnUpdate($sqlUpdate, "transferCertificate", $transferCertificatePath);
addColumnUpdate($sqlUpdate, "taxDeclarationLot", $taxDeclarationLotPath);
addColumnUpdate($sqlUpdate, "taxDeclarationImp", $taxDeclarationImpPath);
addColumnUpdate($sqlUpdate, "realEstateTaxClearance", $realEstateTaxClearancePath);
addColumnUpdate($sqlUpdate, "realEstateTaxReceipt", $realEstateTaxReceiptPath);
addColumnUpdate($sqlUpdate, "cancellationDischarge", $cancellationDischargePath);
// SUNTRUST DOCUMENTS
addColumnUpdate($sqlUpdate, "sunTransferCertificate", $sunTransferCertificatePath);
addColumnUpdate($sqlUpdate, "sunTaxDeclarationLot", $sunTaxDeclarationLotPath);
addColumnUpdate($sqlUpdate, "sunTaxDeclarationImp", $sunTaxDeclarationImpPath);
addColumnUpdate($sqlUpdate, "sunContractSell", $sunContractSellPath);
addColumnUpdate($sqlUpdate, "sunStatementAccount", $sunStatementAccountPath);
// BUSINESS PROOF OF INCOME
addColumnUpdate($sqlUpdate, "updatedBusiness", $updatedBusinessPath);
addColumnUpdate($sqlUpdate, "auditedFinancial", $auditedFinancialPath);
addColumnUpdate($sqlUpdate, "inhouseFinancial", $inhouseFinancialPath);
addColumnUpdate($sqlUpdate, "businessBankStatement", $businessBankStatementPath);
addColumnUpdate($sqlUpdate, "salesRecord", $salesRecordPath);
addColumnUpdate($sqlUpdate, "incomeTaxReturn", $incomeTaxReturnPath);
addColumnUpdate($sqlUpdate, "contractLease", $contractLeasePath);
addColumnUpdate($sqlUpdate, "customerNumber", $customerNumberPath);
addColumnUpdate($sqlUpdate, "customerSupplier", $customerSupplierPath);
addColumnUpdate($sqlUpdate, "otherIncomeB", $otherIncomeBPath);
// EMPLOYED PROOF OF INCOME
addColumnUpdate($sqlUpdate, "employmentContract", $employmentContractPath);
addColumnUpdate($sqlUpdate, "certificateEmployment", $certificateEmploymentPath);
addColumnUpdate($sqlUpdate, "incomeTax", $incomeTaxPath);
addColumnUpdate($sqlUpdate, "payslipMonths", $payslipMonthsPath);
addColumnUpdate($sqlUpdate, "otherIncome", $otherIncomePath);
// OTHERS
addColumnUpdate($sqlUpdate, "powerAttorneyI", $powerAttorneyIPath);
addColumnUpdate($sqlUpdate, "generalInfo", $generalInfoPath);
addColumnUpdate($sqlUpdate, "securityExchange", $securityExchangePath);
addColumnUpdate($sqlUpdate, "letterGuarantee", $letterGuaranteePath);
addColumnUpdate($sqlUpdate, "boardResolution", $boardResolutionPath);
addColumnUpdate($sqlUpdate, "statementAccount", $statementAccountPath);
addColumnUpdate($sqlUpdate, "billMaterial", $billMaterialPath);
addColumnUpdate($sqlUpdate, "proposedPlan", $proposedPlanPath);
addColumnUpdate($sqlUpdate, "otherDoc", $otherDocPath);
addColumnUpdate($sqlUpdate, "cic", $cicPath);
addColumnUpdate($sqlUpdate, "nfis", $nfisPath);

// DOCUMENTS
addColumnUpdate($sqlUpdate, "receipt", $receiptPath);
addColumnUpdate($sqlUpdate, "creditInvestigationReportI", $creditInvestigationReportIPath);
addColumnUpdate($sqlUpdate, "collateralAppraisalReportI", $collateralAppraisalReportIPath);
addColumnUpdate($sqlUpdate, "financialEvaluationI", $financialEvaluationIPath);
addColumnUpdate($sqlUpdate, "signedLetterI", $signedLetterIPath);
addColumnUpdate($sqlUpdate, "signedLetterUnderEndI", $signedLetterUnderEndIPath);
addColumnUpdate($sqlUpdate, "signedLoanMemoI", $signedLoanMemoIPath);
addColumnUpdate($sqlUpdate, "remContractI", $remContractIPath);
addColumnUpdate($sqlUpdate, "remContractAnnotatedI", $remContractAnnotatedIPath);
addColumnUpdate($sqlUpdate, "promNoteI", $promNoteIPath);
addColumnUpdate($sqlUpdate, "disclosureStateI", $disclosureStateIPath);
addColumnUpdate($sqlUpdate, "mriFormI", $mriFormIPath);
addColumnUpdate($sqlUpdate, "amortScheduleI", $amortScheduleIPath);
addColumnUpdate($sqlUpdate, "remContractEndI", $remContractEndIPath);
addColumnUpdate($sqlUpdate, "promNoteEndI", $promNoteEndIPath);
addColumnUpdate($sqlUpdate, "disclosureStateEndI", $disclosureStateEndIPath);
addColumnUpdate($sqlUpdate, "mriFormEndI", $mriFormEndIPath);
addColumnUpdate($sqlUpdate, "amortScheduleEndI", $amortScheduleEndIPath);
addColumnUpdate($sqlUpdate, "signedDeedUnderEndI", $signedDeedUnderEndIPath);
addColumnUpdate($sqlUpdate, "utilization", $utilizationPath);
addColumnUpdate($sqlUpdate, "powerpoint", $powerpointPath);
addColumnUpdate($sqlUpdate, "excel", $excelPath);
// LETTER
addColumnUpdate($sqlUpdate, "ifLetter", $ifLetterPath);
addColumnUpdate($sqlUpdate, "isLetter", $isLetterPath);
addColumnUpdate($sqlUpdate, "itLetter", $itLetterPath);
addColumnUpdate($sqlUpdate, "ifdLetter", $ifdLetterPath);
// LETTER2
addColumnUpdate($sqlUpdate, "ifLetter2", $ifLetter2Path);
addColumnUpdate($sqlUpdate, "isLetter2", $isLetter2Path);
addColumnUpdate($sqlUpdate, "itLetter2", $itLetter2Path);
addColumnUpdate($sqlUpdate, "ifdLetter2", $ifdLetter2Path);
// LETTER3
addColumnUpdate($sqlUpdate, "ifLetter3", $ifLetter3Path);
addColumnUpdate($sqlUpdate, "isLetter3", $isLetter3Path);
addColumnUpdate($sqlUpdate, "itLetter3", $itLetter3Path);
addColumnUpdate($sqlUpdate, "ifdLetter3", $ifdLetter3Path);
// OTHER ATTACHMENT
addColumnUpdate($sqlUpdate, "iclientReq1", $iclientReq1Path);
addColumnUpdate($sqlUpdate, "iclientReq2", $iclientReq2Path);
addColumnUpdate($sqlUpdate, "iclientReq3", $iclientReq3Path);
// LEGAL
addColumnUpdate($sqlUpdate, "iffClosure", $iffClosurePath);
addColumnUpdate($sqlUpdate, "pastLitigation", $pastLitigationPath);
addColumnUpdate($sqlUpdate, "pastLitigation2", $pastLitigation2Path);
addColumnUpdate($sqlUpdate, "ittLitigation", $ittLitigationPath);
addColumnUpdate($sqlUpdate, "prepConso", $prepConsoPath);
addColumnUpdate($sqlUpdate, "iaDemand", $iaDemandPath);
// FOR CHECKBOX VALUE
addColumnUpdate($sqlUpdate, "powerAttorneyICheck", $powerAttorneyIValue);
addColumnUpdate($sqlUpdate, "generalInfoCheck", $generalInfoValue);
addColumnUpdate($sqlUpdate, "securityExchangeCheck", $securityExchangeValue);
addColumnUpdate($sqlUpdate, "letterGuaranteeCheck", $letterGuaranteeValue);
addColumnUpdate($sqlUpdate, "boardResolutionCheck", $boardResolutionValue);
addColumnUpdate($sqlUpdate, "statementAccountICheck", $statementAccountIValue);
addColumnUpdate($sqlUpdate, "billMaterialCheck", $billMaterialValue);
addColumnUpdate($sqlUpdate, "proposedPlanCheck", $proposedPlanValue);
addColumnUpdate($sqlUpdate, "otherDocCheck", $otherDocValue);
addColumnUpdate($sqlUpdate, "pastCheck", $pastCheck);
addColumnUpdate($sqlUpdate, 'cicCheck', $cicValue);
addColumnUpdate($sqlUpdate, 'nfisCheck', $nfisValue);
// TEXTFIELD
addColumnUpdate($sqlUpdate, "edit1", $edit1);

addColumnUpdate($sqlUpdate, "endorsement", $file1Path);




// STATUS FUNCTION
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
    if ($columnSelect == "2") {
      $valueDescription = $columnSelect . "--" . $description;
      $sqlUpdate .= " `$columnStatus` = '$valueDescription',";
    }
  }
}

// Status of every data: Verified/Incomplete

// PRINCIPAL BORROWER
addStatus($sqlUpdate, "endorsementStatus", $endorsementSelect, $endorsementDesc);
addStatus($sqlUpdate, "loanAppFormIStatus", $loanAppFormISelect, $loanAppFormIDesc);
addStatus($sqlUpdate, "photocopyIdSignaturesStatus", $photocopyIdSignaturesSelect, $photocopyIdSignaturesDesc);
addStatus($sqlUpdate, "proofBillingStatus", $proofBillingSelect, $proofBillingDesc);
addStatus($sqlUpdate, "personalBankStatus", $personalBankSelect, $personalBankDesc);
addStatus($sqlUpdate, "marriageContractStatus", $marriageContractSelect, $marriageContractDesc);
addStatus($sqlUpdate, "barangayClearanceStatus", $barangayClearanceSelect, $barangayClearanceDesc);
// COLLATERAL DOCUMENTS
addStatus($sqlUpdate, "transferCertificateStatus", $transferCertificateSelect, $transferCertificateDesc);
addStatus($sqlUpdate, "taxDeclarationLotStatus", $taxDeclarationLotSelect, $taxDeclarationLotDesc);
addStatus($sqlUpdate, "taxDeclarationImpStatus", $taxDeclarationImpSelect, $taxDeclarationImpDesc);
addStatus($sqlUpdate, "realEstateTaxClearanceStatus", $realEstateTaxClearanceSelect, $realEstateTaxClearanceDesc);
addStatus($sqlUpdate, "realEstateTaxReceiptStatus", $realEstateTaxReceiptSelect, $realEstateTaxReceiptDesc);
addStatus($sqlUpdate, "cancellationDischarageStatus", $cancellationDischargeSelect, $cancellationDischargeDesc);
// SUNTRUST DOCUMENTS
addStatus($sqlUpdate, "sunTransferCertificateStatus", $sunTransferCertificateSelect, $sunTransferCertificateDesc);
addStatus($sqlUpdate, "sunTaxDeclarationLotStatus", $sunTaxDeclarationLotSelect, $sunTaxDeclarationLotDesc);
addStatus($sqlUpdate, "sunTaxDeclarationImpStatus", $sunTaxDeclarationImpSelect, $sunTaxDeclarationImpDesc);
addStatus($sqlUpdate, "sunContractSellStatus", $sunContractSellSelect, $sunContractSellDesc);
addStatus($sqlUpdate, "sunStatementAccountStatus", $sunStatementAccountSelect, $sunStatementAccountDesc);
// BUSINESS PROOF OF INCOME
addStatus($sqlUpdate, "updatedBusinessStatus", $updatedBusinessSelect, $updatedBusinessDesc);
addStatus($sqlUpdate, "auditedFinancialStatus", $auditedFinancialSelect, $auditedFinancialDesc);
addStatus($sqlUpdate, "inhouseFinancialStatus", $inhouseFinancialSelect, $inhouseFinancialDesc);
addStatus($sqlUpdate, "businessBankStatementStatus", $businessBankStatementSelect, $businessBankStatementDesc);
addStatus($sqlUpdate, "salesRecordStatus", $salesRecordSelect, $salesRecordDesc);
addStatus($sqlUpdate, "incomeTaxReturnStatus", $incomeTaxReturnSelect, $incomeTaxReturnDesc);
addStatus($sqlUpdate, "contractLeaseStatus", $contractLeaseSelect, $contractLeaseDesc);
addStatus($sqlUpdate, "customerNumberStatus", $customerNumberSelect, $customerNumberDesc);
addStatus($sqlUpdate, "customerSupplierStatus", $customerSupplierSelect, $customerSupplierDesc);
addStatus($sqlUpdate, "otherIncomeBStatus", $otherIncomeBSelect, $otherIncomeBDesc);
// EMPLOYED PROOF OF INCOME
addStatus($sqlUpdate, "employmentContractStatus", $employmentContractSelect, $employmentContractDesc);
addStatus($sqlUpdate, "certificateEmploymentStatus", $certificateEmploymentSelect, $certificateEmploymentDesc);
addStatus($sqlUpdate, "incomeTaxStatus", $incomeTaxSelect, $incomeTaxDesc);
addStatus($sqlUpdate, "payslipMonthsStatus", $payslipMonthsSelect, $payslipMonthsDesc);
addStatus($sqlUpdate, "otherIncomeStatus", $otherIncomeSelect, $otherIncomeDesc);
// OTHERS
addStatus($sqlUpdate, "powerAttorneyIStatus", $powerAttorneyISelect, $powerAttorneyIDesc);
addStatus($sqlUpdate, "generalInfoStatus", $generalInfoSelect, $generalInfoDesc);
addStatus($sqlUpdate, "securityExchangeStatus", $securityExchangeSelect, $securityExchangeDesc);
addStatus($sqlUpdate, "letterGuaranteeStatus", $letterGuaranteeSelect, $letterGuaranteeDesc);
addStatus($sqlUpdate, "boardResolutionStatus", $boardResolutionSelect, $boardResolutionDesc);
addStatus($sqlUpdate, "statementAccountStatus", $statementAccountSelect, $statementAccountDesc);
addStatus($sqlUpdate, "billMaterialStatus", $billMaterialSelect, $billMaterialDesc);
addStatus($sqlUpdate, "proposedPlanStatus", $proposedPlanSelect, $proposedPlanDesc);
addStatus($sqlUpdate, "otherDocStatus", $otherDocSelect, $otherDocDesc);
addStatus($sqlUpdate, "cicStatus", $cicSelect, $cicDesc);
addStatus($sqlUpdate, "nfisStatus", $nfisSelect, $nfisDesc);
// DOCUMENTS
addStatus($sqlUpdate, "receiptStatus", $receiptSelect, $receiptDesc);
addStatus($sqlUpdate, "creditInvestigationReportIStatus", $creditInvestigationReportISelect, $creditInvestigationReportIDesc);
addStatus($sqlUpdate, "collateralAppraisalReportIStatus", $collateralAppraisalReportISelect, $collateralAppraisalReportIDesc);
addStatus($sqlUpdate, "financialEvaluationIStatus", $financialEvaluationISelect, $financialEvaluationIDesc);
addStatus($sqlUpdate, "signedLetterIStatus", $signedLetterISelect, $signedLetterIDesc);
addStatus($sqlUpdate, "signedLetterUnderEndIStatus", $signedLetterUnderEndISelect, $signedLetterUnderEndIDesc);
addStatus($sqlUpdate, "signedLoanMemoIStatus", $signedLoanMemoISelect, $signedLoanMemoIDesc);
addStatus($sqlUpdate, "remContractIStatus", $remContractISelect, $remContractIDesc);
addStatus($sqlUpdate, "remContractAnnotatedIStatus", $remContractAnnotatedISelect, $remContractAnnotatedIDesc);
addStatus($sqlUpdate, "promNoteIStatus", $promNoteISelect, $promNoteIDesc);
addStatus($sqlUpdate, "disclosureStateIStatus", $disclosureStateISelect, $disclosureStateIDesc);
addStatus($sqlUpdate, "mriFormIStatus", $mriFormISelect, $mriFormIDesc);
addStatus($sqlUpdate, "amortScheduleIStatus", $amortScheduleISelect, $amortScheduleIDesc);
addStatus($sqlUpdate, "remContractEndIStatus", $remContractEndISelect, $remContractEndIDesc);
addStatus($sqlUpdate, "promNoteEndIStatus", $promNoteEndISelect, $promNoteEndIDesc);
addStatus($sqlUpdate, "disclosureStateEndIStatus", $disclosureStateEndISelect, $disclosureStateEndIDesc);
addStatus($sqlUpdate, "mriFormEndIStatus", $mriFormEndISelect, $mriFormEndIDesc);
addStatus($sqlUpdate, "amortScheduleEndIStatus", $amortScheduleEndISelect, $amortScheduleEndIDesc);
addStatus($sqlUpdate, "signedDeedUnderEndIStatus", $signedDeedUnderEndISelect, $signedDeedUnderEndIDesc);
addStatus($sqlUpdate, "utilizationStatus", $utilizationSelect, $utilizationDesc);
// LETTER
addStatus($sqlUpdate, "ifLetterRemarks", $ifLetterSelect, $ifLetterDesc);
addStatus($sqlUpdate, "isLetterRemarks", $isLetterSelect, $isLetterDesc);
addStatus($sqlUpdate, "itLetterRemarks", $itLetterSelect, $itLetterDesc);
addStatus($sqlUpdate, "ifdLetterRemarks", $ifdLetterSelect, $ifdLetterDesc);
// OTHER ATTACHMENT
addStatus($sqlUpdate, "iclientReqRemarks", $iclientReq1Select, $iclientReq1Desc);
// LEGAL
addStatus($sqlUpdate, "iffClosureRemarks", $iffClosureSelect, $iffClosureDesc);
addStatus($sqlUpdate, "pastLitigationRemarks", $pastLitigationSelect, $pastLitigationDesc);
addStatus($sqlUpdate, "ittLitigationRemarks", $ittLitigationSelect, $ittLitigationDesc);
addStatus($sqlUpdate, "prepConsoRemarks", $prepConsoSelect, $prepConsoDesc);
addStatus($sqlUpdate, "iaDemandRemarks", $iaDemandSelect, $iaDemandDesc);


$sqlUpdate = rtrim($sqlUpdate, ', '); 

$sqlUpdate .= " WHERE indivLoanId = '$indivId'";

$updateQuery = mysqli_query($con, $sqlUpdate);


switch ($branch) {
  case "Head Office":
      $address = "TEJERO/";
      break;
  case "Magallanes":
      $address = "MAGALLANES/";
      break;
  case "Ternate":
      $address = "TERNATE/";
      break;
  case "Maragondon":
      $address = "MARAGONDON/";
      break;
  case "Manggahan":
      $address = "MANGGAHAN/";
      break;
  case "Noveleta":
      $address = "NOVELETA/";
      break;
  case "Poblacion":
      $address = "POBLACION/";
      break;
}
// PRINCIPAL BORROWER
$endorsementName = "ENDORSEMENT LETTER";
$loanAppFormIName = "LOAN APPLICATION FORM.";
$photocopyIdSignaturesName = "PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED IDs WITH 3 SIGNATURES";
$proofBillingName = "PROOF OF BILLING (MERALCO, INTERNEET BILL, WATER BILL)";
$personalBankName = "PERSONAL-BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS";
$marriageContractName = "MARRIAGE CONTRACT (IF MARRIED) *CENOMAR (IF SINGLE)";
$barangayClearanceName = "BARANGAY CLEARANCE FOR LOAN PURPOSE";
// COLLATERAL DOCUMENTS
$transferCertificateName = "TRANSFER CERTIFICATE OF TITLE (ORIGINAL & CERTIFIED TRUE COPY)";
$taxDeclarationLotName = "TAX DECLARATION (LOT - CERTIFIED TRUE COPY)";
$taxDeclarationImpName = "TAX DECLARATION (IMPROVEMENT - CERTIFIED TRUE COPY)";
$realEstateTaxClearanceName = "REAL ESTATE TAX CLEARANCE";
$realEstateTaxReceiptName = "REAL ESTATE TAX RECEIPT (AMILYAR)";
$cancellationDischargeName = "CANCELLATION AND DISCHARGE OF MORTGAGE";
// SUNTRUST DOCUMENT
$sunTransferCertificateName = "COPY OF TRANSFER CERTIFICATE OF TITLE";
$sunTaxDeclarationLotName = "TAX DECLARATION (LOT-COPY)";
$sunTaxDeclarationImpName = "TAX DECLARATION (IMPROVEMENT-COPY)";
$sunContractSellName = "CONTRACT TO SELL";
$sunStatementAccountName = "STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY";
// BUSINESS PROOF OF INCOME
$updatedBusinessName = "UPDATED BUSINESS PERMIT (MAYOR'S, BARANGAY AND/OR DTI)";
$auditedFinancialName = "AUDITED FINANCIAL STATEMENT (3 YEARS)";
$inhouseFinancialName = "IN-HOUSE FINANCIAL STATEMENT (3 YEARS)";
$businessBankStatementName = "BUSINESS - BANK STATEMENT OR PASSBOOK FOR THE LAST 6 MONTHS";
$salesRecordName = "SALES RECORD & PURCHASES RECEIPTS OR LOGBOOK";
$incomeTaxReturnName = "INCOME TAX RETURN (IF APPLICABLE)";
$contractLeaseName = "CONTRACT OF LEASE (IF RENTAL BUSINESS)";
$customerNumberName = "5 CUSTOMERS WITH CONTACT NUMBER";
$customerSupplierName = "5 SUPPLIERS WITH CONTACT NUMBER";
// EMPLOYED PROOF OF INCOME
$employmentContractName = "EMPLOYMENT CONTRACT";
$certificateEmploymentName = "CERTIFICATE OF EMPLOYMENT WITH COMPENSATION";
$payslipMonthsName = "PAYSLIP FOR 6 MONTHS";
$otherIncomeBName="OTHER SOURCE OF INCOME";
// OTJHERS
$powerAttorneyIName = "SPECIAL POWER OF ATTORNEY";
$generalInfoName = "GENERAL INFORMATION SHEET";
$securityExchangeName = "SECURITY EXCHANGE COMMISSION (SEC) WITH ARTICLES AND BY LAW";
$letterGuaranteeName="LETTER OF GUARANTEE";
$boardResolutionName = "ORIGINAL BOARD RESOLUTION AND NOTARIZED SECRETARY CERTIFICATE";
$statementAccountName = "STATEMENT OF ACCOUNT";
$billMaterialName = "BILL/COST OF MATERIALS";
$proposedPlanName="PROPOSED PERSPECTIVE PLAN";
$cicName = "CIC";
$nfisName = "NFIS";
// DOCUMENTS
$receiptName = "APPRAISAL FEE RECEIPT";
$creditInvestigationReportIName = "CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT";
$collateralAppraisalReportIName = "APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT";
$financialEvaluationIName = "FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD";
$signedLetterIName = "SIGNED LETTER OF APPROVAL";
$signedLoanMemoIName = "SIGNED LOAN APPROVAL MEMO";
$remContractIName = "REAL ESTATE MORTGAGE CONTRACT";
$promNoteIName = "PROMISSORY NOTE";
$disclosureStateIName = "DISCLOSURE STATEMENT";
$mriFormIName = "MRI FORM (COUNTRY BANKERS)";
$amortScheduleIName = "AMORTIZATION SCHEDULE";
$remContractAnnotatedIName = "REM CONTRACT ANNOTATED";
$signedLetterUnderEndIName = "SIGNED LETTER OF UNDERTAKING";
$signedDeedUnderEndIName = "SIGNED DEED OF UNDERTAKING";
$utilizationName = "LOAN UTILIZATION";



if ($updateQuery==true) {

    if(!$indivQry){
        echo "Error: " . mysqli_error($con);
    }

    $archived = "INSERT INTO letterarchive (`loanIds`, `firstLetter`, `firstLetter2`, 
                                            `firstLetter3`, `secondLetter`, `secondLetter2`, 
                                            `secondLetter3`, `thirdLetter`, `thirdLetter2`, 
                                            `thirdLetter3`, `finalLetter`, `finalLetter2`, 
                                            `finalLetter3`, 
                                            `clientRequest1`, `clientRequest2`, `clientRequest3`, 
                                            `foreClosure`, `pastDueLitigation`, 
                                            `pastDueLitigation2`, `transferLitigation`, `prepConsol`, 
                                            `dueDemandable`, `todaysDate`)
                                        VALUES      
                                            ('$indivId', '$ifLetterPath', '$ifLetter2Path', 
                                            '$ifLetter3Path', '$isLetterPath', '$isLetter2Path',
                                            '$isLetter3Path', '$itLetterPath', '$itLetter2Path',
                                            '$itLetter3Path', '$ifdLetterPath', '$ifdLetter2Path',
                                            '$ifdLetter3Path', 
                                            '$iclientReq1Path', '$iclientReq2Path', '$iclientReq3Path',
                                            '$iffClosurePath', '$pastLitigationPath',
                                            '$pastLitigation2Path', '$ittLitigationPath', '$prepConsoPath',
                                            '$iaDemandPath', '$dateToday')";
    $queryarchived = mysqli_query($con, $archived);


// PRINCIPAL BORROWER
sendMail($data['endorsement'], $endorsementPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $endorsementName);
sendMail($data['loanAppFormI'], $loanAppFormIPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanAppFormIName);
sendMail($data['photocopyIdSignatures'], $photocopyIdSignaturesPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $photocopyIdSignaturesName);
sendMail($data['proofBilling'], $proofBillingPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $proofBillingName);
sendMail($data['personalBank'], $personalBankPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $personalBankName);
sendMail($data['marriageContract'], $marriageContractPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $marriageContractName);
sendMail($data['barangayClearance'], $barangayClearancePath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $barangayClearanceName);
// COLLATERAL DOCUMENTS
sendMail($data['transferCertificate'], $transferCertificatePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $transferCertificateName);
sendMail($data['taxDeclarationLot'], $taxDeclarationLotPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $taxDeclarationLotName);
sendMail($data['taxDeclarationImp'], $taxDeclarationImpPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $taxDeclarationImpName);
sendMail($data['realEstateTaxClearance'], $realEstateTaxClearancePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $realEstateTaxClearanceName);
sendMail($data['realEstateTaxReceipt'], $realEstateTaxReceiptPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $realEstateTaxReceiptName);
sendMail($data['cancellationDischarge'], $cancellationDischargePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $cancellationDischargeName);
// SUNTRUST DOCUMENTS
sendMail($data['sunTransferCertificate'], $sunTransferCertificatePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunTransferCertificateName);
sendMail($data['sunTaxDeclarationLot'], $sunTaxDeclarationLotPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunTaxDeclarationLotName);
sendMail($data['sunTaxDeclarationImp'], $sunTaxDeclarationImpPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunTaxDeclarationImpName);
sendMail($data['sunContractSell'], $sunContractSellPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunContractSellName);
sendMail($data['sunStatementAccount'], $sunStatementAccountPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunStatementAccountName);
// BUSINESS PROOF OF INCOME
sendMail($data['updatedBusiness'], $updatedBusinessPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $updatedBusinessName);
sendMail($data['auditedFinancial'], $auditedFinancialPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $auditedFinancialName);
sendMail($data['inhouseFinancial'], $inhouseFinancialPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $inhouseFinancialName);
sendMail($data['businessBankStatement'], $businessBankStatementPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessBankStatementName);
sendMail($data['salesRecord'], $salesRecordPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $salesRecordName);
sendMail($data['incomeTaxReturn'], $incomeTaxReturnPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $incomeTaxReturnName);
sendMail($data['contractLease'], $contractLeasePath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $contractLeaseName);
sendMail($data['customerNumber'], $customerNumberPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $customerNumberName);
sendMail($data['customerSupplier'], $customerSupplierPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $customerSupplierName);
sendMail($data['otherIncomeB'], $otherIncomeBPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $otherIncomeBName);
// EMPLOYED PROOF OF INCOME
sendMail($data['employmentContract'], $employmentContractPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $employmentContractName);
sendMail($data['certificateEmployment'], $certificateEmploymentPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $certificateEmploymentName);
sendMail($data['incomeTax'], $incomeTaxPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $incomeTaxReturnName);
sendMail($data['payslipMonths'], $payslipMonthsPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $payslipMonthsName);
sendMail($data['otherIncome'], $otherIncomePath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $otherIncomeBName);
// OTHERS MAILING
sendMail($data['powerAttorneyI'], $powerAttorneyIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $powerAttorneyIName);
sendMail($data['generalInfo'], $generalInfoPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $generalInfoName);
sendMail($data['securityExchange'], $securityExchangePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $securityExchangeName);
sendMail($data['letterGuarantee'], $letterGuaranteePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $letterGuaranteeName);
sendMail($data['boardResolution'], $boardResolutionPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $boardResolutionName);
sendMail($data['statementAccount'], $statementAccountPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $statementAccountName);
sendMail($data['billMaterial'], $billMaterialPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $billMaterialName);
sendMail($data['proposedPlan'], $proposedPlanPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $proposedPlanName);

sendMail($data['cic'], $cicPath, $fullname, "cdcruz@ourbank.ph", "jlcricafrente@ourbank.ph", "apreyes@ourbank.ph", '', $cicName);
sendMail($data['nfis'], $nfisPath, $fullname, "cdcruz@ourbank.ph", "jlcricafrente@ourbank.ph", "apreyes@ourbank.ph", '', $nfisName);



// DOCUMENTS MAILING
mailReport($data['receipt'], $receiptPath, $fullname, $receiptName);
sendMail($data['collateralAppraisalReportI'], $collateralAppraisalReportIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditInvestigationReportIName);
sendMail($data['financialEvaluationI'], $financialEvaluationIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $financialEvaluationIName);
sendMail($data['signedLetterI'], $signedLetterIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $signedLetterIName);
sendMail($data['signedLetterUnderEndI'], $signedLetterUnderEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $signedLetterUnderEndIName);
mailMemo($data['signedLoanMemoI'], $signedLoanMemoIPath, $fullname, $signedLoanMemoIName);
sendMail($data['remContractI'], $remContractIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $remContractIName);
sendMail($data['remContractAnnotatedI'], $remContractAnnotatedIPath, $fullname, "jesus.diokno@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $remContractAnnotatedIName);
sendMail($data['promNoteI'], $promNoteIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $promNoteIName);
sendMail($data['disclosureStateI'], $disclosureStateIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $disclosureStateIName);
sendMail($data['mriFormI'], $mriFormIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $mriFormIName);
sendMail($data['amortScheduleI'], $amortScheduleIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $amortScheduleIName);
sendMail($data['remContractEndI'], $remContractEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $remContractIName);
sendMail($data['promNoteEndI'], $promNoteEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $promNoteIName);
sendMail($data['disclosureStateEndI'], $disclosureStateEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $disclosureStateIName);
sendMail($data['mriFormEndI'], $mriFormEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $mriFormIName);
sendMail($data['amortScheduleEndI'], $amortScheduleEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $amortScheduleIName);
sendMail($data['signedDeedUnderEndI'], $signedDeedUnderEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $signedDeedUnderEndIName);
sendMail($data['utilization'], $utilizationPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $utilizationName);
// LETTER MAILING
letterMail($data['ifLetter'], $ifLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['isLetter'], $isLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['itLetter'], $itLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['ifdLetter'], $ifdLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['ifLetter2'], $ifLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['isLetter2'], $isLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['itLetter2'], $itLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['ifdLetter2'], $ifdLetter2Path, $fullname , "", "josmin.alvarez@ourbank.ph");
letterMail($data['ifLetter3'], $ifLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
letterMail($data['isLetter3'], $isLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
letterMail($data['itLetter3'], $itLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
letterMail($data['ifdLetter3'], $ifdLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
// 
letterMail($data['iffClosure'], $iffClosurePath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['pastLitigation'], $pastLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['pastLitigation2'], $pastLitigation2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['ittLitigation'], $ittLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['prepConso'], $prepConsoPath, $fullname, "", "josmin.alvarez@ourbank.ph");
letterMail($data['iaDemand'], $iaDemandPath, $fullname, "", "josmin.alvarez@ourbank.ph");
// 
// finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "tmgavituya@ourbank.ph");
// finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "jonathan.quijano@ourbank.ph");

$updateSqlStats = "";

if ($iaDemandPath != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 9 WHERE loan_Id = '$indivId'";
}
if ($prepConsoPath != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 8 WHERE loan_Id = '$indivId'";
}
if ($ittLitigationPath != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$indivId'";
} 
if ($pastLitigationPath != '' && $pastLitigation2Path != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$indivId'";
}
if ($iffClosurePath != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$indivId'";
}
if ($ifdLetterSelect != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 4, `remarks` = '$ifdLetterSelect' WHERE loan_Id = '$indivId'";
}
if ($itLetterSelect != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 3, `remarks` = '$itLetterSelect' WHERE loan_Id = '$indivId'";
}if ($isLetterSelect != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 2, `remarks` = '$isLetterSelect' WHERE loan_Id = '$indivId'";
}if ($ifLetterSelect != '') {
    $updateSqlStats = "UPDATE loan SET `letterStatus` = 1, `remarks` = '$ifLetterSelect' WHERE loan_Id = '$indivId'";
}

// Execute the query only if $updateSqlStats is set
if (!empty($updateSqlStats)) {
    $updateQueryStats = mysqli_query($con, $updateSqlStats);
} else {

}


  $ftpServer = '10.10.10.117';
  $ftpUsername = "ourbank-tech";
  $ftpPassword = "Juliuspogi2023";
  
    # Local file paths
function addToLocalFiles(&$localFiles, $variable)
    {
        if (!empty($variable)) {
            $localFiles[] = $variable;
        }
    }
    
    $localFiles = [];
    // REQUIREMENTS OF CLIENTS
    // PRINCIPAL BORROWER
    addToLocalFiles($localFiles, $endorsementPath);
    addToLocalFiles($localFiles, $loanAppFormIPath);
    addToLocalFiles($localFiles, $photocopyIdSignaturesPath);
    addToLocalFiles($localFiles, $proofBillingPath);
    addToLocalFiles($localFiles, $personalBankPath);
    addToLocalFiles($localFiles, $marriageContractPath);
    addToLocalFiles($localFiles, $barangayClearancePath);
    // COLLATERAL DOCUEMENTS
    addToLocalFiles($localFiles, $transferCertificatePath);
    addToLocalFiles($localFiles, $taxDeclarationLotPath);
    addToLocalFiles($localFiles, $taxDeclarationImpPath);
    addToLocalFiles($localFiles, $realEstateTaxClearancePath);
    addToLocalFiles($localFiles, $realEstateTaxReceiptPath);
    addToLocalFiles($localFiles, $cancellationDischaragePath);
    // SUNTRUST DOCUEMENTS
    addToLocalFiles($localFiles, $sunTransferCertificatePath);
    addToLocalFiles($localFiles, $sunTaxDeclarationLotPath);
    addToLocalFiles($localFiles, $sunTaxDeclarationImpPath);
    addToLocalFiles($localFiles, $sunContractSellPath);
    addToLocalFiles($localFiles, $sunStatementAccountPath);
    // BUSINESS PROOF OF INCOME
    addToLocalFiles($localFiles, $updatedBusinessPath);
    addToLocalFiles($localFiles, $auditedFinancialPath);
    addToLocalFiles($localFiles, $inhouseFinancialPath);
    addToLocalFiles($localFiles, $businessBankStatementPath);
    addToLocalFiles($localFiles, $salesRecordPath);
    addToLocalFiles($localFiles, $incomeTaxReturnPath);
    addToLocalFiles($localFiles, $contractLeasePath);
    addToLocalFiles($localFiles, $customerNumberPath);
    addToLocalFiles($localFiles, $customerSupplierPath);
    addToLocalFiles($localFiles, $otherIncomeBPath);
    // EMPLOYED PROOF OF INCOME
    addToLocalFiles($localFiles, $employmentContractPath);
    addToLocalFiles($localFiles, $certificateEmploymentPath);
    addToLocalFiles($localFiles, $incomeTaxPath);
    addToLocalFiles($localFiles, $payslipMonthsPath);
    addToLocalFiles($localFiles, $otherIncomePath);
    // OTHERS
    addToLocalFiles($localFiles, $powerAttorneyIPath);
    addToLocalFiles($localFiles, $generalInfoPath);
    addToLocalFiles($localFiles, $securityExchangePath);
    addToLocalFiles($localFiles, $letterGuaranteePath);
    addToLocalFiles($localFiles, $boardResolutionPath);
    addToLocalFiles($localFiles, $statementAccountPath);
    addToLocalFiles($localFiles, $billMaterialPath);
    addToLocalFiles($localFiles, $proposedPlanPath);
    addToLocalFiles($localFiles, $otherDocPath);
    addToLocalFiles($localFiles, $cicPath);
    addToLocalFiles($localFiles, $nfisPath);
    // DOCUMENTS
    addToLocalFiles($localFiles, $receiptPath);
    addToLocalFiles($localFiles, $creditInvestigationReportIPath);
    addToLocalFiles($localFiles, $collateralAppraisalReportIPath);
    addToLocalFiles($localFiles, $financialEvaluationIPath);
    addToLocalFiles($localFiles, $signedLetterIPath);
    addToLocalFiles($localFiles, $signedLetterUnderEndIPath);
    addToLocalFiles($localFiles, $signedLoanMemoIPath);
    addToLocalFiles($localFiles, $remContractIPath);
    addToLocalFiles($localFiles, $remContractAnnotatedIPath);
    addToLocalFiles($localFiles, $promNoteIPath);
    addToLocalFiles($localFiles, $disclosureStateIPath);
    addToLocalFiles($localFiles, $mriFormIPath);
    addToLocalFiles($localFiles, $amortScheduleIPath);
    addToLocalFiles($localFiles, $remContractEndIPath);
    addToLocalFiles($localFiles, $promNoteEndIPath);
    addToLocalFiles($localFiles, $disclosureStateEndIPath);
    addToLocalFiles($localFiles, $mriFormEndIPath);
    addToLocalFiles($localFiles, $amortScheduleEndIPath);
    addToLocalFiles($localFiles, $signedDeedUnderEndIPath);
    addToLocalFiles($localFiles, $utilizationPath);
    addToLocalFiles($localFiles, $powerpointPath);
    addToLocalFiles($localFiles, $excelPath);
    // LETTER
    addToLocalFiles($localFiles, $ifLetterPath);
    addToLocalFiles($localFiles, $isLetterPath);
    addToLocalFiles($localFiles, $itLetterPath);
    addToLocalFiles($localFiles, $ifdLetterPath);
    // LETTER2
    addToLocalFiles($localFiles, $ifLetter2Path);
    addToLocalFiles($localFiles, $isLetter2Path);
    addToLocalFiles($localFiles, $itLetter2Path);
    addToLocalFiles($localFiles, $ifdLetter2Path);
    // LETTER3
    addToLocalFiles($localFiles, $ifLetter3Path);
    addToLocalFiles($localFiles, $isLetter3Path);
    addToLocalFiles($localFiles, $itLetter3Path);
    addToLocalFiles($localFiles, $ifdLetter3Path);
    // OTHER ATTACHMENT
    addToLocalFiles($localFiles, $iclientReq1Path);
    addToLocalFiles($localFiles, $iclientReq2Path);
    addToLocalFiles($localFiles, $iclientReq3Path);
    // LEGAL
    addToLocalFiles($localFiles, $iffClosurePath);
    addToLocalFiles($localFiles, $pastLitigationPath);
    addToLocalFiles($localFiles, $pastLitigation2Path);
    addToLocalFiles($localFiles, $ittLitigationPath);
    addToLocalFiles($localFiles, $prepConsoPath);
    addToLocalFiles($localFiles, $iaDemandPath);

    // Connect to the FTP server
    $ftpConnection = ftp_ssl_connect($ftpServer);
    if (!$ftpConnection) {
        die('Failed to connect to the FTP server');
    }
  
    // Login to the FTP server
    $login = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
    if (!$login) {
        die('Failed to login to the FTP server');
    }
  
    // Enable passive mode (optional, depending on your server's configuration)
    ftp_pasv($ftpConnection, true);
    echo "CONNECTED";
  
    // Upload each file
    foreach ($localFiles as $localFile) {
        $localName = explode("/", $localFile)[1];

        $remoteFile = "LOAN/" . $address . "SECURED LOAN/" . $fullname . '/' . $localName;

    // Check if the file exists on the FTP server before uploading
        $existingFiles = ftp_nlist($ftpConnection, $remoteFile);
        if (empty($existingFiles)) {
          $upload = ftp_put($ftpConnection, $remoteFile, $localFile, FTP_BINARY);
          if ($upload) {
              echo 'File uploaded successfully! Update <br>';
          } else {
              echo 'Failed to upload the file Update <br>';
          }
      } else {
          echo 'File already exists on the server! <br>';
      }
  }
  
    // Close the FTP connection
    ftp_close($ftpConnection);
  
    echo 'All files uploaded successfully!';
  
} else {

      echo("try something else");

}

}

else{
    $insertSql = "INSERT INTO `individual` (
                                            `indivLoanId`, `endorsement`, `loanAppFormI`, 
                                            `photocopyIdSignatures`, `proofBilling`, `personalBank`, 
                                            `marriageContract`, `barangayClearance`, `transferCertificate`, 
                                            `taxDeclarationLot`, `taxDeclarationImp`, `realEstateTaxClearance`, 
                                            `realEstateTaxReceipt`, `cancellationDischarge`, `sunTransferCertificate`, 
                                            `sunTaxDeclarationLot`, `sunTaxDeclarationImp`, `sunContractSell`, 
                                            `sunStatementAccount`, `updatedBusiness`, `auditedFinancial`, 
                                            `inhouseFinancial`, `businessBankStatement`, `incomeTaxReturn`, 
                                            `customerNumber`, `customerSupplier`,
                                            `employmentContract`, `certificateEmployment`, `payslipMonths`, 
                                            `powerAttorneyI`, `generalInfo`, `securityExchange`, 
                                            `letterGuarantee`, `boardResolution`, `statementAccount`,
                                            `powerAttorneyICheck`,`generalInfoCheck`,`securityExchangeCheck`,
                                            `letterGuaranteeCheck`,`boardResolutionCheck`,`statementAccountICheck`,
                                            `billMaterialCheck`,`proposedPlanCheck`,
                                            `ifLetter`, `ifLetter2`, `ifLetter3`, 
                                            `isLetter`, `isLetter2`, `isLetter3`, 
                                            `itLetter`, `itLetter2`, `itLetter3`, 
                                            `ifdLetter`, `ifdLetter2`, `ifdLetter3`, 
                                            `iclientReq1`, `iclientReq2`, `iclientReq3`,
                                            `iffClosure`, `pastLitigation`,
                                            `pastLitigation2`, `ittLitigation`, `prepConso`, `iaDemand`,
                                            `cic`, `nfis`, `cicCheck`, `nfisCheck`
                                ) VALUES (
                                            $indivId, '$endorsementPath','$loanAppFormIPath', 
                                            '$photocopyIdSignaturesPath', '$proofBillingPath', '$personalBankPath', 
                                            '$marriageContractPath', '$barangayClearancePath', '$transferCertificatePath', 
                                            '$taxDeclarationLotPath', '$taxDeclarationImpPath', '$realEstateTaxClearancePath', 
                                            '$realEstateTaxReceiptPath', '$cancellationDischargePath', '$sunTransferCertificatePath', 
                                            '$sunTaxDeclarationLotPath', '$sunTaxDeclarationImpPath', '$sunContractSellPath', 
                                            '$sunStatementAccountPath', '$updatedBusinessPath', '$auditedFinancialPath', 
                                            '$inhouseFinancialPath', '$businessBankStatementPath', '$incomeTaxReturnPath', 
                                            '$customerNumberPath', '$customerSupplierPath',
                                            '$employmentContractPath', '$certificateEmploymentPath', '$payslipMonthsPath',
                                            '$powerAttorneyIPath', '$generalInfoPath', '$securityExchangePath', 
                                            '$letterGuaranteePath', '$boardResolutionPath', '$statementAccountPath',
                                            '$powerAttorneyIValue', '$generalInfoValue',  '$securityExchangeValue',
                                            '$letterGuaranteeValue','$boardResolutionValue','$statementAccountIValue',
                                            '$billMaterialValue','$proposedPlanValue',
                                            '$ifLetterPath', '$ifLetter2Path', '$ifLetter3Path', 
                                            '$isLetterPath', '$isLetter2Path', '$isLetter3Path', 
                                            '$itLetterPath', '$itLetter2Path', '$itLetter3Path', 
                                            '$ifdLetterPath', '$ifdLetter2Path', '$ifdLetter3Path', 
                                            '$iclientReq1Path', '$iclientReq2Path', '$iclientReq3Path',
                                            '$iffClosurePath', '$pastLitigationPath', 
                                            '$pastLitigation2Path', '$ittLitigationPath', '$prepConsoPath', '$iaDemandPath',
                                            '$cicPath', '$nfisPath', '$cicValue', '$nfisValue'
                                        );
                    ";
    
$insertQuery = mysqli_query($con, $insertSql);

switch ($branch) {
  case "Head Office":
      $address = "TEJERO/";
      break;
  case "Magallanes":
      $address = "MAGALLANES/";
      break;
  case "Ternate":
      $address = "TERNATE/";
      break;
  case "Maragondon":
      $address = "MARAGONDON/";
      break;
  case "Manggahan":
      $address = "MANGGAHAN/";
      break;
  case "Noveleta":
      $address = "NOVELETA/";
      break;
  case "Poblacion":
      $address = "POBLACION/";
      break;
}
if ($insertQuery==true) {

    // 
    // finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "tmgavituya@ourbank.ph");
    // finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "jonathan.quijano@ourbank.ph");

    $archived = "INSERT INTO letterarchive (`loanIds`, `firstLetter`, `firstLetter2`, 
                                            `firstLetter3`, `secondLetter`, `secondLetter2`, 
                                            `secondLetter3`, `thirdLetter`, `thirdLetter2`, 
                                            `thirdLetter3`, `finalLetter`, `finalLetter2`, 
                                            `finalLetter3`, 
                                            `clientRequest1`, `clientRequest2`, `clientRequest3`,
                                            `foreClosure`, `pastDueLitigation`, 
                                            `pastDueLitigation2`, `transferLitigation`, `prepConsol`, 
                                            `dueDemandable`, `todaysDate`)
                                        VALUES      
                                            ('$indivId', '$ifLetterPath', '$ifLetter2Path', 
                                            '$ifLetter3Path', '$isLetterPath', '$isLetter2Path',
                                            '$isLetter3Path', '$itLetterPath', '$itLetter2Path',
                                            '$itLetter3Path', '$ifdLetterPath', '$ifdLetter2Path',
                                            '$ifdLetter3Path', 
                                            '$iclientReq1Path', '$iclientReq2Path', '$iclientReq3Path',
                                            '$iffClosurePath', '$pastLitigationPath',
                                            '$pastLitigation2Path', '$ittLitigationPath', '$prepConsoPath',
                                            '$iaDemandPath', '$dateToday')";
    $queryarchived = mysqli_query($con, $archived);

    // PRINCIPAL BORROWER
    sendMail($data['endorsement'], $endorsementPath, $fullname, "irmilano@ourbank.ph" , 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $endorsementName);
    sendMail($data['loanAppFormI'], $loanAppFormIPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanAppFormIName);
    sendMail($data['photocopyIdSignatures'], $photocopyIdSignaturesPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $photocopyIdSignaturesName);
    sendMail($data['proofBilling'], $proofBillingPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $proofBillingName);
    sendMail($data['personalBank'], $personalBankPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $personalBankName);
    sendMail($data['marriageContract'], $marriageContractPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $marriageContractName);
    sendMail($data['barangayClearance'], $barangayClearancePath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $barangayClearanceName);
    // COLLATERAL DOCUMENTS
    sendMail($data['transferCertificate'], $transferCertificatePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $transferCertificateName);
    sendMail($data['taxDeclarationLot'], $taxDeclarationLotPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $taxDeclarationLotName);
    sendMail($data['taxDeclarationImp'], $taxDeclarationImpPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $taxDeclarationImpName);
    sendMail($data['realEstateTaxClearance'], $realEstateTaxClearancePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $realEstateTaxClearanceName);
    sendMail($data['realEstateTaxReceipt'], $realEstateTaxReceiptPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $realEstateTaxReceiptName);
    sendMail($data['cancellationDischarge'], $cancellationDischargePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $cancellationDischargeName);
    // SUNTRUST DOCUMENTS
    sendMail($data['sunTransferCertificate'], $sunTransferCertificatePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunTransferCertificateName);
    sendMail($data['sunTaxDeclarationLot'], $sunTaxDeclarationLotPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunTaxDeclarationLotName);
    sendMail($data['sunTaxDeclarationImp'], $sunTaxDeclarationImpPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunTaxDeclarationImpName);
    sendMail($data['sunContractSell'], $sunContractSellPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunContractSellName);
    sendMail($data['sunStatementAccount'], $sunStatementAccountPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $sunStatementAccountName);
    // BUSINESS PROOF OF INCOME
    sendMail($data['updatedBusiness'], $updatedBusinessPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $updatedBusinessName);
    sendMail($data['auditedFinancial'], $auditedFinancialPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $auditedFinancialName);
    sendMail($data['inhouseFinancial'], $inhouseFinancialPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $inhouseFinancialName);
    sendMail($data['businessBankStatement'], $businessBankStatementPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessBankStatementName);
    sendMail($data['salesRecord'], $salesRecordPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $salesRecordName);
    sendMail($data['incomeTaxReturn'], $incomeTaxReturnPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $incomeTaxReturnName);
    sendMail($data['contractLease'], $contractLeasePath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $contractLeaseName);
    sendMail($data['customerNumber'], $customerNumberPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $customerNumberName);
    sendMail($data['customerSupplier'], $customerSupplierPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $customerSupplierName);
    sendMail($data['otherIncomeB'], $otherIncomeBPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $otherIncomeBName);
    // EMPLOYED PROOF OF INCOME
    sendMail($data['employmentContract'], $employmentContractPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $employmentContractName);
    sendMail($data['certificateEmployment'], $certificateEmploymentPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $certificateEmploymentName);
    sendMail($data['incomeTax'], $incomeTaxPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $incomeTaxReturnName);
    sendMail($data['payslipMonths'], $payslipMonthsPath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $payslipMonthsName);
    sendMail($data['otherIncome'], $otherIncomePath, $fullname, "irmilano@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $otherIncomeBName);
    // OTHERS MAILING
    sendMail($data['powerAttorneyI'], $powerAttorneyIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $powerAttorneyIName);
    sendMail($data['generalInfo'], $generalInfoPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $generalInfoName);
    sendMail($data['securityExchange'], $securityExchangePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $securityExchangeName);
    sendMail($data['letterGuarantee'], $letterGuaranteePath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $letterGuaranteeName);
    sendMail($data['boardResolution'], $boardResolutionPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $boardResolutionName);
    sendMail($data['statementAccount'], $statementAccountPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $statementAccountName);
    sendMail($data['billMaterial'], $billMaterialPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $billMaterialName);
    sendMail($data['proposedPlan'], $proposedPlanPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $proposedPlanName);
    sendMail($data['cic'], $cicnPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $cicName);
    sendMail($data['nfis'], $nfisPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $nfisName);



    // DOCUMENTS MAILING
    mailReport($data['receipt'], $receiptPath, $fullname, $receiptName);
    sendMail($data['collateralAppraisalReportI'], $collateralAppraisalReportIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditInvestigationReportIName);
    sendMail($data['financialEvaluationI'], $financialEvaluationIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $financialEvaluationIName);
    sendMail($data['signedLetterI'], $signedLetterIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $signedLetterIName);
    sendMail($data['signedLetterUnderEndI'], $signedLetterUnderEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $signedLetterUnderEndIName);
    mailMemo($data['signedLoanMemoI'], $signedLoanMemoIPath, $fullname, $signedLoanMemoIName);
    sendMail($data['remContractI'], $remContractIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $remContractIName);
    sendMail($data['remContractAnnotatedI'], $remContractAnnotatedIPath, $fullname, "jesus.diokno@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $remContractAnnotatedIName);
    sendMail($data['promNoteI'], $promNoteIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $promNoteIName);
    sendMail($data['disclosureStateI'], $disclosureStateIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $disclosureStateIName);
    sendMail($data['mriFormI'], $mriFormIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $mriFormIName);
    sendMail($data['amortScheduleI'], $amortScheduleIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $amortScheduleIName);
    sendMail($data['remContractEndI'], $remContractEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $remContractIName);
    sendMail($data['promNoteEndI'], $promNoteEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $promNoteIName);
    sendMail($data['disclosureStateEndI'], $disclosureStateEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $disclosureStateIName);
    sendMail($data['mriFormEndI'], $mriFormEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $mriFormIName);
    sendMail($data['amortScheduleEndI'], $amortScheduleEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $amortScheduleIName);
    sendMail($data['signedDeedUnderEndI'], $signedDeedUnderEndIPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $signedDeedUnderEndIName);
    sendMail($data['utilization'], $utilizationPath, $fullname, "cdcruz@ourbank.ph", 'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $utilizationName);

            // LETTER MAILING
    letterMail($data['ifLetter'], $ifLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['isLetter'], $isLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['itLetter'], $itLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ifdLetter'], $ifdLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ifLetter2'], $ifLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['isLetter2'], $isLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['itLetter2'], $itLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ifdLetter2'], $ifdLetter2Path, $fullname , "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ifLetter3'], $ifLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
    letterMail($data['isLetter3'], $isLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
    letterMail($data['itLetter3'], $itLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ifdLetter3'], $ifdLetter3Path, $fullname , "", "josmin.alvarez@ourbank.ph");
    // 
    letterMail($data['iffClosure'], $iffClosurePath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['pastLitigation'], $pastLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['pastLitigation2'], $pastLitigation2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ittLitigation'], $ittLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['prepConso'], $prepConsoPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['iaDemand'], $iaDemandPath, $fullname, "", "josmin.alvarez@ourbank.ph");

    $updateSqlStats = "";

    if ($iaDemandPath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 9 WHERE loan_Id = '$indivId'";
    }
    if ($prepConsoPath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 8 WHERE loan_Id = '$indivId'";
    }
    if ($ittLitigationPath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$indivId'";
    } 
    if ($pastLitigationPath != '' && $pastLitigation2Path != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$indivId'";
    }
    if ($iffClosurePath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$indivId'";
    }
    if ($ifdLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 4, `remarks` = '$ifdLetterSelect' WHERE loan_Id = '$indivId'";
    }
    if ($itLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 3, `remarks` = '$itLetterSelect' WHERE loan_Id = '$indivId'";
    }if ($isLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 2, `remarks` = '$isLetterSelect' WHERE loan_Id = '$indivId'";
    }if ($ifLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 1, `remarks` = '$ifLetterSelect' WHERE loan_Id = '$indivId'";
    }
    
    // Execute the query only if $updateSqlStats is set
    if (!empty($updateSqlStats)) {
        $updateQueryStats = mysqli_query($con, $updateSqlStats);
    } else {
    
    }
    

    $ftpServer = '10.10.10.117';
    $ftpUsername = "ourbank-tech";
    $ftpPassword = "Juliuspogi2023";

  // Local file paths
    $localFiles = [
    // PRINCIPAL BORROWER
    $loanAppFormIPath,
    $photocopyIdSignaturesPath,
    $proofBillingPath,
    $personalBankPath,
    $marriageContractPath,
    $barangayClearancePath,
    // COLLATERAL DOCUMENTS
    $transferCertificatePath,
    $taxDeclarationLotPath,
    $taxDeclarationImpPath,
    $realEstateTaxClearancePath,
    $realEstateTaxReceiptPath,
    $cancellationDischargePath,
    // SUNTRUST DOCUMENTS
    $sunTransferCertificatePath,
    $sunTaxDeclarationLotPath,
    $sunTaxDeclarationImpPath,
    $sunContractSellPath,
    $sunStatementAccountPath,
    // BUSINESS PROOF OF INCOME
    $updatedBusinessPath,
    $auditedFinancialPath,
    $inhouseFinancialPath,
    $businessBankStatementPath,
    $salesRecordPath,
    $incomeTaxReturnPath,
    $contractLeasePath,
    $customerNumberPath,
    $customerSupplierPath,
    $otherIncomeBPath,
    // EMPLYOED PROOF OF INCOME
    $employmentContractPath,
    $certificateEmploymentPath,
    $incomeTaxPath,
    $payslipMonthsPath,
    $otherIncomePath,
    // OTHERS
    $powerAttorneyIPath,
    $generalInfoPath,
    $securityExchangepath,
    $letterGuaranteePath,
    $boardResolutionPath,
    $statementAccountpath,
    $billMaterialPath,
    $proposedPlanPath,
    $utilizationPath,
    $cicPath,
    $nfisPath,
    // LETTER
    $ifLetterPath,
    $isLetterPath,
    $itLetterPath,
    $ifdLetterPath,
    // LETTER2
    $ifLetter2Path,
    $isLetter2Path,
    $itLetter2Path,
    $ifdLetter2Path,
    // LETTER3
    $ifLetter3Path,
    $isLetter3Path,
    $itLetter3Path,
    $ifdLetter3Path,
    // OTHER ATTACHMENT
    $iclientReq1Path,
    $iclientReq2Path,
    $iclientReq3Path,
    // LEGAL
    $iffClosurePath,
    $pastLitigationPath,
    $pastLitigation2Path,
    $ittLitigationPath,
    $prepConsoPath,
    $iaDemandPath
];


$ftpConnection = ftp_ssl_connect($ftpServer);
if (!$ftpConnection) {
    die('Failed to connect to the FTP server');
}

// Login to the FTP server
$login = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
if (!$login) {
    die('Failed to login to the FTP server');
}

// Enable passive mode (optional, depending on your server's configuration)
ftp_pasv($ftpConnection, true);
echo "CONNECTED";

// Upload each file
foreach ($localFiles as $localFile) {
    $localName = explode("/", $localFile)[1];

    $remoteFile = "LOAN/" . $address . "SECURED LOAN/" . $fullname . '/' . $localName;

   

    $upload = ftp_put($ftpConnection, $remoteFile, $localFile, FTP_BINARY);
    if ($upload) {
        echo 'File uploaded successfully!<br>';
    } else {
        echo 'Failed to upload the file<br>';
    }
}

// Close the FTP connection
ftp_close($ftpConnection);

echo 'All files uploaded successfully!';
}

else {

    echo 'ERROR Insert'. mysqli_error($con);

}

}

?>
