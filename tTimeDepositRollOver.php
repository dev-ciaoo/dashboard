<?php 
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');
$id = $_POST['id'];

function TDMailer4($bank, $branch, $balancee, $interestR, $days, $date, $uponM,
    $remarks, $email, $email2, $email3, $email5, $email6, $email7) {

    try {

        $link = "http://10.10.10.120/dashboard/tTimeDepositforViewing.php";

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


        // collect emails safely
        $emails = [$email,$email2,$email3,$email5,$email6,$email7];

        foreach ($emails as $e) {
            if (!empty($e) && filter_var($e, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress(trim($e));
            }
        }

        $mail->isHTML(true);

        $mail->Subject = "[ Roll Over ] $bank - PHP " . number_format($balancee, 2);

        $mail->Body = '
            Please click this link to view:
            <a target="_blank" href="' . $link . '">
            OUR Bank Time Deposit Report</a>

            <br><br><strong>Bank:</strong> ' . htmlspecialchars($bank) . '
            <br><br><strong>Branch:</strong> ' . htmlspecialchars($branch) . '
            <br><br><strong>Balance:</strong> ' . number_format($balancee, 2) . '
            <br><br><strong>Interest Rate (%):</strong> ' . $interestR . '%
            <br><br><strong>Terms (Days):</strong> ' . $days . ' Days
            <br><br><strong>Maturity Date:</strong> ' . $date . '
            <br><br><strong>Interest Upon Maturity:</strong> ' . number_format($uponM, 2) . '
            <br><br><strong>Remarks:</strong> ' . htmlspecialchars($remarks) . '
        ';

        if (!$mail->send()) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        }

    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage());
    }
}

$currentDate = date('Y-m-d');

$selectBill = "SELECT * FROM `timedeposit` WHERE id='$id'";
$queryBill = mysqli_query($con, $selectBill);

if(mysqli_num_rows($queryBill) > 0){
  while($roww = mysqli_fetch_assoc($queryBill)){
    $dBank = $roww['dBank'];
    $dBranch = $roww['dBranch'];
    $dBalance = $roww['dBalance'];
    $dInterest = $roww['dInterest'];
    $dTerm = $roww['dTerm'];
    $dMaturity = $roww['dMaturity'];
    $dUponMaturity = $roww['dUponMaturity'];
    $dRemarks = $roww['dRemarks'];
    $dStats = 5; //if rollover and insert to timedepositarchived
    $date = $roww['ddateAction'];

    $insertBill = "INSERT INTO `timedepositarchived` (`td_id`, `tdaBank`, `tdaBranch`, `tdaBalance`, `tdaTerm`, `tdaInterest`, `tdaMaturity`, `tdaUponMaturity`, `tdaStats`, `tdaRemarks`, `ddateAction`)
                                                      VALUES
                                                     ('$id', '$dBank', '$dBranch', '$dBalance', '$dTerm', '$dInterest', '$dMaturity', '$dUponMaturity', '$dStats', '$dRemarks', '$date')";
    $insertQuery = mysqli_query($con, $insertBill);
    if($insertQuery){
      
      $rbankName = $_POST['rbankName'];
      $rbranchName = $_POST['rbranchName'];
      $rbalance = $_POST['rbalance'];
      $rinterestRate = $_POST['rinterestRate'];
      $rterms = $_POST['rterms'];
      $rmaturityDate = $_POST['rmaturityDate'];
      $ruponMaturity = $_POST['ruponMaturity'];
      $rremarks = $_POST['rremarks'];
      $tStatss = 4;

      $sql = "UPDATE `timedeposit` SET `dBank`='$rbankName', `dBranch`='$rbranchName', `dBalance`='$rbalance', `dInterest`='$rinterestRate', `dTerm`='$rterms', `dMaturity`='$rmaturityDate', `dUponMaturity`='$ruponMaturity', `dRemarks`='$rremarks', `dStats` = '$tStatss', `ddateAction`='$currentDate' WHERE id='$id'";
      $updateQuest = mysqli_query($con, $sql);
      if($updateQuest){
        $selectQuest = "SELECT * FROM `timedeposit` WHERE `dStats`= 4 AND `ddateAction`='$currentDate' AND id='$id'";
        $queryQuest = mysqli_query($con, $selectQuest);
        if(mysqli_num_rows($queryQuest) > 0){
          while($row = mysqli_fetch_assoc($queryQuest)){
            $cBank = $row['dBank'];
            $cBranch = $row['dBranch'];
            $cParValue = $row['dBalance'];
            $cTerms = $row['dTerm'];
            $cInterest = $row['dInterest'];
            $cMaturity = $row['dMaturity'];
            $cNetInterest = $row['dUponMaturity'];
            $cRemarks = $row['dRemarks'];
            $cStats = 4;

            $insertBill2 = "INSERT INTO `timedepositarchived` (`td_id`, `tdaBank`, `tdaBranch`, `tdaBalance`, `tdaInterest`, `tdaTerm`, `tdaMaturity`, `tdaUponMaturity`, `tdaStats`, `tdaRemarks`, `ddateAction`)
                                                             VALUES
                                                              ('$id', '$cBank', '$cBranch', '$cParValue', '$cInterest', '$cTerms', '$cMaturity', '$cNetInterest', '$cStats', '$cRemarks', '$currentDate')";
            $insertQuery2 = mysqli_query($con, $insertBill2);
          }
        }
        TDMailer4($rbankName, $rbranchName, $rbalance, $rinterestRate, $rterms, $rmaturityDate, $ruponMaturity, $rremarks, "ctborgonia@ourbank.ph", "jcvillanueva@ourbank.ph", "josmin.alvarez@ourbank.ph", "cesar_arnaldo@yahoo.com", "spascualjrmd@yahoo.com.ph", "perlita.nerona@ourbank.ph");
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
