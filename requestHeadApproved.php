<?php 
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$id = mysqli_real_escape_string($con, $_POST['id']);
date_default_timezone_set("Asia/Manila");
$todayDate = date('F j, Y @ g:i A');
$approverName = $_SESSION['username'];

$select = "SELECT r_Request, loan_Id, r_Branch FROM `request` WHERE id = ?";
$stmt = $con->prepare($select);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

$r_Request = $row['r_Request'] ?? '';
$loan_Id = $row['loan_Id'] ?? '';
if($row['r_Branch'] == 'Head Office') {
  $toEmail = 'perlita.nerona@ourbank.ph';
}elseif($row['r_Branch'] == 'Noveleta'){
  $toEmail = "karen.dianne.dampitan@ourbank.ph";
}elseif($row['r_Branch'] == 'Poblacion'){
  $toEmail = "jacklyn.sarique@ourbank.ph";
}elseif($row['r_Branch'] == 'Manggahan'){
  $toEmail = "jennifer.giron@ourbank.ph";
}elseif($row['r_Branch'] == 'Ternate'){
  $toEmail = "melvin.tabanan@ourbank.ph";
}elseif($row['r_Branch'] == 'Magallanes'){
  $toEmail = "joan.reduca@ourbank.ph";
}elseif($row['r_Branch'] == 'Maragondon'){
  $toEmail = "melody.ruazol@ourbank.ph";
} else{
  $toEmail = "ctborgonia@ourbank.ph";
}


if(stripos($r_Request, 'write-off') !== false) {
    $status = 3;
    $stats = 1;
}else{
    $status = 6;
}

$sqlApproved = "UPDATE `request` SET `r_Status` = ?, `r_approver` = ?, `r_timeApproved` = ? WHERE id = ?";
$stmt2 = $con->prepare($sqlApproved);
$stmt2->bind_param("issi", $status, $approverName, $todayDate, $id);
$queryApproved = $stmt2->execute();


  if($queryApproved == true){
    if($row['loan_Id'] !== '') {
        $updLoan = "UPDATE `loan` SET `writeOff` = ? WHERE loan_Id = ?";
        $stmt3 = $con->prepare($updLoan);
        $stmt3->bind_param("ii", $stats, $loan_Id);
        if($stmt3->execute()) {
            $stmt3->close();
        }else{
            echo 'Error: ' . htmlspecialchars($con->error);
            exit();
        }
        
    }
    $stmt2->close();
    $con->close();
    
    $sessionEmail = $_SESSION['useremail'];
    $sessionName = $_SESSION['fullname'];
    

    $urlink = '<a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>';
    //   $filename = 'request.jpg';
    //   $cid = 'my-attach';
    $subject = 'Requesting IT Support';

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
              
    $mail -> setFrom($sessionEmail, $sessionName); // Sender
    $mail -> addAddress($toEmail); //receiver
    // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
              
    $mail -> isHTML(true);

    $mail -> Subject = '[ Support ] Requesting IT Support';
                  
    $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    ';
              
    $mail -> send();

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