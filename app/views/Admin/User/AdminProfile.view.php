<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/UserManage.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>Admin Profile</title>
    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <?php include '../app/views/adminSidebar.php' ?>


        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">Admin Profile</h1>

            <?php if (isset($data['messages'])): ?>
                <?php foreach ($data['messages'] as $message): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Profile Form -->
            <form id="adminProfileForm" class="main-content p-4 mt-3" method="post" style="
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                ">
                <?php if (isset($data['admin'])): ?>
                    <div class="mb-3">
                        <label for="adminID" class="form-label">
                            <i class="fas fa-id-badge me-2"></i>Admin ID
                        </label>
                        <input type="text" class="form-control" id="adminID" value="<?= htmlspecialchars($data['admin']->getUserId(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="adminUsername" class="form-label">
                            <i class="fas fa-user me-2"></i>Username
                        </label>
                        <input type="text" class="form-control" id="adminUsername" name="adminUsername" value="<?= htmlspecialchars($data['admin']->getUserName(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="adminPhoneNo" class="form-label">
                            <i class="fas fa-phone me-2"></i>Phone Number
                        </label>
                        <input type="tel" class="form-control" id="adminPhoneNo" name="adminPhoneNo" value="<?= htmlspecialchars($data['admin']->getPhoneNo(), ENT_QUOTES, 'UTF-8'); ?>" pattern="^\d{10,15}$" title="Phone number should be in international format, e.g., +01234567890" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">
                            <i class="fas fa-lock me-2"></i>Current Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter current password" disabled />
                            <button type="button" class="btn btn-outline-secondary" id="toggleCurrentPassword">
                                <i class="fas fa-eye" id="eyeCurrentPassword"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="adminPassword" class="form-label">
                            <i class="fas fa-lock me-2"></i>New Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="adminPassword" name="adminPassword"
                                   placeholder="Enter new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}"
                                   title="New password must be at least 6 characters long and include at least one number, one lowercase letter, one uppercase letter, and one special character"
                                   disabled />
                            <button type="button" class="btn btn-outline-secondary" id="toggleNewPassword">
                                <i class="fas fa-eye" id="eyeNewPassword"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="adminRole" class="form-label">
                            <i class="fas fa-briefcase me-2"></i>Role
                        </label>
                        <input type="text" class="form-control" id="adminRole" value="<?= htmlspecialchars($data['admin']->getRole(), ENT_QUOTES, 'UTF-8'); ?>" disabled />
                    </div>

                    <div class="d-md-block justify-content-between">
                        <button type="button" class="btn btn-secondary" id="editProfileButton">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </button>
                        <button type="submit" class="btn btn-success d-none" id="saveProfileButton">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                <?php else: ?>
                    <p>No admin data available.</p>
                <?php endif; ?>
            </form>
        </main>

    </div>

</div>


<script>
    // Toggle password visibility
    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.getElementById('toggleCurrentPassword').addEventListener('click', function () {
        togglePasswordVisibility('currentPassword', 'eyeCurrentPassword');
    });

    document.getElementById('toggleNewPassword').addEventListener('click', function () {
        togglePasswordVisibility('adminPassword', 'eyeNewPassword');
    });

    // Enable form fields for editing
    document.getElementById("editProfileButton").addEventListener("click", function () {
        document.getElementById("adminUsername").disabled = false;
        document.getElementById("adminPhoneNo").disabled = false;
        document.getElementById("adminPassword").disabled = false;
        document.getElementById("currentPassword").disabled = false;

        document.getElementById("saveProfileButton").classList.remove("d-none");
        document.getElementById("editProfileButton").classList.add("d-none");
    });

    // Handle Save Changes button click
    document.getElementById("adminProfileForm").addEventListener("submit", function (e) {
        e.preventDefault();
        document.getElementById("adminProfileForm").submit();
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>