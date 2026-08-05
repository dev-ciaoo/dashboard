<?php 
include('connection.php');

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

date_default_timezone_set('Asia/Manila');

function TDMailer2($bank, $branch, $balancee, $interestR, $days, $date, $UponMaturity, $remarks,
                    $email, $email2, $email3, $email5, $email6, $email7) {

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

        $emails = [$email, $email2, $email3, $email5, $email6, $email7];

        foreach($emails as $e){
            if(!empty($e) && filter_var($e, FILTER_VALIDATE_EMAIL)){
                $mail->addAddress(trim($e));
            }
        }

        $mail->isHTML(true);

        $mail->Subject = "[ Transferred ] $bank - PHP " . number_format($balancee, 2);

        $mail->Body = '
            Please click this link to view:
            <a target="_blank" href="http://10.10.10.120/dashboard/tTimeDepositReport.php">
            OUR Bank Time Deposit Report</a>

            <br><br><strong>Bank:</strong> ' . htmlspecialchars($bank) . '
            <br><br><strong>Branch:</strong> ' . htmlspecialchars($branch) . '
            <br><br><strong>Balance:</strong> ' . number_format($balancee, 2) . '
            <br><br><strong>Interest Rate (%):</strong> ' . $interestR . '%
            <br><br><strong>Terms (Days):</strong> ' . $days . ' Days
            <br><br><strong>Maturity Date:</strong> ' . $date . '
            <br><br><strong>Interest Upon Maturity:</strong> ' . $UponMaturity . '
            <br><br><strong>Remarks:</strong> ' . htmlspecialchars($remarks) . '
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
    $dStats = $roww['dStats'];
    $dRemarks = $roww['dRemarks'];
    $date = $roww['ddateAction'];

    $insertBill = "INSERT INTO `timedepositarchived` (`td_id`, `tdaBank`, `tdaBranch`, `tdaBalance`, `tdaTerm`, `tdaInterest`, `tdaMaturity`, `tdaUponMaturity`, `tdaStats`, `tdaRemarks`, `ddateAction`)
                                              VALUES
                                                     ('$id', '$dBank', '$dBranch', '$dBalance', '$dTerm', '$dInterest', '$dMaturity', '$dUponMaturity', '$dStats', '$dRemarks', '$date')";
    $insertQuery = mysqli_query($con, $insertBill);
    if($insertQuery){
      $sql = "UPDATE `timedeposit` SET `dStats` = 1, `ddateAction`='$currentDate' WHERE id='$id'";
      $updateQuest = mysqli_query($con, $sql);

      if($updateQuest){
        $selectCurrent = "SELECT * FROM `timedeposit` WHERE `dStats`= '1' AND `ddateAction`='$currentDate' AND `id`='$id'";
        $queryCurrent = mysqli_query($con, $selectCurrent);
        if(mysqli_num_rows($queryCurrent) > 0){
          while($row = mysqli_fetch_assoc($queryCurrent)){
            $cBank = $row['dBank'];
            $cBranch = $row['dBranch'];
            $cBalance = $row['dBalance'];
            $cTerms = $row['dTerm'];
            $cInterest = $row['dInterest'];
            $cMaturity = $row['dMaturity'];
            $cUponMaturity = $row['dUponMaturity'];
            $cRemarks = $row['dRemarks'];
            $cStats = 1;

            $insertBill2 = "INSERT INTO `timedepositarchived` (`td_id`, `tdaBank`, `tdaBranch`, `tdaBalance`, `tdaTerm`, `tdaInterest`, `tdaMaturity`, `tdaUponMaturity`, `tdaStats`, `tdaRemarks`, `ddateAction`)
                                                              VALUES
                                                              ('$id', '$cBank', '$cBranch', '$cBalance', '$cTerms', '$cInterest', '$cMaturity', '$cUponMaturity', '$cStats', '$cRemarks', '$currentDate')"; 
            $insertQuery2 = mysqli_query($con, $insertBill2);
            if($insertQuery2){
              TDMailer2($dBank, $dBranch, $dBalance, $dInterest, $dTerm, $dMaturity, $dUponMaturity, $dRemarks, "ctborgonia@ourbank.ph", "jcvillanueva@ourbank.ph", "josmin.alvarez@ourbank.ph", "cesar_arnaldo@yahoo.com", "spascualjrmd@yahoo.com.ph", "perlita.nerona@ourbank.ph");
              $data = array(
                'status'=>'success',
              );
              echo json_encode($data);
            }else{
              $data = array(
                'status'=>'failed',
              );
              echo json_encode($data);
            } 
          }
        }
      }
      else{
        $data = array(
          'status'=>'failed',
        );
        echo json_encode($data);
      } 
    }
    else{
      $data = array(
        'status'=>'failed',
      );
      echo json_encode($data);
    } 
  }
}

?>
