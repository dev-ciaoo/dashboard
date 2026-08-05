<?php
include('connection.php');

if (isset($_POST['messageId'])) {
    $messageId = intval($_POST['messageId']);
    $userId = $_SESSION['userid'];

    // Update only messages received by the current user
    $update = "UPDATE chatbox SET notif = 1 WHERE id = '$messageId' AND receiver = '$userId'";
    $query = mysqli_query($con, $update);

    if ($query) {
        echo "Notification updated";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
