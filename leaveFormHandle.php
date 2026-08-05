<?php

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

if(isset($_POST['btnSubmit'])) {
$iName = $_POST['iName'];
$iEmail = $_POST['iEmail'];
$iBranch = $_POST['iBranch'];
// $iPosition = $_POST['iPosition'];
// $iDepartment = $_POST['iDepartment'];
$iCategory = $_POST['iCategory'];
$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];
$timeFrom = $_POST['timeFrom'];
$timeTo = $_POST['timeTo'];
$iMessage = $_POST['iMessage'];
$toEmail = 'ctborgonia@ourbank.ph';
$urlink = '<a target="_blank" href="http://localhost/dashboard/index.php">OUR Bank Dashboard</a>';
$filename = '1.jpeg';
$cid = 'my-attach';


    $mail = new PHPMailer(true);    

    $mail -> isSMTP();
    $mail -> Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = true;
    $mail -> Username = 'jborgonia44@gmail.com';
    $mail -> Password = 'fdqlythojpfqiyls';
    $mail -> SMTPSecure = 'ssl';
    $mail -> Port = 465;
    // $mail->AddEmbeddedImage("1.jpeg", "my-attach", "1.jpeg");

    $mail->addEmbeddedImage($filename, $cid);

    $mail -> setFrom($iEmail, $iName);

    $mail -> addAddress('ctborgonia@ourbank.ph'); //receiver

    $mail -> isHTML(true);
    
    $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://localhost/dashboard/index.php">OUR Bank Dashboard</a>
                    <br><br>See below image for the instruction: 
                    <br><br><img src="cid:my-attach">
                    <br>';

    $mail -> send();

    echo "
        <script>
        alert('Email Sent');
        </script>
        ";
    header("Refresh: 0");
    exit();
}
?>