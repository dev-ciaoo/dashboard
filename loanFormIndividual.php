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
      <!-- <script src="loanFormIndividual.js"></script> -->
      <title>Tabs</title>
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
         $id =  mysqli_real_escape_string($con, $_POST['loanId']);
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
               $productID = $row['productID'];
               $amountAppliedd = $row['amountApplied'];
               $amountTermss = $row['terms'];
               $interestRatee = $row['interestRate'];

               $amountAppl = number_format($amountAppliedd, 2, '.', ',');

            } 
         }
         

         if($type == "REM: Individual") {
            
         ?>
      <script>
         document.getElementById('tab4').classList.add('active');;
         document.getElementById('individual').classList.add('active');
         document.getElementById('tab1').setAttribute('', '');
         document.getElementById('tab2').setAttribute('', '');
         document.getElementById('tab3').setAttribute('', '');
      </script>
      <?php
         // $query4 = "SELECT * FROM individual
         //                            -- JOIN indivarchive AS a ON i.indivLoanId = a.a_indivLoanId
         //                            WHERE indivloanId = $id
         //           ";

         $query4 = "SELECT a.*, i.* FROM individual AS i
                                    LEFT JOIN indivarchive AS a ON i.indivLoanId = a.a_indivLoanId
                                    WHERE i.indivloanId = '$id'
                  ";
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
         $cic = $rows['cic'];
         $nfis = $rows['nfis'];
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

         $a_endorsement = $rows['a_endorsement'];
         $a_loanAppFormI = $rows['a_loanAppFormI'];
         $a_photocopyIdSignatures = $rows['a_photocopyIdSignatures'];
         $a_proofBilling = $rows['a_proofBilling'];
         $a_personalBank = $rows['a_personalBank'];
         $a_marriageContract = $rows['a_marriageContract'];
         $a_barangayClearance = $rows['a_barangayClearance'];
         // COLLATERAL DOCUMENTS
         $a_transferCertificate = $rows['a_transferCertificate'];
         $a_taxDeclarationLot = $rows['a_taxDeclarationLot'];
         $a_taxDeclarationImp = $rows['a_taxDeclarationImp'];
         $a_realEstateTaxClearance = $rows['a_realEstateTaxClearance'];
         $a_realEstateTaxReceipt = $rows['a_realEstateTaxReceipt'];
         $a_cancellationDischarge = $rows['a_cancellationDischarge'];
         // SUNTRUST DOCUMENTS
         $a_sunTransferCertificate = $rows['a_sunTransferCertificate'];
         $a_sunTaxDeclarationLot = $rows['a_unTaxDeclarationLot'];
         $a_sunTaxDeclarationImp = $rows['a_sunTaxDeclarationImp'];
         $a_sunContractSell = $rows['a_sunContractSell'];
         $a_sunStatementAccount = $rows['a_sunStatementAccount'];
         // BUSINESS PROOF OF INCOME
         $a_updatedBusiness = $rows['a_updatedBusiness'];
         $a_auditedFinancial = $rows['a_auditedFinancial'];
         $a_inhouseFinancial = $rows['a_nhouseFinancial'];
         $a_businessBankStatement = $rows['a_businessBankStatement'];
         $a_salesRecord = $rows['a_salesRecord'];
         $a_incomeTaxReturn = $rows['a_incomeTaxReturn'];
         $a_contractLease = $rows['a_contractLease'];
         $a_customerNumber = $rows['a_customerNumber'];
         $a_customerSupplier = $rows['a_customerSupplier'];
         $a_otherIncomeB = $rows['a_otherIncomeB'];
         // EMPLOYED PROOF OF INCOME
         $a_employmentContract = $rows['a_employmentContract'];
         $a_certificateEmployment = $rows['a_certificateEmployment'];
         $a_incomeTax = $rows['a_incomeTax'];
         $a_payslipMonths = $rows['a_payslipMonths'];
         $a_otherIncome = $rows['a_otherIncome'];
         // OTHERS
         $a_powerAttorneyI = $rows['a_powerAttorneyI'];
         $a_eneralInfo = $rows['a_generalInfo'];
         $a_securityExchange = $rows['a_securityExchange'];
         $a_letterGuarantee = $rows['a_letterGuarantee'];
         $a_boardResolution = $rows['a_boardResolution'];
         $a_statementAccountI = $rows['a_statementAccount'];
         $a_billMaterial = $rows['a_billMaterial'];
         $a_proposedPlan = $rows['a_proposedPlan'];
         $a_otherDoc = $rows['a_therDoc'];
         // DOCUMENTS
         $a_receipt = $rows['a_receipt'];
         $a_creditInvestigationReportI = $rows['a_creditInvestigationReportI'];
         $a_collateralAppraisalReportI = $rows['a_collateralAppraisalReportI'];
         $a_inancialEvaluationI = $rows['a_financialEvaluationI'];
         $a_ignedLetterI = $rows['a_signedLetterI'];
         $a_signedLoanMemoI = $rows['a_signedLoanMemoI'];            
         $a_remContractI = $rows['a_remContractI'];
         $a_promNoteI = $rows['a_promNoteI'];
         $a_disclosureStateI = $rows['a_disclosureStateI'];
         $a_mriFormI = $rows['a_mriFormI'];
         $a_remContractAnnotatedI = $rows['a_remContractAnnotatedI'];
         $a_signedLetterUnderEndI = $rows['a_signedLetterUnderEndI'];
         $a_remContractEndI = $rows['a_remContractEndI'];
         $a_promNoteEndI = $rows['a_promNoteEndI'];
         $a_disclosureStateEndI = $rows['a_disclosureStateEndI'];
         $a_mriFormEndI = $rows['a_mriFormEndI'];
         $a_signedDeedUnderEndI = $rows['a_signedDeedUnderEndI'];
         $a_amortScheduleI = $rows['a_amortScheduleI'];
         $a_amortScheduleEndI = $rows['a_amortScheduleEndI'];
         $a_utilization=$rows['a_utilization'];
         $a_powerpoint=$rows['a_powerpoint'];
         $a_excel=$rows['a_excel'];
         
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
         $cicSelect = $rows['cicStatus'];
         $nfisSelect = $rows['nfisStatus'];
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
         $cicCheck = $rows['cicCheck'];
         $nfisCheck = $rows['nfisCheck'];
         
         // TEXT
         $edit1 =$rows['edit1'];
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
         
         // echo count($numberOfFilesUploaded);
         $primary="http://124.106.173.237/dashboard/linkInd.php?id=";
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
            <label class="text-dark"><h3><strong><?php echo "$fullname &nbsp; $birth &nbsp;" . strtoupper($type) . "&nbsp; &nbsp;" .strtoupper($sourceIncome) . "&nbsp; &nbsp;". strtoupper($remType) . " &nbsp; <span style='color: lightgray;'><strong>|</strong></span> &nbsp;&nbsp;&nbsp; AMOUNT: &#8369;$amountAppl &nbsp; TERMS: $amountTermss &nbsp; INTEREST RATE: $interestRatee%"; ?></strong></h3></label>
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
                  <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver">
                     <li class="nav-item ">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab1" href="#microfinance">Microfinance</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#salary">Salary</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation">Real Estate Mortgage - Corporation</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab4" href="#individual">Real Estate Mortgage - Individual</a>
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
                           <div id="individual" class="tab-pane active"  style=" border: 1px solid #ccc;">
                              <form id="individual-form" action="loanIndividualUploadData.php" method="POST" enctype="multipart/form-data">
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
                                       <div class="individual-tabs" style=" border-right: 1px solid #ccc; height: 97.9%; margin-bottom:0; margin-top:-0.5%;">
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
                                                   <label class="individual-labels" id="tab-label" for="custom"> ENDORSEMENT LETTER</label>
                                                   <input type="file" id="endorsement" name="endorsement"><img id="endorsementImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $endorsement; ?>" target="_blank">
                                                      <button type="button" class="btn btn-outline-success btnFile" id="endorsementButton">Open File</button>
                                                   </a>
                                                   <?php 
                                                   if(!empty($endorsement)){
                                                      echo '<button type="button" id="endorsementUploadNew" class="endorsementUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="endorsementUploadNew" class="endorsementUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="endorsementShowOld" class="endorsementShowOld">History</button>';
                                                   ?>
                                                   <!-- <button type="button" id="endorsementShowOld" class="endorsementShowOld">History</button> -->
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
                                                   <label class="individual-labels" id="tab-label" for="custom">LOAN APPLICATION FORM</label>
                                                   <input type="file" id="loanAppFormI" name="loanAppFormI"><img id="loanAppFormIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppFormI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormIButton">Open File</button></a>
                                                   <?php 
                                                   if(!empty($loanAppFormI)){
                                                      echo '<button type="button" id="loanAppFormIUploadNew" class="loanAppFormIUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="loanAppFormIUploadNew" class="loanAppFormIUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="loanAppFormIShowOld" class="loanAppFormIShowOld">History</button>';
                                                   ?>
                                                   <!-- <button type="button" id="loanAppFormIShowOld" class="loanAppFormIShowOld">History</button> -->
                                                   <label class="date-label" id="loanAppFormIDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormI, strrpos($loanAppFormI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="loanAppFormISelect" name="loanAppFormISelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="loanAppFormIDesc" name="loanAppFormIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED IDs WITH 3 SIGNATURES -->
                                          <div class="row">
                                             <div class="col-8">

                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">PHOTOCOPY OF ANY 2 GOVERNMENT</label>
                                                   <input type="file" id="photocopyIdSignatures" name="photocopyIdSignatures"><img id="photocopyIdSignaturesImage" src="statusImage/check.png" alt="statusImage">
                                                   <a 
                                                      href="<?php echo $photocopyIdSignatures; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="photocopyIdSignaturesButton">Open File</button>
                                                   </a>
                                                   <?php 
                                                   if(!empty($photocopyIdSignatures)){
                                                      echo '<button type="button" id="photocopyIdSignaturesUploadNew" class="photocopyIdSignaturesUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="photocopyIdSignaturesUploadNew" class="photocopyIdSignaturesUploadNew" disabled>+</button>';
                                                   }
                                                   echo '<button type="button" id="photocopyIdSignaturesShowOld" class="photocopyIdSignaturesShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="photocopyIdSignaturesDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($photocopyIdSignatures, strrpos($photocopyIdSignatures, '/') + 1, 10); ?></label>
                                                   <label class="individual-labels" id="tab-label" for="custom">ISSUED IDs WITH 3 SIGNATURES</label>
                                                
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="photocopyIdSignaturesSelect" name="photocopyIdSignaturesSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="photocopyIdSignaturesDesc" name="photocopyIdSignaturesDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                         <!-- PROOF OF BILLING (MERALCO, INTERNET BILL, WATER BILL) -->
                                            <div class="row">
                                             <div class="col-8">
                                               <div class="py-2" >
                                                <label class ="individual-labels" id="tab-label" for="custom">PROOF OF BILLING (MERALCO,</label>
                                                <input type="file" id="proofBilling" name="proofBilling"><img id="proofBillingImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $proofBilling; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofBillingButton" >Open File</button></a>
                                                <?php 
                                                   if(!empty($proofBilling)){
                                                      echo '<button type="button" id="proofBillingUploadNew" class="proofBillingUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="proofBillingUploadNew" class="proofBillingUploadNew" disabled>+</button>';
                                                   }
                                                      echo '<button type="button" id="proofBillingShowOld" class="proofBillingShowOld">History</button>';
                                                   ?>
                                                <label class="date-label" id="proofBillingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label>
                                                <label class ="individual-labels" id="tab-label" for="custom">INTERNEET BILL, WATER BILL)</label>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex" >
                                                <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "proofBillingSelect" name = "proofBillingSelect" tabindex="-1">
                                                <option selected value= "NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                                <option value="3">N/A</option>
                                                </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proofBillingDesc" name = "proofBillingDesc" >&nbsp;
                                              </div>
                                             </div>
                                          </div>
                                           <!-- PERSONAL-BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">PERSONAL-BANK STATEMENTS OR</label>
                                                   <input type="file" id="personalBank" name="personalBank"><img id="personalBankImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $personalBank; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="personalBankButton">Open File</button></a>
                                                   <?php 
                                                   if(!empty($personalBank)){
                                                      echo '<button type="button" id="personalBankUploadNew" class="personalBankUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="personalBankUploadNew" class="personalBankUploadNew" disabled>+</button>';
                                                   }
                                                      echo '<button type="button" id="personalBankShowOld" class="personalBankShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="personalBankDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($personalBank, strrpos($personalBank, '/') + 1, 10); ?></label>
                                                   <label class="individual-labels" id="tab-label" for="custom">PASSBOOK FOR THE LAST 6 MONTHS</label>
                                                </div>
                                             </div>
                                          <div class="col-4">
                                           <div class="form-group d-flex mb-4" >
                                              <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "personalBankSelect" name = "personalBankSelect" tabindex="-1">
                                                <option selected value= "NULL">Option</option>
                                                <option value="1">VERIFIED</option>
                                                <option value="2">INCOMPLETE</option>
                                                <option value="3">N/A</option>
                                             </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="personalBankDesc" name = "personalBankDesc" >&nbsp;
                                        </div>
                                     </div>
                                    </div>
                                           <!-- MARRIAGE CONTRACT (IF MARRIED) *CENOMAR (IF SINGLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">MARRIAGE CONTRACT (IF MARRIED)</label>
                                                   <input type="file" id="marriageContract" name="marriageContract"><img id="marriageContractImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $marriageContract; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="marriageContractButton">Open File</button></a>
                                                   <?php 
                                                   if(!empty($marriageContract)){
                                                      echo '<button type="button" id="marriageContractUploadNew" class="marriageContractUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="marriageContractUploadNew" class="marriageContractUploadNew" disabled>+</button>';
                                                   }
                                                      echo '<button type="button" id="marriageContractShowOld" class="marriageContractShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="marriageContractDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($marriageContract, strrpos($marriageContract, '/') + 1, 10); ?></label>
                                                   <label class="individual-labels" id="tab-label" for="custom">*CENOMAR (IF SINGLE)</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="marriageContractSelect" name="marriageContractSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="marriageContractDesc" name="marriageContractDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BARANGAY CLEARANCE FOR LOAN PURPOSE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label" for="custom">BARANGAY CLEARANCE FOR</label>
                                                   <input type="file" id="barangayClearance" name="barangayClearance"><img id="barangayClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $barangayClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="barangayClearanceButton">Open File</button></a>
                                                   <?php 
                                                   if(!empty($barangayClearance)){
                                                      echo '<button type="button" id="barangayClearanceUploadNew" class="barangayClearanceUploadNew">+</button>';
                                                   }else{
                                                      echo '<button type="button" id="barangayClearanceUploadNew" class="barangayClearanceUploadNew" disabled>+</button>';
                                                   }
                                                      echo '<button type="button" id="barangayClearanceShowOld" class="barangayClearanceShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="barangayClearanceDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($barangayClearance, strrpos($barangayClearance, '/') + 1, 10); ?></label>
                                                   <label class="individual-labels" id="tab-label" for="custom">LOAN PURPOSE</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="barangayClearanceSelect" name="barangayClearanceSelect" tabindex="-1">
                                                      <option selected value="NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="barangayClearanceDesc" name="barangayClearanceDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--DIV HERE FOR COLLATERAL  -->
                                          <div class="collateralDocuments" id="collateralDocuments" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>COLLATERAL DOCUMENTS</u></label></div>
                                                </div>
                                             </div>
                                             <!-- TRANSFER CERTIFICATE OF TITLE (ORIGINAL & CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   
                                                   <div class="py-2">
                                                      <label class="individual-labels" id="tab-label" for="custom">TRANSFER CERTIFICATE OF TITLE</label>
                                                      <input type="file" id="transferCertificate" name="transferCertificate"><img id="transferCertificateImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $transferCertificate; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="transferCertificateButton">Open File</button></a>
                                                      <?php 
                                                      if(!empty($transferCertificate)){
                                                         echo '<button type="button" id="transferCertificateUploadNew" class="transferCertificateUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="transferCertificateUploadNew" class="transferCertificateUploadNew" disabled>+</button>';
                                                      }
                                                      echo '<button type="button" id="transferCertificateShowOld" class="transferCertificateShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="transferCertificateDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($transferCertificate, strrpos($transferCertificate, '/') + 1, 10); ?></label>
                                                      <label class="individual-labels" id="tab-label" for="custom">(ORIGINAL & CERTIFIED TRUE COPY)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-1">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="transferCertificateSelect" name="transferCertificateSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="transferCertificateDesc" name="transferCertificateDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (LOT - CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels" id="tab-label" for="custom">TAX DECLARATION</label>
                                                      <input type="file" id="taxDeclarationLot" name="taxDeclarationLot"><img id="taxDeclarationLotImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $taxDeclarationLot; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationLotButton">Open File</button></a>
                                                      <?php 
                                                      if(!empty($taxDeclarationLot)){
                                                         echo '<button type="button" id="taxDeclarationLotUploadNew" class="taxDeclarationLotUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="taxDeclarationLotUploadNew" class="taxDeclarationLotUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="taxDeclarationLotShowOld" class="taxDeclarationLotShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="taxDeclarationLotDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclarationLot, strrpos($taxDeclarationLot, '/') + 1, 10); ?></label>
                                                      <label class="individual-labels" id="tab-label" for="custom">(LOT - CERTIFIED TRUE COPY)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclarationLotSelect" name="taxDeclarationLotSelect" tabindex="-1">
                                                         <option selected value="NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationLotDesc" name="taxDeclarationLotDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (IMPROVEMENT - CERTIFIED TRUE COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">TAX DECLARATION</label>
                                                      <input type="file" id="taxDeclarationImp" name="taxDeclarationImp"><img id="taxDeclarationImpImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $taxDeclarationImp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationImpButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($taxDeclarationImp)){
                                                         echo '<button type="button" id="taxDeclarationImpUploadNew" class="taxDeclarationImpUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="taxDeclarationImpUploadNew" class="taxDeclarationImpUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="taxDeclarationImpShowOld" class="taxDeclarationImpShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="taxDeclarationImpDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclarationImp, strrpos($taxDeclarationImp, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(IMPROVEMENT - CERTIFIED TRUE COPY)  </label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "taxDeclarationImpSelect" name = "taxDeclarationImpSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationImpDesc" name = "taxDeclarationImpDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!-- REAL ESTATE TAX CLEARANCE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">REAL ESTATE TAX CLEARANCE </label>
                                                      <input type="file" id="realEstateTaxClearance" name="realEstateTaxClearance"><img id="realEstateTaxClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $realEstateTaxClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxClearanceButton" >Open File</button></a>
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
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "realEstateTaxClearanceSelect" name = "realEstateTaxClearanceSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="realEstateTaxClearanceDesc" name = "realEstateTaxClearanceDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!--REAL ESTATE TAX RECEIPT   -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">REAL ESTATE TAX RECEIPT</label>
                                                      <input type="file" id="realEstateTaxReceipt" name="realEstateTaxReceipt"><img id="realEstateTaxReceiptImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $realEstateTaxReceipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxReceiptButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($realEstateTaxReceipt)){
                                                         echo '<button type="button" id="realEstateTaxReceiptUploadNew" class="realEstateTaxReceiptUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="realEstateTaxReceiptUploadNew" class="realEstateTaxReceiptUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="realEstateTaxReceiptShowOld" class="realEstateTaxReceiptShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="realEstateTaxReceiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxReceipt, strrpos($realEstateTaxReceipt, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(AMILYAR) </label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "realEstateTaxReceiptSelect" name = "realEstateTaxReceiptSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="realEstateTaxReceiptDesc" name = "realEstateTaxReceiptDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!--CANCELLATION AND DISCHARGE OF MORTGAGE (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">CANCELLATION AND DISCHARGE</label>
                                                      <input type="file" id="cancellationDischarge" name="cancellationDischarge"><img id="cancellationDischargeImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $cancellationDischarge; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cancellationDischargeButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($cancellationDischarge)){
                                                         echo '<button type="button" id="cancellationDischargeUploadNew" class="cancellationDischargeUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="cancellationDischargeUploadNew" class="cancellationDischargeUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="cancellationDischargeShowOld" class="cancellationDischargeShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="cancellationDischargeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cancellationDischarge, strrpos($cancellationDischarge, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">OF MORTGAGE (IF APPLICABLE)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "cancellationDischargeSelect" name = "cancellationDischargeSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cancellationDischargeDesc" name = "cancellationDischargeDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="suntrustDocuments" id="suntrustDocuments" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><u>SUNTRUST DOCUMENTS</u></label></div>
                                                </div>
                                             </div>
                                              <!-- COPY OF TRANSFER CERTIFICATE OF TITLE-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">COPY OF TRANSFER CERTIFICATE</label>
                                                      <input type="file" id="sunTransferCertificate" name="sunTransferCertificate"><img id="sunTransferCertificateImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $sunTransferCertificate; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTransferCertificateButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($sunTransferCertificate)){
                                                         echo '<button type="button" id="sunTransferCertificateUploadNew" class="sunTransferCertificateUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="sunTransferCertificateUploadNew" class="sunTransferCertificateUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="sunTransferCertificateShowOld" class="sunTransferCertificateShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="sunTransferCertificateDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTransferCertificate, strrpos($sunTransferCertificate, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">OF TITLE </label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "sunTransferCertificateSelect" name = "sunTransferCertificateSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="sunTransferCertificateDesc" name = "sunTransferCertificateDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (LOT-COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">TAX DECLARATION(LOT-COPY)  </label>
                                                      <input type="file" id="sunTaxDeclarationLot" name="sunTaxDeclarationLot"><img id="sunTaxDeclarationLotImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $sunTaxDeclarationLot; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTaxDeclarationLotButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($sunTaxDeclarationLot)){
                                                         echo '<button type="button" id="sunTaxDeclarationLotUploadNew" class="sunTaxDeclarationLotUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="sunTaxDeclarationLotUploadNew" class="sunTaxDeclarationLotUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="sunTaxDeclarationLotShowOld" class="sunTaxDeclarationLotShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="sunTaxDeclarationLotDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTaxDeclarationLot, strrpos($sunTaxDeclarationLot, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunTaxDeclarationLotSelect" name = "sunTaxDeclarationLotSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunTaxDeclarationLotDesc" name = "sunTaxDeclarationLotDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- TAX DECLARATION (IMPROVEMENT - COPY) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">TAX DECLARATION</label>
                                                      <input type="file" id="sunTaxDeclarationImp" name="sunTaxDeclarationImp"><img id="sunTaxDeclarationImpImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunTaxDeclarationImp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunTaxDeclarationImpButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($sunTaxDeclarationImp)){
                                                         echo '<button type="button" id="sunTaxDeclarationImpUploadNew" class="sunTaxDeclarationImpUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="sunTaxDeclarationImpUploadNew" class="sunTaxDeclarationImpUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="sunTaxDeclarationImpShowOld" class="sunTaxDeclarationImpShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="sunTaxDeclarationImpDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunTaxDeclarationImp, strrpos($sunTaxDeclarationImp, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(IMPROVEMENT - COPY) </label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunTaxDeclarationImpSelect" name = "sunTaxDeclarationImpSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunTaxDeclarationImpDesc" name = "sunTaxDeclarationImpDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--CONTRACT TO SELL   -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">CONTRACT TO SELL</label>
                                                      <input type="file" id="sunContractSell" name="sunContractSell"><img id="sunContractSellImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunContractSell; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunContractSellButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($sunContractSell)){
                                                         echo '<button type="button" id="sunContractSellUploadNew" class="sunContractSellUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="sunContractSellUploadNew" class="sunContractSellUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="sunContractSellShowOld" class="sunContractSellShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="sunContractSellDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunContractSell, strrpos($sunContractSell, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunContractSellSelect" name = "sunContractSellSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="sunContractSellDesc" name = "sunContractSellDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">STATEMENT OF ACCOUNT</label>
                                                      <input type="file" id="sunStatementAccount" name="sunStatementAccount"><img id="sunStatementAccountImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $sunStatementAccount; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="sunStatementAccountButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($sunStatementAccount)){
                                                         echo '<button type="button" id="sunStatementAccountUploadNew" class="sunStatementAccountUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="sunStatementAccountUploadNew" class="sunStatementAccountUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="sunStatementAccountShowOld" class="sunStatementAccountShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="sunStatementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($sunStatementAccount, strrpos($sunStatementAccount, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">AND/OR PAYMENT SUMMARY</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                    <!-- STATEMENT OF ACCOUNT AND/OR PAYMENT SUMMARY  -->
                                                  <div class="form-group d-flex mb-2">
                                                    <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "sunStatementAccountSelect" name = "sunStatementAccountSelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
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
                                                   <div class="py-3"><label style="font-size:120%"><u>BUSINESS PROOF OF INCOME</u></label></div>
                                                </div>
                                             </div>
                                             <!-- UPDATED BUSINESS PERMIT (MAYOR'S, BARANGAY AND/OR DTI)-->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> UPDATED BUSINESS PERMIT</label> 
                                                      <input type="file" id="updatedBusiness" name="updatedBusiness"><img id="updatedBusinessImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $updatedBusiness; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="updatedBusinessButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($updatedBusiness)){
                                                         echo '<button type="button" id="updatedBusinessUploadNew" class="updatedBusinessUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="updatedBusinessUploadNew" class="updatedBusinessUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="updatedBusinessShowOld" class="updatedBusinessShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="updatedBusinessDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($updatedBusiness, strrpos($updatedBusiness, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(MAYOR'S, BARANGAY AND/OR DTI)</label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "updatedBusinessSelect" name = "updatedBusinessSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="updatedBusinessDesc" name = "updatedBusinessDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!--AUDITED FINANCIAL STATEMENT (3 YEARS)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">AUDITED FINANCIAL</i></label> 
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
                                                      <label class ="individual-labels" id="tab-label" for="custom">STATEMENT(3 YEARS)</i></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "auditedFinancialSelect" name = "auditedFinancialSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="auditedFinancialDesc" name = "auditedFinancialDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- IN-HOUSE FINANCIAL STATEMENT (3 YEARS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">IN-HOUSE FINANCIAL</label>
                                                      <input type="file" id="inhouseFinancial" name="inhouseFinancial"><img id="inhouseFinancialImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $inhouseFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="inhouseFinancialButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($inhouseFinancial)){
                                                         echo '<button type="button" id="inhouseFinancialUploadNew" class="inhouseFinancialUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="inhouseFinancialUploadNew" class="inhouseFinancialUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="inhouseFinancialShowOld" class="inhouseFinancialShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="inhouseFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($inhouseFinancial, strrpos($inhouseFinancial, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">STATEMENT (3 YEARS)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inhouseFinancialSelect" name = "inhouseFinancialSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="inhouseFinancialDesc" name = "inhouseFinancialDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- BUSINESS - BANK STATEMENT OR PASSBOOK FOR THE LAST 6 MONTHS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> BUSINESS - BANK STATEMENT</label>
                                                      <input type="file" id="businessBankStatement" name="businessBankStatement"><img id="businessBankStatementImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $businessBankStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessBankStatementButton">Open File</button></a>
                                                      <?php 
                                                      if(!empty($businessBankStatement)){
                                                         echo '<button type="button" id="businessBankStatementUploadNew" class="businessBankStatementUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="businessBankStatementUploadNew" class="businessBankStatementUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="businessBankStatementShowOld" class="businessBankStatementShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="businessBankStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessBankStatement, strrpos($businessBankStatement, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">OR PASSBOOK FOR THE LAST 6 MONTHS</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "businessBankStatementSelect" name = "businessBankStatementSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="businessBankStatementDesc" name = "businessBankStatementDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- SALES RECORD & PURCHASES RECEIPTS OR LOGBOOK -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> SALES RECORD & PURCHASES </label>
                                                      <input type="file" id="salesRecord" name="salesRecord"><img id="salesRecordImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $salesRecord; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="salesRecordButton">Open File</button></a>
                                                      <?php 
                                                      if(!empty($salesRecord)){
                                                         echo '<button type="button" id="salesRecordUploadNew" class="salesRecordUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="salesRecordUploadNew" class="salesRecordUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="salesRecordShowOld" class="salesRecordShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="salesRecordDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($salesRecord, strrpos($salesRecord, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom"> RECEIPTS OR LOGBOOK (IF APPLICABLE) </label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "salesRecordSelect" name = "salesRecordSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="salesRecordDesc" name = "salesRecordDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!--INCOME TAX RETURN (IF APPLICABLE) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">INCOME TAX RETURN</label> 
                                                      <input type="file" id="incomeTaxReturn" name="incomeTaxReturn"><img id="incomeTaxReturnImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $incomeTaxReturn; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxReturnButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($incomeTaxReturn)){
                                                         echo '<button type="button" id="incomeTaxReturnUploadNew" class="incomeTaxReturnUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="incomeTaxReturnUploadNew" class="incomeTaxReturnUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="incomeTaxReturnShowOld" class="incomeTaxReturnShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="incomeTaxReturnDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTaxReturn, strrpos($incomeTaxReturn, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom"> (IF APPLICABLE) </label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "incomeTaxReturnSelect" name = "incomeTaxReturnSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxReturnDesc" name = "incomeTaxReturnDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- CONTRACT OF LEASE (IF RENTAL BUSINESS)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">CONTRACT OF LEASE</label> 
                                                      <input type="file" id="contractLease" name="contractLease"><img id="contractLeaseImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $contractLease; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractLeaseButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($contractLease)){
                                                         echo '<button type="button" id="contractLeaseUploadNew" class="contractLeaseUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="contractLeaseUploadNew" class="contractLeaseUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="contractLeaseShowOld" class="contractLeaseShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="contractLeaseDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractLease, strrpos($contractLease, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(IF RENTAL BUSINESS)</label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "contractLeaseSelect" name = "contractLeaseSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractLeaseDesc" name = "contractLeaseDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- 5 CUSTOMERS WITH CONTACT NUMBER  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">5 CUSTOMERS WITH CONTACT NUMBER</label> 
                                                      <input type="file" id="customerNumber" name="customerNumber"><img id="customerNumberImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $customerNumber; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerNumberButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($customerNumber)){
                                                         echo '<button type="button" id="customerNumberUploadNew" class="customerNumberUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="customerNumberUploadNew" class="customerNumberUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="customerNumberShowOld" class="customerNumberShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="customerNumberDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerNumber, strrpos($customerNumber, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">CONTACT NUMBER</label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "customerNumberSelect" name = "customerNumberSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerNumberDesc" name = "customerNumberDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- 5 SUPPLIERS WITH CONTACT NUMBER -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> 5 SUPPLIERS WITH</label>
                                                      <input type="file" id="customerSupplier" name="customerSupplier"><img id="customerSupplierImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $customerSupplier; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerSupplierButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($customerSupplier)){
                                                         echo '<button type="button" id="customerSupplierUploadNew" class="customerSupplierUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="customerSupplierUploadNew" class="customerSupplierUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="customerSupplierShowOld" class="customerSupplierShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="customerSupplierDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerSupplier, strrpos($customerSupplier, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">CONTACT NUMBER</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "customerSupplierSelect" name = "customerSupplierSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerSupplierDesc" name = "customerSupplierDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- OTHER SOURCE OF INCOME -->
                                               <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> OTHER SOURCE OF INCOME</label>
                                                      <input type="file" id="otherIncomeB" name="otherIncomeB"><img id="otherIncomeBImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $otherIncomeB; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherIncomeBButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($otherIncomeB)){
                                                         echo '<button type="button" id="otherIncomeBUploadNew" class="otherIncomeBUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="otherIncomeBUploadNew" class="otherIncomeBUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="otherIncomeBShowOld" class="otherIncomeBShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="otherIncomeBDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherIncomeB, strrpos($otherIncomeB, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(IF APPLICABLE)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherIncomeBSelect" name = "otherIncomeBSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
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
                                                   <div class="py-3 mt-4"><label style="font-size:120%"><u>EMPLOYED PROOF OF INCOME</u></label></div>
                                                </div>
                                             </div>
                                             <!-- EMPLOYMENT CONTRACT (IF APPLICABLE)  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">EMPLOYMENT CONTRACT</label> 
                                                      <input type="file" id="employmentContract" name="employmentContract"><img id="employmentContractImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $employmentContract; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="employmentContractButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($employmentContract)){
                                                         echo '<button type="button" id="employmentContractUploadNew" class="employmentContractUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="employmentContractUploadNew" class="employmentContractUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="employmentContractShowOld" class="employmentContractShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="employmentContractDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($employmentContract, strrpos($employmentContract, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(IF APPLICABLE)</label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "employmentContractSelect" name = "employmentContractSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="employmentContractDesc" name = "employmentContractDesc">&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- CERTIFICATE OF EMPLOYMENT WITH COMPENSATION  -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">
                                                      <label class ="individual-labels" id="tab-label" for="custom"> CERTIFICATE OF EMPLOYMENT</label> 
                                                      <input type="file" id="certificateEmployment" name="certificateEmployment"><img id="certificateEmploymentImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $certificateEmployment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="certificateEmploymentButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($certificateEmployment)){
                                                         echo '<button type="button" id="certificateEmploymentUploadNew" class="certificateEmploymentUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="certificateEmploymentUploadNew" class="certificateEmploymentUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="certificateEmploymentShowOld" class="certificateEmploymentShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="certificateEmploymentDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($certificateEmployment, strrpos($certificateEmployment, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">WITH COMPENSATION</label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "certificateEmploymentSelect" name = "certificateEmploymentSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="certificateEmploymentDesc" name = "certificateEmploymentDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- INCOME TAX RETURN -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom">INCOME TAX RETURN</label>
                                                      <input type="file" id="incomeTax" name="incomeTax"><img id="incomeTaxImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $incomeTax; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($incomeTax)){
                                                         echo '<button type="button" id="incomeTaxUploadNew" class="incomeTaxUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="incomeTaxUploadNew" class="incomeTaxUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="incomeTaxShowOld" class="incomeTaxShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="incomeTaxDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTax, strrpos($incomeTax, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(IF APPLICABLE)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "incomeTaxSelect" name = "incomeTaxSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxDesc" name = "incomeTaxDesc">
                                                   </div>
                                                </div>
                                             </div>

                                             <!-- PAYSLIP FOR 6 MONTHS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> PAYSLIP FOR 6 MONTHS</label>
                                                      <input type="file" id="payslipMonths" name="payslipMonths"><img id="payslipMonthsImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $payslipMonths; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="payslipMonthsButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($payslipMonths)){
                                                         echo '<button type="button" id="payslipMonthsUploadNew" class="payslipMonthsUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="payslipMonthsUploadNew" class="payslipMonthsUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="payslipMonthsShowOld" class="payslipMonthsShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="payslipMonthsDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($payslipMonths, strrpos($payslipMonths, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "payslipMonthsSelect" name = "payslipMonthsSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="payslipMonthsDesc" name = "payslipMonthsDesc">
                                                   </div>
                                                </div>
                                             </div>
                                          <!-- OTHER SOURCE OF INCOME -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3" >
                                                      <label class ="individual-labels" id="tab-label" for="custom"> OTHER SOURCE OF INCOME</label>
                                                      <input type="file" id="otherIncome" name="otherIncome"><img id="otherIncomeImage" src="statusImage/check.png" alt="statusImage"> 
                                                      <a href="<?php echo $otherIncome; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherIncomeButton" >Open File</button></a>
                                                      <?php 
                                                      if(!empty($otherIncome)){
                                                         echo '<button type="button" id="otherIncomeUploadNew" class="otherIncomeUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="otherIncomeUploadNew" class="otherIncomeUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="otherIncomeShowOld" class="otherIncomeShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="otherIncomeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherIncome, strrpos($otherIncome, '/') + 1, 10); ?></label>
                                                      <label class ="individual-labels" id="tab-label" for="custom">(IF APPLICABLE)</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "otherIncomeSelect" name = "otherIncomeSelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
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
                                                <div class="py-3"><label style="font-size:130%"><u>DOCUMENT REPORTS AND CASHFLOW ANALYSIS</u></label></div>
                                             </div>
                                          </div>
                                         <!-- APPRAISAL FEE RECEIPT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels" id="tab-label">APPRAISAL FEE RECEIPT</label>
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
                                           <!-- CREDIT INVESTIGATION AND CREDIT INBESTIGATION REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <label class ="individual-labels">CREDIT INVESTIGATION AND</label>
                                                   <input type="file" id="creditInvestigationReportI" name="creditInvestigationReportI"><img id="creditInvestigationReportIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $creditInvestigationReportI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportIButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($creditInvestigationReportI)){
                                                         echo '<button type="button" id="creditInvestigationReportIUploadNew" class="creditInvestigationReportIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="creditInvestigationReportIUploadNew" class="creditInvestigationReportIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="creditInvestigationReportIShowOld" class="creditInvestigationReportIShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="creditInvestigationReportIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportI, strrpos($creditInvestigationReportI, '/') + 1, 10); ?></label> 
                                                   <label class ="individual-labels">CREDIT INVESTIGATION REPORT</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select  class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "creditInvestigationReportISelect" name = "creditInvestigationReportISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="creditInvestigationReportIDesc" name = "creditInvestigationReportIDesc"  >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- APPRAISE THE PROPERTY AND COLLATERAL APPRIASAL REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class ="individual-labels">APPRAISE THE PROPERTY AND</label>
                                                   <input type="file" id="collateralAppraisalReportI" name="collateralAppraisalReportI"><img id="collateralAppraisalReportIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $collateralAppraisalReportI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="collateralAppraisalReportIButton">Open File</button></a> 
                                                   <?php 
                                                      if(!empty($collateralAppraisalReportI)){
                                                         echo '<button type="button" id="collateralAppraisalReportIUploadNew" class="collateralAppraisalReportIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="collateralAppraisalReportIUploadNew" class="collateralAppraisalReportIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="collateralAppraisalReportIShowOld" class="collateralAppraisalReportIShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="collateralAppraisalReportIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($collateralAppraisalReportI, strrpos($collateralAppraisalReportI, '/') + 1, 10); ?></label>
                                                   <label class ="individual-labels">COLLATERAL APPRAISAL REPORT</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select  class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "collateralAppraisalReportISelect" name = "collateralAppraisalReportISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="REMARKS" id="collateralAppraisalReportIDesc" name = "collateralAppraisalReportIDesc"  >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREDBOARD -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">FINANCIAL EVALUATION</label>
                                                   <input type="file" id="financialEvaluationI" name="financialEvaluationI"><img id="financialEvaluationIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $financialEvaluationI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="financialEvaluationIButton">Open File</button></a> 
                                                   <?php 
                                                      if(!empty($financialEvaluationI)){
                                                         echo '<button type="button" id="financialEvaluationIUploadNew" class="financialEvaluationIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="financialEvaluationIUploadNew" class="financialEvaluationIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="financialEvaluationIShowOld" class="financialEvaluationIShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="financialEvaluationIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($financialEvaluationI, strrpos($financialEvaluationI, '/') + 1, 10); ?></label>
                                                   <label class="individual-labels">(CASHFLOW ANALYSIS) AND BRR SCORECARD </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "financialEvaluationISelect" name = "financialEvaluationISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="financialEvaluationIDesc" name = "financialEvaluationIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:135%"><u>SIGNING OF APPROVAL</u></label></div>
                                             </div>
                                          </div>
                                            <!-- SIGNED LETTER OF APPROVAL -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; SIGNED LETTER OF APPROVAL </label>
                                                   <input type="file" id="signedLetterI" name="signedLetterI"><img id="signedLetterIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLetterI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterIButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($signedLetterI)){
                                                         echo '<button type="button" id="signedLetterIUploadNew" class="signedLetterIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="signedLetterIUploadNew" class="signedLetterIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="signedLetterIShowOld" class="signedLetterIShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="signedLetterIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterI, strrpos($signedLetterI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "signedLetterISelect" name = "signedLetterISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
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
                                                      <label class="individual-labels">&#x2022; SIGNED LETTER OF UNDERTAKING </label>
                                                      <input type="file" id="signedLetterUnderEndI" name="signedLetterUnderEndI"><img id="signedLetterUnderEndIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedLetterUnderEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterUnderEndIButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($signedLetterUnderEndI)){
                                                            echo '<button type="button" id="signedLetterUnderEndIUploadNew" class="signedLetterUnderEndIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="signedLetterUnderEndIUploadNew" class="signedLetterUnderEndIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="signedLetterUnderEndIShowOld" class="signedLetterUnderEndIShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="signedLetterUnderEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterUnderEndI, strrpos($signedLetterUnderEndI, '/') + 1, 10); ?></label> 
                                                      <label class="individual-labels">UNDERTAKING</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mt-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedLetterUnderEndISelect" name = "signedLetterUnderEndISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterUnderEndIDesc" name = "signedLetterUnderEndIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE</u></label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; SIGNED LOAN APPROVAL MEMO </label>
                                                   <input type="file" id="signedLoanMemoI" class="signedLoanMemoI" name="signedLoanMemoI"><img id="signedLoanMemoIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLoanMemoI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLoanMemoIButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($signedLoanMemoI)){
                                                            echo '<button type="button" id="signedLoanMemoIUploadNew" class="signedLoanMemoIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="signedLoanMemoIUploadNew" class="signedLoanMemoIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="signedLoanMemoIShowOld" class="signedLoanMemoIShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="signedLoanMemoIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLoanMemoI, strrpos($signedLoanMemoI, '/') + 1, 10); ?></label> 
                                                   <label class="individual-labels">MEMO </label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedLoanMemoISelect" name = "signedLoanMemoISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   <input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLoanMemoIDesc" name = "signedLoanMemoIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- Not End Buyer Section -->
                                          <div class="notEndBuyer" id="notEndBuyer" style="display:none">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><u>SIGNING OF REM CONTRACT</u></label></div>
                                                </div>
                                             </div>
                                             <!-- SIGNED REAL ESTATE MORTGAGE CONTRACT --> 
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; SIGNED REAL ESTATE</label>
                                                      <input type="file" id="remContractI" name="remContractI"><img id="remContractIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractIButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($remContractI)){
                                                            echo '<button type="button" id="remContractIUploadNew" class="remContractIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="remContractIUploadNew" class="remContractIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="remContractIShowOld" class="remContractIShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="remContractIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractI, strrpos($remContractI, '/') + 1, 10); ?></label> 
                                                      <label class="individual-labels">MORTGAGE CONTRACT</label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "remContractISelect" name = "remContractISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractIDesc" name = "remContractIDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><u>REGISTRATION IN REGISTRY OF DEEDS</u></label></div>
                                                </div>
                                             </div>
                                             <!-- REM CONTRACT ANNOTATED -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; REM CONTRACT ANNOTATED</label>
                                                      <input type="file" id="remContractAnnotatedI" name="remContractAnnotatedI"><img id="remContractAnnotatedIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractAnnotatedI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractAnnotatedIButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($remContractAnnotatedI)){
                                                            echo '<button type="button" id="remContractAnnotatedIUploadNew" class="remContractAnnotatedIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="remContractAnnotatedIUploadNew" class="remContractAnnotatedIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="remContractAnnotatedIShowOld" class="remContractAnnotatedIShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="remContractAnnotatedIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractAnnotatedI, strrpos($remContractAnnotatedI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "remContractAnnotatedISelect" name = "remContractAnnotatedISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractAnnotatedIDesc" name = "remContractAnnotatedIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:135%"><u>SIGNED DOCUMENTS AFTER THE RELEASE OF THE LOAN</u></label></div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; PROMISSORY NOTE </label>
                                                      <input type="file" id="promNoteI" name="promNoteI"><img id="promNoteIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteIButton">Open File</button></a> 
                                                      <?php 
                                                         if(!empty($promNoteI)){
                                                            echo '<button type="button" id="promNoteIUploadNew" class="promNoteIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="promNoteIUploadNew" class="promNoteIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="promNoteIShowOld" class="promNoteIShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="promNoteIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteI, strrpos($promNoteI, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "promNoteISelect" name = "promNoteISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteIDesc" name = "promNoteIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                               <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; DISCLOSURE STATEMENT </label>
                                                      <input type="file" id="disclosureStateI" name="disclosureStateI"><img id="disclosureStateIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateIButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($disclosureStateI)){
                                                            echo '<button type="button" id="disclosureStateIUploadNew" class="disclosureStateIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="disclosureStateIUploadNew" class="disclosureStateIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="disclosureStateIShowOld" class="disclosureStateIShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="disclosureStateIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateI, strrpos($disclosureStateI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "disclosureStateISelect" name = "disclosureStateISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateIDesc" name = "disclosureStateIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- MRI FORM (COUNTRY BANKERS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; INSURANCE DOCUMENTS </label>
                                                      <input type="file" id="mriFormI" name="mriFormI"><img id="mriFormIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormIButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($mriFormI)){
                                                            echo '<button type="button" id="mriFormIUploadNew" class="mriFormIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="mriFormIUploadNew" class="mriFormIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="mriFormIShowOld" class="mriFormIShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="mriFormIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormI, strrpos($mriFormI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "mriFormISelect" name = "mriFormISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormIDesc" name = "mriFormIDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="individual-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                                      <input type="file" id="amortScheduleI" name="amortScheduleI"><img id="amortScheduleIImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleIButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($amortScheduleI)){
                                                            echo '<button type="button" id="amortScheduleIUploadNew" class="amortScheduleIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="amortScheduleIUploadNew" class="amortScheduleIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="amortScheduleIShowOld" class="amortScheduleIShowOld">History</button>';
                                                      ?>
                                                      <label class="date-label" id="amortScheduleIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleI, strrpos($amortScheduleI, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "amortScheduleISelect" name = "amortScheduleISelect" tabindex="-1">
                                                         <option selected value= "NULL">Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2">INCOMPLETE</option>
                                                         <option value="3">N/A</option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleIDesc" name = "amortScheduleIDesc"  >&nbsp;
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                          <div class="endBuyer" id="endBuyer" style="display:none">
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF REM CONTRACT AND DOCUMENTS FOR LOAN RELEASES</u></label></div>
                                             </div>
                                          </div>
                                           <!-- REAL ESTATE MORTGATE CONTRACT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; REAL ESTATE MORTGAGE CONTRACT </label>
                                                   <input type="file" id="remContractEndI" name="remContractEndI"><img id="remContractEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $remContractEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractEndIButton">Open File</button></a>
                                                   <?php 
                                                         if(!empty($remContractEndI)){
                                                            echo '<button type="button" id="remContractEndIUploadNew" class="remContractEndIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="remContractEndIUploadNew" class="remContractEndIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="remContractEndIShowOld" class="remContractEndIShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="remContractEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractEndI, strrpos($remContractEndI, '/') + 1, 10); ?></label> 
                                                   <label class="individual-labels">CONTRACT</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "remContractEndISelect" name = "remContractEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractEndIDesc" name = "remContractEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                            <!-- PROMISSORY NOTE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; PROMISSORY NOTE </label>
                                                   <input type="file" id="promNoteEndI" name="promNoteEndI"><img id="promNoteEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $promNoteEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteEndIButton">Open File</button></a> 
                                                   <?php 
                                                         if(!empty($promNoteEndI)){
                                                            echo '<button type="button" id="promNoteEndIUploadNew" class="promNoteEndIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="promNoteEndIUploadNew" class="promNoteEndIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="promNoteEndIShowOld" class="promNoteEndIShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="promNoteEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteEndI, strrpos($promNoteEndI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "promNoteEndISelect" name = "promNoteEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteEndIDesc" name = "promNoteEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- DISCLOSURE STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; DISCLOSURE STATEMENT </label>
                                                   <input type="file" id="disclosureStateEndI" name="disclosureStateEndI"><img id="disclosureStateEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $disclosureStateEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateEndIButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($disclosureStateEndI)){
                                                         echo '<button type="button" id="disclosureStateEndIUploadNew" class="disclosureStateEndIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="disclosureStateEndIUploadNew" class="disclosureStateEndIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="disclosureStateEndIShowOld" class="disclosureStateEndIShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="disclosureStateEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateEndI, strrpos($disclosureStateEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "disclosureStateEndISelect" name = "disclosureStateEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateEndIDesc" name = "disclosureStateEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- INSURANCE DOCUMENTS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; INSURANCE DOCUMENTS </label>
                                                   <input type="file" id="mriFormEndI" name="mriFormEndI"><img id="mriFormEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $mriFormEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormEndIButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($mriFormEndI)){
                                                         echo '<button type="button" id="mriFormEndIUploadNew" class="mriFormEndIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="mriFormEndIUploadNew" class="mriFormEndIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="mriFormEndIShowOld" class="mriFormEndIShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="mriFormEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormEndI, strrpos($mriFormEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "mriFormEndISelect" name = "mriFormEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormEndIDesc" name = "mriFormEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- AMORTIZATION SCHEDULE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="individual-labels">&#x2022; AMORTIZATION SCHEDULE</label>
                                                   <input type="file" id="amortScheduleEndI" name="amortScheduleEndI"><img id="amortScheduleEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $amortScheduleEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleEndIButton">Open File</button></a>
                                                   <?php 
                                                      if(!empty($amortScheduleEndI)){
                                                         echo '<button type="button" id="amortScheduleEndIUploadNew" class="amortScheduleEndIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="amortScheduleEndIUploadNew" class="amortScheduleEndIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="amortScheduleEndIShowOld" class="amortScheduleEndIShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="amortScheduleEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleEndI, strrpos($amortScheduleEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "amortScheduleEndISelect" name = "amortScheduleEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleEndIDesc" name = "amortScheduleEndIDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3">&nbsp;<label style="font-size:120%"><u>SIGNING OF DOCUMENTS TO SUNTRUST PROPERTIES INC. EXCHANGING TO DEED OF UNDERTAKING</u></label></div>
                                             </div>
                                          </div>
                                           <!-- SIGNED DEED OF UNDERTAKING -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <label class="individual-labels">&#x2022; SIGNED DEED of UNDERTAKING </label>
                                                   <input type="file" id="signedDeedUnderEndI" name="signedDeedUnderEndI"><img id="signedDeedUnderEndIImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedDeedUnderEndI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedDeedUnderEndIButton">Open File</button></a></label>
                                                   <?php 
                                                      if(!empty($signedDeedUnderEndI)){
                                                         echo '<button type="button" id="signedDeedUnderEndIUploadNew" class="signedDeedUnderEndIUploadNew">+</button>';
                                                      }else{
                                                         echo '<button type="button" id="signedDeedUnderEndIUploadNew" class="signedDeedUnderEndIUploadNew" disabled>+</button>';
                                                      }
                                                         echo '<button type="button" id="signedDeedUnderEndIShowOld" class="signedDeedUnderEndIShowOld">History</button>';
                                                   ?>
                                                   <label class="date-label" id="signedDeedUnderEndIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedDeedUnderEndI, strrpos($signedDeedUnderEndI, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "signedDeedUnderEndISelect" name = "signedDeedUnderEndISelect" tabindex="-1">
                                                      <option selected value= "NULL">Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedDeedUnderEndIDesc" name = "signedDeedUnderEndIDesc" >&nbsp;
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
                                                      <label class ="individual-labels">&#x2022; LOAN UTILIZATION</label>
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
                                                      <select id="utilizationSelect" name= "utilizationSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
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
                                                      <label class ="individual-labels">&#x2022; POWERPOINT CI AND</label>
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
                                                      <label class ="individual-labels">APPRAISAL REPORT</label>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- EXCEL CASHFLOW ANALYSIS -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class ="individual-labels">&#x2022; EXCEL CASHFLOW ANALYSIS  </label>
                                                      <input type="file" id="excel" name="excel"><img id="excelImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $excel; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="excelButton">Open File</button></a>
                                                      <?php 
                                                         if(!empty($excel)){
                                                            echo '<button type="button" id=excelUploadNew" class="excelUploadNew">+</button>';
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
                                                 <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.3em">
                                                <div class="py-1">&nbsp;<label style="font-size:120%">&nbsp;&nbsp;<u>OTHERS</u></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class = "OTHERS">
                                           <!-- SPECIAL POWER OF ATTORNEY (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="powerAttorneyICheck" name="powerAttorneyICheck">
                                                   <label class ="individual-labels">SPECIAL POWER OF ATTORNEY</label>
                                                   <input type="file" id="powerAttorneyI" name="powerAttorneyI" ><img id="powerAttorneyIImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $powerAttorneyI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="powerAttorneyIButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($powerAttorneyI)){
                                                            echo '<button type="button" id=powerAttorneyIUploadNew" class="powerAttorneyIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="powerAttorneyIUploadNew" class="powerAttorneyIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="powerAttorneyIShowOld" class="powerAttorneyIShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="powerAttorneyIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerAttorneyI, strrpos($powerAttorneyI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "powerAttorneyISelect" name = "powerAttorneyISelect" tabindex="-1">
                                                      <option selected value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
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
                                                   <label class ="individual-labels" id="tab-label"> GENERAL INFORMATION SHEET</label>
                                                   <input type="file" id="generalInfo" name="generalInfo"><img id="generalInfoImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $generalInfo; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="generalInfoButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($generalInfo)){
                                                            echo '<button type="button" id=generalInfoUploadNew" class="generalInfoUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="generalInfoUploadNew" class="generalInfoUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="generalInfoShowOld" class="generalInfoShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="generalInfoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($generalInfo, strrpos($generalInfo, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "generalInfoSelect" name = "generalInfoSelect" tabindex="-1">
                                                      <option selected value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
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
                                                   <label class ="individual-labels" id="tab-label"> SECURITY EXCHANGE COMMISSION</label> 
                                                   <input type="file" id="securityExchange" name="securityExchange"><img id="securityExchangeImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $securityExchange; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="securityExchangeButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($securityExchange)){
                                                            echo '<button type="button" id=securityExchangeUploadNew" class="securityExchangeUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="securityExchangeUploadNew" class="securityExchangeUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="securityExchangeShowOld" class="securityExchangeShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="securityExchangeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($securityExchange, strrpos($securityExchange, '/') + 1, 10); ?></label>
                                                   <label class ="individual-labels" id="tab-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(SEC) WITH ARTICLES AND BY LAW</label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "securityExchangeSelect" name = "securityExchangeSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
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
                                                   <label class ="individual-labels" id="tab-label">LETTER OF GUARANTEE</label> 
                                                   <input type="file" id="letterGuarantee" name="letterGuarantee"><img id="letterGuaranteeImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $letterGuarantee; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="letterGuaranteeButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($letterGuarantee)){
                                                            echo '<button type="button" id=letterGuaranteeUploadNew" class="letterGuaranteeUploadNew">+</button>';
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
                                          <!--ORIGINAL BOARD RESOLUTION AND NOTARIZED SECRETARY CERTIFICATE (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2" >
                                                   <input class="form-check-input" type="checkbox" value="Check" id="boardResolutionCheck" name="boardResolutionCheck">
                                                   <label class ="individual-labels" id="tab-label"> ORIGINAL BOARD RESOLUTION</label>
                                                   <input type="file" id="boardResolution" name="boardResolution"><img id="boardResolutionImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $boardResolution; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="boardResolutionButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($boardResolution)){
                                                            echo '<button type="button" id=boardResolutionUploadNew" class="boardResolutionUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="boardResolutionUploadNew" class="boardResolutionUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="boardResolutionShowOld" class="boardResolutionShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="boardResolutionDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($boardResolution, strrpos($boardResolution, '/') + 1, 10); ?></label>
                                                   <label class ="individual-labels" id="tab-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AND NOTARIZED SECRETARY CERTIFICATE</label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "boardResolutionSelect" name = "boardResolutionSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
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
                                                   <label class ="individual-labels" id="tab-label"> STATEMENT OF ACCOUNT</label>
                                                   <input type="file" id="statementAccountI" name="statementAccountI"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $statementAccountI; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountIButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($statementAccountI)){
                                                            echo '<button type="button" id=statementAccountIUploadNew" class="statementAccountIUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="statementAccountIUploadNew" class="statementAccountIUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="statementAccountIShowOld" class="statementAccountIShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="statementAccountIDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccountI, strrpos($statementAccountI, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "statementAccountISelect" name = "statementAccountISelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
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
                                                   <label class ="individual-labels" id="tab-label">BILL/COST OF MATERIALS</label>
                                                   <input type="file" id="billMaterial" name="billMaterial"><img id="billMaterialImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $billMaterial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="billMaterialButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($billMaterial)){
                                                            echo '<button type="button" id=billMaterialUploadNew" class="billMaterialUploadNew">+</button>';
                                                         }else{
                                                            echo '<button type="button" id="billMaterialUploadNew" class="billMaterialUploadNew" disabled>+</button>';
                                                         }
                                                            echo '<button type="button" id="billMaterialShowOld" class="billMaterialShowOld">History</button>';
                                                      ?>
                                                   <label class="date-label" id="billMaterialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($billMaterial, strrpos($billMaterial, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                             <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "billMaterialSelect" name = "billMaterialSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="billMaterialDesc" name = "billMaterialDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PROPOSED PERSPECTIVE PLAN -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="proposedPlanCheck" name="proposedPlanCheck" > 
                                                   <label class ="individual-labels" id="tab-label">PROPOSED PERSPECTIVE PLAN</label>
                                                   <input type="file" id="proposedPlan" name="proposedPlan"><img id="proposedPlanImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $proposedPlan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proposedPlanButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($proposedPlan)){
                                                            echo '<button type="button" id=proposedPlanUploadNew" class="proposedPlanUploadNew">+</button>';
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
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "proposedPlanSelect" name = "proposedPlanSelect" tabindex="-1">
                                                      <option selected  value= "NULL" >Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2">INCOMPLETE</option>
                                                      <option value="3">N/A</option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proposedPlanDesc" name = "proposedPlanDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CIC -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div> 
                                                   &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="cicCheck" name="cicCheck">
                                                   <label class ="individual-labels">CIC </label>
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
                                                <div> 
                                                   &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="nfisCheck" name="nfisCheck">
                                                   <label class ="individual-labels">NFIS </label>
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
                                         <!-- OTHER DOCUMENTS-->
                                          <div class="row" style="margin-bottom:-1.7%; height:3em;">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="otherDocCheck" name="otherDocCheck">
                                                   <input type="text" class="individual-labels" id="editableLabel" name="edit1" placeholder="OTHERS (SUPPORTING DOCUMENTS)" value = "<?php echo $edit1 ;?>" style="font-weight: bold;" tabindex="-1">
                                                   <input type="file" id="otherDoc" name="otherDoc"><img id="otherDocImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $otherDoc; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherDocButton" >Open File</button></a>
                                                   <?php 
                                                         if(!empty($otherDoc)){
                                                            echo '<button type="button" id=otherDocUploadNew" class="otherDocUploadNew">+</button>';
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
<script>
$(document).ready(function(){
   $(document).on('click', '.btnRelease', function(e){
      var btnIndivId = $(this).val();
      // alert(btnIndivId);
      var confirmMo = confirm("Please Confirm, You want to Release this Client?");
      if(confirmMo){
         $.ajax({
            url: 'pipeIndUpd.php',
            type: 'POST',
            data: { btnIndivId: btnIndivId },
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
function initializeDataTable(tableId, ajaxUrl, indivId) {
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
                'data': function(d) {
                     d.indivId = indivId;
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
   initializeDataTable('#oldFile', 'fetch_ia_endorsement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#loanAppFormIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_loanApp.php', '<?php echo $id; ?>');
});

$(document).on('click', '#photocopyIdSignaturesShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_photoSignature.php', '<?php echo $id; ?>');
});

$(document).on('click', '#proofBillingShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_proofBilling.php', '<?php echo $id; ?>');
});

$(document).on('click', '#personalBankShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_personalBank.php', '<?php echo $id; ?>');
});

$(document).on('click', '#marriageContractShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_marriageContract.php', '<?php echo $id; ?>');
});

$(document).on('click', '#barangayClearanceShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_brgyClearance.php', '<?php echo $id; ?>');
});

$(document).on('click', '#transferCertificateShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_transferCert.php', '<?php echo $id; ?>');
});

$(document).on('click', '#taxDeclarationLotShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_taxDecLot.php', '<?php echo $id; ?>');
});

$(document).on('click', '#taxDeclarationImpShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_taxDecImp.php', '<?php echo $id; ?>');
});

$(document).on('click', '#realEstateTaxClearanceShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_realEstateTaxC.php', '<?php echo $id; ?>');
});

$(document).on('click', '#realEstateTaxReceiptShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_realExtateTaxR.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cancellationDischargeShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_cancellationD.php', '<?php echo $id; ?>');
});

$(document).on('click', '#sunTransferCertificateShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_sunTransferCertificate.php', '<?php echo $id; ?>');
});

$(document).on('click', '#sunTaxDeclarationLotShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_sunTaxDeclarationLot.php', '<?php echo $id; ?>');
});

$(document).on('click', '#sunTaxDeclarationImpShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_sunTaxDeclarationImp.php', '<?php echo $id; ?>');
});

$(document).on('click', '#sunContractSellShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_sunContractSell.php', '<?php echo $id; ?>');
});

$(document).on('click', '#sunStatementAccountShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_sunStatementAccount.php', '<?php echo $id; ?>');
});

$(document).on('click', '#updatedBusinessShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_updatedBusiness.php', '<?php echo $id; ?>');
});

$(document).on('click', '#auditedFinancialShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_auditedFinancial.php', '<?php echo $id; ?>');
});

$(document).on('click', '#inhouseFinancialShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_inhouseFinancial.php', '<?php echo $id; ?>');
});

$(document).on('click', '#businessBankStatementShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_businessBankStatement.php', '<?php echo $id; ?>');
});

$(document).on('click', '#salesRecordShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_salesRecord.php', '<?php echo $id; ?>');
});

$(document).on('click', '#incomeTaxReturnShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_incomeTaxReturn.php', '<?php echo $id; ?>');
});

$(document).on('click', '#contractLeaseShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_contractLease.php', '<?php echo $id; ?>');
});

$(document).on('click', '#customerNumberShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_customerNumber.php', '<?php echo $id; ?>');
});

$(document).on('click', '#customerSupplierShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_customerSupplier.php', '<?php echo $id; ?>');
});

$(document).on('click', '#otherIncomeBShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_otherIncomeB.php', '<?php echo $id; ?>');
});

$(document).on('click', '#employmentContractShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_employmentContract.php', '<?php echo $id; ?>');
});

$(document).on('click', '#certificateEmploymentShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_certificateEmployment.php', '<?php echo $id; ?>');
});

$(document).on('click', '#incomeTaxShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_incomeTax.php', '<?php echo $id; ?>');
});

$(document).on('click', '#payslipMonthsShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_payslipMonths.php', '<?php echo $id; ?>');
});

$(document).on('click', '#otherIncomeShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_otherIncome.php', '<?php echo $id; ?>');
});

$(document).on('click', '#powerAttorneyIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_powerAttorneyI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#generalInfoShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_generalInfo.php', '<?php echo $id; ?>');
});

$(document).on('click', '#securityExchangeShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_securityExchange.php', '<?php echo $id; ?>');
});

$(document).on('click', '#letterGuaranteeShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_letterGuarantee.php', '<?php echo $id; ?>');
});

$(document).on('click', '#statementAccountIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_boardResolution.php', '<?php echo $id; ?>');
});

$(document).on('click', '#boardResolutionShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_boardResolution.php', '<?php echo $id; ?>');
});

$(document).on('click', '#statementAccountShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_statementAccount.php', '<?php echo $id; ?>');
});

$(document).on('click', '#billMaterialShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_billMaterial.php', '<?php echo $id; ?>');
});

$(document).on('click', '#proposedPlanShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_proposedPlan.php', '<?php echo $id; ?>');
});

$(document).on('click', '#otherDocShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_otherDoc.php', '<?php echo $id; ?>');
});

$(document).on('click', '#cicShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_cic.php', '<?php echo $id; ?>');
});

$(document).on('click', '#nfisShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_nfis.php', '<?php echo $id; ?>');
});

$(document).on('click', '#receiptShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_receipt.php', '<?php echo $id; ?>');
});

$(document).on('click', '#creditInvestigationReportIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_creditInvestigationReportI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#collateralAppraisalReportIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_collateralAppraisalReportI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#financialEvaluationIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_financialEvaluationI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedLetterIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_signedLetterI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedLoanMemoIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_signedLoanMemoI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#remContractIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_remContractI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#remContractAnnotatedIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_remContractAnnotatedI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#promNoteIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_promNoteI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#disclosureStateIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_disclosureStateI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#mriFormIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_mriFormI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortScheduleIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_amortScheduleI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedLetterUnderEndIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_signedLetterUnderEndI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#remContractEndIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_remContractEndI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#promNoteEndIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_promNoteEndI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#disclosureStateEndIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_disclosureStateEndI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#mriFormEndIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_mriFormEndI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#amortScheduleEndIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_amortScheduleEndI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#signedDeedUnderEndIShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_signedDeedUnderEndI.php', '<?php echo $id; ?>');
});

$(document).on('click', '#utilizationShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_utilization.php', '<?php echo $id; ?>');
});

$(document).on('click', '#powerpointShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_powerpoint.php', '<?php echo $id; ?>');
});

$(document).on('click', '#excelShowOld', function(){
   initializeDataTable('#oldFile', 'fetch_ia_excel.php', '<?php echo $id; ?>');
});
</script>

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
         document.getElementById("endBuyerSpace").style.height="37.2em";
      }
   } else {
      $('#notEndBuyer, #collateralDocuments').show();
         if (sourceIncome === "Business"){
         document.getElementById("businessSpace").style.height="17.5em";
      }
      else{
         document.getElementById("notEndBuyerSpace").style.height="33.4em";
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

$(document).on('click', '#loanAppFormIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#photocopyIdSignaturesShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#proofBillingShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#personalBankShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#marriageContractShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#barangayClearanceShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#transferCertificateShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#taxDeclarationLotShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#taxDeclarationImpShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#realEstateTaxClearanceShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#realEstateTaxReceiptShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#cancellationDischargeShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#sunTransferCertificateShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#sunTaxDeclarationLotShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#sunTaxDeclarationImpShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#sunContractSellShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#sunStatementAccountShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#updatedBusinessShowOld', function(e){
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

$(document).on('click', '#businessBankStatementShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#salesRecordShowOld', function(e){
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

$(document).on('click', '#customerNumberShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#customerSupplierShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#otherIncomeBShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#employmentContractShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#certificateEmploymentShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#incomeTaxShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#payslipMonthsShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#otherIncomeShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#powerAttorneyIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#generalInfoShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#securityExchangeShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#letterGuaranteeShowOld', function(e){
   e.preventDefault();
   historyModal.show();
});

$(document).on('click', '#statementAccountIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#boardResolutionShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#statementAccountShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#billMaterialShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#proposedPlanShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#otherDocShowOld', function(e){
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


$(document).on('click', '#receiptShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#creditInvestigationReportIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#collateralAppraisalReportIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#financialEvaluationIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#remContractIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#remContractAnnotatedIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#promNoteIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#disclosureStateIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#mriFormIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#amortScheduleIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#signedLetterUnderEndIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#remContractEndIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#promNoteEndIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#disclosureStateEndIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#mriFormEndIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#amortScheduleEndIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#signedDeedUnderEndIShowOld', function(e){
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

$(document).on('click', '#signedLetterIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
});

$(document).on('click', '#signedLoanMemoIShowOld', function(e){
   e.preventDefault();
   historyModal.show()
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

   $(document).on('change', '.signedLoanMemoI', function(e){
      e.preventDefault();
      var lam = $('.signedLoanMemoI').val();
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
        var individuall = document.getElementById('individual-form')
        var updaterForm = document.getElementById('updaterTerms-Form');
        var formData = new FormData(updaterForm);
        $.ajax({
            url: 'loanIndividualUpdater.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                alert('Updated Successfully!');
                individuall.ajax.reload();
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

// LOOP THROUGH EACH INPUT ELEMENT AND SET THE HIDDEN ATTRIBUTE
inputElements.forEach(inputElement => {
  inputElement.style.visibility="hidden";
});
  }
hideText();

  function updateFileStatus(inputId, imageId) {
      var inputFile = document.getElementById(inputId);
      var image = document.getElementById(imageId);

      if (inputFile.files.length > 0) {
         image.src = 'statusImage/check.png'; // SHOW CHECK ICON IF FILE IS UPLOADED
         image.style.visibility = 'visible'; // MAKE THE IMAGE VISIBLE
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
handleSelectChange('cicSelect', 'cicDesc');
handleSelectChange('nfisSelect', 'nfisDesc');
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

<!-- INDIVIDUAL FORM -->
<script>
var indivForm = document.getElementById("individual-form");
var indivId = "<?php echo $id; ?>";
var fullname = "<?php echo $fullname; ?>";
var salaryType = "<?php echo $type; ?>";
var branch = "<?php echo $branch; ?>";
var loanType = "<?php echo $loanType; ?>";
var endPrompt = ""; // Global variable for remarks

function uploadFileI() {
  var indivformData = new FormData(indivForm);
  indivformData.append('indivId', indivId);
  indivformData.append('fullname', fullname);
  indivformData.append('salaryType', salaryType);
  indivformData.append('branch', branch);
  indivformData.append('loanType', loanType);
  
  // Append the endPrompt to the FormData
  indivformData.append('endPrompt', endPrompt);
  $.ajax({
    url: 'loanIndividualUploadData.php', 
    type: 'POST',
    data: indivformData,
    processData: false,
    contentType: false,
    
    success: function(response) {
// AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
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
updateFileStatus('cic', 'cicImage');
updateFileStatus('nfis', 'nfisImage');
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

var isUploading = false;  // Flag to track upload process

function handleEndorsementUpload(inputSelector) {
    if (isUploading) return;  // Prevent multiple prompts for a single click

    isUploading = true;  // Set the flag to indicate the upload process has started
    var endPrompt = prompt('Remarks: ');

    if (endPrompt !== null && endPrompt.trim() !== "") {
        // Create FormData object
        var formData = new FormData();
        var indivId = "<?php echo $id; ?>";
        formData.append('endPrompt', endPrompt);  // Add remarks to the form data
        formData.append('indivId', indivId);

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
                        url: 'loanIndividualUploadData.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                     success: function(response) {
                           console.log("Server response:", response); // Log response for debugging
                           alert('Updated Successfully!');
                           isUploading = false;  // Reset flag after successful upload
                           if(inputSelector !== '#signedLoanMemoI'){
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


    // Use the function for endorsement upload
    $(document).on('click', '.endorsementUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#endorsement');
    });

    // for loanAppFormI
    $(document).on('click', '.loanAppFormIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#loanAppFormI');
    });

    // for photocopyIdSignatures
    $(document).on('click', '.photocopyIdSignaturesUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#photocopyIdSignatures');
    });

    //  for proofBilling
    $(document).on('click', '.proofBillingUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#proofBilling');
    });

    // for personalBank
    $(document).on('click', '.personalBankUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#personalBank');
    });

    //  for marriageContract
    $(document).on('click', '.marriageContractUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#marriageContract');
    });

    //  for barangayClearance
    $(document).on('click', '.barangayClearanceUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#barangayClearance');
    });

    //  for transferCertificate
    $(document).on('click', '.transferCertificateUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#transferCertificate');
    });

    //  for taxDeclarationLot
    $(document).on('click', '.taxDeclarationLotUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#taxDeclarationLot');
    });

    //  for taxDeclarationImp
    $(document).on('click', '.taxDeclarationImpUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#taxDeclarationImp');
    });

    //  for realEstateTaxClearance
    $(document).on('click', '.realEstateTaxClearanceUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#realEstateTaxClearance');
    });

    //  for realEstateTaxReceipt
    $(document).on('click', '.realEstateTaxReceiptUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#realEstateTaxReceipt');
    });

     //  for cancellationDischarge
    $(document).on('click', '.cancellationDischargeUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#cancellationDischarge');
    });

    //  for sunTransferCertificate
    $(document).on('click', '.sunTransferCertificateUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#sunTransferCertificate');
    });

    //  for sunTaxDeclarationLot
    $(document).on('click', '.sunTaxDeclarationLotUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#sunTaxDeclarationLot');
    });

    //  for sunTaxDeclarationImp
    $(document).on('click', '.sunTaxDeclarationImpUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#sunTaxDeclarationImp');
    });

    //  for sunContractSell
    $(document).on('click', '.sunContractSellUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#sunContractSell');
    });

    //  for sunStatementAccount
    $(document).on('click', '.sunStatementAccountUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#sunStatementAccount');
    });

    //  for updatedBusiness
    $(document).on('click', '.updatedBusinessUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#updatedBusiness');
    });

    //  for auditedFinancial
    $(document).on('click', '.auditedFinancialUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#auditedFinancial');
    });

    //  for inhouseFinancial
    $(document).on('click', '.inhouseFinancialUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#inhouseFinancial');
    });

    //  for businessBankStatement
    $(document).on('click', '.businessBankStatementUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#businessBankStatement');
    });

    //  for salesRecord
    $(document).on('click', '.salesRecordUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#salesRecord');
    });

    //  for incomeTaxReturn
    $(document).on('click', '.incomeTaxReturnUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#incomeTaxReturn');
    });

    //  for contractLease
    $(document).on('click', '.contractLeaseUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#contractLease');
    });

    //  for customerNumber
    $(document).on('click', '.customerNumberUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#customerNumber');
    });

    //  for customerSupplier
    $(document).on('click', '.customerSupplierUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#customerSupplier');
    });

    //  for otherIncomeB
    $(document).on('click', '.otherIncomeBUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#otherIncomeB');
    });

    //  for employmentContract
    $(document).on('click', '.employmentContractUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#employmentContract');
    });

    //  for certificateEmployment
    $(document).on('click', '.certificateEmploymentUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#certificateEmployment');
    });

    //  for incomeTax
    $(document).on('click', '.incomeTaxUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#incomeTax');
    });

    //  for payslipMonths
    $(document).on('click', '.payslipMonthsUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#payslipMonths');
    });

    //  for otherIncome
    $(document).on('click', '.otherIncomeUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#otherIncome');
    });

    //  for receipt
    $(document).on('click', '.receiptUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#receipt');
    });

    //  for creditInvestigationReportI
    $(document).on('click', '.creditInvestigationReportIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#creditInvestigationReportI');
    });

    //  for collateralAppraisalReportI
    $(document).on('click', '.collateralAppraisalReportIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#collateralAppraisalReportI');
    });

    //  for financialEvaluationI
    $(document).on('click', '.financialEvaluationIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#financialEvaluationI');
    });

    //  for signedLetterI
    $(document).on('click', '.signedLetterIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedLetterI');
    });

    //  for signedLetterUnderEndI
    $(document).on('click', '.signedLetterUnderEndIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedLetterUnderEndI');
    });

    //  for signedLoanMemoI
    $(document).on('click', '.signedLoanMemoIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedLoanMemoI');
    });

    //  for remContractI
    $(document).on('click', '.remContractIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#remContractI');
    });

    //  for remContractAnnotatedI
    $(document).on('click', '.remContractAnnotatedIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#remContractAnnotatedI');
    });

    //  for promNoteI
    $(document).on('click', '.promNoteIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#promNoteI');
    });

    //  for disclosureStateI
    $(document).on('click', '.disclosureStateIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#disclosureStateI');
    });

    //  for mriFormI
    $(document).on('click', '.mriFormIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#mriFormI');
    });

    //  for amortScheduleI
    $(document).on('click', '.amortScheduleIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#amortScheduleI');
    });

    //  for remContractEndI
    $(document).on('click', '.remContractEndIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#remContractEndI');
    });

    //  for promNoteEndI
    $(document).on('click', '.promNoteEndIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#promNoteEndI');
    });

    //  for disclosureStateEndI
    $(document).on('click', '.disclosureStateEndIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#disclosureStateEndI');
    });

    //  for mriFormEndI
    $(document).on('click', '.mriFormEndIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#mriFormEndI');
    });

    //  for amortScheduleEndI
    $(document).on('click', '.amortScheduleEndIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#amortScheduleEndI');
    });

    //  for signedDeedUnderEndI
    $(document).on('click', '.signedDeedUnderEndIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#signedDeedUnderEndI');
    });

    //  for utilization
    $(document).on('click', '.utilizationUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#utilization');
    });

    //  for powerpoint
    $(document).on('click', '.powerpointUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#powerpoint');
    });

    //  for excel
    $(document).on('click', '.excelUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#excel');
    });

    //  for powerAttorneyI
    $(document).on('click', '.powerAttorneyIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#powerAttorneyI');
    });

    //  for generalInfo
    $(document).on('click', '.generalInfoUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#generalInfo');
    });

    //  for securityExchange
    $(document).on('click', '.securityExchangeUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#securityExchange');
    });

    //  for letterGuarantee
    $(document).on('click', '.letterGuaranteeUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#letterGuarantee');
    });

    //  for boardResolution
    $(document).on('click', '.boardResolutionUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#boardResolution');
    });

    //  for statementAccountI
    $(document).on('click', '.statementAccountIUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#statementAccountI');
    });

    //  for billMaterial
    $(document).on('click', '.billMaterialUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#billMaterial');
    });

    //  for proposedPlan
    $(document).on('click', '.proposedPlanUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#proposedPlan');
    });

    //  for otherDoc
    $(document).on('click', '.otherDocUploadNew', function(e){
        e.preventDefault();
        handleEndorsementUpload('#otherDoc');
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


indivForm.addEventListener("change", function() {
  uploadFileI();
});

 </script> 
<!--  APPROVAL STATUS AND DESCRIPTION -->
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
          descriptionElement.value = ""; // CLEAR THE VALUE IF IT DOESN'T CONTAIN "--"
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
selectOptionBasedOnValue('<?php echo $cicSelect; ?>', 'cicSelect','cicDesc');
selectOptionBasedOnValue('<?php echo $nfisSelect; ?>', 'nfisSelect','nfisDesc');
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
  var cicValue = "<?php echo $cicCheck; ?>";
  var nfisValue = "<?php echo $nfisCheck; ?>";
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
  const cicCheck = document.getElementById('cicCheck');
  const nfisCheck = document.getElementById('nfisCheck');
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

showInput(powerAttorneyIValue, powerAttorneyICheck,'powerAttorneyI', 'powerAttorneyISelect', 'powerAttorneyIDesc',`powerAttorneyIImage` );
showInput(generalInfoValue, generalInfoCheck,'generalInfo', 'generalInfoSelect', 'generalInfoDesc',`generalInfoImage`);
showInput(securityExchangeValue, securityExchangeCheck,'securityExchange', 'securityExchangeSelect', 'securityExchangeDesc',`securityExchangeImage`);
showInput(letterGuaranteeValue, letterGuaranteeCheck, 'letterGuarantee', 'letterGuaranteeSelect', 'letterGuaranteeDesc',`letterGuaranteeImage`);
showInput(boardResolutionValue, boardResolutionCheck, 'boardResolution', 'boardResolutionSelect', 'boardResolutionDesc',`boardResolutionImage`);
showInput(statementAccountIValue, statementAccountICheck, 'statementAccountI', 'statementAccountISelect', 'statementAccountIDesc',`statementAccountImage`);
showInput(billMaterialValue, billMaterialCheck, 'billMaterial', 'billMaterialSelect', 'billMaterialDesc',`billMaterialImage`);
showInput(proposedPlanValue, proposedPlanCheck,'proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc',`proposedPlanImage`);
showInput(otherDocValue, otherDocCheck,'otherDoc', 'otherDocSelect', 'otherDocDesc',`otherDocImage`);
showInput(cicValue, cicCheck,'cic', 'cicSelect', 'cicDesc',`cicImage`);
showInput(nfisValue,nfisCheck,'nfis', 'nfisSelect', 'nfisDesc',`nfisImage`);


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

document.getElementById("cicCheck").addEventListener("click", function() {
    toggleVisibility('cic');

});

document.getElementById("nfisCheck").addEventListener("click", function() {
    toggleVisibility('nfis');

});

</script>
<script>
// RESET THE VALUE OF SELECT TO ZERO(OPTION)
function resetIndex(targetId,targetSelect,targetDesc){
   document.getElementById(targetId).addEventListener('change', function() {
      var selectElement = document.getElementById(targetSelect,"loanAppFormIDate");
      selectElement.selectedIndex = 0;
      document.getElementById(targetDesc).style.visibility="hidden"; // CHANGE TO THE FIRST OPTION
   });
}
// PRINCIPAL BORROWER
resetIndex('endorsement', 'endorsementSelect', 'endorsementDesc');
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
resetIndex('otherIncomeB', 'otherIncomeBSelect', 'otherIncomeBDesc');
// EMPLOYED PROOF OF INCOME
resetIndex('employmentContract', 'employmentContractSelect', 'employmentContractDesc');
resetIndex('certificateEmployment', 'certificateEmploymentSelect', 'certificateEmploymentDesc');
resetIndex('incomeTax', 'incomeTaxSelect', 'incomeTaxDesc');
resetIndex('payslipMonths', 'payslipMonthsSelect', 'payslipMonthsDesc');
resetIndex('otherIncome', 'otherIncomeSelect', 'otherIncomeDesc');
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
resetIndex('cic', 'cicSelect', 'cicDesc');
resetIndex('nfis', 'nfisSelect', 'nfisDesc');
// DOCUMENTS
resetIndex('receipt', 'receiptSelect', 'receiptDesc');
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
      if(files !== ""){
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
setFileVisibility("<?php echo $cic; ?>", "<?php echo $cicSelect; ?>", 'cic', 'cicImage', 'cicButton', 'cicDate');
setFileVisibility("<?php echo $nfis; ?>", "<?php echo $nfisSelect; ?>", 'nfis', 'nfisImage', 'nfisButton', 'nfisDate');
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
setFileVisibility("<?php echo $powerpoint; ?>", "", 'powerpoint', 'powerpointImage', 'powerpointButton', 'powerpointDate');
setFileVisibility("<?php echo $excel; ?>", "", 'excel', 'excelImage', 'excelButton', 'excelDate');

</script>

<script>
  function handleSearch() {
    // BUTTONS SELECTORS
    const selectElements = document.querySelectorAll('#individual select');
    const descriptionInputs = document.querySelectorAll('#individual input[type=text]');
    const inputFiles = document.querySelectorAll('.individual-tabs input[type=file]');
    const fileButtons = document.querySelectorAll('.btn.btn-outline-success.btnFile');
    const checkboxes = document.querySelectorAll(".OTHERS input[type=checkbox]");

        var username = "<?php echo $_SESSION['username']; ?>";
        var bankposition = "<?php echo $_SESSION['bankposition']; ?>";
        var position = "<?php echo $_SESSION['position']; ?>";
        var department = "<?php echo $_SESSION['department']; ?>";

        // ONLY THIS PERSON CAN ACCESS APRROVAL SECTION
        if (bankposition !== "Loan Docu. Assistant" && department !== "1" && username !== "jlcricafrente" && username !== "cdcruz") {
                  selectElements.forEach(function(selectElement) {
                     selectElement.style.pointerEvents = "none";
             });
                  descriptionInputs.forEach(function(descriptionInput) {
                     descriptionInput.setAttribute("readonly", "readonly");
             });
         }
  // REQUIREMENTS RESTRICTION
  if(position!=="BM" && username !== "jabportillo" && bankposition!=="LOAN Assistant" && bankposition!=="LOAN Officer" &&  department!=="1" && username !== "ejcemata" 
       && username !== "dgayac" && username !== "dmsantos" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
       inputFiles.forEach(function(inputFile){
         inputFile.style.display="none";
         
      });
   }
   if(bankposition!=="LOAN Officer" && bankposition !== 'LOAN Assistant' && bankposition !== "Credit Officer" && bankposition !== "Credit Investigator" && department !== "1" && in_array([username], ['rdiones', 'cdcruz', 'rdalvarez', 'jlcvalero'], true)){
      document.getElementById("creditInvestigationReportI").style.display="none";
   } 
   if(bankposition!=="Credit Officer"  && bankposition!=="Credit Investigator" && department !=="1" && bankposition!=="LOAN Officer" && bankposition !== 'LOAN Assistant' && username !== "cdcruz"){
      document.getElementById("collateralAppraisalReportI").style.display="none";
   } 
   if(bankposition!=="Credit Risk" && department !== "1"){
      document.getElementById("financialEvaluationI").style.display="none";
      document.getElementById("excel").style.display="none";
   } 
   if(bankposition!=="LOAN Officer" && bankposition !== 'LOAN Assistant' && department !=="1" && username !== "cdcruz"){
      document.getElementById("signedLetterI").style.display="none";
      document.getElementById("signedLetterUnderEndI").style.display="none";
      document.getElementById("signedLoanMemoI").style.display="none";
      document.getElementById("signedDeedUnderEndI").style.display="none";
      // PN-DS-AS
      document.getElementById("promNoteI").style.display="none";
      document.getElementById("disclosureStateI").style.display="none";
      document.getElementById("mriFormI").style.display="none";
      document.getElementById("amortScheduleI").style.display="none";
      // PN-DS-AS END BUYER
      document.getElementById("promNoteEndI").style.display="none";
      document.getElementById("disclosureStateEndI").style.display="none";
      document.getElementById("mriFormEndI").style.display="none";
      document.getElementById("amortScheduleEndI").style.display="none";
      // PRESENTATION
      document.getElementById("powerpoint").style.display="none";
   } 
   if(bankposition!=="ROPOA Docu. Assistant"  && username !== "jlcricafrente" && username !== "cdcruz" && bankposition!=="ROPOA Officer" && department !=="1"){
      document.getElementById("remContractI").style.display="none";
      document.getElementById("remContractEndI").style.display="none";
   } 
   if(bankposition!=="Collection Officer" && username !== "jlcricafrente" && username !== "cdcruz" && bankposition!=="LOAN Docu. Officer" && department !=="1"){
      document.getElementById("remContractAnnotatedI").style.display="none";
   } 
   if(bankposition!=="LOAN Officer" && bankposition !== 'LOAN Assistant' && position!=="BM" && username !== "jabportillo" && username !== "ejcemata" && username !== "dgayac" 
      && username !== "dmsantos" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== "jcvillanueva" && username !== 'rdalvarez' && username !== "cdcruz"){
      document.getElementById("powerAttorneyI").style.display="none";
      document.getElementById("generalInfo").style.display="none";
      document.getElementById("securityExchange").style.display="none";
      document.getElementById("letterGuarantee").style.display="none";
      document.getElementById("boardResolution").style.display="none";
      document.getElementById("statementAccountI").style.display="none";
      document.getElementById("billMaterial").style.display="none";
      document.getElementById("proposedPlan").style.display="none";
      document.getElementById("otherDoc").style.display="none";

      document.getElementById("powerAttorneyIUploadNew").style.display="none";
      document.getElementById("generalInfoUploadNew").style.display="none";
      document.getElementById("securityExchangeUploadNew").style.display="none";
      document.getElementById("letterGuaranteeUploadNew").style.display="none";
      document.getElementById("boardResolutionUploadNew").style.display="none";
      document.getElementById("statementAccountIUploadNew").style.display="none";
      document.getElementById("billMaterialUploadNew").style.display="none";
      document.getElementById("proposedPlanUploadNew").style.display="none";
      document.getElementById("otherDocUploadNew").style.display="none";
   }
   // NEXTBANK PRODCT ID
   if(bankposition!=="LOAN Officer" && bankposition !== 'LOAN Assistant' && department != "1"){
      document.getElementById("nextbankSection").style.display="none";
   } 
   document.getElementById("productID").removeAttribute("readonly");
   // CHECKMARK ACCESS
   if(bankposition !== "Loan Docu. Assistant" && bankposition !== "LOAN Assistant" && department !== "1" && position !== "BM" && username !== "jabportillo" 
      && username !== "ejcemata" && username !== "dgayac" && username !== "dmsantos" && username !== "hmmendoza" && username !== "tjqpasicolan" && username !== 'rdalvarez'){
      checkboxes.forEach(function (checkbox){
         checkbox.style.pointerEvents = "none";
      });
      document.getElementById("editableLabel").style.pointerEvents = "none";
   } 
   if(bankposition !== "Collection Officer" && department !== "1" && position !== "BM" && username !== 'hriegodedios' && 
      username !== "hmmendoza" && username !== "tjqpasicolan" && username !== "jabportillo" && username !== "ejcemata" && 
      username !== "dgayac" && username !== "dmsantos" && username !== "cdcruz" && username !== 'cgluda' && username !== 'rdalvarez'){
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
$(document).ready(function(){
   //     function handleEndorsementUpload(inputSelector) {
   //       var endPrompt = prompt('Remarks:');

   // if (endPrompt !== null && endPrompt.trim() !== "") {
   //     // Create FormData object
   //     var formData = new FormData();
   //     formData.append('endPrompt', endPrompt); // Add remarks to the form data

   //     // Trigger the file input and append the selected file to the form data
   //     setTimeout(function(){
   //         var fileInput = document.querySelector(inputSelector);
   //         fileInput.onchange = function() {
   //             var file = fileInput.files[0];
   //             if (file) {
   //                 formData.append(fileInput.name, file);  // Add file to the form data
   //                 // Send form data via AJAX
   //                 $.ajax({
   //                     url: 'loanIndividualUploadData.php',
   //                     type: 'POST',
   //                     data: formData,
   //                     contentType: false,
   //                     processData: false,
   //                     success: function(response) {
   //                         alert('Updated Successfully!');
   //                     },
   //                     error: function() {
   //                         alert('Failed to upload');
   //                     }
   //                 });
   //             }
   //         };
   //         $(inputSelector).click();
   //     }, 100);
   // } else {
   //     alert('Remarks are needed to proceed.');
   // }
   // }

    // Use the function for endorsement upload
   //  $(document).on('click', '.endorsementUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#endorsement');
   //  });

   //  // for loanAppFormI
   //  $(document).on('click', '.loanAppFormIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#loanAppFormI');
   //  });

   //  // for photocopyIdSignatures
   //  $(document).on('click', '.photocopyIdSignaturesUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#photocopyIdSignatures');
   //  });

   //  //  for proofBilling
   //  $(document).on('click', '.proofBillingUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#proofBilling');
   //  });

   //  // for personalBank
   //  $(document).on('click', '.personalBankUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#personalBank');
   //  });

   //  //  for marriageContract
   //  $(document).on('click', '.marriageContractUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#marriageContract');
   //  });

   //  //  for barangayClearance
   //  $(document).on('click', '.barangayClearanceUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#barangayClearance');
   //  });

   //  //  for transferCertificate
   //  $(document).on('click', '.transferCertificateUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#transferCertificate');
   //  });

   //  //  for taxDeclarationLot
   //  $(document).on('click', '.taxDeclarationLotUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#taxDeclarationLot');
   //  });

   //  //  for taxDeclarationImp
   //  $(document).on('click', '.taxDeclarationImpUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#taxDeclarationImp');
   //  });

   //  //  for realEstateTaxClearance
   //  $(document).on('click', '.realEstateTaxClearanceUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#realEstateTaxClearance');
   //  });

   //  //  for realEstateTaxReceipt
   //  $(document).on('click', '.realEstateTaxReceiptUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#realEstateTaxReceipt');
   //  });

   //   //  for cancellationDischarge
   //  $(document).on('click', '.cancellationDischargeUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#cancellationDischarge');
   //  });

   //  //  for sunTransferCertificate
   //  $(document).on('click', '.sunTransferCertificateUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#sunTransferCertificate');
   //  });

   //  //  for sunTaxDeclarationLot
   //  $(document).on('click', '.sunTaxDeclarationLotUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#sunTaxDeclarationLot');
   //  });

   //  //  for sunTaxDeclarationImp
   //  $(document).on('click', '.sunTaxDeclarationImpUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#sunTaxDeclarationImp');
   //  });

   //  //  for sunContractSell
   //  $(document).on('click', '.sunContractSellUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#sunContractSell');
   //  });

   //  //  for sunStatementAccount
   //  $(document).on('click', '.sunStatementAccountUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#sunStatementAccount');
   //  });

   //  //  for updatedBusiness
   //  $(document).on('click', '.updatedBusinessUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#updatedBusiness');
   //  });

   //  //  for auditedFinancial
   //  $(document).on('click', '.auditedFinancialUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#auditedFinancial');
   //  });

   //  //  for inhouseFinancial
   //  $(document).on('click', '.inhouseFinancialUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#inhouseFinancial');
   //  });

   //  //  for businessBankStatement
   //  $(document).on('click', '.businessBankStatementUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#businessBankStatement');
   //  });

   //  //  for salesRecord
   //  $(document).on('click', '.salesRecordUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#salesRecord');
   //  });

   //  //  for incomeTaxReturn
   //  $(document).on('click', '.incomeTaxReturnUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#incomeTaxReturn');
   //  });

   //  //  for contractLease
   //  $(document).on('click', '.contractLeaseUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#contractLease');
   //  });

   //  //  for customerNumber
   //  $(document).on('click', '.customerNumberUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#customerNumber');
   //  });

   //  //  for customerSupplier
   //  $(document).on('click', '.customerSupplierUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#customerSupplier');
   //  });

   //  //  for otherIncomeB
   //  $(document).on('click', '.otherIncomeBUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#otherIncomeB');
   //  });

   //  //  for employmentContract
   //  $(document).on('click', '.employmentContractUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#employmentContract');
   //  });

   //  //  for certificateEmployment
   //  $(document).on('click', '.certificateEmploymentUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#certificateEmployment');
   //  });

   //  //  for incomeTax
   //  $(document).on('click', '.incomeTaxUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#incomeTax');
   //  });

   //  //  for payslipMonths
   //  $(document).on('click', '.payslipMonthsUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#payslipMonths');
   //  });

   //  //  for otherIncome
   //  $(document).on('click', '.otherIncomeUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#otherIncome');
   //  });

   //  //  for receipt
   //  $(document).on('click', '.receiptUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#receipt');
   //  });

   //  //  for creditInvestigationReportI
   //  $(document).on('click', '.creditInvestigationReportIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#creditInvestigationReportI');
   //  });

   //  //  for collateralAppraisalReportI
   //  $(document).on('click', '.collateralAppraisalReportIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#collateralAppraisalReportI');
   //  });

   //  //  for financialEvaluationI
   //  $(document).on('click', '.financialEvaluationIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#financialEvaluationI');
   //  });

   //  //  for signedLetterI
   //  $(document).on('click', '.signedLetterIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#signedLetterI');
   //  });

   //  //  for signedLetterUnderEndI
   //  $(document).on('click', '.signedLetterUnderEndIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#signedLetterUnderEndI');
   //  });

   //  //  for signedLoanMemoI
   //  $(document).on('click', '.signedLoanMemoIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#signedLoanMemoI');
   //  });

   //  //  for remContractI
   //  $(document).on('click', '.remContractIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#remContractI');
   //  });

   //  //  for remContractAnnotatedI
   //  $(document).on('click', '.remContractAnnotatedIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#remContractAnnotatedI');
   //  });

   //  //  for promNoteI
   //  $(document).on('click', '.promNoteIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#promNoteI');
   //  });

   //  //  for disclosureStateI
   //  $(document).on('click', '.disclosureStateIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#disclosureStateI');
   //  });

   //  //  for mriFormI
   //  $(document).on('click', '.mriFormIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#mriFormI');
   //  });

   //  //  for amortScheduleI
   //  $(document).on('click', '.amortScheduleIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#amortScheduleI');
   //  });

   //  //  for remContractEndI
   //  $(document).on('click', '.remContractEndIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#remContractEndI');
   //  });

   //  //  for promNoteEndI
   //  $(document).on('click', '.promNoteEndIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#promNoteEndI');
   //  });

   //  //  for disclosureStateEndI
   //  $(document).on('click', '.disclosureStateEndIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#disclosureStateEndI');
   //  });

   //  //  for mriFormEndI
   //  $(document).on('click', '.mriFormEndIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#mriFormEndI');
   //  });

   //  //  for amortScheduleEndI
   //  $(document).on('click', '.amortScheduleEndIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#amortScheduleEndI');
   //  });

   //  //  for signedDeedUnderEndI
   //  $(document).on('click', '.signedDeedUnderEndIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#signedDeedUnderEndI');
   //  });

   //  //  for utilization
   //  $(document).on('click', '.utilizationUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#utilization');
   //  });

   //  //  for powerpoint
   //  $(document).on('click', '.powerpointUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#powerpoint');
   //  });

   //  //  for excel
   //  $(document).on('click', '.excelUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#excel');
   //  });

   //  //  for powerAttorneyI
   //  $(document).on('click', '.powerAttorneyIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#powerAttorneyI');
   //  });

   //  //  for generalInfo
   //  $(document).on('click', '.generalInfoUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#generalInfo');
   //  });

   //  //  for securityExchange
   //  $(document).on('click', '.securityExchangeUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#securityExchange');
   //  });

   //  //  for letterGuarantee
   //  $(document).on('click', '.letterGuaranteeUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#letterGuarantee');
   //  });

   //  //  for boardResolution
   //  $(document).on('click', '.boardResolutionUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#boardResolution');
   //  });

   //  //  for statementAccountI
   //  $(document).on('click', '.statementAccountIUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#statementAccountI');
   //  });

   //  //  for billMaterial
   //  $(document).on('click', '.billMaterialUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#billMaterial');
   //  });

   //  //  for proposedPlan
   //  $(document).on('click', '.proposedPlanUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#proposedPlan');
   //  });

   //  //  for otherDoc
   //  $(document).on('click', '.otherDocUploadNew', function(e){
   //      e.preventDefault();
   //      handleEndorsementUpload('#otherDoc');
   //  });

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
showText('loanAppFormIDesc','8%');
showText('photocopyIdSignaturesDesc','8%');
showText('proofBillingDesc','8%');
showText('personalBankDesc','8%');
showText('marriageContractDesc','8%');
showText('barangayClearanceDesc','8%');
// COLLATERAL DOCUMENTS
showText('transferCertificateDesc','28%');
showText('taxDeclarationLotDesc','28%');
showText('taxDeclarationImpDesc','28%');
showText('realEstateTaxClearanceDesc','28%');
showText('realEstateTaxReceiptDesc','28%');
showText('cancellationDischargeDesc','28%');
// SUNTRUST DOCUMENTS
showText('sunTransferCertificateDesc','28%');
showText('sunTaxDeclarationLotDesc','28%');
showText('sunTaxDeclarationImpDesc','28%');
showText('sunContractSellDesc','28%');
showText('sunStatementAccountDesc','28%');
// BUSINESS PROOF OF INCOME
showText('updatedBusinessDesc','5%');
showText('auditedFinancialDesc','5%');
showText('inhouseFinancialDesc','5%');
showText('businessBankStatementDesc','5%');
showText('salesRecordDesc','5%');
showText('incomeTaxReturnDesc','5%');
showText('contractLeaseDesc','5%');
showText('customerNumberDesc','5%');
showText('customerSupplierDesc','5%');
showText('otherIncomeBDesc','5%');
// EMPLOYED PROOF OF INCOME
showText('employmentContractDesc','46%');
showText('certificateEmploymentDesc','46%');
showText('incomeTaxDesc','46%');
showText('payslipMonthsDesc','46%');
showText('otherIncomeDesc','46%');
// OTHERS
showText('powerAttorneyIDesc','61.5%');
showText('generalInfoDesc','61.5%');
showText('securityExchangeDesc','61.5%');
showText('letterGuaranteeDesc','61.5%');
showText('boardResolutionDesc','61.5%');
showText('statementAccountIDesc','61.5%');
showText('billMaterialDesc','61.5%');
showText('proposedPlanDesc','61.5%');
showText('otherDocDesc','61.5%');
// DOCUMENTS
showText('receiptDesc','8%');
showText('creditInvestigationReportIDesc','8%');
showText('collateralAppraisalReportIDesc','8%');
showText('financialEvaluationIDesc','8%');
showText('signedLetterIDesc','20%');
showText('signedLetterUnderEndIDesc','20%');
showText('signedLoanMemoIDesc','20%');
showText('remContractIDesc','20%');
showText('remContractAnnotatedIDesc','25%');
showText('promNoteIDesc','35%');
showText('disclosureStateIDesc','35%');
showText('mriFormIDesc','35%');
showText('amortScheduleIDesc','35%');
showText('remContractEndIDesc','35%');
showText('promNoteEndIDesc','35%');
showText('disclosureStateEndIDesc','35%');
showText('mriFormEndIDesc','35%');
showText('amortScheduleEndIDesc','35%');
showText('signedDeedUnderEndIDesc','35%');
showText('utilizationDesc','45%');
    </script>

</body>
</html>