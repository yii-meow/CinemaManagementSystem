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
    <title>User Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include '../app/views/adminSidebar.php' ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">Customer Details</h1>

            <!-- Display User Details -->
            <form id="userDetailsForm" class="main-content p-4 mt-3" style="
                                            background-color: #ffffff;
                                            border-radius: 8px;
                                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        ">
                <div class="mb-3">
                    <label for="userID" class="form-label">Customer ID</label>
                    <input type="text" class="form-control" id="userID" value="<?= htmlspecialchars($user->getUserId(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($user->getUserName(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="phoneNo" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phoneNo" value="<?= htmlspecialchars($user->getPhoneNo(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="birthDate" class="form-label">Birth Date</label>
                    <input type="date" class="form-control" id="birthDate" value="<?= htmlspecialchars($user->getBirthDate(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                </div>

                <div class="mb-3">
                    <label for="profileImage" class="form-label">Profile Image</label>
                    <div class="d-flex align-items-center">
                        <img src="<?= ROOT ?>/assets/images/<?= htmlspecialchars($user->getProfileImg(), ENT_QUOTES, 'UTF-8'); ?>" alt="Profile Image" class="img-thumbnail me-3"
                             style="width: 100px; height: 100px;" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" required disabled>
                        <option value="M" <?= $user->getGender() === 'M' ? 'selected' : ''; ?>>Male</option>
                        <option value="F" <?= $user->getGender() === 'F' ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="coins" class="form-label">Coins</label>
                    <input type="number" class="form-control" id="coins" value="<?= htmlspecialchars($user->getCoins(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                </div>

                <!-- New Status Dropdown -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" required>
                        <option value="active" style="color: green;" <?= $user->getStatus() === 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="deactive" style="color: red;" <?= $user->getStatus() === 'deactive' ? 'selected' : ''; ?>>Deactive</option>
                    </select>
                </div>

                <br>

                <div class="d-md-block justify-content-between">
                    <a href="UserManage" class="btn btn-primary">Back</a>
                    <button type="button" style="background-color: green" class="btn btn-secondary" id="statusButton">Set Status</button>
                </div>

                <!-- Display Rewards -->
                <h2 class="mt-5 mb-3">Reward Details</h2>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                            <tr>
                                <th scope="col" style="width: 10%;">No.</th>
                                <th scope="col" style="width: 20%;">Reward Title</th>
                                <th scope="col" style="width: 30%;">Category</th>
                                <th scope="col" style="width: 25%;">Image</th>
                                <th scope="col" style="width: 15%;">Status</th>
                            </tr>
                            </thead>
                            <tbody style="background-color:ghostwhite;">
                            <?php if (!empty($rewards)): ?>
                                <?php foreach ($rewards as $index => $reward): ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td><?= htmlspecialchars($reward['rewardTitle'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($reward['category'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><img src="<?= ROOT ?>/assets/images/<?= htmlspecialchars($reward['rewardImg'] ?? 'default.jpg', ENT_QUOTES, 'UTF-8'); ?>" alt="Reward Image" class="img-thumbnail" style="width: 100px; height: 100px;" /></td>
                                        <td style="<?= $reward['rewardCondition'] === 'used' ? 'color: red;' : 'color: green;' ?>"><b><?= htmlspecialchars($reward['rewardCondition'], ENT_QUOTES, 'UTF-8'); ?></b></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No rewards found.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>
<br>

<script>
    document.getElementById("status").addEventListener("change", function () {
        var statusSelect = document.getElementById("status");
        var statusButton = document.getElementById("statusButton");
        var initialStatus = "<?= htmlspecialchars($user->getStatus(), ENT_QUOTES, 'UTF-8'); ?>";

        if (statusSelect.value !== initialStatus) {
            statusButton.classList.add("enabled");
            statusButton.disabled = false;
        } else {
            statusButton.classList.remove("enabled");
            statusButton.disabled = true;
        }
    });

    document.getElementById("statusButton").addEventListener("click", function () {
        var statusSelect = document.getElementById("status");
        var status = statusSelect.value;
        var userId = document.getElementById("userID").value;

        var confirmation = confirm("Are you sure you want to change the status to " + (status === "active" ? "Active" : "Deactive") + "?");

        if (confirmation) {
            // Send AJAX request to update status
            $.ajax({
                url: 'UserView/updateStatus', // Update this URL based on your routing setup
                type: 'POST',
                data: {
                    userId: userId,
                    status: status
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert(result.message);
                        // Optionally refresh the page or update the UI
                    } else {
                        alert(result.message);
                    }
                },
                error: function () {
                    alert('An error occurred while updating the status.');
                }
            });
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>