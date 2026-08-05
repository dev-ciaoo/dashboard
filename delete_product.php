<?php 
include('connection.php');

$id = mysqli_real_escape_string($con, $_POST['id']);
// $sql = "DELETE FROM inventory WHERE id='$id'";

$sql = "UPDATE inventory SET isDeleted = 1 WHERE id = '$id' ";
$delQuery = mysqli_query($con, $sql);

    if($delQuery == true)
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