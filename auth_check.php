<?php

require 'connection.php';

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// if (empty($_SESSION['sessionId'])) {
//     header('Location: logout.php');
//     exit();
// }

if(!isset($_SESSION['userid'])){
    header('Location: logout.php');
    exit();
}

?>
