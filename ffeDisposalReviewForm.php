<?php
include('connection.php');
require 'auth_check.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>FF&E FORM</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

  <style>
    .semi-header{
        background-color: #E9c805;
        color: black;
        text-align: start;
    }

    .semi-label{
        padding: 10px;
        font-size: 20px;
        font-weight: 600;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    #form-readonly input{
        background-color: #e9ecef;
    }

    .leave-form{
        padding: 0!important;
        margin: 0!important;
        width: 100%!important;
        height: auto;
    }

    .leave-image{
        height: 7rem;
        width: 22rem;
        padding: 0;
        margin: 0;
    }

    #dateToday{
        font-weight: bold;
        font-size: 18px;
        font-style: normal;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    .section-heading h3{
        padding: 0 15px;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 24px;
    }

    input, textarea, select {
        background-color: #dcdde1!important;
    }

    /* .section-heading1{
        padding: 0;
        margin: 0;
    } */

    /* .piper{
        background-color: #E9c805;
    } */

    .gold-edge {
        background: linear-gradient(to right, 
        #000 0%, 
        #000 97%, 
        #E9c805 97%, 
        #E9c805 100%
        );
    }

    .btnCheck {
        color: white;
        /* border-color: hotpink; */
    }

    .btnCheck:hover {
        background-color: green!important!;
        color: black!important;
    }

    input:read-only, textarea:read-only{
        cursor: not-allowed;
    }

    #reviewedBy {
        cursor: default;
    }

    /* #iAppraiser, #iBidderName, #iBiddingAddress {
        text-transform: capitalize;
    } */

    input, select, textarea {
        text-transform: uppercase;
    }

    .prepared-date {
        position: absolute;
        top: 4px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.85rem;
        pointer-events: none;
        z-index: 2;
    }

    

  </style>
    
</head>
<body>
<?php
// if(){
    
// }

$sql = "SELECT * FROM disposal WHERE stats = 0 ORDER BY id DESC LIMIT 1";

$query = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($query);

// print_r($data);
// die();
?>

<!-- <div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-secondary" onclick="printForm()">
        🖨️ Print Form
    </button>
</div> -->
<section class="forms" id="printArea">
  <div class="container-fluid">
    
    <div class="leave-form shadow-lg p-1 mb-4">
        <div class="pads">
        <div class="row">
        
        <div class="col-md-6 justify-content-start d-flex text-start bg-black gold-edge">
            <div class="section-heading"> 
                <h3><strong>FURNITURE, FIXTURE & ASSET <br> DISPOSAL FORM</strong></h3> 
                <!-- <h3><strong>DISPOSAL FORM</strong></h3> -->
            </div>
        </div>
        <!-- <div class="col-md-1 piper"></div> -->
        <div class="col-md-6 justify-content-end d-flex text-right"><img class="leave-image" src="./logo/logo.png" alt="logo"></div>

        <div class="col-md-12">
            <br>
            <br>
          <form id="disposalForm" action="" method="post" enctype="multipart/form-data">
        <?php if($data == 0){
            echo '';
        }else{ ?>
          <span id="dateToday">Date: 
            <?php 
              date_default_timezone_set('Asia/Manila');
              $myDate = date('F j, Y \a\t g:i A');
              echo $data['dateToday'];
        }?>
          </span>
            <input type="hidden" name="hiddenId" id="hiddenId" value="<?= $data['id']; ?>">
            <input type="hidden" name="iUserId" id="iUserId">
            <input type="hidden" name="iEmpId" id="iEmpId">
            <input type="hidden" name="iFullName" id="iFullName">
            <input type="hidden" id="dateToday" name="myDate" value="<?= $myDate; ?>">
            <div class="row">
                    <input name="toEmail" value="<?= $data['eMail'];?>" type="hidden"  class="form-control" id="toEmail">
                    <input name="employee_Id" value="<?= $data['employeeId']; ?>"type="hidden" class="form-control" id="employee_Id">     
            <div class="col-md-12 semi-header" id="semi-header">
                <label for="semi-header" class="semi-label">REQUEST INFORMATION</label>
            </div>
            <div class="col-md-9">
                </br>
                <div class="form-floating">
                <input name="iName" type="text" class="form-control" id="iName" placeholder="Full Name" value="<?= $data['fullName']; ?>" readonly>
                <label for="iName" class="form-label">FULL NAME</label>
                </div>
                </br>
            </div>
            <div class="col-md-3" id="form-readonly">
                </br>
                <div class="form-floating">
                    <input type="text" class="form-control" name="iBranch" id="iBranch"  placeholder="BRANCH" value="<?= $data['branch']; ?>" readonly>
                    <label for="iBranch" class="form-label">BRANCH</label>
                </div>
                </br>
            </div>
            <div class="col-md-9" id="form-readonly">
                <div class="form-floating">
                    <input type="text" class="form-control" name="iPosition" id="iPosition" placeholder="POSITION" value="<?= $data['position']; ?>" readonly>
                    <label for="iPosition" class="form-label">POSITION</label>
                </div>
                </br>
            </div>
            <div class="col-md-3" id="form-readonly">
                <div class="form-floating">
                    <input type="text" class="form-control" name="iDepartment" id="iDepartment"  placeholder="DEPARTMENT" value="<?= $data['department']; ?>" readonly>
                    <label for="iDepartment" class="form-label">DEPARTMENT</label>
                </div>
                </br>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <?php 
                        $reason = $data['reasonDisposal'];
                    ?>
                <textarea name="reasonDisposal" id="reasonDisposal" class="form-control" rows="4" placeholder=" " readonly><?= htmlspecialchars($reason); ?></textarea>
                <label for="reasonDisposal" class="form-label">REASON FOR DISPOSAL</label>
                </div>
                </br>
            </div>

            <div class="col-md-12 semi-header" id="semi-header">
                <label for="semi-header" class="semi-label">IDENTIFICATION OF FF&E</label>
            </div>
            <div class="col-md-3">
                </br>
                <div class="form-floating">
                    <input type="text" name="iiCategory" id="iiCategory" class="form-control" placeholder=" " value="<?= $data['ffeCategory']; ?>" readonly>
                <!-- <select name="iiCategory" id="iiCategory" class="form-select" aria-placeholder=" ">
                    <option value="" disabled selected>-- SELECT CATEGORY --</option>
                    <option value="Furniture">Furniture</option>
                    <option value="IT Equipment">IT Equipment</option>
                    <option value="Office Equipment">Office Equipment</option>
                    <option value="Vehicle">Vehicle</option>
                    <option value="Others">Others</option>
                </select> -->
                <label for="iiCategory" class="form-label">FF&E CATEGORY</label>
                </div>
                </br>
            </div>
            <div class="col-md-6">
                </br>
                <div class="form-floating" style="display: <?= ($data['ffeCategory'] == 'Others') ? 'block' : 'none'; ?>;">
                    <input type="text" name="iOthers" id="iOthers" placeholder=" " class="form-control" value="<?= ($data['ffeCategory'] == 'Others') ? $data['ffeOther'] : ''; ?>" readonly>
                    <label for="iOthers" class="form-label">REASON FOR OTHER CATEGORY</label>
                </div>
                </br>
            </div>
            <div class="col-md-3">
                </br>
                <div class="form-floating">
                    <input type="text" name="iDatePurchased" id="iDatePurchased" placeholder=" " class="form-control" value="<?= date('F j, Y', strtotime($data['ffeDatePurchased'])); ?>" readonly>
                    <label for="iDatePurchased" class="form-label">DATE PURCHASED</label>
                </div>
                </br>
            </div>
            <div class="col-md-9">
                <div class="form-floating">
                    <?php
                        $description = $data['ffeDisc'];
                    ?>
                    <textarea name="iDescription" id="iDescription" class="form-control" rows="4" placeholder=" " readonly><?= htmlspecialchars($description) ?></textarea>
                     <!-- <input type="text" name="iDescription" id="iDescription" class="form-control" value="<?= $data['ffeDisc']; ?>" readonly> -->
                    <label for="iDescription" class="form-label">DESCRIPTION</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="text" name="iPurchasedVal" id="iPurchasedVal" class="form-control" placeholder=" " value="<?= number_format($data['ffePurchaseVal'], 2, '.', ','); ?>" readonly>
                    <small class="text-muted text-start d-flex">Enter amount in &#x20B1;</small>
                    <label for="iPurchasedVal" class="form-label">PURCHASE VALUE</label>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-floating">
                    <?php 
                        $remarkss = $data['ffeRemarks'];
                    ?>
                    <textarea name="iRemarks" id="iRemarks" class="form-control" rows="4" placeholder=" " readonly><?= htmlspecialchars($remarkss); ?></textarea>
                    <label for="iRemarks" class="form-label">REMARKS</label>
                </div>
                </br>
            </div>
             <div class="col-md-3">
                <div class="form-floating">
                    <!-- <select name="iCondition" id="iCondition" class="form-select" placeholder=" ">
                        <option value="" selected disabled>-- SELECT CONDITION --</option>
                        <option value="Serviceable">Serviceable</option>
                        <option value="Unserviceable">Unserviceable</option>
                        <option value="Obsolete">Obsolete</option>
                    </select> -->
                    <input type="text" name="iCondition" id="iCondition" class="form-control" value="<?= $data['ffeCondition']; ?>" readonly>
                    <label for="iCondition" class="form-label">CONDITION</label>
                </div>
                </br>
            </div>

            <div class="col-md-12 semi-header" id="semi-header">
                <label class="semi-label">FOR ASSET MANAGEMENT DEPARTMENT USE</label>
            </div>
            <div class="col-md-9">
                <br>
                <div class="form-floating">
                    <!-- <input type="text" name="iAppraiser" id="iAppraiser" class="form-control" placeholder=" " value="$_SESSION['fullname'];" required> -->
                    <select name="iAppraiser" id="iAppraiser" class="form-select" aria-placeholder=" " required>
                        <option value="" disabled selected>-- SELECT APPRAISER NAME -- </option>
                        <?php 
                        if($data['ffeCategory'] !== 'IT Equipment'){
                            echo    '
                                        <option value="Jonathan B. Quijano">Jonathan B. Quijano</option>
                                        <option value="Chester Dave Vinluan">Chester Dave Vinluan</option>
                                    ';
                        }else{
                            echo    '
                                        <option value="Julius C. Villanueva">Julius C. Villanueva</option>
                                        <option value="Jonathan B. Quijano">Jonathan B. Quijano</option>
                                        <option value="Rovic D. Ramos">Rovic D. Ramos</option>
                                    ';
                        }
                        ?>
                    </select>
                    <label for="iAppraiser" class="form-label">NAME OF APPRAISER</label>
                </div>
            </div>
            <div class="col-md-3">
                </br>
                <div class="form-floating">
                    <input type="date" name="iDateAppraisal" id="iDateAppraisal" placeholder=" " class="form-control" required>
                    <label for="iDateAppraisal" class="form-label">DATE OF APPRAISAL</label>
                </div>
                </br>
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="text" name="iAppraisalVal" id="iAppraisalVal" class="form-control" placeholder=" " required>
                    <small class="text-muted text-start d-flex">Enter amount in &#x20B1;</small>
                    <label for="iAppraisalVal" class="form-label">APPRAISAL VALUE</label>
                </div>
            </div>

            

            <div class="col-md-12 semi-header" id="semi-header">
                <label class="semi-label">APPROVAL</label>
            </div>

            <div class="col-md-5">
                <?php
                    $dateTime = $data['preparedDate'];
                    $parts = explode("@", $dateTime);
                    $dateOnly = trim($parts[0]);
                ?>

                <div>
                    <label class="text-start d-flex">
                        <h5 class="p-1">Prepared By:</h5>
                    </label>
                </div>

                <!-- wrapper -->
                <div class="position-relative">
                    <!-- date overlay -->
                    <span class="prepared-date text-muted">
                        <?= htmlspecialchars($dateOnly); ?>
                    </span>

                    <input
                        type="text"
                        name="preparedBy"
                        id="preparedBy"
                        class="form-control text-center text-uppercase pt-4"
                        value="<?= htmlspecialchars($data['preparedBy']); ?>"
                        readonly
                    >
                </div>

                <span class="text-muted text-center d-block">
                    Signature Over Printed Name
                </span>
            </div>

            <div class="col-md-2">
            </div>
            <div class="col-md-5">
                <label for="" class="text-start d-flex"><h5 class="p-1">Bid By:</h5>
                <!-- <button type="submit" class="btn btn-primary btn-md m-4 btnCheck" name="btnCheck" id="btnCheck"><i class="fa-solid fa-check"></i></button> -->
            </label>
                <input type="text" name="biddedBy" id="biddedBy" class="form-control text-center text-uppercase d-flex pt-4" readonly>
                <span class="text-muted text-center">Signature Over Printed Name</span>
            </div>

            <div class="col-md-5">
                <label for="" class="text-start d-flex"><h5 class="p-1">Reviewed By:</h5>
                <?php 
                    if($data['stats'] == 0){
                        echo '<button type="submit" class="btn btn-primary btn-md m-4 btnCheck" name="btnCheck" id="btnCheck"><i class="fa-solid fa-check"></i></button>';
                    } 
                ?>
            </label>

                <span class="text-muted"></span>
                <input type="text" name="reviewedBy" id="reviewedBy" class="form-control text-center text-uppercase d-flex pt-4" value="<?php echo $_SESSION['fullname']; ?>" readonly>
                <span class="text-muted text-center">Signature Over Printed Name</span>
            </div>
            <div class="col-md-2"></div>
             <div class="col-md-5">
                <label for="" class="text-start d-flex"><h5 class="p-1">Approved By:</h5></label>
                <input type="text" name="approvedBy" id="approvedBy" class="form-control text-center text-uppercase d-flex pt-4" readonly>
                <span class="text-muted text-center">Signature Over Printed Name</span>
            </div>

            <!-- <div class="col-md-12">
                <br><br>
                <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-md">Request</button>
              </div>
            </div> -->

                <div class="text-status">
                    <!-- <span>&nbsp;&nbsp;<em>NOTE: Only Sick Leave and Overtime can file LATE DATE.</em></span> -->
                     <br><br>
                </div>
          </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
  crossorigin="anonymous"></script>

<!-- FOR ICONS -->
<script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
<script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>  
<script type="text/javascript">

 

// var allIds = ["wholeDay", "halfDay", "regularOt" , "weekendOt"];
    // function uncheck( event ) 
    // {
    //   var id = event.target.id;
    //   allIds.forEach( function( id ){
    //     if ( id != event.target.id ){
    //         document.getElementById( id ).checked = false;
    //     }
    //   });
    // }
    // jQuery("#wholeDay").click(uncheck);
    // jQuery("#halfDay").click(uncheck);
    // jQuery("#regularOt").click(uncheck);
    // jQuery("#weekendOt").click(uncheck);

    // $('.otDiv').hide();
    // $('.checkD').hide();
    // $('.checkOT').hide();


    // $('#iCategory').change(function (){
    //   if($(this).val() == 'Mandatory Leave' || $(this).val() == 'Vacation Leave' || $(this).val() == 'Sick Leave'){
    //     $('.checkD').show();
    //   }
    //   else{
    //     $('.checkD').hide();
    //   }

    //   if($(this).val() == 'Overtime'){
    //     var totalHours = $('#totalHours');
    //     $('.otDiv').show();
    //     $('.checkOT').show();
    //     totalHours.prop('required', true);
    //   }else{
    //     $('.otDiv').hide();
    //     $('.checkOT').hide();
    //     $('#totalHours').prop('required', false);
        
    //   }

    // });

    // $(document).on('click', '#btnSubmit', function(e){
    //   e.preventDefault();
    //   window.location.reload();
    // })

</script>

<script>
$(document).on('change', '#iName', function(e) {
    e.preventDefault();
    var userId = $(this).val();

    $.ajax({
      url: 'fetch_user_details.php',
      type: 'POST',
      data: { userId: userId },
      dataType: 'json',

      success: function(data){
        // $('#iName').val(data.fullName);
        $('#iUserId').val(data.userId);
        $('#iEmpId').val(data.employeeId);
        $('#iFullName').val(data.fullName);
        $('#iFromEmail').val(data.userEmail);
        $('#iToEmail').val(data.eMail);
        $('#iBranch').val(data.address);
        $('#iPosition').val(data.bankPosition);
        if(data.address !== 'Head Office'){
            $('#iDepartment').val('Branch Banking');
        }else if(data.address === 'Head Office' && data.userDepartment == 8){
            $('#iDepartment').val('CASA');
        }else if(data.address === 'Head Office' && data.userDepartment != 8){
            $('#iDepartment').val(data.departmentName);
        }else{
            $('#iDepartment').val('');
        }

      },
      error: function(xhr, status, error) {
        console.error("Error fetching user details:", error);
      }
    });
});


$(document).on('change', '#iBidderName', function(e) {
    e.preventDefault();
    var userId = $(this).val();

    $.ajax({
      url: 'fetch_user_details.php',
      type: 'POST',
      data: { userId: userId },
      dataType: 'json',

      success: function(data){
        $('#bidEmpUserId').val(data.userId);
        $('#bidEmpId').val(data.employeeId);
        $('#bidEmpName').val(data.fullName);
        $('#iBiddingAddress').val(data.townAddress);
        // $('#iFullName').val(data.fullName);
        // $('#iFromEmail').val(data.userEmail);
        // $('#iToEmail').val(data.eMail);
        // $('#iBranch').val(data.address);
        // $('#iPosition').val(data.bankPosition);
        // if(data.address !== 'Head Office'){
        //     $('#iDepartment').val('Branch Banking');
        // }else if(data.address === 'Head Office' && data.userDepartment == 8){
        //     $('#iDepartment').val('CASA');
        // }else if(data.address === 'Head Office' && data.userDepartment != 8){
        //     $('#iDepartment').val(data.departmentName);
        // }else{
        //     $('#iDepartment').val('');
        // }

      },
      error: function(xhr, status, error) {
        console.error("Error fetching user details:", error);
      }
    });
});
</script>

<script>
    $(document).ready(function(){
        $('#iiCategory').change(function(){
            if($(this).val() == 'Others'){
                $('#iOthers').parent().show();
            } else {
                $('#iOthers').parent().hide();
                $('#iOthers').val('');
            }
        });
    });
    
</script>

<!-- <script>
    $('#iAppraiser').on('change', function(e){
        e.preventDefault();
        if($(this).val() == 'Jonathan B. Quijano'){
            $('#reviewedBy').val('Jonathan B. Quijano');
        }else{
            $('#reviewedBy').val('Chester Dave Vinluan');
        }
    })
</script> -->


<script>
$(document).ready(function () {
    if ($('#hiddenId').val() !== '') {
        $('#btnCheck').show();
    } else {
        $('#btnCheck').hide();
    }
});
</script>

<script>
function formatCurrencyInput(input) {
    input.addEventListener('input', function () {
        let value = this.value;

        // Remove commas
        value = value.replace(/,/g, '');

        // Allow only numbers and decimal point
        value = value.replace(/[^0-9.]/g, '');

        // Prevent multiple decimals
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }

        // Limit to 2 decimal places
        if (parts[1]?.length > 2) {
            value = parts[0] + '.' + parts[1].slice(0, 2);
        }

        // Add comma separators
        const numberParts = value.split('.');
        numberParts[0] = numberParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        this.value = numberParts.join('.');
    });
}

// formatCurrencyInput(document.getElementById('iBidAmount'));
formatCurrencyInput(document.getElementById('iAppraisalVal'));
formatCurrencyInput(document.getElementById('iPurchasedVal'));

</script>

<script>
function printForm() {
    const printContents = document.getElementById('printArea').innerHTML;
    const originalContents = document.body.innerHTML;

    document.body.innerHTML = `
        <html>
        <head>
            <title>FF&E Disposal Form</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
            <style>
                body {
                    font-size: 12px;
                }
                input, textarea, select {
                    border: none !important;
                    box-shadow: none !important;
                }
                label {
                    font-weight: bold;
                }
                .semi-header {
                    border-bottom: 1px solid #000;
                    margin-top: 20px;
                }
                button {
                    display: none !important;
                }
            </style>
        </head>
        <body>
            ${printContents}
        </body>
        </html>
    `;

    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}
</script>

<script>
// $(document).ready(function () {

    $(document).on('submit', '#disposalForm', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: 'disposalRev.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // IMPORTANT

            success: function (response) {
                if (response.status === 'success') {
                    console.log(response);
                    console.log(response.data);
                    alert(response.message);
                    window.location.reload();
                } else {
                    alert('Error: ' + response.debug);
                }
            },

            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error(xhr.responseText);
                // console.log(response.debug);
                alert('Something went wrong. Please try again.');
            }
        });
    });

// });
</script>

</body>

</html>