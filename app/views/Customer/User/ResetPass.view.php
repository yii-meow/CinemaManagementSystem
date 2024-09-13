<!DOCTYPE html>
<html lang="en">
<html lang="zxx" class="no-js">

<head>
    <meta charset="UTF-8">
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
    <title>Categories</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
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
                    <h1>Reset Password</h1>
                    <nav class="d-flex align-items-center">
                        <a href="login.html">Login/Register<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Reset Password</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Forgot Password Box Area =================-->
    <section class="login_box_area section_gap" style="background-color:#141414;">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 mx-auto" style="background-color: white;border-radius:10%;">
                    <div class="login_form_inner">
                        <br>
                        <br>
                        <br>
                        <h3>Reset Password</h3>
                        <form class="row login_form" action="ForgotPasswordCustomerController" method="post"
                              id="contactForm" novalidate="novalidate">
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="New Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'New Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="cpassword" name="cpassword"
                                       placeholder="Confirm Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Confirm Password'">
                                <br>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Change
                                    Password</button>

                            </div>
                            <div class="col-md-12 form-group">
                                <a href="Login">Go Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Forgot Password Box Area =================-->


    <?php include '../app/views/footer.php' ?>



    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>