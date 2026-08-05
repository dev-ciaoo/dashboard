<?php
include('connection.php');
include('function.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$btnMicro = mysqli_real_escape_string($con, $_POST['btnWriteOffId']);

$selectLoan = "SELECT customerFullName FROM loan WHERE loan_Id = ?";
$stmt2 = $con->prepare($selectLoan);
if($stmt2 === false){
    die('Error: ' . htmlspecialchars($con->error));
}

$stmt2->bind_param('i', $btnMicro);
$customerFullName = 'Unknown';
if ($stmt2->execute()) {
    $result2 = $stmt2->get_result();
    if ($result2->num_rows > 0) {
        $customerFullName = $result2->fetch_assoc()['customerFullName'];
    }
}else{
    die('Error: ' . htmlspecialchars($con->error));
}

$primary="http://10.10.10.120/dashboard/linkMicro.php?id=";
$link = $primary . $btnMicro;
// $isLink = false;
// $inputLink = '';

$message = 'Requesting to write-off the account of <a href="' . htmlspecialchars($link) . '" target="_blank">' . htmlspecialchars($customerFullName) . '</a>.';

if($_SESSION['position'] !== 'BM' && $_SESSION['position'] !== 'Head'){
    $status = 0;
    // $isLink = true;
    // $inputValue = $message;
    // $inputLink = $link;
}else{
    $status = 1;
    // $isLink = true;
    // $inputValue = $message;
    // $inputLink = $link;
}
$stats  = 1;
// if (!isset($_SESSION['userid'])) {
//     die("Unauthorized access");
// }
$userId = $_SESSION['userid'];
$empId = $_SESSION["employeeId"];
$fullName = $_SESSION['fullname'];
$branch = $_SESSION['address'];
date_default_timezone_set('Asia/Manila');
$todayDate = date('F j, Y @ h:i:s A');
$email = $_SESSION['useremail'];
$department = $_SESSION['department'];
$image = "request/d41d8cd98f00b204e9800998ecf8427e.";
$position = $_SESSION['position'];

$updateSal = "INSERT INTO request 
                                (`r_user_Id`, `r_employee_Id`, `r_Name`, `r_Branch`, `r_myDate`, `r_Email`, `r_Position`, `r_userDepartment`, `r_Request`, `r_Image`, `r_Status`, `forWriteOff`, `loan_Id`)
                        VALUES 
                                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $con->prepare($updateSal);

if ($stmt === false) {
    die('Error: ' . htmlspecialchars($con->error));
}

$stmt->bind_param(
    'iissssssssiii', // ← now correct (13 types)
    $userId,
    $empId,
    $fullName,
    $branch,
    $todayDate,
    $email,
    $position,
    $department,
    $message,
    $image,
    $status,
    $stats,
    $btnMicro
);

if($stmt->execute()){
    $sessionEmail = $_SESSION['useremail'];
    $sessionName = $_SESSION['fullname'];
    $toEmail = 'helpdesk@ourbank.ph';

    $urlink = '<a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>';
//   $filename = 'request.jpg';
//   $cid = 'my-attach';
    $subject = 'Request For Written-Off Account';

    $mail = new PHPMailer(true);    
            
    $mail -> isSMTP();
    // $mail -> Host = 'smtp.gmail.com';
    $mail -> Host = 'ourbank.ph';
    $mail -> SMTPAuth = true;
    // $mail -> Username = 'ourbanktech@gmail.com';
    // $mail -> Password = 'pcgafzbvjwusqunp';
    $mail -> Username = 'helpdesk@ourbank.ph';
    $mail -> Password = '0urb@nk-2021';
    $mail -> SMTPSecure = 'ssl';
    $mail -> Port = 465;
            
    $mail -> setFrom($sessionEmail, $sessionName); // Sender
    $mail -> addAddress($toEmail); //receiver
    // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
            
    $mail -> isHTML(true);

    $mail -> Subject = '[ Requesting For Written-Off Account ] ' . $customerFullName;
                
    $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                    ';
            
      $mail -> send();

    echo 'Success';
}else{
    echo 'Error Executing Update SQL: ' . htmlspecialchars($con->error);
}

$stmt2->close();
$stmt->close();
$con->close();

?>