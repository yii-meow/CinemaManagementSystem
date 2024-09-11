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
    <title>Cinemas Configuration Logs</title>

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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 main-content mt-3">
            <button onclick="history.back()" class="btn btn-outline-primary mb-3">
                <i class="fas fa-arrow-left me-2"></i>Back
            </button>
            <div class="d-flex align-items-center mb-4">
                <h1 class="mb-3">Cinema Logs</h1>
                <i class="fas fa-history ms-3 fa-lg"></i>
            </div>
            <div class="log-container">
                <div class="log-entry">
                    <p class="log-time">2024-09-05 14:30:22</p>
                    <p class="log-event">Updated seating layout: Added 5 VIP seats</p>
                </div>
                <div class="log-entry">
                    <p class="log-time">2024-09-05 12:15:07</p>
                    <p class="log-event">
                        Modified operating hours: Extended weekend closing time to 1:00
                        AM
                    </p>
                </div>
                <div class="log-entry">
                    <p class="log-time">2024-09-04 09:45:33</p>
                    <p class="log-event">
                        Updated projection system: Installed new 8K projector
                    </p>
                </div>
                <div class="log-entry">
                    <p class="log-time">2024-09-03 16:20:11</p>
                    <p class="log-event">
                        Changed audio system: Upgraded to Dolby Atmos
                    </p>
                </div>
                <div class="log-entry">
                    <p class="log-time">2024-09-02 11:05:48</p>
                    <p class="log-event">
                        Modified concession menu: Added vegan options
                    </p>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
