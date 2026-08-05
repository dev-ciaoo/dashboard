<?php 
include('connection.php');
include('fileupload.php');

$id = $_POST['loanId'];
$remarks = $_POST['remarks2'];

    $sql = "UPDATE `loan` SET `remarks2` = '$remarks', `status` = 1 WHERE loan_Id='$id'";
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

echo json_encode($data);
?>
