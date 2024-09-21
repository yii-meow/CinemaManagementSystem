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
    <title>Hall Configuration</title>

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
                <h1 class="mb-2">
                    <?= htmlspecialchars($cinemaInformation["cinemaName"] ?? 'N/A') ?>
                    - Hall <?= htmlspecialchars($cinemaInformation["hallName"] ?? 'N/A') ?></h1>
                <i class="fa fa-info-circle ms-3 fa-lg"></i>
            </div>
            <div class="d-flex flex-row-reverse mb-3">
                <a href="CinemaConfigurationLogs.html">
                    <button class="btn btn-warning mb-3">
                        <i class="fa fa-cogs me-2" aria-hidden="true"></i>
                        View Past Configurations
                    </button>
                </a>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-configuration">
                                Seating Layout
                                <!-- Replace the existing button with this one -->
                                <button
                                        class="btn btn-warning btn-sm btn-outline-dark px-3 py-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editSeatCapacityModal"
                                >
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </h5>
                            <p class="card-text mt-5">Last updated: May 15, 2024</p>
                            <ul class="list-unstyled mt-5">
                                <li>Total seats: <b><?= htmlspecialchars($cinemaInformation["capacity"] ?? 'N/A') ?></b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-configuration">
                                Hall Type
                                <button
                                        class="btn btn-warning btn-sm btn-outline-dark px-3 py-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editHallTypeModal"
                                >
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </h5>
                            <p class="card-text mt-5">Last updated: June 1, 2024</p>
                            <ul class="list-unstyled mt-5">
                                <li>Experience: <b><?= htmlspecialchars($cinemaInformation["hallType"] ?? 'N/A') ?></b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editHallTypeModal" tabindex="-1" aria-labelledby="editHallTypeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editHallTypeModalLabel">Edit Hall Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editHallTypeForm">
                    <div class="mb-3">
                        <label for="hallType" class="form-label">Hall Type</label>
                        <select class="form-select" id="hallType" name="hallType" required>
                            <option value="IMAX">IMAX</option>
                            <option value="DELUXE">DELUXE</option>
                            <option value="ATMOS">ATMOS</option>
                            <option value="BENIE">BENIE</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editHallTypeForm" class="btn btn-primary">Save changes
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSeatCapacityModal" tabindex="-1" aria-labelledby="editSeatCapacityModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSeatCapacityModalLabel">Edit Seat Capacity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSeatCapacityForm">
                    <div class="mb-3">
                        <label for="seatCapacity" class="form-label">Seat Capacity</label>
                        <select class="form-select" id="seatCapacity" name="seatCapacity" required>
                            <option value="48">48</option>
                            <option value="60">60</option>
                            <option value="108">108</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editSeatCapacityForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('editHallTypeForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const hallType = document.getElementById('hallType').value;
            const hallId = <?= json_encode($cinemaInformation['hallId'] ?? null) ?>;
            if (!hallId) {
                alert('Hall ID is missing. Cannot update hall type.');
                return;
            }
            fetch('<?=ROOT?>/HallManagement/updateHall', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({hallId, hallType})
            })
                .then(response =>
                    response.json()
                )
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        alert('Hall type updated successfully!');
                        location.reload(); // Refresh the page to show the updated information
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the hall type.');
                });

            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('editHallTypeModal'));
            modal.hide();
        });
        document.getElementById('editSeatCapacityForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const capacity = document.getElementById('seatCapacity').value;
            const hallId = <?= json_encode($cinemaInformation['hallId'] ?? null) ?>;

            if (!hallId) {
                alert('Hall ID is missing. Cannot update seat capacity.');
                return;
            }

            fetch('<?=ROOT?>/HallManagement/updateHall', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({hallId, capacity: parseInt(capacity)})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Seat capacity updated successfully!');
                        location.reload(); // Refresh the page to show the updated information
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the seat capacity.');
                });

            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('editSeatCapacityModal'));
            modal.hide();
        });
    });

    // Set the current hall type when the modal is opened
    document.getElementById('editHallTypeModal').addEventListener('show.bs.modal', function (event) {
        const currentHallType = <?= json_encode($cinemaInformation['hallType'] ?? '') ?>;
        document.getElementById('hallType').value = currentHallType;
    });

    document.getElementById('editSeatCapacityModal').addEventListener('show.bs.modal', function (event) {
        const currentCapacity = <?= json_encode($cinemaInformation['capacity'] ?? '') ?>;
        document.getElementById('seatCapacity').value = currentCapacity;
    });
</script>

</body>
</html>
