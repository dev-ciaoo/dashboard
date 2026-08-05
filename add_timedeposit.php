<?php 
include('connection.php');
include('fileupload.php');

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');
$bankName = $_POST['bankName'];
$branchName = $_POST['branchName'];
$balance = $_POST['balance'];
$terms = $_POST['terms'];
$interestRate = $_POST['interestRate'];
$maturityDate  = $_POST['maturityDate'];
$uponInterest = $_POST['uponMaturity'];
$remarks = $_POST['remarks'];
$date = date('Y-m-d');

function TDMailer($bank, $branch, $balancee, $interestR, $days, $date, $uponM, $email, $email2, $email3, $email4, $email5, $email6){

    try {

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'ourbank.ph';
        $mail->SMTPAuth = true;
        $mail->Username = 'helpdesk@ourbank.ph';
        $mail->Password = '0urb@nk-2025N3w!@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');

        $emails = [$email, $email2, $email3, $email4, $email5, $email6];

        foreach($emails as $e){
            if(!empty($e) && filter_var($e, FILTER_VALIDATE_EMAIL)){
                $mail->addAddress(trim($e));
            }
        }

        $mail->isHTML(true);

        $mail->Subject = "[ New Time Deposit ] {$bank} - PHP " . number_format($balancee,2);

        $mail->Body = '
            Please click this link to view:
            <a target="_blank" href="https://10.10.10.120/dashboard/tTimeDepositforViewing.php">
            OUR Bank Time Deposit List</a>

            <br><br><strong>Bank:</strong> ' . $bank . '
            <br><br><strong>Branch:</strong> ' . $branch . '
            <br><br><strong>Balance:</strong> ' . number_format($balancee, 2) . '
            <br><br><strong>Interest Rate:</strong> ' . $interestR . '%
            <br><br><strong>Terms:</strong> ' . $days . ' Days
            <br><br><strong>Maturity Date:</strong> ' . $date . '
            <br><br><strong>Interest Upon Maturity:</strong> ' . number_format($uponM, 2) . '

            <br><br>
            Thank you for using the OUR Bank Dashboard.<br><br>

            Regards,<br>
            <strong>OUR Bank - Dashboard</strong><br>
            <em>This is an automated email. Please do not reply to this message.</em>';

        $mail->send();

        return true;

    } catch (Exception $e) {

        error_log($mail->ErrorInfo);
        return false;
    }
}

// $uponInterest = ($balance * $interestRate * $terms);
// $uponInterest2 = $uponInterest / 360;
// $uponInterest3 = $uponInterest2 * 0.80;

$sql = "INSERT INTO `timedeposit` (`dBank`, `dBranch`, `dBalance`, `dTerm`,  `dInterest`, `dMaturity`, `dUponMaturity`, `dRemarks`, `ddateAction`) 
                                VALUES 
                                   ('$bankName', '$branchName', '$balance', '$terms', '$interestRate', '$maturityDate', '$uponInterest', '$remarks', '$date')";
$query = mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);

    if($query == true){
        TDMailer($bankName, $branchName, $balance, $interestRate, $terms,  $maturityDate, $uponInterest, "ctborgonia@ourbank.ph", "jcvillanueva@ourbank.ph", "josmin.alvarez@ourbank.ph", "cesar_arnaldo@yahoo.com", "spascualjrmd@yahoo.com.ph", "perlita.nerona@ourbank.ph");
        $response['message'] = 'Successfully Added!';
        $response['result'] = true;
    }else{   
        $response['message'] = 'Something Wrong!';
    } 

die (json_encode($response));


