<?php 
include('connection.php');
include('fileupload.php');

$id = $_POST['id'];
$letterStatus = $_POST['letterStatus'];

// Retrieve the current letterStatus from the database
$sql = "SELECT `letterStatus` FROM `loan` WHERE loan_Id='$id'";
$result = mysqli_query($con, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $currentLetterStatus = $row['letterStatus'];

    // if($currentLetterStatus == 0){
    //     $currentLetterStatus = '';
    // }

    if ($_SESSION['position'] == 'BM') {
        $letterSet = "BM: $letterStatus";
    } else {
        $letterSet = "COLLECTION: $letterStatus";
    }

    // Concatenate the new value with a line break and the existing letterStatus
    $updatedLetterStatus = $currentLetterStatus . "<br>" . $letterSet;

    // Update the `loan` table with the updated letterStatus
    $sql = "UPDATE `loan` SET `letterStatus` = '$updatedLetterStatus' WHERE loan_Id='$id'";
    $updateQuery = mysqli_query($con, $sql);

    if ($updateQuery) {
        $data = array(
            'status' => 'success',
        );
    } else {
        $data = array(
            'status' => 'failed',
        );
    }
} else {
    $data = array(
        'status' => 'failed',
    );
}

echo json_encode($data);
?>
