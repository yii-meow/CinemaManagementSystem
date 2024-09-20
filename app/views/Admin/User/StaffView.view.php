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
    <!-- <link rel="stylesheet" href="../reset.css" /> -->

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/UserManage.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>Cinema Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include '../app/views/adminSidebar.php' ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">Staff Details</h1>

            <!-- Display success or error messages -->
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Display Staff Details -->
            <?php if (isset($staff)): ?>
                <form id="staffDetailsForm" class="main-content p-4 mt-3" method="POST" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <div class="mb-3">
                        <label for="staffID" class="form-label">Staff ID</label>
                        <input type="text" class="form-control" id="staffID" value="<?= htmlspecialchars($staff->getUserId(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" value="<?= htmlspecialchars($staff->getRole(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="staffName" class="form-label">Staff Name</label>
                        <input type="text" class="form-control" name="staffName" id="staffName" value="<?= htmlspecialchars($staff->getUserName(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="phoneNo" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phoneNo" id="phoneNo" value="<?= htmlspecialchars($staff->getPhoneNo(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <input type="hidden" name="delete" value="1" />

                    <br>

                    <div class="d-md-block justify-content-between">
                        <a href="<?= ROOT ?>/StaffManage" class="btn btn-primary">Back</a>
                        <button type="button" class="btn btn-secondary" id="editButton">Edit</button>
                        <button type="submit" class="btn btn-success d-none" id="saveButton">Save</button>
                        <button type="submit" class="btn btn-danger" id="deleteButton" name="delete" value="1">Delete</button>
                    </div>
                </form>
            <?php else: ?>
                <p>No staff details available.</p>
            <?php endif; ?>
        </main>
    </div>
</div>

<script>
    // Enable form fields for editing
    document.getElementById("editButton").addEventListener("click", function () {
        document.getElementById("staffName").disabled = false;
        document.getElementById("phoneNo").disabled = false;

        // Show the Save button and hide the Edit button
        document.getElementById("saveButton").classList.remove("d-none");
        document.getElementById("editButton").classList.add("d-none");
    });

    // Handle form submission for saving and deleting
    document.getElementById("staffDetailsForm").addEventListener("submit", function (e) {
        e.preventDefault();

        // Get the form action and method
        const formAction = this.action;
        const formMethod = this.method;

        // Handle form submission
        fetch(formAction, {
            method: formMethod,
            body: new URLSearchParams(new FormData(this)),
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display success message and redirect
                    const successAlert = document.createElement('div');
                    successAlert.className = 'alert alert-success alert-dismissible fade show';
                    successAlert.role = 'alert';
                    successAlert.innerHTML = data.success + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    document.querySelector('main').insertBefore(successAlert, document.querySelector('main').firstChild);
                    setTimeout(() => window.location.href = 'StaffManage', 2000); // Redirect after 2 seconds
                } else if (data.error) {
                    // Display error message
                    const errorAlert = document.createElement('div');
                    errorAlert.className = 'alert alert-danger alert-dismissible fade show';
                    errorAlert.role = 'alert';
                    errorAlert.innerHTML = data.error + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    document.querySelector('main').insertBefore(errorAlert, document.querySelector('main').firstChild);
                }
            });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>