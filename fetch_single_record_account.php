<?php
include 'connection.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);


    $sql = "SELECT * FROM accounts WHERE userId = '$id'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
}
?>
