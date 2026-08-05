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
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <title>OUR Bank</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css">

  <style>
    input,
    input::placeholder {
        font-size: 11.5px;;
        font-style: sans-serif;
    }
    #forInstCode {
      font-style: sans-serif;
    }

    /* div.dataTables_filter input {
      visibility: hidden;
    }
    label{
      visibility: hidden;
    }
    .hiLi {
      background-color: #008080!important;
    } */
    /* #myTable_info{
      font-size: 14px;
      position: relative;
      float: left;
    } */
    .pagination{
      position: relative;
      float: right;
    }
    #lalagyan {
      width: 100%;
      height: auto!important;
      margin: 0!important;
    }
  </style>
</head>
<body id="body" oncontextmenu="return false;">

<section class="forms">
<div class="container-fluid">
  <div class="policy-form shadow-lg p-1 mb-4">
    <div class="pads">
      <div class="row">
          <div class="col-md-12"><br>
            <div class="section-heading">
            </div>
            <form class="loanForm" id="loans-form" action="" method="post" enctype="multipart/data-form">
                        <div class="row g-3 align-items-center">
                          <div class="col-auto">
                              <label id="forInstCode" for="instCode" class="col-form-label">Policy & Procedures: &nbsp;&nbsp;</label>
                          </div>
                          <div class="col-auto">
                              <input type="search" name="instCode" id="instCode" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search Policy & Procedures" onkeyup="stoppedTyping()">
                          </div>
                          <div class="col-auto">
                              <button type="submit" class="btn btn-success btn-md" name="Search" id="Search" disabled>Search</button>
                          </div>
                        </div>
                      </form>
            <div id="lalagyan"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</section>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">

$(document).ready(function(e){
  $('#loans-form').on('submit', function(e) {
    e.preventDefault();
    var fd = new FormData(this);
    $.ajax({
      url:'policyQuery.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(data) {
        // alert('Success!');
        $('#lalagyan').html(data);
        console.log(data);
      },
      error: function(data) {
        alert('Error Sending your form!');
      }
    });
  });
});

function stoppedTyping(){
    if(instCode.value.length > 0 || regsName.value.length) { 
        document.getElementById('Search').removeAttribute('disabled');
    } else { 
        document.getElementById('Search').setAttribute('disabled', true);
    }
}
</script>



</body>
</html>

