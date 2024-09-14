<!DOCTYPE html>
<html lang="en">

<?php include '../app/views/user_header.php' ?>


<body>

<div id="Customer">

    <?php
    // Ensure that $data['user'] is set and assign it to $user
    if (isset($data['user'])) {
        $user = $data['user'];
        ?>
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
            <h2>Profile Details</h2>
            <form>
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" value="<?= htmlspecialchars($user['userName']) ?>" disabled/>
                </div>
                <div class="form-group">
                    <label for="mobileNumber">Mobile Number</label>
                    <input type="text" id="mobileNumber" value="<?= htmlspecialchars($user['phoneNo']) ?>" disabled/>
                </div>
                <div class="form-group">
                    <label for="emailAddress">Email Address</label>
                    <input type="email" id="emailAddress" value="<?= htmlspecialchars($user['email']) ?>" disabled/>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" value="male" <?= $user['gender'] == 'M' ? 'checked' : '' ?>>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female" <?= $user['gender'] == 'F' ? 'checked' : '' ?>>
                        <label for="female">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" id="dob" value="<?= htmlspecialchars($user['birthDate']) ?>" disabled />
                    <br>
                    <p class="note">* It cannot be changed after submission.</p>
                </div>
                <br>
                <br>
                <br>
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