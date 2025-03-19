<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="done.css">
</head>
<body>
<div class="container">
    <div class="container-card">
        <div class="header">
            <h2><i class="bi bi-check-circle"></i> Registration Result</h2>
            <p class="text-muted">Your registration information</p>
        </div>

        <!-- Success Message -->
        <div class="success-message">
            <i class="bi bi-check-circle-fill"></i> Registration successful! Your account has been created.
        </div>

        <!-- Personal Information Section -->
        <div class="result-section">
            <h4 class="section-title"><i class="bi bi-person"></i> Personal Information</h4>

            <div class="row">
                <div class="col-md-6">
                    <div class="data-item">
                        <div class="data-label">First Name</div>
                        <div class="data-value"><?php echo $_POST['firstName']?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="data-item">
                        <div class="data-label">Last Name</div>
                        <div class="data-value"><?php echo $_POST['lastName']?></div>
                    </div>
                </div>
            </div>

            <div class="data-item">
                <div class="data-label">Address</div>
                <div class="data-value"><?php echo $_POST['address']?></div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="data-item">
                        <div class="data-label">Country</div>
                        <div class="data-value"><?php echo $_POST['country']?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="data-item">
                        <div class="data-label">Gender</div>
                        <div class="data-value">
                            <i class="bi bi-gender-male"></i> <?php echo $_POST['gender']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills & Department Section -->
        <div class="result-section">
            <h4 class="section-title"><i class="bi bi-stars"></i> Skills & Department</h4>

            <div class="data-item">
                <div class="data-label">Skills</div>
                <div class="data-value">
                    <?php
                    foreach($_POST['skills'] as $skill)
                    echo "<span class='skills-badge'>$skill</span>";
                    ?>
                </div>
            </div>

            <div class="data-item">
                <div class="data-label">Department</div>
                <div class="data-value"> <?php echo $_POST['department']?></div>
            </div>
        </div>

        <!-- Account Information Section -->
        <div class="result-section">
            <h4 class="section-title"><i class="bi bi-shield-lock"></i> Account Information</h4>

            <div class="data-item">
                <div class="data-label">Username</div>
                <div class="data-value"><?php echo $_POST['username']?></div>
            </div>

            <div class="data-item">
                <div class="data-label">Password</div>
                <div class="data-value"><?php echo $_POST['password']?></div>
            </div>

        </div>

        <div class="footer">
            <a href="registration.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Registration
            </a>
        </div>
    </div>
</div>
</body>
</html>

