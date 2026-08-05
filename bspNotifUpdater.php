<?php
// include('connection.php');

// if (isset($_POST['notif']) && $_POST['notif'] == 1) {
//     if (!empty($_POST['username'])) {
//         // Update where notif = 2 and username matches, set notif to 1
//         $receiver = mysqli_real_escape_string($con, $_SESSION['userid']);
//         $sql = "UPDATE chatbox SET notif = 1, public_notif = 1 WHERE notif = 2 AND receiver = '$receiver' AND public_notif = 0 AND groupby = 'Public' ";
//     } else {
//         // Default behavior using session fullname
//         $fullname = mysqli_real_escape_string($con, $_SESSION['fullname']);
//         $sql = "UPDATE chatbox SET notif = 1, public_notif = 1 WHERE (text1 LIKE '%$fullname%') OR (notif = 0 AND public_notif = 0 AND groupby = 'Public' AND receiver = '$receiver')";
//     }

//     if (mysqli_query($con, $sql)) {
//         echo "Notification updated successfully.";
//     } else {
//         echo "Error updating notification: " . mysqli_error($con);
//     }
// } else {
//     echo "Invalid request.";
// }

include('connection.php');


// Check if the notif parameter is set and has a value of 1
if(isset($_POST['notif']) && $_POST['notif'] == 1) {
    // Update your database table
    if (!empty($_POST['username']) || $_POST['username'] == '0') {
        $receiver = mysqli_real_escape_string($con, $_SESSION['userid']);
        $sql = "UPDATE chatbox SET notif = 1, public_notif = 1 WHERE (text1 LIKE '%" . $_SESSION['fullname'] . "%') OR (receiver = '$receiver' AND public_notif = 0 AND groupby = 'Public')";
        
        if(mysqli_query($con, $sql)) {
            // Query executed successfully
            echo "Notification updated successfully.";
        } else {
            // Error executing query
            echo "Error updating notification: " . mysqli_error($con);
        }
    }
} else {
    // Handle case where notif parameter is not set or not equal to 1
    echo "Invalid request.";
}

?>
