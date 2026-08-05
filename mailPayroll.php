<?php 
include('connection.php');
ini_set('max_execution_time', '0');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

function PayrollMailer($month, $monthName, $cutOff, $email){
    global $con;
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail->Password = '0urb@nk-2025N3w!@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->isHTML(true);
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress($email);
    $mail->Subject = "[PAYROLL REMINDER] Approval - " . $month;
    $mail->Body = "Good day,<br><br>
                    Just want to remind you that you have pending Approval 
                    <br>of Payslip for the <strong>" . $cutOff . "</strong> of <strong>" . $monthName . " 2024</strong><br><br>
                    <i>Note: Disregard this message if already done.</i><br><br>
                    Thank you.";
    try {
        $mail->send();
        echo 'Email has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$currentDate = date('Y-m-d');
$currentDay = date('d');

if($currentDay == 13 || $currentDay == 28) {
    if($currentDay == 13 ){
        $month = date('F j, Y');
        $monthName = date('F');
        $cutOff = "First Cut-off";
        PayrollMailer($month, $monthName, $cutOff, 'cd.alegre@ourbank.ph');
    }else{
        $month = date('F j, Y');
        $monthName = date('F');
        $cutOff = "Last Cut-off";
        PayrollMailer($month, $monthName, $cutOff, 'cd.alegre@ourbank.ph');
    }
} else {
    echo "NOTIFICATION ERROR: Today is not the 13th or 28th.";
}

?>
