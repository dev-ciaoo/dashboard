<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Jaypee Bolonia">
  <meta name="description" content="A payslip web app for OUR Bank.">
  <link rel="icon" href="images/favicon.ico">

  <title>Online Payslip</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
 

  custom CSS

  <link rel="stylesheet" href="home.css">

</head>

<body>
<h1>
  Payroll
  <small class="text-muted">HRIS System</small>
</h1>


<div class="container-fluid">

  <div class="payslip-form">

    <h1>Employee Information:</h1>

    <div class="form-inline my-2 my-lg-0 search-payroll">
      <input class="form-control mr-sm-2 searchBarPayroll" type="text" placeholder="Search" aria-label="Search" onkeyup="sendData(this)">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" disabled>
      <i class="fa-solid fa-magnifying-glass"></i> </button>
    </div>
    <section id="searchResults">

    </section>

    <form class="employee-info">

      <div class="form-group inputFields">
        <label for="paymentDate">Date of Payment</label>
        <input type="date" class="form-control" id="paymentDate" required>
      </div>

      <label for="branch">Branch</label>
      <select class="custom-select inputFields" id="branch">
        <option selected value="Head Office">Head Office</option>
        <option value="Magallanes">Magallanes</option>
        <option value="General Trias - Manggahan">General Trias - Manggahan</option>
        <option value="Maragondon">Maragondon</option>
        <option value="General Trias - Poblacion">General Trias - Poblacion</option>
        <option value="Noveleta">Noveleta</option>
        <option value="Ternate">Ternate</option>
      </select>

      <div class="form-group inputFields">
        <label for="paymentDate">Pay Period</label>
        <input type="text" class="form-control" id="payPeriod" required>
      </div>

      <div class="form-group inputFields">
        <label for="idNumber">Employee ID No.</label>
        <input type="text" class="form-control" id="idNumber">
      </div>

      <div class="form-group inputFields">
        <label for="name">Employee Name</label>
        <input type="text" class="form-control" id="name">
      </div>

      <div class="form-group inputFields">
        <label for="position">Position</label>
        <input type="text" class="form-control" id="position">
      </div>

    </form>

    <br>

    <h1>Earnings:</h1>
    <form action="">

      <div class="form-group inputFields">
        <label for="salary">Basic Salary</label>
        <input type="number" class="form-control" id="salary" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="transpoAllow">Transporation Allowance</label>
        <input type="number" class="form-control" id="transpoAllow" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="riceAllow">Rice Allowance</label>
        <input type="number" class="form-control" id="riceAllow" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="overtimePay">Overtime Pay</label>
        <input type="number" class="form-control" id="overtimePay" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="hollidayPay">Holiday Pay</label>
        <input type="number" class="form-control" id="hollidayPay" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="otherPay">Other</label>
        <input type="number" class="form-control" id="otherPay" value="0.00">
      </div>

      <div class="form-check">
        <input class="form-check-input cb-deductions" type="checkbox" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Add deductions?
        </label>
      </div>

    </form>


    <br>

    <form action="" id="deductions">

      <h1>Deductions:</h1>

      <div class="form-group inputFields">
        <label for="sss">SSS</label>
        <input type="number" class="form-control" id="sss" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="sssMand">SSS Mand. Provident</label>
        <input type="number" class="form-control" id="sssMand" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="pagibig">PAGIBIG</label>
        <input type="number" class="form-control" id="pagibig" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="philhealth">PHILHEALTH</label>
        <input type="number" class="form-control" id="philhealth" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="sssLoan">SSS Loan</label>
        <input type="number" class="form-control" id="sssLoan" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="hdmfLoan">HDMF Loan</label>
        <input type="number" class="form-control" id="hdmfLoan" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="employeeLoan">Employee Loan</label>
        <input type="number" class="form-control" id="employeeLoan" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="otherLoan">Other Loan</label>
        <input type="number" class="form-control" id="otherLoan" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="withholdingTax">Withholding Tax</label>
        <input type="number" class="form-control" id="withholdingTax" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="absent">Absent</label>
        <input type="number" class="form-control" id="absent" value="0.00">
      </div>

      <div class="form-group inputFields">
        <label for="lates">Lates</label>
        <input type="number" class="form-control" id="lates" value="0.00">
      </div>

    </form>

    <br>

  </div>

  <!-- Button trigger modal -->
  <div class="payroll-btn">
    <button type="button" class="btn btn-info import-btn">Import CSV</button>
    <button type="button" class="btn btn-primary generate-payslip" data-toggle="modal" data-target="#staticBackdrop">
      Generate Payslip
    </button>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Payslip</h5>
          <button type="button" class="close psModal-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div id="payslip-content">

            <!-- day 15 -->
            <div class="slip">
              <img class="slip-logo" src="images/logo.png" alt="logo"><br>
              <h3>PAYSLIP</h3>
              <div class="rightText">
                <p>Date of Payment: <span><strong class="slipDateOfPayment"></strong></span></p>
                <p>Branch: <span><strong class="slipBranch"></strong></span></p>
                <p>Pay Period: <span><strong class="slipPayPeriod"></strong></span></p>
              </div>

              <p>Employee ID No: <span><strong class="slipID"></strong></span></p>
              <p>Employee Name: <span><strong class="slipName"></strong></span></p>
              <p>Position: <span><strong class="slipPosition"></strong></span></p>


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
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary  psModal-close" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success screenshot-btn">Capture</button>
          <button type="button" class="btn btn-primary print-btn">Save as PDF</button>
        </div>
      </div>
    </div>
  </div>

</div>


<!-- Modal for payslip -->
<div class="modal fade" id="searchModal" data-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
    
      </div>
      <div class="modal-footer">
        <input type="number" id="lateTotal" placeholder="Late in mins.">
        <input type="number" id="absentTotal" placeholder="Absents">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="fillFields()">Confirm</button>
      </div>
    </div>
  </div>
</div>



<script>
 
  // dictionary for employee data used in fetch
  let dict = {};

  // FOR LIVE SEARCH
  function sendData(e) {
    const searchResults = document.getElementById("searchResults");
    let match = e.value.match(/^[a-zA-Z]*/);
    let match2 = e.value.match(/\s*/);
    if(match2[0] === e.value){
      searchResults.innerHTML = '';
      return;
    }
    if(match[0] === e.value){
      fetch("searchPayroll", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ payload: e.value })
    }).then(res => res.json()).then(data =>{
      let payload = data.payload;
      searchResults.innerHTML = '';
      if(payload.length < 1){
        searchResults.innerHTML = "<p>Sorry. Nothing Found.</p>";
        return;
      }
      payload.forEach((item, index)=>{
        
        if(index > 0) searchResults.innerHTML += "<hr>";
        searchResults.innerHTML +=  ` <a href="#" onclick="getName(this)" data-toggle="modal" data-target="#searchModal"> ${item.name} </a> ` ;
        dict[item.name] = item.employee_id;
      });
      
    });
      return;
    }
    searchResults.innerHTML = '';
 }

//  For passing searched employees data to the server
const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

// employee data
 let empData;
 let inout;

function getName(e){
  const logResults = document.getElementById("modal_body");
  fetch("searchLogs", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ payload: dict[e.innerText]})
    }).then(res => res.json()).then(data =>{

      document.getElementById("modal_title").innerText = (e.innerText) + "'s Logs";
      empData = data.payload2;
      let payload = data.payload;
      logResults.innerHTML = '';
      if(payload.length < 1){
        logResults.innerHTML = "<p>Sorry. Nothing Found.</p>";
        return;
      }
      payload.forEach((item, index)=>{
        
        if(index > 0) logResults.innerHTML += "<hr>";
        let date = new Date(item.date_time.slice(0,10));
        let time = item.date_time.slice(11, 20);

        if(time.charAt(0) === "0"){
          inout =  `<img src="images/in.png" style="height:1rem; width:1.6rem;">  ` ;
          
        }
        if(time.charAt(0) === "1"){
          inout =  `<img src="images/out.png" style="height:1rem; width:1.6rem;">  ` ;
        }
      
        logResults.innerHTML += inout + " " + date.toLocaleDateString("en-US", options) + " " + time;
        
      });

      // console.log(empData);
      
    });
    return;
}

  let lateVal;
  let absentVal;
  let lateCal, absentCal;

function fillFields(){

  

  // EMP FIELDS
  document.querySelector("#searchResults").innerHTML = "";
  document.querySelector("#branch").value = empData[0].branch;
  document.querySelector("#idNumber").value = empData[0].employee_id;
  document.querySelector("#name").value = empData[0].name;
  document.querySelector("#position").value = empData[0].position;

  // Salary
  let sal = empData[0].salary;
  document.querySelector("#salary").value = sal;

  // Deductions
  lateVal = parseFloat(document.querySelector("#lateTotal").value);
  absentVal = parseFloat(document.querySelector("#absentTotal").value);
  lateCal =  (((sal / 22) / 8) / 60) * lateVal;
  absentCal = ((sal / 22) * absentVal);

  if(document.querySelector("#lateTotal").value != '' || document.querySelector("#absentTotal").value != ''){
    document.getElementById("deductions").style.display = "block";
    document.querySelector(".cb-deductions").checked = true;

    if(document.querySelector("#lateTotal").value != ''){
      document.querySelector("#lates").value = lateCal.toFixed(1);
    }else{
      document.querySelector("#lates").value = 0.00;
    }

    if(document.querySelector("#absentTotal").value != ''){
      document.querySelector("#absent").value = absentCal.toFixed(1);
    }else{
      document.querySelector("#absent").value = 0.00;
    }
    
    
  }

}
  
 

</script>
</body>
</html>

