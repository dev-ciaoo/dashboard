<?php 
include('connection.php');
include('fileupload.php');

$id = $_POST['id'];
$status = ($_SESSION['role'] == 'admin')?2 : 1;

$sql = "UPDATE `inventory` SET `status` = $status, `priority` = 1  WHERE id=$id";
$query = mysqli_query($con, $sql);

if($query == true)
{
    $data = array(
        'status'=>'success',
    
    );

    echo json_encode($data);
}
else
{
    $data = array(
        'status'=>'failed',
    
    );

    echo json_encode($data);
} 

?>
