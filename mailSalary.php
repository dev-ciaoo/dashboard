<?php 
include('connection.php');
include('mailLoan.php');
ini_set('max_execution_time', '0');

?>
SALARY MAILER:
<?php
$sqlSelect = "SELECT * FROM salaryloan JOIN loan ON salaryloan.salaryLoanId = loan.loan_Id WHERE `loan.status` <> 1";
$data = mysqli_query($con, $sqlSelect);
ini_set('display_errors', 1);
error_reporting(E_ALL);

if($data){
    $count = 1;
    while ($row = mysqli_fetch_array($data)) {
        $clientName=$row['customerFullName'];
        echo "Count: " . $count . "." . " $clientName ";
        $count++;
        $branch = $row['branch'];          
        $progress = $row['progress'];
         // BORROWER
         $loanAppForm=$row['loanAppForm'];
         $memoAgreementS=$row['memoAgreementS'];
         $certofEmployment=$row['certofEmployment'];
         $latestPayslip=$row['latestPayslip'];
         $tin=$row['tin'];
         $clearanceLoan=$row['clearanceLoan'];
         // CO MAKER 1
         $coMaker1=$row['coMaker1'];
         $validSignatures=$row['validSignatures'];
         $monthsPayslip=$row['monthsPayslip'];
         // CO MAKER 2
         $coMaker2=$row['coMaker2'];
         $validSignatures2=$row['validSignatures2'];
         $monthsPayslip2=$row['monthsPayslip2'];
         // DOCUMENTS
         $deductRemit=$row['deductRemit'];
         $cashflowScore=$row['cashflowScore'];
         $loanAppMemo=$row['loanAppMemo'];
         $promissoryNoteS=$row['promissoryNoteS'];
         $disclosureStateS=$row['disclosureStateS'];
         $mriForm=$row['mriForm'];
         $amortScheduleS=$row['amortScheduleS'];
         $utilization=$row['utilization'];
         // BORROWER STATUS
         $loanAppFormSelect = $row['loanAppFormStatus'];
         $memoAgreementSelect = $row['memoAgreementStatus'];
         $certEmploymentSelect = $row['certofEmploymentStatus'];
         $payslipSelect = $row['latestPayslipStatus'];
         $tinSelect = $row['tinStatus'];
         $clearanceLoanSelect = $row['clearanceLoanStatus'];
         // CO MAKER 1 STATUS
         $coMaker1Select = $row['coMaker1Status'];
         $validSignaturesSelect = $row['validSignaturesStatus'];
         $monthsPayslipSelect = $row['monthsPayslipStatus'];
         // CO MAKER 2 STATUS
         $coMaker2Select = $row['coMaker2Status'];
         $validSignatures2Select = $row['validSignatures2Status'];
         $monthsPayslip2Select = $row['monthsPayslip2Status'];
         // DOCUEMENTS
         $deductRemitSelect = $row['deductRemitStatus'];
         $cashflowScoreSelect = $row['cashflowScoreStatus'];
         $loanAppMemoSelect = $row['loanAppMemoStatus'];
         $promissoryNoteSSelect = $row['promissoryNoteSStatus'];
         $disclosureStateSSelect = $row['disclosureStateSStatus'];
         $mriFormSelect = $row['mriFormStatus'];
         $amortScheduleSSelect = $row['amortScheduleSStatus'];
         $utilizationSelect = $row['utilizationStatus'];
        
        // Call the function with an array of fields to check
        $loanAppFormName="LOAN APPLICATION FORM.";
        $memoAgreementSName="MEMORANDUM OF AGREEMENT.";
        $certofEmploymentName="CERTIFICATE OF EMPLOYMENT.";
        $latestPayslipName="LATEST PAY-SLIP.";
        $tinName="T.I.N AND/OR ANY 2 VALID I.D.";
        $clearanceLoanName="BARANGAY CLEARANCE FOR LOAN PURPOSE.";
        $coMaker1Name="CO-MAKER STATEMENT.";
        $validSignaturesName="VALID ID WITH 3 SIGNATURES";
        $monthsPayslip="3 MONTHS PAYSLIP.";

        $deductRemitName="ASSIGNMENT OF SALARY & AUTHORITY TO DEDUCT AND REMIT.";
        $cashflowScoreName="FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD.";
        $loanAppMemoName="LOAN APPROVAL MEMO.";
        $promissoryNoteSName="PROMISSORY NOTE.";
        $disclosureStateSName="DISCLOSURE STATEMENT";
        $mriFormName ="INSURANCE DOCUMENTS";
        $amortScheduleSName="AMORTIZATION SCHEDULE.";

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
    
        if($progress =="ONGOING") {

            sendMail($loanAppForm, $loanAppFormSelect, $email, $clientName, $loanAppFormName);
            sendMail($memoAgreementS, $memoAgreementSelect, $email, $clientName, $memoAgreementSName);
            sendMail($certofEmployment, $certEmploymentSelect, $email, $clientName, $certofEmploymentName);
            sendMail($latestPayslip, $payslipSelect, $email, $clientName, $latestPayslipName);
            sendMail($tin, $tinSelect, $email, $clientName, $tinName);
            sendMail($clearanceLoan, $clearanceLoanSelect, $email, $clientName, $clearanceLoanName);

            sendMail($coMaker1, $coMaker1Select, $email, $clientName, $coMaker1Name);
            sendMail($validSignatures, $validSignaturesSelect, $email, $clientName, $validSignaturesName);
            sendMail($monthsPayslip, $monthsPayslipSelect, $email, $clientName, $monthsPayslip);

            sendMail($coMaker2, $coMaker2Select, $email, $clientName, $coMaker1Name);
            sendMail($validSignatures2, $validSignatures2Select, $email, $clientName, $validSignaturesName);
            sendMail($monthsPayslip2, $monthsPayslip2Select, $email, $clientName, $monthsPayslip);

            sendMail($deductRemit, $deductRemitSelect, $email, $clientName, $deductRemitName);


            if(!empty($deductRemit)){
                sendMail($cashflowScore, $cashflowScoreSelect, $email, $clientName, $cashflowScoreName);
                sendMail($loanAppMemo, $loanAppMemoSelect, $email, $clientName, $loanAppMemoName);
            }      

            if(!empty($loanAppMemo)){
                sendMail($promissoryNoteS, $promissoryNoteSSelect, $email, $clientName, $promissoryNoteSName);
                sendMail($disclosureStateS, $disclosureStateSSelect, $email, $clientName, $disclosureStateSName);
                sendMail($mriForm, $mriFormSelect, $email, $clientName, $mriFormName);
                sendMail($amortScheduleS, $amortScheduleSSelect, $email, $clientName, $amortScheduleSName);
            }

         }
         
        }

        }
else{
    echo "DATA ERROR". mysqli_error($con);
}

?>



