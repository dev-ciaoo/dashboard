<?php
include('connection.php');
// require 'auth_check.php';
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
@media screen and (max-width: 1921px){
  @-ms-viewport { }
  body {
    zoom: 100%;
  }
}
   /* 125% */
   @media screen and (max-width: 1536px){
  @-ms-viewport { }
  body {
    zoom: 80%;
  }
}

/* @media screen and (max-width: 1746.45px){
  @-ms-viewport { }
  body {
    zoom: 95%;
  }
} */
  /* 150% */
  @media screen and (max-width: 1281px){
  @-ms-viewport { }
  body {
    zoom: 67%;
  }
  
}

@media screen and (max-width: 1098.14px){
  @-ms-viewport { }
  body {
    zoom: 50%;
  }
}

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
      <h3>TREASURY BILLS</h3> 
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
                if($_SESSION['department'] != 1){
                  echo '';
                }else{
                  echo '<button class="btn btn-warning" id="btnAdd" data-bs-toggle="modal" data-bs-target="#treasuryAdd" type="button">Add +</button>';
                }
                ?>
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th>Bank</th>
                <th >Branch</th>
                <th>Par Value</th>
                <th>Terms (in Days)</th>
                <th>Interest Rate (%)</th>
                <th>Maturity Date</th>
                <th>Net Interest</th>
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

<!-- Add Treasury Bill -->
<div class="modal fade" id="treasuryAdd" data-backdrop="static" tabindex="-1" aria-labelledby="treasuryAddLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="treasuryAddLabel"><strong>TREASURY BILL +</strong></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="treasuryForm" method="post" enctype="multipart/form-data">
        <div class="mb-3 row">
          <label for="bankName" class="col-md-4 form-label"><strong>Name of Bank</strong></label>
            <div class="col-md-5">
              <select class="form-control" name="bankName" id="bankName" Required>
                <option value="" selected disabled>-Select Branch-</option>
                <option value="Chinabank">China Bank</option>
                <option value="Metrobank">Metro bank</option>
                <option value="Philippine Veterans Bank">Philippine Veterans Bank</option>
                <option value="PNB">PNB</option>
                <option value="RCBC">RCBC</option>
                  <!-- <option value="Poblacion">Poblacion</option>
                  <option value="Ternate">Ternate</option> -->
              </select>
            </div>
        </div>
        <div class="mb-3 row">
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
        </div>
        <div class="mb-3 row">
          <label for="parValue" class="col-md-4 form-label"><strong>Par Value</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="parValue" name="parValue" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="terms" class="col-md-4 form-label"><strong>Terms (in Days)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="terms" name="terms" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="interestRate" class="col-md-4 form-label"><strong>Interest Rate (%)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="interestRate" name="interestRate" step="any" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="maturityDate" class="col-md-4 form-label"><strong>Maturity Date</strong></label>
            <div class="col-md-5">
              <input type="date" class="form-control" id="maturityDate" name="maturityDate" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="netInterest" class="col-md-4 form-label"><strong>Net Interest</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="netInterest" name="netInterest" step="any" Required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success upload-btn" id="treasuryAdd">Check</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Roll Over Treasury Bill -->
<div class="modal fade" id="treasuryRO" data-backdrop="static" tabindex="-1" aria-labelledby="treasuryROLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="treasuryROLabel"><strong>ROLL OVER</strong></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="treasuryROForm" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="trid" id="trid" value="">
        <div class="mb-3 row">
          <label for="rbankName" class="col-md-4 form-label"><strong>Name of Bank</strong></label>
            <div class="col-md-5">
              <select class="form-control" name="rbankName" id="rbankName" readonly Required>
                <option value="" selected disabled>-Select Branch-</option>
                <option value="Chinabank">China Bank</option>
                <option value="Metrobank">Metro bank</option>
                <option value="Philippine Veterans Bank">Philippine Veterans Bank</option>
                <option value="PNB">PNB</option>
                <option value="RCBC">RCBC</option>
                  <!-- <option value="Poblacion">Poblacion</option>
                  <option value="Ternate">Ternate</option> -->
              </select>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rbranchName" class="col-md-4 form-label"><strong>Branch</strong></label>
            <div class="col-md-5">
              <select class="form-control" name="rbranchName" id="rbranchName" readonly Required>
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
        </div>
        <div class="mb-3 row">
          <label for="rparValue" class="col-md-4 form-label"><strong>Par Value</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="rparValue" name="rparValue" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rterms" class="col-md-4 form-label"><strong>Terms (in Days)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="rterms" name="rterms" readonly Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rinterestRate" class="col-md-4 form-label"><strong>Interest Rate (%)</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="rinterestRate" name="rinterestRate" step="any" Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rmaturityDate" class="col-md-4 form-label"><strong>Maturity Date</strong></label>
            <div class="col-md-5">
              <input type="date" class="form-control" id="rmaturityDate" name="rmaturityDate" readonly Required>
            </div>
        </div>
        <div class="mb-3 row">
          <label for="rnetInterest" class="col-md-4 form-label"><strong>Net Interest</strong></label>
            <div class="col-md-5">
              <input type="number" class="form-control" id="rnetInterest" name="rnetInterest" step="any" readonly Required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success upload-btn" id="treasuryRoll">Roll Over</button>
        </form>
      </div>
    </div>
  </div>
</div>

        <!-- Script -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>



        <!-- Fetch -->
<script type="text/javascript">
    $(document).ready(function() {
    var mytable = $('#reporttbl').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
            if (aData[5] == 'Head/BM Followed Up') {
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
        'order': [], // Remove default ordering
        'ajax': {
            'url': 'fetch_TBforViewing.php',
            'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5] // Column index to disable sorting
        }],
        // "order": [] // Default to no sorting initially
    });
    });

    /* Submit Update Form */
  $(document).on('submit', '#treasuryROForm', function(e) {
    e.preventDefault();
    //var tr = $(this).closest('tr');
    var tBank = $('#rbankName').val();
    var tBranch = $('#rbranchName').val();
    var tParValue = $('#rparValue').val();
    var tTerms = $('#rterms').val();
    var tInterest = $('#rinterestRate').val();
    var tMaturity = $('#rmaturityDate').val();
    var tNetInterest = $('#rnetInterest').val();
    var fd = new FormData(this);
    // var trid = $('#trid').val();
    // var id = $('#id').val();
    if (tParValue != '' && tInterest != '') {
      $.ajax({
        url: "tTreasuryBillRollOver.php",
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
            $('#treasuryRO').modal('hide');
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
      if (confirm("Are you sure you want to close this?")) {
        $.ajax({
          url: "tTreasuryBillTransfer.php",
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
      $('#treasuryRO').modal('show');
      $.ajax({
        url: "get_single_data2.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#rbankName').val(json.tBank);
          $('#rbranchName').val(json.tBranch);
          $('#rparValue').val(json.tParValue);
          $('#rterms').val(json.tTerms);
          $('#rinterestRate').val(json.tInterest);
          $('#rmaturityDate').val(json.tMaturity);
          $('#rnetInterest').val(json.tNetInterest);
          $('#id').val(id);
          $('#trid').val(id);
        }
      })
    });
</script>
<script type="text/javascript" src="./js/treasuryAdd.js"></script>
<!-- <script type="text/javascript" src="./js/treasuryRollOver.js"></script> -->
</body>
</html>