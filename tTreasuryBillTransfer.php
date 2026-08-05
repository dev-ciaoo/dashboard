<?php 
include('connection.php');

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Manila');

function TBMailer2($bank, $branch, $balancee, $days, $interestR, $date, $netInterest,
    $email, $email2, $email3, $email4, $email5, $email6, $email7) {

    try {

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port = (int) ($_ENV['MAIL_PORT']);

        $mail->setFrom(
            $_ENV['MAIL_FROM_ADDRESS'],
            $_ENV['MAIL_FROM_NAME']
        );

        // emails array (safe handling)
        $emails = [$email,$email2,$email3,$email4,$email5,$email6,$email7];

        foreach ($emails as $e) {
            if (!empty($e) && filter_var($e, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress(trim($e));
            }
        }

        $mail->isHTML(true);

        $mail->Subject = "[ Closed ] $bank - PHP " . number_format($balancee, 2);

        $mail->Body = '
            Please click this link to view:
            <a target="_blank" href="http://10.10.10.120/dashboard/tTreasureBillReport.php">
            OUR Bank Treasury Bill Report</a>

            <br><br><strong>Bank:</strong> ' . htmlspecialchars($bank) . '
            <br><br><strong>Branch:</strong> ' . htmlspecialchars($branch) . '
            <br><br><strong>Per Value:</strong> ' . number_format($balancee, 2) . '
            <br><br><strong>Terms (Days):</strong> ' . $days . ' Days
            <br><br><strong>Interest Rate (%):</strong> ' . $interestR . '%
            <br><br><strong>Maturity Date:</strong> ' . $date . '
            <br><br><strong>Net Interest:</strong> ' . number_format($netInterest, 2) . '
        ';

        if (!$mail->send()) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        }

    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage());
    }
}

$id = $_POST['id'];
$currentDate = date('Y-m-d');

$selectBill = "SELECT * FROM `treasurybill` WHERE id='$id'";
$queryBill = mysqli_query($con, $selectBill);

if(mysqli_num_rows($queryBill) > 0){
  while($roww = mysqli_fetch_assoc($queryBill)){
    $tBank = $roww['tBank'];
    $tBranch = $roww['tBranch'];
    $tParValue = $roww['tParValue'];
    $tTerms = $roww['tTerms'];
    $tInterest = $roww['tInterest'];
    $tMaturity = $roww['tMaturity'];
    $tNetInterest = $roww['tNetInterest'];
    $tStats = $roww['tStats'];
    $tDate = $roww['dateAction'];

    $insertBill = "INSERT INTO `tbillarchived` (`tb_id`, `tbaBank`, `tbaBranch`, `tbaParValue`, `tbaTerms`, `tbaInterest`, `tbaMaturity`, `tbaNetInterest`, `tbaStats`, `dateAction`)
                                              VALUES
                                               ('$id', '$tBank', '$tBranch', '$tParValue', '$tTerms', '$tInterest', '$tMaturity', '$tNetInterest', '$tStats', '$tDate')"; // Fixed missing quotation mark
    $insertQuery = mysqli_query($con, $insertBill);
    if($insertQuery){
      $sql = "UPDATE `treasurybill` SET `tStats` = 1, `dateAction`='$currentDate' WHERE id='$id'";
      $updateQuest = mysqli_query($con, $sql);

      if($updateQuest){
        $selectCurrent = "SELECT * FROM `treasurybill` WHERE `tStats`= 1 AND `dateAction`='$currentDate' AND id='$id'";
        $queryCurrent = mysqli_query($con, $selectCurrent);
        if(mysqli_num_rows($queryCurrent) > 0){
          while($rowww = mysqli_fetch_assoc($queryCurrent)){
            $cBank = $rowww['tBank'];
            $cBranch = $rowww['tBranch'];
            $cParValue = $rowww['tParValue'];
            $cTerms = $rowww['tTerms'];
            $cInterest = $rowww['tInterest'];
            $cMaturity = $rowww['tMaturity'];
            $cNetInterest = $rowww['tNetInterest'];
            $cStats = 1;

            $insertBill2 = "INSERT INTO `tbillarchived` (`tb_id`, `tbaBank`, `tbaBranch`, `tbaParValue`, `tbaTerms`, `tbaInterest`, `tbaMaturity`, `tbaNetInterest`, `tbaStats`, `dateAction`)
                                              VALUES
                                               ('$id', '$cBank', '$cBranch', '$cParValue', '$cTerms', '$cInterest', '$cMaturity', '$cNetInterest', '$cStats', '$currentDate')"; // Fixed missing quotation mark
            $insertQuery2 = mysqli_query($con, $insertBill2);
          }
        }

        TBMailer2($tBank, $tBranch, $tParValue, $tTerms, $tInterest, $tMaturity, $tNetInterest, "ctborgonia@ourbank.ph", "jcvillanueva@ourbank.ph", "josmin.alvarez@ourbank.ph", "", "cesar_arnaldo@yahoo.com", "spascualmd@yahoo.com.ph", "perlita.nerona@ourbank.ph");
        $data = array(
          'status'=>'success',
        );
        echo json_encode($data);
      }
      else{
        $data = array(
          'status'=>'failed',
        );
        echo json_encode($data);
      } 
    }
  }
}


?>
