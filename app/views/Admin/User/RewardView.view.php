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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/UserManage.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>Reward Details</title>
    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include '../app/views/adminSidebar.php' ?>


        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">Reward Details</h1>

            <!-- Display Reward Details -->
            <?php if (isset($reward)): ?>
                <form id="rewardDetailsForm" class="main-content p-4 mt-3" style="
                        background-color: #ffffff;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    " action="<?= ROOT ?>/RewardView" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="rewardId" value="<?= htmlspecialchars($reward->getRewardId(), ENT_QUOTES, 'UTF-8'); ?>" />

                    <div class="mb-3">
                        <label for="rewardId" class="form-label">Reward ID</label>
                        <input type="text" class="form-control" id="rewardId" name="rewardId" value="<?= htmlspecialchars($reward->getRewardId(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="rewardTitle" class="form-label">Reward Title</label>
                        <input type="text" class="form-control" id="rewardTitle" name="rewardTitle" value="<?= htmlspecialchars($reward->getRewardTitle(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="rewardCategory" class="form-label">Category</label>
                        <input type="text" class="form-control" id="rewardCategory" name="category" value="<?= htmlspecialchars($reward->getCategory(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="rewardImage" class="form-label">Reward Image</label>
                        <div class="d-flex align-items-center">
                            <img src="<?= ROOT ?>/assets/images/<?= htmlspecialchars($reward->getRewardImg(), ENT_QUOTES, 'UTF-8'); ?>" alt="Reward Image"
                                 class="img-thumbnail me-3" style="width: 100px; height: 100px;" />
                            <input type="file" class="form-control" id="rewardImage" name="rewardImage" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="rewardDetails" class="form-label">Details</label>
                        <textarea class="form-control" id="rewardDetails" name="details" rows="3" required disabled><?= htmlspecialchars($reward->getDetails(), ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="rewardDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="rewardDescription" name="description" rows="3" required disabled><?= htmlspecialchars($reward->getDescription(), ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="rewardQty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="rewardQty" name="qty" value="<?= htmlspecialchars($reward->getQty(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <div class="mb-3">
                        <label for="neededCoins" class="form-label">Needed Coins</label>
                        <input type="number" class="form-control" id="neededCoins" name="neededCoins" value="<?= htmlspecialchars($reward->getNeededCoins(), ENT_QUOTES, 'UTF-8'); ?>" required disabled />
                    </div>

                    <br>

                    <div class="d-md-block justify-content-between">
                        <a href="<?= ROOT ?>/RewardManage" class="btn btn-primary">Back</a>
                        <button type="button" class="btn btn-secondary" id="editButton">Edit</button>
                        <button type="submit" class="btn btn-success d-none" id="saveButton" name="action" value="update">Save</button>
                        <button type="submit" class="btn btn-danger" id="deleteButton" name="action" value="delete">Delete</button>
                    </div>
                </form>
            <?php else: ?>
                <p>No reward details available.</p>
            <?php endif; ?>
        </main>
    </div>
</div>
<br>

<script>
    // When the Edit button is clicked, enable form fields for editing
    document.getElementById("editButton").addEventListener("click", function () {
        document.getElementById("rewardTitle").disabled = false;
        document.getElementById("rewardCategory").disabled = false;
        document.getElementById("rewardDetails").disabled = false;
        document.getElementById("rewardDescription").disabled = false;
        document.getElementById("rewardQty").disabled = false;
        document.getElementById("neededCoins").disabled = false;

        // Show the Save button and hide the Edit button
        document.getElementById("saveButton").classList.remove("d-none");
        document.getElementById("editButton").classList.add("d-none");
    });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>