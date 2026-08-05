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

    span{
        text-transform: uppercase;
    }

    a{
        text-decoration: none;
        color: black;
        text-transform: capitalize;
        font-weight: 400;
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
      <h3>DISPOSAL ITEM LIST</h3> 
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
            <table id="reporttbl" class="table table-bordered table-hover table-responsive" width="100%" height="auto" cellspacing="0">
              <thead>
                <th style=" width: 8px;">ID</th>
                <th style="width: 400px;">REQUESTOR</th>
                <th style="width: 50px;">BRANCH</th>
                <th style="width: 200px;">DATE</th>
                <th>DISPOSAL ITEM</th>
                <th style="width: 200px;">STATUS</th>
                <!-- <th style=" width: 25px;">Image</th> -->
                <!-- <th style="width: 150px;">Action</th> -->
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
        //   if(aData[5] == 'Head/BM Followed Up') {
        //     $(nRow).addClass('hiLi');
        //   }
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'responsive': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_disposal_request.php',
          'type': 'post',
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
  // Refresh Rate is how often you want to refresh the page 
  // bassed off the user inactivity. 
  var refresh_rate = 15; //<-- In seconds, change to your needs
  var last_user_action = 0;
  var has_focus = false;
  var lost_focus_count = 0;
  // If the user loses focus on the browser to many times 
  // we want to refresh anyway even if they are typing. 
  // This is so we don't get the browser locked into 
  // a state where the refresh never happens.    
  var focus_margin = 10;

  // Reset the Timer on users last action
  function reset() {
    last_user_action = 0;
    updateVisualTimer('Reset Timer');
  }

  function updateVisualTimer(value) {
    var element = document.getElementById('refreshTimer');
    if (value) {
      element.value = value;
    } else if (has_focus) {
      element.value = 'User has focus won\'t refresh';
    } else if (last_user_action >= refresh_rate) {
      element.value = 'Refreshing';
    } else {
      element.value = (refresh_rate - last_user_action);
    }
  }

  function windowHasFocus() {
    has_focus = true;
  }

  function windowLostFocus() {
    has_focus = false;
    lost_focus_count++;
    console.log(lost_focus_count + " <~ Lost Focus");
  }

  // Count Down that executes ever second
  setInterval(function() {
    last_user_action++;
    refreshCheck();
    updateVisualTimer();
  }, 1000);

  // The code that checks if the window needs to reload
  function refreshCheck() {
    var focus = window.onfocus;
    if ((last_user_action >= refresh_rate && !has_focus && document.readyState == "complete") || lost_focus_count > focus_margin) {
      window.location.reload(); // If this is called no reset is needed
      reset(); // We want to reset just to make sure the location reload is not called.
    }

  }
  // window.addEventListener("focus", windowHasFocus, false);
  window.addEventListener("blur", windowLostFocus, false);
  window.addEventListener("click", reset, false);
  window.addEventListener("mousemove", reset, false);
  window.addEventListener("keypress", reset, false);
  window.addEventListener("scroll", reset, false);
  document.addEventListener("touchMove", reset, false);
  document.addEventListener("touchEnd", reset, false);

</script>  

</body>
</html>