<?php 
include('connection.php');
ini_set('max_execution_time', '0');
include('mailLoan.php');
?>

MICROFINANCE MAILER:
<?php

$sqlSelect = "SELECT * FROM microfinance JOIN loan ON microfinance.mLoan_Id = loan.loan_Id WHERE `loan.status` <> 1";
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
            $loanAppFormM = $row['loanAppFormM'];
            $borrower_Idsignature = $row['mborrower_IdSign'];
            $borrower_Lbp = $row['mborrower_Lbp'];
            $borrower_Lpb = $row['mborrower_Lpb'];
            // CO-BORROWER
            $coborrowerStatement = $row['coborrowerStatement'];
            $coBorrowerIdSign = $row['mcoBorrower_Id'];
            $proofIncome=$row['proofIncome'];
            // CO-MAKER
            $comakerStatement = $row['comakerStatement'];  
            $coMakerIdWithSign = $row['mcoMaker_IdSign'];
            $latestPermit = $row['mcoMaker_Lbp'];
            $coMakerPayslip = $row['mcoMaker_Payslip']; 
            // RENEWAL
            $businessValidation = $row['businessValidation'];  
            $loanInstallment = $row['loanInstallment'];
            $loanPayment = $row['loanPayment'];
            $statementAccount = $row['statementAccount']; 

            //OTHERS
            $businessPicture = $row['businessPicture'];
            $otherSuport = $row['otherSuport']; 
            // DOCUMENTS
            $validCardReport = $row['validCardReport'];
            $creditReport = $row['creditReport'];
            $creditInvestigationReportM = $row['creditInvestigationReportM'];
            $debitWaiver = $row['debitWaiver']; 
            $affidavitSurrender = $row['affidavitSurrender'];
            $riskRating = $row['riskRating'];
            $loanApprovalSheet = $row['loanApprovalSheet'];
            // AFTER RELASE
            $promissoryNoteM = $row['promissoryNoteM'];  
            $disclosureStateM = $row['disclosureStateM'];
            $mriForm = $row['mriForm'];
            $amortScheduleM = $row['amortScheduleM'];
            $utilization = $row['utilization'];
            //CHECKBOX
            $businessPictureCheck = $row['businessPictureCheck'];
            $otherSuportCheck = $row['otherSuportCheck']; 
            $renewalCheck = $row['renewalCheck']; 
            $edit1 = $row['edit1']; 

            
            // BORROWER STATUS
            $loanAppFormMSelect=$row['loanAppFormMStatus'];
            $borrower_IdSignSelect = $row['mborrower_IdSignStatus'];
            $borrower_LbpSelect = $row['mborrower_LbpStatus'];
            $borrower_LpbSelect = $row['mborrower_LpbStatus'];
            // CO-BORROWER STATUS
            $coborrowerStatementSelect=$row['coborrowerStatementStatus'];
            $coBorrower_IdSignSelect = $row['mcoBorrower_IdSignStatus'];
            $proofIncomeSelect = $row['proofIncomeStatus'];
            // CO-MAKER STATUS
            $comakerStatementSelect= $row['comakerStatementStatus'];
            $coMaker_IdSignSelect = $row['mcoMaker_IdSignStatus'];
            $coMaker_LbpSelect = $row['mcoMaker_LbpStatus'];
            $coMaker_PayslipSelect = $row['mcoMaker_PayslipStatus'];
            // RENEWAL
            $businessValidationSelect= $row['businessValidationStatus'];
            $loanInstallmentSelect = $row['loanInstallmentStatus'];
            $loanPaymentSelect = $row['loanPaymentStatus'];
            $statementAccountSelect = $row['statementAccountStatus'];
            // OTHERS
            $businessPictureSelect = $row['businessPictureStatus'];
            $otherSuportSelect = $row['otherSuportStatus'];
            // DOCUMENTS STATUS
            $validCardReportSelect = $row['validCardReportStatus'];
            $creditReportSelect = $row['creditReportStatus'];
            $creditInvestigationReportMSelect = $row['creditInvestigationReportMStatus'];
            $debitWaiverSelect = $row['debitWaiverStatus']; 
            $affidavitSurrenderSelect = $row['affidavitSurrenderStatus'];
            $riskRatingSelect = $row['riskRatingStatus'];
            $loanApprovalSheetSelect = $row['loanApprovalSheetStatus'];
            // AFTER RELASE STATUS
            $promissoryNoteMSelect = $row['promissoryNoteMStatus'];  
            $disclosureStateMSelect = $row['disclosureStateMStatus'];
            $mriFormSelect = $row['mriFormStatus'];  
            $amortScheduleMSelect = $row['amortScheduleMStatus'];
            $utilizationSelect = $row['utilizationStatus'];

        


        // BORROWER
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
        $mriFormName="INSURANCE DOCUMENTS";
        $amortScheduleMName="AMORTIZATION SCHEDULE.";
        


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
            sendMail($loanAppFormM, $loanAppFormMSelect, $email, $clientName, $loanAppFormName);
            sendMail($borrower_Idsignature, $borrower_IdSignSelect, $email, $clientName, $borrower_IdsignatureName);
            sendMail($borrower_Lbp, $borrower_LbpSelect, $email, $clientName, $borrower_LbpName);
            sendMail($borrower_Lpb, $borrower_LpbSelect, $email, $clientName, $borrower_LpbName);

            sendMail($coborrowerStatement, $coborrowerStatementSelect, $email, $clientName, $coborrowerStatementName);
            sendMail($coBorrowerIdSign, $coBorrower_IdSignSelect, $email, $clientName, $coBorrowerIdSignName);
            sendMail($proofIncome, $proofIncomeSelect, $email, $clientName, $proofIncomeName);

            sendMail($comakerStatement, $comakerStatementSelect, $email, $clientName, $comakerStatementName);
            sendMail($coMakerIdWithSign, $coMaker_IdSignSelect, $email, $clientName, $coMakerIdWithSignName);
            sendMail($latestPermit, $coMaker_LbpSelect, $email, $clientName, $latestPermitName);
            sendMail($coMakerPayslip, $coMaker_PayslipSelect, $email, $clientName, $coMakerPayslipName);
            
            sendMail($validCardReport, $validCardReportSelect, $email, $clientName, $validCardReportName);
            sendMail($creditReport, $creditReportSelect, $email, $clientName, $creditReportName);
            sendMail($creditInvestigationReportM, $creditInvestigationReportMSelect, $email, $clientName, $creditInvestigationReportMName);
            sendMail($debitWaiver, $debitWaiverSelect, $email, $clientName, $debitWaiverName);
            sendMail($affidavitSurrender, $affidavitSurrenderSelect, $email, $clientName, $affidavitSurrenderName);



            if(!empty($riskRating) && !empty($loanApprovalSheet)){
                sendMail($promissoryNoteM, $promissoryNoteMSelect, $email, $clientName, $promissoryNoteMName);
                sendMail($disclosureStateM, $disclosureStateMSelect, $email, $clientName, $disclosureStateMName);
                sendMail($mriForm, $mriFormSelect, $email, $clientName, $mriFormName);
                sendMail($amortScheduleM, $amortScheduleMSelect, $email, $clientName, $amortScheduleMName);
            }

            if(!empty($debitWaiver) && !empty($affidavitSurrender) && !empty($creditInvestigationReportM)){
                sendMail($riskRating, $riskRatingSelect, $email, $clientName, $riskRatingName);
                sendMail($loanApprovalSheet, $loanApprovalSheetSelect, $email, $clientName, $loanApprovalSheetName);
 
            }

            if(!empty($businessValidation) && !empty($loanInstallment) && !empty($loanPayment)){
                sendMail($riskRating, $riskRatingSelect, $email, $clientName, $riskRatingName);
                sendMail($loanApprovalSheet, $loanApprovalSheetSelect, $email, $clientName, $loanApprovalSheetName);
 
            }

         }
        }
    }
        
else{
    echo "DATA ERROR". mysqli_error($con);
}

?>


