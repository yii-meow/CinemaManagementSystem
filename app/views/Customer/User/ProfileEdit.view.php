<!--
Author: Chong Kah Yan
-->
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
            <h2>Edit Profile</h2>
            <?php if (isset($data['error']) && !empty($data['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($data['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($data['success']) && !empty($data['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($data['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form id="editProfileForm" action="ProfileEdit" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="userName">Full Name</label>
                    <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($user['userName']) ?>" required />
                </div>
                <div class="form-group">
                    <label for="phoneNo">Mobile Number</label>
                    <input type="text" id="phoneNo" name="phoneNo" value="<?= htmlspecialchars($user['phoneNo']) ?>" required />
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required />
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" value="M" <?= $user['gender'] == 'M' ? 'checked' : '' ?>>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="F" <?= $user['gender'] == 'F' ? 'checked' : '' ?>>
                        <label for="female">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthDate">Date of Birth</label>
                    <input type="text" id="birthDate" name="birthDate" value="<?= htmlspecialchars($user['birthDate']) ?>" disabled />
                    <br>
                    <p class="note">* It cannot be changed after submission.</p>
                </div>
                <div class="form-group">
                    <label for="profileImg">Profile Image</label>
                    <input type="file" id="profileImg" name="profileImg" />
                    <input type="hidden" name="existingProfileImg" value="<?= htmlspecialchars($user['profileImg']) ?>" />
                </div>
                <button type="submit" class="btn-save" style="width: 150px">Save</button>
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