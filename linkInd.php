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

        .pdfContainer {
            /* zoom: 80%; */
            background-color: #333;
            width: 100%;
            /* zoom: 80%; */
            text-align: center;
            overflow: auto;
            -webkit-overflow-scrolling: touch; /* Enables smooth scrolling on iOS devices */
        }

        #pdfContainer18, #pdfContainer19,
        #pdfContainer20, #pdfContainer21 {
          /* zoom: 80%; */
            background-color: #333;
            width: 100%;
            /* zoom: 80%; */
            text-align: center;
            overflow: auto;
            -webkit-overflow-scrolling: touch; /* Enables smooth scrolling on iOS devices */
        }

        #pdfContainer031{
          background-color: #333;
          zoom: 40%;
          text-align: center;
          overflow: auto;
          -webkit-overflow-scrolling: touch; 
          /* Enables smooth scrolling on iOS devices */
        }

        #pdfContainer011, #pdfContainer017{
          background-color: #333;
          zoom: 72%;
          text-align: center;
          overflow: auto;
          -webkit-overflow-scrolling: touch; 
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

        <!--  PRESENTATION DOCUMENTS -->
        <a href="#submenu12" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b> PRESENTATION DOCUMENTS</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for LOAN UTILIZATION REPORT -->
        <div id="submenu12" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#powerPoint" href="#powerPoint" aria-expanded="true"
            aria-controls="powerPoint" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Powerpoint CI & <br>&nbsp;&nbsp;Appraisal Report</span>
            <?php 
            if(!empty($powerpoint)){
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
          <a data-toggle="collapse" data-target="#Excel" href="#Excel" aria-expanded="true"
            aria-controls="Excel" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Excel Cashflow Analysis</span>
            <?php 
            if(!empty($excel)){
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
        
        <!-- Menu of HR -->
        <a href="#submenu2" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>PRINCIPAL BORROWER</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Principal Borrower -->
        <div id="submenu2" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#endorsement" href="#endorsement" aria-expanded="true"
            aria-controls="endorsement" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Endorsement Letter</span>
            <?php 
            if(!empty($endorsement)){
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
            aria-controls="loanApplication" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Loan Application Form</span>
            <?php 
            if(!empty($loanAppFormI)){
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
          <a data-toggle="collapse" data-target="#governID" href="#governID" aria-expanded="true" 
            aria-control="governID" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Government ID</span>
            <?php 
            if(!empty($photocopyIdSignatures)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span class="submenu-collapsed" style="font-size: 9px;">&nbsp;&nbsp;(2 PHOTOCOPY)</span>
          </a>
          <a data-toggle="collapse" data-target="#secRegistration" href="#secRegistration" aria-expanded="true" 
            aria-control="secRegistration" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Proof Of Billing &nbsp; <?php 
            if(!empty($proofBilling)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?></span><br>
            <span style="font-size: 9px">(MERALCO, INTERNET BILL, WATER BILL)</span>
          </a>
          <a data-toggle="collapse" data-target="#GIS" href="#secRegistraGIStion" aria-expanded="true" 
            aria-control="GIS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Personal-Bank Statement</span>
            <?php 
            if(!empty($personalBank)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp; ( PASSBOOK FOR THE LAST 6 MONTHS )</span>
            </span><br>
          </a>
          <a data-toggle="collapse" data-target="#boardReso" href="#boardReso" aria-expanded="true" 
            aria-control="boardReso" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Marriage Contract</span>
            <span style="font-size: 9px;">(MARRIED)</span>
            <?php 
            if(!empty($marriageContract)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span class="submenu-collapsed">&nbsp;&nbsp;Cenomar</span>
            <span style="font-size: 9px;">(SINGLE)</span>
          </a>
          <a data-toggle="collapse" data-target="#corpSec" href="#corpSec" aria-expanded="true" 
            aria-control="corpSec" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Brgy. Clearance </span><?php 
            if(!empty($barangayClearance)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;( FOR LOAN PURPOSES )</span>
          </a>
        </div>

        <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- Collateral Docs Menu -->
        <a href="#submenu3" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>COLLATERAL DOCUMENTS</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Collateral Document -->
        <div id="submenu3" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#certTitle" href="#certTitle" aria-expanded="true"
            aria-controls="certTitle" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Transfer Certificate Title</span>
            <?php 
            if(!empty($transferCertificate)){
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
            aria-controls="taxDecc" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Tax Declaration</span>
            <?php 
            if(!empty($taxDeclarationLot)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span style="font-size: 9px;">&nbsp;&nbsp;( LOT-CERTIFIED )</span>
          </a>
          <a data-toggle="collapse" data-target="#taxDecc2" href="#taxDecc2" aria-expanded="true" 
            aria-control="taxDecc2" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Tax Declaration</span>
            <?php 
            if(!empty($taxDeclarationImp)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span style="font-size: 9px;">&nbsp;&nbsp;( IMPROVEMEND-CERTIFIED )</span>
          </a>
          <a data-toggle="collapse" data-target="#RER" href="#RER" aria-expanded="true" 
            aria-control="RER" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Real Estate Receipt</span>
            <?php 
            if(!empty($realEstateTaxReceipt)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span style="font-size: 9px;">(AMILYAR)</span>
          </a>
          <a data-toggle="collapse" data-target="#RETC" href="#RETC" aria-expanded="true" 
            aria-control="RETC" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Real Estate Tax Clearance</span>
            <?php 
            if(!empty($realEstateTaxClearance)){
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
          <a data-toggle="collapse" data-target="#Cancellation" href="#Cancellation" aria-expanded="true" 
            aria-control="Cancellation" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Cancellation & Discharge Of Mortgage</span>
            <span style="font-size: 9px;">&nbsp;&nbsp;( IF APPLICABLE )</span>
            <?php 
            if(!empty($cancellationDischarge)){
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
        
        <!-- Business Proof of Income Menu -->
        <a href="#submenu4" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>EMPLOYED PROOF OF INCOME</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Business Proof of Income -->
        <div id="submenu4" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#UBP" href="#UBP" aria-expanded="true"
            aria-controls="UBP" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Employment Contract</span>
            <?php 
            if(!empty($employmentContract)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(IF APPLICABLE)</span>
          </a>
          <a data-toggle="collapse" data-target="#AFS" href="#AFS" aria-expanded="true"
            aria-controls="AFS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Cert. Of Employment</span>
            <?php 
            if(!empty($certificateEmployment)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span style="font-size: 9px;">(With COMPENSATION)</span>
          </a>
          <a data-toggle="collapse" data-target="#IHFS" href="#IHFS" aria-expanded="true" 
            aria-control="IHFS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Income Tax Return</span>
            <?php 
            if(!empty($incomeTaxReturn)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span style="font-size: 9px;">(IF APPLICABLE)</span>
          </a>
          <a data-toggle="collapse" data-target="#BLBS" href="#BLBS" aria-expanded="true" 
            aria-control="BLBS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Payslip </span>
            <span style="font-size: 9px;">(FOR 6 MONTHS)</span>
            <?php 
            if(!empty($payslipMonths)){
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
          <a data-toggle="collapse" data-target="#ITR" href="#ITR" aria-expanded="true" 
            aria-control="ITR" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• OTHER SOURCE OF INCOME</span><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(IF APPLICABLE)</span>
            <?php 
            if(!empty($otherIncome)){
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

        <!-- Docs. Report & Cashflow Analysis Menu -->
        <a href="#submenu5" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>DOCUMENT REPORTS & CASHFLOW ANALYSIS</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Docs. Report & Cashflow Analysis -->
        <div id="submenu5" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#AFR" href="#AFR" aria-expanded="true"
            aria-controls="AFR" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Appraisal Fee Receipt</span>
            <?php 
            if(!empty($receipt)){
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
            <span class="submenu-collapsed">• Credit Investigation & Credit Investigation Report</span>
            <?php 
            if(!empty($creditInvestigationReportI)){
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
            <span class="submenu-collapsed" >• Appraise The Property & Collateral Appraisal Report</span>
            <?php 
            if(!empty($collateralAppraisalReportI)){
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
            <span class="submenu-collapsed">• Financial Evaluation (Cashflow Analysis) & BRR Scoreboard</span>
            <?php 
            if(!empty($financialEvaluationI)){
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

        <!-- Docs. Report & Cashflow Analysis Menu -->
        <a href="#submenu6" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>SIGNING OF APPROVAL</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Docs. Report & Cashflow Analysis -->
        <div id="submenu6" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#SLOA" href="#SLOA" aria-expanded="true"
            aria-controls="SLOA" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Letter Of Approval</span>
            <?php 
            if(!empty($signedLetterI)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?><br>
            <span style="font-size: 9px;">&nbsp;&nbsp; (SIGNED)</span>
          </a>
        </div>

         <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- SIGNING OF THE LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE -->
        <a href="#submenu7" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>SIGNING OF THE LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for SIGNING OF THE LOAN APPROVAL MEMO TO THE CREDIT COMMITTEE -->
        <div id="submenu7" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#SLAM" href="#SLAM" aria-expanded="true"
            aria-controls="SLAM" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Loan Approval Memo</span>
            <?php 
            if(!empty($signedLoanMemoI)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;(SIGNED)</span>
          </a>
        </div>

         <!-- Separator without title -->
         <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- SIGNING OF REM CONTRACT -->
        <a href="#submenu8" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>SIGNING OF REM CONTRACT</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for SIGNING OF REM CONTRACT -->
        <div id="submenu8" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#SREMC" href="#SREMC" aria-expanded="true"
            aria-controls="SREMC" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Real Estate Mortgage Contract</span><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(SIGNED)</span>
            <?php 
            if(!empty($remContractI)){
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

        <!-- REGISTRATION IN REGISTRY OF DEEDS -->
        <a href="#submenu9" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 h-100 justify-content-start align-items-center">
            <!-- <span class="fa fa-user fa-fw mr-3"></span> -->
            <span class="menu-collapsed"><b>REGISTRATION IN REGISTRY OF DEEDS</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for SIGNING OF REM CONTRACT -->
        <div id="submenu9" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#REMCA" href="#REMCA" aria-expanded="true"
            aria-controls="REMCA" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• REM Contract Annotated</span>
            <?php 
            if(!empty($remContractAnnotatedI)){
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
            if(!empty($promNoteI)){
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
            if(!empty($disclosureStateI)){
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
            aria-controls="MRIF" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• MRI Form</span>
            <?php 
            if(!empty($mriFormI)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(COUNTRY BANKERS)</span>
          </a>
          <a data-toggle="collapse" data-target="#AS" href="#AS" aria-expanded="true"
            aria-controls="AS" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Amortization Schedule</span>
            <?php 
            if(!empty($amortScheduleI)){
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
          <a data-toggle="collapse" data-target="#SPOA" href="#powerPoint" aria-expanded="true"
            aria-controls="powerPoint" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Special Power Of Attorney</span>
            <?php 
            if(!empty($powerAttorneyI)){
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
            <span class="submenu-collapsed">• General Information Sheet</span>
            <?php 
            if(!empty($generalInfo)){
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
          <a data-toggle="collapse" data-target="#byLaw" href="#byLaw" aria-expanded="true"
            aria-controls="byLaw" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• SEC With Articles & By Law</span>
            <?php 
            if(!empty($securityExchange)){
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
          <a data-toggle="collapse" data-target="#LetterG" href="#LetterG" aria-expanded="true"
            aria-controls="LetterG" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Letter Of Guarantee</span>
            <?php 
            if(!empty($letterGuarantee)){
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
          <a data-toggle="collapse" data-target="#OBR" href="#OBR" aria-expanded="true"
            aria-controls="OBR" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Original Board Resolution & Notarized Secretary Certificate</span>
            <?php 
            if(!empty($boardResolution)){
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
          <a data-toggle="collapse" data-target="#SOC" href="#SOC" aria-expanded="true"
            aria-controls="SOC" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Statement Of Account</span>
            <?php 
            if(!empty($statementAccountI)){
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
          <a data-toggle="collapse" data-target="#BCOM" href="#BCOM" aria-expanded="true"
            aria-controls="BCOM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Bill/Cost Of Materials</span>
            <?php 
            if(!empty($billMaterial)){
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
          <a data-toggle="collapse" data-target="#PPP" href="#PPP" aria-expanded="true"
            aria-controls="PPP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Proposed Perspective Plan</span>
            <?php 
            if(!empty($proposedPlan)){
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
          <a data-toggle="collapse" data-target="#otherD" href="#otherD" aria-expanded="true"
            aria-controls="otherD" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Other Documents</span>
            <?php 
            if(!empty($otherDoc)){
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
                <?php if (!empty($endorsement)) : ?>
                  <div id="pdfContainer000" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
        </div>
        <div id="loanApplication" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
          <?php if (!empty($loanAppFormI)) : ?>
                  <div id="pdfContainer001" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
      </div>
      <div id="governID" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <?php if (!empty($photocopyIdSignatures)) : ?>
                  <div id="pdfContainer002" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="secRegistration" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($proofBilling)) : ?>
                  <div id="pdfContainer003" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="GIS" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($personalBank)) : ?>
                  <div id="pdfContainer004" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="boardReso" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($marriageContract)) : ?>
                  <div id="pdfContainer005" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="corpSec" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($barangayClearance)) : ?>
                  <div id="pdfContainer006" class="pdfContainer">
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
              <?php if (!empty($transferCertificate)) : ?>
                <div id="pdfContainer007" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="taxDecc" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($taxDeclarationLot)) : ?>
                <div id="pdfContainer008" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="taxDecc2" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($taxDeclarationImp)) : ?>
                <div id="pdfContainer009" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="RER" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($realEstateTaxClearance)) : ?>
                <div id="pdfContainer010" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="RETC" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($realEstateTaxReceipt)) : ?>
                <div id="pdfContainer011" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="Cancellation" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($cancellationDischarge)) : ?>
                <div id="pdfContainer012" class="pdfContainer">
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
              <?php if (!empty($employmentContract)) : ?>
                <div id="pdfContainer013" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AFS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($certificateEmployment)) : ?>
                <div id="pdfContainer014" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="IHFS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($incomeTax)) : ?>
                <div id="pdfContainer015" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="BLBS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($payslipMonths)) : ?>
                <div id="pdfContainer016" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData016No">Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="ITR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($otherIncome)) : ?>
                <div id="pdfContainer017" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AFR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($receipt)) : ?>
                <div id="pdfContainer018" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CIR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($creditInvestigationReportI)) : ?>
                <div id="pdfContainer019" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CAR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($collateralAppraisalReportI)) : ?>
                <div id="pdfContainer020" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="FE" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($financialEvaluationI)) : ?>
                <div id="pdfContainer021" class="pdfContainer">
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
                <div id="pdfContainer022" class="pdfContainer">
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
                <div id="pdfContainer023" class="pdfContainer">
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
                <div id="pdfContainer024" class="pdfContainer">
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
                <div id="pdfContainer025" class="pdfContainer">
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
              <?php if (!empty($promNoteI)) : ?>
                <div id="pdfContainer026" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="DS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($disclosureStateI)) : ?>
                <div id="pdfContainer027" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="MRIF" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($mriFormI)) : ?>
                <div id="pdfContainer028" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($amortScheduleI)) : ?>
                <div id="pdfContainer029" class="pdfContainer">
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
                <div id="pdfContainer030" class="pdfContainer">
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
                <div id="pdfContainer031" class="pdfContainer">
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
                <div id="pdfContainer032" class="pdfContainer">
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
              <?php if (!empty($powerAttorneyI)) : ?>
                <div id="pdfContainer033" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CTS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($generalInfo)) : ?>
                <div id="pdfContainer034" class="pdfContainer">
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
                <div id="pdfContainer035" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="LetterG" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($letterGuarantee)) : ?>
                <div id="pdfContainer036" class="pdfContainer">
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
                <div id="pdfContainer037" class="pdfContainer">
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
                <div id="pdfContainer038" class="pdfContainer">
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
                <div id="pdfContainer039" class="pdfContainer">
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
                <div id="pdfContainer040" class="pdfContainer">
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
                <div id="pdfContainer041" class="pdfContainer">
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
  function loadScript(src, callback) {
    const script = document.createElement('script');
    script.src = src;
    script.onload = callback;
    document.head.appendChild(script);
  }

  function renderPdf(url, containerId) {
    pdfjsLib.getDocument(url).promise
      .then(function(pdf) {
        const pdfContainer = document.getElementById(containerId);

        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
          pdf.getPage(pageNumber).then(function(page) {
            const scale = 1.5;
            const viewport = page.getViewport({ scale });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
              canvasContext: context,
              viewport: viewport
            };

            page.render(renderContext).promise.then(function() {
              pdfContainer.appendChild(canvas);
            });
          });
        }
      })
      .catch(function(error) {
        console.error('Error loading PDF at ' + url, error);
      });
  }

  function startRendering(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const containerId = entry.target.id;
        const index = parseInt(containerId.replace('pdfContainer', ''), 10);
        const pdfUrl = pdfUrls[index];
        renderPdf(pdfUrl, containerId);
        observer.unobserve(entry.target);
      }
    });
  }

  const pdfContainers = document.querySelectorAll('.pdfContainer');
  const pdfUrls = [
    // Replace these placeholders with your actual PHP variables containing PDF URLs
    "<?php echo $endorsement; ?>",
    "<?php echo $loanAppFormI; ?>",
    "<?php echo $photocopyIdSignatures; ?>",
    '<?php echo $proofBilling; ?>',
    '<?php echo $personalBank; ?>',
    '<?php echo $marriageContract; ?>',
    '<?php echo $barangayClearance; ?>',
    '<?php echo $transferCertificate; ?>',
    '<?php echo $taxDeclarationLot; ?>',
    '<?php echo $taxDeclarationImp; ?>',
    '<?php echo $realEstateTaxClearance; ?>',
    '<?php echo $realEstateTaxReceipt; ?>',
    '<?php echo $cancellationDischarge; ?>',
    '<?php echo $employmentContract; ?>',
    '<?php echo $certificateEmployment; ?>',
    '<?php echo $incomeTax; ?>',
    '<?php echo $payslipMonths; ?>',
    '<?php echo $otherIncome; ?>',
    "<?php echo $receipt; ?>",
    '<?php echo $creditInvestigationReportI; ?>',
    '<?php echo $collateralAppraisalReportI; ?>',
    "<?php echo $financialEvaluationI; ?>",
    '<?php echo $signedLetterI; ?>',
    '<?php echo $signedLoanMemoI; ?>',
    '<?php echo $remContractI; ?>',
    '<?php echo $remContractAnnotatedI; ?>',
    '<?php echo $promNoteI; ?>',
    '<?php echo $disclosureStateI; ?>',
    '<?php echo $mriFormI; ?>',
    '<?php echo $amortScheduleI; ?>',
    '<?php echo $utilization; ?>',
    '<?php echo $powerpoint; ?>',
    '<?php echo $excel; ?>',
    '<?php echo $powerAttorneyI; ?>',
    '<?php echo $generalInfo; ?>',
    '<?php echo $securityExchange; ?>',
    '<?php echo $letterGuarantee; ?>',
    '<?php echo $statementAccountI; ?>',
    '<?php echo $billMaterial; ?>',
    '<?php echo $proposedPlan; ?>',
    '<?php echo $boardResolution; ?>',
    '<?php echo $otherDoc; ?>'
  ];

  const observer = new IntersectionObserver(startRendering, {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
  });

  pdfContainers.forEach(container => {
    observer.observe(container);
  });

  loadScript('https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js');
</script>

  
</body>
</html>
                  