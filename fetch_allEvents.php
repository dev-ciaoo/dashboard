<?php
include('connection.php');

date_default_timezone_set('Asia/Manila');

$id = $_SESSION['userid'];

$query = "SELECT d.*, a.fullName FROM duecalendar AS d
                                JOIN accounts AS a
                                ON a.userId = d.calendar_sender WHERE updateStats <> 1";
$result = $con->query($query);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userName = $row['calendar_userName'];
        $date = date('Y-m-d', strtotime($row['dateToday']));
        $time = $row['setTime'];
        $text = $row['calendar_msg'];
        $receiver = $row['calendar_receiver'];
        $sender = $row['calendar_sender'];
        $email = $row['calendar_userEmail'];
        $receiverStats = $row['receiver_stats'];
        $fullName = $row['fullName'];

        $key = $date . '|' . $time . '|' . $text;
        if (!isset($events[$key])) {
            $events[$key] = [
                'userName' => $userName,
                'date' => $date,
                'time' => $time,
                'text' => $text,
                'receiver' => $receiver,
                'sender' => $sender,
                'email' => $email,
                'receiverStats' => $receiverStats,
                'fullName' => $fullName
            ];
        } else {
            $events[$key]['email'] .= ',' . $email;
        }
    }
}

echo json_encode(array_values($events));
?>
