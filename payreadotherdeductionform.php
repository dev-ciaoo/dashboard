<?php
include('connection.php');

// Retrieve the ID from the AJAX request
$id = $_GET['id'];

// Prepare the SQL query
$sql = "SELECT fullName, address, bankPosition FROM accounts WHERE employeeId = $id";

// Execute the SQL query
$result = mysqli_query($con, $sql);

// Check if the query executed successfully
if ($result) {
    // Fetch the data from the result set
    $row = mysqli_fetch_assoc($result);

    // Check if there is any data returned
    if ($row) {
        // Convert the data to JSON format and echo it
        echo json_encode($row);
    } else {
        // If no data found for the given ID
        echo "No data found for ID: $id";
    }
} else {
    // If there was an error executing the query
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>