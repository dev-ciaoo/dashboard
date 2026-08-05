<?php
include('connection.php');
include('fileuploadloan.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';
// include('loancreateNewCustomerFolder.php');
// Date today + PH TIME
    $writeOff = isset($_POST['writeOff']) ? 1 : 0;

    date_default_timezone_set('Asia/Manila');
    $dateToday = date('M j, Y');
    $customerFirstName = mysqli_real_escape_string($con, $_POST['customerFirstName']);
    $customerSurname = mysqli_real_escape_string($con, $_POST['customerSurname']);
    $customerMiddleName = mysqli_real_escape_string($con, $_POST['customerMiddleName']);
    $birthDate = mysqli_real_escape_string($con, $_POST['birthDate']);
    $salaryType = mysqli_real_escape_string($con, $_POST['salaryType']);
    $branch= mysqli_real_escape_string($con, $_POST['branchAdress']);    
    $remType= mysqli_real_escape_string($con, $_POST['endBuyerCheck']);
    $loanType= mysqli_real_escape_string($con, $_POST['loanType']);
    $sourceIncome= mysqli_real_escape_string($con, $_POST['sourceIncome']);
    $companyName= mysqli_real_escape_string($con, $_POST['companyName']);
    $nextbank= mysqli_real_escape_string($con, $_POST['nextbank']);
    $customerAmount = mysqli_real_escape_string($con, $_POST['customerAmount']);
    $customerTerms = mysqli_real_escape_string($con, $_POST['customerTerms']);
    $customerInterest = mysqli_real_escape_string($con, $_POST['customerInterest']);
    $customerContact = mysqli_real_escape_string($con, $_POST['customerContact']);
    $customerEmail = mysqli_real_escape_string($con, $_POST['customerEmail']);
    // $shaneRemarks = 'Marketing: ' . mysqli_real_escape_string($con, $_POST['shaneRemarks']) . ' <br>';
    $progress ="ONGOING";
    if ($salaryType == "REM: Corporation" || $salaryType == "REM: Individual" || $salaryType == "Hold-Out Loan") {
        $loanType = "SECURED";
    }else{
        $loanType = "UNSECURED";
    }
    
    if ($salaryType == "REM: Corporation") {
        $customerFullname =strtoupper($companyName);

    }else{
        $customerFullname = strtoupper($customerSurname) . ', ' . strtoupper($customerFirstName);
    }
 // Check if the data already exists
    if (!empty($nextbank)){
        $sqlSelect = "SELECT * FROM loan WHERE productID = '$nextbank' ";
        $selectQuery = mysqli_query($con, $sqlSelect);
        $data = mysqli_fetch_assoc($selectQuery);
    }

    if($_SESSION['userid'] == '78'){
        $shaneRemarks = 'Marketing: ' . mysqli_real_escape_string($con, $_POST['shaneRemarks']) . ' <br>';
    }else if($_SESSION['userid'] == '19' || $_SESSION['userid'] == '73'){
        $shaneRemarks = 'Loans: ' . mysqli_real_escape_string($con, $_POST['shaneRemarks']) . ' <br>';
    }else{
        $shaneRemarks = '';
    }


if($data){
    echo 'Update successful!';
    // $sqlUpdate = "UPDATE loan
    //                         SET customerFirstName = '$customerFirstName', customerSurname = '$customerSurname',customerMiddleName = '$customerMiddleName', birthDate = '$birthDate',
    //                             salaryType = '$salaryType', branch = '$branch', customerContact = '$customerContact', customerEmail = '$customerEmail', remType = '$remType',loanType = '$loanType', 
    //                             sourceIncome = '$sourceIncome', amountApplied = '$customerAmount', terms = '$customerTerms', interestRate = '$customerInterest', dateCreated = '$dateToday',
    //                             productID = '$nextbank', pipeRemarks = '$shaneRemarks'
    //                         WHERE productID = '$nextbank'";

    $sqlUpdate = "INSERT INTO `loan` (`customerFirstName`, `customerSurname`, `customerMiddleName`, `customerFullName`, `birthDate`, `salaryType`, `companyName`, `dateCreated`, `branch`, `customerContact`, `customerEmail`,
                                `remType`, `loanType` , `sourceIncome`, `progress`,`productID`, `amountApplied`, `terms`, `interestRate`, `pipeRemarks`, `writeOff`) 
                                VALUES 
                                ('$customerFirstName', '$customerSurname', '$customerMiddleName', '$customerFullname', '$birthDate', '$salaryType', '$companyName', '$dateToday', '$branch', '$customerContact', '$customerEmail',
                                '$remType', '$loanType' , '$sourceIncome', '$progress', '$nextbank', '$customerAmount', '$customerTerms', '$customerInterest', '$shaneRemarks', '$writeOff')";

    $updateQuery = mysqli_query($con, $sqlUpdate);
    $dataUpdate = mysqli_insert_id($con);
     // TARGET FOLDER BASED ON BRANCH ADDRESS
     switch ($branch) {
        case "Head Office":
            $address = "TEJERO/";
            break;
        case "Magallanes":
            $address = "MAGALLANES/";
            break;
        case "Ternate":
            $address = "TERNATE/";
            break;
        case "Maragondon":
            $address = "MARAGONDON/";
            break;
        case "Manggahan":
            $address = "MANGGAHAN/";
            break;
        case "Noveleta":
            $address = "NOVELETA/";
            break;
        case "Poblacion":
            $address = "POBLACION/";
            break;
        default:
            $address = "UNKNOWN/"; // Default value if $branch does not match any case
            break;
    }        
   
    if ($updateQuery == true) {
        echo "true";
        
        $ftpServer = '10.10.10.117';
        $ftpUsername = "ourbank-tech";
        $ftpPassword = "Juliuspogi2023";
    
        // Parent folder path
        $parent = "/LOAN/";
        $parentFolder = $parent . $address . $loanType . "/";
        $subfolderName = $customerFullname;
    
        // Connect to the FTP server
        $ftpConnection = ftp_ssl_connect($ftpServer);
        if (!$ftpConnection) {
            die('Failed to connect to the FTP server');
        }
    
        // Login to the FTP server
        $login = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
        if (!$login) {
            die('Failed to login to the FTP server');
        }
    
        // Enable passive mode (optional, depending on your server's configuration)
        ftp_pasv($ftpConnection, true);
    
    
        // Create the subfolder inside the parent folder
        $createSubfolder = ftp_mkdir($ftpConnection, $parentFolder . $subfolderName);
        if (!$createSubfolder) {
            die('Failed to create the subfolder');
        }
    
        // Close the FTP connection
        ftp_close($ftpConnection);
    
                $data = array(
                    'status' => 'success',
                );


                
    }
    
         
else{
    echo "Error". mysqli_error($con);    
} 

echo json_encode($data);
}


else{


    $sql = "INSERT INTO `loan` (`customerFirstName`, `customerSurname`, `customerMiddleName`, `customerFullName`, `birthDate`, `salaryType`, `companyName`, `dateCreated`, `branch`, `customerContact`, `customerEmail`,
                                `remType`, `loanType` , `sourceIncome`, `progress`,`productID`, `amountApplied`, `terms`, `interestRate`, `pipeRemarks`, `writeOff`) 
                            VALUES 
                                ('$customerFirstName', '$customerSurname', '$customerMiddleName', '$customerFullname', '$birthDate', '$salaryType', '$companyName', '$dateToday', '$branch', '$customerContact', '$customerEmail',
                                '$remType', '$loanType' , '$sourceIncome', '$progress', '$nextbank', '$customerAmount', '$customerTerms', '$customerInterest', '$shaneRemarks', '$writeOff')";
        $query = mysqli_query($con, $sql);

        // TARGET FOLDER BASED ON BRANCH ADDRESS
        switch ($branch) {
            case "Head Office":
                $address = "TEJERO/";
                break;
            case "Magallanes":
                $address = "MAGALLANES/";
                break;
            case "Ternate":
                $address = "TERNATE/";
                break;
            case "Maragondon":
                $address = "MARAGONDON/";
                break;
            case "Manggahan":
                $address = "MANGGAHAN/";
                break;
            case "Noveleta":
                $address = "NOVELETA/";
                break;
            case "Poblacion":
                $address = "POBLACION/";
                break;
            default:
                $address = "UNKNOWN/"; // Default value if $branch does not match any case
                break;
        }        
       
        if ($query == true) {

            
            $ftpServer = '10.10.10.117';
            $ftpUsername = "ourbank-tech";
            $ftpPassword = "Juliuspogi2023";
        
            // Parent folder path
            $parent = "/LOAN/";
            $parentFolder = $parent . $address . $loanType . "/";
            $subfolderName = $customerFullname;
        
            // Connect to the FTP server
            $ftpConnection = ftp_ssl_connect($ftpServer);
            if (!$ftpConnection) {
                die('Failed to connect to the FTP server');
            }
        
            // Login to the FTP server
            $login = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
            if (!$login) {
                die('Failed to login to the FTP server');
            }
        
            // Enable passive mode (optional, depending on your server's configuration)
            ftp_pasv($ftpConnection, true);
        
        
            // Create the subfolder inside the parent folder
            $createSubfolder = ftp_mkdir($ftpConnection, $parentFolder . $subfolderName);
            if (!$createSubfolder) {
                die('Failed to create the subfolder');
            }
        
            // Close the FTP connection
            ftp_close($ftpConnection);
        
                    $data = array(
                        'status' => 'success',
                    );

          $mail = new PHPMailer(true);
          try {
            $filename = 'request10.jpg';
            $cid = 'my-attach';
              $mail->isSMTP();
              $mail->Host = 'ourbank.ph';
              $mail->SMTPAuth = true;
              $mail->Username = 'helpdesk@ourbank.ph';
              $mail->Password = '0urb@nk-2025N3w!@';
              $mail->SMTPSecure = 'ssl';
              $mail->Port = 465;
              $mail->AddEmbeddedImage("request10.jpg", "my-attach", "request10.jpg");
              $mail -> isHTML(true);
              $mail->setFrom('helpdesk@ourbank.ph', 'DASHBOARD');
            if($salaryType == "REM: Corporation" || $salaryType == "REM: Individual"){
                $mail->addAddress('cdcruz@ourbank.ph');
                // $mail->addAddress('mark.chester.rivera@ourbank.ph');
                $mail->addAddress('cevinluan@ourbank.ph');
                $mail->addAddress('irmilano@ourbank.ph');
                $mail->addAddress('jlcricafrente@ourbank.ph');
                $mail->addAddress('jonathan.quijano@ourbank.ph');
                $mail->addAddress('luisito.verder@ourbank.ph');
                $mail->addAddress('josmin.alvarez@ourbank.ph');
                // $mail->addAddress('lkescano@ourbank.ph');
                // $mail -> addAddress('jcvillanueva@ourbank.ph');
            }
            else if($salaryType == "Microfinance"){
                $mail->addAddress('cdcruz@ourbank.ph');
                $mail->addAddress('jlcricafrente@ourbank.ph');
                $mail->addAddress('cevinluan@ourbank.ph');
                $mail->addAddress('josmin.alvarez@ourbank.ph');
                // $mail->addAddress('lkescano@ourbank.ph');
                // $mail -> addAddress('jcvillanueva@ourbank.ph');
            }
            else{
                $mail->addAddress('cdcruz@ourbank.ph');
                $mail->addAddress('jlcricafrente@ourbank.ph');
                $mail->addAddress('josmin.alvarez@ourbank.ph');
                // $mail->addAddress('lkescano@ourbank.ph');
                // $mail -> addAddress('jcvillanueva@ourbank.ph');
            }
             
              $mail->Subject = '[ New Loan ]' . $customerFullname;
              $mail->Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
              <br><br>Customer Added: <b> ' . $customerFullname . ' </b>
              <br>';
  
              $mail->send();
            //   return true;
          } catch (Exception $e) {
            //   return false;
          }
                    
    }else{
        echo "Error". mysqli_error($con); 
        $data = array(
                        'status'=>'failed',
        );
    } 
    echo json_encode($data);
}