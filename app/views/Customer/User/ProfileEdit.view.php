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
                <button class="edit-profile-btn" onclick="window.location.href='ProfileEdit'" style="background-color: whitesmoke;color: black">Edit
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
                <a href="MyReward">My Rewards</a>
                <a href="RewardCentre">Rewards Centre</a>
                <a href="ChangePass">Change Password</a>
                <a href="#">Delete Account</a>
            </div>
        </div>

        <!-- Right Content -->
        <div class="right-box">
            <h2>Edit Profile</h2>
            <form action="ProfileEdit" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" value="<?= htmlspecialchars($user->userName) ?>" />
                </div>
                <div class="form-group">
                    <label for="mobileNumber">Mobile Number</label>
                    <input type="text" id="mobileNumber" name="mobileNumber" value="<?= htmlspecialchars($user->phoneNo) ?>" />
                </div>
                <div class="form-group">
                    <label for="emailAddress">Email Address</label>
                    <input type="email" id="emailAddress" name="emailAddress" value="<?= htmlspecialchars($user->email) ?>" />
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" value="male" <?= $user->gender == 'M' ? 'checked' : '' ?>>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female" <?= $user->gender == 'F' ? 'checked' : '' ?>>
                        <label for="female">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" id="dob" value="<?= htmlspecialchars($user->birthDate) ?>" disabled />
                    <input type="hidden" name="existingProfileImg" value="<?= htmlspecialchars($user->profileImg) ?>" />
                </div>
                <div class="form-group">
                    <label for="profileImg">Profile Image</label>
                    <input type="file" id="profileImg" name="profileImg" />
                </div>
                <button type="submit" style="width: 20%;" class="btn-save">Save</button>
            </form>
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