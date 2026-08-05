<?php 
include('connection.php');
include('fileupload.php');

$computer = $_POST['computer'];
$code = $_POST['code'];
$location = $_POST['location'];
$description = $_POST['description'];
$connectivity = $_POST['connectivity'];
$conditions = $_POST['conditions'];
$quantity = $_POST['quantity'];
$serials = $_POST['serials'];
$price = $_POST['price'];
$img = $_FILES['img'];
$dateAdded = $_POST['dateAdded'];
// $fname = $_POST['fname'];
$id = $_POST['id'];
$img_sql = "";

if ($img['size'] > 0) {
    $file = upload_file($img, 'upload');
    if ($file['result']) {
        $img_sql = ', img="'.$file['path'].'"';
    }
    else {
        $response['message'] = $file['message'];
        die (json_encode($response));
        }
}
$sql = "UPDATE `inventory` SET  `computer`='$computer', `code`= '$code', `location`='$location', `description`='$description', `connectivity`='$connectivity', `conditions`='$conditions', `quantity`='$quantity', `serials`='$serials', `price`='$price', `dateAdded`='$dateAdded' ".$img_sql." WHERE id='$id' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 
?>