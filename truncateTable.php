<?php
include 'connection.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allowedTables = ['collectionarchive']; // only allow specific tables
    $table = $_POST['table'] ?? '';

    if (!in_array($table, $allowedTables)) {
        http_response_code(403);
        echo "Unauthorized table.";
        exit;
    }

    $sql = "TRUNCATE TABLE `$table`";
    if (mysqli_query($con, $sql)) {
        echo "Success";
    } else {
        http_response_code(500);
        echo "Error: " . mysqli_error($con);
    }
}

$con->close();
?>
