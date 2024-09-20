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
    <title>Reward Management</title>

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
                    <i class="fas fa-award me-2"></i>Reward Manage
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <!-- Success Message -->
            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <!-- Success Message -->
            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="mb-3 d-flex flex-row-reverse">
                <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#addRewardModal">
                    <i class="fa fa-plus me-3"></i>Add New Reward
                </button>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="get" action="RewardManage">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Search reward..."
                                   value="<?= htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Rewards list -->
            <table class="table">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white">
                <tr>
                    <th scope="col" style="width: 5%;">No.</th>
                    <th scope="col" style="width: 10%;">Reward Image</th>
                    <th scope="col" style="width: 10%;">Reward Title</th>
                    <th scope="col" style="width: 10%;">Category</th>
                    <th scope="col" style="width: 10%;">Details</th>
                    <th scope="col" style="width: 10%;">Description</th>
                    <th scope="col" style="width: 10%;">Qty</th>
                    <th scope="col" style="width: 5%;">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($rewards) && !empty($rewards)): ?>
                    <?php foreach ($rewards as $index => $reward): ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td>
                                <img src="<?= ROOT ?>/assets/images/<?= htmlspecialchars($reward->getRewardImg(), ENT_QUOTES, 'UTF-8'); ?>" alt="Reward Image"
                                     style="width: 70px;height: 70px"/>
                            </td>
                            <td><?= htmlspecialchars($reward->getRewardTitle(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($reward->getCategory(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($reward->getDetails(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($reward->getDescription(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($reward->getQty(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="RewardView?rewardId=<?= htmlspecialchars($reward->getRewardId(), ENT_QUOTES, 'UTF-8'); ?>">
                                    <button class="btn btn-md btn-outline-primary me-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>View
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No rewards found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<!-- Add Reward Modal -->
<div class="modal fade" id="addRewardModal" tabindex="-1" aria-labelledby="addRewardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRewardModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Add New Reward
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRewardForm" action="RewardManage" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="rewardImage" class="form-label">Reward Image</label>
                        <input type="file" class="form-control" id="rewardImage" name="rewardImage" />
                    </div>
                    <div class="mb-3">
                        <label for="rewardTitle" class="form-label">Reward Title</label>
                        <input type="text" class="form-control" id="rewardTitle" name="rewardTitle" required />
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Ticket">Ticket</option>
                            <option value="Food&Beverage">Food & Beverage</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <textarea class="form-control" id="details" name="details" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" required />
                    </div>
                    <div class="mb-3">
                        <label for="neededCoins" class="form-label">Needed Coins</label>
                        <input type="number" class="form-control" id="neededCoins" name="neededCoins" required />
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="hidden" name="action" value="addReward" />
                        <button type="submit" class="btn btn-primary">Add Reward</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
</script>
</body>

</html>