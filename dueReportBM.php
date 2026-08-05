<?php
include('connection.php');
require 'auth_check.php';


// $sqlPlease = "SELECT loan_Id FROM loan";
// $queryPlease = mysqli_query($con, $sqlPlease);
// $dataP = mysqli_fetch_array($sqlPlease);

// $dataPlease = $dataP['loan_Id'];
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
    /* .center {
        position: relative;
        text-align: left;
    } */
    #totalBal {
      position: relative;
        font-family: "Source Sans Pro", sans-serif;
        color: #656565;
        margin: 10px 0 0;
        background-color: lightyellow;
    }
    #collected {
        position: relative;
        font-family: "Source Sans Pro", sans-serif;
        color: #656565;
        margin: 10px 0 0;
        background-color: lightgreen;
    }
    #uncollected {
        font-family: "Source Sans Pro", sans-serif;
        color: #656565;
        margin: 10px 0 0;
        background-color: pink;
    }
    @media prdouble{
      #prdoubleThis, #reporttbl_filter, #reporttbl_paginate, #reporttbl_length{
        visibility: hidden;
      }
      
      #form-select{
        visibility: hidden;
      }

      /* Define custom styles for the prdoubleed content */
    body.prdouble-preview {
      font-size: 14px;
      line-height: 1.5;
    }

    /* Add more custom styles here */

    /* Hide unnecessary elements during prdoubleing */
    #collectedModal .modal-footer {
      display: none;
    }
    }
    
  </style>
</head>
<script>
function reloadPage(){
  window.location = '';
}
</script>
<body>


  <input type="hidden" id="secretLamang" name="secretLamang" value="<?= $dataPlease; ?>">
  
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
                    <button onclick="window.print();" class="btn btn-primary btn-md prdoubleBtn" id="prdoubleThis" name="prdoubleThis">Print</button>
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
              </thead>
              <tbody id = "tbody-insert">
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
            <div class="center">
            <?php
            if($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
              $sqlSum = "SELECT SUM(duecPrincipalBal) as bal FROM `duecollection` as d 
                                LEFT JOIN loan as l ON l.loan_Id = d.duecLoanId
                                WHERE l.branch = '" . $_SESSION['address'] . "' ";
              $querySum = mysqli_query($con, $sqlSum);
              $deyta = mysqli_fetch_array($querySum);
  
              $collect1 = (double)$deyta['bal'];
  
              $sqlSub = "SELECT SUM(colPrincipalBal) as bal2 FROM `collectionarchive` WHERE colBranch = '" . $_SESSION['address'] . "' ";
              $querySub = mysqli_query($con, $sqlSub);
              $deyta2 = mysqli_fetch_assoc($querySub);
  
              $collect2 = (double)$deyta2['bal2'];
  
              $sub = ((double)$collect2 - (double)$collect1);
            }
            else{
              if($_SESSION['position'] == 'BM' && $_SESSION['address'] == 'Head Office')
                $sqlSum = "SELECT SUM(duecPrincipalBal) as bal FROM `duecollection` as d 
                                LEFT JOIN loan as l ON l.loan_Id = d.duecLoanId
                                WHERE l.branch = 'Head Office'
                          ";
                $querySum = mysqli_query($con, $sqlSum);
                $deyta = mysqli_fetch_array($querySum);
    
                $collect1 = (double)$deyta['bal'];
    
                $sqlSub = "SELECT SUM(colPrincipalBal) as bal2 FROM `collectionarchive` WHERE colBranch = 'Head Office'";
                $querySub = mysqli_query($con, $sqlSub);
                $deyta2 = mysqli_fetch_assoc($querySub);
    
                $collect2 = (double)$deyta2['bal2'];
    
                $sub = ((double)$collect2 - (double)$collect1);
            }
          

            // $postMalone = $_POST['secretLamang'];
            $postTalone = $_POST['testLamang'];
            $sqlLoans = "SELECT * FROM loan WHERE customerFullName = '$postTalone'";
            $queryLoans = mysqli_query($con, $sqlLoans);
            if($queryLoans == true){
              $rowLoans = mysqli_num_rows($queryLoans);
                // $selectLoansFullName = $rowLoans['customerFullName'];
            }
            // echo $rowLoans;

// <!-- Button trigger modal -->
            ?>
           <div class="center">
              <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#totalModal"><span for="" id="collected"><span for="" id="totalBal"><b>TOTAL AMOUNT OVERDUE : &nbsp;&nbsp; <?php echo number_format($collect1, 2, '.', ', '); ?></b></br></span></a> <!-- total account balance display -->
            </div>
            <div class="center">
              <span for="" id="uncollected"><b>TOTAL UNCOLLECTED : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $formatted2 = number_format($collect2, 2, '.', ', '); ?></b></span> <!-- uncollected -->
            </div>
            <div class="center">
              <a a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#collectedModal"><span for="" id="collected"><b>TOTAL COLLECTED : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $formatted3 = number_format($sub, 2, '.', ', '); ?> </br></span></a> <!-- collected*** -->
            </div>
          </div>
      </div>
    </div>
  </div>
  <div>
</section>

<section>
<div class="modal fade" id="collectedModal" data-backdrop="static" tabindex="-1" aria-labelledby="collectedModal"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dueCollectionLabel">Collected</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
        $sqlL = "SELECT * FROM duecollection";
        $queryL = mysqli_query($con, $sqlL);
        if(mysqli_num_rows($queryL) > 0){
          while($dataL = mysqli_fetch_assoc($queryL)){
            $dataVal = $dataL['duecProdID'];
            ?>
            <form id="hiddenAgenda" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="secretTO" name="secretTO" value="<?= $dataVal; ?>">
              <input type="hidden" id="testLamang" name="testLamang" value="<?= $dataL['duecBName']; ?>">
            </form>
            <?php
          }
        }
        ?>
        <table id="modalCollected" class="table table-bordered" width="100%" height="auto" cellspacing="0">
          <thead>
            <th style=" width: 8px;">Branch</th>
            <th style="width: 100px;">Product ID</th>
            <th>Borrower's Name</th>
            <th>Product Type</th>
            <th>Amount Over Due</th>
            <th>Account Bal.</th>
          </thead>
        </table>
      </div>
        <div class="modal-footer">
          <!-- <button onclick="prdoubleModalContent();" class="btn btn-primary">Prdouble</button> -->
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section>
  <div class="modal fade" id="totalModal" data-backdrop="static" tabindex="-1" aria-labelledby="totalModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="totalModalLabel">Total</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <?php
          $sqlL = "SELECT * FROM duecollection";
          $queryL = mysqli_query($con, $sqlL);
          if(mysqli_num_rows($queryL) > 0){
            while($dataL = mysqli_fetch_assoc($queryL)){
              $dataVal = $dataL['duecProdID'];
              ?>
              <form id="hiddenAgenda" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="secretTO" name="secretTO" value="<?= $dataVal; ?>">
                <input type="hidden" id="testLamang" name="testLamang" value="<?= $dataL['duecBName']; ?>">
              </form>
              <?php
            }
          }
          ?>
          <table id="totalCollected" class="table table-bordered" width="100%" height="auto" cellspacing="0">
            <thead>
              <th style=" width: 8px;">Branch</th>
              <th style="width: 100px;">Product ID</th>
              <th>Borrower's Name</th>
              <th>Product Type</th>
              <th>Amount Over Due</th>
              <th>Account Bal.</th>
            </thead>
          </table>
        </div>
          <div class="modal-footer">
            <!-- <button onclick="printModalContent();" class="btn btn-primary">Print</button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div id="displayhere"></div>

<!-- CsV Upload -->
<!-- <div class="modal fade" id="dueCollection" data-backdrop="static" tabindex="-1" aria-labelledby="dueCollection"
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
</div> -->

                        <!-- Script -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <!-- <script type="text/javascript" src="js/prdoubleThis.js"></script> -->
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
          'url': 'fetch_dueReport.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [12] //total table to be shown.
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
    });

</script>

<script type="text/javascript">
  $(document).ready(function() {
        var hiddenId = document.getElementById('hiddenAgenda');
        var secretTO = $('#secretTO').val();
        var hidden = new FormData(hiddenId);
        var mytable = $('#modalCollected').DataTable({
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
          'url': 'fetch_due.php',
          'type': 'post',
          'data': 'hidden',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [5] //total table to be shown.
          },
        ]
      });
    });
</script>

<script type="text/javascript">
  $(document).ready(function() {
        var hiddenId = document.getElementById('hiddenAgenda');
        var secretTO = $('#secretTO').val();
        var hidden = new FormData(hiddenId);
        var mytable = $('#totalCollected').DataTable({
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
          'url': 'fetch_totalAmount.php',
          'type': 'post',
          'data': 'hidden',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [5] //total table to be shown.
          },
        ]
      });
    });
</script>

<script>
function prdoubleModalContent() {
  var modalContent = document.getElementById('modalCollected').innerHTML;

  // Create a new window for the prdouble preview
  var prdoubleWindow = window.open('', '', 'width=800,height=600');

  // Write the modal content to the prdouble preview window
  prdoubleWindow.document.open();
  // prdoubleWindow.document.write('<html><head><title>Prdouble Preview</title>');

  // Link the custom prdouble stylesheet for styling the prdouble version
  // prdoubleWindow.document.write('<link rel="stylesheet" type="text/css" href="prdouble-styles.css">');

  prdoubleWindow.document.write('</head><body class="prdouble-preview">');
  prdoubleWindow.document.write(modalContent);
  prdoubleWindow.document.write('</body></html>');
  prdoubleWindow.document.close();

  // Focus and prdouble the new window
  prdoubleWindow.focus();
  prdoubleWindow.prdouble();

  // Close the prdouble preview window after prdoubleing
  prdoubleWindow.close();
}
</script>

</body>
</html>