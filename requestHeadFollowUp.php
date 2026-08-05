<?php 
include('connection.php');

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$id = $_POST['id'];
$sqlApproved = "UPDATE `request` SET `r_Status` = 7, `r_Priority` = 1 WHERE id='$id'";
$queryApproved = mysqli_query($con, $sqlApproved);

  if($queryApproved == true){
    
      $sessionEmail = $_SESSION['useremail'];
      $sessionName = $_SESSION['fullname'];
      $toEmail = 'helpdesk@ourbank.ph';

      $urlink = '<a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>';
      $filename = 'request.jpg';
      $cid = 'my-attach';
      $subject = 'Follow Up Request IT Support';

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
      $mail->AddEmbeddedImage("request.jpg", "my-attach", "request.jpg");
                
      $mail->addEmbeddedImage($filename, $cid);
                
      $mail -> setFrom($sessionEmail, $sessionName); // Sender
                    
      $mail -> addAddress('helpdesk@ourbank.ph'); //receiver
    //   $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
                
      $mail -> isHTML(true);

      $mail -> Subject = '[ Support ] Follow Up IT Request Support';
                    
      $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                      <br>';
                
      $mail -> send();
  
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