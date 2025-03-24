<?php

require_once '../handlers/loginHandler.php';
require_once '../includes/session.php';

startSession();

if (isLoggedIn()) {
  header('location: ./home.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  handleLogIn($_POST);
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/logIn.css">
</head>

<body>
  <div class="login-container">
    <div class="login-header">
      <h1>Welcome Back</h1>
      <p>Please enter your credentials to login</p>
      <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid') : ?>
        <div class="alert alert-danger">
          Invalid email or password
        </div>
      <?php endif; ?>
    </div>

    <form action="" method="POST">
      <div class="form-group">
        <label for="email">Email Address</label>
        <div class="input-group">
          <i class="bi bi-envelope"></i>
          <input type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="Enter your email"
            required>
        </div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
          <i class="bi bi-lock"></i>
          <input type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Enter your password"
            required>
        </div>
      </div>

      <button type="submit" class="login-btn">Login</button>
    </form>

    <div class="register-link">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>
</body>

</html>