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
    <title>Register</title>
    <style>
        .form-group {
            position: relative;
        }

        .form-group .fa-eye, .form-group .fa-eye-slash {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>

<body>
<div id="Customer">

    <?php include '../app/views/header.php' ?>


    <?php include '../app/views/navigationBar.php' ?>


    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Register</h1>
                    <nav class="d-flex align-items-center">
                        <a href="Login">Login<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Register</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Registration Box Area =================-->
    <section class="login_box_area section_gap" style="background-color: #141414;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto" style="background-color: #ffffff;border-radius:10%;height: auto;">
                    <div class="login_form_inner" style="width: auto;height: auto">
                        <h3>Register Account</h3>
                        <?php if (isset($data['success'])): ?>
                            <div class="alert alert-success"><?= htmlspecialchars($data['success']) ?></div>
                        <?php endif; ?>

                        <?php if (isset($data['error'])): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($data['error']) ?></div>
                        <?php endif; ?>

                        <form class="row login_form" action="Register" method="post" id="contactForm">
                            <!-- Username -->
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Username" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Username'" pattern="^[a-zA-Z0-9_]{3,20}$" title="Username must be 3-20 characters and can only contain letters, numbers, and underscores." required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Email'" required>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-12 form-group">
                                <input type="tel" class="form-control" id="phoneNo" name="phoneNo"
                                       placeholder="Contact Number" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Contact Number'" pattern="^\d{10,15}$" title="Phone number must be between 10 and 15 digits." required>
                            </div>

                            <!-- Password -->
                            <div class="col-md-12 form-group">
                                <input type="password" minlength="6" class="form-control" id="password"
                                       name="password" placeholder="Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Password'"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}"
                                       title="Password must be at least 6 characters long, contain at least one uppercase letter, one lowercase letter, one digit, and one special character." required>
                                <i class="fa fa-eye" id="togglePassword"></i>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-12 form-group">
                                <input type="password" minlength="6" class="form-control" id="cpassword"
                                       name="cpassword" placeholder="Confirm Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Confirm Password'" required>
                                <i class="fa fa-eye" id="toggleCPassword"></i>
                            </div>

                            <!-- Birthday -->
                            <div class="col-md-12 form-group">
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                       placeholder="Date of Birth" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Date of Birth'" required>
                            </div>

                            <!-- Gender -->
                            <div class="col-md-12 form-group" style="margin-bottom: 30px;text-align: left;">
                                <label for="gender" style="margin-right: 30px;">Gender:</label>
                                <input type="radio" id="female" name="gender" value="Female" required>
                                <label for="female" style="margin-right: 30px;">Female</label>
                                <input type="radio" id="male" name="gender" value="Male" required>
                                <label for="male">Male</label>
                            </div>

                            <div class="col-md-12 form-group" style="margin-bottom: 20px">
                                <button type="submit" value="submit" class="primary-btn">Register</button>
                                <a href="Login">Go Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Registration Box Area =================-->

    <?php include '../app/views/footer.php' ?>

    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Show/Hide Password Script -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggleCPassword').addEventListener('click', function () {
            const confirmPassword = document.getElementById('cpassword');
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>