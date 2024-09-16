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

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>Cinemas Details</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include(dirname(__DIR__) . '../../adminSidebar.php') ?>
        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <a href="<?= ROOT ?>/CinemaManagement">
                <button class="btn btn-outline-primary mb-3">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </button>
            </a>
            <div class="d-flex align-items-center mb-4">

                <h1 class="mb-2">
                    Hall Details -
                    <?php if (isset($cinema))
                        echo htmlspecialchars($cinema->getName());
                    ?></h1>
                <i class="fa fa-info-circle ms-3 fa-lg"></i>
            </div>
            <div class="row g-5">
                <?php if (isset($cinemaHalls))
                    foreach ($cinemaHalls as $hall): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-configuration">
                                        Hall <?= htmlspecialchars($hall->getHallName()) ?></h5>
                                    <p class="card-text cinema-stat">
                                        <i class="fas fa-chair me-2"></i><?= $hall->getCapacity() ?> Seats Capacity
                                    </p>
                                    <p class="card-text cinema-stat">
                                        <i class="fas fa-television me-2"></i><?= htmlspecialchars($hall->getHallType()) ?>
                                    </p>
                                    <div class="d-flex justify-content-center mt-5">
                                        <a href="HallMovieSchedule?hallId=<?= $hall->getHallId() ?>">
                                            <button class="btn btn-secondary">
                                                View Hall <?= htmlspecialchars($hall->getHallName()) ?> Information
                                            </button>
                                        </a>
                                    </div>
                                </div>
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
