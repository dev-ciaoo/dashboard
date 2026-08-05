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
      <link rel="stylesheet" href="css/styleloan.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" type="text/css">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <style type="text/css"></style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
      <script src="loanFormIndividual.js"></script>
      <title>OURBANK</title>
   </head>
   <body oncontextmenu="return false;">
      <style>
         .nav-item .nav-link.active {
         background-color: lightgreen;
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
                 $remType=$row['remType'];
                 $branch=$row['branch'];
                 $loanType= $row['loanType'];
                 $sourceIncome= $row['sourceIncome'];
                 
         } 
         }
         

         if($type == "REM: Individual") {
            
         ?>

      <?php
         $query4 = "SELECT * FROM individual WHERE indivloanId = $id";
         $newdata = mysqli_query($con, $query4);
         $rows = mysqli_fetch_array($newdata);
         
         // PRINCIPAL BORROWER
         $endorsement = $rows['endorsement'];
         $loanAppFormI = $rows['loanAppFormI'];
         $photocopyIdSignatures = $rows['photocopyIdSignatures'];
         $proofBilling = $rows['proofBilling'];
         $personalBank = $rows['personalBank'];
         $marriageContract = $rows['marriageContract'];
         $barangayClearance = $rows['barangayClearance'];
         // COLLATERAL DOCUMENTS
         $transferCertificate = $rows['transferCertificate'];
         $taxDeclarationLot = $rows['taxDeclarationLot'];
         $taxDeclarationImp = $rows['taxDeclarationImp'];
         $realEstateTaxClearance = $rows['realEstateTaxClearance'];
         $realEstateTaxReceipt = $rows['realEstateTaxReceipt'];
         $cancellationDischarge = $rows['cancellationDischarge'];
         // SUNTRUST DOCUMENTS
         $sunTransferCertificate = $rows['sunTransferCertificate'];
         $sunTaxDeclarationLot = $rows['sunTaxDeclarationLot'];
         $sunTaxDeclarationImp = $rows['sunTaxDeclarationImp'];
         $sunContractSell = $rows['sunContractSell'];
         $sunStatementAccount = $rows['sunStatementAccount'];
         // BUSINESS PROOF OF INCOME
         $updatedBusiness = $rows['updatedBusiness'];
         $auditedFinancial = $rows['auditedFinancial'];
         $inhouseFinancial = $rows['inhouseFinancial'];
         $businessBankStatement = $rows['businessBankStatement'];
         $salesRecord = $rows['salesRecord'];
         $incomeTaxReturn = $rows['incomeTaxReturn'];
         $contractLease = $rows['contractLease'];
         $customerNumber = $rows['customerNumber'];
         $customerSupplier = $rows['customerSupplier'];
         $otherIncomeB = $rows['otherIncomeB'];
         // EMPLOYED PROOF OF INCOME
         $employmentContract = $rows['employmentContract'];
         $certificateEmployment = $rows['certificateEmployment'];
         $incomeTax = $rows['incomeTax'];
         $payslipMonths = $rows['payslipMonths'];
         $otherIncome = $rows['otherIncome'];
         // OTHERS
         $powerAttorneyI = $rows['powerAttorneyI'];
         $generalInfo = $rows['generalInfo'];
         $securityExchange = $rows['securityExchange'];
         $letterGuarantee = $rows['letterGuarantee'];
         $boardResolution = $rows['boardResolution'];
         $statementAccountI = $rows['statementAccount'];
         $billMaterial = $rows['billMaterial'];
         $proposedPlan = $rows['proposedPlan'];
         $otherDoc = $rows['otherDoc'];
         // DOCUMENTS
         $receipt = $rows['receipt'];
         $creditInvestigationReportI = $rows['creditInvestigationReportI'];
         $collateralAppraisalReportI = $rows['collateralAppraisalReportI'];
         $financialEvaluationI = $rows['financialEvaluationI'];
         $signedLetterI = $rows['signedLetterI'];
         $signedLoanMemoI = $rows['signedLoanMemoI'];            
         $remContractI = $rows['remContractI'];
         $promNoteI = $rows['promNoteI'];
         $disclosureStateI = $rows['disclosureStateI'];
         $mriFormI = $rows['mriFormI'];
         $remContractAnnotatedI = $rows['remContractAnnotatedI'];
         $signedLetterUnderEndI = $rows['signedLetterUnderEndI'];
         $remContractEndI = $rows['remContractEndI'];
         $promNoteEndI = $rows['promNoteEndI'];
         $disclosureStateEndI = $rows['disclosureStateEndI'];
         $mriFormEndI = $rows['mriFormEndI'];
         $signedDeedUnderEndI = $rows['signedDeedUnderEndI'];
         $amortScheduleI = $rows['amortScheduleI'];
         $amortScheduleEndI = $rows['amortScheduleEndI'];
         $utilization=$rows['utilization'];
         $powerpoint=$rows['powerpoint'];
         $excel=$rows['excel'];
         
         // GET STATUS 
         // PRINCIPAL BORROWER
         $endorsementSelect = $rows['endorsementStatus'];
         $loanAppFormISelect = $rows['loanAppFormIStatus'];
         $photocopyIdSignaturesSelect = $rows['photocopyIdSignaturesStatus'];
         $proofBillingSelect = $rows['proofBillingStatus'];
         $personalBankSelect = $rows['personalBankStatus'];
         $marriageContractSelect = $rows['marriageContractStatus'];
         $barangayClearanceSelect = $rows['barangayClearanceStatus'];
         // COLLATERAL DOCUMENTS
         $transferCertificateSelect = $rows['transferCertificateStatus'];
         $taxDeclarationLotSelect = $rows['taxDeclarationLotStatus'];
         $taxDeclarationImpSelect = $rows['taxDeclarationImpStatus'];
         $realEstateTaxClearanceSelect = $rows['realEstateTaxClearanceStatus'];
         $realEstateTaxReceiptSelect = $rows['realEstateTaxReceiptStatus'];
         $cancellationDischargeSelect = $rows['cancellationDischarageStatus'];
         // SUNTRUST DOCUMENTS
         $sunTransferCertificateSelect = $rows['sunTransferCertificateStatus'];
         $sunTaxDeclarationLotSelect = $rows['sunTaxDeclarationLotStatus'];
         $sunTaxDeclarationImpSelect = $rows['sunTaxDeclarationImpStatus'];
         $sunContractSellSelect = $rows['sunContractSellStatus'];
         $sunStatementAccountSelect = $rows['sunStatementAccountStatus'];
         // BUSINESS PROOF OF INCOME
         $updatedBusinessSelect = $rows['updatedBusinessStatus'];
         $auditedFinancialSelect = $rows['auditedFinancialStatus'];
         $inhouseFinancialSelect = $rows['inhouseFinancialStatus'];
         $businessBankStatementSelect = $rows['businessBankStatementStatus'];
         $salesRecordSelect = $rows['salesRecordStatus'];
         $incomeTaxReturnSelect = $rows['incomeTaxReturnStatus'];
         $contractLeaseSelect = $rows['contractLeaseStatus'];
         $customerNumberSelect = $rows['customerNumberStatus'];
         $customerSupplierSelect = $rows['customerSupplierStatus'];
         $otherIncomeBSelect = $rows['otherIncomeBStatus'];
         // EMPLOYED PROOF OF INCOME
         $employmentContractSelect = $rows['employmentContractStatus'];
         $certificateEmploymentSelect = $rows['certificateEmploymentStatus'];
         $incomeTaxSelect = $rows['incomeTaxStatus'];
         $payslipMonthsSelect = $rows['payslipMonthsStatus'];
         $otherIncomeSelect = $rows['otherIncomeStatus'];
         // OTHERS
         $powerAttorneyISelect = $rows['powerAttorneyIStatus'];
         $generalInfoSelect = $rows['generalInfoStatus'];
         $securityExchangeSelect = $rows['securityExchangeStatus'];
         $letterGuaranteeSelect = $rows['letterGuaranteeStatus'];
         $boardResolutionSelect = $rows['boardResolutionStatus'];
         $statementAccountSelect = $rows['statementAccountStatus'];
         $billMaterialSelect = $rows['billMaterialStatus'];
         $proposedPlanSelect = $rows['proposedPlanStatus'];
         $otherDocSelect = $rows['otherDocStatus'];
         // DOCUMENTS
         $receiptSelect = $rows['receiptStatus'];
         $creditInvestigationReportISelect = $rows['creditInvestigationReportIStatus'];
         $collateralAppraisalReportISelect = $rows['collateralAppraisalReportIStatus'];
         $financialEvaluationISelect = $rows['financialEvaluationIStatus'];
         $signedLetterISelect = $rows['signedLetterIStatus'];
         $signedLetterUnderEndISelect = $rows['signedLetterUnderEndIStatus'];
         $signedLoanMemoISelect = $rows['signedLoanMemoIStatus'];
         $remContractISelect = $rows['remContractIStatus'];
         $remContractAnnotatedISelect = $rows['remContractAnnotatedIStatus'];
         $promNoteISelect = $rows['promNoteIStatus'];
         $disclosureStateISelect = $rows['disclosureStateIStatus'];
         $mriFormISelect = $rows['mriFormIStatus'];
         $amortScheduleISelect = $rows['amortScheduleIStatus'];
         $remContractEndISelect = $rows['remContractEndIStatus'];
         $promNoteEndISelect = $rows['promNoteEndIStatus'];
         $disclosureStateEndISelect = $rows['disclosureStateEndIStatus'];
         $mriFormEndISelect = $rows['mriFormEndIStatus'];
         $amortScheduleEndISelect = $rows['amortScheduleEndIStatus'];
         $signedDeedUnderEndISelect = $rows['signedDeedUnderEndIStatus'];
         $utilizationSelect=$rows['utilizationStatus'];
         // CHECKBOX
         $powerAttorneyICheck = $rows['powerAttorneyICheck'];
         $generalInfoCheck = $rows['generalInfoCheck'];
         $securityExchangeCheck = $rows['securityExchangeCheck'];
         $letterGuaranteeCheck = $rows['letterGuaranteeCheck'];
         $boardResolutionCheck = $rows['boardResolutionCheck'];
         $statementAccountICheck = $rows['statementAccountICheck'];
         $billMaterialCheck = $rows['billMaterialCheck'];
         $proposedPlanCheck = $rows['proposedPlanCheck'];
         $otherDocCheck = $rows['otherDocCheck'];
         
         }

 
        
    
    
         
         // The NUMBER OF PERCENTAGE
         $principalBorrower=array($loanAppFormISelect, $photocopyIdSignaturesSelect, $proofBillingSelect, $personalBankSelect, $marriageContractSelect, $barangayClearanceSelect);

         $collateralDocuments=array($transferCertificateSelect, $taxDeclarationLotSelect, $taxDeclarationImpSelect, $realEstateTaxClearanceSelect, $realEstateTaxReceiptSelect);
         
         $suntrustDocuments=array($sunTransferCertificateSelect, $sunTaxDeclarationLotSelect, $sunTaxDeclarationImpSelect, $sunContractSellSelect, $sunStatementAccountSelect);
         
         $businessIncome=array($updatedBusinessSelect, $auditedFinancialSelect, $inhouseFinancialSelect, $businessBankStatementSelect, $incomeTaxReturnSelect, $contractLeaseSelect, $customerNumberSelect, $customerSupplierSelect);
         
         $employedIncome=array($certificateEmploymentSelect, $payslipMonthsSelect);
         
         $documents=array($creditInvestigationReportISelect, $collateralAppraisalReportISelect, $financialEvaluationISelect, $signedLetterISelect, $signedLoanMemoISelect);
         
         $endBuyerDocuments=array($signedLetterUnderEndISelect, $remContractEndISelect, $promNoteEndISelect, $disclosureStateEndISelect, $mriFormEndISelect,$amortScheduleEndISelect);
         
         $notEndBuyerDocuments=array($remContractISelect, $remContractAnnotatedISelect, $promNoteISelect, $disclosureStateISelect, $mriFormISelect, $amortScheduleISelect);
         
         if($remType=="End Buyer"){
         $numberOfFilesUploaded = array_merge($principalBorrower, $suntrustDocuments, $endBuyerDocuments, $documents);
         
         if($sourceIncome=="Business"){
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $businessIncome);
         }
         else{
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $employedIncome);
         }

         }
         else{
         $numberOfFilesUploaded = array_merge($principalBorrower, $collateralDocuments, $notEndBuyerDocuments, $documents);
         if($sourceIncome=="Business"){
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $businessIncome);
         }
         else{
         $numberOfFilesUploaded=array_merge($numberOfFilesUploaded, $employedIncome);
         }
         }
         // Filter out empty values from the array
         // Max Number Of Overall File Base on Condition
         $maxCount=count($numberOfFilesUploaded);
         // echo $maxCount;

         // ONLY COUNT SELECT THAT HAS VALUE == 1
         $nonEmptyFileInputs = array_filter($numberOfFilesUploaded,function($value) {
            $parts = explode("--", $value);
            return $value !== "NULL" && $parts[0] !=="2" && !empty($value);
        });;
         
         // Count the number of non-empty values
         $numberOfFilesUploaded = count($nonEmptyFileInputs);
         // Calculate the percentage
         $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         

         ?>

      <div class="linkContainer py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><b><?php echo "$fullname &nbsp; $birth &nbsp; $loanType &nbsp; $type &nbsp; $sourceIncome &nbsp; $remType"; ?></b></h3></label>
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
                  <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver">
                     <li class="nav-item ">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab1" href="#microfinance"><b>Microfinance</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#salary"><b>Salary</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation"><b>Real Estate Mortgage - Corporation</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab4" href="#individual"><b>Real Estate Mortgage - Individual</b></a>
                     </li>
                  </ul>
                  <div id="myModal" class="modal" style="margin-top:5%; margin-left:20%; width:50%; height:500px;">
                  <div class="modal-content" style="height:50%;">
                     <span class="close" id="closeModal" style="font-size:2em; margin-left:95%"><i class="fa fa-times" aria-hidden="true"></i></span>
                     <p><b>
                           <h1 id="modalText" style="font-size: 1.5em;"></h1>
                        </b></p>
                  </div>
               </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="individual" class="tab-pane active"  style=" border: 1px solid #ccc;">
                              <form id="individual-form" action="loanIndividualUploadData.php" method="POST" enctype="multipart/form-data">
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
                                       <div class="individual-tabs" style=" border-right: 1px solid #ccc; height: 97.4%; margin-bottom:0; margin-top:-0.5%;">
                                          <!-- Requirements Form -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><b><u>PRINCIPAL BORROWER</u></b></label></div>
                                             </div>
                                          </div>
                                       <!-- ENDORSEMENT/RECOMMENDATION LETTER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom"><b> ENDORSEMENT LETTER</b></label>
                                                   <input type="file" id="endorsement" name="endorsement"><img id="endorsementImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $endorsement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="endorsementButton">Open File</button></a>
                                                   <label class="date-label" id="endorsementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($endorsement, strrpos($endorsement, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="endorsementSelect" name= "endorsementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                                      <option selected  value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class="individual-labels" id="tab-label" for="custom"><b>LOAN APPLICATION FORM</b></label>
                                                   <input type="file" id="loanAppFormI" name="loanAppFormI"><img id="loanAppFormIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppFormI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormIButton">Open File</button></a>
                                                   <label class="date-label" id="loanAppFormIDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormI, strrpos($loanAppFormI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="loanAppFormISelect" name="loanAppFormISelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="loanAppFormIDesc" name="loanAppFormIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED IDs WITH 3 SIGNATURES -->
                                          <div class="row">
                                             <div class="col-8">

                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom"><b>PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED IDs WITH 3 SIGNATURES</b></label>
                                                   <input type="file" id="photocopyIdSignatures" name="photocopyIdSignatures"><img id="photocopyIdSignaturesImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $photocopyIdSignatures; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="photocopyIdSignaturesButton">Open File</button></a>
                                                   <label class="date-label" id="photocopyIdSignaturesDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($photocopyIdSignatures, strrpos($photocopyIdSignatures, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="photocopyIdSignaturesSelect" name="photocopyIdSignaturesSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="photocopyIdSignaturesDesc" name="photocopyIdSignaturesDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- PROOF OF BILLING (MERALCO, INTERNET BILL, WATER BILL) -->
                                            <div class="row">
                                             <div class="col-8">
                                               <div class="py-2" >
                                                <label class ="individual-labels" id="tab-label" for="custom"><b>PROOF OF BILLING (MERALCO, INTERNEET BILL, WATER BILL)</b></label>
                                                <input type="file" id="proofBilling" name="proofBilling"><img id="proofBillingImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $proofBilling; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofBillingButton" >Open File</button></a>
                                                <label class="date-label" id="proofBillingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label>
                                              </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex" >
                                                <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "proofBillingSelect" name = "proofBillingSelect" >
                                                <option selected value= "NULL"><b>Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2"><b>INCOMPLETE</b></option>
                                                <option value="3"><b>N/A</b></option>
                                              </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proofBillingDesc" name = "proofBillingDesc" >&nbsp;
                                              </div>
                                             </div>
                                          </div>
                                           <!-- PERSONAL-BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom"><b>PERSONAL-BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS</b></label>
                                                   <input type="file" id="personalBank" name="personalBank"><img id="personalBankImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $personalBank; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="personalBankButton">Open File</button></a>
                                                   <label class="date-label" id="personalBankDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($personalBank, strrpos($personalBank, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4" >
                                        <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "personalBankSelect" name = "personalBankSelect" >
                                        <option selected value= "NULL"><b>Option</option>
                                        <option value="1">VERIFIED</option>
                                        <option value="2"><b>INCOMPLETE</b></option>
                                        <option value="3"><b>N/A</b></option>
                                        </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="personalBankDesc" name = "personalBankDesc" >&nbsp;
                                        </div>
                                             </div>
                                          </div>
                                           <!-- MARRIAGE CONTRACT (IF MARRIED) *CENOMAR (IF SINGLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom"><b>MARRIAGE CONTRACT (IF MARRIED) *CENOMAR (IF SINGLE)</b></label>
                                                   <input type="file" id="marriageContract" name="marriageContract"><img id="marriageContractImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $marriageContract; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="marriageContractButton">Open File</button></a>
                                                   <label class="date-label" id="marriageContractDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($marriageContract, strrpos($marriageContract, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="marriageContractSelect" name="marriageContractSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="marriageContractDesc" name="marriageContractDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BARANGAY CLEARANCE FOR LOAN PURPOSE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom"><b>BARANGAY CLEARANCE FOR LOAN PURPOSE</b></label>
                                                   <input type="file" id="barangayClearance" name="barangayClearance"><img id="barangayClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $barangayClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="barangayClearanceButton">Open File</button></a>
                                                   <label class="date-label" id="barangayClearanceDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($barangayClearance, strrpos($barangayClearance, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="barangayClearanceSelect" name="barangayClearanceSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="barangayClearanceDesc" name="barangayClearanceDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--DIV HERE FOR COLLATERAL  -->
                                          <div class="collateralDocuments" id="collateralDocuments" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><b><u>COLLATERAL DOCUMENTS</u></b></label></div>
                                                </div>
                                             </div>
                                             <!-- TRANSFER CERTIFICATE OF TITLE (ORIGINAL & CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   
                                                   <div class="py-2">
                                                      <label class="individual-labels" id="tab-label" for="custom"><b>TRANSFER CERTIFICATE OF TITLE (ORIGINAL & CERTIFIED TRUE COPY)</b></label>
                                                      <input type="file" id="transferCertificate" name="transferCertificate"><img id="transferCertificateImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $transferCertificate; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="transferCertificateButton">Open File</button></a>
                                                      <label class="date-label" id="transferCertificateDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($transferCertificate, strrpos($transferCertificate, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-1">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="transferCertificateSelect" name="transferCertificateSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="transferCertificateDesc" name="transferCertificateDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (LOT - CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels" id="tab-label" for="custom"><b>TAX DECLARATION (LOT - CERTIFIED TRUE COPY)</b></label>
                                                      <input type="file" id="taxDeclarationLot" name="taxDeclarationLot"><img id="taxDeclarationLotImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $taxDeclarationLot; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationLotButton">Open File</button></a>
                                                      <label class="date-label" id="taxDeclarationLotDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclarationLot, strrpos($taxDeclarationLot, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclarationLotSelect" name="taxDeclarationLotSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationLotDesc" name="taxDeclarationLotDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (IMPROVEMENT - CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>TAX DECLARATION (IMPROVEMENT - CERTIFIED TRUE COPY)  </b></label>
                                                      <input type="file" id="taxDeclarationImp" name="taxDeclarationImp"><img id="taxDeclarationImpImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $taxDeclarationImp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationImpButton" >Open File</button></a>
                                                      <label class="date-label" id="taxDeclarationImpDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclarationImp, strrpos($taxDeclarationImp, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "taxDeclarationImpSelect" name = "taxDeclarationImpSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationImpDesc" name = "taxDeclarationImpDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!-- REAL ESTATE TAX CLEARANCE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>REAL ESTATE TAX CLEARANCE </b></label>
                                                      <input type="file" id="realEstateTaxClearance" name="realEstateTaxClearance"><img id="realEstateTaxClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $realEstateTaxClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxClearanceButton" >Open File</button></a>
                                                      <label class="date-label" id="realEstateTaxClearanceDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxClearance, strrpos($realEstateTaxClearance, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "realEstateTaxClearanceSelect" name = "realEstateTaxClearanceSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="realEstateTaxClearanceDesc" name = "realEstateTaxClearanceDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!--REAL ESTATE TAX RECEIPT   -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>REAL ESTATE TAX RECEIPT (AMILYAR) </b></label>
                                                      <input type="file" id="realEstateTaxReceipt" name="realEstateTaxReceipt"><img id="realEstateTaxReceiptImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $realEstateTaxReceipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxReceiptButton" >Open File</button></a>
                                                      <label class="date-label" id="realEstateTaxReceiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxReceipt, strrpos($realEstateTaxReceipt, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "realEstateTaxReceiptSelect" name = "realEstateTaxReceiptSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="realEstateTaxReceiptDesc" name = "realEstateTaxReceiptDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!--CANCELLATION AND DISCHARGE OF MORTGAGE (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>CANCELLATION AND DISCHARGE OF MORTGAGE (IF APPLICABLE)</b></label>
                                                      <input type="file" id="cancellationDischarge" name="cancellationDischarge"><img id="cancellationDischargeImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $cancellationDischarge; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cancellationDischargeButton" >Open File</button></a>
                                                      <label class="date-label" id="cancellationDischargeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cancellationDischarge, strrpos($cancellationDischarge, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "cancellationDischargeSelect" name = "cancellationDischargeSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cancellationDischargeDesc" name = "cancellationDischargeDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="suntrustDocuments" id="suntrustDocuments" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><b><u>SUNTRUST DOCUMENTS</u></b></label></div>
                                                </div>
                                             </div>
                                              <!-- COPY OF TRANSFER CERTIFICATE OF TITLE-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>COPY OF TRANSFER CERTIFICATE OF TITLE </b></label>
                                                      <input type="file" id="sunTransferCertificate" name="sunTransferCertificate"><img id="sunTransferCertificateImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $sunTransferCertificate; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTransferCertificateButton" >Open File</button></a>
                                                      <label class="date-label" id="sunTransferCertificateDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTransferCertificate, strrpos($sunTransferCertificate, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "sunTransferCertificateSelect" name = "sunTransferCertificateSelect"  >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="sunTransferCertificateDesc" name = "sunTransferCertificateDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (LOT-COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>TAX DECLARATION (LOT-COPY)  </b></label>
                                                      <input type="file" id="sunTaxDeclarationLot" name="sunTaxDeclarationLot"><img id="sunTaxDeclarationLotImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $sunTaxDeclarationLot; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTaxDeclarationLotButton" >Open File</button></a>
                                                      <label class="date-label" id="sunTaxDeclarationLotDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTaxDeclarationLot, strrpos($sunTaxDeclarationLot, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunTaxDeclarationLotSelect" name = "sunTaxDeclarationLotSelect"  >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunTaxDeclarationLotDesc" name = "sunTaxDeclarationLotDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (IMPROVEMENT - COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>TAX DECLARATION (IMPROVEMENT - COPY) </b></label>
                                                      <input type="file" id="sunTaxDeclarationImp" name="sunTaxDeclarationImp"><img id="sunTaxDeclarationImpImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunTaxDeclarationImp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTaxDeclarationImpButton" >Open File</button></a>
                                                      <label class="date-label" id="sunTaxDeclarationImpDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTaxDeclarationImp, strrpos($sunTaxDeclarationImp, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunTaxDeclarationImpSelect" name = "sunTaxDeclarationImpSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunTaxDeclarationImpDesc" name = "sunTaxDeclarationImpDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--CONTRACT TO SELL   -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>CONTRACT TO SELL  </b></label>
                                                      <input type="file" id="sunContractSell" name="sunContractSell"><img id="sunContractSellImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunContractSell; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunContractSellButton" >Open File</button></a>
                                                      <label class="date-label" id="sunContractSellDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunContractSell, strrpos($sunContractSell, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunContractSellSelect" name = "sunContractSellSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunContractSellDesc" name = "sunContractSellDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY</b></label>
                                                      <input type="file" id="sunStatementAccount" name="sunStatementAccount"><img id="sunStatementAccountImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunStatementAccount; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunStatementAccountButton" >Open File</button></a>
                                                      <label class="date-label" id="sunStatementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunStatementAccount, strrpos($sunStatementAccount, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                    <!-- STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY  -->
                                                  <div class="form-group d-flex mb-2">
                                                    <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunStatementAccountSelect" name = "sunStatementAccountSelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                    </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunStatementAccountDesc" name = "sunStatementAccountDesc" >&nbsp;
                                                  </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- here end -->
                                          <!-- BUSUINESS PROOF OF INCOME -->
                                          <div class="businessProofIncome" id="businessProofIncome" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><b><u>BUSINESS PROOF OF INCOME</u></b></label></div>
                                                </div>
                                             </div>
                                             <!-- UPDATED BUSINESS PERMIT (MAYOR'S, BARANGAY AND/OR DTI)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> UPDATED BUSINESS PERMIT (MAYOR'S, BARANGAY AND/OR DTI)</b></label> 
                                                      <input type="file" id="updatedBusiness" name="updatedBusiness"><img id="updatedBusinessImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $updatedBusiness; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="updatedBusinessButton" >Open File</button></a>
                                                      <label class="date-label" id="updatedBusinessDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($updatedBusiness, strrpos($updatedBusiness, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "updatedBusinessSelect" name = "updatedBusinessSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="updatedBusinessDesc" name = "updatedBusinessDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--AUDITED FINANCIAL STATEMENT (3 YEARS)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>AUDITED FINANCIAL STATEMENT (3 YEARS)</i></b></label> 
                                                      <input type="file" id="auditedFinancial" name="auditedFinancial"><img id="auditedFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $auditedFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="auditedFinancialButton">Open File</button></a>
                                                      <label class="date-label" id="auditedFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($auditedFinancial, strrpos($auditedFinancial, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "auditedFinancialSelect" name = "auditedFinancialSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="auditedFinancialDesc" name = "auditedFinancialDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- IN-HOUSE FINANCIAL STATEMENT (3 YEARS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>IN-HOUSE FINANCIAL STATEMENT (3 YEARS) </b></label>
                                                      <input type="file" id="inhouseFinancial" name="inhouseFinancial"><img id="inhouseFinancialImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $inhouseFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="inhouseFinancialButton" >Open File</button></a>
                                                      <label class="date-label" id="inhouseFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($inhouseFinancial, strrpos($inhouseFinancial, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inhouseFinancialSelect" name = "inhouseFinancialSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="inhouseFinancialDesc" name = "inhouseFinancialDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- BUSINESS - BANK STATEMENT OR PASSBOOK FOR THE LAST 6 MONTHS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> BUSINESS - BANK STATEMENT OR PASSBOOK FOR THE LAST 6 MONTHS </b></label>
                                                      <input type="file" id="businessBankStatement" name="businessBankStatement"><img id="businessBankStatementImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $businessBankStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessBankStatementButton">Open File</button></a>
                                                      <label class="date-label" id="businessBankStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessBankStatement, strrpos($businessBankStatement, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "businessBankStatementSelect" name = "businessBankStatementSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="businessBankStatementDesc" name = "businessBankStatementDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- SALES RECORD & PURCHASES RECEIPTS OR LOGBOOK -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> SALES RECORD & PURCHASES RECEIPTS OR LOGBOOK (IF APPLICABLE) </b></label>
                                                      <input type="file" id="salesRecord" name="salesRecord"><img id="salesRecordImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $salesRecord; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="salesRecordButton">Open File</button></a>
                                                      <label class="date-label" id="salesRecordDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($salesRecord, strrpos($salesRecord, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "salesRecordSelect" name = "salesRecordSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="salesRecordDesc" name = "salesRecordDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!--INCOME TAX RETURN (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>INCOME TAX RETURN (IF APPLICABLE) </b></label> 
                                                      <input type="file" id="incomeTaxReturn" name="incomeTaxReturn"><img id="incomeTaxReturnImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $incomeTaxReturn; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxReturnButton" >Open File</button></a>
                                                      <label class="date-label" id="incomeTaxReturnDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTaxReturn, strrpos($incomeTaxReturn, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "incomeTaxReturnSelect" name = "incomeTaxReturnSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxReturnDesc" name = "incomeTaxReturnDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- CONTRACT OF LEASE (IF RENTAL BUSINESS)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>CONTRACT OF LEASE (IF RENTAL BUSINESS)</b></label> 
                                                      <input type="file" id="contractLease" name="contractLease"><img id="contractLeaseImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $contractLease; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractLeaseButton" >Open File</button></a>
                                                      <label class="date-label" id="contractLeaseDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractLease, strrpos($contractLease, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "contractLeaseSelect" name = "contractLeaseSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractLeaseDesc" name = "contractLeaseDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- 5 CUSTOMERS WITH CONTACT NUMBER  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> 5 CUSTOMERS WITH CONTACT NUMBER</b></label> 
                                                      <input type="file" id="customerNumber" name="customerNumber"><img id="customerNumberImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $customerNumber; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerNumberButton" >Open File</button></a>
                                                      <label class="date-label" id="customerNumberDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerNumber, strrpos($customerNumber, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "customerNumberSelect" name = "customerNumberSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerNumberDesc" name = "customerNumberDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- 5 SUPPLIERS WITH CONTACT NUMBER -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> 5 SUPPLIERS WITH CONTACT NUMBER</b></label>
                                                      <input type="file" id="customerSupplier" name="customerSupplier"><img id="customerSupplierImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $customerSupplier; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerSupplierButton" >Open File</button></a>
                                                      <label class="date-label" id="customerSupplierDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerSupplier, strrpos($customerSupplier, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "customerSupplierSelect" name = "customerSupplierSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerSupplierDesc" name = "customerSupplierDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                            <!-- OTHER SOURCE OF INCOME -->
                                               <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> OTHER SOURCE OF INCOME <br> (IF APPLICABLE)</b></label>
                                                      <input type="file" id="otherIncomeB" name="otherIncomeB"><img id="otherIncomeBImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $otherIncomeB; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherIncomeBButton" >Open File</button></a>
                                                      <label class="date-label" id="otherIncomeBDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherIncomeB, strrpos($otherIncomeB, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherIncomeBSelect" name = "otherIncomeBSelect" tabindex="-1">
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="otherIncomeBDesc" name = "otherIncomeBDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                           <!-- FOR SPACE BUSINESS-->
                                             <div class="row">
                                              <div class="col-8" id="businessSpace" style="margin-bottom:-2%; "></div>
                                           </div>
                                          <!-- EMPLOYED PROOF OF INCOME -->
                                          <div class="employedProofIncome" id="employedProofIncome" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3 mt-4"><label style="font-size:120%"><b><u>EMPLOYED PROOF OF INCOME</u></b></label></div>
                                                </div>
                                             </div>
                                             <!-- EMPLOYMENT CONTRACT (IF APPLICABLE)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b>EMPLOYMENT CONTRACT (IF APPLICABLE)</b></label> 
                                                      <input type="file" id="employmentContract" name="employmentContract"><img id="employmentContractImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $employmentContract; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="employmentContractButton" >Open File</button></a>
                                                      <label class="date-label" id="employmentContractDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($employmentContract, strrpos($employmentContract, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "employmentContractSelect" name = "employmentContractSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="employmentContractDesc" name = "employmentContractDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- CERTIFICATE OF EMPLOYMENT WITH COMPENSATION  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> CERTIFICATE OF EMPLOYMENT WITH COMPENSATION</b></label> 
                                                      <input type="file" id="certificateEmployment" name="certificateEmployment"><img id="certificateEmploymentImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $certificateEmployment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="certificateEmploymentButton" >Open File</button></a>
                                                      <label class="date-label" id="certificateEmploymentDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($certificateEmployment, strrpos($certificateEmployment, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "certificateEmploymentSelect" name = "certificateEmploymentSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="certificateEmploymentDesc" name = "certificateEmploymentDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- INCOME TAX RETURN -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> INCOME TAX RETURN (IF APPLICABLE)</b></label>
                                                      <input type="file" id="incomeTax" name="incomeTax"><img id="incomeTaxImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $incomeTax; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxButton" >Open File</button></a>
                                                      <label class="date-label" id="incomeTaxDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTax, strrpos($incomeTax, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "incomeTaxSelect" name = "incomeTaxSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxDesc" name = "incomeTaxDesc">
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- PAYSLIP FOR 6 MONTHS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> PAYSLIP FOR 6 MONTHS</b></label>
                                                      <input type="file" id="payslipMonths" name="payslipMonths"><img id="payslipMonthsImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $payslipMonths; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="payslipMonthsButton" >Open File</button></a>
                                                      <label class="date-label" id="payslipMonthsDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($payslipMonths, strrpos($payslipMonths, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "payslipMonthsSelect" name = "payslipMonthsSelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="payslipMonthsDesc" name = "payslipMonthsDesc">
                                                   </div>
                                                </div>
                                             </div>
                                          <!-- OTHER SOURCE OF INCOME -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"><b> OTHER SOURCE OF INCOME <br> (IF APPLICABLE)</b></label>
                                                      <input type="file" id="otherIncome" name="otherIncome"><img id="otherIncomeImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $otherIncome; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherIncomeButton" >Open File</button></a>
                                                      <label class="date-label" id="otherIncomeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherIncome, strrpos($otherIncome, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherIncomeSelect" name = "otherIncomeSelect" tabindex="-1">
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="otherIncomeDesc" name = "otherIncomeDesc">
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
                                           <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:130%"><b><u>DOCUMENT REPORTS AND CASHFLOW ANALYSIS</u></b></label></div>
                                             </div>
                                          </div>
                                       <!-- APPRAISAL FEE RECEIPT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label"><b>APPRAISAL FEE RECEIPT</b></label>
                                                   <input type="file" id="receipt" name="receipt"><img id="receiptImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $receipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="receiptButton">Open File</button></a>
                                                   <label class="date-label" id="receiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($receipt, strrpos($receipt, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="receiptSelect" name="receiptSelect" tabindex="-1">
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="receiptDesc" name="receiptDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- CREDIT INVESTIGATION AND CREDIT INBESTIGATION REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <label class ="individual-labels"><b>CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT</b></label>
                                                   <input type="file" id="creditInvestigationReportI" name="creditInvestigationReportI"><img id="creditInvestigationReportIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $creditInvestigationReportI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportIButton">Open File</button></a>
                                                   <label class="date-label" id="creditInvestigationReportIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportI, strrpos($creditInvestigationReportI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select  class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "creditInvestigationReportISelect" name = "creditInvestigationReportISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="creditInvestigationReportIDesc" name = "creditInvestigationReportIDesc"  >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- APPRAISE THE PROPERTY AND COLLATERAL APPRIASAL REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class ="individual-labels"><b>APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT</b></label>
                                                   <input type="file" id="collateralAppraisalReportI" name="collateralAppraisalReportI"><img id="collateralAppraisalReportIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $collateralAppraisalReportI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="collateralAppraisalReportIButton">Open File</button></a> 
                                                   <label class="date-label" id="collateralAppraisalReportIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($collateralAppraisalReportI, strrpos($collateralAppraisalReportI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select  class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "collateralAppraisalReportISelect" name = "collateralAppraisalReportISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="collateralAppraisalReportIDesc" name = "collateralAppraisalReportIDesc"  >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREDBOARD -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD </b></label>
                                                   <input type="file" id="financialEvaluationI" name="financialEvaluationI"><img id="financialEvaluationIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $financialEvaluationI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="financialEvaluationIButton">Open File</button></a> 
                                                   <label class="date-label" id="financialEvaluationIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($financialEvaluationI, strrpos($financialEvaluationI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "financialEvaluationISelect" name = "financialEvaluationISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="financialEvaluationIDesc" name = "financialEvaluationIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:135%"><b><u>SIGNING OF APPROVAL</u></b></label></div>
                                             </div>
                                          </div>
                                            <!-- SIGNED LETTER OF APPROVAL -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>&#x2022; SIGNED LETTER OF APPROVAL </b></label>
                                                   <input type="file" id="signedLetterI" name="signedLetterI"><img id="signedLetterIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLetterI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterIButton">Open File</button></a>
                                                   <label class="date-label" id="signedLetterIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterI, strrpos($signedLetterI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "signedLetterISelect" name = "signedLetterISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterIDesc" name = "signedLetterIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- END BUYER SECTION -->
                                          <div class="endBuyerUnder" id="endBuyerUnder" style="display:none;">
                                              <!-- SIGNED LETTER OF UNDERTAKING -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2 mt-3">
                                                      <label class="individual-labels"><b>&#x2022; SIGNED LETTER OF UNDERTAKING </b></label>
                                                      <input type="file" id="signedLetterUnderEndI" name="signedLetterUnderEndI"><img id="signedLetterUnderEndIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedLetterUnderEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterUnderEndIButton">Open File</button></a>
                                                      <label class="date-label" id="signedLetterUnderEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterUnderEndI, strrpos($signedLetterUnderEndI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mt-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedLetterUnderEndISelect" name = "signedLetterUnderEndISelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterUnderEndIDesc" name = "signedLetterUnderEndIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><b><u>SIGNING OF LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE</u></b></label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>&#x2022; SIGNED LOAN APPROVAL MEMO </b></label>
                                                   <input type="file" id="signedLoanMemoI" name="signedLoanMemoI"><img id="signedLoanMemoIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLoanMemoI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLoanMemoIButton">Open File</button></a>
                                                   <label class="date-label" id="signedLoanMemoIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLoanMemoI, strrpos($signedLoanMemoI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedLoanMemoISelect" name = "signedLoanMemoISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   <input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLoanMemoIDesc" name = "signedLoanMemoIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- Not End Buyer Section -->
                                          <div class="notEndBuyer" id="notEndBuyer" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><b><u>SIGNING OF REM CONTRACT</u></b></label></div>
                                                </div>
                                             </div>
                                             <!-- SIGNED REAL ESTATE MORTGAGE CONTRACT --> 
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels"><b>&#x2022; SIGNED REAL ESTATE MORTGAGE CONTRACT</b></label>
                                                      <input type="file" id="remContractI" name="remContractI"><img id="remContractIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractIButton">Open File</button></a>
                                                      <label class="date-label" id="remContractIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractI, strrpos($remContractI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "remContractISelect" name = "remContractISelect"  >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractIDesc" name = "remContractIDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><b><u>REGISTRATION IN REGISTRY OF DEEDS</u></b></label></div>
                                                </div>
                                             </div>
                                             <!-- REM CONTRACT ANNOTATED -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels"><b>&#x2022; REM CONTRACT ANNOTATED</b></label>
                                                      <input type="file" id="remContractAnnotatedI" name="remContractAnnotatedI"><img id="remContractAnnotatedIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractAnnotatedI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractAnnotatedIButton">Open File</button></a>
                                                      <label class="date-label" id="remContractAnnotatedIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractAnnotatedI, strrpos($remContractAnnotatedI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "remContractAnnotatedISelect" name = "remContractAnnotatedISelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractAnnotatedIDesc" name = "remContractAnnotatedIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><b><u>SIGNED DOCUMENTS AFTER THE RELEASE OF THE LOAN</u></b></label></div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels"><b>&#x2022; PROMISSORY NOTE </b></label>
                                                      <input type="file" id="promNoteI" name="promNoteI"><img id="promNoteIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteIButton">Open File</button></a> 
                                                      <label class="date-label" id="promNoteIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteI, strrpos($promNoteI, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "promNoteISelect" name = "promNoteISelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteIDesc" name = "promNoteIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels"><b>&#x2022; DISCLOSURE STATEMENT </b></label>
                                                      <input type="file" id="disclosureStateI" name="disclosureStateI"><img id="disclosureStateIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateIButton">Open File</button></a>
                                                      <label class="date-label" id="disclosureStateIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateI, strrpos($disclosureStateI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "disclosureStateISelect" name = "disclosureStateISelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateIDesc" name = "disclosureStateIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- MRI FORM (COUNTRY BANKERS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels"><b>&#x2022; MRI FORM (COUNTRY BANKERS) </b></label>
                                                      <input type="file" id="mriFormI" name="mriFormI"><img id="mriFormIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormIButton">Open File</button></a>
                                                      <label class="date-label" id="mriFormIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormI, strrpos($mriFormI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "mriFormISelect" name = "mriFormISelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormIDesc" name = "mriFormIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels"><b>&#x2022; AMORTIZATION SCHEDULE</b></label>
                                                      <input type="file" id="amortScheduleI" name="amortScheduleI"><img id="amortScheduleIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleIButton">Open File</button></a>
                                                      <label class="date-label" id="amortScheduleIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleI, strrpos($amortScheduleI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "amortScheduleISelect" name = "amortScheduleISelect" >
                                                         <option selected value= "NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleIDesc" name = "amortScheduleIDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                          <div class="endBuyer" id="endBuyer" style="display:none">
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><b><u>SIGNING OF REM CONTRACT AND DOCUMENTS FOR LOAN RELEASES</u></b></label></div>
                                             </div>
                                          </div>
                                           <!-- REAL ESTATE MORTGATE CONTRACT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>&#x2022; REAL ESTATE MORTGAGE CONTRACT </b></label>
                                                   <input type="file" id="remContractEndI" name="remContractEndI"><img id="remContractEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $remContractEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractEndIButton">Open File</button></a>
                                                   <label class="date-label" id="remContractEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractEndI, strrpos($remContractEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "remContractEndISelect" name = "remContractEndISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractEndIDesc" name = "remContractEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                            <!-- PROMISSORY NOTE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>&#x2022; PROMISSORY NOTE </b></label>
                                                   <input type="file" id="promNoteEndI" name="promNoteEndI"><img id="promNoteEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $promNoteEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteEndIButton">Open File</button></a> 
                                                   <label class="date-label" id="promNoteEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteEndI, strrpos($promNoteEndI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "promNoteEndISelect" name = "promNoteEndISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteEndIDesc" name = "promNoteEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- DISCLOSURE STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>&#x2022; DISCLOSURE STATEMENT </b></label>
                                                   <input type="file" id="disclosureStateEndI" name="disclosureStateEndI"><img id="disclosureStateEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $disclosureStateEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateEndIButton">Open File</button></a>
                                                   <label class="date-label" id="disclosureStateEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateEndI, strrpos($disclosureStateEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "disclosureStateEndISelect" name = "disclosureStateEndISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateEndIDesc" name = "disclosureStateEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- MRI FORM (COUNTRY BANKERS) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>&#x2022; MRI FORM (COUNTRY BANKERS) </b></label>
                                                   <input type="file" id="mriFormEndI" name="mriFormEndI"><img id="mriFormEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $mriFormEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormEndIButton">Open File</button></a>
                                                   <label class="date-label" id="mriFormEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormEndI, strrpos($mriFormEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "mriFormEndISelect" name = "mriFormEndISelect"  >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormEndIDesc" name = "mriFormEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- AMORTIZATION SCHEDULE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels"><b>&#x2022; AMORTIZATION SCHEDULE</b></label>
                                                   <input type="file" id="amortScheduleEndI" name="amortScheduleEndI"><img id="amortScheduleEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $amortScheduleEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleEndIButton">Open File</button></a>
                                                   <label class="date-label" id="amortScheduleEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleEndI, strrpos($amortScheduleEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "amortScheduleEndISelect" name = "amortScheduleEndISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleEndIDesc" name = "amortScheduleEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><b><u>SIGNING OF DOCUMENTS TO SUNTRUST PROPERTIES INC. EXCHANGING TO DEED OF UNDERTAKING</u></b></label></div>
                                             </div>
                                          </div>
                                           <!-- SIGNED DEED OF UNDERTAKING -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <label class="individual-labels"><b>&#x2022; SIGNED DEED of UNDERTAKING </b></label>
                                                   <input type="file" id="signedDeedUnderEndI" name="signedDeedUnderEndI"><img id="signedDeedUnderEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedDeedUnderEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedDeedUnderEndIButton">Open File</button></a></label>
                                                   <label class="date-label" id="signedDeedUnderEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedDeedUnderEndI, strrpos($signedDeedUnderEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedDeedUnderEndISelect" name = "signedDeedUnderEndISelect" >
                                                      <option selected value= "NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedDeedUnderEndIDesc" name = "signedDeedUnderEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                              <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><b><u>LOAN UTILIZATION REPORT</u></b></label></div>
                                              </div>
                                           </div>
                                           <!-- LOAN UTILIZATION REPORT-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="micro-labels"><b>&#x2022; LOAN UTILIZATION</b></label>
                                                      <input type="file" id="utilization" name="utilization"><img id="utilizationImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $utilization; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="utilizationButton">Open File</button></a>
                                                      <label class="date-label" id="utilizationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($utilization, strrpos($utilization, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select id="utilizationSelect" name= "utilizationSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                         <option selected value="NULL"><b>Option</b></option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;
                                                      <input type="text" id="utilizationDesc" name = "utilizationDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                              <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><b><u>PRESENTATION DOCUMENTS</u></b></label></div>
                                              </div>
                                           </div>
                                           <!-- POWERPOINT CI AND APPRAISAL REPORT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="micro-labels"><b>&#x2022; POWERPOINT CI AND <br> &nbsp; APPRAISAL REPORT</b></label>
                                                      <input type="file" id="powerpoint" name="powerpoint"><img id="powerpointImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $powerpoint; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="powerpointButton">Open File</button></a>
                                                      <label class="date-label" id="powerpointDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerpoint, strrpos($powerpoint, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- EXCEL CASHFLOW ANALYSIS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="micro-labels"><b>&#x2022; EXCEL CASHFLOW ANALYSIS  </b></label>
                                                      <input type="file" id="excel" name="excel"><img id="excelImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $excel; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="excelButton">Open File</button></a>
                                                      <label class="date-label" id="excelDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($excel, strrpos($excel, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                             </div>
                                       <div class="row">
                                             <div class="col-8">
                                                 <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.4em">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><b><u>OTHERS</u></b></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class ="OTHERS">
                                           <!-- SPECIAL POWER OF ATTORNEY (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="powerAttorneyICheck" name="powerAttorneyICheck" >
                                                   <label class ="individual-labels" id="tab-label" for="powerAttorneyICheck"><b>SPECIAL POWER OF ATTORNEY</b></label>
                                                   <input type="file" id="powerAttorneyI" name="powerAttorneyI" ><img id="powerAttorneyIImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $powerAttorneyI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="powerAttorneyIButton" >Open File</button></a>
                                                   <label class="date-label" id="powerAttorneyIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerAttorneyI, strrpos($powerAttorneyI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "powerAttorneyISelect" name = "powerAttorneyISelect" >
                                                      <option selected value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="powerAttorneyIDesc" name = "powerAttorneyIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- GENERAL INFORMATION SHEET (IF APPLICABLE)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="generalInfoCheck" name="generalInfoCheck">
                                                   <label class ="individual-labels" id="tab-label" for="generalInfoCheck"><b> GENERAL INFORMATION SHEET</b></label>
                                                   <input type="file" id="generalInfo" name="generalInfo"><img id="generalInfoImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $generalInfo; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="generalInfoButton" >Open File</button></a>
                                                   <label class="date-label" id="generalInfoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($generalInfo, strrpos($generalInfo, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "generalInfoSelect" name = "generalInfoSelect" >
                                                      <option selected value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="generalInfoDesc" name = "generalInfoDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- SECURITY EXCHANGE COMMISSION (SEC) WITH ARTICLES AND BY LAW (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="securityExchangeCheck" name="securityExchangeCheck">
                                                   <label class ="individual-labels" id="tab-label" for="securityExchangeCheck"><b> SECURITY EXCHANGE COMMISSION (SEC) WITH ARTICLES AND BY LAW </b></label> 
                                                   <input type="file" id="securityExchange" name="securityExchange"><img id="securityExchangeImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $securityExchange; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="securityExchangeButton" >Open File</button></a>
                                                   <label class="date-label" id="securityExchangeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($securityExchange, strrpos($securityExchange, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "securityExchangeSelect" name = "securityExchangeSelect" >
                                                      <option selected  value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="securityExchangeDesc" name = "securityExchangeDesc" >
                                                </div>
                                             </div>
                                          </div>
                                           <!-- LETTER OF GUARANTEE (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="letterGuaranteeCheck" name="letterGuaranteeCheck">
                                                   <label class ="individual-labels" id="tab-label" for="letterGuaranteeCheck"><b>LETTER OF GUARANTEE</b></label> 
                                                   <input type="file" id="letterGuarantee" name="letterGuarantee"><img id="letterGuaranteeImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $letterGuarantee; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="letterGuaranteeButton" >Open File</button></a>
                                                   <label class="date-label" id="letterGuaranteeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($letterGuarantee, strrpos($letterGuarantee, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "letterGuaranteeSelect" name = "letterGuaranteeSelect" >
                                                      <option selected value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="letterGuaranteeDesc" name = "letterGuaranteeDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!--ORIGINAL BOARD RESOLUTION AND NOTARIZED SECRETARY CERTIFICATE (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="boardResolutionCheck" name="boardResolutionCheck">
                                                   <label class ="individual-labels" id="tab-label" for="boardResolutionCheck"><b> ORIGINAL BOARD RESOLUTION AND NOTARIZED SECRETARY CERTIFICATE</b></label>
                                                   <input type="file" id="boardResolution" name="boardResolution"><img id="boardResolutionImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $boardResolution; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="boardResolutionButton" >Open File</button></a>
                                                   <label class="date-label" id="boardResolutionDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($boardResolution, strrpos($boardResolution, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "boardResolutionSelect" name = "boardResolutionSelect" >
                                                      <option selected  value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="boardResolutionDesc" name = "boardResolutionDesc" >
                                                </div>
                                             </div>
                                          </div>
                                           <!-- STATEMENT OF ACCOUNT (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="statementAccountICheck" name="statementAccountICheck">
                                                   <label class ="individual-labels" id="tab-label" for="statementAccountICheck"><b> STATEMENT OF ACCOUNT</b></label>
                                                   <input type="file" id="statementAccountI" name="statementAccountI"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $statementAccountI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountIButton" >Open File</button></a>
                                                   <label class="date-label" id="statementAccountIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccountI, strrpos($statementAccountI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "statementAccountISelect" name = "statementAccountISelect" >
                                                      <option selected  value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="statementAccountIDesc" name = "statementAccountIDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BILL/COST OF MATERIALS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="billMaterialCheck" name="billMaterialCheck">
                                                   <label class ="individual-labels" id="tab-label" for="billMaterialCheck"><b>BILL/COST OF MATERIALS</b></label>
                                                   <input type="file" id="billMaterial" name="billMaterial"><img id="billMaterialImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $billMaterial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="billMaterialButton" >Open File</button></a>
                                                   <label class="date-label" id="billMaterialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($billMaterial, strrpos($billMaterial, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "billMaterialSelect" name = "billMaterialSelect" >
                                                      <option selected  value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="billMaterialDesc" name = "billMaterialDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PROPOSED PERSPECTIVE PLAN -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="proposedPlanCheck" name="proposedPlanCheck">
                                                   <label class ="individual-labels" id="tab-label" for="proposedPlanCheck"><b>PROPOSED PERSPECTIVE PLAN</b></label>
                                                   <input type="file" id="proposedPlan" name="proposedPlan"><img id="proposedPlanImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $proposedPlan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proposedPlanButton" >Open File</button></a>
                                                   <label class="date-label" id="proposedPlanDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proposedPlan, strrpos($proposedPlan, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "proposedPlanSelect" name = "proposedPlanSelect" >
                                                      <option selected  value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proposedPlanDesc" name = "proposedPlanDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- OTHER DOCUMENTS-->
                                          <div class="row" style="margin-bottom:-1.7%; height:3em;">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="otherDocCheck" name="otherDocCheck">
                                                   <label class ="individual-labels" id="tab-label" for="otherDocCheck"><b>OTHER DOCUMENTS</b></label>
                                                   <input type="file" id="otherDoc" name="otherDoc"><img id="otherDocImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $proposedPlan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherDocButton" >Open File</button></a>
                                                   <label class="date-label" id="otherDocDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherDoc, strrpos($otherDoc, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherDocSelect" name = "otherDocSelect" tabindex="-1">
                                                      <option selected  value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="otherDocDesc" name = "otherDocDesc" >
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  var remType = "<?php echo $remType; ?>";
  var sourceIncome = "<?php echo $sourceIncome; ?>";

  if (remType === "End Buyer") {
    $('#endBuyer, #endBuyerUnder, #suntrustDocuments').show();
    if (sourceIncome === "Business"){
      document.getElementById("businessSpace").style.height="21.4em";
    }
    else{
      document.getElementById("endBuyerSpace").style.height="37em";
    }
  } else {
   $('#notEndBuyer, #collateralDocuments').show();
      if (sourceIncome === "Business"){
      document.getElementById("businessSpace").style.height="17.8em";
    }
    else{
      document.getElementById("notEndBuyerSpace").style.height="33em";
    }

  }

  if (sourceIncome === "Business") {
    $('#businessProofIncome, #businessProofIncomeSelect').show();
  } else {
    $('#employedProofIncome, #employedProofIncomeSelect').show();
  }
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

// INDIVIDUAL TEXT FIELD, IF YOU SELECT INCOMPLETE IT WILL DISPLAY TEXTFIELD

// PRINCIPAL BORROWER
handleSelectChange('endorsementSelect', 'endorsementDesc');
handleSelectChange('loanAppFormISelect', 'loanAppFormIDesc');
handleSelectChange('photocopyIdSignaturesSelect', 'photocopyIdSignaturesDesc');
handleSelectChange('proofBillingSelect', 'proofBillingDesc');
handleSelectChange('personalBankSelect', 'personalBankDesc');
handleSelectChange('marriageContractSelect', 'marriageContractDesc');
handleSelectChange('barangayClearanceSelect', 'barangayClearanceDesc');
// COLLATERAL DOCUMENTS
handleSelectChange('transferCertificateSelect', 'transferCertificateDesc');
handleSelectChange('taxDeclarationLotSelect', 'taxDeclarationLotDesc');
handleSelectChange('taxDeclarationImpSelect', 'taxDeclarationImpDesc');
handleSelectChange('realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
handleSelectChange('realEstateTaxReceiptSelect', 'realEstateTaxReceiptDesc');
handleSelectChange('cancellationDischargeSelect', 'cancellationDischargeDesc');
// SUNTRUST DOCUMENTS
handleSelectChange('sunTransferCertificateSelect', 'sunTransferCertificateDesc');
handleSelectChange('sunTaxDeclarationLotSelect', 'sunTaxDeclarationLotDesc');
handleSelectChange('sunTaxDeclarationImpSelect', 'sunTaxDeclarationImpDesc');
handleSelectChange('sunContractSellSelect', 'sunContractSellDesc');
handleSelectChange('sunStatementAccountSelect', 'sunStatementAccountDesc');
// BUSINESS PROOF OF INCOME
handleSelectChange('updatedBusinessSelect', 'updatedBusinessDesc');
handleSelectChange('auditedFinancialSelect', 'auditedFinancialDesc');
handleSelectChange('inhouseFinancialSelect', 'inhouseFinancialDesc');
handleSelectChange('businessBankStatementSelect', 'businessBankStatementDesc');
handleSelectChange('salesRecordSelect', 'salesRecordDesc');
handleSelectChange('incomeTaxReturnSelect', 'incomeTaxReturnDesc');
handleSelectChange('contractLeaseSelect', 'contractLeaseDesc');
handleSelectChange('customerNumberSelect', 'customerNumberDesc');
handleSelectChange('customerSupplierSelect', 'customerSupplierDesc');
handleSelectChange('otherIncomeBSelect', 'otherIncomeBDesc');
// EMPLOYED PROOF OF INCOME
handleSelectChange('employmentContractSelect', 'employmentContractDesc');
handleSelectChange('certificateEmploymentSelect', 'certificateEmploymentDesc');
handleSelectChange('incomeTaxSelect', 'incomeTaxDesc');
handleSelectChange('payslipMonthsSelect', 'payslipMonthsDesc');
handleSelectChange('otherIncomeSelect', 'otherIncomeDesc');
// OTHERS
handleSelectChange('powerAttorneyISelect', 'powerAttorneyIDesc');
handleSelectChange('generalInfoSelect', 'generalInfoDesc');
handleSelectChange('securityExchangeSelect', 'securityExchangeDesc');
handleSelectChange('letterGuaranteeSelect', 'letterGuaranteeDesc');
handleSelectChange('boardResolutionSelect', 'boardResolutionDesc');
handleSelectChange('statementAccountISelect', 'statementAccountIDesc');
handleSelectChange('billMaterialSelect', 'billMaterialDesc');
handleSelectChange('proposedPlanSelect', 'proposedPlanDesc');
handleSelectChange('otherDocSelect', 'otherDocDesc');
// DOCUMENTS
handleSelectChange('receiptSelect', 'receiptDesc');
handleSelectChange('creditInvestigationReportISelect', 'creditInvestigationReportIDesc');
handleSelectChange('collateralAppraisalReportISelect', 'collateralAppraisalReportIDesc');
handleSelectChange('financialEvaluationISelect', 'financialEvaluationIDesc');
handleSelectChange('signedLetterISelect', 'signedLetterIDesc');
handleSelectChange('signedLetterUnderEndISelect', 'signedLetterUnderEndIDesc');
handleSelectChange('signedLoanMemoISelect', 'signedLoanMemoIDesc');
handleSelectChange('remContractISelect', 'remContractIDesc');
handleSelectChange('remContractAnnotatedISelect', 'remContractAnnotatedIDesc');
handleSelectChange('promNoteISelect', 'promNoteIDesc');
handleSelectChange('disclosureStateISelect', 'disclosureStateIDesc');
handleSelectChange('mriFormISelect', 'mriFormIDesc');
handleSelectChange('amortScheduleISelect', 'amortScheduleIDesc');
handleSelectChange('remContractEndISelect', 'remContractEndIDesc');
handleSelectChange('promNoteEndISelect', 'promNoteEndIDesc');
handleSelectChange('disclosureStateEndISelect', 'disclosureStateEndIDesc');
handleSelectChange('mriFormEndISelect', 'mriFormEndIDesc');
handleSelectChange('amortScheduleEndISelect', 'amortScheduleEndIDesc');
handleSelectChange('signedDeedUnderEndISelect', 'signedDeedUnderEndIDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');

</script>

<!-- individual Form -->
<script>
var indivForm = document.getElementById("individual-form");
var indivId = "<?php echo $id; ?>";
var fullname = "<?php echo $fullname; ?>";
var salaryType = "<?php echo $type; ?>";
var branch = "<?php echo $branch; ?>";
var loanType = "<?php echo $loanType; ?>";

function uploadFileI() {
  var indivformData = new FormData(indivForm);
  indivformData.append('indivId',indivId);
  indivformData.append('fullname',fullname);
  indivformData.append('salaryType',salaryType);
  indivformData.append('branch',branch);
  indivformData.append('loanType',loanType);
  $.ajax({
    url: 'loanIndividualUploadData.php', 
    type: 'POST',
    data: indivformData,
    processData: false,
    contentType: false,
    
    success: function(response) {
// Automatically adds a Check Icon whenever you select Image from your local
// FOR LOAN APPLICATION:
updateFileStatus('endorsement', 'endorsementImage');
updateFileStatus('loanAppFormI', 'loanAppFormIImage');
updateFileStatus('photocopyIdSignatures', 'photocopyIdSignaturesImage');
updateFileStatus('proofBilling', 'proofBillingImage');
updateFileStatus('personalBank', 'personalBankImage');
updateFileStatus('marriageContract', 'marriageContractImage');
updateFileStatus('barangayClearance', 'barangayClearanceImage');
// FOR PROPERTY-RELATED DOCUMENTS:
updateFileStatus('transferCertificate', 'transferCertificateImage');
updateFileStatus('taxDeclarationLot', 'taxDeclarationLotImage');
updateFileStatus('taxDeclarationImp', 'taxDeclarationImpImage');
updateFileStatus('realEstateTaxClearance', 'realEstateTaxClearanceImage');
updateFileStatus('realEstateTaxReceipt', 'realEstateTaxReceiptImage');
updateFileStatus('cancellationDischarge', 'cancellationDischargeImage');
// FOR SUN-RELATED DOCUMENTS:
updateFileStatus('sunTransferCertificate', 'sunTransferCertificateImage');
updateFileStatus('sunTaxDeclarationLot', 'sunTaxDeclarationLotImage');
updateFileStatus('sunTaxDeclarationImp', 'sunTaxDeclarationImpImage');
updateFileStatus('sunContractSell', 'sunContractSellImage');
updateFileStatus('sunStatementAccount', 'sunStatementAccountImage');
// FOR BUSINESS-RELATED DOCUMENTS:
updateFileStatus('updatedBusiness', 'updatedBusinessImage');
updateFileStatus('auditedFinancial', 'auditedFinancialImage');
updateFileStatus('inhouseFinancial', 'inhouseFinancialImage');
updateFileStatus('businessBankStatement', 'businessBankStatementImage');
updateFileStatus('salesRecord', 'salesRecordImage');
updateFileStatus('incomeTaxReturn', 'incomeTaxReturnImage');
updateFileStatus('contractLease', 'contractLeaseImage');
updateFileStatus('customerNumber', 'customerNumberImage');
updateFileStatus('customerSupplier', 'customerSupplierImage');
updateFileStatus('otherIncomeB', 'otherIncomeBImage');
// FOR EMPLOYMENT-RELATED DOCUMENTS:
updateFileStatus('employmentContract', 'employmentContractImage');
updateFileStatus('certificateEmployment', 'certificateEmploymentImage');
updateFileStatus('incomeTax', 'incomeTaxImage');
updateFileStatus('payslipMonths', 'payslipMonthsImage');
updateFileStatus('otherIncome', 'otherIncomeImage');
// OTHERS
updateFileStatus('powerAttorneyI', 'powerAttorneyIImage');
updateFileStatus('generalInfo', 'generalInfoImage');
updateFileStatus('securityExchange', 'securityExchangeImage');
updateFileStatus('letterGuarantee', 'letterGuaranteeImage');
updateFileStatus('boardResolution', 'boardResolutionImage');
updateFileStatus('statementAccountI', 'statementAccountImage');
updateFileStatus('billMaterial', 'billMaterialImage');
updateFileStatus('proposedPlan', 'proposedPlanImage');
updateFileStatus('otherDoc', 'otherDocImage');
// DOCUMENTS SECTION
updateFileStatus('receipt', 'receiptImage');
updateFileStatus('creditInvestigationReportI', 'creditInvestigationReportIImage');
updateFileStatus('collateralAppraisalReportI', 'collateralAppraisalReportIImage');
updateFileStatus('financialEvaluationI', 'financialEvaluationIImage');
updateFileStatus('signedLetterI', 'signedLetterIImage');
updateFileStatus('signedLetterUnderEndI', 'signedLetterUnderEndIImage');
updateFileStatus('signedLoanMemoI', 'signedLoanMemoIImage');
updateFileStatus('remContractI', 'remContractIImage');
updateFileStatus('remContractAnnotatedI', 'remContractAnnotatedIImage');
updateFileStatus('remContractEndI', 'remContractEndIImage');
updateFileStatus('promNoteI', 'promNoteIImage');
updateFileStatus('promNoteEndI', 'promNoteEndIImage');
updateFileStatus('disclosureStateI', 'disclosureStateIImage');
updateFileStatus('disclosureStateEndI', 'disclosureStateEndIImage');
updateFileStatus('mriFormI', 'mriFormIImage');
updateFileStatus('mriFormEndI', 'mriFormEndIImage');
updateFileStatus('amortScheduleI', 'amortScheduleIImage');
updateFileStatus('amortScheduleEndI', 'amortScheduleEndIImage');
updateFileStatus('signedDeedUnderEndI', 'signedDeedUnderEndIImage');
updateFileStatus('utilization', 'utilizationImage');
updateFileStatus('powerpoint', 'powerpointImage');
updateFileStatus('excel', 'excelImage');
    },
    error: function(xhr, status, error) {
      console.log('File upload failed');
    }
  });
}

indivForm.addEventListener("change", function() {
  uploadFileI();
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
// PRINCIPAL BORROWER
selectOptionBasedOnValue('<?php echo $endorsementSelect; ?>', 'endorsementSelect','endorsementDesc');
selectOptionBasedOnValue('<?php echo $loanAppFormISelect; ?>', 'loanAppFormISelect','loanAppFormIDesc');
selectOptionBasedOnValue('<?php echo $photocopyIdSignaturesSelect; ?>', 'photocopyIdSignaturesSelect','photocopyIdSignaturesDesc');
selectOptionBasedOnValue('<?php echo $proofBillingSelect; ?>', 'proofBillingSelect','proofBillingDesc');
selectOptionBasedOnValue('<?php echo $personalBankSelect; ?>', 'personalBankSelect','personalBankDesc');
selectOptionBasedOnValue('<?php echo $marriageContractSelect; ?>', 'marriageContractSelect','marriageContractDesc');
selectOptionBasedOnValue('<?php echo $barangayClearanceSelect; ?>', 'barangayClearanceSelect','barangayClearanceDesc');
// COLLATERAL DOCUMENTS
selectOptionBasedOnValue('<?php echo $transferCertificateSelect; ?>', 'transferCertificateSelect','transferCertificateDesc');
selectOptionBasedOnValue('<?php echo $taxDeclarationLotSelect; ?>', 'taxDeclarationLotSelect','taxDeclarationLotDesc');
selectOptionBasedOnValue('<?php echo $taxDeclarationImpSelect; ?>', 'taxDeclarationImpSelect','taxDeclarationImpDesc');
selectOptionBasedOnValue('<?php echo $realEstateTaxClearanceSelect; ?>', 'realEstateTaxClearanceSelect','realEstateTaxClearanceDesc');
selectOptionBasedOnValue('<?php echo $realEstateTaxReceiptSelect; ?>', 'realEstateTaxReceiptSelect','realEstateTaxReceiptDesc');
selectOptionBasedOnValue('<?php echo $cancellationDischargeSelect; ?>', 'cancellationDischargeSelect','cancellationDischargeDesc');
// SUNTRUST DOCUMENTS
selectOptionBasedOnValue('<?php echo $sunTransferCertificateSelect; ?>', 'sunTransferCertificateSelect','sunTransferCertificateDesc');
selectOptionBasedOnValue('<?php echo $sunTaxDeclarationLotSelect; ?>', 'sunTaxDeclarationLotSelect','sunTaxDeclarationLotDesc');
selectOptionBasedOnValue('<?php echo $sunTaxDeclarationImpSelect; ?>', 'sunTaxDeclarationImpSelect','sunTaxDeclarationImpDesc');
selectOptionBasedOnValue('<?php echo $sunContractSellSelect; ?>', 'sunContractSellSelect','sunContractSellDesc');
selectOptionBasedOnValue('<?php echo $sunStatementAccountSelect; ?>', 'sunStatementAccountSelect','sunStatementAccountDesc');
// BUSINESS PROOF OF INCOME
selectOptionBasedOnValue('<?php echo $updatedBusinessSelect; ?>', 'updatedBusinessSelect','updatedBusinessDesc');
selectOptionBasedOnValue('<?php echo $auditedFinancialSelect; ?>', 'auditedFinancialSelect','auditedFinancialDesc');
selectOptionBasedOnValue('<?php echo $inhouseFinancialSelect; ?>', 'inhouseFinancialSelect','inhouseFinancialDesc');
selectOptionBasedOnValue('<?php echo $businessBankStatementSelect; ?>', 'businessBankStatementSelect','businessBankStatementDesc');
selectOptionBasedOnValue('<?php echo $salesRecordSelect; ?>', 'salesRecordSelect','salesRecordDesc');
selectOptionBasedOnValue('<?php echo $incomeTaxReturnSelect; ?>', 'incomeTaxReturnSelect','incomeTaxReturnDesc');
selectOptionBasedOnValue('<?php echo $contractLeaseSelect; ?>', 'contractLeaseSelect','contractLeaseDesc');
selectOptionBasedOnValue('<?php echo $customerNumberSelect; ?>', 'customerNumberSelect','customerNumberDesc');
selectOptionBasedOnValue('<?php echo $customerSupplierSelect; ?>', 'customerSupplierSelect','customerSupplierDesc');
selectOptionBasedOnValue('<?php echo $otherIncomeBSelect; ?>', 'otherIncomeBSelect','otherIncomeBDesc');
// EMPLOYED PROOF OF INCOME
selectOptionBasedOnValue('<?php echo $employmentContractSelect; ?>', 'employmentContractSelect','employmentContractDesc');
selectOptionBasedOnValue('<?php echo $certificateEmploymentSelect; ?>', 'certificateEmploymentSelect','certificateEmploymentDesc');
selectOptionBasedOnValue('<?php echo $incomeTaxSelect; ?>', 'incomeTaxSelect','incomeTaxDesc');
selectOptionBasedOnValue('<?php echo $payslipMonthsSelect; ?>', 'payslipMonthsSelect','payslipMonthsDesc');
selectOptionBasedOnValue('<?php echo $otherIncomeSelect; ?>', 'otherIncomeSelect','otherIncomeDesc');
// OTHERS
selectOptionBasedOnValue('<?php echo $powerAttorneyISelect; ?>', 'powerAttorneyISelect','powerAttorneyIDesc');
selectOptionBasedOnValue('<?php echo $generalInfoSelect; ?>', 'generalInfoSelect','generalInfoDesc');
selectOptionBasedOnValue('<?php echo $securityExchangeSelect; ?>', 'securityExchangeSelect','securityExchangeDesc');
selectOptionBasedOnValue('<?php echo $letterGuaranteeSelect; ?>', 'letterGuaranteeSelect','letterGuaranteeDesc');
selectOptionBasedOnValue('<?php echo $boardResolutionSelect; ?>', 'boardResolutionSelect','boardResolutionDesc');
selectOptionBasedOnValue('<?php echo $statementAccountSelect; ?>', 'statementAccountISelect','statementAccountIDesc');
selectOptionBasedOnValue('<?php echo $billMaterialSelect; ?>', 'billMaterialSelect','billMaterialDesc');
selectOptionBasedOnValue('<?php echo $proposedPlanSelect; ?>', 'proposedPlanSelect','proposedPlanDesc');
selectOptionBasedOnValue('<?php echo $otherDocSelect; ?>', 'otherDocSelect','otherDocDesc');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo $receiptSelect; ?>', 'receiptSelect','receiptDesc');
selectOptionBasedOnValue('<?php echo $creditInvestigationReportISelect; ?>', 'creditInvestigationReportISelect','creditInvestigationReportIDesc');
selectOptionBasedOnValue('<?php echo $collateralAppraisalReportISelect; ?>', 'collateralAppraisalReportISelect','collateralAppraisalReportIDesc');
selectOptionBasedOnValue('<?php echo $financialEvaluationISelect; ?>', 'financialEvaluationISelect','financialEvaluationIDesc');
selectOptionBasedOnValue('<?php echo $signedLetterISelect; ?>', 'signedLetterISelect','signedLetterIDesc');
selectOptionBasedOnValue('<?php echo $signedLoanMemoISelect; ?>', 'signedLoanMemoISelect','signedLoanMemoIDesc');
selectOptionBasedOnValue('<?php echo $remContractISelect; ?>', 'remContractISelect','remContractIDesc');
selectOptionBasedOnValue('<?php echo $promNoteISelect; ?>', 'promNoteISelect','promNoteIDesc');
selectOptionBasedOnValue('<?php echo $disclosureStateISelect; ?>', 'disclosureStateISelect','disclosureStateIDesc');
selectOptionBasedOnValue('<?php echo $mriFormISelect; ?>', 'mriFormISelect','mriFormIDesc');
selectOptionBasedOnValue('<?php echo $remContractAnnotatedISelect; ?>', 'remContractAnnotatedISelect','remContractAnnotatedIDesc');
selectOptionBasedOnValue('<?php echo $signedLetterUnderEndISelect; ?>', 'signedLetterUnderEndISelect','signedLetterUnderEndIDesc');
selectOptionBasedOnValue('<?php echo $remContractEndISelect; ?>', 'remContractEndISelect','remContractEndIDesc');
selectOptionBasedOnValue('<?php echo $promNoteEndISelect; ?>', 'promNoteEndISelect','promNoteEndIDesc');
selectOptionBasedOnValue('<?php echo $disclosureStateEndISelect; ?>', 'disclosureStateEndISelect','disclosureStateEndIDesc');
selectOptionBasedOnValue('<?php echo $mriFormEndISelect; ?>', 'mriFormEndISelect','mriFormEndIDesc');
selectOptionBasedOnValue('<?php echo $signedDeedUnderEndISelect; ?>', 'signedDeedUnderEndISelect','signedDeedUnderEndIDesc');
selectOptionBasedOnValue('<?php echo $amortScheduleISelect; ?>', 'amortScheduleISelect','amortScheduleIDesc');
selectOptionBasedOnValue('<?php echo $amortScheduleEndISelect; ?>', 'amortScheduleEndISelect','amortScheduleEndIDesc');
selectOptionBasedOnValue('<?php echo $utilizationSelect; ?>', 'utilizationSelect','utilizationDesc');


</script>



<script>
function initializeCheckboxes() {  
  var powerAttorneyIValue = "<?php echo $powerAttorneyICheck; ?>";
  var generalInfoValue = "<?php echo $generalInfoCheck; ?>";
  var securityExchangeValue = "<?php echo $securityExchangeCheck; ?>";
  var letterGuaranteeValue = "<?php echo $letterGuaranteeCheck; ?>";
  var boardResolutionValue = "<?php echo $boardResolutionCheck; ?>";
  var statementAccountIValue = "<?php echo $statementAccountICheck; ?>";
  var billMaterialValue = "<?php echo $billMaterialCheck; ?>";
  var proposedPlanValue = "<?php echo $proposedPlanCheck; ?>";
  var otherDocValue = "<?php echo $otherDocCheck; ?>";
  // GET THE CHECKBOX ELEMENTS
  const powerAttorneyICheck = document.getElementById('powerAttorneyICheck');
  const generalInfoCheck = document.getElementById('generalInfoCheck');
  const securityExchangeCheck = document.getElementById('securityExchangeCheck');
  const letterGuaranteeCheck = document.getElementById('letterGuaranteeCheck');
  const boardResolutionCheck = document.getElementById('boardResolutionCheck');
  const statementAccountICheck = document.getElementById('statementAccountICheck');
  const billMaterialCheck = document.getElementById('billMaterialCheck');
  const proposedPlanCheck = document.getElementById('proposedPlanCheck');
  const otherDocCheck = document.getElementById('otherDocCheck');
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

showInput(powerAttorneyIValue, powerAttorneyICheck,'powerAttorneyI', 'powerAttorneyISelect', 'powerAttorneyIDesc',`powerAttorneyIImage` );
showInput(generalInfoValue, generalInfoCheck,'generalInfo', 'generalInfoSelect', 'generalInfoDesc',`generalInfoImage`);
showInput(securityExchangeValue, securityExchangeCheck,'securityExchange', 'securityExchangeSelect', 'securityExchangeDesc',`securityExchangeImage`);
showInput(letterGuaranteeValue, letterGuaranteeCheck, 'letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc',`letterGuaranteeImage`);
showInput(boardResolutionValue, boardResolutionCheck, 'boardResolution', 'boardResolutionSelect', 'boardResolutionDesc',`boardResolutionImage`);
showInput(statementAccountIValue, statementAccountICheck, 'statementAccountI', 'statementAccountISelect', 'statementAccountIDesc',`statementAccountImage`);
showInput(billMaterialValue, billMaterialCheck, 'billMaterial', 'billMaterialSelect', 'billMaterialDesc',`billMaterialImage`);
showInput(proposedPlanValue, proposedPlanCheck,'proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc',`proposedPlanImage`);
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

document.getElementById("powerAttorneyICheck").addEventListener("click", function() {
    toggleVisibility('powerAttorneyI');
});

document.getElementById("generalInfoCheck").addEventListener("click", function() {
    toggleVisibility('generalInfo');
});

document.getElementById("securityExchangeCheck").addEventListener("click", function() {
    toggleVisibility('securityExchange');
});
document.getElementById("letterGuaranteeCheck").addEventListener("click", function() {
    toggleVisibility('letterGuarantee');
});

document.getElementById("boardResolutionCheck").addEventListener("click", function() {
    toggleVisibility('boardResolution');
});

document.getElementById("statementAccountICheck").addEventListener("click", function() {
    toggleVisibility('statementAccountI');

});
document.getElementById("billMaterialCheck").addEventListener("click", function() {
    toggleVisibility('billMaterial');
});

document.getElementById("proposedPlanCheck").addEventListener("click", function() {
    toggleVisibility('proposedPlan');

});
document.getElementById("otherDocCheck").addEventListener("click", function() {
    toggleVisibility('otherDoc');

});

</script>
<script>
// RESET THE VALUE OF SELECT TO ZERO(OPTION)
  function resetIndex(targetId,targetSelect,targetDesc){
  document.getElementById(targetId).addEventListener('change', function() {
  var selectElement = document.getElementById(targetSelect,"loanAppFormIDate");
  selectElement.selectedIndex = 0;
  document.getElementById(targetDesc).style.visibility="hidden"; // Change to the first option
  });
  }
//   PRINCIPAL BORROWER
resetIndex('loanAppFormI', 'loanAppFormISelect', 'loanAppFormIDesc');
resetIndex('photocopyIdSignatures', 'photocopyIdSignaturesSelect', 'photocopyIdSignaturesDesc');
resetIndex('proofBilling', 'proofBillingSelect', 'proofBillingDesc');
resetIndex('personalBank', 'personalBankSelect', 'personalBankDesc');
resetIndex('marriageContract', 'marriageContractSelect', 'marriageContractDesc');
resetIndex('barangayClearance', 'barangayClearanceSelect', 'barangayClearanceDesc');
// COLLATERAL DOCUMENTS
resetIndex('transferCertificate', 'transferCertificateSelect', 'transferCertificateDesc');
resetIndex('taxDeclarationLot', 'taxDeclarationLotSelect', 'taxDeclarationLotDesc');
resetIndex('taxDeclarationImp', 'taxDeclarationImpSelect', 'taxDeclarationImpDesc');
resetIndex('realEstateTaxClearance', 'realEstateTaxClearanceSelect', 'realEstateTaxClearanceDesc');
resetIndex('realEstateTaxReceipt', 'realEstateTaxReceiptSelect', 'realEstateTaxReceiptDesc');
resetIndex('cancellationDischarge', 'cancellationDischargeSelect', 'cancellationDischargeDesc');
// SUNTRUST DOCUMENTS
resetIndex('sunTransferCertificate', 'sunTransferCertificateSelect', 'sunTransferCertificateDesc');
resetIndex('sunTaxDeclarationLot', 'sunTaxDeclarationLotSelect', 'sunTaxDeclarationLotDesc');
resetIndex('sunTaxDeclarationImp', 'sunTaxDeclarationImpSelect', 'sunTaxDeclarationImpDesc');
resetIndex('sunContractSell', 'sunContractSellSelect', 'sunContractSellDesc');
resetIndex('sunStatementAccount', 'sunStatementAccountSelect', 'sunStatementAccountDesc');
// BUSINESS PROOF OF INCOME
resetIndex('updatedBusiness', 'updatedBusinessSelect', 'updatedBusinessDesc');
resetIndex('auditedFinancial', 'auditedFinancialSelect', 'auditedFinancialDesc');
resetIndex('inhouseFinancial', 'inhouseFinancialSelect', 'inhouseFinancialDesc');
resetIndex('businessBankStatement', 'businessBankStatementSelect', 'businessBankStatementDesc');
resetIndex('salesRecord', 'salesRecordSelect', 'salesRecordDesc');
resetIndex('incomeTaxReturn', 'incomeTaxReturnSelect', 'incomeTaxReturnDesc');
resetIndex('contractLease', 'contractLeaseSelect', 'contractLeaseDesc');
resetIndex('customerNumber', 'customerNumberSelect', 'customerNumberDesc');
resetIndex('customerSupplier', 'customerSupplierSelect', 'customerSupplierDesc');
// EMPLOYED PROOF OF INCOME
resetIndex('employmentContract', 'employmentContractSelect', 'employmentContractDesc');
resetIndex('certificateEmployment', 'certificateEmploymentSelect', 'certificateEmploymentDesc');
resetIndex('incomeTax', 'incomeTaxSelect', 'incomeTaxDesc');
resetIndex('payslipMonths', 'payslipMonthsSelect', 'payslipMonthsDesc');
// OTHERS
resetIndex('powerAttorneyI', 'powerAttorneyISelect', 'powerAttorneyIDesc');
resetIndex('generalInfo', 'generalInfoSelect', 'generalInfoDesc');
resetIndex('securityExchange', 'securityExchangeSelect', 'securityExchangeDesc');
resetIndex('letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc');
resetIndex('boardResolution', 'boardResolutionSelect', 'boardResolutionDesc');
resetIndex('statementAccountI', 'statementAccountISelect', 'statementAccountIDesc');
resetIndex('billMaterial', 'billMaterialSelect', 'billMaterialDesc');
resetIndex('proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc');
resetIndex('otherDoc', 'otherDocSelect', 'otherDocDesc');
// DOCUMENTS
resetIndex('creditInvestigationReportI', 'creditInvestigationReportISelect', 'creditInvestigationReportIDesc');
resetIndex('collateralAppraisalReportI', 'collateralAppraisalReportISelect', 'collateralAppraisalReportIDesc');
resetIndex('financialEvaluationI', 'financialEvaluationISelect', 'financialEvaluationIDesc');
resetIndex('signedLetterI', 'signedLetterISelect', 'signedLetterIDesc');
resetIndex('signedLoanMemoI', 'signedLoanMemoISelect', 'signedLoanMemoIDesc');
resetIndex('remContractI', 'remContractISelect', 'remContractIDesc');
resetIndex('promNoteI', 'promNoteISelect', 'promNoteIDesc');
resetIndex('disclosureStateI', 'disclosureStateISelect', 'disclosureStateIDesc');
resetIndex('mriFormI', 'mriFormISelect', 'mriFormIDesc');
resetIndex('remContractAnnotatedI', 'remContractAnnotatedISelect', 'remContractAnnotatedIDesc');
resetIndex('signedLetterUnderEndI', 'signedLetterUnderEndISelect', 'signedLetterUnderEndIDesc');
resetIndex('remContractEndI', 'remContractEndISelect', 'remContractEndIDesc');
resetIndex('promNoteEndI', 'promNoteEndISelect', 'promNoteEndIDesc');
resetIndex('disclosureStateEndI', 'disclosureStateEndISelect', 'disclosureStateEndIDesc');
resetIndex('mriFormEndI', 'mriFormEndISelect', 'mriFormEndIDesc');
resetIndex('signedDeedUnderEndI', 'signedDeedUnderEndISelect', 'signedDeedUnderEndIDesc');
resetIndex('loanAppFormI', 'loanAppFormISelect', 'loanAppFormIDesc');
resetIndex('amortScheduleI', 'amortScheduleISelect', 'amortScheduleIDesc');
resetIndex('amortScheduleEndI', 'amortScheduleEndISelect', 'amortScheduleEndIDesc');
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
// PRINCIPAL BORROWER
setFileVisibility("<?php echo $endorsement; ?>", "<?php echo $endorsementSelect; ?>", 'endorsement', 'endorsementImage', 'endorsementButton', 'endorsementDate');
setFileVisibility("<?php echo $loanAppFormI; ?>", "<?php echo $loanAppFormISelect; ?>", 'loanAppFormI', 'loanAppFormIImage', 'loanAppFormIButton', 'loanAppFormIDate');
setFileVisibility("<?php echo $photocopyIdSignatures; ?>", "<?php echo $photocopyIdSignaturesSelect; ?>", 'photocopyIdSignatures', 'photocopyIdSignaturesImage', 'photocopyIdSignaturesButton', 'photocopyIdSignaturesDate');
setFileVisibility("<?php echo $proofBilling; ?>", "<?php echo $proofBillingSelect; ?>", 'proofBilling', 'proofBillingImage', 'proofBillingButton', 'proofBillingDate');
setFileVisibility("<?php echo $personalBank; ?>", "<?php echo $personalBankSelect; ?>", 'personalBank', 'personalBankImage', 'personalBankButton', 'personalBankDate');
setFileVisibility("<?php echo $marriageContract; ?>", "<?php echo $marriageContractSelect; ?>", 'marriageContract', 'marriageContractImage', 'marriageContractButton', 'marriageContractDate');
setFileVisibility("<?php echo $barangayClearance; ?>", "<?php echo $barangayClearanceSelect; ?>", 'barangayClearance', 'barangayClearanceImage', 'barangayClearanceButton', 'barangayClearanceDate');
// COLLATERAL DOCUMENTS
setFileVisibility("<?php echo $transferCertificate; ?>", "<?php echo $transferCertificateSelect; ?>", 'transferCertificate', 'transferCertificateImage', 'transferCertificateButton', 'transferCertificateDate');
setFileVisibility("<?php echo $taxDeclarationLot; ?>", "<?php echo $taxDeclarationLotSelect; ?>", 'taxDeclarationLot', 'taxDeclarationLotImage', 'taxDeclarationLotButton', 'taxDeclarationLotDate');
setFileVisibility("<?php echo $taxDeclarationImp; ?>", "<?php echo $taxDeclarationImpSelect; ?>", 'taxDeclarationImp', 'taxDeclarationImpImage', 'taxDeclarationImpButton', 'taxDeclarationImpDate');
setFileVisibility("<?php echo $realEstateTaxClearance; ?>", "<?php echo $realEstateTaxClearanceSelect; ?>", 'realEstateTaxClearance', 'realEstateTaxClearanceImage', 'realEstateTaxClearanceButton', 'realEstateTaxClearanceDate');
setFileVisibility("<?php echo $realEstateTaxReceipt; ?>", "<?php echo $realEstateTaxReceiptSelect; ?>", 'realEstateTaxReceipt', 'realEstateTaxReceiptImage', 'realEstateTaxReceiptButton', 'realEstateTaxReceiptDate');
setFileVisibility("<?php echo $cancellationDischarge; ?>", "<?php echo $cancellationDischargeSelect; ?>", 'cancellationDischarge', 'cancellationDischargeImage', 'cancellationDischargeButton', 'cancellationDischargeDate');
// SUNTRUST DOCUMENTS
setFileVisibility("<?php echo $sunTransferCertificate; ?>", "<?php echo $sunTransferCertificateSelect; ?>", 'sunTransferCertificate', 'sunTransferCertificateImage', 'sunTransferCertificateButton', 'sunTransferCertificateDate');
setFileVisibility("<?php echo $sunTaxDeclarationLot; ?>", "<?php echo $sunTaxDeclarationLotSelect; ?>", 'sunTaxDeclarationLot', 'sunTaxDeclarationLotImage', 'sunTaxDeclarationLotButton', 'sunTaxDeclarationLotDate');
setFileVisibility("<?php echo $sunTaxDeclarationImp; ?>", "<?php echo $sunTaxDeclarationImpSelect; ?>", 'sunTaxDeclarationImp', 'sunTaxDeclarationImpImage', 'sunTaxDeclarationImpButton', 'sunTaxDeclarationImpDate');
setFileVisibility("<?php echo $sunContractSell; ?>", "<?php echo $sunContractSellSelect; ?>", 'sunContractSell', 'sunContractSellImage', 'sunContractSellButton', 'sunContractSellDate');
setFileVisibility("<?php echo $sunStatementAccount; ?>", "<?php echo $sunStatementAccountSelect; ?>", 'sunStatementAccount', 'sunStatementAccountImage', 'sunStatementAccountButton', 'sunStatementAccountDate');
// BUSINESS PROOF OF INCOME
setFileVisibility("<?php echo $updatedBusiness; ?>", "<?php echo $updatedBusinessSelect; ?>", 'updatedBusiness', 'updatedBusinessImage', 'updatedBusinessButton', 'updatedBusinessDate');
setFileVisibility("<?php echo $auditedFinancial; ?>", "<?php echo $auditedFinancialSelect; ?>", 'auditedFinancial', 'auditedFinancialImage', 'auditedFinancialButton', 'auditedFinancialDate');
setFileVisibility("<?php echo $inhouseFinancial; ?>", "<?php echo $inhouseFinancialSelect; ?>", 'inhouseFinancial', 'inhouseFinancialImage', 'inhouseFinancialButton', 'inhouseFinancialDate');
setFileVisibility("<?php echo $businessBankStatement; ?>", "<?php echo $businessBankStatementSelect; ?>", 'businessBankStatement', 'businessBankStatementImage', 'businessBankStatementButton', 'businessBankStatementDate');
setFileVisibility("<?php echo $salesRecord; ?>", "<?php echo $salesRecordSelect; ?>", 'salesRecord', 'salesRecordImage', 'salesRecordButton', 'salesRecordDate');
setFileVisibility("<?php echo $incomeTaxReturn; ?>", "<?php echo $incomeTaxReturnSelect; ?>", 'incomeTaxReturn', 'incomeTaxReturnImage', 'incomeTaxReturnButton', 'incomeTaxReturnDate');
setFileVisibility("<?php echo $contractLease; ?>", "<?php echo $contractLeaseSelect; ?>", 'contractLease', 'contractLeaseImage', 'contractLeaseButton', 'contractLeaseDate');
setFileVisibility("<?php echo $customerNumber; ?>", "<?php echo $customerNumberSelect; ?>", 'customerNumber', 'customerNumberImage', 'customerNumberButton', 'customerNumberDate');
setFileVisibility("<?php echo $customerSupplier; ?>", "<?php echo $customerSupplierSelect; ?>", 'customerSupplier', 'customerSupplierImage', 'customerSupplierButton', 'customerSupplierDate');
setFileVisibility("<?php echo $otherIncomeB; ?>", "<?php echo $otherIncomeBSelect; ?>", 'otherIncomeB', 'otherIncomeBImage', 'otherIncomeBButton', 'otherIncomeBDate');
// EMPLOYED PROOF OF INCOME
setFileVisibility("<?php echo $employmentContract; ?>", "<?php echo $employmentContractSelect; ?>", 'employmentContract', 'employmentContractImage', 'employmentContractButton', 'employmentContractDate');
setFileVisibility("<?php echo $certificateEmployment; ?>", "<?php echo $certificateEmploymentSelect; ?>", 'certificateEmployment', 'certificateEmploymentImage', 'certificateEmploymentButton', 'certificateEmploymentDate');
setFileVisibility("<?php echo $incomeTax; ?>", "<?php echo $incomeTaxSelect; ?>", 'incomeTax', 'incomeTaxImage', 'incomeTaxButton', 'incomeTaxDate');
setFileVisibility("<?php echo $payslipMonths; ?>", "<?php echo $payslipMonthsSelect; ?>", 'payslipMonths', 'payslipMonthsImage', 'payslipMonthsButton', 'payslipMonthsDate');
setFileVisibility("<?php echo $otherIncome; ?>", "<?php echo $otherIncomeSelect; ?>", 'otherIncome', 'otherIncomeImage', 'otherIncomeButton', 'otherIncomeDate');
// OTHERS
setFileVisibility("<?php echo $powerAttorneyI; ?>", "<?php echo $powerAttorneyISelect; ?>", 'powerAttorneyI', 'powerAttorneyIImage', 'powerAttorneyIButton', 'powerAttorneyIDate');
setFileVisibility("<?php echo $generalInfo; ?>", "<?php echo $generalInfoSelect; ?>", 'generalInfo', 'generalInfoImage', 'generalInfoButton', 'generalInfoDate');
setFileVisibility("<?php echo $securityExchange; ?>", "<?php echo $securityExchangeSelect; ?>", 'securityExchange', 'securityExchangeImage', 'securityExchangeButton', 'securityExchangeDate');
setFileVisibility("<?php echo $letterGuarantee; ?>", "<?php echo $letterGuaranteeSelect; ?>", 'letterGuarantee', 'letterGuaranteeImage', 'letterGuaranteeButton', 'letterGuaranteeDate');
setFileVisibility("<?php echo $boardResolution; ?>", "<?php echo $boardResolutionSelect; ?>", 'boardResolution', 'boardResolutionImage', 'boardResolutionButton', 'boardResolutionDate');
setFileVisibility("<?php echo $statementAccountI; ?>", "<?php echo $statementAccountSelect; ?>", 'statementAccountI', 'statementAccountImage', 'statementAccountIButton', 'statementAccountIDate');
setFileVisibility("<?php echo $billMaterial; ?>", "<?php echo $billMaterialSelect; ?>", 'billMaterial', 'billMaterialImage', 'billMaterialButton', 'billMaterialDate');
setFileVisibility("<?php echo $proposedPlan; ?>", "<?php echo $proposedPlanSelect; ?>", 'proposedPlan', 'proposedPlanImage', 'proposedPlanButton', 'proposedPlanDate');
setFileVisibility("<?php echo $otherDoc; ?>", "<?php echo $otherDocSelect; ?>", 'otherDoc', 'otherDocImage', 'otherDocButton', 'otherDocDate');
// DOCUMENTS
setFileVisibility("<?php echo $receipt; ?>", "<?php echo $receiptSelect; ?>", 'receipt', 'receiptImage', 'receiptButton', 'receiptDate');
setFileVisibility("<?php echo $creditInvestigationReportI; ?>", "<?php echo $creditInvestigationReportISelect; ?>", 'creditInvestigationReportI', 'creditInvestigationReportIImage', 'creditInvestigationReportIButton', 'creditInvestigationReportIDate');
setFileVisibility("<?php echo $collateralAppraisalReportI; ?>", "<?php echo $collateralAppraisalReportISelect; ?>", 'collateralAppraisalReportI', 'collateralAppraisalReportIImage', 'collateralAppraisalReportIButton', 'collateralAppraisalReportIDate');
setFileVisibility("<?php echo $financialEvaluationI; ?>", "<?php echo $financialEvaluationISelect; ?>", 'financialEvaluationI', 'financialEvaluationIImage', 'financialEvaluationIButton', 'financialEvaluationIDate');
setFileVisibility("<?php echo $signedLetterI; ?>", "<?php echo $signedLetterISelect; ?>", 'signedLetterI', 'signedLetterIImage', 'signedLetterIButton', 'signedLetterIDate');
setFileVisibility("<?php echo $signedLoanMemoI; ?>", "<?php echo $signedLoanMemoISelect; ?>", 'signedLoanMemoI', 'signedLoanMemoIImage', 'signedLoanMemoIButton', 'signedLoanMemoIDate');
setFileVisibility("<?php echo $remContractI; ?>", "<?php echo $remContractISelect; ?>", 'remContractI', 'remContractIImage', 'remContractIButton', 'remContractIDate');
setFileVisibility("<?php echo $promNoteI; ?>", "<?php echo $promNoteISelect; ?>", 'promNoteI', 'promNoteIImage', 'promNoteIButton', 'promNoteIDate');
setFileVisibility("<?php echo $disclosureStateI; ?>", "<?php echo $disclosureStateISelect; ?>", 'disclosureStateI', 'disclosureStateIImage', 'disclosureStateIButton', 'disclosureStateIDate');
setFileVisibility("<?php echo $mriFormI; ?>", "<?php echo $mriFormISelect; ?>", 'mriFormI', 'mriFormIImage', 'mriFormIButton', 'mriFormIDate');
setFileVisibility("<?php echo $remContractAnnotatedI; ?>", "<?php echo $remContractAnnotatedISelect; ?>", 'remContractAnnotatedI', 'remContractAnnotatedIImage', 'remContractAnnotatedIButton', 'remContractAnnotatedIDate');
setFileVisibility("<?php echo $signedLetterUnderEndI; ?>", "<?php echo $signedLetterUnderEndISelect; ?>", 'signedLetterUnderEndI', 'signedLetterUnderEndIImage', 'signedLetterUnderEndIButton', 'signedLetterUnderEndIDate');
setFileVisibility("<?php echo $remContractEndI; ?>", "<?php echo $remContractEndISelect; ?>", 'remContractEndI', 'remContractEndIImage', 'remContractEndIButton', 'remContractEndIDate');
setFileVisibility("<?php echo $promNoteEndI; ?>", "<?php echo $promNoteEndISelect; ?>", 'promNoteEndI', 'promNoteEndIImage', 'promNoteEndIButton', 'promNoteEndIDate');
setFileVisibility("<?php echo $disclosureStateEndI; ?>", "<?php echo $disclosureStateEndISelect; ?>", 'disclosureStateEndI', 'disclosureStateEndIImage', 'disclosureStateEndIButton', 'disclosureStateEndIDate');
setFileVisibility("<?php echo $mriFormEndI; ?>", "<?php echo $mriFormEndISelect; ?>", 'mriFormEndI', 'mriFormEndIImage', 'mriFormEndIButton', 'mriFormEndIDate');
setFileVisibility("<?php echo $signedDeedUnderEndI; ?>", "<?php echo $signedDeedUnderEndISelect; ?>", 'signedDeedUnderEndI', 'signedDeedUnderEndIImage', 'signedDeedUnderEndIButton', 'signedDeedUnderEndIDate');
setFileVisibility("<?php echo $amortScheduleI; ?>", "<?php echo $amortScheduleISelect; ?>", 'amortScheduleI', 'amortScheduleIImage', 'amortScheduleIButton', 'amortScheduleIDate');
setFileVisibility("<?php echo $amortScheduleEndI; ?>", "<?php echo $amortScheduleEndISelect; ?>", 'amortScheduleEndI', 'amortScheduleEndIImage', 'amortScheduleEndIButton', 'amortScheduleEndIDate');
setFileVisibility("<?php echo $utilization; ?>", "<?php echo $utilizationSelect; ?>", 'utilization', 'utilizationImage', 'utilizationButton', 'utilizationDate');
setFileVisibility("<?php echo $powerpoint; ?>", "<?php echo $utilizationSelect; ?>", 'powerpoint', 'powerpointImage', 'powerpointButton', 'powerpointDate');
setFileVisibility("<?php echo $excel; ?>", "<?php echo $utilizationSelect; ?>", 'excel', 'excelImage', 'excelButton', 'excelDate');
</script>

<script>
   function showText(target, position) {
      var modal = document.getElementById("myModal");
      var span = document.getElementById("closeModal");
      var btn = document.getElementById(target);
      var modalText = document.getElementById("modalText");


      // When the button is clicked, display the modal
      btn.addEventListener("click", function() {
         modalText.textContent = btn.value; // Set the modalText content
         modal.style.marginTop = position;
         modal.style.display = "block";

      });

      btn.addEventListener("input", function() {
         modalText.textContent = btn.value; // Set the modalText content
         modalText.textContent = textField.value;

      });
      // When the 'x' (close) is clicked, close the modal
      span.addEventListener("click", function() {
         modal.style.display = "none";
      });

      // When the background is clicked, close the modal
      window.addEventListener("click", function(event) {
         if (event.target === modal) {
            modal.style.display = "none";
         }
      });

   }
   // PRINCIPAL BORROWER
   showText('endorsementDesc', '1%');
   showText('loanAppFormIDesc', '1%');
   showText('photocopyIdSignaturesDesc', '1%');
   showText('proofBillingDesc', '1%');
   showText('personalBankDesc', '1%');
   showText('marriageContractDesc', '1%');
   showText('barangayClearanceDesc', '1%');
   // COLLATERAL DOCUMENTS
   showText('transferCertificateDesc', '1%');
   showText('taxDeclarationLotDesc', '1%');
   showText('taxDeclarationImpDesc', '1%');
   showText('realEstateTaxClearanceDesc', '1%');
   showText('realEstateTaxReceiptDesc', '1%');
   showText('cancellationDischargeDesc', '1%');
   // SUNTRUST DOCUMENTS
   showText('sunTransferCertificateDesc', '1%');
   showText('sunTaxDeclarationLotDesc', '1%');
   showText('sunTaxDeclarationImpDesc', '1%');
   showText('sunContractSellDesc', '1%');
   showText('sunStatementAccountDesc', '1%');
   // BUSINESS PROOF OF INCOME
   showText('updatedBusinessDesc', '1%');
   showText('auditedFinancialDesc', '1%');
   showText('inhouseFinancialDesc', '1%');
   showText('businessBankStatementDesc', '1%');
   showText('salesRecordDesc', '1%');
   showText('incomeTaxReturnDesc', '1%');
   showText('contractLeaseDesc', '1%');
   showText('customerNumberDesc', '1%');
   showText('customerSupplierDesc', '1%');
   showText('otherIncomeBDesc', '1%');
   // EMPLOYED PROOF OF INCOME
   showText('employmentContractDesc', '1%');
   showText('certificateEmploymentDesc', '1%');
   showText('incomeTaxDesc', '1%');
   showText('payslipMonthsDesc', '1%');
   showText('otherIncomeDesc', '1%');
   // OTHERS
   showText('powerAttorneyIDesc', '1%');
   showText('generalInfoDesc', '1%');
   showText('securityExchangeDesc', '1%');
   showText('letterGuaranteeDesc', '1%');
   showText('boardResolutionDesc', '1%');
   showText('statementAccountIDesc', '1%');
   showText('billMaterialDesc', '1%');
   showText('proposedPlanDesc', '1%');
   showText('otherDocDesc', '1%');
   // DOCUMENTS
   showText('receiptDesc', '1%');
   showText('creditInvestigationReportIDesc', '1%');
   showText('collateralAppraisalReportIDesc', '1%');
   showText('financialEvaluationIDesc', '1%');
   showText('signedLetterIDesc', '1%');
   showText('signedLetterUnderEndIDesc', '1%');
   showText('signedLoanMemoIDesc', '1%');
   showText('remContractIDesc', '1%');
   showText('remContractAnnotatedIDesc', '1%');
   showText('promNoteIDesc', '1%');
   showText('disclosureStateIDesc', '1%');
   showText('mriFormIDesc', '1%');
   showText('amortScheduleIDesc', '1%');
   showText('remContractEndIDesc', '1%');
   showText('promNoteEndIDesc', '1%');
   showText('disclosureStateEndIDesc', '1%');
   showText('mriFormEndIDesc', '1%');
   showText('amortScheduleEndIDesc', '1%');
   showText('signedDeedUnderEndIDesc', '1%');
   showText('utilizationDesc', '1%');
</script>