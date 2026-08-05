<?php
include('connection.php');
include('fileUploadBSP.php');

$selectIT = "SELECT * FROM `bspsub` WHERE id = 1";
$data = mysqli_query($con, $selectIT) ;
    if (!$data) {
        echo("Error description: " . mysqli_error($con));
    }else{
        while ($row = mysqli_fetch_array($data)) {
            $subFin = $row['subFin'];
            $subLedg = $row['subLedg'];
            $subDue = $row['subDue'];
            $subInv = $row['subInv'];
            $subAcc = $row['subAcc'];

            $subBank = $row['subBank'];
            $subInc = $row['subInc'];
            $subRec = $row['subRec'];
            $subChange = $row['subChange'];
            $subList = $row['subList'];
            $subArt = $row['subArt'];
            $subAudit = $row['subAudit'];

            $subFinSelect = $row['subFinDesc'];
            $subLedgSelect = $row['subLedgDesc'];
            $subDueSelect = $row['subDueDesc'];
            $subInvSelect = $row['subInvDesc'];
            $subAccSelect = $row['subAccDesc'];

            $subBankSelect = $row['subBankDesc'];
            $subIncSelect = $row['subIncDesc'];
            $subRecSelect = $row['subRecDesc'];
            $subChangeSelect = $row['subChangeDesc'];
            $subListSelect = $row['subListDesc'];
            $subArtSelect = $row['subArtDesc'];
            $subAuditSelect = $row['subAuditDesc'];

            $subFin2 = $row['subFin2'];

            $subFinStats = $row['subFinStats'];
            $subLedgStats = $row['subLedgStats'];
            $subDueStats = $row['subDueStats'];
            $subInvStats = $row['subInvStats'];
            $subAccStats = $row['subAccStats'];
            $subBankStats = $row['subBankStats'];
            $subIncStats = $row['subIncStats'];
            $subRecStats = $row['subRecStats'];
            $subChangeStats = $row['subChangeStats'];
            $subListStats = $row['subListStats'];
            $subArtStats = $row['subArtStats'];
            $subAuditStats = $row['subAuditStats'];
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
        $parts = explode('_', $filePath);
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
        $uploadDir = "bspsub/";
    
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
                $sql = "INSERT INTO bspsub ($tableColumn) VALUES ('$targetFile')";
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
  <link rel="stylesheet" href="css/styleloan.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

</head>
<style>
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

    h3{
      font-family: "Source Sans Pro", sans-serif;
      color: #656565;
      margin: 30px 0 20px;
    }
</style>
<body oncontextmenu="return false;"> 
<button class="btn btn-secondary btn-md btnBack">Back</button> 
<div class = "d-flex flex-column align-items-center justify-content-center">
    <h3>FOR SUBMISSION</h3>
</div><br><br>
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
    <div class="modal-content" style="height: 50%;">
        <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
        <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
    </div>
</div>

<div class= "container">
    <form method="post" enctype="multipart/form-data" id="Sub-Form">
        <table class="table border">
            <tbody>
                <tr>
                    <td class="col-sm-7">
                        1. General Financial Report and Details of Accounts for submission <br>&nbsp;&nbsp;&nbsp;
                            (certified digital copy and excel copy).<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
                    </td>
                    <td class="col-sm-5">
                        <input type="file" id="subFin" name="subFin"/>
                        <img id="subFinImage"  src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $subFin . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subFinButton" >Open File</button></a>
                        <?php if($subFinStats == 1){ ?>
                            <input style="background-color:#ADD8E6;"  type="text" class="form-control custom-input" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subFinDesc" name = "subFinDesc" value="<?= $subFinSelect; ?>" >
                        <?php } else { ?> 
                            <input  style="background-color:#FFFFE0;"  type="text" class="form-control custom-input" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subFinDesc" name = "subFinDesc" value="<?= $subFinSelect; ?>" >
                        <?php } ?>
                        <input type="hidden" class="form-control" placeholder="REMARKS" id="subFinSelect" name="subFinSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($subFin, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files', 'subFin');
                            $sql = "SELECT * FROM bspsub WHERE id >= 2 AND subFin != '' AND subFin IS NOT NULL GROUP BY id ";
                            $result = $con->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $user = $row['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row['subFin']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['subFin'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['subFin'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="1">'; 
                                    if ($user >=92 & $user <= 96){  
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['subFinDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subFinDesc" />';
                                    }else{
                                    echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['subFinDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subFinDesc" />';    
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
                        2. General ledger trial balances as of 31 December 2023, 31 December 2022, <br>&nbsp;&nbsp;&nbsp;31 December 2021 and 31 March 2024.<br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
                    </td>
                    <td>
                        <input type="file" id="subLedg" name="subLedg"/><img id="subLedgImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $subLedg . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subLedgButton" >Open File</button></a>
                        <?php if($subLedgStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subLedgDesc" name = "subLedgDesc" value="<?= $subLedgSelect; ?>">
                        <?php } else { ?> 
                            <input style="background-color:#FFFFE0;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subLedgDesc" name = "subLedgDesc" value="<?= $subLedgSelect; ?>">
                        <?php } ?>
                        <input type="hidden" class="form-control" placeholder="REMARKS" id="subLedgSelect" name="subLedgSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($subLedg, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files2', 'subLedg');
                            $sql2 = "SELECT * FROM bspsub WHERE id >= 2 AND subLedg != '' AND subLedg IS NOT NULL GROUP BY id ";
                            $result2 = $con->query($sql2);
                            
                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    $user = $row2['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row2['subLedg']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['subLedg'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['subLedg'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="2">'; 
                                    if ($user >=92 & $user <= 96){  
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['subLedgDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subLedgDesc" />';
                                    }else{
                                    echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['subLedgDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subLedgDesc" />';         
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
                    3. Schedule of Due from BSP and Due from Other Banks.
                    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
                    </td>
                    <td>
                        <input type="file" id="subDue" name="subDue"/><img id="subDueImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $subDue . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subDueButton" >Open File</button></a>
                        <?php if($subDueStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subDueDesc" name = "subDueDesc" value="<?= $subDueSelect; ?>">
                        <?php } else { ?> 
                            <input style="background-color:#FFFFE0;"  type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subDueDesc" name = "subDueDesc" value="<?= $subDueSelect; ?>">
                        <?php } ?>
                        <input type="hidden" class="form-control" placeholder="REMARKS" id="subDueSelect" name="subDueSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($subDue, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files3', 'subDue');
                            $sql3 = "SELECT * FROM bspsub WHERE id >= 2 AND subDue != '' AND subDue IS NOT NULL GROUP BY id ";
                            $result3 = $con->query($sql3);
                            
                            if ($result2->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    $user = $row3['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row3['subDue']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['subDue'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['subDue'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="3">'; 
                                    if ($user >=92 & $user <= 96){  
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['subDueDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subDueDesc" />';
                                    }else{
                                    echo '<input style="background-color:#FFFFE0;"  onchange="submitremarks(this)" value="' . $row3['subDueDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subDueDesc" />';    
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
                    </td>
                </tr>
                <tr>
                    <td>
                    4. Schedule of Investments in Securities/Other Inventments with supporting <br>&nbsp;&nbsp;&nbsp;documents.
                    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
                    </td>
                    <td>
                        <input type="file" id="subInv" name="subInv"/><img id="subInvImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $subInv . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subInvButton" >Open File</button></a>
                        <?php if($subInvStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subInvDesc" name = "subInvDesc" value="<?= $subInvSelect; ?>">
                        <?php } else { ?>
                            <input style="background-color:#FFFFE0;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subInvDesc" name = "subInvDesc" value="<?= $subInvSelect; ?>">
                        <?php  } ?>
                        <input type="hidden" class="form-control" placeholder="REMARKS" id="subInvSelect" name="subInvSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($subInv, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files4', 'subInv');
                            $sql4 = "SELECT * FROM bspsub WHERE id >= 2 AND subInv != '' AND subInv IS NOT NULL GROUP BY id ";
                            $result4 = $con->query($sql4);
                            
                            if ($result4->num_rows > 0) {
                                while ($row4 = $result4->fetch_assoc()) {
                                    $user = $row4['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row4['subInv']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['subInv'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['subInv'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="4">'; 
                                    if ($user >=92 & $user <= 96){  
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['subInvDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subInvDesc" />';
                                    }else{
                                    echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['subInvDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subInvDesc" />';    
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
                    5. Schedules of the following accounts (breakdown of details: date booked, <br>&nbsp;&nbsp;&nbsp;
                       nature, counterpart and amount) and supply againg report as of 31 March 2024,<br>&nbsp;&nbsp;&nbsp;
                        as applicable: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       a. Accrued Interest Recevable.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       b. Other Assets/Accounts Receivable/Miscellaneous Assets.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       c. Accrued Interest Expense on Financial Liabilities.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       d. Accrued Expenses.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       e. Other Liabilities.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       f. Contingent Accounts, if any.
                       <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
                    </td>
                    <td>
                        <input type="file" id="subAcc" name="subAcc"/><img id="subAccImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $subAcc . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subAccButton" >Open File</button></a>
                        <?php if($subAccStats == 1){ ?>
                            <input  style="background-color:#ADD8E6;"  type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subAccDesc" name = "subAccDesc" value="<?= $subAccSelect; ?>">
                        <?php } else { ?> 
                            <input  style="background-color:#FFFFE0;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="subAccDesc" name = "subAccDesc" value="<?= $subAccSelect; ?>">
                        <?php } ?>
                        <input type="hidden" class="form-control" placeholder="REMARKS" id="subAccSelect" name="subAccSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($subAcc, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files5', 'subAcc');
                            $sql5 = "SELECT * FROM bspsub WHERE id >= 2 AND subAcc != '' AND subAcc IS NOT NULL GROUP BY id ";
                            $result5 = $con->query($sql5);
                            
                            if ($result5->num_rows > 0) {
                                while ($row5 = $result5->fetch_assoc()) {
                                    $user = $row5['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row5['subAcc']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['subAcc'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['subAcc'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="5">'; 
                                    if ($user >=92 & $user <= 96){  
                                    echo '<input style="background-color:#ADD8E6;"  onchange="submitremarks(this)" value="' . $row5['subAccDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subAccDesc" />';
                                    }else{
                                    echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['subAccDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subAccDesc" />';     
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
                6. Schedule of Bank premises, furniture, fixture and equipment with copies <br>&nbsp;&nbsp;&nbsp;
                of proof of ownership e.g TCT, OR/CR, etc.
                <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
            </td>
            <td>
                <input type="file" id="subBank" name="subBank"/><img id="subBankImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $subBank . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subBankButton" >Open File</button></a>
                <?php if($subBankStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $subBankSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subBankDesc" name = "subBankDesc" />
                <?php } else { ?>
                    <input  style="background-color:#FFFFE0;" value="<?= $subBankSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subBankDesc" name = "subBankDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($subBank, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files6', 'subBank');
                    $sql6 = "SELECT * FROM bspsub WHERE id >= 2 AND subBank != '' AND subBank IS NOT NULL GROUP BY id ";
                    $result6 = $con->query($sql6);
                            
                    if ($result6->num_rows > 0) {
                        while ($row6 = $result6->fetch_assoc()) {
                                    $user = $row6['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row6['subBank']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row6['subBank'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row6['subBank'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row6['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="6">'; 
                                    if ($user >=92 & $user <= 96){ 
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row6['subBankDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subBankDesc" />';
                                    }else{
                                    echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row6['subBankDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subBankDesc" />';  
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
               7. Schedule of the following Income and Expense ACcounts for the period<br>&nbsp;&nbsp;&nbsp;
               ended 31 March 2024, and immediately preceding 3 year-ends,<br>&nbsp;&nbsp;&nbsp;
               as applicable:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    a. Fees and Commissions Income.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    b. Details of Other Income.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    c. Gain(Loss) from sale/redemption/derecognition of non-trading <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        assets and liabilities.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    d. Gain(Loss) from sale/derecognition of non-financial assets.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    e. Compensation/Fringe Benefits.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    f. Other Administrative Expenses.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    g. Impairment Loss, if any.
                    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
            </td>
            <td>
                <input type="file" id="subInc" name="subInc"/><img id="subIncImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $subInc . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subIncButton" >Open File</button></a>
                <?php if($subIncStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $subIncSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subIncDesc" name = "subIncDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;"  value="<?= $subIncSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subIncDesc" name = "subIncDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($subInc, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files7', 'subInc');
                    $sql7 = "SELECT * FROM bspsub WHERE id >= 2 AND subInc != '' AND subInc IS NOT NULL GROUP BY id ";
                    $result7 = $con->query($sql7);
                            
                    if ($result7->num_rows > 0) {
                        while ($row7 = $result7->fetch_assoc()) {
                            $user = $row7['userid'];
                            echo "<a href='" . ($row7['subInc']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row7['subInc'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row7['subInc'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row7['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="7">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row7['subIncDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subIncDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row7['subIncDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subIncDesc" />';    
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
               8. Reconciliation statements of:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    a. Due from local banks with supporting bank statements; and<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    b. Due from BSP with supporting BSP Statements.
                    <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
            </td>
            <td>
                <input type="file" id="subRec" name="subRec"/><img id="subRecImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $subRec . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subRecButton" >Open File</button></a>
                <?php if($subRecStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $subRecSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subRecDesc" name = "subRecDesc" />
                <?php } else { ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $subRecSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subRecDesc" name = "subRecDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($subRec, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files8', 'subRec');
                    $sql8 = "SELECT * FROM bspsub WHERE id >= 2 AND subRec != '' AND subRec IS NOT NULL GROUP BY id ";
                    $result8= $con->query($sql8);
                            
                    if ($result8->num_rows > 0) {
                        while ($row8 = $result8->fetch_assoc()) {
                            $user = $row8['userid'];
                            echo "<a href='" . ($row8['subRec']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row8['subRec'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row8['subRec'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row8['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="8">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;"  onchange="submitremarks(this)" value="' . $row8['subRecDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subRecDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row8['subRecDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subRecDesc" />';   
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
               9. Statement of Changes in Retained Earnings from 01 January 2022 <br>&nbsp;&nbsp;&nbsp;to latest available. 
               <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
            </td>
            <td>
                <input type="file" id="subChange" name="subChange"/><img id="subChangeImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $subChange . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subChangeButton" >Open File</button></a>
                <?php if($subChangeStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $subChangeSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subChangeDesc" name = "subChangeDesc" />
                <?php } else { ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $subChangeSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subChangeDesc" name = "subChangeDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($subChange, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files9', 'subChange');
                            
                    $sql9 = "SELECT * FROM bspsub WHERE id >= 2 AND subChange != '' AND subChange IS NOT NULL GROUP BY id ";
                    $result9= $con->query($sql9);
                            
                    if ($result9->num_rows > 0) {
                        while ($row9 = $result9->fetch_assoc()) {
                            $user = $row9['userid'];
                            echo "<a href='" . ($row9['subChange']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row9['subChange'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row9['subChange'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row9['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="9">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row9['subChangeDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subChangeDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row9['subChangeDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subChangeDesc" />';    
                            }
                            echo '</form><br>';
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
               10. Comparative List of Stockholding(01 January 2022 and 31 December 2023).
               <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
            </td>
            <td>
                <input type="file" id="subList" name="subList"/><img id="subListImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $subList . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subListButton" >Open File</button></a>
                <?php if($subListStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $subListSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subListDesc" name = "subListDesc" />
                <?php } else { ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $subListSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subListDesc" name = "subListDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($subList, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files10', 'subList');
                    $sql10 = "SELECT * FROM bspsub WHERE id >= 2 AND subList != '' AND subList IS NOT NULL GROUP BY id ";
                    $result10= $con->query($sql10);
                            
                    if ($result10->num_rows > 0) {
                        while ($row10 = $result10->fetch_assoc()) {
                            $user = $row10['userid'];
                            echo "<a href='" . ($row10['subList']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row10['subList'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row10['subList'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row10['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="10">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row10['subListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subListDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row10['subListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subListDesc" />';      
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
              11. Articles of Incorporation and By-Laws, including documents regarding <br>&nbsp;&nbsp;&nbsp;amendments, if any.
              <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
            </td>
            <td>
                <input type="file" id="subArt" name="subArt"/><img id="subArtImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $subArt . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subArtButton" >Open File</button></a>
                <?php if($subArtStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $subArtSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subArtDesc" name = "subArtDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $subArtSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subArtDesc" name = "subArtDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($subArt, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files11', 'subArt');
                    $sql11 = "SELECT  * FROM bspsub WHERE id >= 2 AND subArt != '' AND subArt IS NOT NULL GROUP BY id ";
                    $result11= $con->query($sql11);
                            
                    if ($result11->num_rows > 0) {
                        while ($row11 = $result11->fetch_assoc()) {
                            $user = $row11['userid'];
                            echo "<a href='" . ($row11['subArt']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row11['subArt'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row11['subArt'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row11['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="11">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row11['subArtDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subArtDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row11['subArtDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subArtDesc" />';    
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
              12. Latest Audited Financial Statements including management letter/letter<br>&nbsp;&nbsp;&nbsp;
              if comments, if any, and reconciliation of audited financila statements with<br>&nbsp;&nbsp;&nbsp;
              consolidated statement of condition/consolidated income and expense/financial<br>&nbsp;&nbsp;&nbsp;
              reporting package and adjusting entries recommended by external auditor.
              <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: May Felina Reyes)</strong>
            </td>
            <td>
                <input type="file" id="subAudit" name="subAudit"/><img id="subAuditImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $subAudit . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="subAuditButton" >Open File</button></a>
                <?php if($subAuditStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $subAuditSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subAuditDesc" name = "subAuditDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $subAuditSelect; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="subAuditDesc" name = "subAuditDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($subAudit, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files12', 'subAudit');
                    $sql12 = "SELECT * FROM bspsub WHERE id >= 2 AND subAudit != '' AND subAudit IS NOT NULL GROUP BY id ";
                    $result12= $con->query($sql12);
                            
                    if ($result12->num_rows > 0) {
                        while ($row12 = $result12->fetch_assoc()) {
                            $user = $row12['userid'];
                            echo "<br><a href='" . ($row12['subAudit']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row12['subAudit'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row12['subAudit'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-subdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row12['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="12">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row12['subAuditDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subAuditDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row12['subAuditDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="subAuditDesc" />';  
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
            </tbody>
        </table>
    </form>
</div>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
var itForm = document.getElementById("Sub-Form");

function uploadFileI() {
  var ITFormData = new FormData(itForm);
  $.ajax({
    url: 'bsp-sub-UploadData.php', 
    type: 'POST',
    data: ITFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
      // AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
      updateFileStatus('subFin', 'subFinImage');
      updateFileStatus('subLedg', 'subLedgImage');
      updateFileStatus('subDue', 'subDueImage');
      updateFileStatus('subInv', 'subInvImage');
      updateFileStatus('subAcc', 'subAccImage');

      updateFileStatus('subBank', 'subBankImage');
      updateFileStatus('subInc', 'subIncImage');
      updateFileStatus('subRec', 'subRecImage');
      updateFileStatus('subChange', 'subChangeImage');
      updateFileStatus('subList', 'subListImage');
      updateFileStatus('subArt', 'subArtImage');
      updateFileStatus('subAudit', 'subAuditImage');
    //   window.location.reload();
    },
    error: function(xhr, status, error) {
      console.log('File upload failed');
    }
  });
}


itForm.addEventListener("change", function() {
  uploadFileI();
});
</script>
<script>
function setFileVisibility(files, select, input, check, button, date) {
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
            checkElement.src = 'statusImage/xmark.png';
            buttonElement.style.display = "none";
        }
    }
}



// Example usage:
setFileVisibility("<?php echo $subFin; ?>", "<?php echo $subFinSelect?>", 'subFin', 'subFinImage', "subFinButton");
setFileVisibility("<?php echo $subLedg; ?>", "<?php echo $subLedgSelect?>", 'subLedg', 'subLedgImage', "subLedgButton");
setFileVisibility("<?php echo $subDue; ?>", "<?php echo $subDueSelect?>", 'subDue', 'subDueImage', "subDueButton");
setFileVisibility("<?php echo $subInv; ?>", "<?php echo $subInvSelect?>", 'subInv', 'subInvImage', "subInvButton");
setFileVisibility("<?php echo $subAcc; ?>", "<?php echo $subAccSelect?>", 'subAcc', 'subAccImage', "subAccButton");

setFileVisibility("<?php echo $subBank; ?>", "<?php echo $subBankSelect?>", 'subBank', 'subBankImage', "subBankButton");
setFileVisibility("<?php echo $subInc; ?>", "<?php echo $subIncSelect?>", 'subInc', 'subIncImage', "subIncButton");
setFileVisibility("<?php echo $subRec; ?>", "<?php echo $subRecSelect?>", 'subRec', 'subRecImage', "subRecButton");
setFileVisibility("<?php echo $subChange; ?>", "<?php echo $subChangeSelect?>", 'subChange', 'subChangeImage', "subChangeButton");
setFileVisibility("<?php echo $subList; ?>", "<?php echo $subListSelect?>", 'subList', 'subListImage', "subListButton");
setFileVisibility("<?php echo $subArt; ?>", "<?php echo $subArtSelect?>", 'subArt', 'subArtImage', "subArtButton");
setFileVisibility("<?php echo $subAudit; ?>", "<?php echo $subAuditSelect?>", 'subAudit', 'subAuditImage', "subAuditButton");

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
// PRINCIPAL BORROWER
showText('subFinDesc','21%');
showText('subLedgDesc','21%');
showText('subDueDesc','21%');
showText('subInvDesc','21%');
showText('subAccDesc','21%');

showText('subBankDesc','40%');
showText('subIncDesc','50%');
showText('subRecDesc','70%');
showText('subChangeDesc','70%');
showText('subListDesc','70%');
showText('subArtDesc','70%');
showText('subAuditDesc','70%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput6").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput7").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput8").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput9").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput10").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput11").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>
<script>
document.getElementById("fileInput12").addEventListener("change", function() {
document.getElementById("Sub-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

    $('#subFinDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subFinDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

    
$('#subLedgDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subLedgDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subDueDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subDueDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subInvDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subInvDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subAccDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subAccDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subBankDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subBankDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subIncDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subIncDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subRecDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subRecDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subChangeDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subChangeDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subListDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subListDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});


$('#subArtDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subArtDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#subAuditDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-substats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'subAuditDesc'}, 
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