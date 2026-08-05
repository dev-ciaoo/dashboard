<?php
include('connection.php');
include('fileupload.php');

// Enable error reporting for debugging
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure session is starter

    // Check if user is logged in (ensure `$_SESSION['userid']` exists)
    if (!isset($_SESSION['userid'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        exit();
    }

    // Sanitize inputs
    $toEmail = $_POST['toEmail'] ?? null;
    $empId = $_POST['employee_Id'] ?? null;
    $iName = $_POST['iName'] ?? null;
    $iBranch = $_POST['iBranch'] ?? null;
    $iEmail = $_POST['iEmail'] ?? null;
    $iCategory = $_POST['iCategory'] ?? null;
    $dateFrom = $_POST['dateFrom'] ?? null;
    $dateTo = $_POST['dateTo'] ?? null;
    $timeFrom = $_POST['timeFrom'] ?? null;
    $timeTo = $_POST['timeTo'] ?? null;
    $iMessage = $_POST['iMessage'] ?? null;
    $myDate = $_POST['myDate'] ?? null;
    $day = $_POST['kindDay'] ?? null;
    $totalHours = $_POST['totalHours'];
    $kindofOT = $_POST['kindOT'];
	$iRemarks = '';
	$approver = '';
	$timeApproved = '';

    if($iCategory === 'Overtime' && $totalHours <= 0){
        echo json_encode([
            'success' => false,
            'message' => 'Total hours must be greater than 0 for Overtime.'
        ]);
        exit;
    }

    // if($totalHours === 0)
	
	function isWeekend($dateFrom) {
      // Convert the date to a Unix timestamp
      $timestamp = strtotime($dateFrom);
      
      // Get the day of the week as an integer (0 for Sunday, 6 for Saturday)
      $dayOfWeek = date('w', $timestamp);
      
      // Return true if it's Saturday (6) or Sunday (0), otherwise return false
      return ($dayOfWeek == 0 || $dayOfWeek == 6);
    }

    if (isWeekend($dateFrom)) {
      $kindofOT = 'Weekend OT' ?? null;
    } else {
      $kindofOT = 'Regular OT' ?? null;
    }

    // Validate required fields
    if (empty($toEmail) || empty($empId) || empty($iName) || empty($iBranch) || empty($iEmail) || empty($iCategory) ||
        empty($dateFrom) || empty($dateTo) || empty($timeFrom) || empty($timeTo) || empty($iMessage) || empty($myDate)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit();
    }

    // Get today's date in the correct format (YYYY-MM-DD)
    $dateToday = date("Y-m-d");

	if($iCategory !== "Sick Leave" && $iCategory !== "Overtime" && $iCategory !== "Paternity Leave" && $iCategory !== "Maternity Leave" && $iCategory !== "Emergency Leave" && $iCategory !== "Unpaid Leave"){
		// Validate date inputs
		if ($dateFrom < $dateToday) {
		    echo json_encode(['success' => false, 'message' => 'Start date cannot be in the past!']);
		    exit();
		} elseif ($dateTo < $dateFrom) {
		    echo json_encode(['success' => false, 'message' => 'End date cannot be earlier than the start date!']);
		    exit();
		}
	}
	
	if($iCategory !== "Overtime"){
		$kindofOT = '';
	}
	
    // Prepare the SQL statement
    $sql = "INSERT INTO `leavetbl` (`user_Id`, `employee_Id`, `iName`, `iBranch`, `myDate`, `iEmail`, `toEmail`, `iCategory`, 
                                     `dateFrom`, `dateTo`, `timeFrom`, `timeTo`, `totalHours`, `kindOT`, `kindDay`, `iMessage`, `iRemarks`, `approver`, `timeApproved`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // Bind parameters to prevent SQL injection
        $stmt->bind_param(
            "isssssssssssdssssss",  // Added the correct number of "s" based on your query
            $_SESSION['userid'],  // user_Id
            $empId,               // employee_Id
            $iName,               // iName
            $iBranch,             // iBranch
            $myDate,              // myDate
            $iEmail,              // iEmail
            $toEmail,             // toEmail
            $iCategory,           // iCategory
            $dateFrom,            // dateFrom
            $dateTo,              // dateTo
            $timeFrom,            // timeFrom
            $timeTo,              // timeTo
            $totalHours,          // totalHours
            $kindofOT,            // kindOT
            $day,                 // kindDay
            $iMessage,            // iMessage
            $iRemarks,            // iRemarks (empty string as placeholder)
            $approver,
            $timeApproved
        );

        // Execute the statement
        if ($stmt->execute()) {
            try {
                $mail = new PHPMailer(true);
                $config = require 'mail_config.php';

                $mail->isSMTP();
                $mail->Host       = $config['smtp_host'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $config['smtp_user'];
                $mail->Password   = $config['smtp_pass'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = $config['smtp_port'];
                $mail->SMTPKeepAlive = true; 

                $mail -> setFrom($iEmail, $iName);
                $mail -> addAddress($toEmail); //receiver
                // $mail -> addReplyTo('ctborgonia@ourban.ph', 'Ciao'); 
                // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
                    
                $mail -> isHTML(true);

                $mail -> Subject = '[ Leave/OB/OT ] ' . $iName;
                        
                $mail -> Body = '
                                    Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                                    <br><br>
                                    Details/Message : <br><br>'
                                        . nl2br(htmlspecialchars($iMessage)) . 
                                    '
                                ';
                    
                $mail -> send();
            }catch (Exception $e){
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Email sending failed',
                    'debug'   => $mail->ErrorInfo
                ]);
                exit;
            }     
            echo json_encode(['success' => true, 'message' => 'Leave Successfully Submitted!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
        }

        $stmt->close(); // Close the statement
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
