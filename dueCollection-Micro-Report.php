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
  <title>OUR Bank Inventory</title>
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
  table{
    font-size: 12.4px;
  }

    h3{
      font-family: "Source Sans Pro", sans-serif;
      margin: 30px 0 20px;
      color: #656565;
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
      font-size: 11.5px;
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

    #inventorylogo {
      width: 20%;
      height: auto;
    }

    .flogo {
      text-align: center;
    }

    #formReport {
      /* border-radius: 50%; */
      float: left;
      border-style: groove;
      /* background-color: red; */
      padding-top: 0.5%;
      padding-bottom: 1%;
      padding-left: 15px;
      padding-right: 15px;
      width: 21.4rem;
      height: auto;
      /* margin-right: 1000px; */
    }

    /* #formTitle {
      margin-left: 10px;
      font-weight: 15px;
      margin-bottom: 10px;
    } */

    .textSelect {
      font-size: 80%;
      font-style: italic;
    }

    div.dataTables_filter input {
      visibility: visible;
    }

    label{
      visibility: visible;
      font-size: 14px;
    }

    #dateFROM, #dateTO, #leaveCheck, #leaveCheckk, #obCheck, #obCheckk,
    #overCheck, #overCheckk, #disapprovedCheck, #disapprovedCheckk {
      visibility: visible;
    }



    .hiLi {
      background-color: #48D1CC !important;
    }
    
    #Hideee{
      visibility: hidden;
    }

    .pagination, .dataTables_info{
      font-size: 14px;
    }

    #loanCategory, #selectBranch{
      float: left;
      width: auto;
      text-align: left;
      border: 2px solid darkgrey;
      top: -10px;
      position: relative;
      margin-right: 5px;
    }

    h6{
      font-family: "Source Sans Pro", sans-serif;
      margin: 5px 0 20px;
      color: #656565;
    }

    .scrollable-td {
      max-height: 7rem; /* Set max height */
      overflow-y: auto; /* Enable vertical scrolling */
      white-space: normal; /* Allows text wrapping */
      padding: 5px; /* Optional padding */
      /* border: 1px solid #ddd;  */
    }

  </style>
</head>
<body oncontextmenu="return false;">
<section class="leaveReport">
  <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div>
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>DUE COLLECTION REPORT MONITORING</h3> 
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
        <form action="" method="post" name="formReport" id="formReport">
          <div>
            <h6 id ="formTitle">Sort By:</h6>
          </div>
          <div class="form-group">
            <select class="form-control" name="loanCategory" id="loanCategory" Required>
              <option value="Microfinance" disabled selected>Microfinance Loan</option>
              <!-- <option value="Hold-Out">Hold-Out Loan</option> -->
              <option value="REM: Corporation">REM: Corporation</option>
              <option value="REM: Individual">REM: Individual</option>
              <option value="Salary">Salary Loan</option>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control selectBranch" name="selectBranch" id="selectBranch" Required>
              <option value="" Selected Disabled>-Select Branch-</option>
              <option value="Head Office">Head Office</option>
              <option value="Maragondon">Maragondon</option>
              <option value="Manggahan">Manggahan</option>
              <option value="Magallanes">Magallanes</option>
              <option value="Noveleta">Noveleta</option>
              <option value="Poblacion">Poblacion</option>
              <option value="Ternate">Ternate</option>
            </select>
          </div>
        </form>
        <!-- <form action="" method="post" name="formReport" id="formReport">
          <div>
            <h5 id ="formTitle">Types Of Report</h5>
          </div>

          <div class="form-group">
                <select class="form-control" name="selectBranch" id="selectBranch" value="" Required>
                  <option value="" Selected Disabled>-Select Branch-</option>
                  <option value="Head Office">Head Office</option>
                  <option value="Maragondon">Maragondon</option>
                  <option value="Manggahan">Manggahan</option>
                  <option value="Magallanes">Magallanes</option>
                  <option value="Noveleta">Noveleta</option>
                  <option value="Poblacion">Poblacion</option>
                  <option value="Ternate">Ternate</option>
                </select>
            </div>
            <div class="form-group">
              <input class="searchType" type="checkbox" id="leaveCheck" name="leaveCheck" value="Leave">
              <label id="leaveCheckk">Leave</label> &nbsp;&nbsp;&nbsp;
              <input class="searchType" type="checkbox" id="obCheck" name="obCheck" value="Official Business">
              <label id="obCheckk">Official Business</label>&nbsp;&nbsp;&nbsp;
              <input class="searchType" type="checkbox" id="overCheck" name="overCheck" value="Overtime">
              <label id="overCheckk">Overtime</label> &nbsp;&nbsp;&nbsp;
              <input class="searchType" type="checkbox" id="disapprovedCheck" name="disapprovedCheck" value="Disapproved">
              <label id="disapprovedCheckk">Disapproved</label>
            </div>
            <div class="form-group">
                <label id="Hideee">Datee</label>
                <input type="date" name="dateFROM" id="dateFROM" Required>
                <span id="TO">→</span>
                <input type="date" name="dateTO" id="dateTO" Required>
                <button type="submit" class="btn btn-primary btn-sm" name="btnFilter" id="btnFilter">Generate</button>
            </div>
          </form>  -->
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
            <thead>
                <!-- Group Row -->
                <!-- <tr>
                  <th colspan="7" style="background-color: lightgreen;">INFORMATION</th>
                  <th colspan="5" style="background-color: lightyellow;">REQUIREMENTS</th>
                  <th colspan="5" style="background-color: lightpink;">DOCUMENTS</th>
                </tr> -->

                <!-- Subgroup Row for REQUIREMENTS -->
                <!-- <tr>
                  <th colspan="7"></th> 
                  <th colspan="5" style="background-color: lightyellow;">Borrower</th> 
                  <th colspan="5"></th> 
                </tr> -->

                <!-- Column Headers -->
                <!-- <tr> -->
                  <!-- INFORMATION columns -->
                  <th width="150px">Name</th>
                  <th>Branch</th>
                  <th>Loan Type</th>
                  <th>Day/s Late</th>
                  <th>Phone Remarks</th>
                  <!-- <th>Amount</th>
                  <th>Terms</th> 
                  <th>Interest Rate</th> -->
                  
                  <!-- REQUIREMENTS columns -->
                  <th>First Demand</th>
                  <th>First Demand<br>(Registry Receipt)</th>
                  <th>First Demand<br>(Return Receipt)</th>
                  <th>First Remarks</th>

                  <th>Second Demand</th>
                  <th>Second Demand<br>(Registry Receipt)</th>
                  <th>Second Demand<br>(Return Receipt)</th>
                  <th>Second Remarks</th>

                  <th>Third Demand</th>
                  <th>Third Demand<br>(Registry Receipt)</th>
                  <th>Third Demand<br>(Return Receipt)</th>
                  <th>Third Remarks</th>
                  
                  <th>Final Demand</th>
                  <th>Final Demand<br>(Registry Receipt)</th>
                  <th>Final Demand<br>(Return Receipt)</th>
                  <th>Final Remarks</th>
                  
                  <!-- DOCUMENTS columns -->
                  <th>Forelosure</th>
                  <th>Foreclosure Remarks</th>
                  <th>Litigation[1]</th>
                  <th>Litigation Remarks</th>
                  <th>Transfer of Litigation</th>
                  <th>Transfer of Litigation Remarks</th>
                  <th>Preparation Consolidation</th>
                  <th>Prep. Conso. Remarks</th>
                  <th>Demand</th>
                  <th>Demand Remarks</th>
                <!-- </tr> -->
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
</section>                            <!-- Script -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

        <!-- Fetch -->
<script type="text/javascript">
    $(document).ready(function() {
        var myTable = $('#reporttbl').DataTable({
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
        'autoWidth': 'false',
        'order': [],
        'ajax': {
          'url': 'fetch_dueReport_micro.php',
          'type': 'post',
        },
        // "aoColumnDefs": [{  
        //     "bSortable": false,
        //     "aTargets": [] //total tables.
        //   },
        // ]
        'columnDefs': [
          { "orderable": true, "targets": [0, 1, 3] },
          { "orderable": false, "targets": '_all'}
        ]
      });
    });

    $(document).on('submit', '#formReport', function(event) {
      event.preventDefault();
      var Table = $('#reporttbl').DataTable();
      // $('#reporttbl').empty();
      var fd = new FormData(this);
      $.ajax({
        url:'fetch_dueReport_micro.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(data) {
          // Table.destroy();
          // Table = $('#reporttbl').DataTable();
          // Table.draw();
          // Table.ajax.reload();
          if( $.fn.DataTable.isDataTable('#reporttbl') ) {
            $('#reporttbl').DataTable().destroy();
          }
          $('#reporttbl tbody').empty();
          $('#reporttbl tbody').html(data);
          $('#reporttbl').dataTable({
            "autoWidth": false, 
            "info": false, 
            "JQueryUI": true, 
            "ordering": true, 
            "paging": true, 
            "bSortable": true,
            "responsive": true
          });
        },
      });
  });

</script>

<script>
  $(document).ready(function(){
    $('#loanCategory').change(function(){
      var selected = $('#loanCategory').val();
      $.ajax({
        success: function(data){
          if(selected === 'Microfinance'){
            window.location.href = 'dueCollection-Micro-Report.php';
          }else{
            if(selected === 'Salary'){
              window.location.href = 'dueCollection-Salary-Report.php';
            }else if(selected === 'REM: Individual'){
              window.location.href = 'dueCollection-Individual-Report.php';
            }else if(selected === 'REM: Corporation'){
              window.location.href = 'dueCollection-Corporation-Report.php';
            }
          }
        }
      });
    });
  });
</script>

<script>
$(document).ready(function(){
  $(document).on('change', '.selectBranch', function(event) {
    event.preventDefault();
    var branch = $(this).val();
    $('.selectBranch').val(branch);

    fetchReportTbl(branch);
    
  });
});

function fetchReportTbl(branch){
  $.ajax({
    url: "fetch_dueReport_micro.php",
    type: "POST",
    data: { branch: branch },
    success: function(data) {
        console.log(branch);
        console.log(data);
        $('.selectBranch').val(branch);
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
</script>
</body>
</html>