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
<body oncontextmenu="return false;">
<?php
if($_SESSION['position'] == 'Staff' || $_SESSION['position'] == 'Head' || $_SESSION['position'] == 'BM' || $_SESSION['position'] == 'AGM' || $_SESSION['position'] == 'GM'){
  if($_SESSION['position'] == "Staff") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"';
  }
  if($_SESSION['position'] == "Head") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"';
  }
  if($_SESSION['position'] == "BM") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"
            AND a.address = "'. $_SESSION['address']  .'"';
  }
  if($_SESSION['position'] == "AGM") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"
            AND a.address = "'. $_SESSION['address']  .'"';
  }
  if($_SESSION['position'] == "GM") {
    $sql = 'SELECT a.*, e.eMail FROM `accounts` as a
            JOIN `emails` as e ON a.userLevel = e.id
            WHERE a.userId = "'.$_SESSION['userid'].'"
            AND a.address = "'. $_SESSION['address']  .'"';
  }
}
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($query);
// print_r($data);
// die();
?>

<section class="forms">
            <div class="container-fluid">
              <div class="request-form shadow-lg p-1 mb-4">
                  <div class="pads">
                  <div class="row">
                  <!-- <div class="col"><img class="leave-image" src="./logo/logo.png" alt="logo"></div> -->
                  <div class="col-md-12">
                    <br>
                    <div class="section-heading">
                      <h3>IT SUPPORT REQUEST FORM</h3> 
                    </div>
                    <form id="requestITForm" action="" method="post" enctype="multipart/data-form">
                    <span id="dateToday">Date: <?php $r_myDate=getdate(date("U"));
                            date_default_timezone_set('Asia/Manila');
                            echo "$r_myDate[month] $r_myDate[mday], $r_myDate[year]"; ?></span>
                      <input type="hidden" id="r_myDate" name="r_myDate" value="<?= "$r_myDate[month] $r_myDate[mday], $r_myDate[year]"; ?>">
                      <div class="row">
                              <input name="r_toEmail" value="<?= $data['eMail'];?>" type="hidden"  class="form-control" id="r_toEmail">
                              <input name="r_employee_Id" value="<?= $data['employeeId']; ?>"type="hidden" class="form-control" id="r_employee_Id">     
                      <div class="col-md-6">
                        <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="r_Name" value="<?= $data['fullName']; ?>"type="text" class="form-control" id="r_Name" placeholder="Full Name" Required readonly>
                              <label for="r_Name">Full Name</label>
                            </div>
                          </fieldset><br>
                        </div>
                        <input name="r_Branch" value="<?= $data['address']; ?>" type="hidden" class="form-control" id="r_Branch">
                        <input name="r_Position" value="<?= $data['userPosition']; ?>" type="hidden" class="form-control" id="r_Position">
                        <input name="r_userDepartment" value="<?= $data['userDepartment']; ?>" type="hidden" class="form-control" id="r_userDepartment">
                        <div class="col-md-6">
                          <fieldset><br>
                            <div class="form-floating">
                              <input name="r_Email" value="<?= $data['userEmail']; ?>" type="email" class="form-control" id="r_Email" placeholder="E-Mail" Required readonly>
                              <label for="r_Email">Email</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-12">
                        <fieldset>
                          <div class="form-floating">
                          <input type="text" name="r_Request" class="form-control" id="r_Request" Required>
                          <label for="r_Request">Type of Request </label>
                          </div>
                        <fieldset>
                        </div>  
                        <div class="col-md-6">
                          <!-- <input type="text" name="iMessage" class="form-control" id="iMessage" placeholder="Reason / Destination">
                          </div>
                          <div class="col-3"> -->
                          <fieldset>
                            <br>
                            <div class="">
                              <input type="file" id="r_Image" name="r_Image" accept="image/png, image/jpeg, image/jpg" multiple>
                              <label for=""></label>
                            </div>
                          </fieldset>
                        </div>
                        <div>
                              <img src="statusImage/00.png" alt="" width="100%" height="auto">
                        </div>
                        <div class="col-md-12">
                          <button type="submit" name="btnRequest" id="btnRequest" class="btn btn-primary btn-md">Send Request</button>
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

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  
<script type="text/javascript" language="javascript">
  
$(document).ready(function(e){
  $('#requestITForm').on('submit', function(e) {
    $("#btnRequest").attr('disabled','true');
    $("#btnRequest").attr('value','Processing...');
    e.preventDefault();
    var fd = new FormData(this);
    $.ajax({
      url:'requestSubmit.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(data) {
        $("#btnRequest").removeAttr('disabled');
        $("#btnRequest").attr('value','Submit');
        alert('Success!');
        console.log(data);
        window.location.reload();
      },
      error: function(data) {
        alert('Error Sending your form!');
        window.location.reload();
      }
    });
  });
});

</script>
</body>

</html>