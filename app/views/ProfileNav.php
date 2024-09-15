<div class="left-box">
    <div class="profile-card">
        <img src="<?= ROOT ?>/assets/images/<?= !empty($user['profileImg']) ? htmlspecialchars($user['profileImg']) : 'profile4.jpg' ?>"
             alt="Profile Picture" class="user-image">
        <p class="user-name"><?= htmlspecialchars($user['userName']) ?></p>
        <button class="edit-profile-btn" onclick="window.location.href='ProfileEdit'">Edit Profile</button>
        <div class="reward-info">
            <div class="reward-item-info">
                <p>Coins</p>
                <p><?= htmlspecialchars($user['coins']) ?></p>
            </div>
            <div class="reward-item-info">
                <p>My Rewards</p>
                <p><?= htmlspecialchars($rewardCount) ?></p>
            </div>
        </div>
    </div>
    <div class="nav-menu">
        <a href="#">My Tickets</a>
        <a href="MyReward">My Rewards</a>
        <a href="RewardCentre">Rewards Centre</a>
        <a href="ChangePass">Change Password</a>
        <a href="#">Delete Account</a>
    </div>
</div>