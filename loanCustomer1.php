<?php
include('connection.php');
require 'auth_check.php';

?>

<!DOCTYPE html>
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
  <meta name="description" content="A inventory web app for OUR Bank.">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Loan Form</title>

  <!-- bootstrap -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="./css/bootstrap521.min.css" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css">
  <style>
    /* #createNew {
      position: relative;
      float: right;
      margin-right: 500px;
    } */
  </style>
</head>
<body id="body">

<section class="forms">
<div class="container-fluid">
    <div class="loans-form shadow-lg p-1 mb-4">
        <div class="pads">
            <div class="row">
                <!-- <div class="col"><img class="leave-image" src="./logo/logo.png" alt="logo"></div> -->
                    <div class="col-md-12"><br>
                        <div class="section-heading">
                            <h3 style="margin-top: -0.5%;">Look Up Customer</h3> 
                        </div>
                        <form class="form-inline" id="loanForm" action="" method="post" enctype="multipart/data-form">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="customerName" class="col-form-label">Name</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="customerName" id="customerName" class="form-control" aria-describedby="passwordHelpInline" onkeyup="stoppedTyping()">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success btn-md" name="Search" id="Search" onclick="show()" disabled>Search</button>
                                <button data-bs-toggle="modal" class="btn btn-primary btn-md" name="createNew" id="createNew" data-bs-target="#createNewCustomerFolder" disabled>Create New Customer</button>
                                <!-- <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#createNewCustomerFolder" name="createNew" id="createNew" class="btn btn-primary btn-md" disabled>Create New Customer</a> -->
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="lalagyan">
            <ul class="nav nav-pills " role="tablist" style= "width:1500px; top: 20px; left:400px; position: relative;">
  
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#micro">MICROFINANCE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#salary">SALARY LOAN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#rem">REAL ESTATE MORTAGE-CORPORATION</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#individual">REAL ESTATE MORTAGE-INDIVIDUAL</a>
              </li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content" style="left:540px; position: absolute;">
            <div id="micro" class="container tab-pane active" style="float:center; top: 10px; width: 900px; position: relative;">
              <h3>Requirements</h3>
            <div><label for="" style="font-size: 125%; position: relative; margin-right: 430px;"><i>* Borrower</i></label></div>

            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b> 3 PCS 1x1 ID PICTURE</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
              <input type="file" id="tab-label"><br> <br> 
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>2 COPY OF 2 VALID ID WITH 3 SIGNATURES</b></label>&nbsp;&nbsp;
              <input type="file" id="tab-label"> <br> <br> 
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>LATEST BUSINESS PERMIT</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br><br>  
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>LATEST PROOF OF BILLING</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <input type="file" id="tab-label"> <br><br>
            <div><label for="" style="font-size: 125%; position: relative; margin-right: 430px;"><i>* Co Borrower</i></label></div>
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b> 2x2 ID PICTURE</b></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
              <input type="file" id="tab-label"><br> <br> 
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>1 COPY OF 2 VALID ID WITH 3 SIGNATURES</b></label>&nbsp;&nbsp;&nbsp;
              <input type="file" id="tab-label"> <br> <br>
            <div><label for="" style="font-size: 125%; position: relative; margin-right: 430px;"><i>* Co Maker</i></label></div>
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b> 2x2 ID PICTURE</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
              <input type="file" id="tab-label"><br> <br> 
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>1 COPY OF 2 VALID ID WITH 3 SIGNATURES</b></label>&nbsp;&nbsp;
              <input type="file" id="tab-label"> <br> <br> 
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>LATEST BUSINESS PERMIT</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br><br>  
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>3 MONTHS OF PAYSLIP (IF EMPLOYED)</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <input type="file" id="tab-label"> <br><br>
              <button type="button" class="btn btn-primary" style="position:relative; left:200px; ">SUBMIT</button>

            </div>
            <div id="salary" class="container tab-pane fade" style="float:center; top: 10px; width: 900px; position: relative"><br>
            <h3>Requirements</h3>
            <div><label for="" style="font-size: 125%; position: relative; margin-right: 430px;"><i></i></label></div>
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b> CERTIFICATE OF EMPLOYMENT</b></label>  &nbsp;&nbsp;&nbsp;&nbsp;            
              <input type="file" id="tab-label"><br> <br> 
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>TWO (2) CO-MAKERS</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br> <br> 
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>LATEST PAY-SLIP</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br><br>  
            &nbsp; <label class ="form-label" id="tab-label" for="custom"><b>T.I.N AND/OR ANY 2 VALID I.D</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              <button type="button" class="btn btn-primary" style="position:relative; left:160px; ">SUBMIT</button>
            </div>
            <div id="rem" class="container tab-pane fade"   style="float:center; top: 10px; width: 900px; position: relative" ><br>
            <h3>Requirements</h3>
            <div><label for="" style="font-size: 70%; position: relative; margin-right: 430px;"></label></div>
            <div class="">
              &nbsp; <label class ="form-label" id="tab-label" for="custom" style="font-size: 90%;"><b> COMPANY PROFILE</b></label>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            
              <input type="file" id="tab-label"><br> <br> 
              &nbsp; <label class ="form-label" id="tab-label" for="custom" style="font-size: 90%;" ><b>COPY OF SEC REGISTRATION </b></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br> <br> 
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>COPY OF LATEST GENERAL INFORMATION SHEET</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br><br>  
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>COPY OF ATLEAST 2 GOVERMENT ID'S OF CORPORATE SECRETARY AND TIN  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>COPY OF UPDATED BUSINESS PERMIT  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>TRANSFER CERTIFICATE TITLE (ORIGINAL)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>TAX DECLARTION (LOT-CERTIFIED TRUE COPY)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
            </div>
            <div class="">
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>REAL ESTATE RECEIPT (AMILYAR)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>REAL ESTATE TAX CLEARANCE </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>FINANCIAL STATEMENT/ PROOF OF INCOME </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>PHOTOCOPY OF SALES & PURCHASES RECEIPTS </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>2X2 ID PICTURE </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>PROOF OF BILLING</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             
              <input type="file" id="tab-label"> <br><br>
              <button type="button" class="btn btn-primary" style="position:relative; left:300px; ">SUBMIT</button>
            </div>
            </div>
            <div id="individual" class="container tab-pane fade" style="float:center; top: 10px; width: 900px; position: relative" ><br>
            <h3>Requirements</h3>
            <div><label for="" style="font-size: 70%; position: relative; margin-right: 430px;"><i></i></label></div>
              &nbsp; <label class ="form-label" id="tab-label" for="custom" style="font-size: 90%;"><b>TRANSFER CERTIFICATE OF TITLE (ORIGINIAL)</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            
              <input type="file" id="tab-label"><br> <br> 
                &nbsp; <label class ="form-label" id="tab-label" for="custom" style="font-size: 90%;" ><b>TAX DECLARTION (LOT-CERTIFIED TRUE COPY)</b></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br> <br> 
                &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br><br>  
                &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>ORIGINAL COPY OF BOARD RESOULUTION AND SECRETARY'S CERTIFICATE </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>COPY OF ATLEAST 2 GOVERMENT ID'S OF CORPORATE SECRETARY AND TIN  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>COPY OF UPDATED BUSINESS PERMIT  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>TRANSFER CERTIFICATE TITLE (ORIGINAL)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>TAX DECLARTION (LOT-CERTIFIED TRUE COPY)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>TAX DECLARTION (IMPROVEMENT-CERTIFIED TRUE COPY)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>REAL ESTATE RECEIPT (AMILYAR)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>REAL ESTATE TAX CLEARANCE </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>CANCELLATION AND DISCHARGE OF MORGAGE (IF APPLICABLE)  </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>FINANCIAL STATEMENT/ PROOF OF INCOME </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>PHOTOCOPY OF SALES & PURCHASES RECEIPTS </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>2X2 ID PICTURE </b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
              <input type="file" id="tab-label"> <br><br>
              &nbsp; <label class ="form-label" id="tab-label" for="custom"style="font-size: 90%;"><b>PROOF OF BILLING</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             
              <input type="file" id="tab-label"> <br><br>
              <button type="button" class="btn btn-primary" style="position:relative; left:300px; ">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
</section>



<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script>
    if(typeof jQuery === 'undefined'){
      document.write('<script src="assets/js/popper2116.min.js"><\/script>');
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    if(typeof jQuery === 'undefined'){
      document.write('<script src="assets/js/js/bootstrap.bundle.min.js"><\/script>');
    }
  </script>

<script type="text/javascript">

$(document).ready(function(e){
  $('#loanForm').on('submit', function(e) {
    e.preventDefault();
    var fd = new FormData(this);
    $.ajax({
      url:'loanCustomerData.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(data) {
        // alert('Success!');
        $('#lalagyan').html(data);
        console.log(data);
      },
      error: function(data) {
        alert('Error Sending your form!');
      }
    });
  });
});

$(document).on('submit', '#createNewCustomer', function(e) {
      e.preventDefault();
      var customerFirstName = $('#customerFirstName').val();
      var customerSurname = $('#customerSurname').val();
      var customerMiddleName = $('#customerMiddleName').val();
      var birthDate = $('#birthDate').val();
      var fd = new FormData(this);
      if (customerFirstName != '' && customerSurname != '' && customerMiddleName != '' && birthDate != '') {
        $.ajax({
          url: "loanAddNewCustomer.php",
          type: "post",
          data: fd,
          contentType: false,
          processData: false,
          success: function(data) {
            var response = JSON.parse(data);
              $('#createNewCustomerFolder').modal('hide');
              alert('Successfully Added!');
              $('#createNewCustomer')[0].reset();
              window.location.reload();
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });

function show()
{
    document.getElementById('createNew').removeAttribute('disabled');
}

function stoppedTyping(){
    if(customerName.value.length > 0) { 
        document.getElementById('Search').removeAttribute('disabled');
    } else { 
        document.getElementById('Search').setAttribute('disabled', true);
    }
}
</script>

<div class="modal fade" id="createNewCustomerFolder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Customer</h5>
        </div>
        <div class="modal-body">
          <form id="createNewCustomer" enctype="multipart/data-form">
            <!--input type="hidden" name="t_inventory_id" id="t_inventory_id" value=""-->
            <div class="mb-3 row" id="id">
              <label for="customerFirstName" class="col-md-3 form-label">First Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="customerFirstName" name="customerFirstName" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerSurname" class="col-md-3 form-label">Surname</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="customerSurname" name="customerSurname" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerMiddleName" class="col-md-3 form-label">Middle Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="customerMiddleName" name="customerMiddleName" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="birthDate" class="col-md-3 form-label">Birth Date</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="birthDate" name="birthDate" Required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="create" id="create">Create</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

