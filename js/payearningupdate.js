$(document).ready(function(){

    var sssloanpayment = $('#sssloanPayment').val();
    
    if (sssloanpayment == 2) {
        $('.sssloan2').css("display", "");
        $(".sssloan2").prop("required", true);
        $('.sssloan1').css("display", "none");
        $(".sssloan1").prop("required", false);
    } else {
        $('.sssloan2').css("display", "none");
        $(".sssloan2").prop("required", false);
        $('.sssloan1').css("display", "");
        $(".sssloan1").prop("required", true);
    }
    
    if(sssloanpayment > 0){
        $('.sssloan').css("display", "");
        $(".sssloan").prop("required", true);
    }else{
        $('.sssloan').css("display", "none");
        $(".sssloan").prop("required", false);
    }

    var ssscalamitypayment = $('#ssscalamityPayment').val();
    
    if (ssscalamitypayment == 2) {
        $('.ssscalamity2').css("display", "");
        $(".ssscalamity2").prop("required", true);
        $('.ssscalamity1').css("display", "none");
        $(".ssscalamity1").prop("required", false);
    } else {
        $('.ssscalamity2').css("display", "none");
        $(".ssscalamity2").prop("required", false);
        $('.ssscalamity1').css("display", "");
        $(".ssscalamity1").prop("required", true);
    }  
    
    var pagibigloanpayment = $('#pagibigloanPayment').val();
    
    if (pagibigloanpayment == 2) {
        $('.pagibigloanpayment2').css("display", "");
        $(".pagibigloanpayment2").prop("required", true);
        $('.pagibigloanpayment1').css("display", "none");
        $(".pagibigloanpayment1").prop("required", false);
    } else {
        $('.pagibigloanpayment2').css("display", "none");
        $(".pagibigloanpayment2").prop("required", false);
        $('.pagibigloanpayment1').css("display", "");
        $(".pagibigloanpayment1").prop("required", true);
    }  
    
    var pagibigcalamity = $('#pagibigcalamity').val();
    
    if (pagibigcalamity > 0) {
        $('.pagibigcalamity').css("display", "");
        $(".pagibigcalamity").prop("required", true);
    } else {
        $('.pagibigcalamity').css("display", "none");
        $(".pagibigcalamity").prop("required", false);
    }  
       
       
    getslBalance();

    //     $('.sl').prop('readonly', true);
    //     $('#salaryloan').prop('readonly', true);
    //     $('.sl select').prop('readonly', true);
    //     $(".radio-btn").click(function(){
    //         return false;
    //     });
    //     document.getElementById('slPayment').addEventListener('mousedown', function(event) {
    //     event.preventDefault();
    // }, false);
    // document.getElementById('slBank').addEventListener('mousedown', function(event) {
    //     event.preventDefault();
    // }, false);

    
  
    
    var salaryloanValue = $('#salaryloan').val();
    
    if (salaryloanValue > 0) {
        $('.sl').css("display", "");
        $(".sl").prop("required", true);
    } else {
        $('.sl').css("display", "none");
        $(".sl").prop("required", false);
        $('.sl1').css("display", "none");
        $(".sl1").prop("required", false);
    }
    
    var payment = $('#slPayment').val();
    
    if (payment) {
        $('.sl1').css("display", "");
        $(".sl1").prop("required", true);
    } else {
        $('.sl1').css("display", "none");
        $(".sl1").prop("required", false);
    }   
    
    if(payment == 1 ){
        $('.radio-btn').css("display", "");
        $(".radio-btn").prop("required", true);
        $('.salary1').css("display", "");
        $(".salary1").prop("required", true);
        $('.salary2').css("display", "none");
        $(".salary2").prop("required", false);
    }else if(payment == 2){
        $('.radio-btn').css("display", "none");
        $(".radio-btn").prop("required", false);
        $('.salary1').css("display", "none");
        $(".salary1").prop("required", false)
        $('.salary2').css("display", "");
        $(".salary2").prop("required", true);
    }else if(payment == '' || payment == 0){
        $('.salary1').css("display", "none");
        $(".salary1").prop("required", false)
        $('.salary2').css("display", "none");
        $(".salary2").prop("required", false);
        $('.radio-btn').css("display", "none");
        $(".radio-btn").prop("required", false);
    }else if(payment == 3){
        $('.radio-btn').css("display", "none");
        $(".radio-btn").prop("required", false);
    }

    var sssloanpayment = $('#sssloanPayment').val();

    if(sssloanpayment == 1 ){
        $('.sssloanRadio').css("display", "");
        $(".sssloanRadio").prop("required", true);
    }else{
        $('.sssloanRadio').css("display", "none");
        $(".sssloanRadio").prop("required", false);
    }

    if (sssloanpayment == 2) {
        $('.sssloan2').css("display", "");
        $(".sssloan2").prop("required", true);
        $('.sssloan1').css("display", "none");
        $(".sssloan1").prop("required", false);
    }  else if(sssloanpayment == 1){
        $('.sssloan2').css("display", "none");
        $(".sssloan2").prop("required", false);
        $('.sssloan1').css("display", "");
        $(".sssloan1").prop("required", true);
    }  

    if(sssloanpayment > 0){
        $('.sssloan').css("display", "");
        $(".sssloan").prop("required", true);
    }else{
        $('.sssloan').css("display", "none");
        $(".sssloan").prop("required", false);
        $('.sssloan1').css("display", "none");
        $(".sssloan1").prop("required", false)
        $('.sssloan2').css("display", "none");
        $(".sssloan2").prop("required", false)
    }

    var ssscalamitypayment = $('#ssscalamityPayment').val();

    if(ssscalamitypayment == 1 ){
        $('.ssscalamityRadio').css("display", "");
        $(".ssscalamityRadio").prop("required", true);
    }else{
        $('.ssscalamityRadio').css("display", "none");
        $(".ssscalamityRadio").prop("required", false);
    }


    if (ssscalamitypayment == 2) {
        $('.ssscalamity2').css("display", "");
        $(".ssscalamity2").prop("required", true);
        $('.ssscalamity1').css("display", "none");
        $(".ssscalamity1").prop("required", false);
    } else if(ssscalamitypayment == 1) {
        $('.ssscalamity2').css("display", "none");
        $(".ssscalamity2").prop("required", false);
        $('.ssscalamity1').css("display", "");
        $(".ssscalamity1").prop("required", true);
    } 
    
    if (ssscalamitypayment > 0) {
        $('.ssscalamity').css("display", "");
        $(".ssscalamity").prop("required", true);
    } else {
        $('.ssscalamity').css("display", "none");
        $(".ssscalamity").prop("required", false);
        $('.ssscalamity1').css("display", "none");
        $(".ssscalamity1").prop("required", false)
        $('.ssscalamity2').css("display", "none");
        $(".ssscalamity2").prop("required", false)
    } 

    var pagibigloanpayment = $('#pagibigloanPayment').val();

    if(pagibigloanpayment == 1 ){
        $('.pagibigloanRadio').css("display", "");
        $(".pagibigloanRadio").prop("required", true);
    }else{
        $('.pagibigloanRadio').css("display", "none");
        $(".pagibigloanRadio").prop("required", false);
    }

    if (pagibigloanpayment > 0) {
        $('.pagibigloan').css("display", "");
        $(".pagibigloan").prop("required", true);
    } else {
        $('.pagibigloan').css("display", "none");
        $(".pagibigloan").prop("required", false);
        $('.pagibigloan').css("display", "none");
        $(".pagibigloan").prop("required", false);
        $('.pagibigloan1').css("display", "none");
        $(".pagibigloan1").prop("required", false)
        $('.pagibigloan2').css("display", "none");
        $(".pagibigloan2").prop("required", false)
    } 

    if (pagibigloanpayment == 2) {
        $('.pagibigloan2').css("display", "");
        $(".pagibigloan2").prop("required", true);
        $('.pagibigloan1').css("display", "none");
        $(".pagibigloan1").prop("required", false);
    } else if(pagibigloanpayment == 1) {
        $('.pagibigloan2').css("display", "none");
        $(".pagibigloan2").prop("required", false);
        $('.pagibigloan1').css("display", "");
        $(".pagibigloan1").prop("required", true);
    }  

    var pagibigcalamitypayment = $('#pagibigcalamityPayment').val();

    if(pagibigcalamitypayment == 1 ){
        $('.pagibigcalamityRadio').css("display", "");
        $(".pagibigcalamityRadio").prop("required", true);
    }else{
        $('.pagibigcalamityRadio').css("display", "none");
        $(".pagibigcalamityRadio").prop("required", false);
    }

    if (pagibigcalamitypayment > 0) {
        $('.pagibigcalamity').css("display", "");
        $(".pagibigcalamity").prop("required", true);
    } else {
        $('.pagibigcalamity').css("display", "none");
        $(".pagibigcalamity").prop("required", false);
        $('.pagibigcalamity1').css("display", "none");
        $(".pagibigcalamity1").prop("required", false)
        $('.pagibigcalamity2').css("display", "none");
        $(".pagibigcalamity2").prop("required", false)
    } 

    if (pagibigcalamitypayment == 2) {
        $('.pagibigcalamity2').css("display", "");
        $(".pagibigcalamity2").prop("required", true);
        $('.pagibigcalamity1').css("display", "none");
        $(".pagibigcalamity1").prop("required", false);
    } else if(pagibigcalamitypayment == 1) {
        $('.pagibigcalamity2').css("display", "none");
        $(".pagibigcalamity2").prop("required", false);
        $('.pagibigcalamity1').css("display", "");
        $(".pagibigcalamity1").prop("required", true);
    }  
});
    
    function addYearsToDate(dateString, yearsToAdd) {
        var date = new Date(dateString);
        date.setFullYear(date.getFullYear() + yearsToAdd);
        return date;
    }
    
    $('#slBank').change(function(){
        getAmortization();
        getslBalance();
    });
    
    $('#salaryloan').keyup(function(){
    
        var salaryloanValue = $(this).val();
        getAmortization();
        getslBalance();
        if (salaryloanValue > 0) {
            $('.sl').css("display", "");
            $(".sl").prop("required", true);
        } else {
            $('.sl').css("display", "none");
            $(".sl").prop("required", false);
        }   
    
    });
    

    $('#sssloanPayment').change(function(){
        var sssloanpayment = $(this).val();
        
        if (sssloanpayment == 2) {
            $('.sssloan2').css("display", "");
            $(".sssloan2").prop("required", true);
            $('.sssloan1').css("display", "none");
            $(".sssloan1").prop("required", false);
        } else if(sssloanpayment == 1) {
            $('.sssloan2').css("display", "none");
            $(".sssloan2").prop("required", false);
            $('.sssloan1').css("display", "");
            $(".sssloan1").prop("required", true);
        }  

        if(sssloanpayment > 0){
            $('.sssloan').css("display", "");
            $(".sssloan").prop("required", true);
        }else{
            $('.sssloan').css("display", "none");
            $(".sssloan").prop("required", false);
            $('.sssloan1').css("display", "none");
            $(".sssloan1").prop("required", false)
            $('.sssloan2').css("display", "none");
            $(".sssloan2").prop("required", false)
        }
        
        
        if(sssloanpayment == 1 ){
            $('.sssloanRadio').css("display", "");
            $(".sssloanRadio").prop("required", true);
        }else{
            $('.sssloanRadio').css("display", "none");
            $(".sssloanRadio").prop("required", false);
        }
    });
    
    $('#ssscalamityPayment').change(function(){
        var ssscalamitypayment = $(this).val();

        if(ssscalamitypayment == 1 ){
            $('.ssscalamityRadio').css("display", "");
            $(".ssscalamityRadio").prop("required", true);
        }else{
            $('.ssscalamityRadio').css("display", "none");
            $(".ssscalamityRadio").prop("required", false);
        }

        if (ssscalamitypayment > 0) {
            $('.ssscalamity').css("display", "");
            $(".ssscalamity").prop("required", true);
        } else {
            $('.ssscalamity').css("display", "none");
            $(".ssscalamity").prop("required", false);
            $('.ssscalamity1').css("display", "none");
            $(".ssscalamity1").prop("required", false)
            $('.ssscalamity2').css("display", "none");
            $(".ssscalamity2").prop("required", false)
        } 

        if (ssscalamitypayment == 2) {
            $('.ssscalamity2').css("display", "");
            $(".ssscalamity2").prop("required", true);
            $('.ssscalamity1').css("display", "none");
            $(".ssscalamity1").prop("required", false);
        } else if(ssscalamitypayment == 1) {
            $('.ssscalamity2').css("display", "none");
            $(".ssscalamity2").prop("required", false);
            $('.ssscalamity1').css("display", "");
            $(".ssscalamity1").prop("required", true);
        }  
    });


    $('#pagibigcalamityPayment').change(function(){
        var pagibigcalamitypayment = $(this).val();

        if(pagibigcalamitypayment == 1 ){
            $('.pagibigcalamityRadio').css("display", "");
            $(".pagibigcalamityRadio").prop("required", true);
        }else{
            $('.pagibigcalamityRadio').css("display", "none");
            $(".pagibigcalamityRadio").prop("required", false);
        }

        if (pagibigcalamitypayment > 0) {
            $('.pagibigcalamity').css("display", "");
            $(".pagibigcalamity").prop("required", true);
        } else {
            $('.pagibigcalamity').css("display", "none");
            $(".pagibigcalamity").prop("required", false);
            $('.pagibigcalamity1').css("display", "none");
            $(".pagibigcalamity1").prop("required", false)
            $('.pagibigcalamity2').css("display", "none");
            $(".pagibigcalamity2").prop("required", false)
        } 
    
        if (pagibigcalamitypayment == 2) {
            $('.pagibigcalamity2').css("display", "");
            $(".pagibigcalamity2").prop("required", true);
            $('.pagibigcalamity1').css("display", "none");
            $(".pagibigcalamity1").prop("required", false);
        }else if(pagibigcalamitypayment == 1) {
            $('.pagibigcalamity2').css("display", "none");
            $(".pagibigcalamity2").prop("required", false);
            $('.pagibigcalamity1').css("display", "");
            $(".pagibigcalamity1").prop("required", true);
        }  
    });

    $('#pagibigloanPayment').change(function(){
        var pagibigloanpayment = $(this).val();

        if(pagibigloanpayment == 1 ){
            $('.pagibigloanRadio').css("display", "");
            $(".pagibigloanRadio").prop("required", true);
        }else{
            $('.pagibigloanRadio').css("display", "none");
            $(".pagibigloanRadio").prop("required", false);
        }

        if (pagibigloanpayment > 0) {
            $('.pagibigloan').css("display", "");
            $(".pagibigloan").prop("required", true);
        } else {
            $('.pagibigloan').css("display", "none");
            $(".pagibigloan").prop("required", false);
            $('.pagibigloan1').css("display", "none");
            $(".pagibigloan1").prop("required", false)
            $('.pagibigloan2').css("display", "none");
            $(".pagibigloan2").prop("required", false)
        } 

        if (pagibigloanpayment == 2) {
            $('.pagibigloan2').css("display", "");
            $(".pagibigloan2").prop("required", true);
            $('.pagibigloan1').css("display", "none");
            $(".pagibigloan1").prop("required", false);
        }else if(pagibigloanpayment == 1) {
            $('.pagibigloan2').css("display", "none");
            $(".pagibigloan2").prop("required", false);
            $('.pagibigloan1').css("display", "");
            $(".pagibigloan1").prop("required", true);
        }  

        
    });
    
    $('#slDate').change(function(){
        var date = $(this).val();
        var year = $('#slyear').val();
        var newDate = addYearsToDate(date, parseInt(year));
    $('#slDuedate').val(newDate.toISOString().slice(0,10));
    getslBalance();
    });
    
    $('#slyear').keyup(function(){
        getAmortization();
    });

    $('#slBank').change(function(){
        getAmortization();
       
    });
    
    $('#slPayment').change(function(){
        getAmortization();
        getslBalance();
     
        var payment = $('#slPayment').val();
    
    if (payment) {
        $('.sl1').css("display", "");
        $(".sl1").prop("required", true);
    } else {
        $('.sl1').css("display", "none");
        $(".sl1").prop("required", false);
    }   
    
    if(payment == 1 ){
        $('.radio-btn').css("display", "");
        $(".radio-btn").prop("required", true);
        $('.salary1').css("display", "");
        $(".salary1").prop("required", true);
        $('.salary2').css("display", "none");
        $(".salary2").prop("required", false);
    }else if(payment == 2){
        $('.radio-btn').css("display", "none");
        $(".radio-btn").prop("required", false);
        $('.salary1').css("display", "none");
        $(".salary1").prop("required", false)
        $('.salary2').css("display", "");
        $(".salary2").prop("required", true);
    }else if(payment == '' || payment == 0){
        $('.salary1').css("display", "none");
        $(".salary1").prop("required", false)
        $('.salary2').css("display", "none");
        $(".salary2").prop("required", false);
        $('.radio-btn').css("display", "none");
        $(".radio-btn").prop("required", false);
    }else if(payment == 3){
        $('.radio-btn').css("display", "none");
        $(".radio-btn").prop("required", false);
    }
    
    });
    
    function getAmortization(){
        var bank = $('#slBank').val();
        var salaryloanValue = parseFloat($('#salaryloan').val());
        var year = parseFloat($('#slyear').val());
        var method = parseFloat($('#slPayment').val());
        var totalmonths = year * 12;

        if(method != '3'){
            if (bank == "NextBank"){
                var payment = (totalmonths * method);
            }else if (bank == "BADA2" && method == 2){
                var payment = (totalmonths * method);
            }else if (bank == "BADA2" && method == 1){
                var payment = (totalmonths * method);
            }else if (bank == "BADA1"){
                var payment = (totalmonths * method);
            }
        }else if (method == '3' && year == 1){
            var payment = (totalmonths * 1);
        }else if (method == '3' && year == 2){
            var payment = (totalmonths * 1);
        }
       
    
        if(method == 2 && year == 1 ){
            var rate = 0.09 / payment;
        }else if (method == 1 && year == 1 ){
            var rate = 0.09 / payment;
        }else if (method == 2 && year == 2 ){
            var rate = 0.18 / payment;
        }else if (method == 1 && year == 2 ){
            var rate = 0.18 / payment;
        }else if (method == 3 && year == 1){
            var rate = 0.09 / payment;
        }else if (method == 3 && year == 2){
            var rate = 0.18 / payment;
        }

        if(bank == "BADA1"){
            var amortization = rate * salaryloanValue / (1 - Math.pow(1 + rate, -payment + 1));
        }else{
            var amortization = rate * salaryloanValue / (1 - Math.pow(1 + rate, -payment));
        }
       
        
        if(method == 1){
            $('#slAmortization').val(amortization.toFixed(2));
        }else if (method == 2){
            $('#slAmortizationfirst').val(amortization.toFixed(2));
            $('#slAmortizationlast').val(amortization.toFixed(2));
        } else if (method == 3){
            $('#slAmortization').val(amortization.toFixed(2));
            halfamortization = amortization / 2;
            $('#slAmortizationfirst').val(halfamortization.toFixed(2));
            $('#slAmortizationlast').val(halfamortization.toFixed(2));
        } 
    }

    function getslBalance() {
        var initialBalance = parseFloat($('#salaryloan').val());
        var slPayment = parseInt($('#slPayment').val());
        var amortization;
        if(slPayment == 1 || slPayment == 3){
             amortization = parseFloat($('#slAmortization').val());
        }else{
            var amortizationFirst = parseFloat($('#slAmortizationfirst').val());
            var amortizationLast = parseFloat($('#slAmortizationlast').val());
            amortization = amortizationFirst + amortizationLast;
        }
      
        var date = $('#slDate').val();
        var Date1 = new Date(date);
        var currentDate = new Date();
        
        // Calculate the difference in years and months
        var yearsDiff = currentDate.getFullYear() - Date1.getFullYear();
        var monthsDiff = currentDate.getMonth() - Date1.getMonth();
        
        // Adjust for negative months difference (e.g., current date is in a previous year)
        if (monthsDiff < 0) {
            yearsDiff--;
            monthsDiff += 12;
        }
        
        // Total months passed
        var months = yearsDiff * 12 + monthsDiff;
    
        // Calculate the balance for each month and the corresponding interest
        let balances = [];
        let interests = [];
        let principals = [];
        let currentBalance = initialBalance;
        let interest = 0;
        let principal = 0;

        if(slPayment == 1 || slPayment == 3){
            for (let i = 0; i < months; i++) {
                balances.push(currentBalance);
                interests.push(interest);
                principals.push(principal);
                interest = currentBalance * 0.0075;
                principal = amortization - interest;
                currentBalance -= principal; // Assuming interest reduces the balance
            }
        }else if(slPayment == 2){
            const halfMonthRate = 0.0075 / 2; // Semi-monthly interest rate
            const amortizationHalfMonth = amortization / 2; // Half-month amortization

            for (let i = 0; i < months * 2; i++) { // Loop for each half-month
                balances.push(currentBalance);
                interests.push(interest);
                principals.push(principal);
                interest = currentBalance * halfMonthRate;
                principal = amortizationHalfMonth - interest;
                currentBalance -= principal;
            }
        }
        $('#slBalance').val(currentBalance.toFixed(2));
        $('#interest').val(interest.toFixed(2));
        $('#principal').val(principal.toFixed(2));
    }
   
    
    $('#monthlyrate').keyup(function(){
    monthlyrate = $(this).val();

        $('#pagibig').val(200); 
        $('#pagibigEmployer').val(200); 

         //FOR TAX
         if (monthlyrate < 20833) {
            $('#tax').val(0.00);
        } else if (monthlyrate >= 20833 && monthlyrate <= 30332) {
            let excess1 = monthlyrate - 20833;
            $('#tax').val((0.15 * excess1).toFixed(2));
        } else if (monthlyrate >= 33333 && monthlyrate <= 66666) {
            let excess2 = monthlyrate - 33333;
            $('#tax').val(((0.20 * excess2) + 1875).toFixed(2));
        } else if (monthlyrate >= 66667 && monthlyrate <= 166666) {
            let excess3 = monthlyrate - 66667;
            $('#tax').val(((0.25 * excess3) + 8541.80).toFixed(2));
        } else if (monthlyrate >= 166667 && monthlyrate <= 666666) {
            let excess4 = monthlyrate - 166667;
            $('#tax').val(((0.30 * excess4) + 33541.80).toFixed(2));
        } else if (monthlyrate >= 666667) {
            let excess5 = monthlyrate - 666667;
            $('#tax').val(((0.35 * excess5) + 183541.80).toFixed(2));
        }
    
        //FOR SSS
        if(monthlyrate < 4250){
            $('#sss').val(180);
        }else if(monthlyrate >= 4250 && monthlyrate <= 4749.99){
            $('#sss').val(202.50);
        }else if(monthlyrate >= 4750 && monthlyrate <= 5249.99){
            $('#sss').val(225.00);
        }else if(monthlyrate >= 5250 && monthlyrate <= 5749.99){
            $('#sss').val(247.50);
        }else if(monthlyrate >= 5750 && monthlyrate <= 6249.99){
            $('#sss').val(270.00);
        }else if(monthlyrate >= 6250 && monthlyrate <= 6749.99){
            $('#sss').val(292.50);
        }else if(monthlyrate >= 6750 && monthlyrate <= 7249.99){
            $('#sss').val(315.00);
        }else if(monthlyrate >= 7250 && monthlyrate <= 7749.99){
            $('#sss').val(337.50);
        }else if(monthlyrate >= 7750 && monthlyrate <= 8249.99){
            $('#sss').val(360.00);
        }else if(monthlyrate >= 8250 && monthlyrate <= 8749.99){
            $('#sss').val(382.50);
        }else if(monthlyrate >= 8750 && monthlyrate <= 9249.99){
            $('#sss').val(405.00);
        }else if(monthlyrate >= 9250 && monthlyrate <= 9749.99){
            $('#sss').val(427.50);
        }else if(monthlyrate >= 9750 && monthlyrate <= 10249.99){
            $('#sss').val(450.00);
        }else if(monthlyrate >= 10250 && monthlyrate <= 10749.99){
            $('#sss').val(472.50);
        }else if(monthlyrate >= 10750 && monthlyrate <= 11249.99){
            $('#sss').val(495.00);
        }else if(monthlyrate >= 11250 && monthlyrate <= 11749.99){
            $('#sss').val(517.50);
        }else if(monthlyrate >= 11750 && monthlyrate <= 12249.99){
            $('#sss').val(540.00);
        }else if(monthlyrate >= 12250 && monthlyrate <= 12749.99){
            $('#sss').val(562.50);
        }else if(monthlyrate >= 12750 && monthlyrate <= 13249.99){
            $('#sss').val(585.00);
        }else if(monthlyrate >= 13250 && monthlyrate <= 13749.99){
            $('#sss').val(607.50);
        }else if(monthlyrate >= 13750 && monthlyrate <= 14249.99){
            $('#sss').val(630.00);
        }else if(monthlyrate >= 14250 && monthlyrate <= 14749.99){
            $('#sss').val(652.50);
        }else if(monthlyrate >= 14750 && monthlyrate <= 15249.99){
            $('#sss').val(675.00);
        }else if(monthlyrate >= 15250 && monthlyrate <= 15749.99){
            $('#sss').val(697.50);
        }else if(monthlyrate >= 15750 && monthlyrate <= 16249.99){
            $('#sss').val(720.00);
        }else if(monthlyrate >= 16250 && monthlyrate <= 16749.99){
            $('#sss').val(742.50);
        }else if(monthlyrate >= 16750 && monthlyrate <= 17249.99){
            $('#sss').val(765.00);
        }else if(monthlyrate >= 17250 && monthlyrate <= 17749.99){
            $('#sss').val(787.50);
        }else if(monthlyrate >= 17750 && monthlyrate <= 18249.99){
            $('#sss').val(810.00);
        }else if(monthlyrate >= 18250 && monthlyrate <= 18749.99){
            $('#sss').val(832.50);
        }else if(monthlyrate >= 18750 && monthlyrate <= 19249.99){
            $('#sss').val(855.00);
        }else if(monthlyrate >= 19250 && monthlyrate <= 19749.99){
            $('#sss').val(877.50);
        }else if(monthlyrate >= 19750){
            $('#sss').val(900.00);
        }else{
            $('#sss').val(0.00);
        }

          //FOR SSS EMPLOYER
        if(monthlyrate < 4250){
            $('#sssEmployer').val(380);
        }else if(monthlyrate >= 4250 && monthlyrate <= 4749.99){
            $('#sssEmployer').val(427.50);
        }else if(monthlyrate >= 4750 && monthlyrate <= 5249.99){
            $('#sssEmployer').val(475.00);
        }else if(monthlyrate >= 5250 && monthlyrate <= 5749.99){
            $('#sssEmployer').val(522.50);
        }else if(monthlyrate >= 5750 && monthlyrate <= 6249.99){
            $('#sssEmployer').val(570.00);
        }else if(monthlyrate >= 6250 && monthlyrate <= 6749.99){
            $('#sssEmployer').val(617.50);
        }else if(monthlyrate >= 6750 && monthlyrate <= 7249.99){
            $('#sssEmployer').val(665.00);
        }else if(monthlyrate >= 7250 && monthlyrate <= 7749.99){
            $('#sssEmployer').val(712.50);
        }else if(monthlyrate >= 7750 && monthlyrate <= 8249.99){
            $('#sssEmployer').val(760.00);
        }else if(monthlyrate >= 8250 && monthlyrate <= 8749.99){
            $('#sssEmployer').val(807.50);
        }else if(monthlyrate >= 8750 && monthlyrate <= 9249.99){
            $('#sssEmployer').val(855.00);
        }else if(monthlyrate >= 9250 && monthlyrate <= 9749.99){
            $('#sssEmployer').val(902.50);
        }else if(monthlyrate >= 9750 && monthlyrate <= 10249.99){
            $('#sssEmployer').val(950.00);
        }else if(monthlyrate >= 10250 && monthlyrate <= 10749.99){
            $('#sssEmployer').val(997.50);
        }else if(monthlyrate >= 10750 && monthlyrate <= 11249.99){
            $('#sssEmployer').val(1045.00);
        }else if(monthlyrate >= 11250 && monthlyrate <= 11749.99){
            $('#sssEmployer').val(1092.50);
        }else if(monthlyrate >= 11750 && monthlyrate <= 12249.99){
            $('#sssEmployer').val(1140.00);
        }else if(monthlyrate >= 12250 && monthlyrate <= 12749.99){
            $('#sssEmployer').val(1187.50);
        }else if(monthlyrate >= 12750 && monthlyrate <= 13249.99){
            $('#sssEmployer').val(1235.00);
        }else if(monthlyrate >= 13250 && monthlyrate <= 13749.99){
            $('#sssEmployer').val(1282.50);
        }else if(monthlyrate >= 13750 && monthlyrate <= 14249.99){
            $('#sssEmployer').val(1330.00);
        }else if(monthlyrate >= 14250 && monthlyrate <= 14749.99){
            $('#sssEmployer').val(1377.50);
        }else if(monthlyrate >= 14750 && monthlyrate <= 15249.99){
            $('#sssEmployer').val(1425.00);
        }else if(monthlyrate >= 15250 && monthlyrate <= 15749.99){
            $('#sssEmployer').val(1472.50);
        }else if(monthlyrate >= 15750 && monthlyrate <= 16249.99){
            $('#sssEmployer').val(1520.00);
        }else if(monthlyrate >= 16250 && monthlyrate <= 16749.99){
            $('#sssEmployer').val(1567.50);
        }else if(monthlyrate >= 16750 && monthlyrate <= 17249.99){
            $('#sssEmployer').val(1615.00);
        }else if(monthlyrate >= 17250 && monthlyrate <= 17749.99){
            $('#sssEmployer').val(1662.50);
        }else if(monthlyrate >= 17750 && monthlyrate <= 18249.99){
            $('#sssEmployer').val(1710.00);
        }else if(monthlyrate >= 18250 && monthlyrate <= 18749.99){
            $('#sssEmployer').val(1757.50);
        }else if(monthlyrate >= 18750 && monthlyrate <= 19249.99){
            $('#sssEmployer').val(1805.00);
        }else if(monthlyrate >= 19250 && monthlyrate <= 19749.99){
            $('#sssEmployer').val(1852.50);
        }else if(monthlyrate >= 19750){
            $('#sssEmployer').val(1900.00);
        }else{
            $('#sssEmployer').val(0.00);
        }

        valsssER = $('#sssEmployer').val();

        if(monthlyrate >= 14749.99){
            $('#sssEmployer').val(+valsssER + 10);
        }else if (monthlyrate <= 14750){
            $('#sssEmployer').val(+valsssER + 30);
        }

        // FOR SSS MAND
    
        if (monthlyrate >= 20250 && monthlyrate <=  20749.99){
            $('#sssmand').val(22.50);
        }else if (monthlyrate >= 20750 && monthlyrate <=  21249.99){
            $('#sssmand').val(45.00);
        }else if (monthlyrate >= 21250 && monthlyrate <=  21749.99){
            $('#sssmand').val(67.50);
        }else if (monthlyrate >= 21750 && monthlyrate <=  22249.99){
            $('#sssmand').val(90.00);
        }else if (monthlyrate >= 22250 && monthlyrate <=  22749.99){
            $('#sssmand').val(112.50);
        }else if (monthlyrate >= 22750 && monthlyrate <=  23249.99){
            $('#sssmand').val(135.00);
        }else if (monthlyrate >= 23250 && monthlyrate <=  23749.99){
            $('#sssmand').val(157.50);
        }else if (monthlyrate >= 23750 && monthlyrate <=  24249.99){
            $('#sssmand').val(180.00);
        }else if (monthlyrate >= 24250 && monthlyrate <=  24749.99){
            $('#sssmand').val(202.50);
        }else if (monthlyrate >= 24750 && monthlyrate <=  25249.99){
            $('#sssmand').val(225.00);
        }else if (monthlyrate >= 25250 && monthlyrate <=  25749.99){
            $('#sssmand').val(247.50);
        }else if (monthlyrate >= 25750 && monthlyrate <=  26249.99){
            $('#sssmand').val(270.00);
        }else if (monthlyrate >= 26250 && monthlyrate <=  26749.99){
            $('#sssmand').val(292.50);
        }else if (monthlyrate >= 26750 && monthlyrate <=  27249.99){
            $('#sssmand').val(315.00);
        }else if (monthlyrate >= 27250 && monthlyrate <=  27749.99){
            $('#sssmand').val(337.50);
        }else if (monthlyrate >= 27750 && monthlyrate <=  28249.99){
            $('#sssmand').val(360.00);
        }else if (monthlyrate >= 28250 && monthlyrate <=  28749.99){
            $('#sssmand').val(382.50);
        }else if (monthlyrate >= 28750 && monthlyrate <=  29249.99){
            $('#sssmand').val(405.00);
        }else if (monthlyrate >= 29250 && monthlyrate <=  29749.99){
            $('#sssmand').val(427.50);
        }else if (monthlyrate >= 29750){
            $('#sssmand').val(450.00);
        }else{
            $('#sssmand').val(0.00);
        }

        if (monthlyrate >= 20250 && monthlyrate <=  20749.99){
            $('#sssmandEmployer').val(47.50);
        }else if (monthlyrate >= 20750 && monthlyrate <=  21249.99){
            $('#sssmandEmployer').val(95.00);
        }else if (monthlyrate >= 21250 && monthlyrate <=  21749.99){
            $('#sssmandEmployer').val(142.50);
        }else if (monthlyrate >= 21750 && monthlyrate <=  22249.99){
            $('#sssmandEmployer').val(190.00);
        }else if (monthlyrate >= 22250 && monthlyrate <=  22749.99){
            $('#sssmandEmployer').val(237.50);
        }else if (monthlyrate >= 22750 && monthlyrate <=  23249.99){
            $('#sssmandEmployer').val(285.00);
        }else if (monthlyrate >= 23250 && monthlyrate <=  23749.99){
            $('#sssmandEmployer').val(332.50);
        }else if (monthlyrate >= 23750 && monthlyrate <=  24249.99){
            $('#sssmandEmployer').val(380.00);
        }else if (monthlyrate >= 24250 && monthlyrate <=  24749.99){
            $('#sssmandEmployer').val(427.50);
        }else if (monthlyrate >= 24750 && monthlyrate <=  25249.99){
            $('#sssmandEmployer').val(475.00);
        }else if (monthlyrate >= 25250 && monthlyrate <=  25749.99){
            $('#sssmandEmployer').val(522.50);
        }else if (monthlyrate >= 25750 && monthlyrate <=  26249.99){
            $('#sssmandEmployer').val(570.00);
        }else if (monthlyrate >= 26250 && monthlyrate <=  26749.99){
            $('#sssmandEmployer').val(617.50);
        }else if (monthlyrate >= 26750 && monthlyrate <=  27249.99){
            $('#sssmandEmployer').val(665.00);
        }else if (monthlyrate >= 27250 && monthlyrate <=  27749.99){
            $('#sssmandEmployer').val(712.50);
        }else if (monthlyrate >= 27750 && monthlyrate <=  28249.99){
            $('#sssmandEmployer').val(760.00);
        }else if (monthlyrate >= 28250 && monthlyrate <=  28749.99){
            $('#sssmandEmployer').val(807.50);
        }else if (monthlyrate >= 28750 && monthlyrate <=  29249.99){
            $('#sssmandEmployer').val(855.00);
        }else if (monthlyrate >= 29250 && monthlyrate <=  29749.99){
            $('#sssmandEmployer').val(902.50);
        }else if (monthlyrate >= 29750){
            $('#sssmandEmployer').val(950.00);
        }else{
            $('#sssmandEmployer').val(0.00);
        }
    
        //FOR PhilHealth        
        $('#philhealth').val(((monthlyrate * 0.05)/ 2).toFixed(2))
        $('#philhealthEmployer').val(((monthlyrate * 0.05)/ 2).toFixed(2))
        
    });