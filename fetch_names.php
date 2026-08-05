<?php
include('connection.php');

$input = $_POST['value'];

$mySessionId = $_SESSION['userid'];
// $targetIDs = [$mySessionId, 68, 71, 100, 81, 82, 83, 90, 14, 7, 103, 92, 94, 95, 96, 104, 105, 91, 87, 72, 99, 79, 26, 16, 34, 50, 40, 39, 69, 64];

// Create a comma-separated string
// $idsList = implode(',', $targetIDs);

$query = "SELECT fullName, userId FROM accounts WHERE (userName LIKE ? OR fullName LIKE ?) AND userId <> $mySessionId AND stats <> 1 LIMIT 3";
$statement = $con->prepare($query);

// Bind the parameter
$param = "%" . $input . "%";
$statement->bind_param("ss", $param, $param);

// Execute the query
$statement->execute();

// Get the result
$result = $statement->get_result();

// Display suggestions
if ($result->num_rows > 0) {
    $suggestions = ""; // Variable to accumulate suggestions
    while($row = $result->fetch_assoc()) {
        // Append each suggestion to the variable
        $suggestions .= "<div>" . $row['fullName'] . "</div>";
    }
    // Echo all suggestions
    echo $suggestions;
} else {
    
}

// Close the statement and connection
$statement->close();
$con->close();
?>