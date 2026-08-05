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
/* @media screen and (max-width: 1921px){
  @-ms-viewport { }
  #reporttbl {
    zoom: 90%;
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
/* 
@media screen and (max-width: 1098.14px){
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
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;  
    }

    #reporttbl th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      /* background-color: #04AA6D;
      color: white; */
      font-size: 12.5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* #reporttbl tr:nth-child(even){
      background-color: #f2f2f2;
    } */

    #reporttbl tbody tr:hover {
      background-color: #ddd;
    }

    td{
      font-size: 11.5px;
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
    @media print{
      #printThis, #reporttbl_filter, #reporttbl_paginate, #reporttbl_length{
        visibility: hidden;
      }
      
      #form-select{
        visibility: hidden;
      }

      /* Define custom styles for the printed content */
    body.print-preview {
      font-size: 14px;
      line-height: 1.5;
    }

    /* Add more custom styles here */

    /* Hide unnecessary elements during printing */
    #collectedModal .modal-footer {
      display: none;
    }
    }

    #printThis{
      position: relative;
      float: right;
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
                    <button onclick="window.print();" class="btn btn-primary btn-md printBtn" id="printThis" name="printThis">Print</button>

          <?php if($_SESSION['department'] == 1 || $_SESSION['department'] == 15 || $_SESSION['userid'] == 19 || $_SESSION['userid'] == 16 || $_SESSION['userid'] == 29){ ?>
            <form action="" method="POST" id="branchForm" enctype="multipart/form-data">
              <div class="col-md-12">
                <div class="col-md-2">
                  <select class="form-select w-20 selectBranch mb-2 text-center d-flex" name="selectBranch"  id="selectBranch" Required>
                    <option value="" Selected Disabled>-Select Branch-</option>
                    <option value="Head Office">Head Office</option>
                    <option value="Maragondon">Maragondon</option>
                    <option value="Manggahan">Manggahan</option>
                    <option value="Magallanes">Magallanes</option>
                    <option value="Noveleta">Noveleta</option>
                    <option value="Poblacion">Poblacion</option>
                    <option value="Ternate">Ternate</option>
                  </select>
                  <input type="hidden" name="hiddenSelectBranch" id="hiddenSelectBranch" value="">
                </div>
              </div>
            </form>
          <?php } ?>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th>Branch</th>
                <th>Product ID</th>
                <th>Borrower's Name</th>
                <th>Address</th>
                <th>Mobile #</th>
                <th>Status</th>
                <th>Product Type</th>
                <th>Loan Granted</th>
                <th>Loan Maturity</th>
                <th>Due Date</th>
                <th>Days Late</th>
                <th>Principal Bal</th>
                <th>Principal Due</th>
                <th>Interest</th> 
                <th>Penalty</th>
                <th>Total Amount Due</th>
                <th>Last Unpaid</th>
                <th>Remarks of Collection/BM</th>
                <th>System Remarks</th>
                <th>Action</th>
              </thead>
              <tbody id = "tbody-insert">
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
            <div class="center">
            <?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(!empty($selectedBranch)){
    $selectedBranch = $_POST['hiddenSelectBranch'];
    echo 'selected: ' . htmlspecialchars($selectedBranch);
  }else{
    echo 'no branch selected';
  }
}

            // $selectFletter = "SELECT COUNT(firstLetter) as count FROM letterarchive WHERE firstLetter <> '' ";
              // $selectFquery = $con->query($selectFletter);

              // if ($selectFquery) {
              //     $row = $selectFquery->fetch_assoc();
              //     $count = $row['count'];
              // } else {
              //     echo "Query failed: " . $con->error;
              // }

              // $selectSletter = "SELECT COUNT(secondLetter) as count2 FROM letterarchive WHERE secondLetter <> '' ";
              // $selectSquery = $con->query($selectSletter);

              // if ($selectSquery) {
              //     $row2 = $selectSquery->fetch_assoc();
              //     $count2 = $row2['count2'];
              // } else {
              //     echo "Query failed: " . $con->error;
              // }

              // $selectTletter = "SELECT COUNT(thirdLetter) as count3 FROM letterarchive WHERE thirdLetter <> '' ";
              // $selectTquery = $con->query($selectTletter);

              // if ($selectTquery) {
              //     $row3 = $selectTquery->fetch_assoc();
              //     $count3 = $row3['count3'];
              // } else {
              //     echo "Query failed: " . $con->error;
              // }

              // $selectFletter = "SELECT COUNT(finalLetter) as count4 FROM letterarchive WHERE finalLetter <> '' ";
              // $selectFquery = $con->query($selectFletter);

              // if ($selectFquery) {
              //     $row4 = $selectFquery->fetch_assoc();
              //     $count4 = $row4['count4'];
              // } else {
              //     echo "Query failed: " . $con->error;
            // }

            // Query to calculate the total amount overdue from the 'duecollection' table
            // $sqlSum = "SELECT SUM(duecTotalAmountDue) AS perfBal FROM `duecollection` 
            //                                                   WHERE duecProdType <> 'SCR' 
            //                                                       AND (
            //                                                             (duecProdType NOT IN ('Microfinance Loan', 'Microfinance Plus', 'Salary Loan', 'Employee Loan') AND duecDLate >= 31) OR
            //                                                             (duecProdType IN ('Microfinance Loan', 'Microfinance Plus') AND duecDLate >= 8) OR
            //                                                             (duecProdType IN ('Salary Loan', 'Employee Loan') AND duecDLate >= 16)
            //                                                           )
                                                                  
            //           ";
            // $querySum = mysqli_query($con, $sqlSum);
            // $deyta = mysqli_fetch_assoc($querySum);

            // $collect1 = (double)$deyta['perfBal'];

            // Query to calculate the total amount overdue from the 'collection' table
            // $sqlSub = "SELECT SUM(colTotalAmountDue) AS bal2 FROM `collectionarchive` 
            //                                                 WHERE colProdType <> 'SCR'
            //                                                       AND (
            //                                                             (colProdType NOT IN ('Microfinance Loan', 'Microfinance Plus', 'Salary Loan', 'Employee Loan') AND colDueLate >= 31) OR
            //                                                             (colProdType IN ('Microfinance Loan', 'Microfinance Plus') AND colDueLate >= 8) OR
            //                                                             (colProdType IN ('Salary Loan', 'Employee Loan') AND colDueLate >= 16)
            //                                                           )
            //           ";
            // $querySub = mysqli_query($con, $sqlSub);
            // $deyta2 = mysqli_fetch_assoc($querySub);
            // $collect2 = (double)$deyta2['bal2'];
            
            // $sub = $total- $total2;
            $total1 = $collect1;
            $total2 = $collect2;
            $sub2 = $total2 - $total1;

            // Get the value of 'testLamang' from the POST request
            $postTalone = isset($_POST['testLamang']) ? $_POST['testLamang'] : "";

            // Query to fetch data from the 'loan' table based on 'customerFullName'
            if (!empty($postTalone)) {
                $sqlLoans = "SELECT * FROM loan WHERE customerFullName = '$postTalone'";
                $queryLoans = mysqli_query($con, $sqlLoans);
                $rowLoans = mysqli_num_rows($queryLoans);
            }

            // Display the results
            ?>
            <div class="center">
              <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#totalModal">
                    <span for="" id="collected"><span for="" id="totalBal">
                </span>
              </a>
            </div>
            <div class="center">
                  <span for="" id="uncollected"><span for="" id="uncollectedd">
                </span> <!-- uncollected -->
                
            </div>
            <div class="center">
                <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#collectedModal"><span for="" id="collected">
                <b>TOTAL COLLECTED : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format($sub2, 2, '.', ', '); ?> </br></span></a> <!-- collected*** -->
            </div>
            <br>
            <!-- <div class="center">
                <span for="" id="uncollected">FIRST LETTER : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $count; ?></span> 
            </div>
            <div class="center">
                <span for="" id="uncollected">SECOND LETTER : &nbsp;&nbsp; <?php echo $count2; ?></span> 
            </div>
            <div class="center">
                <span for="" id="uncollected">THIRD LETTER : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $count3; ?></span> 
            </div>
            <div class="center">
                <span for="" id="uncollected">FINAL LETTER : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $count4; ?></span> 
            </div>
          </div> -->
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
              <th>Branch</th>
              <th>Product ID</th>
              <th>Borrower's Name</th>
              <th>Product Type</th>
              <th>Principal Bal</th>
              <!-- <th>Principal Due</th>
              <th>Interest</th>
              <th>Penalty</th> -->
              <th>Total Amount Due</th>
              <th>Days Late</th>
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

<section>
  <div class="modal fade" id="totalModal" data-backdrop="static" tabindex="-1" aria-labelledby="totalModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="totalModalLabel">Today's Total</h5>
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
              <th>Branch</th>
              <th>Product ID</th>
              <th>Borrower's Name</th>
              <th>Product Type</th>
              <th>Principal Bal</th>
              <!-- <th>Principal Due</th>
              <th>Interest</th>
              <th>Penalty</th> -->
              <th>Total Amount Due</th>
              <th>Days Late</th>
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

                        <!-- Script -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <!-- <script type="text/javascript" src="js/printThis.js"></script> -->
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
        'serverSide': true,
        'processing': true,
        'paging': true,
        'responsive': true,
        'autoWidth': false,
        'order': [],
        'ajax': {
          'url': 'fetch_dueReport.php',
          'type': 'post',
        },
        'columnDefs': [
          { "orderable": true, "targets": [0, 2, 5, 6, 10] },
          { "orderable": false, "targets": '_all'}
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
        var branchh = $('#selectBranch').val();
        var hidden = new FormData(hiddenId);
        hidden.append('branchh', branchh);
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
            "aTargets": [] //total table to be shown.
          },
        ]
      });
    });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#totalBal', function(e){
      var hiddenId = document.getElementById('hiddenAgenda');
        var secretTO = $('#secretTO').val();
        var branchh = $('#selectBranch').val();
        var hidden = new FormData(hiddenId);
        hidden.append('branchh', branchh);


        var mytable = $('#totalCollected').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
          // if(aData[7] == 'Waiting for Approval') {
          //   $(nRow).addClass('hiLi');
          // }
        },
        'serverSide': true,
        'processing': true,
        'paging': true,
        'responsive': true,
        'order': [],
        'destroy': true,
        'ajax': {
          'url': 'fetch_totalAmount.php',
          'type': 'post',
          'data': function(d){
              d.branchh = branchh;
          },
          'dataSrc': function(json){
            return json.data;
          }
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [] //total table to be shown.
          },
        ]
      });

      // $('#totalModal').modal.('show');
    });
  });
</script>

<script>
$(document).ready(function(){
  $(document).on('change', '.selectBranch', function(event) {
    event.preventDefault();
    var branch = $(this).val();
    $('#hiddenSelectBranch').val(branch);

  fetchReportTbl(branch);

  fetchSumRecord(branch);

  fetchSumRecord2(branch)
    
  });
});

function fetchReportTbl(branch){
  $.ajax({
    url: "fetch_dueReport.php",
    type: "POST",
    data: { branch: branch },
    success: function(data) {
        console.log(branch);
        console.log(data);
        $('#hiddenSelectBranch').val(branch);
        if ($.fn.DataTable.isDataTable('#reporttbl')) {
            $('#reporttbl').DataTable().destroy();
        }
        $('#reporttbl tbody').empty().html(data);
        $('#reporttbl').DataTable({
            "autoWidth": false, 
            "info": false, 
            "jQueryUI": true, 
            "ordering": true, 
            "paging": true, 
            "bSortable": true,
            "responsive": true
        });
    },
    error: function(xhr, status, error) {
        console.error('An error occurred:', xhr.responseText);
    }
  });
}

function fetchSumRecord(branch){
  $.ajax({
    url: "fetch_dueReport_wBranch.php",
    type: "POST",
    data: { branch: branch },
    success: function(data){
      console.log(branch + " SUM: " + data);
      $("#totalBal").html(data);
    },
    error: function(xhr, status, error){
      console.error("An Error occured in fetch_dueReport_wBranch.php: ", xhr.responseText);
    }
  });
}

function fetchSumRecord2(branch){
  $.ajax({
    url: "fetch_dueReport_wBranch2.php",
    type: "POST",
    data: { branch: branch },
    success: function(data){
      console.log(branch + " SUM: " + data);
      $("#uncollectedd").html(data);
    },
    error: function(xhr, status, error){
      console.error("An Error occured in fetch_dueReport_wBranch2.php: ", xhr.responseText);
    }
  });
}

function fetchSumRecord3(branch){
  $.ajax({
    url: "fetch_dueReport_wBranch3.php",
    type: "POST",
    data: { branch: branch },
    success: function(data){
      console.log(branch + " SUM: " + data);
      $("#uncollectedd").html(data);
    },
    error: function(xhr, status, error){
      console.error("An Error occured in fetch_dueReport_wBranch3.php: ", xhr.responseText);
    }
  });
}

</script>

<script>
function printModalContent() {
  var modalContent = document.getElementById('modalCollected').innerHTML;

  // Create a new window for the print preview
  var printWindow = window.open('', '', 'width=800,height=600');

  // Write the modal content to the print preview window
  printWindow.document.open();

  printWindow.document.write('</head><body class="print-preview">');
  printWindow.document.write(modalContent);
  printWindow.document.write('</body></html>');
  printWindow.document.close();

  // Focus and print the new window
  printWindow.focus();
  printWindow.print();

  // Close the print preview window after printing
  printWindow.close();
}
</script>

</body>
</html>

<?php

$selectBranchh = $_POST['selectBranch'];
echo $selectBranchh;
?>