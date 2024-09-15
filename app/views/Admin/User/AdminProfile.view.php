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

            <!-- Profile Form -->
            <form id="adminProfileForm" class="main-content p-4 mt-3" style="
                                            background-color: #ffffff;
                                            border-radius: 8px;
                                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        ">
                <div class="mb-3">
                    <label for="adminID" class="form-label">Admin ID</label>
                    <input type="text" class="form-control" id="adminID" value="A001" required disabled />
                </div>

                <div class="mb-3">
                    <label for="adminUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="adminUsername" value="admin_john" required />
                </div>

                <div class="mb-3">
                    <label for="adminEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="adminEmail" value="admin.john@example.com"
                           required />
                </div>

                <div class="mb-3">
                    <label for="adminPhoneNo" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="adminPhoneNo" value="+123456789" required />
                </div>

                <div class="mb-3">
                    <label for="adminPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="adminPassword"
                           placeholder="Enter new password" />
                </div>

                <div class="mb-3">
                    <label for="adminRole" class="form-label">Role</label>
                    <input type="text" class="form-control" id="adminRole" value="Admin" disabled />
                </div>

                <div class="d-md-block justify-content-between">
                    <button type="button" class="btn btn-secondary" id="editProfileButton">Edit Profile</button>
                    <button type="submit" class="btn btn-success d-none" id="saveProfileButton">Save
                        Changes</button>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    // When the Edit Profile button is clicked, enable form fields for editing
    document.getElementById("editProfileButton").addEventListener("click", function () {
        document.getElementById("adminUsername").disabled = false;
        document.getElementById("adminEmail").disabled = false;
        document.getElementById("adminPhoneNo").disabled = false;
        document.getElementById("adminPassword").disabled = false;

        // Show the Save Changes button and hide the Edit Profile button
        document.getElementById("saveProfileButton").classList.remove("d-none");
        document.getElementById("editProfileButton").classList.add("d-none");
    });

    // Handle Save Changes button click
    document.getElementById("adminProfileForm").addEventListener("submit", function (e) {
        e.preventDefault();
        // Implement save functionality here

        // Disable fields after saving
        document.getElementById("adminUsername").disabled = true;
        document.getElementById("adminEmail").disabled = true;
        document.getElementById("adminPhoneNo").disabled = true;
        document.getElementById("adminPassword").disabled = true;

        // Reset the buttons
        document.getElementById("saveProfileButton").classList.add("d-none");
        document.getElementById("editProfileButton").classList.remove("d-none");
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>