<!DOCTYPE html>
<html lang="en">
<html lang="zxx" class="no-js">

<head>
    <meta charset="UTF-8">
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

<body>
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
                <div class="user-initial">K</div>
                <p class="user-name">Kyan</p>
                <button class="edit-profile-btn" onclick="window.location.href='ProfileEdit'">Edit
                    Profile</button>
                <div class="reward-info">
                    <div class="reward-item-info">
                        <p>Coins</p>
                        <p>0</p>
                    </div>
                    <div class="reward-item-info">
                        <p>My Rewards</p>
                        <p>0</p>
                    </div>
                </div>
            </div>

            <div class="nav-menu">
                <a href="#">My Tickets</a>
                <a href="MyReward">My Rewards</a>
                <a href="#">Rewards Centre</a>
                <a href="Favourite">Favourite</a>
                <a href="ChangePass">Change Password</a>
                <a href="#">Delete Account</a>
            </div>
        </div>

        <!-- Right Content -->
        <div class="right-box">
            <h2>Reward Centre</h2>
            <!-- Filter Options -->
            <div class="filter-options">
                <button class="filter-btn active" onclick="filterRewards('all')">All</button>
                <button class="filter-btn" onclick="filterRewards('ticket')">Ticket</button>
                <button class="filter-btn" onclick="filterRewards('food')">Food and Beverage</button>
            </div>

            <!-- Rewards List -->
            <div class="reward-list">
                <div class="reward-item" data-category="ticket"
                     onclick="openRewardDetail('Reward Title 1', 'Description of Reward 1', 'More details here...')">
                    <img src="<?= ROOT ?>/assets/images/movie.webp" alt="Reward 1">
                    <div class="reward-details">
                        <h3>Reward Title 1</h3>
                        <p>Description of reward 1 goes here. This could include details about how to earn or
                            redeem this reward.
                        </p>
                        <button class="btn-redeem">Redeem</button>
                    </div>
                </div>
                <div class="reward-item" data-category="food"
                     onclick="openRewardDetail('Reward Title 1', 'Description of Reward 1', 'More details here...')">
                    <img src="<?= ROOT ?>/assets/images/movie.webp" alt="Reward 2">
                    <div class="reward-details">
                        <h3>Reward Title 2</h3>
                        <p>Description of reward 2 goes here. This could include details about how to earn or
                            redeem this reward.
                        </p>
                        <button class="btn-redeem">Redeem</button>
                    </div>
                </div>
                <!-- Add more reward items with appropriate data-category as needed -->
            </div>
        </div>
    </div>

    <!-- Reward Detail Modal -->
    <div id="reward-detail-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeRewardDetail()">&times;</span>
            <h2 id="reward-title">Reward Title</h2>
            <p id="reward-description">Description of the reward goes here.</p>
            <p id="reward-details">Additional details about the reward go here.</p>
        </div>
    </div>

    <!--End of Main Contents-->


    <?php include '../app/views/footer.php' ?>

    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function filterRewards(category) {
            // Remove active class from all filter buttons
            var filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(function (button) {
                button.classList.remove('active');
            });

            // Add active class to the clicked button
            document.querySelector(`.filter-btn[onclick="filterRewards('${category}')"]`).classList.add('active');

            // Show or hide rewards based on the category
            var rewards = document.querySelectorAll('.reward-item');
            rewards.forEach(function (reward) {
                if (category === 'all' || reward.getAttribute('data-category') === category) {
                    reward.style.display = 'flex'; // Show matching rewards
                } else {
                    reward.style.display = 'none'; // Hide non-matching rewards
                }
            });
        }

        // Initialize to show all rewards on page load
        filterRewards('all');

        function openRewardDetail(title, description, details) {
            // Set the modal content
            document.getElementById('reward-title').textContent = title;
            document.getElementById('reward-description').textContent = description;
            document.getElementById('reward-details').textContent = details;

            // Display the modal
            document.getElementById('reward-detail-modal').style.display = 'block';
        }

        function closeRewardDetail() {
            // Hide the modal
            document.getElementById('reward-detail-modal').style.display = 'none';
        }

        // Close the modal when clicking outside of the modal content
        window.onclick = function (event) {
            const modal = document.getElementById('reward-detail-modal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>

</html>