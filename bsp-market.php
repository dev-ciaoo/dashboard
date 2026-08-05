<?php
include('connection.php');
include('fileUploadBSP.php');

$selectMarket = "SELECT * FROM `bspmarket` WHERE id = 1";
$data = mysqli_query($con, $selectMarket) ;
if (!$data) {
    echo("Error description: " . mysqli_error($con));
}else{
    while ($row = mysqli_fetch_array($data)) {
        $mrkManuals = $row['mrkManuals'];
        $mrkList = $row['mrkList'];
        $mrkMemo = $row['mrkMemo'];
        $mrkDetails = $row['mrkDetails'];
        $mrkRun = $row['mrkRun'];
        $mrkSchedule = $row['mrkSchedule'];
        $mrkBreakdown = $row['mrkBreakdown'];

        $markManualsSelect = $row['mrkManualsDesc'];
        $mrkListSelect = $row['mrkListDesc'];
        $mrkMemoSelect = $row['mrkMemoDesc'];
        $mrkDetailsSelect = $row['mrkDetailsDesc'];
        $mrkRunSelect = $row['mrkRunDesc'];
        $mrkScheduleSelect = $row['mrkScheduleDesc'];
        $mrkBreakdownSelect = $row['mrkBreakdownDesc'];

        $mrkManualsStats = $row['mrkManualsStats'];
        $mrkListStats = $row['mrkListStats'];
        $mrkMemoStats = $row['mrkMemoStats'];
        $mrkDetailsStats = $row['mrkDetailsStats'];
        $mrkRunStats = $row['mrkRunStats'];
        $mrkScheduleStats = $row['mrkScheduleStats'];
        $mrkBreakdownStats = $row['mrkBreakdownStats'];
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
        $uploadDir = "bspmarket/";
    
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
                $sql = "INSERT INTO bspmarket ($tableColumn) VALUES ('$targetFile')";
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
        position: fixed;
        margin-left: 46px;
    }
</style>
<body oncontextmenu="return false;"> 
<button class="btn btn-secondary btn-md btnBack">Back</button>  
<div class = "d-flex flex-column align-items-center  justify-content-center">
    <h3>MARKET AND LIQUIDITY RISK</h3>
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
<form action="" method="POST" enctype="multipart/form-data" id="Market-Form">
<table class="table border">
    <tbody>
    <tr>
        <td class="col-sm-7">
            1.Manuals, policies and procedures relative to market and liquidity risk.
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
        </td>
        <td>
            <input type="file" id="mrkManuals" name="mrkManuals"/><img id="mrkManualsImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $mrkManuals . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mrkManualsButton" >Open File</button></a>
            <?php if($mrkManualsStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $markManualsSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkManualsDesc" name = "mrkManualsDesc" />
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $markManualsSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkManualsDesc" name = "mrkManualsDesc" />
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($mrkManuals, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files', 'mrkManuals');
                $sql1 = "SELECT * FROM bspmarket WHERE `id` >= 2 AND `mrkManuals` IS NOT NULL AND `mrkManuals` != '' GROUP BY id";
                $result1= $con->query($sql1);
                        
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $user = $row1['userid'];
                        echo '<img id="mrkManualsImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row1['mrkManuals']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row1['mrkManuals'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row1['mrkManuals'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-marketdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row1['id'] . '">';
                        echo '<input type="hidden" name="form_submit" value="1">'; 
                        if ($user >=92 & $user <= 96){
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row1['mrkManualsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkManualsDesc1" style="margin-top: -1.5rem;">';
                        }else{
                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row1['mrkManualsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkManualsDesc1" style="margin-top: -1.5rem;">';
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
            2.List of Management reports on market and liquidity risks, indicating the frequency and<br>&nbsp;&nbsp;&nbsp;the recipients thereof.
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
        </td>
        <td>
            <input type="file" id="mrkList" name="mrkList"/><img id="mrkListImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $mrkList . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mrkListButton" >Open File</button></a>
            <?php if($mrkListStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $mrkListSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkListDesc" name = "mrkListDesc" >
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $mrkListSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkListDesc" name = "mrkListDesc" >
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($mrkList, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files2', 'mrkList');
                $sql2 = "SELECT * FROM bspmarket WHERE `id` >= 2 AND `mrkList` IS NOT NULL AND `mrkList` != '' GROUP BY id";
                $result2= $con->query($sql2);
                        
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $user = $row2['userid'];
                        echo '<img id="mrkListImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row2['mrkList']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['mrkList'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['mrkList'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-marketdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                        // echo $row2['id'];
                        echo '<input type="hidden" name="form_submit" value="2">'; 
                        if ($user >=92 & $user <= 96){
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['mrkListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkListDesc1" style="margin-top: -1.5rem;">';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['mrkListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkListDesc1" style="margin-top: -1.5rem;">';    
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
        3. Memo/Policy on setting interest rates for Deposits (Savings, Demand, Time Deposits)<br>&nbsp;&nbsp;&nbsp;and Loans;
        <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
        </td>
        <td>
            <input type="file" id="mrkMemo" name="mrkMemo"/><img id="mrkMemoImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $mrkMemo . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mrkMemoButton" >Open File</button></a>
            <?php if($mrkMemoStats == 1){ ?>
            <input style="background-color:#ADD8E6;" value="<?= $mrkMemoSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkMemoDesc" name = "mrkMemoDesc" >
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $mrkMemoSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkMemoDesc" name = "mrkMemoDesc" >
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($mrkMemo, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files3', 'mrkMemo');
                $sql3 = "SELECT * FROM bspmarket WHERE `id` >= 2 AND `mrkMemo` IS NOT NULL AND `mrkMemo` != '' GROUP BY id";
                $result3= $con->query($sql3);
                        
                if ($result3->num_rows > 0) {
                    while ($row3 = $result3->fetch_assoc()) {
                        $user = $row3['userid'];
                        echo '<img id="mrkMemoImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row3['mrkMemo']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['mrkMemo'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['mrkMemo'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-marketdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                        // echo $row3['id'];
                        echo '<input type="hidden" name="form_submit" value="3">';
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['mrkMemoDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkMemoDesc1" style="margin-top: -1.5rem;">';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['mrkMemoDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkMemoDesc1" style="margin-top: -1.5rem;">';  
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
        4. Details of Required and Available Reserves from 01 January 2022 to 31 March 2024.
        <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
        </td>
        <td>
            <input type="file" id="mrkDetails" name="mrkDetails"/><img id="mrkDetailsImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $mrkDetails . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mrkDetailsButton" >Open File</button></a>
            <?php if($mrkDetailsStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $mrkDetailsSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkDetailsDesc" name = "mrkDetailsDesc" >
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $mrkDetailsSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkDetailsDesc" name = "mrkDetailsDesc" >
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($mrkDetails, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files4', 'mrkDetails');
                $sql4 = "SELECT * FROM bspmarket WHERE `id` >= 2 AND `mrkDetails` IS NOT NULL AND `mrkDetails` != '' GROUP BY id";
                $result4= $con->query($sql4);
                        
                if ($result4->num_rows > 0) {
                    while ($row4 = $result4->fetch_assoc()) {
                        $user = $row4['userid'];
                        echo '<img id="mrkDetailsImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row4['mrkDetails']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['mrkDetails'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['mrkDetails'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-marketdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                        // echo $row3['id'];
                        echo '<input type="hidden" name="form_submit" value="4">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input  style="background-color:#ADD8E6;"  onchange="submitremarks(this)" value="' . $row4['mrkDetailsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkDetailsDesc1" style="margin-top: -1.5rem;">';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['mrkDetailsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkDetailsDesc1" style="margin-top: -1.5rem;">';   
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
        5. Run-up of deposits excluding the name of the depositor.
        <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
        </td>
        <td>
            <input type="file" id="mrkRun" name="mrkRun"/><img id="mrkRunImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $mrkRun . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mrkRunButton" >Open File</button></a>
            <?php if($mrkRunStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $mrkRunSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkRunDesc" name = "mrkRunDesc" >
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $mrkRunSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkRunDesc" name = "mrkRunDesc" >
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($mrkRun, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files5', 'mrkRun');
                $sql5 = "SELECT * FROM bspmarket WHERE `id` >= 2 AND `mrkRun` IS NOT NULL AND `mrkRun` != '' GROUP BY id";
                $result5= $con->query($sql5);
                        
                if ($result5->num_rows > 0) {
                    while ($row5 = $result5->fetch_assoc()) {
                        $user = $row5['userid'];
                        echo '<img id="mrkRunImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row5['mrkRun']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['mrkRun'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['mrkRun'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-marketdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                        // echo $row5['id'];
                        echo '<input type="hidden" name="form_submit" value="5">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row5['mrkRunDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkRunDesc1" style="margin-top: -1.5rem;">';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['mrkRunDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkRunDesc1" style="margin-top: -1.5rem;">';
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
        6. Schedule of deposit liabilities by size of account, interest rate and term.
        <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
        </td>
        <td>
            <input type="file" id="mrkSchedule" name="mrkSchedule"/><img id="mrkScheduleImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $mrkSchedule . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mrkScheduleButton" >Open File</button></a>
            <?php if($mrkScheduleStats == 1){ ?>
                <input style="background-color:#ADD8E6;"  value="<?= $mrkScheduleSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkScheduleDesc" name = "mrkScheduleDesc" >
            <?php } else{ ?> 
                <input style="background-color:#FFFFE0;" value="<?= $mrkScheduleSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkScheduleDesc" name = "mrkScheduleDesc" >
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($mrkSchedule, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files6', 'mrkSchedule');
                $sql6 = "SELECT * FROM bspmarket WHERE `id` >= 2 AND `mrkSchedule` IS NOT NULL AND `mrkSchedule` != '' GROUP BY id";
                $result6= $con->query($sql6);
                        
                if ($result6->num_rows > 0) {
                    while ($row6 = $result6->fetch_assoc()) {
                        $user = $row6['userid'];
                        echo '<img id="mrkScheduleImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row6['mrkSchedule']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row6['mrkSchedule'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row6['mrkSchedule'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-marketdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row6['id'] . '">';
                        // echo $row6['id'];
                        echo '<input type="hidden" name="form_submit" value="6">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row6['mrkScheduleDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkScheduleDesc1" style="margin-top: -1.5rem;">';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row6['mrkScheduleDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkScheduleDesc1" style="margin-top: -1.5rem;">';
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
        7. Breakdown of all interest-bearing assets and liabilities as to interest rate and maturity.
        <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Perlita S.  Nerona)</strong>
        </td>
        <td>
            <input type="file" id="mrkBreakdown" name="mrkBreakdown"/><img id="mrkBreakdownImage" src="statusImage/check.png" alt="statusImage">
            <a href="<?php echo $mrkBreakdown . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="mrkBreakdownButton" >Open File</button></a>
            <?php if($mrkBreakdownStats == 1){ ?>
                <input style="background-color:#ADD8E6;" value="<?= $mrkBreakdownSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkBreakdownDesc" name = "mrkBreakdownDesc" >
            <?php }else{ ?>
                <input style="background-color:#FFFFE0;" value="<?= $mrkBreakdownSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;REMARKS" id="mrkBreakdownDesc" name = "mrkBreakdownDesc" >
            <?php } ?>
            <br>
            <?php echo "<span id='tag'>" . extractFileName1($mrkBreakdown, 30) .  "</span>" ?>
            <?php
                uploadFiles($con, 'files7', 'mrkBreakdown');
                $sql7 = "SELECT * FROM bspmarket WHERE `id` >= 2 AND `mrkBreakdown` IS NOT NULL AND `mrkBreakdown` != '' GROUP BY id";
                $result7= $con->query($sql7);
                        
                if ($result7->num_rows > 0) {
                    while ($row7 = $result7->fetch_assoc()) {
                        $user = $row7['userid'];
                        echo '<img id="mrkBreakdownImage"  src="statusImage/check.png" alt="statusImage"><br>';
                        echo "<a href='" . ($row7['mrkBreakdown']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row7['mrkBreakdown'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row7['mrkBreakdown'], 20) . " </button></a><br>";
                        echo '<form class="formremarks" name="form_submit" action="bsp-marketdesc.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row7['id'] . '">';
                        // echo $row6['id'];
                        echo '<input type="hidden" name="form_submit" value="7">'; 
                        if ($user >=92 & $user <= 96){ 
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row7['mrkBreakdownDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkBreakdownDesc1" style="margin-top: -1.5rem;">';
                        }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row7['mrkBreakdownDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="mrkBreakdownDesc1" style="margin-top: -1.5rem;">';    
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

<script>
    $(document).ready(function() {
    $(".btnBack").click(function() {
        // Change the URL to the desired page
        window.location.href = "bsp.php";
    });
});
</script>

<script>

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

var marketForm = document.getElementById("Market-Form");

function uploadFileI() {
var MarketFormData = new FormData(marketForm);
$.ajax({
    url: 'bsp-market-upload.php', 
    type: 'POST',
    data: MarketFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
// AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
// FOR LOAN APPLICATION:
console.log(response);
updateFileStatus('mrkManuals', 'mrkManualsImage');
updateFileStatus('mrkList', 'mrkListImage');
updateFileStatus('mrkMemo', 'mrkMemoImage');
updateFileStatus('mrkDetails', 'mrkDetailsImage');
updateFileStatus('mrkRun', 'mrkRunImage');
updateFileStatus('mrkSchedule', 'mrkScheduleImage');
updateFileStatus('mrkBreakdown', 'mrkBreakdownImage');
// location.reload();
},
    error: function(xhr, status, error) {
    console.log('File upload failed');
    }
});
}
//var marketForm = document.getElementById("Market-Form");
marketForm.addEventListener("change", function() {
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
setFileVisibility("<?php echo $mrkManuals; ?>", "<?php echo $markManualsSelect; ?>", 'mrkManuals', 'mrkManualsImage', "mrkManualsButton");
setFileVisibility("<?php echo $mrkList; ?>", "<?php echo $mrkListSelect; ?>", 'mrkList', 'mrkListImage', "mrkListButton");
setFileVisibility("<?php echo $mrkMemo; ?>", "<?php echo $mrkMemoSelect; ?>", 'mrkMemo', 'mrkMemoImage', "mrkMemoButton");
setFileVisibility("<?php echo $mrkDetails; ?>", "<?php echo $mrkDetailsSelect; ?>", 'mrkDetails', 'mrkDetailsImage', "mrkDetailsButton");
setFileVisibility("<?php echo $mrkRun; ?>", "<?php echo $mrkRunSelect; ?>", 'mrkRun', 'mrkRunImage', "mrkRunButton");
setFileVisibility("<?php echo $mrkSchedule; ?>", "<?php echo $mrkScheduleSelect; ?>", 'mrkSchedule', 'mrkScheduleImage', "mrkScheduleButton");
setFileVisibility("<?php echo $mrkBreakdown; ?>", "<?php echo $mrkBreakdownSelect; ?>", 'mrkBreakdown', 'mrkBreakdownImage', "mrkBreakdownButton");
</script>

<script>
function showText(target,position){
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
showText('mrkManualsDesc','21%');
showText('mrkManualsDesc1','21%');
showText('mrkListDesc','21%');
showText('mrkMemoDesc','21%');
showText('mrkDetailsDesc','21%');
showText('mrkRunDesc','21%');
showText('mrkScheduleDesc','21%');
showText('mrkBreakdownDesc','21%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Market-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Market-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("Market-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("Market-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("Market-Form").submit();
});
</script>
<script>
document.getElementById("fileInput6").addEventListener("change", function() {
document.getElementById("Market-Form").submit();
});
</script>
<script>
document.getElementById("fileInput7").addEventListener("change", function() {
document.getElementById("Market-Form").submit();
});
</script>


<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

$('#mrkManualsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-marketstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'mrkManualsDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#mrkListDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-marketstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'mrkListDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#mrkMemoDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-marketstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'mrkMemoDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#mrkDetailsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-marketstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'mrkDetailsDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#mrkRunDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-marketstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'mrkRunDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});


$('#mrkScheduleDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-marketstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'mrkScheduleDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#mrkBreakdownDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-marketstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'mrkBreakdownDesc'}, 
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