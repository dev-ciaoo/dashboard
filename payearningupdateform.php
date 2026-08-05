<?php
include('connection.php'); // Make sure the database connection is properly included
$emptyDate = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT pe.*, acc.* 
                FROM pay_earnings pe 
                INNER JOIN accounts acc ON pe.employeeID = acc.employeeID AND pe.datedeleted = ? 
                WHERE acc.employeeID = ?";
        $stmt = mysqli_prepare($con, $sql);

        mysqli_stmt_bind_param($stmt, 'ss',$emptyDate, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            $name = htmlspecialchars($row['fullName']);
            $position = htmlspecialchars($row['bankPosition']);
            $branch = htmlspecialchars($row['address']);
            $monthlyRate = htmlspecialchars($row['MonthlySalary']);
            $riceAllowance = htmlspecialchars($row['RiceAllowance']);
            $transpoAllowance = htmlspecialchars($row['TranspoAllowance']); 
            $sss = htmlspecialchars($row['sss']);
            $sssmand = htmlspecialchars($row['sssmandprovident']);
            $pagibig = htmlspecialchars($row['pagibig']);
            $philhealth = htmlspecialchars($row['philhealth']);

            $sssloan = htmlspecialchars($row['sssloan']);
            $sssloanDate = htmlspecialchars($row['sssloanDate']);
            $sssloanDuedate = htmlspecialchars($row['sssloanDuedate']);

            $ssscalamity = htmlspecialchars($row['ssscalamity']);
            $ssscalamityDate = htmlspecialchars($row['ssscalamityDate']);
            $ssscalamityDuedate = htmlspecialchars($row['ssscalamityDuedate']);

            $pagibigloan = htmlspecialchars($row['pagibigloan']);
            $pagibigloanDate = htmlspecialchars($row['pagibigloanDate']);
            $pagibigloanDuedate = htmlspecialchars($row['pagibigloanDuedate']);

            $pagibigcalamity = htmlspecialchars($row['pagibigcalamity']);
            $pagibigcalamityDate = htmlspecialchars($row['pagibigcalamityDate']);
            $pagibigcalamityDuedate = htmlspecialchars($row['pagibigcalamityDuedate']);

            $tax = htmlspecialchars($row['withholdingtax']);
            $salaryloan =  htmlspecialchars($row['salaryloan']);
            $slBalance =  htmlspecialchars($row['slBalance']);
            $slPayment = htmlspecialchars($row['slPayment']);
            $slYear = htmlspecialchars($row['slYear']);
            $slAmortization = htmlspecialchars($row['slAmortization']);
            $slDate = htmlspecialchars($row['slDate']);
            $slDuedate = htmlspecialchars($row['slDuedate']);
            $slBank = htmlspecialchars($row['slBank']);
            $slCutoffSelect = htmlspecialchars($row['slCutoffSelect']);
        } else {
            $sql ="SELECT * FROM accounts where `employeeId` = ?";
            $stmt = mysqli_prepare($con, $sql);

            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
                
      if ($result && mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            $name = htmlspecialchars($row['fullName']);
            $position = htmlspecialchars($row['bankPosition']);
            $branch = htmlspecialchars($row['address']);
      }
        }

        mysqli_stmt_close($stmt);
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "No ID provided";
}

mysqli_close($con); // Close the database connection immediately after use
?>  
<style>
    p{
        color:red;
    }

</style>
<div class="container">
    <form id="myform" method="post" action="payearningupdate.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <div class="d-flex flex-column gap-3">
        <div class="input-group">
            <span class="input-group-text">Name</span>
            <input readonly value="<?php echo isset($name) ? $name : ''; ?>" required class="form-control" name="name" id="name" type="text">
        </div>
        
        <div class="input-group">
            <span class="input-group-text">Position</span>
            <input readonly value="<?php echo isset($position) ? $position : ''; ?>" required class="form-control" name="bankPosition" id="bankPosition" type="text">
        </div>
        <div class="input-group">
            <span class="input-group-text">Branch</span>
            <input readonly value="<?php echo isset($branch) ? $branch : ''; ?>" required class="form-control" name="address" id="address" type="text">
        </div>
        <div class="input-group">
            <span class="input-group-text"><p>*</p> Monthly Rate</span>
            <input placeholder ="Input Monthly Rate" value="<?php echo isset($monthlyRate) ? $monthlyRate : ''; ?>" required class="form-control" name="monthlyrate" id="monthlyrate" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text">Rice Allowance</span>
            <input placeholder ="Input Rice Allowance" value="<?php echo isset($riceAllowance) ? $riceAllowance : ''; ?>"  class="form-control" name="riceallowance" id="riceallowance" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text">Transportation Allowance</span>
            <input placeholder ="Input Transportation Allowance" value="<?php echo isset($transpoAllowance) ? $transpoAllowance : ''; ?>"  class="form-control" name="transpo" id="transpo" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">SSS</span>
            <input readonly value="<?php echo isset($sss) ? $sss : ''; ?>"  class="form-control" name="sss" id="sss" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">SSS Mand. Provident</span>
            <input readonly value="<?php echo isset($sssmand) ? $sssmand : ''; ?>"  class="form-control" name="sssmand" id="sssmand" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">Pagibig</span>
            <input readonly value="<?php echo isset($pagibig) ? $pagibig : ''; ?>"  class="form-control" name="pagibig" id="pagibig" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">PhilHealth</span>
            <input readonly value="<?php echo isset($philhealth) ? $philhealth : ''; ?>"  class="form-control" name="philhealth" id="philhealth" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">Withholding Tax</span>
            <input readonly value="<?php echo isset($tax) ? $tax : ''; ?>"  class="form-control" name="tax" id="tax" type="number">
        </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">SSS Loan</span>
            <input placeholder ="Input SSS Loan (Monthly Amortization)"  value="<?php echo isset($sssloan) ? $sssloan : ''; ?>"  class="form-control" name="sssloan" id="sssloan" type="number">
        </div>
            <div style="padding-left: 50px;" class="sssloan  input-group">
                <span  novalidate class="sssloan input-group-text"><p>*</p>Date</span>
                <input  value="<?php echo isset($sssloanDate) ? $sssloanDate : ''; ?>" class="sssloan form-control" name="sssloanDate" id="sssloanDate" type="date">
            </div>
            <div style="padding-left: 50px;" class="sssloan  input-group">
                <span  novalidate class=" sssloan input-group-text"><p>*</p>Due Date</span>
                <input  value="<?php echo isset($sssloanDuedate) ? $sssloanDuedate : ''; ?>" class="sssloan form-control" name="sssloanDuedate" id="sssloanDuedate" type="date">
            </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">SSS Calamity</span>
            <input  value="<?php echo isset($ssscalamity) ? $ssscalamity : ''; ?>" placeholder ="Input SSS Calamity (Monthly Amortization)"  class="form-control" name="ssscalamity" id="ssscalamity" type="number">
        </div>
            <div style="padding-left: 50px;" class="ssscalamity  input-group">
                <span  novalidate class="ssscalamity input-group-text"><p>*</p>Date</span>
                <input value="<?php echo isset($ssscalamityDate) ? $ssscalamityDate : ''; ?>" class="ssscalamity form-control" name="ssscalamityDate" id="ssscalamityDate" type="date">
            </div>
            <div style="padding-left: 50px;" class="ssscalamity  input-group">
                <span  novalidate class=" ssscalamity input-group-text"><p>*</p>Due Date</span>
                <input value="<?php echo isset($ssscalamityDuedate) ? $ssscalamityDuedate : ''; ?>"  class="ssscalamity form-control" name="ssscalamityDuedate" id="ssscalamityDuedate" type="date">
            </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">Pagibig Loan</span>
            <input value="<?php echo isset($pagibigloan) ? $pagibigloan : ''; ?>" placeholder ="Input Pagibig Loan (Monthly Amortization)"   class="form-control" name="pagibigloan" id="pagibigloan" type="number">
        </div>
            <div  style="padding-left: 50px;" class="pagibigloan  input-group">
                <span   novalidate class="pagibigloan input-group-text"><p>*</p>Date</span>
                <input value="<?php echo isset($pagibigloanDate) ? $pagibigloanDate : ''; ?>" class="pagibigloan form-control" name="pagibigloanDate" id="pagibigloanDate" type="date">
            </div>
            <div  style="padding-left: 50px;" class="pagibigloan  input-group">
                <span  novalidate class=" pagibigloan input-group-text"><p>*</p>Due Date</span>
                <input  value="<?php echo isset($pagibigloanDuedate) ? $pagibigloanDuedate : ''; ?>"  class="pagibigloan form-control" name="pagibigloanDuedate" id="pagibigloanDuedate" type="date">
            </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">Pagibig Calamity</span>
            <input  value="<?php echo isset($pagibigcalamity) ? $pagibigcalamity : ''; ?>"  placeholder ="Input Pagibig Calamity (Monthly Amortization)"  class="form-control" name="pagibigcalamity" id="pagibigcalamity" type="number">
        </div>
            <div  style="padding-left: 50px;" class="pagibigcalamity  input-group">
                <span   novalidate class="pagibigcalamity input-group-text"><p>*</p>Date</span>
                <input   value="<?php echo isset($pagibigcalamityDate) ? $pagibigcalamityDate : ''; ?>" class="pagibigcalamity form-control" name="pagibigcalamityDate" id="pagibigcalamityDate" type="date">
            </div>
            <div  style="padding-left: 50px;" class="pagibigcalamity  input-group">
                <span  novalidate class=" pagibigcalamity input-group-text"><p>*</p>Due Date</span>
                <input  value="<?php echo isset($pagibigcalamityDuedate) ? $pagibigcalamityDuedate : ''; ?>"  class="pagibigcalamity form-control" name="pagibigcalamityDuedate" id="pagibigcalamityDuedate" type="date">
            </div>
        <div class="input-group">
            <span class="input-group-text" style="color: red;">Salary Loan</span>
                <input placeholder="Input Salary Loan" value="<?php echo isset($salaryloan) ? $salaryloan : ''; ?>" class="form-control" name="salaryloan" id="salaryloan" type="number">
        </div>
        <div  style="padding-left: 50px;" class="sl input-group">
            <span class="input-group-text"><p>*</p>Bank</span>
            <select readonly class="sl slbank form-control form-select" name="slBank" id="slBank" novalidate>
                <option id="selectbank" selected disabled>Select Bank</option>
                <option value ="NextBank" <?php if($slBank == 'NextBank'){ ?>selected<?php } ?>>Next Bank</option>
                <option  value ="BADA" <?php if($slBank == 'BADA'){ ?>selected<?php } ?> >BADA</option>
            </select>
        </div>
        <div  style="padding-left: 50px;" class="sl input-group">
            <span class="input-group-text"><p>*</p>No. of Year to Pay</span>
            <input novalidate placeholder ="Input Year to Pay"  value="<?php echo isset($slYear) ? $slYear : ''; ?>"  class="sl form-control" name="slyear" id="slyear" type="number">
        </div>
        <div  style="padding-left: 50px;" class="sl input-group">
            <span class="input-group-text"><p>*</p>Payment</span>
            <select readonly class="sl  form-control form-select" name="slPayment" id="slPayment" novalidate>
                <option id="none" value="" <?php if(empty($slPayment)){ ?>selected<?php } ?> disabled>Select Payment Method</option>
                <option id="cutoff" value="2" <?php if($slPayment == '2'){ ?>selected<?php } ?>>Per Cut Off</option>
                <option id="month" value="1" <?php if($slPayment == '1'){ ?>selected<?php } ?>>Per Month</option>
            </select>
        </div>
        
        <div style="padding-left: 50px;" class="sl1 radio-btn gap-2 input-group">
            <input type="radio" class="sl" name ="slcutoffSelect" value = "Firstcutoff" id="Firstcutoff" <?php if($slCutoffSelect == 'Firstcutoff'){ ?>checked<?php } ?>>
            <label class = "sl" for="Firstcutoff" >First Cut Off</label>

            <input type="radio" class="sl" name ="slcutoffSelect" value = "Lastcutoff" id="Lastcutoff" <?php if($slCutoffSelect == 'Lastcutoff'){ ?>checked<?php } ?>>
            <label class = "sl" for="Firstcutoff">Last Cut Off</label>

        </div>
        <div style="padding-left: 50px;" class="sl1  input-group">
            <span novalidate class="sl input-group-text"><p>*</p>Date</span>
            <input placeholder ="Input Date" value="<?php echo isset($slDate) ? $slDate : ''; ?>" class="sl form-control" name="slDate" id="slDate" type="date">
        </div>
        <div style="padding-left: 50px;" class="sl1  input-group">
            <span novalidate class=" sl input-group-text">Due Date</span>
            <input  readonly placeholder ="Input Salary Loan"   value="<?php echo isset($slDuedate) ? $slDuedate : ''; ?>"  class="sl form-control" name="slDuedate" id="slDuedate" type="date">
        </div>
        <div  style="padding-left: 50px;" class="sl1  input-group">
            <span novalidate class="sl input-group-text">Amortization</span>
            <input readonly   class="sl form-control" value="<?php echo isset($slAmortization) ? $slAmortization : ''; ?>"  name="slAmortization" id="slAmortization" type="number">
        </div>
        <div  style="padding-left: 50px;" class="sl1  input-group">
            <span class=" sl input-group-text">Salary Loan Balance</span>
                <input readonly value="<?php echo isset($slBalance) ? $slBalance : ''; ?>" class="sl form-control" name="slBalance" id="slBalance" type="number">
        </div>
        <input style="display:none;" value="<?php echo isset($slCount) ? $slCount : ''; ?>" class="form-control" name="slCount" id="slCount" type="number">
        
        <div class="d-flex gap-3 flex-row align-items-center justify-content-center">   
        <button type="submit" id="btnsave" class="btn btn-primary">SAVE</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
</div>
</div>
    </form>
</div>
<style>

</style>

<script>
$(document).ready(function(){

var sssloan = $('#sssloan').val();

if (sssloan > 0) {
    $('.sssloan').css("display", "");
    $(".sssloan").prop("required", true);
} else {
    $('.sssloan').css("display", "none");
    $(".sssloan").prop("required", false);
}  

var ssscalamity = $('#ssscalamity').val();

if (ssscalamity > 0) {
    $('.ssscalamity').css("display", "");
    $(".ssscalamity").prop("required", true);
} else {
    $('.ssscalamity').css("display", "none");
    $(".ssscalamity").prop("required", false);
}  

var pagibigloan = $('#pagibigloan').val();

if (pagibigloan > 0) {
    $('.pagibigloan').css("display", "");
    $(".pagibigloan").prop("required", true);
} else {
    $('.pagibigloan').css("display", "none");
    $(".pagibigloan").prop("required", false);
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

<?php if (isset($salaryloan) && !empty($salaryloan)) { ?>
    $('.sl').prop('readonly', true);
    $('#salaryloan').prop('readonly', true);
    $('.sl select').prop('readonly', true);
    $(".radio-btn").click(function(){
        return false;
    });
    document.getElementById('slPayment').addEventListener('mousedown', function(event) {
    event.preventDefault();
}, false);
document.getElementById('slBank').addEventListener('mousedown', function(event) {
    event.preventDefault();
}, false);
<?php } ?>

$('#myform').submit(function(){
    return confirm('Do you want to save it?');
});

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
}else{
    $('.radio-btn').css("display", "none");
    $(".radio-btn").prop("required", false);
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


$('#sssloan').keyup(function(){

var sssloan = $(this).val();

if (sssloan > 0) {
    $('.sssloan').css("display", "");
    $(".sssloan").prop("required", true);
} else {
    $('.sssloan').css("display", "none");
    $(".sssloan").prop("required", false);
}   

});

$('#ssscalamity').keyup(function(){

var ssscalamity = $(this).val();

if (ssscalamity > 0) {
    $('.ssscalamity').css("display", "");
    $(".ssscalamity").prop("required", true);
} else {
    $('.ssscalamity').css("display", "none");
    $(".ssscalamity").prop("required", false);
} 

});

$('#pagibigcalamity').keyup(function(){

var pagibigcalamity = $(this).val();

if (pagibigcalamity > 0) {
    $('.pagibigcalamity').css("display", "");
    $(".pagibigcalamity").prop("required", true);
} else {
    $('.pagibigcalamity').css("display", "none");
    $(".pagibigcalamity").prop("required", false);
} 

});

$('#pagibigloan').keyup(function(){

var pagibigloan = $(this).val();

if (pagibigloan > 0) {
    $('.pagibigloan').css("display", "");
    $(".pagibigloan").prop("required", true);
} else {
    $('.pagibigloan').css("display", "none");
    $(".pagibigloan").prop("required", false);
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
}else{
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
    if (bank == "NextBank"){
        var payment = (totalmonths * method);
    }else if (bank == "BADA" && method == 2){
        var payment = (totalmonths * method) - 1;
    }else if (bank == "BADA" && method == 1){
        var payment = (totalmonths * method);
    }

    if(method == 2){
        var rate = 0.09 / totalmonths;
    }else if (method == 1){
        var rate = 0.18 / totalmonths;
    }
    var amortization = rate * salaryloanValue / (1 - Math.pow(1 + rate, -payment));

    $('#slAmortization').val(amortization.toFixed(2));
}

function getslBalance(){
    var salaryloanValue = $('#salaryloan').val();
    var date = $('#slDate').val();
    var Date1 = new Date(date);
    var currentDate = new Date();
    var amortization = $('#slAmortization').val();
    var payment = $('#slPayment').val();
   // Calculate the difference in years and months
    var yearsDiff = currentDate.getFullYear() - Date1.getFullYear();
    var monthsDiff = currentDate.getMonth() - Date1.getMonth();
    //var payment =  $('#slPayment').val();

    // Adjust for negative months difference (e.g., current date is in a previous year)
    if (monthsDiff < 0) {
        yearsDiff--;
        monthsDiff += 12;
    }
    
    // Calculate the total number of months passed
    var monthsPassed = yearsDiff * 12 + monthsDiff; 
    var valmonthsPassed = monthsPassed * payment;
    var balance = salaryloanValue - (amortization * valmonthsPassed);
    $('#slBalance').val(balance.toFixed(2));
    $('#slCount').val(monthsPassed);

    console.log(monthsPassed);
    console.log(payment);
    console.log(valmonthsPassed);
}

$('#monthlyrate').keyup(function(){
monthlyrate = $(this).val();


    $('#pagibig').val(200); 

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

    //FOR PhilHealth        
    $('#philhealth').val((monthlyrate * 0.05)/ 2)
});

</script>
