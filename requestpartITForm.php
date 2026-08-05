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
  <link rel="stylesheet" href="./css/bootstrap521.min.css" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<script>
function reloadPage(){
window.location = '';
}
</script>
<body oncontextmenu="return false;">
<?php

          // $data = mysqli_fetch_assoc($query);


  $sql = 'SELECT * FROM `request` WHERE r_Status = 2 ORDER BY id DESC LIMIT 1';
  $query = mysqli_query($con, $sql);
//   print_r(mysqli_fetch_assoc($query));
//   die();
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
                              <input name="pName" value="<?= $row['r_Name']; ?>" type="text" class="form-control" id="pName" placeholder="Full Name"  readonly>
                              <label for="pName">Full Name</label>
                            </div>
                          </fieldset>
                        <br>
                        </div>
                        <div class="col-md-6">
                          <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="pEmail" value="<?= $row['r_Email']; ?>" type="email" class="form-control" id="pEmail" placeholder="Full Name" readonly>
                              <label for="pEmail">Email</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-12">
                          <fieldset>
                            <div class="form-floating">
                              <input name="pCategory" value="<?= $row['r_Request']; ?>" type="email" class="form-control" id="pCategory" placeholder="Reason" readonly>
                              <label for="pCategory">Type of Request</label>
                            </div>
                          </fieldset><br>
                        </div>  
                        <div class="col-12">
                          <fieldset>
                            <div class="">
                            <?php
                                if($row['r_Image'] != 'request/d41d8cd98f00b204e9800998ecf8427e.') {
                                  echo '<a target="_blank" href="' . $row['r_Image'] . '"><img src="' . $row['r_Image'] . '" style="float: left;" width="120px;"></a>';
                                }
                                else{
                                  echo '';
                                }
                              ?>
                              <label for=""></label>
                            </div>
                          </fieldset>
                        </div>
                        <input type="hidden" value="<?= $row['id']; ?>" name="reqID">
                        <input type="hidden" value="<?= $row['r_toEmail']; ?>" name="r_toEmail">
                        <div>
                        <div>
                        <?php
                        if($row['r_Status'] == 2) {
                        ?>
                          <img id="rStatus" src="statusImage/50per.png" alt="">
                        <div>
                          <button type="submit" name="btnDone" id="btnDone" class="btn btn-primary btn-md">Work Done</button>
                        </div>
                        <?php
                        }
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

if(isset($_POST['btnDone'])){
  $Status = 3;
  $r_toEmail = ['r_toEmail'];
  $Email = 'helpdesk@ourbank.ph';

  $urlink = '<a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>';
  $filename = 'request3.jpg';
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
  $mail->AddEmbeddedImage("request3.jpg", "my-attach", "request3.jpg");
            
  $mail->addEmbeddedImage($filename, $cid);
            
  $mail -> setFrom($Email); // Sender
                
  $mail -> addAddress($r_toEmail); //receiver
  // $mail -> addAddress('ctborgonia@ourbank.ph'); //for testing receiver
            
  $mail -> isHTML(true);

  $mail -> Subject = 'Your Request for IT Support is Completed.';
                
  $mail -> Body = 'Please click this link to proceed: <a target="_blank" href="http://10.10.10.120/dashboard/">OUR Bank Dashboard</a>
                  <br><br>See below image for the instruction: 
                  <br><br><img class="smallLogo" src="cid:my-attach">
                  <br>';
            
   $mail -> send();
}
    $id = $_POST['reqID'];

    $sql = "UPDATE `request` SET r_Status =  $Status WHERE id = $id";
    $query = mysqli_query($con, $sql);
    if($query == true){
        echo "<script>
              alert('Successfully Submitted!');
              console.log(reloadPage());
              </script>";
    }
    else{
        Echo "";
    }
?>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    if(typeof jQuery == 'undefined') {
        document.write('<script src="js/jquery-3.6.0.min.js"><\/script>');
    }
</script>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script>
  if(typeof jQuery == 'undefined') {
      document.write('<script src="js/popper2116.min.js"><\/script>');
  }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
  <script>
  if(typeof jQuery == 'undefined') {
      document.write('<script src="js/bootstrap.bundle521.min.js"><\/script>');
  }
  </script>

</body>
</html>