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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/MovieResult.css"/>
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
            <li class="showing">RELATED MOVIES</li>
        </ul>
    </nav>

    <div class="showtime container mt-6 mb-3">
        <div class="movies">
            <?php
            if (isset($moviesWithGroupedSchedules) && !empty($moviesWithGroupedSchedules)):
                foreach ($moviesWithGroupedSchedules as $movie):
                    $duration = $movie['duration'];
                    $hours = floor($duration / 60);
                    $minutes = $duration % 60;
                    $durationFormatted = "{$hours} hours and {$minutes} minutes";
                    $encryption = new \App\core\Encryption();
                    $encryptedMovieId = $encryption->encrypt($movie['movieId'], $encryption->getKey());
                    ?>
                    <div class="w-100 mb-4">
                        <a href="<?= ROOT ?>/MovieDetails?movieId=<?= $encryptedMovieId ?>">
                            <div class="movie-result w-100 d-flex">
                                <img src="<?= htmlspecialchars(ROOT . $movie['photo']) ?>"
                                     alt="<?= htmlspecialchars($movie['title']) ?>"
                                     class="movie-poster" style="width: 200px; height: auto;"/>
                                <div class="movie-details ml-4">
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
                                                    <button class="showtime-btn btn btn-outline-primary btn-sm m-1"
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
            else: ?>
                <div class="alert alert-danger w-100 mt-5 text-center">No movies found matching your search criteria.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<!--Footer-->
<?php include(dirname(__DIR__) . '../../footer.php') ?>

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