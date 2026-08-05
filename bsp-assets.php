<?php
include('connection.php');
include('fileUploadBSP.php');

$selectMarket = "SELECT * FROM `bspassets` WHERE id = 1";
$data = mysqli_query($con, $selectMarket) ;
if (!$data) {
    echo("Error description: " . mysqli_error($con));
}else{
    while ($row = mysqli_fetch_array($data)) {
        $aamManual = $row['aamManual'];
        $aamList = $row['aamList'];
        $aamAssests = $row['aamAssests'];
        $aamSales = $row['aamSales'];
        $aamSched = $row['aamSched'];
        $aamSched2 = $row['aamSched2'];
        //Desc
        $aamManualDesc = $row['aamManualDesc'];
        $aamListDesc = $row['aamListDesc'];
        $aamAssestsDesc = $row['aamAssestsDesc'];
        $aamSalesDesc = $row['aamSalesDesc'];
        $aamSchedDesc = $row['aamSchedDesc'];
        $aamSched2Desc = $row['aamSched2Desc'];

        $aamManualStats = $row['aamManualStats'];
        $aamListStats = $row['aamListStats'];
        $aamAssestsStats = $row['aamAssestsStats'];
        $aamSalesStats = $row['aamSalesStats'];
        $aamSchedStats = $row['aamSchedStats'];
        $aamSched2Stats = $row['aamSched2Stats'];
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

function uploadFiles($con, $filesName, $tableColumn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES[$filesName])) {
        // Define the directory to store uploaded files
        $uploadDir = "bspassets/";
    
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
                $sql = "INSERT INTO bspassets ($tableColumn) VALUES ('$targetFile')";
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

/* .remarks{
width: 230px;
height: 30px;
position: relative;
display: inline-flex;
right: 10px;
margin-left:10px;
} */
.form-control{
    width: 230px;
    height: 30px;
    position: relative;
    display: inline-flex;
    float: right;
}

#addChart2{
    right: -26px;
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
</style>

<body oncontextmenu="return false;">   
<button class="btn btn-secondary btn-md btnBack">Back</button>  
<div class = "d-flex flex-column align-items-center  justify-content-center">
        <h3>ACQUIRED ASSETS MANAGEMENT AND REMEDIAL MANAGEMENT<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ROPA/SCR/NON-CURRENT ASSESTS HELD FOR SALE)
        </h3>
</div>
<br><br><br>
<!--Modal-->
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
<div class="modal-content" style="height: 50%;">
    <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
    <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
</div>
</div>
<!--Modal-->

<div class= "container">
<form action="" method="POST" enctype="multipart/form-data" id="AAM-Form">
    <table class="table border">
        <tbody>
        <tr>
            <td class="col-sm-7">
                1. Manuals, policies and procedures on acquired assests management and remedial <br>&nbsp;&nbsp;&nbsp;management
                (ROPA, SCR, Non-current Assests Held for Sale).
                <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
            <input type="file" id="aamManual" name="aamManual"/><img id="aamManualImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $aamManual . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="aamManualButton" >Open File</button></a>
            <?php if($aamManualStats == 1){ ?>
                <input  style="background-color:#ADD8E6;" value="<?= $aamManualDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamManualDesc" name = "aamManualDesc" />
            <?php } else{ ?> 
                <input style="background-color:#FFFFE0;" value="<?= $aamManualDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamManualDesc" name = "aamManualDesc" />
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($aamManual, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files', 'aamManual');
                $sql = "SELECT * FROM bspassets WHERE `id` >= 2 AND `aamManual` IS NOT NULL AND `aamManual` != '' GROUP BY id";
                $result = $con->query($sql);
                            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $user = $row['userid'];
                        echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row['aamManual']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['aamManual'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['aamManual'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-assetsdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                        echo '<input type="hidden" name="form_submit" value="1">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['aamManualDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamManualDesc" style="margin-top: -1.5rem;"/>';
                        }else{
                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['aamManualDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamManualDesc" style="margin-top: -1.5rem;"/>';   
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
                2. List and copies of reports generated by collection and work-out unit on a regular <br>&nbsp;&nbsp;&nbsp;basis.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </td>
            <td>
            <input type="file" id="aamList" name="aamList"/><img id="aamListImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $aamList . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="aamListButton" >Open File</button></a>
            <?php if($aamListStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $aamListDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamListDesc" name = "aamListDesc" />
            <?php } else { ?>
                <input style="background-color:#FFFFE0;" value="<?= $aamListDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamListDesc" name = "aamListDesc" />
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($aamList, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files2', 'aamList');
                $sql2 = "SELECT * FROM bspassets WHERE `id` >= 2 AND `aamList` IS NOT NULL AND `aamList` != '' GROUP BY id";
                $result2 = $con->query($sql2);

                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        // $List = $row2['ammList'] + "#toolbar=0";
                        $user = $row2['userid'];
                        echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row2['aamList']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['aamList'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['aamList'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-assetsdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                        echo '<input type="hidden" name="form_submit" value="2">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['aamListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamListDesc" style="margin-top: -1.5rem;"/>';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['aamListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamListDesc" style="margin-top: -1.5rem;"/>'; 
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
               3. Assests acquired in settlement of loans as of 31 March 2024 (Please provide <br>&nbsp;&nbsp;&nbsp;copies of loan subsidiary ledgers prior to booking to ROPA).
               <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </td>
            <td>
            <input type="file" id="aamAssests" name="aamAssests"/><img id="aamAssestsImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $aamAssests . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="aamAssestsButton" >Open File</button></a>
            <?php if($aamAssetsStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $aamAssestsDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamAssestsDesc" name = "aamAssestsDesc" />
            <?php } else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $aamAssestsDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamAssestsDesc" name = "aamAssestsDesc" />
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($aamAssests, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files3', 'aamAssests');
                $sql3 = "SELECT * FROM bspassets WHERE `id` >= 2 AND `aamAssests` IS NOT NULL AND `aamAssests` != '' GROUP BY id";
                $result3 = $con->query($sql3);
                            
                if ($result3->num_rows > 0) {
                    while ($row3 = $result3->fetch_assoc()) {
                        $user = $row3['userid'];
                        echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row3['aamAssests']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['aamAssests'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['aamAssests'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-assetsdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                        echo '<input type="hidden" name="form_submit" value="3">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['aamAssestsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamAssestsDesc" style="margin-top: -1.5rem;"/>';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['aamAssestsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamAssestsDesc" style="margin-top: -1.5rem;"/>';  
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
              4. Sales contract receivable as of 31 March 2024 (Please provide copies of subsidiary <br>&nbsp;&nbsp;&nbsp;ledgers).
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </td>
            <td>
            <input type="file" id="aamSales" name="aamSales"/><img id="aamSalesImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $aamSales . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="aamSalesButton" >Open File</button></a>
            <?php if($aamSalesStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $aamSalesDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamSalesDesc" name = "aamSalesDesc" />
            <?php }else { ?>
                <input style="background-color:#FFFFE0;"  value="<?= $aamSalesDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamSalesDesc" name = "aamSalesDesc" />
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($aamSales, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files4', 'aamSales');
                $sql4 = "SELECT * FROM bspassets WHERE `id` >= 2 AND `aamSales` IS NOT NULL AND `aamSales` != '' GROUP BY id";
                $result4 = $con->query($sql4);
                            
                if ($result4->num_rows > 0) {
                    while ($row4 = $result4->fetch_assoc()) {
                        $user = $row4['userid'];
                        echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row4['aamSales']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['aamSales'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['aamSales'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-assetsdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                        echo '<input type="hidden" name="form_submit" value="4">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['aamSalesDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamSalesDesc" style="margin-top: -1.5rem;"/>';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['aamSalesDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamSalesDesc" style="margin-top: -1.5rem;"/>';
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
             5. Schedule of ROPA sold from 01 January 2022 to latest available
              (Indicate previous ROPA <br>&nbsp;&nbsp;&nbsp;account name, name of buyer, date sold, selling price and gain/loss on sale).
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </td>
            <td>
            <input type="file" id="aamSched" name="aamSched"/><img id="aamSchedImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $aamSched . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="aamSchedButton" >Open File</button></a>
            <?php if($aamSchedStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $aamSchedDesc; ?>" type="text" class="form-control remarks2" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamSchedDesc" name = "aamSchedDesc" />
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $aamSchedDesc; ?>" type="text" class="form-control remarks2" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamSchedDesc" name = "aamSchedDesc" />
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($aamSched, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files5', 'aamSched');
                $sql5 = "SELECT * FROM bspassets  WHERE `id` >= 2 AND `aamSched` IS NOT NULL AND `aamSched` != '' GROUP BY id";
                $result5 = $con->query($sql5);
                            
                if ($result5->num_rows > 0) {
                    while ($row5 = $result5->fetch_assoc()) {
                        $user = $row5['userid'];
                        echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row5['aamSched']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['aamSched'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['aamSched'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-assetsdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                        echo '<input type="hidden" name="form_submit" value="5">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row5['aamSchedDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamSchedDesc" style="margin-top: -1.5rem;"/>';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['aamSchedDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamSchedDesc" style="margin-top: -1.5rem;"/>';    
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
             6. Schedule of paid SCR - from 01 January 2022 to lates available 
              (Indicate previous ROPA <br>&nbsp;&nbsp;&nbsp;account name, name of buyer, date sold, selling price and gain/loss on sale).
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </td>
            <td>
            <input type="file" id="aamSched2" name="aamSched2"/><img id="aamSched2Image" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $aamSched2 . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="aamSched2Button" >Open File</button></a>
            <?php if($aamSched2Stats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $aamSched2Desc; ?>" type="text" class="form-control remarks2" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamSched2Desc" name = "aamSched2Desc" />
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $aamSched2Desc; ?>" type="text" class="form-control remarks2" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="aamSched2Desc" name = "aamSched2Desc" />
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($aamSched2, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files6', 'aamSched2');
                $sql6 = "SELECT * FROM bspassets  WHERE `id` >= 2 AND `aamSched2` IS NOT NULL AND `aamSched2` != '' GROUP BY id";
                $result6 = $con->query($sql6);
                            
                if ($result6->num_rows > 0) {
                    while ($row6 = $result6->fetch_assoc()) {
                        $user = $row5['userid'];
                        echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row6['aamSched2']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row6['aamSched2'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row6['aamSched2'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-assetsdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row6['id'] . '">';
                        echo '<input type="hidden" name="form_submit" value="6">'; 
                        if ($user >=92 & $user <= 96){
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row6['aamSched2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamSched2Desc" style="margin-top: -1.5rem;"/>';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row6['aamSched2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="aamSched2Desc" style="margin-top: -1.5rem;"/>';       
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
        </tbody>
    </table>
</div>
</form>
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

var AAMForm = document.getElementById("AAM-Form");

function uploadFileI() {
var AAMFormData = new FormData(AAMForm);
$.ajax({
    url: 'bsp-assets-UploadData.php', 
    type: 'POST',
    data: AAMFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
// AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
// FOR LOAN APPLICATION:
console.log(response);
updateFileStatus('aamManual', 'aamManualImage');
updateFileStatus('aamList', 'aamListImage');
updateFileStatus('aamAssests', 'aamAssestsImage');
updateFileStatus('aamSales', 'aamSalesImage');
updateFileStatus('aamSched', 'aamSchedImage');
updateFileStatus('aamSched2', 'aamSched2Image');
// location.reload();
},
    error: function(xhr, status, error) {
    console.log('File upload failed');
    }
});
}
//var marketForm = document.getElementById("Market-Form");
AAMForm.addEventListener("change", function() {
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
setFileVisibility("<?php echo $aamManual; ?>", "<?php echo $aamManualDesc; ?>", 'aamManual', 'aamManualImage', "aamManualButton");
setFileVisibility("<?php echo $aamList; ?>", "<?php echo $aamListDesc; ?>", 'aamList', 'aamListImage', "aamListButton");
setFileVisibility("<?php echo $aamAssests; ?>", "<?php echo $aamAssestsDesc; ?>", 'aamAssests', 'aamAssestsImage', "aamAssestsButton");
setFileVisibility("<?php echo $aamSales; ?>", "<?php echo $aamSalesDesc; ?>", 'aamSales', 'aamSalesImage', "aamSalesButton");
setFileVisibility("<?php echo $aamSched; ?>", "<?php echo $aamSchedDesc; ?>", 'aamSched', 'aamSchedImage', "aamSchedButton");
setFileVisibility("<?php echo $aamSched2; ?>", "<?php echo $aamSched2Desc; ?>", 'aamSched2', 'aamSched2Image', "aamSched2Button");
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
showText('aamManualDesc','21%');
showText('aamListDesc','21%');
showText('aamAssestsDesc','21%');
showText('aamSalesDesc','25%');
showText('aamSchedDesc','70%');
showText('aamSched2Desc','70%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("AAM-Form").submit();
});
</script>

<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("AAM-Form").submit();
});
</script>

<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("AAM-Form").submit();
});
</script>

<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("AAM-Form").submit();
});
</script>

<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("AAM-Form").submit();
});
</script>

<script>
document.getElementById("fileInput6").addEventListener("change", function() {
document.getElementById("AAM-Form").submit();
});
</script>
<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }
    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

$('#aamManualDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-assetsstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'aamManualDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});


$('#aamListDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-assetsstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'aamListDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#aamAssestsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-assetsstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'aamAssestsDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#aamSalesDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-assetsstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'aamSalesDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#aamSchedDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-assetsstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'aamSchedDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#aamSched2Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-assetsstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'aamSched2Desc'}, 
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