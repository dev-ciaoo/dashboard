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

  <style>
    .btn-align{
      text-align: center;
    }
  </style>
</head>
<body>
<!-- <div class="left-form"> -->
  <div class="container-fluid">
    <!-- <div class="login-form shadow-lg p-3 mb-5 bg-white rounded"> -->
    <div class="login-form shadow-lg p-3 mb-5">
      <div class="form-head">
        <div class="row">
          <div class="col"><img class="logo-image" src="./logo/logo.png" alt="logo"></div>
        </div>
      </div>
      <h5>Change Password</h5>
      <p class="signin-text">Fill up to continue</p>
      <div class="form-body">
        <form action="changePass_inc.php" method="post">
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingInput" placeholder="Old Password" name="oldPass" autocomplete="off" Required>
            <label for="floatingInput">Old Password</label>
          </div><br>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="New Password" name="newPass" autocomplete="off" Required>
            <label for="floatingPassword">New Password</label>
          </div><br>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Repeat Password" name="repeatNewPass" autocomplete="off" Required>
            <label for="floatingPassword">Confirm Password</label>
          </div><br>
          <div class="btn-align">
            <a href="index.php" type="button" class="w-40 btn btn-secondary back-btn btn-md" style="color: white;">&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;</a>
            <button class="w-30 btn btn-primary login-btn btn-md"  type="submit" name="submit">&nbsp;Confirm&nbsp;</button>
          </div>
          <?php
           if (isset($_GET["error"])) {
            if ($_GET["error"] == "newpasswordandrepeatpasswordisnotmatch") {
              echo "<p class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5px;'>New Password & Confirm Password in not match.</p>";
            } else if ($_GET["error"] == "yournewpasswordisthesamewithyouroldpassword") {
              echo "<p class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5px;'>Can't be the same with Old Password!</p>";
            } else if ($_GET["error"] == "Oldpasswordisincorrect") {
              echo "<p class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5px;'>Old Password is Incorrect!</p>";
            } else if ($_GET["error"] == "none") {
              echo "<p>You have Changed your Password successfully!</p>";
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

<script src="js/script.js"></script>
</body>

</html>