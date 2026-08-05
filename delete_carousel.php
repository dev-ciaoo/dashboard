<?php
include('connection.php');

$id = intval($_GET['id']);

// Fetch file name
$result = $con->query("SELECT file_name FROM carousel_items WHERE id = $id");
$row = $result->fetch_assoc();

if ($row) {
    $file = $row['file_name'];

    // Delete file if exists
    if (!empty($file) && file_exists($file)) {
        unlink($file);
    }

    // Delete database record
    $delete = $con->query("DELETE FROM carousel_items WHERE id = $id");

    if ($delete) {
        echo "<script>alert('Successfully Deleted');</script>";
    } else {
        echo "Error Deleting the Item: " . $con->error;
    }

} else {
    echo "Item not found.";
}
?>
