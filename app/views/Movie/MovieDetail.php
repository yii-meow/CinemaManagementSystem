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
    <link rel="stylesheet" href="../../../public/css/MovieDetail.css" />
    <title>Movie Detail</title>

    <link rel="icon" type="image/x-icon" href="../../../public/images/icon.png">
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
                            <img src="../../../public/images/alternativeIcon.png" draggable="false" width="200" height="55" />
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
                    <button class="btn dropbtn" type="button">
                        <a href="" style="text-decoration: none;"> NOW SHOWING</a>
                    </button>
                </ul>
                <ul class="nav-item dropdown">
                    <button class="btn dropbtn" type="button" >
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

            <div class="product-container">
                <div class="left-box">
                    <div class="top-container">
                        <div class="product-header">
                            <div class="left-info">
                                <div class="header-title">
                                    <p style="font-weight: bold; font-size: 25px; color: white" ID="pname">BOCCHI THE
                                        ROCK! Recap Part 1</p>
                                </div>
                                <div class="series">
                                    <span style="color: #f03351;">Duration : </span>
                                    <span id="lblSeries" style="color: white;">2 Hours 2 Mins</span>
                                </div>
                            </div>
                            <div class="status-icon" id="status">
                                <span id="lblTopStatus" class="topStatus">Now Showing</span>
                            </div>
                        </div>
                        <div class="middle">
                            <div class="main-img">


                                <div id="createView">

                                </div>


                                <!-- <img style="width: 50%; padding: 20px;" id="mainimg" src="../../../public/images/movie.webp" /> -->
                            </div>
                            <div class="select-img">
                                <div class="img1" id="image">
                                    <button id="im" onclick="changeImg()">
                                        <img id="img" src="../../../public/images/movie.webp" class="sideimg">
                                    </button>
                                </div>
                                <div class="img2" id="video">
                                    <button id="vi" onclick="changeVideo()">
                                        <div style="position: relative;">
                                            <img id="vid" style="filter: blur(3px);" src="../../../public/images/movie.webp"
                                                class="sideimg">
                                            <!--hidden field to pass video link to js-->
                                            <input type="hidden" id="hdnLink"
                                                value="https://www.youtube.com/embed/MCNmJwk3OaA?si=4hl6Jf-YoP1i8OBp" />
                                            <div style="color:#f03351; font-size: 60px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"
                                                class="fa-regular fa-circle-play"></div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 10px; border-top: 1px solid #f03351;">
                        <table class="product-details">

                            <tr class="genre">
                                <td class="title">Category :
                                </td>
                                <td class="answer p-cat">
                                    <span>Animation</span>
                                </td>
                            </tr>

                            <tr class="class">
                                <td class="title">Classification :
                                </td>
                                <td class="answer p-class">
                                    <span>P12</span>
                                </td>
                            </tr>

                            <tr class="releasedate">
                                <td class="title">Release Date :
                                </td>
                                <td class="answer p-releasedate">
                                    <span>08 August 2024</span>
                                </td>
                            </tr>

                            <tr class="language">
                                <td class="title">Language :
                                </td>
                                <td class="answer p-language">
                                    <span>JPN</span>
                                </td>
                            </tr>

                            <tr class="subtitles">
                                <td class="title">Subtitles :
                                </td>
                                <td class="answer p-subtitle">
                                    <span>ENG</span>
                                </td>
                            </tr>

                            <tr class="director">
                                <td class="title">Director :
                                </td>
                                <td class="answer p-director">
                                    <span>Keiichiro Saito</span>
                                </td>
                            </tr>

                            <tr class="cast">
                                <td class="title">Casts :
                                </td>
                                <td class="answer p-cast">
                                    <span>Yoshino Aoyama, Sayumi Suzushiro, Saku Mizuno, Ikumi Hasegawa</span>
                                </td>
                            </tr>


                            <tr class="description">
                                <td class="title">Description :
                                </td>
                                <td class="answer p-description">
                                    <span>Hitori "Bocchi" Gotoh is an introverted girl. During her middle school years,
                                        she started playing the guitar, wanting to join a band. But because she had no
                                        friends, she ended up practicing guitar for six hours every day all by herself.
                                        After becoming a skilled guitar player, she uploaded videos of herself playing
                                        the guitar under the name "Guitar Hero" and fantasised about performing at her
                                        school`s cultural festival concert. But not only could she not find any
                                        bandmates, before she knew it, she was in high school and still wasn`t able to
                                        make a single friend! One day, Nijika Ijichi, the drummer in Kessoku Band,
                                        reached out to her. And because of that, her everyday life started to change
                                        little by little.</span>
                                </td>
                            </tr>



                        </table>
                    </div>
                </div>
            </div>

            <!--Click this button back to top of the page-->
            <div class="toTop" id="toTop">
                <button onclick="location.href='../Selection/DetailSelection.html'" id="top">
                    <i class="fa-solid fa-cart-shopping"></i>&nbsp;Buy Now
                </button>
            </div>


            <script type="text/javascript">

                window.onload = () => {
                    // Get Image Path to change
                    var path = document.getElementById("img").src;
                    document.getElementById("im").style.border = "5px solid #f03351";

                    // Clear existing content
                    document.getElementById('createView').innerHTML = '';

                    // Create Image
                    let img = document.createElement('img');
                    img.src = path;
                    document.getElementById('createView').appendChild(img);
                }

                function changeImg() {
                    // Change border color
                    document.getElementById("vi").style.border = "none";
                    document.getElementById("im").style.border = "5px solid #f03351";

                    // Get Image Path to change
                    var path = document.getElementById("img").src;

                    // Clear existing content
                    document.getElementById('createView').innerHTML = '';

                    // Create Image
                    let img = document.createElement('img');
                    img.src = path;
                    document.getElementById('createView').appendChild(img);
                }

                function changeVideo() {
                    // Change border color
                    document.getElementById("im").style.border = "none";
                    document.getElementById("vi").style.border = "5px solid #f03351";

                    // Get Video Path to change
                    var path = document.getElementById("hdnLink").value;

                    // Clear existing content
                    document.getElementById('createView').innerHTML = '';

                    // Create iframe
                    let iframe = document.createElement('iframe');
                    iframe.setAttribute("allowfullscreen", "true");
                    iframe.src = path;
                    document.getElementById('createView').appendChild(iframe);
                }

            </script>


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

    </body>

</html>