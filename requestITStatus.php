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
  <title>IT Support</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body oncontextmenu="return false;">
<?php

          // $data = mysqli_fetch_assoc($query);
  if($_SESSION['department'] == 1){
    $sql = 'SELECT * FROM `request` WHERE r_Status IN (0, 1, 2, 3, 4, 7) ORDER BY id DESC LIMIT 1';
  }
  else {
    $sql = 'SELECT r.* FROM `request` as r JOIN `department` as d ON d.id = r.r_userDepartment
            WHERE r.r_Status IN (0, 1, 2, 3, 4, 5, 6, 7) AND r.r_Branch = "' . $_SESSION['address'] . '" 
            AND r.r_userDepartment = "' . $_SESSION['department'] . '" AND r_user_Id = "' . $_SESSION['userid'] . '" ORDER BY id DESC LIMIT 1';
  }
  $query = mysqli_query($con, $sql);
  if($row = mysqli_fetch_assoc($query) > 0) {
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
                      <h2>IT SUPPORT REQUEST FORM</h2>
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
                          </fieldset><br>
                        </div>
                        <div class="col-md-6">
                          <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="pEmail" value="<?= $row['r_Email']; ?>" type="email" class="form-control" id="pEmail" placeholder="Email" readonly>
                              <label for="pEmail">Email</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-12">
                          <fieldset>
                            <div class="form-floating">
                              <input name="pCategory" value="<?= $row['r_Request']; ?>" type="text" class="form-control" id="pCategory" placeholder="Reason" readonly>
                              <label for="pCategory">Type of Request</label>
                            </div>
                          </fieldset><br>
                        </div>
                        <div class="col-md-12">
                          <fieldset>
                            <div class="form-floating">
                              <input name="pRemarks" value="<?= $row['reqRemarks']; ?>" type="text" class="form-control" id="pRemarks" placeholder="Remarks" readonly>
                              <label for="pRemarks">Remarks</label>
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
                        <div class="float">
                          <br>
                              
                        <?php
                        if($row['r_Status'] == 0) { ?>
                          <!-- <button name="btnReject" id="btnReject" class="btn btn btn-success btn-md">&nbsp;&nbsp;Pending&nbsp;&nbsp;</button> -->
                          <img id="rStatus" src="statusImage/1.png" alt="">
                        <?php }
                        if ($row['r_Status'] == 1) {
                        ?>
                          <img id="rStatus" src="statusImage/2.png" alt="">
                        <?php }
                        if ($row['r_Status'] == 2 || $row['r_Status'] == 6) {
                        ?>
                          <img id="rStatus" src="statusImage/3.png" alt="">
                        <?php }
                        if ($row['r_Status'] == 3) {
                        ?>
                          <img id="rStatus" src="statusImage/4.png" alt="">
                        <?php }
                        if($row['r_Status'] == 4) { ?>
                          <img id="rStatus" src="statusImage/5.png" alt="">
                            <?php } 
                        if($row['r_Status'] == 5) { ?>
                        <br>
                            <!-- <button name="btnReject" id="btnReject" class="btn btn-danger btn-md">&nbsp;&nbsp;Rejected&nbsp;&nbsp;</button> -->
                            <fieldset>
                              <div class="status">
                                <label>Status:</label>
                                <span class="badge bg-danger">
                                  REJECTED
                                </span>
                              </div>
                          </fieldset>
                        </div>  
                        <br>
                        <?php } 
                        else {
                          echo "";
                        }
                        ?>  

      <?php
    }
  }
  else {
    echo "<br><br>No Record Found";
  }

?>
                        <!-- <div class="col-12">
                          <fieldset>
                            <div class="form-floating">
                              <span>Approved</span>
                              <label for="pRemark">Status</label>
                            </div>
                          </fieldset>
                        </div>  
                        <br> -->
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
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
  crossorigin="anonymous">
</script>
<script>
if(typeof jQuery === 'undefined'){
  document.write('<script src="js/popper2116.min.js"><\/script>');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
  crossorigin="anonymous">
</script>
<script>
if(typeof jQuery === 'undefined'){
  document.write('<script src="js/bootstrap.bundle521.min.js"><\/script>');
}
</script>

<script type="text/javascript">
  // Refresh Rate is how often you want to refresh the page 
  // bassed off the user inactivity. 
  var refresh_rate = 10; //<-- In seconds, change to your needs
  var last_user_action = 0;
  var has_focus = false;
  var lost_focus_count = 0;
  // If the user loses focus on the browser to many times 
  // we want to refresh anyway even if they are typing. 
  // This is so we don't get the browser locked into 
  // a state where the refresh never happens.    
  var focus_margin = 10;

  // Reset the Timer on users last action
  function reset() {
    last_user_action = 0;
    updateVisualTimer('Reset Timer');
  }

  function updateVisualTimer(value) {
    var element = document.getElementById('refreshTimer');
    if (value) {
      element.value = value;
    } else if (has_focus) {
      element.value = 'User has focus won\'t refresh';
    } else if (last_user_action >= refresh_rate) {
      element.value = 'Refreshing';
    } else {
      element.value = (refresh_rate - last_user_action);
    }
  }

  function windowHasFocus() {
    has_focus = true;
  }

  function windowLostFocus() {
    has_focus = false;
    lost_focus_count++;
    console.log(lost_focus_count + " <~ Lost Focus");
  }

  // Count Down that executes ever second
  setInterval(function() {
    last_user_action++;
    refreshCheck();
    updateVisualTimer();
  }, 1000);

  // The code that checks if the window needs to reload
  function refreshCheck() {
    var focus = window.onfocus;
    if ((last_user_action >= refresh_rate && !has_focus && document.readyState == "complete") || lost_focus_count > focus_margin) {
      window.location.reload(); // If this is called no reset is needed
      reset(); // We want to reset just to make sure the location reload is not called.
    }

  }
  // window.addEventListener("focus", windowHasFocus, false);
  window.addEventListener("blur", windowLostFocus, false);
  window.addEventListener("click", reset, false);
  window.addEventListener("mousemove", reset, false);
  window.addEventListener("keypress", reset, false);
  window.addEventListener("scroll", reset, false);
  document.addEventListener("touchMove", reset, false);
  document.addEventListener("touchEnd", reset, false);

</script>   
  
</body>
</html>