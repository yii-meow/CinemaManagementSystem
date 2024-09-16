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
    <title>Cinema Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/Media/Image/icon.png"/>
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

            <!--Add Cinema-->
            <div class="mb-3 d-flex flex-row-reverse">
                <button
                        class="btn btn-primary px-4 py-2"
                        data-bs-toggle="modal"
                        data-bs-target="#addCinemaModal"
                >
                    <i class="fa fa-plus me-3"></i>Add New Cinema
                </button>
            </div>

            <!-- Filters and Sorting -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                               id="cinemaSearch"
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
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="sortOption">
                        <option value="name">Sort by Name</option>
                        <option value="location">Sort by Location</option>
                        <option value="halls">Sort by Hall Numbers</option>
                    </select>
                </div>
            </div>

            <?php
            ?>

            <!-- Cinema list -->
            <div id="cinemaList" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php
                // Check if $data['cinemas'] exists and is not empty
                if (isset($data['cinemas']) && !empty($data['cinemas'])) {
                    foreach ($data['cinemas'] as $cinema) {
                        ?>
                        <div class="col cinema-item" data-state="<?= htmlspecialchars($cinema['state']) ?>"
                             data-name="<?= htmlspecialchars($cinema['name']) ?>"
                             data-location="<?= htmlspecialchars($cinema['state'] . ' - ' . $cinema['city']) ?>"
                             data-halls="<?= htmlspecialchars($cinema['hallCount']) ?>">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($cinema['name']); ?></h5>
                                    <p class="card-text cinema-stat">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <?= htmlspecialchars($cinema['state']) ?>
                                        - <?= htmlspecialchars($cinema['city']) ?>
                                    </p>
                                    <p class="card-text cinema-stat">
                                        <i class="fas fa-tv me-2"></i><?= htmlspecialchars($cinema['hallCount']) ?>
                                        Halls
                                    </p>
                                    <p class="card-text cinema-stat">
                                        Operating Time : <?= $cinema["openingHours"] ?>
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 mt-3">
                                    <a href="CinemaDetails/<?= urlencode($cinema['cinemaId']) ?>">
                                        <button class="btn btn-md btn-outline-info px-4">
                                            <i class="fas fa-info-circle me-2"></i>View Cinema Details
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No cinemas found.</p>";
                }
                ?>
            </div>
        </main>
    </div>
</div>

<!-- Add Cinema Modal -->
<div class="modal fade" id="addCinemaModal" tabindex="-1" aria-labelledby="addCinemaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCinemaModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Add New Cinema
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCinemaForm">
                    <div class="mb-3 mt-2">
                        <label for="cinemaName" class="form-label">
                            <i class="fas fa-film me-2"></i>Cinema Name
                        </label>
                        <input type="text" class="form-control" id="cinemaName" name="name" required maxlength="255">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="cinemaAddress" class="form-label">
                            <i class="fas fa-map-marker-alt me-2"></i>Address
                        </label>
                        <input type="text" class="form-control" id="cinemaAddress" name="address" required
                               maxlength="255">
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col-md-6">
                            <label for="cinemaCity" class="form-label">
                                <i class="fas fa-city me-2"></i>City
                            </label>
                            <input type="text" class="form-control" id="cinemaCity" name="city" required
                                   maxlength="255">
                        </div>
                        <div class="col-md-6">
                            <label for="cinemaState" class="form-label">
                                <i class="fas fa-map-marked-alt me-2"></i>State
                            </label>
                            <select class="form-select" id="cinemaState" name="state" required>
                                <option value="">Select a state</option>
                                <option value="Kuala Lumpur">Kuala Lumpur</option>
                                <option value="Selangor">Selangor</option>
                                <option value="Penang">Penang</option>
                                <option value="Johor">Johor</option>
                                <!-- Add more Malaysian states here -->
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 mt-5">
                        <label class="form-label">
                            <i class="fas fa-clock me-2"></i>Operating Time
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="openingHour" class="form-label">Opening Hour</label>
                                <input type="time" class="form-control" id="openingHour" name="openingHour" required>
                            </div>
                            <div class="col-md-6">
                                <label for="closingHour" class="form-label">Closing Hour</label>
                                <input type="time" class="form-control" id="closingHour" name="closingHour" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <button type="submit" form="addCinemaForm" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Cinema
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('cinemaSearch');
        const stateFilter = document.getElementById('stateFilter');
        const sortOption = document.getElementById('sortOption');
        const cinemaList = document.getElementById('cinemaList');
        const cinemaItems = cinemaList.getElementsByClassName('cinema-item');

        function filterAndSortCinemas() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedState = stateFilter.value;
            const sortBy = sortOption.value;

            let visibleItems = Array.from(cinemaItems).filter(function (item) {
                const cinemaName = item.dataset.name.toLowerCase();
                const cinemaLocation = item.dataset.location.toLowerCase();
                const cinemaState = item.dataset.state;

                const matchesSearch = cinemaName.includes(searchTerm) || cinemaLocation.includes(searchTerm);
                const matchesState = selectedState === "" || cinemaState === selectedState;

                item.style.display = matchesSearch && matchesState ? '' : 'none';
                return matchesSearch && matchesState;
            });

            visibleItems.sort(function (a, b) {
                let aValue, bValue;
                switch (sortBy) {
                    case 'name':
                        return a.dataset.name.localeCompare(b.dataset.name);
                    case 'location':
                        return a.dataset.location.localeCompare(b.dataset.location);
                    case 'halls':
                        return parseInt(b.dataset.halls) - parseInt(a.dataset.halls);
                    default:
                        return 0;
                }
            });

            visibleItems.forEach(item => cinemaList.appendChild(item));
            updateNoResultsMessage(visibleItems.length === 0);
        }

        function updateNoResultsMessage(noResults) {
            let noResultsMsg = document.getElementById('noResultsMessage');
            if (noResults) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('p');
                    noResultsMsg.id = 'noResultsMessage';
                    noResultsMsg.textContent = 'No cinemas found matching your criteria.';
                    cinemaList.appendChild(noResultsMsg);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }

        searchInput.addEventListener('input', filterAndSortCinemas);
        stateFilter.addEventListener('change', filterAndSortCinemas);
        sortOption.addEventListener('change', filterAndSortCinemas);

        // Initial sort
        filterAndSortCinemas();
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Form submission handler
        document.getElementById('addCinemaForm').addEventListener('submit', function (e) {
            e.preventDefault();
            // Collect form data
            const formData = new FormData(this);

            // Combine opening and closing hours
            const openingHour = formData.get('openingHour');
            const closingHour = formData.get('closingHour');
            formData.set('openingHours', `${openingHour} - ${closingHour}`);
            formData.delete('openingHour');
            formData.delete('closingHour');

            // Send data to server (replace with your actual endpoint)
            fetch('<?=ROOT?>/CinemaManagement/addCinema', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // Handle successful submission
                    $('#addCinemaModal').modal('hide');
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error:', error);
                    alert('An error occurred while adding the cinema.');
                });
        });
    });
</script>
</body>
</html>
