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
                            <option value="Deluxe">Deluxe</option>
                            <option value="Atmos">Atmos</option>
                            <option value="Benie">Benie</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Cinema Hall</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('addCinemaHallForm');
        const hallNameInput = document.getElementById('hallName');

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

        form.addEventListener('submit', async function (e) {
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
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
