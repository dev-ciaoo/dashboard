<?php
include('connection.php');

$notif = "SELECT * FROM `chatbox` WHERE receiver = '" . $_SESSION['userid'] . "' AND `text1` LIKE '%" . mysqli_real_escape_string($con, $_SESSION['fullname']) . "%' AND notif = 2 AND groupby = 'Public'";
$queryNotif = mysqli_query($con, $notif);
$rowNotif = mysqli_num_rows($queryNotif);

if($rowNotif >= 1){
    echo '<span id="messageNotif" style="font-size: 11.5px; height: 1.3px; width: 13px; border-radius: 5px; text-align: center;">' . $rowNotif . '</span>';
}else{
    echo '<span id="messageNotif" style="display: none;"></span>';
}

mysqli_close($con);
?>