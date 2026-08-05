<?php
include('connection.php');
include('fileuploadloan.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y \a\t g:i A');
$holdOutId = $_POST['holdOutId'];
$salaryType = $_POST['salaryType'];
$fullname=$_POST['fullname'];
$branch=$_POST['branch'];
$loanType=$_POST['loanType'];
$productID =$_POST['productID'];
$edit1 = $_POST['edit1'];

//Checking of Check
$bankCertCheck = isset($_POST['bankCertCheck']) ? "Check" : "Uncheck";
$waiverConfiCheck = isset($_POST['waiverConfiCheck']) ? "Check" : "Uncheck";
$waiverSecrecyCheck = isset($_POST['waiverSecrecyCheck']) ? "Check" : "Uncheck";
$cicCheck = isset($_POST['cicCheck']) ? "Check" : "Uncheck";
$nfisCheck = isset($_POST['nfisCheck']) ? "Check" : "Uncheck";
$otherSupportCheck = isset($_POST['otherSupportCheck']) ? "Check" : "Uncheck";

// POST THE VALUE OF THE SELECTION
// BORROWER
$loanAppFormSelect = $_POST['loanAppFormSelect'];
$endorsementSelect = $_POST['endorsementSelect'];
$bankDepositSelect = $_POST['bankDepositSelect'];
$businessPermitSelect = $_POST['businessPermitSelect'];
$borrowerIdSelect = $_POST['borrowerIdSelect'];
$payslipSelect = $_POST['payslipSelect'];
$brgyClearanceSelect = $_POST['brgyClearanceSelect'];
$proofBillingSelect = $_POST['proofBillingSelect'];

// CO-BORROWER
$coBorrowerStatementSelect = $_POST['coBorrowerStatementSelect'];
$coBorrowerIdSelect = $_POST['coBorrowerIdSelect'];
$coBorrowerProofIncomeSelect = $_POST['coBorrowerProofIncomeSelect'];

// CO-MAKER
$coMakerStatementSelect = $_POST['coMakerStatementSelect'];
$coMakerIdSelect = $_POST['coMakerIdSelect'];
$coMakerBusinessPermitSelect = $_POST['coMakerBusinessPermitSelect'];
$coMakerPayslipSelect = $_POST['coMakerPayslipSelect'];

// DOCUMENTS
$cashflowAnalysisSelect = $_POST['cashflowAnalysisSelect'];
$promissoryNoteSelect = $_POST['promissoryNoteSelect'];
$disclosureStatementSelect = $_POST['disclosureStatementSelect'];
$utilizationSelect = $_POST['utilizationSelect'];
$amortizationSchedSelect = $_POST['amortizationSchedSelect'];
$insuranceSelect = $_POST['insuranceSelect'];

// POST ALL THE REMARKS TEXT
// BORROWER
$endorsementDesc = $_POST['endorsementDesc'];
$loanAppFormDesc = $_POST['loanAppFormDesc'];
$bankDepositDesc = $_POST['bankDepositDesc'];
$borrowerIdDesc = $_POST['borrowerIdDesc'];
$businessPermitDesc = $_POST['businessPermitDesc'];
$payslipDesc = $_POST['payslipDesc'];
$brgyClearanceDesc = $_POST['brgyClearanceDesc'];
$proofBillingDesc = $_POST['proofBillingDesc'];

// CO-BORROWER
$coBorrowerStatementDesc = $_POST['coBorrowerStatementDesc'];
$coBorrowerIdDesc = $_POST['coBorrowerIdDesc'];
$coBorrowerProofIncomeDesc = $_POST['coBorrowerProofIncomeDesc'];

// CO-MAKER
$coMakerStatementDesc = $_POST['coMakerStatementDesc'];
$coMakerIdDesc = $_POST['coMakerIdDesc'];
$coMakerBusinessPermitDesc = $_POST['coMakerBusinessPermitDesc'];
$coMakerPayslipDesc = $_POST['coMakerPayslipDesc'];

// DOCUMENTS
$cashflowAnalysisDesc = $_POST['cashflowAnalysisDesc'];
$promissoryNoteDesc = $_POST['promissoryNoteDesc'];
$disclosureStatementDesc = $_POST['disclosureStatementDesc'];
$utilizationDesc = $_POST['utilizationDesc'];
$amortizationSchedDesc = $_POST['amortizationSchedDesc'];
$insuranceDesc= $_POST['insuranceDesc'];

// OTHER SELECT
$bankCertSelect = $_POST['bankCertSelect'];
$waiverConfiSelect = $_POST['waiverConfiSelect'];
$waiverSecrecySelect = $_POST['waiverSecrecySelect'];
$cicSelect = $_POST['cicSelect'];
$nfisSelect = $_POST['nfisSelect'];
$otherSupportSelect = $_POST['otherSupportSelect'];

// OTHER DESC
$bankCertDesc = $_POST['bankCertDesc'];
$waiverConfiDesc = $_POST['waiverConfiDesc'];
$waiverSecrecyDesc = $_POST['waiverSecrecyDesc'];
$cicDesc = $_POST['cicDesc'];
$nfisDesc = $_POST['nfisDesc'];
$otherSupportDesc = $_POST['otherSupportDesc'];

function archiveFile($fileKey, $dbField, $holdOutId, $archiveField, $dateToday, $endPrompt, $con) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        // error_log("In archiveFile - End Prompt: " . $endPrompt);
        
        // Fetch the existing file data from the `holdoutloan` table
        $selectQuery = "SELECT `$dbField` FROM `holdoutloan` WHERE `holdLoanId` = '$holdOutId'";
        $selectResult = mysqli_query($con, $selectQuery);
        
        if ($row = mysqli_fetch_array($selectResult)) {
            $fileData = $row[$dbField];
            
            // Insert the previous data into the `holdoutloanarchive` table
            if($endPrompt != ''){
                $insertQuery = "INSERT INTO `holdoutloanarchive` (`a_holdLoanId`, `$archiveField`, `date_Uploads`, `ah_remarks`)
                                                    VALUES 
                                                            ('$holdOutId', '$fileData', '$dateToday', '$endPrompt')";
                
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
    if (isset($_FILES['endorsement'])) {
        archiveFile('endorsement', 'endorsement', $holdOutId, 'a_endorsement', $dateToday, $endPrompt, $con);
    }
    if (isset($_FILES['loanAppForm'])) {
        archiveFile('loanAppForm', 'loanAppForm', $holdOutId, 'a_loanAppForm', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['bankDeposit'])){
        archiveFile('bankDeposit', 'bankDeposit', $holdOutId, 'a_bankDeposit', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['borrowerId'])){
        archiveFile('borrowerId', 'borrowerId', $holdOutId, 'a_borrowerId', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['businessPermit'])){
        archiveFile('businessPermit', 'businessPermit', $holdOutId, 'a_businessPermit', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['payslip'])){
        archiveFile('payslip', 'payslip', $holdOutId, 'a_payslip', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['brgyClearance'])){
        archiveFile('brgyClearance', 'brgyClearance', $holdOutId, 'a_brgyClearance', $dateToday, $endPrompt, $con);
    }
    
    // // COLLATERAL DOCUMENTS
    if(isset($_FILES['proofBilling'])){
        archiveFile('proofBilling', 'proofBilling', $holdOutId, 'a_proofBilling', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coBorrowerStatement'])){
        archiveFile('coBorrowerStatement', 'coBorrowerStatement', $holdOutId, 'a_coBorrowerStatement', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coBorrowerId'])){
        archiveFile('coBorrowerId', 'coBorrowerId', $holdOutId, 'a_coBorrowerId', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coBorrowerProofIncome'])){
        archiveFile('coBorrowerProofIncome', 'coBorrowerProofIncome', $holdOutId, 'a_coBorrowerProofIncome', $dateToday, $endPrompt, $con);
    }

    // For Renewal
    if(isset($_FILES['coMakerStatement'])){
        archiveFile('coMakerStatement', 'coMakerStatement', $holdOutId, 'a_coMakerStatement', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coMakerId'])){
        archiveFile('coMakerId', 'coMakerId', $holdOutId, 'a_coMakerId', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coMakerBusinessPermit'])){
        archiveFile('coMakerBusinessPermit', 'coMakerBusinessPermit', $holdOutId, 'a_coMakerBusinessPermit', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['coMakerPayslip'])){
        archiveFile('coMakerPayslip', 'coMakerPayslip', $holdOutId, 'a_coMakerPayslip', $dateToday, $endPrompt, $con);
    }

    // Docs Reports
    if(isset($_FILES['cashflowAnalysis'])){
        archiveFile('cashflowAnalysis', 'cashflowAnalysis', $holdOutId, 'a_cashflowAnalysis', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['promissoryNote'])){
        archiveFile('promissoryNote', 'promissoryNote', $holdOutId, 'a_promissoryNote', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['disclosureStatement'])){
        archiveFile('disclosureStatement', 'disclosureStatement', $holdOutId, 'a_disclosureStatement', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['utilization'])){
        archiveFile('utilization', 'utilization', $holdOutId, 'a_utilization', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['amortizationSched'])){
        archiveFile('amortizationSched', 'amortizationSched', $holdOutId, 'a_amortizationSched', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['insurance'])){
        archiveFile('insurance', 'insurance', $holdOutId, 'a_insurance', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['bankCert'])){
        archiveFile('bankCert', 'bankCert', $holdOutId, 'a_bankCert', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['waiverConfi'])){
        archiveFile('waiverConfi', 'waiverConfi', $holdOutId, 'a_waiverConfi', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['waiverSecrecy'])){
        archiveFile('waiverSecrecy', 'waiverSecrecy', $holdOutId, 'a_waiverSecrecy', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['otherSupport'])){
        archiveFile('otherSupport', 'otherSupport', $holdOutId, 'a_otherSupport', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['cic'])){
        archiveFile('cic', 'cic', $holdOutId, 'a_cic', $dateToday, $endPrompt, $con);
    }
    if(isset($_FILES['nfis'])){
        archiveFile('nfis', 'nfis', $holdOutId, 'a_nfis', $dateToday, $endPrompt, $con);
    }

    // // sfLetter
    // if(isset($_FILES['sfLetter'])){
    //     archiveFile('sfLetter', 'sfLetter', $holdOutId, 'a_sfLetter', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['sfLetter2'])){
    //     archiveFile('sfLetter2', 'sfLetter2', $holdOutId, 'a_sfLetter2', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['sfLetter3'])){
    //     archiveFile('sfLetter3', 'sfLetter3', $holdOutId, 'a_sfLetter3', $dateToday, $endPrompt, $con);
    // }
    // // ssLetter
    // if(isset($_FILES['ssLetter'])){
    //     archiveFile('ssLetter', 'ssLetter', $holdOutId, 'a_ssLetter', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['ssLetter2'])){
    //     archiveFile('ssLetter2', 'ssLetter2', $holdOutId, 'a_ssLetter2', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['ssLetter3'])){
    //     archiveFile('ssLetter3', 'ssLetter3', $holdOutId, 'a_ssLetter3', $dateToday, $endPrompt, $con);
    // }
    // // stLetter
    // if(isset($_FILES['stLetter'])){
    //     archiveFile('stLetter', 'stLetter', $holdOutId, 'a_stLetter', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['stLetter2'])){
    //     archiveFile('stLetter2', 'stLetter2', $holdOutId, 'a_stLetter2', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['stLetter3'])){
    //     archiveFile('stLetter3', 'stLetter3', $holdOutId, 'a_stLetter3', $dateToday, $endPrompt, $con);
    // }
    // // sfdLetter
    // if(isset($_FILES['sfdLetter'])){
    //     archiveFile('sfdLetter', 'sfdLetter', $holdOutId, 'a_sfdLetter', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['sfdLetter2'])){
    //     archiveFile('sfdLetter2', 'sfdLetter2', $holdOutId, 'a_sfdLetter2', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['sfdLetter3'])){
    //     archiveFile('sfdLetter3', 'sfdLetter3', $holdOutId, 'a_sfdLetter3', $dateToday, $endPrompt, $con);
    // }

    // // other attachment
    // if(isset($_FILES['sclientReq1'])){
    //     archiveFile('sclientReq1', 'sclientReq1', $holdOutId, 'a_sclientReq1', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['sclientReq2'])){
    //     archiveFile('sclientReq2', 'sclientReq2', $holdOutId, 'a_sclientReq2', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['sclientReq3'])){
    //     archiveFile('sclientReq3', 'sclientReq3', $holdOutId, 'a_sclientReq3', $dateToday, $endPrompt, $con);
    // }

    // // legal
    // if(isset($_FILES['sffClosure'])){
    //     archiveFile('sffClosure', 'sffClosure', $holdOutId, 'a_sffClosure', $dateToday, $endPrompt, $con);
    // }

    // // past due litigation
    // if(isset($_FILES['spastLitigation'])){
    //     archiveFile('spastLitigation', 'spastDueLitigation', $holdOutId, 'a_spastDueLitigation', $dateToday, $endPrompt, $con);
    // }
    // if(isset($_FILES['spastLitigation2'])){
    //     archiveFile('spastLitigation2', 'spastDueLitigation2', $holdOutId, 'a_spastDueLitigation2', $dateToday, $endPrompt, $con);
    // }

    // // tramsfer to ROPA
    // if(isset($_FILES['sttLitigation'])){
    //     archiveFile('sttLitigation', 'sttLitigation', $holdOutId, 'a_sttLitigation', $dateToday, $endPrompt, $con);
    // }

    // // preparation of consolidation
    // if(isset($_FILES['sPrepConso'])){
    //     archiveFile('sPrepConso', 'sPrepConso', $holdOutId, 'a_sPrepConso', $dateToday, $endPrompt, $con);
    // }

    // // due and demandable
    // if(isset($_FILES['saDemand'])){
    //     archiveFile('saDemand', 'saDemand', $holdOutId, 'a_saDemand', $dateToday, $endPrompt, $con);
    // }
    // end
    // end
}


// UPLOAD THE FILES TO LOCALHOST CALLED HOLD-OUT LOAN
// BORROWER
$endorsementFile = upload_file($_FILES['endorsement'], 'holdout', $holdOutId);
$loanAppFormFile = upload_file($_FILES['loanAppForm'], 'holdout', $holdOutId);
$businessPermitFile = upload_file($_FILES['businessPermit'], 'holdout', $holdOutId);
$borrowerIdFile = upload_file($_FILES['borrowerId'], 'holdout', $holdOutId);
$bankCertFile = upload_file($_FILES['bankCert'], 'holdout', $holdOutId);
$payslipFile = upload_file($_FILES['payslip'], 'holdout', $holdOutId);
$brgyClearanceFile = upload_file($_FILES['brgyClearance'], 'holdout', $holdOutId);
$proofBillingFile = upload_file($_FILES['proofBilling'], 'holdout',$holdOutId);
$bankDepositFile = upload_file($_FILES['bankDeposit'], 'holdout',$holdOutId);

// CO-BORROWER
$coBorrowerStatementFile = upload_file($_FILES['coBorrowerStatement'], 'holdout',$holdOutId);
$coBorrowerIdFile = upload_file($_FILES['coBorrowerId'], 'holdout',$holdOutId);
$coBorrowerProofIncomeFile = upload_file($_FILES['coBorrowerProofIncome'], 'holdout',$holdOutId);

// CO-MAKER
$coMakerStatementFile = upload_file($_FILES['coMakerStatement'], 'holdout',$holdOutId);
$coMakerIdFile = upload_file($_FILES['coMakerId'], 'holdout',$holdOutId);
$coMakerBusinessPermitFile = upload_file($_FILES['coMakerBusinessPermit'], 'holdout', $holdOutId);
$coMakerPayslipFile = upload_file($_FILES['coMakerPayslip'], 'holdout', $holdOutId);

// DOCUMENTS
$cashflowAnalysisFile = upload_file($_FILES['cashflowAnalysis'], 'holdout', $holdOutId);
$promissoryNoteFile = upload_file($_FILES['promissoryNote'], 'holdout',$holdOutId);
$disclosureStatementFile = upload_file($_FILES['disclosureStatement'], 'holdout',$holdOutId);
$utilizationFile = upload_file($_FILES['utilization'], 'holdout', $holdOutId);
$amortizationSchedFile = upload_file($_FILES['amortizationSched'], 'holdout',$holdOutId);
$insuranceFile = upload_file($_FILES['insurance'], 'holdout', $holdOutId);

// OTHER
$bankCertFile = upload_file($_FILES['bankCert'], 'holdout', $holdOutId);
$waiverConfiFile = upload_file($_FILES['waiverConfi'], 'holdout', $holdOutId);
$waiverSecrecyFile = upload_file($_FILES['waiverSecrecy'], 'holdout', $holdOutId);
$cicFile = upload_file($_FILES['cic'], 'holdout', $holdOutId);
$nfisFile = upload_file($_FILES['nfis'], 'holdout', $holdOutId);
$otherSupportFile = upload_file($_FILES['otherSupport'], 'holdout', $holdOutId);

// TAKE ALL THE PATH AND PUT THEM IN A VARIABLE FOR DATABASE
// BORROWER
$endorsementPath = $endorsementFile['path'];
$loanAppFormPath = $loanAppFormFile['path'];
$bankDepositPath = $bankDepositFile['path'];
$borrowerIdPath = $borrowerIdFile['path'];
$businessPermitPath = $businessPermitFile['path'];
$payslipPath = $payslipFile['path'];
$brgyClearancePath = $brgyClearanceFile['path'];
$proofBillingPath = $proofBillingFile['path'];

// CO-BORROWER
$coBorrowerStatementPath = $coBorrowerIdFile['path'];
$coBorrowerIdPath = $coBorrowerIdFile['path'];
$coBorrowerProofIncomePath = $coBorrowerProofIncomeFile['path'];

// CO-MAKER
$coMakerStatementPath = $coMakerStatementFile['path'];
$coMakerIdPath = $coMakerIdFile['path'];
$coMakerBusinessPermitPath = $coMakerBusinessPermitFile['path'];
$coMakerPayslipPath = $coMakerPayslipFile['path'];

// DOCUMENTS
$cashflowAnalysisPath = $cashflowAnalysisFile['path'];
$promissoryNotePath = $promissoryNoteFile['path'];
$disclosureStatementPath = $disclosureStatementFile['path'];
$utilizationPath = $utilizationFile['path'];
$amortizationSchedPath = $amortizationSchedFile['path'];
$insurancePath = $insuranceFile['path'];

// OTHER
$bankCertPath = $bankCertFile['path'];
$waiverConfiPath = $waiverConfiFile['path'];
$waiverSecrecyPath = $waiverSecrecyFile['path'];
$cicPath = $cicFile['path'];
$nfisPath = $nfisFile['path'];
$otherSupportPath = $otherSupportFile['path'];

// FUNCTION FOR EMAIL
function sendMail($data,$path,$name, $documents){
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
    $mail -> isHTML(true);
    $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress("cdcruz@ourbank.ph");
    // $mail->addAddress('mark.chester.rivera@ourbank.ph');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('apreyes@ourbank.ph');
    $mail->addAddress('scpayac@ourbank.ph');
    $mail->Subject = "[HOLD-OUT LOAN]" . $name;
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="https://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    <br><br>Customer/Client: <b>' . $name . ' </b>
                    <br><br>DOCUMENTS UPLOADED: <b>' . $documents . '</b>
                    <br>';
    $mail->send();
    }
  }
  function mailMemo($data,$path,$name){
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
    $mail -> isHTML(true);
    $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress("cdcruz@ourbank.ph");
    // $mail->addAddress('mark.chester.rivera@ourbank.ph');
    $mail->addAddress('jlcricafrente@ourbank.ph');
    $mail->addAddress('apreyes@ourbank.ph');
    $mail->addAddress('scpayac@ourbank.ph');
    $mail->Subject = "$name";
    $mail->Body = 'Please click this link to proceed: <a target="_blank" href="https://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
    <br><br>DOCUMENT UPLOADED:<b> LOAN APPROVAL MEMO </b>
    <br>';
    $mail->send();
    }
  }

// Check if the data already exists
$sqlSelect = "SELECT * FROM `holdoutloan` WHERE `holdLoanId` = '$holdOutId'";
$selectQuery = mysqli_query($con, $sqlSelect);
$data = mysqli_fetch_assoc($selectQuery);

if ($data) {
    #comment this if error exist 12-20-2023
    // if(!empty($productID)){
    //     $productsUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$holdLoanId'";
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
  
  $sqlUpdate = "UPDATE `holdoutloan` SET";
  //  BORROWER
  addColumnUpdate($sqlUpdate, "endorsement", $endorsementPath);
  addColumnUpdate($sqlUpdate, "loanAppForm", $loanAppFormPath);
  addColumnUpdate($sqlUpdate, "bankDeposit", $bankDepositPath);
  addColumnUpdate($sqlUpdate, "borrowerId", $borrowerIdPath);
  addColumnUpdate($sqlUpdate, "businessPermit", $businessPermitPath);
  addColumnUpdate($sqlUpdate, "payslip", $payslipPath);
  addColumnUpdate($sqlUpdate, "brgyClearance", $brgyClearancePath);
  addColumnUpdate($sqlUpdate, "proofBilling", $proofBillingPath);

  //  CO-BORROWER
  addColumnUpdate($sqlUpdate, "coBorrowerStatement", $coBorrowerStatementPath);
  addColumnUpdate($sqlUpdate, "coBorrowerId", $coBorrowerIdPath);
  addColumnUpdate($sqlUpdate, "coBorrowerProofIncome", $coBorrowerProofIncomePath);

  //  CO MAKER 
  addColumnUpdate($sqlUpdate, "coMakerStatement", $coMakerStatementPath);
  addColumnUpdate($sqlUpdate, "coMakerId", $coMakerIdPath);
  addColumnUpdate($sqlUpdate, "coMakerBusinessPermit", $coMakerBusinessPermitPath);
  addColumnUpdate($sqlUpdate, "coMakerPayslip", $coMakerPayslipPath);

  //  DOCUMENTS
  addColumnUpdate($sqlUpdate, "cashflowAnalysis", $cashflowAnalysisPath);
  addColumnUpdate($sqlUpdate, "promissoryNote", $promissoryNotePath);
  addColumnUpdate($sqlUpdate, "disclosureStatement", $disclosureStatementPath);
  addColumnUpdate($sqlUpdate, "utilization", $utilizationPath);
  addColumnUpdate($sqlUpdate, "amortizationSched", $amortizationSchedPath);
  addColumnUpdate($sqlUpdate, "insurance", $insurancePath);

  // CHECKBOX
  addColumnUpdate($sqlUpdate, "bankCertCheck", $bankCertCheck);
  addColumnUpdate($sqlUpdate, "waiverConfiCheck", $waiverConfiCheck);
  addColumnUpdate($sqlUpdate, "waiverSecrecyCheck", $waiverSecrecyCheck);
  addColumnUpdate($sqlUpdate, "otherSupportCheck", $otherSupportCheck);
  addColumnUpdate($sqlUpdate, "cicCheck", $cicCheck);
  addColumnUpdate($sqlUpdate, "nfisCheck", $nfisCheck);
  // OTHER
  addColumnUpdate($sqlUpdate, "bankCert", $bankCertPath);
  addColumnUpdate($sqlUpdate, "waiverConfi", $waiverConfiPath);
  addColumnUpdate($sqlUpdate, "waiverSecrecy", $waiverSecrecyPath);
  addColumnUpdate($sqlUpdate, "cic", $cicPath);
  addColumnUpdate($sqlUpdate, "nfis", $nfisPath);
  addColumnUpdate($sqlUpdate, "otherSupport", $otherSupportPath);
  addColumnUpdate($sqlUpdate, "edit1", $edit1);

  // UPLOADING NEXTBANK PRODUCT ID
  $productUpdate = "UPDATE loan SET productID = '$productID' WHERE loan_Id = '$holdOutId'";

  $productQuery = mysqli_query($con, $productUpdate);
  if($productQuery == true){
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
addStatus($sqlUpdate, "endorsementStatus", $endorsementSelect, $endorsementDesc);
addStatus($sqlUpdate, "loanAppFormStatus", $loanAppFormSelect, $loanAppFormDesc);
addStatus($sqlUpdate, "borrowerIdStatus", $borrowerIdSelect, $borrowerIdDesc);
addStatus($sqlUpdate, "bankDepositStatus", $bankDepositSelect, $bankDepositDesc);
addStatus($sqlUpdate, "businessPermitStatus", $businessPermitSelect, $businessPermitDesc);
addStatus($sqlUpdate, "payslipStatus", $payslipSelect, $payslipDesc);
addStatus($sqlUpdate, "brgyClearanceStatus", $brgyClearanceSelect, $brgyClearanceDesc);
addStatus($sqlUpdate, "proofBillingStatus", $proofBillingSelect, $proofBillingDesc);

// // CO-BORROWER
addStatus($sqlUpdate, "coBorrowerStatementStatus", $coBorrowerStatementSelect, $coBorrowerStatementDesc);
addStatus($sqlUpdate, "coBorrowerIdStatus", $coBorrowerIdSelect, $coBorrowerIdDesc);
addStatus($sqlUpdate, "coBorrowerProofIncomeStatus", $coBorrowerProofIncomeSelect, $coBorrowerProofIncomeDesc);

// // CO MAKER 2
addStatus($sqlUpdate, "coMakerStatementStatus", $coMakerStatementSelect, $coMakerStatementDesc);
addStatus($sqlUpdate, "coMakerIdStatus", $coMakerIdSelect, $coMakerIdDesc);
addStatus($sqlUpdate, "coMakerBusinessPermitStatus", $coMakerBusinessPermitSelect, $coMakerBusinessPermitDesc);
addStatus($sqlUpdate, "coMakerPayslipStatus", $coMakerPayslipSelect, $coMakerPayslipDesc);


// // DOCUMENTS
addStatus($sqlUpdate, "cashflowAnalysisStatus", $cashflowAnalysisSelect, $cashflowAnalysisDesc);
addStatus($sqlUpdate, "promissoryNoteStatus", $promissoryNoteSelect, $promissoryNoteDesc);
addStatus($sqlUpdate, "disclosureStatementStatus", $disclosureStatementSelect, $disclosureStatementDesc);
addStatus($sqlUpdate, "utilizationStatus", $utilizationSelect, $utilizationDesc);
addStatus($sqlUpdate, "amortizationSchedStatus", $amortizationSchedSelect, $amortizationSchedDesc);
addStatus($sqlUpdate, "insuranceStatus", $insuranceSelect, $insuranceDesc);

// // OTHER
addStatus($sqlUpdate, "bankCertStatus", $bankCertSelect, $bankCertDesc);
addStatus($sqlUpdate, "waiverConfiStatus", $waiverConfiSelect, $waiverConfiDesc);
addStatus($sqlUpdate, "waiverSecrecyStatus", $waiverSecrecySelect, $waiverSecrecyDesc);
addStatus($sqlUpdate, "cicStatus", $cicSelect, $cicDesc);
addStatus($sqlUpdate, "nfisStatus", $nfisSelect, $nfisDesc);
addStatus($sqlUpdate, "otherSupportStatus", $otherSupportSelect, $otherSupportDesc);

if (!empty($dateToday)) {
    $sqlUpdate .= " `date_Uploads` = '$dateToday',";
}

$sqlUpdate = rtrim($sqlUpdate, ",");

$sqlUpdate .= " WHERE `holdLoanId` = '$holdOutId'";
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


  if ($updateQuery) {
        // Call the function with an array of fields to check
        $endorsementName = "LOAN ENDORSEMENT.";
        $loanAppFormName = "LOAN APPLICATION FORM.";
        $bankDepositName = "DEED OF ASSIGNMENT OF BANK DEPOSIT.";
        $borrowerIdName = "PHOTOCOPY OF (2) VALID ID OF BORROWER.";
        $businessPermitName = "IF BUSINESS, LATEST BUSINESS PERMIT.";
        $payslipName = "IF EMPLOYED, WITH ATLEAST (6) MONTHS PAYSLIP.";
        $brgyClearanceName = "BARANGAY CLEARANCE FOR BANK REQUIREMENTS.";
        $proofBillingName = "PROOF OF LATEST BILLING.";

        $coBorrowerName = "CO-BORROWER STATEMENT.";
        $coBorrowerIdName = "PHOTOCOPY OF (2) VALID ID OF BORROWER.";
        $coBorrowerProofIncomeName = "PROOF OF INCOME(IF APPLICABLE)";

        $coMakerName = "CO-MAKER STATEMENT";
        $coMakerIdName = "PHOTOCOPY OF (2) VALID ID OF BORROWER";
        $coMakerBusinessPermitName = "IF BUSINESS, LATEST BUSINESS PERMIT.";
        $coMakerPayslipName = "IF EMPLOYED, WITH ATLEAST (6) MONTHS PAYSLIP.";

        $bankCertName = "BANK CERTIFICATION WITH CURRENT BALANCE(IF APPLICABLE)";
        $waiverConfiName = "WAIVER OF CONFIDENTIALITY";
        $waiverSecrecyName = "WAIVER OF SECRECY OF DEPOSIT";
        $otherSupportName = "OTHER SUPPORTING DOCS.";

        $cashflowAnalysisName = "FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD.";
        $promissoryNoteName = "PROMISSORY NOTE.";
        $disclosureStatementName = "DISCLOSURE STATEMENT";
        $utilizationName = "LOAN UTILIZATION";
        $amortizationSchedName = "AMORTIZATION SCHEDULE.";
        $insuranceName = "INSURANCE";

        $bankCertName = "BANK CERTIFICATION WITH CURRENT BALANCE";
        $waiverConfiName = "WAIVER OF CONFIDENTIALITY";
        $waiverSecrecyName = "WAIVER OF SECRECY OF DEPOSIT";
        $cicName = "CIC";
        $nfisName = "NFIS";
        $otherSupportName = "SUPPORTING DOCUMENTS";

        sendMail($data['endorsement'], $endorsementPath, $fullname, $endorsementName);
        sendMail($data['loanAppForm'], $loanAppFormPath, $fullname, $loanAppFormName);
        sendMail($data['bankDeposit'], $bankDepositPath, $fullname, $bankDepositName);
        sendMail($data['borrowerId'], $borrowerIdPath, $fullname, $borrowerIdName);
        sendMail($data['businessPermit'], $businessPermitPath, $fullname, $businessPermitName);
        sendMail($data['payslip'], $payslipPath, $fullname, $payslipName);
        sendMail($data['brgyClearance'], $brgyClearancePath, $fullname, $payslipName);
        sendMail($data['proofBilling'], $proofBillingPath, $fullname, $proofBillingName);
        // CO-BORROWER
        sendMail($data['coBorrowerStatement'], $coBorrowerStatementPath, $fullname, $coBorrowerName);
        sendMail($data['coBorrowerId'], $coBorrowerIdPath, $fullname, $coBorrowerIdName);
        sendMail($data['coBorrowerProofIncome'], $coBorrowerProofIncomePath, $fullname, $coBorrowerProofIncomeName);
        // CO-MAKER
        sendMail($data['coMakerStatement'], $coMakerStatementPath, $fullname, $coMakerName);
        sendMail($data['coMakerId'], $coMakerIdPath, $fullname, $coMakerIdName);
        sendMail($data['coMakerBusinessPermit'], $coMakerBusinessPermitPath, $fullname, $coMakerBusinessPermitName);
        sendMail($data['coMakerPayslip'], $coMakerPayslipPath, $fullname, $coMakerPayslipName);
        
        sendMail($data['cashflowAnalysis'], $cashflowAnalysisPath, $fullname, $cashflowAnalysisName);
        sendMail($data['promissoryNote'], $promissoryNotePath, $fullname, $promissoryNoteName);
        sendMail($data['disclosureStatement'], $disclosureStatementPath, $fullname, $disclosureStatementName);
        // sendMail($data['utilization'], $utilizationPath, $fullname, $utilizationName);
        sendMail($data['amortizationSched'], $amortizationSchedPath, $fullname, $amortizationSchedName);
        sendMail($data['insurance'], $insurancePath, $fullname, $insuranceName);

        sendMail($data['bankCert'], $bankCertPath, $fullname, $bankCertName);
        sendMail($data['waiverConfi'], $waiverConfiPath, $fullname, $waiverConfiName);
        sendMail($data['waiverSecrecy'], $waiverSecrecyPath, $fullname, $waiverSecrecyName);
        sendMail($data['cic'], $cicPath, $fullname, $cicName);
        sendMail($data['nfis'], $nfisPath, $fullname, $nfisName);
        sendMail($data['otherSupport'], $otherSuportPath, $fullname, $otherSuportName);

    // addColumnUpdate($sqlUpdate, "endorsement", $endorsementPath);
    // addColumnUpdate($sqlUpdate, "loanAppForm", $loanAppFormPath);
    // addColumnUpdate($sqlUpdate, "bankDeposit", $bankDepositPath);
    // addColumnUpdate($sqlUpdate, "borrowerId", $borrowerIdPath);
    // addColumnUpdate($sqlUpdate, "businessPermit", $businessPermitPath);
    // addColumnUpdate($sqlUpdate, "payslip", $payslipPath);
    // addColumnUpdate($sqlUpdate, "brgyClearance", $brgyClearancePath);
    // addColumnUpdate($sqlUpdate, "proofBilling", $proofBillingPath);
    // //  CO-BORROWER
    // addColumnUpdate($sqlUpdate, "coBorrowerStatement", $coBorrowerStatementPath);
    // addColumnUpdate($sqlUpdate, "coBorrowerId", $coBorrowerIdPath);
    // addColumnUpdate($sqlUpdate, "coBorrowerProofIncome", $coBorrowerProofIncomePath);
    // //  CO-MAKER
    // addColumnUpdate($sqlUpdate, "coMakerStatement", $coMakerStatementPath);
    // addColumnUpdate($sqlUpdate, "coMakerId", $coMakerIdPath);
    // addColumnUpdate($sqlUpdate, "coMakerBusinessPermit", $coMakerBusinessPermitPath);
    // addColumnUpdate($sqlUpdate, "coMakerPayslip", $coMakerPayslipPath);
    // //  DOCUMENTS
    // addColumnUpdate($sqlUpdate, "cashflowAnalysis", $cashflowAnalysisPath);
    // addColumnUpdate($sqlUpdate, "promissoryNote", $promissoryNotePath);
    // addColumnUpdate($sqlUpdate, "disclosureStatement", $disclosureStatementPath);
    // addColumnUpdate($sqlUpdate, "amortizationSched", $amortizationSchedPath);
    // addColumnUpdate($sqlUpdate, "insurance", $insurancePath);
    // // OTHERS
    // addColumnUpdate($sqlUpdate, "bankCert", $bankCertPath);
    // addColumnUpdate($sqlUpdate, "waiverConfi", $waiverConfiPath);
    // addColumnUpdate($sqlUpdate, "waiverSecrecy", $waiverSecrecyPath);



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
    addToLocalFiles($localFiles, $endorsementPath);
    addToLocalFiles($localFiles, $loanAppFormPath);
    addToLocalFiles($localFiles, $bankDepositPath);
    addToLocalFiles($localFiles, $borrowerIdPath);
    addToLocalFiles($localFiles, $businessPermitPath);
    addToLocalFiles($localFiles, $payslipPath);
    addToLocalFiles($localFiles, $brgyClearancePath);
    addToLocalFiles($localFiles, $proofBillingPath);
    // CO-BORROWER
    addToLocalFiles($localFiles, $coBorrowerStatementPath);
    addToLocalFiles($localFiles, $coBorrowerIdPath);
    addToLocalFiles($localFiles, $coBorrowerProofIncomePath);
    // CO-MAKER
    addToLocalFiles($localFiles, $coMakerStatementPath);
    addToLocalFiles($localFiles, $coMakerIdPath);
    addToLocalFiles($localFiles, $coMakerBusinessPermitPath);
    addToLocalFiles($localFiles, $coMakerPayslipPath);
    // DOCUMENTS
    addToLocalFiles($localFiles, $cashflowAnalysisPath);
    addToLocalFiles($localFiles, $promissoryNotePath);
    addToLocalFiles($localFiles, $disclosureStatementPath);
    addToLocalFiles($localFiles, $utilizationPath);
    addToLocalFiles($localFiles, $amortizationSchedPath);
    addToLocalFiles($localFiles, $insurancePath);
    // OTHER
    addToLocalFiles($localFiles, $bankCertPath);
    addToLocalFiles($localFiles, $waiverConfiPath);
    addToLocalFiles($localFiles, $waiverSecrecyPath);
    addToLocalFiles($localFiles, $cicPath);
    addToLocalFiles($localFiles, $nfisPath);
    addToLocalFiles($localFiles, $otherSupportPath);

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
    echo "ERROR". mysqli_error($con);
}


} else {
    
  // Data does not exist, perform an INSERT query
  $sqlInsert = "INSERT INTO `holdoutloan` (`holdLoanId`, `endorsement`, `loanAppForm`, `bankDeposit`, `borrowerId`, 
                                            `businessPermit`, `payslip`, `brgyClearance`, `proofBilling`, 
                                            `coBorrowerStatement`, `coBorrowerId`, `coBorrowerProofIncome`, 
                                            `coMakerStatement`, `coMakerId`, `coMakerBusinessPermit`, `coMakerPayslip`,
                                            `cashflowAnalysis`, `promissoryNote`, `disclosureStatement`, `utilization`, `amortizationSched`, `insurance`,
                                            `bankCertCheck`, `waiverConfiCheck`, `waiverSecrecyCheck`, `cicCheck`, `nfisCheck`, `otherSupportCheck`,
                                            `bankCert`, `waiverConfi`, `waiverSecrecy`, `cic`, `nfis`, `otherSupport`
                                            )
                                    VALUES 
                                        ('$holdOutId', '$endorsementPath', '$loanAppFormPath', '$bankDepositPath', '$borrowerIdPath', 
                                            '$businessPermitPath', '$payslipPath', '$brgyClearancePath', '$proofBillingPath', 
                                            '$coBorrowerStatementPath', '$coBorrowerIdPath', '$coBorrowerProofIncomePath', 
                                            '$coMakerStatementPath', '$coMakerIdPath', '$coMakerBusinessPermitPath', '$coMakerPayslipPath', 
                                            '$cashflowAnalysisPath', '$promissoryNotePath', '$disclosureStatementPath', '$utilizationPath', '$amortizationSchedPath', '$insurancePath',
                                            '$bankCertCheck', '$waiverConfiCheck', '$waiverSecrecyCheck', '$cicCheck', '$nfisCheck', '$otherSupportCheck',
                                            '$bankCertPath', '$waiverConfiPath', '$waiverSecrecyPath', '$cicPath', '$nfisPath', '$otherSupportPath'
                                        )";

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

    sendMail($data['endorsement'], $endorsementPath, $fullname, $endorsementName);
    sendMail($data['loanAppForm'], $loanAppFormPath, $fullname, $loanAppFormName);
    sendMail($data['bankDeposit'], $bankDepositPath, $fullname, $bankDepositName);
    sendMail($data['borrowerId'], $borrowerIdPath, $fullname, $borrowerIdName);
    sendMail($data['businessPermit'], $businessPermitPath, $fullname, $businessPermitName);
    sendMail($data['payslip'], $payslipPath, $fullname, $payslipName);
    sendMail($data['brgyClearance'], $brgyClearancePath, $fullname, $payslipName);
    sendMail($data['proofBilling'], $proofBillingPath, $fullname, $proofBillingName);
    // CO-BORROWER
    sendMail($data['coBorrowerStatement'], $coBorrowerStatementPath, $fullname, $coBorrowerName);
    sendMail($data['coBorrowerId'], $coBorrowerIdPath, $fullname, $coBorrowerIdName);
    sendMail($data['coBorrowerProofIncome'], $coBorrowerProofIncomePath, $fullname, $coBorrowerProofIncomeName);
    // CO-MAKER
    sendMail($data['coMakerStatement'], $coMakerStatementPath, $fullname, $coMakerName);
    sendMail($data['coMakerId'], $coMakerIdPath, $fullname, $coMakerIdName);
    sendMail($data['coMakerBusinessPermit'], $coMakerBusinessPermitPath, $fullname, $coMakerBusinessPermitName);
    sendMail($data['coMakerPayslip'], $coMakerPayslipPath, $fullname, $coMakerPayslipName);
    // OTHER
    sendMail($data['bankCert'], $bankCertPath, $fullname, $bankCertName);
    sendMail($data['waiverConfi'], $waiverConfiSelect, $fullname, $waiverConfiName);
    sendMail($data['waiverSecrecy'], $waiverSecrecyPath, $fullname, $waiverSecrecyName);
    sendMail($data['otherSupport'], $otherSupportPath, $fullname, $otherSupportName);

    sendMail($data['cashflowAnalysis'], $cashflowAnalysisPath, $fullname, $cashflowAnalysisName);
    sendMail($data['promissoryNote'], $promissoryNotePath, $fullname, $promissoryNoteName);
    sendMail($data['disclosureStatement'], $disclosureStatementPath, $fullname, $disclosureStatementName);
    // sendMail($data['utilization'], $utilizationPath, $fullname, $utilizationName);
    sendMail($data['amortizationSched'], $amortizationSchedPath, $fullname, $amortizationSchedName);
    sendMail($data['insurance'], $insurancePath, $fullname, $insuranceName);

    sendMail($data['bankCert'], $bankCertPath, $fullname, $bankCertName);
    sendMail($data['waiverConfi'], $waiverConfiPath, $fullname, $waiverConfiName);
    sendMail($data['waiverSecrecy'], $waiverSecrecyPath, $fullname, $waiverSecrecyName);
    sendMail($data['cic'], $cicPath, $fullname, $cicName);
    sendMail($data['nfis'], $nfisPath, $fullname, $nfisName);
    sendMail($data['otherSupport'], $otherSuportPath, $fullname, $otherSuportName);
    // if($data['saDemand'] != '' && $data['sttLitigation'] != '' && $data['sffClosure'] != '' && $data['sfdLetter'] != '' && $data['stLetter'] != '' && $data['ssLetter'] != '' && $data['sfLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 8 WHERE loan_Id = '$holdLoanId'";
    // }
    // if($data['saDemand'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 7 WHERE loan_Id = '$holdLoanId'";
    // }
    // else if($data['sttLitigation'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 6 WHERE loan_Id = '$holdLoanId'";
    // }
    // else if($data['sffClosure'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 5 WHERE loan_Id = '$holdLoanId'";
    // }
    // else if($data['sfdLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 4 WHERE loan_Id = '$holdLoanId' ";
    // }
    // else if($data['stLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 3 WHERE loan_Id = '$holdLoanId'";
    // }
    // else if($data['ssLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 2 WHERE loan_Id = '$holdLoanId' ";
    // }
    // else if($data['sfLetter'] != ''){
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 1 WHERE loan_Id = '$holdLoanId'";
    // }
    // else{
    //     $updateSqlStats = " UPDATE loan SET `letterStatus` = 0 WHERE loan_Id = '$holdLoanId'";
    // }
    
    // $updateQueryStats = mysqli_query($con, $updateSqlStats);
    // $dataStats = mysqli_insert_id($con);

    $ftpServer = '10.10.10.117';
    $ftpUsername = "ourbank-tech";
    $ftpPassword = "Juliuspogi2023";
  
    // Local file paths
    $localFiles = [
        // BORROWER
        $endorsementPath,
        $loanAppFormPath,
        $bankDepositPath,
        $borrowerIdPath,
        $businessPermitPath,
        $payslipPath,
        $brgyClearancePath,
        $proofBillingPath,

        // CO-BORROWER
        $coBorrowerStatementPath,
        $coBorrowerIdPath,
        $coBorrowerProofIncomePath,

        // CO-MAKER
        $coMakerStatementPath,
        $coMakerIdPath,
        $coMakerBusinessPermitPath,
        $coMakerPayslipPath,

        // DOCUMENTS         
        $cashflowAnalysisPath,
        $promissoryNotePath,
        $disclosureStatementPath,
        $utilizationPath,
        $amortizationSchedPath,
        $insurancePath,
        
        // OTHER
        $bankCertPath,
        $waiverConfiPath,
        $waiverSecrecyPath,
        $cicPath,
        $nfisPath,
        $otherSupportPath
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
  }else {
    echo 'ERROR'  . mysqli_error($con);
  }
}



     
?>
