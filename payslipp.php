<!-- <?php
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="A payslip web app for OUR Bank.">
  <link rel="icon" href="images/favicon.ico">

  <title>Online Payslip</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
 


  <link rel="stylesheet" href="./css/home.css"> 
<style>
  
#payLogo{
  width: 30%;
  height: auto!important;
}

#deductions{
  display: none;
}

#slip-logo{
  width: 50%;
  height: auto!important;
  display: block;
}
h2{
  font-family: "Source Sans Pro", sans-serif;
  color: #656565;
  margin: 30px 0 20px;
}
.refresh-btn, .generate-payslip, .uploadBtn {
  border-radius: 12px;
}
#form-right{
  float: right;
}
</style>
</head>

<body>
  
  <div class="container-fluid">
  <div id="pLogo">
      <img src="logo/logo-full.png" id="payLogo">
  </div>
    <div class="payslip-form">
      <div id="form-right">
        <button type="button" class="btn btn-secondary btn-md uploadBtn" data-bs-toggle="modal" data-bs-target="#uploadModal">Import CSV</button>
      </div>
      <h2>Employee Information:</h2> 
  
      <?php
        $selectEmp = " SELECT * FROM `accounts` ";
        $queryEmp = mysqli_query($con, $selectEmp);
      ?>
 
      <form class="employee-info">
        <div class="form-floating inputFields">
          <input type="text" class="form-control" id="paymentDate" placeholder="paymentDate" value="<?php  date_default_timezone_set('Asia/Manila');
                                              $dateToday = date('F j, Y');
                                echo $dateToday ?>" readonly>
          <label for="paymentDate">Date Of Payment</label>
        </div>
        <div class="form-floating inputFields">
        <select class="form-control" id="branch">
          <option value="" selected disabled> -- Selected Branch -- </option>
          <option value="HeadOffice">Head Office</option>
          <option value="Magallanes">Magallanes</option>
          <option value="Manggahan">Manggahan</option>
          <option value="Maragondon">Maragondon</option>
          <option value="Poblacion">Poblacion</option>
          <option value="Noveleta">Noveleta</option>
          <option value="Ternate">Ternate</option>
        </select>
        <label for="branch">Branch</label>
        </div>
    
        <div class="form-floating inputFields">
          <select class="form-control"  id="payPeriod">
            <option value="" selected disabled> -- Date Payment -- </option>
            <option value="First Cut Off"> First Cut Off </option>
            <option value="Last Cut Off"> Last Cut Off </option>
          </Select>
          <label for="payPeriod">Date Payment</label>
        </div>
        <div class="form-floating inputFields">
          <input type="text" class="form-control" id="idNumber" placeholder="idNumber" name="idNumber" readonly>
          <label for="idNumber">Employee ID No.</label>
        </div>
        <div class="form-floating inputFields">
        <select class="form-control" id="employee" name="employee" onchange="myFunction()">
          <option value="" selected disabled> -- Employee Name -- </option>
          <?php
            while($row = mysqli_fetch_row($queryEmp))
          ?>
        </select>
        <label for="employee">Employee</label>
        </div>
        <div class="form-floating inputFields">
          <input type="text" class="form-control" id="position" name="position" placeholder="position"  readonly>
          <label for="position">Position</label>
        </div>
      </form>
      <br>

      <h2>Earnings:</h2>
      <form action="">
      
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="salary" value="0.00" placeholder="Username">
          <label for="salary">Basic Salary</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="transpoAllow" value="0.00" placeholder="Username">
          <label for="transpoAllow">Transporation Allowance</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="riceAllow" value="0.00" placeholder="Username">
          <label for="riceAllow">Rice Allowance</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="overtimePay" value="0.00" placeholder="Username">
          <label for="overtimePay">Overtime Pay</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="hollidayPay" value="0.00" placeholder="Username">
          <label for="hollidayPay">Holiday Pay</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="otherPay" value="0.00" placeholder="Username">
          <label for="otherPay">Other</label>
        </div>


        <div class="form-check">
          <input class="form-check-input cb-deductions" type="checkbox" id="flexCheckDefault" >
          <label class="form-check-label" for="flexCheckDefault">
            Add Deductions?
          </label>
        </div>

      </form>

      
      <br>

      <form action="" id="deductions">

        <h2>Deductions:</h2>
      
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="sss" value="0.00" placeholder="SSS">
          <label for="sss">SSS</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="sssMand" value="0.00" placeholder="SSS Mand">
          <label for="sssMand">SSS Mand. Provident</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="pagibig" value="0.00" placeholder="PAGIBIG">
          <label for="pagibig">PAGIBIG</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="philhealth" value="0.00" placeholder="PHILHEALTH">
          <label for="philhealth">PHILHEALTH</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="sssLoan" value="0.00" placeholder="SSS Loan">
          <label for="sssLoan">SSS Loan</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="hdmfLoan" value="0.00" placeholder="HDMF Loan">
          <label for="hdmfLoan">HDMF Loan</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="employeeLoan" value="0.00" placeholder="Employee Loan">
          <label for="employeeLoan">Employee Loan</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="otherLoan" value="0.00" placeholder="Other Loan">
          <label for="otherLoan">Other Loan</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="withholdingTax" value="0.00" placeholder="Withholding Tax">
          <label for="withholdingTax">Withholding Tax</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="absent" value="0.00" placeholder="Absent">
          <label for="absent">Absent</label>
        </div>
        <div class="form-floating inputFields">
          <input type="number" class="form-control" id="lates" value="0.00" placeholder="Lates">
          <label for="lates">Lates</label>
        </div>
      </form>

      <br>

    </div>

  <button type="button" class="btn btn-success btn-md refresh-btn">Refresh</button>
  
  <button type="button" class="btn btn-primary btn-md generate-payslip" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Generate Payslip</button>

<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">File Upload Form</h4>
      </div>
      <div class="modal-body">

      <form method='post' action='' enctype="multipart/form-data">
          Select File : <input type='file' name='file' id='file' class='form-control' ><br>
          <button type='submit' class='btn btn-info btn-md' id='btn_upload'>UPLOAD</button>
        </form>


        <div id='preview'></div>
      </div>
 
    </div>

  </div>
</div>

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Payslip</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="payslip-content">
          
   
          <div id="slipLogo">
              <img class="slip-logo" id="slip-logo" src="./logo/logo.png" alt="slip-logo"><br>
            </div>
          <div class="slip">
            
            <h3>PAYSLIP</h3>
            <div class="rightText">
              <p>Date of Payment: <span><strong  class="slipDateOfPayment"></strong></span></p>
              <p>Branch: <span><strong  class="slipBranch"></strong></span></p>
              <p>Pay Period: <span><strong  class="slipPayPeriod"></strong></span></p>
            </div>

            <p>Employee ID No: <span><strong  class="slipID"></strong></span></p>
            <p>Employee Name: <span><strong  class="slipName"></strong></span></p>
            <p>Position: <span><strong  class="slipPosition"></strong></span></p>


            <table class="table">
              <thead>
                <tr>
                  <th scope="col">EARNINGS</th>
                  <th scope="col"></th>
                  <th scope="col">DEDUCTIONS</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                <tr>
                  <th scope="row">Basic Salary</th>
                  <td class="data-basicPay">0.00</td>
                  <th scope="row">SSS</th>
                  <td class="data-sss">0.00</td>
                </tr>
                <tr>
                  <th scope="row">Transpo. Allow.</th>
                  <td class="data-transpoAllow">0.00</td>
                  <th scope="row">SSS Mand. Provident</th>
                  <td class="data-sssMand">0.00</td>
                </tr>
                <tr>
                  <th scope="row">Rice Allowance</th>
                  <TD class="data-riceAllow">0.00</TD>
                  <th scope="row">PAGIBIG</th>
                  <TD class="data-pagibig">0.00</TD>
                </tr>
                <tr>
                  <th scope="row">Overtime Pay</th>
                  <TD class="data-otPay">0.00</TD>
                  <th scope="row">PHILHEALTH</th>
                  <TD class="data-philhealth">0.00</TD>
                </tr>
                <tr>
                  <th scope="row">Holiday Pay</th>
                  <TD class="data-hollidayPay">0.00</TD>
                  <th scope="row">SSS Loan</th>
                  <TD class="data-sssLoan">0.00</TD>
                </tr>
                <tr>
                  <th scope="row">Other.</th>
                  <TD class="data-otherPay">0.00</TD>
                  <th scope="row">HDMF Loan</th>
                  <TD class="data-hdmfLoan">0.00</TD>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <TD></TD>
                  <th scope="row">Employee Loan</th>
                  <TD class="data-employeeLoan">0.00</TD>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <TD></TD>
                  <th scope="row">Other Loan</th>
                  <TD class="data-otherLoan">0.00</TD>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <TD></TD>
                  <th scope="row">Withholding Tax</th>
                  <TD class="data-withholdingTax">0.00</TD>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <TD></TD>
                  <th scope="row">Absent</th>
                  <TD class="data-absent">0.00</TD>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <TD></TD>
                  <th scope="row">Lates</th>
                  <TD class="data-lates">0.00</TD>
                </tr>
              </tbody>
              <tfoot class="table-group-divider">
                <tr>
                  <th scope="row">TOTAL EARNINGS</th>
                  <td class="data-totalEarnings">0.00</td>
                  <th scope="row">TOTAL DEDUCTIONS</th>
                  <td class="data-totalDeducts">0.00</td>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <td></td>
                  <th scope="row" class="table-dark">NET SALARY</th>
                  <td class="table-dark data-netSalary">0.00</td>
                </tr>
              </tfoot>
            </table>
          </div>

          
          <div id="output"></div>


          <!-- PAYSLIP CONTENT -->
    
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script type="text/javascript" src="js/printThis.js"></script>
<script type="text/javascript" src="js/home.js"></script>
<script type="text/javascript" src="js/screenshot.js"></script>
<script type="text/javascript" src="js/select.js"></script>

<script>
$(document).ready(function(){
  $(document).on('change', '#employee', function(event) {
    event.preventDefault();
        var text = $(this).val();
        $.ajax({
          url: "fetch_payroll.php",
          data: {
            fullName: text,
          },
          type: 'post',
          success: function(data) {
            var json = JSON.parse(data);
            $('#idNumber').val(data);
          }
        });
      });
  $(document).on('change', '#idNumber', function(event) {
    event.preventDefault();
    var text2 = $(this).val();
    $.ajax({
      url: "fetch_bankPosition.php",
      data: {
        employeeId: text2,
      },
      type: 'post',
      success: function(data) {
        var json = JSON.parse(data);
        $('#position').val(data);
      }
    });
  });
});
</script>

</body>
</html> --> --> -->