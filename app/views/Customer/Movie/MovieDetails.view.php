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
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css"/>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/MovieDetail.css"/>
    <title>Movie Detail</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<body>
<div id="Customer">

    <!--Header-->
    <?php include "../app/views/header.php"?>


    <!--Navigation Bar-->
    <?php include "../app/views/navigationBar.php"?>


    <!--Main Contents-->
    <div class="product-container">
        <div class="left-box">
            <div class="top-container">
                <div class="product-header">
                    <div class="left-info">
                        <div class="header-title">
                            <p style="font-weight: bold; font-size: 25px; color: white"
                               ID="pname">
                                <?php
                                if (isset($title)) {
                                    echo $title;
                                }
                                ?></p>
                        </div>
                        <div class="series">
                            <span style="color: #f03351;">Duration : </span>
                            <span id="lblSeries" style="color: white;">
                                <?php
                                if (isset($duration)) {
                                    $hour = intdiv($duration, 60);
                                    $minute = $duration % 60;
                                    echo $hour . " Hours " . $minute . " Mins";
                                }
                                ?></span>
                        </div>
                    </div>
                    <div class="status-icon" id="status">
                        <span id="lblTopStatus" class="topStatus">
                            <?php
                            if (isset($status)) {
                                echo $status;
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="middle">
                    <div class="main-img">


                        <div id="createView">

                        </div>


                        <!-- <img style="width: 50%; padding: 20px;" id="mainimg" src="../Media/Image/movie.webp" /> -->
                    </div>
                    <div class="select-img">
                        <div class="img1" id="image">
                            <button id="im" onclick="changeImg()">
                                <img id="img" src="<?php if (isset($photo)) {
                                    echo $photo;
                                } ?>" class="sideimg">
                            </button>
                        </div>
                        <div class="img2" id="video">
                            <button id="vi" onclick="changeVideo()">
                                <div style="position: relative;">
                                    <img id="vid" style="filter: blur(3px);"
                                         src="
                                         <?php if (isset($photo)) {
                                             echo $photo;
                                         } ?>"
                                         class="sideimg">
                                    <!--hidden field to pass video link to js-->
                                    <input type="hidden" id="hdnLink"
                                           value="<?php if (isset($trailerLink)) {
                                               echo $trailerLink;
                                           } ?>"/>
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
                            <span>
                                <?php if (isset($category)) {
                                    echo $category;
                                } ?>
                            </span>
                        </td>
                    </tr>

                    <tr class="class">
                        <td class="title">Classification :
                        </td>
                        <td class="answer p-class">
                            <span>
                            <?php if (isset($classification)) {
                                echo $classification;
                            } ?>
                            </span>
                        </td>
                    </tr>

                    <tr class="releasedate">
                        <td class="title">Release Date :
                        </td>
                        <td class="answer p-releasedate">
                            <span>
                            <?php if (isset($releaseDate)) {
                                $date = new DateTime($releaseDate);
                                echo date_format($date, "d F Y");
                            } ?>
                            </span>
                        </td>
                    </tr>

                    <tr class="language">
                        <td class="title">Language :
                        </td>
                        <td class="answer p-language">
                            <span>
                             <?php if (isset($language)) {
                                 echo strtoupper($language);
                             } ?>
                            </span>
                        </td>
                    </tr>

                    <tr class="subtitles">
                        <td class="title">Subtitles :
                        </td>
                        <td class="answer p-subtitle">
                            <span>
                            <?php if (isset($subtitles)) {
                                echo strtoupper($subtitles);
                            } ?>
                            </span>
                        </td>
                    </tr>

                    <tr class="director">
                        <td class="title">Director :
                        </td>
                        <td class="answer p-director">
                            <span>
                                 <?php if (isset($director)) {
                                     echo $director;
                                 } ?>
                            </span>
                        </td>
                    </tr>

                    <tr class="cast">
                        <td class="title">Casts :
                        </td>
                        <td class="answer p-cast">
                            <span>
                                  <?php if (isset($casts)) {
                                      echo $casts;
                                  } ?>
                            </span>
                        </td>
                    </tr>


                    <tr class="description">
                        <td class="title">Description :
                        </td>
                        <td class="answer p-description">
                            <span>
                                  <?php if (isset($description)) {
                                      echo $description;
                                  } ?>
                            </span>
                        </td>
                    </tr>


                </table>
            </div>
        </div>
    </div>

    <!--Click this button back to top of the page-->
    <div class="toTop" id="toTop">
        <button onclick="location.href='<?= ROOT ?>/DetailSelection?mid=<?php if(isset($movieId)){echo $movieId;} ?>'" id="top">
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
    <?php include "../app/views/footer.php"?>


    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>

</body>

</html>