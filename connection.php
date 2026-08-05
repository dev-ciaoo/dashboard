<?php
session_start();

error_reporting(E_ALL & E_DEPRECATED & E_STRICT & ~E_NOTICE & ~E_WARNING);

$con  = mysqli_connect('localhost', 'root', '', 'ourbank');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
}

if(isset($_POST)){
    foreach ($_POST as $key => $value) {
        if(!is_array($value)){
            $_POST[$key] = trim(filter_var($value,FILTER_SANITIZE_STRING));
        }
    }
}
?>