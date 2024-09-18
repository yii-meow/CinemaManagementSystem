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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css"/>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css"/>
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

    <!--    TODO: Calculate five available movies with highest ticket sales  -->
    <div class="content">
        <div class="carousel">
            <button class="nav-button" id="prevButton">
                &#10094;
            </button>
            <div class="movie-container" id="movieContainer">
                <div class="movie">
                    <div><span class="movie-ranking">1</span></div>
                    <div>
                        <img src="<?= ROOT ?>/assets/images/movie.webp" alt="Movie"/>
                        <div class="ranking-container">
                            <span class="ranking-title">Deadpool 1</span>
                            <span class="ranking-rating">
                          <span class="rating">5.0</span>
                          <span class="star">★</span>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="movie">
                    <div><span class="movie-ranking">2</span></div>
                    <div>
                        <img src="<?= ROOT ?>/assets/images/pp.webp" alt="Movie"/>
                        <div class="ranking-container">
                            <span class="ranking-title">Deadpool 2</span>
                            <span class="ranking-rating">
                          <span class="rating">5.0</span>
                          <span class="star">★</span>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="movie">
                    <div><span class="movie-ranking">3</span></div>
                    <div>
                        <img src="<?= ROOT ?>/assets/images/movie2.webp" alt="Movie"/>
                        <div class="ranking-container">
                            <span class="ranking-title">Deadpool 3</span>
                            <span class="ranking-rating">
                          <span class="rating">5.0</span>
                          <span class="star">★</span>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="movie">
                    <div><span class="movie-ranking">4</span></div>
                    <div>
                        <img src="<?= ROOT ?>/assets/images/mainMovie_1.jpg" alt="Movie"/>
                        <div class="ranking-container">
                            <span class="ranking-title">Deadpool 4</span>
                            <span class="ranking-rating">
                          <span class="rating">5.0</span>
                          <span class="star">★</span>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="movie">
                    <div><span class="movie-ranking">5</span></div>
                    <div>
                        <img src="<?= ROOT ?>/assets/images/pp.webp" alt="Movie"/>
                        <div class="ranking-container">
                            <span class="ranking-title">Deadpool 5</span>
                            <span class="ranking-rating">
                          <span class="rating">5.0</span>
                          <span class="star">★</span>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="nav-button" id="nextButton">&#10095;</button>
        </div>
    </div>
    <div class="text-center">
        <i class="fa fa-angle-down" style="font-size: 66px; color: #ffd700"></i>
    </div>
</div>

<div class="showtime container mt-6 mb-3">
    <div class="showtime-container">
        <span class="showtime-title">TODAY AVAILABLE SHOWTIMES</span>
    </div>
    <div class="filter-section">
        <i class="fa fa-globe" aria-hidden="true"></i>
        <div class="filter-label">WHERE</div>
        <div class="filter-options" id="cinema-filter">
            <span class="filter-option active" data-cinema-id="all">All Cinemas</span>
            <?php
            if (isset($cinemas)) {
                foreach ($cinemas as $cinema): ?>
                    <span class="filter-option"
                          data-cinema-id="<?= $cinema->getCinemaId() ?>"><?= htmlspecialchars($cinema->getName()) ?></span>
                <?php endforeach;
            } ?>
        </div>
    </div>
    <div id="no-movies-message" style="display: none;color:red;">
        <p>No movies available for the selected cinema.</p>
    </div>
    <div class="movies">
        <?php
        if (isset($moviesWithGroupedSchedules)) {
            foreach ($moviesWithGroupedSchedules as $movie):
                $duration = $movie['duration'];
                $hours = floor($duration / 60);
                $minutes = $duration % 60;
                $durationFormatted = "{$hours} hours and {$minutes} minutes";
                ?>

                <?php
                    //Perform Encryption
                    $encryption = new \App\core\Encryption();
                    $movieId = $movie['movieId'];
                    $encryptedMovieId = $encryption->encrypt($movieId, $encryption->getKey());
                ?>
                <div class="w-100">
                    <a href="<?= ROOT ?>/MovieDetails?movieId=<?= $encryptedMovieId ?>">
                        <div class="movie-result w-100">
                            <img src="<?= htmlspecialchars($movie['photo']) ?>"
                                 alt="<?= htmlspecialchars($movie['title']) ?>"
                                 class="movie-poster"/>
                            <div class="movie-details">
                                <h2 class="movie-title"><?= htmlspecialchars(strtoupper($movie['title'])) ?></h2>
                                <p class="movie-info mt-4 text-secondary">
                                    <?= htmlspecialchars($movie['classification'] ?? 'Not Rated') ?>
                                    | <?= $durationFormatted ?>
                                    | Language: <?= htmlspecialchars($movie['language']) ?>
                                </p>
                                <div class="movie-format mt-2"><?= htmlspecialchars($movie["category"]) ?></div>
                                <?php foreach ($movie['cinemas'] as $cinema): ?>
                                    <div class="cinema-showtimes mt-5 py-3" data-cinema-id="<?= $cinema['id'] ?>">
                                        <h3><u><?= htmlspecialchars($cinema['name']) ?></u></h3>
                                        <div class="showtimes mt-4 mb-2">
                                            <?php foreach ($cinema['showtimes'] as $showtime): ?>
                                                <button class="showtime-btn border-0"
                                                        data-schedule-id="<?= $showtime['scheduleId'] ?>">
                                                    <?= $showtime['time']->format('h:i A') ?>
                                                    (<?= htmlspecialchars($showtime['hallType']) ?>)
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach;
        } ?>
    </div>
</div>

<div class="coming-soon-movie container">
    <h1>COMING SOON</h1>
    <div class="movie-grid">
        <?php
        if (isset($comingSoonMovies) && !empty($comingSoonMovies)):
            foreach ($comingSoonMovies as $movie): ?>
                <div class="movie-card">
                    <img src="<?= htmlspecialchars($movie->getPhoto()) ?>"
                         alt="<?= htmlspecialchars($movie->getTitle()) ?>"/>
                    <div class="p-2">
                        <h2 class="movie-title"><?= htmlspecialchars($movie->getTitle()) ?></h2>
                        <p class="movie-date text-dark">Coming <?= $movie->getReleaseDate()->format('M. d, Y') ?></p>
                    </div>
                </div>
            <?php endforeach;
        else: ?>
            <p>No coming soon movies at this time.</p>
        <?php endif; ?>
    </div>
</div>

<!--Footer-->
<?php include(dirname(__DIR__) . '../../footer.php') ?>

<script>
    const movieContainer = document.getElementById('movieContainer');
    const movies = document.querySelectorAll('.movie');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');

    let currentIndex = 0;

    function updateCarousel() {
        movies.forEach((movie, index) => {
            if (index >= currentIndex && index < currentIndex + 3) {
                movie.style.display = 'block';
            } else {
                movie.style.display = 'none';
            }
        });
    }

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentIndex < movies.length - 3) {
            currentIndex++;
            updateCarousel();
        }
    });

    // Initial setup
    updateCarousel();
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterOptions = document.querySelectorAll('#cinema-filter .filter-option');
        const movieResults = document.querySelectorAll('.movie-result');
        const noMoviesMessage = document.getElementById('no-movies-message');

        filterOptions.forEach(option => {
            option.addEventListener('click', function () {
                const selectedCinemaId = this.getAttribute('data-cinema-id');

                // Update active class
                filterOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');

                let visibleMoviesCount = 0;

                movieResults.forEach(movie => {
                    const cinemaShowtimes = movie.querySelectorAll('.cinema-showtimes');
                    let hasVisibleShowtimes = false;

                    cinemaShowtimes.forEach(cinema => {
                        if (selectedCinemaId === 'all' || cinema.getAttribute('data-cinema-id') === selectedCinemaId) {
                            cinema.style.display = 'block';
                            hasVisibleShowtimes = true;
                        } else {
                            cinema.style.display = 'none';
                        }
                    });

                    // Show/hide the entire movie result based on whether it has visible showtimes
                    if (hasVisibleShowtimes) {
                        movie.style.display = 'flex';
                        visibleMoviesCount++;
                    } else {
                        movie.style.display = 'none';
                    }
                });

                // Show/hide the "no movies" message
                if (visibleMoviesCount === 0) {
                    noMoviesMessage.style.display = 'block';
                } else {
                    noMoviesMessage.style.display = 'none';
                }
            });
        });
    });
</script>
</body>

</html>