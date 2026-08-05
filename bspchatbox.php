<?php 
// include('connection.php');

//     $sender = $_SESSION['userid'];
//     $receiver = $_POST['personn'];
//     $name = $_POST['name'];
//     $text = htmlspecialchars($_POST['chat1']);
//     $cleaned_text = str_replace('@', '', $text);

//     date_default_timezone_set('Asia/Manila');
//     $myDate = date('F j, Y');
//     $myTime = date('h:i:s a');

//     if($receiver == 0){
//         $notif = 0;
//     }else{
//         $notif = 2;
//     }

//         $insert = "INSERT INTO `chatbox` (`username`, `text1`, `sender`, `receiver`, `notif`, `myDate`, `time`) VALUES ('$name', '$cleaned_text', '$sender', '$receiver', '$notif', '$myDate', '$myTime')";
//         $query = mysqli_query($con, $insert);

//         if(!$query){
//             echo "Error sending" . mysqli_error($con);
//         }else{
//             echo "Message sent";
//         }
    

include('connection.php');

$sender = $_SESSION['userid'];
$receiver = $_POST['personn'];
$name = $_POST['name'];
$text = mysqli_real_escape_string($con, $_POST['chat1']);

$cleaned_text = str_replace('@', '', $text);

date_default_timezone_set('Asia/Manila');
$myDate = date('F j, Y');
$myTime = date('h:i:s a');


// Define group members (you can also store this in DB later)
$groupChats = [
    '0' => [
        'name' => 'Public',
        'members' => range(1, 146)
    ],
    'group-it' => [
        'name' => 'IT',
        'members' => [1, 8, 102, 55] // sender + coworkers + superior
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
        'members' => [1, 102, 55, 5, 114, 111, 54, 45, 32, 19, 13, 11] //sender + coworkers + superior
    ]
    
];

// Check if it's a group message
if (isset($groupChats[$receiver])) {
    $group = $groupChats[$receiver];
    $groupName = $group['name'];
    $groupMembers = $group['members'];

    $success = true;

    foreach ($groupMembers as $memberId) {
        if ($memberId == $sender) continue; 

        $notif = ($groupName == 'Public') ? 0 : 2;
        if($groupName !== 'Public'){
            $insert = "INSERT INTO `chatbox` (`username`, `text1`, `sender`, `receiver`, `notif`, `myDate`, `time`, `groupby`, `check_status`) 
                   VALUES ('$name', '$cleaned_text', '$sender', '$memberId', '$notif', '$myDate', '$myTime', '$groupName', '1')";
        }else{
            $insert = "INSERT INTO `chatbox` (`username`, `text1`, `sender`, `receiver`, `notif`, `myDate`, `time`, `groupby`) 
                   VALUES ('$name', '$cleaned_text', '$sender', '$memberId', '$notif', '$myDate', '$myTime', '$groupName')";
        }
        $query = mysqli_query($con, $insert);

        if (!$query) {
            $success = false;
            echo "Error sending to user ID $memberId: " . mysqli_error($con);
        }
    }

    if ($success) echo "Group message sent.";
} else {
    $group = $groupChats[$receiver];
    $groupName = $group['name'];
    // Normal public or private message
    $notif = ($groupName == 'Public') ? 0 : 2;

    if($groupName !== 'Public'){
        $insert = "INSERT INTO `chatbox` (`username`, `text1`, `sender`, `receiver`, `notif`, `myDate`, `time`, `check_status`) 
               VALUES ('$name', '$cleaned_text', '$sender', '$receiver', '$notif', '$myDate', '$myTime', '1')";
    }else{
        $insert = "INSERT INTO `chatbox` (`username`, `text1`, `sender`, `receiver`, `notif`, `myDate`, `time`) 
               VALUES ('$name', '$cleaned_text', '$sender', '$receiver', '$notif', '$myDate', '$myTime')";
    }
    $query = mysqli_query($con, $insert);

    if (!$query) {
        echo "Error sending: " . mysqli_error($con);
    } else {
        echo "Message sent";
    }
}

?>