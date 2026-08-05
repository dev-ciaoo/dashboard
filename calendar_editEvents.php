<?php
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php'; 

date_default_timezone_set('Asia/Manila');

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

function sendMail($userName, $receiver_userEmail){
    $mail = new PHPMailer(true);
    $filename = 'request10.jpg';
    $cid = 'my-attach';
    $mail->isSMTP();
    $mail->Host = 'ourbank.ph';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpdesk@ourbank.ph';
    $mail->Password = '0urb@nk-2021';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->isHTML(true);
    // $mail->AddEmbeddedImage("C:/xampp/htdocs/dashboard/request10.jpg", "my-attach", "request10.jpg");
    $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
    $mail->addAddress($receiver_userEmail);
    $mail->Subject = '[ RE-SCHEDULE REMINDER ] SETUP BY: ' . $userName;
    $mail->Body = 'Good day, <br><br>
                    Just to inform you there is a re-schedule posted in your calendar to your <a href="http://10.10.10.120/" target="_blank">Dashboard</a>.<br>
                    Kindly check it. 

                    <br><br>
                    Thank you.';

    $mail->send();
}

$newDate = $data['date'];
$newTime = $data['time'];
$newTimeTo = $data['timeTo'] ?? '';
$newText = $data['text'];
$newTags = $data['trimmedTags'];
$originalDate = $data['originalDate'];
$originalTime = $data['originalTime'];
$originalTimeTo = $data['originalTimeTo'] ?? '';
$originalText = $data['originalText'];
$originalEmail = $data['originalEmail']; // Retrieve original emails from the request
$creatorId = $_SESSION['userid'];
$userName = $_SESSION['username'];
// $stats = 1;

// Find existing events to update
$findQuery = "SELECT id, calendar_userEmail FROM duecalendar WHERE dateToday = ? AND setTime = ? AND calendar_msg = ? AND calendar_sender = ?";
$stmt = $con->prepare($findQuery);
$stmt->bind_param('sssi', $originalDate, $originalTime, $originalText, $creatorId);
$stmt->execute();
$result = $stmt->get_result();

$eventIds = [];
$existingEmails = [];
while ($row = $result->fetch_assoc()) {
    $eventIds[] = $row['id'];
    $existingEmails[] = $row['calendar_userEmail'];
    $receiverEmail2 = $row['calendar_userEmail'];
}

// Update existing events
$updateSuccess = true;
foreach ($eventIds as $eventId) {
    $updateQuery = "UPDATE duecalendar SET dateToday = ?, setTime = ?, setTimeTo = ?, calendar_msg = ? WHERE id = ?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param('ssssi', $newDate, $newTime, $newTimeTo, $newText, $eventId);
    
    if (!$stmt->execute()) {
        $updateSuccess = false;
        break;
    }
}

// Handle email deletion and update `updateStats`
$originalEmailsArray = explode(',', $originalEmail);
$deletedEmails = array_diff($originalEmailsArray, $newTags);
if ($updateSuccess && !empty($deletedEmails)) {
    foreach ($deletedEmails as $deletedEmail) {
        $updateStatsQuery = "UPDATE duecalendar SET updateStats = 1 WHERE calendar_userEmail = ? AND dateToday = ? AND setTime = ? AND calendar_msg = ?";
        $stmt = $con->prepare($updateStatsQuery);
        $stmt->bind_param('ssss', $deletedEmail, $newDate, $newTime, $newText);
        $stmt->execute();
    }
}

// Add new emails if there are any
$newEmails = array_diff($newTags, $existingEmails);
if ($updateSuccess && !empty($newEmails)) {
    $dateTime = date("h:i:s A");

    foreach ($newEmails as $newEmail) {
        $select = "SELECT userId, userEmail FROM accounts WHERE fullName = ?";
        $selectQry = $con->prepare($select);
        $selectQry->bind_param("s", $newEmail);
        $selectQry->execute();
        $selectQry->store_result();
        $selectQry->bind_result($receiver_userId, $receiver_userEmail);

        if ($selectQry->fetch()) {
            $save = "INSERT INTO `duecalendar` (`calendar_userName`, `calendar_userEmail`, `calendar_msg`, `calendar_sender`, `calendar_receiver`, `setTime`, `setTimeTo`, `dateToday`, `dateTime`)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $saveQry = $con->prepare($save);
            $saveQry->bind_param("sssisssss", $userName, $receiver_userEmail, $newText, $creatorId, $receiver_userId, $newTime, $newTimeTo, $newDate, $dateTime);

            if (!$saveQry->execute()) {
                $updateSuccess = false;
                break;
            } else {
                sendMail($userName, $receiver_userEmail);
                break;
            }
        } else {
            $updateSuccess = false;
            break;
        }
    }
}

if ($updateSuccess) {
    sendMail($userName, $receiverEmail2);
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update event.']);
}
?>