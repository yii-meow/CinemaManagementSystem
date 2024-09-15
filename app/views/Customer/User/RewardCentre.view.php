<!DOCTYPE html>
<html lang="en">

<?php include '../app/views/user_header.php' ?>

<body>

<?php
if (isset($data['user']) && isset($data['rewards'])) {
    $user = $data['user'];
    $rewards = $data['rewards'];
    ?>

    <div id="Customer">

        <?php include '../app/views/header.php' ?>
        <?php include '../app/views/navigationBar.php' ?>

        <div class="outer-box">
            <div class="main-title">User Profile</div>

            <?php include '../app/views/ProfileNav.php' ?>

            <div class="right-box">
                <h2>Reward Centre</h2>

                <div class="filter-options">
                    <button class="filter-btn active" onclick="filterRewards('all')">All</button>
                    <button class="filter-btn" onclick="filterRewards('Ticket')">Ticket</button>
                    <button class="filter-btn" onclick="filterRewards('Food&Beverage')">Food and Beverage</button>
                </div>

                <!-- Rewards List -->
                <div class="reward-list">
                    <?php foreach ($rewards as $reward): ?>
                        <div class="reward-item" data-category="<?= $reward->getCategory() ?>"
                             onclick="openRewardDetail('<?= $reward->getRewardTitle() ?>', '<?= $reward->getDescription() ?>', '<?= $reward->getDetails() ?>')">
                            <img src="<?= ROOT ?>/assets/images/<?= $reward->getRewardImg() ?>" alt="<?= $reward->getRewardTitle() ?>">
                            <div class="reward-details">
                                <h3><?= $reward->getRewardTitle() ?></h3>
                                <p><?= $reward->getDescription() ?></p>
                                <button class="btn-redeem">Redeem</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div id="reward-detail-modal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeRewardDetail()">&times;</span>
                <h2 id="reward-title">Reward Title</h2>
                <p id="reward-description">Description of the reward goes here.</p>
                <p id="reward-details">Additional details about the reward go here.</p>
            </div>
        </div>

        <?php include '../app/views/footer.php' ?>
    </div>

    <?php
} else {
    echo "User or reward data not available.";
    exit();
}
?>

<script>
    function filterRewards(category) {
        var filterButtons = document.querySelectorAll('.filter-btn');
        filterButtons.forEach(function (button) {
            button.classList.remove('active');
        });
        document.querySelector(`.filter-btn[onclick="filterRewards('${category}')"]`).classList.add('active');

        var rewards = document.querySelectorAll('.reward-item');
        rewards.forEach(function (reward) {
            if (category === 'all' || reward.getAttribute('data-category') === category) {
                reward.style.display = 'flex';
            } else {
                reward.style.display = 'none';
            }
        });
    }

    filterRewards('all');

    function openRewardDetail(title, description, details) {
        document.getElementById('reward-title').textContent = title;
        document.getElementById('reward-description').textContent = description;
        document.getElementById('reward-details').textContent = details;
        document.getElementById('reward-detail-modal').style.display = 'block';
    }

    function closeRewardDetail() {
        document.getElementById('reward-detail-modal').style.display = 'none';
    }

    window.onclick = function (event) {
        const modal = document.getElementById('reward-detail-modal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
</script>

</body>

</html>