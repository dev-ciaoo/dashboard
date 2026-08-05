<?php
include('connection.php');

$id = $_SESSION['employeeId'];
$pass = $_POST['pass'];
    

    $select = "SELECT fullName, sacred FROM accounts WHERE employeeId = ? AND sacred = ?";
    $stmt = $con->prepare($select);
    if ($stmt) {
        $stmt->bind_param('is', $id, $pass);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo 'Success';
            } else {
                $response = 'Wrong Password';
                echo json_encode($response);
            }
        } else {
            echo json_encode(array('error' => 'Query failed: ' . $stmt->error));
        }
        $stmt->close();
    } else {
        echo json_encode(array('error' => 'Failed to prepare statement: ' . $con->error));
    }
    $con->close();

?>