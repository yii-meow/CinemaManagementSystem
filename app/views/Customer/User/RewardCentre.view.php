<!DOCTYPE html>
<html lang="en">

<?php include '../app/views/user_header.php' ?>


<style>
    /* Center the reward header (title and image) */
    .reward-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .reward-header h2 {
        margin-bottom: 10px;
    }

    .reward-header img {
        max-width: 100px;
        height: auto;
    }
</style>
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
                             data-reward-id="<?= $reward->getRewardId() ?>"
                             onclick="openRewardDetail(
                                     '<?= $reward->getRewardTitle() ?>',
                                     '<?= $reward->getCategory() ?>',
                                     '<?= $reward->getDescription() ?>',
                                     '<?= $reward->getDetails() ?>',
                                     '<?= $reward->getQty() ?>',
                                     '<?= $reward->getNeededCoins() ?>',
                                     '<?= ROOT ?>/assets/images/<?= $reward->getRewardImg() ?>'
                                     )">
                            <img src="<?= ROOT ?>/assets/images/<?= $reward->getRewardImg() ?>" alt="<?= $reward->getRewardTitle() ?>">
                            <div class="reward-details">
                                <h3><?= $reward->getRewardTitle() ?></h3>
                                <p><?= $reward->getDescription() ?></p>
                                <p>Quantity: <?= $reward->getQty() ?></p>
                                <p>Needed Coins: <?= $reward->getNeededCoins() ?></p>
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

                <!-- Centered reward header with title and image -->
                <div class="reward-header">
                    <h2 id="reward-title">Reward Title</h2>
                    <img id="reward-img" src="" alt="Reward Image">
                </div>

                <p id="reward-category">Category: </p>
                <p id="reward-description">Description of the reward goes here.</p>
                <p id="reward-details">Additional details about the reward go here.</p>
                <p id="reward-qty">Quantity: </p>
                <p id="reward-needed-coins">Needed Coins: </p>
            </div>
        </div>

        <?php include '../app/views/footer.php' ?>

    <?php
} else {
    echo "User or reward data not available.";
    exit();
}
?>
    </div>

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

    function redeemReward(event, rewardId) {
        event.stopPropagation(); // Prevent the click event from propagating to parent elements
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "RewardCentre/redeemReward/", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                location.reload(); // Reload the page to reflect changes
            } else {
                alert("Error redeeming reward.");
            }
        };
        xhr.send("rewardId=" + rewardId);
    }

    document.querySelectorAll('.btn-redeem').forEach(function(button) {
        button.addEventListener('click', function(event) {
            var rewardId = this.closest('.reward-item').dataset.rewardId;
            redeemReward(event, rewardId); // Pass the event to redeemReward
        });
    });

    function openRewardDetail(title, category, description, details, qty, neededCoins, imgSrc) {
        document.getElementById('reward-title').textContent = title;
        document.getElementById('reward-category').textContent = 'Category: ' + category;
        document.getElementById('reward-description').textContent = 'Description: ' + description;
        document.getElementById('reward-details').textContent = 'Details: ' + details;
        document.getElementById('reward-qty').textContent = 'Quantity: ' + qty;
        document.getElementById('reward-needed-coins').textContent = 'Needed Coins: ' + neededCoins;
        document.getElementById('reward-img').src = imgSrc;

        // Display the modal
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