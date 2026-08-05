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
      <title>OURBANK</title>
      <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
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
         if($type == "Salary Loan") {       
         ?>

      <?php
         $query = "SELECT * FROM salaryloan WHERE salaryLoanId=$id ";
         $newdata = mysqli_query($con, $query) ;
         $row = mysqli_fetch_array($newdata);
         // BORROWER
         $loanAppForm=$row['loanAppForm'];
         $memoAgreementS=$row['memoAgreementS'];
         $certofEmployment=$row['certofEmployment'];
         $latestPayslip=$row['latestPayslip'];
         $tin=$row['tin'];
         $clearanceLoan=$row['clearanceLoan'];
         // CO MAKER 1
         $coMaker1=$row['coMaker1'];
         $validSignatures=$row['validSignatures'];
         $monthsPayslip=$row['monthsPayslip'];
         // CO MAKER 2
         $coMaker2=$row['coMaker2'];
         $validSignatures2=$row['validSignatures2'];
         $monthsPayslip2=$row['monthsPayslip2'];
         // DOCUMENTS
         $deductRemit=$row['deductRemit'];
         $cashflowScore=$row['cashflowScore'];
         $loanAppMemo=$row['loanAppMemo'];
         $promissoryNoteS=$row['promissoryNoteS'];
         $disclosureStateS=$row['disclosureStateS'];
         $mriForm=$row['mriForm'];
         $amortScheduleS=$row['amortScheduleS'];
         $utilization=$row['utilization'];
         // BORROWER STATUS
         $loanAppFormSelect = $row['loanAppFormStatus'];
         $memoAgreementSelect = $row['memoAgreementStatus'];
         $certEmploymentSelect = $row['certofEmploymentStatus'];
         $payslipSelect = $row['latestPayslipStatus'];
         $tinSelect = $row['tinStatus'];
         $clearanceLoanSelect = $row['clearanceLoanStatus'];
         // CO MAKER 1 STATUS
         $coMaker1Select = $row['coMaker1Status'];
         $validSignaturesSelect = $row['validSignaturesStatus'];
         $monthsPayslipSelect = $row['monthsPayslipStatus'];
         // CO MAKER 2 STATUS
         $coMaker2Select = $row['coMaker2Status'];
         $validSignatures2Select = $row['validSignatures2Status'];
         $monthsPayslip2Select = $row['monthsPayslip2Status'];
         // DOCUEMENTS
         $deductRemitSelect = $row['deductRemitStatus'];
         $cashflowScoreSelect = $row['cashflowScoreStatus'];
         $loanAppMemoSelect = $row['loanAppMemoStatus'];
         $promissoryNoteSSelect = $row['promissoryNoteSStatus'];
         $disclosureStateSSelect = $row['disclosureStateSStatus'];
         $mriFormSelect = $row['mriFormStatus'];
         $amortScheduleSSelect = $row['amortScheduleSStatus'];
         $utilizationSelect = $row['utilizationStatus'];
         
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
                        <a class="nav-link text-dark active" data-bs-toggle="tab" id="tab2" href="#salary"><b>Salary</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab3" href="#corporation"><b>Real Estate Mortgage - Corporation</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark disabled" data-bs-toggle="tab" id="tab4" href="#individual"><b>Real Estate Mortgage - Individual</b></a>
                     </li>
                  </ul>
                  <div class="row">
                     <div class="col-12">
                        <div class="tab-content p-6">
                           <div id="salary" class="tab-pane active" style="border: 1px solid #ccc;">
                              <form id="salary-form" action="loanSalaryUploadData.php" method="POST" enctype="multipart/form-data">

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
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><b><u>BORROWER</u></b></label></div>
                                             </div>
                                          </div>
                                           <!-- LOAN APPLICATION FORM -->
                                          <div class="row">
                                            <div class="col-8">
                                             <div class="py-1">  
                                                <label class ="salary-labels"><b>&#x2022; LOAN APPLICATION FORM</b></label>
                                                <input type="file" id="loanAppForm" name="loanAppForm"><img id="loanAppFormImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $loanAppForm; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="loanAppFormButton">Open File</button></a> 
                                                <label class="date-label" id="loanAppFormDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppForm, strrpos($loanAppForm, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="loanAppFormSelect" name= "loanAppFormSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected  value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppFormDesc" name = "loanAppFormDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS"> &nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- MEMORANDUM OF AGREEMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                             <div class="py-1">  
                                                <label class ="salary-labels"><b>&#x2022; MEMORANDUM OF AGREEMENT</b></label>
                                                <input type="file" id="memoAgreementS" name="memoAgreementS"><img id="memoAgreementSImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $memoAgreementS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="memoAgreementSButton" >Open File</button></a>
                                                <label class="date-label" id="memoAgreementSDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($memoAgreementS, strrpos($memoAgreementS, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="memoAgreementSelect" name= "memoAgreementSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="memoAgreementSDesc" name = "memoAgreementSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- CERTIFICATE OF EMPLOYMENT -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">  
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; CERTIFICATE OF EMPLOYMENT</b> </label>
                                                <input type="file" class="certofEmployment" id="certofEmployment" name="certofEmployment"><img id="certofEmploymentImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $certofEmployment; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="certofEmploymentButton">Open File</button></a>
                                                <label class="date-label" id="certofEmploymentDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($certofEmployment, strrpos($certofEmployment, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-1">
                                                   <select id="certEmploymentSelect" name= "certEmploymentSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; LATEST PAY-SLIP</b> </label>
                                                <input type="file" id="latestPayslip" name="latestPayslip"><img id="latestPayslipImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $latestPayslip; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="latestPayslipButton">Open File</button></a>
                                                <label class="date-label" id="latestPayslipDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($latestPayslip, strrpos($latestPayslip, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="payslipSelect" name= "payslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="latestPayslipDesc" name = "latestPayslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                           <!-- T.I.N AND/OR ANY 2 VALID I.D -->    
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; T.I.N AND/OR ANY 2 VALID I.D</b></label>
                                                <input type="file" id="tin" name="tin"><img id="tinImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $tin; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="tinButton">Open File</button></a>
                                                <label class="date-label" id="tinDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($tin, strrpos($tin, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="tinSelect" name= "tinSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="tinDesc" name = "tinDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <!-- BARANGAY CLEARANCE FOR LOAN PURPOSE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; BARANGAY CLEARANCE FOR LOAN PURPOSE</b></label>
                                                <input type="file" id="clearanceLoan" name="clearanceLoan"><img id="clearanceLoanImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $clearanceLoan; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="clearanceLoanButton">Open File</button></a>
                                                <label class="date-label" id="clearanceLoanDate"><i class="fas fa-calendar-alt"></i> <?php echo substr($clearanceLoan, strrpos($clearanceLoan, '/') + 1, 10); ?></label><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="clearanceLoanSelect" name= "clearanceLoanSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="clearanceLoanDesc" name = "clearanceLoanDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                                <br>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><b><u>CO-MAKER 1</u></b></label></div>
                                             </div>
                                          </div>
                                          <!-- CO-MAKER STATEMENT 1-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1"> 
                                                <label class ="salary-labels" ><b>&#x2022; CO-MAKER STATEMENT</b></label>
                                                <input type="file" id="coMaker1" name="coMaker1"><img id="coMaker1Image" src="statusImage/check.png" alt="statusImage"> 
                                                <a href="<?php echo $coMaker1; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="coMaker1Button">Open File</button></a>
                                                <label class="date-label" id="coMaker1Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMaker1, strrpos($coMaker1, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMaker1Select" name= "coMaker1Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; VALID ID WITH 3 SIGNATURES</b> </label>
                                                <input type="file" id="validSignatures" name="validSignatures"><img id="validSignaturesImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $validSignatures; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validSignaturesButton">Open File</button></a>
                                                <label class="date-label" id="validSignaturesDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($validSignatures, strrpos($validSignatures, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="validSignaturesSelect" name= "validSignaturesSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; 3 MONTHS PAYSLIP</b></label>
                                                <input type="file" id="monthsPayslip" name="monthsPayslip"><img id="monthsPayslipImage" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $monthsPayslip; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="monthsPayslipButton">Open File</button></a>
                                                <label class="date-label" id="monthsPayslipDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($monthsPayslip, strrpos($monthsPayslip, '/') + 1, 10); ?></label><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="monthsPayslipSelect" name= "monthsPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="monthsPayslipDesc" name = "monthsPayslipDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:120%"><b><u>CO-MAKER 2</u></b></label></div>
                                             </div>
                                          </div>
                                           <!-- CO-MAKER STATEMENT 2-->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                <label class ="salary-labels" ><b>&#x2022; CO-MAKER STATEMENT</b></label>
                                                <input type="file" id="coMaker2" name="coMaker2"><img id="coMaker2Image" src="statusImage/check.png" alt="statusImage"> 
                                                <a href="<?php echo $coMaker2; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="coMaker2Button" >Open File</button></a>
                                                <label class="date-label" id="coMaker2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($coMaker2, strrpos($coMaker2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="coMaker2Select" name= "coMaker2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; VALID ID WITH 3 SIGNATURES</b> </label>
                                                <input type="file" id="validSignatures2" name="validSignatures2"><img id="validSignatures2Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $validSignatures2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="validSignatures2Button">Open File</button></a>
                                                <label class="date-label" id="validSignatures2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($validSignatures2, strrpos($validSignatures2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="validSignatures2Select" name= "validSignatures2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                <label class="salary-labels" id="tab-label" for="custom"><b>&#x2022; 3 MONTHS PAYSLIP</b></label>
                                                <input type="file" id="monthsPayslip2" name="monthsPayslip2"><img id="monthsPayslip2Image" src="statusImage/check.png" alt="statusImage">
                                                <a href="<?php echo $monthsPayslip2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="monthsPayslip2Button">Open File</button></a>
                                                <label class="date-label" id="monthsPayslip2Date"> <i class="fas fa-calendar-alt"></i> <?php echo substr($monthsPayslip2, strrpos($monthsPayslip2, '/') + 1, 10); ?></label><br><br>
                                             </div>
                                          </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="monthsPayslip2Select" name= "monthsPayslip2Select" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="monthsPayslip2Desc" name = "monthsPayslip2Desc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
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
                                                   <label class ="salary-labels"><b>ASSIGNMENT OF SALARY & AUTHORITY TO DEDUCT AND REMIT</b></label>
                                                   <input type="file" id="deductRemit" name="deductRemit"><img id="deductRemitImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $deductRemit; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="deductRemitButton" >Open File</button></a>
                                                   <label class="date-label" id="deductRemitDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($deductRemit, strrpos($deductRemit, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="deductRemitSelect" name= "deductRemitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" >
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class ="salary-labels" ><b>FINANCIAL EVALUATION (CASHFLOW ANALYSIS) AND BRR SCORECARD</b></label>
                                                   <input type="file" id="cashflowScore" name="cashflowScore"><img id="cashflowScoreImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $cashflowScore; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="cashflowScoreButton" >Open File</button></a>
                                                   <label class="date-label" id="cashflowScoreDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($cashflowScore, strrpos($cashflowScore, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-2">
                                                   <select id="cashflowScoreSelect" name= "cashflowScoreSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class ="salary-labels"><b>LOAN APPROVAL MEMO</b></label>
                                                   <input type="file" id="loanAppMemo" name="loanAppMemo"><img id="loanAppMemoImage" src="statusImage/check.png" alt="statusImage"> 
                                                   <a href="<?php echo $loanAppMemo; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="loanAppMemoButton" >Open File</button></a>
                                                   <label class="date-label" id="loanAppMemoDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($loanAppMemo, strrpos($loanAppMemo, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="loanAppMemoSelect" name= "loanAppMemoSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="loanAppMemoDesc" name = "loanAppMemoDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">&nbsp;<label style="font-size:130%"><b><u>SIGNED DOCUMENS FOR LOAN RELEASE</u></b></label></div>
                                             </div>
                                          </div>
                                          <!-- PORMISORRY NOTE -->
                                          <div class="row">
                                             <div class="col-8">
                                                <div class="py-1">
                                                   <label class ="salary-labels"><b>&#x2022; PROMISSORY NOTE</b></label>
                                                   <input type="file" id="promissoryNoteS" name="promissoryNoteS"><img id="promissoryNoteSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $promissoryNoteS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="promissoryNoteSButton">Open File</button></a> 
                                                   <label class="date-label" id="promissoryNoteSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($promissoryNoteS, strrpos($promissoryNoteS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="promissoryNoteSSelect" name= "promissoryNoteSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class ="salary-labels"><b>&#x2022; DISCLOSURE STATEMENT</b></label>
                                                   <input type="file" id="disclosureStateS" name="disclosureStateS"><img id="disclosureStateSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $disclosureStateS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="disclosureStateSButton">Open File</button></a>
                                                   <label class="date-label" id="disclosureStateSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($disclosureStateS, strrpos($disclosureStateS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="disclosureStateSSelect" name= "disclosureStateSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL" ><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class ="salary-labels"><b>&#x2022; INSURANCE DOCUMENTS</b></label>
                                                   <input type="file" id="mriForm" name="mriForm"><img id="mriFormImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $mriForm; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="mriFormButton">Open File</button></a>
                                                   <label class="date-label" id="mriFormDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($mriForm, strrpos($mriForm, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex mb-3">
                                                   <select id="mriFormSelect" name= "mriFormSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL"><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
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
                                                   <label class ="salary-labels"><b>&#x2022; AMORTIZATION SCHEDULE</b></label>
                                                   <input type="file" id="amortScheduleS" name="amortScheduleS"><img id="amortScheduleSImage" src="statusImage/check.png" alt="statusImage">
                                                   <a href="<?php echo $amortScheduleS; ?>" target="_blank" class="custom-link"><button type="button" class="btn btn-outline-success btnFile" id="amortScheduleSButton">Open File</button></a>
                                                   <label class="date-label" id="amortScheduleSDate"> <i class="fas fa-calendar-alt"></i> <?php echo substr($amortScheduleS, strrpos($amortScheduleS, '/') + 1, 10); ?></label>
                                                </div>
                                             </div>
                                             <div class="col-4">
                                                <div class="form-group d-flex">
                                                   <select id="amortScheduleSSelect" name= "amortScheduleSSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                                                      <option selected value="NULL"><b>Option</b></option>
                                                      <option value="1">VERIFIED</option>
                                                      <option value="2"><b>INCOMPLETE</b></option>
                                                      <option value="3"><b>N/A</b></option>
                                                   </select>
                                                   &nbsp;&nbsp;
                                                   <input type="text" id="amortScheduleSDesc" name = "amortScheduleSDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
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
                                           <input type="text" id="utilizationDesc" name = "utilizationDesc" class="form-control w-75 p-1 fs-5" placeholder="REMARKS">&nbsp;
                                        </div>
                                     </div>
                                  </div>
                                          <!-- FOR SPACE -->
                                          <div class="row">
                                             <div class="col-8" style="height:17.5em; margin-bottom:-2%;" ></div>
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
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
handleSelectChange('loanAppFormSelect', 'loanAppFormDesc');
handleSelectChange('memoAgreementSelect', 'memoAgreementSDesc');
handleSelectChange('certEmploymentSelect', 'certofEmploymentDesc');
handleSelectChange('payslipSelect', 'latestPayslipDesc');
handleSelectChange('tinSelect', 'tinDesc');
handleSelectChange('clearanceLoanSelect', 'clearanceLoanDesc');
// CO MAKER 1
handleSelectChange('coMaker1Select', 'coMaker1Desc');
handleSelectChange('validSignaturesSelect', 'validSignaturesDesc');
handleSelectChange('monthsPayslipSelect', 'monthsPayslipDesc');
// CO-MAKER 2
handleSelectChange('coMaker2Select', 'coMaker2Desc');
handleSelectChange('validSignatures2Select', 'validSignatures2Desc');
handleSelectChange('monthsPayslip2Select', 'monthsPayslip2Desc');
// DOCUMENTS
handleSelectChange('deductRemitSelect', 'deductRemitDesc');
handleSelectChange('cashflowScoreSelect', 'cashflowScoreDesc');
handleSelectChange('loanAppMemoSelect', 'loanAppMemoDesc');
handleSelectChange('promissoryNoteSSelect', 'promissoryNoteSDesc');
handleSelectChange('disclosureStateSSelect', 'disclosureStateSDesc');
handleSelectChange('mriFormSelect', 'mriFormDesc');
handleSelectChange('amortScheduleSSelect', 'amortScheduleSDesc');
handleSelectChange('utilizationSelect', 'utilizationDesc');
</script>


<!-- Salary-FORM AJAX-->
<script>
  var salaryform = document.getElementById("salary-form");
  var branch = "<?php echo $branch; ?>";
  var salaryId = "<?php echo $id; ?>";
  var fullname= "<?php echo $fullname; ?>";
  var salaryType= "<?php echo $type; ?>";
  var loanType= "<?php echo $loanType; ?>";
  function uploadFileS() {
    var salaryformData = new FormData(salaryform);
    salaryformData.append('salaryId', salaryId);
    salaryformData.append('fullname', fullname);
    salaryformData.append('salaryType', salaryType);
    salaryformData.append('branch', branch);
    salaryformData.append('loanType', loanType);
    
    $.ajax({
      url: 'loanSalaryUploadData.php', 
      type: 'POST',
      data: salaryformData,
      processData: false,
      contentType: false,
      success: function(response) {
      // BORROWER
      updateFileStatus('loanAppForm', 'loanAppFormImage',`loanAppFormSelect`);
      updateFileStatus('memoAgreementS', 'memoAgreementSImage');
      updateFileStatus('certofEmployment', 'certofEmploymentImage');
      updateFileStatus('latestPayslip', 'latestPayslipImage');
      updateFileStatus('tin', 'tinImage');
      updateFileStatus('clearanceLoan', 'clearanceLoanImage');
      // CO MAKER 1
      updateFileStatus('coMaker1', 'coMaker1Image');
      updateFileStatus('validSignatures', 'validSignaturesImage');
      updateFileStatus('monthsPayslip', 'monthsPayslipImage');
      // CO MAKER 2
      updateFileStatus('coMaker2', 'coMaker2Image');
      updateFileStatus('validSignatures2', 'validSignatures2Image');
      updateFileStatus('monthsPayslip2', 'monthsPayslip2Image');
      // DOCUMENTS
      updateFileStatus('deductRemit', 'deductRemitImage');
      updateFileStatus('cashflowScore', 'cashflowScoreImage');
      updateFileStatus('loanAppMemo', 'loanAppMemoImage');
      updateFileStatus('promissoryNoteS', 'promissoryNoteSImage');
      updateFileStatus('disclosureStateS', 'disclosureStateSImage');
      updateFileStatus('mriForm', 'mriFormImage');
      updateFileStatus('amortScheduleS', 'amortScheduleSImage');
      updateFileStatus('utilization', 'utilizationImage');

      },
      error: function(xhr, status, error) {
        console.log('File upload failed');
      }
    });
  }

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
selectOptionBasedOnValue('<?php echo $loanAppFormSelect; ?>', 'loanAppFormSelect','loanAppFormDesc');
selectOptionBasedOnValue('<?php echo $memoAgreementSelect; ?>', 'memoAgreementSelect', 'memoAgreementSDesc');
selectOptionBasedOnValue('<?php echo $certEmploymentSelect; ?>', 'certEmploymentSelect', 'certofEmploymentDesc');
selectOptionBasedOnValue('<?php echo $payslipSelect; ?>', 'payslipSelect', 'latestPayslipDesc');
selectOptionBasedOnValue('<?php echo $tinSelect; ?>', 'tinSelect', 'tinDesc');
selectOptionBasedOnValue('<?php echo $clearanceLoanSelect; ?>', 'clearanceLoanSelect', 'clearanceLoanDesc');
// CO MAKER 1
selectOptionBasedOnValue('<?php echo $coMaker1Select; ?>', 'coMaker1Select', 'coMaker1Desc');
selectOptionBasedOnValue('<?php echo $validSignaturesSelect; ?>', 'validSignaturesSelect', 'validSignaturesDesc');
selectOptionBasedOnValue('<?php echo $monthsPayslipSelect; ?>', 'monthsPayslipSelect', 'monthsPayslipDesc');
// CO MAKER 2
selectOptionBasedOnValue('<?php echo $coMaker2Select; ?>', 'coMaker2Select', 'coMaker2Desc');
selectOptionBasedOnValue('<?php echo $validSignatures2Select; ?>', 'validSignatures2Select', 'validSignatures2Desc');
selectOptionBasedOnValue('<?php echo $monthsPayslip2Select; ?>', 'monthsPayslip2Select', 'monthsPayslip2Desc');
// DOCUMENTS
selectOptionBasedOnValue('<?php echo $deductRemitSelect; ?>', 'deductRemitSelect', 'deductRemitDesc');
selectOptionBasedOnValue('<?php echo $cashflowScoreSelect; ?>', 'cashflowScoreSelect', 'cashflowScoreDesc');
selectOptionBasedOnValue('<?php echo $loanAppMemoSelect; ?>', 'loanAppMemoSelect', 'loanAppMemoDesc');
selectOptionBasedOnValue('<?php echo $promissoryNoteSSelect; ?>', 'promissoryNoteSSelect', 'promissoryNoteSDesc');
selectOptionBasedOnValue('<?php echo $disclosureStateSSelect; ?>', 'disclosureStateSSelect', 'disclosureStateSDesc');
selectOptionBasedOnValue('<?php echo $mriFormSelect; ?>', 'mriFormSelect', 'mriFormDesc');
selectOptionBasedOnValue('<?php echo $amortScheduleSSelect; ?>', 'amortScheduleSSelect', 'amortScheduleSDesc');
selectOptionBasedOnValue('<?php echo $utilizationSelect; ?>', 'utilizationSelect', 'utilizationDesc');

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
resetIndex('loanAppForm', 'loanAppFormSelect', 'loanAppFormDesc');
resetIndex('memoAgreementS', 'memoAgreementSelect', 'memoAgreementSDesc');
resetIndex('certofEmployment', 'certEmploymentSelect', 'certofEmploymentDesc');
resetIndex('latestPayslip', 'payslipSelect', 'latestPayslipDesc');
resetIndex('tin', 'tinSelect', 'tinDesc');
resetIndex('clearanceLoan', 'clearanceLoanSelect', 'clearanceLoanDesc');
// CO MAKER
resetIndex('coMaker1', 'coMaker1Select', 'coMaker1Desc');
resetIndex('validSignatures', 'validSignaturesSelect', 'validSignaturesDesc');
resetIndex('monthsPayslip', 'monthsPayslipSelect', 'monthsPayslipDesc');
// CO MAKER 2
resetIndex('coMaker2', 'coMaker2Select', 'coMaker2Desc');
resetIndex('validSignatures2', 'validSignatures2Select', 'validSignatures2Desc');
resetIndex('monthsPayslip2', 'monthsPayslip2Select', 'monthsPayslip2Desc');
// DOCUMENTS
resetIndex('deductRemit', 'deductRemitSelect', 'deductRemitDesc');
resetIndex('cashflowScore', 'cashflowScoreSelect', 'cashflowScoreDesc');
resetIndex('loanAppMemo', 'loanAppMemoSelect', 'loanAppMemoDesc');
resetIndex('promissoryNoteS', 'promissoryNoteSSelect', 'promissoryNoteSDesc');
resetIndex('disclosureStateS', 'disclosureStateSSelect', 'disclosureStateSDesc');
resetIndex('mriForm', 'mriFormSelect', 'mriFormDesc');
resetIndex('amortScheduleS', 'amortScheduleSSelect', 'amortScheduleSDesc');
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
   setFileVisibility("<?php echo $loanAppForm; ?>","<?php echo $loanAppFormSelect; ?>",'loanAppForm','loanAppFormImage', 'loanAppFormButton','loanAppFormDate');
   setFileVisibility("<?php echo $memoAgreementS; ?>","<?php echo $memoAgreementSelect; ?>",'memoAgreementS','memoAgreementSImage', 'memoAgreementSButton','memoAgreementSDate');
   setFileVisibility("<?php echo $certofEmployment; ?>","<?php echo $certEmploymentSelect; ?>",'certofEmployment','certofEmploymentImage', 'certofEmploymentButton','certofEmploymentDate');
   setFileVisibility("<?php echo $latestPayslip; ?>","<?php echo $payslipSelect; ?>",'latestPayslip','latestPayslipImage', 'latestPayslipButton','latestPayslipDate');
   setFileVisibility("<?php echo $tin; ?>","<?php echo $tinSelect; ?>",'tin','tinImage', 'tinButton','tinDate');
   setFileVisibility("<?php echo $clearanceLoan; ?>","<?php echo $clearanceLoanSelect; ?>",'clearanceLoan','clearanceLoanImage', 'clearanceLoanButton','clearanceLoanDate');
   // CO MAKER 1
   setFileVisibility("<?php echo $coMaker1; ?>","<?php echo $coMaker1Select; ?>",'coMaker1','coMaker1Image', 'coMaker1Button','coMaker1Date');
   setFileVisibility("<?php echo $validSignatures; ?>","<?php echo $validSignaturesSelect; ?>",'validSignatures','validSignaturesImage', 'validSignaturesButton','validSignaturesDate');
   setFileVisibility("<?php echo $monthsPayslip; ?>","<?php echo $monthsPayslipSelect; ?>",'monthsPayslip','monthsPayslipImage', 'monthsPayslipButton','monthsPayslipDate');
   // CO MAKER 2
   setFileVisibility("<?php echo $coMaker2; ?>","<?php echo $coMaker2Select; ?>",'coMaker2','coMaker2Image', 'coMaker2Button','coMaker2Date');
   setFileVisibility("<?php echo $validSignatures2; ?>","<?php echo $validSignatures2Select; ?>",'validSignatures2','validSignatures2Image', 'validSignatures2Button','validSignatures2Date');
   setFileVisibility("<?php echo $monthsPayslip2; ?>","<?php echo $monthsPayslip2Select; ?>",'monthsPayslip2','monthsPayslip2Image', 'monthsPayslip2Button','monthsPayslip2Date');
   // DOCUMENTS
   setFileVisibility("<?php echo $deductRemit; ?>","<?php echo $deductRemitSelect; ?>",'deductRemit','deductRemitImage', 'deductRemitButton','deductRemitDate');
   setFileVisibility("<?php echo $cashflowScore; ?>","<?php echo $cashflowScoreSelect; ?>",'cashflowScore','cashflowScoreImage', 'cashflowScoreButton','cashflowScoreDate');
   setFileVisibility("<?php echo $loanAppMemo; ?>","<?php echo $loanAppMemoSelect; ?>",'loanAppMemo','loanAppMemoImage', 'loanAppMemoButton','loanAppMemoDate');
   setFileVisibility("<?php echo $promissoryNoteS; ?>","<?php echo $promissoryNoteSSelect; ?>",'promissoryNoteS','promissoryNoteSImage', 'promissoryNoteSButton','promissoryNoteSDate');
   setFileVisibility("<?php echo $disclosureStateS; ?>","<?php echo $disclosureStateSSelect; ?>",'disclosureStateS','disclosureStateSImage', 'disclosureStateSButton','disclosureStateSDate');
   setFileVisibility("<?php echo $mriForm; ?>","<?php echo $mriFormSelect; ?>",'mriForm','mriFormImage', 'mriFormButton','mriFormDate');
   setFileVisibility("<?php echo $amortScheduleS; ?>","<?php echo $amortScheduleSSelect; ?>",'amortScheduleS','amortScheduleSImage', 'amortScheduleSButton','amortScheduleSDate');
   setFileVisibility("<?php echo $utilization; ?>", "<?php echo $utilizationSelect; ?>", 'utilization', 'utilizationImage', 'utilizationButton', 'utilizationDate');
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

      showText('loanAppFormDesc');
      showText('memoAgreementSDesc');
      showText('certofEmploymentDesc');
      showText('latestPayslipDesc');
      showText('tinDesc');
      showText('clearanceLoanDesc');
      showText('coMaker1Desc');
      showText('validSignaturesDesc');
      showText('monthsPayslipDesc');
      showText('coMaker2Desc');
      showText('validSignatures2Desc');
      showText('monthsPayslip2Desc');
      showText('deductRemitDesc');
      showText('cashflowScoreDesc');
      showText('loanAppMemoDesc');
      showText('promissoryNoteSDesc');
      showText('disclosureStateSDesc');
      showText('mriFormDesc');
      showText('amortScheduleSDesc');
      showText('utilizationDesc');
    </script>