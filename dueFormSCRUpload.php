<?php
include('connection.php');
include('fileuploadloan.php');

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';


date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y \a\t g:i A');
$consLoanId = $_POST['consId'];
$salaryType = $_POST['salaryType'];
$fullname=$_POST['fullname'];
$branch=$_POST['branch'];
$loanType=$_POST['loanType'];

$conspastCheck = isset($_POST['conspastCheck']) ? "Yes" : "No";

// POST THE VALUE OF THE SELECTION
// BOR_POSTER
$loanAppForm=$_POST['loanAppForm'];
$memoAgreementS=$_POST['memoAgreementS'];
$certofEmployment=$_POST['certofEmployment'];
$latestPayslip=$_POST['latestPayslip'];
$tin=$_POST['tin'];
$clearanceLoan=$_POST['clearanceLoan'];
// CO MAKER 1
$coMaker1=$_POST['coMaker1'];
$validSignatures=$_POST['validSignatures'];
$monthsPayslip=$_POST['monthsPayslip'];
// CO MAKER 2
$coMaker2=$_POST['coMaker2'];
$validSignatures2=$_POST['validSignatures2'];
$monthsPayslip2=$_POST['monthsPayslip2'];
// DOCUMENTS
$deductRemit=$_POST['deductRemit'];
$cashflowScore=$_POST['cashflowScore'];
$loanAppMemo=$_POST['loanAppMemo'];
$promissoryNoteS=$_POST['promissoryNoteS'];
$disclosureStateS=$_POST['disclosureStateS'];
$amortScheduleS=$_POST['amortScheduleS'];
// LETTER
$consfLetter = $_POST['consfLetter'];
$conssLetter = $_POST['conssLetter'];
$constLetter = $_POST['constLetter'];
$consfdLetter = $_POST['consfdLetter'];
//  LETTER2
$consfLetter2 = $_POST['consfLetter2'];
$conssLetter2 = $_POST['conssLetter2'];
$constLetter2 = $_POST['constLetter2'];
$consfdLetter2 = $_POST['consfdLetter2'];
//  LETTER3
$consfLetter3 = $_POST['consfLetter3'];
$conssLetter3 = $_POST['conssLetter3'];
$constLetter3 = $_POST['constLetter3'];
$consfdLetter3 = $_POST['consfdLetter3'];
// OTHER ATTACHMENT
$clientReq1 = $_POST['clientReq1'];
$clientReq2 = $_POST['clientReq2'];
$clientReq3 = $_POST['clientReq3'];
$clientReq1Select = $_POST['clientReq1Select'];
// LEGAL
$consffClosure = $_POST['consffClosure'];
$conspastLitigation = $_POST['conspastLitigation'];
$conspastLitigation2 = $_POST['conspastLitigation2'];
$consttLitigation = $_POST['consttLitigation'];
$consaDemand = $_POST['consaDemand'];
// BOR_POSTER STATUS
$loanAppFormSelect = $_POST['loanAppFormSelect'];
$memoAgreementSelect = $_POST['memoAgreementSelect'];
$certEmploymentSelect = $_POST['certEmploymentSelect'];
$payslipSelect = $_POST['payslipSelect'];
$tinSelect = $_POST['tinSelect'];
$clearanceLoanSelect = $_POST['clearanceLoanSelect'];
// CO MAKER 1 STATUS
$coMaker1Select = $_POST['coMaker1Select'];
$validSignaturesSelect = $_POST['validSignaturesSelect'];
$monthsPayslipSelect = $_POST['monthsPayslipSelect'];
// CO MAKER 2 STATUS
$coMaker2Select = $_POST['coMaker2Select'];
$validSignatures2Select = $_POST['validSignatures2Select'];
$monthsPayslip2Select = $_POST['monthsPayslip2Select'];
// DOCUEMENTS
$deductRemitSelect = $_POST['deductRemitSelect'];
$cashflowScoreSelect = $_POST['cashflowScoreSelect'];
$loanAppMemoSelect = $_POST['loanAppMemoSelect'];
$promissoryNoteSSelect = $_POST['promissoryNoteSSelect'];
$disclosureStateSSelect = $_POST['disclosureStateSSelect'];
$amortScheduleSSelect = $_POST['amortScheduleSSelect'];
// LETTER SELECT
$consfLetterSelect = $_POST['consfLetterSelect'];
$conssLetterSelect = $_POST['conssLetterSelect'];
$constLetterSelect = $_POST['constLetterSelect'];
$consfdLetterSelect = $_POST['consfdLetterSelect'];
// LEGAL SELECT
$consffClosureSelect = $_POST['consffClosureSelect'];
$conspastLitigationSelect = $_POST['conspastLitigationSelect'];
$consttLitigationSelect = $_POST['consttLitigationSelect'];
$consPrepConsoSelect = $_POST['consPrepConsoSelect'];
$consaDemandSelect = $_POST['consaDemandSelect'];
// POST ALL THE REMARKS TEXT
// BOR_POSTER
$loanAppFormDesc = $_POST['loanAppFormDesc'];
$memoAgreementSDesc = $_POST['memoAgreementSDesc'];
$certofEmploymentDesc = $_POST['certofEmploymentDesc'];
$latestPayslipDesc = $_POST['latestPayslipDesc'];
$tinDesc = $_POST['tinDesc'];
$clearanceLoanDesc = $_POST['clearanceLoanDesc'];
// CO MAKER 1
$coMaker1Desc = $_POST['coMaker1Desc'];
$validSignaturesDesc = $_POST['validSignaturesDesc'];
$monthsPayslipDesc = $_POST['monthsPayslipDesc'];
// CO MAKER 2
$coMaker2Desc = $_POST['coMaker2Desc'];
$validSignatures2Desc = $_POST['validSignatures2Desc'];
$monthsPayslip2Desc = $_POST['monthsPayslip2Desc'];
// DOCUMENTS
$deductRemitDesc = $_POST['deductRemitDesc'];
$cashflowScoreDesc = $_POST['cashflowScoreDesc'];
$loanAppMemoDesc = $_POST['loanAppMemoDesc'];
$promissoryNoteSDesc = $_POST['promissoryNoteSDesc'];
$disclosureStateSDesc = $_POST['disclosureStateSDesc'];
$amortScheduleSDesc = $_POST['amortScheduleSDesc'];
// // LETTER DESC
// $consfLetterDesc = $_POST['consfLetterDesc'];
// $conssLetterDesc = $_POST['conssLetterDesc'];
// $constLetterDesc = $_POST['constLetterDesc'];
// $consfdLetterDesc = $_POST['sfdLetterDesc'];
// // LEGAL
// $consffClosureDesc = $_POST['consffClosureDesc'];
// $consttLitigationDesc = $_POST['consttLitigationDesc'];
// $consaDemandDesc = $_POST['consaDemandDesc'];

function archiveFile($fileKey, $dbField, $loanID, $archiveField, $dateToday, $endPrompt, $con) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        // error_log("In archiveFile - End Prompt: " . $endPrompt);
        
        // Fetch the existing file data from the `individual` table
        $selectQuery = "SELECT `$dbField` FROM `scr` WHERE `consLoanId` = '$loanID'";
        $selectResult = mysqli_query($con, $selectQuery);
        
        if ($row = mysqli_fetch_array($selectResult)) {
            $fileData = $row[$dbField];
            
            // Insert the previous data into the `indivarchive` table
            if($endPrompt != ''){
                $insertQuery = "INSERT INTO `scrarchive` (`a_consLoanId`, `$archiveField`, `a_consdateUpload`, `ac_remarks`)
                                                    VALUES 
                                                            ('$loanID', '$fileData', '$dateToday', '$endPrompt')";
                
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

    // dueCollection
    // cons 1st demand
    if(isset($_FILES['consfLetter'])){
        archiveFile('consfLetter', 'consfLetter', $consLoanId, 'a_consfLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['consfLetter2'])){
        archiveFile('consfLetter2', 'consfLetter2', $consLoanId, 'a_consfLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['consfLetter3'])){
        archiveFile('consfLetter3', 'consfLetter3', $consLoanId, 'a_consfLetter3', $dateToday, $endPrompt, $con);
    }
    // cons 2nd demand
    if(isset($_FILES['conssLetter'])){
        archiveFile('conssLetter', 'conssLetter', $consLoanId, 'a_conssLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['conssLetter2'])){
        archiveFile('conssLetter2', 'conssLetter2', $consLoanId, 'a_conssLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['conssLetter3'])){
        archiveFile('conssLetter3', 'conssLetter3', $consLoanId, 'a_conssLetter3', $dateToday, $endPrompt, $con);
    }
    // cons 3rd demand
    if(isset($_FILES['constLetter'])){
        archiveFile('constLetter', 'constLetter', $consLoanId, 'a_constLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['constLetter2'])){
        archiveFile('constLetter2', 'constLetter2', $consLoanId, 'a_constLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['constLetter3'])){
        archiveFile('constLetter3', 'constLetter3', $consLoanId, 'a_constLetter3', $dateToday, $endPrompt, $con);
    }
    // cons final demand
    if(isset($_FILES['consfdLetter'])){
        archiveFile('consfdLetter', 'consfdLetter', $consLoanId, 'a_consfdLetter', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['consfdLetter2'])){
        archiveFile('consfdLetter2', 'consfdLetter2', $consLoanId, 'a_consfdLetter2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['consfdLetter3'])){
        archiveFile('consfdLetter3', 'consfdLetter3', $consLoanId, 'a_consfdLetter3', $dateToday, $endPrompt, $con);
    }
    // cons other attachment
    if(isset($_FILES['clientReq1'])){
        archiveFile('clientReq1', 'clientReq1', $consLoanId, 'a_clientReq1', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['clientReq2'])){
        archiveFile('clientReq2', 'clientReq2', $consLoanId, 'a_clientReq2', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['clientReq3'])){
        archiveFile('clientReq3', 'clientReq3', $consLoanId, 'a_clientReq3', $dateToday, $endPrompt, $con);
    }
    // cons foreclosure
    if(isset($_FILES['consffClosure'])){
        archiveFile('consffClosure', 'consffClosure', $consLoanId, 'a_consffClosure', $dateToday, $endPrompt, $con);
    }
    // cons past due litigation1
    if(isset($_FILES['conspastLitigation'])){
        archiveFile('conspastLitigation', 'conspastLitigation', $consLoanId, 'a_conspastLitigation', $dateToday, $endPrompt, $con);
    }
    // cons past due litigation2
    if(isset($_FILES['conspastLitigation2'])){
        archiveFile('conspastLitigation2', 'conspastLitigation2', $consLoanId, 'a_conspastLitigation2', $dateToday, $endPrompt, $con);
    }
    // cons transfer to ROPA
    if(isset($_FILES['consttLitigation'])){
        archiveFile('consttLitigation', 'consttLitigation', $consLoanId, 'a_consttLitigation', $dateToday, $endPrompt, $con);
    }
    //cons consolidation
    if(isset($_FILES['consPrepConso'])){
        archiveFile('consPrepConso', 'consPrepConso', $consLoanId, 'a_consPrepConso', $dateToday, $endPrompt, $con);
    }
    // due and demandable
    if(isset($_FILES['consaDemand'])){
        archiveFile('consaDemand', 'consaDemand', $consLoanId, 'a_consaDemand', $dateToday, $endPrompt, $con);
    }
}   


// UPLOAD THE FILES TO LOCALHOST CALLED SALARY LOAN
// BOR_POSTER
$loanAppFormFile = upload_file($_FILES['loanAppForm'], 'scr',$consLoanId);
$memoAgreementSFile = upload_file($_FILES['memoAgreementS'], 'scr',$consLoanId);
$certofEmploymentFile = upload_file($_FILES['certofEmployment'], 'scr',$consLoanId);
$latestPayslipFile = upload_file($_FILES['latestPayslip'], 'scr',$consLoanId);
$tinFile = upload_file($_FILES['tin'], 'scr',$consLoanId);
$clearanceLoanFile = upload_file($_FILES['clearanceLoan'], 'scr',$consLoanId);
// CO MAKER 1
$coMaker1File = upload_file($_FILES['coMaker1'], 'scr',$consLoanId);
$validSignaturesFile = upload_file($_FILES['validSignatures'], 'scr',$consLoanId);
$monthsPayslipFile = upload_file($_FILES['monthsPayslip'], 'scr',$consLoanId);
// CO MAKER 2
$coMaker2File = upload_file($_FILES['coMaker2'], 'scr',$consLoanId);
$validSignatures2File = upload_file($_FILES['validSignatures2'], 'scr',$consLoanId);
$monthsPayslip2File = upload_file($_FILES['monthsPayslip2'], 'scr', $consLoanId);
// DOCUMENTS
$deductRemitFile = upload_file($_FILES['deductRemit'], 'scr', $consLoanId);
$cashflowScoreFile = upload_file($_FILES['cashflowScore'], 'scr', $consLoanId);
$loanAppMemoFile = upload_file($_FILES['loanAppMemo'], 'scr', $consLoanId);
$promissoryNoteSFile = upload_file($_FILES['promissoryNoteS'], 'scr',$consLoanId);
$disclosureStateSFile = upload_file($_FILES['disclosureStateS'], 'scr',$consLoanId);
$amortScheduleSFile= upload_file($_FILES['amortScheduleS'], 'scr',$consLoanId);
// LETTER
$consfLetterFile = upload_file($_FILES['consfLetter'], 'scr', $consLoanId);
$conssLetterFile = upload_file($_FILES['conssLetter'], 'scr', $consLoanId);
$constLetterFile = upload_file($_FILES['constLetter'], 'scr', $consLoanId);
$consfdLetterFile = upload_file($_FILES['consfdLetter'], 'scr', $consLoanId);
// LETTER2
$consfLetter2File= upload_file($_FILES['consfLetter2'], 'scr', $consLoanId);
$conssLetter2File= upload_file($_FILES['conssLetter2'], 'scr',$consLoanId);
$constLetter2File= upload_file($_FILES['constLetter2'], 'scr',$consLoanId);
$consfdLetter2File= upload_file($_FILES['consfdLetter2'], 'scr',$consLoanId);
// LETTER3
$consfLetter3File= upload_file($_FILES['consfLetter3'], 'scr',$consLoanId);
$conssLetter3File= upload_file($_FILES['conssLetter3'], 'scr',$consLoanId);
$constLetter3File= upload_file($_FILES['constLetter3'], 'scr',$consLoanId);
$consfdLetter3File= upload_file($_FILES['consfdLetter3'], 'scr',$consLoanId);
// OTHER ATTACHMENT
$clientReq1File = upload_file($_FILES['clientReq1'], 'scr', $consLoanId);
$clientReq2File = upload_file($_FILES['clientReq2'], 'scr', $consLoanId);
$clientReq3File = upload_file($_FILES['clientReq3'], 'scr', $consLoanId);
// LEGAL
$consffClosureFile = upload_file($_FILES['consffClosure'], 'scr', $consLoanId);
$conspastLitigationFile = upload_file($_FILES['conspastLitigation'], 'scr', $consLoanId);
$conspastLitigation2File = upload_file($_FILES['conspastLitigation2'], 'scr', $consLoanId);
$consttLitigationFile = upload_file($_FILES['consttLitigation'], 'scr', $consLoanId);
$consPrepConsoFile = upload_file($_FILES['consPrepConso'], 'scr', $consLoanId);
$consaDemandFile = upload_file($_FILES['consaDemand'], 'scr', $consLoanId);

// TAKE ALL THE PATH AND PUT THEM IN A VARIABLE FOR DATABASE
// BOR_POSTER
$loanAppFormPath = $loanAppFormFile['path'];
$memoAgreementSPath = $memoAgreementSFile['path'];
$certofEmploymentPath = $certofEmploymentFile['path'];
$latestPayslipPath = $latestPayslipFile['path'];
$tinPath = $tinFile['path'];
$clearanceLoanPath = $clearanceLoanFile['path'];
// CO MAKER 1
$coMaker1Path = $coMaker1File['path'];
$validSignaturesPath = $validSignaturesFile['path'];
$monthsPayslipPath = $monthsPayslipFile['path'];
// CO MAKER 2
$coMaker2Path = $coMaker2File['path'];
$validSignatures2Path = $validSignatures2File['path'];
$monthsPayslip2Path = $monthsPayslip2File['path'];
// DOCUMENTS
$deductRemitPath = $deductRemitFile['path'];
$cashflowScorePath = $cashflowScoreFile['path'];
$loanAppMemoPath = $loanAppMemoFile['path'];
$promissoryNoteSPath = $promissoryNoteSFile['path'];
$disclosureStateSPath = $disclosureStateSFile['path'];
$amortScheduleSPath = $amortScheduleSFile['path'];
// LETTER
$consfLetterPath = $consfLetterFile['path'];
$conssLetterPath = $conssLetterFile['path'];
$constLetterPath = $constLetterFile['path'];
$consfdLetterPath = $consfdLetterFile['path'];
// LETTER2
$consfLetter2Path = $consfLetter2File['path'];
$conssLetter2Path = $conssLetter2File['path'];
$constLetter2Path = $constLetter2File['path'];
$consfdLetter2Path = $consfdLetter2File['path'];
// LETTER3
$consfLetter3Path = $consfLetter3File['path'];
$conssLetter3Path = $conssLetter3File['path'];
$constLetter3Path = $constLetter3File['path'];
$consfdLetter3Path = $consfdLetter3File['path'];
// OTHER ATTACHMENT
$clientReq1Path = $clientReq1File['path'];
$clientReq2Path = $clientReq2File['path'];
$clientReq3Path = $clientReq3File['path'];
// LEGAL
$consffClosurePath = $consffClosureFile['path'];
$conspastLitigationPath = $conspastLitigationFile['path'];
$conspastLitigation2Path = $conspastLitigation2File['path'];
$consttLitigationPath = $consttLitigationFile['path'];
$consPrepConsoPath = $consPrepConsoFile['path'];
$consaDemandPath = $consaDemandFile['path'];

//   LETTER MAILING
function letterMail($data,$path,$name,$email){
    if(!empty($path) && empty($data)){
    $filename = 'request10.jpg';
    $cid = 'my-attach';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail->Password = '0urb@nk-2021';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    // $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    // $mail->addEmbeddedImage($filename, $cid);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress($email);
    $mail->addAddress('lkescano@ourbank.ph');
    $mail->addAddress('josmin.alvarez@ourbank.ph');
    $mail -> isHTML(true);
    $mail->Subject = '[ Collection ]' . $name;
    // $mail->Body = "I hope this message finds you well. I wanted to remind you that the requirements have been uploaded and are ready for you to review.". $name;
    $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                      <br><br>Customer/Client: ' . $name . '<br>';
    $mail->send();
    }
  }


// Check if the data already exists
$sqlSelect = "SELECT * FROM `scr` WHERE `consLoanId` = '$consLoanId'";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if ($data) {
    echo 'Update successful!';
  // Data already exists, perform an UPDATE query

  // check every Database fields, If Data path is not empty it will update
  function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
    if (!empty($columnValue)) {
      $sqlUpdate .= " `$columnName` = '$columnValue',";
    }
  }
  
  $sqlUpdate = "UPDATE scr SET";
  //  BOR_POSTER
  addColumnUpdate($sqlUpdate, "consLoanForm", $loanAppFormPath);
  addColumnUpdate($sqlUpdate, "consMemoAgrmnt", $memoAgreementSPath);
  addColumnUpdate($sqlUpdate, "consCOE", $certofEmploymentPath);
  addColumnUpdate($sqlUpdate, "consLatestPayslip", $latestPayslipPath);
  addColumnUpdate($sqlUpdate, "consTIN", $tinPath);
  addColumnUpdate($sqlUpdate, "consClearanceLoan", $clearanceLoanPath);
  //  CO MAKER 1
  addColumnUpdate($sqlUpdate, "consCoMaker1", $coMaker1Path);
  addColumnUpdate($sqlUpdate, "consValidSign1", $validSignaturesPath);
  addColumnUpdate($sqlUpdate, "consMonthlyPayslip", $monthsPayslipPath);
  //  CO MAKER 2
  addColumnUpdate($sqlUpdate, "consCoMaker2", $coMaker2Path);
  addColumnUpdate($sqlUpdate, "consValidSign2", $validSignatures2Path);
  addColumnUpdate($sqlUpdate, "consMonthlyPayslip2", $monthsPayslip2Path);
  //  DOCUMENTS
  addColumnUpdate($sqlUpdate, "consDeductRemit", $deductRemitPath);
  addColumnUpdate($sqlUpdate, "consCashFlow", $cashflowScorePath);
  addColumnUpdate($sqlUpdate, "consLoanMemo", $loanAppMemoPath);
  addColumnUpdate($sqlUpdate, "consPromisorry", $promissoryNoteSPath);
  addColumnUpdate($sqlUpdate, "consDisclosureS", $disclosureStateSPath);
  addColumnUpdate($sqlUpdate, "consAmortSched", $amortScheduleSPath);
  // LETTER
  addColumnUpdate($sqlUpdate, "consfLetter", $consfLetterPath);
  addColumnUpdate($sqlUpdate, "conssLetter", $conssLetterPath);
  addColumnUpdate($sqlUpdate, "constLetter", $constLetterPath);
  addColumnUpdate($sqlUpdate, "consfdLetter", $consfdLetterPath);
  // LETTER2
  addColumnUpdate($sqlUpdate, "consfLetter2", $consfLetter2Path);
  addColumnUpdate($sqlUpdate, "conssLetter2", $conssLetter2Path);
  addColumnUpdate($sqlUpdate, "constLetter2", $constLetter2Path);
  addColumnUpdate($sqlUpdate, "consfdLetter2", $consfdLetter2Path);
  // LETTER3
  addColumnUpdate($sqlUpdate, "consfLetter3", $consfLetter3Path);
  addColumnUpdate($sqlUpdate, "conssLetter3", $conssLetter3Path);
  addColumnUpdate($sqlUpdate, "constLetter3", $constLetter3Path);
  addColumnUpdate($sqlUpdate, "consfdLetter3", $consfdLetter3Path);
  //OTHER ATTACHMENT
  addColumnUpdate($sqlUpdate, "clientReq1", $clientReq1Path);
  addColumnUpdate($sqlUpdate, "clientReq2", $clientReq2Path);
  addColumnUpdate($sqlUpdate, "clientReq3", $clientReq3Path);
  // LEGAL  
  addColumnUpdate($sqlUpdate, "consffClosure", $consffClosurePath);
  addColumnUpdate($sqlUpdate, "conspastLitigation", $conspastLitigationPath);
  addColumnUpdate($sqlUpdate, "conspastLitigation2", $conspastLitigation2Path);
  addColumnUpdate($sqlUpdate, "consttLitigation", $consttLitigationPath);
  addColumnUpdate($sqlUpdate, "consPrepConso", $consPrepConsoPath);
  addColumnUpdate($sqlUpdate, "consaDemand", $consaDemandPath);
  addColumnUpdate($sqlUpdate, "conspastCheck", $conspastCheck);

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


// Status of Data Verified/Incomplete
// BOR_POSTER
addStatus($sqlUpdate, "consLoanFormStatus", $loanAppFormSelect, $loanAppFormDesc);
addStatus($sqlUpdate, "consMeMoAgrmntStatus", $memoAgreementSelect, $memoAgreementSDesc);
addStatus($sqlUpdate, "consCOEStatus", $certEmploymentSelect, $certofEmploymentDesc);
addStatus($sqlUpdate, "consLatestPayslipStatus", $payslipSelect, $latestPayslipDesc);
addStatus($sqlUpdate, "consTINStatus", $tinSelect, $tinDesc);
addStatus($sqlUpdate, "consClearanceStatus", $clearanceLoanSelect, $clearanceLoanDesc);
// CO MAKER 1
addStatus($sqlUpdate, "consCoMaker1Status", $coMaker1Select, $coMaker1Desc);
addStatus($sqlUpdate, "consValidSign1Status", $validSignaturesSelect, $validSignaturesDesc);
addStatus($sqlUpdate, "consMonthlyPayslip1Status", $monthsPayslipSelect, $monthsPayslipDesc);
// CO MAKER 2
addStatus($sqlUpdate, "consCoMaker2Status", $coMaker2Select, $coMaker2Desc);
addStatus($sqlUpdate, "consValidSign2Status", $validSignatures2Select, $validSignatures2Desc);
addStatus($sqlUpdate, "consMonthlyPayslip2Status", $monthsPayslip2Select, $monthsPayslip2Desc);
// DOCUMENTS
addStatus($sqlUpdate, "consDeductRemitStatus", $deductRemitSelect, $deductRemitDesc);
addStatus($sqlUpdate, "consCashFlowStatus", $cashflowScoreSelect, $cashflowScoreDesc);
addStatus($sqlUpdate, "consLoanMemoStatus", $loanAppMemoSelect, $loanAppMemoDesc);
addStatus($sqlUpdate, "consPromisorryStatus", $promissoryNoteSSelect, $promissoryNoteSDesc);
addStatus($sqlUpdate, "consDisclosureSStatus", $disclosureStateSSelect, $disclosureStateSDesc);
addStatus($sqlUpdate, "consAmortSchedStatus", $amortScheduleSSelect, $amortScheduleSDesc);
// LETTER
addStatus($sqlUpdate, "consfLetterRemarks", $consfLetterSelect, "");
addStatus($sqlUpdate, "conssLetterRemarks", $conssLetterSelect, "");
addStatus($sqlUpdate, "constLetterRemarks", $constLetterSelect, "");
addStatus($sqlUpdate, "consfdLetterRemarks", $consfdLetterSelect, "");
// OTHER ATTACHMENT
addStatus($sqlUpdate, "clientReqRemarks", $clientReq1Select, "");
// LEGAL
addStatus($sqlUpdate, "consffClosureRemarks", $consffClosureSelect, "");
addStatus($sqlUpdate, "conspastLitigationRemarks", $conspastLitigationSelect, "");
addStatus($sqlUpdate, "consttLitigationRemarks", $consttLitigationSelect, "");
addStatus($sqlUpdate, "consPrepConsoRemarks", $consPrepConsoSelect, "");
addStatus($sqlUpdate, "saDemandRemarks", $saDemandSelect, "");

if (!empty($dateToday)) {
    $sqlUpdate .= " `consdateUpload` = '$dateToday',";
}


$sqlUpdate = rtrim($sqlUpdate, ",");

$sqlUpdate .= " WHERE `consLoanId` = '$consLoanId'";
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

    

  // Check if the UPDATE query was successful
  if ($updateQuery == true) {

    $archived = "INSERT INTO letterarchive (`loanIds`, `firstLetter`, `firstLetter2`, 
                                            `firstLetter3`, `secondLetter`, `secondLetter2`, 
                                            `secondLetter3`, `thirdLetter`, `thirdLetter2`, 
                                            `thirdLetter3`, `finalLetter`, `finalLetter2`, 
                                            `finalLetter3`, 
                                            `clientReq1`, `clientReq2`, `clientReq3`,
                                            `foreClosure`, `pastDueLitigation`, 
                                            `pastDueLitigation2`, `transferLitigation`, `prepConsol`, 
                                            `dueDemandable`, `todaysDate`)
                                        VALUES      
                                            ('$consLoanId', '$consfLetterPath', '$consfLetter2Path', 
                                            '$consfLetter3Path', '$conssLetterPath', '$conssLetter2Path',
                                            '$conssLetter3Path', '$constLetterPath', '$constLetter2Path',
                                            '$constLetter3Path', '$consfdLetterPath', '$consfdLetter2Path',
                                            '$consfdLetter3Path', 
                                            '$clientReq1Path', '$clientReq2Path', '$clientReq3Path',
                                            '$consffClosurePath', '$consttLitigationPath',
                                            '', '', '',
                                            '$consaDemandPath', '$dateToday')";
    $queryarchived = mysqli_query($con, $archived);


    // LETTER MAILING
    letterMail($data['consfLetter'], $consfLetterPath, $fullname, "");
    letterMail($data['conssLetter'], $conssLetterPath, $fullname, "");
    letterMail($data['constLetter'], $constLetterPath, $fullname, "");
    letterMail($data['consfdLetter'], $consfdLetterPath, $fullname, "");
    letterMail($data['consfLetter2'], $consfLetter2Path, $fullname, "");
    letterMail($data['conssLetter2'], $conssLetter2Path, $fullname, "");
    letterMail($data['constLetter2'], $constLetter2Path, $fullname, "");
    letterMail($data['consfdLetter2'], $consfdLetter2Path, $fullname, "");
    letterMail($data['consfLetter3'], $consfLetter3Path, $fullname, "");
    letterMail($data['conssLetter3'], $conssLetter3Path, $fullname, "");
    letterMail($data['constLetter3'], $constLetter3Path, $fullname, "");
    letterMail($data['consfdLetter3'], $consfdLetter3Path, $fullname, "");
    // LEGAL
    letterMail($data['consffClosure'], $consffClosurePath, $fullname, "");
    letterMail($data['consttLitigation'], $consttLitigationPath, $fullname, "");
    letterMail($data['consaDemand'], $consaDemandPath, $fullname, "");

    if($consaDemandPath != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$consLoanId'";
    }
    else if($consttLitigationPath != '' && $conspastLitigation2Path != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$consLoanId'";
    }
    else if($consffClosurepath != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$consLoanId'";
    }
    else if($consfdLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 4, `remarks` = '$consfdLetterSelect' WHERE loan_Id = '$consLoanId' ";
    }
    else if($constLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 3, `remarks` = '$constLetterSelect' WHERE loan_Id = '$consLoanId'";
    }
    else if($conssLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 2, `remarks` = '$conssLetterSelect' WHERE loan_Id = '$consLoanId' ";
    }
    else if($consfLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 1, `remarks` = '$consfLetterSelect' WHERE loan_Id = '$consLoanId'";
    }
    else{
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
    // BOR_POSTER
    addToLocalFiles($localFiles, $loanAppFormPath);
    addToLocalFiles($localFiles, $memoAgreementSPath);
    addToLocalFiles($localFiles, $certofEmploymentPath);
    addToLocalFiles($localFiles, $latestPayslipPath);
    addToLocalFiles($localFiles, $tinPath);
    addToLocalFiles($localFiles, $clearanceLoanPath);
    // CO MAKER 1
    addToLocalFiles($localFiles, $coMaker1Path);
    addToLocalFiles($localFiles, $validSignaturesPath);
    addToLocalFiles($localFiles, $monthsPayslipPath);
    // CO MAKER 2
    addToLocalFiles($localFiles, $coMaker2Path);
    addToLocalFiles($localFiles, $validSignatures2Path);
    addToLocalFiles($localFiles, $monthsPayslip2Path);
    // DOCUMENTS
    addToLocalFiles($localFiles, $deductRemitPath);
    addToLocalFiles($localFiles, $cashflowScorePath);
    addToLocalFiles($localFiles, $loanAppMemoPath);
    addToLocalFiles($localFiles, $promissoryNoteSPath);
    addToLocalFiles($localFiles, $disclosureStateSPath);
    addToLocalFiles($localFiles, $amortScheduleSPath);
    // LETTER
    addToLocalFiles($localFiles, $consfLetterPath);
    addToLocalFiles($localFiles, $conssLetterPath);
    addToLocalFiles($localFiles, $constLetterPath);
    addToLocalFiles($localFiles, $consfdLetterPath);
    // LETTER2
    addToLocalFiles($localFiles, $consfLetter2Path);
    addToLocalFiles($localFiles, $conssLetter2Path);
    addToLocalFiles($localFiles, $constLetter2Path);
    addToLocalFiles($localFiles, $consfdLetter2Path);
    // LETTER3
    addToLocalFiles($localFiles, $consfLetter3Path);
    addToLocalFiles($localFiles, $conssLetter3Path);
    addToLocalFiles($localFiles, $constLetter3Path);
    addToLocalFiles($localFiles, $consfdLetter3Path);
    //OTHER ATTACHMENT
    addToLocalFiles($localFiles, $clientReq1Path);
    addToLocalFiles($localFiles, $clientReq2Path);
    addToLocalFiles($localFiles, $clientReq3Path);
    // LEGAL
    addToLocalFiles($localFiles, $consffClosurePath);
    addToLocalFiles($localFiles, $conspastLitigationPath);
    addToLocalFiles($localFiles, $conspastLitigation2Path);
    addToLocalFiles($localFiles, $consttLitigationPath);
    addToLocalFiles($localFiles, $consPrepConsoPath);
    addToLocalFiles($localFiles, $consaDemandPath);

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
        $remoteFile = "vcdyoshino/" . $address . $loanType ."/" . $fullname . '/' . $localName;

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
    echo 'ERROR'  . mysqli_error($con);
}


} else {
    if($_SESSION['username'] == 'ctborgonia' || $_SESSION['username'] == 'jcvillanueva' || $_SESSION['department'] == '6' || $_SESSION['position'] == 'BM'
        || $_SESSION['username'] == 'hmmendoza' || $_SESSION['username'] == 'cgluda' || $_SESSION['username'] == 'jabportillo'){
        $sqlInsert = "INSERT INTO scr (`consLoanId`, 
                                          `consfLetter`, `consfLetter2`, `consfLetter3`, 
                                          `conssLetter`, `conssLetter2`, `conssLetter3`, 
                                          `constLetter`, `constLetter2`, `constLetter3`, 
                                          `consfdLetter`, `consfdLetter2`, `consfdLetter3`, 
                                          `clientReq1`, `clientReq2`, `clientReq3`,
                                          `consffClosure`, `conspastLitigation`, `conspastLitigation2`,
                                          `consttLitigation`, `consPrepConso`, `consaDemand`, `consdateUpload`) 
                                VALUES 
                                        ('$consLoanId', 
                                        '$consfLetterPath', '$consfLetter2Path', '$consfLetter3Path', 
                                        '$conssLetterPath', '$conssLetter2Path', '$conssLetter3Path', 
                                        '$constLetterPath', '$constLetter2Path', '$constLetter3Path', 
                                        '$consfdLetterPath', '$consfdLetter2Path', '$consfdLetter3Path', 
                                        '$clientReq1Path', '$clientReq2Path', '$clientReq3Path',
                                        '$consffClosurepath', '$conspastLitigationPath', '$conspastLitigation2Path',
                                        '$consttLitigationPath', '$consPrepConsoPath', '$consaDemandPath', '$dateToday')";
    }else{
        // Data does not exist, perform an INSERT query
        $sqlInsert = "INSERT INTO scr (`consLoanId`, `loanAppForm`, `memoAgreementS`, `certofEmployment`, 
                                                `latestPayslip`, `tin`, `clearanceLoan`, `coMaker1`, `validSignatures`, 
                                                `monthsPayslip`, `coMaker2`, `validSignatures2`, `monthsPayslip2`, 
                                                `deductRemit`, `cashflowScore`, `loanAppMemo`, `promissoryNoteS`, 
                                                `disclosureStateS`, `amortScheduleS`, `consdateUpload`)
                                        VALUES 
                                                ('$consLoanId', '$loanAppFormPath', '$memoAgreementSPath', '$certofEmploymentPath', 
                                                '$latestPayslipPath', '$tinPath', '$clearanceLoanPath', '$coMaker1Path', '$validSignaturesPath', 
                                                '$monthsPayslipPath', '$coMaker2Path', '$validSignatures2Path', '$monthsPayslip2Path', 
                                                '$deductRemitPath', '$cashflowScorePath', '$loanAppMemoPath', '$promissoryNoteSPath', 
                                                '$disclosureStateSPath', '$amortScheduleSPath', '$dateToday')";
    }
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
                                            ('$consLoanId', '$consfLetterPath', '$consfLetter2Path', 
                                            '$consfLetter3Path', '$conssLetterPath', '$conssLetter2Path',
                                            '$conssLetter3Path', '$constLetterPath', '$constLetter2Path',
                                            '$constLetter3Path', 
                                            '$clientReq1Path', '$clientReq2Path', '$clientReq3Path',
                                            '$consfdLetterPath', '$consfdLetter2Path',
                                            '$consfdLetter3Path', '$consffClosurePath', '$consttLitigationPath',
                                            '', '', '',
                                            '$consaDemandPath', '$dateToday')";
    $queryarchived = mysqli_query($con, $archived);

    letterMail($data['consfLetter'], $consfLetterPath, $fullname, "");
    letterMail($data['conssLetter'], $conssLetterPath, $fullname, "");
    letterMail($data['constLetter'], $constLetterPath, $fullname, "");
    letterMail($data['consfdLetter'], $consfdLetterPath, $fullname, "");
    letterMail($data['consfLetter2'], $consfLetter2Path, $fullname, "");
    letterMail($data['conssLetter2'], $conssLetter2Path, $fullname, "");
    letterMail($data['constLetter2'], $constLetter2Path, $fullname, "");
    letterMail($data['consfdLetter2'], $consfdLetter2Path, $fullname, "");
    letterMail($data['consfLetter3'], $consfLetter3Path, $fullname, "");
    letterMail($data['conssLetter3'], $conssLetter3Path, $fullname, "");
    letterMail($data['constLetter3'], $constLetter3Path, $fullname, "");
    letterMail($data['consfdLetter3'], $consfdLetter3Path, $fullname, "");
    // LEGAL
    letterMail($data['consffClosure'], $consffClosurePath, $fullname, "");
    letterMail($data['consttLitigation'], $consttLitigationPath, $fullname, "");
    letterMail($data['consaDemand'], $consaDemandPath, $fullname, "");
    // if($data['saDemand'] != '' && $data['sttLitigation'] != '' && $data['sffClosure'] != '' && $data['sfdLetter'] != '' && $data['stLetter'] != '' && $data['ssLetter'] != '' && $data['sfLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 8 WHERE loan_Id = '$consLoanId'";
    // }
    if($consaDemandPath != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$consLoanId'";
    }
    else if($consttLitigationPath != '' && $conspastLitigation2Path != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$consLoanId'";
    }
    else if($consffClosurepath != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$consLoanId'";
    }
    else if($consfdLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 4 WHERE loan_Id = '$consLoanId' ";
    }
    else if($constLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 3 WHERE loan_Id = '$consLoanId'";
    }
    else if($conssLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 2 WHERE loan_Id = '$consLoanId' ";
    }
    else if($consfLetterSelect != ''){
        $updateSqlStats = " UPDATE loan SET `letterStatus` = 1 WHERE loan_Id = '$consLoanId'";
    }
    else{
    }
    
    $updateQueryStats = mysqli_query($con, $updateSqlStats);
    $dataStats = mysqli_insert_id($con);

    $ftpServer = '10.10.10.117';
    $ftpUsername = "ourbank-tech";
    $ftpPassword = "Juliuspogi2023";
  
    // Local file paths
    $localFiles = [
        // BOR_POSTER
        $loanAppFormPath,
        $memoAgreementSPath,
        $certofEmploymentPath,
        $latestPayslipPath,
        $tinPath,
        $clearanceLoanPath,
        // CO MAKER 1
        $coMaker1Path,
        $validSignaturesPath,
        $monthsPayslipPath,
        // CO MAKER 2
        $coMaker2Path,
        $validSignatures2Path,
        $monthsPayslip2Path,
        // DOCUMENTS         
        $deductRemitPath,
        $cashflowScorePath,
        $loanAppMemoPath,
        $promissoryNoteSPath,
        $disclosureStateSPath,
        $amortScheduleSPath,
        // LETTER
        $consfLetterPath,
        $conssLetterPath,
        $constLetterPath,
        $consfdLetterPath,
        // LETTER2
        $consfLetter2Path,
        $conssLetter2Path,
        $constLetter2Path,
        $consfdLetter2Path,
        // LETTER3
        $consfLetter3Path,
        $conssLetter3Path,
        $constLetter3Path,
        $consfdLetter3Path,
        // OTHER ATTACHMENT
        $clientReq1Path,
        $clientReq2Path,
        $clientReq3Path,
        // LEGAL
        $consffClosurePath,
        $conspastLitigationPath,
        $conspastLitigation2Path,
        $consttLitigationPath,
        $consPrepConsoPath,
        $consaDemandPath
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
        $remoteFile = "vcdyoshino/" . $address . $loanType . "/" . $fullname . '/' . $localName;
  
       
  
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
