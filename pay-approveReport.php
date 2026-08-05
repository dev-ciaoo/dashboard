<?php
include('connection.php');

$fullname = $_SESSION['fullname'];
$date = $_POST['date'];
$datatoretrieve = $_POST['datatoretrieve'];

$fullname = mysqli_real_escape_string($con, $fullname);
$date = mysqli_real_escape_string($con, $date);

if($datatoretrieve == 'approve'){
    $sql ="UPDATE pay_selecteddate SET approver = '$fullname', approved = '1', approved_at = NOW() WHERE selectedDate = '$date'";
    $result = $con->query($sql);

    if ($result === TRUE) {
        echo "Updated";
    } else {
        echo "Error updating record: " . $con->error;
    }
}else if ($datatoretrieve == 'verify'){
    $sql ="UPDATE pay_selecteddate SET verifier = '$fullname', verified = '1', verified_at = NOW() WHERE selectedDate = '$date'";
    $result = $con->query($sql);

    if ($result === TRUE) {
        echo "Updated";
    } else {
        echo "Error updating record: " . $con->error;
    }
}

$con->close();
?>