<div class="left-box">
    <div class="profile-card">
        <img src="<?= ROOT ?>/assets/images/<?= !empty($user['profileImg']) ? htmlspecialchars($user['profileImg']) : 'profile4.jpg' ?>"
             alt="Profile Picture" class="user-image">
        <p class="user-name"><?= htmlspecialchars($user['userName']) ?></p>
        <button class="edit-profile-btn" onclick="window.location.href='ProfileEdit'">Edit Profile</button>
        <div class="reward-info">
            <div class="reward-item-info" style="width: 100%">
                <p>Coins</p>
                <p><?= htmlspecialchars($user['coins']) ?></p>
            </div>
        </div>
    </div>
    <div class="nav-menu">
        <a href=<?=ROOT?>/PurchaseHistory>My Tickets</a>
        <a href="MyReward">My Rewards</a>
        <a href="RewardCentre">Rewards Centre</a>
        <a href="ChangePass">Change Password</a>
    </div>
</div>