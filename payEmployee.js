
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('flexCheckDefault').addEventListener('change', function() {
        var hiddenDiv = document.getElementById('deductions');
        if (this.checked) {
            hiddenDiv.style.display = 'block';
        } else {
            hiddenDiv.style.display = 'none';
        }
    });
});

function sendInputValue() {
        
    
    $('.slipDateOfPayment').text(formattedDateStr);
    $('.slipBranch').text(branch.toLocaleString());
    $('.slipPayPeriod').text(payperiod.toLocaleString());
    $('.slipID').text(idNumber.toLocaleString());
    $('.slipName').text(employee.toLocaleString());
    $('.slipPosition').text(position.toLocaleString());
    // EARNINGS
    if (basicpay !== 0){
    $('.data-basicPay').text(parseFloat(basicpay).toLocaleString(undefined, options));
    }else{
    $('.data-basicPay').text('0.00');
    }
    if(valot !== 0){
    $('.data-otPay').text(parseFloat(valot).toLocaleString(undefined, options));
    }
    if (riceallowance !== '0.00'){
    $('.data-riceAllow').text(parseFloat(riceallowance).toLocaleString(undefined, options));
    }else{
        $('.data-riceAllow').text('0.00');
    }
    if (transpoAllow !== '0.00'){
    $('.data-transpoAllow').text(parseFloat(transpoAllow).toLocaleString(undefined, options));
    }else{
        $('.data-transpoAllow').text('0.00');
    }
    $('.data-totalEarnings').text(parseFloat(totalearnings).toLocaleString(undefined, options));
    if (valother !== '0.00'){
    $('.data-otherPay').text(parseFloat(valother).toLocaleString(undefined, options));
    }else{
        $('.data-otherPay').text('0.00');
    }
    // DEDUCTIONS
    if (deduction == 0){
        $('.data-totalDeducts').text('0.00');
    }else{
        $('.data-totalDeducts').text(deduction.toLocaleString(undefined, options));
    }
    if (vallate == 0){
        $('.data-lates').text('0.00');
    }else{
        $('.data-lates').text(parseFloat(vallate).toLocaleString(undefined, options));
    }
    if (valabsent == 0){
        $('.data-absent').text('0.00');
    }else{
        $('.data-absent').text(parseFloat(valabsent).toLocaleString(undefined, options));
    }
    if (valsss == 0){
        $('.data-sss').text('0.00');
    }else{
        $('.data-sss').text(parseFloat(valsss).toLocaleString(undefined, options));
    }
    if (valsssmp == 0){
        $('.data-sssMand').text('0.00');
    }else{
        $('.data-sssMand').text(parseFloat(valsssmp).toLocaleString(undefined, options));
    }
    if (valpagibig == 0){
        $('.data-pagibig').text('0.00');
    }else{
        $('.data-pagibig').text(parseFloat(valpagibig).toLocaleString(undefined, options));
    }
    if (valphilhealth == 0){
        $('.data-philhealth').text('0.00');
    }else{
        $('.data-philhealth').text(parseFloat(valphilhealth).toLocaleString(undefined, options));
    }
    if (valsssloan == 0){
        $('.data-sssLoan').text('0.00');
    }else{
        $('.data-sssLoan').text(parseFloat(valsssloan).toLocaleString(undefined, options));
    }
    if (valwhtax == 0){
        $('.data-withholdingTax').text('0.00');
    }else{
        $('.data-withholdingTax').text(parseFloat(valwhtax).toLocaleString(undefined, options));
    }
    if (valdeduct == 0){
        $('.data-otherDeduction').text('0.00');
    }else{
        $('.data-otherDeduction').text(parseFloat(valdeduct).toLocaleString(undefined, options));
    }
    if (valemploan == 0){
        $('.data-employeeLoan').text('0.00');
    }else{
        $('.data-employeeLoan').text(parseFloat(valemploan).toLocaleString(undefined, options));
    }
    // NETPAY
    $('.data-netSalary').text(netpay.toLocaleString(undefined, options));
    }

    var empId = $('#idNumber').val();

$('#selectDate').change(function(){
    var date = $(selectDate).val();
    
   
    var selecteddate = $(this).find('option:selected').text();

    console.log(date);

    $('#paymentDate').val(selecteddate);
    // Extract the day of the month from the date (format: yyyy-mm-dd)
    var dayOfMonth = parseInt(date.split('-')[2]); 
    var options = JSON.parse($('#post_array').val());


    var selectedOption = options.find(option => option.date === selecteddate);

    if (selectedOption) {
        $('#startdateoutput').val(selectedOption.startdate);
        $('#enddateoutput').val(selectedOption.enddate);
    } else {
        $('#startdateoutput').val('');
        $('#enddateoutput').val('');
    }

  var startdate = $('#startdateoutput').val();
  var enddate = $('#enddateoutput').val();

requests.push($.ajax({
    url: 'payabsent.php',
    type: 'POST',
    data: { startdateoutput: startdate, enddateoutput: enddate, empId:empId },
    success: function(response) {

        $('#absent').val(response); // Update the value of the absent field
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
    }
}));

requests.push($.ajax({
    url: 'paylate.php',
    type: 'POST',
    data: { startdateoutput: startdate, enddateoutput: enddate, empId:empId },
    success: function(response) {
        $('#lates').val(response);
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
    }   
})); 

requests.push($.ajax({
    url: 'payother.php',
    type: 'POST',
    data: { startdateoutput: startdate, enddateoutput: enddate,empId:empId },
    success: function(response) {
        if (response === '' || response === '0') {
            $('#otherPay').val('0.00');
        } else {
            $('#otherPay').val(response);
        }
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
    }   
}));   

requests.push($.ajax({
    url: 'paydeduct.php',
    type: 'POST',
    data: { startdateoutput: startdate, enddateoutput: enddate,empId:empId },
    success: function(response) {
        if (response === '' || response === '0') {
            $('#otherDeduction').val('0.00');
        } else {
            $('#otherDeduction').val(response);
        }

    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
    }   
})); 

requests.push($.ajax({
url: 'payovertime.php',
type: 'POST',
data: { startdateoutput: startdate, enddateoutput: enddate, empId:empId },
success: function(response) {
    console.log(response);
    $('#overtimePay').val(response); // Update the value of the absent field
},
error: function(xhr, status, error) {
    console.error('AJAX Error:', status, error);
} 
})); 



requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: { data_to_retrieve: 'basicsalary',
            startdateoutput: startdate,
            enddateoutput: enddate,
            empId:empId },
    success: function(response) {
        var pay = +response / 2;

        if (response == 0){
            $('#salary').val('0.00');
        }else{
            $('#salary').val(pay);
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
        
    }
}));


requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'riceallowance',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#riceAllow').val(response);

        if (dayOfMonth == 15) {
            $('#riceAllow').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#riceAllow').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'transpo',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#transpoAllow').val(response);
        if (dayOfMonth == 15) {
            $('#transpoAllow').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#transpoAllow').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'sss',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#sss').val(response);

        if (dayOfMonth == 15) {
            $('#sss').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#sss').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'sssmand',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {   
        $('#sssMand').val(response);

        if (dayOfMonth == 15) {
            $('#sssMand').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#sssMand').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));


requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'pagibig',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#pagibig').val(response);

        if (dayOfMonth == 15) {
            $('#pagibig').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#pagibig').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'philhealth',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#philhealth').val(response);

        if (dayOfMonth == 15) {
            $('#philhealth').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#philhealth').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'sssloan',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#sssLoan').val(response);
        if (dayOfMonth == 15) {
            $('#sssLoan').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#sssLoan').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'tax',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#withholdingTax').val(response);
        if (dayOfMonth == 15) {
            $('#withholdingTax').val('0.00');
        }
        if (response == 0 || response == "") {
            $('#withholdingTax').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'slPayment',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#slPayment').val(response);
        console.log(response);
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'slCutoffSelect',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        $('#slCutoffSelect').val(response);
        console.log(response);
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

requests.push($.ajax({
    type: 'POST',
    url: 'paySalary.php',
    data: {  data_to_retrieve: 'slAmortization',
    startdateoutput: startdate,
    enddateoutput: enddate,
    empId : empId }, 
    success: function(response) {
        var slPayment =  $('#slPayment').val();
        var slCutoffSelect =  $('#slCutoffSelect').val();
        console.log(dayOfMonth);
        console.log(slCutoffSelect);

        if (slPayment == 1 && slCutoffSelect == 'Firstcutoff' && dayOfMonth == 15) {
            $('#employeeLoan').val(response);
        }else if(slPayment == 1 && slCutoffSelect == 'Lastcutoff' && dayOfMonth !== 15) {
            $('#employeeLoan').val(response);
        }else if (slPayment == 2 ){
            $('#employeeLoan').val(response);
        }else{
            $('#employeeLoan').val('0.00');
        }
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
}));

if (dayOfMonth !== 15) {
    $('#payPeriod').val('Last Cut Off'); // Set the value to "Last Cut Off"
}
if (dayOfMonth == 15) {
    $('#payPeriod').val('First Cut Off'); // Set the value to "First Cut Off"
    
} 
});

function formattedDate(date) {
    // Convert original date string to Date object
    var originalDate = new Date(date);
    
    // Array of month names
    var monthNames = ["January", "February", "March", "April", "May", "June",
                      "July", "August", "September", "October", "November", "December"];
    
    // Get month, day, and year components from the Date object
    var month = monthNames[originalDate.getMonth()];
    var day = originalDate.getDate();
    var year = originalDate.getFullYear();
    
    // Construct the new date string in the desired format
    var newDateStr = month + " " + day + ", " + year;

    return newDateStr;
}


function refresh(){
    location.reload();
} 