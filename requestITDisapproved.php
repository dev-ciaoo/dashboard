<?php 
include('connection.php');
include('fileupload.php');

$id = $_POST['id'];
$sql = "UPDATE `request` SET `r_Status` = 5 WHERE id='$id'";
$updateQuest = mysqli_query($con,$sql);

if($updateQuest == true)
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
