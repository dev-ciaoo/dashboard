<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

include('connection.php');

header('Content-Type: application/json');

/* ======================
   VALIDATE INPUT
====================== */
$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Missing request ID'
    ]);
    exit;
}

/* ======================
   FETCH REQUEST
====================== */
$sql = "SELECT * FROM request WHERE r_Status = 2 AND id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'SQL prepare failed',
        'debug'   => $con->error
    ]);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Request not found or already processed'
    ]);
    exit;
}

$row = $result->fetch_assoc();

$r_toEmail  = $row['r_toEmail'];
$r_myEmail  = $row['r_Email'];
$r_Position = $row['r_Position'];
$r_details  = $row['r_Request'];

$stmt->close();

/* ======================
   SEND EMAIL
====================== */
$mail = new PHPMailer(true);
$config = require 'mail_config.php';

try {
    $mail->isSMTP();
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_user'];
    $mail->Password   = $config['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $config['smtp_port'];

    $mail->setFrom('helpdesk@ourbank.ph', 'Dashboard');

    // Receiver logic
    if ($r_Position === 'Staff') {
        $mail->addAddress($r_toEmail);
    } else {
        $mail->addAddress($r_myEmail);
    }

    $mail->isHTML(true);
    $mail->Subject = '[ Request IT Support ] Your Request for IT Support is Completed.';
    $mail->Body    = '
                        Please click this link to proceed:
                        <a target="_blank" href="https://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                        <br><br>
                        Details of Request:<br><br>
                        ' . nl2br(htmlspecialchars($r_details)) . '
                      ';

    $mail->send();

} catch (Exception $e) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Email sending failed',
        'debug'   => $mail->ErrorInfo
    ]);
    exit;
}

/* ======================
   UPDATE REQUEST STATUS
====================== */
$updateSql = "UPDATE request SET r_Status = 3, r_Priority = 0 WHERE id = ?";
$updateStmt = $con->prepare($updateSql);

if (!$updateStmt) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Update prepare failed',
        'debug'   => $con->error
    ]);
    exit;
}

$updateStmt->bind_param("i", $id);

if (!$updateStmt->execute()) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Failed to update request status',
        'debug'   => $updateStmt->error
    ]);
    exit;
}

$updateStmt->close();
$con->close();

/* ======================
   FINAL RESPONSE
====================== */
echo json_encode([
    'status'  => 'success',
    'message' => 'Work Done! Email Sent!'
]);
exit;
