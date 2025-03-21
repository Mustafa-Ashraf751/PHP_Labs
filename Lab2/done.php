<?php

$users = [];

if (file_exists("./customer.txt")) {
    $jsonContent = fopen('./customer.txt', "r");

    while (($line = fgets($jsonContent)) !== false) {
        $user = json_decode($line, true);
        if ($user) {
            $users[] = $user;
        }
    }

    fclose($jsonContent);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./done.css">

</head>

<body>
    <div class="container">
        <div class="container-card">
            <div class="header">
                <h2><i class="bi bi-people-fill"></i> Registered Users</h2>
                <p class="text-muted">Overview of all registered users in the system</p>
            </div>



            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Department</th>
                            <th scope="col">Country</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Skills</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $user['firstName'] . ' ' . $user['lastName']; ?></td>
                                <td>@<?php echo ($user['username']); ?></td>
                                <td><?php echo $user['department']; ?></td>
                                <td><?php echo $user['country']; ?></td>
                                <td>
                                    <?php if ($user['gender'] === 'male'): ?>
                                        <i class="bi bi-gender-male gender-icon"></i>Male
                                    <?php else: ?>
                                        <i class="bi bi-gender-female gender-icon"></i>Female
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php foreach ($user['skills'] as $skill): ?>
                                        <span class="skills-badge"><?php echo ucfirst($skill); ?></span>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>