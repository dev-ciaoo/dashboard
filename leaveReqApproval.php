<?php
include('connection.php');
include('notificationCount.php');
require 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta Http-Equiv="Cache-Control" Content="no-cache">
  <meta Http-Equiv="Pragma" Content="no-cache">
  <meta Http-Equiv="Expires" Content="0">
  <meta Http-Equiv="Pragma-directive: no-cache">
  <meta Http-Equiv="Cache-directive: no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="A inventory web app for OUR Bank.">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Leave Request Approval</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<script>
  function reloadPage(){
    window.location = '';
  }
</script>
<body>

<?php
  // $sql = "SELECT * FROM `leavetbl` WHERE iStatus = 1 ORDER BY id DESC LIMIT 1";
  if($_SESSION['position'] == 'Head'){
    if($_SESSION['username'] == 'jcvillanueva'){
      $sql = "SELECT d.departmentName, l.*, a.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND l.iStatus = 1 AND a.userId <> '" . $_SESSION['userid'] . "' ORDER BY a.userId DESC LIMIT 1";
      // $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
      //           JOIN `department` as d ON d.id = a.userDepartment
      //           JOIN `leavetbl` as l ON l.user_Id = a.userId
      //           WHERE l.iStatus = 1 AND a.userPosition <> 'Staff'
      //           AND a.userId <> '" . $_SESSION['userid'] . "'
      //           ORDER BY a.userId DESC LIMIT 1";
    } else if ($_SESSION['username'] == 'jbquijano') {
      $sql =  "SELECT d.departmentName, l.*, a.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                          WHERE d.id IN (4, 3)
                                                  AND l.iStatus = 1 ORDER BY a.userId DESC LIMIT 1";
    }
     else{
      $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND l.iStatus = 1 AND a.userPosition = 'Staff' ORDER BY a.userId DESC LIMIT 1";
    }
    
  } else if($_SESSION['position'] == 'BM'){
      // if($_SESSION['username'] !== 'mruazol'){
        $sql = "SELECT d.departmentName, l.*, a.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND a.address = '" . $_SESSION['address'] . "'
                AND l.iStatus = 1 AND a.userPosition = 'Staff' ORDER BY a.userId DESC LIMIT 1";
      // }else{
      //   $sql = "SELECT d.*, l.*, a.* FROM `accounts` as a 
      //           JOIN `department` as d  ON d.id = a.userDepartment
      //           JOIN `leavetbl` as l ON l.user_Id = a.userId
      //             WHERE  d.id IN (12, 14)
      //               AND a.address IN ('Maragondon', 'Ternate')
      //               AND l.iStatus = 1 AND a.userPosition = 'Staff' ORDER BY a.userId DESC LIMIT 1";
      // }
  } else if($_SESSION['position'] == 'GM'){
    $sql = "SELECT d.departmentName, l.*, a.* FROM `accounts` as a
                JOIN `department` as d ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE (
                        (l.iStatus = 1 AND a.userPosition <> 'Staff') 
                        OR 
                        (l.iStatus = 4 AND a.userPosition = 'Staff')
                        OR
                        (l.iStatus = 1 AND a.userPosition = 'Staff' AND a.userName = 'jlcvalero')
                      )
                      AND a.userId <> '" . $_SESSION['userid'] . "'
                      ORDER BY a.userId DESC 
                      LIMIT 1;";

  } else if($_SESSION['position'] == 'AGM'){
    $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                JOIN `department` as d ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE l.iStatus = 1 AND a.userPosition <> 'Staff' 
                ORDER BY a.userId DESC LIMIT 1";

  }  else {
    echo "";
  }

  if($_SESSION['bankposition'] == 'Developer'){
    $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                JOIN `department` as d ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE l.iStatus = 1 ORDER BY a.userId DESC LIMIT 1";

  } else if($_SESSION['bankposition'] == 'Branch Cashier') {
    $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND a.address = '" . $_SESSION['address'] . "'
                AND l.iStatus = 1 AND a.userPosition = 'Staff'  
                ORDER BY a.userId DESC LIMIT 1";
                // AND a.userName <> '". $_SESSION['username'] ."' ORDER BY a.userId DESC LIMIT 1";
  }

  $query = mysqli_query($con, $sql);
  if(mysqli_num_rows($query) > 0) {
    foreach($query as $row) {
      ?>
    <section class="forms">
            <div class="container-fluid">
              <div class="request-form shadow-lg p-1 mb-4">
                  <div class="pads">
                  <div class="row">
                  <!-- <div class="col"><img class="leave-image" src="./logo/logo.png" alt="logo"></div> -->
                  <div class="col-md-12">
                    <div class="section-heading">
                      <h2>Leave / Official Business / Overtime Form</h2>
                      <span id="dateToday">Date: <?php echo $row['myDate']; ?></span>
                    </div>
                    <form id="leaveForm" action="" method="post">
                      <div class="row">
                        <input name="rEmpId" value="<?= $row['employee_Id']; ?>" type="hidden" class="form-control" id="rEmpId">
                        <input name="rBranch" value="<?= $row['iBranch']; ?>" type="hidden" class="form-control" id="rBranch">
                        <input name="robFrom" value="<?= $row['dateFrom']; ?>" type="hidden" class="form-control" id="rOB">
                        <input name="rTo" value="<?= $row['dateTo']; ?>" type="hidden" class="form-control" id="rTo">
                        <input name="rPosition" value="<?= $row['userPosition']; ?>" type="hidden" class="form-control" id="rPosition">
                        <input name="rStatus" value="<?= $row['iStatus']; ?>" type="hidden" class="form-control" id="rStatus">
                        <div class="col-md-6">
                          <fieldset>
                            <div class="form-floating">
                              <input name="rName" value="<?= $row['iName']; ?>" type="text" class="form-control" id="rName" placeholder="Full Name"  readonly>
                              <label for="rName">Full Name</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-6">
                          <fieldset>
                            <div class="form-floating">
                              <input name="rEmail" value="<?= $row['iEmail']; ?>" type="email" class="form-control" id="rEmail" placeholder="Full Name" readonly>
                              <label for="rEmail">Email</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-3">
                          <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="rdateFrom" value="<?= $row['dateFrom']; ?>" type="date" class="form-control" id="rdateFrom" placeholder="Date From" readonly>
                              <label for="rdateFrom">Date From</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-3">
                          <fieldset><br>
                            <div class="form-floating">
                              <input name="rdateTo" value="<?= $row['dateTo']; ?>" type="date" class="form-control" id="rdateTo" placeholder="Date To" readonly>
                              <label for="rdateTo">Date To</label>
                            </div>
                          </fieldset>
                        </div>  
                        <div class="col-3">
                          <br>
                          <fieldset>
                            <div class="form-floating">
                              <input name="rtimeFrom" value="<?= $row['timeFrom']; ?>" type="time" class="form-control" id="rtimeFrom" placeholder="Time From" readonly>
                              <label for="rtimeFrom">Time From</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-3">
                          <fieldset><br>
                            <div class="form-floating">
                              <input name="rtimeTo" value="<?= $row['timeTo']; ?>" type="time" class="form-control" id="rtimeTo" placeholder="Time To" readonly>
                              <label for="rtimeTo">Time To</label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-6">
                          <fieldset><br>
                            <div class="form-floating">
                              <input name="rCategory" value="<?= $row['iCategory']; ?>" type="text" class="form-control" id="rCategory" placeholder="Full Name" readonly>
                              <label for="rCategory">Reason of Leave</label>
                            </div>
                          </fieldset><br>
                        </div>  
                        <div class="col-md-6">
                          <fieldset><br>
                            <div class="form-floating">
                              <input name="rMessage" value="<?= $row['iMessage']; ?>" type="text" class="form-control" id="rMessage" rows="5" placeholder="Reason"  readonly>
                              <label for="rMessage">Reason / Destination</label>
                            </div>
                          </fieldset>
                        </div>  
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="rRemark" class="form-control" id="rRemark" placeholder="Enter your message" rows="2" required></textarea>
                                <label for="rRemark">Remarks:</label>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $row['id']; ?>" name="reqId">
                        <input type="hidden" value="<?= $row['user_Id']; ?>" name="userID">
                        <input type="hidden" value="<?= $row['kindDay']; ?>" name="kindDay">
                        <div class="col-md-12">
                        <br>
                        <br>
                        <br>
                        <?php
                        if($row['iStatus'] == 1 || $row['iStatus'] == 4) { ?>
                          <button type="button" name="btnReject" id="btnReject" class="btn btn-danger btn-md">&nbsp;&nbsp;<strong>Reject</strong>&nbsp;&nbsp;</button>
                          <button type="button" name="btnApprove" id="btnApprove" class="btn btn-primary btn-md"><strong>Approve</strong></button>
                        <?php } 
                        else {
                          echo "";
                        }
                        ?>
<?php
    }
  }
else{
    echo "<br><br> No record found";
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

// $fullNamee = mysqli_real_escape_string($con, $_POST['rName']);
  // $empId = mysqli_real_escape_string($con, $_POST['rEmpId']);
  // $rBranch = mysqli_real_escape_string($con, $_POST['rBranch']);
  // $rPosition = mysqli_real_escape_string($con, $_POST['rPosition']);
  // // $timeFrom = mysqli_real_escape_string($con, $_POST['rtimeFrom']);
  // // $timeTo = mysqli_real_escape_string($con, $_POST['rtimeTo']);
  // // $dateFromm = mysqli_real_escape_string($con, $_POST['rFrom']);
  // // $dateToo = mysqli_real_escape_string($con, $_POST['rTo']);
  // $rStatus = $_POST['rStatus'];
  // $userID = $_POST['userID'];
  // $id = $_POST['reqId'];
  // $rRemark = $_POST['rRemark'];
  // $rCategory = $_POST['rCategory'];
  // $dateFrom = $_POST['rdateFrom'];
  // $dateTo = $_POST['rdateTo'];
  // $day = $_POST['kindDay'];

  // function number_of_working_days($startDate, $endDate){
  //   $workingDays = 0;
  //   $startTimestamp = strtotime($startDate);
  //   $endTimestamp = strtotime($endDate);

  //   for ($i = $startTimestamp; $i <= $endTimestamp; $i += 86400) { // 60 * 60 * 24
  //       if (date("N", $i) <= 5) { // Monday-Friday
  //           $workingDays++;
  //       }
  //   }
  //   return $workingDays;
  // }

  // function number_of_weekend_days($startDate, $endDate){
  //   $weekendDays = 0;
  //   $startTimestamp = strtotime($startDate);
  //   $endTimestamp = strtotime($endDate);

  //   for ($i = $startTimestamp; $i <= $endTimestamp; $i += 86400) {
  //       if (date("N", $i) > 5) { // Saturday-Sunday
  //           $weekendDays++;
  //       }
  //   }
  //   return $weekendDays;
  // }

  // $startDate = date('Y-m-d', strtotime($_POST['rdateFrom']));
  // $endDate = date('Y-m-d', strtotime($_POST['rdateTo']));
  // $workingDays = number_of_working_days($startDate, $endDate);
  // $weekendDays = number_of_weekend_days($startDate, $endDate);

  // // echo "Total number of working days between $startDate and $endDate is: " . $workingDays . " day(s).";
  // // echo "Total number of weekend days between $startDate and $endDate is: " . $weekendDays . " day(s).";
  // // print_r(intval($leaveDays));
  // // die();
  // // $sql3 = "SELECT `VL`, `SL`, `ML`  FROM `accounts` WHERE `userId` = '$userID'";
  // // $query3 = mysqli_query($con, $sql3);
  // // $result = mysqli_fetch_assoc($query3);
  // // $total = $result['VL'] - $workingDays;
  // // $total2 = $result['SL'] - $workingDays;
  // // $total3 = $result['ML'] - $workingDays;
  // // $halfdayVL = $result['VL'] - 0.5;
  // // $halfdaySL = $result['SL'] - 0.5;
  // // $halfdayML = $result['ML'] - 0.5;

  // // date_default_timezone_set('Asia/Manila');
  // // $approver = $_SESSION['username'];
  // // $dateToday = date('F j, Y \a\t g:i A');


  // // if(isset($_POST['btnApprove'])) {
  // //   $iStatus = 2; 
  // //   $iAbsent = 1;
  // //     if($result['ML'] != 0 || $result['VL'] != 0 || $result['SL'] != 0){
  // //       if($rCategory == 'Vacation Leave'){
  // //         if($result['VL'] < 0.5){
  // //           echo '<script>alert("This employee has no Available Vacation Leave.");</script>';
  // //           exit();
  // //         }
  // //         else {
  // //           if($day == 'Whole Day'){
  // //             $sql2 = "UPDATE `accounts` SET `VL` = '$total' WHERE userId = '$userID'";
  // //             $query2 = mysqli_query($con, $sql2);
  // //           }
  // //           else if($day == 'Half Day'){
  // //             $sql2 = "UPDATE `accounts` SET `VL` = '$halfdayVL' WHERE userId = '$userID'";
  // //             $query2 = mysqli_query($con, $sql2);
  // //           }
  // //         }
  // //       }
  // //       if($rCategory == 'Mandatory Leave') {
  // //         if($result['ML'] < 0.5){
  // //           echo '<script>alert("This employee has no Available Mandatory Leave.");</script>';
  // //           exit();
  // //         }
  // //         else{
  // //           if($day == 'Whole Day'){
  // //             $sql2 = "UPDATE `accounts` SET `ML` = '$total3' WHERE userId = '$userID'";
  // //             $query2 = mysqli_query($con, $sql2);
  // //           }
  // //           else if($day == 'Half Day'){
  // //             $sql2 = "UPDATE `accounts` SET `ML` = '$halfdayML' WHERE userId = '$userID'";
  // //             $query2 = mysqli_query($con, $sql2);
  // //           }
  // //         }
  // //       }
  // //       if($rCategory == 'Sick Leave'){
  // //         if($result['SL'] < 0.5){
  // //           echo '<script>alert("This employee has no more Sick Leave left.");</script>';
  // //           exit();
  // //         }
  // //         else{
  // //           if($day == 'Whole Day'){
  // //             $sql2 = "UPDATE `accounts` SET `SL` = '$total2' WHERE userId = '$userID'";
  // //             $query2 = mysqli_query($con, $sql2);
  // //           }
  // //           else if($day == 'Half Day'){
  // //             $sql2 = "UPDATE `accounts` SET `SL` = '$halfdaySL' WHERE userId = '$userID'";
  // //             $query2 = mysqli_query($con, $sql2);
  // //           }
  // //         }
  // //       }  
  // //     }
  // // }else {
  // //     $iStatus = 3;
  // //     $iAbsent = 0;
  // // }

  // // Fetch leave balances
  // $stmt = $con->prepare("SELECT `VL`, `SL`, `ML`, `EL`, `PT`, `MT` FROM `accounts` WHERE `userId` = ?");
  // $stmt->bind_param("s", $userID);
  // $stmt->execute();
  // $result = $stmt->get_result()->fetch_assoc();

  // // Ensure $workingDays is properly set
  // $workingDays = isset($workingDays) ? $workingDays : 1;

  // // Compute leave deductions
  // $totalVL = max(0, $result['VL'] - $workingDays);
  // $totalSL = max(0, $result['SL'] - $workingDays);
  // $totalML = max(0, $result['ML'] - $workingDays);
  // $totalPT = max(0, $result['PT'] - $workingDays);
  // $totalMT = max(0, $result['MT'] - $workingDays);
  // $totalEL = max(0, $result['EL'] - $workingDays);
  // $halfdayPT = max(0, $result['PT'] - 0.5);
  // $halfdayMT = max(0, $result['MT'] - 0.5);
  // $halfdayVL = max(0, $result['VL'] - 0.5);
  // $halfdaySL = max(0, $result['SL'] - 0.5);
  // $halfdayML = max(0, $result['ML'] - 0.5);
  // $halfDayEL = max(0, $result['EL'] - 0.5);

  // date_default_timezone_set('Asia/Manila');
  // $approver = $_SESSION['username'];
  // $dateToday = date('F j, Y \a\t g:i A');

  // if (isset($_POST['btnApprove'])) {
  //     $iStatus = 2;
  //     $iAbsent = 1;

  //     if ($rCategory == 'Vacation Leave') {
  //         if ($result['VL'] < 0.5) {
  //             echo '<script>alert("This employee has no Available Vacation Leave.");</script>';
  //             exit();
  //         }
  //         $newVL = ($day == 'Whole Day') ? $totalVL : $halfdayVL;
  //         $sql2 = "UPDATE `accounts` SET `VL` = '$newVL' WHERE userId = '$userID'";
  //     }

  //     if ($rCategory == 'Mandatory Leave') {
  //         if ($result['ML'] < 0.5) {
  //             echo '<script>alert("This employee has no Available Mandatory Leave.");</script>';
  //             exit();
  //         }
  //         $newML = ($day == 'Whole Day') ? $totalML : $halfdayML;
  //         $sql2 = "UPDATE `accounts` SET `ML` = '$newML' WHERE userId = '$userID'";
  //     }

  //     if ($rCategory == 'Sick Leave') {
  //         if ($result['SL'] < 0.5) {
  //             echo '<script>alert("This employee has no more Sick Leave left.");</script>';
  //             exit();
  //         }
  //         $newSL = ($day == 'Whole Day') ? $totalSL : $halfdaySL;
  //         $sql2 = "UPDATE `accounts` SET `SL` = '$newSL' WHERE userId = '$userID'";
  //     }

  //     if ($rCategory == 'Emergency Leave') {
        
  //         if ($result['EL'] < 0.5) {
  //           echo '<script>alert("This employee has no more Emergency Leave left.");</script>';
  //           exit();
  //         }

  //         if($rPosition == 'Staff' && $rStatus == 1) {
  //           $status4 = 4;
  //           $updateELeave = "UPDATE leavetbl SET iStatus = ? WHERE id = ?";
  //           $stmt4 = $con->prepare($updateELeave);
  //           $stmt4->bind_param("ii", $status4, $id);
  //           $stmt4->execute();

  //           if($stmt4->affected_rows === 0) {
  //             die("Error Updating Record: " . $stmt4->error);
  //           }

  //           $stmt4->close();

  //           echo  ' <script>
  //                     alert("Successfully Approved!");
  //                     reloadPage();
  //                   </script>
  //                 ';
  //                 exit();
  //           // $updateELeave = "UPDATE leavetbl SET iStatus = 4 WHERE id = '$id'";
  //           // $queryy = mysqli_query($con, $updateELeave);
  //           // if(!$queryy) {
  //           //   die("Error updating record: " . mysqli_error($con));
  //           // }else{
  //           //   echo '<script>alert("Successfully Approved!");</script>';
  //           // }
  //           // exit();
  //         }
  //         $newEL = ($day == 'Whole Day') ? $totalEL : $halfdayEL;
  //         $sql2 = "UPDATE `accounts` SET `EL` = '$newEL' WHERE userId = '$userID'";
  //     }

  //      if ($rCategory == 'Paternity Leave') {
  //         if ($result['PT'] < 0.5) {
  //             echo '<script>alert("This employee has no more Paternity Leave left.");</script>';
  //             exit();
  //         }
  //         $newPT = ($day == 'Whole Day') ? $totalPT : $halfdayPT;
  //         $sql2 = "UPDATE `accounts` SET `PT` = '$newPT' WHERE userId = '$userID'";
  //     }

  //      if ($rCategory == 'Maternity Leave') {
  //         if ($result['MT'] < 0.5) {
  //             echo '<script>alert("This employee has no more Maternity Leave left.");</script>';
  //             exit();
  //         }
  //         $newMT = ($day == 'Whole Day') ? $totalMT : $halfdayMT;
  //         $sql2 = "UPDATE `accounts` SET `MT` = '$newMT' WHERE userId = '$userID'";
  //     }

  //     // Execute SQL update query
  //     if (isset($sql2)) {
  //         $query2 = mysqli_query($con, $sql2);
  //         if (!$query2) {
  //             die("Error updating leave balance: " . mysqli_error($con));
  //         }
  //     }
  // } else {
  //     $iStatus = 3;
  //     $iAbsent = 0;
  // }

  // if($rCategory == 'Overtime' || $rCategory == 'Official Business'){
  //   $workingDays = 0;
  // }

  // if($rCategory == 'Offical Business'){
  //   $current_date = date('Y-m-d H:i:s');
  //   $start = new DateTime($dateFrom);
  //   $end = new DateTime($dateTo);

  //   while ($start->format('Y-m-d') <= $end->format('Y-m-d')) {
  //       if ($start->format('N') <= 5) { // Skip weekends
  //         $currentDate = $start->format('Y-m-d');

  //         $insertOB_Out = "INSERT INTO payroll (`name`, `employeeId`, `time`, `branch`, `date`, `datesubmitted`) 
  //                                 VALUES 
  //                                       ('$fullNamee', '$empId', '16:00:00', '$rBranch', '$currentDate', '$current_date')";
  //         $insertOB_In = "INSERT INTO payroll (`name`, `employeeId`, `time`, `branch`, `date`, `datesubmitted`) 
  //         VALUES 
  //               ('$fullNamee', '$empId', '8:00:00', '$rBranch', '$currentDate', '$current_date')";

  //         // Execute Out Time Query
  //         if (mysqli_query($con, $insertOB_Out)) {
  //             echo "Record inserted successfully for OUT time on date: $currentDate<br>";
  //         } else {
  //             echo "Error inserting OUT time on date: $currentDate - " . mysqli_error($con) . "<br>";
  //         }

  //         // Execute In Time Query
  //         if (mysqli_query($con, $insertOB_In)) {
  //             echo "Record inserted successfully for IN time on date: $currentDate<br>";
  //         } else {
  //             echo "Error inserting IN time on date: $currentDate - " . mysqli_error($con) . "<br>";
  //         }
  //       }
  //       $start->modify('+1 day'); 
  //   }
  // }

  // if ($day == 'Half Day' && $startDate == $endDate) {
  //   $workingDays *= 0.5;
  // }

  // $totalWorkingDays = $workingDays;

  // $sqlU = "UPDATE `leavetbl` SET `workingDays` = $totalWorkingDays, `iStatus` = '$iStatus', `iRemarks` = '$rRemark', `timeApproved` = '$dateToday', `approver` = '$approver', `iAbsent` = '$iAbsent' WHERE id=$id";
  // $queryU = mysqli_query($con, $sqlU);

  // if($queryU == true){
  //     echo 
  //         "<script>
  //             alert('Successfully Submitted!');
  //             reloadPage();
  //           </script>
  //         ";
  // }
  // else{
  //     echo "";
  // }
  ?>

<!-- jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  if(typeof jQuery === 'undefined'){
    document.write('<script src="js/jquery371.min.js"><\/script>');
  }
</script>

<!-- Bootstrap 5 Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  if(typeof jQuery === 'undefined'){
    document.write('<script src="js/bootstrap.bundle521.min.js"><\/script>');
  }
</script>


<!-- <script src="js/script.js"></script> -->

<!-- <script>
document.getElementById("btnApprove").addEventListener("click", function () {
  console.log("Button clicked!");
  this.disabled = true; // 🚫 Disable after first click
});
</script> -->

<script>
$(document).on('click', '#btnApprove', function () {
    // alert("test");
    const btn = $(this);
    btn.prop('disabled', true);

    $.ajax({
        url: 'processLeaveApproval.php',
        type: 'POST',
        data: $('#leaveForm').serialize(),
        dataType: 'json',
        success: function (res) {

            alert(res.message);

            if (res.status === 'success') {
                location.reload();
            } else {
                btn.prop('disabled', false);
            }
        },
        error: function () {
            alert('Something went wrong.');
            btn.prop('disabled', false);
        }
    });
});

$(document).on('click', '#btnReject', function () {
    // alert("test");
    const btn = $(this);
    btn.prop('disabled', true);

    $.ajax({
        url: 'processLeaveReject.php',
        type: 'POST',
        data: $('#leaveForm').serialize(),
        dataType: 'json',
        success: function (res) {

            alert(res.message);

            if (res.status === 'success') {
                location.reload();
            } else {
                btn.prop('disabled', false);
            }
        },
        error: function () {
            alert('Something went wrong.');
            btn.prop('disabled', false);
        }
    });
});

</script>



</body>

</html>