<!DOCTYPE html>
<html lang="en">

<?php include '../app/views/user_header.php' ?>
<style>
    /* Password Wrapper for handling visibility toggle */
    .password-wrapper {
        position: relative;
        width: 100%; /* Ensure the wrapper takes full width */
    }

    /* Password input styling */
    .password-wrapper input {
        width: 100%;
        padding-right: 40px; /* Add padding to make space for the eye icon */
        padding-left: 10px; /* Spacing for input content */
        background-color: #222;
        border: 1px solid #333;
        color: white;
        border-radius: 5px;
        height: 40px;
        font-size: 16px;
    }

    /* Focus state for the password input */
    .password-wrapper input:focus {
        border-color: #f03351;
        outline: none;
    }

    /* Toggle Password Visibility Icon */
    .toggle-password {
        position: absolute;
        right: 10px; /* Place the icon on the right side */
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #fff; /* Change to match your design */
        background-color: transparent; /* Transparent background */
        border: none;
    }

    /* Hover effect for the eye icon */
    .toggle-password:hover {
        color: #f03351;
    }

    /* Error message (optional, if you need to show validation messages) */
    .password-error {
        color: #f03351;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Form Submit Button - Ensure Consistency with Existing Styles */
    .btn-save {
        width: 100%;
        padding: 10px;
        background-color: #f03351;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-save:hover {
        background-color: #d82a4b;
    }
</style>
<body>

<?php
if (isset($data['user'])) {
$user = $data['user'];

?>

<div id="Customer">

    <?php include '../app/views/header.php' ?>
    <?php include '../app/views/navigationBar.php' ?>

    <!--Main Contents-->
    <div class="outer-box">
        <div class="main-title">
            User Profile
        </div>
        <!-- Left Sidebar -->
        <?php include '../app/views/ProfileNav.php' ?>

        <!-- Right Content -->
        <div class="right-box">
            <h2>Change Password</h2>
            <?php if (isset($data['success_message'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($data['success_message']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($data['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($data['error']); ?>
                </div>
            <?php endif; ?>
            <!-- Change Password Form -->
            <form action="ChangePass" method="POST">
                <div class="form-group">
                    <label for="currentPass">Current Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="currentPass" name="currentPass" required />
                        <span class="toggle-password" onclick="togglePasswordVisibility('currentPass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="newPass">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="newPass" name="newPass" required />
                        <span class="toggle-password" onclick="togglePasswordVisibility('newPass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmPass">Confirm New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="confirmPass" name="confirmPass" required />
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirmPass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" style="width: 20%;" class="btn-save">Confirm</button>
            </form>
        </div>
    </div>
    <!--End of Main Contents-->

    <?php include '../app/views/footer.php' ?>

    <?php
    } else {
        echo "User data not available";
        exit();
    }
    ?>
    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Password Visibility Toggle Script -->
    <script>
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = passwordField.nextElementSibling.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>