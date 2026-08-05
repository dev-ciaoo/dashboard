<?php
include('connection.php');
require 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="devCiao">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <title>OUR Bank</title>
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <!-- Style -->
  <!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
  <style rel="stylesheet" type="text/css">
/* @media screen and (max-width: 1921px){
  @-ms-viewport { }
  body {
    zoom: 100%;
  }
} */
   /* 125% */
   /* @media screen and (max-width: 1536px){
  @-ms-viewport { }
  body {
    zoom: 80%;
  }
} */

/* @media screen and (max-width: 1746.45px){
  @-ms-viewport { }
  body {
    zoom: 95%;
  }
} */
  /* 150% */
  /* @media screen and (max-width: 1281px){
  @-ms-viewport { }
  body {
    zoom: 67%;
  }
  
} */

/* @media screen and (max-width: 1098.14px){
  @-ms-viewport { }
  body {
    zoom: 50%;
  }
} */

/* @media screen and (max-width: 2133.33px) {
    @-ms-viewport { }
    body {
      zoom: 80%;
    }
  } */



    h3{
      font-family: "Source Sans Pro", sans-serif;
      color: #656565;
      margin: 30px 0 20px;
    }

    #reporttbl {
      /* word-break: break-all; */
      overflow-wrap: normal;
    }
    
     th, td {
      font-size: 13px;
      text-align: center;
    }

    .action {
      text-align: center;
    }

    #inventorylogo {
      width: 20%;
      height: auto;
    }

    .flogo {
      text-align: center;
    }

    .form-label{
      visibility: visible;
    }

    /* div.dataTables_filter input {
      visibility: hidden;
    }

    label{
      visibility: hidden;
    } */

    #btnAdd{
      position: relative;
      float: right;
      margin-bottom: 5px;
    }

    
    #dateFROM, #dateTO, #leaveCheck, #leaveCheckk, #obCheck, #obCheckk,
    #overCheck, #overCheckk, #disapprovedCheck, #disapprovedCheckk {
      visibility: visible;
    }
   
    .hiLi {
      background-color: #CD5C5C!important;
    }

    .pagination, .dataTables_info{
      font-size: 14px;
    }

    .btnDone{
      font-size: 13px;
    }
  </style>
</head>
<body oncontextmenu="return false;">
<section class="leaveReport">
  <!-- <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div> -->
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>TIME DEPOSIT</h3> 
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
        <div class="dataTables_filter" id="btnAdd">
            <br>
                <?php
                if($_SESSION['department'] != 1 && $_SESSION['username'] != 'pnerona'){
                  echo '';
                }else{
                  echo '<button class="btn btn-warning" id="btnAdd" data-bs-toggle="modal" data-bs-target="#timedepositAdd" type="button">Add +</button>';
                }
                ?>
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th>Bank</th>
                <th>Branch</th>
                <th>Balance</th>
                <th>Interest Rate (%)</th>
                <th>Term</th>
                <th>Maturity Date</th>
                <th>Interest Upon Maturity</th>
                <th>Remarks</th>
                <!-- <th>Date Created</th> -->
                <th>Action</th>
              </thead>
              <tbody id = "tbody-insert">
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Time Deposit Add -->
<div class="modal fade" id="timedepositAdd" data-backdrop="static" tabindex="-1" aria-labelledby="timedepositAddLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="timedepositAddLabel"><strong>TIME DEPOSIT +</strong></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="timedepositForm" method="post" enctype="multipart/form-data">
        <div class="mb-3 row">
          <label for="bankName" class="col-md-4 form-label"><strong>Name of Bank</strong></label>
            <div class="col-md-5">
              <select class="form-control" name="bankName" id="bankName" Required>
                <option value="" selected disabled>-Select Branch-</option>
                <option value="Bank of Makati">Bank of Makati</option>
                <option value="BDO - Sucat">BDO - Sucat</option>
                <option value="Cebuana Lhuillier">Cebuana Lhuillier</option>
                <option value="Metrobank">Metrobank</option>
                <option value="Philippine Business Bank">Philippine Business Bank</option>
                <option value="Philippine Nation Bank">Philippine National Bank</option>
                <option value="Producers Bank">Producers Bank</option>
                <option value="PSbank">PSbank</option>
                <option value="Rural Bank of Naic, Inc.">Rural Bank of Naic, Inc.</option>
                <option value="UCPB Savings Bank">UCPB Savings Bank</option>

                  <!-- <option value="Ternate">Ternate</option> -->
              </select>
            </div>
        </div>
        <!-- <div class="mb-3 row">
          <label for="branchName" class="col-md-4 form-label"><strong>Branch</strong></label>
            <div class="col-md-5">
              <select class="form-control" name="branchName" id="branchName" Required>
                <option value="" selected disabled>-Select Branch-</option>
                <option value="Head Office">Head Office</option>
                <option value="Poblacion">Poblacion</option>
                <option value="Noveleta">Noveleta</option>
                <option value="Manggahan">Manggahan</option>
                <option value="Magallanes">Magallanes</option>
                <option value="Maragondon">Maragondon</option>
                <option value="Ternate">Ternate</option>
              </select>
            </div>
        </div> -->
        <div class="mb-3 row">
          <label for="balance" class="col-md-4 form-label"><strong>Balance</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="balance" name="balance" step="any" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="interestRate" class="col-md-4 form-label"><strong>Interest Rate (%)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="interestRate" name="interestRate" step="any" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="terms" class="col-md-4 form-label"><strong>Terms (in Days)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="terms" name="terms" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="maturityDate" class="col-md-4 form-label"><strong>Maturity Date</strong></label>
            <div class="col-md-5">
              <input type="date" class="form-control" id="maturityDate" name="maturityDate" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="uponMaturity" class="col-md-4 form-label"><strong>Interest Upon Maturity</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="uponMaturity" name="uponMaturity" step="any" readonly Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="remarks" class="col-md-4 form-label"><strong>Remarks</strong></label>
            <div class="col-md-5">
              <input type="text" class="form-control" id="remarks" name="remarks">
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success upload-btn" id="tdAdd">Check</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Roll Over -->
<div class="modal fade" id="timedepositRO" data-backdrop="static" tabindex="-1" aria-labelledby="timedepositROLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="timedepositROLabel"><strong>ROLL OVER</strong></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="timedepositROForm" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="trid" id="trid" value="">
        <div class="mb-3 row">
          <label for="rbankName" class="col-md-4 form-label"><strong>Name of Bank</strong></label>
            <div class="col-md-5">
              <input type="text" class="form-control" name="rbankName" id="rbankName" readonly Required>
                <!-- <option value="" selected disabled>-Select Branch-</option>
                <option value="Bank of Makati">Bank of Makati</option>
                <option value="Cebuana Lhuillier">Cebuana Lhuillier</option>
                <option value="Producers Bank">Producers Bank</option>
                <option value="PSbank">PSbank</option>
                <option value="Philippine Nation Bank">Philippine National Bank</option>
                <option value="UCPB Savings Bank">UCPB Savings Bank</option>
              </select> -->
            </div>
        </div>
        <!-- <div class="mb-3 row">
          <label for="rbranchName" class="col-md-4 form-label"><strong>Branch</strong></label>
            <div class="col-md-5">
              <select class="form-control" name="rbranchName" id="rbranchName" Required>
                <option value="" selected disabled>-Select Branch-</option>
                <option value="Head Office">Head Office</option>
                <option value="Poblacion">Poblacion</option>
                <option value="Noveleta">Noveleta</option>
                <option value="Manggahan">Manggahan</option>
                <option value="Magallanes">Magallanes</option>
                <option value="Maragondon">Maragondon</option>
                <option value="Ternate">Ternate</option>
              </select>
            </div>
        </div> -->
        <div class="mb-3 row">
          <label for="rbalance" class="col-md-4 form-label"><strong>Balance</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="rbalance" name="rbalance" step="any" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rinterestRate" class="col-md-4 form-label"><strong>Interest Rate (%)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="rinterestRate" name="rinterestRate" step="any" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rterms" class="col-md-4 form-label"><strong>Terms (in Days)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="rterms" name="rterms" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rmaturityDate" class="col-md-4 form-label"><strong>Maturity Date</strong></label>
            <div class="col-md-5">
              <input type="date" class="form-control" id="rmaturityDate" name="rmaturityDate" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="ruponMaturity" class="col-md-4 form-label"><strong>Interest Upon Maturity</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="ruponMaturity" name="ruponMaturity" step="any"  readonly Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rremarks" class="col-md-4 form-label"><strong>Remarks</strong></label>
            <div class="col-md-5">
              <input type="text" class="form-control" id="rremarks" name="rremarks" >
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success upload-btn" id="tdRO">Check</button>
        </form>
      </div>
    </div>
  </div>
</div>

        <!-- Script -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script>
    // Get the input elements
    const balanceInput = document.getElementById('balance');
    const interestRateInput = document.getElementById('interestRate');
    const termsInput = document.getElementById('terms');
    const maturityDateInput = document.getElementById('maturityDate');
    const uponMaturityInput = document.getElementById('uponMaturity');

    // Listen for changes in the input fields
    balanceInput.addEventListener('input', calculateUponMaturity);
    interestRateInput.addEventListener('input', calculateUponMaturity);
    termsInput.addEventListener('input', calculateUponMaturity);
    maturityDateInput.addEventListener('input', calculateUponMaturity);

    // Function to calculate the uponMaturity value
    function calculateUponMaturity() {
    // Get the values from the input fields
    const balance = parseFloat(balanceInput.value);
    const interestRate = parseFloat(interestRateInput.value);
    const terms = parseFloat(termsInput.value);

    // Perform calculation
    let uponMaturity = ((balance * (interestRate / 100) * terms) / 360) * (0.80);

    // Truncate the value to two decimal places without rounding off
    uponMaturity = Math.floor(uponMaturity * 100) / 100;

    // Set the calculated value to the uponMaturity input field
    uponMaturityInput.value = uponMaturity.toFixed(2);
}
</script>

<script>
    // Get the input elements
    const balanceInput2 = document.getElementById('rbalance');
    const interestRateInput2 = document.getElementById('rinterestRate');
    const termsInput2 = document.getElementById('rterms');
    const maturityDateInput2 = document.getElementById('rmaturityDate');
    const uponMaturityInput2 = document.getElementById('ruponMaturity');

    // Listen for changes in the input fields
    balanceInput2.addEventListener('input', calculateUponMaturity2);
    interestRateInput2.addEventListener('input', calculateUponMaturity2);
    termsInput2.addEventListener('input', calculateUponMaturity2);
    maturityDateInput2.addEventListener('input', calculateUponMaturity2);

    // Function to calculate the uponMaturity value
    function calculateUponMaturity2() {
    // Get the values from the input fields
    const balance2 = parseFloat(balanceInput2.value);
    const interestRate2 = parseFloat(interestRateInput2.value);
    const terms2 = parseFloat(termsInput2.value);

    // Perform calculation
    let uponMaturity2 = ((balance2 * (interestRate2 / 100) * terms2) / 360) * (0.80);

    // Truncate the value to two decimal places without rounding off
    uponMaturity2 = Math.floor(uponMaturity2 * 100) / 100;

    // Set the calculated value to the uponMaturity input field
    uponMaturityInput2.value = uponMaturity2.toFixed(2);
}
</script>

        <!-- Fetch -->
<script type="text/javascript">
    $(document).ready(function() {
        var mytable = $('#reporttbl').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
          if(aData[5] == 'Head/BM Followed Up') {
            $(nRow).addClass('hiLi');
          }
        },
        'serverSide': true,
        'processing': true,
        'paging': true,
        'responsive': true,
        'autoWidth': false,
        "info": false, 
        "JQueryUI": true, 
        "ordering": true, 
        'order': [],
        'ajax': {
          'url': 'fetch_TD.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [8] //total tables.
          },
        ]
      });
    });
    
      /* Submit Update Form */
  $(document).on('submit', '#timedepositROForm', function(e) {
    e.preventDefault();
    //var tr = $(this).closest('tr');
    var rbankName = $('#rbankName').val();
    // var rbranchName = $('#rbranchName').val();
    var rbalance = $('#rbalance').val();
    var rinterestRate = $('#rinterestRate').val();
    var rterms = $('#rterms').val();
    var rmaturityDate = $('#rmaturityDate').val();
    var ruponMaturity = $('#ruponMaturity').val();
    var rremarks = $('#rremarks').val();
    var fd = new FormData(this);
    var trid = $('#trid').val();
    var id = $('#id').val();
    if (rbalance != '' && rinterestRate != '') {
      $.ajax({
        url: "tTimeDepositRollOver.php",
        type: "post",
        data: fd,
        contentType: false,
        processData: false,
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'success') {
            // var button = '<td><a href="javascript:void(0);" data-id="' + id + '" class="btn btn-info btn-sm btnX">Edit</a>';
            mytable = $('#reporttbl').DataTable();
            mytable.draw();
            mytable.ajax.reload();
            $('#timedepositRO').modal('hide');
            alert('Successfully Updated!');
          } else {
            alert('failed');
          }
        },
        error: function(xhr, status, error) {
          var err = eval("(" + xhr.responseText + ")");
          alert(err.Message);
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  });

    $(document).on('click', '.btnCheck', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure you want to Transfer this?")) {
        $.ajax({
          url: "tTimeDepositTransfer.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if(status == 'success') {
              $("#" + id).closest('tr').remove();
              alert('Success!');
              mytable.ajax.reload();
            }else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    });

    $('#reporttbl').on('click', '.btnX ', function(event) {
      var mytable = $('#reporttbl').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
      $('#timedepositRO').modal('show');
      $.ajax({
        url: "get_single_data3.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#rbankName').val(json.dBank);
          // $('#rbranchName').val(json.dBranch);
          $('#rbalance').val(json.dBalance);
          $('#rinterestRate').val(json.dInterest);
          $('#rterms').val(json.dTerm);
          $('#rmaturityDate').val(json.dMaturity);
          $('#ruponMaturity').val(json.dUponMaturity);
          $('#rremarks').val(json.dRemarks);
          $('#id').val(id);
          $('#trid').val(id);
        }
      })
    });

  $(document).on('submit', '#timedepositForm', function(e) {
    // $("#timedepositAdd").attr('disabled','true');
    // $("#timedepositAdd").attr('value','Processing...');
    e.preventDefault();
    var bankName = $('#bankName').val();
    // var branchName = $('#branchName').val();
    var parValue = $('#balance').val();
    var interestRate = $('#interestRate').val();
    var terms = $('#terms').val();
    var maturityDate = $('#maturityDate').val();
    var uponMaturity = $('#uponMaturity').val();
    var remarks = $('#remarks').val();
    

    var fd = new FormData(this);

    if(parValue <= 99999999){
      if (bankName !== '' && parValue !== '' && terms !== '' && interestRate !== '' && maturityDate !== '' && uponMaturity !== '') {
        // Proceed with AJAX request
        $.ajax({
          url: "add_timedeposit.php",
          type: "post",
          data: fd,
          contentType: false,
          processData: false,
          success: function(data) {
            var response = JSON.parse(data);
            if (response['result']) {
              mytable = $('#reporttbl').DataTable();
              mytable.draw();
              mytable.ajax.reload();
              $('#timedepositAdd').modal('hide');
              alert(response['message']);
              $('#timedepositForm')[0].reset();
              window.location.reload();
            } else {
              alert(response['message']);
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    }


      // Check if the par value exceeds the threshold
    if (parValue >= 100000000) {
      // Confirm action if the threshold is exceeded and bank is not allowed
      if (bankName !== "UCPB Savings Bank" && bankName !== "Land Bank of the Philippines") {
          if (!confirm("You have Exceeded the Amount Limit of P100,000,000.00. Do you still want to proceed?")) {
              return; // Exit if user cancels
          }else{
            // Ensure all required fields are filled
            if (bankName !== '' && parValue !== '' && terms !== '' && interestRate !== '' && maturityDate !== '' && uponMaturity !== '' && remarks !== '') {
              // Proceed with AJAX request
              $.ajax({
                url: "add_timedeposit.php",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                  var response = JSON.parse(data);
                  if (response['result']) {
                    mytable = $('#reporttbl').DataTable();
                    mytable.draw();
                    mytable.ajax.reload();
                    $('#timedepositAdd').modal('hide');
                    alert(response['message']);
                    $('#timedepositForm')[0].reset();
                    window.location.reload();
                  } else {
                    alert(response['message']);
                  }
                }
              });
            } else {
              alert('Fill all the required fields');
            }
          }
      }else{
        if (bankName !== '' && parValue !== '' && terms !== '' && interestRate !== '' && maturityDate !== '' && uponMaturity !== '' && remarks !== '') {
          // Proceed with AJAX request
          $.ajax({
            url: "add_timedeposit.php",
            type: "post",
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
              var response = JSON.parse(data);
              if (response['result']) {
                mytable = $('#reporttbl').DataTable();
                mytable.draw();
                mytable.ajax.reload();
                $('#timedepositAdd').modal('hide');
                alert(response['message']);
                $('#timedepositForm')[0].reset();
                window.location.reload();
              } else {
                alert(response['message']);
              }
            }
          });
        } else {
          alert('Fill all the required fields');
        }
      }
    }
  });

</script>
<!-- <script type="text/javascript" src="./js/timeDeposit.js"></script> -->
</body>
</html>