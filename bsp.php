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
  <!-- Bootstrap CSS -->
 <!-- Bootstrap CSS -->
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-KyOQy6zfBSHbBySv8xyuH4DUpovCA7gcB5v1Ry+P9Kb9rsGkbIKDT57K5Bpj2cjA5HqTAAX8Y2rqU/DH8z+6Dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
  
  <!-- <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" /> -->
  <title></title>
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
   /* @media screen and (max-width: 1536px){
  @-ms-viewport { }
  body {
    zoom: 80%;
  }
} */

/* @media screen and (max-width: 1746.45px){
  @-ms-viewport { }
  body {
    zoom: 95%;
  }
} */
  /* 150% */
  /* @media screen and (min-device-width: 1200px){
  @-ms-viewport { }
  body {
    zoom: 95%;
  }
  
} */

/* @media screen and (max-width: 1098.14px){
  @-ms-viewport { }
  body {
    zoom: 50%;
  }
} */

/* @media screen and (max-width: 2133.33px) {
    @-ms-viewport { }
    body {
      zoom: 80%;
    }
  } */
    .container{
        text-align: center;
        position: relative;
        float: center;
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
    
    th, td {
      font-size: 11.5px;
      /* text-align: center; */
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
    }
    .btnBack{
      border-radius: 8px;
      margin-right: 30px;
      /* margin-bottom: 10px; */
      width: 5%;
      font-family: Georgia, serif;
      /* background: linear-gradient(#9fbfe7, #6e84a0) repeat scroll 0 0 #87a2c4;
      border: #000000; */
    }
    .row{
        /* background-color: #F5F5F5; */
        text-align: left;
        float: center;
        position: relative;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-label {
        position: relative;
        left: -12px;
        display: inline-block;
        padding: 6px 12px;
        background: rgba(0, 0, 0, 0.15);
        border-radius: 3px 0 0 3px;
    }

    .btn-labeled {
        padding-top: 0;
        padding-bottom: 0;
    }

    .btn {
        margin-bottom: 10px;
    }

    .button{
      display: inline-flex;
      height: 50px;
      width: 100%;
      padding: 0;
      background: #009578;
      border: none;
      outline: none;
      border-radius: 5px;
      overflow: hidden;
      font-family: 'Quicksand', sans-serif;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      /* width: 100%; */
    }

    .button:hover {
      background: #008168;
    }

    .button:active {
      background: #006e58;
    }

    .button__text,
    .button__icon {
      display: inline-flex;
      align-items: center;
      padding: 0 24px;
      color: #fff;
      height: 100%;
    }

    .button__icon{
      position: absolute;
      right: 10px; /* Adjust the value as needed to position the icon */
      top: 50%; /* Vertically center the icon */
      transform: translateY(-50%); /* Correct for vertical centering */
      font-size: 1.5rem;
      background: rgba(0, 0, 0, 0.08);
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
    <!-- <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" /> -->
    <div class="section-heading">
      <h3>Welcome BSP Examination</h3> 
      <br>
    </div>
  </div>
  <div class="container-fluid" id="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <p class="fw-bold"><strong>Name of BSFI</strong></p>
                </div>
                <div class="col-1">
                    <label for="">:</label>
                </div>
                <div class="col-7">
                    <p>One-Unified Rural Bank of Cavite Inc. Doing Business Under the Name and Style <br><strong>"OUR Bank".</strong></p>
                </div>

                <div class="col-4">
                    <p class="fw-bold"><strong>Regular Examination (RE) Ref. Date</strong></p>
                </div>
                <div class="col-1">
                    <label for="">:</label>
                </div>
                <div class="col-7">
                    <p>31 MARCH 2024</p>
                </div>

                <div class="col-4">
                    <p class="fw-bold"><strong>Previous Examination Ref. Date</strong></p>
                </div>
                <div class="col-1">
                    <label for="">:</label>
                </div>
                <div class="col-7">
                    <p>31 DECEMBER 2021</p>
                </div>

                <div class="col-4">
                    <p class="fw-bold"><strong>Expected Date Of Submission</strong></p>
                </div>
                <div class="col-1">
                    <label for="">:</label>
                </div>
                <div class="col-7">
                    <p>On or before 2 May 2024 or as indicated below/discussed with the EIC.</p>
                </div>

                <div class="col-4">
                    <p class="fw-bold"><strong>Start of Examination</strong></p>
                </div>
                <div class="col-1">
                    <label for="">:</label>
                </div>
                <div class="col-7">
                    <p>2 May 2024</p>
                </div>
                
                <br><br><br>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="genInfo">
                      <span class="button__text">General Information</span>
                      <span class="button__icon">
                        <ion-icon name="bulb-outline"></ion-icon>
                      </span>
                    </button>
                    <!-- <button class="btn btn-primary btn-block" id="genInfo" style="height: 50px;">
                        <i class="fas fa-success-circle"></i> General Information
                    </button> -->
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                  <button type="button" class="button" id="btnLegal">
                      <span class="button__text">Legal Management</span>
                      <span class="button__icon">
                        <ion-icon name="briefcase-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnSub">
                      <span class="button__text">For Submission</span>
                      <span class="button__icon">
                        <ion-icon name="newspaper-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnAudit">
                      <span class="button__text">Internal Audit</span>
                      <span class="button__icon">
                        <ion-icon name="search-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                  <button type="button" class="button" id="btnLending">
                      <span class="button__text">Lending / Credit Risk</span>
                      <span class="button__icon">
                        <ion-icon name="cash-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnOffice">
                      <span class="button__text">Compliance Office</span>
                      <span class="button__icon">
                        <ion-icon name="folder-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnAssets">
                      <span class="button__text">Acquired Assets Management</span>
                      <span class="button__icon">
                        <ion-icon name="podium-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnIT">
                      <span class="button__text">Information Technology</span>
                      <span class="button__icon">
                        <ion-icon name="finger-print-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnMarket">
                      <span class="button__text">Market & Liquidity Risk</span>
                      <span class="button__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnComp">
                      <span class="button__text">Compliance With Anti-Money Laundry Act (AMLA)</span>
                      <span class="button__icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnHr">
                      <span class="button__text">Human Resources Management</span>
                      <span class="button__icon">
                        <ion-icon name="people-outline"></ion-icon>
                      </span>
                    </button>
                </div>

                <div class="col-6 mb-3 d-flex justify-content-center">
                    <button type="button" class="button" id="btnSum">
                      <span class="button__text">Summary</span>
                      <span class="button__icon">
                        <ion-icon name="document-outline"></ion-icon>
                      </span>
                    </button>
                </div>


            </div>
        </div>
    </div>
</div>


</section>

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

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <script src="js/collectionCSV.js"></script>

        <!-- Fetch -->
<script>
$(document).ready(function() {
    $("#genInfo").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-generalinfo.php";
    });
});

$(document).ready(function() {
    $("#btnHr").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-hrm.php";
    });
});

$(document).ready(function() {
    $("#btnMarket").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-market.php";
    });
});

$(document).ready(function() {
    $("#btnLegal").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-legal.php";
    });
});

$(document).ready(function() {
    $("#btnAudit").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-Audit.php";
    });
});

$(document).ready(function() {
    $("#btnLending").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-credit.php";
    });
});

$(document).ready(function() {
    $("#btnComp").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-amla.php";
    });
});

$(document).ready(function() {
    $("#btnOffice").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-office.php";
    });
});

$(document).ready(function() {
    $("#btnAssets").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-assets.php";
    });
});

$(document).ready(function() {
    $("#btnIT").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-IT.php";
    });
});

$(document).ready(function() {
    $("#btnSum").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-report.php";
    });
});

$(document).ready(function() {
    $("#btnSub").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp-submission.php";
    });
});
</script>
</body>
</html>