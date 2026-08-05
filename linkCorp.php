<?php
include('connection.php');
include('fileuploadloan.php');

error_reporting(E_ALL & E_DEPRECATED & E_STRICT & ~E_NOTICE & ~E_WARNING);

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
        #pdfContainer11,
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
        #pdfContainer35, 
        #pdfContainer37, #pdfContainer38,
        #pdfContainer39, #pdfContainer40,
        #pdfContainer41, #pdfContainer42,
        #pdfContainer43, #pdfContainer44,
        #pdfContainer001, .pdfContainer {
            /* zoom: 80%; */
            background-color: #333;
            /* zoom: 80%; */
            width: 100%;
            text-align: center;
            overflow: auto;
            -webkit-overflow-scrolling: touch; /* Enables smooth scrolling on iOS devices */
        }

        #pdfContainer36, #pdfContainer12{
          background-color: #333;
          zoom: 40%;
          /* width: 100%; */
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
            <label class="text-dark"><h4><b><?php echo "$fullname &nbsp; $birth &nbsp; $loanType &nbsp; $type &nbsp; $remType"; ?></b></h4></label>
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
            <span><b><h1 id="modalText" style ="font-size: 1.5em;"></h1></b></span>
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
          <a data-toggle="collapse" data-target="#loanApplicationF" href="#loanApplicationF" aria-expanded="true"
            aria-controls="loanApplicationF" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Loan Application Form</span>
            <?php 
            if(!empty($loanAppFormC)){
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
          <a data-toggle="collapse" data-target="#companyProfile" href="#companyProfile" aria-expanded="true" 
            aria-control="companyProfile" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Company Profile</span>
            <?php 
            if(!empty($companyProfile)){
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
            <span class="submenu-collapsed">• Government ID of <br>&nbsp;&nbsp;Representative of Loan</span>
            <?php 
            if(!empty($governmentId)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp; ( 2 PHOTOCOPY )</span>
          </a>
          <a data-toggle="collapse" data-target="#secRegistration" href="#secRegistration" aria-expanded="true" 
            aria-control="secRegistration" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• SEC Registration</span>
            <?php 
            if(!empty($secRegistration)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( PHOTOCOPY )</span>
          </a>
          <a data-toggle="collapse" data-target="#GIS" href="#secRegistraGIStion" aria-expanded="true" 
            aria-control="GIS" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Latest General Info. Sheet</span>
            <?php 
            if(!empty($latestGIS)){
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
          <a data-toggle="collapse" data-target="#boardReso" href="#boardReso" aria-expanded="true" 
            aria-control="boardReso" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Board Resolution & <br>&nbsp;&nbsp;Secretary's Cert.</span>
            <?php 
            if(!empty($copyBRS)){
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
          <a data-toggle="collapse" data-target="#corpSec" href="#corpSec" aria-expanded="true" 
            aria-control="corpSec" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Government ID of <br>&nbsp;&nbsp;Corporate Secretary</span>
            <?php 
            if(!empty($copyidCST)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp; ( 2 PHOTOCOPY )</span>
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
            if(!empty($transferCertTitle)){
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
            <span class="submenu-collapsed">• Tax Declaration</span>
            <?php 
            if(!empty($taxDeclaration)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( LOT-CERTIFIED )</span>
          </a>
          <a data-toggle="collapse" data-target="#taxDecc2" href="#taxDecc2" aria-expanded="true" 
            aria-control="taxDecc2" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Tax Declaration</span>
            <?php 
            if(!empty($taxDeclartionICTC)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( IMPROVEMENT-CERTIFIED )</span>
          </a>
          <a data-toggle="collapse" data-target="#RER" href="#RER" aria-expanded="true" 
            aria-control="RER" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Real Estate Receipt</span>
            <?php 
            if(!empty($realStateReceipt)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( AMILYAR )</span>
          </a>
          <a data-toggle="collapse" data-target="#RETC" href="#RETC" aria-expanded="true" 
            aria-control="RETC" class="list-group-item list-group-item-action h-100 bg-dark text-white">
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
            <span class="submenu-collapsed">• Cancellation & Discharge <br>&nbsp;&nbsp;Of Mortgage</span>
            <?php 
            if(!empty($cdOfMorgage)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( IF APPLICABLE )</span>
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
            <span class="menu-collapsed"><b>BUSINESS PROOF OF INCOME</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Business Proof of Income -->
        <div id="submenu4" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#UBP" href="#UBP" aria-expanded="true"
            aria-controls="UBP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Updated Business Permit</span>
            <?php 
            if(!empty($copyUpdatedBP)){
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
            <span class="submenu-collapsed">• Latest 3 Years Audited <br>&nbsp;&nbsp; Financial Statement</span>
            <?php 
            if(!empty($auditedFinancial)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( PHOTOCOPY )</span>
          </a>
          <a data-toggle="collapse" data-target="#IHFS" href="#IHFS" aria-expanded="true" 
            aria-control="IHFS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Latest 3 Years In-House <br>&nbsp;&nbsp; Financial Statement</span>
            <?php 
            if(!empty($inhouseFinancial)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( PHOTOCOPY )</span>
          </a>
          <a data-toggle="collapse" data-target="#BLBS" href="#BLBS" aria-expanded="true" 
            aria-control="BLBS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Business Latest Bank <br>&nbsp;&nbsp;Statement</span>
            <?php 
            if(!empty($latestBank)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;(PHOTOCOPY OF ATLEAST 6 MONTHS)</span>
          </a>
          <a data-toggle="collapse" data-target="#ITR" href="#ITR" aria-expanded="true" 
            aria-control="ITR" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Income Tax Return</span>
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
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( IF APPLICABLE )</span>
          </a>
          <a data-toggle="collapse" data-target="#COL" href="#COL" aria-expanded="true" 
            aria-control="COL" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Contract Of Lease</span>
            <?php 
            if(!empty($contractLease)){
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
          <a data-toggle="collapse" data-target="#CWCN" href="#CWCN" aria-expanded="true" 
            aria-control="CWCN" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• 5 Customers With <br>&nbsp;&nbsp;Contact Number</span>
            <?php 
            if(!empty($customerContact)){
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
          <a data-toggle="collapse" data-target="#SWCN" href="#SWCN" aria-expanded="true" 
            aria-control="SWCN" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• 5 Suppliers With <br>&nbsp;&nbsp;Contact Number</span>
            <?php 
            if(!empty($supplierContact)){
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
          <a data-toggle="collapse" data-target="#POB" href="#POB" aria-expanded="true" 
            aria-control="POB" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Proof Of Billing</span>
            <?php 
            if(!empty($proofBilling)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">( IF APPLICABLE )</span>
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
            <span class="submenu-collapsed">• Credit Investigation & <br>&nbsp;&nbsp;Credit Investigation Report</span>
            <?php 
            if(!empty($creditInvestigationReportC)){
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
            <span class="submenu-collapsed" >• Appraise The Property & <br>&nbsp;&nbsp;Collateral Appraisal Report</span>
            <?php 
            if(!empty($collateralAppraisalReportC)){
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
            if(!empty($financialEvaluationC)){
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
            if(!empty($signedLetterC)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( SIGNED )</span>
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
            if(!empty($signedLoanMemoC)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( SIGNED )</span>
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
            <span class="submenu-collapsed">• Real Estate Mortgage Contract</span>
            <?php 
            if(!empty($remContractC)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( SIGNED )</span>
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
            if(!empty($remContractAnnotatedC)){
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
            if(!empty($promNoteC)){
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
            if(!empty($disclosureStateC)){
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
            <span class="submenu-collapsed">• MRI Form</span>
            <?php 
            if(!empty($mriFormC)){
              ?>
              <img src="./statusImage/check.png" id="statusImg" alt="">
              <?php
            }else{
              ?>
              <img src="./statusImage/xmark.png" id="statusImg" alt="">
              <?php
            }
            ?>
            <br><span style="font-size: 9px;">&nbsp;&nbsp;( COUNTRY BANKERS )</span>
          </a>
          <a data-toggle="collapse" data-target="#AS" href="#AS" aria-expanded="true"
            aria-controls="AS" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Amortization Schedule</span>
            <?php 
            if(!empty($amortScheduleC)){
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
            if(!empty($powerAttorney)){
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
            aria-controls="CTS" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Contract To Sell</span>
            <?php 
            if(!empty($contractSell)){
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
          <a data-toggle="collapse" data-target="#LOG" href="#LOG" aria-expanded="true"
            aria-controls="LOG" class="list-group-item list-group-item-action bg-dark text-white">
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
          <a data-toggle="collapse" data-target="#SOC" href="#SOC" aria-expanded="true"
            aria-controls="SOC" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Statement Of Account</span>
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
            ?>
          </a>
          <a data-toggle="collapse" data-target="#BCOM" href="#BCOM" aria-expanded="true"
            aria-controls="BCOM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Bill/Cost Of Materials</span>
            <?php 
            if(!empty($billMaterials)){
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
                  <div id="pdfContainer1" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
        </div>
        <div id="loanApplicationF" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
          <?php if (!empty($loanAppFormC)) : ?>
                  <div id="pdfContainer001" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
      </div>
        <div id="companyProfile" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <?php if (!empty($companyProfile)) : ?>
                  <div id="pdfContainer2" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="governID" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <?php if (!empty($governmentId)) : ?>
                  <div id="pdfContainer3" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="secRegistration" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($secRegistration)) : ?>
                  <div id="pdfContainer4" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="GIS" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($latestGIS)) : ?>
                  <div id="pdfContainer5" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="boardReso" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($copyBRS)) : ?>
                  <div id="pdfContainer6" class="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="corpSec" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($copyidCST)) : ?>
                  <div id="pdfContainer7" class="pdfContainer">
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
              <?php if (!empty($transferCertTitle)) : ?>
                <div id="pdfContainer8" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="taxDecc" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($taxDeclaration)) : ?>
                <div id="pdfContainer9" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="taxDecc2" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($taxDeclartionICTC)) : ?>
                <div id="pdfContainer10" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="RER" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($realStateReceipt)) : ?>
                <div id="pdfContainer11" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="RETC" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($realEstateTaxClearance)) : ?>
                <div id="pdfContainer12" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="Cancellation" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($cdOfMorgage)) : ?>
                <div id="pdfContainer13" class="pdfContainer">
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
              <?php if (!empty($copyUpdatedBP)) : ?>
                <div id="pdfContainer14" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AFS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($auditedFinancial)) : ?>
                <div id="pdfContainer15" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="IHFS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($inhouseFinancial)) : ?>
                <div id="pdfContainer16" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="BLBS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($latestBank)) : ?>
                <div id="pdfContainer17" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="ITR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($incomeTaxReturn)) : ?>
                <div id="pdfContainer18" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="COL" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($contractLease)) : ?>
                <div id="pdfContainer19" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <div id="CWCN" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($customerContact)) : ?>
                <div id="pdfContainer20" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        
        <div id="SWCN" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($supplierContact)) : ?>
                <div id="pdfContainer21" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="POB" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($proofBilling)) : ?>
                <div id="pdfContainer22" class="pdfContainer">
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
                <div id="pdfContainer23" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CIR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($creditInvestigationReportC)) : ?>
                <div id="pdfContainer24" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CAR" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($collateralAppraisalReportC)) : ?>
                <div id="pdfContainer25" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="FE" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($financialEvaluationC)) : ?>
                <div id="pdfContainer26" class="pdfContainer">
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
              <?php if (!empty($signedLetterC)) : ?>
                <div id="pdfContainer27" class="pdfContainer">
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
              <?php if (!empty($signedLoanMemoC)) : ?>
                <div id="pdfContainer28" class="pdfContainer">
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
              <?php if (!empty($remContractC)) : ?>
                <div id="pdfContainer29" class="pdfContainer">
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
              <?php if (!empty($remContractAnnotatedC)) : ?>
                <div id="pdfContainer30" class="pdfContainer">
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
              <?php if (!empty($promNoteC)) : ?>
                <div id="pdfContainer31" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="DS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($disclosureStateC)) : ?>
                <div id="pdfContainer32"class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="MRIF" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($mriFormC)) : ?>
                <div id="pdfContainer33" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="AS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($amortScheduleC)) : ?>
                <div id="pdfContainer34" class="pdfContainer">
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
                <div id="pdfContainer35" class="pdfContainer">
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
                <div id="pdfContainer36" class="pdfContainer">
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
                <div id="pdfContainer37" class="pdfContainer">
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
              <?php if (!empty($powerAttorney)) : ?>
                <div id="pdfContainer38" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="CTS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($contractSell)) : ?>
                <div id="pdfContainer39" class="pdfContainer">
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
                <div id="pdfContainer40" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="SOC" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($statementAccount)) : ?>
                <div id="pdfContainer41" class="pdfContainer">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="BCOM" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($billMaterials)) : ?>
                <div id="pdfContainer42" class="pdfContainer">
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
                <div id="pdfContainer43" class="pdfContainer">
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
      .then(function (pdf) {
        const pdfContainer = document.getElementById(containerId);

        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
          pdf.getPage(pageNumber).then(function (page) {
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

            page.render(renderContext).promise.then(function () {
              pdfContainer.appendChild(canvas);
            });
          });
        }
      })
      .catch(function (error) {
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
      '<?php echo $endorsement; ?>',
      '<?php echo $loanAppFormC; ?>',
      '<?php echo $companyProfile; ?>',
      '<?php echo $governmentId; ?>',
      '<?php echo $secRegistration; ?>',
      '<?php echo $latestGIS; ?>',
      '<?php echo $copyBRS; ?>',
      '<?php echo $copyidCST; ?>',
      '<?php echo $transferCertTitle; ?>',
      '<?php echo $taxDeclaration; ?>',
      '<?php echo $taxDeclartionICTC; ?>',
      '<?php echo $realStateReceipt; ?>',
      '<?php echo $realEstateTaxClearance; ?>',
      '<?php echo $cdOfMorgage; ?>',
      '<?php echo $copyUpdatedBP; ?>',
      '<?php echo $auditedFinancial; ?>',
      '<?php echo $inhouseFinancial; ?>',
      '<?php echo $latestBank; ?>',
      '<?php echo $incomeTaxReturn; ?>',
      '<?php echo $contractLease; ?>',
      '<?php echo $customerContact; ?>',
      '<?php echo $supplierContact; ?>',
      '<?php echo $proofBilling; ?>',
      '<?php echo $receipt; ?>',
      '<?php echo $creditInvestigationReportC; ?>',
      '<?php echo $collateralAppraisalReportC; ?>',
      '<?php echo $financialEvaluationC; ?>',
      '<?php echo $signedLetterC; ?>',
      '<?php echo $signedLoanMemoC; ?>',
      '<?php echo $remContractC; ?>',
      '<?php echo $remContractAnnotatedC; ?>',
      '<?php echo $promNoteC; ?>',
      '<?php echo $disclosureStateC; ?>',
      '<?php echo $mriFormC; ?>',
      '<?php echo $amortScheduleC; ?>',
      '<?php echo $utilization; ?>',
      '<?php echo $powerpoint; ?>',
      '<?php echo $excel; ?>',
      '<?php echo $powerAttorney; ?>',
      '<?php echo $contractSell; ?>',
      '<?php echo $letterGuarantee; ?>',
      '<?php echo $statementAccount; ?>',
      '<?php echo $billMaterials; ?>',
      "<?php echo $proposedPlan; ?>"
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