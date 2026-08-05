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

    #inventorylogo {
      width: 20%;
      height: auto;
    }

    .flogo {
      text-align: center;
    }

    .hiLi {
      background-color: #CD5C5C!important;
    }

    .pagination, .dataTables_info{
      font-size: 14px;
    }

    .btnApp, .btnRej, .btnFollowUp, .btnServiceR{
      font-size: 13px;
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
                <th>Status</th>
                <th style=" width: 25px;">Image</th>
                <th style="width: 150px;">Action</th>
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
          if(aData[5] == 'Head/BM Followed Up') {
            $(nRow).addClass('hiLi');
          }
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'responsive': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_department_request.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [6] //total table to be shown.
          },
        ]
      });
    });

    $(document).on('click', '.btnApp', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure you want to Approve?")) {
        $.ajax({
          url: "requestHeadApproved.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            // var button = '<td><a href="javascript:void(0);" data-id="' + id + '" class="btn btn-success btn-sm btnCheck">Approved</a> <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm btnX">Disapproved</a>';
            $("#" + id).closest('tr').remove();
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              mytable.ajax.reload();
              alert('Approved!');
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

    $(document).on('click', '.btnRej', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure you want to Disapprove?")) {
        $.ajax({
          url: "requestITDisapproved.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              // var button = '<td><a href="javascript:void(0);" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td> <a href="#!"  data-id="' + id + '"  class="btn btn-secondary btn-sm transferBtn">Transfer</a></td>';
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Disapproved!');
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

    $(document).on('click', '.btnFollowUp', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Do you want to follow up this request?")) {
        $.ajax({
          url: "requestHeadFollowUp.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              // var button = '<td><a href="javascript:void(0);" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td> <a href="#!"  data-id="' + id + '"  class="btn btn-secondary btn-sm transferBtn">Transfer</a></td>';
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Your Request have been Follow Up!');
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
    
    $(document).on('click', '.btnServiceR', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Done with the Request?")) {
        $.ajax({
          url: "requestHeadServiceRender.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              // var button = '<td><a href="javascript:void(0);" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td> <a href="#!"  data-id="' + id + '"  class="btn btn-secondary btn-sm transferBtn">Transfer</a></td>';
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Service Rendered!');
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

</script>

</body>
</html>