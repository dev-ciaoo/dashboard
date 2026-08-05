<?php
include('connection.php');

$id = intval($_GET['id']);
$file = $con->query("SELECT file_name FROM carousel_items WHERE id=$id")->fetch_assoc()['file_name'];
if (file_exists($file)) unlink($file);
$con->query("DELETE FROM carousel_items WHERE id=$id");
