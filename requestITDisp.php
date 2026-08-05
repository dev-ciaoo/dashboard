<?php 
include('connection.php');
include('fileupload.php');

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;
      
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$id = $_POST['id'];
$reqRemarks = $_POST['reqRemarks'];
$sql = "UPDATE `request` SET `r_Status` = 5, `reqRemarks` = '$reqRemarks'  WHERE id='$id'";
$updateQuest = mysqli_query($con, $sql);

if($updateQuest == true) {

    $requestor = "SELECT * FROM `request` WHERE id = '$id'";
    $queryRequestor = mysqli_query($con, $requestor);
    if($data = mysqli_fetch_array($queryRequestor)){
        $user = $data['r_Name'];
        $rEmail = $data['r_Email'];
        $rMsg = $data['r_Request'];
        $remarks = $data['reqRemarks'];
        $fromEmail = 'helpdesk@ourbank.ph';
        $subject = '[ IT Request ] Disapproved';
        $mail = new PHPMailer(true);    
        $mail -> isSMTP();
        // $mail -> Host = 'smtp.gmail.com';
        $mail -> Host = 'ourbank.ph';
        $mail -> SMTPAuth = true;
        // $mail -> Username = 'ourbanktech@gmail.com';
        // $mail -> Password = 'pcgafzbvjwusqunp';
        $mail -> Username = 'helpdesk@ourbank.ph';
        $mail -> Password = '0urb@nk-2025N3w!@';
        $mail -> SMTPSecure = 'ssl';
        $mail -> Port = 465;
        // $mail->AddEmbeddedImage("Instruction2.jpg", "my-attach", "Instruction2.jpg");
                
        // $mail->addEmbeddedImage($filename, $cid);
                
        $mail -> setFrom($fromEmail, 'OUR Bank Dashboard');
                    
        $mail -> addAddress($rEmail); //receiver
        // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
                
        $mail -> isHTML(true);

        $mail -> Subject = '[ IT Request ] Disapproved';
                    
        $mail -> Body = 'Good day,<br><br>Just want to inform you that your IT Request is status is <i>"Rejected/Disapproved"</i>.<br><br>
                        Please see information below:<br><br>
                        Requestor: <strong>' . $user . '</strong><br><br>
                        Your Request Content: <strong>"' . $rMsg . '"</strong>.<br><br>
                        Reason Why Rejected: <strong>"' . $reqRemarks . '"</strong>.<br>
                        ';

        $mail -> send();
    }
    $data = array(
        'status'=>'success',
    
    );

    echo json_encode($data);
}else{
    $data = array(
        'status'=>'failed',
    
    );

    echo json_encode($data);
} 

?>