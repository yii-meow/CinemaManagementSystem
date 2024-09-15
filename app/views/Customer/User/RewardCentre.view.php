<!DOCTYPE html>
<html lang="en">

<?php include '../app/views/user_header.php' ?>
<style>
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        align-content: center;
    }

    .modal-content {
        background-color: #fefefe;
        color: black;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .reward-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .reward-header h2 {
        text-align: center;
        margin: 0;
        padding: 10px 0;
    }

    .reward-header img {
        margin-top: 10px;
    }

    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<body>

<?php
if (isset($data['user']) && isset($data['rewards'])) {
    $user = $data['user'];
    $rewards = $data['rewards'];
    $rewardCount = $data['rewardCount'];
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
                                <button class="btn-redeem" data-reward-id="<?= $reward->getRewardId() ?>">Redeem</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div id="reward-detail-modal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeRewardDetail()">&times;</span>

                <!-- Add a container for centering title and image -->
                <div class="reward-header">
                    <h2 id="reward-title">Reward Title</h2>
                    <img id="reward-img" src="" alt="Reward Image" style="width:100px; height:auto;">
                </div>

                <p id="reward-category">Category: </p>
                <p id="reward-description">Description of the reward goes here.</p>
                <p id="reward-details">Additional details about the reward go here.</p>
                <p id="reward-qty">Quantity: </p>
                <p id="reward-needed-coins">Needed Coins: </p>
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

    document.querySelectorAll('.btn-redeem').forEach(function (button) {
        button.addEventListener('click', function (event) {
            // Stop the click event from propagating to the parent element (reward item)
            event.stopPropagation();

            const rewardId = this.getAttribute('data-reward-id');

            // Make an AJAX request to redeem the reward
            fetch('<?= ROOT ?>/RewardCentre/redeemReward/' + rewardId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Reward redeemed successfully');
                        location.reload(); // Reload the page to update the reward list and user coins
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>

</body>

</html>