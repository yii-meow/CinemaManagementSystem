<!DOCTYPE html>
<html lang="en">

<?php include '../app/views/user_header.php' ?>


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
                        <h3>Register account</h3>
                        <?php if (isset($data['success'])): ?>
                            <div class="alert alert-success"><?= htmlspecialchars($data['success']) ?></div>
                        <?php endif; ?>

                        <?php if (isset($data['error'])): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($data['error']) ?></div>
                        <?php endif; ?>
                        <form class="row login_form" action="Register" method="post"
                              id="contactForm">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Username" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Username'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Email'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="tel" class="form-control"
                                       id="phoneNo" name="phoneNo" placeholder="Contact Number"
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Contact Number'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" minlength="8" class="form-control" id="password"
                                       name="password" placeholder="Password" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" minlength="8" class="form-control" id="cpassword"
                                       name="cpassword" placeholder="Confirm Password"
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Confirm Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                       placeholder="Date of Birth" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Date of Birth'">
                            </div>
                            <div class="col-md-12 form-group" style="margin-bottom: 30px;text-align: left;">
                                <label for="gender" style="margin-right: 30px;">Gender:</label>
                                <input type="radio" id="female" name="gender" value="Female">
                                <label for="female" style="margin-right: 30px;">Female</label>
                                <input type="radio" id="male" name="gender" value="Male">
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

</body>

</html>