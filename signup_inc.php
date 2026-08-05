<?php
include('connection.php');

if (isset($_POST["submit"])) {
    // Sanitize input to prevent XSS
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $pwd = $_POST["pwd"];
    $repeatpwd = $_POST['repeatpwd'];
    $userRole = 'user';

    require_once 'function.php';

    if (emptyInputSignUp($name, $email, $pwd, $repeatpwd) !== false) {
        header("Location: signup.php?error=emptyinput");
        exit();
    }

    if (pwdMatch($pwd, $repeatpwd) !== false) {
        header("Location: signup.php?error=passwordnotmatch");
        exit();
    }

    if (useridExists($con, $name, $email) !== false) {
        header("Location: signup.php?error=userexists");
        exit();
    }

    createUser($con, $name, $email, $pwd, $repeatpwd, $userRole);
} else {
    header("Location: signup.php");
    exit();
}
