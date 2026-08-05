<?php
include('connection.php');

$startdate = mysqli_real_escape_string($con, $_POST['startdate']);
$enddate = mysqli_real_escape_string($con, $_POST['enddate']);
$date = mysqli_real_escape_string($con, $_POST['date']);
$valsort = mysqli_real_escape_string($con, $_POST['valsort']);
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$approved = mysqli_real_escape_string($con, $_POST['approved']);
$approve = mysqli_real_escape_string($con, $_POST['approve']);
$status = mysqli_real_escape_string($con, $_POST['status']);


$startdate = mysqli_real_escape_string($con, $startdate);
$enddate = mysqli_real_escape_string($con, $enddate);
$branch = mysqli_real_escape_string($con, $branch);
$date = mysqli_real_escape_string($con, $date);

if ($status == 0 || $status == '') {
    $sql = "SELECT pe.*, acc.employeeId as acc_employeeId, acc.*, ploan.employeeId as ploan_employeeId, ploan.*
    FROM pay_earningshr pe
    JOIN accounts acc ON pe.employeeId = acc.employeeId
    LEFT JOIN pay_earningsloan ploan ON ploan.employeeId = acc.employeeId";

    if (!empty($branch)) {
        $sql .= " WHERE pe.datemodified <= '$enddate' AND pe.branch = '$branch'";
    } else {
        $sql .= " WHERE pe.datemodified <= '$enddate'";
    }
    $sql .= " GROUP BY acc.employeeId";
} else {
    $sql = "SELECT pr.*,acc.*, acc.employeeId as acc_employeeId
    FROM   pr
    LEFT JOIN accounts acc ON pr.employeeId = acc.employeeId ";
   
    if (!empty($branch)) {
        $sql .= " WHERE pr.date = '$date' AND acc.address = '$branch'";
    } else{
        $sql .= " WHERE pr.date = '$date'";
    }

    $sql .= " GROUP BY acc.employeeId";
}

$result = mysqli_query($con, $sql);

$tbody = "";
$index = 1;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $empId = $row['acc_employeeId'];
        $name = $row['name'];
        $branch = $row['branch'];
        $tbody .= "<tr>";
        $tbody .= "<td>". $row['acc_employeeId'] ."</td>";
        $tbody .= "<td>". $row['fullName'] ."</td>";
        $tbody .= "<td>". $row['bankPosition'] ."</td>";
        $tbody .= "<td>". $row['address'] ."</td>";
        $tbody .= '<td  class="sssEmployee deductionEmployee' . $index . '" id="sssEmployee' . $index . '"></td>';
        $tbody .= '<td  class="sssmandEmployee deductionEmployee' . $index . '" id="sssmandEmployee' . $index . '"></td>';
        $tbody .= '<td  class="pagibigEmployee deductionEmployee' . $index . '" id="pagibigEmployee' . $index . '"></td>';
        $tbody .= '<td  class="philhealthEmployee deductionEmployee' . $index . '" id="philhealthEmployee' . $index . '"></td>';
        $tbody .= '<td  class="sssEmployer deduction' . $index . '" id="sssEmployer' . $index . '"></td>';
        $tbody .= '<td  class="sssmandEmployer deduction' . $index . '" id="sssmandEmployer' . $index . '"></td>';
        $tbody .= '<td  class="pagibigEmployer deduction' . $index . '" id="pagibigEmployer' . $index . '"></td>';
        $tbody .= '<td  class="philhealthEmployer deduction' . $index . '" id="philhealthEmployer' . $index . '"></td>';
        $tbody .= '<td  class="totaldeductionEmployee" id="totaldeductionEmployee' . $index . '"></td>';
        $tbody .= '<td  class="totaldeductionEmployer" id="totaldeductionEmployer' . $index . '"></td>';
        $tbody .= '<td  class="totaldeduction" id="totaldeduction' . $index . '"></td>';
        $tbody .= "</tr>";

        if($status == 0 || $status == ''){

        echo "<script>
        $(document).ready(function () {
            var date = '" . $date . "';
            var startdate = '" . $startdate . "';
            var approved = '" . $approved . "';
            var approve = '" . $approve . "';
            var enddate = '" . $enddate . "';
            var empId = '" . $empId . "';
            var name = '" . $name . "';
            var branch = '" . $branch . "';
            var currentIndex = '" . $index . "';
            var dayOfMonth = parseInt(date.split('-')[2]);
        
            var requests = [];

            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'sss',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#sssEmployee' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));

            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'sssmand',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#sssmandEmployee' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));

            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'pagibig',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#pagibigEmployee' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));

            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'philhealth',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#philhealthEmployee' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));

            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'sssEmployer',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#sssEmployer' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));

            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'sssmandEmployer',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#sssmandEmployer' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));
            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'pagibigEmployer',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#pagibigEmployer' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));
            requests.push($.ajax({
                type: 'POST',
                url: 'paySalary.php',
                data: {
                    data_to_retrieve: 'philhealthEmployer',
                    startdateoutput: startdate,
                    enddateoutput: enddate,
                    empId: empId
                },
                success: function(response) {
                    var selector = '#philhealthEmployer' + currentIndex;
                    $(selector).text(response == 0 ? '0.00' : response);
                    console.log(response);
                }
            }));
            $.when.apply($, requests).then(function() {

             var totalSSSEmployee = 0;

             $('.sssEmployee').each(function() {
                var totalsssEmployeetext = $(this).text().replace(/,/g, '');
                var sssEmployee = parseFloat(totalsssEmployeetext);
                if (!isNaN(sssEmployee)) {
                    totalSSSEmployee += sssEmployee;
                }
            });

            $('#totalsssEmployee').text(addCommasToNumber(totalSSSEmployee.toFixed(2)));

            var totalSSSMANDEmployee = 0;

             $('.sssmandEmployee').each(function() {
                var totalsssmandEmployeetext = $(this).text().replace(/,/g, '');
                var sssmandEmployee = parseFloat(totalsssmandEmployeetext);
                if (!isNaN(sssmandEmployee)) {
                    totalSSSMANDEmployee += sssmandEmployee;
                }
            });

            $('#totalsssmandEmployee').text(addCommasToNumber(totalSSSMANDEmployee.toFixed(2)));

            var totalPAGIBIGEmployee = 0;

             $('.pagibigEmployee').each(function() {
                var totalpagibigEmployeetext = $(this).text().replace(/,/g, '');
                var pagibigEmployee = parseFloat(totalpagibigEmployeetext);
                if (!isNaN(pagibigEmployee)) {
                    totalPAGIBIGEmployee += pagibigEmployee;
                }
            });

            $('#totalpagibigEmployee').text(addCommasToNumber(totalPAGIBIGEmployee.toFixed(2)));

            var totalPHILHEALTHEmployee = 0;

             $('.philhealthEmployee').each(function() {
                var totalphilhealthEmployeetext = $(this).text().replace(/,/g, '');
                var philhealthEmployee = parseFloat(totalphilhealthEmployeetext);
                if (!isNaN(philhealthEmployee)) {
                    totalPHILHEALTHEmployee += philhealthEmployee;
                }
            });

            $('#totalphilhealthEmployee').text(addCommasToNumber(totalPHILHEALTHEmployee.toFixed(2)));

             var totalSSSEmployer = 0;

             $('.sssEmployer').each(function() {
                var totalsssEmployertext = $(this).text().replace(/,/g, '');
                var sssEmployer = parseFloat(totalsssEmployertext);
                if (!isNaN(sssEmployer)) {
                    totalSSSEmployer += sssEmployer;
                }
            });

            $('#totalsssEmployer').text(addCommasToNumber(totalSSSEmployer.toFixed(2)));

            var totalSSSMANDEmployer = 0;

             $('.sssmandEmployer').each(function() {
                var totalsssmandEmployertext = $(this).text().replace(/,/g, '');
                var sssmandEmployer = parseFloat(totalsssmandEmployertext);
                if (!isNaN(sssmandEmployer)) {
                    totalSSSMANDEmployer += sssmandEmployer;
                }
            });

            $('#totalsssmandEmployer').text(addCommasToNumber(totalSSSMANDEmployer.toFixed(2)));

            var totalPAGIBIGEmployer = 0;

             $('.pagibigEmployer').each(function() {
                var totalpagibigEmployertext = $(this).text().replace(/,/g, '');
                var pagibigEmployer = parseFloat(totalpagibigEmployertext);
                if (!isNaN(pagibigEmployer)) {
                    totalPAGIBIGEmployer += pagibigEmployer;
                }
            });

            $('#totalpagibigEmployer').text(addCommasToNumber(totalPAGIBIGEmployer.toFixed(2)));

            var totalPHILHEALTHEmployer = 0;

             $('.philhealthEmployer').each(function() {
                var totalphilhealthEmployertext = $(this).text().replace(/,/g, '');
                var philhealthEmployer = parseFloat(totalphilhealthEmployertext);
                if (!isNaN(philhealthEmployer)) {
                    totalPHILHEALTHEmployer += philhealthEmployer;
                }
            });

            $('#totalphilhealthEmployer').text(addCommasToNumber(totalPHILHEALTHEmployer.toFixed(2)));

            var selectDeductions = '.deduction' + currentIndex;
            var totalDeductions = 0;
            
            $(selectDeductions).each(function() {
                var deductionValue = parseFloat($(this).text());
                if (!isNaN(deductionValue)) {
                    totalDeductions += deductionValue;
                }
            });
    
            var selectorTotalDeductions = '#totaldeductionEmployer' + currentIndex;
            $(selectorTotalDeductions).text(addCommasToNumber(totalDeductions.toFixed(2)));

            var totalDeduction = 0;

             $('.totaldeductionEmployer').each(function() {
                var totalDeductiontext = $(this).text().replace(/,/g, '');
                var totaldeductionemployer = parseFloat(totalDeductiontext);
                if (!isNaN(totaldeductionemployer)) {
                    totalDeduction += totaldeductionemployer;
                }
            });

            $('#totalDeductionEmployer').text(addCommasToNumber(totalDeduction.toFixed(2)));

            var selectDeductionsEmployee = '.deductionEmployee' + currentIndex;
            var totalDeductionsEmployee = 0;
            
            $(selectDeductionsEmployee).each(function() {
                var deductionEmployeeValue = parseFloat($(this).text());
                if (!isNaN(deductionEmployeeValue)) {
                    totalDeductionsEmployee += deductionEmployeeValue;
                }
            });
    
            var selectorTotalDeductionsEmployee = '#totaldeductionEmployee' + currentIndex;
            $(selectorTotalDeductionsEmployee).text(addCommasToNumber(totalDeductionsEmployee.toFixed(2)));

            var total = totalDeductionsEmployee + totalDeductions;

            var totalDeductionEmployee = 0;

             $('.totaldeductionEmployee').each(function() {
                var totalDeductionEmployeetext = $(this).text().replace(/,/g, '');
                var totaldeductionemployee = parseFloat(totalDeductionEmployeetext);
                if (!isNaN(totaldeductionemployee)) {
                    totalDeductionEmployee += totaldeductionemployee;
                }
            });

            $('#totalDeductionEmployee').text(addCommasToNumber(totalDeductionEmployee.toFixed(2)));

            
            var selectorTotalDeductionsEmployee = '#totaldeduction' + currentIndex;
            $(selectorTotalDeductionsEmployee).text(addCommasToNumber(total.toFixed(2)));

         
            var totalDeductionEmployeeEmployer = 0;

            $('.totaldeduction').each(function() {
                var totalDeductionEmployeeEmployertext = $(this).text().replace(/,/g, '');
                var totaldeductionemployeeemployer = parseFloat(totalDeductionEmployeeEmployertext);
                if (!isNaN(totaldeductionemployeeemployer)) {
                    totalDeductionEmployeeEmployer += totaldeductionemployeeemployer;
                }
            });

            $('#totalDeduction').text(addCommasToNumber(totalDeductionEmployeeEmployer.toFixed(2)));


            $('#reporttbl').DataTable().destroy();
                var myTable = $('#reporttbl').DataTable({
            });

            });
        });
        </script>";
        }else{
            echo "<script>
            $(document).ready(function () {
                var date = '" . $date . "';
                var startdate = '" . $startdate . "';
                var approved = '" . $approved . "';
                var approve = '" . $approve . "';
                var enddate = '" . $enddate . "';
                var empId = '" . $empId . "';
                var name = '" . $name . "';
                var branch = '" . $branch . "';
                var currentIndex = '" . $index . "';
                var dayOfMonth = parseInt(date.split('-')[2]);
            
                var requests = [];
    
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'sss',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#sssEmployee' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
    
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'sssmand',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#sssmandEmployee' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
    
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'pagibig',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#pagibigEmployee' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
    
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'philhealth',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#philhealthEmployee' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
    
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'sssEmployer',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#sssEmployer' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
    
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'sssmandEmployer',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#sssmandEmployer' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'pagibigEmployer',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#pagibigEmployer' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
                requests.push($.ajax({
                    type: 'POST',
                    url: 'pay-salaryrecord.php',
                    data: {
                        data_to_retrieve: 'philhealthEmployer',
                        date : date,
                        empId: empId
                    },
                    success: function(response) {
                        var selector = '#philhealthEmployer' + currentIndex;
                        $(selector).text(response == 0 ? '0.00' : response);
                        console.log(response);
                    }
                }));
                $.when.apply($, requests).then(function() {
    
                 var totalSSSEmployee = 0;
    
                 $('.sssEmployee').each(function() {
                    var totalsssEmployeetext = $(this).text().replace(/,/g, '');
                    var sssEmployee = parseFloat(totalsssEmployeetext);
                    if (!isNaN(sssEmployee)) {
                        totalSSSEmployee += sssEmployee;
                    }
                });
    
                $('#totalsssEmployee').text(addCommasToNumber(totalSSSEmployee.toFixed(2)));
    
                var totalSSSMANDEmployee = 0;
    
                 $('.sssmandEmployee').each(function() {
                    var totalsssmandEmployeetext = $(this).text().replace(/,/g, '');
                    var sssmandEmployee = parseFloat(totalsssmandEmployeetext);
                    if (!isNaN(sssmandEmployee)) {
                        totalSSSMANDEmployee += sssmandEmployee;
                    }
                });
    
                $('#totalsssmandEmployee').text(addCommasToNumber(totalSSSMANDEmployee.toFixed(2)));
    
                var totalPAGIBIGEmployee = 0;
    
                 $('.pagibigEmployee').each(function() {
                    var totalpagibigEmployeetext = $(this).text().replace(/,/g, '');
                    var pagibigEmployee = parseFloat(totalpagibigEmployeetext);
                    if (!isNaN(pagibigEmployee)) {
                        totalPAGIBIGEmployee += pagibigEmployee;
                    }
                });
    
                $('#totalpagibigEmployee').text(addCommasToNumber(totalPAGIBIGEmployee.toFixed(2)));
    
                var totalPHILHEALTHEmployee = 0;
    
                 $('.philhealthEmployee').each(function() {
                    var totalphilhealthEmployeetext = $(this).text().replace(/,/g, '');
                    var philhealthEmployee = parseFloat(totalphilhealthEmployeetext);
                    if (!isNaN(philhealthEmployee)) {
                        totalPHILHEALTHEmployee += philhealthEmployee;
                    }
                });
    
                $('#totalphilhealthEmployee').text(addCommasToNumber(totalPHILHEALTHEmployee.toFixed(2)));
    
                 var totalSSSEmployer = 0;
    
                 $('.sssEmployer').each(function() {
                    var totalsssEmployertext = $(this).text().replace(/,/g, '');
                    var sssEmployer = parseFloat(totalsssEmployertext);
                    if (!isNaN(sssEmployer)) {
                        totalSSSEmployer += sssEmployer;
                    }
                });
    
                $('#totalsssEmployer').text(addCommasToNumber(totalSSSEmployer.toFixed(2)));
    
                var totalSSSMANDEmployer = 0;
    
                 $('.sssmandEmployer').each(function() {
                    var totalsssmandEmployertext = $(this).text().replace(/,/g, '');
                    var sssmandEmployer = parseFloat(totalsssmandEmployertext);
                    if (!isNaN(sssmandEmployer)) {
                        totalSSSMANDEmployer += sssmandEmployer;
                    }
                });
    
                $('#totalsssmandEmployer').text(addCommasToNumber(totalSSSMANDEmployer.toFixed(2)));
    
                var totalPAGIBIGEmployer = 0;
    
                 $('.pagibigEmployer').each(function() {
                    var totalpagibigEmployertext = $(this).text().replace(/,/g, '');
                    var pagibigEmployer = parseFloat(totalpagibigEmployertext);
                    if (!isNaN(pagibigEmployer)) {
                        totalPAGIBIGEmployer += pagibigEmployer;
                    }
                });
    
                $('#totalpagibigEmployer').text(addCommasToNumber(totalPAGIBIGEmployer.toFixed(2)));
    
                var totalPHILHEALTHEmployer = 0;
    
                 $('.philhealthEmployer').each(function() {
                    var totalphilhealthEmployertext = $(this).text().replace(/,/g, '');
                    var philhealthEmployer = parseFloat(totalphilhealthEmployertext);
                    if (!isNaN(philhealthEmployer)) {
                        totalPHILHEALTHEmployer += philhealthEmployer;
                    }
                });
    
                $('#totalphilhealthEmployer').text(addCommasToNumber(totalPHILHEALTHEmployer.toFixed(2)));
    
                var selectDeductions = '.deduction' + currentIndex;
                var totalDeductions = 0;
                
                $(selectDeductions).each(function() {
                    var deductionValue = parseFloat($(this).text());
                    if (!isNaN(deductionValue)) {
                        totalDeductions += deductionValue;
                    }
                });
        
                var selectorTotalDeductions = '#totaldeductionEmployer' + currentIndex;
                $(selectorTotalDeductions).text(addCommasToNumber(totalDeductions.toFixed(2)));
    
                var totalDeduction = 0;
    
                 $('.totaldeductionEmployer').each(function() {
                    var totalDeductiontext = $(this).text().replace(/,/g, '');
                    var totaldeductionemployer = parseFloat(totalDeductiontext);
                    if (!isNaN(totaldeductionemployer)) {
                        totalDeduction += totaldeductionemployer;
                    }
                });
    
                $('#totalDeductionEmployer').text(addCommasToNumber(totalDeduction.toFixed(2)));
    
                var selectDeductionsEmployee = '.deductionEmployee' + currentIndex;
                var totalDeductionsEmployee = 0;
                
                $(selectDeductionsEmployee).each(function() {
                    var deductionEmployeeValue = parseFloat($(this).text());
                    if (!isNaN(deductionEmployeeValue)) {
                        totalDeductionsEmployee += deductionEmployeeValue;
                    }
                });
        
                var selectorTotalDeductionsEmployee = '#totaldeductionEmployee' + currentIndex;
                $(selectorTotalDeductionsEmployee).text(addCommasToNumber(totalDeductionsEmployee.toFixed(2)));
    
                var total = totalDeductionsEmployee + totalDeductions;
    
                var totalDeductionEmployee = 0;
    
                 $('.totaldeductionEmployee').each(function() {
                    var totalDeductionEmployeetext = $(this).text().replace(/,/g, '');
                    var totaldeductionemployee = parseFloat(totalDeductionEmployeetext);
                    if (!isNaN(totaldeductionemployee)) {
                        totalDeductionEmployee += totaldeductionemployee;
                    }
                });
    
                $('#totalDeductionEmployee').text(addCommasToNumber(totalDeductionEmployee.toFixed(2)));
    
                
                var selectorTotalDeductionsEmployee = '#totaldeduction' + currentIndex;
                $(selectorTotalDeductionsEmployee).text(addCommasToNumber(total.toFixed(2)));
    
             
                var totalDeductionEmployeeEmployer = 0;
    
                $('.totaldeduction').each(function() {
                    var totalDeductionEmployeeEmployertext = $(this).text().replace(/,/g, '');
                    var totaldeductionemployeeemployer = parseFloat(totalDeductionEmployeeEmployertext);
                    if (!isNaN(totaldeductionemployeeemployer)) {
                        totalDeductionEmployeeEmployer += totaldeductionemployeeemployer;
                    }
                });
    
                $('#totalDeduction').text(addCommasToNumber(totalDeductionEmployeeEmployer.toFixed(2)));
    
    
                $('#reporttbl').DataTable().destroy();
                    var myTable = $('#reporttbl').DataTable({
                });
    
                });
            });
            </script>";
        }
    $index++;
    }
} else {
    $tbody = "<tr><td colspan='25'>No records found</td></tr>";
}
?>
<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<section class="leaveReport">
<div id="table-container" class="responsive-table" style="margin-top:20px;" >
            <table id="reporttbl" class="table table-bordered" style="width:100%" >
              <thead>
                <th class="text-center">Emp. ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Position</th>
                <th class="text-center">Branch</th>
                <th class="text-center">SSS (EE)</th>
                <th class="text-center">SSS Mand (EE)</th>
                <th class="text-center">Pagibig (EE)</th>
                <th class="text-center">Philhealth (EE)</th>
                <th class="text-center">SSS (ER)</th>
                <th class="text-center">SSS Mand (ER)</th>
                <th class="text-center">Pagibig (ER)</th>
                <th class="text-center">Philhealth (ER)</th>
                <th class="text-center">Total Deduction (EE)</th>
                <th class="text-center">Total Deduction (ER)</th>
                <th class="text-center">Total Deduction (EE & ER)</th>
              </thead>
              <tbody>
                <?php echo $tbody ?>
               <tr>
                    <td class="text-center bg-dark text-white" colspan="4"><strong>TOTAL</strong></td>
                    <td id="totalsssEmployee"></td>
                    <td id="totalsssmandEmployee"></td>
                    <td id="totalpagibigEmployee"></td>
                    <td id="totalphilhealthEmployee"></td>
                    <td id="totalsssEmployer"></td>
                    <td id="totalsssmandEmployer"></td>
                    <td id="totalpagibigEmployer"></td>
                    <td id="totalphilhealthEmployer"></td>
                    <td id="totalDeductionEmployee"></td>
                    <td id="totalDeductionEmployer"></td>
                    <td id="totalDeduction"></td>
                </tr>   
              </tbody>
            </table>
</div>
</section>                           <!-- Script -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script>
function addCommasToNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
</script>