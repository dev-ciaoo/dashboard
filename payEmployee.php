<?php
include('connection.php');

$sql = "SELECT * FROM pay_selecteddate GROUP BY date ORDER BY STR_TO_DATE(date, '%M %e, %Y') ASC";
$result = $con->query($sql);

$options = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
  } else {
    echo "0 results";
  }

  $empid = $_SESSION['employeeId'];
  $name = $_SESSION['fullname'];
  
  // Convert $options array to JSON
$options_json = json_encode($options);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="A payslip for OUR Bank.">
  <link rel="icon" href="images/favicon.ico">

  <title>Online Payslip</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <!-- custom CSS -->

  <!-- <link rel="stylesheet" type="text/css" href="./css/home.css">  -->
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
    /* #hideThis {
    display: none;
  }  */


  #selectDate{
    text-align: center;
  
  }

  h1{
    font-family: serif;
  }

  p{
    margin-bottom: 2px;
  }

  label{
    color: gray;
  }

  .inputFields{
    margin-bottom: .6rem;
  }

  .payslip-form{
    text-align: left;
    padding: 1% 25% 0%;
    margin-right: auto!important;
    margin-left: auto!important;
  }

  .generate-payslip{
    margin-bottom: 30px;
    margin-right: 10px;
  }

  .refresh-btn{
    margin-bottom: 30px;
    margin-right: 10px;
  }

  .uploadBtn{
    margin-bottom: 30px;
    margin-right: 10px;
  }

  .logout-btn{
    margin-bottom: 30px;
    border-radius: 3%;
  }

  /* SLIP */

  .slip{
    text-align: left;
    border: 1px dashed;
    padding: 3%;
  }

  .rightText{
    text-align: right;
  }
  .custom-icon {
      color: #007BFF; /* Bootstrap primary color */
      font-size: 2em; /* Increase the size of the icon */
  }
  .custom-icon2 {
      color: red; /* Bootstrap primary color */
      font-size: 2em; /* Increase the size of the icon */
  }
</style>
</head>

<body> 
  <div class="container-fluid">
  <div id="pLogo">
      <img style="display:block;" src="logo/logo-full.png" id="payLogo">
  </div>
    <div class="payslip-form">
      <div  class="input-group form-floating inputFields">
          <select onchange="validate(this)" name="selectDate" id="selectDate" class="form-control" aria-describedby="button-addon2">
            <option value="" selected disabled>-- Select Date --</option>
            <?php
            foreach ($options as $option): ?>
              <option value="<?php echo $option['selectedDate']; ?>"><?php echo $option['date']; ?></option>
            <?php endforeach; ?>

          </select>
          <a class="btn btn-outline-secondary d-flex align-text-center" type="button" id="button-addon2"  data-bs-toggle="modal" data-bs-target="#addDate"><i class="fas fa-calendar-plus custom-icon"></i></a>
          <a class="btn btn-outline-secondary d-flex align-text-center" type="button" id="button-addon3"  data-bs-toggle="modal" data-bs-target="#deleteDate"><i class="fas fa-calendar-minus custom-icon2"></i></a>
      </div>
      <!-- <div id="form-right">
        <button type="button" class="btn btn-secondary btn-md uploadBtn" data-bs-toggle="modal" data-bs-target="#uploadModal">Import CSV</button>
      </div> -->
      <!-- <h2>Employee Information:</h2>  -->
<?php
$sql = "SELECT * 
      FROM accounts
      INNER JOIN pay_earnings ON accounts.employeeId = pay_earnings.employeeId
      WHERE accounts.employeeId = '$empid'";


$result = mysqli_query($con, $sql);
if ($result) {
    // Check if any result is found
    if (mysqli_num_rows($result) > 0) {
        // Output the results
        while ($row = mysqli_fetch_assoc($result)) {
            $employee_id = $row['employeeId'];
            $account_name = $row['fullName'];
            $branch =  $row['address'];
            $position =  $row['bankPosition'];  
            $monthlysalary = $row['MonthlySalary'];
            $basicpay = $monthlysalary / 2;
            $valrice = $row['RiceAllowance'];
            $sss = $row['sss'];
            $sssmand = $row['sssmandprovident'];
            $pagibig = $row['pagibig'];
            $philhealth = $row['philhealth'];
            $sssloan = $row['sssloan'];
            $tax = $row['withholdingtax'];
        }
    } else {
        echo "No records found for the specified criteria.";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
// Close the connection
mysqli_close($con);
?>
        <input type="hidden" id="monthlysalary" value="<?php echo $monthlysalary; ?>">
        <input type="hidden" id="valriceAllow" value="<?php echo $riceallowance; ?>">
        <input type="hidden" name="post_array" id="post_array" value="<?php echo htmlspecialchars($options_json); ?>">
        <input type="hidden" id="slPayment" value="">
        <input type="hidden" id="slCutoffSelect" value="">
        <div id="hideThis">
        <form class="employee-info">
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="paymentDate" placeholder="paymentDate" readonly>
            <label for="paymentDate">Date Of Payment</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="startdateoutput" name="startdateoutput" placeholder="startdate" readonly>
            <label for="startdateoutput">Start Date</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="enddateoutput" name="enddateoutput" placeholder="enddate" readonly>
            <label for="enddateoutput">End Date</label>
          </div>
          <div class="form-floating inputFields">
          <input class="form-control" id="branch" placeholder="Branch" value="<?= $branch ?>  ">
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
            <input type="text" class="form-control" id="idNumber" placeholder="idNumber" name="idNumber" value="<?= $employee_id?>" readonly>
            <label for="idNumber">Employee ID No. </label>
          </div>
          <div class="form-floating inputFields">
          <input class="form-control" id="employee" name="employee" placeholder="Name" value="<?= $account_name ?>">
          <label for="employee">Employee</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="position" name="position" placeholder="position" value="<?= $position ?>" readonly>
            <label for="position">Position</label>
          </div>
        </form>
        </div>
        <br>
        <div id="hideThis">
        <h2>Earnings:</h2>
        <form action="">
        
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="salary" value="0.00" placeholder="Salary" readonly> 
            <label for="salary">Basic Salary</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="transpoAllow" value="0.00" placeholder="Transpo. Allowance" readonly>
            <label for="transpoAllow">Transporation Allowance</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="riceAllow" value="" placeholder="Rice Allowance" readonly>
            <label for="riceAllow">Rice Allowance</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="overtimePay" value="0.00" placeholder="Overtime Pay" readonly>
            <label for="overtimePay">Overtime Pay</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="hollidayPay" value="0.00" placeholder="Holiday Pay" readonly>
            <label for="hollidayPay">Holiday Pay</label>
          </div>
          <div class="form-floating inputFields">
            <input type="text" class="form-control" id="otherPay" value="0.00" placeholder="Others" readonly>
            <label for="otherPay">Other</label>
          </div>

          <div class="form-check">
            <input class="form-check-input cb-deductions" type="checkbox" id="flexCheckDefault" >
            <label class="form-check-label" for="flexCheckDefault">
              Add Deductions?
            </label>
          </div>

        </form>
        </div>

        <br>
        <div id="">
        <div id="deduction-container">
          <form action="" id="deductions">
            <h2>Deductions:</h2>
          
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="sss" placeholder="SSS" readonly>
              <label for="sss">SSS</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="sssMand"  placeholder="SSS Mand" readonly>
              <label for="sssMand">SSS Mand. Provident</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="pagibig"  placeholder="PAGIBIG" readonly>
              <label for="pagibig">PAGIBIG</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="philhealth"  placeholder="PHILHEALTH" readonly>
              <label for="philhealth">PHILHEALTH</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="sssLoan" placeholder="SSS Loan" readonly>
              <label for="sssLoan">SSS Loan</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="employeeLoan"  placeholder="Employee Loan" readonly>
              <label for="employeeLoan">Employee Loan</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="otherLoan"  placeholder="Other Loan" readonly>
              <label for="otherLoan">Other Loan</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="withholdingTax" placeholder="Withholding Tax" readonly>
              <label for="withholdingTax">Withholding Tax</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="absent" placeholder="Absent" readonly>
              <label for="absent">Absent</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="lates" placeholder="Lates" readonly>
              <label for="lates">Lates</label>
            </div>
            <div class="form-floating inputFields">
              <input type="text" class="form-control" id="otherDeduction" placeholder="otherDeduction" readonly>
              <label for="lates">Other Deduction</label>
            </div>
          </form>
        </div>
        </div>
        <br>

      </div>

    <!-- Button trigger modal -->
    <button onclick="refresh()" type="button" class="btn btn-success btn-md refresh-btn">Refresh</button>
    
    <button id="generate" onclick="sendInputValue()" class="btn btn-primary btn-md generate-payslip" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Generate Payslip</button>

  <!-- Modal -->
  <div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
          <h4 class="modal-title">File Upload Form</h4>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form method='post' action='' enctype="multipart/form-data">
            Select File : <input type='file' name='file' id='file' class='form-control' ><br>
            <button type='submit' class='btn btn-info btn-md' id='btn_upload'>UPLOAD</button>
          </form>

          <!-- Preview-->
          <div id='preview'></div>
        </div>
  
      </div>

    </div>
  </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Payslip</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div id="payslip-content">
            
            <!-- day 15 -->
          
            <div class="slip">
              
            
            <div class="" id="slipLogo">
              <img style="display:block;"   id="slip-logo" src="http://localhost/dashboard/logo/logo.png" alt="slip-logo">
              <h3 style="text-align:right;" class="pull-right">PAYSLIP</h3>
            </div>
              <div class="rightText">
                <p>Date of Payment: <span><strong class="slipDateOfPayment"></strong></span></p>
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
                    <td class="data data-basicPay">0.00</td>
                    <th scope="row">SSS</th>
                    <td class="data-sss">0.00</td>
                  </tr>
                  <tr>
                    <th scope="row">Transpo. Allow.</th>
                    <td class="data data-transpoAllow">0.00</td>
                    <th scope="row">SSS Mand. Provident</th>
                    <td class="data-sssMand">0.00</td>
                  </tr>
                  <tr>
                    <th scope="row">Rice Allowance</th>
                    <TD class="data data-riceAllow">0.00</TD>
                    <th scope="row">PAGIBIG</th>
                    <TD class="data data-pagibig">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row">Overtime Pay</th>
                    <TD class="data data-otPay">0.00</TD>
                    <th scope="row">PHILHEALTH</th>
                    <TD class="data data-philhealth">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row">Other.</th>
                    <TD class="data data-otherPay">0.00</TD>
                    <th scope="row">SSS Loan</th>
                    <TD class="data data-sssLoan">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <TD></TD>
                    <th scope="row">Employee Loan</th>
                    <TD class="data data-employeeLoan">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <TD></TD>
                    <th scope="row">Other Loan</th>
                    <TD class="data data-otherLoan">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <TD></TD>
                    <th scope="row">Withholding Tax</th>
                    <TD class="data data-withholdingTax">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <TD></TD>
                    <th scope="row">Absent</th>
                    <TD class="data data-absent">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <TD></TD>
                    <th scope="row">Lates</th>
                    <TD class="data data-lates">0.00</TD>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <TD></TD>
                    <th scope="row">Other</th>
                    <TD class="data data-otherDeduction">0.00</TD>
                  </tr>
                </tbody>
                <tfoot class="table-group-divider">
                  <tr>
                    <th scope="row">TOTAL EARNINGS</th>
                    <td class="data data-totalEarnings">0.00</td>
                    <th scope="row">TOTAL DEDUCTIONS</th>
                    <td class="data data-totalDeducts">0.00</td>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <td></td>
                    <th scope="row" class="data table-dark">NET SALARY</th>
                    <td class="data table-dark data-netSalary">0.00</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            
            <div id="output"></div>


            <!-- PAYSLIP CONTENT -->
          </div> 

          
        </div>
        <div class="modal-footer">
          <button id="closeButton"type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-success screenshot-btn">Screenshot</button> -->
          <button type="button" class="btn btn-primary btn-md print-btn">Save As PDF/Print</button>
        </div>
      </div>
    </div>
    </div>

    </div>

<!-- MODAL -->
<div  class="modal" id="addDate">
  <div id="modal-dialog1" class="modal-dialog">
      <div id="modal-content1" class="modal-content">

          <!-- Modal Header -->
          <div  id="modal-header1" class="modal-header">
              <h4 id="modal-title1" class="modal-title">Add Date</h4>
          </div>

          <!-- Modal Body -->
          <div id="modal-body1" class="gap-2 modal-body d-flex flex-column align-items-center justify-content-start">
            <div class="input-group">
                <span class="input-group-text">Date :</span>
                <input value="" required class="form-control" name="dateadded" id="dateadded" type="date">
            </div>
            <div class="input-group">
                <span class="input-group-text">Selected Date :</span>
                <input value="" required class="form-control" name="selecteddate" id="selecteddate" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Start Date :</span>
                <input value="" class="form-control" name="startdateadded" id="startdateadded" type="date">
            </div>
            <div class="input-group">
                <span class="input-group-text">End Date :</span>
                <input value="" required class="form-control" name="enddateadded" id="enddateadded" type="date">
            </div>
          </div>

          <!-- Modal Footer -->
          <div  id="modal-footer1" class="modal-footer">
              <button type="button" class="btn btn-primary btn-md addDate-btn">Save</button>
              <button type="button" class="btn btn-danger close-btn" data-dismiss="#addDate">Close</button> 
          </div>

      </div>
  </div>
</div>
<!-- MODAL -->

<!-- MODAL -->
<div  class="modal" id="deleteDate">
  <div id="modal-dialog2" class="modal-dialog">
      <div id="modal-content2" class="modal-content">

          <!-- Modal Header -->
          <div  id="modal-header2" class="modal-header">
              <h4 id="modal-title2" class="modal-title">Remove Date</h4>
          </div>

          <!-- Modal Body -->
          <div id="modal-body2" class="gap-2 modal-body d-flex flex-column align-items-center justify-content-start">
            <div class="input-group">
                <span class="input-group-text">Date :</span>
                <select value="" required class="form-control" name="datedelete" id="datedelete" type="date">
                <option value="" selected disabled>-- Select Date --</option>
                <?php
                foreach ($options as $option): ?>
                  <option value="<?php echo $option['startdate']; ?>"><?php echo $option['date']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>

          <!-- Modal Footer -->
          <div  id="modal-footer2" class="modal-footer">
              <button type="button" class="btn btn-primary btn-md deleteDate-btn">Remove</button>
              <button type="button" class="btn btn-danger close-btn" data-dismiss="deleteDate">Close</button> 
          </div>

      </div>
  </div>
</div>
<!-- MODAL -->

  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  

  <!-- Custom -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <script type="text/javascript" src="js/printThis.js"></script>
  <script type="text/javascript" src="js/home.js"></script>
  <script type="text/javascript" src="js/screenshot.js"></script>
  <script type="text/javascript" src="js/select.js"></script>
  <script src="js/payEmployee.js" ></script>
<script>

  var valrice = "<?php echo $valrice ?>";
  var sss = "<?php echo $sss ?>";
  var sssmp ="<?php echo $sssmp ?>";
  var philhealth ="<?php echo $philhealth ?>";
  var hdmf ="<?php echo $hdmf ?>";
  var sssloan ="<?php echo $sssloan ?>";
  var withholdingtax ="<?php echo $withholdingtax ?>";
  var pagibig = "<?php echo $pagibig ?>";

  document.getElementById("generate").disabled = true;
  function validate(obj) {
    if (obj.value.length > 0) {
        document.getElementById("generate").disabled = false;
    } else {
        document.getElementById("generate").disabled = true;
    }
}

$('#closeButton').click(function(){
  $('.data').val("");
  location.reload();
});
</script>
<script>

 function formatDate(dateString) {
    // Convert the original date string to a JavaScript Date object
    var originalDate = new Date(dateString);
    
    // Get the month in the long format (e.g., "January", "February", etc.)
    var month = originalDate.toLocaleString('default', { month: 'long' });
    
    // Get the day of the month
    var day = originalDate.getDate();
    
    // Get the year
    var year = originalDate.getFullYear();
    
    // Concatenate the parts to form the new date format
    var newDateFormat = month + " " + day + ", " + year;
    
    // Return the new date format
    return newDateFormat;
}

function getStartDateAdded() {
  var selectedDate = $('#dateadded').val(); // Get the selected date
  var parts = selectedDate.split('-'); // Split the date into parts
  var year = parseInt(parts[0]); // Extract the year
  var month = parseInt(parts[1]); // Extract the month
  var dayOfMonth = parseInt(parts[2]); // Extract the day of the month

  var startDate;

  // Determine the start date based on the day of the selected date
  if (dayOfMonth === 15) {
      // If the day of the selected date is 15, start date is the 26th of the previous month
      if (month === 1) {
          // If it's January, the previous month is December of the previous year
          startDate = (year - 1) + '-12-26';
      } else {
          // Otherwise, the previous month is the month before
          var prevMonth = month - 1;
          if (prevMonth < 10) {
              prevMonth = '0' + prevMonth; // Ensure two digits for month
          }
          startDate = year + '-' + prevMonth + '-26';
      }
  } else {
      // If the day of the selected date is not 15, start date is the 11th of the same month
      startDate = year + '-' + parts[1] + '-11';
  }

  return startDate;
}

function getEndDateAdded() {
  var selectedDate = $('#dateadded').val(); // Get the selected date
  var parts = selectedDate.split('-'); // Split the date into parts
  var year = parseInt(parts[0]); // Extract the year
  var month = parseInt(parts[1]); // Extract the month
  var dayOfMonth = parseInt(parts[2]); // Extract the day of the month

  var endDate;

  // Determine the end date based on the day of the month
  if (dayOfMonth <= 15) {
    // If the day of the month is 15 or less, end date is the 10th of the same month
    endDate = year + '-' + parts[1] + '-10';
  } else {
    // If the day of the month is greater than 15, end date is the 25th of the same month
    endDate = year + '-' + parts[1] + '-25';
  }

  return endDate;
}
$(document).ready(function() {
 $('.close-btn').click(function(){
    $('#addDate').remove();
    location.reload();
    });

    $('#dateadded').change(function(){
      var addedDate = $(this).val();
      $('#selecteddate').val(formatDate(addedDate));
      var getstartdateAdded = getStartDateAdded();
      var getenddateAdded = getEndDateAdded();
      $('#startdateadded').val(getstartdateAdded);
      $('#enddateadded').val(getenddateAdded);
    });

    $('.addDate-btn').click(function(){
    // Get the values from the input fields
    var selectedDate = $('#selecteddate').val();
    var selectedStartDate = $('#startdateadded').val();
    var selectedEndDate = $('#enddateadded').val();
    var addedDate = $('#dateadded').val();

    // Ask for confirmation
    var confirmed = confirm("Are you sure you want to add this date?");

    // Proceed only if confirmed
    if (confirmed) {
        // Make AJAX request
        $.ajax({
            url: 'pay-adddate.php',
            method: 'POST',
            data: {
                addedDate : addedDate,
                selectedDate: selectedDate,
                selectedStartDate: selectedStartDate,
                selectedEndDate: selectedEndDate
            }, 
            success: function(response) {
              location.reload();
            },
            error: function(xhr, status, error) {
                console.log('error');
            }
        });
    }
});

$('.deleteDate-btn').click(function(){

  var deleteDate = $('#datedelete').find(":selected").text();

  var confirmed = confirm("Are you sure you want to remove this date?");

    // Proceed only if confirmed
    if (confirmed) {
        // Make AJAX request
        $.ajax({
            url: 'pay-deletedate.php',
            method: 'POST',
            data: {
              deleteDate: deleteDate,
            }, 
            success: function(response) {
              location.reload();
              console.log(deleteDate);
            },
            error: function(xhr, status, error) {
                console.log('error');
            }
        });
    }

});


});

</script>

  </body>
  </html>