<?php 
include('connection.php');
include('fileupload.php');

$t_location = $_POST['t_location'];
$dateTransfer = $_POST['dateTransfer'];
$t_fname = $_POST['t_fname'];
$id = $_POST['t_id'];

$sql = "UPDATE `inventory` SET `location`='$t_location', `dateTransfer`='$dateTransfer', `fname`='$t_fname', `status` = 0, `priority`= 0 WHERE id='$id' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);

    if($query == true)
    {
        $response['message'] = 'Product Successfully Transferred!';
        $response['result'] = true;
    }
    else
    {   
        $response['message'] = 'Error';
    } 

die (json_encode($response));

?>