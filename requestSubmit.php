<?php 
use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

include('connection.php');
// include('function.php');

include('fileupload.php');

    date_default_timezone_set('Asia/Manila');
    $dateToday = date('F j, Y \a\t g:i A');
    $r_employee_Id = $_POST['r_employee_Id'];
    $r_Name = $_POST['r_Name'];
    $r_Branch = $_POST['r_Branch'];
    $r_Email = $_POST['r_Email'];
    $r_Request = $_POST['r_Request'];
    $r_toEmail = $_POST['r_toEmail'];
    $r_Position = $_POST['r_Position'];
    $r_userDepartment = $_POST['r_userDepartment'];

    $r_Image = $_FILES['r_Image'];
    $file =  upload_file($r_Image, 'request');

    $todayDate = date('Y-m-d');
    $sqlAbsent = "SELECT a.userDepartment, l.* FROM `accounts` as a
                                      JOIN `department` as d ON d.id = a.userDepartment
                                      JOIN `leavetbl` as l ON l.user_Id = a.userId
                                        WHERE l.iBranch = '" . $_SESSION['address'] . "'
                                          AND a.userDepartment  = '" . $_SESSION['department'] . "'
                                          AND dateFrom <= '$todayDate' AND dateTo >= '$todayDate' 
                                          AND user_Id IN (37, 10, 12, 15, 17, 25, 30, 48)"; //71, 73, 75, 77, 79, 81, 83 -- dummy bm in database to login
                  
    $queryAbsent = mysqli_query($con, $sqlAbsent);
    $rowFetch = mysqli_fetch_assoc($queryAbsent);

    // Determine r_Status based on request content and conditions
    if (stripos($r_Request, 'dummy') !== false || stripos($r_Request, 'write-off') !== false || stripos($r_Request, 'reliever') !== false || stripos($r_Request, 'reactivate') !== false 
        || stripos($r_Request, 're-activate') !== false || stripos($r_Request, 'unblock') !== false) {
      $r_Status = ($_SESSION['position'] == 'Staff') ? 0 : 1; // 1
    }else{
      $r_Status = ($_SESSION['position'] == 'Staff') ? 0 : 1;
    }

    if (
        $rowFetch['iAbsent'] == 1 &&
        $rowFetch['dateFrom'] <= $todayDate &&
        $rowFetch['dateTo'] >= $dateToday && 
        $rowFetch['iStatus'] == 2 &&
        $_SESSION['bankposition'] == 'Branch Cashier'
    ){
        // Absent today, status 2, and user is Branch Cashier → Status 1
        $r_Status = 1; // 1
    } 


    if(!empty($file['result']) || empty($file['result'])) {
      $destination = $file['path'];
        $sql = "INSERT INTO `request` (`r_user_Id`, `r_employee_Id`, `r_Name`, `r_Branch`, `r_myDate`, `r_Email`, `r_toEmail`, `r_Position`, `r_userDepartment`, `r_Request`, `r_Status`, `r_Image`) 
                  VALUES ('".$_SESSION['userid']."', '$r_employee_Id', '$r_Name', '$r_Branch', '$dateToday', '$r_Email', '$r_toEmail', '$r_Position', '$r_userDepartment', '$r_Request', '$r_Status', '$destination')";
        $query = mysqli_query($con, $sql);
        $lastId = mysqli_insert_id($con);

        if($query == true){
          // insert condition here if absent bm/head ()=> gm/agm
              $sessionEmail = $_SESSION['useremail'];
              $sessionName = $_SESSION['fullname'];
              $r_toEmail = $_POST['r_toEmail'];

              $urlink = '<a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>';
              $subject = 'Requesting IT Support';

              $mail = new PHPMailer(true);    
                        
              $mail -> isSMTP();
              // $mail -> Host = 'smtp.gmail.com';
              $mail -> Host = 'ourbank.ph';
              $mail -> SMTPAuth = true;
              $mail -> Username = 'helpdesk@ourbank.ph';
              $mail -> Password = '0urb@nk-2025N3w!@';
              $mail -> SMTPSecure = 'ssl';
              $mail -> Port = 465;
              $mail -> SMTPKeepAlive = true;
              $mail -> setFrom($sessionEmail, $sessionName); // Sender
                            
              // $mail -> addAddress($r_toEmail); //receiver
              if($_SESSION['position'] == 'Staff'){
                $mail -> addAddress($r_toEmail); //receiver
                // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
              } else if($_SESSION['position'] == 'Head' || $_SESSION['position'] == 'BM' || $_SESSION['position'] == 'GM' || $_SESSION['position'] == 'AGM'){
                $mail -> addAddress('jcvillanueva@ourbank.ph');
                // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
              }
              $mail -> isHTML(true);

              $mail -> Subject = '[ Requesting IT Support ] ' . $r_Name;
                            
              $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                              <br><br>';
                        
              $mail -> send();
            $response['message'] = 'Successfully Added!';
            $response['result'] = true;
        } 
        else{   
          $response['message'] = 'Something Wrong!';
        }
      // else{
      //   $response['message'] = 'No Double Submit!';
      // }
    }else {
        $response['message'] = $file['message'];
    }
    echo json_encode($response['message']);
?>