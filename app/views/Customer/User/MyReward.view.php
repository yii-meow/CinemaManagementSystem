<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css" />
    <title>Categories</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<?php
// Ensure that $data['user'] is set and assign it to $user
if (isset($data['user'])) {
$user = $data['user'];

?>
<div id="Customer">

    <?php include '../app/views/header.php' ?>


    <?php include '../app/views/navigationBar.php' ?>


    <!--Main Contents-->

    <div class="outer-box">
        <div class="main-title">
            User Profile
        </div>
        <!-- Left Sidebar -->
        <div class="left-box">
            <div class="profile-card">
                <img src="<?= ROOT ?>/assets/images/<?= !empty($user->profileImg) ? htmlspecialchars($user->profileImg) : 'profile4.jpg' ?>"
                     alt="Profile Picture" class="user-image">
                <p class="user-name"><?= htmlspecialchars($user->userName) ?></p>
                <button class="edit-profile-btn" onclick="window.location.href='ProfileEdit'">Edit
                    Profile</button>
                <div class="reward-info">
                    <div class="reward-item-info">
                        <p>Coins</p>
                        <p><?= htmlspecialchars($user->coins) ?></p>
                    </div>
                    <div class="reward-item-info">
                        <p>My Rewards</p>
                        <p>0</p>
                    </div>
                </div>
            </div>

            <div class="nav-menu">
                <a href="#">My Tickets</a>
                <a href="" style="color: red">My Rewards</a>
                <a href="RewardCentre">Rewards Centre</a>
                <a href="ChangePass">Change Password</a>
                <a href="#">Delete Account</a>
            </div>
        </div>

        <!-- Right Content -->
        <div class="right-box">
            <h2>My Reward</h2>

            <!-- Filter Options -->
            <div class="filter-options">
                <button class="filter-btn active" onclick="filterRewards('all')">All</button>
                <button class="filter-btn" onclick="filterRewards('ticket')">Ticket</button>
                <button class="filter-btn" onclick="filterRewards('food')">Food and Beverage</button>
            </div>

            <!-- Redeemed Rewards List -->
            <div class="redeemed-reward-list">
                <div class="redeemed-reward-item">
                    <img src="<?= ROOT ?>/assets/images/mainMovie_1.jpg" alt="Reward 1">
                    <div class="redeemed-reward-details">
                        <h3>Reward Title 1</h3>
                        <p>Description of the redeemed reward goes here. This could include details about what
                            the reward is for.
                        </p>
                        <p class="redeem-date">Redeemed on: August 29, 2024</p>
                    </div>
                    <!-- Used Label -->
                    <div class="used-label">Used</div>
                </div>
                <div class="redeemed-reward-item">
                    <img src="<?= ROOT ?>/assets/images/mainMovie_1.jpg" alt="Reward 2">
                    <div class="redeemed-reward-details">
                        <h3>Reward Title 2</h3>
                        <p>Description of the redeemed reward goes here. This could include details about what
                            the reward is for.
                        </p>
                        <p class="redeem-date">Redeemed on: August 30, 2024</p>
                    </div>
                </div>
                <!-- Add more redeemed reward items as needed -->
            </div>
        </div>
    </div>

    <!--End of Main Contents-->


    <?php include '../app/views/footer.php' ?>


    <?php
    } else {
        // If $user is not set, handle the error appropriately
        echo "User data not available";
        exit();
    }
    ?>

    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>