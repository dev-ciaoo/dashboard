<?php
include('connection.php');
include('fileUploadBSP.php');

$selectIT = "SELECT * FROM `bspoffice` WHERE id = 1";
$data = mysqli_query($con, $selectIT) ;
    if (!$data) {
        echo("Error description: " . mysqli_error($con));
    }else{
        while ($row = mysqli_fetch_array($data)) {
            $offManual = $row['offManual'];
            $offDetail = $row['offDetail'];
            $offAcc = $row['offAcc'];
            $offReg = $row['offReg'];
            $offManda = $row['offManda'];
            $offUtil = $row['offUtil'];
            $offSingle = $row['offSingle'];

            $offManualSelect = $row['offManualDesc'];
            $offDetailSelect = $row['offDetailDesc'];
            $offAccSelect = $row['offAccDesc'];
            $offRegSelect = $row['offRegDesc'];
            $offMandaSelect = $row['offMandaDesc'];
            $offUtilSelect = $row['offUtilDesc'];
            $offSingleSelect = $row['offSingleDesc'];

            $offManualStats = $row['offManualStats'];
            $offDetailStats = $row['offDetailStats'];
            $offAccStats = $row['offAccStats'];
            $offRegStats = $row['offRegStats'];
            $offMandaStats = $row['offMandaStats'];
            $offUtilStats = $row['offUtilStats'];
            $offSingleStats = $row['offSingleStats'];
            
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
            $uploadDir = "bspoffice/";
        
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
                    $sql = "INSERT INTO bspoffice ($tableColumn) VALUES ('$targetFile')";
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
</style>
<body oncontextmenu="return false;">   
<button class="btn btn-secondary btn-md btnBack">Back</button>
<div class = "d-flex flex-column align-items-center  justify-content-center">
        <h3>COMPLIANCE OFFICE</h3>
</div>
<br><br><br>
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
    <div class="modal-content" style="height: 50%;">
        <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
        <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
    </div>
</div>
<div class= "container">
<form action="" method="POST" enctype="multipart/form-data" id="Office-Form">
    <table class="table border">
        <tbody>
        <tr>
            <td class="col-sm-7 justify-center">
                1.Compliance Office Manuals, Policies and Procedures.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="offManual" name="offManual"/><img id="offManualImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $offManual . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="offManualButton" >Open File</button></a>
                <?php if($offManualStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offManualDesc" name="offManualDesc" value="<?= $offManualSelect; ?>">
                <?php }else{?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offManualDesc" name="offManualDesc" value="<?= $offManualSelect; ?>">
                <?php } ?>
                    <input type="hidden" class="form-control" placeholder="REMARKS" id="offManualSelect" name="offManualSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($offManual, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files', 'offManual');
                    $sql = "SELECT * FROM bspoffice WHERE id >= 2 AND offManual != '' AND offManual IS NOT NULL GROUP BY id ";
                    $result = $con->query($sql);
                            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $user = $row['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row['offManual']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['offManual'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['offManual'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-officedesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="1">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['offManualDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offManualDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['offManualDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offManualDesc" style="margin-top: -1.5rem;"/>';          
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
                2. 2022 and 2023 Detailed Plann of the Compliance Office.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="offDetail" name="offDetail"/><img id="offDetailImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $offDetail . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="offDetailButton" >Open File</button></a>
                <?php if($offDetailStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offDetailDesc" name="offDetailDesc" value="<?= $offDetailSelect; ?>">
               <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offDetailDesc" name="offDetailDesc" value="<?= $offDetailSelect; ?>">
                <?php } ?>
               <input type="hidden" class="form-control" placeholder="REMARKS" id="offDetailSelect" name="offDetailSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($offDetail, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files2', 'offDetail');
                    $sql2 = "SELECT  * FROM bspoffice WHERE id >= 2 AND offDetail != '' AND offDetail IS NOT NULL GROUP BY id ";
                    $result2 = $con->query($sql2);
                            
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $user = $row2['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row2['offDetail']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['offDetail'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['offDetail'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-officedesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="2">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['offDetailDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offDetailDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['offDetailDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offDetailDesc" style="margin-top: -1.5rem;"/>';        
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
               3. 2022 and 2023 Compliance Office Accomplishment Reports.
               <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="offAcc" name="offAcc"/><img id="offAccImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $offAcc . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="offAccButton" >Open File</button></a>
                <?php if($offAccStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offAccDesc" name="offAccDesc" value="<?= $offAccSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offAccDesc" name="offAccDesc" value="<?= $offAccSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="offAccSelect" name="offAccSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($offAcc, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files3', 'offAcc');
                    $sql3 = "SELECT * FROM bspoffice WHERE id >= 2 AND offAcc != '' AND offAcc IS NOT NULL GROUP BY id ";
                    $result3 = $con->query($sql3);
                            
                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            $user = $row3['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row3['offAcc']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['offAcc'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['offAcc'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-officedesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="3">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['offAccDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offAccDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['offAccDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offAccDesc" style="margin-top: -1.5rem;"/>';        
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
              4. List of reports regularly generated by Compliance Officer, indicating the frequency<br>&nbsp;&nbsp;&nbsp;and appropriate recipients.
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="offReg" name="offReg"/><img id="offRegImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $offReg . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="offRegButton" >Open File</button></a>
                <?php if($offRegStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offRegDesc" name="offRegDesc" value="<?= $offRegSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offRegDesc" name="offRegDesc" value="<?= $offRegSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="offRegSelect" name="offRegSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($offReg, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files4', 'offReg');
                    $sql4 = "SELECT * FROM bspoffice WHERE id >= 2 AND offReg != '' AND offReg IS NOT NULL GROUP BY id ";
                    $result4 = $con->query($sql4);
                            
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $user = $row4['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row4['offReg']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['offReg'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['offReg'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-officedesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="4">';
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['offRegDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offRegDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['offRegDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offRegDesc" style="margin-top: -1.5rem;"/>';     
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
             5. Copy of Report on Compliance with Mandatory Credit Allocation to SMEs as of RE<br>&nbsp;&nbsp;&nbsp;reference date.
             <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="offManda" name="offManda"/><img id="offMandaImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $offManda . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="offMandaButton" >Open File</button></a>
                <?php if($offMandaStats == 1){ ?>
                    <input type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offMandaDesc" name="offMandaDesc" value="<?= $offMandaSelect; ?>">
                <?php }else{ ?>
                    <input type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offMandaDesc" name="offMandaDesc" value="<?= $offMandaSelect; ?>">
                <?php } ?>
                    <input type="hidden" class="form-control" placeholder="REMARKS" id="offMandaSelect" name="offMandaSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($offManda, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files5', 'offManda');
                    $sql5 = "SELECT * FROM bspoffice WHERE id >= 2 AND offManda != '' AND offManda IS NOT NULL GROUP BY id ";
                    $result5 = $con->query($sql5);
                            
                    if ($result5->num_rows > 0) {
                        while ($row5 = $result5->fetch_assoc()) {
                            $user = $row5['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row5['offManda']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['offManda'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['offManda'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-officedesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="5">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row5['offMandaDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offMandaDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['offMandaDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offMandaDesc" style="margin-top: -1.5rem;"/>';         
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
             6. Copy of Report on Utilization of Loanable Funds Set Aside for Agri-Agra Loans as<br>&nbsp;&nbsp;&nbsp;of RE reference date.
             <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="offUtil" name="offUtil"/><img id="offUtilImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $offUtil . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="offUtilButton" >Open File</button></a>
                <?php if($offUtilStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offUtilDesc" name="offUtilDesc" value="<?= $offUtilSelect; ?>">
                <?php } else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offUtilDesc" name="offUtilDesc" value="<?= $offUtilSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="offUtilSelect" name="offUtilSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($offUtil, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files6', 'offUtil');
                    $sql6 = "SELECT  * FROM bspoffice WHERE id >= 2 AND offUtil != '' AND offUtil IS NOT NULL GROUP BY id ";
                    $result6 = $con->query($sql6);
                            
                    if ($result6->num_rows > 0) {
                        while ($row6 = $result6->fetch_assoc()) {
                            $user = $row6['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row6['offUtil']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row6['offUtil'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row6['offUtil'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-officedesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row6['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="6">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row6['offUtilDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offUtilDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row6['offUtilDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offUtilDesc" style="margin-top: -1.5rem;"/>';   
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
             7. Copy of Report on Single Borrower's Limit and Consolidated Report on Compliance<br>&nbsp;&nbsp;&nbsp;with Individual 
             and Aggregate Ceilings on Direct Creit Accommodations to DOSRI<br>&nbsp;&nbsp;&nbsp;as of RE reference date.
             <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="offSingle" name="offSingle"/><img id="offSingleImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $offSingle . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="offSingleButton" >Open File</button></a>
                <?php if($offSingleStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offSingleDesc" name="offSingleDesc" value="<?= $offSingleSelect; ?>">
                <?php } else{ ?> 
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="offSingleDesc" name="offSingleDesc" value="<?= $offSingleSelect; ?>">    
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="offSingleSelect" name="offSingleSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($offSingle, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files7', 'offSingle');
                    $sql7 = "SELECT * FROM bspoffice WHERE id >= 2 AND offSingle != '' AND offSingle IS NOT NULL GROUP BY id ";
                    $result7 = $con->query($sql7);
                            
                    if ($result7->num_rows > 0) {
                        while ($row7 = $result7->fetch_assoc()) {
                            $user = $row7['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row7['offSingle']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row7['offSingle'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row7['offSingle'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-officedesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row7['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="7">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row7['offSingleDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offSingleDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row7['offSingleDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="offSingleDesc" style="margin-top: -1.5rem;"/>';    
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
var itForm = document.getElementById("Office-Form");

function uploadFileI() {
  var ITFormData = new FormData(itForm);
  $.ajax({
    url: 'bsp-Office-UploadData.php', 
    type: 'POST',
    data: ITFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
    // AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
    updateFileStatus('offManual', 'offManualImage');
    updateFileStatus('offDetail', 'offDetailImage');
    updateFileStatus('offAcc', 'offAccImage');
    updateFileStatus('offReg', 'offRegImage');
    updateFileStatus('offManda', 'offMandaImage');
    updateFileStatus('offUtil', 'offUtilImage');
    updateFileStatus('offSingle', 'offSingleImage');
    // location.reload();
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
setFileVisibility("<?php echo $offManual; ?>", "<?php echo $offManualSelect?>", 'offManual', 'offManualImage', "offManualButton");
setFileVisibility("<?php echo $offDetail; ?>", "<?php echo $offDetailSelect?>", 'offDetail', 'offDetailImage', "offDetailButton");
setFileVisibility("<?php echo $offAcc; ?>", "<?php echo $offAccSelect?>", 'offAcc', 'offAccImage', "offAccButton");
setFileVisibility("<?php echo $offReg; ?>", "<?php echo $offRegSelect?>", 'offReg', 'offRegImage', "offRegButton");
setFileVisibility("<?php echo $offManda; ?>", "<?php echo $offMandaSelect?>", 'offManda', 'offMandaImage', "offMandaButton");
setFileVisibility("<?php echo $offUtil; ?>", "<?php echo $offUtilSelect?>", 'offUtil', 'offUtilImage', "offUtilButton");
setFileVisibility("<?php echo $offSingle; ?>", "<?php echo $offSingleSelect?>", 'offSingle', 'offSingleImage', "offSingleButton");


</script>

<script>
function validateFileType() {
    var fileInputs = document.querySelectorAll('input[type=file]');
    var allowedExtensions = /(\.pdf)$/i;
    for (var i = 0; i < fileInputs.length; i++) {
        var fileInput = fileInputs[i];
        var filePath = fileInput.value;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload a PDF file only.');
            fileInput.value = '';
            return false;
        }
    }
}
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
showText('offManualDesc','21%');
showText('offDetailDesc','21%');
showText('offAccDesc','21%');
showText('offRegDesc','21%');
showText('offMandaDesc','21%');
showText('offUtilDesc','30%');
showText('offSingleDesc','30%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Office-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Office-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("Office-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("Office-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("Office-Form").submit();
});
</script>
<script>
document.getElementById("fileInput6").addEventListener("change", function() {
document.getElementById("Office-Form").submit();
});
</script>
<script>
document.getElementById("fileInput7").addEventListener("change", function() {
document.getElementById("Office-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    
    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

$('#offManualDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-officestats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'offManualDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#offDetailDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-officestats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'offDetailDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#offAccDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-officestats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'offAccDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#offRegDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-officestats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'offRegDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#offMandaDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-officestats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'offMandaDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#offUtilDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-officestats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'offUtilDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#offSingleDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-officestats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'offSingleDesc'}, 
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