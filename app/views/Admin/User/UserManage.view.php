<!DOCTYPE html>
<!--
Author: Chong Kah Yan
-->
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
    <title>User Management</title>

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
                    <i class="fas fa-user me-2"></i>User Manage
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="<?= ROOT ?>/UserManage">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Search user..."
                                   value="<?= htmlspecialchars($searchQuery ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- User list -->
            <table class="table">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Profile Image</th>
                    <th scope="col">Username</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($users) && !empty($users)): ?>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td>
                                <img src="<?= ROOT ?>/assets/images/<?= $user->getProfileImg() ?? '../../../public/assets/images/profile4.jpg'; ?>" alt="Profile Image"
                                     style="width:40px; height:40px; border-radius:50%;">
                            </td>
                            <td><?= htmlspecialchars($user->getUserName(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($user->getPhoneNo(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="UserView?userId=<?= $user->getUserId(); ?>"><button class="btn btn-md btn-outline-primary me-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>View
                                    </button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No users found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>