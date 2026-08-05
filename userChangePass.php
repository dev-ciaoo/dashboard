<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="A inventory web app for OUR Bank.">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>Change Password</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body oncontextmenu="return false;">
<!-- <div class="left-form"> -->
  <div class="container-fluid">
    <!-- <div class="login-form shadow-lg p-3 mb-5 bg-white rounded"> -->
    <div class="login-form shadow-lg p-3 mb-5">
      <div class="form-head">
        <div class="row">
          <div class="col"><img class="logo-image" src="./logo/logo.png" alt="logo"></div>
        </div>
      </div>
      <h5>WELCOME TO OUR BANK DASHBOARD</h5>
      <p class="signin-text">Change Password</p>
      <div class="form-body">
        <form action="" method="post">
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="currentPass" autocomplete="off" Required>
            <label for="floatingInput">Current Password</label>
          </div><br>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="newPass" autocomplete="off" Required>
            <label for="floatingPassword">New Password</label>
          </div><br>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword2" placeholder="Password" name="newPass2" autocomplete="off" Required>
            <label for="floatingPassword2">Repeat New Password</label>
          </div><br>

          <!-- <a class="btn btn-primary btn-sm" href="signup.php" type="button">Register</a> -->
          <button class="w-100 btn btn-lg btn-primary login-btn"  type="submit" name="btnsubmit">Change Password</button>
          <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "<p>Fill in all fields!</p>";
            } else if ($_GET["error"] == "wronginput") {
              echo "<p>Incorrect input information!</p>";
            } else if ($_GET["error"] == "none") {
              echo "<p>You have change password successfully!</p>";
            }
          }
          ?>
        </form>
      </div>
    </div>
  </div>
<!-- </div> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
  crossorigin="anonymous"></script>

<!-- <script src="js/script.js"></script> -->
</body>

</html>