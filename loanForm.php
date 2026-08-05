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
    <style type="text/css">

    </style>
    <title>Tabs</title>
  </head>
  <body oncontextmenu="return false;">
<?php

$id =  $_POST['loanId'];
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
        
} 

?>
<?php
if($type == "Microfinance") {



?>
     <script>
        document.getElementById('tab1').classList.add('active');;
        document.getElementById('microfinance').classList.add('active');
        document.getElementById('tab2').setAttribute('disabled', 'disabled');
        document.getElementById('tab3').setAttribute('disabled', 'disabled');
        document.getElementById('tab4').setAttribute('disabled', 'disabled');
    </script>
<?php
        
        $query1="SELECT * FROM microfinance WHERE mLoan_Id=$id ";
        $newdata= mysqli_query($con, $query1);
        $row1 = mysqli_fetch_array($newdata); 

        $borrower_Id = $row1['mborrower_Id'];
        $borrower_Idsignature = $row1['mborrower_IdSign'];
        $borrower_Lbp = $row1['mborrower_Lbp'];
        $borrower_Lpb = $row1['mborrower_Lpb'];

        $coBorrwerIdPic = $row1['mcoBorrower_Id'];
        $coBorrowerIdWithSign = $row1['mcoBorrower_IdSign'];
        $coMakerIdPic = $row1['mcoMaker_Id'];
        $coMakerIdWithSign = $row1['mcoMaker_IdSign'];
        $coMakerLasterBP = $row1['mcoMaker_Lbp'];
        $coMakerPayslip = $row1['mcoMaker_Payslip'];     
                
} 
function setFileVisibility($file, $inputId, $checkImageId) {

        if (!empty($file)) {

            ?>
            <script>
                document.getElementById("<?php echo $inputId; ?>").style.display = "none";
                document.getElementById("<?php echo $checkImageId; ?>").style.visibility = "visible";
            </script>
            <?php
        }
    }
       
setFileVisibility($borrower_Id, "borrower_Id", "checkImageM1");
setFileVisibility($borrower_Idsignature, "borrower_Idsignature", "checkImageM2");
setFileVisibility($borrower_Lbp, "borrower_Lbp", "checkImageM3");
setFileVisibility($borrower_Lpb, "borrower_Lpb", "checkImageM4");
setFileVisibility($coBorrwerIdPic, "coBorrwerIdPic", "checkImageM5");
setFileVisibility($coBorrowerIdWithSign, "coBorrowerIdWithSign", "checkImageM6");
setFileVisibility($coMakerIdPic, "coMakerIdPic", "checkImageM7");
setFileVisibility($coMakerIdWithSign, "coMakerIdWithSign", "checkImageM8");
setFileVisibility($coMakerLasterBP, "coMakerLasterBP", "checkImageM9");
setFileVisibility($coMakerPayslip, "coMakerPayslip", "checkImageM10");





// Salary Loan Active and Disabled Buttons.
if($type == "Salary Loan") {
        
?>

     <script type="">
     

        document.getElementById('tab2').classList.add('active');;
        document.getElementById('salary').classList.add('active');
        document.getElementById('tab1').setAttribute('disabled', 'disabled');
        document.getElementById('tab3').setAttribute('disabled', 'disabled');
        document.getElementById('tab4').setAttribute('disabled', 'disabled');     
        </script>
<?php
        
        $query2 = "SELECT * FROM salaryloan WHERE salaryLoanId=$id ";
        $newdata = mysqli_query($con, $query2) ;
        $row2 = mysqli_fetch_array($newdata);

        $certofEmployment=$row2['certofEmployment'];
        $co_Makers=$row2['co_Makers'];
        $latestPayslip=$row2['latestPayslip'];
        $tin=$row2['tin'];

}
        
setFileVisibility($certofEmployment, "certofEmployment", "checkImageS1");
setFileVisibility($co_Makers, "co_Makers", "checkImageS2");
setFileVisibility($latestPayslip, "latestPayslip", "checkImageS3");
setFileVisibility($tin, "tin", "checkImageS4");





// Corporation Active and Disabled Buttons.
if($type == "REM: Corporation") {
     
?>
     <script>
        document.getElementById('tab3').classList.add('active');;
        document.getElementById('corporation').classList.add('active');
        document.getElementById('tab1').setAttribute('disabled', 'disabled');
        document.getElementById('tab2').setAttribute('disabled', 'disabled');
        document.getElementById('tab4').setAttribute('disabled', 'disabled');
    </script>
<?php
        $query3 = "SELECT * FROM corporation WHERE corpLoanId=$id ";
        $newdata = mysqli_query($con, $query3) ;
        $row3 = mysqli_fetch_array($newdata);

        $companyProfile = $row3['ccompanyProfile'];
        $secRegistration = $row3['csecRegistration'];
        $latestGIS = $row3['clatestGIS'];
        $copyBRS = $row3['ccopyBRS'];
        $copyidCST = $row3['ccopyidCST'];
        $copyUpdatedBP = $row3['ccopyUpdatedBP'];
        $transferCertTitle = $row3['ctransferCertTitle'];
        $taxDeclaration = $row3['ctaxDeclaration'];
        $taxDeclartionICTC = $row3['ctaxDeclartionICTC'];
        $realStateReceipt = $row3['crealStateReceipt'];
        $realEstateTaxClearance = $row3['crealEstateTaxClearance'];
        $cdOfMorgage = $row3['ccdOfMorgage'];
        $auditedFinancial = $row3['auditedFinancial'];
        $inhouseFinancial = $row3['inhouseFinancial'];
        $latestBank = $row3['latestBank'];
        $customerContact = $row3['customerContact'];
        $supplierContact = $row3['supplierContact'];
        $idPicture = $row3['idPicture'];
        $proofBilling = $row3['proofBilling'];
                             
}
setFileVisibility($companyProfile, "companyProfile", "checkImageC1");
setFileVisibility($secRegistration, "secRegistration", "checkImageC2");
setFileVisibility($latestGIS, "latestGIS", "checkImageC3");
setFileVisibility($copyBRS, "copyBRS", "checkImageC4");
setFileVisibility($copyidCST, "copyidCST", "checkImageC5");
setFileVisibility($copyUpdatedBP, "copyUpdatedBP", "checkImageC6");
setFileVisibility($transferCertTitle, "transferCertTitle", "checkImageC7");
setFileVisibility($taxDeclaration, "taxDeclaration", "checkImageC8");
setFileVisibility($taxDeclartionICTC, "taxDeclartionICTC", "checkImageC9");
setFileVisibility($realStateReceipt, "realStateReceipt", "checkImageC10");
setFileVisibility($realEstateTaxClearance, "realEstateTaxClearance", "checkImageC11");
setFileVisibility($cdOfMorgage, "cdOfMorgage", "checkImageC12");
setFileVisibility($auditedFinancial, "auditedFinancial", "checkImageC13");
setFileVisibility($inhouseFinancial, "inhouseFinancial", "checkImageC14");
setFileVisibility($latestBank, "latestBank", "checkImageC15");
setFileVisibility($customerContact, "customerContact", "checkImageC16");
setFileVisibility($supplierContact, "supplierContact", "checkImageC17");
setFileVisibility($idPicture, "idPicture", "checkImageC18");
setFileVisibility($proofBilling, "proofBilling", "checkImageC19");


// Individual Active and Disabled Buttons.
if($type == "REM: Individual") {

       
?>
     <script>
        document.getElementById('tab4').classList.add('active');;
        document.getElementById('individual').classList.add('active');
        document.getElementById('tab1').setAttribute('disabled', 'disabled');
        document.getElementById('tab2').setAttribute('disabled', 'disabled');
        document.getElementById('tab3').setAttribute('disabled', 'disabled');
    </script>
<?php
        $query4 = "SELECT * FROM individual WHERE indivloanId=$id ";
        $newdata = mysqli_query($con, $query4);
        $row4 = mysqli_fetch_array($newdata);

        $indTransferCoT = $row4['iindTransferCoT'];
        $indTaxDeclarationLCTC = $row4['iindTaxDeclarationLCTC'];
        $indTaxDeclarationICTC = $row4['iindTaxDeclarationICTC'];
        $indRealEstateTR = $row4['iindRealEstateTR'];
        $indRealEstClearance = $row4['iindRealEstClearance'];
        $indIdPicture = $row4['iindIdPicture'];
        $indTaxIdNumber = $row4['iindTaxIdNumber'];
        $indIdWithSign = $row4['iindIdWithSign'];
        $indlITR = $row4['iindlITR'];
        $indCDofM = $row4['iindCDofM'];
        $indProofofBill = $row4['iindProofofBill'];
        $indProofofIncome = $row4['certOfCompnesation'];
        $indBrgyClearance = $row4['indauditedFinancial'];
        $indCenomar = $row4['inbankStatements'];
        $indCustomerWithCN = $row4['proofRemitance'];
        $indSupplierWithCN = $row4['indBrgyClearance'];
        $indCenomar = $row4['indCenomar'];
        $indCustomerWithCN = $row4['indCustomerWithCN'];
        $indSupplierWithCN = $row4['indSupplierWithCN'];


                   
}

setFileVisibility($indTransferCoT, "indTransferCoT", "checkImageI1");
setFileVisibility($indTaxDeclarationLCTC, "indTaxDeclarationLCTC", "checkImageI2");
setFileVisibility($indTaxDeclarationICTC, "indTaxDeclarationICTC", "checkImageI3");
setFileVisibility($indRealEstateTR, "indRealEstateTR", "checkImageI4");
setFileVisibility($indRealEstClearance, "indRealEstClearance", "checkImageI5");
setFileVisibility($indIdPicture, "indIdPicture", "checkImageI6");
setFileVisibility($indTaxIdNumber, "indTaxIdNumber", "checkImageI7");
setFileVisibility($indIdWithSign, "indIdWithSign", "checkImageI8");
setFileVisibility($indlITR, "indlITR", "checkImageI9");
setFileVisibility($indCDofM, "indCDofM", "checkImageI10");
setFileVisibility($indProofofBill, "indProofofBill", "checkImageI11");
setFileVisibility($certOfCompnesation, "certOfCompnesation", "checkImageI12");
setFileVisibility($indauditedFinancial, "indauditedFinancial", "checkImageI13");
setFileVisibility($inbankStatements, "inbankStatements", "checkImageI14");
setFileVisibility($proofRemitance, "proofRemitance", "checkImageI15");
setFileVisibility($indBrgyClearance, "indBrgyClearance", "checkImageI16");
setFileVisibility($indCenomar, "indCenomar", "checkImageI17");
setFileVisibility($indCustomerWithCN, "indCustomerWithCN", "checkImageI18");
setFileVisibility($indSupplierWithCN, "indSupplierWithCN", "checkImageI19");

?>

    <div class="container py-5" style=" min-width: 100%; min-height:100%; font-size:120%; margin-top:1%;">
    <div class="col-4" style="text-align:left; margin-left:1%;;" > 
    <label class="text-dark "><b><?php echo "$fullname &nbsp; $birth &nbsp; $type";  ?></b></label>
    </div>
       <div class="row">
         <div class="col-12 ">
             <div class="bg-white rounded p-2">
               <ul class="nav nav-tabs nav-fill justify-content-center bg-light" style="border:solid 1px silver">
                <li class="nav-item ">
                  <a class="nav-link text-dark " data-bs-toggle="tab" id = "tab1" href="#microfinance"><b>Microfinance</b></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark " data-bs-toggle="tab" id = "tab2" href="#salary"><b>Salary</b></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark " data-bs-toggle="tab" id = "tab3" href="#corporation"><b>Real Estate Mortgage - Corporation</b></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark text-link" data-bs-toggle="tab" id = "tab4" href="#individual"><b>Real Estate Mortgage - Individual</b></a>
                </li>
              </ul>
           <div class="row">
             <div class="col-12">
               <div class="tab-content p-6 "  >

               
               
                <div id="microfinance" class="tab-pane" style="border: 1px solid #ccc; height:10%;">
                
                    <div class="row" >
                
                    
                    
                    

                    
                     <div class="col-lg-4 col-md-4 col-sm-10 my-4 " >
                    
                      <h1 class="text-secondary text-center" style=" border-bottom: 1px solid #ccc; min-height:7%; width:103%;"> Requirements</h1>
                    
                     
                      <div class="borrowers "  style=" border-right: 1px solid #ccc; min-height: 84%; width:100%;" >
                      <div class="col-3 " >
                      <div><label style="font-size:150%"><i>Borrower</i></label></div> 
                      </div> 

                      <form id="microfinance-form" action="loanMicroUploadData.php" method="POST" enctype="multipart/form-data">
                                <label class ="micro-labels" id="tab-borrower" for="custom" ><b> 3 PCS 1x1 ID PICTURE</b></label>
                                <input type="file" id="borrower_Id"  name="borrower_Id" /><img id="checkImageM1" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                <label class ="micro-labels" id="tab-borrower" for="custom" ><b>2 COPIES OF 2 VALID ID WITH 3 SIGNATURES</b></label>
                                <input type="file" id="borrower_Idsignature" name="borrower_Idsignature"  > <img id="checkImageM2" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                <label class ="micro-labels" id="tab-borrower" for="custom" ><b>LATEST BUSINESS PERMIT</b></label>   
                                <input type="file" id="borrower_Lbp" name="borrower_Lbp"   ><img id="checkImageM3" src="statusImage/check.png" alt="statusImage"> <br><br>  
                                <label class ="micro-labels" id="tab-borrower" for="custom"><b>LATEST PROOF OF BILLING (MERALCO)</b></label>
                                <input type="file" id="borrower_Lpb" name="borrower_Lpb"   > <img id="checkImageM4" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <div class="col-3 " >
                                <div><label style="font-size:150%"><i>Co-Borrower</i></label></div> 
                                </div> 
                                <label class="micro-labels" id="tab-borrower" for="custom" ><b> 2x2 ID PICTURE</b></label> 
                                <input type="file" id="coBorrwerIdPic" name="coBorrwerIdPic"  ><img id="checkImageM5" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                <label class="micro-labels" id="tab-borrower" for="custom"><b>1 COPY OF 2 VALID ID WITH 3 SIGNATURES</b></label>
                                <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  ><img id="checkImageM6" src="statusImage/check.png" alt="statusImage"> <br> <br>
                                <div class="col-3 " >
                                <div><label style="font-size:150%"><i>Co-Maker</i></label></div> 
                                </div> 
                                <label class ="micro-labels" id="tab-borrower" for="custom" ><b> 2x2 ID PICTURE</b></label> 
                                <input type="file" id="coMakerIdPic" name="coMakerIdPic"  ><img id="checkImageM7" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                <label class ="micro-labels" id="tab-borrower" for="custom"><b>1 COPY OF 2 VALID ID WITH 3 SIGNATURES</b></label>
                                <input type="file" id="coMakerIdWithSign" name="coMakerIdWithSign" > <img id="checkImageM8" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                <label class ="micro-labels" id="tab-borrower" for="custom"><b>LATEST BUSINESS PERMIT (IF WITH BUSINESS)</b></label>
                                <input type="file" id="coMakerLasterBP" name="coMakerLasterBP" ><img id="checkImageM9" src="statusImage/check.png" alt="statusImage"> <br><br>  
                                <label class ="micro-labels" id="tab-borrower" for="custom"><b>3 MONTHS OF PAYSLIP (IF EMPLOYED)</b></label>
                                <input type="file" id="coMakerPayslip" name="coMakerPayslip"> <img id="checkImageM10" src="statusImage/check.png" alt="statusImage"><br><br>
                                </form>     
                    </div>
                     
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-10 my-4">
                     <h1 class="text-secondary text-left mb-3" style=" border-bottom: 1px solid #ccc; min-height: 7%; width:103%"> APPROVAL</h1>
                     <div class="co-borrowers" style=" border-right: 1px solid #ccc; min-height: 95%; width:100%;"><br>

                     <!-- 3 PCS 1x1 ID PICTURE -->
                     <div class="form-group d-flex mb-4">
                     <select id="borrowerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" >
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM1" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="DESCPRITION" >
                      </div>

                      <!-- 2 COPIES OF 2 VALID ID WITH 3 SIGNATURES -->
                      <div class="form-group d-flex mb-3">
                      <select id="borrowerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM2"  class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>
                      

                      <!-- LATEST BUSINESS PERMIT -->
                      <div class="form-group d-flex mb-4">
                      <select id="latestPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM3" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>
                      

                      <!-- LATEST PROOF OF BILLING (MERALCO) -->
                      <div class="form-group d-flex mb-2  ">
                      <select  id="latestProofSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM4" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>
                      <br><br>

                      <!-- Co-Borrower 2x2 ID PICTURE -->
                      <div class="form-group d-flex mb-4">
                      <select id="coborrowerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM5" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>
                      

                      <!-- Co-Borrower 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                      <div class="form-group d-flex mb-1">
                      <select id="coborrowerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM6" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>
                      <br><br>

                      <!--Co-Maker 2x2 ID PICTURE -->
                      <div class="form-group d-flex mb-4">
                      <select id="comakerIdSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM7" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>
                      

                      <!-- Co-Maker 1 COPY OF 2 VALID ID WITH 3 SIGNATURES -->
                      <div class="form-group d-flex mb-4">
                      <select id="comakerValidSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM8" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>
                      

                      <!-- LATEST BUSINESS PERMIT (IF WITH BUSINESS) -->
                      <div class="form-group d-flex mb-3">
                      <select id="comakerPermitSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM9" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" >
                      </div>

                      <!-- 3 MONTHS OF PAYSLIP (IF EMPLOYED) -->
                      <div class="form-group d-flex">
                      <select id="comakerPayslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionM10" class="form-control w-75 p-1 fs-4 " placeholder="DESCPRITION" > 
                      </div>
                     




                      </div>
                      
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-10 my-4">
                     <h1 class="text-secondary text-left" style=" border-bottom: 1px solid #ccc; min-height: 7%;"> REPORTS</h1>
                      <div class="co-makers" style="width:100%;"><br><br><br><br><br><br><br><br><br><br>

                      <div class="py-3" >
                      <div><label style="font-size:150%"><i>Credit Investigation and Credit Investigation Report</i></label></div> 
                      <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                      </div> 


                      
                      <div class="py-3" >
                      <div><label style="font-size:150%"><i>Appraise the Property and Collateral Appraisal Report</i></label></div> 
                      <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                      </div> 



                        
                      </div> 
                     </div>
                       
                    </div>
                
                 </div>
                
                  <div id="salary" class="tab-pane "  style=" border: 1px solid #ccc;">
                  
                    <div class="row">
                     <div class="col-lg-12  col-md-6 col-sm-10 my-4" ><br><br>
                     
                      </div>
                     <div class="col-lg-4  col-md-6 col-sm-10 my-4">
                     <h1 class="text-secondary text-center" style=" border-bottom: 1px solid #ccc; min-height:7%; width:103%;"> Requirements</h1>
                       <!-- content here -->
                       
                       <div class="salary-tabs" style=" border-right: 1px solid #ccc; min-height: 92%; width:100%;">
                       <br><br>
                       <form id="salary-form" action="loanSalaryUploadData.php" method="POST" enctype="multipart/form-data">
                        
                                <label class ="form-labels" id="tab-label" for="custom"><b> CERTIFICATE OF EMPLOYMENT</b></label>  
                                <input type="file" class="certofEmployment" id="certofEmployment" name="certofEmployment"><img id="checkImageS1" src="statusImage/check.png" alt="statusImage"> <br> <br> 
                                <label class ="form-labels" id="tab-label" for="custom"><b>TWO (2) CO-MAKERS</b></label>
                                <input type="file" id="co_Makers" name="co_Makers"><img id="checkImageS2" src="statusImage/check.png" alt="statusImage"> <br> <br> 
                                <label class ="form-labels" id="tab-label" for="custom"><b>LATEST PAY-SLIP</b></label>
                                <input type="file" id="latestPayslip" name="latestPayslip"><img id="checkImageS3" src="statusImage/check.png" alt="statusImage"> <br><br>  
                                <label class ="form-labels" id="tab-label" for="custom"><b>T.I.N AND/OR ANY 2 VALID I.D</b></label>
                              <input type="file" id="tin" name="tin"><img id="checkImageS4" src="statusImage/check.png" alt="statusImage"> <br><br>

                        </form>
                                
                        </div>
                     </div>
                     <div class="col-lg-4  col-md-6 col-sm-10 my-4">
                     <h1 class="text-secondary text-left " style=" border-bottom: 1px solid #ccc; min-height: 7%; width:103%"> APPROVAL</h1>
                       
                       <div class="salary-tabs" style=" border-right: 1px solid #ccc; min-height: 92%; width:100%;">
                       <br><br>
                      <!-- CERTIFICATE OF EMPLOYMENT -->
                     <div class="form-group d-flex mb-4">
                     <select id="certEmploymentSelect" class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" >
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionS1" class="form-control w-75 p-1 fs-5 hidden-text-field"  placeholder="DESCPRITION" >
                      </div>
                      <!-- TWO (2) CO-MAKERS -->
                      <div class="form-group d-flex mb-4">
                      <select id= "coMakerSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionS2"  class="form-control w-75 p-1 fs-5" placeholder="DESCPRITION" >
                      </div>

                      <!-- LATEST PAY-SLIP -->
                      <div class="form-group d-flex">
                      <select id= "payslipSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionS3"  class="form-control w-75 p-1 fs-5" placeholder="DESCPRITION" >
                      </div>
                      <br>
                      <!-- T.I.N AND/OR ANY 2 VALID I.D -->
                      <div class="form-group d-flex">
                      <select id= "taxSelect" class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" id="descriptionS4"  class="form-control w-75 p-1 fs-5" placeholder="DESCPRITION" >
                      </div>
                        


                        
                                
                        </div>
                     </div>
                     <div class="col-lg-4  col-md-6 col-sm-10 my-4">
                     <h1 class="text-secondary text-left" style=" border-bottom: 1px solid #ccc; min-height: 7%;"> REPORTS</h1>
                       
                       <div class="salary-tabs">
                       <br><br>
                       
                      <div class="py-3" >
                      <div><label style="font-size:150%"><i>Credit Investigation and Credit Investigation Report</i></label></div> 
                      <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                      </div> 


                      
                      <div class="py-3" >
                      <div><label style="font-size:150%"><i>Appraise the Property and Collateral Appraisal Report</i></label></div> 
                      <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                      </div>


                       
                                
                        </div>
                     </div>
                    
                   
                    </div>
                 </div>
                
                  <div id="corporation" class="tab-pane  " style=" border: 1px solid #ccc;">
                  <form id="corporation-form" action="loanCorporationUploadData.php" method="POST" enctype="multipart/form-data">
                  
                    <div class="row">
                    <div class="col-12 py-3" ><br><br>
                    <h1 class="text-secondary text-center" style=" border-bottom: 1px solid #ccc; min-height: 85%;">Requirements</h1>
                     </div>
                     
                     <div class="col-lg-4 col-md-4 col-sm-10 my-4">
                     
                       <div class="tab-corporation " style=" border-right: 1px solid #ccc; min-height: 101.5%;">
                       
                       <br> <br> 
                                <label class ="corporation-label " id="tab-corporation" for="custom" ><b> COMPANY PROFILE</b></label>
                                <input type="file" id="companyProfile" name="companyProfile" ><img id="checkImageC1" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                 <label class ="corporation-label" id="tab-corporation" for="custom"  ><b>PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS </b></label>
                                <input type="file" id="secRegistration" name="secRegistration" > <img id="checkImageC2" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                 <label class ="corporation-label" id="tab-corporation" for="custom"><b>PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GSIS)</b></label>    
                                <input type="file" id="latestGIS" name="latestGIS" > <img id="checkImageC3" src="statusImage/check.png" alt="statusImage"><br><br>  
                                 <label class ="corporation-label" id="tab-corporation" for="custom"><b>ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE </b></label>       
                                <input type="file" id="copyBRS" name="copyBRS" > <img id="checkImageC4" src="statusImage/check.png" alt="statusImage"> <br><br>
                                 <label class ="corporation-label" id="tab-corporation" for="custom"><b>PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY (WITH 3 SIGNATURES) AND TAX IDENTIFICATION NUMBER (TIN)  </b></label>       
                                <input type="file" id="copyidCST" name="copyidCST" ><img id="checkImageC5" src="statusImage/check.png" alt="statusImage"> <br><br>
                                 <label class ="corporation-label" id="tab-corporation" for="custom"><b>COPY OF UPDATED BUSINESS PERMIT  </b></label>
                                <input type="file" id="copyUpdatedBP" name="copyUpdatedBP"><img id="checkImageC6" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY)  </b></label>
                                <input type="file" id="transferCertTitle" name="transferCertTitle" ><img id="checkImageC7" src="statusImage/check.png" alt="statusImage"> <br><br>
                                 <label class ="corporation-label" id="tab-corporation" for="custom"><b>TAX DECLARTION (LOT-CERTIFIED TRUE COPY)  </b></label>
                                <input type="file" id="taxDeclaration" name="taxDeclaration" ><img id="checkImageC8" src="statusImage/check.png" alt="statusImage"><br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)  </b></label>
                                <input type="file" id="taxDeclartionICTC" name="taxDeclartionICTC"><img id="checkImageC9" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>REAL ESTATE RECEIPT (AMILYAR)  </b></label>
                                <input type="file" id="realStateReceipt" name="realStateReceipt"> <img id="checkImageC10" src="statusImage/check.png" alt="statusImage"><br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>REAL ESTATE TAX CLEARANCE </b></label>
                                <input type="file" id="realEstateTaxClearance" name="realEstateTaxClearance"><img id="checkImageC11" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE)  </b></label>    
                                <input type="file" id="cdOfMorgage" name="cdOfMorgage"><img id="checkImageC12" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="title-label" id="title-label" for="custom"><b><u>FINANCIAL STATEMENT/ PROOF OF INCOME </u></b></label><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>&#x2022; PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT </b></label>
                                <input type="file" id="auditedFinancial" name="auditedFinancial"><img id="checkImageC13" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>&#x2022; PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT </b></label>
                                <input type="file" id="inhouseFinancial" name="inhouseFinancial"><img id="checkImageC14" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>&#x2022; PHOTOCOPY OF AT LEAST 6 MONTHS LATEST BANK STATEMENT </b></label>
                                <input type="file" id="latestBank" name="latestBank"><img id="checkImageC15" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="title-label" id="title-label" for="custom"><b><u>PHOTOCOPY OF SALES & PURCHASES RECEIPTS OR LOGBOOK (IF APPLICABLE)</u> </b></label><br>            
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>&#x2022; 5 CUSTOMERS WITH CONTACT NUMBER </b></label>
                                <input type="file" id="customerContact" name="customerContact"><img id="checkImageC16" src="statusImage/check.png" alt="statusImage"> <br><br> 
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>&#x2022; 5 SUPPLIERS WITH CONTACT NUMBER </b></label>
                                <input type="file" id="supplierContact" name="supplierContact"><img id="checkImageC17" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>2X2 ID PICTURE (2 PCS.) </b></label>
                                <input type="file" id="idPicture" name="idPicture"><img id="checkImageC18" src="statusImage/check.png" alt="statusImage"> <br><br> 
                                <label class ="corporation-label" id="tab-corporation" for="custom"><b>PROOF OF BILLING (IF APPLICABLE) </b></label>
                                <input type="file" id="proofBilling" name="proofBilling"><img id="checkImageC19" src="statusImage/check.png" alt="statusImage"> <br><br> 
                                
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-10 my-4">
                     <div class="tab-corp" style=" border-right: 1px solid #ccc; min-height: 101.5%;">
                    <br><br>
                    <!-- COMPANY PROFILE -->
                     <div class="form-group d-flex mb-3 " >
                     <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "companyProfileSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="DESCPRITION" id="descriptionC1">
                      </div>
                      <!-- PHOTOCOPY OF SEC REGISTRATION, ARTICILES OF INCORPORATION AND BY-LAWS  -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "secRegistrationSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC2">
                      </div><br>
                     
                      <!-- PHOTOCOPY OF LATEST GENERAL INFORMATION SHEET (GSIS) -->
                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "latestGeneralSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC3">
                      </div>
                      <br>
                      <!-- ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE -->
                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "boardResolutionSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC4">
                      </div><br>
                      
                      <!-- PHOTOCOPY OF ATLEAST 2 GOVERNMENT ID'S OF CORPORATE SECRETARY (WITH 3 SIGNATURES) AND TAX IDENTIFICATION NUMBER (TIN) -->
                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "corporateSecretarySelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC5">
                      </div><br><br><br>

                      <!-- COPY OF UPDATED BUSINESS PERMIT  -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "updatePermitSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC6">
                      </div>
                      
                      <!-- TRANSFER CERTIFICATE TITLE (ORIGINAL & CERTIFIED TRUE COPY) -->
                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "transferCertSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC7">
                      </div><br>

                      <!-- TAX DECLARTION (LOT-CERTIFIED TRUE COPY) -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "taxLotSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC8">
                      </div>

                      <!-- TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)  -->
                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "taxImprovementSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC9" >
                      </div><br>

                      <!-- REAL ESTATE RECEIPT (AMILYAR) -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "estateReceiptSelect">
                      <option selected><b>Options</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="DESCPRITION" id="descriptionC10"> 
                      </div> 

                      <!-- REAL ESTATE TAX CLEARANCE -->
                      <div class="form-group d-flex mb-4">
                     <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "estateTaxClearanceSelect" >
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="DESCPRITION" id="descriptionC11" >
                      </div>

                      <!-- CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE)  -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "dischargeMorageSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC12">
                      </div>
                      <br><br>
                      <!--  PHOTOCOPY OF LATEST 3 YEARS AUDITED FINANCIAL STATEMENT  -->
                      <div class="form-group d-flex mb-1">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "auditedFinancialSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC13">
                      </div>
                      <br>
                      <!-- PHOTOCOPY OF LATEST 3 YEARS IN-HOUSE FINANCIAL STATEMENT  -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inhouseFinancialSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC14">
                      </div>
                      <br>
                      <!-- PHOTOCOPY OF AT LEAST 6 MONTHS LATEST BANK STATEMENT -->

                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "latestBankSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC15">
                      </div>
                      <br><br>
                      <!-- 5 CUSTOMERS WITH CONTACT NUMBER -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "corpCustomerSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC16">
                      </div>
                      
                    <!-- 5 SUPPLIERS WITH CONTACT NUMBER  -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "corpSupplierSelect" >
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC17">
                      </div>
                      <br>
                      <!-- 2X2 ID PICTURE (2 PCS.)  -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "corpIdpicSelect" >
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC18">
                      </div>
                      
                      <!-- PROOF OF BILLING (IF APPLICABLE)  -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "proofBillingSelect" >
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionC19">
                      </div>
                      <br>
</div>

                   
                    </div>
                 <div class="col-lg-4 col-md-4 col-sm-10 my-4">
                 <br> <br> <br><br><br>
                     
                       
                       
                     <div class="py-3" >
                     <div><label style="font-size:150%"><i>Credit Investigation and Credit Investigation Report</i></label></div> 
                     <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                     </div> <br><br><br><br><br><br>


                     
                     <div class="py-3" >
                     <div><label style="font-size:150%"><i>Appraise the Property and Collateral Appraisal Report</i></label></div> 
                     <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                      </div>
                 </div>
             

               </div>
               </form>
              </div>
              
               <div id="individual" class="tab-pane "  style=" border: 1px solid #ccc;">
               <form id="individual-form" action="loanIndividualUploadData.php" method="POST" enctype="multipart/form-data">
               <div class="row">
                <div class="col-12 py-3"><br>
               
                </div>
                    
                      
                     <div class="col-lg-4 col-md-6 col-sm-10 my-4">
                     <h1 class="text-secondary text-center" style=" border-bottom: 1px solid #ccc; width:103%; ">Requirements</h1>
                    
                     <div class="tab-individual" style=" border-right: 1px solid #ccc; min-height: 98%;">
                     <br> <br> 
                     
                                <label class ="individual-labels" id="tab-label" for="custom" ><b>TRANSFER CERTIFICATE OF TITLE (ORIGINIAL & CERTIFIED TRUE COPY)</b></label>
                                <input type="file" id="indTransferCoT" name="indTransferCoT"><img id="checkImageI1" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                <label class ="individual-labels" id="tab-label" for="custom"  ><b>TAX DECLARTION (LOT-CERTIFIED TRUE COPY)</b></label> 
                                <input type="file" id="indTaxDeclarationLCTC" name="indTaxDeclarationLCTC"> <img id="checkImageI2" src="statusImage/check.png" alt="statusImage"><br> <br> 
                                <label class ="individual-labels" id="tab-label" for="custom"><b>TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)</b></label>
                                <input type="file" id="indTaxDeclarationICTC" name="indTaxDeclarationICTC"> <img id="checkImageI3" src="statusImage/check.png" alt="statusImage"><br><br> 
                                <label class ="individual-labels" id="tab-label" for="custom"><b>REAL ESTATE TAX RECEIPT (AMILYAR) </b></label>
                                <input type="file" id="indRealEstateTR" name="indRealEstateTR"> <img id="checkImageI4" src="statusImage/check.png" alt="statusImage"><br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"style=><b>REAL ESTATE CLEARANCE  </b></label>
                                <input type="file" id="indRealEstClearance" name="indRealEstClearance"><img id="checkImageI5" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b>2X2 ID (2 Pcs.) </b></label>
                                <input type="file" id="indIdPicture" name="indIdPicture"> <img id="checkImageI6" src="statusImage/check.png" alt="statusImage"><br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b>TAX IDENTIFICATION NUMBER (TIN)  </b></label>
                                <input type="file" id="indTaxIdNumber" name="indTaxIdNumber"><img id="checkImageI7" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b>2 VALID ID'S WITH SIGNATURE  </b></label>
                                <input type="file" id="indIdWithSign" name="indIdWithSign"><img id="checkImageI8" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b>INCOME TAX RETURN (IF APPLICABLE)  </b></label>
                                <input type="file" id="indlITR" name="indlITR"><img id="checkImageI9" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b>CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE) </b></label>
                                <input type="file" id="indCDofM" name="indCDofM"><img id="checkImageI10" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b>PROOF OF BILLING (MERALCO, INTERNET BILL, WATER BILL)  </b></label>
                                <input type="file" id="indProofofBill" name="indProofofBill"> <img id="checkImageI11" src="statusImage/check.png" alt="statusImage"><br><br>
                                <label class ="title-label" id="tab-label" for="custom"><b><u> FINANCIAL STATEMENT/ PROOF OF INCOME </u></b></label><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b> <i>&#x2022; CERTIFICATE OF EMPLOYMENT & COMPENSATION WITH 6 MONTHS 'PAY SLIP. </i></b></label>
                                <input type="file" id="certOfCompnesation" name="certOfCompnesation"><img id="checkImageI12" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b><i> &#x2022; LATEST ITR/BIR NO. 2316, AUDITED FINANCIAL STATEMENTS AND  OFFICIAL RECEIPT OF TAX PAYMENT </i></b></label> 
                                <input type="file" id="indauditedFinancial" name="indauditedFinancial"><img id="checkImageI13" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b><i>&#x2022; BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS</i></b></label> 
                                <input type="file" id="inbankStatements" name="inbankStatements"> <img id="checkImageI14" src="statusImage/check.png" alt="statusImage"><br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b><i>&#x2022; 6 MONTHS PROOF OF REMITANCE (IF ANY) </i></b></label>
                                <input type="file" id="proofRemitance" name="proofRemitance"><img id="checkImageI15" src="statusImage/check.png" alt="statusImage"> <br><br>                        
                                <label class ="individual-labels" id="tab-label" for="custom"><b> BARANGAY CLEARANCE FOR LOAN PURPOSE </b></label>
                                <input type="file" id="indBrgyClearance" name="indBrgyClearance"><img id="checkImageI16" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b> MARRIAGE CONTRACT (IF MARRIED) * CENOMAR (IF SINGLE) </b></label> 
                                <input type="file" id="indCenomar" name="indCenomar"><img id="checkImageI17" src="statusImage/check.png" alt="statusImage"> <br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b> 5 CUSTOMERS WITH CONTACT NUMBER</b></label> 
                                <input type="file" id="indCustomerWithCN" name="indCustomerWithCN"> <img id="checkImageI18" src="statusImage/check.png" alt="statusImage"><br><br>
                                <label class ="individual-labels" id="tab-label" for="custom"><b>5 SUPPLIERS WITH CONTACT NUMBER</b></label>
                                <input type="file" id="indSupplierWithCN" name="indSupplierWithCN"><img id="checkImageI19" src="statusImage/check.png" alt="statusImage"> <br><br>
                            
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 col-sm-10 my-4 ">
                     <h1 class="text-secondary text-center " style=" border-bottom: 1px solid #ccc; width:103%; ">APPROVAL</h1>
                     <div class="tab-individual" style=" border-right: 1px solid #ccc; min-height: 98%;">
                    <br><br>

                      <!-- TRANSFER CERTIFICATE OF TITLE (ORIGINIAL & CERTIFIED TRUE COPY)  -->
                     <div class="form-group d-flex mb-2 " >
                     <select  class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "intransferCertSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="DESCPRITION" id="descriptionI1" >
                      </div><br>

                      <!-- TAX DECLARTION (LOT-CERTIFIED TRUE COPY)  -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inTaxLotSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI2">
                      </div>

                      <!-- TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)   -->
                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "inTaxImproveSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI3">
                      </div>
                      <br>

                      <!-- REAL ESTATE TAX RECEIPT (AMILYAR)   -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "inTaxReceiptSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI4">
                      </div>
                      
                      <!-- REAL ESTATE CLEARANCE   -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "inEstateClearanceSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI5">
                      </div>
                      
                      <!-- 2X2 ID (2 Pcs.)   -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example"id = "inIdSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI6">
                      </div>
                      
                      <!-- TAX IDENTIFICATION NUMBER (TIN)  -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inTinSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI7">
                      </div>
                      
                      <!-- 2 VALID ID'S WITH SIGNATURE   -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inValidIdSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI8">
                      </div>
                      
                      <!-- INCOME TAX RETURN (IF APPLICABLE)   -->
                      <div class="form-group d-flex mb-4">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inTaxReturnSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI9" >
                      </div>
                      
                      <!-- CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE)  -->
                      <div class="form-group d-flex mb-2">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inDischargeMorgageSelect">
                      <option selected><b>Options</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 " placeholder="DESCPRITION" id="descriptionI10"> 
                      </div> <br>

                      <!-- PROOF OF BILLING (MERALCO, INTERNET BILL, WATER BILL)   -->
                      <div class="form-group d-flex mb-3">
                     <select class="form-select w-50 p-1 fs-5 fw-bold " aria-label="Default select example" id = "inProofBillingSelect" >
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4 hidden-text-field"  placeholder="DESCPRITION" id="descriptionI11" >
                      </div><br><br>

                      <!-- CERTIFICATE OF EMPLOYMENT & COMPENSATION WITH 6 MONTHS 'PAY SLIP.  -->
                      <div class="form-group d-flex mb-1">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inCompensationSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI12">
                      </div>
                      <br>

                      <!-- LATEST ITR/BIR NO. 2316, AUDITED FINANCIAL STATEMENTS AND OFFICIAL RECEIPT OF TAX PAYMENT   -->
                      <div class="form-group d-flex mb-3">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inAuditedStatementSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI13">
                      </div>
                      <br><br>

                      <!-- BANK STATEMENTS OR PASSBOOK FOR THE LAST 6 MONTHS  -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inPassbookSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI14">
                      </div>
                      <br>

                      <!-- 6 MONTHS PROOF OF REMITANCE (IF ANY)  -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inProofRemitance">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI15">
                      </div>
                      <br>

                      <!-- BARANGAY CLEARANCE FOR LOAN PURPOSE   -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inLoanPurposeSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI16">
                      </div>
                      <br>
                      
                      <!-- MARRIAGE CONTRACT (IF MARRIED) * CENOMAR (IF SINGLE)   -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inMarriageSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI17">
                      </div>
                      <br>

                      <!-- 5 CUSTOMERS WITH CONTACT NUMBER   -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inCustomerNumberSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI18">
                      </div>
                      <br>

                      <!-- 5 SUPPLIERS WITH CONTACT NUMBER   -->
                      <div class="form-group d-flex">
                      <select class="form-select w-50 p-1 fs-5 fw-bold" aria-label="Default select example" id = "inSupplierNumberSelect">
                      <option selected><b>Option</option>
                      <option value="1">VERIFIED</option>
                      <option value="2"><b>INCOMPLETE</b></option>
                      </select>&nbsp;&nbsp;<input type="text" class="form-control w-75 p-1 fs-4" placeholder="DESCPRITION" id="descriptionI19">
                      </div>
                      <br>
                    </div>
                        
                     </div>
                     <div class="col-lg-4 col-md-6 col-sm-10 my-4">
                     <h1 class="text-secondary text-center" style=" border-bottom: 1px solid #ccc; ">REPORTS</h1>
                     <br> <br> <br><br><br>
                     
                       
                       
                      <div class="py-3" >
                      <div><label style="font-size:150%"><i>Credit Investigation and Credit Investigation Report</i></label></div> 
                      <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                      </div> <br><br><br><br><br><br>


                      
                      <div class="py-3" >
                      <div><label style="font-size:150%"><i>Appraise the Property and Collateral Appraisal Report</i></label></div> 
                      <input type="file" id="coBorrowerIdWithSign" name="coBorrowerIdWithSign"  >
                     


                       
                                
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
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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

// Text field show if you click Incomplete

// Microfinance Text field
handleSelectChange('borrowerIdSelect', 'descriptionM1');
handleSelectChange('borrowerValidSelect', 'descriptionM2');
handleSelectChange('latestPermitSelect', 'descriptionM3');
handleSelectChange('latestProofSelect', 'descriptionM4');
handleSelectChange('coborrowerIdSelect', 'descriptionM5');
handleSelectChange('coborrowerValidSelect', 'descriptionM6');
handleSelectChange('comakerIdSelect', 'descriptionM7');
handleSelectChange('comakerValidSelect', 'descriptionM8');
handleSelectChange('comakerPermitSelect', 'descriptionM9');
handleSelectChange('comakerPayslipSelect', 'descriptionM10');

// Salary Text field
handleSelectChange('certEmploymentSelect', 'descriptionS1');
handleSelectChange('coMakerSelect', 'descriptionS2');
handleSelectChange('payslipSelect', 'descriptionS3');
handleSelectChange('taxSelect', 'descriptionS4');

// Corporation Text field
handleSelectChange('companyProfileSelect', 'descriptionC1');
handleSelectChange('secRegistrationSelect', 'descriptionC2');
handleSelectChange('latestGeneralSelect', 'descriptionC3');
handleSelectChange('boardResolutionSelect', 'descriptionC4');
handleSelectChange('corporateSecretarySelect', 'descriptionC5');
handleSelectChange('updatePermitSelect', 'descriptionC6');
handleSelectChange('transferCertSelect', 'descriptionC7');
handleSelectChange('taxLotSelect', 'descriptionC8');
handleSelectChange('taxImprovementSelect', 'descriptionC9');
handleSelectChange('estateReceiptSelect', 'descriptionC10');
handleSelectChange('estateTaxClearanceSelect', 'descriptionC11');
handleSelectChange('dischargeMorageSelect', 'descriptionC12');
handleSelectChange('auditedFinancialSelect', 'descriptionC13');
handleSelectChange('inhouseFinancialSelect', 'descriptionC14');
handleSelectChange('latestBankSelect', 'descriptionC15');
handleSelectChange('corpCustomerSelect', 'descriptionC16');
handleSelectChange('corpSupplierSelect', 'descriptionC17');
handleSelectChange('corpIdpicSelect', 'descriptionC18');
handleSelectChange('proofBillingSelect', 'descriptionC19');

// individual Text field
handleSelectChange('intransferCertSelect', 'descriptionI1');
handleSelectChange('inTaxLotSelect', 'descriptionI2');
handleSelectChange('inTaxImproveSelect', 'descriptionI3');
handleSelectChange('inTaxReceiptSelect', 'descriptionI4');
handleSelectChange('inEstateClearanceSelect', 'descriptionI5');
handleSelectChange('inIdSelect', 'descriptionI6');
handleSelectChange('inTinSelect', 'descriptionI7');
handleSelectChange('inValidIdSelect', 'descriptionI8');
handleSelectChange('inTaxReturnSelect', 'descriptionI9');
handleSelectChange('inDischargeMorgageSelect', 'descriptionI10');
handleSelectChange('inProofBillingSelect', 'descriptionI11');
handleSelectChange('inCompensationSelect', 'descriptionI12');
handleSelectChange('inAuditedStatementSelect', 'descriptionI13');
handleSelectChange('inPassbookSelect', 'descriptionI14');
handleSelectChange('inProofRemitance', 'descriptionI15');
handleSelectChange('inLoanPurposeSelect', 'descriptionI16');
handleSelectChange('inMarriageSelect', 'descriptionI17');
handleSelectChange('inCustomerNumberSelect', 'descriptionI18');
handleSelectChange('inSupplierNumberSelect', 'descriptionI19');




</script>


<!-- Microfinance -->
<script>
var microform = document.getElementById("microfinance-form");
var microId = "<?php echo $id; ?>";

//Function to handle file upload separately
function uploadFileM() {
  var microformData = new FormData(microform);
  microformData.append('microId',microId);
  // Rest of the code...

  $.ajax({
    url: 'loanMicroUploadData.php', // Update the URL to match your server-side script
    type: 'POST',
    data: microformData,
    processData: false,
    contentType: false,
    success: function(response) {
      updateFileStatus('borrower_Id', 'checkImageM1');
      updateFileStatus('borrower_Idsignature', 'checkImageM2');
      updateFileStatus('borrower_Lbp', 'checkImageM3');
      updateFileStatus('borrower_Lpb', 'checkImageM4');
      
      updateFileStatus('coBorrwerIdPic', 'checkImageM5');
      updateFileStatus('coBorrowerIdWithSign', 'checkImageM6');
      updateFileStatus('coMakerIdPic', 'checkImageM7');
      updateFileStatus('coMakerIdWithSign', 'checkImageM8');
      updateFileStatus('coMakerLasterBP', 'checkImageM9');
      updateFileStatus('coMakerPayslip', 'checkImageM10');
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

<!-- Salary-FORM -->
<script>

var salaryform = document.getElementById("salary-form");
var salaryId = "<?php echo $id; ?>";

// Function to handle file upload separately
function uploadFileS() {
  var salaryformData = new FormData(salaryform);
  salaryformData.append('salaryId',salaryId);
  // Rest of the code...

  $.ajax({
    url: 'loanSalaryUploadData.php', // Update the URL to match your server-side script
    type: 'POST',
    data: salaryformData,
    processData: false,
    contentType: false,
    success: function(response) {
      updateFileStatus('certofEmployment', 'checkImageS1');
      updateFileStatus('co_Makers', 'checkImageS2');
      updateFileStatus('latestPayslip', 'checkImageS3');
      updateFileStatus('tin', 'checkImageS4');
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



<!-- Corporation Form -->
<script>
var corpForm = document.getElementById("corporation-form");
var corpId = "<?php echo $id; ?>";

// Function to handle file upload separately
function uploadFileC() {
  var corpformData = new FormData(corpForm);
  corpformData.append('corpId',corpId);
  // Rest of the code...

  $.ajax({
    url: 'loanCorporationUploadData.php', // Update the URL to match your server-side script
    type: 'POST',
    data: corpformData,
    processData: false,
    contentType: false,
    success: function(response) {
      updateFileStatus('companyProfile', 'checkImageC1');
      updateFileStatus('secRegistration', 'checkImageC2');
      updateFileStatus('latestGIS', 'checkImageC3');
      updateFileStatus('copyBRS', 'checkImageC4');
      
      updateFileStatus('copyidCST', 'checkImageC5');
      updateFileStatus('copyUpdatedBP', 'checkImageC6');
      updateFileStatus('transferCertTitle', 'checkImageC7');
      updateFileStatus('taxDeclaration', 'checkImageC8');
      updateFileStatus('taxDeclartionICTC', 'checkImageC9');
      updateFileStatus('realStateReceipt', 'checkImageC10');

      updateFileStatus('realEstateTaxClearance', 'checkImageC11');
      updateFileStatus('cdOfMorgage', 'checkImageC12');
      updateFileStatus('auditedFinancial', 'checkImageC13');
      updateFileStatus('inhouseFinancial', 'checkImageC14');
      updateFileStatus('latestBank', 'checkImageC15');
      updateFileStatus('customerContact', 'checkImageC16');
      updateFileStatus('supplierContact', 'checkImageC17');
      updateFileStatus('idPicture', 'checkImageC18');
      updateFileStatus('proofBilling', 'checkImageC19');
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
 
 <!-- individual Form -->
 <script>

var indivForm = document.getElementById("individual-form");
var indivId = "<?php echo $id; ?>";

// Function to handle file upload separately
function uploadFileI() {
  var indivformData = new FormData(indivForm);
  indivformData.append('indivId',indivId);
  // Rest of the code...

  $.ajax({
    url: 'loanIndividualUploadData.php', // Update the URL to match your server-side script
    type: 'POST',
    data: indivformData,
    processData: false,
    contentType: false,
    
    success: function(response) {
      updateFileStatus('indTransferCoT', 'checkImageI1');
      updateFileStatus('indTaxDeclarationLCTC', 'checkImageI2');
      updateFileStatus('indTaxDeclarationICTC', 'checkImageI3');
      updateFileStatus('indRealEstateTR', 'checkImageI4');
      
      updateFileStatus('indRealEstClearance', 'checkImageI5');
      updateFileStatus('indIdPicture', 'checkImageI6');
      updateFileStatus('indTaxIdNumber', 'checkImageI7');
      updateFileStatus('indIdWithSign', 'checkImageI8');
      updateFileStatus('indlITR', 'checkImageI9');
      updateFileStatus('indCDofM', 'checkImageI10');

      updateFileStatus('indProofofBill', 'checkImageI11');
      updateFileStatus('certOfCompnesation', 'checkImageI12');
      updateFileStatus('indauditedFinancial', 'checkImageI13');
      updateFileStatus('inbankStatements', 'checkImageI14');
      updateFileStatus('proofRemitance', 'checkImageI15');
      updateFileStatus('indBrgyClearance', 'checkImageI16');
      updateFileStatus('indCenomar', 'checkImageI17');
      updateFileStatus('indCustomerWithCN', 'checkImageI18');
      updateFileStatus('indSupplierWithCN', 'checkImageI19');



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





