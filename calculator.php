<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="OUR Bank Employee Dashboard">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>OUR Bank Loan Calculator</title>

  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="./css/dash.css">
</head>

<style>
    @media print {
        #printThis, #reporttbl_filter, #reporttbl_paginate, #reporttbl_length,
        #form-select, #back, #importThis, button,
        .modal-footer, #collectedModal {
            visibility: hidden !important;
        }

        body.print-preview {
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        #loanSummary {
            margin-top: 80px !important; /* Push down the content */
            padding-top: 40px !important;
        }

        /* Ensure amortization starts on a new page */
        #amortizationSchedule {
            page-break-before: always;
            margin-top: 40px;
        }

        /* Ensure containers print full width */
        .container {
            width: 100% !important;
            max-width: 100% !important;
        }
    }


    .flogo{
        max-width: 100%;
        height: auto;
    }

    #inventorylogo {
      width: 25%;
      height: auto!important;
    }

    .header-text {
        color: dimgray;
    }

</style>
<body>
<br>
<br>
<div class="container p-3 bg-light rounded shadow-sm border border-1 border-secondary">
    <!-- <div class="card-shadow p-3 bg-body rounded">
        <div class="card-header text-center">
            <h2 class="text-center">OUR Bank</h2>
            <p class="text-center">Loan Calculator</p>
        </div>
        <br>
    </div> -->
    <br>
    <div class="card-header text-center border-0 bg-light">
        
            <div class="flogo">
                <img src="./logo/logo.png" id="inventorylogo" alt="inventorylogo" />
                <!-- <div class="section-heading"> -->
            </div>
            <!-- <h2 class="text-center">OUR Bank</h2> -->
            <p class="header-text text-center"><strong>Loan Calculator</strong></p>
    </div>
    <br>
    <form id="calculator" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="typeLoan" class="form-label">Loan Type</label>
                <select name="typeLoan" id="typeLoan" class="form-control">
                    <option value="" selected disabled>--Select Type of Loan--</option>
                    <option value="Fixed Equal Amortization Case">Fixed Equal Amortization Case</option>
                    <!-- <option value="Fixed Principal Amortization Case">Fixed Pricipal Amortization Case</option>
                    <option value="Fixed Equal Amortization Case with Grace Period">Fixed Equal Amortization Case with Grace Period</option> -->
                    <option value="Periodic Interest Payment, Balloon Payment at Maturity">Periodic Interest Payment, Balloon Payment at Maturity</option>
                    <!-- <option value="Fixed Equal Amortization Case (Weekly Installments)">Fixed Equal Amortization Case (Weekly Installments)</option> -->
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="loanAmount" class="form-label">Loan Amount</label>
                <input type="text" class="form-control" id="loanAmount" name="loanAmount"  required>
            </div>
                <div class="col-md-6 mb-3" id="principalCycleDiv">
                <label for="principalCycle" class="form-label">Principal Repayment Cycle</label>
                    <select name="principalCycle" id="principalCycle" class="form-control">
                        <option value="" selected disabled>-- Select --</option>
                        <option value="Single Payment">Single Payment</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Quarterly">Quarterly</option>
                        <option value="Semi-Annual">Semi-Annual</option>
                        <option value="Yearly">Yearly</option>
                    </select>
            </div>
            <div class="col-md-6 mb-3" id="interestCycleDiv">
                <label for="interestCycle" class="form-label">Interest Repayment Cycle</label>
                    <select name="interestCycle" id="interestCycle" class="form-control">
                        <option value="" selected disabled>-- Select --</option>
                        <option value="Single Payment">Single Payment</option>
                        <option value="Monthly">Monthly</option>
                    </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="loanStartDate" class="form-label">Loan Start Date</label>
                <input type="date" class="form-control" id="loanStartDate" name="loanStartDate" required>
            </div>
            <div class="col-md-3 mb-3" id="loanYearsDiv">
                <label for="loanYears" class="form-label">Years</label>
                <input type="number" class="form-control" id="loanYears" name="loanYears" min="0" step="1">
            </div>
            <div class="col-md-3 mb-3" id="loanMonthsDiv">
                <label for="loanMonth" class="form-label">Month</label>
                <input type="number" class="form-control" id="loanMonth" name="loanMonth" min="0" step="1">
            </div>
            <div class="col-md-12 mb-3" id="loanWeeksDiv">
                <label for="loanWeek" class="form-label">Weeks</label>
                <input type="number" class="form-control" id="loanWeek" name="loanWeek" min="0" max="100" step="1">
            </div>
            <div class="col-md-3 mb-3">
                <label for="annualInterest" class="form-label">Nominal Annual Interest Rate (in %)</label>
                <input type="number" class="form-control" id="annualInterest" name="annualInterest" min="0" max="100" step="1" required>
            </div>
            <div class="col-md-12 mb-3" id="gracePeriodDiv">
                <label for="gracePeriod" class="form-label">Grace Period(in Months)</label>
                <input type="number" class="form-control" id="gracePeriod" name="gracePeriod" min="0" step="1" placeholder="Lease Enter Grace Period in Months">
            </div>
            <!-- <div class="col-md-12 mb-3" id="balloonPaymentDiv">
                <label for="balloonPayment" class="form-label">Balloon Payment</label>
                <input type="number" class="form-control" id="balloonPayment" name="balloonPayment" min="0" step="1" 
                        placeholder="Please enter the Percentage rate base on the loan amount">
            </div> -->
        </div>
</div>

<br>

<div class="container p-3 bg-light rounded shadow-sm border border-1 border-secondary">
    <div class="row">
        <div class="otherChargesDiv col-md-12 mb-3">
            <label for="otherCharges" class="form-label">Other Charges</label>
            <input type="number" class="form-control" id="otherCharges" min="0" max="100" step="0.01"name="otherCharges" placeholder="Please enter the percentage rate base on the loan amount">
        </div>
    </div>
</div>

<div class="container p-3 d-flex justify-content-end">
    <div class="row">
        <div class="btnDiv col-md-12 mb-3">
            <button type="submit" class="btn btn-primary btn-md" id="calculateBtn">Calculate</button>
            <button type="reset" class="btn btn-warning btn-md" id="resetBtn">Reset</button>
        </div>
    </div>
</div>
    </form>

<!-- Loan Summary -->
<div id="loanSummary" class="container p-3 bg-light rounded shadow-sm border border-1 border-secondary mt-3 d-none">
    <h4>Loan Summary</h4>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Loan Amount:</strong>
            <span id="summaryLoanAmount" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Weekly Installment:</strong> 
            <span id="summaryWeeklyInstallment" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Monthly Installment:</strong> 
            <span id="summaryMonthlyInstallment" class="text-center"></span>
        </li>
        <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Fixed Principal Amount, before Balloon Payment:</strong> 
            <span id="summaryFixedPrincipal" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Balloon Payment Amount:</strong> 
            <span id="summaryBalloonPayment" class="text-center"></span>
        </li> -->
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Contractual Rate (Monthly):</strong> 
            <span id="summaryContractualRate" class="text-center"></span>
        </li>
         <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Weekly Compounding Rate:</strong> 
            <span id="summaryWeeklyRate" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <strong>Other Charges:</strong> 
            <span id="summaryOtherCharges" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>No. of Monthly Installments:</strong> 
            <span id="summaryInstallments" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Period/Year</strong> 
            <span id="summaryPeriodYear" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Total Payment:</strong> 
            <span id="summaryTotalPayment" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Total Interest:</strong> 
            <span id="summaryTotalInterest" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Effective Annual Interest Rate:</strong> 
            <span id="summaryEffectiveInterest" class="text-center"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Payoff Date:</strong> 
            <span id="summaryPayoffDate" class="text-center"></span>
        </li>
    </ul>
</div>


<!-- Amortization Schedule -->
<div id="amortizationSchedule" class="container p-3 bg-light rounded shadow-sm border border-1 border-secondary mt-3 d-none">
    <h4>Amortization Schedule</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>Installment Period</th>
                    <th>Payment Date</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Other Charges</th>
                    <th>Payments</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody id="amortizationBody">
                <!-- Dynamic rows will be inserted here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Print Button After Result -->
<div class="container d-print-none p-3 text-end" id="printerDiv">
  <button onclick="customPrint()" class="btn btn-success btn-md">
    <i class="fas fa-print me-2"></i> Print Results
  </button>
</div>

<br>
<br>
    

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
<script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

<!-- Keep your HTML above as-is up to <script> -->
<script>
$(document).ready(function () {
    $('#printerDiv').hide();
    $('#gracePeriodDiv').hide();
    $('#balloonPaymentDiv').hide();
    $('#loanWeeksDiv').hide();
    $('#principalCycleDiv').hide();
    $('#interestCycleDiv').hide();

    $('#typeLoan').change(function () {
        var selectedValue = $(this).val();

        if (selectedValue === 'Fixed Equal Amortization Case with Grace Period') {
            $('#gracePeriodDiv').show();
            $('#balloonPaymentDiv').hide();
            $('#loanYearsDiv').show();
            $('#loanMonthsDiv').show();
            $('#loanWeeksDiv').hide();
            $('#interestCycleDiv').hide();
            $('#principalCycleDiv').hide();
        } else if (selectedValue === 'Periodic Interest Payment, Balloon Payment at Maturity') {
            $('#balloonPaymentDiv').show();
            $('#gracePeriodDiv').hide();
            $('#loanYearsDiv').show();
            $('#loanMonthsDiv').show();
            $('#principalCycleDiv').show();
            $('#interestCycleDiv').show();
            $('#loanWeeksDiv').hide();
        } else if (selectedValue === 'Fixed Equal Amortization Case (Weekly Installments)') {
            $('#loanYearsDiv').hide();
            $('#loanMonthsDiv').hide();
            $('#loanWeeksDiv').show();
            $('#gracePeriodDiv').hide();
            $('#balloonPaymentDiv').hide();
            $('#interestCycleDiv').hide();
            $('#principalCycleDiv').hide();
        }else if (selectedValue === 'Fixed Principal Amortization Case') {
            $('.monthlyInstallmentClass').hide();
            $('#gracePeriodDiv').hide();
            $('#balloonPaymentDiv').hide();
            $('#loanWeeksDiv').hide();
            $('#loanYearsDiv').show();
            $('#loanMonthsDiv').show();
            $('#interestCycleDiv').hide();
            $('#principalCycleDiv').hide();
        } else {
            $('#gracePeriodDiv').hide();
            $('#balloonPaymentDiv').hide();
            $('#loanWeeksDiv').hide();
            $('#loanYearsDiv').show();
            $('#loanMonthsDiv').show();
            $('#interestCycleDiv').hide();
            $('#principalCycleDiv').hide();
        }
    });

    $('#calculator').on('submit', function (event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: 'calculate.php',
        type: 'POST',
        data: formData,
        success: function (response) {
            if (typeof response === 'string') {
                response = JSON.parse(response);
            }
            
            $('#printerDiv').show();

            // Show and fill loan summary
            $('#loanSummary').removeClass('d-none');
            $('#summaryLoanAmount').text(response.loanAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#summaryMonthlyInstallment').text(response.monthlyInstallment ? response.monthlyInstallment.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-');
            $('#summaryWeeklyInstallment').text(response.weeklyAmortization ? response.weeklyAmortization.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-'); 
            $('#summaryWeeklyRate').text(response.weeklyRate ? response.weeklyRate.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-');
            $('#summaryPeriodYear').text(response.periodPerYear ? response.periodPerYear : '-');
            $('#summaryBalloonPayment').text(response.balloonPayment ? response.balloonPayment.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-');
            $('#summaryFixedPrincipal').text(response.monthlyPrincipal ? response.monthlyPrincipal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-');;         
            $('#summaryContractualRate').text(response.contractualRate);
            $('#summaryOtherCharges').text(response.otherCharges);
            $('#summaryInstallments').text(response.installments);
            $('#summaryTotalPayment').text(response.totalPayment);
            $('#summaryTotalInterest').text(response.totalInterest);
            $('#summaryEffectiveInterest').text(response.effectiveInterest ?? '0.00%');
            $('#summaryPayoffDate').text(response.payoffDate);

            // Show amortization schedule
            $('#amortizationSchedule').removeClass('d-none');
            $('#amortizationBody').empty(); // Clear old rows

            let totalPrincipal = 0;
            let totalInterest = 0;
            let totalOtherCharges = 0;

if (response.schedule && response.schedule.length > 0) {
    let totalPrincipal = 0;
    let totalInterest = 0;
    let totalOtherCharges = 0;

    response.schedule.forEach(function (row) {
        const principal = parseFloat(row.principal.replace(/,/g, '')) || 0;
        const interestRaw = parseFloat(row.interestRaw) || 0; // <-- use raw interest
        const otherCharges = parseFloat(row.otherCharges.replace(/,/g, '')) || 0;


        totalPrincipal += principal;
        totalInterest += interestRaw; // use full precision
        totalOtherCharges += otherCharges;

        var htmlRow = `
            <tr>
                <td>${row.installment}</td>
                <td>${row.paymentDate}</td>
                <td>${row.principal}</td>
                <td>${row.interest}</td>
                <td>${row.otherCharges}</td>
                <td>${row.payment}</td>
                <td>${row.balance}</td>
            </tr>
        `;
        $('#amortizationBody').append(htmlRow);
    });

    // Add total row
    var totalRow = `
        <tr>
            <td colspan="2" class="text-end fw-bold">Total:</td>
            <td><span>${customRoundDown(totalPrincipal).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span></td>
            <td>${totalInterest.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            <td>${totalOtherCharges.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            <td></td>
            <td></td>
        </tr>
    `;
    $('#amortizationBody').append(totalRow);
} else {
    $('#amortizationBody').append('<tr><td colspan="7" class="text-center">No amortization schedule returned</td></tr>');
}


        },
        error: function (xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });
});

});



</script>

<script>
  const input = document.getElementById('otherCharges');

  input.addEventListener('input', () => {
    let value = parseInt(input.value);
    if (value > 100) {
      input.value = 100;
    } else if (value < 0) {
      input.value = 0;
    }
  });
</script>

<script>
function customRoundDown(value) {
    const parts = value.toString().split('.');
    const decimalPart = parts[1];

    // If value has exactly 2 decimal places → force to 0.00
    if (decimalPart && decimalPart.length === 2) {
        return value = parseFloat(value.toFixed(0));
    }

    // Otherwise, truncate to 2 decimal places
    return Math.floor(value * 100) / 100;
}

</script>


<script>
$('#principalCycle').change(function () {
    if ($(this).val() !== 'Single Payment') {
        // Disable "Single Payment" option in #interestCycle
        $('#interestCycle option').each(function () {
            if ($(this).val() === 'Single Payment') {
                $(this).prop('disabled', true);
            }
        });

        // If currently selected option is "Single Payment", reset to another value
        if ($('#interestCycle').val() === 'Single Payment') {
            $('#interestCycle').val('');
        }
    } else {
        // Re-enable "Single Payment" option if principalCycle is set to "Single Payment"
        $('#interestCycle option').each(function () {
            if ($(this).val() === 'Single Payment') {
                $(this).prop('disabled', false);
            }
        });
    }
});
</script>

<script>
function downloadAsPDF() {
    // Select the HTML element containing the content you want to convert to PDF
    var element = document.body;
    
    // Configure the options for the PDF generation
    var opt = {
        margin:       0, // Default margin
        filename:     'document.pdf',
        image:        { type: 'jpeg', quality: 1 }, // Full quality
        html2canvas:  { scale: 1 }, // Scale set to 75%
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait', putOnlyUsedFonts: true, fontSize: 9, scale: 0.50 } // Set paper size to letter, scale to 75%
    };

    // Call the html2pdf function with the element and options
    html2pdf()
        .from(element)
        .set(opt)
        .save();
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const loanThis = document.getElementById("loanAmount");

        function formatWithCommas(value) {
            if (!value) return "";
            const number = parseFloat(value.toString().replace(/,/g, ''));
            return isNaN(number) ? "" : number.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function removeCommas(value) {
            return value.toString().replace(/,/g, '');
        }

        loanThis.addEventListener("click", function () { // for click
            this.value = formatWithCommas(this.value);
        });

        loanThis.addEventListener("blur", function () {
            this.value = removeCommas(this.value);
        });
        

        document.getElementById("loanAmount").addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        });

    });
</script>

<script>
function customPrint() {
    document.body.classList.add('print-preview');

    const containers = document.querySelectorAll('.container');
    containers.forEach(container => {
        container.style.width = '100%';
        container.style.maxWidth = '100%';
    });

    window.print();

    window.onafterprint = () => {
        document.body.classList.remove('print-preview');
        containers.forEach(container => {
            container.style.width = '';
            container.style.maxWidth = '';
        });
    };
}
</script>

</body>
</html>