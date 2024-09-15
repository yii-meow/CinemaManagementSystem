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
    <title>Staff Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include '../app/views/adminSidebar.php' ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-film me-2"></i>Staff Manage
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <div class="mb-3 d-flex flex-row-reverse">
                <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fa fa-plus me-3"></i>Add New Staff
                </button>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search staff..." />
                    </div>
                </div>
            </div>

            <!-- Staff list -->
            <table class="table">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                <tr>
                    <th scope="col" style="width: 5%;">No.</th>
                    <th scope="col" style="width: 15%;">Staff Name</th>
                    <th scope="col" style="width: 20%;">Role</th>
                    <th scope="col" style="width: 20%;">Phone No</th>
                    <th scope="col" style="width: 10%;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>John Doe</td>
                    <td>Manager</td>
                    <td>123-456-7890</td>
                    <td>
                        <a href="StaffView"><button class="btn btn-md btn-outline-primary me-2">
                                <i class="fas fa-exclamation-circle me-1"></i>View
                            </button></a>
                        <button class="btn btn-md btn-outline-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmationModal" data-user-id="1">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </td>
                </tr>

                <tr>
                    <th scope="row">2</th>
                    <td>Jane Smith</td>
                    <td>Cashier</td>
                    <td>098-765-4321</td>
                    <td>
                        <a href="StaffView"><button class="btn btn-md btn-outline-primary me-2">
                                <i class="fas fa-exclamation-circle me-1"></i>View
                            </button></a>
                        <button class="btn btn-md btn-outline-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmationModal" data-user-id="1">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </td>
                </tr>

                <tr>
                    <th scope="row">3</th>
                    <td>Mark Johnson</td>
                    <td>Technician</td>
                    <td>456-123-7890</td>
                    <td>
                        <a href="StaffView.html"><button class="btn btn-md btn-outline-primary me-2">
                                <i class="fas fa-exclamation-circle me-1"></i>View
                            </button></a>
                        <button class="btn btn-md btn-outline-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmationModal" data-user-id="1">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>
    </div>
    </main>
</div>
</div>

<!-- Add Cinema Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addCinemaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCinemaModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Add New Staff
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="cinemaName" class="form-label">
                            <i class="fas fa-user me-2"></i>Staff Name
                        </label>
                        <input type="text" class="form-control" id="cinemaName" required />
                    </div>
                    <div class="mb-3">
                        <label for="staffRole" class="form-label">
                            <i class="fas fa-cog me-2"></i>Role
                        </label>
                        <select class="form-select" id="staffRole" required>
                            <option value="">Select a role</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">
                            <i class="fas fa-phone-alt me-2"></i>Phone Number
                        </label>
                        <input type="text" class="form-control" id="staffPhone" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <input type="text" class="form-control" id="staffPass" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Add Staff
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this staff member?</p>
                <p id="deleteStaffName"></p> <!-- This will display the staff member's name -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">
                    <i class="fas fa-trash me-2"></i>Delete
                </button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>