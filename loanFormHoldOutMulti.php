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
      <title>Hold-Out Loan</title>
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
   <body oncontextmenu="return false;">
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
             echo("Error description: " . mysqli_error($con));
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
            }   
         }
         
         
         // Disable Tab Buttons
         if($type == "Hold-Out Loan-MPL") {       
         ?>
      <?php
         $query = "SELECT a.*, m.* FROM `holdoutloan` AS m
                                    LEFT JOIN `holdoutloanarchive` AS a ON m.holdLoanId = a.a_holdLoanId
                                        WHERE m.holdLoanId = '$id' ";
         $newdata = mysqli_query($con, $query) ;
         $row = mysqli_fetch_array($newdata);
         // BORROWER
         $endorsement = $row['endorsement'];
         $loanAppForm = $row['loanAppForm'];
         $bankDeposit = $row['bankDeposit'];
         $borrowerId = $row['borrowerId'];
         $businessPermit = $row['businessPermit'];
         $brgyClearance = $row['brgyClearance'];
         $payslip = $row['payslip'];
         $proofBilling = $row['proofBilling'];
         // OTHERS
         $bankCert = $row['bankCert'];
         $waiverConfi = $row['waiverConfi'];
         $waiverSecrecy = $row['waiverSecrecy'];
         // CO-BORROWER
         $coBorrowerStatement = $row['coBorrowerStatement'];
         $coBorrowerId = $row['coBorrowerId'];
         $coBorrowerProofIncome = $row['coBorrowerProofIncome'];
         // CO-MAKER
         $coMakerStatement = $row['coMakerStatement'];
         $coMakerId = $row['coMakerId'];
         $coMakerBusinessPermit = $row['coMakerBusinessPermit'];
         $coMakerPayslip = $row['coMakerPayslip'];
         // DOCUMENTS
         $promissoryNote = $row['promissoryNote'];
         $disclosureStatement = $row['disclosureStatement'];
         $utilization = $row['utilization'];
         $amortizationSched = $row['amortizationSched'];
         $insurance = $row['insurance'];
         // $riskRating = $row['riskRating'];
         $cashflowAnalysis = $row['cashflowAnalysis'];
         // BORROWER STATUS
         $loanAppFormSelect = $row['loanAppFormStatus'];
         $businessPermitSelect = $row['businessPermitStatus'];
         $borrowerIdSelect = $row['borrowerIdStatus'];
         $payslipSelect = $row['payslipStatus'];
         $brgyClearanceSelect = $row['brgyClearanceStatus'];
         $proofBillingSelect = $row['proofBillingStatus'];
         $bankCertSelect = $row['bankCertStatus'];
         $bankDepositSelect = $row['bankDepositStatus'];
         $waiverConfiSelect = $row['waiverConfiStatus'];
         $waiverSecrecySelect = $row['waiverSecrecyStatus'];
         // CO BORROWER STATUS
         $coBorrowerStatementSelect = $row['coBorrowerStatementStatus'];
         $coBorrowerIdSelect = $row['coBorrowerIdStatus'];
         $coBorrowerProofIncomeSelect = $row['coBorrowerProofIncomeStatus'];
         // CO MAKER
         $coMakerStatementSelect = $row['coMakerStatementStatus'];
         $coMakerIdSelect = $row['coMakerIdStatus'];
         $coMakerBusinessPermitSelect = $row['coMakerBusinessPermitStatus'];
         $coMakerPayslipSelect = $row['coMakerPayslipStatus'];
         // DOCUEMENTS STATUS
         $endorsementSelect = $row['endorsementStatus'];
         $promissoryNoteSelect = $row['promissoryNoteStatus'];
         $disclosureStatementSelect = $row['disclosureStatementStatus'];
         $utilizationSelect = $row['utilizationStatus'];
         $amortizationSchedSelect = $row['amortizationSchedStatus'];
         $insuranceSelect = $row['insuranceStatus'];
         // $riskRatingSelect = $row['riskRatingStatus'];
         $cashflowAnalysisSelect = $row['cashflowAnalysisStatus'];
         // // OTHER Checkbox
         // $oathTakingCheck = $row['oathTakingCheck'];
         $bankCertCheck = $row['bankCertCheck'];
         $waiverSecrecyCheck = $row['waiverSecrecyCheck'];
         $waiverConfiCheck = $row['waiverConfiCheck'];
         // // Checkbox Status
         // $oathTakingSelect = $row['oathTakingStatus'];
         $bankCertSelect = $row['bankCertStatus'];
         $waiverSecrecySelect = $row['waiverSecrecyStatus'];
         $waiverConfiSelect = $row['waiverConfiStatus'];
         // // Other File
         // $oathTaking = $row['oathTaking'];
         $bankCert = $row['bankCert'];
         $waiverSecrecy = $row['waiverSecrecy'];
         $waiverConfi = $row['waiverConfi'];

         // OTHER SUPPORTING DOCS
         $otherSupport = $row['otherSupport'];
         $otherSupportSelect = $row['otherSupportStatus'];
         $otherSupportCheck = $row['otherSupportCheck'];
         $edit1 = $row['edit1'];
         $cic = $row['cic'];
         $nfis = $row['nfis'];
         $cicSelect = $row['cicStatus'];
         $nfisSelect = $row['nfisStatus'];
         $cicCheck = $row['cicCheck'];
         $nfisCheck = $row['nfisCheck'];
         }
         
         
         // The NUMBER OF PERCENTAGE
         $numberOfFilesUploaded = 0;
         
         $fileInputs = array(         
         $loanAppFormSelect, $borrowerIdSelect, $businessPermitSelect, $brgyClearanceSelect, $proofBillingSelect,
         $bankCertSelect, $bankDepositSelect, $waiverConfiSelect, $waiverSecrecySelect, $coBorrowerStatementSelect, $coBorrowerIdSelect,
         $coBorrowerProofIncomeSelect, $coMakerStatementSelect, $coMakerIdSelect, $coMakerBusinessPermitSelect, $coMakerPayslipSelect, $endorsementSelect,
         $promissoryNoteSelect, $disclosureStatementSelect, $amortizationSchedSelect, $insuranceSelect, $cashflowAnalysisSelect, $otherSupportSelect
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

         $primary="http://124.106.173.237/dashboard/linkHoldOut.php?id=";
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
            <label class="text-dark"><h3><b><?php echo "$fullname &nbsp; $birth &nbsp;" . strtoupper($type). "&nbsp; $loanType"; ?></b></h3></label>
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
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#salary">Salary</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#holdout">Hold-Out</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab2" href="#holdoutmulti">Hold-Out - Multi Purpose</a>
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
                           <form id="salary-form" action="loanHoldOutMultiUploadData.php" method="POST" enctype="multipart/form-data">
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
                                       <div class="salary-tabs" style="border-right: 1px solid #ccc; min-height: 94%; width: 100%; margin-top: -0.5%;">
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>BORROWER</u></label></div>
                                             </div>
                                          </div>
                                           <!-- LOAN ENDORSEMENT -->
                                          <div class="row">
                                            <div class="col-8">
                                                <div class="py-1">  
                                                   <label class ="salary-labels">&#x2022; LOAN ENDORSEMENT</label>
                                                   <input type="file" id="endorsement" name="endorsement"><img id="endorsementImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $endorsement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="endorsementButton">Open File</button></a> 
                                                   <?php 
                                                   if(!empty($endorsement)){
                                                      echo '<button type="button" id="endorsementUploadNew" class="endorsementUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="endorsementUploadNew" class="endorsementUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="endorsementShowOld" class="endorsementShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="endorsementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($endorsement, strrpos($endorsement, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="endorsementSelect" name= "endorsementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="endorsementDesc" name = "endorsementDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">
                                                </div>
                                             </div>
                                          </div>
                                          <!-- LOAN APPLICATION FORM -->
                                          <div class="row">
                                            <div class="col-8">
                                                <div class="py-1">  
                                                   <label class ="salary-labels">&#x2022; LOAN APPLICATION FORM</label>
                                                   <input type="file" id="loanAppForm" name="loanAppForm"><img id="loanAppFormImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppForm; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormButton">Open File</button></a> 
                                                   <?php 
                                                   if(!empty($loanAppForm)){
                                                      echo '<button type="button" id="loanAppFormUploadNew" class="loanAppFormUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="loanAppFormUploadNew" class="loanAppFormUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="loanAppFormShowOld" class="loanAppFormShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="loanAppFormDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppForm, strrpos($loanAppForm, '/') + 1, 10); ?></label>
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
                                           <!-- DOA -->
                                          <div class="row">
                                             <div class="col-8">
                                             <div class="py-1">  
                                                <label class ="salary-labels">&#x2022; DEED OF ASSIGNMENT OF</label>
                                                <input type="file" id="bankDeposit" name="bankDeposit"><img id="bankDepositImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $bankDeposit; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="bankDepositButton">Open File</button></a> 
                                                <?php 
                                                if(!empty($bankDeposit)){
                                                   echo '<button type="button" id="bankDepositUploadNew" class="bankDepositUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="bankDepositUploadNew" class="bankDepositUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="bankDepositShowOld" class="bankDepositShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="bankDepositDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($bankDeposit, strrpos($bankDeposit, '/') + 1, 10); ?></label>
                                                <label class ="salary-labels">&nbsp;&nbsp;BANK DEPOSIT</label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="bankDepositSelect" name= "bankDepositSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="bankDepositDesc" name = "bankDepositDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 2 VALID ID -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">  
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; PHOTOCOPY OF (2) VALID</label>
                                                <input type="file" id="borrowerId" class="borrowerId" name="borrowerId"><img id="borrowerIdImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $borrowerId; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrowerIdButton">Open File</button></a> 
                                                <?php 
                                                if(!empty($borrowerId)){
                                                   echo '<button type="button" id="borrowerIdUploadNew" class="borrowerIdUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="borrowerIdUploadNew" class="borrowerIdUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="borrowerIdShowOld" class="borrowerIdShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="borrowerIdDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($borrowerId, strrpos($borrowerId, '/') + 1, 10); ?></label>
                                                <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;ID OF BORROWER </label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select id="borrowerIdSelect" name= "borrowerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="borrowerIdDesc" name = "borrowerIdDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS"> &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- LATEST BUSINESS PERMIT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; LATEST BUSINESS PERMIT</label>
                                                <input type="file" id="businessPermit" class="businessPermit" name="businessPermit"><img id="businessPermitImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $businessPermit; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessPermitButton">Open File</button></a> 
                                                <?php 
                                                if(!empty($businessPermit)){
                                                   echo '<button type="button" id="businessPermitUploadNew" class="businessPermitUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="businessPermitUploadNew" class="businessPermitUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="businessPermitShowOld" class="businessPermitShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="businessPermitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessPermit, strrpos($businessPermit, '/') + 1, 10); ?></label>
                                                <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;(<i>IF APPLICABLE</i>) </label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="businessPermitSelect" name= "businessPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="businessPermitDesc" name = "businessPermitDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PAYSLIP (6 MONTHS) -->    
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; PAYSLIP (6 MONTHS)</label>
                                               <input type="file" id="payslip" name="payslip"><img id="payslipImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $payslip; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="payslipButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($payslip)){
                                                   echo '<button type="button" id="payslipUploadNew" class="payslipUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="payslipUploadNew" class="payslipUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="payslipShowOld" class="payslipShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="payslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($payslip, strrpos($payslip, '/') + 1, 10); ?></label>
                                                <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;(<i>IF EMPLOYED</i>)</label>
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
                                                   <input type="text" id="payslipDesc" name = "payslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BARANGAY CLEARANCE FOR BANK REQUIREMENTS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; BARANGAY CLEARANCE</label>
                                                <input type="file" id="brgyClearance" name="brgyClearance"><img id="brgyClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $brgyClearance; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="brgyClearanceButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($brgyClearance)){
                                                   echo '<button type="button" id="brgyClearanceUploadNew" class="brgyClearanceUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="brgyClearanceUploadNew" class="brgyClearanceUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="brgyClearanceShowOld" class="brgyClearanceShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="brgyClearanceDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($brgyClearance, strrpos($brgyClearance, '/') + 1, 10); ?></label>
                                                <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;FOR BANK REQUIREMENTS</label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="brgyClearanceSelect" name= "brgyClearanceSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="brgyClearanceDesc" name = "brgyClearanceDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <!-- PROOF OF LATEST BILLING -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; PROOF OF LATEST BILLING</label>
                                                <input type="file" id="proofBilling" name="proofBilling"><img id="proofBillingImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $proofBilling; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="proofBillingButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($proofBilling)){
                                                   echo '<button type="button" id="proofBillingUploadNew" class="proofBillingUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="proofBillingUploadNew" class="proofBillingUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="proofBillingShowOld" class="proofBillingShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="proofBillingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label>
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
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>CO-BORROWER</u></label></div>
                                             </div>
                                          </div>
                                          <!-- CO-BORROWER STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class ="salary-labels" >&#x2022; CO-BORROWER STATEMENT</label>
                                                <input type="file" id="coBorrowerStatement" name="coBorrowerStatement"><img id="coBorrowerStatementImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $coBorrowerStatement; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="coBorrowerStatementButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($coBorrowerStatement)){
                                                   echo '<button type="button" id="coBorrowerStatementUploadNew" class="coBorrowerStatementUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="coBorrowerStatementUploadNew" class="coBorrowerStatementUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="coBorrowerStatementShowOld" class="coBorrowerStatementShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="coBorrowerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coBorrowerStatement, strrpos($coBorrowerStatement, '/') + 1, 10); ?></label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coBorrowerStatementSelect" name= "coBorrowerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coBorrowerStatementDesc" name = "coBorrowerStatementDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                            <!-- CO-BORROWER (2) VALID ID OF BORROWER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; PHOTOCOPY OF (2) VALID ID</label>
                                                <input type="file" id="coBorrowerId" name="coBorrowerId"><img id="coBorrowerIdImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $coBorrowerId; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="coBorrowerIdButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($coBorrowerId)){
                                                   echo '<button type="button" id="coBorrowerIdUploadNew" class="coBorrowerIdUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="coBorrowerIdUploadNew" class="coBorrowerIdUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="coBorrowerIdShowOld" class="coBorrowerIdShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="coBorrowerIdDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coBorrowerId, strrpos($coBorrowerId, '/') + 1, 10); ?></label>
                                                <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;BORROWER </label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coBorrowerIdSelect" name= "coBorrowerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coBorrowerIdDesc" name = "coBorrowerIdDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PROOF OF INCOME -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; PROOF OF INCOME</label>
                                                <input type="file" id="coBorrowerProofIncome" name="coBorrowerProofIncome"><img id="coBorrowerProofIncomeImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $coBorrowerProofIncome; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="coBorrowerProofIncomeButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($coBorrowerProofIncome)){
                                                   echo '<button type="button" id="coBorrowerProofIncomeUploadNew" class="coBorrowerProofIncomeUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="coBorrowerProofIncomeUploadNew" class="coBorrowerProofIncomeUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="coBorrowerProofIncomeShowOld" class="coBorrowerProofIncomeShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="coBorrowerProofIncomeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coBorrowerProofIncome, strrpos($coBorrowerProofIncome, '/') + 1, 10); ?></label>
                                                <label class="salary-labels" id="tab-label" for="custom">(<i>IF APPLICABLE</i>)</label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="coBorrowerProofIncomeSelect" name= "coBorrowerProofIncomeSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coBorrowerProofIncomeDesc" name = "coBorrowerProofIncomeDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>CO-MAKER</u></label></div>
                                             </div>
                                          </div>
                                           <!-- CO-MAKER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                <label class ="salary-labels" >&#x2022; CO-MAKER STATEMENT</label>
                                                <input type="file" id="coMakerStatement" name="coMakerStatement"><img id="coMakerStatementImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $coMakerStatement; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="coMakerStatementButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($coMakerStatement)){
                                                   echo '<button type="button" id="coMakerStatementUploadNew" class="coMakerStatementUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="coMakerStatementUploadNew" class="coMakerStatementUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="coMakerStatementShowOld" class="coMakerStatementShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="coMakerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerStatement, strrpos($coMakerStatement, '/') + 1, 10); ?></label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMakerStatementSelect" name= "coMakerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMakerStatementDesc" name = "coMakerStatementDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTO COPY (2) VALID ID OF BORROWER -->
                                          <div class="row">
                                             <div class="col-8">
                                              <div class="py-1">
                                                <label class="salary-labels" id="tab-label" for="custom">&#x2022; PHOTOCOPY OF (2) VALID IF OF</label>
                                                <input type="file" id="coMakerId" name="coMakerId"><img id="coMakerIdImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $coMakerId; ?>" target="_blank">
                                                   <button type="button" class="btn btn-outline-success btnFile " id="coMakerIdButton">Open File</button>
                                                </a> 
                                                <?php 
                                                if(!empty($coMakerId)){
                                                   echo '<button type="button" id="coMakerIdUploadNew" class="coMakerIdUploadNew">+</button>';
                                                }else{
                                                   echo '<button type="button" id="coMakerIdUploadNew" class="coMakerIdUploadNew" disabled>+</button>';
                                                }
                                                echo '<button type="button" id="coMakerIdShowOld" class="coMakerIdShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="coMakerIdDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerId, strrpos($coMakerId, '/') + 1, 10); ?></label>
                                                <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;BORROWER </label>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMakerIdSelect" name= "coMakerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMakerIdDesc" name = "coMakerIdDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- IF BUSINESS LATEST BUSINESS PERMIT -->
                                          <div class="row" style="height: 4em; margin-bottom:-1.5%;">
                                             <div class="col-8">
                                                <div>
                                                   <label class="salary-labels" id="tab-label" for="custom">&#x2022; LATEST BUSINESS PERMIT</label>
                                                   <input type="file" id="coMakerBusinessPermit" name="coMakerBusinessPermit"><img id="coMakerBusinessPermitImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $coMakerBusinessPermit; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="coMakerBusinessPermitButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                   if(!empty($coMakerBusinessPermit)){
                                                      echo '<button type="button" id="coMakerBusinessPermitUploadNew" class="coMakerBusinessPermitUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="coMakerBusinessPermitUploadNew" class="coMakerBusinessPermitUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="coMakerBusinessPermitShowOld" class="coMakerBusinessPermitShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="coMakerBusinessPermitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerBusinessPermit, strrpos($coMakerBusinessPermit, '/') + 1, 10); ?></label>
                                                   <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;(<i>IF BUSINESS</i>)</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="coMakerBusinessPermitSelect" name= "coMakerBusinessPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMakerBusinessPermitDesc" name = "coMakerBusinessPermitDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <br>
                                          <!-- IF EMPLOYED (6 MONTHS) PAYSLIP -->
                                          <div class="row" style="height: 4em; margin-bottom:-1.5%;">
                                             <div class="col-8">
                                                <div>
                                                   <label class="salary-labels" id="tab-label" for="custom">&#x2022; ATLEAST (6 MONTHS) PAYSLIP</label>
                                                   <input type="file" id="coMakerPayslip" name="coMakerPayslip"><img id="coMakerPayslipImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $coMakerPayslip; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="coMakerPayslipButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                   if(!empty($coMakerPayslip)){
                                                      echo '<button type="button" id="coMakerPayslipUploadNew" class="coMakerPayslipUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="coMakerPayslipUploadNew" class="coMakerPayslipUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="coMakerPayslipShowOld" class="coMakerPayslipShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="coMakerPayslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerPayslip, strrpos($coMakerPayslip, '/') + 1, 10); ?></label>
                                                   <label class="salary-labels" id="tab-label" for="custom">&nbsp;&nbsp;(<i>IF EMPLOYED</i>)</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="coMakerPayslipSelect" name= "coMakerPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="coMakerPayslipDesc" name = "coMakerPayslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
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
                                          <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels" >&#x2022;&nbsp;FINANCIAL EVALUATION</label>
                                                   <input type="file" id="cashflowAnalysis" name="cashflowAnalysis"><img id="cashflowAnalysisImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $cashflowAnalysis; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="cashflowAnalysisButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                   if(!empty($cashflowAnalysis)){
                                                      echo '<button type="button" id="cashflowAnalysisUploadNew" class="cashflowAnalysisUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="cashflowAnalysisUploadNew" class="cashflowAnalysisUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="cashflowAnalysisShowOld" class="cashflowAnalysisShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="cashflowAnalysisDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cashflowAnalysis, strrpos($cashflowAnalysis, '/') + 1, 10); ?></label>
                                                   <label class ="salary-labels" >&nbsp;&nbsp;(CASHFLOW ANALYSIS)</label>
                                                   <label class ="salary-labels" >&nbsp;&nbsp;AND BRR SCORECARD</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="cashflowAnalysisSelect" name= "cashflowAnalysisSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="cashflowAnalysisDesc" name = "cashflowAnalysisDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <!-- PORMISORRY NOTE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; PROMISSORY NOTE</label>
                                                   <input type="file" id="promissoryNote" name="promissoryNote"><img id="promissoryNoteImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $promissoryNote; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="promissoryNoteButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                   if(!empty($promissoryNote)){
                                                      echo '<button type="button" id="promissoryNoteUploadNew" class="promissoryNoteUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="promissoryNoteUploadNew" class="promissoryNoteUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="promissoryNoteShowOld" class="promissoryNoteShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="promissoryNoteDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promissoryNote, strrpos($promissoryNote, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="promissoryNoteSelect" name= "promissoryNoteSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="promissoryNoteDesc" name = "promissoryNoteDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- DISCLOSURE STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; DISCLOSURE STATEMENT</label>
                                                   <input type="file" id="disclosureStatement" name="disclosureStatement"><img id="disclosureStatementImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $disclosureStatement; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="disclosureStatementButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                   if(!empty($disclosureStatement)){
                                                      echo '<button type="button" id="disclosureStatementUploadNew" class="disclosureStatementUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="disclosureStatementUploadNew" class="disclosureStatementUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="disclosureStatementShowOld" class="disclosureStatementShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="disclosureStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStatement, strrpos($disclosureStatement, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="disclosureStatementSelect" name= "disclosureStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="disclosureStatementDesc" name = "disclosureStatementDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
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
                                           <!--  AMORTIZATION SCHEDULE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                                   <input type="file" id="amortizationSched" name="amortizationSched"><img id="amortizationSchedImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $amortizationSched; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="amortizationSchedButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                   if(!empty($amortizationSched)){
                                                      echo '<button type="button" id="amortizationSchedUploadNew" class="amortizationSchedUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="amortizationSchedUploadNew" class="amortizationSchedUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="amortizationSchedShowOld" class="amortizationSchedShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="amortizationSchedDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortizationSched, strrpos($amortizationSched, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="amortizationSchedSelect" name= "amortizationSchedSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="amortizationSchedDesc" name = "amortizationSchedDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- INSURANCe -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; INSURANCE</label>
                                                   <input type="file" id="insurance" name="insurance"><img id="insuranceImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $insurance; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="insuranceButton">Open File</button>
                                                   </a> 
                                                   <?php 
                                                   if(!empty($insurance)){
                                                      echo '<button type="button" id="insuranceUploadNew" class="insuranceUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="insuranceUploadNew" class="insuranceUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="insuranceShowOld" class="insuranceShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="insuranceDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($insurance, strrpos($insurance, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="insuranceSelect" name= "insuranceSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="insuranceDesc" name = "insuranceDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- INSURANCe -->
                                          <!-- <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels">&#x2022; BORROWER'S RISKRATING</label>
                                                   <input type="file" id="riskRating" name="riskRating"><img id="riskRatingImage" src="statusImage/check.png" alt="statusImage">
                                                      <button type="button" class="btn btn-outline-success btnFile " id="riskRatingButton">Open File</button>
                                                   </a> 
                                                   if(!empty($riskRating)){
                                                      echo '<button type="button" id="riskRatingUploadNew" class="riskRatingUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="riskRatingUploadNew" class="riskRatingUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="riskRatingShowOld" class="riskRatingShowOld">History</button>';
                                                   <label class ="salary-labels"> RATING (BRR)/CASHFLOW </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="riskRatingSelect" name= "riskRatingSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="riskRatingDesc" name = "riskRatingDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div> -->
                                          <!-- FOR SPACE -->
                                          <div class="row">
                                             <div class="col-8" style="height:5em; margin-bottom:-2%;" ></div>
                                          </div>

                                          <div class="row">
                                             <div class="col-8">
                                                 <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.4em">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><u>OTHERS</u></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class = "OTHERS">
                                             <!-- KASULAT NA bankCert (IF APPLICABLE)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="bankCertCheck" name="bankCertCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">BANK CERTIFICATION WITH</label>
                                                      <input type="file" id="bankCert" name="bankCert"><img id="bankCertImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $bankCert; ?>" target="_blank">
                                                         <button type="button" class="btn btn-outline-success btnFile " id="bankCertButton">Open File</button>
                                                      </a> 
                                                      <?php 
                                                      if(!empty($bankCert)){
                                                         echo '<button type="button" id="bankCertUploadNew" class="bankCertUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="bankCertUploadNew" class="bankCertUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="bankCertShowOld" class="bankCertShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="bankCertDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($bankCert, strrpos($bankCert, '/') + 1, 10); ?></label>
                                                      <label class ="salary-labels" id="tab-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CURRENT BALANCE</label><br>
                                                      <label class ="salary-labels" id="tab-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<i>IF APPLICABLE</i>)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "bankCertSelect" name = "bankCertSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="bankCertDesc" name = "bankCertDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                                <!-- OFFICE OF BRGY. RESOLUTION (IF APPLICABLE)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="waiverConfiCheck" name="waiverConfiCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">WAIVER OF CONFIDENTIALITY</label>
                                                      <input type="file" id="waiverConfi" name="waiverConfi"><img id="waiverConfiImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $waiverConfi; ?>" target="_blank">
                                                         <button type="button" class="btn btn-outline-success btnFile " id="waiverConfiButton">Open File</button>
                                                      </a> 
                                                      <?php 
                                                      if(!empty($waiverConfi)){
                                                         echo '<button type="button" id="waiverConfiUploadNew" class="waiverConfiUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="waiverConfiUploadNew" class="waiverConfiUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="waiverConfiShowOld" class="waiverConfiShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="waiverConfiDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($waiverConfi, strrpos($waiverConfi, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "waiverConfiSelect" name = "waiverConfiSelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="waiverConfiDesc" name = "waiverConfiDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                                <!-- CANVASS OF VOTES(IF APPLICABLE)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="waiverSecrecyCheck" name="waiverSecrecyCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">WAIVER OF SECRECY OF DEPOSIT</label>
                                                      <input type="file" id="waiverSecrecy" name="waiverSecrecy"><img id="waiverSecrecyImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $waiverSecrecy; ?>" target="_blank">
                                                         <button type="button" class="btn btn-outline-success btnFile " id="waiverSecrecyButton">Open File</button>
                                                      </a> 
                                                      <?php 
                                                      if(!empty($waiverSecrecy)){
                                                         echo '<button type="button" id="waiverSecrecyUploadNew" class="waiverSecrecyUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="waiverSecrecyUploadNew" class="waiverSecrecyUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="waiverSecrecyShowOld" class="waiverSecrecyShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="waiverSecrecyDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($waiverSecrecy, strrpos($waiverSecrecy, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "waiverSecrecySelect" name = "waiverSecrecySelect" tabindex="-1">
                                                         <option selected value= "NULL" >Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="waiverSecrecyDesc" name = "waiverSecrecyDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                                <!-- CIC-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="cicCheck" name="cicCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">CIC</label>
                                                      <input type="file" id="cic" name="cic"><img id="cicImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $cic; ?>" target="_blank">
                                                         <button type="button" class="btn btn-outline-success btnFile " id="cicButton">Open File</button>
                                                      </a> 
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
                                             <!-- NFIS-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <input class="form-check-input" type="checkbox" value="Check" id="nfisCheck" name="nfisCheck" tabindex="-1">
                                                      <label class ="salary-labels" id="tab-label">NFIS</label>
                                                      <input type="file" id="nfis" name="nfis"><img id="nfisImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $nfis; ?>" target="_blank">
                                                         <button type="button" class="btn btn-outline-success btnFile " id="nfisButton">Open File</button>
                                                      </a> 
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
                                             <!-- OTHERS (SUPPORTING DOCUMENTS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2"> 
                                                      <input class="form-check-input" type="checkbox" value="Check" id="otherSupportCheck" name="otherSupportCheck">
                                                      <input type="text" class="salary-labels" id="editableLabel" name="edit1" placeholder="OTHERS (SUPPORTING DOCUMENTS)" value = "<?php echo $edit1 ;?>" style="font-weight: bold;" tabindex="-1">
                                                      <input type="file" id="otherSupport" name="otherSupport"><img id="otherSupportImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $otherSupport; ?>" target="_blank">
                                                         <button type="button" class="btn btn-outline-success btnFile " id="otherSupportButton">Open File</button>
                                                      </a> 
                                                      <?php 
                                                      if(!empty($otherSupport)){
                                                         echo '<button type="button" id="otherSupportUploadNew" class="otherSupportUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="otherSupportUploadNew" class="otherSupportUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="otherSupportShowOld" class="otherSupportShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="otherSupportDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherSupport, strrpos($otherSupport, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select id="otherSupportSelect" name="otherSupportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" id="otherSupportDesc" name="otherSupportDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
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
  </body>
</html>
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->


<script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
<script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, holdId) {
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
                     d.holdId = holdId;
                }
            },
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [] // Apply sorting preferences if necessary
            }]
        });
    });
}
$(document).on('click', '#endorsementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_endorsement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanAppFormShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_loanAppForm.php', '<?php echo $id; ?>');
});

$(document).on('click', '#bankDepositShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_bankDeposit.php', '<?php echo $id; ?>');
});

$(document).on('click', '#borrowerIdShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_borrowerId.php', '<?php echo $id; ?>');
});

$(document).on('click', '#businessPermitShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_businessPermit.php', '<?php echo $id; ?>');
});

$(document).on('click', '#payslipShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_payslip.php', '<?php echo $id; ?>');
});

$(document).on('click', '#brgyClearanceShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_brgyClearance.php', '<?php echo $id; ?>');
});

$(document).on('click', '#proofBillingShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_proofBilling.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coBorrowerStatementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_coBorrowerStatement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coBorrowerIdShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_coBorrowerId.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coBorrowerProofIncomeShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_coBorrowerProofIncome.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMakerStatementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_coMakerStatement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMakerIdShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_coMakerId.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMakerBusinessPermitShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_coMakerBusinessPermit.php', '<?php echo $id; ?>');
});

$(document).on('click', '#coMakerPayslipShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_coMakerPayslip.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cashflowAnalysisShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_cashflowAnalysis.php', '<?php echo $id; ?>');
});

$(document).on('click', '#promissoryNoteShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_promissoryNote.php', '<?php echo $id; ?>');
});

$(document).on('click', '#disclosureStatementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_disclosureStatement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortizationSchedShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_amortizationSched.php', '<?php echo $id; ?>');
});

$(document).on('click', '#insuranceShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_insurance.php', '<?php echo $id; ?>');
});

// $(document).on('click', '#riskRatingShowOld', function(){
//    initializeDataTable('#oldFile', 'fetch_ha_riskRating.php', ');
// });

$(document).on('click', '#bankCertShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_bankCert.php', '<?php echo $id; ?>');
});

$(document).on('click', '#waiverConfiShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_waiverConfi.php', '<?php echo $id; ?>');
});

$(document).on('click', '#waiverSecrecyShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_waiverSecrecy.php', '<?php echo $id; ?>');
});

$(document).on('click', '#otherSupportShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_otherSupport.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortScheduleMShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ma_amortScheduleM.php', '<?php echo $id; ?>');
});

$(document).on('click', '#utilizationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_utilization.php', '<?php echo $id; ?>');
});

// $(document).on('click', '#loanAppFormShowOld', function(){
//    initializeDataTable('#oldFile', 'fetch_ma_loanAppForm.php', '<?php echo $id; ?>');
// });

$(document).on('click', '#cicShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_cic.php', '<?php echo $id; ?>');
});

$(document).on('click', '#nfisShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ha_nfis.php', '<?php echo $id; ?>');
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

$(document).on('click', '#endorsementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#loanAppFormShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#bankDepositShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#borrowerIdShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#businessPermitShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#payslipShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#brgyClearanceShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#proofBillingShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coBorrowerStatementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coBorrowerIdShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coBorrowerProofIncomeShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMakerStatementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMakerIdShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMakerBusinessPermitShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#coMakerPayslipShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#cashflowAnalysisShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#promissoryNoteShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#disclosureStatementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#amortizationSchedShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#insuranceShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

// $(document).on('click', '#riskRatingShowOld', function(e){
//    e.preventDefault();
//    historyModal.show()
// });

$(document).on('click', '#bankCertShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#waiverConfiShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#waiverSecrecyShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#otherSupportShowOld', function(e){
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

$(document).on('click', '#cicShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#nfisShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

</script>

<script>
$(document).ready(function(){
   $(document).on('click', '.btnRelease', function(e){
      var btnHoldOutId = $(this).val();
      // alert(btnHoldOutId);
      var confirmMo = confirm("Please Confirm, You want to Release this Client?");
      if(confirmMo){
         $.ajax({
            url: 'pipeHoldUpd.php',
            type: 'POST',
            data: { btnHoldOutId: btnHoldOutId },
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
handleSelectChange('endorsementSelect', 'endorsementDesc');
handleSelectChange('loanAppFormSelect', 'loanAppFormDesc');
handleSelectChange('bankDepositSelect', 'bankDepositDesc');
handleSelectChange('borrowerIdSelect', 'borrowerIdDesc');
handleSelectChange('borrowerIdSelect', 'businessPermitDesc');
handleSelectChange('payslipSelect', 'payslipDesc');
handleSelectChange('brgyClearanceSelect', 'brgyClearanceDesc');
handleSelectChange('proofBillingSelect', 'proofBillingDesc');
// CO MAKER 1
handleSelectChange('coBorrowerStatementSelect', 'coBorrowerStatementDesc');
handleSelectChange('coBorrowerIdSelect', 'coBorrowerIdDesc');
handleSelectChange('coBorrowerProofIncomeSelect', 'coBorrowerProofIncomeDesc');
// CO-MAKER 2
handleSelectChange('coMakerStatementSelect', 'coMakerStatementDesc');
handleSelectChange('coMakerIdSelect', 'coMakerIdDesc');
handleSelectChange('coMakerBusinessPermitSelect', 'coMakerBusinessPermitDesc');
// DOCUMENTS
handleSelectChange('cashflowAnalysisSelect', 'cashflowAnalysisDesc');
handleSelectChange('promissoryNoteSelect', 'promissoryNoteDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');
handleSelectChange('disclosureStatementSelect', 'disclosureStatementDesc');
handleSelectChange('insuranceSelect', 'insuranceDesc');
// handleSelectChange('riskRatingSelect', 'riskRatingDesc');
handleSelectChange('amortizationSchedSelect', 'amortizationSchedDesc');
// OTHERS
handleSelectChange('bankCertSelect', 'bankCertDesc');
handleSelectChange('waiverSecrecySelect', 'waiverSecrecyDesc');
handleSelectChange('waiverConfiSelect', 'waiverConfiDesc');
handleSelectChange('cicSelect', 'cicDesc');
handleSelectChange('nfisSelect', 'nfisDesc');
handleSelectChange('otherSupportSelect', 'otherSupportDesc');
</script>


<!-- Salary-FORM AJAX-->
<script>
  var salaryform = document.getElementById("salary-form");
  var branch = "<?php echo $branch; ?>";
  var holdOutId = "<?php echo $id; ?>";
  var fullname= "<?php echo $fullname; ?>";
  var salaryType= "<?php echo $type; ?>";
  var loanType= "<?php echo $loanType; ?>";
  var endPrompt = "";
  
  function uploadFileS() {
    var salaryformData = new FormData(salaryform);
    salaryformData.append('holdOutId', holdOutId);
    salaryformData.append('fullname', fullname);
    salaryformData.append('salaryType', salaryType);
    salaryformData.append('branch', branch);
    salaryformData.append('loanType', loanType);

    salaryformData.append('endPrompt', endPrompt);
    
    $.ajax({
      url: 'loanHoldOutMultiUploadData.php', 
      type: 'POST',
      data: salaryformData,
      processData: false,
      contentType: false,
      success: function(response) {
         // console.log(success);
      // BORROWER
      updateFileStatus('endorsement', 'endorsementImage');
      updateFileStatus('loanAppForm', 'loanAppFormImage');
      updateFileStatus('bankDeposit', 'bankDepositImage');
      updateFileStatus('borrowerId', 'borrowerIdImage');
      updateFileStatus('businessPermit', 'businessPermitImage');
      updateFileStatus('payslip', 'payslipImage');
      updateFileStatus('brgyClearance', 'brgyClearanceImage');
      updateFileStatus('proofBilling', 'proofBillingImage');
      // CO-BORROWER
      updateFileStatus('coBorrowerStatement', 'coBorrowerStatementImage');
      updateFileStatus('coBorrowerId', 'coBorrowerIdImage');
      updateFileStatus('coBorrowerProofIncome', 'coBorrowerProofIncomeImage');
      // CO-MAKER
      updateFileStatus('coMakerStatement', 'coMakerStatementImage');
      updateFileStatus('coMakerId', 'coMakerIdImage');
      updateFileStatus('coMakerBusinessPermit', 'coMakerBusinessPermitImage');
      updateFileStatus('coMakerPayslip', 'coMakerPayslipImage');
      // DOCUMENTS
      updateFileStatus('cashflowAnalysis', 'cashflowAnalysisImage');
      updateFileStatus('promissoryNote', 'promissoryNoteImage');
      updateFileStatus('disclosureStatement', 'disclosureStatementImage');
      updateFileStatus('utilization', 'utilizationImage');
      updateFileStatus('amortizationSched', 'amortizationSchedImage');
      updateFileStatus('insurance', 'insuranceImage');
      // updateFileStatus('riskRating', 'riskRatingImage');
      // OTHERS
      updateFileStatus('bankCert', 'bankCertImage');
      updateFileStatus('waiverConfi', 'waiverConfiImage');
      updateFileStatus('waiverSecrecy', 'waiverSecrecyImage');
      updateFileStatus('cic', 'cicImage');
      updateFileStatus('nfis', 'nfisImage');
      updateFileStatus('otherSupport', 'otherSupportImage');

      },
      error: function(xhr, status, error) {
        console.log('File upload failed', error);
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
        var holdOutId = "<?php echo $id; ?>";
        formData.append('endPrompt', endPrompt);  // Add remarks to the form data
        formData.append('holdOutId', holdOutId);

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
                        url: 'loanHoldOutMultiUploadData.php',
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

   // for loanAppFormM
   $(document).on('click', '.endorsementUploadNew', function(e) {
      e.preventDefault();
      handleEndorsementUpload('#endorsement');
   });

    // for borrower_Idsignature
    $(document).on('click', '.loanAppFormUploadNew', function(e){
         e.preventDefault();
        handleEndorsementUpload('#loanAppForm');
    });

    //  for borrower_Lbp
    $(document).on('click', '.bankDepositUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#bankDeposit');
    });

    // for borrower_Lpb
    $(document).on('click', '.borrowerIdUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#borrowerId');
    });

    //  for coborrowerStatement
    $(document).on('click', '.businessPermitUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#businessPermit');
    });

    //  for coBorrowerIdSign
    $(document).on('click', '.payslipUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#payslip');
    });

      //  for ProofOfIncome
   $(document).on('click', '.brgyClearanceUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#brgyClearance');
    });


    //  for comakerStatement
    $(document).on('click', '.proofBillingUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#proofBilling');
    });

    //  for coMakerIdWithSign
    $(document).on('click', '.coBorrowerStatementUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coBorrowerStatement');
    });

    //  for latestPermit
    $(document).on('click', '.coBorrowerIdUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coBorrowerId');
    });

    //  for coMakerPayslip
    $(document).on('click', '.coBorrowerProofIncomeUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coBorrowerProofIncome');
    });

    //  for businessValidation
    $(document).on('click', '.coMakerStatementUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coMakerStatement');
    });

     //  for loanInstallment
    $(document).on('click', '.coMakerIdUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coMakerId');
    });

    //  for loanPayment
    $(document).on('click', '.coMakerBusinessPermitUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coMakerBusinessPermit');
    });

    //  for statementAccount
    $(document).on('click', '.coMakerPayslipUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#coMakerPayslip');
    });

    //  for validCardReport
    $(document).on('click', '.cashflowAnalysisUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#cashflowAnalysis');
    });

    //  for creditReport
    $(document).on('click', '.promissoryNoteUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#promissoryNote');
    });

    //  for creditInvestigationReportM
    $(document).on('click', '.disclosureStatementUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#disclosureStatement');
    });

   //  /  for debitWaiver
    $(document).on('click', '.utilizationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#utilization');
    });


    //  for debitWaiver
    $(document).on('click', '.amortizationSchedUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#amortizationSched');
    });

    //  for affidavitSurrender
    $(document).on('click', '.insuranceUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#insurance');
    });

   //  $(document).on('click', '.riskRatingUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#riskRating');
   //  });

    //  for loanApprovalSheet
    $(document).on('click', '.bankCertUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#bankCert');
    });

    //  for riskRating
    $(document).on('click', '.waiverConfiUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#waiverConfi');
    });

    //  for promissoryNoteM
    $(document).on('click', '.waiverSecrecyUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#waiverSecrecy');
    });

    //  for disclosureStateM
    $(document).on('click', '.otherSupportUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#otherSupport');
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
selectOptionBasedOnValue('<?php echo $endorsementSelect; ?>', 'endorsementSelect','endorsementDesc');
selectOptionBasedOnValue('<?php echo $loanAppFormSelect; ?>', 'loanAppFormSelect','loanAppFormDesc');
selectOptionBasedOnValue('<?php echo $bankDepositSelect; ?>', 'bankDepositSelect', 'bankDepositDesc');
selectOptionBasedOnValue('<?php echo $borrowerIdSelect; ?>', 'borrowerIdSelect', 'borrowerIdDesc');
selectOptionBasedOnValue('<?php echo $businessPermitSelect; ?>', 'businessPermitSelect', 'businessPermitDesc');
selectOptionBasedOnValue('<?php echo $payslipSelect; ?>', 'payslipSelect', 'payslipDesc');
selectOptionBasedOnValue('<?php echo $brgyClearanceSelect; ?>', 'brgyClearanceSelect', 'brgyClearanceDesc');
selectOptionBasedOnValue('<?php echo $proofBillingSelect; ?>', 'proofBillingSelect', 'proofBillingDesc')
// CO MAKER 1
selectOptionBasedOnValue('<?php echo $coBorrowerStatementSelect; ?>', 'coBorrowerStatementSelect', 'coBorrowerStatementDesc');
selectOptionBasedOnValue('<?php echo $coBorrowerIdSelect; ?>', 'coBorrowerIdSelect', 'coBorrowerIdDesc');
selectOptionBasedOnValue('<?php echo $coBorrowerProofIncomeSelect; ?>', 'coBorrowerProofIncomeSelect', 'coBorrowerProofIncomeDesc');
// CO MAKER 2
selectOptionBasedOnValue('<?php echo $coMakerStatementSelect; ?>', 'coMakerStatementSelect', 'coMakerStatementDesc');
selectOptionBasedOnValue('<?php echo $coMakerIdSelect; ?>', 'coMakerIdSelect', 'coMakerIdDesc');
selectOptionBasedOnValue('<?php echo $coMakerBusinessPermitSelect; ?>', 'coMakerBusinessPermitSelect', 'coMakerBusinessPermitDesc');
selectOptionBasedOnValue('<?php echo $coMakerPayslipSelect; ?>', 'coMakerPayslipSelect', 'coMakerPayslipDesc');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo $cashflowAnalysisSelect; ?>', 'cashflowAnalysisSelect', 'cashflowAnalysisDesc');
selectOptionBasedOnValue('<?php echo $promissoryNoteSelect; ?>', 'promissoryNoteSelect', 'promissoryNoteDesc');
selectOptionBasedOnValue('<?php echo $disclosureStatementSelect; ?>', 'disclosureStatementSelect', 'disclosureStatementDesc');
selectOptionBasedOnValue('<?php echo $utilizationSelect; ?>', 'utilizationSelect', 'utilizationDesc');
selectOptionBasedOnValue('<?php echo $amortizationSchedSelect; ?>', 'amortizationSchedSelect', 'amortizationSchedDesc');
selectOptionBasedOnValue('<?php echo $insuranceSelect; ?>', 'insuranceSelect', 'insuranceDesc');
// selectOptionBasedOnValue('', 'riskRatingSelect', 'riskRatingDesc');
//OTHERS
selectOptionBasedOnValue('<?php echo $bankCertSelect; ?>', 'bankCertSelect', 'bankCertDesc');
selectOptionBasedOnValue('<?php echo $waiverSecrecySelect; ?>', 'waiverSecrecySelect', 'waiverSecrecyDesc');
selectOptionBasedOnValue('<?php echo $waiverConfiSelect; ?>', 'waiverConfiSelect', 'waiverConfiDesc');
selectOptionBasedOnValue('<?php echo $cicSelect; ?>', 'cicSelect', 'cicDesc');
selectOptionBasedOnValue('<?php echo $nfisSelect; ?>', 'nfisSelect', 'nfisDesc');
selectOptionBasedOnValue('<?php echo $otherSupportSelect; ?>', 'otherSupportSelect', 'otherSupportDesc');

</script>

<script>
function initializeCheckboxes() {  
  var bankCertValue = "<?php echo $bankCertCheck; ?>";
  var waiverSecrecyValue = "<?php echo $waiverSecrecyCheck; ?>";
  var waiverConfiValue = "<?php echo $waiverConfiCheck; ?>";
  var cicValue = "<?php echo $cicCheck; ?>";
  var nfisValue = "<?php echo $nfisCheck; ?>";
  var otherSupportValue = "<?php echo $otherSupportCheck; ?>";
  
  // GET THE CHECKBOX ELEMENTS
  const bankCertCheck = document.getElementById('bankCertCheck');
  const waiverSecrecyCheck = document.getElementById('waiverSecrecyCheck');
  const waiverConfiCheck = document.getElementById('waiverConfiCheck');
  const cicCheck = document.getElementById('cicCheck');
  const nfisCheck = document.getElementById('nfisCheck');
  const otherSupportCheck = document.getElementById('otherSupportCheck');

  // CHECK THE CHECKBOXES BASED ON THE PHP DATA
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

showInput(bankCertValue, bankCertCheck, 'bankCert', 'bankCertSelect', 'bankCertDesc', `bankCertImage`);
showInput(waiverSecrecyValue, waiverSecrecyCheck, 'waiverSecrecy', 'waiverSecrecySelect', 'waiverSecrecyDesc', `waiverSecrecyImage`);
showInput(waiverConfiValue, waiverConfiCheck, 'waiverConfi', 'waiverConfiSelect', 'waiverConfiDesc', `waiverConfiImage`);
showInput(cicValue, cicCheck, 'cic', 'cicSelect', 'cicDesc', `cicImage`);
showInput(nfisValue, nfisCheck, 'nfis', 'nfisSelect', 'nfisDesc', `nfisImage`);
showInput(otherSupportValue, otherSupportCheck, 'otherSupport', 'otherSupportSelect', 'otherSupportDesc', `otherSupportImage`);
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

document.getElementById("bankCertCheck").addEventListener("click", function() {
    toggleVisibility('bankCert');
});

document.getElementById("waiverConfiCheck").addEventListener("click", function() {
    toggleVisibility('waiverConfi');
});

document.getElementById("waiverSecrecyCheck").addEventListener("click", function() {
    toggleVisibility('waiverSecrecy');
});

document.getElementById("cicCheck").addEventListener("click", function() {
    toggleVisibility('cic');
});

document.getElementById("nfisCheck").addEventListener("click", function() {
    toggleVisibility('nfis');
});

document.getElementById("otherSupportCheck").addEventListener("click", function() {
    toggleVisibility('otherSupport');
});



</script>

<script>

$(document).ready(function() {
    // Function to reset index and hide description element
    function resetIndex(targetId, targetSelect, targetDesc) {
        $("#" + targetId).change(function() {
            $("#" + targetSelect).prop("selectedIndex", 0);
            $("#" + targetDesc).css("visibility", "hidden");
        });
    }

    // BORROWER
    resetIndex('endorsement', 'endorsementSelect', 'endorsementDesc');
    resetIndex('loanAppForm', 'loanAppFormSelect', 'loanAppFormDesc');
    resetIndex('bankDeposit', 'bankDepositSelect', 'bankDepositDesc');
    resetIndex('borrowerId', 'borrowerIdSelect', 'borrowerIdDesc');
    resetIndex('businessPermit', 'businessPermitSelect', 'businessPermitDesc');
    resetIndex('payslip', 'payslipSelect', 'payslipDesc');
    resetIndex('brgyClearance', 'brgyClearanceSelect', 'brgyClearanceDesc');
    resetIndex('proofIncome', 'proofIncomeSelect', 'proofIncomeDesc');
    // CO-BORROWER
    resetIndex('coBorrowerStatement', 'coBorrowerStatementSelect', 'coBorrowerStatementDesc');
    resetIndex('coBorrowerId', 'coBorrowerIdSelect', 'coBorrowerIdDesc');
    resetIndex('coBorrowerProofIncome', 'coBorrowerProofIncomeSelect', 'coBorrowerProofIncomeDesc');
    // CO-MAKER
    resetIndex('coMakerStatement', 'coMakerStatementSelect', 'coMakerStatementDesc');
    resetIndex('coMakerId', 'coMakerIdSelect', 'coMakerIdDesc');
    resetIndex('coMakerBusinessPermit', 'coMakerBusinessPermitSelect', 'coMakerBusinessPermitDesc');
    resetIndex('coMakerPayslip', 'coMakerPayslipSelect', 'coMakerPayslipDesc');
    // DOCUMENTS
    resetIndex('cashflowAnalysis', 'cashflowAnalysisSelect', 'cashflowAnalysisDesc');
    resetIndex('promissoryNote', 'promissoryNoteSelect', 'promissoryNoteDesc');
    resetIndex('disclosureStatement', 'disclosureStatementSelect', 'disclosureStatementDesc');
    resetIndex('utilization', 'utilizationSelect', 'utilizationDesc');
    resetIndex('amortizationSched', 'amortizationSchedSelect', 'amortizationSchedDesc');
    resetIndex('insurance', 'insuranceSelect', 'insuranceDesc');
   //  resetIndex('riskRating', 'riskRatingSelect', 'riskRatingDesc');
    // OTHERS
    resetIndex('bankCert', 'bankCertSelect', 'bankCertDesc');
    resetIndex('waiverConfi', 'waiverConfiSelect', 'waiverConfiDesc');
    resetIndex('waiverSecrecy', 'waiverSecrecySelect', 'waiverSecrecyDesc');
    resetIndex('cic', 'cicSelect', 'cicDesc');
    resetIndex('nfis', 'nfisSelect', 'nfisDesc');
    resetIndex('otherSupport', 'otherSupportSelect', 'otherSupportDesc');
});

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
   setFileVisibility("<?php echo $endorsement; ?>","<?php echo $endorsementSelect; ?>",'endorsement','endorsementImage', 'endorsementButton','endorsementDate');
   setFileVisibility("<?php echo $loanAppForm; ?>","<?php echo $loanAppFormSelect; ?>",'loanAppForm','loanAppFormImage', 'loanAppFormButton','loanAppFormDate');
   setFileVisibility("<?php echo $bankDeposit; ?>","<?php echo $bankDepositSelect; ?>",'bankDeposit','bankDepositImage', 'bankDepositButton','bankDepositDate');
   setFileVisibility("<?php echo $borrowerId; ?>","<?php echo $borrowerIdSelect; ?>",'borrowerId','borrowerIdImage', 'borrowerIdButton','borrowerIdDate');
   setFileVisibility("<?php echo $businessPermit; ?>","<?php echo $borrowerIdSelect; ?>",'businessPermit','businessPermitImage', 'businessPermitButton','businessPermitDate');
   setFileVisibility("<?php echo $payslip; ?>","<?php echo $payslipSelect; ?>",'payslip','payslipImage', 'payslipButton','payslipDate');
   setFileVisibility("<?php echo $brgyClearance; ?>","<?php echo $brgyClearanceSelect; ?>",'brgyClearance','brgyClearanceImage', 'brgyClearanceButton','brgyClearanceDate');
   setFileVisibility("<?php echo $proofBilling; ?>","<?php echo $proofBillingSelect; ?>",'proofBilling','proofBillingImage', 'proofBillingButton','proofBillingDate');
   // CO MAKER 1
   setFileVisibility("<?php echo $coBorrowerStatement; ?>","<?php echo $coBorrowerStatementSelect; ?>",'coBorrowerStatement','coBorrowerStatementImage', 'coBorrowerStatementButton','coBorrowerStatementDate');
   setFileVisibility("<?php echo $coBorrowerId; ?>","<?php echo $coBorrowerIdSelect; ?>",'coBorrowerId','coBorrowerIdImage', 'coBorrowerIdButton','coBorrowerIdDate');
   setFileVisibility("<?php echo $coBorrowerProofIncome; ?>","<?php echo $coBorrowerProofIncomeSelect; ?>",'coBorrowerProofIncome','coBorrowerProofIncomeImage', 'coBorrowerProofIncomeButton','coBorrowerProofIncomeDate');
   // CO MAKER 2
   setFileVisibility("<?php echo $coMakerStatement; ?>","<?php echo $coMakerStatementSelect; ?>",'coMakerStatement','coMakerStatementImage', 'coMakerStatementButton','coMakerStatementDate');
   setFileVisibility("<?php echo $coMakerId; ?>","<?php echo $coMakerIdSelect; ?>",'coMakerId','coMakerIdImage', 'coMakerIdButton','coMakerIdDate');
   setFileVisibility("<?php echo $coMakerBusinessPermit; ?>","<?php echo $coMakerBusinessPermitSelect; ?>",'coMakerBusinessPermit','coMakerBusinessPermitImage', 'coMakerBusinessPermitButton','coMakerBusinessPermitDate');
   setFileVisibility("<?php echo $coMakerPayslip; ?>","<?php echo $coMakerPayslipSelect; ?>",'coMakerPayslip','coMakerPayslipImage', 'coMakerPayslipButton','coMakerPayslipDate');
   // DOCUMENTS
   setFileVisibility("<?php echo $cashflowAnalysis; ?>", "<?php echo $cashflowAnalysisSelect; ?>",'cashflowAnalysis','cashflowAnalysisImage', 'cashflowAnalysisButton','cashflowAnalysisDate');
   setFileVisibility("<?php echo $promissoryNote; ?>", "<?php echo $promissoryNoteSelect; ?>",'promissoryNote', 'promissoryNoteImage', 'promissoryNoteButton', 'promissoryNoteDate');
   setFileVisibility("<?php echo $disclosureStatement; ?>", "<?php echo $disclosureStatementSelect; ?>",'disclosureStatement','disclosureStatementImage', 'disclosureStatementButton','disclosureStatementDate');
   setFileVisibility("<?php echo $utilization; ?>", "<?php echo $utilizationSelect; ?>",'utilization','utilizationImage', 'utilizationButton','utilizationDate');
   setFileVisibility("<?php echo $amortizationSched; ?>", "<?php echo $amortizationSchedSelect; ?>",'amortizationSched','amortizationSchedImage', 'amortizationSchedButton','amortizationSchedDate');
   setFileVisibility("<?php echo $insurance; ?>", "<?php echo $insuranceSelect; ?>", 'insurance', 'insuranceImage', 'insuranceButton', 'insuranceDate');
   // setFileVisibility(" ?>", 'riskRating', 'riskRatingImage', 'riskRatingButton', 'riskRatingDate');
   //OTHERS
   setFileVisibility("<?php echo $bankCert; ?>", "<?php echo $bankCertSelect; ?>", 'bankCert', 'bankCertImage', 'bankCertButton', 'bankCertDate');
   setFileVisibility("<?php echo $waiverConfi; ?>", "<?php echo $waiverConfiSelect; ?>", 'waiverConfi', 'waiverConfiImage', 'waiverConfiButton', 'waiverConfiDate');
   setFileVisibility("<?php echo $waiverSecrecy; ?>", "<?php echo $waiverSecrecySelect; ?>", 'waiverSecrecy', 'waiverSecrecyImage', 'waiverSecrecyButton', 'waiverSecrecyDate');
   setFileVisibility("<?php echo $cic; ?>", "<?php echo $cicSelect; ?>", 'cic', 'cicImage', 'cicButton', 'cicDate');
   setFileVisibility("<?php echo $nfis; ?>", "<?php echo $nfisSelect; ?>", 'nfis', 'nfisImage', 'nfisButton', 'nfisDate');
   setFileVisibility("<?php echo $otherSupport; ?>", "<?php echo $otherSupportSelect; ?>", 'otherSupport', 'otherSupportImage', 'otherSupportButton', 'otherSupportDate');
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
      if(position!=="BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" && bankposition !=="LOAN Assistant"  
         && bankposition!=="LOAN Officer" && department!=="1" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
         inputFiles.forEach(function(inputFile){
            inputFile.style.display="none";
         });
      }

      if(bankposition !== "LOAN Assistant" && position!=="BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" && username !== "scpayac" && department !=="1" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'cgluda' && username !== 'rdalvarez'){
         document.getElementById("cashflowAnalysis").style.display="none";
         document.getElementById("promissoryNote").style.display="none";
         document.getElementById("disclosureStatement").style.display="none";
         document.getElementById("amortizationSched").style.display="none";
         document.getElementById("utilization").style.display="none";
      } 

      if(username !== "scpayac" && department != "1"){
         document.getElementById("nextbankSection").style.display="none";
      } 
      document.getElementById("productID").removeAttribute("readonly");

      // CHECKMARK ACCESS
      if(bankposition !== "Loan Docu. Assistant" && bankposition !== "LOAN Assistant" && department !=="1" && username !== "dgayac" && username !== "dmsantos" 
         && username !== "jabportillo" && position!=="BM" && username !== "ejcemata" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
         document.getElementById("otherSupport").style.display="none";
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
      showText('endorsementDesc');
      showText('loanAppFormDesc');
      showText('bankDepositDesc');
      showText('borrowerIdDesc');
      showText('businessPermitDesc');
      showText('payslipDesc');
      showText('brgyClearanceDesc');
      showText('proofBillingDesc');

      showText('brgyClearanceDesc');
      showText('coBorrowerStatementDesc');
      showText('coBorrowerIdDesc');

      showText('coBorrowerProofIncomeDesc');
      showText('coMakerStatementDesc');
      showText('coMakerIdDesc');
      showText('coMakerBusinessPermitDesc');

      showText('cashflowAnalysisDesc');
      showText('promissoryNoteDesc');
      showText('disclosureStatementDesc');
       showText('utilizationDesc');
      showText('amortizationSchedDesc');
      showText('insuranceDesc');
      // showText('riskRatingDesc');

      showText('bankCertDesc');
      showText('waiverSecrecyDesc');
      showText('waiverConfiDesc');
      showText('cicDesc');
      showText('nfisDesc');

      showText('otherSupportDesc');
</script>