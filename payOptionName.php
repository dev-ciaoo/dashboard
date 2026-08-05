<?php
include('connection.php');

$query = "SELECT employeeId, name FROM pay_earnings";
$result = mysqli_query($con, $query);

$options = array();
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = array(
        'id' => $row['employeeId'],
        'fullName' => $row['name']
    );
}

// Output options as JSON
header('Content-Type: application/json');
echo json_encode($options);
?>