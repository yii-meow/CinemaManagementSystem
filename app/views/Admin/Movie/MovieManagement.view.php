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
                                <i class="fa fa-ticket me-4 fa-lg"></i>
                                Ticket Pricing Management
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom"
            >
                <h1 class="h2">
                    <i class="fas fa-film me-3"></i>Current Showing Movies
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <div class="mb-3 d-flex flex-row-reverse">
                <a href="AddMovie.html">
                    <button
                        class="btn btn-primary px-4 py-2"
                    >
                        <i class="fa fa-plus me-3"></i>Add New Movie
                    </button>
                </a>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                <span class="input-group-text"
                ><i class="fas fa-search"></i
                    ></span>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search movies..."
                        />
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="stateFilter">
                        <option value="">All Category</option>
                        <option value="Selangor">Thriller</option>
                        <option value="Johor">Horror</option>
                        <option value="Penang">Romance</option>
                        <option value="Kuala Lumpur">Action</option>
                        <option value="Kuala Lumpur">Racing</option>
                        <!-- Add more states here -->
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="sortOption">
                        <option selected="selected" disabled>Sort by...</option>
                        <option value="name">Sort by Name</option>
                        <option value="location">Sort by Duration</option>
                    </select>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- Movie Card 1 -->
                <div class="col">
                    <div class="card">
                        <img
                            src="../../Media/Image/mainMovie_1.jpg"
                            class="card-img-top"
                            alt="Movie 1"
                        />
                        <div class="card-body">
                            <h5 class="movie-card-title">Deadpool</h5>
                            <p class="card-text text-secondary mt-4">
                                Director: John Doe
                            </p>
                            <p class="card-text text-secondary">Duration: 120 mins</p>
                            <p class="card-text text-secondary">Classification: PG-13</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    Remove
                                </button>
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
