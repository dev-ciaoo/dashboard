<?php
include('connection.php');
include('fileUploadBSP.php');

$selectLending = "SELECT * FROM `bsplending` WHERE id = 1";
$data = mysqli_query($con, $selectLending) ;
if (!$data) {
    echo("Error description: " . mysqli_error($con));
}else{
    while ($row = mysqli_fetch_array($data)) {
        $lendProcess = $row['lendProcess'];
        $lendCredit = $row['lendCredit'];
        $lendManagement = $row['lendManagement'];
        $lendSummary = $row['lendSummary'];
        $lendCopy = $row['lendCopy'];
        $lendSummary2 = $row['lendSummary2'];
        $lendSched = $row['lendSched'];
        $lendList = $row['lendList'];
        $lendLoan = $row['lendLoan'];
        $lendProcess2 = $row['lendProcess2'];
        $lendAging = $row['lendAging'];
        $lendSched2 = $row['lendSched2'];
        $lendOther = $row['lendOther'];
        $lendLoan2 = $row['lendLoan2'];
        $lendSummary3 = $row['lendSummary3'];
        $lendClass = $row['lendClass'];
//Description
        $lendProcessDesc = $row['lendProcessDesc'];
        $lendCreditDesc = $row['lendCreditDesc'];
        $lendManagementDesc = $row['lendManagementDesc'];
        $lendSummaryDesc = $row['lendSummaryDesc'];
        $lendCopyDesc = $row['lendCopyDesc'];
        $lendSummary2Desc = $row['lendSummary2Desc'];
        $lendSchedDesc = $row['lendSchedDesc'];
        $lendListDesc = $row['lendListDesc'];
        $lendLoanDesc = $row['lendLoanDesc'];
        $lendProcess2Desc = $row['lendProcess2Desc'];
        $lendAgingDesc = $row['lendAgingDesc'];
        $lendSched2Desc = $row['lendSched2Desc'];
        $lendOtherDesc = $row['lendOtherDesc'];
        $lendLoan2Desc = $row['lendLoan2Desc'];
        $lendSummary3Desc = $row['lendSummary3Desc'];
        $lendClassDesc = $row['lendClassDesc'];

        $lendProcessStats = $row['lendProcessStats'];
        $lendCredcreditstats = $row['lendCredcreditstats'];
        $lendManagementStats = $row['lendManagementStats'];
        $lendSummaryStats = $row['lendSummaryStats'];
        $lendCopyStats = $row['lendCopyStats'];
        $lendSummary2Stats = $row['lendSummary2Stats'];
        $lendSchedStats = $row['lendSchedStats'];
        $lendListStats = $row['lendListStats'];
        $lendLoanStats = $row['lendLoanStats'];
        $lendProcess2Stats = $row['lendProcess2Stats'];
        $lendAgingStats= $row['lendAgingStats'];
        $lendSched2Stats = $row['lendSched2Stats'];
        $lendOtherStats = $row['lendOtherStats'];
        $lendLoan2Stats = $row['lendLoan2Stats'];
        $lendSummary3Stats = $row['lendSummary3Stats'];
        $lendClassStats = $row['lendClassStats'];
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
        $uploadDir = "bsplending/";
    
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
                $sql = "INSERT INTO bsplending ($tableColumn) VALUES ('$targetFile')";
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

    .remarks{
        width: 230px;
        height: 30px;
        position: relative;
        display: inline-flex;
        right: 10px;
        margin-left:10px;
    }
    .form-control{
        width: 230px;
        height: 30px;
        position: relative;
        display: inline-flex;
        float: right;
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
</style>
<body oncontextmenu="return false;">
<button class="btn btn-secondary btn-md btnBack">Back</button>  
<div class = "d-flex flex-row align-items-center justify-content-center">
        <span><h3>LENDING/CREDIT RISK</h3></span>
</div>
<br><br>
<!--Modal-->
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
<div class="modal-content" style="height: 50%;">
    <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
    <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
</div>
</div>
<!--Modal-->
<div class="container">
<form action="" method="POST" enctype="multipart/form-data" id="Lend-Form">
<table class="table border">
    <tbody>
        <tr>
        <td class="col-sm-7">
                1. Process flow (flowchart) of lending activities from initiation to payment/renewal/other <br>&nbsp;&nbsp;&nbsp;remedial actions. 
                Schedule a presentation/ walk-through of the process(preferably 3rd<br>&nbsp;&nbsp;&nbsp;day of examination).
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td >
                <input type="file" id="lendProcess" name="lendProcess"/><img id="lendProcessImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendProcess . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendProcessButton" >Open File</button></a>
                <?php if($lendProcessStats == 1){ ?>
                    <input  style="background-color:#ADD8E6;" value="<?= $lendProcessDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendProcessDesc" name = "lendProcessDesc" />
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendProcessDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendProcessDesc" name = "lendProcessDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendProcess, 20) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files', 'lendProcess');
                    $sql1 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendProcess` IS NOT NULL AND `lendProcess` != '' GROUP BY id";
                    $result1= $con->query($sql1);
                            
                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $user = $row1['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row1['lendProcess']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row1['lendProcess'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row1['lendProcess'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row1['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="1">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row1['lendProcessDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendProcessDesc1">';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row1['lendProcessDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendProcessDesc1">';    
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
                2. Credit Policy Manual (including Loan Quality Review, Loan Loss Provisioning and Internal <br>&nbsp;&nbsp;&nbsp;credit risk ratig guielines including rating factors).
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendCredit" name="lendCredit"/><img id="lendCreditImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendCredit . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendCreditButton" >Open File</button></a>
                <?php if($lendCredcreditstats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendCreditDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendCreditDesc" name = "lendCreditDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendCreditDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendCreditDesc" name = "lendCreditDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendCredit, 30) .  "</span>" ?>
                <?php
                        uploadFiles($con, 'files2', 'lendCredit');
                        $sql2 = "SELECT `id`, `lendCredit`, `lendCreditDesc` FROM bsplending WHERE `id` >= 2 AND `lendCredit` != '' AND `lendCredit` IS NOT NULL GROUP BY `id`";
                        $result2 = $con->query($sql2);
                                
                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $user = $row2['userid'];
                                // Output the form for the second section
                                echo '<img class="lendProcessImage" src="statusImage/check.png" alt="statusImage"><br>';
                                echo "<a href='" . ($row2['lendCredit']) . "' target='_blank'><button class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['lendCredit'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['lendProcess'], 20) . " </button></a><br>";
                                echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                                echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                                echo '<input type="hidden" name="form_submit" value="2">'; 
                                if ($user >=92 & $user <= 96){ 
                                echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['lendCreditDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendCreditDesc" />';
                                }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['lendCreditDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendCreditDesc" />';    
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
                3. Management report on loan portfolio and credit risk.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendManagement" name="lendManagement"/><img id="lendManagementImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendManagement . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendManagementButton" >Open File</button></a>
                <?php if($lendManagementStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendManagementDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendManagementDesc" name = "lendManagementDesc" />
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendManagementDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendManagementDesc" name = "lendManagementDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendManagement, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files3', 'lendManagement');
                    $sql3 = "SELECT `id`, `lendManagement`, `lendManagementDesc` FROM bsplending WHERE `id` >= 2 AND `lendManagement` IS NOT NULL AND `lendManagement` != '' GROUP BY id";
                    $result3 = $con->query($sql3);
                            
                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            $user = $row3['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row3['lendManagement']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['lendManagement'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['lendManagement'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="3">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['lendManagementDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendManagementDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['lendManagementDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendManagementDesc" />';
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
                4. Summary of changes to the bank's credit policies and procedure, if any, <br>&nbsp;&nbsp;&nbsp;since 01 January 2022.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendSummary" name="lendSummary"/><img id="lendSummaryImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendSummary . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendSummaryButton" >Open File</button></a>
                <?php if($lendSummaryStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendSummaryDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSummaryDesc" name = "lendSummaryDesc" />
                <?php } else{ ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $lendSummaryDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSummaryDesc" name = "lendSummaryDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendSummary, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files4', 'lendSummary');
                    $sql4 = "SELECT * FROM bsplending WHERE  `id` >= 2 AND `lendSummary` IS NOT NULL AND `lendSummary` != '' GROUP BY id";
                    $result4 = $con->query($sql4);
                            
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $user = $row4['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row4['lendSummary']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['lendSummary'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['lendSummary'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="4">';
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['lendSummaryDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSummaryDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['lendSummaryDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSummaryDesc" />'; 
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
                5. Copy of credit approval and signing authority of officers or committee(s).
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendCopy" name="lendCopy"/><img id="lendCopyImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendCopy . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendCopyButton" >Open File</button></a>
                <?php if($lendCopyStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendCopyDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendCopyDesc" name = "lendCopyDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendCopyDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendCopyDesc" name = "lendCopyDesc" />
               <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendCopy, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files5', 'lendCopy');
                    $sql5 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendCopy` IS NOT NULL AND `lendCopy` != '' GROUP BY id";
                    $result5 = $con->query($sql5);
                            
                    if ($result5->num_rows > 0) {
                        while ($row5 = $result5->fetch_assoc()) {
                            $user = $row5['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row5['lendCopy']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['lendCopy'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['lendCopy'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="5">'; 
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;"  onchange="submitremarks(this)" value="' . $row5['lendCopyDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendCopyDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;"  onchange="submitremarks(this)" value="' . $row5['lendCopyDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendCopyDesc" />';   
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
                6. Summary of any new loan products launched since 01 January 2022, if any.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendSummary2" name="lendSummary2"/><img id="lendSummary2Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendSummary2; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendSummary2Button" >Open File</button></a>
                <?php if($lendSummary2Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendSummary2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSummary2Desc" name = "lendSummary2Desc" />
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendSummary2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSummary2Desc" name = "lendSummary2Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendSummary2, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files6', 'lendSummary2');
                    $sql6 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendSummary2` IS NOT NULL AND `lendSummary2` != '' GROUP BY id";
                    $result6 = $con->query($sql6);
                            
                    if ($result6->num_rows > 0) {
                        while ($row6 = $result6->fetch_assoc()) {
                            $user = $row6['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row6['lendSummary2']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row6['lendSummary2'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row6['lendSummary2'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row6['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="6">'; 
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row6['lendSummary2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSummary2Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row6['lendSummary2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSummary2Desc" />';  
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
               7. Schedule of Loan Portfolio (loans and receivables, restructured loans) of all branches,<br>&nbsp;&nbsp;&nbsp;OBO's and Head Office as of 31 December 2023 -
                gross and net of Unearned Interest<br>&nbsp;&nbsp;&nbsp;Discount, Service Charges and other amortized lending costs Suggested Column  &nbsp;&nbsp;&nbsp;Headings<strong><i>(Information Required)</i></strong>
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendSched" name="lendSched"/><img id="lendSchedImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendSched . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendSchedButton" >Open File</button></a>
                <?php if($lendSchedStats == 1){ ?>
                    <input style="background-color:#ADD8E6;"  value="<?= $lendSchedDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSchedDesc" name = "lendSchedDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;"  value="<?= $lendSchedDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSchedDesc" name = "lendSchedDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendSched, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files7', 'lendSched');
                    $sql7 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendSched` IS NOT NULL AND `lendSched` != '' GROUP BY id";
                    $result7 = $con->query($sql7);
                            
                    if ($result7->num_rows > 0) {
                        while ($row7 = $result7->fetch_assoc()) {
                            $user = $row7['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row7['lendSched']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row7['lendSched'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row7['lendSched'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row7['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="7">'; 
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row7['lendSchedDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSchedDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row7['lendSchedDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSchedDesc" />';  
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
               8. List of Top Twenty (20) Borrowers based on aggregate outstanding balances<br>&nbsp;&nbsp;&nbsp;(softcopy of amortization schedule/s, if applicable,
                and current subsidiary ledger/s<br>&nbsp;&nbsp;&nbsp;of each borrower and SL of immediately preceding loan account, if applicable, to be<br>&nbsp;&nbsp;&nbsp;requested as may be necessary).
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendList" name="lendList"/><img id="lendListImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendList . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendListButton" >Open File</button></a>
                <?php if($lendListStats == 1){ ?>
                    <input style="background-color:#ADD8E6;"  value="<?= $lendListDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendListDesc" name = "lendListDesc" />
                <?php } else { ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $lendListDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendListDesc" name = "lendListDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendList, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files8', 'lendList');
                    $sql8 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendList` IS NOT NULL AND `lendList` != '' GROUP BY id";
                    $result8= $con->query($sql8);
                            
                    if ($result8->num_rows > 0) {
                        while ($row8 = $result8->fetch_assoc()) {
                            $user = $row8['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row8['lendList']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row8['lendList'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row8['lendList'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row8['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="8">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row8['lendListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendListDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row8['lendListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendListDesc" />';     
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
        9. Loans classified by industry.
        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
    </td>
    <td>
        <input type="file" id="lendLoan" name="lendLoan"/><img id="lendLoanImage" src="statusImage/check.png" alt="statusImage">
        <a href="<?php echo $lendLoan . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendLoanButton" >Open File</button></a>
        <?php if($lendLoanStats == 1){ ?>
            <input style="background-color:#ADD8E6;" value="<?= $lendLoanDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendLoanDesc" name="lendLoanDesc" />
        <?php } else { ?>
            <input style="background-color:#FFFFE0;" value="<?= $lendLoanDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendLoanDesc" name="lendLoanDesc" />
        <?php } ?>
        
        <br>
        <?php echo "<span id='tag'>" . extractFileName1($lendLoan, 30) .  "</span>" ?>
        <?php
            uploadFiles($con, 'files9', 'lendLoan');
            $sql9 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendLoan` IS NOT NULL AND `lendLoan` != '' GROUP BY id";
            $result9= $con->query($sql9);
                    
            if ($result9->num_rows > 0) {
                while ($row9 = $result9->fetch_assoc()) {
                    $user = $row9['userid'];
                    echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                    echo "<a href='" . ($row9['lendLoan']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row9['lendLoan'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row9['lendLoan'], 20) . " </button></a><br>";
                    echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $row9['id'] . '">';
                    echo '<input type="hidden" name="form_submit" value="9">'; 
                    if ($user >=92 & $user <= 96){
                        echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row9['lendLoanDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendLoanDesc" />';
                    }else{
                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row9['lendLoanDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendLoanDesc" />';    
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
               10. Processes Flow on disclosure, booking and monitoring of installment loans.
               <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendProcess2" name="lendProcess2"/><img id="lendProcess2Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendProcess2 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendProcess2Button" >Open File</button></a>
                <?php if($lendProcess2Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendProcess2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendProcess2Desc" name = "lendProcess2Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendProcess2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendProcess2Desc" name = "lendProcess2Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendProcess2, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files10', 'lendProcess2');
                    $sql10 = "SELECT * FROM bsplending  WHERE `id` >= 2 AND `lendProcess2` IS NOT NULL AND `lendProcess2` != '' GROUP BY id";
                    $result10= $con->query($sql10);
                            
                    if ($result10->num_rows > 0) {
                        while ($row10 = $result10->fetch_assoc()) {
                            $user = $row10['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row10['lendProcess2']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row10['lendProcess2'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row10['lendProcess2'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row10['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="10">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row10['lendProcess2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendProcess2Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row10['lendProcess2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendProcess2Desc" />';
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
              11. Aging schedule and status report of loans and advances under "In Litigation and<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Past Due Accouts".
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendAging" name="lendAging"/><img id="lendAgingImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendAging . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendAgingButton" >Open File</button></a>
                <?php if($lendAgingStats == 1){ ?>
                    <input value="<?= $lendAgingDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendAgingDesc" name = "lendAgingDesc" />
                <?php } else { ?> 
                    <input value="<?= $lendAgingDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendAgingDesc" name = "lendAgingDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendAging, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files11', 'lendAging');
                    $sql11 = "SELECT * FROM bsplending  WHERE `id` >= 2 AND `lendAging` IS NOT NULL AND `lendAging` != '' GROUP BY id";
                    $result11= $con->query($sql11);
                            
                    if ($result11->num_rows > 0) {
                        while ($row11 = $result11->fetch_assoc()) {
                            $user = $row11['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row11['lendAging']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row11['lendAging'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row11['lendAging'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row11['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="11">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row11['lendAgingDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendAgingDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row11['lendAgingDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendAgingDesc" />';
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
              12. Schedule of loans and other credit accommodations to related parties (DOSRI, etc.).
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendSched2" name="lendSched2"/><img id="lendSched2Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendSched2 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendSched2Button" >Open File</button></a>
                <?php if($lendSched2Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendSched2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSched2Desc" name = "lendSched2Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendSched2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSched2Desc" name = "lendSched2Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendSched2, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files12', 'lendSched2');
                    $sql12 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendSched2` IS NOT NULL AND `lendSched2` != '' GROUP BY id";
                    $result12= $con->query($sql12);
                            
                    if ($result12->num_rows > 0) {
                        while ($row12 = $result12->fetch_assoc()) {
                            $user = $row12['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row12['lendSched2']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row12['lendSched2'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row12['lendSched2'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row12['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="12">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row12['lendSched2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSched2Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row12['lendSched2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSched2Desc" />';
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
             13. Other related party transactions(other than loans and credit accommodations).
             <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendOther" name="lendOther"/><img id="lendOtherImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendOther . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendOtherButton" >Open File</button></a>
                <?php if($lendOtherStats == 1){ ?>
                    <input style="background-color:#ADD8E6;"  value="<?= $lendOtherDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendOtherDesc" name = "lendOtherDesc" />
                <?php } else { ?>
                    <input  style="background-color:#FFFFE0;" value="<?= $lendOtherDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendOtherDesc" name = "lendOtherDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendOther, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files13', 'lendOther');
                    $sql13 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendOther` IS NOT NULL AND `lendOther` != '' GROUP BY id";
                    $result13= $con->query($sql13);
                            
                    if ($result13->num_rows > 0) {
                        while ($row13 = $result13->fetch_assoc()) {
                            $user = $row13['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row13['lendOther']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row13['lendOther'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row13['lendOther'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row13['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="13">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row13['lendOtherDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendOtherDesc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row13['lendOtherDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendOtherDesc" />';    
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
             14. Loans Granted under Fringe Benefit Program.
             <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
            </td>
            <td>
                <input type="file" id="lendLoan2" name="lendLoan2"/><img id="lendLoan2Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendLoan2 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendLoan2Button" >Open File</button></a>
                <?php if($lendLoan2Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendLoan2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendLoan2Desc" name = "lendLoan2Desc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendLoan2Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendLoan2Desc" name = "lendLoan2Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendLoan2, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files14', 'lendLoan2');
                    $sql14 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendLoan2` IS NOT NULL AND `lendLoan2` != '' GROUP BY id";
                    $result14= $con->query($sql14);
                            
                    if ($result14->num_rows > 0) {
                        while ($row14 = $result14->fetch_assoc()) {
                            $user = $row14['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row14['lendLoan2']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row14['lendLoan2'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row14['lendLoan2'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row14['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="14">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row14['lendLoan2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendLoan2Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row14['lendLoan2Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendLoan2Desc" />';   
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
        <tr>
            <td>
            15. Summary of Loans Written-off/Recoveriess from 01 January 2022 to latest available<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;including all related communications from BSP.
            <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong>
        </td>
            <td>
                <input type="file" id="lendSummary3" name="lendSummary3"/><img id="lendSummary3Image" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendSummary3 . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendSummary3Button" >Open File</button></a>
                <?php if($lendSummary3Stats == 1){ ?>
                    <input style="background-color:#ADD8E6;" value="<?= $lendSummary3Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSummary3Desc" name = "lendSummary3Desc" />
                <?php } else { ?> 
                    <input style="background-color:#FFFFE0;" value="<?= $lendSummary3Desc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendSummary3Desc" name = "lendSummary3Desc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendSummary3, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files15', 'lendSummary3');
                    $sql15 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendSummary3` IS NOT NULL AND `lendSummary3` != '' GROUP BY id";
                    $result15= $con->query($sql15);
                            
                    if ($result15->num_rows > 0) {
                        while ($row15 = $result15->fetch_assoc()) {
                            $user = $row15['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row15['lendSummary3']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row15['lendSummary3'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row15['lendSummary3'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row15['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="15">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row15['lendSummary3Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSummary3Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row15['lendSummary3Desc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendSummary3Desc" />';
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files15[]" id="fileInput15" style="display: none;">
                <label for="fileInput15" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label> 
            </td>
        </tr>
        <tr>
            <td>
            16. Classified Other Risk Assets.  
            <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Angelito P. Reyes, Terrence M. Gavituya) </strong> 
            </td>
            <td>
                <input type="file" id="lendClass" name="lendClass"/><img id="lendClassImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $lendClass . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="lendClassButton" >Open File</button></a>
                <?php if($lendClassStats == 1){ ?>
                    <input  style="background-color:#ADD8E6;" value="<?= $lendClassDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendClassDesc" name = "lendClassDesc" />
                <?php } else { ?>
                    <input style="background-color:#FFFFE0;" value="<?= $lendClassDesc; ?>" type="text" class="form-control remarks" placeholder="&nbsp;REMARKS" id="lendClassDesc" name = "lendClassDesc" />
                <?php } ?>
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($lendClass, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files16', 'lendClass');
                    $sql16 = "SELECT * FROM bsplending WHERE `id` >= 2 AND `lendClass` IS NOT NULL AND `lendClass` != '' GROUP BY id";
                    $result16= $con->query($sql16);
                            
                    if ($result16->num_rows > 0) {
                        while ($row16 = $result16->fetch_assoc()) {

                            $user = $row16['userid'];
                            echo '<img id="lendProcessImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row16['lendClass']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row16['lendClass'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row16['lendClass'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-creddesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row15['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="16">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row16['lendClassDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendLoan2Desc" />';
                            }else{
                            echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row16['lendClassDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="lendLoan2Desc" />';   
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
    </tbody>
</table>
</form>
</div>

<style>

</style>

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

var lendingForm = document.getElementById("Lend-Form");

function uploadFileI() {
var LendingFormData = new FormData(lendingForm);
$.ajax({
    url: 'bsp-credit-upload.php', 
    type: 'POST',
    data: LendingFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
// AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
// FOR LOAN APPLICATION:
console.log(response);
updateFileStatus('lendProcess', 'lendProcessImage');
updateFileStatus('lendCredit', 'lendCreditImage');
updateFileStatus('lendManagement', 'lendManagementImage');
updateFileStatus('lendSummary', 'lendSummaryImage');
updateFileStatus('lendCopy', 'lendCopyImage');
updateFileStatus('lendSummary2', 'lendSummary2Image');
updateFileStatus('lendSched', 'lendSchedImage');
updateFileStatus('lendList', 'lendListImage');
updateFileStatus('lendLoan', 'lendLoanImage');
updateFileStatus('lendProcess2', 'lendProcess2Image');
updateFileStatus('lendAging', 'lendAgingImage');
updateFileStatus('lendSched2', 'lendSched2Image');
updateFileStatus('lendOther', 'lendOtherImage');
updateFileStatus('lendLoan2', 'lendLoan2Image');
updateFileStatus('lendSummary3', 'lendSummary3Image');
updateFileStatus('lendClass', 'lendClassImage');
// location.reload();
},
    error: function(xhr, status, error) {
    console.log('File upload failed');
    }
});
}

lendingForm.addEventListener("change", function() {
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
setFileVisibility("<?php echo $lendProcess; ?>", "<?php echo $lendProcessDesc; ?>", 'lendProcess', 'lendProcessImage', "lendProcessButton");
setFileVisibility("<?php echo $lendCredit; ?>", "<?php echo $lendCreditDesc; ?>", 'lendCredit', 'lendCreditImage', "lendCreditButton");
setFileVisibility("<?php echo $lendManagement; ?>", "<?php echo $lendManagementDesc; ?>", 'lendManagement', 'lendManagementImage', "lendManagementButton");
setFileVisibility("<?php echo $lendSummary; ?>", "<?php echo $lendSummaryDesc; ?>", 'lendSummary', 'lendSummaryImage', "lendSummaryButton");
setFileVisibility("<?php echo $lendCopy; ?>", "<?php echo $lendCopyDesc; ?>", 'lendCopy', 'lendCopyImage', "lendCopyButton");
setFileVisibility("<?php echo $lendSummary2; ?>", "<?php echo $lendSummary2Desc; ?>", 'lendSummary2', 'lendSummary2Image', "lendSummary2Button");
setFileVisibility("<?php echo $lendSched; ?>", "<?php echo $lendSchedDesc; ?>", 'lendSched', 'lendSchedImage', "lendSchedButton");
setFileVisibility("<?php echo $lendList; ?>", "<?php echo $lendListDesc; ?>", 'lendList', 'lendListImage', "lendListButton");
setFileVisibility("<?php echo $lendLoan; ?>", "<?php echo $lendLoanDesc; ?>", 'lendLoan', 'lendLoanImage', "lendLoanButton");
setFileVisibility("<?php echo $lendProcess2; ?>", "<?php echo $lendProcess2Desc; ?>", 'lendProcess2', 'lendProcess2Image', "lendProcess2Button");
setFileVisibility("<?php echo $lendAging; ?>", "<?php echo $lendAgingDesc; ?>", 'lendAging', 'lendAgingImage', "lendAgingButton");
setFileVisibility("<?php echo $lendSched2; ?>", "<?php echo $lendSched2Desc; ?>", 'lendSched2', 'lendSched2Image', "lendSched2Button");
setFileVisibility("<?php echo $lendOther; ?>", "<?php echo $lendOtherDesc; ?>", 'lendOther', 'lendOtherImage', "lendOtherButton");
setFileVisibility("<?php echo $lendLoan2; ?>", "<?php echo $lendLoan2Desc; ?>", 'lendLoan2', 'lendLoan2Image', "lendLoan2Button");
setFileVisibility("<?php echo $lendSummary3; ?>", "<?php echo $lendSummary3Desc; ?>", 'lendSummary3', 'lendSummary3Image', "lendSummary3Button");
setFileVisibility("<?php echo $lendClass; ?>", "<?php echo $lendClassDesc; ?>", 'lendClass', 'lendClassImage', "lendClassButton");
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
showText('lendProcessDesc','21%');
showText('lendCreditDesc','21%');
showText('lendManagementDesc','21%');
showText('lendSummaryDesc','21%');
showText('lendCopyDesc','21%');
showText('lendSummary2Desc','21%');
showText('lendSchedDesc','21%');
showText('lendListDesc','21%');
showText('lendLoanDesc','21%');
showText('lendProcess2Desc','21%');
showText('lendAgingDesc','70%');
showText('lendSched2Desc','70%');
showText('lendOtherDesc','70%');
showText('lendLoan2Desc','70%');
showText('lendSummary3Desc','70%');
showText('lendClassDesc','70%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput6").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput7").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput8").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput9").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput10").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput11").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput12").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput13").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput14").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput15").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>
<script>
document.getElementById("fileInput16").addEventListener("change", function() {
document.getElementById("Lend-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    
    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

    $('#lendProcessDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendProcessDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendCreditDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendCreditDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendManagementDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendManagementDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendSummaryDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendSummaryDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendCopyDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendCopyDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendSummary2Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendSummary2Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendSchedDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendSchedDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendListDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendListDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendLoanDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendLoanDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendProcess2Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendProcess2Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendAgingDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendAgingDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendSched2Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendSched2Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});


$('#lendOtherDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendOtherDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendSummary3Desc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendSummary3Desc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#lendClassDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-creditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'lendClassDesc'}, 
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