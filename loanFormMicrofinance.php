<?php
include('connection.php');
include('fileuploadloan.php');
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta Http-Equiv="Cache-Control" Content="no-cache">
  <meta Http-Equiv="Pragma" Content="no-cache">
  <meta Http-Equiv="Expires" Content="0">
  <meta Http-Equiv="Pragma-directive: no-cache">
  <meta Http-Equiv="Cache-directive: no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="Microfinance Data">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Microfinance</title>
      <!-- Required meta tags -->
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/styleloan.css">
  <link rel="stylesheet" type="text/css">
</head>
  <body>
  <style>
   #showOldModal {
            position: fixed;
            background-color: rgba(0, 0, 0, 0.3);
            
   }

   #oldFile_length{
      display: none;
   }

   #oldFile_filter{
      display: none;
   }

   #oldFile_paginate{
      float: right;
      position: relative;
   }

   #oldFile_info{
      float: left;
      position: relative;
   }

   .nav-item .nav-link.active {
         background-color: lightgreen;
   }

   .btnWriteOff{
      color: white;
   }
   .btnWriteOff:hover {
      color: #ccc;
   }
    
</style>
<?php

$id =  $_POST['loanId'];
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
      $productID =$row['productID'];
      $amountAppliedd = $row['amountApplied'];
      $amountTermss = $row['terms'];
      $interestRatee = $row['interestRate'];

      $amountAppl = number_format($amountAppliedd, 2, '.', ',');
   } 
}


         
      
 
if($type == "Microfinance") {
    ?>

    <?php
            
            $query1 = "SELECT a.*, m.* FROM microfinance AS m
                                    LEFT JOIN microarchive AS a ON m.mLoan_Id = a.a_mLoan_Id
                                    WHERE m.mLoan_Id= '$id'
                      ";

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

            //archive
            // BORROWER
            $a_loanAppFormM = $rows['a_loanAppFormM'];
            $a_mborrower_IdSign = $rows['a_mborrower_IdSign'];
            $a_mborrower_Lbp = $rows['a_mborrower_Lbp'];
            $a_mborrower_Lpb = $rows['a_mborrower_Lpb'];
            // CO-BORRWEr
            $a_coborrowerStatement = $rows['a_coborrowerStatement'];
            $a_mcoBorrower_Id = $rows['a_mcoBorrower_Id'];
            $a_proofIncome = $rows['a_proofIncome'];
            // CO-MAKER
            $a_comakerStatement = $rows['a_comakerStatement'];
            $a_coMakerIdWithSign = $rows['a_mcoMaker_IdSign'];
            $a_latestPermit = $rows['a_mcoMaker_Lbp'];
            $a_coMakerPayslip = $rows['a_mcoMaker_Payslip'];
            // OTHER
            $a_businessValidation = $rows['a_businessValidation'];
            $a_otherSuport = $rows['a_otherSuport'];
            // DOCS
            $a_validCardReport = $rows['a_validCardReport'];
            $a_creditReport = $rows['a_creditReport'];
            $a_creditInvestigationReportM = $rows['a_creditInvestigationReportM'];
            $a_debitWaiver  = $rows['a_debitWaiver'];
            $a_affidavitSurrender = $rows['a_affidavitSurrender'];
            $a_riskRating = $rows['a_riskRating'];
            $a_loanApprovalSheet = $rows['a_loanApprovalSheet'];
            //AFTER RELEASE
            $a_promissoryNoteM  = $rows['a_promissoryNoteM'];
            $a_disclosureStateM = $rows['a_disclosureStateM'];
            $a_mriForm = $rows['a_mriForm'];
            $a_amortScheduleM = $rows['a_amortScheduleM'];
            $a_utilization = $rows['a_utilization'];

            //OTHERS
            $businessPicture = $rows['businessPicture'];
            $cic = $rows['cic'];
            $nfis = $rows['nfis'];
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
            $cicCheck = $rows['cicCheck'];
            $nfisCheck = $rows['nfisCheck'];
            $otherSuportCheck = $rows['otherSuportCheck']; 
            $renewalCheck = $rows['renewalCheck']; 
            $edit1 = $rows['edit1']; 

            
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
            $cicSelect = $rows['cicStatus'];
            $nfisSelect = $rows['nfisStatus'];
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
    $primary="http://124.106.173.237/dashboard/linkMicro.php?id=";
    $link=$primary . $id;
?>


         <div class ="links">
            <?php 
               $pipeStats = "SELECT pipeStats, writeOff FROM loan WHERE loan_Id = '$id'";
               $pipeStatsQ = mysqli_query($con, $pipeStats);

               $rowww = mysqli_fetch_array($pipeStatsQ);
               if($rowww['writeOff'] == 1){ ?>
                  <button class="btnWriteOff btn-warning btn-md btn disabled" id="btnWriteOff" name="btnWriteOff">WRITTEN-OFF</button>&nbsp;
            <?php 
               } else { ?>
                  <button class="btnWriteOff btn-warning btn-md btn" id="btnWriteOff" name="btnWriteOff" value="<?php echo $id; ?>" >WRITE-OFF</button>&nbsp;
            <?php 
               } 
            ?>
            <?php 
               if($rowww['pipeStats'] == 3){ ?>
                  <button class="btnRelease btn-danger btn-md btn disabled" id="btnRelease" name="btnRelease">RELEASED</button>&nbsp;
            <?php   
               }else{ ?>
                  <button class="btnRelease btn-danger btn-md btn" id="btnRelease" name="btnRelease" value="<?php echo $id; ?>" >RELEASE</button>&nbsp;
            <?php
              }
            ?>
            <button data-bs-toggle="modal" class="btn btn-primary btn-md" name="aa" id="aa" data-bs-target="#try">GENERATE LINK</button>
         </div>

         <div class="container py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><b><?php echo "$fullname &nbsp; $birth &nbsp;" . strtoupper($type). "&nbsp; $loanType &nbsp;&nbsp;&nbsp; <span style='color: lightgray;'><strong>|</strong></span> &nbsp;&nbsp; AMOUNT: &#8369;$amountAppl &nbsp; TERMS: $amountTermss &nbsp; INTEREST RATE: $interestRatee%"; ?></b></h3></label>
         </div>
         <div class="col-12" style="text-align:left; margin-left:0.5%;">
         
            <!-- The PERCENTAGE CIRCLE -->
            <!-- <label class="text-white bg-success">LOAN PROGRESS :</label> -->
            <div class="progress" style="display: inline-block; min-width: 99%; vertical-align:bottom; height: 100%; font-size:130%">
               <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: <?php echo $percentage.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage.'%';?></div>
            </div>
         </div>
<div class="row">
   <div class="col-12 ">
      <div class="bg-white rounded p-2">
         <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver;"  >
            <li class="nav-item ">
               <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab1" href="#microfinance">Microfinance</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#salary">Salary</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation">Real Estate Mortgage - Corporation</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual">Real Estate Mortgage - Individual</a>
            </li>
         </ul>
      <div id="myModal" class="modal" style="margin-top:5%; margin-left:20%; width:50%; height:500px;">
         <div class="modal-content" style="height:50%;">
            <span class="close" id="closeModal" style= "font-size:2em; margin-left:95%"><i class="fa fa-times" aria-hidden="true"></i></span>
            <p><h1 id="modalText" style ="font-size: 1.5em;"></h1></p>
        </div>
      </div>
         <div class="row">
            <div class="col-12">
               <div class="tab-content p-6">
                  <div id="microfinance" class="tab-pane active" style="border: 1px solid #ccc;">
                     <form id="microfinance-form" action="loanMicroUploadData.php" method="POST" enctype="multipart/form-data">

                     <div id="nextbankSection" style="position: absolute; top: 0; right: 0; margin-right: 4.4em;">
                        <div class="form">
                              <input type="text" class="form-control" id="productID" name="productID" style="width: 25em; height: 4em; display: inline-block; font-size: 1.1em; font-weight: bold; " value="<?php echo $productID; ?>" placeholder="NEXTBANK PRODUCT ID" tabindex="-1">
                        </div>
                     </div>

                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6 my-4"><br>
                           <div class="row">
                              <div class="col-8" style="border-right:0;">
                              <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">REQUIREMENTS</h1>
                                 </div>
                                 <div class="col-4">
                              <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 107%;">APPROVAL</h1>
                                 </div>
                              </div>
                              <div class="microfinance-tabs" style="border-right: 1px solid #ccc; min-height: 96%; width:100%; margin-top: -0.5%;">

                                 <!-- Requirements Form -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><u>BORROWER</u></label></div>
                                    </div>
                                 </div>
                                 <div class="row" >
                                    <div class="col-8">
                                       <div class="py-2">                                   
                                          <label class ="micro-labels" id="tab-label" for="custom">LOAN APPLICATION</label>
                                          <input type="file" id="loanAppFormM" name="loanAppFormM"><img id="loanAppFormMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanAppFormM; ?>" target="_blank">
                                             <button type="button" class="btn btn-outline-success btnFile " id="loanAppFormMButton">Open File</button>
                                          </a> 
                                          <?php 
                                          if(!empty($loanAppFormM)){
                                             echo '<button type="button" id="loanAppFormMUploadNew" class="loanAppFormMUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="loanAppFormMUploadNew" class="loanAppFormMUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="loanAppFormMShowOld" class="loanAppFormMShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="loanAppFormMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormM, strrpos($loanAppFormM, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="loanAppFormMSelect" name="loanAppFormMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanAppFormMDesc"  name="loanAppFormMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 2 COPIES OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">2 COPIES OF 2 VALID ID</label>
                                          <input type="file" id="borrower_Idsignature" name="borrower_Idsignature"><img id="borrower_IdsignatureImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $borrower_Idsignature; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_IdsignatureButton">Open File</button></a>
                                          <?php 
                                          if(!empty($borrower_Idsignature)){
                                             echo '<button type="button" id="borrower_IdsignatureUploadNew" class="borrower_IdsignatureUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="borrower_IdsignatureUploadNew" class="borrower_IdsignatureUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="borrower_IdsignatureShowOld" class="borrower_IdsignatureShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="borrower_IdsignatureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Idsignature, strrpos($borrower_Idsignature, '/') + 1, 10); ?></label>
                                          <label class ="micro-labels" id="tab-label" for="custom">WITH 3 SIGNATURES</label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-1">
                                          <select id="borrowerValidSelect" name="borrowerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_IdsignatureDesc"  name="borrower_IdsignatureDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                       <br>
                                    </div>
                                 </div>
                                  <!--LATEST BUSINESS PERMIT  -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LATEST BUSINESS PERMIT</label>   
                                          <input type="file" id="borrower_Lbp" name="borrower_Lbp"><img id="borrower_LbpImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $borrower_Lbp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_LbpButton">Open File</button></a>
                                          <?php 
                                          if(!empty($borrower_Lbp)){
                                             echo '<button type="button" id="borrower_LbpUploadNew" class="borrower_LbpUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="borrower_LbpUploadNew" class="borrower_LbpUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="borrower_LbpShowOld" class="borrower_LbpShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="borrower_LbpDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Lbp, strrpos($borrower_Lbp, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="latestPermitSelect" name="latestPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_LbpDesc" name="borrower_LbpDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LATEST PROOF OF BILLING (MERALCO) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LATEST PROOF OF BILLING (MERALCO)</label>
                                          <input type="file" id="borrower_Lpb" name="borrower_Lpb"><img id="borrower_LpbImage" src="statusImage/check.png" alt="statusImage"> 
                                          <a href="<?php echo $borrower_Lpb; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_LpbButton">Open File</button></a>
                                          <?php 
                                          if(!empty($borrower_Lpb)){
                                             echo '<button type="button" id="borrower_LpbUploadNew" class="borrower_LpbUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="borrower_LpbUploadNew" class="borrower_LpbUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="borrower_LpbShowOld" class="borrower_LpbShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="borrower_LpbDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Lpb, strrpos($borrower_Lpb, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-3">
                                          <select  id="latestProofSelect" name="latestProofSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_LpbDesc" name="borrower_LpbDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><u>CO-BORROWER</u></label></div>
                                    </div>
                                 </div>
                                  <!-- CO-BORROWER STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels">CO-BORROWER STATEMENT </label>
                                          <input type="file" id="coborrowerStatement" name="coborrowerStatement"><img id="coborrowerStatementImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coborrowerStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coborrowerStatementButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($coborrowerStatement)){
                                             echo '<button type="button" id="coborrowerStatementUploadNew" class="coborrowerStatementUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="coborrowerStatementUploadNew" class="coborrowerStatementUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="coborrowerStatementShowOld" class="coborrowerStatementShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="coborrowerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coborrowerStatement, strrpos($coborrowerStatement, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="coborrowerStatementSelect" name="coborrowerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coborrowerStatementDesc"  name="coborrowerStatementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class="micro-labels" id="tab-label" for="custom" >1 COPY OF 2 VALID ID</label> 
                                          <input type="file" id="coBorrowerIdSign" name="coBorrowerIdSign"><img id="coBorrowerIdSignImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coBorrowerIdSign; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coBorrowerIdSignButton">Open File</button></a>
                                          <?php 
                                          if(!empty($coBorrowerIdSign)){
                                             echo '<button type="button" id="coBorrowerIdSignUploadNew" class="coBorrowerIdSignUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="coBorrowerIdSignUploadNew" class="coBorrowerIdSignUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="coBorrowerIdSignShowOld" class="coBorrowerIdSignShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="coBorrowerIdSignDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($coBorrowerIdSign, strrpos($coBorrowerIdSign, '/') + 1, 10); ?></label>
                                          <label class="micro-labels" id="tab-label" for="custom" >WITH 3 SIGNATURES</label> 
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="coborrowerIdSelect" name="coborrowerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL" >Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coBorrowerIdSignDesc" name="coBorrowerIdSignDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!--PROOF OF INCOME (IF APPLICABLE) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class="micro-labels" id="tab-label" for="custom">PROOF OF INCOME (IF APPLICABLE)</label>
                                          <input type="file" id="proofIncome" name="proofIncome"><img id="proofIncomeImage" src="statusImage/check.png" alt="statusImage"> 
                                          <a href="<?php echo $proofIncome; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofIncomeButton">Open File</button></a>
                                          <?php 
                                          if(!empty($proofIncome)){
                                             echo '<button type="button" id="proofIncomeUploadNew" class="proofIncomeUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="proofIncomeUploadNew" class="proofIncomeUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="proofIncomeShowOld" class="proofIncomeShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="proofIncomeDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($proofIncome, strrpos($proofIncome, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="proofIncomeSelect" name="proofIncomeSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="proofIncomeDesc" name="proofIncomeDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><u>CO-MAKER</u></label></div>
                                    </div>
                                 </div>
                                 <!-- CO=MAKER STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels">CO-MAKER STATEMENT</label>
                                          <input type="file" id="comakerStatement" name="comakerStatement"><img id="comakerStatementImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $comakerStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="comakerStatementButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($comakerStatement)){
                                             echo '<button type="button" id="comakerStatementUploadNew" class="comakerStatementUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="comakerStatementUploadNew" class="comakerStatementUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="comakerStatementShowOld" class="comakerStatementShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="comakerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($comakerStatement, strrpos($comakerStatement, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerStatementSelect" name="comakerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="comakerStatementDesc" name="comakerStatementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">1 COPY OF 2 VALID ID</label>
                                          <input type="file" id="coMakerIdWithSign" name="coMakerIdWithSign"><img id="coMakerIdWithSignImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coMakerIdWithSign; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coMakerIdWithSignButton">Open File</button></a>
                                          <?php 
                                          if(!empty($coMakerIdWithSign)){
                                             echo '<button type="button" id="coMakerIdWithSignUploadNew" class="coMakerIdWithSignUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="coMakerIdWithSignUploadNew" class="coMakerIdWithSignUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="coMakerIdWithSignShowOld" class="coMakerIdWithSignShowOld">History</button>';
                                          ?>
                                          <label class ="micro-labels" id="tab-label" for="custom">WITH 3 SIGNATURES</label>
                                          <label class="date-label" id="coMakerIdWithSignDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerIdWithSign, strrpos($coMakerIdWithSign, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerValidSelect" name="comakerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coMakerIdWithSignDesc" name="coMakerIdWithSignDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LATEST BUSINESS PERMIT (IF APPLICABLE) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LATEST BUSINESS PERMIT</label>
                                          <input type="file" id="latestPermit" name="latestPermit"><img id="latestPermitImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $latestPermit; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestPermitButton">Open File</button></a>
                                          <?php 
                                          if(!empty($latestPermit)){
                                             echo '<button type="button" id="latestPermitUploadNew" class="latestPermitUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="latestPermitUploadNew" class="latestPermitUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="latestPermitShowOld" class="latestPermitShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="latestPermitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestPermit, strrpos($latestPermit, '/') + 1, 10); ?></label>
                                          <label class ="micro-labels" id="tab-label" for="custom">(IF APPLICABLE)</label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerPermitSelect" name="comakerPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="latestPermitvDesc" name="latestPermitvDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                  <!--3 MONTHS OF PAYSLIP (IF EMPLOYED)  -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">3 MONTHS OF PAYSLIP (IF EMPLOYED)</label>
                                          <input type="file" id="coMakerPayslip" name="coMakerPayslip"><img id="coMakerPayslipImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coMakerPayslip;?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coMakerPayslipButton">Open File</button></a>
                                          <?php 
                                          if(!empty($coMakerPayslip)){
                                             echo '<button type="button" id="coMakerPayslipUploadNew" class="coMakerPayslipUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="coMakerPayslipUploadNew" class="coMakerPayslipUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="coMakerPayslipShowOld" class="coMakerPayslipShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="coMakerPayslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerPayslip, strrpos($coMakerPayslip, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerPayslipSelect" name="comakerPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coMakerPayslipDesc" name="coMakerPayslipDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                    <div class="py-1">
                                    <input class="form-check-input" style = "vertical-align: top; font-size:140%; margin-left: 10px;" type="checkbox" value="Check" id="renewalCheck" name="renewalCheck">&nbsp;<label style="font-size:140%;"> FOR RENEWAL</label>
                                    </div>
                                    </div>
                                 </div>
                                <!-- BUSINESS VALIDATION -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels">BUSINESS VALIDATION</label>
                                          <input type="file" id="businessValidation" name="businessValidation"><img id="businessValidationImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $businessValidation; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessValidationButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($businessValidation)){
                                             echo '<button type="button" id="businessValidationUploadNew" class="businessValidationUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="businessValidationUploadNew" class="businessValidationUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="businessValidationShowOld" class="businessValidationShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="businessValidationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessValidation, strrpos($businessValidation, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="businessValidationSelect" name="businessValidationSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="businessValidationDesc" name="businessValidationDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LOAN INSTALLMENT SCHEDULE PREVIOUS LOAN -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LOAN INSTALLMENT</label>
                                          <input type="file" id="loanInstallment" name="loanInstallment"><img id="loanInstallmentImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanInstallment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanInstallmentButton">Open File</button></a>
                                          <?php 
                                          if(!empty($loanInstallment)){
                                             echo '<button type="button" id="loanInstallmentUploadNew" class="loanInstallmentUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="loanInstallmentUploadNew" class="loanInstallmentUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="loanInstallmentShowOld" class="loanInstallmentShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="loanInstallmentDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanInstallment, strrpos($loanInstallment, '/') + 1, 10); ?></label>
                                          <label class ="micro-labels" id="tab-label" for="custom">SCHEDULE PREVIOUS LOAN</label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="loanInstallmentSelect" name="loanInstallmentSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanInstallmentDesc" name="loanInstallmentDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LOAN PAYMENT REPORT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">LOAN PAYMENT REPORT</label>
                                          <input type="file" id="loanPayment" name="loanPayment"><img id="loanPaymentImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanPayment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanPaymentButton">Open File</button></a>
                                          <?php 
                                          if(!empty($loanPayment)){
                                             echo '<button type="button" id="loanPaymentUploadNew" class="loanPaymentUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="loanPaymentUploadNew" class="loanPaymentUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="loanPaymentShowOld" class="loanPaymentShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="loanPaymentDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanPayment, strrpos($loanPayment, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="loanPaymentSelect" name="loanPaymentSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanPaymentDesc" name="loanPaymentDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                  <!--STATEMENT OF ACCOUNT/BANK STATEMENT -->
                                 <div class="row" style = "margin-bottom:-2%;">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom">STATEMENT OF ACCOUNT/</label>
                                          <input type="file" id="statementAccount" name="statementAccount"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $statementAccount;?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountButton">Open File</button></a>
                                          <?php 
                                          if(!empty($statementAccount)){
                                             echo '<button type="button" id="statementAccountUploadNew" class="statementAccountUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="statementAccountUploadNew" class="statementAccountUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="statementAccountShowOld" class="statementAccountShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="statementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccount, strrpos($statementAccount, '/') + 1, 10); ?></label>
                                          <label class ="micro-labels" id="tab-label" for="custom">BANK STATEMENT</label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="statementAccountSelect" name="statementAccountSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1"> 
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="statementAccountDesc" name="statementAccountDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS">&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 my-4"><br>
                           <div class="row">
                              <div class="col-8" style="border-right:0;">
                              <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">DOCUMENTS</h1>
                                 </div>
                                 <div class="col-4">
                              <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 100%;">APPROVAL</h1>
                                 </div>
                              </div>
                              <div class="document-labels">
                                 <div class="row">
                                    <div class="col-8" style="height:1; margin-top:-0.5%;"></div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-3">&nbsp;<label style="font-size:130%"><u>DOCUMENT REPORTS</u></label></div>
                                    </div>
                                 </div>
                                  <!-- CLIENT'S VALIDATION CARD REPORTS -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">&#x2022; CLIENT'S VISITATION CARD REPORTS</label>
                                          <input type="file" id="validCardReport" name="validCardReport"><img id="validCardReportImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $validCardReport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validCardReportButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($validCardReport)){
                                             echo '<button type="button" id="validCardReportUploadNew" class="validCardReportUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="validCardReportUploadNew" class="validCardReportUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="validCardReportShowOld" class="validCardReportShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="validCardReportDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($validCardReport, strrpos($validCardReport, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4 ">
                                          <select  id="validCardReportSelect" name="validCardReportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="validCardReportDesc" name="validCardReportDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- CREDIT INVESTIGATION REPORT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">&#x2022; CREDIT INVESTIGATION REPORT</label>
                                          <input type="file" id="creditReport" name="creditReport"><img id="creditReportImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $creditReport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditReportButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($creditReport)){
                                             echo '<button type="button" id="creditReportUploadNew" class="creditReportUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="creditReportUploadNew" class="creditReportUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="creditReportShowOld" class="creditReportShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="creditReportDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditReport, strrpos($creditReport, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="creditReportSelect" name="creditReportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL" >Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="creditReportDesc" name="creditReportDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- CREDIT INFORMATION AND BACKGROUND INVESTIGATION REPORT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2 mb-3">
                                          <label class ="micro-labels"> &#x2022; CREDIT INFORMATION AND</label>
                                          <input type="file" id="creditInvestigationReportM" name="creditInvestigationReportM"><img id="creditInvestigationReportMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $creditInvestigationReportM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportMButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($creditInvestigationReportM)){
                                             echo '<button type="button" id="creditInvestigationReportMUploadNew" class="creditInvestigationReportMUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="creditInvestigationReportMUploadNew" class="creditInvestigationReportMUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="creditInvestigationReportMShowOld" class="creditInvestigationReportMShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="creditInvestigationReportMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportM, strrpos($creditInvestigationReportM, '/') + 1, 10); ?></label>
                                          <label class ="micro-labels">BACKGROUND INVESTIGATION REPORT</label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-2">
                                          <select id="creditInvestigationReportMSelect" name="creditInvestigationReportMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="creditInvestigationReportMDesc" name="creditInvestigationReportMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- AUTHORITY TO DEBIT AND WAIVER -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">AUTHORITY TO DEBIT AND WAIVER</label>
                                          <input type="file" id="debitWaiver" name="debitWaiver"><img id="debitWaiverImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $debitWaiver; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="debitWaiverButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($debitWaiver)){
                                             echo '<button type="button" id="debitWaiverUploadNew" class="debitWaiverUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="debitWaiverUploadNew" class="debitWaiverUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="debitWaiverShowOld" class="debitWaiverShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="debitWaiverDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($debitWaiver, strrpos($debitWaiver, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="debitWaiverSelect" name="debitWaiverSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="debitWaiverDesc" name="debitWaiverDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- AFFIDAVIT OF VOLUNTARY SURRENDER -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">AFFIDAVIT OF VOLUNTARY SURRENDER</label>
                                          <input type="file" id="affidavitSurrender" name="affidavitSurrender"><img id="affidavitSurrenderImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $affidavitSurrender; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="affidavitSurrenderButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($affidavitSurrender)){
                                             echo '<button type="button" id="affidavitSurrenderUploadNew" class="affidavitSurrenderUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="affidavitSurrenderUploadNew" class="affidavitSurrenderUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="affidavitSurrenderShowOld" class="affidavitSurrenderShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="affidavitSurrenderDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($affidavitSurrender, strrpos($affidavitSurrender, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="affidavitSurrenderSelect" name="affidavitSurrenderSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="affidavitSurrenderDesc" name="affidavitSurrenderDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>

                                 <!-- LOAN APPROVAL SHEET -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">LOAN APPROVAL SHEET </label>
                                          <input type="file" id="loanApprovalSheet" class="loanApprovalSheet" name="loanApprovalSheet"><img id="loanApprovalSheetImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanApprovalSheet; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanApprovalSheetButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($loanApprovalSheet)){
                                             echo '<button type="button" id="loanApprovalSheetUploadNew" class="loanApprovalSheetUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="loanApprovalSheetUploadNew" class="loanApprovalSheetUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="loanApprovalSheetShowOld" class="loanApprovalSheetShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="loanApprovalSheetDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanApprovalSheet, strrpos($loanApprovalSheet, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4" >
                                          <select id="loanApprovalSheetSelect" name="loanApprovalSheetSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanApprovalSheetDesc" name="loanApprovalSheetDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                              <!-- BORROWER'S RISK RATING (BRR)/CASHFLOW -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"> BORROWER'S RISK </label>
                                          <input type="file" id="riskRating" name="riskRating"><img id="riskRatingImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $riskRating; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="riskRatingButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($riskRating)){
                                             echo '<button type="button" id="riskRatingUploadNew" class="riskRatingUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="riskRatingUploadNew" class="riskRatingUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="riskRatingShowOld" class="riskRatingShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="riskRatingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($riskRating, strrpos($riskRating, '/') + 1, 10); ?></label>
                                          <label class ="micro-labels"> RATING (BRR)/CASHFLOW </label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-3">
                                          <select id="riskRatingSelect" name="riskRatingSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="riskRatingDesc" name="riskRatingDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:130%"><u>SIGNED DOCUMENTS FOR LOAN RELEASSES</u></label></div>
                                    </div>
                                 </div>
                                 <!-- PROMISSORY NOTE -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">&#x2022; PROMISSORY NOTE</label>
                                          <input type="file" id="promissoryNoteM" name="promissoryNoteM"><img id="promissoryNoteMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $promissoryNoteM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promissoryNoteMButton">Open File</button></a>
                                          <?php 
                                          if(!empty($promissoryNoteM)){
                                             echo '<button type="button" id="promissoryNoteMUploadNew" class="promissoryNoteMUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="promissoryNoteMUploadNew" class="promissoryNoteMUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="promissoryNoteMShowOld" class="promissoryNoteMShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="promissoryNoteMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promissoryNoteM, strrpos($promissoryNoteM, '/') + 1, 10); ?></label> 
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="promissoryNoteMSelect" name="promissoryNoteMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="promissoryNoteMDesc" name="promissoryNoteMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                  <!-- DISCLOSURE STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">&#x2022; DISCLOSURE STATEMENT</label>
                                          <input type="file" id="disclosureStateM" name="disclosureStateM"><img id="disclosureStateMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $disclosureStateM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateMButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($disclosureStateM)){
                                             echo '<button type="button" id="disclosureStateMUploadNew" class="disclosureStateMUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="disclosureStateMUploadNew" class="disclosureStateMUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="disclosureStateMShowOld" class="disclosureStateMShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="disclosureStateMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateM, strrpos($disclosureStateM, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="disclosureStateMSelect" name="disclosureStateMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="disclosureStateMDesc" name="disclosureStateMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                               <!--  INSURANCE DOCUMENTS-->
                                  <div class="row">
                                     <div class="col-8">
                                        <div class="py-2">
                                           <label class ="micro-labels">&#x2022; INSURANCE DOCUMENTS</label>
                                           <input type="file" id="mriForm" name="mriForm"><img id="mriFormImage" src="statusImage/check.png" alt="statusImage">
                                           <a href="<?php echo $mriForm; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="mriFormButton">Open File</button></a>
                                           <?php 
                                          if(!empty($mriForm)){
                                             echo '<button type="button" id="mriFormUploadNew" class="mriFormUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="mriFormUploadNew" class="mriFormUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="mriFormShowOld" class="mriFormShowOld">History</button>';
                                          ?>
                                           <label class="date-label" id="mriFormDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriForm, strrpos($mriForm, '/') + 1, 10); ?></label>
                                        </div>
                                     </div>
                                     <div class="col-4">
                                        <div class="form-group d-flex mb-4">
                                           <select id="mriFormSelect" name= "mriFormSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                              <option selected value="NULL">Option</option>
                                              <option value="1">VERIFIED</option>
                                              <option value="2">INCOMPLETE</option>
                                              <option value="3">N/A</option>
                                           </select>
                                           &nbsp;&nbsp;
                                           <input type="text" id="mriFormDesc" name = "mriFormDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS">&nbsp;
                                        </div>
                                     </div>
                                  </div>
                                 <!-- AMORTIZATION SCHEDULE -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                          <input type="file" id="amortScheduleM" name="amortScheduleM"><img id="amortScheduleMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $amortScheduleM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleMButton">Open File</button></a>
                                          <?php 
                                          if(!empty($amortScheduleM)){
                                             echo '<button type="button" id="amortScheduleMUploadNew" class="amortScheduleMUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="amortScheduleMUploadNew" class="amortScheduleMUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="amortScheduleMShowOld" class="amortScheduleMShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="amortScheduleMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleM, strrpos($amortScheduleM, '/') + 1, 10); ?></label> 
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex">
                                          <select id="amortScheduleMSelect" name="amortScheduleMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="amortScheduleMDesc" name="amortScheduleMDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:130%"><u>LOAN UTILIZATION REPORT</u></label></div>
                                    </div>
                                 </div>
                                   <!-- LOAN UTILIZATION REPORT-->
                                  <div class="row">
                                     <div class="col-8">
                                        <div class="py-2">
                                           <label class ="micro-labels">&#x2022; LOAN UTILIZATION</label>
                                           <input type="file" id="utilization" name="utilization"><img id="utilizationImage" src="statusImage/check.png" alt="statusImage">
                                           <a href="<?php echo $utilization; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="utilizationButton">Open File</button></a>
                                           <?php 
                                          if(!empty($utilization)){
                                             echo '<button type="button" id="utilizationUploadNew" class="utilizationUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="utilizationUploadNew" class="utilizationUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="utilizationShowOld" class="utilizationShowOld">History</button>';
                                          ?>
                                           <label class="date-label" id="utilizationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($utilization, strrpos($utilization, '/') + 1, 10); ?></label>
                                        </div>
                                     </div>
                                     <div class="col-4">
                                        <div class="form-group d-flex mb-4">
                                           <select id="utilizationSelect" name= "utilizationSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                              <option selected value="NULL">Option</option>
                                              <option value="1">VERIFIED</option>
                                              <option value="2">INCOMPLETE</option>
                                              <option value="3">N/A</option>
                                           </select>
                                           &nbsp;&nbsp;
                                           <input type="text" id="utilizationDesc" name = "utilizationDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS">&nbsp;
                                        </div>
                                     </div>
                                  </div>
                                 <div class ="OTHERS">
                                 <div class="row">
                                    <div class="col-8">
                                       <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.4em;">
                                          <div class="py-1">&nbsp;<label style="font-size:150%"><u>OTHERS</u></label></div>
                                       </div>
                                    </div>
                                 </div>
                                  <!-- BUSINESS PICTURE -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="businessPictureCheck" name="businessPictureCheck">
                                          <label class ="micro-labels">BUSINESS PICTURE </label>
                                          <input type="file" id="businessPicture" name="businessPicture"><img id="businessPictureImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $businessPicture; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessPictureButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($businessPicture)){
                                             echo '<button type="button" id="businessPictureUploadNew" class="businessPictureUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="businessPictureUploadNew" class="businessPictureUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="businessPictureShowOld" class="businessPictureShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="businessPictureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessPicture, strrpos($businessPicture, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="businessPictureSelect" name="businessPictureSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="businessPictureDesc" name="businessPictureDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- CIC -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="cicCheck" name="cicCheck">
                                          <label class ="micro-labels">CIC </label>
                                          <input type="file" id="cic" name="cic"><img id="cicImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $cic; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cicButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($cic)){
                                             echo '<button type="button" id="cicUploadNew" class="cicUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="cicUploadNew" class="cicUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="cicShowOld" class="cicShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="cicDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cic, strrpos($cic, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="cicSelect" name="cicSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="cicDesc" name="cicDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- NFIS -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="nfisCheck" name="nfisCheck">
                                          <label class ="micro-labels">NFIS </label>
                                          <input type="file" id="nfis" name="nfis"><img id="nfisImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $nfis; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="nfisButton">Open File</button></a> 
                                          <?php 
                                          if(!empty($nfis)){
                                             echo '<button type="button" id="nfisUploadNew" class="nfisUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="nfisUploadNew" class="nfisUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="nfisShowOld" class="nfisShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="nfisDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($nfis, strrpos($nfis, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="nfisSelect" name="nfisSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="nfisDesc" name="nfisDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- OTHERS (SUPPORTING DOCUMENTS) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="otherSuportCheck" name="otherSuportCheck">
                                          <input type="text" class="micro-labels" id="editableLabel" name="edit1" placeholder="OTHERS (SUPPORTING DOCUMENTS)" value = "<?php echo $edit1 ;?>" style="font-weight: bold;" tabindex="-1">
                                          <input type="file" id="otherSuport" name="otherSuport"><img id="otherSuportImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $otherSuport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherSuportButton">Open File</button></a>
                                          <?php 
                                          if(!empty($otherSuport)){
                                             echo '<button type="button" id="otherSuportUploadNew" class="otherSuportUploadNew">+</button>';
                                          }else{
                                             echo '<button type="button" id="otherSuportUploadNew" class="otherSuportUploadNew" disabled>+</button>';
                                          }
                                          echo '<button type="button" id="otherSuportShowOld" class="otherSuportShowOld">History</button>';
                                          ?>
                                          <label class="date-label" id="otherSuportDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherSuport, strrpos($otherSuport, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex">
                                          <select id="otherSuportSelect" name="otherSuportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL">Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2">INCOMPLETE</option>
                                             <option value="3">N/A</option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="otherSuportDesc" name="otherSuportDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8" style="height: 5em; margin-bottom:-2%;"></div>
                                 </div>
                              </div>
                            </div>
                           </div>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal" id="showOldModal" tabindex="-1" aria-labelledby="showOldModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="showOldModalLabel">History</h5>
            <button type="button" class="btn btn-secondary btn-sm" id="btnCloseModal" data-bs-dismiss="modal">x</button>
         </div>
         <div class="modal-body">
            <table id="oldFile" class="table table-bordered" width="100%" height="auto" cellspacing="0">
               <thead>
               <th>FILE</th>
               <th>REMARKS</th>
               <th>DATE</th>
               </thead>
            </table>
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>

<div class="modal" id="updateTerms" tabindex="-1" aria-labelledby="updateTermsLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="updateTermsLabel">UPDATE</h5>
            <!-- <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
         </div>
         <div class="modal-body">
            <form id="updaterTerms-Form" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-4">
                     <label for="amountApplyy">Amount Applied</label>
                  </div>
                  <input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $id; ?>">
                  <div class="col-md-8">
                     <input type="text" class="form-control" id="amountApplyy" name="amountApplyy" value="<?php echo $amountAppliedd; ?>" required>
                  </div>

                  <div class="py-2"></div>
                  
                  <div class="col-md-4">
                     <label for="termYearss">Terms (in Years)</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" id="termYearss" name="termYearss" value="<?php echo $amountTermss; ?>" required>
                  </div>

                  <div class="py-2"></div>

                  <div class="col-md-4">
                     <label for="intRate">Interest Rate (%)</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" id="intRate" name="intRate" value="<?php echo $interestRatee; ?>" required>
                  </div>

                  <div class="py-2"></div>

                     <div class="col-md-4">
                        <label for="sme">MSE</label>
                     </div>
                     <div class="col-md-8">
                        <select name="sme" id="sme" class="form-control">
                           <option value="" disabled selected>-- Choose SME Type --</option>
                           <option value="Small Scale Enterprises">Small Scale Enterprises</option>
                           <option value="Mediuam Scale Enterprises">Mediuam Scale Enterprises</option>
                        </select>
                     </div>
               </div>
               <div class="mt-4 d-flex justify-content-end">
                  <button type="submit" id="updater-btn" class="btn btn-primary updater-btn">SAVE</button>
               </div>
            </form>
         </div>
         <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-close">Close</button>
         </div> -->
      </div>
   </div>
</div>

<div class="modal" id="try" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">GENERATED LINK</h5>
        </div>
        <div class="modal-body">
            <!--input type="hidden" name="t_inventory_id" id="t_inventory_id" value=""-->
            <div class="row">
              <div class="col-md-9">
                <input type="text" class="form-control" id="linkGenerated" name="" value=<?php echo $link;?> readonly>
              </div>
              <div class="col-md-3">
              <button type="button" id="copyLink"style ="border-radius:5px; width: 6em;"class="btn btn-primary">COPY</button>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
   <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->


   <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
   <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
   $(document).on('click', '.btnRelease', function(e){
      var btnmicroId = $(this).val();
      // alert(btnmicroId);
      var confirmMo = confirm("Please Confirm, You want to Release this Client?");
      if(confirmMo){
         $.ajax({
            url: 'pipeMicroUpd.php',
            type: 'POST',
            data: { btnmicroId: btnmicroId },
            success: function(data){
               alert('Released Successfully!');
               window.location.reload();
            },
            error: function(xhr, status, error){
               alert('An error occurred: ' + xhr.responseText);
            }
         });
      }else{
         return false;
      }
   });

   $(document).on('click', '.btnWriteOff', function(e){
      var btnWriteOffId = $(this).val();
      // alert(btnmicroId);
      var confirmMoo = confirm("Please Confirm, You want to Written Off this Client?");
      if(confirmMoo){
         $.ajax({
            url: 'writeOffUpd.php',
            type: 'POST',
            data: { btnWriteOffId: btnWriteOffId },
            success: function(data){
               alert('Written Off Successfully!');
               // window.location.reload();
            },
            error: function(xhr, status, error){
               alert('An error occurred: ' + xhr.responseText);
            }
         });
      }else{
         return false;
      }
   });
});
</script>

<script>
   var testmodal = $('#updateTerms');

   // $(document).on('click', '#testbtn', function(e){
   //    e.preventDefault();
   //    // alert('test');
   //    testmodal.show();
   // });

   $(document).on('click', '#btn-close', function(){
      testmodal.hide();
   });

   $(document).on('change', '.loanApprovalSheet', function(e){
      e.preventDefault();
      var lam = $('.loanApprovalSheet').val();
      var updateTermForm = $('#updateTerms');
      if(lam !== ''){
         updateTermForm.show();
      }
   });
</script>

<script>
 $(document).ready(function(){
    $(document).on('submit', '#updaterTerms-Form', function(e){
      //   e.preventDefault();
        var microfinancee = document.getElementById('microfinance-form')
        var updaterForm = document.getElementById('updaterTerms-Form');
        var formData = new FormData(updaterForm);
        $.ajax({
            url: 'loanMicroUpdater.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                alert('Loan Amount & Terms Updated Successfully!');
                microfinancee.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
});
</script>

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, micId) {
    $(document).ready(function() {

      if ($.fn.DataTable.isDataTable(tableId)) {
         $(tableId).DataTable().clear().destroy();
      }
      
        var mytable = $(tableId).DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
                // Customize row style or classes if needed
            },
            'serverSide': true,
            'processing': true,
            'paging': true,
            'responsive': true,
            'order': [],
            'ajax': {
                'url': ajaxUrl,
                'type': 'post',
                'data': function(d){
                     d.micId = micId;
                }
            },
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [] // Apply sorting preferences if necessary
            }]
        });
    });
}
$(document).on('click', '#loanAppFormMShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_loanAppFormM.php', '<?php echo $id; ?>');
});

$(document).on('click', '#borrower_IdsignatureShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mborrower_IdSign.php', '<?php echo $id; ?>');
});

$(document).on('click', '#borrower_LbpShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mborrower_Lbp.php', '<?php echo $id; ?>');
});

$(document).on('click', '#borrower_LpbShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mborrower_Lpb.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coborrowerStatementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_coborrowerStatement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coBorrowerIdSignShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mcoBorrower_Id.php', '<?php echo $id; ?>');
});

$(document).on('click', '#proofIncomeShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_proofIncome.php', '<?php echo $id; ?>');
});

$(document).on('click', '#comakerStatementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_comakerStatement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMakerIdWithSignShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mcoMaker_IdSign.php', '<?php echo $id; ?>');
});

$(document).on('click', '#latestPermitShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mcoMaker_Lbp.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMakerPayslipShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mcoMaker_Payslip.php', '<?php echo $id; ?>');
});

$(document).on('click', '#businessValidationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_businessValidation.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanInstallmentShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_loanInstallment.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanPaymentShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_loanPayment.php', '<?php echo $id; ?>');
});

$(document).on('click', '#statementAccountShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_statementAccount.php', '<?php echo $id; ?>');
});

$(document).on('click', '#validCardReportShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_validCardReport.php', '<?php echo $id; ?>');
});

$(document).on('click', '#creditReportShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_creditReport.php', '<?php echo $id; ?>');
});

$(document).on('click', '#creditInvestigationReportMShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_creditInvestigationReportM.php', '<?php echo $id; ?>');
});

$(document).on('click', '#debitWaiverShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_debitWaiver.php', '<?php echo $id; ?>');
});

$(document).on('click', '#affidavitSurrenderShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_affidavitSurrender.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanApprovalSheetShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_loanApprovalSheet.php', '<?php echo $id; ?>');
});

$(document).on('click', '#riskRatingShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_riskRating.php', '<?php echo $id; ?>');
});

$(document).on('click', '#promissoryNoteMShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_promissoryNoteM.php', '<?php echo $id; ?>');
});

$(document).on('click', '#disclosureStateMShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_disclosureStateM.php', '<?php echo $id; ?>');
});

$(document).on('click', '#mriFormShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_mriForm.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortScheduleMShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_amortScheduleM.php', '<?php echo $id; ?>');
});

$(document).on('click', '#utilizationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_utilization.php', '<?php echo $id; ?>');
});

$(document).on('click', '#businessPictureShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_businessPicture.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cicShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_cic.php', '<?php echo $id; ?>');
});

$(document).on('click', '#nfisShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_nfis.php', '<?php echo $id; ?>');
});

$(document).on('click', '#otherSuportShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_otherSuport.php', '<?php echo $id; ?>');
});
</script>

<script>
var historyModal = $('#showOldModal');
 $(document).on('click', '#btnCloseModal', function(){
   historyModal.hide();
   if ($.fn.DataTable.isDataTable('#oldFile')) {
        $('#oldFile').DataTable().destroy();
   }
   });

$(document).on('click', '#loanAppFormMShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#borrower_IdsignatureShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#borrower_LbpShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#borrower_LpbShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coborrowerStatementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coBorrowerIdSignShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#proofIncomeShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#comakerStatementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMakerIdWithSignShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#latestPermitShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMakerPayslipShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#businessValidationShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#loanInstallmentShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#loanPaymentShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#statementAccountShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#validCardReportShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#creditReportShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#creditInvestigationReportMShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#debitWaiverShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#affidavitSurrenderShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#loanApprovalSheetShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#riskRatingShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#promissoryNoteMShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#disclosureStateMShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#mriFormShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#amortScheduleMShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#utilizationShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#businessPictureShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#cicShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#nfisShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#otherSuportShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});
</script>

<script>
function hideText(){
    const inputElements = document.querySelectorAll('input[type="text"].form-control.w-75.p-1.fs-4');

// Loop through each input element and set the hidden attribute
inputElements.forEach(inputElement => {
  inputElement.style.visibility="hidden";
});
  }
hideText();

  function updateFileStatus(inputId, imageId) {
  var inputFile = document.getElementById(inputId);
  var image = document.getElementById(imageId);

  if (inputFile.files.length > 0) {
    image.src = 'statusImage/check.png'; // Show check icon if file is uploaded
    image.style.visibility = 'visible'; // Make the image visible
  }
}
// Displays the 'remarks' text field if the status is set to 'INCOMPLETE'.
function handleSelectChange(selectId,textField) {
  $('#' + selectId).on('change', function() {
    var selectedValue = $(this).val();

    if (selectedValue === "2") {

      document.getElementById(textField).style.visibility = 'visible';    
    } 
    else{
      document.getElementById(textField).style.visibility = 'hidden';
    }
  });
}
// BORROWER
handleSelectChange('loanAppFormMSelect', 'loanAppFormMDesc');
handleSelectChange('borrowerValidSelect', 'borrower_IdsignatureDesc');
handleSelectChange('latestPermitSelect', 'borrower_LbpDesc');
handleSelectChange('latestProofSelect', 'borrower_LpbDesc');
// CO-MAKER 1
handleSelectChange('coborrowerStatementSelect', 'coborrowerStatementDesc');
handleSelectChange('coborrowerIdSelect', 'coBorrowerIdSignDesc');
handleSelectChange('proofIncomeSelect', 'proofIncomeDesc');
// CO-MAKER 2
handleSelectChange('comakerStatementSelect', 'comakerStatementDesc');
handleSelectChange('comakerValidSelect', 'coMakerIdWithSignDesc');
handleSelectChange('comakerPermitSelect', 'latestPermitvDesc');
handleSelectChange('comakerPayslipSelect', 'coMakerPayslipDesc');
// RENEWAL
handleSelectChange('businessValidationSelect', 'businessValidationDesc');
handleSelectChange('loanInstallmentSelect', 'loanInstallmentDesc');
handleSelectChange('loanPaymentSelect', 'loanPaymentDesc');
handleSelectChange('statementAccountSelect', 'statementAccountDesc');
// OTHERS
handleSelectChange('businessPictureSelect', 'businessPictureDesc');
handleSelectChange('cicSelect', 'cicDesc');
handleSelectChange('nfisSelect', 'nfisDesc');
handleSelectChange('otherSuportSelect', 'otherSuportDesc');
// DOCUMENTS
handleSelectChange('validCardReportSelect', 'validCardReportDesc');
handleSelectChange('creditReportSelect', 'creditReportDesc');
handleSelectChange('creditInvestigationReportMSelect', 'creditInvestigationReportMDesc');
handleSelectChange('debitWaiverSelect', 'debitWaiverDesc');
handleSelectChange('affidavitSurrenderSelect', 'affidavitSurrenderDesc');
handleSelectChange('riskRatingSelect', 'riskRatingDesc');
handleSelectChange('loanApprovalSheetSelect', 'loanApprovalSheetDesc');
handleSelectChange('promissoryNoteMSelect', 'promissoryNoteMDesc');
handleSelectChange('disclosureStateMSelect', 'disclosureStateMDesc');
handleSelectChange('mriFormSelect', 'mriFormDesc');
handleSelectChange('amortScheduleMSelect', 'amortScheduleMDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');
</script>

<!-- Microfinance AJAX -->
<script>
var microform = document.getElementById("microfinance-form");
var microId = "<?php echo $id; ?>";
var fullname = "<?php echo $fullname; ?>";
var salaryType = "<?php echo $type; ?>";
var branch = "<?php echo $branch; ?>";
var loanType = "<?php echo $loanType; ?>";
var endPrompt = ""; // Global variable for remarks
//Function to handle file upload separately
function uploadFileM() {
   var microformData = new FormData(microform);
   microformData.append('microId', microId);
   microformData.append('fullname', fullname);
   microformData.append('salaryType', salaryType);
   microformData.append('branch', branch);
   microformData.append('loanType', loanType);

   // Append the endPrompt to the FormData
   microformData.append('endPrompt', endPrompt);

  $.ajax({
    url: 'loanMicroUploadData.php', // Targeted URL
    type: 'POST',
    data: microformData,
    processData: false,
    contentType: false,
    success: function(response) {
      // BORROWER
      updateFileStatus('loanAppFormM', 'loanAppFormMImage');
      updateFileStatus('borrower_Idsignature', 'borrower_IdsignatureImage');
      updateFileStatus('borrower_Lbp', 'borrower_LbpImage');
      updateFileStatus('borrower_Lpb', 'borrower_LpbImage');
      // CO BORROWER
      updateFileStatus('coborrowerStatement', 'coborrowerStatementImage');
      updateFileStatus('coBorrowerIdSign', 'coBorrowerIdSignImage');
      updateFileStatus('proofIncome', 'proofIncomeImage');
      // CO MAKER
      updateFileStatus('comakerStatement', 'comakerStatementImage');
      updateFileStatus('coMakerIdWithSign', 'coMakerIdWithSignImage');
      updateFileStatus('latestPermit', 'latestPermitImage');
      updateFileStatus('coMakerPayslip', 'coMakerPayslipImage');
      // RENEWAL
      updateFileStatus('businessValidation', 'businessValidationImage');
      updateFileStatus('loanInstallment', 'loanInstallmentImage');
      updateFileStatus('loanPayment', 'loanPaymentImage');
      updateFileStatus('statementAccount', 'statementAccountImage');
      // OTHERS
      updateFileStatus('businessPicture', 'businessPictureImage');
      updateFileStatus('cic', 'cicImage');
      updateFileStatus('nfis', 'nfisImage');
      updateFileStatus('otherSuport', 'otherSuportImage');
      // DOCUMENTS
      updateFileStatus('validCardReport', 'validCardReportImage');
      updateFileStatus('creditReport', 'creditReportImage');
      updateFileStatus('creditInvestigationReportM', 'creditInvestigationReportMImage');
      updateFileStatus('debitWaiver', 'debitWaiverImage');
      updateFileStatus('affidavitSurrender', 'affidavitSurrenderImage');
      updateFileStatus('riskRating', 'riskRatingImage');
      updateFileStatus('loanApprovalSheet', 'loanApprovalSheetImage');
      // AFTER RELEASE DOCUMENTS
      updateFileStatus('promissoryNoteM', 'promissoryNoteMImage');
      updateFileStatus('disclosureStateM', 'disclosureStateMImage');
      updateFileStatus('mriForm', 'mriFormImage');
      updateFileStatus('amortScheduleM', 'amortScheduleMImage');
      updateFileStatus('utilization', 'utilizationImage');
    },
    error: function(xhr, status, error) {
      console.log('File upload failed');
    }
  });
}

var isUploading = false;  // Flag to track upload process

function handleEndorsementUpload(inputSelector) {
    if (isUploading) return;  // Prevent multiple prompts for a single click

    isUploading = true;  // Set the flag to indicate the upload process has started
    var endPrompt = prompt('Remarks: ');

    if (endPrompt !== null && endPrompt.trim() !== "") {
        // Create FormData object
        var formData = new FormData();
        var microId = "<?php echo $id; ?>";
        formData.append('endPrompt', endPrompt);  // Add remarks to the form data
        formData.append('microId', microId);

        // Trigger the file input and append the selected file to the form data
        setTimeout(function() {
            var fileInput = document.querySelector(inputSelector);
            fileInput.onchange = function() {
                var file = fileInput.files[0];
                if (file) {
                    formData.append(fileInput.name, file);  // Add file to the form data

                    // Log FormData before sending (use array for better readability)
                    console.log("FormData before AJAX:", Array.from(formData.entries()));

                    // Send form data via AJAX
                    $.ajax({
                        url: 'loanMicroUploadData.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                           console.log("Server response:", response); // Log response for debugging
                           alert('Updated Successfully!');
                           isUploading = false;  // Reset flag after successful upload
                           if(inputSelector !== '#loanApprovalSheet'){
                              window.location.reload();
                           }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error); // Log error for debugging
                            alert('Failed to upload');
                            isUploading = false;  // Reset flag after upload failure
                        }
                    });

                    fileInput.onchange = null;  // Remove onchange handler after the first upload
                } else {
                    isUploading = false;  // Reset flag if no file selected
                }
            };
            $(inputSelector).click();
        }, 1000);
    } else {
        if (endPrompt === null) {
            // User clicked cancel, handle the cancel case
            alert('Remarks are needed to proceed.');
            console.log('Prompt was cancelled');
            isUploading = false;  // Reset flag after cancellation
        } else {
            // User entered remarks, proceed with your logic
            console.log('Remarks:', endPrompt);
            isUploading = false;  // Reset flag if remarks are invalid
        }
    }
}

    // for loanAppFormM
    $(document).on('click', '.loanAppFormMUploadNew', function(e){
         e.preventDefault();
         handleEndorsementUpload('#loanAppFormM');
    });

    // for borrower_Idsignature
    $(document).on('click', '.borrower_IdsignatureUploadNew', function(e){
         e.preventDefault();
        handleEndorsementUpload('#borrower_Idsignature');
    });

    //  for borrower_Lbp
    $(document).on('click', '.borrower_LbpUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#borrower_Lbp');
    });

    // for borrower_Lpb
    $(document).on('click', '.borrower_LpbUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#borrower_Lpb');
    });

    //  for coborrowerStatement
    $(document).on('click', '.coborrowerStatementUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coborrowerStatement');
    });

    //  for coBorrowerIdSign
    $(document).on('click', '.coBorrowerIdSignUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coBorrowerIdSign');
    });

      //  for ProofOfIncome
   $(document).on('click', '.proofIncomeUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#proofIncome');
    });


    //  for comakerStatement
    $(document).on('click', '.comakerStatementUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#comakerStatement');
    });

    //  for coMakerIdWithSign
    $(document).on('click', '.coMakerIdWithSignUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coMakerIdWithSign');
    });

    //  for latestPermit
    $(document).on('click', '.latestPermitUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#latestPermit');
    });

    //  for coMakerPayslip
    $(document).on('click', '.coMakerPayslipUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coMakerPayslip');
    });

    //  for businessValidation
    $(document).on('click', '.businessValidationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#businessValidation');
    });

     //  for loanInstallment
    $(document).on('click', '.loanInstallmentUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#loanInstallment');
    });

    //  for loanPayment
    $(document).on('click', '.loanPaymentUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#loanPayment');
    });

    //  for statementAccount
    $(document).on('click', '.statementAccountUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#statementAccount');
    });

    //  for validCardReport
    $(document).on('click', '.validCardReportUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#validCardReport');
    });

    //  for creditReport
    $(document).on('click', '.creditReportUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#creditReport');
    });

    //  for creditInvestigationReportM
    $(document).on('click', '.creditInvestigationReportMUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#creditInvestigationReportM');
    });

    //  for debitWaiver
    $(document).on('click', '.debitWaiverUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#debitWaiver');
    });

    //  for affidavitSurrender
    $(document).on('click', '.affidavitSurrenderUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#affidavitSurrender');
    });

    //  for loanApprovalSheet
    $(document).on('click', '.loanApprovalSheetUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#loanApprovalSheet');
    });

    //  for riskRating
    $(document).on('click', '.riskRatingUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#riskRating');
    });

    //  for promissoryNoteM
    $(document).on('click', '.promissoryNoteMUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#promissoryNoteM');
    });

    //  for disclosureStateM
    $(document).on('click', '.disclosureStateMUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#disclosureStateM');
    });

    //  for mriForm
    $(document).on('click', '.mriFormUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#mriForm');
    });

    //  for amortScheduleM
    $(document).on('click', '.amortScheduleMUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#amortScheduleM');
    });

    //  for utilization
    $(document).on('click', '.utilizationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#utilization');
    });

    //  for businessPicture
    $(document).on('click', '.businessPictureUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#businessPicture');
    });

        //  for cic
    $(document).on('click', '.cicUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#cic');
    });

        //  for nfis
    $(document).on('click', '.nfisUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#nfis');
    });

    //  for otherSuport
    $(document).on('click', '.otherSuportUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#otherSuport');
    });

   microform.addEventListener("change", function() {
   uploadFileM();
   });
</script>

<!--  Approval Status and Description -->
<script>
function selectOptionBasedOnValue(fieldValue, selectionId, description) {
  var dropdown = document.getElementById(selectionId);
  var descriptionElement = document.getElementById(description);

  if (dropdown && descriptionElement) {
    for (var i = 0; i < dropdown.options.length; i++) {
      if (dropdown.options[i].value === fieldValue.split("--")[0]) {
        var splitResult = fieldValue.split("--");
        if (splitResult.length === 2) {
          descriptionElement.style.visibility = "visible";
          descriptionElement.value = splitResult[1];
        } else {
          descriptionElement.style.visibility = "hidden";
          descriptionElement.value = ""; // Clear the value if it doesn't contain "--"
        }
        dropdown.selectedIndex = i;
        break;
      }
    }
  } else {
    console.error("Dropdown or description element not found.");
  }
}
// Used explode, to cut the data 

// BORROWER
selectOptionBasedOnValue('<?php echo $loanAppFormMSelect; ?>', 'loanAppFormMSelect','loanAppFormMDesc');
selectOptionBasedOnValue('<?php echo $borrower_IdSignSelect; ?>', 'borrowerValidSelect','borrower_IdsignatureDesc');
selectOptionBasedOnValue('<?php echo $borrower_LbpSelect; ?>', 'latestPermitSelect','borrower_LbpDesc');
selectOptionBasedOnValue('<?php echo $borrower_LpbSelect; ?>', 'latestProofSelect','borrower_LpbDesc');
// CO BORROWER
selectOptionBasedOnValue('<?php echo $coborrowerStatementSelect; ?>', 'coborrowerStatementSelect','coborrowerStatementDesc');
selectOptionBasedOnValue('<?php echo $coBorrower_IdSignSelect; ?>', 'coborrowerIdSelect','coBorrowerIdSignDesc');
selectOptionBasedOnValue('<?php echo $proofIncomeSelect; ?>', 'proofIncomeSelect','proofIncomeDesc');
// CO MAKER
selectOptionBasedOnValue('<?php echo $comakerStatementSelect; ?>', 'comakerStatementSelect','comakerStatementDesc');
selectOptionBasedOnValue('<?php echo $coMaker_IdSignSelect; ?>', 'comakerValidSelect','coMakerIdWithSignDesc');
selectOptionBasedOnValue('<?php echo $coMaker_LbpSelect; ?>', 'comakerPermitSelect','latestPermitvDesc');
selectOptionBasedOnValue('<?php echo $coMaker_PayslipSelect; ?>', 'comakerPayslipSelect','coMakerPayslipDesc');
// CO MAKER
selectOptionBasedOnValue('<?php echo $businessValidationSelect; ?>', 'businessValidationSelect','businessValidationDesc');
selectOptionBasedOnValue('<?php echo $loanInstallmentSelect; ?>', 'loanInstallmentSelect','loanInstallmentDesc');
selectOptionBasedOnValue('<?php echo $loanPaymentSelect; ?>', 'loanPaymentSelect','loanPaymentDesc');
selectOptionBasedOnValue('<?php echo $statementAccountSelect; ?>', 'statementAccountSelect','statementAccountDesc');
// OTHERS
selectOptionBasedOnValue('<?php echo $businessPictureSelect; ?>', 'businessPictureSelect','businessPictureDesc');
selectOptionBasedOnValue('<?php echo $cicSelect; ?>', 'cicSelect', 'cicDesc');
selectOptionBasedOnValue('<?php echo $nfisSelect; ?>', 'nfisSelect', 'nfisDesc');
selectOptionBasedOnValue('<?php echo $otherSuportSelect; ?>', 'otherSuportSelect','otherSuportDesc');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo $validCardReportSelect; ?>', 'validCardReportSelect','validCardReportDesc');
selectOptionBasedOnValue('<?php echo $creditReportSelect; ?>', 'creditReportSelect','creditReportDesc');
selectOptionBasedOnValue('<?php echo $creditInvestigationReportMSelect; ?>', 'creditInvestigationReportMSelect','creditInvestigationReportMDesc');
selectOptionBasedOnValue('<?php echo $debitWaiverSelect; ?>', 'debitWaiverSelect','debitWaiverDesc');
selectOptionBasedOnValue('<?php echo $affidavitSurrenderSelect; ?>', 'affidavitSurrenderSelect','affidavitSurrenderDesc');
selectOptionBasedOnValue('<?php echo $riskRatingSelect; ?>', 'riskRatingSelect','riskRatingDesc');
selectOptionBasedOnValue('<?php echo $loanApprovalSheetSelect; ?>', 'loanApprovalSheetSelect','loanApprovalSheetDesc');
selectOptionBasedOnValue('<?php echo $promissoryNoteMSelect; ?>', 'promissoryNoteMSelect','promissoryNoteMDesc');
selectOptionBasedOnValue('<?php echo $disclosureStateMSelect; ?>', 'disclosureStateMSelect','disclosureStateMDesc');
selectOptionBasedOnValue('<?php echo $mriFormSelect; ?>', 'mriFormSelect','mriFormDesc');
selectOptionBasedOnValue('<?php echo $amortScheduleMSelect; ?>', 'amortScheduleMSelect','amortScheduleMDesc');
selectOptionBasedOnValue('<?php echo $utilizationSelect; ?>', 'utilizationSelect','utilizationDesc');
</script>


<script>
  
//   // Only BM can see the Upload Button
// $(document).ready(function() {
//   var bm= "<?php echo $_SESSION['position']; ?>";
//   var username = "<?php echo $_SESSION['username']; ?>";
//   if (bm == "BM" || username == "jcvillanueva" || username == "vcdyoshino") {
//   $('.microfinance-tabs input[type="file"]').css('visibility', 'visible');
  
// } else {
//   $('.microfinance-tabs  input[type="file"]').css('visibility', 'hidden'); 
// }
// });
</script>

<script>
function initializeCheckboxes() {  
  var businessPictureValue = "<?php echo $businessPictureCheck; ?>";
  var cicValue = "<?php echo $cicCheck; ?>";
  var nfisValue = "<?php echo $nfisCheck; ?>";
  var otherSuportValue = "<?php echo $otherSuportCheck; ?>";
  var renewalValue = "<?php echo $renewalCheck; ?>";


  // Get the checkbox elements
  const businessPictureCheck = document.getElementById('businessPictureCheck');
  const cicCheck = document.getElementById('cicCheck');
  const nfisCheck = document.getElementById('nfisCheck');
  const otherSuportCheck = document.getElementById('otherSuportCheck');

  // Check the checkboxes based on the PHP Data
  function showInput(inputValue, checkbox, files, select, description, image) {
   if (inputValue === "Check") {
    checkbox.setAttribute('checked', 'checked');
  } else if(inputValue=="Uncheck" || inputValue==""){
    document.getElementById(select).style.visibility = "hidden";
    document.getElementById(files).style.display = "none";
    document.getElementById(description).style.visibility = "hidden";
    document.getElementById(image).style.visibility = "hidden";
  }
}


showInput(businessPictureValue, businessPictureCheck,'businessPicture', 'businessPictureSelect', 'businessPictureDesc', `businessPictureImage`);
showInput(cicValue, cicCheck, 'cic', 'cicSelect', 'cicDesc', 'cicImage');
showInput(nfisValue, nfisCheck, 'nfis', 'nfisSelect', 'nfisDesc', 'nfisImage');
showInput(otherSuportValue, otherSuportCheck,'otherSuport', 'otherSuportSelect', 'otherSuportDesc',`otherSuportImage`);

if(renewalValue =="Check"){
   document.getElementById('renewalCheck').checked = true;

}else if(renewalValue=="Uncheck" || renewalValue==""){
   document.getElementById("businessValidationSelect").style.visibility = "hidden";
    document.getElementById("loanInstallmentSelect").style.visibility = "hidden";
    document.getElementById("loanPaymentSelect").style.visibility = "hidden";
    document.getElementById("statementAccountSelect").style.visibility = "hidden";

    document.getElementById("businessValidation").style.display = "none";
    document.getElementById("loanInstallment").style.display = "none";
    document.getElementById("loanPayment").style.display = "none";
    document.getElementById("statementAccount").style.display = "none";
  }
}


// Call the function to initialize the checkboxes on page load
initializeCheckboxes();

</script>
<script>
function toggleVisibility(elementId) {
    var element = document.getElementById(elementId);
    var selectElement = document.getElementById(elementId + 'Select');
    var descElement = document.getElementById(elementId + 'Desc');
    if (element.style.display === 'none') {
        element.style.display = "inline";
        selectElement.style.visibility = "visible";
        selectElement.selectedIndex = 0;
    } else {
        element.style.display = "none";
        selectElement.style.visibility = "hidden";

        if(descElement.style.visibility==='visible'){
          descElement.style.visibility="hidden";
        }
    }
}

document.getElementById("businessPictureCheck").addEventListener("click", function() {
    toggleVisibility('businessPicture');
});

document.getElementById("cicCheck").addEventListener("click", function() {
    toggleVisibility('cic');
});

document.getElementById("nfisCheck").addEventListener("click", function() {
    toggleVisibility('nfis');
});

document.getElementById("otherSuportCheck").addEventListener("click", function() {
    toggleVisibility('otherSuport');
});

document.getElementById("renewalCheck").addEventListener("click", function() {
    toggleVisibility('businessValidation');
    toggleVisibility('loanInstallment');
    toggleVisibility('loanPayment');
    toggleVisibility('statementAccount');
});
</script>

<script>
// RESET THE VALUE OF SELECT TO ZERO(OPTION)
  function resetIndex(targetId,targetSelect,targetDesc){
  document.getElementById(targetId).addEventListener('change', function() {
  var selectElement = document.getElementById(targetSelect);
  selectElement.selectedIndex = 0;
  document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
  });
  }
// BORROWER
resetIndex('loanAppFormM', 'loanAppFormMSelect', 'loanAppFormMDesc');
resetIndex('borrower_Idsignature', 'borrowerValidSelect', 'borrower_IdsignatureDesc');
resetIndex('borrower_Lbp', 'latestPermitSelect', 'borrower_LbpDesc');
resetIndex('borrower_Lpb', 'latestProofSelect', 'borrower_LpbDesc');
// CO BORROWER
resetIndex('coborrowerStatement', 'coborrowerStatementSelect', 'coborrowerStatementDesc');
resetIndex('coBorrowerIdSign', 'coborrowerIdSelect', 'coBorrowerIdSignDesc');
resetIndex('proofIncome', 'proofIncomeSelect', 'proofIncomeDesc');
// CO MAKER
resetIndex('comakerStatement', 'comakerStatementSelect', 'comakerStatementDesc');
resetIndex('coMakerIdWithSign', 'comakerValidSelect', 'coMakerIdWithSignDesc');
resetIndex('latestPermit', 'comakerPermitSelect', 'latestPermitvDesc');
resetIndex('coMakerPayslip', 'comakerPayslipSelect', 'coMakerPayslipDesc');
// RENEWAL
resetIndex('businessValidation', 'businessValidationSelect', 'businessValidationDesc');
resetIndex('loanInstallment', 'loanInstallmentSelect', 'loanInstallmentDesc');
resetIndex('loanPayment', 'loanPaymentSelect', 'loanPaymentDesc');
resetIndex('statementAccount', 'statementAccountSelect', 'statementAccountDesc');
// OTHERS
resetIndex('businessPicture', 'businessPictureSelect', 'businessPictureDesc');
resetIndex('cic', 'cicSelect', 'cicDesc');
resetIndex('nfis', 'nfisSelect', 'nfisDesc');
resetIndex('otherSuport', 'otherSuportSelect', 'otherSuportDesc');
// DOCUMENTS
resetIndex('validCardReport', 'validCardReportSelect', 'validCardReportDesc');
resetIndex('creditReport', 'creditReportSelect', 'creditReportDesc');
resetIndex('creditInvestigationReportM', 'creditInvestigationReportMSelect', 'creditInvestigationReportMDesc');
resetIndex('debitWaiver', 'debitWaiverSelect', 'debitWaiverDesc');
resetIndex('affidavitSurrender', 'affidavitSurrenderSelect', 'affidavitSurrenderDesc');
resetIndex('riskRating', 'riskRatingSelect', 'riskRatingDesc');
resetIndex('loanApprovalSheet', 'loanApprovalSheetSelect', 'loanApprovalSheetDesc');
resetIndex('promissoryNoteM', 'promissoryNoteMSelect', 'promissoryNoteMDesc');
resetIndex('disclosureStateM', 'disclosureStateMSelect', 'disclosureStateMDesc');
resetIndex('mriForm', 'mriFormSelect', 'mriFormDesc');
resetIndex('amortScheduleM', 'amortScheduleMSelect', 'amortScheduleMDesc');
resetIndex('utilization', 'utilizationSelect', 'utilizationDesc');
</script> 


<script>

   function setFileVisibility(files, select, input, check, button, date){
      if(files !==""){
         document.getElementById(input).style.display="none";
         document.getElementById(check).style.visibility="visible";
         document.getElementById(button).style.display="inline";
         document.getElementById(date).style.display="inline";
            if(select.split('--')[0] == "2"){
               document.getElementById(input).style.display = "inline";
               document.getElementById(check).src = 'statusImage/xmark.png';
               document.getElementById(button).style.display="none";
               document.getElementById(date).style.display="none";
         }

      }
      else{
         document.getElementById(button).style.display="none";
         document.getElementById(date).style.display="none";
         if(select.split('--')[0] == "2" || select=="NULL" || select==""){
            document.getElementById(check).style.visibility = "visible";
            document.getElementById(check).src = 'statusImage/xmark.png';
         }
      }

   }
// BORROWER
setFileVisibility("<?php echo $loanAppFormM; ?>", "<?php echo $loanAppFormMSelect; ?>", 'loanAppFormM', 'loanAppFormMImage', 'loanAppFormMButton', 'loanAppFormMDate');
setFileVisibility("<?php echo $borrower_Idsignature; ?>", "<?php echo $borrower_IdSignSelect; ?>", 'borrower_Idsignature', 'borrower_IdsignatureImage', 'borrower_IdsignatureButton', 'borrower_IdsignatureDate');
setFileVisibility("<?php echo $borrower_Lbp; ?>", "<?php echo $borrower_LbpSelect; ?>", 'borrower_Lbp', 'borrower_LbpImage', 'borrower_LbpButton', 'borrower_LbpDate');
setFileVisibility("<?php echo $borrower_Lpb; ?>", "<?php echo $borrower_LpbSelect; ?>", 'borrower_Lpb', 'borrower_LpbImage', 'borrower_LpbButton', 'borrower_LpbDate');
// CO BORROWER
setFileVisibility("<?php echo $coborrowerStatement; ?>", "<?php echo $coborrowerStatementSelect; ?>", 'coborrowerStatement', 'coborrowerStatementImage', 'coborrowerStatementButton', 'coborrowerStatementDate');
setFileVisibility("<?php echo $coBorrowerIdSign; ?>", "<?php echo $coBorrower_IdSignSelect; ?>", 'coBorrowerIdSign', 'coBorrowerIdSignImage', 'coBorrowerIdSignButton', 'coBorrowerIdSignDate');
setFileVisibility("<?php echo $proofIncome; ?>", "<?php echo $proofIncomeSelect; ?>", 'proofIncome', 'proofIncomeImage', 'proofIncomeButton', 'proofIncomeDate');
// CO MAKER
setFileVisibility("<?php echo $comakerStatement;?>", "<?php echo $comakerStatementSelect; ?>", 'comakerStatement', 'comakerStatementImage', 'comakerStatementButton', 'comakerStatementDate');
setFileVisibility("<?php echo $coMakerIdWithSign; ?>", "<?php echo $coMaker_IdSignSelect; ?>", 'coMakerIdWithSign', 'coMakerIdWithSignImage', 'coMakerIdWithSignButton', 'coMakerIdWithSignDate');
setFileVisibility("<?php echo $latestPermit; ?>", "<?php echo $coMaker_LbpSelect; ?>", 'latestPermit', 'latestPermitImage', 'latestPermitButton', 'latestPermitDate');
setFileVisibility("<?php echo $coMakerPayslip; ?>", "<?php echo $coMaker_PayslipSelect; ?>", 'coMakerPayslip', 'coMakerPayslipImage', 'coMakerPayslipButton', 'coMakerPayslipDate');
// RENEWAL
setFileVisibility("<?php echo $businessValidation;?>", "<?php echo $businessValidationSelect; ?>", 'businessValidation', 'businessValidationImage', 'businessValidationButton', 'businessValidationDate');
setFileVisibility("<?php echo $loanInstallment; ?>", "<?php echo $loanInstallmentSelect; ?>", 'loanInstallment', 'loanInstallmentImage', 'loanInstallmentButton', 'loanInstallmentDate');
setFileVisibility("<?php echo $loanPayment; ?>", "<?php echo $loanPaymentSelect; ?>", 'loanPayment', 'loanPaymentImage', 'loanPaymentButton', 'loanPaymentDate');
setFileVisibility("<?php echo $statementAccount; ?>", "<?php echo $statementAccountSelect; ?>", 'statementAccount', 'statementAccountImage', 'statementAccountButton', 'statementAccountDate');
// OTHERS
setFileVisibility("<?php echo $businessPicture; ?>", "<?php echo $businessPictureSelect;?>", 'businessPicture', 'businessPictureImage', 'businessPictureButton', 'businessPictureDate');
setFileVisibility("<?php echo $cic; ?>", "<?php echo $cicSelect;  ?>", 'cic', 'cicImage', 'cicButton', 'cicDate');
setFileVisibility("<?php echo $nfis; ?>", "<?php echo $nfisSelect; ?>", 'nfis', 'nfisImage', 'nfisButton', 'nfisDate');
setFileVisibility("<?php echo $otherSuport; ?>", "<?php echo $otherSuportSelect; ?>", 'otherSuport', 'otherSuportImage', 'otherSuportButton', 'otherSuportDate');
// DOCUMENTS
setFileVisibility("<?php echo $validCardReport; ?>", "<?php echo $validCardReportSelect; ?>", 'validCardReport', 'validCardReportImage', 'validCardReportButton', 'validCardReportDate');
setFileVisibility("<?php echo $creditReport; ?>", "<?php echo $creditReportSelect; ?>", 'creditReport', 'creditReportImage', 'creditReportButton', 'creditReportDate');
setFileVisibility("<?php echo $creditInvestigationReportM; ?>", "<?php echo $creditInvestigationReportMSelect; ?>", 'creditInvestigationReportM', 'creditInvestigationReportMImage', 'creditInvestigationReportMButton', 'creditInvestigationReportMDate');
setFileVisibility("<?php echo $debitWaiver; ?>", "<?php echo $debitWaiverSelect; ?>", 'debitWaiver', 'debitWaiverImage', 'debitWaiverButton', 'debitWaiverDate');
setFileVisibility("<?php echo $affidavitSurrender; ?>", "<?php echo $affidavitSurrenderSelect; ?>", 'affidavitSurrender', 'affidavitSurrenderImage', 'affidavitSurrenderButton', 'affidavitSurrenderDate');
setFileVisibility("<?php echo $riskRating; ?>", "<?php echo $riskRatingSelect; ?>", 'riskRating', 'riskRatingImage', 'riskRatingButton', 'riskRatingDate');
setFileVisibility("<?php echo $loanApprovalSheet; ?>", "<?php echo $loanApprovalSheetSelect; ?>", 'loanApprovalSheet', 'loanApprovalSheetImage', 'loanApprovalSheetButton', 'loanApprovalSheetDate');
setFileVisibility("<?php echo $promissoryNoteM; ?>", "<?php echo $promissoryNoteMSelect; ?>", 'promissoryNoteM', 'promissoryNoteMImage', 'promissoryNoteMButton', 'promissoryNoteMDate');
setFileVisibility("<?php echo $disclosureStateM; ?>", "<?php echo $disclosureStateMSelect; ?>", 'disclosureStateM', 'disclosureStateMImage', 'disclosureStateMButton', 'disclosureStateMDate');
setFileVisibility("<?php echo $mriForm; ?>", "<?php echo $mriFormSelect; ?>", 'mriForm', 'mriFormImage', 'mriFormButton', 'mriFormDate');
setFileVisibility("<?php echo $amortScheduleM; ?>", "<?php echo $amortScheduleMSelect; ?>", 'amortScheduleM', 'amortScheduleMImage', 'amortScheduleMButton', 'amortScheduleMDate');
setFileVisibility("<?php echo $utilization; ?>", "<?php echo $utilizationSelect; ?>", 'utilization', 'utilizationImage', 'utilizationButton', 'utilizationDate');

</script>
<script>

   function handleSearch() {
        // BUTTONS SELECTORS
        const selectElements = document.querySelectorAll('#microfinance select');
        const descriptionInputs = document.querySelectorAll('#microfinance input[type=text]');
        const inputFiles = document.querySelectorAll('.microfinance-tabs input[type=file]');
        const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
        const creditButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
        const checkboxes = document.querySelectorAll("input[type=checkbox]");

       
        var username = "<?php echo $_SESSION['username']; ?>";
        var bankposition = "<?php echo $_SESSION['bankposition']; ?>";
        var position = "<?php echo $_SESSION['position']; ?>";
        var department = "<?php echo $_SESSION['department']; ?>";

        // ONLY THIS PERSON CAN ACCESS APRROVAL SECTION
        if (bankposition !== "Loan Docu. Assistant" && department !== "1" && username !== "jlcricafrente") {
                  selectElements.forEach(function(selectElement) {
                     selectElement.style.pointerEvents = "none";

             });
                  descriptionInputs.forEach(function(descriptionInput) {
                     descriptionInput.setAttribute("readonly", "readonly");
             });
         }
   // REQUIREMENTS RESTRICTION
   if(position !== "BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" && department !== "1" 
      && bankposition !== "LOAN Officer"  && bankposition !== "LOAN Assistant" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez') {
      inputFiles.forEach(function(inputFile){
         inputFile.style.display="none";
      });
   }     
   if(bankposition!=="LOAN Assistant" && position!=="BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" 
      && department!=="1" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
      document.getElementById("validCardReport").style.display="none";
      document.getElementById("debitWaiver").style.display="none";
      document.getElementById("affidavitSurrender").style.display="none";
   }

   if(username !== "cevinluan" && bankposition !== "LOAN Assistant" && bankposition!=="LOAN Assistant" && position!=="BM" && username !== "jabportillo" 
      && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" && department!=="1" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== "jlcvalero" && username !== 'rdalvarez' && username !== 'rdiones'){
      document.getElementById("creditReport").style.display="none";
      document.getElementById("creditInvestigationReportM").style.display="none";
   }
   if(username !== "scpayac" &&  bankposition !== "LOAN Assistant" && position !== "BM" && username !== "jabportillo" && username !== "ejcemata"
      && username !== "dgayac" && username !== "dmsantos" && department!=="1" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
      document.getElementById("validCardReport").style.display="none";

   }
   if(bankposition !== "LOAN Assistant" && position !== "BM" && username !== "jabportillo" && username !== "ejcemata" && username!=="scpayac" 
      && username !== "dgayac" && username !== "dmsantos" && department!=="1" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
      document.getElementById("riskRating").style.display="none";
      document.getElementById("loanApprovalSheet").style.display="none";
      document.getElementById("promissoryNoteM").style.display="none";
      document.getElementById("disclosureStateM").style.display="none";
      document.getElementById("mriForm").style.display="none";
      document.getElementById("amortScheduleM").style.display="none";
   }
   if(username !== "scpayac" && bankposition !== "LOAN Assistant" && position !== "BM" && username !== "jabportillo" && username !== "ejcemata" 
      && username !== "dgayac" && username !== "dmsantos" && department !=="1" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== "jlcricafrente" && username !== 'rdalvarez'){
      document.getElementById("businessPicture").style.display="none";
      document.getElementById("cic").style.display="none";
      document.getElementById("nfis").style.display="none";
      document.getElementById("otherSuport").style.display="none";

      document.getElementById("businessPictureUploadNew").style.display="none";
      document.getElementById("cicUploadNew").style.display="none";
      document.getElementById("nfisUploadNew").style.display="none";
      document.getElementById("otherSuportUploadNew").style.display="none";

      checkboxes.forEach(function (checkbox){
         checkbox.style.pointerEvents = "none";
      });
      document.getElementById("editableLabel").style.pointerEvents = "none";
   }
   if(position !=="BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" && username!=="jdiokno" && department !== "1" 
      && username !== "hmmendoza" && username !== 'hriegodedios' && username !== "tjqpasicolan" && username !== 'cgluda' && username !== 'rdalvarez'){
      document.getElementById("utilization").style.display="none";
   } 
   if(username !="scpayac" && department != "1"){
      document.getElementById("nextbankSection").style.display="none";
     
   } 
      document.getElementById("productID").removeAttribute("readonly");
   
    }

    // Important!!, Allow the it to initially run this function first.
    handleSearch();
</script>
<script>
document.getElementById("copyLink").addEventListener("click", function() {
   var copyText = document.getElementById("linkGenerated");
   copyText.select();
   try {
       document.execCommand("copy");
       alert('Copied successfully!');
   } catch (err) {
       alert('Unable to copy text. Please try manually.');
   }
});
</script>
<script>
   function showText(target){
      var modal = document.getElementById("myModal");
      var span = document.getElementById("closeModal");
      var btn = document.getElementById(target);
      var modalText = document.getElementById("modalText"); // Get the modalText element

      // When the button is clicked, display the modal
      btn.addEventListener("click", function () {
            modalText.textContent = btn.value; // Set the modalText content
            modal.style.display = "block";
            
         
      });

      btn.addEventListener("input", function () {
            modalText.textContent = btn.value; // Set the modalText content
            modalText.textContent = textField.value;
         
      });
      // When the 'x' (close) is clicked, close the modal
      span.addEventListener("click", function () {
         modal.style.display = "none";
      });

      // When the background is clicked, close the modal
      window.addEventListener("click", function (event) {
         if (event.target === modal) {
            modal.style.display = "none";
         }
      });

      }

      showText('loanAppFormMDesc');
      showText('borrower_IdsignatureDesc');
      showText('borrower_LbpDesc');
      showText('borrower_LpbDesc');
      showText('coborrowerStatementDesc');
      showText('coBorrowerIdSignDesc');
      showText('proofIncomeDesc');
      showText('comakerStatementDesc');
      showText('coMakerIdWithSignDesc');
      showText('latestPermitvDesc');
      showText('coMakerPayslipDesc');
      showText('businessValidationDesc');
      showText('loanInstallmentDesc');
      showText('loanPaymentDesc');
      showText('statementAccountDesc');
      showText('businessPictureDesc');
      showText('cicDesc');
      showText('nfisDesc');
      showText('otherSuportDesc');
      showText('validCardReportDesc');
      showText('creditReportDesc');
      showText('creditInvestigationReportMDesc');
      showText('debitWaiverDesc');
      showText('affidavitSurrenderDesc');
      showText('riskRatingDesc');
      showText('loanApprovalSheetDesc');
      showText('promissoryNoteMDesc');
      showText('disclosureStateMDesc');
      showText('mriFormDesc');
      showText('amortScheduleMDesc');
      showText('utilizationDesc');

    </script>

</body>
</html>