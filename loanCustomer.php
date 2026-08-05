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

  <link rel="stylesheet" href="./css/bootstrap521.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

  <!-- bootstrap -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css">
  <style>
    /* For Chrome, Safari, Edge, and Opera */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* For Firefox */
    input[type="number"] {
        -moz-appearance: textfield;
    }

    #loading {
      display: none;
    }

    .label-container {
        display: inline-block;
        position: relative;
        /* margin-left: -25px; Adjust to align with the label */
    }

    .warning-icon {
        margin-left: 5px;
        color: gold;
        font-weight: bold;
        cursor: pointer;
    }

    .tooltip {
        visibility: hidden;
        font-size: 12px;
        width: 150px;
        background-color: #f44336;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        top: -7px;
        left: 30px; /* Positioning the tooltip to the right */
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip2 {
        visibility: hidden;
        font-size: 12px;
        width: 150px;
        background-color: #f44336;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        top: -7px;
        left: 30px; /* Positioning the tooltip to the right */
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip2::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: transparent transparent transparent #f44336;
    }

    .label-container:hover .tooltip2 {
        visibility: visible;
        opacity: 1;
    }

    .tooltip::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: transparent transparent transparent #f44336;
    }

    .label-container:hover .tooltip {
        visibility: visible;
        opacity: 1;
    }
  </style>
</head>

<!-- <body id="body" oncontextmenu="return false;"> -->
<body id="body" >
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
                    <?php 
                      if($_SESSION['username'] == "cbasco"){
                        echo '';
                      }else{
                    ?>
                    <button data-bs-toggle="modal" class="btn btn-primary btn-md" name="createNew" id="createNew" data-bs-target="#createNewCustomerFolder" disabled>Create New Customer</button>
                    <!-- <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#createNewCustomerFolder" name="createNew" id="createNew" class="btn btn-primary btn-md" disabled>Create New Customer</a> -->
                    <?php } ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div id="lalagyan">
        </div>
      </div>
    </div>
    </div>
  </section>

  <div class="modal fade" id="createNewCustomerFolder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Customer</h5>
        </div>
        <div class="modal-body">
          <form id="createNewCustomer" enctype="multipart/form-data">
            <input type="hidden" name="hiddenSheesh" id="hiddenSheesh" value="<?= $_SESSION['userid']; ?>">
            <div class="mb-3 row" id="id">
              <label for="customerFirstName" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">First Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="customerFirstName" name="customerFirstName" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerSurname" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Surname</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="customerSurname" name="customerSurname" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerMiddleName" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Middle Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="customerMiddleName" name="customerMiddleName">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="birthDate" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Birth Date</label>
              <div class="col-md-8">
                <input type="date" class="form-control" id="birthDate" name="birthDate" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="salaryType" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Type Of Loan</label>
              <div class="col-md-8">
                <!-- <input type="text" class="form-control" id="salaryType" name="salaryType" Required> -->
                <select name="salaryType" id="salaryType" class="form-control" Required>
                  <option value="" Selected Disabled>-Select Type Of Loan</option>
                  <option value="Microfinance">Microfinance</option>
                  <option value="Salary Loan">Salary Loan</option>
                  <option value="Hold-Out Loan">Hold-Out Loan</option>
                  <option value="Hold-Out Loan-MPL">Hold-Out Loan - Multi Purpose</option>
                  <option value="REM: Corporation">REM: Corporation</option>
                  <option value="REM: Individual">REM: Individual</option>
                </select>
              </div>
            </div>
            <div class="corpSection" id="corpSection" style="display: none">
              <div class="mb-3 row">
                <label for="companyName" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Company Name</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="companyName" name="companyName" required>
                </div>
              </div>
            </div>
            <div class="sourceIncomeSection" id="sourceIncomeSection" style="display:none;">
              <div class="mb-3 row">
                <label for="sourceIncome" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Source Of Income</label>
                <div class="col-md-8">
                  <!-- <input type="text" class="form-control" id="salaryType" name="salaryType" Required> -->
                  <select name="sourceIncome" id="sourceIncome" class="form-control">
                    <option value="" Selected Disabled>Select Type Of Income</option>
                    <option value="Business">Business</option>
                    <option value="Employed Loan">Employed</option>
                  </select>
                </div>
              </div>
            </div>
            <div id="endBuyerSection" style="display: none;">
              <div class="mb-3 row">
                <label for="" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">End Buyer</label>
                <div class="col-md-8">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="End Buyer" id="endBuyerCheck" name="endBuyerCheck" style="float: left; text-align: left; position: relative;">
                    <label class="form-check-label" for="endBuyerCheck">
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-4">
              <div class="row">
                <div class="col-4"> <!-- Adjust the column width as needed -->
                  <input class="form-check-input" type="checkbox" id="existingg" name="existingg" style="float: left; text-align: left; position: relative;">
                  <label for="existingg" style="float: left; text-align: left; position: relative;">&nbsp;Existing Loan</label>
                </div>
                <div class="col-8"> <!-- Adjust the column width as needed -->
                  <input type="text" class="form-control" id="nextbankk" name="nextbankk" placeholder="INPUT NEXTBANK PRODCUT ID" style="display:none;">
                </div>
                <br>
              </div>
            </div>
          <div class="mb-4">
            <div class="row">
              <div class="col-7">
                  <input class="form-check-input" type="checkbox" id="fieldG" name="fieldG" style="float: left; text-align: left; position: relative;">
                  <label for="fieldG" style="float: left; text-align: left; position: relative;">&nbsp;Phil Guarantee</label>
                </div>
                <div class="col-5"> <!-- Adjust the column width as needed --></div>
            </div>
          </div>
          <div class="mb-4">
            <div class="row">
              <div class="col-7">
                  <input class="form-check-input" type="checkbox" id="writeOff" name="writeOff" style="float: left; text-align: left; position: relative;" value="1">
                  <label for="writeOff" style="float: left; text-align: left; position: relative;">&nbsp;Written Off</label>
                </div>
                <div class="col-5"> <!-- Adjust the column width as needed --></div>
            </div>
          </div>
            <div class="mb-3 row">
              <label for="customerAmount" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Loan Amount
                <!-- <div class="label-container">
                  <span class="fa-solid fa-circle-exclamation warning-icon">!</span>
                  <span class="tooltip">Remove the commas ","</span>
                </div> -->
              </label>
              
              <div class="col-md-8">
                <input type="number" class="form-control" id="customerAmount" name="customerAmount" min="0" step=".01" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerTerms" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Terms
                <div class="label-container">
                  <span class="fa-solid fa-circle-exclamation warning-icon">!</span>
                  <span class="tooltip2">
                    Indicate the word <br>"<strong>Year/s</strong>" or "<strong>Month/s</strong>"<br>
                    ex. 1 Year and 6 Months
                  </span>
                </div>
              </label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="customerTerms" name="customerTerms" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerInterest" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Interest Rate (%)</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="customerInterest" name="customerInterest" Required>
              </div>
            </div>

            <?php if($_SESSION['employeeId'] == '104' || $_SESSION['userid'] == '19' || $_SESSION['userid'] == '104' || $_SESSION['userid'] == '113'){ ?>
              <div class="mb-3 row">
                <label for="customerBranch" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Branch</label>
                <div class="col-md-8">
                  <select name="customerBranch" id="customerBranch" class="form-control">
                    <option value="" selected disabled>--Select Branch--</option>
                    <option value="Head Office">Head Office</option>
                    <option value="Noveleta">Noveleta</option>
                    <option value="Poblacion">Poblacion</option>
                    <option value="Manggahan">Manggahan</option>
                    <option value="Magallanes">Magallanes</option>
                    <option value="Maragondon">Maragondon</option>
                    <option value="Ternate">Ternate</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="customerContact" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Phone</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="customerContact" name="customerContact">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="customerEmail" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Email</label>
                <div class="col-md-8">
                  <input type="email" class="form-control" id="customerEmail" name="customerEmail">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="shaneRemarks" class="col-md-4 form-label" style="float: left; text-align: left; position: relative;">Remarks</label>
                <div class="col-md-8">
                  <textarea type="text" class="form-control" id="shaneRemarks" name="shaneRemarks"></textarea>
                </div>
              </div>
            <?php } ?>
        </div>
        <div id="loading">Creating customer data... Please Wait</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="create" id="create" tabindex="-1">Create</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script>
    if(typeof jQuery === 'undefined'){
      document.write('<script src="js/bootstrap.bundle.min.js"><\/script>');
    }
  </script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->


  <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
  <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function(e) {
      $('#loanForm').on('submit', function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        $.ajax({
          url: 'loanCustomerData.php',
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

  function submitNewCustomerForm() {
    $(document).ready(function() {
      $('#createNewCustomer').on('submit', function(e) {
        e.preventDefault();
        document.getElementById('create').style.pointerEvents = "none";
        $('#loading').show();
        
        var fd = new FormData(this);

        <?php 
        if ($_SESSION['userid'] != 78 || $_SESSION['userid'] != 19 || $_SESSION['userid'] != 73 || $_SESSION['userid'] != 113) { ?>
          var branchAdress = "<?php echo $_SESSION['address']; ?>";
          fd.append('branchAdress', branchAdress);
        <?php 
        } else { ?>
          fd.append('branchAdress', $('#customerBranch').val());
        <?php } ?>

        fd.append('branchAdress', branchAdress);

        $.ajax({
          url: "loanAddNewCustomer.php",
          type: "post",
          data: fd,
          contentType: false,
          processData: false,
          success: function(data) {
            $('#loading').hide();
            alert('Successfully Added!');
            window.location.reload();
          },
          error: function(data) {
            alert('Error');
            window.location.reload();
          }
        });
      });
    });
  }
  submitNewCustomerForm();



    function show() {
      document.getElementById('createNew').removeAttribute('disabled');
    }

    function stoppedTyping() {
      if (customerName.value.length > 0) {
        document.getElementById('Search').removeAttribute('disabled');
      } else {
        document.getElementById('Search').setAttribute('disabled', true);
      }
    }
  </script>

  

<script>
  const salaryTypeSelect = document.getElementById('salaryType');
  const endBuyerSection = document.getElementById('endBuyerSection');
  const sourceIncome = document.getElementById('sourceIncomeSection');
  const corpSection = document.getElementById('corpSection');
  const company = document.getElementById('companyName');
  const source = document.getElementById('sourceIncome');

  salaryTypeSelect.addEventListener('change', function() {
    const selectedValue = salaryTypeSelect.value;


    if (selectedValue.includes('REM: Individual')) {
      sourceIncome.style.display = 'inline';
      endBuyerSection.style.display = 'inline';
      source.required = true;

    } else {
      sourceIncome.style.display = 'none';
      endBuyerSection.style.display = 'none';
      source.required = false;
    }
    if (selectedValue.includes('REM: Corporation')) {
      corpSection.style.display = 'inline';
      company.required = true;
    } else {
      corpSection.style.display = 'none';
      company.required = false;
    }
  });
</script>


<script>
  $(document).ready(function() {
    $('#existingg').on('change', function() {
      if (this.checked) {
        $('#nextbankk').show();
      } else {
        $('#nextbankk').hide();
      }
    });
  });
</script>

<!-- <script>
  $(document).ready(function() {
    $('#fieldG').on('change', function() {
      if (this.checked) {
        $('#fieldG').val('Yes');
        alert($('#fieldG').val());
      } else {
       $('#fieldG').val('No');
      }
    });
  });
</script> -->


<script>
  var inputBox = document.getElementById("customerAmount");

  var invalidChars = [
    "-",
    "+",
    "e",
  ];

  inputBox.addEventListener("keydown", function(e) {
    if (invalidChars.includes(e.key)) {
      e.preventDefault();
    }
  });
</script>
</body>
</html>