<!--
Author: Chong Kah Yan
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css" />
    <title>Verify OTP</title>
    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>
<div id="Customer">

    <?php include '../app/views/header.php' ?>
    <?php include '../app/views/navigationBar.php' ?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Verify OTP</h1>
                    <nav class="d-flex align-items-center">
                        <a href="Login">Login/Register<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Verify OTP</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Verify OTP Box Area =================-->
    <section class="login_box_area section_gap" style="background-color: #141414;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto" style="background-color: white;border-radius:10%;">
                    <div class="login_form_inner">
                        <br>
                        <br>
                        <br>
                        <h3>Verify OTP</h3>

                        <!-- Display success message if it exists -->
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?= htmlspecialchars($_SESSION['success_message']); ?>
                            </div>
                            <?php unset($_SESSION['success_message']); // Clear message after displaying ?>
                        <?php endif; ?>

                        <!-- Display error message if it exists -->
                        <?php if (isset($error) && !empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form id="otpVerifyForm" class="row login_form" action="verifyOTP" method="post">
                            <div class="col-md-12 form-group">
                                <input type="tel" class="form-control" id="otpCode" name="otpCode"
                                       placeholder="Enter OTP Code" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Enter OTP Code'" required>
                                <br>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Verify</button>
                            </div>
                            <div id="responseMessage" class="col-md-12 form-group"></div>
                        </form>
                        <br>
                        <br>
                        <!-- Timer display -->
                        <p id="timer" style="color: red; font-size: 18px; font-weight: bold;"></p>

                        <!-- Request New OTP button (Initially hidden) -->
                        <form id="requestOtpForm" method="post" action="ForgetPassVerify" style="display: none;">
                            <button type="submit" class="btn btn-secondary">Request New OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Verify OTP Box Area =================-->

    <?php include '../app/views/footer.php' ?>

    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Set expiry time in seconds (e.g., 60 seconds for 1 minute)
        let expiryTime = <?= isset($_SESSION['otp_expiry']) ? $_SESSION['otp_expiry'] - time() : 0; ?>;

        // Function to start the countdown
        function startTimer() {
            const timerElement = document.getElementById('timer');
            const requestOtpForm = document.getElementById('requestOtpForm');
            let timer = expiryTime;

            const countdown = setInterval(function() {
                if (timer <= 0) {
                    clearInterval(countdown);
                    timerElement.innerHTML = 'OTP expired!';
                    requestOtpForm.style.display = 'block'; // Show the request OTP button
                } else {
                    const minutes = Math.floor(timer / 60);
                    const seconds = timer % 60;
                    timerElement.innerHTML = `OTP expires in ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                    timer--;
                }
            }, 1000);
        }

        // Start the timer when the page loads
        window.onload = startTimer;
    </script>

</body>

</html>