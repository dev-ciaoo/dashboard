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
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
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
  /* table{
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
      font-size: 11.5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

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

    #selectLeave {
      float: left;
      height: 30px;
      width: 150px;
      border: none;
      outline: none;
      position: fixed;
      text-align: center;
    }

    #formReport {
      float: left;
      border-style: groove;
      padding-top: 0.5%;
      padding-bottom: 2.3%;
      padding-left: 30px;
      margin-right: 1000px;
    }

    #btnFilter {
      position: relative;
      float: left;
      margin-left: 30px;
      height: 30px;
      width: 80px;
      border: none;
    }

    #dateTO {
      float: left;
      margin-left: -130px;
      outline: none;
      border: none;
      height: 30px;
      width: 150px;
      font-size: 98%;
    }
    
    #TO {
      float: left;
      outline: none;
      margin-left: 70px;
      border: none;
      height: 30px;
      width: 150px;
      font-size: 98%;
    }

    #dateFROM {
      float: left;
      margin-right: -70px;
      outline: none;
      border: none;
      height: 30px;
      width: 150px;
      font-size: 98%;
    }

    #formTitle {
      margin-left: 160px;
    }

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

    #selectBranch {
      width: 30%;
      text-align: center;
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

    #loanCategory{
      float: left;
      width: auto;
      text-align: left;
      border: 2px solid darkgrey;
      top: -10px;
      position: relative;
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

    .refresh{
      position: relative;
      float: left;
      margin-top: 5px;
      margin-left: 5px;
      background-color: green;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .refresh:hover {
      background-color: #32cd32;
      transform: translateY(-2px);
    }

    .refresh:active{
      background-color: #228b22;
      transform: translateY(1px);
    }
  </style>
</head>
<body oncontextmenu="return false;">
<button class="fa fa-refresh refresh" aria-hidden="true"></button>
<section class="leaveReport">
  <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div>
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>LMS REPORT MONITORING</h3> 
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
              <!-- <option value="Hold-Out">Hold-Out Loan</option> -->
              <option value="REM: Individual" disabled selected>REM: Individual</option>
              <option value="Microfinance">Microfinance Loan</option>
              <option value="REM: Corporation">REM: Corporation</option>
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
                  <th width="200px">Name</th>
                  <th>Branch</th>
                  <th width="100px">Loan Type</th>
                  <th>Date Created</th>
                  
                  <!-- REQUIREMENTS columns -->
                  <th>Endorsement<br>Letter</th>
                  <th>Loan Application<br>Form</th>
                  <th>Valid ID</th>
                  <th>Proof Of Billing<br>(Meralco, Internet, Water Bill)</th>
                  <th>Personal Bank<br>Statement</th>
                  <th>Marriage Contract(If Married)<br>Cenomar(If Single)</th>
                  <th>Brgy. Clearance<br>For Loan Purposes</th>

                  <th>Transfer Certificate Of Title<br>(Original & Certified True Copy)</th>
                  <th>Tax Declaration<br>(LOT-Certified True Copy)</th>
                  <th>Tax Declaration<br>(Improvement-Certified True Copy)</th>
                  <th>Real Estate Tax Clearance</th>
                  <th>Real Estate Tax Receipt(Amilyar)</th>
                  <th>Cancellation And Discharge Of Mortgate(If Applicable)</th>

                  <th>Employment Contract(If Applicable)</th>
                  <th>Certificate Of Employment With Compensation</th>
                  <th>Income Tax Return(If Applicable)</th>
                  <th>Payslip(For 6 Months)</th>
                  <th>Other Source Of Income(If Applicable)</th>

                  <th>Appraisal Fee Receipt</th>
                  <th>Credit Investigation And Credit Inventigation Report</th>
                  <th>Appraise The Property And Collateral Appraisal Report</th>
                  <th>Financial Evaluation(BRR/Cashflow)</th>

                  <th>Signed Letter Of Approval</th>

                  <th>Signed Loan Approval Memo</th>

                  <th>Signed Real Estate Mortgate Contract</th>

                  <th>REM Contract Annotated</th>

                  <th>Promissory Note</th>
                  <th>Disclosure Statement</th>
                  <th>Insurance Document</th>
                  <th>Amortization Schedule</th>

                  <th>Loan Utilization</th>

                  <th>Powerpoint CI And Appraisal Report</th>
                  <th>Excel Cashflow Analysis</th>

                  <th>Special Power Of Attorney</th>
                  <th>General Information Sheet</th>
                  <th>Security Exchange Commission(SEC) With Articles And By Law</th>
                  <th>Letter Of Guarantee</th>
                  <th>Original Board Resolution And Notarized Secretary Certificate</th>
                  <th>Statement Of Account</th>
                  <th>Bill/Cost Of Materials</th>
                  <th>Proposed Perspective Plan</th>
                  <th>Other Supporting Docs</th>

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
</section>                 
<div id="displayhere"></div>  

<!-- Script -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
  <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>


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
          'url': 'fetch_lmsReport-individual.php',
          'type': 'post',
        },
        // "aoColumnDefs": [{  
        //     "bSortable": false,
        //     "aTargets": [] //total tables.
        //   },
        // ]
        'columnDefs': [
          { "orderable": true, "targets": [0, 1, 2, 3] },
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
        url:'fetch_lmsReport-individual.php',
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
            window.location.href = 'lms-micro-report.php';
          }else{
            if(selected === 'Salary'){
              window.location.href = 'lms-salary-report.php';
            }else if(selected === 'REM: Individual'){
              window.location.href = 'lms-individual-report.php';
            }else if(selected === 'REM: Corporation'){
              window.location.href = 'lms-corporation-report.php';
            }
          }
        }
      });
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
            window.location.href = 'lms-micro-report.php';
          }else{
            if(selected === 'Salary'){
              window.location.href = 'lms-salary-report.php';
            }else if(selected === 'REM: Individual'){
              window.location.href = 'lms-individual-report.php';
            }else if(selected === 'REM: Corporation'){
              window.location.href = 'lms-corporation-report.php';
            }
          }
        }
      });
    });
  });
</script>

<script>
$(document).ready(function () {
  $(document).on('click', '.btnCheckC', function (e) {
    var loanIds = $(this).attr('id');
    var type = $(this).attr('value');
    // document.getElementById('tablelist').style.display = 'none';

    var loanTarget ="loanFormMicrofinance.php";

    if (type == "Microfinance" || type == "Microfinance Loan") {
      loanTarget = "loanFormMicrofinance.php";
    }
    if (type == "Salary Loan") {
      loanTarget = "loanFormSalary.php";
    }
    if (type == "Hold-Out Loan") {
      loanTarget = "loanFormHoldOut.php";
    }
    if (type == "REM: Corporation") {
      loanTarget = "loanFormCorporation.php";
    }
    if (type == "REM: Individual") {
      loanTarget = "loanFormIndividual.php";
    }


    $.ajax({
      type: 'POST',
      url: loanTarget,
      data: {
        loanId: loanIds
      },
      async: false,
      success: function (result) {
        
        $('#displayhere').html(result);
        $useLoanId = loanIds;

        $('.container-fluid').css('display', 'none');

      }
    });

  });
});
</script>

<script>
  $(document).ready(function(){
    $(document).on('click', '.refresh', function(e){
      e.preventDefault();
      var href = "lms-individual-report.php";

      window.location.href = href;
    })
  })
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
    url: "fetch_lmsReport-individual.php",
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