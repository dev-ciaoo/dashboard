<?php
include('connection.php');

if($_SESSION['department'] == 1){
    $selectCount = "SELECT r.* FROM `accounts` as a
                JOIN `request` as r ON r.r_user_Id = a.userId
                WHERE r.r_Status IN (2, 7)";
}else{
    $selectCount = "SELECT r.* FROM `accounts` as a
                JOIN `request` as r ON r.r_user_Id = a.userId
                WHERE r.r_Status IN (2, 7) AND tag = 'HR'";
}

// $selectText = "SELECT * from chatbox ORDER BY id DESC";
$queryText = mysqli_query($con, $selectCount);
$rowNotif = mysqli_num_rows($queryText);

if($rowNotif >= 1){
    echo '<span>' . $rowNotif . '</span>';
}else{
    echo '<span id="notificationCount3 style="color: white;""></span>';
}

// Close database connection
mysqli_close($con);
?>

