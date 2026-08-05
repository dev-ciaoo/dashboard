<?php
include('connection.php');

$sender = $_SESSION['userid'];
$receiver = $_POST['userId'];

if($receiver == ''){
    $selectText = "SELECT c.*, a.* FROM chatbox as c 
                    JOIN accounts as a ON a.userName = c.username
                    WHERE (c.sender, c.receiver, c.time) IN (SELECT c.sender, c.receiver, MAX(c.time) AS m FROM chatbox as c 
                    WHERE c.receiver = '$sender' AND c.receiver <> 0 GROUP BY c.sender, c.receiver)";
}else{
    if($receiver == 0){
        $selectText = "SELECT c.*, a.* FROM chatbox as c 
                        JOIN accounts as a ON a.userName = c.username
                        WHERE c.receiver = 0 ORDER BY c.id ASC";
    }else{
        $selectText = "SELECT c.*, a.* FROM chatbox as c 
                        JOIN accounts as a ON a.userName = c.username
                        WHERE (c.sender = '$sender' AND c.receiver = '$receiver') OR (c.sender = '$receiver' AND c.receiver = '$sender') ORDER BY c.id ASC";
    }
}

// $selectText = "SELECT * from chatbox ORDER BY id DESC";
$queryText = mysqli_query($con, $selectText);

// Output chat messages in HTML format
while ($row = mysqli_fetch_assoc($queryText)) {
    $highlightClass = '';

    // Check if text1 contains the user's fullname
    if (strpos($row['text1'], $_SESSION['fullname']) !== false && $row['notif'] == 0) {
        // If yes, add a class for highlighting
        $highlightClass = 'highlighted';
    }

    if($row['notif'] == 2){
        $highlightClass = 'highlighted';
    }

    // Output the chat message with the appropriate class
    echo 
        '<div class="chat-message ' . htmlspecialchars($highlightClass) . '" title="' . htmlspecialchars( $row['myDate'] . ', ' . $row['time']) . '">
            <div class="chat-row">
                <div class="chat-avatar" onclick="reply(\'' . htmlspecialchars($row['username']) . '\', \'' . htmlspecialchars($row['fullName']) . '\')" style="cursor: pointer;">
                    <img src="' . htmlspecialchars($row['userAvatar']) . '" 
                        alt="'. htmlspecialchars($row['username']) .'" 
                        title="'. htmlspecialchars($row['fullName']) .'"  
                        class="avatar-img">
                </div>
                <div class="chat-text">
                    ' . htmlspecialchars($row['fullName']) . '
                </div>
            </div>
        </div>';

}

// Close database connection
mysqli_close($con);
?>

