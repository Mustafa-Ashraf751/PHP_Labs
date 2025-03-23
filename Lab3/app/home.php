<?php

require_once('../handlers/logoutHandler.php');
require_once('../includes/session.php');

startSession();
requireLogin();


$user = $_SESSION['user'];
$fullName = $user['fullName'];
$email = $user['email'];
$roomNo = $user['roomNo'];
$extension = $user['extension'];
$profilePicture = $user['profilePicture'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  handleLogOut();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/home.css">
</head>

<body>
  <div class="welcome-container">
    <img src="../uploads/<?php echo htmlspecialchars($profilePicture ?? 'default.jpg'); ?>"
      alt="Profile Picture"
      class="profile-picture">
    <h1 class="welcome-text">Welcome</h1>
    <div class="user-name"><?php echo htmlspecialchars($fullName ?? 'Guest'); ?></div>

    <div class="user-info">
      <div class="info-item">
        <i class="bi bi-envelope"></i>
        <span><?php echo htmlspecialchars($email ?? 'email@example.com'); ?></span>
      </div>
      <div class="info-item">
        <i class="bi bi-door-open"></i>
        <span>Room: <?php echo htmlspecialchars($roomNo ?? 'Not set'); ?></span>
      </div>
      <div class="info-item">
        <i class="bi bi-telephone"></i>
        <span>Ext: <?php echo htmlspecialchars($extension ?? 'Not set'); ?></span>
      </div>
    </div>

    <form action="" method="POST">
      <button type="submit" class="logout-btn">
        <i class="bi bi-box-arrow-right"></i>
        Logout
      </button>
    </form>
  </div>
</body>

</html>