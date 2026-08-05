<?php
include('connection.php');

$selectCount = "SELECT d.departmentName, r.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `request` as r ON r.r_user_Id = a.userId
                WHERE r.r_Status = 1";

// $selectText = "SELECT * from chatbox ORDER BY id DESC";
$queryText = mysqli_query($con, $selectCount);
$rowNotif = mysqli_num_rows($queryText);

if($rowNotif >= 1){
    echo '<span id="notificationCount5" style="font-size: 10px; height: 15px; width: 8px; border-radius: 25%; text-align: center; margin-top: -0.2rem">' . $rowNotif . '</span>';
}else{
    echo '<span id="notificationCount5 style="color: white;""></span>';
}

// Close database connection
mysqli_close($con);
?>

