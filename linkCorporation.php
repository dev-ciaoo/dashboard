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
           }
         }

         if ($type == "REM: Corporation") {
         
         ?>

      <?php
         $query3 = "SELECT * FROM corporation WHERE corpLoanId=$id ";
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
         
         
         }
         

         
         // CALCULATION OF PERCENTAGE
         $requirements = array( $loanAppFormCSelect, $companyProfileSelect, $governmentIdSelect,$secRegistrationSelect, $latestGISSelect, $copyBRSSelect, 
         $copyidCSTSelect, $transferCertTitleSelect, $taxDeclarationSelect, $taxDeclartionICTCSelect,$realStateReceiptSelect, $realEstateTaxClearanceSelect, 
         $copyUpdatedBPSelect, $auditedFinancialSelect, $inhouseFinancialSelect, $latestBankSelect,$contractLeaseSelect, $customerContactSelect, $supplierContactSelect, 
         $creditInvestigationReportCSelect, $collateralAppraisalReportCSelect, $financialEvaluationCSelect, $signedLetterCSelect, $signedLoanMemoCSelect
         );
         $endBuyerDocuments=array($signedLetterUnderEndCSelect, $remContractEndCSelect,  $promNoteEndCSelect, $disclosureStateEndCSelect,  
         $mriFormEndCSelect, $signedDeedUnderEndCSelect);
         
         $notEndBuyerDocuments=array($remContractCSelect,  $remContractAnnotatedCSelect,  $promNoteCSelect, $disclosureStateCSelect,  
         $mriFormCSelect,  $amortScheduleCSelect);
         
         
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

         ?>


      <div class="linkContainer py-5" style="min-width: 100%; min-height:100%; font-size:120%;">
         <div class="col-12" style="text-align:left; margin-left:1%; font-size:140%;"> 
            <label class="text-dark"><h3><b><?php echo "$fullname &nbsp; $birth &nbsp; $loanType &nbsp; $type &nbsp; $remType"; ?></b></h3></label>
         </div>
         <div class="col-12" style="text-align:left; margin-left:0.5%;">
            <!-- The PERCENTAGE CIRCLE -->
            <!-- <label class="text-white bg-success"><b>LOAN PROGRESS :</b></label> -->
            <div class="progress" style="display: inline-block; min-width: 99%; vertical-align:bottom; height: 100%; font-size:130%">
               <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: <?php echo $percentage.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage.'%';?></div>
            </div>
         </div>
         <div id="myModal" class="modal" style="margin-top:5%; margin-left:20%; width:50%; height:500px;">
         <div class="modal-content" style="height:50%;">
            <span class="close" id="closeModal" style= "font-size:2em; margin-left:95%"><i class="fa fa-times" aria-hidden="true"></i></span>
            <p><b><h1 id="modalText" style ="font-size: 1.5em;"></h1></b></p>
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
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab3" href="#corporation"><b>Real Estate Mortgage - Corporation</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual"><b>Real Estate Mortgage - Individual</b></a>
                     </li>
                  </ul>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="corporation" class="tab-pane active" style="border: 1px solid #ccc;">
                              <form id="corporation-form" action="loanCorporationUploadData.php" method="POST" enctype="multipart/form-data">
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
                                                <div class="py-3"><label style="font-size:120%"><b><u>PRINCIPAL BORROWER</u></b></label></div>
                                             </div>
                                          </div>
                                         <!-- ENDORSEMENT/RECOMMENDATION LETTER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b> ENDORSEMENT LETTER</b></label>
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
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b> LOAN APPLICATION FORM</b></label>
                                                   <input type="file" id="loanAppFormC" name="loanAppFormC"><img id="loanAppFormCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $loanAppFormC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormCButton">Open File</button></a>
                                                   <label class="date-label" id="loanAppFormCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormC, strrpos($loanAppFormC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="loanAppFormCSelect" name= "loanAppFormCSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                      <option selected  value="NULL"><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b> COMPANY PROFILE</b></label>
                                                   <input type="file" id="companyProfile" name="companyProfile"><img id="companyProfileImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $companyProfile; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="companyProfileButton">Open File</button></a>
                                                   <label class="date-label" id="companyProfileDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($companyProfile, strrpos($companyProfile, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="companyProfileSelect" name="companyProfileSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="companyProfileDesc" name="companyProfileDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>PHOTOCOPY OF ANY 2 GOVERNMENT ISSUED ID OF REPRESENTATIVE OF LOAN WITH 3 SIGNATURES</b></label>
                                                   <input type="file" id="governmentId" name="governmentId"><img id="governmentIdImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $governmentId; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="governmentIdButton">Open File</button></a>
                                                   <label class="date-label" id="governmentIdDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($governmentId, strrpos($governmentId, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="governmentIdSelect" name="governmentIdSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="governmentIdDesc" name="governmentIdDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS </b></label>
                                                   <input type="file" id="secRegistration" name="secRegistration"><img id="secRegistrationImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $secRegistration; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="secRegistrationButton">Open File</button></a>
                                                   <label class="date-label" id="secRegistrationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($secRegistration, strrpos($secRegistration, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3" >
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="secRegistrationSelect" name="secRegistrationSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="secRegistrationDesc" name="secRegistrationDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GSIS) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GIS)</b></label>
                                                   <input type="file" id="latestGIS" name="latestGIS"><img id="latestGISImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $latestGIS; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestGISButton">Open File</button></a>
                                                   <label class="date-label" id="latestGISDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestGIS, strrpos($latestGIS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="latestGISSelect" name="latestGISSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="latestGISDesc" name="latestGISDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE </b></label>
                                                   <input type="file" id="copyBRS" name="copyBRS"><img id="copyBRSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyBRS; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyBRSButton">Open File</button></a>
                                                   <label class="date-label" id="copyBRSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyBRS, strrpos($copyBRS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyBRSSelect" name="copyBRSSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyBRSDesc" name="copyBRSDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>PHOTOCOPY OF 2 GOVERNMENT ID'S OF CORPORATE SECRETARY WITH 3 SIGNATURES</b></label>
                                                   <input type="file" id="copyidCST" name="copyidCST"><img id="copyidCSTImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyidCST; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyidCSTButton">Open File</button></a>
                                                   <label class="date-label" id="copyidCSTDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyidCST, strrpos($copyidCST, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyidCSTSelect" name="copyidCSTSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyidCSTDesc" name="copyidCSTDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><b><u>COLLATERAL DOCUMENTS</u> </b></label></div>
                                             </div>
                                          </div>
                                          <!-- TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY) </b></label>
                                                   <input type="file" id="transferCertTitle" name="transferCertTitle"><img id="transferCertTitleImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $transferCertTitle; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="transferCertTitleButton">Open File</button></a>
                                                   <label class="date-label" id="transferCertTitleDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($transferCertTitle, strrpos($transferCertTitle, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="transferCertTitleSelect" name="transferCertTitleSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="transferCertTitleDesc" name="transferCertTitleDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- TAX DECLARTION (LOT-CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>TAX DECLARTION (LOT-CERTIFIED TRUE COPY) </b></label>
                                                   <input type="file" id="taxDeclaration" name="taxDeclaration"><img id="taxDeclarationImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $taxDeclaration; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclarationButton">Open File</button></a>
                                                   <label class="date-label" id="taxDeclarationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclaration, strrpos($taxDeclaration, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclarationSelect" name="taxDeclarationSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclarationDesc" name="taxDeclarationDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY) </b></label>
                                                   <input type="file" id="taxDeclartionICTC" name="taxDeclartionICTC"><img id="taxDeclartionICTCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $taxDeclartionICTC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="taxDeclartionICTCButton">Open File</button></a>
                                                   <label class="date-label" id="taxDeclartionICTCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($taxDeclartionICTC, strrpos($taxDeclartionICTC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="taxDeclartionICTCSelect" name="taxDeclartionICTCSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="taxDeclartionICTCDesc" name="taxDeclartionICTCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!--REAL ESTATE RECEIPT (AMILYAR) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>REAL ESTATE RECEIPT (AMILYAR) </b></label>
                                                   <input type="file" id="realStateReceipt" name="realStateReceipt"><img id="realStateReceiptImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $realStateReceipt; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realStateReceiptButton">Open File</button></a>
                                                   <label class="date-label" id="realStateReceiptDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realStateReceipt, strrpos($realStateReceipt, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="realStateReceiptSelect" name="realStateReceiptSelect" >
                                                      <option selected value="NULL"><b>Options</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS" id="realStateReceiptDesc" name="realStateReceiptDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- REAL ESTATE TAX CLEARANCE-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>REAL ESTATE TAX CLEARANCE </b></label>
                                                   <input type="file" id="realEstateTaxClearance" name="realEstateTaxClearance"><img id="realEstateTaxClearanceImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $realEstateTaxClearance; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="realEstateTaxClearanceButton">Open File</button></a>
                                                   <label class="date-label" id="realEstateTaxClearanceDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($realEstateTaxClearance, strrpos($realEstateTaxClearance, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="realEstateTaxClearanceSelect" name="realEstateTaxClearanceSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="realEstateTaxClearanceDesc" name="realEstateTaxClearanceDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE) -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE) </b></label>
                                                   <input type="file" id="cdOfMorgage" name="cdOfMorgage"><img id="cdOfMorgageImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $cdOfMorgage; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="cdOfMorgageButton">Open File</button></a>
                                                   <label class="date-label" id="cdOfMorgageDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cdOfMorgage, strrpos($cdOfMorgage, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="cdOfMorgageSelect" name="cdOfMorgageSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="cdOfMorgageDesc" name="cdOfMorgageDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><b><u>BUSINESS PROOF OF INCOME</u> </b></label></div>
                                             </div>
                                          </div>
                                           <!-- UPDATED BUSINESS PERMIT PERMIT (MAYOR'S, BARANGAY AND/OR DTI)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>UPDATED BUSINESS PERMIT (MAYOR'S, BARANGAY AND/OR DTI)</b></label>
                                                   <input type="file" id="copyUpdatedBP" name="copyUpdatedBP"><img id="copyUpdatedBPImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $copyUpdatedBP; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="copyUpdatedBPButton">Open File</button></a>
                                                   <label class="date-label" id="copyUpdatedBPDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($copyUpdatedBP, strrpos($copyUpdatedBP, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="copyUpdatedBPSelect" name="copyUpdatedBPSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="copyUpdatedBPDesc" name="copyUpdatedBPDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT </b></label>
                                                   <input type="file" id="auditedFinancial" name="auditedFinancial"><img id="auditedFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $auditedFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="auditedFinancialButton">Open File</button></a>
                                                   <label class="date-label" id="auditedFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($auditedFinancial, strrpos($auditedFinancial, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="auditedFinancialSelect" name="auditedFinancialSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="auditedFinancialDesc" name="auditedFinancialDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b> PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT </b></label>
                                                   <input type="file" id="inhouseFinancial" name="inhouseFinancial"><img id="inhouseFinancialImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $inhouseFinancial; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="inhouseFinancialButton">Open File</button></a>
                                                   <label class="date-label" id="inhouseFinancialDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($inhouseFinancial, strrpos($inhouseFinancial, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="inhouseFinancialSelect" name="inhouseFinancialSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="inhouseFinancialDesc" name="inhouseFinancialDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PHOTOCOPY OF AT LEAST 6 MONTHS LATEST BANK STATEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b> PHOTOCOPY OF AT LEAST 6 MONTHS OF BUSINESS LATEST BANK STATEMENT </b></label>
                                                   <input type="file" id="latestBank" name="latestBank"><img id="latestBankImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $latestBank; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestBankButton">Open File</button></a>
                                                   <label class="date-label" id="latestBankDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestBank, strrpos($latestBank, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="latestBankSelect" name="latestBankSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="latestBankDesc" name="latestBankDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--INCOME TAX RETURN (IF APPLICABLE)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>INCOME TAX RETURN (IF APPLICABLE)</b></label>
                                                   <input type="file" id="incomeTaxReturn" name="incomeTaxReturn"><img id="incomeTaxReturnImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $incomeTaxReturn; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="incomeTaxReturnButton">Open File</button></a>
                                                   <label class="date-label" id="incomeTaxReturnDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($incomeTaxReturn, strrpos($incomeTaxReturn, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="incomeTaxReturnSelect" name="incomeTaxReturnSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="incomeTaxReturnDesc" name="incomeTaxReturnDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!--CONTRACT OF LEASE (IF RENTAL BUSINESS)-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>CONTRACT OF LEASE</b></label>
                                                   <input type="file" id="contractLease" name="contractLease"><img id="contractLeaseImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $contractLease; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractLeaseButton">Open File</button></a>
                                                   <label class="date-label" id="contractLeaseDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractLease, strrpos($contractLease, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="contractLeaseSelect" name="contractLeaseSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="contractLeaseDesc" name="contractLeaseDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- 5 CUSTOMERS WITH CONTACT NUMBER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>5 CUSTOMERS WITH CONTACT NUMBER </b></label>
                                                   <input type="file" id="customerContact" name="customerContact"><img id="customerContactImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $customerContact; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="customerContactButton">Open File</button></a>
                                                   <label class="date-label" id="customerContactDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($customerContact, strrpos($customerContact, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="customerContactSelect" name="customerContactSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="customerContactDesc" name="customerContactDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- 5 SUPPLIERS WITH CONTACT NUMBER -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b> 5 SUPPLIERS WITH CONTACT NUMBER </b></label>
                                                   <input type="file" id="supplierContact" name="supplierContact"><img id="supplierContactImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $supplierContact; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="supplierContactButton">Open File</button></a>
                                                   <label class="date-label" id="supplierContactDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($supplierContact, strrpos($supplierContact, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="supplierContactSelect" name="supplierContactSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="supplierContactDesc" name="supplierContactDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- PROOF OF BILLING (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>PROOF OF BILLING (IF APPLICABLE) </b></label>
                                                   <input type="file" id="proofBilling" name="proofBilling"><img id="proofBillingImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $proofBilling; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofBillingButton">Open File</button></a>
                                                   <label class="date-label" id="proofBillingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proofBilling, strrpos($proofBilling, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="proofBillingSelect" name="proofBillingSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                <div class="py-1"><label style="font-size:120%"><b><u>DOCUMENT REPORTS AND CASHFLOW ANALYSIS</u></b></label></div>
                                             </div>
                                          </div>
                                          <!-- APPRAISAL FEE RECEIPT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label"><b>APPRAISAL FEE RECEIPT</b></label>
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
                                          <!-- CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label"><b>CREDIT INVESTIGATION AND CREDIT INVESTIGATION REPORT</b></label>
                                                   <input type="file" id="creditInvestigationReportC" name="creditInvestigationReportC"><img id="creditInvestigationReportCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $creditInvestigationReportC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportCButton">Open File</button></a>
                                                   <label class="date-label" id="creditInvestigationReportCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportC, strrpos($creditInvestigationReportC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4 ">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="creditInvestigationReportCSelect" name="creditInvestigationReportCSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="creditInvestigationReportCDesc" name="creditInvestigationReportCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label"><b>APPRAISE THE PROPERTY AND COLLATERAL APPRAISAL REPORT</b></label>
                                                   <input type="file" id="collateralAppraisalReportC" name="collateralAppraisalReportC"><img id="collateralAppraisalReportCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $collateralAppraisalReportC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="collateralAppraisalReportCButton">Open File</button></a>
                                                   <label class="date-label" id="collateralAppraisalReportCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($collateralAppraisalReportC, strrpos($collateralAppraisalReportC, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4 ">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="collateralAppraisalReportCSelect" name="collateralAppraisalReportCSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="collateralAppraisalReportCDesc" name="collateralAppraisalReportCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREBOARD  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <label class="corporation-label"><b>FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCOREBOARD</b></label>
                                                   <input type="file" id="financialEvaluationC" name="financialEvaluationC"><img id="financialEvaluationCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $financialEvaluationC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="financialEvaluationCButton">Open File</button></a>
                                                   <label class="date-label" id="financialEvaluationCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($financialEvaluationC, strrpos($financialEvaluationC, '/') + 1, 10); ?></label> 
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="financialEvaluationCSelect" name="financialEvaluationCSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="financialEvaluationCDesc" name="financialEvaluationCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><b><u>SIGNING OF APPROVAL</u> </b></label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LETTER OF APPROVAL -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                <label class="corporation-label"><b>&#x2022; SIGNED LETTER OF APPROVAL </b></label>
                                                <input type="file" id="signedLetterC" name="signedLetterC"><img id="signedLetterCImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $signedLetterC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterCButton">Open File</button></a>
                                                <label class="date-label" id="signedLetterCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterC, strrpos($signedLetterC, '/') + 1, 10); ?></label>
                                             </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLetterCSelect" name="signedLetterCSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                      <label class="corporation-label"><b>&#x2022; SIGNED LETTER OF UNDERTAKING </b></label>
                                                      <input type="file" id="signedLetterUnderEndC" name="signedLetterUnderEndC"><img id="signedLetterUnderEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedLetterUnderEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLetterUnderEndCButton">Open File</button></a>
                                                      <label class="date-label" id="signedLetterUnderEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLetterUnderEndC, strrpos($signedLetterUnderEndC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-3 mt-3">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLetterUnderEndCSelect" name="signedLetterUnderEndCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLetterUnderEndCDesc" name="signedLetterUnderEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-3"><label style="font-size:120%"><b><u>SIGNING OF THE LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE</u> </b></label></div>
                                             </div>
                                          </div>
                                          <!-- SIGNED LOAN APPROVAL MEMO -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2 mb-2">
                                                   <label class="corporation-label"><b>&#x2022; SIGNED LOAN APPROVAL MEMO </b></label>
                                                   <input type="file" id="signedLoanMemoC" name="signedLoanMemoC"><img id="signedLoanMemoCImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $signedLoanMemoC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedLoanMemoCButton">Open File</button></a>
                                                   <label class="date-label" id="signedLoanMemoCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedLoanMemoC, strrpos($signedLoanMemoC, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedLoanMemoCSelect" name="signedLoanMemoCSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedLoanMemoCDesc" name="signedLoanMemoCDesc" >&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- Not End Buyer Section -->
                                          <div class="notEndBuyer" id="notEndBuyer" style="display:none;">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><b><u>SIGNING OF REM CONTRACT</u> </b></label></div>
                                                </div>
                                             </div>
                                              <!-- SIGNED REAL ESTATE MORTGAGE CONTRACT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; SIGNED REAL ESTATE MORTGAGE CONTRACT </b></label>
                                                      <input type="file" id="remContractC" name="remContractC"><img id="remContractCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractCButton">Open File</button></a>
                                                      <label class="date-label" id="remContractCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractC, strrpos($remContractC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractCSelect" name="remContractCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractCDesc" name="remContractCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><b><u>REGISTRATION IN REGISTRY OF DEEDS</u> </b></label></div>
                                                </div>
                                             </div>
                                             <!-- REM CONTRACT ANNOTATED -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; REM CONTRACT ANNOTATED</b></label>
                                                      <input type="file" id="remContractAnnotatedC" name="remContractAnnotatedC"><img id="remContractAnnotatedCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractAnnotatedC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractAnnotatedCButton">Open File</button></a>
                                                      <label class="date-label" id="remContractAnnotatedCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractAnnotatedC, strrpos($remContractAnnotatedC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-1">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractAnnotatedCSelect" name="remContractAnnotatedCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractAnnotatedCDesc" name="remContractAnnotatedCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><b><u>DOCUMENTS AFTER THE RELEASE OF THE LOAN</u> </b></label></div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; PROMISSORY NOTE </b></label>
                                                      <input type="file" id="promNoteC" name="promNoteC"><img id="promNoteCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteCButton">Open File</button></a>
                                                      <label class="date-label" id="promNoteCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteC, strrpos($promNoteC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="promNoteCSelect" name="promNoteCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteCDesc" name="promNoteCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; DISCLOSURE STATEMENT </b></label>
                                                      <input type="file" id="disclosureStateC" name="disclosureStateC"><img id="disclosureStateCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateCButton">Open File</button></a>
                                                      <label class="date-label" id="disclosureStateCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateC, strrpos($disclosureStateC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="disclosureStateCSelect" name="disclosureStateCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateCDesc" name="disclosureStateCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                              <!-- MRI FORM (COUNTRY BANKERS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; MRI FORM (COUNTRY BANKERS) </b></label>
                                                      <input type="file" id="mriFormC" name="mriFormC"><img id="mriFormCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormCButton">Open File</button></a>
                                                      <label class="date-label" id="mriFormCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormC, strrpos($mriFormC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="mriFormCSelect" name="mriFormCSelect" >
                                                         <option selected value="NULL"><b>Options</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS" id="mriFormCDesc" name="mriFormCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; AMORTIZATION SCHEDULE </b></label>
                                                      <input type="file" id="amortScheduleC" name="amortScheduleC"><img id="amortScheduleCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleCButton">Open File</button></a>
                                                      <label class="date-label" id="amortScheduleCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleC, strrpos($amortScheduleC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-2">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id="amortScheduleCSelect" name="amortScheduleCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field" placeholder="REMARKS" id="amortScheduleCDesc" name="amortScheduleCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="endBuyer" id="endBuyer" style="display:none;">
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3"><label style="font-size:120%"><b><u>SIGNING OF REM CONTRACT AND DOCUMENTS FOR LOAN RELEASES</u> </b></label></div>
                                                </div>
                                             </div>
                                              <!-- REAL ESTATE MORTGAGE CONTRACT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; REAL ESTATE MORTGAGE CONTRACT </b></label>
                                                      <input type="file" id="remContractEndC" name="remContractEndC"><img id="remContractEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $remContractEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="remContractEndCButton">Open File</button></a>
                                                      <label class="date-label" id="remContractEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($remContractEndC, strrpos($remContractEndC, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="remContractEndCSelect" name="remContractEndCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="remContractEndCDesc" name="remContractEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- PROMISSORY NOTE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; PROMISSORY NOTE </b></label>
                                                      <input type="file" id="promNoteEndC" name="promNoteEndC"><img id="promNoteEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $promNoteEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promNoteEndCButton">Open File</button></a>
                                                      <label class="date-label" id="promNoteEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promNoteEndC, strrpos($promNoteEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="promNoteEndCSelect" name="promNoteEndCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="promNoteEndCDesc" name="promNoteEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- DISCLOSURE STATEMENT -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; DISCLOSURE STATEMENT</b></label>
                                                      <input type="file" id="disclosureStateEndC" name="disclosureStateEndC"><img id="disclosureStateEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $disclosureStateEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateEndCButton">Open File</button></a>
                                                      <label class="date-label" id="disclosureStateEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateEndC, strrpos($disclosureStateEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="disclosureStateEndCSelect" name="disclosureStateEndCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="disclosureStateEndCDesc" name="disclosureStateEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- MRI FORM (COUNTRY BANKERS) -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; MRI FORM (COUNTRY BANKERS) </b></label>
                                                      <input type="file" id="mriFormEndC" name="mriFormEndC"><img id="mriFormEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $mriFormEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mriFormEndCButton">Open File</button></a>
                                                      <label class="date-label" id="mriFormEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriFormEndC, strrpos($mriFormEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex mb-4">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="mriFormEndCSelect" name="mriFormEndCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="mriFormEndCDesc" name="mriFormEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- AMORTIZATION SCHEDULE -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-2">
                                                      <label class="corporation-label"><b>&#x2022; AMORTIZATION SCHEDULE </b></label>
                                                      <input type="file" id="amortScheduleEndC" name="amortScheduleEndC"><img id="amortScheduleEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $amortScheduleEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleEndCButton">Open File</button></a>
                                                      <label class="date-label" id="amortScheduleEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleEndC, strrpos($amortScheduleEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="amortScheduleEndCSelect" name="amortScheduleEndCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="amortScheduleEndCDesc" name="amortScheduleEndCDesc" >&nbsp;
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- End buyer Section -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div class="py-3">&nbsp;<label style="font-size:120%"><b><u>SIGNING OF DOCUMENTS TO SUNTRUST PROPERTIES INC. EXCHANGING TO DEED OF UNDERTAKING</u> </b></label></div>
                                                </div>
                                             </div>
                                              <!-- SIGNED DEED OF UNDERTAKING -->
                                             <div class="row">
                                                <div class="col-8">
                                                   <div>
                                                      <label class="corporation-label"><b>&#x2022; SIGNED DEED OF UNDERTAKING </b></label>
                                                      <input type="file" id="signedDeedUnderEndC" name="signedDeedUnderEndC"><img id="signedDeedUnderEndCImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $signedDeedUnderEndC; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="signedDeedUnderEndCButton">Open File</button></a>
                                                      <label class="date-label" id="signedDeedUnderEndCDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($signedDeedUnderEndC, strrpos($signedDeedUnderEndC, '/') + 1, 10); ?></label> 
                                                   </div>
                                                </div>
                                                <div class="col-4">
                                                   <div class="form-group d-flex">
                                                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="signedDeedUnderEndCSelect" name="signedDeedUnderEndCSelect" >
                                                         <option selected value="NULL"><b>Option</option>
                                                         <option value="1">VERIFIED</option>
                                                         <option value="2"><b>INCOMPLETE</b></option>
                                                         <option value="3"><b>N/A</b></option>
                                                      </select>
                                                      &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="signedDeedUnderEndCDesc" name="signedDeedUnderEndCDesc" >&nbsp;
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
                                                      <label class ="corporation-label"><b>&#x2022; POWERPOINT CI AND <br> &nbsp; APPRAISAL REPORT</b></label>
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
                                                      <label class ="corporation-label"><b>&#x2022; EXCEL CASHFLOW ANALYSIS  </b></label>
                                                      <input type="file" id="excel" name="excel"><img id="excelImage" src="statusImage/check.png" alt="statusImage">
                                                      <a href="<?php echo $excel; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="excelButton">Open File</button></a>
                                                      <label class="date-label" id="excelDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($excel, strrpos($excel, '/') + 1, 10); ?></label>
                                                   </div>
                                                </div>
                                             </div>
                                          <div class="row">
                                             <div class="col-8">
                                                 <div style="border-top: 1px solid #676464; width:104%; margin-left: -1.2em">
                                                <div class="py-1"><label style="font-size:120%"><b><u>OTHERS</u></b></label></div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="OTHERS">
                                          <!-- SPECIAL POWER OF ATTORNEY (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-2">
                                                   <input class="form-check-input" type="checkbox" value="Check" id="powerAttorneyCheck" name="powerAttorneyCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>SPECIAL POWER OF ATTORNEY </b></label>
                                                   <input type="file" id="powerAttorney" name="powerAttorney"><img id="powerAttorneyImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $powerAttorney; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="powerAttorneyButton">Open File</button></a>
                                                   <label class="date-label" id="powerAttorneyDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($powerAttorney, strrpos($powerAttorney, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="powerAttorneySelect" name="powerAttorneySelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>CONTRACT TO SELL </b></label>
                                                   <input type="file" id="contractSell" name="contractSell"><img id="contractSellImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $contractSell; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="contractSellButton">Open File</button></a>
                                                   <label class="date-label" id="contractSellDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($contractSell, strrpos($contractSell, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="contractSellSelect" name="contractSellSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class="corporation-label" id="tab-corporation" for="letterGuaranteeCheck"><b>LETTER OF GUARANTEE</b></label> 
                                                   <input type="file" id="letterGuarantee" name="letterGuarantee"><img id="letterGuaranteeImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $letterGuarantee; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="letterGuaranteeButton">Open File</button></a>
                                                   <label class="date-label" id="letterGuaranteeDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($letterGuarantee, strrpos($letterGuarantee, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "letterGuaranteeSelect" name = "letterGuaranteeSelect" tabindex="-1">
                                                      <option selected value= "NULL" ><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="letterGuaranteeDesc" name = "letterGuaranteeDesc" >
                                                </div>
                                             </div>
                                          </div>
                                          <!-- STATEMENT OF ACCOUNT (IF APPLICABLE)  -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div>
                                                   <input class="form-check-input" type="checkbox" value="Check" id="statementAccountCheck" name="statementAccountCheck">&nbsp;
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>STATEMENT OF ACCOUNT</b></label>
                                                   <input type="file" id="statementAccount" name="statementAccount"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $statementAccount; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountButton">Open File</button></a>
                                                   <label class="date-label" id="statementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccount, strrpos($statementAccount, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="statementAccountSelect" name="statementAccountSelect" tabindex="-1">
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>BILL/COST OF MATERIALS </b></label>
                                                   <input type="file" id="billMaterials" name="billMaterials"><img id="billMaterialsImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $billMaterials; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="billMaterialsButton">Open File</button></a>
                                                   <label class="date-label" id="billMaterialsDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($billMaterials, strrpos($billMaterials, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="billMaterialsSelect" name="billMaterialsSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class="corporation-label" id="tab-corporation" for="custom"><b>PROPOSED PERSPECTIVE PLAN </b></label>
                                                   <input type="file" id="proposedPlan" name="proposedPlan"><img id="proposedPlanImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $proposedPlan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proposedPlanButton">Open File</button></a>
                                                   <label class="date-label" id="proposedPlanDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($proposedPlan, strrpos($proposedPlan, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-4">
                                                   <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id="proposedPlanSelect" name="proposedPlanSelect" >
                                                      <option selected value="NULL"><b>Option</option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" id="proposedPlanDesc" name="proposedPlanDesc" >&nbsp;
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
   document.getElementById("endBuyerSpace").style.height="13.7em";
  } else {
   document.getElementById("notEndBuyerSpace").style.height="3.1em";

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


// Corporation Text field

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
  function uploadFileC() {
    var corpformData = new FormData(corpForm);
    corpformData.append('corpId', corpId);
    corpformData.append('fullname',fullname);
    corpformData.append('salaryType',salaryType);
    corpformData.append('branch',branch);
    corpformData.append('loanType',loanType);

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

  corpForm.addEventListener("change", function() {
    uploadFileC();
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
 }
 else{

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
  // Get the checkbox elements
  const powerAttorneyICheck = document.getElementById('powerAttorneyCheck');
  const contractSellCheck = document.getElementById('contractSellCheck');
  const letterGuaranteeCheck = document.getElementById('letterGuaranteeCheck');
  const statementAccountCheck = document.getElementById('statementAccountCheck');
  const billMaterialsCheck = document.getElementById('billMaterialsCheck');
  const proposedPlanCheck = document.getElementById('proposedPlanCheck');

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
// EMPLOYED PROOF OF INCOME
resetIndex('powerAttorney', 'powerAttorneySelect', 'powerAttorneyDesc');
resetIndex('contractSell', 'contractSellSelect', 'contractSellDesc');
resetIndex('statementAccount', 'statementAccountSelect', 'statementAccountDesc');
resetIndex('billMaterials', 'billMaterialsSelect', 'billMaterialsDesc');
resetIndex('proposedPlan', 'proposedPlanSelect', 'proposedPlanDesc');
// DOCUMENTS
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
showText('endorsementDesc','1%');
showText('loanAppFormCDesc','1%');
showText('companyProfileDesc','1%');
showText('governmentIdDesc','1%');
showText('secRegistrationDesc','1%');
showText('latestGISDesc','1%');
showText('copyBRSDesc','1%');
showText('copyidCSTDesc','1%');
// COLLATERAL DOCUMENTS
showText('transferCertTitleDesc','1%');
showText('taxDeclarationDesc','1%');
showText('taxDeclartionICTCDesc','1%');
showText('realStateReceiptDesc','1%');
showText('realEstateTaxClearanceDesc','1%');
showText('cdOfMorgageDesc','1%');
// BUSINESS PROOF OF INCOME
showText('copyUpdatedBPDesc','1%');
showText('auditedFinancialDesc','1%');
showText('inhouseFinancialDesc','1%');
showText('latestBankDesc','1%');
showText('incomeTaxReturnDesc','1%');
showText('contractLeaseDesc','1%');
showText('customerContactDesc','1%');
showText('supplierContactDesc','1%');
showText('proofBillingDesc','1%');
// OTHERS
showText('powerAttorneyDesc','1%');
showText('contractSellDesc','1%');
showText('letterGuaranteeDesc','1%');
showText('statementAccountDesc','1%');
showText('billMaterialsDesc','1%');
showText('proposedPlanDesc','1%');
showText('otherDocDesc','1%');
// DOCUMENTS
showText('receiptDesc','1%');
showText('creditInvestigationReportCDesc','1%');
showText('collateralAppraisalReportCDesc','1%');
showText('financialEvaluationCDesc','1%');
showText('signedLetterCDesc','1%');
showText('signedLetterUnderEndCDesc','1%');
showText('signedLoanMemoCDesc','1%');
showText('remContractCDesc','1%');
showText('remContractAnnotatedCDesc','1%');
showText('promNoteCDesc','1%');
showText('disclosureStateCDesc','1%');
showText('mriFormCDesc','1%');
showText('amortScheduleCDesc','1%');
showText('remContractEndCDesc','1%');
showText('promNoteEndCDesc','1%');
showText('disclosureStateEndCDesc','1%');
showText('mriFormEndCDesc','1%');
showText('amortScheduleEndCDesc','1%');
showText('signedDeedUnderEndCDesc','1%');
showText('utilizationDesc','1%');
    </script>