<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up Page</title>
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #74ebd5, #ACB6E5);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .signup-card {
      max-width: 500px;
      margin: auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .form-control {
      border-radius: 10px;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    #headLogo {
      width: 120px;
      display: block;
      margin: 20px auto 10px;
    }

    .message p {
      text-align: center;
      color: red;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <img src="./logo/logo.png" id="headLogo" alt="Logo">

  <div class="container">
    <div class="signup-card p-4">
      <form action="signup_inc.php" method="post">
        <h3 class="text-center mb-4">Create an Account</h3>

        <div class="form-group">
          <label><i class="bi bi-person-fill me-2"></i>Username</label>
          <input type="text" class="form-control" placeholder="Enter username" name="name" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label><i class="bi bi-envelope-fill me-2"></i>Email</label>
          <input type="email" class="form-control" placeholder="Enter email" name="email" autocomplete="off" required>
        </div>

        <div class="form-group position-relative mb-3">
          <label>Password</label>
          <input type="password" class="form-control pe-5" placeholder="Enter password" name="pwd" id="password" autocomplete="off" required>
          <i class="bi bi-eye-fill"
            style="position: absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; color: gray;"
            onmousedown="showPassword('password')"
            onmouseup="hidePassword('password')"
            onmouseleave="hidePassword('password')">
          </i>
        </div>

        <div class="form-group position-relative mb-3">
          <label>Repeat Password</label>
          <input type="password" class="form-control pe-5" placeholder="Repeat password" name="repeatpwd" id="repeatpwd" autocomplete="off" required>
          <i class="bi bi-eye-fill"
            style="position: absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; color: gray;"
            onmousedown="showPassword('repeatpwd')"
            onmouseup="hidePassword('repeatpwd')"
            onmouseleave="hidePassword('repeatpwd')"></i>
        </div>

        <div class="form-group">
          <label><i class="bi bi-person-badge-fill me-2"></i>Select User Type</label>
          <select name="userRole" class="form-control" required>
            <option value="" disabled selected>Select type</option>
            <!-- <option value="admin" disabled>Admin</option> -->
            <option value="user">User</option>
          </select>
        </div>

        <div class="d-flex justify-content-between mt-4">
          <a href="login.php" class="btn btn-outline-secondary">Cancel</a>
          <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </div>

        <div class="message mt-3">
          <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "<p>Fill in all fields!</p>";
            } else if ($_GET["error"] == "wronglogin") {
              echo "<p>Incorrect information!</p>";
            } else if ($_GET["error"] == "none") {
              echo "<p style='color:green;'>You have signed up successfully!</p>";
            }
          }
          ?>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showPassword(id) {
      document.getElementById(id).type = 'text';
    }

    function hidePassword(id) {
      document.getElementById(id).type = 'password';
    }
  </script>

</body>

</html>
