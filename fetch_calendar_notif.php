<?php
include('connection.php');

$notif = "SELECT * FROM `duecalendar` WHERE `calendar_receiver` = '" . mysqli_real_escape_string($con, $_SESSION['userid']) . "' 
                                    AND calendar_stats <> 0 AND updateStats <> 1
                                    AND `calendar_sender` <> '" . mysqli_real_escape_string($con, $_SESSION['userid']) . "' ";
$queryNotif = mysqli_query($con, $notif);
$rowNotif = mysqli_num_rows($queryNotif);

if($rowNotif >= 1){
    echo '<span id="calendarNotif" >' . $rowNotif . '</span>';
}else{
    echo '<span id="calendarNotif style="color: white;""></span>';
}

mysqli_close($con);
?>