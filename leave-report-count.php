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
  <title>OUR Bank Leave Count Monitoring</title>
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <!-- Style -->
  <!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->

  <!-- DataTables Buttons CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>


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




    h3{
      font-family: "Source Sans Pro", sans-serif;
      color: #656565;
      margin: 30px 0 20px;
    }

    #reporttbl {
      /* word-break: break-all; */
      overflow-wrap: normal;

    }
    
    td {
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

    h3{
      font-family: "Source Sans Pro", sans-serif;
      color: #656565;
      margin: 30px 0 20px;
    }

    #reporttbl {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;  
      /* zoom: 87%; */
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
      cursor: pointer;
    }
    td{
      font-size: 11.5px;
      cursor: pointer;
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

    /* Add more custom styles here */

    /* Hide unnecessary elements during printing */
    #collectedModal .modal-footer {
      display: none;
    }
  }

  #reporttbl_length{
    visibility: visible;
  }

    #leaveOption{
      float: left;
      width: 150px;
      text-align: center;
      border: 2px solid darkgrey;
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

  .modal-backdrop.show{
    width: 100%;
  }

  #editModal .modal-header{
    background-color: #E4C514;
  }
    
  </style>
</head>
<!-- <body oncontextmenu="return false;"> -->

<body>
<section class="leaveReport">
  <!-- <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div> -->
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>LEAVE COUNT MONITORING</h3> 
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
        <select class="form-control col-sm-3" name="leaveOption" id="leaveOption">
          <option value="Leave Report">Leave Report</option>
          <option value="Leave Count" selected disabled>Leave Count </option>
        </select>
        <br>
        <br>
        <!-- <button onclick="window.print();" class="btn btn-primary btn-md printBtn" id="printThis" name="printThis">Print</button> -->
      </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered table-hover" width="100%" height="auto" cellspacing="0">
              <thead>
                <th>NAME</th>
                <th>BRANCH</th>
                <th style="width: 140px;">VACATION LEAVE</th>
                <th style="width: 140px;">MANDATORY LEAVE</th>
                <th style="width: 140px;">SICK LEAVE</th>
                <th style="width: 140px;">EMERGENCY LEAVE</th>
                <th style="width: 140px;">UNPAID LEAVE</th>
                <th style="">ACTION</th>
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
          <input type="hidden" name="id" id="editId" value="<?  ?>">

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
            <div class="col-md-1"></div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control" id="editVL" name="VL" placeholder=" ">
                <label for="editVL" class="form-label" style="font-size: 13px;">VL</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control" id="editSL" name="SL" placeholder=" ">
                <label for="editSL" class="form-label" style="font-size: 13px;">SL</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control" id="editML" name="ML" placeholder=" ">
                <label for="editML" class="form-label" style="font-size: 13px;">ML</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control" id="editEL" name="EL" placeholder=" ">
                <label for="editEL" class="form-label" style="font-size: 13px;">EL</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control" id="editUL" name="UL" placeholder=" ">
                <label for="editUL" class="form-label" style="font-size: 13px;">UL</label>
              </div>
            </div>
            <div class="col-md-1"></div>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
          <button type="submit" class="btn btn-primary text-white">SAVE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<!-- DataTables Buttons + Dependencies -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
<script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

        <!-- Fetch -->
<script type="text/javascript">
  $(document).ready(function() {
    var myTable = $('#reporttbl').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
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
          'url': 'fetch_leave_count.php',
          'type': 'post',
        },
        "aoColumnDefs": [{  
            "bSortable": false,
            "aTargets": [6] 
        }],
        dom: '<"dt-top" B><"dt-controls"l f>rtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel"></i> Export to Excel',
                className: 'btn btn-success btn-sm',
                title: 'Leave_Count_Report',
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

$(document).on('click', '.editbtn', function (e) {
    e.preventDefault(); // prevent unwanted navigation or form submission

    var id = $(this).data('id');
    if (!id) {
        console.error("No ID found for the clicked edit button.");
        return;
    }

    $.ajax({
        url: 'fetch_single_record_account.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            if (!data) {
                console.error("Empty response from server.");
                return;
            }

            // Populate modal fields safely
            $('#editId').val(data.id);
            $('#editName').val(data.fullName);
            $('#editBranch').val(data.address);
            $('#editVL').val(data.VL);
            $('#editSL').val(data.SL);
            $('#editML').val(data.ML);
            $('#editEL').val(data.EL);
            $('#editUL').val(data.UL);

            // Show the modal
            var modalEl = document.getElementById('editModal');
            if (modalEl) {
                var myModal = new bootstrap.Modal(modalEl);
                myModal.show();
            } else {
                console.error("Modal element #editModal not found in DOM.");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching record:", status, error);
            console.log("Response text:", xhr.responseText);
        }
    });
});

$(document).on('click', '.deleteBtn', function (){
    var id = $(this).data('id');
    if (confirm("Can you please confirm if this user has resigned?")) {
        $.ajax({
            url: 'delete-account.php',
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

$(document).on('submit', '#editForm', function (e){
  e.preventDefault();
  var id = $('.editbtn').data('id')
  var formData = new FormData(this);
  formData.append('id', id);

  // alert(id);
  $.ajax({
    url: 'update-leave-count.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response){
      if(response) {
        var res = JSON.parse(response);
        if(res.success) {
          alert(res.message);
          $('#editModal').modal('hide');
          $('#reporttbl').DataTable().ajax.reload();
        }else{
          alert(res.message);
        }
      }
    }, error: function(xhr, status, error) {
      console.error("Error Updating Record: ", status, error);
      console.log("Response text: ", xhr.responseText);
    }
  });
});

</script>

<script>
function printModalContent() {
  var modalContent = document.getElementById('modalCollected').innerHTML;

  // Create a new window for the print preview
  var printWindow = window.open('', '', 'width=800,height=600');

  // Write the modal content to the print preview window
  printWindow.document.open();
  // printWindow.document.write('<html><head><title>Print Preview</title>');

  // Link the custom print stylesheet for styling the print version
  // printWindow.document.write('<link rel="stylesheet" type="text/css" href="print-styles.css">');

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