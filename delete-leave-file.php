<?php
include('connection.php');

$id = intval($_POST['id'] ?? '');

$stats = 4;
$absent = 0;

if ($id) {
    $sql = "UPDATE leavetbl SET `iStatus` = ?, iAbsent = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iii', $stats, $absent, $id);
    if($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Leave Record Updated Successfully!']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Failed to Update Leave Record!' . $stmt->error]);
    }
    
    $stmt->close();
    $con->close();
}


