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

<!--    TODO: Calculate five available movies with highest ticket sales  -->
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

<div class="showtime container mt-6 mb-3">
    <div class="showtime-container">
        <span class="showtime-title">TODAY SHOWTIMES</span>
    </div>
    <div class="filter-section">
        <i class="fa fa-globe" aria-hidden="true"></i>
        <div class="filter-label">WHERE</div>
        <div class="filter-options">
            <span class="filter-option active">ANY CINEMA</span>
<!--            TODO: Let user click on the cinema to filter today movies-->
            <?php
            if (isset($cinemas)) {
                foreach ($cinemas as $cinema): ?>
                    <span class="filter-option"><?= htmlspecialchars($cinema->getName()) ?></span>

                <?php endforeach;
            } ?>
        </div>
    </div>
    <div class="filter-section">
        <i class="fa fa-window-maximize" aria-hidden="true"></i>
        <div class="filter-label">WHAT</div>
        <div class="filter-options">
            <span class="filter-option active">ANY EXPERIENCE</span>
            <span class="filter-option">IMAX</span>
            <span class="filter-option">DELUXUE</span>
            <span class="filter-option">ATMOS</span>
            <span class="filter-option">BENIE</span>
        </div>
    </div>
    <div class="movies">
        <?php

        if(isset($moviesWithGroupedSchedules)){
        foreach ($moviesWithGroupedSchedules as $movie):
        $duration = $movie['duration'];
        $hours = floor($duration / 60);
        $minutes = $duration % 60;
        $durationFormatted = "{$hours} hours and {$minutes} minutes";
        ?>
        <div class="movie-result">
            <img src="<?= htmlspecialchars($movie['photo']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>" class="movie-poster"/>
            <div class="movie-details">
                <h2 class="movie-title"><?= htmlspecialchars(strtoupper($movie['title'])) ?></h2>
                <p class="movie-info mt-4 text-secondary">
                    <?= htmlspecialchars($movie['classification'] ?? 'Not Rated') ?> | <?= $durationFormatted ?> | <?= htmlspecialchars($movie['language']) ?>, CLOSED CAPTIONING, DESCRIPTIVE AUDIO
                </p>
                <div class="movie-format mt-2">STANDARD</div>
                <div class="showtimes mt-5">
<!--                    TODO: Let user click on the button and navigate to the ticket page-->
                    <?php foreach ($movie['available_times'] as $time): ?>
                        <button class="showtime-btn"><?= $time->format('h:i A') ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; } ?>

<!--        <div class="text-center w-100 p-5">-->
<!--            <btn class="bg-dark text-white px-5 py-4 w-100 rounded">-->
<!--                <span style="font-size: 1.6rem">Show More</span>-->
<!--            </btn>-->
<!--        </div>-->
    </div>
</div>

<div class="coming-soon-movie container">
    <h1>COMING SOON</h1>
    <div class="movie-grid">
        <?php
        if(isset($comingSoonMovies) && !empty($comingSoonMovies)):
            foreach($comingSoonMovies as $movie): ?>
                <div class="movie-card">
                    <img src="<?= htmlspecialchars($movie->getPhoto())?>" alt="<?= htmlspecialchars($movie->getTitle()) ?>"/>
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
</body>

</html>