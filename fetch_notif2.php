<?php
include('connection.php');

$notif2 = "SELECT * FROM `chatbox` WHERE notif = 2 AND groupby = '' AND receiver = '" . $_SESSION['userid'] . "' ";
$queryNotif2 = mysqli_query($con, $notif2);
$rowNotif2 = mysqli_num_rows($queryNotif2);

if($rowNotif2 >= 1){
    echo '<span id="messageNotif2" style="font-size: 9.5px; height: 0.8px; width: 10px; border-radius: 20%; text-align: center;">' . $rowNotif2 . '</span>';
}else{
    echo '<span id="messageNotif2 style="display:none;"></span>';
}

mysqli_close($con);
?>