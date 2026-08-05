<?php

include('connection.php');
include('fileuploadloan.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('connection.php');
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y \a\t g:i A');
$microId =  $_POST['microId'];
$fullname=$_POST['fullname'];
$salaryType=$_POST['salaryType'];
$branch=$_POST['branch'];
$edit1 = $_POST['edit1'];
$productID =$_POST['productID'];
$businessPictureValue = isset($_POST['businessPictureCheck']) ? "Check" : "Uncheck";
$cicValue = isset($_POST['cicCheck']) ? "Check" : "Uncheck";
$nfisValue = isset($_POST['nfisCheck']) ? "Check" : "Uncheck";
$otherSuportValue = isset($_POST['otherSuportCheck']) ? "Check" : "Uncheck";
$renewValue = isset($_POST['renewalCheck']) ? "Check" : "Uncheck";

$mpastCheck = isset($_POST['mpastCheck']) ? "Yes" : "No";

// BORROWER SELECT
$loanAppFormMSelect = $_POST['loanAppFormMSelect'];
$borrowerValidSelect = $_POST['borrowerValidSelect'];
$latestPermitSelect = $_POST['latestPermitSelect'];
$latestProofSelect = $_POST['latestProofSelect'];
// CO-BORROWER SELECT
$coborrowerStatementSelect = $_POST['coborrowerStatementSelect'];
$coborrowerIdSelect = $_POST['coborrowerIdSelect'];
$proofIncomeSelect = $_POST['proofIncomeSelect'];
// CO-MAKER SELECT
$comakerStatementSelect = $_POST['comakerStatementSelect'];
$coMaker_IdSignSelect = $_POST['comakerValidSelect'];
$coMaker_LbpSelect = $_POST['comakerPermitSelect'];
$coMaker_PayslipSelect = $_POST['comakerPayslipSelect'];
// RENEWAL SELECT
$businessValidationSelect = $_POST['businessValidationSelect'];
$loanInstallmentSelect = $_POST['loanInstallmentSelect'];
$loanPaymentSelect = $_POST['loanPaymentSelect'];
$statementAccountSelect = $_POST['statementAccountSelect'];
// OTHERS
$businessPictureSelect = $_POST['businessPictureSelect'];
$cicSelect = $_POST['cicSelect'];
$nfisSelect = $_POST['nfisSelect'];
$otherSuportSelect = $_POST['otherSuportSelect'];
// DOCUMENTS SELECT
$validCardReportSelect = $_POST['validCardReportSelect'];
$creditReportSelect = $_POST['creditReportSelect'];
$creditInvestigationReportMSelect = $_POST['creditInvestigationReportMSelect'];
$debitWaiverSelect = $_POST['debitWaiverSelect'];
$affidavitSurrenderSelect = $_POST['affidavitSurrenderSelect'];
$riskRatingSelect = $_POST['riskRatingSelect'];
$loanApprovalSheetSelect = $_POST['loanApprovalSheetSelect'];
// AFTER RELEASE
$promissoryNoteMSelect = $_POST['promissoryNoteMSelect'];
$disclosureStateMSelect = $_POST['disclosureStateMSelect'];
$mriFormSelect = $_POST['mriFormSelect'];
$amortScheduleMSelect = $_POST['amortScheduleMSelect'];
$utilizationSelect = $_POST['utilizationSelect'];

// LETTER
$mfLetter = $_POST['mfLetter'];
$msLetter = $_POST['msLetter'];
$mtLetter = $_POST['mtLetter'];
$mfdLetter = $_POST['mfdLetter'];
//  LETTER2
$mfLetter2 = $_POST['mfLetter2'];
$msLetter2 = $_POST['msLetter2'];
$mtLetter2 = $_POST['mtLetter2'];
$mfdLetter2 = $_POST['mfdLetter2'];
//  LETTER3
$mfLetter3 = $_POST['mfLetter3'];
$msLetter3 = $_POST['msLetter3'];
$mtLetter3 = $_POST['mtLetter3'];
$mfdLetter3 = $_POST['mfdLetter3'];
// OTHER ATTACHMENT
$mclientReq1 = $_POST['mclientReq1'];
$mclientReq2 = $_POST['mclientReq2'];
$mclientReq3 = $_POST['mclientReq3'];

$mclientReq1Select = $_POST['mclientReq1Select'];
// LETTER SELECT
$mfLetterSelect = $_POST['mfLetterSelect'];
$msLetterSelect = $_POST['msLetterSelect'];
$mtLetterSelect = $_POST['mtLetterSelect'];
$mfdLetterSelect = $_POST['mfdLetterSelect'];
// LEGAL SELECT
$mffClosureSelect = $_POST['mffClosureSelect'];
$mpastLitigationSelect = $_POST['mpastLitigationSelect'];
$mttLitigationSelect = $_POST['mttLitigationSelect'];
$mPrepConsoSelect = $_POST['mPrepConsoSelect'];
$maDemandSelect = $_POST['maDemandSelect'];

// DESCRIPTIONS
// BORROWER
$loanAppFormMDesc= $_POST['loanAppFormMDesc'];
$borrower_IdsignatureDesc= $_POST['borrower_IdsignatureDesc'];
$borrower_LbpDesc= $_POST['borrower_LbpDesc'];
$borrower_LpbDesc= $_POST['borrower_LpbDesc'];
// CO BORROWER
$coborrowerStatementDesc= $_POST['coborrowerStatementDesc'];
$coBorrowerIdSignDesc= $_POST['coBorrowerIdSignDesc'];
$proofIncomeDesc= $_POST['proofIncomeDesc'];
// CO MAKER
$comakerStatementDesc= $_POST['comakerStatementDesc'];
$coMakerIdWithSignDesc= $_POST['coMakerIdWithSignDesc'];
$latestPermitvDesc= $_POST['latestPermitvDesc'];
$coMakerPayslipDesc= $_POST['coMakerPayslipDesc'];
// RENEWAL
$businessValidationDesc= $_POST['businessValidationDesc'];
$loanInstallmentDesc= $_POST['loanInstallmentDesc'];
$loanPaymentDesc= $_POST['loanPaymentDesc'];
$statementAccountDesc= $_POST['statementAccountDesc'];
// OTHERS
$businessPictureDesc = $_POST['businessPictureDesc'];
$cicDesc = $_POST['cicDesc'];
$nfisDesc = $_POST['nfisDesc'];
$otherSuportDesc= $_POST['otherSuportDesc'];
// DOCUMENTS
$validCardReportDesc= $_POST['validCardReportDesc'];
$creditReportDesc= $_POST['creditReportDesc'];
$creditInvestigationReportMDesc= $_POST['creditInvestigationReportMDesc'];
$debitWaiverDesc= $_POST['debitWaiverDesc'];
$affidavitSurrenderDesc= $_POST['affidavitSurrenderDesc'];
$riskRatingDesc= $_POST['riskRatingDesc'];
$loanApprovalSheetDesc= $_POST['loanApprovalSheetDesc'];
$promissoryNoteMDesc= $_POST['promissoryNoteMDesc'];
$disclosureStateMDesc= $_POST['disclosureStateMDesc'];
$mriFormDesc= $_POST['mriFormDesc'];
$amortScheduleMDesc= $_POST['amortScheduleMDesc'];
$utilizationDesc= $_POST['utilizationDesc'];
// // LETTER DESC
// $mfLetterDesc = $_POST['mfLetterDesc'];
// $msLetterDesc = $_POST['msLetterDesc'];
// $mtLetterDesc = $_POST['mtLetterDesc'];
// $mfdLetterDesc = $_POST['sfdLetterDesc'];
// // LEGAL
// $mffClosureDesc = $_POST['mffClosureDesc'];
// $mttLitigationDesc = $_POST['mttLitigationDesc'];
// $maDemandDesc = $_POST['maDemandDesc'];

function archiveFile($fileKey, $dbField, $microLoanId, $archiveField, $dateToday, $endPrompt, $con) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        // error_log("In archiveFile - End Prompt: " . $endPrompt);
        
        // Fetch the existing file data from the `individual` table
        $selectQuery = "SELECT `$dbField` FROM `microfinance` WHERE `mLoan_Id` = '$microLoanId'";
        $selectResult = mysqli_query($con, $selectQuery);
        
        if ($row = mysqli_fetch_array($selectResult)) {
            $fileData = $row[$dbField];
            
            // Insert the previous data into the `indivarchive` table
            if($endPrompt != ''){
                $insertQuery = "INSERT INTO `microarchive` (`a_mLoan_Id`, `$archiveField`, `a_mdateUploaded`, `am_remarks`)
                                                    VALUES 
                                                            ('$microLoanId', '$fileData', '$dateToday', '$endPrompt')";
                
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
    // BORROWER
    if (isset($_FILES['loanAppFormM'])) {
        archiveFile('loanAppFormM', 'loanAppFormM', $microId, 'a_loanAppFormM', $dateToday, $endPrompt, $con);
    }
    if (isset($_FILES['borrower_Idsignature'])) {
        archiveFile('borrower_Idsignature', 'mborrower_IdSign', $microId, 'a_mborrower_IdSign', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['borrower_Lbp'])){
        archiveFile('borrower_Lbp', 'mborrower_Lbp', $microId, 'a_mborrower_Lbp', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['borrower_Lpb'])){
        archiveFile('borrower_Lpb', 'mborrower_Lpb', $microId, 'a_mborrower_Lpb', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coborrowerStatement'])){
        archiveFile('coborrowerStatement', 'coborrowerStatement', $microId, 'a_coborrowerStatement', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coBorrowerIdSign'])){
        archiveFile('coBorrowerIdSign', 'mcoBorrower_Id', $microId, 'a_mcoBorrower_Id', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['proofIncome'])){
        archiveFile('proofIncome', 'proofIncome', $microId, 'a_proofIncome', $dateToday, $endPrompt, $con);
    }
    
    // // COLLATERAL DOCUMENTS
    if(isset($_FILES['comakerStatement'])){
        archiveFile('comakerStatement', 'comakerStatement', $microId, 'a_comakerStatement', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coMakerIdWithSign'])){
        archiveFile('coMakerIdWithSign', 'mcoMaker_IdSign', $microId, 'a_mcoMaker_IdSign', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['latestPermit'])){
        archiveFile('latestPermit', 'mcoMaker_Lbp', $microId, 'a_mcoMaker_Lbp', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coMakerPayslip'])){
        archiveFile('coMakerPayslip', 'mcoMaker_Payslip', $microId, 'a_mcoMaker_Payslip', $dateToday, $endPrompt, $con);
    }

    // For Renewal
    if(isset($_FILES['businessValidation'])){
        archiveFile('businessValidation', 'businessValidation', $microId, 'a_businessValidation', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['loanInstallment'])){
        archiveFile('loanInstallment', 'loanInstallment', $microId, 'a_loanInstallment', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['loanPayment'])){
        archiveFile('loanPayment', 'loanPayment', $microId, 'a_loanPayment', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['statementAccount'])){
        archiveFile('statementAccount', 'statementAccount', $microId, 'a_statementAccount', $dateToday, $endPrompt, $con);
    }

    // Docs Reports
    if(isset($_FILES['validCardReport'])){
        archiveFile('validCardReport', 'validCardReport', $microId, 'a_validCardReport', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['creditReport'])){
        archiveFile('creditReport', 'creditReport', $microId, 'a_creditReport', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['creditInvestigationReportM'])){
        archiveFile('creditInvestigationReportM', 'creditInvestigationReportM', $microId, 'a_creditInvestigationReportM', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['debitWaiver'])){
        archiveFile('debitWaiver', 'debitWaiver', $microId, 'a_debitWaiver', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['affidavitSurrender'])){
        archiveFile('affidavitSurrender', 'affidavitSurrender', $microId, 'a_affidavitSurrender', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['loanApprovalSheet'])){
        archiveFile('loanApprovalSheet', 'loanApprovalSheet', $microId, 'a_loanApprovalSheet', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['riskRating'])){
        archiveFile('riskRating', 'riskRating', $microId, 'a_riskRating', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['promissoryNoteM'])){
        archiveFile('promissoryNoteM', 'promissoryNoteM', $microId, 'a_promissoryNoteM', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['disclosureStateM'])){
        archiveFile('disclosureStateM', 'disclosureStateM', $microId, 'a_disclosureStateM', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mriForm'])){
        archiveFile('mriForm', 'mriForm', $microId, 'a_mriForm', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['amortScheduleM'])){
        archiveFile('amortScheduleM', 'amortScheduleM', $microId, 'a_amortScheduleM', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['utilization'])){
        archiveFile('utilization', 'utilization', $microId, 'a_utilization', $dateToday, $endPrompt, $con);
    }

    // OTHER DOCS
    if(isset($_FILES['businessPicture'])){
        archiveFile('businessPicture', 'businessPicture', $microId, 'a_businessPicture', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cic'])){
        archiveFile('cic', 'cic', $microId, 'a_cic', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['nfis'])){
        archiveFile('nfis', 'nfis', $microId, 'a_nfis', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['otherSuport'])){
        archiveFile('otherSuport', 'otherSuport', $microId, 'a_otherSuport', $dateToday, $endPrompt, $con);
    }

    // dueCollection
    // mfLetter
    if(isset($_FILES['mfLetter'])){
        archiveFile('mfLetter', 'mfLetter', $microId, 'a_mfLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mfLetter2'])){
        archiveFile('mfLetter2', 'mfLetter2', $microId, 'a_mfLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mfLetter3'])){
        archiveFile('mfLetter3', 'mfLetter3', $microId, 'a_mfLetter3', $dateToday, $endPrompt, $con);
    }
    // msLetter
    if(isset($_FILES['msLetter'])){
        archiveFile('msLetter', 'msLetter', $microId, 'a_msLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['msLetter2'])){
        archiveFile('msLetter2', 'msLetter2', $microId, 'a_msLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['msLetter3'])){
        archiveFile('msLetter3', 'msLetter3', $microId, 'a_msLetter3', $dateToday, $endPrompt, $con);
    }
    // mtLetter
    if(isset($_FILES['mtLetter'])){
        archiveFile('mtLetter', 'mtLetter', $microId, 'a_mtLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mtLetter2'])){
        archiveFile('mtLetter2', 'mtLetter2', $microId, 'a_mtLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mtLetter3'])){
        archiveFile('mtLetter3', 'mtLetter3', $microId, 'a_mtLetter3', $dateToday, $endPrompt, $con);
    }
    // mfdLetter
    if(isset($_FILES['mfdLetter'])){
        archiveFile('mfdLetter', 'mfdLetter', $microId, 'a_mfdLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mfdLetter2'])){
        archiveFile('mfdLetter2', 'mfdLetter2', $microId, 'a_mfdLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mfdLetter3'])){
        archiveFile('mfdLetter3', 'mfdLetter3', $microId, 'a_mfdLetter3', $dateToday, $endPrompt, $con);
    }

    // other attachment
    if(isset($_FILES['mclientReq1'])){
        archiveFile('mclientReq1', 'mclientReq1', $microId, 'a_mclientReq1', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mclientReq2'])){
        archiveFile('mclientReq2', 'mclientReq2', $microId, 'a_mclientReq2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mclientReq3'])){
        archiveFile('mclientReq3', 'mclientReq3', $microId, 'a_mclientReq3', $dateToday, $endPrompt, $con);
    }

    // legal
    if(isset($_FILES['mffClosure'])){
        archiveFile('mffClosure', 'mffClosure', $microId, 'a_mffClosure', $dateToday, $endPrompt, $con);
    }

    // past due litigation
    if(isset($_FILES['mpastLitigation'])){
        archiveFile('mpastLitigation', 'mpastDueLitigation', $microId, 'a_mpastDueLitigation', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mpastLitigation2'])){
        archiveFile('mpastLitigation2', 'mpastDueLitigation2', $microId, 'a_mpastDueLitigation2', $dateToday, $endPrompt, $con);
    }

    // tramsfer to ROPA
    if(isset($_FILES['mttLitigation'])){
        archiveFile('mttLitigation', 'mtransferLitigation', $microId, 'a_mtransferLitigation', $dateToday, $endPrompt, $con);
    }

    // preparation of consolidation
    if(isset($_FILES['mPrepConso'])){
        archiveFile('mPrepConso', 'mPrepConso', $microId, 'a_mPrepConso', $dateToday, $endPrompt, $con);
    }

    // due and demandable
    if(isset($_FILES['maDemand'])){
        archiveFile('maDemand', 'maDemand', $microId, 'a_maDemand', $dateToday, $endPrompt, $con);
    }
    // end
}


// BORROWER
$loanAppFormFile = upload_file($_FILES['loanAppFormM'], 'microfinance', $microId);
$borrower_IdsignatureFile = upload_file($_FILES['borrower_Idsignature'], 'microfinance', $microId);
$borrower_LbpFile = upload_file($_FILES['borrower_Lbp'], 'microfinance', $microId);
$borrower_LpbFile = upload_file($_FILES['borrower_Lpb'], 'microfinance', $microId);
// CO-BORROWER
$coborrowerStatementFile = upload_file($_FILES['coborrowerStatement'], 'microfinance', $microId);
$coBorrowerIdSignFile = upload_file($_FILES['coBorrowerIdSign'], 'microfinance', $microId);
$proofIncomeFile = upload_file($_FILES['proofIncome'], 'microfinance', $microId);
// CO-MAKER
$comakerStatementFile = upload_file($_FILES['comakerStatement'], 'microfinance', $microId);
$coMakerIdWithSignFile = upload_file($_FILES['coMakerIdWithSign'], 'microfinance', $microId);
$coMakerLatestBpFile = upload_file($_FILES['latestPermit'], 'microfinance', $microId);
$coMakerPayslipFile = upload_file($_FILES['coMakerPayslip'], 'microfinance', $microId);
// RENEWAL
$businessValidationFile = upload_file($_FILES['businessValidation'], 'microfinance', $microId);
$loanInstallmentFile = upload_file($_FILES['loanInstallment'], 'microfinance', $microId);
$loanPaymentFile = upload_file($_FILES['loanPayment'], 'microfinance', $microId);
$statementAccountFile = upload_file($_FILES['statementAccount'], 'microfinance', $microId);
// OTHERS
$businessPictureFile = upload_file($_FILES['businessPicture'], 'microfinance', $microId);
$cicFile = upload_file($_FILES['cic'], 'microfinance', $microId);
$nfisFile = upload_file($_FILES['nfis'], 'microfinance', $microId);
$otherSuportFile = upload_file($_FILES['otherSuport'], 'microfinance', $microId);
// DOCUMENTS
$validCardReportFile = upload_file($_FILES['validCardReport'], 'microfinance', $microId);
$creditReportFile = upload_file($_FILES['creditReport'], 'microfinance', $microId);
$creditInvestigationReportMFile = upload_file($_FILES['creditInvestigationReportM'], 'microfinance', $microId);
$debitWaiverFile = upload_file($_FILES['debitWaiver'], 'microfinance', $microId);
$affidavitSurrenderFile = upload_file($_FILES['affidavitSurrender'], 'microfinance', $microId);
$riskRatingFile = upload_file($_FILES['riskRating'], 'microfinance', $microId);
$loanApprovalSheetFile = upload_file($_FILES['loanApprovalSheet'], 'microfinance', $microId);
// AFTER RELEASE
$promissoryNoteMFile = upload_file($_FILES['promissoryNoteM'], 'microfinance', $microId);
$disclosureStateMFile = upload_file($_FILES['disclosureStateM'], 'microfinance', $microId);
$mriFormFile = upload_file($_FILES['mriForm'], 'microfinance', $microId);
$amortScheduleMFile = upload_file($_FILES['amortScheduleM'], 'microfinance', $microId);
$utilizationFile = upload_file($_FILES['utilization'], 'microfinance', $microId);
// LETTER
$mfLetterFile = upload_file($_FILES['mfLetter'], 'microfinance', $mLoanId);
$msLetterFile = upload_file($_FILES['msLetter'], 'microfinance', $mLoanId);
$mtLetterFile = upload_file($_FILES['mtLetter'], 'microfinance', $mLoanId);
$mfdLetterFile = upload_file($_FILES['mfdLetter'], 'microfinance', $mLoanId);
// LETTER2
$mfLetter2File= upload_file($_FILES['mfLetter2'], 'microfinance', $mLoanId);
$msLetter2File= upload_file($_FILES['msLetter2'], 'microfinance',$mLoanId);
$mtLetter2File= upload_file($_FILES['mtLetter2'], 'microfinance',$mLoanId);
$mfdLetter2File= upload_file($_FILES['mfdLetter2'], 'microfinance',$mLoanId);
// LETTER3
$mfLetter3File= upload_file($_FILES['mfLetter3'], 'microfinance',$mLoanId);
$msLetter3File= upload_file($_FILES['msLetter3'], 'microfinance',$mLoanId);
$mtLetter3File= upload_file($_FILES['mtLetter3'], 'microfinance',$mLoanId);
$mfdLetter3File= upload_file($_FILES['mfdLetter3'], 'microfinance',$mLoanId);

// OTHER ATTACHMENT
$mclientReq1File = upload_file($_FILES['mclientReq1'], 'microfinance', $mLoanId);
$mclientReq2File = upload_file($_FILES['mclientReq2'], 'microfinance', $mLoanId);
$mclientReq3File = upload_file($_FILES['mclientReq3'], 'microfinance', $mLoanId);

// LEGAL
$mffClosureFile = upload_file($_FILES['mffClosure'], 'microfinance', $mLoanId);
$mpastLitigationFile = upload_file($_FILES['mpastLitigation'], 'microfinance', $mLoanId);
$mpastLitigation2File = upload_file($_FILES['mpastLitigation2'], 'microfinance', $mLoanId);
$mttLitigationFile = upload_file($_FILES['mttLitigation'], 'microfinance', $mLoanId);
$mPrepConsoFile = upload_file($_FILES['mPrepConso'], 'microfinance', $mLoanId);
$maDemandFile = upload_file($_FILES['maDemand'], 'microfinance', $mLoanId);

  /* Borrower Path */
  $mloanAppFormM = $loanAppFormFile['path'];
  $mborrower_IdSign = $borrower_IdsignatureFile['path'];
  $mborrower_Lbp = $borrower_LbpFile['path'];
  $mborrower_Lpb = $borrower_LpbFile['path'];
  /* Co-Borrower Path */
  $mcoborrowerStatement = $coborrowerStatementFile['path'];
  $mcoBorrowerIdSign = $coBorrowerIdSignFile['path'];
  $mproofIncome = $proofIncomeFile['path'];
  /* Co-Maker Path */
  $mcomakerStatement = $comakerStatementFile['path'];
  $mcoMaker_IdSign = $coMakerIdWithSignFile['path'];
  $mcoMakerLatestBp = $coMakerLatestBpFile['path'];
  $mcoMaker_Payslip = $coMakerPayslipFile['path'];
   /* RENEWAL Path */
  $mbusinessValidation = $businessValidationFile['path'];
  $mloanInstallment = $loanInstallmentFile['path'];
  $mloanPayment = $loanPaymentFile['path'];
  $mstatementAccount = $statementAccountFile['path'];
  // OTHERS
  $businessPicturePath = $businessPictureFile['path'];
  $cicPath = $cicFile['path'];
  $nfisPath = $nfisFile['path'];
  $otherSuportPath = $otherSuportFile['path'];
  // DOCUMENTS
  $mvalidCardReport = $validCardReportFile['path'];
  $mcreditReport = $creditReportFile['path'];
  $mcreditInvestigationReportM = $creditInvestigationReportMFile['path'];
  $mdebitWaiver = $debitWaiverFile['path'];
  $maffidavitSurrender = $affidavitSurrenderFile['path'];
  $mriskRating = $riskRatingFile['path'];
  $mloanApprovalSheet = $loanApprovalSheetFile['path'];
  // AFTER RELEASE
  $mpromissoryNoteM = $promissoryNoteMFile['path'];
  $mdisclosureStateM = $disclosureStateMFile['path'];
  $mmriForm = $mriFormFile['path'];
  $mamortScheduleM = $amortScheduleMFile['path'];
  $mutilization = $utilizationFile['path'];
    // LETTER
    $mfLetterPath = $mfLetterFile['path'];
    $msLetterPath = $msLetterFile['path'];
    $mtLetterPath = $mtLetterFile['path'];
    $mfdLetterPath = $mfdLetterFile['path'];
    // LETTER2
    $mfLetter2Path = $mfLetter2File['path'];
    $msLetter2Path = $msLetter2File['path'];
    $mtLetter2Path = $mtLetter2File['path'];
    $mfdLetter2Path = $mfdLetter2File['path'];
    // LETTER3
    $mfLetter3Path = $mfLetter3File['path'];
    $msLetter3Path = $msLetter3File['path'];
    $mtLetter3Path = $mtLetter3File['path'];
    $mfdLetter3Path = $mfdLetter3File['path'];
    // OTHER ATTACHMENT
    $mclientReq1Path = $mclientReq1File['path'];
    $mclientReq2Path = $mclientReq2File['path'];
    $mclientReq3Path = $mclientReq3File['path'];
    // LEGAL
    $mffClosurePath = $mffClosureFile['path'];
    $mpastLitigationPath = $mpastLitigationFile['path'];
    $mpastLitigation2Path = $mpastLitigation2File['path'];
    $mttLitigationPath = $mttLitigationFile['path'];
    $mPrepConsoPath = $mPrepConsoFile['path'];
    $maDemandPath = $maDemandFile['path'];

  // FUNCTION FOR EMAIL
  function sendMail($data, $path, $name, $email, $email3, $email4, $email5, $documents){
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
        $mail->addAddress($email);
        // $mail->addAddress($email2);
        $mail->addAddress($email3);
        $mail->addAddress($email4);
        $mail->addAddress($email5);
        $mail->Subject = "[ MICROFINANCE ] " ."$name";
        $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                        <br><br>Customer/Client: <b>' . $name . ' </b>
                        <br><br>DOCUMENTS UPLOADED: <b>' . $documents .'</b>
                        ';
        $mail->send();
    }
  }

  $sqlSelect = "SELECT * FROM microfinance WHERE mLoan_Id = '$microId'";
  $selectQuery = mysqli_query($con, $sqlSelect);
  $data = mysqli_fetch_assoc($selectQuery);

  
  if ($data) {
    // if(!empty($productID)){
    //     #comment this out if error exist 12-20-2023
    //     $productsUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$microId'";
    //     $productsQuery = mysqli_query($con, $productsUpdate);
    //     if(!$productsQuery){
    //         echo 'ERROR update'. mysqli_error($con);
    //     }else{
    //         echo 'Product ID Update Successfully';
    //     }
    // }else{
    //     echo "Product ID is empty";
    // }

    // Data already exists, perform an UPDATE query
    function addColumnUpdate(&$microUpdate, $columnName, $columnValue) {
      if (!empty($columnValue)) {
        $microUpdate .= " `$columnName` = '$columnValue',";
      }
    }
    


    $microUpdate = "UPDATE microfinance SET";
    // BORROWER
    addColumnUpdate($microUpdate, "loanAppFormM", $mloanAppFormM);
    addColumnUpdate($microUpdate, "mborrower_IdSign", $mborrower_IdSign);
    addColumnUpdate($microUpdate, "mborrower_Lbp", $mborrower_Lbp);
    addColumnUpdate($microUpdate, "mborrower_Lpb", $mborrower_Lpb);
    // CO-BORROWER
    addColumnUpdate($microUpdate, "coborrowerStatement", $mcoborrowerStatement);
    addColumnUpdate($microUpdate, "mcoBorrower_Id", $mcoBorrowerIdSign);
    addColumnUpdate($microUpdate, "proofIncome", $mproofIncome);
    // CO-MAKER
    addColumnUpdate($microUpdate, "comakerStatement", $mcomakerStatement);
    addColumnUpdate($microUpdate, "mcoMaker_IdSign", $mcoMaker_IdSign);
    addColumnUpdate($microUpdate, "mcoMaker_Lbp", $mcoMakerLatestBp);
    addColumnUpdate($microUpdate, "mcoMaker_Payslip", $mcoMaker_Payslip);
    // RENEWAL
    addColumnUpdate($microUpdate, "businessValidation", $mbusinessValidation);
    addColumnUpdate($microUpdate, "loanInstallment", $mloanInstallment);
    addColumnUpdate($microUpdate, "loanPayment", $mloanPayment);
    addColumnUpdate($microUpdate, "statementAccount", $mstatementAccount);
    // DOCUMENTS
    addColumnUpdate($microUpdate, "validCardReport", $mvalidCardReport);
    addColumnUpdate($microUpdate, "creditReport", $mcreditReport);
    addColumnUpdate($microUpdate, "creditInvestigationReportM", $mcreditInvestigationReportM);
    addColumnUpdate($microUpdate, "debitWaiver", $mdebitWaiver);
    addColumnUpdate($microUpdate, "affidavitSurrender", $maffidavitSurrender);
    addColumnUpdate($microUpdate, "riskRating", $mriskRating);
    addColumnUpdate($microUpdate, "loanApprovalSheet", $mloanApprovalSheet);
    // AFTER RELEASE
    addColumnUpdate($microUpdate, "promissoryNoteM", $mpromissoryNoteM);
    addColumnUpdate($microUpdate, "disclosureStateM", $mdisclosureStateM);
    addColumnUpdate($microUpdate, "mriForm", $mmriForm);
    addColumnUpdate($microUpdate, "amortScheduleM", $mamortScheduleM);
    addColumnUpdate($microUpdate, "utilization", $mutilization);
    // LETTER
    addColumnUpdate($microUpdate, "mfLetter", $mfLetterPath);
    addColumnUpdate($microUpdate, "msLetter", $msLetterPath);
    addColumnUpdate($microUpdate, "mtLetter", $mtLetterPath);
    addColumnUpdate($microUpdate, "mfdLetter", $mfdLetterPath);
    // LETTER2
    addColumnUpdate($microUpdate, "mfLetter2", $mfLetter2Path);
    addColumnUpdate($microUpdate, "msLetter2", $msLetter2Path);
    addColumnUpdate($microUpdate, "mtLetter2", $mtLetter2Path);
    addColumnUpdate($microUpdate, "mfdLetter2", $mfdLetter2Path);
    // LETTER3
    addColumnUpdate($microUpdate, "mfLetter3", $mfLetter3Path);
    addColumnUpdate($microUpdate, "msLetter3", $msLetter3Path);
    addColumnUpdate($microUpdate, "mtLetter3", $mtLetter3Path);
    addColumnUpdate($microUpdate, "mfdLetter3", $mfdLetter3Path);
    // OTHER ATTACHMENT
    addColumnUpdate($microUpdate, "mclientReq1", $mclientReq1Path);
    addColumnUpdate($microUpdate, "mclientReq2", $mclientReq2Path);
    addColumnUpdate($microUpdate, "mclientReq3", $mclientReq3Path);
    // LEGAL  
    addColumnUpdate($microUpdate, "mffClosure", $mffClosurePath);
    addColumnUpdate($microUpdate, "mpastDueLitigation", $mpastLitigationPath);
    addColumnUpdate($microUpdate, "mpastDueLitigation2", $mpastLitigation2Path);
    addColumnUpdate($microUpdate, "mtransferLitigation", $mttLitigationPath);
    addColumnUpdate($microUpdate, "mPrepConso", $mPrepConsoPath);
    addColumnUpdate($microUpdate, "maDemand", $maDemandPath);
    addColumnUpdate($microUpdate, "mpastCheck", $mpastCheck);
    // OTHERS
    addColumnUpdate($microUpdate, "businessPicture", $businessPicturePath);
    addColumnUpdate($microUpdate, "cic", $cicPath);
    addColumnUpdate($microUpdate, "nfis", $nfisPath);
    addColumnUpdate($microUpdate, "otherSuport", $otherSuportPath);

    addColumnUpdate($microUpdate, "businessPictureCheck", $businessPictureValue);
    addColumnUpdate($microUpdate, "cicCheck", $cicValue);
    addColumnUpdate($microUpdate, "nfisCheck", columnValue: $nfisValue);
    addColumnUpdate($microUpdate, "otherSuportCheck", $otherSuportValue);
    addColumnUpdate($microUpdate, "renewalCheck", $renewValue);
    addColumnUpdate($microUpdate, "edit1", $edit1);
    
    $productUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$microId'";

    $productQuery = mysqli_query($con, $productUpdate);
    if($productQuery==true){
      echo"productID is working";
    }else{
      echo "not working productID". mysqli_error($con);
    }

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
 
// BORRROWER
addStatus($microUpdate, "loanAppFormMStatus", $loanAppFormMSelect, $loanAppFormMDesc);
addStatus($microUpdate, "mborrower_IdSignStatus", $borrowerValidSelect, $borrower_IdsignatureDesc);
addStatus($microUpdate, "mborrower_LbpStatus", $latestPermitSelect, $borrower_LbpDesc);
addStatus($microUpdate, "mborrower_LpbStatus", $latestProofSelect, $borrower_LpbDesc);
// CO-BORROWER
addStatus($microUpdate, "coborrowerStatementStatus", $coborrowerStatementSelect, $coborrowerStatementDesc);
addStatus($microUpdate, "mcoBorrower_IdSignStatus", $coborrowerIdSelect, $coBorrowerIdSignDesc);
addStatus($microUpdate, "proofIncomeStatus", $proofIncomeSelect, $proofIncomeDesc);
// CO-MAKER
addStatus($microUpdate, "comakerStatementStatus", $comakerStatementSelect, $comakerStatementDesc);
addStatus($microUpdate, "mcoMaker_IdSignStatus", $coMaker_IdSignSelect, $coMakerIdWithSignDesc);
addStatus($microUpdate, "mcoMaker_LbpStatus", $coMaker_LbpSelect, $latestPermitvDesc);
addStatus($microUpdate, "mcoMaker_PayslipStatus", $coMaker_PayslipSelect, $coMakerPayslipDesc);
// CO-MAKER
addStatus($microUpdate, "businessValidationStatus", $businessValidationSelect, $businessValidationDesc);
addStatus($microUpdate, "loanInstallmentStatus", $loanInstallmentSelect, $loanInstallmentDesc);
addStatus($microUpdate, "loanPaymentStatus", $loanPaymentSelect, $loanPaymentDesc);
addStatus($microUpdate, "statementAccountStatus", $statementAccountSelect, $statementAccountDesc);
// OTHERS
addStatus($microUpdate, "businessPictureStatus", $businessPictureSelect, $businessPictureDesc);
addStatus($microUpdate, "cicStatus", $cicSelect, $cicDesc);
addStatus($microUpdate, "nfisStatus", $nfisSelect, $nfisDesc);
addStatus($microUpdate, "otherSuportStatus", $otherSuportSelect, $otherSuportDesc);
// DOCUMENTS
addStatus($microUpdate, "validCardReportStatus", $validCardReportSelect, $validCardReportDesc);
addStatus($microUpdate, "creditReportStatus", $creditReportSelect, $creditReportDesc);
addStatus($microUpdate, "creditInvestigationReportMStatus", $creditInvestigationReportMSelect, $creditInvestigationReportMDesc);
addStatus($microUpdate, "debitWaiverStatus", $debitWaiverSelect, $debitWaiverDesc);
addStatus($microUpdate, "affidavitSurrenderStatus", $affidavitSurrenderSelect, $affidavitSurrenderDesc);
addStatus($microUpdate, "riskRatingStatus", $riskRatingSelect, $riskRatingDesc);
addStatus($microUpdate, "loanApprovalSheetStatus", $loanApprovalSheetSelect, $loanApprovalSheetDesc);
// AFTER RELEASE
addStatus($microUpdate, "promissoryNoteMStatus", $promissoryNoteMSelect, $promissoryNoteMDesc);
addStatus($microUpdate, "disclosureStateMStatus", $disclosureStateMSelect, $disclosureStateMDesc);
addStatus($microUpdate, "mriFormStatus", $mriFormSelect, $mriFormDesc);
addStatus($microUpdate, "amortScheduleMStatus", $amortScheduleMSelect, $amortScheduleMDesc);
addStatus($microUpdate, "utilizationStatus", $utilizationSelect, $utilizationDesc);
// LETTER
addStatus($microUpdate, "mfLetterRemarks", $mfLetterSelect, "");
addStatus($microUpdate, "msLetterRemarks", $msLetterSelect, "");
addStatus($microUpdate, "mtLetterRemarks", $mtLetterSelect, "");
addStatus($microUpdate, "mfdLetterRemarks", $mfdLetterSelect, "");
// OTHER ATTACHMENT
addStatus($microUpdate, "mclientReqRemarks", $mclientReq1Select, "");
// LEGAL
addStatus($microUpdate, "sffClosureRemarks", $sffClosureSelect, "");
addStatus($microUpdate, "mpastLitigationRemarks", $mpastLitigationSelect, "");
addStatus($microUpdate, "sttLitigationRemarks", $sttLitigationSelect, "");
addStatus($microUpdate, "mPrepConsoRemarks", $mPrepConsoSelect, "");
addStatus($microUpdate, "saDemandRemarks", $saDemandSelect, "");
 

  if (!empty($dateToday)) {
  $microUpdate .= " `mdateUploaded` = '$dateToday',";
  }
  
  $microUpdate = rtrim($microUpdate, ",");
  
  $microUpdate .= " WHERE `mLoan_Id` = '$microId'";
  
  $updateQuery = mysqli_query($con, $microUpdate);
  $dataUpdate = mysqli_insert_id($con);

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
    default:
        $address = "UNKNOWN/"; // Default value if $branch does not match any case
        break;
}  

switch ($branch) {
    case "Head Office":
        $emails = "apreyes@ourbank.ph";
        // $email = "ctborgonia@ourbank.ph";
        break;
    case "Magallanes":
        $emails = "joan.reduca@ourbank.ph";
        break;
    case "Ternate":
        $emails = "melvin.tabanan@ourbank.ph";
        break;
    case "Maragondon":
        $emails = "melody.ruazol@ourbank.ph";
        break;
    case "Manggahan":
        $emails = "jennifer.giron@ourbank.ph";
        break;
    case "Noveleta":
        $emails = "karen.dianne.dampitan@ourbank.ph";
        break;
    case "Poblacion":
        $emails = "jacklyn.sarique@ourbank.ph";
        break;
    default:
        $emails = "UNKNOWN/"; // Default value if $branch does not match any case
        break;
}  


  


    // Check if the UPDATE query is true
    if($updateQuery==true) {
    
    // BORROWER
    sendMail($data['loanAppFormM'], $mloanAppFormM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanAppFormName);
    sendMail($data['mborrower_IdSign'], $mborrower_IdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_IdsignatureName);
    sendMail($data['mborrower_Lbp'], $mborrower_Lbp, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_LbpName);
    sendMail($data['mborrower_Lpb'], $mborrower_Lpb, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_LpbName);
     // CO BORROWER
    sendMail($data['coborrowerStatement'], $mcoborrowerStatement, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coborrowerStatementName);
    sendMail($data['mcoBorrower_Id'], $mcoBorrowerIdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coBorrowerIdSignName);
    sendMail($data['proofIncome'], $mproofIncome, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $proofIncomeName);
     // CO MAKER
    sendMail($data['comakerStatement'], $mcomakerStatement, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $comakerStatementName);
    sendMail($data['mcoMaker_IdSign'], $mcoMaker_IdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coMakerIdWithSignName);
    sendMail($data['mcoMaker_Lbp'], $mcoMakerLatestBp, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $latestPermitName);
    sendMail($data['mcoMaker_Payslip'], $mcoMaker_Payslip, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coMakerPayslipName);
     // RENEWAL
    sendMail($data['businessValidation'], $mbusinessValidation, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessValidationName);
    sendMail($data['loanInstallment'], $mloanInstallment, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanInstallmentName);
    sendMail($data['loanPayment'], $mloanPayment, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanPaymentName);
    sendMail($data['statementAccount'], $mstatementAccount, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $statementAccountName);
    // OTHERS
    sendMail($data['businessPicture'], $businessPicturePath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessPictureName);
    sendMail($data['cic'], $cicPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $cicName);
    sendMail($data['nfis'], $nfisPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $nfisName);
    // sendMail($data['otherSuport'], $otherSuportPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $otherSuportName);
    // DOCUMENTS
    sendMail($data['validCardReport'], $mvalidCardReport, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $validCardReportName);
    sendMail($data['creditReport'], $mcreditReport, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditReportName);
    sendMail($data['creditInvestigationReportM'], $mcreditInvestigationReportM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditInvestigationReportMName);
    // sendMail($data['debitWaiver'], $mdebitWaiver, $fullname, "ctborgonia@ourbank.ph", $debitWaiverName);
    sendMail($data['affidavitSurrender'], $maffidavitSurrender, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $affidavitSurrenderName);
    sendMail($data['riskRating'], $mriskRating, $fullname, $emails,  'cdcruz@ourbank.ph', 'cdcruz@ourbank.ph', '', $riskRatingName);
    sendMail($data['loanApprovalSheet'], $mloanApprovalSheet, $fullname, $emails,  'jlcricafrente@ourbank.ph', 'cdcruz@ourbank.ph', '', $loanApprovalSheetName);
    // AFTER RELEASE
    sendMail($data['promissoryNoteM'], $mpromissoryNoteM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $promissoryNoteMName);
    sendMail($data['disclosureStateM'], $mdisclosureStateM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $disclosureStateMName);
    sendMail($data['mriForm'], $mmriForm, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $insuranceName);
    sendMail($data['amortScheduleM'], $mamortScheduleM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $amortScheduleMName);
    sendMail($data['utilization'], $mutilization, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $utlizationName);

        $archived = "INSERT INTO letterarchive (`loanIds`, `firstLetter`, `firstLetter2`, 
                                                `firstLetter3`, `secondLetter`, `secondLetter2`, 
                                                `secondLetter3`, `thirdLetter`, `thirdLetter2`, 
                                                `thirdLetter3`, `finalLetter`, `finalLetter2`, 
                                                `finalLetter3`, 
                                                `clientRequest1`, `clientRequest2`, `clientRequest3`,
                                                `foreClosure`, `pastDueLitigation`, 
                                                `pastDueLitigation2`, `transferLitigation`, `PrepConsol`, 
                                                `dueDemandable`, `todaysDate`)
                                            VALUES      
                                                ('$microId', '$mfLetterPath', '$mfLetter2Path', 
                                                '$mfLetter3Path', '$msLetterPath', '$msLetter2Path',
                                                '$msLetter3Path', '$mtLetterPath', '$mtLetter2Path',
                                                '$mtLetter3Path', '$mfdLetterPath', '$mfdLetter2Path,
                                                '$mfdLetter3Path', 
                                                '$mclientReq1Path', '$mclientReq2Path', '$mclientReq3Path',
                                                '$mffClosurePath', '$mpastLitigationPath',
                                                '$mpastLitigation2Path', '$mttLitigationPath', '$mPrepConsoPath',
                                                '$maDemandPath', '$dateToday')";
        $queryarchived = mysqli_query($con, $archived);

        $loanAppFormName="LOAN APPLICATION FORM.";
        $borrower_IdsignatureName="2 COPIES OF 2 VALID ID WITH 3 SIGNATURES.";
        $borrower_LbpName="LATEST BUSINESS PERMIT.";
        $borrower_LpbName="LATEST PROOF OF BILLING (MERALCO).";
        // CO BORROWER
        $coborrowerStatementName="CO-BORROWER STATEMENT. ";
        $coBorrowerIdSignName="1 COPY OF 2 VALID ID WITH 3 SIGNATURES.";
        $proofIncomeName="PROOF OF INCOME (IF APPLICABLE).";
        // CO MAKER
        $comakerStatementName="CO-MAKER STATEMENT.";
        $coMakerIdWithSignName="1 COPY OF 2 VALID ID WITH 3 SIGNATURES.";
        $latestPermitName="LATEST BUSINESS PERMIT.";
        $coMakerPayslipName="3 MONTHS OF PAYSLIP.";
        // RENEWAL
        $businessValidationName="BUSINESS VALIDATION";
        $loanInstallmentName ="LOAN INSTALLMENT SCHEDULE PREVIOUS LOAN";
        $loanPaymentName="LOAN PAYMENT REPORT";
        $statementAccountName="STATEMENT OF ACCOUNT/BANK STATEMENT";
        // OTHERS
        $businessPictureName="BUSINESS PICTURE";
        $cicName = "CIC";
        $nfisName = "NFIS";
        $otherSuportName="OTHER SUPPORTING DOCUMENTS";
        // DOCUMENTS
        $validCardReportName="CLIENT'S VISITATION CARD REPORT.";
        $creditReportName="CREDIT INVESTIGATION REPORT.";
        $creditInvestigationReportMName="CREDIT INFORMATION AND BACKGROUND INVESTIGATION REPORT.";
        $debitWaiverName="AUTHORITY TO DEBIT AND WAIVER.";
        $affidavitSurrenderName="AFFIDAVIT OF VOLUNTARY SURRENDER.";
        $riskRatingName="BORROWER'S RISK RATING (BRR)/CASHFLOW.";
        $loanApprovalSheetName="LOAN APPROVAL SHEET.";
        // AFTER RELEASE
        $promissoryNoteMName="PROMISSORY NOTE.";
        $disclosureStateMName="DISCLOSURE STATEMENT";
        $amortScheduleMName="AMORTIZATION SCHEDULE.";
        $insuranceName="INSURANCE";
        $utlizationName="LOAN UTILIZATION";

    // // BORROWER
    sendMail($data['loanAppFormM'], $mloanAppFormM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanAppFormName);
    sendMail($data['mborrower_IdSign'], $mborrower_IdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_IdsignatureName);
    sendMail($data['mborrower_Lbp'], $mborrower_Lbp, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_LbpName);
    sendMail($data['mborrower_Lpb'], $mborrower_Lpb, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_LpbName);
     // CO BORROWER
    sendMail($data['coborrowerStatement'], $mcoborrowerStatement, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coborrowerStatementName);
    sendMail($data['mcoBorrower_Id'], $mcoBorrowerIdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coBorrowerIdSignName);
    sendMail($data['proofIncome'], $mproofIncome, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $proofIncomeName);
     // CO MAKER
    sendMail($data['comakerStatement'], $mcomakerStatement, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $comakerStatementName);
    sendMail($data['mcoMaker_IdSign'], $mcoMaker_IdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coMakerIdWithSignName);
    sendMail($data['mcoMaker_Lbp'], $mcoMakerLatestBp, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $latestPermitName);
    sendMail($data['mcoMaker_Payslip'], $mcoMaker_Payslip, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coMakerPayslipName);
     // RENEWAL
    sendMail($data['businessValidation'], $mbusinessValidation, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessValidationName);
    sendMail($data['loanInstallment'], $mloanInstallment, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanInstallmentName);
    sendMail($data['loanPayment'], $mloanPayment, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanPaymentName);
    sendMail($data['statementAccount'], $mstatementAccount, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $statementAccountName);
    // OTHERS
    sendMail($data['businessPicture'], $businessPicturePath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessPictureName);
    sendMail($data['cic'], $cicPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $cicName);
    sendMail($data['nfis'], $nfisPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $nfisName);
    // sendMail($data['otherSuport'], $otherSuportPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $otherSuportName);
    // DOCUMENTS
    sendMail($data['validCardReport'], $mvalidCardReport, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $validCardReportName);
    sendMail($data['creditReport'], $mcreditReport, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditReportName);
    sendMail($data['creditInvestigationReportM'], $mcreditInvestigationReportM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditInvestigationReportMName);
    // sendMail($data['debitWaiver'], $mdebitWaiver, $fullname, "ctborgonia@ourbank.ph", $debitWaiverName);
    sendMail($data['affidavitSurrender'], $maffidavitSurrender, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $affidavitSurrenderName);
    sendMail($data['riskRating'], $mriskRating, $fullname, $emails,  'jlcricafrente@ourbank.ph', 'cdcruz@ourbank.ph', '', $riskRatingName);
    sendMail($data['loanApprovalSheet'], $mloanApprovalSheet, $fullname, $emails,  'jlcricafrente@ourbank.ph', 'cdcruz@ourbank.ph', '', $loanApprovalSheetName);
    // AFTER RELEASE
    sendMail($data['promissoryNoteM'], $mpromissoryNoteM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $promissoryNoteMName);
    sendMail($data['disclosureStateM'], $mdisclosureStateM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $disclosureStateMName);
    sendMail($data['mriForm'], $mmriForm, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $insuranceName);
    sendMail($data['amortScheduleM'], $mamortScheduleM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $amortScheduleMName);
    sendMail($data['utilization'], $mutilization, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $utlizationName);
    

      if($data['maDemand'] != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$microId'";
      }
      else if($data['mttLitigation'] != ''){
          $updateSqlStats = " UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$microId'";
      }
      else if($data['mffClosure'] != ''){
          $updateSqlStats = " UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$microId'";
      }
      else if($data['mfdLetter'] != ''){
          $updateSqlStats = " UPDATE loan SET `letterStatus` = 4 WHERE loan_Id = '$microId' ";
      }
      else if($data['mtLetter'] != ''){
          $updateSqlStats = " UPDATE loan SET `letterStatus` = 3 WHERE loan_Id = '$microId'";
      }
      else if($data['msLetter'] != ''){
          $updateSqlStats = " UPDATE loan SET `letterStatus` = 2 WHERE loan_Id = '$microId' ";
      }
      else if($data['mfLetter'] != ''){
          $updateSqlStats = " UPDATE loan SET `letterStatus` = 1 WHERE loan_Id = '$microId'";
      }
      else{
          $updateSqlStats = " UPDATE loan SET `letterStatus` = 0 WHERE loan_Id = '$microId'";
      }
      $updateQueryStats = mysqli_query($con, $updateSqlStats);
      $dataStats = mysqli_insert_id($con);

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
    // BORROWER
    addToLocalFiles($localFiles, $mloanAppFormM);
    addToLocalFiles($localFiles, $mborrower_IdSign);
    addToLocalFiles($localFiles, $mborrower_Lbp);
    addToLocalFiles($localFiles, $mborrower_Lpb);
    // CO-BORROWER
    addToLocalFiles($localFiles, $mcoborrowerStatement);
    addToLocalFiles($localFiles, $mcoBorrowerIdSign);
    addToLocalFiles($localFiles, $mproofIncome);
    // CO-MAKER
    addToLocalFiles($localFiles, $mcomakerStatement);
    addToLocalFiles($localFiles, $mcoMaker_IdSign);
    addToLocalFiles($localFiles, $mcoMakerLatestBp);
    addToLocalFiles($localFiles, $mcoMaker_Payslip);
    // RENEWAL
    addToLocalFiles($localFiles, $mbusinessValidation);
    addToLocalFiles($localFiles, $mloanInstallment);
    addToLocalFiles($localFiles, $mloanPayment);
    addToLocalFiles($localFiles, $mstatementAccount);
    // OTHERS
    addToLocalFiles($localFiles, $businessPicturePath);
    addToLocalFiles($localFiles, $cicPath);
    addToLocalFiles($localFiles, $nfisPath);
    addToLocalFiles($localFiles, $otherSuportPath);
    // DOCUMENTS
    addToLocalFiles($localFiles, $mvalidCardReport);
    addToLocalFiles($localFiles, $mcreditReport);
    addToLocalFiles($localFiles, $mcreditInvestigationReportM);
    addToLocalFiles($localFiles, $mdebitWaiver);
    addToLocalFiles($localFiles, $maffidavitSurrender);
    addToLocalFiles($localFiles, $mriskRating);
    addToLocalFiles($localFiles, $mloanApprovalSheet);
    // AFTER RELEASE
    addToLocalFiles($localFiles, $mpromissoryNoteM);
    addToLocalFiles($localFiles, $mdisclosureStateM);
    addToLocalFiles($localFiles, $mmriForm);
    addToLocalFiles($localFiles, $mamortScheduleM);
    addToLocalFiles($localFiles, $mutlization);
    // LETTER
    addToLocalFiles($localFiles, $mfLetterPath);
    addToLocalFiles($localFiles, $msLetterPath);
    addToLocalFiles($localFiles, $mtLetterPath);
    addToLocalFiles($localFiles, $mfdLetterPath);
    // LETTER2
    addToLocalFiles($localFiles, $mfLetter2Path);
    addToLocalFiles($localFiles, $msLetter2Path);
    addToLocalFiles($localFiles, $mtLetter2Path);
    addToLocalFiles($localFiles, $mfdLetter2Path);
    // LETTER3
    addToLocalFiles($localFiles, $mfLetter3Path);
    addToLocalFiles($localFiles, $msLetter3Path);
    addToLocalFiles($localFiles, $mtLetter3Path);
    addToLocalFiles($localFiles, $mfdLetter3Path);
    // OTHER ATTACHMENT
    addToLocalFiles($localFiles, $mclientReq1Path);
    addToLocalFiles($localFiles, $mclientReq2Path);
    addToLocalFiles($localFiles, $mclientReq3Path);
    // LEGAL
    addToLocalFiles($localFiles, $mffClosurePath);
    addToLocalFiles($localFiles, $mpastLitigationPath);
    addToLocalFiles($localFiles, $mpastLitigation2Path);
    addToLocalFiles($localFiles, $mttLitigationPath);
    addToLocalFiles($localFiles, $mPrepConsoPath);
    addToLocalFiles($localFiles, $maDemandPath);

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

    }else {

      echo 'Error'. mysqli_error($con);

    }
  }
  else {
    // Data does not exist, perform an INSERT query
    $sqlInsert = "INSERT INTO microfinance (`mLoan_Id`, `loanAppFormM`, `mborrower_IdSign`, `mborrower_Lbp`, `mborrower_Lpb`, 
                                            `coborrowerStatement`, `mcoBorrower_Id`, `proofIncome`, `comakerStatement`, 
                                            `mcoMaker_IdSign`,`mcoMaker_Lbp`,`mcoMaker_Payslip`, 
                                            `mfLetter`, `mfLetter2`, `mfLetter3`,
                                            `msLetter`, `msLetter2`, `msLetter3`,
                                            `mtLetter`, `mtLetter2`, `mtLetter3`,
                                            `mfdLetter`, `mfdLetter2`, `mfdLetter3`, 
                                            `mclientReq1`, `mclientReq2`, `mclientReq3`,
                                            `mffClosure`, `mpastDueLitigation`, `mpastDueLitigation2`, 
                                            `mtransferLitigation`, `mPrepConso`, 
                                            `maDemand`, `mdateUploaded`)
                                    VALUES 
                                            ('$microId', '$mloanAppFormM', '$mborrower_IdSign', '$mborrower_Lbp', 
                                            '$mborrower_Lpb', '$mcoborrowerStatement', '$mcoBorrowerIdSign', 
                                            '$mproofIncome', '$mcomakerStatement','$mcoMaker_IdSign','$mcoMakerLatestBp',
                                            '$mcoMaker_Payslip', 
                                            '$mfLetterPath', '$mfLetter2Path', '$mfLetter3Path',
                                            '$msLetterPath', '$msLetter2Path', '$msLetter3Path', 
                                            '$mtLetterPath', '$mtLetter2Path', '$mtLetter3Path',
                                            '$mfdLetterPath', '$mfdLetter2Path', '$mfdLetter3Path',
                                            '$mclientReq1Path', '$mclientReq2Path', '$mclientReq3Path',
                                            '$mffClosurePath', '$mpastLitigationPath', '$mpastLitigation2Path', 
                                            '$mttLitigationPath', '$mPrepConsoPath', '$maDemandPath', '$dateToday')";
    
    $insertQuery = mysqli_query($con, $sqlInsert);

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
          default:
              $address = "UNKNOWN/"; // Default value if $branch does not match any case
              break;
      }  
      // Check if Insert Query is true
      if($insertQuery==true) {

        $archived = "INSERT INTO letterarchive (`loanIds`, `firstLetter`, `firstLetter2`, 
                                                `firstLetter3`, `secondLetter`, `secondLetter2`, 
                                                `secondLetter3`, `thirdLetter`, `thirdLetter2`, 
                                                `thirdLetter3`, `finalLetter`, `finalLetter2`, 
                                                `finalLetter3`, 
                                                `clientRequest1`, `clientRequest2`, `clientRequest3`,
                                                `foreClosure`, `pastDueLitigation`, 
                                                `pastDueLitigation2`, `transferLitigation`, `PrepConsol`, 
                                                `dueDemandable`, `todaysDate`)
                                            VALUES      
                                                ('$microId', '$mfLetterPath', '$mfLetter2Path', 
                                                '$mfLetter3Path', '$msLetterPath', '$msLetter2Path',
                                                '$msLetter3Path', '$mtLetterPath', '$mtLetter2Path',
                                                '$mtLetter3Path', '$mfdLetterPath', '$mfdLetter2Path,
                                                '$mfdLetter3Path', 
                                                '$mclientReq1Path', '$mclientReq2Path', '$mclientReq3Path',
                                                '$mffClosurePath', '$mpastLitigationPath',
                                                '$mpastLitigation2Path', '$mttLitigationPath', '$mPrepConsoPath',
                                                '$maDemandPath', '$dateToday')";
        $queryarchived = mysqli_query($con, $archived);

       // BORROWER
    sendMail($data['loanAppFormM'], $mloanAppFormM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanAppFormName);
    sendMail($data['mborrower_IdSign'], $mborrower_IdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_IdsignatureName);
    sendMail($data['mborrower_Lbp'], $mborrower_Lbp, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_LbpName);
    sendMail($data['mborrower_Lpb'], $mborrower_Lpb, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $borrower_LpbName);
     // CO BORROWER
    sendMail($data['coborrowerStatement'], $mcoborrowerStatement, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coborrowerStatementName);
    sendMail($data['mcoBorrower_Id'], $mcoBorrowerIdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coBorrowerIdSignName);
    sendMail($data['proofIncome'], $mproofIncome, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $proofIncomeName);
     // CO MAKER
    sendMail($data['comakerStatement'], $mcomakerStatement, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $comakerStatementName);
    sendMail($data['mcoMaker_IdSign'], $mcoMaker_IdSign, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coMakerIdWithSignName);
    sendMail($data['mcoMaker_Lbp'], $mcoMakerLatestBp, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $latestPermitName);
    sendMail($data['mcoMaker_Payslip'], $mcoMaker_Payslip, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $coMakerPayslipName);
     // RENEWAL
    sendMail($data['businessValidation'], $mbusinessValidation, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessValidationName);
    sendMail($data['loanInstallment'], $mloanInstallment, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanInstallmentName);
    sendMail($data['loanPayment'], $mloanPayment, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanPaymentName);
    sendMail($data['statementAccount'], $mstatementAccount, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $statementAccountName);
    // OTHERS
    sendMail($data['businessPicture'], $businessPicturePath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $businessPictureName);
    sendMail($data['cic'], $cicPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $cicName);
    sendMail($data['nfis'], $nfisPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $nfisName);
    // sendMail($data['otherSuport'], $otherSuportPath, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $otherSuportName);
    // DOCUMENTS
    sendMail($data['validCardReport'], $mvalidCardReport, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $validCardReportName);
    sendMail($data['creditReport'], $mcreditReport, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditReportName);
    sendMail($data['creditInvestigationReportM'], $mcreditInvestigationReportM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $creditInvestigationReportMName);
    // sendMail($data['debitWaiver'], $mdebitWaiver, $fullname, "ctborgonia@ourbank.ph", $debitWaiverName);
    sendMail($data['affidavitSurrender'], $maffidavitSurrender, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $affidavitSurrenderName);
    sendMail($data['riskRating'], $mriskRating, $fullname, $emails,  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $riskRatingName);
    sendMail($data['loanApprovalSheet'], $mloanApprovalSheet, $fullname, $emails,  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $loanApprovalSheetName);
    // AFTER RELEASE
    sendMail($data['promissoryNoteM'], $mpromissoryNoteM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $promissoryNoteMName);
    sendMail($data['disclosureStateM'], $mdisclosureStateM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $disclosureStateMName);
    sendMail($data['mriForm'], $mmriForm, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $insuranceName);
    sendMail($data['amortScheduleM'], $mamortScheduleM, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $amortScheduleMName);
    sendMail($data['utilization'], $mutilization, $fullname, "cdcruz@ourbank.ph",  'jlcricafrente@ourbank.ph', 'apreyes@ourbank.ph', '', $utlizationName);

        // if($data['maDemand'] != ''){
        //   $updateSqlStats = " UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$microId'";
        // }
        // else if($data['mttLitigation'] != ''){
        //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$microId'";
        // }
        // else if($data['mffClosure'] != ''){
        //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$microId'";
        // }
        // else if($data['mfdLetter'] != ''){
        //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 4 WHERE loan_Id = '$microId' ";
        // }
        // else if($data['mtLetter'] != ''){
        //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 3 WHERE loan_Id = '$microId'";
        // }
        // else if($data['msLetter'] != ''){
        //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 2 WHERE loan_Id = '$microId' ";
        // }
        // else if($data['mfLetter'] != ''){
        //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 1 WHERE loan_Id = '$microId'";
        // }
        // else{
        //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 0 WHERE loan_Id = '$microId'";
        // }
        // $updateQueryStats = mysqli_query($con, $updateSqlStats);
        // $dataStats = mysqli_insert_id($con);

        $ftpServer = '10.10.10.117';
        $ftpUsername = "ourbank-tech";
        $ftpPassword = "Juliuspogi2023";
      
        // Local file paths
        $localFiles = [
          $mLoan_Id,
          $mloanAppFormM,
          $mborrower_IdSign,
          $mborrower_Lbp,
          $mborrower_Lpb,
          $coborrowerStatement,
          $mcoBorrower_Id,
          $proofIncome,
          $comakerStatement,
          $mcoMaker_IdSign,
          $mcoMakerLatestBp,
          $mcoMaker_Payslip,
          // LETTER
          $mfLetterPath,
          $msLetterPath,
          $mtLetterPath,
          $mfdLetterPath,
          // LETTER2
          $mfLetter2Path,
          $msLetter2Path,
          $mtLetter2Path,
          $mfdLetter2Path,
          // LETTER3
          $mfLetter3Path,
          $msLetter3Path,
          $mtLetter3Path,
          $mfdLetter3Path,
          // OTHER ATTACHMENT
          $mclientReq1Path,
          $mclientReq2Path,
          $mclientReq3Path,
          // LEGAL
          $mffClosurePath,
          $mpastLitigationPath,
          $mpastLitigation2Path,
          $mttLitigationPath,
          $mPrepConsoPath,
          $maDemandPath
      ];
      
      
  
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
  
            $remoteFile = "LOAN/" . $address . "UNSECURED LOAN/" . $fullname . '/' . $localName;
      
           
      
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
  
        echo 'ERROR Insert'. mysqli_error($con);
  
    }
  
}
  
?>


