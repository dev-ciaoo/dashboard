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
  <title>Loan Pipeline</title>
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <!-- Style -->
  <!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->

  <style rel="stylesheet" type="text/css">
   /* 125% */
@media screen and (min-width: 640px){
  @-ms-viewport { }
  #reporttbl, h3, #inventorylogo, button{
    zoom: 75%;
  }
}


@media screen and (min-width: 768px){
  @-ms-viewport { }
  #reporttbl, h3, #inventorylogo, button {
    zoom: 75%;
  }
  
}

@media screen and (min-width: 1024px){
  @-ms-viewport { }
  #reporttbl, h3, #inventorylogo, button {
    zoom: 75%;
  }
}

  /* 150% */
@media screen and (min-width: 1280px){
  @-ms-viewport { }
  #reporttbl, h3, #inventorylogo, button {
    zoom: 75%;
  }
  
}

@media screen and (min-width: 1536px){
  @-ms-viewport { }
  #reporttbl, h3, #inventorylogo, button {
    zoom: 100%;
  }
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
      zoom: 90%;
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

    #inventorylogo {
      width: 20%;
      height: auto!important;
      margin-right: 90px;
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
    .left-div {
      float: left;
    }
    #back{
      float: left;
      background-color: lightgrey;
    }

    #back:hover{
      background-color: darkgrey;
    }

    .btnBack{
      border-radius: 8px;
      margin-right: 30px;
      /* margin-bottom: 10px; */
      max-width: 15%;
    }

    @media print{
      #printThis, #reporttbl_filter, #reporttbl_paginate, #reporttbl_length{
        visibility: hidden;
      }
      
      #form-select, #back, #importThis, button{
        visibility: hidden;
      }

      /* Define custom styles for the printed content */
    body.print-preview {
      font-size: 14px;
      line-height: 1.5;
    }

    #collectedModal, .modal-footer{
      display: none;
    }

    .followUp{
      background-color: #FF6347;
    }
    
  }

  </style>
</head>
<script>
function reloadPage(){
  window.location = '';
}
</script>
<body>
<div class="left-dive">
            <!-- <a href=""><button class="btn btn-md btnBack" id="back">BACK</button></a> -->
          </div>
<section class="leaveReport">
  <!-- <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div> -->
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>Loan Pipeline</h3> 
    </div>
  </div>
  <div class="container-fluid" id="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
        <?php if($_SESSION['department'] == 1 || $_SESSION['department'] == 15 || $_SESSION['userid'] == 19 || $_SESSION['userid'] == 16 || $_SESSION['userid'] == 29){ ?>
        <div class="col-md-12">
          <div class="col-md-2">
            <select class="form-select w-20 selectBranch mb-2 text-center d-flex" name="selectBranch"  id="selectBranch" Required>
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
        </div>
        <?php } ?>
          
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th>Branch</th>
                <th>Customer Name</th>
                <th>Date Created</th>
                <th>Days Count(After Created)</th>
                <th>Loan Type</th>
                <th>Amount Applied</th>
                <th>Terms</th>
                <th>Interest Rate(%)</th>
                <th>Remarks</th>
                <th>Status</th>
                <th style="width: 250px;">Action</th>
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

<!-- CsV Upload -->
<div class="modal fade" id="dueCollection" data-backdrop="static" tabindex="-1" aria-labelledby="dueCollection"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dueCollectionLabel">Due Collection</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="csvForm" method="post" enctype="multipart/form-data">
          <input type="file" name="csvFile" accept=".csv" required>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-secondary upload-btn" id="csvFile">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>

                        <!-- Script -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script src="js/collectionCSV.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>



        <!-- Fetch -->
<script type="text/javascript">

  $(document).ready(function() {
      var mytable = $('#reporttbl').DataTable({
      "fnCreatedRow": function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
        if(aData[5] == 'Followed Up') {
          $(nRow).addClass('hiLi');
        }
      },
      'serverSide': 'true',
      'processing': 'true',
      'paging': 'true',
      'responsive': 'true',
      'order': [],
      'ajax': {
        'url': 'fetch_pipeline2.php',
        'type': 'post',
      },
      "aoColumnDefs": [{  
          "bSortable": false,
          "aTargets": [] //total table to be shown.
        },
      ]
    });
});


  $(document).on('click', '.btnRemarks', function(event) {
    var mytable = $('#reporttbl').DataTable();
    event.preventDefault();
    var id = $(this).data('id');
    var letterStatus = prompt("Remarks: ");
    if (letterStatus !== null && letterStatus.trim() !== "") {
        $.ajax({
            url: "pipelineRemarks.php",
            data: {
                id: id,
                letterStatus: letterStatus
            },
            type: "post",
            success: function(data) {
                var json = JSON.parse(data);
                status = json.status;
                if (status == 'success') {
                    // $("#" + id).closest('tr').remove();
                    // mytable.ajax.reload();
                    window.location.reload();
                    alert('Success!');
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

  $(document).on('click', '.btnDecline', function(event) {
    var mytable = $('#reporttbl').DataTable();
    event.preventDefault();
    // alert('decline');
    var did = $(this).data('id');
    var dletterStatus = prompt("Remarks: ");
    if (dletterStatus !== null && dletterStatus.trim() !== "") {
        $.ajax({
            url: "pipelineDecline.php",
            data: {
                did: did,
                dletterStatus: dletterStatus
            },
            type: "post",
            success: function(data) {
                var json = JSON.parse(data);
                status = json.status;
                if (status == 'success') {
                    // $("#" + id).closest('tr').remove();
                    // mytable.ajax.reload();
                    window.location.reload();
                    alert('Success!');
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
    if (confirm("Do you want to follow up this Loan Account?")) {
      $.ajax({
        url: "pipelineFollowUp.php",
        data: {
          id: id
        },
        type: "post",
        success: function(data) {
          var json = JSON.parse(data);
          status = json.status;
          if (status == 'success') {
            // $("#" + id).closest('tr').remove();
            // mytable.ajax.reload();
            alert('This Loan Account has been Follow Up!');
            // console.log(data);
            window.location.reload();
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

<script>
$(document).ready(function(){
  $(document).on('change', '.selectBranch', function(event) {
    event.preventDefault();
    var branch = $(this).val();
    $.ajax({
        url: "fetch_pipeline2.php",
        type: "POST",
        data: { branch: branch },
        success: function(data) {
            console.log(branch);
            console.log(data);
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
  });
});


</script>


<!-- <script>
function downloadAsPDF() {
    // Select the HTML element containing the content you want to convert to PDF
    var element = document.body;
    
    // Configure the options for the PDF generation
    var opt = {
        margin:       0, // Default margin
        filename:     'document.pdf',
        image:        { type: 'jpeg', quality: 1 }, // Full quality
        html2canvas:  { scale: 1 }, // Scale set to 75%
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait', putOnlyUsedFonts: true, fontSize: 9, scale: 0.50 } // Set paper size to letter, scale to 75%
    };

    // Call the html2pdf function with the element and options
    html2pdf()
        .from(element)
        .set(opt)
        .save();
}
</script> -->

</body>
</html>