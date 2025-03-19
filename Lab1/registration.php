<?php
session_start();

// Set static CAPTCHA code
$staticCaptcha = "ABC123";
$_SESSION['captcha'] = $staticCaptcha;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_SESSION['captcha']);
    if ($_POST['captchaInput'] !== $_SESSION['captcha']) {
        header('Location: registration.php');
        exit;
    }

    header('Location: done.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!--import css file-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="bi bi-person-plus"></i> Registration Form</h2>
                <p class="text-muted">Please fill in all the required fields</p>
            </div>

            <form id="registrationForm" class="needs-validation" action="registration.php" method="post" novalidate>
                <div class="section">
                    <h4 class="section-title"><i class="bi bi-person"></i> Personal Information</h4>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label required-field">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                            <?php if (!empty($firstNameError)): ?>
                                echo "<div class='invalid-feedback'>
                                    Please provide your first name.
                                </div>";
                                }
                            <?php endif; ?>

                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label required-field">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                            <div class="invalid-feedback">
                                Please provide your last name.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label required-field">Address</label>
                        <textarea class="form-control" id="address" rows="3" name="address" required></textarea>
                        <div class="invalid-feedback">
                            Please provide your address.
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="country" class="form-label required-field">Country</label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="">Select a country</option>
                                <option value="USA">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="Canada">Canada</option>
                                <option value="Australia">Australia</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                                <option value="Japan">Japan</option>
                                <option value="China">China</option>
                                <option value="India">India</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a country.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required-field">Gender</label>
                            <div class="gender-group">
                                <label class="custom-radio">
                                    <input type="radio" name="gender" class="custom-option-input" value="male" required>
                                    <div class="custom-option">
                                        <span class="checkmark"></span>
                                        <i class="bi bi-gender-male"></i> Male
                                    </div>
                                </label>
                                <label class="custom-radio">
                                    <input type="radio" name="gender" class="custom-option-input" value="female" required>
                                    <div class="custom-option">
                                        <span class="checkmark"></span>
                                        <i class="bi bi-gender-female"></i> Female
                                    </div>
                                </label>

                            </div>
                            <div class="invalid-feedback">
                                Please select a gender.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h4 class="section-title"><i class="bi bi-stars"></i> Skills & Department</h4>
                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <div class="skills-group">
                            <label class="custom-checkbox">
                                <input type="checkbox" name="skills[]" class="custom-option-input" value="html">
                                <div class="custom-option">
                                    <span class="checkmark"></span>
                                    <i class="bi bi-file-earmark-code"></i> HTML
                                </div>
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" name="skills[]" class="custom-option-input" value="css">
                                <div class="custom-option">
                                    <span class="checkmark"></span>
                                    <i class="bi bi-brush"></i> CSS
                                </div>
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" name="skills[]" class="custom-option-input" value="javascript">
                                <div class="custom-option">
                                    <span class="checkmark"></span>
                                    <i class="bi bi-braces"></i> JavaScript
                                </div>
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" name="skills[]" class="custom-option-input" value="python">
                                <div class="custom-option">
                                    <span class="checkmark"></span>
                                    <i class="bi bi-code-slash"></i> Python
                                </div>
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" name="skills[]" class="custom-option-input" value="java">
                                <div class="custom-option">
                                    <span class="checkmark"></span>
                                    <i class="bi bi-cup-hot"></i> Java
                                </div>
                            </label>
                            <label class="custom-checkbox">
                                <input type="checkbox" name="skills[]" class="custom-option-input" value="other">
                                <div class="custom-option">
                                    <span class="checkmark"></span>
                                    <i class="bi bi-plus-circle"></i> Other
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label required-field">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <option value="">Select a department</option>
                            <option value="IT">Information Technology</option>
                            <option value="HR">Human Resources</option>
                            <option value="Finance">Finance</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Sales">Sales</option>
                            <option value="Operations">Operations</option>
                            <option value="Research">Research & Development</option>
                            <option value="Customer">Customer Support</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a department.
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h4 class="section-title"><i class="bi bi-shield-lock"></i> Account Information</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label required-field">Username</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label required-field">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="invalid-feedback">
                                Please provide a password.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="captcha-container">
                    <h4 class="section-title"><i class="bi bi-shield-check"></i> Verification</h4>
                    <label class="form-label required-field">Verification Code</label>
                    <div class="d-flex align-items-center mb-3">
                        <div class="captcha-code flex-grow-1" id="captchaCode" style="font-family: 'Courier New', monospace; font-size: 24px; letter-spacing: 3px; font-weight: bold;">
                            <?php echo $staticCaptcha; ?>
                        </div>
                        <!-- Removed refresh button since we're using static code -->
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="captchaInput" id="captchaInput" placeholder="Enter the code above" required>
                        <div class="invalid-feedback">
                            Please enter the verification code correctly.
                        </div>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle-fill"></i> Register
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>