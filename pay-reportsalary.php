<?php
include('connection.php');

$branchName = $_GET['branch'];

$empid = $_SESSION['employeeId'];

$fullname = $_SESSION['fullname'];

$sql = "SELECT * FROM pay_selecteddate GROUP BY date ORDER BY STR_TO_DATE(date, '%M %e, %Y') DESC";
$result = $con->query($sql);

$options = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options[] = [
            'selectedDate' => $row['selectedDate'], 
            'date' => $row['date'],
            'startdate' => $row['startdate'],
            'enddate' => $row['enddate'],
            'approved' => $row['approved'],
            'approver' => $row['approver'],
            'verified' => $row['verified'],
            'verifier' => $row['verifier'],
            'totalNetPay' => $row['totalNetPay'],
            'totalRegularPay' => $row['totalRegularPay'],
            'remarks' => $row['remarks'],
            'status' => $row['status'],
            'verified_at' => $row['verified_at'], // TIMESTAMP
            'approved_at' => $row['approved_at'], // TIMESTAMP
        ];
    }
}

$optionsJson = json_encode($options);


?>
  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="devCiao">
<meta name="description" content="A payslip for OUR Bank.">
<link rel="icon" href="images/favicon.ico">

<title>Online Payslip</title>

<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-lW6g4vIv0/QIou5K1+nbQh0l+wi4o7xkjhtFk7A7DO8hSDjOYAx3w9swf9Jw+0jTJkr0GJ76TzY6klIYdNmP/g==" crossorigin="anonymous" /> -->


</head>

<style>
.reports {
    max-width: 800px; /* You can adjust this value as needed */
    margin: 0 auto; /* This centers the div horizontally on the page */
}
.flogo {
      text-align: center;
    }

#inventorylogo {
  width: 25%;
  height: auto;
}
.hidden{
    display:none;
}

.btn-approved{
    display:none;
}
.btn-verified{
    display:none;
}

/* FIX 2: Verified/Approved status chips — visual weight added, display:none preserved for JS control */
.verified{
    display:none;
    font-weight: 500;
    font-size: 13px;
    padding: 4px 12px;
    border-radius: 20px;
    background: #E1F5EE;
    color: #085041;
    border: 0.5px solid #5DCAA5;
}
.verify{
    display:none;
    font-style: italic;
    font-size: 12px;
    color: #6c757d;
}
.approved{
    display:none;
    font-weight: 500;
    font-size: 13px;
    padding: 4px 12px;
    border-radius: 20px;
    background: #E6F1FB;
    color: #0C447C;
    border: 0.5px solid #378ADD;
}
.approve{
    display:none;
    font-style: italic;
    font-size: 12px;
    color: #6c757d;
}

/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 900px) {
  body{
    zoom:100%;
  }
}

@media only screen and (min-width: 900px) {
 body{
    zoom:100%;
  }
}

/* FIX 1: Loader — was using undefined @keyframes rotate, replaced with spin */
.loader {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    position: relative;
    border: 2px solid #dee2e6;
    border-top-color: #0d6efd;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

@keyframes prixClipFix {
    0%   {clip-path:polygon(50% 50%,0 0,0 0,0 0,0 0,0 0);}
    25%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 0,100% 0,100% 0);}
    50%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,100% 100%,100% 100%);}
    75%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 100%);}
    100% {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 0);}
}

/* FIX 3: Modal alerts — consistent border-radius and border, one shown at a time via JS */
#passError {
    border-radius: 6px;
    border: 0.5px solid #f5c2c7;
    font-size: 13px;
}
#passCorrect {
    border-radius: 6px;
    border: 0.5px solid #badbcc;
    font-size: 13px;
    color: #0f5132;
}

/* FIX 5: Eye icon — ensure pointer cursor and fallback font-size if FA kit is slow/unavailable */
#show {
    cursor: pointer;
    font-size: 14px;
}

</style>

<body>
<div class="container-fluid">
<div class="flogo">
    <img  src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
</div>
      <div class="payslip-form">

</div>

<div class="gap-2 d-flex flex-row align-items-start justify-content-start">
   
<div class="form-group gap-2 col-sm-6 d-flex align-items-center justify-content-start">
<!-- <span id="searchSpan" style="display:none;" ><strong>Search:</strong></span>
    <div id="searchDiv" style="display:none;"  class="position-relative col-sm-3">
    <input class="form-control" > </input>
    </div> -->
<span class="d-flex"><strong>Date:</strong></span>
<div class="position-relative col-sm-3">
    <select name="selectDate" id="selectDate" class="form-select text-center" aria-describedby="button-addon2">
        <option value="" selected disabled>-- Select Date --</option>
        <!-- <?php foreach ($options as $option): ?>
            <option value="<?php echo $option['selectedDate']; ?>"><?php echo $option['date']; ?></option>
        <?php endforeach; ?> -->

        <?php // <-- DATE SELECT CSS
            $isFirst = true;
            foreach ($options as $option): ?>
                <option 
                    value="<?php echo $option['selectedDate']; ?>"
                    <?php if($isFirst): ?>style="font-weight:bold; color:#0d6efd;"<?php endif; ?>
                >
                    <?php echo $option['date']; ?><?php if($isFirst): ?> <?php endif; ?>
                </option>
            <?php 
            $isFirst = false;
            endforeach; ?>
            
            <!--  DATE SELECT CSS -->
    

    </select>
</div>
    <span><strong>Branch:</strong></span>
    <div class="position-relative col-sm-3">
        <select id="branchname" class="form-select d-flex text-center align-items-center justify-content-center">
                <option value="">All</option>
                <option value="Head Office">Head Office</option>
                <option value="Magallanes">Magallanes</option>
                <option value="Manggahan">Manggahan</option>
                <option value="Maragondon">Maragondon</option>
                <option value="Noveleta">Noveleta</option>
                <option value="Poblacion">Poblacion</option>
                <option value="Ternate">Ternate</option>
        </select>
    </div>
    <span class="hidden category"><strong>Category:</strong></span>
    <div class="position-relative col-sm-2">
        <select id="selectcategory" class="hidden form-select category text-center">
            <option value="Late">Late</option>
            <option value="Absent">Absent</option>
        </select> 
    </div>
   <div class="col-sm-3">
        </div>
</div> 
 <div class="gap-2 position-relative col-sm-2 ms-auto">    
    <select id="valReport" class="form-select text-center">
        <option value="Salary">Salary Report</option>
        <option value="Attendance">Attendance Report</option>
        <!-- <option value="Accounting">Accounting Report</option> -->
        <option value="Overtime">Overtime Report</option>
    </select>
</div>
    

<input readonly  type = "hidden" class="form-control" name="startdateoutput" id="startdateoutput"></input>
<input readonly  type = "hidden" class="form-control" name="enddateoutput" id="enddateoutput"></input>
<input type = "hidden" class="form-control" name="payPeriod" id="payPeriod"></input>

</div>

<div style="max-width:100%" class=" reports">    
</div>

<div class="d-flex gap-2 align-items-center justify-content-start">
    <!-- FIX 4: Sentence case on action bar labels -->
    <button class="btn-verified btn-outline-secondary btn btn-md " ><strong>Verify</strong></button>
    <span class="verify">Verified by: </span>
    <span class="verified" ><strong></strong></span>
    <button class="btn-approved btn-outline-secondary btn btn-md "><strong>Approve</strong></button>
    <span class="approve" >Approved by: </span>
    <span class="approved"><strong> </strong></span>
    <!-- <button style="display:none" disabled type="button" class="ms-auto btn-outline-secondary btn btn-md print-btn" data-index="' . $index . '"><strong>SAVE AS PDF/PRINT</strong></button> -->
</div>  

 

<!-- MODAL -->
<div  class="modal" id="passmodal">
  <div id="modal-dialog2" class="modal-dialog">
      <div id="modal-content2" class="modal-content">
          <!-- Modal Header -->
          <div  id="modal-header2" class="modal-header">
              <!-- FIX 4: Sentence case on modal title -->
              <h5 id="modal-title2" class="modal-title">Enter Password</h5>
              <span style="" class="loader"></span>
          </div>

          <!-- Modal Body -->
          <div id="modal-body2" class="gap-2 modal-body d-flex gap-3 flex-column align-items-center justify-content-center">
            <div class="m-2  d-flex">
                <label class="d-flex align-items-center" style="text-align:center;margin-right:10px;" for="password">PASSWORD:</label>
                <input required id="password" type="password" class="form-control"></input> 
                <!-- FIX 5: title attribute added as fallback label if FA icon fails to render -->
                <span id="show" title="Show/hide password" style="position: relative; float:right;margin-left:-25px;z-index: 2; margin-top:10px;"class="fa-solid fa-eye"></span>
            </div>
           
            <div class="d-flex flex-row align-items-center gap-3">
              <!-- FIX 4: Sentence case on modal buttons -->
              <button type="submit" class="btn  btn-primary btn-md btn-submitpass">Submit</button>
              <button type="button" class="btn  btn-danger close-btn" data-dismiss="deleteDate">Close</button> 
            </div>
            <div id="passError" role='alert' class="text-center form-control p-2" style="background-color:pink;display:none;">Incorrect Password</div>
            <div id="passCorrect" role='alert' class="text-center form-control p-2" style="background-color:#21D375;display:none;font-color:white;">Succesfully Approved </div>
      </div>
  </div>
</div>

<!-- Refresh trigger on passCorrect visibility -->
<script>
  (function () {
    const passCorrect = document.getElementById('passCorrect');
    if (!passCorrect) return;

    const observer = new MutationObserver(function () {
      if (passCorrect.style.display !== 'none' && passCorrect.style.display !== '') {
        observer.disconnect();
        setTimeout(function () {
          location.reload();
        }, 1500); // 1.5s para mabasa ng user ang message bago mag-refresh
      }
    });

    observer.observe(passCorrect, { attributes: true, attributeFilter: ['style'] });
  })();
</script>

</body>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/e924e7f226.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
    document.getElementById('show').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('show');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

<script>
var approve = "0";

$(document).ready(function() {

function checkAndReload(selectedOption) {
    if (selectedOption.approved === '1' && selectedOption.verified === '1') {
        window.top.location.reload();
    }
}

var options = <?php echo $optionsJson; ?>;

$('.btn-verified').click(function(event){

var totalbasic = localStorage.getItem('totalbasic');
var totalnet = localStorage.getItem('totalnet');
var selectedDate = $('#selectDate').val();
var selectedOption = options.find(option => option.selectedDate === selectedDate);

if(totalbasic > totalnet || selectedOption.totalRegularPay > selectedOption.totalNetPay){
    confirmation = confirm('Total of Net Salary is less than Total of Regular Pay. Are you done verifying it?');
}else if (totalbasic < totalnet || selectedOption.totalRegularPay < selectedOption.totalNetPay){
    confirmation = confirm('Total of Net Salary is greater than Total of Regular Pay. Are you done verifying it?');
}else{
    confirmation = confirm('Total of Net Salary is equal to the Total of Regular Pay. Are you done verifying it?');
}

if (!confirmation){
    event.preventDefault();
}else{
    var remarks = prompt("Enter Remarks:");

    if (remarks === null || remarks === '') {
        alert("Remarks are Required");
        location.reload();
    } else {

    $('html, body').animate({ scrollTop: 0 }, 'smooth');
    window.top.scrollTo({ top: 0, behavior: 'smooth' });

    $('#passmodal').modal('show');

    $('#password').keydown(function(event){
        if(event.which === 13){
            $('.btn-submitpass').click();   
        }     
    });;
 
    $('.btn-submitpass').click(function(e){
        var pass = $("#password").val();
        var id = <?php echo $empid ?>;
        $.ajax({
            url: 'pay-checkpassword.php', 
            type: 'POST',
            data: { pass: pass}, 
            success: function(data) {
            if(data === 'Success'){
                $.ajax({
                url: 'pay-addremarks.php',
                type: 'POST',
                data: {remarks :remarks,
                date : selectedDate },
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
                });

                $.ajax({
                type: "POST",
                url: "pay-approveReport.php",
                data: {  
                    date: selectedDate,
                    datatoretrieve: 'verify'
                },
                success: function(result) {
                    console.log('AJAX Success:', result); // Log the result for debugging
                    if (result.trim() === "Updated") {
                        selectedOption.verified = '1';
                        selectedOption.verifier = '<?php echo $_SESSION['fullname']; ?>';
                        $('.verified').show();
                        $('.verify').show();
                        $('.btn-verified').hide();
                        // $('.verified').text(selectedOption.verifier);
                        $('.verified').text(selectedOption.verifier + ' | ' + selectedOption.verified_at);
                        alert('Succesfully Verified');
                        checkAndReload(selectedOption);
                        location.reload();
                    } else {
                        console.error('Server response indicates failure:', result);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
                });
            }else{
                $('#passError').css('display','block');
                $('#passCorrect').css('display','none');
                e.preventdefault();
            }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
            
        });
    });
       
    }
}
});

$('.btn-approved').click(function(e){

    var selectedDate = $('#selectDate').val();
    var selectedOption = options.find(option => option.selectedDate === selectedDate);
    remarks = selectedOption.remarks;
    
    if(selectedOption.verified == '1'){

    confirmation = confirm('Remarks by Verifier: ' + remarks);
    if(!confirmation){
        e.preventDefault();
    }else{

        $('html, body').animate({ scrollTop: 0 }, 'smooth');
        window.top.scrollTo({ top: 0, behavior: 'smooth' });
        
        $('#passmodal').modal('show');
        
        $('#password').keydown(function(event){
        if(event.which === 13){
            $('.btn-submitpass').click();   
        }     
        });;

        $('.btn-submitpass').click(function(event){
            var pass = $("#password").val();
            $.ajax({
                url: 'pay-checkpassword.php', 
                type: 'POST', 
                data: { pass: pass}, 
                success: function(data) {
                if(data === 'Success'){
                    $.ajax({
                    type: "POST",
                    url: "pay-approveReport.php",
                    data: {  
                        date: selectedDate,
                        datatoretrieve: 'approve'
                    },
                    // approved/verify function
                    success: function(result){
                    selectedOption.approved = '1';
                    selectedOption.approver = '<?php echo $_SESSION['fullname']; ?>';
                    $('.approved').show();
                    $('.approve').show();
                    $('.btn-approved').hide();
                    $('.approved').text(selectedOption.approver + ' | ' + selectedOption.approved_at);
                    // $('.approved').text(selectedOption.approver);
                    $('#passError').css('display','none');
                    $('#passCorrect').css('display','block');
                   
                    approve = 1;
                    if(approve == 1){
                        $.ajax({
                            type: "POST",
                            url: "pay-readreportsalary.php",
                            data: {
                                branch: $('#branchname').val(),
                                date: selectedDate,
                                startdate: $('#startdateoutput').val(),
                                enddate: $('#enddateoutput').val(),
                                periodpay: $('#payPeriod').val(),
                                approved: selectedOption.approved,
                                approve: approve,
                                status: selectedOption.status,
                                totalNetPay: selectedOption.totalNetPay,
                                totalRegularPay: selectedOption.totalRegularPay
                            },
                            success: function(result) {
                                $('.reports').html(result);
                                $('.print-btn').css('display','');

                                // ✅ FREEZE only AFTER pay_record is fully saved
                                // Wait 2 seconds to ensure all pay-addrecord.php AJAX calls inside
                                // pay-readreportsalary.php have finished writing to pay_record
                                setTimeout(function() {
                                    $.ajax({
                                        url: 'pay-freeze.php',
                                        type: 'POST',
                                        data: { date: selectedDate },
                                        success: function(response) {
                                            console.log('Freeze result:', response);
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Freeze error:', status, error);
                                        }
                                    });
                                }, 2000);
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', status, error);
                            }
                        });
                    }

                    $(".loader").LoadingOverlay("hide");
                    },

                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                    });
                }else{
                    $('#passError').css('display','block');
                    $('#passCorrect').css('display','none');
                    e.preventdefault();
                }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                }
            });
        });
     }
    }else{
        e.preventDefault();
        alert('Wait for Verification');
    }
});
    
$('#valReport').change(function(){
    var reportValue = $(this).val();
    var selectedDate = $('#selectDate').val();
    var selectedOption = options.find(option => option.selectedDate === selectedDate);
    
    if(reportValue == 'Attendance' ){
        $('.category').removeClass('hidden');
        $('#searchSpan').css('display','');
        $('#searchDiv').css('display','');
        submitDataLate();
        $('.approved').hide();
        $('.approve').hide();
        $('.btn-approved').hide();
        $('.btn-verified').hide();
        $('.verified').hide();
        $('.verify').hide();
       
    }else if(reportValue == 'Salary'){
        $('#searchSpan').css('display','none');
        $('#searchDiv').css('display','none');
        $('.category').addClass('hidden');
            if (selectedOption.approved == 1) {
                $('.btn-approved').hide();
                $('.approved').show();
                $('.approve').show();
            } else {
                $('.btn-approved').show();
                $('.approved').hide();
                $('.approve').hide();
            
            }
            if (selectedOption.verified == 1) {
                $('.btn-verified').hide();
                $('.verified').show();
                $('.verify').show();
            } else {
                $('.btn-verified').show();
                $('.verified').hide()
                $('.verify').hide();
            
            }
        submitData();
    }else if(reportValue== 'Accounting'){
        submitAccountingData();
        $('#searchSpan').css('display','none');
        $('#searchDiv').css('display','none');
        $('.category').addClass('hidden');
        $('.approved').hide();
        $('.approve').hide();
        $('.btn-approved').hide();
        $('.btn-verified').hide();
        $('.verified').hide();
        $('.verify').hide();
    }else if(reportValue== 'Overtime'){
        submitOvertimeData();
        $('#searchSpan').css('display','none');
        $('#searchDiv').css('display','none');
        $('.category').addClass('hidden');
        $('.approved').hide();
        $('.approve').hide();
        $('.btn-approved').hide();
        $('.btn-verified').hide();
        $('.verified').hide();
        $('.verify').hide();
    }

    var branch = $('#branchname').val();

    if(branch !== ''){
        $('.btn-approved').hide();
        $('.btn-verified').hide();
    }

    });
});

$('#selectcategory').change(function(){
    var categorySelected = $(this).val();

    if(categorySelected == 'Late'){
        submitDataLate();
    }else if (categorySelected == 'Absent'){
        submitDataAbsent();
    }
});

// In pay-reportsalary.php, replace the branch change handler (around line 289-322)

$('#branchname').change(function() {
    var selectedDate = $('#selectDate').val();
    var options = <?php echo json_encode($options); ?>;
    var selectedOption = options.find(option => option.selectedDate === selectedDate);
    var reportValue = $('#valReport').val();
    var categorySelected = $('#selectcategory').val();
    var branch = $(this).val();

    // Trigger appropriate report based on current selection
    if(reportValue == 'Salary'){
        submitData();
    }else if(reportValue == 'Attendance' && categorySelected == 'Late'){
        submitDataLate();
    }else if(reportValue == 'Attendance' && categorySelected == 'Absent'){
        submitDataAbsent();
    }else if(reportValue == 'Accounting'){
        submitAccountingData();
    }else if(reportValue == 'Overtime'){
        submitOvertimeData();
    }

    // ✅ FIXED: Handle button visibility based on branch AND report type
    if(reportValue == 'Salary'){
        if(branch !== ''){
            // When filtering by specific branch, hide approve/verify buttons
            $('.btn-approved').hide();
            $('.btn-verified').hide();
            $('.approved').hide();
            $('.approve').hide();
            $('.verified').hide();
            $('.verify').hide();
        } else {
            // When viewing "All" branches, show buttons based on approval status
            if (selectedOption.approved == 1) {
                $('.btn-approved').hide();
                $('.approved').show();
                $('.approve').show();
            } else {
                $('.btn-approved').show();
                $('.approved').hide();
                $('.approve').hide();
            }

            if (selectedOption.verified == 1) {
                $('.btn-verified').hide();
                $('.verified').show();
                $('.verify').show();
            } else {
                $('.btn-verified').show();
                $('.verified').hide();
                $('.verify').hide();
            }
        }
    }
});

$('#selectDate').change(function(e) {
        var selectedDate = $(this).val();
        var options = <?php echo json_encode($options); ?>;
        var selectedOption = options.find(option => option.selectedDate === selectedDate);
        if (selectedOption) {
            $('#startdateoutput').val(selectedOption.startdate);
            $('#enddateoutput').val(selectedOption.enddate);
        } else {
            $('#startdateoutput').val('');
            $('#enddateoutput').val('');
        }

        $('.verified').text(selectedOption.verifier + ' | ' + selectedOption.verified_at);
        $('.approved').text(selectedOption.approver + ' | ' + selectedOption.approved_at);
        // $('.verified').text(selectedOption.verifier);
        // $('.approved').text(selectedOption.approver);

        var reportValue = $('#valReport').val();
        var categorySelected = $('#selectcategory').val();

        if(reportValue == 'Salary'){
            submitData();
            if (selectedOption.approved == 1) {
                $('.btn-approved').hide();
                $('.approved').show();
                $('.approve').show();
            } else {
                $('.btn-approved').show();
                $('.approved').hide();
                $('.approve').hide();
            
            }

            if (selectedOption.verified == 1) {
                $('.btn-verified').hide();
                $('.verified').show();
                $('.verify').show();
            } else {
                $('.btn-verified').show();
                $('.verified').hide()
                $('.verify').hide();
            
            }
        }else if(reportValue == 'Attendance' && categorySelected == 'Late'){
            $('.approved').hide();
            $('.btn-approved').hide();
            $('.btn-verified').hide();
            $('.verified').hide();
            $('.verify').hide();
            $('.approve').hide();
            submitDataLate();
        }else if(reportValue == 'Attendance' && categorySelected == 'Absent'){
            submitDataAbsent();
            $('.approved').hide();
            $('.btn-approved').hide();
            $('.btn-verified').hide();
            $('.verified').hide();
            $('.verify').hide();
            $('.approve').hide();
        }else if(reportValue == 'Accounting'){
            submitAccountingData();
            $('.approved').hide();
            $('.btn-approved').hide();
            $('.btn-verified').hide();
            $('.verified').hide();
            $('.verify').hide();
            $('.approve').hide();
        }else if(reportValue == 'Overtime'){
            submitOvertimeData();
            $('.approved').hide();
            $('.btn-approved').hide();
            $('.btn-verified').hide();
            $('.verified').hide();
            $('.verify').hide();
            $('.approve').hide();
        }

    $(".print-btn").removeAttr("disabled");

    var branch = $('#branchname').val();

    if(branch !== ''){
    $('.btn-approved').hide();
    $('.btn-verified').hide();
    }
});

function submitData() {
    var branch = $('#branchname').val();

    var selectElement = document.getElementById('selectDate');

    // Get the selected option's text
    var selectedText = selectElement.options[selectElement.selectedIndex].text;

    // Get the value of the selected date
    var date = $('#selectDate').val();
    var options = <?php echo json_encode($options); ?>;
    var selectedOption = options.find(option => option.selectedDate === date);

    
    // Split the date into components
    var parts = date.split('-'); 
    var year = parseInt(parts[0]); 
    var month = parseInt(parts[1]); 
    var dayOfMonth = parseInt(parts[2]);

    var startdate = $('#startdateoutput').val();
    var enddate = $('#enddateoutput').val();

    // Determine the pay period based on the day of the month
    if (dayOfMonth <= 25) {
        $('#payPeriod').val('First Cut Off');
    } else {
        $('#payPeriod').val('Last Cut Off');
    }

    var periodpay = $('#payPeriod').val();
    
    // Make the AJAX request
    $.ajax({
        type: "POST",
        url: "pay-readreportsalary.php",
        data: {
            branch:branch,
            date: date,
            startdate: startdate,
            enddate: enddate,
            periodpay: periodpay,
            approved : selectedOption.approved,
            approve : approve,
            status : selectedOption.status,
            totalNetPay: selectedOption.totalNetPay,
            totalRegularPay : selectedOption.totalRegularPay
        },
        success: function(result) {
            $('.reports').html(result);
            $('.print-btn').css('display','');
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

function submitAccountingData() {
    var branch = $('#branchname').val();

    var selectElement = document.getElementById('selectDate');

    // Get the selected option's text
    var selectedText = selectElement.options[selectElement.selectedIndex].text;

    // Get the value of the selected date
    var date = $('#selectDate').val();
    var options = <?php echo json_encode($options); ?>;
    var selectedOption = options.find(option => option.selectedDate === date);

    
    // Split the date into components
    var parts = date.split('-'); 
    var year = parseInt(parts[0]); 
    var month = parseInt(parts[1]); 
    var dayOfMonth = parseInt(parts[2]);

    var startdate = $('#startdateoutput').val();
    var enddate = $('#enddateoutput').val();

    // Determine the pay period based on the day of the month
    if (dayOfMonth <= 25) {
        $('#payPeriod').val('First Cut Off');
    } else {
        $('#payPeriod').val('Last Cut Off');
    }

    var periodpay = $('#payPeriod').val();
    
    // Make the AJAX request
    $.ajax({
        type: "POST",
        url: "pay-readaccountingreport.php",
        data: {
            branch:branch,
            date: date,
            startdate: startdate,
            enddate: enddate,
            periodpay: periodpay,
            approved : selectedOption.approved,
            approve : approve,
            status : selectedOption.status,
            totalNetPay: selectedOption.totalNetPay,
            totalRegularPay : selectedOption.totalRegularPay
        },
        success: function(result) {
            $('.reports').html(result);
            $('.print-btn').css('display','');
            
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

function submitOvertimeData() {
    var branch = $('#branchname').val();

    var selectElement = document.getElementById('selectDate');

    // Get the selected option's text
    var selectedText = selectElement.options[selectElement.selectedIndex].text;

    // Get the value of the selected date
    var date = $('#selectDate').val();
    var options = <?php echo json_encode($options); ?>;
    var selectedOption = options.find(option => option.selectedDate === date);

    
    // Split the date into components
    var parts = date.split('-'); 
    var year = parseInt(parts[0]); 
    var month = parseInt(parts[1]); 
    var dayOfMonth = parseInt(parts[2]);

    var startdate = $('#startdateoutput').val();
    var enddate = $('#enddateoutput').val();

    // Determine the pay period based on the day of the month
    if (dayOfMonth <= 25) {
        $('#payPeriod').val('First Cut Off');
    } else {
        $('#payPeriod').val('Last Cut Off');
    }

    var periodpay = $('#payPeriod').val();
    
    // Make the AJAX request
    $.ajax({
        type: "POST",
        url: "pay-readOvertimeReport.php",
        data: {
            branch:branch,
            date: date,
            startdate: startdate,
            enddate: enddate,
            periodpay: periodpay,
            approved : selectedOption.approved,
            approve : approve,
            status : selectedOption.status,
            totalNetPay: selectedOption.totalNetPay,
            totalRegularPay : selectedOption.totalRegularPay
        },
        success: function(result) {
            $('.reports').html(result);
            $('.print-btn').css('display','');
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

</script>

<script>

$(document).ready(function() {
    
    $(".print-btn").click(function() {
        var index = $(this).data("index");
        var printContents = document.getElementsByClassName("reports")[0].innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    });

    window.addEventListener("afterprint", function(event) {
    location.reload();
    });

});

</script>

<style>
.slip {
    text-align: left;
    border: 1px dashed;
    padding: 5%;
}

@media print {
    .print-btn {
        display: none;
    }
    #table-container{
        overflow-x: hidden;
    }
    .slip {
        border: 1px dashed !important;
    }
}
</style>

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
    $('#passmodal').modal('hide');
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

<script>

function submitDataLate() {

var branch = $('#branchname').val();

var selectElement = document.getElementById('selectDate');

// Get the selected option's text
var selectedText = selectElement.options[selectElement.selectedIndex].text;

// Get the value of the selected date
var date = $('#selectDate').val();

// Split the date into components
var parts = date.split('-'); 
var year = parseInt(parts[0]); 
var month = parseInt(parts[1]); 
var dayOfMonth = parseInt(parts[2]);

var startdate = $('#startdateoutput').val();
var enddate = $('#enddateoutput').val();


// Determine the pay period based on the day of the month
if (dayOfMonth <= 25) {
    $('#payPeriod').val('First Cut Off');
} else {
    $('#payPeriod').val('Last Cut Off');
}

var periodpay = $('#payPeriod').val();
var valsort = $('#Sorting').val();


// Make the AJAX request
$.ajax({
    type: "POST",
    url: "pay-readattendancesummaryLate.php",
    data: {
        date: date,
        startdate: startdate,
        enddate: enddate,
        periodpay: periodpay,
        branch:branch
    },
    success: function(result) {
        $('.reports').html(result); // Update container with fetched data
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
    }
});
}

function submitDataAbsent() {

var branch = $('#branchname').val();

var selectElement = document.getElementById('selectDate');

// Get the selected option's text
var selectedText = selectElement.options[selectElement.selectedIndex].text;

// Get the value of the selected date
var date = $('#selectDate').val();

// Split the date into components
var parts = date.split('-'); 
var year = parseInt(parts[0]); 
var month = parseInt(parts[1]); 
var dayOfMonth = parseInt(parts[2]);

var startdate = $('#startdateoutput').val();
var enddate = $('#enddateoutput').val();


// Determine the pay period based on the day of the month
if (dayOfMonth <= 25) {
$('#payPeriod').val('First Cut Off');
} else {
$('#payPeriod').val('Last Cut Off');
}

var periodpay = $('#payPeriod').val();


// Make the AJAX request
$.ajax({
type: "POST",
url: "pay-readattendancesummaryAbsent.php",
data: {
    date: date,
    startdate: startdate,
    enddate: enddate,
    periodpay: periodpay,
    branch:branch
},
success: function(result) {
    $('.reports').html(result); 
},
error: function(xhr, status, error) {
    console.error('AJAX Error:', status, error);
}
});
}

$('.btn-attendance').click(function(){
   submitDataLate()
   submitDataAbsent()
});

$(document).off('click', '.deleteAbsent').on('click', '.deleteAbsent', function(e) {
    var id = $(this).data('id');
    var row = $(this).closest('tr');
    confirmation = confirm("Are you sure you want to delete this record?");
    e.preventDefault();
    if (confirmation) {
        $.ajax({
            url: 'pay-deleteAbsent.php',
            method: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                console.log(response);
                row.hide();
            },
            error: function(xhr, status, error) {
                console.error('Error updating data: ', error);
            }
        });
    }
});
</script>
</html>