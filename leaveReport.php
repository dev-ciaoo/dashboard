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
  <title>OUR Bank</title>
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <!-- Style -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

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
      zoom: 87%;
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
      background-color: #E4C514;
      text-transform: uppercase;
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

    #selectLeave {
      float: left;
      height: 30px;
      width: 150px;
      border: none;
      outline: none;
      /* background-color: yellow; */
      position: fixed;
      /* margin-left: 330px; */
      /* margin-bottom: 140px; */
      text-align: center;
    }

    #formReport {
      /* border-radius: 50%; */
      float: left;
      border-style: groove;
      /* background-color: red; */
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
      /* background-color: yellow; */
      margin-left: -130px;
      outline: none;
      border: none;
      height: 30px;
      width: 150px;
      /* text-align: center; */
      font-size: 98%;
    }
    
    #TO {
      float: left;
      outline: none;
      margin-left: 70px;
      border: none;
      height: 30px;
      width: 150px;
      /* text-align: center; */
      font-size: 98%;
    }

    #dateFROM {
      float: left;
      /* background-color: yellow; */
      margin-right: -70px;
      outline: none;
      border: none;
      height: 30px;
      width: 150px;
      /* text-align: center; */
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
      /* margin-left: 160px; */
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

    #leaveOption{
      float: left;
      width: 150px;
      text-align: center;
      border: 2px solid darkgrey;
    }

    .addBtnDiv {
      float: right;
      margin-left: 10px;
      margin-top: 10px;
    }

    .modal-backdrop.show{
      width: 100%;
    }

    #editModal .modal-header{
      background-color: #E4C514;
    }

    #addNewModal .modal-header{
      background-color: #E4C514;
    }

  @media print{
    #printThis, #reporttbl_filter, #reporttbl_paginate{
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
    /* Hide unnecessary elements during printing */
    #collectedModal .modal-footer {
      display: none;
    }
  }

  .dt-top {
    margin-bottom: 10px;
    position: relative;
    display: flex;
    justify-content: center; /* centers the buttons */
    gap: 10px;    
  }

  .dt-controls {
    display: flex;
    justify-content: space-between;  /* length menu left, search box right */
    align-items: center;
    margin-bottom: 20px;
  }

  .dt-controls .length {
    flex: 0 0 auto;
  }

  .dt-controls .search {
    flex: 0 0 auto;
  }

  </style>
</head>
<!-- <body oncontextmenu="return false;"> -->
<body>
<section class="leaveReport">
  <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div>
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>REPORT MONITORING</h3> 
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
        <div class="addBtnDiv">
          <?php 
          if($_SESSION['userid'] == 8){
            echo '<button class="btn btn-success btn-md" id="addNewBtn" class="addNewBtn"><i class="fa-solid fa-plus"></i></button>';
          }else{
            echo '';
          }
          ?>
          <!-- <button class="btn btn-success btn-md" id="addNewBtn" class="addNewBtn"><i class="fa-solid fa-plus"></i></button> -->
        </div>
        <select class="form-control col-sm-3 mb-2" name="leaveOption" id="leaveOption">
          <option value="Leave Count">Leave Count</option>
          <option value="Leave Report" selected disabled>Leave Report</option>
        </select>
        <br><br>
        <form action="" method="post" name="formReport" id="formReport">
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
          </form> 
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th width="120px">Name</th>
                <th width="">Emp. ID</th>
                <th width="">Branch</th>
                <th>Description</th>
                <th>Date From</th>
                <th>Date To</th>
                <th width="">Time From</th>
                <th width="">Time To</th>
                <th>Total Hour/s</th>
                <th width="">Reason</th>
                <th width="">Remarks</th>
                <th width="">Approver</th>
                <th width="">Time Approved</th>
                <th style="min-width: 50px!important;">Action</th>
              </thead>
              <tbody id="tbody-insert">
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add New Modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-white">
        <h5 class="modal-title" id="addNewModalLabel">
          <i class="fa-regular fa-pen-to-square"></i> Add New Record
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="addNewForm">
        <div class="modal-body">
          <input type="hidden" name="id" id="addNewId">
          <input type="hidden" name="namee" id="namee">

          <input type="hidden" id="addUserId" name="addUserId" placeholder=" " readonly>
          <input type="hidden" id="addEmpId" name="addEmpId" placeholder=" " readonly>


          <!-- <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="addUserId" name="addUserId" placeholder=" " readonly>
                <label for="addUserId">USER ID</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="addEmpId" name="addEmpId" placeholder=" " readonly>
                <label for="addEmpId">EMPLOYEE ID</label>
              </div>
            </div>
          </div> -->

          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="addName" id="addName" placeholder=" ">
                  <option value="" disabled selected>-- SELECT EMPLOYEE NAME --</option>
                  <?php
                    $slctName = "SELECT * FROM accounts WHERE stats <> 1 AND userId NOT IN (7, 17)ORDER BY fullName ASC";
                    $result = $con->query($slctName);
                    while($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row['userId'] . '">' . $row['fullName'] . '</option>';
                    }
                  ?>
                </select>
                <label for="addName">NAME</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="addBranch" name="addBranch" placeholder=" " readonly>
                <label for="addBranch">BRANCH</label>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" id="addEmail" name="addEmail" placeholder=" " readonly>
                <label for="addEmail">E-MAIL</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" id="addToEmail" name="addToEmail" placeholder=" " readonly>
                <label for="addToEmail">TO E-MAIL</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <select id="addCategory" class="form-control" name="addCategory">
                  <option value="" selected disabled> -- SELECT CATEGORY -- </option>
                  <option value="Emergency Leave">Emergency Leave</option>
                  <option value="Mandatory Leave">Mandatory Leave</option>
                  <option value="Vacation Leave">Vacation Leave</option>
                  <option value="Sick Leave">Sick Leave</option>
                  <option value="Overtime">Overtime</option>
                  <option value="Official Business">Official Business</option>
                  <option value="Unpaid Leave">Unpaid Leave</option>
                  <option value="Work From Home">Work From Home</option>
                  <option value="Paternity Leave">Paternity Leave</option>
                  <option value="Maternity Leave">Maternity Leave</option>
                </select>
                <label for="addCategory">CATEGORY</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <select id="addKindOfDay" class="form-control" name="addKindOfDay">
                  <option value="" selected disabled> -- SELECT KIND OF DAY -- </option>
                  <option value="Whole Day">Whole Day</option>
                  <option value="Half Day">Half Day</option>
                </select>
                <label for="addKindOfDay">KIND OF DAY</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-3">
              <div class="form-floating">
                <input type="date" class="form-control" id="addDateFrom" name="addDateFrom" placeholder=" " required>
                <label style="font-size: 12px;" for="addDateFrom">DATE FROM</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="date" class="form-control" id="addDateTo" name="addDateTo" placeholder=" " required>
                <label style="font-size: 12px;" for="addDateTo">DATE TO</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="time" class="form-control" id="addTimeFrom" name="addTimeFrom" placeholder=" " required>
                <label style="font-size: 12px;" for="addTimeFrom">TIME FROM</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="time" class="form-control" id="addTimeTo" name="addTimeTo" placeholder=" " required>
                <label style="font-size: 12px;" for="addTimeTo">TIME TO</label>
              </div>
            </div>
          </div>

          <div class="form-floating mb-3">
            <textarea class="form-control" id="addMessage" name="addMessage" placeholder=" "></textarea>
            <label for="addMessage">REASON</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary text-white">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-white">
        <h5 class="modal-title" id="editModalLabel">
          <i class="fa-regular fa-pen-to-square"></i> Edit Record
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="editForm">
        <div class="modal-body">
          <!-- Hidden ID -->
          <input type="hidden" name="id" id="editId">

          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="editName" name="iName" placeholder=" " readonly>
                <label for="editName" class="form-label" style="font-size: 13px;">NAME</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="editBranch" name="iBranch" placeholder=" " readonly>
                <label for="editBranch" class="form-label" style="font-size: 13px;">BRANCH</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <select name="iCategory" id="editCategory" name="iCategory" class="form-select" required>
                  <option value="Emergency Leave">Emergency Leave</option>
                  <option value="Mandatory Leave">Mandatory Leave</option>
                  <option value="Vacation Leave">Vacation Leave</option>
                  <option value="Sick Leave">Sick Leave</option>
                  <option value="Overtime">Overtime</option>
                  <option value="Official Business">Official Business</option>
                  <option value="Unpaid Leave">Unpaid Leave</option>
                  <option value="Work From Home">Work From Home</option>
                  <option value="Paternity Leave">Paternity Leave</option>
                  <option value="Maternity Leave">Maternity Leave</option>
                </select>
                <label for="editCategory" class="form-label" style="font-size: 13px;">CATEGORY</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <select name="kindOfDay" id="editKindOfDay" class="form-select" required>
                  <option value="Whole Day">Whole Day</option>
                  <option value="Half Day">Half Day</option>
                </select>
                <label for="editKindOfDay" class="form-label" style="font-size: 13px;">KIND OF DAY</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="editDateFrom" name="dateFrom"  placeholder=" " required>
                <label for="editDateFrom" class="form-label" style="font-size: 13px;">DATE FROM</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="editDateTo" name="dateTo" placeholder=" " required>
                <label for="editDateTo" class="form-label" style="font-size: 13px;">DATE TO</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" id="editTimeFrom" name="timeFrom"  placeholder=" " required>
                <label for="editTimeFrom" class="form-label" style="font-size: 13px;">TIME FROM</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" id="editTimeTo" name="timeTo" placeholder=" " required>
                <label for="editTimeTo" class="form-label" style="font-size: 13px;">TIME TO</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-floating">
              <textarea class="form-control" id="editMessage" name="iMessage" rows="3" readonly></textarea>
              <label for="editMessage" class="form-label" style="font-size: 13px;">REASON</label>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
          <button type="submit" class="btn btn-primary text-white">SAVE</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php include('includes/scripts.php'); ?>

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
      'autoWidth': false,
      'serverSide': true,
      'processing': true,
      'paging': true,
      'responsive': true,
      'ordering': true,
      'info': true,
      'order': [],
      'ajax': {
        'url': 'fetch_emp_data.php',
        'type': 'post',
      },
      "aoColumnDefs": [{  
          "bSortable": false,
          "aTargets": [] //total tables.
        }],
        dom: '<"dt-top" B><"dt-controls"l f>rtip',
        buttons: [
          {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel"></i> Export to Excel',
            className: 'btn btn-success btn-sm',
            title: 'Leave_Report',
            exportOptions: {
                columns: ':visible'
            }
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print"></i> Print Table',
            className: 'btn btn-primary btn-sm',
            title: 'Leave Count Report',
            customize: function (win) {
                // Apply print CSS styling
                $(win.document.body)
                    .css('font-size', '12px')
                    .css('color', '#000')
                    .css('background', '#fff');

                // Add title styling
                $(win.document.body).find('h1')
                    .css('text-align', 'center')
                    .css('font-size', '18px')
                    .css('margin-bottom', '20px');

                // Style the printed table
                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', '12px')
                    .css('border-collapse', 'collapse')
                    .css('width', '100%');

                $(win.document.body).find('table th, table td')
                    .css('border', '1px solid #000')
                    .css('padding', '5px')
                    .css('text-align', 'center');

                $(win.document.body).find('table th')
                    .css('background-color', 'lightgreen');

                // Optional: hide certain elements during print
                $(win.document.body).find('.dt-buttons, .dataTables_filter').hide();
            }
          }
        ]
    });
  });

  $(document).on('submit', '#formReport', function(e) {
    e.preventDefault();
    var fd = new FormData(this);

    $.ajax({
      url: 'fetch_emp_data2.php',
      type: 'POST',
      data: fd,
      contentType: false,
      processData: false,
      cache: false,
      success: function(data) {

        // Destroy DataTable if it exists
        if ($.fn.DataTable.isDataTable('#reporttbl')) {
          $('#reporttbl').DataTable().clear().destroy();
        }

        // Always replace tbody content
        $('#reporttbl tbody').html(data.trim());

        // Reinitialize DataTable only if there are actual records
        if (!data.includes('No Records Found!')) {
          $('#reporttbl').DataTable({
            autoWidth: false,
            info: true,
            ordering: true,
            paging: true,
            responsive: true,

            // ✅ ADDED HERE
            dom: '<"dt-top" B><"dt-controls"l f>rtip',
            buttons: [
              {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel"></i> Export to Excel',
                className: 'btn btn-success btn-sm',
                title: 'Leave_Report',
                exportOptions: {
                    columns: ':visible'
                }
              },
              {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print Table',
                className: 'btn btn-primary btn-sm',
                title: 'Leave Count Report',
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '12px')
                        .css('color', '#000')
                        .css('background', '#fff');

                    $(win.document.body).find('h1')
                        .css('text-align', 'center')
                        .css('font-size', '18px')
                        .css('margin-bottom', '20px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', '12px')
                        .css('border-collapse', 'collapse')
                        .css('width', '100%');

                    $(win.document.body).find('table th, table td')
                        .css('border', '1px solid #000')
                        .css('padding', '5px')
                        .css('text-align', 'center');

                    $(win.document.body).find('table th')
                        .css('background-color', 'lightgreen');

                    $(win.document.body).find('.dt-buttons, .dataTables_filter').hide();
                }
              }
            ]
          });
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error:', error);
      }
    });
  });


  $(document).on('click', '.editbtn', function () {
    // var myModal = new bootstrap.Modal(document.getElementById('editModal'));
    // myModal.show();
    var id = $(this).data('id');

    // alert(id);

    // Fetch record details via AJAX
    $.ajax({
        url: 'fetch_single_record_leavetbl.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            // Populate fields
            $('#editId').val(data.id);
            $('#editName').val(data.iName);
            $('#editBranch').val(data.iBranch);
            $('#editCategory').val(data.iCategory);
            $('#editKindOfDay').val(data.kindDay);
            $('#editDateFrom').val(data.dateFrom); 
            $('#editDateTo').val(data.dateTo);
            $('#editTimeFrom').val(data.timeFrom);
            $('#editTimeTo').val(data.timeTo);
            $('#editMessage').val(data.iMessage);

            // Show modal
            var myModal = new bootstrap.Modal(document.getElementById('editModal'));
            myModal.show();
        },
        error: function (xhr, status, error) {
            console.error("Error fetching record:", error);
        }
    });
  });

  // Save changes
  $(document).on('submit', '#editForm', function (e) {
      e.preventDefault();

      var formData1 = $(this).serialize();

      $.ajax({
          url: 'leaveUpdRecord.php',
          type: 'POST',
          data: formData1,
          success: function (response) {
              // Hide modal
              if(response === 'Success'){
                 var myModalEl = document.getElementById('editModal');
                var modal = bootstrap.Modal.getInstance(myModalEl);
                modal.hide();

                alert('Record updated successfully!');
                location.reload();
              }else{
                 alert('Failed to update record. Please try again.');
              }
          },
          error: function (xhr, status, error) {
              console.error("Error updating record:", error);
          }
      });
  });

  //delete
  $(document).on('click', '.deleteBtn', function (){
    var id = $(this).data('id');
    if (confirm("Are you sure you want to update this record?")) {
        $.ajax({
            url: 'delete-leave-file.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if(response) {
                    var res = JSON.parse(response);
                    if(res.success) {
                        alert(res.message);
                    } else {
                        alert("Error: " + res.message);
                    }
                } else {
                    alert("No response from server.");
                }
                $('#reporttbl').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error deleting record:", status, error);
                console.log("Response text:", xhr.responseText);
            }
        })
    }else{
      return false;
    }
  });



  $(document).on('click', '#addNewBtn', function (e) {
    e.preventDefault();

    var addNewModal = new bootstrap.Modal(document.getElementById('addNewModal'));
    addNewModal.show();
  });

  $(document).on('change', '#addName', function(e) {
    e.preventDefault();
    var userId = $(this).val();

    $.ajax({
      url: 'fetch_user_details.php',
      type: 'POST',
      data: { userId: userId },
      dataType: 'json',

      success: function(data){
        $('#namee').val(data.fullName);
        $('#addUserId').val(data.userId);
        $('#addEmpId').val(data.employeeId);
        $('#addEmail').val(data.userEmail);
        $('#addToEmail').val(data.eMail);
        $('#addBranch').val(data.address);

      },
      error: function(xhr, status, error) {
        console.error("Error fetching user details:", error);
      }
    });
  });

  $(document).on('submit', '#addNewForm', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      url: 'leaveaddData.php',
      type: 'POST',
      data: formData,

      success: function(response) {
        if (response) {
          var res = JSON.parse(response);
          if(res.success){
            addModal = $('#addNewModal');
            addModal.modal('hide');
            alert(res.message);
            $('#addNewModal').find('input, textarea, select').val('');
            // addModal1.hide();
            $('#reporttbl').DataTable().ajax.reload();
            // location.reload();
          }else {
            alert('Error: ' + res.message);
          }
        }
      },
      error: function(xhr, status, error){
        alert('Error Adding New Record: ' + error);
      }

    });
  });

var allIds = [ "leaveCheck", "obCheck", "overCheck", "disapprovedCheck" ];
function uncheck( event ) 
{
   var id = event.target.id;
   allIds.forEach( function( id ){
      if ( id != event.target.id )
      {
         document.getElementById( id ).checked = false;
      }
   });
}
jQuery("#leaveCheck").click(uncheck);
jQuery("#obCheck").click(uncheck);
jQuery("#overCheck").click(uncheck);
jQuery("#disapprovedCheck").click(uncheck);

</script>

<script>
  $(document).ready(function(){
    $('#leaveOption').change(function(){
      var selected = $('#leaveOption').val();
      $.ajax({
        success: function(data){
          if(selected === 'Leave Report'){
            window.location.href = 'leaveReport.php';
          } else {
            window.location.href = 'leave-report-count.php';
          }
        }
      });
    });
  });
</script>

</body>
</html>