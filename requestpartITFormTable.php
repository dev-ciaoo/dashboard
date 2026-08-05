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
  #reporttbl th {
    font-size: 13px;
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
      font-size: 12.5px;
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
    
    td {
      font-size: 11.5px;
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

    div.dataTables_filter input {
      visibility: hidden;
    }
    label{
      visibility: hidden;
    }
    #dateFROM, #dateTO, #leaveCheck, #leaveCheckk, #obCheck, #obCheckk,
    #overCheck, #overCheckk, #disapprovedCheck, #disapprovedCheckk {
      visibility: visible;
    }
   
    .hiLi1 {
      background-color: #CD5C5C;
    }
    .hiLi2 {
      background-color: #FFA500;
    }
    .hiLi3 {
      background-color: #FFFF00;
    }
    .hiLi4 {
      background-color: #3CB371;
    }
    .hiLi5 {
      background-color: #ADD8E6;
    }


    .pagination, .dataTables_info{
      font-size: 14px;
    }

    .btnDone{
      font-size: 13px;
    }

    .legends{
      float: left;
      left: 200px;
      justify-content: center;
      width: 170px;
      /* padding: 20px; */
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
<body oncontextmenu="return false;">

<section class="leaveReport">
  <div class="legends">
    <span style="float: left; font-size: 14px;">&nbsp;&nbsp;<strong>Legends</strong></span>
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
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>IT REQUEST</h3> 
    </div>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
        <!-- <form action="" method="post" enctype="multipart/form-data">
    
              $sql = "SELECT * FROM request WHERE r_Status =2";
              $result = mysqli_query($con, $sql);
         
            <input type="hidden" >
        </form>  -->
       
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
                <th>Priority Level</th>
                <th>Assign To</th>
                <th style="width: 100px;">Action</th>
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
          if (aData[7] == '5') {
              $(nRow).find('td:eq(7)').css({"background-color": "blue",
                                            "color": "blue"
              });
            }else if (aData[7] == '4') {
              $(nRow).find('td:eq(7)').css({"background-color": "green",
                                            "color": "green"
              });
            } else if (aData[7] == '3') {
              $(nRow).find('td:eq(7)').css({"background-color": "yellow",
                                            "color": "yellow"
              });
            } else if (aData[7] == '2') {
              $(nRow).find('td:eq(7)').css({"background-color": "orange",
                                            "color": "orange"
              });
            } else if (aData[7] == '1') {
              $(nRow).find('td:eq(7)').css({"background-color": "red",
                                            "color": "red"
              });
            } else {
              $(nRow).find('td:eq(7)').css({"background-color": "white",
                                            "color": "white"
              });
            }
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'responsive': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_it_req.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [7] //total tables.
          },
        ]
      });
    });

  $(document).on('click', '.btnDone', function (event) {
    event.preventDefault();

    let mytable = $('#reporttbl').DataTable();
    let id = $(this).data('id');

    if (!confirm("Are you sure this job is done?")) {
        return;
    }

    $.ajax({
        url: "requestUpdate.php",
        type: "POST",
        data: { id: id },
        dataType: "json", // ✅ IMPORTANT

        success: function (response) {
            if (response.status === 'success') {
                alert(response.message || 'Work Done!');
                mytable.ajax.reload(null, false); // smoother reload
            } else {
                alert(response.message || 'Failed');
                console.error(response.debug || '');
            }
        },

        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.error(xhr.responseText);
            alert('An error occurred while processing the request.');
        }
    });
  });


</script>
</body>
</html>