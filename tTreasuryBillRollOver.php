<?php 
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

date_default_timezone_set('Asia/Manila');

function TBMailer($bank, $branch, $balancee, $days, $interestR, $date, $netInterest, $email) {

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

        // validate email
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addAddress(trim($email));
        }

        $mail->isHTML(true);

        $mail->Subject = "[ Roll Over ] $bank";

        $mail->Body = '
            Please click this link to proceed:
            <a target="_blank" href="http://10.10.10.120/dashboard/">
            OUR Bank Dashboard</a>

            <br><br><strong>Bank:</strong> ' . htmlspecialchars($bank) . '
            <br><br><strong>Branch:</strong> ' . htmlspecialchars($branch) . '
            <br><br><strong>Per Value:</strong> ' . number_format($balancee, 2) . '
            <br><br><strong>Interest Rate (%):</strong> ' . $interestR . '%
            <br><br><strong>Terms (Days):</strong> ' . $days . ' Days
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

$id = $_POST['id'] ?? '';
// $currentDate = date('F j, Y \a\t g:i A');
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
    $tStats = 5; //if rollover and insert to billarchived
    $date = $roww['dateAction'];

    $insertBill = "INSERT INTO `tbillarchived` (`tb_id`, `tbaBank`, `tbaBranch`, `tbaParValue`, `tbaTerms`, `tbaInterest`, `tbaMaturity`, `tbaNetInterest`, `tbaStats`, `dateAction`)
                                              VALUES
                                               ('$id', '$tBank', '$tBranch', '$tParValue', '$tTerms', '$tInterest', '$tMaturity', '$tNetInterest', '$tStats', '$date')"; // Fixed missing quotation mark
    $insertQuery = mysqli_query($con, $insertBill);
    if($insertQuery){
      
      $rbankName = $_POST['rbankName'] ?? '';
      $rbranchName = $_POST['rbranchName'] ?? '';
      $rparValue = $_POST['rparValue'] ?? '';
      $rterms = $_POST['rterms'] ?? '';
      $rinterestRate = $_POST['rinterestRate'] ?? '';
      $rmaturityDate = $_POST['rmaturityDate'] ?? '';
      $rnetInterest = $_POST['rnetInterest'] ?? '';
      $tStatss = 4;

      $sql = "UPDATE `treasurybill` SET `tBank`='$rbankName', `tBranch`='$rbranchName', `tParValue`='$rparValue', `tTerms`='$rterms', `tInterest`='$rinterestRate', `tMaturity`='$rmaturityDate', `tNetInterest`='$rnetInterest', `tStats` = '$tStatss', `dateAction`='$currentDate' WHERE id='$id'";
      $updateQuest = mysqli_query($con, $sql);
      if($updateQuest){
        $selectQuest = "SELECT * FROM `treasurybill` WHERE `tStats`= 4 AND `dateAction`='$currentDate' AND id='$id'";
        $queryQuest = mysqli_query($con, $selectQuest);
        if(mysqli_num_rows($queryQuest) > 0){
          while($row = mysqli_fetch_assoc($queryQuest)){
            $cBank = $row['tBank'];
            $cBranch = $row['tBranch'];
            $cParValue = $row['tParValue'];
            $cTerms = $row['tTerms'];
            $cInterest = $row['tInterest'];
            $cMaturity = $row['tMaturity'];
            $cNetInterest = $row['tNetInterest'];
            $cStats = 4;

            $insertBill2 = "INSERT INTO `tbillarchived` (`tb_id`, `tbaBank`, `tbaBranch`, `tbaParValue`, `tbaTerms`, `tbaInterest`, `tbaMaturity`, `tbaNetInterest`, `tbaStats`, `dateAction`)
                                              VALUES
                                               ('$id', '$cBank', '$cBranch', '$cParValue', '$cTerms', '$cInterest', '$cMaturity', '$cNetInterest', '$cStats', '$currentDate')"; // Fixed missing quotation mark
            $insertQuery2 = mysqli_query($con, $insertBill2);
          }
        }
        TBMailer($rbankName, $rbranchName, $rparValue, $rterms, $rinterestRate, $rmaturityDate, $rnetInterest, "ctborgonia@ourbank.ph");
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
