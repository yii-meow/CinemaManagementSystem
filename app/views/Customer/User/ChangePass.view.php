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
            <h2>Change Password</h2>
            <form>
                <div class="form-group">
                    <label for="currentPass">Current Password</label>
                    <input type="text" id="currentPass" value="" />
                </div>
                <div class="form-group">
                    <label for="newPass">New Password</label>
                    <input type="text" id="newPass" value="" />
                </div>
                <div class="form-group">
                    <label for="confirmPass">Confirm Password</label>
                    <input type="email" id="confirmPass" value="" />
                </div>
                <button type="submit" style="width: 20%;" class="btn-save">Confirm</button>
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