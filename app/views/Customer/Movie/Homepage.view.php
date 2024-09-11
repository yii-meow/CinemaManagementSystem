<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
  <link rel="stylesheet" href="../../../public/css/reset.css" />

  <link rel="stylesheet" href="../../../public/css/Main.css" />
  <link rel="stylesheet" href="../../../public/css/MovieCategory.css" />
  <link rel="stylesheet" href="../../../public/css/Homepage.css" />
  <title>Homepage</title>

  <link rel="icon" type="image/x-icon" href="../../../public/images/icon.png" />
</head>

<body>
  <div class="header" id="header">
    <div class="binder">
      <div style="margin-left: 20px" class="business-icon">
        <div style="
              color: white;
              height: inherit;
              text-align: center;
              font-weight: bold;
              font-size: 20px;
            ">
          <img src="../../../public/images/alternativeIcon.png" draggable="false" width="200" height="55" />
        </div>
      </div>

      <div class="search-ctn col-7" style="margin-top: auto; margin-bottom: auto">
        <div class="search-ctn input-group" style="display: flex; flex-flow: row nowrap; min-width: 100%" role="search">
          <div class="s-box col-11">
            <input type="text" autocomplete="off" style="
                  outline: 2px solid #f03351;
                  color: #f03351;
                  position: relative;
                  border-bottom-right-radius: 0px;
                  border-top-right-radius: 0px;
                " id="txtSearch" class="form-control border border-1 search-bar" placeholder="Movie Title" />
          </div>
          <div>
            <button id="btnSch" style="
                  background-color: #141414;
                  width: fit-content;
                  border-bottom-left-radius: 0px;
                  border-top-left-radius: 0px;
                  border-color: #f03351;
                  height: 41px;
                  margin-top: -2px;
                " class="btn-light btn btn-search">
              <i style="
                    color: #f03351;
                    font-size: 18px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-top: 4.5px;
                    height: 18px;
                  " class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="right-header">
      <div class="action-group" style="display: flex; flex-flow: row nowrap">
        <div class="nofitication-cont">
          <div>
            <i onclick="openMessage()" style="
                  cursor: pointer;
                  position: relative;
                  top: 0;
                  color: white;
                  font-size: 28px;
                " class="fa-regular fa-bell" id="bell"></i>
            <div runat="server" id="REDDOT" style="
                  position: absolute;
                  top: 0;
                  right: 0;
                  border-radius: 100px;
                  background-color: #ff2b2b;
                  height: 11px;
                  width: 11px;
                "></div>
          </div>

          <div class="messages">
            <ul id="dropdownMessage" tabindex="-1" class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdownMenuLink">
              <li>abcde</li>
            </ul>
          </div>
        </div>

        <div class="profile-container action" id="profile">
          <div style="margin-top: auto; margin-bottom: auto">
            <button onclick="" class="btn header-font" style="
                  padding: 10px;
                  width: 160px;
                  font-size: 17px;
                  display: flex;
                  color: #f03351;
                ">
              <div style="
                    margin-top: -3px;
                    border-radius: 150px;
                    width: 30px;
                    height: 30px;
                    overflow: hidden;
                  ">
                <img src="../../../public/images/defaultProfile.jpg" draggable="false" style="
                      background-color: white;
                      border-radius: 100px;
                      width: 30px;
                      height: 30px;
                    " id="topImage" />
              </div>
              &nbsp; User Profile
            </button>
          </div>
        </div>

        <div class="login action" style="margin-right: 20px">
          <div style="margin-top: auto; margin-bottom: auto">
            <button id="btnLgn" class="topBtns btn dropdown-toggle header-font" data-bs-toggle="dropdown"
              aria-expanded="false" style="font-size: 17px; color: #f03351">
              <i style="color: #f03351; font-size: 18px" class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp; Login
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
  <div class="dropdowns" style="display: flex; flex-flow: row nowrap">
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
        <a href="" style="text-decoration: none"> NOW SHOWING</a>
      </button>
    </ul>
    <ul class="nav-item dropdown">
      <button class="btn dropbtn" type="button" aria-expanded="false">
        <a href="" style="text-decoration: none"> COMING SOON</a>
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

  <div class="main">
    <div class="bg-blur" id="bgBlur"></div>

    <nav>
      <ul>
        <li class="showing">POPULAR MOVIES SHOWING NOW</li>
      </ul>
    </nav>

    <div class="content">
      <div class="carousel">
        <button class="nav-button" onclick="changeMovies(-1)">
          &#10094;
        </button>
        <div class="movie-container" id="movieContainer">
          <div class="movie">
            <div><span class="movie-ranking">1</span></div>
            <div>
              <img src="../../../public/images/movie.webp" alt="Movie" />
              <div class="ranking-container">
                <span class="ranking-title">Deadpool</span>
                <span class="ranking-rating">
                  <span class="rating">5.0</span>
                  <span class="star">★</span>
                </span>
              </div>

              <div class="formats">
                <span class="format">IMAX</span>
                <span class="format">IMAX</span>
                <span class="format">IMAX</span>
              </div>
            </div>
          </div>

          <div class="movie">
            <div><span class="movie-ranking">2</span></div>
            <div>
              <img src="../../../public/images/movie2.webp" alt="Movie" />
              <div class="ranking-container">
                <span class="ranking-title">Deadpool</span>
                <span class="ranking-rating">
                  <span class="rating">5.0</span>
                  <span class="star">★</span>
                </span>
              </div>

              <div class="formats">
                <span class="format">IMAX</span>
                <span class="format">IMAX</span>
                <span class="format">IMAX</span>
              </div>
            </div>
          </div>

          <div class="movie">
            <div><span class="movie-ranking">3</span></div>
            <div>
              <img src="../../../public/images/mainMovie_1.jpg" alt="Movie" />
              <div class="ranking-container">
                <span class="ranking-title">Deadpool</span>
                <span class="ranking-rating">
                  <span class="rating">5.0</span>
                  <span class="star">★</span>
                </span>
              </div>

              <div class="formats">
                <span class="format">IMAX</span>
                <span class="format">IMAX</span>
                <span class="format">IMAX</span>
              </div>
            </div>
          </div>
        </div>
        <button class="nav-button" onclick="changeMovies(1)">&#10095;</button>
      </div>
    </div>
    <div class="text-center">
      <i class="fa fa-angle-down" style="font-size: 66px; color: #ffd700"></i>
    </div>
  </div>

  <div class="container">
    <div class="booking-container">
      <h2>PURCHASE TICKET</h2>
      <div class="toggle-container">
        <button class="toggle-btn active">
          <span style="font-size: 1.2em">
            <i class="fa fa-film fa-lg" aria-hidden="true"></i>
          </span>
          NEARBY CINEMAS
        </button>
        <button class="toggle-btn">
          <span style="font-size: 1.2em">
            <i class="fa fa-gratipay fa-lg" aria-hidden="true"></i>
          </span>
          FAVORITE CINEMAS
        </button>
      </div>
      <div class="location-container">
        <p>What is your location?</p>
        <div class="input-wrapper">
          <input type="text" class="location-input" placeholder="Postal code or city" />
          <button class="map-icon-button">
            <i class="fas fa-map-marker-alt map-icon"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="showtime container mt-4 mb-3">
    <div class="showtime-container">
      <span class="showtime-title">SHOWTIMES & TICKETS</span>
    </div>
    <div class="filter-section">
      <i class="fa fa-globe" aria-hidden="true"></i>
      <div class="filter-label">WHERE</div>
      <div class="filter-options">
        <span class="filter-option active">ANY CINEMA</span>
        <span class="filter-option">Pavilion KL</span>
        <span class="filter-option">Pavilion Bukit Jalil</span>
        <span class="filter-option">Mid Valley KL</span>
        <span class="filter-option">Sunway Velocity</span>
        <span class="filter-option">Sunway Pyramid</span>
      </div>
    </div>
    <div class="filter-section">
      <i class="fa fa-window-maximize" aria-hidden="true"></i>
      <div class="filter-label">WHAT</div>
      <div class="filter-options">
        <span class="filter-option active">ANY EXPERIENCE</span>
        <span class="filter-option">STANDARD</span>
        <span class="filter-option">PREMIUM</span>
        <span class="filter-option">DELUXE</span>
      </div>
    </div>
    <div class="filter-section">
      <i class="fa fa-clock-o" aria-hidden="true"></i>
      <div class="filter-label">WHEN</div>
      <div class="filter-options">
        <span class="filter-option active">ANYTIME</span>
        <span class="filter-option">TODAY, 8/1</span>
        <span class="filter-option">TOMORROW, 8/2</span>
        <span class="filter-option">SATURDAY 8/3</span>
        <span class="filter-option">SUNDAY 8/4</span>
        <span class="filter-option">MONDAY 8/5</span>
        <span class="filter-option">TUESDAY 8/6</span>
        <span class="filter-option">WEDNESDAY 8/7</span>
        <span class="filter-option">THURSDAY</span>
      </div>
    </div>
    <div class="movies">
      <div class="movie-result">
        <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster" />
        <div class="movie-details">
          <h2 class="movie-title">DEADPOOL & WOLVERINE</h2>
          <p class="movie-info mt-4 text-secondary">
            R | 2 hours and 7 minutes | CLOSED CAPTIONING, DESCRIPTIVE AUDIO,
            NO PASSES
          </p>
          <div class="movie-format mt-2">STANDARD</div>
          <div class="showtimes mt-5">
            <button class="showtime-btn">10:15 AM</button>
            <button class="showtime-btn">11:00 AM</button>
            <button class="showtime-btn">12:00 PM</button>
            <button class="showtime-btn">01:10 PM</button>
            <button class="showtime-btn">02:00 PM</button>
            <button class="showtime-btn">03:00 PM</button>
            <button class="showtime-btn">04:05 PM</button>
            <button class="showtime-btn">05:00 PM</button>
            <button class="showtime-btn">06:00 PM</button>
            <button class="showtime-btn">07:00 PM</button>
            <button class="showtime-btn">08:00 PM</button>
            <button class="showtime-btn">09:00 PM</button>
            <button class="showtime-btn">10:00 PM</button>
          </div>
        </div>
      </div>

      <div class="movie-result">
        <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster" />
        <div class="movie-details">
          <h2 class="movie-title">DEADPOOL & WOLVERINE</h2>
          <p class="movie-info mt-4 text-secondary">
            R | 2 hours and 7 minutes | CLOSED CAPTIONING, DESCRIPTIVE AUDIO,
            NO PASSES
          </p>
          <div class="movie-format mt-2">STANDARD</div>
          <div class="showtimes mt-5">
            <button class="showtime-btn">10:15 AM</button>
            <button class="showtime-btn">11:00 AM</button>
            <button class="showtime-btn">12:00 PM</button>
            <button class="showtime-btn">01:10 PM</button>
            <button class="showtime-btn">02:00 PM</button>
            <button class="showtime-btn">03:00 PM</button>
            <button class="showtime-btn">04:05 PM</button>
            <button class="showtime-btn">05:00 PM</button>
            <button class="showtime-btn">06:00 PM</button>
            <button class="showtime-btn">07:00 PM</button>
            <button class="showtime-btn">08:00 PM</button>
            <button class="showtime-btn">09:00 PM</button>
            <button class="showtime-btn">10:00 PM</button>
          </div>
        </div>
      </div>

      <div class="movie-result">
        <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster" />
        <div class="movie-details">
          <h2 class="movie-title">DEADPOOL & WOLVERINE</h2>
          <p class="movie-info mt-4 text-secondary">
            R | 2 hours and 7 minutes | CLOSED CAPTIONING, DESCRIPTIVE AUDIO,
            NO PASSES
          </p>
          <div class="movie-format mt-2">STANDARD</div>
          <div class="showtimes mt-5">
            <button class="showtime-btn">10:15 AM</button>
            <button class="showtime-btn">11:00 AM</button>
            <button class="showtime-btn">12:00 PM</button>
            <button class="showtime-btn">01:10 PM</button>
            <button class="showtime-btn">02:00 PM</button>
            <button class="showtime-btn">03:00 PM</button>
            <button class="showtime-btn">04:05 PM</button>
            <button class="showtime-btn">05:00 PM</button>
            <button class="showtime-btn">06:00 PM</button>
            <button class="showtime-btn">07:00 PM</button>
            <button class="showtime-btn">08:00 PM</button>
            <button class="showtime-btn">09:00 PM</button>
            <button class="showtime-btn">10:00 PM</button>
          </div>
        </div>
      </div>

      <div class="movie-result">
        <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster" />
        <div class="movie-details">
          <h2 class="movie-title">DEADPOOL & WOLVERINE</h2>
          <p class="movie-info mt-4 text-secondary">
            R | 2 hours and 7 minutes | CLOSED CAPTIONING, DESCRIPTIVE AUDIO,
            NO PASSES
          </p>
          <div class="movie-format mt-2">STANDARD</div>
          <div class="showtimes mt-5">
            <button class="showtime-btn">10:15 AM</button>
            <button class="showtime-btn">11:00 AM</button>
            <button class="showtime-btn">12:00 PM</button>
            <button class="showtime-btn">01:10 PM</button>
            <button class="showtime-btn">02:00 PM</button>
            <button class="showtime-btn">03:00 PM</button>
            <button class="showtime-btn">04:05 PM</button>
            <button class="showtime-btn">05:00 PM</button>
            <button class="showtime-btn">06:00 PM</button>
            <button class="showtime-btn">07:00 PM</button>
            <button class="showtime-btn">08:00 PM</button>
            <button class="showtime-btn">09:00 PM</button>
            <button class="showtime-btn">10:00 PM</button>
          </div>
        </div>
      </div>

      <div class="text-center w-100 p-5">
        <btn class="bg-dark text-white px-5 py-4 w-100 rounded">
          <span style="font-size: 1.6rem">Show More</span>
        </btn>
      </div>
    </div>
  </div>

  <div class="coming-soon-movie container">
    <h1>COMING SOON</h1>
    <div class="movie-grid">
      <div class="movie-card">
        <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show" />
        <div class="p-2">
          <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
          <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
        </div>
      </div>
      <div class="movie-card">
        <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show" />
        <div class="p-2">
          <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
          <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
        </div>
      </div>
      <div class="movie-card">
        <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show" />
        <div class="p-2">
          <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
          <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
        </div>
      </div>
      <div class="movie-card">
        <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show" />
        <div class="p-2">
          <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
          <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
        </div>
      </div>
      <div class="movie-card">
        <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show" />
        <div class="p-2">
          <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
          <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
        </div>
      </div>
      <div class="movie-card">
        <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show" />
        <div class="p-2">
          <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
          <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
        </div>
      </div>
      <div class="movie-card">
        <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show" />
        <div class="p-2">
          <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
          <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
        </div>
      </div>
    </div>
  </div>

  <!--Footer-->
  <footer id="footer">
    <div class="footer-container container-fluid">
      <div class="bottom" style="text-align: center; color: white">
        © 2023 - 2024 DreamWorks Cinema (Copyright All Right Reserved)
      </div>
    </div>
  </footer>
</body>

</html>