<?php 
include('connection.php');

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

function sendMail($fullName, $clientName, $emailTo, $dateToday){
    $mail = new PHPMailer(true);
    $filename = 'request10.jpg';
    $cid = 'my-attach';
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail->Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail -> isHTML(true);
    // $mail->AddEmbeddedImage("C:/xampp/htdocs/dashboard/request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress($emailTo);
    $mail->Subject = '[ PIPELINE FOLLOW-UP ] MADE BY: ' . $fullName;
    $mail->Body = 'Good day, <br><br>
                    Just to inform you there is new pipeline remarks posted in your <a href="http://10.10.10.120/" target="_blank">Dashboard</a>.<br>
                    Kindly check it. 
                    <br><br>
                    Client Name: <strong>' . $clientName . '</strong>

                    <br><br>
                    Thank you.';

    $mail->send();
}

$id = $_POST['id'];
$stats = 1;
$sqlApproved = "UPDATE `loan` SET `pipeStats` = '$stats' WHERE loan_Id='$id'";
$queryApproved = mysqli_query($con, $sqlApproved);

  if($queryApproved == true){
     
        $data = array(
            'status'=>'success',
        
        );

        echo json_encode($data);
    }
    else{
        $data = array(
            'status'=>'failed',
        
        );

        echo json_encode($data);
    } 

?>