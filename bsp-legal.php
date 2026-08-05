<?php
include('connection.php');
include('fileUploadBSP.php');

$selectIT = "SELECT * FROM `bsplegal` WHERE id = 1";
$data = mysqli_query($con, $selectIT) ;
    if (!$data) {
        echo("Error description: " . mysqli_error($con));
    }else{
        while ($row = mysqli_fetch_array($data)) {
            $legalReg = $row['legalReg'];
            $legalStats = $row['legalStats'];

            $legalRegSelect = $row['legalRegDesc'];
            $legalStatsSelect = $row['legalStatsDesc'];

            $legalRegStats = $row['legalRegStats'];
            $legalStatsStats = $row['legalStatsStats'];
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
            $uploadDir = "bsplegal/";
        
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
                    $sql = "INSERT INTO bsplegal ($tableColumn) VALUES ('$targetFile')";
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
        position: fixed;
        margin-left: 46px;
    }
</style>
<body oncontextmenu="return false;">   
<button class="btn btn-secondary btn-md btnBack">Back</button>
<div class = "d-flex flex-column align-items-center  justify-content-center">
        <h3>LEGAL MANAGEMENT</h3>
</div>
<br><br><br>
<div id="myModal" class="modal" style="margin-top: 5%; margin-left: 20%; width: 50%; height: 500px;">
    <div class="modal-content" style="height: 50%;">
        <span class="close" id="closeModal" style="font-size: 2em; margin-left: 95%"><i class="fa fa-times" aria-hidden="true"></i></span>
        <p><b><h1 id="modalText" style="font-size: 1.5em; text-align: center;"></h1></b></p>
    </div>
</div>
<div class= "container">
<form action="" method="POST" enctype="multipart/form-data" id="Legal-Form">
    <table class="table border">
        <tbody>
        <tr>
            <td class="col-sm-7 justify-center">
                1. List of reports regularly submitted to Board and/or Senior Management.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </td>
            <td>
                <input type="file" id="legalReg" name="legalReg"/><img id="legalRegImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $legalReg . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="legalRegButton" >Open File</button></a>
                <?php if($legalRegStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="legalRegDesc" name="legalRegDesc" value="<?= $legalRegSelect; ?>">
                <?php }else { ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="legalRegDesc" name="legalRegDesc" value="<?= $legalRegSelect; ?>">
                <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="legalRegSelect" name="legalRegSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($legalReg, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files', 'legalReg');
                    $sql = "SELECT * FROM bsplegal WHERE id >= 2 AND legalReg != '' AND legalReg IS NOT NULL GROUP BY id ";
                    $result = $con->query($sql);
                            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $user = $row['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row['legalReg']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row['legalReg'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row['legalReg'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-legaldesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="1">';
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row['legalRegDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="legalRegDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row['legalRegDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="legalRegDesc" style="margin-top: -1.5rem;"/>';     
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
                2. Inventory/Status of all legal cases involving the Bank, whether filed by or against<br>&nbsp;&nbsp;&nbsp;the Bank.
                <br> &nbsp;&nbsp;&nbsp; <strong>(OIC: Jonathan Quijano, Luisito Verder, Jesus Diokno)</strong>
            </td>
            <td>
                <input type="file" id="legalStats" name="legalStats"/><img id="legalStatsImage" src="statusImage/check.png" alt="statusImage">
                <a href="<?php echo $legalStats . '#toolbar=0'; ?>" target="_blank"><button type="button" class="btn btn-outline-success btnFile" id="legalStatsButton" >Open File</button></a>
                <?php if($legalStatsStats == 1){ ?>
                    <input style="background-color:#ADD8E6;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="legalStatsDesc" name="legalStatsDesc" value="<?= $legalStatsSelect; ?>">
               <?php }else{ ?>
                    <input style="background-color:#FFFFE0;" type="text" class="form-control" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS" id="legalStatsDesc" name="legalStatsDesc" value="<?= $legalStatsSelect; ?>">
               <?php } ?>
                <input type="hidden" class="form-control" placeholder="REMARKS" id="legalStatsSelect" name="legalStatsSelect" >&nbsp;
                <br>
                <?php echo "<span id='tag'>" . extractFileName1($legalStats, 30) .  "</span>" ?>
                <?php
                    uploadFiles($con, 'files2', 'legalStats');
                    $sql2 = "SELECT * FROM bsplegal WHERE id >= 2 AND legalStats != '' AND legalStats IS NOT NULL GROUP BY id ";
                    $result2 = $con->query($sql2);
                            
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $user = $row2['userid'];
                            echo '<img id="itChartImage"  src="statusImage/check.png" alt="statusImage"><br>';
                            echo "<a href='" . ($row2['legalStats']) . "' target='_blank'><button id='addChart2' class='btn btn-outline-success btnFile' onclick=\"openFile('" . $row2['legalStats'] . '#toolbar=0' . "')\">Open File <br>" . extractFileName2($row2['legalStats'], 20) . " </button></a><br>";
                            echo '<form class="formremarks" name="form_submit" action="bsp-legaldesc.php" method="post">';
                            echo '<input type="hidden" name="id" value="' . $row2['id'] . '">';
                            echo '<input type="hidden" name="form_submit" value="2">'; 
                            if ($user >=92 & $user <= 96){  
                            echo '<input style="background-color:#ADD8E6;" onchange="submitremarks(this)" value="' . $row2['legalStatsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="legalStatsDesc" style="margin-top: -1.5rem;"/>';
                            }else{
                                echo '<input style="background-color:#FFFFE0;" onchange="submitremarks(this)" value="' . $row2['legalStatsDesc'] . '" type="text" class="form-control remarks" placeholder="&nbsp; REMARKS" name="legalStatsDesc" style="margin-top: -1.5rem;"/>';     
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
        // Change the URL to the deOIC:ed page
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
var itForm = document.getElementById("Legal-Form");

function uploadFileI() {
  var ITFormData = new FormData(itForm);
  $.ajax({
    url: 'bsp-Legal-UploadData.php', 
    type: 'POST',
    data: ITFormData,
    processData: false,
    contentType: false,
    
    success: function(response) {
    // AUTOMATICALLY ADDS A CHECK ICON WHENEVER YOU SELECT IMAGE FROM YOUR LOCAL
    updateFileStatus('legalReg', 'legalRegImage');
    updateFileStatus('legalStats', 'legalStatsImage');

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
setFileVisibility("<?php echo $legalReg; ?>", "<?php echo $legalRegSelect?>", 'legalReg', 'legalRegImage', "legalRegButton");
setFileVisibility("<?php echo $legalStats; ?>", "<?php echo $legalStatsSelect?>", 'legalStats', 'legalStatsImage', "legalStatsButton");
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
showText('legalRegDesc','21%');
showText('legalStatsDesc','21%');
</script>
<script>
document.getElementById("fileInput").addEventListener("change", function() {
document.getElementById("Legal-Form").submit();
});
</script>
<script>
document.getElementById("fileInput2").addEventListener("change", function() {
document.getElementById("Legal-Form").submit();
});
</script>

<script>
    function openFile(fileUrl, id) {
        window.open(fileUrl, 'addChart2');
    }
    
    function submitremarks(input){
        $(input).closest('.formremarks').submit();
    }

$('#legalRegDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-legalstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'legalRegDesc'}, 
         success: function(response) {
             console.log(response);  
         },
         error: function(xhr, status, error) {
             console.error(xhr, status, error);
         }
     });
});

$('#legalStatsDesc').keyup(function(){
 
 $.ajax({
         url: 'bsp-legalstats.php', 
         type: 'POST',
         data: {data_to_retrieve: 'legalStatsDesc'}, 
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