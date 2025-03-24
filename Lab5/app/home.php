<?php

require_once '../handlers/logoutHandler.php';
require_once '../includes/session.php';
require_once '../data/Database.php';

startSession();
requireLogin();

$database = new Database();
$pdo = $database->getConnection();

$users = $database->getAll($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  handleLogOut();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users Management</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/home.css">
</head>

<body>
  <div class="container py-4">
    <!-- Header Section -->
    <div class="top-info mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h4><i class="bi bi-people-fill"></i> Users Management</h4>
          <p class="mb-0">View, edit and manage user accounts</p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="register.php" class="btn btn-success">
            <i class="bi bi-person-plus-fill"></i> Add New User
          </a>
          <form method="post" action="" class="d-inline">
            <button type="submit" class="btn btn-danger">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input type="text" id="searchUsers" class="form-control" placeholder="Search users...">
              <button class="btn btn-outline-secondary" type="button">Search</button>
            </div>
          </div>
          <div class="col-md-4">
            <select class="form-select" id="filterApplication">
              <option value="">All Applications</option>
              <option value="application1">Application 1</option>
              <option value="application2">Application 2</option>
              <option value="cloud">Cloud</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Users Table -->
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover user-table">
            <thead>
              <tr>
                <th scope="col"><i class="bi bi-image"></i> Profile</th>
                <th scope="col"><i class="bi bi-person"></i> Name</th>
                <th scope="col"><i class="bi bi-envelope"></i> Email</th>
                <th scope="col"><i class="bi bi-app"></i> Application</th>
                <th scope="col"><i class="bi bi-telephone"></i> Extension</th>
                <th scope="col" class="text-center"><i class="bi bi-gear"></i> Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td>
                    <img src="../uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile" class="user-avatar">
                  </td>
                  <td><?= htmlspecialchars($user['full_name']) ?></td>
                  <td><?= htmlspecialchars($user['email']) ?></td>
                  <td><span class="badge bg-primary"><?= htmlspecialchars($user['room_no']) ?></span></td>
                  <td><?= htmlspecialchars($user['extension']) ?></td>
                  <td class="text-center">
                    <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit User">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger" title="Delete User">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="User pagination">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>

      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>