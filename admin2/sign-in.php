<?php
// sign-in.php

session_start();

// Check if the admin is already logged in
if (isset($_SESSION['SESS_USERNAME'])) {
    // Redirect to the dashboard or another page
    header("location: index.php");
    exit();
}

// Rest of your sign-in.php code goes here
?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Serany Foundation Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
  <script src="js/jquery-1.10.2.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>


  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .login-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 40px;
    width: 400px;
    text-align: center;
  }
  .login-container h2 {
    margin-bottom: 30px;
    color: #333;
  }
  .login-logo {
    margin-bottom: 0px;
  }
  .login-logo img {
    width: 170px; /* Width as specified */
    height: 100px; /* Height as specified */
  }
  .input-group-prepend i {
    margin-right: 0px;
    color: #555;
  }
  .login-btn {
    width: 100%;
    padding: 15px;
    background-color: #007bff;
    border: none;
    border-radius: 6px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  .login-btn:hover {
    background-color: #0056b3;
  }
  .forgot-password {
    text-align: right;
    margin-top: 10px;
  }
  .toggle-password {
      cursor: pointer;
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #555;
    }
</style>
</head>

<body>
<div class="login-container">
  <div class="login-logo">
    <img src="images/logo3.png" alt="Serany Foundation Logo">
  </div>
  <h2>Admin Login</h2>
  <form action="process_login.php" method="post">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      <input type="text" class="form-control" name="username" placeholder="Username" required>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
      </div>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
    </div>
    <button type="submit" class="login-btn">Login</button>
    <div class="forgot-password">
      <!-- <a href="#">Forgot Password?</a>-->
    </div>
  </form>
</div>

<script>
  function togglePassword() {
    var passwordInput = document.getElementById("password");
    var icon = document.querySelector(".toggle-password");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }
</script>

</body>
</html>