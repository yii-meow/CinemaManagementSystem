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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css" />
    <title>Categories</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<body>
<div id="Customer">

    <!--Header-->
    <div class="header" id="header">

        <div class="binder">


            <div style="margin-left: 20px;" class="business-icon">
                <div
                    style="color: white; height: inherit; text-align: center; font-weight: bold; font-size: 20px;">
                    <img src="<?= ROOT ?>/assets/images/alternativeIcon.png" draggable="false" width="200" height="55" />
                </div>
            </div>




            <div class="search-ctn col-7" style="margin-top: auto; margin-bottom: auto;">
                <div class="search-ctn input-group"
                     style="display: flex; flex-flow: row nowrap; min-width: 100%;" role="search">
                    <div class="s-box col-11">
                        <input type="text" autocomplete="off"
                               style="outline:2px solid #f03351; color: #f03351; position: relative; border-bottom-right-radius: 0px; border-top-right-radius: 0px;"
                               id="txtSearch" class="form-control border border-1 search-bar"
                               placeholder="Movie Title" />
                    </div>
                    <div>
                        <button id="btnSch"
                                style="background-color: #141414; width: fit-content; border-bottom-left-radius: 0px; border-top-left-radius: 0px; border-color: #f03351; height: 41px; margin-top: -2px;"
                                class="btn-light btn btn-search">
                            <i style="color: #f03351; font-size: 18px; display: flex; justify-content: center; align-items: center; margin-top: 4.5px; height: 18px;"
                               class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>




        <div class="right-header">

            <div class="action-group" style="display: flex; flex-flow: row nowrap;">


                <div class="nofitication-cont">
                    <div>
                        <i onclick="openMessage()"
                           style="cursor: pointer; position: relative; top: 0; color: white; font-size: 28px;"
                           class="fa-regular fa-bell" id="bell"></i>
                        <div runat="server" ID="REDDOT"
                             style="position: absolute; top: 0; right: 0; border-radius: 100px; background-color: #ff2b2b; height: 11px; width: 11px;">
                        </div>
                    </div>

                    <div class="messages">
                        <ul id="dropdownMessage" tabindex="-1" class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                abcde
                            </li>
                        </ul>
                    </div>
                </div>



                <div class="profile-container action" id="profile">
                    <div style="margin-top: auto; margin-bottom: auto;">
                        <button onclick="window.location.href='Profile'" class="btn header-font"
                                style="padding:10px; width: 160px; font-size: 17px; display: flex; color: #f03351;">
                            <div
                                style="margin-top: -3px; border-radius: 150px; width: 30px; height: 30px; overflow: hidden;">
                                <img src="<?= ROOT ?>/assets/images/defaultProfile.jpg" draggable="false"
                                     style="background-color: white; border-radius: 100px; width: 30px; height: 30px;"
                                     id="topImage" />
                            </div>
                            &nbsp;
                            User Profile
                        </button>
                    </div>
                </div>

                <div class="login action" style="margin-right: 20px;">
                    <div style="margin-top: auto; margin-bottom: auto;">
                        <button ID="btnLgn" class="topBtns btn dropdown-toggle header-font"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                Style="font-size: 17px; color:#f03351">
                            <i style="color: #f03351; font-size:18px"
                               class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;
                            Login
                        </button>
                        <ul class="dropdown-menu">
                            <li id="userlogin">
                                <a href="login.html" id="hrefCustomer"
                                   class="dropdown-item LoginHover">Customer</a>
                            </li>
                            <li id="stafflogin">
                                <a id="hrefStaff" href="loginStaff.html"
                                   class="dropdown-item LoginHover">Staff</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!--Navigation Bar-->
    <div class="dropdowns" style="display: flex; flex-flow: row nowrap;">
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                NEW MOVIES
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">New Action</a></li>
                <li><a class="dropdown-item" href="">New Horror</a></li>
                <li><a class="dropdown-item" href="">New Animation</a></li>
                <li><a class="dropdown-item" href="">New Romance</a></li>
            </ul>
        </div>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                ACTION
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Superhero</a></li>
                <li><a class="dropdown-item" href="">War</a></li>
                <li><a class="dropdown-item" href="">Adventure</a></li>
            </ul>
        </div>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                HORROR
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Supernatural Horror</a></li>
                <li><a class="dropdown-item" href="">Zombie</a></li>
            </ul>
        </div>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                ANIMATION
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">2D Animation</a></li>
                <li><a class="dropdown-item" href="">3D Animation</a></li>
                <li><a class="dropdown-item" href="">Anime</a></li>
            </ul>
        </div>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                ROMANCE
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Romantic Comedy</a></li>
                <li><a class="dropdown-item" href="">Romantic Drama</a></li>
            </ul>
        </div>
        <ul class="nav-item dropdown">
            <button class="btn dropbtn" type="button" aria-expanded="false">
                <a href="" style="text-decoration: none;"> NOW SHOWING</a>
            </button>
        </ul>
        <ul class="nav-item dropdown">
            <button class="btn dropbtn" type="button" aria-expanded="false">
                <a href="" style="text-decoration: none;"> COMING SOON</a>
            </button>
        </ul>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                FORUM
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/Forum/Forum.html">Community Forum</a></li>
                <li><a class="dropdown-item" href="/Forum/AddPost.html">Create Post</a></li>
                <li><a class="dropdown-item" href="/Forum/MyPost.html">My Post</a></li>
                <li><a class="dropdown-item" href="/Forum/LikedPost.html">Liked Post</a></li>
            </ul>
        </div>
    </div>


    <!--Main Contents-->

    <div class="outer-box">
        <div class="main-title">
            User Profile
        </div>
        <!-- Left Sidebar -->
        <div class="left-box">
            <div class="profile-card">
                <div class="user-initial">K</div>
                <p class="user-name">Kyan</p>
                <button class="edit-profile-btn" onclick="window.location.href='ProfileEdit'">Edit
                    Profile</button>
                <div class="reward-info">
                    <div class="reward-item-info">
                        <p>Coins</p>
                        <p>0</p>
                    </div>
                    <div class="reward-item-info">
                        <p>My Rewards</p>
                        <p>0</p>
                    </div>
                </div>
            </div>

            <div class="nav-menu">
                <a href="#">My Tickets</a>
                <a href="#">My Rewards</a>
                <a href="RewardCentre">Rewards Centre</a>
                <a href="Favourite">Favourite</a>
                <a href="ChangePass">Change Password</a>
                <a href="#">Delete Account</a>
            </div>
        </div>

        <!-- Right Content -->
        <div class="right-box">
            <h2>My Reward</h2>

            <!-- Filter Options -->
            <div class="filter-options">
                <button class="filter-btn active" onclick="filterRewards('all')">All</button>
                <button class="filter-btn" onclick="filterRewards('ticket')">Ticket</button>
                <button class="filter-btn" onclick="filterRewards('food')">Food and Beverage</button>
            </div>

            <!-- Redeemed Rewards List -->
            <div class="redeemed-reward-list">
                <div class="redeemed-reward-item">
                    <img src="<?= ROOT ?>/assets/images/mainMovie_1.jpg" alt="Reward 1">
                    <div class="redeemed-reward-details">
                        <h3>Reward Title 1</h3>
                        <p>Description of the redeemed reward goes here. This could include details about what
                            the reward is for.
                        </p>
                        <p class="redeem-date">Redeemed on: August 29, 2024</p>
                    </div>
                    <!-- Used Label -->
                    <div class="used-label">Used</div>
                </div>
                <div class="redeemed-reward-item">
                    <img src="<?= ROOT ?>/assets/images/mainMovie_1.jpg" alt="Reward 2">
                    <div class="redeemed-reward-details">
                        <h3>Reward Title 2</h3>
                        <p>Description of the redeemed reward goes here. This could include details about what
                            the reward is for.
                        </p>
                        <p class="redeem-date">Redeemed on: August 30, 2024</p>
                    </div>
                </div>
                <!-- Add more redeemed reward items as needed -->
            </div>
        </div>
    </div>

    <!--End of Main Contents-->


    <!--Footer-->
    <footer id="footer">
        <div class="footer-container container-fluid">
            <div class="bottom" style="text-align: center; color: white;">
                © 2023 - 2024 DreamWorks Cinema (Copyright All Right Reserved)
            </div>
        </div>
    </footer>




    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>