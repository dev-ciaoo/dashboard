<?php
include('connection.php');
include('fileuploadloan.php');
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- <link rel="stylesheet" href="css/styleloan.css"> -->
      <!-- <link rel="stylesheet" href="css/style.css"> -->
      <link rel="stylesheet" type="text/css">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
      <title>OURBANK</title>
      <link rel="stylesheet" type="text/css" href="./css/link.css">

   </head>
   <body oncontextmenu="return false;">
      <style>
        .nav-item .nav-link.active {
         background-color: lightgreen;
         }
         
        .hide-this {
            position: block;
            display: none;
        }  

        .submenu-collapsed:hover{
          /* font-size: 13px; */
          background-color: white;
          color: black;
        }

        #statusImg{
          width: 15px;
          height: auto;
          /* justify-content: right; */
          position: relative;
          float: right;
        }

        #pdfContainer,  #pdfContainer1,
        #pdfContainer2, 
        #pdfContainer3, #pdfContainer4,
        #pdfContainer5, #pdfContainer6,
        #pdfContainer7, #pdfContainer8,
        #pdfContainer9, #pdfContainer10, 
        #pdfContainer11, #pdfContainer12,
        #pdfContainer13, #pdfContainer14,
        #pdfContainer15, #pdfContainer16,
        #pdfContainer17, #pdfContainer18,
        #pdfContainer19, #pdfContainer20,
        #pdfContainer21, #pdfContainer22,
        #pdfContainer23, #pdfContainer24,
        #pdfContainer25, #pdfContainer26,
        #pdfContainer27, #pdfContainer28,
        #pdfContainer29, #pdfContainer30,
        #pdfContainer31, #pdfContainer32,
        #pdfContainer33, #pdfContainer34,
        #pdfContainer35, #pdfContainer36,
        #pdfContainer37, #pdfContainer38,
        #pdfContainer39, #pdfContainer40,
        #pdfContainer41, #pdfContainer42,
        #pdfContainer43, #pdfContainer44,
        #pdfContainer45, #pdfContainer46,
        #pdfContainer001, #pdfContainer002,
        #pdfContainer003, #pdfContainer004,
        #pdfContainer007, #pdfContainer008,
        #pdfContainer009 {
            /* zoom: 80%; */
            background-color: #333;
            width: 100%;
            text-align: center;
            overflow: auto;
            -webkit-overflow-scrolling: touch; /* Enables smooth scrolling on iOS devices */
        }

        .noData {
          text-align: center; /* Align text within the element */
          position: absolute; /* Position the element */
          top: 50%; /* Position from the top */
          left: 50%; /* Position from the left */
          transform: translate(-50%, -50%); /* Center the element */
        }

        #statusImg{
          width: 15px;
          height: auto;
          /* justify-content: right; */
          position: relative;
          float: right;
        }
      </style>
<?php

$id =  $_GET['id'];
$query = "SELECT * FROM loan WHERE loan_Id='$id'";
$data = mysqli_query($con, $query) ;

if (!$data) {
    echo("Error description: " . mysqli_error($mysqli));
} 
else 
{
    while ($row = mysqli_fetch_array($data)) {
       
        $Cfname= $row['customerFirstName'];
        $Lfname= $row['customerSurname'];
        $fullname=$row['customerFullName'];
        $birth=$row['birthDate'];
        $id=$row['loan_Id'];
        $type=$row['salaryType'];
        $branch=$row['branch'];
        $loanType= $row['loanType'];
} 
}


 
if($type == "Microfinance") {
    ?>

    <?php
            
            $query1="SELECT * FROM microfinance WHERE mLoan_Id=$id ";
            $newdata= mysqli_query($con, $query1);
            $rows = mysqli_fetch_array($newdata); 
    
            // BORROWER
            $loanAppFormM = $rows['loanAppFormM'];
            $borrower_Idsignature = $rows['mborrower_IdSign'];
            $borrower_Lbp = $rows['mborrower_Lbp'];
            $borrower_Lpb = $rows['mborrower_Lpb'];
            // CO-BORROWER
            $coborrowerStatement = $rows['coborrowerStatement'];
            $coBorrowerIdSign = $rows['mcoBorrower_Id'];
            $proofIncome=$rows['proofIncome'];
            // CO-MAKER
            $comakerStatement = $rows['comakerStatement'];  
            $coMakerIdWithSign = $rows['mcoMaker_IdSign'];
            $latestPermit = $rows['mcoMaker_Lbp'];
            $coMakerPayslip = $rows['mcoMaker_Payslip']; 
            // RENEWAL
            $businessValidation = $rows['businessValidation'];  
            $loanInstallment = $rows['loanInstallment'];
            $loanPayment = $rows['loanPayment'];
            $statementAccount = $rows['statementAccount']; 

            //OTHERS
            $businessPicture = $rows['businessPicture'];
            $otherSuport = $rows['otherSuport']; 
            // DOCUMENTS
            $validCardReport = $rows['validCardReport'];
            $creditReport = $rows['creditReport'];
            $creditInvestigationReportM = $rows['creditInvestigationReportM'];
            $debitWaiver = $rows['debitWaiver']; 
            $affidavitSurrender = $rows['affidavitSurrender'];
            $riskRating = $rows['riskRating'];
            $loanApprovalSheet = $rows['loanApprovalSheet'];
            // AFTER RELASE
            $promissoryNoteM = $rows['promissoryNoteM'];  
            $disclosureStateM = $rows['disclosureStateM'];
            $mriForm = $rows['mriForm'];
            $amortScheduleM = $rows['amortScheduleM'];
            $utilization = $rows['utilization'];
            //CHECKBOX
            $businessPictureCheck = $rows['businessPictureCheck'];
            $otherSuportCheck = $rows['otherSuportCheck']; 
            $renewalCheck = $rows['renewalCheck']; 

            
            // BORROWER STATUS
            $loanAppFormMSelect=$rows['loanAppFormMStatus'];
            $borrower_IdSignSelect = $rows['mborrower_IdSignStatus'];
            $borrower_LbpSelect = $rows['mborrower_LbpStatus'];
            $borrower_LpbSelect = $rows['mborrower_LpbStatus'];
            // CO-BORROWER STATUS
            $coborrowerStatementSelect=$rows['coborrowerStatementStatus'];
            $coBorrower_IdSignSelect = $rows['mcoBorrower_IdSignStatus'];
            $proofIncomeSelect = $rows['proofIncomeStatus'];
            // CO-MAKER STATUS
            $comakerStatementSelect= $rows['comakerStatementStatus'];
            $coMaker_IdSignSelect = $rows['mcoMaker_IdSignStatus'];
            $coMaker_LbpSelect = $rows['mcoMaker_LbpStatus'];
            $coMaker_PayslipSelect = $rows['mcoMaker_PayslipStatus'];
            // RENEWAL
            $businessValidationSelect= $rows['businessValidationStatus'];
            $loanInstallmentSelect = $rows['loanInstallmentStatus'];
            $loanPaymentSelect = $rows['loanPaymentStatus'];
            $statementAccountSelect = $rows['statementAccountStatus'];
            // OTHERS
            $businessPictureSelect = $rows['businessPictureStatus'];
            $otherSuportSelect = $rows['otherSuportStatus'];
            // DOCUMENTS STATUS
            $validCardReportSelect = $rows['validCardReportStatus'];
            $creditReportSelect = $rows['creditReportStatus'];
            $creditInvestigationReportMSelect = $rows['creditInvestigationReportMStatus'];
            $debitWaiverSelect = $rows['debitWaiverStatus']; 
            $affidavitSurrenderSelect = $rows['affidavitSurrenderStatus'];
            $riskRatingSelect = $rows['riskRatingStatus'];
            $loanApprovalSheetSelect = $rows['loanApprovalSheetStatus'];
            // AFTER RELASE STATUS
            $promissoryNoteMSelect = $rows['promissoryNoteMStatus'];  
            $disclosureStateMSelect = $rows['disclosureStateMStatus'];
            $mriFormSelect = $rows['mriFormStatus'];  
            $amortScheduleMSelect = $rows['amortScheduleMStatus'];
            $utilizationSelect = $rows['utilizationStatus'];


                    
    } 
    


    // The NUMBER OF PERCENTAGE
    $numberOfFilesUploaded = 0;
    $fileInputs = array(
      $loanAppFormMSelect, $borrower_IdSignSelect,$borrower_LbpSelect, $borrower_LpbSelect,$coborrowerStatementSelect, $coBorrower_IdSignSelect, $proofIncomeSelect, $comakerStatementSelect, $coMaker_IdSignSelect, $coMaker_LbpSelect,$coMaker_PayslipSelect, $validCardReportSelect,
      $creditReportSelect, $creditInvestigationReportMSelect, $debitWaiverSelect, $affidavitSurrenderSelect, $riskRatingSelect, $loanApprovalSheetSelect,$promissoryNoteMSelect, $disclosureStateMSelect,
      $amortScheduleMSelect
     );
    //  echo count($fileInputs);
    // Loop the file and Count the numbers of File uploaded
         // Filter out empty values from the array
         // Max Number Of Overall File Base on Condition
         $maxCount=count($fileInputs);
         // echo $maxCount;
         $nonEmptyFileInputs = array_filter($fileInputs,function($value) {
          $parts = explode("--", $value);
          return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
      });;
         // echo count($nonEmptyFileInputs);
         // Count the number of non-empty values
         $numberOfFilesUploaded = count($nonEmptyFileInputs);

 ;
         
         // Calculate the percentage
         $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         
         // echo count($numberOfFilesUploaded);
         $percentage= round($numberOfFilesUploaded /$maxCount *100);
    // echo $percentage ;

?>

         <div class="linkContainer py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><b><?php echo "$fullname &nbsp; $birth &nbsp; $type &nbsp; $loanType"; ?></b></h3></label>
        
         </div>
         <div class="col-12" style="text-align:left; margin-left:0.5%;">
         
            <!-- The PERCENTAGE CIRCLE -->
            <!-- <label class="text-white bg-success"><b>LOAN PROGRESS :</b></label> -->
            <div class="progress" style="display: inline-block; min-width: 99%; vertical-align:bottom; height: 100%; font-size:130%">
               <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: <?php echo $percentage.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage.'%';?></div>
            </div>
         </div>
<div class="row">
   <div class="col-12 ">
      <div class="bg-white rounded p-2">
         <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver;"  >
            <li class="nav-item ">
               <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab1" href="#microfinance"><b>Microfinance</b></a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#salary"><b>Salary</b></a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation"><b>Real Estate Mortgage - Corporation</b></a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual"><b>Real Estate Mortgage - Individual</b></a>
            </li>
         </ul>
<!-- Bootstrap NavBar -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top" id="topBar">
    <a class="navbar-brand">
      <span class="menu-collapsed"></span>
    </a>
    <div class="containerr">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
           <li class="nav-item active">
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- NavBar END -->

  <!-- Bootstrap row -->
  <div class="x" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded">
      <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
      <!-- Bootstrap List Group -->
      <ul class="list-group">
        <!-- Separator with title -->
        <!-- <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed bg-dark">
        </li> -->
        <!-- /END Separator -->
        
        <!-- Menu of HR -->
        <a href="#submenu2" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>BORROWER</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Principal Borrower -->
        <div id="submenu2" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#endorsement" href="#endorsement" aria-expanded="true"
            aria-controls="endorsement" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Loan Application</span>
            <?php
            if(!empty($loanAppFormM)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#loanApplication" href="#loanApplication" aria-expanded="true"
            aria-controls="loanApplication" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• 2 Valid ID With 3 Signature</span>
            <?php
            if(!empty($borrower_Idsignature)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(2 COPIES)</span>
          </a>
          <a data-toggle="collapse" data-target="#governID" href="#governID" aria-expanded="true" 
            aria-control="governID" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Latest Business Permit</span>
            <?php
            if(!empty($borrower_Lbp)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#secRegistration" href="#secRegistration" aria-expanded="true" 
            aria-control="secRegistration" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Proof Of Billing</span>
            <?php
            if(!empty($borrower_Lpb)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <span style="font-size: 9px">(MERALCO)</span>
          </a>
          <!-- <a data-toggle="collapse" data-target="#GIS" href="#secRegistraGIStion" aria-expanded="true" 
            aria-control="GIS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Personal-Bank Statement OR Passbook For The Last 6 Months</span>
          </a>
          <a data-toggle="collapse" data-target="#boardReso" href="#boardReso" aria-expanded="true" 
            aria-control="boardReso" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Marriage Contract</span>
            <span style="font-size: 9px;">(IF MARRIED)</span><br>
            <span class="submenu-collapsed">&nbsp;&nbsp;Cenomar</span>
            <span style="font-size: 9px;">(IF SINGLE)</span>
          </a>
          <a data-toggle="collapse" data-target="#corpSec" href="#corpSec" aria-expanded="true" 
            aria-control="corpSec" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Brgy. Clearance For Loan Purpose</span>
          </a> -->
        </div>

        <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- Collateral Docs Menu -->
        <a href="#submenu3" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>CO-BORROWER</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Collateral Document -->
        <div id="submenu3" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#certTitle" href="#certTitle" aria-expanded="true"
            aria-controls="certTitle" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Co-Borrower Statement</span>
            <?php
            if(!empty($coborrowerStatement)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#taxDecc" href="#taxDecc" aria-expanded="true"
            aria-controls="taxDecc" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• 2 Valid ID With 3 Signature</span>
            <?php
            if(!empty($coBorrowerIdSign)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(1 COPY)</span>
          </a>
          <a data-toggle="collapse" data-target="#taxDecc2" href="#taxDecc2" aria-expanded="true" 
            aria-control="taxDecc2" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Proof Of Income</span>
            <?php
            if(!empty($proofIncome)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <span style="font-size: 9px;">(IF APPLICABLE)</span>
          </a>
          <!-- <a data-toggle="collapse" data-target="#RER" href="#RER" aria-expanded="true" 
            aria-control="RER" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Real Estate Receipt</span>
            <span style="font-size: 9px;">(AMILYAR)</span>
          </a>
          <a data-toggle="collapse" data-target="#RETC" href="#RETC" aria-expanded="true" 
            aria-control="RETC" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Real Estate Tax Clearance</span>
          </a>
          <a data-toggle="collapse" data-target="#Cancellation" href="#Cancellation" aria-expanded="true" 
            aria-control="Cancellation" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Cancellation & Discharge Of Mortgage</span>
            <span style="font-size: 9px;">(If Applicable)</span>
          </a> -->
        </div>

         <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->
        
        <!-- Business Proof of Income Menu -->
        <a href="#submenu4" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>CO-MAKER</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Business Proof of Income -->
        <div id="submenu4" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#UBP" href="#UBP" aria-expanded="true"
            aria-controls="UBP" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Co-Maker Statement</span>
            <?php
            if(!empty($comakerStatement)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#AFS" href="#AFS" aria-expanded="true"
            aria-controls="AFS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• 2 Valid ID With 3 Signatures</span>
            <?php
            if(!empty($coMakerIdWithSign)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(1 COPY)</span>
          </a>
          <a data-toggle="collapse" data-target="#IHFS" href="#IHFS" aria-expanded="true" 
            aria-control="IHFS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Latest Business Permit</span>
            <?php
            if(!empty($latestPermit)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(IF APPLICABLE)</span>
          </a>
          <a data-toggle="collapse" data-target="#BLBS" href="#BLBS" aria-expanded="true" 
            aria-control="BLBS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Payslip For 3 Months</span>
            <?php
            if(!empty($coMakerPayslip)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
        </div>

        <!-- Separator without title -->
        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->
        
        <!-- FOR RENEWAL Menu -->
        <a href="#forRenewal" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>FOR RENEWAL</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for FOR RENEWAL -->
        <div id="forRenewal" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#BV" href="#BV" aria-expanded="true"
            aria-controls="BV" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Business Validation</span>
            <?php
            if(!empty($businessValidation)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#LIS" href="#LIS" aria-expanded="true"
            aria-controls="LIS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Loan Installment Schedule</span>
            <?php
            if(!empty($loanInstallment)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(PREVIOUS LOAN)</span>
          </a>
          <a data-toggle="collapse" data-target="#LPR" href="#LPR" aria-expanded="true" 
            aria-control="LPR" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Loan Payment Report</span>
            <?php
            if(!empty($loanPayment)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#SOABS" href="#SOABS" aria-expanded="true" 
            aria-control="SOABS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Statement Of Account /<br>&nbsp;&nbsp; Bank Statement</span>
            <?php
            if(!empty($statementAccount)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
          </a>
        </div>

         <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- Docs. Report & Cashflow Analysis Menu -->
        <a href="#submenu5" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>DOCUMENT REPORTS</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Docs. Report & Cashflow Analysis -->
        <div id="submenu5" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#AFR" href="#AFR" aria-expanded="true"
            aria-controls="AFR" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Client's Visitation Card Reports</span>
            <?php
            if(!empty($validCardReport)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#CIR" href="#CIR" aria-expanded="true"
            aria-controls="CIR" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Credit Investigation Report</span>
            <?php
            if(!empty($creditReport)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
        
          <a data-toggle="collapse" data-target="#CAR" href="#CAR" aria-expanded="true" 
            aria-control="CAR" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Credit Information & Background <br>&nbsp;&nbsp;Investigation Report</span>
            <?php
            if(!empty($creditInvestigationReportM)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#FE" href="#FE" aria-expanded="true" 
            aria-control="FE" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Authority To Debit & Waiver</span>
            <?php
            if(!empty($debitWaiver)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#AOVS" href="#AOVS" aria-expanded="true" 
            aria-control="AOVS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Affidavit Of Voluntary <br>&nbsp;&nbsp; Surrender</span>
            <?php
            if(!empty($affidavitSurrender)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#ApprSht" href="#ApprSht" aria-expanded="true" 
            aria-control="ApprSht" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Loan Approval Sheet</span>
            <?php
            if(!empty($loanApprovalSheet)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#BRRC" href="#BRRC" aria-expanded="true" 
            aria-control="BRRC" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Borrower's Risk Rating <br>&nbsp;&nbsp; /Cashflow</span>
            <?php
            if(!empty($riskRating)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
        </div>

         <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- DOCUMENTS AFTER THE RELEASE OF THE LOAN -->
        <a href="#submenu10" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>DOCUMENTS AFTER THE RELEASE OF THE LOAN</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for DOCUMENTS AFTER THE RELEASE OF THE LOAN -->
        <div id="submenu10" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#PN" href="#PN" aria-expanded="true"
            aria-controls="PN" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Promisorry Note</span>
            <?php
            if(!empty($promissoryNoteM)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#DS" href="#DS" aria-expanded="true"
            aria-controls="DS" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Disclosure Statement</span>
            <?php
            if(!empty($disclosureStateM)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#MRIF" href="#MRIF" aria-expanded="true"
            aria-controls="MRIF" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Insurance Documents</span>
            <?php
            if(!empty($mriForm)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#AS" href="#AS" aria-expanded="true"
            aria-controls="AS" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Amortization Schedule</span>
            <?php
            if(!empty($amortScheduleM)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
        </div>

         <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- LOAN UTILIZATION REPORT -->
        <a href="#submenu11" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>LOAN UTILIZATION REPORT</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for LOAN UTILIZATION REPORT -->
        <div id="submenu11" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#LU" href="#LU" aria-expanded="true"
            aria-controls="LU" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Loan Utilization</span>
            <?php
            if(!empty($utilization)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
        </div>
        
        <!-- Separator without title -->
        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- OTHERS -->
        <a href="#submenu13" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>OTHERS</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for OTHERS -->
        <div id="submenu13" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#SPOA" href="#SPOA" aria-expanded="true"
            aria-controls="SPOA" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Business Picture</span>
            <?php
            if(!empty($businessPicture)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
          </a>
          <a data-toggle="collapse" data-target="#CTS" href="#CTS" aria-expanded="true"
            aria-controls="CTS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Other&nbsp;</span>
            <?php
            if(!empty($otherSuport)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <span style="font-size: 9px;">(SUPPORTING DOCUMENTS)</span>
          </a>
        </div>
        
        <!-- Separator without title -->
        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- Separator without title -->
        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->
        <!-- data-toggle="sidebar-colapse" -->

        <!-- Logo -->
          <!-- <img src="logo/logo.png" width="40" height="40"> -->
         <!-- <a href="https://www.ourbank.ph" target="_blank"> -->
        <div class="copyRight">
        <span style="color:white; font-size: 0.8rem;font-style: italic;">©OUR Bank 2023</span>
        </div>
      </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->

    <!-- MAIN -->
    <div class="col content-area">

      <!-- ACCORDION -->
      <div class="accordion" id="accordionExample">
          
        <!-- Principal Borrower -->
        <div id="endorsement" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <?php if (!empty($loanAppFormM)) : ?>
                  <div id="pdfContainer1">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
        </div>
        <div id="loanApplication" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
          <?php if (!empty($borrower_Idsignature)) : ?>
                  <div id="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
      </div>
        <div id="governID" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <?php if (!empty($borrower_Lbp)) : ?>
                  <div id="pdfContainer3">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="secRegistration" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($borrower_Lpb)) : ?>
                  <div id="pdfContainer4">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Collateral Docs -->
        <div id="certTitle" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coborrowerStatement)) : ?>
                <div id="pdfContainer8">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="taxDecc" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coBorrowerIdSign)) : ?>
                <div id="pdfContainer9">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="taxDecc2" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($proofIncome)) : ?>
                <div id="pdfContainer10">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- Proof of Business -->
        <div id="UBP" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($comakerStatement)) : ?>
                <div id="pdfContainer14">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AFS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coMakerIdWithSign)) : ?>
                <div id="pdfContainer15">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="IHFS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($latestPermit)) : ?>
                <div id="pdfContainer16">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="BLBS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coMakerPayslip)) : ?>
                <div id="pdfContainer17">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- For Renewal -->
        <div id="BV" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($businessValidation)) : ?>
                <div id="pdfContainer001">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="LIS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($loanInstallment)) : ?>
                <div id="pdfContainer002">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="LPR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($loanPayment)) : ?>
                <div id="pdfContainer003">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="SOABS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($statementAccount)) : ?>
                <div id="pdfContainer004">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
       
        <div id="AFR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($validCardReport)) : ?>
                <div id="pdfContainer23">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CIR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($creditReport)) : ?>
                <div id="pdfContainer24">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CAR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($creditInvestigationReportM)) : ?>
                <div id="pdfContainer25">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="FE" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($debitWaiver)) : ?>
                <div id="pdfContainer26">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AOVS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($affidavitSurrender)) : ?>
                <div id="pdfContainer007">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="ApprSht" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($loanApprovalSheet)) : ?>
                <div id="pdfContainer008">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="BRRC" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($riskRating)) : ?>
                <div id="pdfContainer009">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- Sign of Approval -->
        <div id="SLOA" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($signedLetterI)) : ?>
                <div id="pdfContainer27">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

         <!-- Sign Loan Approval Memo -->
         <div id="SLAM" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($signedLoanMemoI)) : ?>
                <div id="pdfContainer28">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- SIGNED REAL ESTATE MORTGAGE CONTRACT -->
        <div id="SREMC" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($remContractI)) : ?>
                <div id="pdfContainer29">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- REM CONTRACT ANNOTATED -->
        <div id="REMCA" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($remContractAnnotatedI)) : ?>
                <div id="pdfContainer30">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- DOCUMENTS AFTER THE RELEASE OF THE LOAN -->
        <div id="PN" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($promissoryNoteM)) : ?>
                <div id="pdfContainer31">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="DS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($disclosureStateM)) : ?>
                <div id="pdfContainer32">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="MRIF" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($mriForm)) : ?>
                <div id="pdfContainer33">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($amortScheduleM)) : ?>
                <div id="pdfContainer34">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- Loan Utilization -->
        <div id="LU" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($utilization)) : ?>
                <div id="pdfContainer35">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!--  -->
        <div id="powerPoint" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($powerpoint)) : ?>
                <div id="pdfContainer36">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="Excel" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($excel)) : ?>
                <div id="pdfContainer37">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- Others -->
        <div id="SPOA" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($businessPicture)) : ?>
                <div id="pdfContainer38">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CTS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($otherSuport)) : ?>
                <div id="pdfContainer39">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="byLaw" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($securityExchange)) : ?>
                <div id="pdfContainer44">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="LOG" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($letterGuarantee)) : ?>
                <div id="pdfContainer40">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="OBR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($boardResolution)) : ?>
                <div id="pdfContainer45">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="SOC" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($statementAccountI)) : ?>
                <div id="pdfContainer41">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="BCOM" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($billMaterial)) : ?>
                <div id="pdfContainer42">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="PPP" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($proposedPlan)) : ?>
                <div id="pdfContainer43">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="otherD" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($otherDoc)) : ?>
                <div id="pdfContainer46">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        
      </div><!-- Accordion END -->
    </div><!-- Main Col END -->
  </div><!-- body-row END -->
                </div>
            </div>
        </div>

  <!-- CDN Scripts for payslip generation (currently disabled) -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script> -->

    <!-- FOR DROP DOWN OF SIDE NAVBAR -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

    <!-- FOR Table Inventory -->
  <!-- <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script> -->

  <!-- FOR ICONS -->
  <script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>
  
   <!-- CUSTOM SCRIPT FOR SIDE NAVBAR ANIMATION -->
   <script src="./js/dashboard.js"></script>
   
  <!-- For employee payslip converting it to image (currently disabled)-->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> -->
  <script>
        const pdfUrl =  "<?php echo $borrower_Idsignature; ?>";
        const pdfUrl1 = "<?php echo $loanAppFormM; ?>"
        const pdfUrl3 = '<?php echo $borrower_Lbp; ?>';
        const pdfUrl4 = '<?php echo $borrower_Lpb; ?>';

        const pdfUrl8 = '<?php echo $coborrowerStatement; ?>';
        const pdfUrl9 = '<?php echo $coBorrowerIdSign; ?>';
        const pdfUrl10 = '<?php echo $proofIncome; ?>'; 

        const pdfUrl14 = '<?php echo $comakerStatement; ?>';
        const pdfUrl15 = '<?php echo $coMakerIdWithSign; ?>';
        const pdfUrl16 = '<?php echo $latestPermit; ?>';
        const pdfUrl17 = '<?php echo $coMakerPayslip; ?>';

        const pdfUrl001 = '<?php echo $businessValidation; ?>';
        const pdfUrl002 = '<?php echo $loanInstallment; ?>';
        const pdfUrl003 = '<?php echo $loanPayment; ?>';
        const pdfUrl004 = '<?php echo $statementAccount; ?>';

        const pdfUrl23 = '<?php echo $validCardReport; ?>';
        const pdfUrl24 = '<?php echo $creditReport; ?>';
        const pdfUrl25 = '<?php echo $creditInvestigationReportM; ?>';
        const pdfUrl26 = '<?php echo $debitWaiver; ?>'; //
        const pdfUrl007 = '<?php echo $affidavitSurrender; ?>';
        const pdfUrl008 = '<?php echo $loanApprovalSheet; ?>';
        const pdfUrl009 = '<?php echo $riskRating; ?>';


        const pdfUrl27 = '<?php echo $signedLetterI; ?>';
        const pdfUrl28 = '<?php echo $signedLoanMemoI; ?>';
        const pdfUrl29 = '<?php echo $remContractI; ?>';
        const pdfUrl30 = '<?php echo $remContractAnnotatedI; ?>';

        const pdfUrl31 = '<?php echo $promissoryNoteM; ?>';
        const pdfUrl32 = '<?php echo $disclosureStateM; ?>';
        const pdfUrl33 = '<?php echo $mriForm; ?>';
        const pdfUrl34 = '<?php echo $amortScheduleM; ?>';

        const pdfUrl35 = '<?php echo $utilization; ?>';

        const pdfUrl36 = '<?php echo $powerpoint; ?>';
        const pdfUrl37 = '<?php echo $excel; ?>';

        const pdfUrl38 = '<?php echo $businessPicture; ?>';
        const pdfUrl39 = '<?php echo $otherSuport; ?>';
        const pdfUrl40 = '<?php echo $letterGuarantee; ?>';
        const pdfUrl41 = '<?php echo $statementAccountI; ?>';
        const pdfUrl42 = '<?php echo $billMaterial; ?>';
        const pdfUrl43 = '<?php echo $proposedPlan; ?>';
        const pdfUrl44 = '<?php echo $securityExchange; ?>';
        const pdfUrl45 = '<?php echo $boardResolution; ?>';
        const pdfUrl46 = '<?php echo $otherDoc; ?>';

        function renderPdf(url, containerId) {
            const loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then(function(pdf) {
                const pdfContainer = document.getElementById(containerId);

                // Render all pages
                for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                    pdf.getPage(pageNumber).then(function(page) {
                        const scale = 1.5;
                        const viewport = page.getViewport({ scale });

                        // Prepare the canvas for each page
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        // Render the PDF page on the canvas
                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext).promise.then(function() {
                            // Display the rendered PDF on the page
                            pdfContainer.appendChild(canvas);
                        });
                    });
                }
            }).catch(function(reason) {
                // Error handling if PDF loading fails
                console.error('Error loading PDF: ' + reason);
            });
        }

        // Call the function to render the PDF
        renderPdf(pdfUrl, 'pdfContainer');
        renderPdf(pdfUrl1, 'pdfContainer1');
        // renderPdf(pdfUrl2, 'pdfContainer2');
        renderPdf(pdfUrl3, 'pdfContainer3');
        renderPdf(pdfUrl4, 'pdfContainer4');
        // renderPdf(pdfUrl5, 'pdfContainer5');
        // renderPdf(pdfUrl6, 'pdfContainer6');
        // renderPdf(pdfUrl7, 'pdfContainer7');
        renderPdf(pdfUrl8, 'pdfContainer8');
        renderPdf(pdfUrl9, 'pdfContainer9');
        renderPdf(pdfUrl10, 'pdfContainer10');
        // renderPdf(pdfUrl11, 'pdfContainer11');
        // renderPdf(pdfUrl12, 'pdfContainer12');
        // renderPdf(pdfUrl13, 'pdfContainer13');
        renderPdf(pdfUrl14, 'pdfContainer14');
        renderPdf(pdfUrl15, 'pdfContainer15');
        renderPdf(pdfUrl16, 'pdfContainer16');
        renderPdf(pdfUrl17, 'pdfContainer17');
        // renderPdf(pdfUrl18, 'pdfContainer18');
        renderPdf(pdfUrl001, 'pdfContainer001');
        renderPdf(pdfUrl002, 'pdfContainer002');
        renderPdf(pdfUrl003, 'pdfContainer003');
        renderPdf(pdfUrl004, 'pdfContainer004');
        // renderPdf(pdfUrl19, 'pdfContainer19');
        // renderPdf(pdfUrl20, 'pdfContainer20');
        // renderPdf(pdfUrl21, 'pdfContainer21');
        // renderPdf(pdfUrl22, 'pdfContainer22');
        renderPdf(pdfUrl23, 'pdfContainer23');
        renderPdf(pdfUrl24, 'pdfContainer24');
        renderPdf(pdfUrl25, 'pdfContainer25');
        renderPdf(pdfUrl26, 'pdfContainer26');
        renderPdf(pdfUrl007, 'pdfContainer007')
        renderPdf(pdfUrl008, 'pdfContainer008')
        renderPdf(pdfUrl009, 'pdfContainer009')
        renderPdf(pdfUrl27, 'pdfContainer27');
        renderPdf(pdfUrl28, 'pdfContainer28');
        renderPdf(pdfUrl29, 'pdfContainer29');
        renderPdf(pdfUrl30, 'pdfContainer30');
        renderPdf(pdfUrl31, 'pdfContainer31');
        renderPdf(pdfUrl32, 'pdfContainer32');
        renderPdf(pdfUrl33, 'pdfContainer33');
        renderPdf(pdfUrl34, 'pdfContainer34');
        renderPdf(pdfUrl35, 'pdfContainer35');
        renderPdf(pdfUrl36, 'pdfContainer36');
        renderPdf(pdfUrl37, 'pdfContainer37');
        renderPdf(pdfUrl38, 'pdfContainer38');
        renderPdf(pdfUrl39, 'pdfContainer39');
        renderPdf(pdfUrl40, 'pdfContainer40');
        renderPdf(pdfUrl41, 'pdfContainer41');
        renderPdf(pdfUrl42, 'pdfContainer42');
        renderPdf(pdfUrl43, 'pdfContainer43');
        renderPdf(pdfUrl44, 'pdfContainer44');
        renderPdf(pdfUrl45, 'pdfContainer45');
        renderPdf(pdfUrl46, 'pdfContainer46');
    </script>
  
</body>
</html>
                  
