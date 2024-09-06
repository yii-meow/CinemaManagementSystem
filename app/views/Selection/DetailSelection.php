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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../../public/css/reset.css" />

    <link rel="stylesheet" href="../../../public/css/Main.css" />
    <link rel="stylesheet" href="../../../public/css/DetailSelection.css" />
    <title>Movie Detail Selection</title>

    <link rel="icon" type="image/x-icon" href="../../../public/images/icon.png">
</head>



<body>
    <!--Header-->
    <div class="header" id="header">

        <div class="binder">


            <div style="margin-left: 20px;" class="business-icon">
                <div style="color: white; height: inherit; text-align: center; font-weight: bold; font-size: 20px;">
                    <img src="../../../public/images/alternativeIcon.png" draggable="false" width="200" height="55" />
                </div>
            </div>

            <div class="search-ctn col-7" style="margin-top: auto; margin-bottom: auto;">
                <div class="search-ctn input-group" style="display: flex; flex-flow: row nowrap; min-width: 100%;"
                    role="search">
                    <div class="s-box col-11">
                        <input type="text" autocomplete="off"
                            style="outline:2px solid #f03351; color: #f03351; position: relative; border-bottom-right-radius: 0px; border-top-right-radius: 0px;"
                            id="txtSearch" class="form-control border border-1 search-bar" placeholder="Movie Title" />
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
                                <img src="../../../public/images/defaultProfile.jpg" draggable="false"
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
                        <button ID="btnLgn" class="topBtns btn dropdown-toggle header-font" data-bs-toggle="dropdown"
                            aria-expanded="false" Style="font-size: 17px; color:#f03351">
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
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                ACTION
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Superhero</a></li>
                <li><a class="dropdown-item" href="">War</a></li>
                <li><a class="dropdown-item" href="">Adventure</a></li>
            </ul>
        </div>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                HORROR
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Supernatural Horror</a></li>
                <li><a class="dropdown-item" href="">Zombie</a></li>
            </ul>
        </div>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                ANIMATION
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">2D Animation</a></li>
                <li><a class="dropdown-item" href="">3D Animation</a></li>
                <li><a class="dropdown-item" href="">Anime</a></li>
            </ul>
        </div>
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <button onclick="location.href='../Movie/MovieDetail.html'" style="margin: 20px 20px;" type="button"
            class="btn btn-danger"><i class="fa-solid fa-angle-left"></i>&nbsp;Back</button>
        <div class="top-box">
            <div class="poster-box">
                <img src="../../../public/images/movie.webp" style="width: 60%;" draggable="false" />
            </div>
            <div class="detail-box">
                <div class="movie-name">
                    BOCCHI THE ROCK! Recap Part 1
                </div>
                <div class="movie-duration">
                    <i class="fa-regular fa-clock"></i>&nbsp;&nbsp;2 Hours 2 Minutes
                </div>
                <a href="#middle-box"><i
                        style="width:fit-content; cursor: pointer; font-size: 40px; color:#f03351; margin: 5px 0px;"
                        class="fa-solid fa-caret-down"></i></a>
            </div>
        </div>

        <div class="middle-box" id="middle-box">
            <div class="select-date">
                <p class="date-title">Select Date</p>
                <div class="date-radio">
                    <input type="radio" class="btn-check" name="options" id="date1" autocomplete="off">
                    <label class="btn btn-outline-danger" for="date1">
                        <p name="day">SUN</p>
                        <p name="date">28</p>
                        <p name="month">July</p>
                    </label>

                    <input type="radio" class="btn-check" name="options" id="date2" autocomplete="off">
                    <label class="btn btn-outline-danger" for="date2">
                        <p name="day">MON</p>
                        <p name="date">29</p>
                        <p name="month">July</p>
                    </label>

                    <input type="radio" class="btn-check" name="options" id="date3" autocomplete="off">
                    <label class="btn btn-outline-danger" for="date3">
                        <p name="day">TUE</p>
                        <p name="date">30</p>
                        <p name="month">July</p>
                    </label>

                    <input type="radio" class="btn-check" name="options" id="date4" autocomplete="off">
                    <label class="btn btn-outline-danger" for="date4">
                        <p name="day">WED</p>
                        <p name="date">31</p>
                        <p name="month">July</p>
                    </label>

                    <input type="radio" class="btn-check" name="options" id="date5" autocomplete="off">
                    <label class="btn btn-outline-danger" for="date5">
                        <p name="day">THU</p>
                        <p name="date">1</p>
                        <p name="month">Aug</p>
                    </label>
                </div>
            </div>
            <div class="select-experience">
                <!--Standard, Premium, Deluxe-->
                <p class="experience-title">Select Experience</p>
                <div class="exp-radio">
                    <input type="radio" class="btn-check" name="options-exp" id="exp1" autocomplete="off">
                    <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Standard 2D Experience"
                        class="btn btn-outline-danger" for="exp1">
                        <i class="fa-solid fa-film"></i>&nbsp;Standard 2D
                    </label>

                    <input type="radio" class="btn-check" name="options-exp" id="exp2" autocomplete="off">
                    <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Standard 3D Experience"
                        class="btn btn-outline-danger" for="exp2">
                        <i class="fa-solid fa-film"></i>&nbsp;Standard 3D
                    </label>

                    <input type="radio" class="btn-check" name="options-exp" id="exp3" autocomplete="off">
                    <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="IMAX 2D Experience"
                        class="btn btn-outline-danger" for="exp3">
                        <i class="fa-brands fa-web-awesome"></i>&nbsp;IMAX 2D
                    </label>
                    <input type="radio" class="btn-check" name="options-exp" id="exp4" autocomplete="off">
                    <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="IMAX 3D Experience"
                        class="btn btn-outline-danger" for="exp4">
                        <i class="fa-brands fa-web-awesome"></i>&nbsp;IMAX 3D
                    </label>
                </div>
            </div>
        </div>


        <div class="bottom-box">
            <p class="cinema-title">Select Cinema and Time</p>


            <div class="accordion-box">
                <div class="accordion" id="accordionPanelsStayOpenExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseOne">
                                <b>1 UTAMA</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="time-radio">
                                    <input type="radio" class="btn-check" name="time" id="oneutama1" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="oneutama1">
                                        <i class="fa-regular fa-clock"></i>&nbsp;10:30AM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="oneutama2" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="oneutama2">
                                        <i class="fa-regular fa-clock"></i>&nbsp;4:00PM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="oneutama3" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="oneutama3">
                                        <i class="fa-regular fa-clock"></i>&nbsp;8:30PM
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo">
                                <b>BUKIT TINGGI</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="time-radio">
                                    <input type="radio" class="btn-check" name="time" id="bukittinggi1"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="bukittinggi1">
                                        <i class="fa-regular fa-clock"></i>&nbsp;10:30AM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="bukittinggi2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="bukittinggi2">
                                        <i class="fa-regular fa-clock"></i>&nbsp;4:00PM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="bukittinggi3"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="bukittinggi3">
                                        <i class="fa-regular fa-clock"></i>&nbsp;8:30PM
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                <b>CENTRAL I-CITY</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="time-radio">
                                    <input type="radio" class="btn-check" name="time" id="centralicity1"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="centralicity1">
                                        <i class="fa-regular fa-clock"></i>&nbsp;10:30AM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="centralicity2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="centralicity2">
                                        <i class="fa-regular fa-clock"></i>&nbsp;4:00PM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="centralicity3"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="centralicity3">
                                        <i class="fa-regular fa-clock"></i>&nbsp;8:30PM
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseFour">
                                <b>PAVILION BUKIT JALIL</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="time-radio">
                                    <input type="radio" class="btn-check" name="time" id="pavilion1" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="pavilion1">
                                        <i class="fa-regular fa-clock"></i>&nbsp;10:30AM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="pavilion2" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="pavilion2">
                                        <i class="fa-regular fa-clock"></i>&nbsp;4:00PM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="pavilion3" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="pavilion3">
                                        <i class="fa-regular fa-clock"></i>&nbsp;8:30PM
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseFive">
                                <b>MINES</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="time-radio">
                                    <input type="radio" class="btn-check" name="time" id="mines1" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="mines1">
                                        <i class="fa-regular fa-clock"></i>&nbsp;10:30AM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="mines2" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="mines2">
                                        <i class="fa-regular fa-clock"></i>&nbsp;4:00PM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="mines3" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="mines3">
                                        <i class="fa-regular fa-clock"></i>&nbsp;8:30PM
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseSix">
                                <b>KEPONG</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="time-radio">
                                    <input type="radio" class="btn-check" name="time" id="kepong1" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="kepong1">
                                        <i class="fa-regular fa-clock"></i>&nbsp;10:30AM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="kepong2" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="kepong2">
                                        <i class="fa-regular fa-clock"></i>&nbsp;4:00PM
                                    </label>

                                    <input type="radio" class="btn-check" name="time" id="kepong3" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="kepong3">
                                        <i class="fa-regular fa-clock"></i>&nbsp;8:30PM
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>

    </div>


    <!--Modal Content-->
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-image" style="text-align: center;">
                        <img src="../../../public/images/movie.webp" style="width:30%;" draggable="false" />
                        <div
                            style="color:white; font-size: 18px; font-weight: 600; margin-top: 15px; margin-bottom:8px;">
                            BOCCHI THE ROCK! Recap Part 1
                        </div>
                        <div style="color:#f03351">
                            <i class="fa-regular fa-clock"></i>&nbsp;&nbsp;2 Hours 2 Minutes
                        </div>
                    </div>
                    <div class="selected-detail">
                        <table class="selected-det">

                            <tr class="cinema">
                                <td class="title">Cinema :
                                </td>
                                <td class="answer t-cinema">
                                    <span>PAVILION BUKIT JALIL</span>
                                </td>
                            </tr>

                            <tr class="experience">
                                <td class="title">Experience :
                                </td>
                                <td class="answer t-exp">
                                    <span>Deluxe</span>
                                </td>
                            </tr>

                            <tr class="dateTime">
                                <td class="title">Time & Date :
                                </td>
                                <td class="answer t-timedate">
                                    <span>Mon 29 July, 10:30AM</span>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: center;">
                    <button onclick="location.href='SeatSelection.html'" style="width: 85%;" type="button"
                        class="btn btn-danger"><i class="fa-solid fa-couch"></i>&nbsp;Select
                        Seats</button>
                </div>
            </div>
        </div>
    </div>


    <!--Next Select Seat-->
    <div class="toTop" id="toTop">
        <button id="top" data-bs-toggle="modal" data-bs-target="#myModal">
            <i class="fa-regular fa-circle-check"></i>&nbsp;Confirm
        </button>
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
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>