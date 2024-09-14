<!DOCTYPE html>
<html lang="en">

<?php include '../app/views/user_header.php' ?>


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
        <?php include '../app/views/ProfileNav.php' ?>


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