<?php
include('connection.php');
include('fileuploadloan.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// include('connection.php');
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y \a\t g:i A');
$salaryLoanId = $_POST['salaryId'];
$salaryType = $_POST['salaryType'];
$fullname=$_POST['fullname'];
$branch=$_POST['branch'];
$loanType=$_POST['loanType'];
$productID =$_POST['productID'];

//Checking of Check
$oathTakingValue = isset($_POST['oathTakingCheck']) ? "Check" : "Uncheck";
$cicValue = isset($_POST['cicCheck']) ? "Check" : "Uncheck";
$nfisValue = isset($_POST['nfisCheck']) ? "Check" : "Uncheck";
$kapasyahanValue = isset($_POST['kapasyahanCheck']) ? "Check" : "Uncheck";
$brgyResoValue = isset($_POST['brgyResoCheck']) ? "Check" : "Uncheck";
$canvassVoteValue = isset($_POST['canvassVoteCheck']) ? "Check" : "Uncheck";
$empOfficerCertValue = isset($_POST['empOfficerCertCheck']) ? "Check" : "Uncheck";

$spastCheck = isset($_POST['spastCheck']) ? "Yes" : "No";

// POST THE VALUE OF THE SELECTION
// BORROWER
$endorsementLetterSelect = $_POST['endorsementLetterSelect'];
$loanAppFormSelect = $_POST['loanAppFormSelect'];
$memoAgreementSelect = $_POST['memoAgreementSelect'];
$certEmploymentSelect = $_POST['certEmploymentSelect'];
$payslipSelect = $_POST['payslipSelect'];
$itr1Select = $_POST['itr1Select'];
$tinSelect = $_POST['tinSelect'];
$proofBillingSelect = $_POST['proofBillingSelect'];
$clearanceLoanSelect = $_POST['clearanceLoanSelect'];
// CO MAKER 1
$coMaker1Select = $_POST['coMaker1Select'];
$validSignaturesSelect = $_POST['validSignaturesSelect'];
$monthsPayslipSelect = $_POST['monthsPayslipSelect'];
$itr2Select = $_POST['itr2Select'];
// CO MAKER 2
$coMaker2Select = $_POST['coMaker2Select'];
$validSignatures2Select = $_POST['validSignatures2Select'];
$monthsPayslip2Select = $_POST['monthsPayslip2Select'];
$itr3Select = $_POST['itr3Select'];
// DOCUMENTS
$deductRemitSelect = $_POST['deductRemitSelect'];
$cashflowScoreSelect = $_POST['cashflowScoreSelect'];
$loanAppMemoSelect = $_POST['loanAppMemoSelect'];
$promissoryNoteSSelect = $_POST['promissoryNoteSSelect'];
$disclosureStateSSelect = $_POST['disclosureStateSSelect'];
$mriFormSelect = $_POST['mriFormSelect'];
$amortScheduleSSelect = $_POST['amortScheduleSSelect'];
$utilizationSelect = $_POST['utilizationSelect'];
// LETTER
$sfLetter = $_POST['sfLetter'];
$ssLetter = $_POST['ssLetter'];
$stLetter = $_POST['stLetter'];
$sfdLetter = $_POST['sfdLetter'];
//  LETTER2
$sfLetter2 = $_POST['sfLetter2'];
$ssLetter2 = $_POST['ssLetter2'];
$stLetter2 = $_POST['stLetter2'];
$sfdLetter2 = $_POST['sfdLetter2'];
//  LETTER3
$sfLetter3 = $_POST['sfLetter3'];
$ssLetter3 = $_POST['ssLetter3'];
$stLetter3 = $_POST['stLetter3'];
$sfdLetter3 = $_POST['sfdLetter3'];

// OTHER ATTACHMENT
$sclientReq1 = $_POST['sclientReq1'];
$sclientReq2 = $_POST['sclientReq2'];
$sclientReq3 = $_POST['sclientReq3'];

$sclientReq1Select = $_POST['sclientReq1Select'];
$sclientReq1Desc = $_POST['sclientReq1Desc'];

// LETTER SELECT
$sfLetterSelect = $_POST['sfLetterSelect'];
$ssLetterSelect = $_POST['ssLetterSelect'];
$stLetterSelect = $_POST['stLetterSelect'];
$sfdLetterSelect = $_POST['sfdLetterSelect'];
// LEGAL SELECT
$sffClosureSelect = $_POST['sffClosureSelect'];
$spastLitigationSelect = $_POST['spastLitigationSelect'];
$sttLitigationSelect = $_POST['sttLitigationSelect'];
$sPrepConsoSelect = $_POST['sPrepConsoSelect'];
$saDemandSelect = $_POST['saDemandSelect'];
// POST ALL THE REMARKS TEXT
// BORROWER
$endorsementLetterDesc = $_POST['endorsementLetterDesc'];
$loanAppFormDesc = $_POST['loanAppFormDesc'];
$memoAgreementSDesc = $_POST['memoAgreementSDesc'];
$certofEmploymentDesc = $_POST['certofEmploymentDesc'];
$latestPayslipDesc = $_POST['latestPayslipDesc'];
$itr1Desc = $_POST['itr1Desc'];
$tinDesc = $_POST['tinDesc'];
$proofBillingDesc = $_POST['proofBillingDesc'];
$clearanceLoanDesc = $_POST['clearanceLoanDesc'];
// CO MAKER 1
$coMaker1Desc = $_POST['coMaker1Desc'];
$validSignaturesDesc = $_POST['validSignaturesDesc'];
$monthsPayslipDesc = $_POST['monthsPayslipDesc'];
$itr2Desc = $_POST['itr2Desc'];
// CO MAKER 2
$coMaker2Desc = $_POST['coMaker2Desc'];
$validSignatures2Desc = $_POST['validSignatures2Desc'];
$monthsPayslip2Desc = $_POST['monthsPayslip2Desc'];
$itr3Desc = $_POST['itr3Desc'];
// DOCUMENTS
$deductRemitDesc = $_POST['deductRemitDesc'];
$cashflowScoreDesc = $_POST['cashflowScoreDesc'];
$loanAppMemoDesc = $_POST['loanAppMemoDesc'];
$promissoryNoteSDesc = $_POST['promissoryNoteSDesc'];
$disclosureStateSDesc = $_POST['disclosureStateSDesc'];
$mriFormDesc = $_POST['mriFormDesc'];
$amortScheduleSDesc = $_POST['amortScheduleSDesc'];
$utilizationDesc= $_POST['utilizationDesc'];
// LETTER DESC
$sfLetterDesc = $_POST['sfLetterDesc'];
$ssLetterDesc = $_POST['ssLetterDesc'];
$stLetterDesc = $_POST['stLetterDesc'];
$sfdLetterDesc = $_POST['sfdLetterDesc'];
// LEGAL
$sffClosureDesc = $_POST['sffClosureDesc'];
$sttLitigationDesc = $_POST['sttLitigationDesc'];
$saDemandDesc = $_POST['saDemandDesc'];
// OTHER SELECT
$oathTakingSelect = $_POST['oathTakingSelect'];
$cicSelect = $_POST['cicSelect'];
$nfisSelect = $_POST['nfisSelect'];
$kapasyahanSelect = $_POST['kapasyahanSelect'];
$brgyResoSelect = $_POST['brgyResoSelect'];
$canvassVoteSelect = $_POST['canvassVoteSelect'];
$empOfficerCertSelect = $_POST['empOfficerCertSelect'];
// // LETTER DESC
// $sfLetterDesc = $_POST['sfLetterDesc'];
// $ssLetterDesc = $_POST['ssLetterDesc'];
// $stLetterDesc = $_POST['stLetterDesc'];
// $sfdLetterDesc = $_POST['sfdLetterDesc'];
// // LEGAL
// $sffClosureDesc = $_POST['sffClosureDesc'];
// $sttLitigationDesc = $_POST['sttLitigationDesc'];
// $saDemandDesc = $_POST['saDemandDesc'];
// OTHER DESC
$oathTakingDesc = $_POST['oathTakingDesc'];
$cicDesc = $_POST['cicDesc'];
$nfisDesc = $_POST['nfisDesc'];
$kapasyahanDesc = $_POST['kapasyahanDesc'];
$brgyResoDesc = $_POST['brgyResoDesc'];
$canvassVoteDesc = $_POST['canvassVoteDesc'];
$empOfficerCertDesc = $_POST['empOfficerCertDesc'];

function archiveFile($fileKey, $dbField, $salaryLoanId, $archiveField, $dateToday, $endPrompt, $con) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        // error_log("In archiveFile - End Prompt: " . $endPrompt);
        
        // Fetch the existing file data from the `individual` table
        $selectQuery = "SELECT `$dbField` FROM `salaryloan` WHERE `salaryLoanId` = '$salaryLoanId'";
        $selectResult = mysqli_query($con, $selectQuery);
        
        if ($row = mysqli_fetch_array($selectResult)) {
            $fileData = $row[$dbField];
            
            // Insert the previous data into the `indivarchive` table
            if($endPrompt != ''){
                $insertQuery = "INSERT INTO `salaryarchive` (`a_salaryLoanId`, `$archiveField`, `a_date_Uploads`, `as_remarks`)
                                                    VALUES 
                                                            ('$salaryLoanId', '$fileData', '$dateToday', '$endPrompt')";
                
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
    if (isset($_FILES['endorsementLetter'])) {
        archiveFile('endorsementLetter', 'endorsementLetter', $salaryLoanId, 'a_endorsementLetter', $dateToday, $endPrompt, $con);
    }
    if (isset($_FILES['loanAppForm'])) {
        archiveFile('loanAppForm', 'loanAppForm', $salaryLoanId, 'a_loanAppForm', $dateToday, $endPrompt, $con);
    }
    if (isset($_FILES['memoAgreementS'])) {
        archiveFile('memoAgreementS', 'memoAgreementS', $salaryLoanId, 'a_memoAgreementS', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['certofEmployment'])){
        archiveFile('certofEmployment', 'certofEmployment', $salaryLoanId, 'a_certofEmployment', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['latestPayslip'])){
        archiveFile('latestPayslip', 'latestPayslip', $salaryLoanId, 'a_latestPayslip', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['itr1'])){
        archiveFile('itr1', 'itr1', $salaryLoanId, 'a_itr1', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['tin'])){
        archiveFile('tin', 'tin', $salaryLoanId, 'a_tin', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['proofBilling'])){
        archiveFile('proofBilling', 'proofBilling', $salaryLoanId, 'a_proofBilling', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['clearanceLoan'])){
        archiveFile('clearanceLoan', 'clearanceLoan', $salaryLoanId, 'a_clearanceLoan', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coMaker1'])){
        archiveFile('coMaker1', 'coMaker1', $salaryLoanId, 'a_coMaker1', $dateToday, $endPrompt, $con);
    }
    
    // // COLLATERAL DOCUMENTS
    if(isset($_FILES['validSignatures'])){
        archiveFile('validSignatures', 'validSignatures', $salaryLoanId, 'a_validSignatures', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['monthsPayslip'])){
        archiveFile('monthsPayslip', 'monthsPayslip', $salaryLoanId, 'a_monthsPayslip', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coMaker2'])){
        archiveFile('coMaker2', 'coMaker2', $salaryLoanId, 'a_coMaker2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['validSignatures2'])){
        archiveFile('validSignatures2', 'validSignatures2', $salaryLoanId, 'a_validSignatures2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['itr2'])){
        archiveFile('itr2', 'itr2', $salaryLoanId, 'a_itr2', $dateToday, $endPrompt, $con);
    }

    // For Renewal
    if(isset($_FILES['monthsPayslip2'])){
        archiveFile('monthsPayslip2', 'monthsPayslip2', $salaryLoanId, 'a_monthsPayslip2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['deductRemit'])){
        archiveFile('deductRemit', 'deductRemit', $salaryLoanId, 'a_deductRemit', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cashflowScore'])){
        archiveFile('cashflowScore', 'cashflowScore', $salaryLoanId, 'a_cashflowScore', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['loanAppMemo'])){
        archiveFile('loanAppMemo', 'loanAppMemo', $salaryLoanId, 'a_loanAppMemo', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['itr3'])){
        archiveFile('itr3', 'itr3', $salaryLoanId, 'a_itr3', $dateToday, $endPrompt, $con);
    }
    

    // Docs Reports
    if(isset($_FILES['promissoryNoteS'])){
        archiveFile('promissoryNoteS', 'promissoryNoteS', $salaryLoanId, 'a_promissoryNoteS', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['disclosureStateS'])){
        archiveFile('disclosureStateS', 'disclosureStateS', $salaryLoanId, 'a_disclosureStateS', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['mriForm'])){
        archiveFile('mriForm', 'mriForm', $salaryLoanId, 'a_mriForm', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['amortScheduleS'])){
        archiveFile('amortScheduleS', 'amortScheduleS', $salaryLoanId, 'a_amortScheduleS', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['utilization'])){
        archiveFile('utilization', 'utilization', $salaryLoanId, 'a_utilization', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['kapasyahan'])){
        archiveFile('kapasyahan', 'kapasyahan', $salaryLoanId, 'a_kapasyahan', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['brgyReso'])){
        archiveFile('brgyReso', 'brgyReso', $salaryLoanId, 'a_brgyReso', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['canvassVote'])){
        archiveFile('canvassVote', 'canvassVote', $salaryLoanId, 'a_canvassVote', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['oathTaking'])){
        archiveFile('oathTaking', 'oathTaking', $salaryLoanId, 'a_oathTaking', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cic'])){
        archiveFile('cic', 'cic', $salaryLoanId, 'a_cic', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['nfis'])){
        archiveFile('nfis', 'nfis', $salaryLoanId, 'a_nfis', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['empOfficerCert'])){
        archiveFile('empOfficerCert', 'empOfficerCert', $salaryLoanId, 'a_empOfficerCert', $dateToday, $endPrompt, $con);
    }

     // sfLetter
     if(isset($_FILES['sfLetter'])){
        archiveFile('sfLetter', 'sfLetter', $salaryLoanId, 'a_sfLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sfLetter2'])){
        archiveFile('sfLetter2', 'sfLetter2', $salaryLoanId, 'a_sfLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sfLetter3'])){
        archiveFile('sfLetter3', 'sfLetter3', $salaryLoanId, 'a_sfLetter3', $dateToday, $endPrompt, $con);
    }
    // ssLetter
    if(isset($_FILES['ssLetter'])){
        archiveFile('ssLetter', 'ssLetter', $salaryLoanId, 'a_ssLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ssLetter2'])){
        archiveFile('ssLetter2', 'ssLetter2', $salaryLoanId, 'a_ssLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['ssLetter3'])){
        archiveFile('ssLetter3', 'ssLetter3', $salaryLoanId, 'a_ssLetter3', $dateToday, $endPrompt, $con);
    }
    // stLetter
    if(isset($_FILES['stLetter'])){
        archiveFile('stLetter', 'stLetter', $salaryLoanId, 'a_stLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['stLetter2'])){
        archiveFile('stLetter2', 'stLetter2', $salaryLoanId, 'a_stLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['stLetter3'])){
        archiveFile('stLetter3', 'stLetter3', $salaryLoanId, 'a_stLetter3', $dateToday, $endPrompt, $con);
    }
    // sfdLetter
    if(isset($_FILES['sfdLetter'])){
        archiveFile('sfdLetter', 'sfdLetter', $salaryLoanId, 'a_sfdLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sfdLetter2'])){
        archiveFile('sfdLetter2', 'sfdLetter2', $salaryLoanId, 'a_sfdLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sfdLetter3'])){
        archiveFile('sfdLetter3', 'sfdLetter3', $salaryLoanId, 'a_sfdLetter3', $dateToday, $endPrompt, $con);
    }

    // other attachment
    if(isset($_FILES['sclientReq1'])){
        archiveFile('sclientReq1', 'sclientReq1', $salaryLoanId, 'a_sclientReq1', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sclientReq2'])){
        archiveFile('sclientReq2', 'sclientReq2', $salaryLoanId, 'a_sclientReq2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['sclientReq3'])){
        archiveFile('sclientReq3', 'sclientReq3', $salaryLoanId, 'a_sclientReq3', $dateToday, $endPrompt, $con);
    }

    // legal
    if(isset($_FILES['sffClosure'])){
        archiveFile('sffClosure', 'sffClosure', $salaryLoanId, 'a_sffClosure', $dateToday, $endPrompt, $con);
    }

    // past due litigation
    if(isset($_FILES['spastLitigation'])){
        archiveFile('spastLitigation', 'spastDueLitigation', $salaryLoanId, 'a_spastDueLitigation', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['spastLitigation2'])){
        archiveFile('spastLitigation2', 'spastDueLitigation2', $salaryLoanId, 'a_spastDueLitigation2', $dateToday, $endPrompt, $con);
    }

    // tramsfer to ROPA
    if(isset($_FILES['sttLitigation'])){
        archiveFile('sttLitigation', 'sttLitigation', $salaryLoanId, 'a_sttLitigation', $dateToday, $endPrompt, $con);
    }

    // preparation of consolidation
    if(isset($_FILES['sPrepConso'])){
        archiveFile('sPrepConso', 'sPrepConso', $salaryLoanId, 'a_sPrepConso', $dateToday, $endPrompt, $con);
    }

    // due and demandable
    if(isset($_FILES['saDemand'])){
        archiveFile('saDemand', 'saDemand', $salaryLoanId, 'a_saDemand', $dateToday, $endPrompt, $con);
    }
    // end
}


// UPLOAD THE FILES TO LOCALHOST CALLED SALARY LOAN
// BORROWER
$endorsementLetterFile = upload_file($_FILES['endorsementLetter'], 'salaryloan', $salaryLoanId);
$loanAppFormFile = upload_file($_FILES['loanAppForm'], 'salaryloan',$salaryLoanId);
$memoAgreementSFile = upload_file($_FILES['memoAgreementS'], 'salaryloan',$salaryLoanId);
$certofEmploymentFile = upload_file($_FILES['certofEmployment'], 'salaryloan',$salaryLoanId);
$latestPayslipFile = upload_file($_FILES['latestPayslip'], 'salaryloan',$salaryLoanId);
$itr1File = upload_file($_FILES['itr1'], 'salaryloan', $salaryLoanId);
$tinFile = upload_file($_FILES['tin'], 'salaryloan',$salaryLoanId);
$proofBillingFile = upload_file($_FILES['proofBilling'], 'salaryloan', $salaryLoanId);
$clearanceLoanFile = upload_file($_FILES['clearanceLoan'], 'salaryloan',$salaryLoanId);
// CO MAKER 1
$coMaker1File = upload_file($_FILES['coMaker1'], 'salaryloan',$salaryLoanId);
$validSignaturesFile = upload_file($_FILES['validSignatures'], 'salaryloan',$salaryLoanId);
$monthsPayslipFile = upload_file($_FILES['monthsPayslip'], 'salaryloan',$salaryLoanId);
$itr2File = upload_file($_FILES['itr2'], 'salaryloan', $salaryLoanId);
// CO MAKER 2
$coMaker2File = upload_file($_FILES['coMaker2'], 'salaryloan',$salaryLoanId);
$validSignatures2File = upload_file($_FILES['validSignatures2'], 'salaryloan',$salaryLoanId);
$monthsPayslip2File = upload_file($_FILES['monthsPayslip2'], 'salaryloan', $salaryLoanId);
$itr3File = upload_file($_FILES['itr3'], 'salaryloan', $salaryLoanId);
// DOCUMENTS
$deductRemitFile = upload_file($_FILES['deductRemit'], 'salaryloan', $salaryLoanId);
$cashflowScoreFile = upload_file($_FILES['cashflowScore'], 'salaryloan', $salaryLoanId);
$loanAppMemoFile = upload_file($_FILES['loanAppMemo'], 'salaryloan', $salaryLoanId);
$promissoryNoteSFile = upload_file($_FILES['promissoryNoteS'], 'salaryloan',$salaryLoanId);
$disclosureStateSFile = upload_file($_FILES['disclosureStateS'], 'salaryloan',$salaryLoanId);
$mriFormFile = upload_file($_FILES['mriForm'], 'salaryloan',$salaryLoanId);
$amortScheduleSFile= upload_file($_FILES['amortScheduleS'], 'salaryloan',$salaryLoanId);
$utilizationFile = upload_file($_FILES['utilization'], 'salaryloan', $salaryLoanId);
// LETTER
$sfLetterFile = upload_file($_FILES['sfLetter'], 'salaryloan', $salaryLoanId);
$ssLetterFile = upload_file($_FILES['ssLetter'], 'salaryloan', $salaryLoanId);
$stLetterFile = upload_file($_FILES['stLetter'], 'salaryloan', $salaryLoanId);
$sfdLetterFile = upload_file($_FILES['sfdLetter'], 'salaryloan', $salaryLoanId);
// LETTER2
$sfLetter2File= upload_file($_FILES['sfLetter2'], 'salaryloan', $salaryLoanId);
$ssLetter2File= upload_file($_FILES['ssLetter2'], 'salaryloan',$salaryLoanId);
$stLetter2File= upload_file($_FILES['stLetter2'], 'salaryloan',$salaryLoanId);
$sfdLetter2File= upload_file($_FILES['sfdLetter2'], 'salaryloan',$salaryLoanId);
// LETTER3
$sfLetter3File= upload_file($_FILES['sfLetter3'], 'salaryloan',$salaryLoanId);
$ssLetter3File= upload_file($_FILES['ssLetter3'], 'salaryloan',$salaryLoanId);
$stLetter3File= upload_file($_FILES['stLetter3'], 'salaryloan',$salaryLoanId);
$sfdLetter3File= upload_file($_FILES['sfdLetter3'], 'salaryloan',$salaryLoanId);
// OTHER ATTACHMENT
$sclientReq1File = upload_file($_FILES['sclientReq1'], 'salaryloan', $salaryLoanId);
$sclientReq2File = upload_file($_FILES['sclientReq2'], 'salaryloan', $salaryLoanId);
$sclientReq3File = upload_file($_FILES['sclientReq3'], 'salaryloan', $salaryLoanId);
// LEGAL
$sffClosureFile = upload_file($_FILES['sffClosure'], 'salaryloan', $salaryLoanId);
$spastLitigationFile = upload_file($_FILES['spastLitigation'], 'salaryloan', $salaryLoanId);
$spastLitigation2File = upload_file($_FILES['spastLitigation2'], 'salaryloan', $salaryLoanId);
$sttLitigationFile = upload_file($_FILES['sttLitigation'], 'salaryloan', $salaryLoanId);
$sPrepConsoFile = upload_file($_FILES['sPrepConso'], 'salaryloan', $salaryLoanId);
$saDemandFile = upload_file($_FILES['saDemand'], 'salaryloan', $salaryLoanId);
// OTHER
$oathTakingFile = upload_file($_FILES['oathTaking'], 'salaryloan', $salaryLoanId);
$cicFile = upload_file($_FILES['cic'], 'salaryloan', $salaryLoanId);
$nfisFile = upload_file($_FILES['nfis'], 'salaryloan', $salaryLoanId);
$kapasyahanFile = upload_file($_FILES['kapasyahan'], 'salaryloan', $salaryLoanId);
$brgyResoFile = upload_file($_FILES['brgyReso'], 'salaryloan', $salaryLoanId);
$canvassVoteFile = upload_file($_FILES['canvassVote'], 'salaryloan', $salaryLoanId);
$empOfficerCertFile = upload_file($_FILES['empOfficerCert'], 'salaryloan', $salaryLoanId);

// TAKE ALL THE PATH AND PUT THEM IN A VARIABLE FOR DATABASE
// BORROWER
$endorsementLetterPath = $endorsementLetterFile['path'];
$loanAppFormPath = $loanAppFormFile['path'];
$memoAgreementSPath = $memoAgreementSFile['path'];
$certofEmploymentPath = $certofEmploymentFile['path'];
$latestPayslipPath = $latestPayslipFile['path'];
$itr1Path = $itr1File['path'];
$tinPath = $tinFile['path'];
$proofBillingPath = $proofBillingFile['path']; 
$clearanceLoanPath = $clearanceLoanFile['path'];
// CO MAKER 1
$coMaker1Path = $coMaker1File['path'];
$validSignaturesPath = $validSignaturesFile['path'];
$monthsPayslipPath = $monthsPayslipFile['path'];
$itr2Path = $itr2File['path'];
// CO MAKER 2
$coMaker2Path = $coMaker2File['path'];
$validSignatures2Path = $validSignatures2File['path'];
$monthsPayslip2Path = $monthsPayslip2File['path'];
$itr3Path = $itr3File['path'];
// DOCUMENTS
$deductRemitPath = $deductRemitFile['path'];
$cashflowScorePath = $cashflowScoreFile['path'];
$loanAppMemoPath = $loanAppMemoFile['path'];
$promissoryNoteSPath = $promissoryNoteSFile['path'];
$disclosureStateSPath = $disclosureStateSFile['path'];
$mriFormPath = $mriFormFile['path'];
$amortScheduleSPath = $amortScheduleSFile['path'];
$utilizationPath = $utilizationFile['path'];
// LETTER
$sfLetterPath = $sfLetterFile['path'];
$ssLetterPath = $ssLetterFile['path'];
$stLetterPath = $stLetterFile['path'];
$sfdLetterPath = $sfdLetterFile['path'];
// LETTER2
$sfLetter2Path = $sfLetter2File['path'];
$ssLetter2Path = $ssLetter2File['path'];
$stLetter2Path = $stLetter2File['path'];
$sfdLetter2Path = $sfdLetter2File['path'];
// LETTER3
$sfLetter3Path = $sfLetter3File['path'];
$ssLetter3Path = $ssLetter3File['path'];
$stLetter3Path = $stLetter3File['path'];
$sfdLetter3Path = $sfdLetter3File['path'];
// OTHER ATTACHMENT
$sclientReq1Path = $sclientReq1File['path'];
$sclientReq2Path = $sclientReq2File['path'];
$sclientReq3Path = $sclientReq3File['path'];
// LEGAL
$sffClosurePath = $sffClosureFile['path'];
$spastLitigationPath = $spastLitigationFile['path'];
$spastLitigation2Path = $spastLitigation2File['path'];
$sttLitigationPath = $sttLitigationFile['path'];
$sPrepConsoPath = $sPrepConsoFile['path'];
$saDemandPath = $saDemandFile['path'];
// OTHER
$oathTakingPath = $oathTakingFile['path'];
$cicPath = $cicFile['path'];
$nfisPath = $nfisFile['path'];
$kapasyahanPath = $kapasyahanFile['path'];
$brgyResoPath = $brgyResoFile['path'];
$canvassVotePath = $canvassVoteFile['path'];
$empOfficerCertPath = $empOfficerCertFile['path'];

// FUNCTION FOR EMAIL
function sendMail($data,$path,$name, $documents){
    if(!empty($path) && empty($data)){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail -> isHTML(true);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress('cdcruz@ourbank.ph');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('apreyes@ourbank.ph');
    $mail->Subject = "$name";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Customer/Client: <b>' . $name . ' </b>
                    <br><br>DOCUMENTS UPLOADED: <b>' . $documents . '</b>
                    <br>';
    $mail->send();
    }
  }
  function mailMemo($data,$path,$name){
    if(!empty($path) && empty($data)){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail -> isHTML(true);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('apreyes@ourbank.ph');
    $mail->addAddress('cdcruz@ourbank.ph');
    $mail->Subject = "$name";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
    <br><br>DOCUMENT UPLOADED:<b> LOAN APPROVAL MEMO </b>
    
    <br>';
    $mail->send();
    }
  }

// Check if the data already exists
$sqlSelect = "SELECT * FROM salaryloan WHERE salaryLoanId = '$salaryLoanId'";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if ($data) {
    #comment this if error exist 12-20-2023
    // if(!empty($productID)){
    //     $productsUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$salaryLoanId'";
    //     $productsQuery = mysqli_query($con, $productsUpdate);
    //     if(!$productsQuery){
    //         echo 'ERROR update'. mysqli_error($con);
    //     }else{
    //         echo 'Product ID Update Successfully';
    //     }
    // }else{
    //     echo "Product ID is empty";
    // }
    
    // echo 'Update successful!';
  // Data already exists, perform an UPDATE query

  // check every Database fields, If Data path is not empty it will update
  function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
    if (!empty($columnValue)) {
      $sqlUpdate .= " `$columnName` = '$columnValue',";
    }
  }
  
  $sqlUpdate = "UPDATE salaryloan SET";
  //  BORROWER
  addColumnUpdate($sqlUpdate, "endorsementLetter", $endorsementLetterPath);
  addColumnUpdate($sqlUpdate, "loanAppForm", $loanAppFormPath);
  addColumnUpdate($sqlUpdate, "memoAgreementS", $memoAgreementSPath);
  addColumnUpdate($sqlUpdate, "certofEmployment", $certofEmploymentPath);
  addColumnUpdate($sqlUpdate, "latestPayslip", $latestPayslipPath);
  addColumnUpdate($sqlUpdate, "itr1", $itr1Path);
  addColumnUpdate($sqlUpdate, "tin", $tinPath);
  addColumnUpdate($sqlUpdate, "proofBilling", $proofBillingPath);
  addColumnUpdate($sqlUpdate, "clearanceLoan", $clearanceLoanPath);
  //  CO MAKER 1
  addColumnUpdate($sqlUpdate, "coMaker1", $coMaker1Path);
  addColumnUpdate($sqlUpdate, "validSignatures", $validSignaturesPath);
  addColumnUpdate($sqlUpdate, "monthsPayslip", $monthsPayslipPath);
  addColumnUpdate($sqlUpdate, "itr2", $itr2Path);
  //  CO MAKER 2
  addColumnUpdate($sqlUpdate, "coMaker2", $coMaker2Path);
  addColumnUpdate($sqlUpdate, "validSignatures2", $validSignatures2Path);
  addColumnUpdate($sqlUpdate, "monthsPayslip2", $monthsPayslip2Path);
  addColumnUpdate($sqlUpdate, "itr3", $itr3Path);
  //  DOCUMENTS
  addColumnUpdate($sqlUpdate, "deductRemit", $deductRemitPath);
  addColumnUpdate($sqlUpdate, "cashflowScore", $cashflowScorePath);
  addColumnUpdate($sqlUpdate, "loanAppMemo", $loanAppMemoPath);
  addColumnUpdate($sqlUpdate, "promissoryNoteS", $promissoryNoteSPath);
  addColumnUpdate($sqlUpdate, "disclosureStateS", $disclosureStateSPath);
  addColumnUpdate($sqlUpdate, "mriForm", $mriFormPath);
  addColumnUpdate($sqlUpdate, "amortScheduleS", $amortScheduleSPath);
  addColumnUpdate($sqlUpdate, "utilization", $utilizationPath);
  // LETTER
  addColumnUpdate($sqlUpdate, "sfLetter", $sfLetterPath);
  addColumnUpdate($sqlUpdate, "ssLetter", $ssLetterPath);
  addColumnUpdate($sqlUpdate, "stLetter", $stLetterPath);
  addColumnUpdate($sqlUpdate, "sfdLetter", $sfdLetterPath);
  // LETTER2
  addColumnUpdate($sqlUpdate, "sfLetter2", $sfLetter2Path);
  addColumnUpdate($sqlUpdate, "ssLetter2", $ssLetter2Path);
  addColumnUpdate($sqlUpdate, "stLetter2", $stLetter2Path);
  addColumnUpdate($sqlUpdate, "sfdLetter2", $sfdLetter2Path);
  // LETTER3
  addColumnUpdate($sqlUpdate, "sfLetter3", $sfLetter3Path);
  addColumnUpdate($sqlUpdate, "ssLetter3", $ssLetter3Path);
  addColumnUpdate($sqlUpdate, "stLetter3", $stLetter3Path);
  addColumnUpdate($sqlUpdate, "sfdLetter3", $sfdLetter3Path);
  // OTHER ATTACHMENT
  addColumnUpdate($sqlUpdate, "sclientReq1", $sclientReq1Path); 
  addColumnUpdate($sqlUpdate, "sclientReq2", $sclientReq2Path); 
  addColumnUpdate($sqlUpdate, "sclientReq3", $sclientReq3Path); 
  // LEGAL  
  addColumnUpdate($sqlUpdate, "sffClosure", $sffClosurePath);
  addColumnUpdate($sqlUpdate, "spastDueLitigation", $spastLitigationPath);
  addColumnUpdate($sqlUpdate, "spastDueLitigation2", $spastLitigation2Path);
  addColumnUpdate($sqlUpdate, "sttLitigation", $sttLitigationPath);
  addColumnUpdate($sqlUpdate, "sPrepConso", $sPrepConsoPath);
  addColumnUpdate($sqlUpdate, "saDemand", $saDemandPath);
  addColumnUpdate($sqlUpdate, "spastCheck", $spastCheck);
  // CHECKBOX
  addColumnUpdate($sqlUpdate, "oathTakingCheck", $oathTakingValue);
  addColumnUpdate($sqlUpdate, "cicCheck", $cicValue);
  addColumnUpdate($sqlUpdate, "nfisCheck", $nfisValue);
  addColumnUpdate($sqlUpdate, "kapasyahanCheck", $kapasyahanValue);
  addColumnUpdate($sqlUpdate, "brgyResoCheck", $brgyResoValue);
  addColumnUpdate($sqlUpdate, "canvassVoteCheck", $canvassVoteValue);
  addColumnUpdate($sqlUpdate, "empOfficerCertCheck", $empOfficerCertValue);
  // OTHER
  addColumnUpdate($sqlUpdate, "oathTaking", $oathTakingPath);
  addColumnUpdate($sqlUpdate, "cic", $cicPath);
  addColumnUpdate($sqlUpdate, "nfis", $nfisPath);
  addColumnUpdate($sqlUpdate, "kapasyahan", $kapasyahanPath);
  addColumnUpdate($sqlUpdate, "brgyReso", $brgyResoPath);
  addColumnUpdate($sqlUpdate, "canvassVote", $canvassVotePath);
  addColumnUpdate($sqlUpdate, "empOfficerCert", $empOfficerCertPath);

  // UPLOADING NEXTBANK PRODUCT ID
  $productUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$salaryLoanId'";

  $productQuery = mysqli_query($con, $productUpdate);
  if($productQuery==true){
    echo"productID is working";
  }else{
    echo "not working productID". mysqli_error($con);
  }

// Status of Data
function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
  if (!empty($columnSelect)) {
    $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
    if ($columnSelect == "2") {
      $valueDescription = $columnSelect . "--" . $description;
      $sqlUpdate .= " `$columnStatus` = '$valueDescription',";
    }
  }
}


// STATUS OF DATA VERIFIED/INCOMPLETE
// BORROWER
addStatus($sqlUpdate, "endorsementLetterStatus", $endorsementLetterSelect, $endorsementLetterDesc);
addStatus($sqlUpdate, "loanAppFormStatus", $loanAppFormSelect, $loanAppFormDesc);
addStatus($sqlUpdate, "memoAgreementStatus", $memoAgreementSelect, $memoAgreementSDesc);
addStatus($sqlUpdate, "certofEmploymentStatus", $certEmploymentSelect, $certofEmploymentDesc);
addStatus($sqlUpdate, "latestPayslipStatus", $payslipSelect, $latestPayslipDesc);
addStatus($sqlUpdate, "itr1Status", $itr1Select, $itr1Desc);
addStatus($sqlUpdate, "tinStatus", $tinSelect, $tinDesc);
addStatus($sqlUpdate, "proofBillingStatus", $proofBillingSelect, $proofBillingDesc);
addStatus($sqlUpdate, "clearanceLoanStatus", $clearanceLoanSelect, $clearanceLoanDesc);
// CO MAKER 1
addStatus($sqlUpdate, "coMaker1Status", $coMaker1Select, $coMaker1Desc);
addStatus($sqlUpdate, "validSignaturesStatus", $validSignaturesSelect, $validSignaturesDesc);
addStatus($sqlUpdate, "monthsPayslipStatus", $monthsPayslipSelect, $monthsPayslipDesc);
addStatus($sqlUpdate, "itr2Status", $itr2Select, $itr2Desc);
// CO MAKER 2
addStatus($sqlUpdate, "coMaker2Status", $coMaker2Select, $coMaker2Desc);
addStatus($sqlUpdate, "validSignatures2Status", $validSignatures2Select, $validSignatures2Desc);
addStatus($sqlUpdate, "monthsPayslip2Status", $monthsPayslip2Select, $monthsPayslip2Desc);
addStatus($sqlUpdate, "itr3Status", $itr3Select, $itr3Desc);
// DOCUMENTS
addStatus($sqlUpdate, "deductRemitStatus", $deductRemitSelect, $deductRemitDesc);
addStatus($sqlUpdate, "cashflowScoreStatus", $cashflowScoreSelect, $cashflowScoreDesc);
addStatus($sqlUpdate, "loanAppMemoStatus", $loanAppMemoSelect, $loanAppMemoDesc);
addStatus($sqlUpdate, "promissoryNoteSStatus", $promissoryNoteSSelect, $promissoryNoteSDesc);
addStatus($sqlUpdate, "disclosureStateSStatus", $disclosureStateSSelect, $disclosureStateSDesc);
addStatus($sqlUpdate, "mriFormStatus", $mriFormSelect, $mriFormDesc);
addStatus($sqlUpdate, "amortScheduleSStatus", $amortScheduleSSelect, $amortScheduleSDesc);
addStatus($sqlUpdate, "utilizationStatus", $utilizationSelect, $utilizationDesc);
// LETTER
addStatus($sqlUpdate, "sfLetterRemarks", $sfLetterSelect, "");
addStatus($sqlUpdate, "ssLetterRemarks", $ssLetterSelect, "");
addStatus($sqlUpdate, "stLetterRemarks", $stLetterSelect, "");
addStatus($sqlUpdate, "sfdLetterRemarks", $sfdLetterSelect, "");
// OTHER ATTACHMENT
addStatus($sqlUpdate, "sclientReqRemarks", $sclientReq1Select, "");
// LEGAL
addStatus($sqlUpdate, "sffClosureRemarks", $sffClosureSelect, "");
addStatus($sqlUpdate, "spastLitigationRemarks", $spastLitigationSelect, "");
addStatus($sqlUpdate, "sttLitigationRemarks", $sttLitigationSelect, "");
addStatus($sqlUpdate, "sPrepConsoRemarks", $sPrepConsoSelect, "");
addStatus($sqlUpdate, "saDemandRemarks", $saDemandSelect, "");
// OTHER
addStatus($sqlUpdate, "oathTakingStatus", $oathTakingSelect, $oathTakingDesc);
addStatus($sqlUpdate, "cicStatus", $cicSelect, $cicDesc);
addStatus($sqlUpdate, "nfisStatus", $nfisSelect, $nfisDesc);
addStatus($sqlUpdate, "kapasyahanStatus", $kapasyahanSelect, $kapasyahanDesc);
addStatus($sqlUpdate, "brgyResoStatus", $brgyResoSelect, $brgyResoDesc);
addStatus($sqlUpdate, "canvassVoteStatus", $canvassVoteSelect, $canvassVoteDesc);
addStatus($sqlUpdate, "empOfficerCertStatus", $empOfficerCertSelect, $empOfficerCertDesc);

if (!empty($dateToday)) {
    $sqlUpdate .= " `date_Uploads` = '$dateToday',";
}


$sqlUpdate = rtrim($sqlUpdate, ",");

$sqlUpdate .= " WHERE `salaryLoanId` = '$salaryLoanId'";
$updateQuery = mysqli_query($con, $sqlUpdate);
$dataUpdate = mysqli_insert_id($con);


        // TARGET FOLDER BASE ON BRANCH ADDRESS
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


  if ($updateQuery == true) {

        $archived = "INSERT INTO letterarchive (`loanIds`, 
                                                `firstLetter`, `firstLetter2`, `firstLetter3`, 
                                                `secondLetter`, `secondLetter2`, `secondLetter3`, 
                                                `thirdLetter`, `thirdLetter2`, `thirdLetter3`, 
                                                `finalLetter`, `finalLetter2`, `finalLetter3`,
                                                `clientRequest1`, `clientRequest2`, `clientRequest3`, 
                                                `foreClosure`, 
                                                `pastDueLitigation`, `pastDueLitigation2`, 
                                                `transferLitigation`, `prepConsol`, 
                                                `dueDemandable`, `todaysDate`)
                                            VALUES      
                                                ('$salaryLoanId', 
                                                '$sfLetterPath', '$sfLetter2Path', '$sfLetter3Path', 
                                                '$ssLetterPath', '$ssLetter2Path', '$ssLetter3Path', 
                                                '$stLetterPath', '$stLetter2Path', '$stLetter3Path', 
                                                '$sfdLetterPath', '$sfdLetter2Path', '$sfdLetter3Path', 
                                                '$sclientReq1Path', '$sclientReq2Path', '$sclientReq3Path',
                                                '$sffClosurePath', 
                                                '$spastLitigationPath', '$spastLitigation2Path', 
                                                '$sttLitigationPath', '$sPrepConsoPath',
                                                '$saDemandPath', '$dateToday')";
        $queryarchived = mysqli_query($con, $archived);

        // Call the function with an array of fields to check
        $endorsementLetterName = "ENDORSEMENT LETTER";
        $loanAppFormName="LOAN APPLICATION FORM.";
        $memoAgreementSName="MEMORANDUM OF AGREEMENT.";
        $certofEmploymentName="CERTIFICATE OF EMPLOYMENT.";
        $latestPayslipName="LATEST PAY-SLIP.";
        $itr1Name = "BORROWER ITR";
        $tinName="T.I.N AND/OR ANY 2 VALID I.D.";
        $proofBillingName = "PROOF OF BILLING";
        $clearanceLoanName="BARANGAY CLEARANCE FOR LOAN PURPOSE.";
        $coMaker1Name="CO-MAKER STATEMENT.";
        $validSignaturesName="VALID ID WITH 3 SIGNATURES";
        $monthsPayslip="3 MONTHS PAYSLIP.";
        $itr2Name = "CO-MAKER ITR";
        $itr3Name = "CO-MAKER 2 ITR";

        $oathTakingName = "OATH OF OFFICE";
        $cicName = "CIC";
        $nfisNme = "NFIS";
        $kapasyahanName = "NAKASULAT NA KAPASYAHAN";
        $brgyResoName = "OFFIE OF BRGY. RESOLUTION";
        $canvassVoteName = "CANVASS OF VOTE";
        $empOfficerCertName = "EMPLOYEE & OFFICER CERT.";

        $deductRemitName="ASSIGNMENT OF SALARY & AUTHORITY TO DEDUCT AND REMIT.";
        $cashflowScoreName="FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD.";
        $loanAppMemoName="LOAN APPROVAL MEMO.";
        $promissoryNoteSName="PROMISSORY NOTE.";
        $disclosureStateSName="DISCLOSURE STATEMENT";
        $mriFormName ="INSURANCE DOCUMENTS";
        $amortScheduleSName="AMORTIZATION SCHEDULE.";
        $utilizationName ="LOAN UTILIZATION";

        // sendMail($data['loanAppForm'], $loanAppFormPath, $fullname, $loanAppFormName);
        sendMail($data['endorsementLetter'], $endorsementLetterPath, $fullname, $endorsementLetterName);
        sendMail($data['memoAgreementS'], $memoAgreementSPath, $fullname, $memoAgreementSName);
        sendMail($data['certofEmployment'], $certofEmploymentPath, $fullname, $certofEmploymentName);
        sendMail($data['latestPayslip'], $latestPayslipPath, $fullname, $latestPayslipName);
        sendMail($data['itr1'], $itr1Path, $fullname, $itr1Name);
        sendMail($data['tin'], $tinPath, $fullname, $tinName);
        sendMail($data['proofBilling'], $proofBillingPath, $fullname, $proofBillingName);
        sendMail($data['clearanceLoan'], $clearanceLoanPath, $fullname, $clearanceLoanName);

        sendMail($data['coMaker1'], $coMaker1Path, $fullname, $coMaker1Name);
        sendMail($data['validSignatures'], $validSignaturesPath, $fullname, $validSignaturesName);
        sendMail($data['monthsPayslip'], $monthsPayslipPath, $fullname, $monthsPayslip);
        sendMail($data['itr2'], $itr2Path, $fullname, $itr2Name);

        sendMail($data['coMaker2'], $coMaker2Path, $fullname, $coMaker1Name);
        sendMail($data['validSignatures2'], $validSignatures2Path, $fullname, $coMaker1Name);
        sendMail($data['monthsPayslip2'], $monthsPayslip2Path, $fullname, $monthsPayslip);
        sendMail($data['itr3'], $itr3Path, $fullname, $itr3Name);
    
        sendMail($data['oathTaking'], $oathTakingPath, $fullname, $oathTakingName);
        sendMail($data['kapasyahan'], $kapasyahanPath, $fullname, $kapasyahanName);
        sendMail($data['brgyReso'], $brgyResoPath, $fullname, $brgyResoName);
        sendMail($data['canvassVote'], $canvassVotePath, $fullname, $canvassVoteName);
        sendMail($data['empOfficerCert'], $empOfficerCertPath, $fullname, $empOfficerCertName);

        sendMail($data['deductRemit'], $deductRemitPath, $fullname, $deductRemitName);
        sendMail($data['cashflowScore'], $cashflowScorePath, $fullname, $cashflowScoreName);
        sendMail($data['loanAppMemo'], $loanAppMemoPath, $fullname, $loanAppMemoName);
    
        sendMail($data['promissoryNoteS'], $promissoryNoteSPath, $fullname, $promissoryNoteSName);
        sendMail($data['disclosureStateS'], $disclosureStateSPath, $fullname, $disclosureStateSName);
        sendMail($data['mriForm'], $mriFormPath, $fullname, $mriFormName);
        sendMail($data['amortScheduleS'], $amortScheduleSPath, $fullname, $amortScheduleSName);
        sendMail($data['utilization'], $utilizationPath, $fullname, $utilizationName);

    addColumnUpdate($sqlUpdate, "endorsementLetter", $endorsementLetterPath);
    addColumnUpdate($sqlUpdate, "loanAppForm", $loanAppFormPath);
    addColumnUpdate($sqlUpdate, "memoAgreementS", $memoAgreementSPath);
    addColumnUpdate($sqlUpdate, "certofEmployment", $certofEmploymentPath);
    addColumnUpdate($sqlUpdate, "latestPayslip", $latestPayslipPath);
    addColumnUpdate($sqlUpdate, "itr1", $itr1Path);
    addColumnUpdate($sqlUpdate, "tin", $tinPath);
    addColumnUpdate($sqlUpdate, "proofBilling", $proofBillingPath);
    addColumnUpdate($sqlUpdate, "clearanceLoan", $clearanceLoanPath);
    //  CO MAKER 1
    addColumnUpdate($sqlUpdate, "coMaker1", $coMaker1Path);
    addColumnUpdate($sqlUpdate, "validSignatures", $validSignaturesPath);
    addColumnUpdate($sqlUpdate, "monthsPayslip", $monthsPayslipPath);
    addColumnUpdate($sqlUpdate, "itr2", $itr2Path);
    //  CO MAKER 2
    addColumnUpdate($sqlUpdate, "coMaker2", $coMaker2Path);
    addColumnUpdate($sqlUpdate, "validSignatures2", $validSignatures2Path);
    addColumnUpdate($sqlUpdate, "monthsPayslip2", $monthsPayslip2Path);
    addColumnUpdate($sqlUpdate, "itr3", $itr3Path);
    //  DOCUMENTS
    addColumnUpdate($sqlUpdate, "deductRemit", $deductRemitPath);
    addColumnUpdate($sqlUpdate, "cashflowScore", $cashflowScorePath);
    addColumnUpdate($sqlUpdate, "loanAppMemo", $loanAppMemoPath);
    addColumnUpdate($sqlUpdate, "promissoryNoteS", $promissoryNoteSPath);
    addColumnUpdate($sqlUpdate, "disclosureStateS", $disclosureStateSPath);
    addColumnUpdate($sqlUpdate, "mriForm", $mriFormPath);
    addColumnUpdate($sqlUpdate, "amortScheduleS", $amortScheduleSPath);
    addColumnUpdate($sqlUpdate, "utilization", $utilizationPath);
    // LETTER
    addColumnUpdate($sqlUpdate, "sfLetter", $sfLetterPath);
    addColumnUpdate($sqlUpdate, "ssLetter", $ssLetterPath);
    addColumnUpdate($sqlUpdate, "stLetter", $stLetterPath);
    addColumnUpdate($sqlUpdate, "sfdLetter", $sfdLetterPath);
    // LETTER2
    addColumnUpdate($sqlUpdate, "sfLetter2", $sfLetter2Path);
    addColumnUpdate($sqlUpdate, "ssLetter2", $ssLetter2Path);
    addColumnUpdate($sqlUpdate, "stLetter2", $stLetter2Path);
    addColumnUpdate($sqlUpdate, "sfdLetter2", $sfdLetter2Path);
    // LETTER3
    addColumnUpdate($sqlUpdate, "sfLetter3", $sfLetter3Path);
    addColumnUpdate($sqlUpdate, "ssLetter3", $ssLetter3Path);
    addColumnUpdate($sqlUpdate, "stLetter3", $stLetter3Path);
    addColumnUpdate($sqlUpdate, "sfdLetter3", $sfdLetter3Path);
    // OTHER ATTACHMENT
    addColumnUpdate($sqlUpdate, "sclientReq1", $sclientReq1Path);
    addColumnUpdate($sqlUpdate, "sclientReq2", $sclientReq2Path);
    addColumnUpdate($sqlUpdate, "sclientReq3", $sclientReq3Path);
    // LEGAL  
    addColumnUpdate($sqlUpdate, "sffClosure", $sffClosurePath);
    addColumnUpdate($sqlUpdate, "spastDueLitigation", $spastLitigationPath);
    addColumnUpdate($sqlUpdate, "spastDueLitigation2", $spastLitigation2Path);
    addColumnUpdate($sqlUpdate, "sttLitigation", $sttLitigationPath);
    addColumnUpdate($sqlUpdate, "sPrepConso", $sPrepConsoPath);
    addColumnUpdate($sqlUpdate, "saDemand", $saDemandPath);
    addColumnUpdate($sqlUpdate, "spastCheck", $spastCheck);
    // OTHERS
    addColumnUpdate($sqlUpdate, "oathTaking", $oathTakingPath);
    addColumnUpdate($sqlUpdate, "cic", $cicPath);
    addColumnUpdate($sqlUpdate, "nfis", $nfisPath);
    addColumnUpdate($sqlUpdate, "kapasyahan", $kapasyahanPath);
    addColumnUpdate($sqlUpdate, "brgyReso", $brgyResoPath);
    addColumnUpdate($sqlUpdate, "canvassVote", $canvassVotePath);
    addColumnUpdate($sqlUpdate, "empOfficerCert", $empOfficerCertPath);



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
    addToLocalFiles($localFiles, $endorsementLetterPath);
    addToLocalFiles($localFiles, $loanAppFormPath);
    addToLocalFiles($localFiles, $memoAgreementSPath);
    addToLocalFiles($localFiles, $certofEmploymentPath);
    addToLocalFiles($localFiles, $latestPayslipPath);
    addToLocalFiles($localFiles, $itr1Path);
    addToLocalFiles($localFiles, $tinPath);
    addToLocalFiles($localFiles, $proofBillingPath);
    addToLocalFiles($localFiles, $clearanceLoanPath);
    // CO MAKER 1
    addToLocalFiles($localFiles, $coMaker1Path);
    addToLocalFiles($localFiles, $validSignaturesPath);
    addToLocalFiles($localFiles, $monthsPayslipPath);
    addToLocalFiles($localFiles, $itr2Path);
    // CO MAKER 2
    addToLocalFiles($localFiles, $coMaker2Path);
    addToLocalFiles($localFiles, $validSignatures2Path);
    addToLocalFiles($localFiles, $monthsPayslip2Path);
    addToLocalFiles($localFiles, $itr3Path);
    // DOCUMENTS
    addToLocalFiles($localFiles, $deductRemitPath);
    addToLocalFiles($localFiles, $cashflowScorePath);
    addToLocalFiles($localFiles, $loanAppMemoPath);
    addToLocalFiles($localFiles, $promissoryNoteSPath);
    addToLocalFiles($localFiles, $disclosureStateSPath);
    addToLocalFiles($localFiles, $mriFormPath);
    addToLocalFiles($localFiles, $amortScheduleSPath);
    addToLocalFiles($localFiles, $utilizationPath);
    // LETTER
    addToLocalFiles($localFiles, $sfLetterPath);
    addToLocalFiles($localFiles, $ssLetterPath);
    addToLocalFiles($localFiles, $stLetterPath);
    addToLocalFiles($localFiles, $sfdLetterPath);
    // OTHER ATTACHMENT
    addToLocalFiles($localFiles, $sclientReq1Path);
    addToLocalFiles($localFiles, $sclientReq2Path);
    addToLocalFiles($localFiles, $sclientReq3Path);
    // LEGAL
    addToLocalFiles($localFiles, $sffClosurePath);
    addToLocalFiles($localFiles, $spastLitigationPath);
    addToLocalFiles($localFiles, $sttLitigationPath);
    addToLocalFiles($localFiles, $sPrepConsoPath);
    addToLocalFiles($localFiles, $saDemandPath);
    // OTHER
    addToLocalFiles($localFiles, $oathTakingPath);
    addToLocalFiles($localFiles, $cicPath);
    addToLocalFiles($localFiles, $nfisPath);
    addToLocalFiles($localFiles, $kapasyahanPath);
    addToLocalFiles($localFiles, $brgyResoPath);
    addToLocalFiles($localFiles, $canvassVotePath);
    addToLocalFiles($localFiles, $empOfficerCertPath);


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
        $remoteFile = "LOAN/" . $address . $loanType ."/" . $fullname . '/' . $localName;

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
    echo '<script>alert("error");</script>';
}


} else {
    
  // Data does not exist, perform an INSERT query
  $sqlInsert = "INSERT INTO salaryloan (`salaryLoanId`, `endorsementLetter`, `loanAppForm`, `memoAgreementS`, `certofEmployment`, 
                                        `latestPayslip`, `itr1`, `tin`, `proofBilling`, `clearanceLoan`, `coMaker1`, `validSignatures`, 
                                        `monthsPayslip`, `itr2`, `coMaker2`, `validSignatures2`, `monthsPayslip2`, `itr3`,
                                        `deductRemit`, `cashflowScore`, `loanAppMemo`, `promissoryNoteS`, 
                                        `disclosureStateS`, `amortScheduleS`, `oathTakingCheck`, `cicCheck`, `nfisCheck`, `kapasyahanCheck`, `brgyResoCheck`, `canvassVoteCheck`, `empOfficerCertCheck`,
                                        `oathTaking`, `cic`, `nfis`, `kapasyahan`, `brgyReso`, `canvassVote`,
                                        `sfLetter`, `sfLetter2`, `sfLetter3`, 
                                        `ssLetter`, `ssLetter2`, `ssLetter3`, 
                                        `stLetter`, `stLetter2`, `stLetter3`, 
                                        `sfdLetter`, `sfdLetter2`, `sfdLetter3`, 
                                        `sclientReq1`, `sclientReq2`,  `sclientReq3`, 
                                        `sffClosure`, 
                                        `spastDueLitigation`, `spastDueLitigation2`,
                                        `sttLitigation`, `sPrepConso`, 
                                        `saDemand`)
                                VALUES ('$salaryLoanId', '$endorsementLetterPath', '$loanAppFormPath', '$memoAgreementSPath', '$certofEmploymentPath', 
                                        '$latestPayslipPath', '$itr1Path', '$tinPath', '$proofBillingPath', '$clearanceLoanPath', '$coMaker1Path', '$validSignaturesPath', 
                                        '$monthsPayslipPath', '$itr2Path', '$coMaker2Path', '$validSignatures2Path', '$monthsPayslip2Path', '$itr3Path',
                                        '$deductRemitPath', '$cashflowScorePath', '$loanAppMemoPath', '$promissoryNoteSPath', 
                                        '$disclosureStateSPath', '$amortScheduleSPath', '$oathTakingValue', '$cicValue', '$nfisValue', '$kapasyahanValue', '$brgyResoValue', '$canvassVoteValue', '$empOfficerCertPath',
                                        '$oathTakingPath', '$cicPath', '$nfisPath', '$kapasyahanPath', '$brgyResoPath', '$canvassVotePath',
                                        '$sfLetterPath', '$sfLetter2Path', '$sfdLetter3Path', 
                                        '$ssLetterPath', '$ssLetter2Path', '$ssLetter3Path', 
                                        '$stLetterPath', '$stLetter2Path', '$stLetter3Path', 
                                        '$sfdLetterPath', '$sfdLetter2Path', '$sfdLetter3Path', 
                                        '$sclientReq1Path', '$sclientReq2Path', '$sclientReq3Path',
                                        '$sffClosurePath', 
                                        '$spastLitigationPath', '$spastLitigation2Path', 
                                        '$sttLitigationPath', '$sPrepConsoPath', 
                                        '$saDemandPath')";

  $insertQuery = mysqli_query($con, $sqlInsert);

     // TARGET FOLDER BASE ON BRANCH ADDRESS
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
  
  if ($insertQuery == true) {

        $archived = "INSERT INTO letterarchive (`loanIds`, 
                                                `firstLetter`, `firstLetter2`, `firstLetter3`, 
                                                `secondLetter`, `secondLetter2`, `secondLetter3`, 
                                                `thirdLetter`, `thirdLetter2`, `thirdLetter3`, 
                                                `finalLetter`, `finalLetter2`, `finalLetter3`, 
                                                `clientRequest1`, `clientRequest2`, `clientRequest3`, 
                                                `foreClosure`, 
                                                `pastDueLitigation`, `pastDueLitigation2`, 
                                                `transferLitigation`, `prepConsol`, 
                                                `dueDemandable`, `todaysDate`)
                                            VALUES      
                                                ('$salaryLoanId', 
                                                '$sfLetterPath', '$sfLetter2Path', '$sfLetter3Path', 
                                                '$ssLetterPath', '$ssLetter2Path', '$ssLetter3Path', 
                                                '$stLetterPath', '$stLetter2Path', '$stLetter3Path', 
                                                '$sfdLetterPath', '$sfdLetter2Path', '$sfdLetter3Path',
                                                '$sclientReq1Path', '$sclientReq2Path', '$sclientReq3Path', 
                                                '$sffClosurePath', 
                                                '$spastLitigationPath', '$spastLitigation2Path', 
                                                '$sttLitigationPath', '$sPrepConsoPath',
                                                '$saDemandPath', '$dateToday')";
        $queryarchived = mysqli_query($con, $archived);

        sendMail($data['endorsementLetter'], $endorsementLetterPath, $fullname, $endorsementLetterName);
        sendMail($data['memoAgreementS'], $memoAgreementSPath, $fullname, $memoAgreementSName);
        sendMail($data['certofEmployment'], $certofEmploymentPath, $fullname, $certofEmploymentName);
        sendMail($data['latestPayslip'], $latestPayslipPath, $fullname, $latestPayslipName);
        sendMail($data['itr1'], $itr1Path, $fullname, $itr1Name);
        sendMail($data['tin'], $tinPath, $fullname, $tinName);
        sendMail($data['proofBilling'], $proofBillingPath, $fullname, $proofBillingName);
        sendMail($data['clearanceLoan'], $clearanceLoanPath, $fullname, $clearanceLoanName);

        sendMail($data['coMaker1'], $coMaker1Path, $fullname, $coMaker1Name);
        sendMail($data['validSignatures'], $validSignaturesPath, $fullname, $validSignaturesName);
        sendMail($data['monthsPayslip'], $monthsPayslipPath, $fullname, $monthsPayslip);
        sendMail($data['itr2'], $itr2Path, $fullname, $itr2Name);

        sendMail($data['coMaker2'], $coMaker2Path, $fullname, $coMaker1Name);
        sendMail($data['validSignatures2'], $validSignatures2Path, $fullname, $coMaker1Name);
        sendMail($data['monthsPayslip2'], $monthsPayslip2Path, $fullname, $monthsPayslip);
        sendMail($data['itr3'], $itr3Path, $fullname, $itr3Name);
    
        sendMail($data['oathTaking'], $oathTakingPath, $fullname, $oathTakingName);
        sendMail($data['kapasyahan'], $kapasyahanPath, $fullname, $kapasyahanName);
        sendMail($data['brgyReso'], $brgyResoPath, $fullname, $brgyResoName);
        sendMail($data['canvassVote'], $canvassVotePath, $fullname, $canvassVoteName);
        sendMail($data['empOfficerCert'], $empOfficerCertPath, $fullname, $empOfficerCertName);

        sendMail($data['deductRemit'], $deductRemitPath, $fullname, $deductRemitName);
        sendMail($data['cashflowScore'], $cashflowScorePath, $fullname, $cashflowScoreName);
        sendMail($data['loanAppMemo'], $loanAppMemoPath, $fullname, $loanAppMemoName);
    
        sendMail($data['promissoryNoteS'], $promissoryNoteSPath, $fullname, $promissoryNoteSName);
        sendMail($data['disclosureStateS'], $disclosureStateSPath, $fullname, $disclosureStateSName);
        sendMail($data['mriForm'], $mriFormPath, $fullname, $mriFormName);
        sendMail($data['amortScheduleS'], $amortScheduleSPath, $fullname, $amortScheduleSName);
        sendMail($data['utilization'], $utilizationPath, $fullname, $utilizationName);
    // if($data['saDemand'] != '' && $data['sttLitigation'] != '' && $data['sffClosure'] != '' && $data['sfdLetter'] != '' && $data['stLetter'] != '' && $data['ssLetter'] != '' && $data['sfLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 8 WHERE loan_Id = '$salaryLoanId'";
    // }
    // if($data['saDemand'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$salaryLoanId'";
    // }
    // else if($data['sttLitigation'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$salaryLoanId'";
    // }
    // else if($data['sffClosure'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$salaryLoanId'";
    // }
    // else if($data['sfdLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 4 WHERE loan_Id = '$salaryLoanId' ";
    // }
    // else if($data['stLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 3 WHERE loan_Id = '$salaryLoanId'";
    // }
    // else if($data['ssLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 2 WHERE loan_Id = '$salaryLoanId' ";
    // }
    // else if($data['sfLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 1 WHERE loan_Id = '$salaryLoanId'";
    // }
    // else{
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 0 WHERE loan_Id = '$salaryLoanId'";
    // }
    
    // $updateQueryStats = mysqli_query($con, $updateSqlStats);
    // $dataStats = mysqli_insert_id($con);

    $ftpServer = '10.10.10.117';
    $ftpUsername = "ourbank-tech";
    $ftpPassword = "Juliuspogi2023";
  
    // Local file paths
    $localFiles = [
        // BORROWER
        $endorsementLetterPath,
        $loanAppFormPath,
        $memoAgreementSPath,
        $certofEmploymentPath,
        $latestPayslipPath,
        $itr1Path,
        $tinPath,
        $proofBillingPath,
        $clearanceLoanPath,
        // CO MAKER 1
        $coMaker1Path,
        $validSignaturesPath,
        $monthsPayslipPath,
        $itr2Path,
        // CO MAKER 2
        $coMaker2Path,
        $validSignatures2Path,
        $monthsPayslip2Path,
        $itr3Path,
        // DOCUMENTS         
        $deductRemitPath,
        $cashflowScorePath,
        $loanAppMemoPath,
        $promissoryNoteSPath,
        $disclosureStateSPath,
        $mriFormPath,
        $amortScheduleSPath,
        $utilizationPath,
        // LETTER
        $sfLetterPath,
        $ssLetterPath,
        $stLetterPath,
        $sfdLetterPath,
        // LETTER2
        $sfLetter2Path,
        $ssLetter2Path,
        $stLetter2Path,
        $sfdLetter2Path,
        // LETTER3
        $sfLetter3Path,
        $ssLetter3Path,
        $stLetter3Path,
        $sfdLetter3Path,
        // OTHER ATTACHMENT
        $sclientReq1Path,
        $sclientReq2Path,
        $sclientReq3Path,
        // LEGAL
        $sffClosurePath,
        $spastLitigationPath,
        $spastLitigation2Path,
        $sttLitigationPath,
        $sPrepConsoPath,
        $saDemandPath,
        // OTHER
        $oathTakingPath,
        $cicPath,
        $nfisPath,
        $kapasyahanPath,
        $brgyResoPath,
        $canvassVotePath,
        $empOfficerCertPath
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
    echo "CONNECTED <br>";
  
    // Upload each file
    foreach ($localFiles as $localFile) {
        $localName = explode("/", $localFile)[1];

        // Target Path in File SERVER
        $remoteFile = "LOAN/" . $address . $loanType . "/" . $fullname . '/' . $localName;
  
       
  
        $upload = ftp_put($ftpConnection, $remoteFile, $localFile, FTP_BINARY);
        if ($upload) {
            echo 'File uploaded successfully! Insert<br>';
        } else {
            echo 'Failed to upload the file Insert <br>';
        }
    }
  
    // Close the FTP connection
    ftp_close($ftpConnection);
  
    echo 'All files uploaded successfully!';
  } 
  else {
    echo 'ERROR'  . mysqli_error($con);
  }
  
  
}



     
?>
