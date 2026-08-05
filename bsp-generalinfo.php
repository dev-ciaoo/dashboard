<?php
include('connection.php');
include('fileUploadBSP.php');

$user =$_SESSION['userid'];
$selectMarket = "SELECT * FROM `bspgen` WHERE id = 1";
$data = mysqli_query($con, $selectMarket) ;
if (!$data) {
    echo("Error description: " . mysqli_error($con));
}else{
    while ($row = mysqli_fetch_array($data)) {
        $genStock = $row['genStock'];
        $genComm = $row['genComm'];
        $genRecent = $row['genRecent'];
        $genMin = $row['genMin'];
        $genStrat = $row['genStrat'];
        $genList = $row['genList'];
        $genLease = $row['genLease'];
        $genInsurance = $row['genInsurance'];
        $genReports = $row['genReports'];
        $genCorr = $row['genCorr'];
        $genAct	 = $row['genAct'];
        $genCredit	 = $row['genCredit'];
        $genFolder = $row['genFolder'];
        $genInvent = $row['genInvent'];
        $genReview = $row['genReview'];
        $genReview1 = $row['genReview1'];
        $genReview2 = $row['genReview2'];
        $genReview3 = $row['genReview3'];
        $genReview4 = $row['genReview4'];
        $genReview5 = $row['genReview2'];
        $genReview6 = $row['genReview6'];
        $genReview7 = $row['genReview7'];
        $genReview8 = $row['genReview8'];
        $genReview9 = $row['genReview9'];
        $genReview10 = $row['genReview10'];


        $genStockDesc = $row['genStockDesc'];
        $genCommDesc = $row['genCommDesc'];
        $genRecentDesc = $row['genRecentDesc'];
        $genMinDesc = $row['genMinDesc'];
        $genStratDesc = $row['genStratDesc'];
        $genListDesc = $row['genListDesc'];
        $genLeaseDesc = $row['genLeaseDesc'];
        $genInsuranceDesc = $row['genInsuranceDesc'];
        $genReportsDesc	 = $row['genReportsDesc'];
        $genCorrDesc = $row['genCorrDesc'];
        $genActDesc	= $row['genActDesc'];
        $genCreditDesc = $row['genCreditDesc'];
        $genFolderDesc = $row['genFolderDesc'];
        $genInventDesc = $row['genInventDesc'];
        $genReviewDesc = $row['genReviewDesc'];
        $genReview1Desc = $row['genReview1Desc'];
        $genReview2Desc = $row['genReview2Desc'];
        $genReview3Desc = $row['genReview3Desc'];
        $genReview4Desc = $row['genReview4Desc'];
        $genReview5Desc = $row['genReview5Desc'];
        $genReview6Desc = $row['genReview6Desc'];
        $genReview7Desc = $row['genReview7Desc'];
        $genReview8Desc = $row['genReview8Desc'];
        $genReview9Desc = $row['genReview9Desc'];
        $genReview10Desc = $row['genReview10Desc'];

        $genStockStats = $row['genStockStats'];
        $genCommStats = $row['genCommStats'];
        $genRecentStats = $row['genRecentStats'];
        $genMinStats = $row['genMinStats'];
        $genStratStats = $row['genStratStats'];
        $genListStats = $row['genListStats'];
        $genLeaseStats = $row['genLeaseStats'];
        $genInsuranceStats = $row['genInsuranceStats'];
        $genReportsStats = $row['genReportsStats'];
        $genCorrStats = $row['genCorrStats'];
        $genActStats	 = $row['genActStats'];
        $genCreditStats	 = $row['genCreditStats'];
        $genFolderStats = $row['genFolderStats'];
        $genInventStats = $row['genInventStats'];
        $genReviewStats = $row['genReviewStats'];
        $genReview1Stats = $row['genReview1Stats'];
        $genReview2Stats = $row['genReview2Stats'];
        $genReview3Stats = $row['genReview3Stats'];
        $genReview4Stats = $row['genReview4Stats'];
        $genReview5Stats = $row['genReview5Stats'];
        $genReview6Stats = $row['genReview6Stats'];
        $genReview7Stats = $row['genReview7Stats'];
        $genReview8Stats = $row['genReview8Stats'];
        $genReview9Stats = $row['genReview9Stats'];
        $genReview10Stats = $row['genReview10Stats'];
    } 
}

function extractFileName($filePath) {
    // Split the file path by underscore and get the last part
    $parts = explode('_', $filePath);
    $fileName = end($parts);
    return $fileName;
}

function extractFileName1($filePath, $maxLength) {
    // Split the file path by underscore and get the last part
    $parts = explode('-', $filePath);
    $fileName = end($parts);
    
    // Check if the file name length exceeds the maximum length
    if (strlen($fileName) > $maxLength) {
        // Truncate the file name and append ellipsis
        $fileName = substr($fileName, 0, $maxLength - 3) . '...';
    }
    
    return $fileName;
}

function extractFileName2($filePath, $maxLength) {
    // Split the file path by underscore and get the last part
    $parts = explode('_', $filePath);
    $fileName = end($parts);
    
    // Check if the file name length exceeds the maximum length
    if (strlen($fileName) > $maxLength) {
        // Truncate the file name and append ellipsis
        $fileName = substr($fileName, 0, $maxLength - 3) . '...';
    }
    
    return $fileName;
}

function extractFileName3($filePath, $maxLength) {
    // Split the file path by underscore and get the last part
    $parts = explode('_', $filePath);
    $fileName = end($parts);
    
    // Check if the file name length exceeds the maximum length
    if (strlen($fileName) > $maxLength) {
        // Truncate the file name and append ellipsis
        $fileName = substr($fileName, 0, $maxLength - 3) . '...';
    }
    
    return $fileName;
}

function uploadFiles($con, $filesName, $tableColumn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES[$filesName])) {
        // Define the directory to store uploaded files
        $uploadDir = "bspgen/";
    
        // Create the directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        // Loop through each file
        foreach ($_FILES[$filesName]['tmp_name'] as $index => $tmpName) {
            $fileName = $_FILES[$filesName]['name'][$index];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            
            // Add current date to the filename
            $date = date('Ymd'); // Format: YYYYMMDD
            $newFileName = $date . '_' . $fileName;
    
            $targetFile = $uploadDir . $newFileName;
    
            // Check if file already exists
            if (file_exists($targetFile)) {
                // If file with the same name exists, add a random number
                $randomNumber = rand(1000, 9999);
                $newFileName = $date . '_' . pathinfo($fileName, PATHINFO_FILENAME) . ' ' . $randomNumber . '.' . $fileType;
                $targetFile = $uploadDir . $newFileName;
            }
    
            // Upload the file
            if (move_uploaded_file($tmpName, $targetFile)) {
                // Insert file path into database
                $sql = "INSERT INTO bspgen ($tableColumn) VALUES ('$targetFile')";
                if ($con->query($sql) === TRUE) {
                    // echo "The file " . htmlspecialchars(basename($fileName)) . " has been uploaded successfully as " . htmlspecialchars($newFileName) . ".<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            } else {        
                // echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="./css/dash.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="css/styleloan.css">
</head>
<style>
    h3{
      font-family: "Source Sans Pro", sans-serif;
      color: #656565;
      margin: 30px 0 20px;
    }
    .form-control{
            width: 230px;
            height: 30px;
            position: relative;
            display: inline-flex;
            float: right;
    }

    /* CHECK IMAGE */
    img[src='statusImage/check.png'] {
    width: 20px;
    height: 20px;
    visibility: hidden;
    display:inline-block;
    vertical-align: top;
    }
    /* XMARK IMAGE */
    img[src='statusImage/xmark.png'] {
    width: 20px;
    height: 20px;
    visibility: hidden;
    display:inline-block;
    vertical-align: top;
    }

    #addChart2{
        right: -20px;
        position: relative;
        white-space: nowrap;
    }
    #tag{
        font-size: 12px;
        color: #2E8B57;
        /* right: 23.8rem; */
        position: relative;
        margin-left: 46px;
    }

    #download {
        display: none!important;
    }
    .light-blue {
    background-color: #ADD8E6; /* Light blue */
    }

    .light-yellow {
        background-color: #FFFFE0; /* Light yellow */
    }

    @media only screen and (max-width: 600px) {
        body{
            zoom: 67%;
        }
    }

    @media only screen and (min-width: 767.98px) and (orientation: landscape){
        body{
            zoom: 67%;
        }
    }

    @media only screen and (max-width: 767.98px) and (orientation: portrait) {
    @-ms-viewport { }
        body {
            zoom: 67%;
        }
    }



  /* 200% */
  @media only screen and (min-width: 816.500px){
    @-ms-viewport { }
    body{
        zoom: 67%;
    }
  }

    /* 175% */
    @media only screen and (min-width: 952.571px){
    @-ms-viewport { }
        body {
            zoom: 68%;
        }
    }

  /* 150% */
  @media only screen and (min-width: 1116.670px){
    @-ms-viewport { }
        body {
            zoom: 68%;
        }
  }
  
      /* 125% */
  @media only screen and (min-width: 1346.400px){
    @-ms-viewport { }
        body {
            zoom: 81%;
        }
  }
  
  
    /* 110 */
  @media only screen and (min-width: 1534.550px) {
    @-ms-viewport { }
        body {
            zoom: 95%;
        }
  }
  
    /* 1980x1080 100%*/
   @media only screen and (min-width: 1691px) {
    @-ms-viewport { }
    body {
        zoom: 100%;
    }
  }

    @media screen and (max-width: 1570px) {
    @-ms-viewport { }
        body{
            zoom: 67%;
        }

    }

    /* @media screen and (max-width: 1097.14px){
    @-ms-viewport { }
        
    } */

    @media screen and (min-width: 2133.33px) {
    @-ms-viewport { }
        body {
            zoom: 98%;
        }
    }
</style>
<body oncontextmenu="return false;">
<!--Modal-->
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
<div class="modal-content" style="height: 50%;">
    <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
    <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
</div>
</div>
<!--Modal-->
<button class="btn btn-secondary btn-md btnBack">Back</button> 
<div class = "d-flex flex-row align-items-center justify-content-center">
        <span><h3>GENERAL INFORMATION</h3></span>
</div>
<br><br><br>
<div class="container">
<form action="" method="POST" enctype="multipart/form-data" id="Gen-Form">
<table class="table border">
        <tbody>
            <tr>
            <td class="col-sm-7">
                <label for="" class="form-label">
                    1. Stock and transfer book. 
            <br>&nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong></label>
            </td>
            <td >
                <input type="file" id="genStock" name="genStock"/><img id="genStockImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genStock . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genStockButton" >Open File</button></a>
                <?php if($genStockStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genStockDesc; ?>" type="text" class="form-control  remarks" placeholder="&nbsp;REMARKS" id="genStockDesc" name = "genStockDesc" />
                <?php } else { ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $genStockDesc; ?>" type="text" class="form-control  remarks" placeholder="&nbsp;REMARKS" id="genStockDesc" name = "genStockDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genStock, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files', 'genStock');
                    $sql = "SELECT * FROM bspgen WHERE `id` >= 2 AND `genStock` IS NOT NULL AND `genStock` != '' GROUP BY id";
                    $result = $con->query($sql);
                            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            $user = $row['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row['genStock']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['genStock'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['genStock'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="1">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['genStockDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genStockDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['genStockDesc'] . '" type="text" class=" form-control remarks" placeholder="&nbsp; REMARKS" name="genStockDesc" />';
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files[]" id="fileInput" style="display: none;">
                <label for="fileInput" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
            </tr>
        <tr>
            <td>
            <label for="" class="form-label">
                2. Commitee charters, members of all existing committees and reports of each commitee <br>&nbsp;&nbsp;&nbsp;from 01 January 2022 to latest available.
            <br> &nbsp;&nbsp;&nbsp;<strong> (OIC: Josmin Alvarez)</strong></label>
            </td>
            <td>
                <input type="file" id="genComm" name="genComm"/><img id="genCommImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genComm . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genCommButton" >Open File</button></a>
                <?php if($genCommStats == 1){ ?>
                    <input style="background-color:#ADD8E6;"  value="<?= $genCommDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                REMARKS" id="genCommDesc" name = "genCommDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genCommDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                REMARKS" id="genCommDesc" name = "genCommDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genComm, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files', 'genComm');
                    $sql2 = "SELECT * FROM bspgen WHERE `id` >= 2 AND `genComm` IS NOT NULL AND `genComm` != '' GROUP BY id";
                    $result2 = $con->query($sql2);
                            
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $user = $row2['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row2['genComm']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['genComm'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['genComm'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="2">';
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['genCommDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genCommDesc" id="genCommDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['genCommDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genCommDesc" id="genCommDesc" />';   
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files2[]" id="fileInput2" style="display: none;">
                <label for="fileInput2" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">3. Recent biographical data of directors and key officers as well as the job description of <br>&nbsp;&nbsp;&nbsp;all key officers. <br>
                &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong></label>
            </td>
            <td>
                <input type="file" id="genRecent" name="genRecent"/><img id="genRecentImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genRecent . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genRecentButton" >Open File</button></a>
                <?php if($genRecentStats == 1){ ?>
                    <input  style="background-color:#ADD8E6;" value="<?= $genRecentDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genRecentDesc" name = "genRecentDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genRecentDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genRecentDesc" name = "genRecentDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genRecent, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files3', 'genRecent');
                    $sql3 = "SELECT * FROM bspgen WHERE `id` >= 2 AND `genRecent` IS NOT NULL AND `genRecent` != '' GROUP BY id";
                    $result3 = $con->query($sql3);
                            
                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            $user = $row3['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row3['genRecent']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['genRecent'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['genRecent'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="3">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input  style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['genRecentDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genRecentDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['genRecentDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genRecentDesc" />'; 
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files3[]" id="fileInput3" style="display: none;">
                <label for="fileInput3" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">4. Minutes of board, stockholders and commitee, meeting from 01 January 2022 to latest <br>&nbsp;&nbsp;&nbsp;the avalable, 
                including information packages presented to them. <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong></label>
            </td>
            <td>
                <input type="file" id="genMin" name="genMin"/><img id="genMinImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genMin . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genMinButton" >Open File</button></a>
                <?php if($genMinStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genMinDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genMinDesc" name = "genMinDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genMinDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genMinDesc" name = "genMinDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genMin, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files4', 'genMin');
                    $sql4 = "SELECT * FROM bspgen WHERE `id` >= 2 AND `genMin` IS NOT NULL AND `genMin` != '' GROUP BY id";
                    $result4 = $con->query($sql4);
                            
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $user = $row4['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row4['genMin']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['genMin'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['genMin'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="4">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['genMinDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genMinDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['genMinDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genMinDesc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files4[]" id="fileInput4" style="display: none;">
                <label for="fileInput4" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">5. Strategic businesss plans and previous and current years financial projections/budgets.</label>
            </td>
            <td>
                <input type="file" id="genStrat" name="genStrat"/><img id="genStratImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genStrat . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genStratButton" >Open File</button></a>
                <?php if($genStratStats == 1){ ?>
                    <input style="background-color:#ADD8E6;"  value="<?= $genStratDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genStratDesc" name = "genStratDesc" />
                <?php } else { ?>
                    <input  style="background-color:#FFFFE0;" value="<?= $genStratDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genStratDesc" name = "genStratDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genStrat, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files5', 'genStrat');
                    $sql5 = "SELECT * FROM bspgen  WHERE `id` >= 2 AND `genStrat` IS NOT NULL AND `genStrat` != '' GROUP BY id";
                    $result5 = $con->query($sql5);
                            
                    if ($result5->num_rows > 0) {
                        while ($row5 = $result5->fetch_assoc()) {
                            $user = $row5['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row5['genStrat']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['genStrat'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['genStrat'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="5">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row5['genStratDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genStratDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['genStratDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genStratDesc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files5[]" id="fileInput5" style="display: none;">
                <label for="fileInput5" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">6. List of all outsourced and insourced services of the bank and outsourcing contracts/service &nbsp;&nbsp;&nbsp;agreements.
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong></label>
            </td>
            <td>
                <input type="file" id="genList" name="genList"/><img id="genListImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genList . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genListButton" >Open File</button></a>
                <?php if($genListStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genListDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genListDesc" name = "genListDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genListDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genListDesc" name = "genListDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genList, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files6', 'genList');
                    $sql6 = "SELECT * FROM bspgen  WHERE `id` >= 2 AND `genList` IS NOT NULL AND `genList` != '' GROUP BY id";
                    $result6 = $con->query($sql6);
                            
                    if ($result6->num_rows > 0) {
                        while ($row6 = $result6->fetch_assoc()) {
                            $user = $row6['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row6['genList']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row6['genList'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row6['genList'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row6['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="6">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row6['genListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genListDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row6['genListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genListDesc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files6[]" id="fileInput6" style="display: none;">
                <label for="fileInput6" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">
                7. Lease contracts of bank premises, if any. <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong></label>
            </td>
            <td>
                <input type="file" id="genLease" name="genLease"/><img id="genLeaseImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genLease . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genLeaseButton" >Open File</button></a>
                <?php if($genLeaseStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genLeaseDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genLeaseDesc" name = "genLeaseDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genLeaseDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genLeaseDesc" name = "genLeaseDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genLease, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files7', 'genLease');
                    $sql7 = "SELECT * FROM bspgen WHERE `id` >= 2 AND `genLease` IS NOT NULL AND `genLease` != '' GROUP BY id";
                    $result7 = $con->query($sql7);
                            
                    if ($result7->num_rows > 0) {
                        while ($row7 = $result7->fetch_assoc()) {
                            $user = $row7['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row7['genLease']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row7['genLease'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row7['genLease'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row7['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="7">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row7['genLeaseDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genLeaseDesc" />';
                            }else{
                            echo '<input  style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row7['genLeaseDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genLeaseDesc" />';     
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files7[]" id="fileInput7" style="display: none;">
                <label for="fileInput7" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">8. Insurance policies and fidelity bonds on cash (including cash transfers), properties and <br>&nbsp;&nbsp;&nbsp;idemnities.
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes) </strong></label>
            </td>
            <td>
                <input type="file" id="genInsurance" name="genInsurance"/><img id="genInsuranceImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genInsurance . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genInsuranceButton" >Open File</button></a>
                <?php if($genInsuranceStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genInsuranceDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genInsuranceDesc" name = "genInsuranceDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;"  value="<?= $genInsuranceDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genInsuranceDesc" name = "genInsuranceDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genInsurance, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files8', 'genInsurance');
                    $sql8 = "SELECT  * FROM bspgen WHERE `id` >= 2 AND `genInsurance` IS NOT NULL AND `genInsurance` != '' GROUP BY id";
                    $result8 = $con->query($sql8);
                            
                    if ($result8->num_rows > 0) {
                        while ($row8 = $result8->fetch_assoc()) {
                            $user = $row8['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row8['genInsurance']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row8['genInsurance'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row8['genInsurance'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row8['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="8">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row8['genInsuranceDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genInsuranceDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row8['genInsuranceDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genInsuranceDesc" />';   
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files8[]" id="fileInput8" style="display: none;">
                <label for="fileInput8" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">9. Reports on crimes and losses from 01 January 2022 to latest available, if any.</label>
            </td>
            <td>
                <input type="file" id="genReports" name="genReports"/><img id="genReportsImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReports . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReportsButton" >Open File</button></a>
                <?php if($genReportsStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReportsDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genReportsDesc" name = "genReportsDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReportsDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genReportsDesc" name = "genReportsDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReports, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files9', 'genReports');
                    $sql9 = "SELECT * FROM bspgen WHERE id >= 2 AND genReports != '' AND genReports IS NOT NULL GROUP BY id ";
                    $result9 = $con->query($sql9);
                            
                    if ($result9->num_rows > 0) {
                        while ($row9 = $result9->fetch_assoc()) {
                            $user = $row9['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row9['genReports']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row9['genReports'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row9['genReports'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row9['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="9">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row9['genReportsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReportsDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row9['genReportsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReportsDesc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files9[]" id="fileInput9" style="display: none;">
                <label for="fileInput9" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">10. Correspondence files/letters between the bank and other regulatory agencies such as <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Philippine deposit insurance corporation (PDIC),
             bureau of internal revenue (BIR), etc.
             <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong></label>
            </td>
            <td>
                <input type="file" id="genCorr" name="genCorr"/><img id="genCorrImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genCorr . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genCorrButton" >Open File</button></a>
                <?php if($genCorrStats == 1){ ?>
                    <input style="background-color:#ADD8E6;"  value="<?= $genCorrDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genCorrDesc" name = "genCorrDesc" />
                <?php } else { ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $genCorrDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genCorrDesc" name = "genCorrDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genCorr, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files10', 'genCorr');
                    $sql10 = "SELECT * FROM bspgen WHERE id >= 2 AND genCorr != '' AND genCorr IS NOT NULL GROUP BY id ";
                    $result10 = $con->query($sql10);
                            
                    if ($result10->num_rows > 0) {
                        while ($row10 = $result10->fetch_assoc()) {
                            $user = $row10['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row10['genCorr']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row10['genCorr'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row10['genCorr'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row10['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="10">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;"  onchange="submitremarks(this)" value="' . $row10['genCorrDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genCorrDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row10['genCorrDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genCorrDesc" />';       
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files10[]" id="fileInput10" style="display: none;">
                <label for="fileInput10" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">11. Actuarial valuation report.
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong></label>
            </td>
            <td>
                <input type="file" id="genAct" name="genAct"/><img id="genActImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genAct . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genActButton" >Open File</button></a>
                <?php if($genActStats == 1){ ?>
                    <input  style="background-color:#ADD8E6;" value="<?= $genActDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genActDesc" name = "genActDesc" />
                <?php } else { ?>
                    <input style="background-color:#ADD8E6;"  value="<?= $genActDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genActDesc" name = "genActDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genAct, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files11', 'genAct');
                    $sql11 = "SELECT * FROM bspgen WHERE id >= 2 AND genAct != '' AND genAct IS NOT NULL GROUP BY id ";
                    $result11 = $con->query($sql11);
                            
                    if ($result11->num_rows > 0) {
                        while ($row11 = $result11->fetch_assoc()) {
                            $user = $row11['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row11['genAct']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row11['genAct'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row11['genAct'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row11['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="11">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row11['genActDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genActDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row11['genActDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genActDesc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files11[]" id="fileInput11" style="display: none;">
                <label for="fileInput11" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">12. Credit folders of top 20 borrowers
                (additional credit folders will be requested during  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the conduct of the regular examination).
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong></label>
            </td>
            <td>
                <input type="file" id="genCredit" name="genCredit"/><img id="genCreditImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genCredit . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genCreditButton" >Open File</button></a>
                <?php if($genCreditStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genCreditDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genCreditDesc" name = "genCreditDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genCreditDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genCreditDesc" name = "genCreditDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName3($genCredit, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files12', 'genCredit');
                    $sql12 = "SELECT * FROM bspgen WHERE id >= 2 AND genAct != '' AND genAct IS NOT NULL GROUP BY id ";
                    $result12 = $con->query($sql12);
                            
                    if ($result12->num_rows > 0) {
                        while ($row12 = $result12->fetch_assoc()) {
                            $user = $row12['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row12['genCredit']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row12['genCredit'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row12['genCredit'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row12['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="12">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row12['genCreditDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genCreditDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row12['genCreditDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genCreditDesc" />';   
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files12[]" id="fileInput12" style="display: none;">
                <label for="fileInput12" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label for="" class="form-label">13. Folders of all ROPA and SCR, if any.
            <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </label>
            </td>
            <td>
                <input type="file" id="genFolder" name="genFolder"/><img id="genFolderImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genFolder . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genFolderButton" >Open File</button></a>
                <?php if($genFolderStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genFolderDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genFolderDesc" name = "genFolderDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genFolderDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genFolderDesc" name = "genFolderDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genFolder, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files13', 'genFolder');
                    $sql13 = "SELECT * FROM bspgen WHERE id >= 2 AND genFolder != '' AND genFolder IS NOT NULL GROUP BY id ";
                    $result13 = $con->query($sql13);
                            
                    if ($result13->num_rows > 0) {
                        while ($row13= $result13->fetch_assoc()) {
                            $user = $row13['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row13['genFolder']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row13['genFolder'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row13['genFolder'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row13['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="13">';
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row13['genFolderDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genFolderDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row13['genFolderDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genFolderDesc" />';   
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files13[]" id="fileInput13" style="display: none;">
                <label for="fileInput13" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
            <label class="form-label">14. Inventory/list of existing manual, policies and procedures 
            (please indicate the latest <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;date when updates were made and the date and number of board resolution).
            <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Christine Diane Alegre)</strong></label>
            </td>
            <td>
                <input type="file" id="genInvent" name="genInvent"/><img id="genInventImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genInvent . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genInventButton" >Open File</button></a>
                <?php if($genInventStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genInventDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genInventDesc" name = "genInventDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genInventDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;
                    REMARKS" id="genInventDesc" name = "genInventDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genInvent, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files14', 'genInvent');
                    $sql14 = "SELECT * FROM bspgen WHERE id >= 2 AND genInvent != '' AND genInvent IS NOT NULL GROUP BY id ";
                    $result14 = $con->query($sql14);
                            
                    if ($result14->num_rows > 0) {
                        while ($row14= $result14->fetch_assoc()) {
                            $user = $row14['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row14['genInvent']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row14['genInvent'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row14['genInvent'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row14['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="14">'; 
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row14['genInventDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genInventDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row14['genInventDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genInventDesc" />';
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files14[]" id="fileInput14" style="display: none;">
                <label for="fileInput14" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <!-- Make a Review of the FF. -->
        <tr>
            <td>
                <label class="form-label"><strong>Also, please make the following available for review during the examination:</strong>
                                            <br>&nbsp;&nbsp;&nbsp;<strong>(OIC: Christine Diane Alegre)</strong>
                </label>
            </td>
            <td>
                <input hidden type="file" id="genReview" name="genReview"/><img hidden id="genReviewImage" src="statusImage/check.png" alt="statusImage">
                <a hidden href="<?php echo $genReview . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReviewButton" >Open File</button></a>
                <input hidden value="<?= $genReviewDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReviewDesc" name = "genReviewDesc" />
                <br>

                <input type="file" name="files15[]" id="fileInput15" style="display: none;">
                <label for="fileInput15" style="cursor: pointer; font-size: 14px;" hidden>
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;a. Acquired Assets Management and Remedial Mangement Policies and Procedures.
            </td>
            <td>
            <input type="file" id="genReview1" name="genReview1"/><img id="genReview1Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview1 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview1Button" >Open File</button></a>
                <?php if($genReview1Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview1Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview1Desc" name = "genReview1Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;"  value="<?= $genReview1Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview1Desc" name = "genReview1Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview1, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files16', 'genReview1');
                    $sql16 = "SELECT * FROM bspgen WHERE id >= 2 AND genReview1 != '' AND genReview1 IS NOT NULL GROUP BY id ";
                    $result16 = $con->query($sql16);
                            
                    if ($result16->num_rows > 0) {
                        while ($row16= $result16->fetch_assoc()) {
                            $user = $row16['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row16['genReview1']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row16['genReview1'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row16['genReview1'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row16['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="16">';
                            if ($user >=92 & $user <= 96){   
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row16['genReview1Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview1Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row16['genReview1Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview1Desc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files16[]" id="fileInput16" style="display: none;">
                <label for="fileInput16" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;b. Code of Ethics/Conduct for Board of Directors, Senior Management and Employees.
            </td>
            <td>
            <input type="file" id="genReview2" name="genReview2"/><img id="genReview2Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview2 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview2Button" >Open File</button></a>
                <?php if($genReview2Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview2Desc" name = "genReview2Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;"  value="<?= $genReview2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview2Desc" name = "genReview2Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview2, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files17', 'genReview2');
                    $sql17 = "SELECT  * FROM bspgen WHERE id >= 2 AND genReview2 != '' AND genReview2 IS NOT NULL GROUP BY id ";
                    $result17 = $con->query($sql17);
                            
                    if ($result17->num_rows > 0) {
                        while ($row17= $result17->fetch_assoc()) {
                            $user = $row17['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row17['genReview2']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row17['genReview2'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row17['genReview2'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row17['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="17">'; 
                            if ($user >=92 & $user <= 96){   
                            echo '<input style="background-color:#ADD8E6;"  onchange="submitremarks(this)" value="' . $row17['genReview2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview2Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;"  onchange="submitremarks(this)" value="' . $row17['genReview2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview2Desc" />';   
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files17[]" id="fileInput17" style="display: none;">
                <label for="fileInput17" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;c. Human Resources Management Manual, including fringe benefits and retirement program.
            </td>
            <td>
            <input type="file" id="genReview3" name="genReview3"/><img id="genReview3Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview3 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview3Button" >Open File</button></a>
                <?php if($genReview3Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview3Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview3Desc" name = "genReview3Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview3Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview3Desc" name = "genReview3Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview3, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files18', 'genReview3');
                    $sql18 = "SELECT * FROM bspgen WHERE id >= 2 AND genReview3 != '' AND genReview3 IS NOT NULL GROUP BY id ";
                    $result18 = $con->query($sql18);
                            
                    if ($result18->num_rows > 0) {
                        while ($row18= $result18->fetch_assoc()) {
                            $user = $row18['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row18['genReview3']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row18['genReview3'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row18['genReview3'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row18['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="18">'; 
                            if ($user >=92 & $user <= 96){   
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row18['genReview3Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview3Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row18['genReview3Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview3Desc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files18[]" id="fileInput18" style="display: none;">
                <label for="fileInput18" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;d. Succession Plan.
            </td>
            <td>
            <input type="file" id="genReview4" name="genReview4"/><img id="genReview4Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview4 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview4Button" >Open File</button></a>
                <?php if($genReview4Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview4Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview4Desc" name = "genReview4Desc" />
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview4Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview4Desc" name = "genReview4Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview4, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files19', 'genReview4');
                    $sql19 = "SELECT * FROM bspgen WHERE id >= 2 AND genReview4 != '' AND genReview4 IS NOT NULL GROUP BY id ";
                    $result19 = $con->query($sql19);
                            
                    if ($result19->num_rows > 0) {
                        while ($row19= $result19->fetch_assoc()) {
                            $user = $row19['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row19['genReview4']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row19['genReview4'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row19['genReview4'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row18['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="19">'; 
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row19['genReview4Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview4Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row19['genReview4Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview4Desc" />'; 
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files19[]" id="fileInput19" style="display: none;">
                <label for="fileInput19" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;e. Manual of Operations.
            </td>
            <td>
            <input type="file" id="genReview5" name="genReview5"/><img id="genReview5Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview5 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview5Button" >Open File</button></a>
                <?php if($genReview5Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview5Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview5Desc" name = "genReview5Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview5Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview5Desc" name = "genReview5Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview5, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files20', 'genReview5');
                    $sql20 = "SELECT * FROM bspgen WHERE id >= 2 AND genReview5 != '' AND genReview5 IS NOT NULL GROUP BY id ";
                    $result20 = $con->query($sql20);
                            
                    if ($result20->num_rows > 0) {
                        while ($row20= $result20->fetch_assoc()) {
                            $user = $row20['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row20['genReview5']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row20['genReview5'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row20['genReview5'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row20['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="20">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row20['genReview5Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview5Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row20['genReview5Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview5Desc" />';   
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files20[]" id="fileInput20" style="display: none;">
                <label for="fileInput20" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;f. Internal Control System/Manual.
            </td>
            <td>
            <input type="file" id="genReview6" name="genReview6"/><img id="genReview6Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview6 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview6Button" >Open File</button></a>
                <?php if($genReview6Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview6Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview6Desc" name = "genReview6Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview6Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview6Desc" name = "genReview6Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview6, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files21', 'genReview6');
                    $sql21 = "SELECT  * FROM bspgen WHERE id >= 2 AND genReview6 != '' AND genReview6 IS NOT NULL GROUP BY id ";
                    $result21 = $con->query($sql21);
                            
                    if ($result21->num_rows > 0) {
                        while ($row21= $result21->fetch_assoc()) {
                            $user = $row21['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row21['genReview6']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row21['genReview6'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row21['genReview6'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row21['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="21">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row21['genReview6Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview6Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row21['genReview6Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview6Desc" />';  
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files21[]" id="fileInput21" style="display: none;">
                <label for="fileInput21" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;g. Risk Management System/Manual.
            </td>
            <td>
            <input type="file" id="genReview7" name="genReview7"/><img id="genReview7Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview7 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview7Button" >Open File</button></a>
                <?php if($genReview7Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview7Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview7Desc" name = "genReview7Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview7Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview7Desc" name = "genReview7Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview7, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files22', 'genReview7');
                    $sql22 = "SELECT  * FROM bspgen WHERE id >= 2 AND genReview7 != '' AND genReview7 IS NOT NULL GROUP BY id ";
                    $result22 = $con->query($sql22);
                            
                    if ($result22->num_rows > 0) {
                        while ($row22= $result22->fetch_assoc()) {
                            $user = $row22['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row22['genReview7']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row22['genReview7'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row22['genReview7'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row22['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="22">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row22['genReview7Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview7Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row22['genReview7Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview7Desc" />';
                           }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files22[]" id="fileInput22" style="display: none;">
                <label for="fileInput22" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;h. Security Manual.
            </td>
            <td>
            <input type="file" id="genReview8" name="genReview8"/><img id="genReview8Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview8 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview8Button" >Open File</button></a>
                <?php if($genReview8Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview8Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview8Desc" name = "genReview8Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview8Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview8Desc" name = "genReview8Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview8, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files23', 'genReview8');
                    $sql23 = "SELECT * FROM bspgen WHERE id >= 2 AND genReview8 != '' AND genReview8 IS NOT NULL GROUP BY id ";
                    $result23 = $con->query($sql23);
                            
                    if ($result23->num_rows > 0) {
                        while ($row23= $result23->fetch_assoc()) {
                            $user = $row23['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row23['genReview8']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row23['genReview8'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row23['genReview8'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row23['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="23">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row23['genReview8Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview8Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row23['genReview8Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview8Desc" />';  
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files23[]" id="fileInput23" style="display: none;">
                <label for="fileInput23" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;i. Internal Audit Manuals/Programs/Plan/Charter.
            </td>
            <td>
            <input type="file" id="genReview9" name="genReview9"/><img id="genReview9Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview9 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview9Button" >Open File</button></a>
                <?php if($genReview9Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview9Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview9Desc" name = "genReview9Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview9Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview9Desc" name = "genReview9Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview9, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files24', 'genReview9');
                    $sql24 = "SELECT * FROM bspgen WHERE id >= 2 AND genReview9 != '' AND genReview9 IS NOT NULL GROUP BY id ";
                    $result24 = $con->query($sql24);
                            
                    if ($result24->num_rows > 0) {
                        while ($row24= $result24->fetch_assoc()) {
                            $user = $row24['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row24['genReview9']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row24['genReview9'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row24['genReview9'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row24['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="24">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row24['genReview9Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview9Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row24['genReview9Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview9Desc" />';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files24[]" id="fileInput24" style="display: none;">
                <label for="fileInput24" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;j. Compliance Program and list of updates from 01 January 2022 to latest available.
            </td>
            <td>
            <input type="file" id="genReview10" name="genReview10"/><img id="genReview10Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $genReview10 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="genReview10Button" >Open File</button></a>
                <?php if($genReview10Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $genReview10Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview10Desc" name = "genReview10Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $genReview10Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="genReview10Desc" name = "genReview10Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($genReview10, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files23', 'genReview10');
                    $sql25 = "SELECT * FROM bspgen WHERE id >= 2 AND genReview10 != '' AND genReview10 IS NOT NULL GROUP BY id ";
                    $result25 = $con->query($sql25);
                            
                    if ($result25->num_rows > 0) {
                        while ($row25= $result25->fetch_assoc()) {
                            $user = $row25['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row25['genReview10']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row25['genReview10'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row25['genReview10'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-gendesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row25['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="25">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row25['genReview10Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview10Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row25['genReview10Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="genReview10Desc" />'; 
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files25[]" id="fileInput25" style="display: none;">
                <label for="fileInput23" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
    </tbody>
</table>
</form>
</div>


<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<script>
    $(document).ready(function() {
    $(".btnBack").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp.php";
    });
});
</script>

<script>
// function hideText(){
// const inputElements = document.querySelectorAll('input[type="text"]');

// // LOOP THROUGH EACH INPUT ELEMENT AND SET THE HIDDEN ATTRIBUTE
//     inputElements.forEach(inputElement => {
//   inputElement.style.visibility="hidden";
// });
// }
// hideText();

function updateFileStatus(inputId, imageId) {
    var inputFile = document.getElementById(inputId);
    var image = document.getElementById(imageId);

    if (inputFile.files.length > 0) {
    image.src = 'statusImage/check.png'; // SHOW CHECK ICON IF FILE IS UPLOADED
    image.style.visibility = 'visible'; // MAKE THE IMAGE VISIBLE
    }
}
</script>

<script>

var genForm = document.getElementById("Gen-Form");

function uploadFileI() {
var GenFormData = new FormData(genForm);
$.ajax({
    url: 'bsp-generalinfo-upload.php', 
    type: 'POST',
    data: GenFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
// AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
// FOR LOAN APPLICATION:
console.log(response);

updateFileStatus('genStock', 'genStockImage');
updateFileStatus('genComm', 'genCommImage');
updateFileStatus('genRecent', 'genRecentImage');
updateFileStatus('genMin', 'genMinImage');
updateFileStatus('genStrat', 'genStratImage');
updateFileStatus('genList', 'genListImage');
updateFileStatus('genLease', 'genLeaseImage');
updateFileStatus('genInsurance', 'genInsuranceImage');
updateFileStatus('genReports', 'genReportsImage');
updateFileStatus('genCorr', 'genCorrImage');
updateFileStatus('genAct', 'genActImage');
updateFileStatus('genCredit', 'genCreditImage');
updateFileStatus('genFolder', 'genFolderImage');
updateFileStatus('genInvent', 'genInventImage');
updateFileStatus('genReview', 'genReviewImage');
updateFileStatus('genReview1', 'genReview1Image');
updateFileStatus('genReview2', 'genReview2Image');
updateFileStatus('genReview3', 'genReview3Image');
updateFileStatus('genReview4', 'genReview4Image');
updateFileStatus('genReview5', 'genReview5Image');
updateFileStatus('genReview6', 'genReview6Image');
updateFileStatus('genReview7', 'genReview7Image');
updateFileStatus('genReview8', 'genReview8Image');
updateFileStatus('genReview9', 'genReview9Image');
updateFileStatus('genReview10', 'genReview10Image');
// location.reload();
},
    error: function(xhr, status, error) {
    console.log('File upload failed');
    }
});
}
//var marketForm = document.getElementById("Market-Form");
genForm.addEventListener("change", function() {
uploadFileI();
});
</script>
<script>
function setFileVisibility(files, select, input, check, button) {
    var inputElement = document.getElementById(input);
    var checkElement = document.getElementById(check);
    var buttonElement = document.getElementById(button);

    if (!files || files.trim() === "") {
        // If files is empty or null, show xmark.png and hide the button
        checkElement.src = 'statusImage/xmark.png';
        checkElement.style.visibility = "visible";
        buttonElement.style.display = "none";
    } else {
        // If files is not empty
        inputElement.style.display = "none";
        checkElement.style.visibility = "visible";
        buttonElement.style.display = "inline";

        if (select.split('--')[0] === "2") {
            inputElement.style.display = "inline";
            checkElement.src ='statusImage/xmark.png';
            buttonElement.style.display = "none";
        }
    }
}



// Example usage:
setFileVisibility("<?php echo $genStock; ?>", "<?php echo $genStockDesc; ?>", 'genStock', 'genStockImage', "genStockButton");
setFileVisibility("<?php echo $genComm; ?>", "<?php echo $genCommDesc; ?>", 'genComm', 'genCommImage', "genCommButton");
setFileVisibility("<?php echo $genRecent; ?>", "<?php echo $genRecentDesc; ?>", 'genRecent', 'genRecentImage', "genRecentButton");
setFileVisibility("<?php echo $genMin; ?>", "<?php echo $genMinDesc; ?>", 'genMin', 'genMinImage', "genMinButton");
setFileVisibility("<?php echo $genStrat; ?>", "<?php echo $genStratDesc; ?>", 'genStrat', 'genStratImage', "genStratButton");
setFileVisibility("<?php echo $genList; ?>", "<?php echo $genListDesc; ?>", 'genList', 'genListImage', "genListButton");
setFileVisibility("<?php echo $genLease; ?>", "<?php echo $genLeaseDesc; ?>", 'genLease', 'genLeaseImage', "genLeaseButton");
setFileVisibility("<?php echo $genInsurance; ?>", "<?php echo $genInsuranceDesc; ?>", 'genInsurance', 'genInsuranceImage', "genInsuranceButton");
setFileVisibility("<?php echo $genReports; ?>", "<?php echo $genReportsDesc; ?>", 'genReports', 'genReportsImage', "genReportsButton");
setFileVisibility("<?php echo $genCorr; ?>", "<?php echo $genCorrDesc; ?>", 'genCorr', 'genCorrImage', "genCorrButton");
setFileVisibility("<?php echo $genAct; ?>", "<?php echo $genActDesc; ?>", 'genAct', 'genActImage', "genActButton");
setFileVisibility("<?php echo $genCredit; ?>", "<?php echo $genCreditDesc; ?>", 'genCredit', 'genCreditImage', "genCreditButton");
setFileVisibility("<?php echo $genFolder; ?>", "<?php echo $genFolderDesc; ?>", 'genFolder', 'genFolderImage', "genFolderButton");
setFileVisibility("<?php echo $genInvent; ?>", "<?php echo $genInventDesc; ?>", 'genInvent', 'genInventImage', "genInventButton");
setFileVisibility("<?php echo $genReview; ?>", "<?php echo $genReviewDesc; ?>", 'genReview', 'genReviewImage', "genReviewButton");
setFileVisibility("<?php echo $genReview1; ?>", "<?php echo $genReview1Desc; ?>", 'genReview1', 'genReview1Image', "genReview1Button");
setFileVisibility("<?php echo $genReview2; ?>", "<?php echo $genReview2Desc; ?>", 'genReview2', 'genReview2Image', "genReview2Button");
setFileVisibility("<?php echo $genReview3; ?>", "<?php echo $genReview3Desc; ?>", 'genReview3', 'genReview3Image', "genReview3Button");
setFileVisibility("<?php echo $genReview4; ?>", "<?php echo $genReview4Desc; ?>", 'genReview4', 'genReview4Image', "genReview4Button");
setFileVisibility("<?php echo $genReview5; ?>", "<?php echo $genReview5Desc; ?>", 'genReview5', 'genReview5Image', "genReview5Button");
setFileVisibility("<?php echo $genReview6; ?>", "<?php echo $genReview6Desc; ?>", 'genReview6', 'genReview6Image', "genReview6Button");
setFileVisibility("<?php echo $genReview7; ?>", "<?php echo $genReview7Desc; ?>", 'genReview7', 'genReview7Image', "genReview7Button");
setFileVisibility("<?php echo $genReview8; ?>", "<?php echo $genReview8Desc; ?>", 'genReview8', 'genReview8Image', "genReview8Button");
setFileVisibility("<?php echo $genReview9; ?>", "<?php echo $genReview9Desc; ?>", 'genReview9', 'genReview9Image', "genReview9Button");
setFileVisibility("<?php echo $genReview10; ?>", "<?php echo $genReview10Desc; ?>", 'genReview10', 'genReview10Image', "genReview10Button");
</script>

<script>

function showText(target, position){
    var modal = document.getElementById("myModal");
    var span = document.getElementById("closeModal");
    var btn = document.getElementById(target);
    var modalText = document.getElementById("modalText"); 

    // When the button is clicked, display the modal
    btn.addEventListener("click", function () {
        modalText.textContent = btn.value; // Set the modalText content
        modal.style.marginTop = position;
        modal.style.display = "block";
         
    });

    btn.addEventListener("input", function () {
        modalText.textContent = btn.value; // Set the modalText content
        modalText.textContent = textField.value;
         
    });
    // When the 'x' (close) is clicked, close the modal
    span.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // When the background is clicked, close the modal
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
        modal.style.display = "none";
        }
    });

}
showText('genStockDesc','21%');
showText('genCommDesc','21%');
showText('genCommDesc1','21%');
showText('genRecentDesc','21%');
showText('genMinDesc','21%');
showText('genStratDesc','21%');
showText('genListDesc','21%');
showText('genLeaseDesc','21%');
showText('genInsuranceDesc','21%');
showText('genReportsDesc','21%');
showText('genCorrDesc','21%');
showText('genActDesc','21%');
showText('genCreditDesc','21%');
showText('genFolderDesc','21%');
showText('genInventDesc','70%');
showText('genReviewDesc','70%');
showText('genReview1Desc','70%');
showText('genReview2Desc','70%');
showText('genReview3Desc','70%');
showText('genReview4Desc','70%');
showText('genReview5Desc','70%');
showText('genReview6Desc','70%');
showText('genReview7Desc','70%');
showText('genReview8Desc','70%');
showText('genReview9Desc','70%');
showText('genReview10Desc','70%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput6").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput7").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput8").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput9").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput10").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput11").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput12").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput13").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput14").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput15").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput16").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput17").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput18").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput19").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput20").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput21").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput22").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput23").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput24").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
document.getElementById("fileInput25").addEventListener("change", function() {
document.getElementById("Gen-Form").submit();
});
</script>
<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

    $('#genStockDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genStockDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genCommDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genCommDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});


$('#genRecentDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genRecentDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genMinDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genMinDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genStratDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genStratDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genListDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genListDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genLeaseDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genLeaseDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});


$('#genInsuranceDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genInsuranceDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReportsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReportsDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genCorrDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genCorrDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genActDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genActDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genCreditDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genCreditDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genFolderDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genFolderDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genInventDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genInventDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});


$('#genReviewDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReviewDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview1Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview1Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview2Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview2Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview3Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview3Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview4Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview4Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview5Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview5Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview6Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview6Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview7Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview7Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview8Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview8Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#genReview9Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview9Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});


$('#genReview10Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-genstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'genReview10Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});
</script>

</body>
</html>