<?php
include('connection.php');
require_once 'function.php';

header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
// header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://trusted-cdn.com;");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize user input
    $username = htmlspecialchars(trim($_POST["username"]), ENT_QUOTES, 'UTF-8');
    $pwd = trim($_POST["userpwd"]); // No need for htmlspecialchars here (passwords shouldn't be altered)
    $userRole = isset($_POST["userRole"]) ? htmlspecialchars(trim($_POST["userRole"]), ENT_QUOTES, 'UTF-8') : '';

    // Check for empty input
    if (emptyInputLogin($username, $pwd)) {
        header("Location: login.php?error=emptyinput");
        exit();
    }

    // Escape input to prevent SQL injection (except passwords)
    $username = mysqli_real_escape_string($con, $username);
    $userRole = mysqli_real_escape_string($con, $userRole);

    // Process login
    loginUser($con, $username, $pwd);
} else {
    header("login.php");
    exit();
}
?>
