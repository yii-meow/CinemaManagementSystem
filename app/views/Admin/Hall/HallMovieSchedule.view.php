<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet"
    />
    <link
            href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
            rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
            href="https://fonts.googleapis.com/css?family=Poppins"
            rel="stylesheet"
    />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
            integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <!-- <link rel="stylesheet" href="../reset.css" /> -->

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>Hall Movie Schedule Details</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include(dirname(__DIR__) . '../../adminSidebar.php') ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <button onclick="history.back()" class="btn btn-outline-primary mb-3">
                <i class="fas fa-arrow-left me-2"></i>Back
            </button>
            <div class="d-flex align-items-center">
                <h1 class="mb-2">Mid Valley - Hall 1</h1>
                <i class="fa fa-info-circle ms-3 fa-lg"></i>
            </div>
            <div class="d-flex flex-row-reverse mb-3">
                <a href="CinemaConfigurationLogs.html">
                    <button class="btn btn-warning mb-3">
                        <i class="fa fa-cogs me-2" aria-hidden="true"></i>
                        Edit Hall Configuration
                    </button>
                </a>
            </div>
            <div class="movie-schedule">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Scheduled Movies</h2>
                    <button class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Add New Movie Schedule
                    </button>
                </div>
            </div>

            <div class="d-flex flex-column gap-4">
                <?php if (isset($groupedSchedules)) foreach ($groupedSchedules as $date => $movieSchedules): ?>
                    <div>
                        <div class="date-header">
                            <h3><?= (new DateTime($date))->format('F d, Y') ?></h3>
                        </div>
                        <div>
                            <?php foreach ($movieSchedules as $movieData): ?>
                                <?php $movie = $movieData['movie']; ?>
                                <div class="movie-item d-flex gap-4">
                                    <div>
                                        <img src="<?= htmlspecialchars($movie->getPhoto()) ?>"
                                             class="movie-schedule-img"/>
                                    </div>
                                    <div>
                                        <h4><?= htmlspecialchars($movie->getTitle()) ?></h4>
                                        <p class="mt-5">Duration: <?= $movie->getDuration() ?> minutes |
                                            Classification: <?= htmlspecialchars($movie->getClassification()) ?></p>
                                        <div class="showtimes">
                                            <?php foreach ($movieData['times'] as $time): ?>
                                                <span class="showtime-badge"><?= $time->format('g:i A') ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-4 mt-3 w-50">
                                        <button class="px-5 py-2 btn btn-success"><i
                                                    class="fa fa-plus-circle me-2 fa-lg"></i>Add Showtime
                                        </button>
                                        <button class="px-5 py-2 btn btn-info"><i class="fa fa-pencil me-2 fa-lg"></i>Edit
                                            Showtime
                                        </button>
                                        <button class="px-5 py-2 btn btn-danger"><i class="fa fa-trash me-2 fa-lg"></i>Remove
                                            Showtime
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
