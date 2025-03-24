<?php

require_once '../includes/session.php';
require_once '../data/Database.php';


startSession();
requireLogin();

$userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user = null;

$database = new Database();
$pdo = $database->getConnection();

if ($userId) {
  $user = $database->getById($userId, $pdo);
}

if (!$user) {
  header('location: home.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])  && $_POST['confirm'] === 'yes') {
  if ($database->deleteUser($userId, $pdo)) {
    header('location: home.php?deleted=success');
  } else {
    $error = 'failed to delete User please try again!';
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/home.css">
</head>

<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card border-danger">
          <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> Confirm Deletion</h5>
          </div>
          <div class="card-body text-center p-5">
            <?php if (isset($error)): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <img src="../uploads/<?= htmlspecialchars($user['profile_picture']) ?>"
              alt="User Profile" class="rounded-circle mb-3"
              style="width: 100px; height: 100px; object-fit: cover;">

            <h4><?= htmlspecialchars($user['full_name']) ?></h4>
            <p class="text-muted"><?= htmlspecialchars($user['email']) ?></p>

            <div class="alert alert-warning my-4">
              <p class="mb-0">Are you sure you want to delete this user?</p>
              <small class="d-block mt-2">This action cannot be undone.</small>
            </div>

            <form method="post" class="d-flex justify-content-center gap-3">
              <input type="hidden" name="confirm" value="yes">
              <a href="home.php" class="btn btn-outline-secondary px-4">
                <i class="bi bi-x-circle me-2"></i> Cancel
              </a>
              <button type="submit" class="btn btn-danger px-4">
                <i class="bi bi-trash me-2"></i> Delete User
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>