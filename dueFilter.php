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
  <title>Due Collection</title>
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
      font-size: 11.5px;
      text-align: center;
    }

    #inventorylogo {
      width: 20%;
      height: auto;
    }

    .flogo {
      text-align: center;
    }

    .pagination, .dataTables_info{
      font-size: 14px;
    }
    /* .hiLi {
      background-color: #48D1CC !important;
    } */
    .btnCheck, .btnX{
      font-size: 13px;
    }
    #btnAdd {
      margin-bottom: 1%;
      /* margin-left: 1850px; */
    }
  </style>
</head>
<script>
function reloadPage(){
  window.location = '';
}
</script>
<body>
<section class="leaveReport">
  <!-- <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div> -->
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>Loan Due Collection</h3> 
    </div>
  </div>
  <br>
  <div class="container-fluid" id="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
                <!-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dueCollection" type="button">Import File</button> -->
        </div>
        
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th style=" width: 8px;">Branch</th>
                <th style="width: 100px;">Product ID</th>
                <th>Borrower's Name</th>
                <th>Mobile #</th>
                <th>Status</th>
                <th>Product Type</th>
                <th>Due Date</th>
                <th>Days Late</th>
                <th>Amount Due</th>
                <th>Over Due</th>
                <th>Account Bal.</th>
                <th>Last Unpaid</th>
                <th>Remarks</th>
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
<div id="displayhere"></div>

<!-- CsV Upload -->
<div class="modal fade" id="dueCollection" data-backdrop="static" tabindex="-1" aria-labelledby="dueCollection"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dueCollectionLabel">Due Collection</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="csvForm" method="post" enctype="multipart/form-data">
          <input type="file" name="csvFile" accept=".csv" required>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-secondary upload-btn" id="csvFile">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>

                        <!-- Script -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script src="js/collectionCSV.js"></script>

        <!-- Fetch -->
<script type="text/javascript">

    $(document).ready(function() {
        var mytable = $('#reporttbl').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
          // if(aData[7] == 'Waiting for Approval') {
          //   $(nRow).addClass('hiLi');
          // }
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'responsive': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_collection.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [11] //total table to be shown.
          },
        ]
      });


    $(document).on('click', '.btnCheckC', function(event) {
    event.preventDefault();
    var Table = $('#reporttbl').DataTable();
    var buttonId = $(this).attr('id');
    var type = $(this).attr('value');
    document.getElementById('reporttbl').style.display = 'none';
    document.getElementById('container-fluid').style.display = 'none';
    var loanTarget ="dueFormSalary.php";

    if (type == "Microfinance") {
      loanTarget = "dueFormMicro.php";
    }
    if (type == "Salary Loan") {
      loanTarget = "dueFormSalary.php";
    }
    if (type == "REM: Corporation") {
      loanTarget = "dueFormCorp.php";
    }
    if (type == "REM: Individual") {
      loanTarget = "dueFormIndividual.php";
    }


    $.ajax({
      type: 'POST',
      url: loanTarget,
      data: {
        loanId: buttonId
      },
      async: false,
      success: function (result) {
        $('#displayhere').html(result);
        $useLoanId = loanIds;
      }
    });
  });

  $(document).on('click', '.btnRemind', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      var letterStatus = prompt("Remarks: ");
      if (letterStatus !== null && letterStatus.trim() !== "") {
        $.ajax({
          url: "dueCollectionRemarks.php",
          data: {
            id: id,
            letterStatus: letterStatus
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Success!');
              // window.location.reload();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    });

});

</script>
</body>
</html>