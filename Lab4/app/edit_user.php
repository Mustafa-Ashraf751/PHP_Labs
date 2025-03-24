<?php
require_once '../data/getData.php';
require_once '../includes/session.php';
require_once '../validation/update-validation.php';
require_once '../data/updateUser.php';

startSession();

requireLogin();

$userId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if (!$userId) {
  header('location: home.php');
  exit();
}

$user = getUserById($userId);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = formValidation($_POST);

  $fullName = trim($_POST['fullName'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $roomNo = trim($_POST['roomNo'] ?? '');
  $extension = trim($_POST['extension'] ?? '');

  $profilePicture = $user['profile_picture'];

  //If user want to update the picture
  if (isset($_FILES['profilePicture']) and $_FILES['profilePicture']['error'] == 0) {
    $uploadDir = dirname(__DIR__) . '\\uploads\\';

    $fileExtension = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '.' . $fileExtension;
    $uploadPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath)) {
      $profilePicture = $fileName;
    } else {
      $errors['profilePicture'] = "Failed to upload picture please try again";
    }
  }


  if (!$errors) {
    $userData = [
      'id' => $userId,
      'fullName' => $fullName,
      'email' => $email,
      'roomNo' => $roomNo,
      'extension' => $extension,
      'profilePicture' => $profilePicture
    ];

    if (updateUser($userData)) {
      header('location: home.php?update=success');
      exit;
    } else {
      $errors['general'] = 'Failed to update user please try again';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/home.css">
  <style>
    .user-avatar-large {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
    }

    .required:after {
      content: ' *';
      color: red;
    }
  </style>
</head>

<body>
  <div class="container py-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit User</h5>
        <a href="home.php" class="btn btn-outline-secondary btn-sm">
          <i class="bi bi-arrow-left"></i> Back to Users
        </a>
      </div>
      <div class="card-body">
        <?php if (isset($errors['general'])): ?>
          <div class="alert alert-danger"><?= $errors['general'] ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
          <!-- Profile Picture -->
          <div class="row mb-4">
            <div class="col-md-3 text-center">
              <img src="../uploads/<?= htmlspecialchars($user['profile_picture']) ?>"
                alt="Profile" class="user-avatar-large mb-2">
              <div>
                <label for="profilePicture" class="form-label">Change Picture</label>
                <input type="file" class="form-control" id="profilePicture" name="profilePicture">
                <?php if (isset($errors['profilePicture'])): ?>
                  <div class="text-danger small"><?= $errors['profilePicture'] ?></div>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-9">
              <!-- User Details -->
              <div class="mb-3">
                <label for="fullName" class="form-label required">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName"
                  value="<?= htmlspecialchars($user['full_name']) ?>">
                <?php if (isset($errors['fullName'])): ?>
                  <div class="text-danger small"><?= $errors['fullName'] ?></div>
                <?php endif; ?>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label required">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                  value="<?= htmlspecialchars($user['email']) ?>">
                <?php if (isset($errors['email'])): ?>
                  <div class="text-danger small"><?= $errors['email'] ?></div>
                <?php endif; ?>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="roomNo" class="form-label required">Application</label>
                  <select class="form-select" id="roomNo" name="roomNo">
                    <option value="application1" <?= $user['room_no'] == 'application1' ? 'selected' : '' ?>>Application 1</option>
                    <option value="application2" <?= $user['room_no'] == 'application2' ? 'selected' : '' ?>>Application 2</option>
                    <option value="cloud" <?= $user['room_no'] == 'cloud' ? 'selected' : '' ?>>Cloud</option>
                  </select>
                  <?php if (isset($errors['roomNo'])): ?>
                    <div class="text-danger small"><?= $errors['roomNo'] ?></div>
                  <?php endif; ?>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="extension" class="form-label required">Extension</label>
                  <input type="text" class="form-control" id="extension" name="extension"
                    value="<?= htmlspecialchars($user['extension']) ?>">
                  <?php if (isset($errors['extension'])): ?>
                    <div class="text-danger small"><?= $errors['extension'] ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <a href="home.php" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>