<?php
include('connection.php');

if (isset($_POST['order'])) {

    $stmt = $con->prepare("UPDATE carousel_items SET position = ? WHERE id = ?");
    
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    foreach ($_POST['order'] as $item) {
        $id = intval($item['id']);
        $pos = intval($item['position']);

        $stmt->bind_param("ii", $pos, $id);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    }

    echo "success";
}