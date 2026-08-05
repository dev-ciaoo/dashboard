<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('connection.php');
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php'; 

    function sendMail($file, $status, $email ,$name, $docs){
            $incomplete = explode('--', $status)[0];
            if(empty($file) && $status != "1" && $status != "3" || $incomplete == "2"){
                $mail = new PHPMailer(true);
                // $filename = 'request10.jpg';
                // $cid = 'my-attach';
                $mail->isSMTP();
                $mail->Host = 'ourbank.ph';
                $mail->SMTPAuth = true;
                $mail->Username = 'helpdesk@ourbank.ph';
                $mail -> Password = '0urb@nk-2025N3w!@';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail -> isHTML(true);
                // $mail->AddEmbeddedImage("C:/xampp/htdocs/dashboard/request10.jpg", "my-attach", "request10.jpg");
                $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
                $mail->addAddress($email);
                $mail->Subject = $name;
                $mail->Body = '<h5><span style="color: red;">REMINDER!!</span>
                                <br><br>This is an automated reminder from our system to notify you about the pending document upload on the dashboard. 
                                <br> Please ensure that the required documents are uploaded at your earliest convenience to complete the necessary process.
                                <br><br>Thank you for your timely attention to this matter.
                                <br><br><br><br><u>CLIENT/CUSTOMER:</u> <b>' . $name . ' </b>
                                <br><br><u>DOCUMENTS:</u> <b>' . $docs . ' </b>
                                <br><br>Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                                <br></h5>';

                $mail->send();
 
            }
    }
?>