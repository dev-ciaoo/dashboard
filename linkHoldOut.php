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

        #pdfContainer,  #pdfContainer1,
        #pdfContainer2, #pdfContainer3,
        #pdfContainer4, #pdfContainer5,
        #pdfContainer6, #pdfContainer7,
        #pdfContainer8, #pdfContainer9, 
        #pdfContainer10, #pdfContainer11, 
        #pdfContainer12, #pdfContainer13, 
        #pdfContainer14, #pdfContainer15, 
        #pdfContainer16, #pdfContainer17, 
        #pdfContainer18, #pdfContainer19, 
        #pdfContainer20, #pdfContainer21, 
        #pdfContainer22 {
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
          } 
         }
         


         
         // Disable Tab Buttons
         if($type == "Hold-Out Loan") {       
         ?>

      <?php
         $query = "SELECT * FROM `holdoutloan` WHERE `holdLoanId` = '$id' ";
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
         $amortizationSched = $row['amortizationSched'];
         $insurance = $row['insurance'];
         $cashflowAnalysis = $row['cashflowAnalysis'];
         // BORROWER STATUS
         $loanAppFormSelect = $row['loanAppFormStatus'];
         $borrowerIdSelect = $row['borrowerIdStatus'];
         $businessPermitSelect = $row['businessPermitStatus'];
         $borrowerIdSelect = $row['borrowerIdStatus'];
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
         $promissoryNoteSelect = $row['promissoryNotetatus'];
         $disclosureStatementSelect = $row['disclosureStatementStatus'];
         $amortizationSchedSelect = $row['amortizationSchedStatus'];
         $insuranceSelect = $row['insuranceStatus'];
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
         }
                  
         // The NUMBER OF PERCENTAGE
         $numberOfFilesUploaded = 0;
         
         $fileInputs = array(         
         $loanAppFormSelect, $borrowerIdSelect, $businessPermitSelect, $borrowerIdSelect, $brgyClearanceSelect, $proofBillingSelect,
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
        });
         
         // Count the number of non-empty values
         $numberOfFilesUploaded = count($nonEmptyFileInputs);
         // echo $numberOfFilesUploaded;
         
         // Calculate the percentage
         $percentage = round($numberOfFilesUploaded / $maxCount * 100); 
         
         // echo count($numberOfFilesUploaded);
         $percentage= round($numberOfFilesUploaded /$maxCount *100);

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

         <div id="myModal" class="modal" style="margin-top:1%; margin-left:20%; width:50%; height:500px;">
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
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab3" href="#salary"><b>Hold-Out</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#corporation"><b>Real Estate Mortgage - Corporation</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab5" href="#individual"><b>Real Estate Mortgage - Individual</b></a>
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
              <span class="submenu-collapsed">• Loan Endorsement</span>
              <?php
              if(!empty($loanAppForm)){
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
          <a data-toggle="collapse" data-target="#loanAppForm" href="#loanAppForm" aria-expanded="true"
            aria-controls="loanAppForm" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Loan Application Form</span>
            <?php
            if(!empty($loanAppForm)){
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
          <a data-toggle="collapse" data-target="#bankDeposit" href="#bankDeposit" aria-expanded="true" 
            aria-control="bankDeposit" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Deed Of Assignment<br>&nbsp;&nbsp;Of Bank Deposit</span>
            <?php
            if(!empty($bankDeposit)){
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
          <a data-toggle="collapse" data-target="#borrowerId" href="#borrowerId" aria-expanded="true" 
            aria-control="borrowerId" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Photocopy Of (2) <br>&nbsp;&nbsp;Valid ID Of Borrower</span>
            <?php
            if(!empty($borrowerId)){
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
          <a data-toggle="collapse" data-target="#payslip" href="#payslip" aria-expanded="true" 
            aria-control="payslip" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• If Employed, (6) Months<br>&nbsp;&nbsp;Payslip</span>
            <?php
            if(!empty($payslip)){
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
          <a data-toggle="collapse" data-target="#businessPermit" href="#businessPermit" aria-expanded="true" 
            aria-control="businessPermit" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• If Business,<br>&nbsp;&nbsp;Latest Business Permit</span>
            <?php
            if(!empty($businessPermit)){
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
          <a data-toggle="collapse" data-target="#brgyClearance" href="#brgyClearance" aria-expanded="true" 
            aria-control="brgyClearance" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Brgy. Clearance For <br>&nbsp;&nbsp; Bank Requirements</span>
            <?php
            if(!empty($brgyClearance)){
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
          <a data-toggle="collapse" data-target="#proofBilling" href="#proofBilling" aria-expanded="true" 
            aria-control="proofBilling" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Proof Of Latest Billing</span>
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
            <span class="menu-collapsed"><b>CO-BORROWER</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Collateral Document -->
        <div id="submenu3" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#coBorrowerStatement" href="#coBorrowerStatement" aria-expanded="true"
            aria-controls="coBorrowerStatement" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="submenu-collapsed">• Co-Borrower Statement</span>
            <?php
            if(!empty($coBorrowerStatement)){
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
            aria-controls="coBorrowerId" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Photocopy Of (2) Valid<br>&nbsp;&nbsp;ID of Borrower</span>
            <!-- <span style="font-size: 9px;">&nbsp;&nbsp;(1 COPY)</span> -->
            <?php
            if(!empty($coBorrowerId)){
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
          <a data-toggle="collapse" data-target="#taxDecc2" href="#taxDecc2" aria-expanded="true" 
            aria-control="coBorrowerProofIncome" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Proof Of Income<br>&nbsp;&nbsp;(<i>If Applicable</i>)</span>
            <?php
            if(!empty($coBorrowerProofIncome)){
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
            <span class="menu-collapsed"><b>CO-MAKER</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for Business Proof of Income -->
        <div id="submenu4" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#coMakerStatement" href="#coMakerStatement" aria-expanded="true"
            aria-controls="coMakerStatement" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Co-Maker Statement</span>
            <?php
            if(!empty($coMakerStatement)){
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
          <a data-toggle="collapse" data-target="#coMakerId" href="#coMakerId" aria-expanded="true"
            aria-controls="coMakerId" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Photocopy Of (2)<br>&nbsp;&nbsp;Valid ID Of Borrower</span>
            <!-- <span style="font-size: 9px;">&nbsp;&nbsp;(1 COPY)</span> -->
            <?php
            if(!empty($coMakerId)){
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
          <!-- <a data-toggle="collapse" data-target="#IHFS" href="#IHFS" aria-expanded="true" 
            aria-control="IHFS" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Latest Business Permit</span><br>
            <span style="font-size: 9px;">&nbsp;&nbsp;(IF APPLICABLE)</span>
          </a> -->
          <a data-toggle="collapse" data-target="#coMakerBusinessPermit" href="#coMakerBusinessPermit" aria-expanded="true" 
            aria-control="coMakerBusinessPermit" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• If Business, Latest<br>&nbsp;&nbsp;Business Permit</span>
            <?php
            if(!empty($coMakerBusinessPermit)){
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

          <a data-toggle="collapse" data-target="#coMakerPayslip" href="#coMakerPayslip" aria-expanded="true" 
            aria-control="coMakerPayslip" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• If Employed, With (6)<br>&nbsp;&nbsp;Months Payslip</span>
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
          <a data-toggle="collapse" data-target="#promissoryNote" href="#promissoryNote" aria-expanded="true"
            aria-controls="promissoryNote" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed">• Promissory Note</span>
            <?php
            if(!empty($promissoryNote)){
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
          <a data-toggle="collapse" data-target="#disclosureStatement" href="#disclosureStatement" aria-expanded="true"
            aria-controls="disclosureStatement" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="submenu-collapsed">• Disclosure Statement</span>
            <?php
            if(!empty($disclosureStatement)){
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
        
          <a data-toggle="collapse" data-target="#amortizationSched" href="#amortizationSched" aria-expanded="true" 
            aria-control="amortizationSched" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Amortization Schedule</span>
            <?php
            if(!empty($amortizationSched)){
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

          <a data-toggle="collapse" data-target="#insurance" href="#insurance" aria-expanded="true" 
            aria-control="insurance" class="list-group-item list-group-item-action h-100 bg-dark text-white">
            <span class="submenu-collapsed" >• Insurance</span>
            <?php
            if(!empty($insurance)){
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
            <span class="menu-collapsed"><b>OTHERS</b></span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for DOCUMENTS AFTER THE RELEASE OF THE LOAN -->
        <div id="submenu10" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#bankCert" href="#bankCert" aria-expanded="true"
            aria-controls="bankCert" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="submenu-collapsed">• Bank Certification With<br>&nbsp;&nbsp;Current Balance (<i>If Applicable</i>)</span>
            <?php
            if(!empty($bankCert)){
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
          <a data-toggle="collapse" data-target="#waiverConfi" href="#waiverConfi" aria-expanded="true"
            aria-controls="waiverConfi" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="submenu-collapsed">• Waiver of Confidentiality</span>
            <?php
            if(!empty($waiverConfi)){
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
          <a data-toggle="collapse" data-target="#waiverSecrecy" href="#waiverSecrecy" aria-expanded="true"
            aria-controls="waiverSecrecy" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="submenu-collapsed">• Waiver Of Secrecy<br>&nbsp;&nbsp;Of Deposit</span>
            <?php
            if(!empty($waiverSecrecy)){
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
          <a data-toggle="collapse" data-target="#otherSupport" href="#otherSupport" aria-expanded="true"
            aria-controls="otherSupport" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="submenu-collapsed">• Other Supporting Docs</span>
            <?php
            if(!empty($otherSupport)){
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
                  <div id="pdfContainer">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
        </div>
        <div id="loanAppForm" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <?php if (!empty($loanAppForm)) : ?>
                  <div id="pdfContainer1">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
          </div>
        </div>
        <div id="bankDeposit" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <?php if (!empty($bankDeposit)) : ?>
                  <div id="pdfContainer2">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="payslip" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($payslip)) : ?>
                  <div id="pdfContainer3">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="borrowerId" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($borrowerId)) : ?>
                  <div id="pdfContainer4">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="businessPermit" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($businessPermit)) : ?>
                  <div id="pdfContainer5">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="brgyClearance" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($brgyClearance)) : ?>
                  <div id="pdfContainer6">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        <div id="proofBilling" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
                <?php if (!empty($proofBilling)) : ?>
                  <div id="pdfContainer7">
                  <!-- This is where the PDF will be displayed -->

                  </div>
                <?php else : ?>
                    <span class="noData">No Data Found.</span>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Co-Borrwer -->
        <div id="coBorrowerStatement" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coBorrowerStatement)) : ?>
                <div id="pdfContainer8">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="coBorrowerId" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coBorrowerId)) : ?>
                <div id="pdfContainer9">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="coBorrowerProofIncome" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coBorrowerProofIncome)) : ?>
                <div id="pdfContainer10">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- Proof of Business -->
        <div id="coMakerStatement" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coMakerStatement)) : ?>
                <div id="pdfContainer11">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="coMakerId" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coMakerId)) : ?>
                <div id="pdfContainer12">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="coMakerBusinessPermit" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coMakerBusinessPermit)) : ?>
                <div id="pdfContainer13">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="coMakerPayslip" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($coMakerPayslip)) : ?>
                <div id="pdfContainer14">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- For Docs -->
        <div id="promissoryNote" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($promissoryNote)) : ?>
                <div id="pdfContainer15">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="disclosureStatement" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($disclosureStatement)) : ?>
                <div id="pdfContainer16">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="amortizationSched" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($amortizationSched)) : ?>
                <div id="pdfContainer17">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="insurance" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($insurance)) : ?>
                <div id="pdfContainer18">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>

        <!-- Others -->
        <div id="bankCert" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($bankCert)) : ?>
                <div id="pdfContainer19">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="waiverConfi" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($waiverConfi)) : ?>
                <div id="pdfContainer20">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="waiverSecrecy" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($waiverSecrecy)) : ?>
                <div id="pdfContainer21">
                <!-- This is where the PDF will be displayed -->

                </div>
              <?php else : ?>
                  <span class="noData">No Data Found.</span>
              <?php endif; ?>
          </div>
        </div>
        <div id="otherSupport" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <?php if (!empty($otherSupport)) : ?>
                <div id="pdfContainer22">
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

    <!-- FOR DROP DOWN OF SIDE NAVBAR -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

  <!-- FOR ICONS -->
  <script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>
  
   <!-- CUSTOM SCRIPT FOR SIDE NAVBAR ANIMATION -->
   <script src="./js/dashboard.js"></script>
   
  <script>
        const pdfUrl =  '<?php echo $endorsement; ?>';
        const pdfUrl1 = '<?php echo $loanAppForm; ?>';
        const pdfUrl2 = '<?php echo $bankDeposit; ?>';
        const pdfUrl3 = '<?php echo $payslip; ?>';
        const pdfUrl4 = '<?php echo $borrowerId; ?>';
        const pdfUrl5 = '<?php echo $businessPermit; ?>';
        const pdfUrl6 = '<?php echo $brgyClearance; ?>';
        const pdfUrl7 = '<?php echo $proofBilling; ?>';

        const pdfUrl8 = '<?php echo $coBorrowerStatement; ?>';
        const pdfUrl9 = '<?php echo $coBorrowerId; ?>';
        const pdfUrl10 = '<?php echo $coBorrowerProofIncome; ?>'; 

        const pdfUrl11 = '<?php echo $coMakerStatement; ?>';
        const pdfUrl12 = '<?php echo $coBorrowerId; ?>';
        const pdfUrl13 = '<?php echo $coMakerBusinessPermit; ?>';
        const pdfUrl14 = '<?php echo $coMakerPayslip; ?>';

        const pdfUrl15 = '<?php echo $promissoryNote; ?>';
        const pdfUrl16 = '<?php echo $disclosureStatement; ?>';
        const pdfUrl17 = '<?php echo $amortizationSched; ?>';
        const pdfUrl18 = '<?php echo $insurance; ?>';

        const pdfUrl19 = '<?php echo $bankCert; ?>';
        const pdfUrl20 = '<?php echo $waiverConfi; ?>';
        const pdfUrl21 = '<?php echo $waiverSecrecy; ?>';
        const pdfUrl22 = '<?php echo $otherSupport; ?>';
      
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
        // Borrower
        renderPdf(pdfUrl, 'pdfContainer');
        renderPdf(pdfUrl1, 'pdfContainer1');
        renderPdf(pdfUrl3, 'pdfContainer3');
        renderPdf(pdfUrl4, 'pdfContainer4');
        renderPdf(pdfUrl5, 'pdfContainer5');
        renderPdf(pdfUrl6, 'pdfContainer6');
        renderPdf(pdfUrl7, 'pdfContainer7');
        // Co-Borrower
        renderPdf(pdfUrl8, 'pdfContainer8');
        renderPdf(pdfUrl9, 'pdfContainer9');
        renderPdf(pdfUrl10, 'pdfContainer10');
        // Co-Maker
        renderPdf(pdfUrl11, 'pdfContainer11');
        renderPdf(pdfUrl12, 'pdfContainer12');
        renderPdf(pdfUrl13, 'pdfContainer13');
        renderPdf(pdfUrl14, 'pdfContainer14');
        // Documents
        renderPdf(pdfUrl15, 'pdfContainer15');
        renderPdf(pdfUrl16, 'pdfContainer16');
        renderPdf(pdfUrl17, 'pdfContainer17');
        renderPdf(pdfUrl18, 'pdfContainer18');
        // Others
        renderPdf(pdfUrl19, 'pdfContainer19');
        renderPdf(pdfUrl20, 'pdfContainer20');
        renderPdf(pdfUrl21, 'pdfContainer21');
        renderPdf(pdfUrl22, 'pdfContainer22');
    </script>
  
</body>
</html>
                  
