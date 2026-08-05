<?php
include ('connection.php'); // replace with your DB connection

$sessionId = $_SESSION['userid'];

$title = "SELECT * FROM chatbox WHERE notif = 2 AND receiver = '$sessionId'";
$result = mysqli_query($con, $title);
$rowCount = mysqli_num_rows($result);

if ($rowCount > 0) {
    echo "You have a new message | OUR Bank Dashboard";
} else {
    echo "OUR Bank Dashboard";
}
?>