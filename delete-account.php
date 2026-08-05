<?php
include('connection.php');

$id = intval($_POST['id'] ?? '');

$stats = 1;

if ($id) {
    $sql = "UPDATE accounts SET `stats` = ? WHERE userId = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ii', $stats, $id);
    if($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Account Updated Successfully!']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Failed to Update Account!' . $stmt->error]);
    }
    
    $stmt->close();
    $con->close();
}


