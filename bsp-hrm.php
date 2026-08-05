<?php
include('connection.php');
include('fileUploadBSP.php');

$selectIT = "SELECT * FROM `bsphr` WHERE id = 1";
$data = mysqli_query($con, $selectIT) ;
    if (!$data) {
        echo("Error description: " . mysqli_error($con));
    }else{
        while ($row = mysqli_fetch_array($data)) {
            $hrSum = $row['hrSum'];
            $hrCopy = $row['hrCopy'];
            $hrBoard = $row['hrBoard'];
            $hrOrg = $row['hrOrg'];
            $hrOfficer = $row['hrOfficer'];
            $hrPost = $row['hrPost'];
            $hrMember = $row['hrMember'];
            $hrEmp = $row['hrEmp'];
            $hrDuties = $row['hrDuties'];
            $hrTrain = $row['hrTrain'];
            $hrPol = $row['hrPol'];

            $hrSumSelect = $row['hrSumDesc'];
            $hrCopySelect = $row['hrCopyDesc'];
            $hrBoardSelect = $row['hrBoardDesc'];
            $hrOrgSelect = $row['hrOrgDesc'];
            $hrOfficerSelect = $row['hrOfficerDesc'];
            $hrPostSelect = $row['hrPostDesc'];
            $hrMemberSelect = $row['hrMemberDesc'];
            $hrEmpSelect = $row['hrEmpDesc'];
            $hrDutiesSelect = $row['hrDutiesDesc'];
            $hrTrainSelect = $row['hrTrainDesc'];
            $hrPolSelect = $row['hrPolDesc'];

            $hrSumStats = $row['hrSumStats'];
            $hrCopyStats = $row['hrCopyStats'];
            $hrBoardStats = $row['hrBoardStats'];
            $hrOrgStats = $row['hrOrgStats'];
            $hrOfficerStats = $row['hrOfficerStats'];
            $hrPostStats = $row['hrPostStats'];
            $hrMemberStats = $row['hrMemberStats'];
            $hrEmpStats = $row['hrEmpStats'];
            $hrDutiesStats = $row['hrDutiesStats'];
            $hrTrainStats = $row['hrTrainStats'];
            $hrPolStats = $row['hrPolStats'];
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
            $uploadDir = "bsphr/";
        
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
                    $sql = "INSERT INTO bsphr ($tableColumn) VALUES ('$targetFile')";
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
        <h3>HUMAN RESOURCE MANAGEMENT</h3>
</div>
<br><br><br>
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
    <div class="modal-content" style="height: 50%;">
        <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
        <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
    </div>
</div>
<div class= "container">
<form action="" method="POST" enctype="multipart/form-data" id="Hr-Form">
    <table class="table border">
        <tbody>
        <tr>
            <td class="col-sm-7 justify-center">
                1. Summary of Board Resolutions adopted from 01 January 2022 to latest available<br>&nbsp;&nbsp;&nbsp;certified complete and
                accurate by the Corporate Secretary.
                <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Josmin Alvarez)</strong>
            </td>
            <td>
                <input type="file" id="hrSum" name="hrSum"/><img id="hrSumImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrSum . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrSumButton" >Open File</button></a>
                <?php if($hrSumStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrSumDesc" name="hrSumDesc" value="<?= $hrSumSelect; ?>">
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrSumDesc" name="hrSumDesc" value="<?= $hrSumSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrSumSelect" name="hrSumSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrSum, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files', 'hrSum');
                    $sql = "SELECT * FROM bsphr WHERE id >= 2 AND hrSum != '' AND hrSum IS NOT NULL GROUP BY id ";
                    $result = $con->query($sql);
                            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $user = $row['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row['hrSum']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['hrSum'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['hrSum'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="1">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['hrSumDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrSumDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['hrSumDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrSumDesc" style="margin-top: -1.5rem;"/>';  
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
                2. Copies of all management compensation programs, including any incentive plans.
                <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrCopy" name="hrCopy"/><img id="hrCopyImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrCopy . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrCopyButton" >Open File</button></a>
                <?php if($hrCopyStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrCopyDesc" name="hrCopyDesc" value="<?= $hrCopySelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrCopyDesc" name="hrCopyDesc" value="<?= $hrCopySelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrCopySelect" name="hrCopySelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrCopy, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files2', 'hrCopy');
                    $sql2 = "SELECT * FROM bsphr WHERE id >= 2 AND hrCopy != '' AND hrCopy IS NOT NULL GROUP BY id ";
                    $result2 = $con->query($sql2);
                            
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $user = $row2['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row2['hrCopy']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['hrCopy'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['hrCopy'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="2">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['hrCopyDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrCopyDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['hrCopyDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrCopyDesc" style="margin-top: -1.5rem;"/>';      
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
               3. Latest Board-approved organizatioal charts for key functional areas, indicating<br>&nbsp;&nbsp;&nbsp;positions and name of
               officers responsible for each unit.
               <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrBoard" name="hrBoard"/><img id="hrBoardImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrBoard . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrBoardButton" >Open File</button></a>
                <?php if($hrBoardStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrBoardDesc" name="hrBoardDesc" value="<?= $hrBoardSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrBoardDesc" name="hrBoardDesc" value="<?= $hrBoardSelect; ?>">     
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrBoardSelect" name="hrBoardSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrBoard, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files3', 'hrBoard');
                    $sql3 = "SELECT  * FROM bsphr WHERE id >= 2 AND hrBoard != '' AND hrBoard IS NOT NULL GROUP BY id ";
                    $result3 = $con->query($sql3);
                            
                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            $user = $row3['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row3['hrBoard']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['hrBoard'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['hrBoard'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="3">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['hrBoardDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrBoardDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['hrBoardDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrBoardDesc" style="margin-top: -1.5rem;"/>'; 
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
              4. Plantilla of Organization (Directors/Officers/Other Personnel); Indicate positions,<br>&nbsp;&nbsp;&nbsp;residential addreses, birthdays, date hired/appointed.
              <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrOrg" name="hrOrg"/><img id="hrOrgImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrOrg . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrOrgButton" >Open File</button></a>
                <?php if($hrOrgStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrOrgDesc" name="hrOrgDesc" value="<?= $hrOrgSelect; ?>">
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrOrgDesc" name="hrOrgDesc" value="<?= $hrOrgSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrOrgSelect" name="hrOrgSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrOrg, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files4', 'hrOrg');
                    $sql4 = "SELECT  * FROM bsphr WHERE id >= 2 AND hrOrg != '' AND hrOrg IS NOT NULL GROUP BY id ";
                    $result4 = $con->query($sql4);
                            
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $user = $row4['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row4['hrOrg']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['hrOrg'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['hrOrg'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="4">';
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['hrOrgDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrOrgDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['hrOrgDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrOrgDesc" style="margin-top: -1.5rem;"/>';         
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
             5. Identifiers for directors and officers; Indicate Full Name (First Name, Middle Name,<br>&nbsp;&nbsp;&nbsp;Last Name, and Suffix),
             Mother's Maiden Name, Civil Status, TIN, Gender, Date of Birth,<br>&nbsp;&nbsp;&nbsp;Last Known Address, Position, Date of Appointment.
             <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrOfficer" name="hrOfficer"/><img id="hrOfficerImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrOfficer . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrOfficerButton" >Open File</button></a>
                <?php if($hrOfficerStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrOfficerDesc" name="hrOfficerDesc" value="<?= $hrOfficerSelect; ?>">
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrOfficerDesc" name="hrOfficerDesc" value="<?= $hrOfficerSelect; ?>">
                <?php } ?>
                    <input type="hidden" class="form-control" placeholder="REMARKS" id="hrOfficerSelect" name="hrOfficerSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrOfficer, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files5', 'hrOfficer');
                    $sql5 = "SELECT  * FROM bsphr WHERE id >= 2 AND hrOfficer != '' AND hrOfficer IS NOT NULL GROUP BY id ";
                    $result5 = $con->query($sql5);
                            
                    if ($result5->num_rows > 0) {
                        while ($row5 = $result5->fetch_assoc()) {
                            $user = $row5['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row5['hrOfficer']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['hrOfficer'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['hrOfficer'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="5">'; 
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row5['hrOfficerDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrOfficerDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['hrOfficerDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrOfficerDesc" style="margin-top: -1.5rem;"/>';      
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
             6. Details of provision for Post-Retirement Benefits, if any.
             <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrPost" name="hrPost"/><img id="hrPostImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrPost . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrPostButton" >Open File</button></a>
                <?php if($hrPostStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrPostDesc" name="hrPostDesc" value="<?= $hrPostSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrPostDesc" name="hrPostDesc" value="<?= $hrPostSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrPostSelect" name="hrPostSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrPost, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files6', 'hrPost');
                    $sql6 = "SELECT  * FROM bsphr WHERE id >= 2 AND hrPost != '' AND hrPost IS NOT NULL GROUP BY id ";
                    $result6 = $con->query($sql6);
                            
                    if ($result6->num_rows > 0) {
                        while ($row6 = $result6->fetch_assoc()) {
                            $user = $row6['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row6['hrPost']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row6['hrPost'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row6['hrPost'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row6['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="6">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row6['hrPostDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrPostDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row6['hrPostDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrPostDesc" style="margin-top: -1.5rem;"/>';       
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
             7. List of New Officers and Members of the Board from 01 January 2022 to latest available.
             <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrMember" name="hrMember"/><img id="hrMemberImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrMember . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrMemberButton" >Open File</button></a>
                <?php if($hrMemberStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrMemberDesc" name="hrMemberDesc" value="<?= $hrMemberSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrMemberDesc" name="hrMemberDesc" value="<?= $hrMemberSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrMemberSelect" name="hrMemberSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrMember, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files7', 'hrMember');
                    $sql7 = "SELECT * FROM bsphr WHERE id >= 2 AND hrMember != '' AND hrMember IS NOT NULL GROUP BY id ";
                    $result7 = $con->query($sql7);
                            
                    if ($result7->num_rows > 0) {
                        while ($row7 = $result7->fetch_assoc()) {
                            $user = $row7['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row7['hrMember']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row7['hrMember'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row7['hrMember'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row7['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="7">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row7['hrMemberDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrMemberDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;"  onchange="submitremarks(this)" value="' . $row7['hrMemberDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrMemberDesc" style="margin-top: -1.5rem;"/>';         
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
            8. List of seperated employees, officers/date separated/reason from 01 January 2022 to <br>&nbsp;&nbsp;&nbsp;latest available.
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrEmp" name="hrEmp"/><img id="hrEmpImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrEmp . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrEmpButton" >Open File</button></a>
                <?php if($hrEmpStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrEmpDesc" name="hrEmpDesc" value="<?= $hrEmpSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrEmpDesc" name="hrEmpDesc" value="<?= $hrEmpSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrEmpSelect" name="hrEmpSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrEmp, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files8', 'hrEmp');
                    $sql8 = "SELECT * FROM bsphr WHERE id >= 2 AND hrEmp != '' AND hrEmp IS NOT NULL GROUP BY id ";
                    $result8 = $con->query($sql8);
                            
                    if ($result8->num_rows > 0) {
                        while ($row8 = $result8->fetch_assoc()) {
                            $user = $row8['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row8['hrEmp']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row8['hrEmp'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row8['hrEmp'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row8['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="8">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row8['hrEmpDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrEmpDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row8['hrEmpDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrEmpDesc" style="margin-top: -1.5rem;"/>';    
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
           9. Copy of duties and responsibilities(job description) of officers and employees.
           <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrDuties" name="hrDuties"/><img id="hrDutiesImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrDuties . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrDutiesButton" >Open File</button></a>
                <?php if($hrDutiesStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrDutiesDesc" name="hrDutiesDesc" value="<?= $hrDutiesSelect; ?>">
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrDutiesDesc" name="hrDutiesDesc" value="<?= $hrDutiesSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrDutiesSelect" name="hrDutiesSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrDuties, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files9', 'hrDuties');
                    $sql9 = "SELECT * FROM bsphr WHERE id >= 2 AND hrDuties != '' AND hrDuties IS NOT NULL GROUP BY id ";
                    $result9 = $con->query($sql9);
                            
                    if ($result9->num_rows > 0) {
                        while ($row9 = $result9->fetch_assoc()) {
                            $user = $row9['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row9['hrDuties']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row9['hrDuties'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row9['hrDuties'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row9['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="9">'; 
                            if ($user >=92 & $user <= 96){ 
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row9['hrDutiesDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrDutiesDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row9['hrDutiesDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrDutiesDesc" style="margin-top: -1.5rem;"/>';      
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
            10. Complete list of trainings from 01 January 2022 to latest available including participants.
            <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            </td>
            <td>
                <input type="file" id="hrTrain" name="hrTrain"/><img id="hrTrainImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrTrain . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrTrainButton" >Open File</button></a>
                <?php if($hrTrainStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrTrainDesc" name="hrTrainDesc" value="<?= $hrTrainSelect; ?>">
                <?php }else { ?> 
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrTrainDesc" name="hrTrainDesc" value="<?= $hrTrainSelect; ?>"> 
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrTrainSelect" name="hrTrainSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrTrain, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files10', 'hrTrain');
                    $sql10 = "SELECT * FROM bsphr WHERE id >= 2 AND hrTrain != '' AND hrTrain IS NOT NULL GROUP BY id ";
                    $result10 = $con->query($sql10);
                            
                    if ($result10->num_rows > 0) {
                        while ($row10 = $result10->fetch_assoc()) {
                            $user = $row10['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row10['hrTrain']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row10['hrTrain'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row10['hrTrain'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row10['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="10">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row10['hrTrainDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrTrainDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row10['hrTrainDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrTrainDesc" style="margin-top: -1.5rem;"/>';    
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
          11. Hiring policies for Senior Management (including screening process).
          <br> &nbsp;&nbsp;&nbsp; <strong> (OIC: Christine Diane Alegre)</strong>
            <td>
                <input type="file" id="hrPol" name="hrPol"/><img id="hrPolImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $hrPol . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="hrPolButton" >Open File</button></a>
                <?php if($hrPolStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrPolDesc" name="hrPolDesc" value="<?= $hrPolSelect; ?>">
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="hrPolDesc" name="hrPolDesc" value="<?= $hrPolSelect; ?>">  
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="hrPolSelect" name="hrPolSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($hrPol, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files11', 'hrPol');
                    $sql11 = "SELECT * FROM bsphr WHERE id >= 2 AND hrPol != '' AND hrPol IS NOT NULL GROUP BY id ";
                    $result11 = $con->query($sql11);
                            
                    if ($result11->num_rows > 0) {
                        while ($row11 = $result11->fetch_assoc()) {
                            $user = $row11['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row11['hrPol']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row11['hrPol'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row11['hrPol'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-hrmdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row11['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="11">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row11['hrPolDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrPolDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row11['hrPolDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="hrPolDesc" style="margin-top: -1.5rem;"/>';      
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
var itForm = document.getElementById("Hr-Form");

function uploadFileI() {
  var ITFormData = new FormData(itForm);
  $.ajax({
    url: 'bsp-hr-UploadData.php', 
    type: 'POST',
    data: ITFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
    // AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
    updateFileStatus('hrSum', 'hrSumImage');
    updateFileStatus('hrCopy', 'hrCopyImage');
    updateFileStatus('hrBoard', 'hrBoardImage');
    updateFileStatus('hrOrg', 'hrOrgImage');
    updateFileStatus('hrOfficer', 'hrOfficerImage');
    updateFileStatus('hrPost', 'hrPostImage');
    updateFileStatus('hrMember', 'hrMemberImage');
    updateFileStatus('hrEmp', 'hrEmpImage');
    updateFileStatus('hrDuties', 'hrDutiesImage');
    updateFileStatus('hrTrain', 'hrTrainImage');
    updateFileStatus('hrPol', 'hrPolImage');
    // window.location.reload();
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
setFileVisibility("<?php echo $hrSum; ?>", "<?php echo $hrSumSelect?>", 'hrSum', 'hrSumImage', "hrSumButton");
setFileVisibility("<?php echo $hrCopy; ?>", "<?php echo $hrCopySelect?>", 'hrCopy', 'hrCopyImage', "hrCopyButton");
setFileVisibility("<?php echo $hrBoard; ?>", "<?php echo $hrBoardSelect?>", 'hrBoard', 'hrBoardImage', "hrBoardButton");
setFileVisibility("<?php echo $hrOrg; ?>", "<?php echo $hrOrgSelect?>", 'hrOrg', 'hrOrgImage', "hrOrgButton");
setFileVisibility("<?php echo $hrOfficer; ?>", "<?php echo $hrOfficerSelect?>", 'hrOfficer', 'hrOfficerImage', "hrOfficerButton");
setFileVisibility("<?php echo $hrPost; ?>", "<?php echo $hrPostSelect?>", 'hrPost', 'hrPostImage', "hrPostButton");
setFileVisibility("<?php echo $hrMember; ?>", "<?php echo $hrMemberSelect?>", 'hrMember', 'hrMemberImage', "hrMemberButton");
setFileVisibility("<?php echo $hrEmp; ?>", "<?php echo $hrEmpSelect?>", 'hrEmp', 'hrEmpImage', "hrEmpButton");
setFileVisibility("<?php echo $hrDuties; ?>", "<?php echo $hrDutiesSelect?>", 'hrDuties', 'hrDutiesImage', "hrDutiesButton");
setFileVisibility("<?php echo $hrTrain; ?>", "<?php echo $hrTrainSelect?>", 'hrTrain', 'hrTrainImage', "hrTrainButton");
setFileVisibility("<?php echo $hrPol; ?>", "<?php echo $hrPolSelect?>", 'hrPol', 'hrPolImage', "hrPolButton");


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
showText('hrSumDesc','21%');
showText('hrCopyDesc','21%');
showText('hrBoardDesc','21%');
showText('hrOrgDesc','21%');
showText('hrOfficerDesc','21%');
showText('hrPostDesc','21%');
showText('hrMemberDesc','50%');
showText('hrEmpDesc','50%');
showText('hrDutiesDesc','50%');
showText('hrTrainDesc','50%');
showText('hrPolDesc','50%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput6").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput7").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput8").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput9").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput10").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>
<script>
document.getElementById("fileInput11").addEventListener("change", function() {
document.getElementById("Hr-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

$('#hrSumDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrSumDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrCopyDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrCopyDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrBoardDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrBoardDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrOrgDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrOrgDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrOfficerDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrOfficerDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrPostDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrPostDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrMemberDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrMemberDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrEmpDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrEmpDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrDutiesDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrDutiesDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrTrainDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrTrainDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#hrPolDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-hrmstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'hrPolDesc'}, 
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