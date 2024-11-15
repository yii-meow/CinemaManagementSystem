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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css" />
    <title>Login Staff</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
    <style>
        /* Wrapper for the password input and icon */
        .password-group {
            position: relative;
        }

        .password-group input {
            padding-right: 40px; /* Add space for the eye icon */
        }

        .password-group .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px; /* Position the eye icon inside the input box */
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #777;
        }
    </style>
</head>

<body>

<body>
<div id="Customer">

    <?php include '../app/views/header.php' ?>


    <?php include '../app/views/navigationBar.php' ?>


    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb" style="background-color: #141414;">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Login Staff</h1>

                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Login Box Area =================-->
    <section class="login_box_area section_gap" style="background-color: #141414;">
        <div class="container" style="background-color: white;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="<?= ROOT ?>/assets/images/loginBack.jpg" alt="">
                        <div class="hover">
                            <h4>Login Staff</h4>
                            <p>Here is the place for Staff login</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <br>
                        <br>
                        <br>
                        <h3>Log in to enter</h3>
                        <?php if (isset($data['error'])): ?>
                            <div style="width: fit-content; margin: auto;" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?= htmlspecialchars($data['error']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <form class="row login_form" action="Login" method="post" id="contactForm">
                            <div class="col-md-12 form-group">
                                <input type="tel" class="form-control" id="phoneNo" name="phoneNo"
                                       placeholder="Mobile Number" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Mobile Number'"
                                       pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" required>
                            </div>
                            <div class="col-md-12 form-group password-group">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Password'"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                                       title="Password must be at least 6 characters long and include at least one number, one uppercase letter, and one lowercase letter." required>
                                <span class="fa fa-eye password-toggle" onclick="togglePassword()"></span>
                            </div>
                            <br>
                            <br>
                            <br>
                            <input type="hidden" name="userType" value="admin">
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->


    <?php include '../app/views/footer.php' ?>


    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.querySelector('.password-toggle');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>