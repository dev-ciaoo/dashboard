<?php 

include('connection.php');
ini_set('max_execution_time', '0');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

?>

INCOMING PAST DUE AND PAST DUE
<?php

$sqlSelect = "SELECT * FROM duecollection WHERE duecStatus <> 'PAST_DUE_WRITE_OFF'";
$data = mysqli_query($con, $sqlSelect);
ini_set('display_errors', 1);
error_reporting(E_ALL);

if($data){
    $pastDue = array();
    while ($row = mysqli_fetch_array($data)) {
        $duecBName = $row['duecBName'];    
        $productId =$row['duecProdID'];    
        $pastDue[] = $duecBName . " Product ID: " .$productId;
        }
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->isHTML(true);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    // CHANGE IT TO MARK FOR NOTIF
    // $mail->addAddress('ctborgonia@ourbank.ph');
    $mail->addAddress('majluna@ourbank.ph');
    $mail->Subject = "[TODAY] LISTS OF INCOMING PAST DUE & PAST DUE";
    $mail->Body = implode("<br><br>", $pastDue);
    $mail->send();
    }
  
    
else{
    echo "DATA ERROR". mysqli_error($con);
}

?>



