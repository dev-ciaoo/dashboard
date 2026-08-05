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

    $id = $_POST['did'];
    $letterStatus = $_POST['dletterStatus'];
    $stats = 2;

    // Fetch the current pipeRemarks
    $sql = "SELECT * FROM `loan` WHERE loan_Id='$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $clientName = $row['customerFullName'];
        $clientBranch = $row['branch'];
        $loanId = $row['loan_Id'];
        $prodId = $row['productID'];

        // Update the `loan` table with the updated pipeRemarks
        $sql = "UPDATE `loan` SET `pipeRemarks` = '$letterStatus', `pipeStats` = '$stats' WHERE loan_Id='$id'";
        $updateQuery = mysqli_query($con, $sql);

        if ($updateQuery) {
            $insertSql = "INSERT INTO loanarchive (`x_loanId`, `x_customerFullName`, `x_branch`, `x_pipeRemarks`, `x_productId`)
                                        VALUES 
                                                 ('$loanId', '$clientName', '$clientBranch', '$letterStatus', '$prodId')
                        ";
            $insertQry = mysqli_query($con, $insertSql);

            if(!$insertQry){
                echo "Error: " . mysqli_error($con); 
            }else{
                $selectBM = "SELECT `userEmail` FROM accounts WHERE `address` = '$clientBranch' AND `userPosition` = 'BM' ";
                $qryBM = mysqli_query($con, $selectBM);

                if($qryBM){
                    $data = mysqli_fetch_assoc($qryBM);
                    $emailTo = $data['userEmail'];

                    if($_SESSION['department'] == 15){
                        // sendMail($fullName, $clientName, $emailTo, '', $dateToday);
                    }else{
                        // sendMail($fullName, $clientName, 'lkescano@ourbank.ph', 'josmin.alvarez@ourbank.ph', $dateToday);
                    }
                    $data = array(
                        'status' => 'success',
                    );
                }else{
                    echo 'Error: ' . mysqli_error($con);
                }
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
