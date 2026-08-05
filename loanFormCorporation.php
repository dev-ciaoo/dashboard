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
  <meta name="description" content="Corporation Data">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Corporation</title>
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
         $data = mysqli_query($con, $query);
         
         if (!$data) {
           echo ("Error description: " . mysqli_error($mysqli));
         } else {
            while ($row = mysqli_fetch_array($data)) {
         
               $Cfname = $row['customerFirstName'];
               $Lfname = $row['customerSurname'];
               $fullname = $row['customerFullName'];
               $birth = $row['birthDate'];
               $id = $row['loan_Id'];
               $type = $row['salaryType'];
               $remType=$row['remType'];
               $sourceIncome=$row['sourceIncome'];
               $branch=$row['branch'];
               $loanType= $row['loanType'];
               $productID=$row['productID'];
               $amountAppliedd = $row['amountApplied'];
               $amountTermss = $row['terms'];
               $interestRatee = $row['interestRate'];

               $amountAppl = number_format($amountAppliedd, 2, '.', ',');

            }
         }
         

         if ($type == "REM: Corporation") {
         
         ?>
       <script>
         document.getElementById('tab3').classList.add('active');;
         document.getElementById('corporation').classList.add('active');
         document.getElementById('tab1').classList.remove('active');
         document.getElementById('tab2').classList.remove('active');
         document.getElementById('tab4').classList.remove('active');
      </script>
      <?php
          $query3 = "SELECT a.*, c.* FROM corporation AS c 
                                    LEFT JOIN corparchive AS a ON c.corpLoanId = a.a_corpLoanId
                                    WHERE c.corpLoanId = '$id' 
                     ";
         $newdata = mysqli_query($con, $query3);
         $rows = mysqli_fetch_array($newdata);
         // PRINCIPAL BORROWER
         $endorsement = $rows['endorsement'];
         $loanAppFormC = $rows['loanAppFormC'];
         $companyProfile = $rows['ccompanyProfile'];
         $governmentId = $rows['governmentId'];
         $secRegistration = $rows['csecRegistration'];
         $latestGIS = $rows['clatestGIS'];
         $copyBRS = $rows['ccopyBRS'];
         $copyidCST = $rows['ccopyidCST'];
         // COLLATERAL DOCUMENTS
         $transferCertTitle = $rows['ctransferCertTitle'];
         $taxDeclaration = $rows['ctaxDeclaration'];
         $taxDeclartionICTC = $rows['ctaxDeclartionICTC'];
         $realStateReceipt = $rows['crealStateReceipt'];
         $realEstateTaxClearance = $rows['crealEstateTaxClearance'];
         $cdOfMorgage = $rows['ccdOfMorgage'];
         // BUSINESS PROOF OF INCOME
         $copyUpdatedBP = $rows['ccopyUpdatedBP'];
         $auditedFinancial = $rows['cauditedFinancial'];
         $inhouseFinancial = $rows['cinhouseFinancial'];
         $latestBank = $rows['clatestBank'];
         $incomeTaxReturn = $rows['incomeTaxReturn'];
         $contractLease = $rows['contractLease'];
         $customerContact = $rows['ccustomerContact'];
         $supplierContact = $rows['csupplierContact'];
         $idPicture = $rows['cidPicture'];
         $proofBilling = $rows['cproofBilling'];
         // OTHERS
         $powerAttorney = $rows['powerAttorney'];
         $contractSell = $rows['contractSell'];
         $letterGuarantee = $rows['letterGuarantee'];
         $statementAccount = $rows['statementAccount'];
         $billMaterials = $rows['billMaterials'];
         $proposedPlan = $rows['proposedPlan'];
         $otherDoc = $rows['otherDoc'];
         $cic = $rows['cic'];
         $nfis = $rows['nfis'];
         // DOCUMENTS
         $receipt = $rows['receipt'];
         $creditInvestigationReportC = $rows['creditInvestigationReportC'];
         $collateralAppraisalReportC = $rows['collateralAppraisalReportC'];
         $financialEvaluationC = $rows['financialEvaluationC'];
         $signedLetterC = $rows['signedLetterC'];
         $signedLoanMemoC = $rows['signedLoanMemoC'];
         $remContractC = $rows['remContractC'];
         $promNoteC = $rows['promNoteC'];
         $disclosureStateC = $rows['disclosureStateC'];
         $mriFormC = $rows['mriFormC'];
         $amortScheduleC = $rows['amortScheduleC'];
         $remContractAnnotatedC = $rows['remContractAnnotatedC'];
         $signedLetterUnderEndC = $rows['signedLetterUnderEndC'];
         $remContractEndC = $rows['remContractEndC'];
         $promNoteEndC = $rows['promNoteEndC'];
         $disclosureStateEndC = $rows['disclosureStateEndC'];
         $mriFormEndC = $rows['mriFormEndC'];
         $amortScheduleEndC = $rows['amortScheduleEndC'];
         $signedDeedUnderEndC = $rows['signedDeedUnderEndC'];
         $utilization=$rows['utilization'];
         $powerpoint=$rows['powerpoint'];
         $excel=$rows['excel'];
         // GETTING OF STATUS FROM DATABASE
         // PRINCIPAL BORROWER
         $endorsementSelect = $rows['endorsementStatus'];
         $loanAppFormCSelect = $rows['loanAppFormCStatus'];
         $companyProfileSelect = $rows['ccompanyProfileStatus'];
         $governmentIdSelect = $rows['governmentIdStatus'];
         $secRegistrationSelect = $rows['csecRegistrationStatus'];
         $latestGISSelect = $rows['clatestGISStatus'];
         $copyBRSSelect = $rows['ccopyBRSStatus'];
         $copyidCSTSelect = $rows['ccopyidCSTStatus'];
         // COLLATERAL DOCUMENTS
         $transferCertTitleSelect = $rows['ctransferCertTitleStatus'];
         $taxDeclarationSelect = $rows['ctaxDeclarationStatus'];
         $taxDeclartionICTCSelect = $rows['ctaxDeclartionICTCStatus'];
         $realStateReceiptSelect = $rows['crealStateReceiptStatus'];
         $realEstateTaxClearanceSelect = $rows['crealEstateTaxClearanceStatus'];
         $cdOfMorgageSelect = $rows['ccdOfMorgageStatus'];
         $copyUpdatedBPSelect = $rows['ccopyUpdatedBPStatus'];
         // BUSINESS PROOF OF INCOME
         $auditedFinancialSelect = $rows['cauditedFinancialStatus'];
         $inhouseFinancialSelect = $rows['cinhouseFinancialStatus'];
         $latestBankSelect = $rows['clatestBankStatus'];
         $incomeTaxReturnSelect = $rows['incomeTaxReturnStatus'];
         $contractLeaseSelect = $rows['contractLeaseStatus'];
         $customerContactSelect = $rows['ccustomerContactStatus'];
         $supplierContactSelect = $rows['csupplierContactStatus'];
         $proofBillingSelect = $rows['cproofBillingStatus'];
         // OTHERS
         $powerAttorneySelect = $rows['powerAttorneyStatus'];
         $contractSellSelect = $rows['contractSellStatus'];
         $letterGuaranteeSelect = $rows['letterGuaranteeStatus'];
         $statementAccountSelect = $rows['statementAccountStatus'];
         $billMaterialsSelect = $rows['billMaterialsStatus'];
         $proposedPlanSelect = $rows['proposedPlanStatus'];
         $otherDocSelect = $rows['otherDocStatus'];
         $cicSelect = $rows['cicStatus'];
         $nfisSelect = $rows['nfisStatus'];
         // DOCUMENTS
         $receiptSelect = $rows['receiptStatus'];
         $creditInvestigationReportCSelect = $rows['creditInvestigationReportCStatus'];
         $collateralAppraisalReportCSelect = $rows['collateralAppraisalReportCStatus'];
         $financialEvaluationCSelect = $rows['financialEvaluationCStatus'];
         $signedLetterCSelect = $rows['signedLetterCStatus'];
         $signedLetterUnderEndCSelect = $rows['signedLetterUnderEndCStatus'];
         $signedLoanMemoCSelect = $rows['signedLoanMemoCStatus'];
         $remContractCSelect = $rows['remContractCStatus'];
         $remContractAnnotatedCSelect = $rows['remContractAnnotatedCStatus'];
         $promNoteCSelect = $rows['promNoteCStatus'];
         $disclosureStateCSelect = $rows['disclosureStateCStatus'];
         $mriFormCSelect = $rows['mriFormCStatus'];
         $amortScheduleCSelect = $rows['amortScheduleCStatus'];
         $remContractEndCSelect = $rows['remContractEndCStatus'];
         $promNoteEndCSelect = $rows['promNoteEndCStatus'];
         $disclosureStateEndCSelect = $rows['disclosureStateEndCStatus'];
         $mriFormEndCSelect = $rows['mriFormEndCStatus'];
         $amortScheduleEndCSelect = $rows['amortScheduleEndCStatus'];
         $signedDeedUnderEndCSelect = $rows['signedDeedUnderEndCStatus'];
         $utilizationSelect=$rows['utilizationStatus'];

         
         $powerAttorneyICheck = $rows['powerAttorneyICheck'];
         $contractSellCheck = $rows['contractSellCheck'];
         $letterGuaranteeCheck = $rows['letterGuaranteeCheck'];
         $statementAccountCheck = $rows['statementAccountCheck'];
         $billMaterialsCheck = $rows['billMaterialsCheck'];
         $proposedPlanCheck = $rows['proposedPlanCheck'];
         $otherDocCheck = $rows['otherDocCheck'];
         $cicCheck = $rows['cicCheck'];
         $nfisCheck = $rows['nfisCheck'];
         $edit1=$rows['edit1'];
         }
         
    
         
         // CALCULATION OF PERCENTAGE
         $requirements = array( $loanAppFormCSelect, $companyProfileSelect, $governmentIdSelect,
         $secRegistrationSelect, $latestGISSelect, $copyBRSSelect, $copyidCSTSelect, $transferCertTitleSelect, $taxDeclarationSelect, $taxDeclartionICTCSelect,
         $realStateReceiptSelect, $realEstateTaxClearanceSelect, $copyUpdatedBPSelect, $auditedFinancialSelect, $inhouseFinancialSelect, $latestBankSelect,
         $contractLeaseSelect, $customerContactSelect, $supplierContactSelect, $creditInvestigationReportCSelect, $collateralAppraisalReportCSelect,
         $financialEvaluationCSelect, $signedLetterCSelect, $signedLoanMemoCSelect
         );
         $endBuyerDocuments=array($signedLetterUnderEndCSelect, $remContractEndCSelect,  $promNoteEndCSelect, 
         $disclosureStateEndCSelect,  $mriFormEndCSelect, $signedDeedUnderEndCSelect);
         
         $notEndBuyerDocuments=array($remContractCSelect,  $remContractAnnotatedCSelect,  $promNoteCSelect,
         $disclosureStateCSelect,  $mriFormCSelect,  $amortScheduleCSelect);
         
         
         if($remType=="End Buyer"){
         $numberOfFilesUploaded = array_merge($requirements, $endBuyerDocuments);
         
         }
         else{
         $numberOfFilesUploaded = array_merge($requirements, $notEndBuyerDocuments);
         }
         
            // Filter out empty values from the array
           // Max Number Of Overall File Base on Condition
           $maxCount=count($numberOfFilesUploaded);

           $nonEmptyFileInputs = array_filter($numberOfFilesUploaded,function($value) {
            $parts = explode("--", $value);
            return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
        });;
           // Count the number of non-empty values
           $numberOfFilesUploaded = count($nonEmptyFileInputs);
           
           // Calculate the percentage
           $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
           $primary="http://124.106.173.237/dashboard/linkCorp.php?id=";
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
            <label class="text-dark"><h3><strong><?php echo "$fullname &nbsp; ". strtoUpper($type) . " &nbsp; $loanType &nbsp; $remType &nbsp; <span style='color: lightgray;'><strong>|</strong></span> &nbsp;&nbsp; AMOUNT: &#8369;$amountAppl &nbsp; TERMS: $amountTermss &nbsp; INTEREST RATE: $interestRatee%"; ?></strong></h3></label>
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
            <span class="close" id="closeModal" style= "font-size:2em; margin-left:95%"><i class="fa fa-times" aria-hidden="true"></i></span>
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
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab3" href="#corporation">Real Estate Mortgage - Corporation</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual">Real Estate Mortgage - Individual</a>
                     </li>
                  </ul>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="corporation" class="tab-pane active" style="border: 1px solid #ccc;">
                              <form id="corporation-form" action="loanCorporationUploadData.php" method="POST" enctype="multipart/form-data">
                              <div id="nextbankSection" style="position: absolute; top: 0; right: 0; margin-right: 4.4em;">
                                 <div class="form">
                                       <input type="text" class="form-control" id="productID" name="productID" style="width: 25em; height: 4em; display: inline-block; font-size: 1.1em; font-weight: bold; " value="<?php echo $productID; ?>" placeholder="NEXTBANK PRODUCT ID" tabindex="-1">
                                 </div>
                              </div>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 my-4"><br>
                                    <div class="row">
                                       <div class="col-8" style="border-right:0;">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">REQUIREMENTS</h1>
                                       </div>
                                       <div class="col-4">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 107%;">APPROVAL</h1>
                                       </div>
                                       </div>
                                       <div class="corporation-tabs" style=" border-right: 1px solid #ccc; min-height: 97.3%; margin-top:-0.5%;">
                                          <!-- Requirements Form -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>PRINCIPAL BORROWER</u></label></div>
                                             </div>
                                          </div>
                                        <!-- ENDORSEMENT/RECOMMENDATION LETTER -->
                                        <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> ENDORSEMENT LETTER</label>
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
                                                <div class="form-group d-flex mb-2">
                                                   <select id="endorsementSelect" name= "endorsementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="endorsementDesc" name = "endorsementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" > &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- LOAN APPLICATION FORM -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> LOAN APPLICATION FORM</label>
                                                   <input type="file" id="loanAppFormC" name="loanAppFormC"><img id="loanAppFormCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppFormC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormCButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($loanAppFormC)){
                                                         echo '<button type="button" id="loanAppFormCUploadNew" class="loanAppFormCUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="loanAppFormCUploadNew" class="loanAppFormCUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="loanAppFormCShowOld" class="loanAppFormCShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="loanAppFormCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormC, strrpos($loanAppFormC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="loanAppFormCSelect" name= "loanAppFormCSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppFormCDesc" name = "loanAppFormCDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" > &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- COMPANY PROFILE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> COMPANY PROFILE</label>
                                                   <input type="file" id="companyProfile" name="companyProfile"><img id="companyProfileImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $companyProfile; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="companyProfileButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($companyProfile)){
                                                         echo '<button type="button" id="companyProfileUploadNew" class="companyProfileUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="companyProfileUploadNew" class="companyProfileUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="companyProfileShowOld" class="companyProfileShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="companyProfileDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($companyProfile, strrpos($companyProfile, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="companyProfileSelect" name="companyProfileSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="companyProfileDesc" name="companyProfileDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF ANY 2 GOVERNMENT</label>
                                                   <input type="file" id="governmentId" name="governmentId"><img id="governmentIdImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $governmentId; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="governmentIdButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($governmentId)){
                                                         echo '<button type="button" id="governmentIdUploadNew" class="governmentIdUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="governmentIdUploadNew" class="governmentIdUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="governmentIdShowOld" class="governmentIdShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="governmentIdDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($governmentId, strrpos($governmentId, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">ISSUED ID OF REPRESENTATIVE OF <br> LOAN WITH 3 SIGNATURES</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="governmentIdSelect" name="governmentIdSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="governmentIdDesc" name="governmentIdDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF SEC REGISTRATION</label>
                                                   <input type="file" id="secRegistration" name="secRegistration"><img id="secRegistrationImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $secRegistration; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="secRegistrationButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($secRegistration)){
                                                         echo '<button type="button" id="secRegistrationUploadNew" class="secRegistrationUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="secRegistrationUploadNew" class="secRegistrationUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="secRegistrationShowOld" class="secRegistrationShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="secRegistrationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($secRegistration, strrpos($secRegistration, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">ARTICILES OF INCORPORATION AND <br> BY-LAWS </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="secRegistrationSelect" name="secRegistrationSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="secRegistrationDesc" name="secRegistrationDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GSIS) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF LATEST</label>
                                                   <input type="file" id="latestGIS" name="latestGIS"><img id="latestGISImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $latestGIS; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestGISButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($latestGIS)){
                                                         echo '<button type="button" id="latestGISUploadNew" class="latestGISUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="latestGISUploadNew" class="latestGISUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="latestGISShowOld" class="latestGISShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="latestGISDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestGIS, strrpos($latestGIS, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">GENERAL INFORMATION SHEET (GIS)</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="latestGISSelect" name="latestGISSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="latestGISDesc" name="latestGISDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">ORIGINAL COPY OF BOARD</label>
                                                   <input type="file" id="copyBRS" name="copyBRS"><img id="copyBRSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyBRS; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyBRSButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($copyBRS)){
                                                         echo '<button type="button" id="copyBRSUploadNew" class="copyBRSUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="copyBRSUploadNew" class="copyBRSUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="copyBRSShowOld" class="copyBRSShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="copyBRSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyBRS, strrpos($copyBRS, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">RESOULUTION AND SECRETARY'S CERTIFICATE </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyBRSSelect" name="copyBRSSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyBRSDesc" name="copyBRSDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF 2 GOVERNMENT ID'S</label>
                                                   <input type="file" id="copyidCST" name="copyidCST"><img id="copyidCSTImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyidCST; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyidCSTButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($copyidCST)){
                                                         echo '<button type="button" id="copyidCSTUploadNew" class="copyidCSTUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="copyidCSTUploadNew" class="copyidCSTUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="copyidCSTShowOld" class="copyidCSTShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="copyidCSTDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyidCST, strrpos($copyidCST, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">OF CORPORATE SECRETARY WITH 3 SIGNATURES</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyidCSTSelect" name="copyidCSTSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyidCSTDesc" name="copyidCSTDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>COLLATERAL DOCUMENTS</u> </label></div>
                                             </div>
                                          </div>
                                          <!-- TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">TRANSFER CERTIFICATE TITLE</label>
                                                   <input type="file" id="transferCertTitle" name="transferCertTitle"><img id="transferCertTitleImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $transferCertTitle; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="transferCertTitleButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($transferCertTitle)){
                                                         echo '<button type="button" id="transferCertTitleUploadNew" class="transferCertTitleUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="transferCertTitleUploadNew" class="transferCertTitleUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="transferCertTitleShowOld" class="transferCertTitleShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="transferCertTitleDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($transferCertTitle, strrpos($transferCertTitle, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">(ORIGINAL & CERTIFIED TRUE COPY) </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="transferCertTitleSelect" name="transferCertTitleSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="transferCertTitleDesc" name="transferCertTitleDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- TAX DECLARTION (LOT-CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">TAX DECLARTION</label>
                                                   <input type="file" id="taxDeclaration" name="taxDeclaration"><img id="taxDeclarationImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $taxDeclaration; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($taxDeclaration)){
                                                         echo '<button type="button" id="taxDeclarationUploadNew" class="taxDeclarationUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="taxDeclarationUploadNew" class="taxDeclarationUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="taxDeclarationShowOld" class="taxDeclarationShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="taxDeclarationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclaration, strrpos($taxDeclaration, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">(LOT-CERTIFIED TRUE COPY) </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclarationSelect" name="taxDeclarationSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationDesc" name="taxDeclarationDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">TAX DECLARTION</label>
                                                   <input type="file" id="taxDeclartionICTC" name="taxDeclartionICTC"><img id="taxDeclartionICTCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $taxDeclartionICTC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclartionICTCButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($taxDeclartionICTC)){
                                                         echo '<button type="button" id="taxDeclartionICTCUploadNew" class="taxDeclartionICTCUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="taxDeclartionICTCUploadNew" class="taxDeclartionICTCUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="taxDeclartionICTCShowOld" class="taxDeclartionICTCShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="taxDeclartionICTCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclartionICTC, strrpos($taxDeclartionICTC, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">(IMPROVEMENT-CERTIFIED TRUE COPY)</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclartionICTCSelect" name="taxDeclartionICTCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclartionICTCDesc" name="taxDeclartionICTCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!--REAL ESTATE RECEIPT (AMILYAR) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">REAL ESTATE RECEIPT</label>
                                                   <input type="file" id="realStateReceipt" name="realStateReceipt"><img id="realStateReceiptImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $realStateReceipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realStateReceiptButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($realStateReceipt)){
                                                         echo '<button type="button" id="realStateReceiptUploadNew" class="realStateReceiptUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="realStateReceiptUploadNew" class="realStateReceiptUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="realStateReceiptShowOld" class="realStateReceiptShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="realStateReceiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realStateReceipt, strrpos($realStateReceipt, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">(AMILYAR) </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="realStateReceiptSelect" name="realStateReceiptSelect" tabindex="-1">
                                                      <option selected value="NULL">Options</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS" id="realStateReceiptDesc" name="realStateReceiptDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- REAL ESTATE TAX CLEARANCE-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">REAL ESTATE TAX CLEARANCE </label>
                                                   <input type="file" id="realEstateTaxClearance" name="realEstateTaxClearance"><img id="realEstateTaxClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $realEstateTaxClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxClearanceButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($realEstateTaxClearance)){
                                                         echo '<button type="button" id="realEstateTaxClearanceUploadNew" class="realEstateTaxClearanceUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="realEstateTaxClearanceUploadNew" class="realEstateTaxClearanceUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="realEstateTaxClearanceShowOld" class="realEstateTaxClearanceShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="realEstateTaxClearanceDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxClearance, strrpos($realEstateTaxClearance, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="realEstateTaxClearanceSelect" name="realEstateTaxClearanceSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="realEstateTaxClearanceDesc" name="realEstateTaxClearanceDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">CANCELLATION AND DISCHARGE</label>
                                                   <input type="file" id="cdOfMorgage" name="cdOfMorgage"><img id="cdOfMorgageImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $cdOfMorgage; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cdOfMorgageButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($cdOfMorgage)){
                                                         echo '<button type="button" id="cdOfMorgageUploadNew" class="cdOfMorgageUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="cdOfMorgageUploadNew" class="cdOfMorgageUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="cdOfMorgageShowOld" class="cdOfMorgageShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="cdOfMorgageDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cdOfMorgage, strrpos($cdOfMorgage, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">OF MORGAGE (IF APPLICABLE) </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="cdOfMorgageSelect" name="cdOfMorgageSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cdOfMorgageDesc" name="cdOfMorgageDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>BUSINESS PROOF OF INCOME</u> </label></div>
                                             </div>
                                          </div>
                                           <!-- UPDATED BUSINESS PERMIT PERMIT (MAYOR'S, BARANGAY AND/OR DTI)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">UPDATED BUSINESS PERMIT</label>
                                                   <input type="file" id="copyUpdatedBP" name="copyUpdatedBP"><img id="copyUpdatedBPImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyUpdatedBP; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyUpdatedBPButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($copyUpdatedBP)){
                                                         echo '<button type="button" id="copyUpdatedBPUploadNew" class="copyUpdatedBPUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="copyUpdatedBPUploadNew" class="copyUpdatedBPUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="copyUpdatedBPShowOld" class="copyUpdatedBPShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="copyUpdatedBPDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyUpdatedBP, strrpos($copyUpdatedBP, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">(MAYOR'S, BARANGAY AND/OR DTI)</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyUpdatedBPSelect" name="copyUpdatedBPSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyUpdatedBPDesc" name="copyUpdatedBPDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF LATEST 3 YEARS</label>
                                                   <input type="file" id="auditedFinancial" name="auditedFinancial"><img id="auditedFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $auditedFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="auditedFinancialButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($auditedFinancial)){
                                                         echo '<button type="button" id="auditedFinancialUploadNew" class="auditedFinancialUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="auditedFinancialUploadNew" class="auditedFinancialUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="auditedFinancialShowOld" class="auditedFinancialShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="auditedFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($auditedFinancial, strrpos($auditedFinancial, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">AUDITED FINANCIAL STATEMENT </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="auditedFinancialSelect" name="auditedFinancialSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="auditedFinancialDesc" name="auditedFinancialDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"> PHOTOCOPY OF LATEST 3 YEARS</label>
                                                   <input type="file" id="inhouseFinancial" name="inhouseFinancial"><img id="inhouseFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $inhouseFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="inhouseFinancialButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($inhouseFinancial)){
                                                         echo '<button type="button" id="inhouseFinancialUploadNew" class="inhouseFinancialUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="inhouseFinancialUploadNew" class="inhouseFinancialUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="inhouseFinancialShowOld" class="inhouseFinancialShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="inhouseFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($inhouseFinancial, strrpos($inhouseFinancial, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">IN-HOUSE FINANCIAL STATEMENT </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="inhouseFinancialSelect" name="inhouseFinancialSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="inhouseFinancialDesc" name="inhouseFinancialDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF AT LEAST 6 MONTHS LATEST BANK STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PHOTOCOPY OF AT LEAST 6</label>
                                                   <input type="file" id="latestBank" name="latestBank"><img id="latestBankImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $latestBank; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestBankButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($latestBank)){
                                                         echo '<button type="button" id="latestBankUploadNew" class="latestBankUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="latestBankUploadNew" class="latestBankUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="latestBankShowOld" class="latestBankShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="latestBankDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestBank, strrpos($latestBank, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">MONTHS OF BUSINESS LATEST <br> BANK STATEMENT </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="latestBankSelect" name="latestBankSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="latestBankDesc" name="latestBankDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--INCOME TAX RETURN (IF APPLICABLE)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">INCOME TAX RETURN</label>
                                                   <input type="file" id="incomeTaxReturn" name="incomeTaxReturn"><img id="incomeTaxReturnImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $incomeTaxReturn; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxReturnButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($incomeTaxReturn)){
                                                         echo '<button type="button" id="incomeTaxReturnUploadNew" class="incomeTaxReturnUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="incomeTaxReturnUploadNew" class="incomeTaxReturnUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="incomeTaxReturnShowOld" class="incomeTaxReturnShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="incomeTaxReturnDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTaxReturn, strrpos($incomeTaxReturn, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">(IF APPLICABLE)</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="incomeTaxReturnSelect" name="incomeTaxReturnSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxReturnDesc" name="incomeTaxReturnDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--CONTRACT OF LEASE (IF RENTAL BUSINESS)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">CONTRACT OF LEASE</label>
                                                   <input type="file" id="contractLease" name="contractLease"><img id="contractLeaseImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $contractLease; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractLeaseButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($contractLease)){
                                                         echo '<button type="button" id="contractLeaseUploadNew" class="contractLeaseUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="contractLeaseUploadNew" class="contractLeaseUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="contractLeaseShowOld" class="contractLeaseShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="contractLeaseDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractLease, strrpos($contractLease, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="contractLeaseSelect" name="contractLeaseSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractLeaseDesc" name="contractLeaseDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- 5 CUSTOMERS WITH CONTACT NUMBER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">5 CUSTOMERS WITH CONTACT</label>
                                                   <input type="file" id="customerContact" name="customerContact"><img id="customerContactImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $customerContact; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerContactButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($customerContact)){
                                                         echo '<button type="button" id="customerContactUploadNew" class="customerContactUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="customerContactUploadNew" class="customerContactUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="customerContactShowOld" class="customerContactShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="customerContactDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerContact, strrpos($customerContact, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">NUMBER </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="customerContactSelect" name="customerContactSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerContactDesc" name="customerContactDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 5 SUPPLIERS WITH CONTACT NUMBER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">5 SUPPLIERS WITH CONTACT</label>
                                                   <input type="file" id="supplierContact" name="supplierContact"><img id="supplierContactImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $supplierContact; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="supplierContactButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($supplierContact)){
                                                         echo '<button type="button" id="supplierContactUploadNew" class="supplierContactUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="supplierContactUploadNew" class="supplierContactUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="supplierContactShowOld" class="supplierContactShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="supplierContactDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($supplierContact, strrpos($supplierContact, '/') + 1, 10); ?></label> 
                                                   <label class="corporation-label" id="tab-corporation" for="custom">NUMBER </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="supplierContactSelect" name="supplierContactSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="supplierContactDesc" name="supplierContactDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PROOF OF BILLING (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PROOF OF BILLING</label>
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
                                                   <label class="date-label" id="proofBillingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label" id="tab-corporation" for="custom">(IF APPLICABLE) </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="proofBillingSelect" name="proofBillingSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proofBillingDesc" name="proofBillingDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>

                                          <!-- FOR SPACE -->
                                          <div class="row">
                                             <div class="col-8"  style="height:2em; margin-bottom:-2%;"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 my-4"><br>
                                    <div class="row">
                                     <div class="col-8" style="border-right:0;">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc; width: 103%;">DOCUMENTS</h1>
                                       </div>
                                       <div class="col-4">
                                       <h1 class="text-secondary text-center" style="border-bottom: 1px solid #ccc;; width: 100%;">APPROVAL</h1>
                                       </div>
                                       </div>
                                       <div class="document-labels">
                                          <!-- FOR SPACE -->
                                          <div class="row">
                                             <div class="col-8" style="height:1em; margin-top:-0.5%"></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"><label style="font-size:120%"><u>DOCUMENT REPORTS AND CASHFLOW ANALYSIS</u></label></div>
                                             </div>
                                          </div>
                                       <!-- APPRAISAL FEE RECEIPT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">APPRAISAL FEE RECEIPT</label>
                                                   <input type="file" id="receipt" name="receipt"><img id="receiptImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $receipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="receiptButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($receipt)){
                                                         echo '<button type="button" id="receiptUploadNew" class="receiptUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="receiptUploadNew" class="receiptUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="receiptShowOld" class="receiptShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="receiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($receipt, strrpos($receipt, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="receiptSelect" name="receiptSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="receiptDesc" name="receiptDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">CREDIT INVESTIGATION AND</label>
                                                   <input type="file" id="creditInvestigationReportC" name="creditInvestigationReportC"><img id="creditInvestigationReportCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $creditInvestigationReportC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportCButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($creditInvestigationReportC)){
                                                         echo '<button type="button" id="creditInvestigationReportCUploadNew" class="creditInvestigationReportCUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="creditInvestigationReportCUploadNew" class="creditInvestigationReportCUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="creditInvestigationReportCShowOld" class="creditInvestigationReportCShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="creditInvestigationReportCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportC, strrpos($creditInvestigationReportC, '/') + 1, 10); ?></label>
                                                   <label class="corporation-label">CREDIT INVESTIGATION REPORT</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4 ">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="creditInvestigationReportCSelect" name="creditInvestigationReportCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="creditInvestigationReportCDesc" name="creditInvestigationReportCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">APPRAISE THE PROPERTY AND</label>
                                                   <input type="file" id="collateralAppraisalReportC" name="collateralAppraisalReportC"><img id="collateralAppraisalReportCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $collateralAppraisalReportC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="collateralAppraisalReportCButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($collateralAppraisalReportC)){
                                                         echo '<button type="button" id="collateralAppraisalReportCUploadNew" class="collateralAppraisalReportCUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="collateralAppraisalReportCUploadNew" class="collateralAppraisalReportCUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="collateralAppraisalReportCShowOld" class="collateralAppraisalReportCShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="collateralAppraisalReportCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($collateralAppraisalReportC, strrpos($collateralAppraisalReportC, '/') + 1, 10); ?></label> 
                                                   <label class="corporation-label">COLLATERAL APPRAISAL REPORT</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4 ">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="collateralAppraisalReportCSelect" name="collateralAppraisalReportCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="collateralAppraisalReportCDesc" name="collateralAppraisalReportCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREBOARD  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label">FINANCIAL EVALUATION</label>
                                                   <input type="file" id="financialEvaluationC" name="financialEvaluationC"><img id="financialEvaluationCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $financialEvaluationC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="financialEvaluationCButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($financialEvaluationC)){
                                                         echo '<button type="button" id="financialEvaluationCUploadNew" class="financialEvaluationCUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="financialEvaluationCUploadNew" class="financialEvaluationCUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="financialEvaluationCShowOld" class="financialEvaluationCShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="financialEvaluationCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($financialEvaluationC, strrpos($financialEvaluationC, '/') + 1, 10); ?></label> 
                                                   <label class="corporation-label">(CASHFLOW ANALYSIS) AND BRR SCOREBOARD</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="financialEvaluationCSelect" name="financialEvaluationCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="financialEvaluationCDesc" name="financialEvaluationCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>SIGNING OF APPROVAL</u> </label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LETTER OF APPROVAL -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                <label class="corporation-label">&#x2022; SIGNED LETTER OF APPROVAL </label>
                                                <input type="file" id="signedLetterC" name="signedLetterC"><img id="signedLetterCImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $signedLetterC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterCButton">Open File</button></a>
                                                <?php 
                                                   if(!empty($signedLetterC)){
                                                      echo '<button type="button" id="signedLetterCUploadNew" class="signedLetterCUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="signedLetterCUploadNew" class="signedLetterCUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="signedLetterCShowOld" class="signedLetterCShowOld">History</button>';
                                                ?>
                                                <label class="date-label" id="signedLetterCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterC, strrpos($signedLetterC, '/') + 1, 10); ?></label>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLetterCSelect" name="signedLetterCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterCDesc" name="signedLetterCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="endBuyerUnder" id="endBuyerUnder" style="display:none">
                                           <!-- SIGNED LETTER OF UNDERTAKING -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2 mt-3">
                                                      <label class="corporation-label">&#x2022; SIGNED LETTER OF UNDERTAKING </label>
                                                      <input type="file" id="signedLetterUnderEndC" name="signedLetterUnderEndC"><img id="signedLetterUnderEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedLetterUnderEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterUnderEndCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($signedLetterUnderEndC)){
                                                            echo '<button type="button" id="signedLetterUnderEndCUploadNew" class="signedLetterUnderEndCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="signedLetterUnderEndCUploadNew" class="signedLetterUnderEndCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="signedLetterUnderEndCShowOld" class="signedLetterUnderEndCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="signedLetterUnderEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterUnderEndC, strrpos($signedLetterUnderEndC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-3 mt-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLetterUnderEndCSelect" name="signedLetterUnderEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterUnderEndCDesc" name="signedLetterUnderEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><u>SIGNING OF THE LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE</u> </label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2 mb-2">
                                                   <label class="corporation-label">&#x2022; SIGNED LOAN APPROVAL MEMO </label>
                                                   <input type="file" id="signedLoanMemoC" class="signedLoanMemoC" name="signedLoanMemoC"><img id="signedLoanMemoCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLoanMemoC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLoanMemoCButton">Open File</button></a>
                                                   <label class="date-label" id="signedLoanMemoCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLoanMemoC, strrpos($signedLoanMemoC, '/') + 1, 10); ?></label>
                                                   <?php 
                                                      if(!empty($signedLoanMemoC)){
                                                         echo '<button type="button" id="signedLoanMemoCUploadNew" class="signedLoanMemoCUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="signedLoanMemoCUploadNew" class="signedLoanMemoCUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="signedLoanMemoCShowOld" class="signedLoanMemoCShowOld">History</button>';
                                                   ?>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLoanMemoCSelect" name="signedLoanMemoCSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLoanMemoCDesc" name="signedLoanMemoCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- Not End Buyer Section -->
                                          <div class="notEndBuyer" id="notEndBuyer" style="display:none;">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>SIGNING OF REM CONTRACT</u> </label></div>
                                                </div>
                                             </div>
                                              <!-- SIGNED REAL ESTATE MORTGAGE CONTRACT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; SIGNED REAL ESTATE</label>
                                                      <input type="file" id="remContractC" name="remContractC"><img id="remContractCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($remContractC)){
                                                            echo '<button type="button" id="remContractCUploadNew" class="remContractCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="remContractCUploadNew" class="remContractCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="remContractCShowOld" class="remContractCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="remContractCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractC, strrpos($remContractC, '/') + 1, 10); ?></label> 
                                                      <label class="corporation-label">&nbsp; MORTGAGE CONTRACT </label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractCSelect" name="remContractCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractCDesc" name="remContractCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>REGISTRATION IN REGISTRY OF DEEDS</u> </label></div>
                                                </div>
                                             </div>
                                             <!-- REM CONTRACT ANNOTATED -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; REM CONTRACT ANNOTATED</label>
                                                      <input type="file" id="remContractAnnotatedC" name="remContractAnnotatedC"><img id="remContractAnnotatedCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractAnnotatedC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractAnnotatedCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($remContractAnnotatedC)){
                                                            echo '<button type="button" id="remContractAnnotatedCUploadNew" class="remContractAnnotatedCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="remContractAnnotatedCUploadNew" class="remContractAnnotatedCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="remContractAnnotatedCShowOld" class="remContractAnnotatedCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="remContractAnnotatedCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractAnnotatedC, strrpos($remContractAnnotatedC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-1">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractAnnotatedCSelect" name="remContractAnnotatedCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractAnnotatedCDesc" name="remContractAnnotatedCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>DOCUMENTS AFTER THE RELEASE OF THE LOAN</u> </label></div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; PROMISSORY NOTE </label>
                                                      <input type="file" id="promNoteC" name="promNoteC"><img id="promNoteCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($promNoteC)){
                                                            echo '<button type="button" id="promNoteCUploadNew" class="promNoteCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="promNoteCUploadNew" class="promNoteCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="promNoteCShowOld" class="promNoteCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="promNoteCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteC, strrpos($promNoteC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="promNoteCSelect" name="promNoteCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteCDesc" name="promNoteCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; DISCLOSURE STATEMENT </label>
                                                      <input type="file" id="disclosureStateC" name="disclosureStateC"><img id="disclosureStateCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($disclosureStateC)){
                                                            echo '<button type="button" id="disclosureStateCUploadNew" class="disclosureStateCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="disclosureStateCUploadNew" class="disclosureStateCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="disclosureStateCShowOld" class="disclosureStateCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="disclosureStateCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateC, strrpos($disclosureStateC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="disclosureStateCSelect" name="disclosureStateCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateCDesc" name="disclosureStateCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- MRI FORM (COUNTRY BANKERS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; INSURANCE DOCUMENTS </label>
                                                      <input type="file" id="mriFormC" name="mriFormC"><img id="mriFormCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($mriFormC)){
                                                            echo '<button type="button" id="mriFormCUploadNew" class="mriFormCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="mriFormCUploadNew" class="mriFormCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="mriFormCShowOld" class="mriFormCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="mriFormCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormC, strrpos($mriFormC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="mriFormCSelect" name="mriFormCSelect" tabindex="-1">
                                                         <option selected value="NULL">Options</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS" id="mriFormCDesc" name="mriFormCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; AMORTIZATION SCHEDULE </label>
                                                      <input type="file" id="amortScheduleC" name="amortScheduleC"><img id="amortScheduleCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($amortScheduleC)){
                                                            echo '<button type="button" id="amortScheduleCUploadNew" class="amortScheduleCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="amortScheduleCUploadNew" class="amortScheduleCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="amortScheduleCShowOld" class="amortScheduleCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="amortScheduleCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleC, strrpos($amortScheduleC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="amortScheduleCSelect" name="amortScheduleCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="amortScheduleCDesc" name="amortScheduleCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="endBuyer" id="endBuyer" style="display:none;">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>SIGNING OF REM CONTRACT AND DOCUMENTS FOR LOAN RELEASES</u> </label></div>
                                                </div>
                                             </div>
                                              <!-- REAL ESTATE MORTGAGE CONTRACT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; REAL ESTATE MORTGAGE CONTRACT </label>
                                                      <input type="file" id="remContractEndC" name="remContractEndC"><img id="remContractEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractEndCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($remContractEndC)){
                                                            echo '<button type="button" id="remContractEndCUploadNew" class="remContractEndCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="remContractEndCUploadNew" class="remContractEndCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="remContractEndCShowOld" class="remContractEndCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="remContractEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractEndC, strrpos($remContractEndC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractEndCSelect" name="remContractEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractEndCDesc" name="remContractEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; PROMISSORY NOTE </label>
                                                      <input type="file" id="promNoteEndC" name="promNoteEndC"><img id="promNoteEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteEndCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($promNoteEndC)){
                                                            echo '<button type="button" id="promNoteEndCUploadNew" class="promNoteEndCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="promNoteEndCUploadNew" class="promNoteEndCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="promNoteEndCShowOld" class="promNoteEndCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="promNoteEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteEndC, strrpos($promNoteEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="promNoteEndCSelect" name="promNoteEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteEndCDesc" name="promNoteEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; DISCLOSURE STATEMENT</label>
                                                      <input type="file" id="disclosureStateEndC" name="disclosureStateEndC"><img id="disclosureStateEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateEndCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($disclosureStateEndC)){
                                                            echo '<button type="button" id="disclosureStateEndCUploadNew" class="disclosureStateEndCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="disclosureStateEndCUploadNew" class="disclosureStateEndCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="disclosureStateEndCShowOld" class="disclosureStateEndCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="disclosureStateEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateEndC, strrpos($disclosureStateEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="disclosureStateEndCSelect" name="disclosureStateEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateEndCDesc" name="disclosureStateEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- INSURANCE DOCUMENTS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; INSURANCE DOCUMENTS </label>
                                                      <input type="file" id="mriFormEndC" name="mriFormEndC"><img id="mriFormEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormEndCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($mriFormEndC)){
                                                            echo '<button type="button" id="mriFormEndCUploadNew" class="mriFormEndCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="mriFormEndCUploadNew" class="mriFormEndCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="mriFormEndCShowOld" class="mriFormEndCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="mriFormEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormEndC, strrpos($mriFormEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="mriFormEndCSelect" name="mriFormEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormEndCDesc" name="mriFormEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label">&#x2022; AMORTIZATION SCHEDULE </label>
                                                      <input type="file" id="amortScheduleEndC" name="amortScheduleEndC"><img id="amortScheduleEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleEndCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($amortScheduleEndC)){
                                                            echo '<button type="button" id="amortScheduleEndCUploadNew" class="amortScheduleEndCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="amortScheduleEndCUploadNew" class="amortScheduleEndCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="amortScheduleEndCShowOld" class="amortScheduleEndCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="amortScheduleEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleEndC, strrpos($amortScheduleEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="amortScheduleEndCSelect" name="amortScheduleEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleEndCDesc" name="amortScheduleEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- End buyer Section -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF DOCUMENTS TO SUNTRUST PROPERTIES INC. EXCHANGING TO DEED OF UNDERTAKING</u> </label></div>
                                                </div>
                                             </div>
                                              <!-- SIGNED DEED OF UNDERTAKING -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div>
                                                      <label class="corporation-label">&#x2022; SIGNED DEED OF UNDERTAKING </label>
                                                      <input type="file" id="signedDeedUnderEndC" name="signedDeedUnderEndC"><img id="signedDeedUnderEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedDeedUnderEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedDeedUnderEndCButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($signedDeedUnderEndC)){
                                                            echo '<button type="button" id="signedDeedUnderEndCUploadNew" class="signedDeedUnderEndCUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="signedDeedUnderEndCUploadNew" class="signedDeedUnderEndCUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="signedDeedUnderEndCShowOld" class="signedDeedUnderEndCShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="signedDeedUnderEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedDeedUnderEndC, strrpos($signedDeedUnderEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedDeedUnderEndCSelect" name="signedDeedUnderEndCSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedDeedUnderEndCDesc" name="signedDeedUnderEndCDesc" >&nbsp;
                                                   </div>
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
                                                      <label class ="corporation-label">&#x2022; LOAN UTILIZATION</label>
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
                                             <div class="row">
                                              <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><u>PRESENTATION DOCUMENTS</u></label></div>
                                              </div>
                                           </div>
                                           <!-- POWERPOINT CI AND APPRAISAL REPORT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="corporation-label">&#x2022; POWERPOINT CI AND</label>
                                                      <input type="file" id="powerpoint" name="powerpoint"><img id="powerpointImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $powerpoint; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="powerpointButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($powerpoint)){
                                                            echo '<button type="button" id="powerpointUploadNew" class="powerpointUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="powerpointUploadNew" class="powerpointUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="powerpointShowOld" class="powerpointShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="powerpointDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerpoint, strrpos($powerpoint, '/') + 1, 10); ?></label>
                                                      <label class ="corporation-label">&nbsp; APPRAISAL REPORT</label>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- EXCEL CASHFLOW ANALYSIS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="corporation-label">&#x2022; EXCEL CASHFLOW ANALYSIS  </label>
                                                      <input type="file" id="excel" name="excel"><img id="excelImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $excel; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="excelButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($excel)){
                                                            echo '<button type="button" id="excelUploadNew" class="excelUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="excelUploadNew" class="excelUploadNew" disabled>+</button>';
                                                         }
                                                         echo '<button type="button" id="excelShowOld" class="excelShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="excelDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($excel, strrpos($excel, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                             </div>
                                          <div class="row">
                                             <div class="col-8">
                                                 <div style="border-top: 1px solid #676464; width:104%; margin-left: -1.2em">
                                                <div class="py-1"><label style="font-size:120%"><u>OTHERS</u></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="OTHERS">
                                          <!-- SPECIAL POWER OF ATTORNEY (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="powerAttorneyCheck" name="powerAttorneyCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">SPECIAL POWER OF ATTORNEY </label>
                                                   <input type="file" id="powerAttorney" name="powerAttorney"><img id="powerAttorneyImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $powerAttorney; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="powerAttorneyButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($powerAttorney)){
                                                         echo '<button type="button" id="powerAttorneyUploadNew" class="powerAttorneyUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="powerAttorneyUploadNew" class="powerAttorneyUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="powerAttorneyShowOld" class="powerAttorneyShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="powerAttorneyDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerAttorney, strrpos($powerAttorney, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="powerAttorneySelect" name="powerAttorneySelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="powerAttorneyDesc" name="powerAttorneyDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CONTRACT TO SELL (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="contractSellCheck" name="contractSellCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">CONTRACT TO SELL </label>
                                                   <input type="file" id="contractSell" name="contractSell"><img id="contractSellImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $contractSell; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractSellButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($contractSell)){
                                                         echo '<button type="button" id="contractSellUploadNew" class="contractSellUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="contractSellUploadNew" class="contractSellUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="contractSellShowOld" class="contractSellShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="contractSellDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractSell, strrpos($contractSell, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="contractSellSelect" name="contractSellSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractSellDesc" name="contractSellDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- LETTER OF GUARANTEE (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="letterGuaranteeCheck" name="letterGuaranteeCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation">LETTER OF GUARANTEE</label> 
                                                   <input type="file" id="letterGuarantee" name="letterGuarantee"><img id="letterGuaranteeImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $letterGuarantee; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="letterGuaranteeButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($letterGuarantee)){
                                                         echo '<button type="button" id="letterGuaranteeUploadNew" class="letterGuaranteeUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="letterGuaranteeUploadNew" class="letterGuaranteeUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="letterGuaranteeShowOld" class="letterGuaranteeShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="letterGuaranteeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($letterGuarantee, strrpos($letterGuarantee, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "letterGuaranteeSelect" name = "letterGuaranteeSelect" tabindex="-1">
                                                      <option selected value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="letterGuaranteeDesc" name = "letterGuaranteeDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- STATEMENT OF ACCOUNT (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="statementAccountCheck" name="statementAccountCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">STATEMENT OF ACCOUNT</label>
                                                   <input type="file" id="statementAccount" name="statementAccount"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $statementAccount; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($statementAccount)){
                                                         echo '<button type="button" id="statementAccountUploadNew" class="statementAccountUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="statementAccountUploadNew" class="statementAccountUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="statementAccountShowOld" class="statementAccountShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="statementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccount, strrpos($statementAccount, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="statementAccountSelect" name="statementAccountSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="statementAccountDesc" name="statementAccountDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BILL/COST OF MATERIALS  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="billMaterialsCheck" name="billMaterialsCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">BILL/COST OF MATERIALS </label>
                                                   <input type="file" id="billMaterials" name="billMaterials"><img id="billMaterialsImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $billMaterials; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="billMaterialsButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($billMaterials)){
                                                         echo '<button type="button" id="billMaterialsUploadNew" class="billMaterialsUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="billMaterialsUploadNew" class="billMaterialsUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="billMaterialsShowOld" class="billMaterialsShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="billMaterialsDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($billMaterials, strrpos($billMaterials, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="billMaterialsSelect" name="billMaterialsSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="billMaterialsDesc" name="billMaterialsDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PROPOSED PERSPECTIVE PLAN -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="proposedPlanCheck" name="proposedPlanCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">PROPOSED PERSPECTIVE PLAN </label>
                                                   <input type="file" id="proposedPlan" name="proposedPlan"><img id="proposedPlanImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $proposedPlan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proposedPlanButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($proposedPlan)){
                                                         echo '<button type="button" id="proposedPlanUploadNew" class="proposedPlanUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="proposedPlanUploadNew" class="proposedPlanUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="proposedPlanShowOld" class="proposedPlanShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="proposedPlanDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proposedPlan, strrpos($proposedPlan, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="proposedPlanSelect" name="proposedPlanSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proposedPlanDesc" name="proposedPlanDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CIC -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="cicCheck" name="cicCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">CIC</label>
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
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="cicSelect" name="cicSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cicDesc" name="cicDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- NFIS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="nfisCheck" name="nfisCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom">NFIS</label>
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
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="nfisSelect" name="nfisSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="nfisDesc" name="nfisDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- OTHER DOCUMENTS-->
                                          <div class="row" style="margin-bottom:-1.7%; height:3em;">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="otherDocCheck" name="otherDocCheck">&nbsp;
                                                   <input type="text" class="corporation-label" id="editableLabel" name="edit1" placeholder="OTHERS (SUPPORTING DOCUMENTS)" value = "<?php echo $edit1 ;?>" style="font-weight: bold;" tabindex="-1">
                                                   <input type="file" id="otherDoc" name="otherDoc"><img id="otherDocImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $otherDoc; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherDocButton" >Open File</button></a>
                                                   <?php 
                                                      if(!empty($otherDoc)){
                                                         echo '<button type="button" id="otherDocUploadNew" class="otherDocUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="otherDocUploadNew" class="otherDocUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="otherDocShowOld" class="otherDocShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="otherDocDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherDoc, strrpos($otherDoc, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherDocSelect" name = "otherDocSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="otherDocDesc" name = "otherDocDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          </div>

                                           <!-- FOR SPACE END BUYER-->
                                          <div class="row">
                                              <div class="col-8" id="endBuyerSpace" style="margin-bottom:-2%; "></div>
                                           </div>
                                               <!-- FOR SPACE NOT END BUYER-->
                                          <div class="row">
                                              <div class="col-8" id= "notEndBuyerSpace" style="margin-bottom:-2%;"></div>

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


   <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
   <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->


   <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
   <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>
<!-- <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->

<script>
$(document).ready(function(){
   $(document).on('click', '.btnRelease', function(e){
      var btncorpId = $(this).val();
      // alert(btncorpId);
      var confirmMo = confirm("Please Confirm, You want to Release this Client?");
      if(confirmMo){
         $.ajax({
            url: 'pipeCorpUpd.php',
            type: 'POST',
            data: { btncorpId: btncorpId },
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

<script type="text/javascript">
function initializeDataTable(tableId, ajaxUrl, corpId) {
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
                     d.corpId = corpId;
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
   initializeDataTable('#oldFile', 'fetch_ca_endorsement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanAppFormCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_loanAppFormC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#companyProfileShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ccompanyProfile.php', '<?php echo $id; ?>');
});

$(document).on('click', '#governmentIdShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_governmentId.php', '<?php echo $id; ?>');
});

$(document).on('click', '#secRegistrationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_csecRegistration.php', '<?php echo $id; ?>');
});

$(document).on('click', '#latestGISShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_clatestGIS.php', '<?php echo $id; ?>');
});

$(document).on('click', '#copyBRSShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ccopyBRS.php', '<?php echo $id; ?>');
});

$(document).on('click', '#copyidCSTShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ccopyidCST.php', '<?php echo $id; ?>');
});

$(document).on('click', '#transferCertTitleShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ctransferCertTitle.php', '<?php echo $id; ?>');
});

$(document).on('click', '#taxDeclarationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ctaxDeclaration.php', '<?php echo $id; ?>');
});

$(document).on('click', '#taxDeclartionICTCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ctaxDeclartionICTC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#realStateReceiptShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_crealStateReceipt.php', '<?php echo $id; ?>');
});

$(document).on('click', '#realEstateTaxClearanceShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_crealEstateTaxClearance.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cdOfMorgageShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ccdOfMorgage.php', '<?php echo $id; ?>');
});

$(document).on('click', '#copyUpdatedBPShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ccopyUpdatedBP.php', '<?php echo $id; ?>');
});

$(document).on('click', '#auditedFinancialShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_cauditedFinancial.php', '<?php echo $id; ?>');
});

$(document).on('click', '#inhouseFinancialShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_cinhouseFinancial.php', '<?php echo $id; ?>');
});

$(document).on('click', '#latestBankShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_clatestBank.php', '<?php echo $id; ?>');
});

$(document).on('click', '#incomeTaxReturnShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_sa_amortScheduleS.php', '<?php echo $id; ?>');
});

$(document).on('click', '#contractLeaseShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_contractLease.php', '<?php echo $id; ?>');
});

$(document).on('click', '#customerContactShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_ccustomerContact.php', '<?php echo $id; ?>');
});

$(document).on('click', '#supplierContactShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_csupplierContact.php', '<?php echo $id; ?>');
});

$(document).on('click', '#proofBillingShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_cproofBilling.php', '<?php echo $id; ?>');
});

$(document).on('click', '#receiptShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_receipt.php', '<?php echo $id; ?>');
});

$(document).on('click', '#creditInvestigationReportCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_creditInvestigationReportC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#collateralAppraisalReportCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_collateralAppraisalReportC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#financialEvaluationCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_financialEvaluationC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedLetterCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_signedLetterC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedLetterUnderEndCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_signedLetterUnderEndC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedLoanMemoCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_signedLoanMemoC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#remContractCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_remContractC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#remContractAnnotatedCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_remContractAnnotatedC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#promNoteCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_promNoteC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#disclosureStateCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_disclosureStateC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#mriFormCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_mriFormC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortScheduleCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_amortScheduleC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#remContractEndCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_remContractEndC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#promNoteEndCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_promNoteEndC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#disclosureStateEndCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_disclosureStateEndC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#mriFormEndCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_mriFormEndC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortScheduleEndCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_amortScheduleEndC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedDeedUnderEndCShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_signedDeedUnderEndC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#utilizationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_utilization.php', '<?php echo $id; ?>');
});

$(document).on('click', '#powerpointShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_powerpoint.php', '<?php echo $id; ?>');
});

$(document).on('click', '#excelShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_excel.php', '<?php echo $id; ?>');
});

$(document).on('click', '#powerAttorneyShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_powerAttorney.php', '<?php echo $id; ?>');
});

$(document).on('click', '#contractSellShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_contractSell.php', '<?php echo $id; ?>');
});

$(document).on('click', '#letterGuaranteeShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_letterGuarantee.php', '<?php echo $id; ?>');
});

$(document).on('click', '#statementAccountShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_statementAccount.php', '<?php echo $id; ?>');
});

$(document).on('click', '#billMaterialsShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_billMaterials.php', '<?php echo $id; ?>');
});

$(document).on('click', '#proposedPlanShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_proposedPlan.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cicShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_cic.php', '<?php echo $id; ?>');
});

$(document).on('click', '#nfisShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_nfis.php', '<?php echo $id; ?>');
});

$(document).on('click', '#otherDocShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ca_otherDoc.php', '<?php echo $id; ?>');
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

$(document).on('click', '#loanAppFormCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#companyProfileShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#governmentIdShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#secRegistrationShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#latestGISShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#copyBRSShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#copyidCSTShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#transferCertTitleShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#taxDeclarationShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#taxDeclartionICTCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#realStateReceiptShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#realEstateTaxClearanceShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#cdOfMorgageShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#copyUpdatedBPShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#auditedFinancialShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#inhouseFinancialShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#latestBankShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#incomeTaxReturnShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#contractLeaseShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#customerContactShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#supplierContactShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#proofBillingShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#receiptShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#creditInvestigationReportCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#collateralAppraisalReportCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#financialEvaluationCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#signedLetterCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#signedLetterUnderEndCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#signedLoanMemoCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#remContractCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#remContractAnnotatedCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#promNoteCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#disclosureStateCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#mriFormCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#amortScheduleCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#remContractEndCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#promNoteEndCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#disclosureStateEndCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#mriFormEndCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#amortScheduleEndCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#signedDeedUnderEndCShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#utilizationShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#powerpointShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#excelShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#powerAttorneyShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#contractSellShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#letterGuaranteeShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#statementAccountShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#billMaterialsShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#proposedPlanShowOld', function(e){
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

$(document).on('click', '#otherDocShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

</script>

<script>
$(document).ready(function() {
  var remType = "<?php echo $remType; ?>";
  var sourceIncome = "<?php echo $sourceIncome; ?>";

  if (remType === "End Buyer") {
   document.getElementById("endBuyerSpace").style.height="4.9em";
  } else {
   document.getElementById("notEndBuyerSpace").style.height="2.2em";

  }
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

   $(document).on('change', '.signedLoanMemoC', function(e){
      e.preventDefault();
      var lam = $('.signedLoanMemoC').val();
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
        var corporationn = document.getElementById('corporation-form')
        var updaterForm = document.getElementById('updaterTerms-Form');
        var formData = new FormData(updaterForm);
        $.ajax({
            url: 'loanCorporationUpdater.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                alert('Updated Successfully!');
                corporationn.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
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


  function handleSelectChange(selectId, textField) {
    $('#' + selectId).on('change', function() {
      var selectedValue = $(this).val();

      if (selectedValue === "2") {

        document.getElementById(textField).style.visibility = 'visible';
      } else {
        document.getElementById(textField).style.visibility = 'hidden';
      }
    });
  }


// CORPORATION TEXT FIELD

// PRINCIPAL BORROWER
handleSelectChange('endorsementSelect', 'endorsementDesc');
handleSelectChange('loanAppFormCSelect', 'loanAppFormCDesc');
handleSelectChange('companyProfileSelect', 'companyProfileDesc');
handleSelectChange('governmentIdSelect', 'governmentIdDesc');
handleSelectChange('secRegistrationSelect', 'secRegistrationDesc');
handleSelectChange('latestGISSelect', 'latestGISDesc');
handleSelectChange('copyBRSSelect', 'copyBRSDesc');
handleSelectChange('copyidCSTSelect', 'copyidCSTDesc');
// COLLATERAL DOCUMENTS
handleSelectChange('transferCertTitleSelect', 'transferCertTitleDesc');
handleSelectChange('taxDeclarationSelect', 'taxDeclarationDesc');
handleSelectChange('taxDeclartionICTCSelect', 'taxDeclartionICTCDesc');
handleSelectChange('realStateReceiptSelect', 'realStateReceiptDesc');
handleSelectChange('realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
handleSelectChange('cdOfMorgageSelect', 'cdOfMorgageDesc');
handleSelectChange('copyUpdatedBPSelect', 'copyUpdatedBPDesc');
// BUSINESS PROOF OF INCOME
handleSelectChange('auditedFinancialSelect', 'auditedFinancialDesc');
handleSelectChange('inhouseFinancialSelect', 'inhouseFinancialDesc');
handleSelectChange('latestBankSelect', 'latestBankDesc');
handleSelectChange('incomeTaxReturnSelect', 'incomeTaxReturnDesc');
handleSelectChange('contractLeaseSelect', 'contractLeaseDesc');
handleSelectChange('customerContactSelect', 'customerContactDesc');
handleSelectChange('supplierContactSelect', 'supplierContactDesc');
handleSelectChange('proofBillingSelect', 'proofBillingDesc');
// OTHERS
handleSelectChange('powerAttorneySelect', 'powerAttorneyDesc');
handleSelectChange('contractSellSelect', 'contractSellDesc');
handleSelectChange('letterGuaranteeSelect', 'letterGuaranteeDesc');
handleSelectChange('statementAccountSelect', 'statementAccountDesc');
handleSelectChange('billMaterialsSelect', 'billMaterialsDesc');
handleSelectChange('proposedPlanSelect', 'proposedPlanDesc');
handleSelectChange('otherDocSelect', 'otherDocDesc');
handleSelectChange('cicSelect', 'cicDesc');
handleSelectChange('nfisSelect', 'nfisDesc');
// DOCUMENTS
handleSelectChange('receiptSelect', 'receiptDesc');
handleSelectChange('creditInvestigationReportCSelect', 'creditInvestigationReportCDesc');
handleSelectChange('collateralAppraisalReportCSelect', 'collateralAppraisalReportCDesc');
handleSelectChange('financialEvaluationCSelect', 'financialEvaluationCDesc');
handleSelectChange('signedLetterCSelect', 'signedLetterCDesc');
handleSelectChange('signedLetterUnderEndCSelect', 'signedLetterUnderEndCDesc');
handleSelectChange('signedLoanMemoCSelect', 'signedLoanMemoCDesc');
handleSelectChange('remContractCSelect', 'remContractCDesc');
handleSelectChange('remContractAnnotatedCSelect', 'remContractAnnotatedCDesc');
handleSelectChange('promNoteCSelect', 'promNoteCDesc');
handleSelectChange('disclosureStateCSelect', 'disclosureStateCDesc');
handleSelectChange('mriFormCSelect', 'mriFormCDesc');
handleSelectChange('amortScheduleCSelect', 'amortScheduleCDesc');
handleSelectChange('remContractEndCSelect', 'remContractEndCDesc');
handleSelectChange('promNoteEndCSelect', 'promNoteEndCDesc');
handleSelectChange('disclosureStateEndCSelect', 'disclosureStateEndCDesc');
handleSelectChange('mriFormEndCSelect', 'mriFormEndCDesc');
handleSelectChange('amortScheduleEndCSelect', 'amortScheduleEndCDesc');
handleSelectChange('signedDeedUnderEndCSelect', 'signedDeedUnderEndCDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');

</script>


<!-- Corporation Form -->
<script>
  var corpForm = document.getElementById("corporation-form");
  var corpId = "<?php echo $id; ?>";
  var fullname = "<?php echo $fullname; ?>";
  var salaryType = "<?php echo $type; ?>";
  var branch = "<?php echo $branch; ?>";
  var loanType = "<?php echo $loanType; ?>";
  var endPrompt = ""; // Global variable for remarks

  function uploadFileC() {
    var corpformData = new FormData(corpForm);
    corpformData.append('corpId', corpId);
    corpformData.append('fullname',fullname);
    corpformData.append('salaryType',salaryType);
    corpformData.append('branch',branch);
    corpformData.append('loanType',loanType);

    // Append the endPrompt to the FormData
    corpformData.append('endPrompt', endPrompt);

    $.ajax({
      url: 'loanCorporationUploadData.php',
      type: 'POST',
      data: corpformData,
      processData: false,
      contentType: false,
      success: function(response) {
// PRINCIPAL BORROWER
updateFileStatus('endorsement', 'endorsementImage');
updateFileStatus('loanAppFormC', 'loanAppFormCImage');
updateFileStatus('companyProfile', 'companyProfileImage');
updateFileStatus('governmentId', 'governmentIdImage');
updateFileStatus('secRegistration', 'secRegistrationImage');
updateFileStatus('latestGIS', 'latestGISImage');
updateFileStatus('copyBRS', 'copyBRSImage');
updateFileStatus('copyidCST', 'copyidCSTImage');
// COLLATERAL DOCUMENTS
updateFileStatus('transferCertTitle', 'transferCertTitleImage');
updateFileStatus('taxDeclaration', 'taxDeclarationImage');
updateFileStatus('taxDeclartionICTC', 'taxDeclartionICTCImage');
updateFileStatus('realStateReceipt', 'realStateReceiptImage');
updateFileStatus('realEstateTaxClearance', 'realEstateTaxClearanceImage');
updateFileStatus('cdOfMorgage', 'cdOfMorgageImage');
// BUSINESS PROOF OF INCOME
updateFileStatus('copyUpdatedBP', 'copyUpdatedBPImage');
updateFileStatus('auditedFinancial', 'auditedFinancialImage');
updateFileStatus('inhouseFinancial', 'inhouseFinancialImage');
updateFileStatus('latestBank', 'latestBankImage');
updateFileStatus('incomeTaxReturn', 'incomeTaxReturnImage');
updateFileStatus('contractLease', 'contractLeaseImage');
updateFileStatus('customerContact', 'customerContactImage');
updateFileStatus('supplierContact', 'supplierContactImage');
updateFileStatus('proofBilling', 'proofBillingImage');
// OTHERS
updateFileStatus('powerAttorney', 'powerAttorneyImage');
updateFileStatus('contractSell', 'contractSellImage');
updateFileStatus('letterGuarantee', 'letterGuaranteeImage');
updateFileStatus('statementAccount', 'statementAccountImage');
updateFileStatus('billMaterials', 'billMaterialsImage');
updateFileStatus('proposedPlan', 'proposedPlanImage');
updateFileStatus('cic', 'cicImage');
updateFileStatus('nfis', 'nfisImage');
updateFileStatus('otherDoc', 'otherDocImage');
// DOCUMENTS
updateFileStatus('receipt', 'receiptImage');
updateFileStatus('creditInvestigationReportC', 'creditInvestigationReportCImage');
updateFileStatus('collateralAppraisalReportC', 'collateralAppraisalReportCImage');
updateFileStatus('financialEvaluationC', 'financialEvaluationCImage');
updateFileStatus('signedLetterC', 'signedLetterCImage');
updateFileStatus('signedLetterUnderEndC', 'signedLetterUnderEndCImage');
updateFileStatus('signedLoanMemoC', 'signedLoanMemoCImage');
updateFileStatus('remContractC', 'remContractCImage');
updateFileStatus('remContractAnnotatedC', 'remContractAnnotatedCImage');
updateFileStatus('promNoteC', 'promNoteCImage');
updateFileStatus('disclosureStateC', 'disclosureStateCImage');
updateFileStatus('mriFormC', 'mriFormCImage');
updateFileStatus('amortScheduleC', 'amortScheduleCImage');
updateFileStatus('remContractEndC', 'remContractEndCImage');
updateFileStatus('promNoteEndC', 'promNoteEndCImage');
updateFileStatus('disclosureStateEndC', 'disclosureStateEndCImage');
updateFileStatus('mriFormEndC', 'mriFormEndCImage');
updateFileStatus('amortScheduleEndC', 'amortScheduleEndCImage');
updateFileStatus('signedDeedUnderEndC', 'signedDeedUnderEndCImage');
updateFileStatus('utilization', 'utilizationImage');
updateFileStatus('powerpoint', 'powerpointImage');
updateFileStatus('excel', 'excelImage');

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
        var corpId = "<?php echo $id; ?>";
        formData.append('endPrompt', endPrompt);  // Add remarks to the form data
        formData.append('corpId', corpId);

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
                        url: 'loanCorporationUploadData.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                           console.log("Server response:", response); // Log response for debugging
                           alert('Updated Successfully!');
                           isUploading = false;  // Reset flag after successful upload
                           if(inputSelector !== '#signedLoanMemoC'){
                              window.location.reload();
                           }
                           //  window.location.reload();
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
    $(document).on('click', '.loanAppFormCUploadNew', function(e){
         e.preventDefault();
        handleEndorsementUpload('#loanAppFormC');
    });

    //  for borrower_Lbp
    $(document).on('click', '.companyProfileUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#companyProfile');
    });

    // for borrower_Lpb
    $(document).on('click', '.governmentIdUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#governmentId');
    });

    //  for coborrowerStatement
    $(document).on('click', '.secRegistrationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#secRegistration');
    });

    //  for coBorrowerIdSign
    $(document).on('click', '.latestGISUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#latestGIS');
    });

      //  for ProofOfIncome
   $(document).on('click', '.copyBRSUploadNew', function(e){
      e.preventDefault();
      handleEndorsementUpload('#copyBRS');
    });


    //  for comakerStatement
    $(document).on('click', '.copyidCSTUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#copyidCST');
    });

    //  for coMakerIdWithSign
    $(document).on('click', '.transferCertTitleUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#transferCertTitle');
    });

    //  for latestPermit
    $(document).on('click', '.taxDeclarationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#taxDeclaration');
    });

    //  for coMakerPayslip
    $(document).on('click', '.taxDeclartionICTCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#taxDeclartionICTC');
    });

    //  for businessValidation
    $(document).on('click', '.realStateReceiptUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#realStateReceipt');
    });

     //  for loanInstallment
    $(document).on('click', '.realEstateTaxClearanceUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#realEstateTaxClearance');
    });

    //  for loanPayment
    $(document).on('click', '.cdOfMorgageUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#cdOfMorgage');
    });

    //  for statementAccount
    $(document).on('click', '.copyUpdatedBPUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#copyUpdatedBP');
    });

    //  for validCardReport
    $(document).on('click', '.auditedFinancialUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#auditedFinancial');
    });

    //  for creditReport
    $(document).on('click', '.inhouseFinancialUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#inhouseFinancial');
    });

    //  for creditInvestigationReportM
    $(document).on('click', '.latestBankUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#latestBank');
    });

    //  for debitWaiver
    $(document).on('click', '.incomeTaxReturnUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#incomeTaxReturn');
    });

    //  for affidavitSurrender
    $(document).on('click', '.contractLeaseUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#contractLease');
    });

    //  for loanApprovalSheet
    $(document).on('click', '.customerContactUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#customerContact');
    });

    //  for riskRating
    $(document).on('click', '.supplierContactUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#supplierContact');
    });

    //  for promissoryNoteM
    $(document).on('click', '.proofBillingUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#proofBilling');
    });

    //  for disclosureStateM
    $(document).on('click', '.receiptUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#receipt');
    });

    $(document).on('click', '.creditInvestigationReportCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#creditInvestigationReportC');
    });

    $(document).on('click', '.collateralAppraisalReportCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#collateralAppraisalReportC');
    });

    $(document).on('click', '.financialEvaluationCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#financialEvaluationC');
    });

    $(document).on('click', '.signedLetterCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedLetterC');
    });

    $(document).on('click', '.signedLetterUnderEndCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedLetterUnderEndC');
    });

    $(document).on('click', '.signedLoanMemoCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedLoanMemoC');
    });

    $(document).on('click', '.remContractCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#remContractC');
    });

    $(document).on('click', '.remContractAnnotatedCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#remContractAnnotatedC');
    });

    $(document).on('click', '.promNoteCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#promNoteC');
    });

    $(document).on('click', '.disclosureStateCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#disclosureStateC');
    });

    $(document).on('click', '.mriFormCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#mriFormC');
    });

    $(document).on('click', '.amortScheduleCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#amortScheduleC');
    });

    $(document).on('click', '.remContractEndCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#remContractEndC');
    });

    $(document).on('click', '.promNoteEndCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#promNoteEndC');
    });

    $(document).on('click', '.disclosureStateEndCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#disclosureStateEndC');
    });

    $(document).on('click', '.mriFormEndCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#mriFormEndC');
    });

    $(document).on('click', '.amortScheduleEndCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#amortScheduleEndC');
    });

    $(document).on('click', '.signedDeedUnderEndCUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedDeedUnderEndC');
    });

    $(document).on('click', '.utilizationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#utilization');
    });

    $(document).on('click', '.powerpointUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#powerpoint');
    });

    $(document).on('click', '.excelUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#excel');
    });

    $(document).on('click', '.powerAttorneyUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#powerAttorney');
    });

    $(document).on('click', '.contractSellUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#contractSell');
    });

    $(document).on('click', '.letterGuaranteeUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#letterGuarantee');
    });

    $(document).on('click', '.statementAccountUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#statementAccount');
    });

    $(document).on('click', '.billMaterialsUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#billMaterials');
    });

    $(document).on('click', '.proposedPlanUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#proposedPlan');
    });

      $(document).on('click', '.cicUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#cic');
    });
   $(document).on('click', '.nfisUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#nfis');
    });

    $(document).on('click', '.otherDocUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#otherDoc');
    });

    corpForm.addEventListener("change", function() {
      uploadFileC();
   });
</script>


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
// PUTTING THE VALUE TO SELECTION AND TEXTFIELD 
// PRINCIPAL BORROWER
selectOptionBasedOnValue('<?php echo $endorsementSelect; ?>', 'endorsementSelect','endorsementDesc');
selectOptionBasedOnValue('<?php echo $loanAppFormCSelect; ?>', 'loanAppFormCSelect','loanAppFormCDesc');
selectOptionBasedOnValue('<?php echo $companyProfileSelect; ?>', 'companyProfileSelect','companyProfileDesc');
selectOptionBasedOnValue('<?php echo $governmentIdSelect; ?>', 'governmentIdSelect','governmentIdDesc');
selectOptionBasedOnValue('<?php echo $secRegistrationSelect; ?>', 'secRegistrationSelect','secRegistrationDesc');
selectOptionBasedOnValue('<?php echo $latestGISSelect; ?>', 'latestGISSelect','latestGISDesc');
selectOptionBasedOnValue('<?php echo $copyBRSSelect; ?>', 'copyBRSSelect','copyBRSDesc');
selectOptionBasedOnValue('<?php echo $copyidCSTSelect; ?>', 'copyidCSTSelect','copyidCSTDesc');
// COLLATERAL DOCUMENTS
selectOptionBasedOnValue('<?php echo $transferCertTitleSelect; ?>', 'transferCertTitleSelect','transferCertTitleDesc');
selectOptionBasedOnValue('<?php echo $taxDeclarationSelect; ?>', 'taxDeclarationSelect','taxDeclarationDesc');
selectOptionBasedOnValue('<?php echo $taxDeclartionICTCSelect; ?>', 'taxDeclartionICTCSelect','taxDeclartionICTCDesc');
selectOptionBasedOnValue('<?php echo $realStateReceiptSelect; ?>', 'realStateReceiptSelect','realStateReceiptDesc');
selectOptionBasedOnValue('<?php echo $realEstateTaxClearanceSelect; ?>', 'realEstateTaxClearanceSelect','realEstateTaxClearanceDesc');
selectOptionBasedOnValue('<?php echo $cdOfMorgageSelect; ?>', 'cdOfMorgageSelect','cdOfMorgageDesc');
selectOptionBasedOnValue('<?php echo $copyUpdatedBPSelect; ?>', 'copyUpdatedBPSelect','copyUpdatedBPDesc');
// BUSINESS PROOF OF INCOME
selectOptionBasedOnValue('<?php echo $auditedFinancialSelect; ?>', 'auditedFinancialSelect','auditedFinancialDesc');
selectOptionBasedOnValue('<?php echo $inhouseFinancialSelect; ?>', 'inhouseFinancialSelect','inhouseFinancialDesc');
selectOptionBasedOnValue('<?php echo $latestBankSelect; ?>', 'latestBankSelect','latestBankDesc');
selectOptionBasedOnValue('<?php echo $incomeTaxReturnSelect; ?>', 'incomeTaxReturnSelect','incomeTaxReturnDesc');
selectOptionBasedOnValue('<?php echo $contractLeaseSelect; ?>', 'contractLeaseSelect','contractLeaseDesc');
selectOptionBasedOnValue('<?php echo $customerContactSelect; ?>', 'customerContactSelect','customerContactDesc');
selectOptionBasedOnValue('<?php echo $supplierContactSelect; ?>', 'supplierContactSelect','supplierContactDesc');
selectOptionBasedOnValue('<?php echo $proofBillingSelect; ?>', 'proofBillingSelect','proofBillingDesc');
// OTHERS
selectOptionBasedOnValue('<?php echo $powerAttorneySelect; ?>', 'powerAttorneySelect','powerAttorneyDesc');
selectOptionBasedOnValue('<?php echo $contractSellSelect; ?>', 'contractSellSelect','contractSellDesc');
selectOptionBasedOnValue('<?php echo $letterGuaranteeSelect; ?>', 'letterGuaranteeSelect','letterGuaranteeDesc');
selectOptionBasedOnValue('<?php echo $statementAccountSelect; ?>', 'statementAccountSelect','statementAccountDesc');
selectOptionBasedOnValue('<?php echo $billMaterialsSelect; ?>', 'billMaterialsSelect','billMaterialsDesc');
selectOptionBasedOnValue('<?php echo $proposedPlanSelect; ?>', 'proposedPlanSelect','proposedPlanDesc');
selectOptionBasedOnValue('<?php echo $cicSelect; ?>', 'cicSelect','cicDesc');
selectOptionBasedOnValue('<?php echo $nfisSelect; ?>', 'nfisSelect','nfisDesc');
selectOptionBasedOnValue('<?php echo $otherDocSelect; ?>', 'otherDocSelect','otherDocDesc');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo $receiptSelect; ?>', 'receiptSelect','receiptDesc');
selectOptionBasedOnValue('<?php echo $creditInvestigationReportCSelect; ?>', 'creditInvestigationReportCSelect','creditInvestigationReportCDesc');
selectOptionBasedOnValue('<?php echo $collateralAppraisalReportCSelect; ?>', 'collateralAppraisalReportCSelect','collateralAppraisalReportCDesc');
selectOptionBasedOnValue('<?php echo $financialEvaluationCSelect; ?>', 'financialEvaluationCSelect','financialEvaluationCDesc');
selectOptionBasedOnValue('<?php echo $signedLetterCSelect; ?>', 'signedLetterCSelect','signedLetterCDesc');
selectOptionBasedOnValue('<?php echo $signedLetterUnderEndCSelect; ?>', 'signedLetterUnderEndCSelect','signedLetterUnderEndCDesc');
selectOptionBasedOnValue('<?php echo $signedLoanMemoCSelect; ?>', 'signedLoanMemoCSelect','signedLoanMemoCDesc');
selectOptionBasedOnValue('<?php echo $remContractCSelect; ?>', 'remContractCSelect','remContractCDesc');
selectOptionBasedOnValue('<?php echo $remContractAnnotatedCSelect; ?>', 'remContractAnnotatedCSelect','remContractAnnotatedCDesc');
selectOptionBasedOnValue('<?php echo $promNoteCSelect; ?>', 'promNoteCSelect','promNoteCDesc');
selectOptionBasedOnValue('<?php echo $disclosureStateCSelect; ?>', 'disclosureStateCSelect','disclosureStateCDesc');
selectOptionBasedOnValue('<?php echo $mriFormCSelect; ?>', 'mriFormCSelect','mriFormCDesc');
selectOptionBasedOnValue('<?php echo $amortScheduleCSelect; ?>', 'amortScheduleCSelect','amortScheduleCDesc');
selectOptionBasedOnValue('<?php echo $remContractEndCSelect; ?>', 'remContractEndCSelect','remContractEndCDesc');
selectOptionBasedOnValue('<?php echo $promNoteEndCSelect; ?>', 'promNoteEndCSelect','promNoteEndCDesc');
selectOptionBasedOnValue('<?php echo $disclosureStateEndCSelect; ?>', 'disclosureStateEndCSelect','disclosureStateEndCDesc');
selectOptionBasedOnValue('<?php echo $mriFormEndCSelect; ?>', 'mriFormEndCSelect','mriFormEndCDesc');
selectOptionBasedOnValue('<?php echo $amortScheduleEndCSelect; ?>', 'amortScheduleEndCSelect','amortScheduleEndCDesc');
selectOptionBasedOnValue('<?php echo $signedDeedUnderEndCSelect; ?>', 'signedDeedUnderEndCSelect','signedDeedUnderEndCDesc');
selectOptionBasedOnValue('<?php echo $utilizationSelect; ?>', 'utilizationSelect','utilizationDesc');
</script>

<script>
$(document).ready(function() {
  var remType= "<?php echo $remType; ?>";
   if(remType=="End Buyer"){
      document.getElementById('endBuyer').style.display="inline";
      document.getElementById('endBuyerUnder').style.display="inline";
      document.getElementById('endBuyerUnderSelect').style.display="inline";
   }else{
      document.getElementById('notEndBuyer').style.display="inline";
      document.getElementById('notEndBuyerSelect').style.display="inline";
      document.getElementById('endBuyerUnder').style.display="none";
      document.getElementById('endBuyerUnderSelect').style.display="none";
   }
});
</script>

<script>
function initializeCheckboxes() {  
  var powerAttorneyIValue = "<?php echo $powerAttorneyICheck; ?>";
  var contractSellValue = "<?php echo $contractSellCheck; ?>";
  var letterGuaranteeValue = "<?php echo $letterGuaranteeCheck; ?>";
  var statementAccountValue = "<?php echo $statementAccountCheck; ?>";
  var billMaterialsValue = "<?php echo $billMaterialsCheck; ?>";
  var proposedPlanValue = "<?php echo $proposedPlanCheck; ?>";
  var cicValue = "<?php echo $cicCheck; ?>";
  var nfisValue = "<?php echo $nfisCheck; ?>";
  var otherDocValue = "<?php echo $otherDocCheck; ?>";
  // Get the checkbox elements
  const powerAttorneyICheck = document.getElementById('powerAttorneyCheck');
  const contractSellCheck = document.getElementById('contractSellCheck');
  const letterGuaranteeCheck = document.getElementById('letterGuaranteeCheck');
  const statementAccountCheck = document.getElementById('statementAccountCheck');
  const billMaterialsCheck = document.getElementById('billMaterialsCheck');
  const proposedPlanCheck = document.getElementById('proposedPlanCheck');
  const cicCheck = document.getElementById('cicCheck');
  const nfisCheck = document.getElementById('nfisCheck');
  const otherDocCheck = document.getElementById('otherDocCheck')

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
showInput(powerAttorneyIValue, powerAttorneyICheck,'powerAttorney', 'powerAttorneySelect', 'powerAttorneyDesc',`powerAttorneyImage`);
showInput(contractSellValue, contractSellCheck,'contractSell', 'contractSellSelect', 'contractSellDesc',`contractSellImage`);
showInput(letterGuaranteeValue, letterGuaranteeCheck, 'letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc',`letterGuaranteeImage`);
showInput(statementAccountValue, statementAccountCheck,'statementAccount', 'statementAccountSelect', 'statementAccountDesc',`statementAccountImage`);
showInput(billMaterialsValue, billMaterialsCheck,'billMaterials', 'billMaterialsSelect', 'billMaterialsDesc',`billMaterialsImage`);
showInput(proposedPlanValue, proposedPlanCheck,'proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc',`proposedPlanImage`);
showInput(cicValue, cicCheck,'cic', 'cicSelect', 'cicDesc',`cicImage`);
showInput(nfisValue, nfisCheck, 'nfis', 'nfisSelect', 'nfisDesc', `nfisImage`);
showInput(otherDocValue, otherDocCheck,'otherDoc', 'otherDocSelect', 'otherDocDesc',`otherDocImage`);
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

document.getElementById("powerAttorneyCheck").addEventListener("click", function() {
    toggleVisibility('powerAttorney');
});

document.getElementById("contractSellCheck").addEventListener("click", function() {
    toggleVisibility('contractSell');
});
document.getElementById("letterGuaranteeCheck").addEventListener("click", function() {
    toggleVisibility('letterGuarantee');
});

document.getElementById("statementAccountCheck").addEventListener("click", function() {
    toggleVisibility('statementAccount');
});

document.getElementById("billMaterialsCheck").addEventListener("click", function() {
    toggleVisibility('billMaterials');
});

document.getElementById("proposedPlanCheck").addEventListener("click", function() {
    toggleVisibility('proposedPlan');
});

document.getElementById("cicCheck").addEventListener("click", function() {
    toggleVisibility('cic');
});

document.getElementById("nfisCheck").addEventListener("click", function() {
    toggleVisibility('nfis');
});

document.getElementById("otherDocCheck").addEventListener("click", function() {
    toggleVisibility('otherDoc');

});
</script>
<script>
   // RESET THE VALUE OF SELECT TO ZERO(OPTION)
  function resetIndex(targetId,targetSelect,targetDesc){
  document.getElementById(targetId).addEventListener('change', function() {
  var selectElement = document.getElementById(targetSelect,"loanAppFormCDate");
  selectElement.selectedIndex = 0;
  document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
  });
  }
// PRINCIPAL BORROWER
resetIndex('endorsement', 'endorsementSelect', 'endorsementDesc');
resetIndex('loanAppFormC', 'loanAppFormCSelect', 'loanAppFormCDesc');
resetIndex('companyProfile', 'companyProfileSelect', 'companyProfileDesc');
resetIndex('governmentId', 'governmentIdSelect', 'governmentIdDesc');
resetIndex('secRegistration', 'secRegistrationSelect', 'secRegistrationDesc');
resetIndex('latestGIS', 'latestGISSelect', 'latestGISDesc');
resetIndex('copyBRS', 'copyBRSSelect', 'copyBRSDesc');
resetIndex('copyidCST', 'copyidCSTSelect', 'copyidCSTDesc');
// COLLATERAL DOCUMENTS
resetIndex('transferCertTitle', 'transferCertTitleSelect', 'transferCertTitleDesc');
resetIndex('taxDeclaration', 'taxDeclarationSelect', 'taxDeclarationDesc');
resetIndex('taxDeclartionICTC', 'taxDeclartionICTCSelect', 'taxDeclartionICTCDesc');
resetIndex('realStateReceipt', 'realStateReceiptSelect', 'realStateReceiptDesc');
resetIndex('realEstateTaxClearance', 'realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
resetIndex('cdOfMorgage', 'cdOfMorgageSelect', 'cdOfMorgageDesc');
// BUSINESS PROOF OF INCOME
resetIndex('copyUpdatedBP', 'copyUpdatedBPSelect', 'copyUpdatedBPDesc');
resetIndex('auditedFinancial', 'auditedFinancialSelect', 'auditedFinancialDesc');
resetIndex('inhouseFinancial', 'inhouseFinancialSelect', 'inhouseFinancialDesc');
resetIndex('latestBank', 'latestBankSelect', 'latestBankDesc');
resetIndex('incomeTaxReturn', 'incomeTaxReturnSelect', 'incomeTaxReturnDesc');
resetIndex('contractLease', 'contractLeaseSelect', 'contractLeaseDesc');
resetIndex('customerContact', 'customerContactSelect', 'customerContactDesc');
resetIndex('supplierContact', 'supplierContactSelect', 'supplierContactDesc');
resetIndex('proofBilling', 'proofBillingSelect', 'proofBillingDesc');
// OTHERS
resetIndex('powerAttorney', 'powerAttorneySelect', 'powerAttorneyDesc');
resetIndex('contractSell', 'contractSellSelect', 'contractSellDesc');
resetIndex('letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc');
resetIndex('statementAccount', 'statementAccountSelect', 'statementAccountDesc');
resetIndex('billMaterials', 'billMaterialsSelect', 'billMaterialsDesc');
resetIndex('proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc');
resetIndex('cic', 'cicSelect', 'cicDesc');
resetIndex('nfis', 'nfisSelect', 'nfisDesc');
resetIndex('otherDoc', 'otherDocSelect', 'otherDocDesc');
// DOCUMENTS
resetIndex('receipt', 'receiptSelect', 'receiptDesc');
resetIndex('creditInvestigationReportC', 'creditInvestigationReportCSelect', 'creditInvestigationReportCDesc');
resetIndex('collateralAppraisalReportC', 'collateralAppraisalReportCSelect', 'collateralAppraisalReportCDesc');
resetIndex('financialEvaluationC', 'financialEvaluationCSelect', 'financialEvaluationCDesc');
resetIndex('signedLetterC', 'signedLetterCSelect', 'signedLetterCDesc');
resetIndex('signedLoanMemoC', 'signedLoanMemoCSelect', 'signedLoanMemoCDesc');
resetIndex('remContractC', 'remContractCSelect', 'remContractCDesc');
resetIndex('promNoteC', 'promNoteCSelect', 'promNoteCDesc');
resetIndex('disclosureStateC', 'disclosureStateCSelect', 'disclosureStateCDesc');
resetIndex('mriFormC', 'mriFormCSelect', 'mriFormCDesc');
resetIndex('remContractAnnotatedC', 'remContractAnnotatedCSelect', 'remContractAnnotatedCDesc');
resetIndex('signedLetterUnderEndC', 'signedLetterUnderEndCSelect', 'signedLetterUnderEndCDesc');
resetIndex('remContractEndC', 'remContractEndCSelect', 'remContractEndCDesc');
resetIndex('promNoteEndC', 'promNoteEndCSelect', 'promNoteEndCDesc');
resetIndex('disclosureStateEndC', 'disclosureStateEndCSelect', 'disclosureStateEndCDesc');
resetIndex('mriFormEndC', 'mriFormEndCSelect', 'mriFormEndCDesc');
resetIndex('signedDeedUnderEndC', 'signedDeedUnderEndCSelect', 'signedDeedUnderEndCDesc');
resetIndex('amortScheduleC', 'amortScheduleCSelect', 'amortScheduleCDesc');
resetIndex('amortScheduleEndC', 'amortScheduleEndCSelect', 'amortScheduleEndCDesc');
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
         if(select.split('--')[0] == "1"){
            document.getElementById(check).style.visibility = "visible";
         }
      }

   }
// PRINCIPAL BORROWER
setFileVisibility("<?php echo $endorsement; ?>", "<?php echo $endorsementSelect; ?>", 'endorsement', 'endorsementImage', 'endorsementButton', 'endorsementDate');
setFileVisibility("<?php echo $loanAppFormC; ?>", "<?php echo $loanAppFormCSelect; ?>", 'loanAppFormC', 'loanAppFormCImage', 'loanAppFormCButton', 'loanAppFormCDate');
setFileVisibility("<?php echo $companyProfile; ?>", "<?php echo $companyProfileSelect; ?>", 'companyProfile', 'companyProfileImage', 'companyProfileButton', 'companyProfileDate');
setFileVisibility("<?php echo $governmentId; ?>", "<?php echo $governmentIdSelect; ?>", 'governmentId', 'governmentIdImage', 'governmentIdButton', 'governmentIdDate');
setFileVisibility("<?php echo $secRegistration; ?>", "<?php echo $secRegistrationSelect; ?>", 'secRegistration', 'secRegistrationImage', 'secRegistrationButton', 'secRegistrationDate');
setFileVisibility("<?php echo $latestGIS; ?>", "<?php echo $latestGISSelect; ?>", 'latestGIS', 'latestGISImage', 'latestGISButton', 'latestGISDate');
setFileVisibility("<?php echo $copyBRS; ?>", "<?php echo $copyBRSSelect; ?>", 'copyBRS', 'copyBRSImage', 'copyBRSButton', 'copyBRSDate');
setFileVisibility("<?php echo $copyidCST; ?>", "<?php echo $copyidCSTSelect; ?>", 'copyidCST', 'copyidCSTImage', 'copyidCSTButton', 'copyidCSTDate');
// COLLATERAL DICUMENTS
setFileVisibility("<?php echo $transferCertTitle; ?>", "<?php echo $transferCertTitleSelect; ?>", 'transferCertTitle', 'transferCertTitleImage', 'transferCertTitleButton', 'transferCertTitleDate');
setFileVisibility("<?php echo $taxDeclaration; ?>", "<?php echo $taxDeclarationSelect; ?>", 'taxDeclaration', 'taxDeclarationImage', 'taxDeclarationButton', 'taxDeclarationDate');
setFileVisibility("<?php echo $taxDeclartionICTC; ?>", "<?php echo $taxDeclartionICTCSelect; ?>", 'taxDeclartionICTC', 'taxDeclartionICTCImage', 'taxDeclartionICTCButton', 'taxDeclartionICTCDate');
setFileVisibility("<?php echo $realStateReceipt; ?>", "<?php echo $realStateReceiptSelect; ?>", 'realStateReceipt', 'realStateReceiptImage', 'realStateReceiptButton', 'realStateReceiptDate');
setFileVisibility("<?php echo $realEstateTaxClearance; ?>", "<?php echo $realEstateTaxClearanceSelect; ?>", 'realEstateTaxClearance', 'realEstateTaxClearanceImage', 'realEstateTaxClearanceButton', 'realEstateTaxClearanceDate');
setFileVisibility("<?php echo $cdOfMorgage; ?>", "<?php echo $cdOfMorgageSelect; ?>", 'cdOfMorgage', 'cdOfMorgageImage', 'cdOfMorgageButton', 'cdOfMorgageDate');
// BUSINESS PROOF OF INCOME
setFileVisibility("<?php echo $copyUpdatedBP; ?>", "<?php echo $copyUpdatedBPSelect; ?>", 'copyUpdatedBP', 'copyUpdatedBPImage', 'copyUpdatedBPButton', 'copyUpdatedBPDate');
setFileVisibility("<?php echo $auditedFinancial; ?>", "<?php echo $auditedFinancialSelect; ?>", 'auditedFinancial', 'auditedFinancialImage', 'auditedFinancialButton', 'auditedFinancialDate');
setFileVisibility("<?php echo $inhouseFinancial; ?>", "<?php echo $inhouseFinancialSelect; ?>", 'inhouseFinancial', 'inhouseFinancialImage', 'inhouseFinancialButton', 'inhouseFinancialDate');
setFileVisibility("<?php echo $latestBank; ?>", "<?php echo $latestBankSelect; ?>", 'latestBank', 'latestBankImage', 'latestBankButton', 'latestBankDate');
setFileVisibility("<?php echo $incomeTaxReturn; ?>", "<?php echo $incomeTaxReturnSelect; ?>", 'incomeTaxReturn', 'incomeTaxReturnImage', 'incomeTaxReturnButton', 'incomeTaxReturnDate');
setFileVisibility("<?php echo $contractLease; ?>", "<?php echo $contractLeaseSelect; ?>", 'contractLease', 'contractLeaseImage', 'contractLeaseButton', 'contractLeaseDate');
setFileVisibility("<?php echo $customerContact; ?>", "<?php echo $customerContactSelect; ?>", 'customerContact', 'customerContactImage', 'customerContactButton', 'customerContactDate');
setFileVisibility("<?php echo $supplierContact; ?>", "<?php echo $supplierContactSelect; ?>", 'supplierContact', 'supplierContactImage', 'supplierContactButton', 'supplierContactDate');
setFileVisibility("<?php echo $proofBilling; ?>", "<?php echo $proofBillingSelect; ?>", 'proofBilling', 'proofBillingImage', 'proofBillingButton', 'proofBillingDate');
// OTHERS
setFileVisibility("<?php echo $powerAttorney; ?>", "<?php echo $powerAttorneySelect; ?>", 'powerAttorney', 'powerAttorneyImage', 'powerAttorneyButton', 'powerAttorneyDate');
setFileVisibility("<?php echo $contractSell; ?>", "<?php echo $contractSellSelect; ?>", 'contractSell', 'contractSellImage', 'contractSellButton', 'contractSellDate');
setFileVisibility("<?php echo $letterGuarantee; ?>", "<?php echo $letterGuaranteeSelect; ?>", 'letterGuarantee', 'letterGuaranteeImage', 'letterGuaranteeButton', 'letterGuaranteeDate');
setFileVisibility("<?php echo $statementAccount; ?>", "<?php echo $statementAccountSelect; ?>", 'statementAccount', 'statementAccountImage', 'statementAccountButton', 'statementAccountDate');
setFileVisibility("<?php echo $billMaterials; ?>", "<?php echo $billMaterialsSelect; ?>", 'billMaterials', 'billMaterialsImage', 'billMaterialsButton', 'billMaterialsDate');
setFileVisibility("<?php echo $proposedPlan; ?>", "<?php echo $proposedPlanSelect; ?>", 'proposedPlan', 'proposedPlanImage', 'proposedPlanButton', 'proposedPlanDate');
setFileVisibility("<?php echo $cic; ?>", "<?php echo $cicSelect; ?>", 'cic', 'cicImage', 'cicButton', 'cicDate');
setFileVisibility("<?php echo $nfis; ?>", "<?php echo $nfisSelect; ?>", 'nfis', 'nfisImage', 'nfisButton', 'nfisDate');
setFileVisibility("<?php echo $otherDoc; ?>", "<?php echo $otherDocSelect; ?>", 'otherDoc', 'otherDocImage', 'otherDocButton', 'otherDocDate');
// DOCUMENTS
setFileVisibility("<?php echo $receipt; ?>", "<?php echo $receiptSelect; ?>", 'receipt', 'receiptImage', 'receiptButton', 'receiptDate');
setFileVisibility("<?php echo $creditInvestigationReportC; ?>", "<?php echo $creditInvestigationReportCSelect; ?>", 'creditInvestigationReportC', 'creditInvestigationReportCImage', 'creditInvestigationReportCButton', 'creditInvestigationReportCDate');
setFileVisibility("<?php echo $collateralAppraisalReportC; ?>", "<?php echo $collateralAppraisalReportCSelect; ?>", 'collateralAppraisalReportC', 'collateralAppraisalReportCImage', 'collateralAppraisalReportCButton', 'collateralAppraisalReportCDate');
setFileVisibility("<?php echo $financialEvaluationC; ?>", "<?php echo $financialEvaluationCSelect; ?>", 'financialEvaluationC', 'financialEvaluationCImage', 'financialEvaluationCButton', 'financialEvaluationCDate');
setFileVisibility("<?php echo $signedLetterC; ?>", "<?php echo $signedLetterCSelect; ?>", 'signedLetterC', 'signedLetterCImage', 'signedLetterCButton', 'signedLetterCDate');
setFileVisibility("<?php echo $signedLetterUnderEndC; ?>", "<?php echo $signedLetterUnderEndCSelect; ?>", 'signedLetterUnderEndC', 'signedLetterUnderEndCImage', 'signedLetterUnderEndCButton', 'signedLetterUnderEndCDate');
setFileVisibility("<?php echo $signedLoanMemoC; ?>", "<?php echo $signedLoanMemoCSelect; ?>", 'signedLoanMemoC', 'signedLoanMemoCImage', 'signedLoanMemoCButton', 'signedLoanMemoCDate');
setFileVisibility("<?php echo $remContractC; ?>", "<?php echo $remContractCSelect; ?>", 'remContractC', 'remContractCImage', 'remContractCButton', 'remContractCDate');
setFileVisibility("<?php echo $remContractAnnotatedC; ?>", "<?php echo $remContractAnnotatedCSelect; ?>", 'remContractAnnotatedC', 'remContractAnnotatedCImage', 'remContractAnnotatedCButton', 'remContractAnnotatedCDate');
setFileVisibility("<?php echo $promNoteC; ?>", "<?php echo $promNoteCSelect; ?>", 'promNoteC', 'promNoteCImage', 'promNoteCButton', 'promNoteCDate');
setFileVisibility("<?php echo $disclosureStateC; ?>", "<?php echo $disclosureStateCSelect; ?>", 'disclosureStateC', 'disclosureStateCImage', 'disclosureStateCButton', 'disclosureStateCDate');
setFileVisibility("<?php echo $mriFormC; ?>", "<?php echo $mriFormCSelect; ?>", 'mriFormC', 'mriFormCImage', 'mriFormCButton', 'mriFormCDate');
setFileVisibility("<?php echo $amortScheduleC; ?>", "<?php echo $amortScheduleCSelect; ?>", 'amortScheduleC', 'amortScheduleCImage', 'amortScheduleCButton', 'amortScheduleCDate');
setFileVisibility("<?php echo $remContractEndC; ?>", "<?php echo $remContractEndCSelect; ?>", 'remContractEndC', 'remContractEndCImage', 'remContractEndCButton', 'remContractEndCDate');
setFileVisibility("<?php echo $promNoteEndC; ?>", "<?php echo $promNoteEndCSelect; ?>", 'promNoteEndC', 'promNoteEndCImage', 'promNoteEndCButton', 'promNoteEndCDate');
setFileVisibility("<?php echo $disclosureStateEndC; ?>", "<?php echo $disclosureStateEndCSelect; ?>", 'disclosureStateEndC', 'disclosureStateEndCImage', 'disclosureStateEndCButton', 'disclosureStateEndCDate');
setFileVisibility("<?php echo $mriFormEndC; ?>", "<?php echo $mriFormEndCSelect; ?>", 'mriFormEndC', 'mriFormEndCImage', 'mriFormEndCButton', 'mriFormEndCDate');
setFileVisibility("<?php echo $amortScheduleEndC; ?>", "<?php echo $amortScheduleEndCSelect; ?>", 'amortScheduleEndC', 'amortScheduleEndCImage', 'amortScheduleEndCButton', 'amortScheduleEndCDate');
setFileVisibility("<?php echo $signedDeedUnderEndC; ?>", "<?php echo $signedDeedUnderEndCSelect; ?>", 'signedDeedUnderEndC', 'signedDeedUnderEndCImage', 'signedDeedUnderEndCButton', 'signedDeedUnderEndCDate');
setFileVisibility("<?php echo $utilization; ?>", "<?php echo $utilizationSelect; ?>", 'utilization', 'utilizationImage', 'utilizationButton', 'utilizationDate');
setFileVisibility("<?php echo $powerpoint; ?>", "", 'powerpoint', 'powerpointImage', 'powerpointButton', 'powerpointDate');
setFileVisibility("<?php echo $excel; ?>", "", 'excel', 'excelImage', 'excelButton', 'excelDate');

</script>
<script>
  function handleSearch() {
    // Buttons Selectors
    const selectElements = document.querySelectorAll('#corporation select');
    const descriptionInputs = document.querySelectorAll('#corporation input[type=text]');
    const inputFiles = document.querySelectorAll('.corporation-tabs input[type=file]');
    const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
    const creditButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
    const checkboxes = document.querySelectorAll(".OTHERS input[type=checkbox]");

        var username = "<?php echo $_SESSION['username']; ?>";
        var bankposition = "<?php echo $_SESSION['bankposition']; ?>";
        var position = "<?php echo $_SESSION['position']; ?>";
        var department = "<?php echo $_SESSION['department']; ?>";

        // Only this Person can Access Aprroval Section
        if (username !== "jlcricafrente" && bankposition !== "Loan Docu. Assistant" && department !== "1") {
                  selectElements.forEach(function(selectElement) {
                     selectElement.style.pointerEvents = "none";
             });
                  descriptionInputs.forEach(function(descriptionInput) {
                     descriptionInput.setAttribute("readonly", "readonly");
             });
         }
  // REQUIREMENTS RESTRICTION
  if(position!=="BM" && username !== "jabportillo" && bankposition!=="LOAN Assistant" && bankposition!=="LOAN Officer" && department!=="1" 
      && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" && username !== "tjqpasicolan"){
      inputFiles.forEach(function(inputFile){
         inputFile.style.display="none";
      });
   }
   if(bankposition!=="LOAN Officer" && bankposition !== 'LOAN Assistant' && bankposition !== "Credit Officer" && bankposition !== "Credit Investigator" && department !== corpId"1" && in_array([username], ['rdiones', 'cdcruz', 'rdalvarez', 'jlcvalero'], true)){
      document.getElementById("creditInvestigationReportC").style.display="none";
   } 
   if(bankposition !== "LOAN Officer" && bankposition !== "Credit Officer"  && bankposition !== "Credit Investigator" && department !== "1" && bankposition !== 'LOAN Assistant'){
      document.getElementById("collateralAppraisalReportC").style.display="none";
   } 
   if(bankposition!=="Credit Risk" && department !=="1"){
      document.getElementById("financialEvaluationC").style.display="none";
      document.getElementById("excel").style.display="none";
   } 
   if(bankposition!=="LOAN Officer" && bankposition !== 'LOAN Assistant' && department !=="1"){
      document.getElementById("signedLetterC").style.display="none";
      document.getElementById("signedLoanMemoC").style.display="none";
      document.getElementById("signedLetterUnderEndC").style.display="none";
      // PN-DS-AS
      document.getElementById("promNoteC").style.display="none";
      document.getElementById("disclosureStateC").style.display="none";
      document.getElementById("mriFormC").style.display="none";
      document.getElementById("amortScheduleC").style.display="none";
      // PN-DS-AS END BUYER
      document.getElementById("promNoteEndC").style.display="none";
      document.getElementById("disclosureStateEndC").style.display="none";
      document.getElementById("mriFormEndC").style.display="none";
      document.getElementById("amortScheduleEndC").style.display="none";
      // PRESENTATION
      document.getElementById("powerpoint").style.display="none";

   } 
   if(bankposition !== "ROPOA Docu. Assistant" && username !== "jlcricafrente" && bankposition!=="ROPOA Officer" && department !=="1"){
      document.getElementById("remContractC").style.display="none";
      document.getElementById("remContractEndC").style.display="none";
   } 
   if(bankposition !== "Collection Officer" && username !== "jlcricafrente" && bankposition!=="LOAN Docu. Officer" && department !=="1"){
      document.getElementById("remContractAnnotatedC").style.display="none";
   } 
   if(bankposition !== "LOAN Officer" && bankposition !== 'LOAN Assistant' && position !== "BM" && username !== "jabportillo" && username !== "dgayac" 
      && username !== "dmsantos" && username !== "ejcemata" && department !=="1" && username !== "tjqpasicolan" && username !== "jcvillanueva" && username !== 'rdalvarez'){
      document.getElementById("powerAttorney").style.display="none";
      document.getElementById("contractSell").style.display="none";
      document.getElementById("statementAccount").style.display="none";
      document.getElementById("billMaterials").style.display="none";
      document.getElementById("proposedPlan").style.display="none";
      document.getElementById('cic').style.display="none";
      document.getElementById('nfis').style.display="none";
      document.getElementById("otherDoc").style.display="none";

   } 
   // CHECKMARK ACCESS
   if(bankposition !== "Loan Docu. Assistant" && bankposition !== "LOAN Assistant" && department !=="1" && position!=="BM" 
      && username !== "jabportillo" && username !== "dgayac" && username !== "dmsantos" && username !== "ejcemata" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
      checkboxes.forEach(function (checkbox){
         checkbox.style.pointerEvents = "none";
      });
      document.getElementById("editableLabel").style.pointerEvents = "none";
   } 
   // NEXT BANK PRODUCT ID
   if(bankposition !== "LOAN Officer" && bankposition !== 'LOAN Assistant' && department != "1"){
      document.getElementById("nextbankSection").style.display="none";
   } 
   document.getElementById("productID").removeAttribute("readonly");

   if(bankposition !== "Collection Officer" && department !== "1" && position !== "BM" && username !== 'hriegodedios' && 
      username !== "hmmendoza" && username !== "tjqpasicolan" && username !== "jabportillo" && username !== "ejcemata" && 
      username !== "dgayac" && username !== "dmsantos" && username !== "cgluda" && username !== 'rdalvarez'){
      document.getElementById("utilization").style.display="none";
   } 

   
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
   function showText(target,position){
      var modal = document.getElementById("myModal");
      var span = document.getElementById("closeModal");
      var btn = document.getElementById(target);
      var modalText = document.getElementById("modalText"); 


      // When the button is clicked, display the modal
      btn.addEventListener("click", function () {
            modalText.textContent = btn.value; // Set the modalText content
            modal.style.marginTop = position;
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
// PRINCIPAL BORROWER
showText('endorsementDesc','8%');
showText('loanAppFormCDesc','8%');
showText('companyProfileDesc','8%');
showText('governmentIdDesc','8%');
showText('secRegistrationDesc','17%');
showText('latestGISDesc','22%');
showText('copyBRSDesc','24%');
showText('copyidCSTDesc','28%');
// COLLATERAL DOCUMENTS
showText('transferCertTitleDesc','34%');
showText('taxDeclarationDesc','37%');
showText('taxDeclartionICTCDesc','40%');
showText('realStateReceiptDesc','42%');
showText('realEstateTaxClearanceDesc','43%');
showText('cdOfMorgageDesc','47%');
// BUSINESS PROOF OF INCOME
showText('copyUpdatedBPDesc','52%');
showText('auditedFinancialDesc','55%');
showText('inhouseFinancialDesc','58%');
showText('latestBankDesc','61%');
showText('incomeTaxReturnDesc','63%');
showText('contractLeaseDesc','65%');
showText('customerContactDesc','67%');
showText('supplierContactDesc','69%');
showText('proofBillingDesc','71%');
// OTHERS
showText('powerAttorneyDesc','17%');
showText('contractSellDesc','17%');
showText('letterGuaranteeDesc','17%');
showText('statementAccountDesc','17%');
showText('billMaterialsDesc','17%');
showText('proposedPlanDesc','17%');
showText('cicDesc', '17%');
showText('nfisDesc', '17%');
showText('otherDocDesc','17%');
// DOCUMENTS
showText('receiptDesc','10%');
showText('creditInvestigationReportCDesc','10%');
showText('collateralAppraisalReportCDesc','13%');
showText('financialEvaluationCDesc','13%');
showText('signedLetterCDesc','13%');
showText('signedLetterUnderEndCDesc','13%');
showText('signedLoanMemoCDesc','17%');
showText('remContractCDesc','23%');
showText('remContractAnnotatedCDesc','27%');
showText('promNoteCDesc','30%');
showText('disclosureStateCDesc','30%');
showText('mriFormCDesc','30%');
showText('amortScheduleCDesc','30%');
showText('remContractEndCDesc','30%');
showText('promNoteEndCDesc','30%');
showText('disclosureStateEndCDesc','30%');
showText('mriFormEndCDesc','30%');
showText('amortScheduleEndCDesc','30%');
showText('signedDeedUnderEndCDesc','30%');
showText('utilizationDesc','35%');


    </script>

</body>
</html>