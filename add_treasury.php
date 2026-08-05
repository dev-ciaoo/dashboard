<?php 
include('connection.php');

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Manila');
$bankName = $_POST['bankName'];
$branchName = $_POST['branchName'];
$parValue = $_POST['parValue'];
$terms = $_POST['terms'];
$interestRate = $_POST['interestRate'];
$maturityDate  = $_POST['maturityDate'];
$netInterest = $_POST['netInterest'];
$bondsBank = $_POST['bondsBank'];
$date = date('Y-m-d');
$tStats = 0;

if(!empty($bondsBank)){
    $bonds = 1;
}

function addTreasury($bank, $branch, $balancee, $days, $interestR, $date, $uponM,
    $email, $email2, $email3, $email5, $email6, $email7) {

    try {

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom(
            $_ENV['MAIL_FROM_ADDRESS'],
            $_ENV['MAIL_FROM_NAME']
        );

        // collect emails safely
        $emails = [$email,$email2,$email3,$email5,$email6,$email7];

        foreach ($emails as $e) {
            if (!empty($e) && filter_var($e, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress(trim($e));
            }
        }

        $mail->isHTML(true);

        $mail->Subject = "[ New Treasury Bill ] $bank - PHP " . number_format($balancee, 2);

        $mail->Body = '
            Please click this link to view:
            <a target="_blank" href="https://10.10.10.120/dashboard/tTreasuryBillforViewing.php">
            OUR Bank Treasury Bill List</a>

            <br><br><strong>Bank:</strong> ' . htmlspecialchars($bank) . '
            <br><br><strong>Branch:</strong> ' . htmlspecialchars($branch) . '
            <br><br><strong>Per Value:</strong> ' . number_format($balancee, 2) . '
            <br><br><strong>Terms:</strong> ' . $days . ' Days
            <br><br><strong>Interest Rate (%):</strong> ' . $interestR . '%
            <br><br><strong>Maturity Date:</strong> ' . $date . '
            <br><br><strong>Net Interest:</strong> ' . number_format($uponM, 2) . '

            <br><br>
            Thank you for using the OUR Bank Dashboard.<br><br>

            Regards,<br>
            <strong>OUR Bank - Dashboard</strong><br>
            <em>This is an automated email. Please do not reply to this message.</em>
        ';

        if (!$mail->send()) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        }

    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage());
    }
}
$sql = "INSERT INTO `treasurybill` (`tBank`, `tBranch`, `tParValue`, `tTerms`, `tInterest`, `tMaturity`, `tNetInterest`, `bonds`, `bondsBank`, `dateAction`) 
                                VALUES 
                                   ('$bankName', '$branchName', '$parValue', '$terms', '$interestRate', '$maturityDate', '$netInterest', '$bonds', '$bondsBank', '$date')";
$query = mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);   

    if($query){
        addTreasury($bankName, $branchName, $parValue, $terms, $interestRate, $maturityDate, $netInterest, "ctborgonia@ourbank.ph", "jcvillanueva@ourbank.ph", "josmin.alvarez@ourbank.ph", "cesar_arnaldo@yahoo.com", "spascualjrmd@yahoo.com.ph", "perlita.nerona@ourbank.ph");
        $response['message'] = 'Successfully Added!';
        $response['result'] = true;
    }else{   
        $response['message'] = 'Something Wrong!';
    } 
die (json_encode($response));
