<?php
include('connection.php');

// Check if the username is provided via POST
if(isset($_POST['username'])) {
    // Sanitize the username to prevent SQL injection
    $username = mysqli_real_escape_string($con, $_POST['username']);

    // Query the database to fetch the full name and userId corresponding to the username
    $selectName = "SELECT userId, fullName, userName FROM accounts WHERE username = '$username'";
    $result = mysqli_query($con, $selectName);

    // Check if the query was successful
    if($result) {
        if($username == $_SESSION['username']){
            return false;
        }else{
            $updaterr = "UPDATE chatbox SET notif = 1, check_status = NULL WHERE username = '$username' AND receiver = '" . $_SESSION['userid'] . "' ";
            $updaterrQ = mysqli_query($con, $updaterr);
            // Fetch the full name and userId from the result
            $row = mysqli_fetch_assoc($result);
            $data = array(
                'fullName' => $row['fullName'],
                'userId' => $row['userId']
            );

            // Return the data as JSON response
            echo json_encode($data);
        }
        
    } else {
        // Error handling
        echo 'Error fetching full name';
    }
} else {
    // Error handling if username is not provided
    echo 'Username not provided';
}

// Close database connection
mysqli_close($con);
?>
