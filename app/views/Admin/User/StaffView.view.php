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

            <!-- Display Staff Details -->
            <form id="staffDetailsForm" class="main-content p-4 mt-3" style="
                                    background-color: #ffffff;
                                    border-radius: 8px;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                ">
                <div class="mb-3">
                    <label for="staffID" class="form-label">Staff ID</label>
                    <input type="text" class="form-control" id="staffID" value="ST001" required disabled />
                </div>

                <div class="mb-3">
                    <label for="staffName" class="form-label">Staff Name</label>
                    <input type="text" class="form-control" id="staffName" value="John Doe" required disabled />
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" required disabled>
                        <option value="SuperAdmin" selected>Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="phoneNo" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phoneNo" value="+123456789" required disabled />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" value="password123" required
                           disabled />
                </div>
                <br>

                <div class="data-bs-toggle justify-content-between">
                    <a href="StaffManage" class="btn btn-primary">Back</a>
                    <button type="button" class="btn btn-secondary" id="editButton">Update</button>
                    <button type="submit" class="btn btn-success d-none" id="saveButton">Save</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    // When the Update button is clicked, enable form fields for editing
    document.getElementById("editButton").addEventListener("click", function () {
        document.getElementById("staffName").disabled = false;
        document.getElementById("role").disabled = false;
        document.getElementById("phoneNo").disabled = false;
        document.getElementById("password").disabled = false;

        // Show the Save button and hide the Update button
        document.getElementById("saveButton").classList.remove("d-none");
        document.getElementById("editButton").classList.add("d-none");
    });

    // Additional save logic can go here
    document.getElementById("staffDetailsForm").addEventListener("submit", function (e) {
        e.preventDefault();
        // Implement save functionality here

        // Disable fields after saving
        document.getElementById("staffName").disabled = true;
        document.getElementById("role").disabled = true;
        document.getElementById("phoneNo").disabled = true;
        document.getElementById("password").disabled = true;

        // Reset the buttons
        document.getElementById("saveButton").classList.add("d-none");
        document.getElementById("editButton").classList.remove("d-none");
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>