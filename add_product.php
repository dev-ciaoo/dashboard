<?php 
include('connection.php');
include('fileupload.php');

$category = $_POST['category'];
$computer = $_POST['computer'];
$code = $_POST['code'];
$location = $_POST['location'];
$description = $_POST['description'];
$connectivity  = $_POST['connectivity'];
$conditions = $_POST['conditions'];
$quantity = $_POST['quantity'];
$serials = $_POST['serials'];
$price = $_POST['price'];
$img = $_FILES['img'];
$dateAdded = $_POST['dateAdded'];
// $fname = $_POST['fname'];
$file =  upload_file($img, 'upload');
$lastCodeId = 1;
$id = $_POST['category'];

$sql_inv = "SELECT id, code_id FROM `inventory` WHERE category=$id ORDER BY id  DESC LIMIT 1";
$query = mysqli_query($con, $sql_inv);
if ($query) {
    while($row = mysqli_fetch_assoc($query)){
        if($row['code_id']) {
            $code_id = $row['code_id'];
        }
    }
    $code_id = (int)$code_id;
    $lastCodeId = $code_id + 1;
}

if($file['result']) {
    $destination = $file['path'];

    $sql = "INSERT INTO `inventory` (`code_id`, `category`, `computer`, `code`, `location`, `description`, `connectivity`, `conditions`, `quantity`, `serials`, `price`, `img`, `dateAdded`) VALUES ('$lastCodeId', '$category', '$computer', '$code', '$location', '$description', '$connectivity', '$conditions', '$quantity', '$serials', '$price', '$destination', '$dateAdded')";
    $query = mysqli_query($con,$sql);
    $lastId = mysqli_insert_id($con);

    if($query == true)
    {
        $response['message'] = 'Successfully Added!';
        $response['result'] = true;
    }
    else
    {   
        $response['message'] = 'Something Wrong!';
    } 
}else {
    $response['message'] = $file['message'];
    }

die (json_encode($response));


