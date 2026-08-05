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
      /* outline: none; */
      /* border: none; */
      height: 30px;
      width: 150px;
      /* text-align: center; */
      font-size: 98%;
      cursor: pointer;
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
      /* outline: none; */
      /* border: none; */
      height: 30px;
      width: 150px;
      /* text-align: center; */
      font-size: 98%;
      cursor: pointer;
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

    #reporttbl_filter.dataTables_filter{
      float: right;
    }

    #startdateoutput, #enddateoutput {
        max-width: 150px; /* Adjust the width as needed */
    }

  </style>
</head>
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
            <form action="" id="" enctype="">
              <div class="form-group py-2">
                  <input type="date" class="form-control" name="dateFROM" id="dateFROM" Required>
              </div>
            </form>
            <br>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th width="150px;">Emp. ID</th>
                <th>Name</th>
                <th>Branch</th>
                <th>Basic Salary </th>
                <th>Transpo. Allowance</th>
                <th>Rice Allowance</th>
                <th>Overtime Pay</th>
                <th>Othey Pay</th>
                <th style="color: red;">SSS</th>
                <th style="color: red;">SSS Mand. Provident</th>
                <th style="color: red;">Pag-ibig</th>
                <th style="color: red;">Philhealth</th>
                <th style="color: red;">SSS Loan</th>
                <th style="color: red;">Emp. Loan</th>
                <th style="color: red;">Withholding Tax</th>
                <th style="color: red;">Absent</th>
                <th style="color: red;">Late</th>
                <th style="color: red;">Other Deduction</th>
                <th>Total Earning</th>
                <th style="color: red;">Total Deductions</th>
                <th>Net Salary</th>
                <!-- <th>Action</th> -->
              </thead>
              <tbody>
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
        'serverSide': true,
        'processing': true,
        'paging': true,
        'responsive': true,
        'autoWidth': false,
        'order': [],
        'ajax': {
          'url': 'fetch_emp_salary_report.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [20] //total tables.
          },
        ]
      });
    });

    // $(document).on('submit', '#formReport', function(event) {
    //   event.preventDefault();
    //   var Table = $('#reporttbl').DataTable();
    //   // $('#reporttbl').empty();
    //   var fd = new FormData(this);
    //   $.ajax({
    //     url:'fetch_emp_data.php',
    //     type: 'post',
    //     data: fd,
    //     contentType: false,
    //     processData: false,
    //     success: function(data) {
    //       // Table.destroy();
    //       // Table = $('#reporttbl').DataTable();
    //       // Table.draw();
    //       // Table.ajax.reload();
    //       if( $.fn.DataTable.isDataTable('#reporttbl') ) {
    //         $('#reporttbl').DataTable().destroy();
    //       }
    //       $('#reporttbl tbody').empty();
    //       $('#reporttbl tbody').html(data);
    //       $('#reporttbl').dataTable({
    //         "autoWidth": false, 
    //         "info": false, 
    //         "JQueryUI": true, 
    //         "ordering": true, 
    //         "paging": true, 
    //         "bSortable": true,
    //         "responsive": true
    //       });
    //     },
    //   });
  // });


  // function sortTable(n) {
  //   var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  //   table = document.getElementById("reporttbl");
    
  //   switching = true;
  //   dir = "asc";

  //   while (switching) {
  //       switching = false;
  //       rows = table.rows;

  //       for (i = 1; i < (rows.length - 1); i++) {
  //           shouldSwitch = false;
  //           x = rows[i].getElementsByTagName("TD")[n];
  //           y = rows[i + 1].getElementsByTagName("TD")[n];

  //           if (dir == "asc") {
  //               if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
  //                   shouldSwitch = true;
                    
  //                   break;
  //               }
  //           } else if (dir == "desc") {
  //               if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
  //                   shouldSwitch = true;
                    
  //                   break;
  //               }
  //           }
  //       }
  //       if (shouldSwitch) {
  //           rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
  //           switching = true;
  //           switchcount ++;
  //       } else {
  //           if (switchcount == 0 && dir == "asc") {
  //               dir = "desc";
  //               switching = true;
  //           }
  //       }
  //     }
  // }

// var allIds = [ "leaveCheck", "obCheck", "overCheck", "disapprovedCheck" ];
// function uncheck( event ) 
// {
//    var id = event.target.id;
//    allIds.forEach( function( id ){
//       if ( id != event.target.id )
//       {
//          document.getElementById( id ).checked = false;
//       }
//    });
// }
// jQuery("#leaveCheck").click(uncheck);
// jQuery("#obCheck").click(uncheck);
// jQuery("#overCheck").click(uncheck);
// jQuery("#disapprovedCheck").click(uncheck);

</script>
</body>
</html>