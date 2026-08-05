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
  <title>Salary</title>
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
         else {
             while ($row = mysqli_fetch_array($data)) {
                 $Cfname= $row['customerFirstName'];
                 $Lfname= $row['customerSurname'];
                 $fullname=$row['customerFullName'];
                 $birth=$row['birthDate'];
                 $id=$row['loan_Id'];
                 $type=$row['salaryType'];
                 $branch=$row['branch'];
                 $loanType=$row['loanType'];
                 $productID =$row['productID'];
                 $amountAppliedd = $row['amountApplied'];
                 $amountTermss = $row['terms'];
                 $interestRatee = $row['interestRate'];

                 $amountAppl = number_format($amountAppliedd, 2, '.', ',');
            } 
         }
         
         
         // Disable Tab Buttons
         if($type == "Salary Loan") {       
         ?>
      <script>
         document.getElementById('tab2').classList.add('active');;
         document.getElementById('salary').classList.add('active');
         document.getElementById('tab1').classList.remove('active');
         document.getElementById('tab3').classList.remove('active');
         document.getElementById('tab4').classList.remove('active');     
      </script>
      <?php

         $query = "SELECT a.*, s.* FROM salaryloan AS s
                                    LEFT JOIN salaryarchive AS a ON s.salaryLoanId = a.a_salaryLoanId
                                    WHERE salaryLoanId = '$id' ";
         $newdata = mysqli_query($con, $query) ;
         $row = mysqli_fetch_array($newdata);

         // BORROWER
         $endorsementLetter = $row['endorsementLetter'];
         $loanAppForm=$row['loanAppForm'];
         $memoAgreementS=$row['memoAgreementS'];
         $certofEmployment=$row['certofEmployment'];
         $latestPayslip=$row['latestPayslip'];
         $itr1 = $row['itr1'];
         $tin=$row['tin'];
         $proofBilling = $row['proofBilling'];
         $clearanceLoan=$row['clearanceLoan'];
         // CO MAKER 1
         $coMaker1=$row['coMaker1'];
         $validSignatures=$row['validSignatures'];
         $monthsPayslip=$row['monthsPayslip'];
         $itr2 = $row['itr2'];
         // CO MAKER 2
         $coMaker2=$row['coMaker2'];
         $validSignatures2=$row['validSignatures2'];
         $monthsPayslip2=$row['monthsPayslip2'];
         $itr3 = $row['itr3'];
         // DOCUMENTS
         $deductRemit=$row['deductRemit'];
         $cashflowScore=$row['cashflowScore'];
         $loanAppMemo=$row['loanAppMemo'];
         $promissoryNoteS=$row['promissoryNoteS'];
         $disclosureStateS=$row['disclosureStateS'];
         $mriForm=$row['mriForm'];
         $amortScheduleS=$row['amortScheduleS'];
         $utilization=$row['utilization'];

         // archive data
         $a_loanAppForm=$row['a_loanAppForm'];
         $a_memoAgreementS=$row['a_memoAgreementS'];
         $a_certofEmployment=$row['a_certofEmployment'];
         $a_latestPayslip=$row['a_latestPayslip'];
         $a_tin=$row['a_tin'];
         $a_clearanceLoan=$row['a_clearanceLoan'];
         // CO MAKER 1
         $a_coMaker1=$row['a_coMaker1'];
         $a_validSignatures=$row['a_validSignatures'];
         $a_monthsPayslip=$row['a_monthsPayslip'];
         // CO MAKER 2
         $a_coMaker2=$row['a_coMaker2'];
         $a_validSignatures2=$row['a_validSignatures2'];
         $a_monthsPayslip2=$row['a_monthsPayslip2'];
         // DOCUMENTS
         $a_deductRemit=$row['a_deductRemit'];
         $a_cashflowScore=$row['a_cashflowScore'];
         $a_loanAppMemo=$row['a_loanAppMemo'];
         $a_promissoryNoteS=$row['a_promissoryNoteS'];
         $a_disclosureStateS=$row['a_disclosureStateS'];
         $a_mriForm=$row['a_mriForm'];
         $a_amortScheduleS=$row['a_amortScheduleS'];
         $a_utilization=$row['a_utilization'];

         $a_oathTaking = $row['a_oathTaking'];
         $a_cic = $row['a_cic'];
         $a_nfis = $row['a_nfis'];
         $a_kapasyahan = $row['a_kapasyahan'];
         $a_canvassVote = $row['a_canvassVote'];
         $a_brgyReso = $row['a_brgyReso'];

         // BORROWER STATUS
         $endorsementLetterSelect = $row['endorsementLetterStatus'];
         $loanAppFormSelect = $row['loanAppFormStatus'];
         $memoAgreementSelect = $row['memoAgreementStatus'];
         $certEmploymentSelect = $row['certofEmploymentStatus'];
         $payslipSelect = $row['latestPayslipStatus'];
         $itr1Select = $row['itr1Status'];
         $tinSelect = $row['tinStatus'];
         $proofBillingSelect = $row['proofBillingStatus'];
         $clearanceLoanSelect = $row['clearanceLoanStatus'];
         // CO MAKER 1 STATUS
         $coMaker1Select = $row['coMaker1Status'];
         $validSignaturesSelect = $row['validSignaturesStatus'];
         $monthsPayslipSelect = $row['monthsPayslipStatus'];
         $itr2Select = $row['itr2Status'];
         // CO MAKER 2 STATUS
         $coMaker2Select = $row['coMaker2Status'];
         $validSignatures2Select = $row['validSignatures2Status'];
         $monthsPayslip2Select = $row['monthsPayslip2Status'];
         $itr3Select = $row['itr3Status'];
         // DOCUEMENTS
         $deductRemitSelect = $row['deductRemitStatus'];
         $cashflowScoreSelect = $row['cashflowScoreStatus'];
         $loanAppMemoSelect = $row['loanAppMemoStatus'];
         $promissoryNoteSSelect = $row['promissoryNoteSStatus'];
         $disclosureStateSSelect = $row['disclosureStateSStatus'];
         $mriFormSelect = $row['mriFormStatus'];
         $amortScheduleSSelect = $row['amortScheduleSStatus'];
         $utilizationSelect = $row['utilizationStatus'];
         // OTHER Checkbox
         $oathTakingCheck = $row['oathTakingCheck'];
         $cicCheck = $row['cicCheck'];
         $nfisCheck = $row['nfisCheck'];
         $kapasyahanCheck = $row['kapasyahanCheck'];
         $canvassVoteCheck = $row['canvassVoteCheck'];
         $brgyResoCheck = $row['brgyResoCheck'];
         $empOfficerCertCheck = $row['empOfficerCertCheck'];
         // Checkbox Status
         $oathTakingSelect = $row['oathTakingStatus'];
         $cicSelect = $row['cicStatus'];
         $nfisSelect = $row['nfisStatus'];
         $kapasyahanSelect = $row['kapasyahanStatus'];
         $canvassVoteSelect = $row['canvassVoteStatus'];
         $brgyResoSelect = $row['brgyResoStatus'];
         $empOfficerCertSelect = $row['empOfficerCertStatus'];
         // Other File
         $oathTaking = $row['oathTaking'];
         $cic = $row['cic'];
         $nfis = $row['nfis'];
         $kapasyahan = $row['kapasyahan'];
         $canvassVote = $row['canvassVote'];
         $brgyReso = $row['brgyReso'];
         $empOfficerCert = $row['empOfficerCert'];
         
         }
         
         
         // The NUMBER OF PERCENTAGE
         $numberOfFilesUploaded = 0;
         
         $fileInputs = array(         
         $loanAppFormSelect, $memoAgreementSelect, $certEmploymentSelect, $payslipSelect, $tinSelect, $clearanceLoanSelect,
         $coMaker1Select, $validSignaturesSelect, $monthsPayslipSelect, $coMaker2Select, $validSignatures2Select, $monthsPayslip2Select,
         $deductRemitSelect, $cashflowScoreSelect, $loanAppMemoSelect, $promissoryNoteSSelect, $disclosureStateSSelect, $amortScheduleSSelect
         );
         
         // Filter out empty values from the array
         // Max Number Of Overall File Base on Condition
         $maxCount=count($fileInputs);
         // echo $maxCount;
         $nonEmptyFileInputs = array_filter($fileInputs,function($value) {
            $parts = explode("--", $value);
            return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
        });;
         
         // Count the number of non-empty values
         $numberOfFilesUploaded = count($nonEmptyFileInputs);
         // echo $numberOfFilesUploaded;
         
         // Calculate the percentage
         $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         
         // echo count($numberOfFilesUploaded);
         $percentage= round($numberOfFilesUploaded /$maxCount *100);

         $primary="http://124.106.173.237/dashboard/linkSal.php?id=";
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
            <button data-bs-toggle="modal" class="btn btn-primary btn-md" name="createNew" id="createNew" data-bs-target="#createNewCustomerFolder">GENERATE LINK</button>
         </div>
      <div class="container py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><b><?php echo "$fullname &nbsp; $birth &nbsp;" . strtoupper($type) . " &nbsp; $loantype &nbsp; <span style='color: lightgray;'><strong>|</strong></span> &nbsp;&nbsp; AMOUNT: &#8369;$amountAppl &nbsp; TERMS: $amountTermss YR/S &nbsp; INTEREST RATE: $interestRatee%"; ?></b></h3></label>
         </div>
         <div class="col-12" style="text-align:left; margin-left:0.5%;">
         
            <!-- The PERCENTAGE CIRCLE -->
            <!-- <label class="text-white bg-success">LOAN PROGRESS :</label> -->
            <div class="progress" style="display: inline-block; min-width: 99%; vertical-align:bottom; height: 100%; font-size:130%">
               <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: <?php echo $percentage.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage.'%';?></div>
            </div>
         </div>

      <div id="myModal" class="modal" style="margin-top:5%; margin-left:20%; width:50%; height:500px;">
         <div class="modal-content" style="height:50%;">
            <span class="close" id="closeModal" style= "font-size:2em; margin-left:96%"><i class="fa fa-times" aria-hidden="true"></i></span>
            <p><h1 id="modalText" style ="font-size: 1.5em;"></h1></p>
        </div>
      </div>
         <div class="row">
            <div class="col-12 ">
               <div class="bg-white rounded p-2">
                  <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver">
                     <li class="nav-item ">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab1" href="#microfinance">Microfinance</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab2" href="#salary">Salary</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation">Real Estate Mortgage - Corporation</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual">Real Estate Mortgage - Individual</a>
                     </li>
                  </ul>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="salary" class="tab-pane active" style="border: 1px solid #ccc;">
                           <form id="salary-form" action="loanSalaryUploadData.php" method="POST" enctype="multipart/form-data">
                              <div id="nextbankSection" style="position: absolute; top: 0; right: 0; margin-right: 4.4em;">
                                 <div class="form">
                                       <input type="text" class="form-control" id="productID" name="productID" style="width: 25em; height: 4em; display: inline-block; font-size: 1.1em ; font-weight:bold;" value="<?php echo $productID; ?>" placeholder="NEXTBANK PRODUCT ID" tabindex="-1">
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
                                       <!-- content Requirements -->
                                       <div class="salary-tabs" style="border-right: 1px solid #ccc; min-height: 96%; width: 100%; margin-top: -0.8%;">
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>BORROWER</u></label></div>
                                             </div>
                                          </div>
                                          <!-- ENDORSEMENT LETTER -->
                                          <div class="row">
                                            <div class="col-8">
                                                <div class="py-1">  
                                                   <label class ="salary-labels">&#x2022; ENDORSEMENT LETTER</label>
                                                   <input type="file" id="endorsementLetter" name="endorsementLetter"><img id="endorsementLetterImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $endorsementLetter; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile" id="endorsementLetterButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                      if(!empty($endorsementLetter)){
                                                         echo '<button type="button" id="endorsementLetterUploadNew" class="endorsementLetterUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="endorsementLetterUploadNew" class="endorsementLetterUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="endorsementLetterShowOld" class="endorsementLetterShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="endorsementLetterDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($endorsementLetter, strrpos($endorsementLetter, '/') + 1, 10); ?></label><br><br>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="endorsementLetterSelect" name= "endorsementLetterSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="endorsementLetterDesc" name = "endorsementLetterDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">
                                                </div>
                                             </div>
                                          </div>
                                           <!-- LOAN APPLICATION FORM -->
                                          <div class="row">
                                            <div class="col-8">
                                                <div class="py-1">  
                                                   <label class ="salary-labels">&#x2022; LOAN APPLICATION FORM</label>
                                                   <input type="file" id="loanAppForm" name="loanAppForm"><img id="loanAppFormImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppForm; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile" id="loanAppFormButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                      if(!empty($loanAppForm)){
                                                         echo '<button type="button" id="loanAppFormUploadNew" class="loanAppFormUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="loanAppFormUploadNew" class="loanAppFormUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="loanAppFormShowOld" class="loanAppFormShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="loanAppFormDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppForm, strrpos($loanAppForm, '/') + 1, 10); ?></label><br><br>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="loanAppFormSelect" name= "loanAppFormSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppFormDesc" name = "loanAppFormDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">
                                                </div>
                                             </div>
                                          </div>
                                           <!-- MEMORANDUM OF AGREEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                             <div class="py-1">  
                                                <label class ="salary-labels">&#x2022; MEMORANDUM OF AGREEMENT</label>
                                                <input type="file" id="memoAgreementS" name="memoAgreementS"><img id="memoAgreementSImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $memoAgreementS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="memoAgreementSButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($memoAgreementS)){
                                                      echo '<button type="button" id="memoAgreementSUploadNew" class="memoAgreementSUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="memoAgreementSUploadNew" class="memoAgreementSUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="memoAgreementShowOld" class="memoAgreementShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="memoAgreementSDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($memoAgreementS, strrpos($memoAgreementS, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="memoAgreementSelect" name= "memoAgreementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="memoAgreementSDesc" name = "memoAgreementSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">
                                                </div>
                                             </div>
                                          </div>
                                           <!-- CERTIFICATE OF EMPLOYMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">  
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; CERTIFICATE OF EMPLOYMENT </label>
                                                <input type="file" class="certofEmployment" id="certofEmployment" name="certofEmployment"><img id="certofEmploymentImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $certofEmployment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="certofEmploymentButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($certofEmployment)){
                                                      echo '<button type="button" id="certofEmploymentUploadNew" class="certofEmploymentUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="certofEmploymentUploadNew" class="certofEmploymentUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="certofEmploymentShowOld" class="certofEmploymentShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="certofEmploymentDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($certofEmployment, strrpos($certofEmployment, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select id="certEmploymentSelect" name= "certEmploymentSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="certofEmploymentDesc" name = "certofEmploymentDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS"> &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- LATEST PAY-SLIP -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; LATEST PAY-SLIP </label>
                                                <input type="file" id="latestPayslip" name="latestPayslip"><img id="latestPayslipImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $latestPayslip; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestPayslipButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($latestPayslip)){
                                                      echo '<button type="button" id="latestPayslipUploadNew" class="latestPayslipUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="latestPayslipUploadNew" class="latestPayslipUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="latestPayslipShowOld" class="latestPayslipShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="latestPayslipDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($latestPayslip, strrpos($latestPayslip, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="payslipSelect" name= "payslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="latestPayslipDesc" name = "latestPayslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- LATEST PAY-SLIP -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; ITR </label>
                                                <input type="file" id="itr1" name="itr1"><img id="itr1Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $itr1; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itr1Button">Open File</button></a>
                                                <?php 
                                                   if(!empty($itr1)){
                                                      echo '<button type="button" id="itr1UploadNew" class="itr1UploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="itr1UploadNew" class="itr1UploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="itr1ShowOld" class="itr1ShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="itr1Date"><i class="fas fa-calendar-alt"></i> <?php echo substr($itr1, strrpos($itr1, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="itr1Select" name= "itr1Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="itr1Desc" name = "itr1Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- T.I.N AND/OR ANY 2 VALID I.D -->    
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; T.I.N AND/OR ANY 2 VALID I.D</label>
                                                <input type="file" id="tin" name="tin"><img id="tinImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $tin; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="tinButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($tin)){
                                                      echo '<button type="button" id="tinUploadNew" class="tinUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="tinUploadNew" class="tinUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="tinShowOld" class="tinShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="tinDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($tin, strrpos($tin, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="tinSelect" name= "tinSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="tinDesc" name = "tinDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PROOF BILLING -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; PROOF OF BILLING</label>
                                                <input type="file" id="proofBilling" name="proofBilling"><img id="proofBillingImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $proofBilling; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofBillingButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($proofBilling)){
                                                      echo '<button type="button" id="proofBillingUploadNew" class="proofBillingUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="proofBillingUploadNew" class="proofBillingUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="proofBillingShowOld" class="proofBillingShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="proofBillingDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label><br>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="proofBillingSelect" name= "proofBillingSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="proofBillingDesc" name = "proofBillingDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <!-- BARANGAY CLEARANCE FOR LOAN PURPOSE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; BARANGAY CLEARANCE</label>
                                                <input type="file" id="clearanceLoan" name="clearanceLoan"><img id="clearanceLoanImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $clearanceLoan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="clearanceLoanButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($clearanceLoan)){
                                                      echo '<button type="button" id="clearanceLoanUploadNew" class="clearanceLoanUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="clearanceLoanUploadNew" class="clearanceLoanUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="clearanceLoanShowOld" class="clearanceLoanShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="clearanceLoanDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($clearanceLoan, strrpos($clearanceLoan, '/') + 1, 10); ?></label><br>
                                                <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;&nbsp;FOR LOAN PURPOSE</label>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="clearanceLoanSelect" name= "clearanceLoanSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="clearanceLoanDesc" name = "clearanceLoanDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>CO-MAKER 1</u></label></div>
                                             </div>
                                          </div>
                                          <!-- CO-MAKER STATEMENT 1-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class ="salary-labels" >&#x2022; CO-MAKER STATEMENT</label>
                                                <input type="file" id="coMaker1" name="coMaker1"><img id="coMaker1Image" src="statusImage/check.png" alt="statusImage"> 
                                                <a href="<?php echo $coMaker1; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="coMaker1Button">Open File</button></a>
                                                <?php 
                                                   if(!empty($coMaker1)){
                                                      echo '<button type="button" id="coMaker1UploadNew" class="coMaker1UploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="coMaker1UploadNew" class="coMaker1UploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="coMaker1ShowOld" class="coMaker1ShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="coMaker1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMaker1, strrpos($coMaker1, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMaker1Select" name= "coMaker1Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMaker1Desc" name = "coMaker1Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                            <!-- VALID ID WITH 3 SIGNATURES -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; VALID ID WITH 3 SIGNATURES </label>
                                                <input type="file" id="validSignatures" name="validSignatures"><img id="validSignaturesImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $validSignatures; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validSignaturesButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($validSignatures)){
                                                      echo '<button type="button" id="validSignaturesUploadNew" class="validSignaturesUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="validSignaturesUploadNew" class="validSignaturesUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="validSignaturesShowOld" class="validSignaturesShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="validSignaturesDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($validSignatures, strrpos($validSignatures, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="validSignaturesSelect" name= "validSignaturesSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="validSignaturesDesc" name = "validSignaturesDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 3 MONTHS PAYSLIP -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; 3 MONTHS PAYSLIP</label>
                                                <input type="file" id="monthsPayslip" name="monthsPayslip"><img id="monthsPayslipImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $monthsPayslip; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="monthsPayslipButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($monthsPayslip)){
                                                      echo '<button type="button" id="monthsPayslipUploadNew" class="monthsPayslipUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="monthsPayslipUploadNew" class="monthsPayslipUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="monthsPayslipShowOld" class="monthsPayslipShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="monthsPayslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($monthsPayslip, strrpos($monthsPayslip, '/') + 1, 10); ?></label><br>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="monthsPayslipSelect" name= "monthsPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="monthsPayslipDesc" name = "monthsPayslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- LATEST PAY-SLIP -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; ITR </label>
                                                <input type="file" id="itr2" name="itr2"><img id="itr2Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $itr2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itr2Button">Open File</button></a>
                                                <?php 
                                                   if(!empty($itr2)){
                                                      echo '<button type="button" id="itr2UploadNew" class="itr2UploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="itr2UploadNew" class="itr2UploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="itr2ShowOld" class="itr2ShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="itr2Date"><i class="fas fa-calendar-alt"></i> <?php echo substr($itr2, strrpos($itr2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="itr2Select" name= "itr2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="itr2Desc" name = "itr2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>CO-MAKER 2</u></label></div>
                                             </div>
                                          </div>
                                           <!-- CO-MAKER STATEMENT 2-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                <label class ="salary-labels" >&#x2022; CO-MAKER STATEMENT</label>
                                                <input type="file" id="coMaker2" name="coMaker2"><img id="coMaker2Image" src="statusImage/check.png" alt="statusImage"> 
                                                <a href="<?php echo $coMaker2; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="coMaker2Button" >Open File</button></a>
                                                <?php 
                                                   if(!empty($coMaker2)){
                                                      echo '<button type="button" id="coMaker2UploadNew" class="coMaker2UploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="coMaker2UploadNew" class="coMaker2UploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="coMaker2ShowOld" class="coMaker2ShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="coMaker2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMaker2, strrpos($coMaker2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMaker2Select" name= "coMaker2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMaker2Desc" name = "coMaker2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- VALID ID WITH 3 SIGNATURES -->
                                          <div class="row">
                                             <div class="col-8">
                                              <div class="py-1">
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; VALID ID WITH 3 SIGNATURES </label>
                                                <input type="file" id="validSignatures2" name="validSignatures2"><img id="validSignatures2Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $validSignatures2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validSignatures2Button">Open File</button></a>
                                                <?php 
                                                   if(!empty($validSignatures2)){
                                                      echo '<button type="button" id="validSignatures2UploadNew" class="validSignatures2UploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="validSignatures2UploadNew" class="validSignatures2UploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="validSignatures2ShowOld" class="validSignatures2ShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="validSignatures2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($validSignatures2, strrpos($validSignatures2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="validSignatures2Select" name= "validSignatures2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="validSignatures2Desc" name = "validSignatures2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 3 MONTHS PAYSLIP -->
                                          <div class="row" style="height: 4em; margin-bottom:-1.5%;">
                                             <div class="col-8">
                                                <div>
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; 3 MONTHS PAYSLIP</label>
                                                <input type="file" id="monthsPayslip2" name="monthsPayslip2"><img id="monthsPayslip2Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $monthsPayslip2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="monthsPayslip2Button">Open File</button></a>
                                                <?php 
                                                   if(!empty($monthsPayslip2)){
                                                      echo '<button type="button" id="monthsPayslip2UploadNew" class="monthsPayslip2UploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="monthsPayslip2UploadNew" class="monthsPayslip2UploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="monthsPayslip2ShowOld" class="monthsPayslip2ShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="monthsPayslip2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($monthsPayslip2, strrpos($monthsPayslip2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="monthsPayslip2Select" name= "monthsPayslip2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="monthsPayslip2Desc" name = "monthsPayslip2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; ITR </label>
                                                <input type="file" id="itr3" name="itr3"><img id="itr3Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $itr3; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itr3Button">Open File</button></a>
                                                <?php 
                                                   if(!empty($itr3)){
                                                      echo '<button type="button" id="itr3UploadNew" class="itr3UploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="itr3UploadNew" class="itr3UploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="itr3ShowOld" class="itr3ShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="itr3Date"><i class="fas fa-calendar-alt"></i> <?php echo substr($itr3, strrpos($itr3, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="itr3Select" name= "itr3Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="itr3Desc" name = "itr3Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row" style="height: 4em; margin-bottom:-1.5%;">
                                             <div class="col-8">
                                                <div>
                                                </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                 
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row" style="height: 4em; margin-bottom:-1.5%;">
                                             <div class="col-8">
                                                <div>
                                                </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                 
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
                                             <div class="col-8" style="height:1em; margin-top:-0.5%;"></div>
                                          </div>
                                          <!-- ASSIGNMENT OF SALARY & AUTHORITY TO DEDUCT AND REMIT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">ASSIGNMENT OF SALARY</label>
                                                   <input type="file" id="deductRemit" name="deductRemit"><img id="deductRemitImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $deductRemit; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="deductRemitButton" >Open File</button></a>
                                                   <?php 
                                                      if(!empty($deductRemit)){
                                                         echo '<button type="button" id="deductRemitUploadNew" class="deductRemitUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="deductRemitUploadNew" class="deductRemitUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="deductRemitShowOld" class="deductRemitShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="deductRemitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($deductRemit, strrpos($deductRemit, '/') + 1, 10); ?></label>
                                                   <label class ="salary-labels">AUTHORITY TO DEDUCT AND REMIT</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="deductRemitSelect" name= "deductRemitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="deductRemitDesc" name = "deductRemitDesc" class="form-control w-75 p-1 fs-5  " placeholder="REMARKS">
                                                </div>
                                             </div>
                                          </div>
                                          <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels" >FINANCIAL EVALUATION</label>
                                                   <input type="file" id="cashflowScore" name="cashflowScore"><img id="cashflowScoreImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $cashflowScore; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="cashflowScoreButton" >Open File</button></a>
                                                   <?php 
                                                      if(!empty($cashflowScore)){
                                                         echo '<button type="button" id="cashflowScoreUploadNew" class="cashflowScoreUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="cashflowScoreUploadNew" class="cashflowScoreUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="cashflowScoreShowOld" class="cashflowScoreShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="cashflowScoreDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cashflowScore, strrpos($cashflowScore, '/') + 1, 10); ?></label>
                                                   <label class ="salary-labels" >(CASHFLOW ANALYSIS) AND BRR SCORECARD</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="cashflowScoreSelect" name= "cashflowScoreSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="cashflowScoreDesc" name = "cashflowScoreDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <!-- LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">LOAN APPROVAL MEMO</label>
                                                   <input type="file" id="loanAppMemo" class="loanAppMemo" name="loanAppMemo"><img id="loanAppMemoImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $loanAppMemo; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="loanAppMemoButton" >Open File</button></a>
                                                   <?php 
                                                      if(!empty($loanAppMemo)){
                                                         echo '<button type="button" id="loanAppMemoUploadNew" class="loanAppMemoUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="loanAppMemoUploadNew" class="loanAppMemoUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="loanAppMemoShowOld" class="loanAppMemoShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="loanAppMemoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppMemo, strrpos($loanAppMemo, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="loanAppMemoSelect" name= "loanAppMemoSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppMemoDesc" name = "loanAppMemoDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><u>SIGNED DOCUMENS FOR LOAN RELEASE</u></label></div>
                                             </div>
                                          </div>
                                          <!-- PORMISORRY NOTE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; PROMISSORY NOTE</label>
                                                   <input type="file" id="promissoryNoteS" name="promissoryNoteS"><img id="promissoryNoteSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $promissoryNoteS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="promissoryNoteSButton">Open File</button></a> 
                                                   <?php 
                                                      if(!empty($promissoryNoteS)){
                                                         echo '<button type="button" id="promissoryNoteSUploadNew" class="promissoryNoteSUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="promissoryNoteSUploadNew" class="promissoryNoteSUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="promissoryNoteSShowOld" class="promissoryNoteSShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="promissoryNoteSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promissoryNoteS, strrpos($promissoryNoteS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="promissoryNoteSSelect" name= "promissoryNoteSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="promissoryNoteSDesc" name = "promissoryNoteSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- DISCLOSURE STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; DISCLOSURE STATEMENT</label>
                                                   <input type="file" id="disclosureStateS" name="disclosureStateS"><img id="disclosureStateSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $disclosureStateS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateSButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($disclosureStateS)){
                                                         echo '<button type="button" id="disclosureStateSUploadNew" class="disclosureStateSUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="disclosureStateSUploadNew" class="disclosureStateSUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="disclosureStateSShowOld" class="disclosureStateSShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="disclosureStateSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateS, strrpos($disclosureStateS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="disclosureStateSSelect" name= "disclosureStateSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="disclosureStateSDesc" name = "disclosureStateSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--  MRI FORM (COUNTRY BANKERS)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; INSURANCE DOCUMENTS</label>
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
                                                <div class="form-group d-flex mb-3">
                                                   <select id="mriFormSelect" name= "mriFormSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="mriFormDesc" name = "mriFormDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!--  AMORTIZATION SCHEDULE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                                   <input type="file" id="amortScheduleS" name="amortScheduleS"><img id="amortScheduleSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $amortScheduleS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleSButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($amortScheduleS)){
                                                         echo '<button type="button" id="amortScheduleSUploadNew" class="amortScheduleSUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="amortScheduleSUploadNew" class="amortScheduleSUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="amortScheduleSShowOld" class="amortScheduleSShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="amortScheduleSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleS, strrpos($amortScheduleS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="amortScheduleSSelect" name= "amortScheduleSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="amortScheduleSDesc" name = "amortScheduleSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
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
                                             <label class ="salary-labels">&#x2022; LOAN UTILIZATION</label>
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
                                             <input type="text" id="utilizationDesc" name = "utilizationDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                          <!-- FOR SPACE -->
                                          <!-- <div class="row">
                                             <div class="col-8" style="height:5em; margin-bottom:-2%;" ></div>
                                          </div> -->

                                          <div class="row">
                                             <div class="col-8">
                                                 <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.4em">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>OTHERS</u></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class = "OTHERS">
                                             <!-- KASULAT NA KAPASYAHAN (IF APPLICABLE)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="kapasyahanCheck" name="kapasyahanCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">NAKASULAT NA KAPASYAHAN</label>
                                                      <input type="file" id="kapasyahan" name="kapasyahan"><img id="kapasyahanImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $kapasyahan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="kapasyahanButton" >Open File</button></a>
                                                      <?php 
                                                         if(!empty($kapasyahan)){
                                                            echo '<button type="button" id="kapasyahanUploadNew" class="kapasyahanUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="kapasyahanUploadNew" class="kapasyahanUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="kapasyahanShowOld" class="kapasyahanShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="kapasyahanDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($kapasyahan, strrpos($kapasyahan, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "kapasyahanSelect" name = "kapasyahanSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="kapasyahanDesc" name = "kapasyahanDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                                <!-- OFFICE OF BRGY. RESOLUTION (IF APPLICABLE)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="brgyResoCheck" name="brgyResoCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">OFFICE OF BRGY. RESOLUTION</label>
                                                      <input type="file" id="brgyReso" name="brgyReso"><img id="brgyResoImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $brgyReso; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="brgyResoButton" >Open File</button></a>
                                                      <?php 
                                                         if(!empty($brgyReso)){
                                                            echo '<button type="button" id="brgyResoUploadNew" class="brgyResoUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="brgyResoUploadNew" class="brgyResoUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="brgyResoShowOld" class="brgyResoShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="brgyResoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($brgyReso, strrpos($brgyReso, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "brgyResoSelect" name = "brgyResoSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="brgyResoDesc" name = "brgyResoDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                                <!-- CANVASS OF VOTES(IF APPLICABLE)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="canvassVoteCheck" name="canvassVoteCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">CANVASS OF VOTES</label>
                                                      <input type="file" id="canvassVote" name="canvassVote"><img id="canvassVoteImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $canvassVote; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="canvassVoteButton" >Open File</button></a>
                                                      <?php 
                                                         if(!empty($canvassVote)){
                                                            echo '<button type="button" id="canvassVoteUploadNew" class="canvassVoteUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="canvassVoteUploadNew" class="canvassVoteUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="canvassVoteShowOld" class="canvassVoteShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="canvassVoteDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($canvassVote, strrpos($canvassVote, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "canvassVoteSelect" name = "canvassVoteSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="canvassVoteDesc" name = "canvassVoteDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                                <!-- OATH OF OFFICE (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="oathTakingCheck" name="oathTakingCheck" tabindex="-1">
                                                      <label class ="salary-labels">OATH OF OFFICE</label>
                                                      <input type="file" id="oathTaking" name="oathTaking" ><img id="oathTakingImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $oathTaking; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="oathTakingButton" >Open File</button></a>
                                                      <?php 
                                                         if(!empty($oathTaking)){
                                                            echo '<button type="button" id="oathTakingUploadNew" class="oathTakingUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="oathTakingUploadNew" class="oathTakingUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="oathTakingShowOld" class="oathTakingShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="oathTakingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($oathTaking, strrpos($oathTaking, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "oathTakingSelect" name = "oathTakingSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="oathTakingDesc" name = "oathTakingDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>

                                             <!-- CIC (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="cicCheck" name="cicCheck" tabindex="-1">
                                                      <label class ="salary-labels">CIC</label>
                                                      <input type="file" id="cic" name="cic" ><img id="cicImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $cic; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cicButton" >Open File</button></a>
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
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "cicSelect" name = "cicSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cicDesc" name = "cicDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>

                                             <!-- NFIS (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="nfisCheck" name="nfisCheck" tabindex="-1">
                                                      <label class ="salary-labels">NFIS</label>
                                                      <input type="file" id="nfis" name="nfis" ><img id="nfisImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $nfis; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="nfisButton" >Open File</button></a>
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
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "nfisSelect" name = "nfisSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="nfisDesc" name = "nfisDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="empOfficerCertCheck" name="empOfficerCertCheck" tabindex="-1">
                                                      <label class ="salary-labels">EMP. & OFFICER CERT.</label>
                                                      <input type="file" id="empOfficerCert" name="empOfficerCert" ><img id="empOfficerCertImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $empOfficerCert; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="empOfficerCertButton" >Open File</button></a>
                                                      <?php 
                                                         if(!empty($empOfficerCert)){
                                                            echo '<button type="button" id="empOfficerCertUploadNew" class="empOfficerCertUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="empOfficerCertUploadNew" class="empOfficerCertUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="empOfficerCertShowOld" class="empOfficerCertShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="empOfficerCertDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($empOfficerCert, strrpos($empOfficerCert, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "empOfficerCertSelect" name = "empOfficerCertSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="empOfficerCertDesc" name = "empOfficerCertDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>

                                             </div>
                                          </div>
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
                        <label for="amountApplyy">Amount Approved</label>
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

   <div class="modal" id="createNewCustomerFolder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">GENERATED LINK</h5>
        </div>
        <div class="modal-body">
          <form id="createNewCustomer" enctype="multipart/data-form">
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
        </form>
      </div>
    </div>
  </div>

<!-- <div class="col-md-12 px-4">
</div> -->

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
      var btnsalaryId = $(this).val();
      alert(btnsalaryId);
      var confirmMo = confirm("Please Confirm, You want to Release this Client?");
      if(confirmMo){
         $.ajax({
            url: 'pipeSalUpd.php',
            type: 'POST',
            data: { btnsalaryId: btnsalaryId },
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

   // $(document).on('click', '#btn-close', function(){
   //    testmodal.hide();
   // });

   $(document).on('change', '.loanAppMemo', function(e){
      e.preventDefault();
      var lam = $('.loanAppMemo').val();
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
        var salaryy = document.getElementById('salary-form')
        var updaterForm = document.getElementById('updaterTerms-Form');
        var formData = new FormData(updaterForm);
        $.ajax({
            url: 'loanCorporationUpdater.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                alert('Loan Amount & Terms Updated Successfully!');
                salaryy.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
});

</script>

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, salId) {
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
                     d.salId = salId;
                }
            },
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [] // Apply sorting preferences if necessary
            }]
        });
    });
}

$(document).on('click', '#endorsementLetterShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_endorsementLetter.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanAppFormShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_loanAppForm.php', '<?php echo $id; ?>');
});

$(document).on('click', '#memoAgreementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_memoAgreementS.php', '<?php echo $id; ?>');
});

$(document).on('click', '#certofEmploymentShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_certofEmployment.php', '<?php echo $id; ?>');
});

$(document).on('click', '#latestPayslipShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_latestPayslip.php', '<?php echo $id; ?>');
});

$(document).on('click', '#itr1ShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_itr1.php', '<?php echo $id; ?>');
});

$(document).on('click', '#itr2ShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_itr2.php', '<?php echo $id; ?>');
});

$(document).on('click', '#itr3ShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_itr3.php', '<?php echo $id; ?>');
});

$(document).on('click', '#tinShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_tin.php', '<?php echo $id; ?>');
});

$(document).on('click', '#proofBillingShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_proofBilling.php', '<?php echo $id; ?>');
});

$(document).on('click', '#clearanceLoanShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_clearanceLoan.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMaker1ShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_coMaker1.php', '<?php echo $id; ?>');
});

$(document).on('click', '#validSignaturesShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_validSignatures.php', '<?php echo $id; ?>');
});

$(document).on('click', '#monthsPayslipShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_monthsPayslip.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMaker2ShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_coMaker2.php', '<?php echo $id; ?>');
});

$(document).on('click', '#validSignatures2ShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_validSignatures2.php', '<?php echo $id; ?>');
});

$(document).on('click', '#monthsPayslip2ShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_monthsPayslip2.php', '<?php echo $id; ?>');
});

$(document).on('click', '#deductRemitShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_deductRemit.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cashflowScoreShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_cashflowScore.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanAppMemoShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_loanAppMemo.php', '<?php echo $id; ?>');
});

$(document).on('click', '#promissoryNoteSShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_promissoryNoteS.php', '<?php echo $id; ?>');
});

$(document).on('click', '#disclosureStateSShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_disclosureStateS.php', '<?php echo $id; ?>');
});

$(document).on('click', '#mriFormShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_mriForm.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortScheduleSShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_amortScheduleS.php', '<?php echo $id; ?>');
});

$(document).on('click', '#utilizationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_utilization.php', '<?php echo $id; ?>');
});

$(document).on('click', '#kapasyahanShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_kapasyahan.php', '<?php echo $id; ?>');
});

$(document).on('click', '#brgyResoShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_brgyReso.php', '<?php echo $id; ?>');
});

$(document).on('click', '#canvassVoteShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_canvassVote.php', '<?php echo $id; ?>');
});

$(document).on('click', '#oathTakingShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_oathTaking.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cicShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_cic.php', '<?php echo $id; ?>');
});

$(document).on('click', '#nfisShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_nfis.php', '<?php echo $id; ?>');
});

$(document).on('click', '#empOfficerCertShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_empOfficerCert.php', '<?php echo $id; ?>');
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

$(document).on('click', '#endorsementLetterShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});


$(document).on('click', '#loanAppFormShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#memoAgreementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#certofEmploymentShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#latestPayslipShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#itr1ShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#itr2ShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#itr3ShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#tinShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#proofBillingShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#clearanceLoanShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMaker1ShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#validSignaturesShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#monthsPayslipShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMaker2ShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#validSignatures2ShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#monthsPayslip2ShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#deductRemitShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#cashflowScoreShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#loanAppMemoShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#promissoryNoteSShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#disclosureStateSShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#mriFormShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#amortScheduleSShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#utilizationShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#kapasyahanShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#brgyResoShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#canvassVoteShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#oathTakingShowOld', function(e){
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

$(document).on('click', '#empOfficerCertShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});
</script>

<script>
// Get all input elements with type="text", class="form-control w-75 p-1 fs-5", and attribute
function hideText(){
    const inputElements = document.querySelectorAll('input[type="text"].form-control.w-75.p-1.fs-5');

// Loop through each input element and set the hidden attribute
inputElements.forEach(inputElement => {
  inputElement.style.visibility="hidden";
});
  }
hideText();


</script>
<script>
  function updateFileStatus(inputId, imageId, select) {
  var inputFile = document.getElementById(inputId);
  var image = document.getElementById(imageId);
  var select=document.getElementById(select);
  if (inputFile.files.length > 0) {
    image.src = 'statusImage/check.png'; // Show check icon if file is uploaded
    image.style.visibility = 'visible'; // Make the image visible
  }
}

// Show the textField if chooses "INCOMPLETE".
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
handleSelectChange('endorsementLetterSelect', 'endorsementLetterDesc');
handleSelectChange('loanAppFormSelect', 'loanAppFormDesc');
handleSelectChange('memoAgreementSelect', 'memoAgreementSDesc');
handleSelectChange('certEmploymentSelect', 'certofEmploymentDesc');
handleSelectChange('payslipSelect', 'latestPayslipDesc');
handleSelectChange('itr1Select', 'itr1Desc');
handleSelectChange('tinSelect', 'tinDesc');
handleSelectChange('proofBillingSelect', 'proofBillingDesc');
handleSelectChange('clearanceLoanSelect', 'clearanceLoanDesc');
// CO MAKER 1
handleSelectChange('coMaker1Select', 'coMaker1Desc');
handleSelectChange('validSignaturesSelect', 'validSignaturesDesc');
handleSelectChange('monthsPayslipSelect', 'monthsPayslipDesc');
handleSelectChange('itr2Select', 'itr2Desc');
// CO-MAKER 2
handleSelectChange('coMaker2Select', 'coMaker2Desc');
handleSelectChange('validSignatures2Select', 'validSignatures2Desc');
handleSelectChange('monthsPayslip2Select', 'monthsPayslip2Desc');
handleSelectChange('itr3Select', 'itr3Desc');
// DOCUMENTS
handleSelectChange('deductRemitSelect', 'deductRemitDesc');
handleSelectChange('cashflowScoreSelect', 'cashflowScoreDesc');
handleSelectChange('loanAppMemoSelect', 'loanAppMemoDesc');
handleSelectChange('promissoryNoteSSelect', 'promissoryNoteSDesc');
handleSelectChange('disclosureStateSSelect', 'disclosureStateSDesc');
handleSelectChange('mriFormSelect', 'mriFormDesc');
handleSelectChange('amortScheduleSSelect', 'amortScheduleSDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');
// OTHERS
handleSelectChange('oathTakingSelect', 'oathTakingDesc');
handleSelectChange('cicSelect', 'cicDesc');
handleSelectChange('nfisSelect', 'nfisDesc');
handleSelectChange('empOfficerCertSelect', 'empOfficerCertDesc');
handleSelectChange('kapasyahanSelect', 'kapasyahanDesc');
handleSelectChange('canvassVoteSelect', 'canvassVoteDesc');
handleSelectChange('brgyResoSelect', 'brgyResoDesc');
</script>


<!-- Salary-FORM AJAX-->
<script>
  var salaryform = document.getElementById("salary-form");
  var branch = "<?php echo $branch; ?>";
  var salaryId = "<?php echo $id; ?>";
  var fullname= "<?php echo $fullname; ?>";
  var salaryType= "<?php echo $type; ?>";
  var loanType= "<?php echo $loanType; ?>";
  var endPrompt = ""; // Global variable for remarks

  function uploadFileS() {
    var salaryformData = new FormData(salaryform);
    salaryformData.append('salaryId', salaryId);
    salaryformData.append('fullname', fullname);
    salaryformData.append('salaryType', salaryType);
    salaryformData.append('branch', branch);
    salaryformData.append('loanType', loanType);

    // Append the endPrompt to the FormData
    salaryformData.append('endPrompt', endPrompt);
    
    $.ajax({
      url: 'loanSalaryUploadData.php', 
      type: 'POST',
      data: salaryformData,
      processData: false,
      contentType: false,
      success: function(response) {
      // BORROWER
      updateFileStatus('endorsementLetter', 'endorsementLetterImage');
      updateFileStatus('loanAppForm', 'loanAppFormImage');
      updateFileStatus('memoAgreementS', 'memoAgreementSImage');
      updateFileStatus('certofEmployment', 'certofEmploymentImage');
      updateFileStatus('latestPayslip', 'latestPayslipImage');
      updateFileStatus('itr1', 'itr1Image');
      updateFileStatus('tin', 'tinImage');
      updateFileStatus('proofBilling', 'proofBillingImage');
      updateFileStatus('clearanceLoan', 'clearanceLoanImage');
      // CO MAKER 1
      updateFileStatus('coMaker1', 'coMaker1Image');
      updateFileStatus('validSignatures', 'validSignaturesImage');
      updateFileStatus('monthsPayslip', 'monthsPayslipImage');
      updateFileStatus('itr2', 'itr2Image');
      // CO MAKER 2
      updateFileStatus('coMaker2', 'coMaker2Image');
      updateFileStatus('validSignatures2', 'validSignatures2Image');
      updateFileStatus('monthsPayslip2', 'monthsPayslip2Image');
      updateFileStatus('itr3', 'itr3Image');
      // DOCUMENTS
      updateFileStatus('deductRemit', 'deductRemitImage');
      updateFileStatus('cashflowScore', 'cashflowScoreImage');
      updateFileStatus('loanAppMemo', 'loanAppMemoImage');
      updateFileStatus('promissoryNoteS', 'promissoryNoteSImage');
      updateFileStatus('disclosureStateS', 'disclosureStateSImage');
      updateFileStatus('mriForm', 'mriFormImage');
      updateFileStatus('amortScheduleS', 'amortScheduleSImage');
      updateFileStatus('utilization', 'utilizationImage');
      // OTHERS
      updateFileStatus('oathTaking', 'oathTakingImage');
      updateFileStatus('cic', 'cicImage');
      updateFileStatus('nfis', 'nfisImage');
      updateFileStatus('empOfficerCert', 'empOfficerCertImage');
      updateFileStatus('kapasyahan', 'kapasyahanImage');
      updateFileStatus('brgyReso', 'brgyResoImage');
      updateFileStatus('canvassVote', 'canvassVoteImage');

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
        var salaryId = "<?php echo $id; ?>";
        formData.append('endPrompt', endPrompt);  // Add remarks to the form data
        formData.append('salaryId', salaryId);

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
                        url: 'loanSalaryUploadData.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                           console.log("Server response:", response); // Log response for debugging
                           alert('Updated Successfully!');
                           isUploading = false;  // Reset flag after successful upload
                           if(inputSelected !== '#loanAppMemo'){
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

   // for endorsement Letter
   $(document).on('click', '.endorsementLetterUploadNew', function(e) {
      e.preventDefault();
      handleEndorsementUpload('#endorsementLetter');
   });

   // for loanAppFormM
   $(document).on('click', '.loanAppFormUploadNew', function(e) {
      e.preventDefault();
      handleEndorsementUpload('#loanAppForm');
   });

   // for borrower_Idsignature
   $(document).on('click', '.memoAgreementSUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#memoAgreementS');
   });

   //  for borrower_Lbp
   $(document).on('click', '.certofEmploymentUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#certofEmployment');
   });

   // for borrower_Lpb
   $(document).on('click', '.latestPayslipUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#latestPayslip');
   });

   $(document).on('click', '.itr1UploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#itr1');
   });

   $(document).on('click', '.itr2UploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#itr2');
   });

   $(document).on('click', '.itr3UploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#itr3');
   });

   //  for coborrowerStatement
   $(document).on('click', '.tinUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#tin');
   });

   //  for coBorrowerIdSign
   $(document).on('click', '.proofBillingUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#proofBilling');
   });

   //  for coBorrowerIdSign
   $(document).on('click', '.clearanceLoanUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#clearanceLoan');
   });

      //  for ProofOfIncome
   $(document).on('click', '.coMaker1UploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#coMaker1');
    });


    //  for comakerStatement
    $(document).on('click', '.validSignaturesUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#validSignatures');
    });

    //  for coMakerIdWithSign
    $(document).on('click', '.monthsPayslipUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#monthsPayslip');
    });

    //  for latestPermit
    $(document).on('click', '.coMaker2UploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coMaker2');
    });

    //  for coMakerPayslip
    $(document).on('click', '.validSignatures2UploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#validSignatures2');
    });

    //  for businessValidation
    $(document).on('click', '.monthsPayslip2UploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#monthsPayslip2');
    });

     //  for loanInstallment
    $(document).on('click', '.deductRemitUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#deductRemit');
    });

    //  for loanPayment
    $(document).on('click', '.cashflowScoreUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#cashflowScore');
    });

    //  for statementAccount
    $(document).on('click', '.loanAppMemoUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#loanAppMemo');
    });

    //  for validCardReport
    $(document).on('click', '.promissoryNoteSUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#promissoryNoteS');
    });

    //  for creditReport
    $(document).on('click', '.disclosureStateSUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#disclosureStateS');
    });

    //  for creditInvestigationReportM
    $(document).on('click', '.mriFormUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#mriForm');
    });

    //  for debitWaiver
    $(document).on('click', '.amortScheduleSUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#amortScheduleS');
    });

    //  for affidavitSurrender
    $(document).on('click', '.utilizationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#utilization');
    });

    //  for loanApprovalSheet
    $(document).on('click', '.kapasyahanUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#kapasyahan');
    });

    //  for riskRating
    $(document).on('click', '.brgyResoUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#brgyReso');
    });

    //  for promissoryNoteM
    $(document).on('click', '.canvassVoteUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#canvassVote');
    });

    //  for disclosureStateM
    $(document).on('click', '.oathTakingUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#oathTaking');
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

    $(document).on('click', '.empOfficerCertUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#empOfficerCert');
    });

   salaryform.addEventListener("change", function() {
      uploadFileS();
   });
</script>
<!-- Approval Status and Description -->
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


// Using explode to Cut the data into two, So it can be print back to textfield
// BORROWER
selectOptionBasedOnValue('<?php echo $endorsementLetterSelect; ?>', 'endorsementLetterSelect','endorsementLetterDesc');
selectOptionBasedOnValue('<?php echo $loanAppFormSelect; ?>', 'loanAppFormSelect','loanAppFormDesc');
selectOptionBasedOnValue('<?php echo $memoAgreementSelect; ?>', 'memoAgreementSelect', 'memoAgreementSDesc');
selectOptionBasedOnValue('<?php echo $certEmploymentSelect; ?>', 'certEmploymentSelect', 'certofEmploymentDesc');
selectOptionBasedOnValue('<?php echo $payslipSelect; ?>', 'payslipSelect', 'latestPayslipDesc');
selectOptionBasedOnValue('<?php echo $itr1Select; ?>', 'itr1Select', 'itr1Desc');
selectOptionBasedOnValue('<?php echo $tinSelect; ?>', 'tinSelect', 'tinDesc');
selectOptionBasedOnValue('<?php echo $proofBillingSelect; ?>', 'proofBillingSelect', 'proofBillingDesc');
selectOptionBasedOnValue('<?php echo $clearanceLoanSelect; ?>', 'clearanceLoanSelect', 'clearanceLoanDesc');
// CO MAKER 1
selectOptionBasedOnValue('<?php echo $coMaker1Select; ?>', 'coMaker1Select', 'coMaker1Desc');
selectOptionBasedOnValue('<?php echo $validSignaturesSelect; ?>', 'validSignaturesSelect', 'validSignaturesDesc');
selectOptionBasedOnValue('<?php echo $monthsPayslipSelect; ?>', 'monthsPayslipSelect', 'monthsPayslipDesc');
selectOptionBasedOnValue('<?php echo $itr2Select; ?>', 'itr2Select', 'itr2Desc');
// CO MAKER 2
selectOptionBasedOnValue('<?php echo $coMaker2Select; ?>', 'coMaker2Select', 'coMaker2Desc');
selectOptionBasedOnValue('<?php echo $validSignatures2Select; ?>', 'validSignatures2Select', 'validSignatures2Desc');
selectOptionBasedOnValue('<?php echo $monthsPayslip2Select; ?>', 'monthsPayslip2Select', 'monthsPayslip2Desc');
selectOptionBasedOnValue('<?php echo $itr3Select; ?>', 'itr3Select', 'itr3Desc');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo $deductRemitSelect; ?>', 'deductRemitSelect', 'deductRemitDesc');
selectOptionBasedOnValue('<?php echo $cashflowScoreSelect; ?>', 'cashflowScoreSelect', 'cashflowScoreDesc');
selectOptionBasedOnValue('<?php echo $loanAppMemoSelect; ?>', 'loanAppMemoSelect', 'loanAppMemoDesc');
selectOptionBasedOnValue('<?php echo $promissoryNoteSSelect; ?>', 'promissoryNoteSSelect', 'promissoryNoteSDesc');
selectOptionBasedOnValue('<?php echo $disclosureStateSSelect; ?>', 'disclosureStateSSelect', 'disclosureStateSDesc');
selectOptionBasedOnValue('<?php echo $mriFormSelect; ?>', 'mriFormSelect', 'mriFormDesc');
selectOptionBasedOnValue('<?php echo $amortScheduleSSelect; ?>', 'amortScheduleSSelect', 'amortScheduleSDesc');
selectOptionBasedOnValue('<?php echo $utilizationSelect; ?>', 'utilizationSelect', 'utilizationDesc');
//OTHERS
selectOptionBasedOnValue('<?php echo $oathTakingSelect; ?>', 'oathTakingSelect', 'oathTakingDesc');
selectOptionBasedOnValue('<?php echo $cicSelect; ?>', 'cicSelect', 'cicDesc');
selectOptionBasedOnValue('<?php echo $nfisSelect; ?>', 'nfisSelect', 'nfisDesc');
selectOptionBasedOnValue('<?php echo $empOfficerCertSelect; ?>', 'empOfficerCertSelect', 'empOfficerCertDesc');
selectOptionBasedOnValue('<?php echo $kapasyahanSelect; ?>', 'kapasyahanSelect', 'kapasyahanDesc');
selectOptionBasedOnValue('<?php echo $canvassVoteSelect; ?>', 'canvassVoteSelect', 'canvassVoteDesc');
selectOptionBasedOnValue('<?php echo $brgyResoSelect; ?>', 'brgyResoSelect', 'brgyResoDesc');

</script>

<script>
function initializeCheckboxes() {
  // PHP values embedded into JS
  var oathTakingValue = "<?php echo $oathTakingCheck; ?>";
  var cicValue = "<?php echo $cicCheck; ?>";
  var nfisValue = "<?php echo $nfisCheck; ?>";
  var empOfficerCertValue = "<?php echo $empOfficerCertCheck; ?>";
  var kapasyahanValue = "<?php echo $kapasyahanCheck; ?>";
  var canvassVoteValue = "<?php echo $canvassVoteCheck; ?>";
  var brgyResoValue = "<?php echo $brgyResoCheck; ?>";

  // GET THE CHECKBOX ELEMENTS
  const oathTakingCheck = document.getElementById('oathTakingCheck');
  const cicCheck = document.getElementById('cicCheck');
  const nfisCheck = document.getElementById('nfisCheck');
  const empOfficerCertCheck = document.getElementById('empOfficerCertCheck');
  const kapasyahanCheck = document.getElementById('kapasyahanCheck');
  const canvassVoteCheck = document.getElementById('canvassVoteCheck');
  const brgyResoCheck = document.getElementById('brgyResoCheck');

  // Helper function to update checkboxes and hide/show related elements
  function showInput(inputValue, checkbox, files, select, description, image) {
    if (checkbox) {
      if (inputValue === "Check") {
        checkbox.checked = true;
      } else {
        checkbox.checked = false;
        const filesEl = document.getElementById(files);
        const selectEl = document.getElementById(select);
        const descEl = document.getElementById(description);
        const imgEl = document.getElementById(image);

        if (selectEl) selectEl.style.visibility = "hidden";
        if (filesEl) filesEl.style.display = "none";
        if (descEl) descEl.style.visibility = "hidden";
        if (imgEl) imgEl.style.visibility = "hidden";
      }
    }
  }

  // Apply settings
  showInput(oathTakingValue, oathTakingCheck, 'oathTaking', 'oathTakingSelect', 'oathTakingDesc', 'oathTakingImage');
  showInput(cicValue, cicCheck, 'cic', 'cicSelect', 'cicDesc', 'cicImage');
  showInput(nfisValue, nfisCheck, 'nfis', 'nfisSelect', 'nfisDesc', 'nfisImage');
  showInput(empOfficerCertValue, empOfficerCertCheck, 'empOfficerCert', 'empOfficerCertSelect', 'empOfficerCertDesc', 'empOfficerCertImage');
  showInput(kapasyahanValue, kapasyahanCheck, 'kapasyahan', 'kapasyahanSelect', 'kapasyahanDesc', 'kapasyahanImage');
  showInput(canvassVoteValue, canvassVoteCheck, 'canvassVote', 'canvassVoteSelect', 'canvassVoteDesc', 'canvassVoteImage');
  showInput(brgyResoValue, brgyResoCheck, 'brgyReso', 'brgyResoSelect', 'brgyResoDesc', 'brgyResoImage');
}

// CALL THE FUNCTION TO INITIALIZE THE CHECKBOXES ON PAGE LOAD
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

document.getElementById("oathTakingCheck").addEventListener("click", function() {
    toggleVisibility('oathTaking');
});

document.getElementById("cicCheck").addEventListener("click", function() {
    toggleVisibility('cic');
});


document.getElementById("nfisCheck").addEventListener("click", function() {
    toggleVisibility('nfis');
});

document.getElementById("empOfficerCertCheck").addEventListener("click", function() {
    toggleVisibility('empOfficerCert');
});

document.getElementById("kapasyahanCheck").addEventListener("click", function() {
    toggleVisibility('kapasyahan');
});

document.getElementById("canvassVoteCheck").addEventListener("click", function() {
    toggleVisibility('canvassVote');
});

document.getElementById("brgyResoCheck").addEventListener("click", function() {
    toggleVisibility('brgyReso');
});

</script>

<script>

   function resetIndex(targetId,targetSelect,targetDesc){
      document.getElementById(targetId).addEventListener('change', function() {
      var selectElement = document.getElementById(targetSelect);
      selectElement.selectedIndex = 0;
      document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
      });
   }

// BORROWER
resetIndex('endorsementLetter', 'endorsementLetterSelect', 'endorsementLetterDesc');
resetIndex('loanAppForm', 'loanAppFormSelect', 'loanAppFormDesc');
resetIndex('memoAgreementS', 'memoAgreementSelect', 'memoAgreementSDesc');
resetIndex('certofEmployment', 'certEmploymentSelect', 'certofEmploymentDesc');
resetIndex('latestPayslip', 'payslipSelect', 'latestPayslipDesc');
resetIndex('itr1', 'itr1Select', 'itr1Desc');
resetIndex('tin', 'tinSelect', 'tinDesc');
resetIndex('proofBilling', 'proofBillingSelect', 'proofBillingDesc');
resetIndex('clearanceLoan', 'clearanceLoanSelect', 'clearanceLoanDesc');
// CO MAKER
resetIndex('coMaker1', 'coMaker1Select', 'coMaker1Desc');
resetIndex('validSignatures', 'validSignaturesSelect', 'validSignaturesDesc');
resetIndex('monthsPayslip', 'monthsPayslipSelect', 'monthsPayslipDesc');
resetIndex('itr2', 'itr2Select', 'itr2Desc');
// CO MAKER 2
resetIndex('coMaker2', 'coMaker2Select', 'coMaker2Desc');
resetIndex('validSignatures2', 'validSignatures2Select', 'validSignatures2Desc');
resetIndex('monthsPayslip2', 'monthsPayslip2Select', 'monthsPayslip2Desc');
resetIndex('itr3', 'itr3Select', 'itr3Desc');
// DOCUMENTS
resetIndex('deductRemit', 'deductRemitSelect', 'deductRemitDesc');
resetIndex('cashflowScore', 'cashflowScoreSelect', 'cashflowScoreDesc');
resetIndex('loanAppMemo', 'loanAppMemoSelect', 'loanAppMemoDesc');
resetIndex('promissoryNoteS', 'promissoryNoteSSelect', 'promissoryNoteSDesc');
resetIndex('disclosureStateS', 'disclosureStateSSelect', 'disclosureStateSDesc');
resetIndex('mriForm', 'mriFormSelect', 'mriFormDesc');
resetIndex('amortScheduleS', 'amortScheduleSSelect', 'amortScheduleSDesc');
resetIndex('utilization', 'utilizationSelect', 'utilizationDesc');
//OTHERS
resetIndex('oathTaking', 'oathTakingSelect', 'oathTakingDesc');
resetIndex('cic', 'cicSelect', 'cicDesc');
resetIndex('nfis', 'nfisSelect', 'nfisDesc');
resetIndex('empOfficerCert', 'empOfficerCertSelect', 'empOfficerCertDesc');
resetIndex('kapasyahan', 'kapasyahanSelect', 'kapasyahanDesc');
resetIndex('brgyReso', 'brgyResoSelect', 'brgyResoDesc');
resetIndex('canvassVote', 'canvassVoteSelect', 'canvassVoteDesc');

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
   setFileVisibility("<?php echo $endorsementLetter; ?>","<?php echo $endorsementLetterSelect; ?>",'endorsementLetter','endorsementLetterImage', 'endorsementLetterButton','endorsementLetterDate');
   setFileVisibility("<?php echo $loanAppForm; ?>","<?php echo $loanAppFormSelect; ?>",'loanAppForm','loanAppFormImage', 'loanAppFormButton','loanAppFormDate');
   setFileVisibility("<?php echo $memoAgreementS; ?>","<?php echo $memoAgreementSelect; ?>",'memoAgreementS','memoAgreementSImage', 'memoAgreementSButton','memoAgreementSDate');
   setFileVisibility("<?php echo $certofEmployment; ?>","<?php echo $certEmploymentSelect; ?>",'certofEmployment','certofEmploymentImage', 'certofEmploymentButton','certofEmploymentDate');
   setFileVisibility("<?php echo $latestPayslip; ?>","<?php echo $payslipSelect; ?>",'latestPayslip','latestPayslipImage', 'latestPayslipButton','latestPayslipDate');
   setFileVisibility("<?php echo $itr1; ?>","<?php echo $itr1Select; ?>",'itr1','itr1Image', 'itr1Button','itr1Date');
   setFileVisibility("<?php echo $tin; ?>","<?php echo $tinSelect; ?>",'tin','tinImage', 'tinButton','tinDate');
   setFileVisibility("<?php echo $proofBilling; ?>","<?php echo $proofBillingSelect; ?>",'proofBilling','proofBillingImage', 'proofBillingButton','proofBillingDate');
   setFileVisibility("<?php echo $clearanceLoan; ?>","<?php echo $clearanceLoanSelect; ?>",'clearanceLoan','clearanceLoanImage', 'clearanceLoanButton','clearanceLoanDate');
   // CO MAKER 1
   setFileVisibility("<?php echo $coMaker1; ?>","<?php echo $coMaker1Select; ?>",'coMaker1','coMaker1Image', 'coMaker1Button','coMaker1Date');
   setFileVisibility("<?php echo $validSignatures; ?>","<?php echo $validSignaturesSelect; ?>",'validSignatures','validSignaturesImage', 'validSignaturesButton','validSignaturesDate');
   setFileVisibility("<?php echo $monthsPayslip; ?>","<?php echo $monthsPayslipSelect; ?>",'monthsPayslip','monthsPayslipImage', 'monthsPayslipButton','monthsPayslipDate');
   setFileVisibility("<?php echo $itr2; ?>","<?php echo $itr2Select; ?>",'itr2','itr2Image', 'itr2Button','itr2Date');
   // CO MAKER 2
   setFileVisibility("<?php echo $coMaker2; ?>","<?php echo $coMaker2Select; ?>",'coMaker2','coMaker2Image', 'coMaker2Button','coMaker2Date');
   setFileVisibility("<?php echo $validSignatures2; ?>","<?php echo $validSignatures2Select; ?>",'validSignatures2','validSignatures2Image', 'validSignatures2Button','validSignatures2Date');
   setFileVisibility("<?php echo $monthsPayslip2; ?>","<?php echo $monthsPayslip2Select; ?>",'monthsPayslip2','monthsPayslip2Image', 'monthsPayslip2Button','monthsPayslip2Date');
   setFileVisibility("<?php echo $itr3; ?>","<?php echo $itr3Select; ?>",'itr3','itr3Image', 'itr3Button','itr3Date');
   // DOCUMENTS
   setFileVisibility("<?php echo $deductRemit; ?>","<?php echo $deductRemitSelect; ?>",'deductRemit','deductRemitImage', 'deductRemitButton','deductRemitDate');
   setFileVisibility("<?php echo $cashflowScore; ?>","<?php echo $cashflowScoreSelect; ?>",'cashflowScore','cashflowScoreImage', 'cashflowScoreButton','cashflowScoreDate');
   setFileVisibility("<?php echo $loanAppMemo; ?>","<?php echo $loanAppMemoSelect; ?>",'loanAppMemo','loanAppMemoImage', 'loanAppMemoButton','loanAppMemoDate');
   setFileVisibility("<?php echo $promissoryNoteS; ?>","<?php echo $promissoryNoteSSelect; ?>",'promissoryNoteS','promissoryNoteSImage', 'promissoryNoteSButton','promissoryNoteSDate');
   setFileVisibility("<?php echo $disclosureStateS; ?>","<?php echo $disclosureStateSSelect; ?>",'disclosureStateS','disclosureStateSImage', 'disclosureStateSButton','disclosureStateSDate');
   setFileVisibility("<?php echo $mriForm; ?>","<?php echo $mriFormSelect; ?>",'mriForm','mriFormImage', 'mriFormButton','mriFormDate');
   setFileVisibility("<?php echo $amortScheduleS; ?>","<?php echo $amortScheduleSSelect; ?>",'amortScheduleS','amortScheduleSImage', 'amortScheduleSButton','amortScheduleSDate');
   setFileVisibility("<?php echo $utilization; ?>", "<?php echo $utilizationSelect; ?>", 'utilization', 'utilizationImage', 'utilizationButton', 'utilizationDate');
   //OTHERS
   setFileVisibility("<?php echo $oathTaking; ?>", "<?php echo $oathTakingSelect; ?>", 'oathTaking', 'oathTakingImage', 'oathTakingButton', 'oathTakingDate');
   setFileVisibility("<?php echo $cic; ?>", "<?php echo $cicSelect; ?>", 'cic', 'cicImage', 'cicButton', 'cicDate');
   setFileVisibility("<?php echo $nfis; ?>", "<?php echo $nfisSelect; ?>", 'nfis', 'nfisImage', 'nfisButton', 'nfisDate');
   setFileVisibility("<?php echo $empOfficerCert; ?>", "<?php echo $empOfficerCertSelect; ?>", 'empOfficerCert', 'empOfficerCertImage', 'empOfficerCertButton', 'empOfficerCertDate');
   setFileVisibility("<?php echo $kapasyahan; ?>", "<?php echo $kapasyahanSelect; ?>", 'kapasyahan', 'kapasyahanImage', 'kapasyahanButton', 'kapasyahanDate');
   setFileVisibility("<?php echo $brgyReso; ?>", "<?php echo $brgyResoSelect; ?>", 'brgyReso', 'brgyResoImage', 'brgyResoButton', 'brgyResoDate');
   setFileVisibility("<?php echo $canvassVote; ?>", "<?php echo $canvassVoteSelect; ?>", 'canvassVote', 'canvassVoteImage', 'canvassVoteButton', 'canvassVoteDate');
</script>
<script>   
   function handleSearch() {
      const selectElements = document.querySelectorAll('#salary select');
      const descriptionInputs = document.querySelectorAll('#salary input[type="text"]');
      const inputFiles = document.querySelectorAll('.salary-tabs input[type=file]');
      const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
      const creditButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
      const checkboxes = document.querySelectorAll(".OTHERS input[type=checkbox]");

      var username = "<?php echo $_SESSION['username']; ?>";
      var bankposition = "<?php echo $_SESSION['bankposition']; ?>";
      var position = "<?php echo $_SESSION['position']; ?>";
      var department = "<?php echo $_SESSION['department']; ?>";

         // APPROVAL BUTTONS RESTRICTION
         if (bankposition !== "Loan Docu. Assistant" && department !=="1" && username !== "jlcricafrente") {
               selectElements.forEach(function(selectElement) {
               selectElement.style.pointerEvents = "none";
            });
               descriptionInputs.forEach(function(descriptionInput) {
               descriptionInput.setAttribute("readonly", "readonly");
            });
         }

    
      // REQUIREMENTS RESTRICTION
      if(position!=="BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" 
         && bankposition !=="LOAN Assistant"  && bankposition!=="LOAN Officer" && department!=="1" && username !== 'hmmendoza' && username !== 'rdalvarez'){
         inputFiles.forEach(function(inputFile){
            inputFile.style.display="none";
         });
      }
      if(bankposition !== "LOAN Assistant" && position !== "BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && department !=="1" && username !== 'hmmendoza' && username !== 'rdalvarez'){
         document.getElementById("deductRemit").style.display="none";
      } 
      if(bankposition !== "LOAN Assistant" && position!=="BM" && username !== "jabportillo" && username !== "ejcemata" 
         && username !== "dgayac" && username !== "dmsantos" && username !=="scpayac" && department !=="1" && username !== 'hmmendoza' && username !== 'rdalvarez'){
         document.getElementById("cashflowScore").style.display="none";
         document.getElementById("loanAppMemo").style.display="none";
         document.getElementById("promissoryNoteS").style.display="none";
         document.getElementById("disclosureStateS").style.display="none";
         document.getElementById("mriForm").style.display="none";
         document.getElementById("amortScheduleS").style.display="none";
      } 

      if(position !== "BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" 
         && username!=="jdiokno" &&  department !=="1" && username !== 'hriegodedios' && username !== 'hmmendoza' && username !== 'cgluda' && username !== 'rdalvarez'){
         document.getElementById("utilization").style.display="none";
      } 

      if(username !== "scpayac" && department != "1"){
         document.getElementById("nextbankSection").style.display="none";
      } 
      document.getElementById("productID").removeAttribute("readonly");

      // CHECKMARK ACCESS
      if(bankposition !== "Loan Docu. Assistant" && bankposition !== "LOAN Assistant" && department !=="1" 
         && username !== "dgayac" && username !== "dmsantos" && username !== "jabportillo" && position!=="BM" && username !== "ejcemata" && username !== 'hmmendoza' && username !== 'rdalvarez'){
         checkboxes.forEach(function (checkbox){
            checkbox.style.pointerEvents = "none";
         });
         document.getElementById("editableLabel").style.pointerEvents = "none";
      }
   }
    // IMPORTANT!!, ALLOW THE IT TO INITIALLY RUN THIS FUNCTION FIRST.
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
      showText('endorsementLetterDesc');
      showText('loanAppFormDesc');
      showText('memoAgreementSDesc');
      showText('certofEmploymentDesc');
      showText('latestPayslipDesc');
      showText('itr1Desc');
      showText('tinDesc');
      showText('proofBillingDesc');
      showText('clearanceLoanDesc');
      showText('coMaker1Desc');
      showText('validSignaturesDesc');
      showText('monthsPayslipDesc');
      showText('itr2Desc');
      showText('coMaker2Desc');
      showText('validSignatures2Desc');
      showText('monthsPayslip2Desc');
      showText('itr3Desc');
      showText('deductRemitDesc');
      showText('cashflowScoreDesc');
      showText('loanAppMemoDesc');
      showText('promissoryNoteSDesc');
      showText('disclosureStateSDesc');
      showText('mriFormDesc');
      showText('amortScheduleSDesc');
      showText('utilizationDesc');

      showText('oathTakingDesc');
      showText('cicDesc');
      showText('nfisDesc');
      showText('empOfficerCertDesc');
      showText('kapasyahanDesc');
      showText('canvassVoteDesc');
      showText('brgyResoDesc');
</script>

</body>
</html>