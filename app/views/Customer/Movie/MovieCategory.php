<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="../../../../public/css/reset.css" />

    <link rel="stylesheet" href="../../../../public/css/Main.css" />
    <link rel="stylesheet" href="../../../../public/css/MovieCategory.css" />
    <title>Categories</title>

    <link rel="icon" type="image/x-icon" href="../../../../public/images/icon.png">
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
                            <img src="../../../../public/images/alternativeIcon.png" draggable="false" width="200" height="55" />
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
                                <button onclick="" class="btn header-font"
                                    style="padding:10px; width: 160px; font-size: 17px; display: flex; color: #f03351;">
                                    <div
                                        style="margin-top: -3px; border-radius: 150px; width: 30px; height: 30px; overflow: hidden;">
                                        <img src="../../../../public/images/defaultProfile.jpg" draggable="false"
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
                                        <a href="" id="hrefCustomer" class="dropdown-item LoginHover">Customer</a>
                                    </li>
                                    <li id="stafflogin">
                                        <a id="hrefStaff" href="" class="dropdown-item LoginHover">Staff</a>
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

            <div class="box">
                <!-- <div class="header-cont">
                    <div class="header-tt">
                        ACTION
                    </div>
                </div> -->

                <div class="content">

                    <div class="left" id="left">
                        <button onclick="hide()" id="btnOpen" class="openCloseBtn" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                            aria-controls="offcanvasScrolling"><i class='fas fa-chevron-right'></i></button>

                        <div class="offcanvas offcanvas-start show" data-bs-scroll="true" data-bs-backdrop="false"
                            tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header" id="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Filter</h5>
                                <button onclick="show()" id="btnHide" class="button" type="button"
                                    data-bs-dismiss="offcanvas" aria-label="Close"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>
                            <div class="offcanvas-body" id="offcanvas-body">
                                <div class="status-selector"
                                    style="border-top: 1px solid #f78396; padding-top: 15px; border-bottom: 1px solid #f78396; padding-bottom: 15px;">
                                    <div class="title-selector">
                                        By Status
                                    </div>
                                    <div class="form-check" id="collpaseStatus" style="margin-top: 15px;">
                                        <input checked type="radio" id="all" name="status" value="all">
                                        <label for="cs">All</label><br><br />
                                        <input type="radio" id="ns" name="status" value="ns">
                                        <label for="ns">Now Showing</label><br>
                                        <br />
                                        <input type="radio" id="cs" name="status" value="cs">
                                        <label for="cs">Coming Soon</label><br>
                                    </div>
                                </div>
                                <div class="manufacturer-selector"
                                    style="border-top: 1px solid #f78396; padding-top: 15px; border-bottom: 1px solid #f78396; padding-bottom: 15px;">
                                    <div class="title-selector">
                                        By Category
                                    </div>
                                    <div class="form-check" id="collapseManu">
                                        <div class="selection">
                                            <br />
                                            <input type="checkbox" id="manufacturer1" name="manufacturer"
                                                value="Manufacturer1">
                                            <label for="manufacturer1">Manufacturer 1</label><br>
                                            <br />
                                            <input type="checkbox" id="manufacturer2" name="manufacturer"
                                                value="Manufacturer2">
                                            <label for="manufacturer2">Manufacturer 2</label><br>
                                            <!-- Add more checkboxes as needed -->
                                        </div>
                                        <asp:Label runat="server" ID="onlyOneM" Visible="false"></asp:Label>
                                    </div>
                                </div>
                                <div class="series-selector"
                                    style="border-top: 1px solid #f78396; padding-top: 15px; border-bottom: 1px solid #f78396; padding-bottom: 15px;">
                                    <div class="title-selector">
                                        By Sub-category
                                    </div>
                                    <div class="form-check" id="collapseSeries">
                                        <div class="selection">
                                            <br />
                                            <input type="checkbox" id="manufacturer1" name="manufacturer"
                                                value="Manufacturer1">
                                            <label for="manufacturer1">Manufacturer 1</label><br>
                                            <br />
                                            <input type="checkbox" id="manufacturer2" name="manufacturer"
                                                value="Manufacturer2">
                                            <label for="manufacturer2">Manufacturer 2</label><br>
                                            <!-- Add more checkboxes as needed -->
                                        </div>
                                        <asp:Label runat="server" ID="onlyOneS" Visible="false"></asp:Label>
                                    </div>
                                </div>
                                <div class="clear-all" style="border-top: 1px solid #f78396; padding-top: 15px;">
                                    <asp:Button CssClass="btn clearall-btn" runat="server" ID="clearAll"
                                        Text="Clear All" OnClick="clearAll_Click" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <div class="header-tt">
                            ANIMATION
                        </div>
                        <div class="items-cont">
                            <div class="sort">
                                <div class="noOfResult">
                                    <p id="resultno">10 Results</p>
                                </div>
                                <div class="sort-cont">
                                    <div class="sort-title" style="margin-top:2px; color: #f04d67">
                                        Sort By
                                    </div>
                                    <div class="sort-list">
                                        <select class="list-item" id="ddlSort">
                                            <option selected>Default</option>
                                            <option value="1">a-Z</option>
                                            <option value="2">Z-a</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="item-container">
                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p class="movieName" name="movieName">BOCCHI THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                                <!--An Item-->
                                <div class="item">
                                    <div class="item-image">
                                        <img src="../../../../public/images/movie.webp" class="imgFigure" />
                                    </div>
                                    <div class="detail-cont">
                                        <div
                                            style="width: 100%; display: flex; margin-top: auto; margin-bottom: auto; justify-content: center;">
                                            <p name="movieName" class="movieName">BOCCHI THE ROCK! Recap Part 1BOCCHI
                                                THE ROCK! Recap Part 1BOCCHI THE ROCK! Recap Part 1BOCCHI
                                                THE ROCK! Recap Part 1
                                            </p>
                                        </div>
                                        <div class="item-view">
                                            <button onclick="location.href='MovieDetail.html'" class="btn destination"
                                                id="destination">
                                                <i class="fa-solid fa-circle-info"></i>&nbsp;View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--End of An Item-->

                            </div>
                        </div>
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

            <script type="text/javascript">
                function hide() {
                    document.getElementById("btnOpen").style.display = "none";
                    document.getElementById("offcanvasScrolling").style.maxWidth = "350px";
                    document.getElementById("offcanvas-header").style.display = "flex";
                    document.getElementById("offcanvas-body").style.display = "flex";
                }
                var myOffcanvas = document.getElementById('offcanvasScrolling')
                myOffcanvas.addEventListener('hidden.bs.offcanvas',
                    function () {
                        document.getElementById("btnOpen").style.display = "block";
                        document.getElementById("offcanvasScrolling").style.maxWidth = "0px";
                        document.getElementById("offcanvas-header").style.display = "none";
                        document.getElementById("offcanvas-body").style.display = "none";
                    })
            </script>

            <script type="text/javascript">
                function hide() {
                    document.getElementById("btnOpen").style.display = "none";
                    document.getElementById("offcanvasScrolling").style.maxWidth = "350px";
                    document.getElementById("offcanvas-header").style.display = "flex";
                    document.getElementById("offcanvas-body").style.display = "flex";
                }
                var myOffcanvas = document.getElementById('offcanvasScrolling')
                myOffcanvas.addEventListener('hidden.bs.offcanvas',
                    function () {
                        document.getElementById("btnOpen").style.display = "block";
                        document.getElementById("offcanvasScrolling").style.maxWidth = "0px";
                        document.getElementById("offcanvas-header").style.display = "none";
                        document.getElementById("offcanvas-body").style.display = "none";
                    })
            </script>
    </body>

</html>