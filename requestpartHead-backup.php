<?php
include('connection.php');
require 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="A inventory web app for OUR Bank.">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Request IT Support</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <style>

    .disabled{
      background-color: #DDD;
      color: #999;
    }

  </style>
</head>
<script>
function reloadPage(){
window.location = '';
}
</script>
<body oncontextmenu="return false;">
<?php

  // $sql = "SELECT * FROM `request` WHERE r_Status IN (1, 3, 4) AND r_Branch = '" . $_SESSION['address']. "' ORDER BY id DESC LIMIT 1";
  if($_SESSION['bankposition'] == 'HR Officer' || $_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['bankposition'] == 'Compliance Officer'
     || $_SESSION['bankposition'] == 'ROPOA Officer' || $_SESSION['bankposition'] == 'Credit Officer' || $_SESSION['bankposition'] == 'LOAN Officer'
     || $_SESSION['bankposition'] == 'Internal Auditor' || $_SESSION['bankposition'] == 'Collection Officer' || $_SESSION['bankposition'] == 'LOAN Docu. Officer'
     || $_SESSION['bankposition'] == 'Credit Risk'){
    $sql = "SELECT d.departmentName, r.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `request` as r ON r.r_user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND a.address = '" . $_SESSION['address'] . "'
                AND r.r_Status IN (0, 3) AND a.userPosition = 'Staff'
                OR a.userId = '" . $_SESSION['userid'] . "'
                ORDER BY r.r_Status IN (0, 3) DESC LIMIT 1";
        }
  else if($_SESSION['position'] == 'BM'){
    $sql = "SELECT d.departmentName, r.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `request` as r ON r.r_user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."' 
                AND a.address = '" . $_SESSION['address'] . "'
                AND r.r_Status IN (0, 3) AND a.userPosition = 'Staff'
                OR a.userId = '" . $_SESSION['userid'] . "' 
                ORDER BY r.r_Status IN (0, 3) DESC LIMIT 1";
  }
  else if( $_SESSION['bankposition'] == 'Branch Cashier'){
    $sql = "SELECT d.departmentName, r.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `request` as r ON r.r_user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."' 
                AND a.address = '" . $_SESSION['address'] . "'
                AND r.r_Status IN (0, 3)
                ORDER BY r.r_Status IN (0, 3) DESC LIMIT 1";
  }
  // else if($_SESSION['bankposition'] == 'IT Officer'){
  //   $sql = "SELECT d.departmentName, r.* FROM `accounts` as a 
  //               JOIN `department` as d  ON d.id = a.userDepartment
  //               JOIN `request` as r ON r.r_user_Id = a.userId
  //               WHERE r.r_Status = 1 AND a.userPosition = 'Head'
  //               OR a.userPosition = 'BM' ORDER BY a.userId DESC LIMIT 1";
  // }
  else {
    echo "";
  }

  $query = mysqli_query($con, $sql);
  if(mysqli_fetch_assoc($query) > 0) {
    foreach($query as $row) {
      ?>
    <section class="forms">
            <div class="container-fluid">
              <div class="pending-form shadow-lg p-1 mb-4">
                  <div class="pads">
                  <div class="row">
                  <!-- <div class="col"><img class="leave-image" src="./logo/logo.png" alt="logo"></div> -->
                  <div class="col-md-12">
                    <div class="section-heading">
                      <br>
                      <h3>IT SUPPORT REQUEST FORM</h3>
                      <span id="dateToday">Date: <?php echo $row['r_myDate']; ?></span>
                    </div>
                    <form id="requestITStatus" action="" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="pName" value="<?= $row['r_Name']; ?>" type="text" 
                                    class="form-control" id="pName" placeholder="Full Name"  readonly>
                              <label for="pName">Full Name</label>
                            </div>
                          </fieldset><br>
                        </div>
                        <div class="col-md-6">
                          <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="pEmail" value="<?= $row['r_Email']; ?>" type="email" 
                                    class="form-control" id="pEmail" placeholder="Full Name" readonly>
                              <label for="pEmail">Email</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-12">
                          <fieldset>
                            <div class="form-floating">
                              <input name="pCategory" value="<?= $row['r_Request']; ?>" 
                                    type="email" class="form-control" id="pCategory" placeholder="Reason" readonly>
                              <label for="pCategory">Request</label>
                            </div>
                          </fieldset><br>
                        </div>  
                        <div class="col-12">
                          <fieldset>
                            <div class="">
                              <?php
                                if($row['r_Image'] != 'request/d41d8cd98f00b204e9800998ecf8427e.') {
                                  echo '<a target="_blank" href="' . $row['r_Image'] . '"><img src="' . $row['r_Image'] . '" style="float: left;" width="80px;"></a>';
                                }
                                else{
                                  echo '';
                                }
                                ?>
                              <label for=""></label>
                            </div>
                          </fieldset>
                        </div>
                        <input type="hidden" value="<?= $row['id']; ?>" name="reqID" id="reqID">
                        <input type="hidden" value="<?= $_SESSION['useremail']; ?>" name="sessionEmail">
                        <div>
                          <?php
                            if($row['r_Status'] == 0) { ?>
                            <img id="rStatus" src="statusImage/25per.png" alt="">
                            <div>
                              <button type="submit" name="btnA" id="btnA" class="btn btn-primary btn-md btnA" onClick="btnSubmit()">&nbsp;&nbsp;Approved&nbsp;&nbsp;</button>
                              <button type="submit" name="btnR" id="btnR" class="btn btn-danger btn-md btnR">Disapproved</button>
                            </div>
                          <?php } ?>
                        </div>
                        <div>
                          <?php
                          if($row['r_Status'] == 1 || $row['r_Status'] == 6) { ?>
                          <img id="rStatus" src="statusImage/50per.png" alt="">
                        </div>
                        <div>
                          <?php }
                          if($row['r_Status'] == 3) { ?>
                          <img id="rStatus" src="statusImage/75per.png" alt="">
                          <div>
                            <button type="submit" name="btnSD" id="btnSD" class="btn btn-success btn-md btnSD">Service Rendered</button>
                          </div>
                        </div>
                       
                        <div>
                          <?php } 
                          if($row['r_Status'] == 4) { ?>
                            <img id="rStatus" src="statusImage/100per.png" alt="">
                          <?php }
                          ?>
                        </div>
<?php   
        }
    }
    else {
        echo "<br><br>No Record Found";
    }

?>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
</section>

<?php

use PHPMailer\PHPMailer\PHpMailer;
use PHPMailer\PHPMailer\Exception;
            
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

if(isset($_POST['btnA'])){
  $Idd = $_POST['reqID'];
  $sqlRequestor = "SELECT r_Position FROM `request` WHERE r_Branch = '" . $_SESSION['address'] . "' AND id = $Idd";
  $queryRequestor = mysqli_query($con, $sqlRequestor);
  $roww = mysqli_fetch_assoc($queryRequestor);
      if($roww['r_Position'] == 'Staff'){
        $Status = 6;
      }
  $sessionEmail = $_SESSION['useremail'];
  $sessionName = $_SESSION['fullname'];
  $toEmail = 'jcvillanueva@ourbank.ph';

  $urlink = '<a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>';
  $filename = 'request.jpg';
  $cid = 'my-attach';
  $subject = 'Requesting IT Support';

  $mail = new PHPMailer(true);    
            
  $mail -> isSMTP();
  // $mail -> Host = 'smtp.gmail.com';
  $mail -> Host = 'ourbank.ph';
  $mail -> SMTPAuth = true;
  // $mail -> Username = 'ourbanktech@gmail.com';
  // $mail -> Password = 'pcgafzbvjwusqunp';
  $mail -> Username = 'helpdesk@ourbank.ph';
  $mail -> Password = '0urb@nk-2025N3w!@';
  $mail -> SMTPSecure = 'ssl';
  $mail -> Port = 465;
  $mail->AddEmbeddedImage("request.jpg", "my-attach", "request.jpg");
            
  $mail->addEmbeddedImage($filename, $cid);
            
  $mail -> setFrom($sessionEmail, $sessionName); // Sender
                
  $mail -> addAddress($toEmail); //receiver
  // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
            
  $mail -> isHTML(true);

  $mail -> Subject = '[ Support ] Requesting IT Support';
                
  $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                  <br>';
            
   $mail -> send();
    
}
else if(isset($_POST['btnR'])){
  $Status = 5;
}
else{
  if(isset($_POST['btnSD'])){
   $Status = 4;
  }
}
    $id = $_POST['reqID'];

    $sql = "UPDATE `request` SET r_Status = $Status WHERE id = $id";
    $query = mysqli_query($con, $sql);
    if($query == true){

        echo "<script>
              alert('Successfully Submitted!');
              console.log(reloadPage());
              </script>";
              exit();
    }
?>
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
  crossorigin="anonymous"></script>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script type="text/javascript">

$(document).on('click', '#btnA', function (event) {
    $( "#requestITStatus" ).trigger( "submit" );
    $('#btnA').addClass('disabled');
});

</script>

</body>
</html>