<?php
include('connection.php');

if (isset($_POST['groupKey'])) {
    $groupKey = $_POST['groupKey'];

    // Map to proper group names
    $groupMap = [
        '0' => 'Public',
        'group-it' => 'IT',
        'group-casa' => 'CASA',
        'group-bm' => 'BM',
        'group-teller' => 'Teller',
        'group-cashier' => 'Cashier',
        'group-dp' => 'Dp'
    ];

    $actualGroupName = isset($groupMap[$groupKey]) ? $groupMap[$groupKey] : '';

    if ($actualGroupName != '') {
        $userid = $_SESSION['userid'];
        $query = "UPDATE chatbox SET notif = 1, public_notif = 1, check_status = NULL
                  WHERE receiver = ? AND groupby = ? AND notif = 2";

        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $userid, $actualGroupName);

        if ($stmt->execute()) {
            echo "Group notif updated for " . $actualGroupName;
        } else {
            echo "Error updating group notif.";
        }

        $stmt->close();
    } else {
        echo "Invalid group key.";
    }
} else {
    echo "No groupKey received.";
}
?>
