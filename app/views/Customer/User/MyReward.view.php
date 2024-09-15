<!DOCTYPE html>
<html lang="en">
<?php include '../app/views/user_header.php' ?>

<body>

<?php
// Ensure that $data['user'] is set and assign it to $user
if (isset($data['user'])) {
$user = $data['user'];
$userRewards = $data['userRewards']; // Array of user rewards
$rewardCount = $data['rewardCount'];
?>
<div id="Customer">
    <?php include '../app/views/header.php' ?>
    <?php include '../app/views/navigationBar.php' ?>
    <div class="outer-box">
        <div class="main-title">
            User Profile
        </div>
        <!-- Left Sidebar -->
        <?php include '../app/views/ProfileNav.php' ?>
        <!-- Right Content -->
        <div class="right-box">
            <h2>My Reward</h2>
            <div class="filter-options">
                <button class="filter-btn active" onclick="filterRewards('all')">All</button>
                <button class="filter-btn" onclick="filterRewards('Ticket')">Ticket</button>
                <button class="filter-btn" onclick="filterRewards('Food&Beverage')">Food and Beverage</button>
            </div>
            <!-- Redeemed Rewards List -->
            <div class="redeemed-reward-list">
                <?php foreach ($userRewards as $reward): ?>
                    <div class="redeemed-reward-item" data-category="<?= htmlspecialchars($reward['category']) ?>">
                        <img src="<?= ROOT ?>/assets/images/<?= !empty($reward['rewardImg']) ? htmlspecialchars($reward['rewardImg']) : 'default.jpg' ?>" alt="<?= htmlspecialchars($reward['rewardTitle']) ?>">
                        <div class="redeemed-reward-details">
                            <h3><?= htmlspecialchars($reward['rewardTitle']) ?></h3>
                            <p><?= htmlspecialchars($reward['description']) ?></p>
                            <p class="redeem-date">Redeemed on: <?= htmlspecialchars($reward['redeemDate']->format('F j, Y')) ?></p>
                        </div>
                        <!-- Used Label -->
                        <?php if ($reward['status'] === 'Used'): ?>
                            <div class="used-label">Used</div>
                        <?php else: ?>
                            <div class="used-label">Unused</div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php include '../app/views/footer.php' ?>
    <?php
    } else {
        echo "User data not available";
        exit();
    }
    ?>
    <!-- JavaScripts -->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function filterRewards(category) {
            var filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(function (button) {
                button.classList.remove('active');
            });
            document.querySelector(`.filter-btn[onclick="filterRewards('${category}')"]`).classList.add('active');
            var rewards = document.querySelectorAll('.redeemed-reward-item');
            rewards.forEach(function (reward) {
                if (category === 'all' || reward.getAttribute('data-category') === category) {
                    reward.style.display = 'flex';
                } else {
                    reward.style.display = 'none';
                }
            });
        }
        filterRewards('all');
    </script>
</body>
</html>