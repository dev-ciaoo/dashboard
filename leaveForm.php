<?php
include('connection.php');
require 'auth_check.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Leave Form</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap521.min.css" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./css/style.css">

</head>
<body>
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
              <div class="leave-form shadow-lg p-1 mb-4">
                  <div class="pads">
                  <div class="row">
                  <!-- <div class="col"><img class="leave-image" src="./logo/logo.png" alt="logo"></div> -->
                  <div class="col-md-12">
                    <br>
                    <div class="section-heading">
                      <h3>Leave / Official Business / Overtime Request Form</h3> 
                    </div>
                    <form id="leaveForm" method="post" enctype="multipart/form-data">
                    <span id="dateToday">Date: 
                      <?php 
                        date_default_timezone_set('Asia/Manila');
                        $myDate = date('F j, Y \a\t g:i A');
                        echo date('F j, Y'); 
                      ?>
                    </span>
                      <input type="hidden" id="dateToday" name="myDate" value="<?= $myDate; ?>">
                      <div class="row">
                              <input name="toEmail" value="<?= $data['eMail'];?>" type="hidden"  class="form-control" id="toEmail">
                              <input name="employee_Id" value="<?= $data['employeeId']; ?>"type="hidden" class="form-control" id="employee_Id">     
                        <div class="col-md-6">
                          <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="iName" value="<?= $data['fullName']; ?>"type="text" class="form-control" id="iName" placeholder="Full Name" required readonly>
                              <label for="iName">Full Name</label>
                            </div>
                          </fieldset><br>
                        </div>
                        <input name="iBranch" value="<?= $data['address']; ?>" type="hidden" class="form-control" id="iBranch">
                        <div class="col-md-6">
                          <fieldset><br>
                            <div class="form-floating">
                              <input name="iEmail" value="<?= $data['userEmail']; ?>" type="email" class="form-control" id="iEmail" placeholder="E-Mail" required readonly>
                              <label for="iEmail">Email</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-6">
                          <fieldset>
                            <div class="form-floating">
                              <select name="iCategory" class="form-control" id="iCategory" required>
                                <option value="" disabled selected>-- Select Reason of Leave --</option>
                                <?php
                                // Secure prepared statement
                                $stmt = $con->prepare("
                                                        SELECT a.*, e.* 
                                                        FROM accounts AS a
                                                        LEFT JOIN empinfo AS e ON a.employeeId = e.empId 
                                                        WHERE userId = ?
                                                    ");
                                $stmt->bind_param("s", $_SESSION['userid']);
                                $stmt->execute();
                                $fetchLeave = $stmt->get_result()->fetch_assoc();

                                // Stop errors if no result
                                if ($fetchLeave) {

                                    if ($fetchLeave['empStatus'] !== 'Probationary') {

                                        // Leave types mapped to DB fields
                                        $leaveTypes = [
                                            'Mandatory Leave'  => 'ML',
                                            'Vacation Leave'   => 'VL',
                                            'Sick Leave'       => 'SL',
                                            'Emergency Leave'  => 'EL',
                                            'Paternity Leave'  => 'PT',
                                            'Maternity Leave'  => 'MT'
                                        ];

                                        // Auto-generate leave options
                                        foreach ($leaveTypes as $label => $field) {
                                            $hasCredits = floatval($fetchLeave[$field]) >= 0.5;

                                            echo '<option value="'. $label .'" '.
                                                ($hasCredits ? '' : 'disabled style="background:#C0C0C0;"') .
                                                '>'. $label .'</option>';
                                        }
                                        ?>

                                        <!-- Fixed-value options -->
                                        <option value="Work From Home">Work From Home</option>
                                        <option value="Unpaid Leave">Unpaid Leave</option>
                                        <option value="Official Business">Official Business</option>
                                        <option value="Overtime">Overtime</option>
                                        <!-- <option value="Other">Other</option> -->

                                    <?php
                                    } else {
                                        echo "<option value='Unpaid Leave'>Unpaid Leave</option>
                                              <option value='Official Business'>Official Business</option>
                                              <option value='Overtime'>Overtime</option>
                                            ";
                                    }

                                } else {
                                    // Fallback if no user found
                                    echo "<option disabled>Error: User not found</option>";
                                }
                                ?>
                                </select>
                              <label for="iCategory">Reason of Leave / Official Business </label>
                            </div>
                          <fieldset>
                        </div>  
                        <div class="col-md-6">
                          <!-- <input type="text" name="iMessage" class="form-control" id="iMessage" placeholder="Reason / Destination">
                          </div>
                          <div class="col-3"> -->
                          <fieldset>
                            <div class="form-floating">
                              <input type="text" name="iMessage"  class="form-control" id="iMessage" required>
                              <label for="iMessage">Reason / Destination</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-3">
                          <fieldset>
                            <br>
                            <div class="form-floating">
                              <input name="dateFrom" type="date" class="form-control" id="dateFrom" placeholder="Date From" required>
                              <label for="dateFrom">Date From</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-3">
                          <fieldset>
                            <br>
                            <div class="form-floating">
                              <input name="dateTo" type="date" class="form-control" id="dateTo" placeholder="Date To" required>
                              <label for="dateTo">Date To</label>
                            </div>
                          </fieldset>
                        </div>
                        
                        <div class="col-2">
                          <fieldset>
                            <br>
                            <div class="form-floating">
                              <input name="timeFrom" type="time" value="08:00" class="form-control" id="timeFrom" placeholder="Time From">
                              <label for="timeFrom">Time From</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-2">
                          <fieldset>
                            <br>
                            <div class="form-floating">
                              <input name="timeTo" type="time" class="form-control" id="timeTo" placeholder="Time To" required>
                              <label for="timeTo">Time To</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-2 otDiv">
                        <fieldset>
                          <br>
                          <div class="form-floating">
                            <input name="totalHours" type="text" class="form-control" id="totalHours" placeholder="Total Hours" required>
                            <label for="totalHours">Total Hours</label>
                          </div>
                        </fieldset>
                      </div>
                        <div class="col-3 kindDayDiv m-3">
                          <fieldset>
                            <br>
                            <!-- <div class="form-floating"> -->
                              <input name="kindDay" type="checkbox" id="wholeDay" class="checkD" value="Whole Day" checked>
                              <label for="wholeDay" class="checkD">Whole Day</label>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input name="kindDay" type="checkbox" id="halfDay" class="checkD" value="Half Day">
                              <label for="halfDay" class="checkD">Half Day</label>
                            <!-- </div> -->
                          </fieldset>
                        </div>
                        <!-- <div class="col-3">
                          <fieldset>
                            <br>
                            <div class="form-floating">
                              
                            </div>
                          </fieldset>
                        </div>      -->
                        <div class="col-md-12">
                          <br><br>
                          <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-md"><strong>Submit</strong></button>
                        </div>
                      </div>
                      <fieldset>
                          <!-- <br><br><br> -->
                          <div class="status">
                              <img src="legends/green.png" alt="" width="1.2%">
                              <label><em>Sick Leave:</em></label>
                              <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em><?php echo "" . $_SESSION['SL'] . "" ?></em></span>
                          </div>

                            <div class="status">
                                  <img src="legends/blue.png" alt="" width="1.2%">
                                  <label><em>Vacation Leave:</em></label>
                                  <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em><?php echo "" . $_SESSION['VL'] . "" ?></em></span>
                            </div>  

                            <div class="status">
                              <img src="legends/yellow.png" alt="" width="1.2%">
                              <label><em>Mandatory Leave:</em></label>
                              <span>&nbsp;&nbsp;<em><?php echo "" . $_SESSION['ML'] . "" ?></em></span>
                            </div>

                            <div class="status">
                              <img src="legends/orange.png" alt="" width="1.2%">
                              <label><em>Emergency Leave:</em></label>
                              <span>&nbsp;&nbsp;<em><?php echo "" . $_SESSION['EL'] . "" ?></em></span>
                            </div>

                            <div class="status">
                              <img src="legends/purple.png" alt="" width="1.2%">
                              <label><em>Paternity Leave:</em></label>
                              <span>&nbsp;&nbsp;<em><?php echo "" . $_SESSION['PT'] . "" ?></em></span>
                            </div>

                            <div class="status">
                              <img src="legends/pink.png" alt="" width="1.2%">
                              <label><em>Maternity Leave:</em></label>
                              <span>&nbsp;&nbsp;<em><?php echo "" . $_SESSION['MT'] . "" ?></em></span>
                            </div>
                          </fieldset>
                          <div class="text-status">
                              <span>&nbsp;&nbsp;<em>NOTE: Only Sick Leave and Overtime can file LATE DATE.</em></span>
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

      

?>

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

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>  
<script type="text/javascript" language="javascript">

var allIds = ["wholeDay", "halfDay", "regularOt", "weekendOt"];

// Function to uncheck other checkboxes
function uncheck(event) {
  var clickedId = event.target.id;
  
  allIds.forEach(function (id) {
    if (id !== clickedId) {
      jQuery("#" + id).prop("checked", false); // Use jQuery for consistency
    }
  });
}

// Attach event listener to all checkboxes
jQuery(allIds.map(id => `#${id}`).join(",")).on("click", uncheck);


$('.otDiv').hide();
$('.kindDayDiv').hide();
$('.checkOT').hide();


$('#iCategory').change(function (){
  if($(this).val() == 'Mandatory Leave' || $(this).val() == 'Vacation Leave' || $(this).val() == 'Sick Leave' || $(this).val() == 'Emergency Leave' || 
      $(this).val() == 'Unpaid Leave'){
    $('.kindDayDiv').show();
  }
  else{
    $('.kindDayDiv').hide();
  }

  if($(this).val() == 'Overtime'){
    var totalHours = $('#totalHours');
    $('.otDiv').show();
    $('.checkOT').show();
    totalHours.prop('required', true);
  }else{
    $('.otDiv').hide();
    $('.checkOT').hide();
    $('#totalHours').prop('required', false);
    
  }

});

// $('.checkD').change(function (){
// 	alert($(this).val());
// });


$(document).on('click', '#btnSubmit', function(event) {
    event.preventDefault(); 
	  $("#btnSubmit").attr('disabled','true');
    $("#btnSubmit").attr('value','Processing...');

    // Initialize FormData with the form element
    var formData = new FormData(document.getElementById('leaveForm')); 

    if (confirm("Are you sure to submit this?")) {
        $.ajax({
            url: "leaveSubmit.php", 
            data: formData,
            type: "POST",
            processData: false,
            contentType: false, 
            dataType: "json", 
            success: function(response) {
                
                if (response.success) { 
	                $("#btnSubmit").removeAttr('disabled');
	        		    $("#btnSubmit").attr('value','Submit');
                  alert(response.message || 'Leave Successfully Submitted!');
                  window.location.reload(); 
                } else {
                	$("#btnSubmit").removeAttr('disabled');
	        		    $("#btnSubmit").attr('value','Submit');
                    // Show a failure message if the server indicates an issue
                  alert('Failed: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('An error occurred: ' + (xhr.responseText || 'Undefined error'));
            }
        });
    } else {
        $("#btnSubmit").removeAttr('disabled'); 
        $("#btnSubmit").attr('value','Submit');
        return; 
    }
});

</script>
</body>
</html>