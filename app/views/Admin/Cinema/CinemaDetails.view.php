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
                    Cinema Hall Details -
                    <?php if (isset($cinema))
                        echo htmlspecialchars($cinema->getName());
                    ?></h1>
                <i class="fa fa-info-circle ms-3 fa-lg"></i>
            </div>

            <div class="col-md-12 col-lg-12 mb-5">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <p class="card-text cinema-stat text-white">
                            Operating Time: <?= htmlspecialchars($cinema->getOpeningHours());?>
                        </p>

                        <p class="card-text cinema-stat text-white">
                            Address: <?= htmlspecialchars($cinema->getAddress());?>
                            , <?= htmlspecialchars($cinema->getCity());?>
                            , <?= htmlspecialchars($cinema->getState());?>
                        </p>
                        <div class="mb-3 d-flex flex-row-reverse">
                            <button
                                    class="btn btn-warning px-5 py-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editCinemaModal"
                            >
                                <i class="fa fa-edit me-3"></i>Edit Cinema Information
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <h1>Hall List</h1>

            <div class="mb-3 d-flex flex-row-reverse">
                <button
                        class="btn btn-primary px-4 py-2"
                        data-bs-toggle="modal"
                        data-bs-target="#addCinemaModal"
                >
                    <i class="fa fa-plus me-3"></i>Add New Cinema Hall
                </button>
            </div>

            <div class="row g-5">
                <?php if (isset($cinemaHalls) && !empty($cinemaHalls[0])) {
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
                    <?php endforeach;
                } else {
                    echo "<div class='col-md-12 col-lg-12'>
                            <div class='card bg-warning'>
                                <div class='card-body text-light'>
                                    No cinema halls found!
                                    <a href='#' data-bs-toggle='modal' data-bs-target='#addCinemaModal'>Add Cinema Hall</a>
                                </div>
                            </div>
                        </div>";
                }
                ?>
            </div>
        </main>
    </div>
</div>
<!-- Add Cinema Hall Modal -->
<div class="modal fade" id="addCinemaModal" tabindex="-1" aria-labelledby="addCinemaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCinemaModalLabel">Add New Cinema Hall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCinemaHallForm">
                    <input type="hidden" id="cinemaId" name="cinemaId" value="<?= $_GET['id'] ?? '' ?>">

                    <div class="mb-3">
                        <label for="hallName" class="form-label">Hall Name</label>
                        <input type="text" class="form-control" id="hallName" name="hallName" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <select class="form-select" id="capacity" name="capacity" required>
                            <option value="">Select capacity</option>
                            <option value="48">48</option>
                            <option value="60">60</option>
                            <option value="108">108</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hallType" class="form-label">Hall Type</label>
                        <select class="form-select" id="hallType" name="hallType" required>
                            <option value="">Select hall type</option>
                            <option value="IMAX">IMAX</option>
                            <option value="Deluxe">DELUXE</option>
                            <option value="Atmos">ATMOS</option>
                            <option value="Benie">BENIE</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Cinema Hall</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Cinema Modal -->
<div class="modal fade" id="editCinemaModal" tabindex="-1" aria-labelledby="editCinemaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCinemaModalLabel">Edit Cinema Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCinemaForm">
                    <input type="hidden" id="cinemaId" name="cinemaId" value="<?= $cinema->getCinemaId() ?>">
                    <div class="mb-3">
                        <label for="cinemaName" class="form-label">
                            <i class="fas fa-film me-2"></i>Cinema Name
                        </label>
                        <input type="text" class="form-control" id="cinemaName" name="name" value="<?= $cinema->getName() ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cinemaAddress" class="form-label">
                            <i class="fas fa-map-marker-alt me-2"></i>Address
                        </label>
                        <input type="text" class="form-control" id="cinemaAddress" name="address" value="<?= $cinema->getAddress() ?>" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="cinemaCity" class="form-label">
                                <i class="fas fa-city me-2"></i>City
                            </label>
                            <input type="text" class="form-control" id="cinemaCity" name="city" value="<?= $cinema->getCity() ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cinemaState" class="form-label">
                                <i class="fas fa-map me-2"></i>State
                            </label>
                            <select class="form-select" id="cinemaState" name="state" required>
                                <option value="">Select a state</option>
                                <?php
                                $states = [
                                    'Kuala Lumpur',
                                    'Selangor',
                                    'Penang',
                                    'Johor',
                                    // Add more Malaysian states here
                                ];

                                $currentState = $cinema->getState();

                                foreach ($states as $state) {
                                    $selected = ($state === $currentState) ? 'selected' : '';
                                    echo "<option value=\"$state\" $selected>$state</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    // Assuming you have the operating hours string
                    $operatingHours = $cinema->getOpeningHours();

                    // Parse the operating hours
                    list($openingTime, $closingTime) = explode('-', $operatingHours);

                    // Format the times for the time input (HH:MM)
                    $formattedOpeningTime = substr($openingTime, 0, 2) . ':' . substr($openingTime, 2);
                    $formattedClosingTime = substr($closingTime, 0, 2) . ':' . substr($closingTime, 2);
                    ?>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-clock me-2"></i>Operating Time
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="openingHour" class="form-label">Opening Hour</label>
                                <input type="time" class="form-control" id="openingHour" name="openingHour" value="<?php echo $formattedOpeningTime; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="closingHour" class="form-label">Closing Hour</label>
                                <input type="time" class="form-control" id="closingHour" name="closingHour" value="<?php echo $formattedClosingTime; ?>" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCinemaChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('addCinemaHallForm');
        const hallNameInput = document.getElementById('hallName');
        const addCinemaHallForm = document.getElementById("addCinemaHallForm");
        const saveCinemaChanges = document.getElementById('saveCinemaChanges');
        const editCinemaForm = document.getElementById('editCinemaForm');

        // Function to get the next hall name
        async function getNextHallName() {
            const cinemaId = document.getElementById('cinemaId').value;
            const response = await fetch(`<?=ROOT?>/CinemaDetails/getNextHallName?cinemaId=${cinemaId}`);
            const data = await response.json();
            return data.nextHallName;
        }

        // Set the next hall name when the modal is opened
        $('#addCinemaModal').on('show.bs.modal', async function () {
            const nextHallName = await getNextHallName();
            hallNameInput.value = nextHallName;
        });

        addCinemaHallForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('<?=ROOT?>/CinemaDetails/addCinemaHall', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                if (result.success) {
                    alert('Cinema Hall added successfully!');
                    $('#addCinemaModal').modal('hide');
                    location.reload(); // Refresh the page to show the new hall
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while adding the cinema hall.');
            }
        });

        saveCinemaChanges.addEventListener('click', async function() {
            if (editCinemaForm.checkValidity()) {
                // Collect form data
                const formData = new FormData(editCinemaForm);
                const cinemaData = Object.fromEntries(formData.entries());

                // Combine opening and closing hours
                cinemaData.openingHours = `${cinemaData.openingHour}-${cinemaData.closingHour}`;
                delete cinemaData.openingHour;
                delete cinemaData.closingHour;

                console.log('Cinema data to be saved:', cinemaData);

                try {
                    const response = await fetch('<?=ROOT?>/CinemaDetails/editCinema', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: cinemaData
                    });
                    const result = await response.json();
                    if (result.success) {
                        console.log(result);
                        alert('Cinema updated successfully!');
                        $('#editCinemaModal').modal('hide');
                        location.reload(); // Refresh the page to show the new hall
                    } else {
                        alert('Error: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while adding the cinema hall.');
                }

                // Close the modal
                const modal = bootstrap.Modal.getInstance(editCinemaModal);
                modal.hide();
            } else {
                // Trigger browser's default validation UI
                editCinemaForm.reportValidity();
            }
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
