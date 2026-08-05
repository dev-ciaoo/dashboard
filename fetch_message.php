<?php
include('connection.php');

$sender = $_SESSION['userid'];
$receiver = $_POST['userId'];

// Define group mappings
$groupChats = [
    '0' => [
        'name' => 'Public',
        'members' => range(1, 146)
    ],
    'group-it' => [
        'name' => 'IT',
        'members' => [1, 8, 102, 121, 122] // sender + coworkers + superior
    ],
    'group-bm' => [
        'name' => 'BM',
        'members' => [1, 4, 2, 9, 10, 12, 15, 17, 22, 25, 30] // sender + coworkers + superior
    ],
    'group-casa' => [
        'name' => 'CASA',
        'members' => [1, 4, 2, 9, 9, 10, 12, 15, 17, 22, 25, 30, 31, 36, 37, 47, 48, 49, 108, 97] // sender + coworkers + superior
    ],
    'group-cashier' => [
        'name' => 'Cashier',
        'members' => [1, 4, 2, 31, 36, 37, 47, 48, 49, 108, 97] // sender + coworkers + superior
    ],
    'group-teller' => [
        'name' => 'Teller',
        'members' => [1, 102, 55, 24, 28, 35, 38, 46, 54, 70, 74, 75, 87, 97, 106, 107] // sender + coworkers + superior
    ],
    'group-dp' => [
        'name' => 'Dp',
        'members' => [1, 102, 55, 5, 114, 111, 54, 45, 32, 19, 13, 11, 4] //sender + coworkers + superior
    ]
    // Add more groups as needed
];

if (array_key_exists($receiver, $groupChats)) {
    // 🟡 Handle group chat
    $group = $groupChats[$receiver];
    $groupName = $group['name'];
    $members = $group['members'];

    $membersList = implode(',', array_map('intval', $members)); // sanitize for SQL
    $selectText = "SELECT c.*, a.* FROM chatbox AS c
                    JOIN accounts AS a ON a.userName = c.username
                    WHERE groupby = '$groupName'
                        ORDER BY c.id ASC";

} else {
    // 🔵 Normal chats
    if ($receiver == '') {
       $selectText = "SELECT c.*, a.*
                            FROM chatbox AS c
                                JOIN accounts AS a ON a.userName = c.username
                                JOIN (
                                    SELECT sender, receiver, MAX(id) AS lastId
                                    FROM chatbox
                                    WHERE receiver = '$sender' AND receiver <> 0 AND groupby = ''
                                    AND (
                                        EXISTS (
                                            SELECT 1 FROM chatbox
                                            WHERE receiver = '$sender'
                                            AND check_status IS NOT NULL
                                        )
                                        AND check_status IS NOT NULL
                                        OR NOT EXISTS (
                                            SELECT 1 FROM chatbox
                                            WHERE receiver = '$sender'
                                            AND check_status IS NOT NULL
                                        )
                                    )
                                    GROUP BY sender, receiver
                                ) AS latest
                                ON c.id = latest.lastId
                                        ORDER BY c.id DESC;";


        $groupQuery = "SELECT c1.*, 
                                EXISTS (
                                    SELECT 1 FROM chatbox c2 
                                    WHERE c2.groupby = c1.groupby 
                                        AND c2.notif = 2 
                                        AND c2.receiver = '$sender'
                                ) AS has_new_message
                        FROM chatbox c1
                        JOIN (
                            SELECT groupby, MAX(CONCAT(myDate, ' ', time)) AS latest_datetime
                            FROM chatbox
                            WHERE groupby NOT IN ('', 'Public') AND (sender = '$sender' OR receiver = '$sender')
                            GROUP BY groupby
                        ) AS latest_group 
                        ON c1.groupby = latest_group.groupby
                        AND CONCAT(c1.myDate, ' ', c1.time) = latest_group.latest_datetime
                        ORDER BY c1.myDate DESC, c1.time DESC";

            $groupResult = mysqli_query($con, $groupQuery);

            $seenMessages = [];

            while ($groupRow = mysqli_fetch_assoc($groupResult)) {
                $groupName = $groupRow['groupby'];
                $sessionId = $_SESSION['userid'];

                // Avoid duplicate groups
                if (isset($seenMessages[$groupName])) {
                    continue;
                }
                $seenMessages[$groupName] = true;

                // Use the EXISTS alias to check if there's a new message
                $highlightClass = '';
                if ($groupRow['has_new_message']) {
                    $highlightClass = 'highlighted';
                }
               

                // Optional: detect if the message is user's own (your logic here)
                $isOwnMessage = ''; // Placeholder if you want to add logic later

                echo '
                <div class="chat-message group-entry ' . htmlspecialchars($highlightClass) . ' ' . $isOwnMessage . '" 
                    onclick="openGroupChat(\'' . htmlspecialchars($groupName) . '\')" 
                    title="' . htmlspecialchars($groupRow['myDate'] . ', ' . $groupRow['time']) . '" 
                    style="cursor: pointer;">
                    <div class="chat-row">
                        <div class="chat-text">
                            <strong>' . htmlspecialchars($groupName) . ' Group</strong>
                        </div>
                    </div>
                </div>';
            }


    } elseif ($receiver == '0' && $groupName == 'Public') {
        $selectText = "SELECT c.*, a.* FROM chatbox as c 
                        JOIN accounts as a ON a.userName = c.username
                        WHERE c.groupby = 'Public' ORDER BY c.id ASC";
    } else {
        $selectText = "SELECT c.*, a.* FROM chatbox as c 
                        JOIN accounts as a ON a.userName = c.username
                        WHERE ((c.sender = '$sender' AND c.receiver = '$receiver') 
                           OR (c.sender = '$receiver' AND c.receiver = '$sender')) AND groupby = ''
                        ORDER BY c.id ASC";
    }
}



$queryText = mysqli_query($con, $selectText);

// get last message id first
$lastRowRes = mysqli_query($con, $selectText);
$lastId = 0;
$lastIds = []; // 🟢 store multiple ids for group messages

if ($lastRow = mysqli_fetch_assoc($lastRowRes)) {
    mysqli_data_seek($lastRowRes, mysqli_num_rows($lastRowRes) - 1); 
    $lastRowData = mysqli_fetch_assoc($lastRowRes);

    if (!empty($lastRowData['groupby'])) {
        // 🟡 GROUP CHAT: get all messages with the same last datetime
        $lastDatetime = $lastRowData['myDate'] . ' ' . $lastRowData['time'];

        $lastMsgQuery = "
                        SELECT id 
                            FROM chatbox 
                            WHERE groupby = '" . mysqli_real_escape_string($con, $lastRowData['groupby']) . "'
                            AND CONCAT(myDate, ' ', time) = '$lastDatetime'
                        ";
        $lastMsgRes = mysqli_query($con, $lastMsgQuery);

        while ($r = mysqli_fetch_assoc($lastMsgRes)) {
            $lastIds[] = $r['id'];
        }
    } else {
        // 🔵 PRIVATE CHAT: just one last id
        $lastId = $lastRowData['id'];
    }
}
mysqli_data_seek($lastRowRes, 0); // rewind pointer
$queryText = $lastRowRes;

while ($row = mysqli_fetch_assoc($queryText)) {
    // Build a unique key to avoid duplicates
    $uniqueKey = $row['sender'] . '-' . $row['text1'] . '-' . $row['myDate'] . '-' . $row['time'];

    if (isset($seenMessages[$uniqueKey])) {
        continue; // Skip duplicate
    }
    $seenMessages[$uniqueKey] = true;

    // Your display logic
    $highlightClass = '';
    if (strpos($row['text1'], $_SESSION['fullname']) !== false && $row['notif'] == 0) {
        $highlightClass = 'highlighted';
    }

    if($row['notif'] == 2 && $row['receiver'] == $sender){
        $highlightClass = 'highlighted';
    }

    $seenText = '';

    $isLastPrivate = (empty($row['groupby']) && $row['id'] == $lastId);
    $isLastGroup   = (!empty($row['groupby']) && in_array($row['id'], $lastIds));

    if ($isLastPrivate || $isLastGroup) {
        $seenUsers = [];

        if (!empty($row['groupby'])) {
            // 🟡 Public group chat → get all receivers who saw the last message
            $lastDatetime = $row['myDate'] . ' ' . $row['time'];

            $seenQuery = mysqli_query($con, "
                                                SELECT DISTINCT a.fullName
                                                FROM chatbox c
                                                JOIN accounts a ON a.userId = c.receiver
                                                WHERE c.groupby = '" . mysqli_real_escape_string($con, $row['groupby']) . "'
                                                AND c.id IN (" . implode(',', $lastIds) . ")
                                                AND c.notif = 1
                                                AND c.public_notif = 1
                                                AND c.receiver <> 0
                                            ");
        } else {
            // 🔵 Private chat → just use the same id
            $seenQuery = mysqli_query($con, "
                                                SELECT a.fullName
                                                FROM chatbox c
                                                JOIN accounts a ON a.userId = c.receiver
                                                WHERE c.id = '{$row['id']}'
                                                AND c.notif = 1
                                            ");
        }

        while ($seenRow = mysqli_fetch_assoc($seenQuery)) {
            $seenUsers[] = $seenRow['fullName'];
        }

        if (!empty($seenUsers) && isset($receiver) && $receiver !== '') {
            $firstUser = htmlspecialchars($seenUsers[0]);
            $countOthers = count($seenUsers) - 1;

            $displayText = $firstUser;
            if ($countOthers > 0) {
                $displayText .= ' + ' . $countOthers;
            }

            $seenText = '
                <div class="chat-seen d-flex" 
                    style="font-size: 9px; color: lightgray; float: right;" 
                    title="' . htmlspecialchars(implode(', ', $seenUsers)) . '">
                    Seen: ' . $displayText . '
                </div>';
        }
    }





    $isOwnMessage = ($row['sender'] == $_SESSION['userid']) ? 'own-message' : '';

    // 🟢 Display group name instead of sender's name for group chat
    $displayedMessage = htmlspecialchars($row['text1']);
    $displayedName = array_key_exists($receiver, $groupChats) 
                    ? $groupChats[$receiver]['name'] 
                    : htmlspecialchars($row['fullName']);

    echo 
    '<div class="chat-message ' . htmlspecialchars($highlightClass) . ' ' . html_entity_decode($isOwnMessage) . '" title="' . htmlspecialchars($row['myDate'] . ', ' . $row['time']) . '">
        <div class="chat-row">
            <div class="chat-avatar" onclick="reply(\'' . htmlspecialchars($row['username']) . '\', \'' . htmlspecialchars($row['fullName']) . '\')" style="cursor: pointer;">
                <img src="' . htmlspecialchars($row['userAvatar']) . '" 
                    alt="'. htmlspecialchars($row['username']) .'" 
                    title="'. htmlspecialchars($row['fullName']) .'"  
                    class="avatar-img">
            </div>
            <div class="chat-text message-click" data-id="' . $row['id'] . '">' 
                . 
                    ($receiver === '' ? ($row['groupby'] !== '' ? htmlspecialchars($row['groupby']) : htmlspecialchars($row['fullName'])) : html_entity_decode($row['text1']))
                . 
            '</div>
        </div>
    </div>
    <div class="chat-footer"> ' . $seenText . '</div>';
}
// echo '<div class="chat-footer"> ' . $seenText . '</div>';

// <div class="chat-avatar">
//                 <strong>' . htmlspecialchars($groupName) . ' Group</strong>
//             </div>



mysqli_close($con);
?>
