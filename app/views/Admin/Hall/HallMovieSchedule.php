<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
        rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
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

    <link rel="stylesheet" href="../../../../public/css/AdminCinemaManagement.css" />
    <title>Cinemas Details</title>

    <link rel="icon" type="image/x-icon" href="../Media/Image/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block p-0">
            <div class="sidebar-container">
                <div class="sidebar p-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-film me-4 fa-lg"></i>
                                Cinemas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt me-4 fa-lg"></i>
                                Movie & Showtimes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-ticket-alt me-4 fa-lg"></i>
                                Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AdminForum.html">
                                <i class="fa fa-users me-4 fa-lg"></i>
                                Forum
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar me-4 fa-lg"></i>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-4 fa-lg"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Admin Info -->
                <div class="admin-info">
                    <div class="d-flex align-items-center mb-2">
                        <img
                            src="/Media/Image/pp.webp"
                            alt="Admin Avatar"
                            class="me-2"
                        />
                        <div>
                            <strong>John Doe</strong>
                            <div class="small text-muted">Admin</div>
                        </div>
                    </div>
                    <button class="btn btn-outline-light btn-sm w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </div>
            </div>
        </nav>

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

                <!-- Example of scheduled movies (repeat this structure for each date) -->
                <div class="d-flex flex-column gap-4">
                    <div>
                        <div class="date-header">
                            <h3>September 6, 2024</h3>
                        </div>
                        <div>
                            <div class="movie-item d-flex gap-4">
                                <div>
                                    <img src="../../Media/Image/movie.webp" class="movie-schedule-img"/>
                                </div>
                                <div>
                                    <h4>Interstellar</h4>
                                    <p class="mt-5">Duration: 169 minutes | Classification: PG-13</p>
                                    <div class="showtimes">
                                        <span class="showtime-badge">10:00 AM</span>
                                        <span class="showtime-badge">2:00 PM</span>
                                        <span class="showtime-badge">6:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-4 mt-3 w-50">
                                    <button class="px-5 py-2 btn btn-success"><i class="fa fa-plus-circle me-2 fa-lg"></i>Add Showtime </button>
                                    <button class="px-5 py-2 btn btn-info"><i class="fa fa-pencil me-2 fa-lg"></i>Edit Showtime</button>
                                    <button class="px-5 py-2 btn btn-danger"><i class="fa fa-trash me-2 fa-lg"></i> Remove Showtime</button>
                                </div>
                            </div>
                            <div class="movie-item d-flex gap-4">
                                <div>
                                    <img src="../../Media/Image/movie.webp" class="movie-schedule-img"/>
                                </div>
                                <div>
                                    <h4>Avengers</h4>
                                    <p class="mt-5">Duration: 169 minutes | Classification: PG-13</p>
                                    <div class="showtimes">
                                        <span class="showtime-badge">10:00 AM</span>
                                        <span class="showtime-badge">2:00 PM</span>
                                        <span class="showtime-badge">6:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-4 mt-3 w-50">
                                    <button class="px-5 py-2 btn btn-success"><i class="fa fa-plus-circle me-2 fa-lg"></i>Add Showtime </button>
                                    <button class="px-5 py-2 btn btn-info"><i class="fa fa-pencil me-2 fa-lg"></i>Edit Showtime</button>
                                    <button class="px-5 py-2 btn btn-danger"><i class="fa fa-trash me-2 fa-lg"></i> Remove Showtime</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="date-header">
                            <h3>September 7, 2024</h3>
                        </div>
                        <div>
                            <div class="movie-item d-flex gap-4">
                                <div>
                                    <img src="../../Media/Image/movie.webp" class="movie-schedule-img"/>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Interstellar</h4>
                                        <p class="mt-5">Duration: 169 minutes | Classification: PG-13</p>
                                        <div class="showtimes">
                                            <span class="showtime-badge">10:00 AM</span>
                                            <span class="showtime-badge">2:00 PM</span>
                                            <span class="showtime-badge">6:00 PM</span>
                                            <span class="showtime-badge">10:00 PM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-4 mt-3 w-50">
                                        <button class="px-5 py-2 btn btn-success"><i class="fa fa-plus-circle me-2 fa-lg"></i>Add Showtime </button>
                                        <button class="px-5 py-2 btn btn-info"><i class="fa fa-pencil me-2 fa-lg"></i>Edit Showtime</button>
                                        <button class="px-5 py-2 btn btn-danger"><i class="fa fa-trash me-2 fa-lg"></i> Remove Showtime</button>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item d-flex gap-4">
                                <div>
                                    <img src="../../Media/Image/movie.webp" class="movie-schedule-img"/>
                                </div>
                                <div>
                                    <h4>Avengers</h4>
                                    <p class="mt-5">Duration: 169 minutes | Classification: PG-13</p>
                                    <div class="showtimes">
                                        <span class="showtime-badge">10:00 AM</span>
                                        <span class="showtime-badge">2:00 PM</span>
                                        <span class="showtime-badge">6:00 PM</span>
                                        <span class="showtime-badge">10:00 PM</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-4 mt-3 w-50">
                                    <button class="px-5 py-2 btn btn-success"><i class="fa fa-plus-circle me-2 fa-lg"></i>Add Showtime </button>
                                    <button class="px-5 py-2 btn btn-info"><i class="fa fa-pencil me-2 fa-lg"></i>Edit Showtime</button>
                                    <button class="px-5 py-2 btn btn-danger"><i class="fa fa-trash me-2 fa-lg"></i> Remove Showtime</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
