<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    // Fetch user details from the database
    $query = "SELECT a.*, i.*, e.*, d.* FROM accounts AS a
                LEFT JOIN department as d ON a.userDepartment = d.id
                LEFT JOIN emails as e ON a.userLevel = e.id
                LEFT JOIN empinfo as i ON a.employeeId = i.empId
                     WHERE a.userId = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode([]);
    }
}