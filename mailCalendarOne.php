<?php 
include('connection.php');
ini_set('max_execution_time', '0');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

function TDMailer($userName, $rEmail, $textTo, $setDate) {
    // Define the current date
    $currentDate = date('Y-m-d');

    // 1 day
    $dueDate = date('Y-m-d', strtotime($setDate . ' -1 day'));

    // Check if the current date is exactly 1 day before the maturity date
    if ($currentDate == $dueDate) {
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
        $mail->addAddress($rEmail);
        $mail->Subject = '[ SCHEDULE TOMORROW REMINDER ] SETUP BY: ' . $userName;
        $mail->Body = 'Good day, <br><br>
                        Just to inform you there is scheduled posted in your calendar at <a href="http://10.10.10.120/" target="_blank">Dashboard</a>.<br>
                        Kindly check it. 
                        <br><br>
                        "' . $textTo . '"
                        <br><br>
                        Thank you.';

        try {
            $mail->send();
            echo 'Email has been sent successfully.<br>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "DATA ERROR: The current date is not 1 day before the scheduled date.<br>";
    }
}

$selectDate = "SELECT * FROM `duecalendar`";
$queryDate = mysqli_query($con, $selectDate);
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($queryDate) {
    while ($row = mysqli_fetch_assoc($queryDate)) {
        $userName = $row['calendar_userName'];    
        $receiverEmail = $row['calendar_userEmail'];
        $textTo = $row['calendar_msg'];
        $setDate = $row['dateToday'];

        $findEmail = "SELECT calendar_userEmail, dateToday FROM duecalendar WHERE calendar_userEmail = ? AND dateToday = ?";
        $stmt = $con->prepare($findEmail);
        $stmt->bind_param('ss', $receiverEmail, $setDate);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($rEmail, $getDate);

        if ($stmt->fetch()) {
            TDMailer($userName, $rEmail, $textTo, $setDate);
        } else {
            echo "Something went wrong: " . $con->error;
        }
        $stmt->close();
    }
} else {
    echo "NO DATA SELECTED";
}
?>
