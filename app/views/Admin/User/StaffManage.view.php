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
                    <i class="fas fa-user-circle me-2"></i>Staff Manage
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($success) && $success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="mb-3 d-flex flex-row-reverse">
                <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fa fa-plus me-3"></i>Add New Staff
                </button>
            </div>

            <!-- Filtering and Search -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="<?= ROOT ?>/StaffManage">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Search staff..." value="<?= htmlspecialchars($searchQuery ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- Staff list -->
            <table class="table">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                <tr>
                    <th scope="col" style="width: 5%;">No.</th>
                    <th scope="col" style="width: 15%;">Staff Name</th>
                    <th scope="col" style="width: 20%;">Phone No</th>
                    <th scope="col" style="width: 20%;">Role</th>
                    <th scope="col" style="width: 10%;">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($staff) && !empty($staff)): ?>
                    <?php foreach ($staff as $index => $member): ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= htmlspecialchars($member->getUserName(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($member->getPhoneNo(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($member->getRole(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="StaffView?staffId=<?= htmlspecialchars($member->getUserId(), ENT_QUOTES, 'UTF-8'); ?>">
                                    <button class="btn btn-md btn-outline-primary me-2">
                                        <i class="fas fa-eye me-1"></i>View
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No staff found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
    </div>
    </main>
</div>
</div>

<!-- Add Staff Modal -->
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
                <form method="POST" action="<?= ROOT ?>/StaffManage">
                    <div class="mb-3">
                        <label for="staffName" class="form-label">
                            <i class="fas fa-user me-2"></i>Staff Name
                        </label>
                        <input type="text" class="form-control" id="staffName" name="staffName" required />
                    </div>
                    <div class="mb-3">
                        <label for="staffPhone" class="form-label">
                            <i class="fas fa-phone-alt me-2"></i>Phone Number
                        </label>
                        <input type="text" class="form-control" id="staffPhone" name="phoneNo" required />
                    </div>
                    <div class="mb-3">
                        <label for="staffPass" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password <sup style="color: red">*Set Default*</sup>
                        </label>
                        <input type="text" class="form-control" id="staffPass" value="staffpass" disabled/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Add Staff
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>