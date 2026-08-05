<?php
include('connection.php');
require 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta Http-Equiv="Cache-Control" Content="no-cache">
  <meta Http-Equiv="Pragma" Content="no-cache">
  <meta Http-Equiv="Expires" Content="0">
  <meta Http-Equiv="Pragma-directive: no-cache">
  <meta Http-Equiv="Cache-directive: no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="A inventory web app for OUR Bank.">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Leave Request</title>

  <!-- bootstrap -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->

  <?php include('includes/css.php'); ?>

  <!-- Custom CSS -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>

<style>
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

  #reporttbl_paginate {
      font-size: 13px!important;
      padding: 8px 14px;
  }

</style>
<body>

<section class="leaveReport">
  <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div>
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>MY LEAVE REPORT</h3> 
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="dataTables_filter" id="btnAdd">
            <div class="addBtnDiv">
              <!-- <button class="btn btn-success btn-md" id="addNewBtn" class="addNewBtn"><i class="fa-solid fa-plus"></i></button> -->
            </div>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered table-stripe" width="100%" height="auto" cellspacing="0">
              <thead>
                <th width="120px">Name</th>
                <th width="">Branch</th>
                <th>Description</th>
                <th>Date From</th>
                <th>Date To</th>
                <th width="">Time From</th>
                <th width="">Time To</th>
                <th width="">Days/Hours</th>
                <th width="">Reason</th>
                <th width="">Status</th>
                <th width="">Remarks</th>
                <th width="">Approver</th>
                <th width="">Time Approved</th>
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

<?php include('includes/scripts2.php'); ?>

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
        'url': 'fetch_leavetbl_report.php',
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
</script>
</body>

</html>