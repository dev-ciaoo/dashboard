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
$corpId = $_POST['corpId'];
$fullname=$_POST['fullname'];
$salaryType=$_POST['salaryType'];
$branch=$_POST['branch'];
$productID =$_POST['productID'];
$edit1= $_POST['edit1'];

$powerAttorneyIValue = isset($_POST['powerAttorneyCheck']) ? "Check" : "Uncheck";
$contractSellValue = isset($_POST['contractSellCheck']) ? "Check" : "Uncheck";
$letterGuaranteeValue = isset($_POST['letterGuaranteeCheck']) ? "Check" : "Uncheck";
$statementAccountValue = isset($_POST['statementAccountCheck']) ? "Check" : "Uncheck";
$billMaterialsValue = isset($_POST['billMaterialsCheck']) ? "Check" : "Uncheck";
$proposedPlanValue = isset($_POST['proposedPlanCheck']) ? "Check" : "Uncheck";
$cicValue = isset($_POST['cicCheck']) ? "Check" : "Uncheck";
$nfisValue = isset($_POST['nfisCheck']) ? "Check" : "Uncheck";
$otherDocValue = isset($_POST['otherDocCheck']) ? "Check" : "Uncheck";

#LEGAL Checkbox
$cpastCheck = isset($_POST['cpastCheck']) ? "Yes" : "No";

// PRINCIPAL BORROWER
$endorsementSelect = $_POST['endorsementSelect'];
$loanAppFormCSelect = $_POST['loanAppFormCSelect'];
$companyProfileSelect = $_POST['companyProfileSelect'];
$governmentIdSelect = $_POST['governmentIdSelect'];
$secRegistrationSelect = $_POST['secRegistrationSelect'];
$latestGISSelect = $_POST['latestGISSelect'];
$copyBRSSelect = $_POST['copyBRSSelect'];
$copyidCSTSelect = $_POST['copyidCSTSelect'];
// COLLATERAL DOCUMENTS
$transferCertTitleSelect = $_POST['transferCertTitleSelect'];
$taxDeclarationSelect = $_POST['taxDeclarationSelect'];
$taxDeclartionICTCSelect = $_POST['taxDeclartionICTCSelect'];
$realStateReceiptSelect = $_POST['realStateReceiptSelect'];
$realEstateTaxClearanceSelect = $_POST['realEstateTaxClearanceSelect'];
$cdOfMorgageSelect = $_POST['cdOfMorgageSelect'];
// BUSINESS PROOF OF INCOME
$copyUpdatedBPSelect = $_POST['copyUpdatedBPSelect'];
$auditedFinancialSelect = $_POST['auditedFinancialSelect'];
$inhouseFinancialSelect = $_POST['inhouseFinancialSelect'];
$latestBankSelect = $_POST['latestBankSelect'];
$incomeTaxReturnSelect = $_POST['incomeTaxReturnSelect'];
$contractLeaseSelect = $_POST['contractLeaseSelect'];
$customerContactSelect = $_POST['customerContactSelect'];
$supplierContactSelect = $_POST['supplierContactSelect'];
$proofBillingSelect = $_POST['proofBillingSelect'];
// OTHERS
$powerAttorneySelect = $_POST['powerAttorneySelect'];
$contractSellSelect = $_POST['contractSellSelect'];
$letterGuaranteeSelect = $_POST['letterGuaranteeSelect'];
$statementAccountSelect = $_POST['statementAccountSelect'];
$billMaterialsSelect = $_POST['billMaterialsSelect'];
$proposedPlanSelect = $_POST['proposedPlanSelect'];
$cicSelect = $_POST['cicSelect'];
$nfisSelect = $_POST['nfisSelect'];
$otherDocSelect = $_POST['otherDocSelect'];
// DOCUMENTS
$receiptSelect = $_POST['receiptSelect'];
$creditInvestigationReportCSelect = $_POST['creditInvestigationReportCSelect'];
$collateralAppraisalReportCSelect = $_POST['collateralAppraisalReportCSelect'];
$financialEvaluationCSelect = $_POST['financialEvaluationCSelect'];
$signedLetterCSelect = $_POST['signedLetterCSelect'];
$signedLetterUnderEndCSelect = $_POST['signedLetterUnderEndCSelect'];
$signedLoanMemoCSelect = $_POST['signedLoanMemoCSelect'];
$remContractCSelect = $_POST['remContractCSelect'];
$remContractAnnotatedCSelect = $_POST['remContractAnnotatedCSelect'];
$promNoteCSelect = $_POST['promNoteCSelect'];
$disclosureStateCSelect = $_POST['disclosureStateCSelect'];
$mriFormCSelect = $_POST['mriFormCSelect'];
$amortScheduleCSelect = $_POST['amortScheduleCSelect'];
$remContractEndCSelect = $_POST['remContractEndCSelect'];
$promNoteEndCSelect = $_POST['promNoteEndCSelect'];
$disclosureStateEndCSelect = $_POST['disclosureStateEndCSelect'];
$mriFormEndCSelect = $_POST['mriFormEndCSelect'];
$amortScheduleEndCSelect = $_POST['amortScheduleEndCSelect'];
$signedDeedUnderEndCSelect = $_POST['signedDeedUnderEndCSelect'];
$utilizationSelect = $_POST['utilizationSelect'];

// GETTING THE REMMARKS
// PRINCIPAL BORROWER
$endorsementDesc = $_POST['endorsementDesc'];
$loanAppFormCDesc = $_POST['loanAppFormCDesc'];
$companyProfileDesc = $_POST['companyProfileDesc'];
$governmentIdDesc = $_POST['governmentIdDesc'];
$secRegistrationDesc = $_POST['secRegistrationDesc'];
$latestGISDesc = $_POST['latestGISDesc'];
$copyBRSDesc = $_POST['copyBRSDesc'];
$copyidCSTDesc = $_POST['copyidCSTDesc'];
// COLLATERAL DOCUMENTS
$transferCertTitleDesc = $_POST['transferCertTitleDesc'];
$taxDeclarationDesc = $_POST['taxDeclarationDesc'];
$taxDeclartionICTCDesc = $_POST['taxDeclartionICTCDesc'];
$realStateReceiptDesc = $_POST['realStateReceiptDesc'];
$realEstateTaxClearanceDesc = $_POST['realEstateTaxClearanceDesc'];
$cdOfMorgageDesc = $_POST['cdOfMorgageDesc'];
// BUSINESS PROOF OF INCOME
$copyUpdatedBPDesc = $_POST['copyUpdatedBPDesc'];
$auditedFinancialDesc = $_POST['auditedFinancialDesc'];
$inhouseFinancialDesc = $_POST['inhouseFinancialDesc'];
$latestBankDesc = $_POST['latestBankDesc'];
$incomeTaxReturnDesc = $_POST['incomeTaxReturnDesc'];
$contractLeaseDesc = $_POST['contractLeaseDesc'];
$customerContactDesc = $_POST['customerContactDesc'];
$supplierContactDesc = $_POST['supplierContactDesc'];
$proofBillingDesc = $_POST['proofBillingDesc'];
// OTHERS
$powerAttorneyDesc = $_POST['powerAttorneyDesc'];
$contractSellDesc = $_POST['contractSellDesc'];
$letterGuaranteeDesc = $_POST['letterGuaranteeDesc'];
$statementAccountDesc = $_POST['statementAccountDesc'];
$billMaterialsDesc = $_POST['billMaterialsDesc'];
$proposedPlanDesc = $_POST['proposedPlanDesc'];
$cicDesc = $_POST['cicDesc'];
$nfisDesc = $_POST['nfisDesc'];
$otherDocDesc = $_POST['otherDocDesc'];
// DOCUMENTS
$receiptDesc = $_POST['receiptDesc'];
$creditInvestigationReportCDesc = $_POST['creditInvestigationReportCDesc'];
$collateralAppraisalReportCDesc = $_POST['collateralAppraisalReportCDesc'];
$financialEvaluationCDesc = $_POST['financialEvaluationCDesc'];
$signedLetterCDesc = $_POST['signedLetterCDesc'];
$signedLetterUnderEndCDesc = $_POST['signedLetterUnderEndCDesc'];
$signedLoanMemoCDesc = $_POST['signedLoanMemoCDesc'];
$remContractCDesc = $_POST['remContractCDesc'];
$remContractAnnotatedCDesc = $_POST['remContractAnnotatedCDesc'];
$promNoteCDesc = $_POST['promNoteCDesc'];
$disclosureStateCDesc = $_POST['disclosureStateCDesc'];
$mriFormCDesc = $_POST['mriFormCDesc'];
$amortScheduleCDesc = $_POST['amortScheduleCDesc'];
$remContractEndCDesc = $_POST['remContractEndCDesc'];
$promNoteEndCDesc = $_POST['promNoteEndCDesc'];
$disclosureStateEndCDesc = $_POST['disclosureStateEndCDesc'];
$mriFormEndCDesc = $_POST['mriFormEndCDesc'];
$amortScheduleEndCDesc = $_POST['amortScheduleEndCDesc'];
$signedDeedUnderEndCDesc = $_POST['signedDeedUnderEndCDesc'];
$utilizationDesc= $_POST['utilizationDesc'];
// LETTER DESC
$cfLetterDesc = $_POST['cfLetterDesc'];
$csLetterDesc = $_POST['csLetterDesc'];
$ctLetterDesc = $_POST['ctLetterDesc'];
$cfdLetterDesc = $_POST['cfdLetterDesc'];
// LETTER SELECT
$cfLetterSelect = $_POST['cfLetterSelect'];
$csLetterSelect = $_POST['csLetterSelect'];
$ctLetterSelect = $_POST['ctLetterSelect'];
$cfdLetterSelect = $_POST['cfdLetterSelect'];
// OTHER ATTACHMENT SELECT
$cclientReq1Select = $_POST['cclientReq1Select'];
// LEGAL DESC
$cffClosureDesc = $_POST['cffClosureDesc'];
$cpastLitigationDesc = $_POST['cpastLitigationDesc'];
$cttLitigationDesc = $_POST['cttLitigationDesc'];
$cPrepConsoDesc = $_POST['cPrepConsoDesc'];
$caDemandDesc = $_POST['caDemandDesc'];
// LEGAL SELECT
$cffClosureSelect = $_POST['cffClosureSelect'];
$cpastLitigationSelect = $_POST['cpastLitigationSelect'];
$cttLitigationSelect = $_POST['cttLitigationSelect'];
$cPrepConsoSelect = $_POST['cPrepConsoSelect'];
$caDemandSelect = $_POST['caDemandSelect'];

function archiveFile($fileKey, $dbField, $corpId, $archiveField, $dateToday, $endPrompt, $con) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        // error_log("In archiveFile - End Prompt: " . $endPrompt);
        
        // Fetch the existing file data from the `individual` table
        $selectQuery = "SELECT `$dbField` FROM `corporation` WHERE `corpLoanId` = '$corpId'";
        $selectResult = mysqli_query($con, $selectQuery);
        
        if ($row = mysqli_fetch_array($selectResult)) {
            $fileData = $row[$dbField];
            
            // Insert the previous data into the `indivarchive` table
            if($endPrompt != ''){
                $insertQuery = "INSERT INTO `corparchive` (`a_corpLoanId`, `$archiveField`, `a_cdateUpload`, `ac_remarks`)
                                                    VALUES 
                                                            ('$corpId', '$fileData', '$dateToday', '$endPrompt')";
                
                // Log the insert query to see what is being executed
                // error_log("Preparing to insert: $insertQuery");
                
                if (mysqli_query($con, $insertQuery)) {
                   
                } else {
                    echo 'Error: ' . mysqli_error($con);
                }
            }else{
                echo '<script>console.log("remarks is empty, will not proceed to INSERT in archive db");</script>';
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
    // PRINCIPAL BORROWER
    if (isset($_FILES['endorsement'])) {
        archiveFile('endorsement', 'endorsement', $corpId, 'a_endorsement', $dateToday, $endPrompt, $con);
    }
    if (isset($_FILES['loanAppFormC'])) {
        archiveFile('loanAppFormC', 'loanAppFormC', $corpId, 'a_loanAppFormC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['companyProfile'])){
        archiveFile('companyProfile', 'ccompanyProfile', $corpId, 'a_ccompanyProfile', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['governmentId'])){
        archiveFile('governmentId', 'governmentId', $corpId, 'a_governmentId', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['secRegistration'])){
        archiveFile('secRegistration', 'csecRegistration', $corpId, 'a_csecRegistration', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['latestGIS'])){
        archiveFile('latestGIS', 'clatestGIS', $corpId, 'a_clatestGIS', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['copyBRS'])){
        archiveFile('copyBRS', 'ccopyBRS', $corpId, 'a_ccopyBRS', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['copyidCST'])){
        archiveFile('copyidCST', 'ccopyidCST', $corpId, 'a_ccopyidCST', $dateToday, $endPrompt, $con);
    }

    // COLLATERAL DOCS
    if(isset($_FILES['transferCertTitle'])){
        archiveFile('transferCertTitle', 'ctransferCertTitle', $corpId, 'a_ctransferCertTitle', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['taxDeclaration'])){
        archiveFile('taxDeclaration', 'ctaxDeclaration', $corpId, 'a_ctaxDeclaration', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['taxDeclartionICTC'])){
        archiveFile('taxDeclartionICTC', 'ctaxDeclartionICTC', $corpId, 'a_ctaxDeclartionICTC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['realStateReceipt'])){
        archiveFile('realStateReceipt', 'crealStateReceipt', $corpId, 'a_crealStateReceipt', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['realEstateTaxClearance'])){
        archiveFile('realEstateTaxClearance', 'crealEstateTaxClearance', $corpId, 'a_crealEstateTaxClearance', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cdOfMorgage'])){
        archiveFile('cdOfMorgage', 'ccdOfMorgage', $corpId, 'a_ccdOfMorgage', $dateToday, $endPrompt, $con);
    }

    // BUSINESS PROOF OF INCOME
    if(isset($_FILES['copyUpdatedBP'])){
        archiveFile('copyUpdatedBP', 'ccopyUpdatedBP', $corpId, 'a_ccopyUpdatedBP', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['auditedFinancial'])){
        archiveFile('auditedFinancial', 'cauditedFinancial', $corpId, 'a_cauditedFinancial', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['inhouseFinancial'])){
        archiveFile('inhouseFinancial', 'cinhouseFinancial', $corpId, 'a_cinhouseFinancial', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['latestBank'])){
        archiveFile('latestBank', 'clatestBank', $corpId, 'a_clatestBank', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['incomeTaxReturn'])){
        archiveFile('incomeTaxReturn', 'incomeTaxReturn', $corpId, 'a_incomeTaxReturn', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['contractLease'])){
        archiveFile('contractLease', 'contractLease', $corpId, 'a_contractLease', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['customerContact'])){
        archiveFile('customerContact', 'ccustomerContact', $corpId, 'a_ccustomerContact', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['supplierContact'])){
        archiveFile('supplierContact', 'csupplierContact', $corpId, 'a_csupplierContact', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['proofBilling'])){
        archiveFile('proofBilling', 'cproofBilling', $corpId, 'a_cproofBilling', $dateToday, $endPrompt, $con);
    }

    // DOCS REPORT AND CASHFLOW ANALYSIS
    if(isset($_FILES['receipt'])){
        archiveFile('receipt', 'receipt', $corpId, 'a_receipt', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['creditInvestigationReportC'])){
        archiveFile('creditInvestigationReportC', 'creditInvestigationReportC', $corpId, 'a_creditInvestigationReportC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['collateralAppraisalReportC'])){
        archiveFile('collateralAppraisalReportC', 'collateralAppraisalReportC', $corpId, 'a_collateralAppraisalReportC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['financialEvaluationC'])){
        archiveFile('financialEvaluationC', 'financialEvaluationC', $corpId, 'a_financialEvaluationC', $dateToday, $endPrompt, $con);
    }

    // SIGNING OF APPROVAL
    if(isset($_FILES['signedLetterC'])){
        archiveFile('signedLetterC', 'signedLetterC', $corpId, 'a_signedLetterC', $dateToday, $endPrompt, $con);
    }

    // SIGNING OF THE LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE
    if(isset($_FILES['signedLoanMemoC'])){
        archiveFile('signedLoanMemoC', 'signedLoanMemoC', $corpId, 'a_signedLoanMemoC', $dateToday, $endPrompt, $con);
    }

    // SIGNING OF REM CONTRACT
    if(isset($_FILES['remContractC'])){
        archiveFile('remContractC', 'remContractC', $corpId, 'a_remContractC', $dateToday, $endPrompt, $con);
    }

    // REGISTRATION IN REGISTRY OF DEEDS
    if(isset($_FILES['remContractAnnotatedC'])){
        archiveFile('remContractAnnotatedC', 'remContractAnnotatedC', $corpId, 'a_remContractAnnotatedC', $dateToday, $endPrompt, $con);
    }

    // DOCS AFTER RELEASE OF THE LOAN
    if(isset($_FILES['promNoteC'])){
        archiveFile('promNoteC', 'promNoteC', $corpId, 'a_promNoteC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['disclosureStateC'])){
        archiveFile('disclosureStateC', 'disclosureStateC', $corpId, 'a_disclosureStateC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mriFormC'])){
        archiveFile('mriFormC', 'mriFormC', $corpId, 'a_mriFormC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['amortScheduleC'])){
        archiveFile('amortScheduleC', 'amortScheduleC', $corpId, 'a_amortScheduleC', $dateToday, $endPrompt, $con);
    }

    // END BUYER
    if(isset($_FILES['signedLetterUnderEndC'])){
        archiveFile('signedLetterUnderEndC', 'signedLetterUnderEndC', $corpId, 'a_signedLetterUnderEndC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['remContractEndC'])){
        archiveFile('remContractEndC', 'remContractEndC', $corpId, 'a_remContractEndC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['promNoteEndC'])){
        archiveFile('promNoteEndC', 'promNoteEndC', $corpId, 'a_promNoteEndC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['disclosureStateEndC'])){
        archiveFile('disclosureStateEndC', 'disclosureStateEndC', $corpId, 'a_disclosureStateEndC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mriFormEndC'])){
        archiveFile('mriFormEndC', 'mriFormEndC', $corpId, 'a_mriFormEndC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['amortScheduleEndC'])){
        archiveFile('amortScheduleEndC', 'amortScheduleEndC', $corpId, 'a_amortScheduleEndC', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['signedDeedUnderEndC'])){
        archiveFile('signedDeedUnderEndC', 'signedDeedUnderEndC', $corpId, 'a_signedDeedUnderEndC', $dateToday, $endPrompt, $con);
    }

    // LOAN UTILIZATION
    if(isset($_FILES['utilization'])){
        archiveFile('utilization', 'utilization', $corpId, 'a_utilization', $dateToday, $endPrompt, $con);
    }

    // PRESENTATION DOCS
    if(isset($_FILES['powerpoint'])){
        archiveFile('powerpoint', 'powerpoint', $corpId, 'a_powerpoint', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['excel'])){
        archiveFile('excel', 'excel', $corpId, 'a_excel', $dateToday, $endPrompt, $con);
    }

    // OTHERS
    if(isset($_FILES['powerAttorney'])){
        archiveFile('powerAttorney', 'powerAttorney', $corpId, 'a_powerAttorney', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['contractSell'])){
        archiveFile('contractSell', 'contractSell', $corpId, 'a_contractSell', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['letterGuarantee'])){
        archiveFile('letterGuarantee', 'letterGuarantee', $corpId, 'a_letterGuarantee', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['statementAccount'])){
        archiveFile('statementAccount', 'statementAccount', $corpId, 'a_statementAccount', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['billMaterials'])){
        archiveFile('billMaterials', 'billMaterials', $corpId, 'a_billMaterials', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['proposedPlan'])){
        archiveFile('proposedPlan', 'proposedPlan', $corpId, 'a_proposedPlan', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cic'])){
        archiveFile('cic', 'cic', $corpId, 'a_cic', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['nfis'])){
        archiveFile('nfis', 'nfis', $corpId, 'a_nfis', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['otherDoc'])){
        archiveFile('otherDoc', 'otherDoc', $corpId, 'a_otherDoc', $dateToday, $endPrompt, $con);
    }
    // dueCollection
    // cfLetter
    if(isset($_FILES['cfLetter'])){
        archiveFile('cfLetter', 'cfLetter', $corpId, 'a_cfLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cfLetter2'])){
        archiveFile('cfLetter2', 'cfLetter2', $corpId, 'a_cfLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cfLetter3'])){
        archiveFile('cfLetter3', 'cfLetter3', $corpId, 'a_cfLetter3', $dateToday, $endPrompt, $con);
    }
    // csLetter
    if(isset($_FILES['csLetter'])){
        archiveFile('csLetter', 'csLetter', $corpId, 'a_csLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['csLetter2'])){
        archiveFile('csLetter2', 'csLetter2', $corpId, 'a_csLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['csLetter3'])){
        archiveFile('csLetter3', 'csLetter3', $corpId, 'a_csLetter3', $dateToday, $endPrompt, $con);
    }
    // ctLetter
    if(isset($_FILES['ctLetter'])){
        archiveFile('ctLetter', 'ctLetter', $corpId, 'a_ctLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ctLetter2'])){
        archiveFile('ctLetter2', 'ctLetter2', $corpId, 'a_ctLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ctLetter3'])){
        archiveFile('ctLetter3', 'ctLetter3', $corpId, 'a_ctLetter3', $dateToday, $endPrompt, $con);
    }
    // cfdLetter
    if(isset($_FILES['cfdLetter'])){
        archiveFile('cfdLetter', 'cfdLetter', $corpId, 'a_cfdLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cfdLetter2'])){
        archiveFile('cfdLetter2', 'cfdLetter2', $corpId, 'a_cfdLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cfdLetter3'])){
        archiveFile('cfdLetter3', 'cfdLetter3', $corpId, 'a_cfdLetter3', $dateToday, $endPrompt, $con);
    }

    // other attachment
    if(isset($_FILES['cclientReq1'])){
        archiveFile('cclientReq1', 'cclientReq1', $corpId, 'a_cclientReq1', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cclientReq2'])){
        archiveFile('cclientReq2', 'cclientReq2', $corpId, 'a_cclientReq2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cclientReq3'])){
        archiveFile('cclientReq3', 'cclientReq3', $corpId, 'a_cclientReq3', $dateToday, $endPrompt, $con);
    }

    // legal
    if(isset($_FILES['cffClosure'])){
        archiveFile('cffClosure', 'cffClosure', $corpId, 'a_cffClosure', $dateToday, $endPrompt, $con);
    }

    // past due litigation
    if(isset($_FILES['cpastLitigation'])){
        archiveFile('cpastLitigation', 'cpastLitigation', $corpId, 'a_cpastLitigation', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cpastLitigation2'])){
        archiveFile('cpastLitigation2', 'cpastLitigation2', $corpId, 'a_cpastLitigation2', $dateToday, $endPrompt, $con);
    }

    // tramsfer to ROPA
    if(isset($_FILES['cttLitigation'])){
        archiveFile('cttLitigation', 'cttLitigation', $corpId, 'a_cttLitigation', $dateToday, $endPrompt, $con);
    }

    // preparation of consolidation
    if(isset($_FILES['cPrepConso'])){
        archiveFile('cPrepConso', 'cPrepConso', $corpId, 'a_cPrepConso', $dateToday, $endPrompt, $con);
    }

    // due and demandable
    if(isset($_FILES['caDemand'])){
        archiveFile('caDemand', 'caDemand', $corpId, 'a_caDemand', $dateToday, $endPrompt, $con);
    }
    // end
}

// PRINCIPAL BORROWER
$endorsementFile = upload_file($_FILES['endorsement'], 'corporation', $corpId);
$loanAppFormCFile = upload_file($_FILES['loanAppFormC'], 'corporation', $corpId);
$companyProfileFile = upload_file($_FILES['companyProfile'], 'corporation', $corpId);
$governmentIdFile = upload_file($_FILES['governmentId'], 'corporation', $corpId);
$secRegistrationFile = upload_file($_FILES['secRegistration'], 'corporation', $corpId);
$latestGISFile = upload_file($_FILES['latestGIS'], 'corporation', $corpId);
$copyBRSFile = upload_file($_FILES['copyBRS'], 'corporation', $corpId);
$copyidCSTFile = upload_file($_FILES['copyidCST'], 'corporation', $corpId);
// COLLATERAL BORROWER
$transferCertTitleFile = upload_file($_FILES['transferCertTitle'], 'corporation', $corpId);
$taxDeclarationFile = upload_file($_FILES['taxDeclaration'], 'corporation', $corpId);
$taxDeclartionICTCFile = upload_file($_FILES['taxDeclartionICTC'], 'corporation', $corpId);
$realStateReceiptFile = upload_file($_FILES['realStateReceipt'], 'corporation', $corpId);
$realEstateTaxClearanceFile = upload_file($_FILES['realEstateTaxClearance'], 'corporation', $corpId);
$cdOfMorgageFile = upload_file($_FILES['cdOfMorgage'], 'corporation', $corpId);
// BUSINESS PROOF OF INCOME
$copyUpdatedBPFile = upload_file($_FILES['copyUpdatedBP'], 'corporation', $corpId);
$auditedFinancialFile = upload_file($_FILES['auditedFinancial'], 'corporation', $corpId);
$inhouseFinancialFile = upload_file($_FILES['inhouseFinancial'], 'corporation', $corpId);
$latestBankFile = upload_file($_FILES['latestBank'], 'corporation', $corpId);
$incomeTaxReturnFile = upload_file($_FILES['incomeTaxReturn'], 'corporation', $corpId);
$contractLeaseFile = upload_file($_FILES['contractLease'], 'corporation', $corpId);
$customerContactFile = upload_file($_FILES['customerContact'], 'corporation', $corpId);
$supplierContactFile = upload_file($_FILES['supplierContact'], 'corporation', $corpId);
$proofBillingFile = upload_file($_FILES['proofBilling'], 'corporation', $corpId);
// OTHERS
$powerAttorneyFile = upload_file($_FILES['powerAttorney'], 'corporation', $corpId);
$contractSellFile = upload_file($_FILES['contractSell'], 'corporation', $corpId);
$letterGuaranteeFile = upload_file($_FILES['letterGuarantee'], 'corporation',$corpId);
$statementAccountFile = upload_file($_FILES['statementAccount'], 'corporation', $corpId);
$billMaterialsFile= upload_file($_FILES['billMaterials'], 'corporation', $corpId);
$proposedPlanFile = upload_file($_FILES['proposedPlan'], 'corporation', $corpId);
$cicFile = upload_file($_FILES['cic'], 'corporation', $corpId);
$nfisFile = upload_file($_FILES['nfis'], 'corporation', $corpId);
$otherDocFile = upload_file($_FILES['otherDoc'], 'individual',$indivId);
// DOCUMENTS
$receiptFile = upload_file($_FILES['receipt'], 'corporation', $corpId);
$creditInvestigationReportCFile = upload_file($_FILES['creditInvestigationReportC'], 'corporation', $corpId);
$collateralAppraisalReportCFile = upload_file($_FILES['collateralAppraisalReportC'], 'corporation', $corpId);
$financialEvaluationCFile = upload_file($_FILES['financialEvaluationC'], 'corporation', $corpId);
$signedLetterCFile = upload_file($_FILES['signedLetterC'], 'corporation', $corpId);
$signedLoanMemoCFile = upload_file($_FILES['signedLoanMemoC'], 'corporation', $corpId);
$remContractCFile = upload_file($_FILES['remContractC'], 'corporation', $corpId);
$promNoteCFile = upload_file($_FILES['promNoteC'], 'corporation', $corpId);
$disclosureStateCFile = upload_file($_FILES['disclosureStateC'], 'corporation', $corpId);
$mriFormCFile = upload_file($_FILES['mriFormC'], 'corporation', $corpId);
$remContractAnnotatedCFile = upload_file($_FILES['remContractAnnotatedC'], 'corporation', $corpId);
$signedLetterUnderEndCFile = upload_file($_FILES['signedLetterUnderEndC'], 'corporation', $corpId);
$remContractEndCFile = upload_file($_FILES['remContractEndC'], 'corporation', $corpId);
$promNoteEndCFile = upload_file($_FILES['promNoteEndC'], 'corporation', $corpId);
$disclosureStateEndCFile = upload_file($_FILES['disclosureStateEndC'], 'corporation', $corpId);
$mriFormEndCFile = upload_file($_FILES['mriFormEndC'], 'corporation', $corpId);
$signedDeedUnderEndCFile = upload_file($_FILES['signedDeedUnderEndC'], 'corporation', $corpId);
$amortScheduleCFile = upload_file($_FILES['amortScheduleC'], 'corporation', $corpId);
$amortScheduleEndCFile = upload_file($_FILES['amortScheduleEndC'], 'corporation', $corpId);
$utilizationFile = upload_file($_FILES['utilization'], 'corporation', $corpId);
$powerpointFile = upload_file($_FILES['powerpoint'], 'corporation', $corpId);
$excelFile = upload_file($_FILES['excel'], 'corporation', $corpId);
// LETTER
$cfLetterFile = upload_file($_FILES['cfLetter'], 'corporation', $corpId);
$csLetterFile = upload_file($_FILES['csLetter'], 'corporation', $corpId);
$ctLetterFile = upload_file($_FILES['ctLetter'], 'corporation', $corpId);
$cfdLetterFile = upload_file($_FILES['cfdLetter'], 'corporation', $corpId);
// LETTER2
$cfLetter2File = upload_file($_FILES['cfLetter2'], 'corporation', $corpId);
$csLetter2File = upload_file($_FILES['csLetter2'], 'corporation', $corpId);
$ctLetter2File = upload_file($_FILES['ctLetter2'], 'corporation', $corpId);
$cfdLetter2File = upload_file($_FILES['cfdLetter2'], 'corporation', $corpId);
// LETTER3
$cfLetter3File = upload_file($_FILES['cfLetter3'], 'corporation', $corpId);
$csLetter3File = upload_file($_FILES['csLetter3'], 'corporation', $corpId);
$ctLetter3File = upload_file($_FILES['ctLetter3'], 'corporation', $corpId);
$cfdLetter3File = upload_file($_FILES['cfdLetter3'], 'corporation', $corpId);
// OTHER ATTACHMENT
$cclientReq1File = upload_file($_FILES['cclientReq1'], 'corporation', $corpId);
$cclientReq2File = upload_file($_FILES['cclientReq2'], 'corporation', $corpId);
$cclientReq3File = upload_file($_FILES['cclientReq3'], 'corporation', $corpId);
// LEGAL
$cffClosureFile = upload_file($_FILES['cffClosure'], 'corporation', $corpId);
$cpastLitigationFile = upload_file($_FILES['cpastLitigation'], 'corporation', $corpId);
$cpastLitigation2File = upload_file($_FILES['cpastLitigation2'], 'corporation', $corpId);
$cttLitigationFile = upload_file($_FILES['cttLitigation'], 'corporation', $corpId);
$cPrepConsoFile = upload_file($_FILES['cPrepConso'], 'corporation', $corpId);
$caDemandFile = upload_file($_FILES['caDemand'], 'corporation', $corpId);

// STORING THE PATH IN LOCALHOST TO THESE VARIABLES 
// PRINCIPAL BORROWER
$endorsementPath = $endorsementFile['path'];
$loanAppFormCPath = $loanAppFormCFile['path'];
$companyProfilePath = $companyProfileFile['path'];
$governmentIdPath = $governmentIdFile['path'];
$secRegistrationPath = $secRegistrationFile['path'];
$latestGISPath = $latestGISFile['path'];
$copyBRSPath = $copyBRSFile['path'];
$copyidCSTPath = $copyidCSTFile['path'];
// COLLATERAL DOCUMENTS
$transferCertTitlePath = $transferCertTitleFile['path'];
$taxDeclarationPath = $taxDeclarationFile['path'];
$taxDeclartionICTCPath = $taxDeclartionICTCFile['path'];
$realStateReceiptPath = $realStateReceiptFile['path'];
$realEstateTaxClearancePath = $realEstateTaxClearanceFile['path'];
$cdOfMorgagePath = $cdOfMorgageFile['path'];
// BUSINESS PROOF OF INCOME
$copyUpdatedBPPath = $copyUpdatedBPFile['path'];
$auditedFinancialPath = $auditedFinancialFile['path'];
$inhouseFinancialPath = $inhouseFinancialFile['path'];
$latestBankPath = $latestBankFile['path'];
$incomeTaxReturnPath = $incomeTaxReturnFile['path'];
$contractLeasePath = $contractLeaseFile['path'];
$customerContactPath = $customerContactFile['path'];
$supplierContactPath = $supplierContactFile['path'];
$proofBillingPath = $proofBillingFile['path'];
// OTHERS
$powerAttorneyPath = $powerAttorneyFile['path'];
$contractSellPath = $contractSellFile['path'];
$letterGuaranteePath = $letterGuaranteeFile['path'];
$statementAccountPath = $statementAccountFile['path'];
$billMaterialsPath = $billMaterialsFile['path'];
$proposedPlanPath = $proposedPlanFile['path'];
$cicPath = $cicFile['path'];
$nfisPath = $nfisFile['path'];
$otherDocPath = $otherDocFile['path'];
// DOCUMENTS
$receiptPath = $receiptFile['path'];
$creditInvestigationReportCPath = $creditInvestigationReportCFile['path'];
$collateralAppraisalReportCPath = $collateralAppraisalReportCFile['path'];
$financialEvaluationCPath = $financialEvaluationCFile['path'];
$signedLetterCPath = $signedLetterCFile['path'];
$signedLetterUnderEndCPath = $signedLetterUnderEndCFile['path'];
$signedLoanMemoCPath = $signedLoanMemoCFile['path'];
$remContractCPath = $remContractCFile['path'];
$remContractAnnotatedCPath = $remContractAnnotatedCFile['path'];
$promNoteCPath = $promNoteCFile['path'];
$disclosureStateCPath = $disclosureStateCFile['path'];
$mriFormCPath = $mriFormCFile['path'];
$amortScheduleCPath = $amortScheduleCFile['path'];
$remContractEndCPath = $remContractEndCFile['path'];
$promNoteEndCPath = $promNoteEndCFile['path'];
$disclosureStateEndCPath = $disclosureStateEndCFile['path'];
$mriFormEndCPath = $mriFormEndCFile['path'];
$amortScheduleEndCPath = $amortScheduleEndCFile['path'];
$signedDeedUnderEndCPath = $signedDeedUnderEndCFile['path'];
$utilizationPath = $utilizationFile['path'];
$powerpointPath = $powerpointFile['path'];
$excelPath = $excelFile['path'];
// LETTER
$cfLetterPath = $cfLetterFile['path'];
$csLetterPath = $csLetterFile['path'];
$ctLetterPath = $ctLetterFile['path'];
$cfdLetterPath = $cfdLetterFile['path'];
// LETTER2
$cfLetter2Path = $cfLetter2File['path'];
$csLetter2Path = $csLetter2File['path'];
$ctLetter2Path = $ctLetter2File['path'];
$cfdLetter2Path = $cfdLetter2File['path'];
// LETTER3
$cfLetter3Path = $cfLetter3File['path'];
$csLetter3Path = $csLetter3File['path'];
$ctLetter3Path = $ctLetter3File['path'];
$cfdLetter3Path = $cfdLetter3File['path'];
// OTHER ATTACHMENT
$cclientReq1Path = $cclientReq1File['path'];
$cclientReq2Path = $cclientReq2File['path'];
$cclientReq3Path = $cclientReq3File['path'];
// LEGAL
$cffClosurepath = $cffClosureFile['path'];
$cpastLitigationPath = $cpastLitigationFile['path'];
$cpastLitigation2Path = $cpastLitigation2File['path'];
$cttLitigationPath = $cttLitigationFile['path'];
$cPrepConsoPath = $cPrepConsoFile['path'];
$caDemandPath = $caDemandFile['path'];

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
        // if live
        # change to Email to multiple.
        // $mail->addAddress('jesus.diokno@ourbank.ph');
        // $mail->addAddress('josmin.alvarez@ourbank.ph');
        // $mail->addAddress('');
        // testEmail
        // $mail->addAddress('jlcricafrente@ourbank.ph');
        $mail -> isHTML(true);
        $mail->Subject = '[ Collection ]' . $name;
        // $mail->Body = "I hope this message finds you well. I wanted to remind you that the requirements have been uploaded and are ready for you to review.". $name;
        $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                        <br><br>Customer/Client: ' . $name . '
                        ';
        $mail->send();
    }
  }

//  FINAL DEMAND REQUEST FOR RE-APPRAISAL
function finalDemand($data,$path,$name,$email){
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
    $mail -> isHTML(true);
    $mail->Subject = "Requesting for Re-Appraisal:" . $name;
    // $mail->Body = "I hope this message finds you well. I wanted to remind you that the requirements have been uploaded and are ready for you to review.". $name;
    $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                      <br><br>Customer/Client: ' . $name . '
                      <br><br>Requesting for Re-Appraisal,
                      <br><br>Thank you.
                      ';
    $mail->send();
    }
  }

  // FUNCTION FOR EMAIL
  function sendMail($data, $path, $name, $email, $documents){
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
    $mail -> isHTML(true);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    // CHANGE IT TO MARK FOR NOTIF
    // $mail->addAddress('mark.chester.rivera@ourbank.ph');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('apreyes@ourbank.ph');
    // $mail->addAddress('scpayac@ourbank.ph');
    $mail->addAddress($email);
    $mail->Subject = "$name";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Customer/Client: <b> ' . $name . ' </b>
                    <br><br>DOCUMENTS UPLOADED: <b> ' . $documents . ' </b>
                    ';
    $mail->send();
    }
  }
  
    //   REQUIREMENT MAILING
  function requirementsMail($name){
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
    $mail -> isHTML(true);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    // ADD HERE TARGET EMAIL ADDRESS    
    $mail->addAddress('cdcruz@ourbank.ph');
    // $mail->addAddress('mark.chester.rivera@ourbank.ph');
    $mail->addAddress('jesus.diokno@ourbank.ph');
    $mail->addAddress('jonathan.quijano@ourbank.ph');
    $mail->addAddress('cevinluan@ourbank.ph');
    $mail->addAddress('irmilano@ourbank.ph');
    $mail->addAddress('apreyes@ourbank.ph');
    $mail->addAddress('moonsana@ourbank.ph');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('jonathan.quijano@ourbank.ph');
    $mail->addAddress('luisito.verder@ourbank.ph');
    $mail->Subject = "$name";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Requiremnts of ' . $name . ' has been uploaded.  
                    ';
    $mail->send();
    }
      // FUNCTION FOR EMAIL
  function mailMemo($data,$path,$name, $documents){
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
    $mail -> isHTML(true);
    // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    // $mail->addAddress('mark.chester.rivera@ourbank.ph');
    $mail->addAddress('moonsana@ourbank.ph');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('jonathan.quijano@ourbank.ph');
    $mail->addAddress('cdcruz@ourbank.ph');
    $mail->Subject = "$name";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Customer/Client: ' . $name . '
                    <br><br>DOCUMENT UPLOADED: ' . $documents . '
                   ';
    $mail->send();
    }
  }
    // FUNCTION FOR EMAIL
    function mailReport($data,$path,$name, $documents){
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
        $mail -> isHTML(true);
        // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
        $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
        // $mail->addAddress('mark.chester.rivera@ourbank.ph');
        $mail->addAddress('jlcricafrente@ourbank.ph');
        $mail->addAddress('jonathan.quijano@ourbank.ph');
        $mail->addAddress('cevinluan@ourbank.ph');
        $mail->addAddress('cdcruz@ourbank.ph');
        $mail->Subject = "$name";
        $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                        <br><br>Customer/Client: ' . $name . '
                        <br><br>DOCUMENT UPLOADED: ' . $documents . '
                        ';
        $mail->send();
        }
      }

$sqlSelect = "SELECT * FROM corporation WHERE corpLoanId = '$corpId'";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if ($data) {
      // UPLOADING NEXTBANK PRODUCT ID -- comment this if error exist -- 12-20-2023
    if(!empty($productID)){
        $productUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$corpId'";
        $productQuery = mysqli_query($con, $productUpdate);
        if(!$productQuery){
            echo 'ERROR update'. mysqli_error($con);
        }else{
            echo 'Product ID Update Successfully';
        }
    }else{
        echo "Product ID is empty";
    }

  // Data already exists, perform an UPDATE query
  function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
    if (!empty($columnValue)) {
      $sqlUpdate .= " `$columnName` = '$columnValue',";
    }
  }
  
  $sqlUpdate = "UPDATE corporation SET";
  // CHECK EACH DATA PATH, IF THE DATA PATH IS NOT EMPTY IT WILL UPDATE
  // PRINCIPAL BORROWER
  addColumnUpdate($sqlUpdate, "endorsement", $endorsementPath);
  addColumnUpdate($sqlUpdate, "loanAppFormC", $loanAppFormCPath);
  addColumnUpdate($sqlUpdate, "ccompanyProfile", $companyProfilePath);
  addColumnUpdate($sqlUpdate, "governmentId", $governmentIdPath);
  addColumnUpdate($sqlUpdate, "csecRegistration", $secRegistrationPath);
  addColumnUpdate($sqlUpdate, "clatestGIS", $latestGISPath);
  addColumnUpdate($sqlUpdate, "ccopyBRS", $copyBRSPath);
  addColumnUpdate($sqlUpdate, "ccopyidCST", $copyidCSTPath);
   // COLLATERAL DOCUMENTS
  addColumnUpdate($sqlUpdate, "ctransferCertTitle", $transferCertTitlePath);
  addColumnUpdate($sqlUpdate, "ctaxDeclaration", $taxDeclarationPath);
  addColumnUpdate($sqlUpdate, "ctaxDeclartionICTC", $taxDeclartionICTCPath);
  addColumnUpdate($sqlUpdate, "crealStateReceipt", $realStateReceiptPath);
  addColumnUpdate($sqlUpdate, "crealEstateTaxClearance", $realEstateTaxClearancePath);
  addColumnUpdate($sqlUpdate, "ccdOfMorgage", $cdOfMorgagePath);
   // BUSINESS PROOF OF INCOME
  addColumnUpdate($sqlUpdate, "ccopyUpdatedBP", $copyUpdatedBPPath);
  addColumnUpdate($sqlUpdate, "cauditedFinancial", $auditedFinancialPath);
  addColumnUpdate($sqlUpdate, "cinhouseFinancial", $inhouseFinancialPath);
  addColumnUpdate($sqlUpdate, "clatestBank", $latestBankPath);
  addColumnUpdate($sqlUpdate, "incomeTaxReturn", $incomeTaxReturnPath);
  addColumnUpdate($sqlUpdate, "contractLease", $contractLeasePath);
  addColumnUpdate($sqlUpdate, "ccustomerContact", $customerContactPath);
  addColumnUpdate($sqlUpdate, "csupplierContact", $supplierContactPath);
  addColumnUpdate($sqlUpdate, "cproofBilling", $proofBillingPath);
   // OTHERS
  addColumnUpdate($sqlUpdate, "powerAttorney", $powerAttorneyPath);
  addColumnUpdate($sqlUpdate, "contractSell", $contractSellPath);
  addColumnUpdate($sqlUpdate, "letterGuarantee", $letterGuaranteePath);
  addColumnUpdate($sqlUpdate, "statementAccount", $statementAccountPath);
  addColumnUpdate($sqlUpdate, "billMaterials", $billMaterialsPath);
  addColumnUpdate($sqlUpdate, "proposedPlan", $proposedPlanPath);
  addColumnUpdate($sqlUpdate, "cic", $cicPath);
  addColumnUpdate($sqlUpdate, "nfis", $nfisPath);
  addColumnUpdate($sqlUpdate, "otherDoc", $otherDocPath);
   // DOCUMENTS
  addColumnUpdate($sqlUpdate, "receipt", $receiptPath);
  addColumnUpdate($sqlUpdate, "creditInvestigationReportC", $creditInvestigationReportCPath);
  addColumnUpdate($sqlUpdate, "collateralAppraisalReportC", $collateralAppraisalReportCPath);
  addColumnUpdate($sqlUpdate, "financialEvaluationC", $financialEvaluationCPath);
  addColumnUpdate($sqlUpdate, "signedLetterC", $signedLetterCPath);
  addColumnUpdate($sqlUpdate, "signedLetterUnderEndC", $signedLetterUnderEndCPath);
  addColumnUpdate($sqlUpdate, "signedLoanMemoC", $signedLoanMemoCPath);
  addColumnUpdate($sqlUpdate, "remContractC", $remContractCPath);
  addColumnUpdate($sqlUpdate, "remContractAnnotatedC", $remContractAnnotatedCPath);
  addColumnUpdate($sqlUpdate, "promNoteC", $promNoteCPath);
  addColumnUpdate($sqlUpdate, "disclosureStateC", $disclosureStateCPath);
  addColumnUpdate($sqlUpdate, "mriFormC", $mriFormCPath);
  addColumnUpdate($sqlUpdate, "amortScheduleC", $amortScheduleCPath);
  addColumnUpdate($sqlUpdate, "remContractEndC", $remContractEndCPath);
  addColumnUpdate($sqlUpdate, "promNoteEndC", $promNoteEndCPath);
  addColumnUpdate($sqlUpdate, "disclosureStateEndC", $disclosureStateEndCPath);
  addColumnUpdate($sqlUpdate, "mriFormEndC", $mriFormEndCPath);
  addColumnUpdate($sqlUpdate, "amortScheduleEndC", $amortScheduleEndCPath);
  addColumnUpdate($sqlUpdate, "signedDeedUnderEndC", $signedDeedUnderEndCPath);
  addColumnUpdate($sqlUpdate, "utilization", $utilizationPath);
  addColumnUpdate($sqlUpdate, "powerpoint", $powerpointPath);
  addColumnUpdate($sqlUpdate, "excel", $excelPath);
  // LETTER
  addColumnUpdate($sqlUpdate, "cfLetter", $cfLetterPath);
  addColumnUpdate($sqlUpdate, "csLetter", $csLetterPath);
  addColumnUpdate($sqlUpdate, "ctLetter", $ctLetterPath);
  addColumnUpdate($sqlUpdate, "cfdLetter", $cfdLetterPath);
  // LETTER2
  addColumnUpdate($sqlUpdate, "cfLetter2", $cfLetter2Path);
  addColumnUpdate($sqlUpdate, "csLetter2", $csLetter2Path);
  addColumnUpdate($sqlUpdate, "ctLetter2", $ctLetter2Path);
  addColumnUpdate($sqlUpdate, "cfdLetter2", $cfdLetter2Path);
  // LETTER3
  addColumnUpdate($sqlUpdate, "cfLetter3", $cfLetter3Path);
  addColumnUpdate($sqlUpdate, "csLetter3", $csLetter3Path);
  addColumnUpdate($sqlUpdate, "ctLetter3", $ctLetter3Path);
  addColumnUpdate($sqlUpdate, "cfdLetter3", $cfdLetter3Path);
  // OTHER ATTACHMENT
  addColumnUpdate($sqlUpdate, "cclientReq1", $cclientReq1Path);   
  addColumnUpdate($sqlUpdate, "cclientReq2", $cclientReq2Path);   
  addColumnUpdate($sqlUpdate, "cclientReq3", $cclientReq3Path);   
  // LEGAL   
  addColumnUpdate($sqlUpdate, "cffClosure", $cffClosurepath);
  addColumnUpdate($sqlUpdate, "cpastLitigation", $cpastLitigationPath);
  addColumnUpdate($sqlUpdate, "cpastLitigation2", $cpastLitigation2Path);
  addColumnUpdate($sqlUpdate, "cttLitigation", $cttLitigationPath);
  addColumnUpdate($sqlUpdate, "cPrepConso", $cPrepConsoPath);
  addColumnUpdate($sqlUpdate, "caDemand", $caDemandPath);
  // CHECK
  addColumnUpdate($sqlUpdate, "powerAttorneyICheck", $powerAttorneyIValue);
  addColumnUpdate($sqlUpdate, "contractSellCheck", $contractSellValue);
  addColumnUpdate($sqlUpdate, "letterGuaranteeCheck", $letterGuaranteeValue);
  addColumnUpdate($sqlUpdate, "statementAccountCheck", $statementAccountValue);
  addColumnUpdate($sqlUpdate, "billMaterialsCheck", $billMaterialsValue);
  addColumnUpdate($sqlUpdate, "proposedPlanCheck", $proposedPlanValue);
  addColumnUpdate($sqlUpdate, "otherDocCheck", $otherDocValue);
  addColumnUpdate($sqlUpdate, "cicCheck", $cicValue);
  addColumnUpdate($sqlUpdate, "nfisCheck", $nfisValue);
  addColumnUpdate($sqlUpdate, "cpastCheck", $cpastCheck);
  //   TEXT
  addColumnUpdate($sqlUpdate, "edit1", $edit1);
  



// Status
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
    if ($columnSelect == "2") {
      $valueDescription = $columnSelect . "--" . $description;
      $sqlUpdate .= " `$columnStatus` = '$valueDescription',";
    }
  }
}
// STATUS OF EVERY DATA: VERIFIED/INCOMPLETE
// PRINCIPAL BORROWER
addStatus($sqlUpdate, "endorsementStatus", $endorsementSelect, $endorsementDesc);
addStatus($sqlUpdate, "loanAppFormCStatus", $loanAppFormCSelect, $loanAppFormCDesc);
addStatus($sqlUpdate, "ccompanyProfileStatus", $companyProfileSelect, $companyProfileDesc);
addStatus($sqlUpdate, "governmentIdStatus", $governmentIdSelect, $governmentIdDesc);
addStatus($sqlUpdate, "csecRegistrationStatus", $secRegistrationSelect, $secRegistrationDesc);
addStatus($sqlUpdate, "clatestGISStatus", $latestGISSelect, $latestGISDesc);
addStatus($sqlUpdate, "ccopyBRSStatus", $copyBRSSelect, $copyBRSDesc);
addStatus($sqlUpdate, "ccopyidCSTStatus", $copyidCSTSelect, $copyidCSTDesc);
// COLLATERAL DOCUMENTS
addStatus($sqlUpdate, "ctransferCertTitleStatus", $transferCertTitleSelect, $transferCertTitleDesc);
addStatus($sqlUpdate, "ctaxDeclarationStatus", $taxDeclarationSelect, $taxDeclarationDesc);
addStatus($sqlUpdate, "ctaxDeclartionICTCStatus", $taxDeclartionICTCSelect, $taxDeclartionICTCDesc);
addStatus($sqlUpdate, "crealStateReceiptStatus", $realStateReceiptSelect, $realStateReceiptDesc);
addStatus($sqlUpdate, "crealEstateTaxClearanceStatus", $realEstateTaxClearanceSelect, $realEstateTaxClearanceDesc);
addStatus($sqlUpdate, "ccdOfMorgageStatus", $cdOfMorgageSelect, $cdOfMorgageDesc);
// BUSINESS PROOF OF INCOME
addStatus($sqlUpdate, "ccopyUpdatedBPStatus", $copyUpdatedBPSelect, $copyUpdatedBPDesc);
addStatus($sqlUpdate, "cauditedFinancialStatus", $auditedFinancialSelect, $auditedFinancialDesc);
addStatus($sqlUpdate, "cinhouseFinancialStatus", $inhouseFinancialSelect, $inhouseFinancialDesc);
addStatus($sqlUpdate, "clatestBankStatus", $latestBankSelect, $latestBankDesc);
addStatus($sqlUpdate, "incomeTaxReturnStatus", $incomeTaxReturnSelect, $incomeTaxReturnDesc);
addStatus($sqlUpdate, "contractLeaseStatus", $contractLeaseSelect, $contractLeaseDesc);
addStatus($sqlUpdate, "ccustomerContactStatus", $customerContactSelect, $customerContactDesc);
addStatus($sqlUpdate, "csupplierContactStatus", $supplierContactSelect, $supplierContactDesc);
addStatus($sqlUpdate, "cproofBillingStatus", $proofBillingSelect, $proofBillingDesc);
// OTHERS
addStatus($sqlUpdate, "powerAttorneyStatus", $powerAttorneySelect, $powerAttorneyDesc);
addStatus($sqlUpdate, "contractSellStatus", $contractSellSelect, $contractSellDesc);
addStatus($sqlUpdate, "letterGuaranteeStatus", $letterGuaranteeSelect, $letterGuaranteeDesc);
addStatus($sqlUpdate, "statementAccountStatus", $statementAccountSelect, $statementAccountDesc);
addStatus($sqlUpdate, "billMaterialsStatus", $billMaterialsSelect, $billMaterialsDesc);
addStatus($sqlUpdate, "proposedPlanStatus", $proposedPlanSelect, $proposedPlanDesc);
addStatus($sqlUpdate, "cicStatus", $cicSelect, $cicDesc);
addStatus($sqlUpdate, "nfisStatus", $nfisSelect, $nfisDesc);
addStatus($sqlUpdate, "otherDocStatus", $otherDocSelect, $otherDocDesc);
// DOCUMENTS
addStatus($sqlUpdate, "receiptStatus", $receiptSelect, $receiptDesc);
addStatus($sqlUpdate, "creditInvestigationReportCStatus", $creditInvestigationReportCSelect, $creditInvestigationReportCDesc);
addStatus($sqlUpdate, "collateralAppraisalReportCStatus", $collateralAppraisalReportCSelect, $collateralAppraisalReportCDesc);
addStatus($sqlUpdate, "financialEvaluationCStatus", $financialEvaluationCSelect, $financialEvaluationCDesc);
addStatus($sqlUpdate, "signedLetterCStatus", $signedLetterCSelect, $signedLetterCDesc);
addStatus($sqlUpdate, "signedLetterUnderEndCStatus", $signedLetterUnderEndCSelect, $signedLetterUnderEndCDesc);
addStatus($sqlUpdate, "signedLoanMemoCStatus", $signedLoanMemoCSelect, $signedLoanMemoCDesc);
addStatus($sqlUpdate, "remContractCStatus", $remContractCSelect, $remContractCDesc);
addStatus($sqlUpdate, "remContractAnnotatedCStatus", $remContractAnnotatedCSelect, $remContractAnnotatedCDesc);
addStatus($sqlUpdate, "promNoteCStatus", $promNoteCSelect, $promNoteCDesc);
addStatus($sqlUpdate, "disclosureStateCStatus", $disclosureStateCSelect, $disclosureStateCDesc);
addStatus($sqlUpdate, "mriFormCStatus", $mriFormCSelect, $mriFormCDesc);
addStatus($sqlUpdate, "amortScheduleCStatus", $amortScheduleCSelect, $amortScheduleCDesc);
addStatus($sqlUpdate, "remContractEndCStatus", $remContractEndCSelect, $remContractEndCDesc);
addStatus($sqlUpdate, "promNoteEndCStatus", $promNoteEndCSelect, $promNoteEndCDesc);
addStatus($sqlUpdate, "disclosureStateEndCStatus", $disclosureStateEndCSelect, $disclosureStateEndCDesc);
addStatus($sqlUpdate, "mriFormEndCStatus", $mriFormEndCSelect, $mriFormEndCDesc);
addStatus($sqlUpdate, "amortScheduleEndCStatus", $amortScheduleEndCSelect, $amortScheduleEndCDesc);
addStatus($sqlUpdate, "signedDeedUnderEndCStatus", $signedDeedUnderEndCSelect, $signedDeedUnderEndCDesc);
addStatus($sqlUpdate, "utilizationStatus", $utilizationSelect, $utilizationDesc);
// LETTER
addStatus($sqlUpdate, "cfLetterRemarks", $cfLetterSelect, $cfLetterDesc);
addStatus($sqlUpdate, "csLetterRemarks", $csLetterSelect, $csLetterDesc);
addStatus($sqlUpdate, "ctLetterRemarks", $ctLetterSelect, $ctLetterDesc);
addStatus($sqlUpdate, "cfdLetterRemarks", $cfdLetterSelect, $cfdLetterDesc);
// OTHER ATTACHMENT
addStatus($sqlUpdate, "cclientReqRemarks", $cclientReq1Select, $cclientReq1Desc);
// LEGAL
addStatus($sqlUpdate, "cffClosureRemarks", $cffClosureSelect, $cffClosureDesc);
addStatus($sqlUpdate, "cpastLitigationRemarks", $cpastLitigationSelect, $cpastLitigationDesc);
addStatus($sqlUpdate, "cttLitigationRemarks", $cttLitigationSelect, $cttLitigationDesc);
addStatus($sqlUpdate, "cPrepConsoRemarks", $cPrepConsoSelect, $cPrepConsoDesc);
addStatus($sqlUpdate, "caDemandRemarks", $caDemandSelect, $caDemandDesc);


if (!empty($cdateUpload)) {
    $sqlUpdate .= " `cdateUpload` = '$cdateUpload',";
}
  
  $sqlUpdate = rtrim($sqlUpdate, ","); // Remove the trailing comma
  
  $sqlUpdate .= " WHERE `corpLoanId` = '$corpId'";
  
  $updateQuery = mysqli_query($con, $sqlUpdate);
  // Check if the UPDATE query was successful

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
$loanAppFormCName = "LOAN APPLICATION FORM";
$companyProfileName = "COMPANY PROFILE";
$governmentIdName = "PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED ID OF REPRESENTATIVE OF LOAN WITH 3 SIGNATURES";
$secRegistrationName = "PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS";
$latestGISName = "PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GIS)";
$copyBRSName = "ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE";
$copyidCSTName = "PHOTOCOPY OF 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES";
 // COLLATERAL DOCUMENTS
$transferCertTitleName = "TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY)";
$taxDeclarationName = "TAX DECLARTION (LOT-CERTIFIED TRUE COPY)";
$taxDeclarationICTCName = "TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)";
$realEstateReceiptName = "REAL ESTATE RECEIPT (AMILYAR)";
$realEstateTaxClearanceName = "REAL ESTATE TAX CLEARANCE";
$cancelMortgageName = "CANCELLATION OF MORTGAGE";
// BUSINESS PROOF OF INCOME
$copyUpdatedBPName = "UPDATED BUSINESS PERMIT PERMIT (MAYOR'S, BARANGAY AND/OR DTI)";
$auditedFinancialName = "PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT";
$inhouseFinancialName = "PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT";
$latestBankName = "PHOTOCOPY OF AT LEAST 6 MONTHS OF BUSINESS LATEST BANK STATEMENT";
$incomeTaxReturnName = "INCOME TAX RETURN (IF APPLICABLE)";
$contractLeaseName = "CONTRACT OF LEASE";
$customerContactName = "5 CUSTOMERS WITH CONTACT NUMBER";
$supplierContactName = "5 SUPPLIERS WITH CONTACT NUMBER";
$proofBillingName = "PROOF OF BILLING";
// OTHERS
$powerAttorneyName = "SPECIAL POWER OF ATTORNEY";
$contractSellName = "CONTRACT TO SELL";
$letterGuaranteeName="LETTER OF GUARANTEE";
$statementAccountName = "STATEMENT OF ACCOUNT";
$billMaterialsName = "BILL/COST OF MATERIALS";
$proposedPlanName = "PROPOSED PLAN PERSPECTIVE";
$cicName = "CIC";
$nfisName = "NFIS";
// DOCUMENTS
$receiptName = "APPRAISAL FEE RECEIPT";
$creditInvestigationReportCName = "CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT";
$collateralAppraisalReportCName = "APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT";
$financialEvaluationCName = "FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD";
$signedLetterCName = "SIGNED LETTER OF APPROVAL";
$signedLoanMemoCName = "SIGNED LOAN APPROVAL MEMO";
$remContractCName = "REAL ESTATE MORTGAGE CONTRACT";
$promNoteCName = "PROMISSORY NOTE";
$disclosureStateCName = "DISCLOSURE STATEMENT";
$mriFormCName = "MRI FORM (COUNTRY BANKERS)";
$amortScheduleCName = " AMORTIZATION SCHEDULE";
$remContractAnnotatedCName = "REM CONTRACT ANNOTATED";
$signedLetterUnderEndCName = "SIGNED LETTER OF UNDERTAKING";
$signedDeedUnderEndCName = "SIGNED DEED OF UNDERTAKING";


  

if ($updateQuery==true) {

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
                                            ('$corpId', '$cfLetterPath', '$cfLetter2Path', 
                                            '$cfLetter3Path', '$csLetterPath', '$csLetter2Path',
                                            '$csLetter3Path', '$ctLetterPath', '$ctLetter2Path',
                                            '$ctLetter3Path', '$cfdLetterPath', '$cfdLetter2Path',
                                            '$cfdLetter3Path', 
                                            '$cclientReq1Path', '$cclientReq2Path', '$cclientReq3Path', 
                                            '$cffClosurepath', '$cpastLitigationPath',
                                            '$cpastLitigation2Path', '$cttLitigationPath', '$cPrepConsoPath',
                                            '$caDemandPath', '$dateToday')";
    $queryarchived = mysqli_query($con, $archived);


    // OTHERS MAILING
    // PRINCIPAL BORROWER
    sendMail($data['endorsement'], $endorsementPath, $fullname, "jlcricafrente@ourbank.ph" , $endorsementName);
    sendMail($data['loanAppFormC'], $loanAppFormCPath, $fullname, "irmilano@ourbank.ph" , $loanAppFormCName);
    sendMail($data['ccompanyProfile'], $companyProfilePath, $fullname, "irmilano@ourbank.ph", $companyProfileName);
    sendMail($data['governmentId'], $governmentIdPath, $fullname, "irmilano@ourbank.ph", $governmentIdName);
    sendMail($data['csecRegistration'], $secRegistrationPath, $fullname, "irmilano@ourbank.ph", $secRegistrationName);
    sendMail($data['clatestGIS'], $latestGISPath, $fullname, "irmilano@ourbank.ph", $latestGISName);
    sendMail($data['ccopyBRS'], $copyBRSPath, $fullname, "irmilano@ourbank.ph", $copyBRSName);
    sendMail($data['ccopyidCST'], $copyidCSTPath, $fullname, "irmilano@ourbank.ph", $copyidCSTName);
    // COLLATERAL DOCUMENTS
    sendMail($data['ctransferCertTitle'], $transferCertTitlePath, $fullname, "jlcricafrente@ourbank.ph", $transferCertTitleName);
    sendMail($data['ctaxDeclaration'], $taxDeclarationPath, $fullname, "jlcricafrente@ourbank.ph", $taxDeclarationName);
    sendMail($data['ctaxDeclartionICTC'], $taxDeclartionICTCPath, $fullname, "jlcricafrente@ourbank.ph", $taxDeclarationICTCName);    
    sendMail($data['crealStateReceipt'], $realStateReceiptPath, $fullname, "jlcricafrente@ourbank.ph", $realEstateReceiptName);
    sendMail($data['crealEstateTaxClearance'], $realEstateTaxClearancePath, $fullname, "jlcricafrente@ourbank.ph", $realEstateTaxClearanceName);
    sendMail($data['ccdOfMorgage'], $cdOfMorgagePath, $fullname, "jlcricafrente@ourbank.ph", $cancelMortgageName);
    // BUSINESS PROOF OF INCOME
    sendMail($data['ccopyUpdatedBP'], $copyUpdatedBPPath, $fullname, "irmilano@ourbank.ph", $copyUpdatedBPName);
    sendMail($data['cauditedFinancial'], $auditedFinancialPath, $fullname, "irmilano@ourbank.ph", $auditedFinancialName);
    sendMail($data['cinhouseFinancial'], $inhouseFinancialPath, $fullname, "irmilano@ourbank.ph",$inhouseFinancialName);
    sendMail($data['clatestBank'], $latestBankPath, $fullname, "irmilano@ourbank.ph", $latestBankName);
    sendMail($data['incomeTaxReturn'], $incomeTaxReturnPath, $fullname, "irmilano@ourbank.ph", $incomeTaxReturnName);
    sendMail($data['contractLease'], $contractLeasePath, $fullname, "irmilano@ourbank.ph", $contractLeaseName);
    sendMail($data['ccustomerContact'], $customerContactPath, $fullname, "irmilano@ourbank.ph", $customerContactName);
    sendMail($data['csupplierContact'], $supplierContactPath, $fullname, "irmilano@ourbank.ph", $supplierContactName);
    sendMail($data['cproofBilling'], $proofBillingPath, $fullname, "irmilano@ourbank.ph", $proofBillingName);
    // OTHERS MAILING
    sendMail($data['powerAttorney'], $powerAttorneyPath, $fullname, "jlcricafrente@ourbank.ph",$powerAttorneyName);
    sendMail($data['contractSell'], $contractSellPath, $fullname, "jlcricafrente@ourbank.ph",$contractSellName);
    sendMail($data['letterGuarantee'], $letterGuaranteePath, $fullname, "jlcricafrente@ourbank.ph", $letterGuaranteeName);
    sendMail($data['statementAccount'], $statementAccountPath, $fullname, "jlcricafrente@ourbank.ph",$statementAccountName);
    sendMail($data['billMaterials'], $billMaterialsPath, $fullname, "jlcricafrente@ourbank.ph",$billMaterialsName);
    sendMail($data['proposedPlan'], $proposedPlanPath, $fullname, "jlcricafrente@ourbank.ph",$proposedPlanName);
    sendMail($data['cic'], $cicPath, $fullname, "jlcricafrente@ourbank.ph",$cicName);
    sendMail($data['nfis'], $nfisPath, $fullname, "jlcricafrente@ourbank.ph",$nfisName);
    

    // DOCUMENTS MAILING
    mailReport($data['receipt'], $receiptPath, $fullname, $receiptName);
    sendMail($data['creditInvestigationReportC'], $creditInvestigationReportCPath, $fullname, "irmilano@ourbank.ph", $creditInvestigationReportCName);
    sendMail($data['collateralAppraisalReportC'], $collateralAppraisalReportCPath, $fullname, "irmilano@ourbank.ph", $collateralAppraisalReportCName);
    sendMail($data['financialEvaluationC'], $financialEvaluationCPath, $fullname, "jlcricafrente@ourbank.ph", $financialEvaluationCName);
    sendMail($data['signedLetterC'], $signedLetterCPath, $fullname, "jlcricafrente@ourbank.ph", $signedLetterCName);
    sendMail($data['signedLetterUnderEndC'], $signedLetterUnderEndCPath, $fullname, "jlcricafrente@ourbank.ph", $signedLetterUnderEndCName);
    mailMemo($data['signedLoanMemoC'], $signedLoanMemoCPath, $fullname, $signedLoanMemoCName);
    sendMail($data['remContractC'], $remContractCPath, $fullname, "jlcricafrente@ourbank.ph", $remContractCName);
    sendMail($data['remContractAnnotatedC'], $remContractAnnotatedCPath, $fullname, "jlcricafrente@ourbank.ph", $remContractAnnotatedCName);
    sendMail($data['promNoteC'], $promNoteCPath, $fullname, "jlcricafrente@ourbank.ph", $promNoteCName);
    sendMail($data['disclosureStateC'], $disclosureStateCPath, $fullname, "jlcricafrente@ourbank.ph", $disclosureStateCName);
    sendMail($data['mriFormC'], $mriFormCPath, $fullname, "jlcricafrente@ourbank.ph", $mriFormCName);
    sendMail($data['amortScheduleC'], $amortScheduleCPath, $fullname, "jlcricafrente@ourbank.ph", $amortScheduleCName);
    sendMail($data['remContractEndC'], $remContractEndCPath, $fullname, "jlcricafrente@ourbank.ph", $remContractCName);
    sendMail($data['promNoteEndC'], $promNoteEndCPath, $fullname, "jlcricafrente@ourbank.ph", $promNoteCName);
    sendMail($data['disclosureStateEndC'], $disclosureStateEndCPath, $fullname, "jlcricafrente@ourbank.ph", $disclosureStateCName);
    sendMail($data['mriFormEndC'], $mriFormEndCPath, $fullname, "jlcricafrente@ourbank.ph", $mriFormCName);
    sendMail($data['amortScheduleEndC'], $amortScheduleEndCPath, $fullname, "jlcricafrente@ourbank.ph", $amortScheduleCName);
    sendMail($data['signedDeedUnderEndC'], $signedDeedUnderEndCPath, $fullname, "jlcricafrente@ourbank.ph", $signedDeedUnderEndCName);
    sendMail($data['utilization'], $utilizationPath, $fullname, "jlcricafrente@ourbank.ph", $utilizationName);

    // LETTER MAILING
    letterMail($data['cfLetter'], $cfLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['csLetter'], $csLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ctLetter'], $ctLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cfdLetter'], $cfdLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cfLetter2'], $cfLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['csLetter2'], $csLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ctLetter2'], $ctLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cfdLetter2'], $cfdLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cfLetter3'], $cfLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['csLetter3'], $csLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['ctLetter3'], $ctLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cfdLetter3'], $cfdLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    // 
    letterMail($data['cffClosure'], $cffClosurepath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cpastLitigation'], $cpastLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cpastLitigation2'], $cpastLitigation2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cttLitigation'], $cttLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['cPrepConso'], $cPrepConsoPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    letterMail($data['caDemand'], $caDemandPath, $fullname, "", "josmin.alvarez@ourbank.ph");
    // 
    finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "jonathan.quijano@ourbank.ph");
    // finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "jlcricafrente@ourbank.ph");

    $updateSqlStats = "";

    if ($caDemandPath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 9 WHERE loan_Id = '$corpId'";
    }
    if ($cPrepConsoPath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 8 WHERE loan_Id = '$corpId'";
    }
    if ($cttLitigationPath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$corpId'";
    }
    if ($cpastLitigationPath != '' && $cpastLitigation2Path != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$corpId'";
    }
    if ($cffClosurepath != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$corpId'";
    }
    if ($cfdLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 4, `remarks` = '$cfdLetterSelect' WHERE loan_Id = '$corpId'";
    }
    if ($ctLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 3, `remarks` = '$ctLetterSelect' WHERE loan_Id = '$corpId'";
    }
    if ($csLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 2, `remarks` = '$csLetterSelect' WHERE loan_Id = '$corpId'";
    }
    if ($cfLetterSelect != '') {
        $updateSqlStats = "UPDATE loan SET `letterStatus` = 1, `remarks` = '$cfLetterSelect' WHERE loan_Id = '$corpId'";
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
  function addToLocalFiles(&$localFiles, $variable)
  {
      if (!empty($variable)) {
          $localFiles[] = $variable;
      }
  }
  $localFiles = [];

  // SEND THE DATA TO TARGETED SERVER   
  // PRINCIPAL BORROWER
  addToLocalFiles($localFiles, $endorsementPath);
  addToLocalFiles($localFiles, $loanAppFormCPath);
  addToLocalFiles($localFiles, $companyProfilePath);
  addToLocalFiles($localFiles, $governmentIdPath);
  addToLocalFiles($localFiles, $secRegistrationPath);
  addToLocalFiles($localFiles, $latestGISPath);
  addToLocalFiles($localFiles, $copyBRSPath);
  addToLocalFiles($localFiles, $copyidCSTPath);
  //  COLLATERAL DOCUMENTS 
  addToLocalFiles($localFiles, $transferCertTitlePath);
  addToLocalFiles($localFiles, $taxDeclarationPath);
  addToLocalFiles($localFiles, $taxDeclartionICTCPath);
  addToLocalFiles($localFiles, $realStateReceiptPath);
  addToLocalFiles($localFiles, $realEstateTaxClearancePath);
  addToLocalFiles($localFiles, $cdOfMorgagePath);
  //  BUSINESS PROOF OF INCOME
  addToLocalFiles($localFiles, $copyUpdatedBPPath);
  addToLocalFiles($localFiles, $auditedFinancialPath);
  addToLocalFiles($localFiles, $inhouseFinancialPath);
  addToLocalFiles($localFiles, $latestBankPath);
  addToLocalFiles($localFiles, $incomeTaxReturnPath);
  addToLocalFiles($localFiles, $contractLeasePath);
  addToLocalFiles($localFiles, $customerContactPath);
  addToLocalFiles($localFiles, $supplierContactPath);
  addToLocalFiles($localFiles, $proofBillingPath);
  //  OTHERS 
  addToLocalFiles($localFiles, $powerAttorneyPath);
  addToLocalFiles($localFiles, $contractSellPath);
  addToLocalFiles($localFiles, $letterGuaranteePath);
  addToLocalFiles($localFiles, $statementAccountPath);
  addToLocalFiles($localFiles, $billMaterialsPath);
  addToLocalFiles($localFiles, $proposedPlanPath);
  addToLocalFiles($localFiles, $cicPath);
  addToLocalFiles($localFiles, $nfisPath);
  addToLocalFiles($localFiles, $otherDocPath);
  //  DOCUMENTS
  addToLocalFiles($localFiles, $receiptPath);
  addToLocalFiles($localFiles, $creditInvestigationReportCPath);
  addToLocalFiles($localFiles, $collateralAppraisalReportCPath);
  addToLocalFiles($localFiles, $financialEvaluationCPath);
  addToLocalFiles($localFiles, $signedLetterCPath);
  addToLocalFiles($localFiles, $signedLetterUnderEndCPath);
  addToLocalFiles($localFiles, $signedLoanMemoCPath);
  addToLocalFiles($localFiles, $remContractCPath);
  addToLocalFiles($localFiles, $remContractAnnotatedCPath);
  addToLocalFiles($localFiles, $promNoteCPath);
  addToLocalFiles($localFiles, $disclosureStateCPath);
  addToLocalFiles($localFiles, $mriFormCPath);
  addToLocalFiles($localFiles, $amortScheduleCPath);
  addToLocalFiles($localFiles, $remContractEndCPath);
  addToLocalFiles($localFiles, $promNoteEndCPath);
  addToLocalFiles($localFiles, $disclosureStateEndCPath);
  addToLocalFiles($localFiles, $mriFormEndCPath);
  addToLocalFiles($localFiles, $amortScheduleEndCPath);
  addToLocalFiles($localFiles, $signedDeedUnderEndCPath);
  addToLocalFiles($localFiles, $utilizationPath);
  addToLocalFiles($localFiles, $powerpointPath);
  addToLocalFiles($localFiles, $excelPath);
  // LETTER
  addToLocalFiles($localFiles, $cfLetterPath);
  addToLocalFiles($localFiles, $csLetterPath);
  addToLocalFiles($localFiles, $ctLetterPath);
  addToLocalFiles($localFiles, $cfdLetterPath);
  // LETTER2
  addToLocalFiles($localFiles, $cfLetter2Path);
  addToLocalFiles($localFiles, $csLetter2Path);
  addToLocalFiles($localFiles, $ctLetter2Path);
  addToLocalFiles($localFiles, $cfdLetter2Path);   
  // LETTER3
  addToLocalFiles($localFiles, $cfLetter3Path);
  addToLocalFiles($localFiles, $csLetter3Path);
  addToLocalFiles($localFiles, $ctLetter3Path);
  addToLocalFiles($localFiles, $cfdLetter3Path);  
  // OTHER ATTACHMENT
  addToLocalFiles($localFiles, $cclientReq1Path);
  addToLocalFiles($localFiles, $cclientReq2Path);
  addToLocalFiles($localFiles, $cclientReq3Path);
  // LEGAL
  addToLocalFiles($localFiles, $cffClosurepath);
  addToLocalFiles($localFiles, $cpastLitigationPath);
  addToLocalFiles($localFiles, $cpastLitigation2Path);
  addToLocalFiles($localFiles, $cttLitigationPath);
  addToLocalFiles($localFiles, $cPrepConsoPath);
  addToLocalFiles($localFiles, $caDemandPath);
  
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
  echo "CONNECTED <br>";

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

    echo"Error". mysqli_error($con);

}


} 
else {
  // Data does not exist, perform an INSERT query
  if($_SESSION['username'] == 'jlcvalero' || $_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'majluna' || $_SESSION['username'] == 'jdiokno'){
    $insertSql = "INSERT INTO corporation (`corpLoanId`, 
                                      `cfLetter`, `cfLetter2`, `cfLetter3`, 
                                      `csLetter`, `csLetter2`, `csLetter3`, 
                                      `ctLetter`, `ctLetter2`, `ctLetter3`, 
                                      `cfdLetter`, `cfdLetter2`, `cfdLetter3`, 
                                      `cclientReq1`, `cclientReq2`, `cclientReq3`,
                                      `cffClosure`, `cpastLitigation`, `cpastLitigation2`, 
                                      `cttLitigation`, `cPrepConso`, 
                                      `caDemand`, `cdateUpload`) 
                            VALUES 
                                    ('$corpId', 
                                    '$cfLetterPath', '$cfLetter2Path', '$cfLetter3Path', 
                                    '$csLetterPath', '$csLetter2Path', '$csLetter3Path', 
                                    '$ctLetterPath', '$ctLetter2Path', '$ctLetter3Path', 
                                    '$cfdLetterPath', '$cfdLetter2Path', '$cfdLetter3Path', 
                                    '$cclientReq1Path', '$cclientReq2Path', '$cclientReq3Path', 
                                    '$cffClosurepath', '$cpastLitigationPath', '$cpastLitigation2Path',
                                    '$cttLitigationPath', '$cPrepConsoPath', 
                                    '$caDemandPath', '$dateToday')";
  }else{
    $insertSql = "INSERT INTO corporation (`corpLoanId`,`endorsement`, `loanAppFormC`,`ccompanyProfile`, `governmentId`, `csecRegistration`, `clatestGIS`, 
                                            `ccopyBRS`, `ccopyidCST`, `ccopyUpdatedBP`, `ctransferCertTitle`, `ctaxDeclaration`, `ctaxDeclartionICTC`, 
                                            `crealStateReceipt`, `crealEstateTaxClearance`, `ccdOfMorgage`, `cauditedFinancial`, `cinhouseFinancial`, 
                                            `clatestBank`,`incomeTaxReturn`,`contractLease`, `ccustomerContact`, `csupplierContact`, `cproofBilling`, 
                                            `powerAttorney`, `contractSell`, `statementAccount`, `cdateUpload`, 
                                            `powerAttorneyICheck`, `contractSellCheck`, `statementAccountCheck`, `billMaterialsCheck`, `proposedPlanCheck`,
                                            `cicCheck`, `nfisCheck`, `cic`, `nfis`
                                        ) 
                                    VALUES ('$corpId','$endorsementPath', '$loanAppFormCPath','$companyProfilePath', '$governmentIdPath', '$secRegistrationPath', '$latestGISPath', 
                                            '$copyBRSPath', '$copyidCSTPath', '$copyUpdatedBPPath', '$transferCertTitlePath', '$taxDeclarationPath', '$taxDeclartionICTCPath', 
                                            '$crealStateReceiptPath', '$crealEstateTaxClearancePath', '$cdOfMorgagePath', '$auditedFinancialPath', '$inhouseFinancialPath', 
                                            '$clatestBankPath','$incomeTaxReturnPath','$contractLeasePath', '$customerContactPath','$supplierContactPath', '$cproofBillingPath', 
                                            '$powerAttorneyPath', '$contractSellPath', '$statementAccountPath', '$dateToday',
                                            '$powerAttorneyIValue', '$contractSellValue', '$statementAccountValue', '$billMaterialsValue', '$proposedPlanValue',
                                            '$cicValue', '$nfisValue', '$cicPath', '$nfisPath'
                                        )";
  }
    $insertQuery = mysqli_query($con, $insertSql);
    $queryQ = mysqli_query($con, $sqlQ);
    $username = $_SESSION["username"];

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
                                                ('$corpId', '$cfLetterPath', '$cfLetter2Path', 
                                                '$cfLetter3Path', '$csLetterPath', '$csLetter2Path',
                                                '$csLetter3Path', '$ctLetterPath', '$ctLetter2Path',
                                                '$ctLetter3Path', '$cfdLetterPath', '$cfdLetter2Path',
                                                '$cfdLetter3Path', 
                                                '$cclientReq1Path', '$cclientReq2Path', '$cclientReq3Path',
                                                '$cffClosurepath', '$cpastLitigationPath',
                                                '$cpastLitigation2Path', '$cttLitigationPath', '$cPrepConsoPath',
                                                '$caDemandPath', '$dateToday')";
        $queryarchived = mysqli_query($con, $archived);

    //     // PRINCIPAL BORROWER
    sendMail($data['endorsement'], $endorsementPath, $fullname, "jlcricafrente@ourbank.ph" , $endorsementName);
    sendMail($data['loanAppFormC'], $loanAppFormCPath, $fullname, "irmilano@ourbank.ph" , $loanAppFormCName);
    sendMail($data['ccompanyProfile'], $companyProfilePath, $fullname, "irmilano@ourbank.ph", $companyProfileName);
    sendMail($data['governmentId'], $governmentIdPath, $fullname, "irmilano@ourbank.ph", $governmentIdName);
    sendMail($data['csecRegistration'], $secRegistrationPath, $fullname, "irmilano@ourbank.ph", $secRegistrationName);
    sendMail($data['clatestGIS'], $latestGISPath, $fullname, "irmilano@ourbank.ph", $latestGISName);
    sendMail($data['ccopyBRS'], $copyBRSPath, $fullname, "irmilano@ourbank.ph", $copyBRSName);
    sendMail($data['ccopyidCST'], $copyidCSTPath, $fullname, "irmilano@ourbank.ph", $copyidCSTName);
    // COLLATERAL DOCUMENTS
    sendMail($data['ctransferCertTitle'], $transferCertTitlePath, $fullname, "jlcricafrente@ourbank.ph", $transferCertTitleName);
    sendMail($data['ctaxDeclaration'], $taxDeclarationPath, $fullname, "jlcricafrente@ourbank.ph", $taxDeclarationName);
    sendMail($data['ctaxDeclartionICTC'], $taxDeclartionICTCPath, $fullname, "jlcricafrente@ourbank.ph", $taxDeclarationICTCName);    
    sendMail($data['crealStateReceipt'], $realStateReceiptPath, $fullname, "jlcricafrente@ourbank.ph", $realEstateReceiptName);
    sendMail($data['crealEstateTaxClearance'], $realEstateTaxClearancePath, $fullname, "jlcricafrente@ourbank.ph", $realEstateTaxClearanceName);
    sendMail($data['ccdOfMorgage'], $cdOfMorgagePath, $fullname, "jlcricafrente@ourbank.ph", $cancelMortgageName);
    // BUSINESS PROOF OF INCOME
    sendMail($data['ccopyUpdatedBP'], $copyUpdatedBPPath, $fullname, "irmilano@ourbank.ph", $copyUpdatedBPName);
    sendMail($data['cauditedFinancial'], $auditedFinancialPath, $fullname, "irmilano@ourbank.ph", $auditedFinancialName);
    sendMail($data['cinhouseFinancial'], $inhouseFinancialPath, $fullname, "irmilano@ourbank.ph",$inhouseFinancialName);
    sendMail($data['clatestBank'], $latestBankPath, $fullname, "irmilano@ourbank.ph", $latestBankName);
    sendMail($data['incomeTaxReturn'], $incomeTaxReturnPath, $fullname, "irmilano@ourbank.ph", $incomeTaxReturnName);
    sendMail($data['contractLease'], $contractLeasePath, $fullname, "irmilano@ourbank.ph", $contractLeaseName);
    sendMail($data['ccustomerContact'], $customerContactPath, $fullname, "irmilano@ourbank.ph", $customerContactName);
    sendMail($data['csupplierContact'], $supplierContactPath, $fullname, "irmilano@ourbank.ph", $supplierContactName);
    sendMail($data['cproofBilling'], $proofBillingPath, $fullname, "irmilano@ourbank.ph", $proofBillingName);
    // OTHERS MAILING
    sendMail($data['powerAttorney'], $powerAttorneyPath, $fullname, "jlcricafrente@ourbank.ph",$powerAttorneyName);
    sendMail($data['contractSell'], $contractSellPath, $fullname, "jlcricafrente@ourbank.ph",$contractSellName);
    sendMail($data['letterGuarantee'], $letterGuaranteePath, $fullname, "jlcricafrente@ourbank.ph", $letterGuaranteeName);
    sendMail($data['statementAccount'], $statementAccountPath, $fullname, "jlcricafrente@ourbank.ph",$statementAccountName);
    sendMail($data['billMaterials'], $billMaterialsPath, $fullname, "jlcricafrente@ourbank.ph",$billMaterialsName);
    sendMail($data['proposedPlan'], $proposedPlanPath, $fullname, "jlcricafrente@ourbank.ph",$proposedPlanName);
    sendMail($data['cic'], $cicPath, $fullname, "jlcricafrente@ourbank.ph",$cicName);
    sendMail($data['nfis'], $nfisPath, $fullname, "jlcricafrente@ourbank.ph",$nfisName);

    // DOCUMENTS MAILING
    mailReport($data['receipt'], $receiptPath, $fullname, $receiptName);
    sendMail($data['creditInvestigationReportC'], $creditInvestigationReportCPath, $fullname, "irmilano@ourbank.ph", $creditInvestigationReportCName);
    sendMail($data['collateralAppraisalReportC'], $collateralAppraisalReportCPath, $fullname, "irmilano@ourbank.ph", $collateralAppraisalReportCName);
    sendMail($data['financialEvaluationC'], $financialEvaluationCPath, $fullname, "jlcricafrente@ourbank.ph", $financialEvaluationCName);
    sendMail($data['signedLetterC'], $signedLetterCPath, $fullname, "jlcricafrente@ourbank.ph", $signedLetterCName);
    sendMail($data['signedLetterUnderEndC'], $signedLetterUnderEndCPath, $fullname, "jlcricafrente@ourbank.ph", $signedLetterUnderEndCName);
    mailMemo($data['signedLoanMemoC'], $signedLoanMemoCPath, $fullname, $signedLoanMemoCName);
    sendMail($data['remContractC'], $remContractCPath, $fullname, "jlcricafrente@ourbank.ph", $remContractCName);
    sendMail($data['remContractAnnotatedC'], $remContractAnnotatedCPath, $fullname, "jlcricafrente@ourbank.ph", $remContractAnnotatedCName);
    sendMail($data['promNoteC'], $promNoteCPath, $fullname, "jlcricafrente@ourbank.ph", $promNoteCName);
    sendMail($data['disclosureStateC'], $disclosureStateCPath, $fullname, "jlcricafrente@ourbank.ph", $disclosureStateCName);
    sendMail($data['mriFormC'], $mriFormCPath, $fullname, "jlcricafrente@ourbank.ph", $mriFormCName);
    sendMail($data['amortScheduleC'], $amortScheduleCPath, $fullname, "jlcricafrente@ourbank.ph", $amortScheduleCName);
    sendMail($data['remContractEndC'], $remContractEndCPath, $fullname, "jlcricafrente@ourbank.ph", $remContractCName);
    sendMail($data['promNoteEndC'], $promNoteEndCPath, $fullname, "jlcricafrente@ourbank.ph", $promNoteCName);
    sendMail($data['disclosureStateEndC'], $disclosureStateEndCPath, $fullname, "jlcricafrente@ourbank.ph", $disclosureStateCName);
    sendMail($data['mriFormEndC'], $mriFormEndCPath, $fullname, "jlcricafrente@ourbank.ph", $mriFormCName);
    sendMail($data['amortScheduleEndC'], $amortScheduleEndCPath, $fullname, "jlcricafrente@ourbank.ph", $amortScheduleCName);
    sendMail($data['signedDeedUnderEndC'], $signedDeedUnderEndCPath, $fullname, "jlcricafrente@ourbank.ph", $signedDeedUnderEndCName);
    sendMail($data['utilization'], $utilizationPath, $fullname, "jlcricafrente@ourbank.ph", $utilizationName);

        // LETTER MAILING
        letterMail($data['cfLetter'], $cfLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['csLetter'], $csLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['ctLetter'], $ctLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cfdLetter'], $cfdLetterPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cfLetter2'], $cfLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['csLetter2'], $csLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['ctLetter2'], $ctLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cfdLetter2'], $cfdLetter2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cfLetter3'], $cfLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['csLetter3'], $csLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['ctLetter3'], $ctLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cfdLetter3'], $cfdLetter3Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        // 
        letterMail($data['cffClosure'], $cffClosurepath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cpastLitigation'], $cpastLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cpastLitigation2'], $cpastLitigation2Path, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cttLitigation'], $cttLitigationPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['cPrepConso'], $cPrepConsoPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        letterMail($data['caDemand'], $caDemandPath, $fullname, "", "josmin.alvarez@ourbank.ph");
        // 
        finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "jonathan.quijano@ourbank.ph");
        // finalDemand($data['ifdLetter'], $ifdLetterPath, $fullname, "jlcricafrente@ourbank.ph");

        $updateSqlStats = "";

        if ($caDemandPath != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 9 WHERE loan_Id = '$corpId'";
        }
        if ($cPrepConsoPath != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 8 WHERE loan_Id = '$corpId'";
        }
        if ($cttLitigationPath != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$corpId'";
        }
        if ($cpastLitigationPath != '' && $cpastLitigation2Path != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$corpId'";
        }
        if ($cffClosurepath != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$corpId'";
        }
        if ($cfdLetterSelect != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 4, `remarks` = '$cfdLetterSelect' WHERE loan_Id = '$corpId'";
        }
        if ($ctLetterSelect != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 3, `remarks` = '$ctLetterSelect' WHERE loan_Id = '$corpId'";
        }
        if ($csLetterSelect != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 2, `remarks` = '$csLetterSelect' WHERE loan_Id = '$corpId'";
        }
        if ($cfLetterSelect != '') {
            $updateSqlStats = "UPDATE loan SET `letterStatus` = 1, `remarks` = '$cfLetterSelect' WHERE loan_Id = '$corpId'";
        }
        
        // Execute the query only if $updateSqlStats is set
        if (!empty($updateSqlStats)) {
            $updateQueryStats = mysqli_query($con, $updateSqlStats);
        } else {
        }
          


      $ftpServer = '10.10.10.117';
      $ftpUsername ="ourbank-tech";
      $ftpPassword = "Juliuspogi2023";
    
      // LOCAL FILE PATHS
      $localFiles = [];

  // SEND THE DATA TO TARGETED SERVER   
  // PRINCIPAL BORROWER
  addToLocalFiles($localFiles, $loanAppFormCPath);
  addToLocalFiles($localFiles, $companyProfilePath);
  addToLocalFiles($localFiles, $governmentIdPath);
  addToLocalFiles($localFiles, $secRegistrationPath);
  addToLocalFiles($localFiles, $latestGISPath);
  addToLocalFiles($localFiles, $copyBRSPath);
  addToLocalFiles($localFiles, $copyidCSTPath);
  //  COLLATERAL DOCUMENTS 
  addToLocalFiles($localFiles, $transferCertTitlePath);
  addToLocalFiles($localFiles, $taxDeclarationPath);
  addToLocalFiles($localFiles, $taxDeclartionICTCPath);
  addToLocalFiles($localFiles, $realStateReceiptPath);
  addToLocalFiles($localFiles, $realEstateTaxClearancePath);
  addToLocalFiles($localFiles, $cdOfMorgagePath);
  //  BUSINESS PROOF OF INCOME
  addToLocalFiles($localFiles, $copyUpdatedBPPath);
  addToLocalFiles($localFiles, $auditedFinancialPath);
  addToLocalFiles($localFiles, $inhouseFinancialPath);
  addToLocalFiles($localFiles, $latestBankPath);
  addToLocalFiles($localFiles, $incomeTaxReturnPath);
  addToLocalFiles($localFiles, $contractLeasePath);
  addToLocalFiles($localFiles, $customerContactPath);
  addToLocalFiles($localFiles, $supplierContactPath);
  addToLocalFiles($localFiles, $proofBillingPath);
  //  OTHERS 
  addToLocalFiles($localFiles, $powerAttorneyPath);
  addToLocalFiles($localFiles, $contractSellPath);
  addToLocalFiles($localFiles, $statementAccountPath);
  addToLocalFiles($localFiles, $billMaterialsPath);
  addToLocalFiles($localFiles, $proposedPlanPath);
  addToLocalFiles($localFiles, $cicPath);
  addToLocalFiles($localFiles, $nfisPath);
  //  DOCUMENTS
  addToLocalFiles($localFiles, $creditInvestigationReportCPath);
  addToLocalFiles($localFiles, $collateralAppraisalReportCPath);
  addToLocalFiles($localFiles, $financialEvaluationCPath);
  addToLocalFiles($localFiles, $signedLetterCPath);
  addToLocalFiles($localFiles, $signedLetterUnderEndCPath);
  addToLocalFiles($localFiles, $signedLoanMemoCPath);
  addToLocalFiles($localFiles, $remContractCPath);
  addToLocalFiles($localFiles, $remContractAnnotatedCPath);
  addToLocalFiles($localFiles, $promNoteCPath);
  addToLocalFiles($localFiles, $disclosureStateCPath);
  addToLocalFiles($localFiles, $mriFormCPath);
  addToLocalFiles($localFiles, $amortScheduleCPath);
  addToLocalFiles($localFiles, $remContractEndCPath);
  addToLocalFiles($localFiles, $promNoteEndCPath);
  addToLocalFiles($localFiles, $disclosureStateEndCPath);
  addToLocalFiles($localFiles, $mriFormEndCPath);
  addToLocalFiles($localFiles, $amortScheduleEndCPath);
  addToLocalFiles($localFiles, $signedDeedUnderEndCPath);
  addToLocalFiles($localFiles, $utilizationPath);
  addToLocalFiles($localFiles, $powerpointPath);
  addToLocalFiles($localFiles, $excelPath);
  // OTHER ATTACHMENT   
  addToLocalFiles($localFiles, $cclientReq1Path);
  addToLocalFiles($localFiles, $cclientReq2Path);
  addToLocalFiles($localFiles, $cclientReq3Path);
      
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
      
    }else {
        echo "Error". mysqli_error($con); 
}

}
?>
