<?php
include('connection.php');

$date = $_POST['date'];
$periodpay = $_POST['periodpay'];
$formattedDate = date("F j, Y", strtotime($date));
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$valsort = $_POST['valsort'];
$branch = $_POST['branch'];

$startdate = mysqli_real_escape_string($con, $startdate);
$enddate = mysqli_real_escape_string($con, $enddate);
$branch = mysqli_real_escape_string($con, $branch);

if (isset($valsort)) {
    if($valsort === 'employeeId'){
        $sql = "SELECT pe.*, acc.*
        FROM pay_earnings pe
        JOIN accounts acc ON pe.employeeId = acc.employeeId
        WHERE pe.datemodified <=  '$enddate' 
        AND pe.branch = '$branch' 
        GROUP BY acc.employeeId ORDER BY acc.employeeId ASC";
    }else if($valsort === 'Name') {
        $sql = "SELECT pe.*, acc.*
        FROM pay_earnings pe
        JOIN accounts acc ON pe.employeeId = acc.employeeId
        WHERE pe.datemodified <=  '$enddate' 
        AND pe.branch ='$branch'
        GROUP BY acc.employeeId ORDER BY pe.name ASC";
    }else if($valsort === 'Branch') {
        $sql = "SELECT pe.*, acc.*
        FROM pay_earnings pe
        JOIN accounts acc ON pe.employeeId = acc.employeeId
        WHERE pe.datemodified <=  '$enddate' 
        AND pe.branch = '$branch'
        GROUP BY acc.employeeId ORDER BY acc.address ASC";
    } else{
        $sql = "SELECT pe.*, acc.*
        FROM pay_earnings pe
        JOIN accounts acc ON pe.employeeId = acc.employeeId
        WHERE pe.datemodified <= '$enddate' 
        AND pe.branch = '$branch' GROUP BY acc.employeeId ";
    }
} else {
        $sql = "SELECT pe.*, acc.*
        FROM pay_earnings pe
        JOIN accounts acc ON pe.employeeId = acc.employeeId
        WHERE pe.datemodified <= '$enddate' 
        AND pe.branch = $branch  GROUP BY acc.employeeId";
}

$result = mysqli_query($con, $sql);

$tbody = "";
$index = 1;
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $empId = $row['employeeId'];    
            $tbody .= '<div id="payslip-content-' . $index . '" class="p-5 border border-black container-fluid d-flex flex-column">';
            $tbody .= '<div class="p-2 slip">';
            $tbody .= '<img width="50%" height="120px"style="display:block;"   id="slip-logo" src="http://localhost/dashboard/logo/logo.png" alt="slip-logo">';
            $tbody .= '<div class="align-items-end d-flex flex-column">';
            $tbody .= '<h3>PAYSLIP</h3>';
            $tbody .= '<span>Date of Payment: <strong>'.$formattedDate.'</strong></span>';
            $tbody .= '<span class="ml-auto">Branch: <strong>'.$row["branch"].'</strong></span>'; 
            $tbody .= '<span>Pay Period: <strong>'.$periodpay.'</strong></span>';
            $tbody .= '</div>';
            $tbody .= '<div class="align-items-start d-flex flex-column">';
            $tbody .= '<span>Employee ID: <strong>'.$row["employeeId"].'</strong></span>'; 
            $tbody .= '<span>Employee Name: <strong>'.$row["name"].'</strong></span>';       
            $tbody .= '<span>Position: <strong>'.$row["bankPosition"].'</strong></span>'; 
            $tbody .= '</div>';
            $tbody .= '<table class=" table">';     
            $tbody .= '<tr>
                        <th scope="col">EARNINGS</th>
                        <th scope="col"></th>
                        <th scope="col">DEDUCTIONS</th>
                        <th scope="col"></th>
                        </tr>';  
            $tbody .= '<tr>';
            $tbody .= '<td class="col"><strong>Basic Pay</strong></td>';  
            $tbody .= '<td class="earning' . $index . '" id="salary' . $index . '"></td>';
            $tbody .= '<td class="col"><strong>SSS</strong></td>';  
            $tbody .= '<td class="deduction' . $index . '" id="sss' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"><strong>Transpo. Allow.</strong></td>'; 
            $tbody .= '<td class="earning' . $index . '" id="transpoAllow' . $index . '"></td>';
            $tbody .= '<td class="col"><strong>SSS Mand. Provident</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="sssmand' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"><strong>Rice Allowance</strong></td>'; 
            $tbody .= '<td class="earning' . $index . '" id="riceallow' . $index . '"></td>';
            $tbody .= '<td class="col"><strong>Pagibig</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="pagibig' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"><strong>Overtime Pay</strong></td>'; 
            $tbody .= '<td class="earning' . $index . '" id="overtimePay' . $index . '"></td>';
            $tbody .= '<td class="col"><strong>Philhealth</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="philhealth' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"><strong>Other</strong></td>'; 
            $tbody .= '<td class="earning' . $index . '" id="otherpay' . $index . '"></td>';
            $tbody .= '<td class="col"><strong>SSS Loan</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="sssloan' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"></td>'; 
            $tbody .= '<td></td>';
            $tbody .= '<td class="col"><strong>Employee Loan</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="employeeloan' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"></td>'; 
            $tbody .= '<td></td>';
            $tbody .= '<td class="col"><strong>Withholding Tax</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="tax' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"></td>'; 
            $tbody .= '<td></td>';
            $tbody .= '<td class="col"><strong>Absent</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="absent' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"></td>'; 
            $tbody .= '<td></td>';
            $tbody .= '<td class="col"><strong>Lates</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="late' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"></td>'; 
            $tbody .= '<td></td>';
            $tbody .= '<td class="col"><strong>Other</strong></td>'; 
            $tbody .= '<td class="deduction' . $index . '" id="otherDeduction' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"><strong>TOTAL EARNINGS</strong></td>'; 
            $tbody .= '<td id="totalearnings' . $index . '"></td>';
            $tbody .= '<td class="col"><strong>TOTAL DEDUCTIONS</strong></td>'; 
            $tbody .= '<td id="totaldeduction' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '<tr>';
            $tbody .= '<td class="col"></td>'; 
            $tbody .= '<td></td>';
            $tbody .= '<td class="col table-dark">NET SALARY</td>'; 
            $tbody .= '<td class ="table-dark"id="netpay' . $index . '"></td>';
            $tbody .= '</tr>';
            $tbody .= '</table>';
            $tbody .= '</div>';   
            $tbody .= '<div class="ms-auto">';
            $tbody .= '<button type="button" class="m-3 btn btn-primary btn-md print-btn" data-index="' . $index . '">Save As PDF/Print</button>'; 
            $tbody .= '</div>'; 
            $tbody .= '</div>';
            $tbody .= '<input type ="hidden" id="slpayment' . $index . '"></input>';
            $tbody .= '<input type ="hidden" id="pay' . $index . '"></input>';
            $tbody .= '<input type ="hidden" id="slCutoffSelect' . $index . '"></input>';
            
            echo "<script>
            $(document).ready(function () {
                var date = '" . $date . "';
                var startdate = '" . $startdate . "';
                var enddate = '" . $enddate . "';
                var empId = '" . $empId . "';
                var dayOfMonth = parseInt(date.split('-')[2]);
                var currentIndex = " . $index . ";
                const options = { maximumFractionDigits: 2 };
            
                var requests = [];
            
                // Helper function to handle response text updates
                function updateText(selector, response) {
                    $(selector).text(parseFloat(response).toLocaleString(undefined, options));
                }
            
                // Basicsalary AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'basicsalary', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var pay = +response / 2;
                        var monthly = '#pay' + currentIndex;
                        $(monthly).text(response);
                        var selector = '#salary' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : pay);
                    }
                }));
            
                // Rice allowance AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'riceallowance', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#riceallow' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // Transportation allowance AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'transpo', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#transpoAllow' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // Overtime pay AJAX call
                requests.push($.ajax({
                    url: 'payovertime.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var monthly = '#pay' + currentIndex;
                        var valselector = $(monthly).text();
                        var perday = valselector / 22;
                        var perhour = perday / 8;
                        var otrate = perhour + (perhour * 0.3);
                        var otpay = response * otrate;
                        var selector = '#overtimePay' + currentIndex;
                        $(selector).text(response == 0 || response == '' ? '0.00' :otpay.toFixed(2));
                    }
                }));            
                // Late pay AJAX call
                requests.push($.ajax({
                    url: 'paylate.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var monthly = '#pay' + currentIndex;
                        var valselector = $(monthly).text();
                        var perday = +valselector / 22;
                        var perhour = perday / 8;
                        var latepay = response * perhour;
                        var selector = '#late' + currentIndex;
                        $(selector).text(latepay == 0 || latepay == '' ? '0.00' : latepay.toFixed(2));

                    }
                }));
            
                // Absent pay AJAX call
                requests.push($.ajax({
                    url: 'payabsent.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var monthly = '#pay' + currentIndex;
                        var valselector = $(monthly).text();
                        var perday = +valselector / 22;
                        var absentpay = perday * response;
                        var selector = '#absent' + currentIndex;
                        $(selector).text(absentpay == 0 || absentpay == '' ? '0.00' : absentpay.toFixed(2));
                    }
                }));
            
                // Other pay AJAX call
                requests.push($.ajax({
                    url: 'payother.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#otherpay' + currentIndex;
                        $(selector).text(response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // SSS AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'sss', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#sss' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // SSS mandatory AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'sssmand', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#sssmand' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // Pag-IBIG AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'pagibig', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#pagibig' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // PhilHealth AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'philhealth', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#philhealth' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // SSS loan AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'sssloan', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#sssloan' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // Tax AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'tax', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#tax' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));

                // SSSloan AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'sssloan', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#sssloan' + currentIndex;
                        $(selector).text(dayOfMonth == 15 || response == 0 || response == '' ? '0.00' : response);
                    }
                }));
            
                // Salary loan payment AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'slPayment', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#slpayment' + currentIndex;
                        $(selector).text(response);
                    }
                }));

                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'slCutoffSelect', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selector = '#slCutoffSelect' + currentIndex;
                        $(selector).text(response);
                    }
                }));
    
                // Salary loan amortization AJAX call
                requests.push($.ajax({
                    type: 'POST',
                    url: 'paySalary.php',
                    data: { data_to_retrieve: 'slAmortization', startdateoutput: startdate, enddateoutput: enddate, empId: empId },
                    success: function(response) {
                        var selectorSLPayment = '#slpayment' + currentIndex;
                        var selectorslCutoffSelect = '#slCutoffSelect' + currentIndex;
                        var selectorEmployeeLoan = '#employeeloan' + currentIndex;
                        var valSLPayment = $(selectorSLPayment).text();
                        var valslCutoffSelect = $(selectorslCutoffSelect).text();
                      
                        if (valSLPayment == 1 && dayOfMonth == 15 && valslCutoffSelect == 'Firstcutoff') {
                            $(selectorEmployeeLoan).text(response);
                        }else if (valSLPayment == 1 && dayOfMonth !== 15 && valslCutoffSelect == 'Lastcutoff'){
                            $(selectorEmployeeLoan).text(response);
                        } else if (valSLPayment == 2) {
                            $(selectorEmployeeLoan).text(response);
                        } else {
                            $(selectorEmployeeLoan).text('0.00');
                        }
                    }
                }));

                $.ajax({
                    url: 'paydeduct.php',
                    type: 'POST',
                    data: { startdateoutput: startdate, enddateoutput: enddate,empId:empId },
                    success: function(response) {
                        var selectorotherDeduct = '#otherDeduction' + currentIndex;

                        if (response === '' || response === '0') {
                            $(selectorotherDeduct).text('0.00');
                        } else {
                            $(selectorotherDeduct).text(response);
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }   
                }); 
            
                // Wait for all AJAX requests to complete before calculating total deductions
                $.when.apply($, requests).then(function() {

                    var selectDeductions = '.deduction' + currentIndex;
                    var totalDeductions = 0;
            
                    $(selectDeductions).each(function() {
                        var deductionValue = parseFloat($(this).text());

                        if (!isNaN(deductionValue)) {
                            totalDeductions += deductionValue;
                        }
                    });
            
                    var selectorTotalDeductions = '#totaldeduction' + currentIndex;
                    $(selectorTotalDeductions).text(addCommasToNumber(totalDeductions.toFixed(2)));

                    var selectearnings = '.earning' + currentIndex;
                    var totalEarning = 0;

                    $(selectearnings).each(function() {
                        var earningValue = parseFloat($(this).text());

                        if (!isNaN(earningValue)) {
                            totalEarning += earningValue;
                        }
                    });

                    var selectorTotalEarnings = '#totalearnings' + currentIndex;
                    $(selectorTotalEarnings).text(addCommasToNumber(totalEarning.toFixed(2)));

                    var selectorNetpay = '#netpay' + currentIndex;
                    var totalnetpay = +totalEarning - +totalDeductions;
                    $(selectorNetpay).text(addCommasToNumber(totalnetpay.toFixed(2)));

                });

                function beforePrint() {
                    $('.print-btn').addClass('d-none');
                    $('.slip').css('border', '1px dashed');
                }

                function afterPrint() {
                    $('.print-btn').removeClass('d-none');
                    $('.slip').css('border', '1px dashed');
                }

                if (window.matchMedia) {
                    var mediaQueryList = window.matchMedia('print');
                    mediaQueryList.addListener(function(mql) {
                        if (mql.matches) {
                            beforePrint();
                        } else {
                            afterPrint();
                        }
                    });
                }

            });
            </script>";
        
        $index++;
        }
    } else {
        $tbody = "<tr><td colspan='2'>No records found</td></tr>";
    }
} else {
    // Handle SQL error
    $error_message = mysqli_error($con);
    $tbody = "<tr><td colspan='2'>Error: $error_message</td></tr>";
}
?>

<div class="container-fluid">
    <?php echo $tbody; ?>
</div>
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
    function addCommasToNumber(number) {
return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

$(".print-btn").click(function() {
    var index = $(this).data("index");
    var printContents = document.getElementById("payslip-content-" + index).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
});

</script>
<style>
.slip{
    text-align: left;
    border: 1px dashed;
    padding: 5%;
}

@media print {
    .print-btn {
    display: none;
    }
    .slip {
        border: 1px dashed !important;
    }
}

</style>

