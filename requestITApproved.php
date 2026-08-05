<?php
include('connection.php');
header('Content-Type: application/json');

$id       = intval($_POST['id']);
$pLevel   = intval($_POST['pLevel']);
$assignTo = mysqli_real_escape_string($con, $_POST['assignTo']);

$sql = "
    UPDATE request
    SET r_Status = 2,
        r_PriorityLevel = $pLevel,
        r_AssignTo = '$assignTo'
    WHERE id = $id
";

if (!mysqli_query($con, $sql)) {
    echo json_encode(['status' => 'failed']);
    exit;
}

/**
 * 🚀 SEND RESPONSE FIRST (FAST)
 */
echo json_encode(['status' => 'success']);

/**
 * 🔥 Force output to browser immediately
 */
if (function_exists('fastcgi_finish_request')) {
    fastcgi_finish_request();
}

/**
 * ⬇️ EMAIL PROCESS CONTINUES HERE (NON-BLOCKING)
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$config = require 'mail_config.php';

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_user'];
    $mail->Password   = $config['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $config['smtp_port'];

    $mail->setFrom($_SESSION['useremail'], $_SESSION['fullname']);
    $mail->addAddress('helpdesk@ourbank.ph');
    $mail->isHTML(true);

    $mail->Subject = '[ Support ] Requesting IT Support';
    $mail->Body    = 'Please click this link to proceed:
                      <a href="http://10.10.10.120/dashboard/" target="_blank">
                      OUR Bank Dashboard</a>';

    $mail->send();

} catch (Exception $e) {
    // Optional: log email error instead of slowing UI
    error_log('Email Error: ' . $e->getMessage());
}

exit;
