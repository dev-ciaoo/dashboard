<?php
include('connection.php');

if (isset($_SESSION['userid'])) {

    $sessionID = NULL;
    $logstats = 0;

    $sql = "UPDATE accounts SET sessionId = ?, logstats = ? WHERE userId = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sii", $sessionID, $logstats, $_SESSION['userid']);
        $stmt->execute();
        $stmt->close();
    }
}

// destroy session
session_unset();
session_destroy();

header('Location: login.php');
exit;