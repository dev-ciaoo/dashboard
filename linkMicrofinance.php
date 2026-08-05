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
} 
}


 
if($type == "Microfinance") {
    ?>

    <?php
            
            $query1="SELECT * FROM microfinance WHERE mLoan_Id=$id ";
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

            //OTHERS
            $businessPicture = $rows['businessPicture'];
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
            $otherSuportCheck = $rows['otherSuportCheck']; 
            $renewalCheck = $rows['renewalCheck']; 

            
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
<div class="row">
   <div class="col-12 ">
      <div class="bg-white rounded p-2">
         <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver;"  >
            <li class="nav-item ">
               <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab1" href="#microfinance"><b>Microfinance</b></a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab2" href="#salary"><b>Salary</b></a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation"><b>Real Estate Mortgage - Corporation</b></a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual"><b>Real Estate Mortgage - Individual</b></a>
            </li>
         </ul>
         <div id="myModal" class="modal" style="margin-top:1%; margin-left:20%; width:50%; height:500px;">
         <div class="modal-content" style="height:50%;">
            <span class="close" id="closeModal" style= "font-size:2em; margin-left:95%"><i class="fa fa-times" aria-hidden="true"></i></span>
            <p><b><h1 id="modalText" style ="font-size: 1.5em;"></h1></b></p>
        </div>
      </div>
         <div class="row">
            <div class="col-12">
               <div class="tab-content p-6">
                  <div id="microfinance" class="tab-pane active" style="border: 1px solid #ccc;">
                     <form id="microfinance-form" action="loanMicroUploadData.php" method="POST" enctype="multipart/form-data">
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
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><b><u>BORROWER</u></b></label></div>
                                    </div>
                                 </div>
                                 <!--LOAN APPLICATION FORM  --> 
                                 <div class="row" >
                                    <div class="col-8">
                                       <div class="py-2">                                   
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>LOAN APPLICATION</b></label>
                                          <input type="file" id="loanAppFormM" name="loanAppFormM"><img id="loanAppFormMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanAppFormM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormMButton">Open File</button></a> 
                                          <label class="date-label" id="loanAppFormMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppFormM, strrpos($loanAppFormM, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="loanAppFormMSelect" name="loanAppFormMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanAppFormMDesc"  name="loanAppFormMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 2 COPIES OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>2 COPIES OF 2 VALID ID WITH 3 SIGNATURES</b></label>
                                          <input type="file" id="borrower_Idsignature" name="borrower_Idsignature"><img id="borrower_IdsignatureImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $borrower_Idsignature; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_IdsignatureButton">Open File</button></a>
                                          <label class="date-label" id="borrower_IdsignatureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Idsignature, strrpos($borrower_Idsignature, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-1">
                                          <select id="borrowerValidSelect" name="borrowerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
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
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>LATEST BUSINESS PERMIT</b></label>   
                                          <input type="file" id="borrower_Lbp" name="borrower_Lbp"><img id="borrower_LbpImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $borrower_Lbp; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_LbpButton">Open File</button></a>
                                          <label class="date-label" id="borrower_LbpDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Lbp, strrpos($borrower_Lbp, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="latestPermitSelect" name="latestPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_LbpDesc" name="borrower_LbpDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LATEST PROOF OF BILLING (MERALCO) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>LATEST PROOF OF BILLING (MERALCO)</b></label>
                                          <input type="file" id="borrower_Lpb" name="borrower_Lpb"><img id="borrower_LpbImage" src="statusImage/check.png" alt="statusImage"> 
                                          <a href="<?php echo $borrower_Lpb; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="borrower_LpbButton">Open File</button></a>
                                          <label class="date-label" id="borrower_LpbDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($borrower_Lpb, strrpos($borrower_Lpb, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-3">
                                          <select  id="latestProofSelect" name="latestProofSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="borrower_LpbDesc" name="borrower_LpbDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><b><u>CO-BORROWER</u></b></label></div>
                                    </div>
                                 </div>
                                  <!-- CO-BORROWER STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels"><b>CO-BORROWER STATEMENT </b></label>
                                          <input type="file" id="coborrowerStatement" name="coborrowerStatement"><img id="coborrowerStatementImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coborrowerStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coborrowerStatementButton">Open File</button></a> 
                                          <label class="date-label" id="coborrowerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coborrowerStatement, strrpos($coborrowerStatement, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="coborrowerStatementSelect" name="coborrowerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coborrowerStatementDesc"  name="coborrowerStatementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class="micro-labels" id="tab-label" for="custom" ><b>1 COPY OF 2 VALID ID WITH 3 SIGNATURES</b></label> 
                                          <input type="file" id="coBorrowerIdSign" name="coBorrowerIdSign"><img id="coBorrowerIdSignImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coBorrowerIdSign; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coBorrowerIdSignButton">Open File</button></a>
                                          <label class="date-label" id="coBorrowerIdSignDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($coBorrowerIdSign, strrpos($coBorrowerIdSign, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="coborrowerIdSelect" name="coborrowerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL" ><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coBorrowerIdSignDesc" name="coBorrowerIdSignDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!--PROOF OF INCOME (IF APPLICABLE) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class="micro-labels" id="tab-label" for="custom"><b>PROOF OF INCOME (IF APPLICABLE)</b></label>
                                          <input type="file" id="proofIncome" name="proofIncome"><img id="proofIncomeImage" src="statusImage/check.png" alt="statusImage"> 
                                          <a href="<?php echo $proofIncome; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="proofIncomeButton">Open File</button></a>
                                          <label class="date-label" id="proofIncomeDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($proofIncome, strrpos($proofIncome, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="proofIncomeSelect" name="proofIncomeSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="proofIncomeDesc" name="proofIncomeDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:150%"><b><u>CO-MAKER</u></b></label></div>
                                    </div>
                                 </div>
                                 <!-- CO=MAKER STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels"><b>CO-MAKER STATEMENT</b></label>
                                          <input type="file" id="comakerStatement" name="comakerStatement"><img id="comakerStatementImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $comakerStatement; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="comakerStatementButton">Open File</button></a> 
                                          <label class="date-label" id="comakerStatementDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($comakerStatement, strrpos($comakerStatement, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerStatementSelect" name="comakerStatementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="comakerStatementDesc" name="comakerStatementDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>1 COPY OF 2 VALID ID WITH 3 SIGNATURES</b></label>
                                          <input type="file" id="coMakerIdWithSign" name="coMakerIdWithSign"><img id="coMakerIdWithSignImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coMakerIdWithSign; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coMakerIdWithSignButton">Open File</button></a>
                                          <label class="date-label" id="coMakerIdWithSignDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerIdWithSign, strrpos($coMakerIdWithSign, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerValidSelect" name="comakerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coMakerIdWithSignDesc" name="coMakerIdWithSignDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LATEST BUSINESS PERMIT (IF APPLICABLE) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>LATEST BUSINESS PERMIT (IF APPLICABLE)</b></label>
                                          <input type="file" id="latestPermit" name="latestPermit"><img id="latestPermitImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $latestPermit; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestPermitButton">Open File</button></a>
                                          <label class="date-label" id="latestPermitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($latestPermit, strrpos($latestPermit, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerPermitSelect" name="comakerPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="latestPermitvDesc" name="latestPermitvDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                  <!--3 MONTHS OF PAYSLIP (IF EMPLOYED)  -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>3 MONTHS OF PAYSLIP (IF EMPLOYED)</b></label>
                                          <input type="file" id="coMakerPayslip" name="coMakerPayslip"><img id="coMakerPayslipImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $coMakerPayslip;?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="coMakerPayslipButton">Open File</button></a>
                                          <label class="date-label" id="coMakerPayslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMakerPayslip, strrpos($coMakerPayslip, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="comakerPayslipSelect" name="comakerPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="coMakerPayslipDesc" name="coMakerPayslipDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                    <div class="py-1">
                                    <label style="font-size:140%; margin-left: 10px;"><input class="form-check-input" style = "vertical-align: top;" type="checkbox" value="Check" id="renewalCheck" name="renewalCheck"><b> FOR RENEWAL</b></label>
                                    </div>
                                    </div>
                                 </div>
                                <!-- BUSINESS VALIDATION -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels"><b>BUSINESS VALIDATION</b></label>
                                          <input type="file" id="businessValidation" name="businessValidation"><img id="businessValidationImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $businessValidation; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessValidationButton">Open File</button></a> 
                                          <label class="date-label" id="businessValidationDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessValidation, strrpos($businessValidation, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="businessValidationSelect" name="businessValidationSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="businessValidationDesc" name="businessValidationDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LOAN INSTALLMENT SCHEDULE PREVIOUS LOAN -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>LOAN INSTALLMENT SCHEDULE PREVIOUS LOAN</b></label>
                                          <input type="file" id="loanInstallment" name="loanInstallment"><img id="loanInstallmentImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanInstallment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanInstallmentButton">Open File</button></a>
                                          <label class="date-label" id="loanInstallmentDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanInstallment, strrpos($loanInstallment, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="loanInstallmentSelect" name="loanInstallmentSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanInstallmentDesc" name="loanInstallmentDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- LOAN PAYMENT REPORT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>LOAN PAYMENT REPORT</b></label>
                                          <input type="file" id="loanPayment" name="loanPayment"><img id="loanPaymentImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $latestPermit; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanPaymentButton">Open File</button></a>
                                          <label class="date-label" id="loanPaymentDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanPayment, strrpos($loanPayment, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="loanPaymentSelect" name="loanPaymentSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1">
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanPaymentDesc" name="loanPaymentDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                  <!--STATEMENT OF ACCOUNT/BANK STATEMENT -->
                                 <div class="row" style = "margin-bottom:-2%;">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          <label class ="micro-labels" id="tab-label" for="custom"><b>STATEMENT OF ACCOUNT/<br>BANK STATEMENT</b></label>
                                          <input type="file" id="statementAccount" name="statementAccount"><img id="statementAccountImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $statementAccount;?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="statementAccountButton">Open File</button></a>
                                          <label class="date-label" id="statementAccountDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($statementAccount, strrpos($statementAccount, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="statementAccountSelect" name="statementAccountSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" tabindex="-1"> 
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
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
                                       <div class="py-3">&nbsp;<label style="font-size:130%"><b><u>DOCUMENT REPORTS</u></b></label></div>
                                    </div>
                                 </div>
                                  <!-- CLIENT'S VALIDATION CARD REPORTS -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b>&#x2022; CLIENT'S VISITATION CARD REPORTS</b></label>
                                          <input type="file" id="validCardReport" name="validCardReport"><img id="validCardReportImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $validCardReport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validCardReportButton">Open File</button></a> 
                                          <label class="date-label" id="validCardReportDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($validCardReport, strrpos($validCardReport, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4 ">
                                          <select  id="validCardReportSelect" name="validCardReportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="validCardReportDesc" name="validCardReportDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- CREDIT INVESTIGATION REPORT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b>&#x2022; CREDIT INVESTIGATION REPORT</b></label>
                                          <input type="file" id="creditReport" name="creditReport"><img id="creditReportImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $creditReport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditReportButton">Open File</button></a> 
                                          <label class="date-label" id="creditReportDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditReport, strrpos($creditReport, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="creditReportSelect" name="creditReportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL" ><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="creditReportDesc" name="creditReportDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- CREDIT INFORMATION AND BACKGROUND INVESTIGATION REPORT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2 mb-3">
                                          <label class ="micro-labels"><b> &#x2022; CREDIT INFORMATION AND BACKGROUND INVESTIGATION REPORT</b></label>
                                          <input type="file" id="creditInvestigationReportM" name="creditInvestigationReportM"><img id="creditInvestigationReportMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $creditInvestigationReportM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="creditInvestigationReportMButton">Open File</button></a> 
                                          <label class="date-label" id="creditInvestigationReportMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($creditInvestigationReportM, strrpos($creditInvestigationReportM, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-2">
                                          <select id="creditInvestigationReportMSelect" name="creditInvestigationReportMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="creditInvestigationReportMDesc" name="creditInvestigationReportMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- BORROWER'S RISK RATING (BRR)/CASHFLOW -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b> &#x2022; BORROWER'S RISK RATING (BRR)/CASHFLOW </b></label>
                                          <input type="file" id="riskRating" name="riskRating"><img id="riskRatingImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $riskRating; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="riskRatingButton">Open File</button></a> 
                                          <label class="date-label" id="riskRatingDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($riskRating, strrpos($riskRating, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-3">
                                          <select id="riskRatingSelect" name="riskRatingSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="riskRatingDesc" name="riskRatingDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- AUTHORITY TO DEBIT AND WAIVER -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b>AUTHORITY TO DEBIT AND WAIVER</b></label>
                                          <input type="file" id="debitWaiver" name="debitWaiver"><img id="debitWaiverImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $debitWaiver; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="debitWaiverButton">Open File</button></a> 
                                          <label class="date-label" id="debitWaiverDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($debitWaiver, strrpos($debitWaiver, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="debitWaiverSelect" name="debitWaiverSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="debitWaiverDesc" name="debitWaiverDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- AFFIDAVIT OF VOLUNTARY SURRENDER -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b>AFFIDAVIT OF VOLUNTARY SURRENDER</b></label>
                                          <input type="file" id="affidavitSurrender" name="affidavitSurrender"><img id="affidavitSurrenderImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $affidavitSurrender; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="affidavitSurrenderButton">Open File</button></a> 
                                          <label class="date-label" id="affidavitSurrenderDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($affidavitSurrender, strrpos($affidavitSurrender, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="affidavitSurrenderSelect" name="affidavitSurrenderSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="affidavitSurrenderDesc" name="affidavitSurrenderDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>

                                 <!-- LOAN APPROVAL SHEET -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b>LOAN APPROVAL SHEET </b></label>
                                          <input type="file" id="loanApprovalSheet" name="loanApprovalSheet"><img id="loanApprovalSheetImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $loanApprovalSheet; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanApprovalSheetButton">Open File</button></a> 
                                          <label class="date-label" id="loanApprovalSheetDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanApprovalSheet, strrpos($loanApprovalSheet, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4" >
                                          <select id="loanApprovalSheetSelect" name="loanApprovalSheetSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="loanApprovalSheetDesc" name="loanApprovalSheetDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-1">&nbsp;<label style="font-size:130%"><b><u>SIGNED DOCUMENTS FOR LOAN RELEASSES</u></b></label></div>
                                    </div>
                                 </div>
                                 <!-- PROMISSORY NOTE -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b>&#x2022; PROMISSORY NOTE</b></label>
                                          <input type="file" id="promissoryNoteM" name="promissoryNoteM"><img id="promissoryNoteMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $promissoryNoteM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="promissoryNoteMButton">Open File</button></a>
                                          <label class="date-label" id="promissoryNoteMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promissoryNoteM, strrpos($promissoryNoteM, '/') + 1, 10); ?></label> 
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="promissoryNoteMSelect" name="promissoryNoteMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="promissoryNoteMDesc" name="promissoryNoteMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS" >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                  <!-- DISCLOSURE STATEMENT -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2">
                                          <label class ="micro-labels"><b>&#x2022; DISCLOSURE STATEMENT</b></label>
                                          <input type="file" id="disclosureStateM" name="disclosureStateM"><img id="disclosureStateMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $disclosureStateM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateMButton">Open File</button></a> 
                                          <label class="date-label" id="disclosureStateMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateM, strrpos($disclosureStateM, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="disclosureStateMSelect" name="disclosureStateMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="disclosureStateMDesc" name="disclosureStateMDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                               <!--  MRI FORM (COUNTRY BANKERS)-->
                                  <div class="row">
                                     <div class="col-8">
                                        <div class="py-2">
                                           <label class ="micro-labels"><b>&#x2022; MRI FORM (COUNTRY BANKERS)</b></label>
                                           <input type="file" id="mriForm" name="mriForm"><img id="mriFormImage" src="statusImage/check.png" alt="statusImage">
                                           <a href="<?php echo $mriForm; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="mriFormButton">Open File</button></a>
                                           <label class="date-label" id="mriFormDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriForm, strrpos($mriForm, '/') + 1, 10); ?></label>
                                        </div>
                                     </div>
                                     <div class="col-4">
                                        <div class="form-group d-flex mb-4">
                                           <select id="mriFormSelect" name= "mriFormSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                              <option selected value="NULL"><b>Option</b></option>
                                              <option value="1">VERIFIED</option>
                                              <option value="2"><b>INCOMPLETE</b></option>
                                              <option value="3"><b>N/A</b></option>
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
                                          <label class ="micro-labels"><b>&#x2022; AMORTIZATION SCHEDULE</b></label>
                                          <input type="file" id="amortScheduleM" name="amortScheduleM"><img id="amortScheduleMImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $amortScheduleM; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleMButton">Open File</button></a>
                                          <label class="date-label" id="amortScheduleMDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleM, strrpos($amortScheduleM, '/') + 1, 10); ?></label> 
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex">
                                          <select id="amortScheduleMSelect" name="amortScheduleMSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="amortScheduleMDesc" name="amortScheduleMDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
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
                                 <div class ="OTHERS">
                                 <div class="row">
                                    <div class="col-8">
                                       <div style="border-top: 1px solid #676464; width:104.5%; margin-left:-1.4em;">
                                          <div class="py-1">&nbsp;<label style="font-size:150%"><b><u>OTHERS</u></b></label></div>
                                       </div>
                                    </div>
                                 </div>
                                  <!-- BUSINESS PICTURE -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="businessPictureCheck" name="businessPictureCheck">
                                          <label class ="micro-labels"><b>BUSINESS PICTURE </b></label>
                                          <input type="file" id="businessPicture" name="businessPicture"><img id="businessPictureImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $businessPicture; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="businessPictureButton">Open File</button></a> 
                                          <label class="date-label" id="businessPictureDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($businessPicture, strrpos($businessPicture, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex mb-4">
                                          <select id="businessPictureSelect" name="businessPictureSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="businessPictureDesc" name="businessPictureDesc" class="form-control w-75 p-1 fs-4" placeholder="REMARKS"  >&nbsp;
                                       </div>
                                    </div>
                                 </div>
                                 <!-- OTHERS (SUPPORTING DOCUMENTS) -->
                                 <div class="row">
                                    <div class="col-8">
                                       <div class="py-2"> 
                                          &nbsp;<input class="form-check-input" type="checkbox" value="Check" id="otherSuportCheck" name="otherSuportCheck">
                                          <label class ="micro-labels"><b>OTHERS (SUPPORTING DOCUMENTS)</b></label>
                                          <input type="file" id="otherSuport" name="otherSuport"><img id="otherSuportImage" src="statusImage/check.png" alt="statusImage">
                                          <a href="<?php echo $otherSuport; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="otherSuportButton">Open File</button></a>
                                          <label class="date-label" id="otherSuportDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($otherSuport, strrpos($otherSuport, '/') + 1, 10); ?></label>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="form-group d-flex">
                                          <select id="otherSuportSelect" name="otherSuportSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                             <option selected value="NULL"><b>Option</option>
                                             <option value="1">VERIFIED</option>
                                             <option value="2"><b>INCOMPLETE</b></option>
                                             <option value="3"><b>N/A</b></option>
                                          </select>
                                          &nbsp;&nbsp;<input type="text" id="otherSuportDesc" name="otherSuportDesc" class="form-control w-75 p-1 fs-4 " placeholder="REMARKS"  >&nbsp; 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-8" style="height: 4em; margin-bottom:-2%;"></div>
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
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
//Function to handle file upload separately
function uploadFileM() {
  var microformData = new FormData(microform);
  microformData.append('microId',microId);
  microformData.append('fullname',fullname);
  microformData.append('salaryType',salaryType);
  microformData.append('branch',branch);
  microformData.append('loanType',loanType);
  $.ajax({
    url: 'loanMicroUploadData.php', // Targeted URL
    type: 'POST',
    data: microformData,
    processData: false,
    contentType: false,
    success: function(response) {
      // PRINCIPAL BORROWER
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
function initializeCheckboxes() {  
  var businessPictureValue = "<?php echo $businessPictureCheck; ?>";
  var otherSuportValue = "<?php echo $otherSuportCheck; ?>";
  var renewalValue = "<?php echo $renewalCheck; ?>";
  // Get the checkbox elements
  const businessPictureCheck = document.getElementById('businessPictureCheck');
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