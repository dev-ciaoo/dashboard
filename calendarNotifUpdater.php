<?php
include('connection.php');

// if(isset($_POST['hiddenId'])){

// $hiddenId = $_POST['hiddenId'];
// $sql = "UPDATE duecalendar SET calendar_stats = 0 WHERE calendar_receiver = '$hiddenId'";
// $qry = mysqli_query($con, $sql);

// if(!$qry){
//     echo "Error: " . mysqli_error($con);
// }

// }

// $con->close();

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['date']) && isset($data['events'])) {
    $date = $data['date'];
    $events = $data['events'];
    $stats = 0;

    foreach ($events as $event) {
        $time = $event['time'];
        $text = $event['text'];
        $sender = $event['sender']; 
        $email = $event['email'];
        $receiverStats = $event['receiverStats'];

        // Prepare and execute the SQL statement
        $stmt = $con->prepare("UPDATE duecalendar SET calendar_stats = ? WHERE dateToday = ? AND `setTime` = ?");
        $stmt->bind_param("iss", $stats, $date, $time);

        if (!$stmt->execute()) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update event: ' . $stmt->error]);
            $stmt->close();
            $con->close();
            exit();
        }
        $stmt->close();
    }

    echo json_encode(['status' => 'success', 'message' => 'Database updated successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
}

$con->close();

?>
