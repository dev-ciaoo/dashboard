<?php
include('connection.php');
include('fileUploadBSP.php');

$selectIT = "SELECT * FROM `bspamla` WHERE id = 1";
$data = mysqli_query($con, $selectIT) ;
    if (!$data) {
        echo("Error description: " . mysqli_error($con));
    }else{
        while ($row = mysqli_fetch_array($data)) {
            $amlAnti = $row['amlAnti'];
            $amlCert = $row['amlCert'];
            $amlList = $row['amlList'];
            $amlStats = $row['amlStats'];

            $amlAntiSelect = $row['amlAntiDesc'];
            $amlCertSelect = $row['amlCertDesc'];
            $amlListSelect = $row['amlListDesc'];
            $amlStatsSelect = $row['amlStatsDesc'];

            $amlAntiStats = $row['amlAntiStats'];
            $amlCertStats = $row['amlCertStats'];
            $amlListStats = $row['amlListStats'];
            $amlStatsStats = $row['amlStatsStats'];
        
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
            $uploadDir = "bspamla/";
        
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
                    $sql = "INSERT INTO bspamla ($tableColumn) VALUES ('$targetFile')";
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
  <title></title>
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

</style>
<body oncontextmenu="return false;"> 
<button class="btn btn-secondary btn-md btnBack">Back</button>
<div class = "d-flex flex-column align-items-center  justify-content-center">
        <h3>COMPLIANCE WITH ANTI-MONEY LAUNDERING ACT (AMLA)</h3>
</div>
<br><br><br>
<!--Modal-->
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
    <div class="modal-header" style="float: right; justify-content: right; background-color: lightgrey; height: 30px; width: 100%; cursor: pointer;">
        <span class="close" id="closeModal" style="font-size: 2em; float: right;"><i class="fa-solid fa-xmark fa-sm" aria-hidden="true"></i></span>
    </div>
    <div class="modal-content" style="height: 50%;">
        <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
    </div>
</div>
<!--Modal-->
<div class= "container">
<form action="" method="POST" enctype="multipart/form-data" id="AMLA-Form">
    <table class="table border">
        <tbody>
        <tr>
            <td class="col-sm-7 justify-center">
                1.Anti-Money Laundering (AML) Manual and AMLA Compliance Audit Program.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="amlAnti" name="amlAnti"/><img id="amlAntiImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $amlAnti . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amlAntiButton" >Open File</button></a>
                <?php if($amlAntiStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control remarks1" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlAntiDesc" name="amlAntiDesc" value="<?= extractFileName($amlAntiSelect, 20); ?>">
                <?php }else{?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control remarks1" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlAntiDesc" name="amlAntiDesc" value="<?= extractFileName($amlAntiSelect, 20); ?>"> 
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="amlAntiSelect" name="amlAntiSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($amlAnti, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files', 'amlAnti');
                    $sql = "SELECT * FROM bspamla WHERE id >= 2 AND amlAnti != '' AND amlAnti IS NOT NULL GROUP BY id ";
                    $result = $con->query($sql);
                            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $user = $row['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row['amlAnti']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['amlAnti'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['amlAnti'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-amladesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="1">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['amlAntiDesc'] . '" type="text" class="form-control remarks1" placeholder="&nbsp; REMARKS" name="amlAntiDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['amlAntiDesc'] . '" type="text" class="form-control remarks1" placeholder="&nbsp; REMARKS" name="amlAntiDesc" style="margin-top: -1.5rem;"/>';    
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
                2. Certification from the Compliance Officer that the institution complies with the<br>&nbsp;&nbsp;&nbsp;record retention requirements for existing and new deposit accounts/transactions,
                <br>&nbsp;&nbsp;&nbsp;closed accounts and accounts involvedd in money laundering cases, <strong><i>If Any</i></strong>.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="amlCert" name="amlCert"/><img id="amlCertImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $amlCert . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amlCertButton" >Open File</button></a>
                <?php if($amlCertStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control remarks2" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlCertDesc" name="amlCertDesc" value="<?= extractFileName($amlCertSelect, 20); ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control remarks2" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlCertDesc" name="amlCertDesc" value="<?= extractFileName($amlCertSelect, 20); ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="amlCertSelect" name="amlCertSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($amlCert, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files2', 'amlCert');
                    $sql2 = "SELECT * FROM bspamla WHERE id >= 2 AND amlCert != '' AND amlCert IS NOT NULL GROUP BY id ";
                    $result2 = $con->query($sql2);
                            
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $user = $row2['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row2['amlCert']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['amlCert'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['amlCert'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-amladesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="2">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['amlCertDesc'] . '" type="text" class="form-control remarks2" placeholder="&nbsp; REMARKS" name="amlCertDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['amlCertDesc'] . '" type="text" class="form-control remarks2" placeholder="&nbsp; REMARKS" name="amlCertDesc" style="margin-top: -1.5rem;"/>';   
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
               3. List of Numbered Accounts Maintained and Non-resident accounts (please prepare<br>&nbsp;&nbsp;&nbsp;the customer identification documents of accounts to be sampled for further review)
               <br>&nbsp;&nbsp;&nbsp;in spreadsheet format including the following information <br>&nbsp;&nbsp;&nbsp;<strong><i>(If Applicable): Account number, type of account, date opened, and average balance.</i></strong>
               <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="amlList" name="amlList"/><img id="amlListImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $amlList . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amlListButton" >Open File</button></a>
                <?php if($amlListStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control remarks3" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlListDesc" name="amlListDesc" value="<?= extractFileName($amlListSelect, 20); ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control remarks3" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlListDesc" name="amlListDesc" value="<?= extractFileName($amlListSelect, 20); ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="amlListSelect" name="amlListSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($amlList, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files3', 'amlList');
                    $sql3 = "SELECT * FROM bspamla WHERE id >= 2 AND amlList != '' AND amlList IS NOT NULL GROUP BY id ";
                    $result3 = $con->query($sql3);
                            
                    if ($result2->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            $user = $row3['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row3['amlList']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row3['amlList'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row3['amlList'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-amladesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row3['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="3">'; 
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row3['amlListDesc'] . '" type="text" class="form-control remarks3" placeholder="&nbsp; REMARKS" name="amlListDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row3['amlListDesc'] . '" type="text" class="form-control remarks3" placeholder="&nbsp; REMARKS" name="amlListDesc" style="margin-top: -1.5rem;"/>';     
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
                4. Statistical information on number of Covered Transaction Reports and Suspicious <br>&nbsp;&nbsp;&nbsp;Transaction Reports submitted to AMLC since 01 January 2022.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Monica D. Gloria)</strong>
            </td>
            <td>
                <input type="file" id="amlStats" name="amlStats"/><img id="amlStatsImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $amlStats . "#toolbar=0"; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="amlStatsButton" >Open File</button></a>
                <?php if($amlStatsStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control remarks4" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlStatsDesc" name="amlStatsDesc" value="<?= extractFileName($amlStatsSelect, 20); ?>">
                <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control remarks4" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="amlStatsDesc" name="amlStatsDesc" value="<?= extractFileName($amlStatsSelect, 20); ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="amlStatsSelect" name="amlStatsSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($amlStats, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files4', 'amlStats');
                    $sql4 = "SELECT  * FROM bspamla WHERE id >= 2 AND amlStats != '' AND amlStats IS NOT NULL GROUP BY id ";
                    $result4 = $con->query($sql4);
                            
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $user = $row4['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row4['amlStats']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row4['amlStats'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row4['amlStats'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-amladesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row4['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="4">';
                            if ($user >=92 & $user <= 96){
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row4['amlStatsDesc'] . '" type="text" class="form-control remarks4" placeholder="&nbsp; REMARKS" name="amlStatsDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row4['amlStatsDesc'] . '" type="text" class="form-control remarks4" placeholder="&nbsp; REMARKS" name="amlStatsDesc" style="margin-top: -1.5rem;"/>';          
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
        </tbody>
    </table>
</form>
</div>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>

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
var itForm = document.getElementById("AMLA-Form");

function uploadFileI() {
  var ITFormData = new FormData(itForm);
  $.ajax({
    url: 'bsp-AMLA-UploadData.php', 
    type: 'POST',
    data: ITFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
    // AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
    updateFileStatus('amlAnti', 'amlAntiImage');
    updateFileStatus('amlCert', 'amlCertImage');
    updateFileStatus('amlList', 'amlListImage');
    updateFileStatus('amlStats', 'amlStatsImage');
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
setFileVisibility("<?php echo $amlAnti; ?>", "<?php echo $amlCertSelect?>", 'amlAnti', 'amlAntiImage', "amlAntiButton");
setFileVisibility("<?php echo $amlCert; ?>", "<?php echo $amlCertSelect?>", 'amlCert', 'amlCertImage', "amlCertButton");
setFileVisibility("<?php echo $amlList; ?>", "<?php echo $amlListSelect?>", 'amlList', 'amlListImage', "amlListButton");
setFileVisibility("<?php echo $amlStats; ?>", "<?php echo $amlStatsSelect?>", 'amlStats', 'amlStatsImage', "amlStatsButton");

</script>

<script>
function showText(className, position) {
    var modal = document.getElementById("myModal");
    var span = document.getElementById("closeModal");
    var elements = document.querySelectorAll('.' + className);
    var modalText = document.getElementById("modalText"); 

    // Iterate over all elements with the specified class and add event listeners
    elements.forEach(function(element) {
        // When the element is clicked, display the modal
        element.addEventListener("click", function () {
            modalText.textContent = element.value; // Set the modalText content
            modal.style.marginTop = position;
            modal.style.display = "block";
        });

        // Update the modal text if the input value changes (if applicable)
        element.addEventListener("input", function () {
            modalText.textContent = element.value; // Set the modalText content
        });
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

// Call the showText function for each class
showText('remarks1','21%');
showText('remarks2','21%');
showText('remarks3','21%');
showText('remarks4','21%');
</script>
<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("AMLA-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("AMLA-Form").submit();
});
</script>
<script>
document.getElementById("fileInput3").addEventListener("change", function() {
document.getElementById("AMLA-Form").submit();
});
</script>

<script>
document.getElementById("fileInput4").addEventListener("change", function() {
document.getElementById("AMLA-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }

    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

$('#amlAntiDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-amlastats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'amlAntiDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#amlCertDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-amlastats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'amlCertDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#amlListDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-amlastats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'amlListDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#amlStatsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-amlastats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'amlStatsDesc'}, 
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