<?php 
include('connection.php');
include('fileupload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php'; 

date_default_timezone_set('Asia/Manila');
$dateToday = date('F j, Y @ h:i:s A');
$name = $_SESSION['fullname'];

function sendMail($fullName, $clientName, $thisBranch, $emailTo, $emailTo2, $emailTo3, $emailTo4, $emailTo5, $emailTo6, $dateToday){
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'ourbank.ph';
        $mail->SMTPAuth = true;
        $mail->Username = 'helpdesk@ourbank.ph';
        $mail->Password = '0urb@nk-2021';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->isHTML(true);
        
        $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
        $mail->addAddress($emailTo);
        
        if (!empty($emailTo2)) $mail->addAddress($emailTo2);
        if (!empty($emailTo3)) $mail->addAddress($emailTo3);
        if (!empty($emailTo4)) $mail->addAddress($emailTo4);
        if (!empty($emailTo4)) $mail->addAddress($emailTo5);
        if (!empty($emailTo6)) $mail->addAddress($emailTo6);

        $mail->Subject = '[ Due Collection Phone Remarks ] MADE BY: ' . $fullName;
        $mail->Body = 'Good day, <br><br>
                        Just to inform you there is a new Phone remark posted in your <a href="http://10.10.10.120/" target="_blank">Dashboard</a>.<br>
                        Kindly check it on LOANS > Due Collection > Search Name.
                        <br><br>
                        Client Name: <strong>' . $clientName . '</strong><br>
                        Branch: <strong>' . $thisBranch . '</strong><br><br>
                        Thank you.';
        
        $mail->send();
    } catch (Exception $e) {
        // Log error or handle it
        error_log("Mail error: " . $mail->ErrorInfo);
    }
}

$id = $_POST['id'];
$phoneRemarks = $_POST['phoneRemarks'];

// Use prepared statements to avoid SQL injection
$stmt = $con->prepare("SELECT `phoneRemarks`, `branch`, `customerFullName` FROM `loan` WHERE loan_Id=?");
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $currentphoneRemarks = $row['phoneRemarks'] ? $row['phoneRemarks'] : '';

    if ($_SESSION['department'] == '6' || $_SESSION['department'] == 6) {
        $letterSet = "COLLECTION: $phoneRemarks";
    } else {
        $letterSet = "BM: $phoneRemarks";
    }

    // Concatenate the new value with a line break and the existing phoneRemarks
    $updatedphoneRemarks = $currentphoneRemarks . "<br>" . $letterSet;

    // Update the loan table
    $updateStmt = $con->prepare("UPDATE `loan` SET `phoneRemarks` = ? WHERE loan_Id = ?");
    $updateStmt->bind_param('ss', $updatedphoneRemarks, $id);
    if ($updateStmt->execute()) {
        $branch = $row['branch'];
        $customerName = $row['customerFullName'];

        if ($_SESSION['address'] != 'Head Office') {
            sendMail($name, $customerName, $branch, 'jesus.diokno@ourbank.ph', 'majluna@ourbank.ph', '', 'josmin.alvarez@ourbank.ph', 'jcvillanueva@ourbank.ph', 'ctborgonia@ourbank.ph', $dateToday);
        } else {
            // if($_SESSION['address'] === 'Head Office' && $branch === 'Poblacion'){
            //     $headOfficeEmails = 'karen.dianne.dampitan@ourbank.ph';
            // }else if($_SESSION['address'] === 'Head Office' && $branch === 'Noveleta'){
            //     $headOfficeEmails = 'jacklyn.sarique@ourbank.ph';
            // }
            // Use an array of branch-specific email addresses for head office cases
            $headOfficeEmails = [
                'Noveleta' => 'karen.dianne.dampitan@ourbank.ph',
                'Poblacion' => 'jacklyn.sarique@ourbank.ph',
                'Manggahan' => 'jennifer.giron@ourbank.ph',
                'Maragondon' => 'melody.ruazol@ourbank.ph',
                'Magallanes' => 'joan.reduca@ourbank.ph',
                'Ternate' => 'melvin.tabanan@ourbank.ph',
            ];
            $branchEmail = $headOfficeEmails[$branch] ?? '';
            sendMail($name, $customerName, $branch, $branchEmail, '', '', 'josmin.alvarez@ourbank.ph', 'jcvillanueva@ourbank.ph', 'ctborgonia@ourbank.ph', $dateToday);
        }

        $data = array('status' => 'success');
    } else {
        $data = array('status' => 'failed');
    }
} else {
    $data = array('status' => 'failed');
}

echo json_encode($data);
?>
