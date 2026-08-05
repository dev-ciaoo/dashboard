<?php 
include('connection.php');
ini_set('max_execution_time', '0');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

function format_number($number) {
    // Use number_format to format the number with commas for every thousand
    $formatted_number = number_format($number);


}

function TDMailer($bank, $branch, $balancee, $interestR, $days, $date, $uponM, $remarks, $email, $email2, $email3, $email4, $email5, $email6, $email7, $maturityDate){
    global $con;
    // Define the current date
    $currentDate = date('Y-m-d');

    // Define the due date based on the maturity date and the condition for sending the email (1 day before maturity)
    $dueDate = date('Y-m-d', strtotime($maturityDate . ' -1 day'));

    // Check if the current date is exactly 1 day before the maturity date
    if($currentDate == $dueDate){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ourbank.ph';
        $mail->SMTPAuth = true;
        $mail->Username = 'helpdesk@ourbank.ph';
        $mail -> Password = '0urb@nk-2025N3w!@';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail -> isHTML(true);
        $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
        $mail->addAddress($email);
        $mail->addAddress($email2);
        $mail->addAddress($email3);
        $mail->addAddress($email4);
        $mail->addAddress($email5);
        $mail->addAddress($email6);
        $mail->addAddress($email7);
        $mail->Subject = "[INCOMING 1 DAY] MATURITY - $bank ($balancee)";
        $mail->Body = "Bank: <strong>$bank</strong><br><br>
                        Branch: <strong>$branch</strong><br><br>
                        Balance: <strong>&#8369;$balancee</strong><br><br>
                        Interest: <strong>$interestR%</strong><br><br>
                        Term: <strong>$days </strong>Days<br><br>
                        Maturity: <strong>$date</strong><br><br>
                        Interest Upon Maturity: <strong>&#8369;$uponM</strong>
                        <br><br>Remarks: <strong>$remarks</strong>";
        try {
            $mail->send();
            echo 'Email has been sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "DATA ERROR: The current date is not 1 day before the maturity date.";
    }
}

$selectDate = "SELECT * FROM `timedeposit`";
$queryDate = mysqli_query($con, $selectDate);
ini_set('display_errors', 1);
error_reporting(E_ALL);

if($queryDate){
    while ($row = mysqli_fetch_array($queryDate)) {
        $bankName = $row['dBank'];    
        $branchName = $row['dBranch'];
        $formatted_balance = number_format($row['dBalance'], 2, '.', ',');
        $dBalance = $formatted_balance;
        $dInterest = $row['dInterest'];
        $dTerm = $row['dTerm'];
        $dMaturity = $row['dMaturity'];
        $formatted_net_interest = number_format($row['dUponMaturity'], 2, '.', ',');
        $dUponMaturity = $formatted_net_interest;
        $dRemarks = $row['dRemarks'];

        // Example usage of the function
        TDMailer($bankName, $branchName, $dBalance, $dInterest, $dTerm, $dMaturity, $dUponMaturity, $dRemarks, "ctborgonia@ourbank.ph", "jcvillanueva@ourbank.ph", "josmin.alvarez@ourbank.ph", "", "cesar_arnaldo@yahoo.com", "spascualjrmd@yahoo.com.ph", "perlita.nerona@ourbank.ph", $dMaturity);
    }
} else {
    echo "NO DATA SELECTED";
}
?>
