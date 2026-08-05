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
  <link rel="stylesheet" href="./css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="./css/datatables-1.10.25.min.css" />
  <title>Due Collection</title>
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
      text-transform: uppercase;
      background-color: #E4C514;
    }

    /* #reporttbl tr:nth-child(even){
      background-color: #f2f2f2;
    } */

    .scrollable-td {
      max-height: 7rem; /* Set max height */
      overflow-y: auto; /* Enable vertical scrolling */
      white-space: normal; /* Allows text wrapping */
      padding: 5px; /* Optional padding */
      /* border: 1px solid #ddd;  */
    }

    #reporttbl tbody tr:hover {
      background-color: #ddd;
    }
    
    td {
      font-size: 11.5px;
      text-align: left;
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
    
  }

  /* Circle Loader */
  .loader-circle {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #17a2b8;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: auto;
  }

  @keyframes spin {
    100% { transform: rotate(360deg); }
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
  <a href=""><button class="btn btn-md btnBack" id="back"><span class="fa-solid fa-arrow-left-long"></span></button></a>
</div>
<?php
if($_SESSION['username'] == 'ctborgonia') { ?>
  <div class="d-flex justify-content-end">
    <button class="btn-danger btn-sm- btn btnTruncate"><span class="fa-solid fa-trash-can"></span></button>
  </div>
<?php } ?>
<section class="leaveReport">
  <!-- <div class="col-md-10 p-2">
    <ul class="nav justify-content-end"> 
    </ul>
  </div> -->
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
    <div class="section-heading">
      <h3>Loan Due Collection</h3> 
    </div>
  </div>
  <div class="container-fluid" id="container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
      <div class="dataTables_filter" id="btnAdd">
                <?php
                if($_SESSION['department'] != 1){
                  echo '';
                }else{
                  echo '<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dueCollection" type="button" id="importThis">Import File</button>';
                }
                ?>
                <button onclick="window.print();" class="btn btn-primary btn-md printBtn" id="printThis" name="printThis">Save</button>
                <!-- <button onclick="downloadAsPDF();" class="btn btn-primary btn-md printBtn" id="downloadPDF" name="downloadPDF">Download as PDF</button> -->
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="reporttbl" class="table table-bordered" width="100%" height="auto" cellspacing="0">
              <thead>
                <th>Branch</th>
                <th>Product Type</th>
                <th>Product ID</th>
                <th>Borrower's Name</th>
                <th>Mobile #</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Days Late</th>
                <th>Principal Bal</th>
                <th>Principal Due</th>
                <th>Interest</th>
                <th>Penalty</th>
                <th>Total Amount Due</th>
                <th>Last Unpaid</th>
                <th>Remarks</th>
                <th class="scrollable-td">Phone Remarks</th>
                <th>Status</th>
                <th style="width: 180px;">Action</th>
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
<div class="modal fade" id="dueCollection"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1">
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

<!-- Loading Modal -->
<div class="modal fade" id="uploadLoader" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content" style="text-align:center; padding:20px;">
      
      <!-- CSS Circle Loader -->
      <div class="loader-circle"></div>

      <!-- Progress % -->
      <div id="uploadPercent" style="margin-top:15px; font-size:18px; font-weight:bold;">
        0%
      </div>

      <!-- Progress Bar -->
      <div class="progress mt-3" style="height: 10px;">
        <div id="uploadBar" class="progress-bar bg-info" role="progressbar" style="width: 0%;"></div>
      </div>

      <p class="mt-3">Uploading... Please wait</p>
    </div>
  </div>
</div>

                        <!-- Script -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
  <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>



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
        'autoWidth': false,
        'order': [],
        'ajax': {
          'url': 'fetch_collection.php',
          'type': 'post',
        },
        // "aoColumnDefs": [{  
        //     "bSortable": false,
        //     "aTargets": [16] //total table to be shown.
        //   },
        // ]
        'columnDefs': [
          { "orderable": true, "targets": [0, 1, 3, 5, 7] },
          { "orderable": false, "targets": '_all'}
        ]
      });


    $(document).on('click', '.btnCheckC', function(event) {
    event.preventDefault();
    var Table = $('#reporttbl').DataTable();
    var buttonId = $(this).attr('id');
    var type = $(this).attr('value');
    document.getElementById('reporttbl').style.display = 'none';
    document.getElementById('container-fluid').style.display = 'none';
    // default
    var loanTarget ="dueFormCons.php";

    if (type == "Microfinance") {
      loanTarget = "dueFormMicro.php";
    }
    if (type == "Salary Loan") {
      loanTarget = "dueFormSalary.php";
    }
    if (type == "REM: Corporation") {
      loanTarget = "dueFormCorp.php";
    }
    if (type == "REM: Individual") {
      loanTarget = "dueFormIndividual.php";
    }
    if(type == "SCR"){
      loanTarget = "dueFormSCR.php";
    }

    // if


    $.ajax({
      type: 'POST',
      url: loanTarget,
      data: {
        loanId: buttonId
      },
      async: false,
      success: function (result) {
        $('#displayhere').html(result);
        $useLoanId = loanIds;
      }
    });
  });

  $(document).on('click', '.btnRemind', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      var letterStatus = prompt("Remarks: ");
      if (letterStatus !== null && letterStatus.trim() !== "") {
        $.ajax({
          url: "dueCollectionRemarks.php",
          data: {
            id: id,
            letterStatus: letterStatus
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Success!');
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

    $(document).on('click', '.btnPR', function(event) {
      var mytable = $('#reporttbl').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      var phoneRemarks = prompt("Remarks: ");
      if (phoneRemarks !== null && phoneRemarks.trim() !== "") {
        $.ajax({
          url: "dueCollectionPhoneRemarks.php",
          data: {
            id: id,
            phoneRemarks: phoneRemarks
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Success!');
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

});

</script>

<script>
$(document).ready(function(){
  $('.btnTruncate').click(function(e){
    e.preventDefault();

    if(!confirm("⚠️ Are you sure you want to clear this table? This action cannot be undone.")){
      return;
    }

    $.ajax({
      url: 'truncateTable.php', // your PHP file
      type: 'POST',
      data: { table: 'collectionarchive' }, // send which table to truncate
      success: function(data){
          alert('Table truncated successfully!');
          window.location.reload(); // reload page if needed
      },
      error: function(xhr, status, error){
          alert('An error occurred: ' + xhr.responseText);
      }
    });
  });
});
</script>

<script>
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
</script>

<script>
$(document).ready(function(){
  $(document).on('submit', '#csvForm', function(e){
    e.preventDefault();

    var fd = new FormData(this);

    // SHOW LOADER MODAL
    $('#uploadLoader').modal('show');

    $.ajax({
      url: 'dueCollectionUpload.php',
      type: 'POST',
      data: fd,
      contentType: false,
      processData: false,

      // 👇 THIS IS THE KEY PART
      xhr: function() {
        var xhr = new window.XMLHttpRequest();

        xhr.upload.addEventListener("progress", function(e){
          if (e.lengthComputable) {
            var percent = Math.round((e.loaded / e.total) * 100);

            // Update text
            $('#uploadPercent').text(percent + '%');

            // Update progress bar
            $('#uploadBar').css('width', percent + '%');
          }
        }, false);

        return xhr;
      },

      success: function(response){
        $('#uploadLoader').modal('hide');

        if(response != 0){
          alert('Successfully uploaded!');
          window.location.reload();
        } else {
          alert('File not uploaded');
        }
      },

      error: function(){
        $('#uploadLoader').modal('hide');
        alert('Upload failed');
      }
    });
  });
});
</script>

</body>
</html>