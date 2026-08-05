<?php 
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('connection.php');
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php'; 

date_default_timezone_set('Asia/Manila');
$dateToday = date('f j, Y @ h:i:s A');
$fullName = $_SESSION['fullname'];

function sendMail($fullName, $clientName, $emailTo, $emailTo2, $dateToday){
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
    $mail->addAddress($emailTo2);
    $mail->Subject = '[ PIPELINE REMARKS ] MADE BY: ' . $fullName;
    $mail->Body = 'Good day, <br><br>
                    Just to inform you there is new pipeline remarks posted in your <a href="http://10.10.10.120/" target="_blank">Dashboard</a>.<br>
                    Kindly check it. 
                    <br><br>
                    Client Name: <strong>' . $clientName . '</strong>

                    <br><br>
                    Thank you.';

    $mail->send();
}

    $id = $_POST['id'];
    $letterStatus = $_POST['letterStatus'];

    // Fetch the current pipeRemarks
    $sql = "SELECT `pipeRemarks`, `customerFullName`, `branch` FROM `loan` WHERE loan_Id='$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentLetterStatus = $row['pipeRemarks'];
        $clientName = $row['customerFullName'];
        $clientBranch = $row['branch'];

        if ($currentLetterStatus == '') {
            $currentLetterStatus = '';
        }

        if ($_SESSION['position'] == 'BM' || $_SESSION['username'] == 'dmsantos') {
            $letterSet = "BM: $letterStatus";
        } else {
            if($_SESSION['position'] != 'Head'){
                if($_SESSION['username'] == 'jalvarez'){
                    $letterSet = "GM: $letterStatus";
                }
            }else{
                $letterSet = "LOAN: $letterStatus";
            }
        }

        // Concatenate the new value with a line break and the existing pipeRemarks
        $updatedLetterStatus = $currentLetterStatus . "<br>" . $letterSet;

        // Update the `loan` table with the updated pipeRemarks
        $sql = "UPDATE `loan` SET `pipeRemarks` = '$updatedLetterStatus' WHERE loan_Id='$id'";
        $updateQuery = mysqli_query($con, $sql);

        if ($updateQuery) {
            $selectBM = "SELECT `userEmail` FROM accounts WHERE `address` = '$clientBranch' AND `userPosition` = 'BM' ";
            $qryBM = mysqli_query($con, $selectBM);

            if($qryBM){
                $data = mysqli_fetch_assoc($qryBM);
                $emailTo = $data['userEmail'];

                if($_SESSION['department'] == 15){
                    sendMail($fullName, $clientName, $emailTo, '', $dateToday);
                }else{
                    sendMail($fullName, $clientName, '', 'josmin.alvarez@ourbank.ph', $dateToday);
                }
                $data = array(
                    'status' => 'success',
                );
            }else{
                echo 'Error: ' . mysqli_error($con);
            }
        } else {
            $data = array(
                'status' => 'failed',
            );
        }

        echo json_encode($data);
    } else {
        $data = array(
            'status' => 'failed',
            'message' => 'Error fetching current remarks'
        );
        echo json_encode($data);
    }

?>
