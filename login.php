<?php require 'connection.php'; 

// Prevent cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// If already logged in → go to dashboard
if (isset($_SESSION['userid'])) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="google-site-verification" content="IYvYiejejqoOSpxHcG4Ec6cXgdI20H9bGFkTAhnZje8" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="A inventory web app for OUR Bank.">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>OUR Bank</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <style>
      /* Adjustments for small screens */   
      @media only screen and (max-width: 767.98px) {
        .login-form {
            padding: 20px;
            width: 100%;
            height: auto!important;
        }
        .signin-text {
            font-size: 1.2rem;
        }
        .logo-image {
          max-width: 100%;
          height: auto;
        }
    }

    /* Adjustments for large screens */
    @media only screen and (min-width: 1200px) {
        .login-form {
            padding: 50px;
        }
        .signin-text {
            font-size: 1.2rem;
        }
    }
  </style>
</head>
<body>
<!-- <div class="left-form"> -->
  <div class="container-fluid">
    <!-- <div class="login-form shadow-lg p-3 mb-5 bg-white rounded"> -->
    <div class="login-form shadow-lg p-3 mb-5">
      <div class="form-head">
      </div>
      <div class="col"><img class="logo-image" src="./logo/logo.png" alt="logo"></div>
      <h5>WELCOME TO OUR BANK DASHBOARD</h5>
      <p class="signin-text">Sign in to continue</p>
      <div class="form-body">
        <form action="login_inc.php" method="post">
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" autocomplete="off" Required>
            <label for="floatingInput">Username</label>
          </div><br>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="userpwd" autocomplete="off" Required>
            <i class="bi bi-eye-fill"
              style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: gray;"
              onmousedown="showPassword('floatingPassword')"
              onmouseup="hidePassword('floatingPassword')"
              onmouseleave="hidePassword('floatingPassword')">
            </i>
            <label for="floatingPassword">Password</label>
          </div><br>

          <div class="checkbox mb-3">
            <label id='loginLabel'>
              &nbsp;<input type="checkbox" value="remember-me" id="rememberMe"> Remember Me
            </label>
          </div>
          <!-- <a class="btn btn-primary btn-sm" href="signup.php" type="button">Register</a> -->
          <button class="w-100 btn btn-lg btn-primary login-btn"  type="submit" name="submit">Login</button>
          <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "<p class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5px;'>Fill in All the Fields!</p>";
            } else if ($_GET["error"] == "incorrectusername") {
              echo "<p class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5px;'>Incorrect Username!</p>";
            } else if ($_GET["error"] == "incorrectpassword") {
              echo "<p class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5px;'>Incorrect Password!</p>";
            } else if ($_GET["error"] == "none") {
              echo "<p class='alert alert-primary' role='alert' style='text-align: center'>You have Log in successfully!</p>";
            }
          }
          ?>
        </form>
      </div>
    </div>
  </div>
<!-- </div> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
if(typeof jQuery == 'undefined') {
    document.write('<script src="js/jquery-3.6.0.min.js"><\/script>');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
crossorigin="anonymous"></script>
<script>
if(typeof jQuery == 'undefined') {
    document.write('<script src="js/popper2116.min.js"><\/script>');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
crossorigin="anonymous"></script>
<script>
if(typeof jQuery == 'undefined') {
    document.write('<script src="js/bootstrap.bundle521.min.js"><\/script>');
}
</script>

<script src="js/script.js"></script>

<script>
  function showPassword(id) {
    document.getElementById(id).type = 'text';
  }

  function hidePassword(id) {
    document.getElementById(id).type = 'password';
  }
</script>

<script>
window.onpageshow = function(event) {
    if (event.persisted) {
        window.location.reload();
    }
};
</script>

</body>
</html>