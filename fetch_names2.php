<?php
include('connection.php');

$input = $_POST['value'];

$query = "SELECT fullName FROM accounts WHERE username LIKE ? OR fullName LIKE ? LIMIT 3";
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