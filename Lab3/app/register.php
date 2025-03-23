<?php

require_once('../handlers/registerHandler.php');
require_once('../includes/session.php');


startSession();

if (isLoggedIn()) {
    header('location: ./home.php');
    exit();
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors =  handleRegister($_POST);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/register.css">
</head>

<body>
    <div class="container">
        <!-- Info Banner -->
        <div class="top-info">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4><i class="bi bi-person-circle"></i> User Registration</h4>
                    <p class="mb-0">Please complete all required fields to register.</p>
                </div>
            </div>
        </div>

        <form id="registrationForm" method="post" action="" enctype="multipart/form-data">


            <!-- Personal Info Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="bi bi-person-vcard"></i> Personal Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="fullName" class="form-label required">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control form-control-lg" id="fullName" name="fullName" placeholder="Enter your full name">
                        </div>
                        <?php if (isset($errors['fullName'])): ?>
                            <div class="invalid-feedback d-block">
                                <?php echo $errors['fullName']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label required">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email address">
                        </div>
                        <?php if (isset($errors['email'])): ?>
                            <div class="invalid-feedback d-block">
                                <?php echo $errors['email']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Password Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="bi bi-lock"></i> Security</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="password" class="form-label required">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Create password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="form-text">Must be at least 8 characters long</div>
                        <?php if (isset($errors['password'])): ?>
                            <div class="invalid-feedback d-block">
                                <?php echo $errors['password']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label required">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control form-control-lg" id="confirmPassword" name="confirmPassword" placeholder="Repeat password">
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if (isset($errors['confirmPassword'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?php echo $errors['confirmPassword']; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Office Info Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="bi bi-building"></i> Office Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="roomNo" class="form-label required">Application</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-app"></i></span>
                                <select class="form-select form-select-lg" id="roomNo" name="roomNo">
                                    <option value="" selected disabled>Select application</option>
                                    <option value="application1">Application1</option>
                                    <option value="application2">Application2</option>
                                    <option value="cloud">Cloud</option>
                                </select>
                            </div>
                            <?php if (isset($errors['roomNo'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?php echo $errors['roomNo']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="extension" class="form-label required">Extension</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" class="form-control form-control-lg" id="extension" name="extension" placeholder="e.g. 1234">
                            </div>
                            <?php if (isset($errors['extension'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?php echo $errors['extension']; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Profile Picture Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="bi bi-person-badge"></i> Profile Picture</h5>
                </div>
                <div class="card-body text-center py-4">
                    <div class="avatar-wrapper">
                        <div class="avatar-preview" id="avatarPreview">
                            <span class="avatar-icon"><i class="bi bi-person"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label required">Upload Profile Picture</label>
                        <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*">
                        <div class="form-text">JPG or PNG format, max 2MB</div>
                        <?php if (isset($errors['profilePicture'])): ?>
                            <div class="invalid-feedback d-block">
                                <?php echo $errors['profilePicture']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Submit Buttons -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-check-circle me-2"></i>Register
                </button>
                <button type="reset" class="btn btn-outline-secondary btn-lg px-5">
                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>