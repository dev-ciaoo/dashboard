<?php
include('connection.php');
// require_once 'function.php';

$id = $_SESSION['userId'];
// if(count($_POST) > 0 ) {
//     $sql = "SELECT * FROM `accounts` WHERE id=$id";
//     $query = mysqli_query($con, $sql);
//     $row = mysqli_fetch_array($query);
// }
$sql = "SELECT * FROM `accounts` WHERE userId = '" . $_SESSION['userid'] . "' ";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

if(isset($_POST['btnSubmit'])){
    $oldPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];
    $newPass2 = $_POST['newwPass2'];

if($oldPass == $row['userPwd'] && $newPass == $newPass2) {
    // $sql = "UPDATE `accounts` SET "
}

    if (emptyInputLogin($oldPass, $newPass, $newPass2) !== false) {
        header("location: userChangePass.php?error=emptyinput");
        exit();
    }
    else if($newpass != $newPass2) {
        header("location: userChangePass.php?error=wronginput");
        exit();
    }
}
else {
    header("location: userChangePass.php");
    exit();
}
?>