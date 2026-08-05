<?php

// FTP server credentials
$ftpServer = '10.10.10.117';
$ftpUsername = 'ourbank-tech';
$ftpPassword = 'Juliuspogi2023';

// Parent folder path
$parentFolder = '/LOAN/';

// Subfolder name to create
$subfolderName = $_POST['customerFirstName'] + $_POST['customerSurname'] + $_POST['customerName'];

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

// Create the subfolder
$createSubfolder = ftp_mkdir($ftpConnection, $parentFolder . $subfolderName); 
if (!$createSubfolder) {
    die('Failed to create the subfolder');
}

// Close the FTP connection
ftp_close($ftpConnection);

echo 'Subfolder created successfully!';

?>


