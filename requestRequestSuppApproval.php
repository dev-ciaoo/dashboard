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
  <title>OUR Bank IT Support</title>
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
      text-transform: uppercase;
      background-color: #E4C514;
    }

    /* #reporttbl tr:nth-child(even){
      background-color: #f2f2f2;
    } */

    #reporttbl tbody tr:hover {
      background-color: #ddd;
    }
    
    th, td {
      text-align: center;
    }

    th{
      font-size: 13px;
      text-transform: uppercase;
    }

    td {
      font-size: 11px;
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

    .legends{
      float: left;
      padding: 20px;
      /* background-color: lightgrey; */
      border: ridge;
    }

    .legends-color{
      width: 1%;
      border-radius: 2px;
      position: fixed;
      margin-left: 1.2rem;
    }

    .text{
      font-size: 12px;
    }
  </style>
</head>
<script>
function reloadPage(){
  window.location = '';
}
</script>
<body oncontextmenu="return false;">
<section class="leaveReport">
  <!-- <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div> -->
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>IT REQUEST</h3> 
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
       
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th style=" width: 8px;">Ticket #</th>
                <th style="width: 100px;">Name</th>
                <th style="width: 50px;">Branch</th>
                <th>Date</th>
                <th>Request</th>
                <!-- <th>Aproved By</th> -->
                <th>Status</th>
                <th>Time Approved</th>
                <th style="width: 25px;">Image</th>
                <th width="75px;">Priority</th>
                <th width="100px;">Assign To</th>
                <th style="width: 275px;">Action</th>
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

<br>
<div class="legends">
  <span style="float: left; font-size: 14px;"><strong>Legends</strong></span>
  <br><br>
    <img src="legends/red.png" alt="" class="legends-color">
    <p class="text" style="margin-top: -0.3rem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 - 10 Minutes</p>

    <img src="legends/orange.png" alt=""  class="legends-color">
    <p class="text" style="margin-top: -0.26rem;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10 - 30 Minutes</p>

    <img src="legends/yellow.png" alt="" class="legends-color">
    <p class="text" style="margin-top: -0.3rem;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;30 Minutes - 1 Hour</p>

    <img src="legends/green.png" alt="" class="legends-color">
    <p class="text" style="margin-top: -0.3rem;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 Hour - 1 Day</p>

    <img src="legends/blue.png" alt="" class="legends-color">
    <p class="text" style="margin-top: -0.3rem;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 Day - 3 Days</p>
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
          // if(aData[7] == 'Waiting for Approval') {
          //   $(nRow).addClass('hiLi');
          // }
        },
        'serverSide': true,
        'processing': true,
        'paging': true,
        'responsive': true,
        'order': [],
        'ajax': {
          'url': 'fetch_rquest_support.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [8] //total table to be shown.
          },
        ]
      });
    });

    $(document).on('click', '.btnCheck', function (event) {
      event.preventDefault();

      const mytable = $('#reporttbl').DataTable();
      const id = $(this).data('id');
      const pLevel = $('#pLevel_' + id).val();
      const assignTo = $('#assignTo_' + id).val();

      if (!confirm("Are you sure you want to Approve?")) return;

      $.ajax({
          url: "requestITApproved.php",
          type: "POST",
          dataType: "json",
          data: {
              id: id,
              pLevel: pLevel,
              assignTo: assignTo
          },
          success: function (data) {

              if (data.status === 'success') {
                  mytable.ajax.reload(null, false); // fast reload, keep page
                  alert('Approved!');
              } else {
                  alert(data.message || 'Failed');
              }
          },
          error: function (xhr, status, error) {
              console.error("AJAX Error:", error);
          }
      });
    });


    $(document).on('click', '.btnX', function(event) {
      event.preventDefault();

      const mytable = $('#reporttbl').DataTable();
      const id = $(this).data('id');
      const reqRemarks = prompt("Remarks:");

      if (reqRemarks !== null) {
        if (reqRemarks.trim() !== "") {
          $.ajax({
            url: "requestITDisp.php",
            data: {
              id: id,
              reqRemarks: reqRemarks
            },
            type: "POST",
            success: function(data) {
              const json = JSON.parse(data);
              const status = json.status;
              if (status === 'success') {
                $("#" + id).closest('tr').remove();
                mytable.ajax.reload();
                alert('Disapproved!');
              } else {
                alert('Failed');
              }
            },
            error: function(xhr, status, error) {
              console.error("AJAX Error: ", status, error);
              alert('An error occurred. Please try again.');
            }
          });
        } else {
          alert('Insert Remarks to Proceed.');
        }
      }
    });


    $(document).on('click', '.btnTrans', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("You're about to transfer this request to GM/AGM? Y/N")) {
        $.ajax({
          url: "requestITTransfer.php",
          data: {
            id: id,
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Transferred Successfully!');
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

    // $(document).on('change', '.assignTo', function() {
    //     var formId = $(this).closest('form').attr('id'); // Get the form ID
    //     var id = formId.split('_')[1]; // Extract the row ID
    //     var assignTo = $(this).val(); // Get the selected value
    //     alert(assignTo);
    // });

    // $(document).on('change', '.pLevel', function() {
    //     var formId = $(this).closest('form').attr('id'); // Get the form ID
    //     var id = formId.split('_')[1]; // Extract the row ID
    //     var pLevel = $(this).val(); // Get the selected value
    //     alert(pLevel);
    // });

</script>

</body>
</html>