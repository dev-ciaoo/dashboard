<?php
include('connection.php');

if (isset($_POST["submit"])) {
    
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $repeatNewPass = $_POST['repeatNewPass'];

    $id = $_SESSION['userid'];
    if($oldPass != '' && $newPass != '' && $repeatNewPass != ''){
        if($newPass == $repeatNewPass) {
            if($newPass != $oldPass) {
                $sql = "SELECT * FROM `accounts` WHERE userId = '$id'";
                $query = mysqli_query($con, $sql);
                $data = mysqli_fetch_assoc($query);
                $dataCount = mysqli_num_rows($query);
                    if(password_verify($oldPass, $data['userPwd'])){
                        $hashedmo = password_hash($newPass, PASSWORD_DEFAULT);
                        $sql2 = "UPDATE `accounts` SET `userPwd`= '$hashedmo', `sacred`='$repeatNewPass' WHERE userId='$id'";
                        $query2 = mysqli_query($con, $sql2);
                            if($query2){
                                echo '<script>alert("Success");</script>';
                                session_destroy();
                                header('location: login.php');
                                exit();
                            }
                    }   
                    else{
                        header("location: changePassword.php?error=Oldpasswordisincorrect");
                        exit();
                    }
            }
            else{
                header("location: changePassword.php?error=yournewpasswordisthesamewithyouroldpassword");
                exit();
            }
        }
        else{
            header("location: changePassword.php?error=newpasswordandrepeatpasswordisnotmatch");
            exit();
        }
    }
else {
    echo '<script>alert("Password Changed Successfully!");</script>';
    header("location: changePassword.php");
    exit();
}
}
