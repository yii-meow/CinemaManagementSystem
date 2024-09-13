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

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css" />
    <title>Cinema Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/Media/Image/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include(dirname(__DIR__) . '../../adminSidebar.php') ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom"
            >
                <h1 class="h2">
                    <i class="fas fa-film me-2"></i>Cinema Management
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <div class="mb-3 d-flex flex-row-reverse">
                <button
                    class="btn btn-primary px-4 py-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addCinemaModal"
                >
                    <i class="fa fa-plus me-3"></i>Add New Cinema
                </button>
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
                            placeholder="Search cinemas..."
                        />
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="stateFilter">
                        <option value="">All States</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Johor">Johor</option>
                        <option value="Penang">Penang</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <!-- Add more states here -->
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="sortOption">
                        <option value="name">Sort by Name</option>
                        <option value="location">Sort by Location</option>
                        <option value="screens">Sort by Screens</option>
                    </select>
                </div>
            </div>

            <!-- Cinema list -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Mid Valley Cinema</h5>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-map-marker-alt me-2"></i>Kuala Lumpur,
                                Malaysia
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-tv me-2"></i>8 Halls
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-calendar-check me-2"></i>Last Updated:
                                2023-08-08
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 mt-3">
                            <a href="CinemaDetails.html">
                                <button class="btn btn-md btn-outline-info px-4" onc>
                                    <i class="fas fa-info-circle me-2"></i>View Hall Details
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Gurney Plaza Cinema</h5>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-map-marker-alt me-2"></i>Penang, Malaysia
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-tv me-2"></i>6 Halls
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-calendar-check me-2"></i>Last Updated:
                                2023-08-08
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="CinemaDetails.html">
                                <button class="btn btn-md btn-outline-info px-4" onc>
                                    <i class="fas fa-info-circle me-2"></i>View Hall Details
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sunway Velocity Mall</h5>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-map-marker-alt me-2"></i>Penang, Malaysia
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-tv me-2"></i>6 Halls
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-calendar-check me-2"></i>Last Updated:
                                2023-08-08
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="CinemaDetails.html">
                                <button class="btn btn-md btn-outline-info px-4" onc>
                                    <i class="fas fa-info-circle me-2"></i>View Hall Details
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">TRX</h5>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-map-marker-alt me-2"></i>Penang, Malaysia
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-tv me-2"></i>6 Halls
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-calendar-check me-2"></i>Last Updated:
                                2023-08-08
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="CinemaDetails.html">
                                <button class="btn btn-md btn-outline-info px-4" onc>
                                    <i class="fas fa-info-circle me-2"></i>View Hall Details
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">TRX</h5>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-map-marker-alt me-2"></i>Penang, Malaysia
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-tv me-2"></i>6 Halls
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-calendar-check me-2"></i>Last Updated:
                                2023-08-08
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="CinemaDetails.html">
                                <button class="btn btn-md btn-outline-info px-4" onc>
                                    <i class="fas fa-info-circle me-2"></i>View Hall Details
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">TRX</h5>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-map-marker-alt me-2"></i>Penang, Malaysia
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-tv me-2"></i>6 Halls
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-calendar-check me-2"></i>Last Updated:
                                2023-08-08
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="CinemaDetails.html">
                                <button class="btn btn-md btn-outline-info px-4" onc>
                                    <i class="fas fa-info-circle me-2"></i>View Hall Details
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">TRX</h5>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-map-marker-alt me-2"></i>Penang, Malaysia
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-tv me-2"></i>6 Halls
                            </p>
                            <p class="card-text cinema-stat">
                                <i class="fas fa-calendar-check me-2"></i>Last Updated:
                                2023-08-08
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="CinemaDetails.html">
                                <button class="btn btn-md btn-outline-info px-4" onc>
                                    <i class="fas fa-info-circle me-2"></i>View Hall Details
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Cinema Modal -->
<div
    class="modal fade"
    id="addCinemaModal"
    tabindex="-1"
    aria-labelledby="addCinemaModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCinemaModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Add New Cinema
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="cinemaName" class="form-label">
                            <i class="fas fa-film me-2"></i>Cinema Name
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="cinemaName"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="cinemaState" class="form-label">
                            <i class="fas fa-map-marked-alt me-2"></i>State
                        </label>
                        <select class="form-select" id="cinemaState" required>
                            <option value="">Select a state</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Penang">Penang</option>
                            <option value="Johor">Johor</option>
                            <!-- Add more Malaysian states here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cinemaScreens" class="form-label">
                            <i class="fas fa-tv me-2"></i>Number of Screens
                        </label>
                        <input
                            type="number"
                            class="form-control"
                            id="cinemaScreens"
                            required
                            min="1"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="cinemaSeats" class="form-label">
                            <i class="fas fa-chair me-2"></i>Total Seats
                        </label>
                        <input
                            type="number"
                            class="form-control"
                            id="cinemaSeats"
                            required
                            min="1"
                        />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Cinema
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
