<?php
include('connection.php');
require 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="OURBank Dashboard.">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Import IT Request</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

  <style>
    .custom-file-upload {
        background-color: #f8f9fa;
        transition: all 0.2s ease-in-out;
    }

    .custom-file-upload:hover {
        background-color: #f1f3f5;
        border-color: #0d6efd;
    }

    .drop-zone {
        border: 2px dashed #0d6efd;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.25s ease-in-out;
    }

    .drop-zone:hover {
        background-color: #eef4ff;
    }

    .drop-zone.dragover {
        background-color: #e7f1ff;
        border-color: #084298;
    }

  </style>
</head>
<body>
<?php
if($_SESSION['position'] == 'Staff' || $_SESSION['position'] == 'Head' || $_SESSION['position'] == 'BM' || $_SESSION['position'] == 'AGM' || $_SESSION['position'] == 'GM'){
  if($_SESSION['position'] == "Staff") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"';
  }
  if($_SESSION['position'] == "Head") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"';
  }
  if($_SESSION['position'] == "BM") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"
            AND a.address = "'. $_SESSION['address']  .'"';
  }
  if($_SESSION['position'] == "AGM") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"
            AND a.address = "'. $_SESSION['address']  .'"';
  }
  if($_SESSION['position'] == "GM") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"
            AND a.address = "'. $_SESSION['address']  .'"';
  }
}
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($query);
// print_r($data);
// die();
?>

<!-- <section class="forms"> -->
    <div class="container-fluid">
        <div class="request-form shadow-lg p-5 mb-4">
            <div class="pads">
                <div class="row">
            <!-- <div class="col"><img class="leave-image" src="./logo/logo.png" alt="logo"></div> -->
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h3><strong>IT IMPORT REQUEST FORM</strong></h3> 
                        </div>
                            <form id="requestImportForm" action="" method="post" enctype="multipart/form-data">
                                <span id="dateToday">Date: <?php $r_myDate=getdate(date("U"));
                                    date_default_timezone_set('Asia/Manila');
                                    echo "$r_myDate[month] $r_myDate[mday], $r_myDate[year]"; ?>
                                </span>
                                <input type="hidden" id="r_myDate" name="r_myDate" value="<?= "$r_myDate[month] $r_myDate[mday], $r_myDate[year]"; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <br>
                                        <fieldset>
                                            <div class="form-floating">
                                            <select name="selectBranch" class="form-select d-flex text-start" id="selectBranch">
                                                <option value="" selected disabled>-- SELECT BRANCH --</option>
                                                <option value="Head Office">HEAD OFFICE</option>
                                                <option value="Noveleta">NOVELETA</option>
                                                <option value="Magallanes">MAGALLANES</option>
                                                <option value="Mangganhan">MANGGAHAN</option>
                                                <option value="Maragondon">MARAGONDON</option>
                                                <option value="Poblacion">POBLACION</option>
                                                <option value="Ternate">TERNATE</option>
                                            </select>
                                            <label for="selectBranch">BRANCH</label>
                                            </div>
                                        </fieldset><br>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset><br>
                                            <div class="form-floating">
                                            <select name="selectRequestType" class="form-select d-flex text-start" id="selectRequestType">
                                                <option value="" disabled selected>-- SELECT REQUEST --</option>
                                                <option value="For Re-activation of Account">BADA re-activation of account</option>
                                                <option value="For Reliever Account">BADA reliever account</option>
                                                <option value="FileServer Concern">FileServer Concern</option>
                                            </select>
                                            <label for="selectRequestType">TYPE OF REQUEST</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold mb-1">UPLOAD SUPPORTING DOCS</label>
                                        <div id="dropZone" class="drop-zone text-center p-4 rounded-3">
                                            <input
                                            type="file"
                                            id="requestImport"
                                            name="requestImport"
                                            accept="image/png, image/jpeg, image/jpg"
                                            multiple
                                            hidden
                                            >

                                            <i class="bi bi-cloud-arrow-up fs-2 text-primary"></i>
                                            <p class="mb-1 fw-semibold">Drag & Drop Files Here</p>
                                            <small class="text-muted">Or Click To Browse</small>

                                            <div id="fileList" class="small text-muted mt-2">
                                                No files selected
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" class="btn btn-outline-primary btn-sm" name="uploadBtn" id="uploadBtn"><strong>UPLOAD<strong></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- </section> -->

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  
<script type="text/javascript" language="javascript">
  
$(document).ready(function(e){
  $('#requestImportForm').on('submit', function(e) {
    $("#uploadBtn").attr('disabled','true');
    $("#uploadBtn").attr('value','Processing...');
    e.preventDefault();
    var fd = new FormData(this);
    $.ajax({
      url:'requestImport.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(data) {
        $("#uploadBtn").removeAttr('disabled');
        $("#uploadBtn").attr('value','Submit');
        alert('Success!');
        console.log(data);
        window.location.reload();
      },
      error: function(data) {
        alert('Error Sending your form!');
        window.location.reload();
      }
    });
  });
});

</script>

<script>
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('requestImport');
const fileList = document.getElementById('fileList');

// Click opens file dialog
dropZone.addEventListener('click', () => fileInput.click());

// Drag effects
dropZone.addEventListener('dragover', (e) => {
  e.preventDefault();
  dropZone.classList.add('dragover');
});

dropZone.addEventListener('dragleave', () => {
  dropZone.classList.remove('dragover');
});

dropZone.addEventListener('drop', (e) => {
  e.preventDefault();
  dropZone.classList.remove('dragover');
  fileInput.files = e.dataTransfer.files;
  showFiles(fileInput.files);
});

// Show selected files
fileInput.addEventListener('change', () => {
  showFiles(fileInput.files);
});

function showFiles(files) {
  if (files.length === 0) {
    fileList.textContent = 'No files selected';
    return;
  }

  fileList.innerHTML = Array.from(files)
    .map(file => `📎 ${file.name}`)
    .join('<br>');
}
</script>

</body>

</html>