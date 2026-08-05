<?php
include('connection.php');
include('fileUploadBSP.php');

$selectIT = "SELECT * FROM `bspit` WHERE id = 1";
$data = mysqli_query($con, $selectIT) ;
    if (!$data) {
        echo("Error description: " . mysqli_error($con));
    }else{
        while ($row = mysqli_fetch_array($data)) {
            $itChart = $row['itChart'];
            $itDocs = $row['itDocs'];
            $itBusiness = $row['itBusiness'];
            $itPlan = $row['itPlan'];
            $itStrats = $row['itStrats'];
            $itChartSelect = $row['itChartDesc'];
            $itDocsSelect = $row['itDocsDesc'];
            $itBusinessSelect = $row['itBusinessDesc'];
            $itPlanSelect = $row['itPlanDesc'];
            $itStratsSelect = $row['itStratsDesc'];

            $itChart2 = $row['itChart2'];

            $itChartStats = $row['itChartStats'];
            $itDocsStats = $row['itDocsStats'];
            $itBusinessStats = $row['itBusinessStats'];
            $itPlanStats = $row['itPlanStats'];
            $itStratsStats = $row['itStratsStats'];
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
        $uploadDir = "bspit/";
    
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
                $newFileName = $date . '_' . pathinfo($fileName, PATHINFO_FILENAME) . '' . $randomNumber . '.' . $fileType;
                $targetFile = $uploadDir . $newFileName;
            }
    
            // Upload the file
            if (move_uploaded_file($tmpName, $targetFile)) {
                // Insert file path into database
                $sql = "INSERT INTO bspit ($tableColumn) VALUES ('$targetFile')";
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

    h3{
      font-family: "Source Sans Pro", sans-serif;
      color: #656565;
      margin: 30px 0 20px;
    }
    #tag{
        font-size: 12px;
        color: #2E8B57;
        /* right: 23.8rem; */
        position: fixed;
        margin-left: 46px;
    }
    /* #fileInput, #fileInput2{
        position: relative;
        right: -35px;
    } */
</style>
<body oncontextmenu="return false;">   
<button class="btn btn-secondary btn-md btnBack">Back</button>
<br><br>
<div class = "d-flex flex-column align-items-center justify-content-center">
        <h3>INFORMATION TECHNOLOGY</h3>
</div>
<br>
<br>
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
    <div class="modal-content" style="height: 50%;">
        <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
        <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
    </div>
</div>

<div class= "container">
    <form method="post" enctype="multipart/form-data" id="IT-Form">
        <table class="table border">
            <tbody>
                <tr>
                    <td class="col-sm-7">
                        1. IT Organizational Chart.
                        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
                    </td>
                    <td class="col-sm-5">
                        <input type="file" id="itChart" name="itChart"/>
                        <img id="itChartImage"  src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $itChart . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itChartButton" >Open File</button></a>
                        <?php if($itChartStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control custom-input" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itChartDesc" name="itChartDesc" value="<?= $itChartSelect; ?>">
                        <?php } else { ?>
                            <input style="background-color:#FFFFE0;" type="text" class="form-control custom-input" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itChartDesc" name="itChartDesc" value="<?= $itChartSelect; ?>">
                        <?php } ?>
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($itChart, 30) .  "</span>" ?>
                        <input type="hidden" class="form-control" placeholder="REMARKS" id="itChartSelect" name="itChartSelect" >&nbsp;
                        <br>
                        <?php
                            uploadFiles($con, 'files', 'itChart');
                            $sql = "SELECT * FROM bspit WHERE id >= 2 AND itChart != '' AND itChart IS NOT NULL GROUP BY id ";
                            $result = $con->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $user = $row['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row['itChart']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['itChart'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['itChart'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-ITdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="1">'; 
                                    if ($user >=92 & $user <= 96){
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['itChartDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itChartDesc" style="margin-top: -1.5rem;"/>';
                                    }else{
                                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['itChartDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itChartDesc" style="margin-top: -1.5rem;"/>';   
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
                        2. Bank's network diagram including system documentation/data flow diagrams/process <br>&nbsp;&nbsp;&nbsp;flows.
                        <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
                    </td>
                    <td>
                        <input type="file" id="itDocs" name="itDocs"/><img id="itDocsImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $itDocs . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itDocsButton" >Open File</button></a>
                        <?php if($itDocsStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itDocsDesc" name = "itDocsDesc" value="<?= $itDocsSelect; ?>">
                        <?php } else { ?>
                            <input style="background-color:#FFFFE0;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itDocsDesc" name = "itDocsDesc" value="<?= $itDocsSelect; ?>">
                        <?php } ?>
                            <input  type="hidden" class="form-control" placeholder="REMARKS" id="itDocsSelect" name="itDocsSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($itDocs, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files2', 'itDocs');
                            $sql2 = "SELECT * FROM bspit WHERE id >= 2 AND itDocs != '' AND itDocs IS NOT NULL GROUP BY id ";
                            $result2 = $con->query($sql2);
                            
                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    $user = $row2['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row2['itDocs']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['itDocs'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['itDocs'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-ITdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="2">'; 
                                    if ($user >=92 & $user <= 96){
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['itDocsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itDocsDesc" style="margin-top: -1.5rem;"/>';
                                    }else{
                                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['itDocsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itDocsDesc" style="margin-top: -1.5rem;"/>';     
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
                    3. Business Continuity Plan and IT Manuals, Policies and Procedures.
                    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
                    </td>
                    <td>
                        <input type="file" id="itBusiness" name="itBusiness"/><img id="itBusinessImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $itBusiness . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itBusinessButton" >Open File</button></a>
                        <?php if($itBusinessStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itBusinessDesc" name = "itBusinessDesc" value="<?= $itBusinessSelect; ?>">
                        <?php } else { ?>
                            <input style="background-color:#FFFFE0;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itBusinessDesc" name = "itBusinessDesc" value="<?= $itBusinessSelect; ?>">
                        <?php } ?>
                        <input type="hidden" class="form-control" placeholder="REMARKS" id="itBusinessSelect" name="itBusinessSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($itBusiness, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files3', 'itBusiness');
                            $sql3 = "SELECT * FROM bspit WHERE id >= 2 AND itBusiness != '' AND itBusiness IS NOT NULL GROUP BY id ";
                            $result3 = $con->query($sql3);
                            
                            if ($result2->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    $user = $row3['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row3['itBusiness']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['itBusiness'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['itBusiness'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-ITdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="3">'; 
                                    if ($user >=92 & $user <= 96){
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['itBusinessDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itBusinessDesc" style="margin-top: -1.5rem;"/>';
                                    }else{
                                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['itBusinessDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itBusinessDesc" style="margin-top: -1.5rem;"/>';       
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
                    4. Types of programs or software being used in banking operations.
                    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
                    </td>
                    <td>
                        <input type="file" id="itPlan" name="itPlan"/><img id="itPlanImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $itPlan . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itPlanButton" >Open File</button></a>
                        <?php if($itBusinessStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itPlanDesc" name = "itPlanDesc" value="<?= $itPlanSelect; ?>">
                        <?php } else { ?>
                            <input style="background-color:#FFFFE0;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itPlanDesc" name = "itPlanDesc" value="<?= $itPlanSelect; ?>">
                        <?php } ?>
                            <input type="hidden" class="form-control" placeholder="REMARKS" id="itPlanSelect" name="itPlanSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($itPlan, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files4', 'itPlan');
                            $sql4 = "SELECT * FROM bspit WHERE id >= 2 AND itPlan != '' AND itPlan IS NOT NULL GROUP BY id ";
                            $result4 = $con->query($sql4);
                            
                            if ($result4->num_rows > 0) {
                                while ($row4 = $result4->fetch_assoc()) {
                                    $user = $row4['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row4['itPlan']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['itPlan'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['itPlan'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-ITdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="4">';
                                    if ($user >=92 & $user <= 96){ 
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['itPlanDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itPlanDesc" style="margin-top: -1.5rem;"/>';
                                    }else{
                                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['itPlanDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itPlanDesc" style="margin-top: -1.5rem;"/>';      
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
                    5. IT plans, including strategies applied to ensure security of back-up files, records and<br>&nbsp;&nbsp;&nbsp;Computers.
                    <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Julius C. Villanueva)</strong>
                    </td>
                    <td>
                        <input type="file" id="itStrats" name="itStrats"/><img id="itStratsImage" src="statusImage/check.png" alt="statusImage">
                        <a href="<?php echo $itStrats . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="itStratsButton" >Open File</button></a>
                        <?php if($itStratsStats == 1){ ?>
                            <input style="background-color:#ADD8E6;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itStratsDesc" name = "itStratsDesc" value="<?= $itStratsSelect; ?>">
                        <?php } else { ?>
                            <input style="background-color:#FFFFE0;" type="text" class="form-control remarks" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="itStratsDesc" name = "itStratsDesc" value="<?= $itStratsSelect; ?>">
                        <?php } ?>
                            <input type="hidden" class="form-control" placeholder="REMARKS" id="itStratsSelect" name="itStratsSelect" >&nbsp;
                        <br>
                        <?php echo "<span id='tag'>" . extractFileName1($itStrats, 30) .  "</span>" ?>
                        <?php
                            uploadFiles($con, 'files5', 'itStrats');
                            $sql5 = "SELECT * FROM bspit WHERE id >= 2 AND itStrats != '' AND itStrats IS NOT NULL GROUP BY id ";
                            $result5 = $con->query($sql5);
                            
                            if ($result5->num_rows > 0) {
                                while ($row5 = $result5->fetch_assoc()) {
                                    $user = $row5['userid'];
                                    echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                                    echo "<a href='" . ($row5['itStrats']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row5['itStrats'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row5['itStrats'], 20) . " </button></a><br>";
                                    echo '<form class="formremarks" name="form_submit" action="bsp-ITdesc.php" method="post">';
                                    echo '<input type="hidden" name="id" value="' . $row5['id'] . '">';
                                    echo '<input type="hidden" name="form_submit" value="5">'; 
                                    if ($user >=92 & $user <= 96){
                                    echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row5['itStratsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itStratsDesc" style="margin-top: -1.5rem;"/>';
                                    }else{
                                        echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row5['itStratsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="itStratsDesc" style="margin-top: -1.5rem;"/>';  
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
var itForm = document.getElementById("IT-Form");

function uploadFileI() {
  var ITFormData = new FormData(itForm);
  $.ajax({
    url: 'bsp-IT-UploadData.php', 
    type: 'POST',
    data: ITFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
      // AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
      updateFileStatus('itChart', 'itChartImage');
      updateFileStatus('itDocs', 'itDocsImage');
      updateFileStatus('itBusiness', 'itBusinessImage');
      updateFileStatus('itPlan', 'itPlanImage');
      updateFileStatus('itStrats', 'itStratsImage');
      window.location.reload();
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
setFileVisibility("<?php echo $itChart; ?>", "<?php echo $itChartSelect?>", 'itChart', 'itChartImage', "itChartButton");
setFileVisibility("<?php echo $itDocs; ?>", "<?php echo $itDocsSelect?>", 'itDocs', 'itDocsImage', "itDocsButton");
setFileVisibility("<?php echo $itBusiness; ?>", "<?php echo $itBusinessSelect?>", 'itBusiness', 'itBusinessImage', "itBusinessButton");
setFileVisibility("<?php echo $itPlan; ?>", "<?php echo $itPlanSelect?>", 'itPlan', 'itPlanImage', "itPlanButton");
setFileVisibility("<?php echo $itStrats; ?>", "<?php echo $itStratsSelect?>", 'itStrats', 'itStratsImage', "itStratsButton");

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
showText('itChartDesc','21%');
showText('itDocsDesc','21%');
showText('itBusinessDesc','30%');
showText('itPlanDesc','70%');
showText('itStratsDesc','70%');
</script>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("IT-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("IT-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("IT-Form").submit();
});
</script>
<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("IT-Form").submit();
});
</script>
<script>
document.getElementById("fileInput5").addEventListener("change", function() {
document.getElementById("IT-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }
</script>

<script>
$('#itChartDesc').keyup(function(){
 
        $.ajax({
                url: 'bsp-ITstats.php', 
                type: 'POST',
                data: {data_to_retrieve: 'itChartDesc'}, 
                success: function(response) {
    
                    console.log(response);  
                },
                error: function(xhr, status, error) {
                  
                    console.error(xhr, status, error);
                }
            });
});
$('#itDocsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-ITstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'itDocsDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});
$('#itDocsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-ITstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'itDocsDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#itBusinessDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-ITstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'itBusinessDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});

$('#itPlanDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-ITstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'itPlanDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
           
             console.error(xhr, status, error);
         }
     });
});
   
$('#itStratsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-ITstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'itStratsDesc'}, 
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