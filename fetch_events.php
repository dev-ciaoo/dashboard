<?php
include('connection.php');

date_default_timezone_set('Asia/Manila');

$userId = $_SESSION['userid'];

// ✅ Use prepared statement (safer)
$query = "SELECT * 
          FROM duecalendar 
          WHERE (calendar_receiver = ? OR calendar_sender = ?) 
          AND updateStats <> 1 
          ORDER BY dateToday, setTime ASC";

$stmt = $con->prepare($query);
$stmt->bind_param("ii", $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $eventId = $row['id'];
        $date = date('Y-m-d', strtotime($row['dateToday']));
        $time = $row['setTime'];
        $timeTo = $row['setTimeTo'] ?? ''; // ✅ avoid undefined/null
        $text = $row['calendar_msg'];
        $receiver = $row['calendar_receiver'];
        $sender = $row['calendar_sender'];
        $email = $row['calendar_userEmail'];
        $receiverStats = $row['receiver_stats'];
        $calendarStats = $row['calendar_stats'];

        // ✅ Unique key (same logic, just clearer)
        $key = "{$date}|{$time}|{$text}";

        if (!isset($events[$key])) {
            $events[$key] = [
                'id' => $eventId,
                'date' => $date,
                'time' => $time,
                'timeTo' => $timeTo,
                'text' => $text,
                'receiver' => $receiver,
                'sender' => $sender,
                'email' => $email,
                'receiverStats' => $receiverStats,
                'calendar_stats' => $calendarStats
            ];
        } else {
            // ✅ Append emails cleanly
            $events[$key]['email'] .= ',' . $email;
        }
    }
}

// ✅ Reset array index (same as your array_values)
echo json_encode(array_values($events));
?>