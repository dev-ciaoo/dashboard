<?php
include('connection.php');

$userid = $_SESSION['userid'];
$notif = 2;
$publicNotif = 1;
$groupMap = [
    'group-it' => 'IT',
    'group-bm' => 'BM',
    'group-casa' => 'CASA',
    'group-cashier' => 'Cashier',
    'group-teller' => 'Teller',
    'group-dp' => 'Dp'
];

if (isset($_POST['group']) && array_key_exists($_POST['group'], $groupMap)) {
    $groupLabel = $groupMap[$_POST['group']];
    $sql = "UPDATE chatbox SET notif = 1 WHERE notif = ?, public_notif = ? AND receiver = ? AND groupby = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiss", $notif, $publicNotif, $userid, $groupLabel);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Handle invalid group selection
    http_response_code(400); // Bad Request
    echo "Invalid group selected.";
}
?>
