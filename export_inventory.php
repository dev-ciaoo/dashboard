<?php
include 'connection.php';

$query = $con->query("SELECT * FROM `inventory` WHERE `isDeleted` <> 1 ORDER BY `id` DESC");

$data = [];

while ($row = $query->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
