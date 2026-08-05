<?php
include('connection.php');

$id = intval($_POST['id'] ?? 0);
$vl = floatval($_POST['VL'] ?? 0);
$sl = floatval($_POST['SL'] ?? 0);
$ml = floatval($_POST['ML'] ?? 0);
$el = floatval($_POST['EL'] ?? 0);
$ul = floatval($_POST['UL'] ?? 0);

if($id) {
    $sql = "UPDATE accounts SET `VL` = ?, `SL` = ?, `ML` = ?, `EL` = ?, `UL` = ? WHERE userId = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('dddddi', $vl, $sl, $ml, $el, $ul, $id);
    if($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Leave Count Updated Successfully!']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Failed to Update Leave Count!' . $stmt->error]);
    }

    $stmt->close();
    $con->close();
}