<?php
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('connection.php');
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php'; 

date_default_timezone_set('Asia/Manila');

// Retrieve the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

function sendMail($userName, $emailTo, $dateTo, $textTo){
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
    $mail->Subject = '[ SCHEDULE REMINDER ] SETUP BY: ' . $userName;
    $mail->Body = 'Good day, <br><br>
                    Just to inform you there is schedule posted in your <a href="http://10.10.10.120/" target="_blank">Dashboard</a>.<br>
                    Kindly check it. 
                    <br><br>

                    "' . $textTo . '."

                    <br><br>
                    Thank you.';

    $mail->send();
}

if ($data) {
    $time = htmlspecialchars($data['time']);
    $text = htmlspecialchars($data['text']);
    $date = htmlspecialchars($data['date']);
    $tags = $data['trimmedTags']; // This should be an array
    $dateTime = date("h:i:s A");

    // $dateToday = date('F j, Y');

    $userId = $_SESSION['userid'];
    $userName = $_SESSION['username'];

    foreach ($tags as $tag) {
        $select = "SELECT userId, userEmail FROM accounts WHERE fullName = ?";
        $selectQry = $con->prepare($select);
        $selectQry->bind_param("s", $tag);
        $selectQry->execute();
        $selectQry->store_result();
        $selectQry->bind_result($receiver_userId, $receiver_userEmail);

        if ($selectQry->fetch()) {
            $save = "INSERT INTO `duecalendar` (`calendar_userName`, `calendar_userEmail`, `calendar_msg`, `calendar_sender`, `calendar_receiver`, `setTime`, `dateToday`, `dateTime`)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $saveQry = $con->prepare($save);
            $saveQry->bind_param("sssissss", $userName, $receiver_userEmail, $text, $userId, $receiver_userId, $time, $date, $dateTime);

            if (!$saveQry->execute()) {
                echo json_encode(["error" => "Something went wrong! " . $con->error]);
                exit();
            }else{
                sendMail($userName, $receiver_userEmail, $date, $text);
            }
        } else {
            echo json_encode(["error" => "Receiver not found for tag: $tag"]);
            exit();
        }
    }

    echo json_encode(["message" => "Event saved successfully."]);
} else {
    echo json_encode(["error" => "Invalid data received!"]);
}
?>
