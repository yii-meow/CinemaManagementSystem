<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="../../../public/css/reset.css"/>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/MovieCategory.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Homepage.css"/>
    <title>Homepage</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>
</head>

<body>

<!--Header-->
<?php include(dirname(__DIR__) . '../../header.php') ?>
<?php include(dirname(__DIR__) . '../../navigationBar.php') ?>

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
                        <img src="<?= ROOT ?>/assets/images/movie.webp" alt="Movie"/>
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
                        <img src="<?= ROOT ?>/assets/images/movie2.webp" alt="Movie"/>
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
                        <img src="<?= ROOT ?>/assets/images/mainMovie_1.jpg" alt="Movie"/>
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
                <input type="text" class="location-input" placeholder="Postal code or city"/>
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
            <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster"/>
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
            <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster"/>
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
            <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster"/>
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
            <img src="../../../public/images/movie.webp" alt="Deadpool & Wolverine" class="movie-poster"/>
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
            <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show"/>
            <div class="p-2">
                <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
                <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
            </div>
        </div>
        <div class="movie-card">
            <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show"/>
            <div class="p-2">
                <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
                <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
            </div>
        </div>
        <div class="movie-card">
            <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show"/>
            <div class="p-2">
                <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
                <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
            </div>
        </div>
        <div class="movie-card">
            <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show"/>
            <div class="p-2">
                <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
                <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
            </div>
        </div>
        <div class="movie-card">
            <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show"/>
            <div class="p-2">
                <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
                <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
            </div>
        </div>
        <div class="movie-card">
            <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show"/>
            <div class="p-2">
                <h2 class="movie-title">THE ROCKY HORROR PICTURE SHOW</h2>
                <p class="movie-date text-dark">Tomorrow, Aug. 03</p>
            </div>
        </div>
        <div class="movie-card">
            <img src="../../../public/images/movie.webp" alt="The Rocky Horror Picture Show"/>
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