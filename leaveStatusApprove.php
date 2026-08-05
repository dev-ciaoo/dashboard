<?php 
include('connection.php');
include('fileupload.php');

if(isset($_POST['btnApprove'])) {
    $iStatus = 2; 
}
else {
    $iStatus = 3;
}

$id = $_POST['reqId'];
$rRemark = $_POST['rRemark'];

$sql = "UPDATE `leavetbl` SET `iStatus` = '$iStatus', `iRemarks` = '$rRemark' WHERE id=$id";
$query = mysqli_query($con, $sql);

if($query == true){
    echo '<script>
            alert("Successfully Submitted!");
          </script>';
    // $pagee = $_SERVER['PHP_SELF'];
    // header("Refresh: url = '$pagee ");
    // header("Refresh: 0; url='index.php';");
    // exit(0);
}
else{
    Echo "";
}
?>


