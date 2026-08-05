<?php
include('connection.php');
include('fileUploadBSP.php');

$selectIT = "SELECT * FROM `bspaudit` WHERE id = 1";
$data = mysqli_query($con, $selectIT) ;
    if (!$data) {
        echo("Error description: " . mysqli_error($con));
    }else{
        while ($row = mysqli_fetch_array($data)) {
            $audManual = $row['audManual'];
            $audList = $row['audList'];
            $audPlan = $row['audPlan'];
            $audReport = $row['audReport'];
            $audOut = $row['audOut'];

            $audManualSelect = $row['audManualDesc'];
            $audListSelect = $row['audListDesc'];
            $audPlanSelect = $row['audPlanDesc'];
            $audReportSelect = $row['audReportDesc'];
            $audOutSelect = $row['audOutDesc'];

            $audManualStats = $row['audManualStats'];
            $audListStats = $row['audListStats'];
            $audPlanStats = $row['audPlanStats'];
            $audReportStats = $row['audReportStats'];
            $audOutStats = $row['audOutStats'];


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
            $uploadDir = "bspaudit/";
        
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
                    $sql = "INSERT INTO bspaudit ($tableColumn) VALUES ('$targetFile')";
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
  <title>Internal Audit</title>
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
        <h3>INTERNAL AUDIT</h3>
</div>
<br><br><br>
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
    <div class="modal-content" style="height: 50%;">
        <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
        <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
    </div>
</div>
<div class= "container">
<form action="" method="POST" enctype="multipart/form-data" id="Audit-Form">
    <table class="table border">
        <tbody>
        <tr>
            <td class="col-sm-7 justify-center">
                1. Internal Audit Manuals, Policies and Procedures.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
            </td>
            <td>
                <input type="file" id="audManual" name="audManual"/><img id="audManualImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $audManual . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="audManualButton" >Open File</button></a>
                <?php if($audManualStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audManualDesc" name="audManualDesc" value="<?= $audManualSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audManualDesc" name="audManualDesc" value="<?= $audManualSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="audManualSelect" name="audManualSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($audManual, 30) .  "</span>" ?>
                <?php
                uploadFiles($con, 'files', 'audManual');
                    $sql = "SELECT  * FROM bspaudit WHERE id >= 2 AND audManual != '' AND audManual IS NOT NULL GROUP BY id ";
                    $result = $con->query($sql);
                            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $user = $row['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row['audManual']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['audManual'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['audManual'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-auditdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="1">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['audManualDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audManualDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['audManualDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audManualDesc" style="margin-top: -1.5rem;"/>';    
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
                2. List of all internal audits completed from 01 January 2022 to 31 March 2024<br>&nbsp;&nbsp;&nbsp;with their most recent audit
                report along with audit ratings assigned to each auditee.<br>&nbsp;&nbsp;&nbsp;Please indicate cut-off date of audits.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
            </td>
            <td>
            <input type="file" id="audList" name="audList"/><img id="audListImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $audList . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="audListButton" >Open File</button></a>
                <?php if($audListStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audListDesc" name="audListDesc" value="<?= $audListSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audListDesc" name="audListDesc" value="<?= $audListSelect; ?>"> 
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="audListSelect" name="audListSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($audList, 30) .  "</span>" ?>
                <?php
                uploadFiles($con, 'files2', 'audList');
                    $sql2 = "SELECT  * FROM bspaudit WHERE id >= 2 AND audList != '' AND audList IS NOT NULL GROUP BY id ";
                    $result2 = $con->query($sql2);
                            
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $user = $row2['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row2['audList']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['audList'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['audList'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-auditdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="2">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['audListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audListDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['audListDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audListDesc" style="margin-top: -1.5rem;"/>';
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
               3. Audit plans for previous and current years and compliance with audit plans for the<br>&nbsp;&nbsp;&nbsp;previous year.
               <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
            </td>
            <td>
                <input type="file" id="audPlan" name="audPlan"/><img id="audPlanImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $audPlan . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="audPlanButton" >Open File</button></a>
                <?php if($audPlanStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audPlanDesc" name="audPlanDesc" value="<?= $audPlanSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audPlanDesc" name="audPlanDesc" value="<?= $audPlanSelect; ?>">
                <?php } ?>


                <input type="hidden" class="form-control" placeholder="REMARKS" id="audPlanSelect" name="audPlanSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($audPlan, 30) .  "</span>" ?>
                <?php
                uploadFiles($con, 'files3', 'audPlan');
                    $sql3 = "SELECT * FROM bspaudit WHERE id >= 2 AND audPlan != '' AND audPlan IS NOT NULL GROUP BY id ";
                    $result3 = $con->query($sql3);
                            
                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            $user = $row3['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row3['audPlan']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['audPlan'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['audPlan'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-auditdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="3">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['audPlanDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audPlanDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['audPlanDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audPlanDesc" style="margin-top: -1.5rem;"/>';           
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files3[]" id="fileInput3"style="display: none;">
                <label for="fileInput3" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
              4. Special audit reports, if any, involving crimes and/or losses(from 01 January 2022 to<br>&nbsp;&nbsp;&nbsp;31 March 2024).
              <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
            </td>
            <td>
                <input type="file" id="audReport" name="audReport"/><img id="audReportImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $audReport . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="audReportButton" >Open File</button></a>
                <?php if($audReportStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audReportDesc" name="audReportDesc" value="<?= $audReportSelect; ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audReportDesc" name="audReportDesc" value="<?= $audReportSelect; ?>">      
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="audReportSelect" name="audReportSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($audReport, 30) .  "</span>" ?>
                <?php
                uploadFiles($con, 'files4', 'audReport');
                    $sql4 = "SELECT * FROM bspaudit WHERE id >= 2 AND audReport != '' AND audReport IS NOT NULL GROUP BY id ";
                    $result4 = $con->query($sql4);
                            
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $user = $row4['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row4['audReport']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['audReport'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['audReport'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-auditdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="4">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['audReportDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audReportDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['audReportDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audReportDesc" style="margin-top: -1.5rem;"/>';    
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files4[]" id="fileInput4"style="display: none;">
                <label for="fileInput4" style="cursor: pointer; font-size: 14px;">
                        <ion-icon name="add-circle-outline" size="medium"></ion-icon> ADD MORE
                </label>
            </td>
        </tr>
        <tr>
            <td>
             5. List of all outstanding excemptions and proposed corrective actions, deadlines for<br>&nbsp;&nbsp;&nbsp;implementation and the
             most recent update of progress.
             <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Cherissa D. Basco)</strong>
            </td>
            <td>
                <input type="file" id="audOut" name="audOut"/><img id="audOutImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $audOut . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="audOutButton" >Open File</button></a>
                <?php if($audOutStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audOutDesc" name="audOutDesc" value="<?= $audOutSelect; ?>">
                <?php }else { ?> 
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="audOutDesc" name="audOutDesc" value="<?= $audOutSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="audOutSelect" name="audOutSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($audOut, 30) .  "</span>" ?>
                <?php
                uploadFiles($con, 'files5', 'audOut');
                    $sql5 = "SELECT * FROM bspaudit WHERE id >= 2 AND audOut != '' AND audOut IS NOT NULL GROUP BY id ";
                    $result5 = $con->query($sql5);
                            
                    if ($result5->num_rows > 0) {
                        while ($row5 = $result5->fetch_assoc()) {
                            $user = $row5['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row5['audOut']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['audOut'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['audOut'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-auditdesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="5">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row5['audOutDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audOutDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['audOutDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="audOutDesc" style="margin-top: -1.5rem;"/>';     
                            }
                            echo '</form>';
                        }
                    } else {
                        // echo "No files uploaded yet.";
                    }
                ?>
                <br>
                <input type="file" name="files5[]" id="fileInput5"style="display: none;">
                <label for="fileInput5" style="cursor: pointer; font-size: 14px;">
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
var itForm = document.getElementById("Audit-Form");

function uploadFileI() {
  var ITFormData = new FormData(itForm);
  $.ajax({
    url: 'bsp-audit-UploadData.php', 
    type: 'POST',
    data: ITFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
    // AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
    updateFileStatus('audManual', 'audManualImage');
    updateFileStatus('audList', 'audListImage');
    updateFileStatus('audPlan', 'audPlanImage');
    updateFileStatus('audReport', 'audReportImage');
    updateFileStatus('audOut', 'audOutImage');
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
setFileVisibility("<?php echo $audManual; ?>", "<?php echo $audManualSelect?>", 'audManual', 'audManualImage', "audManualButton");
setFileVisibility("<?php echo $audList; ?>", "<?php echo $audListSelect?>", 'audList', 'audListImage', "audListButton");
setFileVisibility("<?php echo $audPlan; ?>", "<?php echo $audPlanSelect?>", 'audPlan', 'audPlanImage', "audPlanButton");
setFileVisibility("<?php echo $audReport; ?>", "<?php echo $audReportSelect?>", 'audReport', 'audReportImage', "audReportButton");
setFileVisibility("<?php echo $audOut; ?>", "<?php echo $audOutSelect?>", 'audOut', 'audOutImage', "audOutButton");
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
showText('audManualDesc','21%');
showText('audListDesc','21%');
showText('audPlanDesc','70%');
showText('audReportDesc','70%');
showText('audOutDesc','70%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Audit-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Audit-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("Audit-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("Audit-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("Audit-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

$('#audManualDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-auditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'audManualDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#audListDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-auditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'audListDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#audPlanDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-auditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'audPlanDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#audReportDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-auditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'audReportDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});
$('#audOutDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-auditstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'audOutDesc'}, 
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