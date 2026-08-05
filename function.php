<?php
include ('connection.php');

function emptyInputSignUp($name, $email, $pwd, $repeatpwd) {
    $result = false;
    if (empty($name) || empty($email) || empty($pwd) || empty($repeatpwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// function emptyInputChangePass($oldPass, $newPass, $repeatNewPass) {
    //     $result;
    //     if (empty($oldPass) || empty($newPass) || empty($repeatNewPass)) {
    //         $result = true;
    //     }
    //     else {
    //         $result = false;
    //     }
    //     return $result;
    // }

function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function pwdMatch($pwd, $repeatpwd) {
    $result = false;
    if($pwd != $repeatpwd) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// function newPassMatch($newPass, $repeatNewPass) {
    //     $result;
    //     if($newPass != $repeatNewPass) {
    //         $result = true;
    //     }
    //     else {
    //         $result = false;
    //     }
    //     return $result;
    // }

function useridExists($con, $name, $email) {
    $sql = "SELECT * FROM accounts WHERE userName=? OR userEmail=?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    }
    else {
        mysqli_stmt_close($stmt);
        $result = false;
        return $result;
    }
}

function createUser($con, $name, $email, $pwd, $repeatpwd, $userRole) {
    $sql = "INSERT INTO `accounts` (`userName`, `userEmail`, `userPwd`, `sacred`, `userRole`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.php?error=creatingfailed");
        exit();
    }

$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $hashedPwd, $repeatpwd, $userRole);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: login.php");
    exit();
}

// function changePassword($con, $oldPass, $newPass, $repeatNewPass) {
    //     $id = $_SESSION['userid'];
    //     $sql = "UPDATE `accounts` SET `userPwd`=?, `sacred`=?, WHERE userid='$id' and userPwd = '$oldPass'";
    //     $stmt = mysqli_stmt_init($con);
    //     if (!mysqli_stmt_prepare($stmt, $sql)) {
    //         header("location: changePassword.php?error=creatingfailed");
    //         exit();
    //     }  

    // $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);

    //     mysqli_stmt_bind_param($stmt, "ss", $newPass, $repeatNewPass);
    //     mysqli_stmt_execute($stmt);
    //     mysqli_stmt_close($stmt);
    //     session_destroy();
    //     header("location: login.php");
    //     exit();
    // }
    // function changePassword($con, $oldPass, $newPass, $repeatNewPass) {
    // }
function emptyInputLogin($username, $pwd) {
    $result = false;;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($con, $username, $pwd) {
    // Check if user ID exists
    $useridExists = useridExists($con, $username, $username);
    
    // Verify if the user exists in the database
    if ($useridExists === false) {
        header("location: login.php?error=incorrectusername");
        exit();
    }

    // Verify the password
    $pwdHashed = $useridExists["userPwd"];
    if (!password_verify($pwd, $pwdHashed)) {
        header("location: login.php?error=incorrectpassword");
        exit();
    }

    // Step 1: Retrieve the existing session ID from the database
    $userId = $useridExists["userId"];

    // Check if the existing session ID is not "0" or empty
    // if ($existingSessionId) {
    //     header("location: login.php?error=alreadyloggedin");
    //     exit();
    // }

    // Step 2: Start a new session and regenerate session ID
    session_start();
    session_regenerate_id(true);
    error_reporting(E_ALL & E_DEPRECATED & E_STRICT & ~E_NOTICE & ~E_WARNING);

    $newSessionId = session_id();

    // Generate two random numbers and append them to the new session ID
    $randomNumber1 = rand(1000, 9999);
    $randomNumber2 = rand(1000, 9999);
    $newSessionIdWithRandom = $newSessionId . $randomNumber1 . $randomNumber2;

    date_default_timezone_set('Asia/Manila');
    $userIP = getUserIP();
    $lastLog = date('F j, Y @ h:i:s A');

    // Save the new session ID with random numbers to the database
    $query = "UPDATE accounts SET sessionId = ?, userIP = ?, lastLogin = ? WHERE userId = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssi", $newSessionIdWithRandom, $userIP, $lastLog, $userId);
    $stmt->execute();
    $stmt->close();

    // Step 3: Set session variables
    $_SESSION["userid"] = $useridExists["userId"];
    $_SESSION["employeeId"] = $useridExists["employeeId"];
    $_SESSION["useremail"] = $useridExists["userEmail"];
    $_SESSION['fullname'] = $useridExists['fullName'];
    $_SESSION["username"] = $useridExists["userName"];
    $_SESSION['department'] = $useridExists['userDepartment'];
    $_SESSION['bankposition'] = $useridExists['bankPosition'];
    $_SESSION["role"] = $useridExists["userRole"];
    $_SESSION['address'] = $useridExists['address'];
    $_SESSION['position'] = $useridExists['userPosition'];
    $_SESSION['VL'] = $useridExists['VL'];
    $_SESSION['SL'] = $useridExists['SL'];
    $_SESSION['ML'] = $useridExists['ML'];
    $_SESSION['EL'] = $useridExists['EL'];
    $_SESSION['MT'] = $useridExists['MT'];
    $_SESSION['PT'] = $useridExists['PT'];
    $_SESSION['sessionId'] = $useridExists['sessionId'];
    // Redirect to the index page after successful login
    // if($_SESSION['stats'] )

    // if($_SESSION['sessionId'])

    header("location: index.php");
    exit();
}
