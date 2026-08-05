<?php
include('connection.php');

date_default_timezone_set('Asia/Manila');

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

$date = $data['date'];
$time = $data['time'];
$timeTo = $data['timeTo'] ?? '';
$text = $data['text'];
$email = $data['email']; // comma-separated emails
$creatorId = $_SESSION['userid'];

// 🔍 Find matching events
$findQuery = "SELECT id, calendar_userEmail 
                                            FROM duecalendar 
                                                WHERE dateToday = ? 
                                                    AND setTime = ? 
                                                    AND calendar_msg = ? 
                                                    AND calendar_sender = ?";
$stmt = $con->prepare($findQuery);
$stmt->bind_param('sssi', $date, $time, $text, $creatorId);
$stmt->execute();
$result = $stmt->get_result();

$eventIds = [];
$emails = [];

while ($row = $result->fetch_assoc()) {
    $eventIds[] = $row['id'];
    $emails[] = $row['calendar_userEmail'];
}

// ❌ Delete events
$deleteSuccess = true;

foreach ($eventIds as $eventId) {
    $deleteQuery = "UPDATE duecalendar SET updateStats = 1 WHERE id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param('i', $eventId);

    if (!$stmt->execute()) {
        $deleteSuccess = false;
        break;
    }
}

// ✅ Response
if ($deleteSuccess) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to delete event.'
    ]);
}
?>