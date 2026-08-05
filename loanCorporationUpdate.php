<?php

include('connection.php');
include('fileuploadloan.php');

date_default_timezone_set('Asia/Manila');
$dateToday = date('M j, Y \a\t g:i A');
$corporationId = $_POST['corporationId'];
$fullname=$_POST['fullname'];
$salaryType=$_POST['salaryType'];

$companyProfile = $_FILES['companyProfile'];
$secRegistration = $_FILES['secRegistration'];
$latestGIS = $_FILES['latestGIS'];
$copyBRS = $_FILES['copyBRS'];
$copyidCST = $_FILES['copyidCST'];
$copyUpdatedBP = $_FILES['copyUpdatedBP'];
$transferCertTitle = $_FILES['transferCertTitle'];
$taxDeclaration = $_FILES['taxDeclaration'];
$taxDeclartionICTC = $_FILES['taxDeclartionICTC'];
$realStateReceipt = $_FILES['realStateReceipt'];
$realEstateTaxClearance = $_FILES['realEstateTaxClearance'];
$cdOfMorgage = $_FILES['cdOfMorgage'];
$proofOfIncome = $_FILES['proofOfIncome'];
$copySPR = $_FILES['copySPR'];
$copyIdPicture = $_FILES['copyIdPicture'];
$proofOfBilling = $_FILES['proofOfBilling'];

$file01 =  upload_file($companyProfile, 'corporation');
$file02 =  upload_file($secRegistration, 'corporation');
$file03 =  upload_file($latestGIS, 'corporation');
$file04 =  upload_file($copyBRS, 'corporation');
$file05 =  upload_file($copyidCST, 'corporation');
$file06 =  upload_file($copyUpdatedBP, 'corporation');
$file07 =  upload_file($transferCertTitle, 'corporation');
$file08 =  upload_file($taxDeclaration, 'corporation');
$file09 =  upload_file($taxDeclartionICTC, 'corporation');
$file10 =  upload_file($realStateReceipt, 'corporation');
$file11 =  upload_file($realEstateTaxClearance, 'corporation');
$file12 =  upload_file($cdOfMorgage, 'corporation');
$file13 =  upload_file($proofOfIncome, 'corporation');
$file14 =  upload_file($copySPR, 'corporation');
$file15 =  upload_file($copyIdPicture, 'corporation');
$file16 =  upload_file($proofOfBilling, 'corporation');
 
$ccompanyProfile = $file01['path'];
$csecRegistration = $file02['path'];
$clatestGIS = $file03['path'];
$ccopyBRS = $file04['path'];
$ccopyidCST = $file05['path'];
$ccopyUpdatedBP = $file06['path'];
$ctransferCertTitle = $file07['path'];
$ctaxDeclaration = $file08['path'];
$ctaxDeclartionICTC = $file09['path'];
$crealStateReceipt = $file10['path'];
$crealEstateTaxClearance = $file11['path'];
$ccdOfMorgage = $file12['path'];
$cproofOfIncome = $file13['path'];
$ccopySPR = $file14['path'];
$ccopyIdPicture = $file15['path'];
$cproofOfBilling = $file16['path'];

$sqlUpdate = "UPDATE corporation SET";

if (!empty($ccompanyProfile)) {
    $sqlUpdate .= " `ccompanyProfile` = '$ccompanyProfile',";
}

if (!empty($csecRegistration)) {
    $sqlUpdate .= " `csecRegistration` = '$csecRegistration',";
}

if (!empty($clatestGIS)) {
    $sqlUpdate .= " `clatestGIS` = '$clatestGIS',";
}

if (!empty($ccopyBRS)) {
    $sqlUpdate .= " `ccopyBRS` = '$ccopyBRS',";
}

if (!empty($ccopyidCST)) {
    $sqlUpdate .= " `ccopyidCST` = '$ccopyidCST',";
}

if (!empty($ccopyUpdatedBP)) {
    $sqlUpdate .= " `ccopyUpdatedBP` = '$ccopyUpdatedBP',";
}

if (!empty($ctransferCertTitle)) {
    $sqlUpdate .= " `ctransferCertTitle` = '$ctransferCertTitle',";
}

if (!empty($ctaxDeclaration)) {
    $sqlUpdate .= " `ctaxDeclaration` = '$ctaxDeclaration',";
}

if (!empty($ctaxDeclartionICTC)) {
    $sqlUpdate .= " `ctaxDeclartionICTC` = '$ctaxDeclartionICTC',";
}

if (!empty($crealStateReceipt)) {
    $sqlUpdate .= " `crealStateReceipt` = '$crealStateReceipt',";
}

if (!empty($crealEstateTaxClearance)) {
    $sqlUpdate .= " `crealEstateTaxClearance` = '$crealEstateTaxClearance',";
}

if (!empty($ccdOfMorgage)) {
    $sqlUpdate .= " `ccdOfMorgage` = '$ccdOfMorgage',";
}

if (!empty($cproofOfIncome)) {
    $sqlUpdate .= " `cproofOfIncome` = '$cproofOfIncome',";
}

if (!empty($ccopySPR)) {
    $sqlUpdate .= " `ccopySPR` = '$ccopySPR',";
}

if (!empty($ccopyIdPicture)) {
    $sqlUpdate .= " `ccopyIdPicture` = '$ccopyIdPicture',";
}

if (!empty($cproofOfBilling)) {
    $sqlUpdate .= " `cproofOfBilling` = '$cproofOfBilling',";
}


$sqlUpdate = rtrim($sqlUpdate, ","); // Remove the trailing comma

$sqlUpdate .= " WHERE `corpLoanId` = '$corporationId'";

$updateQuery = mysqli_query($con, $sqlUpdate);

$username = $_SESSION["username"];
    if($username=="vcdyoshino"){
        $password="Vincentcarl133";
    } 
    if($username=="ctborgonia"){
        $password="Tp043094r*";
    }

if ($updateQuery==true) {

    $ftpServer = '10.10.10.117';
    $ftpUsername = $username;
    $ftpPassword = $password;
  
    // Local file paths
    function addToLocalFiles(&$localFiles, $variable)
    {
        if (!empty($variable)) {
            $localFiles[] = $variable;
        }
    }
    $localFiles = [];

    addToLocalFiles($localFiles, $ccompanyProfile);
    addToLocalFiles($localFiles, $csecRegistration);
    addToLocalFiles($localFiles, $clatestGIS);
    addToLocalFiles($localFiles, $ccopyBRS);
    addToLocalFiles($localFiles, $ccopyidCST);
    addToLocalFiles($localFiles, $ccopyUpdatedBP);
    addToLocalFiles($localFiles, $ctransferCertTitle);
    addToLocalFiles($localFiles, $ctaxDeclaration);
    addToLocalFiles($localFiles, $ctaxDeclartionICTC);
    addToLocalFiles($localFiles, $crealStateReceipt);
    addToLocalFiles($localFiles, $crealEstateTaxClearance);
    addToLocalFiles($localFiles, $ccdOfMorgage);
    addToLocalFiles($localFiles, $cproofOfIncome);
    addToLocalFiles($localFiles, $ccopySPR);
    addToLocalFiles($localFiles, $ccopyIdPicture);
    addToLocalFiles($localFiles, $cproofOfBilling);
        
  
    // Connect to the FTP server
    $ftpConnection = ftp_ssl_connect($ftpServer);
    if (!$ftpConnection) {
        die('Failed to connect to the FTP server');
    }
  
    // Login to the FTP server
    $login = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
    if (!$login) {
        die('Failed to login to the FTP server');
    }
  
    // Enable passive mode (optional, depending on your server's configuration)
    ftp_pasv($ftpConnection, true);
    echo "CONNECTED";
  
    // Upload each file
    foreach ($localFiles as $localFile) {
        $localName = explode("/", $localFile)[1];

        $remoteFile = $username ."/" . $salaryType . "/" . $fullname . '/' . $localName;
  
       
  
        $upload = ftp_put($ftpConnection, $remoteFile, $localFile, FTP_BINARY);
        if ($upload) {
            echo 'File uploaded successfully!<br>';
        } else {
            echo 'Failed to upload the file<br>';
        }
    }
  
    // Close the FTP connection
    ftp_close($ftpConnection);
  
    echo 'All files uploaded successfully!';
  
} else {

      echo("try something else");

}

?>
