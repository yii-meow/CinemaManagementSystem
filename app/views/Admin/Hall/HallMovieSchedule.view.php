<html>
<!--
/**
 * @author Chong Yik Soon
 */
 -->
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
                <h1 class="mb-2">
                    <?php echo $cinemaInformation["name"] ?>
                    - Hall <?= $cinemaInformation["hallName"] ?>
                </h1>
                <i class="fa fa-info-circle ms-3 fa-lg"></i>
            </div>
            <div class="d-flex flex-row-reverse mb-3">
                <a href="<?= ROOT ?>/HallManagement?hallId=<?= $cinemaInformation["hallId"] ?>">
                    <button class="btn btn-warning mb-3">
                        <i class="fa fa-cogs me-2" aria-hidden="true"></i>
                        Edit Hall Configuration
                    </button>
                </a>
            </div>
            <div class="d-flex flex-row-reverse mb-3">
                <button class="btn btn-danger mb-3" onclick="removeHall(<?= $cinemaInformation['hallId'] ?>)">
                    <i class="fa fa-cogs me-2" aria-hidden="true"></i>
                    Remove this Cinema Hall
                </button>
            </div>
            <div class="movie-schedule">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Scheduled Movies</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMovieScheduleModal">
                        <i class="fa fa-plus me-2"></i>Add New Movie Schedule
                    </button>
                </div>
            </div>
            <div class="d-flex flex-column gap-4">
                <?php if (isset($groupedSchedules) && !empty($groupedSchedules)) foreach ($groupedSchedules as $date => $movieSchedules): ?>
                    <div>
                        <div class="date-header">
                            <h3><?= (new DateTime($date))->format('F d, Y') ?></h3>
                        </div>
                        <div>
                            <?php foreach ($movieSchedules as $movieData): ?>
                                <?php $movie = $movieData['movie']; ?>
                                <div class="movie-item d-flex gap-4">
                                    <div>
                                        <img src="<?= ROOT . htmlspecialchars($movie->getPhoto()) ?>"
                                             class="movie-schedule-img"/>
                                    </div>
                                    <div>
                                        <h4><?= htmlspecialchars($movie->getTitle()) ?></h4>
                                        <p class="mt-5">Duration: <?= $movie->getDuration() ?> minutes |
                                            Classification: <?= htmlspecialchars($movie->getClassification()) ?></p>
                                        <div class="showtimes">
                                            <?php foreach ($movieData['times'] as $scheduleData): ?>
                                                <span class="showtime-badge"><?= $scheduleData['time']->format('g:i A') ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-4 mt-3 w-50">
                                        <?php foreach ($movieData['times'] as $scheduleData): ?>
                                            <div class="d-flex flex-row gap-5 align-items-center">
                                                <div>
                                                    <span class="showtime-badge"><?= $scheduleData['time']->format('g:i A') ?></span>
                                                </div>
                                                <div>
                                                    <button class="btn btn-info btn-sm edit-showtime px-5 py-2"
                                                            data-schedule-id="<?= $scheduleData['id'] ?>"
                                                            data-full-datetime="<?= $scheduleData['fullDateTime'] ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editShowtimeModal">
                                                        <i class="fa fa-pencil me-2"></i>Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm remove-showtime px-5 py-2"
                                                            data-schedule-id="<?= $scheduleData['id'] ?>">
                                                        <i class="fa fa-trash me-2"></i>Remove
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach;
                else {
                    echo "<div class='alert alert-danger' role='alert'>No movie schedule found.
                          <a href='#' data-bs-toggle='modal' data-bs-target='#addMovieScheduleModal'>Add new movie schedule</a>
                          </div>";
                } ?>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMovieScheduleModal" tabindex="-1" aria-labelledby="addMovieScheduleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMovieScheduleModalLabel">Add New Movie Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMovieScheduleForm">
                    <input type="hidden" id="cinemaHallId" name="cinemaHallId"
                           value="<?php echo htmlspecialchars($cinemaInformation["hallId"]); ?>">
                    <div class="mb-3">
                        <label for="movieSelect" class="form-label">Select Movie</label>
                        <select class="form-select" id="movieSelect" name="movieId" required>
                            <option value="">Choose a movie...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startingTime" class="form-label">Starting Time</label>
                        <input type="datetime-local" class="form-control" id="startingTime" name="startingTime"
                               required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="addMovieScheduleForm" class="btn btn-primary">Save Schedule</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Showtime Modal -->
<div class="modal fade" id="editShowtimeModal" tabindex="-1" aria-labelledby="editShowtimeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editShowtimeModalLabel">Edit Showtime</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editShowtimeForm">
                    <input type="hidden" id="editScheduleId" name="scheduleId">
                    <div class="mb-3">
                        <label for="editStartingTime" class="form-label">Starting Time</label>
                        <input type="time" class="form-control" id="editStartingTime" name="startingTime" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editShowtimeForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Populate the movie select dropdown
        const movieSelect = document.getElementById('movieSelect');
        const movies = <?php echo json_encode($movies); ?>;
        const editShowtimeModal = document.getElementById('editShowtimeModal');

        movies.forEach(movie => {
            const option = document.createElement('option');
            option.value = movie.id;
            option.textContent = movie.title;
            movieSelect.appendChild(option);
        });

        // Add Movie Schedule
        document.getElementById('addMovieScheduleForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('<?=ROOT?>/MovieScheduleManagement/addMovieSchedule', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Added movie schedule successfully");
                        location.reload();
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert("An error occurred while adding the movie schedule");
                });

            // Close the modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('addMovieScheduleModal'));
            modal.hide();
        });

        // Edit Showtime
        editShowtimeModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const scheduleId = button.getAttribute('data-schedule-id');
            const fullDateTime = button.getAttribute('data-full-datetime');

            document.getElementById('editScheduleId').value = scheduleId;
            document.getElementById('editStartingTime').value = formatTimeForInput(fullDateTime);
            document.getElementById('editShowtimeForm').setAttribute('data-full-datetime', fullDateTime);
        });

        document.getElementById('editShowtimeForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const scheduleId = formData.get('scheduleId');
            const startingTime = formData.get('startingTime');
            const fullDateTime = this.getAttribute('data-full-datetime');

            // Get the date part from the full datetime
            const currentDate = fullDateTime.split('T')[0];

            // Combine the current date with the new time
            const newDateTime = `${currentDate}T${startingTime}`;

            formData.set('startingTime', newDateTime);

            fetch('<?= ROOT ?>/MovieScheduleManagement/updateMovieSchedule', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Showtime updated successfully!');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the showtime.');
                });
        });

        // Remove Showtime
        document.querySelectorAll('.remove-showtime').forEach(button => {
            button.addEventListener('click', function () {
                const scheduleId = this.getAttribute('data-schedule-id');
                if (confirm('Are you sure you want to remove this showtime?')) {
                    fetch(`<?= ROOT ?>/MovieScheduleManagement/removeMovieSchedule/${scheduleId}`, {
                        method: 'DELETE'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Showtime removed successfully!');
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while removing the showtime.');
                        });
                }
            });
        });

        function removeHall(hallId) {
            if (confirm('Are you sure you want to remove this cinema hall?')) {
                fetch(`<?= ROOT ?>/HallManagement/removeHall/${hallId}`, {
                    method: 'DELETE',
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '<?= ROOT ?>/CinemaManagement'; // Redirect to cinema management page
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the cinema hall.');
                    });
            }
        }

        function formatTimeForInput(dateTimeString) {
            const date = new Date(dateTimeString);
            return date.toTimeString().slice(0, 5);
        }
    });
</script>
</body>
</html>
